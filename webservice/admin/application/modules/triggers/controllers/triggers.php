<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Triggers extends CI_Controller {

	function __construct(){
		parent::__construct();
        
        #si no está logeado no puede estar acá
        if(!$this->session->userdata('usuario'))
            redirect('/');
            
        #models
        $this->load->model('triggers_model','objTrigger');
        $this->load->model('tipo_triggers_model','objTipoTrigger');
        $this->load->model('tipo_accion_triggers_model','objAccionTrigger');
        $this->load->model('oldnew_triggers_model','objOldnew');
        $this->load->model('tablas/tabla_model','objTabla');
        $this->load->model('tablas/campo_model','objCampo');
        $this->load->model('tablas/tipo_campo_model','objTipoCampo');
        
        #current
        $this->layout->current = 3;
        
	}
	
	public function index()
	{
        #title
		$this->layout->title('Triggers');
		
		#js
		$this->layout->js("/js/sistema/triggers/index.js");
		
		$where = $and = $contenido['q'] = '';
		$url = '/';
		if($this->input->get('q')){
			$contenido['q'] = $busqueda = $this->input->get('q');
			$where = "(trig_nombre like '%$busqueda%' or tab_nombre like '%$busqueda%')";
            $and = ' and ';
		}
        
        $url = explode('?',$_SERVER['REQUEST_URI']);
        if(isset($url[1]))
            $url = '/?'.$url[1];
        else
            $url = '';
		
		#paginacion
		$config['base_url'] = base_url().'/triggers/';
		$config['total_rows'] = count($this->objTrigger->listar($where));
		$config['per_page'] = 15;
		$config['uri_segment'] = $segment = 2;
		$config['suffix'] = $url;
		$config['first_url'] = base_url().'/triggers'.$url;
		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment($segment))?$this->uri->segment($segment)-1:0;
		
		#nav
		$this->layout->nav(array("Triggers"=>'/'));
			
		#contenido
		$contenido['triggers'] = $this->objTrigger->listar($where,$config["per_page"],$page*$config["per_page"]);
		$contenido['pagination'] = $this->pagination->create_links();
		
		$this->layout->view('index',$contenido);
           
    }
    
    public function crear(){
        
        if($this->input->post()){
            #validaciones
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			
			$this->form_validation->set_message('required', '* %s es obligatorio');
			$this->form_validation->set_error_delimiters('<div>','</div>');
			
			if(!$this->form_validation->run()){
				echo json_encode(array("result"=>false,"msg"=>validation_errors()));
				exit;
			}
			else{
                
                #verifica que el trigger no exista
                if($this->objTrigger->obtener(array("trig_nombre"=>$this->input->post('nombre')))){
                    echo json_encode(array("result"=>false,"msg"=>"El nombre del trigger ya existe"));
                    exit;
                }
                
                $codigo = $datos['trig_codigo'] = $this->objTrigger->nextId();
                $datos['trig_nombre'] = $this->input->post('nombre');
                $nombre = $datos['trig_nombre_trigger'] = slug($this->input->post('nombre'),'_');
                $datos['tab_codigo'] = $this->input->post('tabla_principal');
                $datos['tatr_codigo'] = $this->input->post('accion_principal');
                $datos['ttri_codigo'] = $this->input->post('tipo_principal');
                
                $accion = $this->objAccionTrigger->obtener_por_codigo($this->input->post('accion_principal'));
                $tipo = $this->objTipoTrigger->obtener_por_codigo($this->input->post('tipo_principal'));
                $tabla_principal = $this->objTabla->obtener_por_codigo($this->input->post('tabla_principal'));
                
                $tabla_secundaria = $this->objTabla->obtener_por_codigo($this->input->post('tabla_secundaria'));
                $accion_secundaria = $this->objAccionTrigger->obtener_por_codigo($this->input->post('accion_secundaria'));
                
                $agregado = '';
                if($accion_secundaria->codigo == 1){ #insert
                    $agregado = 'INTO ';
                }
                elseif($accion_secundaria->codigo == 3){ #delete
                    $agregado = 'FROM ';
                }
                
                #asignacion de valores
                $campos1_valor = $this->input->post('campos1_valor');
                $valores_valor = $this->input->post('valores_valor');
                $campos2_valor = $this->input->post('campos2_valor');
                $oldnews_valor = $this->input->post('oldnew_valor');
                
                $condiciones = $valores = "";
                if($campos2_valor || $valores_valor){
                    if($accion_secundaria->codigo == 1){ #insert
                        $valores = " ("; $coma = '';
                        foreach($campos1_valor as $k=>$aux){
                            $campo_valor = $this->objCampo->obtener_por_codigo($aux);
                            if($valores_valor[$k] != "" || $campos2_valor[$k] != ""){
                                $valores .= $coma.$campo_valor->nombre_campo;
                                $coma = ",";
                            }
                        }
                        $valores.= ') VALUES('; $coma = '';
                        foreach($campos1_valor as $k=>$aux){
                            if($valores_valor[$k] != ""){
                                $valores .= $coma.'"'.$valores_valor[$k].'"';
                                $coma = ",";
                            }
                            elseif($campos2_valor[$k] != ""){
                                $campo = $this->objCampo->obtener_por_codigo($campos2_valor[$k]);
                                $oldnew = $this->objOldnew->obtener_por_codigo($oldnews_valor[$k]);
                                $valores .= $coma.' '.$oldnew->nombre.'.'.$campo->nombre_campo;
                                $coma = ",";
                            }
                        }
                        $valores.= ') ';
                    }
                    elseif($accion_secundaria->codigo == 2){ #update
                        $valores = " SET "; $coma = "";
                        foreach($campos1_valor as $k=>$aux){
                            $campo_valor = $this->objCampo->obtener_por_codigo($aux);
                            if($valores_valor[$k] != ""){
                                $valores .= $coma.$campo_valor->nombre_campo.' = '.'"'.$valores_valor[$k].'"';
                                $coma = ",";
                            }
                            elseif($campos2_valor[$k] != ""){
                                $campo = $this->objCampo->obtener_por_codigo($campos2_valor[$k]);
                                $oldnew = $this->objOldnew->obtener_por_codigo($oldnews_valor[$k]);
                                $valores .= $coma.$campo_valor->nombre_campo.' = '.$oldnew->nombre.'.'.$campo->nombre_campo;
                                $coma = ",";
                            }
                        }
                    }
                }
                
                #asignacion de valores
                $campos1_condicion = $this->input->post('campos1_condicion');
                $condiciones_condicion = $this->input->post('condiciones_condicion');
                $valores_condicion = $this->input->post('valores_condicion');
                $campos2_condicion = $this->input->post('campos2_condicion');
                $oldnews_condicion = $this->input->post('oldnew_condicion');
                
                if($campos2_condicion || $valores_condicion){
                    if($accion_secundaria->codigo == 2 || $accion_secundaria->codigo == 3){ #update o delete
                        $condiciones = " WHERE "; $and = "";
                        foreach($campos1_condicion as $k=>$aux){
                            $campo_condicion = $this->objCampo->obtener_por_codigo($aux);
                            $condicion = $this->objTipoCampo->obtener_condicion(array("conc_codigo"=>$condiciones_condicion[$k]));
                            if($valores_condicion[$k] != ""){
                                $condiciones .= $and.$campo_condicion->nombre_campo.' '.$condicion->nombre.' '.'"'.$valores_condicion[$k].'"';
                                $and = " AND ";
                            }
                            elseif($campos2_condicion[$k] != ""){
                                $campo = $this->objCampo->obtener_por_codigo($campos2_condicion[$k]);
                                $oldnew = $this->objOldnew->obtener_por_codigo($oldnews_condicion[$k]);
                                
                                $condiciones .= $and.$campo_condicion->nombre_campo.' '.$condicion->nombre.' '.$oldnew->nombre.'.'.$campo->nombre_campo;
                                $and = " AND ";
                            }
                        }
                    }
                }
                
                #crea el trigger en la db
                $sql = "CREATE TRIGGER ".$nombre." ".$tipo->nombre." ".$accion->nombre." ON ".$tabla_principal->nombre_tabla." FOR EACH ROW 
                    BEGIN ";
                    $sql .= $accion_secundaria->nombre.' '.$agregado.$tabla_secundaria->nombre_tabla.$valores.$condiciones;
                    $sql .= "; END";
                    
                $this->objTrigger->query($sql);
                
                $datos['trig_sql'] = $sql;
                $this->objTrigger->agregar($datos);
                unset($datos);
                
                echo json_encode(array("result"=>true,"codigo"=>$codigo));
			}
        }
        else{
            
            #title
            $this->layout->title('Crear Trigger');

    		#js
    		$this->layout->js("/js/sistema/triggers/crear.js");
            
            #contenido
            $contenido['tablas'] = $this->objTabla->listar();
            $contenido['acciones'] = $this->objAccionTrigger->listar();
            $contenido['tipos'] = $this->objTipoTrigger->listar();
            
            #nav
            $this->layout->nav(array("Trigger"=>'triggers',"Crear"=>""));
            
            #view
            $this->layout->view('crear',$contenido);
        }
    }
    
    public function ver($codigo){
            
        #title
        $this->layout->title('Detalle Trigger');

        #contenido
        if($contenido['trigger'] = $this->objTrigger->obtener_por_codigo($codigo));
        else show_error('Página no encontrada');
        
        #nav
        $this->layout->nav(array("Triggers"=>'triggers',"Detalle"=>""));
        
        #view
        $this->layout->view('ver',$contenido);
    }
    
    public function eliminar(){
        
        if($this->input->post()){
            
            try{
                $trigger = $this->objTrigger->obtener_por_codigo($this->input->post('codigo'));
                $this->objTrigger->eliminar(array("trig_codigo"=>$this->input->post("codigo")));
                
                $sql = "DROP TRIGGER IF EXISTS ".$trigger->nombre_trigger;
                $this->objTrigger->query($sql);
                    
                echo json_encode(array("result"=>true));
            }
            catch(Exception $e){
                echo json_encode(array("result"=>false,"msg"=>"Ha ocurrido un error inesperado. Por favor, inténtelo nuevamente."));
            }
        }
        else{
            show_error('Página no encontrada');
        }
    }
    
    
    public function listar_valores_condiciones(){
        if($this->input->post()){
            $tabla_principal = $this->input->post('tabla_principal');
            $tabla_secundaria = $this->input->post('tabla_secundaria');
            $tipo_principal = $this->input->post('tipo_principal');
            $accion_principal = $this->input->post('accion_principal');
            $valores = $condiciones = "";
            if($tabla_principal && $tabla_secundaria){
                
                $tabla_principal = $this->objTabla->obtener_por_codigo($tabla_principal);
                $tabla_secundaria = $this->objTabla->obtener_por_codigo($tabla_secundaria);
                
                $whereOld = "";
                if($tipo_principal == 1) #before
                    $whereOld = "olne_codigo = 1"; #solo old
                elseif($tipo_principal == 2 && $accion_principal == 1) #after e insert
                    $whereOld = "olne_codigo = 2"; #solo new
                elseif($tipo_principal == 2 && $accion_principal == 3) #after y delete
                    $whereOld = "olne_codigo = 1"; #solo old
                $oldnew = $this->objOldnew->listar($whereOld);
                
                $valores .= '
                <div class="thumbnail table-responsive all-responsive">
                <table border="0" cellspacing="0" cellpadding="0" class="table tablesorter table-hover" style="margin-bottom:0;">
                	<thead>
                        <tr>
            				<th scope="col">Campo</th>
                            <th scope="col" style="width:1%;"></th>
            				<th scope="col">Ingrese Valor</th>
            				<th scope="col" style="width:1%;"></th>
            				<th scope="col">Valor Tabla Principal</th>
            				<th scope="col" class="last"></th>
            			</tr>
            		</thead>
                    <tbody>';
                foreach($tabla_secundaria->campos as $aux){
    				$valores .= '
                    <tr class="tr_condiciones">
    					<td>'.$aux->nombre.'
                            <input type="hidden" name="campos1_valor[]" value="'.$aux->codigo.'"/>
                        </td>
                        <td>=</td>
                        <td>
                            <input type="text" class="form-control" name="valores_valor[]"/>
                        </td>
                        <td>Ó</td>
                        <td>
                            <select class="form-control condiciones" name="campos2_valor[]">
                                <option value="">Seleccione</option>';
                                foreach($tabla_principal->campos as $camp){
                                    $valores .='<option value="'.$camp->codigo.'">'.$camp->nombre.'</option>';
                                }
                            $valores .='</select>
                        </td>
                        <td>
                            <select class="form-control condiciones" name="oldnew_valor[]">';
                                foreach($oldnew as $old){
                                    $valores .='<option value="'.$old->codigo.'">'.$old->nombre.'</option>';
                                }
                            $valores .='</select>
                        </td>
    				</tr>';
                }
                $valores .= '
                    </tbody>
               	</table>
                </div>';
                
                $condiciones .= '
                <div class="thumbnail table-responsive all-responsive">
                <table border="0" cellspacing="0" cellpadding="0" class="table tablesorter table-hover" style="margin-bottom:0;">
                	<thead>
                        <tr>
            				<th scope="col">Campo</th>
            				<th scope="col">Condición</th>
            				<th scope="col">Ingrese Valor</th>
                            <th scope="col" style="width:1%;"></th>
            				<th scope="col">Valor Tabla Principal</th>
                            <th scope="col" class="last"></th>
            			</tr>
            		</thead>
                    <tbody>';
                foreach($tabla_secundaria->campos as $aux){
                    
    				$condiciones .= '
                    <tr class="tr_condiciones">
    					<td>'.$aux->nombre.'</td>
                        <input type="hidden" name="campos1_condicion[]" value="'.$aux->codigo.'"/>
                        <td>
                            <select class="form-control" name="condiciones_condicion[]">';
                                foreach($aux->tipo_campo->condiciones as $cond){
                                    $condiciones .='<option value="'.$cond->codigo.'">'.$cond->nombre.'</option>';
                                }
                            $condiciones .='</select>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="valores_condicion[]"/>
                        </td>
                        <td>Ó</td>
                        <td>
                            <select class="form-control condiciones" name="campos2_condicion[]">
                                <option value="">Seleccione</option>';
                                foreach($tabla_principal->campos as $camp){
                                    $condiciones .='<option value="'.$camp->codigo.'">'.$camp->nombre.'</option>';
                                }
                            $condiciones .='</select>
                        </td>
                        <td>
                            <select class="form-control condiciones" name="oldnew_condicion[]">';
                                foreach($oldnew as $old){
                                    $condiciones .='<option value="'.$old->codigo.'">'.$old->nombre.'</option>';
                                }
                            $condiciones .='</select>
                        </td>
    				</tr>';
                }
                $condiciones .= '
                    </tbody>
               	</table>
                </div>';
            }
            
            $html = new stdClass();
            $html->valores = $valores;
            $html->condiciones = $condiciones;
            echo json_encode($html);
        }
    }
    
}