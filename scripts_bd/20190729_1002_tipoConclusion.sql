-- Creación tabla TipoConclusión
DROP TABLE IF EXISTS `tipoconclusion`;

CREATE TABLE `tipoconclusion` (
  `iIdTipoConclusion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vTipoConclusion` varchar(100) NOT NULL,
  `iActivo` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`iIdTipoConclusion`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tipoconclusion` */

insert  into `tipoconclusion`(`iIdTipoConclusion`,`vTipoConclusion`,`iActivo`) values (1,'Fortaleza',1),(2,'Oportunidad',1),(3,'Debilidad',1),(4,'Amenaza',1);

-- Modificación de tabla conclusión
ALTER TABLE `sied`.`conclusion`   
  ADD COLUMN `iTipoConclusion` INT(10) UNSIGNED NOT NULL AFTER `vFuenteInformacion`;

