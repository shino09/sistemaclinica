<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class modos_ventilatorios extends CI_Controller {

    //public $permisos;
	function __construct(){

		parent::__construct();

        //principal
		$this->id_modulo = 29;
        $this->prefijo_pri = "modo_";
        $this->title_gen_plu = "modos_ventilatorios";
        $this->title_gen_sin = "modo_ventilatorio";
        $this->nombre_gen_plu = "modos_ventilatorios";
        $this->nombre_gen_sin = "modo_ventilatorio";


           //relacion 1
        $this->id_modulo_rel = 31;
        $this->prefijo_rel = "mod2_";
        $this->nombre_rel_plu = "modos_ventilatorios_relaciones";

             //relacion 1
        $this->id_modulo_rel2 = 32;
        $this->prefijo_rel2 = "mod3_";
        $this->nombre_rel2_plu = "modos_ventilatorios_relaciones_intermedia";

     

     
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

		$data['modo_ventilatorio_f'] = false;

        $estado=false;$buscar=false;
		$data['estado']=$estado;
		$data['buscar']=$buscar;
        
		if($this->uri->segment(3)=='busqueda'){
			$url_busqueda = 'busqueda/'.$this->uri->segment(4).'/';
			$data['modo_ventilatorio_f'] = $this->uri->segment(4);
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
        
       	//$data["datos"] = $this->ws->order($this->id_modulo,"codigo"=>"DESC");
       	$this->ws->order(array($this->prefijo_pri.'nombre ASC'));

		$data["datos"] = $this->ws->listar($this->id_modulo,$where);
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
      $data['rel'] = $this->ws->listar($this->id_modulo_rel);

     if($this->id_modulo_rel2)
      $data['rel2'] = $this->ws->listar($this->id_modulo_rel2);

   
      //print_array($data);die;
		#La vista siempre,  debe ir cargada al final de la función
		$this->layout->view('/'.$this->nombre_gen_plu.'/administrar',$data);
	}

	public function process($codigo = false){
		$datos = $this->input->post();
        if($datos){

            $nombre = $datos[$this->prefijo_pri."nombre"];
            $tipo= $datos[$this->prefijo_pri."tipo"];
           
            
   
            //print_array($datos);
            //die('process');

         

            if($codigo){

                #revisa que el nombre ingresado no exista
                if($this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo <> $codigo and ".$this->prefijo_pri."nombre = '$nombre'  and ".$this->prefijo_pri."tipo = '$tipo'")){
                    echo json_encode(array("result"=>false,"msj"=>"El nombre y tipo ingresado ya se encuentra registrado"));
                    exit;
                }

                 $datos_rel2[$this->prefijo_rel2."modo_ventilatorio"]=$codigo;
                 $relaciones=$datos["relaciones"];
  
                  $this->ws->actualizar($this->id_modulo,$datos,$this->prefijo_pri."codigo = {$codigo}");

                  $modos_ventilatorios_relaciones_intermedia_existentes=$this->ws->listar($this->id_modulo_rel2,"mod3_modo_ventilatorio = '$codigo'" );
                  //$relaciones_existentes=$modos_ventilatorios_relaciones_intermedia_existentes["modo_ventilatorio_relacion"];


                  foreach ($modos_ventilatorios_relaciones_intermedia_existentes as $rel_exi) {
                  		 $relacion_bd[]=$rel_exi->modo_ventilatorio_relacion;
              		}
                   

                $insertar = array_diff($relaciones, $relacion_bd);
				$eliminar = array_diff($relacion_bd, $relaciones);


				foreach ($insertar as $ins) {
                $datos_rel2[$this->prefijo_rel2."modo_ventilatorio_relacion"]=$ins;  
                $this->ws->insertar($this->id_modulo_rel2,$datos_rel2);
                }   

               foreach ($eliminar as $eli) {

             	$this->ws->eliminar($this->id_modulo_rel2,"mod3_modo_ventilatorio = '{$codigo}' and  mod3_modo_ventilatorio_relacion = '{$eli}'");
                  	}

                
                echo json_encode(array("result"=>true,"msj"=>"Datos Actualizados Correctamente."));
            }else{

                #revisa que el nombre ingresado no exista
                if($this->ws->obtener($this->id_modulo,$this->prefijo_pri."nombre = '$nombre' and ".$this->prefijo_pri."tipo = '$tipo'")){
                    echo json_encode(array("result"=>false,"msj"=>"El nombre y tipo ingresado ya se encuentra registrado"));
                    exit;
                }

                   	//print_array($datos);die('datos1');

                $codigo_modo_ventilatorio=$this->ws->insertar($this->id_modulo,$datos);
                $codigo_modo_ventilatorio=$codigo_modo_ventilatorio->modo_codigo;
                 $datos_rel2[$this->prefijo_rel2."modo_ventilatorio"]=$codigo_modo_ventilatorio;
                 $relaciones=$datos["relaciones"];
                  foreach ($relaciones as $rel) {

                	$datos_rel2[$this->prefijo_rel2."modo_ventilatorio_relacion"]=$rel;
                	//print_array($datos_rel2);die('datos2');
                	$this->ws->insertar($this->id_modulo_rel2,$datos_rel2);

                }


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

 

}
