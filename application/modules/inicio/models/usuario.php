<?php
class Usuario extends CI_Model
{
	
	function __construct(){
		parent::__construct();
	}
	
	public function obtener_por_codigo($codigo){
		return $this->obtener("u_codigo = $codigo");
	}
	
	public function login($email,$contrasena){
		$contrasena = md5($contrasena);
		return $this->obtener("u_email = '$email' and u_contrasena = '$contrasena'");
	}
	
	public function obtener($where){
		
		$this->db->where($where);
		$sql = $this->db->get("usuario");
		$aux = $sql->row();
		if($aux){
			$obj = new stdClass();
			$obj->codigo = $aux->u_codigo;
			$obj->nombre = $aux->u_nombre;
			$obj->email = $aux->u_email;
			
			$sql->free_result();
			return $obj;
		}
		$sql->free_result();
		return false;
	}

}