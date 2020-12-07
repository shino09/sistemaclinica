<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "inicio";
$route['404_override'] = '';


/* RUTAS PYME */
$route['quienes-somos'] = 'editable_no-se-usa/editable/index';

#login
$route['login'] = 'login';

#Pacientes
//$route['pacientes'] = 'pacientes';

#Linde
$route['linde'] = 'linde';





/* RUTAS PYME */

#inicio
$route['inicio/login']                  = "inicio/login";
$route['logout']                 = "inicio/logout";
$route['inicio/recuperar-contrasena']   = "inicio/recuperar_contrasena";

#SOLICITUDES DE PERFIL
$route['solicitudes-perfil/(:num)']   = "inicio/solicitudes_perfil/$1";

#Fichas Clinicas
$route['fichas-clinicas'] = 'fichas_clinicas';
$route['fichas-clinicas/agregar-nuevo-paciente'] = 'fichas_clinicas/agregar_paciente';
$route['fichas-clinicas/agregar-control-operativo'] = 'fichas_clinicas/agregar_control_operativo';
$route['fichas-clinicas/resumen-de-estadia'] = 'fichas_clinicas/resumen_estadia';

#Fichas Clinicas
$route['fichas_clinicasMAQUETA'] = 'fichas_clinicasMAQUETA';
$route['fichas_clinicasMAQUETA/agregar_nuevo_paciente'] = 'fichas_clinicasMAQUETA/agregar_paciente';
$route['fichas_clinicasMAQUETA/agregar_control_operativo'] = 'fichas_clinicasMAQUETA/agregar_control_operativo';
$route['fichas_clinicasMAQUETA/resumen_de_estadia'] = 'fichas_clinicasMAQUETA/resumen_estadia';

#centros médicos
//$route['centros-medicos'] = 'centros_medicos';
//$route['centros-medicos/agregar-centro-medico'] = 'centros_medicos/agregar';

#Insumos
$route['insumos'] = 'insumos';
$route['insumos/agregar-insumo'] = 'insumos/agregar';

#Mi perfil
$route['mi-perfil'] = 'mi_perfil';

#Tipos de control
$route['tipos-de-control'] = 'tipos_control';
$route['tipos-de-control/agregar-tipo-control'] = 'tipos_control/agregar';

#Equipos
$route['equipos'] = 'equipos';
$route['equipos/agregar-equipo'] = 'equipos/agregar';

#Respaldos
$route['respaldos'] = 'respaldos';
$route['respaldos/agregar-respaldo'] = 'respaldos/agregar';

#Usuario
$route['usuarios'] = 'usuarios';
$route['usuarios/agregar-usuario'] = 'usuarios/agregar';

#Kinesiologo
$route['kinesiologo'] = 'kinesiologo';
$route['kinesiologo/agregar-kinesiologo'] = 'kinesiologo/agregar';

#Modos ventilatorios
$route['modos-ventilatorios'] = 'modos_ventilatorios';
$route['modos-ventilatorios/agregar-modo-ventilatorio'] = 'modos_ventilatorios/agregar';

#Detalle Pagos
$route['detalle-pagos'] = 'detalle_pagos';

#Horarios
$route['horarios'] = 'horarios';


#Mantenedores -> perfiles
$route['mantenedores/perfiles/administrar/(:num)']  = "mantenedores/perfiles/administrar/$1";
$route['mantenedores/perfiles/administrar']         = "mantenedores/perfiles/administrar";
$route['mantenedores/perfiles/process/(:num)']      = "mantenedores/perfiles/process/$1";
$route['mantenedores/perfiles/process']             = "mantenedores/perfiles/process";
$route['mantenedores/perfiles/eliminar']            = "mantenedores/perfiles/eliminar";
$route['mantenedores/perfiles/(:num)']              = "mantenedores/perfiles";

#Mantenedores -> cenros medicos
$route['mantenedores/centros_medicos/administrar/(:num)'] = "mantenedores/centros_medicos/administrar/$1";
$route['mantenedores/centros_medicos/administrar'] = "mantenedores/centros_medicos/administrar";
$route['mantenedores/centros_medicos/process/(:num)'] = "mantenedores/centros_medicos/process/$1";
$route['mantenedores/centros_medicos/process'] = "mantenedores/centros_medicos/process";
$route['mantenedores/centros_medicos/eliminar'] = "mantenedores/centros_medicos/eliminar";
$route['mantenedores/centros_medicos/busqueda/(:any)/centro/(:any)/(:num)'] = "mantenedores/centros_medicos";
$route['mantenedores/centros_medicos/estado/(:any)/(:num)'] = "mantenedores/centros_medicos";
$route['mantenedores/centros_medicos/busqueda/(:any)/(:num)'] = "mantenedores/centros_medicos";
$route['mantenedores/centros_medicos/busqueda/(:any)/centro/(:any)'] = "mantenedores/centros_medicos";
$route['mantenedores/centros_medicos/estado/(:any)'] = "mantenedores/centros_medicos";
$route['mantenedores/centros_medicos/busqueda/(:any)'] = "mantenedores/centros_medicos";
$route['mantenedores/centros_medicos/(:num)'] = "mantenedores/centros_medicos";
$route['mantenedores/centros_medicos/listar'] = "mantenedores/tipos_de_control/listar_centros_medicos";






#Mantenedores -> kinesiologos
$route['mantenedores/kinesiologos/administrar/(:num)'] = "mantenedores/kinesiologos/administrar/$1";
$route['mantenedores/kinesiologos/administrar'] = "mantenedores/kinesiologos/administrar";
$route['mantenedores/kinesiologos/process/(:num)'] = "mantenedores/kinesiologos/process/$1";
$route['mantenedores/kinesiologos/process'] = "mantenedores/kinesiologos/process";
$route['mantenedores/kinesiologos/eliminar'] = "mantenedores/kinesiologos/eliminar";
$route['mantenedores/kinesiologos/busqueda/(:any)/centro/(:any)/(:num)'] = "mantenedores/kinesiologos";
$route['mantenedores/kinesiologos/estado/(:any)/(:num)'] = "mantenedores/kinesiologos";
$route['mantenedores/kinesiologos/busqueda/(:any)/(:num)'] = "mantenedores/kinesiologos";
$route['mantenedores/kinesiologos/busqueda/(:any)/centro/(:any)'] = "mantenedores/kinesiologos";
$route['mantenedores/kinesiologos/estado/(:any)'] = "mantenedores/kinesiologos";
$route['mantenedores/kinesiologos/busqueda/(:any)'] = "mantenedores/kinesiologos";
$route['mantenedores/kinesiologos/(:num)'] = "mantenedores/kinesiologos";
$route['mantenedores/kinesiologos/listar'] = "mantenedores/tipos_de_control/listar_kinesiologos";



#Mantenedores -> equipos
$route['mantenedores/equipos/administrar/(:num)'] = "mantenedores/equipos/administrar/$1";
$route['mantenedores/equipos/administrar'] = "mantenedores/equipos/administrar";
$route['mantenedores/equipos/process/(:num)'] = "mantenedores/equipos/process/$1";
$route['mantenedores/equipos/process'] = "mantenedores/equipos/process";
$route['mantenedores/equipos/eliminar'] = "mantenedores/equipos/eliminar";
$route['mantenedores/equipos/busqueda/(:any)/centro/(:any)/(:num)'] = "mantenedores/equipos";
$route['mantenedores/equipos/estado/(:any)/(:num)'] = "mantenedores/equipos";
$route['mantenedores/equipos/busqueda/(:any)/(:num)'] = "mantenedores/equipos";
$route['mantenedores/equipos/busqueda/(:any)/centro/(:any)'] = "mantenedores/equipos";
$route['mantenedores/equipos/estado/(:any)'] = "mantenedores/equipos";
$route['mantenedores/equipos/busqueda/(:any)'] = "mantenedores/equipos";
$route['mantenedores/equipos/(:num)'] = "mantenedores/equipos";
$route['mantenedores/equipos/listar'] = "mantenedores/tipos_de_control/listar_equipos";



#Mantenedores -> equipos
$route['mantenedores/horarios/administrar/(:num)'] = "mantenedores/horarios/administrar/$1";
$route['mantenedores/horarios/administrar'] = "mantenedores/horarios/administrar";
$route['mantenedores/horarios/process/(:num)'] = "mantenedores/horarios/process/$1";
$route['mantenedores/horarios/process'] = "mantenedores/horarios/process";
$route['mantenedores/horarios/eliminar'] = "mantenedores/horarios/eliminar";
$route['mantenedores/horarios/busqueda/(:any)/centro/(:any)/(:num)'] = "mantenedores/horarios";
$route['mantenedores/horarios/estado/(:any)/(:num)'] = "mantenedores/horarios";
$route['mantenedores/horarios/busqueda/(:any)/(:num)'] = "mantenedores/horarios";
$route['mantenedores/equipos/busqueda/(:any)/centro/(:any)'] = "mantenedores/horarios";
$route['mantenedores/horarios/estado/(:any)'] = "mantenedores/horarios";
$route['mantenedores/horarios/busqueda/(:any)'] = "mantenedores/horarios";
$route['mantenedores/horarios/(:num)'] = "mantenedores/horarios";
$route['mantenedores/horarios/listar'] = "mantenedores/tipos_de_control/listar_horarios";


#Mantenedores -> modos ventiladores
$route['mantenedores/modos_ventilatorios/administrar/(:num)'] = "mantenedores/modos_ventilatorios/administrar/$1";
$route['mantenedores/modos_ventilatorios/administrar'] = "mantenedores/modos_ventilatorios/administrar";
$route['mantenedores/modos_ventilatorios/process/(:num)'] = "mantenedores/modos_ventilatorios/process/$1";
$route['mantenedores/modos_ventilatorios/process'] = "mantenedores/modos_ventilatorios/process";
$route['mantenedores/modos_ventilatorios/eliminar'] = "mantenedores/modos_ventilatorios/eliminar";
$route['mantenedores/modos_ventilatorios/busqueda/(:any)/centro/(:any)/(:num)'] = "mantenedores/modos_ventilatorios";
$route['mantenedores/modos_ventilatorios/estado/(:any)/(:num)'] = "mantenedores/modos_ventilatorios";
$route['mantenedores/modos_ventilatorios/busqueda/(:any)/(:num)'] = "mantenedores/modos_ventilatorios";
$route['mantenedores/modos_ventilatorios/busqueda/(:any)/centro/(:any)'] = "mantenedores/modos_ventilatorios";
$route['mantenedores/modos_ventilatorios/estado/(:any)'] = "mantenedores/modos_ventilatorios";
$route['mantenedores/modos_ventilatorios/busqueda/(:any)'] = "mantenedores/modos_ventilatorios";
$route['mantenedores/modos_ventilatorios/(:num)'] = "mantenedores/modos_ventilatorios";
//$route['mantenedores/modos_ventilatorios/listar'] = "mantenedores/tipos_de_control/listar_equipos";


#Mantenedores -> kinesiologos
$route['mantenedores/respaldos/administrar/(:num)'] = "mantenedores/respaldos/administrar/$1";
$route['mantenedores/respaldos/administrar'] = "mantenedores/respaldos/administrar";
$route['mantenedores/respaldos/process/(:num)'] = "mantenedores/respaldos/process/$1";
$route['mantenedores/respaldos/process'] = "mantenedores/respaldos/process";
$route['mantenedores/respaldos/eliminar'] = "mantenedores/respaldos/eliminar";
$route['mantenedores/respaldos/busqueda/(:any)/centro/(:any)/(:num)'] = "mantenedores/respaldos";
$route['mantenedores/respaldos/estado/(:any)/(:num)'] = "mantenedores/respaldos";
$route['mantenedores/respaldos/busqueda/(:any)/(:num)'] = "mantenedores/respaldos";
$route['mantenedores/respaldos/busqueda/(:any)/centro/(:any)'] = "mantenedores/respaldos";
$route['mantenedores/respaldos/estado/(:any)'] = "mantenedores/respaldos";
$route['mantenedores/respaldos/busqueda/(:any)'] = "mantenedores/respaldos";
$route['mantenedores/respaldos/(:num)'] = "mantenedores/respaldos";
$route['mantenedores/respaldos/listar'] = "mantenedores/tipos_de_control/listar_respaldos";


#Mantenedores -> insumos
$route['mantenedores/insumos/administrar/(:num)'] = "mantenedores/insumos/administrar/$1";
$route['mantenedores/insumos/administrar'] = "mantenedores/insumos/administrar";
$route['mantenedores/insumos/process/(:num)'] = "mantenedores/insumos/process/$1";
$route['mantenedores/insumos/process'] = "mantenedores/insumos/process";
$route['mantenedores/insumos/eliminar'] = "mantenedores/insumos/eliminar";
$route['mantenedores/insumos/busqueda/(:any)/centro/(:any)/(:num)'] = "mantenedores/equipos";
$route['mantenedores/insumos/estado/(:any)/(:num)'] = "mantenedores/insumos";
$route['mantenedores/insumos/busqueda/(:any)/(:num)'] = "mantenedores/insumos";
$route['mantenedores/insumos/busqueda/(:any)/centro/(:any)'] = "mantenedores/insumos";
$route['mantenedores/insumos/estado/(:any)'] = "mantenedores/insumos";
$route['mantenedores/insumos/busqueda/(:any)'] = "mantenedores/insumos";
$route['mantenedores/insumos/(:num)'] = "mantenedores/insumos";
$route['mantenedores/insumos/listar'] = "mantenedores/tipos_de_control/listar_insumos";

#Mantenedores -> insumos
$route['mantenedores/tipos_de_control/administrar/(:num)'] = "mantenedores/tipos_de_control/administrar/$1";
$route['mantenedores/tipos_de_control/administrar'] = "mantenedores/tipos_de_control/administrar";
$route['mantenedores/tipos_de_control/process/(:num)'] = "mantenedores/tipos_de_control/process/$1";
$route['mantenedores/tipos_de_control/process'] = "mantenedores/tipos_de_control/process";
$route['mantenedores/tipos_de_control/eliminar'] = "mantenedores/insumos/eliminar";
$route['mantenedores/tipos_de_control/busqueda/(:any)/centro/(:any)/(:num)'] = "mantenedores/equipos";
$route['mantenedores/tipos_de_control/estado/(:any)/(:num)'] = "mantenedores/tipos_de_control";
$route['mantenedores/tipos_de_control/busqueda/(:any)/(:num)'] = "mantenedores/tipos_de_control";
$route['mantenedores/tipos_de_control/busqueda/(:any)/centro/(:any)'] = "mantenedores/tipos_de_control";
$route['mantenedores/tipos_de_control/estado/(:any)'] = "mantenedores/tipos_de_control";
$route['mantenedores/tipos_de_control/busqueda/(:any)'] = "mantenedores/tipos_de_control";
$route['mantenedores/tipos_de_control/(:num)'] = "mantenedores/tipos_de_control";
$route['mantenedores/tipos_de_control/listar'] = "mantenedores/tipos_de_control/listar_tipo_de_control";


#Mantenedores -> usuarios
$route['mantenedores/usuarios/administrar/(:num)']  = "mantenedores/usuarios/administrar/$1";
$route['mantenedores/usuarios/administrar']         = "mantenedores/usuarios/administrar";
$route['mantenedores/usuarios/process/(:num)']      = "mantenedores/usuarios/process/$1";
$route['mantenedores/usuarios/process']             = "mantenedores/usuarios/process";
$route['mantenedores/usuarios/eliminar']            = "mantenedores/usuarios/eliminar";
$route['mantenedores/usuarios/(:num)']              = "mantenedores/usuarios";
$route['mantenedores/usuarios/listar_provincias']   = "mantenedores/usuarios/listar_provincias";
$route['mantenedores/usuarios/listar_comunas']      = "mantenedores/usuarios/listar_comunas";
$route['mantenedores/usuarios/miperfil/(:num)']  = "mantenedores/usuarios/miperfil/$1";
$route['mantenedores/usuarios/miperfil']         = "mantenedores/usuarios/miperfil";


#Mantenedores -> horarios
$route['mantenedores/horarios/administrar/(:num)']  = "mantenedores/horarios/administrar/$1";
$route['mantenedores/horarios/administrar']         = "mantenedores/horarios/administrar";
$route['mantenedores/horarios/process/(:num)']      = "mantenedores/horarios/process/$1";
$route['mantenedores/horarios/process']             = "mantenedores/horarios/process";
$route['mantenedores/horarios/eliminar']            = "mantenedores/horarios/eliminar";
$route['mantenedores/horarios/(:num)']              = "mantenedores/horarios";
$route['mantenedores/horarios/listar_provincias']   = "mantenedores/horarios/listar_provincias";
$route['mantenedores/horarios/listar_comunas']      = "mantenedores/horarios/listar_comunas";
$route['mantenedores/horarios/miperfil/(:num)']  = "mantenedores/horarios/miperfil/$1";
$route['mantenedores/horarios/miperfil']         = "mantenedores/horarios/miperfil";


#EDITAR MIS DATOS
$route['editar-mis-datos']                                  = 'editar_mis_datos';
$route['editar-mis-datos/process']                          = 'editar_mis_datos/process';
$route['editar-mis-datos/eliminar-archivo']                 = "editar_mis_datos/eliminar_archivo";
$route['editar-mis-datos/descargar-archivo/(:num)/(:num)']  = "editar_mis_datos/descargar_archivo/$1/$2";
$route['editar-mis-datos/listar-provincias']                = "editar_mis_datos/listar_provincias";
$route['editar-mis-datos/listar-comunas']                   = "editar_mis_datos/listar_comunas";

/* End of file routes.php */
/* Location: ./application/config/routes.php */


#Mantenedores -> fichas clinicas
$route['fichas_clinicas/fichas_clinicas/administrar/(:num)'] = "fichas_clinicas/fichas_clinicas/administrar/$1";
$route['fichas_clinicas/fichas_clinicas/administrar'] = "fichas_clinicas/fichas_clinicas/administrar";
$route['fichas_clinicas/fichas_clinicas/process/(:num)'] = "fichas_clinicas/fichas_clinicas/process/$1";
$route['fichas_clinicas/fichas_clinicas/process'] = "fichas_clinicas/fichas_clinicas/process";
$route['fichas_clinicas/fichas_clinicas/eliminar'] = "fichas_clinicas/fichas_clinicas/eliminar";
$route['fichas_clinicas/fichas_clinicas/busqueda/(:any)/centro/(:any)/(:num)'] = "fichas_clinicas/equipos";
$route['fichas_clinicas/fichas_clinicas/estado/(:any)/(:num)'] = "fichas_clinicas/fichas_clinicas";
$route['fichas_clinicas/fichas_clinicas/busqueda/(:any)/(:num)'] = "fichas_clinicas/fichas_clinicas";
$route['fichas_clinicas/fichas_clinicas/busqueda/(:any)/centro/(:any)'] = "fichas_clinicas/fichas_clinicas";
$route['fichas_clinicas/fichas_clinicas/centro_medico/(:any)/(:num)'] = "fichas_clinicas/fichas_clinicas";
$route['fichas_clinicas/fichas_clinicas/centro_medico/(:any)'] = "fichas_clinicas/fichas_clinicas";
$route['fichas_clinicas/fichas_clinicas/estado/(:any)'] = "fichas_clinicas/fichas_clinicas";
$route['fichas_clinicas/fichas_clinicas/busqueda/(:any)'] = "fichas_clinicas/fichas_clinicas";
$route['fichas_clinicas/fichas_clinicas/(:num)'] = "fichas_clinicas/fichas_clinicas";
$route['fichas_clinicas/fichas_clinicas/listar'] = "fichas_clinicas/fichas_clinicas/listarfichas_clinicas";
$route['fichas_clinicas/fichas_clinicas/agregar_control_operativo/(:num)'] = "fichas_clinicas/fichas_clinicas/agregar_control_operativo/$1";
$route['fichas_clinicas/fichas_clinicas/agregar_control_operativo'] = "fichas_clinicas/fichas_clinicas/agregar_control_operativo";



#Mantenedores -> pacientes
$route['fichas_clinicas/pacientes/administrar/(:num)'] = "fichas_clinicas/pacientes/administrar/$1";
$route['fichas_clinicas/pacientes/administrar'] = "fichas_clinicas/pacientes/administrar";
$route['fichas_clinicas/pacientes/process/(:num)'] = "fichas_clinicas/pacientes/process/$1";
$route['fichas_clinicas/pacientes/process'] = "fichas_clinicas/pacientes/process";
$route['fichas_clinicas/pacientes/eliminar'] = "fichas_clinicas/pacientes/eliminar";
$route['fichas_clinicas/pacientes/busqueda/(:any)/centro/(:any)/(:num)'] = "fichas_clinicas/equipos";
$route['fichas_clinicas/pacientes/estado/(:any)/(:num)'] = "fichas_clinicas/pacientes";
$route['fichas_clinicas/pacientes/centro_medico/(:any)/(:num)'] = "fichas_clinicas/pacientes";
$route['fichas_clinicas/pacientes/centro_medico/(:any)'] = "fichas_clinicas/pacientes";
$route['fichas_clinicas/pacientes/unidad/(:any)/(:num)'] = "fichas_clinicas/pacientes";
$route['fichas_clinicas/pacientes/unidad/(:any)'] = "fichas_clinicas/pacientes";
$route['fichas_clinicas/pacientes/equipo/(:any)/(:num)'] = "fichas_clinicas/pacientes";
$route['fichas_clinicas/pacientes/equipo/(:any)'] = "fichas_clinicas/pacientes";
$route['fichas_clinicas/pacientes/fecha_desde/(:any)/(:num)'] = "fichas_clinicas/pacientes";
$route['fichas_clinicas/pacientes/fecha_desde/(:any)'] = "fichas_clinicas/pacientes";
$route['fichas_clinicas/pacientes/fecha_hasta/(:any)/(:num)'] = "fichas_clinicas/pacientes";
$route['fichas_clinicas/pacientes/fecha_hasta/(:any)'] = "fichas_clinicas/pacientes";

$route['fichas_clinicas/pacientes/busqueda/(:any)/(:num)'] = "fichas_clinicas/pacientes";
$route['fichas_clinicas/pacientes/busqueda/(:any)/centro/(:any)'] = "fichas_clinicas/fichas_clinicas";
$route['fichas_clinicas/pacientes/estado/(:any)'] = "fichas_clinicas/pacientes";
$route['fichas_clinicas/pacientes/busqueda/(:any)'] = "fichas_clinicas/pacientes";
$route['fichas_clinicas/pacientes/(:num)'] = "fichas_clinicas/pacientes";
$route['fichas_clinicas/pacientes/listar'] = "fichas_clinicas/pacientes/listarfichas_clinicas";
$route['fichas_clinicas/pacientes/agregar_control_operativo/(:num)'] = "fichas_clinicas/pacientes/agregar_control_operativo/$1";
$route['fichas_clinicas/pacientes/agregar_control_operativo'] = "fichas_clinicas/pacientes/agregar_control_operativo";



#Mantenedores -> pacientes
$route['fichas_clinicas/estadia/administrar/(:num)'] = "fichas_clinicas/estadia/administrar/$1";
$route['fichas_clinicas/estadia/administrar'] = "fichas_clinicas/estadia/administrar";
$route['fichas_clinicas/estadia/process/(:num)'] = "fichas_clinicas/estadia/process/$1";
$route['fichas_clinicas/estadia/process'] = "fichas_clinicas/estadia/process";
$route['fichas_clinicas/estadia/eliminar'] = "fichas_clinicas/estadia/eliminar";
$route['fichas_clinicas/estadia/busqueda/(:any)/centro/(:any)/(:num)'] = "fichas_clinicas/equipos";
$route['fichas_clinicas/estadia/estado/(:any)/(:num)'] = "fichas_clinicas/estadia";
$route['fichas_clinicas/estadia/centro_medico/(:any)/(:num)'] = "fichas_clinicas/estadia";
$route['fichas_clinicas/estadia/centro_medico/(:any)'] = "fichas_clinicas/estadia";
$route['fichas_clinicas/estadia/unidad/(:any)/(:num)'] = "fichas_clinicas/estadia";
$route['fichas_clinicas/estadia/unidad/(:any)'] = "fichas_clinicas/estadia";
$route['fichas_clinicas/estadia/equipo/(:any)/(:num)'] = "fichas_clinicas/estadia";
$route['fichas_clinicas/estadia/equipo/(:any)'] = "fichas_clinicas/estadia";
$route['fichas_clinicas/estadia/fecha_desde/(:any)/(:num)'] = "fichas_clinicas/estadia";
$route['fichas_clinicas/estadia/fecha_desde/(:any)'] = "fichas_clinicas/estadia";
$route['fichas_clinicas/estadia/fecha/(:any)/(:num)'] = "fichas_clinicas/estadia";
$route['fichas_clinicas/estadia/fecha/(:any)'] = "fichas_clinicas/estadia";
$route['fichas_clinicas/estadia/(:num)/fecha/(:any)/(:num)'] = "fichas_clinicas/estadia";
$route['fichas_clinicas/estadia/(:num)/fecha/(:any)'] = "fichas_clinicas/estadia";
$route['fichas_clinicas/control_operativo/index/(:num)'] = "fichas_clinicas/control_operativo/index/$1";
$route['fichas_clinicas/control_operativo/index'] = "fichas_clinicas/control_operativo/index";

$route['fichas_clinicas/estadia/busqueda/(:any)/(:num)'] = "fichas_clinicas/estadia";
$route['fichas_clinicas/estadia/busqueda/(:any)/centro/(:any)'] = "fichas_clinicas/fichas_clinicas";
$route['fichas_clinicas/estadia/estado/(:any)'] = "fichas_clinicas/estadia";
$route['fichas_clinicas/estadia/busqueda/(:any)'] = "fichas_clinicas/estadia";
$route['fichas_clinicas/estadia/(:num)'] = "fichas_clinicas/estadia";
$route['fichas_clinicas/estadia/listar'] = "fichas_clinicas/estadia/listarfichas_clinicas";
$route['fichas_clinicas/estadia/agregar_control_operativo/(:num)'] = "fichas_clinicas/estadia/agregar_control_operativo/$1";
$route['fichas_clinicas/estadia/agregar_control_operativo'] = "fichas_clinicas/estadia/agregar_control_operativo";
#Mantenedores -> fichas clinicas
$route['fichas_clinicas/control_operativo/administrar/(:num)'] = "fichas_clinicas/control_operativo/administrar/$1";
$route['fichas_clinicas/control_operativo/administrar'] = "fichas_clinicas/control_operativo/administrar";
$route['fichas_clinicas/control_operativo/process/(:num)'] = "fichas_clinicas/control_operativo/process/$1";
$route['fichas_clinicas/control_operativo/process'] = "fichas_clinicas/control_operativo/process";
$route['fichas_clinicas/control_operativo/eliminar'] = "fichas_clinicas/control_operativo/eliminar";
$route['fichas_clinicas/control_operativo/busqueda/(:any)/centro/(:any)/(:num)'] = "control_operativo/equipos";
$route['fichas_clinicas/control_operativo/estado/(:any)/(:num)'] = "fichas_clinicas/control_operativo";
$route['fichas_clinicas/control_operativo/busqueda/(:any)/(:num)'] = "fichas_clinicas/control_operativo";
$route['fichas_clinicas/control_operativo/busqueda/(:any)/centro/(:any)'] = "fichas_clinicas/control_operativo";
$route['fichas_clinicas/control_operativo/estado/(:any)'] = "fichas_clinicas/control_operativo";
$route['fichas_clinicas/control_operativo/busqueda/(:any)'] = "fichas_clinicas/control_operativo";
$route['fichas_clinicas/control_operativo/(:num)'] = "fichas_clinicas/control_operativo";
$route['fichas_clinicas/control_operativo/listar'] = "fichas_clinicas/fichas_clinicas/listarcontrol_operativo";
$route['fichas_clinicas/control_operativo/agregar_control_operativo/(:num)'] = "fichas_clinicas/control_operativo/agregar_control_operativo/$1";
$route['fichas_clinicas/control_operativo/agregar_control_operativo'] = "fichas_clinicas/control_operativo/agregar_control_operativo";

$route['pruebapilot/form']							= 'pruebapilot/form';
$route['pruebapilot/enviar']							= 'pruebapilot/enviar';


#Mantenedores -> kinesiologos
$route['mantenedores/pilot/administrar/(:num)'] = "mantenedores/pilot/administrar/$1";
$route['mantenedores/pilot/administrar'] = "mantenedores/pilot/administrar";
$route['mantenedores/pilot/process/(:num)'] = "mantenedores/pilot/process/$1";
$route['mantenedores/pilot/process'] = "mantenedores/pilot/process";
$route['mantenedores/pilot/eliminar'] = "mantenedores/pilot/eliminar";
$route['mantenedores/pilot/busqueda/(:any)/centro/(:any)/(:num)'] = "mantenedores/pilot";
$route['mantenedores/pilot/estado/(:any)/(:num)'] = "mantenedores/pilot";
$route['mantenedores/pilot/busqueda/(:any)/(:num)'] = "mantenedores/pilot";
$route['mantenedores/pilot/busqueda/(:any)/centro/(:any)'] = "mantenedores/pilot";
$route['mantenedores/pilot/estado/(:any)'] = "mantenedores/pilot";
$route['mantenedores/pilot/busqueda/(:any)'] = "mantenedores/pilot";
$route['mantenedores/pilot/(:num)'] = "mantenedores/pilot";
$route['mantenedores/pilot/listar'] = "mantenedores/tipos_de_control/listar_pilot";