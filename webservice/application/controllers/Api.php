<?php defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Api extends REST_Controller
{
    private $key;
	function __construct()
    {
        // Construct our parent class
        parent::__construct();

        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        //$this->methods['user_get']['limit'] = 50000; //500 requests per hour per user/key
        //$this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        //$this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
        
        #models
        $this->load->model('usuario_model','objUsuario');
        $this->load->model('modulo_model','objModulo');
        $this->load->model('tablaJoin_model','objTablaJoin');
        
        #captura la api key del header
        #depende del servidor el nombre de la variable puede cambiar
        $this->key = "";
        $formas_key = array('x-api-key','X-Api-Key','X-API-KEY');
        foreach($formas_key as $aux){
            $this->key = $this->input->get_request_header($aux);
            if($this->key) break;
        }
        
        if(!$this->key){
            $response = array(
                "result" => false,
                "msg" => "Key no v&aacute;lida"
            );
            $this->response($response, 400);
        }
        
    }
    
    public function listado_post(){
        
        if($usuario = $this->objUsuario->get_user($this->key)){
           if(!is_numeric($this->post('tabla'))){
                $response = array(
                    "result" => false,
                    "msg" => "C&oacute;digo de tabla incorrecto"
                );
                $this->response($response, 400);
           }
           
            $this->objModulo->codigoTabla = $this->post('tabla');
            $this->objModulo->usuario = $usuario->codigo;
            $this->objModulo->permiso = 1; #permiso de lectura
            
            if($this->objModulo->tabla()){
                
                if($this->post('where'))
                    $this->objModulo->where = $this->post('where');
                
                if($this->post('having'))
                    $this->objModulo->having = $this->post('having');
                    
                if($this->post('limit')){
                    
                    if(!is_numeric($this->post('limit'))){
                        $response = array(
                            "result" => false,
                            "msg" => "LIMIT debe ser num&eacute;rico"
                        );
                        $this->response($response, 400);
                    }
                    
                    $this->objModulo->limit = $this->post('limit');
                }
                
                if($this->post('offset')){
                    
                    if(!is_numeric($this->post('offset'))){
                        $response = array(
                            "result" => false,
                            "msg" => "OFFSET debe ser num&eacute;rico"
                        );
                        $this->response($response, 400);
                    }
                    
                    $this->objModulo->offset = $this->post('offset');
                }
                
                if($this->post('join')){
                    $joins = array();
                    $tablaCamposJoin = array();
                    
                    #si no viene como ARRAY se retorna un error
                    if(!is_array($this->post('join'))){
                        $response = array(
                            "result" => false,
                            "msg" => 'JOIN debe ser enviado como ARRAY'
                        );
                        $this->response($response, 400);
                    }
                    
                    #todos los join deben venir dentro de otro arreglo
                    #array( array(join1), array(join2) )
                    #cuando es un solo join puede no venir en ese formato, entonces se pone dentro de otro arreglo
                    #array( join1 )
                    $ar = true;
                    foreach($this->post('join') as $k=>$aux){
                        if($k != 'campos'){
                            if(!is_array($aux)){
                                $ar = false;
                                break;
                            }
                        }
                    }
                    
                    if(!$ar)
                        $joinOriginal = array($this->post('join'));
                    else
                        $joinOriginal = $this->post('join');

                    foreach($joinOriginal as $aux){

                        $jo = new stdClass();
                        $jo = (object) $aux;
                            
                        #si no viene la TABLA o el ON se retorna un error
                        if(!$jo->tabla || !$jo->on){
                            $response = array(
                                "result" => false,
                                "msg" => 'Formato JOIN incorrecto'
                            );
                            $this->response($response, 400);
                        }
                        
                        if($jo->tabla == $this->objModulo->tabla->codigo){
                            $response = array(
                                "result" => false,
                                "msg" => 'No puede hacer JOIN sobre la misma tabla'
                            );
                            $this->response($response, 400);
                        }
                        
                        if($joins){
                            foreach($joins as $j){
                                if($jo->tabla == $j->tabla){
                                    $response = array(
                                        "result" => false,
                                        "msg" => 'No puede hacer JOIN sobre la misma tabla'
                                    );
                                    $this->response($response, 400);
                                }
                            }
                        }
                        
                        $this->objTablaJoin->permiso = 1;
                        $this->objTablaJoin->usuario = $usuario->codigo;
                        $this->objTablaJoin->codigoTabla = $jo->tabla;
                        $tablaJoin = $this->objTablaJoin->tabla();
                        
                        if(!$tablaJoin){
                            $response = array(
                                "result" => false,
                                "msg" => 'No tiene permisos de lectura para la tabla '.$jo->tabla
                            );
                            $this->response($response, 400);
                        }
                        
                        #guarda todos los campos de las tablas JOIN
                        $tablaCamposJoin = array_merge($tablaCamposJoin,$this->objTablaJoin->tabla->campos);
                        
                        #si no viene 2 campos separados por un = se retorna un error
                        $on = explode('=',$jo->on);
                        if(!isset($on[0]) || !isset($on[1])){
                            $response = array(
                                "result" => false,
                                "msg" => 'Formato JOIN incorrecto'
                            );
                            $this->response($response, 400);
                        }
                        
                        $on[0] = trim($on[0]);
                        $on[1] = trim($on[1]);
                        
                        #si no tiene permisos sobre los campos se retorna un error
                        $permisos1 = $permisos2 = false;
                        foreach($this->objModulo->tabla->campos as $cam){
                            if($cam->nombre_campo == $on[0])
                                $permisos1 = true;
                            if($cam->nombre_campo == $on[1])
                                $permisos2 = true;
                        }
                        
                        foreach($tablaCamposJoin as $cam){
                            if($cam->nombre_campo == $on[0])
                                $permisos1 = true;
                            if($cam->nombre_campo == $on[1])
                                $permisos2 = true;
                        }
                        
                        $y = $camposPermiso = "";
                        if(!$permisos1){
                            $camposPermiso = $on[0];
                            $y = " y ";
                        }
                        
                        if(!$permisos2)
                            $camposPermiso .= $y.$on[1];
                        
                        if(!$permisos1 || !$permisos2){
                            $response = array(
                                "result" => false,
                                "msg" => 'No tiene permisos de lectura para el o los campos '.$camposPermiso
                            );
                            $this->response($response, 400);
                        }
                        
                        #verifica que tenga permisos de lectura para los campos solicitados
                        $camposJoin = array();
                        $requireCampos = true;
                        if(isset($jo->campos)){
                            
                            if($jo->campos){
                                if(!is_array($jo->campos))
                                    $camposOriginal = array($jo->campos);
                                else
                                    $camposOriginal = $jo->campos;
                                
                                foreach($camposOriginal as $k=>$ca){
									
									$nombre_campo = $ca;
                                    $func = array("sum","count","min","max","avg");
                                    $existeF = $existeFF = '';
                                    foreach($func as $f){
                                        if(strpos(strtolower($ca),$f) !== false){
                                            $existeF = $f;
                                            break;
                                        }
                                    }
            
                                    if($existeF)
                                        $ca = str_replace(array($existeF,'(',')'),"",strtolower($ca));
                                    else{
                                        /* funciones sin validacion */
                                        $func = array("date","year","month","day","DATE_FORMAT");
                                        $existeF = '';
                                        foreach($func as $f){
                                            if(strpos(strtolower($ca),$f) !== false){
                                                $existeFF = true;
                                                break;
                                            }
                                        }
                                    }
									
                                    foreach($this->objTablaJoin->tabla->campos as $cam){
                                        if($cam->nombre_campo == $ca || $existeFF){
                                            $obj = new stdClass();
                                            $obj->nombre_campo = $cam->nombre_campo;
                                            $obj->nombre_retorno = (is_numeric($k))?$cam->nombre_retorno:$k;
                                            $obj->nombre_slug = $cam->nombre_slug;
                                            $camposJoin[] = $obj;
                                        }
                                    }
                                }
                            }
                            else{
                                $requireCampos = false;
                            }
                        }
                        
                        #si solicita devolver algun campo se retornan los definidos por la llamada
                        #si no envia ningun campo se retornar todos los campos de la tabla
                        #si 'campos' viene en 'false' o un array vacio no se retorna ninguno 
                        if($requireCampos){
                            if($camposJoin)
                                $jo->campos = $camposJoin;
                            else
                                $jo->campos = $this->objTablaJoin->tabla->campos;
                        }
                        else
                            $jo->campos = array();
                            
                        $jo->tabla = $this->objTablaJoin->tabla->nombre_tabla;
                        $jo->prefijo = $this->objTablaJoin->tabla->prefijo;
                        
                        if(!isset($jo->tipo))
                            $jo->tipo = 'inner';
                        
                        $joins[] = $jo;
                    }
                    
                    $this->objModulo->join = $joins;
                }
                
                if($this->post('order')){
                    
                    $orden = array();
                    if(!is_array($this->post('order'))){
                        $camp = explode(' ',trim($this->post('order')));
                        if($camp[1])
                            $orden[strtolower(trim($camp[0]))] = strtolower(trim($camp[1]));
                        else
                            $orden[strtolower(trim($camp[0]))];
                    }
                    else{
                        foreach($this->post('order') as $key=>$cam){
                            if(!is_numeric($key))
                                $orden[strtolower(trim($key))] = strtolower(trim($cam));
                            else{
                                $camp = explode(' ',trim($cam));
                                if($camp[1])
                                    $orden[strtolower(trim($camp[0]))] = strtolower(trim($camp[1]));
                                else
                                    $orden[strtolower(trim($camp[0]))];
                            }
                        }
                    }
                    
                    foreach($orden as $cam=>$ord){
                        $existe = false;
                        foreach($this->objModulo->tabla->campos as $aux){
                            if($cam == $aux->nombre_campo)
                                $existe = true;
                        }
                        
                        if(isset($tablaCamposJoin)){
                            foreach($tablaCamposJoin as $aux){
                                if($cam == $aux->nombre_campo)
                                    $existe = true;
                            }
                        }
                        
                        if(!$existe){
                            $response = array(
                                "result" => false,
                                "msg" => 'Campo '.$cam.' desconocido para la tabla '.$this->objModulo->tabla->nombre
                            );
                            $this->response($response, 400);
                        }
                    }
                    
                    $this->objModulo->orden = $orden;
                }
                
                if($this->post('group')){
                    
                    $campo = array();
                    if(!is_array($this->post('group'))){
                        $campo[] = strtolower(trim($this->post('group')));
                        
                    }
                    else{
                        foreach($this->post('group') as $cam){
                            $campo[] = $cam;
                        }
                    }
                    
                    foreach($campo as $cam){
                        $existe = false;
                        foreach($this->objModulo->tabla->campos as $aux){
                            if($cam == $aux->nombre_campo)
                                $existe = true;
                        }
                        
                        if(isset($tablaCamposJoin)){
                            foreach($tablaCamposJoin as $aux){
                                if($cam == $aux->nombre_campo)
                                    $existe = true;
                            }
                        }
                        
                        if(!$existe){
                            $response = array(
                                "result" => false,
                                "msg" => 'Campo '.$cam.' desconocido para la tabla '.$this->objModulo->tabla->nombre
                            );
                            $this->response($response, 400);
                        }
                    }
                    
                    $this->objModulo->group = $this->post('group');
                }
                
                $campos = array();
                if($this->post('campos')){
                    
                    if(!is_array($this->post('campos')))
                        $camposOriginal = array($this->post('campos'));
                    else
                        $camposOriginal = $this->post('campos');
                    
                    if(isset($tablaCamposJoin))
                        $tablaCampos = array_merge($tablaCamposJoin,$this->objModulo->tabla->campos);
                    else
                        $tablaCampos = $this->objModulo->tabla->campos;
                    
                    foreach($camposOriginal as $k=>$ca){
                        $nombre_campo = $ca;
                        $func = array("sum","count","min","max","avg","distinct");
                        $existeF = $existeFF = '';
                        foreach($func as $f){
                            if(strpos(strtolower($ca),$f) !== false){
                                $existeF = $f;
                                break;
                            }
                        }

                        if($existeF)
                            $ca = str_replace(array($existeF,'(',')'),"",strtolower($ca));
                        else{
                            /* funciones sin validacion */
                            $func = array("date","year","month","day","DATE_FORMAT");
                            $existeF = '';
                            foreach($func as $f){
                                if(strpos(strtolower($ca),$f) !== false){
                                    $existeFF = true;
                                    break;
                                }
                            }
                        }
                        foreach($tablaCampos as $cam){
                            if($cam->nombre_campo == $ca || $existeFF){
                                $obj = new stdClass();
                                $obj->nombre_campo = $nombre_campo;
                                $obj->nombre_retorno = (is_numeric($k))?$cam->nombre_retorno:$k;
                                $obj->nombre_slug = $cam->nombre_slug;
                                $campos[] = $obj;
                                break;
                            }
                        }
                    }
                }
                
                if($campos){
                    $this->objModulo->tabla->campos = array();
                    $this->objModulo->tabla->campos = $campos;
                }


                $datos = $this->objModulo->listar();
                if($datos)
                    $result = true;
                else
                    $result = false;
                $response = array(
                    "result" => $result,
                    "tabla"=>$this->objModulo->tabla->nombre,
                    "tablas_relacionadas"=>$this->objModulo->tabla->relacionadas,
                    "datos"=>$this->objModulo->listar()
                );
				
				if($this->input->post('sql')){
                    $response['sql'] = $this->objModulo->last_query();
                }
				
                $this->response($response, 200);
            }
            else{
                $response = array(
                    "result" => false,
                    "msg" => "No tiene permisos de lectura para esta tabla"
                );
                $this->response($response, 400);
            }
        }
    }
    
    public function obtener_post(){

        if($usuario = $this->objUsuario->get_user($this->key)){

           if(!is_numeric($this->post('tabla'))){
                $response = array(
                    "result" => false,
                    "msg" => 'C&oacute;digo de tabla incorrecto'
                );
                $this->response($response, 400);
           }
           
            $this->objModulo->codigoTabla = $this->post('tabla');
            $this->objModulo->usuario = $usuario->codigo;
            $this->objModulo->permiso = 1; #permiso de lectura
            
            if($this->objModulo->tabla()){
                
                if(!$this->post('where')){
                    $response = array(
                        "result" => false,
                        "msg" => 'Debe indicar una sentencia WHERE'
                    );
                    $this->response($response, 400);
                }
                
                if($this->post('having'))
                    $this->objModulo->having = $this->post('having');
                
                if($this->post('join')){
                    $joins = array();
                    $tablaCamposJoin = array();
                    
                    #si no viene como ARRAY se retorna un error
                    if(!is_array($this->post('join'))){
                        $response = array(
                            "result" => false,
                            "msg" => 'JOIN debe ser enviado como ARRAY'
                        );
                        $this->response($response, 400);
                    }
                    
                    #todos los join deben venir dentro de otro arreglo
                    #array( array(join1), array(join2) )
                    #cuando es un solo join puede no venir en ese formato, entonces se pone dentro de otro arreglo
                    #array( join1 )
                    $ar = true;
                    foreach($this->post('join') as $k=>$aux){
                        if($k != 'campos'){
                            if(!is_array($aux)){
                                $ar = false;
                                break;
                            }
                        }
                    }
                    
                    if(!$ar)
                        $joinOriginal = array($this->post('join'));
                    else
                        $joinOriginal = $this->post('join');
                    
                    foreach($joinOriginal as $aux){ 
                        
                        $jo = new stdClass();
                        $jo = (object) $aux;
                            
                        #si no viene la TABLA o el ON se retorna un error
                        if(!$jo->tabla || !$jo->on){
                            $response = array(
                                "result" => false,
                                "msg" => 'Formato JOIN incorrecto'
                            );
                            $this->response($response, 400);
                        }
                        
                        if($jo->tabla == $this->objModulo->tabla->codigo){
                            $response = array(
                                "result" => false,
                                "msg" => 'No puede hacer JOIN sobre la misma tabla'
                            );
                            $this->response($response, 400);
                        }
                        
                        if($joins){
                            foreach($joins as $j){
                                if($jo->tabla == $j->tabla){
                                    $response = array(
                                        "result" => false,
                                        "msg" => 'No puede hacer JOIN sobre la misma tabla'
                                    );
                                    $this->response($response, 400);
                                }
                            }
                        }
                        
                        $this->objTablaJoin->permiso = 1;
                        $this->objTablaJoin->usuario = $usuario->codigo;
                        $this->objTablaJoin->codigoTabla = $jo->tabla;
                        $tablaJoin = $this->objTablaJoin->tabla();
                        
                        if(!$tablaJoin){
                            $response = array(
                                "result" => false,
                                "msg" => 'No tiene permisos de lectura para la tabla '.$jo->tabla
                            );
                            $this->response($response, 400);
                        }
                        
                        #guarda todos los campos de las tablas JOIN
                        $tablaCamposJoin = array_merge($tablaCamposJoin,$this->objTablaJoin->tabla->campos);
                        
                        #si no viene 2 campos separados por un = se retorna un error
                        $on = explode('=',$jo->on);
                        if(!isset($on[0]) || !isset($on[1])){
                            $response = array(
                                "result" => false,
                                "msg" => 'Formato JOIN incorrecto'
                            );
                            $this->response($response, 400);
                        }
                        
                        $on[0] = trim($on[0]);
                        $on[1] = trim($on[1]);
                        
                        #si no tiene permisos sobre los campos se retorna un error
                        $permisos1 = $permisos2 = false;
                        foreach($this->objModulo->tabla->campos as $cam){
                            if($cam->nombre_campo == $on[0])
                                $permisos1 = true;
                            if($cam->nombre_campo == $on[1])
                                $permisos2 = true;
                        }
                        
                        foreach($tablaCamposJoin as $cam){
                            if($cam->nombre_campo == $on[0])
                                $permisos1 = true;
                            if($cam->nombre_campo == $on[1])
                                $permisos2 = true;
                        }
                        
                        $y = $camposPermiso = "";
                        if(!$permisos1){
                            $camposPermiso = $on[0];
                            $y = " y ";
                        }
                        
                        if(!$permisos2)
                            $camposPermiso .= $y.$on[1];
                        
                        if(!$permisos1 || !$permisos2){
                            $response = array(
                                "result" => false,
                                "msg" => 'No tiene permisos de lectura para el o los campos '.$camposPermiso
                            );
                            $this->response($response, 400);
                        }
                        
                        #verifica que tenga permisos de lectura para los campos solicitados
                        $camposJoin = array();
                        $requireCampos = true;
                        if(isset($jo->campos)){
                            
                            if($jo->campos){
                                if(!is_array($jo->campos))
                                    $camposOriginal = array($jo->campos);
                                else
                                    $camposOriginal = $jo->campos;
                                
                                foreach($camposOriginal as $k=>$ca){
									
									$nombre_campo = $ca;
                                    $func = array("sum","count","min","max","avg");
                                    $existeF = $existeFF = '';
                                    foreach($func as $f){
                                        if(strpos(strtolower($ca),$f) !== false){
                                            $existeF = $f;
                                            break;
                                        }
                                    }
            
                                    if($existeF)
                                        $ca = str_replace(array($existeF,'(',')'),"",strtolower($ca));
                                    else{
                                        /* funciones sin validacion */
                                        $func = array("date","year","month","day","DATE_FORMAT");
                                        $existeF = '';
                                        foreach($func as $f){
                                            if(strpos(strtolower($ca),$f) !== false){
                                                $existeFF = true;
                                                break;
                                            }
                                        }
                                    }
									
                                    foreach($this->objTablaJoin->tabla->campos as $cam){
                                        if($cam->nombre_campo == $ca || $existeF){
                                            $obj = new stdClass();
                                            $obj->nombre_campo = $cam->nombre_campo;
                                            $obj->nombre_retorno = (is_numeric($k))?$cam->nombre_retorno:$k;
                                            $obj->nombre_slug = $cam->nombre_slug;
                                            $camposJoin[] = $obj;
                                        }
                                    }
                                }
                            }
                            else
                                $requireCampos = false;
                        }
                        
                        #si solicita devolver algun campo se retornan los definidos por la llamada
                        #si en la llamada no viene ningun campo se retornar todos los campos de la tabla
                        #si 'campos' viene en 'false' o un array vacio no se retorna ninguno 
                        if($requireCampos){
                            if($camposJoin)
                                $jo->campos = $camposJoin;
                            else
                                $jo->campos = $this->objTablaJoin->tabla->campos;
                        }
                        else
                            $jo->campos = array();
                        
                        $jo->tabla = $this->objTablaJoin->tabla->nombre_tabla;
                        $jo->prefijo = $this->objTablaJoin->tabla->prefijo;
                        
                        if(!isset($jo->tipo))
                            $jo->tipo = 'inner';
                        
                        $joins[] = $jo;
                    }
                    
                    $this->objModulo->join = $joins;
                }
                
                if($this->post('group')){
                    
                    $campo = array();
                    if(!is_array($this->post('group'))){
                        $campo[] = strtolower(trim($this->post('group')));
                        
                    }
                    else{
                        foreach($this->post('group') as $cam){
                            $campo[] = $cam;
                        }
                    }
                    
                    foreach($campo as $cam){
                        $existe = false;
                        foreach($this->objModulo->tabla->campos as $aux){
                            if($cam == $aux->nombre_campo)
                                $existe = true;
                        }
                        
                        if(isset($tablaCamposJoin)){
                            foreach($tablaCamposJoin as $aux){
                                if($cam == $aux->nombre_campo)
                                    $existe = true;
                            }
                        }
                        
                        if(!$existe){
                            $response = array(
                                "result" => false,
                                "msg" => 'Campo '.$cam.' desconocido para la tabla '.$this->objModulo->tabla->nombre
                            );
                            $this->response($response, 400);
                        }
                    }
                    
                    $this->objModulo->group = $this->post('group');
                }
                
                $campos = array();
                
                if($this->post('campos')){
                    if(!is_array($this->post('campos')))
                        $camposOriginal = array($this->post('campos'));
                    else
                        $camposOriginal = $this->post('campos');
                    
                    if(isset($tablaCamposJoin))
                            $tablaCampos = array_merge($tablaCamposJoin,$this->objModulo->tabla->campos);
                        else
                            $tablaCampos = $this->objModulo->tabla->campos;
                        
                    foreach($camposOriginal as $k=>$ca){
                        $nombre_campo = $ca;
                        $func = array("sum","count","min","max","avg","distinct");
                        $existeF = $existeFF = '';
                        foreach($func as $f){
                            if(strpos(strtolower($ca),$f) !== false){
                                $existeF = $f;
                                break;
                            }
                        }

                        if($existeF)
                            $ca = str_replace(array($existeF,'(',')'),"",strtolower($ca));
                        else{
                            /* funciones sin validacion */
                            $func = array("date","year","month","day","DATE_FORMAT");
                            $existeF = '';
                            foreach($func as $f){
                                if(strpos(strtolower($ca),$f) !== false){
                                    $existeFF = true;
                                    break;
                                }
                            }
                        }
                        foreach($tablaCampos as $cam){
                            if($cam->nombre_campo == $ca || $existeFF){
                                $obj = new stdClass();
                                $obj->nombre_campo = $nombre_campo;
                                $obj->nombre_retorno = (is_numeric($k))?$cam->nombre_retorno:$k;
                                $obj->nombre_slug = $cam->nombre_slug;
                                $campos[] = $obj;
                                break;
                            }
                        }
                    }
                }
                
                if($campos){
                    $this->objModulo->tabla->campos = array();
                    $this->objModulo->tabla->campos = $campos;
                }
                    
                $this->objModulo->where = $this->post('where');
                
                $datos = $this->objModulo->obtener();
                if($datos)
                    $result = true;
                else
                    $result = false;
                $response = array(
                    "result" => $result,
                    "tabla"=>$this->objModulo->tabla->nombre,
                    "tablas_relacionadas"=>$this->objModulo->tabla->relacionadas,
                    "datos"=>$datos
                );
				
				if($this->input->post('sql')){
                    $response['sql'] = $this->objModulo->last_query();
                }
				
                $this->response($response, 200);
            }
            else{
                $response = array(
                    "result" => false,
                    "msg" => 'No tiene permisos de lectura sobre esta tabla'
                );
                $this->response($response, 400);
            }
        }
    }
    
    public function insertar_post(){
        
        if($usuario = $this->objUsuario->get_user($this->key)){

            if(!is_numeric($this->post('tabla'))){
                $response = array(
                    "result" => false,
                    "msg" => 'C&oacute;digo de tabla incorrecto'
                );
                $this->response($response, 400);
            }
           
            if(!$this->post('campos')){
                $response = array(
                    "result" => false,
                    "msg" => 'Debe indicar los campos a insertar'
                );
                $this->response($response, 400);
            }
                
            if(!is_array($this->post('campos'))){
                $response = array(
                    "result" => false,
                    "msg" => 'Los campos deben ser enviado como ARRAY'
                );
                $this->response($response, 400);
            }
                
            $this->objModulo->codigoTabla = $this->post('tabla');
            $this->objModulo->usuario = $usuario->codigo;
            $this->objModulo->permiso = 2; #permiso para insertar
            
            if($this->objModulo->tabla()){
                $campos = array();
                foreach($this->post('campos') as $key=>$aux){
                    foreach($this->objModulo->tabla->campos as $cam){
                        if($key == $cam->nombre_campo){
                            
                            #si el campo esta definido como nulo por defecto y viene vacio, se guarda NULL
                            if($aux === '' && $cam->nulo)
                                $aux = NULL;
                            
                            $campos[$key] = $aux;
                        }
                    }
                }
                
                if(!$campos){
                    $response = array(
                        "result" => false,
                        "msg" => 'No tiene permisos de inserci&oacute;n sobre los campos indicados'
                    );
                    $this->response($response, 400);
                }
                    
                
                $this->objModulo->campos = $campos;
                $id = $this->objModulo->insertar();
                
                $response = array(
                    "result" => true,
                    "datos" => $id
                );
                
                $this->response($response, 200);
            }
            else{
                $response = array(
                    "result" => false,
                    "msg" => 'No tiene permisos de inserci&oacute;n sobre esta tabla'
                );
                $this->response($response, 400);
            }
        }
    }
    
    public function actualizar_post(){
        
        if($usuario = $this->objUsuario->get_user($this->key)){

           if(!is_numeric($this->post('tabla'))){
                $response = array(
                    "result" => false,
                    "msg" => 'C&oacute;digo de tabla incorrecto'
                );
                $this->response($response, 400);
           }
           
           if(!$this->post('campos')){
                $response = array(
                    "result" => false,
                    "msg" => 'Debe indicar los campos a actualizar'
                );
                $this->response($response, 400);
           }
           
           if(!$this->post('where')){
                $response = array(
                    "result" => false,
                    "msg" => 'Debe incluir una sentencia WHERE'
                );
                $this->response($response, 400);
           }
                
            $this->objModulo->codigoTabla = $this->post('tabla');
            $this->objModulo->usuario = $usuario->codigo;
            $this->objModulo->permiso = 3; #permiso para actualizar
            
            if($this->objModulo->tabla()){
                
                $campos = array();
                foreach($this->post('campos') as $key=>$aux){
                    if($key != $this->objModulo->tabla->prefijo.'_visible'){
                        foreach($this->objModulo->tabla->campos as $cam){
                            if($key == $cam->nombre_campo){
                                
                                #si el campo esta definido como nulo por defecto y viene vacio, se guarda NULL
                                if($aux === '' && $cam->nulo)
                                    $aux = NULL;
                                    
                                $campos[$key] = $aux;
                            }
                        }
                    }
                    else{
                        $campos[$key] = $aux;
                    }
                }
                
                if(!$campos){
                    $response = array(
                        "result" => false,
                        "msg" => 'No tiene permisos de edici&oacute;n sobre los campos indicados'
                    );
                    $this->response($response, 400);
                }
                
                $this->objModulo->campos = $campos;
                $this->objModulo->where = $this->post('where');
                
                if($this->objModulo->actualizar()){
                    $response = array(
                        "result" => true
                    );
                    $this->response($response, 200);
                }
                else{
                    $response = array(
                        "result" => false,
                        "msg" => "Ha ocurrido un error inesperado"
                    );
                    $this->response($response, 400);
                }
            }
            else{
                $response = array(
                    "result" => false,
                    "msg" => "No tiene permisos de edici&oacute;n sobre esta tabla"
                );
                $this->response($response, 400);
            }
        }
    }
    
    public function eliminar_post(){
        
        if($usuario = $this->objUsuario->get_user($this->key)){

           if(!is_numeric($this->post('tabla'))){
                $response = array(
                    "result" => false,
                    "msg" => 'C&oacute;digo de tabla incorrecto'
                );
                $this->response($response, 400);
           }
           
           if(!$this->post('where')){
                $response = array(
                    "result" => false,
                    "msg" => 'Debe incluir una sentencia WHERE'
                );
                $this->response($response, 400);
           }
                
            $this->objModulo->codigoTabla = $this->post('tabla');
            $this->objModulo->usuario = $usuario->codigo;
            $this->objModulo->permiso = 4; #permiso para eliminar
            
            if($this->objModulo->tabla()){
                
                $this->objModulo->where = $this->post('where');
                $this->objModulo->eliminar();
                
                $response = array("result" => true);
                $this->response($response, 200);
            }
            else{
                $response = array(
                    "result" => false,
                    "msg" => 'No tiene permisos de eliminaci&oacute;n sobre esta tabla'
                );
                $this->response($response, 400);
            }
        }
    }
}