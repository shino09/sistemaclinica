<?php
if (!defined ('BASEPATH')) exit ('no direct script acces allowed');

class Campo_model extends CI_Model {
    
    private $tabla = 's_campos';
    function __construct(){
        parent::__construct();
        
        #models
        $this->load->model('tablas/tipo_campo_model','objTipoCampo');
    }
    
    ### mantenedor ###
    public function  nextId(){
        $this->db->select_max("cam_codigo","maximo");
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
        return $this->obtener(array('cam_codigo'=>$codigo));
	}
    
    public function obtener_por_campo($campo){
        return $this->obtener(array('cam_nombre_campo'=>$campo));
	}
    
    public function obtener_asociado($campo){
        return $this->obtener(array('cam_asociado'=>$campo));
	}

	public function obtener($where){

		$sql= $this->db->select('*')
					->from($this->tabla.' as cam')
                    ->join('s_tablas as tab','cam.tab_codigo = tab.tab_codigo')
                    ->join('s_tipos_campo as tic','cam.tic_codigo = tic.tic_codigo')
                    ->join('s_tipos_relacion as tipr','cam.tipr_codigo = tipr.tipr_codigo','left')
					->where($where)
					->get();

		$aux = $sql->row();
		if($aux){
            $obj = new stdClass();
			$obj->codigo = $aux->cam_codigo;
			$obj->nombre = $aux->cam_nombre;
			$obj->nombre_campo = $aux->cam_nombre_campo;
			$obj->tabla_relacion = ($aux->cam_tabla_relacion)?$this->obtener_tabla(array("tab_codigo"=>$aux->cam_tabla_relacion)):'';
			$obj->campo_relacion = ($aux->cam_campo_relacion)?$this->obtener_campo(array("cam_codigo"=>$aux->cam_campo_relacion)):'';
			$obj->primaria = $aux->cam_primaria;
			$obj->longitud = $aux->cam_longitud;
			$obj->predeterminado = $aux->cam_predeterminado;
            $obj->nulo = $aux->cam_nulo;
            $obj->asociado = $aux->cam_asociado;
            $obj->comentario = $aux->cam_comentario;
            $obj->visible = $aux->cam_visible;
            
            $obj->tipo_campo = new stdClass();
            $obj->tipo_campo->codigo = $aux->tic_codigo;
            $obj->tipo_campo->nombre = $aux->tic_nombre;
            $obj->tipo_campo->tipo = $aux->tic_tipo;
            $obj->tipo_campo->longitud = $aux->tic_longitud;
            
            $obj->tipo_relacion = new stdClass();
            $obj->tipo_relacion->codigo = $aux->tipr_codigo;
            $obj->tipo_relacion->nombre = $aux->tipr_nombre;
            
            $obj->tabla = new stdClass();
            $obj->tabla->codigo = $aux->tab_codigo;
            $obj->tabla->nombre = $aux->tab_nombre;
            $obj->tabla->prefijo = $aux->tab_prefijo;
            $obj->tabla->nombre_tabla = $aux->tab_nombre_tabla;
            $obj->tabla->vista = $aux->tab_vista;
            
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
					->from($this->tabla.' as cam')
                    ->join('s_tipos_campo as tic','cam.tic_codigo = tic.tic_codigo')
                    ->join('s_tipos_relacion as tipr','cam.tipr_codigo = tipr.tipr_codigo','left')
                    ->order_by("cam_codigo ASC")
                    ->where("cam_visible = 1")
					->get();

		$result = $sql->result();
        $lista = array();
        
		foreach($result as $aux){
            $obj = new stdClass();
			$obj->codigo = $aux->cam_codigo;
			$obj->nombre = $aux->cam_nombre;
			$obj->nombre_campo = $aux->cam_nombre_campo;
			$obj->tabla_relacion = ($aux->cam_tabla_relacion)?$this->obtener_tabla(array("tab_codigo"=>$aux->cam_tabla_relacion)):'';
			$obj->campo_relacion = ($aux->cam_campo_relacion)?$this->obtener_campo(array("cam_codigo"=>$aux->cam_campo_relacion)):'';
            $obj->primaria = $aux->cam_primaria;
			$obj->longitud = $aux->cam_longitud;
			$obj->predeterminado = $aux->cam_predeterminado;
			$obj->nulo = $aux->cam_nulo;
            $obj->asociado = $aux->cam_asociado;
            $obj->comentario = $aux->cam_comentario;
            
            $obj->tipo_campo = new stdClass();
            $obj->tipo_campo->codigo = $aux->tic_codigo;
            $obj->tipo_campo->nombre = $aux->tic_nombre;
            $obj->tipo_campo->tipo = $aux->tic_tipo;
            $obj->tipo_campo->condiciones = $this->objTipoCampo->listar_condiciones(array("ct.tic_codigo"=>$aux->tic_codigo));
            
            $obj->tipo_relacion = new stdClass();
            $obj->tipo_relacion->codigo = $aux->tipr_codigo;
            $obj->tipo_relacion->nombre = $aux->tipr_nombre;
            
			$lista[] = $obj;
		}
		return $lista;

	}
    
    /* obtener campo relacion */
    public function obtener_campo($where){

		$sql= $this->db->select('*')
					->from($this->tabla.' as cam')
					->where($where)
                    ->where("cam_visible = 1")
					->get();

		$aux = $sql->row();
		if($aux){
            $obj = new stdClass();
			$obj->codigo = $aux->cam_codigo;
			$obj->nombre = $aux->cam_nombre;
			$obj->nombre_campo = $aux->cam_nombre_campo;
			$obj->primaria = $aux->cam_primaria;
			$obj->longitud = $aux->cam_longitud;
			$obj->predeterminado = $aux->cam_predeterminado;
            $obj->nulo = $aux->cam_nulo;
            $obj->asociado = $aux->cam_asociado;
            $obj->comentario = $aux->cam_comentario;
            
			return $obj;
		}
		return false;

	}
    
    
    /* obtener tabla */
    public function obtener_tabla($where, $todas = false){
        
        if(!$todas)
            $this->db->where("tab_sistema = 0");
        
		$sql= $this->db->select('*')
					->from('s_tablas')
					->where($where)
					->get();

		$aux = $sql->row();
		if($aux){
            $obj = new stdClass();
			$obj->codigo = $aux->tab_codigo;
			$obj->nombre = $aux->tab_nombre;
			$obj->nombre_tabla = $aux->tab_nombre_tabla;
            $obj->prefijo = $aux->tab_prefijo;
            $obj->comentario = $aux->tab_comentario;

			return $obj;
		}
		return false;

	}
    
}
