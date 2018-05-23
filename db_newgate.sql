-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 23, 2018 at 11:22 AM
-- Server version: 5.7.21
-- PHP Version: 7.0.29

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_newgate`
--
CREATE DATABASE IF NOT EXISTS `db_newgate` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_newgate`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_allergies`
--

DROP TABLE IF EXISTS `tbl_allergies`;
CREATE TABLE IF NOT EXISTS `tbl_allergies` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `patientID` int(11) NOT NULL,
  `desription` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `patient-allergies` (`patientID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diagnosis`
--

DROP TABLE IF EXISTS `tbl_diagnosis`;
CREATE TABLE IF NOT EXISTS `tbl_diagnosis` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sessionID` int(11) NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `session-diagnosis` (`sessionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patients`
--

DROP TABLE IF EXISTS `tbl_patients`;
CREATE TABLE IF NOT EXISTS `tbl_patients` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_num` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `height` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_patients`
--

INSERT INTO `tbl_patients` (`ID`, `firstname`, `lastname`, `email`, `phone_num`, `dob`, `height`, `weight`) VALUES
(1, 'deji', 'akande', 'dejiakande33@gmail.com', '08143671138', '1998-11-06', 34, 50),
(2, 'isaac', 'olawale', 'isaac@olawale.com', '5557775555', '1998-05-13', 91, 80),
(3, 'jedidiah', 'enikuomehin', 'jedidiah@jed.com', '08012345678', '2001-02-03', 59, 34);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prescriptions`
--

DROP TABLE IF EXISTS `tbl_prescriptions`;
CREATE TABLE IF NOT EXISTS `tbl_prescriptions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `diagnosisID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dosage` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `diagnosis-prescription` (`diagnosisID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questionnaires`
--

DROP TABLE IF EXISTS `tbl_questionnaires`;
CREATE TABLE IF NOT EXISTS `tbl_questionnaires` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `jsonQ` varchar(60000) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_questionnaires`
--

INSERT INTO `tbl_questionnaires` (`ID`, `title`, `jsonQ`) VALUES
(1, 'Dummy Title', '{\"1\":\"Question 1\",\"2\":\"Question 2\",\"3\":\"Question 3.5.5.\"}'),
(2, 'Dummy Titler', '{\"1\": \"Question 1\", \"2\": \"Question 2.5.5\", \"3\": \"Question 3\"}');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `role` enum('ADMIN','DOCTOR','SUPPORT') NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`ID`, `userID`, `role`) VALUES
(1, 1, 'ADMIN'),
(2, 3, 'DOCTOR'),
(3, 1, 'DOCTOR');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sessions`
--

DROP TABLE IF EXISTS `tbl_sessions`;
CREATE TABLE IF NOT EXISTS `tbl_sessions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `patientID` int(11) NOT NULL,
  `consultation_bill` float NOT NULL,
  `startdate` date NOT NULL,
  `paid` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `patient-sessions` (`patientID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`ID`, `email`, `firstname`, `lastname`, `password`) VALUES
(1, 'admin1@newgate.ho', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(3, 'doc1@newgate.ho', 'donald', 'doc', 'a5beb9d1b0e50129affe6e13e42d9e5f5942cda7');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_allergies`
--
ALTER TABLE `tbl_allergies`
  ADD CONSTRAINT `patient-allergies` FOREIGN KEY (`patientID`) REFERENCES `tbl_patients` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_diagnosis`
--
ALTER TABLE `tbl_diagnosis`
  ADD CONSTRAINT `session-diagnosis` FOREIGN KEY (`sessionID`) REFERENCES `tbl_sessions` (`ID`);

--
-- Constraints for table `tbl_prescriptions`
--
ALTER TABLE `tbl_prescriptions`
  ADD CONSTRAINT `diagnosis-prescription` FOREIGN KEY (`diagnosisID`) REFERENCES `tbl_diagnosis` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD CONSTRAINT `tbl_roles_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tbl_users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_sessions`
--
ALTER TABLE `tbl_sessions`
  ADD CONSTRAINT `patient-sessions` FOREIGN KEY (`patientID`) REFERENCES `tbl_patients` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
