-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2025 at 07:12 PM
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
-- Database: `client_nest_crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `user_id`, `name`, `email`, `phone`, `company`, `notes`, `created_at`, `updated_at`) VALUES
(3, 1, 'Md. Shahin Alam', 'dupl.shahin@gmail.com', '01723095418', 'aaaa', 'aaaa', '2025-04-25 05:08:23', '2025-04-25 05:08:23'),
(4, 1, 'md. shamim', 'shahmim@gmail.com', '123123213', 'desh univesal', 'Hello', '2025-04-25 05:30:52', '2025-04-25 05:30:52'),
(5, 1, 'sabina', 'sabina@gmail.com', '23424234', 'dessss', 'ki obostha', '2025-04-25 05:33:27', '2025-04-25 05:46:54'),
(6, 1, 'Faysal', 'faysal@gmail.com', '01723095418', 'lalbagh govt model school and college', 'ekhane ekjon emlpoyar seee', '2025-04-26 22:26:21', '2025-04-26 22:26:21'),
(7, 1, 'Arif', 'arif@gmail.com', '01723095418', 'lalbag', 'aa vb nn cc', '2025-04-26 22:30:53', '2025-04-26 22:30:53'),
(8, 1, 'Rustom', 'arif@gmail.com', '01723095418', 'hello', 'ss bb ss cc', '2025-04-26 22:32:08', '2025-04-26 22:32:08'),
(9, 1, 'Anowar', 'dupl.shahin@gmail.com', '01723095418', 'lgmsc', 'aa cc bb nn', '2025-04-26 22:32:35', '2025-04-26 22:32:35'),
(10, 1, 'maya begum', 'maya@gmail.com', 'aaa', 'vv', 'aaa', '2025-04-26 22:33:09', '2025-04-26 22:33:09'),
(11, 1, 'jakir', 'jakir@gmail.com', '01723095418', 'aa vv', 'aa bbv  cc caa', '2025-04-26 22:33:37', '2025-04-26 22:33:37'),
(12, 1, 'roki', 'roki@gmail.com', '01723095418', 'aaa bb', 'aa bb ccc', '2025-04-26 22:34:00', '2025-04-26 22:34:00'),
(16, 1, 'Md. Shahin Alam', 'alam@gmail.com', '0172309541811', 'aa', 'aaaaa', '2025-04-26 22:56:27', '2025-04-26 22:56:55'),
(17, 2, 'Md. Shahin Alam', 'shahin@gmail.com', '01912352823', 'Desh universal PVT LTD', 'A new Customer', '2025-04-27 06:37:10', '2025-04-27 08:01:03'),
(22, 2, 'Farabi', 'farabi1@gmail.com', '01723095413', 'ABC company', 'Talk about a school management system software', '2025-04-27 08:45:28', '2025-04-27 08:46:00');

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
-- Table structure for table `interaction_logs`
--

CREATE TABLE `interaction_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('call','email','meeting') NOT NULL,
  `interaction_date` date NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interaction_logs`
--

INSERT INTO `interaction_logs` (`id`, `user_id`, `client_id`, `type`, `interaction_date`, `notes`, `created_at`, `updated_at`) VALUES
(3, 1, 5, 'meeting', '2025-04-25', 'aaaaaaaaaa', '2025-04-25 07:08:45', '2025-04-26 23:42:32'),
(4, 1, 3, 'call', '2025-04-25', 'yes kotha hoiche', '2025-04-25 09:59:21', '2025-04-25 10:40:24'),
(5, 1, 4, 'email', '2025-04-24', 'okkk okkk', '2025-04-25 10:41:44', '2025-04-25 10:41:44'),
(6, 1, 7, 'meeting', '2025-04-27', 'ha ha kotha hoyeche', '2025-04-26 23:54:10', '2025-04-26 23:54:10'),
(7, 1, 8, 'email', '2025-04-26', 'aak lll', '2025-04-27 00:17:38', '2025-04-27 00:17:38'),
(8, 2, 17, 'meeting', '2025-04-27', '1. logo\r\n2. navbar\r\n3. header\r\n4. feature section\r\n5. testimonial', '2025-04-27 06:40:31', '2025-04-27 06:40:31'),
(9, 2, 22, 'call', '2025-04-27', '1.  Add Result management', '2025-04-27 09:45:45', '2025-04-27 09:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_24_044628_create_clients_table', 2),
(5, '2025_04_24_044636_create_projects_table', 2),
(6, '2025_04_24_185053_create_reminders_table', 3),
(7, '2025_04_24_193210_create_interaction_logs_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('dupl.shahin@gmail.com', '$2y$12$9Vc1T39Ww6ctYng9tewAqu3kIis1dld251IZI0aiYTIjnPEX9KUa2', '2025-04-25 11:27:03');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `budget` decimal(10,2) NOT NULL,
  `deadline` date NOT NULL,
  `status` enum('Pending','Ongoing','Completed') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `client_id`, `title`, `budget`, `deadline`, `status`, `created_at`, `updated_at`) VALUES
(6, 12, 'E-commer site', 10000001.00, '2025-05-31', 'Pending', '2025-04-26 22:59:19', '2025-04-26 23:28:08'),
(7, 9, 'Digital marketing', 23232323.00, '2025-04-29', 'Completed', '2025-04-26 23:01:20', '2025-04-26 23:30:55'),
(8, 7, 'seo page', 65443543.00, '2025-04-28', 'Completed', '2025-04-26 23:01:55', '2025-04-26 23:01:55'),
(9, 17, 'A CRM Management project', 900000.00, '2025-04-30', 'Pending', '2025-04-27 06:38:09', '2025-04-27 06:38:09'),
(11, 22, 'School Management Software', 900010.00, '2025-04-30', 'Ongoing', '2025-04-27 08:59:28', '2025-04-27 08:59:50');

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `due_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`id`, `user_id`, `client_id`, `project_id`, `title`, `notes`, `due_date`, `created_at`, `updated_at`) VALUES
(15, 1, 7, 8, 'Seo er kaj ta ore bujay dite hobe', 'druto kore dite hobe', '2025-04-30', '2025-04-26 23:05:19', '2025-04-26 23:36:25'),
(16, 1, 9, 7, 'Digital marketing', 'ok kore dicchi', '2025-05-01', '2025-04-26 23:23:43', '2025-04-26 23:36:15'),
(17, 2, 17, 9, 'CRM project', 'They need urgent this software', '2025-04-30', '2025-04-27 06:39:30', '2025-04-27 06:39:30'),
(18, 2, 22, 11, 'Check progress', '1. School website development\r\n2. Students attendance system\r\n3. Students payment system\r\n4. Teacher Panel create', '2025-04-28', '2025-04-27 09:26:20', '2025-04-27 09:26:56');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('YCIR85GcePConJFOZZnGnV405Ua4lUZ7hQsy4rlu', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2dlN3RCc3hsMFJ0NXMwd0hwNjg0b2ExNjU2WEZVdE0wTHRlVFlvciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvRnJlZWxhbmNlRmxvdy1DUk0vcHVibGljIjt9fQ==', 1745770988);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Md. Shahin Alam', 'admin@gmail.com', NULL, '$2y$12$iCRjxx97hcRgkSdmOQUlpulbF0xukedkAu8Yuod3xAdylN4AN7Lcu', NULL, '2025-04-23 22:42:34', '2025-04-24 14:32:20'),
(2, 'Shahin Alam', 'dupl.shahin@gmail.com', NULL, '$2y$12$s.nEZkMO3mcYnws8.V6ymuIWs295nz6JrKd2vPQuiFJcR2iLQQ6qC', NULL, '2025-04-25 11:26:03', '2025-04-25 11:26:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `interaction_logs`
--
ALTER TABLE `interaction_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interaction_logs_user_id_foreign` (`user_id`),
  ADD KEY `interaction_logs_client_id_foreign` (`client_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_client_id_foreign` (`client_id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reminders_user_id_foreign` (`user_id`),
  ADD KEY `reminders_client_id_foreign` (`client_id`),
  ADD KEY `reminders_project_id_foreign` (`project_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interaction_logs`
--
ALTER TABLE `interaction_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `interaction_logs`
--
ALTER TABLE `interaction_logs`
  ADD CONSTRAINT `interaction_logs_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `interaction_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reminders`
--
ALTER TABLE `reminders`
  ADD CONSTRAINT `reminders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reminders_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reminders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
