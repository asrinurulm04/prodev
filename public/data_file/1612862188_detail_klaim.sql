-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 09, 2021 at 07:17 AM
-- Server version: 10.2.16-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prodev`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_klaim`
--

CREATE TABLE IF NOT EXISTS `detail_klaim` (
  `id` int(11) NOT NULL,
  `id_komponen` int(11) NOT NULL,
  `detail` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_klaim`
--

INSERT INTO `detail_klaim` (`id`, `id_komponen`, `detail`) VALUES
(1, 9, 'Vitamin A'),
(2, 9, 'Vitamin B1'),
(3, 9, 'Vitamin B2'),
(4, 9, 'Vitamin B3'),
(5, 9, 'Vitamin B5'),
(6, 9, 'Vitamin B6'),
(7, 9, 'Vitamin B7'),
(8, 9, 'Vitamin B12'),
(9, 9, 'Vitamin C'),
(10, 9, 'Vitamin D3'),
(11, 9, 'Vitamin E'),
(12, 9, 'Asam Folat'),
(13, 9, 'Kalsium'),
(15, 9, 'Fosfor'),
(16, 9, 'Magnesium'),
(17, 9, 'Seng'),
(18, 9, 'Selenium'),
(19, 9, 'Iodium'),
(20, 9, 'Mangan'),
(21, 9, 'Fluor'),
(22, 9, 'Tembaga'),
(23, 9, ' Kolin'),
(24, 9, 'Kromium'),
(25, 9, 'vitamin all'),
(26, 9, 'mineral all'),
(27, 11, 'Asam Folat'),
(28, 11, 'Kalsium'),
(29, 11, 'Fosfor'),
(30, 11, 'Magnesium'),
(31, 11, 'Seng'),
(32, 11, 'Selenium'),
(33, 11, 'Iodium'),
(34, 11, 'Mangan'),
(35, 11, 'Fluor'),
(36, 11, ' Kolin'),
(37, 11, 'mineral all'),
(38, 12, 'Vitamin A'),
(39, 12, 'Vitamin B1'),
(40, 12, 'Vitamin B2'),
(41, 12, 'Vitamin B3'),
(42, 12, 'Vitamin B5'),
(43, 12, 'Vitamin B6'),
(44, 12, 'Vitamin B7'),
(45, 12, 'Vitamin B12'),
(46, 12, 'Vitamin C'),
(47, 12, 'Vitamin D3'),
(48, 12, 'Vitamin E'),
(49, 12, 'vitamin all');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_klaim`
--
ALTER TABLE `detail_klaim`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_klaim`
--
ALTER TABLE `detail_klaim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
