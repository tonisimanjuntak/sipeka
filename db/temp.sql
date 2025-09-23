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

/*Table structure for table `penataan` */

DROP TABLE IF EXISTS `penataan`;

CREATE TABLE `penataan` (
  `nopengajuan` CHAR(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tglpengajuan` DATE DEFAULT NULL,
  `idpengguna` CHAR(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `inserted_date` DATETIME DEFAULT NULL,
  `updated_date` DATETIME DEFAULT NULL,
  `idstatuspengajuanterakhir` CHAR(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kodekecamatan` CHAR(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `filesuratpengantar` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglverifikasipropinsi` DATE DEFAULT NULL,
  `nomorraperda` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglraperda` DATE DEFAULT NULL,
  `fileraperda` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nomorregister` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglregister` DATE DEFAULT NULL,
  `filetelaahanhukum` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `filetelaahanteknis` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nopermohonankode` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglpermohonankode` DATE DEFAULT NULL,
  `filepermohonankode` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `norekomendasigubernur` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglrekomendasigubernur` DATE DEFAULT NULL,
  `filerekomendasigubernur` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglkirimsuratkekemendagri` DATE DEFAULT NULL,
  `nomorskkemendagri` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglskkemendagri` DATE DEFAULT NULL,
  `fileskkemendagri` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenispenataan` ENUM('Pembentukan','Penggabungan','Penyesuaian') COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`nopengajuan`),
  KEY `idpengguna` (`idpengguna`),
  KEY `kodekecamatan` (`kodekecamatan`),
  CONSTRAINT `penataan_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`),
  CONSTRAINT `penataan_ibfk_2` FOREIGN KEY (`kodekecamatan`) REFERENCES `kecamatan` (`kodekecamatan`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penataan` */

/*Table structure for table `penataankelurahanterpilih` */

DROP TABLE IF EXISTS `penataankelurahanterpilih`;

CREATE TABLE `penataankelurahanterpilih` (
  `kelurahanterpilihid` INT NOT NULL AUTO_INCREMENT,
  `nopengajuan` CHAR(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kodekelurahan` CHAR(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlahpenduduk` INT DEFAULT NULL,
  `jumlahpendudukminimal` INT DEFAULT NULL,
  `jumlahkk` INT DEFAULT NULL,
  `jumlahkkminimal` INT DEFAULT NULL,
  `luaswilayah` DECIMAL(18,2) DEFAULT NULL,
  `luaswilayahminimal` DECIMAL(18,2) DEFAULT NULL,
  PRIMARY KEY (`kelurahanterpilihid`),
  KEY `kodekelurahan` (`kodekelurahan`),
  KEY `nopengajuan` (`nopengajuan`),
  CONSTRAINT `penataankelurahanterpilih_ibfk_1` FOREIGN KEY (`kodekelurahan`) REFERENCES `kelurahan` (`kodekelurahan`),
  CONSTRAINT `penataankelurahanterpilih_ibfk_2` FOREIGN KEY (`nopengajuan`) REFERENCES `penataan` (`nopengajuan`)
) ENGINE=INNODB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penataankelurahanterpilih` */

/*Table structure for table `penataanpersyaratanadministratif` */

DROP TABLE IF EXISTS `penataanpersyaratanadministratif`;

CREATE TABLE `penataanpersyaratanadministratif` (
  `idpersyaratan` INT NOT NULL AUTO_INCREMENT,
  `nopengajuan` CHAR(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `filesuratkesepakatan` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idpersyaratan`),
  KEY `nopengajuan` (`nopengajuan`),
  CONSTRAINT `penataanpersyaratanadministratif_ibfk_1` FOREIGN KEY (`nopengajuan`) REFERENCES `penataan` (`nopengajuan`)
) ENGINE=INNODB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penataanpersyaratanadministratif` */

/*Table structure for table `penataanpersyaratandasar` */

DROP TABLE IF EXISTS `penataanpersyaratandasar`;

CREATE TABLE `penataanpersyaratandasar` (
  `idpersyaratan` INT NOT NULL AUTO_INCREMENT,
  `nopengajuan` CHAR(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlahkelurahan` INT DEFAULT NULL,
  `jumlahkelurahanminimal` INT DEFAULT NULL,
  `filepersyaratan` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idpersyaratan`),
  KEY `nopengajuan` (`nopengajuan`),
  CONSTRAINT `penataanpersyaratandasar_ibfk_1` FOREIGN KEY (`nopengajuan`) REFERENCES `penataan` (`nopengajuan`)
) ENGINE=INNODB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penataanpersyaratandasar` */

/*Table structure for table `penataanpersyaratanteknis` */

DROP TABLE IF EXISTS `penataanpersyaratanteknis`;

CREATE TABLE `penataanpersyaratanteknis` (
  `idpersyaratan` INT NOT NULL AUTO_INCREMENT,
  `nopengajuan` CHAR(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `filekemampuankeuangan` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `filesaranadanprasarana` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bataswilayah` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `lokasicalonibukota` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `namakecamatan` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kesesuaiantataruang` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `perbupbataswilayah` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idpersyaratan`),
  KEY `nopengajuan` (`nopengajuan`),
  CONSTRAINT `penataanpersyaratanteknis_ibfk_1` FOREIGN KEY (`nopengajuan`) REFERENCES `penataan` (`nopengajuan`)
) ENGINE=INNODB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penataanpersyaratanteknis` */

/*Table structure for table `penataanriwayat` */

DROP TABLE IF EXISTS `penataanriwayat`;

CREATE TABLE `penataanriwayat` (
  `idriwayat` CHAR(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nopengajuan` CHAR(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idstatuspengajuan` CHAR(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglstatuspengajuan` DATE DEFAULT NULL,
  `deskripsi` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `idstatuspengajuannext` CHAR(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusapprove` TINYINT DEFAULT NULL,
  `idpengguna` CHAR(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` DATETIME DEFAULT NULL,
  PRIMARY KEY (`idriwayat`),
  KEY `nopengajuan` (`nopengajuan`),
  KEY `idstatuspengajuan` (`idstatuspengajuan`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `penataanriwayat_ibfk_1` FOREIGN KEY (`nopengajuan`) REFERENCES `penataan` (`nopengajuan`),
  CONSTRAINT `penataanriwayat_ibfk_2` FOREIGN KEY (`idstatuspengajuan`) REFERENCES `statuspengajuan` (`idstatuspengajuan`),
  CONSTRAINT `penataanriwayat_ibfk_3` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penataanriwayat` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
