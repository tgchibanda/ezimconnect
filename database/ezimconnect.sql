-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 11:35 AM
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
-- Database: `ezimconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner_title` varchar(255) NOT NULL,
  `banner_url` varchar(255) NOT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner_title`, `banner_url`, `banner_image`, `created_at`, `updated_at`) VALUES
(1, 'B', 'url', 'upload/banners/1800626957472309.png', NULL, '2024-05-31 17:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_slug` varchar(255) NOT NULL,
  `brand_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_slug`, `brand_image`, `created_at`, `updated_at`) VALUES
(5, 'Leviton', 'leviton', 'upload/brand/1800463357448440.jpeg', NULL, '2024-05-30 19:52:27'),
(6, 'Siemens', 'siemens', 'upload/brand/1800546305031751.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('admin@gmail.com|127.0.0.1', 'i:1;', 1716849732),
('admin@gmail.com|127.0.0.1:timer', 'i:1716849732;', 1716849732),
('micah@gmail.com|127.0.0.1', 'i:1;', 1716855587),
('micah@gmail.com|127.0.0.1:timer', 'i:1716855587;', 1716855587),
('rbr@ezimconnect.com|127.0.0.1', 'i:1;', 1717078506),
('rbr@ezimconnect.com|127.0.0.1:timer', 'i:1717078506;', 1717078506);

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
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `weight` decimal(8,2) NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`options`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `product_id`, `name`, `qty`, `price`, `weight`, `options`, `created_at`, `updated_at`) VALUES
(1, 8, 8, 'Paint', 7, 50.00, 1.00, '{\"image\":\"upload\\/products\\/thumbnail\\/1800620172428362.webp\",\"color\":\"Red\",\"size\":\"Small\"}', '2024-06-01 23:26:38', '2024-06-01 23:34:51');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `category_image`, `created_at`, `updated_at`) VALUES
(1, 'Interior Finishing', 'interior-finishing', 'upload/category/1800531145163234.png', '2024-05-30 15:51:49', '2024-05-30 15:51:49'),
(2, 'Roofing', 'roofing', 'upload/category/1800466022860972.png', NULL, '2024-05-30 15:48:46'),
(3, 'Foundation', 'foundation', 'upload/category/1800531022647918.png', '2024-05-30 15:49:52', '2024-05-30 15:49:52'),
(4, 'Framing', 'framing', 'upload/category/1800531035747431.png', '2024-05-30 15:50:04', '2024-05-30 15:50:04'),
(5, 'Exterior Finishing', 'exterior-finishing', 'upload/category/1800531078566033.png', '2024-05-30 15:50:45', '2024-05-30 15:50:45'),
(7, 'Electrical', 'electrical', 'upload/category/1800531106623968.png', '2024-05-30 15:51:12', '2024-05-30 15:51:12'),
(10, 'Kitchen', 'kitchen', 'upload/category/1800531157445639.png', '2024-05-30 15:52:00', '2024-05-30 15:52:00'),
(11, 'Bathrooms', 'bathrooms', 'upload/category/1800531172462148.png', '2024-05-30 15:52:15', '2024-05-30 15:52:15'),
(12, 'Landscaping', 'landscaping', 'upload/category/1800531185537337.png', '2024-05-30 15:52:27', '2024-05-30 15:52:27'),
(16, 'Utilities', 'utilities', 'upload/category/1800531271663501.png', '2024-05-30 15:53:49', '2024-05-30 15:53:49');

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
(4, '2024_05_28_010853_add_mobile_column_to_users_table', 2),
(7, '2024_05_28_012913_add_socials_columns_to_users_table', 3),
(8, '2024_05_28_074323_add_vendor_join_and_vendor_join_column_to_users_table', 4),
(9, '2024_05_29_110342_create_brands_table', 5),
(10, '2024_05_30_081925_create_categories_table', 6),
(13, '2024_05_30_084147_create_sub_categories_table', 7),
(14, '2024_05_31_003219_create_products_table', 8),
(15, '2024_05_31_004620_create_multi_imgs_table', 8),
(16, '2024_06_01_014604_create_sliders_table', 9),
(17, '2024_06_01_025132_create_banners_table', 10),
(18, '2024_06_02_070521_create_cart_items_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `multi_imgs`
--

CREATE TABLE `multi_imgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `photo_name` varchar(255) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multi_imgs`
--

INSERT INTO `multi_imgs` (`id`, `product_id`, `photo_name`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(17, 6, 'upload/products/multi-image/1800539172224856.png', NULL, NULL, '2024-05-31 04:26:02', '2024-05-30 17:59:24', '2024-05-31 04:26:02'),
(18, 6, 'upload/products/multi-image/1800539172596231.png', NULL, NULL, '2024-05-31 04:26:02', '2024-05-30 17:59:24', '2024-05-31 04:26:02'),
(19, 6, 'upload/products/multi-image/1800539172861435.png', NULL, NULL, '2024-05-31 04:26:02', '2024-05-30 17:59:25', '2024-05-31 04:26:02'),
(20, 6, 'upload/products/multi-image/1800539173383792.png', NULL, NULL, '2024-05-31 04:26:02', '2024-05-30 17:59:25', '2024-05-31 04:26:02'),
(21, 6, 'upload/products/multi-image/1800539173783747.png', NULL, NULL, '2024-05-31 04:26:02', '2024-05-30 17:59:26', '2024-05-31 04:26:02'),
(22, 7, 'upload/products/multi-image/1800539536061388.png', NULL, NULL, '2024-05-31 03:39:14', '2024-05-30 18:05:11', '2024-05-31 03:39:14'),
(23, 7, 'upload/products/multi-image/1800575008165830.png', NULL, NULL, '2024-05-31 03:39:14', '2024-05-30 18:05:11', '2024-05-31 03:39:14'),
(24, 7, 'upload/products/multi-image/1800572276927549.png', NULL, NULL, NULL, '2024-05-30 18:05:11', '2024-05-31 02:45:35'),
(25, 7, 'upload/products/multi-image/1800539536390098.png', NULL, NULL, NULL, '2024-05-30 18:05:11', NULL),
(26, 7, 'upload/products/multi-image/1800539536488884.png', NULL, NULL, NULL, '2024-05-30 18:05:11', NULL),
(27, 7, 'upload/products/multi-image/1800572277099952.png', NULL, NULL, '2024-05-31 02:54:26', '2024-05-30 18:05:11', '2024-05-31 02:54:26'),
(28, 8, 'upload/products/multi-image/1800620173003916.webp', NULL, NULL, NULL, '2024-05-31 15:26:52', NULL),
(29, 8, 'upload/products/multi-image/1800620173127232.webp', NULL, NULL, NULL, '2024-05-31 15:26:52', NULL),
(30, 8, 'upload/products/multi-image/1800620173236036.webp', NULL, NULL, NULL, '2024-05-31 15:26:52', NULL),
(31, 8, 'upload/products/multi-image/1800620173339574.webp', NULL, NULL, NULL, '2024-05-31 15:26:53', NULL);

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
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_slug` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_qty` varchar(255) NOT NULL,
  `product_tags` varchar(255) DEFAULT NULL,
  `product_size` varchar(255) DEFAULT NULL,
  `product_color` varchar(255) DEFAULT NULL,
  `selling_price` varchar(255) NOT NULL,
  `discount_price` varchar(255) DEFAULT NULL,
  `short_descp` text NOT NULL,
  `long_descp` text NOT NULL,
  `product_thumbnail` varchar(255) NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `hot_deals` int(11) DEFAULT NULL,
  `featured` int(11) DEFAULT NULL,
  `special_offer` int(11) DEFAULT NULL,
  `special_deals` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `subcategory_id`, `product_name`, `product_slug`, `product_code`, `product_qty`, `product_tags`, `product_size`, `product_color`, `selling_price`, `discount_price`, `short_descp`, `long_descp`, `product_thumbnail`, `vendor_id`, `hot_deals`, `featured`, `special_offer`, `special_deals`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(6, 5, 7, 49, 'Solar', 'solar', 'sollll', '10', 'new product,top product', 'Small,Midium,Large', 'Red,Blue,Black', '200', '150', 'sdfgsdf', '<p>Hello, World!</p>', 'upload/products/thumbnail/1800633805880338.png', 7, 1, NULL, NULL, 1, 1, NULL, NULL, NULL, '2024-05-30 17:59:24', '2024-05-31 19:03:34'),
(7, 5, 7, 49, 'Solar', 'solar', 'ccchhhh', '10', 'new product,top product,zesa', 'Small,Midium,Large', 'Red,Blue,Black', '40', NULL, 'kkk', '<p>Hello, World!</p>', 'upload/products/thumbnail/1800569287809186.png', 6, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-05-31 03:59:58', '2024-05-31 04:19:05'),
(8, 5, 11, 2, 'Paint', 'paint', 'paing-110', '10', 'new product,top product', 'Small,Midium,Large', 'Red,Blue,Black', '50', NULL, 'asdfasdf', '<p>Hello, World!</p>', 'upload/products/thumbnail/1800620172428362.webp', 7, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2024-06-01 01:48:31', '2024-06-01 01:48:31');

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
('D2qBN4i14JhkqwCsbBUi3wSA4fqRXfsCJCAvFQjY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3RCbFNwMk9SVlQ4UzQ0R3U5b0g0dUJWTFI3dlNzTHQ4OGg2OU1WYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1717310258),
('dyLhSXHFQzeLc6WMLKB1HQ9L1xi4O3QfMsL5W62A', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSFN4RFgxMXZvamgzbzhUVzNNQmtldVhGTTZmcVZPRTNQbjd3ck9nUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1717301807),
('EPe2ov3BYAzBjwu8BKyocFsVM7DNwT1yhFCyLtte', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNTd1c3VpZUpuclRDVFZTYUtpeTFCaEx6anVsOUVKMVp5NUN1Q21YOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjg7fQ==', 1717320891);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slider_title` varchar(255) NOT NULL,
  `short_title` varchar(255) NOT NULL,
  `slider_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_title`, `short_title`, `slider_image`, `created_at`, `updated_at`) VALUES
(1, 'Don\'t miss amazing <br />paint deals wangu <br /> Pakaipa', 'Test', 'upload/sliders/1800625348409881.png', NULL, '2024-05-31 16:49:08'),
(2, 'Don\'t miss amazing <br />paint deals', 'sdfasdfasdf', 'upload/sliders/1800622653999156.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `subcategory_slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `subcategory_name`, `subcategory_slug`, `created_at`, `updated_at`) VALUES
(1, 11, 'Vanities', 'vanities', '2024-05-30 15:54:27', '2024-05-30 15:54:27'),
(2, 11, 'Bathtubs and Showers', 'bathtubs-and-showers', NULL, NULL),
(3, 11, 'Toilets', 'toilets', NULL, NULL),
(4, 11, 'Plumbing Fixtures', 'plumbing-fixtures', '2024-05-30 15:57:42', '2024-05-30 15:57:42'),
(5, 12, 'Grading and Drainage', 'grading-and-drainage', '2024-05-30 15:58:35', '2024-05-30 15:58:35'),
(6, 12, 'Lawns and Gardens', 'lawns-and-gardens', NULL, NULL),
(7, 12, 'Fencing', 'fencing', NULL, NULL),
(8, 12, 'Decks and Patios', 'decks-and-patios', NULL, NULL),
(21, 16, 'Water Supply', 'water-supply', NULL, NULL),
(22, 16, 'Sewage Systems', 'sewage-systems', NULL, NULL),
(23, 16, 'Natural Gas', 'natural-gas', NULL, NULL),
(24, 16, 'Electric Service', 'electric-service', NULL, NULL),
(25, 2, 'Shingles', 'shingles', NULL, NULL),
(26, 2, 'Metal Roofing', 'metal-roofing', NULL, NULL),
(27, 2, 'Flat Roofs', 'flat-roofs', NULL, NULL),
(28, 2, 'Gutters and Downspouts', 'gutters-and-downspouts', NULL, NULL),
(29, 3, 'Excavation', 'excavation', NULL, NULL),
(30, 3, 'Concrete Work', 'concrete-work', NULL, NULL),
(31, 3, 'Footings', 'footings', NULL, NULL),
(32, 3, 'Slabs', 'slabs', NULL, NULL),
(33, 4, 'Wood Framing', 'wood-framing', NULL, NULL),
(34, 4, 'Steel Framing', 'steel-framing', NULL, NULL),
(35, 4, 'Insulation', 'insulation', NULL, NULL),
(36, 4, 'Structural Beams', 'structural-beams', NULL, NULL),
(37, 5, 'Siding', 'siding', NULL, NULL),
(38, 5, 'Brickwork', 'brickwork', NULL, NULL),
(39, 5, 'Stucco', 'stucco', NULL, NULL),
(40, 5, 'Windows and Doors', 'windows-and-doors', NULL, NULL),
(41, 6, 'Water Supply Systems', 'water-supply-systems', NULL, NULL),
(42, 6, 'Drainage Systems', 'drainage-systems', NULL, NULL),
(43, 6, 'Fixtures and Fittings', 'fixtures-and-fittings', NULL, NULL),
(44, 6, 'Water Heaters', 'water-heaters', NULL, NULL),
(45, 7, 'Wiring', 'wiring', NULL, NULL),
(46, 7, 'Panels and Circuit Breakers', 'panels-and-circuit-breakers', NULL, NULL),
(47, 7, 'Lighting', 'lighting', NULL, NULL),
(48, 7, 'Outlets and Switches', 'outlets-and-switches', NULL, NULL),
(49, 7, 'Solar', 'solar', '2024-05-30 16:25:56', '2024-05-30 16:25:56'),
(50, 8, 'Heating Systems', 'heating-systems', NULL, NULL),
(54, 1, 'Drywall', 'drywall', NULL, NULL),
(55, 1, 'Painting', 'painting', NULL, NULL),
(56, 1, 'Trim and Molding', 'trim-and-molding', NULL, NULL),
(57, 1, 'Flooring', 'flooring', NULL, NULL),
(58, 10, 'Cabinets', 'cabinets', NULL, NULL),
(59, 10, 'Countertops', 'countertops', NULL, NULL),
(60, 10, 'Appliances', 'appliances', NULL, NULL),
(61, 10, 'Plumbing Fixtures', 'plumbing-fixtures', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `vendor_join` varchar(255) DEFAULT NULL,
  `vendor_short_info` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `role` enum('admin','vendor','user') NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `phone`, `mobile`, `address`, `vendor_join`, `vendor_short_info`, `website`, `instagram`, `facebook`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mr. Devon Harber', NULL, 'wisoky.myron@example.com', '2024-05-27 03:47:03', '', '', '(980) 627-4740', NULL, '531 Friesen Groves\nNorth Nigeltown, NC 94872', NULL, NULL, NULL, NULL, NULL, 'vendor', 'active', 'ZQZDVFCBoV', '2024-05-27 03:47:03', '2024-05-30 06:52:33'),
(2, 'Miss Alexanne Ledner', NULL, 'myriam24@example.com', '2024-05-27 03:47:03', '', 'https://via.placeholder.com/60x60.png/00aa99?text=sint', '1-203-685-1324', NULL, '5211 Lessie Isle Apt. 876\nSchoentown, AR 81307', NULL, NULL, NULL, NULL, NULL, 'admin', 'active', 'ZbsXUUAHot', '2024-05-27 03:47:03', '2024-05-27 03:47:03'),
(3, 'Dr. Hiram Conroy PhD', NULL, 'keanu20@example.net', '2024-05-27 03:47:03', '', 'https://via.placeholder.com/60x60.png/00ff00?text=neque', '936-849-5322', NULL, '36112 Garnett Mountain Apt. 164\nFrankville, WI 21106-4028', NULL, NULL, NULL, NULL, NULL, 'vendor', 'active', '03IC8eGYht', '2024-05-27 03:47:03', '2024-05-30 06:53:03'),
(4, 'Gladyce Hickle V', NULL, 'orland.koelpin@example.org', '2024-05-27 03:47:03', '', 'https://via.placeholder.com/60x60.png/0099dd?text=sed', '+16782880249', NULL, '63942 Jacobson Prairie Suite 712\nStiedemannville, ID 98475-9788', NULL, NULL, NULL, NULL, NULL, 'user', 'inactive', 'DdjKS5eC6y', '2024-05-27 03:47:03', '2024-05-27 03:47:03'),
(5, 'Halie Waters', NULL, 'laila.murazik@example.org', '2024-05-27 03:47:03', '', 'https://via.placeholder.com/60x60.png/00ee88?text=qui', '(804) 631-3523', NULL, '5456 Eldridge Underpass\nYvonnebury, WA 29893-5290', NULL, NULL, NULL, NULL, NULL, 'vendor', 'active', 'qKAVgyHJvg', '2024-05-27 03:47:03', '2024-05-30 05:31:09'),
(6, 'Ms. Tessie Hyatt Jr.', NULL, 'zetta.torphy@example.net', '2024-05-27 03:47:03', '', 'https://via.placeholder.com/60x60.png/005588?text=eligendi', '425.280.4071', NULL, '462 Jacobi Drives Suite 333\nHermistonfort, WV 71335-3061', NULL, NULL, NULL, NULL, NULL, 'vendor', 'active', 'QcbWT5ZscH', '2024-05-27 03:47:03', '2024-05-30 05:54:29'),
(7, 'Nash Paints', 'vendor', 'vendor@ezimconnect.com', '2024-05-27 03:47:03', '$2y$12$UKWigI4Bcy9txiqdJZN2SOnE4fFNs11hrhbkvjXliSJNB4jsLc7ii', '202405280936favicon-32x32.png', '740-386-9144', '740-386-91', '9094 Medhurst Locks Suite 669Leschchester, MS 23118-2143', '2024', 'We deal with all construction equipment and supplies\r\nWe deal with all construction equipment and supplies', 'www.nashpaints.co.zw', 'www.instagram.com/nashpaints', 'www.facebook.com/nashpaints', 'vendor', 'active', 'erJY1Fh1gwEXPS2enDPgUM73UqGeg7aGUDkFSs5xDPbS8vpOVJ5tnexjVpHH', '2024-05-27 03:47:03', '2024-05-28 01:47:45'),
(8, 'Dr. Fanny Fahey', 'user', 'user@ezimconnect.com', '2024-05-27 03:47:03', '$2y$12$VBiNZyLynkFLSuxe0v4Vi..4sogPlSs7F4z1qOFW7mhkbBKIi7IqW', 'https://via.placeholder.com/60x60.png/001155?text=aut', '1-618-830-6823', NULL, '5893 Block Drive\nBalistreriville, OR 13238', NULL, NULL, NULL, NULL, NULL, 'user', 'inactive', '1BW5WG4obbXyALRpBfEjyiyXB14JoyqzCuJW7b55hMoU4UsGoAiml05LvOR5', '2024-05-27 03:47:03', '2024-05-27 03:47:03'),
(9, 'Takunda Geraldino Chibanda', NULL, 'admin@ezimconnect.com', '2024-04-30 22:44:29', '$2y$12$b4ShVNhnEbOdTMXMuUeul.X4sKgYq3FyGey9copZpM90ZHr5BRFX6', '202405280210avatar-8.png', '0459825176', '0459825176', '88A First Avenue', NULL, NULL, 'www.takundachibanda.dev', 'www.instagram.com/tgchibanda', 'www.facebook.com/tgchiband', 'admin', 'active', NULL, '2024-05-27 03:54:48', '2024-05-29 18:55:04'),
(10, 'Micah Chibanda', 'marblemukarati', 'micah@ezimconnect.com', NULL, '$2y$12$QlOBY3HySAUTcz8XM9DXje6s5rSWEUNXKtOLfINGMR4Bxf9W/aH12', '202405290659chair.png', '0459825176', '0459825176', '88A First Avenue', NULL, NULL, NULL, NULL, NULL, 'user', 'active', NULL, '2024-05-28 16:36:51', '2024-05-28 21:01:19'),
(11, 'IBR Tiles', NULL, 'ibr@ezimconnect.com', NULL, '$2y$12$G12vWg0kyxOKKxrmt5qmVedyc361zG4eXoB4paJXR19m.eDP2rJLm', NULL, '087677', NULL, NULL, '2024', NULL, NULL, NULL, NULL, 'vendor', 'active', NULL, NULL, '2024-05-30 19:54:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `multi_imgs`
--
ALTER TABLE `multi_imgs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `multi_imgs_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_subcategory_id_foreign` (`subcategory_id`),
  ADD KEY `products_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
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
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `multi_imgs`
--
ALTER TABLE `multi_imgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `multi_imgs`
--
ALTER TABLE `multi_imgs`
  ADD CONSTRAINT `multi_imgs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`id`),
  ADD CONSTRAINT `products_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
