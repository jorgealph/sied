ALTER TABLE `sied`.`evaluacion`   
  CHANGE `iIdUsuario` `iIdUsuario` INT(10) UNSIGNED DEFAULT 0  NULL  COMMENT 'Usuario evaluador',
  DROP FOREIGN KEY `FK_Evaluacion_Usuario`;
