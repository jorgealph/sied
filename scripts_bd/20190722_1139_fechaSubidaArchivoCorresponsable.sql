ALTER TABLE `sied`.`evaluacioncorresponsable`   
  ADD COLUMN `dFechaSubida` DATETIME DEFAULT '1900-01-01'   NOT NULL  COMMENT 'Fecha de subida' AFTER `iEstatusArchivo`;
