/*
SQLyog Enterprise v10.42 
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

/*Table structure for table `statuspengajuan` */

DROP TABLE IF EXISTS `statuspengajuan`;

CREATE TABLE `statuspengajuan` (
  `idstatuspengajuan` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namastatuspengajuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urut` int DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  `namastatuspengajuannext` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idstatuspengajuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `statuspengajuan` */

insert  into `statuspengajuan`(`idstatuspengajuan`,`namastatuspengajuan`,`urut`,`statusaktif`,`namastatuspengajuannext`) values ('001','Pengajuan Surat Penataan',1,'Aktif','Menunggu Verifikasi Surat di Propinsi'),('003','Verifikasi Surat di Provinsi',3,'Aktif','Menunggu Upload RANPERDA'),('005','Upload RANPERDA',5,'Aktif','Menunggu Telaah Provinsi'),('010','Telaah Provinsi',10,'Aktif','Menunggu Upload Surat Permohonan Kode'),('015','Upload Surat Pemohonan Kode',15,'Aktif','Menunggu Rekomendasi Gubernur'),('020','Upload Rekomendasi Gubernur',20,'Aktif','Mengirim Surat Ke Kemendagri'),('025','Mengirim Surat Ke Kemendagri',25,'Aktif','Menunggu Kemendagri Menerbitkan Surat'),('030','Kemendagri Menerbitkan Surat',30,'Aktif','Selesai'),('999','Selesai',99,'Aktif',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
