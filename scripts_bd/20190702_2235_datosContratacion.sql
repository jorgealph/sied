/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.7.19 : Database - sied
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sied` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `sied`;

/*Table structure for table `tipocontratacion` */

DROP TABLE IF EXISTS `tipocontratacion`;

CREATE TABLE `tipocontratacion` (
  `iIdTipoContratacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vTipoContratacion` varchar(100) NOT NULL,
  `iActivo` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`iIdTipoContratacion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tipocontratacion` */

insert  into `tipocontratacion`(`iIdTipoContratacion`,`vTipoContratacion`,`iActivo`) values (1,'Adjudicación directa',1),(2,'Invitación a tres',1),(3,'Licitación pública nacional',1),(4,'Licitación pública internacional',1),(5,'Otra: Señalar',1);


CREATE TABLE `sied`.`Financiamiento`(  
  `iIdFinanciamiento` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vFinanciamiento` VARCHAR(255) NOT NULL,
  `iActivo` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`iIdFinanciamiento`)
);

insert  into `Financiamiento`(`iIdFinanciamiento`,`vFinanciamiento`,`iActivo`) values (1,'Recurso propio',1);


ALTER TABLE `sied`.`evaluacion`   
  ADD COLUMN `iIdTipoContratacion` INT(10) UNSIGNED DEFAULT 0  NOT NULL AFTER `vComentarioGeneral`,
  ADD COLUMN `vEspecificarContratacion` VARCHAR(100) DEFAULT ''  NOT NULL AFTER `iIdTipoContratacion`,
  ADD COLUMN `iIdResponsableContratacion` INT(10) UNSIGNED DEFAULT 0  NOT NULL AFTER `vEspecificarContratacion`,
  ADD COLUMN `nCostoEvaluacion` DECIMAL(20,2) UNSIGNED DEFAULT 0  NOT NULL AFTER `iIdResponsableContratacion`,
  ADD COLUMN `iIdFinanciamiento` INT(10) UNSIGNED DEFAULT 0  NOT NULL AFTER `nCostoEvaluacion`,
  CHANGE `iActivo` `iActivo` TINYINT(1) UNSIGNED DEFAULT 1  NOT NULL  COMMENT '1:Sí, 0:No'  AFTER `iIdFinanciamiento`;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


