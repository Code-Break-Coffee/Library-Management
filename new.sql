-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 01, 2023 at 07:26 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

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
  `Password` varchar(16) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Username`, `Password`) VALUES
('admin', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `Book_No` int NOT NULL,
  `Author1` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Author2` varchar(50) DEFAULT NULL,
  `Author3` varchar(50) DEFAULT NULL,
  `Title` varchar(30) NOT NULL,
  `Edition` varchar(15) NOT NULL,
  `Publisher` varchar(50) NOT NULL,
  `Total_Pages` int NOT NULL,
  `Cost` int DEFAULT NULL,
  `Supplier` varchar(50) DEFAULT NULL,
  `Bill_No` varchar(20) DEFAULT NULL,
  `Status` varchar(20) DEFAULT 'Available',
  PRIMARY KEY (`Book_No`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`Book_No`, `Author1`, `Author2`, `Author3`, `Title`, `Edition`, `Publisher`, `Total_Pages`, `Cost`, `Supplier`, `Bill_No`, `Status`) VALUES
(12, 'adahah', '', '', 'agag', 'ahhaha', 'adhahah', 1234, 123, 'jajaja', 'adhahah', 'Available'),
(13, 'adahah', '', '', 'agag', 'ahhaha', 'adhahah', 1234, 123, '', 'adhahah', 'Available');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `Member_ID` varchar(20) NOT NULL,
  `MemberType` varchar(8) NOT NULL,
  `Book_Issue1` int DEFAULT NULL,
  `Book_Issue2` int DEFAULT NULL,
  `Book_Issue3` int DEFAULT NULL,
  `Book_Issue4` int DEFAULT NULL,
  `Book_Issue5` int DEFAULT NULL,
  `Book_Issue6` int DEFAULT NULL,
  `Book_Issue7` int DEFAULT NULL,
  `Book_Issue8` int DEFAULT NULL,
  `Book_Issue9` int DEFAULT NULL,
  `Book_Issue10` int DEFAULT NULL,
  PRIMARY KEY (`Member_ID`),
  KEY `bk1` (`Book_Issue1`),
  KEY `bk2` (`Book_Issue2`),
  KEY `bk3` (`Book_Issue3`),
  KEY `bk4` (`Book_Issue4`),
  KEY `bk5` (`Book_Issue5`),
  KEY `bk6` (`Book_Issue6`),
  KEY `bk7` (`Book_Issue7`),
  KEY `bk8` (`Book_Issue8`),
  KEY `bk9` (`Book_Issue9`),
  KEY `bk10` (`Book_Issue10`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
