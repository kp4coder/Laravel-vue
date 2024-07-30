-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2024 at 05:09 PM
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
-- Database: `laravel_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(4, 'Processor', 'processor', '2024-07-19 01:50:51', '2024-07-19 01:50:51'),
(5, 'RAM', 'ram', '2024-07-19 01:51:09', '2024-07-19 01:51:09'),
(6, 'SSD', 'ssd', '2024-07-19 01:51:19', '2024-07-19 01:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attributes_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attributes_id`, `value`, `created_at`, `updated_at`) VALUES
(3, 5, '4 GB', '2024-07-19 07:59:14', '2024-07-19 07:59:14'),
(4, 5, '2 GB', '2024-07-19 07:59:19', '2024-07-19 07:59:19'),
(5, 5, '6 GB', '2024-07-19 07:59:27', '2024-07-19 07:59:27'),
(6, 5, '8 GB', '2024-07-19 07:59:33', '2024-07-19 07:59:33'),
(7, 5, '16 GB', '2024-07-19 07:59:38', '2024-07-19 07:59:38'),
(8, 6, '120 GB', '2024-07-19 07:59:49', '2024-07-19 07:59:49'),
(9, 6, '240 GB', '2024-07-19 07:59:57', '2024-07-19 07:59:57'),
(10, 6, '500 GB', '2024-07-19 08:00:03', '2024-07-19 08:00:03'),
(11, 6, '1 TB', '2024-07-19 08:00:08', '2024-07-19 08:00:08'),
(12, 4, 'Core i5', '2024-07-19 08:00:30', '2024-07-19 08:00:30'),
(13, 4, 'Core i3', '2024-07-19 08:00:44', '2024-07-19 08:00:44'),
(14, 4, 'Core i7', '2024-07-19 08:00:50', '2024-07-19 08:00:50'),
(15, 4, 'Ryzen 5 Quad Core', '2024-07-19 08:01:07', '2024-07-19 08:01:07'),
(16, 4, 'Ryzen 7 Quad Core', '2024-07-19 08:01:12', '2024-07-19 08:01:12');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `text`, `image`, `created_at`, `updated_at`) VALUES
(3, 'Dell', 'images/brand/1721373565.jpg', '2024-07-19 01:49:25', '2024-07-19 01:49:25'),
(4, 'HP', 'images/brand/1721373572.png', '2024-07-19 01:49:32', '2024-07-19 01:49:32'),
(5, 'Lenovo', 'images/brand/1721373580.png', '2024-07-19 01:49:40', '2024-07-19 01:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `parent_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `parent_category_id`, `created_at`, `updated_at`) VALUES
(4, 'Computer', 'computer', 'images/category/1721373778.png', NULL, '2024-07-19 01:52:58', '2024-07-19 01:53:09'),
(5, 'Laptop', 'latop', 'images/category/1721373834.jpg', 4, '2024-07-19 01:53:54', '2024-07-19 01:53:54'),
(6, 'Mobile', 'mobile', 'images/category/1721394210.jpg', 7, '2024-07-19 07:33:30', '2024-07-19 07:37:54'),
(7, 'Mobiles & Accessories', 'mobiles-accessories', 'images/category/1721394467.jpg', NULL, '2024-07-19 07:37:47', '2024-07-19 07:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `category_attribute`
--

CREATE TABLE `category_attribute` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_attribute`
--

INSERT INTO `category_attribute` (`id`, `category_id`, `attribute_id`, `created_at`, `updated_at`) VALUES
(2, 5, 4, '2024-07-19 07:31:58', '2024-07-19 07:31:58'),
(3, 5, 5, '2024-07-19 07:32:03', '2024-07-19 07:32:03'),
(4, 5, 6, '2024-07-19 07:32:10', '2024-07-19 07:32:10'),
(5, 6, 5, '2024-07-19 07:38:05', '2024-07-19 07:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `text`, `value`, `created_at`, `updated_at`) VALUES
(2, 'red', '#ff0000', '2024-07-15 05:00:35', '2024-07-15 05:00:35'),
(3, 'Green', '#00ff00', '2024-07-19 01:47:49', '2024-07-19 01:47:49'),
(4, 'Blue', '#0000ff', '2024-07-19 01:47:58', '2024-07-19 01:47:58');

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
-- Table structure for table `home_banners`
--

CREATE TABLE `home_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_banners`
--

INSERT INTO `home_banners` (`id`, `text`, `link`, `image`, `created_at`, `updated_at`) VALUES
(8, 'test', 'test.sdf', 'images/homebanner/1721127833.png', '2024-07-16 05:24:28', '2024-07-16 05:33:53');

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
(5, '2024_07_04_115948_create_roles_table', 2),
(6, '2024_07_04_120259_create_user_roles_table', 3),
(8, '2024_07_09_110419_alter_users_table', 4),
(9, '2024_07_09_113655_alter_users_image_table', 5),
(10, '2024_07_11_085151_create_home_banners_table', 6),
(12, '2024_07_15_092927_create_sizes_table', 7),
(13, '2024_07_15_101745_create_colors_table', 8),
(15, '2024_07_15_104759_create_attributes_table', 9),
(16, '2024_07_15_104814_create_attribute_values_table', 9),
(17, '2024_07_15_134448_create_categories_table', 10),
(18, '2024_07_16_100828_create_category_attribute', 11),
(19, '2024_07_18_110232_create_brands_table', 12),
(20, '2024_07_18_112058_create_taxes_table', 13),
(21, '2024_07_18_112804_create_products_table', 14),
(22, '2024_07_18_112844_create_product_attributes_table', 14),
(24, '2024_07_18_112925_create_product_attrs_table', 14),
(25, '2024_07_18_123008_create_product_attr_images_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'API Token', 'c65a7723be7901b3fa8275db87b1ea9e528e89a4b7e3d9ebceef77ae34158a38', '[\"*\"]', NULL, NULL, '2024-07-30 00:42:47', '2024-07-30 00:42:47'),
(2, 'App\\Models\\User', 3, 'API Token', '13737c1317004ecf5bed5d01f4c45dd6097e2ddb92353da086e729796c45c005', '[\"*\"]', NULL, NULL, '2024-07-30 00:46:50', '2024-07-30 00:46:50'),
(3, 'App\\Models\\User', 4, 'API Token', '50becc8188bdd2e87716d531546c28678d849d6ff94f4fb0c390399423b7dcc7', '[\"*\"]', NULL, NULL, '2024-07-30 00:47:51', '2024-07-30 00:47:51'),
(4, 'App\\Models\\User', 5, 'API Token', '60e105da0746542d7d74a4551b5d288e84e9dc6fb565333ade09ad297b2afbb5', '[\"*\"]', NULL, NULL, '2024-07-30 00:49:00', '2024-07-30 00:49:00'),
(6, 'App\\Models\\User', 1, 'API Token', 'fea9476eb0a510eab2f53c500b60a06a1bd774fbe761dc1102039bfe0a7f5802', '[\"*\"]', '2024-07-30 03:08:19', NULL, '2024-07-30 01:19:32', '2024-07-30 03:08:19'),
(7, 'App\\Models\\User', 1, 'API Token', '064ef4f7fef4e9089c50065005ec02f38d012c14592d6b2726949f58abc1e2a1', '[\"*\"]', '2024-07-30 03:09:09', NULL, '2024-07-30 03:08:55', '2024-07-30 03:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `item_code` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `tax_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `image`, `item_code`, `keywords`, `description`, `category_id`, `brand_id`, `tax_id`, `created_at`, `updated_at`) VALUES
(11, 'test1', 'test2', 'images/products/1721727520.jpg', 'test3', 'test4', '<p>descr</p>', 5, 3, 3, '2024-07-23 04:08:40', '2024-07-23 05:24:37'),
(12, 'test name 2', 'slug-2', 'images/products/1721742555.jpg', 'itemcode2', 'keywords2, k3', NULL, 6, 3, 3, '2024-07-23 08:19:15', '2024-07-23 08:19:15'),
(13, 'test3', 'test3', 'images/products/1722244282.png', 'test3', 'tset633', NULL, 5, 3, 4, '2024-07-29 03:41:22', '2024-07-29 03:41:22'),
(14, 'test4', 'test4', 'images/products/1722244579.png', 'test4', 'test4', NULL, 6, 3, 2, '2024-07-29 03:46:19', '2024-07-29 03:46:19'),
(15, 'test5', 'test5', 'images/products/1722244770.png', 'test5', 'test5', '<p>test 654987</p>', 5, 3, 2, '2024-07-29 03:49:30', '2024-07-29 03:49:30'),
(16, 'test6', 'test6', 'images/products/1722245135-mobile-accessories.jpg.jpg', 'test6', 'test6', NULL, 5, 4, 2, '2024-07-29 03:55:35', '2024-07-29 03:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_value_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `category_id`, `attribute_value_id`, `created_at`, `updated_at`) VALUES
(46, 11, 5, 3, '2024-07-23 08:16:42', '2024-07-23 08:16:42'),
(47, 11, 5, 4, '2024-07-23 08:16:42', '2024-07-23 08:16:42'),
(69, 12, 6, 3, '2024-07-23 08:29:35', '2024-07-23 08:29:35'),
(70, 12, 6, 4, '2024-07-23 08:29:35', '2024-07-23 08:29:35'),
(71, 12, 6, 5, '2024-07-23 08:29:35', '2024-07-23 08:29:35'),
(102, 13, 5, 13, '2024-07-29 03:44:29', '2024-07-29 03:44:29'),
(103, 13, 5, 14, '2024-07-29 03:44:29', '2024-07-29 03:44:29'),
(104, 13, 5, 15, '2024-07-29 03:44:29', '2024-07-29 03:44:29'),
(105, 13, 5, 16, '2024-07-29 03:44:29', '2024-07-29 03:44:29'),
(106, 13, 5, 3, '2024-07-29 03:44:29', '2024-07-29 03:44:29'),
(107, 13, 5, 4, '2024-07-29 03:44:29', '2024-07-29 03:44:29'),
(108, 14, 6, 3, '2024-07-29 03:46:19', '2024-07-29 03:46:19'),
(109, 14, 6, 4, '2024-07-29 03:46:19', '2024-07-29 03:46:19'),
(110, 14, 6, 5, '2024-07-29 03:46:19', '2024-07-29 03:46:19'),
(111, 15, 5, 13, '2024-07-29 03:49:30', '2024-07-29 03:49:30'),
(112, 15, 5, 14, '2024-07-29 03:49:30', '2024-07-29 03:49:30'),
(113, 15, 5, 15, '2024-07-29 03:49:30', '2024-07-29 03:49:30'),
(114, 15, 5, 16, '2024-07-29 03:49:30', '2024-07-29 03:49:30'),
(115, 16, 5, 13, '2024-07-29 03:55:35', '2024-07-29 03:55:35'),
(116, 16, 5, 14, '2024-07-29 03:55:35', '2024-07-29 03:55:35'),
(117, 16, 5, 15, '2024-07-29 03:55:35', '2024-07-29 03:55:35'),
(118, 16, 5, 3, '2024-07-29 03:55:35', '2024-07-29 03:55:35'),
(119, 16, 5, 4, '2024-07-29 03:55:35', '2024-07-29 03:55:35'),
(120, 16, 5, 8, '2024-07-29 03:55:35', '2024-07-29 03:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `product_attrs`
--

CREATE TABLE `product_attrs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `mrp` double(8,2) NOT NULL DEFAULT 0.00,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `qty` int(11) NOT NULL DEFAULT 0,
  `len` varchar(255) DEFAULT NULL,
  `breadth` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attrs`
--

INSERT INTO `product_attrs` (`id`, `product_id`, `color_id`, `size_id`, `sku`, `mrp`, `price`, `qty`, `len`, `breadth`, `height`, `weight`, `created_at`, `updated_at`) VALUES
(1, 11, 3, 3, '1', 2.00, 3.00, 4, '5', '6', '7', '8', '2024-07-23 05:24:37', '2024-07-23 05:24:37'),
(2, 11, 2, 4, '11', 22.00, 33.00, 44, '55', '66', '77', '88', '2024-07-23 05:24:37', '2024-07-23 05:24:37'),
(5, 12, 3, 3, 'slug-21', 21.00, 21.00, 1, '5', '6', '7', '9', '2024-07-23 08:19:15', '2024-07-23 08:19:15'),
(6, 12, 4, 4, 'slug-22', 22.00, 22.00, 2, '9', '8', '7', '6', '2024-07-23 08:19:16', '2024-07-23 08:19:16'),
(7, 13, 2, 2, '1', 2.00, 3.00, 4, '5', '6', '7', '8', '2024-07-29 03:41:22', '2024-07-29 03:41:22'),
(8, 13, 3, 3, '22', 33.00, 44.00, 55, '66', '77', '88', '99', '2024-07-29 03:41:22', '2024-07-29 03:41:22'),
(9, 14, 2, 2, '1', 2.00, 3.00, 4, '5', '6', '7', '8', '2024-07-29 03:46:19', '2024-07-29 03:46:19'),
(10, 14, 2, 2, '11', 22.00, 33.00, 44, '55', '66', '77', '88', '2024-07-29 03:46:19', '2024-07-29 03:46:19'),
(11, 15, 2, 2, '1', 2.00, 3.00, 4, '5', '6', '7', '8', '2024-07-29 03:49:30', '2024-07-29 03:49:30'),
(12, 15, 3, 3, '11', 22.00, 33.00, 44, '55', '66', '77', '88', '2024-07-29 03:49:30', '2024-07-29 03:49:30'),
(13, 16, 2, 2, '1', 2.00, 3.00, 4, '5', '6', '7', '8', '2024-07-29 03:55:35', '2024-07-29 03:55:35'),
(14, 16, 3, 3, '12', 23.00, 33.00, 44, '55', '66', '77', '88', '2024-07-29 03:55:36', '2024-07-29 03:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `product_attr_images`
--

CREATE TABLE `product_attr_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_attr_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attr_images`
--

INSERT INTO `product_attr_images` (`id`, `product_id`, `product_attr_id`, `image`, `created_at`, `updated_at`) VALUES
(21, 12, 5, 'images/productsAttr/1721743175.jpg', '2024-07-23 08:29:35', '2024-07-23 08:29:35'),
(34, 13, 8, 'images/productsAttr/1722244470.jpg', '2024-07-29 03:44:30', '2024-07-29 03:44:30'),
(35, 13, 8, 'images/productsAttr/1722244470.png', '2024-07-29 03:44:30', '2024-07-29 03:44:30'),
(36, 14, 9, 'images/productsAttr/1722244579.png', '2024-07-29 03:46:19', '2024-07-29 03:46:19'),
(37, 14, 9, 'images/productsAttr/1722244579.jpg', '2024-07-29 03:46:19', '2024-07-29 03:46:19'),
(38, 14, 10, 'images/productsAttr/1722244579.png', '2024-07-29 03:46:19', '2024-07-29 03:46:19'),
(39, 14, 10, 'images/productsAttr/1722244579.png', '2024-07-29 03:46:19', '2024-07-29 03:46:19'),
(40, 14, 10, 'images/productsAttr/1722244579.jpg', '2024-07-29 03:46:19', '2024-07-29 03:46:19'),
(41, 14, 10, 'images/productsAttr/1722244579.png', '2024-07-29 03:46:19', '2024-07-29 03:46:19'),
(42, 15, 11, 'images/productsAttr/1722244770.png', '2024-07-29 03:49:30', '2024-07-29 03:49:30'),
(43, 15, 11, 'images/productsAttr/1722244770.jpg', '2024-07-29 03:49:30', '2024-07-29 03:49:30'),
(44, 15, 12, 'images/productsAttr/1722244770.png', '2024-07-29 03:49:30', '2024-07-29 03:49:30'),
(45, 15, 12, 'images/productsAttr/1722244770.jpg', '2024-07-29 03:49:30', '2024-07-29 03:49:30'),
(46, 15, 12, 'images/productsAttr/1722244770.png', '2024-07-29 03:49:30', '2024-07-29 03:49:30'),
(47, 16, 13, 'images/productsAttr/1722245135-lenovo.png.png', '2024-07-29 03:55:35', '2024-07-29 03:55:35'),
(48, 16, 13, 'images/productsAttr/1722245135-Screenshot 2022-12-05 200145.jpg.jpg', '2024-07-29 03:55:35', '2024-07-29 03:55:35'),
(49, 16, 13, 'images/productsAttr/1722245136-laptop.jpg.jpg', '2024-07-29 03:55:36', '2024-07-29 03:55:36'),
(50, 16, 14, 'images/productsAttr/1722245136-indian-boy-face-avatar-cartoon-vector-25919486.jpg.jpg', '2024-07-29 03:55:36', '2024-07-29 03:55:36'),
(51, 16, 14, 'images/productsAttr/1722245136-dell.jpg.jpg', '2024-07-29 03:55:36', '2024-07-29 03:55:36'),
(52, 16, 14, 'images/productsAttr/1722245136-car.png.png', '2024-07-29 03:55:36', '2024-07-29 03:55:36'),
(53, 16, 14, 'images/productsAttr/1722245136-hp.png.png', '2024-07-29 03:55:36', '2024-07-29 03:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', NULL, NULL),
(2, 'Customer', 'customer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `text`, `created_at`, `updated_at`) VALUES
(2, 'S', '2024-07-19 01:47:27', '2024-07-19 01:47:27'),
(3, 'M', '2024-07-19 01:47:31', '2024-07-19 01:47:31'),
(4, 'L', '2024-07-19 01:47:35', '2024-07-19 01:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `text`, `created_at`, `updated_at`) VALUES
(2, 18, '2024-07-19 01:54:18', '2024-07-19 01:54:18'),
(3, 15, '2024-07-19 01:54:22', '2024-07-19 01:54:22'),
(4, 12, '2024-07-19 01:54:27', '2024-07-19 01:54:27'),
(5, 10, '2024-07-19 01:54:31', '2024-07-19 01:54:31');

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
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `website_link` varchar(255) DEFAULT NULL,
  `github_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `phone`, `address`, `website_link`, `github_link`, `twitter_link`, `instagram_link`, `facebook_link`, `image`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$Dp4YqdzD.KfUvHEigzctmeyKYbDWZEMju2o0LbDu.338REnxpWsSa', NULL, '234', 'sdfwer', 'website link', 'github link', 'twitter link', 'instagram link', 'facebook link', 'image/admin1720531802.jpg', '2024-07-04 07:01:48', '2024-07-30 03:09:09'),
(6, 'kp-customer', 'kpkamlesh@gmail.com', NULL, '$2y$10$4BaOZm6YzyqC8Mx2rw7eXu6EVsmTQOd219DoqpkUBDM8DSOtpw9fi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-30 00:49:18', '2024-07-30 03:11:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(5, 6, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_values_attributes_id_foreign` (`attributes_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_category_id_foreign` (`parent_category_id`);

--
-- Indexes for table `category_attribute`
--
ALTER TABLE `category_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_attribute_category_id_foreign` (`category_id`),
  ADD KEY `category_attribute_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `home_banners`
--
ALTER TABLE `home_banners`
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
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_tax_id_foreign` (`tax_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attributes_product_id_foreign` (`product_id`),
  ADD KEY `product_attributes_category_id_foreign` (`category_id`),
  ADD KEY `product_attributes_attribute_value_id_foreign` (`attribute_value_id`);

--
-- Indexes for table `product_attrs`
--
ALTER TABLE `product_attrs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attrs_product_id_foreign` (`product_id`),
  ADD KEY `product_attrs_color_id_foreign` (`color_id`),
  ADD KEY `product_attrs_size_id_foreign` (`size_id`);

--
-- Indexes for table `product_attr_images`
--
ALTER TABLE `product_attr_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attr_images_product_id_foreign` (`product_id`),
  ADD KEY `product_attr_images_product_attr_id_foreign` (`product_attr_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_roles_user_id_foreign` (`user_id`),
  ADD KEY `user_roles_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category_attribute`
--
ALTER TABLE `category_attribute`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_banners`
--
ALTER TABLE `home_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `product_attrs`
--
ALTER TABLE `product_attrs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_attr_images`
--
ALTER TABLE `product_attr_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_attributes_id_foreign` FOREIGN KEY (`attributes_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_category_id_foreign` FOREIGN KEY (`parent_category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_attribute`
--
ALTER TABLE `category_attribute`
  ADD CONSTRAINT `category_attribute_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_attribute_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `taxes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_attribute_value_id_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attributes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_attrs`
--
ALTER TABLE `product_attrs`
  ADD CONSTRAINT `product_attrs_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attrs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attrs_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_attr_images`
--
ALTER TABLE `product_attr_images`
  ADD CONSTRAINT `product_attr_images_product_attr_id_foreign` FOREIGN KEY (`product_attr_id`) REFERENCES `product_attrs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attr_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
