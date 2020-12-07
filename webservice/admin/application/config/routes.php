<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "inicio";
$route['404_override'] = '';

/* RUTAS PYME */

/* LOGIN */
	#login
$route['login']														= "inicio/login";
	#fin login
	
	#logout
$route['logout']													= "inicio/logout";
	#fin logout

	#recuperar contrasena
$route['recuperar-contrasena']										= "inicio/recuperar";
	#fin recuperar contrasena

	#perfil
$route['perfil']													= "inicio/perfil";
	#fin perfil
    
	#tablas
$route['tablas']													= "tablas";
$route['tablas/(:num)']												= "tablas/index/$1";
	#fin tablas

	#vistas
$route['vistas']													= "vistas";
$route['vistas/(:num)']												= "vistas/index/$1";
	#fin vistas

	#triggers
$route['triggers']													= "triggers";
$route['triggers/(:num)']											= "triggers/index/$1";
	#fin triggers
    
	#historial
$route['historial']													= "historial";
$route['historial/(:num)']											= "historial/index/$1";
	#fin historial

	#usuarios
$route['usuarios']													= "usuarios";
$route['usuarios/(:num)']											= "usuarios/index/$1";
	#fin usuarios

	#contenido
$route['contenido']													= "contenido";
$route['contenido/(:num)']											= "contenido/index/$1";
	#fin contenido
	
	
/* End of file routes.php */
/* Location: ./application/config/routes.php */