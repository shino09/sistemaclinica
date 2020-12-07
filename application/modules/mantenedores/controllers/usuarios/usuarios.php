<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class Usuarios extends CI_Controller {

    //public $permisos;
	function __construct(){

		parent::__construct();

		$this->id_modulo = 21;
		$this->prefijo_pri = "usu_";
		$this->title_gen_plu = "Usuarios";
		$this->title_gen_sin = "Usuarios";
		$this->nombre_gen_plu = "usuarios";
		$this->nombre_gen_sin = "usuarios";

        #revisa los permisos para el modulo mantenedores
        //$this->permisos = $this->layout->obtener_permisos(5);
        
        //if(!$this->permisos)
            //redirect('/');
	}

	public function index()	{

		#Title
		$this->layout->title('Mantenedores');

		#JS - Multiple select
		$this->layout->css('/js/jquery/bootstrap/bootstrap-multi-select/dist/css/bootstrap-select.css');
		$this->layout->js('/js/jquery/bootstrap/bootstrap-multi-select/js/bootstrap-select.js');

        #JS - Calendario
		$this->layout->js('/js/jquery/bootstrap/datepicker/bootstrap-datepicker.js');
		$this->layout->css('/js/jquery/bootstrap/datepicker/datepicker3.css');

        $this->layout->css('/js/jquery/validation-engine/css/validationEngine.jquery.css');
		$this->layout->js('/js/jquery/noty/packaged/jquery.noty.packaged.js');
		$this->layout->js('/js/jquery/validation-engine/js/jquery.validationEngine.js');
		$this->layout->js('/js/jquery/validation-engine/js/languages/jquery.validationEngine-es.js');
        $this->layout->js('/js/jquery/validador-rut/jquery.Rut.js');

        
		$this->layout->js('/js/sistema/mantenedores/'.$this->nombre_gen_plu.'/administrar.js');

		#JS - pagination
		$this->layout->js('/js/jquery/rpage-master/responsive-paginate.js');
		$this->layout->js('/js/jquery/rpage-master/paginate-init.js');

		#Nav
		$this->layout->nav(array("Mantenedores: ".$this->title_gen_plu.""=>"/"));

		$data = $where = $and = $url = '';
        $data = array("rut_f"=>"","q"=>"","perfil"=>"");
        if($rut = $this->input->get('rut')){
            $data['rut_f'] = $rut;
            $where .= $and."usu_rut LIKE '%$rut%'";
            $and = " and ";
        }

        if($q = $this->input->get('q')){
            $data['q'] = $q;
            $where .= $and."(concat(usu_nombre,' ',usu_primer_apellido) LIKE '%$q%' or concat(usu_nombre,' ',usu_segundo_apellido) LIKE '%$q%' or concat(usu_primer_apellido,' ',usu_segundo_apellido) LIKE '%$q%')";
            $and = " and ";
        }

        if($perfil = $this->input->get('perfil')){
            $data['perfil_f'] = $perfil;
            $where .= $and."usu_perfil = '$perfil'";
            $and = " and ";
        }

		#paginacion
		$config['base_url'] = '/mantenedores/'.$this->nombre_gen_plu.'/';
		$config['total_rows'] = count($this->ws->listar($this->id_modulo,$where));
		$config['per_page'] = 15;
		$config['uri_segment'] = $segment = 3;
		$config['suffix'] = $url;
		$config['first_url'] = '/mantenedores/'.$this->nombre_gen_plu.$url;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment($segment))?$this->uri->segment($segment)-1:0;

		#contenido
		$this->ws->limit($config["per_page"],$page*$config["per_page"]);
        $this->ws->order("usu_nombre ASC");
		$data["datos"] = $this->ws->listar($this->id_modulo,$where);
		$data['pagination'] = $this->pagination->create_links();

        #perfiles
        $data['perfiles'] = $this->ws->listar(23,"per_estado = 1");

		#view
		$this->layout->view('/'.$this->nombre_gen_plu.'/index',$data);
	}

	public function administrar($codigo = false){

        #permisos del usuario
        //if(!$this->permisos->agregar && !$this->permisos->editar)
          //  redirect('/mantenedores/'.$this->nombre_gen_plu.'/');

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

        #JS - Timepicker
		$this->layout->js('/js/jquery/bootstrap-timepicker/js/bootstrap-timepicker.js');

        $this->layout->css('/js/jquery/validation-engine/css/validationEngine.jquery.css');
		$this->layout->js('/js/jquery/noty/packaged/jquery.noty.packaged.js');
		$this->layout->js('/js/jquery/validation-engine/js/jquery.validationEngine.js');
		$this->layout->js('/js/jquery/validation-engine/js/languages/jquery.validationEngine-es.js');
        $this->layout->js('/js/jquery/validador-rut/jquery.Rut.js');

        
        #JS - Fileinput
		$this->layout->js('/js/jquery/file-input/jquery.nicefileinput.min.js');
		$this->layout->js('/js/jquery/file-input/nicefileinput-init.js');
        
        #rut
        $this->layout->js('/js/jquery/validador-rut/jquery.Rut.js');

		$this->layout->js('/js/sistema/mantenedores/'.$this->nombre_gen_plu.'/administrar.js');

		#Nav
		if($codigo)
			$this->layout->nav(array("Mantenedores: $this->title_gen_plu"=>"mantenedores/$this->nombre_gen_plu", "Mantenedores: Editar $this->title_gen_sin"=>"/"));
		else
			$this->layout->nav(array("Mantenedores: $this->title_gen_plu"=>"mantenedores/$this->nombre_gen_plu", "Mantenedores: Agregar $this->title_gen_sin"=>"/"));

		$data = false;
		if($codigo){
            //$this->ws->joinLeft(17,"usu_comuna = com_codigo"); #comunas
            //$this->ws->joinLeft(16,"com_provincias = pro_codigo"); #provincias
            //$this->ws->joinLeft(15,"pro_regiones = reg_codigo"); #regiones
			$data["dato"] = $this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo = {$codigo}");
            
            #provincias
            /*if($data['dato']->regiones){
                $this->ws->order("pro_nombre ASC");
                $data['provincias'] = $this->ws->listar(16,"pro_estado = 1 and pro_regiones = {$data['dato']->regiones->codigo}");
            }

            #comunas
            if($data['dato']->provincias){
                $this->ws->order("com_nombre ASC");
                $data['comunas'] = $this->ws->listar(17,"com_estado = 1 and com_provincias = {$data['dato']->provincias->codigo}");
            }*/
        }

        #regiones
        //$data['regiones'] = $this->ws->listar(15,"reg_estado = 1");

        #cargos
        //$data['cargos'] = $this->ws->listar(13,"car_estado = 1"); */

        #perfiles
        $data['perfiles'] = $this->ws->listar(23,"per_estado = 1");

		#view
		$this->layout->view('/'.$this->nombre_gen_plu.'/administrar',$data);
	}

	public function process($codigo = false){
		$datos = $this->input->post();

        //print_array($datos);die('nvkdfnkfd');
		if($datos){

            $rut = $datos[$this->prefijo_pri."rut"] = str_replace('.','',$datos[$this->prefijo_pri."rut"]);
            /*if($datos[$this->prefijo_pri."fecha_nacimiento"])
              $datos[$this->prefijo_pri."fecha_nacimiento"] = formatearFecha($datos[$this->prefijo_pri."fecha_nacimiento"]);
            if($datos[$this->prefijo_pri."fecha_ingreso"])
              $datos[$this->prefijo_pri."fecha_ingreso"] = formatearFecha($datos[$this->prefijo_pri."fecha_ingreso"]);*/
            $datos[$this->prefijo_pri."estado"] = 1;
            $datos[$this->prefijo_pri."tipo"] = 1;


            if($datos[$this->prefijo_pri."contrasena"])
                $datos[$this->prefijo_pri."contrasena"] = md5($datos[$this->prefijo_pri."contrasena"]);
            else
                unset($datos[$this->prefijo_pri."contrasena"]);


              if($_FILES['imagen']['name'] != "" && $codigo!= false){
                
                #crea el directorio para subir el archivo
                $upload_dir = '/archivos/mantenedores/usuarios/'.$rut.'/';
                //crear_directorio($upload_dir);
            }
            else{
                 $upload_dir = '/archivos/mantenedores/usuarios/'.$rut.'/';

                 //echo $upload_dir;die('sadsad');
                    crear_directorio($upload_dir);

            }
            
            //guarda el archivo firma carta
            if($_FILES['imagen']['name'] != ""){
                $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].$upload_dir;
                $config['allowed_types'] = 'jpeg|jpg|png|xls|xlsx|doc|docx|ppt|pptx|pdf';
                $config['allowed_types'] = '*';
                $config['max_size'] = '1000';
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload('imagen'))
                {
                    $error = $this->upload->display_errors();
                }
                else
                {
                    $data = $this->upload->data();
                    
                    $datos['usu_imagen'] = $upload_dir.$data['file_name'];
                }
            }
            
            
            /*if($_FILES['firma_carta']['name'] != "" || $_FILES['firma_correo']['name'] != ""){
                
                #crea el directorio para subir el archivo
                $upload_dir = '/archivos/mantenedores/usuarios/'.$rut.'/';
                crear_directorio($upload_dir);
            }
            
            //guarda el archivo firma carta
            if($_FILES['firma_carta']['name'] != ""){
                $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].$upload_dir;
        		$config['allowed_types'] = 'jpeg|jpg|png|xls|xlsx|doc|docx|ppt|pptx|pdf';
        		$config['allowed_types'] = '*';
        		$config['max_size']	= '1000';
        		$this->load->library('upload', $config);
        		if(!$this->upload->do_upload('firma_carta'))
        		{
        			$error = $this->upload->display_errors();
        		}
        		else
        		{
        			$data = $this->upload->data();
                    
                    $datos['usu_firma_carta'] = $upload_dir.$data['file_name'];
                }
            }
            
            //guarda el archivo firma correo electronico
            if($_FILES['firma_correo']['name'] != ""){
                $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].$upload_dir;
        		$config['allowed_types'] = 'jpeg|jpg|png|xls|xlsx|doc|docx|ppt|pptx|pdf';
        		$config['allowed_types'] = '*';
        		$config['max_size']	= '1000';
        		$this->load->library('upload', $config);
        		if(!$this->upload->do_upload('firma_correo'))
        		{
        			$error = $this->upload->display_errors();
        		}
        		else
        		{
        			$data = $this->upload->data();
                    
                    $datos['usu_firma_correo_electronico'] = $upload_dir.$data['file_name'];
                }
            }*/
            
            
    		if($codigo){

                #revisa que el nombre ingresado no exista
                if($this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo <> $codigo and ".$this->prefijo_pri."rut = '$rut'")){
                    echo json_encode(array("result"=>false,"msj"=>"El RUT ingresado ya se encuentra registrado"));
                    exit;
                }


                $this->ws->actualizar($this->id_modulo,$datos,$this->prefijo_pri."codigo = {$codigo}");

                echo json_encode(array("result"=>true,"msj"=>"Datos Actualizados Correctamente."));
    		}else{

                #revisa que el nombre ingresado no exista
                if($this->ws->obtener($this->id_modulo,$this->prefijo_pri."rut = '$rut'")){
                    echo json_encode(array("result"=>false,"msj"=>"El RUT ingresado ya se encuentra registrado"));
                    exit;
                }

                //print_array($datos);die('process');

                $this->ws->insertar($this->id_modulo,$datos);
                echo json_encode(array("result"=>true,"msj"=>"Datos Ingresados Correctamente."));
    		}
		}else
			echo json_encode(array("result"=>false,"msj"=>"No se recibieron datos."));
	}



    public function miperfil($codigo = false){

        #permisos del usuario
        //if(!$this->permisos->agregar && !$this->permisos->editar)
          //  redirect('/mantenedores/'.$this->nombre_gen_plu.'/');

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

        #JS - Timepicker
        $this->layout->js('/js/jquery/bootstrap-timepicker/js/bootstrap-timepicker.js');

        $this->layout->css('/js/jquery/validation-engine/css/validationEngine.jquery.css');
        $this->layout->js('/js/jquery/noty/packaged/jquery.noty.packaged.js');
        $this->layout->js('/js/jquery/validation-engine/js/jquery.validationEngine.js');
        $this->layout->js('/js/jquery/validation-engine/js/languages/jquery.validationEngine-es.js');
        
        #JS - Fileinput
        $this->layout->js('/js/jquery/file-input/jquery.nicefileinput.min.js');
        $this->layout->js('/js/jquery/file-input/nicefileinput-init.js');
        
        #rut
        $this->layout->js('/js/jquery/validador-rut/jquery.Rut.js');

        $this->layout->js('/js/sistema/mantenedores/'.$this->nombre_gen_plu.'/miperfil.js');

        #Nav
        if($codigo)
            $this->layout->nav(array("Mantenedores: $this->title_gen_plu"=>"mantenedores/$this->nombre_gen_plu", "Mantenedores: Editar $this->title_gen_sin"=>"/"));
        else
            $this->layout->nav(array("Mantenedores: $this->title_gen_plu"=>"mantenedores/$this->nombre_gen_plu", "Mantenedores: Agregar $this->title_gen_sin"=>"/"));

        $data = false;
        if($codigo){
            //$this->ws->joinLeft(17,"usu_comuna = com_codigo"); #comunas
            //$this->ws->joinLeft(16,"com_provincias = pro_codigo"); #provincias
            //$this->ws->joinLeft(15,"pro_regiones = reg_codigo"); #regiones
            //$this->ws->joinLeft(23,"per_codigo = usu_perfil"); #regiones

            $data["dato"] = $this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo = {$codigo}");
            
            #provincias
            /*if($data['dato']->regiones){
                $this->ws->order("pro_nombre ASC");
                $data['provincias'] = $this->ws->listar(16,"pro_estado = 1 and pro_regiones = {$data['dato']->regiones->codigo}");
            }

            #comunas
            if($data['dato']->provincias){
                $this->ws->order("com_nombre ASC");
                $data['comunas'] = $this->ws->listar(17,"com_estado = 1 and com_provincias = {$data['dato']->provincias->codigo}");
            }*/
        }

        #regiones
        //$data['regiones'] = $this->ws->listar(15,"reg_estado = 1");

        #cargos
        //$data['cargos'] = $this->ws->listar(13,"car_estado = 1"); */

        #perfiles
        $data['perfiles'] = $this->ws->listar(23,"per_estado = 1");

        #view
        $this->layout->view('/'.$this->nombre_gen_plu.'/miperfil',$data);
    }



    public function processmiperfil ($codigo = false){
        $datos = $this->input->post();

        //print_array($datos);die('nvkdfnkfd');
        if($datos){

            $rut = $datos[$this->prefijo_pri."rut"] = str_replace('.','',$datos[$this->prefijo_pri."rut"]);
            if($datos[$this->prefijo_pri."fecha_nacimiento"])
              $datos[$this->prefijo_pri."fecha_nacimiento"] = formatearFecha($datos[$this->prefijo_pri."fecha_nacimiento"]);
            if($datos[$this->prefijo_pri."fecha_ingreso"])
              $datos[$this->prefijo_pri."fecha_ingreso"] = formatearFecha($datos[$this->prefijo_pri."fecha_ingreso"]);
            $datos[$this->prefijo_pri."estado"] = 1;
            $datos[$this->prefijo_pri."tipo"] = 1;


            if($datos[$this->prefijo_pri."contrasena"])
                $datos[$this->prefijo_pri."contrasena"] = md5($datos[$this->prefijo_pri."contrasena"]);
            else
                unset($datos[$this->prefijo_pri."contrasena"]);


              if($_FILES['imagen']['name'] != "" ){
                
                #crea el directorio para subir el archivo
                $upload_dir = '/archivos/mantenedores/usuarios/'.$rut.'/';
                crear_directorio($upload_dir);
            }
            
            //guarda el archivo firma carta
            if($_FILES['imagen']['name'] != ""){
                $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].$upload_dir;
                $config['allowed_types'] = 'jpeg|jpg|png|xls|xlsx|doc|docx|ppt|pptx|pdf';
                $config['allowed_types'] = '*';
                $config['max_size'] = '1000';
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload('imagen'))
                {
                    $error = $this->upload->display_errors();
                }
                else
                {
                    $data = $this->upload->data();
                    
                    $datos['usu_imagen'] = $upload_dir.$data['file_name'];
                }
            }
            
     
            if($codigo){

                #revisa que el nombre ingresado no exista
                if($this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo <> $codigo and ".$this->prefijo_pri."rut = '$rut'")){
                    echo json_encode(array("result"=>false,"msj"=>"El RUT ingresado ya se encuentra registrado"));
                    exit;
                }


                $this->ws->actualizar($this->id_modulo,$datos,$this->prefijo_pri."codigo = {$codigo}");

                echo json_encode(array("result"=>true,"msj"=>"Datos Actualizados Correctamente."));
            }else{

                #revisa que el nombre ingresado no exista
                if($this->ws->obtener($this->id_modulo,$this->prefijo_pri."rut = '$rut'")){
                    echo json_encode(array("result"=>false,"msj"=>"El RUT ingresado ya se encuentra registrado"));
                    exit;
                }

                //print_array($datos);die('process');

                $this->ws->insertar($this->id_modulo,$datos);
                echo json_encode(array("result"=>true,"msj"=>"Datos Ingresados Correctamente."));
            }
        }else
            echo json_encode(array("result"=>false,"msj"=>"No se recibieron datos."));
    }


	public function eliminar(){

        try{
			$this->ws->eliminar($this->id_modulo,$this->prefijo_pri."codigo = {$this->input->post('codigo')}");
			echo json_encode(array("result"=>true));
		}
		catch(Exception $e){
			echo json_encode(array("result"=>false,"msg"=>"Ha ocurrido un error inesperado. Por favor, inténtelo nuevamente."));
		}
	}

    #listado de provincias por region
    public function listar_provincias(){
        $html = '<option value="">Seleccione</option>';
        if($region = $this->input->post('region')){
            $this->ws->order("pro_nombre ASC");
            $provincias = $this->ws->listar(16,"pro_estado = 1 and pro_regiones = {$region}");
            foreach($provincias as $aux){
                $html .= '<option value="'.$aux->codigo.'">'.$aux->nombre.'</option>';
            }
        }

        echo $html;
    }

    #listado de comunas por provincia
    public function listar_comunas(){
        $html = '<option value="">Seleccione</option>';
        if($provincia = $this->input->post('provincia')){
            $this->ws->order("com_nombre ASC");
            $comunas = $this->ws->listar(17,"com_estado = 1 and com_provincias = {$provincia}");
            foreach($comunas as $aux){
                $html .= '<option value="'.$aux->codigo.'">'.$aux->nombre.'</option>';
            }
        }

        echo $html;
    }
    
    #descargar archivos del usuario
    public function descargar_archivo($codigo, $tipo){
        
        $this->load->helper('download');
        $usuario = $this->ws->obtener($this->id_modulo,"usu_codigo = {$codigo}");
        

         #archivo firma carta
        if($tipo == 1){
            $archivo = $usuario->imagen;
        }

        /*
        #archivo firma carta
        if($tipo == 1){
            $archivo = $usuario->firma_carta;
        }
        #archivo firma correo electronico
        elseif($tipo == 2){
            $archivo = $usuario->firma_correo_electronico;
        }*/
        
        $data = file_get_contents($_SERVER['DOCUMENT_ROOT'].$archivo);
        force_download(basename($archivo), $data);
    }
    
    public function eliminar_archivo(){
        
        if($this->input->post()){
            
            list($codigo,$tipo) = explode('-',$this->input->post('codigo'));
            
            if($tipo == 1){
                $datos['usu_firma_carta'] = '';
            }
            elseif($tipo == 2){
                $datos['usu_firma_correo_electronico'] = '';
            }
            
            $this->ws->actualizar($this->id_modulo,$datos,$this->prefijo_pri."codigo = {$codigo}");
            
            echo json_encode(array("result"=>true));
        }
    }
}
