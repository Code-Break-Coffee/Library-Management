-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 10, 2023 at 06:59 AM
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
(12, 'adahah', '', '', 'agag', 'ahhaha', 'adhahah', 1234, 123, 'jajaja', 'adhahah', 'IT-2k21-01'),
(13, 'aeajejaj', '', '', 'agag', 'ahhaha', 'aejeja', 1234, 123, 'aejajaja', 'aehaeaj', 'IT-2k21-12'),
(14, 'ahahaha', 'ahaha', 'fadaha', 'gagaga', 'ahahah', 'ahahaha', 1234, 123, 'daaah', 'ahahajaj', 'IT-2k21-13'),
(15, 'ahahaha', 'ahaha', 'fadaha', 'gaga', 'aha', 'ahahaha', 1234, 123, 'daaah', 'ahahajaj', 'IT-2k21-14'),
(16, 'adhah', 'afjak', 'kajajaa', 'gjswjsaj', 'ajajaj', 'adjaja', 123, 1234, 'rjajaj', 'ahajaja', 'IT-2k21-15'),
(17, 'adhah', 'afjak', 'kajajaa', 'gjswjsaj', 'ajajaj', 'adjaja', 123, 1234, 'rjajaj', 'ahajaja', 'IT-2k21-16'),
(18, 'adhah', 'afjak', 'kajajaa', 'gjswjsaj', 'ajajaj', 'adjaja', 123, 1234, 'rjajaj', 'ahajaja', 'IT-2k21-17'),
(19, 'adhah', 'afjak', 'kajajaa', 'gjswjsaj', 'ajajaj', 'adjaja', 123, 1234, 'rjajaj', 'ahajaja', 'IT-2k21-18'),
(20, 'adhah', 'afjak', 'kajajaa', 'gjswjsaj', 'ajajaj', 'adjaja', 123, 1234, 'rjajaj', 'ahajaja', 'IT-2k21-19'),
(21, 'arjajaeaja', '', '', 'adhajaj', 'arjajaj', 'ajajaj', 1234, 234, 'aejaja', 'ajajkaj', 'IT-2k21-20'),
(22, 'arjajaeaja', '', '', 'adhajaj', 'arjajaj', 'ajajaj', 1234, 234, 'aejaja', 'ajajkaj', 'IT-2k21-21'),
(23, 'arjajaeaja', '', '', 'adhajaj', 'arjajaj', 'ajajaj', 1234, 234, 'aejaja', 'ajajkaj', 'IT-2k21-22'),
(24, 'arjajaeaja', '', '', 'adhajaj', 'arjajaj', 'ajajaj', 1234, 234, 'aejaja', 'ajajkaj', 'IT-2k21-23'),
(25, 'arjajaeaja', '', '', 'adhajaj', 'arjajaj', 'ajajaj', 1234, 234, 'aejaja', 'ajajkaj', 'IT-2k21-24'),
(26, 'arjajaeaja', '', '', 'adhajaj', 'arjajaj', 'ajajaj', 1234, 234, 'aejaja', 'ajajkaj', 'IT-2k21-25'),
(27, 'arjajaeaja', '', '', 'adhajaj', 'arjajaj', 'ajajaj', 1234, 234, 'aejaja', 'ajajkaj', 'IT-2k21-01');

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

--
-- Dumping data for table `issue_return`
--

INSERT INTO `issue_return` (`Issue_No`, `Issue_By`, `Member_Type`, `Issue_Bookno`, `Issue_Date`, `Return_Date`) VALUES
(1, '10', 'Student', 12, '2023-06-01', '2023-06-18'),
(2, 'IT-2k21-11', 'Student', 12, '2023-06-18', '2023-06-18'),
(3, 'IT-2k21-12', 'Student', 13, '2023-06-18', NULL),
(4, 'IT-2k21-13', 'Student', 14, '2023-06-18', NULL),
(5, 'IT-2k21-14', 'Student', 15, '2023-06-18', NULL),
(6, 'IT-2k21-15', 'Student', 16, '2023-06-18', NULL),
(7, 'IT-2k21-16', 'Student', 17, '2023-06-18', NULL),
(8, 'IT-2k21-17', 'Student', 18, '2023-06-18', NULL),
(9, 'IT-2k21-18', 'Student', 19, '2023-06-18', NULL),
(10, 'IT-2k21-19', 'Student', 20, '2023-06-18', NULL),
(11, 'IT-2k21-20', 'Student', 21, '2023-06-18', NULL),
(12, 'IT-2k21-21', 'Student', 22, '2023-06-18', NULL),
(13, 'IT-2k21-22', 'Student', 23, '2023-06-18', NULL),
(14, 'IT-2k21-23', 'Student', 24, '2023-06-18', NULL),
(15, 'IT-2k21-24', 'Student', 25, '2023-06-18', NULL),
(16, 'IT-2k21-25', 'Student', 26, '2023-06-18', NULL),
(17, 'IT-2k21-01', 'Student', 27, '2023-06-18', NULL),
(18, 'IT-2k21-01', 'Student', 12, '2023-06-18', NULL);

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
('10', 'Student'),
('IT-2k21-01', 'Student'),
('IT-2k21-02', 'Student'),
('IT-2k21-03', 'Student'),
('IT-2k21-04', 'Student'),
('IT-2k21-05', 'Student'),
('IT-2k21-06', 'Student'),
('IT-2k21-07', 'Student'),
('IT-2k21-08', 'Student'),
('IT-2k21-09', 'Student'),
('IT-2k21-10', 'Student'),
('IT-2k21-11', 'Student'),
('IT-2k21-12', 'Student'),
('IT-2k21-13', 'Student'),
('IT-2k21-14', 'Student'),
('IT-2k21-15', 'Student'),
('IT-2k21-16', 'Student'),
('IT-2k21-17', 'Student'),
('IT-2k21-18', 'Student'),
('IT-2k21-19', 'Student'),
('IT-2k21-20', 'Student'),
('IT-2k21-21', 'Student'),
('IT-2k21-22', 'Student'),
('IT-2k21-23', 'Student'),
('IT-2k21-24', 'Student'),
('IT-2k21-25', 'Student');

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
('10', 'Soham Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102058'),
('IT-2k21-01', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102001'),
('IT-2k21-02', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102002'),
('IT-2k21-03', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102003'),
('IT-2k21-04', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102004'),
('IT-2k21-05', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102005'),
('IT-2k21-06', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102006'),
('IT-2k21-07', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102007'),
('IT-2k21-08', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102008'),
('IT-2k21-09', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102009'),
('IT-2k21-10', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102010'),
('IT-2k21-11', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102011'),
('IT-2k21-12', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102012'),
('IT-2k21-13', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102013'),
('IT-2k21-14', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102014'),
('IT-2k21-15', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102015'),
('IT-2k21-16', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102016'),
('IT-2k21-17', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102017'),
('IT-2k21-18', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102018'),
('IT-2k21-19', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102019'),
('IT-2k21-20', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102020'),
('IT-2k21-21', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102021'),
('IT-2k21-22', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102022'),
('IT-2k21-23', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102023'),
('IT-2k21-24', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102024'),
('IT-2k21-25', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102025'),
('IT-2k21-26', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102026'),
('IT-2k21-27', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102027'),
('IT-2k21-28', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102028'),
('IT-2k21-29', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102029'),
('IT-2k21-30', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102030'),
('IT-2k21-31', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102031'),
('IT-2k21-32', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102032'),
('IT-2k21-33', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102033'),
('IT-2k21-34', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102034'),
('IT-2k21-35', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102035'),
('IT-2k21-36', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102036'),
('IT-2k21-37', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102037'),
('IT-2k21-38', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102038'),
('IT-2k21-39', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102039'),
('IT-2k21-40', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102040'),
('IT-2k21-41', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102041'),
('IT-2k21-42', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102042'),
('IT-2k21-43', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102043'),
('IT-2k21-44', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102044'),
('IT-2k21-45', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102045'),
('IT-2k21-46', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102046'),
('IT-2k21-47', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102047'),
('IT-2k21-48', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102048'),
('IT-2k21-49', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102049'),
('IT-2k21-50', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102050'),
('IT-2k21-51', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102051'),
('IT-2k21-52', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102052'),
('IT-2k21-53', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102053'),
('IT-2k21-54', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102054'),
('IT-2k21-55', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102055'),
('IT-2k21-56', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102056'),
('IT-2k21-57', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102057'),
('IT-2k21-58', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102058'),
('IT-2k21-59', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102059'),
('IT-2k21-60', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102060'),
('IT-2k21-61', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102061'),
('IT-2k21-62', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102062'),
('IT-2k21-63', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102063'),
('IT-2k21-64', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102064'),
('IT-2k21-65', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102065'),
('IT-2k21-66', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102066'),
('IT-2k21-67', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102067'),
('IT-2k21-68', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102068'),
('IT-2k21-69', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102069'),
('IT-2k21-70', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102070'),
('IT-2k21-71', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102071'),
('IT-2k21-72', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102072'),
('IT-2k21-73', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102073'),
('IT-2k21-74', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102074'),
('IT-2k21-75', 'Nathkhat Kothari', 'MTech IT [5yrs]', 'DE2102075');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
