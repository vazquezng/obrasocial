
-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: localhost    Database: obrasocial
-- ------------------------------------------------------
-- Server version	5.7.13

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
-- Table structure for table `benefits`
--

DROP TABLE IF EXISTS `benefits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `benefits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_provider` int(11) NOT NULL,
  `name_of_patient` varchar(100) NOT NULL,
  `type` enum('consultorio','domicilio') DEFAULT NULL,
  `kilometers` int(11) DEFAULT '0',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_provider_idx` (`id_provider`),
  CONSTRAINT `id_provider` FOREIGN KEY (`id_provider`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `benefits`
--

LOCK TABLES `benefits` WRITE;
/*!40000 ALTER TABLE `benefits` DISABLE KEYS */;
INSERT INTO `benefits` VALUES (1,1,'Nicolas Vazquez','consultorio',0,'2016-07-06 10:25:55'),(2,1,'Nicolas Vazquez','consultorio',0,'2016-01-03 10:25:55'),(3,1,'Nicolas Vazquez','consultorio',0,'2016-01-06 23:25:55'),(4,1,'Nicolas Vazquez','consultorio',0,'2016-01-08 10:25:55'),(5,1,'Nicolas Vazquez','consultorio',0,'2016-02-06 10:25:55'),(6,1,'Nicolas Vazquez','domicilio',12,'2016-01-06 10:25:55'),(7,1,'Nicolas Vazquez','domicilio',24,'2016-06-06 10:25:55'),(8,2,'Nicolas Vazquez','consultorio',0,'2016-06-06 10:25:55'),(9,3,'Nicolas Vazquez','consultorio',0,'2016-02-06 10:25:55');
/*!40000 ALTER TABLE `benefits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `providers`
--

DROP TABLE IF EXISTS `providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `providers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `id_specialty` int(11) NOT NULL,
  `basic_benefit` int(11) NOT NULL,
  `amount_per_km` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_idx` (`id_specialty`),
  CONSTRAINT `id` FOREIGN KEY (`id_specialty`) REFERENCES `specialties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `providers`
--

LOCK TABLES `providers` WRITE;
/*!40000 ALTER TABLE `providers` DISABLE KEYS */;
INSERT INTO `providers` VALUES (1,'Nicolas Fernandez','Las Heras 1321',4,200,20),(2,'Mauro Vera','Gaona 50',1,350,25),(3,'Nicolas Vazquez','Las Heras 2000',2,400,50),(4,'Nicolas Fernandez','Las Heras 1321',3,100,30);
/*!40000 ALTER TABLE `providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specialties`
--

DROP TABLE IF EXISTS `specialties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specialties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `basic_amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialties`
--

LOCK TABLES `specialties` WRITE;
/*!40000 ALTER TABLE `specialties` DISABLE KEYS */;
INSERT INTO `specialties` VALUES (1,'RADIOTERAPIA Y TELECOBALTOTERAPIA',2000),(2,'REHABILITACIÓN CARDIOVASCULAR',1500),(3,'RESONANCIA NUCLEAR MAGNÉTICA',1800),(4,'REUMATOLOGÍA',3000),(5,'REUMATOLOGÍA INFANTIL',4040),(6,'TOMOGRAFÍA COMPUTADA',10000),(7,'TOXICOLOGÍA',2000),(8,'TRASTORNOS DE LA CONDUCTA ALIMENTARIA',1350),(9,'TRAUMATOLOGÍA Y ORTOPEDIA',2300),(10,'TRAUMATOLOGÍA Y ORTOPEDIA INFANTIL',1050),(11,'URODINAMIA',2300),(12,'UROGINECOLOGÍA',0),(13,'UROLOGÍA',0),(14,'UROLOGÍA INFANTIL',0);
/*!40000 ALTER TABLE `specialties` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-06 13:49:37
