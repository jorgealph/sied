ALTER TABLE `sied`.`intervencionpropuesta`   
  CHANGE `iIdTipoEvaluacion` `iIdTipoEvaluacion` INT(10) UNSIGNED DEFAULT 0  NOT NULL, 
  DROP INDEX `FK_IntervencionPropuesta_TipoEvaluacion`,
  DROP FOREIGN KEY `FK_IntervencionPropuesta_TipoEvaluacion`;