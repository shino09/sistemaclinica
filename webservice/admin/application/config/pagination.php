<?php

#config paginacion

#contenedor paginacion
$config['full_tag_open'] = '<div id="paginacion"><ul class="pagination paginationControl">';
$config['full_tag_close'] = '</ul></div>';

#primero
$config['first_link'] = '&laquo;&laquo;';  
$config['first_tag_open'] = '<li class="page-away-1" style="display: inline;">';
$config['first_tag_close'] = '</li>';

#siguiente
$config['next_link'] = '&raquo;';
$config['next_tag_open'] = '<li class="page-away-2" style="display: inline;">';
$config['next_tag_close'] = '</li>';

#anterior
$config['prev_link'] = '&laquo;';
$config['prev_tag_open'] = '<li class="page-away-1" style="display: inline;">';
$config['prev_tag_close'] = '</li>';

#current
$config['cur_tag_open'] = '<li class="active page-away-0" style="display: inline;"><span>';
$config['cur_tag_close'] = '</span></li>';

#link
$config['num_tag_open'] = '<li class="page-away-1" style="display: inline;">';
$config['num_tag_close'] = '</li>';

#ultimo
$config['last_link'] = '&raquo;&raquo;';
$config['last_tag_open'] = '<li class="page-away-1" style="display: inline;">';
$config['last_tag_close'] = '</li>';

$config['suffix'] = '/';
$config['use_page_numbers'] = TRUE;

/* fin archivo pagination.php */