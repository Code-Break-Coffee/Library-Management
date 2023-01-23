-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jan 23, 2023 at 03:58 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `Authors` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Title` varchar(30) NOT NULL,
  `Edition` varchar(15) NOT NULL,
  `Publisher` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Total_Pages` int(11) NOT NULL,
  `Cost` int(11) NOT NULL,
  `Name_of_supplier` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Bill_No` varchar(20) NOT NULL,
  `Bar_code` varchar(50) NOT NULL,
  PRIMARY KEY (`Book_No`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`Book_No`, `Authors`, `Title`, `Edition`, `Publisher`, `Total_Pages`, `Cost`, `Name_of_supplier`, `Bill_No`, `Bar_code`) VALUES
('69_d', 'oh sorry he iss dead', 'Fuck Life', 'among ones', 'methi saw chatora', 6969, 69, 'Tanishq the smugler', '699999fuck', 'System-32/notForChildren/contentsOfThisFoldersAre/'),
('ahahah', 'ajjafjararja', 'krkararjar', 'jrrjsrjarjaj', 'fjsjsrjsrjs', 123, 50, 'ahaaha', 'jarjakaka', '');

-- --------------------------------------------------------

--
-- Table structure for table `issue/return`
--

DROP TABLE IF EXISTS `issue/return`;
CREATE TABLE IF NOT EXISTS `issue/return` (
  `Book_No` varchar(10) NOT NULL,
  `Title` varchar(30) NOT NULL,
  `Member_ID` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Member_Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Date_issue` date NOT NULL,
  `Date_return` date NOT NULL,
  `Member_type` varchar(10) NOT NULL,
  KEY `Book_No` (`Book_No`),
  KEY `Book_No_2` (`Book_No`),
  KEY `Member_ID` (`Member_ID`),
  KEY `Title` (`Title`),
  KEY `Title_2` (`Title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member-faculty`
--

DROP TABLE IF EXISTS `member-faculty`;
CREATE TABLE IF NOT EXISTS `member-faculty` (
  `Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Member_ID` varchar(20) NOT NULL,
  `Faculty_Type` varchar(20) NOT NULL,
  `Father-husband` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`Member_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member-student`
--

DROP TABLE IF EXISTS `member-student`;
CREATE TABLE IF NOT EXISTS `member-student` (
  `Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Roll_No` varchar(15) NOT NULL,
  `Enroll` varchar(15) NOT NULL,
  `Member_ID` varchar(20) NOT NULL,
  PRIMARY KEY (`Member_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issue/return`
--
ALTER TABLE `issue/return`
  ADD CONSTRAINT `issue/return_ibfk_1` FOREIGN KEY (`Book_No`) REFERENCES `books` (`Book_No`),
  ADD CONSTRAINT `issue/return_ibfk_2` FOREIGN KEY (`Member_ID`) REFERENCES `member-student` (`Member_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
