<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class control_operativo extends CI_Controller {

    //public $permisos;
	function __construct(){

		parent::__construct();

        //principal
		$this->id_modulo = 37;
        $this->prefijo_pri = "con_";
        $this->title_gen_plu = "control_operativo";
        $this->title_gen_sin = "control_operativo";
        $this->nombre_gen_plu = "control_operativo";
        $this->nombre_gen_sin = "control_operativo";


          //relacion fichas clinicas
        $this->id_modulo_rel = 36;
        $this->prefijo_rel = "fic_";
        $this->nombre_rel_plu = "fichas_clinicas";

                  //relacion centros medicos
        $this->id_modulo_rel2 = 38;
        $this->prefijo_rel2 = "cen_";
        $this->nombre_rel_plu2 = "centros_medicos";

        //relacion kinesiologos
        $this->id_modulo_rel3 = 14;
        $this->prefijo_rel3 = "kin_";
        $this->nombre_rel_plu3 = "kinesiologos";

                     //relacion equipos
        $this->id_modulo_rel4 = 15;
        $this->prefijo_rel4 = "equ_";
        $this->nombre_rel_plu4 = "equipos";

        //relacion respaldos
        $this->id_modulo_rel5 = 16;
        $this->prefijo_rel5 = "res_";
        $this->nombre_rel_plu5 = "respaldos";

                     //relacion  insumos
        $this->id_modulo_rel6 = 18;
        $this->prefijo_rel6 = "ins_";
        $this->nombre_rel_plu6 = "insumos";

        //relacion tipos de control
        $this->id_modulo_rel7 = 19;
        $this->prefijo_rel7 = "tip_";
        $this->nombre_rel_plu7 = "tipos_de_control";


        //relacion modos ventilatorios
        $this->id_modulo_rel8 = 29;
        $this->prefijo_rel8 = "modo_";
        $this->nombre_rel_plu8 = "modos_ventilatorios";


        //relacion modos ventilatorios elacion intermedia
        $this->id_modulo_rel9 = 32;
        $this->prefijo_rel9 = "mod3_";
        $this->nombre_rel_plu9 = "modos_ventilatorios_relacion";



        	  	//relacion unidad
        $this->id_modulo_rel10 = 39 ;
        $this->prefijo_rel10 = "unid_";
        $this->nombre_rel10_plu = "unidad";
     
        #revisa los permisos para el modulo control_operativo
        #$this->permisos = $this->layout->obtener_permisos(5);

        //if(!$this->permisos)
         //   redirect('/');
	}

	public function index()	{
	   
       
		#Title
		$this->layout->title('control_operativo');

		#JS - Multiple select
		$this->layout->css('/js/jquery/bootstrap/bootstrap-multi-select/dist/css/bootstrap-select.css');
		$this->layout->js('/js/jquery/bootstrap/bootstrap-multi-select/js/bootstrap-select.js');

		$this->layout->js('/js/jquery/noty/packaged/jquery.noty.packaged.js');
		$this->layout->js('/js/jquery/validation-engine/js/jquery.validationEngine.js');
		$this->layout->js('/js/jquery/validation-engine/js/languages/jquery.validationEngine-en.js');

		$this->layout->js('/js/sistema/control_operativo/'.$this->nombre_gen_plu.'/administrar.js');

		#JS - pagination
		$this->layout->js('/js/jquery/rpage-master/responsive-paginate.js');
		$this->layout->js('/js/jquery/rpage-master/paginate-init.js');

		#Nav
		$this->layout->nav(array("control_operativo: ".$this->title_gen_plu.""=>"/"));

		$data = false;$where = false;$url = false;
		$url_busqueda = false;
		$url_estado = false;

				$url_centro_medico = false;

		$data['control_operativo_f'] = false;

        $estado=false;$buscar=false;
        $centro_medico=false;
		$data['estado']=$estado;
		$data['buscar']=$buscar;
				$data['centro_medico']=$centro_medico;

        
		if($this->uri->segment(3)=='busqueda'){
			$url_busqueda = 'busqueda/'.$this->uri->segment(4).'/';
			$data['control_operativo_f'] = $this->uri->segment(4);
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
		$config['base_url'] = '/control_operativo/'.$this->nombre_gen_plu.'/'.$url_busqueda;
		
		$config['total_rows'] = count($this->ws->listar($this->id_modulo,$where));
		$config['per_page'] = 3;
        $config['num_links'] = 30;
		$config['suffix'] = $url;
		$config['first_url'] = '/control_operativo/'.$this->nombre_gen_plu.'/'.$url_busqueda;

		$config['next_link'] = '>>';//siguiente link
 		$config['prev_link'] = '<<';//anterior link
		$this->pagination->initialize($config);
		$page = ($this->uri->segment($segment))?$this->uri->segment($segment)-1:0;

		#contenido
		$this->ws->limit($config["per_page"],$page*$config["per_page"]);
        
       	//$data["datos"] = $this->ws->order($this->id_modulo,"codigo"=>"DESC");
       	$this->ws->order(array($this->prefijo_pri.'nombre_completo ASC'));

		$data["datos"] = $this->ws->listar($this->id_modulo,$where);
		$data["rel"] = $this->ws->listar($this->id_modulo_rel);

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
        //    redirect('/control_operativo/'.$this->nombre_gen_plu.'/');

		#Title
		$this->layout->title('control_operativo');

		#JS - Form elements
		##$this->layout->js('/js/jquery/form-elements/custom-form-elements.min.js');
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
			$this->layout->nav(array("control_operativo: $this->title_gen_plu"=>"control_operativo/$this->nombre_gen_plu", "control_operativo: Editar $this->title_gen_sin"=>"/"));
		else
			$this->layout->nav(array("control_operativo: $this->title_gen_plu"=>"control_operativo/$this->nombre_gen_plu", "control_operativo: Agregar $this->title_gen_sin"=>"/"));


		$data = false;
		if($codigo)
			$data["dato"] = $this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo = {$codigo}");

			$data['antes_no_conectado'] = $this->ws->listar($this->id_modulo_rel7,"tip_tipo_conexion_1 = '1'");
		$data['antes_conectado'] = $this->ws->listar($this->id_modulo_rel7);

		//print_array($data);die('dssdfddff');

    	if($this->id_modulo)
    	{
    	$this->ws->order(array($this->prefijo_pri.'codigo ASC'));

		$data['pri'] = $this->ws->listar($this->id_modulo);
		}

    	if($this->id_modulo_rel)
    	{
    	$this->ws->order(array($this->prefijo_rel.'codigo ASC'));

		$data['rel'] = $this->ws->listar($this->id_modulo_rel);
		}

		if($this->id_modulo_rel2)

		$this->ws->order(array($this->prefijo_rel2.'codigo DESC'));

		$data['rel2'] = $this->ws->listar($this->id_modulo_rel2);
		

		if($this->id_modulo_rel3)
    	{
    	$this->ws->order(array($this->prefijo_rel3.'codigo DESC'));

		$data['rel3'] = $this->ws->listar($this->id_modulo_rel3);
		}
		if($this->id_modulo_rel4)
    	{
    	$this->ws->order(array($this->prefijo_rel4.'codigo DESC'));

		$data['rel4'] = $this->ws->listar($this->id_modulo_rel4);
		}

		if($this->id_modulo_rel5)
    	{
    	$this->ws->order(array($this->prefijo_rel5.'codigo DESC'));

		$data['rel5'] = $this->ws->listar($this->id_modulo_rel5);
		}

		if($this->id_modulo_rel6)
    	{
    	$this->ws->order(array($this->prefijo_rel6.'codigo DESC'));

		$data['rel6'] = $this->ws->listar($this->id_modulo_rel6);
		}

		if($this->id_modulo_rel7)
    	{
    	$this->ws->order(array($this->prefijo_rel7.'codigo DESC'));

		$data['rel7'] = $this->ws->listar($this->id_modulo_rel7);
		}
		if($this->id_modulo_rel8)
    	{
    	$this->ws->order(array($this->prefijo_rel8.'codigo DESC'));

		$data['rel8'] = $this->ws->listar($this->id_modulo_rel8);
		}

		if($this->id_modulo_rel9)
    	{
    	$this->ws->order(array($this->prefijo_rel9.'codigo DESC'));

		$data['rel9'] = $this->ws->listar($this->id_modulo_rel9);
		}
			if($this->id_modulo_rel10)
    	{
    	$this->ws->order(array($this->prefijo_rel10.'codigo DESC'));

		$data['rel10'] = $this->ws->listar($this->id_modulo_rel10);
		}
		//print_array($data);die();
		#La vista siempre,  debe ir cargada al final de la función
		//echo ('/'.$this->nombre_gen_plu.'/administrar'); die('ruta');
		$this->layout->view('/'.$this->nombre_gen_plu.'/administrar',$data);
	}

	
	public function process($codigo = false){
		$datos = $this->input->post();




		//print_array($datos);die('LLEGO A process');
        if($datos){

            //$nombre_completo = $datos[$this->prefijo_pri."nombre_completo"];
            $rut_ = $datos[$this->prefijo_pri."rut_"];

            $fecha_ingreso= formatearFecha2($datos[$this->prefijo_pri."fecha_ingreso"]);
            $hora_ingreso= $datos[$this->prefijo_pri."hora_ingreso"];

            $datos[$this->prefijo_pri."fecha_ingreso"]=$fecha_ingreso;

		//print_array($datos);die('LLEGO A process');

     
        
                #revisa que el nombre ingresado no exista
                if($this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo = '$codigo' ")){
                    echo json_encode(array("result"=>false,"msj"=>"El control operativo  ingresado ya se encuentra registrado"));
                    exit;
                }

            

                $this->ws->insertar($this->id_modulo,$datos);

                echo json_encode(array("result"=>true,"msj"=>"Datos Ingresados Correctamente."));
            
		}else
			echo json_encode(array("result"=>false,"msj"=>"No se recibieron datos."));
	}

	/*public function process2($codigo = false){
		$datos = $this->input->post();

		//print_array($this->input->post());die('post');
		//echo $this->input->post('con_tipos_de_control');
		//die('LLEGO A process');
        if($datos){

            //$nombre_completo = $datos[$this->prefijo_pri."nombre_completo"];
            $rut = $datos[$this->prefijo_pri."rut"];
                        //$datos[$this->prefijo_pri."ficha_clinica"]=$codigo;

$datos2[$this->prefijo_pri."cupos"]=$this->input->post('con_cupos');
		$datos2[$this->prefijo_pri."tipos_de_control"]=$this->input->post('con_tipos_de_control');
		$datos2[$this->prefijo_pri."tipo_de_soporte"]=$this->input->post('con_tipo_de_soporte');
		$datos2[$this->prefijo_pri."equipo"]=$this->input->post('con_equipo');

		$modoventilatoriootro['modo_nombre']=$datos['con_modo_ventilatorio_otro'];
		$modoventilatoriootro['modo_tipo']=4;
		$modoventilatoriootro['modo_estado']=1;



		                $codigomodoventilatoriootro=$this->ws->insertar($this->id_modulo_rel8,$modoventilatoriootro);
		                $codigomodoventilatoriootro=$codigomodoventilatoriootro->modo_codigo;

		     $datos[$this->prefijo_pri."modo_ventilatorio_otro"]=$codigomodoventilatoriootro;
				                //print_array($codigomodoventilatoriootro);
				                //print_array($datos);die('otro');


		//$datos2[$this->prefijo_pri."codigo"]=1;
           // $fecha_ingreso = str_replace("/","-",$datos[$this->prefijo_pri."fecha_ingreso"]);


		//if(($datos[$this->prefijo_pri."con_soporte_adicional_inomax"]) == 'on') $datos[$this->prefijo_pri."con_soporte_adicional_inomax"]=1;
		//if(($datos[$this->prefijo_pri."con_soporte_adicional_ecmo_1"])== 'on') $datos[$this->prefijo_pri."con_soporte_adicional_ecmo_1"] =1;
            $fecha_ingreso= formatearFecha2( $datos[$this->prefijo_pri."fecha_ingreso"]);
            $fecha_cambio= formatearFecha2($datos[$this->prefijo_pri."fecha_cambio"]);

 			//$fecha_ingreso= $datos[$this->prefijo_pri."fecha_ingreso"];
            //$fecha_cambio= $datos[$this->prefijo_pri."fecha_cambio"];

            $hora_ingreso= $datos[$this->prefijo_pri."hora_ingreso"];
            $datos[$this->prefijo_pri."fecha_ingreso"]=$fecha_ingreso;
            $datos[$this->prefijo_pri."fecha_cambio"]=$fecha_cambio;
            
				      $datos[$this->prefijo_pri."fecha_ingreso"]='2018-05-22';
            $datos[$this->prefijo_pri."fecha_cambio"]='2018-05-22';

            //$datos[$this->prefijo_pri."fecha_ingreso"]=str_replace("/","-",$fecha_ingreso);
            //$datos[$this->prefijo_pri."fecha_cambio"]=str_replace("/","-",$fecha_cambio);



                	 if($this->ws->obtener($this->id_modulo,$this->prefijo_pri."ficha_clinica = $codigo  "))
                {
                	$codigocontrol=$this->ws->obtener($this->id_modulo,$this->prefijo_pri."ficha_clinica = $codigo  ");
                	$codigocontrol=$codigocontrol->codigo;
                	//echo $codigocontrol;
                   	$this->ws->actualizar(37,$datos,$this->prefijo_pri."codigo = $codigocontrol");

				//print_array($datos);die('actualizo');

                        
                echo json_encode(array("result"=>true,"msj"=>"Datos Actualizados Correctamente."));
                }
				else{

               

                $this->ws->insertar($this->id_modulo,$datos);
				//print_array($datos);die('inserto');

                echo json_encode(array("result"=>true,"msj"=>"Datos Ingresados Correctamente."));
            }
		}else
			echo json_encode(array("result"=>false,"msj"=>"No existe Ficha clinica."));
	}*/

		public function process2($codigo = false){
		$datos = $this->input->post();
		//print_array($datos);die('post');

		
        if($datos){



            //$rut = $datos[$this->prefijo_pri."rut"];
        $codigotipo=  $datos[$this->prefijo_pri."tipos_de_control"];
                $codigoficha=  $datos[$this->prefijo_pri."ficha_clinica"];

        //echo $codigotipo;
         $tipotipo= $this->ws->obtener($this->id_modulo_rel7,"tip_codigo = '$codigotipo'");
                // print_array($tipotipo);
         $tipotipo= $tipotipo->tipo_conexion;
         //echo $tipotipo;//die('muere');

		$datos2[$this->prefijo_pri."cupos"]=$this->input->post('con_cupos');
		$datos2[$this->prefijo_pri."tipos_de_control"]=$this->input->post('con_tipos_de_control');
		$datos2[$this->prefijo_pri."tipo_de_soporte"]=$this->input->post('con_tipo_de_soporte');
		$tiposoporte=$this->input->post('con_tipo_de_soporte');//echo $tiposoporte ;die('tiposoprte');
		$datos2[$this->prefijo_pri."equipo"]=$this->input->post('con_equipo');

        		if ($this->input->post('con_modo_ventilatorio_otro')){

		$modoventilatoriootro['modo_nombre']=$datos['con_modo_ventilatorio_otro'];
		$modoventilatoriootro['modo_tipo']=4;
		$modoventilatoriootro['modo_estado']=1;

		                $codigomodoventilatoriootro=$this->ws->insertar($this->id_modulo_rel8,$modoventilatoriootro);
		                $codigomodoventilatoriootro=$codigomodoventilatoriootro->modo_codigo;

		     $datos[$this->prefijo_pri."modo_ventilatorio_otro"]=$codigomodoventilatoriootro;
		 }

            $fecha_ingreso= formatearFecha( $datos[$this->prefijo_pri."fecha_ingreso"]);
            if($datos[$this->prefijo_pri."fecha_cambio"] != null){
            $fecha_cambio= formatearFecha($datos[$this->prefijo_pri."fecha_cambio"]);
            $datos[$this->prefijo_pri."fecha_cambio"]=$fecha_cambio;
}

			//echo $fecha_ingreso;die('fecha ingreso fomateda');
            $hora_ingreso= $datos[$this->prefijo_pri."hora_ingreso"];
            $datos[$this->prefijo_pri."fecha_ingreso"]=$fecha_ingreso;
            
				     // $datos[$this->prefijo_pri."fecha_ingreso"]='2018-05-22';
           // $datos[$this->prefijo_pri."fecha_cambio"]='2018-05-22';

            //echo (" con_codigo = '$codigo' and  con_fecha_ingreso = '$fecha_ingreso' and  
            	//con_hora_ingreso = '$hora_ingreso' ");die('obtener');
    if($this->ws->obtener($this->id_modulo,"con_codigo = '$codigo' and  con_fecha_ingreso = '$fecha_ingreso' and  con_hora_ingreso = '$hora_ingreso' ")){
                    echo json_encode(array("result"=>false,"msj"=>"El paciente ingresado ya se encuentra registrado"));
                    exit;
                }
			
               		//print_array($datos);die('insertar');

			  $codigo=$this->ws->insertar($this->id_modulo,$datos);
			 // print_array($codigo);die('insertoooooo');
			   $codigo=$codigo->con_codigo;


              if( $tipotipo==1 && $tiposoporte != 1 &&  $tiposoporte != 3){

              $datosconexion[$this->prefijo_pri."estado_conexion"]=1;
              $datosconexion[$this->prefijo_pri."fecha_conexion"]=$datos[$this->prefijo_pri."fecha_ingreso"];

              $datosconexion[$this->prefijo_pri."hora_conexion"]= $datos[$this->prefijo_pri."hora_ingreso"];
             // echo $codigo;echo 'codigo';

             // print_array($datosconexion);die('insetar conexion');

				$this->ws->actualizar($this->id_modulo,$datosconexion,$this->prefijo_pri."codigo = {$codigo}");
			}

                          if( $tipotipo ==0 && $tiposoporte != 1 &&   $tiposoporte != 3){

              $this->ws->order(array($this->prefijo_pri.'fecha_conexion DESC'));

             // $hora_conexion=$this->ws->listar($this->id_modulo,"con_codigo = '$codigo' and  con_estado_conexion = '1' ");
    			$conexion_anterior=$this->ws->listar($this->id_modulo,$this->prefijo_pri."ficha_clinica = '$codigoficha' and ".$this->prefijo_pri."estado_conexion = '1'");              print_array($conexion_anterior);
              if($conexion_anterior){
             // $hora_conexion=$hora_conexion[0];
              $hora_conexion=$conexion_anterior[0]->hora_conexion;
          		$fecha_conexion=$conexion_anterior[0]->fecha_conexion;
          		//$dias_conexion=$conexion_anterior[0]->dias_conexion;

          		          		echo $dias_conexion;die('sdgfbfg');
          		          		$fecha1=$fecha_conexion.' '.$hora_conexion;}

              $fecha1 = new DateTime($fecha1);

          		//print_array($fecha_conexion);die('fdfdf');}
              //echo ($hora_conexion);die('hora conexion');
              $datosdesconexion[$this->prefijo_pri."estado_desconexion"]=1;
              $datosdesconexion[$this->prefijo_pri."fecha_desconexion"]=$datos[$this->prefijo_pri."fecha_ingreso"];

              $datosdesconexion[$this->prefijo_pri."hora_desconexion"]= $datos[$this->prefijo_pri."hora_ingreso"];
               $fecha2= $datosdesconexion[$this->prefijo_pri."fecha_desconexion"].' '.$datosdesconexion[$this->prefijo_pri."hora_desconexion"];
				$fecha2 = new DateTime($fecha2);
             
            //print_array($fecha2);die('fdfdf');

              $fecha_desconexion=$datosdesconexion[$this->prefijo_pri."fecha_desconexion"];
              //$datosdesconexion[$this->prefijo_pri."dias_conexion"]= ($datosdesconexion[$this->prefijo_pri."fecha_desconexion"])-($fecha_conexion);
     
				$fecha = $fecha2->diff($fecha1);
				//printf('%d años, %d meses, %d días, %d horas, %d minutos', $fecha->y, $fecha->m, $fecha->d, $fecha->h, $fecha->i);die('fecha');
				//print_array($fecha);
				$horastotales=($fecha->d*24)+($fecha->h);
				//echo $horastotales;

              //print $fechaF->format("%H:%I:%S"); die('fechaaaaaa');

             // echo $datosdesconexion[$this->prefijo_pri."dias_conexion"];
              $datosdesconexion[$this->prefijo_pri."dias_conexion"]=$fecha->d;
              //$datosdesconexion[$this->prefijo_pri."horas_conexion"]=  RestarHoras($datosdesconexion[$this->prefijo_pri."hora_desconexion"],$hora_conexion);
               $datosdesconexion[$this->prefijo_pri."horas_totales_conexion"]=  $horastotales;

              //$tiempoconcexion=$datosdesconexion[$this->prefijo_pri."hora_desconexion"]-$datosdesconexion[$this->prefijo_pri."hora_conexion"];
              //echo $codigo;echo 'codigo';
               //echo ($fecha_conexion); echo ($hora_conexion);
                      //print_array($datosdesconexion);die('insertar descoexion');


				$this->ws->actualizar($this->id_modulo,$datosdesconexion,$this->prefijo_pri."codigo = {$codigo}");
			}


			  if( $tipotipo==1 && ($tiposoporte == 1 ||  $tiposoporte == 3)){

              $datosconexionventilacionmecanica[$this->prefijo_pri."estado_conexion_ventilacion_mecanica"]=1;
              $datosconexionventilacionmecanica[$this->prefijo_pri."fecha_conexion_ventilacion_mecanica"]=$datos[$this->prefijo_pri."fecha_ingreso"];

              $datosconexionventilacionmecanica[$this->prefijo_pri."hora_conexion_ventilacion_mecanica"]= $datos[$this->prefijo_pri."hora_ingreso"];
             // echo $codigo;echo 'codigo';

            // print_array($datosconexionventilacionmecanica);die('insetar conexion');

				$this->ws->actualizar($this->id_modulo,$datosconexionventilacionmecanica,$this->prefijo_pri."codigo = {$codigo}");
			}

                          if( $tipotipo ==0 && ($tiposoporte == 1 ||   $tiposoporte == 3)){

              $this->ws->order(array($this->prefijo_pri.'fecha_conexion_ventilacion_mecanica DESC'));

             // $hora_conexion=$this->ws->listar($this->id_modulo,"con_codigo = '$codigo' and  con_estado_conexion = '1' ");
    			$conexion_anterior=$this->ws->listar($this->id_modulo,$this->prefijo_pri."ficha_clinica = '$codigoficha' and ".$this->prefijo_pri."estado_conexion_ventilacion_mecanica = '1'");              print_array($conexion_anterior);
              if($conexion_anterior){
             // $hora_conexion=$hora_conexion[0];
              $hora_conexion=$conexion_anterior[0]->hora_conexion_ventilacion_mecanica;
          		$fecha_conexion=$conexion_anterior[0]->fecha_conexion_ventilacion_mecanica;
          		          		//echo $fecha_conexion; echo $hora_conexion;
          		          		$fecha1=$fecha_conexion.' '.$hora_conexion;}

              $fecha1 = new DateTime($fecha1);

          		//print_array($fecha_conexion);die('fdfdf');}
              //echo ($hora_conexion);die('hora conexion');
              $datosdesconexionventilacionmecanica[$this->prefijo_pri."estado_desconexion_ventilacion_mecanica"]=1;
              $datosdesconexionventilacionmecanica[$this->prefijo_pri."fecha_desconexion_ventilacion_mecanica"]=$datos[$this->prefijo_pri."fecha_ingreso"];

              $datosdesconexionventilacionmecanica[$this->prefijo_pri."hora_desconexion_ventilacion_mecanica"]= $datos[$this->prefijo_pri."hora_ingreso"];
               $fecha2= $datosdesconexionventilacionmecanica[$this->prefijo_pri."fecha_desconexion_ventilacion_mecanica"].' '.$datosdesconexionventilacionmecanica[$this->prefijo_pri."hora_desconexion_ventilacion_mecanica"];
				$fecha2 = new DateTime($fecha2);
             
           // print_array($fecha2);print_array($fecha1);die('fdfdf');

              $fecha_desconexion=$datosdesconexionventilacionmecanica[$this->prefijo_pri."fecha_desconexion_ventilacion_mecanica"];
              //$datosdesconexion[$this->prefijo_pri."dias_conexion"]= ($datosdesconexion[$this->prefijo_pri."fecha_desconexion"])-($fecha_conexion);
     
				$fecha = $fecha2->diff($fecha1);
				//printf('%d años, %d meses, %d días, %d horas, %d minutos', $fecha->y, $fecha->m, $fecha->d, $fecha->h, $fecha->i);die('fecha');
				//print_array($fecha);
				$horastotales=($fecha->d*24)+($fecha->h);
				//echo $horastotales;

              //print $fechaF->format("%H:%I:%S"); die('fechaaaaaa');

             // echo $datosdesconexion[$this->prefijo_pri."dias_conexion"];
              $datosdesconexionventilacionmecanica[$this->prefijo_pri."dias_ventilacion_mecanica"]=$fecha->d;
              //$datosdesconexion[$this->prefijo_pri."horas_conexion"]=  RestarHoras($datosdesconexion[$this->prefijo_pri."hora_desconexion"],$hora_conexion);
               $datosdesconexionventilacionmecanica[$this->prefijo_pri."horas_totales_ventilacion_mecanica"]=  $horastotales;

              //$tiempoconcexion=$datosdesconexion[$this->prefijo_pri."hora_desconexion"]-$datosdesconexion[$this->prefijo_pri."hora_conexion"];
              //echo $codigo;echo 'codigo';
               //echo ($fecha_conexion); echo ($hora_conexion);
                     // print_array($datosdesconexionventilacionmecanica);die('insertar descoexion');

 			$datosconexionventilacionmecanica[$this->prefijo_pri."estado_conexion_ventilacion_mecanica"]=0;
				$this->ws->actualizar($this->id_modulo,$datosdesconexionventilacionmecanica,$this->prefijo_pri."codigo = {$codigo}");
			}


				//print_array($datos);die('inserto');

                echo json_encode(array("result"=>true,"msj"=>"Datos Ingresados Correctamente."));
            
		}else
			echo json_encode(array("result"=>false,"msj"=>"No existe Ficha clinica."));
	}



	public function estado_desconexion($codigo = false){
	

		//$datos = $this->input->post();
		//print($datos);die('dsfds');

        $codigoestado = $this->input->post('codigotipo');
                $codigo = $this->input->post('codigo');

               // echo $codigo;echo $codigoestado;die('dsdsfdffdfdfd');

              //$datos[$this->prefijo_pri."estado"]=$codigoestado;
              $datos[$this->prefijo_pri."estado_desconexion"]=1;
              $datos[$this->prefijo_pri."fecha_desconexion"]=$datos[$this->prefijo_pri."fecha_ingreso"];

              $datos[$this->prefijo_pri."hora_desconexion"]=$datos[$this->prefijo_pri."fecha_ingreso"];


              //$datos[$this->prefijo_pri."codigo"]=$codigo;
			//print_array($datos);die('datos');


                if($codigo!=null && $codigoestado==10){

				$this->ws->actualizar($this->id_modulo,$datos,$this->prefijo_pri."codigo = {$codigo}");


                        
                echo json_encode(array("result"=>true,"msj"=>"Datos Actualizados Correctamente."));
            }else
			echo json_encode(array("result"=>false,"msj"=>"No se recibieron datos."));
	}
     

     public function estado_conexion($codigo = false){
	

		//$datos = $this->input->post();
		//print($datos);die('dsfds');

        $codigoestado = $this->input->post('codigotipo');
                $codigo = $this->input->post('codigo');

               // echo $codigo;echo $codigoestado;die('dsdsfdffdfdfd');

              //$datos[$this->prefijo_pri."estado"]=$codigoestado;
              $datos[$this->prefijo_pri."estado_conexion"]=1;
              $datos[$this->prefijo_pri."fecha_conexion"]=$datos[$this->prefijo_pri."fecha_ingreso"];;

              $datos[$this->prefijo_pri."hora_conexion"]=$datos[$this->prefijo_pri."fecha_ingreso"];;


              //$datos[$this->prefijo_pri."codigo"]=$codigo;
			//print_array($datos);die('datos');


                if($codigo!=null && $codigoestado==8 && $codigoestado==9 && $codigoestado==11 && $codigoestado==12 && $codigoestado==14){

				$this->ws->actualizar($this->id_modulo,$datos,$this->prefijo_pri."codigo = {$codigo}");


                        
                echo json_encode(array("result"=>true,"msj"=>"Datos Actualizados Correctamente."));
            }else
			echo json_encode(array("result"=>false,"msj"=>"No se recibieron datos."));
	}
     


	 public function listar_areas(){


        $codigotipoarea = $this->input->post('codigotipoarea');

        //echo $codigotipoarea;die('llego a listar area');

     	if($codigotipoarea == 1){
     		$tipoarea = array('NEO','PED','PDL','PDC','PCL','OTRO');
 		}

 		if($codigotipoarea == 2){
			$tipoarea = array('2','2,5','3','3,5','4','2','2,5','3','3,5','4','4,5','5','5,5','6','6,5','7','7,5','8','8,5','9','OTRO','1'); 		}



        $array = '<option value=""></option>';

        foreach($tipoarea as $tat){

               $select='selected';
             

    
            $array .= '<option '.$select.' value="'.$tat.'">'.$tat.'</option>';
             
        }

    echo json_encode(array('tipoarea'=>$array));

	}

	 public function listar_conexiones(){

	 	//die('llego a controlador');

        $codigoficha = $this->input->post('codigoficha');
                $codigotipo = $this->input->post('codigotipo');

      //  echo $codigotipo;echo $codigoficha;die('tipo y ficha');
       // $control_ficha=false;
       // $codigoficha=12;

    	$this->ws->order(array($this->prefijo_pri.'fecha_conexion DESC'));

    $conectado=$this->ws->obtener($this->id_modulo,$this->prefijo_pri."ficha_clinica = '$codigoficha' and ".$this->prefijo_pri."estado_conexion = '1'");
    	//print_array($conectado);die('gfhgfhgfh');
			if($conectado){
				//echo 'esta conectado';

			$tipos_de_control=$this->ws->listar($this->id_modulo_rel7);
 				//print_array($tipos_de_control);die('tipos control');

			}
			else{
			$tipos_de_control=$this->ws->listar($this->id_modulo_rel7,$this->prefijo_rel7."tipo_conexion_1 = '1'");

				//echo 'nooo esta conectado';

			}

	

        $array = '<option value="Tipos de Control"></option>';

        foreach($tipos_de_control as $tdc){

               $select='selected';
             

    
            $array .= '<option '.$select.' value="'.$tdc->codigo.'">'.$tdc->nombre.'</option>';
                       // $array .= '<option  value="'.$tdc->codigo.'">'.$tdc->nombre.'</option>';

             
        }

        //print_array($array);die('arreglo');

    echo json_encode(array('tipos_de_control'=>$array));

	}

	 
     


	
	public function agregar_insumo_otro($codigo = false){
		$datos = $this->input->post();
        if($datos){

            $nombre = $datos["ins_nombre"];
            $tipo= $datos["ins_tipo"];            
            $datos["ins_stock_alerta"];
            $datos["ins_precio"];
        	$datos["ins_estado"];
       		$datos["ins_descripcion"];
          	$datos["ins_stock_total"];






     
            if($codigo){

                #revisa que el nombre ingresado no exista
                if($this->ws->obtener($this->id_modulo,$this->prefijo_pri."codigo <> $codigo and ".$this->prefijo_pri."nombre = '$nombre'  and ".$this->prefijo_pri."tipo = '$tipo'")){
                    echo json_encode(array("result"=>false,"msj"=>"El nombre y tipo ingresado ya se encuentra registrado"));
                    exit;
                }

                $this->ws->actualizar($this->id_modulo,$datos,$this->prefijo_pri."codigo = {$codigo}");

                        
                echo json_encode(array("result"=>true,"msj"=>"Datos Actualizados Correctamente."));
            }else{

                #revisa que el nombre ingresado no exista
                if($this->ws->obtener($this->id_modulo_rel6,$this->prefijo_pri."nombre = '$nombre' and ".$this->prefijo_pri."tipo = '$tipo'")){
                    echo json_encode(array("result"=>false,"msj"=>"El nombre y tipo ingresado ya se encuentra registrado"));
                    exit;
                }

                $this->ws->insertar($this->id_modulo_rel6,$datos);
                echo json_encode(array("result"=>true,"msj"=>"Datos Ingresados Correctamente."));
            }
		}else
			echo json_encode(array("result"=>false,"msj"=>"No se recibieron datos."));
	}



	public function agregar_control_operativo($codigo = false){

        #permisos del usuario
        //if(!$this->permisos->agregar && !$this->permisos->editar)
        //    redirect('/control_operativo/'.$this->nombre_gen_plu.'/');

		#Title
		$this->layout->title('control_operativo');

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

		$this->layout->js('/js/sistema/control_operativo/'.$this->nombre_gen_plu.'/administrar.js');

		#Nav
		if($codigo)
			$this->layout->nav(array("control_operativo: $this->title_gen_plu"=>"control_operativo/$this->nombre_gen_plu", "control_operativo: Editar $this->title_gen_sin"=>"/"));
		else
			$this->layout->nav(array("control_operativo: $this->title_gen_plu"=>"control_operativo/$this->nombre_gen_plu", "control_operativo: Agregar $this->title_gen_sin"=>"/"));


		//echo $codigo;die('sddsdsds');
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


    		//$eliminar = $this->ws->eliminar($this->id_modulo_rel,$this->prefijo_rel."control_operativo = {$this->input->post('codigo')}");

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
