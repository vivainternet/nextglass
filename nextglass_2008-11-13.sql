-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 13-11-2008 a las 16:17:27
-- Versión del servidor: 5.0.45
-- Versión de PHP: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `nextglass`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `altas`
-- 

CREATE TABLE `altas` (
  `alta_id` int(10) unsigned NOT NULL auto_increment,
  `orden` varchar(100) default NULL,
  `asistencia_t` varchar(100) default NULL,
  `marca` varchar(100) default NULL,
  `modelo` varchar(100) default NULL,
  `anio` varchar(4) default NULL,
  `chasis` varchar(100) default NULL,
  `motor` varchar(100) default NULL,
  `matricula` varchar(100) default NULL,
  `combustible` varchar(100) default NULL,
  `color` varchar(100) default NULL,
  `nivel_brindaje` varchar(100) default NULL,
  `multa` varchar(100) default NULL,
  `renar` varchar(100) default NULL,
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
  `techo_trans` varchar(100) NOT NULL default '',
  `color_vidrios` varchar(100) NOT NULL default '',
  `num_llanta` varchar(100) NOT NULL default '',
  `vendedor` varchar(100) NOT NULL default '',
  `vehi_taller` int(1) default NULL,
  `code_a` varchar(100) NOT NULL default '',
  `imagen_a` varchar(100) NOT NULL default '',
  `publico_a` int(1) NOT NULL default '0',
  PRIMARY KEY  (`alta_id`),
  KEY `cliente` (`orden`),
  KEY `vendedor_id` (`run_flat`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `altas`
-- 

INSERT INTO `altas` VALUES (1, '25', '', 'TOYOTA', 'HYLUX', '2007', '265655446464', 'SDS545646464', 'BFG578', 'NAFTA', 'ROJO', 'RB3', '1006', '', '2007-11-11', '2007-12-11', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '', 'OSCUROS', '656565', 'JUAN', 0, 'OB 25', 'DG.jpg', 1);
INSERT INTO `altas` VALUES (2, '', '50', 'PEUGEOT', '307', '2006', 'D5665656565', 'S546565656565', 'GHD158', 'NAFTA', 'VERDE', 'RB3', '', '123', '2007-09-11', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'CLAROS', '1546876', 'JOSE', 1, 'ATO 50', 'peugeot.jpg', 1);
INSERT INTO `altas` VALUES (3, '25', '', 'AUDI', 'A4', '2008', '', '', '', 'NAFTA', '', '', '', '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 0, 'OB 25 AUDI', '', 0);
INSERT INTO `altas` VALUES (4, '69', '', 'FIAT', '600', '2004', '4654564', 'DSA', 'FASF', 'NAFTA', 'FDSF', 'FDS', 'FDSF', '', '0000-00-00', '0000-00-00', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '1', 'FD', 'df', 'FD', 1, 'OB 69', '11.jpg', 1);
INSERT INTO `altas` VALUES (5, '589', '', 'FERRARI', '360', '2007', 'SP*XX*PINIFARINA', 'FE265*655X645000', 'AXO900', 'NAFTA', 'ROJO', 'RB3', '1006', '', '0000-00-00', '0000-00-00', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '1', 'OSCUROS', '656565', 'JUAN', 0, 'OB 589', 'Ferrari_430_Scuderia_1440_x_900_widescreen.jpg', 1);
INSERT INTO `altas` VALUES (6, '555', '', 'DODGE', 'TRAX', '1999', '123456', 'ASDZXC', 'ASD123', 'NAFTA', 'ANARANJADO', 'ALERGICO A LAS BALAS', 'UN MONTON', '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, '1', 'POLARIZADOS CON AEROSOL', '19', 'MICH', 1, 'OB 555', 'Rancho_Chevy_2.jpg', 1);
INSERT INTO `altas` VALUES (7, '', '100', 'VW', 'GOL 1.0 MI', '2000', '123456ABCDEF', 'ABCDEF123456', 'ABC123', 'NAFTA', 'NEGRO', 'NIVEL1', 'NINGUNA', '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'POLARIZADOS', '13', '', 0, 'ATO 100', 'wrc_03.jpg', 1);
INSERT INTO `altas` VALUES (8, '1050', '2050', 'AUDI', 'A4', '2008', 'ABC123', 'MTR456', 'CZE631', 'NAFTA', 'NEGRO', 'MAXIMO', 'NO', '', '0000-00-00', '0000-00-00', 1, 1, 0, 0, 0, 0, 1, 1, 0, 0, '', 'POLARIZADOS', '19', 'PAULITA', 1, 'OB 1050 ATO 2050', 'A4_L_10465.jpg', 1);
INSERT INTO `altas` VALUES (9, '3050', '4050', 'AUDI', 'R8', '2008', 'FGH654FGH64', '34564534564', 'AZT123', 'NAFTA', 'GRIS', 'MINIMO', 'NO', '', '0000-00-00', '0000-00-00', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 1, 'OB 3050 ATO 4050', 'r8.Par.0075.Image.jpg', 1);
INSERT INTO `altas` VALUES (10, '5060', '7080', 'AUDI', 'TT', '2005', 'ASAA', 'ASD', 'XEN000', 'NAFTA', 'GRIS', 'MAXIMO', 'SI $ 1500.-', '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, '', '', '', '', 1, 'OB 5060 ATO 7080', 'ttr_2006.Par.0022.Image.jpg', 1);
INSERT INTO `altas` VALUES (11, '456', '987', 'PEUGEOT', '607', '2007', '123456AASD', 'QWQR', 'FASF', 'NAFTA', 'GRIS', 'ANTI MONIO', '$ 1500', '750', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'POLARIZADOS CON AEROSOL', '19', 'JUAN', 1, 'OB 456 ATO 987', 'peugeot607.jpg', 1);
INSERT INTO `altas` VALUES (12, '1', '2', 'VW', 'AOLF', '2008', 'ASDAD', 'ASAFDF', 'DFS856', 'NAFTA', 'BERMELLON', 'SDF', 'DFDF', '123456790000', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', 0, 'OB 1 ATO 2', 'vwgolf.jpg', 1);
INSERT INTO `altas` VALUES (13, '1744', '5', 'VW', 'BORA', '2008', 'ABC123', 'XYZ890', 'ASD123', 'DIESEL', 'NEGRO', '5', 'NO', 'NO', '0000-00-00', '0000-00-00', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '1', 'NEGRO', '17', 'MICH', 1, 'OB 1744 ATO 5', '', 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `empleados`
-- 

CREATE TABLE `empleados` (
  `empleado_id` int(10) unsigned NOT NULL default '0',
  `nombre_e` char(100) default NULL,
  `apellido_e` char(100) default NULL,
  `dni_e` char(100) default NULL,
  `grupo_e` char(100) default NULL,
  `code_e` char(100) NOT NULL default '',
  `imagen_e` char(100) NOT NULL default '',
  `publico_e` char(50) default '1',
  PRIMARY KEY  (`empleado_id`),
  KEY `cliente` (`nombre_e`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `empleados`
-- 

INSERT INTO `empleados` VALUES (1, 'RODOLFO', 'FERNANDEZ', '10711981', 'Produccion', '*E00001*', 'img-higherEducation-thumb.jpg', '1');
INSERT INTO `empleados` VALUES (2, 'NESTOR', 'FOSTER', '18600315', 'Produccion', '*E00002*', 'img-financeAndInsurance-thumb.jpg', '1');
INSERT INTO `empleados` VALUES (3, 'JOSE', 'GIL DOMINGUEZ', '16101494', 'Produccion', '*E00003*', 'img-internetAndIp-thumb.jpg', '1');
INSERT INTO `empleados` VALUES (4, 'LUCIO', 'GONZALEZ', '28255339', 'Produccion', '*E00004*', 'img-networking-thumb.jpg', '1');
INSERT INTO `empleados` VALUES (5, 'JAVIER', 'GRAMATICO', '29698018', 'Produccion', '*E00005*', '', '1');
INSERT INTO `empleados` VALUES (6, 'JOSE', 'LOPEZ', '25584566', 'Produccion', '*E00006*', '', '1');
INSERT INTO `empleados` VALUES (7, 'JULIAN', 'PEREIRA', '24228905', 'Produccion', '*E00007*', '', '1');
INSERT INTO `empleados` VALUES (9, 'NESTOR', 'SOSA', '92248787', 'Produccion', '*E00009*', '', '1');
INSERT INTO `empleados` VALUES (10, 'SERGIO', 'URIARTE', '30413181', 'Produccion', '*E00010*', '', '1');
INSERT INTO `empleados` VALUES (15, 'MARTIN DANIEL', 'MANSILLA', '28776790', 'Produccion', '15', '', '1');
INSERT INTO `empleados` VALUES (16, 'DAVID ALBERTO', 'RABINOWICZ', '31606648', 'Produccion', '*E00016*', '', '1');
INSERT INTO `empleados` VALUES (17, 'MAURICIO', 'MICH', '30000000', 'Administrador', '*E00017*', '', '1');
INSERT INTO `empleados` VALUES (18, 'JOSE LUIS', 'PEREZ', '5670983', 'Administrador', '*E00018*', '', '1');
INSERT INTO `empleados` VALUES (19, 'MARTIN', 'GARCIA', '30400500', 'Produccion', '*E00019*', '', '1');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `login`
-- 

CREATE TABLE `login` (
  `userid` int(6) NOT NULL auto_increment,
  `username` char(50) default NULL,
  `nombrereal` char(100) NOT NULL default '',
  `password` char(100) default NULL,
  PRIMARY KEY  (`userid`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `login`
-- 

INSERT INTO `login` VALUES (1, 'admin', 'Administrador', 'mmKgxBJO0xJ2U');
INSERT INTO `login` VALUES (2, 'mauricio', 'Mauricio', 'mmKgxBJO0xJ2U');
INSERT INTO `login` VALUES (3, 'juampy', 'Juan Pablo', 'mm4Bk2Ze5n8Eg');
INSERT INTO `login` VALUES (4, 'paula', 'Paula Sayago', 'mmYnPHkgeSFA6');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `operaciones`
-- 

CREATE TABLE `operaciones` (
  `operaciones_id` int(10) unsigned NOT NULL auto_increment,
  `nombre_o` char(100) default NULL,
  `code_o` char(100) default NULL,
  `publico_o` int(1) default NULL,
  PRIMARY KEY  (`operaciones_id`),
  KEY `cliente` (`nombre_o`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `operaciones`
-- 

INSERT INTO `operaciones` VALUES (1, 'LAVADO', '1', 1);
INSERT INTO `operaciones` VALUES (2, 'DENTRO DE TALLER', '2', 1);
INSERT INTO `operaciones` VALUES (3, 'DESMONTAJE', '3', 1);
INSERT INTO `operaciones` VALUES (4, 'MOLDES', '4', 1);
INSERT INTO `operaciones` VALUES (5, 'OPACO', '5', 1);
INSERT INTO `operaciones` VALUES (6, 'VIDRIOS', '6', 1);
INSERT INTO `operaciones` VALUES (7, 'MONTAJE', '7', 1);
INSERT INTO `operaciones` VALUES (8, 'PINTURA', '8', 1);
INSERT INTO `operaciones` VALUES (9, 'CONTROL DE CALIDAD', '9', 1);
INSERT INTO `operaciones` VALUES (10, 'ASISTENCIA TECNICA', '10', 1);
INSERT INTO `operaciones` VALUES (11, 'OTROS', '11', 1);
INSERT INTO `operaciones` VALUES (12, 'MANTENIMIENTO PLANTA', '12', 1);
INSERT INTO `operaciones` VALUES (13, 'MANT. HERRERIA', '13', 1);
INSERT INTO `operaciones` VALUES (14, 'GRABAR DATOS', '14', 1);
INSERT INTO `operaciones` VALUES (15, 'BORRAR PANTALLA', '15', 1);
INSERT INTO `operaciones` VALUES (16, 'ADMINISTRAR', '16', 1);
INSERT INTO `operaciones` VALUES (17, 'MICH', '17', 0);
INSERT INTO `operaciones` VALUES (18, 'OPERACION DE PRUEBA', '18', 1);
INSERT INTO `operaciones` VALUES (19, 'VIDRIOS', '', 0);
INSERT INTO `operaciones` VALUES (20, 'VIDRIOS', '', 0);
INSERT INTO `operaciones` VALUES (21, 'XX', '', 0);
INSERT INTO `operaciones` VALUES (22, 'Z', '', 0);
INSERT INTO `operaciones` VALUES (23, 'B', '', 0);
INSERT INTO `operaciones` VALUES (24, 'AA', '', 0);
INSERT INTO `operaciones` VALUES (25, 'A', '', 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `procesos`
-- 

CREATE TABLE `procesos` (
  `procesos_id` int(10) unsigned NOT NULL auto_increment,
  `empleado` char(100) default NULL,
  `auto` char(100) default NULL,
  `operacion` char(100) NOT NULL default '',
  `dia` date NOT NULL default '0000-00-00',
  `inicio` datetime default NULL,
  `fin` datetime NOT NULL default '0000-00-00 00:00:00',
  `code_p` char(100) NOT NULL default '',
  `publico_p` int(1) default NULL,
  PRIMARY KEY  (`procesos_id`),
  KEY `cliente` (`empleado`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `procesos`
-- 

INSERT INTO `procesos` VALUES (1, '1', '6', '16', '2008-04-28', '2008-04-28 19:21:54', '2008-04-28 19:50:04', '', 1);
INSERT INTO `procesos` VALUES (2, '2', '6', '16', '2008-04-28', '2008-04-28 19:25:07', '2008-04-28 20:00:55', '', 1);
INSERT INTO `procesos` VALUES (3, '19', '8', '10', '2008-04-28', '2008-04-28 19:58:02', '2008-04-28 20:01:33', '', 1);
INSERT INTO `procesos` VALUES (4, '19', '8', '16', '2008-04-28', '2008-04-28 19:59:33', '2008-04-28 20:01:58', '', 1);
INSERT INTO `procesos` VALUES (5, '2', '8', '16', '2008-04-28', '2008-04-28 20:00:21', '2008-04-28 20:02:20', '', 1);
INSERT INTO `procesos` VALUES (6, '2', '8', '16', '0000-00-00', '2008-09-23 08:06:00', '2008-09-24 10:15:00', '', 1);
INSERT INTO `procesos` VALUES (7, '2', '10', '3', '0000-00-00', '2008-09-22 17:30:54', '2008-09-24 10:15:50', '', 1);
INSERT INTO `procesos` VALUES (8, '2', '8', '3', '0000-00-00', '2008-09-22 17:32:23', '2008-09-24 10:16:14', '', 1);
INSERT INTO `procesos` VALUES (9, '2', '9', '3', '2008-09-22', '2008-09-22 17:32:49', '2008-09-24 10:17:40', '', 1);
INSERT INTO `procesos` VALUES (10, '1', '8', '16', '2008-09-22', '2008-09-22 17:34:39', '2008-09-22 17:35:03', '', 1);
INSERT INTO `procesos` VALUES (11, '1', '8', '3', '0000-00-00', '2008-09-23 10:19:28', '2008-09-24 08:44:00', '', 1);
INSERT INTO `procesos` VALUES (12, '1', '8', '16', '2008-09-22', '2008-09-22 17:35:51', '2008-09-22 17:41:30', '', 1);
INSERT INTO `procesos` VALUES (13, '1', '1', '3', '2008-09-22', '2008-09-22 20:44:48', '2008-09-22 20:45:41', '', 1);
INSERT INTO `procesos` VALUES (14, '1', '1', '14', '2008-09-22', '2008-09-22 20:45:24', '0000-00-00 00:00:00', '', 1);
INSERT INTO `procesos` VALUES (15, '16', '13', '9', '2008-09-24', '2008-09-24 10:34:43', '2008-09-24 10:34:45', '*P00020*', 1);
INSERT INTO `procesos` VALUES (16, '16', '1', '16', '2008-09-24', '2008-09-24 10:32:48', '2008-09-24 10:30:37', '*P00020*', 1);
INSERT INTO `procesos` VALUES (17, '16', '8', '16', '2008-09-24', '2008-09-24 10:32:36', '2008-09-24 10:33:09', '*P00020*', 1);
