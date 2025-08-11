-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2025 at 04:33 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `order_reviews`
--

CREATE TABLE `order_reviews` (
  `id` int(11) NOT NULL,
  `order_number` varchar(100) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_reviews`
--

INSERT INTO `order_reviews` (`id`, `order_number`, `rating`, `comment`, `review_date`) VALUES
(1, '#1002', 5, 'awaw', '2025-08-11 02:31:11'),
(2, '#1002', 3, 'awaw', '2025-08-11 02:31:17');

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
('Gaming Keyboard', 'COM-LOG-GPROX-W-BK', 'Computer Hardware & Peripherals', 'RACK 5A', 129.99, 27, 300, 0),
('Smart Refrigerator', 'HOM-LG-LMXS28596S-28-SS', 'Home Appliances', 'RACK 1B', 2499.99, 28, 550, 0),
('Wireless Earbuds', 'CEL-SON-WF1000XM5-SL', 'Consumer Electronics', 'RACK 1C', 99.00, 29, 0, 1),
('Industrial Air Compressor', 'IND-ING-AC75V2-7.5KW', 'Industrial & Power Electronics', 'RACK 3B', 1250.50, 30, 25, 1),
('Mechanical Gaming Mouse', 'COM-RAZ-BASILV3-BK', 'Computer Hardware & Peripherals', 'RACK 5B', 69.99, 31, 150, 0),
('Smart Washing Machine', 'HOM-SAM-WW10T654DAH-XL', 'Home Appliances', 'RACK 1D', 799.99, 32, 75, 0),
('Bluetooth Speaker', 'CEL-JBL-FLIP6-BLUE', 'Consumer Electronics', 'RACK 2A', 119.99, 33, 200, 0),
('CNC Machine Controller', 'IND-FAN-0iMF-TOUCH', 'Industrial & Power Electronics', 'RACK 4A', 3200.00, 34, 15, 1),
('Ultra HD Monitor', 'COM-DEL-S3222DGM-32', 'Computer Hardware & Peripherals', 'RACK 6C', 449.99, 35, 80, 0),
('Smartphone Model A', 'IND-CE-AC75V2-7.5KW', 'Consumer Electronics', 'RACK 1A', 299.99, 36, 50, 0),
('Laptop Model B', 'IND-CH-AC85V3-10KW', 'Computer Hardware & Peripherals', 'RACK 1B', 799.99, 37, 20, 1),
('Microwave Oven', 'IND-HA-AC95V4-12KW', 'Home Appliances', 'RACK 1C', 150.00, 38, 30, 1),
('Industrial Motor', 'IND-IE-AC105V5-15KW', 'Industrial & Power Electronics', 'RACK 1D', 450.00, 39, 15, 1),
('Tablet Model X', 'IND-CE-BG75V2-8KW', 'Consumer Electronics', 'RACK 1E', 199.99, 40, 40, 1),
('Mechanical Keyboard', 'IND-CH-BH85V3-9KW', 'Computer Hardware & Peripherals', 'RACK 1F', 89.99, 41, 60, 0),
('Air Conditioner', 'IND-HA-BI95V4-13KW', 'Home Appliances', 'RACK 1G', 350.00, 42, 10, 1),
('Power Supply Unit', 'IND-IE-BJ105V5-16KW', 'Industrial & Power Electronics', 'RACK 2A', 120.00, 43, 25, 1),
('Bluetooth Speaker', 'IND-CE-CK75V2-7KW', 'Consumer Electronics', 'RACK 2B', 45.00, 44, 80, 0),
('Graphics Card', 'IND-CH-CL85V3-10KW', 'Computer Hardware & Peripherals', 'RACK 2C', 400.00, 45, 5, 1),
('Refrigerator', 'IND-HA-CM95V4-11KW', 'Home Appliances', 'RACK 2D', 600.00, 46, 8, 1),
('Voltage Regulator', 'IND-IE-CN105V5-14KW', 'Industrial & Power Electronics', 'RACK 2E', 75.00, 47, 35, 1),
('Wireless Earbuds', 'IND-CE-DO75V2-8.5KW', 'Consumer Electronics', 'RACK 2F', 99.99, 48, 55, 0),
('External Hard Drive', 'IND-CH-DP85V3-9.5KW', 'Computer Hardware & Peripherals', 'RACK 2G', 120.00, 49, 45, 1),
('Washing Machine', 'IND-HA-DQ95V4-12.5KW', 'Home Appliances', 'RACK 3A', 400.00, 50, 12, 1),
('Monitor 24\"', 'IND-CE-DR105V5-13.5KW', 'Consumer Electronics', 'RACK 3B', 150.00, 51, 38, 1),
('RAM 16GB', 'IND-CH-ES75V2-7.8KW', 'Computer Hardware & Peripherals', 'RACK 3C', 75.00, 52, 70, 0),
('Dishwasher', 'IND-HA-ET85V3-10.8KW', 'Home Appliances', 'RACK 3D', 550.00, 53, 7, 1),
('Transformer', 'IND-IE-EU95V4-14.2KW', 'Industrial & Power Electronics', 'RACK 3E', 200.00, 54, 22, 1),
('Smartwatch Series 5', 'IND-CE-EV105V5-15.5KW', 'Consumer Electronics', 'RACK 3F', 199.00, 55, 65, 0),
('Wireless Mouse', 'IND-CH-EW75V2-8.1KW', 'Computer Hardware & Peripherals', 'RACK 3G', 25.00, 56, 100, 0),
('Vacuum Cleaner', 'IND-HA-EX85V3-9.3KW', 'Home Appliances', 'RACK 4A', 180.00, 57, 14, 1),
('Circuit Breaker', 'IND-IE-EY95V4-12.7KW', 'Industrial & Power Electronics', 'RACK 4B', 90.00, 58, 40, 1),
('Digital Camera', 'IND-CE-EZ105V5-16.2KW', 'Consumer Electronics', 'RACK 4C', 350.00, 59, 27, 1),
('SSD 1TB', 'IND-CH-FA75V2-7.9KW', 'Computer Hardware & Peripherals', 'RACK 4D', 130.00, 60, 33, 1),
('Electric Kettle', 'IND-HA-FB85V3-11.5KW', 'Home Appliances', 'RACK 4E', 45.00, 61, 50, 0),
('Inverter', 'IND-IE-FC95V4-13.8KW', 'Industrial & Power Electronics', 'RACK 4F', 250.00, 62, 18, 1),
('Gaming Console', 'IND-CE-FD105V5-14.9KW', 'Consumer Electronics', 'RACK 4G', 399.00, 63, 29, 1),
('Motherboard', 'IND-CH-FE75V2-8.3KW', 'Computer Hardware & Peripherals', 'RACK 5A', 220.00, 64, 24, 1),
('Toaster Oven', 'IND-HA-FF85V3-10.2KW', 'Home Appliances', 'RACK 5B', 60.00, 65, 16, 1);

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
-- Indexes for table `order_reviews`
--
ALTER TABLE `order_reviews`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `order_reviews`
--
ALTER TABLE `order_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
