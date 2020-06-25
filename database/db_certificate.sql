-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for db_certificate
CREATE DATABASE IF NOT EXISTS `db_certificate` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_certificate`;


-- Dumping structure for table db_certificate.tbl_attenders
CREATE TABLE IF NOT EXISTS `tbl_attenders` (
  `attenders_id` int(11) NOT NULL AUTO_INCREMENT,
  `attenders_number` varchar(50) DEFAULT NULL,
  `attenders_name` varchar(50) DEFAULT NULL,
  `attenders_as` varchar(50) DEFAULT NULL,
  `attenders_email` varchar(50) DEFAULT NULL,
  `attenders_nim` varchar(50) DEFAULT NULL,
  `attenders_surveykepuasan` text DEFAULT NULL,
  `attenders_saranperbaikan` text DEFAULT NULL,
  `attenders_trainingyangdiharapkan` text DEFAULT NULL,
  `attenders_qr` text DEFAULT NULL,
  PRIMARY KEY (`attenders_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.


-- Dumping structure for table db_certificate.tbl_email
CREATE TABLE IF NOT EXISTS `tbl_email` (
  `id_email` int(11) NOT NULL AUTO_INCREMENT,
  `host_email` varchar(50) DEFAULT NULL,
  `port_email` varchar(50) DEFAULT NULL,
  `account_email` varchar(50) DEFAULT NULL,
  `password_email` varchar(50) DEFAULT NULL,
  `crypto_email` varchar(50) DEFAULT NULL,
  `protocol_email` varchar(50) DEFAULT NULL,
  `from_email` varchar(50) DEFAULT NULL,
  `noreply_email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
