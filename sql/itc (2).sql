-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2025 at 05:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `date_ordered` date NOT NULL,
  `items` text NOT NULL,
  `order_status` enum('Confirmed','Cancelled','Pending') DEFAULT 'Pending',
  `shipping_status` enum('Delivered','Packed','Pending','N/A') DEFAULT 'Pending',
  `date_received` date DEFAULT NULL,
  `rating` tinyint(3) UNSIGNED DEFAULT NULL,
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_number`, `date_ordered`, `items`, `order_status`, `shipping_status`, `date_received`, `rating`, `review`, `created_at`) VALUES
(1, '#1001', '2025-03-08', 'Widget A x2, Box B x1', 'Confirmed', 'Delivered', '2025-04-01', 5, 'Fast delivery and great quality.', '2025-08-06 03:21:29'),
(2, '#1002', '2025-04-02', 'Mouse C x3', 'Confirmed', 'Packed', NULL, NULL, NULL, '2025-08-06 03:21:29'),
(3, '#1003', '2025-04-03', 'Keyboard B x10', 'Cancelled', 'N/A', NULL, NULL, NULL, '2025-08-06 03:21:29'),
(4, '#1004', '2025-04-05', 'Monitor X x1, Cable Y x2', 'Confirmed', 'Delivered', '2025-04-10', 4, 'Monitor works well but cable was a bit short.', '2025-08-06 03:21:29'),
(5, '#1005', '2025-04-06', 'Laptop Z x1', 'Pending', 'Pending', NULL, NULL, NULL, '2025-08-06 03:21:29');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`item`, `bar`, `category`, `location`, `price`, `id`, `stock`, `notified`) VALUES
('3-Phase Industrial Motor', 'IND-SIE-1LA7163-5KW', 'Industrial & Power Electronics', 'RACK 3A', 499.00, 21, 100, 0),
('Gaming Keyboard', 'COM-LOG-GPROX-W-BK', 'Computer Hardware & Peripherals', 'RACK 5A', 299.00, 22, 300, 0),
('Smart Refrigerator', 'HOM-LG-LMXS28596S-28-SS', 'Home Appliances', 'RACK 1B', 199.00, 23, 550, 0),
('Wireless Earbuds', 'CEL-SON-WF1000XM5-SL', 'Consumer Electronics', 'RACK 1C', 99.00, 24, 10, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_number` (`order_number`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
