-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-01-2019 a las 22:00:18
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tirexpress_db`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_categorias` ()  BEGIN
 select id_categoria, descripcion, estado, id_empresa  from tb_categorias;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ciudades` ()  BEGIN
 select id_ciudad,  nombre, estado  from tb_ciudades ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_clientes` ()  BEGIN

select id_cliente, id_empresa, razon_social, direccion, telefono,ruc, id_ciudad, cupo_credito, id_vendedor, estado  
from tb_clientes ;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CONSULTA_CLIENTES` (`p_vendedor` INT)  BEGIN

select id_cliente, razon_social, direccion, telefono, ruc, cupo_credito, estado  
from tb_clientes  
where id_vendedor = p_vendedor ;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_EMPRESAS` ()  BEGIN
 select  id_empresa , razon_social, direccion, ruc , telefono, logo 
 from tb_empresas  ;
 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INSERTAR_EMPRESA` (IN `p_razon` VARCHAR(80), IN `p_direccion` VARCHAR(80), IN `p_ruc` VARCHAR(15), IN `p_telefono` VARCHAR(25), IN `p_logo` VARCHAR(80))  BEGIN
 insert into tb_empresas 
 (razon_social,direccion, ruc, telefono, logo) values(p_razon,p_direccion,p_ruc,p_telefono, p_logo); 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_productos` ()  BEGIN
select id_producto, id_empresa, descripcion, id_categoria, precio_vta, costo, por_promocion, estado, usr_ingreso, fec_ingreso , destacado
from tb_productos ;
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_TABLA_DESCUENTO` ()  BEGIN
select id_descuento, rango_desde, rango_hasta, porcentaje, estado , id_empresa 
from tb_tabla_descto  ;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_vendedores` ()  BEGIN
select id_vendedor, nombres, cedula, direccion, id_zona, estado, 
usr_ingreso, fec_ingreso , id_empresa 
from tb_vendedores ;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ZONAS` ()  BEGIN
 select  id_zona , descripcion, estado
 from tb_zonas   ;
 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pbcatcol`
--

CREATE TABLE `pbcatcol` (
  `pbc_tnam` char(193) NOT NULL,
  `pbc_tid` int(11) DEFAULT NULL,
  `pbc_ownr` char(65) NOT NULL,
  `pbc_cnam` char(193) NOT NULL,
  `pbc_cid` smallint(6) DEFAULT NULL,
  `pbc_labl` varchar(254) DEFAULT NULL,
  `pbc_lpos` smallint(6) DEFAULT NULL,
  `pbc_hdr` varchar(254) DEFAULT NULL,
  `pbc_hpos` smallint(6) DEFAULT NULL,
  `pbc_jtfy` smallint(6) DEFAULT NULL,
  `pbc_mask` varchar(31) DEFAULT NULL,
  `pbc_case` smallint(6) DEFAULT NULL,
  `pbc_hght` smallint(6) DEFAULT NULL,
  `pbc_wdth` smallint(6) DEFAULT NULL,
  `pbc_ptrn` varchar(31) DEFAULT NULL,
  `pbc_bmap` char(1) DEFAULT NULL,
  `pbc_init` varchar(254) DEFAULT NULL,
  `pbc_cmnt` varchar(254) DEFAULT NULL,
  `pbc_edit` varchar(31) DEFAULT NULL,
  `pbc_tag` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pbcatedt`
--

CREATE TABLE `pbcatedt` (
  `pbe_name` varchar(30) NOT NULL,
  `pbe_edit` varchar(254) DEFAULT NULL,
  `pbe_type` smallint(6) DEFAULT NULL,
  `pbe_cntr` int(11) DEFAULT NULL,
  `pbe_seqn` smallint(6) NOT NULL,
  `pbe_flag` int(11) DEFAULT NULL,
  `pbe_work` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pbcatedt`
--

INSERT INTO `pbcatedt` (`pbe_name`, `pbe_edit`, `pbe_type`, `pbe_cntr`, `pbe_seqn`, `pbe_flag`, `pbe_work`) VALUES
('#####', '#####', 90, 1, 1, 32, '10'),
('###,###.00', '###,###.00', 90, 1, 1, 32, '10'),
('###-##-####', '###-##-####', 90, 1, 1, 32, '00'),
('DD/MM/YY', 'DD/MM/YY', 90, 1, 1, 32, '20'),
('DD/MM/YY HH:MM:SS', 'DD/MM/YY HH:MM:SS', 90, 1, 1, 32, '40'),
('DD/MM/YY HH:MM:SS:FFFFFF', 'DD/MM/YY HH:MM:SS:FFFFFF', 90, 1, 1, 32, '40'),
('DD/MM/YYYY', 'DD/MM/YYYY', 90, 1, 1, 32, '20'),
('DD/MM/YYYY HH:MM:SS', 'DD/MM/YYYY HH:MM:SS', 90, 1, 1, 32, '40'),
('DD/MMM/YY', 'DD/MMM/YY', 90, 1, 1, 32, '20'),
('DD/MMM/YY HH:MM:SS', 'DD/MMM/YY HH:MM:SS', 90, 1, 1, 32, '40'),
('HH:MM:SS', 'HH:MM:SS', 90, 1, 1, 32, '30'),
('HH:MM:SS:FFF', 'HH:MM:SS:FFF', 90, 1, 1, 32, '30'),
('HH:MM:SS:FFFFFF', 'HH:MM:SS:FFFFFF', 90, 1, 1, 32, '30'),
('JJJ/YY', 'JJJ/YY', 90, 1, 1, 32, '20'),
('JJJ/YY HH:MM:SS', 'JJJ/YY HH:MM:SS', 90, 1, 1, 32, '40'),
('JJJ/YYYY', 'JJJ/YYYY', 90, 1, 1, 32, '20'),
('JJJ/YYYY HH:MM:SS', 'JJJ/YYYY HH:MM:SS', 90, 1, 1, 32, '40'),
('MM/DD/YY', 'MM/DD/YY', 90, 1, 1, 32, '20'),
('MM/DD/YY HH:MM:SS', 'MM/DD/YY HH:MM:SS', 90, 1, 1, 32, '40'),
('MM/DD/YYYY', 'MM/DD/YYYY', 90, 1, 1, 32, '20'),
('MM/DD/YYYY HH:MM:SS', 'MM/DD/YYYY HH:MM:SS', 90, 1, 1, 32, '40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pbcatfmt`
--

CREATE TABLE `pbcatfmt` (
  `pbf_name` varchar(30) NOT NULL,
  `pbf_frmt` varchar(254) DEFAULT NULL,
  `pbf_type` smallint(6) DEFAULT NULL,
  `pbf_cntr` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pbcatfmt`
--

INSERT INTO `pbcatfmt` (`pbf_name`, `pbf_frmt`, `pbf_type`, `pbf_cntr`) VALUES
('#,##0', '#,##0', 81, 0),
('#,##0.00', '#,##0.00', 81, 0),
('$#,##0.00;($#,##0.00)', '$#,##0.00;($#,##0.00)', 81, 0),
('$#,##0.00;[RED]($#,##0.00)', '$#,##0.00;[RED]($#,##0.00)', 81, 0),
('$#,##0;($#,##0)', '$#,##0;($#,##0)', 81, 0),
('$#,##0;[RED]($#,##0)', '$#,##0;[RED]($#,##0)', 81, 0),
('0', '0', 81, 0),
('0%', '0%', 81, 0),
('0.00', '0.00', 81, 0),
('0.00%', '0.00%', 81, 0),
('0.00E+00', '0.00E+00', 81, 0),
('d-mmm', 'd-mmm', 84, 0),
('d-mmm-yy', 'd-mmm-yy', 84, 0),
('h:mm AM/PM', 'h:mm AM/PM', 84, 0),
('h:mm:ss', 'h:mm:ss', 84, 0),
('h:mm:ss AM/PM', 'h:mm:ss AM/PM', 84, 0),
('m/d/yy', 'm/d/yy', 84, 0),
('m/d/yy h:mm', 'm/d/yy h:mm', 84, 0),
('mmm-yy', 'mmm-yy', 84, 0),
('[General]', '[General]', 81, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pbcattbl`
--

CREATE TABLE `pbcattbl` (
  `pbt_tnam` char(193) NOT NULL,
  `pbt_tid` int(11) DEFAULT NULL,
  `pbt_ownr` char(65) NOT NULL,
  `pbd_fhgt` smallint(6) DEFAULT NULL,
  `pbd_fwgt` smallint(6) DEFAULT NULL,
  `pbd_fitl` char(1) DEFAULT NULL,
  `pbd_funl` char(1) DEFAULT NULL,
  `pbd_fchr` smallint(6) DEFAULT NULL,
  `pbd_fptc` smallint(6) DEFAULT NULL,
  `pbd_ffce` char(18) DEFAULT NULL,
  `pbh_fhgt` smallint(6) DEFAULT NULL,
  `pbh_fwgt` smallint(6) DEFAULT NULL,
  `pbh_fitl` char(1) DEFAULT NULL,
  `pbh_funl` char(1) DEFAULT NULL,
  `pbh_fchr` smallint(6) DEFAULT NULL,
  `pbh_fptc` smallint(6) DEFAULT NULL,
  `pbh_ffce` char(18) DEFAULT NULL,
  `pbl_fhgt` smallint(6) DEFAULT NULL,
  `pbl_fwgt` smallint(6) DEFAULT NULL,
  `pbl_fitl` char(1) DEFAULT NULL,
  `pbl_funl` char(1) DEFAULT NULL,
  `pbl_fchr` smallint(6) DEFAULT NULL,
  `pbl_fptc` smallint(6) DEFAULT NULL,
  `pbl_ffce` char(18) DEFAULT NULL,
  `pbt_cmnt` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pbcatvld`
--

CREATE TABLE `pbcatvld` (
  `pbv_name` varchar(30) NOT NULL,
  `pbv_vald` varchar(254) DEFAULT NULL,
  `pbv_type` smallint(6) DEFAULT NULL,
  `pbv_cntr` int(11) DEFAULT NULL,
  `pbv_msg` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_categorias`
--

CREATE TABLE `tb_categorias` (
  `id_categoria` int(11) NOT NULL,
  `descripcion` varchar(70) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `usr_ingreso` varchar(25) DEFAULT NULL,
  `fec_ingreso` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_categorias`
--

INSERT INTO `tb_categorias` (`id_categoria`, `descripcion`, `estado`, `id_empresa`, `usr_ingreso`, `fec_ingreso`) VALUES
(1, 'AROS COBRA', 'A', 1, '', '2018-12-20'),
(2, 'AROS  ACELERA', 'A', 1, '', '2018-12-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ciudades`
--

CREATE TABLE `tb_ciudades` (
  `id_ciudad` int(11) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  `usr_ingreso` varchar(25) DEFAULT NULL,
  `fec_ingreso` date DEFAULT NULL,
  `iniciales` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_ciudades`
--

INSERT INTO `tb_ciudades` (`id_ciudad`, `nombre`, `estado`, `usr_ingreso`, `fec_ingreso`, `iniciales`) VALUES
(3, 'GUAYAQUIL', 'A', '', '2018-12-22', NULL),
(4, 'AMBATO 12', 'A', '', '2018-12-22', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `id_cliente` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `razon_social` varchar(80) NOT NULL,
  `direccion` varchar(80) NOT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `ruc` varchar(15) NOT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `cupo_credito` decimal(10,2) DEFAULT NULL,
  `usr_ingreso` varchar(45) DEFAULT NULL,
  `fec_ingreso` date DEFAULT NULL,
  `id_vendedor` int(11) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_clientes`
--

INSERT INTO `tb_clientes` (`id_cliente`, `id_empresa`, `razon_social`, `direccion`, `telefono`, `ruc`, `id_ciudad`, `cupo_credito`, `usr_ingreso`, `fec_ingreso`, `id_vendedor`, `estado`) VALUES
(1, 1, 'LLANTERA OSO ', 'GUAYAQUIL', '097502707', '0915664783001', 1, '750.00', '', '2018-12-20', 4, 'A'),
(2, 1, 'LLANTERA AMBATO', 'GUAYAQUIL / ALBORADA ', '097502707', '0999999999', 2, '500.00', '', '2018-12-20', 2, 'A'),
(3, 1, 'FERRETERIA ESPINOZA', 'GUAYAQUIL', NULL, '09156647863001', 4, '5000.00', '', '2018-12-22', 2, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_empresas`
--

CREATE TABLE `tb_empresas` (
  `id_empresa` int(11) NOT NULL,
  `razon_social` varchar(45) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `ruc` varchar(15) NOT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `logo` varchar(80) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_empresas`
--

INSERT INTO `tb_empresas` (`id_empresa`, `razon_social`, `direccion`, `ruc`, `telefono`, `logo`, `estado`) VALUES
(2, 'LLANTAX S.A', 'ALBORADA 12 ETAPA', '0988888888888', '097502707', 'SIN LOGO2', ''),
(3, 'BOTIGELI', 'ALBORADA 12 ETAPA', '0977777777777', '097502707', 'SIN LOGO 3 -123', ''),
(6, 'BOTIGELI', 'ALBORADA 12 ETAPA', '0977777777777', '097502707', 'SIN LOGO', ''),
(7, 'BOTIGELI', 'ALBORADA 12 ETAPA', '0977777777777', '097502707', 'SIN LOGO', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_pedidos`
--

CREATE TABLE `tb_pedidos` (
  `id_pedido` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `id_vendedor` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `descuento` decimal(10,2) DEFAULT NULL,
  `impuesto` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `porc_descto` decimal(10,2) DEFAULT NULL,
  `comentario` varchar(70) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  `fecha_estado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_pedidos`
--

INSERT INTO `tb_pedidos` (`id_pedido`, `fecha`, `id_vendedor`, `id_cliente`, `subtotal`, `descuento`, `impuesto`, `total`, `porc_descto`, `comentario`, `estado`, `fecha_estado`) VALUES
(1, '2018-12-22 00:00:00', 2, 2, '2397.84', '359.68', '244.58', '2282.74', '15.00', NULL, 'P', '2018-12-22 00:00:00'),
(2, '2018-12-22 00:00:00', 2, 2, '962.76', '116.69', '101.53', '947.60', '12.12', NULL, 'P', '2018-12-22 00:00:00'),
(3, '2018-12-22 00:00:00', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'I', NULL),
(4, '2018-12-22 00:00:00', 2, 2, '149.76', '18.15', '15.79', '147.40', '12.12', NULL, 'P', '2018-12-22 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_pedidos_det`
--

CREATE TABLE `tb_pedidos_det` (
  `id_pedido` int(11) NOT NULL,
  `secuencial` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `por_promocion` decimal(10,2) DEFAULT NULL,
  `precio_vta` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_pedidos_det`
--

INSERT INTO `tb_pedidos_det` (`id_pedido`, `secuencial`, `id_producto`, `cantidad`, `por_promocion`, `precio_vta`) VALUES
(1, 1, 2, '3.00', '4.00', '78.00'),
(1, 2, 2, '4.00', '4.00', '78.00'),
(1, 3, 2, '5.00', '4.00', '78.00'),
(1, 4, 2, '6.00', '4.00', '78.00'),
(1, 5, 1, '7.00', NULL, '75.00'),
(1, 6, 1, '7.00', NULL, '75.00'),
(2, 1, 2, '2.00', '4.00', '78.00'),
(2, 2, 1, '5.00', NULL, '75.00'),
(2, 4, 1, '2.00', NULL, '75.00'),
(4, 1, 2, '2.00', '4.00', '78.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_productos`
--

CREATE TABLE `tb_productos` (
  `id_producto` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `descripcion` varchar(80) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `precio_vta` decimal(10,2) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  `por_promocion` decimal(10,2) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  `destacado` varchar(1) DEFAULT NULL,
  `usr_ingreso` varchar(25) DEFAULT NULL,
  `fec_ingreso` date DEFAULT NULL,
  `stock` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_productos`
--

INSERT INTO `tb_productos` (`id_producto`, `id_empresa`, `descripcion`, `id_categoria`, `precio_vta`, `costo`, `por_promocion`, `estado`, `destacado`, `usr_ingreso`, `fec_ingreso`, `stock`) VALUES
(1, 1, '130 X 15 10  CON TUBO ', 1, '75.00', '45.00', NULL, 'A', 'S', '', '2018-12-21', NULL),
(2, 1, 'ARO 16X 7 X 2', 1, '78.00', '47.00', '4.00', 'A', 'S', '', '2018-12-21', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tabla_descto`
--

CREATE TABLE `tb_tabla_descto` (
  `id_descuento` int(11) NOT NULL,
  `rango_desde` decimal(10,2) DEFAULT NULL,
  `rango_hasta` decimal(10,2) DEFAULT NULL,
  `porcentaje` decimal(10,2) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  `usr_ingreso` varchar(25) DEFAULT NULL,
  `fec_ingreso` date DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_tabla_descto`
--

INSERT INTO `tb_tabla_descto` (`id_descuento`, `rango_desde`, `rango_hasta`, `porcentaje`, `estado`, `usr_ingreso`, `fec_ingreso`, `id_empresa`) VALUES
(1, '1.00', '1000.00', '12.12', 'A', NULL, NULL, NULL),
(2, '1001.00', '2000.00', '23.12', 'A', NULL, NULL, NULL),
(3, '2001.00', '3000.00', '15.00', 'A', NULL, NULL, NULL),
(4, '3001.00', '4001.00', '25.12', 'A', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `status` int(1) DEFAULT NULL COMMENT '1 = active 0 = inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `user`, `email`, `password`, `full_name`, `status`) VALUES
(1, 'ferichav', 'ferichav@espol.edu.ec', 'd180be1466aaf5547c5d712aa1a94190', 'Félix Chávez', 1),
(2, 'emiaalci', 'emiaalci@espol.edu.ec', '50f6d9e888efc719335676aba05fc0fa', 'Emily Alcivar', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuario_pedidos`
--

CREATE TABLE `tb_usuario_pedidos` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(25) DEFAULT NULL,
  `contrasenia` varchar(25) NOT NULL,
  `id_vendedor` int(11) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  `fec_ingreso` date DEFAULT NULL,
  `usr_ingreso` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_usuario_pedidos`
--

INSERT INTO `tb_usuario_pedidos` (`id_usuario`, `usuario`, `contrasenia`, `id_vendedor`, `estado`, `fec_ingreso`, `usr_ingreso`) VALUES
(1, 'JC', '123', 2, 'A', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_vendedores`
--

CREATE TABLE `tb_vendedores` (
  `id_vendedor` int(11) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `cedula` varchar(15) DEFAULT NULL,
  `direccion` varchar(80) NOT NULL,
  `id_zona` int(11) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  `usr_ingreso` varchar(25) DEFAULT NULL,
  `fec_ingreso` date DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `iniciales` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_vendedores`
--

INSERT INTO `tb_vendedores` (`id_vendedor`, `nombres`, `cedula`, `direccion`, `id_zona`, `estado`, `usr_ingreso`, `fec_ingreso`, `id_empresa`, `iniciales`) VALUES
(1, 'ERNESTO ORELLANA', '0999999999', 'GUAYAQUIL', 1, 'A', 'USER1', '2018-12-20', 1, 'EO'),
(2, 'MOSTRADOR', '0999999999', 'GUAYAQUIL', 1, 'A', 'USER1', '2018-12-20', 1, 'MO'),
(3, 'SEGUNDO JHONSON', '0999999999', 'GUAYAQUIL', 1, 'A', 'USER1', '2018-12-20', 1, 'SJ'),
(4, 'FERNANDO FIGUEROA', '0999999999', 'GUAYAQUIL', 1, 'A', 'USER1', '2018-12-20', 1, 'FF'),
(5, 'CLAUDIA ORELLANA', '0999999999', 'GUAYAQUIL', 1, 'A', 'USER1', '2018-12-20', 1, 'CO'),
(6, 'MARIUXI AREVALO', '0999999999', 'GUAYAQUIL', 1, 'A', 'USER1', '2018-12-20', 1, 'MA'),
(7, 'RENATO YAGUAL', '0999999999', 'GUAYAQUIL', 1, 'A', 'USER1', '2018-12-20', 1, 'RY'),
(8, 'CARLOS PACHECO', '0999999999', 'GUAYAQUIL', 1, 'A', 'USER1', '2018-12-20', 1, 'YY'),
(9, 'OMAR ALVARADO', '0999999999', 'GUAYAQUIL', 1, 'A', 'USER1', '2018-12-20', 1, 'OM'),
(10, 'ALFREDO SANCHEZ', '0999999999', 'GUAYAQUIL', 1, 'A', 'USER1', '2018-12-20', 1, 'AS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_zonas`
--

CREATE TABLE `tb_zonas` (
  `id_zona` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  `usr_ingreso` varchar(45) DEFAULT NULL,
  `fec_ingreso` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_zonas`
--

INSERT INTO `tb_zonas` (`id_zona`, `descripcion`, `estado`, `usr_ingreso`, `fec_ingreso`) VALUES
(1, 'GUAYAS', 'A', '', '2018-12-19'),
(2, 'LOJA', 'A', '', '2018-12-19'),
(3, 'CUENCA1', 'A', '', '2018-12-19');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pbcatcol`
--
ALTER TABLE `pbcatcol`
  ADD UNIQUE KEY `pbcatc_x` (`pbc_tnam`,`pbc_ownr`,`pbc_cnam`);

--
-- Indices de la tabla `pbcatedt`
--
ALTER TABLE `pbcatedt`
  ADD UNIQUE KEY `pbcate_x` (`pbe_name`,`pbe_seqn`);

--
-- Indices de la tabla `pbcatfmt`
--
ALTER TABLE `pbcatfmt`
  ADD UNIQUE KEY `pbcatf_x` (`pbf_name`);

--
-- Indices de la tabla `pbcattbl`
--
ALTER TABLE `pbcattbl`
  ADD UNIQUE KEY `pbcatt_x` (`pbt_tnam`,`pbt_ownr`);

--
-- Indices de la tabla `pbcatvld`
--
ALTER TABLE `pbcatvld`
  ADD UNIQUE KEY `pbcatv_x` (`pbv_name`);

--
-- Indices de la tabla `tb_categorias`
--
ALTER TABLE `tb_categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `tb_ciudades`
--
ALTER TABLE `tb_ciudades`
  ADD PRIMARY KEY (`id_ciudad`);

--
-- Indices de la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `fk_cliente1_idx` (`id_vendedor`),
  ADD KEY `fk_cliente2_idx` (`id_ciudad`);

--
-- Indices de la tabla `tb_empresas`
--
ALTER TABLE `tb_empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `tb_pedidos`
--
ALTER TABLE `tb_pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_pedido1_idx` (`id_cliente`),
  ADD KEY `fk_pedido2_idx` (`id_vendedor`);

--
-- Indices de la tabla `tb_pedidos_det`
--
ALTER TABLE `tb_pedidos_det`
  ADD PRIMARY KEY (`id_pedido`,`secuencial`),
  ADD KEY `fk2_pedido_idx` (`id_producto`),
  ADD KEY `fk3_pedido_idx` (`id_producto`);

--
-- Indices de la tabla `tb_productos`
--
ALTER TABLE `tb_productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk1_productos_idx` (`id_categoria`);

--
-- Indices de la tabla `tb_tabla_descto`
--
ALTER TABLE `tb_tabla_descto`
  ADD PRIMARY KEY (`id_descuento`);

--
-- Indices de la tabla `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `tb_usuario_pedidos`
--
ALTER TABLE `tb_usuario_pedidos`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `tb_vendedores`
--
ALTER TABLE `tb_vendedores`
  ADD PRIMARY KEY (`id_vendedor`);

--
-- Indices de la tabla `tb_zonas`
--
ALTER TABLE `tb_zonas`
  ADD PRIMARY KEY (`id_zona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_categorias`
--
ALTER TABLE `tb_categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tb_ciudades`
--
ALTER TABLE `tb_ciudades`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tb_empresas`
--
ALTER TABLE `tb_empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tb_pedidos`
--
ALTER TABLE `tb_pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tb_productos`
--
ALTER TABLE `tb_productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tb_tabla_descto`
--
ALTER TABLE `tb_tabla_descto`
  MODIFY `id_descuento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tb_usuario_pedidos`
--
ALTER TABLE `tb_usuario_pedidos`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tb_vendedores`
--
ALTER TABLE `tb_vendedores`
  MODIFY `id_vendedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tb_zonas`
--
ALTER TABLE `tb_zonas`
  MODIFY `id_zona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD CONSTRAINT `fk_cliente1` FOREIGN KEY (`id_vendedor`) REFERENCES `tb_vendedores` (`id_vendedor`);

--
-- Filtros para la tabla `tb_pedidos`
--
ALTER TABLE `tb_pedidos`
  ADD CONSTRAINT `fk_pedido1` FOREIGN KEY (`id_cliente`) REFERENCES `tb_clientes` (`id_cliente`),
  ADD CONSTRAINT `fk_pedido2` FOREIGN KEY (`id_vendedor`) REFERENCES `tb_vendedores` (`id_vendedor`);

--
-- Filtros para la tabla `tb_pedidos_det`
--
ALTER TABLE `tb_pedidos_det`
  ADD CONSTRAINT `fk1_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `tb_pedidos` (`id_pedido`),
  ADD CONSTRAINT `fk3_pedido` FOREIGN KEY (`id_producto`) REFERENCES `tb_productos` (`id_producto`);

--
-- Filtros para la tabla `tb_productos`
--
ALTER TABLE `tb_productos`
  ADD CONSTRAINT `fk1_productos` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
