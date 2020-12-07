<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class Centros_medicos extends CI_Controller {





    
    //public $permisos;
	function __construct(){

		parent::__construct();

		$this->id_modulo = 13;
		$this->prefijo_pri = "cent_";
		$this->title_gen_plu = "Centros Medicos";
		$this->title_gen_sin = "Centro Medico";
		$this->nombre_gen_plu = "centros_medicos";
		$this->nombre_gen_sin = "Centros Medicos";
        
        #revisa los permisos para el modulo mantenedores
        #$this->permisos = $this->layout->obtener_permisos(5);
        
        //if(!$this->permisos)
          //  redirect('/');
	}

	public function index()	{
		//die('test');
        
		#Title
		$this->layout->title('Mantenedores');

		#JS - Multiple select
		$this->layout->css('/js/jquery/bootstrap/bootstrap-multi-select/dist/css/bootstrap-select.css');
		$this->layout->js('/js/jquery/bootstrap/bootstrap-multi-select/js/bootstrap-select.js');

		$this->layout->js('/js/jquery/noty/packaged/jquery.noty.packaged.js');
		$this->layout->js('/js/jquery/validation-engine/js/jquery.validationEngine.js');
		$this->layout->js('/js/jquery/validation-engine/js/languages/jquery.validationEngine-es.js');

		$this->layout->js('/js/sistema/mantenedores/'.$this->nombre_gen_plu.'/administrar.js');

		#JS - pagination
		$this->layout->js('/js/jquery/rpage-master/responsive-paginate.js');
		$this->layout->js('/js/jquery/rpage-master/paginate-init.js');

		#Nav
		$this->layout->nav(array("Mantenedores: ".$this->title_gen_plu.""=>"/"));

		$data = false;$where = false;$url = false;

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
		$this->ws->order($this->prefijo_pri.'nombre ASC');
		$data["datos"] = $this->ws->listar($this->id_modulo,$where);
		$data['pagination'] = $this->pagination->create_links();


		//echo $this->nombre_gen_plu; die();

		#La vista siempre,  debe ir cargada al final de la función
		$this->layout->view('/'.$this->nombre_gen_plu.'/index',$data);
	}

	public function administrar($codigo = false){
        
        #permisos del usuario
        //if(!$this->permisos->agregar && !$this->permisos->editar)
          //  redirect('/mantenedores/'.$this->nombre_gen_plu.'/');
            

        //die('administarr');    
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


		//print_array($codigo);die();
		#Nav
		if($codigo)
			$this->layout->nav(array("Mantenedores: $this->title_gen_plu"=>"mantenedores/$this->nombre_gen_plu", "Mantenedores: Editar $this->title_gen_sin"=>"/"));
		else
			$this->layout->nav(array("Mantenedores: $this->title_gen_plu"=>"mantenedores/$this->nombre_gen_plu", "Mantenedores: Agregar $this->title_gen_sin"=>"/"));

		$data = false;
		if($codigo)
			$data["dato"] = $this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo = {$codigo}");

		#La vista siempre,  debe ir cargada al final de la función
		$this->layout->view('/'.$this->nombre_gen_plu.'/administrar',$data);
	}

	public function process($codigo = false){

		//echo 'llego a process';
		//print_array($this->input->post());die();
		$datos = $this->input->post();
		if($datos){
		  
            $nombre = $datos[$this->prefijo_pri."nombre"];
            if($codigo){
                
                #revisa que el nombre ingresado no exista
                if($this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo <> $codigo and ".$this->prefijo_pri."nombre = '$nombre'")){
                    echo json_encode(array("result"=>false,"msj"=>"El nombre ingresado ya se encuentra registrado"));
                    exit;
                }
                
                $this->ws->actualizar($this->id_modulo,$datos,$this->prefijo_pri."codigo = {$codigo}");
                echo json_encode(array("result"=>true,"msj"=>"Datos Actualizados Correctamente."));
            }else{
                
                #revisa que el nombre ingresado no exista
                if($this->ws->obtener($this->id_modulo,$this->prefijo_pri."nombre = '$nombre'")){
                    echo json_encode(array("result"=>false,"msj"=>"El nombre ingresado ya se encuentra registrado"));
                    exit;
                }
                
                $this->ws->insertar($this->id_modulo,$datos);
                echo json_encode(array("result"=>true,"msj"=>"Datos Ingresados Correctamente."));
            }
		}else
			echo json_encode(array("result"=>false,"msj"=>"No se recibieron datos."));
	}

	public function eliminar(){

        try{
            
            #no puede ser eliminado el centro de costos SUR ACTIVO
            if($this->input->post('codigo') == 1){
                throw new Exception('');
            }
            
			$this->ws->eliminar($this->id_modulo,$this->prefijo_pri."codigo = {$this->input->post('codigo')}");
			echo json_encode(array("result"=>true));
		}
		catch(Exception $e){
			echo json_encode(array("result"=>false,"msg"=>"Ha ocurrido un error inesperado. Por favor, inténtelo nuevamente."));
		}
	}

}

	/*public function index()
	{
		#title
		$this->layout->title('Pyme Base HTML5');
		
		#metas
		$this->layout->setMeta('title','Pyme Base HTML5');
		$this->layout->setMeta('description','Pyme Base HTML5');
		$this->layout->setMeta('keywords','Pyme Base HTML5');
		
		$contenido['home_indicador'] = true;
		
		$this->layout->nav(array("Fichas Clínicas" => "/"));
		
		$this->layout->view('index',$contenido);
		
	}
	
		public function agregar()
	{
		#title
		$this->layout->title('Pyme Base HTML5');
		
		#metas
		$this->layout->setMeta('title','Pyme Base HTML5');
		$this->layout->setMeta('description','Pyme Base HTML5');
		$this->layout->setMeta('keywords','Pyme Base HTML5');
		
		$contenido['home_indicador'] = true;
		
		$this->layout->nav(array("Fichas Clínicas" => "/"));
		
		$this->layout->view('agregar',$contenido);
		
	}
	
}*/

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

