-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2026 at 07:13 PM
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
-- Database: `clearsight`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"remember_token\":\"y3C9DAUUc0VWF6h6E2x42X3fmZxD11iXEfj8vu05iLdwcX63sLDwGi8c243y\"},\"old\":{\"remember_token\":\"Ej1pRMMvniytKFklXQYLnLyEHqaB37GURlrH24oCV6wLWhutwkMQjqcoDgEF\"}}', NULL, '2026-06-03 08:05:22', '2026-06-03 08:05:22'),
(2, 'default', 'created', 'App\\Models\\CareHome', 'created', 15, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":15,\"name\":\"Jakeem Kidd\",\"address\":\"Natus sed modi quaer\",\"manager_name\":\"Sonia Hart\",\"email\":\"xocopuve@mailinator.com\",\"phone\":\"+1 (376) 599-8081\",\"created_at\":\"2026-06-03T13:07:30.000000Z\",\"updated_at\":\"2026-06-03T13:07:30.000000Z\",\"deleted_at\":null}}', NULL, '2026-06-03 08:07:30', '2026-06-03 08:07:30'),
(3, 'default', 'created', 'App\\Models\\User', 'created', 15, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":15,\"name\":\"Sonia Hart\",\"username\":\"fojemij\",\"email\":\"xocopuve@mailinator.com\",\"phone\":null,\"address\":null,\"password\":\"$2y$12$\\/84GjT5L62q1pAt82Mz8K.cXRqeQwAzYJ\\/.KqLLFdMlI7ycfehdVW\",\"role\":\"carehome\",\"care_home_id\":15,\"is_active\":true,\"is_admin\":0,\"remember_token\":null,\"created_at\":\"2026-06-03T13:07:30.000000Z\",\"updated_at\":\"2026-06-03T13:07:30.000000Z\",\"deleted_at\":null}}', NULL, '2026-06-03 08:07:30', '2026-06-03 08:07:30'),
(4, 'default', 'Document viewed', 'App\\Models\\ResidentDocument', NULL, 33, 'App\\Models\\User', 1, '{\"resident_id\":243,\"resident_name\":\"Frances Yule\",\"filename\":\"Landing Page Updated _ 6-02.png\"}', NULL, '2026-06-03 08:28:49', '2026-06-03 08:28:49'),
(5, 'default', 'Document uploaded', 'App\\Models\\ResidentDocument', NULL, 35, 'App\\Models\\User', 1, '{\"resident_id\":243,\"resident_name\":\"Frances Yule\",\"filename\":\"Landing Page Updated _ 6-09.png\",\"filesize\":1226931}', NULL, '2026-06-03 08:28:59', '2026-06-03 08:28:59'),
(6, 'default', 'Document viewed', 'App\\Models\\ResidentDocument', NULL, 33, 'App\\Models\\User', 1, '{\"resident_id\":243,\"resident_name\":\"Frances Yule\",\"filename\":\"Landing Page Updated _ 6-02.png\"}', NULL, '2026-06-03 08:29:02', '2026-06-03 08:29:02'),
(7, 'default', 'Document viewed', 'App\\Models\\ResidentDocument', NULL, 35, 'App\\Models\\User', 1, '{\"resident_id\":243,\"resident_name\":\"Frances Yule\",\"filename\":\"Landing Page Updated _ 6-09.png\"}', NULL, '2026-06-03 08:29:05', '2026-06-03 08:29:05'),
(8, 'default', 'Document downloaded', 'App\\Models\\ResidentDocument', NULL, 35, 'App\\Models\\User', 1, '{\"resident_id\":243,\"resident_name\":\"Frances Yule\",\"filename\":\"Landing Page Updated _ 6-09.png\"}', NULL, '2026-06-03 08:29:11', '2026-06-03 08:29:11'),
(9, 'default', 'Document uploaded', 'App\\Models\\ResidentDocument', NULL, 36, 'App\\Models\\User', 1, '{\"resident_id\":242,\"resident_name\":\"Joan Jones\",\"filename\":\"Landing Page Updated _ 6-03.png\",\"filesize\":1172990}', NULL, '2026-06-03 12:10:52', '2026-06-03 12:10:52'),
(10, 'default', 'Document viewed', 'App\\Models\\ResidentDocument', NULL, 36, 'App\\Models\\User', 1, '{\"resident_id\":242,\"resident_name\":\"Joan Jones\",\"filename\":\"Landing Page Updated _ 6-03.png\"}', NULL, '2026-06-03 12:10:55', '2026-06-03 12:10:55'),
(11, 'default', 'Document deleted', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"resident_id\":242,\"resident_name\":\"Joan Jones\",\"filename\":\"Landing Page Updated _ 6-03.png\",\"filesize\":1172990}', NULL, '2026-06-03 12:11:00', '2026-06-03 12:11:00'),
(12, 'default', 'Document uploaded', 'App\\Models\\ResidentDocument', NULL, 37, 'App\\Models\\User', 1, '{\"resident_id\":241,\"resident_name\":\"Alison Donald\",\"filename\":\"Landing Page Updated _ 6-08.png\",\"filesize\":793183}', NULL, '2026-06-03 12:11:11', '2026-06-03 12:11:11'),
(13, 'default', 'Document viewed', 'App\\Models\\ResidentDocument', NULL, 37, 'App\\Models\\User', 1, '{\"resident_id\":241,\"resident_name\":\"Alison Donald\",\"filename\":\"Landing Page Updated _ 6-08.png\"}', NULL, '2026-06-03 12:11:14', '2026-06-03 12:11:14'),
(14, 'default', 'Report uploaded', 'App\\Models\\ServiceRequestReport', NULL, 6, 'App\\Models\\User', 1, '{\"service_request_id\":8,\"resident_name\":\"Demo Six\",\"file_name\":\"Landing Page Updated _ 6-09.png\"}', NULL, '2026-06-03 12:11:26', '2026-06-03 12:11:26'),
(15, 'default', 'Report viewed', 'App\\Models\\ServiceRequestReport', NULL, 6, 'App\\Models\\User', 1, '{\"service_request_id\":8,\"file_name\":\"Landing Page Updated _ 6-09.png\"}', NULL, '2026-06-03 12:11:33', '2026-06-03 12:11:33'),
(16, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"remember_token\":\"e0HvVG5tEQrXxcR96d83qHIEAy3Wmlj7XPN2I8ga8Mk6mcNuF1p7BStp7s2o\"},\"old\":{\"remember_token\":\"y3C9DAUUc0VWF6h6E2x42X3fmZxD11iXEfj8vu05iLdwcX63sLDwGi8c243y\"}}', NULL, '2026-06-03 12:11:49', '2026-06-03 12:11:49');

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
-- Table structure for table `care_homes`
--

CREATE TABLE `care_homes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `manager_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `care_homes`
--

INSERT INTO `care_homes` (`id`, `name`, `address`, `manager_name`, `email`, `phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'Demo Home', '19 Lowick Avenue, Bolton, BL3 2DX', 'Mehdi', 'mohammedtirmazi@gmail.com', 'Tirmazi', '2026-05-13 09:34:24', '2026-05-13 09:34:24', NULL),
(8, 'Amber Court Care Home', 'Kipling Driver, Blackpool, FY3 9UX', 'Delma Dela Cruz', 'manager.ambercourt@mmcg.co.uk', '01253923472', '2026-05-24 03:30:43', '2026-05-24 03:30:43', NULL),
(9, 'Richmond House Care Home', 'Mitchell Street, Leigh, WN7 4UH', 'Lorraine Scholey', 'richmondhouse.leight@nhs.net', '03339998607', '2026-05-24 15:16:33', '2026-05-24 15:16:33', NULL),
(10, 'Greenacres', 'Green Lane, Standish, Wigan, WN6 0TS', 'Sheila', 'manager.greenacres@minstercaregroup.co.uk', '01257421860', '2026-05-25 02:17:48', '2026-05-25 02:17:48', NULL),
(11, 'Lytham Grange', '670-672 Lytham Road, Blackpool, FY4 1RG', 'Kelly', 'lythamgrange.manager@arh.group', '01253531797', '2026-05-26 04:14:05', '2026-05-26 04:14:05', NULL),
(12, 'Belgravia care home', '406 Promenade, Blackpool, FY1 2LB', 'Pagan Louise horton', 'pagan.squibb@lillibehealthcare.co.uk', '01253595567', '2026-06-01 12:36:36', '2026-06-01 12:36:36', NULL),
(13, 'Ann Challis Eventide Home', '128 Stretford Rd, Urmston, Manchester, M41 9LT', 'Kirsty Lawson', 'annchallishome@googlemail.com', '01617483597', '2026-06-02 02:27:16', '2026-06-02 02:27:16', NULL),
(14, 'Lady Of The Vale', 'Grange Rd, Bowdon Vale, Bowdon, Altrincham, WA14 3HA', 'Godfrey Taderera', 'admin@ladyofthevale.org.uk', '0161 9282567', '2026-06-02 02:31:08', '2026-06-02 02:31:08', NULL),
(15, 'Jakeem Kidd', 'Natus sed modi quaer', 'Sonia Hart', 'xocopuve@mailinator.com', '+1 (376) 599-8081', '2026-06-03 08:07:30', '2026-06-03 08:07:30', NULL);

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
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `care_home_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `care_home_id`, `sender_id`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(15, 7, 5, 'Checking to see it work', 1, '2026-05-13 10:09:36', '2026-06-02 19:56:50'),
(16, 7, 5, 'Checking to see it work', 1, '2026-05-13 10:09:38', '2026-06-02 19:56:50'),
(39, 7, 1, 'hey', 1, '2026-05-20 15:43:52', '2026-05-22 15:21:51'),
(40, 9, 1, 'Hey Dean, got all the request through, on it with the eye care and I\'ll get back son regarding eye test dates.', 0, '2026-05-29 16:12:51', '2026-05-29 16:12:51'),
(41, 9, 1, 'regarding Constance Dolan Hearcare, what is the resident after exactly so I can pass it to the right department? Ear wax removal? or after Hearing aids?', 0, '2026-05-29 16:13:58', '2026-05-29 16:13:58'),
(42, 9, 1, 'Regarding the Eye tests I can come out Wednesday 03/06 10am- if this works with you?', 0, '2026-05-29 16:35:06', '2026-05-29 16:35:06');

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
(1, '2024_01_01_000000_create_care_homes_table', 1),
(2, '2024_01_01_000001_create_users_table', 1),
(3, '2024_01_01_000003_create_residents_table', 1),
(4, '2024_01_01_000004_create_service_requests_table', 1),
(5, '2024_01_01_000005_create_messages_table', 1),
(6, '0001_01_01_000001_create_cache_table', 2),
(7, '0001_01_01_000002_create_jobs_table', 2),
(8, '2026_04_13_200333_create_sessions_table', 3),
(9, '2026_04_14_000001_create_service_request_reports_table', 4),
(10, '2026_04_16_000001_add_is_active_to_users_table', 5),
(11, '2026_04_16_000002_add_phone_address_to_users_table', 6),
(12, '2026_04_21_131307_create_resident_documents_table', 7),
(13, '2026_04_30_124011_add_username_to_users_table', 8),
(14, '2026_04_21_142352_create_resident_documents_table', 9),
(15, '2026_04_27_130609_add_is_admin_to_users_table', 9),
(16, '2026_06_03_115806_create_permission_tables', 9),
(17, '2026_06_03_115808_create_activity_log_table', 9),
(18, '2026_06_03_115809_add_event_column_to_activity_log_table', 9),
(19, '2026_06_03_115810_add_batch_uuid_column_to_activity_log_table', 9),
(20, '2026_06_03_115857_add_soft_deletes_to_users_table', 9),
(21, '2026_06_03_115858_add_soft_deletes_to_residents_table', 9),
(22, '2026_06_03_115859_add_soft_deletes_to_care_homes_table', 9),
(23, '2026_06_03_115900_add_soft_deletes_to_resident_documents_table', 9),
(24, '2026_06_03_132736_add_uploaded_by_to_resident_documents_table', 10),
(25, '2026_06_03_154720_add_soft_deletes_to_service_request_reports_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `care_home_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `funding_status` varchar(255) DEFAULT NULL,
  `last_eye_test` date DEFAULT NULL,
  `next_recall_date` date DEFAULT NULL,
  `status` enum('ok','due','overdue') NOT NULL DEFAULT 'ok',
  `notes` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `care_home_id`, `first_name`, `last_name`, `dob`, `funding_status`, `last_eye_test`, `next_recall_date`, `status`, `notes`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 7, 'Demo', 'One', '1950-09-13', 'Funded', '2025-03-13', NULL, 'ok', NULL, 1, '2026-05-13 09:35:20', '2026-05-13 09:35:20', NULL),
(13, 7, 'Demo', 'Two', '1917-06-13', 'Private', '2026-05-14', '2027-05-14', 'ok', NULL, 1, '2026-05-13 09:35:55', '2026-05-15 12:31:51', NULL),
(14, 7, 'Demo', 'Three', '1955-07-23', 'Funded', '2003-03-13', '2026-03-15', 'overdue', NULL, 1, '2026-05-13 09:37:00', '2026-05-13 09:37:00', NULL),
(15, 7, 'Demo', 'Four', '1959-09-24', 'Funded', '2026-01-13', NULL, 'ok', NULL, 1, '2026-05-13 09:37:34', '2026-05-13 09:37:34', NULL),
(16, 7, 'Demo', 'Five', '1954-04-22', 'Funded', '2025-05-12', '2026-05-12', 'overdue', 'This px is amazing', 1, '2026-05-13 09:41:31', '2026-05-13 09:41:31', NULL),
(17, 7, 'Demo', 'Six', '1967-02-28', 'Funded', '2025-05-17', '2026-05-17', 'due', 'Registered blind', 1, '2026-05-13 09:45:14', '2026-05-13 09:45:14', NULL),
(18, 7, 'Demo', 'Six', '1967-02-28', 'Funded', '2025-05-17', '2026-05-17', 'due', 'Registered blind', 1, '2026-05-13 09:45:16', '2026-05-13 09:45:16', NULL),
(19, 8, 'Scott', 'Thorpe', '1978-05-28', 'Funded', '2025-02-13', '2027-02-13', 'ok', NULL, 1, '2026-05-24 03:33:11', '2026-05-24 03:33:11', NULL),
(20, 8, 'Lynda', 'Johnson', '1947-10-19', 'Funded', '2025-11-13', '2026-11-13', 'ok', NULL, 1, '2026-05-24 03:34:09', '2026-05-24 03:34:09', NULL),
(21, 8, 'Nancy', 'Judge', '1942-03-01', 'Funded', '2025-04-27', '2026-04-27', 'overdue', NULL, 1, '2026-05-24 03:35:57', '2026-05-24 03:35:57', NULL),
(22, 8, 'Daniel', 'McCord', '1989-02-03', 'Funded', '2026-05-27', '2027-05-27', 'ok', NULL, 1, '2026-05-24 03:37:31', '2026-05-28 01:54:05', NULL),
(23, 8, 'Joan', 'Watson', '1932-11-13', 'Funded', '2026-05-27', '2027-05-27', 'ok', NULL, 1, '2026-05-24 23:36:10', '2026-05-28 01:48:03', NULL),
(24, 8, 'Alan', 'Frost', '1954-04-29', 'Funded', '2026-05-27', '2027-05-27', 'ok', NULL, 1, '2026-05-24 23:41:05', '2026-05-28 01:51:19', NULL),
(25, 8, 'Julia', 'Brownwood', '1950-07-05', 'Funded', '2025-11-21', '2026-11-21', 'ok', NULL, 1, '2026-05-24 23:42:59', '2026-05-24 23:42:59', NULL),
(27, 8, 'Francis', 'Turner', '1936-11-02', 'Funded', '2026-05-27', '2027-05-27', 'ok', NULL, 1, '2026-05-24 23:50:07', '2026-05-28 01:54:54', NULL),
(28, 8, 'James', 'Jones', '1954-02-08', 'Funded', '2025-11-13', '2026-11-13', 'ok', NULL, 1, '2026-05-24 23:52:10', '2026-05-24 23:52:10', NULL),
(29, 8, 'Paula', 'Sage', '1966-05-30', 'Funded', '2026-05-27', '2027-05-27', 'ok', NULL, 1, '2026-05-25 00:01:07', '2026-05-28 01:53:10', NULL),
(30, 8, 'John', 'Murray', '1969-08-15', 'Funded', '2025-02-13', '2027-02-13', 'ok', NULL, 1, '2026-05-25 00:03:48', '2026-05-25 00:03:48', NULL),
(31, 8, 'Susan', 'Holmes', '1957-09-06', 'Funded', '2026-05-27', '2027-05-27', 'ok', NULL, 1, '2026-05-25 00:07:52', '2026-05-28 01:52:21', NULL),
(32, 8, 'Lena', 'Emery', '1951-03-11', 'Funded', '2026-05-09', '2027-05-09', 'ok', NULL, 1, '2026-05-25 00:10:08', '2026-05-25 00:10:08', NULL),
(33, 8, 'Stephen', 'Levelle', '1961-07-20', 'Funded', '2025-04-27', '2026-04-27', 'overdue', NULL, 1, '2026-05-25 00:13:25', '2026-05-25 00:13:25', NULL),
(34, 8, 'Christine', 'Coup', '1937-10-30', 'Funded', '2025-04-20', '2026-04-20', 'overdue', 'not well on 27/05/26- test in future', 1, '2026-05-25 00:15:02', '2026-05-28 02:00:30', NULL),
(36, 8, 'Wendy', 'Sage', '1943-03-26', 'Funded', '2026-05-27', '2027-05-27', 'ok', NULL, 1, '2026-05-25 00:25:17', '2026-05-28 01:50:21', NULL),
(37, 8, 'Kolawole', 'Olomayoma', '1982-04-03', 'Funded', '2026-05-28', '2027-05-28', 'ok', NULL, 1, '2026-05-25 00:28:08', '2026-05-30 04:16:20', NULL),
(38, 8, 'Audery', 'Brookes', '1938-12-03', 'Funded', '2026-05-28', '2027-05-28', 'ok', NULL, 1, '2026-05-25 00:31:29', '2026-05-30 04:19:24', NULL),
(39, 8, 'Albert', 'Taylor', '1928-03-31', 'Private', '2026-05-28', '2027-05-28', 'ok', NULL, 1, '2026-05-25 00:33:14', '2026-05-30 04:20:43', NULL),
(40, 8, 'James', 'Halliday', '1960-08-18', 'Funded', '2026-05-28', '2027-05-28', 'ok', NULL, 1, '2026-05-25 00:35:25', '2026-05-30 04:17:02', NULL),
(41, 8, 'Brian', 'Dennese', '1936-05-23', 'Funded', '2026-05-28', '2027-05-28', 'ok', NULL, 1, '2026-05-25 00:38:22', '2026-05-30 04:22:02', NULL),
(42, 8, 'Joan', 'Greenwood', '1940-02-28', 'Funded', '2026-05-28', '2027-05-28', 'ok', NULL, 1, '2026-05-25 00:40:38', '2026-05-30 04:18:37', NULL),
(44, 8, 'Winifred', 'Lawton', '1933-08-13', 'Funded', '2026-05-28', '2027-05-28', 'ok', NULL, 1, '2026-05-25 00:46:44', '2026-05-30 04:17:54', NULL),
(45, 8, 'Margarette', 'Murphy', '1931-03-29', 'Private', '2026-05-28', '2027-05-28', 'ok', NULL, 1, '2026-05-25 00:48:31', '2026-05-30 04:15:34', NULL),
(47, 8, 'Carol', 'Owen', '1957-12-02', 'Funded', '2026-05-28', '2027-05-28', 'ok', NULL, 1, '2026-05-25 00:53:41', '2026-05-30 04:21:18', NULL),
(48, 8, 'Joan', 'Shackleton', '1932-01-13', 'Funded', '2025-10-15', '2026-10-15', 'ok', NULL, 1, '2026-05-25 00:56:10', '2026-05-25 00:56:10', NULL),
(50, 8, 'Edward', 'Prezner', '1936-07-17', 'Funded', '2026-05-28', '2027-05-28', 'ok', NULL, 1, '2026-05-25 01:08:36', '2026-05-30 04:13:55', NULL),
(51, 8, 'Beryl', 'Harris', '1933-04-06', 'Funded', '2025-09-25', '2026-09-25', 'ok', NULL, 1, '2026-05-25 01:09:31', '2026-05-25 01:09:31', NULL),
(52, 9, 'John Terry', 'Case', '1942-04-05', 'Funded', '2025-05-29', '2026-05-29', 'due', NULL, 1, '2026-05-25 01:45:46', '2026-05-25 02:08:04', NULL),
(53, 9, 'Ann Patricia', 'Chapman', '1942-01-18', 'Funded', '2025-05-29', '2026-05-29', 'due', NULL, 1, '2026-05-25 01:48:44', '2026-05-25 02:07:18', NULL),
(54, 9, 'Catherine', 'Jones', '1945-10-05', 'Funded', '2025-07-28', '2026-07-28', 'ok', NULL, 1, '2026-05-25 02:06:22', '2026-05-25 02:06:22', NULL),
(55, 9, 'John Eirwyn', 'Jones', '1944-03-14', 'Funded', '2026-04-23', '2027-04-23', 'ok', NULL, 1, '2026-05-25 02:10:27', '2026-05-25 02:10:27', NULL),
(56, 9, 'Peter', 'Marsh', '1949-11-23', 'Funded', '2026-04-22', '2027-04-22', 'ok', NULL, 1, '2026-05-25 02:12:01', '2026-05-25 02:12:01', NULL),
(57, 9, 'Karen Elizabeth', 'Pendlebury', '1958-06-25', 'Funded', '2026-04-22', '2027-04-22', 'ok', NULL, 1, '2026-05-25 02:14:02', '2026-05-26 04:36:54', NULL),
(58, 9, 'Harold', 'Postlewaite', '1942-12-09', 'Funded', '2026-01-07', '2027-01-07', 'ok', NULL, 1, '2026-05-25 02:24:08', '2026-05-25 02:24:08', NULL),
(59, 9, 'Ann', 'Smith', '1947-10-26', 'Funded', '2025-06-11', '2026-06-11', 'due', NULL, 1, '2026-05-25 02:25:56', '2026-05-25 02:25:56', NULL),
(60, 9, 'Jean', 'Stott', '1936-07-20', 'Funded', '2026-04-22', '2027-04-22', 'ok', NULL, 1, '2026-05-25 02:29:01', '2026-05-28 17:36:45', NULL),
(62, 9, 'Lillian', 'Winstanley', '1946-04-09', 'Funded', '2025-05-29', '2026-05-29', 'due', NULL, 1, '2026-05-25 02:35:57', '2026-05-25 02:35:57', NULL),
(63, 9, 'James', 'Allen', '1946-06-11', 'Funded', '2025-06-25', '2026-06-25', 'ok', NULL, 1, '2026-05-25 02:40:26', '2026-05-25 02:40:26', NULL),
(64, 9, 'Kathleen', 'Boffey', '1947-02-03', 'Funded', '2025-05-20', '2026-05-20', 'overdue', NULL, 1, '2026-05-25 02:43:17', '2026-05-25 02:43:17', NULL),
(65, 9, 'Doris', 'Chesworth', '1928-10-17', 'Funded', '2026-04-22', '2027-04-22', 'ok', NULL, 1, '2026-05-25 02:48:35', '2026-05-25 02:48:35', NULL),
(66, 9, 'Graham', 'Dickinson', '1922-05-23', 'Funded', '2026-05-02', '2027-05-02', 'ok', NULL, 1, '2026-05-25 02:54:45', '2026-05-26 04:40:14', NULL),
(68, 9, 'Neil', 'Dugdale', '1943-07-27', 'Funded', '2025-06-11', '2026-06-11', 'due', NULL, 1, '2026-05-25 03:10:28', '2026-05-28 17:41:18', NULL),
(69, 9, 'Ann', 'Gilroy', '1947-03-13', 'Funded', '2025-06-25', '2026-06-25', 'ok', NULL, 1, '2026-05-25 03:12:44', '2026-05-25 03:12:44', NULL),
(71, 9, 'Sheila', 'Johnstone', '1943-10-17', 'Funded', '2026-04-22', '2027-04-22', 'ok', NULL, 1, '2026-05-25 03:17:23', '2026-05-25 03:17:23', NULL),
(73, 9, 'Patricia', 'Malone', '1942-02-13', 'Funded', '2026-04-22', '2027-04-22', 'ok', NULL, 1, '2026-05-25 03:31:17', '2026-05-26 16:23:16', NULL),
(74, 9, 'Dorothy May', 'McGrath', '1933-03-16', 'Funded', '2025-05-29', '2026-06-29', 'ok', NULL, 1, '2026-05-25 03:44:44', '2026-05-25 03:44:44', NULL),
(75, 9, 'Raymond', 'Nicholas', '1945-01-25', 'Funded', '2026-02-25', '2027-02-25', 'ok', NULL, 1, '2026-05-25 03:48:01', '2026-05-26 16:22:53', NULL),
(76, 9, 'Phyllis', 'Pendlebury', '1931-01-11', 'Funded', '2025-06-25', '2026-06-25', 'ok', NULL, 1, '2026-05-25 03:49:19', '2026-05-25 03:49:19', NULL),
(77, 9, 'Garald', 'Price', '1942-03-12', 'Funded', '2025-06-25', '2026-06-25', 'ok', NULL, 1, '2026-05-25 03:51:51', '2026-05-25 03:51:51', NULL),
(78, 9, 'Austin', 'Radford', '1979-10-14', 'Funded', '2025-06-25', '2026-06-25', 'ok', NULL, 1, '2026-05-25 03:53:11', '2026-05-25 03:53:11', NULL),
(79, 9, 'Stuart', 'Shea', '1947-06-28', 'Funded', '2025-06-11', '2026-06-11', 'due', NULL, 1, '2026-05-25 03:54:11', '2026-05-25 03:54:11', NULL),
(80, 9, 'Anthony', 'Sheperd', '1936-08-22', 'Funded', '2025-06-25', '2026-06-25', 'ok', NULL, 1, '2026-05-25 03:55:16', '2026-05-25 03:55:16', NULL),
(81, 9, 'Harry', 'Smith', '1932-04-28', 'Funded', '2025-06-25', '2026-06-25', 'ok', NULL, 1, '2026-05-25 03:56:16', '2026-05-25 03:56:16', NULL),
(82, 9, 'Joan', 'Smith', '1937-09-12', 'Funded', '2025-06-11', '2026-06-11', 'due', NULL, 1, '2026-05-25 03:57:10', '2026-05-26 16:21:38', NULL),
(83, 9, 'Kelly', 'Smith', '1978-09-30', 'Funded', '2026-04-22', '2027-04-22', 'ok', NULL, 1, '2026-05-25 03:58:12', '2026-05-26 16:21:09', NULL),
(84, 9, 'Patricia Pearl', 'Snowden', '1942-03-25', 'Funded', '2026-04-22', '2027-04-22', 'ok', NULL, 1, '2026-05-25 04:00:11', '2026-05-25 04:00:11', NULL),
(85, 9, 'David', 'Tomlinson', '1960-07-09', 'Funded', '2025-07-17', '2026-07-17', 'ok', NULL, 1, '2026-05-25 04:01:06', '2026-05-25 04:01:06', NULL),
(86, 9, 'Jeanette', 'Young', '1936-12-08', 'Funded', '2025-06-25', '2026-06-25', 'ok', NULL, 1, '2026-05-25 04:03:22', '2026-05-25 04:03:22', NULL),
(87, 10, 'Geraldine', 'Tanner', '1950-04-05', 'Funded', '2025-04-15', '2026-04-15', 'overdue', NULL, 1, '2026-05-25 04:24:44', '2026-05-25 04:24:44', NULL),
(88, 10, 'Irene', 'Callaghan', '1927-06-03', 'Funded', '2025-04-15', '2026-04-15', 'overdue', NULL, 1, '2026-05-25 04:25:58', '2026-05-25 04:25:58', NULL),
(89, 10, 'Joyce', 'Morris', '1938-07-17', 'Funded', '2025-04-20', '2026-04-20', 'overdue', NULL, 1, '2026-05-25 04:26:59', '2026-05-25 04:26:59', NULL),
(90, 10, 'Teresa', 'Harris', '1935-03-27', 'Private', '2025-04-20', '2026-04-20', 'overdue', NULL, 1, '2026-05-25 04:28:08', '2026-05-25 05:20:28', NULL),
(91, 10, 'June', 'Jones', '1927-01-09', 'Private', '2025-04-25', '2026-04-25', 'overdue', NULL, 1, '2026-05-25 04:29:24', '2026-05-25 05:19:51', NULL),
(92, 10, 'Pat', 'Gallear', '1938-08-28', 'Funded', '2025-04-20', '2026-04-20', 'overdue', NULL, 1, '2026-05-25 04:30:40', '2026-05-25 04:30:40', NULL),
(93, 10, 'Ellen', 'Hickson', '1947-11-25', 'Funded', '2025-04-26', '2026-04-26', 'overdue', NULL, 1, '2026-05-25 04:31:41', '2026-05-25 04:31:41', NULL),
(94, 10, 'Doris', 'Bradburn', '1936-11-21', 'Private', '2025-04-28', '2026-04-28', 'overdue', NULL, 1, '2026-05-25 04:32:46', '2026-05-25 05:19:00', NULL),
(95, 10, 'Mrs Doreen', 'Chadwick', '1939-03-04', 'Funded', '2025-04-28', '2026-04-28', 'overdue', NULL, 1, '2026-05-25 04:33:55', '2026-05-25 04:33:55', NULL),
(96, 10, 'Margaret', 'Readett', '1932-10-29', 'Funded', '2025-04-01', '2026-04-01', 'overdue', NULL, 1, '2026-05-25 04:36:00', '2026-05-25 05:01:54', NULL),
(97, 10, 'Mary', 'Slott', '1933-09-13', 'Funded', '2026-05-08', '2027-05-08', 'ok', NULL, 1, '2026-05-25 04:37:18', '2026-05-25 04:37:18', NULL),
(98, 10, 'Elizabeth', 'Fiddler', '1935-05-21', 'Funded', '2025-04-20', '2026-04-20', 'overdue', NULL, 1, '2026-05-25 04:38:25', '2026-05-25 04:38:25', NULL),
(99, 10, 'Eileen', 'Hollinshead', '1941-05-21', 'Funded', '2025-04-22', '2026-04-22', 'overdue', NULL, 1, '2026-05-25 04:39:33', '2026-05-25 04:39:33', NULL),
(101, 10, 'Joyce', 'Boyers', '1933-03-04', 'Funded', '2025-04-25', '2026-04-25', 'overdue', NULL, 1, '2026-05-25 04:42:21', '2026-05-25 04:42:21', NULL),
(102, 10, 'Eileen', 'McAllister', '1934-05-06', 'Funded', '2025-04-25', '2026-04-25', 'overdue', NULL, 1, '2026-05-25 04:43:38', '2026-05-25 04:43:38', NULL),
(103, 10, 'Ann', 'Jolley', '1957-02-25', 'Private', '2025-04-30', '2026-04-30', 'overdue', NULL, 1, '2026-05-25 04:44:41', '2026-05-25 05:18:11', NULL),
(104, 10, 'Geoff', 'Dawber', '1945-05-30', 'Funded', '2026-05-08', '2027-05-08', 'ok', NULL, 1, '2026-05-25 04:45:56', '2026-05-25 04:45:56', NULL),
(105, 10, 'John Jack', 'Stubbs', '1929-10-18', 'Private', '2025-05-01', '2026-05-01', 'overdue', NULL, 1, '2026-05-25 04:47:12', '2026-05-25 05:17:27', NULL),
(106, 10, 'Valerie', 'Saunders', '1944-10-18', 'Funded', '2025-05-01', '2026-05-01', 'overdue', NULL, 1, '2026-05-25 04:48:27', '2026-05-25 05:00:25', NULL),
(107, 10, 'Christine', 'Huyton', '1957-02-27', 'Funded', '2026-05-08', '2027-05-08', 'ok', NULL, 1, '2026-05-25 04:49:41', '2026-05-25 04:49:41', NULL),
(108, 10, 'Wendy', 'Halliwell', '1937-10-02', 'Funded', '2025-09-25', '2026-09-25', 'ok', NULL, 1, '2026-05-25 04:50:58', '2026-05-25 04:50:58', NULL),
(109, 10, 'Andrea', 'Dewhurst', '1940-07-04', 'Funded', '2025-04-29', '2026-04-29', 'overdue', NULL, 1, '2026-05-25 04:52:12', '2026-05-25 04:52:12', NULL),
(110, 10, 'Brenda', 'Aspinall', '1948-03-11', 'Funded', '2025-04-25', '2026-04-25', 'overdue', NULL, 1, '2026-05-25 04:53:36', '2026-05-25 04:53:36', NULL),
(111, 10, 'Robert', 'Howard', '1933-08-30', 'Funded', '2026-05-08', '2027-05-08', 'ok', NULL, 1, '2026-05-25 04:54:46', '2026-05-25 04:54:46', NULL),
(112, 10, 'Gladys', 'Harrison', '1939-05-24', 'Funded', '2025-04-25', '2026-04-25', 'overdue', NULL, 1, '2026-05-25 04:55:58', '2026-05-25 04:55:58', NULL),
(113, 10, 'Jean', 'Smith', '1938-12-10', 'Funded', '2025-09-25', '2026-09-25', 'ok', NULL, 1, '2026-05-25 04:57:02', '2026-05-25 04:57:02', NULL),
(114, 10, 'Frank', 'Mcloughlin', '1933-03-07', 'Funded', '2025-05-01', '2025-05-01', 'overdue', NULL, 1, '2026-05-25 04:58:28', '2026-05-25 04:58:28', NULL),
(115, 10, 'Elizabeth', 'winstenley', '1935-06-01', 'Funded', '2026-05-08', '2027-05-08', 'ok', NULL, 1, '2026-05-25 04:59:57', '2026-05-25 05:04:23', NULL),
(116, 10, 'Elizabeth', 'Binns', '1942-01-01', 'Funded', '2026-06-08', '2027-06-08', 'ok', NULL, 1, '2026-05-25 05:03:06', '2026-05-25 05:05:11', NULL),
(117, 10, 'Brenda', 'Sharples', '1942-02-13', 'Private', '2025-04-30', '2026-04-30', 'overdue', NULL, 1, '2026-05-25 05:06:35', '2026-05-25 05:16:59', NULL),
(118, 10, 'Mr Donald', 'McAllister', '1951-06-07', 'Funded', '2025-04-30', '2026-04-30', 'overdue', NULL, 1, '2026-05-25 05:07:47', '2026-05-25 05:07:47', NULL),
(119, 10, 'Mrs Olive', 'White', '1937-11-22', 'Funded', '2025-04-30', '2026-04-30', 'overdue', NULL, 1, '2026-05-25 05:09:07', '2026-05-25 05:09:07', NULL),
(120, 10, 'Joan', 'Duncan', '1936-12-09', 'Funded', '2025-04-25', '2026-04-25', 'overdue', NULL, 1, '2026-05-25 05:10:04', '2026-05-25 05:10:04', NULL),
(121, 10, 'Gary', 'Stone', '1967-08-25', 'Funded', '2025-04-27', '2026-04-27', 'overdue', NULL, 1, '2026-05-25 05:11:35', '2026-05-26 19:25:36', NULL),
(122, 10, 'Muareen', 'Blythman', '1947-06-09', 'Private', '2026-05-08', '2027-05-08', 'ok', NULL, 1, '2026-05-25 05:12:50', '2026-05-25 05:16:25', NULL),
(123, 10, 'Bill', 'Smith', '1939-09-26', 'Private', '2025-05-01', '2026-05-01', 'overdue', NULL, 1, '2026-05-25 05:13:53', '2026-05-25 05:15:56', NULL),
(124, 10, 'Beatrice', 'Speed', '1929-09-19', 'Funded', '2025-05-01', '2026-05-01', 'overdue', NULL, 1, '2026-05-25 05:15:10', '2026-05-25 05:15:10', NULL),
(125, 11, 'John', 'Carter', '1927-06-14', 'Funded', '2025-04-26', '2026-04-26', 'overdue', NULL, 1, '2026-05-26 04:18:54', '2026-05-26 04:18:54', NULL),
(126, 11, 'Doreen', 'Brewer', '1944-05-12', 'Funded', '2025-12-01', '2026-12-01', 'ok', NULL, 1, '2026-05-26 04:20:37', '2026-05-26 04:20:37', NULL),
(127, 11, 'Shirley', 'Davenport', '1941-04-15', 'Funded', '2026-05-18', '2027-05-18', 'ok', NULL, 1, '2026-05-26 04:23:26', '2026-05-26 04:23:26', NULL),
(128, 11, 'Joseph', 'McNulty', '1939-02-28', 'Funded', '2025-12-01', '2026-12-01', 'ok', NULL, 1, '2026-05-26 04:24:52', '2026-05-26 04:24:52', NULL),
(129, 11, 'Brian', 'Overett', '1940-01-19', 'Funded', '2025-07-24', '2026-07-24', 'ok', NULL, 1, '2026-05-26 04:26:32', '2026-05-26 04:26:32', NULL),
(130, 11, 'Betty', 'Hobson', '1928-04-06', 'Funded', '2025-05-10', '2026-05-10', 'overdue', NULL, 1, '2026-05-26 04:28:09', '2026-05-26 04:28:09', NULL),
(131, 11, 'Elinore', 'Wilson', '1942-03-17', 'Funded', '2025-05-10', '2026-05-10', 'overdue', NULL, 1, '2026-05-26 04:29:21', '2026-05-26 04:29:21', NULL),
(132, 11, 'Peter', 'Lees', '1968-09-28', 'Funded', '2025-07-24', '2026-07-24', 'ok', NULL, 1, '2026-05-26 04:30:48', '2026-05-26 04:30:48', NULL),
(133, 11, 'Patricia', 'Blackwell', '1936-04-20', 'Funded', '2025-12-01', '2026-12-01', 'ok', NULL, 1, '2026-05-26 04:32:41', '2026-05-26 04:32:41', NULL),
(134, 11, 'Elaine', 'Butler', '1945-06-03', 'Funded', '2025-04-10', '2026-04-10', 'overdue', NULL, 1, '2026-05-26 04:33:54', '2026-05-26 04:33:54', NULL),
(135, 11, 'Anthony', 'Blakeman', '1945-08-30', 'Funded', '2025-05-08', '2026-05-08', 'overdue', NULL, 1, '2026-05-26 04:34:52', '2026-05-26 04:34:52', NULL),
(136, 11, 'Kathleen', 'Perfect', '1939-01-27', 'Funded', '2026-05-18', '2027-05-18', 'ok', NULL, 1, '2026-05-26 04:36:14', '2026-05-26 04:36:14', NULL),
(137, 11, 'Edna', 'Purvis', '1936-04-30', 'Funded', '2025-05-10', '2026-05-10', 'overdue', NULL, 1, '2026-05-26 04:37:14', '2026-05-26 04:37:14', NULL),
(138, 11, 'Louise Ann', 'Collins', '1964-12-20', 'Funded', '2025-10-06', '2026-10-06', 'ok', NULL, 1, '2026-05-26 04:38:37', '2026-05-26 04:38:37', NULL),
(139, 11, 'Mohamed', 'Hameed', '1939-01-14', 'Funded', '2025-05-10', '2026-05-10', 'overdue', NULL, 1, '2026-05-26 04:39:56', '2026-05-26 04:39:56', NULL),
(140, 11, 'Marjorie', 'Richardson', '1925-08-05', 'Funded', '2025-10-06', '2026-10-06', 'ok', NULL, 1, '2026-05-26 04:41:36', '2026-05-26 04:41:36', NULL),
(141, 11, 'Beryl', 'Fishwick', '1936-01-04', 'Funded', '2026-05-18', '2027-05-18', 'ok', NULL, 1, '2026-05-26 04:42:59', '2026-05-26 04:42:59', NULL),
(142, 11, 'Phyllis', 'Lamont', '1935-10-12', 'Funded', '2025-05-11', '2026-05-11', 'overdue', NULL, 1, '2026-05-26 04:44:37', '2026-05-26 04:44:37', NULL),
(143, 11, 'Albert', 'Hickling', '1944-06-04', 'Funded', '2025-05-11', '2026-05-11', 'overdue', NULL, 1, '2026-05-26 04:45:38', '2026-05-26 04:45:38', NULL),
(144, 11, 'Margaret', 'Royal', '1940-08-25', 'Funded', '2025-12-01', '2026-12-01', 'ok', NULL, 1, '2026-05-26 04:46:46', '2026-05-26 04:46:46', NULL),
(145, 11, 'Jaffery', 'Meadows', '1947-02-01', 'Funded', '2025-05-11', '2026-05-11', 'overdue', NULL, 1, '2026-05-26 04:47:43', '2026-05-26 04:47:43', NULL),
(146, 11, 'Eileen', 'Lomax', '1947-10-15', 'Funded', '2025-05-01', '2026-05-01', 'overdue', NULL, 1, '2026-05-26 04:48:45', '2026-05-26 04:48:45', NULL),
(147, 11, 'Evelyn', 'Campbell', '1937-06-27', 'Funded', '2025-04-20', '2026-04-20', 'overdue', NULL, 1, '2026-05-26 04:50:14', '2026-05-26 04:50:14', NULL),
(148, 11, 'Carol', 'Helm', '1943-05-27', 'Funded', '2026-05-18', '2027-05-18', 'ok', NULL, 1, '2026-05-26 04:51:20', '2026-05-26 04:52:04', NULL),
(149, 11, 'John', 'Margison', '1945-03-12', 'Funded', '2025-12-01', '2026-12-01', 'ok', NULL, 1, '2026-05-26 04:53:16', '2026-05-26 04:53:16', NULL),
(150, 11, 'Pauline', 'Talbot', '1935-07-15', 'Funded', '2025-04-11', '2026-04-11', 'overdue', NULL, 1, '2026-05-26 04:54:20', '2026-05-26 04:54:20', NULL),
(151, 11, 'Ron', 'Parry', '1939-03-14', 'Funded', '2025-05-11', '2026-05-11', 'overdue', NULL, 1, '2026-05-26 04:55:09', '2026-05-26 04:55:09', NULL),
(152, 11, 'Frances', 'Allen', '1959-09-29', 'Funded', '2025-05-11', '2026-05-11', 'overdue', NULL, 1, '2026-05-26 04:56:18', '2026-05-26 04:56:18', NULL),
(154, 8, 'Daniel', 'Clarke', '1983-09-18', 'Funded', '2026-05-28', '2027-05-28', 'ok', NULL, 1, '2026-05-27 02:06:34', '2026-06-02 02:15:44', NULL),
(155, 8, 'Yvonne', 'Keen', '1946-09-23', 'Funded', '2026-05-27', '2027-05-27', 'ok', NULL, 1, '2026-05-28 01:57:51', '2026-05-28 01:59:40', NULL),
(156, 9, 'John', 'Smith', '1948-03-23', 'Private', NULL, NULL, 'ok', NULL, 1, '2026-05-28 17:42:31', '2026-05-28 17:42:31', NULL),
(157, 9, 'Margaret', 'Jones', '1941-09-05', 'Private', NULL, NULL, 'ok', NULL, 1, '2026-05-28 17:43:35', '2026-05-28 17:43:35', NULL),
(158, 9, 'Janet', 'Jackson', '1939-07-07', 'Funded', NULL, NULL, 'ok', NULL, 1, '2026-05-28 17:44:11', '2026-05-28 17:44:11', NULL),
(159, 9, 'Constance', 'Dolan', '1940-07-21', 'Funded', NULL, NULL, 'ok', NULL, 1, '2026-05-28 17:44:45', '2026-05-28 17:44:45', NULL),
(160, 12, 'Victoria', 'Wilson', '1985-10-16', 'Funded', '2025-06-30', '2026-06-30', 'due', NULL, 1, '2026-06-01 12:42:11', '2026-06-01 12:42:11', NULL),
(161, 12, 'Graham', 'Walker', '1975-08-21', 'Funded', '2025-10-15', '2026-10-15', 'ok', NULL, 1, '2026-06-01 12:43:27', '2026-06-01 12:43:27', NULL),
(162, 12, 'John', 'Buck', '1939-08-23', 'Funded', '2025-10-15', '2026-10-15', 'ok', NULL, 1, '2026-06-01 12:44:32', '2026-06-01 12:44:32', NULL),
(163, 12, 'Susan', 'Curtis', '1957-02-09', 'Funded', '2026-06-01', '2027-06-01', 'ok', NULL, 1, '2026-06-01 12:45:49', '2026-06-02 02:21:04', NULL),
(164, 12, 'Jaffery', 'Carlile', '1944-02-24', 'Funded', '2026-06-01', '2027-06-01', 'ok', NULL, 1, '2026-06-01 12:46:54', '2026-06-02 02:20:49', NULL),
(165, 12, 'Philip', 'Corallo', '1954-03-05', 'Funded', '0006-06-01', '2027-06-01', 'ok', NULL, 1, '2026-06-01 12:48:16', '2026-06-02 02:20:18', NULL),
(166, 12, 'Kathleen', 'Margaret', '1949-08-10', 'Funded', '2026-06-01', '2027-06-01', 'ok', NULL, 1, '2026-06-01 12:49:28', '2026-06-02 02:19:57', NULL),
(167, 12, 'Michael', 'Fielden', '1947-05-19', 'Funded', '2025-10-23', '2026-10-23', 'ok', NULL, 1, '2026-06-01 12:50:45', '2026-06-01 12:50:45', NULL),
(168, 12, 'James', 'Miller', '1952-12-06', 'Funded', '2025-10-23', '2026-10-23', 'ok', NULL, 1, '2026-06-01 12:52:14', '2026-06-01 12:52:14', NULL),
(169, 12, 'Donald', 'Sobey', '1956-11-01', 'Funded', '2026-06-01', '2027-06-01', 'ok', NULL, 1, '2026-06-01 12:53:22', '2026-06-02 02:19:27', NULL),
(170, 12, 'Cherill', 'Carpenter', '1956-10-19', 'Funded', '2025-10-23', '2026-10-23', 'ok', NULL, 1, '2026-06-01 12:54:30', '2026-06-01 12:54:30', NULL),
(171, 12, 'Jean', 'Ashworth', '1947-03-03', 'Funded', '2026-06-01', '2027-06-01', 'ok', NULL, 1, '2026-06-01 12:55:31', '2026-06-02 02:19:02', NULL),
(173, 12, 'John', 'Richardson', '1948-12-01', 'Funded', '2025-10-15', '2026-10-15', 'ok', NULL, 1, '2026-06-01 12:57:32', '2026-06-01 12:57:32', NULL),
(174, 12, 'Elaine', 'Faulker', '1950-11-09', 'Funded', '2025-10-23', '2026-10-23', 'ok', NULL, 1, '2026-06-01 12:58:47', '2026-06-01 12:58:47', NULL),
(175, 12, 'Mary', 'Eaton', '1951-03-02', 'Funded', '2025-10-23', '2026-10-23', 'ok', NULL, 1, '2026-06-01 13:00:09', '2026-06-01 13:00:09', NULL),
(176, 12, 'Warren', 'Fullard', '1963-04-14', 'Funded', '2025-10-15', '2026-10-15', 'ok', NULL, 1, '2026-06-01 13:01:00', '2026-06-01 13:01:00', NULL),
(177, 12, 'Mark', 'Cropper', '1955-06-20', 'Funded', '2025-10-23', '2026-10-23', 'ok', NULL, 1, '2026-06-01 13:01:57', '2026-06-01 13:01:57', NULL),
(178, 12, 'Margaret', 'Pope', '1949-08-22', 'Funded', '2025-10-15', '2026-10-15', 'ok', NULL, 1, '2026-06-01 13:02:57', '2026-06-01 13:02:57', NULL),
(179, 12, 'Judith', 'Blackledge', '1950-03-07', 'Funded', '2025-10-15', '2026-10-15', 'ok', NULL, 1, '2026-06-01 13:04:04', '2026-06-01 13:04:04', NULL),
(180, 12, 'Peter', 'Miller', '1963-05-17', 'Funded', '2025-10-15', '2026-10-15', 'ok', NULL, 1, '2026-06-01 13:05:26', '2026-06-01 13:05:26', NULL),
(181, 12, 'Jean', 'Davis', '1947-03-22', 'Funded', '2026-06-01', '2027-06-01', 'ok', NULL, 1, '2026-06-01 13:06:15', '2026-06-02 02:18:17', NULL),
(182, 12, 'Vivien', 'Collins', '1960-12-27', 'Funded', '2026-06-01', '2027-06-01', 'ok', NULL, 1, '2026-06-01 13:07:08', '2026-06-02 02:17:50', NULL),
(183, 12, 'Steven', 'Clough', '1956-04-04', 'Funded', '2026-06-01', '2027-06-01', 'ok', NULL, 1, '2026-06-01 13:07:55', '2026-06-02 02:17:26', NULL),
(184, 12, 'Roger', 'Preisner', '1945-10-02', 'Funded', '2025-10-15', '2026-10-15', 'ok', NULL, 1, '2026-06-01 13:08:59', '2026-06-01 13:08:59', NULL),
(185, 12, 'Phil', 'Walker', '1963-07-03', 'Funded', '2026-06-01', '2027-06-01', 'ok', NULL, 1, '2026-06-02 02:22:05', '2026-06-02 02:22:05', NULL),
(186, 12, 'Eileen', 'Andrew', '1936-05-06', 'Funded', '2026-06-01', '2027-06-01', 'ok', NULL, 1, '2026-06-02 02:22:57', '2026-06-02 02:22:57', NULL),
(187, 12, 'Terence', 'Deveney', '1941-09-01', 'Funded', '2026-06-01', '2027-06-01', 'ok', NULL, 1, '2026-06-02 02:23:46', '2026-06-02 02:23:46', NULL),
(188, 13, 'Ann', 'Donnan', '1936-05-16', 'Funded', '2026-02-27', '2027-02-27', 'ok', NULL, 1, '2026-06-02 02:37:57', '2026-06-02 02:37:57', NULL),
(189, 13, 'Margaret', 'Cassidy', '1944-11-13', 'Funded', '2025-05-01', '2026-05-01', 'overdue', NULL, 1, '2026-06-02 02:39:18', '2026-06-02 02:39:18', NULL),
(190, 13, 'Margaret', 'Brown', '1931-07-03', 'Funded', '2026-02-27', '2027-02-27', 'ok', NULL, 1, '2026-06-02 02:40:26', '2026-06-02 02:40:26', NULL),
(191, 13, 'Patricia', 'Mcphillips', '1942-04-01', 'Funded', '2025-05-01', '2026-05-01', 'overdue', NULL, 1, '2026-06-02 02:42:01', '2026-06-02 02:42:01', NULL),
(192, 13, 'Anne', 'Hickey', '1936-01-04', 'Funded', '2025-05-02', '2026-05-02', 'overdue', NULL, 1, '2026-06-02 02:43:41', '2026-06-02 02:43:41', NULL),
(193, 13, 'Marjorie', 'Templeton', '1940-12-15', 'Funded', '2026-05-02', '2027-05-02', 'ok', NULL, 1, '2026-06-02 02:46:41', '2026-06-02 02:46:41', NULL),
(194, 13, 'Sylvia', 'Kane', '1941-03-09', 'Funded', '2026-05-02', '2027-05-02', 'ok', NULL, 1, '2026-06-02 02:48:07', '2026-06-02 02:48:07', NULL),
(195, 13, 'Lesley', 'Barker', '1964-05-27', 'Funded', '2026-02-27', '2027-02-27', 'ok', NULL, 1, '2026-06-02 02:49:43', '2026-06-02 02:52:40', NULL),
(196, 13, 'Sheila', 'North', '1936-01-27', 'Funded', '2026-02-27', '2027-02-27', 'ok', NULL, 1, '2026-06-02 02:51:50', '2026-06-02 02:51:50', NULL),
(197, 13, 'Kate', 'Osborne', '1939-04-15', 'Funded', '2026-05-02', '2027-05-02', 'ok', NULL, 1, '2026-06-02 02:58:35', '2026-06-02 02:58:35', NULL),
(198, 13, 'Jacqueline', 'Marshall', '1946-03-21', 'Funded', '2025-05-02', '2026-05-02', 'overdue', NULL, 1, '2026-06-02 03:00:12', '2026-06-02 03:00:12', NULL),
(199, 13, 'Susan', 'Leah', '1948-09-23', 'Funded', '2025-12-12', '2026-12-12', 'ok', NULL, 1, '2026-06-02 03:02:01', '2026-06-02 03:02:01', NULL),
(200, 13, 'Shenna', 'Butler', '1944-04-11', 'Funded', '2025-05-05', '2026-05-05', 'overdue', NULL, 1, '2026-06-02 03:03:09', '2026-06-02 03:03:09', NULL),
(201, 13, 'Jean', 'Jones', '1939-01-07', 'Funded', '2026-05-02', '2027-05-02', 'ok', NULL, 1, '2026-06-02 03:04:57', '2026-06-02 03:04:57', NULL),
(202, 13, 'Christine', 'Mcguiheen', '1941-12-19', 'Funded', '2026-05-05', '2027-05-05', 'ok', NULL, 1, '2026-06-02 03:07:56', '2026-06-02 03:07:56', NULL),
(203, 13, 'Irene', 'Edwards', '1930-05-04', 'Funded', '2025-05-01', '2026-05-01', 'overdue', NULL, 1, '2026-06-02 03:09:00', '2026-06-02 03:09:00', NULL),
(204, 13, 'Kath', 'Burke', '1940-04-22', 'Funded', '2026-05-02', '2027-05-02', 'ok', NULL, 1, '2026-06-02 03:10:02', '2026-06-02 03:10:02', NULL),
(205, 13, 'Maureen', 'Lowther', '1945-10-04', 'Funded', '2025-05-01', '2026-05-01', 'overdue', NULL, 1, '2026-06-02 03:11:09', '2026-06-02 03:11:09', NULL),
(206, 13, 'Lorraine', 'Rowen', '1954-07-06', 'Funded', '2025-05-02', '2026-05-02', 'overdue', NULL, 1, '2026-06-02 03:12:35', '2026-06-02 03:12:35', NULL),
(207, 13, 'Martina', 'Nolan', '1970-01-16', 'Funded', '2026-05-02', '2027-05-02', 'ok', NULL, 1, '2026-06-02 03:14:47', '2026-06-02 03:14:47', NULL),
(208, 13, 'Olive', 'Golder', '1930-03-08', 'Funded', '2026-05-05', '2027-05-05', 'ok', NULL, 1, '2026-06-02 03:16:27', '2026-06-02 03:16:27', NULL),
(209, 13, 'Wynne', 'Bentey', '1938-11-28', 'Funded', '2025-05-05', '2026-05-05', 'overdue', NULL, 1, '2026-06-02 03:18:20', '2026-06-02 03:18:20', NULL),
(210, 13, 'Winy', 'Hill', '1922-07-09', 'Funded', '2025-05-05', '2026-05-05', 'overdue', NULL, 1, '2026-06-02 03:19:47', '2026-06-02 03:19:47', NULL),
(211, 8, 'Pamela', 'Kenyon', '1945-08-03', 'Funded', NULL, NULL, 'ok', 'new admission', 1, '2026-06-02 16:50:12', '2026-06-02 16:50:12', NULL),
(212, 8, 'Barrie Art', 'Mack', '1964-09-13', 'Funded', NULL, NULL, 'ok', 'new admission.', 1, '2026-06-02 16:56:06', '2026-06-02 16:56:06', NULL),
(213, 14, 'Margarita', 'Constant', '1928-12-10', 'Funded', '2025-08-20', '2026-08-20', 'ok', NULL, 1, '2026-06-02 19:38:55', '2026-06-02 19:38:55', NULL),
(214, 14, 'Anne', 'Maltby', '1944-07-20', 'Funded', '2025-11-03', '2026-11-03', 'ok', NULL, 1, '2026-06-02 19:40:08', '2026-06-02 19:40:08', NULL),
(215, 14, 'Anthony', 'Royle', '1941-08-11', 'Funded', '2025-08-20', '2026-08-20', 'ok', NULL, 1, '2026-06-02 19:41:15', '2026-06-02 19:41:15', NULL),
(216, 14, 'Elsa', 'Ewan', '1923-05-04', 'Funded', '2025-08-20', '2026-08-20', 'ok', NULL, 1, '2026-06-02 19:42:45', '2026-06-02 19:42:45', NULL),
(217, 14, 'Elizabeth', 'Anderson', '1947-08-27', 'Funded', '2025-08-20', '2026-08-20', 'ok', NULL, 1, '2026-06-02 19:44:29', '2026-06-02 19:44:29', NULL),
(218, 14, 'Josephine', 'Cupitt', '1946-07-24', 'Funded', '2025-05-02', '2026-05-02', 'overdue', NULL, 1, '2026-06-02 19:45:37', '2026-06-02 19:45:37', NULL),
(219, 14, 'Janet', 'Kenna', '1954-12-28', 'Funded', '2025-08-20', '2026-08-20', 'ok', NULL, 1, '2026-06-02 19:47:00', '2026-06-02 19:47:00', NULL),
(220, 14, 'Claire', 'Lancaster', '1935-08-13', 'Funded', '2025-08-20', '2026-08-20', 'ok', NULL, 1, '2026-06-02 19:48:03', '2026-06-02 19:48:03', NULL),
(221, 14, 'Victoria', 'Byrne', '1943-02-27', 'Funded', '2025-08-20', '2026-08-20', 'ok', NULL, 1, '2026-06-02 19:49:02', '2026-06-02 19:49:02', NULL),
(222, 14, 'Rita', 'Fryer', '1938-09-26', 'Funded', '2026-03-17', '2027-03-17', 'ok', NULL, 1, '2026-06-02 19:50:21', '2026-06-02 19:50:21', NULL),
(223, 14, 'Jane', 'Sanders', '1954-09-14', 'Funded', '2025-08-20', '2026-08-20', 'ok', NULL, 1, '2026-06-02 19:51:13', '2026-06-02 19:51:13', NULL),
(224, 14, 'Judith', 'Brunt', '1946-11-26', 'Funded', '2026-05-07', '2027-05-07', 'ok', NULL, 1, '2026-06-02 19:52:20', '2026-06-02 19:52:20', NULL),
(225, 14, 'Mary', 'Clark', '1933-03-18', 'Funded', '2025-05-02', '2026-05-02', 'overdue', NULL, 1, '2026-06-02 19:53:15', '2026-06-02 19:53:15', NULL),
(226, 14, 'Mary', 'Gill', '1933-03-06', 'Funded', '2026-03-17', '2027-03-17', 'ok', NULL, 1, '2026-06-02 19:54:03', '2026-06-02 19:54:03', NULL),
(227, 14, 'Dorothy', 'Chesters', '1930-02-26', 'Funded', '2025-08-27', '2026-08-27', 'ok', NULL, 1, '2026-06-02 19:55:10', '2026-06-02 19:55:10', NULL),
(228, 14, 'Barry', 'Leigh', '1937-01-24', 'Funded', '2026-05-07', '2027-05-07', 'ok', NULL, 1, '2026-06-02 19:56:14', '2026-06-02 19:56:14', NULL),
(229, 14, 'Freda', 'Scotchford', '1934-08-28', 'Funded', '2026-05-07', '2027-05-07', 'ok', NULL, 1, '2026-06-02 19:57:53', '2026-06-02 19:57:53', NULL),
(230, 14, 'John', 'Robinson', '1940-06-13', 'Funded', '2025-11-03', '2026-11-03', 'ok', NULL, 1, '2026-06-02 19:59:50', '2026-06-02 19:59:50', NULL),
(231, 14, 'Sheila', 'O’Connor', '1931-05-08', 'Funded', '2025-05-02', '2026-05-02', 'overdue', NULL, 1, '2026-06-02 20:01:02', '2026-06-02 20:01:02', NULL),
(232, 14, 'Vimla', 'Sharma', '1938-02-25', 'Funded', '2026-03-17', '2027-03-17', 'ok', NULL, 1, '2026-06-02 20:02:05', '2026-06-02 20:02:05', NULL),
(233, 14, 'Patricia', 'Tyldesley', '1933-04-15', 'Funded', '2026-03-17', '2027-03-17', 'ok', NULL, 1, '2026-06-02 20:03:12', '2026-06-02 20:03:12', NULL),
(234, 14, 'Yvonne', 'McCartney', '1940-12-11', 'Funded', '2025-05-02', '2026-05-02', 'overdue', NULL, 1, '2026-06-02 20:04:14', '2026-06-02 20:04:14', NULL),
(235, 14, 'Ronald', 'Renshaw', '1940-09-13', 'Funded', '2025-08-27', '2026-08-27', 'ok', NULL, 1, '2026-06-02 20:05:09', '2026-06-02 20:05:09', NULL),
(236, 14, 'Thomas', 'Mullarkey', '1928-12-10', 'Funded', '2026-05-07', '2027-05-07', 'ok', NULL, 1, '2026-06-02 20:06:24', '2026-06-02 20:06:24', NULL),
(237, 14, 'Barbara', 'Cramer', '1935-02-23', 'Funded', '2026-03-17', '2027-03-17', 'ok', NULL, 1, '2026-06-02 20:07:30', '2026-06-02 20:07:30', NULL),
(238, 14, 'Catherine', 'Moore', '1938-12-03', 'Funded', '2025-05-02', '2026-05-02', 'overdue', NULL, 1, '2026-06-02 20:08:13', '2026-06-02 20:08:13', NULL),
(239, 14, 'Hilda', 'Eckersley', '1930-04-08', 'Funded', '2025-08-27', '2026-08-27', 'ok', NULL, 1, '2026-06-02 20:09:24', '2026-06-02 20:09:24', NULL),
(240, 14, 'Marjorie', 'Adams', '1944-02-21', 'Funded', '2025-05-01', '2026-05-01', 'overdue', NULL, 1, '2026-06-02 20:10:12', '2026-06-02 20:10:12', NULL),
(241, 14, 'Alison', 'Donald', '1928-07-16', 'Funded', '2025-05-01', '2026-05-01', 'overdue', NULL, 1, '2026-06-02 20:10:59', '2026-06-02 20:10:59', NULL),
(242, 14, 'Joan', 'Jones', '1937-06-18', 'Funded', '2026-05-07', '2027-05-07', 'ok', NULL, 1, '2026-06-02 20:11:47', '2026-06-02 20:11:47', NULL),
(243, 14, 'Frances', 'Yule', '1947-07-18', 'Funded', '2025-08-27', '2026-08-27', 'ok', NULL, 1, '2026-06-02 20:12:37', '2026-06-02 20:12:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resident_documents`
--

CREATE TABLE `resident_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resident_id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `filetype` varchar(255) DEFAULT NULL,
  `filesize` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `uploaded_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resident_documents`
--

INSERT INTO `resident_documents` (`id`, `resident_id`, `filename`, `filepath`, `filetype`, `filesize`, `created_at`, `updated_at`, `deleted_at`, `uploaded_by`) VALUES
(9, 18, 'Patient_Report_Mr_Demo_Demo.pdf', 'resident_documents/ifHOwNKuHj047WIPSpsw4FGcCsfjJOPakZLvj7G7.pdf', 'application/pdf', 9717190, '2026-05-20 14:51:09', '2026-05-20 14:51:09', NULL, NULL),
(10, 15, 'bg.png', 'resident_documents/WqOOWvHIzoRHfkjCMjCvkQYYr1arcSnHt1Dscr3U.png', 'image/png', 283247, '2026-05-20 15:31:44', '2026-05-20 15:31:44', NULL, NULL),
(11, 57, 'Patient_Report_Karen_Elizabeth_Pendlebury.pdf', 'resident_documents/JzBILL1aqhg9mPROMX0uKH2XRktChJTQbx1uzYKS.pdf', 'application/pdf', 10046279, '2026-05-26 04:38:15', '2026-05-26 04:38:15', NULL, NULL),
(12, 55, 'Patient_Report_John_Eirwyn_Jones.pdf', 'resident_documents/MP6EFYbIweCOZpm26HMSetoTMwKu92Z2cw5bCfHx.pdf', 'application/pdf', 10001888, '2026-05-26 04:39:22', '2026-05-26 04:39:22', NULL, NULL),
(13, 66, 'Patient_Report_Graham_Dickinson.pdf', 'resident_documents/FYHalJUUMfeAQrdKKK6P3qqRD0aVYqcvHMsgTHCq.pdf', 'application/pdf', 9642469, '2026-05-26 04:40:53', '2026-05-26 04:40:53', NULL, NULL),
(14, 154, 'Patient_Report_Danial_Clarke.pdf', 'resident_documents/V4kUgkdFt3yao4xDbD8pqYw8xBAt2nIG3tAnf3xG.pdf', 'application/pdf', 7909373, '2026-06-02 19:54:09', '2026-06-02 19:54:09', NULL, NULL),
(15, 155, 'Patient_Report_Yvonne_Keen.pdf', 'resident_documents/36kk0nKLJmz33yrqIHcJi5k8MP1KIyvLvkhC1uwj.pdf', 'application/pdf', 8194613, '2026-06-02 19:55:14', '2026-06-02 19:55:14', NULL, NULL),
(16, 50, 'Patient_Report_Edward_Prezner.pdf', 'resident_documents/wWoieRKgcvgkDSW8vNHiY7R26eApxm7hJ6wHUWPk.pdf', 'application/pdf', 10062841, '2026-06-02 19:56:25', '2026-06-02 19:56:25', NULL, NULL),
(17, 47, 'Patient_Report_Carol_Owens.pdf', 'resident_documents/r7VdisTAwovIQIt35bcOMwfYWN8t73vK3Wo0MXPe.pdf', 'application/pdf', 9823070, '2026-06-02 19:57:23', '2026-06-02 19:57:23', NULL, NULL),
(18, 45, 'Patient_Report_Margerette_Murphy.pdf', 'resident_documents/sGvEF0LiQCtyWhIK8VRfXX0hb8PeBNcuyTToGUeL.pdf', 'application/pdf', 7918949, '2026-06-02 19:58:17', '2026-06-02 19:58:17', NULL, NULL),
(19, 44, 'Patient_Report_Winifred_Lawton.pdf', 'resident_documents/0eSfPsMSpkFIt8MjUlibVNdHxr6hBrvVgaBFJYPh.pdf', 'application/pdf', 7919782, '2026-06-02 20:00:06', '2026-06-02 20:00:06', NULL, NULL),
(20, 42, 'Patient_Report_Joan_Greenwood.pdf', 'resident_documents/MMmxushLTGZRkopmVZwYaVuqlATbANA9NJ5FFdcY.pdf', 'application/pdf', 10035785, '2026-06-02 20:01:26', '2026-06-02 20:01:26', NULL, NULL),
(21, 41, 'Patient_Report_Brian_Dennese.pdf', 'resident_documents/WxWiBLT0ew7rnYaEbFk5aGIj04iXwEFoSHYDTme6.pdf', 'application/pdf', 7919770, '2026-06-02 20:03:12', '2026-06-02 20:03:12', NULL, NULL),
(22, 40, 'Patient_Report_James_Halliday.pdf', 'resident_documents/tka7OkYZYRD7TuHA8QLIK4Tzf6LioXtCvuiNkD47.pdf', 'application/pdf', 10044280, '2026-06-02 20:04:17', '2026-06-02 20:04:17', NULL, NULL),
(23, 39, 'Patient_Report_Albert_Taylor.pdf', 'resident_documents/WSCs8hFCDdwGyoNqKe6ZCrJ3ppCT8Ru5PlQksEAD.pdf', 'application/pdf', 7919777, '2026-06-02 20:06:08', '2026-06-02 20:06:08', NULL, NULL),
(24, 38, 'Patient_Report_Audrey_Brooked.pdf', 'resident_documents/3RTOpIfxhuRT8ikWQJJpztYuwlHyToA9V2rjR9Bb.pdf', 'application/pdf', 7920966, '2026-06-02 20:09:02', '2026-06-02 20:09:02', NULL, NULL),
(25, 37, 'Patient_Report_Kolawole_Olomayoma.pdf', 'resident_documents/TIMyPZPlRBIye5wE4CSh28pj2UYK4Eh3vWq3jp0c.pdf', 'application/pdf', 10285264, '2026-06-02 20:10:22', '2026-06-02 20:10:22', NULL, NULL),
(26, 36, 'Patient_Report_Wendy_Sage.pdf', 'resident_documents/qGeTBHDrQIIQkWmGB1S2Dh721TJMQclcPvSsopz0.pdf', 'application/pdf', 10000069, '2026-06-02 20:11:17', '2026-06-02 20:11:17', NULL, NULL),
(27, 31, 'Patient_Report_Susan_Holmes.pdf', 'resident_documents/kPLDG8p2lC5pkrLJWsHAwm1WCMosq8gcY9BG4Wfj.pdf', 'application/pdf', 8496874, '2026-06-02 20:13:14', '2026-06-02 20:13:14', NULL, NULL),
(28, 29, 'Patient_Report_Paula_Sage.pdf', 'resident_documents/I88pXKIWY2Yovlzox0Hm9kzl37l7vgWBH1AvG9xU.pdf', 'application/pdf', 7919768, '2026-06-02 20:14:07', '2026-06-02 20:14:07', NULL, NULL),
(29, 27, 'Patient_Report_Francis_Turner.pdf', 'resident_documents/P6v2jkvp4chiDmZqLVMiUolzkp5vf6YI0jp3xzDf.pdf', 'application/pdf', 7921016, '2026-06-02 20:15:11', '2026-06-02 20:15:11', NULL, NULL),
(30, 24, 'Patient_Report_Alan_Frost.pdf', 'resident_documents/6Xu33V8yOXTqPATxdyJ7Z8pKEVIYOWDXXKOXpDdV.pdf', 'application/pdf', 9972845, '2026-06-02 20:16:38', '2026-06-02 20:16:38', NULL, NULL),
(31, 23, 'Patient_Report_Joan_Watson.pdf', 'resident_documents/bM8xP04NCwK5VDaJyxfQNrxucASiXhlTKjC0ZMXV.pdf', 'application/pdf', 7918958, '2026-06-02 20:19:19', '2026-06-02 20:19:19', NULL, NULL),
(32, 22, 'Patient_Report_Danial_McCord.pdf', 'resident_documents/Gute4o5mt6CT8PBs3Xm2hD1IzvJi8H2p8XfGLNZp.pdf', 'application/pdf', 10620277, '2026-06-02 20:21:01', '2026-06-02 20:21:01', NULL, NULL),
(33, 243, 'Landing Page Updated _ 6-02.png', 'resident_documents/XLk9Wfbjhyaz4ntkRQjWn9vXkpYAASoxURMRy4Tw.png', 'image/png', 1997340, '2026-06-03 08:16:47', '2026-06-03 08:16:47', NULL, NULL),
(34, 243, 'Landing Page Updated _ 6-03.png', 'resident_documents/uuDosj2vZOTQgooORXBOa4mWP4yaIy1gQU5RfBgL.png', 'image/png', 1172990, '2026-06-03 08:24:48', '2026-06-03 08:24:48', NULL, NULL),
(35, 243, 'Landing Page Updated _ 6-09.png', 'resident_documents/Landing_Page_Updated___6-09_1780493339_6a202c1bc2c12.png', 'image/png', 1226931, '2026-06-03 08:28:59', '2026-06-03 08:28:59', NULL, 1),
(36, 242, 'Landing Page Updated _ 6-03.png', 'resident_documents/Landing_Page_Updated___6-03_1780506651_6a20601bed419.png', 'image/png', 1172990, '2026-06-03 12:10:51', '2026-06-03 12:11:00', '2026-06-03 12:11:00', 1),
(37, 241, 'Landing Page Updated _ 6-08.png', 'resident_documents/Landing_Page_Updated___6-08_1780506671_6a20602fd9bcc.png', 'image/png', 793183, '2026-06-03 12:11:11', '2026-06-03 12:11:11', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_requests`
--

CREATE TABLE `service_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resident_id` bigint(20) UNSIGNED NOT NULL,
  `care_home_id` bigint(20) UNSIGNED NOT NULL,
  `requested_by` bigint(20) UNSIGNED NOT NULL,
  `type` enum('Eye Test','Replacement Glasses','Ear Wax Removal','Hearing Care') NOT NULL,
  `priority` enum('Routine','Urgent') NOT NULL DEFAULT 'Routine',
  `status` enum('New','In Progress','Completed') NOT NULL DEFAULT 'New',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_requests`
--

INSERT INTO `service_requests` (`id`, `resident_id`, `care_home_id`, `requested_by`, `type`, `priority`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(8, 18, 7, 5, 'Eye Test', 'Routine', 'In Progress', NULL, '2026-05-13 10:09:18', '2026-05-13 10:14:09'),
(9, 12, 7, 5, 'Ear Wax Removal', 'Routine', 'Completed', NULL, '2026-05-15 12:32:30', '2026-05-15 12:40:14'),
(10, 18, 7, 5, 'Eye Test', 'Routine', 'New', NULL, '2026-05-20 17:23:05', '2026-05-20 17:23:05'),
(11, 18, 7, 5, 'Eye Test', 'Routine', 'New', NULL, '2026-05-20 18:55:49', '2026-05-20 18:55:49'),
(12, 18, 7, 5, 'Eye Test', 'Routine', 'Completed', NULL, '2026-05-22 15:21:08', '2026-05-24 03:27:21'),
(13, 64, 9, 8, 'Eye Test', 'Routine', 'In Progress', NULL, '2026-05-28 17:17:09', '2026-05-29 16:10:18'),
(14, 159, 9, 8, 'Eye Test', 'Routine', 'In Progress', NULL, '2026-05-28 17:45:23', '2026-05-29 16:10:25'),
(15, 158, 9, 8, 'Eye Test', 'Routine', 'In Progress', NULL, '2026-05-28 17:45:33', '2026-05-29 16:10:28'),
(16, 157, 9, 8, 'Eye Test', 'Routine', 'In Progress', NULL, '2026-05-28 17:45:43', '2026-05-29 16:10:30'),
(17, 159, 9, 8, 'Hearing Care', 'Routine', 'In Progress', NULL, '2026-05-28 17:46:25', '2026-05-29 16:10:36');

-- --------------------------------------------------------

--
-- Table structure for table `service_request_reports`
--

CREATE TABLE `service_request_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_request_id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `uploaded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_request_reports`
--

INSERT INTO `service_request_reports` (`id`, `service_request_id`, `file_name`, `file_path`, `note`, `uploaded_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 9, 'Landing Page Updated _ 6-29.png', 'service-request-reports/qqSvYl6knd7OtpwaDj4kv7l4Dd4e5UCe6OwxYY2f.png', 'Rep', 1, '2026-05-20 15:46:23', '2026-05-20 15:46:23', NULL),
(4, 11, 'Landing Page Updated _ 6-03.png', 'service-request-reports/b8blMJkosIeebj51j5HCoJMvwY74GrOueSJtfYOq.png', '', 1, '2026-06-03 10:38:56', '2026-06-03 10:38:56', NULL),
(5, 10, 'Landing Page Updated _ 6-09.png', 'service-request-reports/QRIpI5zVBC0rKBoc0fl12WV5REq7eqRfLffTQRgl.png', '', 1, '2026-06-03 10:39:17', '2026-06-03 10:39:17', NULL),
(6, 8, 'Landing Page Updated _ 6-09.png', 'service-request-reports/Landing_Page_Updated___6-09_1780506686_6a20603eb4e24.png', '', 1, '2026-06-03 12:11:26', '2026-06-03 12:11:26', NULL);

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
('mbmzR7b5CUUAcAYpk1efG1yu6eqMP8gYxdsltcS1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'ZXlKcGRpSTZJazB3VG5GWU0zUmhhazFRT1hsWWNYTmlTbXhvZUVFOVBTSXNJblpoYkhWbElqb2lkek40TVdkVU1HNUVNSElyVUV4SlRIaDRjRVlyT1V0dGNHUjFUbE5uT1hJMWJrSkpUSEZyTjI5aVJUSlpMMDB3ZFZkd1dUbEZjRmRHZFd0Q05WSnFPVVZDTkRkRGNIZFNjMUpCYVhkcGFWTk5TVU12UnpOb1RYRlNlVWxRZVc5YVoxcERNelZzZDNKR1JqVkRTRUpEVDBzd2RDOUVaRFJYYURKSFdTODRWMGswTVVjMlRGRmlaVXRGZEhOTGNGWlNVemRsYTJkcFdUaDZiMnBqWVZOQmNYbDRXWFpDTXpOdVNVOWpkemsyU2pKU09FTnNaV1I1ZERGYWEzVkdTM2xyWjBKb09GSndLMlp0TURSemVYTm1TRmh5WjAxWWVFUkdhM1pMZVdoYWNtUlVWbE5qY0VvM2FHNXNTM2QwYjA1emRWZFVWV2RRUjJsV2VUY3lUWFpMU2xJNU9XMXZaRkl3TlVoaGRXMW5hbXR1T1hkNVFWZDVRMlpxYzJGUlFVOVJSazk1TW5sbWFYRTJXbXM5SWl3aWJXRmpJam9pWVRReU5XVmhNalkwTnpNNU5tVmhNMkZsTUdVeE1XVm1PRGsxTmpRNU1tSTJNVFZqT0RKbVptWm1OV1JrWlRKbE5HSTFNVEk1TVdNeE1XSXlNbVkwWlNJc0luUmhaeUk2SWlKOQ==', 1780506709);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','carehome') NOT NULL DEFAULT 'carehome',
  `care_home_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `phone`, `address`, `password`, `role`, `care_home_id`, `is_active`, `is_admin`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Clear Sight Admin', 'Clearsight', 'Info@clearsightdomiciliary.com', NULL, NULL, '$2y$12$Ss.Tcsn2C1gAkvYu/o4kRuWjvgRM/2M1iRriaGHi86UzPofMvlEeS', 'admin', NULL, 1, 1, 'e0HvVG5tEQrXxcR96d83qHIEAy3Wmlj7XPN2I8ga8Mk6mcNuF1p7BStp7s2o', '2026-04-13 14:56:36', '2026-06-03 06:21:19', NULL),
(2, 'Sarah Collins', 'SarahCollins', 'sarah@amberley.co.uk', NULL, NULL, '$2y$12$AeURmPLir7KEjPbSh.vzFundjsbA1rqOXKmCpJzHTB9ZVnF85bC7S', 'carehome', NULL, 1, 0, NULL, '2026-04-13 14:56:37', '2026-06-03 06:24:09', NULL),
(3, 'Suki Duran', 'SukiDuran', 'democlientt@gmail.com', NULL, NULL, '$2y$10$0GTJgX4ZVseIG7CdSgMKDuF7lIbqKyKpJ0Z.WHaW752uHhUSSmKjy', 'carehome', NULL, 1, 0, '8TTIQ0sMuic4esnEC43pqeaH3O6ben9jVSoUhZ8N1CcnXVGCOQrSQmlqstFRMmRS', '2026-04-16 07:36:32', '2026-05-15 14:59:58', NULL),
(4, 'Upton Sherman', 'UptonSherman', 'cucow@mailinator.com', '+1 (231) 619-2228', 'Sed reiciendis excep', '$2y$10$0GTJgX4ZVseIG7CdSgMKDuF7lIbqKyKpJ0Z.WHaW752uHhUSSmKjy', 'admin', NULL, 1, 0, NULL, '2026-04-27 06:12:05', '2026-04-27 06:12:05', NULL),
(5, 'Mehdi', 'Mehdi', 'mohammedtirmazi@gmail.com', NULL, NULL, '$2y$10$0GTJgX4ZVseIG7CdSgMKDuF7lIbqKyKpJ0Z.WHaW752uHhUSSmKjy', 'carehome', 7, 1, 0, NULL, '2026-05-13 09:34:24', '2026-05-18 15:42:50', NULL),
(6, 'Harry', 'Harry', 'harry92t@gmail.com', '123456789', '1234 as street', '$2y$10$0GTJgX4ZVseIG7CdSgMKDuF7lIbqKyKpJ0Z.WHaW752uHhUSSmKjy', 'admin', NULL, 1, 0, NULL, '2026-05-13 10:07:23', '2026-05-14 15:08:11', NULL),
(7, 'Delma Dela Cruz', 'ambercourt', 'manager.ambercourt@mmcg.co.uk', NULL, NULL, '$2y$10$0GTJgX4ZVseIG7CdSgMKDuF7lIbqKyKpJ0Z.WHaW752uHhUSSmKjy', 'carehome', 8, 1, 0, NULL, '2026-05-24 03:30:43', '2026-05-24 03:30:43', NULL),
(8, 'Lorraine Scholey', 'richmondhouse', 'richmondhouse.leight@nhs.net', NULL, NULL, '$2y$10$0GTJgX4ZVseIG7CdSgMKDuF7lIbqKyKpJ0Z.WHaW752uHhUSSmKjy', 'carehome', 9, 1, 0, NULL, '2026-05-24 15:16:34', '2026-05-24 15:16:34', NULL),
(9, 'Sheila', 'Greenacres', 'manager.greenacres@minstercaregroup.co.uk', NULL, NULL, '$2y$10$0GTJgX4ZVseIG7CdSgMKDuF7lIbqKyKpJ0Z.WHaW752uHhUSSmKjy', 'carehome', 10, 1, 0, NULL, '2026-05-25 02:17:48', '2026-05-25 02:17:48', NULL),
(11, 'Kelly', 'lythamgrange', 'lythamgrange.manager@arh.group', NULL, NULL, '$2y$10$0GTJgX4ZVseIG7CdSgMKDuF7lIbqKyKpJ0Z.WHaW752uHhUSSmKjy', 'carehome', 11, 1, 0, NULL, '2026-05-26 04:14:05', '2026-05-26 04:14:05', NULL),
(12, 'Pagan Louise horton', 'belgravia', 'pagan.squibb@lillibehealthcare.co.uk', NULL, NULL, '$2y$12$bym2Dy77rOSYi1.2jZFkpeYdrWqbB1jxkyk00Ipd9PcE2TSm8zsMW', 'carehome', 12, 1, 0, NULL, '2026-06-01 12:36:36', '2026-06-03 06:25:33', NULL),
(13, 'Kirsty Lawson', 'annchallis', 'annchallishome@googlemail.com', NULL, NULL, '$2y$10$0GTJgX4ZVseIG7CdSgMKDuF7lIbqKyKpJ0Z.WHaW752uHhUSSmKjy', 'carehome', 13, 1, 0, NULL, '2026-06-02 02:27:16', '2026-06-02 02:27:16', NULL),
(14, 'Godfrey Taderera', 'ladyofthevale', 'admin@ladyofthevale.org.uk', NULL, NULL, '$2y$10$0GTJgX4ZVseIG7CdSgMKDuF7lIbqKyKpJ0Z.WHaW752uHhUSSmKjy', 'carehome', 14, 1, 0, NULL, '2026-06-02 02:31:08', '2026-06-02 02:31:08', NULL),
(15, 'Sonia Hart', 'fojemij', 'xocopuve@mailinator.com', NULL, NULL, '$2y$12$/84GjT5L62q1pAt82Mz8K.cXRqeQwAzYJ/.KqLLFdMlI7ycfehdVW', 'carehome', 15, 1, 0, NULL, '2026-06-03 08:07:30', '2026-06-03 08:07:30', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `care_homes`
--
ALTER TABLE `care_homes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `care_homes_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_care_home_id_foreign` (`care_home_id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `residents_care_home_id_foreign` (`care_home_id`);

--
-- Indexes for table `resident_documents`
--
ALTER TABLE `resident_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_documents_resident_id_foreign` (`resident_id`),
  ADD KEY `resident_documents_uploaded_by_foreign` (`uploaded_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_requests_resident_id_foreign` (`resident_id`),
  ADD KEY `service_requests_care_home_id_foreign` (`care_home_id`),
  ADD KEY `service_requests_requested_by_foreign` (`requested_by`);

--
-- Indexes for table `service_request_reports`
--
ALTER TABLE `service_request_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_request_reports_service_request_id_foreign` (`service_request_id`),
  ADD KEY `service_request_reports_uploaded_by_foreign` (`uploaded_by`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_care_home_id_foreign` (`care_home_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `care_homes`
--
ALTER TABLE `care_homes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `resident_documents`
--
ALTER TABLE `resident_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `service_request_reports`
--
ALTER TABLE `service_request_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_care_home_id_foreign` FOREIGN KEY (`care_home_id`) REFERENCES `care_homes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `residents`
--
ALTER TABLE `residents`
  ADD CONSTRAINT `residents_care_home_id_foreign` FOREIGN KEY (`care_home_id`) REFERENCES `care_homes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resident_documents`
--
ALTER TABLE `resident_documents`
  ADD CONSTRAINT `resident_documents_resident_id_foreign` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resident_documents_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD CONSTRAINT `service_requests_care_home_id_foreign` FOREIGN KEY (`care_home_id`) REFERENCES `care_homes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_requests_requested_by_foreign` FOREIGN KEY (`requested_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_requests_resident_id_foreign` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_request_reports`
--
ALTER TABLE `service_request_reports`
  ADD CONSTRAINT `service_request_reports_service_request_id_foreign` FOREIGN KEY (`service_request_id`) REFERENCES `service_requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_request_reports_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_care_home_id_foreign` FOREIGN KEY (`care_home_id`) REFERENCES `care_homes` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
