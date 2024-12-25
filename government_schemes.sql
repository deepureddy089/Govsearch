-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2024 at 11:49 AM
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
  `caste` varchar(50) DEFAULT NULL,
  `state_logo` varchar(255) DEFAULT NULL,
  `scheme_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schemes`
--

INSERT INTO `schemes` (`id`, `scheme_name`, `state`, `age_group`, `caste`, `state_logo`, `scheme_link`) VALUES
(3, 'Karnataka Pension Scheme', 'Karnataka', '60+', 'OBC', NULL, NULL),
(5, 'Tamil Nadu Pension Scheme', 'Tamil Nadu', '60+', 'OC, SC, ST, BC,OBC', NULL, NULL),
(6, 'Kissan Subsidy Scheme', 'Tamil Nadu', '19-60', 'ST, SC', NULL, NULL),
(7, 'Telangana Pension Scheme', 'Maharashtra', '60+', 'BC,ST', NULL, NULL),
(8, 'Kissan Subsidy Scheme', 'Telangana', '19-60', 'ST, SC', NULL, NULL),
(10, 'Kissan Subsidy Scheme', 'Telangana', '19-60', 'ST, SC, OC', NULL, NULL),
(11, 'Karnataka Pension Scheme', 'Karnataka', '0-18', 'OBC', NULL, NULL),
(13, 'Karnataka Pension Scheme', 'Kerala', '0-18', 'OBC', NULL, NULL),
(14, 'Karnataka Pension Scheme', 'Orrisa', '0-18', 'OBC', NULL, NULL),
(15, 'Karnataka Pension Scheme', 'Madhya Pradesh', '0-18', 'OBC', NULL, NULL),
(16, 'Kissan Subsidy Scheme', 'Gujarat', '19-60', 'ST, SC, OC', NULL, NULL),
(17, 'Tamil Nadu Pension Scheme', 'Delhi', '60+', 'OC, SC, ST, BC,OBC', NULL, NULL),
(18, 'Karnataka Pension Scheme', 'Uttar Pradesh', '60+', 'OBC', NULL, NULL),
(19, 'Karnataka Pension Scheme', 'Haryana', '60+', 'OBC', NULL, NULL),
(20, 'Karnataka Pension Scheme', 'Punjab', '60+', 'OBC', NULL, NULL),
(23, 'Karnataka Pension Scheme', 'Assam', '60+', 'OBC', NULL, NULL),
(24, 'Kissan Subsidy Scheme', 'Mizoram', '19-60', 'ST, SC, OBC', NULL, NULL),
(25, 'Kissan Subsidy Scheme', 'Bihar', '19-60', 'ST, SC', NULL, NULL),
(26, 'Tamil Nadu Pension Scheme', 'Uttarakhand', '60+', 'OC, SC, ST, BC,OBC', NULL, NULL),
(27, 'Test Scheme', 'Karnataka', '0-18', 'OC, BC', NULL, NULL),
(28, 'Asset Sales', 'Punjab', '0-18', 'OC, BC', 'https://assetsalesindia.com/', 'https://assetsalesindia.com/'),
(29, 'Asset Sales', 'Bihar', '0-18', 'OC, BC', 'https://assetsalesindia.com/', 'https://assetsalesindia.com/');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
