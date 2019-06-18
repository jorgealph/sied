ALTER TABLE `sied`.`evaluacion` 
DROP FOREIGN KEY `FK_Evaluacion_Organismo`;
ALTER TABLE `sied`.`evaluacion` 
CHANGE COLUMN `iIdOrganismo` `iIdOrganismo` INT(10) NULL COMMENT 'Organismo que contrató al evaluador' ;
ALTER TABLE `sied`.`evaluacion` 
ADD CONSTRAINT `FK_Evaluacion_Organismo`
  FOREIGN KEY (`iIdOrganismo`)
  REFERENCES `sied`.`organismo` (`iIdOrganismo`);