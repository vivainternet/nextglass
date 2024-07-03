# phpMyAdmin SQL Dump
# version 2.5.7-pl1
# http://www.phpmyadmin.net
#
# Servidor: localhost
# Tiempo de generación: 10-11-2007 a las 17:24:46
# Versión del servidor: 5.0.16
# Versión de PHP: 4.4.1
# 
# Base de datos : `barcode`
# 

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `altas`
#

CREATE TABLE `altas` (
  `alta_id` int(10) unsigned NOT NULL auto_increment,
  `orden` char(100) default NULL,
  `asistencia_t` char(100) default NULL,
  `marca` char(100) default NULL,
  `modelo` char(100) default NULL,
  `anio` char(4) default NULL,
  `chasis` char(100) default NULL,
  `motor` char(100) default NULL,
  `matricula` char(100) default NULL,
  `combustible` char(100) default NULL,
  `color` char(100) default NULL,
  `nivel_brindaje` char(100) default NULL,
  `multa` char(100) default NULL,
  `f_ingreso` date default NULL,
  `f_entrega` date default NULL,
  `cinta` int(1) default NULL,
  `techo` int(1) unsigned default '1',
  `sirena_s` int(1) unsigned default '0',
  `sirena_c` int(1) default NULL,
  `tanque_blindado` int(1) unsigned default '1',
  `run_flat` int(1) unsigned default '2',
  `piso_b` int(1) unsigned default '1',
  `com_motor` int(1) default NULL,
  `cob_bateria` int(1) default NULL,
  `filtro_aire` int(1) unsigned default '1',
  `techo_trans` char(100) NOT NULL,
  `color_vidrios` char(100) NOT NULL,
  `num_llanta` char(100) NOT NULL,
  `vendedor` char(100) NOT NULL,
  `vehi_taller` int(1) default NULL,
  `code_a` varchar(100) NOT NULL,
  `publico_a` int(1) NOT NULL,
  PRIMARY KEY  (`alta_id`),
  KEY `cliente` (`orden`),
  KEY `vendedor_id` (`run_flat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

#
# Volcar la base de datos para la tabla `altas`
#

INSERT INTO `altas` VALUES (1, '25', '', 'Toyota', 'Hylux', 'Admi', '265655446464', 'sds545646464', 'bfg578', 'Nafta', 'Rojo', 'RB3', '', '2007-09-11', '2007-12-11', 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, '1', 'oscuro', '656565', 'juan', 1, '*OB 25 Toyota Hylux*', 1);
INSERT INTO `altas` VALUES (2, '', '06-88', 'Peugeot', '406', '2006', 'd5665656565', 's546565656565', 'GHD158', 'Nafta', 'Verde', 'RB3', '', '2007-09-11', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'claros', '1546876', 'Jose', 0, '*AT 06-88 385 406*', 1);

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `empleados`
#

CREATE TABLE `empleados` (
  `empleado_id` int(10) unsigned NOT NULL default '0',
  `nombre_e` char(100) default NULL,
  `apellido_e` char(100) default NULL,
  `dni_e` char(100) default NULL,
  `grupo_e` char(100) default NULL,
  `code_e` char(100) NOT NULL,
  `publico_e` char(50) default '1',
  PRIMARY KEY  (`empleado_id`),
  KEY `cliente` (`nombre_e`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Volcar la base de datos para la tabla `empleados`
#

INSERT INTO `empleados` VALUES (1, 'Rodolfo', 'Fernandez', '107119881', 'Sin Grupo', '', '1');
INSERT INTO `empleados` VALUES (2, 'Rodolfo', 'Fernandez', '107119881', 'Sin Grupo', '', '1');
INSERT INTO `empleados` VALUES (3, 'Rodolfo', 'Fernandez', '107119881', 'Sin Grupo', '', '1');
INSERT INTO `empleados` VALUES (4, 'juan', 'salerno', '25177556', '', 'null', '1');
INSERT INTO `empleados` VALUES (5, 'jorge', 'Robles', '25177556', 'Produccion', 'null', '0');
INSERT INTO `empleados` VALUES (6, 'jose', 'lopez', '25584566', 'Produccion', 'E00006\n', '1');
INSERT INTO `empleados` VALUES (7, 'miguel', 'mendez', '1655996', 'Produccion', 'E00007\n', '1');
INSERT INTO `empleados` VALUES (18, 'luis', 'gonzalez', '26569989', 'Produccion', '*E00018*', '1');
INSERT INTO `empleados` VALUES (19, 'diego', 'Dotta', '20365699', 'Produccion', '*E00019*', '1');

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `login`
#

CREATE TABLE `login` (
  `userid` int(6) NOT NULL auto_increment,
  `username` char(50) default NULL,
  `nombrereal` char(100) NOT NULL,
  `password` char(100) default NULL,
  PRIMARY KEY  (`userid`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

#
# Volcar la base de datos para la tabla `login`
#

INSERT INTO `login` VALUES (1, 'admin', 'Administrador', 'mmKgxBJO0xJ2U');
INSERT INTO `login` VALUES (2, 'mauricio', 'Mauricio', 'mmKgxBJO0xJ2U');
INSERT INTO `login` VALUES (3, 'juampy', 'Juan Pablo', 'mm4Bk2Ze5n8Eg');

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `operaciones`
#

CREATE TABLE `operaciones` (
  `operaciones_id` int(10) unsigned NOT NULL auto_increment,
  `nombre_o` char(100) default NULL,
  `code_o` char(100) default NULL,
  `publico_o` int(1) default NULL,
  PRIMARY KEY  (`operaciones_id`),
  KEY `cliente` (`nombre_o`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

#
# Volcar la base de datos para la tabla `operaciones`
#

INSERT INTO `operaciones` VALUES (1, 'LAVADO', '*O00001*', 1);
INSERT INTO `operaciones` VALUES (2, 'DENTRO DE TALLER', '*O00002*', 1);
INSERT INTO `operaciones` VALUES (3, 'DESMONTAJE', '*O00003\n*', 1);
INSERT INTO `operaciones` VALUES (4, 'MOLDES', '*O00004\n*', 1);

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `procesos`
#

CREATE TABLE `procesos` (
  `procesos_id` int(10) unsigned NOT NULL auto_increment,
  `empleado` char(100) default NULL,
  `auto` char(100) default NULL,
  `operacion` char(100) NOT NULL,
  `dia` date NOT NULL,
  `inicio` datetime default NULL,
  `fin` datetime default NULL,
  `publico_p` int(1) default NULL,
  PRIMARY KEY  (`procesos_id`),
  KEY `cliente` (`empleado`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

#
# Volcar la base de datos para la tabla `procesos`
#

INSERT INTO `procesos` VALUES (1, '19', '2', '2', '2007-11-09', '2007-11-23 12:02:55', '2007-11-22 12:02:57', 1);
INSERT INTO `procesos` VALUES (2, '18', '2', '2', '2007-11-10', '2007-11-18 12:03:49', '2007-11-19 12:03:51', 1);
