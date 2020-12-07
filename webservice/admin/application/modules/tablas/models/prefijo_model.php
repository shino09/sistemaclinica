<?php
if (!defined ('BASEPATH')) exit ('no direct script acces allowed');

class Prefijo_model extends CI_Model {
    
    private $tabla = 's_prefijos';
    function __construct(){
        parent::__construct();
    }
    
    ### mantenedor ###
    public function  nextId(){
        $this->db->select_max("pref_codigo","maximo");
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
    ### fin mantenendor ###


    public function obtener_por_codigo($codigo){
        return $this->obtener(array('pref_codigo'=>$codigo));
	}

	public function obtener($where){

		$sql= $this->db->select('*')
					->from($this->tabla)
					->where($where)
					->get();

		$aux = $sql->row();
		if($aux){
            $obj = new stdClass();
			$obj->codigo = $aux->pref_codigo;
			$obj->nombre = $aux->pref_nombre;
            
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
					->from($this->tabla)
					->get();

		$result = $sql->result();
        $lista = array();
        
		foreach($result as $aux){
            $obj = new stdClass();
			$obj->codigo = $aux->pref_codigo;
			$obj->nombre = $aux->pref_nombre;
            
			$lista[] = $obj;
		}
		return $lista;

	}
    
}
