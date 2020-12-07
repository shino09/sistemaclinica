<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vistas extends CI_Controller {

	function __construct(){
		parent::__construct();
        
        #si no está logeado no puede estar acá
        if(!$this->session->userdata('usuario'))
            redirect('/');
            
        #models
        $this->load->model('tablas/tabla_model','objTabla');
        $this->load->model('tablas/campo_model','objCampo');
        $this->load->model('tipo_asociacion_model','objTipoAsociacion');
        $this->load->model('Tipo_campo_model','objTipoCampo');
		$this->load->model('historial/historial_model','objHistorial');
        
        $this->layout->current = 2;
    
	}
	
	public function index()
	{
        #title
		$this->layout->title('Vistas');
		
		#js
		$this->layout->js("/js/sistema/vistas/index.js");
		
		$where = "tab_vista = 1";
        $and = ' and ';
		$url = '/';
		if($this->input->get('q')){
			$contenido['q'] = $busqueda = $this->input->get('q');
			$where = "(vis_nombre like '%$busqueda%')";
            $and = ' and ';
		}
        
        $url = explode('?',$_SERVER['REQUEST_URI']);
        if(isset($url[1]))
            $url = '/?'.$url[1];
		
		#paginacion
		$config['base_url'] = base_url().'/vistas/';
		$config['total_rows'] = count($this->objTabla->listar($where));
		$config['per_page'] = 15;
		$config['uri_segment'] = $segment = 2;
		$config['suffix'] = $url;
		$config['first_url'] = base_url().'/vistas'.$url;
		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment($segment))?$this->uri->segment($segment)-1:0;
		
		#nav
		$this->layout->nav(array("Vistas"=>'/'));
			
		#contenido
		$contenido['vistas'] = $this->objTabla->listar($where,$config["per_page"],$page*$config["per_page"]);
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
                
                #verifica que la tabla no exista
                if($this->objTabla->obtener(array("tab_nombre"=>$this->input->post('nombre')),true)){
                    echo json_encode(array("result"=>false,"msg"=>"El nombre de la vista ya existe"));
                    exit;
                }
                
                $codigoVista = $datos['tab_codigo'] = $this->objTabla->nextId();
                $datos['tab_nombre'] = $this->input->post('nombre');
                $nombre_vista = $datos['tab_nombre_tabla'] = slug($this->input->post('nombre'),'_');
                
                #guarda las tablas y generar SQL
                $tablaPrincipal = $this->objTabla->obtener_por_codigo($this->input->post('tabla_principal'));
                $camposPrincipales = $this->input->post('campos_tabla_principal');
                $coma = '';
                $sql = "CREATE VIEW ".$nombre_vista." AS SELECT ";
                foreach($camposPrincipales as $aux){
                    $campo = $this->objCampo->obtener_por_codigo($aux);
                    $sql .= $coma.$campo->nombre_campo." ";
                    $coma = ',';
                }
                
                if($campos = $this->input->post('campos')){
                    $asociaciones = $this->input->post('asociacion');
                    $tablas = array();
                    foreach($campos as $aux){
                        $campo = $this->objCampo->obtener_por_codigo($aux);
                        $sql .= $coma.$campo->nombre_campo." ";
                        $coma = ',';
                        
                        $agregar = true;
                        $obj = new stdClass();
                        $obj->nombre_tabla = $campo->tabla->nombre_tabla;
                        $obj->prefijo = $campo->tabla->prefijo;
                        foreach($tablas as $tab1){
                            if($tab1->nombre_tabla == $obj->nombre_tabla)
                                $agregar = false;
                        }
                        if($agregar)
                            $tablas[] = $obj;
                    }
                    
                    $sql .= "FROM ".$tablaPrincipal->nombre_tabla." ".$tablaPrincipal->prefijo." ";
                    foreach($tablas as $k=>$aux){
                        $asociacion = $this->objTipoAsociacion->obtener_por_codigo($asociaciones[$k]);
                        if($asociacion->codigo == 1)
                            $aso = $asociacion->nombre." JOIN";
                        else
                            $aso = "JOIN ".$asociacion->nombre;
                        $sql .= $aso." ".$aux->nombre_tabla." ".$aux->prefijo." ";
                    }
                }
                
                #condiciones
                if($campos_condiciones = $this->input->post('campos_condiciones')){
                    $condiciones = $this->input->post('condiciones');
                    $valores_condiciones = $this->input->post('valores_condiciones');
                    
                    $where = " WHERE ";
                    $and = "";
                    foreach($campos_condiciones as $k=>$aux){
                        $campo = $this->objCampo->obtener_por_codigo($aux);
                        $condicion = $this->objTipoCampo->obtener_condicion(array("conc_codigo"=>$condiciones[$k]));
                        if($condicion->codigo == 8){
                            $cond = "like '%".$valores_condiciones[$k]."'";
                        }
                        elseif($condicion->codigo == 9){
                            $cond = "like '".$valores_condiciones[$k]."%'";
                        }
                        elseif($condicion->codigo == 10){
                            $cond = "like '%".$valores_condiciones[$k]."%'";
                        }
                        elseif($condicion->codigo == 12){
                            $cond = "IN (".$valores_condiciones[$k].")";
                        }
                        elseif($condicion->codigo == 13){
                            $cond = "NOT IN (".$valores_condiciones[$k].")";
                        }
                        elseif(!$condicion->acepta_valor){
                            $cond = $condicion->nombre;
                        }
                        else{
                            $cond = $condicion->nombre." '".$valores_condiciones[$k]."'";
                        }
                        $where .= $and.$campo->tabla->prefijo.".".$campo->nombre_campo." ".$cond;
                        $and = " and ";
                    }
                    $sql .= $where;
                }

                $datos['tab_sql'] = $sql;
                $datos['tab_vista'] = 1;
                
                #guarda la vista
                $this->objTabla->agregar($datos);

                #guarda los campos
                foreach($camposPrincipales as $aux){
                    $campo = $this->objCampo->obtener_por_codigo($aux);
                    unset($datos);
                    $datos['cam_codigo'] = $this->objCampo->nextId();
                    $datos['tic_codigo'] = $campo->tipo_campo->codigo;
                    $datos['tipr_codigo'] = $campo->tipo_relacion->codigo;
                    $datos['tab_codigo'] = $codigoVista;
                    $datos['cam_nombre'] = $campo->nombre;
                    $datos['cam_nombre_campo'] = $campo->nombre_campo;
                    $datos['cam_longitud'] = $campo->longitud;
                    $datos['cam_predeterminado'] = $campo->predeterminado;
                    $datos['cam_nulo'] = $campo->nulo;
                    
                    $this->objCampo->agregar($datos);
                }
                
                if($campos = $this->input->post('campos')){
                    foreach($campos as $aux){
                        $campo = $this->objCampo->obtener_por_codigo($aux);
                        unset($datos);
                        $datos['cam_codigo'] = $this->objCampo->nextId();
                        $datos['tic_codigo'] = $campo->tipo_campo->codigo;
                        $datos['tipr_codigo'] = $campo->tipo_relacion->codigo;
                        $datos['tab_codigo'] = $codigoVista;
                        $datos['cam_nombre'] = $campo->nombre;
                        $datos['cam_nombre_campo'] = $campo->nombre_campo;
                        $datos['cam_longitud'] = $campo->longitud;
                        $datos['cam_predeterminado'] = $campo->predeterminado;
                        $datos['cam_nulo'] = $campo->nulo;
                        
                        $this->objCampo->agregar($datos);
                    }
                }
                
                $this->objTabla->query($sql);
                
                echo json_encode(array("result"=>true,"codigo"=>$codigoVista));
			}
        }
        else{
            
            #title
            $this->layout->title('Crear Vista');

    		#js
    		$this->layout->js("/js/sistema/vistas/crear.js");
            
            #contenido
            $contenido['tablas'] = $this->objTabla->listar("tab_vista = 0");
            $contenido['tipos_asociacion'] = $this->objTipoAsociacion->listar();
            $contenido['condiciones_general'] = $this->objTipoCampo->listar_condiciones();
            
            #nav
            $this->layout->nav(array("Vistas"=>'vistas',"Crear"=>""));
            
            #view
            $this->layout->view('crear',$contenido);
        }
    }
    
    public function ver($codigo){
            
        #title
        $this->layout->title('Detalle Vista');

        #contenido
        if($contenido['vista'] = $this->objTabla->obtener_por_codigo($codigo));
        else show_error('Página no encontrada');
        
        #nav
        $this->layout->nav(array("Vistas"=>'vistas',"Detalle"=>""));
        
        #view
        $this->layout->view('ver',$contenido);
    }
    
    public function listar_campos_tabla(){
        
        $select = '';
        if($this->input->post('tabla')){
            $campo_relacion = ($this->input->post('campo_relacion'))?$this->input->post('campo_relacion'):'';
            if($campos = $this->objCampo->listar(array("tab_codigo"=>$this->input->post('tabla')))){
               foreach($campos as $aux){
                    $selected = '';
                    if($campo_relacion && $campo_relacion == $aux->nombre_campo)
                        $selected = 'selected';
                    $select .= '<option '.$selected.' value="'.$aux->codigo.'">'.$aux->nombre.'</option>';
               } 
            }
            else{
                $select = '<option value="">Tabla sin campos</option>';
            }
        }
        
        echo json_encode($select);
    }
    
    public function eliminar(){
        if($this->input->post()){
            $tabla = $this->objTabla->obtener_por_codigo($this->input->post('codigo'));
            $this->objTabla->actualizar(array("tab_visible"=>0),array("tab_codigo"=>$this->input->post("codigo")));
            
            #guarda la accion en el historial
            $comentario = "La vista <b>".$tabla->nombre."</b> ha sido eliminada";
            $historial['his_codigo'] = $this->objHistorial->nextId();
            $historial['his_comentario'] = $comentario;
            $historial['his_fecha'] = date('Y-m-d H:i:s');
            $historial['hia_codigo'] = 2;
            $historial['tab_codigo'] = $this->input->post("codigo");
            $this->objHistorial->agregar($historial);
            
            echo json_encode(array("result"=>true));
        }
    }
    
    public function listar_campos_condiciones(){
        if($this->input->post()){
            $html = "";
            $tabla = $this->input->post('tabla');
            $campos = explode(',',$this->input->post('campos'));
            if($tabla && $campos){
                $where = "cam.cam_codigo in (";
                $coma = "";
                foreach($campos as $aux){
                    $where .= $coma.$aux;
                    $coma = ",";
                }
                $where .= ") and cam.tab_codigo = '$tabla'";
                
                $campos_tabla = $this->objCampo->listar($where);
                
                $campos_condiciones = explode(',',$this->input->post('campos_condiciones'));
                $condiciones = explode(',',$this->input->post('condiciones'));
                $valores_condiciones = explode(',',$this->input->post('valores_condiciones'));
                
                $html .= '
                <div class="thumbnail table-responsive all-responsive">
                <table border="0" cellspacing="0" cellpadding="0" class="table tablesorter table-hover" style="margin-bottom:0;">
                	<thead>
                        <tr>
            				<th scope="col">Nombre</th>
            				<th scope="col">Condición</th>
            				<th scope="col" class="last">Valor</th>
            			</tr>
            		</thead>
                    <tbody>';
                foreach($campos_tabla as $aux){
                    
                    $condicion = $valor = '';
                    if($campos_condiciones){
                        foreach($campos_condiciones as $k=>$cam){
                            if($cam == $aux->codigo){
                                $condicion = $condiciones[$k];
                                $valor = $valores_condiciones[$k];
                            }
                        }
                    }
                    
    				$html .= '
                    <tr class="tr_condiciones">
    					<td>'.$aux->nombre.'</td>
                        <input type="hidden" class="campos_condiciones" value="'.$aux->codigo.'"/>
                        <td>
                            <select class="form-control condiciones">';
                                foreach($aux->tipo_campo->condiciones as $cond){
                                    $selected = "";
                                    if($condicion == $cond->codigo)
                                        $selected = "selected";
                                    $html .='<option '.$selected.' value="'.$cond->codigo.'">'.$cond->nombre.'</option>';
                                }
                            $html .='</select>
                        </td>
                        <td>
                            <input type="text" class="form-control valores_condiciones" value="'.$valor.'"/>
                        </td>
    				</tr>';
                }
                $html .= '
                    </tbody>
               	</table>
                </div>
                <div style="margin-top:10px;" class="text-right">
        			<button type="button" id="guardar-condiciones" class="btn btn-success">Guardar Condiciones</button>
        		</div>';
            }
            echo json_encode($html);
        }
    }
}