<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class Kinesiologos extends CI_Controller {

    //public $permisos;
	function __construct(){

		parent::__construct();

        //principal
		$this->id_modulo = 14;
        $this->prefijo_pri = "kin_";
        $this->title_gen_plu = "kinesiologos";
        $this->title_gen_sin = "kinesiologo";
        $this->nombre_gen_plu = "kinesiologos";
        $this->nombre_gen_sin = "kinesiologo";

      

        #revisa los permisos para el modulo mantenedores
       // $this->permisos = $this->layout->obtener_permisos(5);

        //if(!$this->permisos)
          //  redirect('/');
	}

	public function index()	{

		#Title
		$this->layout->title('Mantenedores');

		#JS - Multiple select
		$this->layout->css('/js/jquery/validation-engine/css/validationEngine.jquery.css');

		$this->layout->css('/js/jquery/bootstrap/bootstrap-multi-select/dist/css/bootstrap-select.css');
		$this->layout->js('/js/jquery/bootstrap/bootstrap-multi-select/js/bootstrap-select.js');

		$this->layout->js('/js/jquery/validation-engine/js/jquery.validationEngine.js');
		$this->layout->js('/js/jquery/validation-engine/js/languages/jquery.validationEngine-es.js');
		$this->layout->js('/js/jquery/noty/packaged/jquery.noty.packaged.js');


 
		$this->layout->js('/js/sistema/mantenedores/'.$this->nombre_gen_plu.'/index.js');


		#JS - pagination
		$this->layout->js('/js/jquery/rpage-master/responsive-paginate.js');
		$this->layout->js('/js/jquery/rpage-master/paginate-init.js');


		#Nav
		$this->layout->nav(array("Mantenedores: ".$this->title_gen_plu.""=>"/"));

		$data = false;$where = false;$url = false;
		$url_busqueda = false;
		//$data['centro_f'] = false;
		$data['kinesiologo_f'] = false;
		if($this->uri->segment(3)=='busqueda'){
			$url_busqueda = 'busqueda/'.$this->uri->segment(4).'/';
			$data['kinesiologo_f'] = $this->uri->segment(4);
			$where = "(".$this->prefijo_pri."nombre like '".$this->uri->segment(4)."%' or ".$this->prefijo_pri."nombre like '%".$this->uri->segment(4)."' or ".$this->prefijo_pri."nombre like '%".$this->uri->segment(4)."%')";
			$config['uri_segment'] = $segment = 5;
		}
		
		if(!$url_busqueda){
			$config['uri_segment'] = $segment = 3;
		}
		#paginacion
		$config['base_url'] = '/mantenedores/'.$this->nombre_gen_plu.'/'.$url_busqueda;
		//if($this->id_modulo_rel)
      //$this->ws->joinInner($this->id_modulo_rel,$this->prefijo_rel."codigo = ".$this->prefijo_pri.$this->nombre_rel_plu);
		$config['total_rows'] = count($this->ws->listar($this->id_modulo,$where));
		$config['per_page'] = 1;
    $config['num_links'] = 30;
		$config['suffix'] = $url;
		$config['first_url'] = '/mantenedores/'.$this->nombre_gen_plu.'/'.$url_busqueda;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment($segment))?$this->uri->segment($segment)-1:0;

		#contenido
		$this->ws->limit($config["per_page"],$page*$config["per_page"]);
    //if($this->id_modulo_rel)
      //$this->ws->joinInner($this->id_modulo_rel,$this->prefijo_rel."codigo = ".$this->prefijo_pri.$this->nombre_rel_plu);
		//$this->ws->order(array($this->prefijo_rel.'nombre ASC',$this->prefijo_pri.'nombre ASC'));
		$data["datos"] = $this->ws->listar($this->id_modulo,$where);
    //print_array($data["datos"]);die;
		$data['pagination'] = $this->pagination->create_links();

		//Centro de costos
		//$data["rel"] = $this->ws->listar($this->id_modulo_rel,$this->prefijo_rel."estado = 1");

		#La vista siempre,  debe ir cargada al final de la función
		$this->layout->view('/'.$this->nombre_gen_plu.'/index',$data);
	}

	public function administrar($codigo = false){

        #permisos del usuario
        //if(!$this->permisos->agregar && !$this->permisos->editar)
          //  redirect('/mantenedores/'.$this->nombre_gen_plu.'/');


		//die('llego a administar');
		#Title
		$this->layout->title('Mantenedores');

		#JS - Form elements
		$this->layout->js('/js/jquery/form-elements/custom-form-elements.min.js');
		$this->layout->css('/js/jquery/form-elements/form.css');

		#JS - Calendario
		$this->layout->js('/js/jquery/bootstrap/datepicker/bootstrap-datepicker.js');
		$this->layout->css('/js/jquery/bootstrap/datepicker/datepicker3.css');

		#JS - Multiple selevalidationEnginect
		$this->layout->css('/js/jquery/bootstrap/bootstrap-multi-select/dist/css/bootstrap-select.css');
		$this->layout->js('/js/jquery/bootstrap/bootstrap-multi-select/js/bootstrap-select.js');

			  //$this->layout->css('/js/jquery/validation-engine/css/validationEngine.jquery.css');
//$this->layout->js('/js/jquery/validation-engine/js/jquery.validationEngine.js');
//$this->layout->js('/js/jquery/validation-engine/js/languages/jquery.validationEngine-es.js');
		$this->layout->js("/js/jquery/noty/packaged/jquery.noty.packaged.js");

		$this->layout->js('/js/sistema/mantenedores/'.$this->nombre_gen_plu.'/administrar.js');
				//$this->layout->js('/js/sistema/mantenedores/'.$this->nombre_gen_plu.'/index.js');



		//print_array($codigo);

		//echo $this->title_gen_sin;die('sdds');
		#Nav
		if($codigo)
			$this->layout->nav(array("Mantenedores: $this->title_gen_plu"=>"mantenedores/$this->nombre_gen_plu", "Mantenedores: Editar $this->title_gen_sin"=>"/"));
		else
			$this->layout->nav(array("Mantenedores: $this->title_gen_plu"=>"mantenedores/$this->nombre_gen_plu", "Mantenedores: Agregar $this->title_gen_sin"=>"/"));

		$data = false;


		if($codigo)
			$data["dato"] = $this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo = {$codigo}");

		//print_array($this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo = {$codigo}"));die('sdds');
    //if($this->id_modulo_rel)
      //$data['rel'] = $this->ws->listar($this->id_modulo_rel);
      //print_array($data);die;
		#La vista siempre,  debe ir cargada al final de la función
		$this->layout->view('/'.$this->nombre_gen_plu.'/administrar',$data);
	}

	public function process($codigo = false){

		//print_array($this->input->post());die('llego a proceess');
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

	public function eliminar($codigo ){

    try{
			$eliminar = $this->ws->eliminar($this->id_modulo,$this->prefijo_pri."codigo = {$codigo}");
			//echo json_encode(array("result"=>true));
					$this->layout->view('/'.$this->nombre_gen_plu.'/administrar');

		}
		catch(Exception $e){
			echo json_encode(array("result"=>false,"msg"=>"Ha ocurrido un error inesperado. Por favor, inténtelo nuevamente."));
		}
	}

  public function listar_kinesiologos(){
    if($codigo = $this->input->post("codigo")){
      $provincias = $this->ws->listar($this->id_modulo,$this->prefijo_pri.$this->nombre_rel_plu." = ".$codigo);
      $html = '<option value="">Seleccione</option>';
      foreach($provincias as $data):
          $html .= '<option value="'.$data->codigo.'">'.$data->nombre.'</option>';
      endforeach;
      echo $html;
    }
  }

}
