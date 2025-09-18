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
  `kodekabupaten` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namakabupaten` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`kodekabupaten`),
  UNIQUE KEY `kodekabupaten` (`kodekabupaten`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kabupaten` */

insert  into `kabupaten`(`kodekabupaten`,`namakabupaten`) values ('6101','Kabupaten Sambas'),('6102','Kabupaten Bengkayang'),('6103','Kabupaten Landak'),('6104','Kabupaten Mempawah'),('6105','Kabupaten Sanggau'),('6106','Kabupaten Ketapang'),('6107','Kabupaten Sintang'),('6108','Kabupaten Kapuas Hulu'),('6109','Kabupaten Sekadau'),('6110','Kabupaten Melawi'),('6111','Kabupaten Kayong Utara'),('6112','Kabupaten Kubu Raya'),('6171','Kota Pontianak'),('6172','Kota Singkawang');

/*Table structure for table `kecamatan` */

DROP TABLE IF EXISTS `kecamatan`;

CREATE TABLE `kecamatan` (
  `kodekecamatan` char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namakecamatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kodekabupaten` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglberdiri` date DEFAULT NULL,
  PRIMARY KEY (`kodekecamatan`),
  KEY `kodekabupaten` (`kodekabupaten`),
  CONSTRAINT `kecamatan_ibfk_1` FOREIGN KEY (`kodekabupaten`) REFERENCES `kabupaten` (`kodekabupaten`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kecamatan` */

insert  into `kecamatan`(`kodekecamatan`,`namakecamatan`,`kodekabupaten`,`tglberdiri`) values ('610101','Sambas','6101','1950-01-01'),('610102','Tebas','6101','1950-01-01'),('610103','Selakau','6101','1950-01-01'),('610104','Galing','6101','1950-01-01'),('610105','Tekarang','6101','1950-01-01'),('610201','Bengkayang','6102','1950-01-01'),('610202','Samalantan','6102','1950-01-01'),('610203','Ledo','6102','1950-01-01'),('610204','Lumar','6102','1950-01-01'),('610205','Suti Semarang','6102','1950-01-01'),('610206','Sungai Betung','6102','1950-01-01'),('610301','Ngabang','6103','1950-01-01'),('610302','Menjalin','6103','1950-01-01'),('610303','Mempawah Hulu','6103','1950-01-01'),('610304','Menyuke','6103','1950-01-01'),('610305','Sengah Temila','6103','1950-01-01'),('610306','Jelimpo','6103','1950-01-01'),('610401','Toho','6104','1950-01-01'),('610402','Sadaniang','6104','1950-01-01'),('610403','Segedong','6104','1950-01-01'),('610404','Mempawah Hilir','6104','1950-01-01'),('610501','Kapuas','6105','1950-01-01'),('610502','Parindu','6105','1950-01-01'),('610503','Tayan Hulu','6105','1950-01-01'),('610504','Tayan Hilir','6105','1950-01-01'),('610505','Toba','6105','1950-01-01'),('610506','Noyan','6105','1950-01-01'),('610507','Mukok','6105','1950-01-01'),('610508','Balai','6105','1950-01-01'),('610509','Jangkang','6105','1950-01-01'),('610601','Ketapang','6106','1950-01-01'),('610602','Hulu Sungai','6106','1950-01-01'),('610603','Simpang Dua','6106','1950-01-01'),('610604','Pemahan','6106','1950-01-01'),('610605','Simpang Hulu','6106','1950-01-01'),('610701','Sintang','6107','1950-01-01'),('610702','Binjai Hulu','6107','1950-01-01'),('610703','Serawai','6107','1950-01-01'),('610704','Ketungau Tengah','6107','1950-01-01'),('610705','Ketungau Hilir','6107','1950-01-01'),('610706','Kayen Hulu','6107','1950-01-01'),('610707','Kayen Hilir','6107','1950-01-01'),('610708','Sepauk','6107','1950-01-01'),('610801','Putussibau Selatan','6108','1950-01-01'),('610802','Putussibau Utara','6108','1950-01-01'),('610803','Badau','6108','1950-01-01'),('610804','Batang Lupar','6108','1950-01-01'),('610805','Embaloh Hulu','6108','1950-01-01'),('610806','Seberuang','6108','1950-01-01'),('610807','Semitau','6108','1950-01-01'),('610808','Bunut Hulu','6108','1950-01-01'),('610809','Suhaid','6108','1950-01-01'),('610810','Pengkadan','6108','1950-01-01'),('610811','Silat Hilir','6108','1950-01-01'),('610812','Silat Hulu','6108','1950-01-01'),('610813','Jongkong','6108','1950-01-01'),('610901','Sekadau Hilir','6109','1950-01-01'),('610902','Sekadau Hulu','6109','1950-01-01'),('610903','Nanga Taman','6109','1950-01-01'),('611001','Nanga Pinang','6110','1950-01-01'),('611002','Belimbing','6110','1950-01-01'),('611003','Ella Hilir','6110','1950-01-01'),('611004','Menukung','6110','1950-01-01'),('611005','Sokan','6110','1950-01-01'),('611006','Sayan','6110','1950-01-01'),('611101','Simpang Hilir','6111','1950-01-01'),('611102','Pulau Maya','6111','1950-01-01'),('611103','Simpang Terus','6111','1950-01-01'),('611201','Kubu','6112','1950-01-01'),('611202','Teluk Pakedai','6112','1950-01-01'),('611203','Terentang','6112','1950-01-01'),('611204','Batu Ampar','6112','1950-01-01'),('611205','Sungai Raya','6112','1950-01-01'),('611206','Sungai Ambawang','6112','1950-01-01'),('617101','Pontianak Selatan','6171','1950-01-01'),('617102','Pontianak Timur','6171','1950-01-01'),('617103','Pontianak Barat','6171','1950-01-01'),('617104','Pontianak Utara','6171','1950-01-01'),('617105','Pontianak Kota','6171','1950-01-01'),('617201','Singkawang Tengah','6172','1950-01-01'),('617202','Singkawang Utara','6172','1950-01-01'),('617203','Singkawang Selatan','6172','1950-01-01'),('617204','Singkawang Barat','6172','1950-01-01'),('617205','Singkawang Timur','6172','1950-01-01');

/*Table structure for table `kelurahan` */

DROP TABLE IF EXISTS `kelurahan`;

CREATE TABLE `kelurahan` (
  `kodekelurahan` char(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namakelurahan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kodekecamatan` char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`kodekelurahan`),
  KEY `kodekecamatan` (`kodekecamatan`),
  CONSTRAINT `kelurahan_ibfk_1` FOREIGN KEY (`kodekecamatan`) REFERENCES `kecamatan` (`kodekecamatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kelurahan` */

insert  into `kelurahan`(`kodekelurahan`,`namakelurahan`,`kodekecamatan`) values ('6101031001','Sungai Rusa','610103'),('6101031002','Pangkalan Bemban','610103'),('6101031003','Sungai Nyirih','610103'),('6101041001','Ratu Sepudak','610104'),('6101041002','Sungai Palah','610104'),('6101041003','Sagu','610104'),('6101051001','Tekarang','610105'),('6101051002','Sempadian','610105'),('6101051003','Cepala','610105'),('6102041001','Seran Selimbau','610204'),('6102051001','Tapen','610205'),('6102051002','Kelayu','610205'),('6103011001','Pak Mayam','610301'),('6103011002','Sebirang','610301'),('6103011003','Ambayo Selatan','610301'),('6103011004','Hilir Kantor','610301'),('6103011005','Ambayo Inti','610301'),('6103011006','Ambayo Utara','610301'),('6103021001','Rees','610302'),('6103021002','Tempoak','610302'),('6103031001','Sampuro','610303'),('6103041001','Ongkol Padang','610304'),('6103041002','Taas','610304'),('6103041003','Mamek','610304'),('6103041004','Anik Dingir','610304'),('6103041005','Sungai Lubang','610304'),('6103041006','Tolok','610304'),('6103041007','Ansang','610304'),('6103041008','Angkaras','610304'),('6103041009','Songga','610304'),('6103041010','Lintah Betung','610304'),('6103041011','Sidan','610304'),('6103041012','Berinang Mayun','610304'),('6103051001','Aur Sampuk','610305'),('6103051002','Senakin','610305'),('6103051003','Palaoan','610305'),('6103061001','Nyiin','610306'),('6103061002','Papung','610306'),('6103061003','Sekais','610306'),('6104011001','Toho Hilir','610401'),('6104021001','Pentek','610402'),('6104021002','Sekabuk','610402'),('6104031001','Segedong Baru','610403'),('6104031002','Segedong Lama','610403'),('6104041001','Pasiran','610404'),('6104041002','Mempawah Kota','610404'),('6104041003','Sungai Asam','610404'),('6105011001','Beringin','610501'),('6105011002','Bunut','610501'),('6105011003','Lape','610501'),('6105011004','Tapang Dulang','610501'),('6105011005','Botuh Lintang','610501'),('6105021001','Suka Gerundi','610502'),('6105021002','Suka Mulya','610502'),('6105021003','Palem Jaya','610502'),('6105021004','Pusat Damai','610502'),('6105021005','Sebara','610502'),('6105021006','Hibun','610502'),('6105091001','Selampung','610509'),('6105091002','Sape','610509'),('6105091003','Semirau','610509'),('6106021001','Riam Dadap','610602'),('6106021002','Sekukun','610602'),('6106021003','Batu Lapis','610602'),('6106051001','Paoh Concong','610605'),('6106051002','Legong','610605'),('6106051003','Kenanga','610605'),('6107031001','Nanga Bihe','610703'),('6107031002','Nanga Tekungai','610703'),('6107031003','Talian Sahabung','610703'),('6107031004','Batu Ketebung','610703'),('6107031005','Muara Kota','610703'),('6107031006','Mekar Sari','610703'),('6107051001','Setungkup','610705'),('6107051002','Nanga Ketungau','610705'),('6107081001','Temiang Kapuas','610708'),('6107081002','Ensabang','610708'),('6107081003','Buluh Kuning','610708'),('6107081004','Temawang Muntai','610708'),('6107081005','Tawang Sari','610708'),('6107081006','Gernis Jaya','610708'),('6107081007','Paoh Benua','610708'),('6107081008','Bedayan','610708'),('6107081009','Tanjung Hulu','610708'),('6107081010','Sukau Bersatu','610708'),('6107081011','Kemantan','610708'),('6107081012','Peninsung','610708'),('6107081013','Sepulut','610708'),('6107081014','Temawang Bulai','610708'),('6107081015','Sungai Segak','610708'),('6107081016','Riam Kempadik','610708'),('6107081017','Nanga Layung','610708'),('6107081018','Limau Bakti','610708'),('6108011001','Ingko Tambe','610801'),('6108011002','Sayut','610801'),('6108011003','Beringin Jaya','610801'),('6108011004','Bungan Jaya','610801'),('6108011005','Tanjunglokang','610801'),('6108011006','Urang Unsa','610801'),('6108011007','Kedamin Darat','610801'),('6108011008','Tanjung Jati','610801'),('6108011009','Sungai Uluk','610801'),('6108011010','Kedamin Hilir','610801'),('6108021001','Putussibau Kota','610802'),('6108021002','Pala Pulau','610802'),('6108021003','Nanga Sambus','610802'),('6108021004','Ariung Mendalam','610802'),('6108031001','Seriang','610803'),('6108031002','Badau','610803'),('6108031003','Sebindang','610803'),('6108031004','Tinting Seligi','610803'),('6108031005','Tajum','610803'),('6108041001','Setulang','610804'),('6108041002','Labian Ira`ang','610804'),('6108051001','Pulau Manak','610805'),('6108061001','Ranyai','610806'),('6108061002','Bati','610806'),('6108061003','Seneban','610806'),('6108061004','Belikai','610806'),('6108061005','Pala Kota','610806'),('6108061006','Emperiang','610806'),('6108061007','Nanga Lot','610806'),('6108061008','Jerunjung','610806'),('6108061009','Bekuan','610806'),('6108061010','Nanga Pala','610806'),('6108071001','Kepenai Komplek','610807'),('6108071002','Entipan','610807'),('6108071003','Semitaу Hilir','610807'),('6108071004','Nanga Kepenai','610807'),('6108071005','Tua Abang','610807'),('6108071006','Nanga Lemedak','610807'),('6108071007','Nanga Seberuang','610807'),('6108071008','Kenerak','610807'),('6108071009','Semitaу Hulu','610807'),('6108081001','Semangut Utara','610808'),('6108081002','Segitak','610808'),('6108091001','Mensusai','610809'),('6108091002','Mantan','610809'),('6108091003','Nanga Suhaid','610809'),('6108091004','Tanjung Harapan','610809'),('6108101001','Pengkadan Hilir','610810'),('6108101002','Sira Jaya','610810'),('6108111001','Setunggul','610811'),('6108111002','Sungai Sena','610811'),('6108111003','Sentabai','610811'),('6108111004','Rumbih','610811'),('6108111005','Bukit Penai','610811'),('6108121001','Belimbung','610812'),('6108121002','Nanga Dangkan','610812'),('6112041001','Sungaijawi','611204'),('6112041002','Sungaibesar','611204'),('6112041003','Tasik Malaya','611204'),('6112041004','Padang Tikar Satu','611204'),('6112041005','Padang Tikar Dua','611204'),('6112041006','Batu Ampar','611204'),('6112041007','Sungai Kerawang','611204'),('6112051001','Limbung','611205'),('6112051002','Telukkapuas','611205'),('6112051003','Madu Sari','611205'),('6112061001','Durian','611206'),('6112061002','Simpang Kanan','611206'),('6112061003','Puguk','611206');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2025_09_15_143053_create_sessions_table',1);

/*Table structure for table `pembentukankecamatan` */

DROP TABLE IF EXISTS `pembentukankecamatan`;

CREATE TABLE `pembentukankecamatan` (
  `nopengajuan` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tglpengajuan` date DEFAULT NULL,
  `idpengguna` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idstatuspengajuanterakhir` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kodekecamatan` char(8) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`nopengajuan`),
  KEY `idpengguna` (`idpengguna`),
  KEY `kodekecamatan` (`kodekecamatan`),
  CONSTRAINT `pembentukankecamatan_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`),
  CONSTRAINT `pembentukankecamatan_ibfk_2` FOREIGN KEY (`kodekecamatan`) REFERENCES `kecamatan` (`kodekecamatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pembentukankecamatan` */

/*Table structure for table `pembentukanriwayat` */

DROP TABLE IF EXISTS `pembentukanriwayat`;

CREATE TABLE `pembentukanriwayat` (
  `idriwayat` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nopengajuan` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idstatuspengajuan` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglstatuspengajuan` datetime DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `idstatuspengajuannext` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusapprove` tinyint DEFAULT NULL,
  `idpengguna` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`idriwayat`),
  KEY `nopengajuan` (`nopengajuan`),
  KEY `idstatuspengajuan` (`idstatuspengajuan`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `pembentukanriwayat_ibfk_1` FOREIGN KEY (`nopengajuan`) REFERENCES `pembentukankecamatan` (`nopengajuan`),
  CONSTRAINT `pembentukanriwayat_ibfk_2` FOREIGN KEY (`idstatuspengajuan`) REFERENCES `statuspengajuan` (`idstatuspengajuan`),
  CONSTRAINT `pembentukanriwayat_ibfk_3` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pembentukanriwayat` */

/*Table structure for table `penataan` */

DROP TABLE IF EXISTS `penataan`;

CREATE TABLE `penataan` (
  `idpenataan` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namapenataan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idpenataan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penataan` */

insert  into `penataan`(`idpenataan`,`namapenataan`,`statusaktif`) values ('01','Pembentukan Kecamatan','Aktif'),('02','Penggabungan Kecamatan','Aktif'),('03','Penyesuaian Kecamatan','Aktif');

/*Table structure for table `pengajuan` */

DROP TABLE IF EXISTS `pengajuan`;

CREATE TABLE `pengajuan` (
  `idpengajuan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tglpengajuan` date DEFAULT NULL,
  `idpengguna` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `jenispengajuan` enum('Pembentukan Kecamatan','Penggabungan  Kecamatan','Penyesuaian  Kecamatan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idstatuspengajuanterakhir` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idpengajuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengajuan` */

/*Table structure for table `pengajuanriwayat` */

DROP TABLE IF EXISTS `pengajuanriwayat`;

CREATE TABLE `pengajuanriwayat` (
  `idriwayat` int NOT NULL AUTO_INCREMENT,
  `idpengajuan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idstatuspengajuan` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglstatuspengajuan` datetime DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `idstatuspengajuannext` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusapprove` tinyint(1) DEFAULT NULL COMMENT '1=approve; 2=Revisi',
  `idpengguna` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`idriwayat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengajuanriwayat` */

/*Table structure for table `pengguna` */

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna` (
  `idpengguna` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kodekabupaten` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nip` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namalengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gelardepan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gelarbelakang` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpangkat` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nomorwa` char(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nomorsk` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglsk` date DEFAULT NULL,
  `filesk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  `akseslevel` enum('Admin','Operator Kabupaten') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Operator Kabupaten',
  PRIMARY KEY (`idpengguna`),
  UNIQUE KEY `nip` (`nip`),
  UNIQUE KEY `email` (`email`),
  KEY `idpangkat` (`idpangkat`),
  KEY `kodekabupaten` (`kodekabupaten`),
  CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`idpangkat`) REFERENCES `refpangkat` (`idpangkat`),
  CONSTRAINT `pengguna_ibfk_2` FOREIGN KEY (`kodekabupaten`) REFERENCES `kabupaten` (`kodekabupaten`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengguna` */

insert  into `pengguna`(`idpengguna`,`kodekabupaten`,`nip`,`namalengkap`,`gelardepan`,`gelarbelakang`,`idpangkat`,`jabatan`,`nomorwa`,`email`,`username`,`password`,`nomorsk`,`tglsk`,`filesk`,`inserted_date`,`updated_date`,`lastlogin`,`foto`,`statusaktif`,`akseslevel`) values ('KM5JZ0','6101','000000000000000000','Admin',NULL,NULL,'301','Pranata Komputer','081200000000','admin@gmail.com',NULL,'$2y$12$juWDZbNPLfRW9PeVagsLsOF3vZplspfZQY43zqvBzPs5SDgxWvKIK','3243242','1999-01-01','surat_perjanjian_sewa_bangunan.pdf','2025-09-15 22:14:42','2025-09-15 22:14:42','2025-09-18 12:33:45',NULL,'Aktif','Operator Kabupaten');

/*Table structure for table `persyaratanadministratif` */

DROP TABLE IF EXISTS `persyaratanadministratif`;

CREATE TABLE `persyaratanadministratif` (
  `idpersyaratanadministratif` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namapersyaratanadministratif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `persyaratanadministratif` */

/*Table structure for table `persyaratanadministratifpembentukan` */

DROP TABLE IF EXISTS `persyaratanadministratifpembentukan`;

CREATE TABLE `persyaratanadministratifpembentukan` (
  `idpersyaratan` int NOT NULL AUTO_INCREMENT,
  `nopengajuan` char(12) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `filesuratkesepakatan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idpersyaratan`),
  KEY `nopengajuan` (`nopengajuan`),
  CONSTRAINT `persyaratanadministratifpembentukan_ibfk_1` FOREIGN KEY (`nopengajuan`) REFERENCES `pembentukankecamatan` (`nopengajuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `persyaratanadministratifpembentukan` */

/*Table structure for table `persyaratandasar` */

DROP TABLE IF EXISTS `persyaratandasar`;

CREATE TABLE `persyaratandasar` (
  `idpersyaratandasar` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namapersyaratandasar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `batasminimalkabupaten` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `batasminimalkota` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idpersyaratandasar`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `persyaratandasar_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `persyaratandasar` */

insert  into `persyaratandasar`(`idpersyaratandasar`,`namapersyaratandasar`,`batasminimalkabupaten`,`batasminimalkota`,`inserted_date`,`updated_date`,`idpengguna`,`statusaktif`) values ('001','Jumlah Penduduk (Jiwa)','1500','2000','2025-09-18 10:18:10','2025-09-18 10:18:10','KM5JZ0','Aktif'),('005','Jumlah KK','300','400','2025-09-18 10:18:20','2025-09-18 10:18:20','KM5JZ0','Aktif'),('010','Luas Wilayah (km2)','12.5','12.5','2025-09-18 10:18:26','2025-09-18 10:18:26','KM5JZ0','Aktif'),('015','Jumlah Desa/ Kelurahan','10','5','2025-09-18 10:18:36','2025-09-18 10:18:36','KM5JZ0','Aktif'),('020','Usia Kecamatan','5','5','2025-09-18 10:18:58','2025-09-18 10:18:58','KM5JZ0','Aktif');

/*Table structure for table `persyaratandasarpembentukan` */

DROP TABLE IF EXISTS `persyaratandasarpembentukan`;

CREATE TABLE `persyaratandasarpembentukan` (
  `idpersyaratan` int NOT NULL AUTO_INCREMENT,
  `nopengajuan` char(12) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlahpenduduk` int DEFAULT NULL,
  `jumlahpendudukminimal` int DEFAULT NULL,
  `jumlahkk` int DEFAULT NULL,
  `jumlahkkminimal` int DEFAULT NULL,
  `luaswilayah` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlahkelurahan` int DEFAULT NULL,
  `jumlahkelurahanminimal` int DEFAULT NULL,
  `filepersyaratan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idpersyaratan`),
  KEY `nopengajuan` (`nopengajuan`),
  CONSTRAINT `persyaratandasarpembentukan_ibfk_1` FOREIGN KEY (`nopengajuan`) REFERENCES `pembentukankecamatan` (`nopengajuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `persyaratandasarpembentukan` */

/*Table structure for table `persyaratanteknis` */

DROP TABLE IF EXISTS `persyaratanteknis`;

CREATE TABLE `persyaratanteknis` (
  `idpersyaratanteknis` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namapersyaratanteknis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idpersyaratanteknis`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `persyaratanteknis_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `persyaratanteknis` */

/*Table structure for table `persyaratanteknispembentukan` */

DROP TABLE IF EXISTS `persyaratanteknispembentukan`;

CREATE TABLE `persyaratanteknispembentukan` (
  `idpersyaratan` int NOT NULL AUTO_INCREMENT,
  `nopengajuan` char(12) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `filekemampuankeuangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `filesaranadanprasarana` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bataswilayah` text COLLATE utf8mb4_general_ci,
  `lokasicalonibukota` text COLLATE utf8mb4_general_ci,
  `namakecamatan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kesesuaiantataruang` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`idpersyaratan`),
  KEY `nopengajuan` (`nopengajuan`),
  CONSTRAINT `persyaratanteknispembentukan_ibfk_1` FOREIGN KEY (`nopengajuan`) REFERENCES `pembentukankecamatan` (`nopengajuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `persyaratanteknispembentukan` */

/*Table structure for table `propinsi` */

DROP TABLE IF EXISTS `propinsi`;

CREATE TABLE `propinsi` (
  `idpropinsi` int NOT NULL AUTO_INCREMENT,
  `kodepropinsi` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namapropinsi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idpropinsi`),
  UNIQUE KEY `kodepropinsi` (`kodepropinsi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `propinsi` */

/*Table structure for table `refpangkat` */

DROP TABLE IF EXISTS `refpangkat`;

CREATE TABLE `refpangkat` (
  `idpangkat` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namapangkat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `golongan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idpangkat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `refpangkat` */

insert  into `refpangkat`(`idpangkat`,`namapangkat`,`golongan`) values ('201','II/a',NULL),('202','II/b',NULL),('203','II/c',NULL),('204','II/d',NULL),('301','III/a',NULL),('302','III/b',NULL),('303','III/c',NULL),('401','IV/a',NULL),('402','IV/b',NULL),('403','IV/c',NULL),('404','IV/d',NULL);

/*Table structure for table `riwayataktifitas` */

DROP TABLE IF EXISTS `riwayataktifitas`;

CREATE TABLE `riwayataktifitas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `namapengguna` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `namatabel` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namafunction` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3017 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `riwayataktifitas` */

insert  into `riwayataktifitas`(`id`,`deskripsi`,`namapengguna`,`inserted_date`,`namatabel`,`namafunction`) values (2931,'{\"idpengguna\":\"S0FUMA\",\"kodekabupaten\":\"6103\",\"nip\":\"123\",\"namalengkap\":\"sfdsfsd\",\"gelardepan\":\"sdf\",\"gelarbelakang\":\"dsf\",\"idpangkat\":\"202\",\"jabatan\":\"sdf\",\"nomorwa\":\"34343\",\"email\":\"dsf@gmail.com\",\"username\":\"sdf\",\"password\":\"$2y$12$1rRDsU3Hrta8jmzBsjhwyON2e8ioWsufWp4qWauc2.o09CNbRN116\",\"nomorsk\":\"dsf\",\"tglsk\":\"1999-01-01\",\"foto\":null,\"filesk\":\"surat_perjanjian_sewa_bangunan5.pdf\",\"statusaktif\":\"Aktif\",\"inserted_date\":\"2025-09-15 19:17:11\",\"updated_date\":\"2025-09-15 19:17:11\"}',NULL,'2025-09-15 19:17:12','pengguna','simpanDatapengguna'),(2932,'{\"idpengguna\":\"S0FUMA\",\"kodekabupaten\":\"6103\",\"nip\":\"123\",\"namalengkap\":\"sfdsfsd\",\"gelardepan\":\"sdf\",\"gelarbelakang\":\"dsf\",\"idpangkat\":\"202\",\"jabatan\":\"sdf\",\"nomorwa\":\"34343\",\"email\":\"dsf@gmail.com\",\"username\":\"sdf\",\"password\":\"$2y$12$1rRDsU3Hrta8jmzBsjhwyON2e8ioWsufWp4qWauc2.o09CNbRN116\",\"nomorsk\":\"dsf\",\"tglsk\":\"1999-01-01\",\"filesk\":\"surat_perjanjian_sewa_bangunan5.pdf\",\"inserted_date\":\"2025-09-15 19:17:11\",\"updated_date\":\"2025-09-15 19:17:11\",\"lastlogin\":null,\"foto\":null,\"statusaktif\":\"Aktif\"}',NULL,'2025-09-15 21:42:12','pengguna','hapusDatapengguna'),(2933,'{\"idpengguna\":\"3J5VNC\",\"kodekabupaten\":\"6101\",\"nip\":\"291029019229102901\",\"namalengkap\":\"Budi\",\"gelardepan\":\"ww\",\"gelarbelakang\":\"ST\",\"idpangkat\":\"301\",\"jabatan\":\"Penata Umum\",\"nomorwa\":\"081200000000\",\"email\":\"budi@gmail.com\",\"username\":\"budi123\",\"password\":\"$2y$12$IOcwoqR6eBNyaRQqN0x3fOmjMuHkveJsowroMS.cMa4a1seplOlE.\",\"nomorsk\":\"12929100\",\"tglsk\":\"1999-01-01\",\"foto\":\"whatsapp_image_2025_08_05_at_222613.jpeg\",\"filesk\":\"surat_perjanjian_sewa_bangunan6.pdf\",\"statusaktif\":\"Aktif\",\"inserted_date\":\"2025-09-15 21:44:37\",\"updated_date\":\"2025-09-15 21:44:37\"}',NULL,'2025-09-15 21:44:37','pengguna','simpanDatapengguna'),(2934,'{\"idpengguna\":\"3J5VNC\",\"kodekabupaten\":\"6101\",\"nip\":\"291029019229102901\",\"namalengkap\":\"Budi\",\"gelardepan\":\"ww\",\"gelarbelakang\":\"ST\",\"idpangkat\":\"301\",\"jabatan\":\"Penata Umum\",\"nomorwa\":\"081200000000\",\"email\":\"budi@gmail.com\",\"username\":\"budi123\",\"password\":\"$2y$12$btIwlVLotz4EJNA9GLZ2zeV0vbv3oJlCxYVDMsgPauDj3pfr2Owqm\",\"nomorsk\":\"12929100\",\"tglsk\":\"1999-01-01\",\"foto\":\"whatsapp_image_2025_08_05_at_222613.jpeg\",\"filesk\":\"surat_perjanjian_sewa_bangunan6.pdf\",\"statusaktif\":\"Aktif\",\"inserted_date\":\"2025-09-15 21:49:02\",\"updated_date\":\"2025-09-15 21:49:02\"}',NULL,'2025-09-15 21:49:02','pengguna','updateDatapengguna'),(2935,'{\"idpengguna\":\"3J5VNC\",\"kodekabupaten\":\"6101\",\"nip\":\"291029019229102901\",\"namalengkap\":\"Budi\",\"gelardepan\":\"ww\",\"gelarbelakang\":\"ST\",\"idpangkat\":\"301\",\"jabatan\":\"Penata Umum\",\"nomorwa\":\"081200000000\",\"email\":\"budi@gmail.com\",\"username\":\"budi123\",\"password\":\"$2y$12$APx7hqaQN13BAIz074hM6.bzRSkBgqx3xP1KSIfI3LT1P6EnVux8e\",\"nomorsk\":\"12929100\",\"tglsk\":\"1999-01-01\",\"foto\":\"download.jpg\",\"filesk\":\"surat_perjanjian_sewa_bangunan6.pdf\",\"statusaktif\":\"Aktif\",\"inserted_date\":\"2025-09-15 21:50:08\",\"updated_date\":\"2025-09-15 21:50:08\"}',NULL,'2025-09-15 21:50:09','pengguna','updateDatapengguna'),(2936,'{\"idpengguna\":\"3J5VNC\",\"kodekabupaten\":\"6101\",\"nip\":\"291029019229102901\",\"namalengkap\":\"Budi\",\"gelardepan\":\"ww\",\"gelarbelakang\":\"ST\",\"idpangkat\":\"301\",\"jabatan\":\"Penata Umum\",\"nomorwa\":\"081200000000\",\"email\":\"budi@gmail.com\",\"username\":\"budi123\",\"password\":\"$2y$12$APx7hqaQN13BAIz074hM6.bzRSkBgqx3xP1KSIfI3LT1P6EnVux8e\",\"nomorsk\":\"12929100\",\"tglsk\":\"1999-01-01\",\"filesk\":\"surat_perjanjian_sewa_bangunan6.pdf\",\"inserted_date\":\"2025-09-15 21:50:08\",\"updated_date\":\"2025-09-15 21:50:08\",\"lastlogin\":null,\"foto\":\"download.jpg\",\"statusaktif\":\"Aktif\"}',NULL,'2025-09-15 21:51:17','pengguna','hapusDatapengguna'),(2937,'{\"idpengguna\":\"6YYN3B\",\"kodekabupaten\":\"6101\",\"nip\":\"000000000000000000\",\"namalengkap\":\"Admin\",\"gelardepan\":null,\"gelarbelakang\":null,\"idpangkat\":\"301\",\"jabatan\":\"Pranata Komputer Ahli\",\"nomorwa\":\"0812000000000\",\"email\":\"admin@gmail.com\",\"username\":\"admin\",\"password\":\"$2y$12$9kKOBzibyeJwlnGkHV.4N.1mFChkUfxP6hMxXxDUAoFBTOLotIrAm\",\"nomorsk\":\"012345\",\"tglsk\":\"1999-01-01\",\"foto\":\"photo_1633332755192_727a05c4013d.jpg\",\"filesk\":\"surat_perjanjian_sewa_bangunan.pdf\",\"statusaktif\":\"Aktif\",\"inserted_date\":\"2025-09-15 21:55:26\",\"updated_date\":\"2025-09-15 21:55:26\"}',NULL,'2025-09-15 21:55:27','pengguna','simpanDatapengguna'),(2938,'{\"idpengguna\":\"6YYN3B\",\"kodekabupaten\":\"6101\",\"nip\":\"000000000000000000\",\"namalengkap\":\"Admin\",\"gelardepan\":null,\"gelarbelakang\":null,\"idpangkat\":\"301\",\"jabatan\":\"Pranata Komputer Ahli\",\"nomorwa\":\"0812000000000\",\"email\":\"admin@gmail.com\",\"username\":\"admin\",\"password\":\"$2y$12$Em2ejP142g0sAiqPwH7Ypebh4YZR2JIw\\/ZhYOSimoz\\/Pu\\/xN43Igm\",\"nomorsk\":\"012345\",\"tglsk\":\"1999-01-01\",\"foto\":\"photo_1633332755192_727a05c4013d.jpg\",\"filesk\":\"surat_perjanjian_sewa_bangunan.pdf\",\"statusaktif\":\"Aktif\",\"inserted_date\":\"2025-09-15 21:56:24\",\"updated_date\":\"2025-09-15 21:56:24\"}',NULL,'2025-09-15 21:56:24','pengguna','updateDatapengguna'),(2939,'{\"idpengguna\":\"6YYN3B\",\"kodekabupaten\":\"6101\",\"nip\":\"000000000000000000\",\"namalengkap\":\"Admin\",\"gelardepan\":null,\"gelarbelakang\":null,\"idpangkat\":\"301\",\"jabatan\":\"Pranata Komputer Ahli\",\"nomorwa\":\"0812000000000\",\"email\":\"admin@gmail.com\",\"username\":\"admin\",\"password\":\"$2y$12$Em2ejP142g0sAiqPwH7Ypebh4YZR2JIw\\/ZhYOSimoz\\/Pu\\/xN43Igm\",\"nomorsk\":\"012345\",\"tglsk\":\"1999-01-01\",\"filesk\":\"surat_perjanjian_sewa_bangunan.pdf\",\"inserted_date\":\"2025-09-15 21:56:24\",\"updated_date\":\"2025-09-15 21:56:24\",\"lastlogin\":null,\"foto\":\"photo_1633332755192_727a05c4013d.jpg\",\"statusaktif\":\"Aktif\"}',NULL,'2025-09-15 22:11:46','pengguna','hapusDatapengguna'),(2940,'{\"idpengguna\":\"KM5JZ0\",\"kodekabupaten\":\"6101\",\"nip\":\"000000000000000000\",\"namalengkap\":\"Admin\",\"gelardepan\":null,\"gelarbelakang\":null,\"idpangkat\":\"301\",\"jabatan\":\"Pranata Komputer\",\"nomorwa\":\"081200000000\",\"email\":\"admin@gmail.com\",\"username\":null,\"password\":\"$2y$12$juWDZbNPLfRW9PeVagsLsOF3vZplspfZQY43zqvBzPs5SDgxWvKIK\",\"nomorsk\":\"3243242\",\"tglsk\":\"1999-01-01\",\"foto\":null,\"filesk\":\"surat_perjanjian_sewa_bangunan.pdf\",\"statusaktif\":\"Aktif\",\"inserted_date\":\"2025-09-15 22:14:42\",\"updated_date\":\"2025-09-15 22:14:42\"}',NULL,'2025-09-15 22:14:42','pengguna','simpanDatapengguna'),(2941,'{\"kodekabupaten\":\"9999\",\"namakabupaten\":\"aaaaa\"}',NULL,'2025-09-16 09:25:43','kabupaten','simpanDatakabupaten'),(2942,'{\"kodekabupaten\":\"9999\",\"namakabupaten\":\"aaaaa\"}',NULL,'2025-09-16 09:27:06','kabupaten','hapusDataKabupaten'),(2943,'{\"kodekabupaten\":\"9999\",\"namakabupaten\":\"abc\"}',NULL,'2025-09-16 09:27:25','kabupaten','simpanDataKabupaten'),(2944,'{\"kodekabupaten\":\"9999\",\"namakabupaten\":\"abc\"}',NULL,'2025-09-16 09:27:45','kabupaten','updateDataKabupaten'),(2945,'{\"kodekabupaten\":\"9999\",\"namakabupaten\":\"abcdefg\"}',NULL,'2025-09-16 09:27:56','kabupaten','updateDataKabupaten'),(2946,'{\"kodekabupaten\":\"9999\",\"namakabupaten\":\"abcdefg\"}',NULL,'2025-09-16 09:28:04','kabupaten','hapusDataKabupaten'),(2947,'{\"kodekabupaten\":\"6101\",\"kodekecamatan\":\"9999\",\"namakecamatan\":\"test\"}',NULL,'2025-09-16 11:15:40','kecamatan','simpanDataKecamatan'),(2948,'{\"kodekabupaten\":\"6101\",\"kodekecamatan\":\"9999\",\"namakecamatan\":\"test\"}',NULL,'2025-09-16 11:17:37','kecamatan','updateDataKecamatan'),(2949,'{\"kodekabupaten\":\"6101\",\"kodekecamatan\":\"9999\",\"namakecamatan\":\"test\"}',NULL,'2025-09-16 11:19:21','kecamatan','updateDataKecamatan'),(2950,'{\"kodekabupaten\":\"6101\",\"kodekecamatan\":\"9999\",\"namakecamatan\":\"test\",\"tglberdiri\":\"2025-09-16\"}',NULL,'2025-09-16 11:19:57','kecamatan','updateDataKecamatan'),(2951,'{\"kodekabupaten\":\"6101\",\"kodekecamatan\":\"9999\",\"namakecamatan\":\"test\",\"tglberdiri\":\"2025-09-16\"}',NULL,'2025-09-16 11:20:43','kecamatan','updateDataKecamatan'),(2952,'{\"kodekabupaten\":\"6101\",\"kodekecamatan\":\"9999\",\"namakecamatan\":\"test\",\"tglberdiri\":\"2025-09-16\"}',NULL,'2025-09-16 21:16:33','kecamatan','updateDataKecamatan'),(2953,'{\"kodekabupaten\":\"6101\",\"kodekecamatan\":\"232322\",\"namakecamatan\":\"test2\",\"tglberdiri\":\"2025-09-16\"}',NULL,'2025-09-16 21:17:32','kecamatan','simpanDataKecamatan'),(2954,'{\"kodekecamatan\":\"232322\",\"namakecamatan\":\"test2\",\"kodekabupaten\":\"6101\",\"tglberdiri\":\"2025-09-16\",\"namakabupaten\":\"Kabupaten Sambas\"}',NULL,'2025-09-16 21:17:44','kecamatan','hapusDataKecamatan'),(2955,'{\"kodekecamatan\":\"9999\",\"namakecamatan\":\"test\",\"kodekabupaten\":\"6101\",\"tglberdiri\":\"2025-09-16\",\"namakabupaten\":\"Kabupaten Sambas\"}',NULL,'2025-09-16 21:17:56','kecamatan','hapusDataKecamatan'),(2956,'{\"kodekabupaten\":\"6101\",\"kodekecamatan\":\"233232\",\"namakecamatan\":\"test\",\"tglberdiri\":\"2025-09-16\"}',NULL,'2025-09-16 21:35:41','kecamatan','simpanDataKecamatan'),(2957,'{\"kodekecamatan\":\"233232\",\"namakecamatan\":\"test\",\"kodekabupaten\":\"6101\",\"tglberdiri\":\"2025-09-16\",\"namakabupaten\":\"Kabupaten Sambas\"}',NULL,'2025-09-16 21:35:51','kecamatan','hapusDataKecamatan'),(2958,'{\"kodekabupaten\":\"6102\",\"kodekecamatan\":\"343434\",\"namakecamatan\":\"test\",\"tglberdiri\":\"2025-09-16\"}',NULL,'2025-09-16 21:46:25','kecamatan','simpanDataKecamatan'),(2959,'{\"kodekecamatan\":\"343434\",\"namakecamatan\":\"test\",\"kodekabupaten\":\"6102\",\"tglberdiri\":\"2025-09-16\",\"namakabupaten\":\"Kabupaten Bengkayang\"}',NULL,'2025-09-16 21:46:33','kecamatan','hapusDataKecamatan'),(2960,'{\"kodekabupaten\":\"2121\",\"namakabupaten\":\"test\"}',NULL,'2025-09-16 21:50:35','kabupaten','simpanDataKabupaten'),(2961,'{\"kodekabupaten\":\"2121\",\"namakabupaten\":\"test\"}',NULL,'2025-09-16 21:50:47','kabupaten','hapusDataKabupaten'),(2962,'{\"kodekabupaten\":\"3434\",\"namakabupaten\":\"test\"}',NULL,'2025-09-16 21:51:19','kabupaten','simpanDataKabupaten'),(2963,'{\"kodekabupaten\":\"3434\",\"namakabupaten\":\"test2\"}',NULL,'2025-09-16 21:51:29','kabupaten','updateDataKabupaten'),(2964,'{\"kodekabupaten\":\"3434\",\"namakabupaten\":\"test2\"}',NULL,'2025-09-16 21:51:37','kabupaten','hapusDataKabupaten'),(2965,'{\"kodekabupaten\":\"2323\",\"namakabupaten\":\"test\"}',NULL,'2025-09-16 21:56:21','kabupaten','simpanDataKabupaten'),(2966,'{\"kodekabupaten\":\"2323\",\"namakabupaten\":\"test\"}',NULL,'2025-09-16 21:56:34','kabupaten','hapusDataKabupaten'),(2967,'{\"kodekabupaten\":\"3343\",\"namakabupaten\":\"test\"}',NULL,'2025-09-16 21:57:02','kabupaten','simpanDataKabupaten'),(2968,'{\"kodekabupaten\":\"3343\",\"namakabupaten\":\"test\"}',NULL,'2025-09-16 21:57:12','kabupaten','hapusDataKabupaten'),(2969,'{\"kodekabupaten\":\"6102\",\"kodekecamatan\":\"232323\",\"namakecamatan\":\"test\",\"tglberdiri\":\"2025-09-16\"}',NULL,'2025-09-16 21:58:32','kecamatan','simpanDataKecamatan'),(2970,'{\"kodekecamatan\":\"232323\",\"namakecamatan\":\"test\",\"kodekabupaten\":\"6102\",\"tglberdiri\":\"2025-09-16\",\"namakabupaten\":\"Kabupaten Bengkayang\"}',NULL,'2025-09-16 21:58:42','kecamatan','hapusDataKecamatan'),(2971,'{\"kodekabupaten\":\"6101\",\"kodekecamatan\":\"344343\",\"namakecamatan\":\"test\",\"tglberdiri\":\"2025-09-16\"}',NULL,'2025-09-16 21:59:51','kecamatan','simpanDataKecamatan'),(2972,'{\"kodekecamatan\":\"344343\",\"namakecamatan\":\"test\",\"kodekabupaten\":\"6101\",\"tglberdiri\":\"2025-09-16\",\"namakabupaten\":\"Kabupaten Sambas\"}',NULL,'2025-09-16 22:00:02','kecamatan','hapusDataKecamatan'),(2973,'{\"kodekecamatan\":\"610204\",\"kodekelurahan\":\"1232312132\",\"namakelurahan\":\"test\"}',NULL,'2025-09-17 09:08:03','kelurahan','simpanDataKelurahan'),(2974,'{\"kodekelurahan\":\"1232312132\",\"namakelurahan\":\"test\",\"kodekecamatan\":\"610204\",\"namakecamatan\":\"Lumar\",\"kodekabupaten\":\"6102\",\"namakabupaten\":\"Kabupaten Bengkayang\"}',NULL,'2025-09-17 09:08:27','kelurahan','hapusDatakelurahan'),(2975,'{\"kodekecamatan\":\"610102\",\"kodekelurahan\":\"1231232132\",\"namakelurahan\":\"test\"}',NULL,'2025-09-17 09:09:02','kelurahan','simpanDataKelurahan'),(2976,'{\"kodekecamatan\":\"610102\",\"kodekelurahan\":\"1231232132\",\"namakelurahan\":\"test2\"}',NULL,'2025-09-17 09:10:58','kelurahan','updateDataKelurahan'),(2977,'{\"kodekecamatan\":\"610102\",\"kodekelurahan\":\"1231232132\",\"namakelurahan\":\"test2\"}',NULL,'2025-09-17 09:11:05','kelurahan','updateDataKelurahan'),(2978,'{\"kodekelurahan\":\"1231232132\",\"namakelurahan\":\"test2\",\"kodekecamatan\":\"610102\",\"namakecamatan\":\"Tebas\",\"kodekabupaten\":\"6101\",\"namakabupaten\":\"Kabupaten Sambas\"}',NULL,'2025-09-17 09:11:10','kelurahan','hapusDatakelurahan'),(2979,'{\"idpersyaratandasar\":\"123\",\"namapersyaratandasar\":\"test\",\"inserted_date\":\"2025-09-17 09:43:30\",\"updated_date\":\"2025-09-17 09:43:30\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 09:43:30','persyaratandasar','simpanDataPersyaratandasar'),(2980,'{\"idpersyaratandasar\":\"123\",\"namapersyaratandasar\":\"test22\",\"inserted_date\":\"2025-09-17 09:46:59\",\"updated_date\":\"2025-09-17 09:46:59\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 09:46:59','persyaratandasar','updateDataPersyaratandasar'),(2981,'{\"idpersyaratandasar\":\"123\",\"namapersyaratandasar\":\"test22\",\"batasminimalkabupaten\":null,\"batasminimalkota\":null,\"inserted_date\":\"2025-09-17 09:46:59\",\"updated_date\":\"2025-09-17 09:46:59\",\"idpengguna\":\"KM5JZ0\",\"statusaktif\":\"Aktif\"}',NULL,'2025-09-17 09:47:10','persyaratandasar','hapusDataPersyaratandasar'),(2982,'{\"idpersyaratandasar\":\"001\",\"namapersyaratandasar\":\"Tests\",\"inserted_date\":\"2025-09-17 09:48:32\",\"updated_date\":\"2025-09-17 09:48:32\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 09:48:33','persyaratandasar','simpanDataPersyaratandasar'),(2983,'{\"idpersyaratandasar\":\"001\",\"namapersyaratandasar\":\"Tests\",\"inserted_date\":\"2025-09-17 09:48:44\",\"updated_date\":\"2025-09-17 09:48:44\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 09:48:44','persyaratandasar','updateDataPersyaratandasar'),(2984,'{\"idpersyaratandasar\":\"001\",\"namapersyaratandasar\":\"Tests\",\"batasminimalkabupaten\":null,\"batasminimalkota\":null,\"inserted_date\":\"2025-09-17 09:48:44\",\"updated_date\":\"2025-09-17 09:48:44\",\"idpengguna\":\"KM5JZ0\",\"statusaktif\":\"Aktif\"}',NULL,'2025-09-17 09:48:51','persyaratandasar','hapusDataPersyaratandasar'),(2985,'{\"idpersyaratandasar\":\"001\",\"namapersyaratandasar\":\"Jumlah Kabupaten\",\"inserted_date\":\"2025-09-17 09:50:20\",\"updated_date\":\"2025-09-17 09:50:20\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 09:50:20','persyaratandasar','simpanDataPersyaratandasar'),(2986,'{\"idpersyaratandasar\":\"001\",\"namapersyaratandasar\":\"Jumlah Kabupaten 1\",\"inserted_date\":\"2025-09-17 12:46:27\",\"updated_date\":\"2025-09-17 12:46:27\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 12:46:27','persyaratandasar','updateDataPersyaratandasar'),(2987,'{\"idpersyaratandasar\":\"001\",\"namapersyaratandasar\":\"Jumlah Kabupaten 1\",\"batasminimalkabupaten\":null,\"batasminimalkota\":null,\"inserted_date\":\"2025-09-17 12:46:27\",\"updated_date\":\"2025-09-17 12:46:27\",\"idpengguna\":\"KM5JZ0\",\"statusaktif\":\"Aktif\"}',NULL,'2025-09-17 12:46:34','persyaratandasar','hapusDataPersyaratandasar'),(2988,'{\"idpersyaratandasar\":\"000\",\"namapersyaratandasar\":\"Jumlah Penduduk\",\"inserted_date\":\"2025-09-17 12:46:45\",\"updated_date\":\"2025-09-17 12:46:45\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 12:46:45','persyaratandasar','simpanDataPersyaratandasar'),(2989,'{\"idpersyaratandasar\":\"000\",\"namapersyaratandasar\":\"Jumlah Penduduk\",\"inserted_date\":\"2025-09-17 12:46:51\",\"updated_date\":\"2025-09-17 12:46:51\",\"statusaktif\":\"Tidak Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 12:46:51','persyaratandasar','updateDataPersyaratandasar'),(2990,'{\"idpersyaratandasar\":\"000\",\"namapersyaratandasar\":\"Jumlah Penduduk\",\"inserted_date\":\"2025-09-17 12:47:30\",\"updated_date\":\"2025-09-17 12:47:30\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 12:47:30','persyaratandasar','updateDataPersyaratandasar'),(2991,'{\"idpersyaratanadministratif\":\"001\",\"namapersyaratanadministratif\":\"Test\",\"inserted_date\":\"2025-09-17 12:56:43\",\"updated_date\":\"2025-09-17 12:56:43\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 12:56:43','persyaratanadministratif','simpanDataPersyaratanadministratif'),(2992,'{\"idpersyaratanadministratif\":\"001\",\"namapersyaratanadministratif\":\"Test2\",\"inserted_date\":\"2025-09-17 12:57:30\",\"updated_date\":\"2025-09-17 12:57:30\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 12:57:30','persyaratanadministratif','updateDataPersyaratanadministratif'),(2993,'{\"idpersyaratanadministratif\":\"001\",\"namapersyaratanadministratif\":\"Test2\",\"inserted_date\":\"2025-09-17 12:57:30\",\"updated_date\":\"2025-09-17 12:57:30\",\"idpengguna\":\"KM5JZ0\",\"statusaktif\":\"Aktif\"}',NULL,'2025-09-17 12:57:35','persyaratanadministratif','hapusDataPersyaratanadministratif'),(2994,'{\"idpersyaratanadministratif\":\"001\",\"namapersyaratanadministratif\":\"TES\",\"inserted_date\":\"2025-09-17 12:57:46\",\"updated_date\":\"2025-09-17 12:57:46\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 12:57:46','persyaratanadministratif','simpanDataPersyaratanadministratif'),(2995,'{\"idpersyaratanadministratif\":\"001\",\"namapersyaratanadministratif\":\"TES\",\"inserted_date\":\"2025-09-17 12:57:55\",\"updated_date\":\"2025-09-17 12:57:55\",\"statusaktif\":\"Tidak Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 12:57:55','persyaratanadministratif','updateDataPersyaratanadministratif'),(2996,'{\"idpersyaratanadministratif\":\"001\",\"namapersyaratanadministratif\":\"TES\",\"inserted_date\":\"2025-09-17 12:58:00\",\"updated_date\":\"2025-09-17 12:58:00\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 12:58:00','persyaratanadministratif','updateDataPersyaratanadministratif'),(2997,'{\"idpersyaratandasar\":\"000\",\"namapersyaratandasar\":\"Jumlah Penduduk\",\"batasminimalkabupaten\":null,\"batasminimalkota\":null,\"inserted_date\":\"2025-09-17 12:47:30\",\"updated_date\":\"2025-09-17 12:47:30\",\"idpengguna\":\"KM5JZ0\",\"statusaktif\":\"Aktif\"}',NULL,'2025-09-17 13:02:17','persyaratandasar','hapusDataPersyaratandasar'),(2998,'{\"idpersyaratandasar\":\"001\",\"namapersyaratandasar\":\"Jumlah Penduduk\",\"batasminimalkabupaten\":\"100\",\"batasminimalkota\":\"200\",\"inserted_date\":\"2025-09-17 13:02:30\",\"updated_date\":\"2025-09-17 13:02:30\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 13:02:30','persyaratandasar','simpanDataPersyaratandasar'),(2999,'{\"idpersyaratandasar\":\"001\",\"namapersyaratandasar\":\"Jumlah Penduduk\",\"batasminimalkabupaten\":\"100\",\"batasminimalkota\":\"300\",\"inserted_date\":\"2025-09-17 13:02:49\",\"updated_date\":\"2025-09-17 13:02:49\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 13:02:49','persyaratandasar','updateDataPersyaratandasar'),(3000,'{\"idpersyaratandasar\":\"001\",\"namapersyaratandasar\":\"Jumlah Penduduk\",\"batasminimalkabupaten\":\"100\",\"batasminimalkota\":\"400\",\"inserted_date\":\"2025-09-17 13:04:43\",\"updated_date\":\"2025-09-17 13:04:43\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 13:04:43','persyaratandasar','updateDataPersyaratandasar'),(3001,'{\"idpersyaratanteknis\":\"001\",\"namapersyaratanteknis\":\"tes teknis\",\"inserted_date\":\"2025-09-17 13:11:14\",\"updated_date\":\"2025-09-17 13:11:14\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 13:11:14','persyaratanteknis','simpanDataPersyaratanteknis'),(3002,'{\"idpersyaratanteknis\":\"001\",\"namapersyaratanteknis\":\"tes teknis 1\",\"inserted_date\":\"2025-09-17 13:11:21\",\"updated_date\":\"2025-09-17 13:11:21\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 13:11:21','persyaratanteknis','updateDataPersyaratanteknis'),(3003,'{\"idpersyaratanteknis\":\"001\",\"namapersyaratanteknis\":\"tes teknis 1\",\"inserted_date\":\"2025-09-17 13:11:21\",\"updated_date\":\"2025-09-17 13:11:21\",\"idpengguna\":\"KM5JZ0\",\"statusaktif\":\"Aktif\"}',NULL,'2025-09-17 13:11:27','persyaratanteknis','hapusDataPersyaratanteknis'),(3004,'{\"idpersyaratanadministratif\":\"001\",\"namapersyaratanadministratif\":\"TES\",\"inserted_date\":\"2025-09-17 12:58:00\",\"updated_date\":\"2025-09-17 12:58:00\",\"idpengguna\":\"KM5JZ0\",\"statusaktif\":\"Aktif\"}',NULL,'2025-09-17 13:11:33','persyaratanadministratif','hapusDataPersyaratanadministratif'),(3005,'{\"idpersyaratandasar\":\"001\",\"namapersyaratandasar\":\"Jumlah Penduduk\",\"batasminimalkabupaten\":\"100\",\"batasminimalkota\":\"400\",\"inserted_date\":\"2025-09-17 23:30:09\",\"updated_date\":\"2025-09-17 23:30:09\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-17 23:30:09','persyaratandasar','updateDataPersyaratandasar'),(3006,'{\"idpersyaratandasar\":\"001\",\"namapersyaratandasar\":\"Jumlah Penduduk\",\"batasminimalkabupaten\":\"1500\",\"batasminimalkota\":\"1500\",\"inserted_date\":\"2025-09-18 09:59:14\",\"updated_date\":\"2025-09-18 09:59:14\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-18 09:59:14','persyaratandasar','updateDataPersyaratandasar'),(3007,'{\"idpersyaratandasar\":\"005\",\"namapersyaratandasar\":\"Jumlah KK\",\"batasminimalkabupaten\":\"300\",\"batasminimalkota\":\"400\",\"inserted_date\":\"2025-09-18 10:01:41\",\"updated_date\":\"2025-09-18 10:01:41\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-18 10:01:41','persyaratandasar','simpanDataPersyaratandasar'),(3008,'{\"idpersyaratandasar\":\"001\",\"namapersyaratandasar\":\"Jumlah Penduduk\",\"batasminimalkabupaten\":\"1500\",\"batasminimalkota\":\"2000\",\"inserted_date\":\"2025-09-18 10:02:03\",\"updated_date\":\"2025-09-18 10:02:03\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-18 10:02:03','persyaratandasar','updateDataPersyaratandasar'),(3009,'{\"idpersyaratandasar\":\"001\",\"namapersyaratandasar\":\"Jumlah Penduduk (Jiwa)\",\"batasminimalkabupaten\":\"1500.00\",\"batasminimalkota\":\"2000.00\",\"inserted_date\":\"2025-09-18 10:12:41\",\"updated_date\":\"2025-09-18 10:12:41\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-18 10:12:41','persyaratandasar','updateDataPersyaratandasar'),(3010,'{\"idpersyaratandasar\":\"010\",\"namapersyaratandasar\":\"Luas Wilayah (km2)\",\"batasminimalkabupaten\":\"12.5\",\"batasminimalkota\":\"12.5\",\"inserted_date\":\"2025-09-18 10:16:14\",\"updated_date\":\"2025-09-18 10:16:14\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-18 10:16:14','persyaratandasar','simpanDataPersyaratandasar'),(3011,'{\"idpersyaratandasar\":\"015\",\"namapersyaratandasar\":\"Jumlah Desa\\/ Kelurahan\",\"batasminimalkabupaten\":\"10\",\"batasminimalkota\":\"5\",\"inserted_date\":\"2025-09-18 10:17:22\",\"updated_date\":\"2025-09-18 10:17:22\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-18 10:17:22','persyaratandasar','simpanDataPersyaratandasar'),(3012,'{\"idpersyaratandasar\":\"001\",\"namapersyaratandasar\":\"Jumlah Penduduk (Jiwa)\",\"batasminimalkabupaten\":\"1500\",\"batasminimalkota\":\"2000\",\"inserted_date\":\"2025-09-18 10:18:10\",\"updated_date\":\"2025-09-18 10:18:10\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-18 10:18:10','persyaratandasar','updateDataPersyaratandasar'),(3013,'{\"idpersyaratandasar\":\"005\",\"namapersyaratandasar\":\"Jumlah KK\",\"batasminimalkabupaten\":\"300\",\"batasminimalkota\":\"400\",\"inserted_date\":\"2025-09-18 10:18:20\",\"updated_date\":\"2025-09-18 10:18:20\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-18 10:18:20','persyaratandasar','updateDataPersyaratandasar'),(3014,'{\"idpersyaratandasar\":\"010\",\"namapersyaratandasar\":\"Luas Wilayah (km2)\",\"batasminimalkabupaten\":\"12.5\",\"batasminimalkota\":\"12.5\",\"inserted_date\":\"2025-09-18 10:18:26\",\"updated_date\":\"2025-09-18 10:18:26\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-18 10:18:26','persyaratandasar','updateDataPersyaratandasar'),(3015,'{\"idpersyaratandasar\":\"015\",\"namapersyaratandasar\":\"Jumlah Desa\\/ Kelurahan\",\"batasminimalkabupaten\":\"10\",\"batasminimalkota\":\"5\",\"inserted_date\":\"2025-09-18 10:18:36\",\"updated_date\":\"2025-09-18 10:18:36\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-18 10:18:36','persyaratandasar','updateDataPersyaratandasar'),(3016,'{\"idpersyaratandasar\":\"020\",\"namapersyaratandasar\":\"Usia Kecamatan\",\"batasminimalkabupaten\":\"5\",\"batasminimalkota\":\"5\",\"inserted_date\":\"2025-09-18 10:18:58\",\"updated_date\":\"2025-09-18 10:18:58\",\"statusaktif\":\"Aktif\",\"idpengguna\":\"KM5JZ0\"}',NULL,'2025-09-18 10:18:58','persyaratandasar','simpanDataPersyaratandasar');

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values ('3Z1J0YJxUejtuwNjfYcAUtXkZ8sRPzk7QYvgo2F7',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiYnR1d2IxVTF3aGRNYjVjWlRieTVGYXd2UFhUNlNJbkc1eXJ3ZXNBbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW1iZW50dWthbmtlY2FtYXRhbi90YW1iYWgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjEwOiJpZHBlbmdndW5hIjtzOjY6IktNNUpaMCI7czoxMToibmFtYWxlbmdrYXAiO3M6NToiQWRtaW4iO3M6NToiZW1haWwiO3M6MTU6ImFkbWluQGdtYWlsLmNvbSI7czo0OiJmb3RvIjtzOjM4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvaW1hZ2VzL3VzZXJzLnBuZyI7fQ==',1758185181),('xe9seLFlGsBiI5UIkWUXltiGVGo8CEcNjDcGFmHq',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiaFVvOFRUWm1jVEJuRlh0c1k5SGVuNUEyNFFxeXdQd1BUQnFtcUNKaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW1iZW50dWthbmtlY2FtYXRhbi90YW1iYWgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjEwOiJpZHBlbmdndW5hIjtzOjY6IktNNUpaMCI7czoxMToibmFtYWxlbmdrYXAiO3M6NToiQWRtaW4iO3M6NToiZW1haWwiO3M6MTU6ImFkbWluQGdtYWlsLmNvbSI7czo0OiJmb3RvIjtzOjM4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvaW1hZ2VzL3VzZXJzLnBuZyI7fQ==',1758165827);

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `prefix` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `values` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `issystem` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `settings` */

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

insert  into `statuspengajuan`(`idstatuspengajuan`,`namastatuspengajuan`,`urut`,`statusaktif`,`namastatuspengajuannext`) values ('001','Pengajuan Surat Penataan',1,'Aktif','Menunggu Verifikasi Surat di Propinsi'),('003','Verifikasi Surat di Propinsi',3,'Aktif','Menunggu Upload RAPERDA'),('005','Upload RAPERDA',5,'Aktif','Menunggu Telaah Propinsi'),('010','Telaah Propinsi',10,'Aktif','Menunggu Upload Surat Permohonan Kode'),('015','Upload Surat Pemohonan Kode',15,'Aktif','Menunggu Rekomendasi Gubernur'),('020','Upload Rekomendasi Gubernur',20,'Aktif','Mengirim Surat Ke Kemendagri'),('025','Mengirim Surat Ke Kemendagri',25,'Aktif','Menunggu Kemendagri Menerbitkan Surat'),('030','Kemendagri Menerbitkan Surat',30,'Aktif','Selesai'),('999','Selesai',99,'Aktif',NULL);

/* Function  structure for function  `create_idpengguna` */

/*!50003 DROP FUNCTION IF EXISTS `create_idpengguna` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idpengguna`() RETURNS char(6) CHARSET utf8mb4
BEGIN
    DECLARE created_id CHAR(6);
    DECLARE id_exists INT DEFAULT 1; -- Inisialisasi dengan nilai 1 (anggap ID sudah ada)
    -- Loop sampai ID unik ditemukan
    WHILE id_exists = 1 DO
        SET created_id = create_random_upper_case(6);
        -- Cek apakah ID sudah ada di tabel
        SELECT COUNT(*) INTO id_exists
        FROM pengguna
        WHERE idpengguna = created_id;
    END WHILE;
    -- Mengembalikan ID unik
    RETURN created_id;
END */$$
DELIMITER ;

/* Function  structure for function  `create_random_upper_case` */

/*!50003 DROP FUNCTION IF EXISTS `create_random_upper_case` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_random_upper_case`(`var_length` INT(11)) RETURNS varchar(255) CHARSET utf8mb4
BEGIN
    DECLARE var_return VARCHAR(255);
    DECLARE var_char CHAR(1);
    DECLARE i INT(11);
    
    -- Inisialisasi variabel
    SET var_return = '';
    SET i = 0;
    
    -- Loop untuk menghasilkan karakter acak sebanyak var_length
    WHILE i < var_length DO
        -- Menghasilkan angka acak antara 0 dan 35 (36 kemungkinan karakter: A-Z, 0-9)
        SET var_char = SUBSTRING('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', FLOOR(RAND() * 36) + 1, 1);
        
        -- Menambahkan karakter acak ke hasil
        SET var_return = CONCAT(var_return, var_char);
        
        -- Increment counter
        SET i = i + 1;
    END WHILE;
    
    -- Mengembalikan string acak
    RETURN var_return;
END */$$
DELIMITER ;

/*Table structure for table `v_kecamatan` */

DROP TABLE IF EXISTS `v_kecamatan`;

/*!50001 DROP VIEW IF EXISTS `v_kecamatan` */;
/*!50001 DROP TABLE IF EXISTS `v_kecamatan` */;

/*!50001 CREATE TABLE  `v_kecamatan`(
 `kodekecamatan` char(8) ,
 `namakecamatan` varchar(100) ,
 `kodekabupaten` char(5) ,
 `tglberdiri` date ,
 `namakabupaten` varchar(100) 
)*/;

/*Table structure for table `v_kelurahan` */

DROP TABLE IF EXISTS `v_kelurahan`;

/*!50001 DROP VIEW IF EXISTS `v_kelurahan` */;
/*!50001 DROP TABLE IF EXISTS `v_kelurahan` */;

/*!50001 CREATE TABLE  `v_kelurahan`(
 `kodekelurahan` char(13) ,
 `namakelurahan` varchar(100) ,
 `kodekecamatan` char(8) ,
 `namakecamatan` varchar(100) ,
 `kodekabupaten` char(5) ,
 `namakabupaten` varchar(100) 
)*/;

/*Table structure for table `v_pembentukankecamatan` */

DROP TABLE IF EXISTS `v_pembentukankecamatan`;

/*!50001 DROP VIEW IF EXISTS `v_pembentukankecamatan` */;
/*!50001 DROP TABLE IF EXISTS `v_pembentukankecamatan` */;

/*!50001 CREATE TABLE  `v_pembentukankecamatan`(
 `nopengajuan` char(12) ,
 `tglpengajuan` date ,
 `idpengguna` char(6) ,
 `deskripsi` text ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `idstatuspengajuanterakhir` char(3) ,
 `kodekecamatan` char(8) ,
 `namakecamatan` varchar(100) ,
 `namalengkap` varchar(100) ,
 `gelarbelakang` varchar(25) ,
 `gelardepan` varchar(25) ,
 `kodekabupaten` char(5) ,
 `namakabupaten` varchar(100) ,
 `namastatuspengajuan` varchar(255) ,
 `namastatuspengajuannext` varchar(255) 
)*/;

/*View structure for view v_kecamatan */

/*!50001 DROP TABLE IF EXISTS `v_kecamatan` */;
/*!50001 DROP VIEW IF EXISTS `v_kecamatan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_kecamatan` AS select `kecamatan`.`kodekecamatan` AS `kodekecamatan`,`kecamatan`.`namakecamatan` AS `namakecamatan`,`kecamatan`.`kodekabupaten` AS `kodekabupaten`,`kecamatan`.`tglberdiri` AS `tglberdiri`,`kabupaten`.`namakabupaten` AS `namakabupaten` from (`kecamatan` join `kabupaten` on((`kecamatan`.`kodekabupaten` = `kabupaten`.`kodekabupaten`))) */;

/*View structure for view v_kelurahan */

/*!50001 DROP TABLE IF EXISTS `v_kelurahan` */;
/*!50001 DROP VIEW IF EXISTS `v_kelurahan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_kelurahan` AS select `kelurahan`.`kodekelurahan` AS `kodekelurahan`,`kelurahan`.`namakelurahan` AS `namakelurahan`,`kelurahan`.`kodekecamatan` AS `kodekecamatan`,`kecamatan`.`namakecamatan` AS `namakecamatan`,`kecamatan`.`kodekabupaten` AS `kodekabupaten`,`kabupaten`.`namakabupaten` AS `namakabupaten` from ((`kelurahan` join `kecamatan` on((`kelurahan`.`kodekecamatan` = `kecamatan`.`kodekecamatan`))) join `kabupaten` on((`kecamatan`.`kodekabupaten` = `kabupaten`.`kodekabupaten`))) */;

/*View structure for view v_pembentukankecamatan */

/*!50001 DROP TABLE IF EXISTS `v_pembentukankecamatan` */;
/*!50001 DROP VIEW IF EXISTS `v_pembentukankecamatan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembentukankecamatan` AS select `pembentukankecamatan`.`nopengajuan` AS `nopengajuan`,`pembentukankecamatan`.`tglpengajuan` AS `tglpengajuan`,`pembentukankecamatan`.`idpengguna` AS `idpengguna`,`pembentukankecamatan`.`deskripsi` AS `deskripsi`,`pembentukankecamatan`.`inserted_date` AS `inserted_date`,`pembentukankecamatan`.`updated_date` AS `updated_date`,`pembentukankecamatan`.`idstatuspengajuanterakhir` AS `idstatuspengajuanterakhir`,`pembentukankecamatan`.`kodekecamatan` AS `kodekecamatan`,`kecamatan`.`namakecamatan` AS `namakecamatan`,`pengguna`.`namalengkap` AS `namalengkap`,`pengguna`.`gelarbelakang` AS `gelarbelakang`,`pengguna`.`gelardepan` AS `gelardepan`,`pengguna`.`kodekabupaten` AS `kodekabupaten`,`kabupaten`.`namakabupaten` AS `namakabupaten`,`statuspengajuan`.`namastatuspengajuan` AS `namastatuspengajuan`,`statuspengajuan`.`namastatuspengajuannext` AS `namastatuspengajuannext` from ((((`pembentukankecamatan` join `kecamatan` on((`pembentukankecamatan`.`kodekecamatan` = `kecamatan`.`kodekecamatan`))) left join `pengguna` on((`pembentukankecamatan`.`idpengguna` = `pengguna`.`idpengguna`))) left join `statuspengajuan` on((`pembentukankecamatan`.`idstatuspengajuanterakhir` = `statuspengajuan`.`idstatuspengajuan`))) left join `kabupaten` on((`pengguna`.`kodekabupaten` = `kabupaten`.`kodekabupaten`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
