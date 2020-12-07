<?php $xml = simplexml_load_file('http://www.trinidadautofin.com/trinidadtest/aws_consulta_cuota.aspx?wsdl');

$json_string = json_encode($xml);
$result_array = json_decode($json_string, TRUE);

echo "<pre>";
print_r($result_array);die("FIN");