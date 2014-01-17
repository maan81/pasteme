-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 17, 2014 at 05:10 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.7-1+sury.org~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pasteme`
--

-- --------------------------------------------------------

--
-- Table structure for table `pasteme_table`
--

CREATE TABLE IF NOT EXISTS `pasteme_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id of the text',
  `text` text NOT NULL COMMENT 'The text to be stored',
  `d` int(3) NOT NULL COMMENT 'The number of days to be stored',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pasteme_table`
--

INSERT INTO `pasteme_table` (`id`, `text`, `d`, `created_at`) VALUES
(1, 'asdfasdf', 222, '2014-01-17 11:04:51'),
(2, 'eee', 30, '2014-01-17 11:18:53'),
(3, 'eas kdfj;alef awe fwaeg', 365, '2014-01-17 11:19:09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
