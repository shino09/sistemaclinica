<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Historial extends CI_Controller {

	function __construct(){
		parent::__construct();
        
        #si no está logeado no puede estar acá
        if(!$this->session->userdata('usuario'))
            redirect('/');
            
        #models
        $this->load->model('historial_model','objHistorial');
        $this->load->model('tablas/tabla_model','objTabla');
        $this->load->model('tablas/campo_model','objCampo');
        $this->load->model('usuarios/usuario_model','objUsuario');
        
        $this->layout->current = 4;
        
        #manipulacion db
        $this->load->dbforge();
    
	}
	
	public function index()
	{
        #title
		$this->layout->title('Historial');
		
		#js
		$this->layout->js("/js/sistema/historial/index.js");
        
        #datepicker
        $this->layout->css("/js/jquery/ui/1.10.4/smoothness/jquery-ui-1.10.4.custom.css");
		$this->layout->js("/js/jquery/ui/1.10.4/jquery.ui.datepicker-es.js");
		$this->layout->js("/js/jquery/ui/1.10.4/jquery-ui-1.10.4.custom.min.js");
		
		$where = $and = $contenido['q_f'] = $contenido['desde_q'] = $contenido['hasta_q'] = '';
		$url = '/';
		if($this->input->get('q')){
			$contenido['q_f'] = $busqueda = $this->input->get('q');
			$where = "(his_nombre_tabla_a like '%$busqueda%' or his_nombre_tabla_n like '%$busqueda%' or his_comentario like '%$busqueda%' or hia_nombre like '%$busqueda%')";
            $and = ' and ';
		}
        
        if($this->input->get('desde')){
            $contenido['desde_q'] = $desde = $this->input->get('desde');
            $desde = formatearFecha($desde).' 00:00:00';
            $where .= $and."his_fecha >= '$desde'";
            $and = " and ";
        }
        
        if($this->input->get('hasta')){
            $contenido['hasta_q'] = $hasta = $this->input->get('hasta');
            $hasta = formatearFecha($hasta).' 23:59:59';
            $where .= $and."his_fecha <= '$hasta'";
            $and = " and ";
        }
        
        $url = explode('?',$_SERVER['REQUEST_URI']);
        if(isset($url[1]))
            $url = '/?'.$url[1];
        else
            $url = '/';
		
		#paginacion
		$config['base_url'] = base_url().'/historial/';
		$config['total_rows'] = count($this->objHistorial->listar($where));
		$config['per_page'] = 15;
		$config['uri_segment'] = $segment = 2;
		$config['suffix'] = $url;
		$config['first_url'] = base_url().'/historial'.$url;
		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment($segment))?$this->uri->segment($segment)-1:0;
		
		#nav
		$this->layout->nav(array("Historial"=>'/'));
			
		#contenido
		$contenido['historial'] = $this->objHistorial->listar($where,$config["per_page"],$page*$config["per_page"]);
		$contenido['pagination'] = $this->pagination->create_links();
		
		$this->layout->view('index',$contenido);
           
    }
    
    public function deshacer(){

        if($this->input->post()){

            $historial = $this->objHistorial->obtener_por_codigo($this->input->post('codigo'));

            #tabla modificada
            if($historial->accion->codigo == 1){
                
                #actualiza el nombre de la tabla
                $tablaAnterior = slug($historial->nombre_tabla_a,'_');
                $tablaNueva = slug($historial->nombre_tabla_n,'_');
                $this->dbforge->rename_table($tablaNueva, $tablaAnterior);
                
                $datos['tab_nombre'] = $historial->nombre_tabla_a;
                $datos['tab_nombre_tabla'] = $tablaAnterior;
                $this->objTabla->actualizar($datos,array("tab_codigo"=>$historial->tabla->codigo));
                
            }
            #tabla eliminada
            elseif($historial->accion->codigo == 2){
                
                #modifica el estado visible del campo
                $this->objTabla->actualizar(array("tab_visible"=>1),array("tab_codigo"=>$historial->tabla->codigo));
                
            }
            #campo eliminado
            elseif($historial->accion->codigo == 3){
                
                #modifica el estado visible del campo
                $this->objCampo->actualizar(array("cam_visible"=>1),array("cam_codigo"=>$historial->campo_a->codigo));
                
            }
            #campo modificado
            elseif($historial->accion->codigo == 4){
                
                while(true){
                    
                    if(!$this->objCampo->obtener_asociado($historial->campo_n->codigo))
                        break;
                    
                    $this->objCampo->actualizar(array("cam_visible"=>0),array("cam_asociado"=>$historial->campo_n->codigo));
                }
                
                $this->objCampo->actualizar(array("cam_visible"=>0),array("cam_codigo"=>$historial->campo_n->codigo));
                $this->objCampo->actualizar(array("cam_visible"=>1),array("cam_codigo"=>$historial->campo_a->codigo));
            }
            #usuario eliminado
            elseif($historial->accion->codigo == 5){
                
                $this->objUsuario->actualizar(array("usua_visible"=>1),array("usua_codigo"=>$historial->usuario->codigo));
            }
            
            #marca la accion como realizada
            $this->objHistorial->actualizar(array("his_deshecha"=>1),array("his_codigo"=>$historial->codigo));
            
            echo json_encode(array("result"=>true));
        }
    }
    
    public function detalle_campo(){
        if($this->input->post()){
            $campo = $this->objCampo->obtener_por_codigo($this->input->post('codigo'));
            $titulo = 'Campo: <b>'.$campo->nombre.'</b> ('.$campo->tabla->nombre.')';
            
            $relacion = "";
            if($campo->tabla_relacion) $relacion = $campo->tabla_relacion->nombre;
            $primaria = ($campo->primaria)?"Si":"No";
            $nulo = ($campo->nulo)?"Si":"No";
            
            $contenido = '
            <div class="thumbnail table-responsive all-responsive">
                <table border="0" cellspacing="0" cellpadding="0" class="table tablesorter table-hover" style="margin-bottom:0;">
		          <tr>
                    <td style="border-top:none;">Nombre</td>
                    <td style="border-top:none;">'.$campo->nombre_campo.'</td>
                  </tr>
                  <tr>
                    <td>Tipo campo</td>
                    <td>'.$campo->tipo_campo->nombre.' ('.$campo->longitud.')</td>
                  </tr>
                  <tr>
                    <td>Clave primaria</td>
                    <td>'.$primaria.'</td>
                  </tr>
                  <tr>
                    <td>Nulo</td>
                    <td>'.$nulo.'</td>
                  </tr>
                  <tr>
                    <td>Valor predeterminado</td>
                    <td>'.$campo->predeterminado.'</td>
                  </tr>
                  <tr>
                    <td>Tabla relación</td>
                    <td>'.$relacion.'</td>
                  </tr>
	           </table>
            </div>';
            
            echo json_encode(array("titulo"=>$titulo,"contenido"=>$contenido));
        }
    }
}