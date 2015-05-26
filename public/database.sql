/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.1.73 : Database - daeta
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`daeta` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `feedback` */

insert  into `feedback`(`id`,`amazonorder`,`buyer`,`rating`,`comment`,`skus`,`orderdate`,`lastsolicited`,`feedbackdate`,`fba`,`removalrequested`,`caseid`,`notes`) values (1,'11','Terry',1,'New battery works great','iPhone_5s',5,5,5,NULL,NULL,NULL,NULL),(2,'23','Roney',4,'New battery works great','iPhone_5s',5,5,5,NULL,NULL,NULL,NULL),(3,'24','Ronadal',5,NULL,'iPhone_6',5,5,5,NULL,NULL,NULL,NULL),(4,'25','Gerra',2,NULL,'iPhone_6',5,5,5,NULL,NULL,NULL,NULL),(5,'26','Tony',3,NULL,'iPhone_5',5,5,5,NULL,NULL,NULL,NULL),(6,'27','Jese',3,NULL,'iPhone_5',5,5,5,NULL,NULL,NULL,NULL),(7,'28','Jamse',4,'New battery works great','iPhone_6',5,5,5,NULL,NULL,NULL,NULL),(8,'29','Peter',5,NULL,'iPhone_6',5,5,5,NULL,NULL,NULL,NULL),(9,'30','Mary',5,'New battery works great','iPhone_5',5,5,5,NULL,NULL,NULL,NULL),(10,'31','Crow',1,NULL,'iPhone_6',5,5,5,NULL,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
