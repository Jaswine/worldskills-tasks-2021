-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: AlatechMachines
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

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
-- Current Database: `AlatechMachines`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `alatechmachines` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `AlatechMachines`;

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES (1,'Intel'),(2,'AMD'),(3,'ASUS'),(4,'Nvidia'),(5,'Corsair'),(6,'Kingston'),(7,'HyperX'),(8,'Gigabyte'),(9,'ASRock'),(10,'MSi'),(11,'XPG'),(12,'Samsung'),(13,'Western Digital'),(14,'Seagate'),(15,'EVGA'),(16,'Galax'),(17,'XFX'),(18,'Sapphire'),(19,'PowerColor');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `graphiccard`
--

DROP TABLE IF EXISTS `graphiccard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `graphiccard` (
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
  CONSTRAINT `graphiccard_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `graphiccard`
--

LOCK TABLES `graphiccard` WRITE;
/*!40000 ALTER TABLE `graphiccard` DISABLE KEYS */;
INSERT INTO `graphiccard` VALUES (1,'GeForce RTX 2070 Super XC Ultra + Overclocked','23.png',15,8192,'gddr6',650,0),(2,'GeForce RTX 2080 Super HOF 10th Anniversary Edition Black Teclab','24.png',16,8192,'gddr6',650,0),(3,'GeForce RTX 2080 Ti KINGPIN Gaming','25.png',15,11264,'gddr6',650,0),(4,'Radeon Red Devil RX5700','26.png',19,8192,'gddr6',650,0),(5,'Radeon RX 5700 XT Nitro+','27.png',18,8192,'gddr6',600,0),(6,'GeForce GTX 1070 Gaming ACX 3.0','41.png',15,8192,'gddr5',450,0);
/*!40000 ALTER TABLE `graphiccard` ENABLE KEYS */;
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
  CONSTRAINT `machine_ibfk_3` FOREIGN KEY (`ramMemoryId`) REFERENCES `rammemory` (`id`),
  CONSTRAINT `machine_ibfk_4` FOREIGN KEY (`graphicCardId`) REFERENCES `graphiccard` (`id`),
  CONSTRAINT `machine_ibfk_5` FOREIGN KEY (`powerSupplyId`) REFERENCES `powersupply` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `machine`
--

LOCK TABLES `machine` WRITE;
/*!40000 ALTER TABLE `machine` DISABLE KEYS */;
INSERT INTO `machine` VALUES (1,'Infinity','The highest and best you could get from a gamer machine.','33.png',1,1,1,4,5,2,1),(2,'Shine','35.png','Light gives a huge power to someone.',7,2,2,2,1,1,3),(3,'Wave','The sequences and perfection of waves bring this machine all the power electrons carry.','37.png',3,3,1,2,3,1,2),(4,'Cerberus','The unexpected will bring you a lot more than you expected.','34.png',4,2,3,2,4,1,4),(5,'Iceberg','An ice-solid experience for your gaming days.','36.png',7,2,1,4,6,2,2),(6,'Soft','The softer version that knows how to play hard.','40.png',9,6,5,4,6,1,5);
/*!40000 ALTER TABLE `machine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `machinehasstoragedevice`
--

DROP TABLE IF EXISTS `machinehasstoragedevice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `machinehasstoragedevice` (
  `machineId` int(11) NOT NULL,
  `storageDeviceId` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`machineId`,`storageDeviceId`),
  KEY `storageDeviceId` (`storageDeviceId`),
  CONSTRAINT `machinehasstoragedevice_ibfk_1` FOREIGN KEY (`machineId`) REFERENCES `machine` (`id`),
  CONSTRAINT `machinehasstoragedevice_ibfk_2` FOREIGN KEY (`storageDeviceId`) REFERENCES `storagedevice` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `machinehasstoragedevice`
--

LOCK TABLES `machinehasstoragedevice` WRITE;
/*!40000 ALTER TABLE `machinehasstoragedevice` DISABLE KEYS */;
INSERT INTO `machinehasstoragedevice` VALUES (1,1,1),(1,5,1),(2,2,1),(3,3,1),(3,4,1),(4,2,1),(5,2,1),(6,3,1);
/*!40000 ALTER TABLE `machinehasstoragedevice` ENABLE KEYS */;
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
  CONSTRAINT `motherboard_ibfk_1` FOREIGN KEY (`ramMemoryTypeId`) REFERENCES `rammemorytype` (`id`),
  CONSTRAINT `motherboard_ibfk_2` FOREIGN KEY (`socketTypeId`) REFERENCES `sockettype` (`id`),
  CONSTRAINT `motherboard_ibfk_3` FOREIGN KEY (`brandId`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motherboard`
--

LOCK TABLES `motherboard` WRITE;
/*!40000 ALTER TABLE `motherboard` DISABLE KEYS */;
INSERT INTO `motherboard` VALUES (1,'X299X Aorus Xtreme Waterforce','1.png',8,3,2,8,165,8,2,3),(2,'X570 AQUA','2.png',9,1,2,4,105,8,2,3),(3,'MEG X570 Godlike','3.png',10,5,2,4,100,6,3,4),(4,'X570 Aorus Xtreme','4.png',8,5,2,4,100,6,3,3),(5,'Z390 Aorus Xtreme','5.png',8,2,2,4,100,6,3,3),(6,'X399 Aorus Xtreme','8.png',8,4,2,8,250,6,3,4),(7,'ROG Strix TRX40-E Gaming','10.png',3,5,2,8,280,8,3,3),(8,'GA-H170-GAMING 3','38.png',8,2,1,4,120,8,2,2),(9,'GA-H170M-D3H','39.png',8,2,1,4,105,8,1,2);
/*!40000 ALTER TABLE `motherboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `powersupply`
--

DROP TABLE IF EXISTS `powersupply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `powersupply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(96) NOT NULL,
  `imageUrl` varchar(512) NOT NULL,
  `brandId` int(11) NOT NULL,
  `potency` int(11) NOT NULL,
  `badge80Plus` enum('none','white','bronze','silver','gold','platinum','titanium') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `powersupply_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `powersupply`
--

LOCK TABLES `powersupply` WRITE;
/*!40000 ALTER TABLE `powersupply` DISABLE KEYS */;
INSERT INTO `powersupply` VALUES (1,'AX1200i','28.png',5,1200,'platinum'),(2,'AX1000','29.png',5,1000,'titanium'),(3,'HX750i','30.png',5,750,'platinum'),(4,'RMx','31.png',5,750,'gold'),(5,'SF Series 450W','32.png',5,450,'platinum');
/*!40000 ALTER TABLE `powersupply` ENABLE KEYS */;
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
  CONSTRAINT `processor_ibfk_1` FOREIGN KEY (`socketTypeId`) REFERENCES `sockettype` (`id`),
  CONSTRAINT `processor_ibfk_2` FOREIGN KEY (`brandId`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processor`
--

LOCK TABLES `processor` WRITE;
/*!40000 ALTER TABLE `processor` DISABLE KEYS */;
INSERT INTO `processor` VALUES (1,'i9-9980XE Skylake','6.png',1,3,18,3000,4400,25344,165),(2,'Ryzen Threadripper 2990WX','7.png',2,5,32,3000,4200,65536,250),(3,'Ryzen Threadripper 3960X','9.png',2,5,24,3800,4500,131072,280),(4,'i9-7920X Skylake','11.png',1,3,12,2900,4200,16896,140),(5,'i9-10920X Cascade Lake','12.png',1,3,12,3500,4600,19712,165),(6,' i9-9900KS Coffee Lake Refresh','42.png',1,2,8,4000,5000,16384,127);
/*!40000 ALTER TABLE `processor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rammemory`
--

DROP TABLE IF EXISTS `rammemory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rammemory` (
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
  CONSTRAINT `rammemory_ibfk_1` FOREIGN KEY (`ramMemoryTypeId`) REFERENCES `rammemorytype` (`id`),
  CONSTRAINT `rammemory_ibfk_2` FOREIGN KEY (`brandId`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rammemory`
--

LOCK TABLES `rammemory` WRITE;
/*!40000 ALTER TABLE `rammemory` DISABLE KEYS */;
INSERT INTO `rammemory` VALUES (1,'HyperX Fury 32GB 3000MHz','13.png',7,32768,2,3000),(2,'HyperX Fury 32GB 2666MHz','14.png',7,32768,2,2666),(3,'HyperX Fury 32GB 2400MHz','15.png',7,32768,2,2400),(4,'Corsair Vengeance 8GB 1600Mhz','16.png',5,8192,1,1600),(5,'HyperX Fury 8GB 1600MHz','17.png',7,8192,1,1600);
/*!40000 ALTER TABLE `rammemory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rammemorytype`
--

DROP TABLE IF EXISTS `rammemorytype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rammemorytype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(96) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rammemorytype`
--

LOCK TABLES `rammemorytype` WRITE;
/*!40000 ALTER TABLE `rammemorytype` DISABLE KEYS */;
INSERT INTO `rammemorytype` VALUES (1,'DDR3'),(2,'DDR4');
/*!40000 ALTER TABLE `rammemorytype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sockettype`
--

DROP TABLE IF EXISTS `sockettype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sockettype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(96) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sockettype`
--

LOCK TABLES `sockettype` WRITE;
/*!40000 ALTER TABLE `sockettype` DISABLE KEYS */;
INSERT INTO `sockettype` VALUES (1,'AM4'),(2,'LGA 1151'),(3,'LGA 2066'),(4,'TR4'),(5,'sTRX4');
/*!40000 ALTER TABLE `sockettype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `storagedevice`
--

DROP TABLE IF EXISTS `storagedevice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `storagedevice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(96) NOT NULL,
  `imageUrl` varchar(512) NOT NULL,
  `brandId` int(11) NOT NULL,
  `storageDeviceType` enum('hdd','ssd') NOT NULL,
  `size` int(11) NOT NULL,
  `storageDeviceInterface` enum('sata','m2') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `storagedevice_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `storagedevice`
--

LOCK TABLES `storagedevice` WRITE;
/*!40000 ALTER TABLE `storagedevice` DISABLE KEYS */;
INSERT INTO `storagedevice` VALUES (1,'XPG Gammix S50','18.png',11,'ssd',2048,'m2'),(2,'Corsair Force Series MP600','19.png',5,'ssd',2048,'m2'),(3,'Samsung 970 EVO Plus','20.png',12,'ssd',1024,'m2'),(4,'WD Purple Surveillance 3.5\'','21.png',13,'hdd',12288,'sata'),(5,'Seagate BarraCuda Pro','22.png',14,'hdd',10240,'sata');
/*!40000 ALTER TABLE `storagedevice` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'joaomartinscoube','senai_701','bc766d8f6d37c03c4c88531a8c8c2076'),(2,'robertosimonsen','senai_101','15740e007f96a9c8f67b868cd34c2f62'),(3,'franciscomatarazzo','senai_107','cc1ae7810de5d6becc7ddbd7e4d9f0ac');
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

-- Dump completed on 2020-03-07  8:52:15
