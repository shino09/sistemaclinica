<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class Inicio extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        
        $this->modulo_usuario = 21;
        $this->modulo_perfil_permiso = 26;
    }
    
	public function index()
    {  
    
        
        #si la sesion esta activa se envia al escritorio
        if($this->session->userdata('usuario_sa'))
           // redirect('/mantenedores/kinesiologos/');
            redirect('/fichas_clinicas/pacientes/');  
        
        #title
        $this->layout->title('Intranet');
        
        #metas
        $this->layout->setMeta('title','Intranet');
        $this->layout->setMeta('description','Intranet');
        $this->layout->setMeta('keywords','Intranet');
        
        #validation
        $this->layout->css('/js/jquery/validation-engine/css/validationEngine.jquery.css');
        $this->layout->js('/js/jquery/validation-engine/js/jquery.validationEngine.js');
        $this->layout->js('/js/jquery/validation-engine/js/languages/jquery.validationEngine-es.js');
        
        #noty
        $this->layout->js('/js/jquery/noty/packaged/jquery.noty.packaged.js');
        
        #js
        $this->layout->js('/js/sistema/index/login.js');
        
        
        $contenido['home_indicador'] = true;
        
        #CSS Login
       // $this->layout->css('/css/login.css');
        
        
   
        
   
        
        $this->layout->view('login',$contenido);
        
    }
	
	public function login(){
		
		if($this->input->post()){
		
			#models
			$this->load->model('usuario','objUsuario');
			
			#validacion
			$this->form_validation->set_message('required', '* %s es obligatorio');
			$this->form_validation->set_message('valid_email', '* El email no es válido');
			$this->form_validation->set_error_delimiters('<div>','</div>');
			
			if(!$this->form_validation->run('login')){
				$error = validation_errors();
				echo json_encode(array("result"=>false,"msg"=>$error));
			}
			else
			{
				try{
				    $email = $this->input->post('email');
				    $contrasena = md5($this->input->post('contrasena'));
				    $where = "usu_email = '$email' and usu_contrasena = '$contrasena'";
					if($usuario = $this->ws->obtener($this->modulo_usuario,$where)){

                        //print_array($usuario);die('dsdsdsf');
						$this->session->set_userdata('usuario_sa',$usuario);
                        
						echo json_encode(array("result"=>true));
					}
					else
						echo json_encode(array("result"=>false,"msg"=>"Los datos ingresados no son válidos."));
					
				}
				catch(Exception $e){
					//echo json_encode(array("result"=>false,"msg"=>$e->getMessage()));
					echo json_encode(array("result"=>false,"msg"=>"Ha ocurrido un error inesperado. Por favor, inténtelo nuevamente."));
				}
			}
		}
		else
			redirect('/');
	
	}


      public function notificacion_vista(){
       // if($this->input->post() && $this->session->userdata('usuario_sitio')){
            $notificacion = $this->input->post('notificacion');
            
            $datos['not_visto'] = 1;
            $where = "not_codigo = $notificacion";
            $this->ws->actualizar(40,$datos,$where);
            
            echo json_encode(array("result"=>true));
        //}
    }
    
/*
         ################ se genera la notificacion ##################
                $not['not_notificacion'] = "<b>Mensaje de Contabilidad:</b><br />".$notificacion;
                $not['not_usuario_perfil'] = $monitor->usuariosperfiles->codigo;
                $not['not_enlace'] = "";
                $not['not_fecha'] = date('Y-m-d H:i:s');
                $this->ws->insertar(81,$not);
                #############################################################*/
    
    public function recuperar_contrasena(){
        
        if($this->input->post()){
            
            #validacion
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            
			$this->form_validation->set_message('required', '* %s es obligatorio');
			$this->form_validation->set_message('valid_email', '* %s no es válido');
			$this->form_validation->set_error_delimiters('<div>','</div>');
			
			if(!$this->form_validation->run()){
				$error = validation_errors();
				echo json_encode(array("result"=>false,"msg"=>$error));
                exit;
			}
            
            $email = $this->input->post('email');
            $where = "usu_email = '$email'";
            if($usuario = $this->ws->obtener($this->modulo_usuario,$where)){
                
                $new_pass = rand();
                
                $datos = new stdClass();
                $datos->email = $email;
                $datos->asunto = 'Recuperar Contrasena en el sistema de Teveuci';
                $datos->cuerpo = '
                    <h1 style="font-size:24px; color:#333; margin-bottom:30px;">Hola '.$usuario->nombre.' '.$usuario->primer_apellido.' '.$usuario->segundo_apellido.'</h1>
                    <p style="font-size:15px; color:#333; margin:0 0 30px;">Has solicitado recuperar tu contraseña en el sistema de SURACTIVO.</p>
                    <p style="font-size:15px; color:#333; margin:0 0 30px;">Para iniciar sesión debes hacerlo con los siguientes datos:</p>
                    <table border="0" cellpadding="10" cellspacing="0" style="font-size:15px; margin:0 0 40px;">
                        <tbody>
                            <tr bgcolor="#f0f0f0">
                                <td bgcolor="#f0f0f0">Email:</td>
                                <td bgcolor="#f0f0f0">'.$email.'</td>
                            </tr>
                            <tr>
                                <td>Contraseña:</td>
                                <td>'.$new_pass.'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p style="font-size:15px; color:#333; margin:0 0 60px;">La contraseña enviada ha sido generada por el sistema, por lo que debes moficarla una vez que hayas iniciado sesión.</p>
                ';
                
                $this->email_model->enviar($datos);
                
                #actualiza la contraseña para el usuario
                $this->ws->actualizar($this->modulo_usuario,array("usu_contrasena"=>md5($new_pass)),"usu_codigo = {$usuario->codigo}");
                
                echo json_encode(array("result"=>true));
            }
            else{
                echo json_encode(array("result"=>false,"msg"=>'El email indicado no se encuentra registrado'));
                exit;
            }
        }
    }
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}
    
    public function solicitar_perfil(){
        
        if($this->input->post()){
            
            $datos['soli_perfil'] = $this->input->post('perfil');
            $datos['soli_motivo'] = $this->input->post('motivo');
            $datos['soli_tiempo'] = $this->input->post('tiempo');
            $datos['soli_estado'] = 1;
            $datos['soli_fecha_solicitud'] = date('Y-m-d H:i:s');
            $datos['soli_usuario'] = $this->session->userdata('usuario_sa')->codigo;
            
            $id = $this->ws->insertar(28,$datos);
            
            #crea la notificacion de solicitud de perfil para los usuarios que tienen permiso para aprobar perfil
            $this->ws->joinInner(23,"usu_perfil = per_codigo"); #perfiles
            $this->ws->joinInner(26,"per_codigo = perf_perfil"); #perfil_permisos
            $this->ws->group("usu_codigo");
            $usuarios = $this->ws->listar(21,"usu_codigo <> {$datos['soli_usuario']} and usu_estado = 1 and perf_permiso = 52");
            if($usuarios){
                foreach($usuarios as $aux){
                    
                    #crea la notificacion para cada usuario
                    $datosN = new stdClass();
                    $datosN->tipo = 7;
                    $datosN->registro = $this->ws->obtener(28,"soli_codigo = {$id->soli_codigo}");
                    $datosN->destino = $aux;
                    $this->notificaciones_model->registrar($datosN);
                }
            }
            
            echo json_encode(array("result"=>true));
        }
    }
    
    public function solicitudes_perfil($codigo){
        
        #si la sesion no esta activa se envia al login
        if(!$this->session->userdata('usuario_sa'))
            redirect('/');
        
		#title
		$this->layout->title('Solicitud de Perfil');
		
		#metas
		$this->layout->setMeta('title','Solicitud de Perfil');
		$this->layout->setMeta('description','Solicitud de Perfil');
		$this->layout->setMeta('keywords','Solicitud de Perfil');
		
        #validation
        $this->layout->css('/js/jquery/validation-engine/css/validationEngine.jquery.css');
		$this->layout->js('/js/jquery/validation-engine/js/jquery.validationEngine.js');
		$this->layout->js('/js/jquery/validation-engine/js/languages/jquery.validationEngine-es.js');
        
        #noty
        $this->layout->js('/js/jquery/noty/packaged/jquery.noty.packaged.js');
        
        #perfil solicitado
        $this->ws->joinInner(21,"soli_usuario = usu_codigo"); #usuarios
        $this->ws->joinInner(27,"soli_tiempo = sol_codigo"); #solicitudes_perfil_tiempo
        $this->ws->joinInner(23,"soli_perfil = perf_codigo"); #perfiles
        $contenido['solicitud'] = $this->ws->obtener(28,"soli_codigo = {$codigo}");
        
        #view
        $this->layout->view('solicitudes-perfil',$contenido);
    }
    
    public function aprobar_perfil(){
        
        if($this->input->post()){
            
            $codigo = $this->input->post('codigo');
            
            $this->ws->joinInner(27,"soli_tiempo = sol_codigo"); #solicitudes_perfil_tiempo
            $this->ws->joinInner(21,"soli_usuario = usu_codigo"); #usuarios
            $solicitud = $this->ws->obtener(28,"soli_codigo = $codigo");
            
            $datos['soli_fecha_aprobacion'] = date('Y-m-d H:i:s');
            $datos['soli_fecha_caducidad'] = date('Y-m-d H:i:s',strtotime('+'.$solicitud->solicitudes_perfil_tiempo->tiempo_minutos.' minutes',strtotime($datos['soli_fecha_aprobacion'])));
            $datos['soli_estado'] = 2;
            $this->ws->actualizar(28,$datos,"soli_codigo = $codigo");
            
            
            #crea la notificacion para el usuario que solicito el perfil
            $datosN = new stdClass();
            $datosN->tipo = 8;
            $datosN->registro = $this->ws->obtener(23,"per_codigo = {$solicitud->perfil}");
            $datosN->destino = $solicitud->usuarios;
            $datosN->usuario = $this->session->userdata('usuario_sa');
            $this->notificaciones_model->registrar($datosN);
            
            echo json_encode(array("result"=>true));
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */