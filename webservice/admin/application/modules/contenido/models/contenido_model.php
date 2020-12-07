<?php
if (!defined ('BASEPATH')) exit ('no direct script acces allowed');

class Contenido_model extends CI_Model {

    public $tabla;
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
        return $this->db->insert($this->tabla->nombre_tabla,$datos);
    }

    public function actualizar($datos,$where){
        return $this->db->update($this->tabla->nombre_tabla,$datos,$where);
    }

    public function query($sql){
        return $this->db->query($sql);
    }
    ### fin mantenendor ###

	public function obtener($where, $visible = true){

        if($visible)
            $this->db->where($this->tabla->prefijo."_visible = 1");

		$sql = $this->db->select('*')
					->from($this->tabla->nombre_tabla)
                    ->where($where)
					->get();

		$aux = $sql->row();
		if($aux){
            $obj = new stdClass();
            $sep = $codigo = '';
            foreach($this->tabla->campos as $cam){

                $campo = $cam->nombre_campo;
                $obj->$campo = $aux->$campo;

                if($cam->primaria){
                    $codigo .= $sep.$aux->$campo;
                    $sep = '-';
                }
            }
            $obj->codigo = $codigo;

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
					->from($this->tabla->nombre_tabla)
                    ->where($this->tabla->prefijo."_visible = 1")
					->get();

		$result = $sql->result();
        $lista = array();

		foreach($result as $aux){
            $obj = new stdClass();
            $sep = $codigo = '';
            foreach($this->tabla->campos as $cam){

                $campo = $cam->nombre_campo;
                $obj->$campo = $aux->$campo;

                if($cam->primaria){
                    $codigo .= $sep.$aux->$campo;
                    $sep = '-';
                }
            }
            $obj->codigo = $codigo;
			$lista[] = $obj;
		}
		return $lista;

	}


    public function listar_relacion($tabla_relacion,$campo_relacion, $where = false){

        if($where)
            $this->db->where($where);

		$sql= $this->db->select($campo_relacion->nombre_campo)
					->from($tabla_relacion->nombre_tabla)
                    ->where($tabla_relacion->prefijo."_visible = 1")
					->get();

		$result = $sql->result();
        $lista = array();

		foreach($result as $aux){
            $obj = new stdClass();
            $campo = $campo_relacion->nombre_campo;
            $obj->codigo = $aux->$campo;
			$lista[] = $obj;
		}
		return $lista;

	}
}
