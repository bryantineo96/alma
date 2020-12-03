-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-09-2020 a las 01:22:26
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `base_almacen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `botella`
--

CREATE TABLE `botella` (
  `idbotella` int(11) NOT NULL,
  `cod_botella` varchar(15) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `unidad` varchar(8) NOT NULL,
  `medida` int(11) NOT NULL,
  `estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `botella`
--

INSERT INTO `botella` (`idbotella`, `cod_botella`, `idproveedor`, `descripcion`, `unidad`, `medida`, `estado`) VALUES
(7, '9512675', 1, 'OXIGENO', 'M3', 10, 'SALIDA PRESTAMO'),
(8, '9571815', 1, 'OXIGENO', 'M3', 10, 'SALIDA TRANSFERENCIA'),
(9, '1372185', 1, 'OXIGENO', 'M3', 10, NULL),
(10, '9021571', 1, 'OXIGENO', 'M3', 10, ''),
(11, '9225171', 1, 'OXIGENO', 'M3', 10, ''),
(12, '292319', 1, 'ACETILENO', 'KG', 10, ''),
(13, '73640', 1, 'ARGON', 'M3', 10, ''),
(14, '1238034', 1, 'ARGON', 'M3', 10, ''),
(15, '18K473004', 1, 'ARGON', 'M3', 10, ''),
(16, '18Y061161', 1, 'ARGON', 'M3', 10, ''),
(17, '1393098', 1, 'ARGON', 'M3', 10, ''),
(18, '7882185', 1, 'OXIGENO', 'M3', 10, ''),
(19, '1372187', 1, 'OXIGENO', 'M3', 10, ''),
(20, '19K364093', 1, 'NITROGENO', 'M3', 10, ''),
(21, '218045', 1, 'NITROGENO', 'M3', 10, ''),
(22, '4464', 1, 'NITROGENO', 'M3', 10, ''),
(23, '18X022161', 1, 'ARGON', 'M3', 10, ''),
(24, '9571818', 1, 'OXIGENO', 'M3', 10, ''),
(25, '160471', 1, 'ACETILENO', 'KG', 10, ''),
(26, '1143059', 1, 'OXIGENO', 'M3', 10, ''),
(27, '4057991', 5, 'OXIGENO', 'M3', 10, 'INGRESO COMPRA'),
(28, '672103', 5, 'OXIGENO', 'M3', 10, 'INGRESO COMPRA'),
(29, '670531', 5, 'OXIGENO', 'M3', 10, 'INGRESO COMPRA'),
(30, '674492', 5, 'OXIGENO', 'M3', 10, 'INGRESO COMPRA'),
(31, '3803', 5, 'OXIGENO', 'M3', 10, 'INGRESO COMPRA'),
(33, '9522115', 3, 'OXIGENO', 'M3', 10, 'SALIDA PRESTAMO'),
(34, 'Y999033', 2, 'OXIGENO MEDICINAL', 'M3', 10, 'SALIDA PRESTAMO'),
(36, '972521', 1, 'ARGON', 'M3', 10, ''),
(37, '18K271077', 1, 'ARGON', 'M3', 10, ''),
(38, '18K476029', 1, 'ARGON', 'M3', 10, ''),
(39, '92114', 1, 'ARGON', 'M3', 10, ''),
(40, '9493032', 1, 'ARGON', 'M3', 10, ''),
(41, '156449', 3, 'OXIGENO', 'M3', 10, 'SALIDA DEVOLUCION A PROVEEDOR'),
(42, 'A45518', 3, 'OXIGENO', 'M3', 10, 'SALIDA TRANSFERENCIA'),
(43, '308102', 3, 'OXIGENO', 'M3', 10, 'SALIDA DEVOLUCION A PROVEEDOR'),
(44, 'A2562', 3, 'OXIGENO', 'M3', 10, 'SALIDA DEVOLUCION A PROVEEDOR'),
(45, '969718', 3, 'OXIGENO', 'M3', 10, 'INGRESO COMPRA'),
(46, '674447', 3, 'OXIGENO', 'M3', 10, 'SALIDA TRANSFERENCIA'),
(47, '241057', 3, 'OXIGENO', 'M3', 10, 'SALIDA DEVOLUCION A PROVEEDOR'),
(48, '294331', 3, 'OXIGENO', 'M3', 10, 'SALIDA DEVOLUCION A PROVEEDOR'),
(49, '300138', 9, 'NITROGENO', 'M3', 10, 'INGRESO COMPRA'),
(50, '300118', 9, 'NITROGENO', 'M3', 10, 'INGRESO COMPRA'),
(51, '50010', 9, 'NITROGENO', 'M3', 10, 'INGRESO COMPRA'),
(52, '300237', 9, 'NITROGENO', 'M3', 10, 'INGRESO COMPRA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento`
--

CREATE TABLE `movimiento` (
  `idmovimiento` int(11) NOT NULL,
  `fecha_mov` datetime NOT NULL,
  `tipo_mov` varchar(45) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `doc_ext` varchar(45) DEFAULT NULL,
  `doc_int` varchar(45) DEFAULT NULL,
  `observacion` varchar(150) NOT NULL,
  `estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `movimiento`
--

INSERT INTO `movimiento` (`idmovimiento`, `fecha_mov`, `tipo_mov`, `idproveedor`, `doc_ext`, `doc_int`, `observacion`, `estado`) VALUES
(36, '2020-07-10 16:28:25', 'SALIDA PRESTAMO', 6, '', 'G.S.F 00897', 'PRESTAMO A VICTOR PARA FLOTA', 'Aceptado'),
(37, '2020-08-26 16:44:19', 'INGRESO COMPRA', 5, '470-162', '470-162', 'INGRESO POR COMPRA', 'Aceptado'),
(38, '2020-07-01 17:02:26', 'SALIDA TRANSFERENCIA', 2, '', 'G.S 9207', 'PRESTAMO PTA BAJA', 'Aceptado'),
(39, '2020-06-25 17:25:25', 'SALIDA PRESTAMO', 7, '', 'GS.9192', 'PRESTAMO AUTORIZADO POR BARUCH', 'Aceptado'),
(40, '2020-08-14 17:37:38', 'SALIDA PRESTAMO', 8, '', 'GE. 9312', 'PRESTAMO AUTORIZADO POR BARUCH', 'Aceptado'),
(41, '2020-05-26 17:38:42', 'INGRESO COMPRA', 3, '128-21224', '', 'ASIGNACION DE BOTELLAS RECOGIDAS EN PIURA, JULIO QUISPE', 'Aceptado'),
(43, '2020-08-20 17:49:13', 'SALIDA DEVOLUCION A PROVEEDOR', 3, 'GUIA SEAFROS', 'GR.010-3656', 'SE DEVOLVIERON AL PROVEEDOR BOTELLA # 241057-  294331 PUEDEN SER DE LA PARTE BAJA', 'Aceptado'),
(44, '2020-06-20 18:03:49', 'SALIDA TRANSFERENCIA', 2, '', 'GR.010-3476', 'PRESTAMO PARTE BAJA', 'Aceptado'),
(45, '2020-05-29 18:06:40', 'SALIDA TRANSFERENCIA', 2, 'GUIA SEAFROS', 'GR.010-3220', 'PRESTAMO A PARTE BAJA', 'Aceptado'),
(46, '2020-09-04 13:27:00', 'INGRESO COMPRA', 9, '008-13996', '', 'COMPRA DE NITROGENO', 'Aceptado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mov_detalle`
--

CREATE TABLE `mov_detalle` (
  `idmov_detalle` int(11) NOT NULL,
  `idmovimiento` int(11) NOT NULL,
  `idbotella` int(11) NOT NULL,
  `fecha_detalle` datetime DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mov_detalle`
--

INSERT INTO `mov_detalle` (`idmov_detalle`, `idmovimiento`, `idbotella`, `fecha_detalle`, `estado`) VALUES
(38, 36, 7, '2020-07-10 16:28:56', 'Aceptado'),
(39, 37, 27, '2020-08-26 16:44:19', 'Aceptado'),
(40, 37, 28, '2020-08-26 16:44:19', 'Aceptado'),
(41, 37, 29, '2020-08-26 16:44:19', 'Aceptado'),
(42, 37, 30, '2020-08-26 16:44:19', 'Aceptado'),
(43, 37, 31, '2020-08-26 16:44:19', 'Aceptado'),
(44, 38, 8, '2020-07-01 17:02:26', 'Aceptado'),
(45, 39, 33, '2020-06-25 17:25:25', 'Aceptado'),
(46, 40, 34, '2020-08-14 17:37:38', 'Aceptado'),
(47, 41, 41, '2020-05-26 17:38:42', 'Aceptado'),
(48, 41, 42, '2020-05-26 17:38:42', 'Aceptado'),
(49, 41, 43, '2020-05-26 17:38:42', 'Aceptado'),
(50, 41, 44, '2020-05-26 17:38:42', 'Aceptado'),
(51, 41, 45, '2020-05-26 17:38:42', 'Aceptado'),
(52, 41, 46, '2020-05-26 17:38:42', 'Aceptado'),
(54, 43, 44, '2020-08-20 17:49:13', 'Aceptado'),
(55, 43, 43, '2020-08-20 17:49:13', 'Aceptado'),
(56, 43, 47, '2020-08-20 17:49:13', 'Aceptado'),
(57, 43, 48, '2020-08-20 17:49:13', 'Aceptado'),
(58, 43, 41, '2020-08-20 17:49:13', 'Aceptado'),
(59, 44, 46, '2020-06-20 18:03:49', 'Aceptado'),
(60, 45, 42, '2020-05-29 18:06:40', 'Aceptado'),
(61, 46, 49, '2020-09-04 13:27:00', 'Aceptado'),
(62, 46, 50, '2020-09-04 13:27:00', 'Aceptado'),
(63, 46, 51, '2020-09-04 13:27:00', 'Aceptado'),
(64, 46, 52, '2020-09-04 13:27:00', 'Aceptado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`) VALUES
(1, 'Escritorio'),
(2, 'Almacen'),
(3, 'Compras'),
(4, 'Ventas'),
(5, 'Acceso'),
(6, 'Consulta Compras'),
(7, 'Consulta Ventas'),
(8, 'Configuracion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idproveedor` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `ruc` varchar(12) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idproveedor`, `nombre`, `ruc`, `direccion`, `estado`) VALUES
(1, 'General Service Piura', '20601380669', ' piura piura peru', NULL),
(2, 'Seafrost SAC', '20356922311', 'Mza D Lt 01 Zona IND  Paita, Paita, Peru', '1'),
(3, 'Linde Gas Peru SA', '20100128994', 'peru', '1'),
(4, 'OXIDOS Y QUIMICOS DEL PERU S.A.C.- OXPERSAC', '20512738185', 'LIMA CAÑETE', '1'),
(5, 'PRAXAIR PERU SRL', '20338570041', 'JR. 2 N° 225 LOTE 23 ZONA IND. PIURA - PIURA', '1'),
(6, 'VICTOR YAMUNAQUE NIMA', '1', 'FLOTA', '1'),
(7, 'VICTORINO PERICHE PINGO', '1', 'PAITA', '1'),
(8, 'MARIO NARDUCHE', '1', 'PAITA', '1'),
(9, 'OXIGAS DEL PERU SRL', '20484290173', 'AAHH. 8 JULIO MZ B LT 22 PAITA', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cargo` varchar(20) DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `cargo`, `login`, `clave`, `imagen`, `condicion`) VALUES
(1, 'Brayan Carreño Tineo', 'DNI', '71733547', 'markojara', '123457', 'brayan@hotmail.com', '', 'admin', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '1593413859.jpeg', 1),
(3, 'JHENEL FRANK GARCIA GARCIA', 'DNI', '1', 'PAITA', '1', '', 'JEFE ALMACEN', 'jhefra', 'c66058ed03b4e5b8e4a376c2e6c047a64d604bb1b86d53f1aeade7f1b73427bc', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario_permiso`, `idusuario`, `idpermiso`) VALUES
(158, 3, 1),
(159, 3, 2),
(160, 3, 3),
(161, 3, 4),
(162, 3, 5),
(163, 3, 6),
(164, 3, 7),
(165, 3, 8),
(166, 1, 1),
(167, 1, 2),
(168, 1, 3),
(169, 1, 4),
(170, 1, 5),
(171, 1, 6),
(172, 1, 7),
(173, 1, 8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `botella`
--
ALTER TABLE `botella`
  ADD PRIMARY KEY (`idbotella`),
  ADD UNIQUE KEY `cod_botella` (`cod_botella`),
  ADD KEY `fk_botella_proveedor` (`idproveedor`);

--
-- Indices de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD PRIMARY KEY (`idmovimiento`),
  ADD KEY `fk_movimiento_proveedor1` (`idproveedor`);

--
-- Indices de la tabla `mov_detalle`
--
ALTER TABLE `mov_detalle`
  ADD PRIMARY KEY (`idmov_detalle`),
  ADD KEY `fk_mov_detalle_botella1` (`idbotella`),
  ADD KEY `fk_mov_detalle_movimiento1` (`idmovimiento`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario_permiso`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idpermiso` (`idpermiso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `botella`
--
ALTER TABLE `botella`
  MODIFY `idbotella` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  MODIFY `idmovimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `mov_detalle`
--
ALTER TABLE `mov_detalle`
  MODIFY `idmov_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `botella`
--
ALTER TABLE `botella`
  ADD CONSTRAINT `fk_botella_proveedor` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD CONSTRAINT `fk_movimiento_proveedor1` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mov_detalle`
--
ALTER TABLE `mov_detalle`
  ADD CONSTRAINT `fk_mov_detalle_botella1` FOREIGN KEY (`idbotella`) REFERENCES `botella` (`idBotella`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mov_detalle_movimiento1` FOREIGN KEY (`idmovimiento`) REFERENCES `movimiento` (`idmovimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `usuario_permiso_ibfk_1` FOREIGN KEY (`idpermiso`) REFERENCES `permiso` (`idpermiso`),
  ADD CONSTRAINT `usuario_permiso_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
