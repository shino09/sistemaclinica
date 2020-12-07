<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class Pilot extends CI_Controller {

    //public $permisos;
	function __construct(){

		parent::__construct();

        //principal
		$this->id_modulo = 14;
        $this->prefijo_pri = "kin_";
        $this->title_gen_plu = "pilot";
        $this->title_gen_sin = "piloth";
        $this->nombre_gen_plu = "pilot";
        $this->nombre_gen_sin = "piloth";

     
        #revisa los permisos para el modulo mantenedores
        #$this->permisos = $this->layout->obtener_permisos(5);

        //if(!$this->permisos)
         //   redirect('/');
	}

	public function index()	{
	   
       
		#Title
		$this->layout->title('Mantenedores');

		#JS - Multiple select
		$this->layout->css('/js/jquery/bootstrap/bootstrap-multi-select/dist/css/bootstrap-select.css');
		$this->layout->js('/js/jquery/bootstrap/bootstrap-multi-select/js/bootstrap-select.js');

		$this->layout->js('/js/jquery/noty/packaged/jquery.noty.packaged.js');
		$this->layout->js('/js/jquery/validation-engine/js/jquery.validationEngine.js');
		$this->layout->js('/js/jquery/validation-engine/js/languages/jquery.validationEngine-en.js');

		$this->layout->js('/js/sistema/mantenedores/'.$this->nombre_gen_plu.'/administrar.js');

		#JS - pagination
		$this->layout->js('/js/jquery/rpage-master/responsive-paginate.js');
		$this->layout->js('/js/jquery/rpage-master/paginate-init.js');

		#Nav
		$this->layout->nav(array("Mantenedores: ".$this->title_gen_plu.""=>"/"));

		$data = false;$where = false;$url = false;
		$url_busqueda = false;
		$url_estado = false;

		$data['pilot_f'] = false;

        $estado=false;$buscar=false;
		$data['estado']=$estado;
		$data['buscar']=$buscar;
        
		if($this->uri->segment(3)=='busqueda'){
			$url_busqueda = 'busqueda/'.$this->uri->segment(4).'/';
			$data['pilot_f'] = $this->uri->segment(4);
			$where = "(".$this->prefijo_pri."nombre like '".$this->uri->segment(4)."%' or ".$this->prefijo_pri."nombre like '%".$this->uri->segment(4)."' or ".$this->prefijo_pri."nombre like '%".$this->uri->segment(4)."%')";
			$config['uri_segment'] = $segment = 5;
		}

		if($this->uri->segment(3)=='estado'){
			$url_busqueda = 'estado/'.$this->uri->segment(4).'/';
			$data['estado_f'] = $this->uri->segment(4);
			$where = $this->prefijo_pri."estado = '".$this->uri->segment(4)."'";
			$config['uri_segment'] = $segment = 5;
		}
		if($this->uri->segment(5)=='estado'){
			$url_busqueda = $url_busqueda.'estado/'.$this->uri->segment(6).'/';
			$data['estado_f'] = $this->uri->segment(6);
			$where .= " and ".$this->prefijo_pri."estado = '".$this->uri->segment(6)."'";
			$config['uri_segment'] = $segment = 7;
		}

		if(!$url_busqueda){
			$config['uri_segment'] = $segment = 3;
		}
		$config['base_url'] = '/mantenedores/'.$this->nombre_gen_plu.'/'.$url_busqueda;

        
           #echo $where; die;      
        
        
		#paginacion
		$config['base_url'] = '/mantenedores/'.$this->nombre_gen_plu.'/'.$url_busqueda;
		
		$config['total_rows'] = count($this->ws->listar($this->id_modulo,$where));
		$config['per_page'] = 15;
        $config['num_links'] = 30;
		$config['suffix'] = $url;
		$config['first_url'] = '/mantenedores/'.$this->nombre_gen_plu.'/'.$url_busqueda;

		$config['next_link'] = '>>';//siguiente link
 		$config['prev_link'] = '<<';//anterior link
		$this->pagination->initialize($config);
		$page = ($this->uri->segment($segment))?$this->uri->segment($segment)-1:0;

		#contenido
		$this->ws->limit($config["per_page"],$page*$config["per_page"]);
        
		$data["datos"] = $this->ws->listar($this->id_modulo,$where);
    //print_array($data["datos"]);die;
		$data['pagination'] = $this->pagination->create_links();

		//Centro de costos

		#La vista siempre,  debe ir cargada al final de la función
		$this->layout->view('/'.$this->nombre_gen_plu.'/index',$data);
	}

	public function administrar($codigo = false){

        #permisos del usuario
        //if(!$this->permisos->agregar && !$this->permisos->editar)
        //    redirect('/mantenedores/'.$this->nombre_gen_plu.'/');

		#Title
		$this->layout->title('Mantenedores');

		#JS - Form elements
		$this->layout->js('/js/jquery/form-elements/custom-form-elements.min.js');
		$this->layout->css('/js/jquery/form-elements/form.css');

		#JS - Calendario
		$this->layout->js('/js/jquery/bootstrap/datepicker/bootstrap-datepicker.js');
		$this->layout->css('/js/jquery/bootstrap/datepicker/datepicker3.css');

		#JS - Multiple select
		$this->layout->css('/js/jquery/bootstrap/bootstrap-multi-select/dist/css/bootstrap-select.css');
		$this->layout->js('/js/jquery/bootstrap/bootstrap-multi-select/js/bootstrap-select.js');

		$this->layout->js('/js/jquery/noty/packaged/jquery.noty.packaged.js');
		$this->layout->js('/js/jquery/validation-engine/js/jquery.validationEngine.js');
		$this->layout->js('/js/jquery/validation-engine/js/languages/jquery.validationEngine-es.js');

		$this->layout->js('/js/sistema/mantenedores/'.$this->nombre_gen_plu.'/administrar.js');

		#Nav
		if($codigo)
			$this->layout->nav(array("Mantenedores: $this->title_gen_plu"=>"mantenedores/$this->nombre_gen_plu", "Mantenedores: Editar $this->title_gen_sin"=>"/"));
		else
			$this->layout->nav(array("Mantenedores: $this->title_gen_plu"=>"mantenedores/$this->nombre_gen_plu", "Mantenedores: Agregar $this->title_gen_sin"=>"/"));

		$data = false;
		if($codigo)
			$data["dato"] = $this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo = {$codigo}");

   
      //print_array($data);die;
		#La vista siempre,  debe ir cargada al final de la función
		$this->layout->view('/'.$this->nombre_gen_plu.'/administrar',$data);
	}


	public function process($codigo = false){
		//print_array($this->input->post());die('opkokoj');
		$datos = $this->input->post();

$pilot_firstname = $datos["pilot_firstname"];
$pilot_lastname = $datos["pilot_lastname"];

$pilot_phone = $datos["pilot_phone"];

$pilot_cellphone = $datos["pilot_cellphone"];

$pilot_email = $datos["pilot_email"];

$pilot_notes = $datos["pilot_notes"];
$pilot_contact_type_id = $datos["pilot_contact_type_id"];

$pilot_business_type_id = $datos["pilot_business_type_id"];

/*
$serviceURL = "//api.pilotsolution.com.ar/webhooks/welcome.php";
$appKey = "9715fc4b-17a8-4e56-ac7a-6deb5fd46u71"; 
$tipoNegocio = "1";  
$origendeldato = "7A2E4184"; 
$landing_link = "Landing Promo Mes"; 
*/

// *****************  PARAMETROS A MODIFICAR  ****************************************************//
$appKey = "9715fc4b-17a8-4e56-ac7a-6deb5fd46u71"; //aqui la key de la instancia correspondiente 
$codigoDeOrigenDelDato = "7A2E4184";  // poner codigo de origen de pilot en el administrador EJ: 345534
$landing_link = "Landing Promo Mes"; //link de la landing EJ: www.landingejemplo.com.ar/landing.html
$serviceURL = "http://www.pilotsolution.com.ar/api/webhooks/welcome.php";
$debug = 0;   //1 para indicar que es prueba y que no inserte el dato en el sistema.
// ***********************************************************************************************//

$PARAMETRO_REQUERIDO = true; 
$PARAMETRO_NO_REQUERIDO = false; 

$envio=0;

try {

						
	//CAPTURA DE PARAMETROS que pueden venir de un formulario
	$payload = "";
	$payload .= 'action=create';
	$payload .= '&debug='.$debug;
	$payload .= '&appkey='.$appKey;
	$payload .= '&pilot_firstname='.urlencode($pilot_firstname);
	$payload .= '&pilot_lastname='.urlencode($pilot_lastname); 

	//************************************************************************************************************
	//AL MENOS UNO DE ESTOS PARAMETROS DEBER SER INFORMADO PARA QUE EL DATO INGRESE CORRETAMENTE Y NO SE RECHAZADO
	//************************************************************************************************************ 
	$payload .= '&pilot_phone='.urlencode($pilot_phone);
	$payload .= '&pilot_cellphone='.urlencode($pilot_cellphone);
	$payload .= '&pilot_email='.urlencode($pilot_email);
	//************************************************************************************************************

	$payload .= '&pilot_contact_type_id='.urlencode($pilot_contact_type_id);
	$payload .= '&pilot_business_type_id='.urlencode($pilot_business_type_id);
	$payload .= '&pilot_notes='.urlencode($pilot_notes);
	$payload .= '&pilot_suborigin_id='.$codigoDeOrigenDelDato;
	$payload .= '&pilot_landing_link='.$landing_link;

	$output = $this->posturl($serviceURL, $payload);       
	
		echo "<pre>"; 

	echo 'enviando arreglo mediante recivido desde formulario aeurus a webserce pilot mediante curl_setopt';
	echo "</pre>"; 

	print_array($payload);

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
	$envio=1;


} catch (Exception $e) {
		
	echo $e->getMessage();
		
}

			/*if($envio==1){
				 echo json_encode(array("result"=>true,"msj"=>"Datos Enviados Correctamente."));
				}else{
					echo json_encode(array("result"=>false,"msj"=>"No se recibieron datos."));}*/






	}




public function posturl($url, $payload){

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

		/*public function process2($codigo = false){
		//print_array($this->input->post());die('opkokoj');
		$datos = $this->input->post();



$pilot_firstname = $datos["pilot_firstname"];
$pilot_lastname = $datos["pilot_lastname"];

$pilot_phone = $datos["pilot_phone"];

$pilot_cellphone = $datos["pilot_cellphone"];

$pilot_email = $datos["pilot_email"];

$pilot_notes = $datos["pilot_notes"];
$pilot_contact_type_id = $datos["pilot_contact_type_id"];

$pilot_business_type_id = $datos["pilot_business_type_id"];


$serviceURL = "//api.pilotsolution.com.ar/webhooks/welcome.php";
$appKey = "9715fc4b-17a8-4e56-ac7a-6deb5fd46u71"; 
$tipoNegocio = "1";  
$origendeldato = "7A2E4184"; 
$landing_link = "Landing Promo Mes"; 


$encoded = "";

$encoded .= urlencode('pilot_firstname').'='.urlencode($pilot_firstname).'&';
$encoded .= urlencode('pilot_lastname').'='.urlencode($pilot_lastname).'&';
$encoded .= urlencode('pilot_phone').'='.urlencode($pilot_phone).'&';
$encoded .= urlencode('pilot_cellphone').'='.urlencode($pilot_cellphone).'&';
$encoded .= urlencode('pilot_email').'='.urlencode($pilot_email).'&';
$encoded .= urlencode('pilot_contact_type_id').'='.urlencode($pilot_contact_type_id).'&'; //electronico
$encoded .= urlencode('pilot_business_type_id').'='.urlencode($pilot_business_type_id).'&'; 
$encoded .= urlencode('pilot_notes').'='.urlencode($pilot_notes).'&';

$ch = curl_init($serviceURL);
curl_setopt($ch, CURLOPT_FAILONERROR, true); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,  $encoded);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
print($ch);die('ch');

$output = curl_exec($ch);       

curl_close($ch);

echo $output;
die('imprimio');


	}*/


	public function eliminar(){

    try{
			$eliminar = $this->ws->eliminar($this->id_modulo,$this->prefijo_pri."codigo = {$this->input->post('codigo')}");
			echo json_encode(array("result"=>true));
		}
		catch(Exception $e){
			echo json_encode(array("result"=>false,"msg"=>"Ha ocurrido un error inesperado. Por favor, inténtelo nuevamente."));
		}
	}

 


 
// Levanta los parámetros por post o get
public function request($param, $required=true, $default="")
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
}
