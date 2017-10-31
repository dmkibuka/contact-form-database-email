-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2017 at 03:43 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydemo`
--
CREATE DATABASE IF NOT EXISTS `mydemo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mydemo`;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_first_name` varchar(45) NOT NULL COMMENT 'customer First name',
  `customer_last_name` varchar(45) NOT NULL COMMENT 'customer last name',
  `customer_email` varchar(45) NOT NULL COMMENT 'Customer Email',
  `customer_phone` varchar(16) NOT NULL COMMENT 'Customer Phone number'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `maillist`
--

CREATE TABLE `maillist` (
  `maillist_id` int(11) NOT NULL,
  `maillist_email` varchar(45) NOT NULL COMMENT 'subscription email',
  `customer_customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_email_UNIQUE` (`customer_email`);

--
-- Indexes for table `maillist`
--
ALTER TABLE `maillist`
  ADD PRIMARY KEY (`maillist_id`),
  ADD UNIQUE KEY `maillist_email_UNIQUE` (`maillist_email`),
  ADD KEY `fk_maillist_customer1_idx` (`customer_customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `maillist`
--
ALTER TABLE `maillist`
  MODIFY `maillist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `maillist`
--
ALTER TABLE `maillist`
  ADD CONSTRAINT `fk_maillist_customer1` FOREIGN KEY (`customer_customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
