CREATE TABLE `cat_Extintores` (
  `id_extintor` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `num_inventario` varchar(255),
  `fecha_registro` datetime,
  `num_extintor` int NOT NULL,
  `status` bit
);

CREATE TABLE `cat_areas` (
  `id_area` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_direccion` integer,
  `id_resp` integer,
  `textArea` varchar(100) NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `activo` bit NOT NULL
);

CREATE TABLE `cat_direccion` (
  `id_direccion` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `direccion` varchar(150) NOT NULL,
  `resp_reg` varchar(100) NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `activo` bit NOT NULL
);

CREATE TABLE `reg_extintores` (
  `id` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_extintor` integer NOT NULL,
  `id_area` int NOT NULL,
  `id_direccion` int NOT NULL,
  `id_mes_captura` int NOT NULL,
  `lugar_designado` bit NOT NULL,
  `acceso` bit NOT NULL,
  `senial` bit NOT NULL,
  `instrucciones` bit NOT NULL,
  `sellos` bit NOT NULL,
  `lecturas` bit NOT NULL,
  `danio` bit NOT NULL,
  `altura` double NOT NULL,
  `manijas` bit NOT NULL,
  `tipo_polvo` varchar(60) NOT NULL,
  `tipo_fuego` varchar(60) NOT NULL,
  `peso` double NOT NULL,
  `fecha_recarga` datetime NOT NULL,
  `fecha_prox_recarga` datetime NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `resp_reg` integer NOT NULL,
  `fecha_modificacion` datetime,
  `resp_modificacion` integer
);

CREATE TABLE `cat_usuarios` (
  `id_user` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user` varchar(40) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `pass` varchar(300) NOT NULL,
  `reg_user` integer,
  `id_rol` integer NOT NULL,
  `status` bit
);

CREATE TABLE `Historico` (
  `id_historico` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_user_history` integer NOT NULL,
  `text_table` varchar(40) NOT NULL,
  `id_of_table` integer NOT NULL,
  `val_before` varchar(400),
  `val_after` varchar(400),
  `fech_modificacion` datetime,
  `comment` varchar(600)
);

CREATE TABLE `mv_riesgos` (
  `id` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_area` integer NOT NULL,
  `id_mes` integer NOT NULL,
  `text_Riesgo` varchar(500) NOT NULL,
  `id_userReg` integer NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  `fechaModificacion` datetime NOT NULL,
  `id_userModificacion` integer NOT NULL,
  `estatus` bit,
  `solucion` varchar(500)
);

CREATE TABLE `roles` (
  `id_rol` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_userReg` integer,
  `fech_reg` datetime NOT NULL,
  `text_Rol` varchar(30) NOT NULL,
  `estatus` bit
);

CREATE INDEX `cat_Extintores_index_0` ON `cat_Extintores` (`id_extintor`);

ALTER TABLE `mv_riesgos` ADD FOREIGN KEY (`id_area`) REFERENCES `cat_areas` (`id_area`);

ALTER TABLE `mv_riesgos` ADD FOREIGN KEY (`id_userModificacion`) REFERENCES `cat_usuarios` (`id_user`);

ALTER TABLE `cat_usuarios` ADD FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);

ALTER TABLE `Historico` ADD FOREIGN KEY (`id_user_history`) REFERENCES `cat_usuarios` (`id_user`);

ALTER TABLE `cat_usuarios` ADD FOREIGN KEY (`reg_user`) REFERENCES `cat_usuarios` (`id_user`);

ALTER TABLE `mv_riesgos` ADD FOREIGN KEY (`id_userReg`) REFERENCES `cat_usuarios` (`id_user`);

ALTER TABLE `reg_extintores` ADD FOREIGN KEY (`resp_reg`) REFERENCES `cat_usuarios` (`id_user`);

ALTER TABLE `reg_extintores` ADD FOREIGN KEY (`resp_modificacion`) REFERENCES `cat_usuarios` (`id_user`);

ALTER TABLE `cat_areas` ADD FOREIGN KEY (`id_resp`) REFERENCES `cat_usuarios` (`id_user`);

ALTER TABLE `reg_extintores` ADD FOREIGN KEY (`id_extintor`) REFERENCES `cat_Extintores` (`id_extintor`);

ALTER TABLE `reg_extintores` ADD FOREIGN KEY (`id_direccion`) REFERENCES `cat_direccion` (`id_direccion`);

ALTER TABLE `reg_extintores` ADD FOREIGN KEY (`id_area`) REFERENCES `cat_areas` (`id_area`);

ALTER TABLE `cat_areas` ADD FOREIGN KEY (`id_direccion`) REFERENCES `cat_direccion` (`id_direccion`);
