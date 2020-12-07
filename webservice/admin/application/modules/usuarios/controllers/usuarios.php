<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
    
    private $nombre_db = 'wsbeneplus';
	function __construct(){
		parent::__construct();
        
        #si no está logeado no puede estar acá
        if(!$this->session->userdata('usuario'))
            redirect('/');
            
        #models
        $this->load->model('tablas/tabla_model','objTabla');
        $this->load->model('tablas/campo_model','objCampo');
        $this->load->model('usuario_model','objUsuario');
        $this->load->model('permiso_model','objPermiso');
        
        $this->layout->current = 5;
    
	}
	
	public function index()
	{
        #title
		$this->layout->title('Cuentas de usuario');
		
		#js
		$this->layout->js("/js/sistema/usuarios/index.js");
		
		$where = $and = $contenido['q_f'] = '';
		$url = '/';
		if($this->input->get('q')){
			$contenido['q_f'] = $busqueda = $this->input->get('q');
			$where = "(usua_nombre like '%$busqueda%')";
            $and = ' and ';
		}
        
        $url = explode('?',$_SERVER['REQUEST_URI']);
        if(isset($url[1]))
            $url = '/?'.$url[1];
		else
			$url = '/';
		
		#paginacion
		$config['base_url'] = base_url().'/usuarios/';
		$config['total_rows'] = count($this->objUsuario->listar($where));
		$config['per_page'] = 15;
		$config['uri_segment'] = $segment = 2;
		$config['suffix'] = $url;
		$config['first_url'] = base_url().'/usuarios'.$url;
		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment($segment))?$this->uri->segment($segment)-1:0;
		
		#nav
		$this->layout->nav(array("Cuentas de usuario"=>'/'));
			
		#contenido
		$contenido['usuarios'] = $this->objUsuario->listar($where,$config["per_page"],$page*$config["per_page"]);
		$contenido['pagination'] = $this->pagination->create_links();
		
		$this->layout->view('index',$contenido);
           
    }
    
    public function crear(){
        
        if($this->input->post()){
            #validaciones
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			
			$this->form_validation->set_message('required', '* %s es obligatorio');
			$this->form_validation->set_error_delimiters('<div>','</div>');
			
			if(!$this->form_validation->run()){
				echo json_encode(array("result"=>false,"msg"=>validation_errors()));
				exit;
			}
			else{
                
                #verifica que el nombre de usuario no sea reservado
                $reservados = array("user","usuario","users","usuarios");
                foreach($reservados as $aux){
                    if(strpos($this->input->post('nombre'), $aux) !== false){
                        echo json_encode(array("result"=>false,"msg"=>"El nombre del usuario es una palabra reservada"));
                        exit;
                    }
                }
                
                #verifica que el usuario no exista
                if($this->objUsuario->obtener(array("usua_nombre"=>$this->input->post('nombre')))){
                    echo json_encode(array("result"=>false,"msg"=>"El nombre del usuario ya existe"));
                    exit;
                }
                
                $codigo = $user['usua_codigo'] = $this->objUsuario->nextId();
                $user['usua_nombre'] = $this->input->post('nombre');
                $nombredb = $user['usua_nombre_db'] = slug($this->input->post('nombre'),'_');
                $contrasena = $user['usua_contrasena'] = $this->input->post('contrasena');
                
                #guarda la nueva key
                $key['api_key'] = md5(uniqid(time(), TRUE).$codigo);
                $key['date_created'] = time();
                $this->objUsuario->agregar_key($key);
                
                $key_id = $this->objUsuario->obtener_key(array("api_key"=>$key['api_key']));
                $user['ke_id'] = $key_id->codigo;
                
                #guarda el usuario
                $this->objUsuario->agregar($user);
                
                #guarda los permisos de los campos
                if($campos = $this->input->post('campos')){
                    foreach($campos as $aux){
                        $permisosCampos = $this->input->post('permisos-campos-'.$aux);
                        foreach($permisosCampos as $perm){
                            if($perm != 4){ #los campos no tienen permisos para eliminar
                                unset($datos);
                                $datos['perm_codigo'] = $perm;
                                $datos['usua_codigo'] = $codigo;
                                $datos['cam_codigo'] = $aux;
                                $this->objUsuario->agregar_permiso_campo($datos);
                            }
                        }
                    }
                }
                
                #generar SQL para crear usuario con permisos
                $permisosGeneral = ''; 
                $tablas = $this->input->post('tablas');
                foreach($tablas as $aux){
                    $permisos = $coma = ''; 
                    $tabla = $this->objTabla->obtener_por_codigo($aux);
                    $permisosTablas = $this->input->post('permisos-tablas-'.$aux);
                    foreach($permisosTablas as $perm){
                        $permiso = $this->objPermiso->obtener_por_codigo($perm);
                        $permisos .= $coma.$permiso->permiso;
                        $coma = ', ';
                        
                        #guarda los permisos de las tablas
                        unset($datos);
                        $datos['perm_codigo'] = $perm;
                        $datos['usua_codigo'] = $codigo;
                        $datos['tab_codigo'] = $aux;
                        $this->objUsuario->agregar_permiso_tabla($datos);
                    }
                    
                    $permisosGeneral .= " GRANT ".$permisos.' ON '.$this->nombre_db.'.'.$tabla->nombre_tabla." TO '".$nombredb."'@'%' IDENTIFIED BY '".$contrasena."' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0; ";
                }
                
                $sql = "CREATE USER '".$nombredb."'@'%' IDENTIFIED BY '".$contrasena."'; ".$permisosGeneral;
                
                /*"CREATE USER 'pruebaRodrigo'@'localhost' 
                IDENTIFIED BY '***';
                GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'pruebaRodrigo'@'localhost' IDENTIFIED BY '***' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
                GRANT ALL PRIVILEGES ON `wsbeneplus`.* TO 'pruebaRodrigo'@'localhost';";
                */
                
                //$this->objUsuario->query($sql);
              
                echo json_encode(array("result"=>true));
			}
        }
        else{
            
            #title
            $this->layout->title('Crear Cuenta de usuario');

    		#js
    		$this->layout->js("/js/sistema/usuarios/crear.js");
            
            #contenido
            $contenido['tablas'] = $this->objTabla->listar("tab_vista = 0");
            $contenido['vistas'] = $this->objTabla->listar("tab_vista = 1");
            $contenido['permisos'] = $this->objPermiso->listar();
            
            #nav
            $this->layout->nav(array("Cuentas de usuario"=>'usuarios',"Crear"=>""));
            
            #view
            $this->layout->view('crear',$contenido);
        }
    }
    
    public function editar($codigo){
        
        if($this->input->post()){
            #validaciones
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			
			$this->form_validation->set_message('required', '* %s es obligatorio');
			$this->form_validation->set_error_delimiters('<div>','</div>');
			
			if(!$this->form_validation->run()){
				echo json_encode(array("result"=>false,"msg"=>validation_errors()));
				exit;
			}
			else{
                
                #verifica que el nombre de usuario no sea reservado
                $reservados = array("user","usuario","users","usuarios");
                foreach($reservados as $aux){
                    if(strpos($this->input->post('nombre'), $aux) !== false){
                        echo json_encode(array("result"=>false,"msg"=>"El nombre del usuario es una palabra reservada"));
                        exit;
                    }
                }
                
                #verifica que el usuario no exista
                $nombre = $this->input->post('nombre');
                if($this->objUsuario->obtener("usua_nombre = '$nombre' and usua_codigo <> $codigo")){
                    echo json_encode(array("result"=>false,"msg"=>"El nombre del usuario ya existe"));
                    exit;
                }
                
                $user['usua_nombre'] = $this->input->post('nombre');
                $nombredb = $user['usua_nombre_db'] = slug($this->input->post('nombre'),'_');
                if($this->input->post('contrasena'))
                    $contrasena = $user['usua_contrasena'] = $this->input->post('contrasena');
                
                #guarda el usuario
                $this->objUsuario->actualizar($user,array("usua_codigo"=>$codigo));
                
                #guarda los permisos de los campos
                $this->objUsuario->eliminar_permiso_campo(array("usua_codigo"=>$codigo));
                if($campos = $this->input->post('campos')){
                    foreach($campos as $aux){
                        $permisosCampos = $this->input->post('permisos-campos-'.$aux);
                        foreach($permisosCampos as $perm){
                            unset($datos);
                            $datos['perm_codigo'] = $perm;
                            $datos['usua_codigo'] = $codigo;
                            $datos['cam_codigo'] = $aux;
                            $this->objUsuario->agregar_permiso_campo($datos);
                        }
                    }
                }
                
                #generar SQL para crear usuario con permisos
                $permisosGeneral = ''; 
                $tablas = $this->input->post('tablas');
                $this->objUsuario->eliminar_permiso_tabla(array("usua_codigo"=>$codigo));
                foreach($tablas as $aux){
                    $permisos = $coma = ''; 
                    $tabla = $this->objTabla->obtener_por_codigo($aux);
                    $permisosTablas = $this->input->post('permisos-tablas-'.$aux);
                    foreach($permisosTablas as $perm){
                        $permiso = $this->objPermiso->obtener_por_codigo($perm);
                        $permisos .= $coma.$permiso->permiso;
                        $coma = ', ';
                        
                        #guarda los permisos de las tablas
                        unset($datos);
                        $datos['perm_codigo'] = $perm;
                        $datos['usua_codigo'] = $codigo;
                        $datos['tab_codigo'] = $aux;
                        $this->objUsuario->agregar_permiso_tabla($datos);
                    }
                    
                   // $permisosGeneral .= " GRANT ".$permisos.' ON '.$this->nombre_db.'.'.$tabla->nombre_tabla." TO '".$nombredb."'@'%' IDENTIFIED BY '".$contrasena."' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0; ";
                }
                
                //$sql = "CREATE USER '".$nombredb."'@'%' IDENTIFIED BY '".$contrasena."'; ".$permisosGeneral;
                
                /*"CREATE USER 'pruebaRodrigo'@'localhost' 
                IDENTIFIED BY '***';
                GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'pruebaRodrigo'@'localhost' IDENTIFIED BY '***' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
                GRANT ALL PRIVILEGES ON `wsbeneplus`.* TO 'pruebaRodrigo'@'localhost';";
                */
                
                //$this->objUsuario->query($sql);
              
                echo json_encode(array("result"=>true));
			}
        }
        else{
            
            if($contenido['usuario'] = $this->objUsuario->obtener_por_codigo($codigo));
            else show_error('Página no encontrada');
            
            #title
            $this->layout->title('Editar Cuenta de usuario');

    		#js
    		$this->layout->js("/js/sistema/usuarios/editar.js");
            
            #contenido
            $contenido['tablas'] = $this->objTabla->listar("tab_vista = 0");
            $contenido['vistas'] = $this->objTabla->listar("tab_vista = 1");
            $contenido['permisos'] = $this->objPermiso->listar();
            
            #nav
            $this->layout->nav(array("Cuentas de usuario"=>'usuarios',"Editar"=>""));
            
            #view
            $this->layout->view('editar',$contenido);
        }
    }
    
    public function eliminar(){
        if($this->input->post()){
            $codigo = $this->input->post('codigo');
            $where = "usua_codigo = $codigo";

            $usuario = $this->objUsuario->obtener_por_codigo($codigo);
            $this->objUsuario->actualizar(array("usua_visible"=>0),$where);

            #guarda la accion en el historial
            $this->load->model('historial/historial_model','objHistorial');
            $comentario = "El usuario <b>".$usuario->nombre."</b> ha sido eliminado";
            $historial['his_codigo'] = $this->objHistorial->nextId();
            $historial['his_comentario'] = $comentario;
            $historial['his_fecha'] = date('Y-m-d H:i:s');
            $historial['hia_codigo'] = 5;
            $historial['usua_codigo'] = $codigo;
            $this->objHistorial->agregar($historial);
            
            
            echo json_encode(array("result"=>true));
        }
    }
    
    public function exportar_pdf_old($codigo){
        
        require APPPATH."libraries/mpdf_6/mpdf.php";

        if($codigo){
			$url_ws = $_SERVER['HTTP_HOST'].'/webservice/api/';
			
            $usuario = $this->objUsuario->obtener_por_codigo($codigo);
            $modulos = $this->objUsuario->tablas_usuario($codigo);

	        $cuerpo = '<!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <title>WebService</title>
                    <style>
                        body, html {
                        	font-family: \'Verdana\';
                        }
                        .codigo{
                        	background-color: #f5f5f5;
                        	border: 1px solid black;
                        	padding: 15px;
                        	color: #333333;
                        	font-size: 11px;
                        	font-family: \'Verdana\';
                        }
                        
                        .defecto {
                        	font-style: italic;
                        	font-size: 10px;
                        }
                        
                        .block {
                        	display: block;
                        	margin-bottom: 20px;
                        }
                        
                        .ejemplo {
                        	font-family: \'Verdana\';
                        	font-size: 10.5px;
                        	text-decoration: underline;
                        	font-weight: bold;
                        	display: block;
                        	margin: 5px;
                        }
                        ul > li {
                        	margin-top: 10px;
                        }
                    </style>
                </head>
                <body>
		          <h1>Web Service</h1>
		          <p>Para utilizar el Web Service necesita 2 datos esenciales para el correcto funcionamiento del servicio.</p>
		          <ul>
			<li>
				<strong>Key</strong>
				<p>Es una clave que identifica la aplicación.</p>
			</li>
			<li>
				<strong>ID Tabla</strong>
				<p>Identificador de la tabla a la cual desea consultar</p>
			</li>
		</ul>

		<h2>Datos</h2>
        <ul>
            <li><strong>Key: </strong> '.$usuario->key.'</li>
	        <li><strong>URL Base:</strong> http://'.$url_ws.'</li>
        </ul>

        <h2>Formatos soportados</h2>
		<ul>
			<li>JSON</li>
			<li>XML</li>
			<li>HTML</li>
		</ul>
		<h2>Conectarse al WebService</h2>
		<p>El primer paso es conectarse al WS. En este informe veremos la forma para conectarse mediante el lenguaje de programación PHP.</p>
		<ul>
			<li>
				<strong>cURL</strong>
				<p>cURL es una librería ya integrada en PHP que permite conexiones entre servidores, básicamente. </p>
				<span class="ejemplo">Ejemplo:</span>
				<div class="codigo">
					$url = "http://'.$url_ws.'listado/format/json"; <br />

                    $curl = curl_init();<br />
                    curl_setopt_array($curl, array(<br />
                        CURLOPT_URL => $url,<br />
                        CURLOPT_RETURNTRANSFER => true,<br />
                        CURLOPT_ENCODING => "",<br />
                        CURLOPT_MAXREDIRS => 10,<br />
                        CURLOPT_TIMEOUT => 30,<br />
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,<br />
                        CURLOPT_CUSTOMREQUEST => "POST",<br />
                        CURLOPT_POSTFIELDS => http_build_query($datos),<br />
                        CURLOPT_HTTPHEADER => array(<br />
                            "cache-control: no-cache",<br />
                            "x-api-key: '.$modulo->key.'"<br />
                        ),<br />
                    ));<br />
    	           $result=curl_exec($curl);<br />
    	           curl_close($curl);<br />
    	           $datos =  json_decode($result);<br />
				</div>
			</li>
		</ul>
        
        <pagebreak />
        
        <p>Para todas las consulta al WebService se debe enviar obligatoriamente el ID de la tabla:</p>
        <ul>
			<li>
				<strong>tabla: </strong>Debe ir el ID de la tabla a consultar.
			</li>
        </ul>
        <p>Adicionalmente se pueden enviar otros parametros para las consultas:</p>
        <ul>
			<li>
				<strong>campos: </strong>Se puede incluir los campos en forma de String o Array que se desean obtener.
                <p>String: Se puede enviar en formato String si es un solo campo. Ej "nombre_campo"</p>
                <p>Array: Se puede enviar en formato Array si es uno o varios campos. Ej array("nombre_campo","nombre_campo_2")</p>
                <p>Si los campos no están presentes, la consulta retorna todos los campos a los cuáles tiene permiso</p>
            </li>
            <li>
				<strong>where: </strong>Se puede incluir una sentencia WHERE a la consulta en forma de String o Array.
                <p>String: Se puede enviar en formato String si es una sola sentencia. Ej "nombre_campo = 1"</p>
                <p>Array: Se puede enviar en formato Array si es una o varias sentencias. Ej array("nombre_campo = 1","nombre_campo_2 > 2")</p>
            </li>
            <li>
				<strong>having: </strong>Se puede incluir una sentencia HAVING a la consulta en forma de String o Array.
                <p>String: Se puede enviar en formato String si es una sola sentencia. Ej "nombre_campo = 1"</p>
                <p>Array: Se puede enviar en formato Array si es una o varias sentencias. Ej array("nombre_campo = 1","nombre_campo_2 < 4")</p>
            </li>
            <li>
				<strong>limit: </strong>Se puede incluir una sentencia LIMIT a la consulta.
			</li>
            <li>
				<strong>offset: </strong>Se puede incluir una sentencia OFFSET a la consulta.
			</li>
            <li>
				<strong>order: </strong>Se puede incluir una sentencia ORDER BY a la consulta en forma de String o Array.
                <p>String: Se puede enviar en formato String si es un solo campo. Ej "nombre_campo ASC"</p>
                <p>Array: Se puede enviar en formato Array si es uno o varios campos. Ej array("nombre_campo"=>"ASC","nombre_campo_2"=>"DESC")</p>
            </li>
            <li>
				<strong>group: </strong>Se puede incluir una sentencia GROUP BY a la consulta en forma de String o Array.
                <p>String: Se puede enviar en formato String si es un solo campo. Ej "nombre_campo"</p>
                <p>Array: Se puede enviar en formato Array si es uno o varios campos. Ej array("nombre_campo","nombre_campo_2")</p>
            </li>
            <li>
				<strong>join: </strong>Se puede incluir uno o varios JOIN a la consulta en forma de Array.
                <p>Array: Ej array("tabla"=>id_tabla,"tipo"=>"left","on"=>"codigo_1 = codigo_2","campos"=>array("campo_1","campo_2"))</p>
                <p>Para hacer JOIN con mas de una tabla se debe incluir un segundo Array con la información del otro JOIN</p>
                <p>
                Ej: array(
                    array("tabla"=>id_tabla,"tipo"=>"left","on"=>"codigo_1 = codigo_2","campos"=>array("campo_1","campo_2"))
                    array("tabla"=>id_tabla_2,"tipo"=>"inner","on"=>"codigo_3 = codigo_4","campos"=>array("campo_3","campo_4","campo_5"))
                }
                </p>
                <p>Si el TIPO no va en el array, se asume un INNER JOIN</p>
                <p>Si los campos no están presentes, la consulta retorna todos los campos a los cuáles tiene permiso</p>
                <p>Si CAMPO va con valor FALSE, no se retorna ningún campo</p>
            </li>
        </ul>';
        
        foreach($modulos as $aux){
            $datos = array();
            $leer = $insertar = $editar = $eliminar = false;
            $cuerpo .= '<pagebreak /> <h1>Tabla '.$aux->nombre.'. ID: '.$aux->codigo.'</h1>
            <h2>Permisos para la tabla</h2>
            <ul>';
                foreach($aux->permisos as $perm){
        			$cuerpo .= '<li>
        				<strong>'.$perm->permisos->nombre.'</strong>
        			</li>';
                    
                    if($perm->permisos->codigo == 1)
                        $leer = true;
                    elseif($perm->permisos->codigo == 2)
                        $insertar = true;
                    elseif($perm->permisos->codigo == 3)
                        $editar = true;
                    elseif($perm->permisos->codigo == 4)
                        $eliminar = true;
                }
            $cuerpo .= '</ul>
            <h2>Campos</h2>
            <ul>';
                $campo1 = $campo2 = '';
                foreach($aux->campos as $kc=>$cam){
                    
                    if($kc == 0){
                        $datos["where"] = '"'.$cam->nombre_campo.' <= 10"';
                        $datos["order"] = '"'.$cam->nombre_campo.' ASC"';
                        $datos["group"] = '"'.$cam->nombre_campo.'"';
                    }
                    
                    
                    if($kc == 0)
                        $campo1 = $cam->nombre_campo;
                    if($kc == 1)
                        $campo2 = $cam->nombre_campo;
                    
                    $pk = '';
                    if($cam->primaria)
                        $pk = ' - PK';
                    
                    $prederterminado = 'ninguno';
                    if($cam->predeterminado)
                        $prederterminado = $cam->predeterminado;
                    elseif($cam->nulo)
                        $prederterminado = 'NULL';
                    
                    if($cam->longitud)
                        $longitud = $cam->longitud;
                    else
                        $longitud = $cam->tipo_campo->longitud;
                    
        			$cuerpo .= '<li>
        				<strong>'.$cam->nombre.' ('.$cam->nombre_campo.$pk.') </strong>
                        <ul>
                            <li>'.$cam->tipo_campo->nombre.' ('.$longitud.')</li>
                            <li>Valor predeterminado: '.$prederterminado.'</li>
                        
                        ';
                            foreach($cam->permisos as $camp){
                    			$cuerpo .= '<li>
                    				<strong>'.$camp->permisos->nombre.'</strong>
                    			</li>';
                            }
                        $cuerpo .= '</ul>
        			</li>';
                }
            $cuerpo .= '</ul>';
            if($aux->relacionadas){
                $cuerpo .= '<h2>Tablas relacionadas</h2>
                <ul>';
                foreach($aux->relacionadas as $rel){
        			$cuerpo .= '<li>
        				<strong>'.$rel->nombre.'. ID: ('.$rel->codigo.') </strong>
                        <h3>Relación entre tablas</h3>
                        <ul>
                            <li>'.$rel->foranea->nombre_campo.' (PK) = '.$rel->primaria.' (FK)</li>
                        </ul>
        			</li>';
                }
            }
            
            $cuerpo .= '</ul>';
            
            if($leer){
                $cuerpo .='
                <pagebreak />
                <h2>Listado de datos</h2>
                <p>Para obtener los datos de una tabla deberemos realizar una consulta a la siguiente URL base: </p>
                <div class="codigo">
    			     http://'.$url_ws.'listado/format/json
                </div>
    			<br />
                <strong>Ejemplo cURL: </strong>
    			<div class="codigo">
    				$url = "http://'.$url_ws.'listado/format/json"; <br />
    
                    $curl = curl_init();<br />
                    curl_setopt_array($curl, array(<br />
                        CURLOPT_URL => $url,<br />
                        CURLOPT_RETURNTRANSFER => true,<br />
                        CURLOPT_ENCODING => "",<br />
                        CURLOPT_MAXREDIRS => 10,<br />
                        CURLOPT_TIMEOUT => 30,<br />
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,<br />
                        CURLOPT_CUSTOMREQUEST => "POST",<br />
                        CURLOPT_POSTFIELDS => http_build_query(array(
                            "tabla" => '.$aux->codigo.',
                            "limit" => 10,
                            "offset" => 1,
                            "where" => '.$datos["where"].',
                            "order" => '.$datos["order"].'
                        )),<br />
                        CURLOPT_HTTPHEADER => array(<br />
                            "cache-control: no-cache",<br />
                            "x-api-key: '.$usuario->key.'"<br />
                        ),<br />
                    ));<br />
    	           $result=curl_exec($curl);<br />
    	           curl_close($curl);<br />
    	           $datos =  json_decode($result);<br />
    			</div>
                
                <pagebreak />';
            
            
                $cuerpo .='<h2>Obtener un registro</h2>
                <p>Para obtener un registro de una tabla debemos realizar una consulta a la siguiente URL base: </p>
                <div class="codigo">
    			     http://'.$url_ws.'obtener/format/json
                </div>
                <br />
    			<strong>Ejemplo cURL: </strong>
    			<div class="codigo">
    				$url = "http://'.$url_ws.'obtener/format/json"; <br />
    
                    $curl = curl_init();<br />
                    curl_setopt_array($curl, array(<br />
                        CURLOPT_URL => $url,<br />
                        CURLOPT_RETURNTRANSFER => true,<br />
                        CURLOPT_ENCODING => "",<br />
                        CURLOPT_MAXREDIRS => 10,<br />
                        CURLOPT_TIMEOUT => 30,<br />
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,<br />
                        CURLOPT_CUSTOMREQUEST => "POST",<br />
                        CURLOPT_POSTFIELDS => http_build_query(array(
                            "tabla" => '.$aux->codigo.',
                            "where" => '.$datos["where"].',
                            "group" => '.$datos["group"].'
                        )),<br />
                        CURLOPT_HTTPHEADER => array(<br />
                            "cache-control: no-cache",<br />
                            "x-api-key: '.$usuario->key.'"<br />
                        ),<br />
                    ));<br />
    	           $result=curl_exec($curl);<br />
    	           curl_close($curl);<br />
    	           $datos =  json_decode($result);<br />
    			</div>';
            }
            
            if($insertar){
                $cuerpo .='
                <pagebreak />
                <h2>Insertar un registro</h2>
                <p>Para insertar un registro a una tabla debemos realizar una consulta a la siguiente URL base: </p>
                <div class="codigo">
    			     http://'.$url_ws.'insertar/format/json
                </div>
                <br />
    			<strong>Ejemplo cURL: </strong>
    			<div class="codigo">
    				$url = "http://'.$url_ws.'insertar/format/json"; <br />
    
                    $curl = curl_init();<br />
                    curl_setopt_array($curl, array(<br />
                        CURLOPT_URL => $url,<br />
                        CURLOPT_RETURNTRANSFER => true,<br />
                        CURLOPT_ENCODING => "",<br />
                        CURLOPT_MAXREDIRS => 10,<br />
                        CURLOPT_TIMEOUT => 30,<br />
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,<br />
                        CURLOPT_CUSTOMREQUEST => "POST",<br />
                        CURLOPT_POSTFIELDS => http_build_query(array(
                            "tabla" => '.$aux->codigo.',
                            "campos" => array(
                                '.$campo1.' => "valor_1"';
                                if($campo2)
                                    $cuerpo .= $campo2.' => "valor_2"
                            )
                        )),<br />
                        CURLOPT_HTTPHEADER => array(<br />
                            "cache-control: no-cache",<br />
                            "x-api-key: '.$usuario->key.'"<br />
                        ),<br />
                    ));<br />
    	           $result=curl_exec($curl);<br />
    	           curl_close($curl);<br />
    	           $datos =  json_decode($result);<br />
    			</div>';
            }
            
            if($editar){
                $cuerpo .='
                <pagebreak />
                
                <h2>Actualizar un registro</h2>
                <p>Para actualizar un registro de una tabla debemos realizar una consulta a la siguiente URL base: </p>
                <div class="codigo">
    			     http://'.$url_ws.'actualizar/format/json
                </div>
                <br />
    			<strong>Ejemplo cURL: </strong>
    			<div class="codigo">
    				$url = "http://'.$url_ws.'actualizar/format/json"; <br />
    
                    $curl = curl_init();<br />
                    curl_setopt_array($curl, array(<br />
                        CURLOPT_URL => $url,<br />
                        CURLOPT_RETURNTRANSFER => true,<br />
                        CURLOPT_ENCODING => "",<br />
                        CURLOPT_MAXREDIRS => 10,<br />
                        CURLOPT_TIMEOUT => 30,<br />
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,<br />
                        CURLOPT_CUSTOMREQUEST => "POST",<br />
                        CURLOPT_POSTFIELDS => http_build_query(array(
                            "tabla" => '.$aux->codigo.',
                            "where" => '.$datos['where'].',
                            "campos" => array(
                                '.$campo1.' => "valor_1"';
                                if($campo2)
                                    $cuerpo .= ','.$campo2.' => "valor_2"
                            )
                        )),<br />
                        CURLOPT_HTTPHEADER => array(<br />
                            "cache-control: no-cache",<br />
                            "x-api-key: '.$usuario->key.'"<br />
                        ),<br />
                    ));<br />
    	           $result=curl_exec($curl);<br />
    	           curl_close($curl);<br />
    	           $datos =  json_decode($result);<br />
    			</div>';
            }
            
            if($eliminar){
                $cuerpo .='
                <pagebreak />
                
                <h2>Eliminar un registro</h2>
                <p>Para eliminar un registro de una tabla debemos realizar una consulta a la siguiente URL base: </p>
                <div class="codigo">
    			     http://'.$url_ws.'eliminar/format/json
                </div>
                <br />
    			<strong>Ejemplo cURL: </strong>
    			<div class="codigo">
    				$url = "http://'.$url_ws.'eliminar/format/json"; <br />
    
                    $curl = curl_init();<br />
                    curl_setopt_array($curl, array(<br />
                        CURLOPT_URL => $url,<br />
                        CURLOPT_RETURNTRANSFER => true,<br />
                        CURLOPT_ENCODING => "",<br />
                        CURLOPT_MAXREDIRS => 10,<br />
                        CURLOPT_TIMEOUT => 30,<br />
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,<br />
                        CURLOPT_CUSTOMREQUEST => "POST",<br />
                        CURLOPT_POSTFIELDS => http_build_query(array(
                            "tabla" => '.$aux->codigo.',
                            "where" => '.$datos['where'].'
                        )),<br />
                        CURLOPT_HTTPHEADER => array(<br />
                            "cache-control: no-cache",<br />
                            "x-api-key: '.$usuario->key.'"<br />
                        ),<br />
                    ));<br />
    	           $result=curl_exec($curl);<br />
    	           curl_close($curl);<br />
    	           $datos =  json_decode($result);<br />
    			</div>';
            }
        
        }
        
            $cuerpo .= '</body></html>';
    
            ob_start();
        	$mpdf=new mPDF('utf-8','A4','','',10,10,10,10,6,3);
        	$mpdf->SetDisplayMode('fullpage');
        	$mpdf->SetTitle('WebService Aeurus');
        	$mpdf->SetAuthor('Aeurus');
        	$mpdf->WriteHTML($cuerpo);
    
    		$mpdf->Output('WebService.pdf','D');
        
    	}
        else {
    		die('No ID seleccionado');
    	}
    }
	
	public function exportar_pdf($codigo){
        
        require APPPATH."libraries/mpdf_6/mpdf.php";

        if($codigo){
			$url_ws = $_SERVER['HTTP_HOST'].'/webservice/api/';
			
            $usuario = $this->objUsuario->obtener_por_codigo($codigo);
            $modulos = $this->objUsuario->tablas_usuario($codigo);

	        $cuerpo = '<!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <title>WebService</title>
                    <style>
                        body, html {
                        	font-family: \'Verdana\';
                        }
                        .codigo{
                        	background-color: #f5f5f5;
                        	border: 1px solid black;
                        	padding: 15px;
                        	color: #333333;
                        	font-size: 11px;
                        	font-family: \'Verdana\';
                        }
                        
                        .defecto {
                        	font-style: italic;
                        	font-size: 10px;
                        }
                        
                        .block {
                        	display: block;
                        	margin-bottom: 20px;
                        }
                        
                        .ejemplo {
                        	font-family: \'Verdana\';
                        	font-size: 10.5px;
                        	text-decoration: underline;
                        	font-weight: bold;
                        	display: block;
                        	margin: 5px;
                        }
                        ul > li {
                        	margin-top: 10px;
                        }
                    </style>
                </head>
                <body>
		          <h1>Web Service</h1>
		          <p>Para utilizar el Web Service necesita 2 datos esenciales para el correcto funcionamiento del servicio.</p>
		          <ul>
			<li>
				<strong>Key</strong>
				<p>Es una clave que identifica la aplicación.</p>
			</li>
			<li>
				<strong>ID Tabla</strong>
				<p>Identificador de la tabla a la cual desea consultar</p>
			</li>
		</ul>

		<h2>Datos</h2>
        <ul>
            <li><strong>Key: </strong> '.$usuario->key.'</li>
	        <li><strong>URL Base:</strong> http://'.$url_ws.'</li>
        </ul>

        <h2>Formatos soportados</h2>
		<ul>
			<li>JSON</li>
			<li>XML</li>
			<li>HTML</li>
		</ul>
		<h2>Conectarse al WebService</h2>
		<p>El primer paso es conectarse al WS. En este informe veremos la forma para conectarse mediante el lenguaje de programación PHP.</p>
		<p>Para realizar esta conexión debe hacerlo a través del archivo ws.php, esta librería debe ser cargada en el directorio <i>application/libraries/</i> de su sitio.</p>
		<ul>
			<li>
				<strong>Libreria WS</strong>
				<p>ws es una librería que le permite realizar consultas a la base de datos. Es quien se encarga de realizar la conexión al web service a través de la función cURL de PHP.</p>
			</li>
		</ul>
        
        <pagebreak />
        
        <h1>Definición de las funciones de ws:</h1>
        <ul>
			<li>
				<strong>listar: </strong>
				<p>$this->ws->listar(tabla,where = false)</p>
                <p>La función listar recibe obligatoriamente como primer parámetro el ID de la tabla.</p>
                <p>Adicionalmente se puede incluir un WHERE en formato String como segundo parámetro.</p>
            </li>
			<li>
				<strong>obtener: </strong>
				<p>$this->ws->obtener(tabla,where = false)</p>
                <p>La función obtener recibe obligatoriamente como primer parámetro el ID de la tabla.</p>
                <p>Adicionalmente se puede incluir un WHERE en formato String como segundo parámetro.</p>
            </li>
			<li>
				<strong>select: </strong>
				<p>$this->ws->select(campos)</p>
                <p>La función select recibe obligatoriamente un Array, para varios campos con su alias, o un String, para un único campo de la tabla principal.</p>
                <p>Array: array("alias"=>"nombre_campo_db")</p>
                <p>String: nombre_campo_db</p>
				<p>Si el alias no está presente, se retorna el nombre del campo definido en la admin del web service</p>
            </li>
            <li>
				<strong>where: </strong>
				<p>$this->ws->where(where)</p>
				<p>La función where recibe obligatoriamente un parámetro con la sentencia WHERE en formato Array o String</p>
                <p>String: Se puede enviar en formato String si es una sola sentencia. Ej "nombre_campo = 1"</p>
                <p>Array: Se puede enviar en formato Array si es una o varias sentencias. Ej array("nombre_campo = 1","nombre_campo_2 > 2")</p>
            </li>
            <li>
				<strong>having: </strong>
				<p>$this->ws->having(having)</p>
                <p>La función having recibe obligatoriamente un parámetro con la sentencia HAVING en formato Array o String</p>
                <p>String: Se puede enviar en formato String si es una sola sentencia. Ej "nombre_campo = 1"</p>
                <p>Array: Se puede enviar en formato Array si es una o varias sentencias. Ej array("nombre_campo = 1","nombre_campo_2 < 4")</p>
            </li>
            <li>
				<strong>limit: </strong>
				<p>$this->ws->limit(limit,offset = false)</p>
				<p>La función limit recibe obligatoriamente como primer parámetro el número LIMIT</p>
				<p>Adicionalmente se puede incluir un valor para el OFFSET como segundo parámetro.</p>
			</li>
            <li>
				<strong>order: </strong>
				<p>$this->ws->order(order)</p>
				<p>La función order recibe obligatoriamente un parámetro con la sentencia ORDER BY en formato Array o String.</p>
                <p>String: Se puede enviar en formato String si es un solo campo. Ej "nombre_campo ASC"</p>
                <p>Array: Se puede enviar en formato Array si es uno o varios campos. Ej array("nombre_campo"=>"ASC","nombre_campo_2"=>"DESC")</p>
            </li>
            <li>
				<strong>group: </strong>
				<p>$this->ws->group(group)</p>
				<p>La función group recibe obligatoriamente un parámetro con la sentencia GROUP BY en formato Array o String.</p>
                <p>String: Se puede enviar en formato String si es un solo campo. Ej "nombre_campo"</p>
                <p>Array: Se puede enviar en formato Array si es uno o varios campos. Ej array("nombre_campo","nombre_campo_2")</p>
            </li>
			<li>
				<strong>joinInner: </strong>
				<p>$this->ws->joinInner(tabla,on,campo = false)</p>
				<p>La función joinInner recibe obligatoriamente un primer parámetro con el ID de tabla relacionada.</p>
				<p>Además recibe obligatoriamente un segundo parámetro con la sentencia ON.</p>
				<p>Adicionalmente se puede incluir un tercer parametro con los campos que deseamos obtener de la tabla relacionada.</p>
                <p>Si los campos no están presentes, la consulta retorna todos los campos a los cuáles tiene permiso</p>
                <p>Si el tercer parámetro va con valor FALSE, no se retorna ningún campo</p>
				<p>El formato para incluir los campos es el mismo descrito en la función select</p>
            </li>
			<li>
				<strong>joinLeft: </strong>
				<p>$this->ws->joinLeft(tabla,on,campo = false)</p>
				<p>La función joinLeft recibe obligatoriamente un primer parámetro con el ID de tabla relacionada.</p>
				<p>Además recibe obligatoriamente un segundo parámetro con la sentencia ON.</p>
				<p>Adicionalmente se puede incluir un tercer parametro con los campos que deseamos obtener de la tabla relacionada.</p>
                <p>Si los campos no están presentes, la consulta retorna todos los campos a los cuáles tiene permiso</p>
                <p>Si el tercer parámetro va con valor FALSE, no se retorna ningún campo</p>
				<p>El formato para incluir los campos es el mismo descrito en la función select</p>
            </li>
			<li>
				<strong>joinRight: </strong>
				<p>$this->ws->joinRight(tabla,on,campo = false)</p>
				<p>La función joinRight recibe obligatoriamente un primer parámetro con el ID de tabla relacionada.</p>
				<p>Además recibe obligatoriamente un segundo parámetro con la sentencia ON.</p>
				<p>Adicionalmente se puede incluir un tercer parametro con los campos que deseamos obtener de la tabla relacionada.</p>
                <p>Si los campos no están presentes, la consulta retorna todos los campos a los cuáles tiene permiso</p>
                <p>Si el tercer parámetro va con valor FALSE, no se retorna ningún campo</p>
				<p>El formato para incluir los campos es el mismo descrito en la función select</p>
            </li>
			<li>
				<strong>insertar: </strong>
				<p>$this->ws->insertar(tabla,datos)</p>
				<p>La función insertar recibe obligatoriamente un primer parámetro con el ID de tabla.</p>
				<p>Recibe obligatoriamente un segundo parámetro con un Array con los datos que se desean insertar.</p>
                <p>Ej datos: array("nombre_campo"=>"valor","nombre_campo_2"=>"valor2")</p>
            </li>
			<li>
				<strong>actualizar: </strong>
				<p>$this->ws->actualizar(tabla,datos,where = false)</p>
				<p>La función actualizar recibe obligatoriamente un primer parámetro con el ID de tabla.</p>
				<p>Además recibe obligatoriamente un segundo parámetro con un Array con los datos que se desean actualizar.</p>
				<p>Adicionalmente recibe un tercer parámetro con la sentencia WHERE para hacer el update.</p>
				<p>Si la sentencia WHERE no está presente en la llamada a la función actualizar, se espera que se haya hecho una llamada a la función where anteriormente.</p>
                <p>Ej datos: array("nombre_campo"=>"valor","nombre_campo_2"=>"valor2")</p>
            </li>
			<li>
				<strong>eliminar: </strong>
				<p>$this->ws->eliminar(tabla,where = false)</p>
				<p>La función eliminar recibe obligatoriamente un primer parámetro con el ID de tabla.</p>
				<p>Adicionalmente recibe un segundo parámetro con la sentencia WHERE para hacer el delete.</p>
				<p>Si la sentencia WHERE no está presente en la llamada a la función eliminar, se espera que se haya hecho una llamada a la función where anteriormente.</p>
            </li>
			<li>
				<strong><i>Notas:</i></strong>
				<p>1.- Las funciones listar, obtener, insertar, actualizar y eliminar, deben ser llamadas despues de llamar a las demás funciones que se desean incluir en la consulta.</p>
				<p>2.- La función listar retorna los datos en un Array de objetos.</p>
				<p>3.- La función obtener retorna los datos en un objeto.</p>
				<p>4.- Las funciones join son retornadas en un objeto con el nombre de la tabla dentro de cada registro.</p>
				<p>5.- La función insertar retorna la o las claves primarias de la tabla.</p>
			</li>
			<h2><strong>Funciones adicionales</strong></h2>
			<li>
				<strong>result: </strong>
				<p>$this->ws->result()</p>
				<p>La función result muestra el json retornado por la función listar u obtener.</p>
				<p>Debe ser llamada, al igual que las otras funciones, antes de hacer la llamada a la función listar u obtener.</p>
			</li>
			<li>
				<strong>sql: </strong>
				<p>$this->ws->sql()</p>
				<p>La función sql muestra la consulta en formato SQL retornada por la función listar u obtener.</p>
				<p>Debe ser llamada, al igual que las otras funciones, antes de hacer la llamada a la función listar u obtener.</p>
			</li>
        </ul>';
        
        foreach($modulos as $aux){
            $datos = array();
            $leer = $insertar = $editar = $eliminar = false;
            $cuerpo .= '<pagebreak /> <h1>Tabla '.$aux->nombre.'. ID: '.$aux->codigo.'</h1>
            <h2>Permisos para la tabla</h2>
            <ul>';
                foreach($aux->permisos as $perm){
        			$cuerpo .= '<li>
        				<strong>'.$perm->permisos->nombre.'</strong>
        			</li>';
                    
                    if($perm->permisos->codigo == 1)
                        $leer = true;
                    elseif($perm->permisos->codigo == 2)
                        $insertar = true;
                    elseif($perm->permisos->codigo == 3)
                        $editar = true;
                    elseif($perm->permisos->codigo == 4)
                        $eliminar = true;
                }
            $cuerpo .= '</ul>
            <h2>Campos</h2>
            <ul>';
                $campo1 = $campo2 = '';
                foreach($aux->campos as $kc=>$cam){
                    
                    if($kc == 0){
                        $datos["where"] = '"'.$cam->nombre_campo.' <= 10"';
                        $datos["order"] = '"'.$cam->nombre_campo.' ASC"';
                        $datos["group"] = '"'.$cam->nombre_campo.'"';
                    }
                    
                    
                    if($kc == 0)
                        $campo1 = $cam->nombre_campo;
                    if($kc == 1)
                        $campo2 = $cam->nombre_campo;
                    
                    $pk = '';
                    if($cam->primaria)
                        $pk = ' - PK';
                    
                    $prederterminado = 'ninguno';
                    if($cam->predeterminado)
                        $prederterminado = $cam->predeterminado;
                    elseif($cam->nulo)
                        $prederterminado = 'NULL';
                    
                    if($cam->longitud)
                        $longitud = $cam->longitud;
                    else
                        $longitud = $cam->tipo_campo->longitud;
                    
        			$cuerpo .= '<li>
        				<strong>'.$cam->nombre.' ('.$cam->nombre_campo.$pk.') </strong>
                        <ul>
                            <li>'.$cam->tipo_campo->nombre.' ('.$longitud.')</li>
                            <li>Valor predeterminado: '.$prederterminado.'</li>
                        
                        ';
                            foreach($cam->permisos as $camp){
                    			$cuerpo .= '<li>
                    				<strong>'.$camp->permisos->nombre.'</strong>
                    			</li>';
                            }
                        $cuerpo .= '</ul>
        			</li>';
                }
            $cuerpo .= '</ul>';
            if($aux->relacionadas){
                $cuerpo .= '<h2>Tablas relacionadas</h2>
                <ul>';
                foreach($aux->relacionadas as $rel){
        			$cuerpo .= '<li>
        				<strong>'.$rel->nombre.'. ID: ('.$rel->codigo.') </strong>
                        <h3>Relación entre tablas</h3>
                        <ul>
                            <li>'.$rel->foranea->nombre_campo.' (PK) = '.$rel->primaria.' (FK)</li>
                        </ul>
        			</li>';
                }
            }
            
            $cuerpo .= '</ul>';
            
            if($leer){
                $cuerpo .='
                <pagebreak />
				
				<h2>Listado de datos</h2>
				<strong>Ejemplo listar:</strong>
				<div class="codigo">
					$this->ws->where("t1_campo_2 >= 30");<br />
					$this->ws->limit(1,20);<br />
					$this->ws->order("t1_campo_2 DESC");<br />
					$this->ws->group("t1_campo_3");<br />
					$this->ws->joinInner(5,"t1_campo_1 = t2_campo_1",array("ID"=>"t2_campo_1"));<br />
					$this->ws->joinLeft(15,"t2_campo_1 = t3_campo_1");<br />
					$this->ws->select(array("ID"=>"t1_campo_1","Nombre"=>"t1_campo_4"));<br />
					$listado = $this->ws->listar(10);
				</div>
				<p>Este ejemplo retorna un listado de objetos de la tabla con ID 10.</p>
				<p>El orden de la funciones no es importante, solo considerar que la función listar es la última en ser llamada.</p>
				<p>Las funciones JOIN si deben llevar un orden para hacer las válidaciones de permisos a los campos. El orden que se debe seguir es en cadena desde la tabla principal hasta la última tabla relacionada.</p>';
				
                $cuerpo .='
				
				<br /><h2>Obtener un registro</h2>
                <strong>Ejemplo obtener:</strong>
				<div class="codigo">
					$this->ws->where("t1_campo_2 >= 30");<br />
					$this->ws->joinInner(5,"t1_campo_1 = t2_campo_1",array("ID"=>"t2_campo_1"));<br />
					$this->ws->joinLeft(15,"t2_campo_1 = t3_campo_1");<br />
					$this->ws->select(array("ID"=>"t1_campo_1","Nombre"=>"t1_campo_4"));<br />
					$tupla = $this->ws->obtener(10);
				</div>
				<p>Este ejemplo retorna un objeto de la tabla con ID 10.</p>
				<p>El orden de la funciones no es importante, solo considerar que la función obtener es la última en ser llamada.</p>
				<p>Las funciones JOIN si deben llevar un orden para hacer las válidaciones de permisos a los campos. El orden que se debe seguir es en cadena desde la tabla principal hasta la última tabla relacionada.</p>';
            }
            
			if($insertar || $editar || $eliminar)
				$cuerpo .='<pagebreak />';
			
            if($insertar){
                $cuerpo .='
				
                <h2>Insertar un registro</h2>
				<strong>Ejemplo insertar:</strong>
				<div class="codigo">
					$datos = array(
						"t1_campo_2" => "valor_2",
						"t1_campo_3" => "valor_3",
						"t1_campo_4" => "valor_4",
					);
					$ids = $this->ws->insertar(10,$datos);
				</div>
				<p>Este ejemplo inserta una nueva tupla y retorna las claves primarias de la tabla con ID 10.</p>';
            }
            
            if($editar){
                $cuerpo .='
                
                <br /><h2>Actualizar un registro</h2>
				<strong>Ejemplo actualizar:</strong>
				<div class="codigo">
					$datos = array(
						"t1_campo_2" => "valor_2",
						"t1_campo_3" => "valor_3",
						"t1_campo_4" => "valor_4",
					);
					$this->ws->actualizar(10,$datos,"t1_campo_1 = 1");
				</div>
				<p>Este ejemplo actualiza una tupla de la tabla con ID 10.</p>
				<p>La función where puede ser llamada antes de la función eliminar para agregar la sentencia WHERE al UPDATE</p>';
            }
            
            if($eliminar){
                $cuerpo .='
                
                <br /><h2>Eliminar un registro</h2>
				<strong>Ejemplo eliminar:</strong>
				<div class="codigo">
					$this->ws->eliminar(10,"t1_campo_1 = 1");
				</div>
				<p>Este ejemplo elimina una tupla de la tabla con ID 10.</p>
				<p>La función where puede ser llamada antes de la función eliminar para agregar la sentencia WHERE al DELETE</p>';
            }
        
        }
        
            $cuerpo .= '</body></html>';
    
            ob_start();
        	$mpdf=new mPDF('utf-8','A4','','',10,10,10,10,6,3);
        	$mpdf->SetDisplayMode('fullpage');
        	$mpdf->SetTitle('WebService Aeurus');
        	$mpdf->SetAuthor('Aeurus');
        	$mpdf->WriteHTML($cuerpo);
    
    		$mpdf->Output('WebService.pdf','D');
        
    	}
        else {
    		die('No ID seleccionado');
    	}
    }
}