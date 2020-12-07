	<?php



	class Email extends CI_Model

	{

		public function enviar($contacto, $cuerpo = false){

			$this->contacto = $contacto;

			//$this->empresa = $contacto->empresa;
		
				if(!$cuerpo){
					$this->generar_cuerpo();		
				}else{
					$this->cuerpo = $cuerpo;			
				}
				return $this->envio();
		}
		
			
		

		

		private function generar_cuerpo()

		{

			$asunto = (isset($this->contacto->asunto))?$this->contacto->asunto:'Contacto';

			$this->cuerpo = '

				<p style="text-decoration: underline;">'.$asunto.' desde el sitio de PymeBase</p>

				<table style="border: 1px solid #999999; border-spacing: 0;">

				<tr>

					<td style="padding: 2px; border-right: 1px solid #999999; border-bottom: 1px solid #999999; vertical-align: top;"><b>Nombre</b></td>

					<td style="padding: 2px; border-bottom: 1px solid #999999;">'.(trim($this->contacto->nombres)).'</td>

				</tr>';
				
				if(isset($this->contacto->apellidos)){
				
				$this->cuerpo .='

						 <tr>

							<td style="padding: 2px; border-right: 1px solid #999999; border-bottom: 1px solid #999999; vertical-align: top;"><b>Apellidos</b></td>

							<td style="padding: 2px; border-bottom: 1px solid #999999;">'.(trim($this->contacto->apellidos)).'</td>

						</tr>

					';
				
				
				
				} 
				
				
				
			$this->cuerpo .='	

				<tr>

					<td style="padding: 2px; border-right: 1px solid #999999; border-bottom: 1px solid #999999; vertical-align: top;"><b>Email</b></td>

					<td style="padding: 2px; border-bottom: 1px solid #999999;">'.(trim($this->contacto->email)).'</td>

				</tr>';

			$this->cuerpo .='
				 <tr>

					<td style="padding: 2px; border-right: 1px solid #999999; border-bottom: 1px solid #999999; vertical-align: top;"><b>Teléfono</b></td>

					<td style="padding: 2px; border-bottom: 1px solid #999999;">'.(trim($this->contacto->telefono)).'</td>

				</tr>';
				
				
				
				
				
				if(isset($this->contacto->profesion)){
				
				$this->cuerpo .='

						 <tr>

							<td style="padding: 2px; border-right: 1px solid #999999; border-bottom: 1px solid #999999; vertical-align: top;"><b>Profesion</b></td>

							<td style="padding: 2px; border-bottom: 1px solid #999999;">'.(trim($this->contacto->profesion)).'</td>

						</tr>

					';
				
				
				
				
				
				} 
				
				
				if(isset($this->contacto->nombre_sucursal)){
				
					$this->cuerpo .='

						 <tr>

							<td style="padding: 2px; border-right: 1px solid #999999; border-bottom: 1px solid #999999; vertical-align: top;"><b>Sucursal</b></td>

							<td style="padding: 2px; border-bottom: 1px solid #999999;">'.(trim($this->contacto->nombre_sucursal)).'</td>

						</tr>

					';
				
				
				
				
				
				}


				if(isset($this->contacto->nombre_departamento)){
				
					$this->cuerpo .='

						 <tr>

							<td style="padding: 2px; border-right: 1px solid #999999; border-bottom: 1px solid #999999; vertical-align: top;"><b>Departamento</b></td>

							<td style="padding: 2px; border-bottom: 1px solid #999999;">'.(trim($this->contacto->nombre_departamento)).'</td>

						</tr>

					';
				
				
				
				
				
				} 				
				
				
				
				if(isset($this->contacto->curriculum)){

					

					$this->cuerpo .='

						 <tr>

							<td style="padding: 2px; border-right: 1px solid #999999; border-bottom: 1px solid #999999; vertical-align: top;"><b>Curriculum Vitae</b></td>

							<td style="padding: 2px; border-bottom: 1px solid #999999;">'.(trim($this->contacto->curriculum)).'</td>

						</tr>

					';

				}
				
				
				
				

				if(isset($this->contacto->asunto)){

					

					$this->cuerpo .='

						 <tr>

							<td style="padding: 2px; border-right: 1px solid #999999; border-bottom: 1px solid #999999; vertical-align: top;"><b>Asunto</b></td>

							<td style="padding: 2px; border-bottom: 1px solid #999999;">'.(trim($this->contacto->asunto)).'</td>

						</tr>

					';

				}
				
				
				

				

			$this->cuerpo .='

				<tr>

					<td style="padding: 2px; border-right: 1px solid #999999; border-bottom: 1px solid #999999; vertical-align: top;"><b>Fecha de envío</b></td>

					<td style="padding: 2px; border-bottom: 1px solid #999999;">'.date("d-m-Y").'</td>

				</tr>
				
				<tr>

					<td style="padding: 2px; border-right: 1px solid #999999; border-bottom: 1px solid #999999; vertical-align: top;"><b>Hora de envío</b></td>

					<td style="padding: 2px; border-bottom: 1px solid #999999;">'.date('H:i:s').'</td>

				</tr>

				<tr>

					<td style="padding: 2px; border-right: 1px solid #999999; vertical-align: top;"><b>comentario</b></td>

					 <td style="padding: 2px;">'.((trim(nl2br($this->contacto->mensaje)))).'</td>

				</tr>

				</table>
				
				<br><br><br><br>
				<img src="/imagenes/template/logo.jpg" width="290" height="148" alt="PymeBase">'
				
				
				;
				
				
				
				
				
				

			

		}

		

		public function envio(){
		
			$this->email->from('jaamieci@gmail.com');
			$this->email->to('joaguayo@alumnos.ubiobio.cl');

			#$this->email->to($empresa->email_contacto); 
			#$this->email->cc($empresa->email_copia_contacto); 
			$this->email->subject(utf8_decode("desde el sitio PymeBase [".date('d/m/y')." ".date('H:i:s')."]"));

			$this->email->message(utf8_decode($this->cuerpo));
		
			return $this->email->send();
		}
		
		
		
		public function obtener_empresa($where){
		
		$this->db->where($where);
		$sql = $this->db->get("np_empresa");
		$aux = $sql->row();
		if($aux){
			$obj = new stdClass();
			$obj->codigo = $aux->e_codigo;
			$obj->id = $aux->e_id;
			$obj->estado = $aux->e_estado;
			$obj->idioma = $aux->e_idioma;
			$obj->url 	 = $aux->e_url;
			$obj->nombre = $aux->e_nombre;
			$obj->email= $aux->e_email;
			$obj->telefono = $aux->e_telefono;
			$obj->direccion= $aux->e_direccion;
			$obj->facebook= $aux->e_facebook;
			$obj->twitter= $aux->e_twitter;
			$obj->email_contacto= $aux->e_email_contacto;
			$obj->email_copia_contacto= $aux->e_email_copia_contacto;
			
			
			return $obj;
		}
		$sql->free_result();
		return false;
	}
		
		
		
		
		public function envio_usuario(){

			$this->load->model('inicio/datos_empresa','obj_datos_empresa');
			$this->load->model('inicio/usuario','obj_usuario');
			$this->load->model('carro_de_compra/datos_de_contacto','obj_despacho');
			$datos_empresa = $this->obj_datos_empresa->obtener_por_codigo(1);
			
			$datos_usuario = $this->obj_usuario->obtener_por_codigo($this->session->userdata('usuario')->codigo);
			
				$this->email->from($datos_empresa->email_general,'HIMCE');

						$email_usuario = $datos_usuario->email;
						$this->email->to($email_usuario);
	
			$asunto = (isset($this->contacto->asunto))?$this->contacto->asunto:'Contacto';

			$asunto = utf8_decode($asunto." desde el sitio de HIMCE [".date('d/m/y')." ".date('H:i:s')."]");

			$this->email->subject($asunto);

			$this->email->message(utf8_decode($this->cuerpo));

			return $this->email->send();



		}
		
		
		
		
		public function envio_despacho(){

			$this->load->model('inicio/datos_empresa','obj_datos_empresa');
			$this->load->model('inicio/usuario','obj_usuario');
			$this->load->model('carro_de_compra/datos_de_contacto','obj_despacho');
			$datos_empresa = $this->obj_datos_empresa->obtener_por_codigo(1);
			
		$datos_despacho = $this->obj_despacho->obtener_despacho($this->session->userdata('codigo_despacho'));
			
				$this->email->from($datos_empresa->email_general,'HIMCE');

						$email_despacho = $datos_despacho->email;
						$this->email->to($email_despacho);
	
			$asunto = (isset($this->contacto->asunto))?$this->contacto->asunto:'Contacto';

			$asunto = utf8_decode($asunto." desde el sitio de HIMCE [".date('d/m/y')." ".date('H:i:s')."]");

			$this->email->subject($asunto);

			$this->email->message(utf8_decode($this->cuerpo));

			return $this->email->send();



		}
		
		
		
		
		
		

		

		
		
		
		

		

	}

