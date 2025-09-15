/*
SQLyog Ultimate v10.42 
MySQL - 8.0.30 : Database - sipeka
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sipeka` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `sipeka`;

/*Table structure for table `kabupaten` */

DROP TABLE IF EXISTS `kabupaten`;

CREATE TABLE `kabupaten` (
  `idkabupaten` int NOT NULL AUTO_INCREMENT,
  `kodekabupaten` char(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namakabupaten` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpropinsi` int DEFAULT NULL,
  PRIMARY KEY (`idkabupaten`),
  UNIQUE KEY `kodekabupaten` (`kodekabupaten`),
  KEY `idpropinsi` (`idpropinsi`),
  CONSTRAINT `kabupaten_ibfk_1` FOREIGN KEY (`idpropinsi`) REFERENCES `propinsi` (`idpropinsi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kabupaten` */

/*Table structure for table `kecamatan` */

DROP TABLE IF EXISTS `kecamatan`;

CREATE TABLE `kecamatan` (
  `idkecamatan` int NOT NULL AUTO_INCREMENT,
  `kodekecamatan` char(8) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namakecamatan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idkabupaten` int DEFAULT NULL,
  PRIMARY KEY (`idkecamatan`),
  UNIQUE KEY `kodekecamatan` (`kodekecamatan`),
  KEY `idkabupaten` (`idkabupaten`),
  CONSTRAINT `kecamatan_ibfk_1` FOREIGN KEY (`idkabupaten`) REFERENCES `kabupaten` (`idkabupaten`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kecamatan` */

/*Table structure for table `kelurahan` */

DROP TABLE IF EXISTS `kelurahan`;

CREATE TABLE `kelurahan` (
  `idkelurahan` int NOT NULL AUTO_INCREMENT,
  `kodekelurahan` char(13) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namakelurahan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idkecamatan` int DEFAULT NULL,
  PRIMARY KEY (`idkelurahan`),
  UNIQUE KEY `kodekelurahan` (`kodekelurahan`),
  KEY `idkecamatan` (`idkecamatan`),
  CONSTRAINT `kelurahan_ibfk_1` FOREIGN KEY (`idkecamatan`) REFERENCES `kecamatan` (`idkecamatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kelurahan` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2025_09_15_143053_create_sessions_table',1);

/*Table structure for table `penataan` */

DROP TABLE IF EXISTS `penataan`;

CREATE TABLE `penataan` (
  `idpenataan` char(2) COLLATE utf8mb4_general_ci NOT NULL,
  `namapenataan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idpenataan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penataan` */

/*Table structure for table `pengajuan` */

DROP TABLE IF EXISTS `pengajuan`;

CREATE TABLE `pengajuan` (
  `idpengajuan` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `tglpengajuan` date DEFAULT NULL,
  `idpengguna` char(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`idpengajuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengajuan` */

/*Table structure for table `pengguna` */

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna` (
  `idpengguna` char(6) COLLATE utf8mb4_general_ci NOT NULL,
  `idkabupaten` int DEFAULT NULL,
  `nip` char(18) COLLATE utf8mb4_general_ci NOT NULL,
  `namalengkap` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `gelardepan` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gelarbelakang` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpangkat` char(2) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nomorwa` char(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nomorsk` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglsk` date DEFAULT NULL,
  `filesk` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  PRIMARY KEY (`idpengguna`),
  KEY `idpangkat` (`idpangkat`),
  CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`idpangkat`) REFERENCES `refpangkat` (`idpangkat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengguna` */

/*Table structure for table `persyaratanadministratif` */

DROP TABLE IF EXISTS `persyaratanadministratif`;

CREATE TABLE `persyaratanadministratif` (
  `idpersyaratanadministratif` char(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namapersyaratanadministratif` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_general_ci DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `persyaratanadministratif` */

/*Table structure for table `persyaratandasar` */

DROP TABLE IF EXISTS `persyaratandasar`;

CREATE TABLE `persyaratandasar` (
  `idpersyaratandasar` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `namapersyaratandasar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `batasminimalkabupaten` int DEFAULT NULL,
  `batasminimalkota` int DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idpersyaratandasar`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `persyaratandasar_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `persyaratandasar` */

/*Table structure for table `persyaratanteknis` */

DROP TABLE IF EXISTS `persyaratanteknis`;

CREATE TABLE `persyaratanteknis` (
  `idpersyaratanteknis` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `namapersyaratanteknis` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idpersyaratanteknis`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `persyaratanteknis_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `persyaratanteknis` */

/*Table structure for table `propinsi` */

DROP TABLE IF EXISTS `propinsi`;

CREATE TABLE `propinsi` (
  `idpropinsi` int NOT NULL AUTO_INCREMENT,
  `kodepropinsi` char(2) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namapropinsi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idpropinsi`),
  UNIQUE KEY `kodepropinsi` (`kodepropinsi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `propinsi` */

/*Table structure for table `refpangkat` */

DROP TABLE IF EXISTS `refpangkat`;

CREATE TABLE `refpangkat` (
  `idpangkat` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `namapangkat` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `golongan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idpangkat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `refpangkat` */

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values ('Qj0jgvMddk0bHySdGlOwj9uqAsURlRVofzwJ7CNw',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRlY3TThKV1BCRWJGS0p6cDFrM1l6eHpxU01oRFluWGhlUkxQME5pWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW5nZ3VuYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1757924538);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
