<?php
if (!defined ('BASEPATH')) exit ('no direct script acces allowed');

class Tabla_model extends CI_Model {

    private $tabla = 's_tablas';
    function __construct(){
        parent::__construct();

        #models
        $this->load->model('tablas/campo_model','objCampo');
    }

    ### mantenedor ###
    public function  nextId(){
        $this->db->select_max("tab_codigo","maximo");
		$sql = $this->db->get($this->tabla);

		return $sql->row()->maximo+1;
    }

    public function agregar($datos){
        return $this->db->insert($this->tabla,$datos);
    }

    public function actualizar($datos,$where){
        return $this->db->update($this->tabla,$datos,$where);
    }

    public function query($sql){
        return $this->db->query($sql);
    }
    ### fin mantenendor ###


    public function obtener_por_codigo($codigo){
        return $this->obtener(array('tab_codigo'=>$codigo));
	}

	public function obtener($where, $todas = false){

        if(!$todas)
            $this->db->where("tab_sistema = 0");

		$sql= $this->db->select('*')
					->from($this->tabla)
					->where($where)
					->get();

		$aux = $sql->row();
		if($aux){
            $obj = new stdClass();
			$obj->codigo = $aux->tab_codigo;
			$obj->nombre = $aux->tab_nombre;
			$obj->nombre_tabla = $aux->tab_nombre_tabla;
            $obj->prefijo = $aux->tab_prefijo;
            $obj->vista = $aux->tab_vista;
            $obj->sql = $aux->tab_sql;
            $obj->comentario = $aux->tab_comentario;
            $obj->visible = $aux->tab_visible;

            $obj->campos = $this->objCampo->listar(array("tab_codigo"=>$obj->codigo));

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
                    ->where("tab_sistema = 0 and tab_visible = 1")
                    ->order_by("tab_prefijo ASC")
					->get();

		$result = $sql->result();
        $lista = array();

		foreach($result as $aux){
            $obj = new stdClass();
			      $obj->codigo = $aux->tab_codigo;
			$obj->nombre = $aux->tab_nombre;
			$obj->nombre_tabla = $aux->tab_nombre_tabla;
            $obj->vista = $aux->tab_vista;
            $obj->sql = $aux->tab_sql;
			$obj->prefijo = $aux->tab_prefijo;
            $obj->comentario = $aux->tab_comentario;

            $obj->campos = $this->objCampo->listar(array("tab_codigo"=>$obj->codigo));

			$lista[] = $obj;
		}
		return $lista;

	}
}
