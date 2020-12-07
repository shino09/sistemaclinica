<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class Pruebapilot extends CI_Controller {

	function __construct(){

		parent::__construct();

		#current
		$this->layout->current = 1;
	}

public function form()	{
        
    

     
      
		#Title
		$this->layout->title('Pilot - ');

		#Metas
		$this->layout->setMeta('title','pilot');
		$this->layout->setMeta('description','pilot');
		$this->layout->setMeta('keywords','pilot');



		#JS - Tabs
		$this->layout->css('/js/jquery/tabs/tabs.css');
				$this->layout->js('/js/sistema/pruebapilot/form.js');


	
		#Nav
		$this->layout->nav(array("1"=>"prueba", 'pilot' =>"/"));

		#La vista siempre,  debe ir cargada al final de la función
		$this->layout->view('form');
	}

			public function enviar()	{
				die('sddsdsds');

		$serviceURL = "//api.pilotsolution.com.ar/webhooks/welcome.php";
$appKey = "aqui la key de la instancia correspondiente"; 
$tipoNegocio = "1";  
$origendeldato = "7A2E4184"; 
$landing_link = "Landing Promo Mes"; 

//CAPTURA DE PARÁMETROS que pueden venir de un formulario
$encoded = "";
$encoded .= urlencode('action').'=create&';
$encoded .= urlencode('appkey').'='.urlencode($appKey).'&';
$encoded .= urlencode('pilot_firstname').'='.urlencode(request("nombre",false,"n/a")).'&';
$encoded .= urlencode('pilot_lastname').'='.urlencode(request("apellido",false,"")).'&';
$encoded .= urlencode('pilot_phone').'='.urlencode(request("telefono",false,"n/a")).'&';
$encoded .= urlencode('pilot_cellphone').'='.urlencode(request("celular",false,"")).'&';
$encoded .= urlencode('pilot_email').'='.urlencode(request("email",false,"")).'&';
$encoded .= urlencode('pilot_contact_type_id').'='.urlencode('1').'&'; //electronico
$encoded .= urlencode('pilot_business_type_id').'='.urlencode($tipoNegocio).'&'; 
//$encoded .= urlencode('pilot_notes').'='.urlencode(request("comentarios",false,"Sin comentarios");).'&';
$encoded .= urlencode('pilot_notes').'='.urlencode(request("comentarios",false,"Sin comentarios")).'&';

$encoded .= urlencode('pilot_suborigin_id').'='.urlencode($origendeldato).'&';
$encoded .= urlencode('pilot_provider_url').'='.urlencode($landing_link).'&';

$ch = curl_init($serviceURL);
curl_setopt($ch, CURLOPT_FAILONERROR, true); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,  $encoded);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$output = curl_exec($ch);       

curl_close($ch);

echo $output;

}

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
function request($param, $required=true, $default="") {
    $result = $default;
    
    //veo si esta seteado el parametro POST
    if (isset($_POST[$param])) {
        
        if($_POST[$param]!="") {
            $result = $_POST[$param];
        } else {
            if ($required) {
                throw new Exception("El parametro requerido ".$param." no fue seteado");
            }
        
        }
    }
    else if(isset($_GET[$param])) {
        if($_GET[$param]!="") {
            $result = $_GET[$param];
        } else {
            if ($required) {
                throw new Exception("El parametro requerido ".$param." no fue seteado");
            }
        
        }
    }
    else {
        if ($required) {
            throw new Exception("El parametro requerido ".$param." no fue seteado");
        } 
    }
    
    return $result;
}


}