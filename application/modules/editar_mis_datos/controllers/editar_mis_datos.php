<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class Editar_mis_datos extends CI_Controller {
	
    private $prefijo_pri, $id_modulo;
    public $usuario;
	function __construct(){
        
		parent::__construct();
        
        $this->id_modulo = 21;
        $this->prefijo_pri = "usu_";
        
        $this->usuario = $this->session->userdata('usuario_sa');
	}
	
	public function index()	{
		
		#Title
		$this->layout->title('Editar Mis Datos');
		
		#Metas
		$this->layout->setMeta('title','Editar Mis Datos');
		$this->layout->setMeta('description','Editar Mis Datos');
		$this->layout->setMeta('keywords','Editar Mis Datos');
		
		#JS - Multiple select
		$this->layout->css('/js/jquery/bootstrap/bootstrap-multi-select/dist/css/bootstrap-select.css');
		$this->layout->js('/js/jquery/bootstrap/bootstrap-multi-select/js/bootstrap-select.js');
		
		#JS - Fileinput
		$this->layout->js('/js/jquery/file-input/jquery.nicefileinput.min.js');
		$this->layout->js('/js/jquery/file-input/nicefileinput-init.js');
        
        #JS - Noty
        $this->layout->js('/js/jquery/noty/packaged/jquery.noty.packaged.js');
        
        #JS - ValidateEngine
        $this->layout->css('/js/jquery/validation-engine/css/validationEngine.jquery.css');
		$this->layout->js('/js/jquery/validation-engine/js/jquery.validationEngine.js');
		$this->layout->js('/js/jquery/validation-engine/js/languages/jquery.validationEngine-es.js');
        
        #js
		$this->layout->js('/js/sistema/mis-datos/index.js');
		
        $codigo = $this->session->userdata('usuario_sa')->codigo;
        
        #obtiene al usuario
		$contenido["dato"] = $this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo = {$codigo}");
        
        $contenido['perfiles'] = $this->ws->listar(23,"per_estado = 1");

        
		#Nav
		$this->layout->nav(array("Editar mis Datos"=>"/"));
		
		#view
		$this->layout->view('index',$contenido);
	}
    
    
    public function process(){
        
		if($datos = $this->input->post()){

            $rut = $datos[$this->prefijo_pri."rut"] = str_replace('.','',$datos[$this->prefijo_pri."rut"]);
            if($datos[$this->prefijo_pri."contrasena"])
                $datos[$this->prefijo_pri."contrasena"] = md5($datos[$this->prefijo_pri."contrasena"]);
            else
                unset($datos[$this->prefijo_pri."contrasena"]);
            
                         $upload_dir = '/archivos/mantenedores/usuarios/'.$rut.'/';

              /*if($_FILES['imagen']['name'] != "" ){


                
                #crea el directorio para subir el archivo
                $upload_dir = '/archivos/mantenedores/usuarios/'.$rut.'/';


                    crear_directorio($upload_dir);

               
          
            }*/
            
            
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
            
                       // print_array($datos);die('processeditardatos');

            $codigo = $this->usuario->codigo;
            
            #actualiza el usuario
            $this->ws->actualizar($this->id_modulo,$datos,$this->prefijo_pri."codigo = $codigo");
            
            #setea la sesion con los nuevos datos
            $usuario = $this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo = $codigo");
            $this->session->set_userdata('usuario_sa',$usuario);
            
            echo json_encode(array("result"=>true,"msj"=>"Datos Actualizados Correctamente."));
    		
		}
        else
			redirect('/');
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
            $archivo = $usuario->firma_carta;
        }
        #archivo firma correo electronico
        elseif($tipo == 2){
            $archivo = $usuario->firma_correo_electronico;
        }
        
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