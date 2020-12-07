<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tablajoin_model extends CI_Model
{
    public $usuario,$codigoTabla,$tabla,$permiso;
    
    function __construct()
    {
        parent::__construct();
    }
    
    #obtiene la informacion de la tabla
    public function tabla(){
        
        try{
            $sql = $this->db->select("*")
                    ->from('s_tablas tab')
                    ->join('s_usuarios_permisos_tablas utab','tab.tab_codigo = utab.tab_codigo')
                    ->where(array('tab.tab_codigo'=>$this->codigoTabla,"tab_visible"=>1))
                    ->where(array("usua_codigo"=>$this->usuario,"utab.perm_codigo"=>$this->permiso))
                    ->get();
    
            $aux = $sql->row();
            if($aux){
                $obj = new stdClass();
                $obj->codigo = $aux->tab_codigo;
                $obj->nombre = $aux->tab_nombre;
                $obj->nombre_tabla = $aux->tab_nombre_tabla;
                $obj->prefijo = $aux->tab_prefijo;
                
                $obj->campos = $this->campos();
                
                $obj->relacionadas = $this->relacionadas();
                
                $this->tabla = $obj;
                return true;
            }
        
            return false;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
    
    #obtiene los campos de la tabla
    public function campos(){
        
        $sql = $this->db->select("*")
                ->from('s_campos cam')
                ->join('s_usuarios_permisos_campos ucam','cam.cam_codigo = ucam.cam_codigo')
                ->where(array('tab_codigo'=>$this->codigoTabla,"cam_visible"=>1,"usua_codigo"=>$this->usuario,"perm_codigo"=>$this->permiso))
                ->get();
        
        $result = $sql->result();
        $lista = array();
        
        foreach($result as $aux){
            $obj = new stdClass();
            $obj->codigo = $aux->cam_codigo;
            $obj->nombre = $aux->cam_nombre;
            $obj->nombre_retorno = slug($aux->cam_nombre,'_');
            $obj->nombre_campo = $aux->cam_nombre_campo;
            $obj->nombre_slug = $aux->cam_nombre_campo;
            
            $lista[] = $obj;
        }
        
        return $lista;
    }
    
    #obtiene los codigos de las tablas relacionadas
    public function relacionadas(){
        
        $sql = $this->db->select("cam_tabla_relacion,tab.tab_nombre")
                ->from('s_campos cam')
                ->join('s_usuarios_permisos_campos ucam','cam.cam_codigo = ucam.cam_codigo')
                ->join('s_tablas tab','cam_tabla_relacion = tab.tab_codigo')
                ->join('s_usuarios_permisos_tablas utab','tab.tab_codigo = utab.tab_codigo')
                ->where(array("cam_visible"=>1,"ucam.usua_codigo"=>$this->usuario,"utab.usua_codigo"=>$this->usuario))
                ->where(array("cam.tab_codigo"=>$this->codigoTabla))
                ->group_by('cam_tabla_relacion')
                ->get();
        
        $result = $sql->result();
        $lista = array();
        
        foreach($result as $aux){
            $obj = new stdClass();
            $obj->codigo = $aux->cam_tabla_relacion;
            $obj->nombre = $aux->tab_nombre;
            
            $lista[] = $obj;
        }
        
        return $lista;
    }
}
