<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout {
    private $obj;
    private $layout_view;
    private $title = '';
    private $titleDefault = 'Pyme Base Aeurus';
    private $css_list = array(), $js_list = array();
	private $metas = '';
	private $navegacion = array();
	public $current = '';

    function Layout() {
	
		#obj
        $this->obj =& get_instance();
        $this->layout_view = "layout/default.php";
		
		#css
		$this->css('/css/hoja-estilos.css');
		
		#js
		//$this->js('/js/jquery/1.9.1/jquery-1.9.1.min.js');
        $this->js('/js/jquery/1.12.4/jquery-1.12.4.min.js');
        $this->js('/js/jquery/1.12.4/jquery-1.12.4.js');

        

        ##calendario
        $this->js('/js/jquery/jquery-ui-1.12.1/jquery-ui.js');

        $this->css('/js/jquery/jquery-ui-themes-1.12.1/jquery-ui.css');

        $this->js('/js/jquery/1.12.4/jquery-1.12.4.js');


		
		
		#Menu responsive
		$this->css('/js/jquery/responsive-nav/responsive-nav.css');
		$this->js('/js/jquery/responsive-nav/responsive-nav.js');
		
		#datepicker
		$this->css('/js/jquery/ui/1.10.4/smoothness/jquery-ui-1.10.4.custom.min.css');
		$this->js('/js/jquery/ui/1.10.4/jquery-ui-1.10.4.custom.min.js');
		$this->js('/js/jquery/ui/1.10.4/jquery.ui.datepicker-es.js');
		
		#notificaciones
		#$this->js('/js/jquery/noty/packaged/jquery.noty.packaged.js');
		
		#validationEngine
        $this->css('/js/jquery/validation-engine/css/validationEngine.jquery.css');
        $this->js('/js/jquery/validation-engine/js/jquery.validationEngine.js');
        $this->js('/js/jquery/validation-engine/js/languages/jquery.validationEngine-es.js');

        #layout
        if(isset($this->obj->layout_view))
			$this->layout_view = $this->obj->layout_view;
		
    }

    function view($view, $data = null, $return = false) {
        
		#render template
        $data['content_for_layout'] = $this->obj->load->view($view, $data, true);

             #notificaciones
        $data['notificaciones'] = "";
        /*if($usuario = $this->obj->session->userdata('usuario_sitio')){
            $this->obj->ws->joinInner(22,"not_usuario_perfil = usu2_codigo"); #usuariosperfiles
            $this->obj->ws->joinInner(21,"usu2_usuarios = usu_codigo"); #usuarios
            $this->obj->ws->joinInner(58,"usu2_codigo = eup_codigo"); #empresa_usuario_perfil
            $this->obj->ws->order("not_fecha DESC");
            $data['notificaciones'] = $this->obj->ws->listar(40,"not_visto IS NULL and usu_codigo = {$usuario->codigo}");
        }*/

        $data['notificaciones'] = $this->obj->ws->listar(40,"not_visto IS NULL");

		
        #template
        $this->block_replace = true;
        $output = $this->obj->load->view($this->layout_view, $data, $return);
		
        return $output;
    }

    /**
     * Agregar title a la pagina actual
     *
     * @param $title
     */
    function title($title) {
        $this->title = $title.' - '.$this->titleDefault;
    }
	
	function getTitle(){
        return $this->title;
	}

    /**
     * Agregar Javascript a la pagina actual
     * @param $item
     */
    function js($item){
        $this->js_list[] = $item;
    }
	
	function getJs(){
		$js = '';
		if($this->js_list){
			foreach ($this->js_list as $aux){
				$js .= '<script type="text/javascript" src="'.$aux.'"></script>
		';
			}
		}
		return $js;
    }

    /**
     * Agregar CSS a la pagina actual
     * @param $item
     */
    function css($item){
        $this->css_list[] = $item;
    }
	
	function getCss(){
		$css = '';
		if($this->css_list){
			foreach ($this->css_list as $aux){
				$css .= '<link rel="stylesheet" type="text/css"  href="'.$aux.'" />
		';
			}
		}
		return $css;
    }
	
	/**
     * Agregar Metas a la pagina actual
     * @param $name, $content
     */
    function setMeta($name,$content) {
        $meta->name = $name;
        $meta->content = $content;
		$this->metas[] = $meta;
    }
	
	function headMeta() {
		$metas = '';
		if($this->metas){
			foreach($this->metas as $aux){
				$metas .= '<meta name="'.$aux->name.'" content="'.$aux->content.'" />
		';
			}
		}
        return $metas;
    }
	
	/**
     * Agregar Navegacion a la pagina actual
     * @param $nav
     */
    function nav($nav) {
		$this->navegacion = $nav;
    }
	
	function getNav() {
		$html = '';
		if($this->navegacion){
			$html = '<nav id="navigation">Usted está en: <a href="/">Inicio</a>';
			$i = 1;
			$ruta_master = '/';
			
			$html .= ' &gt; ';
			foreach($this->navegacion as $nombre=>$ruta)
			{
				$ruta_master = "/".$ruta."/";
				$html .= ($i==count($this->navegacion))? '<span>'.$nombre.'</span>':'<a href="'.$ruta_master.'">'.$nombre.'</a> &gt; ';
				$i++;
			}
			
			 $html .='</nav>';
		}
		return $html;
	}
	



    public function obtener_permisos($codigo_modulo){

        #si la sesion no esta activa
        if(!$this->obj->session->userdata('usuario_sa')){
            return false;
        }

        #obtiene el usuario desde la sesion
        $usuario = $this->obj->session->userdata('usuario_sa');
        
        #lista todos los permisos del modulo actual
        $modulos_creados = array();

        $this->obj->ws->joinInner(25,"per2_modulo = mod_codigo"); #modulo
        $permisos_todos = $this->obj->ws->listar(24,"per2_estado = 1 and per2_modulo = $codigo_modulo"); #permisos

        $obj = new stdClass();
        foreach($permisos_todos as $aux){

            /*if(!in_array($aux->modulo->codigo,$modulos_creados)){
                $obj->{slug($aux->modulo->nombre,'_')} = new stdClass();
                $modulos_creados[] = $aux->modulo->codigo;
            }*/

            $obj->{slug($aux->nombre,'_')} = false;
        }


        #lista los permisos del perfil y modulo actual
        $this->obj->ws->joinInner(24,"perf_permiso = per2_codigo"); #permisos
        $this->obj->ws->joinInner(25,"per2_modulo = mod_codigo"); #modulo
        $permisos_perfil = $this->obj->ws->listar(26,"perf_perfil = {$usuario->perfil} and per2_modulo = $codigo_modulo"); #perfil_permisos

        $permisos_modulo = false;
        $permisos = $modulos_creados = array();
        if($permisos_perfil){
            foreach($permisos_perfil as $aux){

                $permisos_modulo = true;
                $obj->{slug($aux->permisos->nombre,'_')} = true;
            }
        }

        if(!$permisos_modulo)
            return false;

        return $obj;
    }
    
    public function obtener_permisos_menu(){
        
        #permisos del menu
        $menu = new stdClass();
        $menu->configuracion = false;
        $menu->mantenedores = false;
        
        #permisos configuracion
        $permisos = $this->obtener_permisos(4);
        if($permisos && $permisos->ver){
            $menu->configuracion = true;
        }
        
        #permisos mantenedores
        $permisos = $this->obtener_permisos(5);
        if($permisos && $permisos->ver){
            $menu->mantenedores = true;
        }
        
        return $menu;
    }
    
    #revisa si es que tiene una solicitud de perfil aprobada
    public function revisar_perfil(){
        
        if($usuario = $this->obj->session->userdata('usuario_sa')){
            
            #obtiene el perfil aprobado si es que no ha caducado
            $ahora = date('Y-m-d H:i:s');
            $usuario_aux = $this->obj->ws->obtener(28,"soli_usuario = {$usuario->codigo} and soli_estado = 2 and soli_fecha_caducidad > '$ahora'");
            
            #si no tiene perfil aprobado, o la aprobacion caduco, se deja el perfil original
            if(!$usuario_aux)
                $usuario_aux = $this->obj->ws->obtener(21,"usu_codigo = {$usuario->codigo}");
            
            #actualiza el perfil solo si es distinto al que tiene actualmente
            if($usuario_aux->perfil != $usuario->perfil){
                $usuario->perfil = $usuario_aux->perfil;
                
                #setea nuevamente la sesion con el perfil actualizado
                $this->obj->session->set_userdata('usuario_sa',$usuario);
            }
        }
    }

}