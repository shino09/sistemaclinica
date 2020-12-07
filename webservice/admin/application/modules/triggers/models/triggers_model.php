<?php
if (!defined ('BASEPATH')) exit ('no direct script acces allowed');

class Triggers_model extends CI_Model {
    
    private $tabla = 's_triggers';
    function __construct(){
        parent::__construct();
    }
    
    ### mantenedor ###
    public function  nextId(){
        $this->db->select_max("trig_codigo","maximo");
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
        return $this->obtener(array('trig.trig_codigo'=>$codigo));
	}

	public function obtener($where){

		$sql= $this->db->select('*')
					->from($this->tabla.' as trig')
                    ->join('s_tablas as tab','trig.tab_codigo = tab.tab_codigo')
                    ->join('s_tipo_triggers as ttri','trig.ttri_codigo = ttri.ttri_codigo')
                    ->join('s_tipo_accion_triggers as tatr','trig.tatr_codigo = tatr.tatr_codigo')
					->where($where)
					->get();

		$aux = $sql->row();
		if($aux){
            $obj = new stdClass();
			$obj->codigo = $aux->trig_codigo;
			$obj->nombre = $aux->trig_nombre;
            $obj->nombre_trigger = $aux->trig_nombre_trigger;
			$obj->sql = $aux->trig_sql;
			
            $obj->accion = new stdClass();
            $obj->accion->codigo = $aux->tatr_codigo;
            $obj->accion->nombre = $aux->tatr_nombre;
            
            $obj->tipo = new stdClass();
            $obj->tipo->codigo = $aux->ttri_codigo;
            $obj->tipo->nombre = $aux->ttri_nombre;
            
            $obj->tabla = new stdClass();
            $obj->tabla->codigo = $aux->tab_codigo;
            $obj->tabla->nombre = $aux->tab_nombre;
            
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
					->from($this->tabla.' as trig')
                    ->join('s_tablas as tab','trig.tab_codigo = tab.tab_codigo')
                    ->join('s_tipo_triggers as ttri','trig.ttri_codigo = ttri.ttri_codigo')
                    ->join('s_tipo_accion_triggers as tatr','trig.tatr_codigo = tatr.tatr_codigo')
					->get();

		$result = $sql->result();
        $lista = array();
        
		foreach($result as $aux){
            $obj = new stdClass();
			$obj->codigo = $aux->trig_codigo;
			$obj->nombre = $aux->trig_nombre;
            $obj->nombre_trigger = $aux->trig_nombre_trigger;
			$obj->sql = $aux->trig_sql;
			
            $obj->accion = new stdClass();
            $obj->accion->codigo = $aux->tatr_codigo;
            $obj->accion->nombre = $aux->tatr_nombre;
            
            $obj->tipo = new stdClass();
            $obj->tipo->codigo = $aux->ttri_codigo;
            $obj->tipo->nombre = $aux->ttri_nombre;
            
            $obj->tabla = new stdClass();
            $obj->tabla->codigo = $aux->tab_codigo;
            $obj->tabla->nombre = $aux->tab_nombre;
            
			$lista[] = $obj;
		}
		return $lista;

	}
    
}