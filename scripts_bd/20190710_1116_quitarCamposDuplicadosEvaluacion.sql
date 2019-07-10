ALTER TABLE `sied`.`evaluacion`   
  DROP COLUMN `iTipoContratacion`, 
  DROP COLUMN `vEspecificarOtro`, 
  DROP COLUMN `iIdOrganismo`, 
  DROP COLUMN `nCosto`, 
  DROP COLUMN `iIdFuenteFinanciamiento`, 
  CHANGE `iIdTipoContratacion` `iIdTipoContratacion` INT(10) UNSIGNED DEFAULT 0  NOT NULL  COMMENT 'Tipo de contratación',
  CHANGE `iIdResponsableContratacion` `iIdResponsableContratacion` INT(10) UNSIGNED DEFAULT 0  NOT NULL  COMMENT 'Organismo que contrató al evaluador',
  CHANGE `nCostoEvaluacion` `nCostoEvaluacion` DECIMAL(20,2) UNSIGNED DEFAULT 0.00  NOT NULL  COMMENT 'Costo de la evaluación', 
  DROP INDEX `FK_Evaluacion_Organismo`,
  DROP FOREIGN KEY `FK_Evaluacion_Organismo`;
