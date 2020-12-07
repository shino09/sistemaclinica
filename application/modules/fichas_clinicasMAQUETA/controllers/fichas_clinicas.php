<?php if ( ! defined('BASEPATH')) exit('No puede acceder a este archivo');

class Fichas_clinicas extends CI_Controller {

	public function index()
	{
		#title
		$this->layout->title('Pyme Base HTML5');
		
		#metas
		$this->layout->setMeta('title','Pyme Base HTML5');
		$this->layout->setMeta('description','Pyme Base HTML5');
		$this->layout->setMeta('keywords','Pyme Base HTML5');
		
		$contenido['home_indicador'] = true;
		
		$this->layout->nav(array("Fichas Clínicas" => "/"));
		
		$this->layout->view('index',$contenido);
		
	}
	
		public function agregar_paciente()
	{
		#title
		$this->layout->title('Pyme Base HTML5');
		
		#metas
		$this->layout->setMeta('title','Pyme Base HTML5');
		$this->layout->setMeta('description','Pyme Base HTML5');
		$this->layout->setMeta('keywords','Pyme Base HTML5');
		
		$contenido['home_indicador'] = true;
		
		$this->layout->nav(array("Fichas Clínicas" => "/"));
		
		$this->layout->view('agregar_paciente',$contenido);
		
	}
	
		public function agregar_control_operativo()
	{
		#title
		$this->layout->title('Pyme Base HTML5');
		
		#metas
		$this->layout->setMeta('title','Pyme Base HTML5');
		$this->layout->setMeta('description','Pyme Base HTML5');
		$this->layout->setMeta('keywords','Pyme Base HTML5');
		
		$contenido['home_indicador'] = true;
		
		$this->layout->nav(array("Fichas Clínicas" => "/"));
		
		$this->layout->view('agregar_control_operativo',$contenido);
		
	}

		public function resumen_estadia()
	{
		#title
		$this->layout->title('Pyme Base HTML5');
		
		#metas
		$this->layout->setMeta('title','Pyme Base HTML5');
		$this->layout->setMeta('description','Pyme Base HTML5');
		$this->layout->setMeta('keywords','Pyme Base HTML5');
		
		$contenido['home_indicador'] = true;
		
		$this->layout->nav(array("Fichas Clínicas" => "/"));
		
		$this->layout->view('resumen_estadia',$contenido);
		
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */