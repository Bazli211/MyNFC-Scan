-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.5.2-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for nfc_sticker
CREATE DATABASE IF NOT EXISTS `nfc_sticker` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `nfc_sticker`;

-- Dumping structure for table nfc_sticker.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table nfc_sticker.fines
CREATE TABLE IF NOT EXISTS `fines` (
  `fine_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_matricNum` varchar(255) NOT NULL,
  `sticker_id` varchar(255) NOT NULL,
  `fine_date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `fine_time` time NOT NULL,
  `comment` varchar(255) NOT NULL,
  `kesalahan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`kesalahan`)),
  `vehicle_type` varchar(50) NOT NULL DEFAULT '',
  `vehicle_brand` varchar(50) NOT NULL DEFAULT '',
  `session` varchar(50) NOT NULL DEFAULT '',
  `nama_pelajar` varchar(50) NOT NULL DEFAULT '',
  `kod_program` varchar(50) NOT NULL DEFAULT '',
  `fakulti` varchar(50) NOT NULL DEFAULT '',
  `kolej` varchar(50) NOT NULL DEFAULT '',
  `di_kunci_di_saman` varchar(50) NOT NULL DEFAULT '',
  `dikompaun` varchar(50) DEFAULT NULL,
  `compounded_expiration` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`fine_id`),
  KEY `FK_fines_stickers` (`sticker_id`),
  KEY `FK_fines_vehicles` (`student_matricNum`),
  CONSTRAINT `FK_fines_stickers` FOREIGN KEY (`sticker_id`) REFERENCES `stickers` (`unique_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_fines_users` FOREIGN KEY (`student_matricNum`) REFERENCES `users` (`matric_number`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_fines_vehicles` FOREIGN KEY (`student_matricNum`) REFERENCES `vehicles` (`student_matricNumber`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table nfc_sticker.fine_status
CREATE TABLE IF NOT EXISTS `fine_status` (
  `status_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_matricNumber` varchar(255) NOT NULL,
  `fine_details` varchar(255) NOT NULL,
  `fine_date` date NOT NULL,
  `fine_time` time NOT NULL,
  `fine_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`status_id`),
  KEY `FK_fine_status_fines` (`student_matricNumber`),
  CONSTRAINT `FK_fine_status_fines` FOREIGN KEY (`student_matricNumber`) REFERENCES `fines` (`student_matricNum`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table nfc_sticker.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table nfc_sticker.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table nfc_sticker.stickers
CREATE TABLE IF NOT EXISTS `stickers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(50) NOT NULL,
  `student_matricNumber` varchar(255) NOT NULL,
  `status_sticker` varchar(255) NOT NULL DEFAULT '' COMMENT '''REQUESTED'',''PENDING'',''APPROVED'',''COMPLETED''',
  `validity_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `unique_id` (`unique_id`),
  KEY `FK_sticker_users` (`student_matricNumber`),
  CONSTRAINT `FK_sticker_users` FOREIGN KEY (`student_matricNumber`) REFERENCES `users` (`matric_number`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table nfc_sticker.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `matric_number` varchar(255) DEFAULT NULL,
  `staff_id` varchar(50) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kod_program` varchar(255) NOT NULL,
  `fakulti` varchar(255) NOT NULL,
  `kolej` varchar(255) NOT NULL,
  `telephoneNum` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `matric_number` (`matric_number`),
  UNIQUE KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table nfc_sticker.vehicles
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vehiclePlateNum` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `vehicle_type` varchar(50) NOT NULL COMMENT 'motorcycle, car',
  `vehicle_brand` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sticker_date` date NOT NULL,
  `vehicle_color` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `roadtax_date` date NOT NULL,
  `student_matricNumber` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_register` varchar(255) DEFAULT NULL COMMENT 'Registered, Request, Denied, Accept',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vehiclePlateNum` (`vehiclePlateNum`),
  UNIQUE KEY `student_matricNumber` (`student_matricNumber`),
  CONSTRAINT `FK_vehicles_users` FOREIGN KEY (`student_matricNumber`) REFERENCES `users` (`matric_number`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
