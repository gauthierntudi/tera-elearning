-- MySQL dump 10.13  Distrib 8.1.0, for Linux (aarch64)
--
-- Host: localhost    Database: elearning
-- ------------------------------------------------------
-- Server version	8.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Abonnes`
--

DROP TABLE IF EXISTS `Abonnes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Abonnes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `postnom` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `adresse_physique` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'abonne',
  `status` enum('pending','active','blocked') DEFAULT 'pending',
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Abonnes`
--

LOCK TABLES `Abonnes` WRITE;
/*!40000 ALTER TABLE `Abonnes` DISABLE KEYS */;
INSERT INTO `Abonnes` VALUES (1,'Ntudi','Gauthier','gauthierntudi@gmail.com','0824269291','CitÃ© maman Mobutu, Q/dimese mont ngafula','admin','active','8W66Y','2024-12-22 22:13:30','2024-12-21 01:21:09','2024-12-22 21:58:30'),(2,'Gauthier','Camus','gaellembongo.2018@gmail.com','0824269291','CitÃ© maman Mobutu, Q/dimese mont ngafula','abonne','active','6CW76','2024-12-22 22:11:14','2024-12-22 21:56:14','2024-12-22 21:56:57'),(3,'Albert','Camus','kipaobuildsarlu@gmail.com','0824269291','100,universite Q\\LIVULU , C\\LEMBA','abonne','active','1G88K','2024-12-22 23:20:52','2024-12-22 23:04:24','2024-12-22 23:06:27'),(5,'Abel','Bafuli','vikumekashoba@gmail.com','0824269291','CitÃ© maman Mobutu, Q/dimese mont ngafula','admin','active','45NA5','2024-12-24 13:10:42','2024-12-21 01:21:09','2024-12-24 12:55:42');
/*!40000 ALTER TABLE `Abonnes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Evaluation`
--

DROP TABLE IF EXISTS `Evaluation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Evaluation` (
  `abonneId` int NOT NULL,
  `formationId` int NOT NULL,
  `pourcentage` varchar(30) NOT NULL,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Evaluation`
--

LOCK TABLES `Evaluation` WRITE;
/*!40000 ALTER TABLE `Evaluation` DISABLE KEYS */;
/*!40000 ALTER TABLE `Evaluation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Formations`
--

DROP TABLE IF EXISTS `Formations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Formations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `category` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Formations`
--

LOCK TABLES `Formations` WRITE;
/*!40000 ALTER TABLE `Formations` DISABLE KEYS */;
INSERT INTO `Formations` VALUES (1,'Webinar 1- Series Foundations for Programming','lelelele','Foundations for Programming','2024-12-22 12:10:39','2024-12-22 12:10:39'),(2,'Webinar 2 Series_ Design and Innovation of Improved Cookstoves','eeteyee]ee','Design and Innovation','2024-12-22 17:02:34','2024-12-22 17:02:34'),(3,'Webinar 3 Series_ Artisanal to Industrial Production ','elelelele','Artisanal & Industrial','2024-12-22 17:20:06','2024-12-22 17:20:06'),(4,'Webinar 4_ Combustibles - Ethanol, briquettes _ LPG','eyeyeyywuuwyw','Combustibles - LPG','2024-12-22 17:24:26','2024-12-22 17:24:26'),(5,'Webinar 5- Series on Operations and Improving Business Management','eyejeueue','Operations and Management','2024-12-22 17:29:34','2024-12-22 17:29:34'),(7,'Webinar 6 Partnerships and Distribution','Description Formation','Partnerships & Distribution','2024-12-22 22:21:08','2024-12-22 22:21:08'),(8,'Webinar 7 Marketing and Sales','Description Formation','Marketing & Sales','2024-12-22 22:24:41','2024-12-22 22:24:41'),(9,'Webinar 8 Access to Finance','Description Formation','Finance','2024-12-22 22:25:09','2024-12-22 22:25:09'),(10,'Webinar 9 Testing, M.E and data collection','Description Formation','Testing & data','2024-12-22 22:30:47','2024-12-22 22:30:47');
/*!40000 ALTER TABLE `Formations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Quiz`
--

DROP TABLE IF EXISTS `Quiz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Quiz` (
  `formationId` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `questions` text NOT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Quiz`
--

LOCK TABLES `Quiz` WRITE;
/*!40000 ALTER TABLE `Quiz` DISABLE KEYS */;
/*!40000 ALTER TABLE `Quiz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Videos`
--

DROP TABLE IF EXISTS `Videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Videos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `formation_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `duration` varchar(100) DEFAULT NULL,
  `video_path` varchar(255) NOT NULL,
  `thumbnail_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `formation_id` (`formation_id`),
  CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`formation_id`) REFERENCES `Formations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Videos`
--

LOCK TABLES `Videos` WRITE;
/*!40000 ALTER TABLE `Videos` DISABLE KEYS */;
INSERT INTO `Videos` VALUES (3,1,'JP Presentation Cooking, Heat _ ICS','uekwelwlwlsnc','15:09','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/JP+Presentation+Cooking%2C+Heat+_+ICS.mp4','uploads/thumbnails/TERA_676844ec9236f.png','2024-12-22 16:57:16','2024-12-24 11:53:13'),(4,1,'Webinar 1.2 Commercialization for NGOs','Fournir un cadre pour commercialiser les produits de fourniture\r\nd\'nergie: recommandations pour le soutien et la mise en uvre\r\ndun programme ou affaire produits/service enegetique.','26:20','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/Webinar+1.2+Commercialization+for+NGOs.mp4','uploads/thumbnails/TERA_67684d3509f84.png','2024-12-22 17:32:37','2024-12-24 11:54:04'),(6,2,'Webinar 2, Stove Design French 1 de 4 finale2-1','Principes De Combustion(Charbon De Bois) Temperature','14:19','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/Webinar+2%2C+Stove+Design+French+1+de+4+finale2-1.mp4','uploads/thumbnails/TERA_67684fe97b2e9.png','2024-12-22 17:44:09','2024-12-24 11:56:06'),(7,2,'Webinar 2, Stove Design French 2 de 4 vrai-1','Principes De Combustion(Charbon De Bois) Temperature','19:02','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/Webinar+2%2C+Stove+Design+French+2+de+4+vrai-1.mp4','uploads/thumbnails/TERA_6768511aa78ed.png','2024-12-22 17:49:15','2024-12-24 11:56:48'),(8,2,'Webinar 2, Stove Design French 3 de 4vrai-1','Principes De Combustion(Charbon De Bois) Temperature','19:40','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/Webinar+2%2C+Stove+Design+French+3+de+4vrai-1.mp4','uploads/thumbnails/TERA_67688c328fe89.png','2024-12-22 22:01:22','2024-12-24 11:57:29'),(9,2,'Webinar 2, Stove Design French 4 de 4 vrai-1','Principes De Combustion(Charbon De Bois) Temperature','14:51','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/Webinar+2%2C+Stove+Design+French+4+de+4+vrai-1.mp4','uploads/thumbnails/TERA_67688c6a7c3d2.png','2024-12-22 22:02:18','2024-12-24 11:57:57'),(10,3,'Fabrication des Foyers Webinar 3 Partie 1','Fabrication des Foyers Webinar 3','08:49','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/Fabrication+des+Foyers+Webinar+3+Partie+1.mp4','uploads/thumbnails/TERA_67688d5663dde.png','2024-12-22 22:06:14','2024-12-24 11:59:32'),(11,3,'Fabrication des Foyers Webinar 3 Partie 2','Fabrication des Foyers Webinar 3','08:34','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/Fabrication+des+Foyers+Webinar+3+Partie+2.mp4','uploads/thumbnails/TERA_67688da1d590d.png','2024-12-22 22:07:30','2024-12-24 11:59:56'),(12,3,'Fabrication des Foyers Webinar 3 Partie 3','Fabrication des Foyers Webinar 3','09:10','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/Fabrication+des+Foyers+Webinar+3+Partie+3.mp4','uploads/thumbnails/TERA_67688de384213.png','2024-12-22 22:08:35','2024-12-24 12:00:23'),(13,4,'Webinaire 4 - GPL Pay as You Go, tude de cas sur le GPL et la politique Partie 1','Programme de consommation durable et substitution partielle au bois-nergie\r\n','04:16','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/Webinar+4+PPT+1+-+Edwin+Kwesiga+13032022+video.mp4','uploads/thumbnails/TERA_67688ed63e3ba.png','2024-12-22 22:12:38','2024-12-24 12:02:56'),(14,4,'Webinaire 4 - GPL Pay as You Go, tude de cas sur le GPL et la politique Partie 2','Programme de consommation durable et substitution partielle au bois-nergie\r\n','11:23','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/Webinar+4+PPT+2+-+Edwin+Kwesiga+13032022+Vid%C3%A9o.mp4','uploads/thumbnails/TERA_67688f142c933.png','2024-12-22 22:13:40','2024-12-24 12:03:30'),(15,4,'Webinaire 4 - GPL Pay as You Go, tude de cas sur le GPL et la politique Partie 3','Programme de consommation durable et substitution partielle au bois-nergie\r\n','06:45','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/Webinar+4+PPT+3+-+Edwin+Kwesiga+13032022+Video.mp4','uploads/thumbnails/TERA_67688f476702c.png','2024-12-22 22:14:31','2024-12-24 12:03:54'),(16,4,'Webinaire 4 - GPL Pay as You Go, tude de cas sur le GPL et la politique Partie 1','Programme de consommation durable et substitution partielle au bois-nergie\r\n','05:09','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/Webinar+4+PPT+4+-+Edwin+Kwesiga+13032022+Video.mp4','uploads/thumbnails/TERA_67688f7f6fcc4.png','2024-12-22 22:15:27','2024-12-24 12:04:25'),(17,5,'Webinaire 5: Oprations commerciales et gestion de la chane d\'approvisionnement partie 1','Programme de consommation durable et substitution partielle au bois-nergie','09:44','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/Webinar+5+ppt+1+Manuel+Guinea+Vid%C3%A9o.mp4','uploads/thumbnails/TERA_6768904c951a0.png','2024-12-22 22:18:52','2024-12-24 12:04:59'),(18,5,'Webinaire 5: Oprations commerciales et gestion de la chane d\'approvisionnement Partie 2','Programme de consommation durable et substitution partielle au bois-nergie','11:36','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/Webinar+5+ppt+2+Manuel+Guinea+Vid%C3%A9o.mp4','uploads/thumbnails/TERA_6768909d66e07.png','2024-12-22 22:20:13','2024-12-24 12:05:21'),(19,7,'Webinar 6 Partners _ Distribution-MG ppt 3','Programme de consommation durable et substitution partielle au bois-nergie','10:12','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/Webinar+6+Partners+_+Distribution-MG+ppt+3.mp4','uploads/thumbnails/TERA_6768915aac08d.png','2024-12-22 22:23:23','2024-12-24 12:55:18'),(20,9,'Finance carbone et projets de foyers amliors (1re partie)','Programme de consommation durable et substitution partielle au bois-nergie','14:44','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/TERA+-+carbon+finance+webinar_1.mp4','uploads/thumbnails/TERA_67689254d6153.png','2024-12-22 22:27:33','2024-12-24 12:08:00'),(21,9,'Finance carbone et projets de foyers amliors (2me partie)','Programme de consommation durable et substitution partielle au bois-nergie','13:54','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/TERA+-+carbon+finance+webinar_2.mp4','uploads/thumbnails/TERA_6768929b91aad.png','2024-12-22 22:28:43','2024-12-24 12:08:23'),(22,9,'Finance carbone et projets de foyers amliors (4me partie)','Programme de consommation durable et substitution partielle au bois-nergie','14:16','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/TERA+-+carbon+finance+webinar_4.mp4','uploads/thumbnails/TERA_676892ec3127e.png','2024-12-22 22:30:04','2024-12-24 12:08:53'),(23,10,'Introduction  Kobo Collect: De la thorie  la pratique. 2me partie','Programme de consommation durable et substitution partielle au bois-nergie','13:58','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/2+Baseline_Introduction+%C3%A0+Kobo+Collect.mp4','uploads/thumbnails/TERA_676893d0233c4.png','2024-12-22 22:33:52','2024-12-24 12:54:33'),(24,10,'Diffusion des rsultats de ltude et rponse aux recommandations : 4me partie','Programme de consommation durable et substitution partielle au bois-nergie','11:58','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/4+Baseline_Diffusion+des+r%C3%A9sultats+et+int%C3%A9gration+de+recommandations.mp4','uploads/thumbnails/TERA_67689437814d9.png','2024-12-22 22:35:35','2024-12-24 12:52:54'),(25,10,'Webinar 9 : Tests d\'bullition de leau (TEE) en laboratoire et sur le terrain Partie 3','Tests d\'bullition de leau (TEE) en laboratoire et sur le terrain Partie 3','12:22','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/Tests+d_%C3%A9bullition+de+l%E2%80%99eau+-+Partie+3.mp4','uploads/thumbnails/TERA_6768949dc8c12.png','2024-12-22 22:37:18','2024-12-24 12:53:30'),(26,10,'Webinar 9 : Tests d\'bullition de leau (TEE) en laboratoire et sur le terrainPartie 4','Tests d\'bullition de leau (TEE) en laboratoire et sur le terrainPartie 4','08:20','https://pnud-tera.s3.us-east-1.amazonaws.com/videos/Tests+d_%C3%A9bullition+de+l%E2%80%99eau+-+Partie+4.mp4','uploads/thumbnails/TERA_676894f163dad.png','2024-12-22 22:38:41','2024-12-24 12:53:55');
/*!40000 ALTER TABLE `Videos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-24 13:17:10
