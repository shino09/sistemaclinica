<?php
if (!defined ('BASEPATH')) exit ('no direct script acces allowed');

class Usuario_model extends CI_Model {
    
    private $tabla = 's_usuarios';
    function __construct(){
        parent::__construct();
    }
    
    ### mantenedor ###
    public function  nextId(){
        $this->db->select_max("usua_codigo","maximo");
		$sql = $this->db->get($this->tabla);
        
		return $sql->row()->maximo+1;
    }
    
    public function agregar($datos){
        return $this->db->insert($this->tabla,$datos);
    }
    
    public function actualizar($datos,$where){
        if($where)
            return $this->db->update($this->tabla,$datos,$where);
        return false;
    }
    
    public function eliminar($where){
        if($where)
            return $this->db->delete($this->tabla,$where);
        return false;
    }
    
    public function query($sql){
        return $this->db->query($sql);
    }
    
    ### fin mantenendor ###


    public function obtener_por_codigo($codigo){
        return $this->obtener(array('usu.usua_codigo'=>$codigo));
	}

	public function obtener($where){

		$sql= $this->db->select('*')
					->from($this->tabla.' as usu')
                    ->join('keys as ke','ke.ke_id = usu.ke_id')
					->where($where)
                    ->where('usua_visible = 1')
					->get();

		$aux = $sql->row();
		if($aux){
            $obj = new stdClass();
			$obj->codigo = $aux->usua_codigo;
			$obj->nombre = $aux->usua_nombre;
            $obj->nombre_db = $aux->usua_nombre_db;
			$obj->contrasena = $aux->usua_contrasena;
			$obj->key = $aux->api_key;
            
            $obj->permisos_tablas = $this->listar_permisos_tablas(array("usua_codigo"=>$aux->usua_codigo));
            $obj->permisos_campos = $this->listar_permisos_campos(array("usua_codigo"=>$aux->usua_codigo));
            
			return $obj;
		}
		return false;

	}
    
    public function listar($where = false, $limit = false, $offset = false){
        
        if($where)
            $this->db->where($where);
            
        if($limit && is_numeric($limit) && $offset && is_numeric($offset))
            $this->db->limit($limit,$offset);
        elseif($limit && is_numeric($limit))
            $this->db->limit($limit);
        
		$sql= $this->db->select('*')
					->from($this->tabla.' as usu')
                    ->join('keys as ke','ke.ke_id = usu.ke_id')
                    ->where('usua_visible = 1')
					->get();

		$result = $sql->result();
        $lista = array();
        
		foreach($result as $aux){
            $obj = new stdClass();
			$obj->codigo = $aux->usua_codigo;
			$obj->nombre = $aux->usua_nombre;
			$obj->nombre_db = $aux->usua_nombre_db;
			$obj->contrasena = $aux->usua_contrasena;
			$obj->key = $aux->api_key;
            
			$lista[] = $obj;
		}
		return $lista;

	}
    
    
    #API KEY
    public function agregar_key($datos){
        return $this->db->insert('keys',$datos);
    }
    
    public function eliminar_key($where){
        return $this->db->delete('keys', $where);
    }
    
    public function obtener_key($where){

		$sql= $this->db->select('*')
					->from('keys')
					->where($where)
					->get();

		$aux = $sql->row();
		if($aux){
            $obj = new stdClass();
			$obj->codigo = $aux->ke_id;
			$obj->key = $aux->api_key;
            
			return $obj;
		}
		return false;

	}
    
    
    ### permisos campos ###
    public function agregar_permiso_campo($datos){
        return $this->db->insert('s_usuarios_permisos_campos',$datos);
    }
    
    public function eliminar_permiso_campo($where){
        if($where)
            return $this->db->delete('s_usuarios_permisos_campos',$where);
        return false;
    }
    
    public function listar_permisos_campos($where = false){
        
        if($where)
            $this->db->where($where);

		$sql= $this->db->select('*')
					->from('s_usuarios_permisos_campos')
					->get();

		$result = $sql->result();
        $lista = array();
        
		foreach($result as $aux){
            $obj = new stdClass();
			$obj->usuario = $aux->usua_codigo;
			$obj->permiso = $aux->perm_codigo;
			$obj->campo = $aux->cam_codigo;
            
			$lista[] = $obj;
		}
		return $lista;
	}
    
    ### fin permisos campos ###
    
    
    ### permisos tablas ###
    public function agregar_permiso_tabla($datos){
        return $this->db->insert('s_usuarios_permisos_tablas',$datos);
    }
    
    public function eliminar_permiso_tabla($where){
        if($where)
            return $this->db->delete('s_usuarios_permisos_tablas',$where);
        return false;
    }
    
    public function listar_permisos_tablas($where = false){
        
        if($where)
            $this->db->where($where);

		$sql= $this->db->select('*')
					->from('s_usuarios_permisos_tablas')
					->get();

		$result = $sql->result();
        $lista = array();
        
		foreach($result as $aux){
            $obj = new stdClass();
			$obj->usuario = $aux->usua_codigo;
			$obj->permiso = $aux->perm_codigo;
			$obj->tabla = $aux->tab_codigo;
            
			$lista[] = $obj;
		}
		return $lista;
	}
    
    ### fin permisos tablas ###
    
    
    
    ### listar tablas usuario ###
    public function tablas_usuario($usuario){
        
        #models
        $this->load->model('usuarios/permiso_model','objPermiso');
        
        $sql = $this->db->select("*")
                ->from('s_tablas tab')
                ->join('s_usuarios_permisos_tablas utab','tab.tab_codigo = utab.tab_codigo')
                ->where(array("usua_codigo"=>$usuario,"tab_visible"=>1))
                ->group_by("tab.tab_codigo")
                ->get();

        $result = $sql->result();
        $lista = array();
        foreach($result as $aux){
            $obj = new stdClass();
            $obj->codigo = $aux->tab_codigo;
            $obj->nombre = $aux->tab_nombre;
            $obj->nombre_tabla = $aux->tab_nombre_tabla;
            $obj->prefijo = $aux->tab_prefijo;
            
            $obj->campos = $this->campos_usuario($usuario,$obj->codigo);
            
            $obj->relacionadas = $this->relacionadas($usuario,$obj->codigo);
            
            $obj->permisos = $this->listar_permisos_tablas(array("tab_codigo"=>$obj->codigo,"usua_codigo"=>$usuario));
            
            foreach($obj->permisos as $k=>$perm){
                $obj->permisos[$k]->permisos = new stdClass();
                $obj->permisos[$k]->permisos = $this->objPermiso->obtener_por_codigo($perm->permiso);
            }
            
            $lista[] = $obj;
        }
    
        return $lista;
    }
    
    #obtiene los campos de la tabla
    public function campos_usuario($usuario,$tabla){
        
        #models
        $this->load->model('usuarios/permiso_model','objPermiso');
        
        $sql = $this->db->select("*")
                ->from('s_campos cam')
                ->join('s_usuarios_permisos_campos ucam','cam.cam_codigo = ucam.cam_codigo')
                ->join('s_tipos_campo as tic','cam.tic_codigo = tic.tic_codigo')
                ->where(array('tab_codigo'=>$tabla,"cam_visible"=>1,"usua_codigo"=>$usuario))
                ->group_by("cam.cam_codigo")
                ->get();
        
        $result = $sql->result();
        $lista = array();
        
        foreach($result as $aux){
            $obj = new stdClass();
            $obj->codigo = $aux->cam_codigo;
            $obj->nombre = $aux->cam_nombre;
            $obj->nombre_slug = slug($aux->cam_nombre);
            $obj->nombre_campo = $aux->cam_nombre_campo;
            $obj->primaria = $aux->cam_primaria;
            $obj->nulo = $aux->cam_nulo;
            $obj->predeterminado = $aux->cam_predeterminado;
            $obj->longitud = $aux->cam_longitud;
            
            $obj->tipo_campo = new stdClass();
            $obj->tipo_campo->codigo = $aux->tic_codigo;
            $obj->tipo_campo->nombre = $aux->tic_nombre;
            $obj->tipo_campo->tipo = $aux->tic_tipo;
            $obj->tipo_campo->longitud = $aux->tic_longitud;
            
            $obj->permisos = $this->listar_permisos_campos(array("cam_codigo"=>$obj->codigo,"usua_codigo"=>$usuario));
            
            foreach($obj->permisos as $k=>$perm){
                $obj->permisos[$k]->permisos = new stdClass();
                $obj->permisos[$k]->permisos = $this->objPermiso->obtener_por_codigo($perm->permiso);
            }
            
            $lista[] = $obj;
        }
        
        return $lista;
    }
    
    #obtiene los codigos de las tablas relacionadas
    public function relacionadas($usuario,$tabla){
        
        $sql = $this->db->select("cam_tabla_relacion,tab.tab_nombre,cam_nombre_campo,cam_campo_relacion")
                ->from('s_campos cam')
                ->join('s_usuarios_permisos_campos ucam','cam.cam_codigo = ucam.cam_codigo')
                ->join('s_tablas tab','cam_tabla_relacion = tab.tab_codigo')
                ->join('s_usuarios_permisos_tablas utab','tab.tab_codigo = utab.tab_codigo')
                ->where(array("cam_visible"=>1,"ucam.usua_codigo"=>$usuario,"utab.usua_codigo"=>$usuario))
                ->where(array("cam.tab_codigo"=>$tabla))
                ->group_by('cam_tabla_relacion')
                ->get();

        $result = $sql->result();
        $lista = array();
        
        foreach($result as $aux){
            $obj = new stdClass();
            $obj->codigo = $aux->cam_tabla_relacion;
            $obj->nombre = $aux->tab_nombre;
            $obj->primaria = $aux->cam_nombre_campo;
            $obj->foranea = $this->foraneas($aux->cam_campo_relacion);
            
            $lista[] = $obj;
        }
        
        return $lista;
    }
    
    #obtiene informacion del campo relacion
    public function foraneas($campo){
        
        $sql = $this->db->select("*")
                ->from('s_campos cam')
                ->where(array("cam.cam_codigo"=>$campo))
                ->get();
        
        $aux = $sql->row();
        
        if($aux){
            $obj = new stdClass();
            $obj->codigo = $aux->cam_codigo;
            $obj->nombre = $aux->cam_nombre;
            $obj->nombre_campo = $aux->cam_nombre_campo;
            
            return $obj;
        }
        
        return false;
    }
}