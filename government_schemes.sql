-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 20, 2024 at 12:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `government_schemes`
--

-- --------------------------------------------------------

--
-- Table structure for table `schemes`
--

CREATE TABLE `schemes` (
  `id` int(11) NOT NULL,
  `scheme_name` varchar(255) NOT NULL,
  `state` varchar(100) NOT NULL,
  `age_group` varchar(50) DEFAULT NULL,
  `caste` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schemes`
--

INSERT INTO `schemes` (`id`, `scheme_name`, `state`, `age_group`, `caste`) VALUES
(3, 'Karnataka Pension Scheme', 'Karnataka', '60+', 'OBC'),
(5, 'Tamil Nadu Pension Scheme', 'Tamil Nadu', '60+', 'OC, SC, ST, BC,OBC'),
(6, 'Kissan Subsidy Scheme', 'Tamil Nadu', '19-60', 'ST, SC'),
(7, 'Telangana Pension Scheme', 'Maharashtra', '60+', 'BC,ST'),
(8, 'Kissan Subsidy Scheme', 'Telangana', '19-60', 'ST, SC'),
(10, 'Kissan Subsidy Scheme', 'Telangana', '19-60', 'ST, SC, OC'),
(11, 'Karnataka Pension Scheme', 'Karnataka', '0-18', 'OBC'),
(13, 'Karnataka Pension Scheme', 'Kerala', '0-18', 'OBC'),
(14, 'Karnataka Pension Scheme', 'Orrisa', '0-18', 'OBC'),
(15, 'Karnataka Pension Scheme', 'Madhya Pradesh', '0-18', 'OBC'),
(16, 'Kissan Subsidy Scheme', 'Gujarat', '19-60', 'ST, SC, OC'),
(17, 'Tamil Nadu Pension Scheme', 'Delhi', '60+', 'OC, SC, ST, BC,OBC'),
(18, 'Karnataka Pension Scheme', 'Uttar Pradesh', '60+', 'OBC'),
(19, 'Karnataka Pension Scheme', 'Haryana', '60+', 'OBC'),
(20, 'Karnataka Pension Scheme', 'Punjab', '60+', 'OBC'),
(21, 'Karnataka Pension Scheme', 'Goa', '0-18', 'OBC'),
(22, 'Kissan Subsidy Scheme', 'West Bengal', '19-60', 'ST, SC'),
(23, 'Karnataka Pension Scheme', 'Assam', '60+', 'OBC'),
(24, 'Kissan Subsidy Scheme', 'Mizoram', '19-60', 'ST, SC, OBC'),
(25, 'Kissan Subsidy Scheme', 'Bihar', '19-60', 'ST, SC'),
(26, 'Tamil Nadu Pension Scheme', 'Uttarakhand', '60+', 'OC, SC, ST, BC,OBC'),
(27, 'Test Scheme', 'Karnataka', '0-18', 'OC, BC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `schemes`
--
ALTER TABLE `schemes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `schemes`
--
ALTER TABLE `schemes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
