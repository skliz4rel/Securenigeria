-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2018 at 04:57 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `middleware`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `bankid` int(11) NOT NULL,
  `name` char(30) DEFAULT NULL,
  `slug` char(20) DEFAULT NULL,
  `longcode` int(11) DEFAULT NULL,
  `gateway` char(15) DEFAULT NULL,
  `pay_with_bank` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `country` char(20) DEFAULT NULL,
  `type` char(10) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `usertext` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `usertext`) VALUES
(89, '1*2*jide*akindejoye'),
(88, '1*2*jide'),
(87, '1*2'),
(86, '1'),
(85, '1*2'),
(84, '1*2'),
(83, '1*2'),
(82, '1'),
(81, ''),
(80, '1*2*jide'),
(78, '1'),
(79, '1*2'),
(77, ''),
(76, '1*2*jide'),
(75, '1*2'),
(73, ''),
(74, '1'),
(72, ''),
(71, '1*2*jide'),
(70, '1*2'),
(69, '2'),
(68, '1');

-- --------------------------------------------------------

--
-- Table structure for table `session_levels`
--

CREATE TABLE `session_levels` (
  `session_id` varchar(50) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `level` text,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session_levels`
--

INSERT INTO `session_levels` (`session_id`, `phone`, `level`, `id`) VALUES
('111111111', '08131528807', 'done', 20),
('111111111', '08131528807', 'lastname', 19),
('111111111', '08131528807', 'preregister', 18);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `phone` text,
  `bankacct` char(30) DEFAULT NULL,
  `bvn` char(20) DEFAULT NULL,
  `cardnum` char(20) DEFAULT NULL,
  `firstname` char(30) DEFAULT NULL,
  `lastname` char(30) DEFAULT NULL,
  `ismale` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `phone`, `bankacct`, `bvn`, `cardnum`, `firstname`, `lastname`, `ismale`) VALUES
(9, '08131528807', NULL, NULL, '', 'jide', 'akindejoye', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`bankid`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session_levels`
--
ALTER TABLE `session_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `bankid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `session_levels`
--
ALTER TABLE `session_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
