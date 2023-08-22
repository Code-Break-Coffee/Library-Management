-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 22, 2023 at 10:17 AM
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
  `Log` varchar(40) DEFAULT NULL,
  `User_level` varchar(10) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Username`, `Password`, `Log`, `User_level`) VALUES
('admin', '12345678', NULL, 'Admin'),
('admin1', '12345678', NULL, 'Assistent');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `Book_No` varchar(10) NOT NULL,
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
  `Bill_No` varchar(20) DEFAULT NULL,
  `Status` varchar(20) DEFAULT 'Available',
  PRIMARY KEY (`Book_No`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`Book_No`, `Author1`, `Author2`, `Author3`, `Title`, `Edition`, `Publisher`, `Cl_No`, `Total_Pages`, `Cost`, `Supplier`, `Bill_No`, `Status`) VALUES
('20', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'CPP', '0', 'Smuggler.org', 0, 696, 6000, NULL, NULL, 'Available'),
('21', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Java', '1', 'Smuggler.org', 1, 696, 6000, NULL, NULL, 'Available'),
('19', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fluter', '9', 'Smuggler.org', 9, 696, 6000, NULL, NULL, 'Available'),
('18', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Android', '8', 'Smuggler.org', 8, 696, 6000, NULL, NULL, 'Available'),
('17', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'React', '7', 'Smuggler.org', 7, 696, 6000, NULL, NULL, 'Available'),
('16', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Sys. Prog', '6', 'Smuggler.org', 6, 696, 6000, NULL, NULL, 'Available'),
('15', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fortron', '5', 'Smuggler.org', 5, 696, 6000, NULL, NULL, 'Available'),
('14', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'PHP', '4', 'Smuggler.org', 4, 696, 6000, NULL, NULL, 'Available'),
('13', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'JS', '3', 'Smuggler.org', 3, 696, 6000, NULL, NULL, 'Available'),
('12', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Python', '2', 'Smuggler.org', 2, 696, 6000, NULL, NULL, 'Available'),
('11', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Java', '1', 'Smuggler.org', 1, 696, 6000, NULL, NULL, 'Available'),
('22', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Python', '2', 'Smuggler.org', 2, 696, 6000, NULL, NULL, 'Available'),
('23', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'JS', '3', 'Smuggler.org', 3, 696, 6000, NULL, NULL, 'Available'),
('24', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'PHP', '4', 'Smuggler.org', 4, 696, 6000, NULL, NULL, 'Available'),
('25', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fortron', '5', 'Smuggler.org', 5, 696, 6000, NULL, NULL, 'Available'),
('26', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Sys. Prog', '6', 'Smuggler.org', 6, 696, 6000, NULL, NULL, 'Available'),
('27', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'React', '7', 'Smuggler.org', 7, 696, 6000, NULL, NULL, 'Available'),
('28', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Android', '8', 'Smuggler.org', 8, 696, 6000, NULL, NULL, 'Available'),
('29', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fluter', '9', 'Smuggler.org', 9, 696, 6000, NULL, NULL, 'Available'),
('30', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'CPP', '0', 'Smuggler.org', 0, 696, 6000, NULL, NULL, 'Available'),
('31', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Java', '1', 'Smuggler.org', 1, 696, 6000, NULL, NULL, 'Available'),
('32', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Python', '2', 'Smuggler.org', 2, 696, 6000, NULL, NULL, 'Available'),
('33', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'JS', '3', 'Smuggler.org', 3, 696, 6000, NULL, NULL, 'Available'),
('34', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'PHP', '4', 'Smuggler.org', 4, 696, 6000, NULL, NULL, 'Available'),
('35', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fortron', '5', 'Smuggler.org', 5, 696, 6000, NULL, NULL, 'Available'),
('36', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Sys. Prog', '6', 'Smuggler.org', 6, 696, 6000, NULL, NULL, 'Available'),
('37', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'React', '7', 'Smuggler.org', 7, 696, 6000, NULL, NULL, 'Available'),
('38', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Android', '8', 'Smuggler.org', 8, 696, 6000, NULL, NULL, 'Available'),
('39', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fluter', '9', 'Smuggler.org', 9, 696, 6000, NULL, NULL, 'Available'),
('40', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'CPP', '0', 'Smuggler.org', 0, 696, 6000, NULL, NULL, 'Available'),
('41', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Java', '1', 'Smuggler.org', 1, 696, 6000, NULL, NULL, 'Available'),
('42', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Python', '2', 'Smuggler.org', 2, 696, 6000, NULL, NULL, 'Available'),
('43', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'JS', '3', 'Smuggler.org', 3, 696, 6000, NULL, NULL, 'Available'),
('44', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'PHP', '4', 'Smuggler.org', 4, 696, 6000, NULL, NULL, 'Available'),
('45', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fortron', '5', 'Smuggler.org', 5, 696, 6000, NULL, NULL, 'Available'),
('46', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Sys. Prog', '6', 'Smuggler.org', 6, 696, 6000, NULL, NULL, 'Available'),
('47', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'React', '7', 'Smuggler.org', 7, 696, 6000, NULL, NULL, 'Available'),
('48', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Android', '8', 'Smuggler.org', 8, 696, 6000, NULL, NULL, 'Available'),
('49', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fluter', '9', 'Smuggler.org', 9, 696, 6000, NULL, NULL, 'Available'),
('50', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'CPP', '0', 'Smuggler.org', 0, 696, 6000, NULL, NULL, 'Available'),
('51', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Java', '1', 'Smuggler.org', 1, 696, 6000, NULL, NULL, 'Available'),
('52', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Python', '2', 'Smuggler.org', 2, 696, 6000, NULL, NULL, 'Available'),
('53', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'JS', '3', 'Smuggler.org', 3, 696, 6000, NULL, NULL, 'Available'),
('54', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'PHP', '4', 'Smuggler.org', 4, 696, 6000, NULL, NULL, 'Available'),
('55', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fortron', '5', 'Smuggler.org', 5, 696, 6000, NULL, NULL, 'Available'),
('56', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Sys. Prog', '6', 'Smuggler.org', 6, 696, 6000, NULL, NULL, 'Available'),
('57', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'React', '7', 'Smuggler.org', 7, 696, 6000, NULL, NULL, 'Available'),
('58', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Android', '8', 'Smuggler.org', 8, 696, 6000, NULL, NULL, 'Available'),
('59', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fluter', '9', 'Smuggler.org', 9, 696, 6000, NULL, NULL, 'Available'),
('60', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'CPP', '0', 'Smuggler.org', 0, 696, 6000, NULL, NULL, 'Available'),
('61', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Java', '1', 'Smuggler.org', 1, 696, 6000, NULL, NULL, 'Available'),
('62', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Python', '2', 'Smuggler.org', 2, 696, 6000, NULL, NULL, 'Available'),
('63', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'JS', '3', 'Smuggler.org', 3, 696, 6000, NULL, NULL, 'Available'),
('64', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'PHP', '4', 'Smuggler.org', 4, 696, 6000, NULL, NULL, 'Available'),
('65', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fortron', '5', 'Smuggler.org', 5, 696, 6000, NULL, NULL, 'Available'),
('66', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Sys. Prog', '6', 'Smuggler.org', 6, 696, 6000, NULL, NULL, 'Available'),
('67', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'React', '7', 'Smuggler.org', 7, 696, 6000, NULL, NULL, 'Available'),
('68', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Android', '8', 'Smuggler.org', 8, 696, 6000, NULL, NULL, 'Available'),
('69', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fluter', '9', 'Smuggler.org', 9, 696, 6000, NULL, NULL, 'Available'),
('70', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'CPP', '0', 'Smuggler.org', 0, 696, 6000, NULL, NULL, 'Available'),
('71', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Java', '1', 'Smuggler.org', 1, 696, 6000, NULL, NULL, 'Available'),
('72', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Python', '2', 'Smuggler.org', 2, 696, 6000, NULL, NULL, 'Available'),
('73', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'JS', '3', 'Smuggler.org', 3, 696, 6000, NULL, NULL, 'Available'),
('74', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'PHP', '4', 'Smuggler.org', 4, 696, 6000, NULL, NULL, 'Available'),
('75', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fortron', '5', 'Smuggler.org', 5, 696, 6000, NULL, NULL, 'Available'),
('76', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Sys. Prog', '6', 'Smuggler.org', 6, 696, 6000, NULL, NULL, 'Available'),
('77', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'React', '7', 'Smuggler.org', 7, 696, 6000, NULL, NULL, 'Available'),
('78', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Android', '8', 'Smuggler.org', 8, 696, 6000, NULL, NULL, 'Available'),
('79', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fluter', '9', 'Smuggler.org', 9, 696, 6000, NULL, NULL, 'Available'),
('80', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'CPP', '0', 'Smuggler.org', 0, 696, 6000, NULL, NULL, 'Available'),
('81', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Java', '1', 'Smuggler.org', 1, 696, 6000, NULL, NULL, 'Available'),
('82', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Python', '2', 'Smuggler.org', 2, 696, 6000, NULL, NULL, 'Available'),
('83', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'JS', '3', 'Smuggler.org', 3, 696, 6000, NULL, NULL, 'Available'),
('84', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'PHP', '4', 'Smuggler.org', 4, 696, 6000, NULL, NULL, 'Available'),
('85', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fortron', '5', 'Smuggler.org', 5, 696, 6000, NULL, NULL, 'Available'),
('86', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Sys. Prog', '6', 'Smuggler.org', 6, 696, 6000, NULL, NULL, 'Available'),
('87', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'React', '7', 'Smuggler.org', 7, 696, 6000, NULL, NULL, 'Available'),
('88', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Android', '8', 'Smuggler.org', 8, 696, 6000, NULL, NULL, 'Available'),
('89', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fluter', '9', 'Smuggler.org', 9, 696, 6000, NULL, NULL, 'Available'),
('90', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'CPP', '0', 'Smuggler.org', 0, 696, 6000, NULL, NULL, 'Available'),
('91', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Java', '1', 'Smuggler.org', 1, 696, 6000, NULL, NULL, 'Available'),
('92', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Python', '2', 'Smuggler.org', 2, 696, 6000, NULL, NULL, 'Available'),
('93', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'JS', '3', 'Smuggler.org', 3, 696, 6000, NULL, NULL, 'Available'),
('94', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'PHP', '4', 'Smuggler.org', 4, 696, 6000, NULL, NULL, 'Available'),
('95', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fortron', '5', 'Smuggler.org', 5, 696, 6000, NULL, NULL, 'Available'),
('96', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Sys. Prog', '6', 'Smuggler.org', 6, 696, 6000, NULL, NULL, 'Available'),
('97', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'React', '7', 'Smuggler.org', 7, 696, 6000, NULL, NULL, 'Available'),
('98', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Android', '8', 'Smuggler.org', 8, 696, 6000, NULL, NULL, 'Available'),
('99', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'Fluter', '9', 'Smuggler.org', 9, 696, 6000, NULL, NULL, 'Available'),
('100', 'Nathkhat Kothari', 'Tanishq smuggler', 'NPC', 'CPP', '0', 'Smuggler.org', 0, 696, 6000, NULL, NULL, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `Faculty_ID` varchar(20) NOT NULL,
  `Faculty_Name` varchar(50) NOT NULL,
  `Faculty_Type` varchar(20) NOT NULL,
  `Faculty_Fatherorhusband` varchar(50) NOT NULL,
  PRIMARY KEY (`Faculty_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`Faculty_ID`, `Faculty_Name`, `Faculty_Type`, `Faculty_Fatherorhusband`) VALUES
('FID75', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID74', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID73', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID72', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID71', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID70', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID69', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID68', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID67', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID66', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID65', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID64', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID63', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID62', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID61', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID60', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID59', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID58', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID57', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID56', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID55', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID54', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID53', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID52', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID51', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID50', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID49', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID48', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID47', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID46', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID45', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID44', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID43', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID42', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID41', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID40', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID39', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID38', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID37', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID36', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID35', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID34', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID33', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID32', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID31', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID30', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID29', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID28', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID27', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID26', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID25', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID24', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID23', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID22', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID21', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID20', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID19', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID18', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID17', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID16', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID15', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID14', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID13', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID12', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID11', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID10', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID09', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID08', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID07', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID06', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID05', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID04', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID03', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID02', 'Nathkhat teacher', 'Assistent', 'NA'),
('FID01', 'Nathkhat teacher', 'Assistent', 'NA');

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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
('FID25', 'Faculty'),
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
('IT2K2102', 'Student'),
('IT2K2101', 'Student');

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
('IT2K2175', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102075'),
('IT2K2174', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102074'),
('IT2K2173', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102073'),
('IT2K2172', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102072'),
('IT2K2171', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102071'),
('IT2K2170', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102070'),
('IT2K2169', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102069'),
('IT2K2168', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102068'),
('IT2K2167', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102067'),
('IT2K2166', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102066'),
('IT2K2165', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102065'),
('IT2K2164', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102064'),
('IT2K2163', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102063'),
('IT2K2162', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102062'),
('IT2K2161', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102061'),
('IT2K2160', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102060'),
('IT2K2159', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102059'),
('IT2K2158', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102058'),
('IT2K2157', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102057'),
('IT2K2156', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102056'),
('IT2K2155', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102055'),
('IT2K2154', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102054'),
('IT2K2153', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102053'),
('IT2K2152', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102052'),
('IT2K2151', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102051'),
('IT2K2150', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102050'),
('IT2K2149', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102049'),
('IT2K2148', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102048'),
('IT2K2147', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102047'),
('IT2K2146', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102046'),
('IT2K2145', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102045'),
('IT2K2144', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102044'),
('IT2K2143', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102043'),
('IT2K2142', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102042'),
('IT2K2141', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102041'),
('IT2K2140', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102040'),
('IT2K2139', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102039'),
('IT2K2138', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102038'),
('IT2K2137', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102037'),
('IT2K2136', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102036'),
('IT2K2135', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102035'),
('IT2K2134', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102034'),
('IT2K2133', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102033'),
('IT2K2132', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102032'),
('IT2K2131', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102031'),
('IT2K2130', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102030'),
('IT2K2129', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102029'),
('IT2K2128', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102028'),
('IT2K2127', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102027'),
('IT2K2126', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102026'),
('IT2K2125', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102025'),
('IT2K2124', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102024'),
('IT2K2123', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102023'),
('IT2K2122', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102022'),
('IT2K2121', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102021'),
('IT2K2120', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102020'),
('IT2K2119', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102019'),
('IT2K2118', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102018'),
('IT2K2117', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102017'),
('IT2K2116', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102016'),
('IT2K2115', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102015'),
('IT2K2114', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102014'),
('IT2K2113', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102013'),
('IT2K2112', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102012'),
('IT2K2111', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102011'),
('IT2K2110', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102010'),
('IT2K2109', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102009'),
('IT2K2108', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102008'),
('IT2K2107', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102007'),
('IT2K2106', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102006'),
('IT2K2105', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102005'),
('IT2K2104', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102004'),
('IT2K2103', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102003'),
('IT2K2102', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102002'),
('IT2K2101', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102001');

-- --------------------------------------------------------

--
-- Table structure for table `temp_keys`
--

DROP TABLE IF EXISTS `temp_keys`;
CREATE TABLE IF NOT EXISTS `temp_keys` (
  `Username` varchar(20) NOT NULL,
  `Key_Session` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Log` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `temp_keys`
--

INSERT INTO `temp_keys` (`Username`, `Key_Session`, `Log`) VALUES
('admin', '$2y$10$ceOU6nZOCgIo7o.lyun9yOIWvVyQmy2PlDT2JB1M7zNFV/udm7PSW', 'Sat, 12 Aug 2023 19:26:14 +0530');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
