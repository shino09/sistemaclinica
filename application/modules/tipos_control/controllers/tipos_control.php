<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class Tipos_control extends CI_Controller {

	public function index()
	{
		#title
		$this->layout->title('Pyme Base HTML5');
		
		#metas
		$this->layout->setMeta('title','Pyme Base HTML5');
		$this->layout->setMeta('description','Pyme Base HTML5');
		$this->layout->setMeta('keywords','Pyme Base HTML5');
		
		$contenido['home_indicador'] = true;
		
		$this->layout->nav(array("Tipos de control" => "/"));
		
		$this->layout->view('index',$contenido);
		
	}
	
		public function agregar()
	{
		#title
		$this->layout->title('Pyme Base HTML5');
		
		#metas
		$this->layout->setMeta('title','Pyme Base HTML5');
		$this->layout->setMeta('description','Pyme Base HTML5');
		$this->layout->setMeta('keywords','Pyme Base HTML5');
		
		$contenido['home_indicador'] = true;
		
		$this->layout->nav(array("Tipos de control" => "/"));
		
		$this->layout->view('agregar',$contenido);
		
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */