<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class Fichas_clinicas extends CI_Controller {

    //public $permisos;
	function __construct(){

		parent::__construct();

        //principal
		$this->id_modulo = 36;
        $this->prefijo_pri = "fic_";
        $this->title_gen_plu = "fichas_clinicas";
        $this->title_gen_sin = "ficha_clinica";
        $this->nombre_gen_plu = "fichas_clinicas";
        $this->nombre_gen_sin = "ficha_clinica";


          //relacion insumos
        $this->id_modulo_rel = 13;
        $this->prefijo_rel = "cent_";
        $this->nombre_rel_plu = "centros_medicos";

                  //relacion tipos de control insumos
        $this->id_modulo_rel2 = 20;
        $this->prefijo_rel2 = "tipo_";
        $this->nombre_rel_plu2 = "fichas_clinicas_insumos";


     	  	//relacion unidad
        $this->id_modulo_rel3 = 34 ;
        $this->prefijo_rel3 = "uni_";
        $this->nombre_rel3_plu = "unidad";
        #revisa los permisos para el modulo Fichas_clinicas
        #$this->permisos = $this->layout->obtener_permisos(5);

        //if(!$this->permisos)
         //   redirect('/');
	}

	public function index()	{
	   
       
		#Title
		$this->layout->title('Fichas_clinicas');

		#JS - Multiple select
		$this->layout->css('/js/jquery/bootstrap/bootstrap-multi-select/dist/css/bootstrap-select.css');
		$this->layout->js('/js/jquery/bootstrap/bootstrap-multi-select/js/bootstrap-select.js');

		$this->layout->js('/js/jquery/noty/packaged/jquery.noty.packaged.js');
		$this->layout->js('/js/jquery/validation-engine/js/jquery.validationEngine.js');
		$this->layout->js('/js/jquery/validation-engine/js/languages/jquery.validationEngine-en.js');

		$this->layout->js('/js/sistema/fichas_clinicas/'.$this->nombre_gen_plu.'/administrar.js');

		#JS - pagination
		$this->layout->js('/js/jquery/rpage-master/responsive-paginate.js');
		$this->layout->js('/js/jquery/rpage-master/paginate-init.js');

		#Nav
		$this->layout->nav(array("Fichas_clinicas: ".$this->title_gen_plu.""=>"/"));

		$data = false;$where = false;$url = false;
		$url_busqueda = false;
		$url_estado = false;

		$data['fichas_clinicas_f'] = false;

        $estado=false;$buscar=false;
		$data['estado']=$estado;
		$data['buscar']=$buscar;
        
		if($this->uri->segment(3)=='busqueda'){
			$url_busqueda = 'busqueda/'.$this->uri->segment(4).'/';
			$data['fichas_clinicas_f'] = $this->uri->segment(4);
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
		$config['base_url'] = '/fichas_clinicas/'.$this->nombre_gen_plu.'/'.$url_busqueda;

        
           #echo $where; die;      
        
        
		#paginacion
		$config['base_url'] = '/fichas_clinicas/'.$this->nombre_gen_plu.'/'.$url_busqueda;
		
		$config['total_rows'] = count($this->ws->listar($this->id_modulo,$where));
		$config['per_page'] = 3;
        $config['num_links'] = 30;
		$config['suffix'] = $url;
		$config['first_url'] = '/fichas_clinicas/'.$this->nombre_gen_plu.'/'.$url_busqueda;

		$config['next_link'] = '>>';//siguiente link
 		$config['prev_link'] = '<<';//anterior link
		$this->pagination->initialize($config);
		$page = ($this->uri->segment($segment))?$this->uri->segment($segment)-1:0;

		#contenido
		$this->ws->limit($config["per_page"],$page*$config["per_page"]);
        
       	//$data["datos"] = $this->ws->order($this->id_modulo,"codigo"=>"DESC");
       	$this->ws->order(array($this->prefijo_pri.'nombre ASC'));

		$data["datos"] = $this->ws->listar($this->id_modulo,$where);
    //print_array($data["datos"]);die;
		$data['pagination'] = $this->pagination->create_links();

		//Centro de costos
    //print_array($data);die;

		#La vista siempre,  debe ir cargada al final de la función
		$this->layout->view('/'.$this->nombre_gen_plu.'/index',$data);
	}

	public function administrar($codigo = false){

        #permisos del usuario
        //if(!$this->permisos->agregar && !$this->permisos->editar)
        //    redirect('/fichas_clinicas/'.$this->nombre_gen_plu.'/');

		#Title
		$this->layout->title('Fichas_clinicas');

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

		$this->layout->js('/js/sistema/fichas_clinicas/'.$this->nombre_gen_plu.'/administrar.js');

		#Nav
		if($codigo)
			$this->layout->nav(array("Fichas_clinicas: $this->title_gen_plu"=>"fichas_clinicas/$this->nombre_gen_plu", "Fichas_clinicas: Editar $this->title_gen_sin"=>"/"));
		else
			$this->layout->nav(array("Fichas_clinicas: $this->title_gen_plu"=>"fichas_clinicas/$this->nombre_gen_plu", "Fichas_clinicas: Agregar $this->title_gen_sin"=>"/"));


		$data = false;
		if($codigo)
			$data["dato"] = $this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo = {$codigo}");



    	if($this->id_modulo_rel)
    	{
    	$this->ws->order(array($this->prefijo_rel.'nombre ASC'));

		$data['rel'] = $this->ws->listar($this->id_modulo_rel);
		}

	if($this->id_modulo_rel2)

		$this->ws->order(array($this->prefijo_rel2.'codigo DESC'));

		$data['rel2'] = $this->ws->listar($this->id_modulo_rel2);


	if($this->id_modulo_rel3)

		$this->ws->order(array($this->prefijo_rel3.'codigo ASC'));

		$data['rel3'] = $this->ws->listar($this->id_modulo_rel3);
		
		
   
   		print_array($data);die();
		#La vista siempre,  debe ir cargada al final de la función
		$this->layout->view('/'.$this->nombre_gen_plu.'/administrar',$data);
	}

	
	public function process($codigo = false){
		$datos = $this->input->post();
        if($datos){

            $nombre = $datos[$this->prefijo_pri."nombre"];
     
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
                if($this->ws->obtener($this->id_modulo,$this->prefijo_pri."nombre = '$nombre'")){
                    echo json_encode(array("result"=>false,"msj"=>"El nombre y tipo ingresado ya se encuentra registrado"));
                    exit;
                }

                $this->ws->insertar($this->id_modulo,$datos);

                echo json_encode(array("result"=>true,"msj"=>"Datos Ingresados Correctamente."));
            }
		}else
			echo json_encode(array("result"=>false,"msj"=>"No se recibieron datos."));
	}

	public function processstock($codigo = false){
		$datos = $this->input->post();
		 $tipo_insumo= $datos[$this->prefijo_rel2."insumo"];
         $tipo_ficha_clinica= $datos[$this->prefijo_rel2."ficha_clinica"];

        if($datos){

          
  			#revisa que el nombre ingresado no exista
            if($this->ws->obtener($this->id_modulo_rel2,"tipo_insumo = '$tipo_insumo' and tipo_ficha_clinica = '$tipo_ficha_clinica'")){
                echo json_encode(array("result"=>false,"msj"=>"El insumo  ingresado ya se encuentra registrado"));
                    exit;
            }
                //print_array($datos);die('asdsad');

                $this->ws->insertar($this->id_modulo_rel2,$datos);

            //$this->ws->actualizar($this->id_modulo,"fic_codigo = {$ficha_clinica}");

            echo json_encode(array("result"=>true,"msj"=>"Datos Ingresados Correctamente."));
            
		}else
			echo json_encode(array("result"=>false,"msj"=>"No se recibieron datos."));
	}


	public function agregar_control_operativo($codigo = false){

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
		$this->layout->view('/'.$this->nombre_gen_plu.'/agregar_control_operativo',$data);
	}
	
	public function eliminar(){

    try{


    		$eliminar = $this->ws->eliminar($this->id_modulo_rel,$this->prefijo_rel."ficha_clinica = {$this->input->post('codigo')}");

			$eliminar = $this->ws->eliminar($this->id_modulo,$this->prefijo_pri."codigo = {$this->input->post('codigo')}");

			echo json_encode(array("result"=>true));


		}
		catch(Exception $e){
			echo json_encode(array("result"=>false,"msg"=>"Ha ocurrido un error inesperado. Por favor, inténtelo nuevamente."));
		}
	}



	public function eliminarstock(){

    try{
			$eliminar = $this->ws->eliminar($this->id_modulo_rel,$this->prefijo_rel."codigo = {$this->input->post('codigo')}");

			echo json_encode(array("result"=>true));


		}
		catch(Exception $e){
			echo json_encode(array("result"=>false,"msg"=>"Ha ocurrido un error inesperado. Por favor, inténtelo nuevamente."));
		}
	}

 

}
