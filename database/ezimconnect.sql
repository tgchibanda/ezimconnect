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

 Date: 06/06/2024 22:18:02
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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of banners
-- ----------------------------
INSERT INTO `banners` VALUES (1, 'Strong Foundations, Exceptional Quality Bricks', '/', 'upload/banners/1801089010833667.png', NULL, '2024-06-06 05:38:51');
INSERT INTO `banners` VALUES (3, 'Enhance Elegance <br>with Quality <br>Wooden Doors', '/', 'upload/banners/1801089050732298.png', NULL, '2024-06-06 05:47:42');
INSERT INTO `banners` VALUES (4, 'Luxurious Comfort with Premium Bath Tubs', '/', 'upload/banners/1801089082718644.png', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of brands
-- ----------------------------
INSERT INTO `brands` VALUES (5, 'Leviton', 'leviton', 'upload/brand/1800463357448440.jpeg', NULL, '2024-05-31 05:52:27');
INSERT INTO `brands` VALUES (6, 'Siemens', 'siemens', 'upload/brand/1800546305031751.png', NULL, NULL);
INSERT INTO `brands` VALUES (7, 'No Brand Name', 'no-brand-name', 'upload/brand/1801099402455958.jpg', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cart_items
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'Interior', 'interior', 'upload/category/1801074596383109.jpg', '2024-05-31 01:51:49', '2024-06-06 05:48:44');
INSERT INTO `categories` VALUES (2, 'Roofing', 'roofing', 'upload/category/1801081251850472.jpg', NULL, '2024-06-06 03:35:31');
INSERT INTO `categories` VALUES (3, 'Foundation', 'foundation', 'upload/category/1801081137331312.jpg', '2024-05-31 01:49:52', '2024-06-06 03:33:42');
INSERT INTO `categories` VALUES (4, 'Framing', 'framing', 'upload/category/1801080936732365.jpg', '2024-05-31 01:50:04', '2024-06-06 03:30:31');
INSERT INTO `categories` VALUES (5, 'Exterior', 'exterior', 'upload/category/1801074837070212.jpg', '2024-05-31 01:50:45', '2024-06-06 01:56:14');
INSERT INTO `categories` VALUES (7, 'Electrical', 'electrical', 'upload/category/1801074472473266.jpg', '2024-05-31 01:51:12', '2024-06-06 01:47:46');
INSERT INTO `categories` VALUES (10, 'Kitchen', 'kitchen', 'upload/category/1801074290661285.jpg', '2024-05-31 01:52:00', '2024-06-06 01:44:53');
INSERT INTO `categories` VALUES (11, 'Bathrooms', 'bathrooms', 'upload/category/1801074166290077.jpg', '2024-05-31 01:52:15', '2024-06-06 01:42:54');
INSERT INTO `categories` VALUES (12, 'Landscaping', 'landscaping', 'upload/category/1801074060926186.jpg', '2024-05-31 01:52:27', '2024-06-06 01:41:14');
INSERT INTO `categories` VALUES (16, 'Utilities', 'utilities', 'upload/category/1801074945456961.jpg', '2024-05-31 01:53:49', '2024-06-06 01:55:17');
INSERT INTO `categories` VALUES (17, 'Security', 'security', 'upload/category/1801113251358198.jpg', '2024-06-06 12:04:08', '2024-06-06 12:04:08');

-- ----------------------------
-- Table structure for checkout_order_items
-- ----------------------------
DROP TABLE IF EXISTS `checkout_order_items`;
CREATE TABLE `checkout_order_items`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `vendor_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `qty` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `checkout_order_items_order_id_foreign`(`order_id` ASC) USING BTREE,
  CONSTRAINT `checkout_order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of checkout_order_items
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of compares
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of coupons
-- ----------------------------
INSERT INTO `coupons` VALUES (1, 'TAMAE', 10, '2024-06-04', 1, '2024-06-03 13:18:22', '2024-06-03 13:18:22');

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
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `migrations` VALUES (35, '2024_06_04_014154_create_orders_table', 16);
INSERT INTO `migrations` VALUES (36, '2024_06_04_014223_create_checkout_order_items_table', 16);

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
) ENGINE = InnoDB AUTO_INCREMENT = 62 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of multi_imgs
-- ----------------------------
INSERT INTO `multi_imgs` VALUES (32, 9, 'upload/products/multi-image/1801099337936482.png', NULL, NULL, NULL, '2024-06-06 08:23:00', NULL);
INSERT INTO `multi_imgs` VALUES (33, 9, 'upload/products/multi-image/1801099338210481.png', NULL, NULL, NULL, '2024-06-06 08:23:00', NULL);
INSERT INTO `multi_imgs` VALUES (34, 11, 'upload/products/multi-image/1801100695805991.png', NULL, NULL, NULL, '2024-06-06 08:44:35', NULL);
INSERT INTO `multi_imgs` VALUES (35, 13, 'upload/products/multi-image/1801101596852784.png', NULL, NULL, NULL, '2024-06-06 08:58:54', NULL);
INSERT INTO `multi_imgs` VALUES (36, 14, 'upload/products/multi-image/1801102487078271.png', NULL, NULL, NULL, '2024-06-06 09:13:03', NULL);
INSERT INTO `multi_imgs` VALUES (37, 15, 'upload/products/multi-image/1801102926367512.png', NULL, NULL, NULL, '2024-06-06 09:20:02', NULL);
INSERT INTO `multi_imgs` VALUES (38, 16, 'upload/products/multi-image/1801103373774143.png', NULL, NULL, NULL, '2024-06-06 09:27:09', NULL);
INSERT INTO `multi_imgs` VALUES (39, 17, 'upload/products/multi-image/1801103759810346.png', NULL, NULL, NULL, '2024-06-06 09:33:17', NULL);
INSERT INTO `multi_imgs` VALUES (40, 18, 'upload/products/multi-image/1801103902822539.png', NULL, NULL, NULL, '2024-06-06 09:35:33', NULL);
INSERT INTO `multi_imgs` VALUES (41, 19, 'upload/products/multi-image/1801104274102296.png', NULL, NULL, NULL, '2024-06-06 09:41:27', NULL);
INSERT INTO `multi_imgs` VALUES (42, 20, 'upload/products/multi-image/1801104447196235.png', NULL, NULL, NULL, '2024-06-06 09:44:12', NULL);
INSERT INTO `multi_imgs` VALUES (43, 19, 'upload/products/multi-image/manually_added.png', NULL, NULL, NULL, '2024-06-06 19:49:34', NULL);
INSERT INTO `multi_imgs` VALUES (44, 21, 'upload/products/multi-image/1801104986956587.png', NULL, NULL, NULL, '2024-06-06 09:52:47', NULL);
INSERT INTO `multi_imgs` VALUES (45, 22, 'upload/products/multi-image/1801105167503168.png', NULL, NULL, NULL, '2024-06-06 09:55:39', NULL);
INSERT INTO `multi_imgs` VALUES (46, 23, 'upload/products/multi-image/1801105321984706.png', NULL, NULL, NULL, '2024-06-06 09:58:07', NULL);
INSERT INTO `multi_imgs` VALUES (47, 24, 'upload/products/multi-image/1801105516276187.png', NULL, NULL, NULL, '2024-06-06 10:01:12', NULL);
INSERT INTO `multi_imgs` VALUES (48, 25, 'upload/products/multi-image/1801105658622878.png', NULL, NULL, NULL, '2024-06-06 10:03:28', NULL);
INSERT INTO `multi_imgs` VALUES (49, 26, 'upload/products/multi-image/1801105835975503.png', NULL, NULL, NULL, '2024-06-06 10:06:17', NULL);
INSERT INTO `multi_imgs` VALUES (50, 27, 'upload/products/multi-image/1801106000506032.png', NULL, NULL, NULL, '2024-06-06 10:08:54', NULL);
INSERT INTO `multi_imgs` VALUES (51, 28, 'upload/products/multi-image/1801106118892932.png', NULL, NULL, NULL, '2024-06-06 10:10:47', NULL);
INSERT INTO `multi_imgs` VALUES (52, 29, 'upload/products/multi-image/1801106240055876.png', NULL, NULL, NULL, '2024-06-06 10:12:42', NULL);
INSERT INTO `multi_imgs` VALUES (53, 30, 'upload/products/multi-image/1801106363051257.png', NULL, NULL, NULL, '2024-06-06 10:14:39', NULL);
INSERT INTO `multi_imgs` VALUES (54, 31, 'upload/products/multi-image/1801106586114690.png', NULL, NULL, NULL, '2024-06-06 10:18:12', NULL);
INSERT INTO `multi_imgs` VALUES (55, 32, 'upload/products/multi-image/1801106774099295.png', NULL, NULL, NULL, '2024-06-06 10:21:11', NULL);
INSERT INTO `multi_imgs` VALUES (56, 33, 'upload/products/multi-image/1801106874868184.png', NULL, NULL, NULL, '2024-06-06 10:22:48', NULL);
INSERT INTO `multi_imgs` VALUES (57, 9, 'upload/products/multi-image/folding_door.png', NULL, NULL, NULL, '2024-06-06 20:28:45', NULL);
INSERT INTO `multi_imgs` VALUES (58, 34, 'upload/products/multi-image/1801107973135205.png', NULL, NULL, NULL, '2024-06-06 10:40:15', NULL);
INSERT INTO `multi_imgs` VALUES (59, 35, 'upload/products/multi-image/1801108364359005.png', NULL, NULL, NULL, '2024-06-06 10:46:28', NULL);
INSERT INTO `multi_imgs` VALUES (60, 36, 'upload/products/multi-image/1801109009767354.png', NULL, NULL, NULL, '2024-06-06 10:56:43', NULL);
INSERT INTO `multi_imgs` VALUES (61, 37, 'upload/products/multi-image/1801109159898237.png', NULL, NULL, NULL, '2024-06-06 10:59:07', NULL);

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `division_id` bigint UNSIGNED NOT NULL,
  `district_id` bigint UNSIGNED NOT NULL,
  `state_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `post_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` float NOT NULL,
  `order_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `invoice_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmed_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `processing_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `picked_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `shipped_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `delivered_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cancel_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `return_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `return_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (9, 7, 5, 40, 'Folding', 'folding', 'midlands-al-01', '100', 'new product,top product', NULL, NULL, '1300', NULL, 'This is made from aluminium', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801099337712592.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 08:47:32', '2024-06-06 08:47:32');
INSERT INTO `products` VALUES (10, 7, 5, 40, 'Double hinged door', 'double-hinged-door', 'midlands-al-02', '100', 'new product,top product', '1.3m', NULL, '500', NULL, 'Double hinged aluminium door', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801100648944067.png', 12, 1, 1, 1, 1, 1, NULL, NULL, '2024-06-06 08:46:17', '2024-06-06 08:43:50', '2024-06-06 08:46:17');
INSERT INTO `products` VALUES (11, 7, 5, 40, 'Double hinged door', 'double-hinged-door', 'midlands-al-02', '100', 'new product,top product', '1.3m', NULL, '500', NULL, 'Double hinged aluminium door', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801100695625040.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 08:47:06', '2024-06-06 08:47:06');
INSERT INTO `products` VALUES (13, 7, 5, 40, 'Galaxy single slide door', 'galaxy-single-slide-door', 'midlands-al-03', '100', 'new product,top product', '3m', NULL, '950', NULL, '3m folding', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801101596454381.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 09:09:19', '2024-06-06 09:09:19');
INSERT INTO `products` VALUES (14, 7, 5, 40, 'Galaxy single slide door', 'galaxy-single-slide-door', 'midlands-al-04', '100', 'new product,top product', '2.5m', NULL, '800', NULL, 'Galaxy single slide door', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801102486651037.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 09:13:03', NULL);
INSERT INTO `products` VALUES (15, 7, 5, 40, 'Window Frame with glass', 'window-frame-with-glass', 'midlands-al-05', '100', 'new product,top product', '2.50m x 1.50m', 'Red,Blue,Black', '300', NULL, 'Window frame with glass', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801102925951995.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 11:40:57', '2024-06-06 11:40:57');
INSERT INTO `products` VALUES (16, 7, 5, 40, 'Hinged door', 'hinged-door', 'midlands-al-06', '100', 'new product,top product', '1.3m', NULL, '500', NULL, 'Hinged door', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801103373490742.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 09:27:08', NULL);
INSERT INTO `products` VALUES (17, 7, 5, 40, 'Galaxy slide door', 'galaxy-slide-door', 'midlands-al-07', '100', 'new product,top product', '3m', NULL, '850', NULL, 'Galaxy slide door', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801103759574446.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 09:33:16', NULL);
INSERT INTO `products` VALUES (18, 7, 5, 40, 'Hinged door', 'hinged-door', 'midlands-al-08', '100', 'new product,top product', '1.5m', 'Red,Blue,Black', '550', NULL, 'Dinged door', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801103902403278.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 09:35:33', NULL);
INSERT INTO `products` VALUES (19, 7, 5, 40, 'Patio sliding door', 'patio-sliding-door', 'midlands-al-09', '100', 'new product,top product', '4m', NULL, '600', NULL, 'Patio sliding door', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801104273599231.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 09:41:27', NULL);
INSERT INTO `products` VALUES (20, 7, 5, 40, 'Hinged door', 'hinged-door', 'midlands-al-09', '100', 'new product,top product', '1m', NULL, '480', NULL, 'Hinged door', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801104446803216.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 09:44:12', NULL);
INSERT INTO `products` VALUES (21, 7, 5, 40, 'Stable door', 'stable-door', 'midlands-al-10', '100', 'new product,top product', NULL, NULL, '450', NULL, 'Stable door', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801104986496994.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 09:52:47', NULL);
INSERT INTO `products` VALUES (22, 7, 5, 40, 'Galaxy slide door', 'galaxy-slide-door', 'midlands-al-11', '100', 'new product,top product', '4m', NULL, '950', NULL, 'Galaxy slide door', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801105167170755.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 09:55:39', NULL);
INSERT INTO `products` VALUES (23, 7, 5, 40, 'Kitchen door', 'kitchen-door', 'midlands-al-12', '100', 'new product,top product', NULL, NULL, '450', NULL, 'Kitchen door', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801105321641612.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 09:58:06', NULL);
INSERT INTO `products` VALUES (24, 7, 5, 40, 'Hinged door', 'hinged-door', 'midlands-al-13', '100', 'new product,top product', NULL, NULL, '450', NULL, 'Hinged door', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801105515591594.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 10:01:11', NULL);
INSERT INTO `products` VALUES (25, 7, 5, 40, 'Folding door', 'folding-door', 'midlands-al-14', '100', 'new product,top product', '2.4', NULL, '850', NULL, 'Folding door', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801105658231217.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 10:03:27', NULL);
INSERT INTO `products` VALUES (26, 7, 5, 40, 'Pivot door', 'pivot-door', 'midlands-al-15', '100', 'new product,top product', '2.5', NULL, '950', NULL, 'Pivot door', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801105835677796.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 10:06:16', NULL);
INSERT INTO `products` VALUES (27, 7, 5, 40, 'Shower cubicle', 'shower-cubicle', 'midlands-al-16', '100', 'new product,top product', NULL, NULL, '300', NULL, 'Shower cubicle', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801106000281466.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 12:06:24', '2024-06-06 12:06:24');
INSERT INTO `products` VALUES (28, 7, 5, 40, 'Hinged door', 'hinged-door', 'midlands-al-17', '100', 'new product,top product', '1.5', NULL, '550', NULL, 'Hinged door', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801106118573907.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 10:10:46', NULL);
INSERT INTO `products` VALUES (29, 7, 5, 40, 'Treli burglars', 'treli-burglars', 'midlands-al-18', '100', 'new product,top product', '3m', NULL, '700', NULL, 'Treli burglars', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801106239691645.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 12:05:02', '2024-06-06 12:05:02');
INSERT INTO `products` VALUES (30, 7, 5, 40, 'Cubicle', 'cubicle', 'midlands-al-19', '100', 'new product,top product', NULL, NULL, '300', NULL, 'Cubicle', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801106362749636.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 11:51:43', '2024-06-06 11:51:43');
INSERT INTO `products` VALUES (31, 7, 5, 40, 'Window Frame with glass', 'window-frame-with-glass', 'midlands-al-20', '100', 'new product,top product', '1.5m x 1.2m', 'Red,Blue,Black', '150', NULL, 'Window frame with glass', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801106585820683.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 10:18:12', NULL);
INSERT INTO `products` VALUES (32, 7, 5, 40, 'Stable door', 'stable-door', 'midlands-al-21', '100', 'new product,top product', NULL, NULL, '450', NULL, 'Stable door', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801106773886912.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 10:21:11', NULL);
INSERT INTO `products` VALUES (33, 7, 5, 40, 'Hinged door with Acre', 'hinged-door-with-acre', 'midlands-al-22', '100', 'new product,top product', NULL, NULL, '500', NULL, 'Hinged door with Acre', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801106874558036.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 10:22:47', NULL);
INSERT INTO `products` VALUES (34, 7, 5, 40, 'Folding', 'folding', 'midlands-al-23', '100', 'new product,top product', '3.5', 'Red,Blue,Black', '1000', NULL, 'Folding', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801107972660209.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 10:40:15', NULL);
INSERT INTO `products` VALUES (35, 7, 5, 40, 'Shower cubicle', 'shower-cubicle', 'midlands-al-24', '100', 'new product,top product', NULL, NULL, '250', NULL, 'Shower cubicle', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801108364053715.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 11:51:14', '2024-06-06 11:51:14');
INSERT INTO `products` VALUES (36, 7, 5, 40, 'Folding', 'folding', 'midlands-al-25', '100', 'new product,top product', '3m', NULL, '950', NULL, 'Folding 3m', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801109008925672.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 10:56:43', NULL);
INSERT INTO `products` VALUES (37, 7, 5, 40, 'Standard hinged door', 'standard-hinged-door', 'midlands-al-26', '100', 'new product,top product', NULL, NULL, '430', NULL, 'Standard hinged door', '<p>Hello, World!</p>', 'upload/products/thumbnail/1801109159696330.png', 12, 1, 1, 1, 1, 1, NULL, NULL, NULL, '2024-06-06 10:59:06', NULL);

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
INSERT INTO `sessions` VALUES ('aOG5lH2ZTlGwEHkmlV9ujzUeUUGfcjsRO1D2oIGR', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUkJCeXRBWXFFdGhLbTdaakI0V2V4N2tWYzc0aDlLN2p2dlZzTFd0dCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vbG9jYWxob3N0OjgwMDAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo5O30=', 1717675656);
INSERT INTO `sessions` VALUES ('KBGw1D3fAJYu8qjRy8w4Q2md3E5h5xiWeCI1DQYD', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidHlBeGN0MWdJQUtzTFhpYllyVnJYclZ2bGdtZTcwazRFZm9kcEJFdCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hbGwvcHJvZHVjdHMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMjt9', 1717671547);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ship_districts
-- ----------------------------
INSERT INTO `ship_districts` VALUES (1, 2, 'Gweru - 054', '2024-06-03 11:43:50', '2024-06-03 12:00:49');
INSERT INTO `ship_districts` VALUES (3, 2, 'Kwekwe', '2024-06-03 15:39:30', '2024-06-03 15:39:30');

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ship_states
-- ----------------------------
INSERT INTO `ship_states` VALUES (1, 2, 1, 'Northlea', '2024-06-03 12:38:29', '2024-06-03 12:46:57');
INSERT INTO `ship_states` VALUES (3, 2, 1, 'Mkoba', '2024-06-03 15:38:47', '2024-06-03 15:38:47');

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
INSERT INTO `sliders` VALUES (1, 'Don\'t miss amazing <br /> Deals', 'Search through all suppliers', 'upload/sliders/1801083340771908.png', NULL, '2024-06-06 04:09:53');
INSERT INTO `sliders` VALUES (2, 'Discover Incredible <br />Discounts', 'Build Better, Save More!', 'upload/sliders/1801083906541340.png', NULL, '2024-06-06 04:20:02');

-- ----------------------------
-- Table structure for sub_categories
-- ----------------------------
DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE `sub_categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint NOT NULL,
  `subcategory_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `category_id`(`category_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 65 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `sub_categories` VALUES (45, 7, 'Wiring', 'wiring', NULL, NULL);
INSERT INTO `sub_categories` VALUES (46, 7, 'Panels and Circuit Breakers', 'panels-and-circuit-breakers', NULL, NULL);
INSERT INTO `sub_categories` VALUES (47, 7, 'Lighting', 'lighting', NULL, NULL);
INSERT INTO `sub_categories` VALUES (48, 7, 'Outlets and Switches', 'outlets-and-switches', NULL, NULL);
INSERT INTO `sub_categories` VALUES (49, 7, 'Solar', 'solar', '2024-05-31 02:25:56', '2024-05-31 02:25:56');
INSERT INTO `sub_categories` VALUES (54, 1, 'Drywall', 'drywall', NULL, NULL);
INSERT INTO `sub_categories` VALUES (55, 1, 'Painting', 'painting', NULL, NULL);
INSERT INTO `sub_categories` VALUES (56, 1, 'Trim and Molding', 'trim-and-molding', NULL, NULL);
INSERT INTO `sub_categories` VALUES (57, 1, 'Flooring', 'flooring', NULL, NULL);
INSERT INTO `sub_categories` VALUES (58, 10, 'Cabinets', 'cabinets', NULL, NULL);
INSERT INTO `sub_categories` VALUES (59, 10, 'Countertops', 'countertops', NULL, NULL);
INSERT INTO `sub_categories` VALUES (60, 10, 'Appliances', 'appliances', NULL, NULL);
INSERT INTO `sub_categories` VALUES (61, 10, 'Plumbing Fixtures', 'plumbing-fixtures', NULL, NULL);
INSERT INTO `sub_categories` VALUES (62, 4, 'Aluminium Framing', 'aluminium-framing', '2024-06-06 08:45:02', '2024-06-06 08:45:33');
INSERT INTO `sub_categories` VALUES (63, 5, 'Gates', 'gates', '2024-06-06 11:54:22', '2024-06-06 11:54:22');
INSERT INTO `sub_categories` VALUES (64, 17, 'Burglars', 'burglars', '2024-06-06 12:04:51', '2024-06-06 12:04:51');

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
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (9, 'Takunda Geraldino Chibanda', 'tk', 'admin@ezimconnect.com', '2024-05-01 08:44:29', '$2y$12$b4ShVNhnEbOdTMXMuUeul.X4sKgYq3FyGey9copZpM90ZHr5BRFX6', '202405280210avatar-8.png', '0459825176', NULL, '88A First Avenued', NULL, NULL, NULL, NULL, NULL, 'admin', 'active', NULL, '2024-05-27 13:54:48', '2024-06-04 12:18:35');
INSERT INTO `users` VALUES (10, 'Micah Chibanda', 'marblemukarati', 'micah@ezimconnect.com', NULL, '$2y$12$QlOBY3HySAUTcz8XM9DXje6s5rSWEUNXKtOLfINGMR4Bxf9W/aH12', '202405290659chair.png', '0459825176', '0459825176', '88A First Avenue', NULL, NULL, NULL, NULL, NULL, 'user', 'active', NULL, '2024-05-29 02:36:51', '2024-05-29 07:01:19');
INSERT INTO `users` VALUES (12, 'Midlands Aluminium & Projects', NULL, 'midlandsaluminium@gmail.com', NULL, '$2y$12$vSMlTFPwOLTX1tIBvZt.IuNL12W3MO52j.b8vgGcE1HCQRepvrVEO', '202406060815WhatsApp Image 2024-06-06 at 5.56.20 PM (2).jpeg', '0773 343 223', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'vendor', 'active', NULL, NULL, '2024-06-06 08:15:00');

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
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wishlists
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
