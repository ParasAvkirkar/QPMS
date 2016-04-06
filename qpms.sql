-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2016 at 03:21 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qpms`
--

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE IF NOT EXISTS `papers` (
  `paper_id` int(10) NOT NULL,
  `college_name` varchar(50) CHARACTER SET ascii NOT NULL,
  `branch` varchar(50) CHARACTER SET ascii NOT NULL,
  `subject` varchar(50) CHARACTER SET ascii NOT NULL,
  `image_name` varchar(50) CHARACTER SET ascii NOT NULL,
  `user_id` int(10) NOT NULL,
  `year` int(10) NOT NULL,
  `exam_type` varchar(50) CHARACTER SET ascii NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `papers`
--

INSERT INTO `papers` (`paper_id`, `college_name`, `branch`, `subject`, `image_name`, `user_id`, `year`, `exam_type`) VALUES
(53, 'Veermata Jijabai Technological Institute', 'Computer Engineering', 'TCP/IP', '53.jpg', 1, 2016, 'In Semester'),
(54, 'Veermata Jijabai Technological Institute', 'Computer Engineering', 'TCP/IP', '54.jpg', 1, 2016, 'In Semester'),
(55, 'Veermata Jijabai Technological Institute', 'Computer Engineering', 'TCP/IP', '55.jpg', 1, 2016, 'In Semester'),
(56, 'Veermata Jijabai Technological Institute', 'Computer Engineering', 'TCP/IP', '56.jpg', 1, 2016, 'In Semester'),
(57, 'Veermata Jijabai Technological Institute', 'Computer Engineering', 'TCP/IP', '57.jpg', 1, 2016, 'In Semester'),
(58, 'Veermata Jijabai Technological Institute', 'Computer Engineering', 'TCP/IP', '58.jpg', 1, 2016, 'In Semester'),
(59, 'Veermata Jijabai Technological Institute', 'Computer Engineering', 'TCP/IP', '59.jpg', 1, 2016, 'In Semester');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL,
  `name` varchar(50) CHARACTER SET ascii NOT NULL,
  `college_name` varchar(50) CHARACTER SET ascii NOT NULL,
  `current_sem` int(1) NOT NULL,
  `password` varchar(50) CHARACTER SET ascii NOT NULL,
  `email_id` varchar(50) CHARACTER SET ascii NOT NULL,
  `branch` varchar(50) CHARACTER SET ascii NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `college_name`, `current_sem`, `password`, `email_id`, `branch`) VALUES
(1, 'Paras Avkirkar', 'Veermata Jijabai Technological Institute', 6, 'pass', 'dhavalavkirkar6699@gmail.com', 'Computer Engineering'),
(2, 'Test', 'Veermata Jijabai Technological Institute', 5, 'pass', 'test@gmail.com', 'Computer Engineering'),
(3, 'Dhaval Avkirkar', 'Veermata Jijabai Technological Institute', 1, 'dhaval', 'dhaval@gmail.com', 'Computer Engineering'),
(4, 'New', 'Veermata Jijabai Technological Institute', 1, 'new', 'new@gmail.com', 'Computer Engineering'),
(27, 'Hello Hayes', 'Veermata Jijabai Technological Institute', 1, 'hello', 'hello@gmail.com', 'Computer Engineering'),
(28, 'Tester', 'Sardar Vallabhai Patel Institute', 2, 'test', 'tester@yahoo.com', 'Electrical Engineering'),
(29, 'Pranay Patil', 'Veermata Jijabai Technological Institute', 1, 'patil', 'patil@gmail.com', 'Computer Engineering');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
  ADD PRIMARY KEY (`paper_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email_id_2` (`email_id`),
  ADD KEY `email_id` (`email_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `papers`
--
ALTER TABLE `papers`
  MODIFY `paper_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
