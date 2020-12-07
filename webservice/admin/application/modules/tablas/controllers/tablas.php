<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tablas extends CI_Controller {

	function __construct(){
		parent::__construct();

        #si no está logeado no puede estar acá
        if(!$this->session->userdata('usuario'))
            redirect('/');

        #models
        $this->load->model('tabla_model','objTabla');
        $this->load->model('campo_model','objCampo');
        $this->load->model('tipo_campo_model','objTipoCampo');
        $this->load->model('prefijo_model','objPrefijo');
        $this->load->model('tipo_relacion_model','objTipoRelacion');
        $this->load->model('historial/historial_model','objHistorial');

        $this->layout->current = 1;

        #manipulacion db
        $this->load->dbforge();

	}

	public function index()
	{
        #title
		$this->layout->title('Tablas');

		#js
		$this->layout->js("/js/sistema/tablas/index.js");

		$where = "tab_vista = 0";
        $and = " and ";
        $contenido['q'] = '';
		if($this->input->get('q')){
			$contenido['q_f'] = $busqueda = $this->input->get('q');
			$where .= $and."(tab_nombre like '%$busqueda%' or tab_nombre_tabla like '%$busqueda%')";
            $and = ' and ';
		}

        $url = explode('?',$_SERVER['REQUEST_URI']);
        if(isset($url[1]))
            $url = '/?'.$url[1];
        else
            $url = '/';

		#paginacion
		$config['base_url'] = base_url().'/tablas/';
		$config['total_rows'] = count($this->objTabla->listar($where));
		$config['per_page'] = 15;
		$config['uri_segment'] = $segment = 2;
		$config['suffix'] = $url;
		$config['first_url'] = base_url().'/tablas'.$url;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment($segment))?$this->uri->segment($segment)-1:0;

		#nav
		$this->layout->nav(array("Tablas"=>'/'));

		#contenido
		$contenido['tablas'] = $this->objTabla->listar($where,$config["per_page"],$page*$config["per_page"]);
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
                if($this->objTabla->obtener(array("tab_nombre"=>trim($this->input->post('nombre'))),true)){
                    echo json_encode(array("result"=>false,"msg"=>"El nombre de la tabla ya existe"));
                    exit;
                }

                #verifica que el prefijo no exista
                if($this->objPrefijo->obtener(array("pref_nombre"=>trim($this->input->post('prefijo'))))){
                    echo json_encode(array("result"=>false,"msg"=>"El prefijo ingresado ya existe. Puede seleccionar la opción Generar para buscar alguno disponible"));
                    exit;
                }

                $codigo = $datos['tab_codigo'] = $this->objTabla->nextId();
                $datos['tab_nombre'] = trim($this->input->post('nombre'));
                $tabla = $datos['tab_nombre_tabla'] = slug(trim($this->input->post('nombre')),'_');
                $prefijo = $datos['tab_prefijo'] = slug(trim($this->input->post('prefijo')),'_');
                $datos['tab_comentario'] = $this->input->post('comentario');

                $this->objTabla->agregar($datos);
                unset($datos);

                #guarda el prefijo
                $datos['pref_codigo'] = $this->objPrefijo->nextId();
                $datos['pref_nombre'] = $prefijo;
                $this->objPrefijo->agregar($datos);


                #crea la tabla en la db

                #visible
                $campo = array($prefijo.'_visible'=>array('type'=>'TINYINT','constraint'=>'1','default' =>1));
				$this->dbforge->add_field($campo);

                #crea la tabla
                $this->dbforge->create_table($tabla);

                echo json_encode(array("result"=>true,"codigo"=>$codigo));
			}
        }
        else{

            #title
            $this->layout->title('Crear Tabla');

    		#js
    		$this->layout->js("/js/sistema/tablas/crear.js");

            #nav
            $this->layout->nav(array("Tablas"=>'tablas',"Crear"=>""));

            #view
            $this->layout->view('crear');
        }
    }

    public function editar($codigo){

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

                $tablaAnterior = $this->objTabla->obtener_por_codigo($codigo);

                $datos['tab_nombre'] = trim($this->input->post('nombre'));
                $tabla = $datos['tab_nombre_tabla'] = slug(trim($this->input->post('nombre')),'_');
                $datos['tab_prefijo'] = slug(trim($this->input->post('prefijo')),'_');
                $datos['tab_comentario'] = $this->input->post('comentario');

                $this->objTabla->actualizar($datos,array("tab_codigo"=>$codigo));

                #actualiza el nombre de la tabla
                $this->dbforge->rename_table($tablaAnterior->nombre_tabla, $tabla);

                #guarda la accion en el historia
                $comentario = "La tabla <b>".$tablaAnterior->nombre."</b> ha pasado a llamarse <b>".trim($this->input->post('nombre')).'</b>';
                $historial['his_codigo'] = $this->objHistorial->nextId();
                $historial['his_nombre_tabla_a'] = $tablaAnterior->nombre;
                $historial['his_nombre_tabla_n'] = trim($this->input->post('nombre'));
                $historial['his_comentario'] = $comentario;
                $historial['his_fecha'] = date('Y-m-d H:i:s');
                $historial['hia_codigo'] = 1;
                $historial['tab_codigo'] = $codigo;
                $this->objHistorial->agregar($historial);

                echo json_encode(array("result"=>true,"codigo"=>$codigo));
			}
        }
        else{

            #title
            $this->layout->title('Editar Tabla');

    		#js
    		$this->layout->js("/js/sistema/tablas/editar.js");

            #contenido
            if($contenido['tabla'] = $tabla = $this->objTabla->obtener_por_codigo($codigo));
            else show_error('Página no encontrada');

            $contenido['tipos_campo'] = $this->objTipoCampo->listar();
            $contenido['tablas'] = $this->objTabla->listar();
            $contenido['tipos_relacion'] = $this->objTipoRelacion->listar();

            #nav
            $this->layout->nav(array("Tablas"=>'tablas',"Editar"=>""));

            #view
            $this->layout->view('editar',$contenido);
        }
    }

    public function crear_prefijo(){
        if($this->input->post()){
            $tabla = $this->input->post('tabla');
            $tope = (strlen($tabla) <= 4)?strlen($tabla):5;
            for($i=3; $i < $tope;$i++){
                $prefijo = substr(slug($tabla,'_'),0,$i);
                if(!$this->objPrefijo->obtener(array("pref_nombre"=>$prefijo))){
                    echo json_encode(array("result"=>true,"prefijo"=>$prefijo));
                    exit;
                }
            }

            $j=2; $exista = true;
            while($exista){
                $prefijo = substr(slug($tabla,'_'),0,3).$j;
                if(!$this->objPrefijo->obtener(array("pref_nombre"=>$prefijo))){
                    echo json_encode(array("result"=>true,"prefijo"=>$prefijo));
                    $exista = false;
                    exit;
                }
                $j++;
            }

            echo json_encode(array("result"=>false,"msg"=>"Ha ocurrido un error inesperado. Por favor, inténtelo nuevamente."));

        }
        else{
            show_error('Página no encontrada');
        }
    }

    public function verificar_prefijo(){
        if($this->input->post()){
            $prefijo = $this->input->post('prefijo');
            if(!$this->objPrefijo->obtener(array("pref_nombre"=>$prefijo))){
                echo json_encode(array("result"=>true));
                exit;
            }
            echo json_encode(array("result"=>false,"msg"=>"El prefijo ingresado ya existe. Puede seleccionar la opción Prefijo aleatorio para buscar alguno disponible"));
            exit;
        }
        else{
            show_error('Página no encontrada');
        }
    }

    public function eliminar(){

        if($this->input->post()){

            try{
                $tabla = $this->objTabla->obtener_por_codigo($this->input->post('codigo'));
                $this->objTabla->actualizar(array("tab_visible"=>0),array("tab_codigo"=>$this->input->post("codigo")));

                #guarda la accion en el historial
                $comentario = "La tabla <b>".$tabla->nombre."</b> ha sido eliminada";
                $historial['his_codigo'] = $this->objHistorial->nextId();
                $historial['his_comentario'] = $comentario;
                $historial['his_fecha'] = date('Y-m-d H:i:s');
                $historial['hia_codigo'] = 2;
                $historial['tab_codigo'] = $this->input->post("codigo");
                $this->objHistorial->agregar($historial);

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

    #CAMPOS
    public function crear_campo(){

        if($this->input->post()){
            #validaciones
			$this->form_validation->set_rules('nombre_campo', 'Nombre', 'required');

            if($this->input->post('campo_relacionado')){
                $this->form_validation->set_rules('relacion', 'Tabla Relacionada', 'required');
                $this->form_validation->set_rules('campo_relacion', 'Campo', 'required');
                $this->form_validation->set_rules('tipo_relacion', 'Tipo Relación', 'required');
            }
            else{
                $this->form_validation->set_rules('tipo_campo', 'Tipo Campo', 'required');
            }

			$this->form_validation->set_message('required', '* %s es obligatorio');
			$this->form_validation->set_error_delimiters('<div>','</div>');

			if(!$this->form_validation->run()){
				echo json_encode(array("result"=>false,"msg"=>validation_errors()));
				exit;
			}
			else{

                $tabla = $this->objTabla->obtener_por_codigo($this->input->post('tabla'));
                $tipoCampo = $this->objTipoCampo->obtener_por_codigo($this->input->post('tipo_campo'));
                $nombreCampo = $datos['cam_nombre_campo'] = $tabla->prefijo.'_'.slug($this->input->post('nombre_campo'),'_');

                $agregarNuevo = false;
                #si viene el codigo del campo se edita
                if($this->input->post('codigo_campo')){

                    $codigo = $this->input->post('codigo_campo');

                    #verifica que el campo no exista para la tabla
                    if($this->objCampo->obtener("cam.cam_nombre_campo = '$nombreCampo' and tab.tab_codigo = '$tabla->codigo' and cam.cam_codigo <> $codigo")){
                        echo json_encode(array("El campo ".$this->input->post('nombre_campo')." ya existe"));
                        exit;
                    }

                    $campoAnterior = $this->objCampo->obtener_por_codigo($codigo);
                    $comentario = '';

                    if($this->input->post('campo_relacionado')){
                        $tablaRelacion = $this->objTabla->obtener_por_codigo($this->input->post('relacion'));
                        $campoRelacion = $this->objCampo->obtener_por_campo($this->input->post('campo_relacion'));

                        $datos['tipr_codigo'] = $this->input->post('tipo_relacion');
                        $datos['cam_tabla_relacion'] = $tablaRelacion->codigo;
                        $datos['cam_campo_relacion'] = $campoRelacion->codigo;

                        if($this->input->post('longitud'))
                            $longitud = $this->input->post('longitud');
                        else
                            $longitud = $tipoCampo->longitud;

                        $nulo = false;
                        if($this->input->post('nulo'))
                            $nulo = true;

                        #si el campo cambia de nombre, de tipo o de longitud
                        #se crea uno nuevo y se deja inactivo el anterior
                        if($campoAnterior->nombre_campo != $nombreCampo)
                            $agregarNuevo = true;
                        elseif($campoAnterior->longitud != $longitud)
                            $agregarNuevo = true;
                        elseif($campoAnterior->tipo_campo->codigo != $tipoCampo->codigo)
                            $agregarNuevo = true;

                        if($agregarNuevo){
                            #agrega nuevo campo
                            #se asocia el campo anterior para saber a cual regresar en caso de volver en el historial
                            $datos['cam_asociado'] = $campoAnterior->codigo;

                            #se le agrega un correlativo al campo nuevo en la tabla, para no repetir el nombre
                            $next = 1;
                            $campoNext = $campoAnterior;
                            while($campoNext->asociado){
                                $campoNext = $this->objCampo->obtener_por_codigo($campoNext->asociado);
                                $next++;
                            }
                            $nombreCampo = $datos['cam_nombre_campo'] = $nombreCampo.'_'.$next;

                            $campo = array($nombreCampo=>array('type'=>$tipoCampo->tipo,'null'=>$nulo));

                            #si tiene longitud se agrega
                            if($longitud)
                                $campo[$nombreCampo]['constraint'] = $longitud;

                            $this->dbforge->add_column($tabla->nombre_tabla, $campo);

                            #el campo anterior queda invisible
                            $this->objCampo->actualizar(array("cam_visible"=>0),array("cam_codigo"=>$campoAnterior->codigo));

                            #el campo anterior queda como null
                            $campoNull = array($campoAnterior->nombre_campo => array('name' => $campoAnterior->nombre_campo,'type' => $campoAnterior->tipo_campo->tipo,'constraint'=>$campoAnterior->longitud,"null"=>true));
                            $this->dbforge->modify_column($tabla->nombre_tabla, $campoNull);

                        }
                        else{
                            #actualiza el campo
                            $campo = array($campoAnterior->nombre_campo => array('name' => $nombreCampo,'type' => $tipoCampo->tipo,'constraint'=>$longitud,"null"=>$nulo));

                            #si tiene longitud se agrega
                            if($longitud)
                                $campo[$campoAnterior->nombre_campo]['constraint'] = $longitud;

                            $this->dbforge->modify_column($tabla->nombre_tabla, $campo);
                        }

                        $agregaForanea = false;
                        #si antes era relacion, se elimina la foranea
                        if($campoAnterior->tabla_relacion != ""){
                            if($campoAnterior->campo_relacion->nombre_campo != $campoRelacion->nombre_campo){
                                #eliminar foranea
                                $foranea = "ALTER TABLE ".$tabla->nombre_tabla." DROP INDEX ".$campoAnterior->nombre_campo.";";
                                $this->objTabla->query($foranea);

                                $agregaForanea = true;
                            }
                        }

                        if($agregaForanea){
                            $foranea = "ALTER TABLE ".$tabla->nombre_tabla." ADD FOREIGN KEY (".$nombreCampo.") REFERENCES ".$tablaRelacion->nombre_tabla."(".$campoRelacion->nombre_campo.");";
                            $this->objTabla->query($foranea);
                        }

						#si antes era primaria y ahora no, se elimina
                        if($campoAnterior->primaria){
                            if(!$this->input->post('clave_primaria')){

                                $coma = $primarias = $dropPrimary = '';
                                if($tabla->campos){
                                    foreach($tabla->campos as $cam){
                                        if($cam->codigo != $campoAnterior->codigo){
                                            if($cam->primaria){
                                                $primarias .= $coma.$cam->nombre_campo;
                                                $coma = ",";
                                                $dropPrimary = "DROP PRIMARY KEY,";
                                            }
                                        }
                                    }
                                }

                                #clave primaria
                                $primaria = "ALTER TABLE ".$tabla->nombre_tabla." ".$dropPrimary." ADD PRIMARY KEY(".$primarias.");";
                				$this->objTabla->query($primaria);
                            }
                        }
                    }
                    else{
                        #antes era un campo relacionado
                        if($campoAnterior->tabla_relacion != ""){
                            $datos['tipr_codigo'] = null;
                            $datos['cam_tabla_intermedia'] = null;
                            $datos['cam_tabla_relacion'] = null;
                            $datos['cam_campo_relacion'] = null;

                            #eliminar foranea
                            $foranea = "ALTER TABLE ".$tabla->nombre_tabla." DROP INDEX ".$campoAnterior->nombre_campo.";";
                            $this->objTabla->query($foranea);
                        }

                        $nulo = false;
                        if($this->input->post('nulo'))
                            $nulo = true;

                        if($this->input->post('longitud'))
                            $longitud = $this->input->post('longitud');
                        else
                            $longitud = $tipoCampo->longitud;

                        #si el campo cambia de nombre, de tipo o de longitud
                        #se crea uno nuevo y se deja inactivo el anterior
                        if($campoAnterior->nombre_campo != $nombreCampo){
                            $agregarNuevo = true;
                            $comentario = "ha pasado a llamarse <b>".$this->input->post('nombre_campo')."</b><br />";
                        }

                        if($campoAnterior->longitud != $longitud){
                            $agregarNuevo = true;
                            $comentario = "ha cambiado su longitud de <b>".$campoAnterior->longitud."</b> a <b>".$longitud."</b><br />";
                        }

                        if($campoAnterior->tipo_campo->codigo != $tipoCampo->codigo){
                            $agregarNuevo = true;
                            $comentario = "ha pasado de ser <b>".$campoAnterior->tipo_campo->nombre.' ('.$campoAnterior->longitud.")</b> a <b>".$tipoCampo->nombre.' ('.$longitud.")</b><br />";
                        }

                        if($agregarNuevo){
                            #agrega nuevo campo
                            #se asocia el campo anterior para saber a cual regresar en caso de volver en el historial
                            $datos['cam_asociado'] = $campoAnterior->codigo;

                            #se le agrega un correlativo al campo nuevo en la tabla, para no repetir el nombre
                            $next = 1;
                            $campoNext = $campoAnterior;
                            while($campoNext->asociado){
                                $campoNext = $this->objCampo->obtener_por_codigo($campoNext->asociado);
                                $next++;
                            }
                            $nombreCampo = $datos['cam_nombre_campo'] = $nombreCampo.'_'.$next;

                            $campo = array($nombreCampo=>array('type'=>$tipoCampo->tipo,'null'=>$nulo));

                            #si tiene longitud se agrega
                            if($longitud)
                                $campo[$nombreCampo]['constraint'] = $longitud;

                            $this->dbforge->add_column($tabla->nombre_tabla, $campo);

                            #el campo anterior queda invisible
                            $this->objCampo->actualizar(array("cam_visible"=>0),array("cam_codigo"=>$campoAnterior->codigo));

                            #el campo anterior queda como null
                            $campoNull = array($campoAnterior->nombre_campo => array('name' => $campoAnterior->nombre_campo,'type' => $campoAnterior->tipo_campo->tipo,'constraint'=>$campoAnterior->longitud,"null"=>true));
                            $this->dbforge->modify_column($tabla->nombre_tabla, $campoNull);

                        }
                        else{
                            #actualiza el campo
                            $campo = array($campoAnterior->nombre_campo => array('name' => $nombreCampo,'type' => $tipoCampo->tipo,"null"=>$nulo));

                            #si tiene longitud se agrega
                            if($longitud)
                                $campo[$campoAnterior->nombre_campo]['constraint'] = $longitud;

                            $this->dbforge->modify_column($tabla->nombre_tabla, $campo);
                        }
                    }

					#agrega claves primarias
                    if($this->input->post('clave_primaria')){
                        $dropPrimary = '';
                        $primarias = $nombreCampo;
                        if($tabla->campos){
                            foreach($tabla->campos as $cam){
                                if($cam->primaria){
                                    $primarias .= ",".$cam->nombre_campo;
                                    $dropPrimary = "DROP PRIMARY KEY,";
                                }
                            }
                        }

                        #clave primaria
                        $primaria = "ALTER TABLE ".$tabla->nombre_tabla." ".$dropPrimary." ADD PRIMARY KEY(".$primarias.");";
        				$this->objTabla->query($primaria);
                    }

                    if($comentario){
                        #guarda la accion en el historial
                        $comentario = "El campo <b>".$campoAnterior->nombre."</b> ".$comentario;
                        $historial['his_codigo'] = $this->objHistorial->nextId();
                        $historial['his_campo_a'] = $campoAnterior->codigo;
                        $historial['his_campo_n'] = ($agregarNuevo)?$this->objCampo->nextId():null;
                        $historial['his_comentario'] = $comentario;
                        $historial['his_fecha'] = date('Y-m-d H:i:s');
                        $historial['hia_codigo'] = 4;
                        $historial['tab_codigo'] = $campoAnterior->tabla->codigo;
                        $this->objHistorial->agregar($historial);
                    }

                }
                else{

                    #verifica que el campo no exista para la tabla
                    if($this->objCampo->obtener(array("cam.cam_nombre_campo"=>$nombreCampo,"tab.tab_codigo"=>$this->input->post('tabla')))){
                        echo json_encode(array("El campo ".$this->input->post('nombre_campo')." ya existe"));
                        exit;
                    }

                    if($this->input->post('campo_relacionado')){
                        $tablaRelacion = $this->objTabla->obtener_por_codigo($this->input->post('relacion'));
                        $campoRelacion = $this->objCampo->obtener_por_campo($this->input->post('campo_relacion'));

                        $datos['tipr_codigo'] = $this->input->post('tipo_relacion');
                        $datos['cam_tabla_relacion'] = $tablaRelacion->codigo;
                        $datos['cam_campo_relacion'] = $campoRelacion->codigo;

                        $nulo = false;
                        if($this->input->post('nulo'))
                            $nulo = true;

                        $campo = array($nombreCampo=>array('type'=>$tipoCampo->tipo,'null'=>$nulo));

                        #si tiene longitud se agrega
                        if($this->input->post('longitud'))
                            $campo[$nombreCampo]['constraint'] = $this->input->post('longitud');
                        elseif($tipoCampo->longitud)
                            $campo[$nombreCampo]['constraint'] = $tipoCampo->longitud;


                        $this->dbforge->add_column($tabla->nombre_tabla, $campo);

                        #agrega como foranea
                        if(!$this->input->post('clave_primaria')){
                            $foranea = "ALTER TABLE ".$tabla->nombre_tabla." ADD FOREIGN KEY (".$nombreCampo.") REFERENCES ".$tablaRelacion->nombre_tabla."(".$campoRelacion->nombre_campo.");";
                            $this->objTabla->query($foranea);
                        }
                    }
                    else{
                        #agrega el nuevo campo
                        $nulo = false;
                        if($this->input->post('nulo'))
                            $nulo = true;

                        $campo = array($nombreCampo=>array('type'=>$tipoCampo->tipo,'null'=>$nulo));

                        #si tiene longitud se agrega
                        if($this->input->post('longitud'))
                            $campo[$nombreCampo]['constraint'] = $this->input->post('longitud');
                        elseif($tipoCampo->longitud)
                            $campo[$nombreCampo]['constraint'] = $tipoCampo->longitud;

                        $this->dbforge->add_column($tabla->nombre_tabla, $campo);
                    }

                    if($this->input->post('clave_primaria')){
                        $dropPrimary = '';
                        $primarias = $nombreCampo;
                        if($tabla->campos){
                            foreach($tabla->campos as $cam){
                                if($cam->primaria){
                                    $primarias .= ",".$cam->nombre_campo;
                                    $dropPrimary = "DROP PRIMARY KEY,";
                                }
                            }
                        }

                        #clave primaria
                        $primaria = "ALTER TABLE ".$tabla->nombre_tabla." ".$dropPrimary." ADD PRIMARY KEY(".$primarias.");";
        				$this->objTabla->query($primaria);
                    }
                }

                $datos['tic_codigo'] = $tipoCampo->codigo;
                $datos['tab_codigo'] = $this->input->post('tabla');
                $datos['cam_nombre'] = $this->input->post('nombre_campo');
                $datos['cam_longitud'] = ($this->input->post('longitud'))?$this->input->post('longitud'):$tipoCampo->longitud;
                $datos['cam_predeterminado'] = $this->input->post('valor_predeterminado');
                $datos['cam_primaria'] = $this->input->post('clave_primaria');
                $datos['cam_comentario'] = $this->input->post('comentario');
                $datos['cam_nulo'] = $this->input->post('nulo');

                if($this->input->post('codigo_campo') && !$agregarNuevo){
                    $codigo = $this->input->post('codigo_campo');
                    $this->objCampo->actualizar($datos,array("cam_codigo"=>$codigo));
                }
                else{
                    $codigo = $datos['cam_codigo'] = $this->objCampo->nextId();
                    $this->objCampo->agregar($datos);
                }

                echo json_encode(array("result"=>true,"codigo"=>$this->input->post('tabla')));
			}
        }
    }

    public function eliminar_campo(){

        if($this->input->post()){

            try{

                $campo = $this->objCampo->obtener_por_codigo($this->input->post('codigo'));

                #verifica si el campo pertenece a una vista
                if(!$this->input->post('confirmado')){
                    if($campo->tabla->vista){
                        echo json_encode(array("result"=>false,"confirmar"=>true,"msg"=>"El campo <b>".$campo->nombre."</b> pertenece a la vista <b>".$campo->tabla->nombre."</b>. Si lo elimina, la vista también será eliminada. ¿Confirma la eliminación del campo?"));
                        exit;
                    }
                }

                $this->objCampo->actualizar(array("cam_visible"=>0),array("cam_codigo"=>$this->input->post("codigo")));

                #deja el campo como NULL para evitar problemas al hacer INSERT sobre un campo no visible
                $campoNull = array($campo->nombre_campo => array('name' => $campo->nombre_campo,'type' => $campo->tipo_campo->tipo,'constraint'=>$campo->longitud,"null"=>true));
                $this->dbforge->modify_column($campo->tabla->nombre_tabla, $campoNull);

                #guarda la accion en el historial
                $comentario = "El campo <b>".$campo->nombre."</b> ha sido eliminado";
                $historial['his_codigo'] = $this->objHistorial->nextId();
                $historial['his_campo_a'] = $campo->codigo;
                $historial['his_comentario'] = $comentario;
                $historial['his_fecha'] = date('Y-m-d H:i:s');
                $historial['hia_codigo'] = 3;
                $historial['tab_codigo'] = $this->input->post("tabla");
                $this->objHistorial->agregar($historial);

                echo json_encode(array("result"=>true,"codigo"=>$this->input->post("tabla")));
            }
            catch(Exception $e){
                echo json_encode(array("result"=>false,"msg"=>"Ha ocurrido un error inesperado. Por favor, inténtelo nuevamente."));
            }
        }
        else{
            show_error('Página no encontrada');
        }
    }

    public function listar_campos_tabla(){

        $select = "";
        if(!$this->input->post('seleccione'))
            $select = '<option value="">Seleccione</option>';
        if($this->input->post('tabla')){
            $campo_relacion = ($this->input->post('campo_relacion'))?$this->input->post('campo_relacion'):'';
            if($campos = $this->objCampo->listar(array("tab_codigo"=>$this->input->post('tabla'),"cam_primaria"=>1))){
               foreach($campos as $aux){
                    $selected = '';
                    if($campo_relacion && $campo_relacion == $aux->codigo)
                        $selected = 'selected';
                    $select .= '<option '.$selected.' value="'.$aux->nombre_campo.'">'.$aux->nombre.'</option>';
               }
            }
            else{
                $select = '<option value="">Tabla sin campos</option>';
            }
        }

        echo json_encode($select);
    }

}
