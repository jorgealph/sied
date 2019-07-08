ALTER TABLE `sied`.`evaluacion`   
  ADD COLUMN `iIdResponsableSeguimiento` INT(10) DEFAULT 0  NOT NULL  COMMENT 'Vinculo con la tabla de usuarios' AFTER `dPublicacionDocOpininTrabajo`;
