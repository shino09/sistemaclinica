<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Modulo_model extends CI_Model
{
    public $usuario,$codigoTabla,$tabla,$permiso;
    public $limit,$offset,$where, $having;
    public $orden = array(), $group = array(), $join = array();
    
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
            $obj->nulo = $aux->cam_nulo;
            
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
    
    #lista la informacion
    public function listar(){
        
        #agrega where
        if(is_array($this->where)){
            foreach($this->where as $wh){
                $this->db->where($wh);
            }
        }
        elseif($this->where)
            $this->db->where($this->where);
        
        #agrega having
        if(is_array($this->having)){
            foreach($this->having as $ha){
                $this->db->having($ha);
            }
        }
        elseif($this->having)
            $this->db->having($this->having);
        
        #agrega limit y/o offset
        if($this->limit && $this->offset)
            $this->db->limit($this->limit,$this->offset);
        elseif($this->limit)
            $this->db->limit($this->limit);
        
        #agrega order by
        if($this->orden){
            foreach($this->orden as $cam=>$ord){
                if(!is_numeric($cam))
                    $this->db->order_by($cam,$ord);
                else
                    $this->db->order_by($ord);
            }
        }
        
        #agrega group by
        if($this->group)
            $this->db->group_by($this->group);
        
        $select = $coma = '';
        if($this->join){
            foreach($this->join as $jo){
				
                #agrega los join
				$this->db->join($jo->tabla,$jo->on." and ".$jo->prefijo."_visible = 1",$jo->tipo);
                
                #agrega los campos de los join
                foreach($jo->campos as $cam){
                    $select .= $coma.$cam->nombre_campo.' '.$cam->nombre_slug;
                    $coma = ',';
                }
            }
        }
        
        #agrega los campos del from
        foreach($this->tabla->campos as $cam){
            $select .= $coma.$cam->nombre_campo.' as '.$cam->nombre_slug;
            $coma = ',';
        }
        
        if(!$select)
            $select = '*';
        
        #ejecuta la consulta
        $sql = $this->db->select($select)
                ->from($this->tabla->nombre_tabla)
                ->where($this->tabla->prefijo."_visible = 1")
                ->get();
        
        $result = $sql->result();
        $lista = array();
        
        foreach($result as $aux){
            $obj = new stdClass();
            foreach($this->tabla->campos as $cam){
                $nombre = $cam->nombre_retorno;
                $campo = $cam->nombre_slug;
                $obj->$nombre = $aux->$campo;
            }
            
            if($this->join){
                foreach($this->join as $jo){
                    $tabla = $jo->tabla;
                    $obj->$tabla = new stdClass();
                    foreach($jo->campos as $cam){
                        $nombre = $cam->nombre_retorno;
                        $campo = $cam->nombre_slug;
                        $obj->$tabla->$nombre = $aux->$campo;
                    }
                }
            }
            
            $lista[] = $obj;
        }
        
        return $lista;
    }
    
    
    #obtiene una tupla
    public function obtener(){
        
        #agrega group by
        if($this->group)
            $this->db->group_by($this->group);
        
        $select = $coma = '';
        if($this->join){
            foreach($this->join as $jo){
				
                #agrega join
                $this->db->join($jo->tabla,$jo->on." and ".$jo->prefijo."_visible = 1",$jo->tipo);
                
                #concatena los campos de los join
                foreach($jo->campos as $cam){
                    $select .= $coma.$cam->nombre_campo.' '.$cam->nombre_slug;
                    $coma = ',';
                }
            }
        }
        
        #concatena los campos del from
        foreach($this->tabla->campos as $cam){
            $select .= $coma.$cam->nombre_campo.' '.$cam->nombre_slug;
            $coma = ',';
        }
        
        if(!$select)
            $select = '*';
        
        #agrega where
        if(is_array($this->where)){
            foreach($this->where as $wh){
                $this->db->where($wh);
            }
        }
        else
            $this->db->where($this->where);
        
        #agrega having
        if(is_array($this->having)){
            foreach($this->having as $ha){
                $this->db->having($ha);
            }
        }
        elseif($this->having)
            $this->db->having($this->having);
        
		#agrega group by
        if($this->group)
            $this->db->group_by($this->group);
        
        #ejecuta la consulta
        $sql = $this->db->select($select)
                ->from($this->tabla->nombre_tabla)
                ->where($this->tabla->prefijo."_visible = 1")
                ->get();

        $aux = $sql->row();
        if($aux){
            $obj = new stdClass();
            foreach($this->tabla->campos as $cam){
                $nombre = $cam->nombre_retorno;
                $campo = $cam->nombre_slug;
                $obj->$nombre = $aux->$campo;
            }
            
            if($this->join){
                foreach($this->join as $jo){
                    $tabla = $jo->tabla;
                    $obj->$tabla = new stdClass();
                    foreach($jo->campos as $cam){
                        $nombre = $cam->nombre_retorno;
                        $campo = $cam->nombre_slug;
                        $obj->$tabla->$nombre = $aux->$campo;
                    }
                }
            }
            
            return $obj;
        }
        
        return false;

    }
    
    #retorna los correlativos de todas las claves primarias de la tabla
    public function nextId(){
        
        $sql = $this->db->select("*")
                ->from('s_campos')
                ->where(array("tab_codigo"=>$this->tabla->codigo,"cam_primaria"=>1))
                ->where("cam_tabla_relacion is null")
                ->get();
        
        $primaria = array();
        $primarias = $sql->result();
        
        if(!$primarias)
            return false;
        
        foreach($primarias as $aux){
            $this->db->select_max($aux->cam_nombre_campo,"maximo");
            $sql = $this->db->get($this->tabla->nombre_tabla);

            $primaria[$aux->cam_nombre_campo] = $sql->row()->maximo+1;
        }
    
		return $primaria;
    }
    
    public function insertar(){
        if($primarias = $this->nextId())
            $this->campos = array_merge($this->campos,$primarias);
        
        if($this->db->insert($this->tabla->nombre_tabla,$this->campos))
            return $primarias;
        else
            return false;
    }
    
    public function actualizar(){
        
        #agrega where
        if(is_array($this->where)){
            foreach($this->where as $k=>$wh){
                if(is_numeric($k))
                    $this->db->where($wh);
                else
                    $this->db->where($k.' = '.$wh);
            }
        }
        else
            $this->db->where($this->where);
            
        return $this->db->update($this->tabla->nombre_tabla,$this->campos);
    }
    
    public function eliminar(){
        
        #agrega where
        if(is_array($this->where)){
            foreach($this->where as $k=>$wh){
                if(is_numeric($k))
                    $this->db->where($wh);
                else
                    $this->db->where($k.' = '.$wh);
            }
        }
        else
            $this->db->where($this->where);
            
        $campo = array($this->tabla->prefijo."_visible"=>0);
        return $this->db->update($this->tabla->nombre_tabla,$campo);
    }
	
	public function last_query(){
        return $this->db->last_query();
    }
}
