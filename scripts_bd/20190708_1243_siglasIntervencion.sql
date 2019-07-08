ALTER TABLE `sied`.`intervencionpropuesta`   
  ADD COLUMN `vSiglas` VARCHAR(50) DEFAULT ''  NOT NULL AFTER `vIntervencion`;

ALTER TABLE `sied`.`intervencion`   
  ADD COLUMN `vSiglas` VARCHAR(50) DEFAULT ''  NOT NULL AFTER `vIntervencion`;
