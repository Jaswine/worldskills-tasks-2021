-- MariaDB dump 10.19  Distrib 10.11.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: AlatechMachines
-- ------------------------------------------------------
-- Server version	10.11.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(96) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES
(1,'Intel'),
(2,'AMD'),
(3,'ASUS'),
(4,'Nvidia'),
(5,'Corsair'),
(6,'Kingston'),
(7,'HyperX'),
(8,'Gigabyte'),
(9,'ASRock'),
(10,'MSi'),
(11,'XPG'),
(12,'Samsung'),
(13,'Western Digital'),
(14,'Seagate'),
(15,'EVGA'),
(16,'Galax'),
(17,'XFX'),
(18,'Sapphire'),
(19,'PowerColor');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `graphicCard`
--

DROP TABLE IF EXISTS `graphicCard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `graphicCard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(96) NOT NULL,
  `imageUrl` varchar(512) NOT NULL,
  `brandId` int(11) NOT NULL,
  `memorySize` int(11) NOT NULL,
  `memoryType` enum('gddr5','gddr6') NOT NULL,
  `minimumPowerSupply` int(11) NOT NULL,
  `supportMultiGpu` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `graphicCard_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `graphicCard`
--

LOCK TABLES `graphicCard` WRITE;
/*!40000 ALTER TABLE `graphicCard` DISABLE KEYS */;
INSERT INTO `graphicCard` VALUES
(1,'GeForce RTX 2070 Super XC Ultra + Overclocked','23',15,8192,'gddr6',650,0),
(2,'GeForce RTX 2080 Super HOF 10th Anniversary Edition Black Teclab','24',16,8192,'gddr6',650,1),
(3,'GeForce RTX 2080 Ti KINGPIN Gaming','25',15,11264,'gddr6',650,1),
(4,'Radeon Red Devil RX5700','25',19,8192,'gddr6',650,0),
(5,'GeForce GTX 1070 Gaming ACX 3.0','41',15,8192,'gddr5',450,1);
/*!40000 ALTER TABLE `graphicCard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `machine`
--

DROP TABLE IF EXISTS `machine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `machine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(96) NOT NULL,
  `description` varchar(512) NOT NULL,
  `imageUrl` varchar(512) NOT NULL,
  `motherboardId` int(11) NOT NULL,
  `processorId` int(11) NOT NULL,
  `ramMemoryId` int(11) NOT NULL,
  `ramMemoryAmount` int(11) NOT NULL,
  `graphicCardId` int(11) NOT NULL,
  `graphicCardAmount` int(11) NOT NULL,
  `powerSupplyId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `motherboardId` (`motherboardId`),
  KEY `processorId` (`processorId`),
  KEY `ramMemoryId` (`ramMemoryId`),
  KEY `graphicCardId` (`graphicCardId`),
  KEY `powerSupplyId` (`powerSupplyId`),
  CONSTRAINT `machine_ibfk_1` FOREIGN KEY (`motherboardId`) REFERENCES `motherboard` (`id`),
  CONSTRAINT `machine_ibfk_2` FOREIGN KEY (`processorId`) REFERENCES `processor` (`id`),
  CONSTRAINT `machine_ibfk_3` FOREIGN KEY (`ramMemoryId`) REFERENCES `ramMemory` (`id`),
  CONSTRAINT `machine_ibfk_4` FOREIGN KEY (`graphicCardId`) REFERENCES `graphicCard` (`id`),
  CONSTRAINT `machine_ibfk_5` FOREIGN KEY (`powerSupplyId`) REFERENCES `powerSupply` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `machine`
--

LOCK TABLES `machine` WRITE;
/*!40000 ALTER TABLE `machine` DISABLE KEYS */;
INSERT INTO `machine` VALUES
(2,'Infinity','The highest and best you could get from a gamer machine.','33',1,1,1,4,5,2,1),
(3,'Shine','Light gives a huge power to .','35',7,2,2,2,1,1,3);
/*!40000 ALTER TABLE `machine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `machineHasStorageDevice`
--

DROP TABLE IF EXISTS `machineHasStorageDevice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `machineHasStorageDevice` (
  `machineId` int(11) NOT NULL,
  `storageDeviceId` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`machineId`,`storageDeviceId`),
  KEY `storageDeviceId` (`storageDeviceId`),
  CONSTRAINT `machineHasStorageDevice_ibfk_1` FOREIGN KEY (`machineId`) REFERENCES `machine` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `machineHasStorageDevice_ibfk_2` FOREIGN KEY (`storageDeviceId`) REFERENCES `storageDevice` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `machineHasStorageDevice`
--

LOCK TABLES `machineHasStorageDevice` WRITE;
/*!40000 ALTER TABLE `machineHasStorageDevice` DISABLE KEYS */;
/*!40000 ALTER TABLE `machineHasStorageDevice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motherboard`
--

DROP TABLE IF EXISTS `motherboard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `motherboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(96) NOT NULL,
  `imageUrl` varchar(512) NOT NULL,
  `brandId` int(11) NOT NULL,
  `socketTypeId` int(11) NOT NULL,
  `ramMemoryTypeId` int(11) NOT NULL,
  `ramMemorySlots` int(11) NOT NULL,
  `maxTdp` int(11) NOT NULL,
  `sataSlots` int(11) NOT NULL,
  `m2Slots` int(11) NOT NULL,
  `pciSlots` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ramMemoryTypeId` (`ramMemoryTypeId`),
  KEY `socketTypeId` (`socketTypeId`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `motherboard_ibfk_1` FOREIGN KEY (`ramMemoryTypeId`) REFERENCES `ramMemoryType` (`id`),
  CONSTRAINT `motherboard_ibfk_2` FOREIGN KEY (`socketTypeId`) REFERENCES `socketType` (`id`),
  CONSTRAINT `motherboard_ibfk_3` FOREIGN KEY (`brandId`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motherboard`
--

LOCK TABLES `motherboard` WRITE;
/*!40000 ALTER TABLE `motherboard` DISABLE KEYS */;
INSERT INTO `motherboard` VALUES
(1,'X299X Aorus Xtreme Waterforce','1',8,3,2,8,156,8,2,3),
(2,'X570 AQUA','2',9,1,2,4,105,8,2,3),
(3,'MEG X570 Godlike','3',10,5,2,4,100,6,3,4),
(4,'X570 Aorus Xtreme','4',8,5,2,4,100,6,3,3),
(5,'Z390 Aorus Xtreme','5',8,2,2,4,100,6,3,3),
(6,'X399 Aorus Xtreme','8',8,4,2,8,250,6,3,4),
(7,'ROG Strix TRX40-E Gaming','10',3,5,2,8,280,8,3,3),
(8,'GA-H170-GAMING 3','38',8,2,1,4,120,8,2,2),
(9,'GA-H170M-D3H','39',8,2,1,4,105,8,1,2);
/*!40000 ALTER TABLE `motherboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `powerSupply`
--

DROP TABLE IF EXISTS `powerSupply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `powerSupply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(96) NOT NULL,
  `imageUrl` varchar(512) NOT NULL,
  `brandId` int(11) NOT NULL,
  `potency` int(11) NOT NULL,
  `badge80Plus` enum('none','white','bronze','silver','gold','platinum','titanium') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `powerSupply_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `powerSupply`
--

LOCK TABLES `powerSupply` WRITE;
/*!40000 ALTER TABLE `powerSupply` DISABLE KEYS */;
INSERT INTO `powerSupply` VALUES
(1,'AX1200i','28',5,1200,'platinum'),
(2,'AX1000','29',5,1000,'titanium'),
(3,'HX750i','30',5,750,'platinum'),
(4,'RMx','31',5,750,'gold'),
(5,'SF Series 450W','32',5,450,'platinum');
/*!40000 ALTER TABLE `powerSupply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `processor`
--

DROP TABLE IF EXISTS `processor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `processor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(96) NOT NULL,
  `imageUrl` varchar(512) NOT NULL,
  `brandId` int(11) NOT NULL,
  `socketTypeId` int(11) NOT NULL,
  `cores` int(11) NOT NULL,
  `baseFrequency` float NOT NULL,
  `maxFrequency` float NOT NULL,
  `cacheMemory` float NOT NULL,
  `tdp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `socketTypeId` (`socketTypeId`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `processor_ibfk_1` FOREIGN KEY (`socketTypeId`) REFERENCES `socketType` (`id`),
  CONSTRAINT `processor_ibfk_2` FOREIGN KEY (`brandId`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processor`
--

LOCK TABLES `processor` WRITE;
/*!40000 ALTER TABLE `processor` DISABLE KEYS */;
INSERT INTO `processor` VALUES
(1,'i9-9980XE Skylake','6',1,3,18,3000,4400,25344,165),
(2,'Ryzen Threadripper 2990WX','7',2,5,32,3000,4200,65536,250),
(3,'Ryzen Threadripper 3960X','9',2,5,24,3800,4500,131072,280);
/*!40000 ALTER TABLE `processor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ramMemory`
--

DROP TABLE IF EXISTS `ramMemory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ramMemory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(96) NOT NULL,
  `imageUrl` varchar(512) NOT NULL,
  `brandId` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `ramMemoryTypeId` int(11) NOT NULL,
  `frequency` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ramMemoryTypeId` (`ramMemoryTypeId`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `ramMemory_ibfk_1` FOREIGN KEY (`ramMemoryTypeId`) REFERENCES `ramMemoryType` (`id`),
  CONSTRAINT `ramMemory_ibfk_2` FOREIGN KEY (`brandId`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ramMemory`
--

LOCK TABLES `ramMemory` WRITE;
/*!40000 ALTER TABLE `ramMemory` DISABLE KEYS */;
INSERT INTO `ramMemory` VALUES
(1,'HyperX Fury 32GB 3000MHz','13',7,32768,2,3000),
(2,'HyperX Fury 32GB 2666MHz','14',7,32768,2,2666),
(3,'HyperX Fury 32GB 2400MHz','15',7,32768,2,2400);
/*!40000 ALTER TABLE `ramMemory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ramMemoryType`
--

DROP TABLE IF EXISTS `ramMemoryType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ramMemoryType` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(96) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ramMemoryType`
--

LOCK TABLES `ramMemoryType` WRITE;
/*!40000 ALTER TABLE `ramMemoryType` DISABLE KEYS */;
INSERT INTO `ramMemoryType` VALUES
(1,'DDR3'),
(2,'DDR4');
/*!40000 ALTER TABLE `ramMemoryType` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socketType`
--

DROP TABLE IF EXISTS `socketType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `socketType` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(96) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socketType`
--

LOCK TABLES `socketType` WRITE;
/*!40000 ALTER TABLE `socketType` DISABLE KEYS */;
INSERT INTO `socketType` VALUES
(1,'AM4'),
(2,'LGA 1151'),
(3,'LGA 2066'),
(4,'TR4'),
(5,'sTRX4');
/*!40000 ALTER TABLE `socketType` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `storageDevice`
--

DROP TABLE IF EXISTS `storageDevice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `storageDevice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(96) NOT NULL,
  `imageUrl` varchar(512) NOT NULL,
  `brandId` int(11) NOT NULL,
  `storageDeviceType` enum('hdd','ssd') NOT NULL,
  `size` int(11) NOT NULL,
  `storageDeviceInterface` enum('sata','m2') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `storageDevice_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `storageDevice`
--

LOCK TABLES `storageDevice` WRITE;
/*!40000 ALTER TABLE `storageDevice` DISABLE KEYS */;
INSERT INTO `storageDevice` VALUES
(1,'XPG Gammix S50','18',11,'ssd',2048,'m2'),
(2,'Corsair Force Series MP600','19',5,'ssd',2048,'m2'),
(3,'Samsung 970 EVO Plus','20',12,'ssd',1024,'m2');
/*!40000 ALTER TABLE `storageDevice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(512) NOT NULL,
  `accessToken` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'vaseles','$2y$10$/OhVhHrSGpvjhOYToz8rmuI5sMDPe7risKqrh2YB.9fiHlbVY3sdC','$2y$10$fdKv0tjXDqIWer5QfVc7muP3vLmA9Vyyw/1LyqhBbYFBwCycjrbLu'),
(2,'joaomartinscoube','$2y$10$Vi/xgOUqiaCv73/FxtyAAeGv/fpfdSU8jHIIzZ.J6HAYhwFfHYn5i',''),
(3,'robertosimonsen','$2y$10$cHa9nLXNf5BpXeW6.HM7yOIwR3aFYpnoDt.zTotzVDnX8yU2eNo82','$2y$10$jTopY6D5jtFUc5AmVJYB5edNFGi2zEwFS/3BUWKt2f5PaICuVBPwa');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-08 10:15:57
