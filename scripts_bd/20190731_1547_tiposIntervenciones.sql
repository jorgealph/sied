-- Se crea catálogo de Tipos de Fondo
CREATE TABLE `sied`.`TipoFondo`(  
  `iIdTipoFondo` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vTipoFondo` VARCHAR(250) NOT NULL,
  `iActivo` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`iIdTipoFondo`)
) ENGINE=INNODB CHARSET=utf8;

-- Se elimina llave foranéa pata TipoPP y se añade campo para TipoFondo
ALTER TABLE `sied`.`intervencionpropuesta`   
  CHANGE `iIdTipoPP` `iIdTipoPP` INT(10) UNSIGNED DEFAULT 0  NOT NULL  COMMENT 'Sólo si el programa es de tipo Programa Presupuestario',
  ADD COLUMN `iIdTipoFondo` INT(10) UNSIGNED DEFAULT 0  NOT NULL  COMMENT 'Sólo si el programa es de tipo Fondo' AFTER `iIdTipoPP`,
  DROP FOREIGN KEY `FK_IntervencionPropuesta_TipoPP`;

--Se añaden campos PMP y Objetivo PMP
ALTER TABLE `sied`.`intervencionpropuesta`   
  ADD COLUMN `vPMP` VARCHAR(255) DEFAULT ''  NOT NULL AFTER `iActivo`,
  ADD COLUMN `vObjetivoPMP` VARCHAR(255) DEFAULT ''  NOT NULL AFTER `vPMP`;

-- Orden para el catálogo Tipo Evaluación 
ALTER TABLE `sied`.`tipoevaluacion`   
  ADD COLUMN `iOrden` INT(2) DEFAULT 0  NOT NULL  COMMENT 'Indica el orden del catálogo' AFTER `iActivo`;

-- Se elimina llave foránea iIdTipoEvaluacion
ALTER TABLE `sied`.`intervencionpropuesta`   
  CHANGE `iIdTipoEvaluacion` `iIdTipoEvaluacion` INT(10) UNSIGNED DEFAULT 0  NOT NULL,
  DROP FOREIGN KEY `FK_IntervencionPropuesta_TipoEvaluacion`;

