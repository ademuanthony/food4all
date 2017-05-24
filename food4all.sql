-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2017 at 04:12 PM
-- Server version: 5.6.16
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `food4all`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `street1` varchar(265) COLLATE utf8_unicode_ci NOT NULL,
  `street2` varchar(265) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1EFB23CF8BAC62AF` (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `auths`
--

CREATE TABLE IF NOT EXISTS `auths` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `password` varchar(265) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '1',
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `auths`
--

INSERT INTO `auths` (`id`, `username`, `email`, `status`, `password`, `role`, `last_login`) VALUES
(7, 'food4all', 'food4all@gmail.com', 1, 'e6b9bc016bb8561303da3fa997d93fba', 2, '2017-05-01 22:44:16'),
(8, 'tony', 'ademuanthony@gmail.com', 1, ' 994c81a2f5590a5633ea6c5f2fde74 23', 1, '2017-01-07 18:06:12'),
(9, 'ademu', 'ademu@gmail.com', 1, ' 994c81a2f5590a5633ea6c5f2fde74 23', 1, '2017-01-11 05:50:43'),
(10, 'Walter75', 'walter.adesa@yahoo.com', 1, '994c81a2f5590a5633ea6c5f2fde7423', 1, '2017-04-25 18:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `bankdetails`
--

CREATE TABLE IF NOT EXISTS `bankdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) unsigned DEFAULT NULL,
  `bank_name` varchar(191) DEFAULT NULL,
  `account_name` varchar(191) DEFAULT NULL,
  `account_number` int(11) unsigned DEFAULT NULL,
  `branch_name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_bankdetails_ memeber` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE IF NOT EXISTS `campaigns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `title`, `content`, `image`) VALUES
(1, 'Campaign One', 'This is the content of the campaign', 'Campaign_One.jpg'),
(2, 'Campaign Two', 'The content of the campaign', 'Campaign_Two.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D95DB16B5D83CC1` (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `short_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

CREATE TABLE IF NOT EXISTS `earnings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(265) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `food_percentage` int(11) NOT NULL,
  `cash_percentage` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `event` varchar(265) NOT NULL,
  `ref` varchar(265) NOT NULL,
  `status` int(11) NOT NULL,
  `narration` varchar(265) NOT NULL,
  `stage_of_availability` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `earnings`
--

INSERT INTO `earnings` (`id`, `member_id`, `amount`, `food_percentage`, `cash_percentage`, `date`, `event`, `ref`, `status`, `narration`, `stage_of_availability`) VALUES
(1, 'S01C4RXY', '5500', 0, 100, '2017-01-07 18:01:14', 'registration', '', 1, 'nothing', 1),
(2, 'S01C4RXY', '1500', 100, 0, '2017-01-07 18:06:12', 'referral', 'S86NCYES3H', 1, 'registration', 0),
(25, 'S01C4RXY', '1500', 30, 70, '2017-01-11 05:50:43', 'referral', '56USPROTCE', 1, 'registration', 0),
(26, 'S01C4RXY', '12500', 30, 70, '2017-04-25 18:01:41', 'referral', 'OVFGZNT4TL', 1, 'registration', 0);

-- --------------------------------------------------------

--
-- Table structure for table `genealogies`
--

CREATE TABLE IF NOT EXISTS `genealogies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_id` varchar(50) NOT NULL,
  `level_id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `genealogies`
--

INSERT INTO `genealogies` (`id`, `membership_id`, `level_id`, `stage_id`) VALUES
(1, 'S01C4RXY', 2, 1),
(2, 'S86NCYES3H', 1, 1),
(26, '56USPROTCE', 1, 1),
(27, 'OVFGZNT4TL', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `matriceslevel`
--

CREATE TABLE IF NOT EXISTS `matriceslevel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stage_id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `number` int(11) NOT NULL,
  `block` int(11) NOT NULL,
  `complete_line_up` int(11) NOT NULL,
  `prize` decimal(10,0) NOT NULL,
  `matching_bonus_percentage` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `matriceslevel`
--

INSERT INTO `matriceslevel` (`id`, `stage_id`, `label`, `number`, `block`, `complete_line_up`, `prize`, `matching_bonus_percentage`) VALUES
(1, 1, 'Level 1', 1, 1, 2, '0', 0),
(2, 1, 'Level 2', 2, 2, 4, '0', 0),
(3, 2, 'Level 1', 1, 3, 8, '0', 0),
(4, 2, 'Level 2', 2, 4, 16, '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `matricesstage`
--

CREATE TABLE IF NOT EXISTS `matricesstage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `block` int(11) NOT NULL,
  `complete_line_up` int(11) NOT NULL,
  `prize` decimal(10,0) NOT NULL,
  `matching_bonus_percentage` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `matricesstage`
--

INSERT INTO `matricesstage` (`id`, `number`, `label`, `block`, `complete_line_up`, `prize`, `matching_bonus_percentage`) VALUES
(1, 1, 'Stage 1', 2, 4, '10', 0),
(2, 2, 'Stage 2', 4, 16, '15', 5),
(3, 3, 'Stage 3', 4, 16, '25', 3);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_id` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `parent_id` varchar(200) NOT NULL,
  `sponsor_id` varchar(200) NOT NULL,
  `level` int(11) NOT NULL,
  `left_index` int(11) NOT NULL,
  `right_index` int(11) NOT NULL,
  `registration_pin` varchar(200) NOT NULL,
  `stage` varchar(200) NOT NULL,
  `firstname` varchar(250) DEFAULT NULL,
  `lastname` varchar(250) DEFAULT NULL,
  `profile_image` varchar(256) NOT NULL,
  `phonenumber` varchar(250) DEFAULT NULL,
  `sex` varchar(250) DEFAULT NULL,
  `dob` varchar(250) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `nameofkin` varchar(250) DEFAULT NULL,
  `transaction_password` varchar(250) DEFAULT NULL,
  `nextofkinaddress` varchar(250) DEFAULT NULL,
  `kinrelationship` varchar(250) DEFAULT NULL,
  `phonenumberofkin` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `email_address` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `membership_id`, `username`, `parent_id`, `sponsor_id`, `level`, `left_index`, `right_index`, `registration_pin`, `stage`, `firstname`, `lastname`, `profile_image`, `phonenumber`, `sex`, `dob`, `country`, `state`, `city`, `address`, `nameofkin`, `transaction_password`, `nextofkinaddress`, `kinrelationship`, `phonenumberofkin`, `status`, `email_address`) VALUES
(1, 'S01C4RXY', 'food4all', '', '', 1, 1, 8, '08998989', '1', 'Food', 'For All', 'baby.jpg', '08035146243', 'Female', '2016-09-25', 'Nigeria', 'Kogi', 'Imane', 'Imane', 'Ademu Anthoy E', '1234', '20 Sora Ogumakin, Iyana-Ikpaja', 'My Bother', '08035146243', 1, 'blenyo11@gmail.com'),
(2, 'S86NCYES3H', 'tony', 'S01C4RXY', 'S01C4RXY', 2, 2, 5, '846435', '1', NULL, NULL, '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ademuanthony@gmail.com'),
(28, '56USPROTCE', 'ademu', 'S01C4RXY', 'S01C4RXY', 2, 6, 7, '178887', '1', NULL, NULL, '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ademu@gmail.com'),
(29, 'OVFGZNT4TL', 'Walter75', 'S86NCYES3H', 'S01C4RXY', 3, 3, 4, '682623', '1', NULL, NULL, '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'walter.adesa@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `members_matrixes`
--

CREATE TABLE IF NOT EXISTS `members_matrixes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_id` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rght` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` datetime NOT NULL,
  `member_id` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `date`, `member_id`, `status`) VALUES
(1, 'Account Credited', 'You have been credited with 15 from referral', '2017-01-07 18:06:12', 'S01C4RXY', 7),
(3, 'Account Credited', 'You have been credited with 100 from fund transfer', '2017-01-07 18:41:35', 'S86NCYES3H', 6),
(26, 'Account Credited', 'You have been credited with 15 from referral', '2017-01-11 05:50:43', 'S01C4RXY', 7),
(27, 'Account Credited', 'You have been credited with 20 from fund transfer', '2017-03-21 12:41:00', 'S86NCYES3H', 6),
(28, 'Account Credited', 'You have been credited with 20 from fund transfer', '2017-03-21 12:44:02', 'S86NCYES3H', 6),
(29, 'Account Credited', 'You have been credited with 10 from fund transfer', '2017-03-21 12:44:22', 'S86NCYES3H', 6),
(30, 'Account Credited', 'You have been credited with 1240 from referral', '2017-04-25 18:01:41', 'S01C4RXY', 7);

-- --------------------------------------------------------

--
-- Table structure for table `registrationpins`
--

CREATE TABLE IF NOT EXISTS `registrationpins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial_number` varchar(265) NOT NULL,
  `pin` varchar(265) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `registrationpins`
--

INSERT INTO `registrationpins` (`id`, `serial_number`, `pin`, `status`) VALUES
(1, '0000000001', '846435', 3),
(2, '0000000002', '178887', 3),
(3, '0000000003', '682623', 3),
(4, '0000000004', '859740', 1),
(5, '0000000005', '865065', 1),
(6, '0000000006', '921768', 1),
(7, '0000000007', '995203', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sccategories`
--

CREATE TABLE IF NOT EXISTS `sccategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permalink` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sccategories`
--

INSERT INTO `sccategories` (`id`, `parent_id`, `store_id`, `name`, `description`, `image`, `meta_description`, `keywords`, `permalink`) VALUES
(1, NULL, 1, 'Solid Food', 'Solid food', NULL, 'Solid food', 'solid,food', 'solid-food');

-- --------------------------------------------------------

--
-- Table structure for table `scorderitems`
--

CREATE TABLE IF NOT EXISTS `scorderitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B364B0E88D9F6D38` (`order_id`),
  KEY `IDX_B364B0E84584665A` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `scorderitems`
--

INSERT INTO `scorderitems` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`) VALUES
(1, 1, 2, 1, '11500.00'),
(2, 3, 3, 2, '85.00'),
(3, 3, 2, 1, '11500.00'),
(4, 4, 3, 1, '85.00');

-- --------------------------------------------------------

--
-- Table structure for table `scorders`
--

CREATE TABLE IF NOT EXISTS `scorders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shipping_address_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `payment_method` int(11) unsigned DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '1 = PINR, 2 = FOOD',
  `description` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extras` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `scorders`
--

INSERT INTO `scorders` (`id`, `shipping_address_id`, `member_id`, `date`, `status`, `payment_status`, `payment_method`, `type`, `description`, `extras`) VALUES
(1, 0, 7, '2017-01-07 09:36:46', 8, 8, NULL, NULL, NULL, NULL),
(2, 0, 1, '2017-01-07 18:03:10', 8, 9, 0, 1, 'PIN Purchase', 5),
(3, 0, 7, '2017-01-10 15:16:00', 8, 8, NULL, NULL, NULL, NULL),
(4, 0, 7, '2017-01-15 04:58:06', 8, 8, 0, 2, 'Food Purchase', NULL),
(5, 0, 1, '2017-05-01 22:47:38', 8, 8, 0, 1, 'PIN Purchase', 5),
(6, 0, 1, '2017-05-01 23:01:50', 8, 9, 0, 1, 'PIN Purchase', 2);

-- --------------------------------------------------------

--
-- Table structure for table `scproducts`
--

CREATE TABLE IF NOT EXISTS `scproducts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `main_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `images` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `old_price` decimal(10,2) NOT NULL,
  `new_price` decimal(10,2) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `permalink` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `scproducts`
--

INSERT INTO `scproducts` (`id`, `category_id`, `store_id`, `name`, `description`, `main_image`, `images`, `meta_description`, `keywords`, `old_price`, `new_price`, `weight`, `is_featured`, `permalink`, `quantity`) VALUES
(1, 1, 1, 'Rice', 'Rice description', 'Rice.jpg', '', 'rice is good', 'rice', '18000.00', '17500.00', '15.00', 1, 'rice', 20),
(2, 1, 1, 'Beans', 'beans', 'Beans.jpg', '', 'beans', 'beans', '12000.00', '11500.00', '12.00', 1, 'beans', 21),
(3, 1, 1, 'Spagetti', 'spagetti', 'Spagetti.jpg', '', 'spagetti', 'spagetti', '100.00', '85.00', '1.00', 1, 'spagetti', 20);

-- --------------------------------------------------------

--
-- Table structure for table `scshippingaddress`
--

CREATE TABLE IF NOT EXISTS `scshippingaddress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `street1` varchar(265) COLLATE utf8_unicode_ci NOT NULL,
  `street2` varchar(265) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_87F5168E8BAC62AF` (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `scsliders`
--

CREATE TABLE IF NOT EXISTS `scsliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `title` varchar(28) COLLATE utf8_unicode_ci NOT NULL,
  `short_info` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `body` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(11) NOT NULL,
  `landing_page` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `action_text` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `image2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `soldpins`
--

CREATE TABLE IF NOT EXISTS `soldpins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pin_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `date_of_purchase` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `soldpins`
--

INSERT INTO `soldpins` (`id`, `pin_id`, `member_id`, `date_of_purchase`, `order_id`) VALUES
(1, 1, 1, '2017-01-07 18:03:11', 2),
(2, 2, 1, '2017-01-07 18:03:11', 2),
(3, 3, 1, '2017-01-07 18:03:11', 2),
(4, 4, 1, '2017-01-07 18:03:11', 2),
(5, 5, 1, '2017-01-07 18:03:11', 2),
(6, 6, 1, '2017-05-01 23:01:50', 6),
(7, 7, 1, '2017-05-01 23:01:50', 6);

-- --------------------------------------------------------

--
-- Table structure for table `stagemembers`
--

CREATE TABLE IF NOT EXISTS `stagemembers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_id` varchar(50) NOT NULL,
  `left_index` int(11) NOT NULL,
  `right_index` int(11) NOT NULL,
  `parent_id` varchar(50) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `block` int(11) NOT NULL,
  `fistname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `stagemembers`
--

INSERT INTO `stagemembers` (`id`, `membership_id`, `left_index`, `right_index`, `parent_id`, `stage_id`, `block`, `fistname`, `lastname`, `username`) VALUES
(1, 'S86NCYES3H', 2, 3, 'S01C4RXY', 1, 2, NULL, NULL, 'tony'),
(26, '56USPROTCE', 4, 5, 'S01C4RXY', 1, 2, NULL, NULL, 'ademu'),
(27, 'OVFGZNT4TL', 3, 4, 'S86NCYES3H', 1, 3, NULL, NULL, 'Walter75');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_31C2774DF92F3E70` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `sub_domain` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `banner` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `remita_account_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account_number` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `theme` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `header_color` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `footer_color` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `bottom_color` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `short_about_test` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `merchant_id`, `name`, `sub_domain`, `icon`, `logo`, `banner`, `url`, `remita_account_id`, `bank_account_name`, `bank_account_number`, `theme`, `header_color`, `footer_color`, `bottom_color`, `phone_number`, `email`, `short_about_test`, `address`, `status`) VALUES
(1, 1, 'Food for all', 'food', '', 'logo.png', '', 'http://food4all.com:82/', '', '', '', 'food', '#008080', '#004080', '#ff0080', '+234 708 513 7865', 'laveritas@gmail.com', 'This is the best dealerr of all kinds of goods', '20 Papa Ahafa Road Iyanoba', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tempmembers`
--

CREATE TABLE IF NOT EXISTS `tempmembers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sponsor_id` varchar(256) NOT NULL DEFAULT '0',
  `payment_method` tinyint(4) NOT NULL DEFAULT '0',
  `number_of_accounts` int(11) NOT NULL DEFAULT '0',
  `parent_id` varchar(256) NOT NULL DEFAULT '0',
  `email` varchar(256) NOT NULL DEFAULT '0',
  `username` varchar(256) NOT NULL DEFAULT '0',
  `password` varchar(256) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tempmembers`
--

INSERT INTO `tempmembers` (`id`, `sponsor_id`, `payment_method`, `number_of_accounts`, `parent_id`, `email`, `username`, `password`) VALUES
(1, 'S01C4RXY', 2, 1, 'S01C4RXY', 'blenyo11@gmail.com', 'blenyo', 'ojima123'),
(2, 'S01C4RXY', 1, 1, 'S01C4RXY', 'ademu@gmail.com', 'ademu', 'ojima123'),
(3, '', 2, 1, '', 'blenyo11@gmail.com', 'food4all1', 'ojima123'),
(6, 'OVFGZNT4TL', 2, 1, 'OVFGZNT4TL', 'walter.adesa@yahoo.com', 'Walter75', 'welkome25');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE IF NOT EXISTS `transfers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` varchar(50) DEFAULT NULL,
  `receiver_id` varchar(50) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `sender_id`, `receiver_id`, `amount`, `date`) VALUES
(1, 'S01C4RXY', 'S86NCYES3H', 100, '2017-01-07 18:41:35'),
(2, 'S01C4RXY', 'S86NCYES3H', 20, '2017-03-21 12:41:00'),
(3, 'S01C4RXY', 'S86NCYES3H', 20, '2017-03-21 12:44:02'),
(4, 'S01C4RXY', 'S86NCYES3H', 10, '2017-03-21 12:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `usedpins`
--

CREATE TABLE IF NOT EXISTS `usedpins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `pin_id` int(11) NOT NULL,
  `member_id` varchar(265) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `usedpins`
--

INSERT INTO `usedpins` (`id`, `date`, `pin_id`, `member_id`) VALUES
(1, '2017-01-07 18:06:12', 1, 'S86NCYES3H'),
(3, '2017-01-11 05:50:43', 2, '56USPROTCE'),
(4, '2017-04-25 18:01:42', 3, 'OVFGZNT4TL');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE IF NOT EXISTS `withdrawals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` decimal(10,0) NOT NULL,
  `type` varchar(265) NOT NULL,
  `ref` varchar(265) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `member_id`, `date`, `amount`, `type`, `ref`) VALUES
(1, 'S01C4RXY', '2017-01-07 18:03:12', '250', 'cash', '1,2,3,4,5'),
(2, 'S01C4RXY', '2017-01-15 04:58:08', '20', 'food', '4'),
(3, 'S01C4RXY', '2017-01-15 04:58:08', '66', 'cash', '4'),
(4, 'S01C4RXY', '2017-05-01 23:01:50', '12400', 'cash', '6,7');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `FK_1EFB23CF8BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `FK_D95DB16B5D83CC1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`);

--
-- Constraints for table `scorderitems`
--
ALTER TABLE `scorderitems`
  ADD CONSTRAINT `FK_B364B0E84584665A` FOREIGN KEY (`product_id`) REFERENCES `scproducts` (`id`),
  ADD CONSTRAINT `FK_B364B0E88D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `scorders` (`id`);

--
-- Constraints for table `scshippingaddress`
--
ALTER TABLE `scshippingaddress`
  ADD CONSTRAINT `FK_87F5168E8BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `FK_31C2774DF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
