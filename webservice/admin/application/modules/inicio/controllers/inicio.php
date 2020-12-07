<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class Inicio extends CI_Controller {
    
    function __construct(){
		parent::__construct();
        
	}
    
	public function index()
	{
	   
       #si está logeado no puede estar acá
        if($this->session->userdata('usuario'))
            redirect('/tablas/');
            
		#title
		$this->layout->title('Admin WS Beneplus');
		
		#metas
		$this->layout->setMeta('title','Admin WS Beneplus');
		$this->layout->setMeta('description','Admin WS Beneplus');
		$this->layout->setMeta('keywords','Admin WS Beneplus');
		
		$contenido['home_indicador'] = true;
		
		#js
		$this->layout->js('/js/sistema/index/login.js');
				
		$this->layout->view('inicio',$contenido);
		
	}
	
	public function login(){
		
		if($this->input->post()){

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
					if($this->input->post('email') == 'super@aeurus.cl' && $this->input->post('contrasena') == 'aeurus'){
					   $usuario = new stdClass();
                       $usuario->email = $this->input->post('email');
						$this->session->set_userdata('usuario',$usuario);
						echo json_encode(array("result"=>true,"url"=>base_url().'/tablas/'));
					}
					else
						echo json_encode(array("result"=>false,"msg"=>"Los datos ingresados no son válidos."));

				}
				catch(Exception $e){
					// echo json_encode(array("result"=>false,"msg"=>$e->getMessage()));
					echo json_encode(array("result"=>false,"msg"=>"Ha ocurrido un error inesperado. Por favor, inténtelo nuevamente."));
				}
			}
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}

	public function recuperar(){
		
		if($usuario = $this->session->userdata('usuario')){
			$url = 'escritorio';
			if($usuario->perfil->modulos){
				$url = $usuario->perfil->modulos[0]->url;
			}
			redirect('/'.$url.'/');
		}
		
	   if($this->input->post()){

		   #models
		   $this->load->model('configuracion/usuario_model','objUsuario');
		   $this->load->model('inicio/email_model','objEmail');

		   #validacion
		   $this->form_validation->set_rules('email-r', 'Email', 'required|valid_email');

		   $this->form_validation->set_message('required', '* %s es obligatorio');
		   $this->form_validation->set_message('valid_email', '* El email no es válido');
		   $this->form_validation->set_error_delimiters('<div>','</div>');

		   if(!$this->form_validation->run()){
			   $error = validation_errors();
			   echo json_encode(array("result"=>false,"msg"=>$error));
		   }
		   else
		   {
			   try{

				   $rand = rand().time();
				   $contrasena = substr($rand,1,8);
				   if($usuario = $this->objUsuario->obtener(array("usu_email"=>$this->input->post('email-r')))){

					   if($this->objEmail->recuperar_contrasena($this->input->post('email-r'),$contrasena)){
						   $datos['usu_contrasena'] = md5($contrasena);
						   $where = "usu_codigo = '$usuario->codigo'";
						   $this->objUsuario->actualizar($datos,$where);
					   }
					   else{
						   echo json_encode(array("result"=>false,"msg"=>"Ha ocurrido un error inesperado. Por favor, inténtelo nuevamente."));
					   }
				   }
				   else{
					   echo json_encode(array("result"=>false,"msg"=>"El email ingresado no se encuentra registrado."));
					   exit;
				   }

				   echo json_encode(array("result"=>true));
			   }
			   catch(Exception $e){
				   echo json_encode(array("result"=>false,"msg"=>"Ha ocurrido un error inesperado. Por favor, inténtelo nuevamente."));
			   }
		   }
	   }
   }
   
   public function perfil(){
		
		#verificacion de sesion
		if(!$this->session->userdata('usuario'))
			redirect('/');
		
		#usuario
		$usuario = $this->session->userdata('usuario');
		
		#models
		$this->load->model('configuracion/usuario_model','objUsuario');
			
		if($this->input->post()){
			
			#validacion
            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			
			$this->form_validation->set_message('required', '* %s es obligatorio');
			$this->form_validation->set_message('valid_email', '* El email no es válido');
			$this->form_validation->set_message('matches', '* Las contraseñas no coindicen');
			$this->form_validation->set_error_delimiters('<div>','</div>');
			
			if(!$this->form_validation->run()){
				$error = validation_errors();
				echo json_encode(array("result"=>false,"msg"=>$error));
			}
			else{
				$datos['usu_nombre'] = $this->input->post('nombre');
				$datos['usu_email'] = $this->input->post('email');
				if($this->input->post('contrasena'))
					$datos['usu_contrasena'] = md5($this->input->post('contrasena'));
				
				$this->objUsuario->actualizar($datos,array("usu_codigo"=>$usuario->codigo));
				
				$usuario = $this->objUsuario->obtener_por_codigo($usuario->codigo);
				
				#actualizamos la sesión
				$this->session->set_userdata('usuario',$usuario);
				
				echo json_encode(array("result"=>true));
			}
		}
		else{
			
			#title
			$this->layout->title('Perfil');
			
			#metas
			$this->layout->setMeta('title','Perfil');
			$this->layout->setMeta('description','Perfil');
			$this->layout->setMeta('keywords','Perfil');
		
			#js
			$this->layout->js('/js/sistema/index/perfil.js');
			
			$contenido['usuario'] = $this->objUsuario->obtener_por_codigo($usuario->codigo);
			
			#nav
			$this->layout->nav(array("Perfil"=>"/"));
			
			#view
			$this->layout->view('perfil',$contenido);
			
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */