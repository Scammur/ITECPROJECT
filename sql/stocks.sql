-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2025 at 04:48 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itc`
--

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `item` varchar(100) NOT NULL,
  `bar` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `price` float(255,2) NOT NULL,
  `id` int(10) NOT NULL,
  `stock` int(255) DEFAULT NULL,
  `notified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`item`, `bar`, `category`, `location`, `price`, `id`, `stock`, `notified`) VALUES
('MOUSE', 'SKU-401', 'ELECTRONICS', 'RACK 1A', 120.00, 1, 193, 0),
('keyboard', 'SKU-402', 'ELECTRONICS', 'RACK 1A', 400.00, 2, 120, 0),
('cpu', 'SKU-403', 'ELECTRONICS', 'RACK 1A', 6000.00, 3, 356, 0),
('headset', 'SKU-406', 'ELECTRONICS', 'RACK 1A', 800.00, 4, 359, 0),
('DOOR', 'SKU-303', 'APPLIANCES', 'RACK 2A', 4300.00, 5, 700, 0),
('door knob', 'SKU-304', 'APPLIANCES', 'RACK 2A', 500.00, 6, 5, 1),
('WINDOW', 'SKU-305', 'APPLIANCES', 'RACK 2A', 2300.00, 7, 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
