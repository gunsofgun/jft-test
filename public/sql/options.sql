-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2024 at 05:15 AM
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
-- Database: `jft-test`
--

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `opt_content` text DEFAULT NULL,
  `opt_char` text NOT NULL,
  `opt_img` varchar(255) DEFAULT NULL,
  `group_option_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `opt_content`, `opt_char`, `opt_img`, `group_option_id`, `created_at`, `updated_at`) VALUES
(1, 'aaa', 'A', NULL, 1, '2024-03-22 21:08:05', '2024-03-22 21:08:05'),
(2, 'bbb', 'B', NULL, 1, '2024-03-22 21:08:05', '2024-03-22 21:08:05'),
(3, 'ccc', 'C', NULL, 1, '2024-03-22 21:08:05', '2024-03-22 21:08:05'),
(4, NULL, 'D', NULL, 1, '2024-03-22 21:08:05', '2024-03-22 21:08:05'),
(5, 'zxc', 'A', NULL, 2, '2024-03-22 21:08:32', '2024-03-22 21:08:32'),
(6, 'zxcc', 'B', NULL, 2, '2024-03-22 21:08:32', '2024-03-22 21:08:32'),
(7, 'zxcccc', 'C', NULL, 2, '2024-03-22 21:08:32', '2024-03-22 21:08:32'),
(8, NULL, 'D', NULL, 2, '2024-03-22 21:08:32', '2024-03-22 21:08:32'),
(9, 'aaa', 'A', NULL, 3, '2024-03-22 21:09:26', '2024-03-22 21:09:26'),
(10, 'bbbb', 'B', NULL, 3, '2024-03-22 21:09:26', '2024-03-22 21:09:26'),
(11, 'cccc', 'C', NULL, 3, '2024-03-22 21:09:26', '2024-03-22 21:09:26'),
(12, NULL, 'D', NULL, 3, '2024-03-22 21:09:26', '2024-03-22 21:09:26'),
(13, 'vvv a', 'A', NULL, 4, '2024-03-22 21:10:32', '2024-03-22 21:10:32'),
(14, 'vvvv b', 'B', NULL, 4, '2024-03-22 21:10:32', '2024-03-22 21:10:32'),
(15, 'vvvv c', 'C', NULL, 4, '2024-03-22 21:10:32', '2024-03-22 21:10:32'),
(16, NULL, 'D', NULL, 4, '2024-03-22 21:10:32', '2024-03-22 21:10:32'),
(17, 'danguken aaa', 'A', NULL, 5, '2024-03-22 21:11:14', '2024-03-22 21:11:14'),
(18, 'danguken bbb', 'B', NULL, 5, '2024-03-22 21:11:14', '2024-03-22 21:11:14'),
(19, 'danguken ccc', 'C', NULL, 5, '2024-03-22 21:11:14', '2024-03-22 21:11:14'),
(20, NULL, 'D', NULL, 5, '2024-03-22 21:11:14', '2024-03-22 21:11:14'),
(21, NULL, 'A', 'opt-images/pvzE8gz3fz4Rxz8B6UXyMmwBRx61OYRFr0zFSXuO.png', 6, '2024-03-22 21:12:05', '2024-03-22 21:12:05'),
(22, NULL, 'B', 'opt-images/zKqELAl69U41ISLLKeAc4qaVIC7iZT0NZsUeGJrh.png', 6, '2024-03-22 21:12:05', '2024-03-22 21:12:05'),
(23, NULL, 'C', 'opt-images/Jq76oXo3V17VDn6lCOgjRotfjqXryTAUbIHgOUbw.png', 6, '2024-03-22 21:12:05', '2024-03-22 21:12:05'),
(24, NULL, 'D', NULL, 6, '2024-03-22 21:12:05', '2024-03-22 21:12:05'),
(25, NULL, 'A', 'opt-images/6kjBLxUvkH3pprgB4DErlCmW1R9KHh2Sq01RUjUO.png', 7, '2024-03-22 21:12:35', '2024-03-22 21:12:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_group_option_id_foreign` (`group_option_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_group_option_id_foreign` FOREIGN KEY (`group_option_id`) REFERENCES `group_options` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
