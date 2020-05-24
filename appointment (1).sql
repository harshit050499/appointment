-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2020 at 10:52 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointment`
--

-- --------------------------------------------------------

--
-- Table structure for table `available`
--

CREATE TABLE `available` (
  `id` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `slot` varchar(50) COLLATE utf8_bin NOT NULL,
  `date` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `available`
--

INSERT INTO `available` (`id`, `user_id`, `slot`, `date`) VALUES
(1, 1, '2,3,4,8,', '2020-05-23'),
(2, 4, '9,10,11,12,', '2020-05-26');

-- --------------------------------------------------------

--
-- Table structure for table `bookinglog`
--

CREATE TABLE `bookinglog` (
  `tid` int(11) NOT NULL,
  `iname` varchar(200) COLLATE utf8_bin NOT NULL,
  `iemail` varchar(100) COLLATE utf8_bin NOT NULL,
  `spec` varchar(100) COLLATE utf8_bin NOT NULL,
  `username` varchar(200) COLLATE utf8_bin NOT NULL,
  `sid` varchar(100) COLLATE utf8_bin NOT NULL,
  `eid` varchar(100) COLLATE utf8_bin NOT NULL,
  `date` varchar(25) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `bookinglog`
--

INSERT INTO `bookinglog` (`tid`, `iname`, `iemail`, `spec`, `username`, `sid`, `eid`, `date`) VALUES
(16, 'jash', 'harshitmandhyani47@gmail.com', 'meet', 'harshit', '9', '6', '2020-05-26'),
(17, 'harshitmandhyani', 'harshitmandhyani47@gmail.com', 'meet', 'harshit', '11', '5', '2020-05-26'),
(18, 'VIkram', 'vkrmmandhyani@gmail.com', 'okay', 'harshit', '10', '6', '2020-05-26'),
(19, 'harshitmandhyani', 'harshitmandhyani47@gmail.com', 'cafe', 'harshit', '12', '6', '2020-05-26');

-- --------------------------------------------------------

--
-- Table structure for table `event_details`
--

CREATE TABLE `event_details` (
  `id` int(100) NOT NULL,
  `ename` varchar(200) COLLATE utf8_bin NOT NULL,
  `etype` varchar(200) COLLATE utf8_bin NOT NULL,
  `description` varchar(550) COLLATE utf8_bin NOT NULL,
  `user_id` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `event_details`
--

INSERT INTO `event_details` (`id`, `ename`, `etype`, `description`, `user_id`) VALUES
(3, 'meeting', 'phone', 'will be there on time', '2'),
(5, 'final', 'location', 'will meet soon', '4'),
(6, 'playing', 'location', 'at the ground', '4');

-- --------------------------------------------------------

--
-- Table structure for table `slotlist`
--

CREATE TABLE `slotlist` (
  `id` int(100) NOT NULL,
  `start` varchar(20) COLLATE utf8_bin NOT NULL,
  `end` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `slotlist`
--

INSERT INTO `slotlist` (`id`, `start`, `end`) VALUES
(1, '0:00', '1:00'),
(2, '1:00', '2:00'),
(3, '2:00', '3:00'),
(4, '3:00', '4:00'),
(5, '4:00', '5:00'),
(6, '5:00', '6:00'),
(7, '6:00', '7:00'),
(8, '7:00', '8:00'),
(9, '8:00', '9:00'),
(10, '9:00', '10:00'),
(11, '10:00', '11:00'),
(12, '11:00', '12:00'),
(13, '12:00', '13:00'),
(14, '13:00', '14:00'),
(15, '14:00', '15:00'),
(16, '15:00', '16:00'),
(17, '16:00', '17:00'),
(18, '17:00', '18:00'),
(19, '18:00', '19:00'),
(20, '19:00', '20:00'),
(21, '20:00', '21:00'),
(22, '21:00', '22:00'),
(23, '22:00', '23:00'),
(24, '23:00', '24:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(100) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(256) COLLATE utf8_bin NOT NULL,
  `email` varchar(150) COLLATE utf8_bin NOT NULL,
  `apikey` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `name`, `password`, `email`, `apikey`) VALUES
(4, 'harshit', '$2y$10$BQ562QfNuiFuAPdd/25ZxOyk9Ncxl1HzdrFoPBY0ebxpGl1YWN1ai', 'harshitmandhyani47@gmail.com', '$2y$10$LkiVkIKFpKVAwUT4/AQCs.4Zrj6IipfEyUr/Jjc0KRaMxvCcEfhaO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `available`
--
ALTER TABLE `available`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookinglog`
--
ALTER TABLE `bookinglog`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `event_details`
--
ALTER TABLE `event_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slotlist`
--
ALTER TABLE `slotlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `available`
--
ALTER TABLE `available`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookinglog`
--
ALTER TABLE `bookinglog`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `event_details`
--
ALTER TABLE `event_details`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `slotlist`
--
ALTER TABLE `slotlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
