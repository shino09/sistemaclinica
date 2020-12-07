<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class Pacientes extends CI_Controller {

    //public $permisos;
	function __construct(){

		parent::__construct();


		  //principal
		$this->id_modulo = 37;
        $this->prefijo_pri = "con_";
        $this->title_gen_plu = "pacientes";
        $this->title_gen_sin ="pacientes";
        $this->nombre_gen_plu = "pacientes";
        $this->nombre_gen_sin ="pacientes";


     

             //relacion insumos
        /*$this->id_modulo_rel = 36;
        $this->prefijo_rel = "fic_";
        $this->nombre_rel_plu = "fichas_clinicas";*/

		//relacion insumos
        $this->id_modulo_rel2 = 38;
        $this->prefijo_rel2 = "cen_";
        $this->nombre_rel2_plu = "centros_medicos";

        //relacion equipos
        $this->id_modulo_rel3 = 15;
        $this->prefijo_rel3 = "equ_";
        $this->nombre_rel3_plu = "equipos";

        //relacion  insumos
        $this->id_modulo_rel4 = 18;
        $this->prefijo_rel4 = "ins_";
        $this->nombre_rel4_plu = "insumos";
    	
    	//relacion modos ventilatorios
        $this->id_modulo_rel5 = 29;
        $this->prefijo_rel5 = "modo_";
        $this->nombre_rel5_plu = "modos_ventilatorios";


    	//relacion unidad
        $this->id_modulo_rel6 = 39 ;
        $this->prefijo_rel6 = "unid_";
        $this->nombre_rel6_plu = "unidad";

        	//relacion unidad
        $this->id_modulo_rel7 = 36 ;
        $this->prefijo_rel7 = "fic_";
        $this->nombre_rel7_plu = "fichas_clinicas";
     
        #revisa los permisos para el modulo Fichas_clinicas
        #$this->permisos = $this->layout->obtener_permisos(5);

        //if(!$this->permisos)
         //   redirect('/');
	}

	public function index()	{
	   
       
		#Title
		$this->layout->title('Pacientes');

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
		//$data['pacientes_f'] = false;
		$joincentros=0;
		$joinunidad=0;
		$joinequipo=0;
		$joinmodoventilatorio=0;
		$joinfechaingreso=0;


        
		/*if($this->uri->segment(3)=='centro_medico'  && $this->uri->segment(4) !='all'){
			$url_busqueda = 'centro_medico/'.$this->uri->segment(4).'/';
			$data['centro_medico2'] = $this->uri->segment(4);
			$where .= $this->prefijo_pri."centro_medico2 = '".$this->uri->segment(4)."'";
			//print_array($where);die('');

			$config['uri_segment'] = $segment = 15;
		}*/

		if($this->uri->segment(3)=='centro_medico'  && $this->uri->segment(4) !='all'){
			$url_busqueda = 'centro_medico/'.$this->uri->segment(4).'/';
			$data['centro_medico '] = $this->uri->segment(4);
			$where .= $this->prefijo_rel6."centro_medico  = '".$this->uri->segment(4)."'";
			$config['uri_segment'] = $segment = 15;
			$joincentros=1;
		}

			if($this->uri->segment(5)=='unidad' && $this->uri->segment(6) !='all'){
			
			if ($url_busqueda == false){
			$url_busqueda = 'unidad/'.$this->uri->segment(6).'/';
			$data['unidad_2'] = $this->uri->segment(6);
			$where .= $this->prefijo_rel7."unidad_2 = '".$this->uri->segment(6)."'";
			$config['uri_segment'] = $segment = 15;
			$joinunidad=1;

			}
			else{
			$url_busqueda = 'unidad/'.$this->uri->segment(6).'/';
			$data['unidad_2'] = $this->uri->segment(6);
			$where .= " and ".$this->prefijo_rel7."unidad_2 = '".$this->uri->segment(6)."'";
			$config['uri_segment'] = $segment = 15;
			$joinunidad=1;

			}
		}
			
		if($this->uri->segment(7)=='equipo' && $this->uri->segment(8) !='all'){
			
			if ($url_busqueda == false){
			$url_busqueda = 'equipo/'.$this->uri->segment(8).'/';
			$data['equipo'] = $this->uri->segment(8);
			$where .=$this->prefijo_pri."equipo = '".$this->uri->segment(8)."'";
			$config['uri_segment'] = $segment = 15;
						$joinequipo=1;
			}
			else{
			$url_busqueda = 'equipo/'.$this->uri->segment(8).'/';
			$data['equipo'] = $this->uri->segment(8);
			$where .= " and ".$this->prefijo_pri."equipo = '".$this->uri->segment(8)."'";
			$config['uri_segment'] = $segment = 15;
						$joinequipo=1;

			}
		}

		if($this->uri->segment(9)=='estado' && $this->uri->segment(10) !='all'){
			
			if ($url_busqueda == false){
			$url_busqueda = $url_busqueda.'estado/'.$this->uri->segment(10).'/';
			$data['estado_f'] = $this->uri->segment(10);
			$where .= $this->prefijo_pri."estado = '".$this->uri->segment(10)."'";
			$config['uri_segment'] = $segment = 15;
						$joinestado=1;
			}
			else{
			$url_busqueda = $url_busqueda.'estado/'.$this->uri->segment(10).'/';
			$data['estado_f'] = $this->uri->segment(10);
			$where .= " and ".$this->prefijo_pri."estado = '".$this->uri->segment(10)."'";
			$config['uri_segment'] = $segment = 15;
			$joinestado=1;
			}
		}

	
		if($this->uri->segment(11)=='fecha_desde' && $this->uri->segment(14) !='all'){
			
			if ($url_busqueda == false){
			$url_busqueda = 'fecha_desde/'.$this->uri->segment(12).'/';
			$data['fecha_desde'] = $this->uri->segment(12);
			$where .= $this->prefijo_pri."fecha_ingreso >= '".$this->uri->segment(12)."'";
			$config['uri_segment'] = $segment = 15;
			$joinfecha=1;
			}
			else{
			$url_busqueda = 'fecha_desde/'.$this->uri->segment(12).'/';
			$data['fecha_desde'] = $this->uri->segment(12);
			$where .= " and ".$this->prefijo_pri."fecha_ingreso >= '".$this->uri->segment(12)."'";
			$config['uri_segment'] = $segment = 15;
			$joinfecha=1;
			}
		}

		
		if($this->uri->segment(13)=='fecha_hasta' && $this->uri->segment(14) !='all'){
		
			if ($url_busqueda == false){
			$url_busqueda = 'fecha_hasta/'.$this->uri->segment(14).'/';
			$data['fecha_hasta'] = $this->uri->segment(14);
			$where .= $this->prefijo_pri."fecha_ingreso <= '".$this->uri->segment(14)."'";
			$config['uri_segment'] = $segment = 15;
			$joinfecha=1;
			}
			else{
			$url_busqueda = 'fecha_hasta/'.$this->uri->segment(14).'/';
			$data['fecha_hasta'] = $this->uri->segment(14);
			$where .= " and ".$this->prefijo_pri."fecha_ingreso <= '".$this->uri->segment(14)."'";
			$config['uri_segment'] = $segment = 15;
			$joinfecha=1;
			}
		}




		if(!$url_busqueda){
			$config['uri_segment'] = $segment = 3;
						//$config['uri_segment'] = $segment = 15;

		}

        
           //echo $where; die;      
        			//echo $where;$config;die('filtro centro medico');

        
		#paginacion
		$config['base_url'] = '/fichas_clinicas/'.$this->nombre_gen_plu.'/'.$url_busqueda;
		
		if($joincentros == 1){
		$this->ws->joinInner($this->id_modulo_rel7,"fic_codigo = con_ficha_clinica");##relacion ficha clinica
		$this->ws->joinInner($this->id_modulo_rel6,"fic_unidad_2 = unid_codigo");##relacion ficha clinica

		$this->ws->joinInner($this->id_modulo_rel2,"cen_codigo = unid_centro_medico");##relacion ficha clinica centro medico
		}
		/*if($joinunidad == 1){
		$this->ws->joinInner($this->id_modulo_rel7,"fic_codigo = con_ficha_clinica");##relacion ficha clinica
		$this->ws->joinInner($this->id_modulo_rel2,"cen_codigo = fic_centro_medicos1");##relacion ficha clinica centro medico
		$this->ws->joinInner($this->id_modulo_rel6,"cen_codigo = unid_centro_medico");##relacion ficha clinica centro medico

		}*/
		
			if($joinunidad == 1){
	$this->ws->joinInner($this->id_modulo_rel7,"fic_codigo = con_ficha_clinica");##relacion ficha clinica
		$this->ws->joinInner($this->id_modulo_rel6,"fic_unidad_2 = unid_codigo");##relacion ficha clinica

		

		}



		
		$config['total_rows'] = count($this->ws->listar($this->id_modulo,$where));
		$config['per_page'] = 15;
        $config['num_links'] = 30;
		$config['suffix'] = $url;
		$config['first_url'] = '/fichas_clinicas/'.$this->nombre_gen_plu.'/'.$url_busqueda;

		$config['next_link'] = '>>';//siguiente link
 		$config['prev_link'] = '<<';//anterior link
		$this->pagination->initialize($config);
		$page = ($this->uri->segment($segment))?$this->uri->segment($segment)-1:0;

//echo $page;
//echo $segment;die('sdfdsfsdfsdfsdfsdfsdf');
//print_array ($config);die('pagin');
		#contenido
		$this->ws->limit($config["per_page"],$page*$config["per_page"]);
        
       	//$data["datos"] = $this->ws->order($this->id_modulo,"codigo"=>"DESC");
       //	$this->ws->order(array($this->prefijo_pri.'nombre_completo ASC'));

		$this->ws->order(array($this->prefijo_pri.'codigo DESC'));



       	//echo $where;echo $this->id_modulo;die('sdsdsddssddsds');
       	//$data["datos"] = $this->ws->listar($this->id_modulo);
       	//$data["datos"] = $this->ws->listar(37);
       	

//echo $where; die;  
//echo $where;
				//$data["datos"] = $this->ws->listar($this->id_modulo,"cen_centro_medico = '2' ");
		if($joincentros == 1 ){
		$this->ws->joinInner($this->id_modulo_rel7,"fic_codigo = con_ficha_clinica");##relacion control ficha clinica 
		$this->ws->joinInner($this->id_modulo_rel6,"fic_unidad_2 = unid_codigo");##relacion ficha clinica

		$this->ws->joinInner($this->id_modulo_rel2,"cen_codigo = unid_centro_medico");##relacion ficha clinica centro medico
		}

		if($joinunidad == 1){
	$this->ws->joinInner($this->id_modulo_rel7,"fic_codigo = con_ficha_clinica");##relacion ficha clinica
		$this->ws->joinInner($this->id_modulo_rel6,"fic_unidad_2 = unid_codigo");##relacion ficha clinica

		

		}
		/*
		if($joinunidad == 1){
		$this->ws->joinInner($this->id_modulo_rel7,"fic_codigo = con_ficha_clinica");##relacion ficha clinica
		$this->ws->joinInner($this->id_modulo_rel6,"unid_codigo = fic_unidad_2");##relacion ficha clinica centro medico

		}*/

			//	echo $where;  

		//echo $where; die;  
				$data["datos"] = $this->ws->listar($this->id_modulo,$where);

		//$data["datos"] = $this->ws->listar($this->id_modulo);
		//print_array($data);

				//print_array($data);die('filtor');

		//print_array($data);die('');
	//$data["datos"] = $this->ws->listar($this->id_modulo);

		//$data["rel"] = $this->ws->listar($this->id_modulo_rel);
		$data["rel2"] = $this->ws->listar($this->id_modulo_rel2);
		$data["rel3"] = $this->ws->listar($this->id_modulo_rel3);
		$data["rel4"] = $this->ws->listar($this->id_modulo_rel4);
		$data["rel5"] = $this->ws->listar($this->id_modulo_rel5);
		$data["rel6"] = $this->ws->listar($this->id_modulo_rel6);
		$data["rel7"] = $this->ws->listar($this->id_modulo_rel7);


//print_array($data);die('');
       			//print_array($data);die('dsfdsf');

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
		$this->layout->title('Pacientes');

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
			$this->layout->nav(array("Fichas_clinicas: $this->title_gen_plu"=>"fichas_clinicas/$this->nombre_gen_plu", "Pacientes: Editar $this->title_gen_sin"=>"/"));
		else
			$this->layout->nav(array("Fichas_clinicas: $this->title_gen_plu"=>"fichas_clinicas/$this->nombre_gen_plu", "Pacientes: Agregar $this->title_gen_sin"=>"/"));


		$data = false;
		if($codigo)
			$data["dato"] = $this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo = {$codigo}");



    	/*if($this->id_modulo_rel)
    	{
    	$this->ws->order(array($this->prefijo_rel.'nombre ASC'));

		$data['rel'] = $this->ws->listar($this->id_modulo_rel);
		}*/

	if($this->id_modulo_rel2)

		$this->ws->order(array($this->prefijo_rel2.'codigo DESC'));

		$data['rel2'] = $this->ws->listar($this->id_modulo_rel2);
		
   
   		//print_array($data);die();
		#La vista siempre,  debe ir cargada al final de la función
		$this->layout->view('/'.$this->nombre_gen_plu.'/administrar',$data);
	}

	
	public function process($codigo = false){
		$datos = $this->input->post();
        if($datos){

            $nombre_completo = $datos[$this->prefijo_pri."nombre_completo"];
            $rut = $datos[$this->prefijo_pri."rut_"];

            $fecha_ingreso= formatearFecha2($datos[$this->prefijo_pri."fecha_ingreso"]);
            $hora_ingreso= $datos[$this->prefijo_pri."hora_ingreso"];

            $datos[$this->prefijo_pri."fecha_ingreso"]=$fecha_ingreso;

		//print_array($datos);die('LLEGO A process');

     
            if($codigo){

                #revisa que el nombre ingresado no exista
                if($this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo <> $codigo and ".$this->prefijo_pri."rut = '$rut'   and ".$this->prefijo_pri."fecha_ingreso = '$fecha_ingreso'  and ".$this->prefijo_pri."hora_ingreso = '$hora_ingreso' ")){
                    echo json_encode(array("result"=>false,"msj"=>"El paciente ingresado ya se encuentra registrado"));
                    exit;
                }

				$this->ws->actualizar($this->id_modulo,$datos,$this->prefijo_pri."codigo = {$codigo}");


                        
                echo json_encode(array("result"=>true,"msj"=>"Datos Actualizados Correctamente."));
            }else{

                #revisa que el nombre ingresado no exista
                 if($this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo <> $codigo and ".$this->prefijo_pri."rut = '$rut'   and ".$this->prefijo_pri."fecha_ingreso = '$fecha_ingreso'  and ".$this->prefijo_pri."hora_ingreso = '$hora_ingreso' ")){
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
        //    redirect('/fichas_clinicas/'.$this->nombre_gen_plu.'/');

		#Title
		$this->layout->title('Pacientes');

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
			$this->layout->nav(array("Fichas_clinicas: $this->title_gen_plu"=>"fichas_clinicas/$this->nombre_gen_plu", "Pacientes: Editar $this->title_gen_sin"=>"/"));
		else
			$this->layout->nav(array("Fichas_clinicas: $this->title_gen_plu"=>"fichas_clinicas/$this->nombre_gen_plu", "Pacientes: Agregar $this->title_gen_sin"=>"/"));


		$data = false;
		if($codigo)
			$data["dato"] = $this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo = {$codigo}");



    	/*if($this->id_modulo_rel)
    	{
    	$this->ws->order(array($this->prefijo_rel.'nombre ASC'));

		$data['rel'] = $this->ws->listar($this->id_modulo_rel);
		}*/

	if($this->id_modulo_rel2)

		$this->ws->order(array($this->prefijo_rel2.'codigo DESC'));

		$data['rel2'] = $this->ws->listar($this->id_modulo_rel2);
		
   
   		//print_array($data);die();
		#La vista siempre,  debe ir cargada al final de la función
		$this->layout->view('/'.$this->nombre_gen_plu.'/agregar_control_operativo',$data);
	}


	public function eliminar(){

    try{


    		//$eliminar = $this->ws->eliminar($this->id_modulo_rel,$this->prefijo_rel."ficha_clinica = {$this->input->post('codigo')}");

			$eliminar = $this->ws->eliminar($this->id_modulo,$this->prefijo_pri."codigo = {$this->input->post('codigo')}");

			echo json_encode(array("result"=>true));


		}
		catch(Exception $e){
			echo json_encode(array("result"=>false,"msg"=>"Ha ocurrido un error inesperado. Por favor, inténtelo nuevamente."));
		}
	}






 public function exportar_pacientes(){

        
         


		$datos = $this->ws->listar($this->id_modulo);
		//$data["rel"] = $this->ws->listar($this->id_modulo_rel);
		$rel2 = $this->ws->listar($this->id_modulo_rel2);
		$rel3 = $this->ws->listar($this->id_modulo_rel3);
		$rel4 = $this->ws->listar($this->id_modulo_rel4);
		$rel5 = $this->ws->listar($this->id_modulo_rel5);
		$rel6 = $this->ws->listar($this->id_modulo_rel6);
		$rel7 = $this->ws->listar($this->id_modulo_rel7);





 
        //se carga la libreria de excel
        require APPPATH."libraries/PHPExcel/PHPExcel.php";
 
    //die($configInforme->cabecera_informe);
        //se crea el objeto excel con el titulo
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->
          getProperties()
            ->setCreator("Aeurus.cl")
            ->setLastModifiedBy("Aeurus.cl")
            ->setTitle("Excel Pacientes")
            ->setSubject("Excel Pacientes")
            ->setDescription("Excel Pacientes")
            ->setKeywords("Clases")
            ->setCategory("Clases");

        //se crean los diferentes estilos de los difrenetes tipos de celdas que se usaran
        //este corresponde al titulo de la cabezera
        $styleArray = array(
             'borders' => array(
               'outline' => array(
                  'style' => PHPExcel_Style_Border::BORDER_THIN,
                  'color' => array('argb' => '000000'),
               ),
             ),
              'font'    => array(
             'bold'      => true,
             'italic'    => false,
             'strike'    => false,
           ),
          'alignment' => array(
              'wrap'       => true,
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
          ),
       
        );
        //este corresponde a los datos
        $styleArraInfo = array(
            'font'    => array(
             'bold'      => false,
             'italic'    => false,
             'strike'    => false,
             'size' => 10
             ),
             'borders' => array(
               'outline' => array(
                  'style' => PHPExcel_Style_Border::BORDER_THIN,
                  'color' => array('argb' => '000000'),
               ),
             ),
             'alignment' => array(
              'wrap'       => true,
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );
    //este corresponde a los items que estan en plomo
     $styleArrayITEM = array(
            'font'    => array(
             'bold'      => false,
             'italic'    => false,
             'strike'    => false,
             'size' => 10
             ),
             'borders' => array(
               'outline' => array(
                  'style' => PHPExcel_Style_Border::BORDER_THIN,
                  'color' => array('argb' => 'D8D8D8'),
               ),
             ),
             'alignment' => array(
              'wrap'       => true,
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
               'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'D8D8D8')
          ),
        );
        //este corresponde al tipo de letra
        $styleFont = array(
           'font'    => array(
             'bold'      => true,
             'italic'    => false,
             'strike'    => false,
           ),
          'alignment' => array(
              'wrap'       => true,
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
          ),
        );



    //ancho de las columnas ocupadas
    $objPHPExcel->getActiveSheet()->getStyle('1:3')->applyFromArray($styleFont);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
     $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);


    //i es 10 para dejar espacio para el header del excel
    $i=1;
    //nombre de las columnas utilizadas y estilo
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Centro médico');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArray);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, 'Unidad');
    $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleArray);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, 'Nº Cama');
    $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleArray);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i, 'Nombre completo');
    $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleArray);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i, 'Rut');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleArray);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i, 'Edad');
    $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleArray);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i, 'Fecha de ingreso');
    $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleArray);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$i, 'Diagnostico');
    $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->applyFromArray($styleArray);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i, 'Equipos');
    $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->applyFromArray($styleArray);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$i, 'Insumos');
    $objPHPExcel->getActiveSheet()->getStyle('J'.$i)->applyFromArray($styleArray);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$i, 'Modo ventilatorio');
    $objPHPExcel->getActiveSheet()->getStyle('K'.$i)->applyFromArray($styleArray);
    //se va moviendo el i
    $i++;


    //vacio es para dejar vacio las sin datos de un item
    $VACIO="";
    //se recorre el nivel 1
   foreach($datos as $dato){
   
      
        foreach($rel7 as $re7) {
foreach($rel6 as $re6) {
         foreach($rel2 as $re2){
if ($re7->codigo == $dato->ficha_clinica && $re7->unidad_2 ==   $re6->codigo && $re6->centro_medico ==   $re2->codigo) {
      //se imprime el item y su descripcion 
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $re2->nombre);
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);
  		}
		}
	}
}

 foreach($rel7 as $re7) {
	foreach($rel6 as $re6){
if($re7->codigo == $dato->ficha_clinica && $re7->unidad_2 ==   $re6->codigo) {
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $re6->nombre);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleArraInfo);
  		}
  	}
  }


          foreach($rel7 as $re7) {
           foreach($rel6 as $re6) {
if($re7->codigo == $dato->ficha_clinica && $re7->unidad_2 ==   $re6->codigo) {
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, $re6->numero_cama);
      $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleArraInfo);
  	}	
	}
	}

	          foreach($rel7 as $re7) {
	          	  if($re7->codigo == $dato->ficha_clinica){

      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i, $re7->nombre_completo);
      $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleArraInfo);
	

      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i, $re7->rut_);
      $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleArraInfo);


      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i, $re7->edad);
      $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleArraInfo);
}}

       $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i, $dato->fecha_ingreso);
      $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleArraInfo);
  	

	          foreach($rel7 as $re7) {
	          	  if($re7->codigo == $dato->ficha_clinica){
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$i, $re7->diagnostico);
      $objPHPExcel->getActiveSheet()->getStyle('H'.$i)->applyFromArray($styleArraInfo);
		}}
     

      foreach($rel3 as $re3){
      if($dato->equipo == $re3->codigo){

      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i, $re3->nombre);
      $objPHPExcel->getActiveSheet()->getStyle('I'.$i)->applyFromArray($styleArraInfo);
       
		}	
	}


		 /*foreach($rel4 as $re4){
		 	      if($dato->insumo == $re4->codigo){
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$i, $re4->nombre);
      $objPHPExcel->getActiveSheet()->getStyle('J'.$i)->applyFromArray($styleArraInfo);
		}
		}*/


		 foreach($rel5 as $re5) {
            if($re5->codigo ==   $dato->modo_ventilatorio_pc) {
            	  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$i, $re5->nombre);
      			$objPHPExcel->getActiveSheet()->getStyle('K'.$i)->applyFromArray($styleArraInfo);
            } 
            if ( $re5->codigo ==   $dato->modo_ventilatorio_vc) { 
  			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$i, $re5->nombre);
     		 $objPHPExcel->getActiveSheet()->getStyle('K'.$i)->applyFromArray($styleArraInfo);            } 
             if ($re5->codigo ==   $dato->modo_ventilatorio_duales) {
  				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$i, $re5->nombre);
     			 $objPHPExcel->getActiveSheet()->getStyle('K'.$i)->applyFromArray($styleArraInfo);          } 
               if ($re5->codigo ==   $dato->modo_ventilatorio_otro)  { 
  				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$i, $re5->nombre);
     			 $objPHPExcel->getActiveSheet()->getStyle('K'.$i)->applyFromArray($styleArraInfo);               } 
                }




		/*foreach($rel5 as $re5){
		if($dato->modo_ventilatorio == $re5->codigo){

         $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$i, $re5->nombre);
      $objPHPExcel->getActiveSheet()->getStyle('K'.$i)->applyFromArray($styleArraInfo);
		}	
	}*/
      $i++;

	}



    //datos de cabecera
    $objPHPExcel->getActiveSheet()->setTitle("EXCEL PACIENTES");
    $objPHPExcel->setActiveSheetIndex(0);


    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Excel Pacientes- '.date('d/m/Y').'.xls"');
    header('Cache-Control: max-age=0');


    
  


    //se escribe en excel
    $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
    exit;


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
