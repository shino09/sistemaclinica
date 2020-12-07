<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contenido extends CI_Controller {

	function __construct(){
		parent::__construct();
        
        #si no está logeado no puede estar acá
        if(!$this->session->userdata('usuario'))
            redirect('/');
            
        #models
        $this->load->model('contenido_model','objContenido');
        $this->load->model('tablas/tabla_model','objTabla');
        $this->load->model('tablas/campo_model','objCampo');
        $this->load->model('tablas/tipo_campo_model','objTipoCampo');
        $this->load->model('tablas/tipo_relacion_model','objTipoRelacion');
        
        $this->layout->current = 6;
        
	}
	
	public function index()
	{
        #title
		$this->layout->title('Tablas');
		
		$where = "tab_vista = 0";
        $and = " and ";
        $contenido['q'] = '';
		if($this->input->get('q')){
			$contenido['q_f'] = $busqueda = $this->input->get('q');
			$where = "(tab_nombre like '%$busqueda%' or tab_nombre_tabla like '%$busqueda%')";
            $and = ' and ';
		}
        
        $url = explode('?',$_SERVER['REQUEST_URI']);
        if(isset($url[1]))
            $url = '/?'.$url[1];
        else
            $url = '/';
		
		#paginacion
		$config['base_url'] = base_url().'/contenido/';
		$config['total_rows'] = count($this->objTabla->listar($where));
		$config['per_page'] = 15;
		$config['uri_segment'] = $segment = 2;
		$config['suffix'] = $url;
		$config['first_url'] = base_url().'/contenido'.$url;
		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment($segment))?$this->uri->segment($segment)-1:0;
		
		#nav
		$this->layout->nav(array("Tablas"=>'/'));
			
		#contenido
		$contenido['tablas'] = $this->objTabla->listar($where,$config["per_page"],$page*$config["per_page"]);
		$contenido['pagination'] = $this->pagination->create_links();
		
		$this->layout->view('index',$contenido);
           
    }
    
    public function registros($codigo){
        
        #title
        $this->layout->title('Registros');

		#js
		$this->layout->js("/js/sistema/contenido/registros.js");
        
        #contenido
        if($contenido['tabla'] = $tabla = $this->objTabla->obtener_por_codigo($codigo));
        else show_error('Ha ocurrido un error inesperado');
        
        $this->objContenido->tabla = $tabla;
        $where = $and = "";
        $url = "/";
        
        #paginacion
		$config['base_url'] = base_url().'/contenido/registros/'.$codigo."/";
		$config['total_rows'] = count($this->objContenido->listar($where));
		$config['per_page'] = 15;
		$config['uri_segment'] = $segment = 4;
		$config['suffix'] = $url;
		$config['first_url'] = base_url().'/contenido/registros/'.$codigo.$url;
		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment($segment))?$this->uri->segment($segment)-1:0;
		
		#nav
		$this->layout->nav(array("Registros"=>'/'));
			
		#contenido
		$contenido['registros'] = $this->objContenido->listar($where,$config["per_page"],$page*$config["per_page"]);
		$contenido['pagination'] = $this->pagination->create_links();

        #nav
        $this->layout->nav(array("Tablas"=>'contenido',"Registros"=>""));
        
        #view
        $this->layout->view('registros',$contenido);
        
    }
    
    public function insertar($codigo){
        
        if($tabla = $this->objTabla->obtener_por_codigo($codigo));
        else show_error('Ha ocurrido un error inesperado');
        
        $this->objContenido->tabla = $tabla;
        if($this->input->post()){
            
            #validaciones
			foreach($tabla->campos as $aux){
                if(!$aux->nulo && !$aux->predeterminado)
                    $this->form_validation->set_rules($aux->nombre_campo, $aux->nombre, 'required');
            }
			
			$this->form_validation->set_message('required', '* %s es obligatorio');
			$this->form_validation->set_error_delimiters('<div>','</div>');
			
			if(!$this->form_validation->run()){
				echo json_encode(array("result"=>false,"msg"=>validation_errors()));
				exit;
			}
			else{
                
                $where = $and = "";
                foreach($tabla->campos as $aux){
                    if($this->input->post($aux->nombre_campo))
                        $valor = $this->input->post($aux->nombre_campo);
                    else{
                        if($aux->predeterminado)
                            $valor = $aux->predeterminado;
                        elseif($aux->nulo)
                            $valor = null;
                    }
                    
                    $datos[$aux->nombre_campo] = $valor;
                    
                    if($aux->primaria){
                        $where .= $and.$aux->nombre_campo.' = '.$valor;
                        $and = ' and ';
                    }
                }
                
                #verifica la duplicidad de la clave primaria
                if($where){
                    if($this->objContenido->obtener($where,false)){
                        echo json_encode(array("result"=>false,"msg"=>"Duplicidad de claves primarias"));
                        exit;
                    }
                }
                
                $this->objContenido->agregar($datos);
                unset($datos);
                
                echo json_encode(array("result"=>true));
			}
        }
        else{
            
            #title
            $this->layout->title('Insertar');
            
            #datepicker
            $this->layout->css("/js/jquery/ui/1.10.4/smoothness/jquery-ui-1.10.4.custom.css");
            $this->layout->js("/js/jquery/ui/1.10.4/jquery.ui.datepicker-es.js");
            $this->layout->js("/js/jquery/ui/1.10.4/jquery-ui-1.10.4.custom.min.js");
        
    		#js
    		$this->layout->js("/js/sistema/contenido/insertar.js");
            
            foreach($tabla->campos as $k=>$aux){
                if($aux->campo_relacion){
                    $tabla->campos[$k]->relacion = $this->objContenido->listar_relacion($aux->tabla_relacion,$aux->campo_relacion);
                }
            }
            
            #contenido
            $contenido['tabla'] = $tabla;

            #nav
            $this->layout->nav(array("Tablas"=>'contenido',"Insertar"=>""));
            
            #view
            $this->layout->view('insertar',$contenido);
        }
    }
    
    public function editar($codigo_tabla,$codigo_registro){
        
        if($tabla = $this->objTabla->obtener_por_codigo($codigo_tabla));
        else show_error('Ha ocurrido un error inesperado');
        
        $this->objContenido->tabla = $tabla;
        if($this->input->post()){
            
            #validaciones
			foreach($tabla->campos as $aux){
                if(!$aux->nulo && !$aux->predeterminado)
                    $this->form_validation->set_rules($aux->nombre_campo, $aux->nombre, 'required');
            }
			
			$this->form_validation->set_message('required', '* %s es obligatorio');
			$this->form_validation->set_error_delimiters('<div>','</div>');
			
			if(!$this->form_validation->run()){
				echo json_encode(array("result"=>false,"msg"=>validation_errors()));
				exit;
			}
			else{
                
                $where = $whereP = $and = "";
                $k = $totalPrimarias = 0;
                $primarias = explode('-',$codigo_registro);
                foreach($tabla->campos as $aux){
                    if($this->input->post($aux->nombre_campo))
                        $valor = $this->input->post($aux->nombre_campo);
                    else{
                        if($aux->predeterminado)
                            $valor = $aux->predeterminado;
                        elseif($aux->nulo)
                            $valor = null;
                    }
                    
                    $datos[$aux->nombre_campo] = $valor;
                    
                    if($aux->primaria){
                        $where .= $and.$aux->nombre_campo.' = '.$primarias[$k];
                        
                        #si al menos una clave primaria cambia se verifica la duplicidad
                        if($valor != $primarias[$k])
                            $totalPrimarias++;
                        $whereP .= $and.$aux->nombre_campo.' = '.$valor;
                        
                        $k++; $and = " and ";
                    }
                }
                
                #verifica la duplicidad de la clave primaria
                if($whereP && $totalPrimarias > 0){
                    if($this->objContenido->obtener($whereP,false)){
                        echo json_encode(array("result"=>false,"msg"=>"Duplicidad de claves primarias"));
                        exit;
                    }
                }
                
                $this->objContenido->actualizar($datos,$where);
                unset($datos);
                
                echo json_encode(array("result"=>true));
			}
        }
        else{
            
            #title
            $this->layout->title('Editar');
            
            #datepicker
            $this->layout->css("/js/jquery/ui/1.10.4/smoothness/jquery-ui-1.10.4.custom.css");
            $this->layout->js("/js/jquery/ui/1.10.4/jquery.ui.datepicker-es.js");
            $this->layout->js("/js/jquery/ui/1.10.4/jquery-ui-1.10.4.custom.min.js");
        
    		#js
    		$this->layout->js("/js/sistema/contenido/editar.js");
            
            $primarias = explode('-',$codigo_registro);
            $k = 0; $where = $and = "";
            foreach($tabla->campos as $aux){
                if($aux->primaria){
                    $where .= $and.$aux->nombre_campo.' = '.$primarias[$k];
                    $k++; $and = " and ";
                }
            }

            foreach($tabla->campos as $k=>$aux){
                if($aux->campo_relacion){
                    $tabla->campos[$k]->relacion = $this->objContenido->listar_relacion($aux->tabla_relacion,$aux->campo_relacion);
                }
            }
            
            #contenido
            $contenido['tabla'] = $tabla;
            $contenido['registro'] = $this->objContenido->obtener($where);
            
            #nav
            $this->layout->nav(array("Tablas"=>'contenido',"Editar"=>""));
            
            #view
            $this->layout->view('editar',$contenido);
        }
    }
    
    public function eliminar(){
        
        if($this->input->post()){
            
            try{
                $codigo_tabla = $this->input->post('codigo_tabla');
                $codigo_registro = $this->input->post('codigo_registro');
                
                $tabla = $this->objTabla->obtener_por_codigo($codigo_tabla);
                
                $primarias = explode('-',$codigo_registro);
                $k = 0; $where = $and = "";
                foreach($tabla->campos as $aux){
                    if($aux->primaria){
                        $where .= $and.$aux->nombre_campo.' = '.$primarias[$k];
                        $k++; $and = " and ";
                    }
                }
                if($where){
                    $this->objContenido->tabla = $tabla;
                    $this->objContenido->actualizar(array($tabla->prefijo."_visible"=>0),$where);
                }
                else
                    throw new Exception();
                    
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
    
}