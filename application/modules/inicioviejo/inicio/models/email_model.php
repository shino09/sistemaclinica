<?php
if (!defined ('BASEPATH')) exit ('no direct script acces allowed');

class Email_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    public function recuperar($new_pass, $usuario)
    {
        $correos = $this->input->post("email");
        $contenido = '
            <h1 style="font-size:24px; color:#333; margin-bottom:30px;">Hola '.$usuario->nombre.'</h1>
            <p style="font-size:15px; color:#333; margin:0 0 30px;">Has solicitado recuperar tu contraseña en el sistema de COEMCO.</p>
            <p style="font-size:15px; color:#333; margin:0 0 30px;">Para iniciar sesión debes hacerlo con los siguientes datos:</p>
            <table border="0" cellpadding="10" cellspacing="0" style="font-size:15px; margin:0 0 40px;">
                <tbody>
                    <tr bgcolor="#f0f0f0">
                        <td bgcolor="#f0f0f0">RUT:</td>
                        <td bgcolor="#f0f0f0">'.formatearRut($usuario->rut,true).'</td>
                    </tr>
                    <tr>
                        <td>Nueva Contraseña:</td>
                        <td>'.$new_pass.'</td>
                    </tr>
                </tbody>
            </table>
            <p style="font-size:15px; color:#333; margin:0 0 60px;">La contraseña enviada ha sido generada por el sistema, por lo que debes moficarla una vez que hayas iniciado sesión.</p>
        ';

        $cuerpo = $this->generar_cuerpo($contenido);

        $asunto = "Restauración de password";
  		$this->email->from('envio@suractivo.cl', utf8_decode('Coemco'));
        $this->email->subject(utf8_decode($asunto)." [".date('d/m/y')." ".date('H:i:s')."]");
  		//$this->email->to('rvargas@aeurus.cl');
  		$this->email->to($usuario->email);
        $this->email->message(utf8_decode($cuerpo));
        
        return $this->email->send();
    }

    public function enviar($datos){
        #valida que existan destinatarios
        if(!isset($datos->email) || ($datos->email && !$datos->email))
            return false;
        
        #valida que exista el asunto
        if(!isset($datos->asunto) || ($datos->asunto && !$datos->asunto))
            return false;
        
        #valida que exista el cuerpo
        if(!isset($datos->cuerpo) || ($datos->cuerpo && !$datos->cuerpo))
            return false;
        
        #genera el cuerpo HTML
        $cuerpo = $this->generar_cuerpo($datos->cuerpo);
        
        #se agregan los destinatarios
        $this->email->to($datos->email);
        
        #se agregan las copias si existen
        if(isset($datos->email_copia) && $datos->email_copia){
            
            #se agregan las copias
            $this->email->cc($datos->email_copia);
        }
        
        $this->email->from("envio@suractivo.cl",utf8_decode("Suractivo"));
        $this->email->subject(utf8_decode($datos->asunto)." [".date('d/m/y')." ".date('H:i:s')."]");
        $this->email->message(utf8_decode($cuerpo));
        
        #se agrega el archivo adjunto si existe
        if(isset($datos->archivo) && $datos->archivo){
            
            if(!is_array($datos->archivo))
                $datos->archivo = array($datos->archivo);
                
            foreach($datos->archivo as $aux){
                $this->email->attach($_SERVER['DOCUMENT_ROOT'].$aux);
            }
        }
        
        return $this->email->send();

    }
    
    #genera el cuerpo con una base HTML
    public function generar_cuerpo($contenido){
        $datos['cuerpo_correo'] = $contenido;
        return $this->load->view('inicio/email-default',$datos,true);
    }
}