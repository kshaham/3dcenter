-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 16, 2017 at 03:14 AM
-- Server version: 5.6.38-83.0
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--
CREATE DATABASE IF NOT EXISTS `demo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `demo`;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `trn_date` datetime NOT NULL,
  `name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` varchar(50) NOT NULL,
  `notes` varchar(50) NOT NULL,
  `username` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `trn_date` datetime NOT NULL,
  `name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(50) NOT NULL,
  `notes` varchar(50) NOT NULL,
  `username` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `partcalendar`
--

CREATE TABLE `partcalendar` (
  `id` int(11) NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `title` text,
  `id2` varchar(100) DEFAULT NULL,
  `printer` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partcalendar`
--

INSERT INTO `partcalendar` (`id`, `start`, `end`, `title`, `id2`, `printer`, `type`) VALUES
(131, '2017-12-13 01:30:00', '2017-12-13 03:30:00', 'Engine Block', 'bob1', '1', NULL),
(132, '2017-12-13 04:00:00', '2017-12-13 09:00:00', 'Engine Mount', 'bob1', '1', NULL),
(133, '2017-12-12 07:30:00', '2017-12-12 13:30:00', 'Phone Stand', 'bob1', '0', NULL),
(134, '2017-12-13 19:00:00', '2017-12-13 23:00:00', 'Fan Holder', 'bob1', '1', NULL),
(135, '2017-12-14 01:30:00', '2017-12-14 04:30:00', 'Test Print', 'bob1', '0', NULL),
(136, '2017-12-12 01:30:00', '2017-12-12 07:30:00', 'Engine Block', 'kam', '0', NULL),
(137, '2017-12-15 03:30:00', '2017-12-15 08:30:00', 'Engine Stand', 'kam', '1', NULL),
(138, '2017-12-15 14:00:00', '2017-12-15 17:00:00', 'Phone Holder', 'kam', '0', NULL),
(139, '2017-12-15 17:00:00', '2017-12-15 19:00:00', 'Phone Stand', 'kam', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` int(11) NOT NULL,
  `trn_date` datetime NOT NULL,
  `name` varchar(50) NOT NULL,
  `printtime` varchar(50) NOT NULL,
  `printcost` varchar(50) NOT NULL,
  `retailcost` varchar(50) NOT NULL,
  `notes` varchar(50) NOT NULL,
  `username` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `printers`
--

CREATE TABLE `printers` (
  `id` int(11) NOT NULL,
  `trn_date` datetime NOT NULL,
  `name` varchar(50) NOT NULL,
  `xlength` varchar(50) NOT NULL,
  `ylength` varchar(50) NOT NULL,
  `zheight` varchar(50) NOT NULL,
  `cost` varchar(50) NOT NULL,
  `notes` varchar(50) NOT NULL,
  `username` varchar(45) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `printers`
--

INSERT INTO `printers` (`id`, `trn_date`, `name`, `xlength`, `ylength`, `zheight`, `cost`, `notes`, `username`, `count`) VALUES
(14, '2017-12-10 18:02:20', 'MakerGear M2', '8', '8', '10', '1500', 'test', 'bob1', 0),
(15, '2017-12-10 18:02:28', 'Raise3D', '8', '8', '10', '1500', 'test', 'bob1', 1),
(16, '2017-12-11 23:53:19', 'Makergear M2', '8', '8', '8', '1500', '3 months old', 'kam', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id2` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id2`, `username`, `password`, `created_at`) VALUES
(1, 'bob1', '$2y$10$vW3MN6f5cblmzwY8SSJ4k.xbXI074qsb7CFdyZA57bTtEhv7U.TB.', '2017-12-10 18:01:44'),
(2, 'kam', '$2y$10$N8CN1QDl8.CZl/mIP5IKdeWm.iFj/oOLiWhRDoLIAq46TaHe1O9k.', '2017-12-11 23:11:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partcalendar`
--
ALTER TABLE `partcalendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `printers`
--
ALTER TABLE `printers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id2`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `partcalendar`
--
ALTER TABLE `partcalendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `printers`
--
ALTER TABLE `printers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
