CREATE TABLE `sied`.`TipoPP`(  
  `iIdTipoPP` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vTipoPP` VARCHAR(100) NOT NULL,
  `iActivo` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0:No, 1:Sí',
  PRIMARY KEY (`iIdTipoPP`)
) ENGINE=INNODB CHARSET=utf8 COLLATE=utf8_general_ci;



ALTER TABLE `sied`.`intervencionpropuesta`   
  CHANGE `iTipoPP` `iIdTipoPP` INT(10) UNSIGNED NOT NULL,
  ADD COLUMN `iIdTipoEvaluacion` INT(10) UNSIGNED NOT NULL AFTER `iPreviamenteEvaluado`,
  ADD CONSTRAINT `FK_IntervencionPropuesta_TipoEvaluacion` FOREIGN KEY (`iIdTipoEvaluacion`) REFERENCES `sied`.`tipoevaluacion`(`iIdTipoEvaluacion`) ON UPDATE RESTRICT ON DELETE RESTRICT,
  ADD CONSTRAINT `FK_IntervencionPropuesta_TipoPP` FOREIGN KEY (`iIdTipoPP`) REFERENCES `sied`.`tipopp`(`iIdTipoPP`) ON UPDATE RESTRICT ON DELETE RESTRICT;
