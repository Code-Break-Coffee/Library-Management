-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 01, 2023 at 03:10 PM
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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `Book_No` varchar(10) NOT NULL,
  `Authors` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Title` varchar(30) NOT NULL,
  `Edition` varchar(15) NOT NULL,
  `Publisher` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Total_Pages` int NOT NULL,
  `Cost` int NOT NULL,
  `Name_of_supplier` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Bill_No` varchar(20) NOT NULL,
  `Bar_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'NA',
  PRIMARY KEY (`Book_No`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`Book_No`, `Authors`, `Title`, `Edition`, `Publisher`, `Total_Pages`, `Cost`, `Name_of_supplier`, `Bill_No`, `Bar_code`) VALUES
('69_d', 'oh sorry he iss dead', 'Fuck Life', 'among ones', 'methi saw chatora', 6969, 69, 'Tanishq the smugler', '699999fuck', 'System-32/notForChildren/contentsOfThisFoldersAre/'),
('ahahah', 'ajjafjararja', 'krkararjar', 'jrrjsrjarjaj', 'fjsjsrjsrjs', 123, 50, 'ahaaha', 'jarjakaka', ''),
('isghsdgs', 'sgsdhsgs', 'tanishq', '69', 'go', 969, 69, 'tanishq the smugler', '69', 'NA');

-- --------------------------------------------------------

--
-- Table structure for table `issue_return`
--

DROP TABLE IF EXISTS `issue_return`;
CREATE TABLE IF NOT EXISTS `issue_return` (
  `Book_No` varchar(10) NOT NULL,
  `Title` varchar(30) NOT NULL,
  `Member_ID` varchar(20) NOT NULL,
  `Member_Name` varchar(50) NOT NULL,
  `Date_issue` date NOT NULL,
  `Date_return` date NOT NULL,
  `Member_type` varchar(10) NOT NULL,
  KEY `Book_No` (`Book_No`),
  KEY `fk_2` (`Member_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_faculty`
--

DROP TABLE IF EXISTS `member_faculty`;
CREATE TABLE IF NOT EXISTS `member_faculty` (
  `Name` varchar(50) NOT NULL,
  `Member_ID` varchar(20) NOT NULL,
  `Faculty_Type` varchar(20) NOT NULL,
  `Father-husband` varchar(50) NOT NULL,
  PRIMARY KEY (`Member_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_student`
--

DROP TABLE IF EXISTS `member_student`;
CREATE TABLE IF NOT EXISTS `member_student` (
  `Name` varchar(50) NOT NULL,
  `Roll_No` varchar(15) NOT NULL,
  `Enroll` varchar(15) NOT NULL,
  `Member_ID` varchar(20) NOT NULL,
  PRIMARY KEY (`Member_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issue_return`
--
ALTER TABLE `issue_return`
  ADD CONSTRAINT `fk_1` FOREIGN KEY (`Member_ID`) REFERENCES `member_student` (`Member_ID`),
  ADD CONSTRAINT `fk_2` FOREIGN KEY (`Member_ID`) REFERENCES `member_faculty` (`Member_ID`),
  ADD CONSTRAINT `issue_return_ibfk_1` FOREIGN KEY (`Book_No`) REFERENCES `books` (`Book_No`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
