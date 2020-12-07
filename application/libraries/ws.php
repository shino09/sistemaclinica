<?php

class Ws{

    private $key, $url_base, $campos = array(), $wheres = array(), $order_by = array(), $group_by = array(), $havings = array(), $joins = array(), $limits, $offset;

    public function __construct(){

        //webservice
       # $this->key = 'd7160fb4619bcd46ae3e8f81e767ab4d';
       # $this->url_base = 'http://abaco.aeurus.cl/webservice/api/';

       //webservice2
        $this->key = 'dacb009cc3d2b9f48bad233afa657533';
        $this->url_base = 'http://teveuci.aeurus.cl/webservice/api/';

    }

    #campos
    public function select($campo){
        if(is_array($campo))
            $this->campos = $campo;
        else
            $this->campos[] = $campo;
    }

    #where
    public function where($where){
        if(is_array($where)){
            foreach($where as $k=>$aux){
                if(is_numeric($k))
                    $this->wheres[] = $aux;
                else
                    $this->wheres[] = $k.' = '.$aux;
            }
        }
        else
            $this->wheres[] = $where;
    }

    #having
    public function having($having){
        if(is_array($having)){
            foreach($having as $k=>$aux){
                if(is_numeric($k))
                    $this->havings[] = $aux;
                else
                    $this->havings[] = $k.' = '.$aux;
            }
        }
        else
            $this->havings[] = $having;
    }

    #order by
    public function order($order){
        if(is_array($order)){
            foreach($order as $k=>$aux){
                if(is_numeric($k)){
                    list($campo,$tipo) = explode(' ',trim($aux));
                    $this->order_by[$campo] = $tipo;
                }
                else
                    $this->order_by[$k] = trim($aux);
            }
        }
        else{
            list($campo,$tipo) = explode(' ',trim($order));
            $this->order_by[$campo] = $tipo;
        }

    }

    #group by
    public function group($group){
        if(is_array($group)){
            foreach($group as $k=>$aux){
                $this->group_by[] = trim($aux);
            }
        }
        else
            $this->group_by[] = trim($group);

    }

    #limit
    public function limit($limit, $offset = false){
        if(is_numeric($limit)){
            $this->limits = $limit;
        }

        if($offset && is_numeric($offset))
            $this->offset = $offset;
    }

    #join inner
    public function joinInner($tabla,$on,$campos = '2'){
        $this->join($tabla,$on,$campos,'inner');
    }

    #join left
    public function joinLeft($tabla,$on,$campos = '2'){
        $this->join($tabla,$on,$campos,'left');
    }

    #join right
    public function joinRight($tabla,$on,$campos = '2'){
        $this->join($tabla,$on,$campos,'right');
    }

    #join
    public function join($tabla,$on,$campos,$tipo = 'inner'){
        $joins = array("tabla"=>$tabla,"tipo"=>$tipo,"on"=>$on);

        if($campos && $campos != '2')
            $joins['campos'] = $campos;
        elseif(!$campos)
            $joins['campos'] = false;

        $this->joins[] = $joins;
    }

    #insertar
    public function insertar($tabla,$datos){

        if(!is_numeric($tabla))
            return false;

        $ws = array(
            "url" => "insertar",
            "tabla" => $tabla,
            "campos" => $datos
        );

        $response = $this->curl($ws);
        return ($response->result)?$response->datos:false;
    }

    #actualizar
    public function actualizar($tabla, $datos, $where = false){

        if($where){
            if(is_array($where)){
                foreach($where as $k=>$aux){
                    if(is_numeric($k)){
                        $this->wheres[] = $aux;
                    }
                    else
                        $this->wheres[] = $k.' = '.$aux;
                }
            }
            else
                $this->wheres[] = $where;
        }

        if(!$this->wheres || !is_numeric($tabla))
            return false;

        $ws = array(
            "url" => "actualizar",
            "tabla" => $tabla,
            "where" => $this->wheres,
            "campos" => $datos
        );

        $response = $this->curl($ws);
        return $response->result;
    }

    #eliminar
    public function eliminar($tabla, $where = false){

        if($where){
            if(is_array($where)){
                foreach($where as $k=>$aux){
                    if(is_numeric($k)){
                        $this->wheres[] = $aux;
                    }
                    else
                        $this->wheres[] = $k.' = '.$aux;
                }
            }
            else
                $this->wheres[] = $where;

        }

        if(!$this->wheres || !is_numeric($tabla))
            return false;

        $ws = array(
            "url" => "eliminar",
            "tabla" => $tabla,
            "where" => $this->wheres
        );
        $response = $this->curl($ws);
        return $response->result;
    }

    #obtener 1 tupla
    public function obtener($tabla,$where = false){

        if($where){
            if(is_array($where)){
                foreach($where as $k=>$aux){
                    if(is_numeric($k))
                        $this->wheres[] = $aux;
                    else
                        $this->wheres[] = $k.' = '.$aux;
                }
            }
            else
                $this->wheres[] = $where;
        }

        if(!$this->wheres || !is_numeric($tabla))
            return false;

        $ws = array(
            "url" => "obtener",
            "tabla" => $tabla,
            "where" => $this->wheres
        );

        if($this->campos)
            $ws['campos'] = $this->campos;

        if($this->group_by)
            $ws['group'] = $this->group_by;

        if($this->joins)
            $ws['join'] = $this->joins;

        $response = $this->curl($ws);
        return ($response->result)?$response->datos:false;
    }

    public function listar($tabla,$where = false){

        if($where){
            if(is_array($where)){
                foreach($where as $k=>$aux){
                    if(is_numeric($k))
                        $this->wheres[] = $aux;
                    else
                        $this->wheres[] = $k.' = '.$aux;
                }
            }
            else
                $this->wheres[] = $where;
        }

        if(!is_numeric($tabla))
            return false;

        $ws = array(
            "url" => "listado",
            "tabla" => $tabla
        );

        if($this->campos)
            $ws['campos'] = $this->campos;

        if($this->wheres)
            $ws['where'] = $this->wheres;

        if($this->havings)
            $ws['having'] = $this->havings;

        if($this->limits)
            $ws['limit'] = $this->limits;

        if($this->offset)
            $ws['offset'] = $this->offset;

        if($this->group_by)
            $ws['group'] = $this->group_by;

        if($this->order_by)
            $ws['order'] = $this->order_by;

        if($this->joins)
            $ws['join'] = $this->joins;

        $response = $this->curl($ws);
        return ($response->result)?$response->datos:array();
    }

    #llamada al ws
    public function curl($datos){

        #limpia todas las variables
        $this->campos = $this->wheres = $this->order_by = $this->group_by = $this->havings = $this->joins = array();
        $this->limits = $this->offset = "";
        #################################

        if(!isset($datos['url']) || !$datos['url'])
            return false;

        $url_base = $this->url_base.$datos['url'].'/';
        unset($datos['url']);

        if(isset($datos['format']) && $datos['format']){
            $url_base .= 'format/'.$datos['format'].'/';
            $datos['format'];
        }
        else
            $url_base .= 'format/json/';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url_base,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($datos),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "x-api-key: ".$this->key
            )
        ));
        $result = curl_exec($curl);
        curl_close($curl);
        //echo $result.'<br /><br />';
        $response = json_decode($result);
        if(!isset($response->result)){
            $response->result = false;
            $response->msg = "Ha ocurrido un error inesperado";
        }

        return $response;
    }

}


?>
