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
        $this->id_modulo_rel = 38;
        $this->prefijo_rel = "cen_";
        $this->nombre_rel_plu = "centros_medicos";

                  //relacion tipos de control insumos
        $this->id_modulo_rel2 = 20;
        $this->prefijo_rel2 = "tipo_";
        $this->nombre_rel_plu2 = "fichas_clinicas_insumos";

        
     	  	//relacion unidad
        $this->id_modulo_rel3 = 39 ;
        $this->prefijo_rel3 = "unid_";
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

				$url_centro_medico = false;

		$data['fichas_clinicas_f'] = false;

        $estado=false;$buscar=false;
        $centro_medico=false;
		$data['estado']=$estado;
		$data['buscar']=$buscar;
				$data['centro_medico']=$centro_medico;

        
		if($this->uri->segment(3)=='busqueda'){
			$url_busqueda = 'busqueda/'.$this->uri->segment(4).'/';
			$data['fichas_clinicas_f'] = $this->uri->segment(4);
			$where .= "(".$this->prefijo_pri."nombre_completo like '".$this->uri->segment(4)."%' or ".$this->prefijo_pri."nombre_completo like '%".$this->uri->segment(4)."' or ".$this->prefijo_pri."nombre_completo like '%".$this->uri->segment(4)."%')";
			$config['uri_segment'] = $segment = 5;
		}

		if($this->uri->segment(3)=='estado'){
			$url_busqueda = 'estado/'.$this->uri->segment(4).'/';
			$data['estado_f'] = $this->uri->segment(4);
			$where .= $this->prefijo_pri."estado = '".$this->uri->segment(4)."'";
			$config['uri_segment'] = $segment = 5;
		}

		if($this->uri->segment(5)=='estado'){
			$url_busqueda = $url_busqueda.'estado/'.$this->uri->segment(6).'/';
			$data['estado_f'] = $this->uri->segment(6);
			$where .= " and ".$this->prefijo_pri."estado = '".$this->uri->segment(6)."'";
			$config['uri_segment'] = $segment = 7;
		}

		if($this->uri->segment(3)=='centro_medico'){
			$url_busqueda = 'centro_medico/'.$this->uri->segment(4).'/';
			$data['centro_medico'] = $this->uri->segment(4);
			$where .= $this->prefijo_pri."centro_medico = '".$this->uri->segment(4)."'";
			$config['uri_segment'] = $segment = 5;
		}

		if($this->uri->segment(5)=='centro_medico'){
			$url_busqueda = 'centro_medico/'.$this->uri->segment(6).'/';
			$data['centro_medico'] = $this->uri->segment(6);
			$where .= " and ".$this->prefijo_pri."centro_medico = '".$this->uri->segment(6)."'";

			$config['uri_segment'] = $segment = 7;
		}

		if($this->uri->segment(7)=='centro_medico'){
			$url_busqueda = 'centro_medico/'.$this->uri->segment(8).'/';
			$data['centro_medico'] = $this->uri->segment(8);
			$where .= " and ".$this->prefijo_pri."centro_medico = '".$this->uri->segment(8)."'";

			$config['uri_segment'] = $segment = 9;
		}


		if(!$url_busqueda){
			$config['uri_segment'] = $segment = 3;
		}

        
           //echo $where; die;      
        
        
		#paginacion
		$config['base_url'] = '/fichas_clinicas/'.$this->nombre_gen_plu.'/'.$url_busqueda;
		
		$config['total_rows'] = count($this->ws->listar($this->id_modulo,$where));
		$config['per_page'] = 15;
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
       	//$this->ws->order(array($this->prefijo_pri.'nombre_completo ASC'));
       	$this->ws->order(array($this->prefijo_pri.'codigo DESC'));
		$data["datos"] = $this->ws->listar($this->id_modulo,$where);
		$data["rel"] = $this->ws->listar($this->id_modulo_rel);
				$data["rel3"] = $this->ws->listar($this->id_modulo_rel3);


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
		
   
   		//print_array($data);die('datos administrar');
		#La vista siempre,  debe ir cargada al final de la función
		$this->layout->view('/'.$this->nombre_gen_plu.'/administrar',$data);
	}

	
	public function process($codigo = false){
		//print_array($this->input->post());die('dfdfd');
		$datos = $this->input->post();
        if($datos){

            $nombre_completo = $datos[$this->prefijo_pri."nombre_completo"];
            $rut = $datos[$this->prefijo_pri."rut_"];

            $fecha_ingreso= formatearFecha($datos[$this->prefijo_pri."fecha_ingreso"]);
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


	public function processestado($codigo = false){
		//print_array($this->input->post());die('dfdfd');
		$datos = $this->input->post();
		//print_array($datos);die('estadindex');
		$codigo =  $datos[$this->prefijo_pri."codigo"];
        if($datos){

 

     
            //if($codigo){

             
				$this->ws->actualizar($this->id_modulo,$datos,$this->prefijo_pri."codigo = {$codigo}");


                        
                echo json_encode(array("result"=>true,"msj"=>"Datos Actualizados Correctamente."));
           // }else{

             
                    //echo json_encode(array("result"=>false,"msj"=>"El paciente no existe"));
                //}

     
		}else
			echo json_encode(array("result"=>false,"msj"=>"No se recibieron datos."));
	}



	public function listar_unidades(){

        $codigocentromedico = $this->input->post('codigocentromedico');

        $unidades = $this->ws->listar(39, "unid_centro_medico = '$codigocentromedico'");

      // echo $codigocentromedico;
        //print_array($unidades);die('unidades');

       

       $array = '<option value="">Seleccione Unidad</option>';

        foreach($unidades as $unidad){

               $select = '';

             if($unidad->centro_medico == $codigocentromedico){

               // $select='selected';
             }

             $array .= '<option '.$select.' value="'.$unidad->codigo.'">'.$unidad->nombre.'</option>';

        }



/*
        $array = '<option value=""></option>';

        foreach($unidades as $uni){

               $select='selected';
             

    
            $array .= '<option '.$select.' value="'.$uni->codigo.'">'.$uni->nombre.'</option>';
             
        }*/

    echo json_encode(array('unidades'=>$array));

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




 public function exportar_fichas(){

        
         


		$datos = $this->ws->listar($this->id_modulo);
		$rel = $this->ws->listar($this->id_modulo_rel);
		//$rel2 = $this->ws->listar($this->id_modulo_rel2);
		$rel3 = $this->ws->listar($this->id_modulo_rel3);
		




 
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
   


    //i es 10 para dejar espacio para el header del excel
    $i=1;
    //nombre de las columnas utilizadas y estilo
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Centro médico');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArray);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, 'Unidad');
    $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleArray);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, 'Fecha');
    $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleArray);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i, 'Hora');
    $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleArray);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i, 'Nombre');
    $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleArray);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i, 'Rut');
    $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleArray);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i, 'Estado');
    $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleArray);
 
    $i++;


    //vacio es para dejar vacio las sin datos de un item
    $VACIO="";
    //se recorre el nivel 1
   foreach($datos as $dato){
   
      
        foreach($rel3 as $re3) {
foreach($rel as $re) {
if ($re3->codigo == $dato->unidad_2 && $re3->centro_medico ==   $re->codigo ) {
      //se imprime el item y su descripcion 
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $re->nombre);
      $objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleArraInfo);
  		}
	}
}


 foreach($rel3 as $re3) {
if($re3->codigo == $dato->unidad_2) {
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $re3->nombre);
      $objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleArraInfo);
  		}
  	}
  

  	      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, $dato->fecha_ingreso);
      $objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($styleArraInfo);
      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i, $dato->hora_ingreso);
      $objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($styleArraInfo);
	

      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i, $dato->nombre_completo);
      $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($styleArraInfo);


      $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i, $dato->rut_);
      $objPHPExcel->getActiveSheet()->getStyle('F'.$i)->applyFromArray($styleArraInfo);


       $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i, $dato->estado);
      $objPHPExcel->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleArraInfo);
  	

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

	 public function cambiar_estado(){

		//$datos = $this->input->post();
		//print($datos);die('dsfds');

        $codigoestado = $this->input->post('codigoestado');
                $codigo = $this->input->post('codigo');

               // echo $codigo;echo $codigoestado;die('dsdsfdffdfdfd');

              $datos[$this->prefijo_pri."estado"]=$codigoestado;
              //$datos[$this->prefijo_pri."codigo"]=$codigo;
			//print_array($datos);die('datos');


                if($codigo!=null && $codigoestado!=null){

				$this->ws->actualizar($this->id_modulo,$datos,$this->prefijo_pri."codigo = {$codigo}");


                        
                echo json_encode(array("result"=>true,"msj"=>"Datos Actualizados Correctamente."));
            }else
			echo json_encode(array("result"=>false,"msj"=>"No se recibieron datos."));
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
