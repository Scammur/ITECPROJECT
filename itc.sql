-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2025 at 05:52 AM
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
('Gaming Keyboard', 'COM-LOG-GPROX-W-BK', 'Computer Hardware & Peripherals', 'RACK 5A', 299.00, 22, 300, 0),
('Smart Refrigerator', 'HOM-LG-LMXS28596S-28-SS', 'Home Appliances', 'RACK 1B', 199.00, 23, 550, 0),
('Wireless Earbuds', 'CEL-SON-WF1000XM5-SL', 'Consumer Electronics', 'RACK 1C', 99.00, 24, 10, 0),
('Gaming Keyboard', 'COM-LOG-GPROX-W-BK', 'Computer Hardware & Peripherals', 'RACK 5A', 129.99, 27, 300, 0),
('Smart Refrigerator', 'HOM-LG-LMXS28596S-28-SS', 'Home Appliances', 'RACK 1B', 2499.99, 28, 550, 0),
('Wireless Earbuds', 'CEL-SON-WF1000XM5-SL', 'Consumer Electronics', 'RACK 1C', 279.99, 29, 10, 0),
('Industrial Air Compressor', 'IND-ING-AC75V2-7.5KW', 'Industrial & Power Electronics', 'RACK 3B', 1250.50, 30, 25, 0),
('Mechanical Gaming Mouse', 'COM-RAZ-BASILV3-BK', 'Computer Hardware & Peripherals', 'RACK 5B', 69.99, 31, 150, 0),
('Smart Washing Machine', 'HOM-SAM-WW10T654DAH-XL', 'Home Appliances', 'RACK 1D', 799.99, 32, 75, 0),
('Bluetooth Speaker', 'CEL-JBL-FLIP6-BLUE', 'Consumer Electronics', 'RACK 2A', 119.99, 33, 200, 0),
('CNC Machine Controller', 'IND-FAN-0iMF-TOUCH', 'Industrial & Power Electronics', 'RACK 4A', 3200.00, 34, 15, 0),
('Ultra HD Monitor', 'COM-DEL-S3222DGM-32', 'Computer Hardware & Peripherals', 'RACK 6C', 449.99, 35, 80, 0);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
