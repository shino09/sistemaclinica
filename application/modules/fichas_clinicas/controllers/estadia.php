<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class Estadia extends CI_Controller {

    //public $permisos;
	function __construct(){

		parent::__construct();


		  //principal
		$this->id_modulo = 37;
        $this->prefijo_pri = "con_";
        $this->title_gen_plu = "estadia";
        $this->title_gen_sin ="estadia";
        $this->nombre_gen_plu = "estadia";
        $this->nombre_gen_sin ="estadia";


     

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

	public function index($codigo = false)	{
	   
       
		#Title
		$this->layout->title('Estadia');

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
		$codigo=$this->uri->segment(3);

		$data = false;$where = "con_ficha_clinica = {$codigo}";$url = false;
		$url_busqueda = false;

		$joinfecha=0;

 		//$where="con_ficha_clinica = '$codigo'";
 		//echo $codigo;
 		//echo $where;die('codgi');

 		//echo $this->uri->segment(3);die('psoicion 4');
	
		if($this->uri->segment(4)=='fecha' && $this->uri->segment(5) !='all'){
			
			if ($url_busqueda == false){
			$url_busqueda = 'fecha/'.$this->uri->segment(5).'/';
			$data['fecha'] = $this->uri->segment(5);
			//$where .= $this->prefijo_pri."fecha_ingreso = '".$this->uri->segment(5)."'";
			$where .= "con_ficha_clinica = '".$this->uri->segment(3)."' and con_fecha_ingreso = '".$this->uri->segment(5)."'";
			//echo $where;die('whre');
			$config['uri_segment'] = $segment = 10;
			$joinfecha=1;
			}
			else{
			$url_busqueda = 'fecha/'.$this->uri->segment(5).'/';
			$data['fecha'] = $this->uri->segment(5);
			//$where .= " and ".$this->prefijo_pri."fecha_ingreso = '".$this->uri->segment(5)."'";
			$where .= "con_ficha_clinica = '".$this->uri->segment(3)."' and con_fecha_ingreso = '".$this->uri->segment(5)."'";

			$config['uri_segment'] = $segment = 10;
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


	
	
		
		$config['total_rows'] = count($this->ws->listar($this->id_modulo,$where));
		//$config['per_page'] = 15;
        //$config['num_links'] = 30;
		$config['suffix'] = $url;
		$config['first_url'] = '/fichas_clinicas/'.$this->nombre_gen_plu.'/'.$url_busqueda;

		//$config['next_link'] = '>>';//siguiente link
 		//$config['prev_link'] = '<<';//anterior link
		//$this->pagination->initialize($config);
		$page = ($this->uri->segment($segment))?$this->uri->segment($segment)-1:0;

//echo $page;
//echo $segment;die('sdfdsfsdfsdfsdfsdfsdf');
//print_array ($config);die('pagin');
		#contenido
		##$this->ws->limit($config["per_page"],$page*$config["per_page"]);
        
       	//$data["datos"] = $this->ws->order($this->id_modulo,"codigo"=>"DESC");
       //	$this->ws->order(array($this->prefijo_pri.'nombre_completo ASC'));

		$this->ws->order(array($this->prefijo_pri.'codigo DESC'));


				//$data["datos"] = $this->ws->listar($this->id_modulo,$where);

				/*if($joinfecha == 0 ){
									$data["datos"] = false;

					}*/


					//echo $this->prefijo_pri."ficha_clinica = {$codigo}";die('dss');
	$data = false;
		if($codigo){
			//$data["datos"] = $this->ws->listar($this->id_modulo,"con_ficha_clinica = {$codigo}");
						$data["datos"] = $this->ws->listar($this->id_modulo,$where);
				$data["datos_info"] = $this->ws->listar($this->id_modulo,"con_ficha_clinica = {$codigo}");


}

			//$data["datos"] = $this->ws->listar($this->id_modulo,"con_ficha_clinica = {$codigo}");


			//$data["datos"] = $this->ws->listar($this->id_modulo,$this->prefijo_pri."ficha_clinica = {$codigo}");

		//print_array($data);die('data de fichas por codigo');
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
   //print_array($data);die('indexx');

		#La vista siempre,  debe ir cargada al final de la función
		$this->layout->view('/'.$this->nombre_gen_plu.'/index',$data);
	}

	public function administrar($codigo = false){

        #permisos del usuario
        //if(!$this->permisos->agregar && !$this->permisos->editar)
        //    redirect('/fichas_clinicas/'.$this->nombre_gen_plu.'/');

		#Title
		$this->layout->title('Estadia');

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
			$this->layout->nav(array("Fichas_clinicas: $this->title_gen_plu"=>"fichas_clinicas/$this->nombre_gen_plu", "Estadia: Editar $this->title_gen_sin"=>"/"));
		else
			$this->layout->nav(array("Fichas_clinicas: $this->title_gen_plu"=>"fichas_clinicas/$this->nombre_gen_plu", "Estadia: Agregar $this->title_gen_sin"=>"/"));


		$data = false;
		if($codigo)
			$data["dato"] = $this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo = {$codigo}");



    	/*if($this->id_modulo_rel)
    	{
    	$this->ws->order(array($this->prefijo_rel.'nombre ASC'));

		$data['rel'] = $this->ws->listar($this->id_modulo_rel);
		}*/

	if($this->id_modulo_rel2){

		$this->ws->order(array($this->prefijo_rel2.'codigo DESC'));

		$data['rel2'] = $this->ws->listar($this->id_modulo_rel2);
		}
   
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
		$this->layout->title('Estadia');

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
			$this->layout->nav(array("Fichas_clinicas: $this->title_gen_plu"=>"fichas_clinicas/$this->nombre_gen_plu", "Estadia: Editar $this->title_gen_sin"=>"/"));
		else
			$this->layout->nav(array("Fichas_clinicas: $this->title_gen_plu"=>"fichas_clinicas/$this->nombre_gen_plu", "Estadia: Agregar $this->title_gen_sin"=>"/"));


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






 public function exportar_estadiarespaldo(){

        
         


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
            ->setTitle("Excel Estadia")
            ->setSubject("Excel Estadia")
            ->setDescription("Excel Estadia")
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
 


    //i es 10 para dejar espacio para el header del excel
   // $i=1;

      $objPHPExcel->getActiveSheet()->getStyle('1:3')->applyFromArray($styleFont);

           $i=1;$k=1;
           if($datos){
 $k=count(@$datos);
        while ($i <= $k) {



              if ($i==0) {
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);

  
             }
              if ($i!=0) {
          $letra=num_to_letters($i);

    
              	    //$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra,'DIA : ',$i)->applyFromArray($styleArray);

 $objPHPExcel->getActiveSheet()->getColumnDimension($letra)->setWidth(20);
  
                }
 $i++; 
              }
                      } 




           $i=1;$k=1;
           if($datos){
 $k=count(@$datos);
        while ($i <= $k+1) {

$uno=1;

              if ($i==1) {
   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$uno, 'ITEM');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArray);
  
             }
              if ($i!=1) {
          $letra=num_to_letters($i);

    
              	    //$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra,'DIA : ',$i)->applyFromArray($styleArray);

 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$uno, 'DIA : '.($i-1));
    $objPHPExcel->getActiveSheet()->getStyle($letra.$uno)->applyFromArray($styleArray);  
                }
 $i++; 
              }
                      } 



                     	  

$i=2;

        while ($i <= 80) {
   
$j=2; 
 	foreach($datos as $dato){ 
   	 $letra=num_to_letters($j);


      /*        if ($i==2) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Codigo');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);
                  	                $j=2;

   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->codigo);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }*/

              if ($i==2) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Tipo de Soporte');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->tipo_de_soporte);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==3) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Equipo en Uso');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->equipo);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==4) {
              	   	foreach($rel4 as $re4){ 

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Insumos');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
   		 	if($dato->insumo_filtro ==$re4->codigo || $dato->insumo_circuito ==$re4->codigo ){ 


   	 $letra=num_to_letters($j);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $re4->nombre);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
    
  }

             }
         }

              if ($i==5) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Vía Aerea');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->via_aerea);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==6) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Frecuancia Cardiaca');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->frecuencia_cardiaca);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==7) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Frecuencia Respiratoria');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->frecuencia_respiratoria);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==8) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Presion Arterial Sistolica');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->presion_sistolica);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==9) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Presion Arterial Diastolica');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->presion_diastolica);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==10) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Presion Arterial Media');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->presion_arterial_media);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==11) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Saturacion Preductal');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->saturacion_postductual);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==12) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Saturacion Post Ductal');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->saturacion_postductual);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==13) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Modo Ventilatorio');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->modo_ventilatorio_pc);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==14) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'PIM/PMAX');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->pimpmax_);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==15) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Presion Plateau');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->presion_plateu);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==16) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Presion Media');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->presion_media);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==17) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'PEEP');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->peep);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==18) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Presion de Soporte');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->presion_de_soporte);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==19) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Alarma Alta de Presion');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->alarma_de_presion_alta);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==20) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Alarma Baja de Presion');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->alarma_de_presion_baja);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==21) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'VC Inspirado');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->vc_ins);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==22) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'VC Espirado');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->vc_esp);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==23) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Volumen Minuto');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->v_min);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

          

              if ($i==24) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Alarma VMin Alta');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->alarma_de_volumen_minuto_alta);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==25) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Alarma VMin Baja');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->alarma_de_volumen_minuto_baja);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==26) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Alarma VC Alta');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->alarma_de_volumen_corriente_alta);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==27) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Alarma VC Baja');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->alarma_de_volumen_corriente_baja);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==28) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Frecuencia Respiratoria Total');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->fr_total);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==29) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Tiempo Inspiratorio');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->tiempo_inspiratorio);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==30) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Relacion I:E');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->relacion_ie);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==31) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Flujo Inspiratorio');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->flujo_inspiratorio);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==32) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Flujo Espiratorio');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->flujo_espiatorio);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==33) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Tipo Humidificacion');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->humidificacion);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==34) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Cambio Matraz');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->cambio_matraz_llenado_camara_humidificacion);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==35) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'pH');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_ph_);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==36) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'PaO2');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_pao2);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==37) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'PaCO2');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_paco2);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==38) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'HCO3');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_hco3);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==39) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'BE');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_be);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==40) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'FiO2 GSA');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_fio2_gsa);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==41) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Pa/Fi');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_pafi);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==42) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'IOX');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_iox);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==43) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'EtCO2');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_etco2);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==44) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'HTC');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->sangre_htc);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==45) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Hb');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->sangre_hb);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==46) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'GB');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->sangre_gb);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==47) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Plaquetas');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->sangre_plaqueta);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==48) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Na');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->electrolito_na);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==49) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'K');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->electrolito_k);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==50) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Cl');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->electrolito_cl);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==51) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Ca');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->electrolito_ca);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==52) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'P');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->electrolito_p);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==53) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'PCR');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->inflamatorio_pcr);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==54) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Distensibilidad Dinamica');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->pulmonar_distensibilidad_dinamica);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==55) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Distensibilidad Estática');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->pulmonar_distensibilidad_estatica);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==56) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Resistencia');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->pulmonar_distensibilidad_resistnecia);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==57) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Cte. Tpo');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->pulmonar_distensibilidad_cte_tpo);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==58) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'C20/C');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->pulmonar_distensibilidad_c20c);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==59) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'P01');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->pulmonar_po1);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==60) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Alarma Presion Alta');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->alarma_de_presion_alta);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==61) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Alarma Presion Baja');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->alarma_de_presion_baja);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==62) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Respaldo');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->respaldo);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }
               if ($i==63) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Cambio Circuito');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
   	 if($dato->cambio_circuito != null){
   	 if($dato->cambio_circuito==1){$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, 'si'); }  if($dato->cambio_circuito==0 ){$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, 'no');  }
    
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
    
  }
   	 if($dato->cambio_circuito == null){
   $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, '');  
    
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
    
  }
}
             


              if ($i==64) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Aseo Diario');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
   if($dato->aseo_diario != null){
   	 if($dato->aseo_diario==1){$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, 'si'); }  if($dato->aseo_diario==0 ){$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, 'no');  }
    
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }
   	 if($dato->aseo_diario == null){
   $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, '');  
    
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
    
  }
}

              if ($i==65) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Kinesiologo Responsable');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->kinesiologo);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==66) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'NO');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_no);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==67) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'NO2');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_no2);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

                          if ($i==68) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'FiO2');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_fio2);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==69) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Carga');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_carga);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

         
               if ($i==70) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Calibracion Baja');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_calibracion_baja);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==71) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Calibracion Alta');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_calibracion_alta);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==72) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Calibracion');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_calibracion_);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==73) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Desinfeccion');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_desinfeccion);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==74) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'PSI Actuales');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_psi_actuales);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

               if ($i==75) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Numero Serie Balon');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_numero_serie_balon);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==76) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'FiO2 ECMO');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ecmo_fio2_volumen_cuff);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==77) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Presion Cuff');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->cuff_presion);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==78) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Flujo CO2/N2');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ecmo_co2_n2);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==79) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Carga CO2/N2');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ecmo_carga_co2_n2);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


     if ($i==80) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Codigo');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);

   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->codigo);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

    
 $j++; 
              }
                      
                  $i++; 

 
 }
 


    //datos de cabecera
    $objPHPExcel->getActiveSheet()->setTitle("EXCEL ESTADIA");
    $objPHPExcel->setActiveSheetIndex(0);


    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Excel Estadia- '.date('d/m/Y').'.xls"');
    header('Cache-Control: max-age=0');


    
  


    //se escribe en excel
    $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
    $objWriter->save('php://output');
    exit;


    }





 public function exportar_estadia($codigo = false){

        
         	//$data = false;
		if($codigo){
			$datos = $this->ws->listar($this->id_modulo,"con_ficha_clinica = {$codigo}");
}


		//$datos = $this->ws->listar($this->id_modulo);
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
            ->setTitle("Excel Estadia")
            ->setSubject("Excel Estadia")
            ->setDescription("Excel Estadia")
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
 


    //i es 10 para dejar espacio para el header del excel
   // $i=1;

      $objPHPExcel->getActiveSheet()->getStyle('1:3')->applyFromArray($styleFont);

           $i=1;$k=1;
           if($datos){
 $k=count(@$datos);
        while ($i <= $k) {



              if ($i==0) {
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);

  
             }
              if ($i!=0) {
          $letra=num_to_letters($i);

    
              	    //$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra,'DIA : ',$i)->applyFromArray($styleArray);

 $objPHPExcel->getActiveSheet()->getColumnDimension($letra)->setWidth(20);
  
                }
 $i++; 
              }
                      } 




           $i=1;$k=1;
           if($datos){
 $k=count(@$datos);
        while ($i <= $k+1) {

$uno=1;

              if ($i==1) {
   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$uno, 'ITEM');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArray);
  
             }
              if ($i!=1) {
          $letra=num_to_letters($i);

    
              	    //$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra,'DIA : ',$i)->applyFromArray($styleArray);

 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$uno, 'DIA : '.($i-1));
    $objPHPExcel->getActiveSheet()->getStyle($letra.$uno)->applyFromArray($styleArray);  
                }
 $i++; 
              }
                      } 



                     	  

$i=2;

        while ($i <= 80) {
   
$j=2; 
 	foreach($datos as $dato){ 
   	 $letra=num_to_letters($j);


      /*        if ($i==2) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Codigo');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);
                  	                $j=2;

   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->codigo);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }*/

              if ($i==2) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Tipo de Soporte');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->tipo_de_soporte);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==3) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Equipo en Uso');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->equipo);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==4) {
              	   	foreach($rel4 as $re4){ 

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Insumos');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
   		 	if($dato->insumo_filtro ==$re4->codigo || $dato->insumo_circuito ==$re4->codigo ){ 


   	 $letra=num_to_letters($j);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $re4->nombre);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
    
  }

             }
         }

              if ($i==5) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Vía Aerea');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->via_aerea);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==6) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Frecuancia Cardiaca');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->frecuencia_cardiaca);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==7) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Frecuencia Respiratoria');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->frecuencia_respiratoria);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==8) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Presion Arterial Sistolica');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->presion_sistolica);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==9) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Presion Arterial Diastolica');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->presion_diastolica);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==10) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Presion Arterial Media');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->presion_arterial_media);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==11) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Saturacion Preductal');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->saturacion_postductual);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==12) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Saturacion Post Ductal');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->saturacion_postductual);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==13) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Modo Ventilatorio');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->modo_ventilatorio_pc);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==14) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'PIM/PMAX');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->pimpmax_);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==15) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Presion Plateau');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->presion_plateu);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==16) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Presion Media');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->presion_media);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==17) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'PEEP');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->peep);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==18) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Presion de Soporte');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->presion_de_soporte);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==19) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Alarma Alta de Presion');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->alarma_de_presion_alta);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==20) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Alarma Baja de Presion');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->alarma_de_presion_baja);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==21) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'VC Inspirado');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->vc_ins);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==22) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'VC Espirado');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->vc_esp);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==23) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Volumen Minuto');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->v_min);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

          

              if ($i==24) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Alarma VMin Alta');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->alarma_de_volumen_minuto_alta);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==25) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Alarma VMin Baja');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->alarma_de_volumen_minuto_baja);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==26) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Alarma VC Alta');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->alarma_de_volumen_corriente_alta);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==27) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Alarma VC Baja');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->alarma_de_volumen_corriente_baja);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==28) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Frecuencia Respiratoria Total');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->fr_total);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==29) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Tiempo Inspiratorio');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->tiempo_inspiratorio);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==30) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Relacion I:E');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->relacion_ie);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==31) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Flujo Inspiratorio');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->flujo_inspiratorio);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==32) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Flujo Espiratorio');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->flujo_espiatorio);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==33) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Tipo Humidificacion');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->humidificacion);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==34) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Cambio Matraz');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->cambio_matraz_llenado_camara_humidificacion);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==35) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'pH');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_ph_);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==36) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'PaO2');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_pao2);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==37) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'PaCO2');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_paco2);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==38) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'HCO3');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_hco3);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==39) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'BE');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_be);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==40) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'FiO2 GSA');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_fio2_gsa);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==41) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Pa/Fi');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_pafi);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==42) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'IOX');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_iox);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==43) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'EtCO2');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->gases_arteriales_etco2);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==44) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'HTC');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->sangre_htc);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==45) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Hb');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->sangre_hb);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==46) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'GB');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->sangre_gb);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==47) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Plaquetas');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->sangre_plaqueta);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==48) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Na');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->electrolito_na);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==49) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'K');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->electrolito_k);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==50) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Cl');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->electrolito_cl);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==51) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Ca');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->electrolito_ca);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==52) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'P');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->electrolito_p);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==53) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'PCR');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->inflamatorio_pcr);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==54) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Distensibilidad Dinamica');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->pulmonar_distensibilidad_dinamica);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==55) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Distensibilidad Estática');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->pulmonar_distensibilidad_estatica);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==56) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Resistencia');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->pulmonar_distensibilidad_resistnecia);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==57) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Cte. Tpo');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->pulmonar_distensibilidad_cte_tpo);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==58) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'C20/C');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->pulmonar_distensibilidad_c20c);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==59) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'P01');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->pulmonar_po1);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==60) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Alarma Presion Alta');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->alarma_de_presion_alta);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==61) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Alarma Presion Baja');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->alarma_de_presion_baja);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==62) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Respaldo');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->respaldo);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }
               if ($i==63) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Cambio Circuito');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
   	 if($dato->cambio_circuito != null){
   	 if($dato->cambio_circuito==1){$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, 'si'); }  if($dato->cambio_circuito==0 ){$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, 'no');  }
    
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
    
  }
   	 if($dato->cambio_circuito == null){
   $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, '');  
    
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
    
  }
}
             


              if ($i==64) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Aseo Diario');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
   if($dato->aseo_diario != null){
   	 if($dato->aseo_diario==1){$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, 'si'); }  if($dato->aseo_diario==0 ){$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, 'no');  }
    
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }
   	 if($dato->aseo_diario == null){
   $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, '');  
    
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
    
  }
}

              if ($i==65) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Kinesiologo Responsable');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->kinesiologo);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==66) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'NO');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_no);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==67) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'NO2');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_no2);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

                          if ($i==68) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'FiO2');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_fio2);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==69) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Carga');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_carga);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

         
               if ($i==70) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Calibracion Baja');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_calibracion_baja);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==71) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Calibracion Alta');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_calibracion_alta);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==72) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Calibracion');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_calibracion_);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==73) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Desinfeccion');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_desinfeccion);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==74) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'PSI Actuales');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_psi_actuales);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

               if ($i==75) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Numero Serie Balon');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ino_numero_serie_balon);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==76) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'FiO2 ECMO');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ecmo_fio2_volumen_cuff);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==77) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Presion Cuff');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->cuff_presion);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


              if ($i==78) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Flujo CO2/N2');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ecmo_co2_n2);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

              if ($i==79) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Carga CO2/N2');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);  
   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->ecmo_carga_co2_n2);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }


     if ($i==80) {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Codigo');
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);

   
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.$i, $dato->codigo);
      $objPHPExcel->getActiveSheet()->getStyle($letra.$i)->applyFromArray($styleArraInfo);
   
  }

    
 $j++; 
              }
                      
                  $i++; 

 
 }
 


    //datos de cabecera
    $objPHPExcel->getActiveSheet()->setTitle("EXCEL ESTADIA");
    $objPHPExcel->setActiveSheetIndex(0);


    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Excel Estadia- '.date('d/m/Y').'.xls"');
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
