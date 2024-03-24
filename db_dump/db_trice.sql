CREATE DATABASE  IF NOT EXISTS `db_trice` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_trice`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: db_trice
-- ------------------------------------------------------
-- Server version	5.7.14

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_amount_msg`
--

DROP TABLE IF EXISTS `tbl_amount_msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_amount_msg` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) DEFAULT NULL,
  `date` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `last_hour` varchar(12) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_msg`
--

DROP TABLE IF EXISTS `tbl_msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_msg` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `message` longblob,
  `attachment` tinyblob,
  `date` varchar(20) DEFAULT NULL,
  `hour` varchar(12) DEFAULT NULL,
  `expiration_date` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `amount_open` int(1) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED KEY_BLOCK_SIZE=8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_msg`
--

LOCK TABLES `tbl_msg` WRITE;
/*!40000 ALTER TABLE `tbl_msg` DISABLE KEYS */;
INSERT INTO `tbl_msg` VALUES (108,'K2safh69aQqHYLbIQLaeD8JNTPF6yb54vLzWUrCuTdmLtZ7Yi05qP1X/SPsG9gNciaHg23oSfNWRqH6Qxclyf0a9YK53eGSLgTRiBL96UqlBPFeJMc9mhiciPk72EymHHo+7T31etpRAX1wFVRMrzeuqL2sX2VgCdS2GV9h2hGc=','','22 March 2024','10:02:14 pm','25 March 2024','76defaff1f6833f41695732fed73874a','::1',0),(109,'ittRKd4sp5jdG8FWAizd22cNxFoXgRb6CDlUjAHd14o2jsz/3oy1u9j205T0/tF4vcMxyAAzjm4HrECm2iRKtzghQFjVYBEY+kQglPDPp5oHAOgLlMx92UVxABt4ZAvTsWTDZehnoRnfRGyJCtsViOdoN0d+nqXnIr9UrJvK5XdbP2CEcQMXhxM4Pmn97i7GHElTCRU9gZoYY1+VUnBzlg==','','22 March 2024','10:13:05 pm','25 March 2024','782422294c376569d3c20d08ec5ed36e','::1',0);
/*!40000 ALTER TABLE `tbl_msg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'db_trice'
--
/*!50106 SET @save_time_zone= @@TIME_ZONE */ ;
/*!50106 DROP EVENT IF EXISTS `delete_old_messages` */;
DELIMITER ;;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;;
/*!50003 SET character_set_client  = utf8mb4 */ ;;
/*!50003 SET character_set_results = utf8mb4 */ ;;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;;
/*!50003 SET @saved_time_zone      = @@time_zone */ ;;
/*!50003 SET time_zone             = 'SYSTEM' */ ;;
/*!50106 CREATE*/ /*!50117 DEFINER=`db_trice`@`%%`*/ /*!50106 EVENT `delete_old_messages` ON SCHEDULE EVERY 1 DAY STARTS '2016-09-27 00:00:00' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'delete messages expired' DO DELETE FROM db_trice.tbl_msg WHERE str_to_date(expiration_date, '%d %M %Y') <= CURDATE() */ ;;
/*!50003 SET time_zone             = @saved_time_zone */ ;;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;;
/*!50003 SET character_set_client  = @saved_cs_client */ ;;
/*!50003 SET character_set_results = @saved_cs_results */ ;;
/*!50003 SET collation_connection  = @saved_col_connection */ ;;
DELIMITER ;
/*!50106 SET TIME_ZONE= @save_time_zone */ ;

--
-- Dumping routines for database 'db_trice'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-22 21:23:57
