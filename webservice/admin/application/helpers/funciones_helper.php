<?php

	#string
	function remove_accent($str){
		$a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', '?', '?', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', 'Œ', 'œ', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'Š', 'š', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Ÿ', 'Z', 'z', 'Z', 'z', 'Ž', 'ž', '?', 'ƒ', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?', '°');
		$b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'o');
		return str_replace($a, $b, $str);
	}

	function slug($str,$separador = '-'){
		return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'),
		array('', $separador, ''), remove_accent($str)));
	}

	function cortar_frase($text, $limit, $toggle=false) {
		$text = strip_tags($text);
		$words = str_word_count($text, 2);
		$pos = array_keys($words);
		if (count($words) > $limit) {
		  $text_corto = substr($text, 0, $pos[$limit]) . ' ...';
		  if($toggle)
			  $text_corto.= substr($text, $pos[$limit]);
		  return $text_corto;
		}
		return $text;
	}
	
	function br2nl($string){
		$string = preg_replace("<br />", "", $string);
		$string = preg_replace("<br/>", "", $string);
		$string = preg_replace("<br>", "", $string);
		$string = preg_replace("<>", "", $string);
		return $string;
	}
	
	function mejora_comillas($val){
		$val = trim($val);
		$val = str_replace("\'", "'",$val);
		$val = str_replace('\"', '"',$val);
		$val = trim($val);
		return $val;
	}

	function ortografia($val){
		$val = trim($val);
		$val = str_replace("á", "&aacute;",$val);
		$val = str_replace("Á", "&Aacute;",$val);
		$val = str_replace("é", "&eacute;",$val);
		$val = str_replace("É", "&Eacute;",$val);
		$val = str_replace("í", "&iacute;",$val);
		$val = str_replace("Í", "&Iacute;",$val);
		$val = str_replace("ó", "&oacute;",$val);
		$val = str_replace("Ó", "&Oacute;",$val);
		$val = str_replace("ú", "&uacute;",$val);
		$val = str_replace("Ú", "&Uacute;",$val);
		$val = str_replace("ñ", "&ntilde;",$val);
		$val = str_replace("Ñ", "&Ntilde;",$val);
		$val = trim($val);
		return $val;
	}
	
	function print_array($texto){
		echo '<pre>';
		print_r($texto);
		echo '</pre>';
		
	}
	
	function formatear($val){
		$val = trim($val);
		$val = strtolower($val);
		$val = ucwords($val);
		$val = trim($val);
		return $val;
	}
	######################## fin string #############################
	
	########################### fechas ############################
	function mes_corto($fecha, $idioma, $abreviado=true){

		$mes=date("F",mktime(0,0,0,substr($fecha,5, 2),substr($fecha,8,2),substr($fecha,0, 4)));
		
		if($abreviado):
			$arreglo["January"]["1"]='Ene';
			$arreglo["January"]["2"]='Jan';
			$arreglo["February"]["1"]='Feb';
			$arreglo["February"]["2"]='Feb';
			$arreglo["March"]["1"]='Mar';
			$arreglo["March"]["2"]='Mar';
			$arreglo["April"]["1"]='Abr';
			$arreglo["April"]["2"]='Apr';
			$arreglo["May"]["1"]='May';
			$arreglo["May"]["2"]='May';
		
			$arreglo["June"]["1"]='Jun';
			$arreglo["June"]["2"]='Jun';
			$arreglo["July"]["1"]='Jul';
			$arreglo["July"]["2"]='Jul';
			$arreglo["August"]["1"]='Ago';
			$arreglo["August"]["2"]='Aug';
			$arreglo["September"]["1"]='Sep';
			$arreglo["September"]["2"]='Sep';
			$arreglo["October"]["1"]='Oct';
			$arreglo["October"]["2"]='Oct';
			$arreglo["November"]["1"]='Nov';
			$arreglo["November"]["2"]='Nov';
			$arreglo["December"]["1"]='Dic';
			$arreglo["December"]["2"]='Dec';
		else:
			$arreglo["January"]["1"]='Enero';
			$arreglo["January"]["2"]='January';
			$arreglo["February"]["1"]='Febrero';
			$arreglo["February"]["2"]='February';
			$arreglo["March"]["1"]='Marzo';
			$arreglo["March"]["2"]='March';
			$arreglo["April"]["1"]='Abril';
			$arreglo["April"]["2"]='April';
			$arreglo["May"]["1"]='Mayo';
			$arreglo["May"]["2"]='May';
		
			$arreglo["June"]["1"]='Junio';
			$arreglo["June"]["2"]='June';
			$arreglo["July"]["1"]='Julio';
			$arreglo["July"]["2"]='July';
			$arreglo["August"]["1"]='Agosto';
			$arreglo["August"]["2"]='August';
			$arreglo["September"]["1"]='Septiembre';
			$arreglo["September"]["2"]='September';
			$arreglo["October"]["1"]='Octubre';
			$arreglo["October"]["2"]='October';
			$arreglo["November"]["1"]='Noviembre';
			$arreglo["November"]["2"]='November';
			$arreglo["December"]["1"]='Diciembre';
			$arreglo["December"]["2"]='December';
		endif;
		
		return $arreglo[$mes][$idioma];
	}

	function fecha_corta($fecha, $idioma, $abreviado=true){
		
		$ano=substr($fecha,0, 4);
		
		if ((substr($fecha,8,1)=="0") && ($idioma=='2'))
			$dia=substr($fecha,9,1);
		elseif((substr($fecha,8,1)==" "))
			$dia=substr($fecha,9,1);
		else
			$dia=substr($fecha,8,2);	

		$mes_corto = mes_corto($fecha, $idioma, $abreviado);
		
		if ($dia=="1") $eng = "st";
		elseif ($dia=="2") $eng = "nd";
		elseif ($dia=="3") $eng = "rd";
		else $eng = "th";
		
		if($idioma=='2')
			$texto= $mes_corto." ".$dia.$eng.", ".$ano;
		else
			$texto=$dia." ".$mes_corto." ".$ano;		
			
		return($texto);
	}
	
	function fecha_hora_ordenada($date, $idioma){
		return fecha_corta($date, $idioma).' '.extrae_hora($date);
	}
	
	function fechaToCod($fecha){
		$fecha = trim($fecha);
		$fecha = str_replace("-","",$fecha);
		$fecha = str_replace(":","",$fecha);
		$fecha = str_replace(" ","",$fecha);
		$fecha = trim($fecha);
		return $fecha;
	}
	
	function formatearFecha($fecha, $despliegue=false, $separador='-'){
		$fecha = str_replace("/","-",$fecha);
		if(!$fecha)
			return "Sin dato.";
		if($despliegue):
			$new_fecha = explode(' ',$fecha);
			$new_fecha = explode('-',$new_fecha[0]);
			return $new_fecha[2].$separador.$new_fecha[1].$separador.$new_fecha[0];
		else:
			$new_fecha = explode('-',$fecha);
			return $new_fecha[2].$separador.$new_fecha[1].$separador.$new_fecha[0];
		endif;
	}

	function fechas_periodo($fecha_ini, $fecha_fin){
		$fecha_ini_formato = explode('-', formatearFecha($fecha_ini,true));
		$fecha_fin_formato = explode('-', formatearFecha($fecha_fin,true));
		$fecha_ini_anio = $fecha_ini_formato[2];
		$fecha_fin_anio = $fecha_fin_formato[2];
		$fecha_anio = array('ini'=>'', 'fin'=>'');
		if($fecha_ini_anio == $fecha_fin_anio):
			$fecha_anio['fin'] = $fecha_fin_anio;
		else:
			$fecha_anio['ini'] = $fecha_ini_anio;
			$fecha_anio['fin'] = $fecha_fin_anio;
		endif;
		return $fecha_ini_formato[0].' '.mes_corto($fecha_ini,1).' '.$fecha_anio['ini'].' al '.$fecha_fin_formato[0].' '.mes_corto($fecha_fin,1).' '.$fecha_anio['fin'];
	}

	function invierte_fecha($fecha,$separador = "-"){
		$fecha = explode(" ",$fecha);
		$fecha_x = str_replace("/", "-", $fecha[0]);
		$f_array = explode("-", $fecha_x);
		return $f_array[2].$separador.$f_array[1].$separador.$f_array[0];
	}

	function fecha_real($fecha, $idioma='es',$separador=' de ')
	{
		$meses = array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
		$months = array('janary','february','march','april','may','june','july','august','september','october','november','december');
		
		// $ano = substr($fecha,0,2);
		// $mes = substr($fecha,5,2);
		// $dia = substr($fecha,8,2);
		list($ano, $mes, $dia) = explode("-", $fecha);
		if($idioma=='es'){
			$fecha = $dia.$separador.$meses[(int)$mes-1];
			if($ano!='') $fecha.= $separador.$ano;
		}
		elseif($idioma=='en'){
			$fecha = $months[(int)$mes-1].' '.$dia;
			if($ano!='') $fecha.= ", ".$ano;
		}
		return $fecha;
	}
	############################# fin fechas ###############################
	
	############################# hora ##############################
	function extrae_hora($time, $campo=''){
		$delFech = explode (' ', $time);
		$times   = explode (':',$delFech[1]);
		if(empty($campo)):
			return $times[0].':'.$times[1];
		elseif($campo=='hora'):
				return $times[0];
			elseif($campo=='minuto'):
					return $times[1];
		endif;
	}
	############################# fin hora ###############################
	
	############################# sql ################################
	function Sqlinjection($val){
		$val = trim($val);
		$val = str_replace("<", "&lt;",$val);
		$val = str_replace(">", "&gt;",$val);
		$val = str_replace("/", "&#8260;",$val);
		$val = str_replace("\'", "'",$val);
		$val = str_replace('\"', '"',$val);
		$val = str_replace("\"", "&quot;",$val);
		$val = str_replace("'", "&sbquo;",$val);
		$val = trim($val);
		return $val;
	}
	################################### fin sql ################################
	
	################################ print #################################
	function debug($data, $debug=false){
		if(is_array($data) or is_object($data)){
			echo "<pre style=\"font-size:13px;\">";print_r($data);echo "</pre>";
		}else{
			echo "<p style=\"font-size:13px;\">".$data."</p>";
		}
		if($debug){
			echo "<p style=\"font-size:13px;\"><b><i>Break de sistema.</i></b></p>";
			die();
		}
	}

	function echo_br($text, $die=false){
		echo "<p>$text</p>";
		if($die)
			die("Break de ejecuci&oacute;n");
	}

	function mensaje($mensaje,$tipo){
		return '<p><a style="cursor:pointer; float:right; margin-right:10px;" onclick="cerrarDialogo(\''.$tipo.'\')">cerrar</a>'.$mensaje.'</p>';
	}
	########################## fin print #####################################
	
	########################## numeros #######################################
	function toFormat($numero){
		$num = str_replace('.','',$numero);
		$num = str_replace(',','.',$num);
		return $num;
	}

	function num_format($value,$dec=false){

		$pieces = explode(".", $value);
		if(isset($pieces[1])){
		   $decimales = ($dec!==false) ? $dec:strlen($pieces[1]);  
		   return number_format($value,$decimales,',','.');
		}else{
			return number_format($value,0,',','.');
		}
	}
	
	function formatearValor($valor, $despliegue = true){
		if($despliegue):
			return number_format($valor,0,'','.');
		else:
			$valor = trim($valor);
			$valor = str_replace('.','',$valor);
			$valor = str_replace(',','',$valor);
			$valor = str_replace('$','',$valor);
			$valor = str_replace(' ','',$valor);
			$valor = trim($valor);
			return $valor;
		endif;
	}
	########################## fin numeros ############################

	
	########################## files #############################
	function crear_directorio($ruta,$ftp){
		if(!is_array($ruta)){
			$rutas = array($ruta);
		}else{
			$rutas = $ruta;
		}
		foreach($rutas as $ruta){
			$url = '';
			$rutaDirectorios=explode("/",$ruta);
			$fin=0;
			$i=1;
			while ($fin==0){
				if($rutaDirectorios[$i]==''){
					$fin=1;
				}else{
					$url.="/".$rutaDirectorios[$i];
					if (!file_exists(url_file($url))){
						if($ftp){
							mkdirSafeMode($url,$ftp);
						}else{
							mkdir(url_file($url), 0777);
						}
					}
				}
				++$i;
			}
		}
		return true;
	}

	function mkdirSafeMode($dir,$ftp){
		$conn_id = ftp_connect($ftp["server"] );
		if( ftp_login( $conn_id, $ftp["user"], $ftp["password"] ) ){  
			if(!file_exists(url_file($dir))){
				if (ftp_mkdir($conn_id, '/public'.$dir)) {
					ftp_chmod( $conn_id, 0777, '/public'.$dir );//permisos de lectura/escritura/ejecución
					ftp_close( $conn_id );
					return true;
				}else{
					ftp_close( $conn_id );
					return false;
				}
			 }
		}else{
			ftp_close( $conn_id );
			return false;
		}
	}

	function url_file($url){
		return $_SERVER['DOCUMENT_ROOT'].$url;
	}

	function delete_carpeta($dir,$ftp=false){
		if($ftp){
			$conn_id = ftp_connect($ftp["server"] );
			if( ftp_login( $conn_id, $ftp["user"], $ftp["password"] ) ){  
				if(is_dir(url_file($dir))){
					$objects = scandir(url_file($dir));
					foreach ($objects as $object){
						if($object != "." && $object != ".."){
							if(filetype(url_file($dir)."/".$object) == "dir")
								delete_carpeta($dir."/".$object);
							else
								ftp_delete($conn_id, "/public".$dir."/".$object);
						}
					}
					reset($objects);
					ftp_rmdir($conn_id, "/public".$dir);
					ftp_close( $conn_id );
					return true;
				}else{
					ftp_close( $conn_id );
					return false;
				}
			}else{
				ftp_close( $conn_id );
				return false;
			}
		}else{
			if(is_dir($dir)){
				$objects = scandir($dir);
				foreach ($objects as $object){
					if($object != "." && $object != ".."){
						if(filetype($dir."/".$object) == "dir"){
							deleteCarpeta($dir."/".$object);
						}else{
							unlink($dir."/".$object);
						}
					}
				}
				reset($objects);
				rmdir($dir);
				return true;
			}else{
				return false;
			}
		}
	}

	function delete_archivo($dir,$ftp){
		$conn_id = ftp_connect($ftp["server"] );
		if( ftp_login( $conn_id, $ftp["user"], $ftp["password"] ) ){  
			if(file_exists(url_file($dir))){
				ftp_delete($conn_id, "/public".$dir);
			}
			ftp_close( $conn_id );
			return true;
		}
		return false;
	}

	function copy_file($file_server_name,$file_local_name,$ftp){
		$result = false;
		$conn_id = ftp_connect($ftp["server"] );
		if( ftp_login( $conn_id, $ftp["user"], $ftp["password"] ) ){  
			if (ftp_put($conn_id, "/public".$file_local_name, $file_server_name, FTP_BINARY)) {
				$result = true;
			} else {
				$result = false;
			}
			ftp_close($conn_id);
		}
		return $result;
	}

	function size_file($peso , $decimales = 2 ) {
		$clase = array(" Bytes", " KB", " MB", " GB", " TB"); 
		return round($peso/pow(1024,($i = floor(log($peso, 1024)))),$decimales ).$clase[$i];
	}

	function delete_extension($name_file){
		$x = explode('.',$name_file);
		unset($x[count($x)-1]);
		return strtolower(implode('.',$x));
	}
	function name_file($file){
		$r = pathinfo($file);
		return $r['filename'];
	}
	function extension($name_file){
		$r = pathinfo($name_file);
		return strtolower($r['extension']);
	}

	function remote_file_size ($url){ 
		$head = ""; 
		$url_p = parse_url($url); 
		$host = $url_p["host"]; 
		if(!preg_match("/[0-9]*\.[0-9]*\.[0-9]*\.[0-9]*/",$host)){
			// a domain name was given, not an IP
			$ip=gethostbyname($host);
			if(!preg_match("/[0-9]*\.[0-9]*\.[0-9]*\.[0-9]*/",$ip)){
				//domain could not be resolved
				return -1;
			}
		}
		$port = intval($url_p["port"]); 
		if(!$port) $port=80;
		$path = $url_p["path"]; 

		$fp = fsockopen($host, $port, $errno, $errstr, 20); 
		if(!$fp) { 
			return false; 
		} else { 
			fputs($fp, "HEAD "  . $url  . " HTTP/1.1\r\n"); 
			fputs($fp, "HOST: " . $host . "\r\n"); 
			fputs($fp, "User-Agent: http://www.example.com/my_application\r\n");
			fputs($fp, "Connection: close\r\n\r\n"); 
			$headers = ""; 
			while (!feof($fp)) { 
				$headers .= fgets ($fp, 128); 
			} 
		} 
		fclose ($fp); 
		$return = -2; 
		$arr_headers = explode("\n", $headers); 
		foreach($arr_headers as $header) { 
			$s1 = "HTTP/1.1"; 
			$s2 = "Content-Length: "; 
			$s3 = "Location: "; 
			if(substr(strtolower ($header), 0, strlen($s1)) == strtolower($s1)) $status = substr($header, strlen($s1)); 
			if(substr(strtolower ($header), 0, strlen($s2)) == strtolower($s2)) $size   = substr($header, strlen($s2));  
			if(substr(strtolower ($header), 0, strlen($s3)) == strtolower($s3)) $newurl = substr($header, strlen($s3));  
			} 
		if(intval($size) > 0) {
			$return=intval($size);
		} else {
			$return=$status;
		}
		if (intval($status)==302 && strlen($newurl) > 0) {
			// 302 redirect: get HTTP HEAD of new URL
			$return=remote_file_size($newurl);
		}
		return size_file($return);
	}
	######################### fin files #######################
	
	
	####################### otras #############################
	
	function formatearRut($rut, $despleigue=false){
		$rut = trim($rut);
		
		if($despleigue):
			$rut=str_replace(".","",trim($rut));
			$rut=str_replace("-","",trim($rut));
			$rut=str_replace(" ","",trim($rut));
			$only_rut = number_format(substr($rut,0,-1),0,'','.');
			$only_dig = strtolower(substr($rut,-1,strlen($rut)-1));
			$rut = $only_rut.'-'.$only_dig;
		else:
			$rut = str_replace('.','',$rut);
			$rut = str_replace('-','',$rut);
			$rut = strtolower($rut);
		endif;
		return $rut;
	}

	function TotalPaginas($Total, $numXpag){
		$i=0;
		do{
			$i+=$numXpag;
			if($Total <= $i){
				$TotalPag = $i / $numXpag;
				$resp = false;
			}else{
				$resp = true;
			}
		}while($resp);
		return $TotalPag;
	}

	function url_sin_pagina($url){
		$url_array = explode("/",substr($url,1));
		$url_str = "/";
		for($i=0; $i<(count($url_array)-1); $i++){
			$url_str.=$url_array[$i]."/";
		}
		return $url_str;
	}

	function crea_enlaces($text){
		$text = str_replace(array("http://","https://"),"",$text);
		return (!empty($text)) ? "http://".$text : false ;
	}

	function closeColorbox() {
		echo "<script>parent.location.reload();parent.$.fn.colorbox.close();</script>";
	}
	

?>