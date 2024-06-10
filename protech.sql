-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2024 at 01:54 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `protech`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `course_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `title`, `course_id`, `created_at`) VALUES
(8, 'HTML', 1, '2024-06-08 05:09:22'),
(9, 'CSS', 1, '2024-06-08 05:09:51'),
(10, 'Bootstrap', 1, '2024-06-08 05:10:10'),
(11, 'PHP', 2, '2024-06-08 05:10:23'),
(12, 'Microsoft Word', 3, '2024-06-08 05:11:40'),
(13, 'Basic Photoshop Course', 1, '2024-06-08 08:40:40'),
(14, 'Basic Java Script Course', 1, '2024-06-08 08:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fee` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `description`, `content`, `duration`, `type`, `fee`, `image`, `created_at`) VALUES
(1, 'Web Design Course', 'web design basic', 'My name is web design Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', '1 year', 'video', 600000, '123.png', '2024-06-08 10:35:58'),
(2, 'Web Development Course', 'web development basic', 'My name is web development Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo conseq', '2 years', 'video', 600000, 'HD-wallpaper-laptop-red-sunset-background-laptop.jpg', '2024-06-08 10:37:10'),
(3, 'Computer Basic Course', 'basic window operation system', 'My name is basic courseLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '3 months', 'video', 100000, 'courseimg.png', '2024-06-08 10:34:27'),
(12, 'A+ Hardware Course', 'Basic A+ Course', ' My name is Hardware My name is Hardware  My name is Hardware My name is Hardware  My name is Hardware My name is Hardware  My name is Hardware My name is Hardware  My name is Hardware My name is Hardware  My name is Hardware My name is Hardware  My name ', '3 months', 'video', 100000, '168587.jpg', '2024-06-08 10:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2024-05-30 05:12:57', '2024-05-30 05:12:57'),
(2, 'user', '2024-05-30 05:13:19', '2024-05-30 05:13:19');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `updated_at`, `created_at`) VALUES
(4, 1, 15, '2024-05-30 08:51:16', '2024-05-30 08:51:16'),
(6, 2, 17, '2024-05-30 09:00:06', '2024-05-30 09:00:06'),
(10, 2, 21, '2024-05-30 10:13:46', '2024-05-30 10:13:46'),
(11, 1, 22, '2024-05-30 10:50:27', '2024-05-30 10:50:27'),
(13, 2, 24, '2024-05-31 05:03:48', '2024-05-31 05:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` text CHARACTER SET utf8 DEFAULT NULL,
  `password` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(15, 'Myat Thu', 'myatthu@gmail.com', '$2y$10$YAfC0LH.xzEZhV0eGPGoOulqg1f73LHkVvdT1Xz39a.c/IBRCSeJq', '2024-05-30 08:51:16', '2024-05-31 10:53:46'),
(17, 'Tommy', 'tommy@gmail.com', '$2y$10$uIlMws6tyQh/qb8xs9cKRO5dWwZZ01vHGE1Qey9iRbtBhXcqoD/Q.', '2024-05-30 09:00:06', '2024-05-30 15:30:06'),
(21, 'Peter', 'peter@gmail.com', '$2y$10$6pOxJDnCDHNgSoHnwLwYf.SLPejCYgI8rb9/gjvsIzNpeew.uk.nW', '2024-05-30 10:13:46', '2024-05-30 12:58:06'),
(22, 'Administrator', 'admin@gmail.com', '$2y$10$OLcpsutAesNPfupssaKvN.Pi58Qw88H.rm6eVtMvNUtjh.DyRcLPG', '2024-05-30 10:50:27', '2024-05-30 01:43:06'),
(24, 'Hla Min Soe', 'hla@gmail.com', '$2y$10$YUZw9QVLVoiROZ/dh7v.I.9/Kcbv1C9qeao6wpENTKLEB4aYBO566', '2024-05-31 05:03:48', '2024-05-31 11:33:48');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video_order` int(11) DEFAULT 1,
  `video_url` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
