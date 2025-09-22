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

/*Table structure for table `tempkecsambas` */

DROP TABLE IF EXISTS `tempkecsambas`;

CREATE TABLE `tempkecsambas` (
  `Kode Desa` double DEFAULT NULL,
  `Nama Desa` varchar(255) DEFAULT NULL,
  `Kode Kecamatan` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Data for the table `tempkecsambas` */

insert  into `tempkecsambas`(`Kode Desa`,`Nama Desa`,`Kode Kecamatan`) values (61010101,'Desa Dalam Kaum',610101),(61010102,'Desa  Durian',610101),(61010103,'Desa Gapura',610101),(61010104,'Desa Jagur',610101),(61010105,'Desa Kartiasa',610101),(61010106,'Desa Lorong',610101),(61010107,'Desa Lubuk Dagang',610101),(61010108,'Desa Lumbang',610101),(61010109,'Desa Pasar Melayu',610101),(61010110,'Desa Pendawan',610101),(61010111,'Desa Saing Rambi',610101),(61010112,'Desa Sebayan',610101),(61010113,'Desa Semangau',610101),(61010114,'Desa Sumber Harapan',610101),(61010115,'Desa Sungai Rambah',610101),(61010116,'Desa Tanjung Bugis',610101),(61010117,'Desa Tanjung Mekar',610101),(61010118,'Desa Tumuk Manggis',610101);

/*Table structure for table `tempkectebas` */

DROP TABLE IF EXISTS `tempkectebas`;

CREATE TABLE `tempkectebas` (
  `Kode Desa` double DEFAULT NULL,
  `Nama Desa` varchar(255) DEFAULT NULL,
  `Kode Kecamatan` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Data for the table `tempkectebas` */

insert  into `tempkectebas`(`Kode Desa`,`Nama Desa`,`Kode Kecamatan`) values (61010401,'Desa Tebas Kuala',610104),(61010402,'Desa Tebas Sungai',610104),(61010403,'Desa Sempalai',610104),(61010404,'Desa Bekut',610104),(61010405,'Desa Sejiram',610104),(61010406,'Desa Makrampai',610104),(61010407,'Desa Dungun Perapakan',610104),(61010408,'Desa Mekar Sekuntum',610104),(61010409,'Desa Mensere',610104),(61010410,'Desa Sungai Kelambu',610104),(61010411,'Desa Serindang',610104),(61010412,'Desa Matang Labong',610104),(61010413,'Desa Serumpun Buluh',610104),(61010414,'Desa Pusaka',610104),(61010415,'Desa Mak Tangguk',610104),(61010416,'Desa Pangkalan Kongsi',610104),(61010417,'Desa Batu Mak Jage',610104),(61010418,'Desa Bukit Segoler',610104),(61010419,'Desa Segedong',610104),(61010420,'Desa Seberkat',610104),(61010421,'Desa Segarau Parit',610104),(61010422,'Desa Maribas',610104),(61010423,'Desa Seret Ayon',610104);

/*Table structure for table `tempkectelukkeramat` */

DROP TABLE IF EXISTS `tempkectelukkeramat`;

CREATE TABLE `tempkectelukkeramat` (
  `Kode Desa` double DEFAULT NULL,
  `Nama Desa` varchar(255) DEFAULT NULL,
  `Kode Kecamatan` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Data for the table `tempkectelukkeramat` */

insert  into `tempkectelukkeramat`(`Kode Desa`,`Nama Desa`,`Kode Kecamatan`) values (61010201,'Desa Sungai Kumpai',610102),(61010202,'Desa Sekura',610102),(61010203,'Desa Tri Mandayan',610102),(61010204,'Desa Pedada',610102),(61010205,'Desa Lela',610102),(61010206,'Desa Puringan',610102),(61010207,'Desa Berlimang',610102),(61010208,'Desa Sungai Baru',610102),(61010209,'Desa Sengawang',610102),(61010210,'Desa Teluk Kaseh',610102),(61010211,'Desa Sepadu',610102),(61010212,'Desa Tambatan',610102),(61010213,'Desa Kubangga',610102),(61010214,'Desa Sungai Serabek',610102),(61010215,'Desa Sayang Sedayu',610102),(61010216,'Desa Pipit Teja',610102),(61010217,'Desa Matang Segantar',610102),(61010218,'Desa Mulia',610102),(61010219,'Desa Teluk Kembang',610102),(61010220,'Desa Samustida',610102),(61010221,'Desa Tanjung Kerucut',610102),(61010222,'Desa Sebagu',610102),(61010223,'Desa Mekar Sekuntum',610102),(61010224,'Desa Kuala Pangkalan Keramat',610102),(61010225,'Desa Sabing',610102);

/*Table structure for table `tempsambas` */

DROP TABLE IF EXISTS `tempsambas`;

CREATE TABLE `tempsambas` (
  `Kode Kecamatan` double DEFAULT NULL,
  `Nama Kecamatan` varchar(255) DEFAULT NULL,
  `Tanggal Berdiri` timestamp NULL DEFAULT NULL,
  `Kode Kabupaten` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Data for the table `tempsambas` */

insert  into `tempsambas`(`Kode Kecamatan`,`Nama Kecamatan`,`Tanggal Berdiri`,`Kode Kabupaten`) values (610101,'Sambas','0000-00-00 00:00:00',6101),(610102,'Teluk Keramat','0000-00-00 00:00:00',6101),(610103,'Jawai','0000-00-00 00:00:00',6101),(610104,'Tebas','0000-00-00 00:00:00',6101),(610105,'Pemangkat','0000-00-00 00:00:00',6101),(610106,'Sejangkung','0000-00-00 00:00:00',6101),(610107,'Selakau','0000-00-00 00:00:00',6101),(610108,'Paloh','0000-00-00 00:00:00',6101),(610109,'Sajingan Besar','0000-00-00 00:00:00',6101),(610110,'Subah','0000-00-00 00:00:00',6101),(610111,'Galing','0000-00-00 00:00:00',6101),(610112,'Tekarang','0000-00-00 00:00:00',6101),(610113,'Semparuk','0000-00-00 00:00:00',6101),(610114,'Sajad','0000-00-00 00:00:00',6101),(610115,'Sebawi','0000-00-00 00:00:00',6101),(610116,'Jawai Selatan','0000-00-00 00:00:00',6101),(610117,'Tangaran','0000-00-00 00:00:00',6101),(610118,'Salatiga','0000-00-00 00:00:00',6101),(610119,'Selakau Timur','0000-00-00 00:00:00',6101);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
