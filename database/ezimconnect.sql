/*
 Navicat Premium Dump SQL

 Source Server         : Dev-Local
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : ezimconnect

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 03/06/2024 22:54:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for banners
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `banner_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of banners
-- ----------------------------
INSERT INTO `banners` VALUES (1, 'B', 'url', 'upload/banners/1800626957472309.png', NULL, '2024-06-01 03:14:42');

-- ----------------------------
-- Table structure for brands
-- ----------------------------
DROP TABLE IF EXISTS `brands`;
CREATE TABLE `brands`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of brands
-- ----------------------------
INSERT INTO `brands` VALUES (5, 'Leviton', 'leviton', 'upload/brand/1800463357448440.jpeg', NULL, '2024-05-31 05:52:27');
INSERT INTO `brands` VALUES (6, 'Siemens', 'siemens', 'upload/brand/1800546305031751.png', NULL, NULL);

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------
INSERT INTO `cache` VALUES ('admin@gmail.com|127.0.0.1', 'i:1;', 1716849732);
INSERT INTO `cache` VALUES ('admin@gmail.com|127.0.0.1:timer', 'i:1716849732;', 1716849732);
INSERT INTO `cache` VALUES ('micah@gmail.com|127.0.0.1', 'i:1;', 1716855587);
INSERT INTO `cache` VALUES ('micah@gmail.com|127.0.0.1:timer', 'i:1716855587;', 1716855587);
INSERT INTO `cache` VALUES ('rbr@ezimconnect.com|127.0.0.1', 'i:1;', 1717078506);
INSERT INTO `cache` VALUES ('rbr@ezimconnect.com|127.0.0.1:timer', 'i:1717078506;', 1717078506);

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for cart_items
-- ----------------------------
DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE `cart_items`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `weight` decimal(8, 2) NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `discount` int NOT NULL DEFAULT 0,
  `tax` int NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cart_items_product_id_foreign`(`product_id` ASC) USING BTREE,
  CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cart_items
-- ----------------------------
INSERT INTO `cart_items` VALUES (25, 8, 7, 'Solar', 1, 40.00, 1.00, '{\"image\":\"upload\\/products\\/thumbnail\\/1800569287809186.png\",\"color\":\"Red\",\"size\":\"Small\"}', 0, 0, '2024-06-03 03:51:15', '2024-06-03 04:45:04');
INSERT INTO `cart_items` VALUES (26, 8, 7, 'Solar', 1, 40.00, 1.00, '{\"image\":\"upload\\/products\\/thumbnail\\/1800569287809186.png\",\"color\":\"Red\",\"size\":\"Small\"}', 0, 0, '2024-06-03 04:23:02', '2024-06-03 04:43:19');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'Interior Finishing', 'interior-finishing', 'upload/category/1800531145163234.png', '2024-05-31 01:51:49', '2024-05-31 01:51:49');
INSERT INTO `categories` VALUES (2, 'Roofing', 'roofing', 'upload/category/1800466022860972.png', NULL, '2024-05-31 01:48:46');
INSERT INTO `categories` VALUES (3, 'Foundation', 'foundation', 'upload/category/1800531022647918.png', '2024-05-31 01:49:52', '2024-05-31 01:49:52');
INSERT INTO `categories` VALUES (4, 'Framing', 'framing', 'upload/category/1800531035747431.png', '2024-05-31 01:50:04', '2024-05-31 01:50:04');
INSERT INTO `categories` VALUES (5, 'Exterior Finishing', 'exterior-finishing', 'upload/category/1800531078566033.png', '2024-05-31 01:50:45', '2024-05-31 01:50:45');
INSERT INTO `categories` VALUES (7, 'Electrical', 'electrical', 'upload/category/1800531106623968.png', '2024-05-31 01:51:12', '2024-05-31 01:51:12');
INSERT INTO `categories` VALUES (10, 'Kitchen', 'kitchen', 'upload/category/1800531157445639.png', '2024-05-31 01:52:00', '2024-05-31 01:52:00');
INSERT INTO `categories` VALUES (11, 'Bathrooms', 'bathrooms', 'upload/category/1800531172462148.png', '2024-05-31 01:52:15', '2024-05-31 01:52:15');
INSERT INTO `categories` VALUES (12, 'Landscaping', 'landscaping', 'upload/category/1800531185537337.png', '2024-05-31 01:52:27', '2024-05-31 01:52:27');
INSERT INTO `categories` VALUES (16, 'Utilities', 'utilities', 'upload/category/1800531271663501.png', '2024-05-31 01:53:49', '2024-05-31 01:53:49');

-- ----------------------------
-- Table structure for compares
-- ----------------------------
DROP TABLE IF EXISTS `compares`;
CREATE TABLE `compares`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `compares_user_id_foreign`(`user_id` ASC) USING BTREE,
  INDEX `compares_product_id_foreign`(`product_id` ASC) USING BTREE,
  CONSTRAINT `compares_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `compares_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of compares
-- ----------------------------
INSERT INTO `compares` VALUES (3, 8, 7, '2024-06-03 02:27:21', NULL);
INSERT INTO `compares` VALUES (4, 8, 8, '2024-06-03 02:28:42', NULL);

-- ----------------------------
-- Table structure for coupons
-- ----------------------------
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `coupon_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_discount` int NOT NULL,
  `coupon_validity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of coupons
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancelled_at` int NULL DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED NULL DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2024_05_28_010853_add_mobile_column_to_users_table', 2);
INSERT INTO `migrations` VALUES (7, '2024_05_28_012913_add_socials_columns_to_users_table', 3);
INSERT INTO `migrations` VALUES (8, '2024_05_28_074323_add_vendor_join_and_vendor_join_column_to_users_table', 4);
INSERT INTO `migrations` VALUES (9, '2024_05_29_110342_create_brands_table', 5);
INSERT INTO `migrations` VALUES (10, '2024_05_30_081925_create_categories_table', 6);
INSERT INTO `migrations` VALUES (13, '2024_05_30_084147_create_sub_categories_table', 7);
INSERT INTO `migrations` VALUES (14, '2024_05_31_003219_create_products_table', 8);
INSERT INTO `migrations` VALUES (15, '2024_05_31_004620_create_multi_imgs_table', 8);
INSERT INTO `migrations` VALUES (16, '2024_06_01_014604_create_sliders_table', 9);
INSERT INTO `migrations` VALUES (17, '2024_06_01_025132_create_banners_table', 10);
INSERT INTO `migrations` VALUES (18, '2024_06_02_070521_create_cart_items_table', 11);
INSERT INTO `migrations` VALUES (19, '2024_06_02_230349_create_wishlists_table', 12);
INSERT INTO `migrations` VALUES (20, '2024_06_03_013137_create_compares_table', 13);
INSERT INTO `migrations` VALUES (30, '2024_06_03_084021_create_coupons_table', 14);
INSERT INTO `migrations` VALUES (32, '2024_06_03_104612_create_ship_states_table', 15);
INSERT INTO `migrations` VALUES (33, '2024_06_03_104646_create_ship_divisions_table', 15);
INSERT INTO `migrations` VALUES (34, '2024_06_03_104653_create_ship_districts_table', 15);

-- ----------------------------
-- Table structure for multi_imgs
-- ----------------------------
DROP TABLE IF EXISTS `multi_imgs`;
CREATE TABLE `multi_imgs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `photo_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `multi_imgs_product_id_foreign`(`product_id` ASC) USING BTREE,
  CONSTRAINT `multi_imgs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of multi_imgs
-- ----------------------------
INSERT INTO `multi_imgs` VALUES (17, 6, 'upload/products/multi-image/1800539172224856.png', NULL, NULL, NULL, '2024-05-31 03:59:24', '2024-05-31 14:26:02');
INSERT INTO `multi_imgs` VALUES (18, 6, 'upload/products/multi-image/1800539172596231.png', NULL, NULL, NULL, '2024-05-31 03:59:24', '2024-05-31 14:26:02');
INSERT INTO `multi_imgs` VALUES (19, 6, 'upload/products/multi-image/1800539172861435.png', NULL, NULL, NULL, '2024-05-31 03:59:25', '2024-05-31 14:26:02');
INSERT INTO `multi_imgs` VALUES (20, 6, 'upload/products/multi-image/1800539173383792.png', NULL, NULL, NULL, '2024-05-31 03:59:25', '2024-05-31 14:26:02');
INSERT INTO `multi_imgs` VALUES (21, 6, 'upload/products/multi-image/1800539173783747.png', NULL, NULL, NULL, '2024-05-31 03:59:26', '2024-05-31 14:26:02');
INSERT INTO `multi_imgs` VALUES (22, 7, 'upload/products/multi-image/1800539536061388.png', NULL, NULL, NULL, '2024-05-31 04:05:11', '2024-05-31 13:39:14');
INSERT INTO `multi_imgs` VALUES (23, 7, 'upload/products/multi-image/1800575008165830.png', NULL, NULL, NULL, '2024-05-31 04:05:11', '2024-05-31 13:39:14');
INSERT INTO `multi_imgs` VALUES (24, 7, 'upload/products/multi-image/1800572276927549.png', NULL, NULL, NULL, '2024-05-31 04:05:11', '2024-05-31 12:45:35');
INSERT INTO `multi_imgs` VALUES (25, 7, 'upload/products/multi-image/1800539536390098.png', NULL, NULL, NULL, '2024-05-31 04:05:11', NULL);
INSERT INTO `multi_imgs` VALUES (26, 7, 'upload/products/multi-image/1800539536488884.png', NULL, NULL, NULL, '2024-05-31 04:05:11', NULL);
INSERT INTO `multi_imgs` VALUES (27, 7, 'upload/products/multi-image/1800572277099952.png', NULL, NULL, NULL, '2024-05-31 04:05:11', '2024-05-31 12:54:26');
INSERT INTO `multi_imgs` VALUES (28, 8, 'upload/products/multi-image/1800620173003916.webp', NULL, NULL, NULL, '2024-06-01 01:26:52', NULL);
INSERT INTO `multi_imgs` VALUES (29, 8, 'upload/products/multi-image/1800620173127232.webp', NULL, NULL, NULL, '2024-06-01 01:26:52', NULL);
INSERT INTO `multi_imgs` VALUES (30, 8, 'upload/products/multi-image/1800620173236036.webp', NULL, NULL, NULL, '2024-06-01 01:26:52', NULL);
INSERT INTO `multi_imgs` VALUES (31, 8, 'upload/products/multi-image/1800620173339574.webp', NULL, NULL, NULL, '2024-06-01 01:26:53', NULL);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `brand_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `subcategory_id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_qty` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `product_size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `product_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `selling_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `short_descp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_descp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `hot_deals` int NULL DEFAULT NULL,
  `featured` int NULL DEFAULT NULL,
  `special_offer` int NULL DEFAULT NULL,
  `special_deals` int NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 0,
  `created_by` bigint UNSIGNED NULL DEFAULT NULL,
  `updated_by` bigint UNSIGNED NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `products_brand_id_foreign`(`brand_id` ASC) USING BTREE,
  INDEX `products_category_id_foreign`(`category_id` ASC) USING BTREE,
  INDEX `products_subcategory_id_foreign`(`subcategory_id` ASC) USING BTREE,
  INDEX `products_vendor_id_foreign`(`vendor_id` ASC) USING BTREE,
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `products_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (6, 5, 7, 49, 'Solar', 'solar', 'sollll', '10', 'new product,top product', 'Small,Midium,Large', 'Red,Blue,Black', '200', '150', 'sdfgsdf', '<p>Hello, World!</p>', 'upload/products/thumbnail/1800633805880338.png', 7, 1, NULL, NULL, 1, 1, NULL, NULL, NULL, '2024-05-31 03:59:24', '2024-06-01 05:03:34');
INSERT INTO `products` VALUES (7, 5, 7, 49, 'Solar', 'solar', 'ccchhhh', '10', 'new product,top product,zesa', 'Small,Midium,Large', 'Red,Blue,Black', '40', NULL, 'kkk', '<p>Hello, World!</p>', 'upload/products/thumbnail/1800569287809186.png', 6, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-05-31 13:59:58', '2024-05-31 14:19:05');
INSERT INTO `products` VALUES (8, 5, 11, 2, 'Paint', 'paint', 'paing-110', '10', 'new product,top product', 'Small,Midium,Large', 'Red,Blue,Black', '50', NULL, 'asdfasdf', '<p>Hello, World!</p>', 'upload/products/thumbnail/1800620172428362.webp', 7, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2024-06-01 11:48:31', '2024-06-01 11:48:31');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id` ASC) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('mqDtS1CO6glse2C4ERkU6hOZVhklC0yV1vV200on', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibnVLcXJORjIwcHNvenpLUTF3azZEZ2xUSmxUN2FWeWtRWVNOaUgwMCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMyOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWxsL3N0YXRlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk7fQ==', 1717418953);

-- ----------------------------
-- Table structure for ship_districts
-- ----------------------------
DROP TABLE IF EXISTS `ship_districts`;
CREATE TABLE `ship_districts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `division_id` bigint UNSIGNED NOT NULL,
  `district_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ship_districts
-- ----------------------------
INSERT INTO `ship_districts` VALUES (1, 2, 'Gweru - 054', '2024-06-03 11:43:50', '2024-06-03 12:00:49');

-- ----------------------------
-- Table structure for ship_divisions
-- ----------------------------
DROP TABLE IF EXISTS `ship_divisions`;
CREATE TABLE `ship_divisions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `division_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ship_divisions
-- ----------------------------
INSERT INTO `ship_divisions` VALUES (1, 'MATEBELE LAND', NULL, '2024-06-03 11:15:16');
INSERT INTO `ship_divisions` VALUES (2, 'Midlands', NULL, NULL);

-- ----------------------------
-- Table structure for ship_states
-- ----------------------------
DROP TABLE IF EXISTS `ship_states`;
CREATE TABLE `ship_states`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `division_id` bigint UNSIGNED NOT NULL,
  `district_id` bigint UNSIGNED NOT NULL,
  `state_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ship_states
-- ----------------------------
INSERT INTO `ship_states` VALUES (1, 2, 1, 'Northlea', '2024-06-03 12:38:29', '2024-06-03 12:46:57');

-- ----------------------------
-- Table structure for sliders
-- ----------------------------
DROP TABLE IF EXISTS `sliders`;
CREATE TABLE `sliders`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `slider_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sliders
-- ----------------------------
INSERT INTO `sliders` VALUES (1, 'Don\'t miss amazing <br />paint deals wangu <br /> Pakaipa', 'Test', 'upload/sliders/1800625348409881.png', NULL, '2024-06-01 02:49:08');
INSERT INTO `sliders` VALUES (2, 'Don\'t miss amazing <br />paint deals', 'sdfasdfasdf', 'upload/sliders/1800622653999156.png', NULL, NULL);

-- ----------------------------
-- Table structure for sub_categories
-- ----------------------------
DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE `sub_categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `subcategory_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 62 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sub_categories
-- ----------------------------
INSERT INTO `sub_categories` VALUES (1, 11, 'Vanities', 'vanities', '2024-05-31 01:54:27', '2024-05-31 01:54:27');
INSERT INTO `sub_categories` VALUES (2, 11, 'Bathtubs and Showers', 'bathtubs-and-showers', NULL, NULL);
INSERT INTO `sub_categories` VALUES (3, 11, 'Toilets', 'toilets', NULL, NULL);
INSERT INTO `sub_categories` VALUES (4, 11, 'Plumbing Fixtures', 'plumbing-fixtures', '2024-05-31 01:57:42', '2024-05-31 01:57:42');
INSERT INTO `sub_categories` VALUES (5, 12, 'Grading and Drainage', 'grading-and-drainage', '2024-05-31 01:58:35', '2024-05-31 01:58:35');
INSERT INTO `sub_categories` VALUES (6, 12, 'Lawns and Gardens', 'lawns-and-gardens', NULL, NULL);
INSERT INTO `sub_categories` VALUES (7, 12, 'Fencing', 'fencing', NULL, NULL);
INSERT INTO `sub_categories` VALUES (8, 12, 'Decks and Patios', 'decks-and-patios', NULL, NULL);
INSERT INTO `sub_categories` VALUES (21, 16, 'Water Supply', 'water-supply', NULL, NULL);
INSERT INTO `sub_categories` VALUES (22, 16, 'Sewage Systems', 'sewage-systems', NULL, NULL);
INSERT INTO `sub_categories` VALUES (23, 16, 'Natural Gas', 'natural-gas', NULL, NULL);
INSERT INTO `sub_categories` VALUES (24, 16, 'Electric Service', 'electric-service', NULL, NULL);
INSERT INTO `sub_categories` VALUES (25, 2, 'Shingles', 'shingles', NULL, NULL);
INSERT INTO `sub_categories` VALUES (26, 2, 'Metal Roofing', 'metal-roofing', NULL, NULL);
INSERT INTO `sub_categories` VALUES (27, 2, 'Flat Roofs', 'flat-roofs', NULL, NULL);
INSERT INTO `sub_categories` VALUES (28, 2, 'Gutters and Downspouts', 'gutters-and-downspouts', NULL, NULL);
INSERT INTO `sub_categories` VALUES (29, 3, 'Excavation', 'excavation', NULL, NULL);
INSERT INTO `sub_categories` VALUES (30, 3, 'Concrete Work', 'concrete-work', NULL, NULL);
INSERT INTO `sub_categories` VALUES (31, 3, 'Footings', 'footings', NULL, NULL);
INSERT INTO `sub_categories` VALUES (32, 3, 'Slabs', 'slabs', NULL, NULL);
INSERT INTO `sub_categories` VALUES (33, 4, 'Wood Framing', 'wood-framing', NULL, NULL);
INSERT INTO `sub_categories` VALUES (34, 4, 'Steel Framing', 'steel-framing', NULL, NULL);
INSERT INTO `sub_categories` VALUES (35, 4, 'Insulation', 'insulation', NULL, NULL);
INSERT INTO `sub_categories` VALUES (36, 4, 'Structural Beams', 'structural-beams', NULL, NULL);
INSERT INTO `sub_categories` VALUES (37, 5, 'Siding', 'siding', NULL, NULL);
INSERT INTO `sub_categories` VALUES (38, 5, 'Brickwork', 'brickwork', NULL, NULL);
INSERT INTO `sub_categories` VALUES (39, 5, 'Stucco', 'stucco', NULL, NULL);
INSERT INTO `sub_categories` VALUES (40, 5, 'Windows and Doors', 'windows-and-doors', NULL, NULL);
INSERT INTO `sub_categories` VALUES (41, 6, 'Water Supply Systems', 'water-supply-systems', NULL, NULL);
INSERT INTO `sub_categories` VALUES (42, 6, 'Drainage Systems', 'drainage-systems', NULL, NULL);
INSERT INTO `sub_categories` VALUES (43, 6, 'Fixtures and Fittings', 'fixtures-and-fittings', NULL, NULL);
INSERT INTO `sub_categories` VALUES (44, 6, 'Water Heaters', 'water-heaters', NULL, NULL);
INSERT INTO `sub_categories` VALUES (45, 7, 'Wiring', 'wiring', NULL, NULL);
INSERT INTO `sub_categories` VALUES (46, 7, 'Panels and Circuit Breakers', 'panels-and-circuit-breakers', NULL, NULL);
INSERT INTO `sub_categories` VALUES (47, 7, 'Lighting', 'lighting', NULL, NULL);
INSERT INTO `sub_categories` VALUES (48, 7, 'Outlets and Switches', 'outlets-and-switches', NULL, NULL);
INSERT INTO `sub_categories` VALUES (49, 7, 'Solar', 'solar', '2024-05-31 02:25:56', '2024-05-31 02:25:56');
INSERT INTO `sub_categories` VALUES (50, 8, 'Heating Systems', 'heating-systems', NULL, NULL);
INSERT INTO `sub_categories` VALUES (54, 1, 'Drywall', 'drywall', NULL, NULL);
INSERT INTO `sub_categories` VALUES (55, 1, 'Painting', 'painting', NULL, NULL);
INSERT INTO `sub_categories` VALUES (56, 1, 'Trim and Molding', 'trim-and-molding', NULL, NULL);
INSERT INTO `sub_categories` VALUES (57, 1, 'Flooring', 'flooring', NULL, NULL);
INSERT INTO `sub_categories` VALUES (58, 10, 'Cabinets', 'cabinets', NULL, NULL);
INSERT INTO `sub_categories` VALUES (59, 10, 'Countertops', 'countertops', NULL, NULL);
INSERT INTO `sub_categories` VALUES (60, 10, 'Appliances', 'appliances', NULL, NULL);
INSERT INTO `sub_categories` VALUES (61, 10, 'Plumbing Fixtures', 'plumbing-fixtures', NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `vendor_join` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `vendor_short_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `role` enum('admin','vendor','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Mr. Devon Harber', NULL, 'wisoky.myron@example.com', '2024-05-27 13:47:03', '', '', '(980) 627-4740', NULL, '531 Friesen Groves\nNorth Nigeltown, NC 94872', NULL, NULL, NULL, NULL, NULL, 'vendor', 'active', 'ZQZDVFCBoV', '2024-05-27 13:47:03', '2024-05-30 16:52:33');
INSERT INTO `users` VALUES (2, 'Miss Alexanne Ledner', NULL, 'myriam24@example.com', '2024-05-27 13:47:03', '', 'https://via.placeholder.com/60x60.png/00aa99?text=sint', '1-203-685-1324', NULL, '5211 Lessie Isle Apt. 876\nSchoentown, AR 81307', NULL, NULL, NULL, NULL, NULL, 'admin', 'active', 'ZbsXUUAHot', '2024-05-27 13:47:03', '2024-05-27 13:47:03');
INSERT INTO `users` VALUES (3, 'Dr. Hiram Conroy PhD', NULL, 'keanu20@example.net', '2024-05-27 13:47:03', '', 'https://via.placeholder.com/60x60.png/00ff00?text=neque', '936-849-5322', NULL, '36112 Garnett Mountain Apt. 164\nFrankville, WI 21106-4028', NULL, NULL, NULL, NULL, NULL, 'vendor', 'active', '03IC8eGYht', '2024-05-27 13:47:03', '2024-05-30 16:53:03');
INSERT INTO `users` VALUES (4, 'Gladyce Hickle V', NULL, 'orland.koelpin@example.org', '2024-05-27 13:47:03', '', 'https://via.placeholder.com/60x60.png/0099dd?text=sed', '+16782880249', NULL, '63942 Jacobson Prairie Suite 712\nStiedemannville, ID 98475-9788', NULL, NULL, NULL, NULL, NULL, 'user', 'inactive', 'DdjKS5eC6y', '2024-05-27 13:47:03', '2024-05-27 13:47:03');
INSERT INTO `users` VALUES (5, 'Halie Waters', NULL, 'laila.murazik@example.org', '2024-05-27 13:47:03', '', 'https://via.placeholder.com/60x60.png/00ee88?text=qui', '(804) 631-3523', NULL, '5456 Eldridge Underpass\nYvonnebury, WA 29893-5290', NULL, NULL, NULL, NULL, NULL, 'vendor', 'active', 'qKAVgyHJvg', '2024-05-27 13:47:03', '2024-05-30 15:31:09');
INSERT INTO `users` VALUES (6, 'Ms. Tessie Hyatt Jr.', NULL, 'zetta.torphy@example.net', '2024-05-27 13:47:03', '', 'https://via.placeholder.com/60x60.png/005588?text=eligendi', '425.280.4071', NULL, '462 Jacobi Drives Suite 333\nHermistonfort, WV 71335-3061', NULL, NULL, NULL, NULL, NULL, 'vendor', 'active', 'QcbWT5ZscH', '2024-05-27 13:47:03', '2024-05-30 15:54:29');
INSERT INTO `users` VALUES (7, 'Nash Paints', 'vendor', 'vendor@ezimconnect.com', '2024-05-27 13:47:03', '$2y$12$UKWigI4Bcy9txiqdJZN2SOnE4fFNs11hrhbkvjXliSJNB4jsLc7ii', '202405280936favicon-32x32.png', '740-386-9144', '740-386-91', '9094 Medhurst Locks Suite 669Leschchester, MS 23118-2143', '2024', 'We deal with all construction equipment and supplies\r\nWe deal with all construction equipment and supplies', 'www.nashpaints.co.zw', 'www.instagram.com/nashpaints', 'www.facebook.com/nashpaints', 'vendor', 'active', 'erJY1Fh1gwEXPS2enDPgUM73UqGeg7aGUDkFSs5xDPbS8vpOVJ5tnexjVpHH', '2024-05-27 13:47:03', '2024-05-28 11:47:45');
INSERT INTO `users` VALUES (8, 'Dr. Fanny Fahey', 'user', 'user@ezimconnect.com', '2024-05-27 13:47:03', '$2y$12$VBiNZyLynkFLSuxe0v4Vi..4sogPlSs7F4z1qOFW7mhkbBKIi7IqW', 'https://via.placeholder.com/60x60.png/001155?text=aut', '1-618-830-6823', NULL, '5893 Block Drive\nBalistreriville, OR 13238', NULL, NULL, NULL, NULL, NULL, 'user', 'inactive', '1BW5WG4obbXyALRpBfEjyiyXB14JoyqzCuJW7b55hMoU4UsGoAiml05LvOR5', '2024-05-27 13:47:03', '2024-05-27 13:47:03');
INSERT INTO `users` VALUES (9, 'Takunda Geraldino Chibanda', NULL, 'admin@ezimconnect.com', '2024-05-01 08:44:29', '$2y$12$b4ShVNhnEbOdTMXMuUeul.X4sKgYq3FyGey9copZpM90ZHr5BRFX6', '202405280210avatar-8.png', '0459825176', '0459825176', '88A First Avenue', NULL, NULL, 'www.takundachibanda.dev', 'www.instagram.com/tgchibanda', 'www.facebook.com/tgchiband', 'admin', 'active', NULL, '2024-05-27 13:54:48', '2024-05-30 04:55:04');
INSERT INTO `users` VALUES (10, 'Micah Chibanda', 'marblemukarati', 'micah@ezimconnect.com', NULL, '$2y$12$QlOBY3HySAUTcz8XM9DXje6s5rSWEUNXKtOLfINGMR4Bxf9W/aH12', '202405290659chair.png', '0459825176', '0459825176', '88A First Avenue', NULL, NULL, NULL, NULL, NULL, 'user', 'active', NULL, '2024-05-29 02:36:51', '2024-05-29 07:01:19');
INSERT INTO `users` VALUES (11, 'IBR Tiles', NULL, 'ibr@ezimconnect.com', NULL, '$2y$12$G12vWg0kyxOKKxrmt5qmVedyc361zG4eXoB4paJXR19m.eDP2rJLm', NULL, '087677', NULL, NULL, '2024', NULL, NULL, NULL, NULL, 'vendor', 'active', NULL, NULL, '2024-05-31 05:54:19');

-- ----------------------------
-- Table structure for wishlists
-- ----------------------------
DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE `wishlists`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `wishlists_user_id_foreign`(`user_id` ASC) USING BTREE,
  INDEX `wishlists_product_id_foreign`(`product_id` ASC) USING BTREE,
  CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wishlists
-- ----------------------------
INSERT INTO `wishlists` VALUES (3, 8, 7, '2024-06-03 01:22:06', NULL);
INSERT INTO `wishlists` VALUES (4, 8, 8, '2024-06-03 02:28:38', NULL);

SET FOREIGN_KEY_CHECKS = 1;
