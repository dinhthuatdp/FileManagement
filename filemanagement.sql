-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2017 at 05:22 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `filemanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `filestore`
--

CREATE TABLE `filestore` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `name_gen` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `update_date` datetime NOT NULL,
  `major_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `filestore`
--

INSERT INTO `filestore` (`id`, `name`, `name_gen`, `update_date`, `major_id`, `user_id`) VALUES
(1, '1.pdf', 'php194B.pdf', '2017-09-07 02:56:34', 1, 1),
(11, '2.pdf', 'phpC744.pdf', '2017-09-06 04:38:53', 1, 1),
(12, '1.pdf', 'php3FBF.pdf', '2017-09-07 04:47:03', 1, 1),
(13, '1.pdf', 'php8300.pdf', '2017-09-07 06:32:11', 2, 1),
(14, '2.pdf', 'php8FF1.pdf', '2017-09-07 06:32:15', 2, 1),
(15, '1.pdf', 'php6C95.pdf', '2017-09-08 03:53:12', 1, 1),
(16, '2.pdf', 'php6CA6.pdf', '2017-09-08 03:53:12', 1, 1),
(17, '3.pdf', 'php6CA7.pdf', '2017-09-08 03:53:12', 1, 1),
(18, '4.pdf', 'php6CB7.pdf', '2017-09-08 03:53:12', 1, 1),
(19, 'memo.txt', 'php747C.txt', '2017-09-14 04:16:45', 3, 1),
(20, 'memo.txt', 'php76E2.txt', '2017-09-19 02:34:26', 2, 1),
(21, 'memo.txt', 'php7CF0.txt', '2017-09-19 02:38:49', 2, 1),
(22, 'memo.txt', 'php4670.txt', '2017-09-19 02:51:42', 2, 1),
(23, 'memo.txt', 'php1EB3.txt', '2017-09-20 02:02:22', 2, 1),
(24, 'memo.txt', 'php634A.txt', '2017-09-20 02:03:45', 2, 1),
(25, 'memo - Copy.txt', 'php77AE.txt', '2017-09-20 02:03:51', 3, 1),
(26, '3.pdf', 'php278D.pdf', '2017-09-20 02:20:59', 3, 1),
(27, '3.pdf', 'php4E0F.pdf', '2017-09-20 07:31:21', 1, 1),
(28, 'test.txt', 'php9EA1.txt', '2017-09-20 07:31:41', 3, 1),
(29, '1.pdf', 'php5EF5.pdf', '2017-09-20 10:03:15', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_majortype`
--

CREATE TABLE `m_majortype` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `m_majortype`
--

INSERT INTO `m_majortype` (`id`, `name`) VALUES
(1, 'truyện tranh'),
(2, 'giáo dục'),
(3, 'khoa học');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `create_date`, `email`) VALUES
(1, 'user1', '1', '2017-08-31 16:20:21', 'email1'),
(2, 'user2', '2', '2017-08-31 19:38:20', 'email2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `filestore`
--
ALTER TABLE `filestore`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkey` (`major_id`),
  ADD KEY `fkey_file_user` (`user_id`) USING BTREE;

--
-- Indexes for table `m_majortype`
--
ALTER TABLE `m_majortype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `filestore`
--
ALTER TABLE `filestore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `m_majortype`
--
ALTER TABLE `m_majortype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `filestore`
--
ALTER TABLE `filestore`
  ADD CONSTRAINT `fkey` FOREIGN KEY (`major_id`) REFERENCES `m_majortype` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
