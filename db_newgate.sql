-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 06, 2018 at 12:18 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--
CREATE DATABASE IF NOT EXISTS `app` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `app`;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL,
  `code` varchar(2) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`) VALUES
(1, 'GB', 'Great Britain'),
(2, 'US', 'United States');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
CREATE TABLE IF NOT EXISTS `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `bio` text NOT NULL,
  `country` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `first_name`, `last_name`, `bio`, `country`, `created`) VALUES
(1, 'Alex', 'Garret', 'I\'m a web developer', 1, '2018-05-01 16:15:40'),
(2, 'Billy', 'Garret', 'I am Alex brother', 2, '2018-05-01 16:17:51'),
(3, 'Bill', 'Smith', 'I am a nurse', 1, '2018-05-01 16:51:31'),
(9, 'Alex', 'Boole', 'Hello', 1, '2018-05-02 00:59:23');
--
-- Database: `csc401_140805023`
--
CREATE DATABASE IF NOT EXISTS `csc401_140805023` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `csc401_140805023`;

-- --------------------------------------------------------

--
-- Table structure for table `catalog_sku_2014`
--

DROP TABLE IF EXISTS `catalog_sku_2014`;
CREATE TABLE IF NOT EXISTS `catalog_sku_2014` (
  `CatalogID` int(11) NOT NULL,
  `SKU` int(11) NOT NULL,
  `SKU_Description` varchar(35) NOT NULL,
  `Department` varchar(30) NOT NULL,
  `CatalogPage` int(11) DEFAULT NULL,
  `DateOnWebSite` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catalog_sku_2014`
--

INSERT INTO `catalog_sku_2014` (`CatalogID`, `SKU`, `SKU_Description`, `Department`, `CatalogPage`, `DateOnWebSite`) VALUES
(20140001, 100100, 'Std. Scuba Tank, Yellow', 'Water Sports', 23, '2014-01-01'),
(20140002, 100300, 'Std. Scuba Tank, Light Blue', 'Water Sports', 23, '2014-01-01'),
(20140003, 100400, 'Std. Scuba Tank, Dark Blue', 'Water Sports', 0, '2014-08-01'),
(20140004, 101100, 'Dive Mask, Small Clear', 'Water Sports', 26, '2014-01-01'),
(20140005, 101200, 'Dive Mask, Med Clear', 'Water Sports', 26, '2014-01-01'),
(20140006, 201000, 'Half-dome Tent', 'Camping', 46, '2014-01-01'),
(20140007, 202000, 'Half-dome Tent Vestibule', 'Camping', 46, '2014-01-01'),
(20140008, 301000, 'Light Fly Climbing Harness', 'Climbing', 77, '2014-01-01'),
(20140009, 302000, 'Locking Carabiner, Oval', 'Climbing', 79, '2014-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `catalog_sku_2015`
--

DROP TABLE IF EXISTS `catalog_sku_2015`;
CREATE TABLE IF NOT EXISTS `catalog_sku_2015` (
  `CatalogID` int(11) NOT NULL,
  `SKU` int(11) NOT NULL,
  `SKU_Description` varchar(35) NOT NULL,
  `Department` varchar(30) NOT NULL,
  `CatalogPage` int(11) DEFAULT NULL,
  `DateOnWebsite` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catalog_sku_2015`
--

INSERT INTO `catalog_sku_2015` (`CatalogID`, `SKU`, `SKU_Description`, `Department`, `CatalogPage`, `DateOnWebsite`) VALUES
(20150001, 100100, 'Std, Scuba Tank, Yellow', 'Water Sports', 23, '2015-01-01'),
(20150002, 100200, 'Std, Scuba Tank, Magenta', 'Water Sports', 23, '2015-01-01'),
(20150003, 101100, 'Dive Mask, Small Clear', 'Water Sports', 27, '2015-01-08'),
(20150004, 101200, 'Dive Mask, Med Clear', 'Water Sports', 27, '2015-01-01'),
(20150005, 201000, 'Half-dome Tent', 'Camping', 45, '2015-01-01'),
(20150006, 202000, 'Half-dome Tent Vestibule', 'Camping', 45, '2015-01-01'),
(20150007, 203000, 'Half-dome Tent Vestibule - Wide', 'Camping', 0, '2015-01-04'),
(20150008, 301000, 'Light Fly Climbing Harness', 'Climbing', 76, '2015-01-01'),
(20150009, 302000, 'Locking Carabiner, Oval', 'Climbing', 78, '2015-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
CREATE TABLE IF NOT EXISTS `order_item` (
  `OrderNumber` int(11) NOT NULL,
  `SKU` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(11,0) NOT NULL,
  `Extended` decimal(11,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`OrderNumber`, `SKU`, `Quantity`, `Price`, `Extended`) VALUES
(1000, 201000, 1, '300', '300'),
(1000, 202000, 1, '130', '130'),
(2000, 101100, 4, '50', '200'),
(2000, 101200, 2, '50', '100'),
(3000, 100200, 1, '300', '300'),
(3000, 101100, 2, '50', '100'),
(3000, 101200, 1, '50', '50');

-- --------------------------------------------------------

--
-- Table structure for table `retail_order`
--

DROP TABLE IF EXISTS `retail_order`;
CREATE TABLE IF NOT EXISTS `retail_order` (
  `OrderNumber` int(11) NOT NULL,
  `StoreNumber` int(11) NOT NULL,
  `StoreZIP` varchar(9) NOT NULL,
  `OrderMonth` varchar(12) NOT NULL,
  `OrderYear` int(11) NOT NULL,
  `OrderTotal` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retail_order`
--

INSERT INTO `retail_order` (`OrderNumber`, `StoreNumber`, `StoreZIP`, `OrderMonth`, `OrderYear`, `OrderTotal`) VALUES
(1000, 10, '98110', 'December', 2014, 445),
(2000, 20, '02335', 'December', 2014, 310),
(3000, 10, '98110', 'January', 2015, 480);

-- --------------------------------------------------------

--
-- Table structure for table `sku_data`
--

DROP TABLE IF EXISTS `sku_data`;
CREATE TABLE IF NOT EXISTS `sku_data` (
  `SKU` int(11) NOT NULL,
  `SKU_Description` varchar(35) NOT NULL,
  `Department` varchar(30) NOT NULL,
  `Buyer` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sku_data`
--

INSERT INTO `sku_data` (`SKU`, `SKU_Description`, `Department`, `Buyer`) VALUES
(100100, 'Std. Scuba Tank, Yellow', 'Water Sports', 'Pete Hansen'),
(100200, 'Std. Scuba Tank, Magenta', 'Water Sports', 'Pete Hansen'),
(101100, 'Dive Mask, Small Clear', 'Water Sports', 'Nancy Meyers'),
(101200, 'Dive Mask, Med Clear', 'Water Sports', 'Nancy Meyers'),
(201000, 'Half-dome Tent', 'Camping', 'Cindy Lo'),
(202000, 'Half-domeTent Vestibule', 'Camping', 'Cindy Lo'),
(301000, 'Light Fly Climbing Harness', 'Climbing', 'Jerry Martin'),
(302000, 'Locking Carabiner, Oval', 'Climbing', 'Jerry Martin');
--
-- Database: `db_newgate`
--
CREATE DATABASE IF NOT EXISTS `db_newgate` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_newgate`;

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
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phoneno` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`ID`, `email`, `firstname`, `lastname`, `phoneno`, `password`) VALUES
(1, 'admin1@newgate.ho', 'admin', 'admin', '08012345678', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(3, 'doc1@newgate.ho', 'donald', 'doc', '08025697854', 'a5beb9d1b0e50129affe6e13e42d9e5f5942cda7');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD CONSTRAINT `tbl_roles_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tbl_users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `publications`
--
CREATE DATABASE IF NOT EXISTS `publications` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `publications`;

-- --------------------------------------------------------

--
-- Table structure for table `classics`
--

DROP TABLE IF EXISTS `classics`;
CREATE TABLE IF NOT EXISTS `classics` (
  `author` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `category` varchar(16) DEFAULT NULL,
  `year` smallint(6) DEFAULT NULL,
  `isbn` char(13) NOT NULL,
  PRIMARY KEY (`isbn`),
  KEY `author` (`author`(20)),
  KEY `title` (`title`(20)),
  KEY `category` (`category`(4)),
  KEY `year` (`year`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classics`
--

INSERT INTO `classics` (`author`, `title`, `category`, `year`, `isbn`) VALUES
('Mark Twain', 'The Adventures of Tom Sawyer', 'Fiction', 1876, '9781598184891'),
('Jane Austen', 'Pride and Prejudice', 'Fiction', 1811, '9780582506206'),
('Charles Darwin', 'The Origin of Species', 'Non-Fiction', 1856, '9780517123201'),
('Charles Dickens', 'The Old Curiosity Shop', 'Fiction', 1841, '9780099533474'),
('William Shakespeare', 'Romeo and Juliet', 'Play', 1594, '9780192814968');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `name` varchar(128) DEFAULT NULL,
  `isbn` varchar(13) NOT NULL,
  PRIMARY KEY (`isbn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`name`, `isbn`) VALUES
('Joe Bloggs', '9780099533474'),
('Mary Smith', '9780582506206'),
('Jack Wilson', '9780517123201');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classics`
--
ALTER TABLE `classics` ADD FULLTEXT KEY `author_2` (`author`,`title`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
