USE `sied`;

DROP TABLE IF EXISTS `instrumento`;

CREATE TABLE `instrumento` (
  `iIdInstrumento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vInstrumento` varchar(100) NOT NULL,
  `iActivo` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`iIdInstrumento`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `instrumento` */

insert  into `instrumento`(`iIdInstrumento`,`vInstrumento`,`iActivo`) values (1,'Formatos',1),(2,'Cuestionarios',1),(3,'Entrevistas',1),(4,'Otros',1);


CREATE TABLE `sied`.`EvaluacionInstrumento`(  
  `iIdEvaluacion` INT(10) NOT NULL,
  `iIdInstrumento` INT(10) NOT NULL,
  `vOtro` VARCHAR(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`iIdEvaluacion`, `iIdInstrumento`)
) ENGINE=INNODB CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE `sied`.`EvaluacionInstrumento`   
  CHANGE `iIdEvaluacion` `iIdEvaluacion` INT(10) UNSIGNED NOT NULL,
  CHANGE `iIdInstrumento` `iIdInstrumento` INT(10) UNSIGNED NOT NULL,
  ADD CONSTRAINT `FK_EvalInstr_Evaluacion` FOREIGN KEY (`iIdEvaluacion`) REFERENCES `sied`.`evaluacion`(`iIdEvaluacion`) ON UPDATE RESTRICT ON DELETE RESTRICT,
  ADD CONSTRAINT `FK_EvalInstr_Instrumento` FOREIGN KEY (`iIdInstrumento`) REFERENCES `sied`.`instrumento`(`iIdInstrumento`) ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE `sied`.`evaluacion`   
  ADD COLUMN `vTecnicasModelos` VARCHAR(1000) DEFAULT ''  NOT NULL  COMMENT 'Descripción de las técnicas y modelos usadas' AFTER `iEstatusArchivo`;
