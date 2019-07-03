ALTER TABLE `sied`.`organismo`   
  ADD COLUMN `iIdPoder` INT(10) UNSIGNED DEFAULT 0  NOT NULL AFTER `iActivo`,
  ADD COLUMN `iIdAmbito` INT(10) UNSIGNED NOT NULL AFTER `iIdPoder`;

/*Table structure for table `ambito` */

DROP TABLE IF EXISTS `ambito`;

CREATE TABLE `ambito` (
  `iIdAmbito` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vAmbito` varchar(50) NOT NULL,
  `iActivo` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`iIdAmbito`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `ambito` */

insert  into `ambito`(`iIdAmbito`,`vAmbito`,`iActivo`) values (1,'Federal',1),(2,'Estatal',1),(3,'Local',1);

/*Table structure for table `poder` */

DROP TABLE IF EXISTS `poder`;

CREATE TABLE `poder` (
  `iIdPoder` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vPoder` varchar(50) NOT NULL,
  `iActivo` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`iIdPoder`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `poder` */

insert  into `poder`(`iIdPoder`,`vPoder`,`iActivo`) values (1,'Ejecutivo',1),(2,'Legislativo',1),(3,'Judicial',1),(4,'Autónomo',1);
