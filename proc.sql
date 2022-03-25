-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: localhost    Database: proc
-- ------------------------------------------------------
-- Server version	8.0.27-0ubuntu0.20.04.1

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
-- Table structure for table `ba_negosiasi_pesertas`
--

DROP TABLE IF EXISTS `ba_negosiasi_pesertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ba_negosiasi_pesertas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ba_negosasi_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ba_negosiasi_pesertas`
--

LOCK TABLES `ba_negosiasi_pesertas` WRITE;
/*!40000 ALTER TABLE `ba_negosiasi_pesertas` DISABLE KEYS */;
INSERT INTO `ba_negosiasi_pesertas` VALUES (1,1,2,'2021-10-06 22:25:51','2021-10-06 22:25:51'),(2,1,3,'2021-10-06 22:25:51','2021-10-06 22:25:51'),(3,1,4,'2021-10-06 22:25:51','2021-10-06 22:25:51'),(4,2,2,'2021-10-06 22:29:53','2021-10-06 22:29:53'),(5,2,3,'2021-10-06 22:29:53','2021-10-06 22:29:53'),(6,2,4,'2021-10-06 22:29:53','2021-10-06 22:29:53'),(7,3,2,'2021-10-21 07:24:27','2021-10-21 07:24:27'),(8,3,3,'2021-10-21 07:24:27','2021-10-21 07:24:27'),(9,3,4,'2021-10-21 07:24:27','2021-10-21 07:24:27'),(10,4,2,'2021-10-22 02:02:48','2021-10-22 02:02:48'),(11,4,3,'2021-10-22 02:02:48','2021-10-22 02:02:48'),(12,4,4,'2021-10-22 02:02:48','2021-10-22 02:02:48'),(13,5,2,'2021-10-22 02:23:29','2021-10-22 02:23:29'),(14,5,3,'2021-10-22 02:23:29','2021-10-22 02:23:29'),(15,5,4,'2021-10-22 02:23:29','2021-10-22 02:23:29'),(16,6,2,'2021-11-01 08:22:29','2021-11-01 08:22:29'),(17,6,3,'2021-11-01 08:22:29','2021-11-01 08:22:29'),(18,6,4,'2021-11-01 08:22:29','2021-11-01 08:22:29'),(19,6,5,'2021-11-01 08:22:29','2021-11-01 08:22:29'),(20,7,2,'2021-11-08 06:58:00','2021-11-08 06:58:00'),(21,7,3,'2021-11-08 06:58:00','2021-11-08 06:58:00'),(22,7,4,'2021-11-08 06:58:00','2021-11-08 06:58:00'),(23,8,4,'2021-11-08 07:24:16','2021-11-08 07:24:16'),(24,9,4,'2021-11-08 07:24:52','2021-11-08 07:24:52'),(25,10,2,'2021-11-14 09:39:18','2021-11-14 09:39:18'),(26,10,3,'2021-11-14 09:39:18','2021-11-14 09:39:18'),(27,10,4,'2021-11-14 09:39:18','2021-11-14 09:39:18'),(28,11,2,'2021-11-14 09:40:43','2021-11-14 09:40:43'),(29,11,3,'2021-11-14 09:40:43','2021-11-14 09:40:43'),(30,11,4,'2021-11-14 09:40:43','2021-11-14 09:40:43'),(31,11,5,'2021-11-14 09:40:43','2021-11-14 09:40:43'),(32,12,2,'2021-11-16 08:34:42','2021-11-16 08:34:42'),(33,12,3,'2021-11-16 08:34:42','2021-11-16 08:34:42'),(34,12,4,'2021-11-16 08:34:42','2021-11-16 08:34:42'),(35,12,5,'2021-11-16 08:34:42','2021-11-16 08:34:42'),(36,13,2,'2021-11-16 08:35:20','2021-11-16 08:35:20'),(37,13,3,'2021-11-16 08:35:20','2021-11-16 08:35:20'),(38,13,4,'2021-11-16 08:35:20','2021-11-16 08:35:20'),(39,14,2,'2021-11-18 09:45:14','2021-11-18 09:45:14'),(40,14,3,'2021-11-18 09:45:14','2021-11-18 09:45:14'),(41,14,4,'2021-11-18 09:45:14','2021-11-18 09:45:14'),(42,15,2,'2021-11-18 09:46:56','2021-11-18 09:46:56'),(43,15,3,'2021-11-18 09:46:56','2021-11-18 09:46:56'),(44,15,4,'2021-11-18 09:46:56','2021-11-18 09:46:56'),(45,16,2,'2021-11-19 01:56:08','2021-11-19 01:56:08'),(46,16,3,'2021-11-19 01:56:08','2021-11-19 01:56:08'),(47,16,4,'2021-11-19 01:56:08','2021-11-19 01:56:08'),(48,17,2,'2021-11-19 02:40:50','2021-11-19 02:40:50'),(49,17,3,'2021-11-19 02:40:50','2021-11-19 02:40:50'),(50,17,4,'2021-11-19 02:40:50','2021-11-19 02:40:50'),(51,17,5,'2021-11-19 02:40:50','2021-11-19 02:40:50'),(52,18,2,'2021-11-19 02:43:01','2021-11-19 02:43:01'),(53,18,3,'2021-11-19 02:43:01','2021-11-19 02:43:01'),(54,18,4,'2021-11-19 02:43:01','2021-11-19 02:43:01'),(55,18,5,'2021-11-19 02:43:01','2021-11-19 02:43:01'),(56,19,2,'2021-11-19 04:05:33','2021-11-19 04:05:33'),(57,19,3,'2021-11-19 04:05:33','2021-11-19 04:05:33'),(58,19,4,'2021-11-19 04:05:33','2021-11-19 04:05:33'),(59,19,5,'2021-11-19 04:05:33','2021-11-19 04:05:33'),(60,20,2,'2021-11-19 04:08:14','2021-11-19 04:08:14'),(61,20,3,'2021-11-19 04:08:14','2021-11-19 04:08:14'),(62,20,4,'2021-11-19 04:08:14','2021-11-19 04:08:14'),(63,20,5,'2021-11-19 04:08:14','2021-11-19 04:08:14'),(64,21,2,'2021-11-19 09:01:24','2021-11-19 09:01:24'),(65,21,3,'2021-11-19 09:01:24','2021-11-19 09:01:24'),(66,21,4,'2021-11-19 09:01:24','2021-11-19 09:01:24'),(67,22,2,'2021-11-19 09:03:27','2021-11-19 09:03:27'),(68,22,3,'2021-11-19 09:03:27','2021-11-19 09:03:27'),(69,22,4,'2021-11-19 09:03:27','2021-11-19 09:03:27'),(70,23,2,'2021-12-01 02:24:16','2021-12-01 02:24:16'),(71,23,3,'2021-12-01 02:24:16','2021-12-01 02:24:16'),(72,23,4,'2021-12-01 02:24:16','2021-12-01 02:24:16'),(73,23,5,'2021-12-01 02:24:16','2021-12-01 02:24:16'),(74,24,2,'2021-12-01 02:24:47','2021-12-01 02:24:47'),(75,24,3,'2021-12-01 02:24:47','2021-12-01 02:24:47'),(76,24,4,'2021-12-01 02:24:47','2021-12-01 02:24:47'),(77,24,5,'2021-12-01 02:24:47','2021-12-01 02:24:47'),(78,25,2,'2021-12-06 12:30:29','2021-12-06 12:30:29'),(79,25,3,'2021-12-06 12:30:29','2021-12-06 12:30:29'),(80,25,4,'2021-12-06 12:30:29','2021-12-06 12:30:29'),(81,25,5,'2021-12-06 12:30:29','2021-12-06 12:30:29'),(82,26,2,'2021-12-06 12:31:17','2021-12-06 12:31:17'),(83,26,3,'2021-12-06 12:31:17','2021-12-06 12:31:17'),(84,26,4,'2021-12-06 12:31:17','2021-12-06 12:31:17');
/*!40000 ALTER TABLE `ba_negosiasi_pesertas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ba_negosiasis`
--

DROP TABLE IF EXISTS `ba_negosiasis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ba_negosiasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `spph_id` int NOT NULL,
  `procurement_id` int NOT NULL,
  `date` datetime NOT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_result` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_doc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `negosiasi` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `peserta_eksternal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ba_negosiasis`
--

LOCK TABLES `ba_negosiasis` WRITE;
/*!40000 ALTER TABLE `ba_negosiasis` DISABLE KEYS */;
INSERT INTO `ba_negosiasis` VALUES (1,2,1,'2021-10-07 00:00:00','20:20','Jakarta','Harga CPU ingin dikurangin jadi 3 juta saja','documentaion-44115.png',100000,'2021-10-06 22:25:50','2021-10-06 22:25:50',NULL),(2,1,1,'2021-10-08 00:00:00','20:20','Jakarta','Dinego 100rb','documentaion-50160.png',100000,'2021-10-06 22:29:53','2021-10-06 22:29:53',NULL),(3,17,11,'2021-10-23 00:00:00','15:20','Jakarta','test','documentaion-51211.png',200000,'2021-10-21 07:24:27','2021-10-21 07:24:27','Budi, Megandi, Bambang'),(4,13,10,'2021-10-23 00:00:00','08:10','Jakarta','test','documentaion-53135.png',3000,'2021-10-22 02:02:48','2021-10-22 02:02:48','Test'),(5,19,12,'2021-10-23 00:00:00','08:50','Jakarta','test','documentaion-87259.png',150000,'2021-10-22 02:23:29','2021-10-22 02:23:29','Budi, Megandi, Bambang'),(6,30,16,'2021-11-01 00:00:00','16:21','Jakarta','Dalam masa garansi tersebut pihak Universitas Pertamina berhak untuk mengajukan revisi terkait hasil pekerjaan yang telah diterima oleh pihak Universitas Pertamina','documentaion-89743.jpeg',500000,'2021-11-01 08:22:29','2021-11-01 08:22:29','Adacom'),(7,24,14,'2021-11-08 00:00:00','13:57','Jakarta','Sesuai','documentaion-52430.png',100000,'2021-11-08 06:58:00','2021-11-08 06:58:00','Adacom'),(8,31,19,'2021-11-08 00:00:00','14:23','Jakarta','sesuai','documentaion-81754.png',50000,'2021-11-08 07:24:16','2021-11-08 07:24:16','Adacom'),(9,32,19,'2021-11-08 00:00:00','14:24','Jakarta','sesuai','documentaion-80705.PNG',100000,'2021-11-08 07:24:52','2021-11-08 07:24:52','Adacom'),(10,34,20,'2021-11-14 00:00:00','16:37','Jakarta','Pengiriman barang bisa dilakukan 10 hari kerja','documentaion-34356.png',1500000,'2021-11-14 09:39:18','2021-11-14 09:39:18','Manager Afiliasi'),(11,35,20,'2021-12-08 00:00:00','16:39','Jakarta','Barang akan dikirim 10 hari kerja','documentaion-53012.png',2500000,'2021-11-14 09:40:43','2021-11-14 09:40:43','Manager Adacom'),(12,37,21,'2021-11-16 00:00:00','15:33','Jakarta','Bisa dikirim pada hari kerja','documentaion-42305.png',5500000,'2021-11-16 08:34:42','2021-11-16 08:34:42','Manager Afiliasi'),(13,38,21,'2021-11-16 00:00:00','15:34','Jakarta','Bisa dikirim pada hari kerja','documentaion-27105.png',2500000,'2021-11-16 08:35:20','2021-11-16 08:35:20','Manager Adacom'),(14,43,23,'2021-11-18 00:00:00','16:44','Jakarta','Sesuai','documentaion-59851.png',10000000,'2021-11-18 09:45:14','2021-11-18 09:45:14','Manager Afiliasi'),(15,44,23,'2021-11-18 00:00:00','16:45','Jakarta','Sesuai','documentaion-17914.png',3000000,'2021-11-18 09:46:56','2021-11-18 09:46:56','Manager Adacom'),(16,48,25,'2021-11-19 00:00:00','08:55','teams','sesuai','documentaion-62273.jpeg',10000000,'2021-11-19 01:56:08','2021-11-19 01:56:08','Account Executive Adacom, Manager IT Adacom'),(17,51,27,'2021-11-19 00:00:00','15:00','Jakarta','Sesuai','documentaion-82063.png',1000000,'2021-11-19 02:40:50','2021-11-19 02:40:50','Budi, Putra, Bambang'),(18,52,27,'2021-11-19 00:00:00','15:00','Jakarta','Sesuai','documentaion-73348.png',2000000,'2021-11-19 02:43:01','2021-11-19 02:43:01','Test aja'),(19,55,28,'2021-11-19 00:00:00','11:04','Jakarta','Sesuai','documentaion-42534.PNG',500000,'2021-11-19 04:05:33','2021-11-19 04:05:33','Manager Afiliasi'),(20,56,28,'2021-11-19 00:00:00','11:08','Jakarta','Lama waktu yang dibutuhkan untuk pengerjaan setiap videonya sampai selesai adalah 2 bulan \r\nsetelah materi lengkap diterima oleh pihak vendor.','documentaion-20617.PNG',500000,'2021-11-19 04:08:14','2021-11-19 04:08:14','Manager Adacom'),(21,59,29,'2021-11-19 00:00:00','16:00','Jakarta','Sesuai','documentaion-47355.PNG',5000000,'2021-11-19 09:01:24','2021-11-19 09:01:24','Manager Afiliasi'),(22,60,29,'2021-11-19 00:00:00','16:03','Jakarta','Sesuai','documentaion-20061.PNG',10000000,'2021-11-19 09:03:27','2021-11-19 09:03:27','Manager Afiliasi'),(23,63,30,'2021-12-01 00:00:00','09:23','Jakarta','Sesuai','documentaion-74352.PNG',500000,'2021-12-01 02:24:16','2021-12-01 02:24:16','Manager Afiliasi'),(24,64,30,'2021-12-01 00:00:00','09:24','Jakarta','Sesuai','documentaion-47182.PNG',11500000,'2021-12-01 02:24:47','2021-12-01 02:24:47','Manager Adacom'),(25,67,31,'2021-12-06 00:00:00','19:29','Jakarta','Barang dikirim dalam waktu 7 hari','documentaion-30071.PNG',500000,'2021-12-06 12:30:29','2021-12-06 12:30:29','Manager Afiliasi'),(26,68,31,'2021-12-06 00:00:00','19:30','Jakarta','Sesuai','documentaion-68231.PNG',11500000,'2021-12-06 12:31:17','2021-12-06 12:31:17','Manager Adacom');
/*!40000 ALTER TABLE `ba_negosiasis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bapps`
--

DROP TABLE IF EXISTS `bapps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bapps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `procurement_id` int NOT NULL,
  `date` datetime NOT NULL,
  `no_surat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `memo_related` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `closing` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` longtext COLLATE utf8mb4_unicode_ci,
  `dari` int NOT NULL,
  `kepada` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bapps`
--

LOCK TABLES `bapps` WRITE;
/*!40000 ALTER TABLE `bapps` DISABLE KEYS */;
INSERT INTO `bapps` VALUES (1,1,'2021-10-08 00:00:00','Nomor Surat BAPP 1','test test','test test','2021-10-06 22:30:47','2021-10-06 22:30:47','Jakarta',NULL,0,0),(2,11,'2021-10-22 00:00:00','ASD-Surat-123','Test','test','2021-10-21 07:24:55','2021-10-21 07:24:55','Jakarta',NULL,0,0),(3,12,'2021-10-22 00:00:00','Test nomor surat 321','test memo','test memo','2021-10-22 02:24:29','2021-10-22 02:24:29','Jakarta',NULL,0,0),(4,14,'2021-11-08 00:00:00','08/UP-WR2/BA/V/2021','0244/-/MEMO/KU.00/X/2021','terima kasih','2021-11-08 07:03:16','2021-11-08 07:03:30','Jakarta',NULL,0,0),(5,19,'2021-11-08 00:00:00','08/UP-WR2/BA/V/2021','0094/-/MEMO/BJ.02/X/2021','Demikian Berita Acara ini disampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.','2021-11-08 07:25:41','2021-11-08 07:26:43','Jakarta',NULL,0,0),(6,20,'2021-11-15 00:00:00','09/21/WR.2/BAPP/XI/2021','0347/UP-WRS.2.2/MEMO/BJ.02/X/2021','Penutup','2021-11-14 09:44:48','2021-11-14 09:44:48','Jakarta',NULL,0,0),(7,21,'2021-11-16 00:00:00','0347/PENG/UMK/2021','0347/UP-WRS.2.2/MEMO/BJ.02/X/2021','penutup','2021-11-16 08:36:35','2021-11-16 08:36:35','Jakarta',NULL,0,0),(8,23,'2021-11-18 00:00:00','420/PENGADAAN/2021','0420/UP-WRS.2/MEMO/BJ.02/X/2021','-','2021-11-18 09:48:16','2021-11-18 09:50:39','Jakarta',NULL,0,0),(9,25,'2021-11-19 00:00:00','0249/UP-WRS.2/MEMO/BJ.02/X/2021',NULL,NULL,'2021-11-19 01:57:46','2021-11-19 01:57:46','Jakarta',NULL,4,2),(10,27,'2021-11-19 00:00:00','ABS-2021',NULL,NULL,'2021-11-19 02:45:45','2021-11-19 02:45:45','Jakarta',NULL,4,2),(11,28,'2021-11-19 00:00:00','07/PENGADAAN/202',NULL,NULL,'2021-11-19 04:09:05','2021-11-19 04:09:05','Jakarta',NULL,4,2),(12,29,'2021-11-19 00:00:00','08/PENGADAAN/2021',NULL,NULL,'2021-11-19 09:04:11','2021-11-19 09:04:11','Jakarta',NULL,4,2),(13,30,'2021-12-01 00:00:00','09/21/WR.2/BAPP/XI/2021',NULL,NULL,'2021-12-01 02:25:58','2021-12-01 02:25:58','Jakarta',NULL,4,2),(14,31,'2021-12-06 00:00:00','08/UP-WR2/BA/V/2021',NULL,NULL,'2021-12-06 12:32:21','2021-12-06 12:32:21','Jakarta',NULL,4,2);
/*!40000 ALTER TABLE `bapps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bast`
--

DROP TABLE IF EXISTS `bast`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bast` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `spph_id` int NOT NULL,
  `procurement_id` int NOT NULL,
  `no_surat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `nama_pihak_kedua` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan_pihak_kedua` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bast_file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bast`
--

LOCK TABLES `bast` WRITE;
/*!40000 ALTER TABLE `bast` DISABLE KEYS */;
INSERT INTO `bast` VALUES (1,17,11,'Test nomor surat',4,'Megandi','Manager','BAST-Adacom-17.pdf','2021-10-21 07:30:51','2021-10-21 07:30:51'),(2,19,12,'Test nomor surat 321',4,'Bambang','Manager','BAST-Cikal-19.pdf','2021-10-22 02:26:14','2021-10-22 02:26:14'),(3,32,19,'08/Adacom/BA/V/2021',4,'Adacom','Manager','BAST-Adacom-32.pdf','2021-11-08 07:31:39','2021-11-08 07:31:39'),(4,31,19,'08/Afiliasi/BA/V/2021',4,'Afiliasi','Manager','BAST-Afliasi-31.pdf','2021-11-08 07:32:21','2021-11-08 07:32:21'),(5,35,20,'08/Adacom/BA/V/2021',3,'Adacom','Manager','BAST-Adacom-35.pdf','2021-11-14 09:49:22','2021-11-14 09:49:22'),(6,34,20,'08/Afiliasi/BA/V/2021',5,'Afiliasi','Manager','BAST-Afliasi-34.pdf','2021-11-14 09:49:44','2021-11-14 09:49:44'),(7,38,21,'08/Adacom/BA/V/2021',2,'Adacom','Manager','BAST-Adacom-38.pdf','2021-11-16 08:38:46','2021-11-16 08:38:46'),(8,37,21,'08/Afiliasi/BA/V/2021',2,'Afiliasi','Manager','BAST-Afliasi-37.pdf','2021-11-16 08:39:02','2021-11-16 08:39:02'),(9,48,25,'123',2,'manager adacom','manager adacom','BAST-Adacom-48.pdf','2021-11-19 02:06:08','2021-11-19 02:06:08'),(10,52,27,'ABSABS-2021',4,'Megandi','Manager','BAST-Adacom-52.pdf','2021-11-19 02:50:58','2021-11-19 02:50:58'),(11,55,28,'02/Afiliasi/BA/V/2021',2,'Afiliasi','Manager','BAST-Afliasi-55.pdf','2021-11-19 04:12:20','2021-11-19 04:12:20'),(12,64,30,'08/Adacom/BA/V/2021',2,'Adacom','Manager','BAST-Adacom-64.pdf','2021-12-01 02:27:39','2021-12-01 02:27:39'),(13,63,30,'08/Afiliasi/BA/V/2021',2,'Afiliasi','Manager','BAST-Afliasi-63.pdf','2021-12-01 02:28:03','2021-12-01 02:28:03'),(14,68,31,'08/Adacom/BA/V/2021',2,'Adacom','Manager','BAST-Adacom-68.pdf','2021-12-06 12:34:30','2021-12-06 12:34:30'),(15,67,31,'08/Afiliasi/BA/V/2021',2,'Afiliasi','Manager','BAST-Afliasi-67.pdf','2021-12-06 12:34:43','2021-12-06 12:34:43');
/*!40000 ALTER TABLE `bast` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bast_umk`
--

DROP TABLE IF EXISTS `bast_umk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bast_umk` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `procurement_id` int NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bast_file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bast_umk`
--

LOCK TABLES `bast_umk` WRITE;
/*!40000 ALTER TABLE `bast_umk` DISABLE KEYS */;
INSERT INTO `bast_umk` VALUES (1,2,'BAST','BAST-UMK-36702-2-003-2021-BA Penunjukan Langsung Pengadaan Kontrak Tenaga Kerja Pengamanan UP (Signed 300721) (1).pdf','2021-10-06 22:51:43','2021-10-06 22:51:43'),(2,13,'File BAST','BAST-UMK-12263-13-PO-Cikal-19.pdf','2021-10-22 02:45:33','2021-10-22 02:45:33');
/*!40000 ALTER TABLE `bast_umk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_categories`
--

DROP TABLE IF EXISTS `item_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `item_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_categories`
--

LOCK TABLES `item_categories` WRITE;
/*!40000 ALTER TABLE `item_categories` DISABLE KEYS */;
INSERT INTO `item_categories` VALUES (1,'Barang IT',NULL,NULL,'S-S-SS-SSS'),(2,'Barang Lab',NULL,NULL,'K-K-KK-KKK'),(3,'Alat Tulis','2021-12-20 02:38:49','2021-12-20 02:38:49','K-B-SB-BBB');
/*!40000 ALTER TABLE `item_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `procurement_id` int NOT NULL,
  `user_id` int NOT NULL,
  `logs` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `keterangan_user_id` int DEFAULT NULL,
  `process_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=301 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,1,2,'Membuat pengadaan baru','','2021-10-06 21:40:38','2021-10-06 21:40:38',NULL,NULL),(2,1,2,'Mengajukan pengadaan','','2021-10-06 21:48:25','2021-10-06 21:48:25',NULL,NULL),(3,1,2,'Mengajukan pengadaan','','2021-10-06 21:58:41','2021-10-06 21:58:41',NULL,NULL),(4,1,4,'Melakukan assign ke staff','','2021-10-06 21:59:21','2021-10-06 21:59:21',NULL,NULL),(5,1,3,'Membuat SPPH','','2021-10-06 22:00:21','2021-10-06 22:00:21',NULL,NULL),(6,1,3,'Melakukan pengiriman SPPH','','2021-10-06 22:00:48','2021-10-06 22:00:48',NULL,NULL),(7,1,3,'Menyelesaikan proses SPPH','','2021-10-06 22:23:43','2021-10-06 22:23:43',NULL,NULL),(8,1,3,'Menyelesaikan proses evaluasi tender','','2021-10-06 22:24:46','2021-10-06 22:24:46',NULL,NULL),(9,1,3,'Menyelesaikan proses Ba Negosiasi','','2021-10-06 22:30:08','2021-10-06 22:30:08',NULL,NULL),(10,1,3,'Menyelesaikan proses BAPP','','2021-10-06 22:31:51','2021-10-06 22:31:51',NULL,NULL),(11,2,2,'Membuat pengadaan baru','','2021-10-06 22:45:56','2021-10-06 22:45:56',NULL,NULL),(12,2,2,'Mengajukan pengadaan','','2021-10-06 22:46:07','2021-10-06 22:46:07',NULL,NULL),(13,2,1,'Melakukan assign ke staff','','2021-10-06 22:47:39','2021-10-06 22:47:39',NULL,NULL),(14,2,1,'Membuat SPPH','','2021-10-06 22:47:43','2021-10-06 22:47:43',NULL,NULL),(15,2,3,'Menyelesaikan proses SP3','','2021-10-06 22:51:07','2021-10-06 22:51:07',NULL,NULL),(16,3,2,'Membuat pengadaan baru','','2021-10-06 23:23:46','2021-10-06 23:23:46',NULL,NULL),(17,3,2,'Mengajukan pengadaan','','2021-10-06 23:24:03','2021-10-06 23:24:03',NULL,NULL),(18,3,4,'Melakukan assign ke staff','','2021-10-06 23:24:20','2021-10-06 23:24:20',NULL,NULL),(19,3,4,'Membuat SPPH','','2021-10-06 23:24:24','2021-10-06 23:24:24',NULL,NULL),(20,3,3,'Melakukan pengiriman SPPH','','2021-10-06 23:25:36','2021-10-06 23:25:36',NULL,NULL),(21,3,3,'Menyelesaikan proses SPPH','','2021-10-06 23:25:40','2021-10-06 23:25:40',NULL,NULL),(22,4,2,'Membuat pengadaan baru','','2021-10-06 23:35:12','2021-10-06 23:35:12',NULL,NULL),(23,4,2,'Mengajukan pengadaan','','2021-10-06 23:36:22','2021-10-06 23:36:22',NULL,NULL),(24,4,4,'Melakukan assign ke staff','','2021-10-06 23:36:28','2021-10-06 23:36:28',NULL,NULL),(25,4,4,'Membuat SPPH','','2021-10-06 23:36:32','2021-10-06 23:36:32',NULL,NULL),(26,5,2,'Membuat pengadaan baru','','2021-10-06 23:42:14','2021-10-06 23:42:14',NULL,NULL),(27,6,2,'Membuat pengadaan baru','','2021-10-06 23:43:24','2021-10-06 23:43:24',NULL,NULL),(28,6,2,'Mengajukan pengadaan','','2021-10-06 23:44:51','2021-10-06 23:44:51',NULL,NULL),(29,6,4,'Membuat SPPH','','2021-10-06 23:45:09','2021-10-06 23:45:09',NULL,NULL),(30,4,4,'Melakukan assign ke staff','','2021-10-06 23:49:32','2021-10-06 23:49:32',NULL,NULL),(31,4,4,'Melakukan assign ke staff','','2021-10-06 23:49:35','2021-10-06 23:49:35',NULL,NULL),(32,4,4,'Melakukan assign ke staff','','2021-10-06 23:55:26','2021-10-06 23:55:26',NULL,NULL),(33,4,4,'Melakukan assign ke staff','','2021-10-06 23:55:29','2021-10-06 23:55:29',NULL,NULL),(34,6,4,'Melakukan assign ke staff','','2021-10-06 23:56:13','2021-10-06 23:56:13',NULL,NULL),(35,6,4,'Melakukan assign ke staff','','2021-10-06 23:56:17','2021-10-06 23:56:17',NULL,NULL),(36,6,4,'Melakukan assign ke staff','','2021-10-07 00:01:00','2021-10-07 00:01:00',NULL,NULL),(37,6,4,'Melakukan assign ke staff','','2021-10-07 00:01:03','2021-10-07 00:01:03',NULL,NULL),(38,7,2,'Membuat pengadaan baru','','2021-10-07 00:18:58','2021-10-07 00:18:58',NULL,NULL),(39,7,2,'Mengajukan pengadaan','','2021-10-07 00:19:14','2021-10-07 00:19:14',NULL,NULL),(40,7,4,'Melakukan assign ke staff','','2021-10-07 00:19:22','2021-10-07 00:19:22',NULL,NULL),(41,7,4,'Membuat SPPH','','2021-10-07 00:19:24','2021-10-07 00:19:24',NULL,NULL),(42,7,3,'Melakukan pengiriman SPPH','','2021-10-07 00:19:40','2021-10-07 00:19:40',NULL,NULL),(43,7,3,'Melakukan pengiriman SPPH','','2021-10-07 00:21:16','2021-10-07 00:21:16',NULL,NULL),(44,7,3,'Melakukan pengiriman SPPH','','2021-10-07 00:21:34','2021-10-07 00:21:34',NULL,NULL),(45,7,3,'Menyelesaikan proses SPPH','','2021-10-07 00:32:12','2021-10-07 00:32:12',NULL,NULL),(46,7,3,'Menyelesaikan proses evaluasi tender','','2021-10-07 00:32:16','2021-10-07 00:32:16',NULL,NULL),(47,7,3,'Menyelesaikan proses Ba Negosiasi','','2021-10-07 00:37:30','2021-10-07 00:37:30',NULL,NULL),(48,8,2,'Membuat pengadaan baru','','2021-10-07 12:58:12','2021-10-07 12:58:12',NULL,NULL),(49,8,2,'Mengajukan pengadaan','','2021-10-07 12:58:24','2021-10-07 12:58:24',NULL,NULL),(50,8,1,'Melakukan assign ke staff','','2021-10-07 12:59:06','2021-10-07 12:59:06',NULL,NULL),(51,8,1,'Membuat SPPH','','2021-10-07 12:59:19','2021-10-07 12:59:19',NULL,NULL),(52,8,3,'Melakukan pengiriman SPPH','','2021-10-07 13:00:18','2021-10-07 13:00:18',NULL,NULL),(53,8,3,'Menyelesaikan proses SPPH','','2021-10-07 13:09:05','2021-10-07 13:09:05',NULL,NULL),(54,9,2,'Membuat pengadaan baru','','2021-10-07 13:17:46','2021-10-07 13:17:46',NULL,NULL),(55,9,2,'Mengajukan pengadaan','','2021-10-07 13:18:23','2021-10-07 13:18:23',NULL,NULL),(56,9,4,'Melakukan assign ke staff','','2021-10-07 13:18:30','2021-10-07 13:18:30',NULL,NULL),(57,9,3,'Membuat SPPH','','2021-10-07 13:19:02','2021-10-07 13:19:02',NULL,NULL),(58,9,3,'Melakukan pengiriman SPPH','','2021-10-07 13:19:11','2021-10-07 13:19:11',NULL,NULL),(59,9,3,'Menyelesaikan proses SPPH','','2021-10-07 13:20:07','2021-10-07 13:20:07',NULL,NULL),(60,4,1,'Melakukan pengiriman SPPH','','2021-10-13 02:12:24','2021-10-13 02:12:24',NULL,NULL),(61,4,1,'Melakukan pengiriman SPPH','','2021-10-13 02:13:16','2021-10-13 02:13:16',NULL,NULL),(62,4,1,'Melakukan pengiriman SPPH','','2021-10-13 02:13:24','2021-10-13 02:13:24',NULL,NULL),(63,10,2,'Membuat pengadaan baru','','2021-10-20 12:15:14','2021-10-20 12:15:14',NULL,NULL),(64,10,2,'Mengajukan pengadaan','','2021-10-20 12:15:24','2021-10-20 12:15:24',NULL,NULL),(65,10,4,'Melakukan assign ke staff','','2021-10-20 12:16:11','2021-10-20 12:16:11',NULL,NULL),(66,10,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-10-20 12:16:13','2021-10-20 12:16:13',NULL,NULL),(67,10,3,'Melakukan pengiriman SPPH','','2021-10-20 12:17:22','2021-10-20 12:17:22',NULL,NULL),(68,10,1,'Melakukan pengiriman SPPH','','2021-10-21 07:13:28','2021-10-21 07:13:28',NULL,NULL),(69,11,2,'Membuat pengadaan baru','','2021-10-21 07:15:33','2021-10-21 07:15:33',NULL,NULL),(70,11,2,'Mengajukan pengadaan','','2021-10-21 07:15:49','2021-10-21 07:15:49',NULL,NULL),(71,11,1,'Melakukan assign ke staff','','2021-10-21 07:16:05','2021-10-21 07:16:05',NULL,NULL),(72,11,1,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-10-21 07:16:07','2021-10-21 07:16:07',NULL,NULL),(73,11,1,'Melakukan pengiriman SPPH','','2021-10-21 07:16:28','2021-10-21 07:16:28',NULL,NULL),(74,11,1,'Menyelesaikan proses SPPH','','2021-10-21 07:22:00','2021-10-21 07:22:00',NULL,NULL),(75,11,1,'Menyelesaikan proses evaluasi tender','','2021-10-21 07:22:48','2021-10-21 07:22:48',NULL,NULL),(76,11,1,'Menyelesaikan proses Ba Negosiasi','','2021-10-21 07:24:33','2021-10-21 07:24:33',NULL,NULL),(77,11,1,'Menyelesaikan proses BAPP','','2021-10-21 07:26:05','2021-10-21 07:26:05',NULL,NULL),(78,11,1,'Menyelesaikan proses BAST','','2021-10-21 07:30:59','2021-10-21 07:30:59',NULL,NULL),(79,11,1,'Menyelesaikan proses SP3 & Menyelesaikan proses pengadaan.','','2021-10-21 07:34:58','2021-10-21 07:34:58',NULL,NULL),(80,10,1,'Menyelesaikan proses SPPH','','2021-10-22 02:00:17','2021-10-22 02:00:17',NULL,NULL),(81,10,1,'Menyelesaikan proses evaluasi tender','','2021-10-22 02:01:17','2021-10-22 02:01:17',NULL,NULL),(82,10,1,'Menyelesaikan proses Ba Negosiasi','','2021-10-22 02:03:04','2021-10-22 02:03:04',NULL,NULL),(83,12,2,'Membuat pengadaan baru','','2021-10-22 02:15:43','2021-10-22 02:15:43',NULL,NULL),(84,12,2,'Mengajukan pengadaan','','2021-10-22 02:15:51','2021-10-22 02:15:51',NULL,NULL),(85,12,4,'Melakukan assign ke staff','','2021-10-22 02:16:13','2021-10-22 02:16:13',NULL,NULL),(86,12,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-10-22 02:16:18','2021-10-22 02:16:18',NULL,NULL),(87,12,4,'Melakukan pengiriman SPPH','','2021-10-22 02:16:36','2021-10-22 02:16:36',NULL,NULL),(88,12,4,'Menyelesaikan proses SPPH','','2021-10-22 02:19:23','2021-10-22 02:19:23',NULL,NULL),(89,12,4,'Menyelesaikan proses evaluasi tender','','2021-10-22 02:20:06','2021-10-22 02:20:06',NULL,NULL),(90,12,4,'Menyelesaikan proses Ba Negosiasi','','2021-10-22 02:23:52','2021-10-22 02:23:52',NULL,NULL),(91,12,4,'Menyelesaikan proses BAPP','','2021-10-22 02:25:11','2021-10-22 02:25:11',NULL,NULL),(92,12,4,'Menyelesaikan proses BAST','','2021-10-22 02:26:18','2021-10-22 02:26:18',NULL,NULL),(93,13,2,'Membuat pengadaan baru','','2021-10-22 02:41:46','2021-10-22 02:41:46',NULL,NULL),(94,13,2,'Mengajukan pengadaan','','2021-10-22 02:41:53','2021-10-22 02:41:53',NULL,NULL),(95,13,4,'Melakukan assign ke staff','','2021-10-22 02:43:42','2021-10-22 02:43:42',NULL,NULL),(96,13,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-10-22 02:44:46','2021-10-22 02:44:46',NULL,NULL),(97,13,4,'Menyelesaikan proses SP3','','2021-10-22 02:45:19','2021-10-22 02:45:19',NULL,NULL),(98,13,4,'Menyelesaikan proses Bast.','','2021-10-22 02:47:34','2021-10-22 02:47:34',NULL,NULL),(99,13,4,'Menyelesaikan proses pengadaan.','','2021-10-22 02:50:08','2021-10-22 02:50:08',NULL,NULL),(100,13,4,'Komentar','Halo Halo Halo Halo Halo Halo Halo Halo Halo Halo Halo Halo Halo','2021-10-22 02:50:58','2021-10-22 02:50:58',NULL,NULL),(101,4,1,'Menyelesaikan proses SPPH','','2021-10-28 07:38:38','2021-10-28 07:38:38',NULL,NULL),(102,14,2,'Membuat pengadaan baru','','2021-10-28 07:42:16','2021-10-28 07:42:16',NULL,NULL),(103,14,2,'Mengajukan pengadaan','','2021-10-28 07:42:27','2021-10-28 07:42:27',NULL,NULL),(104,14,4,'Melakukan assign ke staff','','2021-10-28 07:42:58','2021-10-28 07:42:58',NULL,NULL),(105,14,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-10-28 07:43:01','2021-10-28 07:43:01',NULL,NULL),(106,15,2,'Membuat pengadaan baru','','2021-11-01 00:41:31','2021-11-01 00:41:31',NULL,NULL),(107,15,2,'Mengajukan pengadaan','','2021-11-01 00:41:42','2021-11-01 00:41:42',NULL,NULL),(108,15,4,'Melakukan assign ke staff','','2021-11-01 00:42:10','2021-11-01 00:42:10',NULL,NULL),(109,15,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-11-01 00:42:12','2021-11-01 00:42:12',NULL,NULL),(110,15,4,'Melakukan pengiriman SPPH','','2021-11-01 01:23:07','2021-11-01 01:23:07',NULL,NULL),(111,15,4,'Menyelesaikan proses SPPH','','2021-11-01 01:28:44','2021-11-01 01:28:44',NULL,NULL),(112,16,2,'Membuat pengadaan baru','','2021-11-01 08:12:54','2021-11-01 08:12:54',NULL,NULL),(113,16,2,'Mengajukan pengadaan','','2021-11-01 08:13:02','2021-11-01 08:13:02',NULL,NULL),(114,16,4,'Melakukan assign ke staff','','2021-11-01 08:13:22','2021-11-01 08:13:22',NULL,NULL),(115,16,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-11-01 08:13:25','2021-11-01 08:13:25',NULL,NULL),(116,16,4,'Melakukan pengiriman SPPH','','2021-11-01 08:13:42','2021-11-01 08:13:42',NULL,NULL),(117,16,4,'Menyelesaikan proses SPPH','','2021-11-01 08:16:04','2021-11-01 08:16:04',NULL,NULL),(118,16,3,'Menyelesaikan proses evaluasi tender','','2021-11-01 08:17:18','2021-11-01 08:17:18',NULL,NULL),(119,16,3,'Menyelesaikan proses Ba Negosiasi','','2021-11-01 08:22:33','2021-11-01 08:22:33',NULL,NULL),(120,14,1,'Melakukan pengiriman SPPH','','2021-11-04 08:53:17','2021-11-04 08:53:17',NULL,NULL),(121,14,1,'Melakukan pengiriman SPPH','','2021-11-04 08:54:02','2021-11-04 08:54:02',NULL,NULL),(122,14,1,'Melakukan pengiriman SPPH','','2021-11-04 08:54:43','2021-11-04 08:54:43',NULL,NULL),(123,14,1,'Melakukan pengiriman SPPH','','2021-11-04 08:56:02','2021-11-04 08:56:02',NULL,NULL),(124,14,1,'Melakukan pengiriman SPPH','','2021-11-04 09:00:28','2021-11-04 09:00:28',NULL,NULL),(125,14,1,'Melakukan pengiriman SPPH','','2021-11-04 09:02:20','2021-11-04 09:02:20',NULL,NULL),(126,14,4,'Melakukan pengiriman SPPH','','2021-11-04 09:32:27','2021-11-04 09:32:27',NULL,NULL),(127,14,1,'Melakukan pengiriman SPPH','','2021-11-05 01:52:30','2021-11-05 01:52:30',NULL,NULL),(128,17,2,'Membuat pengadaan baru','','2021-11-05 02:00:11','2021-11-05 02:00:11',NULL,NULL),(129,14,1,'Melakukan pengiriman SPPH','','2021-11-05 02:05:47','2021-11-05 02:05:47',NULL,NULL),(130,18,2,'Membuat pengadaan baru','','2021-11-08 06:46:52','2021-11-08 06:46:52',NULL,NULL),(131,18,2,'Mengajukan pengadaan','','2021-11-08 06:47:26','2021-11-08 06:47:26',NULL,NULL),(132,14,4,'Melakukan pengiriman SPPH','','2021-11-08 06:48:04','2021-11-08 06:48:04',NULL,NULL),(133,14,4,'Menyelesaikan proses SPPH','','2021-11-08 06:53:38','2021-11-08 06:53:38',NULL,NULL),(134,14,4,'Menyelesaikan proses evaluasi tender','','2021-11-08 06:55:20','2021-11-08 06:55:20',NULL,NULL),(135,14,4,'Menyelesaikan proses Ba Negosiasi','','2021-11-08 06:58:04','2021-11-08 06:58:04',NULL,NULL),(136,14,4,'Menyelesaikan proses BAPP','','2021-11-08 07:03:33','2021-11-08 07:03:33',NULL,NULL),(137,19,2,'Membuat pengadaan baru','','2021-11-08 07:08:15','2021-11-08 07:08:15',NULL,NULL),(138,19,2,'Mengajukan pengadaan','','2021-11-08 07:08:30','2021-11-08 07:08:30',NULL,NULL),(139,19,4,'Melakukan assign ke staff','','2021-11-08 07:08:52','2021-11-08 07:08:52',NULL,NULL),(140,19,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-11-08 07:08:56','2021-11-08 07:08:56',NULL,NULL),(141,19,4,'Melakukan pengiriman SPPH','','2021-11-08 07:09:04','2021-11-08 07:09:04',NULL,NULL),(142,19,4,'Menyelesaikan proses SPPH','','2021-11-08 07:17:17','2021-11-08 07:17:17',NULL,NULL),(143,19,3,'Menyelesaikan proses evaluasi tender','','2021-11-08 07:21:38','2021-11-08 07:21:38',NULL,NULL),(144,19,3,'Menyelesaikan proses Ba Negosiasi','','2021-11-08 07:25:05','2021-11-08 07:25:05',NULL,NULL),(145,19,3,'Menyelesaikan proses BAPP','','2021-11-08 07:29:05','2021-11-08 07:29:05',NULL,NULL),(146,19,3,'Menyelesaikan proses BAST','','2021-11-08 07:32:25','2021-11-08 07:32:25',NULL,NULL),(147,19,3,'Menyelesaikan proses SP3 & Menyelesaikan proses pengadaan.','','2021-11-08 07:33:18','2021-11-08 07:33:18',NULL,NULL),(148,20,2,'Membuat pengadaan baru','','2021-11-14 09:29:45','2021-11-14 09:29:45',NULL,'Pengajuan'),(149,20,2,'Mengajukan pengadaan','','2021-11-14 09:30:09','2021-11-14 09:30:09',NULL,'Pengajuan'),(150,20,4,'Melakukan assign ke staff','','2021-11-14 09:30:52','2021-11-14 09:30:52',NULL,'Pengajuan'),(151,20,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-11-14 09:31:05','2021-11-14 09:31:05',NULL,'Start SPPH'),(152,20,4,'Melakukan pengiriman SPPH','','2021-11-14 09:31:20','2021-11-14 09:31:20',NULL,'Pengajuan SPPH'),(153,20,4,'Menyelesaikan proses SPPH','','2021-11-14 09:34:46','2021-11-14 09:34:46',NULL,'Finish SPPH'),(154,20,2,'Menyelesaikan proses evaluasi tender','','2021-11-14 09:36:42','2021-11-14 09:36:42',NULL,'Evaluasi Tender'),(155,20,3,'Menyelesaikan proses Ba Negosiasi','','2021-11-14 09:40:50','2021-11-14 09:40:50',NULL,'BA Negosiasi dan Klarifikasi'),(156,20,3,'Menyelesaikan proses BAPP','','2021-11-14 09:47:41','2021-11-14 09:47:41',NULL,'BAPP'),(157,20,3,'Menyelesaikan proses PO','','2021-11-14 09:48:48','2021-11-14 09:48:48',NULL,'PO'),(158,20,3,'Menyelesaikan proses BAST','','2021-11-14 09:50:04','2021-11-14 09:50:04',NULL,'BAST'),(159,20,3,'Menyelesaikan proses Penilaian Vendor','','2021-11-14 09:51:34','2021-11-14 09:51:34',NULL,'Penilaian Vendor'),(160,20,3,'Menyelesaikan proses SP3 & Menyelesaikan proses pengadaan.','','2021-11-14 09:52:06','2021-11-14 09:52:06',NULL,'Input SP3'),(161,21,2,'Membuat pengadaan baru','','2021-11-01 08:21:38','2021-11-16 08:21:38',NULL,'Pengajuan'),(162,21,2,'Mengajukan pengadaan','','2021-11-01 08:21:50','2021-11-16 08:21:50',NULL,'Pengajuan'),(163,21,4,'Melakukan assign ke staff','','2021-11-01 08:22:29','2021-11-16 08:22:29',NULL,'Pengajuan'),(164,21,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-11-02 08:22:34','2021-11-16 08:22:34',NULL,'Start SPPH'),(165,21,4,'Melakukan pengiriman SPPH','','2021-11-02 08:22:46','2021-11-16 08:22:46',NULL,'Pengajuan SPPH'),(166,21,4,'Menyelesaikan proses SPPH','','2021-11-04 08:28:48','2021-11-16 08:28:48',NULL,'Finish SPPH'),(167,21,2,'Menyelesaikan proses evaluasi tender','','2021-11-06 08:32:44','2021-11-16 08:32:44',NULL,'Evaluasi Tender'),(168,21,3,'Menyelesaikan proses Ba Negosiasi','','2021-11-10 08:35:25','2021-11-16 08:35:25',NULL,'BA Negosiasi dan Klarifikasi'),(169,21,3,'Menyelesaikan proses BAPP','','2021-11-12 08:37:14','2021-11-16 08:37:14',NULL,'BAPP'),(170,21,3,'Menyelesaikan proses PO','','2021-11-14 08:38:18','2021-11-16 08:38:18',NULL,'PO'),(171,21,3,'Menyelesaikan proses BAST','','2021-11-16 08:39:05','2021-11-16 08:39:05',NULL,'BAST'),(172,21,3,'Menyelesaikan proses Penilaian Vendor','','2021-11-16 08:41:41','2021-11-16 08:41:41',NULL,'Penilaian Vendor'),(173,21,3,'Menyelesaikan proses SP3 & Menyelesaikan proses pengadaan.','','2021-11-16 08:44:56','2021-11-16 08:44:56',NULL,'Input SP3'),(174,22,2,'Membuat pengadaan baru','','2021-11-18 02:17:53','2021-11-18 02:17:53',NULL,'Pengajuan'),(175,22,2,'Mengajukan pengadaan','','2021-11-18 02:18:14','2021-11-18 02:18:14',NULL,'Pengajuan'),(176,22,4,'Melakukan assign ke staff','','2021-11-18 02:19:16','2021-11-18 02:19:16',NULL,'Pengajuan'),(177,22,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-11-18 02:19:18','2021-11-18 02:19:18',NULL,'Start SPPH'),(178,23,2,'Membuat pengadaan baru','','2021-11-18 09:15:37','2021-11-18 09:15:37',NULL,'Pengajuan'),(179,23,2,'Mengajukan pengadaan','','2021-11-18 09:16:38','2021-11-18 09:16:38',NULL,'Pengajuan'),(180,23,4,'Melakukan assign ke staff','','2021-11-18 09:20:22','2021-11-18 09:20:22',NULL,'Pengajuan'),(181,23,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-11-18 09:20:59','2021-11-18 09:20:59',NULL,'Start SPPH'),(182,23,4,'Melakukan pengiriman SPPH','','2021-11-18 09:21:39','2021-11-18 09:21:39',NULL,'Pengajuan SPPH'),(183,23,4,'Melakukan pengiriman SPPH','','2021-11-18 09:23:14','2021-11-18 09:23:14',NULL,'Pengajuan SPPH'),(184,23,4,'Menyelesaikan proses SPPH','','2021-11-18 09:39:35','2021-11-18 09:39:35',NULL,'Finish SPPH'),(185,23,2,'Menyelesaikan proses evaluasi tender','','2021-11-18 09:43:01','2021-11-18 09:43:01',NULL,'Evaluasi Tender'),(186,23,3,'Menyelesaikan proses Ba Negosiasi','','2021-11-18 09:47:07','2021-11-18 09:47:07',NULL,'BA Negosiasi dan Klarifikasi'),(187,23,3,'Menyelesaikan proses BAPP','','2021-11-18 09:50:48','2021-11-18 09:50:48',NULL,'BAPP'),(188,22,3,'Melakukan pengiriman SPPH','','2021-11-19 00:44:32','2021-11-19 00:44:32',NULL,'Pengajuan SPPH'),(189,24,2,'Membuat pengadaan baru','','2021-11-19 01:21:54','2021-11-19 01:21:54',NULL,'Pengajuan'),(190,24,2,'Mengajukan pengadaan','','2021-11-19 01:22:25','2021-11-19 01:22:25',NULL,'Pengajuan'),(191,17,2,'Mengajukan pengadaan','','2021-11-19 01:23:39','2021-11-19 01:23:39',NULL,'Pengajuan'),(192,24,4,'Melakukan assign ke staff','','2021-11-19 01:24:13','2021-11-19 01:24:13',NULL,'Pengajuan'),(193,24,4,'Melakukan assign ke staff','','2021-11-19 01:24:16','2021-11-19 01:24:16',NULL,'Pengajuan'),(194,25,2,'Membuat pengadaan baru','','2021-11-19 01:30:03','2021-11-19 01:30:03',NULL,'Pengajuan'),(195,25,2,'Mengajukan pengadaan','','2021-11-19 01:30:10','2021-11-19 01:30:10',NULL,'Pengajuan'),(196,25,4,'Melakukan assign ke staff','','2021-11-19 01:31:07','2021-11-19 01:31:07',NULL,'Pengajuan'),(197,25,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-11-19 01:32:22','2021-11-19 01:32:22',NULL,'Start SPPH'),(198,25,3,'Melakukan pengiriman SPPH','','2021-11-19 01:33:38','2021-11-19 01:33:38',NULL,'Pengajuan SPPH'),(199,25,3,'Menyelesaikan proses SPPH','','2021-11-19 01:37:21','2021-11-19 01:37:21',NULL,'Finish SPPH'),(200,25,2,'Menyelesaikan proses evaluasi tender','','2021-11-19 01:42:16','2021-11-19 01:42:16',NULL,'Evaluasi Tender'),(201,25,3,'Menyelesaikan proses Ba Negosiasi','','2021-11-19 01:56:37','2021-11-19 01:56:37',NULL,'BA Negosiasi dan Klarifikasi'),(202,25,3,'Menyelesaikan proses BAPP','','2021-11-19 01:58:13','2021-11-19 01:58:13',NULL,'BAPP'),(203,25,3,'Menyelesaikan proses PO','','2021-11-19 02:05:24','2021-11-19 02:05:24',NULL,'PO'),(204,23,4,'Menyelesaikan proses PO','','2021-11-19 02:05:43','2021-11-19 02:05:43',NULL,'PO'),(205,25,3,'Menyelesaikan proses BAST','','2021-11-19 02:06:11','2021-11-19 02:06:11',NULL,'BAST'),(206,26,2,'Membuat pengadaan baru','','2021-11-19 02:14:59','2021-11-19 02:14:59',NULL,'Pengajuan'),(207,26,2,'Mengajukan pengadaan','','2021-11-19 02:15:30','2021-11-19 02:15:30',NULL,'Pengajuan'),(208,26,4,'Melakukan assign ke staff','','2021-11-19 02:16:28','2021-11-19 02:16:28',NULL,'Pengajuan'),(209,26,4,'Melakukan perubahan tipe mekanisme pengadaan','','2021-11-19 02:16:35','2021-11-19 02:16:35',NULL,'Pengajuan'),(210,27,2,'Membuat pengadaan baru','','2021-11-19 02:20:30','2021-11-19 02:20:30',NULL,'Pengajuan'),(211,27,2,'Mengajukan pengadaan','','2021-11-19 02:20:35','2021-11-19 02:20:35',NULL,'Pengajuan'),(212,27,4,'Melakukan assign ke staff','','2021-11-19 02:20:53','2021-11-19 02:20:53',NULL,'Pengajuan'),(213,27,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-11-19 02:20:58','2021-11-19 02:20:58',NULL,'Start SPPH'),(214,27,4,'Melakukan pengiriman SPPH','','2021-11-19 02:21:39','2021-11-19 02:21:39',NULL,'Pengajuan SPPH'),(215,27,4,'Menyelesaikan proses SPPH','','2021-11-19 02:26:34','2021-11-19 02:26:34',NULL,'Finish SPPH'),(216,27,1,'Menyelesaikan proses evaluasi tender','','2021-11-19 02:36:56','2021-11-19 02:36:56',NULL,'Evaluasi Tender'),(217,27,3,'Menyelesaikan proses Ba Negosiasi','','2021-11-19 02:43:20','2021-11-19 02:43:20',NULL,'BA Negosiasi dan Klarifikasi'),(218,27,3,'Menyelesaikan proses BAPP','','2021-11-19 02:46:28','2021-11-19 02:46:28',NULL,'BAPP'),(219,27,3,'Menyelesaikan proses PO','','2021-11-19 02:49:57','2021-11-19 02:49:57',NULL,'PO'),(220,27,3,'Menyelesaikan proses BAST','','2021-11-19 02:51:27','2021-11-19 02:51:27',NULL,'BAST'),(221,27,3,'Menyelesaikan proses Penilaian Vendor','','2021-11-19 02:55:12','2021-11-19 02:55:12',NULL,'Penilaian Vendor'),(222,27,3,'Menyelesaikan proses SP3 & Menyelesaikan proses pengadaan.','','2021-11-19 02:55:52','2021-11-19 02:55:52',NULL,'Input SP3'),(223,28,2,'Membuat pengadaan baru','','2021-11-19 03:58:29','2021-11-19 03:58:29',NULL,'Pengajuan'),(224,28,2,'Mengajukan pengadaan','','2021-11-19 03:58:41','2021-11-19 03:58:41',NULL,'Pengajuan'),(225,28,4,'Melakukan assign ke staff','','2021-11-19 03:59:10','2021-11-19 03:59:10',NULL,'Pengajuan'),(226,28,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-11-19 03:59:24','2021-11-19 03:59:24',NULL,'Start SPPH'),(227,28,4,'Melakukan pengiriman SPPH','','2021-11-19 03:59:36','2021-11-19 03:59:36',NULL,'Pengajuan SPPH'),(228,28,4,'Menyelesaikan proses SPPH','','2021-11-19 04:02:34','2021-11-19 04:02:34',NULL,'Finish SPPH'),(229,28,2,'Menyelesaikan proses evaluasi tender','','2021-11-19 04:03:59','2021-11-19 04:03:59',NULL,'Evaluasi Tender'),(230,28,3,'Menyelesaikan proses Ba Negosiasi','','2021-11-19 04:08:28','2021-11-19 04:08:28',NULL,'BA Negosiasi dan Klarifikasi'),(231,28,3,'Menyelesaikan proses BAPP','','2021-11-19 04:09:31','2021-11-19 04:09:31',NULL,'BAPP'),(232,28,3,'Menyelesaikan proses PO','','2021-11-19 04:11:45','2021-11-19 04:11:45',NULL,'PO'),(233,28,3,'Menyelesaikan proses BAST','','2021-11-19 04:12:23','2021-11-19 04:12:23',NULL,'BAST'),(234,28,3,'Menyelesaikan proses Penilaian Vendor','','2021-11-19 04:12:47','2021-11-19 04:12:47',NULL,'Penilaian Vendor'),(235,28,3,'Menyelesaikan proses SP3 & Menyelesaikan proses pengadaan.','','2021-11-19 04:14:06','2021-11-19 04:14:06',NULL,'Input SP3'),(236,25,3,'Melakukan perubahan tipe mekanisme pengadaan','','2021-11-19 05:42:15','2021-11-19 05:42:15',NULL,'Pengajuan'),(237,6,3,'Melakukan perubahan tipe mekanisme pengadaan','','2021-11-19 05:42:57','2021-11-19 05:42:57',NULL,'Pengajuan'),(238,29,2,'Membuat pengadaan baru','','2021-11-19 08:34:05','2021-11-19 08:34:05',NULL,'Pengajuan'),(239,29,2,'Mengajukan pengadaan','','2021-11-19 08:34:22','2021-11-19 08:34:22',NULL,'Pengajuan'),(240,29,4,'Melakukan assign ke staff','','2021-11-19 08:37:12','2021-11-19 08:37:12',NULL,'Pengajuan'),(241,29,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-11-19 08:37:17','2021-11-19 08:37:17',NULL,'Start SPPH'),(242,29,4,'Melakukan pengiriman SPPH','','2021-11-19 08:40:35','2021-11-19 08:40:35',NULL,'Pengajuan SPPH'),(243,29,3,'Menyelesaikan proses SPPH','','2021-11-19 08:49:08','2021-11-19 08:49:08',NULL,'Finish SPPH'),(244,29,3,'Menyelesaikan proses evaluasi tender','','2021-11-19 08:59:20','2021-11-19 08:59:20',NULL,'Evaluasi Tender'),(245,29,3,'Menyelesaikan proses Ba Negosiasi','','2021-11-19 09:03:34','2021-11-19 09:03:34',NULL,'BA Negosiasi dan Klarifikasi'),(246,29,3,'Menyelesaikan proses BAPP','','2021-11-19 09:08:25','2021-11-19 09:08:25',NULL,'BAPP'),(247,29,3,'Menyelesaikan proses PO','','2021-11-19 09:10:03','2021-11-19 09:10:03',NULL,'PO'),(248,30,2,'Membuat pengadaan baru','','2021-12-01 02:16:15','2021-12-01 02:16:15',NULL,'Pengajuan'),(249,30,2,'Mengajukan pengadaan','','2021-12-01 02:16:27','2021-12-01 02:16:27',NULL,'Pengajuan'),(250,30,4,'Melakukan assign ke staff','','2021-12-01 02:16:57','2021-12-01 02:16:57',NULL,'Pengajuan'),(251,30,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-12-01 02:17:01','2021-12-01 02:17:01',NULL,'Start SPPH'),(252,30,4,'Melakukan pengiriman SPPH','','2021-12-01 02:17:14','2021-12-01 02:17:14',NULL,'Pengajuan SPPH'),(253,30,4,'Menyelesaikan proses SPPH','','2021-12-01 02:20:33','2021-12-01 02:20:33',NULL,'Finish SPPH'),(254,30,2,'Menyelesaikan proses evaluasi tender','','2021-12-01 02:22:45','2021-12-01 02:22:45',NULL,'Evaluasi Tender'),(255,30,3,'Menyelesaikan proses Ba Negosiasi','','2021-12-01 02:25:25','2021-12-01 02:25:25',NULL,'BA Negosiasi dan Klarifikasi'),(256,30,3,'Menyelesaikan proses BAPP','','2021-12-01 02:26:19','2021-12-01 02:26:19',NULL,'BAPP'),(257,30,3,'Menyelesaikan proses PO','','2021-12-01 02:27:17','2021-12-01 02:27:17',NULL,'PO'),(258,30,3,'Menyelesaikan proses BAST','','2021-12-01 02:28:07','2021-12-01 02:28:07',NULL,'BAST'),(259,30,3,'Menyelesaikan proses Penilaian Vendor','','2021-12-01 02:30:00','2021-12-01 02:30:00',NULL,'Penilaian Vendor'),(260,30,3,'Menyelesaikan proses SP3 & Menyelesaikan proses pengadaan.','','2021-12-01 02:30:38','2021-12-01 02:30:38',NULL,'Input SP3'),(261,22,3,'Melakukan pengiriman SPPH','','2021-12-02 05:17:37','2021-12-02 05:17:37',NULL,'Pengajuan SPPH'),(262,31,2,'Membuat pengadaan baru','','2021-12-06 12:22:54','2021-12-06 12:22:54',NULL,'Pengajuan'),(263,31,2,'Mengajukan pengadaan','','2021-12-06 12:23:04','2021-12-06 12:23:04',NULL,'Pengajuan'),(264,31,4,'Melakukan assign ke staff','','2021-12-06 12:23:25','2021-12-06 12:23:25',NULL,'Pengajuan'),(265,31,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-12-06 12:23:28','2021-12-06 12:23:28',NULL,'Start SPPH'),(266,31,4,'Melakukan pengiriman SPPH','','2021-12-06 12:23:43','2021-12-06 12:23:43',NULL,'Pengajuan SPPH'),(267,31,4,'Menyelesaikan proses SPPH','','2021-12-06 12:26:57','2021-12-06 12:26:57',NULL,'Finish SPPH'),(268,31,3,'Menyelesaikan proses evaluasi tender','','2021-12-06 12:29:06','2021-12-06 12:29:06',NULL,'Evaluasi Tender'),(269,31,3,'Menyelesaikan proses Ba Negosiasi','','2021-12-06 12:31:58','2021-12-06 12:31:58',NULL,'BA Negosiasi dan Klarifikasi'),(270,31,3,'Menyelesaikan proses BAPP','','2021-12-06 12:32:53','2021-12-06 12:32:53',NULL,'BAPP'),(271,31,3,'Menyelesaikan proses PO','','2021-12-06 12:34:13','2021-12-06 12:34:13',NULL,'PO'),(272,31,3,'Menyelesaikan proses BAST','','2021-12-06 12:35:05','2021-12-06 12:35:05',NULL,'BAST'),(273,31,3,'Menyelesaikan proses Penilaian Vendor','','2021-12-06 12:46:54','2021-12-06 12:46:54',NULL,'Penilaian Vendor'),(274,31,3,'Menyelesaikan proses SP3 & Menyelesaikan proses pengadaan.','','2021-12-06 12:47:39','2021-12-06 12:47:39',NULL,'Input SP3'),(275,31,1,'Komentar',NULL,'2021-12-07 02:43:57','2021-12-07 02:43:57',NULL,'Komentar'),(276,32,2,'Membuat pengadaan baru','','2021-12-19 23:58:44','2021-12-19 23:58:44',NULL,'Pengajuan'),(277,33,2,'Membuat pengadaan baru','','2021-12-21 08:16:35','2021-12-21 08:16:35',NULL,'Pengajuan'),(278,33,2,'Mengajukan pengadaan','','2021-12-21 09:49:34','2021-12-21 09:49:34',NULL,'Pengajuan'),(279,33,4,'Melakukan perubahan data detail Procurement','','2021-12-21 10:02:13','2021-12-21 10:02:13',NULL,'Pengajuan'),(280,33,4,'Melakukan perubahan data detail Procurement','','2021-12-21 10:15:06','2021-12-21 10:15:06',NULL,'Pengajuan'),(281,33,4,'Melakukan perubahan data detail Procurement','','2021-12-21 10:16:53','2021-12-21 10:16:53',NULL,'Pengajuan'),(282,33,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-12-21 10:20:48','2021-12-21 10:20:48',NULL,'Start SPPH'),(283,24,4,'Melakukan perubahan data detail Procurement','','2021-12-22 11:05:50','2021-12-22 11:05:50',NULL,'Pengajuan'),(284,34,2,'Membuat pengadaan baru','','2021-12-22 13:52:43','2021-12-22 13:52:43',NULL,'Pengajuan'),(285,34,2,'Mengajukan pengadaan','','2021-12-22 13:53:03','2021-12-22 13:53:03',NULL,'Pengajuan'),(286,34,4,'Melakukan perubahan data detail Procurement','','2021-12-22 14:13:55','2021-12-22 14:13:55',NULL,'Pengajuan'),(287,34,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-12-23 01:14:56','2021-12-23 01:14:56',NULL,'Start SPPH'),(288,35,2,'Membuat pengadaan baru','','2021-12-23 13:16:03','2021-12-23 13:16:03',NULL,'Pengajuan'),(289,35,2,'Mengajukan pengadaan','','2021-12-23 13:25:19','2021-12-23 13:25:19',NULL,'Pengajuan'),(290,35,4,'Melakukan perubahan data detail Procurement','','2021-12-23 13:27:15','2021-12-23 13:27:15',NULL,'Pengajuan'),(291,35,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-12-23 13:27:23','2021-12-23 13:27:23',NULL,'Start SPPH'),(292,36,2,'Membuat pengadaan baru','','2021-12-23 15:36:24','2021-12-23 15:36:24',NULL,'Pengajuan'),(293,36,2,'Mengajukan pengadaan','','2021-12-23 15:37:22','2021-12-23 15:37:22',NULL,'Pengajuan'),(294,37,2,'Membuat pengadaan baru','','2021-12-30 00:44:57','2021-12-30 00:44:57',NULL,'Pengajuan'),(295,37,2,'Mengajukan pengadaan','','2021-12-30 00:49:56','2021-12-30 00:49:56',NULL,'Pengajuan'),(296,37,4,'Melakukan perubahan data detail Procurement','','2021-12-30 00:50:52','2021-12-30 00:50:52',NULL,'Pengajuan'),(297,37,4,'Menerima pengajuan dari User dan mulai memproses pengadaan.','','2021-12-30 01:09:11','2021-12-30 01:09:11',NULL,'Start SPPH'),(298,33,1,'Melakukan pengiriman SPPH','','2021-12-30 08:51:59','2021-12-30 08:51:59',NULL,'Pengajuan SPPH'),(299,33,1,'Melakukan pengiriman SPPH','','2022-01-04 04:11:29','2022-01-04 04:11:29',NULL,'Pengajuan SPPH'),(300,33,1,'Melakukan pengiriman SPPH','','2022-01-04 04:11:56','2022-01-04 04:11:56',NULL,'Pengajuan SPPH');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_jabatan`
--

DROP TABLE IF EXISTS `master_jabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_jabatan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_jabatan`
--

LOCK TABLES `master_jabatan` WRITE;
/*!40000 ALTER TABLE `master_jabatan` DISABLE KEYS */;
INSERT INTO `master_jabatan` VALUES (1,'1','Rektor',NULL,NULL),(2,'2','Wakil Rektor',NULL,NULL),(3,'3','Dekan',NULL,NULL),(4,'4','Direktur',NULL,NULL),(5,'5','Manager',NULL,NULL),(6,'6','Ketua Program Studi',NULL,NULL),(7,'7','Dosen',NULL,NULL);
/*!40000 ALTER TABLE `master_jabatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_po`
--

DROP TABLE IF EXISTS `master_po`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_po` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ketentuan_pekerjaan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ketentuan_pembayaran` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_po`
--

LOCK TABLES `master_po` WRITE;
/*!40000 ALTER TABLE `master_po` DISABLE KEYS */;
INSERT INTO `master_po` VALUES (1,'<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',NULL,'2021-12-21 14:16:30','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>');
/*!40000 ALTER TABLE `master_po` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_sla`
--

DROP TABLE IF EXISTS `master_sla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_sla` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mechanism_type` int NOT NULL,
  `process` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_sla`
--

LOCK TABLES `master_sla` WRITE;
/*!40000 ALTER TABLE `master_sla` DISABLE KEYS */;
INSERT INTO `master_sla` VALUES (1,0,'SPPH',7,NULL,NULL),(2,0,'Evaluasi Tender',7,NULL,NULL),(3,0,'BA Negosiasi dan Klarifikasi',7,NULL,NULL),(4,0,'BAPP',7,NULL,NULL),(5,0,'PO',7,NULL,NULL),(6,0,'BAST',7,NULL,NULL),(7,0,'Penilaian Vendor',7,NULL,NULL),(8,0,'Input SP3',7,NULL,NULL),(9,1,'SP3',5,NULL,NULL),(10,1,'BAST',5,NULL,NULL),(11,1,'Input PJ',5,NULL,NULL);
/*!40000 ALTER TABLE `master_sla` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_spph`
--

DROP TABLE IF EXISTS `master_spph`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_spph` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `syarat` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `kriteria_penilaian` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_spph`
--

LOCK TABLES `master_spph` WRITE;
/*!40000 ALTER TABLE `master_spph` DISABLE KEYS */;
INSERT INTO `master_spph` VALUES (1,'<p>a) Copy Surat Izin Tempat Usaha / Surat Keterangan Domisili Perusahaan dari instansi yang berwenang&nbsp;<br>b) Copy Nomor Pokok Wajib Pajak (NPWP)<br>c) Copy Nomor Rekening Bank megandi<br>d) Copy surat pengukuhan pengusaha kena pajak<br>e) Copy Tanda Daftar Perusahaan (TDP)<br>f) Copy Surat Ijin Usaha Perdagangan (SIUP)<br>g) Copy neraca perusahaan (kualifikasi perusahaan) (Jika Ada)<br>h) Copy akte pendirian/anggaran dasar penyedia barang /jasa<br>i) Copy tanda pengenal pengurus<br>j) Daftar Pengalaman Kerja Sejenis.</p>','<p>Kriteria Penilaian:<br>1. Spesfikasi: Mandatory (Wajib Terpenuhi)<br>2. Garansi:<br>Minimum sebagai berikut:<br>a. Garansi penuh (service, penggantian part) selama 1 tahun, biaya dan pengerjaan ditanggungkan kepada pihak vendor selama penyebab kerusakan tersebut tidak disebabkan oleh kesalahan pemakaian.<br>b. Ketersediaan layanan service dan ketersediaan part minimal 5 tahun. Untuk tahun ke 2 sampai tahun ke 5 biaya akan dihitung berdasarkan kondisi layanan dan part. 3. Harga: 100%</p><p>Vendor wajib mencantukan sebagai berikut pada surat penawaran: 1. Spesifikasi lengkap dan rincian harga penawaran<br>2. Rincian garansi yang diberikan<br>3. Waktu Pekerjaan</p><p>* Spesifikasi/merk/brand (jika disebutkan) yang dituliskan pada surat ini adalah referensi minimum dengan tujuan supaya vendor mudah dalam menentukan produk yang akan ditawarkan, vendor boleh menawarkan dengan spesifikasi yang sama atau lebih baik/brand lain dengan syarat brand yang ditawarkan memiliki reputasi baik.</p>',NULL,NULL);
/*!40000 ALTER TABLE `master_spph` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2021_06_20_121401_procmechanism',1),(5,'2021_06_20_134906_proc_categories_migration',1),(6,'2021_06_29_111118_user_role',1),(7,'2021_06_29_160033_role_migration',1),(8,'2021_06_29_163116_vendor',1),(9,'2021_06_29_194219_procurement_table',1),(10,'2021_06_29_194522_procurement_items_table',1),(11,'2021_06_29_202809_status_procurement',1),(12,'2021_06_30_162833_role_add_parent',1),(13,'2021_06_30_184702_total_in_procurement_item',1),(14,'2021_07_06_181524_db_procurement',1),(15,'2021_07_06_225746_item_temp',1),(16,'2021_07_07_025827_vendor_categories',1),(17,'2021_07_07_032233_delete_category_in_vendor',1),(18,'2021_07_20_141658_add_code_in_item_categories',1),(19,'2021_07_20_180655_procurement_vendor_recomendation',1),(20,'2021_07_20_181126_vendor_nullable_in_procurement_items',2),(21,'2021_07_20_181847_edit_vendor',2),(22,'2021_07_20_190014_add_nilai_in_vendors',2),(23,'2021_07_20_201854_category_in_procurement_items',2),(24,'2021_07_20_235817_user_in_procurements',2),(25,'2021_07_21_051740_spph',2),(26,'2021_07_21_055023_procurement_in_procurement_spphs',2),(27,'2021_07_21_191719_spph_penawaran',2),(28,'2021_07_28_193146_spph_edit',2),(29,'2021_07_29_043020_spph_editt',2),(30,'2021_07_29_053531_penawaran_edit',2),(31,'2021_08_04_174244_edit_in_procurement_spph',2),(32,'2021_08_04_180046_edit_in_procurement_spphs',2),(33,'2021_08_05_030736_ba_negosiasi',2),(34,'2021_08_05_031007_banegosiasi_peserta',2),(35,'2021_08_05_070257_edit_in_spph_penawarans',2),(36,'2021_08_05_091701_created_bapps',2),(37,'2021_08_05_194625_edit_in_procurements',2),(38,'2021_08_05_200221_edit_in_bapps',2),(39,'2021_08_05_201139_editt_in_spph_penawarans',2),(40,'2021_08_05_210023_editsss_in_procurements',2),(41,'2021_08_05_210438_editssss_in_procurements',2),(42,'2021_08_08_213931_set_win_in_procurement_spphs',2),(43,'2021_08_08_224055_po_migration',2),(44,'2021_08_09_162224_add_satuan_in_procurement_items',2),(45,'2021_08_10_010715_spph_master',2),(46,'2021_08_11_220024_bast',2),(47,'2021_08_13_064647_vendor_rating',2),(48,'2021_08_18_195658_master_po',2),(49,'2021_08_18_200930_master_po_edit',2),(50,'2021_08_18_221735_edit_po',2),(51,'2021_08_18_231656_sp3',2),(52,'2021_08_23_212634_bast__umk',2),(53,'2021_08_24_183414_bast_item_vendor_migration',2),(54,'2021_08_26_044350_add_pj_umk',2),(55,'2021_09_03_075659_reason_in_bapp',2),(56,'2021_09_07_074558_vendor_afiliasi',2),(57,'2021_09_07_075041_po_ppn',2),(58,'2021_09_08_015322_edit_procurement_vendor',2),(59,'2021_09_08_015112_edit_procurement',3),(60,'2021_09_15_014344_edit_vendor_soft_delete',3),(61,'2021_09_17_024729_penawaran_migartion',3),(62,'2021_09_17_024836_vendortenderterbuka',3),(63,'2021_09_17_055352_add_penawaran_migration',3),(64,'2021_09_22_014939_add_status_in_penawaran',3),(65,'2021_09_22_020443_add_tangggal_in_procurement',3),(66,'2021_09_28_011415_logs_migration',3),(67,'2021_09_28_020233_add_name_keterangan',3),(68,'2021_10_08_061228_add_date_status',4),(69,'2021_10_15_004214_flag_in_spph_penawarans',5),(70,'2021_10_15_012157_change_integer_to_string',5),(71,'2021_10_19_061644_peserta_rapat_eksternal',5),(72,'2021_10_19_072734_pic_in_vendors',5),(73,'2021_10_19_073226_pic_in_vendortenderterbukas',5),(74,'2021_10_19_075138_vendor_file',5),(75,'2021_10_21_043136_make_comment_in_vendor_scores',5),(76,'2021_11_05_014123_add_done_start_time_in_logs',6),(77,'2021_11_11_184431_add_jabatan_in_user',6),(78,'2021_11_11_203704_master_sla',6),(79,'2021_11_14_144909_edit_long_in_closing_bapps',7),(80,'2021_11_15_150048_add_jabatan',8),(81,'2021_11_16_100903_change_in_users',8),(82,'2021_11_19_011243_editagain_in_bapps',9),(83,'2021_11_19_044617_edit_longtext_in_ba_negosiasis',10),(84,'2021_11_29_071940_add_pdf_in_item',11),(85,'2021_12_17_061313_user_add_username',11),(86,'2021_12_17_063432_user_add_pass',11),(87,'2021_12_17_074948_users_add_is_pengadaan',11);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penawaran_tender_terbuka_items`
--

DROP TABLE IF EXISTS `penawaran_tender_terbuka_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `penawaran_tender_terbuka_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `penawaran_tender_terbuka_id` int NOT NULL,
  `item_id` int NOT NULL,
  `harga_satuan` double DEFAULT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penawaran_tender_terbuka_items`
--

LOCK TABLES `penawaran_tender_terbuka_items` WRITE;
/*!40000 ALTER TABLE `penawaran_tender_terbuka_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `penawaran_tender_terbuka_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penawaran_tender_terbukas`
--

DROP TABLE IF EXISTS `penawaran_tender_terbukas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `penawaran_tender_terbukas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `no_penawaran` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `procurement_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penawaran_tender_terbukas`
--

LOCK TABLES `penawaran_tender_terbukas` WRITE;
/*!40000 ALTER TABLE `penawaran_tender_terbukas` DISABLE KEYS */;
/*!40000 ALTER TABLE `penawaran_tender_terbukas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pj_umk`
--

DROP TABLE IF EXISTS `pj_umk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pj_umk` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `procurement_id` int NOT NULL,
  `no_memo_umk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_pekerja` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fungsi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gl_account` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_center` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` double NOT NULL,
  `invoice_file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pj_umk`
--

LOCK TABLES `pj_umk` WRITE;
/*!40000 ALTER TABLE `pj_umk` DISABLE KEYS */;
INSERT INTO `pj_umk` VALUES (1,2,'31/UP-WR.2/UMK/x/2021','Ratih Kusuma Dewi','219999','Satff IT','Teknologi Informasi dan Komunikasi','Manajer IT','-',180000,'INVOICE-2.pdf','2021-10-06 23:01:43','2021-10-06 23:01:43'),(2,13,'MEMO/111/UMK','Megandi','12313123','Staff','Pengadaan','test','test',1000000,'INVOICE-13.pdf','2021-10-22 02:48:41','2021-10-22 02:48:41');
/*!40000 ALTER TABLE `pj_umk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `po`
--

DROP TABLE IF EXISTS `po`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `po` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `spph_id` int NOT NULL,
  `procurement_id` int NOT NULL,
  `date` datetime NOT NULL,
  `no_spmp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_terms` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ketentuan_pembayaran` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ketentuan_pekerjaan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ppn` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `po`
--

LOCK TABLES `po` WRITE;
/*!40000 ALTER TABLE `po` DISABLE KEYS */;
INSERT INTO `po` VALUES (1,1,1,'2021-10-08 00:00:00','SPMP/111/MEMO/2021','2','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-10-06 23:04:23','2021-10-06 23:04:23','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(2,2,1,'2021-10-08 00:00:00','SPMP/112/MEMO/2021','2','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-10-06 23:05:40','2021-10-06 23:05:40','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(3,17,11,'2021-10-22 00:00:00','SPMP/111/MEMO/2021','4','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-10-21 07:28:05','2021-10-21 07:28:05','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(4,19,12,'2021-10-23 00:00:00','SPMP/121/MEMO/2021','4','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-10-22 02:25:29','2021-10-22 02:25:29','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(5,31,19,'2021-11-08 00:00:00','0909999','4','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-11-08 07:29:56','2021-11-08 07:29:56','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(6,32,19,'2021-11-08 00:00:00','0890009','4','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-11-08 07:30:12','2021-11-08 07:30:12','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(7,35,20,'2021-11-15 00:00:00','098435634','4','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-11-14 09:48:13','2021-11-14 09:48:13','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(8,34,20,'2021-11-16 00:00:00','09872345','4','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-11-14 09:48:45','2021-11-14 09:48:45','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(9,38,21,'2021-11-16 00:00:00','0890009','4','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-11-16 08:37:40','2021-11-16 08:37:40','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(10,37,21,'2021-11-16 00:00:00','0987890','4','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-11-16 08:38:15','2021-11-16 08:38:15','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(11,44,23,'2021-11-19 00:00:00','09872345','2','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-11-19 02:04:00','2021-11-19 02:04:00','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(12,48,25,'2021-11-19 00:00:00','123','2','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-11-19 02:04:46','2021-11-19 02:04:46','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(13,43,23,'2021-11-19 00:00:00','09872345','2','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-11-19 02:05:30','2021-11-19 02:05:30','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(14,52,27,'2021-11-19 00:00:00','SPMP-1111-2021','2','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-11-19 02:48:35','2021-11-19 02:48:35','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(15,55,28,'2021-11-19 00:00:00','087678','2','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-11-19 04:09:52','2021-11-19 04:09:52','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(16,60,29,'2021-11-19 00:00:00','09872345','2','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-11-19 09:09:25','2021-11-19 09:09:25','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 2% (permil) perhari maksimal 10% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(17,64,30,'2021-12-01 00:00:00','09872345','2','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-12-01 02:26:36','2021-12-01 02:26:36','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(18,63,30,'2021-12-01 00:00:00','0987890','2','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-12-01 02:26:49','2021-12-01 02:26:49','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(19,68,31,'2021-12-06 00:00:00','09872345','2','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-12-06 12:33:09','2021-12-06 12:33:09','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',1),(20,67,31,'2021-12-06 00:00:00','0890009','2','Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga','2021-12-06 12:33:43','2021-12-06 12:33:56','<ol><li>Penagihan dapat dilakukan setelah pekerjaan selesai yang dituangkan ke dalam berita acara serah terima pekerjaan ke Universitas Pertamina.</li><li>Pembayaran dilakukan dalam 14 hari kerja sejak berkas penagihan lengkap diterima oleh fungsi keuangan Universitas Pertamina.</li></ol>','<ol><li>Waktu penyelesaian pekerjaan adalah 3 (Tiga) Bulan sejak PO ditandatangai kedua belah pihak.</li><li>Hasil harus sesuai dengan spesifikasi yang telah tercantum dengan PO ini.</li><li>Segala kerusakan dan kekurangan barang yang diterima pada saat penerimaan menjadi tanggung jawab vendor.</li><li>Apabila terjadi keterlambatan penyelesaian pekerjaan diberikan sanki 1% (permil) perhari maksimal 5% dihitung dari nilai kontrak sebelum pajak.</li><li>Vendor wajib memberikan garansi atas alat yang diadakan selama 1 tahun.</li></ol>',0);
/*!40000 ALTER TABLE `po` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procurement_item_vendor_recomendations`
--

DROP TABLE IF EXISTS `procurement_item_vendor_recomendations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `procurement_item_vendor_recomendations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `vendor_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procurement_item_vendor_recomendations`
--

LOCK TABLES `procurement_item_vendor_recomendations` WRITE;
/*!40000 ALTER TABLE `procurement_item_vendor_recomendations` DISABLE KEYS */;
INSERT INTO `procurement_item_vendor_recomendations` VALUES (1,42,'4','2021-11-18 09:14:47','2021-11-18 09:14:47'),(2,43,'4','2021-11-19 01:21:35','2021-11-19 01:21:35'),(3,44,'4','2021-11-19 01:29:58','2021-11-19 01:29:58'),(4,46,'4','2021-11-19 02:14:50','2021-11-19 02:14:50'),(5,48,'4','2021-11-19 02:20:27','2021-11-19 02:20:27');
/*!40000 ALTER TABLE `procurement_item_vendor_recomendations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procurement_items`
--

DROP TABLE IF EXISTS `procurement_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `procurement_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `procurement_id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_est` double NOT NULL,
  `total_unit` int NOT NULL,
  `specs` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price_total` double NOT NULL,
  `user_id` int NOT NULL,
  `temporary` int NOT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brosur_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procurement_items`
--

LOCK TABLES `procurement_items` WRITE;
/*!40000 ALTER TABLE `procurement_items` DISABLE KEYS */;
INSERT INTO `procurement_items` VALUES (1,1,'CPU',4000000,1,'Test',NULL,1,'2021-10-06 21:40:32','2021-10-06 21:40:38',4000000,2,0,'Unit',NULL),(2,1,'Mouse',500000,1,'Spek',NULL,1,'2021-10-06 21:40:38','2021-10-06 21:40:38',500000,2,0,'Pcs',NULL),(3,1,'Monitor',1000000,1,'Spek',NULL,1,'2021-10-06 21:40:38','2021-10-06 21:40:38',1000000,2,0,'Pcs',NULL),(4,2,'Switch',650000,2,'switch unmanageable 24 posrt',NULL,1,'2021-10-06 22:45:50','2021-10-06 22:45:56',1300000,2,0,'unit',NULL),(5,3,'Cisco',1500000,2,'SFP Multi Mode',NULL,1,'2021-10-06 23:22:32','2021-10-06 23:23:46',3000000,2,0,'Unit',NULL),(6,3,'SFP Multi Mode',650000,5,'SFP Multi Mode',NULL,1,'2021-10-06 23:22:53','2021-10-06 23:23:46',3250000,2,0,'Unit',NULL),(9,4,'Cisco',1500000,2,'SFP Multi Mode',NULL,1,'2021-10-06 23:35:12','2021-10-06 23:35:12',3000000,2,0,'Unit',NULL),(10,4,'SFP Multi Mode',650000,2,'SFP Multi Mode',NULL,1,'2021-10-06 23:35:12','2021-10-06 23:35:12',1300000,2,0,'Unit',NULL),(12,6,'Cisco',1500000,2,'SFP Multi Mode',NULL,1,'2021-10-06 23:43:24','2021-10-06 23:43:24',3000000,2,0,'Unit',NULL),(13,6,'SFP Multi Mode',650000,2,'SFP Multi Mode',NULL,1,'2021-10-06 23:43:24','2021-10-06 23:43:24',1300000,2,0,'Unit',NULL),(14,7,'Aplikasi ABC',185000000,1,'Aplikasi ABC',NULL,1,'2021-10-07 00:18:56','2021-10-07 00:18:58',185000000,2,0,'Unit',NULL),(15,8,'Cisco',1500000,2,'SFP Multi Mode',NULL,1,'2021-10-07 12:58:12','2021-10-07 12:58:12',3000000,2,0,'Unit',NULL),(16,8,'SFP Multi Mode',650000,2,'SFP Multi Mode',NULL,1,'2021-10-07 12:58:12','2021-10-07 12:58:12',1300000,2,0,'Unit',NULL),(17,9,'Cisco',1500000,2,'SFP Multi Mode',NULL,1,'2021-10-07 13:17:46','2021-10-07 13:17:46',3000000,2,0,'Unit',NULL),(18,9,'SFP Multi Mode',650000,2,'SFP Multi Mode',NULL,1,'2021-10-07 13:17:46','2021-10-07 13:17:46',1300000,2,0,'Unit',NULL),(19,10,'pc',20000,2,'pc',NULL,1,'2021-10-20 12:14:47','2021-10-20 12:15:14',40000,2,0,'unit',NULL),(20,10,'printer',10000,1,'printer',NULL,1,'2021-10-20 12:15:03','2021-10-20 12:15:14',10000,2,0,'unit',NULL),(21,11,'Tender Barang 1',1000000,1,'test',NULL,1,'2021-10-21 07:15:06','2021-10-21 07:15:33',1000000,2,0,'pcs',NULL),(22,11,'Tender Barang 2',750000,1,'test',NULL,2,'2021-10-21 07:15:27','2021-10-21 07:15:33',750000,2,0,'unit',NULL),(23,12,'Tender barang It',1000000,1,'test',NULL,1,'2021-10-22 02:15:23','2021-10-22 02:15:43',1000000,2,0,'unit',NULL),(24,12,'Tender Barang Lab',2500000,1,'test',NULL,2,'2021-10-22 02:15:39','2021-10-22 02:15:43',2500000,2,0,'Unit',NULL),(25,13,'UMK item 1',100000,1,'test',NULL,1,'2021-10-22 02:41:23','2021-10-22 02:41:46',100000,2,0,'unit',NULL),(26,13,'UMK Item 2',50000,1,'test',NULL,2,'2021-10-22 02:41:40','2021-10-22 02:41:46',50000,2,0,'Unit',NULL),(27,14,'PC',1000000,3,'PC',NULL,1,'2021-10-28 07:42:05','2021-10-28 07:42:16',3000000,2,0,'unit',NULL),(28,15,'server',1000000,1,'server',NULL,1,'2021-11-01 00:41:27','2021-11-01 00:41:31',1000000,2,0,'unit',NULL),(29,16,'Zoom',1200000,1,'Zoom',NULL,1,'2021-11-01 08:12:51','2021-11-01 08:12:54',1200000,2,0,'unit',NULL),(30,17,'PC',10000000,1,'test',NULL,1,'2021-11-05 02:00:07','2021-11-05 02:00:11',10000000,2,0,'test',NULL),(31,18,'PC',100000,2,'PC',NULL,1,'2021-11-08 06:46:48','2021-11-08 06:46:52',200000,2,0,'unit',NULL),(32,19,'Printer',250000,2,'printer',NULL,1,'2021-11-08 07:07:48','2021-11-08 07:08:15',500000,2,0,'unit',NULL),(33,19,'Mic Wireless Saramonic Blink',250000,3,'Mic Wireless Saramonic Blink',NULL,1,'2021-11-08 07:08:11','2021-11-08 07:08:15',750000,2,0,'unit',NULL),(34,20,'Laptop',15000000,5,'Laptop',NULL,1,'2021-11-14 09:29:13','2021-11-14 09:29:45',75000000,2,0,'unit',NULL),(35,20,'Laptop HP',13500000,8,'Laptop HP',NULL,1,'2021-11-14 09:29:42','2021-11-14 09:29:45',108000000,2,0,'unit',NULL),(36,21,'Laptop HP',16000000,5,'Laptop HP',NULL,1,'2021-11-16 08:21:08','2021-11-16 08:21:38',80000000,2,0,'unit',NULL),(37,21,'Laptop Asus',12000000,4,'Laptop Asus',NULL,1,'2021-11-16 08:21:33','2021-11-16 08:21:38',48000000,2,0,'unit',NULL),(38,22,'Laptop 1',11000000,8,'Laptop 1',NULL,1,'2021-11-18 02:17:28','2021-11-18 02:17:53',88000000,2,0,'unit',NULL),(39,22,'Laptop 2',12000000,9,'Laptop 2',NULL,1,'2021-11-18 02:17:50','2021-11-18 02:17:53',108000000,2,0,'unit',NULL),(40,23,'Laptop 1',12000000,3,'laptop',NULL,1,'2021-11-18 09:13:53','2021-11-18 09:15:37',36000000,2,0,'unit',NULL),(42,23,'Laptop 2',12500000,5,'Laptop 2',NULL,1,'2021-11-18 09:14:47','2021-11-18 09:15:37',62500000,2,0,'unit',NULL),(43,24,'Laptop',9000000,20,'Processor i-3; Ram 8Gb; Storage 250Gb',NULL,1,'2021-11-19 01:21:35','2021-11-19 01:21:54',180000000,2,0,'Unit',NULL),(44,25,'laptop',9000000,10,'i3',NULL,1,'2021-11-19 01:29:58','2021-11-19 01:30:03',90000000,2,0,'unit',NULL),(45,26,'Laptop',12000000,4,'Laptop',NULL,1,'2021-11-19 02:14:04','2021-11-19 02:14:59',48000000,2,0,'unit',NULL),(46,26,'Printer',3500000,5,'Printer',NULL,1,'2021-11-19 02:14:50','2021-11-19 02:14:59',17500000,2,0,'unit',NULL),(47,27,'Laptop',12000000,5,'Laptop',NULL,1,'2021-11-19 02:19:56','2021-11-19 02:20:30',60000000,2,0,'unit',NULL),(48,27,'Printer',3500000,5,'Printer',NULL,1,'2021-11-19 02:20:27','2021-11-19 02:20:30',17500000,2,0,'unit',NULL),(49,28,'Adobe Premiere',3500000,2,'Adobe Premiere',NULL,1,'2021-11-19 03:58:25','2021-11-19 03:58:29',7000000,2,0,'Installer',NULL),(50,29,'UTP Cable, Rj45, 5m Patchcord S',1500000,2,'UTP Cable, Rj45, 5m Patchcord S',NULL,1,'2021-11-19 08:26:28','2021-11-19 08:34:05',3000000,2,0,'Unit',NULL),(51,29,'Smart TV',8300000,5,'50 in LED Samsung, Sony, LG',NULL,1,'2021-11-19 08:33:56','2021-11-19 08:34:05',41500000,2,0,'Unit',NULL),(52,30,'Laptop- HP',14000000,5,'Ram 8GB',NULL,1,'2021-12-01 02:15:35','2021-12-01 02:16:15',70000000,2,0,'Unit',NULL),(53,30,'Laptop HP',9500000,5,'Ram 4GB Core i5',NULL,1,'2021-12-01 02:16:12','2021-12-01 02:16:15',47500000,2,0,'Unit',NULL),(54,31,'Laptop HP',16000000,4,'Ram 8GB Core i7',NULL,1,'2021-12-06 12:22:20','2021-12-06 12:22:53',64000000,2,0,'unit',NULL),(55,31,'Proyektor',3500000,4,'Proyektor Merk LG',NULL,1,'2021-12-06 12:22:50','2021-12-06 12:22:53',14000000,2,0,'Unit',NULL),(56,32,'laptop',12000000,15,'Laptop HP',NULL,1,'2021-12-19 23:58:43','2021-12-19 23:58:44',180000000,2,0,'Unit',NULL),(57,33,'Laptop',15000000,15,'Laptop',NULL,1,'2021-12-21 08:15:28','2021-12-21 08:16:35',225000000,2,0,'Unit',NULL),(58,33,'Pointer',2500000,10,'Pointer',NULL,1,'2021-12-21 08:16:03','2021-12-21 08:16:35',25000000,2,0,'unit',NULL),(59,34,'Laptop',16000000,14,'Laptop',NULL,1,'2021-12-22 13:52:26','2021-12-22 13:52:43',224000000,2,0,'unit',NULL),(60,35,'laptop',14000000,14,'Laptop',NULL,1,'2021-12-23 13:16:01','2021-12-23 13:16:03',196000000,2,0,'unit',NULL),(61,35,'HDD',500000,2,'Spek',NULL,1,'2021-12-23 13:19:25','2021-12-23 13:19:25',1000000,2,0,'Pcs',NULL),(62,36,'Laptop',12000000,12,'Laptop',NULL,1,'2021-12-23 15:35:56','2021-12-23 15:36:24',144000000,2,0,'Unit',NULL),(63,37,'Mouse',320000,12,'logi',NULL,1,'2021-12-30 00:44:53','2021-12-30 00:44:57',3840000,2,0,'unit',NULL);
/*!40000 ALTER TABLE `procurement_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procurement_mechanisms`
--

DROP TABLE IF EXISTS `procurement_mechanisms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `procurement_mechanisms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procurement_mechanisms`
--

LOCK TABLES `procurement_mechanisms` WRITE;
/*!40000 ALTER TABLE `procurement_mechanisms` DISABLE KEYS */;
INSERT INTO `procurement_mechanisms` VALUES (1,'Tender',NULL,NULL),(2,'UMK',NULL,NULL),(3,'Penunjukan Langsung',NULL,'2021-10-06 21:30:24'),(4,'Afiliasi',NULL,'2021-10-06 21:30:30'),(5,'Direct Purchase',NULL,NULL),(6,'Tender Terbuka','2021-10-06 21:30:48','2021-10-06 21:30:48'),(7,'CC','2021-10-06 21:30:52','2021-10-06 21:30:52');
/*!40000 ALTER TABLE `procurement_mechanisms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procurement_spphs`
--

DROP TABLE IF EXISTS `procurement_spphs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `procurement_spphs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `item_id` int NOT NULL,
  `no_spph` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `procurement_id` int NOT NULL,
  `status` int NOT NULL,
  `penawaran_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batas_penawaran` datetime DEFAULT NULL,
  `no_surat_penawaran` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procurement_spphs`
--

LOCK TABLES `procurement_spphs` WRITE;
/*!40000 ALTER TABLE `procurement_spphs` DISABLE KEYS */;
INSERT INTO `procurement_spphs` VALUES (1,1,1,'0001/UP-WR2.2.2/UND/X/2021','2021-10-06 22:00:21','2021-10-06 22:23:05',1,1,'Penawaran-3-SPPH-Adacom-1.pdf',NULL,'PNWRN-001'),(2,2,1,'0002/UP-WR2.2.2/UND/X/2021','2021-10-06 22:00:21','2021-10-06 22:23:24',1,1,'Penawaran-3-SPPH-Cikal-2.pdf',NULL,'PNWRN-002'),(3,1,5,'0003/UP-WR2.2.2/UND/X/2021','2021-10-06 23:24:24','2021-10-06 23:25:36',3,1,NULL,NULL,NULL),(4,2,5,'0004/UP-WR2.2.2/UND/X/2021','2021-10-06 23:24:24','2021-10-06 23:25:36',3,1,NULL,NULL,NULL),(5,1,9,'0005/UP-WR2.2.2/UND/X/2021','2021-10-06 23:36:32','2021-10-13 02:13:12',4,2,NULL,NULL,NULL),(6,2,9,'0006/UP-WR2.2.2/UND/X/2021','2021-10-06 23:36:32','2021-10-13 02:13:20',4,2,NULL,NULL,NULL),(7,1,0,'0007/UP-WR2.2.2/UND/X/2021','2021-10-06 23:45:09','2021-10-27 02:21:54',6,2,NULL,NULL,NULL),(8,3,0,'0008/UP-WR2.2.2/UND/X/2021','2021-10-07 00:19:24','2021-10-07 00:32:05',7,1,'Penawaran-3-SPPH-Afliasi-8.pdf',NULL,NULL),(9,2,15,'0009/UP-WR2.2.2/UND/X/2021','2021-10-07 12:59:19','2021-10-07 13:08:32',8,1,'Penawaran-3-SPPH-Afliasi-8.pdf',NULL,'21/09/001'),(10,1,15,'0010/UP-WR2.2.2/UND/X/2021','2021-10-07 12:59:19','2021-10-07 13:09:03',8,1,'Penawaran-3-SPPH-Afliasi-8.pdf',NULL,'21/09/001'),(11,3,15,'0011/UP-WR2.2.2/UND/X/2021','2021-10-07 12:59:19','2021-10-07 13:07:58',8,1,'Penawaran-3-SPPH-Afliasi-8.pdf',NULL,'21/09/001'),(12,3,0,'0012/UP-WR2.2.2/UND/X/2021','2021-10-07 13:19:02','2021-10-07 13:20:04',9,1,'Penawaran-3-SPPH-Afliasi-8.pdf',NULL,'21/09/001'),(13,2,19,'0013/UP-WR2.2.2/UND/X/2021','2021-10-20 12:16:13','2021-10-22 02:00:01',10,2,'Penawaran-1-SPPH-Cikal-13.pdf',NULL,'PNWRN-008-2021'),(14,1,19,'0014/UP-WR2.2.2/UND/X/2021','2021-10-20 12:16:13','2021-10-22 02:00:14',10,2,'Penawaran-1-SPPH-Adacom-14.pdf',NULL,'PNWRN-0010-2021'),(15,3,19,'0015/UP-WR2.2.2/UND/X/2021','2021-10-20 12:16:13','2021-10-21 07:13:24',10,2,NULL,NULL,NULL),(16,2,21,'0016/UP-WR2.2.2/UND/X/2021','2021-10-21 07:16:07','2021-10-21 07:21:09',11,2,'Penawaran-1-SPPH-Cikal-16.pdf',NULL,'PNWRN/1001/2021'),(17,1,21,'0017/UP-WR2.2.2/UND/X/2021','2021-10-21 07:16:07','2021-10-21 07:21:22',11,2,'Penawaran-1-SPPH-Adacom-17.pdf',NULL,'PNWRN/002/2021'),(18,3,21,'0018/UP-WR2.2.2/UND/X/2021','2021-10-21 07:16:07','2021-10-21 07:21:40',11,2,'Penawaran-1-SPPH-Afliasi-18.pdf',NULL,'PNWRN/003/2021'),(19,2,23,'0019/UP-WR2.2.2/UND/X/2021','2021-10-22 02:16:18','2021-10-22 02:18:58',12,2,'Penawaran-4-SPPH-Cikal-19.pdf',NULL,'PNWRN-011-2021'),(20,3,23,'0020/UP-WR2.2.2/UND/X/2021','2021-10-22 02:16:18','2021-10-22 02:19:16',12,2,'Penawaran-4-SPPH-Afliasi-20.pdf',NULL,'PNWRN-012-2021'),(21,1,23,'0021/UP-WR2.2.2/UND/X/2021','2021-10-22 02:16:18','2021-10-22 02:16:33',12,2,NULL,NULL,NULL),(22,2,27,'0022/UP-WR2.2.2/UND/X/2021','2021-10-28 07:43:01','2021-10-28 07:43:23',14,2,NULL,NULL,NULL),(23,3,27,'0023/UP-WR2.2.2/UND/X/2021','2021-10-28 07:43:01','2021-10-28 08:04:04',14,2,NULL,NULL,NULL),(24,1,27,'0024/UP-WR2.2.2/UND/X/2021','2021-10-28 07:43:01','2021-11-08 06:53:31',14,2,'Penawaran-4-Adakom.pdf',NULL,'08/11/2021/ADACOM'),(25,2,28,'0025/UP-WR2.2.2/UND/XI/2021','2021-11-01 00:42:12','2021-11-01 00:43:04',15,2,NULL,NULL,NULL),(26,3,28,'0026/UP-WR2.2.2/UND/XI/2021','2021-11-01 00:42:12','2021-11-01 00:52:14',15,2,NULL,NULL,NULL),(27,1,28,'0027/UP-WR2.2.2/UND/XI/2021','2021-11-01 00:42:12','2021-11-01 01:23:03',15,2,NULL,NULL,NULL),(28,2,29,'0028/UP-WR2.2.2/UND/XI/2021','2021-11-01 08:13:25','2021-11-01 08:13:30',16,2,NULL,NULL,NULL),(29,3,29,'0029/UP-WR2.2.2/UND/XI/2021','2021-11-01 08:13:25','2021-11-01 08:13:34',16,2,NULL,NULL,NULL),(30,1,29,'0030/UP-WR2.2.2/UND/XI/2021','2021-11-01 08:13:25','2021-11-01 08:15:59',16,2,'Penawaran-4-SPPH-Adacom-30.pdf',NULL,'0030/Adacom/2021'),(31,3,32,'0031/UP-WR2.2.2/UND/XI/2021','2021-11-08 07:08:56','2021-11-08 07:17:14',19,2,'Penawaran-4-SPPH-Afliasi-31.pdf',NULL,'08/Afiliasi'),(32,1,32,'0032/UP-WR2.2.2/UND/XI/2021','2021-11-08 07:08:56','2021-11-08 07:14:24',19,2,'Penawaran-4-SPPH-Adacom-32.pdf',NULL,'08/11/Adacom'),(33,2,32,'0033/UP-WR2.2.2/UND/XI/2021','2021-11-08 07:08:56','2021-11-08 07:09:03',19,2,NULL,NULL,NULL),(34,3,34,'0034/UP-WR2.2.2/UND/XI/2021','2021-11-14 09:31:05','2021-11-14 09:34:22',20,2,'Penawaran-4-SPPH-Afliasi-34.pdf',NULL,'0034/Afiliasi/2021'),(35,1,34,'0035/UP-WR2.2.2/UND/XI/2021','2021-11-14 09:31:05','2021-11-14 09:34:37',20,2,'Penawaran-4-SPPH-Adacom-35.pdf',NULL,'0035/Adacom/2021'),(36,2,34,'0036/UP-WR2.2.2/UND/XI/2021','2021-11-14 09:31:05','2021-11-14 09:31:20',20,2,NULL,NULL,NULL),(37,3,36,'0037/UP-WR2.2.2/UND/XI/2021','2021-11-16 08:22:34','2021-11-16 08:28:41',21,2,'Penawaran-4-SPPH-Afliasi-34.pdf',NULL,'007/Afiliasi/2021'),(38,1,36,'0038/UP-WR2.2.2/UND/XI/2021','2021-11-16 08:22:34','2021-11-16 08:28:17',21,2,'Penawaran-4-Adakom.pdf',NULL,'0038/Adacom/2021'),(39,2,36,'0039/UP-WR2.2.2/UND/XI/2021','2021-11-16 08:22:34','2021-11-16 08:22:45',21,2,NULL,NULL,NULL),(40,3,38,'0040/UP-WR2.2.2/UND/XI/2021','2021-11-18 02:19:18','2021-11-19 00:44:32',22,1,NULL,NULL,NULL),(41,1,38,'0041/UP-WR2.2.2/UND/XI/2021','2021-11-18 02:19:18','2021-11-19 00:44:32',22,1,NULL,NULL,NULL),(42,2,38,'0042/UP-WR2.2.2/UND/XI/2021','2021-11-18 02:19:18','2021-11-19 00:44:32',22,1,NULL,NULL,NULL),(43,3,40,'0043/UP-WR2.2.2/UND/XI/2021','2021-11-18 09:20:59','2021-11-18 09:39:26',23,2,'Penawaran-4-SPPH-Afliasi-43 (1).pdf',NULL,'0043/Afiliasi/2021'),(44,1,40,'0044/UP-WR2.2.2/UND/XI/2021','2021-11-18 09:20:59','2021-11-18 09:33:41',23,2,'Penawaran-4-SPPH-Adacom-44.pdf',NULL,'0044/Adacom.2021'),(45,2,40,'0045/UP-WR2.2.2/UND/XI/2021','2021-11-18 09:20:59','2021-11-18 09:21:38',23,2,NULL,NULL,NULL),(46,4,40,'0046/UP-WR2.2.2/UND/XI/2021','2021-11-18 09:20:59','2021-11-18 09:21:39',23,2,NULL,NULL,NULL),(47,3,44,'0047/UP-WR2.2.2/UND/XI/2021','2021-11-19 01:32:22','2021-11-19 01:33:38',25,1,NULL,NULL,NULL),(48,1,44,'0048/UP-WR2.2.2/UND/XI/2021','2021-11-19 01:32:22','2021-11-19 01:36:32',25,1,'Penawaran-3-BA_UTS_2021-1_CS_PemrogramanWeb.pdf',NULL,'adacom'),(49,2,44,'0049/UP-WR2.2.2/UND/XI/2021','2021-11-19 01:32:22','2021-11-19 01:33:38',25,1,NULL,NULL,NULL),(50,4,44,'0050/UP-WR2.2.2/UND/XI/2021','2021-11-19 01:32:22','2021-11-19 01:33:38',25,1,NULL,NULL,NULL),(51,3,47,'0051/UP-WR2.2.2/UND/XI/2021','2021-11-19 02:20:58','2021-11-19 02:25:16',27,2,'Penawaran-4-SPPH-Afliasi-51.pdf',NULL,'0051/Afiliasi/2021'),(52,1,47,'0052/UP-WR2.2.2/UND/XI/2021','2021-11-19 02:20:58','2021-11-19 02:26:03',27,2,'Penawaran-4-SPPH-Adacom-52.pdf',NULL,'0052/Adacom/2021'),(53,2,47,'0053/UP-WR2.2.2/UND/XI/2021','2021-11-19 02:20:58','2021-11-19 02:21:38',27,2,NULL,NULL,NULL),(54,4,47,'0054/UP-WR2.2.2/UND/XI/2021','2021-11-19 02:20:58','2021-11-19 02:20:58',27,0,NULL,NULL,NULL),(55,3,49,'0055/UP-WR2.2.2/UND/XI/2021','2021-11-19 03:59:24','2021-11-19 04:02:28',28,2,'Penawaran-4-SPPH-Afliasi-55.pdf',NULL,'0055/Afiliasi'),(56,1,49,'0056/UP-WR2.2.2/UND/XI/2021','2021-11-19 03:59:24','2021-11-19 04:02:15',28,2,'Penawaran-4-SPPH-Adacom-56.pdf',NULL,NULL),(57,2,49,'0057/UP-WR2.2.2/UND/XI/2021','2021-11-19 03:59:24','2021-11-19 03:59:36',28,2,NULL,NULL,NULL),(58,4,49,'0058/UP-WR2.2.2/UND/XI/2021','2021-11-19 03:59:24','2021-11-19 03:59:24',28,0,NULL,NULL,NULL),(59,3,50,'0059/UP-WR2.2.2/UND/XI/2021','2021-11-19 08:37:17','2021-11-19 08:49:00',29,2,'Penawaran-3-SPPH-Afliasi-59.pdf',NULL,'0059/Afiliasi/2021'),(60,1,50,'0060/UP-WR2.2.2/UND/XI/2021','2021-11-19 08:37:17','2021-11-19 08:47:40',29,2,'Penawaran-3-SPPH-Adacom-60.pdf',NULL,'0060/Adacom/2021'),(61,2,50,'0061/UP-WR2.2.2/UND/XI/2021','2021-11-19 08:37:17','2021-11-19 08:40:35',29,2,NULL,NULL,NULL),(62,4,50,'0062/UP-WR2.2.2/UND/XI/2021','2021-11-19 08:37:17','2021-11-19 08:37:17',29,0,NULL,NULL,NULL),(63,3,52,'0063/UP-WR2.2.2/UND/XII/2021','2021-12-01 02:17:01','2021-12-01 02:20:14',30,2,'Penawaran-4-SPPH-Afliasi-63.pdf',NULL,'0063/Afiliasi/2021'),(64,1,52,'0064/UP-WR2.2.2/UND/XII/2021','2021-12-01 02:17:01','2021-12-01 02:20:29',30,2,'Penawaran-4-SPPH-Adacom-64.pdf',NULL,'0064/Adacom/2021'),(65,2,52,'0065/UP-WR2.2.2/UND/XII/2021','2021-12-01 02:17:01','2021-12-01 02:17:13',30,2,NULL,NULL,NULL),(66,4,52,'0066/UP-WR2.2.2/UND/XII/2021','2021-12-01 02:17:01','2021-12-01 02:17:01',30,0,NULL,NULL,NULL),(67,3,54,'0067/UP-WR2.2.2/UND/XII/2021','2021-12-06 12:23:28','2021-12-06 12:26:27',31,2,'Penawaran-4-SPPH-Afliasi-67.pdf',NULL,NULL),(68,1,54,'0068/UP-WR2.2.2/UND/XII/2021','2021-12-06 12:23:28','2021-12-06 12:26:43',31,2,'Penawaran-4-SPPH-Adacom-68.pdf',NULL,'0068/Adacom/2021'),(69,2,54,'0069/UP-WR2.2.2/UND/XII/2021','2021-12-06 12:23:28','2021-12-06 12:23:28',31,0,NULL,NULL,NULL),(70,4,54,'0070/UP-WR2.2.2/UND/XII/2021','2021-12-06 12:23:28','2021-12-06 12:23:28',31,0,NULL,NULL,NULL),(71,3,57,'0071/UP-WR2.2.2/UND/XII/2021','2021-12-21 10:20:48','2021-12-21 10:35:19',33,2,NULL,NULL,NULL),(72,1,57,'0072/UP-WR2.2.2/UND/XII/2021','2021-12-21 10:20:48','2022-01-04 04:11:55',33,2,NULL,NULL,NULL),(73,2,57,'0073/UP-WR2.2.2/UND/XII/2021','2021-12-21 10:20:48','2022-01-04 04:11:29',33,2,NULL,NULL,NULL),(74,4,57,'0074/UP-WR2.2.2/UND/XII/2021','2021-12-21 10:20:48','2021-12-21 10:20:48',33,0,NULL,NULL,NULL),(75,1,0,'0075/UP-WR2.2.2/UND/XII/2021','2021-12-23 13:27:23','2021-12-23 13:34:16',35,2,NULL,NULL,NULL);
/*!40000 ALTER TABLE `procurement_spphs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procurements`
--

DROP TABLE IF EXISTS `procurements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `procurements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int NOT NULL,
  `tor_file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_memo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mechanism_id` int NOT NULL,
  `user_id` int NOT NULL,
  `staff_id` int DEFAULT NULL,
  `spph_sending_date` date DEFAULT NULL,
  `evaluasi_tender_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bapp_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id_penunjukan_langsung` int DEFAULT NULL,
  `tanggal_batas_tender_terbuka` datetime DEFAULT NULL,
  `date_status` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procurements`
--

LOCK TABLES `procurements` WRITE;
/*!40000 ALTER TABLE `procurements` DISABLE KEYS */;
INSERT INTO `procurements` VALUES (1,'Pengadaan Komputer Lab','2021-10-06 21:40:38','2021-10-06 23:06:28',7,'TOR-2-Company Profile.pdf','111/111/MEMO/2021',1,2,3,'2021-10-07','Evaluasi-3-SPPH-Cikal-2.pdf',NULL,NULL,NULL,NULL),(2,'Permohonan Pembelian Switch','2021-10-06 22:45:56','2021-10-06 22:51:48',4,'TOR-2-Aplikasi Perpustakaan.pdf','346/UP-WR2.2.2/MEMO/VIII/2021',2,2,3,NULL,NULL,NULL,NULL,NULL,NULL),(3,'Pembangunan Data center','2021-10-06 23:23:46','2021-10-06 23:25:40',3,'TOR-2-00-Basic TCP.pdf','0054/UP-WR2.2.2/UND/III/2021',1,2,3,NULL,NULL,NULL,NULL,NULL,NULL),(4,'Pembelian Neraca Pegas','2021-10-06 23:35:12','2021-10-28 07:38:38',3,'TOR-2-TOR - System Architect.pdf','0051/UP-WR2.2.2/UND/III/2021',1,2,3,'2021-10-13',NULL,NULL,NULL,NULL,'2021-10-28 07:38:38'),(6,'Pengadaan Perangkat IT Universitas  Pertamina','2021-10-06 23:43:24','2021-11-19 05:42:57',2,'TOR-2-00-Basic TCP.pdf','0054/UP-WR2.2.2/UND/III/2021',2,2,3,'2021-10-27',NULL,NULL,1,NULL,NULL),(7,'Pembuatan Aplikasi','2021-10-07 00:18:58','2021-10-07 00:37:30',5,'TOR-2-00-Basic TCP.pdf','346/UP-WR2.2.2/MEMO/VIII/2021',4,2,3,NULL,NULL,NULL,3,NULL,NULL),(8,'tender','2021-10-07 12:58:12','2021-10-07 13:09:05',3,'TOR-2-00-Basic TCP.pdf','347/UP-WR2.2.2/TENDER/VIII/2021',1,2,3,NULL,NULL,NULL,NULL,NULL,NULL),(9,'Afiliasi','2021-10-07 13:17:46','2021-10-07 13:20:07',3,'TOR-2-00-Basic TCP.pdf','347/UP-WR2.2.2/AFILIASI/VIII/2021',4,2,3,NULL,NULL,NULL,3,NULL,NULL),(10,'pengajuan aset','2021-10-20 12:15:14','2021-10-22 02:03:04',5,'TOR-2-PJ UMK Macbook SIAK dan Software (1).pdf','0054/UP-WR2.2.2/UND/III/2021',1,2,3,'2021-10-21','Evaluasi-1-SPPH-Adacom-14.pdf',NULL,NULL,NULL,'2021-10-22 02:03:04'),(11,'Pengadaan Barang Lab Komputer','2021-10-21 07:15:33','2021-10-21 07:34:58',10,'TOR-2-Company Profile.pdf','222/111/MEMO/2022',1,2,3,'2021-10-21','Evaluasi-1-SPPH-Afliasi-18.pdf',NULL,NULL,NULL,'2021-10-21 07:34:58'),(12,'Pengadaan Barang Lab IT','2021-10-22 02:15:43','2021-10-22 02:26:18',8,'TOR-2-Company Profile.pdf','111/121/MEMO/2021',1,2,3,'2021-10-22','Evaluasi-4-SPPH-Afliasi-20.pdf',NULL,NULL,NULL,'2021-10-22 02:26:18'),(13,'UMK Test','2021-10-22 02:41:46','2021-10-22 02:50:08',5,'TOR-2-Company Profile.pdf','222/131/MEMO/2021',2,2,3,NULL,NULL,NULL,NULL,NULL,'2021-10-22 02:50:08'),(14,'Pengadaan','2021-10-28 07:42:16','2021-11-08 07:04:37',7,'TOR-2-Manual Mahasiswa.pdf','0244/-/MEMO/KU.00/X/2021',1,2,3,'2021-11-08','Evaluasi-4-SPPH-Adacom-24.pdf',NULL,NULL,NULL,'2021-11-08 07:04:37'),(15,'pengajuan server','2021-11-01 00:41:31','2021-11-01 01:28:44',3,'TOR-2-TOR Sistem Pengadaan v2.pdf','345/Memo/2021',1,2,3,'2021-11-01',NULL,NULL,NULL,NULL,'2021-11-01 01:28:44'),(16,'Perizinan Penggunaan Platform Zoom untuk Kegiatan MAM-UP 2021','2021-11-01 08:12:54','2021-11-01 08:22:33',5,'TOR-2-TOR Sistem Pengadaan v2.pdf','0021/-/MEMO/BJ/IX/2021',1,2,3,'2021-11-01','Evaluasi-3-SPPH-Adacom-30.pdf',NULL,NULL,NULL,'2021-11-01 08:22:33'),(17,'Pengadaan baru','2021-11-05 02:00:11','2021-11-19 01:23:39',1,'TOR-2-Intiva.pdf','0021/-/MEMO/BJ/IX/2021',1,2,NULL,NULL,NULL,NULL,NULL,NULL,'2021-11-19 01:23:39'),(18,'Pengadaan Software Adobe Indesign','2021-11-08 06:46:52','2021-11-08 06:47:26',1,'TOR-2-TOR Sistem Pengadaan v2.pdf','0700/-/MEMO/BJ.02/XI/2021',1,2,NULL,NULL,NULL,NULL,NULL,NULL,'2021-11-08 06:47:26'),(19,'Permohonan PembelianMic Wireless Saramonic Blink','2021-11-08 07:08:15','2021-11-08 07:33:17',10,'TOR-2-TOR Sistem Pengadaan v2.pdf','0094/-/MEMO/BJ.02/X/2021',1,2,3,'2021-11-08','Evaluasi-3-SPPH-Adacom-32.pdf',NULL,NULL,NULL,'2021-11-08 07:33:17'),(20,'Uang Muka Kerja Pengadaan LaptopOperasional untuk Fungsi Aset','2021-11-14 09:29:45','2021-11-14 09:52:06',10,'TOR-2-TOR Sistem Pengadaan v2.pdf','0347/UP-WRS.2.2/MEMO/BJ.02/X/2021',1,2,3,'2021-11-14','Evaluasi-2-SPPH-Adacom-35.pdf',NULL,NULL,NULL,'2021-11-14 09:52:06'),(21,'Uang Muka Kerja Pengadaan LaptopOperasional untuk Fungsi Aset','2021-11-16 08:21:38','2021-11-16 08:44:56',10,'TOR-2-TOR Sistem Pengadaan v2.pdf','0347/UP-WRS.2.2/MEMO/BJ.02/X/2021',1,2,3,'2021-11-16','Evaluasi-2-SPPH-Adacom-38.pdf',NULL,NULL,NULL,'2021-11-16 08:44:56'),(22,'PJ UMK Pembelian LaptopOperasional Direktorat SumberDaya Manusia dan Pembelian Rak Server dan Trolli Atas Nama Herminarto Nugroho','2021-11-18 02:17:53','2021-11-18 02:19:18',2,'TOR-2-TOR Sistem Pengadaan v2.pdf','0179/UP-WRS.2.2/MEMO/BJ.02/X/2021',1,2,3,NULL,NULL,NULL,NULL,NULL,'2021-11-18 02:19:18'),(23,'Permohonan Pembelian Laptop Operasional untuk Fungsi Aset','2021-11-18 09:15:37','2021-11-19 02:05:43',7,'TOR-2-TOR Sistem Pengadaan v2.pdf','0420/UP-WRS.2/MEMO/BJ.02/X/2021',1,2,3,'2021-11-18','Evaluasi-2-Penawaran-4-SPPH-Adacom-44.pdf',NULL,NULL,NULL,'2021-11-19 02:05:43'),(24,'test kirim memo','2021-11-19 01:21:54','2021-12-22 11:05:50',1,'TOR-2-SIT dan UAT - Digilib UP 1.0.pdf','0028/-/MEMO/BJ/IX/2021',1,2,3,NULL,NULL,NULL,0,NULL,'2021-11-19 01:22:25'),(25,'UMK Pengadaan Alat Lab Gabungan','2021-11-19 01:30:03','2021-11-19 05:42:15',8,'TOR-2-BA_UTS_2021-1_CS_PemrogramanWeb.pdf','0249/UP-WRS.2/MEMO/BJ.02/X/2021',2,2,3,'2021-11-19','Evaluasi-2-SIT dan UAT - Digilib UP 1.0.pdf',NULL,NULL,NULL,'2021-11-19 02:06:11'),(26,'UMK Pengadaan Alat Lab Gabungan','2021-11-19 02:14:59','2021-11-19 02:16:35',1,'TOR-2-TOR Sistem Pengadaan v2.pdf','0249/UP-WRS.2/MEMO/BJ.02/X/2021',3,2,3,NULL,NULL,NULL,NULL,NULL,'2021-11-19 02:15:30'),(27,'Permohonan Pengajuan Penggantian Pembelanjaan Indoor Projector','2021-11-19 02:20:30','2021-11-19 02:55:52',10,'TOR-2-TOR Sistem Pengadaan v2.pdf','0486/-/MEMO/BJ.02/X/2021',1,2,3,'2021-11-19','Evaluasi-1-PO-Adacom-48.pdf',NULL,NULL,NULL,'2021-11-19 02:55:52'),(28,'Pengadaan Software Adobe Indesign','2021-11-19 03:58:29','2021-11-19 04:14:06',10,'TOR-2-Penawaran PMB UP.pdf','0700/-/MEMO/BJ.02/XI/2021',1,2,3,'2021-11-19','Evaluasi-2-SPPH-Adacom-56.pdf',NULL,NULL,NULL,'2021-11-19 04:14:06'),(29,'UMK PPL Pembellian AlatLab Elektro, Sipil dan Ilmu Komputer','2021-11-19 08:34:05','2021-11-19 09:10:03',7,'TOR-2-TOR Sistem Pengadaan v2.pdf','0346/UP-WRS.2.2/MEMO/BJ.02/X/2021',1,2,3,'2021-11-19',NULL,NULL,NULL,NULL,'2021-11-19 09:10:03'),(30,'Permohonan Pembelian Laptop Operasional untuk Fungsi Aset','2021-12-01 02:16:15','2021-12-01 02:30:38',10,'TOR-2-TOR Sistem Pengadaan v2.pdf','0420/UP-WRS.2/MEMO/BJ.02/X/2021',1,2,3,'2021-12-01','Evaluasi-2-SPPH-Afliasi-63.pdf',NULL,NULL,NULL,'2021-12-01 02:30:38'),(31,'UMK PPL Pembellian AlatLab Elektro, Sipil dan Ilmu Komputer','2021-12-06 12:22:53','2021-12-06 12:47:39',10,'TOR-2-TOR Sistem Pengadaan v2.pdf','0346/UP-WRS.2.2/MEMO/BJ.02/X/2021',1,2,3,'2021-12-06','Evaluasi-2-SPPH-Afliasi-67.pdf',NULL,NULL,NULL,'2021-12-06 12:47:39'),(33,'Permohonan Pembelian Laptop Operasional untuk Fungsi Aset','2021-12-21 08:16:35','2022-01-04 04:11:29',2,'TOR-2-TOR Pengadaan ANDIN  -TIK V.2 (1).pdf','0420/UP-WRS.2/MEMO/BJ.02/X/2021',1,2,3,'2022-01-04',NULL,NULL,0,NULL,'2021-12-21 10:20:48'),(34,'UMK PPL Pembellian AlatLab Elektro, Sipil dan Ilmu Komputer','2021-12-22 13:52:43','2021-12-23 01:14:56',2,'TOR-2-Sket KP an. M Farid F Taufiq.pdf','0346/UP-WRS.2.2/MEMO/BJ.02/X/2021',2,2,3,NULL,NULL,NULL,0,NULL,'2021-12-23 01:14:56'),(35,'Permohonan Pembelian Laptop Operasional untuk Fungsi Aset','2021-12-23 13:16:03','2021-12-23 13:34:16',2,'TOR-2-Endnote Proposal - Universitas Pertamina.pdf','0420/UP-WRS.2/MEMO/BJ.02/X/2021',3,2,3,'2021-12-23',NULL,NULL,1,NULL,'2021-12-23 13:27:23'),(36,'Permohonan Pembelian Laptop Operasional untuk Fungsi Aset','2021-12-23 15:36:24','2021-12-23 15:37:22',1,'TOR-2-Endnote Proposal - Universitas Pertamina.pdf','0420/UP-WRS.2/MEMO/BJ.02/X/2021',4,2,NULL,NULL,NULL,NULL,3,NULL,'2021-12-23 15:37:22'),(37,'Permohonan Pembelian Laptop Operasional untuk Fungsi Aset','2021-12-30 00:44:57','2021-12-30 01:09:11',2,'TOR-2-CRM_OFFERING_HADEJUN.pdf','0420/UP-WRS.2/MEMO/BJ.02/X/2021',5,2,3,NULL,NULL,NULL,0,NULL,'2021-12-30 01:09:11');
/*!40000 ALTER TABLE `procurements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Super Admin',NULL,NULL,0),(2,'Manager Pengadaan',NULL,NULL,0),(3,'Staff Pengadaan',NULL,NULL,2),(4,'User',NULL,NULL,0);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sp3`
--

DROP TABLE IF EXISTS `sp3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sp3` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `procurement_id` int NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sp3_file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sp3`
--

LOCK TABLES `sp3` WRITE;
/*!40000 ALTER TABLE `sp3` DISABLE KEYS */;
INSERT INTO `sp3` VALUES (1,2,'Pembayaran Lunas','SP3-39583-2-Mandiri Artha Solusi.pdf','2021-10-06 22:51:03','2021-10-06 22:51:03'),(2,11,'Test','SP3-98115-11-Company Profile.pdf','2021-10-21 07:34:56','2021-10-21 07:34:56'),(3,13,'File SP3','SP3-99481-13-PO-Cikal-19.pdf','2021-10-22 02:45:01','2021-10-22 02:45:01'),(4,13,'File SP3 2','SP3-79045-13-PO-Cikal-19.pdf','2021-10-22 02:45:16','2021-10-22 02:45:16'),(5,19,'SP3 1','SP3-39180-19-PO-Adacom-32.pdf','2021-11-08 07:33:13','2021-11-08 07:33:13'),(6,20,'SP3 ke 1','SP3-28110-20-PO-Adacom-35.pdf','2021-11-14 09:51:48','2021-11-14 09:51:48'),(7,20,'SP3 ke 2','SP3-20538-20-SPPH-Adacom-35.pdf','2021-11-14 09:52:01','2021-11-14 09:52:01'),(8,21,'SP3 ke 1','SP3-79213-21-PO-Adacom-38.pdf','2021-11-16 08:44:41','2021-11-16 08:44:41'),(9,21,'SP3 ke 2','SP3-49946-21-PO-Adacom-38.pdf','2021-11-16 08:44:52','2021-11-16 08:44:52'),(10,27,'file 1','SP3-57274-27-PO-Adacom-52.pdf','2021-11-19 02:55:40','2021-11-19 02:55:40'),(11,27,'File 2','SP3-81902-27-PO-Adacom-52.pdf','2021-11-19 02:55:49','2021-11-19 02:55:49'),(12,28,'SP3 ke 1','SP3-62612-28-Adakom.pdf','2021-11-19 04:13:51','2021-11-19 04:13:51'),(13,28,'SP3 ke 2','SP3-16070-28-Adakom.pdf','2021-11-19 04:14:03','2021-11-19 04:14:03'),(14,30,'SP3 ke 1','SP3-89709-30-Tagihan Termin 1-signed.pdf','2021-12-01 02:30:21','2021-12-01 02:30:21'),(15,30,'SP3 ke 2','SP3-42816-30-Tagihan Termin 1-signed.pdf','2021-12-01 02:30:33','2021-12-01 02:30:33'),(16,31,'SP3 ke 1','SP3-82190-31-Tagihan Termin 1-signed.pdf','2021-12-06 12:47:05','2021-12-06 12:47:05'),(17,31,'SP3 ke 2','SP3-10183-31-Tagihan Termin 1-signed.pdf','2021-12-06 12:47:17','2021-12-06 12:47:17');
/*!40000 ALTER TABLE `sp3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spph_penawarans`
--

DROP TABLE IF EXISTS `spph_penawarans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `spph_penawarans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `spph_id` int NOT NULL,
  `item_id` int NOT NULL,
  `harga_satuan` double DEFAULT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `procurement_id` int NOT NULL,
  `evaluasi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` int DEFAULT NULL,
  `negosiasi` double DEFAULT NULL,
  `won` int DEFAULT NULL,
  `can_win` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spph_penawarans`
--

LOCK TABLES `spph_penawarans` WRITE;
/*!40000 ALTER TABLE `spph_penawarans` DISABLE KEYS */;
INSERT INTO `spph_penawarans` VALUES (1,1,1,3500000,NULL,'2021-10-06 22:00:21','2021-10-06 22:30:54',1,'Sesuai',100,NULL,1,NULL),(2,1,2,500000,NULL,'2021-10-06 22:00:21','2021-10-06 22:29:53',1,'Sesuai',90,1,NULL,NULL),(3,1,3,500000,NULL,'2021-10-06 22:00:21','2021-10-06 22:29:53',1,'Sesuai',90,1,NULL,NULL),(4,2,1,4000000,NULL,'2021-10-06 22:00:21','2021-10-06 22:25:51',1,'Sesuai',90,1,NULL,NULL),(5,2,2,400000,NULL,'2021-10-06 22:00:21','2021-10-06 22:30:54',1,'Sesuai',100,NULL,1,NULL),(6,2,3,400000,NULL,'2021-10-06 22:00:21','2021-10-06 22:30:54',1,'Sesuai',100,NULL,1,NULL),(7,3,5,NULL,NULL,'2021-10-06 23:24:24','2021-10-06 23:24:24',3,NULL,NULL,NULL,NULL,NULL),(8,3,6,NULL,NULL,'2021-10-06 23:24:24','2021-10-06 23:24:24',3,NULL,NULL,NULL,NULL,NULL),(9,4,5,NULL,NULL,'2021-10-06 23:24:24','2021-10-06 23:24:24',3,NULL,NULL,NULL,NULL,NULL),(10,4,6,NULL,NULL,'2021-10-06 23:24:24','2021-10-06 23:24:24',3,NULL,NULL,NULL,NULL,NULL),(11,5,9,NULL,NULL,'2021-10-06 23:36:32','2021-10-06 23:36:32',4,NULL,NULL,NULL,NULL,NULL),(12,5,10,NULL,NULL,'2021-10-06 23:36:32','2021-10-06 23:36:32',4,NULL,NULL,NULL,NULL,NULL),(13,6,9,NULL,NULL,'2021-10-06 23:36:32','2021-10-06 23:36:32',4,NULL,NULL,NULL,NULL,NULL),(14,6,10,NULL,NULL,'2021-10-06 23:36:32','2021-10-06 23:36:32',4,NULL,NULL,NULL,NULL,NULL),(15,7,12,NULL,NULL,'2021-10-06 23:45:09','2021-10-06 23:45:09',6,NULL,NULL,NULL,NULL,NULL),(16,7,13,NULL,NULL,'2021-10-06 23:45:09','2021-10-06 23:45:09',6,NULL,NULL,NULL,NULL,NULL),(17,8,14,150000,NULL,'2021-10-07 00:19:24','2021-10-07 00:32:05',7,NULL,NULL,NULL,NULL,NULL),(18,9,15,150000,NULL,'2021-10-07 12:59:19','2021-10-07 13:08:32',8,NULL,NULL,NULL,NULL,NULL),(19,9,16,650000,NULL,'2021-10-07 12:59:19','2021-10-07 13:08:33',8,NULL,NULL,NULL,NULL,NULL),(20,10,15,150000,NULL,'2021-10-07 12:59:19','2021-10-07 13:09:03',8,NULL,NULL,NULL,NULL,NULL),(21,10,16,650000,NULL,'2021-10-07 12:59:19','2021-10-07 13:09:03',8,NULL,NULL,NULL,NULL,NULL),(22,11,15,150000,NULL,'2021-10-07 12:59:19','2021-10-07 13:07:58',8,NULL,NULL,NULL,NULL,NULL),(23,11,16,650000,NULL,'2021-10-07 12:59:19','2021-10-07 13:07:58',8,NULL,NULL,NULL,NULL,NULL),(24,12,17,150000,NULL,'2021-10-07 13:19:02','2021-10-07 13:20:04',9,NULL,NULL,NULL,NULL,NULL),(25,12,18,650000,NULL,'2021-10-07 13:19:02','2021-10-07 13:20:04',9,NULL,NULL,NULL,NULL,NULL),(26,13,19,30000,NULL,'2021-10-20 12:16:13','2021-10-22 02:01:14',10,'Sesuai',90,NULL,NULL,1),(27,13,20,10000,NULL,'2021-10-20 12:16:13','2021-10-22 02:02:48',10,'Sesuai',90,1,NULL,1),(28,14,19,25000,NULL,'2021-10-20 12:16:13','2021-10-22 02:01:14',10,'Sesuai',100,NULL,NULL,1),(29,14,20,9500,NULL,'2021-10-20 12:16:13','2021-10-22 02:01:45',10,'Sesuai',100,NULL,NULL,0),(30,15,19,NULL,NULL,'2021-10-20 12:16:13','2021-10-20 12:16:13',10,NULL,NULL,NULL,NULL,NULL),(31,15,20,NULL,NULL,'2021-10-20 12:16:13','2021-10-20 12:16:13',10,NULL,NULL,NULL,NULL,NULL),(32,16,21,650000,'test','2021-10-21 07:16:07','2021-10-21 07:23:15',11,'Sesuai',100,NULL,NULL,0),(33,17,21,700000,'test','2021-10-21 07:16:07','2021-10-21 07:25:14',11,'Sesuai',90,1,1,1),(34,18,21,900000,'test','2021-10-21 07:16:07','2021-10-21 07:22:44',11,'Sesuai',85,NULL,NULL,1),(35,19,23,950000,NULL,'2021-10-22 02:16:18','2021-10-22 02:24:59',12,'Sesuai',90,1,1,1),(36,20,23,900000,NULL,'2021-10-22 02:16:18','2021-10-22 02:20:27',12,'Sesuai',100,NULL,NULL,0),(37,21,23,NULL,NULL,'2021-10-22 02:16:18','2021-10-22 02:16:18',12,NULL,NULL,NULL,NULL,NULL),(38,22,27,NULL,NULL,'2021-10-28 07:43:01','2021-10-28 07:43:01',14,NULL,NULL,NULL,NULL,NULL),(39,23,27,NULL,NULL,'2021-10-28 07:43:01','2021-10-28 07:43:01',14,NULL,NULL,NULL,NULL,NULL),(40,24,27,1000000,NULL,'2021-10-28 07:43:01','2021-11-08 06:58:00',14,'Memenuhi',100,1,NULL,1),(41,25,28,NULL,NULL,'2021-11-01 00:42:12','2021-11-01 00:42:12',15,NULL,NULL,NULL,NULL,NULL),(42,26,28,NULL,NULL,'2021-11-01 00:42:12','2021-11-01 00:42:12',15,NULL,NULL,NULL,NULL,NULL),(43,27,28,NULL,NULL,'2021-11-01 00:42:12','2021-11-01 00:42:12',15,NULL,NULL,NULL,NULL,NULL),(44,28,29,NULL,NULL,'2021-11-01 08:13:25','2021-11-01 08:13:25',16,NULL,NULL,NULL,NULL,NULL),(45,29,29,NULL,NULL,'2021-11-01 08:13:25','2021-11-01 08:13:25',16,NULL,NULL,NULL,NULL,NULL),(46,30,29,1200000,NULL,'2021-11-01 08:13:25','2021-11-01 08:22:29',16,'Sesuai',100,1,NULL,1),(47,31,32,242000,NULL,'2021-11-08 07:08:56','2021-11-08 07:23:16',19,'Sesuai',90,NULL,NULL,0),(48,31,33,225000,NULL,'2021-11-08 07:08:56','2021-11-08 07:25:48',19,'Sesuai',100,1,1,1),(49,32,32,240000,NULL,'2021-11-08 07:08:56','2021-11-08 07:25:48',19,'Sesuai',100,1,1,1),(50,32,33,230000,NULL,'2021-11-08 07:08:56','2021-11-08 07:24:52',19,'Sesuai',90,1,NULL,1),(51,33,32,NULL,NULL,'2021-11-08 07:08:56','2021-11-08 07:08:56',19,NULL,NULL,NULL,NULL,NULL),(52,33,33,NULL,NULL,'2021-11-08 07:08:56','2021-11-08 07:08:56',19,NULL,NULL,NULL,NULL,NULL),(53,34,34,15250000,NULL,'2021-11-14 09:31:05','2021-11-14 09:44:53',20,'Sesuai',90,1,1,1),(54,34,35,15000000,NULL,'2021-11-14 09:31:05','2021-11-14 09:39:18',20,'Sesuai',80,1,NULL,1),(55,35,34,15500000,NULL,'2021-11-14 09:31:05','2021-11-14 09:40:43',20,'Sesuai',80,1,NULL,1),(56,35,35,14750000,NULL,'2021-11-14 09:31:05','2021-11-14 09:44:53',20,'Sesuai',90,1,1,1),(57,36,34,NULL,NULL,'2021-11-14 09:31:05','2021-11-14 09:31:05',20,NULL,NULL,NULL,NULL,NULL),(58,36,35,NULL,NULL,'2021-11-14 09:31:05','2021-11-14 09:31:05',20,NULL,NULL,NULL,NULL,NULL),(59,37,36,15700000,NULL,'2021-11-16 08:22:34','2021-11-16 08:34:42',21,'Sesuai',85,1,NULL,1),(60,37,37,12000000,NULL,'2021-11-16 08:22:34','2021-11-16 08:36:47',21,'Sesuai',90,1,1,1),(61,38,36,15600000,NULL,'2021-11-16 08:22:34','2021-11-16 08:36:47',21,'Sesuai',90,1,1,1),(62,38,37,13200000,NULL,'2021-11-16 08:22:34','2021-11-16 08:35:20',21,'Sesuai',80,1,NULL,1),(63,39,36,NULL,NULL,'2021-11-16 08:22:34','2021-11-16 08:22:34',21,NULL,NULL,NULL,NULL,NULL),(64,39,37,NULL,NULL,'2021-11-16 08:22:34','2021-11-16 08:22:34',21,NULL,NULL,NULL,NULL,NULL),(65,40,38,NULL,NULL,'2021-11-18 02:19:18','2021-11-18 02:19:18',22,NULL,NULL,NULL,NULL,NULL),(66,40,39,NULL,NULL,'2021-11-18 02:19:18','2021-11-18 02:19:18',22,NULL,NULL,NULL,NULL,NULL),(67,41,38,NULL,NULL,'2021-11-18 02:19:18','2021-11-18 02:19:18',22,NULL,NULL,NULL,NULL,NULL),(68,41,39,NULL,NULL,'2021-11-18 02:19:18','2021-11-18 02:19:18',22,NULL,NULL,NULL,NULL,NULL),(69,42,38,NULL,NULL,'2021-11-18 02:19:18','2021-11-18 02:19:18',22,NULL,NULL,NULL,NULL,NULL),(70,42,39,NULL,NULL,'2021-11-18 02:19:18','2021-11-18 02:19:18',22,NULL,NULL,NULL,NULL,NULL),(71,43,40,12100000,NULL,'2021-11-18 09:20:59','2021-11-18 09:42:53',23,'Sesuai',80,NULL,NULL,1),(72,43,42,12000000,NULL,'2021-11-18 09:20:59','2021-11-18 09:48:28',23,'Sesuai',100,1,1,1),(73,44,40,11000000,NULL,'2021-11-18 09:20:59','2021-11-18 09:48:28',23,'Sesuai',100,1,1,1),(74,44,42,12300000,NULL,'2021-11-18 09:20:59','2021-11-18 09:42:53',23,'Tidak Sesuai',0,NULL,NULL,1),(75,45,40,NULL,NULL,'2021-11-18 09:20:59','2021-11-18 09:20:59',23,NULL,NULL,NULL,NULL,NULL),(76,45,42,NULL,NULL,'2021-11-18 09:20:59','2021-11-18 09:20:59',23,NULL,NULL,NULL,NULL,NULL),(77,46,40,NULL,NULL,'2021-11-18 09:20:59','2021-11-18 09:20:59',23,NULL,NULL,NULL,NULL,NULL),(78,46,42,NULL,NULL,'2021-11-18 09:20:59','2021-11-18 09:20:59',23,NULL,NULL,NULL,NULL,NULL),(79,47,44,NULL,NULL,'2021-11-19 01:32:22','2021-11-19 01:32:22',25,NULL,NULL,NULL,NULL,NULL),(80,48,44,8000000,'warna random','2021-11-19 01:32:22','2021-11-19 01:57:55',25,'sesuai',100,1,1,1),(81,49,44,NULL,NULL,'2021-11-19 01:32:22','2021-11-19 01:32:22',25,NULL,NULL,NULL,NULL,NULL),(82,50,44,NULL,NULL,'2021-11-19 01:32:22','2021-11-19 01:32:22',25,NULL,NULL,NULL,NULL,NULL),(83,51,47,11750000,NULL,'2021-11-19 02:20:58','2021-11-19 02:39:40',27,'Sesuai',100,NULL,NULL,0),(84,51,48,3600000,NULL,'2021-11-19 02:20:58','2021-11-19 02:40:50',27,'Terpenuhi',80,1,NULL,1),(85,52,47,11500000,'Warna random','2021-11-19 02:20:58','2021-11-19 02:46:01',27,'Tidak Sesuai',0,1,1,1),(86,52,48,3250000,'Warna random','2021-11-19 02:20:58','2021-11-19 02:46:01',27,'Sesuai Spek',100,1,1,1),(87,53,47,NULL,NULL,'2021-11-19 02:20:58','2021-11-19 02:20:58',27,NULL,NULL,NULL,NULL,NULL),(88,53,48,NULL,NULL,'2021-11-19 02:20:58','2021-11-19 02:20:58',27,NULL,NULL,NULL,NULL,NULL),(89,54,47,NULL,NULL,'2021-11-19 02:20:58','2021-11-19 02:20:58',27,NULL,NULL,NULL,NULL,NULL),(90,54,48,NULL,NULL,'2021-11-19 02:20:58','2021-11-19 02:20:58',27,NULL,NULL,NULL,NULL,NULL),(91,55,49,3500000,NULL,'2021-11-19 03:59:24','2021-11-19 04:09:09',28,'Sesuai',100,1,1,1),(92,56,49,3500000,NULL,'2021-11-19 03:59:24','2021-11-19 04:08:14',28,'Sesuai',100,1,NULL,1),(93,57,49,NULL,NULL,'2021-11-19 03:59:24','2021-11-19 03:59:24',28,NULL,NULL,NULL,NULL,NULL),(94,58,49,NULL,NULL,'2021-11-19 03:59:24','2021-11-19 03:59:24',28,NULL,NULL,NULL,NULL,NULL),(95,59,50,1350000,NULL,'2021-11-19 08:37:17','2021-11-19 09:01:24',29,NULL,NULL,1,NULL,1),(96,59,51,8300000,NULL,'2021-11-19 08:37:17','2021-11-19 09:01:24',29,NULL,NULL,1,NULL,1),(97,60,50,1000000,NULL,'2021-11-19 08:37:17','2021-11-19 09:04:18',29,NULL,NULL,1,1,1),(98,60,51,8250000,NULL,'2021-11-19 08:37:17','2021-11-19 09:04:18',29,NULL,NULL,1,1,1),(99,61,50,NULL,NULL,'2021-11-19 08:37:17','2021-11-19 08:37:17',29,NULL,NULL,NULL,NULL,NULL),(100,61,51,NULL,NULL,'2021-11-19 08:37:17','2021-11-19 08:37:17',29,NULL,NULL,NULL,NULL,NULL),(101,62,50,NULL,NULL,'2021-11-19 08:37:17','2021-11-19 08:37:17',29,NULL,NULL,NULL,NULL,NULL),(102,62,51,NULL,NULL,'2021-11-19 08:37:17','2021-11-19 08:37:17',29,NULL,NULL,NULL,NULL,NULL),(103,63,52,16500000,NULL,'2021-12-01 02:17:01','2021-12-01 02:22:41',30,'Tidak Sesuai',70,NULL,NULL,1),(104,63,53,8750000,NULL,'2021-12-01 02:17:01','2021-12-01 02:26:03',30,'Sesuai',100,1,1,1),(105,64,52,14500000,NULL,'2021-12-01 02:17:01','2021-12-01 02:26:03',30,'Sesuai',100,1,1,1),(106,64,53,9750000,NULL,'2021-12-01 02:17:01','2021-12-01 02:24:47',30,'Tidak Sesuai',80,1,NULL,1),(107,65,52,NULL,NULL,'2021-12-01 02:17:01','2021-12-01 02:17:01',30,NULL,NULL,NULL,NULL,NULL),(108,65,53,NULL,NULL,'2021-12-01 02:17:01','2021-12-01 02:17:01',30,NULL,NULL,NULL,NULL,NULL),(109,66,52,NULL,NULL,'2021-12-01 02:17:01','2021-12-01 02:17:01',30,NULL,NULL,NULL,NULL,NULL),(110,66,53,NULL,NULL,'2021-12-01 02:17:01','2021-12-01 02:17:01',30,NULL,NULL,NULL,NULL,NULL),(111,67,54,16500000,NULL,'2021-12-06 12:23:28','2021-12-06 12:28:40',31,'Tidak Sesuai',75,NULL,NULL,1),(112,67,55,3250000,NULL,'2021-12-06 12:23:28','2021-12-06 12:32:29',31,'Sesuai',100,1,1,1),(113,68,54,15500000,NULL,'2021-12-06 12:23:28','2021-12-06 12:32:29',31,'Sesuai',100,1,1,1),(114,68,55,3750000,NULL,'2021-12-06 12:23:28','2021-12-06 12:30:36',31,'Tidak Sesuai',75,NULL,NULL,0),(115,69,54,NULL,NULL,'2021-12-06 12:23:28','2021-12-06 12:23:28',31,NULL,NULL,NULL,NULL,NULL),(116,69,55,NULL,NULL,'2021-12-06 12:23:28','2021-12-06 12:23:28',31,NULL,NULL,NULL,NULL,NULL),(117,70,54,NULL,NULL,'2021-12-06 12:23:28','2021-12-06 12:23:28',31,NULL,NULL,NULL,NULL,NULL),(118,70,55,NULL,NULL,'2021-12-06 12:23:28','2021-12-06 12:23:28',31,NULL,NULL,NULL,NULL,NULL),(119,71,57,NULL,NULL,'2021-12-21 10:20:48','2021-12-21 10:20:48',33,NULL,NULL,NULL,NULL,NULL),(120,71,58,NULL,NULL,'2021-12-21 10:20:48','2021-12-21 10:20:48',33,NULL,NULL,NULL,NULL,NULL),(121,72,57,NULL,NULL,'2021-12-21 10:20:48','2021-12-21 10:20:48',33,NULL,NULL,NULL,NULL,NULL),(122,72,58,NULL,NULL,'2021-12-21 10:20:48','2021-12-21 10:20:48',33,NULL,NULL,NULL,NULL,NULL),(123,73,57,NULL,NULL,'2021-12-21 10:20:48','2021-12-21 10:20:48',33,NULL,NULL,NULL,NULL,NULL),(124,73,58,NULL,NULL,'2021-12-21 10:20:48','2021-12-21 10:20:48',33,NULL,NULL,NULL,NULL,NULL),(125,74,57,NULL,NULL,'2021-12-21 10:20:48','2021-12-21 10:20:48',33,NULL,NULL,NULL,NULL,NULL),(126,74,58,NULL,NULL,'2021-12-21 10:20:48','2021-12-21 10:20:48',33,NULL,NULL,NULL,NULL,NULL),(127,75,60,NULL,NULL,'2021-12-23 13:27:23','2021-12-23 13:27:23',35,NULL,NULL,NULL,NULL,NULL),(128,75,61,NULL,NULL,'2021-12-23 13:27:23','2021-12-23 13:27:23',35,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `spph_penawarans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `umk_item_vendor`
--

DROP TABLE IF EXISTS `umk_item_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `umk_item_vendor` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `vendor_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `umk_item_vendor`
--

LOCK TABLES `umk_item_vendor` WRITE;
/*!40000 ALTER TABLE `umk_item_vendor` DISABLE KEYS */;
INSERT INTO `umk_item_vendor` VALUES (1,25,'1','2021-10-22 02:44:38','2021-10-22 02:44:38'),(2,26,'2','2021-10-22 02:44:42','2021-10-22 02:44:42'),(3,59,'1','2021-12-22 14:21:08','2021-12-23 01:13:56'),(4,63,'1','2021-12-30 01:08:45','2021-12-30 01:08:45');
/*!40000 ALTER TABLE `umk_item_vendor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int NOT NULL,
  `jabatan_id` int DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_real` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pengadaan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@admin.com','2021-09-09 07:16:33','$2y$10$/3jfJtwJQUbcs.WHRayNaucuGQuCXigBC4OJxCiHilMgrDvJwBWPq',NULL,'2021-09-09 07:16:33',NULL,1,NULL,'ppengadaan','admin123',NULL),(2,'Budi Agung Putra','user@user.com',NULL,'$2y$10$UnnF6yZQzUk3t4QJWDasdeakx8SI4613TbTG.KlBvTXVG7mD/fQi.',NULL,'2021-09-21 01:37:36','2021-11-19 01:38:49',4,4,NULL,NULL,NULL),(3,'staff 1','staff@staff.com',NULL,'$2y$10$muvHfT/kFYM28rc/oFmwvu4OH20IB99XniOlwPCOvPztSEAIkXwXm',NULL,'2021-09-21 01:39:23','2021-10-06 22:49:53',3,NULL,NULL,NULL,NULL),(4,'manager','manager@manager.com',NULL,'$2y$10$onJ6gLFyNXPE9esfhKLU/e0fPAXRU8kbSb57kKSBmyqcl.2yJgZQS',NULL,'2021-09-21 01:39:52','2021-10-06 23:48:17',2,NULL,NULL,NULL,NULL),(5,'Staff 2','staff2@staff.com',NULL,'$2y$10$DMGNMpwJfZghjzm3qMvLce2XcprsR7/ABpjRmngIuxw5uy.gWrdq.',NULL,'2021-10-29 02:37:17','2021-10-29 02:37:17',3,NULL,NULL,NULL,NULL),(6,'Ratih','ratih@gmail.com',NULL,'$2y$10$Ax6OiEk9xxQ9S.oFRM/5vugAPTKWg0tZ6k7tlvg6p193MFrLbNOnK',NULL,'2021-12-22 10:45:45','2021-12-22 10:45:45',1,0,'ratihd',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor_categories`
--

DROP TABLE IF EXISTS `vendor_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendor_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `category_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor_categories`
--

LOCK TABLES `vendor_categories` WRITE;
/*!40000 ALTER TABLE `vendor_categories` DISABLE KEYS */;
INSERT INTO `vendor_categories` VALUES (11,3,1,'2021-10-07 00:37:21','2021-10-07 00:37:21'),(13,1,1,'2021-10-22 02:12:28','2021-10-22 02:12:28'),(16,2,1,'2021-11-04 09:00:24','2021-11-04 09:00:24'),(17,4,1,'2021-11-18 09:14:47','2021-11-18 09:14:47'),(18,5,3,'2021-12-21 06:19:39','2021-12-21 06:19:39'),(19,6,3,'2021-12-21 13:04:34','2021-12-21 13:04:34');
/*!40000 ALTER TABLE `vendor_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor_files`
--

DROP TABLE IF EXISTS `vendor_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendor_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor_files`
--

LOCK TABLES `vendor_files` WRITE;
/*!40000 ALTER TABLE `vendor_files` DISABLE KEYS */;
INSERT INTO `vendor_files` VALUES (1,3,'Test','vendor-file-18476-3-Company Profile.pdf','2021-10-22 01:53:45','2021-10-22 01:53:45');
/*!40000 ALTER TABLE `vendor_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor_score`
--

DROP TABLE IF EXISTS `vendor_score`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendor_score` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `score` int NOT NULL,
  `user_id` int NOT NULL,
  `spph_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor_score`
--

LOCK TABLES `vendor_score` WRITE;
/*!40000 ALTER TABLE `vendor_score` DISABLE KEYS */;
INSERT INTO `vendor_score` VALUES (1,1,4,3,NULL,'2021-09-21 01:44:46','2021-09-21 01:44:46',NULL),(2,2,4,2,NULL,'2021-10-06 14:05:18','2021-10-06 14:05:18',NULL),(3,3,4,4,NULL,'2021-10-07 00:17:43','2021-10-07 00:17:43',NULL),(4,1,5,1,17,'2021-10-21 07:32:52','2021-10-21 07:32:52','bagus sekali vendornya'),(5,1,3,2,17,'2021-10-21 07:34:06','2021-10-21 07:34:06','kurang komunikatif vendornya'),(6,2,4,4,19,'2021-10-22 02:26:42','2021-10-22 02:26:56','Vendornya bagus sekali..'),(7,2,5,2,19,'2021-10-22 02:27:40','2021-10-22 02:27:40','bagus vendornya'),(8,1,4,3,32,'2021-11-08 07:32:40','2021-11-08 07:32:40','Bagus'),(9,3,5,3,31,'2021-11-08 07:32:50','2021-11-08 07:32:50','Bagus'),(10,2,1,3,33,'2021-11-08 07:32:56','2021-11-08 07:32:56',NULL),(11,2,1,3,36,'2021-11-14 09:50:22','2021-11-14 09:50:22','tidak ada penawaran'),(12,3,5,3,34,'2021-11-14 09:50:34','2021-11-14 09:50:34','barangnya bagus'),(13,1,5,3,35,'2021-11-14 09:50:43','2021-11-14 09:50:43','barang bagus'),(14,1,5,2,35,'2021-11-14 09:51:07','2021-11-14 09:51:07','ok'),(15,3,5,2,34,'2021-11-14 09:51:13','2021-11-14 09:51:13','ok'),(16,1,5,3,38,'2021-11-16 08:39:12','2021-11-16 08:39:12',NULL),(17,3,5,3,37,'2021-11-16 08:39:17','2021-11-16 08:39:17',NULL),(18,2,5,3,39,'2021-11-16 08:39:22','2021-11-16 08:39:22',NULL),(19,1,5,2,38,'2021-11-16 08:40:11','2021-11-16 08:40:11',NULL),(20,3,5,2,37,'2021-11-16 08:40:24','2021-11-16 08:40:24','komentar'),(21,4,4,2,NULL,'2021-11-18 09:14:47','2021-11-18 09:14:47',NULL),(22,1,4,3,52,'2021-11-19 02:53:08','2021-11-19 02:53:41','Bagus sekali'),(23,3,4,3,51,'2021-11-19 02:53:18','2021-11-19 02:53:18','lumayan bagus'),(24,1,5,2,52,'2021-11-19 02:53:31','2021-11-19 02:53:31','sangat bagus'),(25,1,5,3,56,'2021-11-19 04:12:29','2021-11-19 04:12:29',NULL),(26,3,5,3,55,'2021-11-19 04:12:35','2021-11-19 04:12:35',NULL),(27,2,2,3,57,'2021-11-19 04:12:40','2021-11-19 04:12:40',NULL),(28,4,2,3,58,'2021-11-19 04:12:45','2021-11-19 04:12:45',NULL),(29,3,5,2,55,'2021-11-19 04:13:11','2021-11-19 04:13:11',NULL),(30,1,5,3,64,'2021-12-01 02:28:22','2021-12-01 02:28:22','Sesuai'),(31,3,5,3,63,'2021-12-01 02:28:31','2021-12-01 02:28:31','Sesuai'),(32,2,2,3,65,'2021-12-01 02:28:44','2021-12-01 02:28:44','Tidak mengirim penawaran'),(33,4,2,3,66,'2021-12-01 02:29:00','2021-12-01 02:29:00','Tidak dikirim penawaran'),(34,1,4,2,64,'2021-12-01 02:29:23','2021-12-01 02:29:23',NULL),(35,3,4,2,63,'2021-12-01 02:29:34','2021-12-01 02:29:34','Barang sesuai'),(36,1,5,3,68,'2021-12-06 12:35:19','2021-12-06 12:35:19','Barang sesuai'),(37,3,5,3,67,'2021-12-06 12:35:30','2021-12-06 12:35:30','Barang sesuai'),(38,1,5,2,68,'2021-12-06 12:36:10','2021-12-06 12:36:10','Barang Ok'),(39,3,5,2,67,'2021-12-06 12:36:19','2021-12-06 12:36:19','Barang Bagus'),(40,5,4,1,NULL,'2021-12-21 06:19:39','2021-12-21 06:19:39',NULL),(41,6,4,1,NULL,'2021-12-21 13:04:34','2021-12-21 13:04:34',NULL);
/*!40000 ALTER TABLE `vendor_score` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendor_tender_terbukas`
--

DROP TABLE IF EXISTS `vendor_tender_terbukas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendor_tender_terbukas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rek` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_tax` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pic_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendor_tender_terbukas`
--

LOCK TABLES `vendor_tender_terbukas` WRITE;
/*!40000 ALTER TABLE `vendor_tender_terbukas` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendor_tender_terbukas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rek` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_tax` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `afiliasi` tinyint(1) NOT NULL DEFAULT '0',
  `delete` int NOT NULL,
  `pic_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendors`
--

LOCK TABLES `vendors` WRITE;
/*!40000 ALTER TABLE `vendors` DISABLE KEYS */;
INSERT INTO `vendors` VALUES (1,'VNDR-2021-1','Adacom','098978','Jl. Teuku Nyak Arief Simprug\r\nGedung Rektorat Lt. 3','Bank Mandiri','0989089089','2334444234','ratihkusumadewi09@gmail.com','2021-09-21 01:44:46','2021-10-22 02:12:28',0,0,'Ratih Kusuma Dewi'),(2,'VNDR-2021-2','Cikal M','12313123','test alamat','BRI','082324234234','12313123','me.gandi2471@gmail.com','2021-10-06 14:05:18','2021-11-04 09:00:24',0,0,'Megandi'),(3,'098888','Afliasi','098909999','Bandung','Bank','0988888','0890989098','dew.kusuma17@gmail.com','2021-10-07 00:17:43','2021-10-07 00:17:43',1,0,NULL),(4,NULL,'Ratih',NULL,NULL,NULL,NULL,NULL,'ratih@gmail.com','2021-11-18 09:14:47','2021-12-21 06:20:17',0,1,NULL),(5,'VNDR-2021-5','Fortune','2223243','Bandung','Bank Mandiri','09890998','2334444234','fortune@gmail.com','2021-12-21 06:19:39','2021-12-21 06:19:39',0,0,'Staff 1'),(6,'VNDR-2021-6','Prentice Hall','99999999','Jakarta','Bank Mandiri','098980','0890989098','PrenticeHall@gmail.com','2021-12-21 13:04:34','2021-12-21 13:09:58',0,1,'Staff');
/*!40000 ALTER TABLE `vendors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-06 11:10:01
