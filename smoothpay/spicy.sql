-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 28, 2019 at 08:20 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spicy`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Ethiopia'),
(2, 'Meat'),
(3, 'Beef'),
(4, 'Chili pepper'),
(5, 'Peru'),
(6, 'China'),
(7, 'Fish'),
(8, 'Tofu'),
(9, 'Sichuan pepper'),
(10, 'Potato'),
(11, 'Yellow Chili pepper');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `sku`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Sik Sik Wat', 'Ethiopia, Meat, Beef, Chili pepper', 'DISH999ABCD', '13.49', '2019-08-28 14:18:33', '2019-08-28 14:18:33'),
(2, 'Huo Guo', 'China, Meat, Beef, Fish, Tofu, Sichuan pepper', 'DISH234ZFDR', '11.99', '2019-08-28 14:18:33', '2019-08-28 14:18:33'),
(3, 'Cau-Cau', 'Peru, Potato, Yellow Chili pepper', 'DISH775TGHY', '15.29', '2019-08-28 14:18:33', '2019-08-28 14:18:33'),
(4, 'Sik Sik Wat', 'Ethiopia, Meat, Beef, Chili pepper', 'DISH999ABCD', '13.49', '2019-08-28 14:18:33', '2019-08-28 14:18:33'),
(5, 'Huo Guo', 'China, Meat, Beef, Fish, Tofu, Sichuan pepper', 'DISH234ZFDR', '11.99', '2019-08-28 14:18:33', '2019-08-28 14:18:33'),
(6, 'Cau-Cau', 'Peru, Potato, Yellow Chili pepper', 'DISH775TGHY', '15.29', '2019-08-28 14:18:33', '2019-08-28 14:18:33'),
(9, 'ff', 'bb', 'CC', '10.25', '2019-08-28 14:51:59', '2019-08-28 15:00:35');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
