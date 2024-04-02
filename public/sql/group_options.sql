-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2024 at 05:14 AM
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
-- Table structure for table `group_options`
--

CREATE TABLE `group_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `opt_title` varchar(255) DEFAULT NULL,
  `opt_correct` varchar(255) NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_options`
--

INSERT INTO `group_options` (`id`, `opt_title`, `opt_correct`, `question_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'A', 1, '2024-03-22 21:08:05', '2024-03-22 21:08:05'),
(2, NULL, 'B', 2, '2024-03-22 21:08:32', '2024-03-22 21:08:32'),
(3, NULL, 'C', 3, '2024-03-22 21:09:26', '2024-03-22 21:09:26'),
(4, NULL, 'A', 4, '2024-03-22 21:10:32', '2024-03-22 21:10:32'),
(5, NULL, 'C', 5, '2024-03-22 21:11:14', '2024-03-22 21:11:14'),
(6, NULL, 'C', 6, '2024-03-22 21:12:05', '2024-03-22 21:12:05'),
(7, NULL, 'B', 7, '2024-03-22 21:12:35', '2024-03-22 21:12:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `group_options`
--
ALTER TABLE `group_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_options_question_id_foreign` (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `group_options`
--
ALTER TABLE `group_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group_options`
--
ALTER TABLE `group_options`
  ADD CONSTRAINT `group_options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
