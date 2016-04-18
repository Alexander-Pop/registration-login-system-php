-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2016 at 06:28 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miniprojectreg`
--

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `personal_phone` int(11) DEFAULT NULL,
  `home_phone` int(11) DEFAULT NULL,
  `office_phone` int(11) DEFAULT NULL,
  `current_address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `profile_pic`, `personal_phone`, `home_phone`, `office_phone`, `current_address`, `permanent_address`, `created_at`, `modified_at`, `deleted_at`, `modified_by`) VALUES
(18, 95, 'Awolad', 'Hossain', '1460868920441f1c74-544b-4f6f-b43a-504e034025b7.jpg', 1723874408, 1751478692, 1855138020, '6/11 Tajmahal road, Mohammadpur, Dhaka - 1207', 'Sudin, Adamdighi, Bogra - 5890', NULL, NULL, NULL, NULL),
(19, 96, 'Salman', 'Farshy', '146095352811891247_489667941214219_5927991688162963508_n.jpg', 1786340078, 1751478692, 1855138020, 'Sudin, Adamdighi, Bogra - 5890', 'Bogra - 5800', NULL, NULL, NULL, NULL),
(20, 97, 'Jakir', 'Hossain', '146095347911873540_488564924657854_6551118090008483318_n.jpg', 178634008, 1751478692, 1855138020, 'Sudin, Adamdighi, Bogra', 'Sudin, Adamdighi, Bogra - 5800', NULL, NULL, NULL, NULL),
(21, 98, 'Afroza', 'Begum', '146095350811880441_488249381356075_7185910218538058363_n.png', 1751478692, 1786340078, 1855138020, 'Sudin, Adamdighi - 5890, Bogra', 'Sudin, Adamdighi - 5890, Bogra', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_group_id`, `unique_id`, `username`, `password`, `email`, `modified_at`, `created_at`, `deleted_at`, `is_active`) VALUES
(95, 0, '5712fa1abed85', 'awolad', '11', 'awolad@gmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1),
(96, 0, '5712fab5afe83', 'salman', '11', 'salman@gmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(97, 0, '5712fffb8371a', 'jakir', '11', 'jakir@gmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL),
(98, 0, '571301fc42d24', 'afroza', '11', 'afroza@gmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
