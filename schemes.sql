-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 19, 2024 at 09:28 AM
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
  `eligibility` text NOT NULL,
  `age_bracket` varchar(50) DEFAULT NULL,
  `caste` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schemes`
--

INSERT INTO `schemes` (`id`, `scheme_name`, `state`, `eligibility`, `age_bracket`, `caste`) VALUES
(1, 'Andhra Pradesh Pension Scheme', 'Andhra Pradesh', 'Eligibility for all castes', '60+', 'All'),
(2, 'Kissan Subsidy Scheme', 'Andhra Pradesh', 'Eligibility for ST, SC, age above 18', '19-60', 'ST, SC'),
(3, 'Karnataka Pension Scheme', 'Karnataka', 'Eligibility for all castes', '60+', 'All'),
(4, 'Kissan Subsidy Scheme', 'Karnataka', 'Eligibility for ST, SC, age above 18', '19-60', 'ST, SC'),
(5, 'Tamil Nadu Pension Scheme', 'Tamil Nadu', 'Eligibility for all castes', '60+', 'All'),
(6, 'Kissan Subsidy Scheme', 'Tamil Nadu', 'Eligibility for ST, SC, age above 18', '19-60', 'ST, SC'),
(7, 'Telangana Pension Scheme', 'Telangana', 'Eligibility for all castes', '60+', 'All'),
(8, 'Kissan Subsidy Scheme', 'Telangana', 'Eligibility for ST, SC, age above 18', '19-60', 'ST, SC');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
