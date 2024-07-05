-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-07-2024 a las 06:01:21
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
-- Base de datos: `_ssst`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `CheckNumExtintorExists`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CheckNumExtintorExists` (IN `p_num_extintor` INT)   BEGIN
    SELECT COUNT(*) AS extintor_count
    FROM cat_extintores
    WHERE num_extintor = p_num_extintor;
END$$

DROP PROCEDURE IF EXISTS `CheckUsuarioExists`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CheckUsuarioExists` (IN `p_user` VARCHAR(50))   BEGIN
SELECT COUNT(*) as user_count
FROM cat_usuarios
WHERE USER=p_user;
END$$

DROP PROCEDURE IF EXISTS `InsertarRegExtintor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarRegExtintor` (IN `p_id_extintor` INT, IN `p_id_direccion` INT, IN `p_id_mes_captura` INT, IN `p_lugar_designado` BIT, IN `p_acceso` BIT, IN `p_senial` BIT, IN `p_instrucciones` BIT, IN `p_sellos` BIT, IN `p_lecturas` BIT, IN `p_danio` BIT, IN `p_altura` FLOAT, IN `p_manijas` BIT, IN `p_peso` FLOAT, IN `p_fecha_recarga` DATETIME, IN `p_fecha_prox_recarga` DATETIME, IN `p_fecha_reg` DATETIME, IN `p_resp_reg` INT, IN `p_fecha_modificacion` DATETIME, IN `p_resp_modificacion` INT, IN `p_id_sub` INT)   BEGIN
    INSERT INTO reg_extintores (
        id_extintor,
        id_direccion,
        id_mes_captura,
        lugar_designado,
        acceso,
        senial,
        instrucciones,
        sellos,
        lecturas,
        danio,
        altura,
        manijas,
        peso,
        fecha_recarga,
        fecha_prox_recarga,
        fecha_reg,
        resp_reg,
        fecha_modificacion,
        resp_modificacion,
        id_sub
    ) VALUES (
        p_id_extintor,
        p_id_direccion,
        p_id_mes_captura,
        p_lugar_designado,
        p_acceso,
        p_senial,
        p_instrucciones,
        p_sellos,
        p_lecturas,
        p_danio,
        p_altura,
        p_manijas,
        p_peso,
        p_fecha_recarga,
        p_fecha_prox_recarga,
        p_fecha_reg,
        p_resp_reg,
        p_fecha_modificacion,
        p_resp_modificacion,
        p_id_sub
    );
END$$

DROP PROCEDURE IF EXISTS `InsertCatExtintor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertCatExtintor` (IN `p_num_inventario` VARCHAR(50), IN `p_fecha_registro` DATETIME, IN `p_num_extintor` VARCHAR(50), IN `p_estatus` BIT, IN `p_resp_reg` INT, IN `p_idsub` INT)   BEGIN
    INSERT INTO cat_extintores (num_inventario, fecha_registro, num_extintor, estatus,resp_reg,id_sub)
    VALUES (p_num_inventario, p_fecha_registro, p_num_extintor, p_estatus,p_resp_reg,p_idsub);
END$$

DROP PROCEDURE IF EXISTS `InsertRol`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertRol` (IN `p_id_userReg` INT, IN `p_fech_reg` DATETIME, IN `p_text_Rol` VARCHAR(255), IN `p_estatus` BIT)   BEGIN
    INSERT INTO roles (id_userReg, fech_reg, text_Rol, estatus)
    VALUES (p_id_userReg, p_fech_reg, p_text_Rol, p_estatus);
END$$

DROP PROCEDURE IF EXISTS `InsertSubUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertSubUser` (IN `p_id_user` INT, IN `p_id_subarea` INT)   BEGIN
    INSERT INTO user_subarea (
        id_user, id_subarea
    ) VALUES (
        p_id_user, p_id_subarea
    );
END$$

DROP PROCEDURE IF EXISTS `InsertUsuario`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertUsuario` (IN `p_user` VARCHAR(50), IN `p_user_name` VARCHAR(50), IN `p_last_name` VARCHAR(50), IN `p_fecha_reg` DATETIME, IN `p_pass` VARCHAR(255), IN `p_reg_user` INT, IN `p_id_rol` INT, IN `p_status` BIT, IN `p_correo` VARCHAR(100))   BEGIN
    INSERT INTO cat_usuarios (
        user, user_name, last_name, fecha_reg, pass, reg_user, id_rol, status, correo
    ) VALUES (
        p_user, p_user_name, p_last_name, p_fecha_reg, p_pass, p_reg_user, p_id_rol, p_status, p_correo
    );
    
    SELECT LAST_INSERT_ID() AS user_id;
END$$

DROP PROCEDURE IF EXISTS `UpdateCatExtintor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateCatExtintor` (IN `p_id_extintor` INT, IN `p_num_inventario` VARCHAR(50), IN `p_num_extintor` VARCHAR(50), IN `p_estatus` BIT, IN `p_idsub` INT)   BEGIN
    UPDATE cat_extintores
    SET num_inventario = p_num_inventario, num_extintor = p_num_extintor, estatus = p_estatus , id_sub = p_idsub
    WHERE id_extintor = p_id_extintor;
END$$

DROP PROCEDURE IF EXISTS `UpdateReExtintor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateReExtintor` (IN `p_id` INT, IN `p_id_extintor` INT, IN `p_id_area` INT, IN `p_id_direccion` INT, IN `p_id_mes_captura` INT, IN `p_lugar_designado` BIT, IN `p_acceso` BIT, IN `p_senial` BIT, IN `p_instrucciones` BIT, IN `p_sellos` BIT, IN `p_lecturas` BIT, IN `p_danio` BIT, IN `p_altura` FLOAT, IN `p_manijas` BIT, IN `p_peso` FLOAT, IN `p_fecha_recarga` DATETIME, IN `p_fecha_prox_recarga` DATETIME, IN `p_fecha_modificacion` DATETIME, IN `p_resp_modificacion` INT)   BEGIN
    UPDATE reg_extintores
    SET
        id_extintor = p_id_extintor,
        id_area = p_id_area,
        id_direccion = p_id_direccion,
        id_mes_captura = p_id_mes_captura,
        lugar_designado = p_lugar_designado,
        acceso = p_acceso,
        senial = p_senial,
        instrucciones = p_instrucciones,
        sellos = p_sellos,
        lecturas = p_lecturas,
        danio = p_danio,
        altura = p_altura,
        manijas = p_manijas,
        peso = p_peso,
        fecha_recarga = p_fecha_recarga,
        fecha_prox_recarga = p_fecha_prox_recarga,
        fecha_modificacion = p_fecha_modificacion,
        resp_modificacion = p_resp_modificacion
    WHERE id = p_id;
END$$

DROP PROCEDURE IF EXISTS `UpdateRegExtintor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateRegExtintor` (IN `p_id` INT, IN `p_id_extintor` INT, IN `p_id_area` INT, IN `p_lugar_designado` VARCHAR(255), IN `p_acceso` VARCHAR(255), IN `p_senial` VARCHAR(255), IN `p_instrucciones` VARCHAR(255), IN `p_sellos` VARCHAR(255), IN `p_lecturas` VARCHAR(255), IN `p_danio` VARCHAR(255), IN `p_altura` VARCHAR(255), IN `p_manijas` VARCHAR(255), IN `p_peso` VARCHAR(255), IN `p_fecha_modificacion` DATETIME, IN `p_resp_modificacion` INT)   BEGIN
    UPDATE reg_extintores
    SET 
        id_extintor = p_id_extintor,
        id_area = p_id_area,
        lugar_designado = p_lugar_designado,
        acceso = p_acceso,
        senial = p_senial,
        instrucciones = p_instrucciones,
        sellos = p_sellos,
        lecturas = p_lecturas,
        danio = p_danio,
        altura = p_altura,
        manijas = p_manijas,
        peso = p_peso,
        fecha_modificacion = p_fecha_modificacion,
        resp_modificacion = p_resp_modificacion
    WHERE id = p_id;
END$$

DROP PROCEDURE IF EXISTS `UpdateRol`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateRol` (IN `p_id_rol` INT, IN `p_text_Rol` VARCHAR(255), IN `p_estatus` BIT)   BEGIN
    UPDATE roles
    SET text_Rol = p_text_Rol, estatus = p_estatus
    WHERE id_rol = p_id_rol;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `asignar_view`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `asignar_view`;
CREATE TABLE `asignar_view` (
`id_user` int(11)
,`id_area` int(11)
,`textArea` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_areas`
--

DROP TABLE IF EXISTS `cat_areas`;
CREATE TABLE `cat_areas` (
  `id_area` int(11) NOT NULL,
  `id_direccion` int(11) DEFAULT NULL,
  `id_resp` int(11) DEFAULT NULL,
  `textArea` varchar(100) NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `estatus` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `cat_areas`:
--   `id_resp`
--       `cat_usuarios` -> `id_user`
--   `id_direccion`
--       `cat_direccion` -> `id_direccion`
--

--
-- Volcado de datos para la tabla `cat_areas`
--

INSERT INTO `cat_areas` (`id_area`, `id_direccion`, `id_resp`, `textArea`, `fecha_reg`, `estatus`) VALUES
(1, NULL, 1, 'Órgano Interno de Control', '2024-03-26 20:21:43', b'1'),
(2, NULL, 1, 'Dirección de Informática', '2024-03-26 20:23:29', b'1'),
(3, NULL, 1, 'CRIH', '2024-03-26 20:23:29', b'1'),
(4, NULL, 1, 'Coordinación de la Junta General de Asistencia', '2024-03-26 20:25:04', b'1'),
(5, NULL, 1, 'Dirección de Asuntos Jurídicos', '2024-03-26 20:25:04', b'1'),
(6, NULL, 1, 'Dirección de Administración', '2024-03-26 20:25:04', b'1'),
(7, NULL, 1, 'Dirección de Alimentación y Desarrollo Comunitario', '2024-03-26 20:25:04', b'1'),
(8, NULL, 1, 'Dirección de Ingresos', '2024-03-26 20:25:04', b'1'),
(9, NULL, 1, 'Coordinación del Despacho de la Presidencia del patronato del Sistema DIF Hidalgo', '2024-03-26 20:25:04', b'1'),
(10, NULL, 1, 'Titularidad del SEDIFH', '2024-03-26 20:25:04', b'1'),
(11, NULL, 1, 'Dirección de Protección a la Niñez y Adolescencia', '2024-03-26 20:29:32', b'1'),
(12, NULL, 1, 'Hospital del Niño DIF', '2024-03-26 20:29:32', b'1'),
(13, NULL, 1, 'Dirección General de Administración y Finanzas', '2024-03-26 20:29:32', b'1'),
(14, NULL, 1, 'Dirección General de Asistencia Social', '2024-03-26 20:29:32', b'1'),
(15, NULL, 1, 'Procuraduría de Protección de Niñas, Niños, Adolescencia y la Familia', '2024-03-26 20:32:40', b'1'),
(16, NULL, 1, 'Dirección de Planeación, Prospectiva y Normatividad', '2024-03-26 20:33:51', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_direccion`
--

DROP TABLE IF EXISTS `cat_direccion`;
CREATE TABLE `cat_direccion` (
  `id_direccion` int(11) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `resp_reg` varchar(100) NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `activo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `cat_direccion`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_extintores`
--

DROP TABLE IF EXISTS `cat_extintores`;
CREATE TABLE `cat_extintores` (
  `id_extintor` int(11) NOT NULL,
  `num_inventario` int(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `num_extintor` int(11) NOT NULL,
  `estatus` bit(1) DEFAULT NULL,
  `resp_reg` int(11) DEFAULT NULL,
  `id_sub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `cat_extintores`:
--   `id_sub`
--       `cat_sub_areas` -> `id_subarea`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_sub_areas`
--

DROP TABLE IF EXISTS `cat_sub_areas`;
CREATE TABLE `cat_sub_areas` (
  `id_subarea` int(11) NOT NULL,
  `id_direccion` int(11) DEFAULT NULL,
  `id_resp` int(11) DEFAULT NULL,
  `textArea` varchar(100) NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `estatus` bit(1) NOT NULL,
  `id_area` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `cat_sub_areas`:
--   `id_area`
--       `cat_areas` -> `id_area`
--

--
-- Volcado de datos para la tabla `cat_sub_areas`
--

INSERT INTO `cat_sub_areas` (`id_subarea`, `id_direccion`, `id_resp`, `textArea`, `fecha_reg`, `estatus`, `id_area`) VALUES
(1, NULL, 1, 'Órgano Interno de Control', '2024-06-24 18:59:16', b'1', 1),
(2, NULL, 1, 'Dirección de Informática', '2024-06-24 19:05:52', b'1', 2),
(3, NULL, 1, 'CRIH Pachuca', '2024-06-24 19:06:55', b'1', 3),
(4, NULL, 1, 'CRIR Huehuetla', '2024-06-24 19:06:55', b'1', 3),
(5, NULL, 1, 'CRIR Huejutla', '2024-06-24 19:06:55', b'1', 3),
(6, NULL, 1, 'CRIR Ixmiquilpan', '2024-06-24 19:06:55', b'1', 3),
(7, NULL, 1, 'CRIR Santiago Tulantepec', '2024-06-24 19:06:55', b'1', 3),
(8, NULL, 1, 'CRIR Tula de Allende', '2024-06-24 19:09:56', b'1', 3),
(9, NULL, 1, 'CRIR Zacualtipán', '2024-06-24 19:09:56', b'1', 3),
(10, NULL, 1, 'Dirección de Asuntos Jurídicos', '2024-06-24 19:11:33', b'1', 5),
(11, NULL, 1, 'Subdirección de Asuntos Jurídicos', '2024-06-24 19:11:33', b'1', 5),
(12, NULL, 1, 'Coordinación de la Junta General de Asistencia', '2024-06-24 19:14:41', b'1', 4),
(13, NULL, 1, 'Dirección de Administración', '2024-06-24 19:14:59', b'1', 6),
(14, NULL, 1, 'Dirección de Alimentación y Desarrollo Comunitario', '2024-06-24 19:15:26', b'1', 7),
(15, NULL, 1, 'Subdirección de Unidades Económicas', '2024-06-24 19:15:52', b'1', 8),
(16, NULL, 1, 'Estacionamiento \"El Reloj\"', '2024-06-24 19:16:19', b'1', 8),
(17, NULL, 1, 'Tizayuca', '2024-06-24 19:17:25', b'1', 8),
(18, NULL, 1, 'Actopan', '2024-06-24 19:17:25', b'1', 8),
(19, NULL, 1, 'Poniente', '2024-06-24 19:17:25', b'1', 8),
(20, NULL, 1, 'Tulancingo', '2024-06-24 19:17:25', b'1', 8),
(21, NULL, 1, 'Providencia', '2024-06-24 19:17:25', b'1', 8),
(22, NULL, 1, 'Despacho del Patronato', '2024-06-24 19:19:30', b'1', 9),
(23, NULL, 1, 'Coordinación de Giras, Eventos y Logístic', '2024-06-24 19:19:30', b'1', 9),
(24, NULL, 1, 'Comunicación Social', '2024-06-24 19:19:30', b'1', 9),
(25, NULL, 1, 'Voluntariado', '2024-06-24 19:19:30', b'1', 9),
(26, NULL, 1, 'Relaciones Públicas', '2024-06-24 19:19:30', b'1', 9),
(27, NULL, 1, '', '2024-06-24 19:19:30', b'1', 9),
(28, NULL, 1, 'Dirección de Gestión Institucional', '2024-06-24 19:21:45', b'1', 10),
(29, NULL, 1, 'Titularidad del Sitema DIF', '2024-06-24 19:21:45', b'1', 10),
(30, NULL, 1, 'Despacho de la Dirección', '2024-06-24 19:22:49', b'1', 11),
(31, NULL, 1, 'Subdirección CAI', '2024-06-24 19:22:49', b'1', 11),
(32, NULL, 1, 'Centro de Expresión Juvenil', '2024-06-24 19:22:49', b'1', 11),
(33, NULL, 1, 'Desarrollo de Habilidades para Niñas, Niños y Adolescentes', '2024-06-24 19:22:49', b'1', 11),
(34, NULL, 1, '7 CAI´s', '2024-06-24 19:22:49', b'1', 11),
(35, NULL, 1, 'Atorón', '2024-06-24 19:22:49', b'1', 11),
(36, NULL, 1, 'Bomberos', '2024-06-24 19:22:49', b'1', 11),
(37, NULL, 1, 'Parque Hidalgo', '2024-06-24 19:22:49', b'1', 11),
(38, NULL, 1, 'San Bartolo', '2024-06-24 19:22:49', b'1', 11),
(39, NULL, 1, 'Matilde', '2024-06-24 19:22:49', b'1', 11),
(40, NULL, 1, 'Venta Prieta', '2024-06-24 19:22:49', b'1', 11),
(41, NULL, 1, 'Burócratas', '2024-06-24 19:22:49', b'1', 11),
(42, NULL, 1, 'Casa Cuna', '2024-06-24 19:22:49', b'1', 11),
(43, NULL, 1, 'Casa de la Niña', '2024-06-24 19:22:49', b'1', 11),
(44, NULL, 1, 'Casa del Niño', '2024-06-24 19:22:49', b'1', 11),
(45, NULL, 1, 'La Casita', '2024-06-24 19:22:49', b'1', 11),
(46, NULL, 1, 'Casa de la Adolescente', '2024-06-24 19:22:49', b'1', 11),
(47, NULL, 1, 'PAMARES', '2024-06-24 19:22:49', b'1', 11),
(48, NULL, 1, 'Hospital del Niño DIF', '2024-06-24 19:28:03', b'1', 12),
(49, NULL, 1, 'Dirección General de Administración y Finanzas', '2024-06-24 19:28:03', b'1', 13),
(50, NULL, 1, 'Dirección General de Asistencia Social', '2024-06-24 19:28:03', b'1', 14),
(51, NULL, 1, 'Procuraduría de Protección de Niñas, Niños, Adolescencia y la Familia', '2024-06-24 19:28:03', b'1', 15),
(52, NULL, 1, 'Dirección de Planeación, Prospectiva y Normatividad', '2024-06-24 19:28:03', b'1', 16),
(53, NULL, 1, 'Casa Matriz', '2024-06-24 21:18:00', b'1', 8),
(54, NULL, 1, 'Sur', '2024-06-24 21:18:00', b'1', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_usuarios`
--

DROP TABLE IF EXISTS `cat_usuarios`;
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
-- RELACIONES PARA LA TABLA `cat_usuarios`:
--   `id_rol`
--       `roles` -> `id_rol`
--   `reg_user`
--       `cat_usuarios` -> `id_user`
--

--
-- Volcado de datos para la tabla `cat_usuarios`
--

INSERT INTO `cat_usuarios` (`id_user`, `user`, `user_name`, `last_name`, `fecha_reg`, `pass`, `reg_user`, `id_rol`, `status`, `correo`) VALUES
(1, 'Master', 'sevas', 'cordero', '2024-04-16 11:34:00', '$2y$10$8JCgy1mAtwp5iEFGeIDg/eh4aBBh4qESuKqPF5U5SBfI.jAOQxhK2', 1, 1, b'1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico`
--

DROP TABLE IF EXISTS `historico`;
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

--
-- RELACIONES PARA LA TABLA `historico`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mv_riesgos`
--

DROP TABLE IF EXISTS `mv_riesgos`;
CREATE TABLE `mv_riesgos` (
  `id` int(11) NOT NULL,
  `id_mes` int(11) NOT NULL,
  `text_Riesgo` varchar(500) NOT NULL,
  `id_userReg` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `id_userModificacion` int(11) DEFAULT NULL,
  `prioridad` varchar(20) DEFAULT NULL,
  `estatus` bit(1) DEFAULT NULL,
  `fecha_solucion` datetime DEFAULT NULL,
  `solucion` varchar(500) DEFAULT NULL,
  `id_sub` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `mv_riesgos`:
--   `id_sub`
--       `cat_sub_areas` -> `id_subarea`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_extintores`
--

DROP TABLE IF EXISTS `reg_extintores`;
CREATE TABLE `reg_extintores` (
  `id` int(11) NOT NULL,
  `id_extintor` int(11) NOT NULL,
  `id_direccion` int(11) DEFAULT NULL,
  `id_mes_captura` int(11) NOT NULL,
  `lugar_designado` bit(1) NOT NULL,
  `acceso` bit(1) NOT NULL,
  `senial` bit(1) NOT NULL,
  `instrucciones` bit(1) NOT NULL,
  `sellos` bit(1) NOT NULL,
  `lecturas` bit(1) NOT NULL,
  `danio` bit(1) NOT NULL,
  `altura` decimal(5,2) NOT NULL,
  `manijas` bit(1) NOT NULL,
  `peso` decimal(5,2) NOT NULL,
  `fecha_recarga` datetime NOT NULL,
  `fecha_prox_recarga` datetime NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `resp_reg` int(11) NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `resp_modificacion` int(11) DEFAULT NULL,
  `id_sub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `reg_extintores`:
--   `id_sub`
--       `cat_sub_areas` -> `id_subarea`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `id_userReg` int(11) NOT NULL,
  `fech_reg` datetime NOT NULL,
  `text_Rol` varchar(30) NOT NULL,
  `estatus` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `roles`:
--

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `id_userReg`, `fech_reg`, `text_Rol`, `estatus`) VALUES
(1, 0, '0000-00-00 00:00:00', 'Administrador', b'1'),
(2, 1, '2024-06-24 23:11:44', 'Capturador', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_subarea`
--

DROP TABLE IF EXISTS `user_subarea`;
CREATE TABLE `user_subarea` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_subarea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `user_subarea`:
--   `id_user`
--       `cat_usuarios` -> `id_user`
--   `id_subarea`
--       `cat_sub_areas` -> `id_subarea`
--

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_extsub`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `view_extsub`;
CREATE TABLE `view_extsub` (
`id_extintor` int(11)
,`id_sub` varchar(100)
,`num_extintor` int(11)
,`num_inventario` int(255)
,`estatus` bit(1)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_usuario`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_usuario`;
CREATE TABLE `vista_usuario` (
`id_user` int(11)
,`user_name` varchar(60)
,`last_name` varchar(40)
,`user` varchar(40)
,`correo` varchar(255)
,`fecha_reg` datetime
,`rol` varchar(30)
,`status` bit(1)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `asignar_view`
--
DROP TABLE IF EXISTS `asignar_view`;

DROP VIEW IF EXISTS `asignar_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `asignar_view`  AS SELECT `user_subarea`.`id_user` AS `id_user`, `user_subarea`.`id_subarea` AS `id_area`, `cat_sub_areas`.`textArea` AS `textArea` FROM (`user_subarea` join `cat_sub_areas` on(`user_subarea`.`id_subarea` = `cat_sub_areas`.`id_subarea`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_extsub`
--
DROP TABLE IF EXISTS `view_extsub`;

DROP VIEW IF EXISTS `view_extsub`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_extsub`  AS SELECT `cat_extintores`.`id_extintor` AS `id_extintor`, `cat_sub_areas`.`textArea` AS `id_sub`, `cat_extintores`.`num_extintor` AS `num_extintor`, `cat_extintores`.`num_inventario` AS `num_inventario`, `cat_extintores`.`estatus` AS `estatus` FROM (`cat_extintores` join `cat_sub_areas` on(`cat_extintores`.`id_sub` = `cat_sub_areas`.`id_subarea`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_usuario`
--
DROP TABLE IF EXISTS `vista_usuario`;

DROP VIEW IF EXISTS `vista_usuario`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_usuario`  AS SELECT `cat_usuarios`.`id_user` AS `id_user`, `cat_usuarios`.`user_name` AS `user_name`, `cat_usuarios`.`last_name` AS `last_name`, `cat_usuarios`.`user` AS `user`, `cat_usuarios`.`correo` AS `correo`, `cat_usuarios`.`fecha_reg` AS `fecha_reg`, `roles`.`text_Rol` AS `rol`, `cat_usuarios`.`status` AS `status` FROM (`cat_usuarios` join `roles` on(`cat_usuarios`.`id_rol` = `roles`.`id_rol`)) ;

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
  ADD KEY `cat_Extintores_index_0` (`id_extintor`),
  ADD KEY `id_subarea` (`id_sub`),
  ADD KEY `resp_reg` (`resp_reg`);

--
-- Indices de la tabla `cat_sub_areas`
--
ALTER TABLE `cat_sub_areas`
  ADD PRIMARY KEY (`id_subarea`),
  ADD KEY `id_area` (`id_area`);

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
  ADD KEY `id_userModificacion` (`id_userModificacion`),
  ADD KEY `id_userReg` (`id_userReg`),
  ADD KEY `id_subarea` (`id_sub`);

--
-- Indices de la tabla `reg_extintores`
--
ALTER TABLE `reg_extintores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resp_reg` (`resp_reg`),
  ADD KEY `resp_modificacion` (`resp_modificacion`),
  ADD KEY `id_extintor` (`id_extintor`),
  ADD KEY `id_direccion` (`id_direccion`),
  ADD KEY `id_subarea` (`id_sub`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `user_subarea`
--
ALTER TABLE `user_subarea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`id_subarea`),
  ADD KEY `id_subarea` (`id_subarea`);

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
  MODIFY `id_extintor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cat_sub_areas`
--
ALTER TABLE `cat_sub_areas`
  MODIFY `id_subarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `cat_usuarios`
--
ALTER TABLE `cat_usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `historico`
--
ALTER TABLE `historico`
  MODIFY `id_historico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mv_riesgos`
--
ALTER TABLE `mv_riesgos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reg_extintores`
--
ALTER TABLE `reg_extintores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user_subarea`
--
ALTER TABLE `user_subarea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Filtros para la tabla `cat_extintores`
--
ALTER TABLE `cat_extintores`
  ADD CONSTRAINT `cat_extintores_ibfk_1` FOREIGN KEY (`id_sub`) REFERENCES `cat_sub_areas` (`id_subarea`);

--
-- Filtros para la tabla `cat_sub_areas`
--
ALTER TABLE `cat_sub_areas`
  ADD CONSTRAINT `cat_sub_areas_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `cat_areas` (`id_area`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `cat_usuarios`
--
ALTER TABLE `cat_usuarios`
  ADD CONSTRAINT `cat_usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
  ADD CONSTRAINT `cat_usuarios_ibfk_2` FOREIGN KEY (`reg_user`) REFERENCES `cat_usuarios` (`id_user`);

--
-- Filtros para la tabla `mv_riesgos`
--
ALTER TABLE `mv_riesgos`
  ADD CONSTRAINT `mv_riesgos_ibfk_1` FOREIGN KEY (`id_sub`) REFERENCES `cat_sub_areas` (`id_subarea`);

--
-- Filtros para la tabla `reg_extintores`
--
ALTER TABLE `reg_extintores`
  ADD CONSTRAINT `reg_extintores_ibfk_1` FOREIGN KEY (`id_sub`) REFERENCES `cat_sub_areas` (`id_subarea`);

--
-- Filtros para la tabla `user_subarea`
--
ALTER TABLE `user_subarea`
  ADD CONSTRAINT `user_subarea_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `cat_usuarios` (`id_user`),
  ADD CONSTRAINT `user_subarea_ibfk_2` FOREIGN KEY (`id_subarea`) REFERENCES `cat_sub_areas` (`id_subarea`);


--
-- Metadatos
--
USE `phpmyadmin`;

--
-- Metadatos para la tabla asignar_view
--

--
-- Metadatos para la tabla cat_areas
--

--
-- Metadatos para la tabla cat_direccion
--

--
-- Metadatos para la tabla cat_extintores
--

--
-- Metadatos para la tabla cat_sub_areas
--

--
-- Metadatos para la tabla cat_usuarios
--

--
-- Metadatos para la tabla historico
--

--
-- Metadatos para la tabla mv_riesgos
--

--
-- Metadatos para la tabla reg_extintores
--

--
-- Volcado de datos para la tabla `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', '_ssst', 'reg_extintores', '{\"CREATE_TIME\":\"2024-07-04 10:13:15\"}', '2024-07-05 03:10:00');

--
-- Metadatos para la tabla roles
--

--
-- Metadatos para la tabla user_subarea
--

--
-- Metadatos para la tabla view_extsub
--

--
-- Metadatos para la tabla vista_usuario
--

--
-- Metadatos para la base de datos _ssst
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
