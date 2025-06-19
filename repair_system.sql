-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 08:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `repair_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_materials`
--

CREATE TABLE `company_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_materials`
--

INSERT INTO `company_materials` (`id`, `company_id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 2, 'Qasim', 224.00, '2023-11-05 23:37:29', '2023-11-05 23:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `extrafieldvalues`
--

CREATE TABLE `extrafieldvalues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `compnyID` int(11) NOT NULL,
  `repairID` int(11) NOT NULL,
  `keyNvalues` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`keyNvalues`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extrafieldvalues`
--

INSERT INTO `extrafieldvalues` (`id`, `compnyID`, `repairID`, `keyNvalues`, `created_at`, `updated_at`) VALUES
(9, 7, 24, '{\"Car_Name\":\"Thor\",\"Breaks\":\"Repair\",\"Lights\":\"Yes\"}', '2023-11-11 16:57:44', '2023-11-11 16:58:11'),
(10, 2, 25, '{\"Head_light\":\"B\",\"Back_Light\":\"b\"}', '2023-11-14 18:01:14', '2023-11-14 18:01:14'),
(12, 2, 27, '{\"Head_light\":\"ON\",\"Back_Light\":\"NO\"}', '2023-11-14 19:14:06', '2023-11-14 19:21:48'),
(13, 2, 28, '{\"Head_light\":\"no\",\"Back_Light\":null}', '2023-11-14 20:31:11', '2023-11-14 20:31:11');

-- --------------------------------------------------------

--
-- Table structure for table `extra_fields`
--

CREATE TABLE `extra_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `compnyID` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `key` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`key`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extra_fields`
--

INSERT INTO `extra_fields` (`id`, `compnyID`, `created_at`, `updated_at`, `key`) VALUES
(23, 7, '2023-11-11 16:56:44', '2023-11-11 16:56:44', '{\"Car_Name\":null,\"Breaks\":null,\"Lights\":null}'),
(24, 2, '2023-11-14 18:00:53', '2023-11-14 18:00:53', '{\"Head_light\":null,\"Back_Light\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `repair_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `repair_id`, `user_id`, `name`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(2, 3, 2, 'Test Material Compnay', 20, 240.00, '2023-08-17 06:08:45', '2023-08-17 06:08:45'),
(3, 3, 2, 'Test Material Compnay', 12, 2880.00, '2023-08-17 06:08:52', '2023-08-17 06:08:52'),
(4, 3, 2, 'Test Material Compnay', 12, 2400.00, '2023-08-18 00:57:56', '2023-08-18 00:57:56'),
(5, 3, 2, 'Test Material Compnay', 12, 28800.00, '2023-08-18 00:58:41', '2023-08-18 00:58:41'),
(6, 3, 2, 'Test Material Compnay', 12, 28680.00, '2023-08-18 00:59:11', '2023-08-18 00:59:11'),
(7, 3, 2, 'Test Material Compnay', 2, 4800.30, '2023-08-19 01:48:04', '2023-08-19 01:48:04'),
(8, 3, 6, 'Qasim', 4, 224.00, '2023-11-05 23:37:29', '2023-11-05 23:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `repair_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `repair_id`, `path`, `created_at`, `updated_at`) VALUES
(1, 1, 'http://127.0.0.1:8000/uploads/repair/rc4v1692082892.png', '2023-08-15 02:01:32', '2023-08-15 02:01:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_07_14_110320_create_roles_table', 2),
(7, '2023_07_20_090119_create_repairs_table', 3),
(8, '2023_07_24_070322_create_materials_table', 4),
(9, '2023_07_31_061233_add_deleted_at_to_users', 5),
(10, '2023_08_10_081702_create_media_table', 6),
(11, '2023_08_11_094430_create_updates_table', 7),
(14, '2023_08_17_075537_create_company_materials_table', 8),
(15, '2023_11_05_145529_create_extra_fields_table', 9),
(16, '2023_11_10_121936_add_column_key_to_table_extra_fields', 10),
(17, '2023_11_10_184800_create_extrafieldvalues_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('technofortress11@gmail.com', '$2y$10$OZBbxlnOOQ8XfCleQ96b7.1zU/NO7Fa03pC5sPxi28UI7jFqAIo9G', '2023-08-15 01:28:02'),
('team.technofortress@gmail.com', '$2y$10$1WCSIRxSWCNCitNyW3CoveEWtpqCdgU378O/peCIO..WD7BK7vcYe', '2023-08-15 01:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repairs`
--

CREATE TABLE `repairs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` enum('Awaiting inspection','Awaiting parts','In progress','Completed','Paid','Collected') NOT NULL DEFAULT 'Awaiting inspection',
  `status_date` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `prior_work` text DEFAULT NULL,
  `accessories` text DEFAULT NULL,
  `work_requested` text DEFAULT NULL,
  `warranty` int(11) DEFAULT 0,
  `note` text DEFAULT NULL,
  `technician_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hours` decimal(8,2) DEFAULT NULL,
  `hour_rate` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `repairs`
--

INSERT INTO `repairs` (`id`, `company_id`, `created_by`, `token`, `status`, `status_date`, `updated_by`, `name`, `phone`, `email`, `brand`, `color`, `type`, `prior_work`, `accessories`, `work_requested`, `warranty`, `note`, `technician_notes`, `created_at`, `updated_at`, `hours`, `hour_rate`) VALUES
(1, 2, 3, 'KG20232207cQ', 'In progress', NULL, 2, 'Test Booking', '782346723', 'ali.fahad.arain@gmail.com', 'BMW', 'black', 'test', 'Test prior work', 'Test accessories', 'change colour', 1, 'test note', 'test notes', '2023-07-22 01:51:09', '2023-08-02 01:31:14', NULL, NULL),
(3, 2, 3, 'F820232707pp', 'Completed', '2023-10-10', 2, 'Fahad Ali Asif', '+923070717074', 'zainalix9@gmail.com', 'BMW', 'black', 'test', 'Test', 'Test', 'test', 1, 'test', 'testt', '2023-07-27 04:48:49', '2023-11-14 19:06:57', 13.00, 1.20),
(18, 2, 2, 'ei20231011NI', 'Awaiting inspection', NULL, 2, 'Zunu', '03137898012', 'meet.zulnurain@gmail.com', 'Thor', 'Black', 'Jeep', 'NO', 'NO', 'Engin', 1, 'Be Careful', NULL, '2023-11-11 03:40:53', '2023-11-11 03:42:29', NULL, NULL),
(20, 2, 6, '2l20231011SH', 'Awaiting inspection', NULL, 6, 'meet.zulnurain@gmail.com', '03137898012', 'ali@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-11 03:47:10', '2023-11-11 03:47:45', NULL, NULL),
(21, 2, 2, 'e220231011XV', 'Awaiting inspection', NULL, 2, 'meet', '03137898012', 'zulnurain@gmail.com', 'nopn', 'opn', 'o', 'NPO', 'on', 'nono', 1, 'k', NULL, '2023-11-11 03:56:52', '2023-11-11 04:03:50', 12.00, 23.00),
(24, 7, 8, 'AJ202311118O', 'Awaiting inspection', NULL, 8, 'Zunu', '03137898012', 'Zunu@gmail.com', 'Thor', 'Black', 'Jeep', 'NO', 'NO', 'Engin', 1, 'NO', NULL, '2023-11-11 16:57:44', '2023-11-11 16:58:11', NULL, NULL),
(25, 2, 2, 'jH20231411sJ', 'Awaiting inspection', NULL, NULL, 'dryx', 'v', 'Zunu@gmail.com', NULL, NULL, NULL, 'b', NULL, 'yuvb', NULL, NULL, NULL, '2023-11-14 18:01:14', '2023-11-14 18:01:14', NULL, NULL),
(27, 2, 6, 'IC20231411d3', 'Awaiting inspection', NULL, 2, 'meet.zulnurai', '03137898012', 'zulnurain@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-14 19:14:06', '2023-11-14 19:21:49', NULL, NULL),
(28, 2, 2, 'C120231411j7', 'Awaiting inspection', NULL, NULL, 'asjak', '03137898012', 'zaman@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-14 20:31:11', '2023-11-14 20:31:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'super admin', '2023-07-14 11:06:31', NULL),
(2, 'company', '2023-07-14 11:06:31', NULL),
(3, 'staff', '2023-07-14 11:06:31', NULL),
(4, 'technician', '2023-07-14 11:06:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `updates`
--

INSERT INTO `updates` (`id`, `version`, `content`, `created_at`, `updated_at`) VALUES
(1, '1.1', 'test', '2023-08-19 07:16:25', '2023-08-19 07:16:25'),
(2, '1.2', 'test', '2023-08-19 07:16:25', '2023-08-19 07:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_id`, `name`, `email`, `email_verified_at`, `password`, `profile`, `role_id`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Admin', 'team.technofortress@gmail.com', NULL, '$2y$10$jJikNT5mC3ibBUUjHY8e2eLaJ7T0JFyAadPBj6wU30N/hDiG9s6Nm', 'http://127.0.0.1:8000/uploads/profiles/1689594735.jpg', 1, 'WIq2Gk6kn1lAi5NYfKQsgfWBxrwNQsczYlJE8j71uCaauBron29jZU5Qs6Ip', NULL, '2023-08-15 01:38:18', NULL),
(2, NULL, 'Techno Fortress', 'technofortress11@gmail.com', NULL, '$2y$10$CLc7dE4sFWFtQO/9nzQHXeLZjrvyMOrBTkvxPq1/vgA2NZxtO/ENy', 'https://static.vecteezy.com/system/resources/previews/008/214/517/original/abstract-geometric-logo-or-infinity-line-logo-for-your-company-free-vector.jpg', 2, 'HIQH40dMJvBPcnV3u5JByCprlQjf6wwdQjj9oD6BewUwhqj4VV4d06w3PQty', '2023-07-17 06:53:00', '2024-03-30 01:13:24', '2024-03-30 01:13:24'),
(3, 2, 'User 1', 'user@gmail.com', NULL, '$2y$10$CLc7dE4sFWFtQO/9nzQHXeLZjrvyMOrBTkvxPq1/vgA2NZxtO/ENy', 'http://127.0.0.1:8000/uploads/profiles/1690370016.jpg', 3, NULL, '2023-07-17 06:53:00', '2023-08-15 01:49:27', NULL),
(4, 2, 'Technicain 1', 'tech@gmail.com', NULL, '$2y$10$CLc7dE4sFWFtQO/9nzQHXeLZjrvyMOrBTkvxPq1/vgA2NZxtO/ENy', 'http://127.0.0.1:8000/uploads/profiles/1689674632.jpg', 4, NULL, '2023-07-17 06:53:00', '2023-07-18 05:03:52', NULL),
(5, 2, 'Zunu', 'meet.zulnurain@gmail.com', NULL, '$2y$10$ZQiuIHkkgt3FTx1R8oB.BeblFa724rk12YJK2l56Wcc0V4a5dNJFy', NULL, 1, NULL, '2023-11-05 14:33:06', '2023-11-05 14:33:06', NULL),
(6, 2, 'Qasim', 'Qasim@gmail.com', NULL, '$2y$10$BV3vt821kqyAUA5Y9tgUGO5rlKxWteBTVnWf5HzWgsxT4qdSNeqxq', NULL, 3, NULL, '2023-11-05 15:27:40', '2023-11-05 15:27:40', NULL),
(7, NULL, 'Umair', 'Umair@gmail.com', NULL, '$2y$10$LScPeUg8QOVN/Z5mSpV4q.ClMiBlNYOonrU//HklKhrQqntO9X.ia', NULL, 2, NULL, '2023-11-11 03:44:26', '2024-03-30 01:15:45', '2024-03-30 01:15:45'),
(8, 7, 'Zaman', 'zaman@gmail.com', NULL, '$2y$10$3yz8GzUMm3r5uCOMl3Z53.70ERnoFwH/I5Yy9LdfAcY4I7K/9Hj6m', NULL, 3, NULL, '2023-11-11 15:29:03', '2023-11-11 15:29:03', NULL),
(9, NULL, 'Qasim', 'zulnurain@gmail.com', NULL, '$2y$10$mwi3run2t0mTg0wWIVHi3e9qvvdwbG7fSN/VGu4TJcnl147BqOBX2', NULL, 2, NULL, '2024-03-30 01:16:30', '2024-03-30 01:16:37', '2024-03-30 01:16:37'),
(10, NULL, 'Zunu Rathore', 'zlnurain@gmail.com', NULL, '$2y$10$XOtrKTenoEAZUhT/G4IeXusfqbbscfbhWqrSceyi9Px1vNeNzQK3G', NULL, 2, NULL, '2024-03-30 01:22:14', '2024-03-30 01:22:55', '2024-03-30 01:22:55'),
(11, NULL, 'Zunu Rathore', 'nurain@gmail.com', NULL, '$2y$10$e4D6eROn3t9YCUfmqm7IMuiKpmzDgidqMjZA/rjvnxj9lnNboV9.G', NULL, 2, NULL, '2024-03-30 01:23:38', '2024-03-30 01:23:38', NULL),
(12, NULL, 'Zunu', 'mheet.zulnurain@gmail.com', NULL, '$2y$10$bMOIpgGtdUNMZzkXWR53a.fw12eHNHy1EibdG9/8oU34e7G/k61WG', NULL, 2, NULL, '2024-03-30 02:32:03', '2024-03-30 02:32:03', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_materials`
--
ALTER TABLE `company_materials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_materials_name_unique` (`name`);

--
-- Indexes for table `extrafieldvalues`
--
ALTER TABLE `extrafieldvalues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_fields`
--
ALTER TABLE `extra_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `repairs`
--
ALTER TABLE `repairs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `repairs_token_unique` (`token`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_materials`
--
ALTER TABLE `company_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `extrafieldvalues`
--
ALTER TABLE `extrafieldvalues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `extra_fields`
--
ALTER TABLE `extra_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repairs`
--
ALTER TABLE `repairs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
