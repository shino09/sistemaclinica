<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
    private $tabla = 's_usuarios';
    function __construct()
    {
        parent::__construct();
    }


    public function get_user($key)
    { 
        return $this->obtener(array("ke.api_key"=>$key));
    }
 
    public function obtener($where)
    {
        $sql = $this->db->select("*")
                ->from($this->tabla.' as usu')
                ->join("keys ke",'usu.ke_id = ke.ke_id')
                ->where($where)
                ->where('usua_visible = 1')
                ->get();
                
        $aux = $sql->row();
        if($aux){
            $obj = new stdClass();
            $obj->codigo = $aux->usua_codigo;
            $obj->nombre = $aux->usua_nombre;
            $obj->contrasena = $aux->usua_contrasena;
            
            //$obj->permisos = $this->listar_permisos_tablas(array("usu_codigo"=>$obj->codigo));
            
            return $obj;
        }
  		
        return false;
    }
    
    public function listar_permisos_tablas($where){
        
		$sql= $this->db->select('*')
					->from('s_usuarios_permisos_tablas')
                    ->where($where)
					->get();
        
		$result = $sql->result();
        $lista = array();
        
		foreach($result as $aux){
            $obj = new stdClass();
			$obj->usuario = $aux->usua_codigo;
			$obj->permiso = $aux->perm_codigo;
			$obj->tabla = $aux->tab_codigo;
            
            $where["tab_codigo"] = $obj->tabla;
            $obj->campos = $this->listar_permisos_campos($where);
            
			$lista[] = $obj;
		}
		return $lista;
	}
    
    public function listar_permisos_campos($where){
        
		$sql= $this->db->select('*')
					->from('s_usuarios_permisos_campos as pcam')
                    ->join('s_campos as cam','pcam.cam_codigo = cam.cam_codigo')
                    ->where($where)
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
 
 }