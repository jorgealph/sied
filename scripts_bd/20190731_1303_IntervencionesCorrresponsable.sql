-- Creacion de tabla IntervencionPropuestaCorresponsable
CREATE TABLE `sied`.`IntervencionPropuestaCorresponsable`(  
  `iIdIntervencionPropuesta` INT(10) UNSIGNED NOT NULL,
  `iIdOrganismo` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`iIdIntervencionPropuesta`, `iIdOrganismo`),
  CONSTRAINT `FK_IntervencionPropC_Intervecion` FOREIGN KEY (`iIdIntervencionPropuesta`) REFERENCES `sied`.`intervencionpropuesta`(`iIdIntervencionPropuesta`) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT `FK_IntervencionPropC_Orgnismo` FOREIGN KEY (`iIdOrganismo`) REFERENCES `sied`.`organismo`(`iIdOrganismo`) ON UPDATE RESTRICT ON DELETE RESTRICT
);

ALTER TABLE `sied`.`intervencionpropuestacorresponsable`  
  ENGINE=INNODB;

--Creacion de tabla IntervencionCorresponsable
CREATE TABLE `sied`.`IntervencionCorresponsable`(  
  `iIdIntervencion` INT(10) UNSIGNED NOT NULL,
  `iIdOrganismo` INT(10) NOT NULL,
  PRIMARY KEY (`iIdIntervencion`, `iIdOrganismo`),
  CONSTRAINT `FK_IntervencionC_Intervencion` FOREIGN KEY (`iIdIntervencion`) REFERENCES `sied`.`intervencion`(`iIdIntervencion`) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT `FK_IntervencionC_Corresponsable` FOREIGN KEY (`iIdOrganismo`) REFERENCES `sied`.`organismo`(`iIdOrganismo`) ON UPDATE RESTRICT ON DELETE RESTRICT
) ENGINE=INNODB CHARSET=utf8 COLLATE=utf8_general_ci;
