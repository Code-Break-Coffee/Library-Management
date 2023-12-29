-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 07, 2023 at 06:50 AM
-- Server version: 8.0.32
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `User_level` varchar(10) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Username`, `Password`, `User_level`) VALUES
('admin', '$2y$10$0Qcfoc394YkzFWpvuZx9y.9UOv1iehsmu5rTB54dcZgBS2.KaIYxW', 'Admin'),
('admin1', '$2y$10$FKhUMYl2yeiaLM09k1B1eu4kT7rDn61J1.4esFiAJ2mYNb9phIyNC', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `Book_No` int NOT NULL,
  `Author1` varchar(50) NOT NULL,
  `Author2` varchar(50) DEFAULT NULL,
  `Author3` varchar(50) DEFAULT NULL,
  `Title` varchar(30) NOT NULL,
  `Edition` varchar(15) NOT NULL,
  `Publisher` varchar(50) NOT NULL,
  `Cl_No` double NOT NULL,
  `Total_Pages` int DEFAULT NULL,
  `Cost` int DEFAULT NULL,
  `Supplier` varchar(50) DEFAULT NULL,
  `Remark` varchar(45) DEFAULT NULL,
  `Bill_No` varchar(20) DEFAULT NULL,
  `Status` varchar(20) DEFAULT 'Available',
  PRIMARY KEY (`Book_No`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`Book_No`, `Author1`, `Author2`, `Author3`, `Title`, `Edition`, `Publisher`, `Cl_No`, `Total_Pages`, `Cost`, `Supplier`, `Remark`, `Bill_No`, `Status`) VALUES
(100, 'Author Book', 'Author 2', 'NPC', 'CPP', '0', 'Open.org', 0, 666, 6000, NULL, NULL, NULL, 'IT2K2125'),
(99, 'Author Book', 'Author 2', 'NPC', 'Fluter', '9', 'Open.org', 9, 666, 6000, NULL, NULL, NULL, 'Available'),
(98, 'Author Book', 'Author 2', 'NPC', 'Android', '8', 'Open.org', 8, 666, 6000, NULL, NULL, NULL, 'IT2K2125'),
(96, 'Author Book', 'Author 2', 'NPC', 'Sys. Prog', '6', 'Open.org', 6, 666, 6000, NULL, NULL, NULL, 'Available'),
(97, 'Author Book', 'Author 2', 'NPC', 'React', '7', 'Open.org', 7, 666, 6000, NULL, NULL, NULL, 'Available'),
(95, 'Author Book', 'Author 2', 'NPC', 'Fortron', '5', 'Open.org', 5, 666, 6000, NULL, NULL, NULL, 'Available'),
(93, 'Author Book', 'Author 2', 'NPC', 'JS', '3', 'Open.org', 3, 666, 6000, NULL, NULL, NULL, 'Available'),
(94, 'Author Book', 'Author 2', 'NPC', 'PHP', '4', 'Open.org', 4, 666, 6000, NULL, NULL, NULL, 'Available'),
(90, 'Author Book', 'Author 2', 'NPC', 'CPP', '0', 'Open.org', 0, 666, 6000, NULL, NULL, NULL, 'FID10'),
(91, 'Author Book', 'Author 2', 'NPC', 'Java', '1', 'Open.org', 1, 666, 6000, NULL, NULL, NULL, 'Available'),
(92, 'Author Book', 'Author 2', 'NPC', 'Python', '2', 'Open.org', 2, 666, 6000, NULL, NULL, NULL, 'Available'),
(89, 'Author Book', 'Author 2', 'NPC', 'Fluter', '9', 'Open.org', 9, 666, 6000, NULL, NULL, NULL, 'Available'),
(88, 'Android', 'Author 2', 'NPC', 'Android', '8', 'Open.org', 8, 666, 6000, NULL, NULL, NULL, 'Available'),
(87, 'Author Book', 'Author 2', 'NPC', 'React', '7', 'Open.org', 7, 666, 6000, NULL, NULL, NULL, 'Available'),
(86, 'Author Book', 'Author 2', 'NPC', 'Sys. Prog', '6', 'Open.org', 6, 666, 6000, NULL, NULL, NULL, 'Available'),
(85, 'Author Book', 'Author 2', 'NPC', 'Fortron', '5', 'Open.org', 5, 666, 6000, NULL, NULL, NULL, 'Available'),
(84, 'Author Book', 'Author 2', 'NPC', 'PHP', '4', 'Open.org', 4, 666, 6000, NULL, NULL, NULL, 'IT2K2125'),
(83, 'Author Book', 'Author 2', 'NPC', 'JS', '3', 'Open.org', 3, 666, 6000, NULL, NULL, NULL, 'Available'),
(82, 'Author Book', 'Author 2', 'NPC', 'Python', '2', 'Open.org', 2, 666, 6000, NULL, NULL, NULL, 'Available'),
(81, 'Author Book', 'Author 2', 'NPC', 'Java', '1', 'Open.org', 1, 666, 6000, NULL, NULL, NULL, 'Available'),
(80, 'Author Book', 'Author 2', 'NPC', 'CPP', '0', 'Open.org', 0, 666, 6000, NULL, NULL, NULL, 'Available'),
(79, 'Author Book', 'Author 2', 'NPC', 'Fluter', '9', 'Open.org', 9, 666, 6000, NULL, NULL, NULL, 'Available'),
(78, 'Author Book', 'Author 2', 'NPC', 'Android', '8', 'Open.org', 8, 666, 6000, NULL, NULL, NULL, 'Available'),
(77, 'Author Book', 'Author 2', 'NPC', 'React', '7', 'Open.org', 7, 666, 6000, NULL, NULL, NULL, 'Available'),
(76, 'Author Book', 'Author 2', 'NPC', 'Sys. Prog', '6', 'Open.org', 6, 666, 6000, NULL, NULL, NULL, 'Available'),
(75, 'Author Book', 'Author 2', 'NPC', 'Fortron', '5', 'Open.org', 5, 666, 6000, NULL, NULL, NULL, 'Available'),
(74, 'Author Book', 'Author 2', 'NPC', 'PHP', '4', 'Open.org', 4, 666, 6000, NULL, NULL, NULL, 'Available'),
(73, 'Author Book', 'Author 2', 'NPC', 'JS', '3', 'Open.org', 3, 666, 6000, NULL, NULL, NULL, 'Available'),
(72, 'Author Book', 'Author 2', 'NPC', 'Python', '2', 'Open.org', 2, 666, 6000, NULL, NULL, NULL, 'Available'),
(71, 'Author Book', 'Author 2', 'NPC', 'Java', '1', 'Open.org', 1, 666, 6000, NULL, NULL, NULL, 'Available'),
(70, 'Author Book', 'Author 2', 'NPC', 'CPP', '0', 'Open.org', 0, 666, 6000, NULL, NULL, NULL, 'Available'),
(69, 'Author Book', 'Author 2', 'NPC', 'Fluter', '9', 'Open.org', 9, 666, 6000, NULL, NULL, NULL, 'Available'),
(68, 'Author Book', 'Author 2', 'NPC', 'Android', '8', 'Open.org', 8, 666, 6000, NULL, NULL, NULL, 'Available'),
(67, 'Author Book', 'Author 2', 'NPC', 'React', '7', 'Open.org', 7, 666, 6000, NULL, NULL, NULL, 'Available'),
(66, 'Author Book', 'Author 2', 'NPC', 'Sys. Prog', '6', 'Open.org', 6, 666, 6000, NULL, NULL, NULL, 'Available'),
(65, 'Author Book', 'Author 2', 'NPC', 'Fortron', '5', 'Open.org', 5, 666, 6000, NULL, NULL, NULL, 'Available'),
(64, 'Author Book', 'Author 2', 'NPC', 'PHP', '4', 'Open.org', 4, 666, 6000, NULL, NULL, NULL, 'Available'),
(63, 'Author Book', 'Author 2', 'NPC', 'JS', '3', 'Open.org', 3, 666, 6000, NULL, NULL, NULL, 'Available'),
(62, 'Author Book', 'Author 2', 'NPC', 'Python', '2', 'Open.org', 2, 666, 6000, NULL, NULL, NULL, 'Available'),
(61, 'Author Book', 'Author 2', 'NPC', 'Java', '1', 'Open.org', 1, 666, 6000, NULL, NULL, NULL, 'Available'),
(60, 'Author Book', 'Author 2', 'NPC', 'CPP', '0', 'Open.org', 0, 666, 6000, NULL, NULL, NULL, 'Available'),
(59, 'Author Book', 'Author 2', 'NPC', 'Fluter', '9', 'Open.org', 9, 666, 6000, NULL, NULL, NULL, 'Available'),
(58, 'Author Book', 'Author 2', 'NPC', 'Android', '8', 'Open.org', 8, 666, 6000, NULL, NULL, NULL, 'Available'),
(57, 'Author Book', 'Author 2', 'NPC', 'React', '7', 'Open.org', 7, 666, 6000, NULL, NULL, NULL, 'Available'),
(56, 'Author Book', 'Author 2', 'NPC', 'Sys. Prog', '6', 'Open.org', 6, 666, 6000, NULL, NULL, NULL, 'Available'),
(55, 'Author Book', 'Author 2', 'NPC', 'Fortron', '5', 'Open.org', 5, 666, 6000, NULL, NULL, NULL, 'Available'),
(54, 'Author Book', 'Author 2', 'NPC', 'PHP', '4', 'Open.org', 4, 666, 6000, NULL, NULL, NULL, 'Available'),
(53, 'Author Book', 'Author 2', 'NPC', 'JS', '3', 'Open.org', 3, 666, 6000, NULL, NULL, NULL, 'Available'),
(52, 'Author Book', 'Author 2', 'NPC', 'Python', '2', 'Open.org', 2, 666, 6000, NULL, NULL, NULL, 'Available'),
(51, 'Author Book', 'Author 2', 'NPC', 'Java', '1', 'Open.org', 1, 666, 6000, NULL, NULL, NULL, 'Available'),
(50, 'Author Book', 'Author 2', 'NPC', 'CPP', '0', 'Open.org', 0, 666, 6000, NULL, NULL, NULL, 'Available'),
(49, 'Author Book', 'Author 2', 'NPC', 'Fluter', '9', 'Open.org', 9, 666, 6000, NULL, NULL, NULL, 'Available'),
(48, 'Author Book', 'Author 2', 'NPC', 'Android', '8', 'Open.org', 8, 666, 6000, NULL, NULL, NULL, 'Available'),
(47, 'Author Book', 'Author 2', 'NPC', 'React', '7', 'Open.org', 7, 666, 6000, NULL, NULL, NULL, 'Available'),
(46, 'Author Book', 'Author 2', 'NPC', 'Sys. Prog', '6', 'Open.org', 6, 666, 6000, NULL, NULL, NULL, 'Available'),
(45, 'Author Book', 'Author 2', 'NPC', 'Fortron', '5', 'Open.org', 5, 666, 6000, NULL, NULL, NULL, 'Available'),
(44, 'Author Book', 'Author 2', 'NPC', 'PHP', '4', 'Open.org', 4, 666, 6000, NULL, NULL, NULL, 'Available'),
(43, 'Author Book', 'Author 2', 'NPC', 'JS', '3', 'Open.org', 3, 666, 6000, NULL, NULL, NULL, 'Available'),
(42, 'Author Book', 'Author 2', 'NPC', 'Python', '2', 'Open.org', 2, 666, 6000, NULL, NULL, NULL, 'Available'),
(41, 'Author Book', 'Author 2', 'NPC', 'Java', '1', 'Open.org', 1, 666, 6000, NULL, NULL, NULL, 'Available'),
(40, 'Author Book', 'Author 2', 'NPC', 'CPP', '0', 'Open.org', 0, 666, 6000, NULL, NULL, NULL, 'Available'),
(39, 'Author Book', 'Author 2', 'NPC', 'Fluter', '9', 'Open.org', 9, 666, 6000, NULL, NULL, NULL, 'Available'),
(38, 'Author Book', 'Author 2', 'NPC', 'Android', '8', 'Open.org', 8, 666, 6000, NULL, NULL, NULL, 'Available'),
(37, 'Author Book', 'Author 2', 'NPC', 'React', '7', 'Open.org', 7, 666, 6000, NULL, NULL, NULL, 'Available'),
(36, 'Author Book', 'Author 2', 'NPC', 'Sys. Prog', '6', 'Open.org', 6, 666, 6000, NULL, NULL, NULL, 'Available'),
(35, 'Author Book', 'Author 2', 'NPC', 'Fortron', '5', 'Open.org', 5, 666, 6000, NULL, NULL, NULL, 'Available'),
(34, 'Author Book', 'Author 2', 'NPC', 'PHP', '4', 'Open.org', 4, 666, 6000, NULL, NULL, NULL, 'Available'),
(33, 'Author Book', 'Author 2', 'NPC', 'JS', '3', 'Open.org', 3, 666, 6000, NULL, NULL, NULL, 'Available'),
(32, 'Author Book', 'Author 2', 'NPC', 'Python', '2', 'Open.org', 2, 666, 6000, NULL, NULL, NULL, 'Available'),
(31, 'Author Book', 'Author 2', 'NPC', 'Java', '1', 'Open.org', 1, 666, 6000, NULL, NULL, NULL, 'Available'),
(30, 'Author Book', 'Author 2', 'NPC', 'CPP', '0', 'Open.org', 0, 666, 6000, NULL, NULL, NULL, 'Available'),
(29, 'Author Book', 'Author 2', 'NPC', 'Fluter', '9', 'Open.org', 9, 666, 6000, NULL, NULL, NULL, 'Available'),
(28, 'Author Book', 'Author 2', 'NPC', 'Android', '8', 'Open.org', 8, 666, 6000, NULL, NULL, NULL, 'Available'),
(27, 'Author Book', 'Author 2', 'NPC', 'React', '7', 'Open.org', 7, 666, 6000, NULL, NULL, NULL, 'Available'),
(26, 'Author Book', 'Author 2', 'NPC', 'Sys. Prog', '6', 'Open.org', 6, 666, 6000, NULL, NULL, NULL, 'Available'),
(25, 'Author Book', 'Author 2', 'NPC', 'Fortron', '5', 'Open.org', 5, 666, 6000, NULL, NULL, NULL, 'IT2K2125'),
(24, 'Author Book', 'Author 2', 'NPC', 'PHP', '4', 'Open.org', 4, 666, 6000, NULL, NULL, NULL, 'Available'),
(23, 'Author Book', 'Author 2', 'NPC', 'JS', '3', 'Open.org', 3, 666, 6000, NULL, NULL, NULL, 'Available'),
(22, 'Author Book', 'Author 2', 'NPC', 'Python', '2', 'Open.org', 2, 666, 6000, NULL, NULL, NULL, 'Available'),
(21, 'Author Book', 'Author 2', 'NPC', 'Java', '1', 'Open.org', 1, 666, 6000, NULL, NULL, NULL, 'Available'),
(20, 'Author Book', 'Author 2', 'NPC', 'CPP', '0', 'Open.org', 0, 666, 6000, NULL, NULL, NULL, 'Available'),
(19, 'Author Book', 'Author 2', 'NPC', 'Fluter', '9', 'Open.org', 9, 666, 6000, NULL, NULL, NULL, 'Available'),
(18, 'Author Book', 'Author 2', 'NPC', 'Android', '8', 'Open.org', 8, 666, 6000, NULL, NULL, NULL, 'Available'),
(17, 'Author Book', 'Author 2', 'NPC', 'React', '7', 'Open.org', 7, 666, 6000, NULL, NULL, NULL, 'Available'),
(16, 'Author Book', 'Author 2', 'NPC', 'Sys. Prog', '6', 'Open.org', 6, 666, 6000, NULL, NULL, NULL, 'Available'),
(15, 'Author Book', 'Author 2', 'NPC', 'Fortron', '5', 'Open.org', 5, 666, 6000, NULL, NULL, NULL, 'Available'),
(14, 'Author Book', 'Author 2', 'NPC', 'PHP', '4', 'Open.org', 4, 666, 6000, NULL, NULL, NULL, 'Available'),
(13, 'Author Book', 'Author 2', 'NPC', 'JS', '3', 'Open.org', 3, 666, 6000, NULL, NULL, NULL, 'Available'),
(12, 'Author Book', 'Author 2', 'NPC', 'Python', '2', 'Open.org', 2, 666, 6000, NULL, NULL, NULL, 'Available'),
(11, 'Author Book', 'Author 2', 'NPC', 'Java', '1', 'Open.org', 1, 666, 6000, NULL, NULL, NULL, 'Available'),
(101, 'cgh', 'fthfh', '', 'jaba', 'poonam', 'gh', 4, 56, 56, 'gg', NULL, '', 'Available'),
(102, 'cgh', 'fthfh', '', 'jaba', 'poonam', 'gh', 4, 56, 56, 'gg', NULL, '', 'Available'),
(250, 'fuyghguk', 'kujgyhjgvuhk', 'kujhygvuk', 'esjknfjkd', 'guykfg', 'ukyguyk', 85, 687, 656, 'ujkhyujhgu', 'rfgdv', '', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `buffer status`
--

DROP TABLE IF EXISTS `buffer status`;
CREATE TABLE IF NOT EXISTS `buffer status` (
  `buffer log` varchar(50) DEFAULT NULL,
  `buffer status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `Faculty_ID` varchar(20) NOT NULL,
  `Faculty_Name` varchar(50) NOT NULL,
  `Faculty_Type` varchar(20) NOT NULL,
  PRIMARY KEY (`Faculty_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`Faculty_ID`, `Faculty_Name`, `Faculty_Type`) VALUES
('FID75', 'Name teacher', 'Assistant'),
('FID74', 'Name teacher', 'Assistant'),
('FID73', 'Name teacher', 'Assistant'),
('FID72', 'Name teacher', 'Assistant'),
('FID71', 'Name teacher', 'Assistant'),
('FID70', 'Name teacher', 'Assistant'),
('FID69', 'Name teacher', 'Assistant'),
('FID68', 'Name teacher', 'Assistant'),
('FID67', 'Name teacher', 'Assistant'),
('FID66', 'Name teacher', 'Assistant'),
('FID65', 'Name teacher', 'Assistant'),
('FID64', 'Name teacher', 'Assistant'),
('FID63', 'Name teacher', 'Assistant'),
('FID62', 'Name teacher', 'Assistant'),
('FID61', 'Name teacher', 'Assistant'),
('FID60', 'Name teacher', 'Assistant'),
('FID59', 'Name teacher', 'Assistant'),
('FID58', 'Name teacher', 'Assistant'),
('FID57', 'Name teacher', 'Assistant'),
('FID56', 'Name teacher', 'Assistant'),
('FID55', 'Name teacher', 'Assistant'),
('FID54', 'Name teacher', 'Assistant'),
('FID53', 'Name teacher', 'Assistant'),
('FID52', 'Name teacher', 'Assistant'),
('FID51', 'Name teacher', 'Assistant'),
('FID50', 'Name teacher', 'Assistant'),
('FID49', 'Name teacher', 'Assistant'),
('FID48', 'Name teacher', 'Assistant'),
('FID47', 'Name teacher', 'Assistant'),
('FID46', 'Name teacher', 'Assistant'),
('FID45', 'Name teacher', 'Assistant'),
('FID44', 'Name teacher', 'Assistant'),
('FID43', 'Name teacher', 'Assistant'),
('FID42', 'Name teacher', 'Assistant'),
('FID41', 'Name teacher', 'Assistant'),
('FID40', 'Name teacher', 'Assistant'),
('FID39', 'Name teacher', 'Assistant'),
('FID38', 'Name teacher', 'Assistant'),
('FID37', 'Name teacher', 'Assistant'),
('FID36', 'Name teacher', 'Assistant'),
('FID35', 'Name teacher', 'Assistant'),
('FID34', 'Name teacher', 'Assistant'),
('FID33', 'Name teacher', 'Assistant'),
('FID32', 'Name teacher', 'Assistant'),
('FID31', 'Name teacher', 'Assistant'),
('FID30', 'Name teacher', 'Assistant'),
('FID29', 'Name teacher', 'Assistant'),
('FID28', 'Name teacher', 'Assistant'),
('FID27', 'Name teacher', 'Assistant'),
('FID26', 'Name teacher', 'Assistant'),
('FID25', 'Name teacher', 'Assistant'),
('FID24', 'Name teacher', 'Assistant'),
('FID23', 'Name teacher', 'Assistant'),
('FID22', 'Name teacher', 'Assistant'),
('FID21', 'Name teacher', 'Assistant'),
('FID20', 'Name teacher', 'Assistant'),
('FID19', 'Name teacher', 'Assistant'),
('FID18', 'Name teacher', 'Assistant'),
('FID17', 'Name teacher', 'Assistant'),
('FID16', 'Name teacher', 'Assistant'),
('FID15', 'Name teacher', 'Assistant'),
('FID14', 'Name teacher', 'Assistant'),
('FID13', 'Name teacher', 'Assistant'),
('FID12', 'Name teacher', 'Assistant'),
('FID11', 'Name teacher', 'Assistant'),
('FID10', 'Name teacher', 'Assistant'),
('FID09', 'Name teacher', 'Assistant'),
('FID08', 'Name teacher', 'Assistant'),
('FID07', 'Name teacher', 'Assistant'),
('FID06', 'Name teacher', 'Assistant'),
('FID05', 'Name teacher', 'Assistant'),
('FID04', 'Name teacher', 'Assistant'),
('FID03', 'Name teacher', 'Assistant'),
('FID02', 'Name teacher', 'Assistant'),
('FID01', 'Name teacher', 'Assistant'),
('ukygdvfb', 'ygeuefhud', 'Regular');

-- --------------------------------------------------------

--
-- Table structure for table `insert buffer`
--

DROP TABLE IF EXISTS `insert buffer`;
CREATE TABLE IF NOT EXISTS `insert buffer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `val1` varchar(50) DEFAULT NULL,
  `val2` varchar(50) DEFAULT NULL,
  `val3` varchar(50) DEFAULT NULL,
  `val4` varchar(50) DEFAULT NULL,
  `val5` varchar(50) DEFAULT NULL,
  `val6` varchar(50) DEFAULT NULL,
  `val7` double DEFAULT NULL,
  `val8` int DEFAULT NULL,
  `val9` int DEFAULT NULL,
  `val10` varchar(50) DEFAULT NULL,
  `val11` varchar(50) DEFAULT NULL,
  `val12` varchar(50) DEFAULT NULL,
  `val13` int DEFAULT NULL,
  `val14` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `insert buffer`
--

INSERT INTO `insert buffer` (`id`, `val1`, `val2`, `val3`, `val4`, `val5`, `val6`, `val7`, `val8`, `val9`, `val10`, `val11`, `val12`, `val13`, `val14`) VALUES
(19, 'hghfchtjgft', 'gfhjgfhgj', 'fhjkgfhjgf', 'rdfglrsdg', 'hgfhjkgfhjgf', 'hgfghgjkfhg', 87, 68, 54, 'nbhijb', 'hjbhj', 'hjbh', 10, 1),
(20, 'hijfds', 'hghvfhjg', 'hjkgkgvhjgk', 'holly cow', 'hj,vbhjkg', 'hv,bjhjk', 6.4, 97, 351, 'jkkhg', 'hjkgkhjgvgj', 'jkhv', 10, 150),
(21, 'hgcygfhjdc', 'hytgfhgkf', 'hhgfghkfhg', 'dgs', 'jhghvhgkvhjkg', 'uhjguhjkghj', 545, 544, 654, 'mnbhjm', 'vhbvh', ' vhg', 90, 160);

-- --------------------------------------------------------

--
-- Table structure for table `issue_limit`
--

DROP TABLE IF EXISTS `issue_limit`;
CREATE TABLE IF NOT EXISTS `issue_limit` (
  `Issue_Limit` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `issue_limit`
--

INSERT INTO `issue_limit` (`Issue_Limit`) VALUES
(3);

-- --------------------------------------------------------

--
-- Table structure for table `issue_return`
--

DROP TABLE IF EXISTS `issue_return`;
CREATE TABLE IF NOT EXISTS `issue_return` (
  `Issue_No` int NOT NULL AUTO_INCREMENT,
  `Issue_By` varchar(20) NOT NULL,
  `Member_Type` varchar(8) NOT NULL,
  `Issue_Bookno` int NOT NULL,
  `Issue_Date` date NOT NULL,
  `Return_Date` date DEFAULT NULL,
  PRIMARY KEY (`Issue_No`),
  KEY `Issue_Book` (`Issue_Bookno`),
  KEY `Issue_member` (`Issue_By`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `issue_return`
--

INSERT INTO `issue_return` (`Issue_No`, `Issue_By`, `Member_Type`, `Issue_Bookno`, `Issue_Date`, `Return_Date`) VALUES
(20, 'IT2K2125', 'Student', 100, '2023-09-02', NULL),
(21, 'IT2K2125', 'Student', 25, '2023-09-22', NULL),
(22, 'IT2K2125', 'Student', 84, '2023-09-27', NULL),
(23, 'FID10', 'Faculty', 90, '2023-10-02', '2023-10-02'),
(24, 'FID10', 'Faculty', 90, '2023-10-02', NULL),
(25, 'FID10', 'Faculty', 91, '2023-10-02', '2023-10-02'),
(26, 'FID10', 'Faculty', 92, '2023-10-02', '2023-10-02'),
(27, 'FID10', 'Faculty', 93, '2023-10-02', '2023-10-02'),
(28, 'FID10', 'Faculty', 94, '2023-10-02', '2023-10-02'),
(29, 'FID10', 'Faculty', 95, '2023-10-02', '2023-10-02'),
(30, 'FID10', 'Faculty', 96, '2023-10-02', '2023-10-02'),
(31, 'FID10', 'Faculty', 97, '2023-10-02', '2023-10-02'),
(32, 'FID10', 'Faculty', 98, '2023-10-02', '2023-10-02'),
(33, 'FID10', 'Faculty', 99, '2023-10-02', '2023-10-02'),
(34, 'FID10', 'Faculty', 11, '2023-10-02', '2023-10-02'),
(35, 'FID10', 'Faculty', 12, '2023-10-02', '2023-10-02'),
(36, 'FID10', 'Faculty', 13, '2023-10-02', '2023-10-02'),
(37, 'FID10', 'Faculty', 14, '2023-10-02', '2023-10-02'),
(38, 'FID10', 'Faculty', 15, '2023-10-02', '2023-10-02'),
(39, 'FID10', 'Faculty', 16, '2023-10-02', '2023-10-02'),
(40, 'IT2K2125', 'Student', 98, '2023-11-05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `Member_ID` varchar(20) NOT NULL,
  `MemberType` varchar(8) NOT NULL,
  PRIMARY KEY (`Member_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`Member_ID`, `MemberType`) VALUES
('FID24', 'Faculty'),
('FID23', 'Faculty'),
('FID22', 'Faculty'),
('FID21', 'Faculty'),
('FID20', 'Faculty'),
('FID19', 'Faculty'),
('FID18', 'Faculty'),
('FID17', 'Faculty'),
('FID16', 'Faculty'),
('FID15', 'Faculty'),
('FID14', 'Faculty'),
('FID13', 'Faculty'),
('FID12', 'Faculty'),
('FID11', 'Faculty'),
('FID10', 'Faculty'),
('FID09', 'Faculty'),
('FID08', 'Faculty'),
('FID07', 'Faculty'),
('FID06', 'Faculty'),
('FID05', 'Faculty'),
('FID04', 'Faculty'),
('FID03', 'Faculty'),
('FID02', 'Faculty'),
('FID01', 'Faculty'),
('IT2K2125', 'Student'),
('IT2K2124', 'Student'),
('IT2K2123', 'Student'),
('IT2K2122', 'Student'),
('IT2K2121', 'Student'),
('IT2K2120', 'Student'),
('IT2K2119', 'Student'),
('IT2K2118', 'Student'),
('IT2K2117', 'Student'),
('IT2K2116', 'Student'),
('IT2K2115', 'Student'),
('IT2K2114', 'Student'),
('IT2K2113', 'Student'),
('IT2K2112', 'Student'),
('IT2K2111', 'Student'),
('IT2K2110', 'Student'),
('IT2K2109', 'Student'),
('IT2K2108', 'Student'),
('IT2K2107', 'Student'),
('IT2K2106', 'Student'),
('IT2K2105', 'Student'),
('IT2K2104', 'Student'),
('IT2K2103', 'Student'),
('IT2K2134', 'Student'),
('FID25', 'Faculty'),
('FID-567', 'Faculty'),
('FID-345', 'Faculty'),
('FID-234', 'Faculty'),
('FID-789', 'Faculty'),
('IT2K2175', 'Student'),
('ejfhcdbs', 'Faculty'),
('hdesgfcb', 'Faculty'),
('ukygdvfb', 'Faculty');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `Student_Rollno` varchar(20) NOT NULL,
  `Student_Name` varchar(50) NOT NULL,
  `Student_Course` varchar(50) NOT NULL,
  `Student_Enrollmentno` varchar(20) NOT NULL,
  PRIMARY KEY (`Student_Rollno`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Student_Rollno`, `Student_Name`, `Student_Course`, `Student_Enrollmentno`) VALUES
('IT2K2175', 'Student name', 'MTech IT [5yrs]', 'DE2102075'),
('IT2K2174', 'Student name', 'MTech IT [5yrs]', 'DE2102074'),
('IT2K2173', 'Student name', 'MTech IT [5yrs]', 'DE2102073'),
('IT2K2172', 'Student name', 'MTech IT [5yrs]', 'DE2102072'),
('IT2K2171', 'Student name', 'MTech IT [5yrs]', 'DE2102071'),
('IT2K2170', 'Student name', 'MTech IT [5yrs]', 'DE2102070'),
('IT2K2169', 'Student name', 'MTech IT [5yrs]', 'DE2102069'),
('IT2K2168', 'Student name', 'MTech IT [5yrs]', 'DE2102068'),
('IT2K2167', 'Student name', 'MTech IT [5yrs]', 'DE2102067'),
('IT2K2166', 'Student name', 'MTech IT [5yrs]', 'DE2102066'),
('IT2K2165', 'Student name', 'MTech IT [5yrs]', 'DE2102065'),
('IT2K2164', 'Student name', 'MTech IT [5yrs]', 'DE2102064'),
('IT2K2163', 'Student name', 'MTech IT [5yrs]', 'DE2102063'),
('IT2K2162', 'Student name', 'MTech IT [5yrs]', 'DE2102062'),
('IT2K2161', 'Student name', 'MTech IT [5yrs]', 'DE2102061'),
('IT2K2160', 'Student name', 'MTech IT [5yrs]', 'DE2102060'),
('IT2K2159', 'Student name', 'MTech IT [5yrs]', 'DE2102059'),
('IT2K2158', 'Student name', 'MTech IT [5yrs]', 'DE2102058'),
('IT2K2157', 'Student name', 'MTech IT [5yrs]', 'DE2102057'),
('IT2K2156', 'Student name', 'MTech IT [5yrs]', 'DE2102056'),
('IT2K2155', 'Student name', 'MTech IT [5yrs]', 'DE2102055'),
('IT2K2154', 'Student name', 'MTech IT [5yrs]', 'DE2102054'),
('IT2K2153', 'Student name', 'MTech IT [5yrs]', 'DE2102053'),
('IT2K2152', 'Student name', 'MTech IT [5yrs]', 'DE2102052'),
('IT2K2151', 'Student name', 'MTech IT [5yrs]', 'DE2102051'),
('IT2K2150', 'Student name', 'MTech IT [5yrs]', 'DE2102050'),
('IT2K2149', 'Student name', 'MTech IT [5yrs]', 'DE2102049'),
('IT2K2148', 'Student name', 'MTech IT [5yrs]', 'DE2102048'),
('IT2K2147', 'Student name', 'MTech IT [5yrs]', 'DE2102047'),
('IT2K2146', 'Student name', 'MTech IT [5yrs]', 'DE2102046'),
('IT2K2145', 'Student name', 'MTech IT [5yrs]', 'DE2102045'),
('IT2K2144', 'Student name', 'MTech IT [5yrs]', 'DE2102044'),
('IT2K2143', 'Student name', 'MTech IT [5yrs]', 'DE2102043'),
('IT2K2142', 'Student name', 'MTech IT [5yrs]', 'DE2102042'),
('IT2K2141', 'Student name', 'MTech IT [5yrs]', 'DE2102041'),
('IT2K2140', 'Student name', 'MTech IT [5yrs]', 'DE2102040'),
('IT2K2139', 'Student name', 'MTech IT [5yrs]', 'DE2102039'),
('IT2K2138', 'Student name', 'MTech IT [5yrs]', 'DE2102038'),
('IT2K2137', 'Student name', 'MTech IT [5yrs]', 'DE2102037'),
('IT2K2136', 'Student name', 'MTech IT [5yrs]', 'DE2102036'),
('IT2K2135', 'Student name', 'MTech IT [5yrs]', 'DE2102035'),
('IT2K2134', 'Student name', 'MTech IT [5yrs]', 'DE2102034'),
('IT2K2133', 'Student name', 'MTech IT [5yrs]', 'DE2102033'),
('IT2K2132', 'Student name', 'MTech IT [5yrs]', 'DE2102032'),
('IT2K2131', 'Student name', 'MTech IT [5yrs]', 'DE2102031'),
('IT2K2130', 'Student name', 'MTech IT [5yrs]', 'DE2102030'),
('IT2K2129', 'Student name', 'MTech IT [5yrs]', 'DE2102029'),
('IT2K2128', 'Student name', 'MTech IT [5yrs]', 'DE2102028'),
('IT2K2127', 'Student name', 'MTech IT [5yrs]', 'DE2102027'),
('IT2K2126', 'Student name', 'MTech IT [5yrs]', 'DE2102026'),
('IT2K2125', 'Student name', 'MTech IT [5yrs]', 'DE2102025'),
('IT2K2124', 'Student name', 'MTech IT [5yrs]', 'DE2102024'),
('IT2K2123', 'Student name', 'MTech IT [5yrs]', 'DE2102023'),
('IT2K2122', 'Student name', 'MTech IT [5yrs]', 'DE2102022'),
('IT2K2121', 'Student name', 'MTech IT [5yrs]', 'DE2102021'),
('IT2K2120', 'Student name', 'MTech IT [5yrs]', 'DE2102020'),
('IT2K2119', 'Student name', 'MTech IT [5yrs]', 'DE2102019'),
('IT2K2118', 'Student name', 'MTech IT [5yrs]', 'DE2102018'),
('IT2K2117', 'Student name', 'MTech IT [5yrs]', 'DE2102017'),
('IT2K2116', 'Student name', 'MTech IT [5yrs]', 'DE2102016'),
('IT2K2115', 'Student name', 'MTech IT [5yrs]', 'DE2102015'),
('IT2K2114', 'Student name', 'MTech IT [5yrs]', 'DE2102014'),
('IT2K2113', 'Student name', 'MTech IT [5yrs]', 'DE2102013'),
('IT2K2112', 'Student name', 'MTech IT [5yrs]', 'DE2102012'),
('IT2K2111', 'Student name', 'MTech IT [5yrs]', 'DE2102011'),
('IT2K2110', 'Student name', 'MTech IT [5yrs]', 'DE2102010'),
('IT2K2109', 'Student name', 'MTech IT [5yrs]', 'DE2102009'),
('IT2K2108', 'Student name', 'MTech IT [5yrs]', 'DE2102008'),
('IT2K2107', 'Student name', 'MTech IT [5yrs]', 'DE2102007'),
('IT2K2106', 'Student name', 'MTech IT [5yrs]', 'DE2102006'),
('IT2K2105', 'Student name', 'MTech IT [5yrs]', 'DE2102005'),
('IT2K2104', 'Student name', 'MTech IT [5yrs]', 'DE2102004'),
('IT2K2103', 'Student name', 'MTech IT [5yrs]', 'DE2102003'),
('IT2K2102', 'Student name', 'MTech IT [5yrs]', 'DE2102002'),
('IT2K2101', 'Student name', 'MTech IT [5yrs]', 'DE2102001');

-- --------------------------------------------------------

--
-- Table structure for table `suggestion`
--

DROP TABLE IF EXISTS `suggestion`;
CREATE TABLE IF NOT EXISTS `suggestion` (
  `Book_value` varchar(25) NOT NULL,
  `category` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `suggestion`
--

INSERT INTO `suggestion` (`Book_value`, `category`) VALUES
('CPP', 'Title'),
('Java', 'Title'),
('Python', 'Title'),
('JS', 'Title'),
('PHP', 'Title'),
('Fortron', 'Title'),
('Sys. Prog', 'Title'),
('React', 'Title'),
('Android', 'Title'),
('Fluter', 'Title'),
('jhon', 'Author'),
('nathkat soham', 'Author'),
('smuggler overload', 'Author'),
('joe', 'Author'),
('homelander', 'Author'),
('rick', 'Author'),
('simp kratos', 'Author'),
('NPC', 'Author'),
('Deep', 'Author'),
('jhon snow', 'Author'),
('holly cow', 'Title'),
('sfd', 'Publisher'),
('fesda', 'Author'),
('fds', 'Author'),
('fsd', 'Author'),
('esjknfjkd', 'Title'),
('ukyguyk', 'Publisher'),
('fuyghguk', 'Author'),
('kujgyhjgvuhk', 'Author'),
('kujhygvuk', 'Author');

-- --------------------------------------------------------

--
-- Table structure for table `temp_keys`
--

DROP TABLE IF EXISTS `temp_keys`;
CREATE TABLE IF NOT EXISTS `temp_keys` (
  `Username` varchar(20) NOT NULL,
  `Key_Session` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Log` varchar(40) DEFAULT NULL,
  `Log2` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `temp_keys`
--

INSERT INTO `temp_keys` (`Username`, `Key_Session`, `Log`, `Log2`) VALUES
('admin', '$2y$10$OmPGHm7Iaqli//RcHFeY..vIASY/e5vcsbKeH4v1sbqN7asE2QDrK', 'Sat, 04 Nov 2023 13:08:58 +0530', '23116040858'),
('admin1', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
