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
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `que_num` varchar(255) NOT NULL,
  `que_content` text NOT NULL,
  `que_content_eng` text DEFAULT NULL,
  `que_content_ind` text DEFAULT NULL,
  `que_audio` varchar(255) DEFAULT NULL,
  `que_img` varchar(255) DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `que_num`, `que_content`, `que_content_eng`, `que_content_ind`, `que_audio`, `que_img`, `section_id`, `created_at`, `updated_at`) VALUES
(1, '1', 'soal script and vocab', 'soal script and vocab e', 'soal script and vocab i', NULL, NULL, 1, '2024-03-22 21:08:05', '2024-03-22 21:08:05'),
(2, '2', 'soal script and vocab 2', 'soal script and vocab ee', 'soal script and vocab ii', NULL, NULL, 1, '2024-03-22 21:08:32', '2024-03-22 21:08:32'),
(3, '1', 'conversation', 'conversation e', 'conversation i', NULL, 'que-images/3AweH3UYI8I1x6W3n1s0cZ2uE9ALgefJbURr94QY.png', 2, '2024-03-22 21:09:26', '2024-03-22 21:09:26'),
(4, '2', 'soal conv vocal', 'soal conv vocal e', 'soal conv vocal i', 'que-audios/MSbbTrsAlNe6f2kRN7QmDcqFnt2A0ICGXDU1t7X6.mp3', NULL, 2, '2024-03-22 21:10:32', '2024-03-22 21:10:32'),
(5, '1', 'danguken', 'danguken e', 'danguken i', 'que-audios/1TAM5IHdgJ0TXmbUoQ7ObwW3IfJJRu3sTbn9rlli.mp3', NULL, 3, '2024-03-22 21:11:14', '2024-03-22 21:11:14'),
(6, '2', 'danguken 2', 'danguken 2 e', 'danguken 2 i', 'que-audios/MiGPxSPs3Pg9Cq3xcb75lTxoBZbNLtUOX08AJJ1d.mp3', NULL, 3, '2024-03-22 21:12:05', '2024-03-22 21:12:05'),
(7, '1', 'soal reading', 'soal reading e', 'soal reading i', NULL, NULL, 4, '2024-03-22 21:12:35', '2024-03-22 21:12:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_section_id_foreign` (`section_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
