<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class centros_medicos extends CI_Controller {

    //public $permisos;
	function __construct(){

		parent::__construct();

        //principal
		$this->id_modulo = 38;
        $this->prefijo_pri = "cen_";
        $this->title_gen_plu = "centros_medicos";
        $this->title_gen_sin = "centro_medico";
        $this->nombre_gen_plu = "centros_medicos";
        $this->nombre_gen_sin = "centro_medico";

           //relacion insumos
        $this->id_modulo_rel = 39;
        $this->prefijo_rel = "unid_";
        $this->nombre_rel_plu = "unidad";

                  //relacion tipos de control insumos
        //$this->id_modulo_rel2 = 20;
        //$this->prefijo_rel2 = "tipo_";
        //$this->nombre_rel_plu2 = "tipos_de_control_insumos";

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

		$data['centro_medico_f'] = false;

        $estado=false;$buscar=false;
		$data['estado']=$estado;
		$data['buscar']=$buscar;
        
		if($this->uri->segment(3)=='busqueda'){
			$url_busqueda = 'busqueda/'.$this->uri->segment(4).'/';
			$data['centro_medico_f'] = $this->uri->segment(4);
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
				$data['rel'] = $this->ws->listar($this->id_modulo_rel);

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

   	
    	if($this->id_modulo_rel)
    	{
    	$this->ws->order(array($this->prefijo_rel.'nombre ASC'));

		$data['rel'] = $this->ws->listar($this->id_modulo_rel);
		}

      //print_array($data);die;
		#La vista siempre,  debe ir cargada al final de la función
		$this->layout->view('/'.$this->nombre_gen_plu.'/administrar',$data);
	}

	public function process($codigo = false){
		$datos = $this->input->post();
        if($datos){

            $nombre = $datos[$this->prefijo_pri."nombre"];
           // $tipo_= $datos[$this->prefijo_pri."tipo_"];

   
            //print_array($datos);
            //die('process');

         

            if($codigo){

                #revisa que el nombre ingresado no exista
                if($this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo <> $codigo and ".$this->prefijo_pri."nombre = '$nombre' ")){
                    echo json_encode(array("result"=>false,"msj"=>"El nombre y tipo ingresado ya se encuentra registrado"));
                    exit;
                }

                $this->ws->actualizar($this->id_modulo,$datos,$this->prefijo_pri."codigo = {$codigo}");
                echo json_encode(array("result"=>true,"msj"=>"Datos Actualizados Correctamente."));
            }else{

                #revisa que el nombre ingresado no exista
                if($this->ws->obtener($this->id_modulo,$this->prefijo_pri."nombre = '$nombre' ")){
                    echo json_encode(array("result"=>false,"msj"=>"El nombre y tipo ingresado ya se encuentra registrado"));
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
			$eliminar = $this->ws->eliminar($this->id_modulo,$this->prefijo_pri."codigo = {$this->input->post('codigo')}");
	//		$this->layout->view('/'.$this->nombre_gen_plu.'/index');
						echo json_encode(array("result"=>true));


		}
		catch(Exception $e){
			echo json_encode(array("result"=>false,"msg"=>"Ha ocurrido un error inesperado. Por favor, inténtelo nuevamente."));
		}
	}

 
	public function processunidad($codigo = false){
		$datos = $this->input->post();

		 $nombre= $datos[$this->prefijo_rel."nombre"];
		 $centro_medico=$datos[$this->prefijo_rel."centro_medico"];

		 				//print_array($datos);die('prueba');


        if($datos){

          
  			#revisa que el nombre ingresado no exista
            if($this->ws->obtener($this->id_modulo_rel,$this->prefijo_rel."centro_medico = $centro_medico and ".$this->prefijo_rel."nombre = '$nombre' ")){
                echo json_encode(array("result"=>false,"msj"=>"La unidad ingresada ya se encuentra registrado para este centro medico"));
                    exit;
            }
                //print_array($datos);die('asdsad');

                $this->ws->insertar($this->id_modulo_rel,$datos);

            //$this->ws->actualizar($this->id_modulo,"tip_codigo = {$tipo_de_control}");

            echo json_encode(array("result"=>true,"msj"=>"Datos Ingresados Correctamente."));
            
		}else
			echo json_encode(array("result"=>false,"msj"=>"No se recibieron datos."));
	}





	public function eliminarunidad(){

    try{

    	//print_array($this->input->post('codigo'));die('elimi');

    		$eliminar = $this->ws->eliminar($this->id_modulo_rel,$this->prefijo_rel."codigo = {$this->input->post('codigo')}");

			//$eliminar = $this->ws->eliminar($this->id_modulo_rel,$this->prefijo_rel."codigo = {$this->input->post('codigo')}");
    	//print_array($eliminar);die('elimi');

			echo json_encode(array("result"=>true));


		}
		catch(Exception $e){
			echo json_encode(array("result"=>false,"msg"=>"Ha ocurrido un error inesperado. Por favor, inténtelo nuevamente."));
		}
	}

}
