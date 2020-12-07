<?php
//VARIABLES DE CONFIGURACION
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
$encoded .= urlencode('pilot_notes').'='.urlencode(request("comentarios",false,"Sin comentarios");).'&';
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

die() ;
        
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
?>