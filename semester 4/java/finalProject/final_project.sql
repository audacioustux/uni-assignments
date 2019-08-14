-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Aug 14, 2019 at 03:41 PM
-- Server version: 8.0.17
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(48) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'drink', 'watery liquid that can flow and escape'),
(2, 'fast food', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `CategoryItem`
--

CREATE TABLE `CategoryItem` (
  `category` int(11) NOT NULL,
  `item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `CategoryItem`
--

INSERT INTO `CategoryItem` (`category`, `item`) VALUES
(1, 3),
(1, 4),
(1, 5),
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Items`
--

CREATE TABLE `Items` (
  `id` int(11) NOT NULL,
  `price` double NOT NULL,
  `detail` text,
  `processing_time` time DEFAULT NULL,
  `name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Items`
--

INSERT INTO `Items` (`id`, `price`, `detail`, `processing_time`, `name`) VALUES
(1, 500, 'a hotdog is not a dog but hot', '01:02:03', 'hotdog'),
(2, 500, NULL, NULL, 'pizza'),
(3, 20, NULL, NULL, 'mount & dew - 250 mL'),
(4, 50, NULL, NULL, 'mount & dew - 500 mL'),
(5, 20, NULL, NULL, 'CocaCola - 250 mL');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ordered_by` int(11) NOT NULL,
  `ordered_at` datetime NOT NULL,
  `id` int(11) NOT NULL,
  `comment` varchar(280) DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT '1',
  `item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ordered_by`, `ordered_at`, `id`, `comment`, `amount`, `item`) VALUES
(1, '2018-12-25 12:50:26', 2, 'moxarella beshi daben :)', 2, 2),
(2, '2018-12-25 12:50:26', 3, NULL, 1, 3),
(1, '2019-05-25 12:50:26', 4, NULL, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `ph_number` varchar(15) NOT NULL,
  `password` tinytext NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `ph_number`, `password`, `last_login`) VALUES
(1, '+8801823170374', 'password', '2007-12-15 23:50:26'),
(2, '+8801915024940', 'password', '2018-12-15 12:50:26'),
(3, '+8801823170373', 'M6AwQP', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CategoryItem`
--
ALTER TABLE `CategoryItem`
  ADD KEY `cat_item` (`category`,`item`),
  ADD KEY `item` (`item`);

--
-- Indexes for table `Items`
--
ALTER TABLE `Items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordered_by` (`ordered_by`),
  ADD KEY `item` (`item`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniquePhNo` (`ph_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Items`
--
ALTER TABLE `Items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CategoryItem`
--
ALTER TABLE `CategoryItem`
  ADD CONSTRAINT `CategoryItem_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CategoryItem_ibfk_2` FOREIGN KEY (`item`) REFERENCES `Items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ordered_by`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`item`) REFERENCES `Items` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
