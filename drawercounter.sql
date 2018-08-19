-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 19, 2018 at 01:43 AM
-- Server version: 5.6.39-83.1
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drawercounter`
--
CREATE DATABASE IF NOT EXISTS `drawercounter` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `drawercounter`;

-- --------------------------------------------------------

--
-- Table structure for table `drawers`
--

DROP TABLE IF EXISTS `drawers`;
CREATE TABLE `drawers` (
  `id` int(11) NOT NULL,
  `drawertype` varchar(32) CHARACTER SET utf16 NOT NULL,
  `drawerdate` datetime DEFAULT NULL,
  `hundos` int(11) NOT NULL,
  `fifties` int(11) NOT NULL,
  `twenties` int(11) NOT NULL,
  `tens` int(11) NOT NULL,
  `fives` int(11) NOT NULL,
  `twos` int(11) NOT NULL,
  `ones` int(11) NOT NULL,
  `qrolls` decimal(10,0) NOT NULL,
  `drolls` float NOT NULL,
  `nrolls` float NOT NULL,
  `prolls` float NOT NULL,
  `odcoins` int(11) NOT NULL,
  `hdcoins` int(11) NOT NULL,
  `qcoins` int(11) NOT NULL,
  `dcoins` int(11) NOT NULL,
  `ncoins` int(11) NOT NULL,
  `pcoins` int(11) NOT NULL,
  `total` float NOT NULL,
  `initials` varchar(32) CHARACTER SET utf16 NOT NULL,
  `comments` varchar(32) CHARACTER SET utf16 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `drawers`
--

INSERT INTO `drawers` (`id`, `drawertype`, `drawerdate`, `hundos`, `fifties`, `twenties`, `tens`, `fives`, `twos`, `ones`, `qrolls`, `drolls`, `nrolls`, `prolls`, `odcoins`, `hdcoins`, `qcoins`, `dcoins`, `ncoins`, `pcoins`, `total`, `initials`, `comments`) VALUES
(41, 'open', '2018-08-05 01:05:17', 1, 1, 1, 1, 1, 1, 1, '1', 1, 1, 1, 1, 2, 3, 4, 5, 6, 208.96, 'BB', 'test1'),
(42, 'close', '2018-08-05 01:08:18', 2, 1, 1, 1, 1, 1, 1, '1', 1, 1, 1, 1, 1, 1, 1, 1, 1, 307.41, 'BB', 'test2'),
(60, 'open', '2018-08-18 12:52:02', 1, 0, 14, 4, 2, 0, 17, '2', 1, 0, 0.5, 0, 0, 4, 16, 10, 2, 470.37, 'BB', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drawers`
--
ALTER TABLE `drawers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drawers`
--
ALTER TABLE `drawers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
