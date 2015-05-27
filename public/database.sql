/*
SQLyog Ultimate v9.10 
MySQL - 5.1.73 : Database - daeta
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`daeta` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `daeta`;

/*Table structure for table `feedback` */

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amazonorder` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `buyer` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skus` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `orderdate` int(20) NOT NULL,
  `lastsolicited` int(20) DEFAULT NULL,
  `feedbackdate` int(20) DEFAULT NULL,
  `fba` int(11) DEFAULT NULL,
  `removalrequested` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caseid` int(11) DEFAULT NULL,
  `notes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `feedback` */

insert  into `feedback`(`id`,`amazonorder`,`buyer`,`rating`,`comment`,`skus`,`orderdate`,`lastsolicited`,`feedbackdate`,`fba`,`removalrequested`,`caseid`,`notes`) values (15,'-10621630','Henry Lara',1,'No instructions on how to replace the battery. There was a link to a video but the link didn\'t work so I had no way to know how to know how to replace the battery.','iPhone_5s_BattKit',1432340097,NULL,1432486800,1,NULL,NULL,NULL),(16,'-12510694','Gary Parish',2,'Nice quick delivery or the wrong battery. Am returning the kit for a refund and will seek it elsewhere. Order was for an iPhone 4 battery and battery in the package was marked on the box with an S in ','iPhone_4_BattKit',1431789762,NULL,1432141200,1,NULL,NULL,NULL),(17,'-10621630','Henry Lara',1,'No instructions on how to replace the battery. There was a link to a video but the link didn\'t work so I had no way to know how to know how to replace the battery.','iPhone_5s_BattKit',1432340097,NULL,1432486800,1,NULL,NULL,NULL),(18,'-12510694','Gary Parish',2,'Nice quick delivery or the wrong battery. Am returning the kit for a refund and will seek it elsewhere. Order was for an iPhone 4 battery and battery in the package was marked on the box with an S in ','iPhone_4_BattKit',1431789762,NULL,1432141200,1,NULL,NULL,NULL),(19,'-10621630','Henry Lara',1,'No instructions on how to replace the battery. There was a link to a video but the link didn\'t work so I had no way to know how to know how to replace the battery.','iPhone_5s_BattKit',1432340097,NULL,1432486800,1,NULL,NULL,NULL),(20,'-12510694','Gary Parish',2,'Nice quick delivery or the wrong battery. Am returning the kit for a refund and will seek it elsewhere. Order was for an iPhone 4 battery and battery in the package was marked on the box with an S in ','iPhone_4_BattKit',1431789762,NULL,1432141200,1,NULL,NULL,NULL);

/*Table structure for table `reportlist` */

DROP TABLE IF EXISTS `reportlist`;

CREATE TABLE `reportlist` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `report_id` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `NewIndex1` (`report_id`)
) ENGINE=MyISAM AUTO_INCREMENT=201 DEFAULT CHARSET=latin1;

/*Data for the table `reportlist` */

insert  into `reportlist`(`id`,`report_id`,`status`) values (101,58879189543,1),(102,58872869193,1),(103,58867141263,1),(104,58862208753,0),(105,58857685553,0),(106,58853202673,0),(107,58848496783,0),(108,58843218263,0),(109,58837991413,0),(110,58832142733,0),(111,58826963343,0),(112,58821924803,0),(113,58817094083,0),(114,58811674993,0),(115,58806587473,0),(116,58801936393,0),(117,58797408653,0),(118,58793385483,0),(119,58789841593,0),(120,58785912923,0),(121,58780948893,0),(122,58775845373,0),(123,58770951723,0),(124,58765894633,0),(125,58760829643,0),(126,58755794203,0),(127,58750822103,0),(128,58746098213,0),(129,58741636353,0),(130,58737228363,0),(131,58732804723,0),(132,58728849403,0),(133,58724289963,0),(134,58720574953,0),(135,58716833033,0),(136,58713029153,0),(137,58711932693,0),(138,58708094863,0),(139,58703550513,0),(140,58697077793,0),(141,58691909583,0),(142,58687446903,0),(143,58663412353,0),(144,58658158733,0),(145,58652669823,0),(146,58646912273,0),(147,58640749053,0),(148,58634612503,0),(149,58629239273,0),(150,58624284833,0),(151,58619476683,0),(152,58614785943,0),(153,58609852663,0),(154,58604552203,0),(155,58599111483,0),(156,58593830303,0),(157,58588078883,0),(158,58582059673,0),(159,58574641363,0),(160,58568451793,0),(161,58563363863,0),(162,58554547283,0),(163,58549888213,0),(164,58544975763,0),(165,58540287353,0),(166,58535183363,0),(167,58503358273,0),(168,58498181013,0),(169,58493207943,0),(170,58488513693,0),(171,58484061823,0),(172,58479144053,0),(173,58473730403,0),(174,58468239033,0),(175,58461987083,0),(176,58456163273,0),(177,58450295773,0),(178,58444877553,0),(179,58438983283,0),(180,58433049393,0),(181,58427857763,0),(182,58423049173,0),(183,58418462843,0),(184,58413221033,0),(185,58408630773,0),(186,58403123693,0),(187,58397805603,0),(188,58393456963,0),(189,58388924383,0),(190,58384159723,0),(191,58378323813,0),(192,58371864213,0),(193,58365772993,0),(194,58360696473,0),(195,58355979863,0),(196,58351796443,0),(197,58347277363,0),(198,58342387143,0),(199,58337163543,0),(200,58331956233,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
