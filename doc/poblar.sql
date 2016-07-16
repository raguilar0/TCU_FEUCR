-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: feucr
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

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
-- Table structure for table `amounts`
--

DROP TABLE IF EXISTS `amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `detail` varchar(2048) NOT NULL,
  `type` int(2) NOT NULL DEFAULT '0',
  `association_id` int(10) unsigned NOT NULL,
  `tract_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `association_id` (`association_id`),
  CONSTRAINT `amounts_ibfk_1` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amounts`
--

LOCK TABLES `amounts` WRITE;
/*!40000 ALTER TABLE `amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `associations`
--

DROP TABLE IF EXISTS `associations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `associations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `acronym` varchar(16) NOT NULL,
  `name` varchar(70) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `schedule` varchar(100) DEFAULT NULL,
  `authorized_card` int(1) NOT NULL DEFAULT '0',
  `enable` int(1) NOT NULL DEFAULT '1',
  `headquarter_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`acronym`),
  KEY `headquarter_id` (`headquarter_id`),
  CONSTRAINT `associations_ibfk_1` FOREIGN KEY (`headquarter_id`) REFERENCES `headquarters` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `associations`
--

LOCK TABLES `associations` WRITE;
/*!40000 ALTER TABLE `associations` DISABLE KEYS */;
INSERT INTO `associations` VALUES (1,'AECCI','Asociación de Estudiantes de Ciencias de la Computación','San Pedro','8-10 pm',0,1,1),(2,'AEG','Asociacion de estudiantes de generales',NULL,'10 am-8 pm',0,1,1),(3,'aasas','asadsd','asasda','asdas',1,1,2);
/*!40000 ALTER TABLE `associations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `boxes`
--

DROP TABLE IF EXISTS `boxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boxes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `little_amount` double NOT NULL DEFAULT '0',
  `big_amount` double NOT NULL DEFAULT '0',
  `type` int(10) unsigned NOT NULL DEFAULT '0',
  `association_id` int(10) unsigned NOT NULL,
  `tract_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `association_id` (`association_id`),
  CONSTRAINT `boxes_ibfk_1` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boxes`
--

LOCK TABLES `boxes` WRITE;
/*!40000 ALTER TABLE `boxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `boxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `headquarters`
--

DROP TABLE IF EXISTS `headquarters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `headquarters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `headquarters`
--

LOCK TABLES `headquarters` WRITE;
/*!40000 ALTER TABLE `headquarters` DISABLE KEYS */;
INSERT INTO `headquarters` VALUES (1,'Rodrigo Facio','facio_1467607692.jpg'),(2,'Sede del atlántico','atlantico_1467607764.jpg'),(4,'Recinto de Golfito','recinto_golfito_1467609386.jpg'),(5,'Sede de Occidente','sede_occidente_1467609473.png'),(6,'Sede de Guanacaste','sede_guanacaste_1467609497.jpg'),(7,'Sede del pacífico','sede_pacífico_1467609532.jpg'),(8,'Sede Interuniversitaria de Alajuela','sede_interuniversitaria_1467609566.jpg');
/*!40000 ALTER TABLE `headquarters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `initial_amounts`
--

DROP TABLE IF EXISTS `initial_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `initial_amounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` int(2) NOT NULL DEFAULT '0',
  `association_id` int(10) unsigned NOT NULL,
  `tract_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `association_id` (`association_id`),
  CONSTRAINT `initial_amounts_ibfk_1` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `initial_amounts`
--

LOCK TABLES `initial_amounts` WRITE;
/*!40000 ALTER TABLE `initial_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `initial_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(20) NOT NULL,
  `legal_certificate` varchar(20) NOT NULL,
  `provider` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `clarifications` varchar(2048) DEFAULT NULL,
  `image_name` varchar(256) DEFAULT NULL,
  `detail` varchar(2048) DEFAULT NULL,
  `kind` int(1) DEFAULT '0',
  `state` int(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `attendant` varchar(100) DEFAULT NULL,
  `association_id` int(10) unsigned NOT NULL,
  `tract_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `image_name` (`image_name`),
  KEY `association_id` (`association_id`),
  CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saving_accounts`
--

DROP TABLE IF EXISTS `saving_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saving_accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bank` varchar(128) NOT NULL,
  `account_owner` varchar(64) NOT NULL,
  `card_number` varchar(64) NOT NULL,
  `association_id` int(10) unsigned NOT NULL,
  `tract_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `association_id` (`association_id`),
  KEY `tract_id` (`tract_id`),
  CONSTRAINT `saving_accounts_ibfk_1` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`),
  CONSTRAINT `saving_accounts_ibfk_2` FOREIGN KEY (`tract_id`) REFERENCES `tracts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saving_accounts`
--

LOCK TABLES `saving_accounts` WRITE;
/*!40000 ALTER TABLE `saving_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `saving_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `savings`
--

DROP TABLE IF EXISTS `savings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `savings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` int(32) NOT NULL DEFAULT '0',
  `state` int(1) DEFAULT '0',
  `letter` varchar(256) NOT NULL,
  `association_id` int(10) unsigned NOT NULL,
  `tract_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `association_id` (`association_id`),
  CONSTRAINT `savings_ibfk_1` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `savings`
--

LOCK TABLES `savings` WRITE;
/*!40000 ALTER TABLE `savings` DISABLE KEYS */;
/*!40000 ALTER TABLE `savings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surpluses`
--

DROP TABLE IF EXISTS `surpluses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surpluses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `detail` varchar(2048) NOT NULL,
  `association_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `association_id` (`association_id`),
  CONSTRAINT `surpluses_ibfk_1` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surpluses`
--

LOCK TABLES `surpluses` WRITE;
/*!40000 ALTER TABLE `surpluses` DISABLE KEYS */;
/*!40000 ALTER TABLE `surpluses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracts`
--

DROP TABLE IF EXISTS `tracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` int(10) unsigned NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `deadline` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`,`deadline`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracts`
--

LOCK TABLES `tracts` WRITE;
/*!40000 ALTER TABLE `tracts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `name` varchar(70) NOT NULL,
  `last_name_1` varchar(30) NOT NULL,
  `last_name_2` varchar(30) DEFAULT NULL,
  `association_id` int(10) unsigned NOT NULL,
  `state` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `association_id` (`association_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`association_id`) REFERENCES `associations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'jose','$2y$10$pN0tmFT2erqmzn8IEdNCEO7VMfNHvQkov/B749P1dM2pYIbz0O8/u','admin','Jose','Slon','Baltodano',1,0),(2,'ricardo','$2y$10$MQgIEulTS8TQvwwiArI6IeZ6M1nSGiybXu73IMW50r3RvMKlk0Hm2','rep','Ricardo','Aguilar','Vargas',1,0),(5,'andrey','$2y$10$vr9iJ56rbwPGHKfL.ZoYueEgq3aGETP0izgQQd49mmPnbgFU5ltm2','admin','Andrey','Perez','Perez',1,0),(55,'gabriel','$2y$10$4.cENrfd8cHuZyqhOzhYBurAIaaqpUdstrgzMGB3bENGZA6U9uN/q','rep','Gabriel','Quesada','Monge',1,0),(57,'testUser','$2y$10$JcdjrI254cdjnKXl3aTbZ.ADRxC2I6yohYyo.xm/YC3CG5ndd.RVu','admin','prueba','prueba','prueba',1,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouses`
--

DROP TABLE IF EXISTS `warehouses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` int(32) NOT NULL,
  `date` date NOT NULL,
  `spent` int(32) NOT NULL,
  `deadline` date NOT NULL,
  `association_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouses`
--

LOCK TABLES `warehouses` WRITE;
/*!40000 ALTER TABLE `warehouses` DISABLE KEYS */;
/*!40000 ALTER TABLE `warehouses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-03 23:23:55
