-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 24, 2018 at 01:29 PM
-- Server version: 5.7.21
-- PHP Version: 7.0.29

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
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `patient-allergies` (`patientID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_allergies`
--

INSERT INTO `tbl_allergies` (`ID`, `patientID`, `description`) VALUES
(1, 8, 'Allergic to silverware');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diagnosis`
--

DROP TABLE IF EXISTS `tbl_diagnosis`;
CREATE TABLE IF NOT EXISTS `tbl_diagnosis` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sessionID` int(11) NOT NULL,
  `patientID` int(11) NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  `ddate` date NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `session-diagnosis` (`sessionID`),
  KEY `patient-diagnosis` (`patientID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_diagnosis`
--

INSERT INTO `tbl_diagnosis` (`ID`, `sessionID`, `patientID`, `diagnosis`, `ddate`) VALUES
(1, 5, 8, 'Mild Disorientation', '2018-05-24');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_patients`
--

INSERT INTO `tbl_patients` (`ID`, `firstname`, `lastname`, `email`, `phone_num`, `dob`, `height`, `weight`) VALUES
(1, 'Adedeji', 'Akande', 'dejiakande33@gmail.com', '08143671138', '1998-11-06', 34, 50),
(2, 'Isaac', 'Olawale', 'isaac@olawale.com', '5557775555', '1998-05-13', 91, 80),
(3, 'jedidiah', 'enikuomehin', 'jedidiah@jed.com', '08012345678', '2001-02-03', 59, 34),
(4, 'Don', 'Falcone', 'don@falcone.com', '7779998889', '1984-05-16', 44, 51),
(8, 'John', 'Titor', 'john@titor.com', '09078996754', '1867-03-14', 45, 45);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prescriptions`
--

DROP TABLE IF EXISTS `tbl_prescriptions`;
CREATE TABLE IF NOT EXISTS `tbl_prescriptions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `diagnosisID` int(11) NOT NULL,
  `patientID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dosage` varchar(255) NOT NULL,
  `bill` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `diagnosis-prescription` (`diagnosisID`),
  KEY `patient-prescription` (`patientID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_prescriptions`
--

INSERT INTO `tbl_prescriptions` (`ID`, `diagnosisID`, `patientID`, `name`, `dosage`, `bill`) VALUES
(1, 1, 8, 'Effective Transmission', '5mg daily', 5000);

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
  `docID` int(11) NOT NULL,
  `consultation_bill` float NOT NULL,
  `startdate` date NOT NULL,
  `paid` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `patient-sessions` (`patientID`),
  KEY `doc-sessions` (`docID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sessions`
--

INSERT INTO `tbl_sessions` (`ID`, `patientID`, `docID`, `consultation_bill`, `startdate`, `paid`) VALUES
(1, 1, 1, 345, '2018-05-09', 0),
(2, 2, 3, 300, '2018-05-08', 0),
(3, 3, 1, 222, '2018-05-15', 0),
(4, 4, 3, 44, '2018-05-07', 0),
(5, 8, 3, 45, '2018-05-24', 0);

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
  ADD CONSTRAINT `patient-diagnosis` FOREIGN KEY (`patientID`) REFERENCES `tbl_patients` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `session-diagnosis` FOREIGN KEY (`sessionID`) REFERENCES `tbl_sessions` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_prescriptions`
--
ALTER TABLE `tbl_prescriptions`
  ADD CONSTRAINT `diagnosis-prescription` FOREIGN KEY (`diagnosisID`) REFERENCES `tbl_diagnosis` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient-prescription` FOREIGN KEY (`patientID`) REFERENCES `tbl_patients` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD CONSTRAINT `tbl_roles_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tbl_users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_sessions`
--
ALTER TABLE `tbl_sessions`
  ADD CONSTRAINT `doc-sessions` FOREIGN KEY (`docID`) REFERENCES `tbl_users` (`ID`),
  ADD CONSTRAINT `patient-sessions` FOREIGN KEY (`patientID`) REFERENCES `tbl_patients` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
