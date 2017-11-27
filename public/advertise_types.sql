-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 27, 2017 at 03:34 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `merlplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertise_types`
--

DROP TABLE IF EXISTS `advertise_types`;
CREATE TABLE IF NOT EXISTS `advertise_types` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `width` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advertise_types`
--

INSERT INTO `advertise_types` (`id`, `name`, `slug`, `active`, `width`, `height`, `created_at`, `updated_at`) VALUES
(1, 'Home Top Banner', 'home-top-banner', 1, '728', '90', '2017-08-22 07:44:49', '2017-08-24 07:52:37'),
(2, 'Home Button Banner', 'home-button-banner', 1, '728', '90', '2017-08-24 05:59:32', '2017-08-24 07:57:22'),
(3, 'Home Right Below Top Banner', 'home-right-below-top-banner', 1, '300', '250', '2017-08-24 06:50:49', '2017-08-24 07:58:56'),
(4, 'Home In Category Banner', 'home-in-category-banner', 1, '234', '60', '2017-08-24 06:52:08', '2017-08-24 08:02:01'),
(5, 'By Category On Title Banner', 'by-category-on-title-banner', 1, '88', '31', '2017-08-24 06:55:06', '2017-08-24 08:05:24'),
(6, 'By Category And Single Post Right Side Banner', 'by-category-and-single-post-right-side-banner', 1, '300', '250', '2017-08-24 06:56:17', '2017-08-24 08:13:05'),
(7, 'Google Adsense On Single Post', 'google-adsense-on-single-post', 1, NULL, NULL, '2017-08-24 07:06:50', '2017-08-24 07:06:50'),
(8, 'Google Adsense On Right Single Category', 'google-adsense-on-right-single-category', 1, NULL, NULL, '2017-08-24 07:07:34', '2017-08-24 07:07:34'),
(9, 'Single Post Button Banner', 'single-post-button-banner', 1, '728', '90', '2017-08-24 08:08:08', '2017-08-24 08:08:08'),
(10, 'Home Top New Right Slider Ads', 'home-top-new-right-slider-ads', 1, '300', '250', '2017-08-27 15:24:08', '2017-08-27 15:49:37'),
(11, 'Main Right Side Bar', 'main-right-side-bar', 1, '336', '280', '2017-09-13 07:23:00', '2017-09-13 07:23:00'),
(12, 'Popup Ads 720x300', 'popup-ads-720x300', 1, '720', '300', '2017-11-27 04:47:23', '2017-11-27 04:47:23'),
(13, 'Popup Ads 468x60', 'popup-ads-468x60', 1, '468', '60', '2017-11-27 04:47:55', '2017-11-27 04:47:55'),
(14, 'Popup Ads 234x60', 'popup-ads-234x60', 1, '234', '60', '2017-11-27 04:49:04', '2017-11-27 04:49:04');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
