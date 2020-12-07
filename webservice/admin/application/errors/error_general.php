<?php
	$this->obj =& get_instance();
	$this->obj->layout->view('inicio/error',array("error"=>$message));
?>