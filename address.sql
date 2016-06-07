-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2016 at 01:37 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phonebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_categories`
--

CREATE TABLE IF NOT EXISTS `t_categories` (
  `c_id` int(11) NOT NULL,
  `category` varchar(40) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_categories`
--

INSERT INTO `t_categories` (`c_id`, `category`) VALUES
(1, 'Personal'),
(2, 'Public');

-- --------------------------------------------------------

--
-- Table structure for table `t_description`
--

CREATE TABLE IF NOT EXISTS `t_description` (
  `id` int(11) NOT NULL,
  `description` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_description`
--

INSERT INTO `t_description` (`id`, `description`) VALUES
(1, 'Home'),
(2, 'Office'),
(3, 'Mobile'),
(4, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `t_email`
--

CREATE TABLE IF NOT EXISTS `t_email` (
  `id` int(11) NOT NULL,
  `phonebook_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_email`
--

INSERT INTO `t_email` (`id`, `phonebook_id`, `email`) VALUES
(119, 146, 'xs@mimi.com'),
(124, 151, 'wsss@mim.mi'),
(127, 154, 'marija.golubovic@gmail.com'),
(128, 155, 'xs@mimi.com'),
(129, 156, 'dededede@gmail.com'),
(130, 157, 'xs@mimi.com'),
(132, 159, 'wsss@mim.mi'),
(133, 160, 'dededede@gmail.com'),
(134, 161, 'zdravo@gmail.com'),
(135, 162, 'jujuki.juj@gmo.com');

-- --------------------------------------------------------

--
-- Table structure for table `t_gender`
--

CREATE TABLE IF NOT EXISTS `t_gender` (
  `gender_id` int(11) NOT NULL,
  `gender_description` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_gender`
--

INSERT INTO `t_gender` (`gender_id`, `gender_description`) VALUES
(1, 'Female'),
(2, 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `t_images`
--

CREATE TABLE IF NOT EXISTS `t_images` (
  `id` int(11) NOT NULL,
  `phonebook_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL,
  `size` int(11) NOT NULL,
  `image` blob NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_images`
--

INSERT INTO `t_images` (`id`, `phonebook_id`, `name`, `type`, `size`, `image`) VALUES
(78, 146, '123.jpg', 'image/jpeg', 69096, 0x433a5c78616d70705c746d705c706870413730422e746d70),
(83, 151, '', '', 0, ''),
(86, 154, '', '', 0, ''),
(87, 155, 'IMG_20141115_194402.jpg', 'image/jpeg', 523939, 0x433a78616d7070096d70706870364442362e746d70),
(88, 156, '', '', 0, ''),
(89, 157, '', '', 0, ''),
(91, 159, '', '', 0, ''),
(92, 160, '', '', 0, ''),
(93, 161, 'DSC07267.jpg', 'image/jpeg', 773698, 0x433a78616d7070096d70706870443534442e746d70),
(94, 162, '', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `t_login_attempts`
--

CREATE TABLE IF NOT EXISTS `t_login_attempts` (
  `userId` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_login_attempts`
--

INSERT INTO `t_login_attempts` (`userId`, `time`) VALUES
(1, '1449255762'),
(1, '1449255772'),
(1, '1449256117'),
(3, '1449260325'),
(3, '1449260331'),
(3, '1449268315'),
(3, '1449268367'),
(3, '1449268409');

-- --------------------------------------------------------

--
-- Table structure for table `t_phonebook_det`
--

CREATE TABLE IF NOT EXISTS `t_phonebook_det` (
  `id` int(11) NOT NULL,
  `name` text,
  `surname` text,
  `gender` varchar(10) NOT NULL,
  `address` text,
  `title` text,
  `photo` blob NOT NULL,
  `useradded` text,
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_phonebook_det`
--

INSERT INTO `t_phonebook_det` (`id`, `name`, `surname`, `gender`, `address`, `title`, `photo`, `useradded`, `dateadded`) VALUES
(146, 'we', 'we', 'Male', 'we', 'Mr.', '', '3', '2015-11-13 09:58:55'),
(151, 'erwt', 'wtewtr', 'Male', 'wertewrt', 'Mr.', '', '18', '2015-11-13 13:29:28'),
(154, 'marija', 'golubovic', 'Female', 'zajcar', 'Ms.', '', '18', '2015-11-18 17:32:25'),
(155, 'tet', 'tet', 'Male', 'lol', 'Mrs.', '', '18', '2015-11-19 08:14:33'),
(156, 'mini', 'nimi', 'Male', 'loko', 'Mr.', '', '3', '2015-11-19 08:31:24'),
(157, 'milo', 'moj', 'Male', 'kjh', 'Mr.', '', '3', '2015-11-19 08:50:55'),
(159, 'mojertz', 'dfghj', 'Female', 'sdfghj', 'Mrs.', '', '3', '2015-11-19 09:25:00'),
(160, 'test', 'testw', 'Female', 'lololoidsjfoadvibaf afadsfadsf 36', 'Mrs.', '', '3', '2015-11-24 11:23:39'),
(161, 'zdravo', 'koko', 'Male', '123', 'Mrs.', '', '3', '2016-01-26 11:13:46'),
(162, 'juju', 'oijh', 'Female', 'asdfghjklč', 'Mrs.', '', '18', '2016-03-10 13:30:40');

-- --------------------------------------------------------

--
-- Table structure for table `t_phonebook_more_numbers`
--

CREATE TABLE IF NOT EXISTS `t_phonebook_more_numbers` (
  `id` int(11) NOT NULL,
  `phonebook_id` int(11) NOT NULL,
  `description` text,
  `phone_number` varchar(15) DEFAULT NULL,
  `useradded` text,
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_phonebook_more_numbers`
--

INSERT INTO `t_phonebook_more_numbers` (`id`, `phonebook_id`, `description`, `phone_number`, `useradded`, `dateadded`) VALUES
(172, 146, 'Home', '2', NULL, '2015-11-13 09:58:55'),
(177, 151, 'Home', '44445', NULL, '2015-11-13 13:29:29'),
(180, 154, 'Mobile', '99999', NULL, '2015-11-18 17:32:25'),
(181, 155, 'Home', '3535', NULL, '2015-11-19 08:14:33'),
(182, 156, 'Home', '111111', NULL, '2015-11-19 08:31:24'),
(183, 157, 'Home', '258963', NULL, '2015-11-19 08:50:56'),
(185, 159, 'Home', '33', NULL, '2015-11-19 09:25:01'),
(186, 160, 'Home', '123445', NULL, '2015-11-24 11:23:39'),
(187, 160, 'Home', '121445', NULL, '2015-11-24 11:23:39'),
(188, 161, 'Home', '223344544', NULL, '2016-01-26 11:13:46'),
(189, 161, 'Mobile', '4443333', NULL, '2016-01-26 11:13:46'),
(190, 162, 'Mobile', '987654', NULL, '2016-03-10 13:30:40'),
(191, 162, 'Home', '14785236', NULL, '2016-03-10 13:30:40'),
(192, 163, NULL, NULL, NULL, '2016-03-11 11:37:30'),
(193, 164, NULL, NULL, NULL, '2016-03-11 11:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `t_title`
--

CREATE TABLE IF NOT EXISTS `t_title` (
  `id` int(11) NOT NULL,
  `title` varchar(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_title`
--

INSERT INTO `t_title` (`id`, `title`) VALUES
(1, 'Ms.'),
(2, 'Mrs.'),
(3, 'Mr.');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(128) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rol` enum('Administrator','User','','') NOT NULL,
  `active` varchar(255) NOT NULL DEFAULT 'No',
  `salt` char(128) NOT NULL,
  `resetComplete` varchar(3) NOT NULL DEFAULT 'No',
  `resetToken` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `rol`, `active`, `salt`, `resetComplete`, `resetToken`) VALUES
(1, 'Mickey', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'Miroslav', 'Djordjevic', 'miroslav@gmail.com', 'Administrator', '1', '', '', ''),
(2, 'Nixy', '123', 'Nina', 'Torodovic', 'nina@gmail.com', 'User', '1', '', '', ''),
(3, 'test', '123', 'testi', 'testp', '1111@111.com', 'User', 'Yes', '', '', ''),
(16, '12345', '37528d5b126d811bee1b42c42907f347', '12345', '12345', '111xs@mimi.co1m3', 'User', '0', '', '', ''),
(17, 'yxcv', '37528d5b126d811bee1b42c42907f347', 'yxcv', 'yxcv', 'yxcv@ccc', 'User', '0', '', '', ''),
(18, 'asd', '123', 'asd', 'asd', 'asd@asd', 'User', '0', '', '', ''),
(20, 'kikiki', '$2y$10$aNn4CDTdgqKhNlx4dBOCl.Kdb6BqQrERfslSqvYh06YveATMG8CJS', '', '', 'xl_kid@yahoo.com', 'Administrator', 'Yes', '', 'No', 'ca20104f735ae1e7720e6a6b05b156c5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_categories`
--
ALTER TABLE `t_categories`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `t_description`
--
ALTER TABLE `t_description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_email`
--
ALTER TABLE `t_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_gender`
--
ALTER TABLE `t_gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `t_images`
--
ALTER TABLE `t_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_phonebook_det`
--
ALTER TABLE `t_phonebook_det`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_phonebook_more_numbers`
--
ALTER TABLE `t_phonebook_more_numbers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID` (`id`);

--
-- Indexes for table `t_title`
--
ALTER TABLE `t_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_categories`
--
ALTER TABLE `t_categories`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_description`
--
ALTER TABLE `t_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_email`
--
ALTER TABLE `t_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT for table `t_gender`
--
ALTER TABLE `t_gender`
  MODIFY `gender_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_images`
--
ALTER TABLE `t_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `t_phonebook_det`
--
ALTER TABLE `t_phonebook_det`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT for table `t_phonebook_more_numbers`
--
ALTER TABLE `t_phonebook_more_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=194;
--
-- AUTO_INCREMENT for table `t_title`
--
ALTER TABLE `t_title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
