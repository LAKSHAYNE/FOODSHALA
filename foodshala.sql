-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2023 at 07:33 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodshala`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `sno` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `dish` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `price` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`sno`, `rest_id`, `dish`, `type`, `price`, `timestamp`) VALUES
(12, 6, 'Chilli Potato', 'Veg', 55, '2023-03-16 20:22:02'),
(13, 6, 'chaap', 'veg', 220, '2023-03-16 20:22:15'),
(14, 8, 'chole bhature', 'veg', 220, '2023-03-16 20:22:41'),
(15, 8, 'Pav Bhaji', 'veg', 120, '2023-03-16 20:23:20'),
(16, 9, 'Dal Makhini', 'veg', 320, '2023-03-16 20:23:46'),
(19, 6, 'Butter Chicken', 'non veg', 900, '2023-03-16 20:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL,
  `price` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `item`, `type`, `price`, `timestamp`) VALUES
(11, 11, 'Chilli', 'Veg', 55, '2023-03-16 20:25:13'),
(12, 11, 'Chicken', 'non', 950, '2023-03-16 20:25:25'),
(13, 11, 'Butter', 'non', 900, '2023-03-16 20:40:51'),
(14, 11, 'chaap', 'veg', 220, '2023-03-16 20:40:53');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `rest_id` int(11) NOT NULL,
  `rest_name` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`rest_id`, `rest_name`, `address`, `timestamp`) VALUES
(6, 'Bikaner', 'Noida', '2023-03-16 20:16:28'),
(8, 'Haldiram', 'Gurugram', '2023-03-16 20:20:16'),
(9, 'Pind Ballucci', 'Faridabad', '2023-03-16 20:20:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Sno` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(15) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Sno`, `email`, `password`, `user_type`, `timestamp`) VALUES
(10, 'admin@admin.com', '$2y$10$x3QnRIx.aRX7XXJ09/buzOC1N5KJeV2A57ldV14CoGOIj/39BGTGC', 'Admin', '2023-03-16 20:16:05'),
(11, 'cust@cust.com', '$2y$10$jBgjuSgTibf1rJEMxCupB.u5L3R4BFQr5k/GTmpgnjOQxayOTjfjK', 'Customer', '2023-03-16 20:25:01'),
(12, 'rest@rest.com', '$2y$10$LywXYroHk7pteNqakDof9eIiJzmcA5wyxMFjAcnla4vs.NQKYQvi.', 'Restaurant', '2023-03-16 20:25:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`rest_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `rest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
