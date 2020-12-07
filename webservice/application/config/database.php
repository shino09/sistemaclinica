<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	//'hostname' => 'localhost',
	//'username' => 'suractiv_sistema',
	//'password' => 'J3u3tE0fLgAA',
	//'database' => 'suractiv_sistema',
		'hostname' => 'localhost',

	'username' => 'teveuci',
	'password' => 'teveuci.aeurus',

	'database' => 'teveuci',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => TRUE,
	'db_debug' => false,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
