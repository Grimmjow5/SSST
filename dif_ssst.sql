-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2024 a las 18:43:38
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dif_ssst`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CheckUsuarioExists` (IN `p_user` VARCHAR(50))   BEGIN
SELECT COUNT(*) as user_count
FROM cat_usuarios
WHERE USER=p_user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertCatExtintor` (IN `p_num_inventario` VARCHAR(50), IN `p_fecha_registro` DATETIME, IN `p_num_extintor` VARCHAR(50), IN `p_estatus` BIT)   BEGIN
    INSERT INTO cat_extintores (num_inventario, fecha_registro, num_extintor, estatus)
    VALUES (p_num_inventario, p_fecha_registro, p_num_extintor, p_estatus);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertRol` (IN `p_id_userReg` INT, IN `p_fech_reg` DATETIME, IN `p_text_Rol` VARCHAR(255), IN `p_estatus` BIT)   BEGIN
    INSERT INTO roles (id_userReg, fech_reg, text_Rol, estatus)
    VALUES (p_id_userReg, p_fech_reg, p_text_Rol, p_estatus);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertUsuario` (IN `p_user` VARCHAR(50), IN `p_user_name` VARCHAR(50), IN `p_last_name` VARCHAR(50), IN `p_fecha_reg` DATETIME, IN `p_pass` VARCHAR(255), IN `p_reg_user` INT, IN `p_id_rol` INT, IN `p_status` BIT, IN `p_correo` VARCHAR(100))   BEGIN
    INSERT INTO cat_usuarios (
        user, user_name, last_name, fecha_reg, pass, reg_user, id_rol, status, correo
    ) VALUES (
        p_user, p_user_name, p_last_name, p_fecha_reg, p_pass, p_reg_user, p_id_rol, p_status, p_correo
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateCatExtintor` (IN `p_id_extintor` INT, IN `p_num_inventario` VARCHAR(50), IN `p_num_extintor` VARCHAR(50), IN `p_estatus` BIT)   BEGIN
    UPDATE cat_extintores
    SET num_inventario = p_num_inventario, num_extintor = p_num_extintor, estatus = p_estatus
    WHERE id_extintor = p_id_extintor;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateRol` (IN `p_id_rol` INT, IN `p_text_Rol` VARCHAR(255), IN `p_estatus` BIT)   BEGIN
    UPDATE roles
    SET text_Rol = p_text_Rol, estatus = p_estatus
    WHERE id_rol = p_id_rol;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_areas`
--

CREATE TABLE `cat_areas` (
  `id_area` int(11) NOT NULL,
  `id_direccion` int(11) DEFAULT NULL,
  `id_resp` int(11) DEFAULT NULL,
  `textArea` varchar(100) NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `estatus` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cat_areas`
--

INSERT INTO `cat_areas` (`id_area`, `id_direccion`, `id_resp`, `textArea`, `fecha_reg`, `estatus`) VALUES
(1, NULL, 1, 'Coordinación del Voluntariado', '2024-03-26 20:21:43', b'1'),
(2, NULL, 1, 'Titularidad del Sistema DIF', '2024-03-26 20:23:29', b'1'),
(3, NULL, 1, 'Hospital del Niño DIF', '2024-03-26 20:23:29', b'1'),
(4, NULL, 1, 'CRIH', '2024-03-26 20:25:04', b'1'),
(5, NULL, 1, 'CRIR Huehuetla', '2024-03-26 20:25:04', b'1'),
(6, NULL, 1, 'CRIR Huejutla', '2024-03-26 20:25:04', b'1'),
(7, NULL, 1, 'CRIR Ixmiquilpan', '2024-03-26 20:25:04', b'1'),
(8, NULL, 1, 'CRIR Santiago Tulantepec', '2024-03-26 20:25:04', b'1'),
(9, NULL, 1, 'CRIR Tula de Allende', '2024-03-26 20:25:04', b'1'),
(10, NULL, 1, 'CRIR Zacualtipan', '2024-03-26 20:25:04', b'1'),
(11, NULL, 1, 'Dirección de Administración', '2024-03-26 20:29:32', b'1'),
(12, NULL, 1, 'Infraestructura y Mantenimiento', '2024-03-26 20:29:32', b'1'),
(13, NULL, 1, 'Recursos Humanos', '2024-03-26 20:29:32', b'1'),
(14, NULL, 1, 'Subdirección de Adquisiciones', '2024-03-26 20:29:32', b'1'),
(15, NULL, 1, 'Seguimiento a las Auditorías', '2024-03-26 20:32:40', b'1'),
(16, NULL, 1, 'Dirección de Asuntos Jurídicos', '2024-03-26 20:33:51', b'1'),
(17, NULL, 1, 'Dirección de Informática', '2024-03-26 20:35:58', b'1'),
(18, NULL, 1, 'Dirección de Finanzas y Presupuesto', '2024-03-26 20:36:47', b'1'),
(19, NULL, 1, 'Dirección de Alimentación y Desarrollo Comunitario', '2024-03-26 20:39:23', b'1'),
(20, NULL, 1, 'Órgano Interno de Control', '2024-03-26 20:40:04', b'1'),
(21, NULL, 1, 'Dirección General de Asistencia Social', '2024-03-26 20:41:28', b'1'),
(22, NULL, 1, 'Casa de Día Centro de Expresión para el Adulto Mayor', '2024-03-26 20:41:28', b'1'),
(23, NULL, 1, 'Casa de Día María Elena Ramírez de Lozano', '2024-03-26 20:41:28', b'1'),
(24, NULL, 1, 'Casa de la Mujer Hidalguense', '2024-03-26 20:41:28', b'1'),
(25, NULL, 1, 'Atención Psicológica', '2024-03-26 20:41:28', b'1'),
(26, NULL, 1, 'Subdirección de Vinculación a la Salud y Envejecimiento Saludable', '2024-03-26 20:41:28', b'1'),
(27, NULL, 1, 'Casa Cuna', '2024-03-26 20:48:25', b'1'),
(28, NULL, 1, 'Casa Niña', '2024-03-26 20:48:25', b'1'),
(29, NULL, 1, 'Casa Niño', '2024-03-26 20:48:25', b'1'),
(30, NULL, 1, 'La Casita', '2024-03-26 20:48:25', b'1'),
(31, NULL, 1, 'Despacho de la Dirección de Protección a la Niñez y Adolescencia', '2024-03-26 20:48:25', b'1'),
(32, NULL, 1, 'Casa Adolescentes', '2024-03-26 20:48:25', b'1'),
(33, NULL, 1, 'Coordinación CAI', '2024-03-26 20:48:25', b'1'),
(34, NULL, 1, 'CAI Atorón', '2024-03-26 20:48:25', b'1'),
(35, NULL, 1, 'CAI Bomberos', '2024-03-26 20:48:25', b'1'),
(36, NULL, 1, 'CAI  Matilde', '2024-03-26 20:48:25', b'1'),
(37, NULL, 1, 'CAI Parque Hidalgo', '2024-03-26 20:48:25', b'1'),
(38, NULL, 1, 'CAI San Bartolo', '2024-03-26 20:48:25', b'1'),
(39, NULL, 1, 'CAI Venta Prieta', '2024-03-26 20:48:25', b'1'),
(40, NULL, 1, 'Desarrollo de Habilidades en NNyA', '2024-03-26 20:48:25', b'1'),
(41, NULL, 1, 'PAMAR Felipe Ángeles', '2024-03-26 20:48:25', b'1'),
(42, NULL, 1, 'PAMAR Matilde', '2024-03-26 20:48:25', b'1'),
(43, NULL, 1, 'PAMAR Abasolo', '2024-03-26 20:48:25', b'1'),
(44, NULL, 1, 'PAMAR La Palma', '2024-03-26 20:48:25', b'1'),
(45, NULL, 1, 'PAMAR Gómez Farías', '2024-03-26 20:48:25', b'1'),
(46, NULL, 1, 'Dirección de Planeación, Prospectiva y Normatividad', '2024-03-26 21:00:09', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_direccion`
--

CREATE TABLE `cat_direccion` (
  `id_direccion` int(11) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `resp_reg` varchar(100) NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `activo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_extintores`
--

CREATE TABLE `cat_extintores` (
  `id_extintor` int(11) NOT NULL,
  `num_inventario` int(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `num_extintor` int(11) NOT NULL,
  `estatus` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cat_extintores`
--

INSERT INTO `cat_extintores` (`id_extintor`, `num_inventario`, `fecha_registro`, `num_extintor`, `estatus`) VALUES
(1, 36602, '2024-05-21 23:45:00', 300, b'0'),
(2, 36603, '2024-05-28 17:35:00', 100, b'0'),
(3, 36603, '2024-05-28 18:02:00', 1000, b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_usuarios`
--

CREATE TABLE `cat_usuarios` (
  `id_user` int(11) NOT NULL,
  `user` varchar(40) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `pass` varchar(300) NOT NULL,
  `reg_user` int(11) DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  `status` bit(1) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cat_usuarios`
--

INSERT INTO `cat_usuarios` (`id_user`, `user`, `user_name`, `last_name`, `fecha_reg`, `pass`, `reg_user`, `id_rol`, `status`, `correo`) VALUES
(1, 'Master', 'sevas', 'cordero', '2024-04-16 11:34:00', '123456', 1, 1, b'1', NULL),
(6, 'Hector Tilino', 'Hector', 'De La Rosa', '2024-05-22 19:08:00', '$2y$10$HxcH8qxpUm4VdIORwx712eFiwVDkm2249KlkYZ6Z6al52lCUmLokC', 1, 2, NULL, ''),
(28, 'Axelj', 'Axel', 'Leyva', '2024-05-23 22:50:00', '$2y$10$8JCgy1mAtwp5iEFGeIDg/eh4aBBh4qESuKqPF5U5SBfI.jAOQxhK2', 1, 1, b'1', ''),
(29, 'Hector', 'Hector', 'De La Rosa', '2024-05-23 23:27:00', '$2y$10$HFy2Q1EJfrf3tRtVTsrMJ.TABIDGzYUImOIdp5L.lkZ8zU/1oyRMK', 28, 2, b'1', ''),
(31, 'Reportes', 'Hector', 'De La Rosa', '2024-05-24 18:32:00', '$2y$10$qHbhKqcAzCj6ZU58zf1tiuizObzgsK0LDgtkEFQ9B3CmA0BekmyK6', 28, 3, b'1', ''),
(35, 'Hola', 'joshua', 'leyva', '2024-05-28 18:24:00', '$2y$10$tmzBplarHk1Hcj8UrUoJTOzOxyvbOyyQBCLbT5l6bfw1wN2.tOC06', 28, 3, b'1', 'hdelarosasanchez@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico`
--

CREATE TABLE `historico` (
  `id_historico` int(11) NOT NULL,
  `id_user_history` int(11) NOT NULL,
  `text_table` varchar(40) NOT NULL,
  `id_of_table` int(11) NOT NULL,
  `val_before` varchar(400) DEFAULT NULL,
  `val_after` varchar(400) DEFAULT NULL,
  `fech_modificacion` datetime DEFAULT NULL,
  `comment` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mv_riesgos`
--

CREATE TABLE `mv_riesgos` (
  `id` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_mes` int(11) NOT NULL,
  `text_Riesgo` varchar(500) NOT NULL,
  `id_userReg` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `id_userModificacion` int(11) DEFAULT NULL,
  `prioridad` varchar(20) DEFAULT NULL,
  `estatus` bit(1) DEFAULT NULL,
  `fecha_solucion` datetime DEFAULT NULL,
  `solucion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mv_riesgos`
--

INSERT INTO `mv_riesgos` (`id`, `id_area`, `id_mes`, `text_Riesgo`, `id_userReg`, `fechaRegistro`, `fechaModificacion`, `id_userModificacion`, `prioridad`, `estatus`, `fecha_solucion`, `solucion`) VALUES
(12, 2, 5, '288jnjn', 1, '2024-05-16 23:28:00', '2024-05-27 03:30:00', 1, 'Alta', b'0', NULL, NULL),
(13, 1, 5, 'eee', 1, '2024-05-17 17:29:00', '2024-05-21 17:52:00', 1, 'Media', b'1', '2024-05-21 17:52:00', 'qqqq'),
(14, 9, 5, 'hola', 1, '2024-05-20 21:14:00', '2024-05-20 22:32:00', 1, 'Media', b'1', '2024-05-20 22:32:00', 'mlk');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_extintores`
--

CREATE TABLE `reg_extintores` (
  `id` int(11) NOT NULL,
  `id_extintor` int(11) DEFAULT NULL,
  `id_area` int(11) NOT NULL,
  `id_direccion` int(11) DEFAULT NULL,
  `id_mes_captura` int(11) NOT NULL,
  `lugar_designado` bit(1) DEFAULT NULL,
  `acceso` bit(1) DEFAULT NULL,
  `senial` bit(1) DEFAULT NULL,
  `instrucciones` bit(1) DEFAULT NULL,
  `sellos` bit(1) DEFAULT NULL,
  `lecturas` bit(1) DEFAULT NULL,
  `danio` bit(1) DEFAULT NULL,
  `altura` double NOT NULL,
  `manijas` bit(1) DEFAULT NULL,
  `peso` double NOT NULL,
  `fecha_recarga` datetime NOT NULL,
  `fecha_prox_recarga` datetime NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `resp_reg` int(11) NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `resp_modificacion` int(11) DEFAULT NULL,
  `estatus` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reg_extintores`
--

INSERT INTO `reg_extintores` (`id`, `id_extintor`, `id_area`, `id_direccion`, `id_mes_captura`, `lugar_designado`, `acceso`, `senial`, `instrucciones`, `sellos`, `lecturas`, `danio`, `altura`, `manijas`, `peso`, `fecha_recarga`, `fecha_prox_recarga`, `fecha_reg`, `resp_reg`, `fecha_modificacion`, `resp_modificacion`, `estatus`) VALUES
(1, NULL, 1, NULL, 5, b'1', b'1', b'0', b'0', b'1', b'0', b'0', 1.5, b'1', 4.5, '2024-05-08 00:00:00', '2025-05-08 00:00:00', '2024-05-21 23:47:00', 1, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `id_userReg` int(11) NOT NULL,
  `fech_reg` datetime NOT NULL,
  `text_Rol` varchar(30) NOT NULL,
  `estatus` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `id_userReg`, `fech_reg`, `text_Rol`, `estatus`) VALUES
(1, 0, '0000-00-00 00:00:00', 'Admin', b'1'),
(2, 1, '2024-05-27 07:02:55', 'Extintores', b'1'),
(3, 1, '2024-05-27 07:03:00', 'Reportes', b'1');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_usuario`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_usuario` (
`id_user` int(11)
,`user_name` varchar(60)
,`last_name` varchar(40)
,`user` varchar(40)
,`fecha_reg` datetime
,`rol` varchar(30)
,`status` bit(1)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_usuario`
--
DROP TABLE IF EXISTS `vista_usuario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_usuario`  AS SELECT `cat_usuarios`.`id_user` AS `id_user`, `cat_usuarios`.`user_name` AS `user_name`, `cat_usuarios`.`last_name` AS `last_name`, `cat_usuarios`.`user` AS `user`, `cat_usuarios`.`fecha_reg` AS `fecha_reg`, `roles`.`text_Rol` AS `rol`, `cat_usuarios`.`status` AS `status` FROM (`cat_usuarios` join `roles` on(`cat_usuarios`.`id_rol` = `roles`.`id_rol`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cat_areas`
--
ALTER TABLE `cat_areas`
  ADD PRIMARY KEY (`id_area`),
  ADD KEY `id_resp` (`id_resp`),
  ADD KEY `id_direccion` (`id_direccion`);

--
-- Indices de la tabla `cat_direccion`
--
ALTER TABLE `cat_direccion`
  ADD PRIMARY KEY (`id_direccion`);

--
-- Indices de la tabla `cat_extintores`
--
ALTER TABLE `cat_extintores`
  ADD PRIMARY KEY (`id_extintor`),
  ADD KEY `cat_Extintores_index_0` (`id_extintor`);

--
-- Indices de la tabla `cat_usuarios`
--
ALTER TABLE `cat_usuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `reg_user` (`reg_user`);

--
-- Indices de la tabla `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id_historico`),
  ADD KEY `id_user_history` (`id_user_history`);

--
-- Indices de la tabla `mv_riesgos`
--
ALTER TABLE `mv_riesgos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_area` (`id_area`),
  ADD KEY `id_userModificacion` (`id_userModificacion`),
  ADD KEY `id_userReg` (`id_userReg`);

--
-- Indices de la tabla `reg_extintores`
--
ALTER TABLE `reg_extintores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resp_reg` (`resp_reg`),
  ADD KEY `resp_modificacion` (`resp_modificacion`),
  ADD KEY `id_extintor` (`id_extintor`),
  ADD KEY `id_direccion` (`id_direccion`),
  ADD KEY `id_area` (`id_area`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cat_areas`
--
ALTER TABLE `cat_areas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `cat_direccion`
--
ALTER TABLE `cat_direccion`
  MODIFY `id_direccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cat_extintores`
--
ALTER TABLE `cat_extintores`
  MODIFY `id_extintor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cat_usuarios`
--
ALTER TABLE `cat_usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `historico`
--
ALTER TABLE `historico`
  MODIFY `id_historico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mv_riesgos`
--
ALTER TABLE `mv_riesgos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `reg_extintores`
--
ALTER TABLE `reg_extintores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cat_areas`
--
ALTER TABLE `cat_areas`
  ADD CONSTRAINT `cat_areas_ibfk_1` FOREIGN KEY (`id_resp`) REFERENCES `cat_usuarios` (`id_user`),
  ADD CONSTRAINT `cat_areas_ibfk_2` FOREIGN KEY (`id_direccion`) REFERENCES `cat_direccion` (`id_direccion`);

--
-- Filtros para la tabla `cat_usuarios`
--
ALTER TABLE `cat_usuarios`
  ADD CONSTRAINT `cat_usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
  ADD CONSTRAINT `cat_usuarios_ibfk_2` FOREIGN KEY (`reg_user`) REFERENCES `cat_usuarios` (`id_user`);

--
-- Filtros para la tabla `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `historico_ibfk_1` FOREIGN KEY (`id_user_history`) REFERENCES `cat_usuarios` (`id_user`);

--
-- Filtros para la tabla `mv_riesgos`
--
ALTER TABLE `mv_riesgos`
  ADD CONSTRAINT `mv_riesgos_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `cat_areas` (`id_area`),
  ADD CONSTRAINT `mv_riesgos_ibfk_2` FOREIGN KEY (`id_userModificacion`) REFERENCES `cat_usuarios` (`id_user`),
  ADD CONSTRAINT `mv_riesgos_ibfk_3` FOREIGN KEY (`id_userReg`) REFERENCES `cat_usuarios` (`id_user`);

--
-- Filtros para la tabla `reg_extintores`
--
ALTER TABLE `reg_extintores`
  ADD CONSTRAINT `reg_extintores_ibfk_1` FOREIGN KEY (`resp_reg`) REFERENCES `cat_usuarios` (`id_user`),
  ADD CONSTRAINT `reg_extintores_ibfk_2` FOREIGN KEY (`resp_modificacion`) REFERENCES `cat_usuarios` (`id_user`),
  ADD CONSTRAINT `reg_extintores_ibfk_3` FOREIGN KEY (`id_extintor`) REFERENCES `cat_extintores` (`id_extintor`),
  ADD CONSTRAINT `reg_extintores_ibfk_4` FOREIGN KEY (`id_direccion`) REFERENCES `cat_direccion` (`id_direccion`),
  ADD CONSTRAINT `reg_extintores_ibfk_5` FOREIGN KEY (`id_area`) REFERENCES `cat_areas` (`id_area`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
