/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.8-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: SSST
-- ------------------------------------------------------
-- Server version	10.11.8-MariaDB-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Temporary table structure for view `asignar_view`
--

DROP TABLE IF EXISTS `asignar_view`;
/*!50001 DROP VIEW IF EXISTS `asignar_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `asignar_view` AS SELECT
 1 AS `id_user`,
  1 AS `id_area`,
  1 AS `textArea` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `cat_areas`
--

DROP TABLE IF EXISTS `cat_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat_areas` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `id_direccion` int(11) DEFAULT NULL,
  `id_resp` int(11) DEFAULT NULL,
  `textArea` varchar(100) NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `estatus` bit(1) NOT NULL,
  PRIMARY KEY (`id_area`),
  KEY `id_resp` (`id_resp`),
  KEY `id_direccion` (`id_direccion`),
  CONSTRAINT `cat_areas_ibfk_1` FOREIGN KEY (`id_resp`) REFERENCES `cat_usuarios` (`id_user`),
  CONSTRAINT `cat_areas_ibfk_2` FOREIGN KEY (`id_direccion`) REFERENCES `cat_direccion` (`id_direccion`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_areas`
--

LOCK TABLES `cat_areas` WRITE;
/*!40000 ALTER TABLE `cat_areas` DISABLE KEYS */;
INSERT INTO `cat_areas` VALUES
(1,NULL,1,'Órgano Interno de Control','2024-03-26 20:21:43',''),
(2,NULL,1,'Dirección de Informática','2024-03-26 20:23:29',''),
(3,NULL,1,'CRIH','2024-03-26 20:23:29',''),
(4,NULL,1,'Coordinación de la Junta General de Asistencia','2024-03-26 20:25:04',''),
(5,NULL,1,'Dirección de Asuntos Jurídicos','2024-03-26 20:25:04',''),
(6,NULL,1,'Dirección de Administración','2024-03-26 20:25:04',''),
(7,NULL,1,'Dirección de Alimentación y Desarrollo Comunitario','2024-03-26 20:25:04',''),
(8,NULL,1,'Dirección de Ingresos','2024-03-26 20:25:04',''),
(9,NULL,1,'Coordinación del Despacho de la Presidencia del patronato del Sistema DIF Hidalgo','2024-03-26 20:25:04',''),
(10,NULL,1,'Titularidad del SEDIFH','2024-03-26 20:25:04',''),
(11,NULL,1,'Dirección de Protección a la Niñez y Adolescencia','2024-03-26 20:29:32',''),
(12,NULL,1,'Hospital del Niño DIF','2024-03-26 20:29:32',''),
(13,NULL,1,'Dirección General de Administración y Finanzas','2024-03-26 20:29:32',''),
(14,NULL,1,'Dirección General de Asistencia Social','2024-03-26 20:29:32',''),
(15,NULL,1,'Procuraduría de Protección de Niñas, Niños, Adolescencia y la Familia','2024-03-26 20:32:40',''),
(16,NULL,1,'Dirección de Planeación, Prospectiva y Normatividad','2024-03-26 20:33:51','');
/*!40000 ALTER TABLE `cat_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_direccion`
--

DROP TABLE IF EXISTS `cat_direccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat_direccion` (
  `id_direccion` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(150) NOT NULL,
  `resp_reg` varchar(100) NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `activo` bit(1) NOT NULL,
  PRIMARY KEY (`id_direccion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_direccion`
--

LOCK TABLES `cat_direccion` WRITE;
/*!40000 ALTER TABLE `cat_direccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `cat_direccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_extintores`
--

DROP TABLE IF EXISTS `cat_extintores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat_extintores` (
  `id_extintor` int(11) NOT NULL AUTO_INCREMENT,
  `num_inventario` int(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `num_extintor` int(11) NOT NULL,
  `estatus` bit(1) DEFAULT NULL,
  `resp_reg` int(11) DEFAULT NULL,
  `id_sub` int(11) NOT NULL,
  PRIMARY KEY (`id_extintor`),
  KEY `cat_Extintores_index_0` (`id_extintor`),
  KEY `id_subarea` (`id_sub`),
  KEY `resp_reg` (`resp_reg`),
  CONSTRAINT `cat_extintores_ibfk_1` FOREIGN KEY (`id_sub`) REFERENCES `cat_sub_areas` (`id_subarea`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_extintores`
--

LOCK TABLES `cat_extintores` WRITE;
/*!40000 ALTER TABLE `cat_extintores` DISABLE KEYS */;
INSERT INTO `cat_extintores` VALUES
(2,100,'2024-07-05 21:46:00',100,'',2,48),
(3,2167,'2024-07-08 18:52:00',1,'',19,53),
(4,2168,'2024-07-08 18:53:00',2,'',19,53),
(5,2169,'2024-07-08 18:53:00',3,'',19,53),
(6,2170,'2024-07-08 18:54:00',4,'',19,53),
(7,2171,'2024-07-08 18:54:00',5,'',19,53),
(8,2172,'2024-07-08 18:54:00',6,'',19,53),
(9,2173,'2024-07-08 18:57:00',7,'',19,53),
(10,2731,'2024-07-08 18:57:00',8,'',19,53),
(11,2732,'2024-07-08 18:58:00',9,'',19,53),
(12,2758,'2024-07-08 18:59:00',10,'',19,53),
(13,2759,'2024-07-08 18:59:00',11,'',19,53),
(14,2770,'2024-07-08 18:59:00',12,'',19,53),
(15,3317,'2024-07-08 18:59:00',13,'',19,53),
(16,3318,'2024-07-08 19:00:00',14,'',19,53),
(17,3319,'2024-07-08 19:00:00',15,'',19,53),
(18,3320,'2024-07-08 19:00:00',16,'',19,53),
(19,-1,'2024-07-08 19:03:00',17,'',19,53),
(20,-2,'2024-07-08 19:03:00',18,'',19,53),
(21,12369,'2024-07-08 19:16:00',1,'',31,56),
(22,12370,'2024-07-08 19:17:00',2,'',31,56),
(23,12371,'2024-07-08 19:17:00',3,'',31,56),
(24,12372,'2024-07-08 19:17:00',4,'',31,56),
(25,12373,'2024-07-08 19:18:00',5,'',31,56),
(26,12374,'2024-07-08 19:18:00',6,'',31,56),
(27,12375,'2024-07-08 19:19:00',7,'',31,56),
(28,19140,'2024-07-08 20:28:00',1,'',22,33),
(29,19141,'2024-07-08 20:28:00',2,'',22,33),
(30,36702,'2024-07-08 20:28:00',3,'',22,33),
(31,27482,'2024-07-08 20:48:00',4,'',22,30),
(32,28503,'2024-07-08 20:49:00',20,'',22,32),
(33,28510,'2024-07-08 20:49:00',25,'',22,30),
(34,20186,'2024-07-08 20:49:00',1,'',22,32),
(35,27361,'2024-07-08 20:50:00',2,'',22,32),
(36,27481,'2024-07-08 20:50:00',3,'\0',22,32),
(37,27483,'2024-07-08 20:51:00',5,'',22,32),
(38,27484,'2024-07-08 20:51:00',6,'',22,32),
(39,27485,'2024-07-08 20:51:00',7,'\0',22,32),
(40,27486,'2024-07-08 20:51:00',8,'',22,32),
(41,27487,'2024-07-08 20:52:00',9,'',22,32),
(42,27488,'2024-07-08 20:52:00',10,'\0',22,32),
(43,27490,'2024-07-08 20:52:00',11,'',22,32),
(44,28425,'2024-07-08 20:53:00',12,'',22,32),
(45,28426,'2024-07-08 20:53:00',13,'',22,32),
(46,28497,'2024-07-08 20:54:00',14,'',22,32),
(47,28498,'2024-07-08 20:54:00',15,'',22,32),
(48,28499,'2024-07-08 20:54:00',16,'',22,32),
(49,28500,'2024-07-08 20:54:00',17,'',22,32),
(50,28501,'2024-07-08 20:55:00',18,'',22,32),
(51,28502,'2024-07-08 20:55:00',19,'',22,30),
(52,28506,'2024-07-08 20:59:00',21,'',22,32),
(53,28507,'2024-07-08 21:01:00',22,'',22,32),
(54,28508,'2024-07-08 21:02:00',23,'',22,32),
(55,28509,'2024-07-08 21:02:00',24,'',22,32),
(56,28505,'2024-07-08 21:02:00',1,'',22,31),
(57,28511,'2024-07-08 21:03:00',26,'',22,32),
(58,28512,'2024-07-08 21:03:00',27,'',22,32),
(59,28513,'2024-07-08 21:04:00',28,'',22,32),
(60,28514,'2024-07-08 21:04:00',29,'',22,32),
(61,28515,'2024-07-08 21:04:00',30,'',22,32),
(62,28654,'2024-07-08 21:04:00',31,'',22,32),
(63,28504,'2024-07-08 21:26:00',2,'',22,31),
(64,27489,'2024-07-08 21:26:00',3,'',22,31);
/*!40000 ALTER TABLE `cat_extintores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_sub_areas`
--

DROP TABLE IF EXISTS `cat_sub_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat_sub_areas` (
  `id_subarea` int(11) NOT NULL AUTO_INCREMENT,
  `id_direccion` int(11) DEFAULT NULL,
  `id_resp` int(11) DEFAULT NULL,
  `textArea` varchar(100) NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `estatus` bit(1) NOT NULL,
  `id_area` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_subarea`),
  KEY `id_area` (`id_area`),
  CONSTRAINT `cat_sub_areas_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `cat_areas` (`id_area`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_sub_areas`
--

LOCK TABLES `cat_sub_areas` WRITE;
/*!40000 ALTER TABLE `cat_sub_areas` DISABLE KEYS */;
INSERT INTO `cat_sub_areas` VALUES
(1,NULL,1,'Órgano Interno de Control','2024-06-24 18:59:16','',1),
(2,NULL,1,'Dirección de Informática','2024-06-24 19:05:52','',2),
(3,NULL,1,'CRIH Pachuca','2024-06-24 19:06:55','',3),
(4,NULL,1,'CRIR Huehuetla','2024-06-24 19:06:55','',3),
(5,NULL,1,'CRIR Huejutla','2024-06-24 19:06:55','',3),
(6,NULL,1,'CRIR Ixmiquilpan','2024-06-24 19:06:55','',3),
(7,NULL,1,'CRIR Santiago Tulantepec','2024-06-24 19:06:55','',3),
(8,NULL,1,'CRIR Tula de Allende','2024-06-24 19:09:56','',3),
(9,NULL,1,'CRIR Zacualtipán','2024-06-24 19:09:56','',3),
(10,NULL,1,'Dirección de Asuntos Jurídicos','2024-06-24 19:11:33','',5),
(11,NULL,1,'Subdirección de Asuntos Jurídicos','2024-06-24 19:11:33','',5),
(12,NULL,1,'Coordinación de la Junta General de Asistencia','2024-06-24 19:14:41','',4),
(13,NULL,1,'Dirección de Administración','2024-06-24 19:14:59','',6),
(14,NULL,1,'Dirección de Alimentación y Desarrollo Comunitario','2024-06-24 19:15:26','',7),
(15,NULL,1,'Subdirección de Unidades Económicas','2024-06-24 19:15:52','',8),
(16,NULL,1,'Estacionamiento \"El Reloj\"','2024-06-24 19:16:19','',8),
(17,NULL,1,'Tizayuca','2024-06-24 19:17:25','',8),
(18,NULL,1,'Actopan','2024-06-24 19:17:25','',8),
(19,NULL,1,'Poniente','2024-06-24 19:17:25','',8),
(20,NULL,1,'Tulancingo','2024-06-24 19:17:25','',8),
(21,NULL,1,'Providencia','2024-06-24 19:17:25','',8),
(22,NULL,1,'Despacho del Patronato','2024-06-24 19:19:30','',9),
(23,NULL,1,'Coordinación de Giras, Eventos y Logístic','2024-06-24 19:19:30','',9),
(24,NULL,1,'Comunicación Social','2024-06-24 19:19:30','',9),
(25,NULL,1,'Voluntariado','2024-06-24 19:19:30','',9),
(26,NULL,1,'Relaciones Públicas','2024-06-24 19:19:30','',9),
(27,NULL,1,'','2024-06-24 19:19:30','',9),
(28,NULL,1,'Dirección de Gestión Institucional','2024-06-24 19:21:45','',10),
(29,NULL,1,'Titularidad del Sitema DIF','2024-06-24 19:21:45','',10),
(30,NULL,1,'Despacho de la Dirección','2024-06-24 19:22:49','',11),
(31,NULL,1,'Subdirección CAI','2024-06-24 19:22:49','',11),
(32,NULL,1,'Centro de Expresión Juvenil','2024-06-24 19:22:49','',11),
(33,NULL,1,'Desarrollo de Habilidades para Niñas, Niños y Adolescentes','2024-06-24 19:22:49','',11),
(34,NULL,1,'7 CAI´s','2024-06-24 19:22:49','',11),
(35,NULL,1,'Atorón','2024-06-24 19:22:49','',11),
(36,NULL,1,'Bomberos','2024-06-24 19:22:49','',11),
(37,NULL,1,'Parque Hidalgo','2024-06-24 19:22:49','',11),
(38,NULL,1,'San Bartolo','2024-06-24 19:22:49','',11),
(39,NULL,1,'Matilde','2024-06-24 19:22:49','',11),
(40,NULL,1,'Venta Prieta','2024-06-24 19:22:49','',11),
(41,NULL,1,'Burócratas','2024-06-24 19:22:49','',11),
(42,NULL,1,'Casa Cuna','2024-06-24 19:22:49','',11),
(43,NULL,1,'Casa de la Niña','2024-06-24 19:22:49','',11),
(44,NULL,1,'Casa del Niño','2024-06-24 19:22:49','',11),
(45,NULL,1,'La Casita','2024-06-24 19:22:49','',11),
(46,NULL,1,'Casa de la Adolescente','2024-06-24 19:22:49','',11),
(47,NULL,1,'PAMARES','2024-06-24 19:22:49','',11),
(48,NULL,1,'Hospital del Niño DIF','2024-06-24 19:28:03','',12),
(49,NULL,1,'Dirección General de Administración y Finanzas','2024-06-24 19:28:03','',13),
(50,NULL,1,'Dirección General de Asistencia Social','2024-06-24 19:28:03','',14),
(51,NULL,1,'Procuraduría de Protección de Niñas, Niños, Adolescencia y la Familia','2024-06-24 19:28:03','',15),
(52,NULL,1,'Dirección de Planeación, Prospectiva y Normatividad','2024-06-24 19:28:03','',16),
(53,NULL,1,'Casa Matriz','2024-06-24 21:18:00','',8),
(54,NULL,1,'Sur','2024-06-24 21:18:00','',8),
(55,NULL,1,'Casa de DÃ­a Centro de ExpresiÃ³n para el AdultoÂ Mayor','2024-07-08 20:21:53','',14),
(56,NULL,1,'Casa de DÃ­a \"MarÃ­a Elena RamÃ­rez deÂ Lozano\" ','2024-07-08 20:21:53','',14),
(57,NULL,1,'Subd. de VinculaciÃ³n a la Salud y EnvejecimientoÂ Saludable','2024-07-08 20:21:53','',14),
(58,NULL,1,'Casa de la Mujer Hidalguense','2024-07-08 20:21:53','',14),
(59,NULL,1,'SubprocuradurÃ­as Regionales de ProtecciÃ³n de NiÃ±as, NiÃ±os yÂ Adolescentes','2024-07-08 20:25:58','',15);
/*!40000 ALTER TABLE `cat_sub_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_usuarios`
--

DROP TABLE IF EXISTS `cat_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat_usuarios` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(40) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `pass` varchar(300) NOT NULL,
  `reg_user` int(11) DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  `status` bit(1) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_rol` (`id_rol`),
  KEY `reg_user` (`reg_user`),
  CONSTRAINT `cat_usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
  CONSTRAINT `cat_usuarios_ibfk_2` FOREIGN KEY (`reg_user`) REFERENCES `cat_usuarios` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_usuarios`
--

LOCK TABLES `cat_usuarios` WRITE;
/*!40000 ALTER TABLE `cat_usuarios` DISABLE KEYS */;
INSERT INTO `cat_usuarios` VALUES
(1,'Master','sevas','cordero','2024-04-16 11:34:00','$2y$10$8JCgy1mAtwp5iEFGeIDg/eh4aBBh4qESuKqPF5U5SBfI.jAOQxhK2',1,1,'',NULL),
(2,'GMAAUAD','GABRIELA','MAAUAD BULOS','2024-07-08 15:49:00','$2y$10$tQRSfKcNJLHYIkEGZYs/euIrfWTX.9gANTxplH847ZX/bQM7N92ge',1,1,'','gabriela.maauad@hidalgo.gob.mx'),
(3,'IOCADIZ','INGRID','OCADIZ ROMERO','2024-07-08 15:58:00','$2y$10$wGiF7vr7UvsTM0ZoYEqjP.Kz9Hipg5hbIl6vHvTe/var70gk4cmw6',1,1,'','ingrid.ocadiz@hidalgo.gob.mx'),
(4,'YVALENCIA','YESSENIA','VALENCIA LÓPEZ','2024-07-08 16:04:00','$2y$10$Afeg/kiVLUEs7Z2SOuW8tOGgjLjUSbbtsOXzuGvBNiu3/iXidtUHS',1,1,'','yessenia.valencia@gmail.com'),
(5,'MMURILLO','MONTSERRAT','MURILLO MARTÌNEZ','2024-07-08 16:10:00','$2y$10$DfpFRSPNHdajLoDZLjy25uNVpAWosoqM0E92xRDUsXFmjeuSlXqoS',1,2,'','monserrat.murillo@gmail.com'),
(6,'SALVAREZ','SERGIO','ÁLVAREZ GONZÁLEZ','2024-07-08 16:13:00','$2y$10$vo/hFIBJAHhHgw0wMFTzjuojWuErC0c9UgsXbxF0wrcy5c6Ot8PiC',1,2,'','sergio.alvarez@hidalgo.gob.mx'),
(7,'TVEGA','TELÉSFORO','VEGA MORENO','2024-07-08 16:17:00','$2y$10$01.cBiZKNSiDbLBRwMdSq.B7zDdzwX3Uxu5PWWlYnesfI1Z0LIIqa',1,2,'','mariomore_0701@hotmail.com'),
(8,'ROSORIO','RODRIGO ISRAEL','OSORIO PÉREZ','2024-07-08 16:29:00','$2y$10$KI.3GTxkhlc1ywa2h/jAcO9zYMUBMpwiy.v7eSIbz1pe..pX1NQZ2',1,2,'','royyer93@outlook.es'),
(9,'YARADILLAS','YULIANA','ARADILLAS ROMERO','2024-07-08 16:33:00','$2y$10$NUyhcz9CAUi6sxn8eK2xzuDIzg4WSkuj19Nng1Z88aItZgLSjmP0.',1,2,'','yuli_ar61@hotmail.com'),
(10,'JRAMIREZ','JOSÉ ANTONIO','RAMÍREZ RUBIO','2024-07-08 16:37:00','$2y$10$ADGl0Ki/HzEtnO68NDZ8O.h4g/p0UeeGYCumXjc3M6OhBHN9IUUUm',1,2,'','ramirezrubiojoseantonio3@gmail.com'),
(11,'GSANTAMARIA','GABRIELA','SANTAMARIA ESCAMILLA','2024-07-08 16:39:00','$2y$10$yanO5mmql.1k6FbkYrpD2evFRZy/YUsqUKb3YMIXeczFkiF8aHV4W',1,2,'','crirhvalletulancingo2@gmail.com'),
(12,'DGARCIA','DULCE ITZEL','GARCÍA HERNÁNDEZ','2024-07-08 16:43:00','$2y$10$qw/itY4ucq37UVbB.HXSweVAobiPV9kY9.TOQY7wbCOw7fsBsHwKW',1,2,'','rehabilitaciontula@hotmail.com'),
(13,'OMARTINEZ','ÓSCAR','MARTÍNEZ RODRÍGUEZ','2024-07-08 16:46:00','$2y$10$dzZ8vaIjKWhuJa5LtNe/L.XQ8HC7ll/yYfavPUF9ymmi/V7CZvOUy',1,2,'','cazador997505@gmail.com'),
(14,'MGONZALEZ','MIGUEL','GONZÁLEZ MENDOZA','2024-07-08 16:50:00','$2y$10$m4V0BUfMcBZ5uuHerqV0oOI7pBCnU20nqkzmIx96c6PD8wil7CYn.',1,2,'','miguelgmza@hotmail.com'),
(15,'MHERNADEZ','MARCO ANTONIO','HERNÁNDEZ MONTIEL','2024-07-08 16:54:00','$2y$10$mQeE3RvUNuz0mtmstRlB1.1NPGqJ4NUHSYaRipLwRdZW.hoiBrbC2',1,2,'','mahm7060@gmail.com'),
(16,'YMONTES','YAIR HABID','MONTES MARTÍNEZ','2024-07-08 16:57:00','$2y$10$ITJ4gBWVU18YB1J.TDq./.sM/BhYM1YdZjEFXmm8D4ROgzTVRPV7e',1,2,'','yairhabidmontesmartinez@gmail.com'),
(17,'MMONTIEL','MARCO ANTONIO','MONTIEL MONTES','2024-07-08 17:01:00','$2y$10$jpSiNJROe45khxDdN0d7eu1ZiVykfsALd1ud1dO9PMawK8Ixv4DXG',1,2,'','sedifhidalgo.apce@gmail.com'),
(18,'KGARCIA','KARLA IVONN','GARCÍA ALVARADO','2024-07-08 17:05:00','$2y$10$R1d0C0meYVpjSifTvTcDHuEVv7Np9gPWz2HbYc7OFK06jgLKA6Jzi',1,2,'','garciaalvaradokarlaivonn@gmail.com'),
(19,'RMORENO','REYNA ADRIANA','MORENO RODRÍGUEZ','2024-07-08 17:32:00','$2y$10$3JHjIoAMiHLrLpPG5aRWKOu9Wp2k1WooHgwlIPToM5qiU8r2xcl0e',1,2,'','reynaadris@gmail.com'),
(20,'NSILVA','NÉSTOR IGNACIO','SILVA GONZÁLEZ','2024-07-08 17:36:00','$2y$10$fH58HDr1aBG/JQiU8Y7rUuiVeMxZmUVhYCyUTXSAqdUhKn81IYgaW',1,2,'','nestor.ig@hidalgo.gob.mx'),
(21,'RSAMPERIO','RICARDO','SAMPERIO LABRA','2024-07-08 17:52:00','$2y$10$/vt3KTuYZVOKvhiOIdtCQOCmuk95lWOedfmUFDRPa2NLFRBYTKHUe',1,2,'','ricardo.samperio@hidalgo.gob.mx'),
(22,'MGRESS','MIREYA','GRESS OJEDA','2024-07-08 17:58:00','$2y$10$GTC.jevwV5z0xu8sJ6.0seNdOZkToVmKbWDkrytIbUXtCBpzpHnp2',1,2,'','mireyagress85@gmail.com'),
(23,'YROMERO','YARELI','ROMERO FLORES','2024-07-08 18:00:00','$2y$10$jdDlyNMwkG8wvBrWG0FfvusmIa.ylq6VystPJA2XuTcCN.0Ze0ksG',1,2,'','yareliromeroflores1997@gmail.com'),
(24,'YGONZALEZ','YANETH LILIANA','GONZÁLEZ GONZÁLEZ','2024-07-08 18:02:00','$2y$10$Y.Q502O78ieQPQ.VeO0bSOiH/i0V3YAzS5xILxXulkdvj6L4Rs482',1,2,'','yaligogo_25@hotmail.com'),
(25,'CLOZANO','CLAUDIA','LOZANO SILVA','2024-07-08 18:04:00','$2y$10$NFCh.NCacPiKSixTlKe9Geh6AcoWig5XaxKcjZ9p2m9gBrxV.pXE.',1,2,'','claudialozanosilva@live.com.mx'),
(26,'AFRAUSTO','ALEJANDRO','FRAUSTO MOLINA','2024-07-08 18:05:00','$2y$10$6BwIXRPzpKuTwv1FcJb6lOlQiBa13b5HSxV2RGj.Xjxy5wU.pX53i',1,2,'','alejandro.frausto@outlook.es'),
(27,'JISLAS','JUAN LEONEL','ISLAS LÓPEZ','2024-07-08 18:07:00','$2y$10$uz6Sp4L39i6/BecHC5S3eOvYRBteJadCxGtJxlF8z232lOaVvQPXC',1,2,'','krangpach@hotmail.com'),
(28,'FUGALDE','FLORECITA','UGALDE ÁNGELES','2024-07-08 18:09:00','$2y$10$B0DZtKDLPku69odPzi4gBOsiE3KomMfzP7JW0LYFVkpV4Kfj0lepC',1,2,'','recursoshumanosflor@hidalgo.gob.mx'),
(29,'AGONZALEZ','ALDA','GONZÁLEZ JUÁREZ','2024-07-08 18:11:00','$2y$10$7srF0GTLcRRU2BQZE/nEIuyQmrtwz8yjudmytZxRLvaJs/aBwV3e.',1,2,'','seguimientocepcidif@hidalgo.gob.mx'),
(30,'APINEDA','ANA MARÍA','PINEDA TORRES','2024-07-08 18:46:00','$2y$10$gZ2ZI0BGmMciJTQkaKe1OOXfbtdIITZwo6m51XUfPDoYoQ9Ehn7.O',1,2,'','pinedatorressanamaria@gmail.com'),
(31,'JHERNANDEZ','JOSEFINA','HERNÁNDEZ PONCE','2024-07-08 18:47:00','$2y$10$.lrrOBUu12ZfzJtWnoCTWe1Lv2WV5R1f5xFcKADp7IYShhfYzbdr2',1,2,'','casadediadif@hidalgo.gob.mx'),
(32,'GGASTALDI','GERARDO ALEJANDRO','GASTALDI BARRÓN','2024-07-08 18:48:00','$2y$10$c4SSOTW.4GmNlQ8aqHj5bOCoyX5.dAeuGI2zLcyf44rCgQzjE4c42',1,2,'','gerardo.gastaldi@hidalgo.gob.mx'),
(33,'KGONZALEZ','KARLA MONSERRAT','GONZÁLEZ CÓRDAVA','2024-07-08 18:49:00','$2y$10$uQC.rNwpn5mQb37CDeO2oexNhEgYbpQKoZGf0usq04U/5VRochY4y',1,2,'','kmgonzalez@casadelamujerhidalguense.edu.mx'),
(34,'CARANDA','CRISTINA','ARANDA MARTÍNEZ','2024-07-08 18:51:00','$2y$10$VfgUdvXv3nDVImhRuDDo8uTw4HQMJ0N2g6.TZpDZ6KAe3eMrYAP7S',1,2,'','cristinaam@hidalgo.gob.mx'),
(35,'DPEREZ','DITHER SAÚL','PÉREZ PIÑA','2024-07-08 18:53:00','$2y$10$l1eybDkj2M9ZlKs4gorrQuimjmtEDsyj5SmplVJ50Ktm5eZT7.N..',1,2,'','dither.saul@hotmail.com');
/*!40000 ALTER TABLE `cat_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historico`
--

DROP TABLE IF EXISTS `historico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historico` (
  `id_historico` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_history` int(11) NOT NULL,
  `text_table` varchar(40) NOT NULL,
  `id_of_table` int(11) NOT NULL,
  `val_before` varchar(400) DEFAULT NULL,
  `val_after` varchar(400) DEFAULT NULL,
  `fech_modificacion` datetime DEFAULT NULL,
  `comment` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`id_historico`),
  KEY `id_user_history` (`id_user_history`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historico`
--

LOCK TABLES `historico` WRITE;
/*!40000 ALTER TABLE `historico` DISABLE KEYS */;
/*!40000 ALTER TABLE `historico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mv_riesgos`
--

DROP TABLE IF EXISTS `mv_riesgos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mv_riesgos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_sub` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_userModificacion` (`id_userModificacion`),
  KEY `id_userReg` (`id_userReg`),
  KEY `id_subarea` (`id_sub`),
  CONSTRAINT `mv_riesgos_ibfk_1` FOREIGN KEY (`id_sub`) REFERENCES `cat_sub_areas` (`id_subarea`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mv_riesgos`
--

LOCK TABLES `mv_riesgos` WRITE;
/*!40000 ALTER TABLE `mv_riesgos` DISABLE KEYS */;
INSERT INTO `mv_riesgos` VALUES
(3,7,'Ninguna',19,'2024-07-08 18:44:00',NULL,NULL,'Baja','\0',NULL,NULL,53),
(4,7,'NINGUNA',22,'2024-07-08 20:15:00',NULL,NULL,'Baja','\0',NULL,NULL,31),
(5,7,'EN EPOCA DE LLUVIA, SE METE EL AGUA POR LA PARTE DE DEBAJO DE LA PUERTA PRINCIPAL Y LAS VENTANAS DE LOS BAÑOS SE METE EL AGUA AL LLOVER.',22,'2024-07-08 20:27:00',NULL,NULL,'Baja','\0',NULL,NULL,33),
(6,7,'DESCARGAS ELECTRICAS EN EL ÁREA PROVOCANDO QUE LOS EQUIPOS DE\r\nCOMPUTO SE APAGUEN Y ESTO PUEDE PROVOCAR DAÑOS EN EL SISTEMA\r\nOPERATIVO ADEMAS DE LA PERDIDA DE INFORMACIÓN EN LOS EQUIPOS.',22,'2024-07-08 20:40:00',NULL,NULL,'Baja','\0',NULL,NULL,30),
(7,7,'FILTRACIÓN DE AGUA EN LA ENTRADA PRINCIPAL HACIENDO QUE EL SUELO\r\nSE MOJÉ Y PUEDEN OCURRIR ACCIDENTES.',22,'2024-07-08 20:41:00',NULL,NULL,'Media','\0',NULL,NULL,30),
(8,7,'RIESGO DE INUNDACION DE AUDITORIO Y CONSULTORIOS DE PSICOLOGIA Y SEXOLOGIA POR DESNIVEL EN BANQUETA DE SALIDA DE MERGENCIA. ',22,'2024-07-08 20:44:00',NULL,NULL,'Alta','\0',NULL,NULL,32),
(9,7,'DESPRENDIMIENTO DE LOZETA EN SEGUNDO PISO DEL MODULO 1.',22,'2024-07-08 20:47:00',NULL,NULL,'Baja','\0',NULL,NULL,32);
/*!40000 ALTER TABLE `mv_riesgos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reg_extintores`
--

DROP TABLE IF EXISTS `reg_extintores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reg_extintores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_sub` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `resp_reg` (`resp_reg`),
  KEY `resp_modificacion` (`resp_modificacion`),
  KEY `id_extintor` (`id_extintor`),
  KEY `id_direccion` (`id_direccion`),
  KEY `id_subarea` (`id_sub`),
  CONSTRAINT `reg_extintores_ibfk_1` FOREIGN KEY (`id_sub`) REFERENCES `cat_sub_areas` (`id_subarea`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reg_extintores`
--

LOCK TABLES `reg_extintores` WRITE;
/*!40000 ALTER TABLE `reg_extintores` DISABLE KEYS */;
INSERT INTO `reg_extintores` VALUES
(1,2,NULL,7,'','\0','','\0','\0','','\0',0.70,'',4.30,'2024-07-04 00:00:00','2025-07-04 00:00:00','2024-07-05 21:50:00',2,NULL,NULL,48),
(2,21,NULL,7,'','\0','\0','','','','\0',1.60,'',2.26,'2024-05-08 00:00:00','2025-05-08 00:00:00','2024-07-08 19:36:00',31,NULL,NULL,56),
(3,22,NULL,7,'','\0','\0','','','','\0',1.10,'',2.26,'2024-05-08 00:00:00','2025-05-08 00:00:00','2024-07-08 19:37:00',31,NULL,NULL,56),
(4,23,NULL,7,'','\0','\0','','','','\0',1.10,'',6.00,'2024-05-08 00:00:00','2025-05-08 00:00:00','2024-07-08 19:38:00',31,NULL,NULL,56),
(5,24,NULL,7,'','\0','\0','','','','\0',1.10,'',6.00,'2024-05-08 00:00:00','2025-05-08 00:00:00','2024-07-08 19:39:00',31,NULL,NULL,56),
(6,25,NULL,7,'','\0','\0','','','','\0',1.10,'',6.00,'2024-05-08 00:00:00','2025-05-08 00:00:00','2024-07-08 19:41:00',31,NULL,NULL,56),
(7,26,NULL,7,'','\0','\0','','','','\0',1.00,'',6.00,'2024-05-08 00:00:00','2025-05-08 00:00:00','2024-07-08 19:42:00',31,NULL,NULL,56),
(8,27,NULL,7,'','\0','\0','','','','\0',1.00,'',6.00,'2024-05-08 00:00:00','2025-05-08 00:00:00','2024-07-08 19:42:00',31,NULL,NULL,56),
(9,56,NULL,7,'','\0','\0','','','','\0',1.50,'',2.30,'2023-06-01 00:00:00','2024-06-01 00:00:00','2024-07-08 21:30:00',22,NULL,NULL,31),
(10,63,NULL,7,'','\0','\0','','','','\0',1.50,'',4.50,'2023-06-01 00:00:00','2024-06-01 00:00:00','2024-07-08 21:31:00',22,NULL,NULL,31),
(11,64,NULL,7,'','\0','\0','','','','\0',1.50,'',2.30,'2023-06-01 00:00:00','2024-06-01 00:00:00','2024-07-08 21:32:00',22,NULL,NULL,31),
(12,28,NULL,7,'','\0','\0','','','','\0',0.00,'',4.50,'2023-11-14 00:00:00','2024-11-14 00:00:00','2024-07-08 22:20:00',22,NULL,NULL,33),
(13,29,NULL,7,'','\0','\0','','','','\0',0.00,'',4.50,'2023-11-14 00:00:00','2024-11-14 00:00:00','2024-07-08 22:21:00',22,NULL,NULL,33),
(14,30,NULL,7,'','\0','\0','','','','\0',0.00,'',4.50,'2023-11-14 00:00:00','2024-11-14 00:00:00','2024-07-08 22:21:00',22,NULL,NULL,33),
(15,34,NULL,7,'','\0','\0','','','','\0',1.50,'',4.50,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 22:41:00',22,NULL,NULL,32),
(16,35,NULL,7,'','\0','\0','','','','\0',1.50,'',2.30,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 22:44:00',22,NULL,NULL,32),
(17,31,NULL,7,'','\0','\0','','','','\0',1.50,'',2.00,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 22:45:00',22,NULL,NULL,30),
(18,37,NULL,7,'','\0','\0','','','','\0',1.50,'',2.00,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 22:46:00',22,NULL,NULL,32),
(19,38,NULL,7,'','\0','\0','','','','\0',1.50,'',2.00,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 22:48:00',22,NULL,NULL,32),
(20,40,NULL,7,'','\0','\0','','','','\0',1.50,'',2.00,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 22:50:00',22,NULL,NULL,32),
(21,41,NULL,7,'','\0','\0','','','','\0',1.50,'',2.00,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 22:51:00',22,NULL,NULL,32),
(22,43,NULL,7,'','\0','\0','','','','\0',0.00,'',2.00,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 22:53:00',22,NULL,NULL,32),
(23,44,NULL,7,'','\0','\0','','','','\0',1.50,'',2.30,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 22:53:00',22,NULL,NULL,32),
(24,45,NULL,7,'','\0','\0','','','','\0',1.50,'',4.50,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 22:56:00',22,NULL,NULL,32),
(25,46,NULL,7,'','\0','\0','','','','\0',1.50,'',2.30,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 22:56:00',22,NULL,NULL,32),
(26,47,NULL,7,'','\0','\0','','','','\0',1.50,'',4.50,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 22:57:00',22,NULL,NULL,32),
(27,48,NULL,7,'','\0','\0','','','','\0',1.50,'',4.50,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 22:57:00',22,NULL,NULL,32),
(28,49,NULL,7,'','\0','\0','','','','\0',1.50,'',4.50,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 22:58:00',22,NULL,NULL,32),
(29,50,NULL,7,'','\0','\0','','','','\0',1.00,'',4.50,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 22:59:00',22,NULL,NULL,32),
(30,50,NULL,7,'','\0','\0','','','','\0',1.50,'',4.50,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 22:59:00',22,NULL,NULL,32),
(31,51,NULL,7,'','\0','\0','','','','\0',1.50,'',2.30,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 23:00:00',22,NULL,NULL,30),
(32,32,NULL,7,'','\0','\0','','','','\0',1.50,'',4.50,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 23:04:00',22,NULL,NULL,32),
(33,52,NULL,7,'','\0','\0','','','','\0',1.50,'',4.50,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 23:08:00',22,NULL,NULL,32),
(34,53,NULL,7,'','\0','\0','','','','\0',1.50,'',2.30,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 23:09:00',22,NULL,NULL,32),
(35,54,NULL,7,'','\0','\0','','','','\0',1.50,'',2.30,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 23:10:00',22,NULL,NULL,32),
(36,55,NULL,7,'','\0','\0','','','','\0',2.30,'',2.30,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 23:11:00',22,NULL,NULL,32),
(37,33,NULL,7,'','\0','\0','','','','\0',1.50,'',2.30,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 23:11:00',22,NULL,NULL,30),
(38,57,NULL,7,'','\0','\0','','','','\0',1.50,'',4.50,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 23:12:00',22,NULL,NULL,32),
(39,58,NULL,7,'','\0','\0','','','','\0',1.50,'',4.50,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 23:16:00',22,NULL,NULL,32),
(40,59,NULL,7,'','\0','\0','','','','\0',1.50,'',2.30,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 23:16:00',22,NULL,NULL,32),
(41,60,NULL,7,'','\0','\0','','','','\0',0.00,'',4.50,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 23:17:00',22,NULL,NULL,32),
(42,61,NULL,7,'','\0','\0','','','','\0',1.50,'',2.00,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 23:17:00',22,NULL,NULL,32),
(43,62,NULL,7,'','\0','\0','','','','\0',0.00,'',4.50,'2024-06-11 00:00:00','2025-06-11 00:00:00','2024-07-08 23:18:00',22,NULL,NULL,32);
/*!40000 ALTER TABLE `reg_extintores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `id_userReg` int(11) NOT NULL,
  `fech_reg` datetime NOT NULL,
  `text_Rol` varchar(30) NOT NULL,
  `estatus` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,0,'0000-00-00 00:00:00','Administrador',''),
(2,1,'2024-06-24 23:11:44','Capturador','');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_subarea`
--

DROP TABLE IF EXISTS `user_subarea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_subarea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_subarea` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`,`id_subarea`),
  KEY `id_subarea` (`id_subarea`),
  CONSTRAINT `user_subarea_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `cat_usuarios` (`id_user`),
  CONSTRAINT `user_subarea_ibfk_2` FOREIGN KEY (`id_subarea`) REFERENCES `cat_sub_areas` (`id_subarea`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_subarea`
--

LOCK TABLES `user_subarea` WRITE;
/*!40000 ALTER TABLE `user_subarea` DISABLE KEYS */;
INSERT INTO `user_subarea` VALUES
(2,5,1),
(3,6,2),
(4,7,3),
(5,8,4),
(6,9,5),
(7,10,6),
(8,11,7),
(9,12,8),
(10,13,9),
(11,14,12),
(12,15,10),
(13,15,11),
(14,16,13),
(15,17,14),
(16,18,15),
(17,18,16),
(18,19,17),
(19,19,18),
(20,19,19),
(21,19,20),
(22,19,21),
(23,19,53),
(24,19,54),
(25,20,22),
(26,20,23),
(27,20,24),
(28,20,25),
(29,20,26),
(30,21,28),
(31,21,29),
(32,22,30),
(33,22,31),
(34,22,32),
(35,22,33),
(36,23,34),
(37,23,35),
(38,23,36),
(39,23,37),
(40,23,38),
(41,23,39),
(42,23,40),
(43,23,41),
(44,24,42),
(45,25,43),
(46,26,44),
(47,27,46),
(48,28,48),
(49,29,49),
(50,30,55),
(51,31,56),
(52,32,57),
(53,33,58),
(54,34,51),
(55,34,59),
(56,35,52);
/*!40000 ALTER TABLE `user_subarea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `view_extsub`
--

DROP TABLE IF EXISTS `view_extsub`;
/*!50001 DROP VIEW IF EXISTS `view_extsub`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `view_extsub` AS SELECT
 1 AS `id_extintor`,
  1 AS `id_sub`,
  1 AS `num_extintor`,
  1 AS `num_inventario`,
  1 AS `estatus` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vista_usuario`
--

DROP TABLE IF EXISTS `vista_usuario`;
/*!50001 DROP VIEW IF EXISTS `vista_usuario`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vista_usuario` AS SELECT
 1 AS `id_user`,
  1 AS `user_name`,
  1 AS `last_name`,
  1 AS `user`,
  1 AS `correo`,
  1 AS `fecha_reg`,
  1 AS `rol`,
  1 AS `status` */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `asignar_view`
--

/*!50001 DROP VIEW IF EXISTS `asignar_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `asignar_view` AS select `user_subarea`.`id_user` AS `id_user`,`user_subarea`.`id_subarea` AS `id_area`,`cat_sub_areas`.`textArea` AS `textArea` from (`user_subarea` join `cat_sub_areas` on(`user_subarea`.`id_subarea` = `cat_sub_areas`.`id_subarea`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_extsub`
--

/*!50001 DROP VIEW IF EXISTS `view_extsub`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_extsub` AS select `cat_extintores`.`id_extintor` AS `id_extintor`,`cat_sub_areas`.`textArea` AS `id_sub`,`cat_extintores`.`num_extintor` AS `num_extintor`,`cat_extintores`.`num_inventario` AS `num_inventario`,`cat_extintores`.`estatus` AS `estatus` from (`cat_extintores` join `cat_sub_areas` on(`cat_extintores`.`id_sub` = `cat_sub_areas`.`id_subarea`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_usuario`
--

/*!50001 DROP VIEW IF EXISTS `vista_usuario`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_usuario` AS select `cat_usuarios`.`id_user` AS `id_user`,`cat_usuarios`.`user_name` AS `user_name`,`cat_usuarios`.`last_name` AS `last_name`,`cat_usuarios`.`user` AS `user`,`cat_usuarios`.`correo` AS `correo`,`cat_usuarios`.`fecha_reg` AS `fecha_reg`,`roles`.`text_Rol` AS `rol`,`cat_usuarios`.`status` AS `status` from (`cat_usuarios` join `roles` on(`cat_usuarios`.`id_rol` = `roles`.`id_rol`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-09 11:16:04
