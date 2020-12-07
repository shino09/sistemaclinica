<?php
if (!defined ('BASEPATH')) exit ('no direct script acces allowed');

class Historial_model extends CI_Model {
    
    private $tabla = 's_historial';
    function __construct(){
        parent::__construct();
        
        #models
        $this->load->model('tablas/campo_model','objCampo');
    }
    
    ### mantenedor ###
    public function  nextId(){
        $this->db->select_max("his_codigo","maximo");
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
        return $this->obtener(array('his_codigo'=>$codigo));
	}

	public function obtener($where){

		$sql= $this->db->select('*')
					->from($this->tabla.' as his')
                    ->join('s_historial_accion as hia','his.hia_codigo = hia.hia_codigo')
                    ->join('s_tablas as tab','his.tab_codigo = tab.tab_codigo','left')
                    ->join('s_usuarios as usua','his.usua_codigo = usua.usua_codigo','left')
                    ->where($where)
					->get();

		$aux = $sql->row();
		if($aux){
            $obj = new stdClass();
			$obj->codigo = $aux->his_codigo;
			$obj->nombre_tabla_a = $aux->his_nombre_tabla_a;
			$obj->nombre_tabla_n = $aux->his_nombre_tabla_n;
			$obj->comentario = $aux->his_comentario;
            $obj->deshecha = $aux->his_deshecha;
            list($fecha,$hora) = explode(' ',$aux->his_fecha);
            list($h,$m,$s) = explode(':',$hora);
            $obj->fecha = formatearFecha($fecha).' '.$h.':'.$m;
            
            $obj->tabla = new stdClass();
            $obj->tabla->codigo = $aux->tab_codigo;
            $obj->tabla->nombre = $aux->tab_nombre;
            $obj->tabla->nombre_tabla = $aux->tab_nombre_tabla;
            $obj->tabla->prefijo = $aux->tab_prefijo;
            
            $obj->campo_a = ($aux->his_campo_a)?$this->objCampo->obtener_por_codigo($aux->his_campo_a):'';
            $obj->campo_n = ($aux->his_campo_n)?$this->objCampo->obtener_por_codigo($aux->his_campo_n):'';
            
            $obj->accion = new stdClass();
            $obj->accion->codigo = $aux->hia_codigo;
            $obj->accion->nombre = $aux->hia_nombre;
            
            $obj->usuario = new stdClass();
            $obj->usuario->codigo = $aux->usua_codigo;
            $obj->usuario->nombre = $aux->usua_nombre;
            
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
					->from($this->tabla.' as his')
                    ->join('s_historial_accion as hia','his.hia_codigo = hia.hia_codigo')
                    ->join('s_tablas as tab','his.tab_codigo = tab.tab_codigo','left')
                    ->join('s_usuarios as usua','his.usua_codigo = usua.usua_codigo','left')
                    ->order_by("his_fecha DESC")
					->get();

		$result = $sql->result();
        $lista = array();
        
		foreach($result as $aux){
            $obj = new stdClass();
			$obj->codigo = $aux->his_codigo;
			$obj->comentario = $aux->his_comentario;
			$obj->deshecha = $aux->his_deshecha;
			list($fecha,$hora) = explode(' ',$aux->his_fecha);
            list($h,$m,$s) = explode(':',$hora);
            $obj->fecha = formatearFecha($fecha).' '.$h.':'.$m;

            $obj->tabla = new stdClass();
            $obj->tabla->codigo = $aux->tab_codigo;
            $obj->tabla->nombre = $aux->tab_nombre;
            $obj->tabla->nombre_tabla = $aux->tab_nombre_tabla;
            $obj->tabla->prefijo = $aux->tab_prefijo;
            
            $obj->nombre_tabla_a = $aux->his_nombre_tabla_a;
			$obj->nombre_tabla_n = $aux->his_nombre_tabla_n;
            
            $obj->campo_a = ($aux->his_campo_a)?$this->objCampo->obtener_por_codigo($aux->his_campo_a):'';
            $obj->campo_n = ($aux->his_campo_n)?$this->objCampo->obtener_por_codigo($aux->his_campo_n):'';
            
            $obj->accion = new stdClass();
            $obj->accion->codigo = $aux->hia_codigo;
            $obj->accion->nombre = $aux->hia_nombre;
            
            $obj->usuario = new stdClass();
            $obj->usuario->codigo = $aux->usua_codigo;
            $obj->usuario->nombre = $aux->usua_nombre;
            
			$lista[] = $obj;
		}
		return $lista;

	}
}
