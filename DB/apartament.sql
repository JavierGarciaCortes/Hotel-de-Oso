-- MySQL dump 10.16  Distrib 10.1.38-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: apartament
-- ------------------------------------------------------
-- Server version	10.1.38-MariaDB

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
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(10) unsigned NOT NULL,
  `dniFoto` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `dni` (`dni`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Hotel','del','Oso','info@hoteldeloso.com',4294967295,'0'),(2,'Paula','Ruiz','25465832-5','PaulaRuiz@gmail.com',698745632,'Paula-25465832-5.jpeg'),(3,'Vanessa','Castillo','43451826-7','VanessaCastillo@gmail.com',654879658,'Vanessa-43451826-7.jpeg'),(4,'Maria','Villareal','99999999','MariaVillareal@gmail.com',658456987,'Maria-99999999.jpg'),(5,'Ana','Villavivencio','70025425-8','AnaVillavicencio@gmail.com',632545685,'Ana-70025425-8.jpg'),(6,'Juan','Cortes','65004204V','JuanEspanol@gmail.com',654895785,'Juan-65004204V.jpg'),(7,'Jordi','Hurtado','000000001A','JordiHurtado@gmail.com',600000001,'Jordi-000000001A.jpg'),(8,'Carmen','Moreno','12345678F','CarmenMoreno@gmail.com',612345678,'Carmen-12345678F.jpg'),(9,'Daniel','Marchante','72803494F','DanielMarchante@gmail.com',695175632,'Daniel-72803494F.jpg');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserves`
--

DROP TABLE IF EXISTS `reserves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserves` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) NOT NULL,
  `entrada` date NOT NULL,
  `sortida` date NOT NULL,
  `room` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `fk_reserves_clients` (`id_client`),
  CONSTRAINT `fk_reserves_clients` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserves`
--

LOCK TABLES `reserves` WRITE;
/*!40000 ALTER TABLE `reserves` DISABLE KEYS */;
INSERT INTO `reserves` VALUES (1,2,'2019-07-12','2019-07-14','individual'),(2,5,'2019-08-01','2019-08-11','familiar'),(3,8,'2019-08-01','2019-08-11','doble'),(4,9,'2019-08-11','2019-08-18','doble'),(5,6,'2019-08-18','2019-08-25','doble'),(6,3,'2019-08-11','2019-08-25','familiar'),(7,4,'2019-08-05','2019-08-09','individual'),(8,7,'2019-08-09','2019-07-14','individual');
/*!40000 ALTER TABLE `reserves` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-12 15:49:35
