<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class Escritorio extends CI_Controller {
	
	function __construct(){
	
		parent::__construct();
		
		#current
		$this->layout->current = 1;
	}
	
	public function index()	{
	   
 
           
        #Title
		$this->layout->title('Escritorio');
		
		#Metas
		$this->layout->setMeta('title','Escritorio');
		$this->layout->setMeta('description','Escritorio');
		$this->layout->setMeta('keywords','Escritorio');
		
		#JS - pagination
		$this->layout->js('/js/jquery/form-elements/custom-form-elements.min.js');
		$this->layout->css('/js/jquery/form-elements/form.css');
		
		#JS - Multiple select
		$this->layout->css('/js/jquery/bootstrap/bootstrap-multi-select/dist/css/bootstrap-select.css');
		$this->layout->js('/js/jquery/bootstrap/bootstrap-multi-select/js/bootstrap-select.js');
		
		#JS - datepicker
		$this->layout->js('/js/jquery/bootstrap/datepicker/bootstrap-datepicker.js');
		$this->layout->css('/js/jquery/bootstrap/datepicker/datepicker3.css');
		
		#JS - highcharts
		$this->layout->js('/js/jquery/highcharts/js/highcharts.js');
		$this->layout->js('/js/jquery/highcharts/js/modules/exporting.js');
        
        #JS noty
        $this->layout->js('/js/jquery/noty/packaged/jquery.noty.packaged.js');
        
        #validation engine
        $this->layout->css('/js/jquery/validation-engine/css/validationEngine.jquery.css');
        $this->layout->js('/js/jquery/validation-engine/js/jquery.validationEngine.js');
        $this->layout->js('/js/jquery/validation-engine/js/languages/jquery.validationEngine-es.js');
            
        #JS
        $this->layout->js('/js/sistema/escritorio/index.js');
		
        #ejecutivos
        $this->ws->order("usu_primer_apellido ASC");
        $contenido['ejecutivos'] = $this->ws->listar(47,"usu_estado = 1 and usu_cargo IN(9,8,11,17)");
        
        #estados
        $contenido['estados'] = array();
        $contenido['estados'][0] = new stdClass();
        $contenido['estados'][0]->nombre = 'Cotizando';
        $contenido['estados'][0]->codigo = 1;
        
        $contenido['estados'][1] = new stdClass();
        $contenido['estados'][1]->nombre = 'Enviada';
        $contenido['estados'][1]->codigo = 2;
        
        $contenido['estados'][2] = new stdClass();
        $contenido['estados'][2]->nombre = 'Confirmada';
        $contenido['estados'][2]->codigo = 3;
        
        
        #notificaciones
        $noti = $this->notificaciones_model->listar(); 
        
        
        foreach($noti as $not){
            
            $array =  explode("/", $not->url);
            
            $id_evento = $array[3];
            
            
            $not->evento  = $this->ws->obtener(46, "eve_codigo = '$id_evento'");
             
           // $not->evento  = $id_evento;
            
            
            
        }
           
        
        #print_array($noti); die;    
         
        $contenido['notificaciones'] =  $noti;
        #print_array($contenido['notificaciones']); die; 
          
        
		#Nav
		$this->layout->nav(array("Escritorio"=>"/"));
		
		#view
		$this->layout->view('index',$contenido);
	}
    
    #marca la notificacion como vista
    public function visto_notificacion(){
        
        if($this->input->post()){
            $codigo = $this->input->post('codigo');
            $this->notificaciones_model->visto($codigo);
            
            echo json_encode(array("result"=>true));
        }    
    }
    
    public function grafico_estado(){
        
        if($this->input->post()){
            
            $grafico = array();
            $grafico[0] = new stdClass();
            $grafico[0]->nombre = 'Cotizando';
            $grafico[0]->codigo = 1;
            
            $grafico[1] = new stdClass();
            $grafico[1]->nombre = 'Enviada';
            $grafico[1]->codigo = 2;
            
            $grafico[2] = new stdClass();
            $grafico[2]->nombre = 'Confirmada';
            $grafico[2]->codigo = 3;
            
            $where = $and = "";
            
            if($desde = $this->input->post('desde')){
                $desde = formatearFecha($desde);
                $where .= $and."pso_fecha >= '$desde'";
                $and = ' and ';
            }
            
            if($hasta = $this->input->post('hasta')){
                $desde = formatearFecha($hasta);
                $where .= $and."pso_fecha <= '$hasta'";
                $and = ' and ';
            }
            
            if($ejecutivo = $this->input->post('ejecutivo')){
                $where .= $and."eve_coordinador = '$ejecutivo'";
                $and = ' and ';
            }
            
            $datosGrafico = array();
            $error = true;
            foreach($grafico as $aux){
                
                #confirmado
                if($aux->codigo == 3)
                    $this->ws->where("eve_confirmar_contrato = 1");
                #enviada
                elseif($aux->codigo == 2)
                    $this->ws->where("(eve_enviar_cotizacion_al_cliente = 1 and eve_confirmar_contrato = 0)");
                #cotizando
                elseif($aux->codigo == 1)
                    $this->ws->where("(eve_enviar_cotizacion_al_cliente = 0 and eve_confirmar_contrato = 0)");
                
                if($where)
                    $this->ws->where($where);
                    
                #listado de eventos por tipo
                $this->ws->joinInner(49,"ord_evento = eve_codigo"); #ordenes
                $this->ws->joinInner(50,"ord_codigo = pso_orden"); #proveedor_servicios_orden
                $this->ws->joinLeft(38,"pso_proveedor_servicio = provs_codigo"); #proveedor_servicios
                $this->ws->joinLeft(32,"provs_proveedor = prov_codigo"); #proveedores
                $this->ws->group("eve_codigo");
                $eventos = $this->ws->listar(46,"ord_tipo_orden = 1");
                
                $aux->cantidad = count($eventos);
                
                $datosGrafico[] = array($aux->nombre.' ('.$aux->cantidad.')',$aux->cantidad);
                
                if($aux->cantidad > 0)
                    $error = false;
            }
            
            if($error)
                $return = array("result"=>false,"error"=>"<span>Sin resultados</span>");
            else
                $return = array("result"=>true,"name"=>'Cantidad', "colorByPoint"=> "true", "data"=>$datosGrafico);
            
            echo json_encode(array("datos"=>$return));
        }
    }
    
    public function grafico_ejecutivo(){
        
        if($this->input->post()){
            
            #listado de ejecutivos
            $this->ws->order("usu_primer_apellido ASC");
            $ejecutivos = $this->ws->listar(47,"usu_estado = 1 and usu_cargo IN(9,8,11,17)");
            
            $where = $and = "";
            
            if($desde = $this->input->post('desde')){
                $desde = formatearFecha($desde);
                $where .= $and."(pso_fecha >= '$desde' and pso_uso = 3)";
                $and = ' and ';
            }
            
            if($hasta = $this->input->post('hasta')){
                $desde = formatearFecha($hasta);
                $where .= $and."(pso_fecha <= '$hasta' and pso_uso = 3)";
                $and = ' and ';
            }
            
            if($estado = $this->input->post('estado')){
                
                #confirmado
                if($estado == 3)
                    $where .= $and."eve_confirmar_contrato = 1";
                #enviada
                elseif($estado == 2)
                    $where .= $and."(eve_enviar_cotizacion_al_cliente = 1 and eve_confirmar_contrato = 0)";
                #cotizando
                elseif($estado == 1)
                    $where .= $and."(eve_enviar_cotizacion_al_cliente = 0 and eve_confirmar_contrato = 0)";
                
                $and = ' and ';
            }
            
            $datosGrafico = array();
            $error = true;
            foreach($ejecutivos as $aux){
                
                if($where)
                    $this->ws->where($where);
                    
                #listado de eventos por tipo
                $this->ws->joinInner(49,"ord_evento = eve_codigo"); #ordenes
                $this->ws->joinInner(50,"ord_codigo = pso_orden"); #proveedor_servicios_orden
                $this->ws->joinLeft(38,"pso_proveedor_servicio = provs_codigo"); #proveedor_servicios
                $this->ws->joinLeft(32,"provs_proveedor = prov_codigo"); #proveedores
                $this->ws->group("eve_codigo");
                $eventos = $this->ws->listar(46,"ord_tipo_orden = 1 and eve_coordinador = {$aux->codigo}");
                
                $aux->cantidad = count($eventos);
                
                $datosGrafico[] = array($aux->nombre.' ('.$aux->cantidad.')',$aux->cantidad);
                
                if($aux->cantidad > 0)
                    $error = false;
            }
            
            if($error)
                $return = array("result"=>false,"error"=>"<span>Sin resultados</span>");
            else
                $return = array("result"=>true,"name"=>'Cantidad', "colorByPoint"=> "true", "data"=>$datosGrafico);
            
            echo json_encode(array("datos"=>$return));
        }
    }
    
    public function grafico_cotizaciones(){
        
        if($this->input->post()){
            
            #estados
            $estados = array();
            $estados[0] = new stdClass();
            $estados[0]->codigo = 1;
            $estados[0]->nombre = 'Con reserva';
            
            $estados[1] = new stdClass();
            $estados[1]->codigo = 0;
            $estados[1]->nombre = 'Sin reserva';
            
            
            $where = $and = "";
            
            if($desde = $this->input->post('desde')){
                $desde = formatearFecha($desde);
                $where .= $and."(pso_fecha >= '$desde' and pso_uso = 3)";
                $and = ' and ';
            }
            
            if($hasta = $this->input->post('hasta')){
                $desde = formatearFecha($hasta);
                $where .= $and."(pso_fecha <= '$hasta' and pso_uso = 3)";
                $and = ' and ';
            }
            
            $datosGrafico = array();
            $error = true;
            $total_cotizaciones = 0;
            foreach($estados as $aux){
                
                if($where)
                    $this->ws->where($where);
                    
                #listado de eventos por tipo
                $this->ws->joinInner(49,"ord_evento = eve_codigo"); #ordenes
                $this->ws->joinInner(50,"ord_codigo = pso_orden"); #proveedor_servicios_orden
                $this->ws->joinLeft(38,"pso_proveedor_servicio = provs_codigo"); #proveedor_servicios
                $this->ws->joinLeft(32,"provs_proveedor = prov_codigo"); #proveedores
                $this->ws->group("eve_codigo");
                $eventos = $this->ws->listar(46,"ord_tipo_orden = 1 and eve_implica_reserva = {$aux->codigo}");
                
                $aux->cantidad = count($eventos);
                
                $datosGrafico[] = array($aux->nombre.' ('.$aux->cantidad.')',$aux->cantidad);
                
                $total_cotizaciones += $aux->cantidad;
                if($aux->cantidad > 0)
                    $error = false;
            }
            
            if($error)
                $return = array("result"=>false,"error"=>"<span>Sin resultados</span>");
            else
                $return = array("result"=>true,"name"=>'Cantidad', "colorByPoint"=> "true", "data"=>$datosGrafico);
            
            echo json_encode(array("total_cotizaciones"=>$total_cotizaciones,"datos"=>$return));
        }
    }
	
    public function exportar_excel(){
        
        if($this->input->post()){
            
            #models
            $this->load->model('exportar_model','objExportar');
            
            $svg = $this->input->post('svg');
            $tipo_grafico = $this->input->post('grafico');
            
            $where = $and = "";
            $filtros = new stdClass();
            
            if($desde = $this->input->post('desde')){
                
                $filtros->fecha_desde = $desde;
                
                $desde = formatearFecha($desde);
                $where .= $and."(pso_fecha >= '$desde' and pso_uso = 3)";
                $and = ' and ';
            }
            
            if($hasta = $this->input->post('hasta')){
                
                $filtros->fecha_hasta = $hasta;
                
                $desde = formatearFecha($hasta);
                $where .= $and."(pso_fecha <= '$hasta' and pso_uso = 3)";
                $and = ' and ';
            }
                
            if($tipo_grafico == 1){
                
                $grafico = array();
                $grafico[0] = new stdClass();
                $grafico[0]->nombre = 'Cotizando';
                $grafico[0]->codigo = 1;
                
                $grafico[1] = new stdClass();
                $grafico[1]->nombre = 'Enviada';
                $grafico[1]->codigo = 2;
                
                $grafico[2] = new stdClass();
                $grafico[2]->nombre = 'Confirmada';
                $grafico[2]->codigo = 3;
                
                if($ejecutivo = $this->input->post('ejecutivo'))
                    $this->ws->where("usu_codigo = $ejecutivo");
                
                #ejecutivos
                $this->ws->order("usu_primer_apellido ASC");
                $ejecutivos = $this->ws->listar(47,"usu_estado = 1 and usu_cargo IN(9,8,11,17)");
                foreach($ejecutivos as $eje){
                    
                    $eje->fecha_desde = date('Y-m-d');
                    $eje->fecha_hasta = date('Y-m-d');
                    $eje->datos = array();
                    foreach($grafico as $gr){
                        
                        #confirmado
                        if($gr->codigo == 3)
                            $this->ws->where("eve_confirmar_contrato = 1");
                        #enviada
                        elseif($gr->codigo == 2)
                            $this->ws->where("(eve_enviar_cotizacion_al_cliente = 1 and eve_confirmar_contrato = 0)");
                        #cotizando
                        elseif($gr->codigo == 1)
                            $this->ws->where("(eve_enviar_cotizacion_al_cliente = 0 and eve_confirmar_contrato = 0)");
                        
                        if($where)
                            $this->ws->where($where);
                        
                        #listado de eventos por tipo
                        $this->ws->joinInner(49,"ord_evento = eve_codigo",false); #ordenes
                        $this->ws->joinInner(50,"ord_codigo = pso_orden",false); #proveedor_servicios_orden
                        $this->ws->joinLeft(38,"pso_proveedor_servicio = provs_codigo",false); #proveedor_servicios
                        $this->ws->joinLeft(32,"provs_proveedor = prov_codigo",false); #proveedores
                        $this->ws->where("eve_coordinador = '$eje->codigo'");
                        $this->ws->group("eve_codigo");
                        $eventos = $this->ws->listar(46,"ord_tipo_orden = 1");
                        
                        $obj = new stdClass();
                        $obj->nombre = $gr->nombre;
                        $obj->cantidad = count($eventos);
                        
                        $eje->datos[] = $obj;
                    }
                }
                $this->objExportar->excel_estado($ejecutivos);
            }
            elseif($tipo_grafico == 2){
                
                $estados = array();
                $estados[0] = new stdClass();
                $estados[0]->nombre = 'Cotizando';
                $estados[0]->codigo = 1;
                
                $estados[1] = new stdClass();
                $estados[1]->nombre = 'Enviada';
                $estados[1]->codigo = 2;
                
                $estados[2] = new stdClass();
                $estados[2]->nombre = 'Confirmada';
                $estados[2]->codigo = 3;
                
                #ejecutivos
                $this->ws->order("usu_primer_apellido ASC");
                $ejecutivos = $this->ws->listar(47,"usu_estado = 1 and usu_cargo IN(9,8,11,17)");
                
                foreach($estados as $aux){
                    
                    $aux->fecha_desde = date('Y-m-d');
                    $aux->fecha_hasta = date('Y-m-d');
                    $aux->datos = array();
                    
                    foreach($ejecutivos as $eje){
                        
                        #confirmado
                        if($aux->codigo == 3)
                            $this->ws->where("eve_confirmar_contrato = 1");
                        #enviada
                        elseif($aux->codigo == 2)
                            $this->ws->where("(eve_enviar_cotizacion_al_cliente = 1 and eve_confirmar_contrato = 0)");
                        #cotizando
                        elseif($aux->codigo == 1)
                            $this->ws->where("(eve_enviar_cotizacion_al_cliente = 0 and eve_confirmar_contrato = 0)");
                        
                        if($where)
                            $this->ws->where($where);
                        
                        #listado de eventos por tipo
                        $this->ws->joinInner(49,"ord_evento = eve_codigo",false); #ordenes
                        $this->ws->joinInner(50,"ord_codigo = pso_orden",false); #proveedor_servicios_orden
                        $this->ws->joinLeft(38,"pso_proveedor_servicio = provs_codigo",false); #proveedor_servicios
                        $this->ws->joinLeft(32,"provs_proveedor = prov_codigo",false); #proveedores
                        $this->ws->where("eve_coordinador = '$eje->codigo'");
                        $this->ws->group("eve_codigo");
                        $eventos = $this->ws->listar(46,"ord_tipo_orden = 1");
                        
                        $obj = new stdClass();
                        $obj->nombre = $eje->nombre.' '.$eje->primer_apellido.' '.$eje->segundo_apellido;
                        $obj->cantidad = count($eventos);
                        
                        $aux->datos[] = $obj;
                    }
                }
                
                $this->objExportar->excel_ejecutivos($estados);
            }
            elseif($tipo_grafico == 3){
                
                #estados
                $estados = array();
                $estados[0] = new stdClass();
                $estados[0]->codigo = 1;
                $estados[0]->nombre = 'Con reserva';
                
                $estados[1] = new stdClass();
                $estados[1]->codigo = 0;
                $estados[1]->nombre = 'Sin reserva';
                
                $total_cotizaciones = 0;
                foreach($estados as $aux){
                    
                    if($where)
                        $this->ws->where($where);
                        
                    #listado de eventos por tipo
                    $this->ws->joinInner(49,"ord_evento = eve_codigo"); #ordenes
                    $this->ws->joinInner(50,"ord_codigo = pso_orden"); #proveedor_servicios_orden
                    $this->ws->joinLeft(38,"pso_proveedor_servicio = provs_codigo"); #proveedor_servicios
                    $this->ws->joinLeft(32,"provs_proveedor = prov_codigo"); #proveedores
                    $this->ws->group("eve_codigo");
                    $eventos = $this->ws->listar(46,"ord_tipo_orden = 1 and eve_implica_reserva = {$aux->codigo}");
                    
                    $aux->cantidad = count($eventos);
                    $total_cotizaciones += $aux->cantidad;
                }
                
                $filtros->total_cotizaciones = $total_cotizaciones;
                $this->objExportar->excel_cotizaciones($estados,$filtros);
            }
        }
    }
}