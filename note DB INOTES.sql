-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 12, 2024 at 03:15 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `note`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `Sno.` int NOT NULL AUTO_INCREMENT,
  `title` varchar(111) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tstamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Sno.`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`Sno.`, `title`, `Description`, `tstamp`) VALUES
(26, 'frefrefrefr', 'fefefewfewfwe', '2024-08-11 22:54:51'),
(25, 'defefrfr', 'ffefefrefe', '2024-08-11 22:54:45'),
(24, 'defrfrfr', 'defefefref', '2024-08-11 22:54:37'),
(23, 'dswddwdeddeefe', 'dedede', '2024-08-11 22:54:30'),
(21, 'fiufuiuirefiure', 'djcreugfure', '2024-08-11 22:54:09'),
(20, 'gdugfuregfu', 'heeiuffrhfr', '2024-08-11 22:54:01'),
(19, 'fjrefurfr', 'ewjfewfk', '2024-08-11 22:53:55'),
(18, 'hfeuifewu', '\r\nfheifreifrew', '2024-08-11 22:53:43'),
(27, 'frfrecxzcdscewzcczcz', 'cdsrgtrhyjukiuloulkmnn', '2024-08-11 22:55:01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
