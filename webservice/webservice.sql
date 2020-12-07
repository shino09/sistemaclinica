-- phpMyAdmin SQL Dump
-- version 4.0.10.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-09-2016 a las 11:09:38
-- Versión del servidor: 5.1.73-log
-- Versión de PHP: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `webservice`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keys`
--

CREATE TABLE IF NOT EXISTS `keys` (
  `ke_id` int(11) NOT NULL AUTO_INCREMENT,
  `api_key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`ke_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_campos`
--

CREATE TABLE IF NOT EXISTS `s_campos` (
  `cam_codigo` int(11) NOT NULL,
  `tic_codigo` int(11) DEFAULT NULL,
  `tipr_codigo` int(11) DEFAULT NULL,
  `tab_codigo` int(11) DEFAULT NULL,
  `cam_nombre` varchar(265) DEFAULT NULL,
  `cam_nombre_campo` varchar(256) DEFAULT NULL,
  `cam_tabla_relacion` int(11) DEFAULT NULL,
  `cam_campo_relacion` int(11) DEFAULT NULL,
  `cam_primaria` int(11) DEFAULT NULL,
  `cam_longitud` int(11) DEFAULT NULL,
  `cam_predeterminado` varchar(256) DEFAULT NULL,
  `cam_nulo` int(1) DEFAULT NULL,
  `cam_asociado` int(11) DEFAULT NULL,
  `cam_comentario` text,
  `cam_visible` int(1) DEFAULT '1',
  PRIMARY KEY (`cam_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_condiciones_campos`
--

CREATE TABLE IF NOT EXISTS `s_condiciones_campos` (
  `conc_codigo` int(11) NOT NULL,
  `conc_nombre` varchar(256) DEFAULT NULL,
  `conc_orden` int(11) DEFAULT NULL,
  `conc_acepta_valor` int(11) DEFAULT '1',
  PRIMARY KEY (`conc_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `s_condiciones_campos`
--

INSERT INTO `s_condiciones_campos` (`conc_codigo`, `conc_nombre`, `conc_orden`, `conc_acepta_valor`) VALUES
(1, '=', 1, 1),
(2, '>', 2, 1),
(3, '>=', 3, 1),
(4, '<', 4, 1),
(5, '<=', 5, 1),
(6, '!=', 6, 1),
(7, 'IS NULL', 7, 0),
(8, '%LIKE', 9, 1),
(9, 'LIKE%', 10, 1),
(10, '%LIKE%', 11, 1),
(11, 'NOT LIKE', 12, 1),
(12, 'IN (...)', 13, 1),
(13, 'NOT IN (...)', 14, 1),
(14, 'IS NOT NULL', 8, 0),
(15, 'BETWEEN', 15, 1),
(16, 'NOT BETWEEN', 16, 1),
(17, '= ""', 17, 0),
(18, '!= ""', 18, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_condiciones_campos_tipos_campo`
--

CREATE TABLE IF NOT EXISTS `s_condiciones_campos_tipos_campo` (
  `tic_codigo` int(11) NOT NULL,
  `conc_codigo` int(11) NOT NULL,
  PRIMARY KEY (`tic_codigo`,`conc_codigo`),
  KEY `condiciones_campos_tipos_condiciones` (`conc_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `s_condiciones_campos_tipos_campo`
--

INSERT INTO `s_condiciones_campos_tipos_campo` (`tic_codigo`, `conc_codigo`) VALUES
(1, 1),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 12),
(4, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(4, 18),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(5, 7),
(5, 12),
(5, 13),
(5, 14),
(5, 15),
(5, 16),
(5, 17),
(5, 18),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 6),
(6, 7),
(6, 12),
(6, 13),
(6, 14),
(6, 15),
(6, 16),
(6, 17),
(6, 18),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(7, 5),
(7, 6),
(7, 7),
(7, 12),
(7, 13),
(7, 14),
(7, 15),
(7, 16),
(7, 17),
(7, 18),
(8, 1),
(8, 6),
(8, 7),
(8, 8),
(8, 9),
(8, 10),
(8, 11),
(8, 14),
(8, 17),
(8, 18),
(9, 1),
(9, 2),
(9, 3),
(9, 4),
(9, 5),
(9, 6),
(9, 7),
(9, 12),
(9, 13),
(9, 14),
(9, 15),
(9, 16),
(9, 17),
(9, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_historial`
--

CREATE TABLE IF NOT EXISTS `s_historial` (
  `his_codigo` int(11) NOT NULL,
  `hia_codigo` int(11) DEFAULT NULL,
  `tab_codigo` int(11) DEFAULT NULL,
  `usua_codigo` int(11) DEFAULT NULL,
  `his_campo_a` int(11) DEFAULT NULL,
  `his_campo_n` int(11) DEFAULT NULL,
  `his_nombre_tabla_a` varchar(256) DEFAULT NULL,
  `his_nombre_tabla_n` varchar(256) DEFAULT NULL,
  `his_comentario` text,
  `his_fecha` datetime DEFAULT NULL,
  `his_deshecha` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`his_codigo`),
  KEY `historial_historial_accion` (`hia_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_historial_accion`
--

CREATE TABLE IF NOT EXISTS `s_historial_accion` (
  `hia_codigo` int(11) NOT NULL,
  `hia_nombre` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`hia_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `s_historial_accion`
--

INSERT INTO `s_historial_accion` (`hia_codigo`, `hia_nombre`) VALUES
(1, 'Tabla modificada'),
(3, 'Campo eliminado'),
(4, 'Campo modificado'),
(2, 'Tabla eliminada'),
(5, 'Usuario eliminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_oldnew_triggers`
--

CREATE TABLE IF NOT EXISTS `s_oldnew_triggers` (
  `olne_codigo` int(11) NOT NULL,
  `olne_nombre` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`olne_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `s_oldnew_triggers`
--

INSERT INTO `s_oldnew_triggers` (`olne_codigo`, `olne_nombre`) VALUES
(1, 'OLD'),
(2, 'NEW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_permisos`
--

CREATE TABLE IF NOT EXISTS `s_permisos` (
  `perm_codigo` int(11) NOT NULL,
  `perm_nombre` varchar(256) DEFAULT NULL,
  `perm_permiso` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`perm_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `s_permisos`
--

INSERT INTO `s_permisos` (`perm_codigo`, `perm_nombre`, `perm_permiso`) VALUES
(1, 'Leer', 'SELECT'),
(2, 'Insertar', 'INSERT'),
(3, 'Editar', 'UPDATE'),
(4, 'Eliminar', 'DELETE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_prefijos`
--

CREATE TABLE IF NOT EXISTS `s_prefijos` (
  `pref_codigo` int(11) NOT NULL,
  `pref_nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`pref_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `s_prefijos`
--

INSERT INTO `s_prefijos` (`pref_codigo`, `pref_nombre`) VALUES
(1, 'tab'),
(2, 'cam'),
(3, 'tic'),
(4, 'trig'),
(5, 'vis'),
(6, 'pref'),
(7, 'tiv'),
(8, 'perm'),
(9, 'usua'),
(10, 'ke');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_tablas`
--

CREATE TABLE IF NOT EXISTS `s_tablas` (
  `tab_codigo` int(11) NOT NULL,
  `tab_nombre` varchar(256) DEFAULT NULL,
  `tab_prefijo` varchar(100) DEFAULT NULL,
  `tab_nombre_tabla` varchar(256) DEFAULT NULL,
  `tab_sql` text,
  `tab_sistema` int(11) DEFAULT '0',
  `tab_vista` int(11) DEFAULT '0',
  `tab_comentario` text,
  `tab_visible` int(11) DEFAULT '1',
  PRIMARY KEY (`tab_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `s_tablas`
--

INSERT INTO `s_tablas` (`tab_codigo`, `tab_nombre`, `tab_prefijo`, `tab_nombre_tabla`, `tab_sql`, `tab_sistema`, `tab_vista`, `tab_comentario`, `tab_visible`) VALUES
(1, 'S Tablas', 'tab', 's_tablas', NULL, 1, 0, NULL, 1),
(2, 'S Campos', '', 's_campos', NULL, 1, 0, NULL, 1),
(3, 'S Tipos Campos', 'tic', 's_tipos_campos', NULL, 1, 0, NULL, 1),
(4, 'S Triggers', 'trig', 's_triggers', NULL, 1, 0, NULL, 1),
(6, 'S Prefijos', 'pref', 's_prefijos', NULL, 1, 0, NULL, 1),
(7, 'S Usuarios permisos campos', NULL, 's_usuarios_permisos_campos', NULL, 1, 0, NULL, 1),
(8, 'S Campos tipos validación', NULL, 's_campos_tipos_validacion', NULL, 1, 0, NULL, 1),
(9, 'S Tipos validación', 'tiv', 's_tipos_validacion', NULL, 1, 0, NULL, 1),
(10, 'S Permisos', 'perm', 's_permisos', NULL, 1, 0, NULL, 1),
(11, 'S Usuarios', 'usu', 's_usuarios', NULL, 1, 0, NULL, 1),
(12, 'Keys', 'ke', 'keys', NULL, 1, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_tipos_asociacion`
--

CREATE TABLE IF NOT EXISTS `s_tipos_asociacion` (
  `tias_codigo` int(11) NOT NULL,
  `tias_nombre` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`tias_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `s_tipos_asociacion`
--

INSERT INTO `s_tipos_asociacion` (`tias_codigo`, `tias_nombre`) VALUES
(1, 'INNER'),
(2, 'LEFT'),
(3, 'RIGHT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_tipos_campo`
--

CREATE TABLE IF NOT EXISTS `s_tipos_campo` (
  `tic_codigo` int(11) NOT NULL,
  `tic_nombre` varchar(256) DEFAULT NULL,
  `tic_tipo` varchar(100) DEFAULT NULL,
  `tic_longitud` int(11) DEFAULT NULL,
  PRIMARY KEY (`tic_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `s_tipos_campo`
--

INSERT INTO `s_tipos_campo` (`tic_codigo`, `tic_nombre`, `tic_tipo`, `tic_longitud`) VALUES
(1, 'VARCHAR', 'VARCHAR', 256),
(2, 'INT', 'INT', 11),
(3, 'BIG INT', 'BIG INT', 20),
(4, 'DATE', 'DATE', NULL),
(5, 'TIME', 'TIME', NULL),
(6, 'DATETIME', 'DATETIME', NULL),
(8, 'TEXT', 'TEXT', NULL),
(7, 'TINYINT', 'TINYINT', 1),
(9, 'FLOAT', 'FLOAT', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_tipos_relacion`
--

CREATE TABLE IF NOT EXISTS `s_tipos_relacion` (
  `tipr_codigo` int(11) NOT NULL,
  `tipr_nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tipr_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `s_tipos_relacion`
--

INSERT INTO `s_tipos_relacion` (`tipr_codigo`, `tipr_nombre`) VALUES
(1, 'Uno a Muchos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_tipo_accion_triggers`
--

CREATE TABLE IF NOT EXISTS `s_tipo_accion_triggers` (
  `tatr_codigo` int(11) NOT NULL,
  `tatr_nombre` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`tatr_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `s_tipo_accion_triggers`
--

INSERT INTO `s_tipo_accion_triggers` (`tatr_codigo`, `tatr_nombre`) VALUES
(1, 'Insert'),
(2, 'Update'),
(3, 'Delete');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_tipo_triggers`
--

CREATE TABLE IF NOT EXISTS `s_tipo_triggers` (
  `ttri_codigo` int(11) NOT NULL,
  `ttri_nombre` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ttri_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `s_tipo_triggers`
--

INSERT INTO `s_tipo_triggers` (`ttri_codigo`, `ttri_nombre`) VALUES
(1, 'Before'),
(2, 'After');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_triggers`
--

CREATE TABLE IF NOT EXISTS `s_triggers` (
  `trig_codigo` int(11) NOT NULL,
  `tab_codigo` int(11) DEFAULT NULL,
  `tatr_codigo` int(11) DEFAULT NULL,
  `ttri_codigo` int(11) DEFAULT NULL,
  `trig_nombre` varchar(256) DEFAULT NULL,
  `trig_nombre_trigger` varchar(256) DEFAULT NULL,
  `trig_sql` text,
  PRIMARY KEY (`trig_codigo`),
  KEY `triggers_tipo` (`ttri_codigo`),
  KEY `triggers_accion` (`tatr_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_usuarios`
--

CREATE TABLE IF NOT EXISTS `s_usuarios` (
  `usua_codigo` int(11) NOT NULL,
  `ke_id` int(11) DEFAULT NULL,
  `usua_nombre` varchar(256) NOT NULL,
  `usua_contrasena` varchar(256) DEFAULT NULL,
  `usua_nombre_db` varchar(256) DEFAULT NULL,
  `usua_visible` int(11) DEFAULT '1',
  PRIMARY KEY (`usua_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_usuarios_permisos_campos`
--

CREATE TABLE IF NOT EXISTS `s_usuarios_permisos_campos` (
  `perm_codigo` int(11) NOT NULL,
  `usua_codigo` int(11) NOT NULL,
  `cam_codigo` int(11) NOT NULL,
  PRIMARY KEY (`perm_codigo`,`usua_codigo`,`cam_codigo`),
  KEY `usuarios_permisos_campos_usuarios` (`usua_codigo`),
  KEY `usuarios_permisos_campos_campos` (`cam_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_usuarios_permisos_tablas`
--

CREATE TABLE IF NOT EXISTS `s_usuarios_permisos_tablas` (
  `usua_codigo` int(11) NOT NULL,
  `tab_codigo` int(11) NOT NULL,
  `perm_codigo` int(11) NOT NULL,
  PRIMARY KEY (`usua_codigo`,`tab_codigo`,`perm_codigo`),
  KEY `permisos_permisos_tablas` (`perm_codigo`),
  KEY `tablas_permisos_tablas` (`tab_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
