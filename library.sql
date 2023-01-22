-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2023 at 11:19 AM
-- Server version: 8.0.31
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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `Book_No` varchar(10) NOT NULL,
  `Authors` varchar(20) NOT NULL,
  `Title` varchar(30) NOT NULL,
  `Edition` varchar(15) NOT NULL,
  `Publiser` varchar(20) NOT NULL,
  `Total_Pages` int NOT NULL,
  `Cost` int NOT NULL,
  `Name_of_supplier` varchar(20) NOT NULL,
  `Bill_No` varchar(20) NOT NULL,
  `Bar_code` varchar(50) NOT NULL,
  PRIMARY KEY (`Book_No`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`Book_No`, `Authors`, `Title`, `Edition`, `Publiser`, `Total_Pages`, `Cost`, `Name_of_supplier`, `Bill_No`, `Bar_code`) VALUES
('69_d', 'oh sorry he iss dead', 'Fuck Life', 'among ones', 'methi saw chatora', 6969, 69, 'Tanishq the smugler', '699999fuck', 'System-32/notForChildren/contentsOfThisFoldersAre/');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
