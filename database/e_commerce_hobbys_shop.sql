-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2026 at 12:15 PM
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
-- Database: `e_commerce_hobbys_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `subtitle`, `image`, `button_text`, `button_link`, `is_active`, `product_id`, `created_at`, `updated_at`) VALUES
(3, 'El grande americano', 'mmamadamafaaka', 'uploads/banners/el-grande-americano-6906ead69651e.jpg', 'Shop now', NULL, 1, 3, '2025-11-02 04:27:51', '2025-11-02 06:44:25'),
(4, 'asdasdasdasdasdasd', 'asdasasdasdassad', 'uploads/banners/asdasdasdasdasdasd-6906eafd1b909.jpg', 'Shop now', NULL, 1, NULL, '2025-11-02 05:24:13', '2025-11-02 06:39:11');

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'analogue', 'analogue', '2025-09-04 00:20:51', '2025-09-07 23:21:59'),
(2, 'digital', 'digital', '2025-09-07 23:22:08', '2025-09-07 23:22:08'),
(3, 'automatic', 'automatic', '2025-09-07 23:22:17', '2025-09-07 23:22:17');

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
(4, '2025_08_07_030126_add_role_and_extra_fields_to_users_table', 2),
(5, '2025_09_04_051829_create_categories_table', 3),
(6, '2025_09_04_051818_create_products_table', 1),
(7, '2025_10_20_053314_create_orders_table', 4),
(8, '2025_10_20_053315_create_order_items_table', 4),
(9, '2025_10_25_130539_add_more_images_to_products_table', 5),
(10, '2025_10_29_111654_add_deleted_at_to_products_table', 6),
(11, '2025_11_02_092354_create_banners_table', 7),
(12, '2025_11_03_191701_create_reviews_table', 8),
(13, '2025_11_08_111123_add_tracking_number_to_orders_table', 9),
(14, '2026_04_02_124518_create_product_variations_table', 10),
(15, '2026_04_02_163223_add_variation_to_order_items_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `is_inside_dhaka` tinyint(1) NOT NULL DEFAULT 1,
  `delivery_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(12,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `order_status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tracking_number`, `user_name`, `phone`, `address`, `is_inside_dhaka`, `delivery_charge`, `subtotal`, `grand_total`, `order_status`, `created_at`, `updated_at`) VALUES
(21, NULL, 'shahed alam', '0121321321', 'asdsadadsadda', 1, 60.00, 2000.00, 2060.00, 'pending', '2025-11-08 05:21:36', '2025-11-08 05:21:36'),
(22, 'TRK-690ED499633F6', 'shahed alam2', '0121321321', 'asdasdasdas', 1, 100.00, 800.00, 900.00, 'processing', '2025-11-08 05:26:49', '2025-11-08 05:28:04'),
(23, 'TRK-697716B535748', 'mr pixel', '01551321321', 'mirpur, dhaka', 1, 60.00, 600.00, 660.00, 'pending', '2026-01-26 07:24:37', '2026-01-26 07:24:37'),
(29, 'TRK-69CF246DA0855', 'mr pixel', '01551321321', 'asdasdasdasdasd', 1, 100.00, 990.00, 1090.00, 'processing', '2026-04-03 02:22:37', '2026-04-04 09:41:38'),
(30, 'TRK-69D0E46E68AC0', 'mr one', '01551321321', 'address', 1, 60.00, 990.00, 1050.00, 'pending', '2026-04-04 10:14:06', '2026-04-04 10:14:06'),
(31, 'TRK-69D0E4FAA8B4C', 'mr one', '01682011307', 'address', 1, 100.00, 990.00, 1090.00, 'pending', '2026-04-04 10:16:26', '2026-04-04 10:16:26'),
(32, 'TRK-69D226283AB9D', 'mr gray', '01551321321', 'address', 1, 100.00, 990.00, 1090.00, 'pending', '2026-04-05 09:06:48', '2026-04-05 09:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `unit_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `variation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`, `total_price`, `created_at`, `updated_at`, `variation_id`, `size`) VALUES
(37, 21, 5, 1, 1000.00, 1000.00, '2025-11-08 05:21:37', '2025-11-08 05:21:37', NULL, NULL),
(38, 22, 4, 1, 800.00, 800.00, '2025-11-08 05:26:49', '2025-11-08 05:26:49', NULL, NULL),
(39, 23, 3, 1, 600.00, 600.00, '2026-01-26 07:24:37', '2026-01-26 07:24:37', NULL, NULL),
(45, 29, 9, 1, 990.00, 990.00, '2026-04-03 02:22:37', '2026-04-03 02:22:37', 3, 'gray'),
(46, 30, 9, 1, 990.00, 990.00, '2026-04-04 10:14:06', '2026-04-04 10:14:06', 4, 'black'),
(47, 31, 9, 1, 990.00, 990.00, '2026-04-04 10:16:26', '2026-04-04 10:16:26', 4, 'Type: black'),
(48, 32, 9, 1, 990.00, 990.00, '2026-04-05 09:06:48', '2026-04-05 09:06:48', 3, 'Type: gray');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_2` varchar(255) DEFAULT NULL,
  `image_3` varchar(255) DEFAULT NULL,
  `image_4` varchar(255) DEFAULT NULL,
  `image_5` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `current_price` decimal(10,2) NOT NULL,
  `previous_price` decimal(10,2) DEFAULT NULL,
  `isOnSale` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `image`, `image_2`, `image_3`, `image_4`, `image_5`, `description`, `current_price`, `previous_price`, `isOnSale`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 'nice one', 'nice-one', 'uploads/products/1756967660.jpg', NULL, NULL, NULL, NULL, '<p>asdasdasda</p>', 500.00, 900.00, 1, '2025-09-04 00:34:20', '2025-11-02 06:51:47', NULL),
(3, 1, 'moon phase', 'moon-phase', 'uploads/products/1757309025.jpg', NULL, NULL, NULL, NULL, NULL, 600.00, NULL, 0, '2025-09-07 23:23:45', '2025-09-07 23:23:45', NULL),
(4, 2, '1757_Black', '1757-black', 'uploads/products/1757-black-main-698982bd21787.webp', 'uploads/products/1757-black-2-698982bd4475c.webp', 'uploads/products/1757-black-3-698982bd59d19.webp', 'uploads/products/1757-black-4-698982bd64b14.webp', NULL, NULL, 800.00, NULL, 0, '2025-09-07 23:24:31', '2026-02-09 06:46:21', NULL),
(5, 3, 'auomatic mechanical caliography', 'auomatic-mechanical-caliography', 'uploads/products/1757309117.jpg', NULL, NULL, NULL, NULL, NULL, 1000.00, NULL, 0, '2025-09-07 23:25:17', '2025-10-29 10:20:22', NULL),
(7, 1, '9351 moon phase', '9351-moon-phase', 'uploads/products/9351-moon-phase-main-68fc78fd9dbec.jpg', 'uploads/products/9351-moon-phase-2-68fc78fd9e201.jpg', 'uploads/products/9351-moon-phase-3-68fc78fd9e49d.jpg', 'uploads/products/9351-moon-phase-4-68fc78fd9e8cb.png', 'uploads/products/9351-moon-phase-5-68fc78fd9eb78.jpg', '<p>asdasdads</p>', 1000.00, 1200.00, 0, '2025-10-25 07:15:09', '2025-10-25 07:15:09', NULL),
(8, 1, 'brace light type watch', 'brace-light-type-watch', 'uploads/products/brace-light-type-watch-main-69897da2c1634.webp', 'uploads/products/brace-light-type-watch-2-69897da41985f.webp', 'uploads/products/brace-light-type-watch-3-69897da58706a.webp', 'uploads/products/brace-light-type-watch-4-69897da6c87d6.webp', NULL, NULL, 1099.00, 1200.00, 0, '2026-02-09 06:24:40', '2026-02-09 06:24:40', NULL),
(9, 1, 'poedagar', 'poedagar', 'uploads/products/poedagar-main-69ce32e677411.webp', 'uploads/products/poedagar-2-69ce32e6d71bb.webp', 'uploads/products/poedagar-3-69ce32e6f0d43.webp', 'uploads/products/poedagar-4-69ce32e70ac06.webp', NULL, '<p>Poedagar watch diamond shape</p>', 990.00, 1050.00, 0, '2026-04-02 09:12:07', '2026-04-02 09:12:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `product_id`, `size`, `stock`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 9, 'purple', 1, 1, '2026-04-02 09:12:07', '2026-04-02 09:12:07'),
(2, 9, 'gold', 1, 1, '2026-04-02 09:12:07', '2026-04-02 09:12:07'),
(3, 9, 'gray', 1, 1, '2026-04-02 09:12:07', '2026-04-02 09:12:07'),
(4, 9, 'black', 1, 1, '2026-04-02 09:12:07', '2026-04-02 09:12:07');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `customer_name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'abul kashem', 'uploads/reviews/abul-kashem-6908bdce0b6dd.jpg', '2025-11-03 14:35:58', '2025-11-03 14:35:58'),
(2, 'kuddos makhonnna', 'uploads/reviews/kuddos-makhon-6908bf6bc624a.jpg', '2025-11-03 14:42:51', '2025-11-04 15:13:52'),
(3, 'john doe', 'uploads/reviews/john-doe-6908bf9a72ccb.jpg', '2025-11-03 14:43:38', '2025-11-03 14:43:38');

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
('swIxlKGoj31SksuxfRNu0kKE5tf7AuepfVww3lYI', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiN0RmRWZEcEoxN292NmJpeVpnenRZRFo3YlJFN01PdjdhNENHZ0hwTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hbGwtcHJvZHVjdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O3M6NDoiY2FydCI7YToxOntpOjg7YTo4OntzOjI6ImlkIjtzOjE6IjgiO3M6MTI6InZhcmlhdGlvbl9pZCI7TjtzOjQ6InNpemUiO047czoxMzoiaGFzX3ZhcmlhdGlvbiI7YjowO3M6NDoibmFtZSI7czoyMjoiYnJhY2UgbGlnaHQgdHlwZSB3YXRjaCI7czo1OiJwcmljZSI7ZDoxMDk5O3M6NToiaW1hZ2UiO3M6ODU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91cGxvYWRzL3Byb2R1Y3RzL2JyYWNlLWxpZ2h0LXR5cGUtd2F0Y2gtbWFpbi02OTg5N2RhMmMxNjM0LndlYnAiO3M6ODoicXVhbnRpdHkiO2k6MTt9fXM6MTI6ImJ1eV9ub3dfaXRlbSI7YTo4OntzOjI6ImlkIjtpOjk7czoxMjoidmFyaWF0aW9uX2lkIjtpOjM7czo0OiJzaXplIjtzOjQ6ImdyYXkiO3M6NDoibmFtZSI7czo4OiJwb2VkYWdhciI7czo1OiJwcmljZSI7czo2OiI5OTAuMDAiO3M6ODoicXVhbnRpdHkiO2k6MTtzOjU6ImltYWdlIjtzOjcxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdXBsb2Fkcy9wcm9kdWN0cy9wb2VkYWdhci1tYWluLTY5Y2UzMmU2Nzc0MTEud2VicCI7czoxMDoiaXNfYnV5X25vdyI7YjoxO319', 1775381501);

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `phone`, `address`) VALUES
(4, 'Admin User', 'admin@gmail.com', NULL, '$2y$12$x2xwOmwC/ACVzkYpO9eqA.hZ9qEno5ofcKk5B5K2k7ZfvTe7c2K56', NULL, '2025-08-10 23:24:34', '2025-08-10 23:24:34', 'admin', '0123456789', 'Admin Street'),
(5, 'Customer User', 'customer@gmail.com', NULL, '$2y$12$HsuuPuN1ae8zTB7P51ljIuB3wVKoTW4C1qIoFc2evFPExuQ2wVS36', NULL, '2025-08-10 23:24:34', '2025-08-10 23:24:34', 'customer', '0987654321', 'Customer Lane');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banners_product_id_foreign` (`product_id`);

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_tracking_number_unique` (`tracking_number`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_variation_id_foreign` (`variation_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variations_product_id_foreign` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `banners_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_items_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `product_variations` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
