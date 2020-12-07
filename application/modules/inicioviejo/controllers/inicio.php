<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class Inicio extends CI_Controller {

	public function index()
	{
		#title
		$this->layout->title('Pyme Base HTML5');
		
		#metas
		$this->layout->setMeta('title','Pyme Base HTML5');
		$this->layout->setMeta('description','Pyme Base HTML5');
		$this->layout->setMeta('keywords','Pyme Base HTML5');
		
		$contenido['home_indicador'] = true;
		
		#Nivoslider 3.2
		$this->layout->css('/js/jquery/nivoslider/3.2/nivo-slider.css');
		$this->layout->css('/js/jquery/nivoslider/3.2/nivoslider_custom.css');
		$this->layout->js('/js/jquery/nivoslider/3.2/jquery.nivo.slider.pack.js');
		$this->layout->js('/js/jquery/nivoslider/3.2/nivoslider_init.js');
		
		#Carrousel
		$this->layout->css('/js/jquery/carousel/slick.css');
		$this->layout->js('/js/jquery/carousel/slick.min.js');
		$this->layout->js('/js/jquery/carousel/scripts.js');
				
		$this->layout->view('inicio',$contenido);
		
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
					if($usuario = $this->objUsuario->login($this->input->post('email'),$this->input->post('contrasena'))){
						$this->session->set_userdata('usuario',$usuario);
						echo json_encode(array("result"=>true));
					}
					else
						echo json_encode(array("result"=>false,"msg"=>"Los datos ingresados no son validos."));
					
				}
				catch(Exception $e){
					echo json_encode(array("result"=>false,"msg"=>$e->getMessage()));
					// echo json_encode(array("result"=>false,"msg"=>"Ha ocurrido un error inesperado. Por favor, inténtelo nuevamente."));
				}
			}
		}
		else
			redirect('/');
	
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}

	public function mapaDelSitio()
    {
        $this->layout->view('mapa-del-sitio');
    }

    public function accesibilidad()
    {
    	#nav
		$this->layout->nav(array("Accesibilidad"=>"/"));
     	
     	$this->layout->view('accesibilidad'); 
    }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */