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
  `kodekabupaten` char(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `kodekecamatan` char(8) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`kodekelurahan`),
  KEY `kodekecamatan` (`kodekecamatan`),
  CONSTRAINT `kelurahan_ibfk_1` FOREIGN KEY (`kodekecamatan`) REFERENCES `kecamatan` (`kodekecamatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kelurahan` */

insert  into `kelurahan`(`kodekelurahan`,`namakelurahan`,`kodekecamatan`) values ('6101031001','Sungai Rusa','610103'),('6101031002','Pangkalan Bemban','610103'),('6101031003','Sungai Nyirih','610103'),('6101041001','Ratu Sepudak','610104'),('6101041002','Sungai Palah','610104'),('6101041003','Sagu','610104'),('6101051001','Tekarang','610105'),('6101051002','Sempadian','610105'),('6101051003','Cepala','610105'),('6102041001','Seran Selimbau','610204'),('6102051001','Tapen','610205'),('6102051002','Kelayu','610205'),('6103011001','Pak Mayam','610301'),('6103011002','Sebirang','610301'),('6103011003','Ambayo Selatan','610301'),('6103011004','Hilir Kantor','610301'),('6103011005','Ambayo Inti','610301'),('6103011006','Ambayo Utara','610301'),('6103021001','Rees','610302'),('6103021002','Tempoak','610302'),('6103031001','Sampuro','610303'),('6103041001','Ongkol Padang','610304'),('6103041002','Taas','610304'),('6103041003','Mamek','610304'),('6103041004','Anik Dingir','610304'),('6103041005','Sungai Lubang','610304'),('6103041006','Tolok','610304'),('6103041007','Ansang','610304'),('6103041008','Angkaras','610304'),('6103041009','Songga','610304'),('6103041010','Lintah Betung','610304'),('6103041011','Sidan','610304'),('6103041012','Berinang Mayun','610304'),('6103051001','Aur Sampuk','610305'),('6103051002','Senakin','610305'),('6103051003','Palaoan','610305'),('6103061001','Nyiin','610306'),('6103061002','Papung','610306'),('6103061003','Sekais','610306'),('6104011001','Toho Hilir','610401'),('6104021001','Pentek','610402'),('6104021002','Sekabuk','610402'),('6104031001','Segedong Baru','610403'),('6104031002','Segedong Lama','610403'),('6104041001','Pasiran','610404'),('6104041002','Mempawah Kota','610404'),('6104041003','Sungai Asam','610404'),('6105011001','Beringin','610501'),('6105011002','Bunut','610501'),('6105011003','Lape','610501'),('6105011004','Tapang Dulang','610501'),('6105011005','Botuh Lintang','610501'),('6105021001','Suka Gerundi','610502'),('6105021002','Suka Mulya','610502'),('6105021003','Palem Jaya','610502'),('6105021004','Pusat Damai','610502'),('6105021005','Sebara','610502'),('6105021006','Hibun','610502'),('6105091001','Selampung','610509'),('6105091002','Sape','610509'),('6105091003','Semirau','610509'),('6106021001','Riam Dadap','610602'),('6106021002','Sekukun','610602'),('6106021003','Batu Lapis','610602'),('6106051001','Paoh Concong','610605'),('6106051002','Legong','610605'),('6106051003','Kenanga','610605'),('6107031001','Nanga Bihe','610703'),('6107031002','Nanga Tekungai','610703'),('6107031003','Talian Sahabung','610703'),('6107031004','Batu Ketebung','610703'),('6107031005','Muara Kota','610703'),('6107031006','Mekar Sari','610703'),('6107051001','Setungkup','610705'),('6107051002','Nanga Ketungau','610705'),('6107081001','Temiang Kapuas','610708'),('6107081002','Ensabang','610708'),('6107081003','Buluh Kuning','610708'),('6107081004','Temawang Muntai','610708'),('6107081005','Tawang Sari','610708'),('6107081006','Gernis Jaya','610708'),('6107081007','Paoh Benua','610708'),('6107081008','Bedayan','610708'),('6107081009','Tanjung Hulu','610708'),('6107081010','Sukau Bersatu','610708'),('6107081011','Kemantan','610708'),('6107081012','Peninsung','610708'),('6107081013','Sepulut','610708'),('6107081014','Temawang Bulai','610708'),('6107081015','Sungai Segak','610708'),('6107081016','Riam Kempadik','610708'),('6107081017','Nanga Layung','610708'),('6107081018','Limau Bakti','610708'),('6108011001','Ingko Tambe','610801'),('6108011002','Sayut','610801'),('6108011003','Beringin Jaya','610801'),('6108011004','Bungan Jaya','610801'),('6108011005','Tanjunglokang','610801'),('6108011006','Urang Unsa','610801'),('6108011007','Kedamin Darat','610801'),('6108011008','Tanjung Jati','610801'),('6108011009','Sungai Uluk','610801'),('6108011010','Kedamin Hilir','610801'),('6108021001','Putussibau Kota','610802'),('6108021002','Pala Pulau','610802'),('6108021003','Nanga Sambus','610802'),('6108021004','Ariung Mendalam','610802'),('6108031001','Seriang','610803'),('6108031002','Badau','610803'),('6108031003','Sebindang','610803'),('6108031004','Tinting Seligi','610803'),('6108031005','Tajum','610803'),('6108041001','Setulang','610804'),('6108041002','Labian Ira`ang','610804'),('6108051001','Pulau Manak','610805'),('6108061001','Ranyai','610806'),('6108061002','Bati','610806'),('6108061003','Seneban','610806'),('6108061004','Belikai','610806'),('6108061005','Pala Kota','610806'),('6108061006','Emperiang','610806'),('6108061007','Nanga Lot','610806'),('6108061008','Jerunjung','610806'),('6108061009','Bekuan','610806'),('6108061010','Nanga Pala','610806'),('6108071001','Kepenai Komplek','610807'),('6108071002','Entipan','610807'),('6108071003','Semitaу Hilir','610807'),('6108071004','Nanga Kepenai','610807'),('6108071005','Tua Abang','610807'),('6108071006','Nanga Lemedak','610807'),('6108071007','Nanga Seberuang','610807'),('6108071008','Kenerak','610807'),('6108071009','Semitaу Hulu','610807'),('6108081001','Semangut Utara','610808'),('6108081002','Segitak','610808'),('6108091001','Mensusai','610809'),('6108091002','Mantan','610809'),('6108091003','Nanga Suhaid','610809'),('6108091004','Tanjung Harapan','610809'),('6108101001','Pengkadan Hilir','610810'),('6108101002','Sira Jaya','610810'),('6108111001','Setunggul','610811'),('6108111002','Sungai Sena','610811'),('6108111003','Sentabai','610811'),('6108111004','Rumbih','610811'),('6108111005','Bukit Penai','610811'),('6108121001','Belimbung','610812'),('6108121002','Nanga Dangkan','610812'),('6112041001','Sungaijawi','611204'),('6112041002','Sungaibesar','611204'),('6112041003','Tasik Malaya','611204'),('6112041004','Padang Tikar Satu','611204'),('6112041005','Padang Tikar Dua','611204'),('6112041006','Batu Ampar','611204'),('6112041007','Sungai Kerawang','611204'),('6112051001','Limbung','611205'),('6112051002','Telukkapuas','611205'),('6112051003','Madu Sari','611205'),('6112061001','Durian','611206'),('6112061002','Simpang Kanan','611206'),('6112061003','Puguk','611206');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
