<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class Kinesiologos2 extends CI_Controller {

	function __construct(){

		parent::__construct();

		#si no esta logeado
		/*if(!$this->session->userdata('usuario')){
				redirect('/');
		}*/

		/*if($this->session->userdata('usuario')->perfil){
			$where = "perf_perfil = {$this->session->userdata('usuario')->perfil}";
			$this->ws->group("sec_codigo");
			$this->ws->order("sec_orden ASC");
			$this->ws->joinInner(35,"secc_codigo = perf_secciones_acciones"); //Secciones Acciones
			$this->ws->joinInner(33,"sec_codigo = secc_seccion"); //Secciones
			$per_secciones = $this->ws->listar(37,$where); //Perfil acciones
			$this->perfil->perfil = true;
			$this->perfil->url = $per_secciones[0]->secciones->url;
		}else
			$this->perfil["perfil"] = false;*/

		#current
		$this->layout->current = 3;

		$this->id_modulo = 14;
		$this->prefijo_pri = " kin_";
		$this->title_gen_plu = "kinesiologos2";
		$this->title_gen_sin = "kinesiologos2";
		$this->nombre_gen_plu = "kinesiologos2";
		$this->nombre_gen_sin = "kinesiologos2";
	}

	public function index()	{

		#Title
		$this->layout->title('Mantenedores');

		#Metas
		$this->layout->setMeta('title','Mantenedores');
		$this->layout->setMeta('description','Mantenedores');
		$this->layout->setMeta('keywords','Mantenedores');

		#JS - Datepicker
		$this->layout->js('/js/jquery/datepicker/bootstrap-datepicker.js');
		$this->layout->css('/js/jquery/datepicker/datepicker3.css');

		#JS - pagination
		$this->layout->js('/js/jquery/rpage-master/responsive-paginate.js');
		$this->layout->js('/js/jquery/rpage-master/paginate-init.js');

		$this->layout->js('/js/jquery/noty/packaged/jquery.noty.packaged.js');
		$this->layout->js('/js/jquery/validation-engine/js/jquery.validationEngine.js');
		$this->layout->js('/js/jquery/validation-engine/js/languages/jquery.validationEngine-es.js');

		//$this->layout->js('/js/sistema/mantenedores/'.$this->nombre_gen_plu.'/administrar.js');
		$this->layout->js('/js/sistema/mantenedores/'.$this->nombre_gen_plu.'/index.js');

		#Nav
		$this->layout->nav(array("Mantenedores: ".$this->title_gen_plu.""=>"/"));

		$data = false;$where = false;$url = false;$and=false;
		$url_busqueda= false;
		$config['uri_segment'] = $segment = 3;
		//$data['perfil'] = $this->perfil;

		$estado=false;$buscar=false;
		$data['estado']=$estado;
		$data['buscar']=$buscar;


		//sacar estado que esta en la posicion 4 de la ruta (url)
		if($this->uri->segment(3)=="estado"  )
  		{
  			//sacar fecha que esta en la posicion 4 de la ruta (url)
			$estado=$this->uri->segment(4);
			//guardar el estado en data para enviarlo a la vista
        	$data['estado']=$estado;
        	//se muestra los datos con estado  igual al enviado por parametro 
			$where="kin_estado = '{$estado}'";
			//asignar paginacion a posicion 5 de la url 
			$config['uri_segment'] = $segment = 5;
			//se muestra los datos con la fecha puesta como parametro 
			$url_busqueda=$url_busqueda.'estado/'.$estado.'/';
           	//setear variable and por si se realizara una nueva consulta
			$and=" and ";

		}



			//sacar estado que esta en la posicion 4 de la ruta (url)
		if($this->uri->segment(3)=="buscar")
        {
        	//sacar buscar que esta en la posicion 4 de la ruta (url)
			$buscar=$this->uri->segment(4);
			//guardar buscar  en data para enviarlo a la vista
			$data['buscar']=$buscar;
			//se muestra los datos con buscar  coincidente  al enviado por parametro 
			$where=$where.$and."(kin_nombre LIKE '{$buscar}%' or kin_nombre LIKE '%{$buscar}' or kin_nombre LIKE '%{$buscar}%' or kin_nombre LIKE '% {$buscar} %')";
			//asignar paginacion a posicion 6 de la url , 4 es buscar y 5 el valor de buscar
			$config['uri_segment'] = $segment = 6;
			//se muestra los datos con buscar  concidente con el enviado  por parametro 
			$url_busqueda=$url_busqueda.'buscar/'.$buscar.'/';
			//setear variable and por si se realizara una nueva consulta
			$and=" and ";

		}
        
       	//sacar estado que esta en la posicion 4 de la ruta (url)
		if($this->uri->segment(5)=="estado"  )
        {
        	//sacar fecha que esta en la posicion 4 de la ruta (url)
			$estado=$this->uri->segment(6);
			//guardar el estado en data para enviarlo a la vista
			$data['estado']=$estado;
			//se muestra los datos con estado  igual al enviado por parametro 
			$where=$where.$and."kin_estado = '{$estado}'";
			//asignar paginacion a posicion 7 de la url , 5 es fecha y 6 el valor de fecha
			$config['uri_segment'] = $segment = 7;
			//se muestra los datos con la fecha puesta como parametro 
			$url_busqueda=$url_busqueda.'estado/'.$estado.'/';
			//setear variable and por si se realizara una nueva consulta
			$and=" and ";


        }
	
		
		//sacar estado que esta en la posicion 6 de la ruta (url)
		if($this->uri->segment(5)=="buscar")
		{
			//sacar buscar que esta en la posicion 4 de la ruta (url)
			$buscar=$this->uri->segment(6);
			//guardar buscar  en data para enviarlo a la vista
			$data['buscar']=$buscar;
			//se muestra los datos con buscar  coincidente  al enviado por parametro 
			$where=$where.$and."(kin_nombre LIKE '{$buscar}%' or kin_nombre LIKE '%{$buscar}' or kin_nombre LIKE '%{$buscar}%' or kin_nombre LIKE '% {$buscar} %')";
			//asignar paginacion a posicion 6 de la url , 4 es buscar y 5 el valor de buscar
			$config['uri_segment'] = $segment = 7;
			//se muestra los datos con buscar  concidente con el enviado  por parametro 
			$url_busqueda=$url_busqueda.'buscar/'.$buscar.'/';
			//setear variable and por si se realizara una nueva consulta
			$and=" and ";

		}

		

		#paginacion
		$config['base_url'] = '/mantenedores/'.$this->nombre_gen_plu.'/'.$url_busqueda;
		$config['total_rows'] = count($this->ws->listar($this->id_modulo,$where));
		$config['per_page'] = 5;
		//$config['uri_segment'] = $segment = 3;
		$config['suffix'] = $url;
		$config['first_url'] = '/mantenedores/'.$this->nombre_gen_plu.$url;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment($segment))?$this->uri->segment($segment)-1:0;


		#contenido
		$this->ws->limit($config["per_page"],$page*$config["per_page"]);
		//$this->ws->order($this->prefijo_pri.'fecha DESC');
		$data["datos"] = $this->ws->listar($this->id_modulo,$where);
		$data['pagination'] = $this->pagination->create_links();

		#La vista siempre,  debe ir cargada al final de la función
		$this->layout->view('/'.$this->nombre_gen_plu.'/index',$data);
	}

	public function administrar() {

		if($this->uri->segment(4))
			$codigo = $this->uri->segment(4);
		else
			$codigo = false;

		#Title
		$this->layout->title('Mantenedores');

		#Metas
		$this->layout->setMeta('title','Mantenedores');
		$this->layout->setMeta('description','Mantenedores');
		$this->layout->setMeta('keywords','Mantenedores');

		#JS - Multiple select boxes
		$this->layout->css('/js/jquery/bootstrap-multi-select/dist/css/bootstrap-select.css');
		$this->layout->js('/js/jquery/bootstrap-multi-select/js/bootstrap-select.js');

		$this->layout->js('/js/jquery/noty/packaged/jquery.noty.packaged.js');
		$this->layout->js('/js/jquery/validation-engine/js/jquery.validationEngine.js');
		$this->layout->js('/js/jquery/validation-engine/js/languages/jquery.validationEngine-es.js');

		#JS - Editor
		$this->layout->js('/js/jquery/ckeditor-standard/ckeditor.js');

		$this->layout->js('/js/sistema/mantenedores/'.$this->nombre_gen_plu.'/administrar.js');
				//$this->layout->js('/js/sistema/mantenedores/'.$this->nombre_gen_plu.'/index.js');


		#Nav
		if($codigo)
			$this->layout->nav(array("Mantenedores: $this->title_gen_plu"=>"mantenedores/$this->nombre_gen_plu", "Mantenedores: Editar $this->title_gen_sin"=>"/"));
		else
			$this->layout->nav(array("Mantenedores: $this->title_gen_plu"=>"mantenedores/$this->nombre_gen_plu", "Mantenedores: Agregar $this->title_gen_sin"=>"/"));

		$data = false;
		//$data['perfil'] = $this->perfil;
		if($codigo)
			$data["dato"] = $this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo = {$codigo}");


		//print_array($data);die;
		#La vista siempre,  debe ir cargada al final de la función
		$this->layout->view('/'.$this->nombre_gen_plu.'/administrar',$data);
	}

	public function process(){

		//echo 'entro a process';die();
		if($this->uri->segment(4))
			$codigo = $this->uri->segment(4);
		else
			$codigo = false;

		$datos = $this->input->post();

		//print_array($datos);die('process');
		if($datos){
			//$fecha = explode("/",$this->input->post("fecha"));
			//$datos["kin_fecha"] = $fecha[2]."-".$fecha[0]."-".$fecha[1];
            if($codigo){
                $this->ws->actualizar($this->id_modulo,$datos,$this->prefijo_pri."codigo = {$codigo}");
                echo json_encode(array("result"=>true,"msj"=>"Datos Actualizados Correctamente."));
            }else{

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

}
