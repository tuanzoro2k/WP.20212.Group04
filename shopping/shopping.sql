CREATE DATABASE  IF NOT EXISTS `book` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `book`;
-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: book
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_accounts`
--

DROP TABLE IF EXISTS `tbl_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_accounts`
--

LOCK TABLES `tbl_accounts` WRITE;
/*!40000 ALTER TABLE `tbl_accounts` DISABLE KEYS */;
INSERT INTO `tbl_accounts` VALUES (2,'admin2','admin@sample.com','$2y$10$OoppAuosBr8Uq9.yF3NSUOyJ9ypSjPIbxQY77U78s3PUzK7vhplMm','2022-07-09 20:36:02'),(3,'admin','tuan@gmail.com','$2y$10$3GJ/wlULWwsyp13/s8cWeu4cSiFj9niy7Tw9NvhAhXhoFXCgIBayi','2022-07-09 20:38:41');
/*!40000 ALTER TABLE `tbl_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `publish` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_admin`
--

LOCK TABLES `tbl_admin` WRITE;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` VALUES (2,'admin','$2y$10$AuKUoVdbjgHyQD4XoyvY1.FQ6nVtGfB9WRAn.cHgorbD/J26jIUFq','Nguyễn Tiến Tuân',1);
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parentID` int NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_category`
--

LOCK TABLES `tbl_category` WRITE;
/*!40000 ALTER TABLE `tbl_category` DISABLE KEYS */;
INSERT INTO `tbl_category` VALUES (96,'tam-li---ki-nang-song',1,'Tâm lí - kĩ năng sống',0,1,'2022-07-16 19:15:37','2022-07-16 19:15:37'),(97,'sach-van-hoc',1,'Sách văn học',0,1,'2022-07-16 19:21:38','2022-07-16 19:21:38'),(98,'kinh-te',1,'Kinh tế',0,1,'2022-07-16 19:24:43','2022-07-16 19:24:43'),(99,'manga-comic',1,'Manga-comic',0,1,'2022-07-16 19:25:03','2022-07-16 19:25:03'),(101,'tieu-thuyet',1,'Tiểu thuyết',97,1,'2022-07-16 19:27:46','2022-07-16 19:27:46'),(102,'tac-pham-kinh-dien',1,'Tác phẩm kinh điển',97,1,'2022-07-16 19:27:59','2022-07-16 19:27:59'),(103,'manga',1,'Manga',99,1,'2022-07-16 19:28:14','2022-07-16 19:28:14'),(104,'comic',1,'Comic',99,1,'2022-07-16 19:28:28','2022-07-16 19:28:28'),(105,'ki-nang-song',1,'Kĩ năng sống',96,1,'2022-07-21 17:09:45','2022-07-21 17:09:45'),(106,'bai-hoc-kinh-doanh',1,'Bài học kinh doanh',98,1,'2022-07-21 17:16:04','2022-07-21 17:16:04');
/*!40000 ALTER TABLE `tbl_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_module`
--

DROP TABLE IF EXISTS `tbl_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_module` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parentID` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `controller` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `sort` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_module`
--

LOCK TABLES `tbl_module` WRITE;
/*!40000 ALTER TABLE `tbl_module` DISABLE KEYS */;
INSERT INTO `tbl_module` VALUES (2,15,'Quản lý danh mục','cpanel/category/index','category','fa fa-edit',1,2,'2021-10-04 20:26:17','2022-07-03 03:06:59'),(3,0,'Admin','','','fa fa-edit',1,3,'2021-10-04 20:32:59','2022-07-03 03:06:35'),(4,3,'Quản lý module','cpanel/module/index','module','fa fa-edit',1,4,'2021-10-04 20:33:12','2022-07-03 03:06:53'),(9,3,'Tài khoản quản trị','cpanel/admin/index','admin','fa fa-edit',1,5,'2021-10-09 20:57:26','2022-07-03 03:06:45'),(15,0,'Sản phẩm','','','',1,7,'2021-11-12 14:45:41','0000-00-00 00:00:00'),(19,15,'Sản phẩm','cpanel/product/index','product','fas fa-user-shield',1,8,'2022-07-03 02:52:37','2022-07-03 03:06:23'),(20,3,'Tài khoản người dùng','cpanel/user/index','user','fa fa-edit',1,9,'2022-07-20 23:40:10','2022-07-20 23:40:50');
/*!40000 ALTER TABLE `tbl_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_photo`
--

DROP TABLE IF EXISTS `tbl_photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_photo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `productID` int NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_photo`
--

LOCK TABLES `tbl_photo` WRITE;
/*!40000 ALTER TABLE `tbl_photo` DISABLE KEYS */;
INSERT INTO `tbl_photo` VALUES (17,'5985213a-f02e-4b24-ba50-efe844c75021','public/uploads/images/product/detail/5985213a-f02e-4b24-ba50-efe844c75021-PTqfaykZXr2EWhL5VBC6NmctS0zF3DnswUuMxjgOQ1Dv78YeiKGHldR9oAbJ4.jpg','public/uploads/images/product/detail/thumb/5985213a-f02e-4b24-ba50-efe844c75021-0WRC6ehaHGlvnsj9mSxw487KON2ZLXDkFBtfJ5oYDVdU1uiMgPyqTcbA3rQzE.jpg',116,'2021-12-06 20:34:04'),(18,'91ade7ff-4b40-4571-a18d-150862c51b47','public/uploads/images/product/detail/91ade7ff-4b40-4571-a18d-150862c51b47-7hze2rcv3MSLDWFbmjKa6GY51gtCiwJu9NdUxBR8XsHnAVOqQky0lE4fPDZTo.jpg','public/uploads/images/product/detail/thumb/91ade7ff-4b40-4571-a18d-150862c51b47-QfhiX13YcCoz2qMLaeTVZUHnNEmARO4S07k5wrJB6ltDKPgbD9u8vFxsWGyjd.jpg',116,'2021-12-06 20:34:04'),(21,'a50dd3d2-faaf-484c-a5fb-b9e036034d6a','public/uploads/images/product/detail/a50dd3d2-faaf-484c-a5fb-b9e036034d6a-GQBt7d5rc8ZAKh1blTCyk9JL0MqFf6z2eROsYmoXPu4iwNWgajSEDHUVxn3Dv.jpg','public/uploads/images/product/detail/thumb/a50dd3d2-faaf-484c-a5fb-b9e036034d6a-jJkgW5NsUdDxzAbKVHelcv2tL8CGQB7iuY3EwFPaSnODr4R1qohXZ6m9fT0My.jpg',116,'2022-01-30 16:54:16'),(27,'c1ab03b0-0c94-4214-a978-603c3d808f43','public/uploads/images/product/detail/c1ab03b0-0c94-4214-a978-603c3d808f43-tLG4kZXzBbADTR6gDJEQYM3Ui9Pj875KnsNFSWrC2fxlyOmcwuVe0odva1hHq.jpg','public/uploads/images/product/detail/thumb/c1ab03b0-0c94-4214-a978-603c3d808f43-HtM7zObwqk2hDD1SCganlLE3PrQdv4YBR9KWAxyF85GmcsfZNVuj0eiXTJU6o.jpg',119,'2022-02-27 13:26:05'),(28,'2b2ca50b-57ab-45ec-bcd3-5758424e8e92','public/uploads/images/product/detail/2b2ca50b-57ab-45ec-bcd3-5758424e8e92-dMYoeVX9yHw1P8gmB4aLzfTG5NO3WsKhQFDC6xAR2S0bJ7vqcjZEltnDiruUk.jpg','public/uploads/images/product/detail/thumb/2b2ca50b-57ab-45ec-bcd3-5758424e8e92-zo9VaADwPkj43l1m8g2uBsGUNy0hTRKqbMJfYDxHiXO5SEZvrF6CdWtcnLQe7.jpg',119,'2022-02-27 13:26:05'),(31,'2432d438-d887-4762-a0e4-2153eb051390','public/uploads/images/product/detail/2432d438-d887-4762-a0e4-2153eb051390-d96tSDGTcBvR1wAZ2kNXfx58OayDrgEJjWPbQoelnuCmFqh70HU4zsi3VMLKY.jpg','public/uploads/images/product/detail/thumb/2432d438-d887-4762-a0e4-2153eb051390-v7s5gmODNnLCtSePjq0DcGAuVXzRHEMwZoKrhixYblWy3aF1J9BUQf4T8dk62.jpg',121,'2022-04-17 19:54:10'),(32,'5a246a49-2ffe-49ed-8640-1609434dbc52','public/uploads/images/product/detail/5a246a49-2ffe-49ed-8640-1609434dbc52-qiycQwWsEhB5nztg8YGf3TNFkebPrL4C90ZKU1VDMulA2RvoxJ7SOHmj6XdDa.jpg','public/uploads/images/product/detail/thumb/5a246a49-2ffe-49ed-8640-1609434dbc52-h38DiRQlLNATYgDU2nswZjdFkrVxb1PEv0e9OJK4tSmBoqCGX6zuf7yHWaM5c.jpg',121,'2022-04-17 19:54:11'),(33,'837a9c3a-438d-4cdb-b65e-ec4bc50b272b','public/uploads/images/product/detail/837a9c3a-438d-4cdb-b65e-ec4bc50b272b-DxsV3wr9cqRifn71tQHYThkd6Blg4L0AZGaJbeWCESNjy5vFmDXK8Pzu2oOUM.jpg','public/uploads/images/product/detail/thumb/837a9c3a-438d-4cdb-b65e-ec4bc50b272b-sikmEDNa9X2WwLDGRTfy5JS1QO6lhAUeF4dZrxbBcMV0u7C3K8gPnvjHYqotz.jpg',121,'2022-04-17 19:54:11'),(43,'96908c64-f4ad-40f3-abb0-e7ffca97f908','public/uploads/images/product/detail/96908c64-f4ad-40f3-abb0-e7ffca97f908-DRerG6g8Z3wbFS1VNKxmot9alyqYWAfC0QsJEdhnDkHMPLvT7O2j54izcuBUX.jpg','public/uploads/images/product/detail/thumb/96908c64-f4ad-40f3-abb0-e7ffca97f908-wkz5x6T7mGj0sXfENbPQS9naMlyLY3ZvhODUuFogK1Cr8iA4DdHRe2JWqBtcV.jpg',125,'2022-04-17 19:59:13'),(44,'52d2df46-f851-4492-a554-cde799b9ae8e','public/uploads/images/product/detail/52d2df46-f851-4492-a554-cde799b9ae8e-iSFWh3V8YcU0usDN7HjPM2EkwxraqDf9C51Qbytn4RdK6JGLTmoAZBOlegXzv.jpg','public/uploads/images/product/detail/thumb/52d2df46-f851-4492-a554-cde799b9ae8e-xZd3uDrCmeOQMnWN0blkjEity9qovBJT724G8ASagzHcD61hKPU5wLVsRfXYF.jpg',125,'2022-04-17 19:59:13'),(45,'d2d9f824-4ad9-44e9-a45c-740ea7060758','public/uploads/images/product/detail/d2d9f824-4ad9-44e9-a45c-740ea7060758-n5fPcADjiZuFQJhTUgC3vaSqOM1WDNGEmoHwe8069XsVL4KlYtzdxr7BRky2b.jpg','public/uploads/images/product/detail/thumb/d2d9f824-4ad9-44e9-a45c-740ea7060758-5rztNiOqSZxKvWGAuCB3lm7nj0gELwfcdQH4UTRVYM896PsaDDbohFkyeX1J2.jpg',125,'2022-04-17 19:59:13'),(47,'a0c3ad6b-07f6-4e24-90ef-f9eb83c5979c','public/uploads/images/product/detail/a0c3ad6b-07f6-4e24-90ef-f9eb83c5979c-M4RxW8zblkJBaFEZ6ymj57XAKVHv1owSOU3gtn2DdPCcuDrTeLh9fQsYNi0qG.jpg','public/uploads/images/product/detail/thumb/a0c3ad6b-07f6-4e24-90ef-f9eb83c5979c-iDgFtq357QAfcJn2kjuEM0sN4XBZSzmhaK9xL8Ce1URYbwTDyHdoG6rOVvPlW.jpg',126,'2022-04-17 20:00:00'),(48,'29d41cb2-7e0f-471f-a882-8106df50542d','public/uploads/images/product/detail/29d41cb2-7e0f-471f-a882-8106df50542d-fEvMS5yJKj2ksozY4AiNdwWqDGBLTXuDZbPe3l67RmH9C0Q8r1FgntaVOcUhx.jpg','public/uploads/images/product/detail/thumb/29d41cb2-7e0f-471f-a882-8106df50542d-l6tFJ3Nu70oa1TDOqUSsjykfdDzK4XnHWEBvYZCbh582rgwGVAcxLemiRQ9PM.jpg',126,'2022-04-17 20:00:04'),(49,'a3f69048-c8d6-4ca9-b4f2-8369b9cc41f3','public/uploads/images/product/detail/a3f69048-c8d6-4ca9-b4f2-8369b9cc41f3-MzWC7dt9oDTligEJbDUvfGX3x1ukrBqNcA5OZ6VRhYPn4jF2L0Sye8KQaHwsm.jpg','public/uploads/images/product/detail/thumb/a3f69048-c8d6-4ca9-b4f2-8369b9cc41f3-mRWwMtJga7Suk65D4G0ljeKfrOYzFxhH3XQoAPCnTEUsNvyVqiLd1Zb29Dc8B.jpg',127,'2022-04-17 20:00:55'),(50,'dc178387-d16d-4336-af1d-4a4921c559bc','public/uploads/images/product/detail/dc178387-d16d-4336-af1d-4a4921c559bc-PmrulDtkwEQyKFAjbU42faHXN1ov83DBnTgJMOzsZqLVd0eGxh9RWSciY67C5.jpg','public/uploads/images/product/detail/thumb/dc178387-d16d-4336-af1d-4a4921c559bc-Puyb6f5q0l1wRdGc7DW4FmhXNajeZEks3CLMJTgUKziVAD9tn8QvSoxOB2rYH.jpg',127,'2022-04-17 20:00:55'),(51,'76178401-2162-4511-b6ba-f74edc5c7066','public/uploads/images/product/detail/76178401-2162-4511-b6ba-f74edc5c7066-uezrA1ZEDjdMwGC04tKvoQl6J5LYaW8FfBcsRhSXgbP9x3m2DTHNnV7UkyOqi.jpg','public/uploads/images/product/detail/thumb/76178401-2162-4511-b6ba-f74edc5c7066-h7V8xPXin35YzCko1vHbarfBMOEAUjF2eqsZGy6muKLDNcRl40D9QSwgWJTdt.jpg',127,'2022-04-17 20:00:55'),(52,'c61ea661-6a1d-4e07-a167-9b3cfef01796','public/uploads/images/product/detail/c61ea661-6a1d-4e07-a167-9b3cfef01796-Wb5lDwRGemZgyEzoU0FHqTsV92KAhk8OvN64Q1MPni7xLXaYtrcdJCfSD3Bju.jpg','public/uploads/images/product/detail/thumb/c61ea661-6a1d-4e07-a167-9b3cfef01796-ncRb7Gy1koz0mDvPwEYhi6t4VQWg3MDeTq5UrasZSKCBuJ9HNFd2xXjfA8lOL.jpg',128,'2022-04-17 20:01:30'),(53,'c6a7b12b-ebb3-4105-8ff6-3e12c261096e','public/uploads/images/product/detail/c6a7b12b-ebb3-4105-8ff6-3e12c261096e-rcoePq2YHCQl4ZuxdkNjtBFfAUEb81vya5whLmDRW9nXzG7sOV6iSMgKJ03DT.jpg','public/uploads/images/product/detail/thumb/c6a7b12b-ebb3-4105-8ff6-3e12c261096e-4hbuqB71SewiG3cDA2MCalQZzdUK6ovkD59LEgRPjryVmYOTH0sFntXJN8xWf.jpg',128,'2022-04-17 20:01:30'),(54,'f393d904-23cd-41ee-aa1c-ccd0359e7e42','public/uploads/images/product/detail/f393d904-23cd-41ee-aa1c-ccd0359e7e42-uEQYyFZ1Kchrxd3G5fn09WTPi26l8CDVbXwgvRtNMesAoHaqkz4SjOD7mLBJU.jpg','public/uploads/images/product/detail/thumb/f393d904-23cd-41ee-aa1c-ccd0359e7e42-r8u0htJ21vHNAzKUw69DmLo4OVaSMQidfCqbDckgxlERsX75WFTBeZPyjY3Gn.jpg',128,'2022-04-17 20:01:30'),(55,'de5681a5-6188-4123-98e8-28e8d43f5f96','public/uploads/images/product/detail/de5681a5-6188-4123-98e8-28e8d43f5f96-ALfZh7kHoGFJ3b6N54w9KPa8tRiVX0gDMdevylEQUscuBSzWnYOqDrC1jxm2T.jpg','public/uploads/images/product/detail/thumb/de5681a5-6188-4123-98e8-28e8d43f5f96-yH9320hWURajl84qDxcEXLCMe6tNSVnDQBAizvdkurf7gKY5wOPm1bsJFoGZT.jpg',129,'2022-04-17 20:02:10'),(56,'8979e703-1d85-4049-a67f-15df3a24e862','public/uploads/images/product/detail/8979e703-1d85-4049-a67f-15df3a24e862-AMPe80GQDlOW6z4mX1rdKaFfLHS9yUx7EiktDRVvco2JsZnBj5TwY3gChNqbu.jpg','public/uploads/images/product/detail/thumb/8979e703-1d85-4049-a67f-15df3a24e862-D9vhgxVwPn8miu03cQb6ELzU5DOjdaRlyC2SqYZF7M1rXJAWftKHsoNkTGBe4.jpg',129,'2022-04-17 20:02:10'),(57,'72574ad5-c568-44a1-b9c0-178832b2039f','public/uploads/images/product/detail/72574ad5-c568-44a1-b9c0-178832b2039f-R6ZJYbKS5xBXVNPOum9e12zGyM3rHkgDtaF8dhsCUj4fEQc7AiTnwLD0Wvloq.jpg','public/uploads/images/product/detail/thumb/72574ad5-c568-44a1-b9c0-178832b2039f-YolDdg5swQf87TzFiqLVtOBrcjuJk9a6WbUZGMSCx14PNn3vEX2AKmhHR0yDe.jpg',131,'2022-07-03 15:03:32'),(58,'ebb68eb5-ae52-43ed-b45e-3a589faf87c4','public/uploads/images/product/detail/ebb68eb5-ae52-43ed-b45e-3a589faf87c4-ygWmjFfPDKh5OERkU971DGvwVMdcNYo8atl4n2bSQ3qCZLexHiJA6ruzBsX0T.jpg','public/uploads/images/product/detail/thumb/ebb68eb5-ae52-43ed-b45e-3a589faf87c4-eC2xtzLq4NSDWcuwXo5sbAQDVyK9ZmHfUTla7MG016OvRkYErP8Fj3gBhnJdi.jpg',131,'2022-07-03 15:03:33'),(67,'80dfcf39-e11f-4a70-819b-9571b16f073c','public/uploads/images/product/detail/80dfcf39-e11f-4a70-819b-9571b16f073c-73GYuQmKhP4dFrzylk0ODtNDqwR1SxeMcnL5UXoJfi8TaHsEZj6W9Vg2AvCBb.jpg','public/uploads/images/product/detail/thumb/80dfcf39-e11f-4a70-819b-9571b16f073c-wn4DmOrQu7XvKx1FELPyNzdDjtZ3kbfleBhgHVGaTRciMCJ9WUq5S628YosA0.jpg',132,'2022-07-13 16:25:49'),(68,'3e4033c6-c9f6-49d6-aa5d-4a3ba8b599fd','public/uploads/images/product/detail/3e4033c6-c9f6-49d6-aa5d-4a3ba8b599fd-aFD1ZDj7ARPsWH4ySzQ8gcowUMxOKY9vXGirNCme06J3bBhtqVdfn2uklLTE5.jpg','public/uploads/images/product/detail/thumb/3e4033c6-c9f6-49d6-aa5d-4a3ba8b599fd-wb4OkNzPVqeQurtD6nJ8UsRcDTmKh0AH5giLM3o17j9ZlaGf2YCWESFyBdxvX.jpg',124,'2022-07-13 16:28:27'),(69,'5f0e3362-77cc-47fc-ba67-7db27c14c410','public/uploads/images/product/detail/5f0e3362-77cc-47fc-ba67-7db27c14c410-qZcXNM1JgUikYzmrbfvAxB3Kd60WQaF2LGH7SORnhoCtE5ulT49ePwVsDj8Dy.jpg','public/uploads/images/product/detail/thumb/5f0e3362-77cc-47fc-ba67-7db27c14c410-JgwQCrHnVzZbTt6hX47jxfmFGoOiDlNyMdqve3E5u2k8LWsYAaPKSDRB0U19c.jpg',133,'2022-07-13 16:31:10'),(70,'dd122ba7-9f2d-431e-ab38-2ca7bf2521ec','public/uploads/images/product/detail/dd122ba7-9f2d-431e-ab38-2ca7bf2521ec-gqishcd5nazoHC4uFtLA1DjMDWm8vQGfVU9XxJ0SNY2wBeKZkPTrlR7O3Eby6.jpg','public/uploads/images/product/detail/thumb/dd122ba7-9f2d-431e-ab38-2ca7bf2521ec-aVHYd4wzb2LyivXJZToQqcSDs18COBUW35M7EGlnDKjgPAmxhR6uefkFr9t0N.jpg',134,'2022-07-13 16:33:18'),(71,'9089a1b8-178d-4724-b904-247fed4c9773','public/uploads/images/product/detail/9089a1b8-178d-4724-b904-247fed4c9773-eCLZfMAaV4QrbkNRG5zPYs3xqDK26vlJEF8uUoXtdwnSgcOHhBjyW91Tim7D0.jpg','public/uploads/images/product/detail/thumb/9089a1b8-178d-4724-b904-247fed4c9773-myuOo3EeLxjZ9NAdWck7aSVCi1rX4tQ02JTwgBs5G6KfzYlPqURbMDnHF8Dvh.jpg',135,'2022-07-15 12:42:09'),(72,'5d64b851-fa4d-4964-aaae-878505f8ddd6','public/uploads/images/product/detail/5d64b851-fa4d-4964-aaae-878505f8ddd6-sAHPEig0DdftwoeSWnl81uqMmvCUxKTJB5Y4bV2ONkQyL9z3h6rcDZXG7RajF.jpg','public/uploads/images/product/detail/thumb/5d64b851-fa4d-4964-aaae-878505f8ddd6-Ps8Dxc2DRjlfQLeyGhqdXzVBAHZatinMg4w3SKEWbkuoN5FmJvr7C6YUO091T.jpg',136,'2022-07-15 12:47:59'),(73,'540c2bba-b524-44cd-8fe5-12c03fc7f941','public/uploads/images/product/detail/540c2bba-b524-44cd-8fe5-12c03fc7f941-jUatlSoGYCADkuqWE0B6y4gerwFRbmDMZJd2T3i8P9HVLKX7N1v5QcnfshzOx.jpg','public/uploads/images/product/detail/thumb/540c2bba-b524-44cd-8fe5-12c03fc7f941-2REyOBZvTVPWamK13z9Snhr6doguDqN7G5ltXJCbAYkfxUFMiLDHsQjc40w8e.jpg',137,'2022-07-15 12:52:08'),(74,'4361a528-8a3a-463a-8749-ed2fced34d1b','public/uploads/images/product/detail/4361a528-8a3a-463a-8749-ed2fced34d1b-r8hfWJzSgR34NmowVZFLsC90t1GHPlO6yKeMbjDDk2n5qX7BixEUuTQAvcdaY.jpg','public/uploads/images/product/detail/thumb/4361a528-8a3a-463a-8749-ed2fced34d1b-mAfVK1jrQC0FR47MWONcDXBZoeydgi52ulaGTz3qwsnJvDtkU6Eb8LPYH9xhS.jpg',138,'2022-07-16 19:29:21'),(75,'bda098c8-5934-4cdb-a8a0-291689d851ba','public/uploads/images/product/detail/bda098c8-5934-4cdb-a8a0-291689d851ba-5OzD1sWS0Qyj4YUFn2ENaeJVAGHcBx9hCbRw6Ptg7LdmMuqr8fiXlkT3vKDoZ.jpg','public/uploads/images/product/detail/thumb/bda098c8-5934-4cdb-a8a0-291689d851ba-DjvwkFH5YrX14A62yJ7x0N98loOZBKhibSLedCtD3mGVngEPazfUcTsuWqQMR.jpg',139,'2022-07-16 19:29:54'),(76,'4db6ac5f-db98-45b5-bbff-536c249ada92','public/uploads/images/product/detail/4db6ac5f-db98-45b5-bbff-536c249ada92-dD7SFRsTD4V6g5HcZmMPLNoKBWvEUOf3n1Yibuye9rl0t2hCxaQGJz8XjwAqk.jpg','public/uploads/images/product/detail/thumb/4db6ac5f-db98-45b5-bbff-536c249ada92-rTjEDa3ub8UALqYcGyMJxdN49e1Sz5WVfDvton6KhROQFXZg7iCsw0HkmPBl2.jpg',140,'2022-07-16 19:31:17'),(77,'44a09115-9409-450b-acc0-3a64562c231b','public/uploads/images/product/detail/44a09115-9409-450b-acc0-3a64562c231b-HPgsjbRAcON9Go28EihTXqrKSLfWlyFdmw17V0v5DBzDYC6aQux3Ue4tMkJnZ.jpg','public/uploads/images/product/detail/thumb/44a09115-9409-450b-acc0-3a64562c231b-7G9xD5ylX4KzCSkosgNec3iYETMOdhqVL2awBZ0u8r6QFjmAJ1WnDPRtbfHvU.jpg',141,'2022-07-16 19:31:47'),(78,'a429d9eb-3c5d-4d1b-b72f-2c28361c5232','public/uploads/images/product/detail/a429d9eb-3c5d-4d1b-b72f-2c28361c5232-yr9UflmvC0D5SgXDFKWNZauHs7A6RwM3jknGOe8zbcEVL2oQYid1hTqxtPB4J.jpg','public/uploads/images/product/detail/thumb/a429d9eb-3c5d-4d1b-b72f-2c28361c5232-fn2byTxDUR1CdVmMjskEHcQFD7NOAzJXw8ouShqB3etvPLr4lW6a9G0gZKi5Y.jpg',142,'2022-07-16 19:32:25'),(79,'07f480a7-93ab-472d-a0cb-e80a7e8eec3b','public/uploads/images/product/detail/07f480a7-93ab-472d-a0cb-e80a7e8eec3b-LtA7gqHsUBfoWyPXDn0YFj5EK4hmiuVbk8d6ec9GvO2aRzwQNSC3ZJTDlMrx1.jpg','public/uploads/images/product/detail/thumb/07f480a7-93ab-472d-a0cb-e80a7e8eec3b-s7283BteMyDcxWLAPTN1KFCugVO4aDRjlXkUo609YbmwdzifnEqZGJhrHv5QS.jpg',143,'2022-07-16 19:33:01'),(80,'8a04f692-e260-4bc6-916d-a55cc86d2628','public/uploads/images/product/detail/8a04f692-e260-4bc6-916d-a55cc86d2628-aJuKO73DqAd6kMTDvlCy5PQXfxnSR4GtioErBHje8mhFsgZYcwUz02VL91WbN.jpg','public/uploads/images/product/detail/thumb/8a04f692-e260-4bc6-916d-a55cc86d2628-VTQhmJu3gjavs8HODGRd49bkF6NzxCoXU5r2SEWnK1PBMY7itZfeylqcALD0w.jpg',144,'2022-07-21 17:07:08'),(82,'4a5c0b01-6707-4fd0-b10b-bb6842fb4b14','public/uploads/images/product/detail/4a5c0b01-6707-4fd0-b10b-bb6842fb4b14-odbwaQy3DYLJl4jKnMvuNZOH7BECk5m9xXscih0FR8gU1SqADz2fe6PVTtWGr.jpg','public/uploads/images/product/detail/thumb/4a5c0b01-6707-4fd0-b10b-bb6842fb4b14-UbDhOBZsYaqDWJ0d6TLi21ykA8nwg3E5HXMNG7uftjrVPSR4Fo9CQzcmvxleK.jpg',145,'2022-07-21 17:09:56'),(83,'d6932c09-4ccb-4add-94ef-1dc129f8a6cf','public/uploads/images/product/detail/d6932c09-4ccb-4add-94ef-1dc129f8a6cf-yqh12jrdD9eD7wkcYXBmLig06EvMKtsx8fz4uoabUTPZSQHlR5O3CFAGVnWNJ.jpg','public/uploads/images/product/detail/thumb/d6932c09-4ccb-4add-94ef-1dc129f8a6cf-uRa7bElks0e5fgYiCVvm3x6GcjzDLFABOwrhQtZnMNH298XTWDJq4KodUSy1P.jpg',146,'2022-07-21 17:11:09'),(84,'f6c73b3c-3364-427c-886d-324595ec7c76','public/uploads/images/product/detail/f6c73b3c-3364-427c-886d-324595ec7c76-NtsBOFfzwJDPLejU5dkW0q4K6nHDQmZayEl3MVG1grRYvAbciu2h8C9T7SXox.jpg','public/uploads/images/product/detail/thumb/f6c73b3c-3364-427c-886d-324595ec7c76-CnjioWl49VKRky3Z8d5J6bgwuUELcmvD7tQsrSAxqhFYBNXaMfz0D2OeH1TPG.jpg',146,'2022-07-21 17:13:23'),(86,'3ac5f983-fa78-48f6-b3aa-274709b763b3','public/uploads/images/product/detail/3ac5f983-fa78-48f6-b3aa-274709b763b3-LhEDm35vQ9BwTd7Z20bcHPXfnW1Vy4qausGgUJMe6KlDFjz8ANikSrYxOoCtR.jpg','public/uploads/images/product/detail/thumb/3ac5f983-fa78-48f6-b3aa-274709b763b3-rTHAhd0KmD97FcgY4WoqVbRytlSU3x8MjCDuv5e2zBkNZsLPOGEaf61XiwnJQ.jpg',147,'2022-07-21 17:16:19');
/*!40000 ALTER TABLE `tbl_photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cateID` int NOT NULL,
  `price` double NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `contents` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `properties` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_product`
--

LOCK TABLES `tbl_product` WRITE;
/*!40000 ALTER TABLE `tbl_product` DISABLE KEYS */;
INSERT INTO `tbl_product` VALUES (138,'Cho tôi xin một vé đi tuổi thơ','cho-toi-xin-mot-ve-di-tuoi-tho',101,100000,'public/uploads/images/product/62d2af2f4b291-KLD9PsQdYVFBER8JWTufOe3tjzXbH20qwG6Um15CDar7hg4xMiNkcZlySoAvn.jpg','public/uploads/images/product/thumb/62d2af2f4b291-vZa702QGEDx4JmHfVS6jOyi8UcYTRCMNLFtPBDhdwqKr1sXzAk5ngl39Woebu.jpg',1,'','','2022-07-16 19:29:35'),(139,'Mắt biếc','mat-biec',101,150000,'public/uploads/images/product/62d2af499c962-jqnEZcVgrJFMw8U1i2D9xL0C73mvW4edt6PoOTGKQNRkulfbSAXYs5HBhDyaz.jpg','public/uploads/images/product/thumb/62d2af499c962-l3cLjMshNRf2nVDwCZAUQagTSB8OeoPbHy0Guz7EDm6FqxK9kdi5YrtJW41vX.jpg',1,'','','2022-07-16 19:30:01'),(140,'Spy X Family tập 4','spy-x-family-tap-4',103,25000,'public/uploads/images/product/62d2af9d71d92-H4BwbTns2DRCEeViZXroWcfvzAkaMJL7l8Uq9GFQKO5d6uP0mNDyhSgjt1x3Y.jpg','public/uploads/images/product/thumb/62d2af9d71d92-taBu80DY61nxZkEqrO5iGfVFDd4ASNCbTMg3zWw7lcQ2oJ9mRhvHeUXLsyjPK.jpg',1,'','','2022-07-16 19:31:25'),(141,'Thỏ bảy màu và những người nghĩ nó là bạn','tho-bay-mau-va-nhung-nguoi-nghi-no-la-ban',104,69000,'public/uploads/images/product/62d2afb706846-Z03ouOwD1nzax7BtqiU6HRvLVdEme5AkKSgXW2rGPYMsNclF9hQTjb84CyfJD.jpg','public/uploads/images/product/thumb/62d2afb706846-CiqmUbRvZ0kAEy89uHj7PBG3dOnT4zXcLForsgxWY2VDehtMSJafKD6Q1wlN5.jpg',1,'<p><strong>Thỏ Bảy M&agrave;u</strong>&nbsp;l&agrave; fanpage sở hữu hơn 2,6tr lượt th&iacute;ch tr&ecirc;n mạng x&atilde; hội. Với h&igrave;nh tượng nh&acirc;n vật th&uacute; vị c&ugrave;ng phong c&aacute;ch s&aacute;ng tạo độc đ&aacute;o, Thỏ bảy m&agrave;u vẫn lu&ocirc;n l&agrave; thu h&uacute;t được số lượng lớn người quan t&acirc;m thể hiện qua nhiều b&agrave;i viết với h&agrave;ng chục ngh&igrave;n lượt like v&agrave; share.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Thỏ Bảy M&agrave;u l&agrave; một nh&acirc;n vật hư cấu chẳng c&ograve;n xa lạ g&igrave; với anh em d&ugrave;ng mạng x&atilde; hội với slogan &ldquo;Nghe lời Thỏ, kiếp n&agrave;y coi như bỏ!&rdquo;.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Thỏ Bảy M&agrave;u đơn giản chỉ l&agrave; một con thỏ trắng với sự dở hơi, ngang ngược nhưng đ&aacute;ng y&ecirc;u v&ocirc; c&ugrave;ng tận. N&oacute; lu&ocirc;n nghĩ rằng m&igrave;nh kh&ocirc;ng c&oacute; cuộc sống v&agrave; kh&ocirc;ng c&oacute; bạn b&egrave;. Tuy nhi&ecirc;n, Thỏ lại chẳng bao giờ thấy c&ocirc; đơn v&igrave; đến c&ocirc; đơn cũng bỏ n&oacute; m&agrave; đi.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Cuốn s&aacute;ch l&agrave; những mẩu chuyện nhỏ được ghi lại bằng tranh xoay quanh Thỏ Bảy M&agrave;u v&agrave; những người nghĩ n&oacute; l&agrave; bạn. Những mẩu chuyện được truyền tải rất &ldquo;teen&rdquo; đậm chất h&agrave;i hước, ch&acirc;m biếm qua sự s&aacute;ng tạo kh&ocirc;ng k&eacute;m phần &ldquo;mặn m&agrave;&rdquo; của t&aacute;c giả c&agrave;ng trở n&ecirc;n độc đ&aacute;o v&agrave; thu h&uacute;t.</p>\r\n','','2022-07-16 19:31:51'),(143,'Tam quốc diễn nghĩa','tam-quoc-dien-nghia',102,200000,'public/uploads/images/product/62d2b0012a5fb-iQvB3yRzgVKlkuW7Hwjm0U6E9PAYNxeDTFfraMbhqdJcXCn18tSGDZO45osL2.jpg','public/uploads/images/product/thumb/62d2b0012a5fb-9imGntEeHyO0DsUcJDTZPYLXKu4MVvSqfwx5zolB7hkNg3CbQ2A8ja6Rd1FWr.jpg',1,'<p>Tam Quốc diễn nghĩa l&agrave; pho tiểu thuyết lịch sử ưu t&uacute; của nền văn học cổ Trung Quốc được độc giả khắp thế giới y&ecirc;u th&iacute;ch, say m&ecirc;. Ở nước ta trước đ&acirc;y, Tam Quốc diễn nghĩa đ&atilde; được dịch ra nhiều bản, trong số đ&oacute; bản của cụ cử Phan Kế B&iacute;nh được hoan ngh&ecirc;nh hơn cả. Tiếc rằng bản dịch n&agrave;y dựa theo nguy&ecirc;n bản Tam Quốc diễn nghĩa cũ, trong đ&oacute; c&oacute; những điểm kh&ocirc;ng được ch&iacute;nh x&aacute;c. Trong bản in t&aacute;c phẩm n&agrave;y của NXB Phổ Th&ocirc;ng năm 1959, cụ ph&oacute; bảng B&ugrave;i Kỷ đ&atilde; được mời tham gia hiệu đ&iacute;nh bằng c&aacute;ch đem đối chiếu với bộ Tam quốc diễn nghĩa của Nh&acirc;n d&acirc;n văn học x&atilde; xuất bản năm 1958.</p>\r\n','','2022-07-16 19:33:05'),(144,'Bố già','bo-gia',102,200000,'public/uploads/images/product/62d9258493767-mAe25jkM4ClOSx03wPWZ98DthKuzgT1EinfqQH6cUXNvVDGodraBFbsyLJY7R.jpg','public/uploads/images/product/thumb/62d9258493767-jgw6y4MEfOlAWFR2zbXrioSaU7ND9DZHeGVxTJ80CKYkL5d3mtsBnPhQuq1vc.jpg',1,'<p>Bố gi&agrave; l&agrave; cuốn tiểu thuyết văn học hiện đại Mỹ được đ&ocirc;ng đảo bạn đọc tr&ecirc;n thế giới n&oacute;i chung v&agrave; tại Việt Nam n&oacute;i ri&ecirc;ng đ&oacute;n nhận một c&aacute;ch &quot;nồng hậu&quot;, v&agrave; cũng kh&ocirc;ng ngạc nhi&ecirc;n khi bộ phim ra đời ăn theo kịch bản cũng được ch&agrave;o đ&oacute;n nồng nhiệt kh&ocirc;ng k&eacute;m.&nbsp; Kh&ocirc;ng hẳn l&agrave; v&igrave; cuốn tiểu thuyết viết về cuộc đời của một &quot;tr&ugrave;m mafia&quot; kh&eacute;t tiếng tr&ocirc;i dạt từ h&ograve;n đảo Xixili sang đất Mỹ v&agrave; l&agrave;m mưa l&agrave;m gi&oacute; tr&ecirc;n mảnh đất &quot;tự do&quot; n&agrave;y, m&agrave; đằng sau đ&oacute; l&agrave; những th&acirc;n phận, những cuộc đời m&agrave; lẽ ra v&ocirc; c&ugrave;ng b&igrave;nh dị v&agrave; y&ecirc;n ấm như bao gia đ&igrave;nh kh&aacute;c. C&aacute;i &quot;đế chế vương quyền&quot; bất th&agrave;nh văn ấy, ai đ&atilde; v&agrave;o trong, ai đ&atilde; &quot;cưỡi l&ecirc;n lưng hổ&quot; th&igrave; chỉ c&oacute; con đường tiến, kh&ocirc;ng c&oacute; đường lui. L&agrave; nổ s&uacute;ng, tư th&ugrave;, đ&acirc;m thu&ecirc; ch&eacute;m mướn, tranh gi&agrave;nh l&atilde;nh địa, tranh h&ugrave;ng tranh b&aacute; thi&ecirc;n hạ, vậy m&agrave; vẫn ẩn chứa những đằm thắm, mặn m&agrave;, nh&acirc;n hậu v&agrave; &quot;c&oacute; thuỷ c&oacute; chung&quot;. Ai đ&atilde; x&acirc;y dựng n&ecirc;n, ai l&agrave; người đại diện xứng đ&aacute;ng, ai danh tiếng lưu truyền? ch&iacute;nh l&agrave; &quot;Bố gi&agrave; - &Ocirc;ng tr&ugrave;m Don Vit&ocirc; C&ocirc;rle&ocirc;ne&quot;.</p>\r\n','','2022-07-21 17:08:04'),(145,'Dạy con làm giàu tập 1','day-con-lam-giau-tap-1',105,80000,'public/uploads/images/product/62d926205425f-0JFNinG2zQBTmZbO4h3lWysSoMKuc7dfYq5DejLU6xARrka8VCgHPXEwDv1t9.jpg','public/uploads/images/product/thumb/62d926205425f-kegdMWQ7t3bYi1UxGAfOTKC0ED8VjPHwmXoacJrvhZRlB2Ls69y5nqD4SFzNu.jpg',1,'<p>N&acirc;ng cao chỉ số IQ t&agrave;i ch&iacute;nh gi&uacute;p bạn th&ocirc;ng minh hơn về t&agrave;i ch&iacute;nh để c&oacute; thể xử l&yacute; những th&ocirc;ng tin t&agrave;i ch&iacute;nh của ri&ecirc;ng m&igrave;nh v&agrave; tự m&igrave;nh nghiệm ra con đường để đạt đến sự tự do về t&agrave;i ch&iacute;nh. Quan trọng hơn l&agrave; qua những điều t&aacute;c giả tr&igrave;nh b&agrave;y trong cuốn s&aacute;ch sẽ gi&uacute;p bạn tăng cường ch&iacute; số IQ t&agrave;i ch&iacute;nh để trở n&ecirc;n gi&agrave;u c&oacute;.</p>\r\n','','2022-07-21 17:10:40'),(146,'Nhà giả kim','nha-gia-kim',102,55000,'public/uploads/images/product/62d9267a00d2f-j3vQNGDBOAt4b8zxhlyuWme27MnYHUrqPCELJ9V01kaDoRgTsXdFiZ5fSc6Kw.jpg','public/uploads/images/product/thumb/62d9267a00d2f-BRbADfrOgNMsJtS5c9DyU1eGQvjhX6qV8FnW3kuHo0dTKCwExLl24iam7ZzPY.jpg',1,'<p><em>Tất cả những trải nghiệm trong chuyến phi&ecirc;u du theo đuổi vận mệnh của m&igrave;nh đ&atilde; gi&uacute;p Santiago thấu hiểu được &yacute; nghĩa s&acirc;u xa nhất của hạnh ph&uacute;c, h&ograve;a hợp với vũ trụ v&agrave; con người</em>.&nbsp;</p>\r\n\r\n<p>Tiểu thuyết&nbsp;<em>Nh&agrave; giả kim&nbsp;</em>của Paulo Coelho như một c&acirc;u chuyện cổ t&iacute;ch giản dị, nh&acirc;n &aacute;i, gi&agrave;u chất thơ, thấm đẫm những minh triết huyền b&iacute; của phương Đ&ocirc;ng. Trong lần xuất bản đầu ti&ecirc;n tại Brazil v&agrave;o năm 1988, s&aacute;ch chỉ b&aacute;n được 900 bản. Nhưng, với số phận đặc biệt của cuốn s&aacute;ch d&agrave;nh cho to&agrave;n nh&acirc;n loại, vượt ra ngo&agrave;i bi&ecirc;n giới quốc gia,&nbsp;<em>Nh&agrave; giả kim&nbsp;</em>đ&atilde; l&agrave;m rung động h&agrave;ng triệu t&acirc;m hồn, trở th&agrave;nh một trong những cuốn s&aacute;ch b&aacute;n chạy nhất mọi thời đại, v&agrave; c&oacute; thể l&agrave;m thay đổi cuộc đời người đọc.</p>\r\n','','2022-07-21 17:12:10'),(147,'Nghĩ giàu làm giàu','nghi-giau-lam-giau',106,77000,'public/uploads/images/product/62d927d0cfa4d-eQ4ot7cMvdsqgm0Z61FRYPV9TNBk5abhzXUGEiSKA3fwCrylDODnJjx8LWu2H.jpg','public/uploads/images/product/thumb/62d927d0cfa4d-W2yRo5snLjemNvdYh8xlPQrMSJ47Dc3qfEzTCBawGF6HkXDKObgU19tuV0iZA.jpg',1,'<p><strong>Think and Grow Rich - Nghĩ gi&agrave;u v&agrave; l&agrave;m gi&agrave;u</strong>&nbsp;l&agrave; một trong những cuốn s&aacute;ch b&aacute;n chạy nhất mọi thời đại. Đ&atilde; hơn 60 triệu bản được ph&aacute;t h&agrave;nh với gần trăm ng&ocirc;n ngữ tr&ecirc;n to&agrave;n thế giới v&agrave; được c&ocirc;ng nhận l&agrave; cuốn s&aacute;ch tạo ra nhiều triệu ph&uacute;, một cuốn s&aacute;ch truyền cảm hứng th&agrave;nh c&ocirc;ng nhiều hơn bất cứ cuốn s&aacute;ch kinh doanh n&agrave;o trong lịch sử.</p>\r\n\r\n<p>T&aacute;c phẩm n&agrave;y đ&atilde; gi&uacute;p t&aacute;c giả của n&oacute;, Napoleon Hill, được t&ocirc;n vinh bằng danh hiệu &ldquo;người tạo ra những nh&agrave; triệu ph&uacute;&rdquo;. Đ&acirc;y cũng l&agrave; cuốn s&aacute;ch hiếm hoi được đứng trong top của rất nhiều b&igrave;nh chọn theo nhiều ti&ecirc;u ch&iacute; kh&aacute;c nhau - b&igrave;nh chọn của độc giả, của giới chuy&ecirc;n m&ocirc;n, của b&aacute;o ch&iacute;. L&yacute; do để&nbsp;<strong>Think and Grow Rich - Nghĩ gi&agrave;u v&agrave; l&agrave;m gi&agrave;u</strong>&nbsp;c&oacute; được vinh quang n&agrave;y thật hiển nhi&ecirc;n v&agrave; dễ hiểu: Bằng việc đọc v&agrave; &aacute;p dụng những phương ph&aacute;p đơn giản, c&ocirc; đọng n&agrave;y v&agrave;o đời sống của mỗi c&aacute; nh&acirc;n m&agrave; đ&atilde; c&oacute; h&agrave;ng ng&agrave;n người tr&ecirc;n thế giới trở th&agrave;nh triệu ph&uacute; v&agrave; th&agrave;nh c&ocirc;ng bền vững.</p>\r\n\r\n<p>&nbsp;</p>\r\n','','2022-07-21 17:17:52');
/*!40000 ALTER TABLE `tbl_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_slug`
--

DROP TABLE IF EXISTS `tbl_slug`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_slug` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_slug`
--

LOCK TABLES `tbl_slug` WRITE;
/*!40000 ALTER TABLE `tbl_slug` DISABLE KEYS */;
INSERT INTO `tbl_slug` VALUES (87,'tam-li---ki-nang-song',1),(88,'sach-van-hoc',1),(89,'',1),(90,'kinh-te',1),(91,'manga-comic',1),(93,'tieu-thuyet',1),(94,'tac-pham-kinh-dien',1),(95,'manga',1),(96,'comic',1),(97,'cho-toi-xin-mot-ve-di-tuoi-tho',2),(98,'mat-biec',2),(99,'spy-x-family-tap-4',2),(100,'tho-bay-mau-va-nhung-nguoi-nghi-no-la-ban',2),(102,'tam-quoc-dien-nghia',2),(103,'bo-gia',2),(104,'ki-nang-song',1),(105,'day-con-lam-giau-tap-1',2),(106,'nha-gia-kim',2),(107,'bai-hoc-kinh-doanh',1),(108,'nghi-giau-lam-giau',2);
/*!40000 ALTER TABLE `tbl_slug` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-21 17:29:47
