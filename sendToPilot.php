<?php

//VARIABLES DE CONFIGURACION


// *****************  PARAMETROS A MODIFICAR  ****************************************************//
$appKey = "9715fc4b-17a8-4e56-ac7a-6deb5fd46u71"; //aqui la key de la instancia correspondiente 
$codigoDeOrigenDelDato = "7A2E4184";  // poner codigo de origen de pilot en el administrador EJ: 345534
$landing_link = "Landing Promo Mes"; //link de la landing EJ: www.landingejemplo.com.ar/landing.html
$serviceURL = "http://www.pilotsolution.com.ar/api/webhooks/welcome.php";
$debug = 0;   //1 para indicar que es prueba y que no inserte el dato en el sistema.
// ***********************************************************************************************//


$PARAMETRO_REQUERIDO = true; 
$PARAMETRO_NO_REQUERIDO = false; 

try {
						
	//CAPTURA DE PARAMETROS que pueden venir de un formulario
	$payload = "";
	$payload .= 'action=create';
	$payload .= '&debug='.$debug;
	$payload .= '&appkey='.$appKey;
	$payload .= '&pilot_firstname='.urlencode(request("pilot_firstname",$PARAMETRO_REQUERIDO));
	$payload .= '&pilot_lastname='.urlencode(request("pilot_lastname",$PARAMETRO_NO_REQUERIDO,"")); 

	//************************************************************************************************************
	//AL MENOS UNO DE ESTOS PARAMETROS DEBER SER INFORMADO PARA QUE EL DATO INGRESE CORRETAMENTE Y NO SE RECHAZADO
	//************************************************************************************************************ 
	$payload .= '&pilot_phone='.urlencode(request("pilot_phone",$PARAMETRO_NO_REQUERIDO,""));
	$payload .= '&pilot_cellphone='.urlencode(request("pilot_cellphone",$PARAMETRO_NO_REQUERIDO,""));
	$payload .= '&pilot_email='.urlencode(request("pilot_email",$PARAMETRO_NO_REQUERIDO,""));
	//************************************************************************************************************

	$payload .= '&pilot_contact_type_id='.urlencode(request("pilot_contact_type_id",$PARAMETRO_REQUERIDO));
	$payload .= '&pilot_business_type_id='.urlencode(request("pilot_business_type_id",$PARAMETRO_REQUERIDO));
	$payload .= '&pilot_notes='.urlencode(request("pilot_notes",$PARAMETRO_NO_REQUERIDO,""));
	$payload .= '&pilot_suborigin_id='.$codigoDeOrigenDelDato;
	$payload .= '&pilot_landing_link='.$landing_link;

	$output = posturl($serviceURL, $payload);       
	
	

	$response = json_decode($output, true);
	
	//IMPLEMENTAR METODO DE CAPTURA DE ERROR 
	if ($response["success"] == false){
		
		echo "No se pudo cargar el dato por : ".$response["data"]; 
		
	} else {
		
		echo "El dato se cargo correctamente"; 
	}
	
	
	echo "<br> DEBUG (eliminar en produccion) :<br>"; 
	echo "<pre>"; 
	echo $output;
	echo "</pre>"; 


} catch (Exception $e) {
		
	echo $e->getMessage();
		
}

die() ;

function posturl($url, $payload){

	(function_exists('curl_init')) ? '' : die('cURL Must be installed for geturl function to work. Ask your host to enable it or uncomment extension=php_curl.dll in php.ini');

	$curl = curl_init();
	$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
	$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
	$header[] = "Cache-Control: max-age=0";
	$header[] = "Connection: keep-alive";
	$header[] = "Keep-Alive: 300";
	$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$header[] = "Accept-Language: en-us,en;q=0.5";
	$header[] = "Pragma: ";
	
	
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:5.0) Gecko/20100101 Firefox/5.0 Firefox/5.0');
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_REFERER, $url);
	curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
	curl_setopt($curl, CURLOPT_AUTOREFERER, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS,  $payload);
	//curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); //CURLOPT_FOLLOWLOCATION Disabled...
	curl_setopt($curl, CURLOPT_TIMEOUT, 60);

	$html = curl_exec($curl);

	$status = curl_getinfo($curl);
	
	curl_close($curl);

	if($status['http_code']!=200){
		if($status['http_code'] == 301 || $status['http_code'] == 302) {
			list($header) = explode("\r\n\r\n", $html, 2);
			$matches = array();
			preg_match("/(Location:|URI:)[^(\n)]*/", $header, $matches);
			$url = trim(str_replace($matches[1],"",$matches[0]));
			$url_parsed = parse_url($url);
			return (isset($url_parsed))? geturl($url):'';
		}
		$oline='';
		foreach($status as $key=>$eline){$oline.='['.$key.']'.$eline.' ';}
		$line =$oline." \r\n ".$url."\r\n-----------------\r\n";
		$handle = @fopen('./curl.error.log', 'a');
		fwrite($handle, $line);
		return FALSE;
	}
	return $html;
}       
 
// Levanta los parámetros por post o get
function request($param, $required=true, $default="")
{
	$result = $default;
	
	//veo si esta seteado el parametro POST
	if (isset($_POST[$param])) {
		
		if($_POST[$param]!="")
		{
			$result = $_POST[$param];
		} else {
			if ($required)
			{
				throw new Exception("El parametro requerido ".$param." no fue seteado");
				
			}
		
		}
	}
	else if(isset($_GET[$param]))
	{
		if($_GET[$param]!="")
		{
			$result = $_GET[$param];
		} else {
			if ($required)
			{
				throw new Exception("El parametro requerido ".$param." no fue seteado");
			}
		
		}
	}
	else 
	{
		if ($required)
		{
			throw new Exception("El parametro requerido ".$param." no fue seteado");
			
		} 
	}
	
	return $result;
}
?>
