-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 12, 2023 at 02:08 PM
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
('jdbnhawd', 'vhhm', 'gvhm', '', 'cgfcdwan', 'gcvgfnc', 'bhjvghfggh', 6, 56, 55, 'fcgghvhb', '', 'Available'),
('27', 'fcgvhbjnk', 'fcgvhbn', '', 'fghj', 'ghbjk', 'hcgvhjbjnk', 5, 545, 2042, 'fxcgvhbjn', '', 'Available'),
('75', 'jvjkjg', 'jhbbkk', '', 'fkjsdfkjnj', 'bjhiy', 'hjb', 59, 56, 95, 'hjb', '', 'Available');

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
('IT2k2125', 'Student'),
('IT2k2124', 'Student'),
('IT2k2123', 'Student'),
('IT2k2122', 'Student'),
('IT2k2121', 'Student'),
('IT2k2120', 'Student'),
('IT2k2119', 'Student'),
('IT2k2118', 'Student'),
('IT2k2117', 'Student'),
('IT2k2116', 'Student'),
('IT2k2115', 'Student'),
('IT2k2114', 'Student'),
('IT2k2113', 'Student'),
('IT2k2112', 'Student'),
('IT2k2111', 'Student'),
('IT2k2110', 'Student'),
('IT2k2109', 'Student'),
('IT2k2108', 'Student'),
('IT2k2107', 'Student'),
('IT2k2106', 'Student'),
('IT2k2105', 'Student'),
('IT2k2104', 'Student'),
('IT2k2103', 'Student'),
('IT2k2102', 'Student'),
('IT2k2101', 'Student');

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
('IT2k2175', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102075'),
('IT2k2174', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102074'),
('IT2k2173', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102073'),
('IT2k2172', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102072'),
('IT2k2171', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102071'),
('IT2k2170', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102070'),
('IT2k2169', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102069'),
('IT2k2168', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102068'),
('IT2k2167', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102067'),
('IT2k2166', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102066'),
('IT2k2165', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102065'),
('IT2k2164', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102064'),
('IT2k2163', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102063'),
('IT2k2162', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102062'),
('IT2k2161', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102061'),
('IT2k2160', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102060'),
('IT2k2159', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102059'),
('IT2k2158', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102058'),
('IT2k2157', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102057'),
('IT2k2156', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102056'),
('IT2k2155', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102055'),
('IT2k2154', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102054'),
('IT2k2153', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102053'),
('IT2k2152', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102052'),
('IT2k2151', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102051'),
('IT2k2150', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102050'),
('IT2k2149', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102049'),
('IT2k2148', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102048'),
('IT2k2147', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102047'),
('IT2k2146', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102046'),
('IT2k2145', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102045'),
('IT2k2144', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102044'),
('IT2k2143', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102043'),
('IT2k2142', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102042'),
('IT2k2141', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102041'),
('IT2k2140', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102040'),
('IT2k2139', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102039'),
('IT2k2138', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102038'),
('IT2k2137', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102037'),
('IT2k2136', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102036'),
('IT2k2135', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102035'),
('IT2k2134', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102034'),
('IT2k2133', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102033'),
('IT2k2132', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102032'),
('IT2k2131', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102031'),
('IT2k2130', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102030'),
('IT2k2129', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102029'),
('IT2k2128', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102028'),
('IT2k2127', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102027'),
('IT2k2126', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102026'),
('IT2k2125', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102025'),
('IT2k2124', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102024'),
('IT2k2123', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102023'),
('IT2k2122', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102022'),
('IT2k2121', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102021'),
('IT2k2120', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102020'),
('IT2k2119', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102019'),
('IT2k2118', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102018'),
('IT2k2117', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102017'),
('IT2k2116', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102016'),
('IT2k2115', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102015'),
('IT2k2114', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102014'),
('IT2k2113', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102013'),
('IT2k2112', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102012'),
('IT2k2111', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102011'),
('IT2k2110', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102010'),
('IT2k2109', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102009'),
('IT2k2108', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102008'),
('IT2k2107', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102007'),
('IT2k2106', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102006'),
('IT2k2105', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102005'),
('IT2k2104', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102004'),
('IT2k2103', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102003'),
('IT2k2102', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102002'),
('IT2k2101', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102001');

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
