ALTER TABLE `sied`.`evaluacion`   
  ADD COLUMN `dFechaSubida` DATETIME DEFAULT '1900-01-01 00:00:00'   NOT NULL  COMMENT 'Fecha de subida del archivo' AFTER `iEstatusArchivo`;
