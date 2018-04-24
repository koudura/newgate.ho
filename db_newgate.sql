-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 24, 2018 at 11:28 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

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

-- --------------------------------------------------------

--
-- Table structure for table `rel_user_roles`
--

DROP TABLE IF EXISTS `rel_user_roles`;
CREATE TABLE IF NOT EXISTS `rel_user_roles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `roleID` (`roleID`),
  KEY `rel_user_roles_ibfk_2` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rel_user_roles`
--

INSERT INTO `rel_user_roles` (`ID`, `userID`, `roleID`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`ID`, `name`) VALUES
(1, 'ADMIN'),
(2, 'DOCTOR'),
(3, 'SUPPORT');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`ID`, `email`, `password`) VALUES
(1, 'admin1@newgate.ho', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(3, 'doc1@newgate.ho', 'a5beb9d1b0e50129affe6e13e42d9e5f5942cda7');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rel_user_roles`
--
ALTER TABLE `rel_user_roles`
  ADD CONSTRAINT `rel_user_roles_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `tbl_roles` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rel_user_roles_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `tbl_users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
