<?php
if (!defined ('BASEPATH')) exit ('no direct script acces allowed');

class Tipo_campo_model extends CI_Model {
    
    private $tabla = 's_tipos_campo';
    
    function __construct(){
        parent::__construct();
    }
    
    public function obtener_por_codigo($codigo){
        return $this->obtener(array('tic_codigo'=>$codigo));
	}

	public function obtener($where){

		$sql= $this->db->select('*')
					->from($this->tabla)
					->where($where)
					->get();

		$aux = $sql->row();
		if($aux){
            $obj = new stdClass();
			$obj->codigo = $aux->tic_codigo;
			$obj->nombre = $aux->tic_nombre;
			$obj->tipo = $aux->tic_tipo;
			$obj->longitud = $aux->tic_longitud;
            
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
			$obj->codigo = $aux->tic_codigo;
			$obj->nombre = $aux->tic_nombre;
            $obj->tipo = $aux->tic_tipo;
			$obj->longitud = $aux->tic_longitud;
            
			$lista[] = $obj;
		}
		return $lista;

	}
    
    
    /* condiciones */
    public function obtener_condicion($where = false){
        
        if($where)
            $this->db->where($where);
        
		$sql= $this->db->select('*')
					->from('s_condiciones_campos')
					->get();

		$aux = $sql->row();
        
		if($aux){
            $obj = new stdClass();
			$obj->codigo = $aux->conc_codigo;
			$obj->nombre = $aux->conc_nombre;
			$obj->acepta_valor = $aux->conc_acepta_valor;
            
			return $obj;
		}
		return false;

	}
    
    public function listar_condiciones($where = false){
        
        if($where)
            $this->db->where($where);
        
		$sql= $this->db->select('*')
					->from('s_condiciones_campos_tipos_campo ct')
					->join('s_condiciones_campos c','ct.conc_codigo = c.conc_codigo')
                    ->order_by("conc_orden ASC")
					->get();

		$result = $sql->result();
        $lista = array();
        
		foreach($result as $aux){
            $obj = new stdClass();
			$obj->codigo = $aux->conc_codigo;
			$obj->nombre = $aux->conc_nombre;
			$obj->acepta_valor = $aux->conc_acepta_valor;
            
			$lista[] = $obj;
		}
		return $lista;

	}
}
