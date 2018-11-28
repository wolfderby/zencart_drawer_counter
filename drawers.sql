-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2018 at 09:14 PM
-- Server version: 5.6.41-84.1
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
-- Database: `plankeye_gatorhut`
--

-- --------------------------------------------------------

--
-- Table structure for table `drawers`
--

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
  `qrolls` float NOT NULL,
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
  `comments` varchar(64) CHARACTER SET utf16 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
