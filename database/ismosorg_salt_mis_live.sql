-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 31, 2020 at 04:35 PM
-- Server version: 10.2.36-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ismosorg_salt_mis_live`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`ismosorg`@`localhost` PROCEDURE `PRC_RANDOM_NUMBER` ()  BEGIN
      DECLARE a INT Default 1 ;
      DECLARE x INT;
      simple_loop: LOOP  
         SELECT  LPAD(FLOOR(RAND()*POW(36,8)), 8, 0) rnd
         into X;
             
         -- insert into table1 values(a);
         
         SET a=a+1;
         IF a=1000 THEN
            LEAVE simple_loop;
         END IF;
   END LOOP simple_loop;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(200) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cost_center`
--

CREATE TABLE `cost_center` (
  `cost_center_id` int(11) NOT NULL,
  `pr_cost_center_id` int(11) DEFAULT NULL,
  `cost_center_name` varchar(200) DEFAULT NULL,
  `cost_center_type` int(11) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `cost_center_status_type` int(1) DEFAULT NULL COMMENT 'old=0,new=1',
  `bank_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `account_no` varchar(45) DEFAULT NULL,
  `account_name` varchar(45) DEFAULT NULL,
  `active_status` int(1) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cost_center`
--

INSERT INTO `cost_center` (`cost_center_id`, `pr_cost_center_id`, `cost_center_name`, `cost_center_type`, `remarks`, `cost_center_status_type`, `bank_id`, `branch_id`, `account_no`, `account_name`, `active_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(2, 0, 'PIU', 1, 'test', NULL, 0, NULL, NULL, NULL, 1, 1, '2019-01-09 03:29:51', 1, '2019-01-09 03:30:28'),
(30, 2, 'Dhaka Region', 2, NULL, NULL, 8, 5, '4545', NULL, 1, 1, '2018-12-06 04:27:35', 1, '2018-12-06 04:28:30'),
(31, 2, 'Rajshahi Region', 2, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, '2018-07-23 22:11:28', NULL, NULL),
(32, 30, 'Dhaka District', 3, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, '2018-07-23 22:11:44', NULL, NULL),
(33, 31, 'Rajshahi District', 3, NULL, 0, NULL, NULL, NULL, NULL, 1, 1, '2018-07-23 22:12:06', NULL, NULL),
(34, 32, 'Manikgonj Upazilla', 4, NULL, NULL, 7, 8, '123456789', '12546633', 1, 1, '2018-09-01 15:29:50', 1, '2018-09-02 09:29:20'),
(35, 32, 'Gazipur Upazilla', 4, NULL, NULL, 9, 12, '41609015046', NULL, 1, 1, '2018-09-09 00:03:07', 1, '2018-09-10 06:02:09'),
(36, 33, 'Puthiya Upazilla', 4, NULL, 49, 0, NULL, NULL, NULL, 1, 1, '2018-12-06 04:29:07', 1, '2018-12-06 04:30:02'),
(41, 32, 'Gazipur Horticulture', 5, NULL, NULL, 7, 8, '258963', NULL, 1, 1, '2018-09-09 00:03:25', 1, '2018-09-10 06:02:27'),
(42, 31, 'Pirojpur District', 3, NULL, NULL, 7, 10, '123', NULL, 1, 1, '2018-09-10 18:02:20', 1, '2018-09-11 12:01:48'),
(43, 42, 'NajirPur Upazilla', 4, NULL, 48, 8, 14, '12345', NULL, 1, 1, '2018-09-10 18:03:14', 1, '2018-09-11 12:02:41'),
(44, 42, 'Pirojpur Sodar', 4, NULL, 49, 7, 9, '546', '12', 1, 1, '2018-07-30 15:59:59', 1, '2018-07-31 10:00:23'),
(46, 33, 'Raj upazilla', 4, NULL, 48, 7, 8, '2121', '2323', 1, 1, '2018-07-31 00:09:00', NULL, NULL),
(51, 31, 'Naogaon District', 3, NULL, NULL, 8, 17, '41609015046', '175641181', 1, 1, '2018-09-07 17:27:47', 1, '2018-09-08 11:27:15'),
(53, 51, 'Potnitola', 4, NULL, 49, 8, 17, '41609015046', '175461181', 1, 1, '2018-09-07 17:29:09', NULL, NULL),
(55, 2, 'Mymensingh Region', 2, NULL, NULL, 8, 20, '207290123173', '175611845', 1, 1, '2018-09-08 22:22:44', 1, '2018-09-10 04:21:45'),
(56, 55, 'Jamalpur District', 3, NULL, NULL, 9, 21, '5615002000421', '200390886', 1, 1, '2018-09-08 22:23:21', 1, '2018-09-10 04:22:23'),
(57, 56, 'Jamalpur Sadar', 4, NULL, 48, 9, 21, '343390120709', '200390886', 1, 1, '2018-09-08 16:33:16', NULL, NULL),
(58, 56, 'Islampur Upazila', 4, NULL, 48, 9, 22, '16409015641', '200390765', 1, 1, '2018-09-10 17:55:31', 1, '2018-09-11 11:54:58'),
(59, 55, 'Sherpur District', 3, NULL, NULL, 9, 23, '11549014494', '200890557', 1, 1, '2018-09-08 22:23:34', 1, '2018-09-10 04:22:35'),
(60, 59, 'Nakla Upazila', 4, NULL, 49, 9, 24, '292190116289', '200890315', 1, 1, '2018-09-10 17:56:02', 1, '2018-09-11 11:55:30'),
(61, 59, 'Nalitabari District', 3, NULL, NULL, 9, 25, '41609015046', '200890344', 1, 1, '2018-09-09 16:06:10', 1, '2018-09-10 10:05:12'),
(62, 2, 'Chittagong Region', 2, NULL, NULL, 9, 27, '115490114494', '200153223', 1, 1, '2018-09-08 22:22:54', 1, '2018-09-10 04:21:55'),
(63, 62, 'Cox\'s Bazar District', 3, NULL, NULL, 8, 29, '78090114423', '175220252', 1, 1, '2018-09-08 22:24:05', 1, '2018-09-10 04:23:07'),
(64, 62, 'Noakhali District', 3, NULL, NULL, 9, 30, '292190116289', '200750589', 1, 1, '2018-09-08 22:24:21', 1, '2018-09-10 04:23:23'),
(65, 64, 'Chatkhil Upazila', 4, NULL, 48, 9, 30, '292190116289', '200750589', 1, 1, '2018-09-10 17:55:49', 1, '2018-09-11 11:55:17'),
(66, 2, 'Comilla Region', 2, NULL, NULL, 8, 32, '78090114423', NULL, 1, 1, '2018-09-08 22:23:05', 1, '2018-09-10 04:22:07'),
(68, 66, 'Brahmanbaria District', 3, NULL, NULL, 11, 34, '41609015046', '010120433', 1, 1, '2018-09-08 23:39:01', 1, '2018-09-10 05:38:02'),
(71, 68, 'Nabinagor Upazila', 4, NULL, 48, 11, 34, '78090114423', '010120433', 1, 1, '2018-09-10 17:57:43', 1, '2018-09-11 11:57:11'),
(72, 64, 'Kutibdi Upazila', 4, NULL, 49, 9, 30, '242090130214', NULL, 1, 1, '2019-01-23 00:26:56', 1, '2019-01-23 12:28:37'),
(73, 63, 'Kutupdia Upazila', 4, NULL, 49, 8, 29, '41609015046', '175220252', 1, 1, '2018-12-24 04:50:14', 1, '2018-12-24 04:51:01'),
(74, 66, 'Comilla District', 3, NULL, NULL, 10, 35, '78090114423', NULL, 1, 1, '2018-09-10 18:16:19', NULL, NULL),
(75, 74, 'Chandina Upazilla', 4, NULL, 48, 8, 32, '242090130214', NULL, 1, 1, '2018-09-10 18:17:40', NULL, NULL),
(76, 74, 'Chouddogram Upazila', 4, NULL, 49, 8, 31, '292190116289', '175191060', 1, 1, '2018-12-24 04:43:09', 1, '2018-12-24 04:43:55'),
(77, 68, 'Nazirnagar Upazila', 4, NULL, 48, 11, 34, '292190116289', '010120433', 1, 1, '2018-09-10 18:32:48', 1, '2018-09-11 12:32:16'),
(78, 68, 'Bijaynagar Upazila', 4, NULL, 48, 11, 34, '46309012584', NULL, 1, 1, '2018-09-10 18:34:13', NULL, NULL),
(80, 31, 'Natore', 3, NULL, NULL, 7, 10, '963258741', NULL, 1, 1, '2018-09-11 16:13:36', 1, '2018-09-12 10:12:35'),
(81, 80, 'Natore Sodor', 4, NULL, 49, 8, 4, '852369741', '123456879', 1, 1, '2018-09-11 16:14:24', NULL, NULL),
(135, 35, 'GAZIPUR SADAR', 4, NULL, 48, 8, 36, '0110226547789', '123456', 1, 1, '2018-09-14 21:21:49', NULL, NULL),
(136, 35, 'KALIAKOIR', 4, NULL, 48, 8, 37, '0110226547780', '123', 1, 1, '2018-09-14 21:22:45', NULL, NULL),
(138, 2, 'Horetex Foundation', 6, NULL, NULL, 11, 34, '5568421', '010120433', 1, 1, '2018-10-07 04:13:38', 1, '2018-10-07 04:13:22'),
(139, 32, 'Mouchak', 4, NULL, 49, 7, 10, '2515741', NULL, 1, 1, '2018-12-23 21:26:56', NULL, NULL),
(140, 35, 'Kaliganj', 4, NULL, 48, 8, 36, '5685742', NULL, 1, 1, '2018-12-23 21:32:29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cost_center_type`
--

CREATE TABLE `cost_center_type` (
  `cost_center_type_id` int(11) NOT NULL,
  `cost_center_type_name` varchar(100) DEFAULT NULL,
  `active_status` int(1) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` int(11) DEFAULT NULL,
  `update_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cost_center_type`
--

INSERT INTO `cost_center_type` (`cost_center_type_id`, `cost_center_type_name`, `active_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'PIU', 1, 1, '2018-07-25 20:13:34', 1, '2018-07-26'),
(2, 'Region', 1, 1, '2018-07-23 17:04:07', NULL, NULL),
(3, 'District', 1, NULL, '2018-07-23 17:04:07', NULL, NULL),
(4, 'Upazilla', 1, NULL, '2018-07-23 17:04:07', NULL, NULL),
(5, 'Horticultute Center', 1, NULL, '2018-07-23 17:04:07', NULL, NULL),
(6, 'Hortext Foundation', 1, NULL, '2018-07-23 17:04:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `miller_extend_dates`
--

CREATE TABLE `miller_extend_dates` (
  `id` int(11) NOT NULL,
  `mill_id` int(11) NOT NULL,
  `renewing_date` date DEFAULT NULL,
  `extend_date` date DEFAULT NULL,
  `extend_days` int(5) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `org_id` int(11) NOT NULL,
  `org_name` varchar(200) DEFAULT NULL,
  `org_address` varchar(250) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email_address` varchar(250) DEFAULT NULL,
  `org_logo` varchar(250) DEFAULT NULL,
  `org_slogan` varchar(250) DEFAULT NULL,
  `website` varchar(250) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `bank_id` varchar(45) DEFAULT NULL,
  `branch_id` varchar(45) DEFAULT NULL,
  `account_no` varchar(45) DEFAULT NULL,
  `route_no` varchar(45) DEFAULT NULL,
  `active_status` int(1) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `lender_status` int(1) DEFAULT NULL,
  `is_owner` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Application organization';

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`org_id`, `org_name`, `org_address`, `phone`, `email_address`, `org_logo`, `org_slogan`, `website`, `fax`, `bank_id`, `branch_id`, `account_no`, `route_no`, `active_status`, `create_by`, `create_at`, `update_by`, `update_at`, `lender_status`, `is_owner`) VALUES
(1, 'Unicef', 'Dhaka', '01748836668', 'dae@gmail.com', 'image/organization/orgd150718.png', 'vbs', 'http://dae.net/', 'vnbbb', '7', '8', '123', NULL, 1, 1, '2019-04-17 00:55:11', 1, '2019-04-17 06:53:00', NULL, 1),
(2, 'BSTI', 'Dhaka.', '12345678932', 'ifad@gmail.com', 'image/organization/orgd150718.png', NULL, 'http://www.ifad.com', '017458', '7', '9', '963258147', '789456', 1, 1, '2019-04-17 00:55:19', NULL, NULL, 1, 0),
(3, 'BSCIC', 'Dhaka', '01722058963', 'ida@gmail.com', 'image/organization/orgd150718.png', NULL, 'http://www.ida.com', '123456', '7', '9', '789456123', '963258', 1, 1, '2019-04-17 00:55:41', NULL, NULL, 1, 0),
(4, 'Association', 'Dhaka, Bangladesh', '01764456326', 'bd@gmail.com', 'image/organization/orgd150718.png', NULL, 'http://govt.bd.com', 'bd', '9', '13', '78912', NULL, 1, 1, '2019-04-17 00:55:57', 1, '2018-09-25 12:07:39', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sa_modules`
--

CREATE TABLE `sa_modules` (
  `MODULE_ID` int(11) NOT NULL,
  `MODULE_NAME` varchar(150) NOT NULL,
  `MODULE_NAME_BN` varchar(500) DEFAULT NULL,
  `MODULE_ICON` varchar(50) DEFAULT NULL,
  `SL_NO` int(4) NOT NULL,
  `IS_ACTIVE` tinyint(1) DEFAULT 1 COMMENT '0=no, 1=yes',
  `CREATED_BY` int(10) DEFAULT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATED_BY` int(10) DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sa_modules`
--

INSERT INTO `sa_modules` (`MODULE_ID`, `MODULE_NAME`, `MODULE_NAME_BN`, `MODULE_ICON`, `SL_NO`, `IS_ACTIVE`, `CREATED_BY`, `CREATED_AT`, `UPDATED_BY`, `UPDATED_AT`) VALUES
(12, 'Access Control', NULL, 'fa fa-lock', 100, 1, 1, '2018-08-27 16:11:58', 1, '2019-01-08 10:52:47'),
(30, 'Setup', NULL, 'fa fa-cogs', 200, 1, 1, '2019-03-26 20:25:15', NULL, NULL),
(31, 'Transaction', NULL, 'fa fa-exchange', 300, 1, 1, '2019-04-02 20:39:24', 1, '2019-04-03 11:01:15'),
(32, 'Profile', NULL, 'fa fa-user', 400, 1, 1, '2019-04-08 18:02:51', 1, '2019-04-09 05:44:36'),
(33, 'Crude Salt Details', NULL, 'fa fa-flask', 500, 1, 1, '2019-04-08 18:23:57', 201, '2020-09-27 03:48:33'),
(34, 'Monitor', NULL, 'fa fa-desktop', 600, 1, 1, '2019-04-08 19:28:08', NULL, NULL),
(35, 'Report', NULL, 'glyphicon glyphicon-file', 9999, 1, 1, '2019-04-15 16:08:43', 1, '2019-08-22 05:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `sa_module_links`
--

CREATE TABLE `sa_module_links` (
  `LINK_ID` int(11) NOT NULL,
  `LINK_NAME` varchar(150) NOT NULL DEFAULT '',
  `LINK_NAME_BN` varchar(500) DEFAULT NULL,
  `LINK_PAGES` varchar(10) DEFAULT NULL,
  `MODULE_ID` int(2) DEFAULT NULL,
  `LINK_URI` varchar(200) DEFAULT NULL,
  `LINK_DESC` varchar(100) DEFAULT NULL,
  `SL_NO` int(4) DEFAULT NULL,
  `CREATE` tinyint(1) DEFAULT 0,
  `READ` tinyint(1) DEFAULT 0,
  `UPDATE` tinyint(1) DEFAULT 0,
  `DELETE` tinyint(1) DEFAULT 0,
  `STATUS` tinyint(4) DEFAULT NULL,
  `IS_ACTIVE` tinyint(1) DEFAULT 1,
  `CREATED_BY` int(10) DEFAULT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATED_BY` int(10) DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sa_module_links`
--

INSERT INTO `sa_module_links` (`LINK_ID`, `LINK_NAME`, `LINK_NAME_BN`, `LINK_PAGES`, `MODULE_ID`, `LINK_URI`, `LINK_DESC`, `SL_NO`, `CREATE`, `READ`, `UPDATE`, `DELETE`, `STATUS`, `IS_ACTIVE`, `CREATED_BY`, `CREATED_AT`, `UPDATED_BY`, `UPDATED_AT`) VALUES
(51, 'Modules', NULL, NULL, 12, 'modules', NULL, 102, 0, 0, 0, 0, 0, 1, 1, '2018-08-31 18:42:54', NULL, NULL),
(52, 'Module Links', NULL, NULL, 12, 'module-links', NULL, 103, 0, 0, 0, 0, 0, 1, 1, '2018-08-31 18:43:49', NULL, NULL),
(53, 'Organization Module', NULL, NULL, 12, 'organization-modules', NULL, 104, 0, 0, 0, 0, 0, 1, 1, '2018-08-31 18:45:37', NULL, NULL),
(54, 'User Modules', NULL, NULL, 12, 'user-modules', NULL, 105, 0, 0, 0, 0, 0, 1, 1, '2018-08-31 18:46:09', NULL, NULL),
(63, 'User', NULL, NULL, 12, 'users', NULL, 106, 0, 0, 0, 0, 0, 1, 1, '2018-08-31 18:48:14', NULL, NULL),
(154, 'User Group', NULL, NULL, 12, 'user-groups', NULL, 1, 0, 0, 0, 0, 0, 1, 1, '2020-09-16 04:14:22', NULL, NULL),
(167, 'Base Setup', NULL, NULL, 30, 'lookup-groups', NULL, 2, 0, 0, 0, 0, 0, 1, 1, '2020-09-16 04:17:00', NULL, NULL),
(168, 'Crude Salt', NULL, NULL, 33, 'crude-salt-details', NULL, 202, 1, 1, 1, 1, 1, 1, 1, '2019-04-08 19:11:43', NULL, NULL),
(169, 'BSTI Test Standard', NULL, NULL, 30, 'bsti-test-standard', NULL, 2, 0, 0, 0, 0, 0, 1, 1, '2020-09-16 04:17:10', NULL, NULL),
(171, 'Monitoring', NULL, NULL, 34, 'monitoring', NULL, NULL, 1, 1, 1, 1, 1, 1, 201, '2020-09-30 22:04:18', NULL, NULL),
(172, 'Seller & Distributor Profile', NULL, NULL, 32, 'seller-distributor-profile', NULL, 3, 0, 0, 0, 0, 0, 1, 1, '2020-09-16 04:33:24', NULL, NULL),
(173, 'Supplier Profile', NULL, NULL, 32, 'supplier-profile', NULL, 2, 1, 1, 1, 1, 1, 1, 1, '2020-09-16 04:33:17', NULL, NULL),
(175, 'Association Setup', NULL, NULL, 30, 'association-setup', NULL, NULL, 0, 0, 0, 0, 0, 1, 1, '2019-03-31 20:45:50', NULL, NULL),
(176, 'Item', NULL, NULL, 30, 'item', NULL, 4, 0, 0, 0, 0, 0, 1, 1, '2020-09-16 04:18:08', NULL, NULL),
(178, 'Chemical Purchase', NULL, NULL, 31, 'chemical-purchase', NULL, 2, 0, 0, 0, 0, 0, 1, 1, '2020-09-16 04:21:30', NULL, NULL),
(179, 'Crude Salt Procurement', NULL, NULL, 31, 'crude-salt-procurement', NULL, 1, 0, 0, 0, 0, 0, 1, 201, '2020-09-26 21:34:15', NULL, NULL),
(180, 'Required Chemical Per kg', NULL, NULL, 33, 'require-chemical-mst', NULL, NULL, 0, 0, 0, 0, 0, 1, 201, '2020-09-29 02:04:08', NULL, NULL),
(182, 'Wash And Crushing', NULL, NULL, 31, 'washing-crushing', NULL, 3, 0, 0, 0, 0, 0, 1, 201, '2020-09-26 21:42:25', NULL, NULL),
(184, 'Mill Profile', NULL, NULL, 32, 'mill-info', NULL, 1, 0, 0, 0, 0, 0, 1, 201, '2020-09-26 21:45:45', NULL, NULL),
(185, 'Iodization', NULL, NULL, 31, 'iodized', NULL, 4, 0, 0, 0, 0, 0, 1, 1, '2020-09-16 04:21:46', NULL, NULL),
(186, 'Quality Control & Testing', NULL, NULL, 31, 'quality-control-testing', NULL, 5, 0, 0, 0, 0, 0, 1, 1, '2020-09-16 04:21:59', NULL, NULL),
(187, 'Sales & Distribution', NULL, NULL, 31, 'sales-distribution', NULL, 6, 0, 0, 0, 0, 0, 1, 1, '2020-09-16 04:22:07', NULL, NULL),
(188, 'Report Dashboard', NULL, NULL, 35, 'report-dashboard', NULL, NULL, 0, 0, 0, 0, 0, 1, 1, '2019-04-15 16:09:41', NULL, NULL),
(189, 'Test 1', NULL, NULL, 36, 'test-1', NULL, NULL, 0, 0, 0, 0, 0, 1, 1, '2019-04-16 17:58:28', NULL, NULL),
(190, 'Certificate Map', NULL, NULL, 32, 'certificate-map', NULL, NULL, 0, 0, 0, 0, 0, 1, 1, '2019-09-21 23:31:17', NULL, NULL),
(191, 'Brand', NULL, NULL, 30, 'brand', NULL, NULL, 0, 0, 0, 0, 0, 1, 1, '2019-09-23 17:57:10', NULL, NULL),
(192, 'Stock Adjustment', NULL, NULL, 31, 'stock-adjustment', NULL, 7, 0, 0, 0, 0, 0, 1, 162, '2019-11-06 18:39:34', NULL, NULL),
(193, 'Certificate Issuer', NULL, NULL, 30, 'certificate', NULL, 3, 0, 0, 0, 0, 0, 1, 201, '2020-09-28 23:30:46', NULL, NULL),
(194, 'Extend Date', NULL, NULL, 30, 'extended-date', NULL, NULL, 0, 0, 0, 0, 0, 1, 162, '2019-10-30 13:54:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sa_org_mlink`
--

CREATE TABLE `sa_org_mlink` (
  `ORG_MLINKS_ID` int(11) NOT NULL,
  `MODULE_ID` smallint(5) NOT NULL,
  `LINK_ID` int(7) DEFAULT NULL,
  `LINK_NAME` varchar(60) DEFAULT NULL,
  `LINK_PAGES` varchar(10) DEFAULT NULL,
  `LINK_URI` varchar(200) DEFAULT NULL,
  `ORG_ID` int(11) DEFAULT NULL,
  `CREATE` tinyint(1) DEFAULT 0,
  `READ` tinyint(1) DEFAULT 0,
  `UPDATE` tinyint(1) DEFAULT 0,
  `DELETE` tinyint(1) DEFAULT 0,
  `STATUS` tinyint(4) DEFAULT NULL,
  `IS_ACTIVE` tinyint(1) DEFAULT 1,
  `CREATED_BY` int(10) DEFAULT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATED_BY` int(10) DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sa_org_mlink`
--

INSERT INTO `sa_org_mlink` (`ORG_MLINKS_ID`, `MODULE_ID`, `LINK_ID`, `LINK_NAME`, `LINK_PAGES`, `LINK_URI`, `ORG_ID`, `CREATE`, `READ`, `UPDATE`, `DELETE`, `STATUS`, `IS_ACTIVE`, `CREATED_BY`, `CREATED_AT`, `UPDATED_BY`, `UPDATED_AT`) VALUES
(2, 12, 51, 'Modules', NULL, 'modules', 1, 1, 1, 1, 1, 1, 1, 1, '2018-09-18 21:16:10', 1, '2018-09-19 09:17:15'),
(3, 12, 52, 'Module Links', NULL, 'module-links', 1, 1, 1, 1, 1, 1, 1, 1, '2018-09-18 21:16:11', 1, '2018-09-19 09:17:18'),
(4, 12, 53, 'Organization Module', NULL, 'organization-modules', 1, 1, 1, 1, 1, 1, 1, 1, '2018-09-18 21:16:12', 1, '2018-09-19 09:17:20'),
(5, 12, 54, 'User Modules', NULL, 'user-modules', 1, 1, 1, 1, 1, 1, 1, 1, '2018-09-18 21:16:13', 1, '2018-09-19 09:17:22'),
(6, 12, 63, 'User', NULL, 'users', 1, 1, 1, 1, 1, 1, 1, 1, '2018-09-18 21:16:14', 1, '2018-09-19 09:17:25'),
(110, 12, 154, 'User Group', NULL, 'user-groups', 1, 1, 1, 1, 1, 1, 1, 1, '2019-01-16 02:39:07', 1, '2019-01-16 02:39:46'),
(128, 29, 165, 'Mill Profile', NULL, 'mill-profile', 1, 1, 1, 1, 1, 1, 1, 1, '2019-03-27 00:28:28', 1, '2019-03-27 06:27:56'),
(133, 30, 167, 'Base Setup', NULL, 'lookup-groups', 1, 1, 1, 1, 1, 1, 1, 1, '2019-03-28 00:13:25', 1, '2019-03-28 06:13:01'),
(135, 30, 169, 'BSTI Test Standard', NULL, 'bsti-test-standard', 1, 1, 1, 1, 1, 1, 1, 1, '2019-03-29 22:12:14', 1, '2019-03-30 06:10:29'),
(142, 30, 175, 'Association Setup', NULL, 'association-setup', 1, 1, 1, 1, 1, 1, 1, 1, '2019-04-01 02:46:21', 1, '2019-04-01 08:46:00'),
(143, 30, 176, 'Item', NULL, 'item', 1, 1, 1, 1, 1, 1, 1, 1, '2019-04-02 03:46:31', 1, '2019-04-02 09:46:11'),
(145, 31, 178, 'Chemical Purchase', NULL, 'chemical-purchase', 1, 1, 1, 1, 1, 1, 1, 1, '2019-04-03 00:49:59', 1, '2019-04-03 08:46:42'),
(146, 31, 179, 'CRUDE Salt Procurement', NULL, 'crude-salt-procurement', 1, 1, 1, 1, 1, 1, 1, 1, '2019-04-03 22:04:37', 1, '2019-04-04 04:04:20'),
(149, 31, 182, 'Washing And Crushing', NULL, 'washing-crushing', 1, 1, 1, 1, 1, 1, 1, 1, '2019-04-08 21:56:07', 1, '2019-04-09 03:55:55'),
(150, 32, 172, 'Seller & Distributor Profile', NULL, 'seller-distributor-profile', 1, 1, 1, 1, 1, 1, 1, 1, '2019-04-08 22:07:31', 1, '2019-04-09 06:04:10'),
(151, 32, 173, 'Supplier Profile', NULL, 'supplier-profile', 1, 1, 1, 1, 1, 1, 1, 1, '2019-04-08 22:07:34', 1, '2019-04-09 06:04:19'),
(153, 33, 168, 'Crude Salt', NULL, 'crude-salt-details', 1, 1, 1, 1, 1, 1, 1, 1, '2019-04-08 22:41:17', 1, '2019-04-09 07:21:54'),
(154, 33, 180, 'Require Chemical Per kg', NULL, 'require-chemical-mst', 1, 1, 1, 1, 1, 1, 1, 1, '2019-04-08 22:41:21', 1, '2019-04-09 07:21:34'),
(155, 34, 171, 'Monitoring', NULL, 'monitoring', 1, 1, 1, 1, 1, 1, 1, 1, '2019-04-08 23:32:19', 1, '2019-04-09 07:28:59'),
(156, 32, 184, 'Miller Profile', NULL, 'mill-info', 1, 1, 1, 1, 1, 1, 1, 1, '2019-04-09 00:35:52', 1, '2019-04-09 06:35:38'),
(157, 31, 185, 'Iodized', NULL, 'iodized', 1, 1, 1, 1, 1, 1, 1, 1, '2019-04-09 21:26:43', 1, '2019-04-10 05:23:22'),
(158, 31, 186, 'Quality Control & Testing', NULL, 'quality-control-testing', 1, 1, 1, 1, 1, 1, 1, 1, '2019-04-10 22:54:50', 1, '2019-04-11 06:51:29'),
(159, 31, 187, 'Sales & Distribution', NULL, 'sales-distribution', 1, 1, 1, 1, 1, 1, 1, 1, '2019-04-15 02:52:26', 1, '2019-04-15 10:49:02'),
(160, 35, 188, 'Report Dashboard', NULL, 'report-dashboard', 1, 1, 1, 1, 1, 1, 1, 1, '2019-04-15 22:10:37', 1, '2019-04-16 04:10:07'),
(161, 32, 190, 'Certificate Map', NULL, 'certificate-map', 1, 1, 1, 1, 1, 1, 1, 1, '2019-09-22 05:30:35', 1, '2019-09-22 11:31:55'),
(162, 30, 191, 'Brand', NULL, 'brand', 1, 1, 1, 1, 1, 1, 1, 1, '2019-09-23 22:00:23', 1, '2019-09-24 05:57:29'),
(163, 31, 192, 'Stock Adjustmetn', NULL, 'stock-adjustment', 1, 1, 1, 1, 1, 1, 1, 1, '2019-09-24 23:58:50', 1, '2019-09-25 07:55:58'),
(164, 30, 193, 'Certificate Issure', NULL, 'certificate', 1, 1, 1, 1, 1, 1, 1, 1, '2019-09-28 02:33:55', 1, '2019-09-28 10:30:59'),
(165, 30, 194, 'Extend Date', NULL, 'extended-date', 1, 1, 1, 1, 1, 1, 1, 162, '2019-10-30 05:57:48', 162, '2019-10-31 01:54:34');

-- --------------------------------------------------------

--
-- Table structure for table `sa_org_modules`
--

CREATE TABLE `sa_org_modules` (
  `ORG_MODULE_ID` int(11) NOT NULL,
  `MODULE_ID` smallint(5) NOT NULL,
  `MODULE_NAME` varchar(70) NOT NULL,
  `ORG_ID` int(11) NOT NULL,
  `DEFAULT_FLAG` tinyint(1) DEFAULT 1,
  `IS_ACTIVE` tinyint(1) DEFAULT 1 COMMENT '0=no, 1=yes',
  `CREATED_BY` int(10) DEFAULT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATED_BY` int(10) DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sa_org_modules`
--

INSERT INTO `sa_org_modules` (`ORG_MODULE_ID`, `MODULE_ID`, `MODULE_NAME`, `ORG_ID`, `DEFAULT_FLAG`, `IS_ACTIVE`, `CREATED_BY`, `CREATED_AT`, `UPDATED_BY`, `UPDATED_AT`) VALUES
(1, 12, 'Access Control', 1, 1, 1, 1, '2018-09-18 05:50:18', 162, '2019-08-20 08:12:54'),
(18, 30, 'Setup', 1, 1, 1, 1, '2019-03-27 02:26:21', 1, '2019-03-27 08:32:07'),
(19, 31, 'Transaction', 1, 1, 1, 1, '2019-04-03 00:49:52', NULL, NULL),
(20, 32, 'Profile', 1, 1, 1, 1, '2019-04-08 22:07:24', NULL, NULL),
(21, 33, 'Chemical Setup', 1, 1, 1, 1, '2019-04-08 22:27:33', NULL, NULL),
(22, 34, 'Monitor', 1, 1, 1, 1, '2019-04-08 23:32:06', NULL, NULL),
(23, 35, 'Report', 1, 1, 1, 1, '2019-04-15 22:10:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sa_uglw_mlink`
--

CREATE TABLE `sa_uglw_mlink` (
  `UGLWM_LINK` int(11) NOT NULL,
  `ORG_MLINKS_ID` int(11) DEFAULT NULL,
  `ORG_ID` int(11) DEFAULT NULL,
  `USER_ID` bigint(14) DEFAULT NULL,
  `USERGRP_ID` int(11) DEFAULT NULL,
  `UG_LEVEL_ID` int(11) DEFAULT NULL,
  `MODULE_ID` int(7) DEFAULT NULL,
  `LINK_ID` int(7) DEFAULT NULL,
  `LINK_URI` varchar(200) DEFAULT NULL,
  `CREATE` tinyint(1) DEFAULT 0,
  `READ` tinyint(1) DEFAULT 0,
  `UPDATE` tinyint(1) DEFAULT 0,
  `DELETE` tinyint(1) DEFAULT 0,
  `STATUS` tinyint(4) DEFAULT NULL,
  `IS_ACTIVE` tinyint(1) DEFAULT 1,
  `CREATED_BY` int(10) DEFAULT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATED_BY` int(10) DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sa_uglw_mlink`
--

INSERT INTO `sa_uglw_mlink` (`UGLWM_LINK`, `ORG_MLINKS_ID`, `ORG_ID`, `USER_ID`, `USERGRP_ID`, `UG_LEVEL_ID`, `MODULE_ID`, `LINK_ID`, `LINK_URI`, `CREATE`, `READ`, `UPDATE`, `DELETE`, `STATUS`, `IS_ACTIVE`, `CREATED_BY`, `CREATED_AT`, `UPDATED_BY`, `UPDATED_AT`) VALUES
(237, 2, 1, 7, 7, 24, 12, 51, 'modules', 1, 1, 1, 1, 1, 1, 1, '2019-01-15 03:49:47', 1, '2019-01-23 01:54:36'),
(238, 4, 1, 7, 7, 24, 12, 53, 'organization-modules', 1, 1, 1, 1, 1, 1, 1, '2019-01-15 04:03:05', 1, '2019-01-23 01:56:05'),
(239, 3, 1, 7, 7, 24, 12, 52, 'module-links', 1, 1, 1, 1, 1, 1, 1, '2019-01-15 04:08:56', 1, '2019-01-23 01:55:32'),
(246, 6, 1, 7, 7, 24, 12, 63, 'users', 1, 1, 1, 1, 1, 1, 1, '2019-01-15 22:03:41', 1, '2019-01-23 01:57:07'),
(254, 2, 1, 7, 8, 17, 12, 51, 'modules', 1, 1, 1, 1, 1, 1, 1, '2019-01-16 02:24:53', 1, '2019-01-19 12:27:44'),
(255, 3, 1, 7, 8, 17, 12, 52, 'module-links', 1, 1, 1, 1, 1, 1, 1, '2019-01-16 02:24:57', 1, '2019-01-19 12:28:51'),
(256, 4, 1, 7, 8, 17, 12, 53, 'organization-modules', 1, 1, 1, 1, 1, 1, 1, '2019-01-16 02:25:00', 1, '2019-01-19 12:35:44'),
(257, 5, 1, 7, 8, 17, 12, 54, 'user-modules', 1, 1, 1, 1, 1, 1, 1, '2019-01-16 02:25:04', 1, '2019-01-19 12:36:41'),
(258, 6, 1, 7, 8, 17, 12, 63, 'users', 0, 0, 0, 0, 1, 1, 1, '2019-01-16 02:25:09', 1, '2019-01-17 01:02:49'),
(260, 110, 1, 7, 7, 24, 12, 154, 'user-groups', 1, 1, 1, 1, 1, 1, 1, '2019-01-16 02:39:40', 1, '2019-01-23 01:53:41'),
(283, 5, 1, 7, 7, 24, 12, 54, 'user-modules', 1, 1, 1, 1, 1, 1, 34, '2019-01-18 23:49:34', 1, '2019-01-22 11:27:11'),
(284, 6, 1, 7, 8, 19, 12, 63, 'users', 0, 0, 0, 0, 0, 1, 1, '2019-01-19 00:40:53', 1, '2019-01-19 12:52:47'),
(286, 2, 1, 7, 8, 19, 12, 51, 'modules', 0, 0, 0, 0, 0, 1, 1, '2019-01-19 00:41:17', 1, '2019-01-19 12:46:54'),
(287, 3, 1, 7, 8, 19, 12, 52, 'module-links', 0, 0, 0, 0, 0, 1, 1, '2019-01-19 00:41:21', 1, '2019-01-19 12:50:16'),
(288, 4, 1, 7, 8, 19, 12, 53, 'organization-modules', 0, 0, 0, 0, 0, 1, 1, '2019-01-19 00:41:24', 1, '2019-01-19 12:51:10'),
(289, 5, 1, 7, 8, 19, 12, 54, 'user-modules', 0, 0, 0, 0, 0, 1, 1, '2019-01-19 00:41:28', 1, '2019-01-19 12:51:29'),
(291, 110, 1, 7, 8, 19, 12, 154, 'user-groups', 0, 0, 0, 0, 0, 1, 1, '2019-01-19 00:41:36', 1, '2019-01-19 12:48:37'),
(292, 2, 1, 7, 8, 25, 12, 51, 'modules', 1, 1, 1, 1, 1, 1, 1, '2019-01-19 00:53:50', 1, '2019-01-19 12:54:26'),
(293, 3, 1, 7, 8, 25, 12, 52, 'module-links', 1, 1, 1, 1, 1, 1, 1, '2019-01-19 00:53:54', 1, '2019-01-19 12:54:29'),
(294, 4, 1, 7, 8, 25, 12, 53, 'organization-modules', 1, 1, 1, 1, 1, 1, 1, '2019-01-19 00:53:57', 1, '2019-01-19 12:54:35'),
(295, 5, 1, 7, 8, 25, 12, 54, 'user-modules', 1, 1, 1, 1, 1, 1, 1, '2019-01-19 00:54:03', 1, '2019-01-19 12:54:40'),
(296, 6, 1, 7, 8, 25, 12, 63, 'users', 1, 1, 1, 1, 1, 1, 1, '2019-01-19 00:54:08', 1, '2019-01-19 12:54:44'),
(299, 110, 1, 7, 8, 25, 12, 154, 'user-groups', 0, 0, 0, 0, 1, 1, 1, '2019-01-19 00:54:22', 1, '2019-01-19 12:55:18'),
(373, 128, 1, 7, 7, 24, 29, 165, 'mill-profile', 0, 0, 0, 0, 0, 1, 1, '2019-03-27 00:28:42', 1, '2019-03-27 06:45:51'),
(378, 133, 1, 7, 7, 24, 30, 167, 'lookup-groups', 1, 1, 1, 1, 1, 1, 1, '2019-03-28 00:13:46', 1, '2019-03-30 05:22:01'),
(380, 135, 1, 7, 7, 24, 30, 169, 'bsti-test-standard', 1, 1, 1, 1, 1, 1, 1, '2019-03-29 22:12:36', 1, '2019-03-30 06:10:51'),
(387, 142, 1, 7, 7, 24, 30, 175, 'association-setup', 1, 1, 1, 1, 1, 1, 1, '2019-04-01 02:46:32', 1, '2019-04-01 08:46:12'),
(388, 143, 1, 7, 7, 24, 30, 176, 'item', 1, 1, 1, 1, 1, 1, 1, '2019-04-02 03:46:44', 1, '2019-04-02 09:46:23'),
(390, 145, 1, 7, 7, 24, 31, 178, 'chemical-purchase', 1, 1, 1, 1, 1, 1, 1, '2019-04-03 00:50:17', 1, '2019-04-06 06:11:13'),
(391, 146, 1, 7, 7, 24, 31, 179, 'crude-salt-procurement', 1, 1, 1, 1, 1, 1, 1, '2019-04-03 22:04:48', 1, '2019-04-04 04:04:31'),
(394, 149, 1, 7, 7, 24, 31, 182, 'washing-crushing', 1, 1, 1, 1, 1, 1, 1, '2019-04-08 21:56:22', 1, '2019-04-09 03:56:08'),
(395, 151, 1, 7, 7, 24, 32, 173, 'supplier-profile', 1, 1, 1, 1, 1, 1, 1, '2019-04-08 22:10:24', 1, '2019-04-09 06:09:38'),
(396, 150, 1, 7, 7, 24, 32, 172, 'seller-distributor-profile', 1, 1, 1, 1, 1, 1, 1, '2019-04-08 22:10:28', 1, '2019-04-09 06:09:41'),
(398, 154, 1, 7, 7, 24, 33, 180, 'require-chemical-mst', 1, 1, 1, 1, 1, 1, 1, '2019-04-08 23:11:43', 1, '2019-04-09 07:08:22'),
(399, 153, 1, 7, 7, 24, 33, 168, 'crude-salt-details', 1, 1, 1, 1, 1, 1, 1, '2019-04-08 23:25:40', 1, '2019-04-09 07:22:19'),
(400, 155, 1, 7, 7, 24, 34, 171, 'monitoring', 1, 1, 1, 1, 1, 1, 1, '2019-04-08 23:33:20', 1, '2019-04-09 07:37:07'),
(403, 156, 1, 7, 7, 24, 32, 184, 'mill-info', 1, 1, 1, 1, 1, 1, 1, '2019-04-09 00:36:03', 1, '2019-04-09 06:35:49'),
(404, 157, 1, 7, 7, 24, 31, 185, 'iodized', 1, 1, 1, 1, 1, 1, 1, '2019-04-09 21:27:04', 1, '2019-04-10 05:23:43'),
(405, 158, 1, 7, 7, 24, 31, 186, 'quality-control-testing', 1, 1, 1, 1, 1, 1, 1, '2019-04-10 22:55:08', 1, '2019-04-11 06:51:47'),
(406, 159, 1, 7, 7, 24, 31, 187, 'sales-distribution', 1, 1, 1, 1, 1, 1, 1, '2019-04-15 02:52:44', 1, '2019-04-15 10:49:20'),
(407, 160, 1, 7, 7, 24, 35, 188, 'report-dashboard', 1, 1, 1, 1, 1, 1, 1, '2019-04-15 22:10:52', 1, '2019-04-16 04:10:22'),
(408, 133, 1, 7, 1, 59, 30, 167, 'lookup-groups', 1, 1, 1, 1, 1, 1, 1, '2019-04-16 23:41:41', 1, '2019-04-17 05:41:37'),
(411, 6, 1, 7, 21, 64, 12, 63, 'users', 1, 1, 1, 1, 1, 1, 1, '2019-04-17 23:54:55', 1, '2019-05-06 10:01:13'),
(412, 156, 1, 7, 21, 64, 32, 184, 'mill-info', 1, 1, 1, 1, 1, 1, 1, '2019-04-18 01:07:58', 1, '2019-04-18 07:07:28'),
(414, 145, 1, 7, 22, 65, 31, 178, 'chemical-purchase', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 01:03:41', 1, '2019-04-20 09:00:13'),
(415, 146, 1, 7, 22, 65, 31, 179, 'crude-salt-procurement', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 02:11:02', 1, '2019-04-20 10:07:35'),
(416, 149, 1, 7, 22, 65, 31, 182, 'washing-crushing', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 02:18:16', 1, '2019-04-20 10:14:50'),
(417, 157, 1, 7, 22, 65, 31, 185, 'iodized', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 02:25:52', 1, '2019-04-20 10:22:25'),
(418, 158, 1, 7, 22, 65, 31, 186, 'quality-control-testing', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 02:31:47', 1, '2019-04-20 10:28:19'),
(419, 159, 1, 7, 22, 65, 31, 187, 'sales-distribution', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 02:35:15', 1, '2019-04-20 10:31:47'),
(420, 151, 1, 7, 22, 65, 32, 173, 'supplier-profile', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 03:31:25', 1, '2019-04-20 11:27:58'),
(421, 150, 1, 7, 22, 65, 32, 172, 'seller-distributor-profile', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 03:32:59', 1, '2019-04-20 11:29:31'),
(422, 155, 1, 7, 22, 65, 34, 171, 'monitoring', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 04:41:28', 1, '2019-04-21 12:37:59'),
(423, 156, 1, 7, 22, 65, 32, 184, 'mill-info', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 05:39:33', 1, '2019-04-21 05:51:43'),
(424, 133, 1, 7, 20, 63, 30, 167, 'lookup-groups', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 23:48:14', 1, '2019-04-21 05:48:19'),
(425, 135, 1, 7, 20, 63, 30, 169, 'bsti-test-standard', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 23:48:14', 1, '2019-04-21 05:48:20'),
(426, 142, 1, 7, 20, 63, 30, 175, 'association-setup', 0, 0, 0, 0, 0, 1, 1, '2019-04-20 23:48:15', 1, '2020-12-31 10:03:19'),
(427, 143, 1, 7, 20, 63, 30, 176, 'item', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 23:48:15', 1, '2019-04-21 05:48:21'),
(428, 153, 1, 7, 20, 63, 33, 168, 'crude-salt-details', 0, 0, 0, 0, 0, 1, 1, '2019-04-20 23:48:30', 1, '2019-05-06 10:00:50'),
(429, 154, 1, 7, 20, 63, 33, 180, 'require-chemical-mst', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 23:48:30', 1, '2019-04-21 05:48:31'),
(430, 160, 1, 7, 20, 63, 35, 188, 'report-dashboard', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 23:48:37', 1, '2019-04-21 05:48:37'),
(431, 160, 1, 7, 18, 61, 35, 188, 'report-dashboard', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 23:48:54', 1, '2019-04-21 05:48:52'),
(432, 160, 1, 7, 19, 62, 35, 188, 'report-dashboard', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 23:49:06', 1, '2019-04-21 05:49:04'),
(433, 160, 1, 7, 21, 64, 35, 188, 'report-dashboard', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 23:49:35', 1, '2019-04-21 05:49:33'),
(434, 160, 1, 7, 22, 65, 35, 188, 'report-dashboard', 1, 1, 1, 1, 1, 1, 1, '2019-04-20 23:51:48', 1, '2019-04-21 05:51:47'),
(435, 133, 1, 7, 1, 53, 30, 167, 'lookup-groups', 1, 1, 1, 1, 1, 1, 1, '2019-04-21 00:03:41', 1, '2019-04-21 06:03:47'),
(436, 135, 1, 7, 1, 53, 30, 169, 'bsti-test-standard', 1, 1, 1, 1, 1, 1, 1, '2019-04-21 00:03:42', 1, '2019-04-21 06:03:48'),
(437, 142, 1, 7, 1, 53, 30, 175, 'association-setup', 0, 0, 0, 0, 0, 1, 1, '2019-04-21 00:03:42', 1, '2019-08-21 03:40:33'),
(438, 143, 1, 7, 1, 53, 30, 176, 'item', 1, 1, 1, 1, 1, 1, 1, '2019-04-21 00:03:43', 1, '2019-04-21 06:03:48'),
(439, 160, 1, 7, 1, 53, 35, 188, 'report-dashboard', 1, 1, 1, 1, 1, 1, 1, '2019-04-21 00:03:54', 1, '2019-04-21 06:03:53'),
(440, 153, 1, 7, 1, 53, 33, 168, 'crude-salt-details', 0, 0, 0, 0, 0, 1, 1, '2019-04-21 00:03:59', 1, '2019-05-06 09:58:43'),
(441, 154, 1, 7, 1, 53, 33, 180, 'require-chemical-mst', 1, 1, 1, 1, 1, 1, 1, '2019-04-21 00:04:00', 1, '2019-04-21 06:04:01'),
(442, 160, 1, 7, 1, 54, 35, 188, 'report-dashboard', 1, 1, 1, 1, 1, 1, 1, '2019-04-21 00:04:18', 1, '2019-04-21 06:04:18'),
(445, 110, 1, 7, 1, 53, 12, 154, 'user-groups', 1, 1, 1, 1, 1, 1, 1, '2019-05-06 03:17:43', 1, '2019-05-06 09:17:57'),
(446, 5, 1, 7, 1, 53, 12, 54, 'user-modules', 1, 1, 1, 1, 1, 1, 1, '2019-05-06 03:19:18', 1, '2019-05-06 09:19:32'),
(447, 6, 1, 7, 1, 53, 12, 63, 'users', 1, 1, 1, 1, 1, 1, 1, '2019-05-06 03:19:27', 1, '2019-05-06 09:19:41'),
(448, 5, 1, 7, 1, 54, 12, 54, 'user-modules', 1, 1, 1, 1, 1, 1, 1, '2019-05-06 03:19:34', 1, '2019-05-06 09:19:53'),
(449, 6, 1, 7, 1, 54, 12, 63, 'users', 1, 1, 1, 1, 1, 1, 1, '2019-05-06 03:19:35', 1, '2019-05-06 09:19:53'),
(450, 110, 1, 7, 1, 54, 12, 154, 'user-groups', 1, 1, 1, 1, 1, 1, 1, '2019-05-06 03:19:35', 1, '2019-05-06 09:19:54'),
(451, 133, 1, 7, 1, 54, 30, 167, 'lookup-groups', 1, 1, 1, 1, 1, 1, 1, '2019-05-06 03:58:50', 1, '2019-05-06 09:59:11'),
(452, 135, 1, 7, 1, 54, 30, 169, 'bsti-test-standard', 1, 1, 1, 1, 1, 1, 1, '2019-05-06 03:58:51', 1, '2019-05-06 09:59:11'),
(453, 142, 1, 7, 1, 54, 30, 175, 'association-setup', 0, 0, 0, 0, 0, 1, 1, '2019-05-06 03:58:51', 1, '2019-08-21 03:40:48'),
(454, 143, 1, 7, 1, 54, 30, 176, 'item', 1, 1, 1, 1, 1, 1, 1, '2019-05-06 03:58:51', 1, '2019-05-06 09:59:12'),
(455, 154, 1, 7, 1, 54, 33, 180, 'require-chemical-mst', 1, 1, 1, 1, 1, 1, 1, '2019-05-06 03:59:08', 1, '2019-05-06 09:59:22'),
(456, 110, 1, 7, 20, 63, 12, 154, 'user-groups', 1, 1, 1, 1, 1, 1, 1, '2019-05-06 03:59:28', 200, '2020-09-28 04:08:55'),
(457, 5, 1, 7, 20, 63, 12, 54, 'user-modules', 1, 1, 1, 1, 1, 1, 1, '2019-05-06 03:59:38', 1, '2019-05-06 09:59:52'),
(458, 6, 1, 7, 20, 63, 12, 63, 'users', 1, 1, 1, 1, 1, 1, 1, '2019-05-06 03:59:51', 1, '2019-05-06 10:00:05'),
(459, 142, 1, 7, 21, 64, 30, 175, 'association-setup', 0, 0, 0, 0, 0, 1, 1, '2019-05-06 04:01:08', 1, '2019-08-22 11:39:17'),
(460, 153, 1, 7, 22, 65, 33, 168, 'crude-salt-details', 1, 1, 1, 1, 1, 1, 1, '2019-05-11 22:26:27', 1, '2019-05-12 04:26:49'),
(461, 6, 1, 7, 1, 13, 12, 63, 'users', 1, 1, 1, 1, 1, 1, 161, '2019-05-11 23:28:36', 161, '2019-05-12 07:24:52'),
(462, 6, 1, 7, 22, 65, 12, 63, 'users', 1, 1, 1, 1, 1, 1, 1, '2019-05-17 22:35:47', 200, '2020-08-10 09:53:02'),
(463, 2, 1, 7, 1, 53, 12, 51, 'modules', 1, 1, 1, 1, 1, 1, 1, '2019-05-29 23:43:38', 162, '2020-12-31 10:04:32'),
(464, 4, 1, 7, 1, 53, 12, 53, 'organization-modules', 1, 1, 1, 1, 1, 1, 1, '2019-05-29 23:43:43', 162, '2020-12-31 10:04:37'),
(465, 3, 1, 7, 1, 53, 12, 52, 'module-links', 1, 1, 1, 1, 1, 1, 1, '2019-05-29 23:43:54', 162, '2020-12-31 10:04:41'),
(466, 2, 1, 7, 20, 63, 12, 51, 'modules', 1, 1, 1, 1, 1, 1, 1, '2019-05-29 23:45:54', 1, '2019-05-30 07:44:13'),
(467, 3, 1, 7, 20, 63, 12, 52, 'module-links', 1, 1, 1, 1, 1, 1, 1, '2019-05-29 23:45:57', 1, '2019-05-30 07:44:17'),
(468, 4, 1, 7, 20, 63, 12, 53, 'organization-modules', 1, 1, 1, 1, 1, 1, 1, '2019-05-29 23:46:01', 1, '2019-05-30 07:44:20'),
(469, 2, 1, 7, 1, 13, 12, 51, 'modules', 1, 1, 1, 1, 1, 1, 1, '2019-05-29 23:46:10', 1, '2019-05-30 07:44:30'),
(470, 3, 1, 7, 1, 13, 12, 52, 'module-links', 1, 1, 1, 1, 1, 1, 1, '2019-05-29 23:46:17', 1, '2019-05-30 07:44:34'),
(471, 4, 1, 7, 1, 13, 12, 53, 'organization-modules', 1, 1, 1, 1, 1, 1, 1, '2019-05-29 23:46:17', 1, '2019-05-30 07:44:37'),
(472, 5, 1, 7, 1, 13, 12, 54, 'user-modules', 1, 1, 1, 1, 1, 1, 1, '2019-05-29 23:46:21', 1, '2019-05-30 07:44:41'),
(473, 110, 1, 7, 1, 13, 12, 154, 'user-groups', 1, 1, 1, 1, 1, 1, 1, '2019-05-29 23:46:24', 1, '2019-05-30 07:44:44'),
(474, 133, 1, 7, 1, 13, 30, 167, 'lookup-groups', 1, 1, 1, 1, 1, 1, 1, '2019-05-29 23:46:49', 1, '2019-08-03 06:17:54'),
(475, 135, 1, 7, 1, 13, 30, 169, 'bsti-test-standard', 1, 1, 1, 1, 1, 1, 1, '2019-05-29 23:47:41', 1, '2019-05-30 07:46:02'),
(476, 142, 1, 7, 1, 13, 30, 175, 'association-setup', 0, 0, 0, 0, 0, 1, 1, '2019-05-29 23:47:54', 1, '2020-12-31 10:03:04'),
(477, 143, 1, 7, 1, 13, 30, 176, 'item', 1, 1, 1, 1, 1, 1, 1, '2019-05-29 23:47:58', 1, '2019-08-03 06:17:45'),
(478, 154, 1, 7, 1, 13, 33, 180, 'require-chemical-mst', 1, 1, 1, 1, 1, 1, 1, '2019-05-29 23:49:39', 1, '2019-05-30 07:47:58'),
(479, 161, 1, 7, 21, 64, 32, 190, 'certificate-map', 0, 0, 0, 0, 0, 1, 1, '2019-09-22 05:30:49', 162, '2019-11-07 06:34:34'),
(480, 162, 1, 7, 22, 65, 30, 191, 'brand', 1, 1, 1, 1, 1, 1, 1, '2019-09-23 22:00:43', 1, '2019-09-24 05:57:50'),
(481, 163, 1, 7, 22, 65, 31, 192, 'stock-adjustment', 1, 1, 1, 1, 1, 1, 1, '2019-09-24 23:59:34', 1, '2019-09-25 07:56:40'),
(482, 163, 1, 7, 1, 53, 31, 192, 'stock-adjustment', 0, 0, 0, 0, 0, 1, 1, '2019-09-25 00:15:39', 1, '2019-09-25 08:13:08'),
(483, 164, 1, 7, 1, 53, 30, 193, 'certificate', 1, 1, 1, 1, 1, 1, 1, '2019-09-28 02:34:13', 162, '2020-02-23 10:09:19'),
(484, 164, 1, 7, 21, 64, 30, 193, 'certificate', 0, 0, 0, 0, 0, 1, 1, '2019-09-28 02:34:31', 201, '2020-09-30 09:05:51'),
(485, 165, 1, 7, 21, 64, 30, 194, 'extended-date', 1, 1, 1, 1, 1, 1, 162, '2019-10-30 05:58:03', 162, '2019-11-07 06:34:43'),
(486, 162, 1, 7, 21, 64, 30, 191, 'brand', 0, 0, 0, 0, 0, 1, 200, '2020-09-16 09:28:38', 200, '2020-09-16 09:28:54'),
(487, 155, 1, 7, 1, 53, 34, 171, 'monitoring', 0, 0, 0, 0, 0, 1, 200, '2020-10-04 05:35:23', 200, '2020-10-05 06:43:34'),
(488, 2, 1, 7, 25, 80, 12, 51, 'modules', 0, 0, 0, 0, 0, 1, 200, '2020-11-19 20:49:16', 200, '2020-11-19 08:49:35'),
(489, 3, 1, 7, 25, 80, 12, 52, 'module-links', 0, 0, 0, 0, 0, 1, 200, '2020-11-19 20:49:22', 200, '2020-11-19 08:49:37'),
(490, 150, 1, 7, 25, 80, 32, 172, 'seller-distributor-profile', 1, 1, 1, 1, 1, 1, 200, '2020-11-19 20:49:51', 200, '2020-11-19 08:50:05'),
(491, 151, 1, 7, 25, 80, 32, 173, 'supplier-profile', 1, 1, 1, 1, 1, 1, 200, '2020-11-19 20:49:51', 200, '2020-11-19 08:50:11'),
(492, 156, 1, 7, 25, 80, 32, 184, 'mill-info', 1, 1, 1, 1, 1, 1, 200, '2020-11-19 20:49:52', 200, '2020-11-19 08:50:11'),
(493, 161, 1, 7, 25, 80, 32, 190, 'certificate-map', 1, 1, 1, 1, 1, 1, 200, '2020-11-19 20:49:53', 200, '2020-11-19 08:49:58'),
(494, 160, 1, 7, 25, 80, 35, 188, 'report-dashboard', 1, 1, 1, 1, 1, 1, 200, '2020-11-19 20:50:16', 200, '2020-11-19 08:50:21'),
(495, 156, 1, 7, 26, 81, 32, 184, 'mill-info', 1, 1, 1, 1, 1, 1, 200, '2020-11-19 22:21:19', 200, '2020-11-19 10:21:21'),
(496, 6, 1, 7, 19, 62, 12, 63, 'users', 1, 1, 1, 1, 1, 1, 200, '2020-11-21 21:59:56', 200, '2020-11-21 10:00:30'),
(497, 153, 1, 7, 19, 62, 33, 168, 'crude-salt-details', 1, 1, 1, 1, 1, 1, 200, '2020-11-21 22:00:32', 200, '2020-11-21 10:01:13'),
(498, 154, 1, 7, 19, 62, 33, 180, 'require-chemical-mst', 1, 1, 1, 1, 1, 1, 200, '2020-11-21 22:01:13', 200, '2020-11-21 10:01:14'),
(499, 145, 1, 7, 19, 62, 31, 178, 'chemical-purchase', 1, 1, 1, 1, 1, 1, 200, '2020-11-21 22:01:14', 200, '2020-11-21 10:01:15'),
(500, 146, 1, 7, 19, 62, 31, 179, 'crude-salt-procurement', 1, 1, 1, 1, 1, 1, 200, '2020-11-21 22:01:14', 200, '2020-11-21 10:01:16'),
(501, 149, 1, 7, 19, 62, 31, 182, 'washing-crushing', 1, 1, 1, 1, 1, 1, 200, '2020-11-21 22:01:15', 200, '2020-11-21 10:01:16'),
(502, 150, 1, 7, 19, 62, 32, 172, 'seller-distributor-profile', 1, 1, 1, 1, 1, 1, 200, '2020-11-21 22:01:19', 200, '2020-11-21 10:01:23'),
(503, 151, 1, 7, 23, 79, 32, 173, 'supplier-profile', 1, 1, 1, 1, 1, 1, 200, '2020-11-29 11:38:14', 200, '2020-11-29 11:38:31'),
(504, 156, 1, 7, 23, 79, 32, 184, 'mill-info', 1, 1, 1, 1, 1, 1, 200, '2020-11-29 11:38:31', 200, '2020-11-29 11:38:31'),
(505, 6, 1, 7, 23, 79, 12, 63, 'users', 1, 1, 1, 1, 1, 1, 200, '2020-11-29 11:38:38', 200, '2020-11-29 11:38:42'),
(506, 2, 1, 7, 1, 54, 12, 51, 'modules', 1, 1, 1, 1, 1, 1, 162, '2020-12-31 10:04:51', 162, '2020-12-31 10:04:54'),
(507, 3, 1, 7, 1, 54, 12, 52, 'module-links', 1, 1, 1, 1, 1, 1, 162, '2020-12-31 10:04:55', 162, '2020-12-31 10:04:59'),
(508, 4, 1, 7, 1, 54, 12, 53, 'organization-modules', 1, 1, 1, 1, 1, 1, 162, '2020-12-31 10:05:00', 162, '2020-12-31 10:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `sa_ug_level`
--

CREATE TABLE `sa_ug_level` (
  `UG_LEVEL_ID` bigint(14) NOT NULL,
  `USERGRP_ID` bigint(14) DEFAULT NULL,
  `ORG_ID` int(11) DEFAULT 1,
  `UGLEVE_NAME` varchar(50) DEFAULT NULL,
  `SL_NO` tinyint(2) DEFAULT NULL,
  `IS_ACTIVE` tinyint(1) DEFAULT 1 COMMENT '0=no, 1=yes',
  `CREATED_BY` int(10) DEFAULT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATED_BY` int(10) DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `POSITIONLEVEl` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sa_ug_level`
--

INSERT INTO `sa_ug_level` (`UG_LEVEL_ID`, `USERGRP_ID`, `ORG_ID`, `UGLEVE_NAME`, `SL_NO`, `IS_ACTIVE`, `CREATED_BY`, `CREATED_AT`, `UPDATED_BY`, `UPDATED_AT`, `POSITIONLEVEl`) VALUES
(13, 1, 1, 'Super Admin', NULL, 1, 1, '2018-08-13 16:18:59', 1, '2018-11-24 10:34:31', 1),
(53, 1, 1, 'Admin 1', NULL, 1, 1, '2019-04-16 16:47:41', 200, '2020-09-20 05:48:17', 2),
(54, 1, 1, 'Admin 2', NULL, 1, 1, '2019-04-16 16:48:14', 200, '2020-09-19 10:40:14', 3),
(61, 18, 1, 'BSTI', NULL, 1, 1, '2019-04-17 17:34:50', NULL, NULL, 19),
(62, 19, 1, 'BSCIC', NULL, 1, 1, '2019-04-17 17:35:37', 200, '2019-11-07 06:25:28', 20),
(63, 20, 1, 'UNICEF', NULL, 1, 1, '2019-04-17 17:36:21', NULL, NULL, 21),
(64, 21, 1, 'Association Admin', NULL, 1, 1, '2019-04-17 17:37:07', NULL, NULL, 22),
(65, 22, 1, 'Miller Admin', NULL, 1, 1, '2019-04-17 17:38:04', 200, '2020-08-10 10:33:41', 23),
(67, 22, 1, 'Millers Sales Admin', NULL, 1, 200, '2019-08-25 18:01:15', NULL, NULL, 24),
(68, 22, 1, 'sales admin', NULL, 1, 200, '2019-08-25 18:01:43', NULL, NULL, 25),
(69, 24, 1, 'ttt', NULL, 0, 200, '2020-08-09 20:53:45', 200, '2020-08-10 08:56:39', 26),
(71, 26, 1, 'level 1', NULL, 0, 200, '2020-08-09 21:30:40', 200, '2020-08-10 09:30:50', 28),
(76, 28, 1, 'Test Level', NULL, 1, 200, '2020-09-20 03:21:42', NULL, NULL, 1),
(79, 23, 1, 'Level 1', NULL, 1, 200, '2020-11-19 02:16:47', NULL, NULL, 10),
(80, 25, 1, 'Level 2', NULL, 1, 200, '2020-11-19 02:48:10', NULL, NULL, 99),
(81, 26, 1, 'Level 1', NULL, 1, 200, '2020-11-19 04:20:59', NULL, NULL, 100),
(84, 33, 1, 'IPHN Level 1', NULL, 1, 200, '2020-11-29 04:47:59', NULL, NULL, 110);

-- --------------------------------------------------------

--
-- Table structure for table `sa_user_group`
--

CREATE TABLE `sa_user_group` (
  `USERGRP_ID` int(11) NOT NULL,
  `ORG_ID` int(11) DEFAULT NULL,
  `USERGRP_NAME` varchar(50) DEFAULT NULL,
  `IS_ACTIVE` tinyint(1) DEFAULT 1 COMMENT '0=no, 1=yes',
  `CREATED_BY` int(10) DEFAULT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATED_BY` int(10) DEFAULT NULL,
  `UPDATED_AT` datetime DEFAULT NULL,
  `GROUP_LEVEL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sa_user_group`
--

INSERT INTO `sa_user_group` (`USERGRP_ID`, `ORG_ID`, `USERGRP_NAME`, `IS_ACTIVE`, `CREATED_BY`, `CREATED_AT`, `UPDATED_BY`, `UPDATED_AT`, `GROUP_LEVEL`) VALUES
(1, 1, 'Administrator', 1, NULL, '2018-08-11 22:26:59', 200, '2020-10-04 10:52:09', NULL),
(18, 1, 'BSTI', 1, 1, '2019-04-17 17:33:20', NULL, NULL, NULL),
(19, 1, 'BSCIC', 1, 1, '2019-04-17 17:35:23', 200, '2019-11-06 10:50:36', NULL),
(20, 1, 'UNICEF', 1, 1, '2019-04-17 17:36:09', NULL, NULL, NULL),
(21, 1, 'Association Cox\'s Bazar', 1, 1, '2019-04-17 17:36:44', 200, '2020-11-19 08:10:52', 5),
(22, 1, 'Mills', 1, 1, '2019-04-17 17:37:43', 200, '2020-09-28 05:40:28', 5),
(23, 1, 'Association Chattogram', 1, 200, '2020-11-19 02:11:14', NULL, NULL, NULL),
(25, 1, 'Association Dhaka', 1, 200, '2020-11-19 02:38:02', NULL, NULL, NULL),
(26, 1, 'Association Patiya', 1, 200, '2020-11-19 02:40:28', NULL, NULL, NULL),
(33, 1, 'IPHN', 1, 200, '2020-11-29 04:45:54', NULL, NULL, NULL),
(37, 1, 'MOI', 1, 200, '2020-11-29 04:46:19', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `smm_certificate`
--

CREATE TABLE `smm_certificate` (
  `CERTIFICATE_ID` int(11) NOT NULL,
  `CERTIFICATE_TYPE_ID` int(200) NOT NULL,
  `CERTIFICATE_TYPE` int(1) DEFAULT 0,
  `ISSUR_ID` int(11) DEFAULT NULL,
  `mill_type_id` int(11) DEFAULT NULL,
  `IS_EXPIRE` int(1) DEFAULT 0,
  `ACTIVE_FLG` int(1) NOT NULL,
  `center_id` int(11) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smm_certificate`
--

INSERT INTO `smm_certificate` (`CERTIFICATE_ID`, `CERTIFICATE_TYPE_ID`, `CERTIFICATE_TYPE`, `ISSUR_ID`, `mill_type_id`, `IS_EXPIRE`, `ACTIVE_FLG`, `center_id`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`) VALUES
(19, 34, 1, 58, 21, 0, 1, 61, 204, '2020-10-03 06:02:44', 200, '2020-10-02 23:57:21'),
(22, 31, 1, 56, 21, 0, 1, 61, 204, '2020-10-03 06:03:07', 200, '2020-10-02 23:57:43'),
(23, 35, 0, 59, 20, 1, 1, 61, 204, '2020-09-27 22:43:27', NULL, '2020-09-28 04:48:44'),
(24, 39, 1, 60, 20, 0, 1, 0, 200, '2020-10-15 07:05:52', 200, '2020-10-15 01:00:15'),
(33, 36, 0, 60, 19, 0, 1, 0, 200, '2020-10-24 03:59:02', 200, '2020-10-23 21:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `smm_item`
--

CREATE TABLE `smm_item` (
  `ITEM_NO` int(11) NOT NULL,
  `UD_ITEM_NO` varchar(15) DEFAULT NULL,
  `ITEM_NAME` varchar(200) DEFAULT NULL,
  `ITEM_TYPE` int(11) DEFAULT NULL,
  `UNIT_NO` int(11) DEFAULT NULL,
  `LOW_UNIT_NO` int(11) DEFAULT NULL,
  `CONV_QTY` int(11) DEFAULT NULL,
  `PACK_SIZE` varchar(10) DEFAULT NULL,
  `UNIT_PRICE` int(11) DEFAULT NULL,
  `ACTIVE_FLG` int(1) NOT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smm_item`
--

INSERT INTO `smm_item` (`ITEM_NO`, `UD_ITEM_NO`, `ITEM_NAME`, `ITEM_TYPE`, `UNIT_NO`, `LOW_UNIT_NO`, `CONV_QTY`, `PACK_SIZE`, `UNIT_PRICE`, `ACTIVE_FLG`, `DESCRIPTION`, `REMARKS`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `center_id`) VALUES
(2, NULL, 'Black Salt', 26, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, '2020-08-12 23:59:29', 200, '2020-08-12 17:57:29', NULL, NULL, NULL),
(3, NULL, 'Polythene Salt', 26, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, '2019-04-02 22:13:40', NULL, '2019-04-02 22:13:40', NULL, NULL, NULL),
(4, NULL, 'Imported Salt', 26, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, '2019-04-02 22:13:51', NULL, '2019-04-02 22:13:51', NULL, NULL, NULL),
(6, NULL, 'KIO3', 25, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, '2019-06-11 04:05:17', 200, '2019-06-10 22:06:07', NULL, NULL, NULL),
(7, NULL, 'Wash & Crushing', 29, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, '2020-09-20 10:45:54', 200, '2020-09-20 04:45:54', NULL, NULL, 0),
(8, NULL, 'Iodized', 29, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, '2020-09-20 10:46:07', 200, '2020-09-20 04:46:07', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `smm_require_chemical`
--

CREATE TABLE `smm_require_chemical` (
  `REQUIRE_CHEMICAL_ID` int(11) NOT NULL,
  `ITEM_NO` int(11) DEFAULT NULL,
  `SALT_AMOUNT` int(11) DEFAULT NULL,
  `CHEMICAL_AMOUNT` float DEFAULT NULL,
  `WASTAGE_AMOUNT` float DEFAULT NULL,
  `ACTIVE_FLG` int(1) NOT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `smm_rmallocationchd`
--

CREATE TABLE `smm_rmallocationchd` (
  `RMALLOCHD_ID` int(11) NOT NULL,
  `RMALLOMST_ID` int(11) DEFAULT NULL,
  `ITEM_ID` int(11) DEFAULT NULL,
  `UOM_ID` int(11) DEFAULT NULL,
  `USE_QTY` float DEFAULT NULL,
  `WAST_PER` float DEFAULT NULL,
  `WAST_QTY` float DEFAULT NULL,
  `ACTIVE_FLG` int(1) NOT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `CRUDE_SALT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smm_rmallocationchd`
--

INSERT INTO `smm_rmallocationchd` (`RMALLOCHD_ID`, `RMALLOMST_ID`, `ITEM_ID`, `UOM_ID`, `USE_QTY`, `WAST_PER`, `WAST_QTY`, `ACTIVE_FLG`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `CRUDE_SALT`) VALUES
(1, 29, 6, NULL, 0.0009, NULL, NULL, 1, 200, '2020-10-24 04:03:11', 200, '2020-10-23 21:57:26', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `smm_rmallocationmst`
--

CREATE TABLE `smm_rmallocationmst` (
  `RMALLOMST_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) DEFAULT NULL,
  `UOM_ID` int(11) DEFAULT NULL,
  `ALLO_TYPE` varchar(2) DEFAULT NULL,
  `ACTIVE_FLG` int(1) NOT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smm_rmallocationmst`
--

INSERT INTO `smm_rmallocationmst` (`RMALLOMST_ID`, `PRODUCT_ID`, `UOM_ID`, `ALLO_TYPE`, `ACTIVE_FLG`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`) VALUES
(29, 8, NULL, NULL, 1, 200, '2020-08-09 22:21:38', NULL, '2020-08-10 04:23:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssc_country`
--

CREATE TABLE `ssc_country` (
  `COUNTRY_ID` int(4) UNSIGNED NOT NULL,
  `COUNTRY_NAME` varchar(30) NOT NULL,
  `COUNTRY_NAME_BN` varchar(50) NOT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ssc_country`
--

INSERT INTO `ssc_country` (`COUNTRY_ID`, `COUNTRY_NAME`, `COUNTRY_NAME_BN`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`) VALUES
(1, 'Afghanistan', '???????', NULL, '2019-04-08 21:26:10', NULL, '2019-04-08 21:26:10', NULL, NULL),
(2, 'Albania', '???????', NULL, '2019-04-08 21:26:13', NULL, '2019-04-08 21:26:13', NULL, NULL),
(3, 'Algeria', '??????', NULL, '2019-04-08 21:26:48', NULL, '2019-04-08 21:26:48', NULL, NULL),
(4, 'Bahrain', '??????', NULL, '2019-04-08 21:27:22', NULL, '2019-04-08 21:27:22', NULL, NULL),
(5, 'Bangladesh', '??????', NULL, '2019-04-08 21:27:44', NULL, '2019-04-08 21:27:44', NULL, NULL),
(6, 'China', '??????', NULL, '2019-04-08 21:28:25', NULL, '2019-04-08 21:28:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssc_districts`
--

CREATE TABLE `ssc_districts` (
  `DISTRICT_ID` int(4) UNSIGNED NOT NULL,
  `DIVISION_ID` int(4) UNSIGNED NOT NULL,
  `DISTRICT_NAME` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `DISTRICT_NAME_BN` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `LAT` double NOT NULL,
  `LON` double NOT NULL,
  `WEBSITE` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ssc_districts`
--

INSERT INTO `ssc_districts` (`DISTRICT_ID`, `DIVISION_ID`, `DISTRICT_NAME`, `DISTRICT_NAME_BN`, `LAT`, `LON`, `WEBSITE`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`) VALUES
(1, 3, 'Dhaka', 'à¦¢à¦¾à¦•à¦¾', 23.7115253, 90.4111451, 'www.dhaka.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(2, 3, 'Faridpur', 'à¦«à¦°à¦¿à¦¦à¦ªà§à¦°', 23.6070822, 89.8429406, 'www.faridpur.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(3, 3, 'Gazipur', 'à¦—à¦¾à¦œà§€à¦ªà§à¦°', 24.0022858, 90.4264283, 'www.gazipur.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(4, 3, 'Gopalganj', 'à¦—à§‹à¦ªà¦¾à¦²à¦—à¦žà§à¦œ', 23.0050857, 89.8266059, 'www.gopalganj.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(5, 8, 'Jamalpur', 'à¦œà¦¾à¦®à¦¾à¦²à¦ªà§à¦°', 24.937533, 89.937775, 'www.jamalpur.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2016-04-05 22:48:38', NULL, NULL),
(6, 3, 'Kishoreganj', 'à¦•à¦¿à¦¶à§‹à¦°à¦—à¦žà§à¦œ', 24.444937, 90.776575, 'www.kishoreganj.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(7, 3, 'Madaripur', 'à¦®à¦¾à¦¦à¦¾à¦°à§€à¦ªà§à¦°', 23.164102, 90.1896805, 'www.madaripur.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(8, 3, 'Manikganj', 'à¦®à¦¾à¦¨à¦¿à¦•à¦—à¦žà§à¦œ', 0, 0, 'www.manikganj.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(9, 3, 'Munshiganj', 'à¦®à§à¦¨à§à¦¸à¦¿à¦—à¦žà§à¦œ', 0, 0, 'www.munshiganj.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(10, 8, 'Mymensingh', 'à¦®à§Ÿà¦®à¦¨à¦¸à¦¿à¦‚', 0, 0, 'www.mymensingh.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2016-04-05 22:49:01', NULL, NULL),
(11, 3, 'Narayanganj', 'à¦¨à¦¾à¦°à¦¾à§Ÿà¦¾à¦£à¦—à¦žà§à¦œ', 23.63366, 90.496482, 'www.narayanganj.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(12, 3, 'Narsingdi', 'à¦¨à¦°à¦¸à¦¿à¦‚à¦¦à§€', 23.932233, 90.71541, 'www.narsingdi.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(13, 8, 'Netrokona', 'à¦¨à§‡à¦¤à§à¦°à¦•à§‹à¦¨à¦¾', 24.870955, 90.727887, 'www.netrokona.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2016-04-05 22:46:31', NULL, NULL),
(14, 3, 'Rajbari', 'à¦°à¦¾à¦œà¦¬à¦¾à§œà¦¿', 23.7574305, 89.6444665, 'www.rajbari.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(15, 3, 'Shariatpur', 'à¦¶à¦°à§€à§Ÿà¦¤à¦ªà§à¦°', 0, 0, 'www.shariatpur.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(16, 8, 'Sherpur', 'à¦¶à§‡à¦°à¦ªà§à¦°', 25.0204933, 90.0152966, 'www.sherpur.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2016-04-05 22:48:21', NULL, NULL),
(17, 3, 'Tangail', 'à¦Ÿà¦¾à¦™à§à¦—à¦¾à¦‡à¦²', 0, 0, 'www.tangail.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(18, 5, 'Bogura', 'à¦¬à¦—à§à§œà¦¾', 24.8465228, 89.377755, 'www.bogra.gov.bd', NULL, '2020-08-26 00:08:13', NULL, '2020-08-26 00:08:13', NULL, NULL),
(19, 5, 'Joypurhat', 'à¦œà§Ÿà¦ªà§à¦°à¦¹à¦¾à¦Ÿ', 0, 0, 'www.joypurhat.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(20, 5, 'Naogaon', 'à¦¨à¦“à¦—à¦¾à¦', 0, 0, 'www.naogaon.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(21, 5, 'Natore', 'à¦¨à¦¾à¦Ÿà§‹à¦°', 24.420556, 89.000282, 'www.natore.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(22, 5, 'Nawabganj', 'à¦¨à¦¬à¦¾à¦¬à¦—à¦žà§à¦œ', 24.5965034, 88.2775122, 'www.chapainawabganj.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(23, 5, 'Pabna', 'à¦ªà¦¾à¦¬à¦¨à¦¾', 23.998524, 89.233645, 'www.pabna.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(24, 5, 'Rajshahi', 'à¦°à¦¾à¦œà¦¶à¦¾à¦¹à§€', 0, 0, 'www.rajshahi.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(25, 5, 'Sirajgonj', 'à¦¸à¦¿à¦°à¦¾à¦œà¦—à¦žà§à¦œ', 24.4533978, 89.7006815, 'www.sirajganj.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(26, 6, 'Dinajpur', 'à¦¦à¦¿à¦¨à¦¾à¦œà¦ªà§à¦°', 25.6217061, 88.6354504, 'www.dinajpur.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(27, 6, 'Gaibandha', 'à¦—à¦¾à¦‡à¦¬à¦¾à¦¨à§à¦§à¦¾', 25.328751, 89.528088, 'www.gaibandha.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(28, 6, 'Kurigram', 'à¦•à§à§œà¦¿à¦—à§à¦°à¦¾à¦®', 25.805445, 89.636174, 'www.kurigram.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(29, 6, 'Lalmonirhat', 'à¦²à¦¾à¦²à¦®à¦¨à¦¿à¦°à¦¹à¦¾à¦Ÿ', 0, 0, 'www.lalmonirhat.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(30, 6, 'Nilphamari', 'à¦¨à§€à¦²à¦«à¦¾à¦®à¦¾à¦°à§€', 25.931794, 88.856006, 'www.nilphamari.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(31, 6, 'Panchagarh', 'à¦ªà¦žà§à¦šà¦—à§œ', 26.3411, 88.5541606, 'www.panchagarh.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(32, 6, 'Rangpur', 'à¦°à¦‚à¦ªà§à¦°', 25.7558096, 89.244462, 'www.rangpur.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(33, 6, 'Thakurgaon', 'à¦ à¦¾à¦•à§à¦°à¦—à¦¾à¦à¦“', 26.0336945, 88.4616834, 'www.thakurgaon.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(34, 1, 'Barguna', 'à¦¬à¦°à¦—à§à¦¨à¦¾', 0, 0, 'www.barguna.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(35, 1, 'Barishal', 'à¦¬à¦°à¦¿à¦¶à¦¾à¦²', 0, 0, 'www.barisal.gov.bd', NULL, '2020-08-26 00:07:40', NULL, '2020-08-26 00:07:40', NULL, NULL),
(36, 1, 'Bhola', 'à¦­à§‹à¦²à¦¾', 22.685923, 90.648179, 'www.bhola.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(37, 1, 'Jhalokati', 'à¦à¦¾à¦²à¦•à¦¾à¦ à¦¿', 0, 0, 'www.jhalakathi.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(38, 1, 'Patuakhali', 'à¦ªà¦Ÿà§à§Ÿà¦¾à¦–à¦¾à¦²à§€', 22.3596316, 90.3298712, 'www.patuakhali.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(39, 1, 'Pirojpur', 'à¦ªà¦¿à¦°à§‹à¦œà¦ªà§à¦°', 0, 0, 'www.pirojpur.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(40, 2, 'Bandarban', 'à¦¬à¦¾à¦¨à§à¦¦à¦°à¦¬à¦¾à¦¨', 22.1953275, 92.2183773, 'www.bandarban.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(41, 2, 'Brahmanbaria', 'à¦¬à§à¦°à¦¾à¦¹à§à¦®à¦£à¦¬à¦¾à§œà¦¿à§Ÿà¦¾', 23.9570904, 91.1119286, 'www.brahmanbaria.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(42, 2, 'Chandpur', 'à¦šà¦¾à¦à¦¦à¦ªà§à¦°', 23.2332585, 90.6712912, 'www.chandpur.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(43, 2, 'Chattogram', 'à¦šà¦Ÿà§à¦Ÿà¦—à§à¦°à¦¾à¦®', 22.335109, 91.834073, 'www.chittagong.gov.bd', NULL, '2020-10-15 08:32:39', NULL, '2020-10-15 08:32:39', NULL, NULL),
(44, 2, 'Cumilla', 'à¦•à§à¦®à¦¿à¦²à§à¦²à¦¾', 23.4682747, 91.1788135, 'www.comilla.gov.bd', NULL, '2020-08-26 00:09:00', NULL, '2020-08-26 00:09:00', NULL, NULL),
(45, 2, 'Cox\'s Bazar', 'à¦•à¦•à§à¦¸ à¦¬à¦¾à¦œà¦¾à¦°', 0, 0, 'www.coxsbazar.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(46, 2, 'Feni', 'à¦«à§‡à¦¨à§€', 23.023231, 91.3840844, 'www.feni.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(47, 2, 'Khagrachari', 'à¦–à¦¾à¦—à§œà¦¾à¦›à§œà¦¿', 23.119285, 91.984663, 'www.khagrachhari.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(48, 2, 'Lakshmipur', 'à¦²à¦•à§à¦·à§à¦®à§€à¦ªà§à¦°', 22.942477, 90.841184, 'www.lakshmipur.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(49, 2, 'Noakhali', 'à¦¨à§‹à§Ÿà¦¾à¦–à¦¾à¦²à§€', 22.869563, 91.099398, 'www.noakhali.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(50, 2, 'Rangamati', 'à¦°à¦¾à¦™à§à¦—à¦¾à¦®à¦¾à¦Ÿà¦¿', 0, 0, 'www.rangamati.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(51, 7, 'Habiganj', 'à¦¹à¦¬à¦¿à¦—à¦žà§à¦œ', 24.374945, 91.41553, 'www.habiganj.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(52, 7, 'Maulvibazar', 'à¦®à§Œà¦²à¦­à§€à¦¬à¦¾à¦œà¦¾à¦°', 24.482934, 91.777417, 'www.moulvibazar.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(53, 7, 'Sunamganj', 'à¦¸à§à¦¨à¦¾à¦®à¦—à¦žà§à¦œ', 25.0658042, 91.3950115, 'www.sunamganj.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(54, 7, 'Sylhet', 'à¦¸à¦¿à¦²à§‡à¦Ÿ', 24.8897956, 91.8697894, 'www.sylhet.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(55, 4, 'Bagerhat', 'à¦¬à¦¾à¦—à§‡à¦°à¦¹à¦¾à¦Ÿ', 22.651568, 89.785938, 'www.bagerhat.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(56, 4, 'Chuadanga', 'à¦šà§à§Ÿà¦¾à¦¡à¦¾à¦™à§à¦—à¦¾', 23.6401961, 88.841841, 'www.chuadanga.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(57, 4, 'Jashore', 'à¦¯à¦¶à§‹à¦°', 23.16643, 89.2081126, 'www.jessore.gov.bd', NULL, '2020-08-26 00:21:48', NULL, '2020-08-26 00:21:48', NULL, NULL),
(58, 4, 'Jhenaidah', 'à¦à¦¿à¦¨à¦¾à¦‡à¦¦à¦¹', 23.5448176, 89.1539213, 'www.jhenaidah.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(59, 4, 'Khulna', 'à¦–à§à¦²à¦¨à¦¾', 22.815774, 89.568679, 'www.khulna.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(60, 4, 'Kushtia', 'à¦•à§à¦·à§à¦Ÿà¦¿à§Ÿà¦¾', 23.901258, 89.120482, 'www.kushtia.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(61, 4, 'Magura', 'à¦®à¦¾à¦—à§à¦°à¦¾', 23.487337, 89.419956, 'www.magura.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(62, 4, 'Meherpur', 'à¦®à§‡à¦¹à§‡à¦°à¦ªà§à¦°', 23.762213, 88.631821, 'www.meherpur.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(63, 4, 'Narail', 'à¦¨à§œà¦¾à¦‡à¦²', 23.172534, 89.512672, 'www.narail.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL),
(64, 4, 'Satkhira', 'à¦¸à¦¾à¦¤à¦•à§à¦·à§€à¦°à¦¾', 0, 0, 'www.satkhira.gov.bd', NULL, '2015-09-12 16:33:27', NULL, '2015-09-12 16:36:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssc_districts_180520`
--

CREATE TABLE `ssc_districts_180520` (
  `DISTRICT_ID` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `DIVISION_ID` int(4) UNSIGNED NOT NULL,
  `DISTRICT_NAME` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DISTRICT_NAME_BN` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `LAT` double NOT NULL,
  `LON` double NOT NULL,
  `WEBSITE` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ssc_districts_180520`
--

INSERT INTO `ssc_districts_180520` (`DISTRICT_ID`, `DIVISION_ID`, `DISTRICT_NAME`, `DISTRICT_NAME_BN`, `LAT`, `LON`, `WEBSITE`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`) VALUES
(1, 4, 'BAGERHAT', '', 401, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(2, 2, 'BANDARBAN', '', 203, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(3, 1, 'BARGUNA', '', 104, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(4, 1, 'BARISAL', '', 106, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(5, 1, 'BHOLA', '', 109, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(6, 5, 'BOGRA', '', 510, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(7, 2, 'BRAHAMANBARIA', '', 212, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(8, 2, 'CHANDPUR', '', 213, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(9, 2, 'CHATTOGRAM              ', '', 215, 0, '1', 0, '2020-10-15 08:31:52', NULL, '2020-10-15 08:31:52', NULL, NULL),
(10, 4, 'CHUADANGA', '', 418, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(11, 2, 'COMILLA', '', 219, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(12, 2, 'COX\'S BAZAR', '', 222, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(13, 3, 'DHAKA', '', 326, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(14, 8, 'DINAJPUR', '', 527, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(15, 3, 'FARIDPUR', '', 329, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(16, 2, 'FENI', '', 230, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(17, 8, 'GAIBANDHA', '', 532, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(18, 3, 'GAZIPUR', '', 333, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(19, 3, 'GOPALGANJ', '', 335, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(20, 6, 'HABIGANJ', '', 636, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(21, 5, 'JOYPURHAT', '', 538, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(22, 3, 'JAMALPUR', '', 339, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(23, 4, 'JESSORE', '', 441, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(24, 1, 'JHALOKATI', '', 142, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(25, 4, 'JHENAIDAH', '', 444, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(26, 2, 'KHAGRACHHARI', '', 246, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(27, 4, 'KHULNA', '', 447, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(28, 3, 'KISHOREGANJ', '', 348, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(29, 8, 'KURIGRAM', '', 549, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(30, 4, 'KUSHTIA', '', 450, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(31, 2, 'LAKSHMIPUR', '', 251, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(32, 8, 'LALMONIRHAT', '', 552, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(33, 3, 'MADARIPUR', '', 354, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(34, 4, 'MAGURA', '', 455, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(35, 3, 'MANIKGANJ', '', 356, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(36, 4, 'MEHERPUR', '', 457, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(37, 6, 'MAULVIBAZAR', '', 658, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(38, 3, 'MUNSHIGANJ', '', 359, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(39, 3, 'MYMENSINGH', '', 361, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(40, 5, 'NAOGAON', '', 564, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(41, 4, 'NORAIL', '', 465, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(42, 3, 'NARAYANGANJ', '', 367, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(43, 3, 'NARSINGDI', '', 368, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(44, 5, 'NATORE', '', 569, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(45, 5, 'NAWABGANJ', '', 570, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(46, 3, 'NETRAKONA', '', 372, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(47, 8, 'NILPHAMARI', '', 573, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(48, 2, 'NOAKHALI', '', 275, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(49, 5, 'PABNA', '', 576, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(50, 8, 'PANCHAGARH', '', 577, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(51, 1, 'PATUAKHALI', '', 178, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(52, 1, 'PIROJPUR', '', 179, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(53, 5, 'RAJSHAHI', '', 581, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(54, 3, 'RAJBARI', '', 382, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(55, 2, 'RANGAMATI', '', 284, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(56, 8, 'RANGPUR', '', 585, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(57, 3, 'SHARIATPUR', '', 386, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(58, 4, 'SATKHIRA', '', 487, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(59, 5, 'SIRAJGANJ', '', 588, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(60, 3, 'SHERPUR', '', 389, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(61, 6, 'SUNAMGANJ', '', 690, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(62, 6, 'SYLHET', '', 691, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(63, 3, 'TANGAIL', '', 393, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(64, 8, 'THAKURGAON', '', 594, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(85, 13, 'District Name ', '', 0, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(86, 5, 'Chapinawabganj', '', 0, 0, '1', 0, '2016-10-14 17:26:14', NULL, '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssc_divisions`
--

CREATE TABLE `ssc_divisions` (
  `DIVISION_ID` int(4) UNSIGNED NOT NULL,
  `ZONE_ID` int(11) DEFAULT NULL,
  `DIVISION_NAME` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `DIVISION_NAME_BN` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ssc_divisions`
--

INSERT INTO `ssc_divisions` (`DIVISION_ID`, `ZONE_ID`, `DIVISION_NAME`, `DIVISION_NAME_BN`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`) VALUES
(1, NULL, 'Barishal', 'à¦¬à¦°à¦¿à¦¶à¦¾à¦²', NULL, '2020-08-25 12:00:00', NULL, '2020-08-25 12:00:00', NULL, NULL),
(2, NULL, 'Chattogram', 'à¦šà¦Ÿà§à¦Ÿà¦—à§à¦°à¦¾à¦®', NULL, '2020-08-26 00:05:59', NULL, '2020-08-26 00:05:59', NULL, NULL),
(3, NULL, 'Dhaka', 'à¦¢à¦¾à¦•à¦¾', NULL, '2020-08-25 12:00:00', NULL, '2020-08-25 12:00:00', NULL, NULL),
(4, NULL, 'Khulna', 'à¦–à§à¦²à¦¨à¦¾', NULL, '2020-08-25 12:00:00', NULL, '2020-08-25 12:00:00', NULL, NULL),
(5, NULL, 'Rajshahi', 'à¦°à¦¾à¦œà¦¶à¦¾à¦¹à§€', NULL, '2020-08-25 12:00:00', NULL, '2020-08-25 12:00:00', NULL, NULL),
(6, NULL, 'Rangpur', 'à¦°à¦‚à¦ªà§à¦°', NULL, '2020-08-25 12:00:00', NULL, '2020-08-25 12:00:00', NULL, NULL),
(7, NULL, 'Sylhet', 'à¦¸à¦¿à¦²à§‡à¦Ÿ', NULL, '2020-08-25 12:00:00', NULL, '2020-08-25 12:00:00', NULL, NULL),
(8, NULL, 'Mymensingh', 'à¦®à¦¯à¦¼à¦®à¦¨à¦¸à¦¿à¦‚à¦¹', NULL, '2020-08-26 00:05:38', NULL, '2020-08-25 12:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssc_divisions_180520`
--

CREATE TABLE `ssc_divisions_180520` (
  `DIVISION_ID` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `ZONE_ID` int(11) DEFAULT NULL,
  `DIVISION_NAME` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DIVISION_NAME_BN` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ssc_divisions_180520`
--

INSERT INTO `ssc_divisions_180520` (`DIVISION_ID`, `ZONE_ID`, `DIVISION_NAME`, `DIVISION_NAME_BN`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`) VALUES
(1, NULL, 'BARISAL', '', 1, '2015-05-19 15:22:37', NULL, '2015-09-13 04:39:43', NULL, NULL),
(2, NULL, 'CHITTAGONG', '', 1, '2015-05-19 15:22:37', NULL, '2015-09-13 04:39:43', NULL, NULL),
(3, NULL, 'DHAKA', '', 1, '2015-05-19 15:22:37', NULL, '2015-09-13 04:39:43', NULL, NULL),
(4, NULL, 'KHULNA', '', 1, '2015-05-19 15:22:37', NULL, '2015-09-13 04:39:43', NULL, NULL),
(5, NULL, 'RAJSHAHI', '', 1, '2015-05-19 15:22:37', NULL, '2015-09-13 04:39:43', NULL, NULL),
(6, NULL, 'SYLHET', '', 1, '2015-05-19 15:22:37', NULL, '2015-09-13 04:39:43', NULL, NULL),
(8, NULL, 'RANGPUR', '', 1, '2015-05-19 15:22:37', NULL, '2015-09-13 04:39:43', NULL, NULL),
(13, NULL, 'MAYMANSING', '', 1, '2016-07-23 20:34:05', NULL, '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssc_lookupchd`
--

CREATE TABLE `ssc_lookupchd` (
  `LOOKUPCHD_ID` int(11) NOT NULL,
  `LOOKUPMST_ID` int(11) DEFAULT NULL,
  `LOOKUPCHD_NAME` varchar(150) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `UD_ID` int(10) UNSIGNED DEFAULT NULL,
  `ACTIVE_FLG` int(1) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Basic data list';

--
-- Dumping data for table `ssc_lookupchd`
--

INSERT INTO `ssc_lookupchd` (`LOOKUPCHD_ID`, `LOOKUPMST_ID`, `LOOKUPCHD_NAME`, `DESCRIPTION`, `REMARKS`, `UD_ID`, `ACTIVE_FLG`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `center_id`) VALUES
(1, 1, 'BSTI', 'none', NULL, 1, 1, 1, '2019-06-11 00:47:06', 200, '2019-06-10 18:47:56', NULL, NULL, NULL),
(2, 1, 'BSCIC', NULL, NULL, 2, 1, 1, '2019-03-31 22:46:31', NULL, '2019-03-31 22:46:31', NULL, NULL, NULL),
(3, 1, 'Association', NULL, NULL, 3, 1, 1, '2019-03-31 22:47:06', NULL, '2019-03-31 22:47:06', NULL, NULL, NULL),
(7, 3, 'Wholesaler', NULL, NULL, 7, 1, 1, '2019-03-31 22:53:07', NULL, '2019-03-31 22:53:07', NULL, NULL, NULL),
(8, 3, 'Retailer', NULL, NULL, 8, 1, 1, '2019-03-31 22:53:34', NULL, '2019-03-31 22:53:34', NULL, NULL, NULL),
(9, 3, 'Distributor', NULL, NULL, 9, 1, 1, '2019-03-31 22:54:02', NULL, '2019-03-31 22:54:02', NULL, NULL, NULL),
(10, 4, 'New', NULL, NULL, 401, 1, 1, '2019-04-01 02:07:51', NULL, '2019-04-01 02:07:51', NULL, NULL, NULL),
(11, 4, 'Merging', NULL, NULL, 402, 1, 1, '2019-04-01 02:09:38', NULL, '2019-04-01 02:09:38', NULL, NULL, NULL),
(12, 5, 'Single', NULL, NULL, 501, 1, 1, '2019-04-08 23:47:18', 1, '2019-04-08 17:46:44', NULL, NULL, NULL),
(13, 5, 'Joint', NULL, NULL, 502, 1, 1, '2019-04-01 02:11:10', NULL, '2019-04-01 02:11:10', NULL, NULL, NULL),
(14, 5, 'Limited', NULL, NULL, 503, 1, 1, '2019-04-01 02:11:29', NULL, '2019-04-01 02:11:29', NULL, NULL, NULL),
(15, 6, 'Traditional', NULL, NULL, 601, 1, 1, '2019-04-01 22:53:26', NULL, '2019-04-01 22:53:26', NULL, NULL, NULL),
(16, 6, 'Mechanical', NULL, NULL, 602, 1, 1, '2019-04-01 22:53:47', NULL, '2019-04-01 22:53:47', NULL, NULL, NULL),
(17, 6, 'Auto Mechanical', NULL, NULL, 603, 1, 1, '2019-04-01 22:54:02', NULL, '2019-04-01 22:54:02', NULL, NULL, NULL),
(18, 6, 'Vacuum', NULL, NULL, 604, 1, 1, '2019-04-01 22:54:20', NULL, '2019-04-01 22:54:20', NULL, NULL, NULL),
(19, 7, 'Industrial', NULL, NULL, 555, 1, 1, '2019-04-08 05:07:55', 1, '2019-04-07 23:07:22', NULL, NULL, NULL),
(20, 7, 'Edible', NULL, NULL, 777, 1, 1, '2019-04-08 05:08:06', 1, '2019-04-07 23:07:32', NULL, NULL, NULL),
(21, 7, 'Both', NULL, NULL, 999, 1, 1, '2019-04-08 05:08:15', 1, '2019-04-07 23:07:41', NULL, NULL, NULL),
(24, 9, 'TPA', NULL, NULL, 901, 1, 1, '2019-04-01 23:29:13', NULL, '2019-04-01 23:29:13', NULL, NULL, NULL),
(25, 10, 'Chemical', NULL, NULL, 1001, 1, 1, '2019-04-02 06:45:40', 1, '2019-04-02 00:45:17', NULL, NULL, NULL),
(26, 10, 'Crude Salt', NULL, NULL, NULL, 1, 1, '2020-09-24 11:30:54', 200, '2020-09-24 05:25:41', NULL, NULL, 0),
(29, 10, 'Finished Salt', NULL, NULL, 1003, 1, 1, '2019-04-02 22:13:04', 1, '2019-04-02 16:12:43', NULL, NULL, NULL),
(30, 12, 'Trade License', NULL, NULL, 100, 1, 1, '2019-04-02 23:33:11', NULL, '2019-04-02 23:33:11', NULL, NULL, NULL),
(31, 12, 'TIN', NULL, NULL, NULL, 1, 1, '2020-10-04 04:15:13', 200, '2020-10-03 22:09:48', NULL, NULL, 0),
(32, 12, 'VAT', NULL, NULL, 121, 1, 1, '2019-04-02 23:34:30', NULL, '2019-04-02 23:34:30', NULL, NULL, NULL),
(33, 12, 'Environment', NULL, NULL, 122, 1, 1, '2019-04-02 23:35:08', NULL, '2019-04-02 23:35:08', NULL, NULL, NULL),
(34, 12, 'BSTI', NULL, NULL, 123, 1, 1, '2019-04-02 23:35:28', NULL, '2019-04-02 23:35:28', NULL, NULL, NULL),
(35, 12, 'Fire', NULL, NULL, 124, 1, 1, '2019-04-02 23:35:51', NULL, '2019-04-02 23:35:51', NULL, NULL, NULL),
(36, 12, 'BIDA', NULL, NULL, 125, 1, 1, '2019-04-02 23:36:02', NULL, '2019-04-02 23:36:02', NULL, NULL, NULL),
(37, 12, 'Factory Certificate', NULL, NULL, 126, 1, 1, '2019-04-02 23:36:26', NULL, '2019-04-02 23:36:26', NULL, NULL, NULL),
(38, 12, 'Industrial Salt Manufacturing', NULL, NULL, 127, 1, 1, '2019-04-02 23:37:09', NULL, '2019-04-02 23:37:09', NULL, NULL, NULL),
(39, 12, 'Edible Salt Manufacturing', NULL, NULL, 128, 1, 1, '2019-04-02 23:37:35', NULL, '2019-04-02 23:37:35', NULL, NULL, NULL),
(41, 14, 'Raw Salt Supplier', NULL, NULL, 200, 1, 1, '2019-04-03 04:37:13', NULL, '2019-04-03 04:37:13', NULL, NULL, NULL),
(42, 14, 'Chemical Supplier', NULL, NULL, 201, 1, 1, '2019-04-03 04:37:37', NULL, '2019-04-03 04:37:37', NULL, NULL, NULL),
(43, 15, 'Local', NULL, NULL, 1501, 1, 1, '2019-04-04 00:12:39', NULL, '2019-04-04 00:12:39', NULL, NULL, NULL),
(44, 15, 'Imported', NULL, NULL, 1502, 1, 1, '2019-04-04 00:12:52', NULL, '2019-04-04 00:12:52', NULL, NULL, NULL),
(45, 19, 'External', NULL, NULL, 16, 1, 1, '2019-04-11 01:02:56', NULL, '2019-04-11 01:02:56', NULL, NULL, NULL),
(46, 19, 'Internal', NULL, NULL, 17, 1, 1, '2019-04-11 01:03:56', NULL, '2019-04-11 01:03:56', NULL, NULL, NULL),
(47, 19, 'Association', NULL, NULL, 18, 0, 1, '2019-05-25 23:31:39', 1, '2019-05-25 19:29:58', NULL, NULL, NULL),
(48, 20, '1/2 KG Iodized Salt', '0.5', NULL, NULL, 1, 1, '2020-09-17 10:33:34', 200, '2020-09-17 04:33:34', NULL, NULL, NULL),
(49, 20, '1 KG Iodized Salt', '1', NULL, NULL, 1, 1, '2020-09-17 10:33:59', 200, '2020-09-17 04:33:59', NULL, NULL, NULL),
(50, 20, '100 KG Bag', '100', NULL, NULL, 1, 1, '2019-11-28 01:00:59', 200, '2019-11-27 19:02:33', NULL, NULL, NULL),
(51, 1, 'Self', NULL, NULL, 4, 1, 1, '2019-05-25 23:31:58', NULL, '2019-05-25 23:31:58', NULL, NULL, NULL),
(52, 20, '41.50 KG Industrilal Salt', '41.50', NULL, NULL, 1, 200, '2019-08-31 02:47:13', NULL, '2019-08-31 02:47:13', NULL, NULL, NULL),
(53, 21, 'Union Parishad', NULL, NULL, NULL, 1, 1, '2019-09-28 05:41:40', NULL, '2019-09-28 05:41:40', NULL, NULL, NULL),
(54, 21, 'City Corporation', NULL, NULL, NULL, 1, 1, '2019-09-28 05:42:05', NULL, '2019-09-28 05:42:05', NULL, NULL, NULL),
(55, 21, 'Upazila', NULL, NULL, NULL, 1, 1, '2019-09-28 05:44:22', NULL, '2019-09-28 05:44:22', NULL, NULL, NULL),
(56, 21, 'National Board of Revenue Bangladesh', 'NA', NULL, NULL, 1, 200, '2019-11-03 03:59:47', NULL, '2019-11-03 03:59:47', NULL, NULL, NULL),
(57, 21, 'Department of Environment', 'NA', NULL, NULL, 1, 200, '2019-11-03 04:00:05', NULL, '2019-11-03 04:00:05', NULL, NULL, NULL),
(58, 21, 'Bangladesh Standards & Testing Institution', 'NA', NULL, NULL, 1, 200, '2019-11-03 04:00:34', NULL, '2019-11-03 04:00:34', NULL, NULL, NULL),
(59, 21, 'Bangladesh Fire Service and Civil Defense', 'NA', NULL, NULL, 1, 200, '2019-11-03 04:01:10', NULL, '2019-11-03 04:01:10', NULL, NULL, NULL),
(60, 21, 'Bangladesh Investment Development Authority', 'NA', NULL, NULL, 1, 200, '2019-11-03 04:01:32', NULL, '2019-11-03 04:01:32', NULL, NULL, NULL),
(61, 20, '200 KG Bag', '200', NULL, NULL, 1, 200, '2020-03-02 23:45:41', 200, '2020-03-02 17:47:35', NULL, NULL, NULL),
(62, 21, 'Example 2', 'test description', NULL, NULL, 1, 200, '2020-12-14 10:32:53', 200, '2020-12-14 04:32:53', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ssc_lookupmst`
--

CREATE TABLE `ssc_lookupmst` (
  `LOOKUPMST_ID` int(11) NOT NULL,
  `LOOKUPMST_NAME` varchar(60) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `UD_SL` int(11) DEFAULT NULL,
  `ACTIVE_FLG` int(1) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Contain basic drop down value head';

--
-- Dumping data for table `ssc_lookupmst`
--

INSERT INTO `ssc_lookupmst` (`LOOKUPMST_ID`, `LOOKUPMST_NAME`, `DESCRIPTION`, `REMARKS`, `UD_SL`, `ACTIVE_FLG`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `center_id`) VALUES
(1, 'Agency', NULL, NULL, 1, 1, 1, '2019-03-31 22:45:26', NULL, '2019-03-31 22:45:26', NULL, NULL, NULL),
(3, 'Seller Type', NULL, NULL, 3, 1, 1, '2019-03-31 22:52:06', NULL, '2019-03-31 22:52:06', NULL, NULL, NULL),
(4, 'Registration Type', NULL, NULL, 4, 1, 1, '2019-04-01 02:06:39', NULL, '2019-04-01 02:06:39', NULL, NULL, NULL),
(5, 'Owner Type', NULL, NULL, 5, 1, 1, '2019-04-01 02:10:06', NULL, '2019-04-01 02:10:06', NULL, NULL, NULL),
(6, 'Process Type', NULL, NULL, 6, 1, 1, '2019-04-01 22:52:48', NULL, '2019-04-01 22:52:48', NULL, NULL, NULL),
(7, 'Type of Mill', NULL, NULL, 7, 1, 1, '2019-04-01 22:54:43', NULL, '2019-04-01 22:54:43', NULL, NULL, NULL),
(9, 'Capacity', NULL, NULL, 9, 1, 1, '2019-04-01 23:28:59', NULL, '2019-04-01 23:28:59', NULL, NULL, NULL),
(10, 'Item Type', NULL, NULL, 10, 1, 1, '2019-04-02 04:45:22', NULL, '2019-04-02 04:45:22', NULL, NULL, NULL),
(12, 'Type of Certificate', NULL, NULL, 12, 1, 1, '2019-04-02 23:32:16', NULL, '2019-04-02 23:32:16', NULL, NULL, NULL),
(14, 'Supplier Type', NULL, NULL, 14, 1, 1, '2019-04-03 04:34:34', NULL, '2019-04-03 04:34:34', NULL, NULL, NULL),
(15, 'CRUDE Salt Source', NULL, NULL, 15, 1, 1, '2019-04-04 00:08:59', NULL, '2019-04-04 00:08:59', NULL, NULL, NULL),
(19, 'Quality Control By', NULL, NULL, 18, 1, 1, '2019-04-11 01:01:36', NULL, '2019-04-11 01:01:36', NULL, NULL, NULL),
(20, 'Packing Type', NULL, NULL, 20, 1, 1, '2019-04-15 21:29:44', NULL, '2019-04-15 21:29:44', NULL, NULL, NULL),
(21, 'Certificate provider Authority', NULL, NULL, NULL, 1, 1, '2019-09-28 05:40:54', NULL, '2019-09-28 05:40:54', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssc_thana`
--

CREATE TABLE `ssc_thana` (
  `THANA_ID` smallint(8) NOT NULL COMMENT 'Primary Key Of sa_thanas Table.',
  `UPAZILA_ID` int(10) DEFAULT NULL,
  `DISTRICT_ID` int(8) DEFAULT NULL COMMENT 'Foreign Key To DISTRICT_ID Column Of sa_districts Table.',
  `THANA_NAME` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Thanas Or Upazilla Name In English.',
  `THANA_NAME_BN` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Thanas Or Upazilla Name In Local Language.',
  `LAT` double DEFAULT NULL COMMENT 'Ascending Serial No.',
  `LON` double DEFAULT NULL COMMENT 'User Define Thanas Or Upazilla Code.',
  `ENTRY_BY` int(11) NOT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_TIMESTAMP` datetime DEFAULT NULL,
  `UPDATE_BY` int(10) DEFAULT NULL,
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ssc_thana`
--

INSERT INTO `ssc_thana` (`THANA_ID`, `UPAZILA_ID`, `DISTRICT_ID`, `THANA_NAME`, `THANA_NAME_BN`, `LAT`, `LON`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_TIMESTAMP`, `UPDATE_BY`, `BRANCH_NO`, `COMPANY_NO`) VALUES
(520, NULL, 9, 'SANDWIP', NULL, NULL, 21578, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(521, NULL, 9, 'SATKANIA', NULL, NULL, 21582, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(522, NULL, 9, 'SITAKUNDA', NULL, NULL, 21586, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(523, NULL, 11, 'BARURA', NULL, NULL, 21909, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(524, NULL, 11, 'BRAHMAN PARA', NULL, NULL, 21915, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(525, NULL, 11, 'BURICHANG', NULL, NULL, 21918, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(526, NULL, 11, 'CHANDINA', NULL, NULL, 21927, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(527, NULL, 11, 'CHAUDDAGRAM', NULL, NULL, 21931, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(528, NULL, 11, 'CUMILLA SADAR DAKSHIN', NULL, NULL, 21933, 0, '2020-08-26 00:25:20', NULL, NULL, NULL, NULL),
(529, NULL, 11, 'DAUDKANDI', NULL, NULL, 21936, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(530, NULL, 11, 'DEBIDWAR', NULL, NULL, 21940, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(531, NULL, 11, 'HOMNA', NULL, NULL, 21954, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(532, NULL, 11, 'CUMILLA ADARSHA SADAR', NULL, NULL, 21967, 0, '2020-08-26 00:25:32', NULL, NULL, NULL, NULL),
(533, NULL, 11, 'LAKSAM', NULL, NULL, 21972, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(534, NULL, 11, 'MANOHARGANJ', NULL, NULL, 21974, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(535, NULL, 11, 'MEGHNA', NULL, NULL, 21975, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(536, NULL, 11, 'MURADNAGAR', NULL, NULL, 21981, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(537, NULL, 11, 'NANGALKOT', NULL, NULL, 21987, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(538, NULL, 11, 'TITAS', NULL, NULL, 21994, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(539, NULL, 12, 'CHAKARIA', NULL, NULL, 22216, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(540, NULL, 12, 'COX\'S BAZAR SADAR', NULL, NULL, 22224, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(541, NULL, 12, 'KUTUBDIA', NULL, NULL, 22245, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(542, NULL, 1, 'Chalna Ankorage', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(543, NULL, 1, 'Rayenda', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(544, NULL, 10, 'Doulatganj', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(545, NULL, 23, 'JASHORE SADAR', NULL, NULL, NULL, 0, '2020-08-26 00:26:05', NULL, NULL, NULL, NULL),
(546, NULL, 23, 'NOAPARA', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(547, NULL, 25, 'NALDANGA', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(548, NULL, 27, 'ALAIPUR', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(549, NULL, 27, 'CHALNA BAZAR', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(550, NULL, 27, 'MADINABAD', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(551, NULL, 27, 'SAJIARA', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(552, NULL, 30, 'JANIPUR', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(553, NULL, 30, 'Rafayetpur', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(554, NULL, 34, 'ARPARA', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(555, NULL, 41, 'Laxmipasha', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(556, NULL, 41, 'Mohajan', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(557, NULL, 58, 'Nakipur', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(558, NULL, 13, 'Joypara', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(559, NULL, 15, 'Shriangan', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(560, NULL, 18, 'Monnunagar', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(561, NULL, 33, 'Barhamganj', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(563, NULL, 35, 'Lechhraganj', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(564, NULL, 42, 'Baidder Bazar', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(565, NULL, 42, 'Fatullah', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(566, NULL, 42, 'Siddirganj', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(567, NULL, 60, 'Bakshigonj', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(568, NULL, 63, 'Kashkawlia', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(569, NULL, 8, 'Matlobganj', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(570, NULL, 14, 'Bangla Hili', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(571, NULL, 14, 'Maharajganj', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(572, NULL, 14, 'Osmanpur', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(573, NULL, 14, 'Setabganj', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(575, NULL, 17, 'Bonarpara', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(576, NULL, 29, 'Rajibpur', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(577, NULL, 32, 'Tushbhandar', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(578, NULL, 50, 'Chotto Dab', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(579, NULL, 53, 'Chapinawabganj', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(580, NULL, 86, 'Chapinawabganj Sadar', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(581, NULL, 86, 'Nachol', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(582, NULL, 86, 'Rohanpur', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(583, NULL, 86, 'Shibganj U.P.O', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(584, NULL, 44, 'Gopalpur UPO', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(585, NULL, 44, 'Harua', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(586, NULL, 53, 'Rajshahi Sadar', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(587, NULL, 59, 'Dhangora', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(588, NULL, 52, 'Swarupkathi', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(589, NULL, 52, 'Banaripara', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(590, NULL, 51, 'Subidkhali', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(591, NULL, 51, 'Khepupara', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(592, NULL, 5, 'Hatshoshiganj', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(593, NULL, 5, 'Hajirhat', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(594, NULL, 4, 'SAHEBGANJ', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(595, NULL, 4, 'Barajalia', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(596, NULL, 62, 'Jakiganj', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(597, NULL, 61, 'Dhirai Chandpur', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(598, NULL, 55, 'Marishya', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(599, NULL, 55, 'Longachh', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(600, NULL, 55, 'Kalampati', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(601, NULL, 48, 'Basurhat', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(602, NULL, 31, 'Char Alexgander', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(603, NULL, 31, 'Ramghar', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(604, NULL, 12, 'Gorakghat', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(605, NULL, 12, 'Chiringga', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(606, NULL, 9, 'Jaldi', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(607, NULL, 9, 'East Joara', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL),
(608, NULL, 9, 'Chittagong Sadar', NULL, NULL, NULL, 0, '2016-10-14 11:27:05', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssc_unions`
--

CREATE TABLE `ssc_unions` (
  `UNION_ID` int(4) UNSIGNED NOT NULL,
  `UPAZILA_ID` int(4) UNSIGNED NOT NULL,
  `UNION_NAME` varchar(30) NOT NULL,
  `UNION_NAME_BN` varchar(50) NOT NULL,
  `LAT` double NOT NULL,
  `LON` double NOT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ssc_unions_180520`
--

CREATE TABLE `ssc_unions_180520` (
  `UNION_ID` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `UPAZILA_ID` int(4) UNSIGNED NOT NULL,
  `UNION_NAME` varchar(30) CHARACTER SET latin1 NOT NULL,
  `UNION_NAME_BN` varchar(50) CHARACTER SET latin1 NOT NULL,
  `LAT` double NOT NULL,
  `LON` double NOT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ssc_unions_180520`
--

INSERT INTO `ssc_unions_180520` (`UNION_ID`, `UPAZILA_ID`, `UNION_NAME`, `UNION_NAME_BN`, `LAT`, `LON`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`) VALUES
(1, 226, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2, 226, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(3, 226, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(4, 226, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(5, 226, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(6, 226, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(7, 226, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(8, 226, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(9, 226, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(10, 227, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(11, 227, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(12, 227, '', '?????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(13, 227, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(14, 227, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(15, 227, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(16, 227, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(17, 227, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(18, 227, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(19, 227, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(20, 227, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(21, 227, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(22, 228, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(23, 228, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(24, 228, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(25, 228, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(26, 228, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(27, 228, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(28, 228, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(29, 228, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(30, 228, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(31, 228, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(32, 228, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(33, 228, '', '??????? ?', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(34, 229, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(35, 229, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(36, 229, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(37, 229, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(38, 230, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(39, 230, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(40, 230, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(41, 230, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(42, 230, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(43, 230, '', '?????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(44, 230, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(45, 230, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(46, 230, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(47, 230, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(48, 230, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(49, 230, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(50, 230, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(51, 230, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(52, 230, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(53, 230, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(54, 230, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(55, 230, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(56, 230, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(57, 230, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(58, 230, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(59, 231, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(60, 231, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(61, 231, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(62, 231, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(63, 231, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(64, 231, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(65, 231, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(66, 231, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(67, 231, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(68, 163, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(69, 163, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(70, 163, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(71, 163, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(72, 163, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(73, 163, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(74, 163, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(75, 160, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(76, 160, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(77, 160, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(78, 160, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(79, 160, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(80, 160, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(81, 160, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(82, 160, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(83, 160, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(84, 161, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(85, 161, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(86, 161, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(87, 161, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(88, 161, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(89, 161, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(90, 161, '', '???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(91, 161, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(92, 161, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(93, 161, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(94, 161, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(95, 159, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(96, 159, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(97, 159, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(98, 159, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(99, 159, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(100, 159, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(101, 159, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(102, 159, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(103, 162, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(104, 162, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(105, 162, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(106, 162, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(107, 162, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(108, 162, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(109, 162, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(110, 162, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(111, 247, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(112, 247, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(113, 247, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(114, 247, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(115, 247, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(116, 247, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(117, 247, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(118, 247, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(119, 247, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(120, 247, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(121, 247, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(122, 249, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(123, 249, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(124, 249, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(125, 249, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(126, 249, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(127, 249, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(128, 249, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(129, 249, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(130, 249, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(131, 249, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(132, 249, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(133, 249, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(134, 249, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(135, 250, '', '?????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(136, 250, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(137, 250, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(138, 250, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(139, 250, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(140, 250, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(141, 250, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(142, 250, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(143, 250, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(144, 250, '', '??. ??. ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(145, 250, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(146, 250, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(147, 252, '', '????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(148, 252, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(149, 252, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(150, 252, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(151, 252, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(152, 252, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(153, 252, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(154, 252, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(155, 251, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(156, 251, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(157, 251, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(158, 251, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(159, 251, '', '??.?? ????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(160, 251, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(161, 251, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(162, 251, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(163, 251, '', '????? ???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(164, 251, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(165, 251, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(166, 251, '', '?????? ???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(167, 251, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(168, 248, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(169, 248, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(170, 248, '', '????? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(171, 248, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(172, 248, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(173, 248, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(174, 248, '', '????? ????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(175, 220, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(176, 220, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(177, 220, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(178, 220, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(179, 220, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(180, 220, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(181, 220, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(182, 220, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(183, 220, '', '??????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(184, 220, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(185, 223, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(186, 223, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(187, 223, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(188, 223, '', '??????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(189, 224, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(190, 224, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(191, 224, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(192, 224, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(193, 224, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(194, 224, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(195, 224, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(196, 221, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(197, 221, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(198, 221, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(199, 221, '', '???????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(200, 221, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(201, 221, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(202, 221, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(203, 221, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(204, 221, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(205, 221, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(206, 260, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(207, 260, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(208, 260, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(209, 260, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(210, 260, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(211, 260, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(212, 268, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(213, 268, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(214, 268, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(215, 268, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(216, 268, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(217, 268, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(218, 267, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(219, 267, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(220, 267, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(221, 267, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(222, 267, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(223, 267, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(224, 267, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(225, 267, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(226, 262, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(227, 262, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(228, 262, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(229, 262, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(230, 262, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(231, 262, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(232, 262, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(233, 262, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(234, 262, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(235, 262, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(236, 262, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(237, 266, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(238, 266, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(239, 266, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(240, 266, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(241, 266, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(242, 266, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(243, 266, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(244, 261, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(245, 261, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(246, 261, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(247, 261, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(248, 261, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(249, 261, '', '??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(250, 265, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(251, 265, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(252, 265, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(253, 265, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(254, 265, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(255, 265, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(256, 265, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(257, 265, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(258, 265, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(259, 265, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(260, 265, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(261, 265, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(262, 265, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(263, 265, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(264, 264, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(265, 264, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(266, 264, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(267, 264, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(268, 264, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(269, 264, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(270, 264, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(271, 264, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(272, 264, '', '????? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(273, 264, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(274, 264, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(275, 264, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(276, 259, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(277, 259, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(278, 259, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(279, 259, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(280, 259, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(281, 259, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(282, 259, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(283, 259, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(284, 258, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(285, 258, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(286, 258, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(287, 258, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(288, 258, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(289, 258, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(290, 258, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(291, 258, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(292, 258, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(293, 258, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(294, 258, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(295, 258, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(296, 263, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(297, 263, '', '??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(298, 263, '', '??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(299, 263, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(300, 263, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(301, 263, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(302, 263, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(303, 263, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(304, 263, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(305, 263, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(306, 263, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(307, 263, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(308, 263, '', '?????????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(309, 269, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(310, 269, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(311, 269, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(312, 269, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(313, 269, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(314, 269, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(315, 269, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(316, 182, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(317, 182, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(318, 182, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(319, 182, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(320, 182, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(321, 182, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(322, 182, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(323, 182, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(324, 182, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(325, 184, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(326, 184, '', '??????? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(327, 184, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(328, 184, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(329, 184, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(330, 184, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(331, 184, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(332, 184, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(333, 184, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(334, 180, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(335, 180, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(336, 180, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(337, 180, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(338, 180, '', '?????? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(339, 180, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(340, 180, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(341, 190, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(342, 190, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(343, 190, '', '???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(344, 190, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(345, 190, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(346, 190, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(347, 190, '', '???????-??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(348, 181, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(349, 181, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(350, 181, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(351, 181, '', '?????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(352, 181, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(353, 181, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(354, 189, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(355, 189, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(356, 189, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(357, 189, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(358, 189, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(359, 189, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(360, 189, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(361, 189, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(362, 189, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(363, 189, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(364, 186, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(365, 186, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(366, 186, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(367, 186, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(368, 186, '', '???????? ?????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(369, 186, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(370, 185, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(371, 185, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(372, 185, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(373, 185, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(374, 185, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(375, 185, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(376, 185, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(377, 185, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(378, 185, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(379, 185, '', '??????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(380, 185, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(381, 183, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(382, 183, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(383, 183, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(384, 183, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(385, 183, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(386, 183, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(387, 183, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(388, 183, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(389, 183, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(390, 183, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(391, 183, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(392, 179, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(393, 179, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(394, 179, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(395, 179, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(396, 179, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(397, 179, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(398, 179, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(399, 179, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(400, 179, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(401, 179, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(402, 179, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(403, 178, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(404, 178, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(405, 178, '', '????????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(406, 178, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(407, 178, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(408, 178, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(409, 178, '', '????????-????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(410, 178, '', '????? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(411, 187, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(412, 187, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(413, 187, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(414, 187, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(415, 187, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(416, 187, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(417, 187, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(418, 188, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(419, 188, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(420, 188, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(421, 188, '', '????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(422, 188, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(423, 188, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(424, 188, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(425, 199, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(426, 199, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(427, 199, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(428, 199, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(429, 199, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(430, 199, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(431, 199, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(432, 199, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(433, 199, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(434, 199, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(435, 199, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(436, 199, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(437, 199, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(438, 198, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(439, 198, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(440, 198, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(441, 198, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(442, 198, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(443, 198, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(444, 198, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(445, 198, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(446, 198, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(447, 195, '', '??????-????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(448, 195, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(449, 195, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(450, 195, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(451, 195, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(452, 195, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(453, 195, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(454, 195, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(455, 195, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(456, 195, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(457, 200, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(458, 200, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(459, 200, '', '???????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(460, 200, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(461, 200, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(462, 200, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(463, 200, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(464, 197, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(465, 197, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(466, 197, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(467, 197, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(468, 197, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(469, 197, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(470, 197, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(471, 201, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(472, 201, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(473, 201, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(474, 201, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(475, 201, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(476, 201, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(477, 201, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(478, 201, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL);
INSERT INTO `ssc_unions_180520` (`UNION_ID`, `UPAZILA_ID`, `UNION_NAME`, `UNION_NAME_BN`, `LAT`, `LON`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`) VALUES
(479, 196, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(480, 196, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(481, 196, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(482, 196, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(483, 196, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(484, 196, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(485, 196, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(486, 196, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(487, 196, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(488, 196, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(489, 196, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(490, 149, 'Amin Bazar', '?????', 0, 0, NULL, '2019-03-31 05:18:05', NULL, '2019-03-31 05:18:05', NULL, NULL),
(491, 149, 'Ashulia', '?????????', 0, 0, NULL, '2019-03-31 05:18:17', NULL, '2019-03-31 05:18:17', NULL, NULL),
(492, 149, 'Yearpur', '???????', 0, 0, NULL, '2019-03-31 05:18:19', NULL, '2019-03-31 05:18:19', NULL, NULL),
(493, 149, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(494, 149, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(495, 149, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(496, 149, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(497, 149, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(498, 149, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(499, 149, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(500, 149, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(501, 149, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(502, 145, 'Dhamrai Union', '????? ???????', 0, 0, NULL, '2019-03-31 21:35:24', NULL, '2019-03-31 21:35:24', NULL, NULL),
(503, 145, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(504, 145, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(505, 145, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(506, 145, '', '??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(507, 145, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(508, 145, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(509, 145, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(510, 145, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(511, 145, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(512, 145, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(513, 145, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(514, 145, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(515, 145, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(516, 145, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(517, 145, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(518, 147, 'Keraniganj Union', '???????', 0, 0, NULL, '2019-03-31 21:36:31', NULL, '2019-03-31 21:36:31', NULL, NULL),
(519, 147, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(520, 147, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(521, 147, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(522, 147, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(523, 147, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(524, 147, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(525, 147, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(526, 147, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(527, 147, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(528, 147, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(529, 147, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(530, 148, 'Nowabganj Union', '??????????? ???????', 0, 0, NULL, '2019-03-31 21:37:02', NULL, '2019-03-31 21:37:02', NULL, NULL),
(531, 148, '', '??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(532, 148, '', '??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(533, 148, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(534, 148, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(535, 148, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(536, 148, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(537, 148, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(538, 148, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(539, 148, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(540, 148, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(541, 148, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(542, 148, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(543, 148, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(544, 146, 'Dohar Union', '????????? ???????', 0, 0, NULL, '2019-03-31 21:35:55', NULL, '2019-03-31 21:35:55', NULL, NULL),
(545, 146, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(546, 146, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(547, 146, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(548, 146, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(549, 146, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(550, 146, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(551, 146, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(552, 204, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(553, 204, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(554, 204, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(555, 204, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(556, 204, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(557, 204, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(558, 204, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(559, 204, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(560, 204, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(561, 203, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(562, 203, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(563, 203, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(564, 203, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(565, 203, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(566, 203, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(567, 203, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(568, 203, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(569, 203, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(570, 203, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(571, 203, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(572, 203, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(573, 203, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(574, 203, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(575, 205, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(576, 205, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(577, 205, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(578, 205, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(579, 205, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(580, 205, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(581, 205, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(582, 205, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(583, 205, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(584, 205, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(585, 205, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(586, 205, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(587, 205, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(588, 205, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(589, 202, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(590, 202, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(591, 202, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(592, 202, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(593, 202, '', '?????-????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(594, 202, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(595, 202, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(596, 202, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(597, 202, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(598, 202, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(599, 207, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(600, 207, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(601, 207, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(602, 207, '', '?????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(603, 207, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(604, 207, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(605, 207, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(606, 207, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(607, 206, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(608, 206, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(609, 206, '', '?????? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(610, 206, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(611, 206, '', '??????? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(612, 206, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(613, 206, '', '????????? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(614, 206, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(615, 206, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(616, 206, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(617, 206, '', '?????? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(618, 206, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(619, 246, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(620, 246, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(621, 246, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(622, 246, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(623, 246, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(624, 246, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(625, 246, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(626, 246, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(627, 246, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(628, 246, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(629, 246, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(630, 246, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(631, 246, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(632, 246, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(633, 243, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(634, 243, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(635, 243, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(636, 243, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(637, 244, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(638, 244, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(639, 244, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(640, 244, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(641, 244, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(642, 244, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(643, 244, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(644, 244, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(645, 244, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(646, 244, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(647, 242, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(648, 242, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(649, 242, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(650, 242, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(651, 242, '', '?????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(652, 242, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(653, 242, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(654, 245, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(655, 245, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(656, 245, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(657, 245, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(658, 245, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(659, 245, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(660, 245, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(661, 245, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(662, 191, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(663, 191, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(664, 191, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(665, 191, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(666, 191, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(667, 191, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(668, 191, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(669, 191, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(670, 191, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(671, 191, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(672, 191, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(673, 191, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(674, 191, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(675, 191, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(676, 191, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(677, 194, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(678, 194, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(679, 194, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(680, 194, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(681, 194, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(682, 194, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(683, 194, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(684, 194, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(685, 194, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(686, 194, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(687, 194, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(688, 194, '', '??????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(689, 194, '', '???????? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(690, 194, '', '???????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(691, 194, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(692, 194, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(693, 194, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(694, 194, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(695, 194, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(696, 192, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(697, 192, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(698, 192, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(699, 192, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(700, 192, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(701, 192, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(702, 192, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(703, 192, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(704, 192, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(705, 192, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(706, 192, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(707, 192, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(708, 192, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(709, 192, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(710, 193, '', '????????-??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(711, 193, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(712, 193, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(713, 193, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(714, 193, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(715, 193, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(716, 193, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(717, 193, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(718, 193, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(719, 193, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(720, 193, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(721, 165, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(722, 165, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(723, 165, '', '??????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(724, 165, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(725, 165, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(726, 165, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(727, 165, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(728, 165, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(729, 165, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(730, 165, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(731, 165, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(732, 165, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(733, 165, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(734, 165, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(735, 165, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(736, 165, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(737, 165, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(738, 165, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(739, 165, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(740, 165, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(741, 165, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(742, 166, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(743, 166, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(744, 166, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(745, 166, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(746, 166, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(747, 166, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(748, 166, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(749, 166, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(750, 166, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(751, 166, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(752, 166, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(753, 166, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(754, 166, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(755, 166, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(756, 169, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(757, 169, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(758, 169, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(759, 169, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(760, 169, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(761, 167, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(762, 167, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(763, 167, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(764, 167, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(765, 167, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(766, 167, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(767, 167, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(768, 167, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(769, 167, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(770, 167, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(771, 167, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(772, 168, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(773, 168, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(774, 168, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(775, 168, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(776, 168, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(777, 168, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(778, 168, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(779, 168, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(780, 168, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(781, 168, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(782, 168, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(783, 168, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(784, 168, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(785, 168, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(786, 168, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(787, 150, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(788, 150, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(789, 150, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(790, 150, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(791, 150, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(792, 150, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(793, 150, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(794, 150, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(795, 150, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(796, 150, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(797, 150, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(798, 152, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(799, 152, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(800, 152, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(801, 152, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(802, 152, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(803, 152, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(804, 151, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(805, 151, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(806, 151, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(807, 151, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(808, 151, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(809, 151, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(810, 151, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(811, 151, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(812, 151, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(813, 151, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(814, 151, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(815, 157, '', '?? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(816, 157, '', '?????? ??', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(817, 157, '', '?? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(818, 157, '', '??????? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(819, 157, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(820, 157, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(821, 157, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(822, 157, '', '?? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(823, 157, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(824, 155, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(825, 155, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(826, 155, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(827, 155, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(828, 155, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(829, 155, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(830, 155, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(831, 155, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(832, 155, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(833, 154, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(834, 154, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(835, 154, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(836, 154, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(837, 154, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(838, 154, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(839, 154, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(840, 154, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(841, 154, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(842, 154, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(843, 154, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(844, 154, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(845, 156, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(846, 156, '', '?? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(847, 156, '', '?? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(848, 156, '', '?? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(849, 153, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(850, 153, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(851, 153, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(852, 153, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(853, 153, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(854, 153, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(855, 153, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(856, 153, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(857, 153, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(858, 158, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(859, 158, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(860, 158, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(861, 158, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(862, 158, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(863, 158, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(864, 158, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(865, 158, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(866, 88, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(867, 88, '', '??????? (?????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(868, 88, '', '??????? (??????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(869, 88, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(870, 88, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(871, 88, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(872, 88, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(873, 88, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(874, 88, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(875, 88, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(876, 88, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(877, 88, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(878, 88, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(879, 88, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(880, 88, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(881, 82, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(882, 82, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(883, 82, '', '?????? (?:)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(884, 82, '', '?????? (?:)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(885, 82, '', '???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(886, 82, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(887, 82, '', '???????? (?:)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(888, 82, '', '???????? (?:)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(889, 82, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(890, 82, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(891, 82, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(892, 82, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(893, 82, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(894, 82, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(895, 82, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(896, 83, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(897, 83, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(898, 83, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(899, 83, '', '???????? (?) ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(900, 83, '', '????????????? ??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(901, 83, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(902, 83, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(903, 83, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(904, 85, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(905, 85, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(906, 85, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(907, 85, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(908, 85, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(909, 85, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(910, 85, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(911, 85, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(912, 85, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(913, 85, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(914, 85, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(915, 85, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(916, 85, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(917, 86, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(918, 86, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(919, 86, '', '??? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(920, 86, '', '??? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(921, 86, '', '??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(922, 86, '', '??? ??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(923, 86, '', '??? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(924, 86, '', '??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(925, 86, '', '??? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(926, 86, '', '?? ?? ???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(927, 86, '', '?? ?? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(928, 86, '', '???? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(929, 87, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(930, 87, '', '?????????? (?????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(931, 87, '', '?????????? (?????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(932, 87, '', '?????????? (??????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(933, 87, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(934, 87, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(935, 87, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(936, 87, '', '??????????? (?????) ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(937, 87, '', '??????????? (??????) ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(938, 87, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(939, 87, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(940, 87, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(941, 87, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(942, 87, '', '??????????? (??????) ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(943, 87, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(944, 89, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(945, 89, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(946, 89, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(947, 89, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(948, 89, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(949, 89, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(950, 89, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(951, 89, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(952, 89, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(953, 91, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(954, 91, '', '??????? ???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(955, 91, '', '??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(956, 91, '', '?????????? ??????? (2)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(957, 91, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(958, 91, '', '?????? ????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(959, 91, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(960, 94, '', '??? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL);
INSERT INTO `ssc_unions_180520` (`UNION_ID`, `UPAZILA_ID`, `UNION_NAME`, `UNION_NAME_BN`, `LAT`, `LON`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`) VALUES
(961, 94, '', '??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(962, 94, '', '??? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(963, 94, '', '??? ????????? (?????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(964, 94, '', '??? ????????? (??????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(965, 94, '', '??? ??????? (?????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(966, 94, '', '??? ??????? (??????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(967, 94, '', '??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(968, 94, '', '??? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(969, 94, '', '???? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(970, 94, '', '???????????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(971, 94, '', '???????????? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(972, 94, '', '?? ?? ???????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(973, 94, '', '???? ?????? (?????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(974, 94, '', '???? ?????? (??????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(975, 94, '', '???? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(976, 94, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(977, 94, '', '???? ?????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(978, 94, '', '???? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(979, 94, '', '???? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(980, 94, '', '???? ???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(981, 94, '', '???? ????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(982, 95, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(983, 95, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(984, 95, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(985, 95, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(986, 95, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(987, 95, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(988, 95, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(989, 95, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(990, 95, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(991, 95, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(992, 95, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(993, 95, '', '??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(994, 90, '', '????? ????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(995, 90, '', '????????? (?????) ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(996, 90, '', '????????? (??????) ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(997, 90, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(998, 90, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(999, 90, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1000, 93, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1001, 93, '', '??? ??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1002, 93, '', '??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1003, 93, '', '??? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1004, 93, '', '??? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1005, 93, '', '??? ??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1006, 93, '', '??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1007, 93, '', '??? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1008, 92, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1009, 92, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1010, 92, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1011, 92, '', '??? ??? ????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1012, 92, '', '??? ??? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1013, 92, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1014, 92, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1015, 92, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1016, 92, '', '????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1017, 92, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1018, 92, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1019, 96, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1020, 96, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1021, 96, '', '???????? (?????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1022, 96, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1023, 96, '', '???????? (??????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1024, 96, '', '??????? (?????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1025, 96, '', '??????? (??????) ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1026, 96, '', '????? (?????) ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1027, 96, '', '????? (??????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1028, 96, '', '????? (?????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1029, 96, '', '????? (??????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1030, 96, '', '????? (?????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1031, 96, '', '????? (??????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1032, 96, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1033, 97, '', '??? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1034, 97, '', '??? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1035, 97, '', '??? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1036, 97, '', '??? ??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1037, 97, '', '??? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1038, 97, '', '??? ??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1039, 97, '', '??? ???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1040, 97, '', '??? ????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1041, 97, '', '??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1042, 84, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1043, 84, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1044, 84, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1045, 84, '', '??????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1046, 84, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1047, 84, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1048, 84, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1049, 84, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1050, 108, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1051, 108, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1052, 108, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1053, 108, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1054, 108, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1055, 107, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1056, 107, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1057, 107, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1058, 107, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1059, 107, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1060, 107, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1061, 107, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1062, 107, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1063, 107, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1064, 107, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1065, 107, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1066, 107, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1067, 112, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1068, 112, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1069, 112, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1070, 112, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1071, 112, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1072, 112, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1073, 112, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1074, 112, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1075, 112, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1076, 111, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1077, 111, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1078, 111, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1079, 111, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1080, 111, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1081, 111, '', '??', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1082, 111, '', '??', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1083, 111, '', '???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1084, 110, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1085, 110, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1086, 110, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1087, 109, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1088, 109, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1089, 109, '', '??????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1090, 109, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1091, 109, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1092, 109, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1093, 109, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1094, 109, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1095, 50, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1096, 50, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1097, 50, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1098, 50, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1099, 50, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1100, 50, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1101, 50, '', '????? (??) ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1102, 50, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1103, 50, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1104, 50, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1105, 50, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1106, 56, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1107, 56, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1108, 56, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1109, 56, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1110, 56, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1111, 56, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1112, 56, '', '????(??)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1113, 56, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1114, 56, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1115, 56, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1116, 52, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1117, 52, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1118, 52, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1119, 52, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1120, 52, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1121, 52, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1122, 52, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1123, 52, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1124, 52, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1125, 52, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1126, 52, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1127, 52, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1128, 52, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1129, 54, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1130, 54, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1131, 54, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1132, 54, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1133, 54, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1134, 54, '', '????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1135, 54, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1136, 54, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1137, 54, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1138, 51, '', '??????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1139, 51, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1140, 51, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1141, 51, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1142, 51, '', '??????(??)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1143, 51, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1144, 51, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1145, 51, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1146, 57, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1147, 57, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1148, 57, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1149, 57, '', '??????? (??)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1150, 57, '', '??????? (??)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1151, 53, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1152, 53, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1153, 53, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1154, 53, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1155, 53, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1156, 53, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1157, 53, '', '??????(??????)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1158, 53, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1159, 53, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1160, 53, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1161, 53, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1162, 53, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1163, 53, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1164, 53, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1165, 53, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1166, 53, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1167, 53, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1168, 53, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1169, 53, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1170, 53, '', '?????? (??)', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1171, 53, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1172, 58, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1173, 58, '', '?????????? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1174, 58, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1175, 58, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1176, 58, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1177, 58, '', '???????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1178, 58, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1179, 58, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1180, 58, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1181, 58, '', '?????? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1182, 58, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1183, 58, '', '?????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1184, 58, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1185, 59, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1186, 59, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1187, 59, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1188, 59, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1189, 59, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1190, 59, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1191, 59, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1192, 59, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1193, 59, '', '??-????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1194, 59, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1195, 135, '', '? ?? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1196, 135, '', '? ?? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1197, 135, '', '? ?? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1198, 135, '', '? ?? ????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1199, 135, '', '? ?? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1200, 135, '', '? ?? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1201, 141, '', '? ?? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1202, 141, '', '? ?? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1203, 141, '', '? ?? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1204, 141, '', '? ?? ??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1205, 141, '', '? ?? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1206, 144, '', '? ?? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1207, 144, '', '? ?? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1208, 144, '', '? ?? ??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1209, 144, '', '? ?? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1210, 137, '', '?? ?? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1211, 137, '', '?? ?? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1212, 137, '', '?? ?? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1213, 137, '', '?? ?? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1214, 137, '', '?? ?? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1215, 137, '', '?? ?? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1216, 137, '', '?? ?? ??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1217, 137, '', '?? ?? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1218, 138, '', '? ?? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1219, 138, '', '? ?? ????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1220, 138, '', '? ?? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1221, 138, '', '? ?? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1222, 138, '', '? ?? ??? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1223, 142, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1224, 142, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1225, 142, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1226, 142, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1227, 142, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1228, 142, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1229, 142, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1230, 140, '', '? ?? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1231, 140, '', '? ?? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1232, 140, '', '? ?? ??????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1233, 136, '', '? ?? ??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1234, 136, '', '? ?? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1235, 136, '', '? ?? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1236, 139, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1237, 139, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1238, 139, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1239, 139, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1240, 143, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1241, 143, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1242, 143, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1243, 143, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1244, 126, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1245, 126, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1246, 126, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1247, 126, '', '????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1248, 126, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1249, 126, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1250, 126, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1251, 126, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1252, 126, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1253, 126, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1254, 126, '', '????? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1255, 126, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1256, 126, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1257, 129, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1258, 129, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1259, 129, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1260, 129, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1261, 129, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1262, 129, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1263, 129, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1264, 129, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1265, 127, '', '??????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1266, 127, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1267, 127, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1268, 127, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1269, 127, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1270, 127, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1271, 127, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1272, 127, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1273, 127, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1274, 127, '', '?????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1275, 127, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1276, 127, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1277, 127, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1278, 127, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1279, 127, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1280, 127, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1281, 131, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1282, 131, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1283, 131, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1284, 131, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1285, 131, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1286, 131, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1287, 131, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1288, 131, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1289, 131, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1290, 134, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1291, 134, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1292, 134, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1293, 134, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1294, 134, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1295, 134, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1296, 134, '', '????? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1297, 134, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1298, 132, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1299, 132, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1300, 132, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1301, 132, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1302, 132, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1303, 132, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1304, 132, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1305, 130, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1306, 130, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1307, 130, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1308, 130, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1309, 130, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1310, 130, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1311, 130, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1312, 130, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1313, 130, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1314, 128, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1315, 128, '', '?????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1316, 128, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1317, 128, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1318, 128, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1319, 128, '', '???-?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1320, 128, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1321, 128, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1322, 128, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1323, 133, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1324, 133, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1325, 133, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1326, 133, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1327, 133, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1328, 133, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1329, 133, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1330, 133, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1331, 133, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1332, 133, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1333, 62, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1334, 62, '', '???? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1335, 62, '', '???? ???????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1336, 62, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1337, 62, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1338, 64, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1339, 64, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1340, 64, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1341, 64, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1342, 64, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1343, 64, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1344, 64, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1345, 64, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1346, 64, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1347, 67, '', '????? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1348, 67, '', '????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1349, 67, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1350, 67, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1351, 67, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1352, 67, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1353, 67, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1354, 67, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1355, 67, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1356, 67, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1357, 60, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1358, 60, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1359, 60, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1360, 60, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1361, 60, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1362, 60, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1363, 60, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1364, 60, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1365, 60, '', '???????? ????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1366, 60, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1367, 60, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1368, 60, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1369, 60, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1370, 60, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1371, 66, '', '?????????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1372, 66, '', '?????????? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1373, 66, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1374, 66, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1375, 66, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1376, 66, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1377, 63, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1378, 63, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1379, 63, '', '?????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1380, 63, '', '???????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1381, 63, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1382, 63, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1383, 63, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1384, 63, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1385, 63, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1386, 63, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1387, 63, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1388, 65, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1389, 65, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1390, 61, '', '???????? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1391, 61, '', '???????? ????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1392, 61, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1393, 61, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1394, 61, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1395, 61, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1396, 61, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1397, 61, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1398, 61, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1399, 61, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1400, 61, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1401, 61, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1402, 61, '', '????????? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1403, 61, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1404, 61, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1405, 121, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1406, 121, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1407, 121, '', '????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1408, 121, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1409, 121, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1410, 121, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1411, 121, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1412, 121, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1413, 121, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1414, 121, '', '????? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1415, 121, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1416, 121, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1417, 121, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1418, 121, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1419, 121, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1420, 121, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1421, 121, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1422, 121, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1423, 121, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1424, 121, '', '?????? ????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1425, 125, '', '?? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1426, 125, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1427, 125, '', '?? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1428, 125, '', '?? ????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1429, 125, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1430, 125, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1431, 125, '', '?? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1432, 125, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1433, 125, '', '?? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1434, 122, '', '????? ?? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1435, 122, '', '????? ?? ????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1436, 122, '', '?? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1437, 122, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1438, 122, '', '?? ????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1439, 122, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL);
INSERT INTO `ssc_unions_180520` (`UNION_ID`, `UPAZILA_ID`, `UNION_NAME`, `UNION_NAME_BN`, `LAT`, `LON`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`) VALUES
(1440, 122, '', '?????? ?? ????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1441, 122, '', '?????? ?? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1442, 122, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1443, 122, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1444, 124, '', '?? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1445, 124, '', '?? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1446, 124, '', '?? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1447, 124, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1448, 124, '', '?? ????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1449, 124, '', '?? ????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1450, 124, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1451, 124, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1452, 123, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1453, 123, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1454, 123, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1455, 123, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1456, 123, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1457, 123, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1458, 123, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1459, 123, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1460, 123, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1461, 123, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1462, 77, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1463, 77, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1464, 77, '', '????????? ???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1465, 77, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1466, 77, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1467, 77, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1468, 77, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1469, 77, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1470, 77, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1471, 77, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1472, 77, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1473, 77, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1474, 77, '', '?????? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1475, 77, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1476, 81, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1477, 81, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1478, 81, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1479, 81, '', '???????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1480, 81, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1481, 81, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1482, 81, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1483, 81, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1484, 81, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1485, 75, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1486, 75, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1487, 75, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1488, 75, '', '???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1489, 75, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1490, 75, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1491, 75, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1492, 75, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1493, 75, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1494, 75, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1495, 75, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1496, 75, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1497, 75, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1498, 75, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1499, 75, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1500, 75, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1501, 76, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1502, 76, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1503, 76, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1504, 76, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1505, 76, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1506, 76, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1507, 76, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1508, 76, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1509, 76, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1510, 76, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1511, 76, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1512, 76, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1513, 76, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1514, 76, '', '?????? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1515, 76, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1516, 76, '', '??? ????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1517, 76, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1518, 76, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1519, 76, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1520, 76, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1521, 76, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1522, 76, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1523, 79, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1524, 79, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1525, 79, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1526, 79, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1527, 79, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1528, 79, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1529, 79, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1530, 79, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1531, 79, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1532, 79, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1533, 79, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1534, 79, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1535, 79, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1536, 79, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1537, 69, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1538, 69, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1539, 69, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1540, 69, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1541, 69, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1542, 69, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1543, 69, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1544, 69, '', '???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1545, 69, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1546, 69, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1547, 69, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1548, 69, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1549, 69, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1550, 69, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1551, 70, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1552, 70, '', '?????? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1553, 70, '', '????? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1554, 70, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1555, 70, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1556, 70, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1557, 70, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1558, 70, '', '???????-???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1559, 70, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1560, 70, '', '?????? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1561, 68, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1562, 68, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1563, 68, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1564, 68, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1565, 68, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1566, 68, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1567, 68, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1568, 68, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1569, 68, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1570, 68, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1571, 68, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1572, 71, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1573, 71, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1574, 71, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1575, 71, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1576, 71, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1577, 71, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1578, 71, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1579, 71, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1580, 71, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1581, 80, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1582, 80, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1583, 80, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1584, 80, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1585, 80, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1586, 80, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1587, 80, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1588, 80, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1589, 80, '', '?????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1590, 80, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1591, 80, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1592, 80, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1593, 80, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1594, 80, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1595, 80, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1596, 80, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1597, 74, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1598, 74, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1599, 74, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1600, 74, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1601, 74, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1602, 74, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1603, 74, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1604, 74, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1605, 74, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1606, 73, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1607, 73, '', '???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1608, 73, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1609, 73, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1610, 73, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1611, 73, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1612, 73, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1613, 73, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1614, 73, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1615, 73, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1616, 73, '', '????? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1617, 73, '', '?????? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1618, 73, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1619, 73, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1620, 73, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1621, 72, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1622, 72, '', '????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1623, 72, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1624, 72, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1625, 72, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1626, 72, '', '???????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1627, 72, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1628, 72, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1629, 72, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1630, 72, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1631, 72, '', '??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1632, 72, '', '?????? ??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1633, 72, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1634, 72, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1635, 72, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1636, 72, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1637, 72, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1638, 72, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1639, 78, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1640, 78, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1641, 78, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1642, 78, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1643, 78, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1644, 78, '', '????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1645, 78, '', '?????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1646, 78, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1647, 78, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1648, 78, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1649, 78, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1650, 78, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1651, 78, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1652, 78, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1653, 100, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1654, 100, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1655, 100, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1656, 100, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1657, 100, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1658, 100, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1659, 100, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1660, 100, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1661, 100, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1662, 100, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1663, 98, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1664, 98, '', '??????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1665, 98, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1666, 98, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1667, 98, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1668, 98, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1669, 98, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1670, 98, '', '?????? ??? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1671, 98, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1672, 98, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1673, 98, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1674, 98, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1675, 98, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1676, 98, '', '??????? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1677, 98, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1678, 98, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1679, 101, '', '??? ???? ????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1680, 101, '', '????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1681, 101, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1682, 101, '', '?????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1683, 101, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1684, 101, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1685, 105, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1686, 105, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1687, 105, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1688, 105, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1689, 105, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1690, 102, '', '??? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1691, 102, '', '??? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1692, 102, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1693, 102, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1694, 102, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1695, 102, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1696, 102, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1697, 102, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1698, 106, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1699, 106, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1700, 106, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1701, 106, '', '??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1702, 106, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1703, 106, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1704, 106, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1705, 103, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1706, 103, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1707, 103, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1708, 103, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1709, 103, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1710, 103, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1711, 103, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1712, 103, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1713, 103, '', '?????? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1714, 103, '', '?????????? ????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1715, 103, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1716, 104, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1717, 104, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1718, 104, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1719, 104, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1720, 104, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1721, 104, '', '?????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1722, 114, '', '????????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1723, 114, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1724, 114, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1725, 114, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1726, 113, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1727, 113, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1728, 113, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1729, 113, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1730, 113, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1731, 119, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1732, 119, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1733, 119, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1734, 119, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1735, 115, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1736, 115, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1737, 115, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1738, 116, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1739, 116, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1740, 116, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1741, 116, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1742, 116, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1743, 117, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1744, 117, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1745, 117, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1746, 117, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1747, 120, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1748, 120, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1749, 120, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1750, 118, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1751, 118, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1752, 118, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1753, 118, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1754, 118, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1755, 118, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1756, 118, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1757, 118, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1758, 43, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1759, 43, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1760, 43, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1761, 43, '', '????????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1762, 43, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1763, 47, '', '?????? ??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1764, 47, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1765, 46, '', '????????????? ??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1766, 46, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1767, 46, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1768, 46, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1769, 46, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1770, 48, '', '?????????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1771, 48, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1772, 48, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1773, 48, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1774, 45, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1775, 45, '', '???? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1776, 45, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1777, 45, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1778, 45, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1779, 45, '', '??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1780, 45, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1781, 49, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1782, 49, '', '???? ??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1783, 49, '', '??????????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1784, 49, '', '??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1785, 44, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1786, 44, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1787, 44, '', '????? ??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1788, 44, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1789, 387, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1790, 387, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1791, 387, '', '??????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1792, 387, '', '????????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1793, 387, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1794, 387, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1795, 388, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1796, 388, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1797, 388, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1798, 388, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1799, 388, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1800, 388, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1801, 388, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1802, 389, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1803, 389, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1804, 389, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1805, 389, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1806, 390, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1807, 390, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1808, 390, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1809, 390, '', '??????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1810, 390, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1811, 390, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1812, 390, '', '????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1813, 390, '', '?????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1814, 390, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1815, 390, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1816, 390, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1817, 390, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1818, 391, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1819, 391, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1820, 391, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1821, 391, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1822, 391, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1823, 391, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1824, 391, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1825, 391, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1826, 391, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1827, 392, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1828, 392, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1829, 392, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1830, 392, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1831, 392, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1832, 392, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1833, 392, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1834, 392, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1835, 392, '', '??????????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1836, 392, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1837, 392, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1838, 392, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1839, 392, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1840, 386, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1841, 386, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1842, 386, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1843, 386, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1844, 386, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1845, 386, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1846, 386, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1847, 386, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1848, 386, '', '?????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1849, 386, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1850, 393, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1851, 393, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1852, 393, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1853, 393, '', '??????? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1854, 393, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1855, 393, '', '?????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1856, 393, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1857, 393, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1858, 394, '', '?????????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1859, 394, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1860, 394, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1861, 394, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1862, 394, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1863, 394, '', '?????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1864, 394, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1865, 394, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1866, 394, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1867, 394, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1868, 394, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1869, 394, '', '???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1870, 394, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1871, 376, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1872, 376, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1873, 376, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1874, 376, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1875, 376, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1876, 376, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1877, 376, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1878, 376, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1879, 376, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1880, 376, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1881, 373, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1882, 373, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1883, 373, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1884, 373, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1885, 373, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1886, 373, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1887, 373, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1888, 370, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1889, 370, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1890, 370, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1891, 370, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1892, 370, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1893, 374, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1894, 374, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1895, 374, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1896, 374, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1897, 374, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1898, 374, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1899, 374, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1900, 374, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1901, 374, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1902, 374, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1903, 369, '', '????????? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1904, 369, '', '???? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1905, 369, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1906, 369, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1907, 369, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1908, 369, '', '????? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1909, 369, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1910, 369, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1911, 369, '', '????? ??', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1912, 368, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1913, 368, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1914, 368, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1915, 368, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1916, 368, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1917, 371, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1918, 371, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1919, 371, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1920, 371, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL);
INSERT INTO `ssc_unions_180520` (`UNION_ID`, `UPAZILA_ID`, `UNION_NAME`, `UNION_NAME_BN`, `LAT`, `LON`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`) VALUES
(1921, 371, '', '?????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1922, 371, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1923, 371, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1924, 371, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1925, 371, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1926, 371, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1927, 371, '', '??????? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1928, 375, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1929, 375, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1930, 375, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1931, 375, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1932, 375, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1933, 375, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1934, 375, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1935, 375, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1936, 375, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1937, 375, '', '??-????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1938, 372, '', '??????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1939, 372, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1940, 372, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1941, 372, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1942, 372, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1943, 372, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1944, 335, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1945, 335, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1946, 335, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1947, 335, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1948, 335, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1949, 335, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1950, 335, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1951, 335, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1952, 335, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1953, 330, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1954, 330, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1955, 330, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1956, 330, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1957, 330, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1958, 330, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1959, 330, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1960, 330, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1961, 330, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1962, 330, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1963, 330, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1964, 338, '', '????????????? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1965, 338, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1966, 338, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1967, 338, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1968, 338, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1969, 338, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1970, 338, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1971, 338, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1972, 338, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1973, 338, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1974, 338, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1975, 338, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1976, 337, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1977, 337, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1978, 337, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1979, 337, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1980, 337, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1981, 337, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1982, 337, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1983, 337, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1984, 337, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1985, 333, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1986, 333, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1987, 333, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1988, 333, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1989, 333, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1990, 333, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1991, 329, '', '?????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1992, 329, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1993, 329, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1994, 329, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1995, 329, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1996, 329, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1997, 336, '', '??? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1998, 336, '', '??? ??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(1999, 336, '', '??? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2000, 336, '', '??? ????? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2001, 336, '', '??? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2002, 340, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2003, 340, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2004, 340, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2005, 340, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2006, 340, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2007, 340, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2008, 340, '', '?????? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2009, 332, '', '??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2010, 332, '', '??? ??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2011, 332, '', '??? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2012, 332, '', '??? ??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2013, 332, '', '??? ????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2014, 332, '', '???? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2015, 332, '', '??? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2016, 332, '', '??? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2017, 332, '', '??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2018, 332, '', '??? ???? ???', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2019, 334, '', '??????? ????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2020, 334, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2021, 334, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2022, 334, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2023, 334, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2024, 334, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2025, 334, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2026, 334, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2027, 334, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2028, 334, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2029, 334, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2030, 331, '', '??? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2031, 331, '', '??? ???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2032, 331, '', '??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2033, 331, '', '??? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2034, 331, '', '??? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2035, 331, '', '??? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2036, 331, '', '???? ??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2037, 331, '', '??? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2038, 331, '', '??? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2039, 331, '', '??? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2040, 339, '', '??? ????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2041, 339, '', '??? ???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2042, 339, '', '??? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2043, 339, '', '??? ????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2044, 339, '', '??? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2045, 339, '', '??? ?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2046, 339, '', '??? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2047, 339, '', '??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2048, 339, '', '??? ?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2049, 339, '', '???? ????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2050, 339, '', '???? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2051, 339, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2052, 383, '', '?? ?? ?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2053, 383, '', '?? ?? ?????? ????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2054, 383, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2055, 383, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2056, 383, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2057, 383, '', '?? ?? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2058, 383, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2059, 383, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2060, 380, '', '?? ?? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2061, 380, '', '?? ?? ??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2062, 380, '', '?? ?? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2063, 380, '', '?? ?? ???????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2064, 380, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2065, 380, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2066, 380, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2067, 382, '', '?? ?? ????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2068, 382, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2069, 382, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2070, 382, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2071, 382, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2072, 382, '', '?? ?? ????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2073, 379, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2074, 379, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2075, 379, '', '?? ?? ???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2076, 379, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2077, 379, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2078, 379, '', '?? ?? ??????????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2079, 384, '', '?? ?? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2080, 384, '', '?? ?? ???????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2081, 384, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2082, 384, '', '?? ?? ????? ???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2083, 384, '', '?? ?? ??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2084, 384, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2085, 377, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2086, 377, '', '?? ?? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2087, 377, '', '?? ?? ?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2088, 377, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2089, 377, '', '?? ?? ????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2090, 377, '', '?? ?? ??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2091, 381, '', '?? ?? ????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2092, 381, '', '?? ?? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2093, 381, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2094, 381, '', '?? ?? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2095, 381, '', '?? ?? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2096, 381, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2097, 381, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2098, 381, '', '?? ?? ?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2099, 381, '', '?? ?? ??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2100, 385, '', '?? ?? ???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2101, 385, '', '?? ?? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2102, 385, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2103, 385, '', '?? ?? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2104, 385, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2105, 385, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2106, 385, '', '?? ?? ???????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2107, 378, '', '?? ?? ???????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2108, 378, '', '?? ?? ????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2109, 378, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2110, 378, '', '?? ?? ?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2111, 378, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2112, 378, '', '?? ?? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2113, 378, '', '?? ?? ????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2114, 378, '', '?? ?? ??????? ??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2115, 378, '', '?? ?? ????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2116, 378, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2117, 378, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2118, 378, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2119, 378, '', '?? ?? ???????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2120, 378, '', '?? ?? ?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2121, 378, '', '?? ?? ????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2122, 378, '', '?? ?? ?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2123, 357, '', '? ?? ????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2124, 357, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2125, 357, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2126, 357, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2127, 357, '', '?? ?? ??????????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2128, 357, '', '?? ?? ????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2129, 357, '', '?? ?? ?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2130, 357, '', '?? ?? ?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2131, 357, '', '?? ?? ???????? ???????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2132, 357, '', '?? ?? ?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2133, 357, '', '?? ?? ????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2134, 357, '', '?? ?? ????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2135, 361, '', '?? ?? ????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2136, 361, '', '?? ?? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2137, 361, '', '?? ?? ????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2138, 361, '', '?? ?? ??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2139, 361, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2140, 361, '', '?? ?? ?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2141, 361, '', '?? ?? ????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2142, 361, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2143, 361, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2144, 361, '', '?? ?? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2145, 361, '', '?? ?? ????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2146, 361, '', '?? ?? ????????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2147, 362, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2148, 362, '', '?? ?? ?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2149, 362, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2150, 362, '', '?? ?? ??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2151, 362, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2152, 362, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2153, 362, '', '?? ?? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2154, 359, '', '?? ?? ????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2155, 359, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2156, 359, '', '?? ?? ??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2157, 359, '', '?? ?? ?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2158, 359, '', '?? ?? ??????????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2159, 360, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2160, 360, '', '?? ?? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2161, 360, '', '?? ?? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2162, 360, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2163, 360, '', '?? ?? ??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2164, 360, '', '?? ?? ?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2165, 360, '', '?? ?? ????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2166, 360, '', '?? ?? ??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2167, 360, '', '?? ?? ????????? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2168, 360, '', '?? ?? ????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2169, 362, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2170, 362, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2171, 362, '', '?? ?? ???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2172, 362, '', '?? ?? ?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2173, 362, '', '?? ?? ??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2174, 362, '', '?? ?? ?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2175, 342, '', '??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2176, 342, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2177, 342, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2178, 342, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2179, 342, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2180, 343, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2181, 343, '', '??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2182, 343, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2183, 343, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2184, 343, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2185, 344, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2186, 344, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2187, 344, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2188, 344, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2189, 344, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2190, 345, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2191, 345, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2192, 345, '', '???????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2193, 345, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2194, 345, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2195, 345, '', '??????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2196, 345, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2197, 345, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2198, 341, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2199, 341, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2200, 341, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2201, 341, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2202, 341, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2203, 341, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2204, 341, '', '???????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2205, 341, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2206, 341, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2207, 366, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2208, 366, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2209, 366, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2210, 366, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2211, 366, '', '?????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2212, 366, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2213, 366, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2214, 366, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2215, 366, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2216, 366, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2217, 366, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2218, 366, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2219, 366, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2220, 366, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2221, 364, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2222, 364, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2223, 364, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2224, 364, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2225, 364, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2226, 364, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2227, 364, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2228, 364, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2229, 365, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2230, 365, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2231, 365, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2232, 365, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2233, 363, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2234, 363, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2235, 363, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2236, 363, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2237, 367, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2238, 367, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2239, 367, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2240, 367, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2241, 367, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2242, 367, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2243, 367, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2244, 367, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2245, 367, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2246, 367, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2247, 367, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2248, 367, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2249, 367, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2250, 367, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2251, 367, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2252, 347, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2253, 347, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2254, 347, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2255, 347, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2256, 347, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2257, 347, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2258, 347, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2259, 347, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2260, 347, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2261, 347, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2262, 356, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2263, 356, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2264, 356, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2265, 356, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2266, 356, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2267, 356, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2268, 356, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2269, 356, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2270, 352, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2271, 352, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2272, 352, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2273, 352, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2274, 352, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2275, 352, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2276, 352, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2277, 352, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2278, 352, '', '????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2279, 352, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2280, 352, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2281, 353, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2282, 353, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2283, 353, '', '???? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2284, 353, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2285, 353, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2286, 353, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2287, 353, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2288, 353, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2289, 349, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2290, 349, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2291, 349, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2292, 349, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2293, 349, '', '??????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2294, 349, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2295, 349, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2296, 349, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2297, 348, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2298, 348, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2299, 348, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2300, 348, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2301, 348, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2302, 348, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2303, 348, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2304, 348, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2305, 348, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2306, 348, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2307, 348, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2308, 348, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2309, 348, '', '??? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2310, 348, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2311, 350, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2312, 350, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2313, 350, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2314, 350, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2315, 350, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2316, 350, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2317, 350, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2318, 350, '', '????????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2319, 351, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2320, 351, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2321, 351, '', '????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2322, 351, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2323, 351, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2324, 351, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2325, 351, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2326, 351, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2327, 346, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2328, 346, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2329, 346, '', '????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2330, 346, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2331, 346, '', '?????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2332, 346, '', '???????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2333, 346, '', '?????????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2334, 346, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2335, 346, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2336, 346, '', '??????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2337, 346, '', '????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2338, 346, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2339, 355, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2340, 355, '', '??????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2341, 355, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2342, 355, '', '???????????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2343, 355, '', '?????? ???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2344, 355, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2345, 354, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2346, 354, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2347, 354, '', '?????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2348, 354, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2349, 354, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL),
(2350, 354, '', '???????', 0, 0, NULL, '2019-03-18 03:54:28', NULL, '2019-03-18 03:54:28', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssc_upazilas`
--

CREATE TABLE `ssc_upazilas` (
  `UPAZILA_ID` int(4) UNSIGNED NOT NULL,
  `DISTRICT_ID` int(4) UNSIGNED NOT NULL,
  `UPAZILA_NAME` varchar(30) NOT NULL,
  `UPAZILA_NAME_BN` varchar(50) NOT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ssc_upazilas`
--

INSERT INTO `ssc_upazilas` (`UPAZILA_ID`, `DISTRICT_ID`, `UPAZILA_NAME`, `UPAZILA_NAME_BN`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`) VALUES
(1, 34, 'Amtali', 'à¦†à¦®à¦¤à¦²à§€', NULL, '0000-00-00 00:00:00', NULL, '2016-04-05 18:48:39', NULL, NULL),
(2, 34, 'Bamna ', 'à¦¬à¦¾à¦®à¦¨à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(3, 34, 'Barguna Sadar ', 'à¦¬à¦°à¦—à§à¦¨à¦¾ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(4, 34, 'Betagi ', 'à¦¬à§‡à¦¤à¦¾à¦—à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(5, 34, 'Patharghata ', 'à¦ªà¦¾à¦¥à¦°à¦˜à¦¾à¦Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(6, 34, 'Taltali ', 'à¦¤à¦¾à¦²à¦¤à¦²à§€', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(7, 35, 'Muladi ', 'à¦®à§à¦²à¦¾à¦¦à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(8, 35, 'Babuganj ', 'à¦¬à¦¾à¦¬à§à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(9, 35, 'Agailjhara ', 'à¦†à¦—à¦¾à¦‡à¦²à¦à¦°à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(10, 35, 'Barishal Sadar ', 'à¦¬à¦°à¦¿à¦¶à¦¾à¦² à¦¸à¦¦à¦°', NULL, '2020-08-25 12:00:00', NULL, '2020-08-25 12:00:00', NULL, NULL),
(11, 35, 'Bakerganj ', 'à¦¬à¦¾à¦•à§‡à¦°à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(12, 35, 'Banaripara ', 'à¦¬à¦¾à¦¨à¦¾à§œà¦¿à¦ªà¦¾à¦°à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(13, 35, 'Gaurnadi ', 'à¦—à§Œà¦°à¦¨à¦¦à§€', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(14, 35, 'Hizla ', 'à¦¹à¦¿à¦œà¦²à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(15, 35, 'Mehendiganj ', 'à¦®à§‡à¦¹à§‡à¦¦à¦¿à¦—à¦žà§à¦œ ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(16, 35, 'Wazirpur ', 'à¦“à§Ÿà¦¾à¦œà¦¿à¦°à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(17, 36, 'Bhola Sadar ', 'à¦­à§‹à¦²à¦¾ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(18, 36, 'Burhanuddin ', 'à¦¬à§à¦°à¦¹à¦¾à¦¨à¦‰à¦¦à§à¦¦à¦¿à¦¨', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(19, 36, 'Char Fasson ', 'à¦šà¦° à¦«à§à¦¯à¦¾à¦¶à¦¨', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(20, 36, 'Daulatkhan ', 'à¦¦à§Œà¦²à¦¤à¦–à¦¾à¦¨', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(21, 36, 'Lalmohan ', 'à¦²à¦¾à¦²à¦®à§‹à¦¹à¦¨', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(22, 36, 'Manpura ', 'à¦®à¦¨à¦ªà§à¦°à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(23, 36, 'Tazumuddin ', 'à¦¤à¦¾à¦œà§à¦®à§à¦¦à§à¦¦à¦¿à¦¨', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(24, 37, 'Jhalokati Sadar ', 'à¦à¦¾à¦²à¦•à¦¾à¦ à¦¿ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(25, 37, 'Kathalia ', 'à¦•à¦¾à¦à¦ à¦¾à¦²à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(26, 37, 'Nalchity ', 'à¦¨à¦¾à¦²à¦šà¦¿à¦¤à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(27, 37, 'Rajapur ', 'à¦°à¦¾à¦œà¦¾à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(28, 38, 'Bauphal ', 'à¦¬à¦¾à¦‰à¦«à¦²', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(29, 38, 'Dashmina ', 'à¦¦à¦¶à¦®à¦¿à¦¨à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(30, 38, 'Galachipa ', 'à¦—à¦²à¦¾à¦šà¦¿à¦ªà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(31, 38, 'Kalapara ', 'à¦•à¦¾à¦²à¦¾à¦ªà¦¾à¦°à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(32, 38, 'Mirzaganj ', 'à¦®à¦¿à¦°à§à¦œà¦¾à¦—à¦žà§à¦œ ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(33, 38, 'Patuakhali Sadar ', 'à¦ªà¦Ÿà§à§Ÿà¦¾à¦–à¦¾à¦²à§€ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(34, 38, 'Dumki ', 'à¦¡à§à¦®à¦•à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(35, 38, 'Rangabali ', 'à¦°à¦¾à¦™à§à¦—à¦¾à¦¬à¦¾à¦²à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(36, 39, 'Bhandaria', 'à¦­à§à¦¯à¦¾à¦¨à§à¦¡à¦¾à¦°à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(37, 39, 'Kaukhali', 'à¦•à¦¾à¦‰à¦–à¦¾à¦²à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(38, 39, 'Mathbaria', 'à¦®à¦¾à¦ à¦¬à¦¾à§œà¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(39, 39, 'Nazirpur', 'à¦¨à¦¾à¦œà¦¿à¦°à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(40, 39, 'Nesarabad', 'à¦¨à§‡à¦¸à¦¾à¦°à¦¾à¦¬à¦¾à¦¦', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(41, 39, 'Pirojpur Sadar', 'à¦ªà¦¿à¦°à§‹à¦œà¦ªà§à¦° à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(42, 39, 'Zianagar', 'à¦œà¦¿à§Ÿà¦¾à¦¨à¦—à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(43, 40, 'Bandarban Sadar', 'à¦¬à¦¾à¦¨à§à¦¦à¦°à¦¬à¦¨ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(44, 40, 'Thanchi', 'à¦¥à¦¾à¦¨à¦šà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(45, 40, 'Lama', 'à¦²à¦¾à¦®à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(46, 40, 'Naikhongchhari', 'à¦¨à¦¾à¦‡à¦–à¦‚à¦›à§œà¦¿ ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(47, 40, 'Ali kadam', 'à¦†à¦²à§€ à¦•à¦¦à¦®', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(48, 40, 'Rowangchhari', 'à¦°à¦‰à§Ÿà¦¾à¦‚à¦›à§œà¦¿ ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(49, 40, 'Ruma', 'à¦°à§à¦®à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(50, 41, 'Brahmanbaria Sadar ', 'à¦¬à§à¦°à¦¾à¦¹à§à¦®à¦£à¦¬à¦¾à§œà¦¿à§Ÿà¦¾ à¦¸à¦¦à', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(51, 41, 'Ashuganj ', 'à¦†à¦¶à§à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(52, 41, 'Nasirnagar ', 'à¦¨à¦¾à¦¸à¦¿à¦° à¦¨à¦—à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(53, 41, 'Nabinagar ', 'à¦¨à¦¬à§€à¦¨à¦—à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(54, 41, 'Sarail ', 'à¦¸à¦°à¦¾à¦‡à¦²', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(55, 41, 'Shahbazpur Town', 'à¦¶à¦¾à¦¹à¦¬à¦¾à¦œà¦ªà§à¦° à¦Ÿà¦¾à¦‰à¦¨', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(56, 41, 'Kasba ', 'à¦•à¦¸à¦¬à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(57, 41, 'Akhaura ', 'à¦†à¦–à¦¾à¦‰à¦°à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(58, 41, 'Bancharampur ', 'à¦¬à¦¾à¦žà§à¦›à¦¾à¦°à¦¾à¦®à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(59, 41, 'Bijoynagar ', 'à¦¬à¦¿à¦œà§Ÿ à¦¨à¦—à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(60, 42, 'Chandpur Sadar', 'à¦šà¦¾à¦à¦¦à¦ªà§à¦° à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(61, 42, 'Faridganj', 'à¦«à¦°à¦¿à¦¦à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(62, 42, 'Haimchar', 'à¦¹à¦¾à¦‡à¦®à¦šà¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(63, 42, 'Haziganj', 'à¦¹à¦¾à¦œà§€à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(64, 42, 'Kachua', 'à¦•à¦šà§à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(65, 42, 'Matlab Uttar', 'à¦®à¦¤à¦²à¦¬ à¦‰à¦¤à§à¦¤à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(66, 42, 'Matlab Dakkhin', 'à¦®à¦¤à¦²à¦¬ à¦¦à¦•à§à¦·à¦¿à¦£', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(67, 42, 'Shahrasti', 'à¦¶à¦¾à¦¹à¦°à¦¾à¦¸à§à¦¤à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(68, 43, 'Anwara ', 'à¦†à¦¨à§‹à§Ÿà¦¾à¦°à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(69, 43, 'Banshkhali ', 'à¦¬à¦¾à¦¶à¦–à¦¾à¦²à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(70, 43, 'Boalkhali ', 'à¦¬à§‹à§Ÿà¦¾à¦²à¦–à¦¾à¦²à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(71, 43, 'Chandanaish ', 'à¦šà¦¨à§à¦¦à¦¨à¦¾à¦‡à¦¶', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(72, 43, 'Fatikchhari ', 'à¦«à¦Ÿà¦¿à¦•à¦›à§œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(73, 43, 'Hathazari ', 'à¦¹à¦¾à¦ à¦¹à¦¾à¦œà¦¾à¦°à§€', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(74, 43, 'Lohagara ', 'à¦²à§‹à¦¹à¦¾à¦—à¦¾à¦°à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(75, 43, 'Mirsharai ', 'à¦®à¦¿à¦°à¦¸à¦°à¦¾à¦‡', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(76, 43, 'Patiya ', 'à¦ªà¦Ÿà¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(77, 43, 'Rangunia ', 'à¦°à¦¾à¦™à§à¦—à§à¦¨à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(78, 43, 'Raozan ', 'à¦°à¦¾à¦‰à¦œà¦¾à¦¨', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(79, 43, 'Sandwip ', 'à¦¸à¦¨à§à¦¦à§à¦¬à§€à¦ª', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(80, 43, 'Satkania ', 'à¦¸à¦¾à¦¤à¦•à¦¾à¦¨à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(81, 43, 'Sitakunda ', 'à¦¸à§€à¦¤à¦¾à¦•à§à¦£à§à¦¡', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(82, 44, 'Barura ', 'à¦¬à§œà§à¦°à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(83, 44, 'Brahmanpara ', 'à¦¬à§à¦°à¦¾à¦¹à§à¦®à¦£à¦ªà¦¾à§œà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(84, 44, 'Burichong ', 'à¦¬à§à§œà¦¿à¦šà¦‚', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(85, 44, 'Chandina ', 'à¦šà¦¾à¦¨à§à¦¦à¦¿à¦¨à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(86, 44, 'Chauddagram ', 'à¦šà§Œà¦¦à§à¦¦à¦—à§à¦°à¦¾à¦®', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(87, 44, 'Daudkandi ', 'à¦¦à¦¾à¦‰à¦¦à¦•à¦¾à¦¨à§à¦¦à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(88, 44, 'Debidwar ', 'à¦¦à§‡à¦¬à§€à¦¦à§à¦¬à¦¾à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(89, 44, 'Homna ', 'à¦¹à§‹à¦®à¦¨à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(90, 44, 'Cumilla Sadar ', 'à¦•à§à¦®à¦¿à¦²à§à¦²à¦¾ à¦¸à¦¦à¦°', NULL, '2020-08-25 12:00:00', NULL, '2020-08-25 12:00:00', NULL, NULL),
(91, 44, 'Laksam ', 'à¦²à¦¾à¦•à¦¸à¦¾à¦®', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(92, 44, 'Monohorgonj ', 'à¦®à¦¨à§‹à¦¹à¦°à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(93, 44, 'Meghna ', 'à¦®à§‡à¦˜à¦¨à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(94, 44, 'Muradnagar ', 'à¦®à§à¦°à¦¾à¦¦à¦¨à¦—à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(95, 44, 'Nangalkot ', 'à¦¨à¦¾à¦™à§à¦—à¦¾à¦²à¦•à§‹à¦Ÿ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(96, 44, 'Cumilla Sadar South ', 'à¦•à§à¦®à¦¿à¦²à§à¦²à¦¾ à¦¸à¦¦à¦° à¦¦à¦•à§à¦·à¦¿', NULL, '2020-08-25 12:00:00', NULL, '2020-08-25 12:00:00', NULL, NULL),
(97, 44, 'Titas ', 'à¦¤à¦¿à¦¤à¦¾à¦¸', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(98, 45, 'Chakaria ', 'à¦šà¦•à¦°à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(99, 45, 'Chakaria ', 'à¦šà¦•à¦°à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(100, 45, 'Cox\'s Bazar Sadar ', 'à¦•à¦•à§à¦¸ à¦¬à¦¾à¦œà¦¾à¦° à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(101, 45, 'Kutubdia ', 'à¦•à§à¦¤à§à¦¬à¦¦à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(102, 45, 'Maheshkhali ', 'à¦®à¦¹à§‡à¦¶à¦–à¦¾à¦²à§€', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(103, 45, 'Ramu ', 'à¦°à¦¾à¦®à§', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(104, 45, 'Teknaf ', 'à¦Ÿà§‡à¦•à¦¨à¦¾à¦«', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(105, 45, 'Ukhia ', 'à¦‰à¦–à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(106, 45, 'Pekua ', 'à¦ªà§‡à¦•à§à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(107, 46, 'Feni Sadar', 'à¦«à§‡à¦¨à§€ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(108, 46, 'Chagalnaiya', 'à¦›à¦¾à¦—à¦² à¦¨à¦¾à¦‡à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(109, 46, 'Daganbhyan', 'à¦¦à¦¾à¦—à¦¾à¦¨à¦­à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(110, 46, 'Parshuram', 'à¦ªà¦°à¦¶à§à¦°à¦¾à¦®', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(111, 46, 'Fhulgazi', 'à¦«à§à¦²à¦—à¦¾à¦œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(112, 46, 'Sonagazi', 'à¦¸à§‹à¦¨à¦¾à¦—à¦¾à¦œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(113, 47, 'Dighinala ', 'à¦¦à¦¿à¦˜à¦¿à¦¨à¦¾à¦²à¦¾ ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(114, 47, 'Khagrachhari ', 'à¦–à¦¾à¦—à§œà¦¾à¦›à§œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(115, 47, 'Lakshmichhari ', 'à¦²à¦•à§à¦·à§à¦®à§€à¦›à§œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(116, 47, 'Mahalchhari ', 'à¦®à¦¹à¦²à¦›à§œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(117, 47, 'Manikchhari ', 'à¦®à¦¾à¦¨à¦¿à¦•à¦›à§œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(118, 47, 'Matiranga ', 'à¦®à¦¾à¦Ÿà¦¿à¦°à¦¾à¦™à§à¦—à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(119, 47, 'Panchhari ', 'à¦ªà¦¾à¦¨à¦›à§œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(120, 47, 'Ramgarh ', 'à¦°à¦¾à¦®à¦—à§œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(121, 48, 'Lakshmipur Sadar ', 'à¦²à¦•à§à¦·à§à¦®à§€à¦ªà§à¦° à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(122, 48, 'Raipur ', 'à¦°à¦¾à§Ÿà¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(123, 48, 'Ramganj ', 'à¦°à¦¾à¦®à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(124, 48, 'Ramgati ', 'à¦°à¦¾à¦®à¦—à¦¤à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(125, 48, 'Komol Nagar ', 'à¦•à¦®à¦² à¦¨à¦—à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(126, 49, 'Noakhali Sadar ', 'à¦¨à§‹à§Ÿà¦¾à¦–à¦¾à¦²à§€ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(127, 49, 'Begumganj ', 'à¦¬à§‡à¦—à¦®à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(128, 49, 'Chatkhil ', 'à¦šà¦¾à¦Ÿà¦–à¦¿à¦²', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(129, 49, 'Companyganj ', 'à¦•à§‹à¦®à§à¦ªà¦¾à¦¨à§€à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(130, 49, 'Shenbag ', 'à¦¶à§‡à¦¨à¦¬à¦¾à¦—', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(131, 49, 'Hatia ', 'à¦¹à¦¾à¦¤à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(132, 49, 'Kobirhat ', 'à¦•à¦¬à¦¿à¦°à¦¹à¦¾à¦Ÿ ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(133, 49, 'Sonaimuri ', 'à¦¸à§‹à¦¨à¦¾à¦‡à¦®à§à¦°à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(134, 49, 'Suborno Char ', 'à¦¸à§à¦¬à¦°à§à¦£ à¦šà¦° ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(135, 50, 'Rangamati Sadar ', 'à¦°à¦¾à¦™à§à¦—à¦¾à¦®à¦¾à¦Ÿà¦¿ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(136, 50, 'Belaichhari ', 'à¦¬à§‡à¦²à¦¾à¦‡à¦›à§œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(137, 50, 'Bagaichhari ', 'à¦¬à¦¾à¦˜à¦¾à¦‡à¦›à§œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(138, 50, 'Barkal ', 'à¦¬à¦°à¦•à¦²', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(139, 50, 'Juraichhari ', 'à¦œà§à¦°à¦¾à¦‡à¦›à§œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(140, 50, 'Rajasthali ', 'à¦°à¦¾à¦œà¦¾à¦¸à§à¦¥à¦²à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(141, 50, 'Kaptai ', 'à¦•à¦¾à¦ªà§à¦¤à¦¾à¦‡', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(142, 50, 'Langadu ', 'à¦²à¦¾à¦™à§à¦—à¦¾à¦¡à§', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(143, 50, 'Nannerchar ', 'à¦¨à¦¾à¦¨à§à¦¨à§‡à¦°à¦šà¦° ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(144, 50, 'Kaukhali ', 'à¦•à¦¾à¦‰à¦–à¦¾à¦²à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(150, 2, 'Faridpur Sadar ', 'à¦«à¦°à¦¿à¦¦à¦ªà§à¦° à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(151, 2, 'Boalmari ', 'à¦¬à§‹à§Ÿà¦¾à¦²à¦®à¦¾à¦°à§€', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(152, 2, 'Alfadanga ', 'à¦†à¦²à¦«à¦¾à¦¡à¦¾à¦™à§à¦—à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(153, 2, 'Madhukhali ', 'à¦®à¦§à§à¦–à¦¾à¦²à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(154, 2, 'Bhanga ', 'à¦­à¦¾à¦™à§à¦—à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(155, 2, 'Nagarkanda ', 'à¦¨à¦—à¦°à¦•à¦¾à¦¨à§à¦¡', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(156, 2, 'Charbhadrasan ', 'à¦šà¦°à¦­à¦¦à§à¦°à¦¾à¦¸à¦¨ ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(157, 2, 'Sadarpur ', 'à¦¸à¦¦à¦°à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(158, 2, 'Shaltha ', 'à¦¶à¦¾à¦²à¦¥à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(159, 3, 'Gazipur Sadar-Joydebpur', 'à¦—à¦¾à¦œà§€à¦ªà§à¦° à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(160, 3, 'Kaliakior', 'à¦•à¦¾à¦²à¦¿à§Ÿà¦¾à¦•à§ˆà¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(161, 3, 'Kapasia', 'à¦•à¦¾à¦ªà¦¾à¦¸à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(162, 3, 'Sripur', 'à¦¶à§à¦°à§€à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(163, 3, 'Kaliganj', 'à¦•à¦¾à¦²à§€à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(164, 3, 'Tongi', 'à¦Ÿà¦™à§à¦—à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(165, 4, 'Gopalganj Sadar ', 'à¦—à§‹à¦ªà¦¾à¦²à¦—à¦žà§à¦œ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(166, 4, 'Kashiani ', 'à¦•à¦¾à¦¶à¦¿à§Ÿà¦¾à¦¨à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(167, 4, 'Kotalipara ', 'à¦•à§‹à¦Ÿà¦¾à¦²à¦¿à¦ªà¦¾à§œà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(168, 4, 'Muksudpur ', 'à¦®à§à¦•à¦¸à§à¦¦à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(169, 4, 'Tungipara ', 'à¦Ÿà§à¦™à§à¦—à¦¿à¦ªà¦¾à§œà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(170, 5, 'Dewanganj ', 'à¦¦à§‡à¦“à§Ÿà¦¾à¦¨à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(171, 5, 'Baksiganj ', 'à¦¬à¦•à¦¸à¦¿à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(172, 5, 'Islampur ', 'à¦‡à¦¸à¦²à¦¾à¦®à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(173, 5, 'Jamalpur Sadar ', 'à¦œà¦¾à¦®à¦¾à¦²à¦ªà§à¦° à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(174, 5, 'Madarganj ', 'à¦®à¦¾à¦¦à¦¾à¦°à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(175, 5, 'Melandaha ', 'à¦®à§‡à¦²à¦¾à¦¨à¦¦à¦¾à¦¹à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(176, 5, 'Sarishabari ', 'à¦¸à¦°à¦¿à¦·à¦¾à¦¬à¦¾à§œà¦¿ ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(177, 5, 'Narundi Police I.C', 'à¦¨à¦¾à¦°à§à¦¨à§à¦¦à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(178, 6, 'Astagram ', 'à¦…à¦·à§à¦Ÿà¦—à§à¦°à¦¾à¦®', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(179, 6, 'Bajitpur ', 'à¦¬à¦¾à¦œà¦¿à¦¤à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(180, 6, 'Bhairab ', 'à¦­à§ˆà¦°à¦¬', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(181, 6, 'Hossainpur ', 'à¦¹à§‹à¦¸à§‡à¦¨à¦ªà§à¦° ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(182, 6, 'Itna ', 'à¦‡à¦Ÿà¦¨à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(183, 6, 'Karimganj ', 'à¦•à¦°à¦¿à¦®à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(184, 6, 'Katiadi ', 'à¦•à¦¤à¦¿à§Ÿà¦¾à¦¦à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(185, 6, 'Kishoreganj Sadar ', 'à¦•à¦¿à¦¶à§‹à¦°à¦—à¦žà§à¦œ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(186, 6, 'Kuliarchar ', 'à¦•à§à¦²à¦¿à§Ÿà¦¾à¦°à¦šà¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(187, 6, 'Mithamain ', 'à¦®à¦¿à¦ à¦¾à¦®à¦¾à¦‡à¦¨', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(188, 6, 'Nikli ', 'à¦¨à¦¿à¦•à¦²à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(189, 6, 'Pakundia ', 'à¦ªà¦¾à¦•à§à¦¨à§à¦¡à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(190, 6, 'Tarail ', 'à¦¤à¦¾à§œà¦¾à¦‡à¦²', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(191, 7, 'Madaripur Sadar', 'à¦®à¦¾à¦¦à¦¾à¦°à§€à¦ªà§à¦° à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(192, 7, 'Kalkini', 'à¦•à¦¾à¦²à¦•à¦¿à¦¨à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(193, 7, 'Rajoir', 'à¦°à¦¾à¦œà¦‡à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(194, 7, 'Shibchar', 'à¦¶à¦¿à¦¬à¦šà¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(195, 8, 'Manikganj Sadar ', 'à¦®à¦¾à¦¨à¦¿à¦•à¦—à¦žà§à¦œ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(196, 8, 'Singair ', 'à¦¸à¦¿à¦™à§à¦—à¦¾à¦‡à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(197, 8, 'Shibalaya ', 'à¦¶à¦¿à¦¬à¦¾à¦²à§Ÿ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(198, 8, 'Saturia ', 'à¦¸à¦¾à¦ à§à¦°à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(199, 8, 'Harirampur ', 'à¦¹à¦°à¦¿à¦°à¦¾à¦®à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(200, 8, 'Ghior ', 'à¦˜à¦¿à¦“à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(201, 8, 'Daulatpur ', 'à¦¦à§Œà¦²à¦¤à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(202, 9, 'Lohajang ', 'à¦²à§‹à¦¹à¦¾à¦œà¦‚', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(203, 9, 'Sreenagar ', 'à¦¶à§à¦°à§€à¦¨à¦—à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(204, 9, 'Munshiganj Sadar ', 'à¦®à§à¦¨à§à¦¸à¦¿à¦—à¦žà§à¦œ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(205, 9, 'Sirajdikhan ', 'à¦¸à¦¿à¦°à¦¾à¦œà¦¦à¦¿à¦–à¦¾à¦¨', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(206, 9, 'Tongibari ', 'à¦Ÿà¦™à§à¦—à¦¿à¦¬à¦¾à§œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(207, 9, 'Gazaria ', 'à¦—à¦œà¦¾à¦°à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(208, 10, 'Bhaluka', 'à¦­à¦¾à¦²à§à¦•à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(209, 10, 'Trishal', 'à¦¤à§à¦°à¦¿à¦¶à¦¾à¦²', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(210, 10, 'Haluaghat', 'à¦¹à¦¾à¦²à§à§Ÿà¦¾à¦˜à¦¾à¦Ÿ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(211, 10, 'Muktagachha', 'à¦®à§à¦•à§à¦¤à¦¾à¦—à¦¾à¦›à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(212, 10, 'Dhobaura', 'à¦§à¦¬à¦¾à¦°à§à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(213, 10, 'Fulbaria', 'à¦«à§à¦²à¦¬à¦¾à§œà¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(214, 10, 'Gaffargaon', 'à¦—à¦«à¦°à¦—à¦¾à¦à¦“', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(215, 10, 'Gauripur', 'à¦—à§Œà¦°à¦¿à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(216, 10, 'Ishwarganj', 'à¦ˆà¦¶à§à¦¬à¦°à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(217, 10, 'Mymensingh Sadar', 'à¦®à§Ÿà¦®à¦¨à¦¸à¦¿à¦‚ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(218, 10, 'Nandail', 'à¦¨à¦¨à§à¦¦à¦¾à¦‡à¦²', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(219, 10, 'Phulpur', 'à¦«à§à¦²à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(220, 11, 'Araihazar ', 'à¦†à§œà¦¾à¦‡à¦¹à¦¾à¦œà¦¾à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(221, 11, 'Sonargaon ', 'à¦¸à§‹à¦¨à¦¾à¦°à¦—à¦¾à¦à¦“', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(222, 11, 'Bandar', 'à¦¬à¦¾à¦¨à§à¦¦à¦¾à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(223, 11, 'Naryanganj Sadar ', 'à¦¨à¦¾à¦°à¦¾à§Ÿà¦¾à¦¨à¦—à¦žà§à¦œ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(224, 11, 'Rupganj ', 'à¦°à§‚à¦ªà¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(225, 11, 'Siddirgonj ', 'à¦¸à¦¿à¦¦à§à¦§à¦¿à¦°à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(226, 12, 'Belabo ', 'à¦¬à§‡à¦²à¦¾à¦¬à§‹', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(227, 12, 'Monohardi ', 'à¦®à¦¨à§‹à¦¹à¦°à¦¦à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(228, 12, 'Narsingdi Sadar ', 'à¦¨à¦°à¦¸à¦¿à¦‚à¦¦à§€ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(229, 12, 'Palash ', 'à¦ªà¦²à¦¾à¦¶', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(230, 12, 'Raipura , Narsingdi', 'à¦°à¦¾à§Ÿà¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(231, 12, 'Shibpur ', 'à¦¶à¦¿à¦¬à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(232, 13, 'Kendua Upazilla', 'à¦•à§‡à¦¨à§à¦¦à§à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(233, 13, 'Atpara Upazilla', 'à¦†à¦Ÿà¦ªà¦¾à§œà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(234, 13, 'Barhatta Upazilla', 'à¦¬à¦°à¦¹à¦¾à¦Ÿà§à¦Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(235, 13, 'Durgapur Upazilla', 'à¦¦à§à¦°à§à¦—à¦¾à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(236, 13, 'Kalmakanda Upazilla', 'à¦•à¦²à¦®à¦¾à¦•à¦¾à¦¨à§à¦¦à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(237, 13, 'Madan Upazilla', 'à¦®à¦¦à¦¨', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(238, 13, 'Mohanganj Upazilla', 'à¦®à§‹à¦¹à¦¨à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(239, 13, 'Netrakona-S Upazilla', 'à¦¨à§‡à¦¤à§à¦°à¦•à§‹à¦¨à¦¾ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(240, 13, 'Purbadhala Upazilla', 'à¦ªà§‚à¦°à§à¦¬à¦§à¦²à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(241, 13, 'Khaliajuri Upazilla', 'à¦–à¦¾à¦²à¦¿à§Ÿà¦¾à¦œà§à¦°à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(242, 14, 'Baliakandi ', 'à¦¬à¦¾à¦²à¦¿à§Ÿà¦¾à¦•à¦¾à¦¨à§à¦¦à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(243, 14, 'Goalandaghat ', 'à¦—à§‹à§Ÿà¦¾à¦²à¦¨à§à¦¦ à¦˜à¦¾à¦Ÿ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(244, 14, 'Pangsha ', 'à¦ªà¦¾à¦‚à¦¶à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(245, 14, 'Kalukhali ', 'à¦•à¦¾à¦²à§à¦–à¦¾à¦²à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(246, 14, 'Rajbari Sadar ', 'à¦°à¦¾à¦œà¦¬à¦¾à§œà¦¿ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(247, 15, 'Shariatpur Sadar -Palong', 'à¦¶à¦°à§€à§Ÿà¦¤à¦ªà§à¦° à¦¸à¦¦à¦° ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(248, 15, 'Damudya ', 'à¦¦à¦¾à¦®à§à¦¦à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(249, 15, 'Naria ', 'à¦¨à§œà¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(250, 15, 'Jajira ', 'à¦œà¦¾à¦œà¦¿à¦°à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(251, 15, 'Bhedarganj ', 'à¦­à§‡à¦¦à¦¾à¦°à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(252, 15, 'Gosairhat ', 'à¦—à§‹à¦¸à¦¾à¦‡à¦° à¦¹à¦¾à¦Ÿ ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(253, 16, 'Jhenaigati ', 'à¦à¦¿à¦¨à¦¾à¦‡à¦—à¦¾à¦¤à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(254, 16, 'Nakla ', 'à¦¨à¦¾à¦•à¦²à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(255, 16, 'Nalitabari ', 'à¦¨à¦¾à¦²à¦¿à¦¤à¦¾à¦¬à¦¾à§œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(256, 16, 'Sherpur Sadar ', 'à¦¶à§‡à¦°à¦ªà§à¦° à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(257, 16, 'Sreebardi ', 'à¦¶à§à¦°à§€à¦¬à¦°à¦¦à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(258, 17, 'Tangail Sadar ', 'à¦Ÿà¦¾à¦™à§à¦—à¦¾à¦‡à¦² à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(259, 17, 'Sakhipur ', 'à¦¸à¦–à¦¿à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(260, 17, 'Basail ', 'à¦¬à¦¸à¦¾à¦‡à¦²', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(261, 17, 'Madhupur ', 'à¦®à¦§à§à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(262, 17, 'Ghatail ', 'à¦˜à¦¾à¦Ÿà¦¾à¦‡à¦²', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(263, 17, 'Kalihati ', 'à¦•à¦¾à¦²à¦¿à¦¹à¦¾à¦¤à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(264, 17, 'Nagarpur ', 'à¦¨à¦—à¦°à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(265, 17, 'Mirzapur ', 'à¦®à¦¿à¦°à§à¦œà¦¾à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(266, 17, 'Gopalpur ', 'à¦—à§‹à¦ªà¦¾à¦²à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(267, 17, 'Delduar ', 'à¦¦à§‡à¦²à¦¦à§à§Ÿà¦¾à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(268, 17, 'Bhuapur ', 'à¦­à§à§Ÿà¦¾à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(269, 17, 'Dhanbari ', 'à¦§à¦¾à¦¨à¦¬à¦¾à§œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(270, 55, 'Bagerhat Sadar ', 'à¦¬à¦¾à¦—à§‡à¦°à¦¹à¦¾à¦Ÿ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(271, 55, 'Chitalmari ', 'à¦šà¦¿à¦¤à¦²à¦®à¦¾à§œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(272, 55, 'Fakirhat ', 'à¦«à¦•à¦¿à¦°à¦¹à¦¾à¦Ÿ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(273, 55, 'Kachua ', 'à¦•à¦šà§à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(274, 55, 'Mollahat ', 'à¦®à§‹à¦²à§à¦²à¦¾à¦¹à¦¾à¦Ÿ ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(275, 55, 'Mongla ', 'à¦®à¦‚à¦²à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(276, 55, 'Morrelganj ', 'à¦®à¦°à§‡à¦²à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(277, 55, 'Rampal ', 'à¦°à¦¾à¦®à¦ªà¦¾à¦²', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(278, 55, 'Sarankhola ', 'à¦¸à§à¦®à¦°à¦£à¦–à§‹à¦²à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(279, 56, 'Damurhuda ', 'à¦¦à¦¾à¦®à§à¦°à¦¹à§à¦¦à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(280, 56, 'Chuadanga-S ', 'à¦šà§à§Ÿà¦¾à¦¡à¦¾à¦™à§à¦—à¦¾ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(281, 56, 'Jibannagar ', 'à¦œà§€à¦¬à¦¨ à¦¨à¦—à¦° ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(282, 56, 'Alamdanga ', 'à¦†à¦²à¦®à¦¡à¦¾à¦™à§à¦—à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(283, 57, 'Abhaynagar ', 'à¦…à¦­à§Ÿà¦¨à¦—à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(284, 57, 'Keshabpur ', 'à¦•à§‡à¦¶à¦¬à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(285, 57, 'Bagherpara ', 'à¦¬à¦¾à¦˜à§‡à¦° à¦ªà¦¾à§œà¦¾ ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(286, 57, 'Jashore Sadar ', 'à¦¯à¦¶à§‹à¦° à¦¸à¦¦à¦°', NULL, '2020-08-25 12:00:00', NULL, '2020-08-25 12:00:00', NULL, NULL),
(287, 57, 'Chaugachha ', 'à¦šà§Œà¦—à¦¾à¦›à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(288, 57, 'Manirampur ', 'à¦®à¦¨à¦¿à¦°à¦¾à¦®à¦ªà§à¦° ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(289, 57, 'Jhikargachha ', 'à¦à¦¿à¦•à¦°à¦—à¦¾à¦›à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(290, 57, 'Sharsha ', 'à¦¸à¦¾à¦°à¦¶à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(291, 58, 'Jhenaidah Sadar ', 'à¦à¦¿à¦¨à¦¾à¦‡à¦¦à¦¹ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(292, 58, 'Maheshpur ', 'à¦®à¦¹à§‡à¦¶à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(293, 58, 'Kaliganj ', 'à¦•à¦¾à¦²à§€à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(294, 58, 'Kotchandpur ', 'à¦•à§‹à¦Ÿ à¦šà¦¾à¦à¦¦à¦ªà§à¦° ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(295, 58, 'Shailkupa ', 'à¦¶à§ˆà¦²à¦•à§à¦ªà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(296, 58, 'Harinakunda ', 'à¦¹à¦¾à§œà¦¿à¦¨à¦¾à¦•à§à¦¨à§à¦¦à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(297, 59, 'Terokhada ', 'à¦¤à§‡à¦°à§‹à¦–à¦¾à¦¦à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(298, 59, 'Batiaghata ', 'à¦¬à¦¾à¦Ÿà¦¿à§Ÿà¦¾à¦˜à¦¾à¦Ÿà¦¾ ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(299, 59, 'Dacope ', 'à¦¡à¦¾à¦•à¦ªà§‡', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(300, 59, 'Dumuria ', 'à¦¡à§à¦®à§à¦°à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(301, 59, 'Dighalia ', 'à¦¦à¦¿à¦˜à¦²à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(302, 59, 'Koyra ', 'à¦•à§Ÿà§œà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(303, 59, 'Paikgachha ', 'à¦ªà¦¾à¦‡à¦•à¦—à¦¾à¦›à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(304, 59, 'Phultala ', 'à¦«à§à¦²à¦¤à¦²à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(305, 59, 'Rupsa ', 'à¦°à§‚à¦ªà¦¸à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(306, 60, 'Kushtia Sadar', 'à¦•à§à¦·à§à¦Ÿà¦¿à§Ÿà¦¾ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(307, 60, 'Kumarkhali', 'à¦•à§à¦®à¦¾à¦°à¦–à¦¾à¦²à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(308, 60, 'Daulatpur', 'à¦¦à§Œà¦²à¦¤à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(309, 60, 'Mirpur', 'à¦®à¦¿à¦°à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(310, 60, 'Bheramara', 'à¦­à§‡à¦°à¦¾à¦®à¦¾à¦°à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(311, 60, 'Khoksa', 'à¦–à§‹à¦•à¦¸à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(312, 61, 'Magura Sadar ', 'à¦®à¦¾à¦—à§à¦°à¦¾ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(313, 61, 'Mohammadpur ', 'à¦®à§‹à¦¹à¦¾à¦®à§à¦®à¦¾à¦¦à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(314, 61, 'Shalikha ', 'à¦¶à¦¾à¦²à¦¿à¦–à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(315, 61, 'Sreepur ', 'à¦¶à§à¦°à§€à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(316, 62, 'angni ', 'à¦†à¦‚à¦¨à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(317, 62, 'Mujib Nagar ', 'à¦®à§à¦œà¦¿à¦¬ à¦¨à¦—à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(318, 62, 'Meherpur-S ', 'à¦®à§‡à¦¹à§‡à¦°à¦ªà§à¦° à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(319, 63, 'Narail-S Upazilla', 'à¦¨à§œà¦¾à¦‡à¦² à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(320, 63, 'Lohagara Upazilla', 'à¦²à§‹à¦¹à¦¾à¦—à¦¾à§œà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(321, 63, 'Kalia Upazilla', 'à¦•à¦¾à¦²à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(322, 64, 'Satkhira Sadar ', 'à¦¸à¦¾à¦¤à¦•à§à¦·à§€à¦°à¦¾ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(323, 64, 'Assasuni ', 'à¦†à¦¸à¦¸à¦¾à¦¶à§à¦¨à¦¿ ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(324, 64, 'Debhata ', 'à¦¦à§‡à¦­à¦¾à¦Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(325, 64, 'Tala ', 'à¦¤à¦¾à¦²à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(326, 64, 'Kalaroa ', 'à¦•à¦²à¦°à§‹à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(327, 64, 'Kaliganj ', 'à¦•à¦¾à¦²à§€à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(328, 64, 'Shyamnagar ', 'à¦¶à§à¦¯à¦¾à¦®à¦¨à¦—à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(329, 18, 'Adamdighi', 'à¦†à¦¦à¦®à¦¦à¦¿à¦˜à§€', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(330, 18, 'Bogura Sadar', 'à¦¬à¦—à§à§œà¦¾ à¦¸à¦¦à¦°', NULL, '2020-08-25 12:00:00', NULL, '2020-08-25 12:00:00', NULL, NULL),
(331, 18, 'Sherpur', 'à¦¶à§‡à¦°à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(332, 18, 'Dhunat', 'à¦§à§à¦¨à¦Ÿ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(333, 18, 'Dhupchanchia', 'à¦¦à§à¦ªà¦šà¦¾à¦šà¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(334, 18, 'Gabtali', 'à¦—à¦¾à¦¬à¦¤à¦²à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(335, 18, 'Kahaloo', 'à¦•à¦¾à¦¹à¦¾à¦²à§', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(336, 18, 'Nandigram', 'à¦¨à¦¨à§à¦¦à¦¿à¦—à§à¦°à¦¾à¦®', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(337, 18, 'Sahajanpur', 'à¦¶à¦¾à¦¹à¦œà¦¾à¦¹à¦¾à¦¨à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(338, 18, 'Sariakandi', 'à¦¸à¦¾à¦°à¦¿à§Ÿà¦¾à¦•à¦¾à¦¨à§à¦¦à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(339, 18, 'Shibganj', 'à¦¶à¦¿à¦¬à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(340, 18, 'Sonatala', 'à¦¸à§‹à¦¨à¦¾à¦¤à¦²à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(341, 19, 'Joypurhat S', 'à¦œà§Ÿà¦ªà§à¦°à¦¹à¦¾à¦Ÿ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(342, 19, 'Akkelpur', 'à¦†à¦•à§à¦•à§‡à¦²à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(343, 19, 'Kalai', 'à¦•à¦¾à¦²à¦¾à¦‡', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(344, 19, 'Khetlal', 'à¦–à§‡à¦¤à¦²à¦¾à¦²', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(345, 19, 'Panchbibi', 'à¦ªà¦¾à¦à¦šà¦¬à¦¿à¦¬à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(346, 20, 'Naogaon Sadar ', 'à¦¨à¦“à¦—à¦¾à¦ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(347, 20, 'Mohadevpur ', 'à¦®à¦¹à¦¾à¦¦à§‡à¦¬à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(348, 20, 'Manda ', 'à¦®à¦¾à¦¨à§à¦¦à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(349, 20, 'Niamatpur ', 'à¦¨à¦¿à§Ÿà¦¾à¦®à¦¤à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(350, 20, 'Atrai ', 'à¦†à¦¤à§à¦°à¦¾à¦‡', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(351, 20, 'Raninagar ', 'à¦°à¦¾à¦£à§€à¦¨à¦—à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(352, 20, 'Patnitala ', 'à¦ªà¦¤à§à¦¨à§€à¦¤à¦²à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(353, 20, 'Dhamoirhat ', 'à¦§à¦¾à¦®à¦‡à¦°à¦¹à¦¾à¦Ÿ ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(354, 20, 'Sapahar ', 'à¦¸à¦¾à¦ªà¦¾à¦¹à¦¾à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(355, 20, 'Porsha ', 'à¦ªà§‹à¦°à¦¶à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(356, 20, 'Badalgachhi ', 'à¦¬à¦¦à¦²à¦—à¦¾à¦›à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(357, 21, 'Natore Sadar ', 'à¦¨à¦¾à¦Ÿà§‹à¦° à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(358, 21, 'Baraigram ', 'à¦¬à§œà¦¾à¦‡à¦—à§à¦°à¦¾à¦®', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(359, 21, 'Bagatipara ', 'à¦¬à¦¾à¦—à¦¾à¦¤à¦¿à¦ªà¦¾à§œà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(360, 21, 'Lalpur ', 'à¦²à¦¾à¦²à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(361, 21, 'Natore Sadar ', 'à¦¨à¦¾à¦Ÿà§‹à¦° à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(362, 21, 'Baraigram ', 'à¦¬à§œà¦¾à¦‡ à¦—à§à¦°à¦¾à¦®', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(363, 22, 'Bholahat ', 'à¦­à§‹à¦²à¦¾à¦¹à¦¾à¦Ÿ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(364, 22, 'Gomastapur ', 'à¦—à§‹à¦®à¦¸à§à¦¤à¦¾à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(365, 22, 'Nachole ', 'à¦¨à¦¾à¦šà§‹à¦²', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(366, 22, 'Nawabganj Sadar ', 'à¦¨à¦¬à¦¾à¦¬à¦—à¦žà§à¦œ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(367, 22, 'Shibganj ', 'à¦¶à¦¿à¦¬à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(368, 23, 'Atgharia ', 'à¦†à¦Ÿà¦˜à¦°à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(369, 23, 'Bera ', 'à¦¬à§‡à§œà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(370, 23, 'Bhangura ', 'à¦­à¦¾à¦™à§à¦—à§à¦°à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(371, 23, 'Chatmohar ', 'à¦šà¦¾à¦Ÿà¦®à§‹à¦¹à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(372, 23, 'Faridpur ', 'à¦«à¦°à¦¿à¦¦à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(373, 23, 'Ishwardi ', 'à¦ˆà¦¶à§à¦¬à¦°à¦¦à§€', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(374, 23, 'Pabna Sadar ', 'à¦ªà¦¾à¦¬à¦¨à¦¾ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(375, 23, 'Santhia ', 'à¦¸à¦¾à¦¥à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(376, 23, 'Sujanagar ', 'à¦¸à§à¦œà¦¾à¦¨à¦—à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(377, 24, 'Bagha', 'à¦¬à¦¾à¦˜à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(378, 24, 'Bagmara', 'à¦¬à¦¾à¦—à¦®à¦¾à¦°à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(379, 24, 'Charghat', 'à¦šà¦¾à¦°à¦˜à¦¾à¦Ÿ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(380, 24, 'Durgapur', 'à¦¦à§à¦°à§à¦—à¦¾à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(381, 24, 'Godagari', 'à¦—à§‹à¦¦à¦¾à¦—à¦¾à¦°à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(382, 24, 'Mohanpur', 'à¦®à§‹à¦¹à¦¨à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(383, 24, 'Paba', 'à¦ªà¦¬à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(384, 24, 'Puthia', 'à¦ªà§à¦ à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(385, 24, 'Tanore', 'à¦¤à¦¾à¦¨à§‹à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(386, 25, 'Sirajganj Sadar ', 'à¦¸à¦¿à¦°à¦¾à¦œà¦—à¦žà§à¦œ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(387, 25, 'Belkuchi ', 'à¦¬à§‡à¦²à¦•à§à¦šà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(388, 25, 'Chauhali ', 'à¦šà§Œà¦¹à¦¾à¦²à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(389, 25, 'Kamarkhanda ', 'à¦•à¦¾à¦®à¦¾à¦°à¦–à¦¾à¦¨à§à¦¦à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(390, 25, 'Kazipur ', 'à¦•à¦¾à¦œà§€à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(391, 25, 'Raiganj ', 'à¦°à¦¾à§Ÿà¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(392, 25, 'Shahjadpur ', 'à¦¶à¦¾à¦¹à¦œà¦¾à¦¦à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(393, 25, 'Tarash ', 'à¦¤à¦¾à¦°à¦¾à¦¶', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(394, 25, 'Ullahpara ', 'à¦‰à¦²à§à¦²à¦¾à¦ªà¦¾à§œà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(395, 26, 'Birampur ', 'à¦¬à¦¿à¦°à¦¾à¦®à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(396, 26, 'Birganj', 'à¦¬à§€à¦°à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(397, 26, 'Biral ', 'à¦¬à¦¿à§œà¦¾à¦²', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(398, 26, 'Bochaganj ', 'à¦¬à§‹à¦šà¦¾à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(399, 26, 'Chirirbandar ', 'à¦šà¦¿à¦°à¦¿à¦°à¦¬à¦¨à§à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(400, 26, 'Phulbari ', 'à¦«à§à¦²à¦¬à¦¾à§œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(401, 26, 'Ghoraghat ', 'à¦˜à§‹à§œà¦¾à¦˜à¦¾à¦Ÿ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(402, 26, 'Hakimpur ', 'à¦¹à¦¾à¦•à¦¿à¦®à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(403, 26, 'Kaharole ', 'à¦•à¦¾à¦¹à¦¾à¦°à§‹à¦²', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(404, 26, 'Khansama ', 'à¦–à¦¾à¦¨à¦¸à¦¾à¦®à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(405, 26, 'Dinajpur Sadar ', 'à¦¦à¦¿à¦¨à¦¾à¦œà¦ªà§à¦° à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(406, 26, 'Nawabganj', 'à¦¨à¦¬à¦¾à¦¬à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(407, 26, 'Parbatipur ', 'à¦ªà¦¾à¦°à§à¦¬à¦¤à§€à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(408, 27, 'Fulchhari', 'à¦«à§à¦²à¦›à§œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(409, 27, 'Gaibandha sadar', 'à¦—à¦¾à¦‡à¦¬à¦¾à¦¨à§à¦§à¦¾ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(410, 27, 'Gobindaganj', 'à¦—à§‹à¦¬à¦¿à¦¨à§à¦¦à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(411, 27, 'Palashbari', 'à¦ªà¦²à¦¾à¦¶à¦¬à¦¾à§œà§€', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(412, 27, 'Sadullapur', 'à¦¸à¦¾à¦¦à§à¦²à§à¦¯à¦¾à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(413, 27, 'Saghata', 'à¦¸à¦¾à¦˜à¦¾à¦Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(414, 27, 'Sundarganj', 'à¦¸à§à¦¨à§à¦¦à¦°à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(415, 28, 'Kurigram Sadar', 'à¦•à§à§œà¦¿à¦—à§à¦°à¦¾à¦® à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(416, 28, 'Nageshwari', 'à¦¨à¦¾à¦—à§‡à¦¶à§à¦¬à¦°à§€', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(417, 28, 'Bhurungamari', 'à¦­à§à¦°à§à¦™à§à¦—à¦¾à¦®à¦¾à¦°à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(418, 28, 'Phulbari', 'à¦«à§à¦²à¦¬à¦¾à§œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO `ssc_upazilas` (`UPAZILA_ID`, `DISTRICT_ID`, `UPAZILA_NAME`, `UPAZILA_NAME_BN`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`) VALUES
(419, 28, 'Rajarhat', 'à¦°à¦¾à¦œà¦¾à¦°à¦¹à¦¾à¦Ÿ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(420, 28, 'Ulipur', 'à¦‰à¦²à¦¿à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(421, 28, 'Chilmari', 'à¦šà¦¿à¦²à¦®à¦¾à¦°à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(422, 28, 'Rowmari', 'à¦°à¦‰à¦®à¦¾à¦°à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(423, 28, 'Char Rajibpur', 'à¦šà¦° à¦°à¦¾à¦œà¦¿à¦¬à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(424, 29, 'Lalmanirhat Sadar', 'à¦²à¦¾à¦²à¦®à¦¨à¦¿à¦°à¦¹à¦¾à¦Ÿ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(425, 29, 'Aditmari', 'à¦†à¦¦à¦¿à¦¤à¦®à¦¾à¦°à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(426, 29, 'Kaliganj', 'à¦•à¦¾à¦²à§€à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(427, 29, 'Hatibandha', 'à¦¹à¦¾à¦¤à¦¿à¦¬à¦¾à¦¨à§à¦§à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(428, 29, 'Patgram', 'à¦ªà¦¾à¦Ÿà¦—à§à¦°à¦¾à¦®', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(429, 30, 'Nilphamari Sadar', 'à¦¨à§€à¦²à¦«à¦¾à¦®à¦¾à¦°à§€ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(430, 30, 'Saidpur', 'à¦¸à§ˆà§Ÿà¦¦à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(431, 30, 'Jaldhaka', 'à¦œà¦²à¦¢à¦¾à¦•à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(432, 30, 'Kishoreganj', 'à¦•à¦¿à¦¶à§‹à¦°à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(433, 30, 'Domar', 'à¦¡à§‹à¦®à¦¾à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(434, 30, 'Dimla', 'à¦¡à¦¿à¦®à¦²à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(435, 31, 'Panchagarh Sadar', 'à¦ªà¦žà§à¦šà¦—à§œ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(436, 31, 'Debiganj', 'à¦¦à§‡à¦¬à§€à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(437, 31, 'Boda', 'à¦¬à§‹à¦¦à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(438, 31, 'Atwari', 'à¦†à¦Ÿà§‹à§Ÿà¦¾à¦°à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(439, 31, 'Tetulia', 'à¦¤à§‡à¦¤à§à¦²à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(440, 32, 'Badarganj', 'à¦¬à¦¦à¦°à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(441, 32, 'Mithapukur', 'à¦®à¦¿à¦ à¦¾à¦ªà§à¦•à§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(442, 32, 'Gangachara', 'à¦—à¦™à§à¦—à¦¾à¦šà¦°à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(443, 32, 'Kaunia', 'à¦•à¦¾à¦‰à¦¨à¦¿à§Ÿà¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(444, 32, 'Rangpur Sadar', 'à¦°à¦‚à¦ªà§à¦° à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(445, 32, 'Pirgachha', 'à¦ªà§€à¦°à¦—à¦¾à¦›à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(446, 32, 'Pirganj', 'à¦ªà§€à¦°à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(447, 32, 'Taraganj', 'à¦¤à¦¾à¦°à¦¾à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(448, 33, 'Thakurgaon Sadar ', 'à¦ à¦¾à¦•à§à¦°à¦—à¦¾à¦à¦“ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(449, 33, 'Pirganj ', 'à¦ªà§€à¦°à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(450, 33, 'Baliadangi ', 'à¦¬à¦¾à¦²à¦¿à§Ÿà¦¾à¦¡à¦¾à¦™à§à¦—à¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(451, 33, 'Haripur ', 'à¦¹à¦°à¦¿à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(452, 33, 'Ranisankail ', 'à¦°à¦¾à¦£à§€à¦¸à¦‚à¦•à¦‡à¦²', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(453, 51, 'Ajmiriganj', 'à¦†à¦œà¦®à¦¿à¦°à¦¿à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(454, 51, 'Baniachang', 'à¦¬à¦¾à¦¨à¦¿à§Ÿà¦¾à¦šà¦‚', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(455, 51, 'Bahubal', 'à¦¬à¦¾à¦¹à§à¦¬à¦²', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(456, 51, 'Chunarughat', 'à¦šà§à¦¨à¦¾à¦°à§à¦˜à¦¾à¦Ÿ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(457, 51, 'Habiganj Sadar', 'à¦¹à¦¬à¦¿à¦—à¦žà§à¦œ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(458, 51, 'Lakhai', 'à¦²à¦¾à¦•à§à¦·à¦¾à¦‡', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(459, 51, 'Madhabpur', 'à¦®à¦¾à¦§à¦¬à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(460, 51, 'Nabiganj', 'à¦¨à¦¬à§€à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(461, 51, 'Shaistagonj ', 'à¦¶à¦¾à§Ÿà§‡à¦¸à§à¦¤à¦¾à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(462, 52, 'Moulvibazar Sadar', 'à¦®à§Œà¦²à¦­à§€à¦¬à¦¾à¦œà¦¾à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(463, 52, 'Barlekha', 'à¦¬à§œà¦²à§‡à¦–à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(464, 52, 'Juri', 'à¦œà§à§œà¦¿', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(465, 52, 'Kamalganj', 'à¦•à¦¾à¦®à¦¾à¦²à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(466, 52, 'Kulaura', 'à¦•à§à¦²à¦¾à¦‰à¦°à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(467, 52, 'Rajnagar', 'à¦°à¦¾à¦œà¦¨à¦—à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(468, 52, 'Sreemangal', 'à¦¶à§à¦°à§€à¦®à¦™à§à¦—à¦²', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(469, 53, 'Bishwamvarpur', 'à¦¬à¦¿à¦¸à¦¶à¦®à§à¦­à¦¾à¦°à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(470, 53, 'Chhatak', 'à¦›à¦¾à¦¤à¦•', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(471, 53, 'Derai', 'à¦¦à§‡à§œà¦¾à¦‡', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(472, 53, 'Dharampasha', 'à¦§à¦°à¦®à¦ªà¦¾à¦¶à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(473, 53, 'Dowarabazar', 'à¦¦à§‹à§Ÿà¦¾à¦°à¦¾à¦¬à¦¾à¦œà¦¾à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(474, 53, 'Jagannathpur', 'à¦œà¦—à¦¨à§à¦¨à¦¾à¦¥à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(475, 53, 'Jamalganj', 'à¦œà¦¾à¦®à¦¾à¦²à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(476, 53, 'Sulla', 'à¦¸à§à¦²à§à¦²à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(477, 53, 'Sunamganj Sadar', 'à¦¸à§à¦¨à¦¾à¦®à¦—à¦žà§à¦œ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(478, 53, 'Shanthiganj', 'à¦¶à¦¾à¦¨à§à¦¤à¦¿à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(479, 53, 'Tahirpur', 'à¦¤à¦¾à¦¹à¦¿à¦°à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(480, 54, 'Sylhet Sadar', 'à¦¸à¦¿à¦²à§‡à¦Ÿ à¦¸à¦¦à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(481, 54, 'Beanibazar', 'à¦¬à§‡à§Ÿà¦¾à¦¨à¦¿à¦¬à¦¾à¦œà¦¾à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(482, 54, 'Bishwanath', 'à¦¬à¦¿à¦¶à§à¦¬à¦¨à¦¾à¦¥', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(483, 54, 'Dakshin Surma ', 'à¦¦à¦•à§à¦·à¦¿à¦£ à¦¸à§à¦°à¦®à¦¾', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(484, 54, 'Balaganj', 'à¦¬à¦¾à¦²à¦¾à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(485, 54, 'Companiganj', 'à¦•à§‹à¦®à§à¦ªà¦¾à¦¨à¦¿à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(486, 54, 'Fenchuganj', 'à¦«à§‡à¦žà§à¦šà§à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(487, 54, 'Golapganj', 'à¦—à§‹à¦²à¦¾à¦ªà¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(488, 54, 'Gowainghat', 'à¦—à§‹à§Ÿà¦¾à¦‡à¦¨à¦˜à¦¾à¦Ÿ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(489, 54, 'Jaintiapur', 'à¦œà§Ÿà¦¨à§à¦¤à¦ªà§à¦°', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(490, 54, 'Kanaighat', 'à¦•à¦¾à¦¨à¦¾à¦‡à¦˜à¦¾à¦Ÿ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(491, 54, 'Zakiganj', 'à¦œà¦¾à¦•à¦¿à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(492, 54, 'Nobigonj', 'à¦¨à¦¬à§€à¦—à¦žà§à¦œ', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(493, 1, 'Adabor', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(494, 1, 'Airport', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(495, 1, 'Badda', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(496, 1, 'Banani', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(497, 1, 'Bangshal', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(498, 1, 'Bhashantek', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(499, 1, 'Cantonment', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(500, 1, 'Chackbazar', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(501, 1, 'Darussalam', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(502, 1, 'Daskhinkhan', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(503, 1, 'Demra', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(504, 1, 'Dhamrai', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(505, 1, 'Dhanmondi', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(506, 1, 'Dohar', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(507, 1, 'Gandaria', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(508, 1, 'Gulshan', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(509, 1, 'Hazaribag', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(510, 1, 'Jatrabari', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(511, 1, 'Kafrul', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(512, 1, 'Kalabagan', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(513, 1, 'Kamrangirchar', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(514, 1, 'Keraniganj', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(515, 1, 'Khilgaon', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(516, 1, 'Khilkhet', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(517, 1, 'Kotwali', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(518, 1, 'Lalbag', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(519, 1, 'Mirpur Model', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(520, 1, 'Mohammadpur', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(521, 1, 'Motijheel', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(522, 1, 'Mugda', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(523, 1, 'Nawabganj', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(524, 1, 'New Market', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(525, 1, 'Pallabi', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(526, 1, 'Paltan', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(527, 1, 'Ramna', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(528, 1, 'Rampura', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(529, 1, 'Rupnagar', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(530, 1, 'Sabujbag', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(531, 1, 'Savar', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(532, 1, 'Shah Ali', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(533, 1, 'Shahbag', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(534, 1, 'Shahjahanpur', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(535, 1, 'Sherebanglanagar', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(536, 1, 'Shyampur', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(537, 1, 'Sutrapur', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(538, 1, 'Tejgaon', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(539, 1, 'Tejgaon I/A', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(540, 1, 'Turag', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(541, 1, 'Uttara', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(542, 1, 'Uttara West', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(543, 1, 'Uttarkhan', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(544, 1, 'Vatara', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(545, 1, 'Wari', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(546, 1, 'Others', '', NULL, '2016-04-05 23:00:33', NULL, '0000-00-00 00:00:00', NULL, NULL),
(547, 35, 'Airport', 'à¦à§Ÿà¦¾à¦°à¦ªà§‹à¦°à§à¦Ÿ', NULL, '2016-04-05 23:23:08', NULL, '0000-00-00 00:00:00', NULL, NULL),
(548, 35, 'Kawnia', 'à¦•à¦¾à¦‰à¦¨à¦¿à§Ÿà¦¾', NULL, '2016-04-05 23:24:40', NULL, '0000-00-00 00:00:00', NULL, NULL),
(549, 35, 'Bondor', 'à¦¬à¦¨à§à¦¦à¦°', NULL, '2016-04-05 23:27:19', NULL, '0000-00-00 00:00:00', NULL, NULL),
(550, 35, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', NULL, '2016-04-05 23:28:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(551, 24, 'Boalia', 'à¦¬à§‹à¦¯à¦¼à¦¾à¦²à¦¿à¦¯à¦¼à¦¾', NULL, '2016-04-05 23:32:13', NULL, '0000-00-00 00:00:00', NULL, NULL),
(552, 24, 'Motihar', 'à¦®à¦¤à¦¿à¦¹à¦¾à¦°', NULL, '2016-04-05 23:33:00', NULL, '0000-00-00 00:00:00', NULL, NULL),
(553, 24, 'Shahmokhdum', 'à¦¶à¦¾à¦¹à§ à¦®à¦•à¦–à¦¦à§à¦® ', NULL, '2016-04-05 23:36:15', NULL, '0000-00-00 00:00:00', NULL, NULL),
(554, 24, 'Rajpara', 'à¦°à¦¾à¦œà¦ªà¦¾à¦°à¦¾ ', NULL, '2016-04-05 23:38:32', NULL, '0000-00-00 00:00:00', NULL, NULL),
(555, 24, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', NULL, '2016-04-05 23:39:09', NULL, '0000-00-00 00:00:00', NULL, NULL),
(556, 43, 'Akborsha', 'Akborsha', NULL, '2016-04-05 23:57:01', NULL, '0000-00-00 00:00:00', NULL, NULL),
(557, 43, 'Baijid bostami', 'à¦¬à¦¾à¦‡à¦œà¦¿à¦¦ à¦¬à§‹à¦¸à§à¦¤à¦¾à¦®à§€', NULL, '2016-04-06 00:09:38', NULL, '0000-00-00 00:00:00', NULL, NULL),
(558, 43, 'Bakolia', 'à¦¬à¦¾à¦•à§‹à¦²à¦¿à§Ÿà¦¾', NULL, '2016-04-06 00:10:52', NULL, '0000-00-00 00:00:00', NULL, NULL),
(559, 43, 'Bandar', 'à¦¬à¦¨à§à¦¦à¦°', NULL, '2016-04-06 00:11:53', NULL, '0000-00-00 00:00:00', NULL, NULL),
(560, 43, 'Chandgaon', 'à¦šà¦¾à¦à¦¦à¦—à¦¾à¦“', NULL, '2016-04-06 00:12:34', NULL, '0000-00-00 00:00:00', NULL, NULL),
(561, 43, 'Chokbazar', 'à¦šà¦•à¦¬à¦¾à¦œà¦¾à¦°', NULL, '2016-04-06 00:13:10', NULL, '0000-00-00 00:00:00', NULL, NULL),
(562, 43, 'Doublemooring', 'à¦¡à¦¾à¦¬à¦² à¦®à§à¦°à¦¿à¦‚', NULL, '2016-04-06 00:14:10', NULL, '0000-00-00 00:00:00', NULL, NULL),
(563, 43, 'EPZ', 'à¦‡à¦ªà¦¿à¦œà§‡à¦¡', NULL, '2016-04-06 00:14:55', NULL, '0000-00-00 00:00:00', NULL, NULL),
(564, 43, 'Hali Shohor', 'à¦¹à¦²à§€ à¦¶à¦¹à¦°', NULL, '2016-04-06 00:15:54', NULL, '0000-00-00 00:00:00', NULL, NULL),
(565, 43, 'Kornafuli', 'à¦•à¦°à§à¦£à¦«à§à¦²à¦¿', NULL, '2016-04-06 00:16:29', NULL, '0000-00-00 00:00:00', NULL, NULL),
(566, 43, 'Kotwali', 'à¦•à§‹à¦¤à§‹à¦¯à¦¼à¦¾à¦²à§€', NULL, '2016-04-06 00:17:08', NULL, '0000-00-00 00:00:00', NULL, NULL),
(567, 43, 'Kulshi', 'à¦•à§à¦²à¦¶à¦¿', NULL, '2016-04-06 00:18:09', NULL, '0000-00-00 00:00:00', NULL, NULL),
(568, 43, 'Pahartali', 'à¦ªà¦¾à¦¹à¦¾à¦¡à¦¼à¦¤à¦²à§€', NULL, '2016-04-06 00:19:26', NULL, '0000-00-00 00:00:00', NULL, NULL),
(569, 43, 'Panchlaish', 'à¦ªà¦¾à¦à¦šà¦²à¦¾à¦‡à¦¶', NULL, '2016-04-06 00:20:24', NULL, '0000-00-00 00:00:00', NULL, NULL),
(570, 43, 'Potenga', 'à¦ªà¦¤à§‡à¦™à§à¦—à¦¾', NULL, '2016-04-06 00:21:20', NULL, '0000-00-00 00:00:00', NULL, NULL),
(571, 43, 'Shodhorgat', 'à¦¸à¦¦à¦°à¦˜à¦¾à¦Ÿ', NULL, '2016-04-06 00:22:19', NULL, '0000-00-00 00:00:00', NULL, NULL),
(572, 43, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', NULL, '2016-04-06 00:22:51', NULL, '0000-00-00 00:00:00', NULL, NULL),
(573, 44, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', NULL, '2016-04-06 00:37:59', NULL, '0000-00-00 00:00:00', NULL, NULL),
(574, 59, 'Aranghata', 'à¦†à¦¡à¦¼à¦¾à¦‚à¦˜à¦¾à¦Ÿà¦¾', NULL, '2016-04-06 01:30:50', NULL, '0000-00-00 00:00:00', NULL, NULL),
(575, 59, 'Daulatpur', 'à¦¦à§Œà¦²à¦¤à¦ªà§à¦°', NULL, '2016-04-06 01:32:12', NULL, '0000-00-00 00:00:00', NULL, NULL),
(576, 59, 'Harintana', 'à¦¹à¦¾à¦°à¦¿à¦¨à§à¦¤à¦¾à¦¨à¦¾ ', NULL, '2016-04-06 01:34:06', NULL, '0000-00-00 00:00:00', NULL, NULL),
(577, 59, 'Horintana', 'à¦¹à¦°à¦¿à¦£à¦¤à¦¾à¦¨à¦¾ ', NULL, '2016-04-06 01:35:11', NULL, '0000-00-00 00:00:00', NULL, NULL),
(578, 59, 'Khalishpur', 'à¦–à¦¾à¦²à¦¿à¦¶à¦ªà§à¦°', NULL, '2016-04-06 01:35:56', NULL, '0000-00-00 00:00:00', NULL, NULL),
(579, 59, 'Khanjahan Ali', 'à¦–à¦¾à¦¨à¦œà¦¾à¦¹à¦¾à¦¨ à¦†à¦²à§€', NULL, '2016-04-06 01:37:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(580, 59, 'Khulna Sadar', 'à¦–à§à¦²à¦¨à¦¾ à¦¸à¦¦à¦°', NULL, '2016-04-06 01:37:58', NULL, '0000-00-00 00:00:00', NULL, NULL),
(581, 59, 'Labanchora', 'à¦²à¦¾à¦¬à¦¾à¦¨à¦›à§‹à¦°à¦¾', NULL, '2016-04-06 01:39:23', NULL, '0000-00-00 00:00:00', NULL, NULL),
(582, 59, 'Sonadanga', 'à¦¸à§‹à¦¨à¦¾à¦¡à¦¾à¦™à§à¦—à¦¾', NULL, '2016-04-06 01:40:22', NULL, '0000-00-00 00:00:00', NULL, NULL),
(583, 59, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', NULL, '2016-04-06 01:42:14', NULL, '0000-00-00 00:00:00', NULL, NULL),
(584, 2, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', NULL, '2016-04-06 01:43:56', NULL, '0000-00-00 00:00:00', NULL, NULL),
(585, 4, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', NULL, '2016-04-06 01:45:07', NULL, '0000-00-00 00:00:00', NULL, NULL),
(586, 5, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', NULL, '2016-04-06 01:46:18', NULL, '0000-00-00 00:00:00', NULL, NULL),
(587, 54, 'Airport', 'à¦¬à¦¿à¦®à¦¾à¦¨à¦¬à¦¨à§à¦¦à¦°', NULL, '2016-04-06 01:54:47', NULL, '0000-00-00 00:00:00', NULL, NULL),
(588, 54, 'Hazrat Shah Paran', 'à¦¹à¦¯à¦°à¦¤ à¦¶à¦¾à¦¹ à¦ªà¦°à¦¾à¦£', NULL, '2016-04-06 01:57:13', NULL, '0000-00-00 00:00:00', NULL, NULL),
(589, 54, 'Jalalabad', 'à¦œà¦¾à¦²à¦¾à¦²à¦¾à¦¬à¦¾à¦¦', NULL, '2016-04-06 01:58:15', NULL, '0000-00-00 00:00:00', NULL, NULL),
(590, 54, 'Kowtali', 'à¦•à§‹à¦¤à§‹à¦¯à¦¼à¦¾à¦²à§€', NULL, '2016-04-06 01:59:27', NULL, '0000-00-00 00:00:00', NULL, NULL),
(591, 54, 'Moglabazar', 'à¦®à§‹à¦—à¦²à¦¾à¦¬à¦¾à¦œà¦¾à¦°', NULL, '2016-04-06 02:00:58', NULL, '0000-00-00 00:00:00', NULL, NULL),
(592, 54, 'Osmani Nagar', 'à¦“à¦¸à¦®à¦¾à¦¨à§€ à¦¨à¦—à¦°', NULL, '2016-04-06 02:01:36', NULL, '0000-00-00 00:00:00', NULL, NULL),
(593, 54, 'South Surma', 'à¦¦à¦•à§à¦·à¦¿à¦£ à¦¸à§à¦°à¦®à¦¾', NULL, '2016-04-06 02:02:16', NULL, '0000-00-00 00:00:00', NULL, NULL),
(594, 54, 'Others', 'à¦…à¦¨à§à¦¯à¦¾à¦¨à§à¦¯', NULL, '2016-04-06 02:03:07', NULL, '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssc_upazilas_180520`
--

CREATE TABLE `ssc_upazilas_180520` (
  `UPAZILA_ID` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `DISTRICT_ID` int(4) UNSIGNED NOT NULL,
  `UPAZILA_NAME` varchar(30) CHARACTER SET latin1 NOT NULL,
  `UPAZILA_NAME_BN` varchar(50) CHARACTER SET latin1 NOT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ssc_upazilas_180520`
--

INSERT INTO `ssc_upazilas_180520` (`UPAZILA_ID`, `DISTRICT_ID`, `UPAZILA_NAME`, `UPAZILA_NAME_BN`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`) VALUES
(1, 34, 'Amtali Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(2, 34, 'Bamna Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(3, 34, 'Barguna Sadar Upazila', '?????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(4, 34, 'Betagi Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(5, 34, 'Patharghata Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(6, 34, 'Taltali Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(7, 35, 'Muladi Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(8, 35, 'Babuganj Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(9, 35, 'Agailjhara Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(10, 35, 'Barisal Sadar Upazila', '?????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(11, 35, 'Bakerganj Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(12, 35, 'Banaripara Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(13, 35, 'Gaurnadi Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(14, 35, 'Hizla Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(15, 35, 'Mehendiganj Upazila', '?????????? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(16, 35, 'Wazirpur Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(17, 36, 'Bhola Sadar Upazila', '???? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(18, 36, 'Burhanuddin Upazila', '????????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(19, 36, 'Char Fasson Upazila', '?? ??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(20, 36, 'Daulatkhan Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(21, 36, 'Lalmohan Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(22, 36, 'Manpura Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(23, 36, 'Tazumuddin Upazila', '???????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(24, 37, 'Jhalokati Sadar Upazila', '??????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(25, 37, 'Kathalia Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(26, 37, 'Nalchity Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(27, 37, 'Rajapur Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(28, 38, 'Bauphal Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(29, 38, 'Dashmina Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(30, 38, 'Galachipa Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(31, 38, 'Kalapara Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(32, 38, 'Mirzaganj Upazila', '?????????? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(33, 38, 'Patuakhali Sadar Upazila', '????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(34, 38, 'Dumki Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(35, 38, 'Rangabali Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(36, 39, 'Bhandaria', '????????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(37, 39, 'Kaukhali', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(38, 39, 'Mathbaria', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(39, 39, 'Nazirpur', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(40, 39, 'Nesarabad', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(41, 39, 'Pirojpur Sadar', '???????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(42, 39, 'Zianagar', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(43, 40, 'Bandarban Sadar', '???????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(44, 40, 'Thanchi', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(45, 40, 'Lama', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(46, 40, 'Naikhongchhari', '???????? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(47, 40, 'Ali kadam', '??? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(48, 40, 'Rowangchhari', '???????? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(49, 40, 'Ruma', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(50, 41, 'Brahmanbaria Sadar Upazila', '?????????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(51, 41, 'Ashuganj Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(52, 41, 'Nasirnagar Upazila', '????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(53, 41, 'Nabinagar Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(54, 41, 'Sarail Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(55, 41, 'Shahbazpur Town', '????????? ????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(56, 41, 'Kasba Upazila', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(57, 41, 'Akhaura Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(58, 41, 'Bancharampur Upazila', '????????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(59, 41, 'Bijoynagar Upazila', '???? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(60, 42, 'Chandpur Sadar', '??????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(61, 42, 'Faridganj', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(62, 42, 'Haimchar', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(63, 42, 'Haziganj', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(64, 42, 'Kachua', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(65, 42, 'Matlab Uttar', '???? ?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(66, 42, 'Matlab Dakkhin', '???? ??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(67, 42, 'Shahrasti', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(68, 43, 'Anwara Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(69, 43, 'Banshkhali Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(70, 43, 'Boalkhali Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(71, 43, 'Chandanaish Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(72, 43, 'Fatikchhari Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(73, 43, 'Hathazari Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(74, 43, 'Lohagara Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(75, 43, 'Mirsharai Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(76, 43, 'Patiya Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(77, 43, 'Rangunia Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(78, 43, 'Raozan Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(79, 43, 'Sandwip Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(80, 43, 'Satkania Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(81, 43, 'Sitakunda Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(82, 44, 'Barura Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(83, 44, 'Brahmanpara Upazila', '????????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(84, 44, 'Burichong Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(85, 44, 'Chandina Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(86, 44, 'Chauddagram Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(87, 44, 'Daudkandi Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(88, 44, 'Debidwar Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(89, 44, 'Homna Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(90, 44, 'Comilla Sadar Upazila', '???????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(91, 44, 'Laksam Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(92, 44, 'Monohorgonj Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(93, 44, 'Meghna Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(94, 44, 'Muradnagar Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(95, 44, 'Nangalkot Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(96, 44, 'Comilla Sadar South Upazila', '???????? ??? ??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(97, 44, 'Titas Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(98, 45, 'Chakaria Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(100, 45, 'Cox\'s Bazar Sadar Upazila', '???? ????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(101, 45, 'Kutubdia Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(102, 45, 'Maheshkhali Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(103, 45, 'Ramu Upazila', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(104, 45, 'Teknaf Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(105, 45, 'Ukhia Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(106, 45, 'Pekua Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(107, 46, 'Feni Sadar', '???? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(108, 46, 'Chagalnaiya', '???? ?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(109, 46, 'Daganbhyan', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(110, 46, 'Parshuram', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(111, 46, 'Fhulgazi', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(112, 46, 'Sonagazi', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(113, 47, 'Dighinala Upazila', '???????? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(114, 47, 'Khagrachhari Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(115, 47, 'Lakshmichhari Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(116, 47, 'Mahalchhari Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(117, 47, 'Manikchhari Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(118, 47, 'Matiranga Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(119, 47, 'Panchhari Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(120, 47, 'Ramgarh Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(121, 48, 'Lakshmipur Sadar Upazila', '?????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(122, 48, 'Raipur Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(123, 48, 'Ramganj Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(124, 48, 'Ramgati Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(125, 48, 'Komol Nagar Upazila', '??? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(126, 49, 'Noakhali Sadar Upazila', '???????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(127, 49, 'Begumganj Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(128, 49, 'Chatkhil Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(129, 49, 'Companyganj Upazila', '????????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(130, 49, 'Shenbag Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(131, 49, 'Hatia Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(132, 49, 'Kobirhat Upazila', '??????? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(133, 49, 'Sonaimuri Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(134, 49, 'Suborno Char Upazila', '?????? ?? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(135, 50, 'Rangamati Sadar Upazila', '?????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(136, 50, 'Belaichhari Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(137, 50, 'Bagaichhari Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(138, 50, 'Barkal Upazila', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(139, 50, 'Juraichhari Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(140, 50, 'Rajasthali Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(141, 50, 'Kaptai Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(142, 50, 'Langadu Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(143, 50, 'Nannerchar Upazila', '????????? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(144, 50, 'Kaukhali Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(145, 1, 'Dhamrai Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(146, 1, 'Dohar Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(147, 1, 'Keraniganj Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(148, 1, 'Nawabganj Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(149, 1, 'Savar Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(150, 2, 'Faridpur Sadar Upazila', '??????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(151, 2, 'Boalmari Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(152, 2, 'Alfadanga Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(153, 2, 'Madhukhali Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(154, 2, 'Bhanga Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(155, 2, 'Nagarkanda Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(156, 2, 'Charbhadrasan Upazila', '????????? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(157, 2, 'Sadarpur Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(158, 2, 'Shaltha Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(159, 3, 'Gazipur Sadar-Joydebpur', '??????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(160, 3, 'Kaliakior', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(161, 3, 'Kapasia', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(162, 3, 'Sripur', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(163, 3, 'Kaliganj', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(164, 3, 'Tongi', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(165, 4, 'Gopalganj Sadar Upazila', '????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(166, 4, 'Kashiani Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(167, 4, 'Kotalipara Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(168, 4, 'Muksudpur Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(169, 4, 'Tungipara Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(170, 5, 'Dewanganj Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(171, 5, 'Baksiganj Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(172, 5, 'Islampur Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(173, 5, 'Jamalpur Sadar Upazila', '???????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(174, 5, 'Madarganj Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(175, 5, 'Melandaha Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(176, 5, 'Sarishabari Upazila', '????????? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(177, 5, 'Narundi Police I.C', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(178, 6, 'Astagram Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(179, 6, 'Bajitpur Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(180, 6, 'Bhairab Upazila', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(181, 6, 'Hossainpur Upazila', '???????? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(182, 6, 'Itna Upazila', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(183, 6, 'Karimganj Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(184, 6, 'Katiadi Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(185, 6, 'Kishoreganj Sadar Upazila', '????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(186, 6, 'Kuliarchar Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(187, 6, 'Mithamain Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(188, 6, 'Nikli Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(189, 6, 'Pakundia Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(190, 6, 'Tarail Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(191, 7, 'Madaripur Sadar', '????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(192, 7, 'Kalkini', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(193, 7, 'Rajoir', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(194, 7, 'Shibchar', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(195, 8, 'Manikganj Sadar Upazila', '????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(196, 8, 'Singair Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(197, 8, 'Shibalaya Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(198, 8, 'Saturia Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(199, 8, 'Harirampur Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(200, 8, 'Ghior Upazila', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(201, 8, 'Daulatpur Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(202, 9, 'Lohajang Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(203, 9, 'Sreenagar Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(204, 9, 'Munshiganj Sadar Upazila', '?????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(205, 9, 'Sirajdikhan Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(206, 9, 'Tongibari Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(207, 9, 'Gazaria Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(208, 10, 'Bhaluka', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(209, 10, 'Trishal', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(210, 10, 'Haluaghat', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(211, 10, 'Muktagachha', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(212, 10, 'Dhobaura', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(213, 10, 'Fulbaria', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(214, 10, 'Gaffargaon', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(215, 10, 'Gauripur', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(216, 10, 'Ishwarganj', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(217, 10, 'Mymensingh Sadar', '??????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(218, 10, 'Nandail', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(219, 10, 'Phulpur', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(220, 11, 'Araihazar Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(221, 11, 'Sonargaon Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(222, 11, 'Bandar', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(223, 11, 'Naryanganj Sadar Upazila', '??????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(224, 11, 'Rupganj Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(225, 11, 'Siddirgonj Upazila', '???????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(226, 12, 'Belabo Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(227, 12, 'Monohardi Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(228, 12, 'Narsingdi Sadar Upazila', '??????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(229, 12, 'Palash Upazila', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(230, 12, 'Raipura Upazila, Narsingdi', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(231, 12, 'Shibpur Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(232, 13, 'Kendua Upazilla', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(233, 13, 'Atpara Upazilla', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(234, 13, 'Barhatta Upazilla', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(235, 13, 'Durgapur Upazilla', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(236, 13, 'Kalmakanda Upazilla', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(237, 13, 'Madan Upazilla', '???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(238, 13, 'Mohanganj Upazilla', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(239, 13, 'Netrakona-S Upazilla', '????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(240, 13, 'Purbadhala Upazilla', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(241, 13, 'Khaliajuri Upazilla', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(242, 14, 'Baliakandi Upazila', '????????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(243, 14, 'Goalandaghat Upazila', '???????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(244, 14, 'Pangsha Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(245, 14, 'Kalukhali Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(246, 14, 'Rajbari Sadar Upazila', '??????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(247, 15, 'Shariatpur Sadar -Palong', '???????? ??? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(248, 15, 'Damudya Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(249, 15, 'Naria Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(250, 15, 'Jajira Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(251, 15, 'Bhedarganj Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(252, 15, 'Gosairhat Upazila', '?????? ??? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(253, 16, 'Jhenaigati Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(254, 16, 'Nakla Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(255, 16, 'Nalitabari Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(256, 16, 'Sherpur Sadar Upazila', '?????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(257, 16, 'Sreebardi Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(258, 17, 'Tangail Sadar Upazila', '???????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(259, 17, 'Sakhipur Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(260, 17, 'Basail Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(261, 17, 'Madhupur Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(262, 17, 'Ghatail Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(263, 17, 'Kalihati Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(264, 17, 'Nagarpur Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(265, 17, 'Mirzapur Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(266, 17, 'Gopalpur Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(267, 17, 'Delduar Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(268, 17, 'Bhuapur Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(269, 17, 'Dhanbari Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(270, 55, 'Bagerhat Sadar Upazila', '???????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(271, 55, 'Chitalmari Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(272, 55, 'Fakirhat Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(273, 55, 'Kachua Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(274, 55, 'Mollahat Upazila', '????????? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(275, 55, 'Mongla Upazila', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(276, 55, 'Morrelganj Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(277, 55, 'Rampal Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(278, 55, 'Sarankhola Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(279, 56, 'Damurhuda Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(280, 56, 'Chuadanga-S Upazila', '?????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(281, 56, 'Jibannagar Upazila', '???? ??? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(282, 56, 'Alamdanga Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(283, 57, 'Abhaynagar Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(284, 57, 'Keshabpur Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(285, 57, 'Bagherpara Upazila', '????? ???? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(286, 57, 'Jessore Sadar Upazila', '???? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(287, 57, 'Chaugachha Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(288, 57, 'Manirampur Upazila', '????????? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(289, 57, 'Jhikargachha Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(290, 57, 'Sharsha Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(291, 58, 'Jhenaidah Sadar Upazila', '??????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(292, 58, 'Maheshpur Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(293, 58, 'Kaliganj Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(294, 58, 'Kotchandpur Upazila', '??? ??????? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(295, 58, 'Shailkupa Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(296, 58, 'Harinakunda Upazila', '????????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(297, 59, 'Terokhada Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(298, 59, 'Batiaghata Upazila', '?????????? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(299, 59, 'Dacope Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(300, 59, 'Dumuria Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(301, 59, 'Dighalia Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(302, 59, 'Koyra Upazila', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(303, 59, 'Paikgachha Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(304, 59, 'Phultala Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(305, 59, 'Rupsa Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(306, 60, 'Kushtia Sadar', '???????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(307, 60, 'Kumarkhali', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(308, 60, 'Daulatpur', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(309, 60, 'Mirpur', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(310, 60, 'Bheramara', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(311, 60, 'Khoksa', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(312, 61, 'Magura Sadar Upazila', '?????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(313, 61, 'Mohammadpur Upazila', '????????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(314, 61, 'Shalikha Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(315, 61, 'Sreepur Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(316, 62, 'angni Upazila', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(317, 62, 'Mujib Nagar Upazila', '????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(318, 62, 'Meherpur-S Upazila', '???????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(319, 63, 'Narail-S Upazilla', '????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(320, 63, 'Lohagara Upazilla', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(321, 63, 'Kalia Upazilla', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(322, 64, 'Satkhira Sadar Upazila', '????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(323, 64, 'Assasuni Upazila', '???????? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(324, 64, 'Debhata Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(325, 64, 'Tala Upazila', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(326, 64, 'Kalaroa Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(327, 64, 'Kaliganj Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(328, 64, 'Shyamnagar Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(329, 18, 'Adamdighi', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(330, 18, 'Bogra Sadar', '????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(331, 18, 'Sherpur', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(332, 18, 'Dhunat', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(333, 18, 'Dhupchanchia', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(334, 18, 'Gabtali', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(335, 18, 'Kahaloo', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(336, 18, 'Nandigram', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(337, 18, 'Sahajanpur', '???????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(338, 18, 'Sariakandi', '????????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(339, 18, 'Shibganj', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(340, 18, 'Sonatala', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(341, 19, 'Joypurhat S', '???????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(342, 19, 'Akkelpur', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(343, 19, 'Kalai', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(344, 19, 'Khetlal', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(345, 19, 'Panchbibi', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(346, 20, 'Naogaon Sadar Upazila', '????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(347, 20, 'Mohadevpur Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(348, 20, 'Manda Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(349, 20, 'Niamatpur Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(350, 20, 'Atrai Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(351, 20, 'Raninagar Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(352, 20, 'Patnitala Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(353, 20, 'Dhamoirhat Upazila', '???????? ', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(354, 20, 'Sapahar Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(355, 20, 'Porsha Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(356, 20, 'Badalgachhi Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(357, 21, 'Natore Sadar Upazila', '????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(358, 21, 'Baraigram Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(359, 21, 'Bagatipara Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(360, 21, 'Lalpur Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(361, 21, 'Natore Sadar Upazila', '????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(362, 21, 'Baraigram Upazila', '???? ?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(363, 22, 'Bholahat Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(364, 22, 'Gomastapur Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(365, 22, 'Nachole Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(366, 22, 'Nawabganj Sadar Upazila', '???????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(367, 22, 'Shibganj Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(368, 23, 'Atgharia Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(369, 23, 'Bera Upazila', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(370, 23, 'Bhangura Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(371, 23, 'Chatmohar Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(372, 23, 'Faridpur Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(373, 23, 'Ishwardi Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(374, 23, 'Pabna Sadar Upazila', '????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(375, 23, 'Santhia Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(376, 23, 'Sujanagar Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(377, 24, 'Bagha', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(378, 24, 'Bagmara', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(379, 24, 'Charghat', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(380, 24, 'Durgapur', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(381, 24, 'Godagari', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(382, 24, 'Mohanpur', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(383, 24, 'Paba', '???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(384, 24, 'Puthia', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(385, 24, 'Tanore', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(386, 25, 'Sirajganj Sadar Upazila', '????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(387, 25, 'Belkuchi Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(388, 25, 'Chauhali Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(389, 25, 'Kamarkhanda Upazila', '???????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(390, 25, 'Kazipur Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(391, 25, 'Raiganj Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(392, 25, 'Shahjadpur Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(393, 25, 'Tarash Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(394, 25, 'Ullahpara Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(395, 26, 'Birampur Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(396, 26, 'Birganj', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(397, 26, 'Biral Upazila', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(398, 26, 'Bochaganj Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(399, 26, 'Chirirbandar Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(400, 26, 'Phulbari Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(401, 26, 'Ghoraghat Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(402, 26, 'Hakimpur Upazila', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(403, 26, 'Kaharole Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(404, 26, 'Khansama Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(405, 26, 'Dinajpur Sadar Upazila', '???????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(406, 26, 'Nawabganj', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(407, 26, 'Parbatipur Upazila', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(408, 27, 'Fulchhari', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(409, 27, 'Gaibandha sadar', '????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(410, 27, 'Gobindaganj', '???????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(411, 27, 'Palashbari', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(412, 27, 'Sadullapur', '???????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(413, 27, 'Saghata', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(414, 27, 'Sundarganj', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(415, 28, 'Kurigram Sadar', '????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(416, 28, 'Nageshwari', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(417, 28, 'Bhurungamari', '????????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(418, 28, 'Phulbari', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(419, 28, 'Rajarhat', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(420, 28, 'Ulipur', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(421, 28, 'Chilmari', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(422, 28, 'Rowmari', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(423, 28, 'Char Rajibpur', '?? ????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(424, 29, 'Lalmanirhat Sadar', '?????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(425, 29, 'Aditmari', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(426, 29, 'Kaliganj', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(427, 29, 'Hatibandha', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(428, 29, 'Patgram', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(429, 30, 'Nilphamari Sadar', '????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(430, 30, 'Saidpur', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(431, 30, 'Jaldhaka', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(432, 30, 'Kishoreganj', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(433, 30, 'Domar', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(434, 30, 'Dimla', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(435, 31, 'Panchagarh Sadar', '?????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(436, 31, 'Debiganj', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(437, 31, 'Boda', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(438, 31, 'Atwari', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(439, 31, 'Tetulia', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(440, 32, 'Badarganj', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(441, 32, 'Mithapukur', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(442, 32, 'Gangachara', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(443, 32, 'Kaunia', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(444, 32, 'Rangpur Sadar', '????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(445, 32, 'Pirgachha', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(446, 32, 'Pirganj', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(447, 32, 'Taraganj', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(448, 33, 'Thakurgaon Sadar Upazila', '????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(449, 33, 'Pirganj Upazila', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(450, 33, 'Baliadangi Upazila', '????????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(451, 33, 'Haripur Upazila', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(452, 33, 'Ranisankail Upazila', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(453, 51, 'Ajmiriganj', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(454, 51, 'Baniachang', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(455, 51, 'Bahubal', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL);
INSERT INTO `ssc_upazilas_180520` (`UPAZILA_ID`, `DISTRICT_ID`, `UPAZILA_NAME`, `UPAZILA_NAME_BN`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`) VALUES
(456, 51, 'Chunarughat', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(457, 51, 'Habiganj Sadar', '??????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(458, 51, 'Lakhai', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(459, 51, 'Madhabpur', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(460, 51, 'Nabiganj', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(461, 51, 'Shaistagonj Upazila', '????????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(462, 52, 'Moulvibazar Sadar', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(463, 52, 'Barlekha', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(464, 52, 'Juri', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(465, 52, 'Kamalganj', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(466, 52, 'Kulaura', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(467, 52, 'Rajnagar', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(468, 52, 'Sreemangal', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(469, 53, 'Bishwamvarpur', '????????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(470, 53, 'Chhatak', '????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(471, 53, 'Derai', '?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(472, 53, 'Dharampasha', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(473, 53, 'Dowarabazar', '???????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(474, 53, 'Jagannathpur', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(475, 53, 'Jamalganj', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(476, 53, 'Sulla', '??????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(477, 53, 'Sunamganj Sadar', '????????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(478, 53, 'Shanthiganj', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(479, 53, 'Tahirpur', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(480, 54, 'Sylhet Sadar', '????? ???', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(481, 54, 'Beanibazar', '???????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(482, 54, 'Bishwanath', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(483, 54, 'Dakshin Surma Upazila', '?????? ?????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(484, 54, 'Balaganj', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(485, 54, 'Companiganj', '????????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(486, 54, 'Fenchuganj', '??????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(487, 54, 'Golapganj', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(488, 54, 'Gowainghat', '?????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(489, 54, 'Jaintiapur', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(490, 54, 'Kanaighat', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(491, 54, 'Zakiganj', '????????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL),
(492, 54, 'Nobigonj', '???????', NULL, '2019-03-18 03:43:42', NULL, '2019-03-18 03:43:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssm_associationsetup`
--

CREATE TABLE `ssm_associationsetup` (
  `ASSOCIATION_ID` int(11) NOT NULL,
  `ASSOCIATION_NAME` varchar(150) DEFAULT NULL,
  `ASSOCIATION_TYPE` varchar(2) DEFAULT NULL,
  `PARENT_ID` int(11) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ACTIVE_FLG` int(1) NOT NULL,
  `ASSOCIATION_FLG` varchar(2) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `MILL_ID` int(11) DEFAULT NULL,
  `ZONE_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ssm_associationsetup`
--

INSERT INTO `ssm_associationsetup` (`ASSOCIATION_ID`, `ASSOCIATION_NAME`, `ASSOCIATION_TYPE`, `PARENT_ID`, `DESCRIPTION`, `REMARKS`, `ACTIVE_FLG`, `ASSOCIATION_FLG`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `center_id`, `MILL_ID`, `ZONE_ID`) VALUES
(1, 'Organizations', NULL, 0, NULL, NULL, 1, NULL, 1, '2020-02-03 22:05:55', 1, '2020-02-03 16:04:07', NULL, NULL, NULL, NULL, NULL),
(61, 'Islampur Association', NULL, 1, NULL, NULL, 1, NULL, 162, '2019-05-31 23:26:52', NULL, '2019-05-31 23:26:52', NULL, NULL, NULL, NULL, 2),
(475, 'PRAN Iodized Salt', NULL, 61, NULL, NULL, 1, NULL, 204, '2020-11-16 23:27:46', NULL, '2020-11-17 05:27:46', NULL, NULL, 61, 73, NULL),
(476, 'Shahriar Salt Crushing Industries', NULL, 61, NULL, NULL, 1, NULL, 204, '2020-11-19 03:07:28', NULL, '2020-11-19 21:07:28', NULL, NULL, 61, 74, NULL),
(477, 'abcd', NULL, 61, NULL, NULL, 1, NULL, 395, '2020-11-29 05:43:27', NULL, '2020-11-29 11:43:27', NULL, NULL, 61, 75, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssm_bsti_test`
--

CREATE TABLE `ssm_bsti_test` (
  `BSTITEST_ID` int(11) NOT NULL,
  `SODIUM_CHLORIDE` varchar(30) DEFAULT NULL,
  `MOISTURIZER` varchar(30) DEFAULT NULL,
  `PPM` varchar(30) DEFAULT NULL,
  `PH` varchar(30) DEFAULT NULL,
  `water_insoluble_matter` varchar(30) DEFAULT NULL,
  `ACTIVE_FLG` int(1) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `matter_soluble_sc` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ssm_bsti_test`
--

INSERT INTO `ssm_bsti_test` (`BSTITEST_ID`, `SODIUM_CHLORIDE`, `MOISTURIZER`, `PPM`, `PH`, `water_insoluble_matter`, `ACTIVE_FLG`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `center_id`, `matter_soluble_sc`) VALUES
(1, '97.0', '6.0', '20.0 to 50.0', '6.4 to 7.4', '0.1', 1, 200, '2020-10-05 07:13:11', 200, '2020-10-05 01:07:46', NULL, NULL, 0, '3.0');

-- --------------------------------------------------------

--
-- Table structure for table `ssm_bsti_test_resutl_range`
--

CREATE TABLE `ssm_bsti_test_resutl_range` (
  `BSTITEST_RESULT_ID` int(11) NOT NULL,
  `SODIUM_CHLORIDE_MIN` float DEFAULT NULL,
  `SODIUM_CHLORIDE_MAX` float DEFAULT NULL,
  `MOISTURIZER_MIN` float DEFAULT NULL,
  `MOISTURIZER_MAX` float DEFAULT NULL,
  `PPM_MIN` float DEFAULT NULL,
  `PPM_MAX` float DEFAULT NULL,
  `PH_MIN` float DEFAULT NULL,
  `PH_MAX` float DEFAULT NULL,
  `WIM_MIN` float DEFAULT NULL,
  `ACTIVE_FLG` int(1) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `center_id` int(11) DEFAULT NULL,
  `WIM_MAX` float DEFAULT NULL,
  `MSWSC_MIN` float DEFAULT NULL,
  `MSWSC_MAX` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ssm_bsti_test_resutl_range`
--

INSERT INTO `ssm_bsti_test_resutl_range` (`BSTITEST_RESULT_ID`, `SODIUM_CHLORIDE_MIN`, `SODIUM_CHLORIDE_MAX`, `MOISTURIZER_MIN`, `MOISTURIZER_MAX`, `PPM_MIN`, `PPM_MAX`, `PH_MIN`, `PH_MAX`, `WIM_MIN`, `ACTIVE_FLG`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `center_id`, `WIM_MAX`, `MSWSC_MIN`, `MSWSC_MAX`) VALUES
(1, 97, 98, 5, 6, 20, 50, 6.4, 7.6, 0.1, 1, 200, '2020-10-05 01:10:01', NULL, '2020-10-05 07:15:27', 0, 0.3, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ssm_certificate_info`
--

CREATE TABLE `ssm_certificate_info` (
  `CERTIFICATE_ID` int(11) NOT NULL,
  `CERTIFICATE_TYPE` int(1) DEFAULT NULL,
  `IS_EXPIRE` int(1) DEFAULT NULL,
  `MILL_ID` int(11) DEFAULT NULL,
  `CERTIFICATE_TYPE_ID` int(11) DEFAULT NULL,
  `ISSURE_ID` varchar(50) DEFAULT NULL,
  `ISSUING_DATE` date DEFAULT NULL,
  `CERTIFICATE_NO` varchar(50) DEFAULT NULL,
  `TRADE_LICENSE` varchar(150) DEFAULT NULL,
  `RENEWING_DATE` date DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `DISTRICT_ID` int(11) DEFAULT NULL,
  `approval_status` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ssm_certificate_info`
--

INSERT INTO `ssm_certificate_info` (`CERTIFICATE_ID`, `CERTIFICATE_TYPE`, `IS_EXPIRE`, `MILL_ID`, `CERTIFICATE_TYPE_ID`, `ISSURE_ID`, `ISSUING_DATE`, `CERTIFICATE_NO`, `TRADE_LICENSE`, `RENEWING_DATE`, `DESCRIPTION`, `REMARKS`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `center_id`, `DISTRICT_ID`, `approval_status`) VALUES
(3, 1, 0, 73, 34, '58', '2020-11-17', '0123657478', 'public/image/user-image/2020-11-170_1605591317.png', '2021-06-30', NULL, 'NA', 204, '2020-11-16 23:35:17', NULL, '2020-11-17 05:35:17', NULL, NULL, 61, NULL, 0),
(4, 1, 0, 73, 31, '56', '2020-11-17', '01236547', 'public/image/user-image/2020-11-171_1605591317.png', '2021-06-30', NULL, 'NA', 204, '2020-11-16 23:35:17', NULL, '2020-11-17 05:35:17', NULL, NULL, 61, NULL, 0),
(5, 1, 0, 73, 39, '60', '2020-11-17', '0123654477', 'public/image/user-image/2020-11-172_1605591317.jpg', '2021-06-30', NULL, 'NA', 204, '2020-11-16 23:35:17', NULL, '2020-11-17 05:35:17', NULL, NULL, 61, NULL, 0),
(6, 1, 0, 74, 34, '58', '2020-11-01', 'jjjhhhh', 'public/image/user-image/2020-11-190_1605820359.jpg', '2021-06-30', NULL, NULL, 204, '2020-11-19 03:12:39', NULL, '2020-11-19 21:12:39', NULL, NULL, 61, NULL, 0),
(7, 1, 0, 74, 31, '56', '2020-11-01', 'ijjjh', 'public/image/user-image/2020-11-191_1605820359.jpg', '2021-06-30', NULL, NULL, 204, '2020-11-19 03:12:39', NULL, '2020-11-19 21:12:39', NULL, NULL, 61, NULL, 0),
(8, 1, 0, 74, 39, '60', '2020-11-01', 'jjhh', 'public/image/user-image/2020-11-192_1605820359.jpg', '2021-06-30', NULL, NULL, 204, '2020-11-19 03:12:39', NULL, '2020-11-19 21:12:39', NULL, NULL, 61, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ssm_certificate_map_info`
--

CREATE TABLE `ssm_certificate_map_info` (
  `CERTIFICATE_MAP_ID` int(11) NOT NULL,
  `CERTIFICATE_TYPE_ID` int(11) DEFAULT NULL,
  `ISSURE_ID` int(11) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ssm_coverage_area`
--

CREATE TABLE `ssm_coverage_area` (
  `COVERAGE_ID` int(11) NOT NULL,
  `CUSTOMER_ID` int(11) DEFAULT NULL,
  `COV_DIVISION_ID` int(11) DEFAULT NULL,
  `COV_DISTRICT_ID` int(11) DEFAULT NULL,
  `COV_UPAZILA_ID` int(11) DEFAULT NULL,
  `COV_UNION_ID` int(11) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `center_id` int(11) DEFAULT NULL,
  `COV_THANA_ID` smallint(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ssm_coverage_area`
--

INSERT INTO `ssm_coverage_area` (`COVERAGE_ID`, `CUSTOMER_ID`, `COV_DIVISION_ID`, `COV_DISTRICT_ID`, `COV_UPAZILA_ID`, `COV_UNION_ID`, `DESCRIPTION`, `REMARKS`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `center_id`, `COV_THANA_ID`) VALUES
(1, 1, 3, 1, 495, NULL, NULL, NULL, 394, '2020-11-16 23:50:46', NULL, '2020-11-17 05:50:46', 475, 495),
(2, 2, 3, 1, 494, NULL, NULL, NULL, 394, '2020-11-16 23:52:47', NULL, '2020-11-17 05:52:47', 475, 494);

-- --------------------------------------------------------

--
-- Table structure for table `ssm_crud_salt_details`
--

CREATE TABLE `ssm_crud_salt_details` (
  `CRUDSALTDETAIL_ID` int(11) NOT NULL,
  `CRUDSALT_TYPE_ID` int(11) DEFAULT NULL,
  `SODIUM_CHLORIDE` float DEFAULT NULL,
  `MOISTURIZER` float DEFAULT NULL,
  `PPM` float DEFAULT NULL,
  `PH` float DEFAULT NULL,
  `ACTIVE_FLG` int(1) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `RECEIVEMST_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ssm_customer_info`
--

CREATE TABLE `ssm_customer_info` (
  `CUSTOMER_ID` int(11) NOT NULL,
  `SELLER_TYPE_ID` int(11) DEFAULT NULL,
  `TRADING_NAME` varchar(150) DEFAULT NULL,
  `TRADER_NAME` varchar(150) DEFAULT NULL,
  `SELLER_ID` varchar(20) DEFAULT NULL,
  `LICENCE_NO` varchar(20) DEFAULT NULL,
  `DIVISION_ID` int(11) DEFAULT NULL,
  `DISTRICT_ID` int(11) DEFAULT NULL,
  `UPAZILA_ID` int(11) DEFAULT NULL,
  `UNION_ID` int(11) DEFAULT NULL,
  `BAZAR_NAME` varchar(100) DEFAULT NULL,
  `PHONE` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `COV_DIVISION_ID` int(11) DEFAULT NULL,
  `COV_DISTRICT_ID` int(11) DEFAULT NULL,
  `COV_UPAZILA_ID` int(11) DEFAULT NULL,
  `COV_UNION_ID` int(11) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `THANA_ID` smallint(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ssm_customer_info`
--

INSERT INTO `ssm_customer_info` (`CUSTOMER_ID`, `SELLER_TYPE_ID`, `TRADING_NAME`, `TRADER_NAME`, `SELLER_ID`, `LICENCE_NO`, `DIVISION_ID`, `DISTRICT_ID`, `UPAZILA_ID`, `UNION_ID`, `BAZAR_NAME`, `PHONE`, `EMAIL`, `COV_DIVISION_ID`, `COV_DISTRICT_ID`, `COV_UPAZILA_ID`, `COV_UNION_ID`, `DESCRIPTION`, `REMARKS`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `center_id`, `THANA_ID`) VALUES
(1, 7, 'Mamun Trading', 'Mamun', '0001', '012364789', 3, 1, 495, NULL, 'Dhaka', '01966654785', 'mamun@gmail.com', NULL, NULL, NULL, NULL, NULL, 'NA', 394, '2020-11-16 23:50:46', NULL, '2020-11-17 05:50:46', NULL, NULL, 475, 495),
(2, 8, 'Uttara Trading', 'kanchon', '0002', '0123669745', 3, 1, 494, NULL, 'Dhaka', '01988856321', 'kanchon@gmail.com', NULL, NULL, NULL, NULL, NULL, 'NA', 394, '2020-11-16 23:52:46', NULL, '2020-11-17 05:52:46', NULL, NULL, 475, 494);

-- --------------------------------------------------------

--
-- Table structure for table `ssm_entrepreneur_info`
--

CREATE TABLE `ssm_entrepreneur_info` (
  `ENTREPRENEUR_ID` int(11) NOT NULL,
  `MILL_ID` int(11) DEFAULT NULL,
  `UD_ENTREPRENEUR_ID` varchar(20) DEFAULT NULL,
  `REG_TYPE_ID` int(11) DEFAULT NULL,
  `OWNER_TYPE_ID` int(11) DEFAULT NULL,
  `OWNER_NAME` varchar(150) DEFAULT NULL,
  `DIVISION_ID` int(11) DEFAULT NULL,
  `DISTRICT_ID` int(11) DEFAULT NULL,
  `UPAZILA_ID` int(11) DEFAULT NULL,
  `UNION_ID` int(11) DEFAULT NULL,
  `NID` bigint(17) NOT NULL,
  `MOBILE_1` varchar(15) DEFAULT NULL,
  `MOBILE_2` varchar(15) DEFAULT NULL,
  `EMAIL` varchar(30) DEFAULT NULL,
  `ACTIVE_FLG` int(1) NOT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `approval_status` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ssm_entrepreneur_info`
--

INSERT INTO `ssm_entrepreneur_info` (`ENTREPRENEUR_ID`, `MILL_ID`, `UD_ENTREPRENEUR_ID`, `REG_TYPE_ID`, `OWNER_TYPE_ID`, `OWNER_NAME`, `DIVISION_ID`, `DISTRICT_ID`, `UPAZILA_ID`, `UNION_ID`, `NID`, `MOBILE_1`, `MOBILE_2`, `EMAIL`, `ACTIVE_FLG`, `DESCRIPTION`, `REMARKS`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `center_id`, `approval_status`) VALUES
(10, 73, NULL, NULL, NULL, 'R N Paul', 3, 1, 495, NULL, 12365479654, '01955565478', NULL, 'rnp@gmail.com', 1, NULL, 'na', 204, '2020-11-16 23:32:32', NULL, '2020-11-17 05:32:32', NULL, NULL, 61, 0),
(11, 74, NULL, NULL, NULL, 'Azad', 2, 45, 100, NULL, 1223, NULL, NULL, NULL, 1, NULL, NULL, 204, '2020-11-19 03:08:26', NULL, '2020-11-19 21:08:26', NULL, NULL, 61, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ssm_millemp_info`
--

CREATE TABLE `ssm_millemp_info` (
  `MILLEMP_ID` int(11) NOT NULL,
  `MILL_ID` int(11) DEFAULT NULL,
  `TOTMALE_EMP` int(5) DEFAULT NULL,
  `TOTFEM_EMP` int(5) DEFAULT NULL,
  `FULLTIMEMALE_EMP` int(5) DEFAULT NULL,
  `FULLTIMEFEM_EMP` int(5) DEFAULT NULL,
  `PARTTIMEMALE_EMP` int(5) DEFAULT NULL,
  `PARTTIMEFEM_EMP` int(5) DEFAULT NULL,
  `TOTMALETECH_PER` int(5) DEFAULT NULL,
  `TOTFEMTECH_PER` int(5) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `FINAL_SUBMIT_FLG` int(2) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `approval_status` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ssm_millemp_info`
--

INSERT INTO `ssm_millemp_info` (`MILLEMP_ID`, `MILL_ID`, `TOTMALE_EMP`, `TOTFEM_EMP`, `FULLTIMEMALE_EMP`, `FULLTIMEFEM_EMP`, `PARTTIMEMALE_EMP`, `PARTTIMEFEM_EMP`, `TOTMALETECH_PER`, `TOTFEMTECH_PER`, `DESCRIPTION`, `REMARKS`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `FINAL_SUBMIT_FLG`, `center_id`, `approval_status`) VALUES
(5, 72, 57, 53, 22, 20, 20, 21, 15, 12, NULL, NULL, 204, '2020-10-24 22:16:03', NULL, '2020-10-25 04:16:03', NULL, NULL, 1, 61, 0),
(6, 72, 57, 53, 22, 20, 20, 21, 15, 12, NULL, NULL, 204, '2020-10-24 22:16:37', NULL, '2020-10-25 04:16:41', NULL, NULL, 1, 61, 0),
(7, 73, 27, 5, 20, 5, 5, 0, 2, 0, NULL, 'NA', 204, '2020-11-16 23:36:17', NULL, '2020-11-17 05:36:17', NULL, NULL, 1, 61, 0),
(8, 74, 14, 14, 10, 10, 2, 2, 2, 2, NULL, 'Test', 204, '2020-11-19 03:13:37', NULL, '2020-11-19 21:13:37', NULL, NULL, 1, 61, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ssm_mill_info`
--

CREATE TABLE `ssm_mill_info` (
  `MILL_ID` int(11) NOT NULL,
  `UD_MILL_ID` int(11) DEFAULT NULL,
  `MILL_NAME` varchar(200) DEFAULT NULL,
  `PROCESS_TYPE_ID` int(11) DEFAULT NULL,
  `MILL_TYPE_ID` int(11) DEFAULT NULL,
  `CAPACITY_ID` varchar(50) DEFAULT NULL,
  `ZONE_ID` int(11) DEFAULT NULL,
  `MILLERS_ID` varchar(20) DEFAULT NULL,
  `DIVISION_ID` int(11) DEFAULT NULL,
  `DISTRICT_ID` int(11) DEFAULT NULL,
  `UPAZILA_ID` int(11) DEFAULT NULL,
  `UNION_ID` int(11) DEFAULT NULL,
  `FINAL_SUBMIT_FLG` int(1) NOT NULL DEFAULT 1,
  `ACTIVE_FLG` int(1) NOT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `REG_TYPE_ID` int(11) DEFAULT NULL,
  `OWNER_TYPE_ID` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `mill_logo` varchar(250) DEFAULT NULL,
  `approval_status` int(2) DEFAULT 0 COMMENT '0 for no approval request, 1 for pending approval request',
  `approval_comments` varchar(200) DEFAULT NULL,
  `extend_date` date DEFAULT NULL,
  `extend_days` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ssm_mill_info`
--

INSERT INTO `ssm_mill_info` (`MILL_ID`, `UD_MILL_ID`, `MILL_NAME`, `PROCESS_TYPE_ID`, `MILL_TYPE_ID`, `CAPACITY_ID`, `ZONE_ID`, `MILLERS_ID`, `DIVISION_ID`, `DISTRICT_ID`, `UPAZILA_ID`, `UNION_ID`, `FINAL_SUBMIT_FLG`, `ACTIVE_FLG`, `DESCRIPTION`, `REMARKS`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `REG_TYPE_ID`, `OWNER_TYPE_ID`, `center_id`, `mill_logo`, `approval_status`, `approval_comments`, `extend_date`, `extend_days`) VALUES
(73, NULL, 'PRAN Iodized Salt', 18, 21, '50000', 1, '21-001-87288', 3, 1, 495, NULL, 1, 1, NULL, 'NA', 204, '2020-11-16 23:27:46', NULL, '2020-11-17 05:27:46', NULL, NULL, 10, 12, 61, 'public/image/mill-logo/2020-11-17_1605590864.png', 0, NULL, NULL, NULL),
(74, NULL, 'Shahriar Salt Crushing Industries', 15, 21, '10', 2, '21-002-42954', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, 204, '2020-11-19 03:07:28', NULL, '2020-11-19 21:07:28', NULL, NULL, 10, NULL, 61, 'public/image/mill-logo/defaultUserImage.png', 0, NULL, NULL, NULL),
(75, NULL, 'abcd', 15, 19, '10', 6, '19-006-56791', 8, 5, 171, NULL, 1, 1, NULL, NULL, 395, '2020-11-29 05:43:27', NULL, '2020-11-29 11:43:27', NULL, NULL, 10, NULL, 61, 'public/image/mill-logo/defaultUserImage.png', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssm_supplier_info`
--

CREATE TABLE `ssm_supplier_info` (
  `SUPP_ID_AUTO` int(11) NOT NULL,
  `TRADING_NAME` varchar(150) DEFAULT NULL,
  `TRADER_NAME` varchar(150) DEFAULT NULL,
  `SUPPLIER_ID` varchar(20) NOT NULL DEFAULT '',
  `LICENCE_NO` varchar(20) DEFAULT NULL,
  `DIVISION_ID` int(11) DEFAULT NULL,
  `DISTRICT_ID` int(11) DEFAULT NULL,
  `UPAZILA_ID` int(11) DEFAULT NULL,
  `UNION_ID` int(11) DEFAULT NULL,
  `BAZAR_NAME` varchar(100) DEFAULT NULL,
  `PHONE` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `SUPPLIER_TYPE_ID` int(11) DEFAULT NULL,
  `ADDRESS` varchar(60) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `THANA_ID` smallint(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ssm_supplier_info`
--

INSERT INTO `ssm_supplier_info` (`SUPP_ID_AUTO`, `TRADING_NAME`, `TRADER_NAME`, `SUPPLIER_ID`, `LICENCE_NO`, `DIVISION_ID`, `DISTRICT_ID`, `UPAZILA_ID`, `UNION_ID`, `BAZAR_NAME`, `PHONE`, `EMAIL`, `DESCRIPTION`, `REMARKS`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `SUPPLIER_TYPE_ID`, `ADDRESS`, `center_id`, `THANA_ID`) VALUES
(1, 'BSCIC', 'BSCIC', '0001', '32546', 3, 1, 0, NULL, 'n/a', '01934666755', NULL, NULL, 'n/a', 274, '2020-09-17 08:38:40', NULL, '2020-09-17 08:38:40', NULL, NULL, 42, NULL, 0, NULL),
(24, 'Ahmed Traders', 'Kazol Ahmed', '0001', '012365478', 3, 1, 495, NULL, 'Dhaka', '01236564789', 'kazol@gmail.com', NULL, 'NA', 394, '2020-11-16 23:49:10', NULL, '2020-11-17 05:49:10', NULL, NULL, 41, NULL, 475, NULL),
(25, 'Dhaka Chemical Industries', 'shaikat', '0002', '0123654479', 3, 1, 494, NULL, 'Dhaka', '0123654789', 'shaikat@gmail.com', NULL, 'NA', 394, '2020-11-16 23:54:11', NULL, '2020-11-17 05:54:11', NULL, NULL, 41, NULL, 475, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssm_zonesetup`
--

CREATE TABLE `ssm_zonesetup` (
  `ZONE_ID` int(11) NOT NULL,
  `ZONE_NAME` varchar(150) DEFAULT NULL,
  `ZONE_CODE` varchar(20) DEFAULT NULL,
  `ZONE_TYPE` int(2) DEFAULT NULL,
  `PARENT_ID` int(11) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ACTIVE_FLG` int(1) NOT NULL,
  `ZONE_FLG` varchar(2) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ssm_zonesetup`
--

INSERT INTO `ssm_zonesetup` (`ZONE_ID`, `ZONE_NAME`, `ZONE_CODE`, `ZONE_TYPE`, `PARENT_ID`, `DESCRIPTION`, `REMARKS`, `ACTIVE_FLG`, `ZONE_FLG`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`) VALUES
(1, 'Dhaka', '001', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2019-03-30 23:26:52', NULL, '2019-03-30 23:26:52', NULL, NULL),
(2, 'Cox\'s Bazar', '002', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2019-03-30 23:27:14', NULL, '2019-03-30 23:27:14', NULL, NULL),
(3, 'Chittagong ', '003', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-08-16 00:32:27', NULL, '2020-08-16 00:32:27', NULL, NULL),
(4, 'khulna', '004', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-08-15 12:00:00', NULL, '2020-08-15 12:00:00', NULL, NULL),
(5, 'Narayanganj', '005', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-08-16 00:35:48', NULL, '2020-08-16 00:35:48', NULL, NULL),
(6, 'Chandpur', '006', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-08-16 00:35:50', NULL, '2020-08-16 00:35:50', NULL, NULL),
(7, 'Patiya', '007', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-08-16 00:35:52', NULL, '2020-08-16 00:35:52', NULL, NULL),
(8, 'Jhalokati', '008', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-08-16 02:16:14', NULL, '2020-08-16 02:16:14', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustment`
--

CREATE TABLE `stock_adjustment` (
  `stock_id` int(11) NOT NULL,
  `system_wc_stock` float DEFAULT NULL,
  `wc_stock` float DEFAULT NULL,
  `system_iodize_stock` float DEFAULT NULL,
  `iodize_stock` float DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tem_ssm_associationsetup`
--

CREATE TABLE `tem_ssm_associationsetup` (
  `ASSOCIATION_ID_TEM` int(11) NOT NULL,
  `ASSOCIATION_ID` int(11) NOT NULL,
  `ASSOCIATION_NAME` varchar(150) DEFAULT NULL,
  `ASSOCIATION_TYPE` varchar(2) DEFAULT NULL,
  `PARENT_ID` int(11) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ACTIVE_FLG` int(1) NOT NULL,
  `ASSOCIATION_FLG` varchar(2) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `MILL_ID` int(11) DEFAULT NULL,
  `ZONE_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tem_ssm_certificate_info`
--

CREATE TABLE `tem_ssm_certificate_info` (
  `CERTIFICATE_ID_TEM` int(11) NOT NULL,
  `CERTIFICATE_ID` int(11) DEFAULT 0,
  `CERTIFICATE_TYPE` int(1) DEFAULT NULL,
  `IS_EXPIRE` int(1) DEFAULT NULL,
  `MILL_ID` int(11) DEFAULT NULL,
  `CERTIFICATE_TYPE_ID` int(11) DEFAULT NULL,
  `ISSURE_ID` varchar(50) DEFAULT NULL,
  `ISSUING_DATE` date DEFAULT NULL,
  `CERTIFICATE_NO` varchar(50) DEFAULT NULL,
  `TRADE_LICENSE` varchar(150) DEFAULT NULL,
  `RENEWING_DATE` date DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `DISTRICT_ID` int(11) DEFAULT NULL,
  `approval_status` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tem_ssm_entrepreneur_info`
--

CREATE TABLE `tem_ssm_entrepreneur_info` (
  `ENTREPRENEUR_ID_TEM` int(11) NOT NULL,
  `ENTREPRENEUR_ID` int(11) NOT NULL,
  `MILL_ID` int(11) DEFAULT NULL,
  `UD_ENTREPRENEUR_ID` varchar(20) DEFAULT NULL,
  `REG_TYPE_ID` int(11) DEFAULT NULL,
  `OWNER_TYPE_ID` int(11) DEFAULT NULL,
  `OWNER_NAME` varchar(150) DEFAULT NULL,
  `DIVISION_ID` int(11) DEFAULT NULL,
  `DISTRICT_ID` int(11) DEFAULT NULL,
  `UPAZILA_ID` int(11) DEFAULT NULL,
  `UNION_ID` int(11) DEFAULT NULL,
  `NID` bigint(17) NOT NULL,
  `MOBILE_1` varchar(15) DEFAULT NULL,
  `MOBILE_2` varchar(15) DEFAULT NULL,
  `EMAIL` varchar(30) DEFAULT NULL,
  `ACTIVE_FLG` int(1) NOT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `approval_status` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tem_ssm_millemp_info`
--

CREATE TABLE `tem_ssm_millemp_info` (
  `MILLEMP_ID_TEM` int(11) NOT NULL,
  `MILLEMP_ID` int(11) NOT NULL,
  `MILL_ID` int(11) DEFAULT NULL,
  `TOTMALE_EMP` int(5) DEFAULT NULL,
  `TOTFEM_EMP` int(5) DEFAULT NULL,
  `FULLTIMEMALE_EMP` int(5) DEFAULT NULL,
  `FULLTIMEFEM_EMP` int(5) DEFAULT NULL,
  `PARTTIMEMALE_EMP` int(5) DEFAULT NULL,
  `PARTTIMEFEM_EMP` int(5) DEFAULT NULL,
  `TOTMALETECH_PER` int(5) DEFAULT NULL,
  `TOTFEMTECH_PER` int(5) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `FINAL_SUBMIT_FLG` int(2) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `approval_status` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tem_ssm_mill_info`
--

CREATE TABLE `tem_ssm_mill_info` (
  `MILL_ID_TEM` int(11) NOT NULL,
  `MILL_ID` int(11) NOT NULL,
  `UD_MILL_ID` int(11) DEFAULT NULL,
  `MILL_NAME` varchar(200) DEFAULT NULL,
  `PROCESS_TYPE_ID` int(11) DEFAULT NULL,
  `MILL_TYPE_ID` int(11) DEFAULT NULL,
  `CAPACITY_ID` varchar(50) DEFAULT NULL,
  `ZONE_ID` int(11) DEFAULT NULL,
  `MILLERS_ID` varchar(20) DEFAULT NULL,
  `DIVISION_ID` int(11) DEFAULT NULL,
  `DISTRICT_ID` int(11) DEFAULT NULL,
  `UPAZILA_ID` int(11) DEFAULT NULL,
  `UNION_ID` int(11) DEFAULT NULL,
  `ACTIVE_FLG` int(1) NOT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `REG_TYPE_ID` int(11) DEFAULT NULL,
  `OWNER_TYPE_ID` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `mill_logo` varchar(250) DEFAULT NULL,
  `approval_status` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tem_tsm_qc_info`
--

CREATE TABLE `tem_tsm_qc_info` (
  `QCINFO_ID_TEM` int(11) NOT NULL,
  `QCINFO_ID` int(11) NOT NULL,
  `MILL_ID` int(11) DEFAULT NULL,
  `LABORATORY_FLG` varchar(2) DEFAULT NULL,
  `OPERATION_PROCEDURE_FLG` varchar(2) DEFAULT NULL,
  `MONITORING_FLG` varchar(2) DEFAULT NULL,
  `LAB_MAN_FLG` varchar(2) DEFAULT NULL,
  `LAB_PERSON` int(11) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `approval_status` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmm_iodizedchd`
--

CREATE TABLE `tmm_iodizedchd` (
  `IODIZEDCHD_ID` int(11) NOT NULL,
  `IODIZEDMST_ID` int(11) DEFAULT NULL,
  `WASHCRASHMST_ID` int(11) DEFAULT NULL,
  `WASHCRASHCHD_ID` int(11) DEFAULT NULL,
  `ITEM_ID` int(11) DEFAULT NULL,
  `UOM_ID` int(11) DEFAULT NULL,
  `REQ_QTY` float DEFAULT 2,
  `UNIT_PRICE` int(10) DEFAULT NULL,
  `WASTAGE` float DEFAULT NULL,
  `ACTUAL_USE` int(10) DEFAULT NULL,
  `ITEM_TYPE` varchar(2) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `WASH_CRASH_QTY` float DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmm_iodizedchd`
--

INSERT INTO `tmm_iodizedchd` (`IODIZEDCHD_ID`, `IODIZEDMST_ID`, `WASHCRASHMST_ID`, `WASHCRASHCHD_ID`, `ITEM_ID`, `UOM_ID`, `REQ_QTY`, `UNIT_PRICE`, `WASTAGE`, `ACTUAL_USE`, `ITEM_TYPE`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `WASH_CRASH_QTY`, `center_id`) VALUES
(1, 1, NULL, NULL, 6, NULL, 9, NULL, 0, NULL, 'I', NULL, '2020-11-17 00:31:05', NULL, '2020-11-17 06:31:05', NULL, NULL, 10000, 475);

-- --------------------------------------------------------

--
-- Table structure for table `tmm_iodizedmst`
--

CREATE TABLE `tmm_iodizedmst` (
  `IODIZEDMST_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) DEFAULT NULL,
  `BATCH_NO` varchar(30) DEFAULT NULL,
  `BATCH_DATE` date DEFAULT NULL,
  `BATCH_SIZE` int(10) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmm_iodizedmst`
--

INSERT INTO `tmm_iodizedmst` (`IODIZEDMST_ID`, `PRODUCT_ID`, `BATCH_NO`, `BATCH_DATE`, `BATCH_SIZE`, `DESCRIPTION`, `REMARKS`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `center_id`) VALUES
(1, 6, 'I-475-20-11-17-0001', '2020-11-17', NULL, NULL, 'Na', NULL, '2020-11-17 00:31:05', NULL, '2020-11-17 06:31:05', NULL, NULL, 475);

-- --------------------------------------------------------

--
-- Table structure for table `tmm_itemstock`
--

CREATE TABLE `tmm_itemstock` (
  `STOCK_NO` int(11) NOT NULL,
  `TRAN_TYPE` varchar(2) DEFAULT NULL COMMENT 'S    =  Sales (Sales Challan)   (-)     nP    =  Purchase (Purchase Items & Receive from Supplier)   (+)     nPR  =  Purchase Return (Purchase Return(Debit Note))  (-)     nPA  =  Purchase Adjustment (Purchase Adjustment(Credit Note))  (+)       nSA  =  Sales Adjustment (Sales Adjustment (Debit Note))  (-)     nSR  =  Sales Return (Sales Return (Credit Note))  (+)    nF     =  FinishGoods Product (Entry)   (+)    nOB  = Openning Balance (Openning Balance)  (+)  nC    =  Raw  Material Consumption  (-)  I = Iodize Salt  W = Washing Salt  WR = Washing Salt Reduce  C = Chemical  IC = Iodize Chemical  II = Iodize Increase PR = Parchase all type of item SD = Salt Sale',
  `TRAN_NO` int(11) DEFAULT NULL,
  `DEPT_NO` int(11) DEFAULT NULL,
  `ITEM_NO` int(11) NOT NULL,
  `QTY` float NOT NULL,
  `UNIT_PRICE` int(11) DEFAULT NULL,
  `UNIT_NO` int(11) DEFAULT NULL,
  `TRAN_DATE` datetime DEFAULT NULL,
  `REF_STOCK_NO` int(11) DEFAULT NULL,
  `PRNT_STOCK_NO` int(11) DEFAULT NULL,
  `TRAN_FLAG` varchar(2) DEFAULT NULL,
  `stock_adjustment_id` int(11) DEFAULT NULL COMMENT 'is transaction from stock adjusment',
  `BATCH_NO` varchar(100) DEFAULT NULL,
  `EXP_DATE` datetime DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` datetime DEFAULT NULL,
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` datetime DEFAULT NULL,
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `SUPP_ID_AUTO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmm_itemstock`
--

INSERT INTO `tmm_itemstock` (`STOCK_NO`, `TRAN_TYPE`, `TRAN_NO`, `DEPT_NO`, `ITEM_NO`, `QTY`, `UNIT_PRICE`, `UNIT_NO`, `TRAN_DATE`, `REF_STOCK_NO`, `PRNT_STOCK_NO`, `TRAN_FLAG`, `stock_adjustment_id`, `BATCH_NO`, `EXP_DATE`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `SUPP_ID_AUTO`, `center_id`) VALUES
(1, 'SP', 1, NULL, 2, 100000, NULL, NULL, '2020-11-17 05:56:15', NULL, NULL, 'PR', NULL, NULL, NULL, 394, '2020-11-17 05:56:15', NULL, NULL, NULL, NULL, 24, 475),
(2, 'SP', 2, NULL, 3, 100000, NULL, NULL, '2020-11-17 05:56:34', NULL, NULL, 'PR', NULL, NULL, NULL, 394, '2020-11-17 05:56:34', NULL, NULL, NULL, NULL, 24, 475),
(3, 'CP', 3, NULL, 6, 100, NULL, NULL, '2020-11-17 00:00:00', NULL, NULL, 'PR', NULL, NULL, NULL, 394, '2020-11-17 05:56:59', NULL, NULL, NULL, NULL, 1, 475),
(4, 'S', 1, NULL, 2, -10000, NULL, NULL, '2020-11-17 00:00:00', NULL, NULL, 'WS', NULL, NULL, NULL, 394, '2020-11-17 05:59:27', NULL, NULL, NULL, NULL, NULL, 475),
(5, 'W', 1, NULL, 2, 10000, NULL, NULL, '2020-11-17 00:00:00', NULL, NULL, 'WI', NULL, NULL, NULL, 394, '2020-11-17 05:59:27', NULL, NULL, NULL, NULL, NULL, 475),
(6, 'S', 2, NULL, 2, -10000, NULL, NULL, '2020-11-17 00:00:00', NULL, NULL, 'WS', NULL, NULL, NULL, NULL, '2020-11-17 06:30:04', NULL, NULL, NULL, NULL, NULL, 475),
(7, 'W', 2, NULL, 2, 10000, NULL, NULL, '2020-11-17 00:00:00', NULL, NULL, 'WI', NULL, NULL, NULL, NULL, '2020-11-17 06:30:04', NULL, NULL, NULL, NULL, NULL, 475),
(8, 'W', 1, NULL, 6, -10000, NULL, NULL, '2020-11-17 00:00:00', NULL, NULL, 'WR', NULL, NULL, NULL, NULL, '2020-11-17 06:31:05', NULL, NULL, NULL, NULL, NULL, 475),
(9, 'C', 1, NULL, 6, -9, NULL, NULL, '2020-11-17 00:00:00', NULL, NULL, 'IC', NULL, NULL, NULL, NULL, '2020-11-17 06:31:05', NULL, NULL, NULL, NULL, NULL, 475),
(10, 'I', 1, NULL, 6, 10000, NULL, NULL, '2020-11-17 00:00:00', NULL, NULL, 'II', NULL, NULL, NULL, NULL, '2020-11-17 06:31:05', NULL, NULL, NULL, NULL, NULL, 475);

-- --------------------------------------------------------

--
-- Table structure for table `tmm_qualitycontrol`
--

CREATE TABLE `tmm_qualitycontrol` (
  `QUALITYCONTROL_ID` int(11) NOT NULL,
  `QC_DATE` date DEFAULT NULL,
  `QC_BY` int(11) DEFAULT NULL,
  `AGENCY_ID` int(11) DEFAULT NULL,
  `SALT_TYPE` varchar(2) DEFAULT NULL,
  `BATCH_NO` varchar(30) DEFAULT NULL,
  `QC_TESTNAME` varchar(50) DEFAULT NULL,
  `SODIUM_CHLORIDE` double DEFAULT NULL,
  `MOISTURIZER` double DEFAULT NULL,
  `IODINE_CONTENT` double DEFAULT NULL,
  `PH` double DEFAULT NULL,
  `water_insoluble_matter` double DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `QUALITY_CONTROL_IMAGE` varchar(250) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `matter_soluble_sc` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmm_receivechd`
--

CREATE TABLE `tmm_receivechd` (
  `RECEIVECHD_ID` int(11) NOT NULL,
  `RECEIVEMST_ID` int(11) DEFAULT NULL,
  `ITEM_ID` int(11) DEFAULT NULL,
  `RCV_QTY` float DEFAULT 2,
  `UNIT_PRICE` int(10) DEFAULT NULL,
  `UOM_ID` int(11) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmm_receivechd`
--

INSERT INTO `tmm_receivechd` (`RECEIVECHD_ID`, `RECEIVEMST_ID`, `ITEM_ID`, `RCV_QTY`, `UNIT_PRICE`, `UOM_ID`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `center_id`) VALUES
(1, 1, 2, 100000, NULL, NULL, 394, '2020-11-16 23:56:15', NULL, '2020-11-17 05:56:15', NULL, NULL, 475),
(2, 2, 3, 100000, NULL, NULL, 394, '2020-11-16 23:56:34', NULL, '2020-11-17 05:56:34', NULL, NULL, 475),
(3, 3, 6, 100, NULL, NULL, 394, '2020-11-16 23:56:59', NULL, '2020-11-17 05:56:59', NULL, NULL, 475);

-- --------------------------------------------------------

--
-- Table structure for table `tmm_receivemst`
--

CREATE TABLE `tmm_receivemst` (
  `RECEIVEMST_ID` int(11) NOT NULL,
  `RECEIVE_NO` varchar(15) DEFAULT NULL,
  `RECEIVE_DATE` date DEFAULT NULL,
  `RECEIVE_BY` int(11) DEFAULT NULL,
  `POSTING_DATE` date DEFAULT NULL,
  `RECEIVE_TYPE` varchar(2) DEFAULT NULL,
  `SUPP_ID_AUTO` int(11) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `SOURCE_ID` int(11) DEFAULT NULL,
  `COUNTRY_ID` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `INVOICE_NO` varchar(50) DEFAULT NULL,
  `DRIVER_NAME` varchar(50) DEFAULT NULL,
  `VEHICLE_NO` varchar(20) DEFAULT NULL,
  `VEHICLE_LICENSE` varchar(50) DEFAULT NULL,
  `TRANSPORT_NAME` varchar(50) DEFAULT NULL,
  `MOBILE_NO` varchar(20) DEFAULT NULL,
  `REMARKS_Tansport` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmm_receivemst`
--

INSERT INTO `tmm_receivemst` (`RECEIVEMST_ID`, `RECEIVE_NO`, `RECEIVE_DATE`, `RECEIVE_BY`, `POSTING_DATE`, `RECEIVE_TYPE`, `SUPP_ID_AUTO`, `DESCRIPTION`, `REMARKS`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `SOURCE_ID`, `COUNTRY_ID`, `center_id`, `INVOICE_NO`, `DRIVER_NAME`, `VEHICLE_NO`, `VEHICLE_LICENSE`, `TRANSPORT_NAME`, `MOBILE_NO`, `REMARKS_Tansport`) VALUES
(1, '2', NULL, NULL, NULL, 'SR', 24, NULL, 'NA', 394, '2020-11-16 23:56:15', NULL, '2020-11-17 05:56:15', NULL, NULL, 43, NULL, 475, '0123654778', NULL, NULL, NULL, NULL, NULL, NULL),
(2, '3', NULL, NULL, NULL, 'SR', 24, NULL, 'NA', 394, '2020-11-16 23:56:34', NULL, '2020-11-17 05:56:34', NULL, NULL, 43, NULL, 475, '0123647879', NULL, NULL, NULL, NULL, NULL, NULL),
(3, '6', '2020-11-17', NULL, NULL, 'CR', 1, NULL, 'NA', 394, '2020-11-16 23:56:59', NULL, '2020-11-17 05:56:59', NULL, NULL, NULL, NULL, 475, '013654778', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tmm_saleschd`
--

CREATE TABLE `tmm_saleschd` (
  `SALESCHD_ID` int(11) NOT NULL,
  `SALESMST_ID` int(11) DEFAULT NULL,
  `BATCH_NO` varchar(12) DEFAULT NULL,
  `PACK_TYPE` smallint(5) DEFAULT NULL,
  `PACK_QTY` int(5) DEFAULT NULL,
  `ITEM_ID` int(11) DEFAULT NULL,
  `UOM_ID` int(11) DEFAULT NULL,
  `QTY` float DEFAULT NULL,
  `UNIT_PRICE` int(10) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmm_salesmst`
--

CREATE TABLE `tmm_salesmst` (
  `SALESMST_ID` int(10) NOT NULL,
  `SALES_NO` int(10) DEFAULT NULL,
  `SALES_TYPE` varchar(2) DEFAULT NULL,
  `SALES_DATE` date DEFAULT NULL,
  `DELIVERY_DATE` date DEFAULT NULL,
  `CUSTOMER_ID` int(11) DEFAULT NULL,
  `SELLER_TYPE` varchar(2) DEFAULT NULL,
  `DRIVER_BY` int(11) DEFAULT NULL,
  `VEHICLE_NO` varchar(20) DEFAULT NULL,
  `VEHICLE_LICENSE` varchar(30) DEFAULT NULL,
  `TRANSPORT_ID` int(11) DEFAULT NULL,
  `MOBILE_NO` varchar(20) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `DRIVER_NAME` varchar(50) DEFAULT NULL,
  `TRANSPORT_NAME` varchar(50) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmm_washcrashchd`
--

CREATE TABLE `tmm_washcrashchd` (
  `WASHCRASHCHD_ID` int(11) NOT NULL,
  `WASHCRASHMST_ID` int(11) DEFAULT NULL,
  `RECEIVEMST_ID` int(11) DEFAULT NULL,
  `RECEIVECHD_ID` int(11) DEFAULT NULL,
  `ITEM_ID` int(11) DEFAULT NULL,
  `UOM_ID` int(11) DEFAULT NULL,
  `REQ_QTY` float DEFAULT 2,
  `UNIT_PRICE` int(10) DEFAULT NULL,
  `WASTAGE` float DEFAULT NULL,
  `ACTUAL_USE` int(10) DEFAULT NULL,
  `ITEM_TYPE` varchar(2) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmm_washcrashchd`
--

INSERT INTO `tmm_washcrashchd` (`WASHCRASHCHD_ID`, `WASHCRASHMST_ID`, `RECEIVEMST_ID`, `RECEIVECHD_ID`, `ITEM_ID`, `UOM_ID`, `REQ_QTY`, `UNIT_PRICE`, `WASTAGE`, `ACTUAL_USE`, `ITEM_TYPE`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `center_id`) VALUES
(1, 1, NULL, NULL, 2, NULL, 10000, NULL, 0, NULL, NULL, 394, '2020-11-16 23:59:27', NULL, '2020-11-17 05:59:27', NULL, NULL, 475),
(2, 2, NULL, NULL, 2, NULL, 10000, NULL, 0, NULL, NULL, NULL, '2020-11-17 00:30:04', NULL, '2020-11-17 06:30:04', NULL, NULL, 475);

-- --------------------------------------------------------

--
-- Table structure for table `tmm_washcrashmst`
--

CREATE TABLE `tmm_washcrashmst` (
  `WASHCRASHMST_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) DEFAULT NULL,
  `BATCH_NO` varchar(30) DEFAULT NULL,
  `BATCH_DATE` date DEFAULT NULL,
  `BATCH_SIZE` int(10) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmm_washcrashmst`
--

INSERT INTO `tmm_washcrashmst` (`WASHCRASHMST_ID`, `PRODUCT_ID`, `BATCH_NO`, `BATCH_DATE`, `BATCH_SIZE`, `DESCRIPTION`, `REMARKS`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `center_id`) VALUES
(1, 2, 'WC-475-20-11-17-0001', '2020-11-17', NULL, NULL, 'NA', 394, '2020-11-16 23:59:27', NULL, '2020-11-17 05:59:27', NULL, NULL, 475),
(2, 2, 'WC-475-20-11-17-0002', '2020-11-17', NULL, NULL, 'Na', NULL, '2020-11-17 00:30:04', NULL, '2020-11-17 06:30:04', NULL, NULL, 475);

-- --------------------------------------------------------

--
-- Table structure for table `tsm_millmonitore`
--

CREATE TABLE `tsm_millmonitore` (
  `MILLMONITORE_ID` int(11) NOT NULL,
  `MILL_ID` int(11) DEFAULT NULL,
  `MONITORE_FLG` varchar(2) DEFAULT NULL,
  `AGENCY_ID` int(11) DEFAULT NULL,
  `MOMITOR_DATE` date DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tsm_qc_info`
--

CREATE TABLE `tsm_qc_info` (
  `QCINFO_ID` int(11) NOT NULL,
  `MILL_ID` int(11) DEFAULT NULL,
  `LABORATORY_FLG` varchar(2) DEFAULT NULL,
  `OPERATION_PROCEDURE_FLG` varchar(2) DEFAULT NULL,
  `MONITORING_FLG` varchar(2) DEFAULT NULL,
  `LAB_MAN_FLG` varchar(2) DEFAULT NULL,
  `LAB_PERSON` int(11) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(60) DEFAULT NULL,
  `ENTRY_BY` int(11) DEFAULT NULL,
  `ENTRY_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATE_BY` int(11) DEFAULT NULL,
  `UPDATE_TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BRANCH_NO` int(11) DEFAULT NULL,
  `COMPANY_NO` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `approval_status` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tsm_qc_info`
--

INSERT INTO `tsm_qc_info` (`QCINFO_ID`, `MILL_ID`, `LABORATORY_FLG`, `OPERATION_PROCEDURE_FLG`, `MONITORING_FLG`, `LAB_MAN_FLG`, `LAB_PERSON`, `DESCRIPTION`, `REMARKS`, `ENTRY_BY`, `ENTRY_TIMESTAMP`, `UPDATE_BY`, `UPDATE_TIMESTAMP`, `BRANCH_NO`, `COMPANY_NO`, `center_id`, `approval_status`) VALUES
(2, 72, '1', '1', NULL, '1', 20, NULL, NULL, 204, '2020-10-24 22:16:41', NULL, '2020-10-25 04:16:41', NULL, NULL, 61, 0),
(3, 73, '1', '1', '1', '1', 2, NULL, 'NA', 204, '2020-11-16 23:35:43', NULL, '2020-11-17 05:35:43', NULL, NULL, 61, 0),
(4, 74, '1', '1', '1', '1', 2, NULL, 'test', 204, '2020-11-19 03:13:08', NULL, '2020-11-19 21:13:08', NULL, NULL, 61, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_full_name` varchar(100) DEFAULT NULL,
  `user_full_name_bn` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `remember_token` varchar(100) NOT NULL,
  `contact_no` varchar(45) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `cost_center_id` int(11) DEFAULT NULL COMMENT 'cost center id',
  `cost_center_type` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL COMMENT 'designation comes from lookup data table',
  `bank_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `account_no` varchar(45) DEFAULT NULL,
  `route_no` varchar(45) DEFAULT NULL,
  `mail_verified` tinyint(4) NOT NULL DEFAULT 0,
  `active_status` int(1) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` int(11) DEFAULT NULL,
  `update_at` date DEFAULT NULL,
  `user_group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_group_level_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_image` varchar(250) DEFAULT NULL,
  `user_signature` varchar(250) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_full_name`, `user_full_name_bn`, `username`, `email`, `password`, `remember_token`, `contact_no`, `address`, `remarks`, `cost_center_id`, `cost_center_type`, `designation_id`, `bank_id`, `branch_id`, `account_no`, `route_no`, `mail_verified`, `active_status`, `create_by`, `create_at`, `update_by`, `update_at`, `user_group_id`, `user_group_level_id`, `user_image`, `user_signature`, `center_id`, `designation`) VALUES
(1, 'System Admin', 'System Admin', 'ati', 'ati@ati.info', '$2y$10$eyl3lBCIm/Lt38aorn.9HuIfWNtSsCkwKCdyqZdRad4cgvibq1I6K', 'WkjT92BUKnJBwDfwVeA916A9vYFcxjYspPQ7xkBV9VKXP0hCE2f9B6qWknsx', NULL, NULL, NULL, 2, 1, 56, NULL, NULL, NULL, NULL, 1, 1, 1, '2020-12-31 10:31:46', 1, '2020-12-31', 0, 0, 'image/user-image/defaultUserImage.png', 'image/user-signature/defaultUserSignature.png', 61, NULL),
(162, 'Super Admin', 'Super Admin', 'ati', 'ati@gmail.com', '$2y$10$4vcW.B/fNjyuMgnIURTQxu4nd9bSM.qfu42vVzJMzXUueUUAMBseK', '4UtB3TD78tpbTFqcoFVTlU9fLDdgEuzv12SkIk5VOwSQdpGZ3HTfk43uq9wf', '01719100012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 161, '2020-12-31 10:05:08', NULL, NULL, 1, 13, 'image/user-image/defaultUserImage.png', 'image/user-signature/defaultUserSignature.png', NULL, NULL),
(200, 'Admin', NULL, 'Admin', 'admin@gmail.com', '$2y$10$L8f61f9SbRKD9QWgN80DrudvbosM7zaQQ8cdOHrxqsf7WvJ1dAhFq', 'kAnRrjw9tZpMoJnroPuo4qV4bgH5CKWuF5RjXF2v5DQy4Z0seHcwcQVErcHh', '01719100012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 162, '2020-12-31 10:12:52', 200, '2020-09-19', 1, 53, 'image/user-image/defaultUserImage.png', 'image/user-image/defaultUserSignature.png', 0, NULL),
(201, 'UNICEF Bangladesh', NULL, 'UNICEF', 'unicef@gmail.com', '$2y$10$.6xslEA/gS5PmG9thTtMN.cEq4xB8fS74/b9nkoIEVKHSm43EHGUS', 'D4SUQFYYSS5L6ZCaw8YItqxdqiuxLZUJhKjqkDQsnfG18votAbcV8sNpifAy', '01719100078', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 162, '2020-12-31 10:12:27', 200, '2020-11-21', 20, 63, 'image/user-image/defaultUserImage.png', 'image/user-image/defaultUserSignature.png', 61, NULL),
(202, 'BSTI', NULL, 'bsti', 'bricb@yahoo.com', '$2y$10$crwfT.WbkpHDbfv4Q0gbf.vDDNG7ulfWOtK/1R/XBX18gQoD0a5Q2', '9I4mduI6RWMK9mEw5a8jRRYeGvDekJij1X6EGxCIMRsdJsLRSbl99H2oU7yT', '01719100025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 162, '2020-03-08 23:31:32', 200, '2019-11-07', 18, 61, 'image/user-image/defaultUserImage.png', 'image/user-image/defaultUserSignature.png', NULL, NULL),
(203, 'BSCIC', NULL, 'bscic', 'bscic@gmail.com', '$2y$10$eiTG.j5t1nP/lVmkQ7r0gugVduFIknMNOQT.JjcGYcpOCjnZLlzoe', 'cMQA0DyrFpLeorZBhEe0ApCNFRmFTcuihz034DyVbw1r05JHwOY4vBzTn4I1', '01719100013', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 162, '2020-11-21 22:11:18', 200, '2020-11-21', 19, 62, 'image/user-image/defaultUserImage.png', 'image/user-image/defaultUserSignature.png', 61, NULL),
(204, 'Islampur Salt Miller Owner Versatile Coorperative Society Limited', NULL, 'islampur', 'islampur@gmail.com', '$2y$10$Yx29ZfLuOsTLzYGvL50Xu.bq/UqhOYhs7AI.4pu0dMHCCm9O2oUw2', 'X0tvS8IMnuqXPghECjWZNG1uFMpAAE4xSVI7NNzDWFq3VYCFB4LHUCq1rd4t', '01719100017', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 162, '2020-11-22 06:58:26', 200, '2020-10-13', 21, 64, 'public/image/user-image/2020-10-13_1602581776.png', 'image/user-image/defaultUserSignature.png', 61, NULL),
(394, 'Zaman Chowdhory', NULL, 'zaman', 'tahsin@atilimited.net', '$2y$10$Fv2g5BH98i1L/N8XQwuzE.4OFOqhZrgV1QLNHjXq6H/nzqWh6jah2', 'pH3CDq9wV7zmEYqbR1YUkJve631eU3uZJfgDVzp0J0IkHJYpyY39FdnBzbMi', '01955547896', 'Badda', 'NA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 204, '2020-12-04 16:55:36', NULL, NULL, 22, 65, 'public/image/user-image/2020-11-17_1605591718.png', 'public/image/user-signature/2020-11-17_1605591718.png', 475, 'Administrative Officer'),
(395, 'Association Chattogram User', NULL, 'CGP User', 'splbd.info@gmail.com', '$2y$10$cqCXVW5zKcPFiGcD..3wvOAayPwsTAI98A0CVRQB8H5VkOht4pJx2', 'Afbe4kWracOf69zFT2Huuibat9mFSOMzcumxKVnhFzgHMEoNzPfYEUrgGDUT', '018997777', 'Address', 'Remarks Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 200, '2020-12-04 16:25:22', 200, '2020-11-19', 23, 79, 'public/image/user-image/2020-11-19_1605817515.jpg', 'public/image/user-signature/2020-11-19_1605817516.jpg', 61, NULL),
(396, NULL, NULL, 'DAC', 'sheikh.jhm@gmail.com', '$2y$10$gN0/kz6BiCqwZzr33NFdz.ZxPTe9f1QCmGa0JEm9EH/YMJh1EkH/K', 'pJk4e8sOsMukYRQ68pUcllvXZ0BLjqz2o9OlanEblR1HQpHewr2UJmOckqY0', NULL, 'Test', 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 200, '2020-12-04 16:26:14', NULL, NULL, 25, 80, 'public/image/user-image/defaultUserImage.png', 'public/image/user-signature/defaultUserSignature.png', 61, NULL),
(397, NULL, NULL, 'Patiya', 'benetecbd@gmail.com', '$2y$10$Q81KgizAPbDOWsuu9Tm1ge8iRPLI8uw5vinKuBMqX8J.C/bzojMo6', 'tmZj0ypOSKmjeC40DXZ4c2AC9SuTmWIjHqBAw1lDDeP4MbzX1iVD4wjnpl5V', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 200, '2020-12-04 16:27:23', NULL, NULL, 26, 81, 'public/image/user-image/defaultUserImage.png', 'public/image/user-signature/defaultUserSignature.png', 61, NULL),
(398, NULL, NULL, 'PRAN USER', 'sabd.azad@gmail.com', '$2y$10$9g8tk800FoVTgJfUkI42Te3FjY7LgIyDqLhGLaN0D0Il5usDc6P5K', 'GFPLilymBomRDmzGqmION6PW66dvKRRd626Rl4YSM7B4llY7boXlQt6OpFA1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 200, '2020-11-19 22:42:37', NULL, NULL, 22, 67, 'public/image/user-image/defaultUserImage.png', 'public/image/user-signature/defaultUserSignature.png', 475, NULL),
(399, NULL, NULL, 'IPHN USER', 'irachowdhury@unicef.org', '$2y$10$fvhtouumQ3Yo8oIZz30G.ubivkfaR2h1XPXmcLx75wlQ5alq6jeta', 'jJKOGrii0KrPVmCVza28s1laGXbjfuirTaHU6lxv', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 200, '2020-11-29 10:59:47', NULL, NULL, 33, 84, 'public/image/user-image/defaultUserImage.png', 'public/image/user-signature/defaultUserSignature.png', 61, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_log`
--

CREATE TABLE `users_log` (
  `user_log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `loged_in` datetime DEFAULT NULL,
  `loged_out` datetime DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `browser_history` varchar(200) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `verify_users`
--

CREATE TABLE `verify_users` (
  `user_id` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `verify_users`
--

INSERT INTO `verify_users` (`user_id`, `token`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(391, 'MFslOz7trdYVfw87zukCea39JSdUTHEdAN4HlmUo', NULL, '2020-10-24 22:07:22', NULL, '2020-10-25'),
(392, 'CnpYTZookv8nwn6xrekP7ABgtfEChOWWOQZsawgf', NULL, '2020-10-24 22:18:07', NULL, '2020-10-25'),
(393, 'RQrMc1FtXkJgpYStlQvtgiIYqeSjCtNNjsAXW9i7', NULL, '2020-10-24 22:27:06', NULL, '2020-10-25'),
(394, '16BG38N1b0ZNh5LKtf0sNUaxwfGWRgj1UTJDCUUa', NULL, '2020-11-16 23:41:58', NULL, '2020-11-17'),
(395, 'P4Pfo4bmCHYh8GKTZ3K3rMBEW5qFTJI6yNlRpcSQ', NULL, '2020-11-19 14:25:16', NULL, '2020-11-19'),
(396, 'CWTDHfM9MN8pfzhaKfvQ47uODoEEPrEN1Oc8H8rk', NULL, '2020-11-19 14:51:31', NULL, '2020-11-19'),
(397, '8a7jUmjiOcq9GVVfl9gzzgZPHYrBpkKx4mYBPBfW', NULL, '2020-11-19 16:22:34', NULL, '2020-11-19'),
(398, 'JqcdCcWH4EESq4br8cYrQzj95Xxkm0XXFyx2jhnE', NULL, '2020-11-19 16:33:49', NULL, '2020-11-19'),
(399, 'fIL0SZIRsj0KUNhkheK7D1At6gmUcPCEIZ0WPK6T', NULL, '2020-11-29 04:59:50', NULL, '2020-11-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cost_center`
--
ALTER TABLE `cost_center`
  ADD PRIMARY KEY (`cost_center_id`),
  ADD KEY `fk_cost_center_type_idx` (`cost_center_type`);

--
-- Indexes for table `cost_center_type`
--
ALTER TABLE `cost_center_type`
  ADD PRIMARY KEY (`cost_center_type_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `miller_extend_dates`
--
ALTER TABLE `miller_extend_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `sa_modules`
--
ALTER TABLE `sa_modules`
  ADD PRIMARY KEY (`MODULE_ID`);

--
-- Indexes for table `sa_module_links`
--
ALTER TABLE `sa_module_links`
  ADD PRIMARY KEY (`LINK_ID`);

--
-- Indexes for table `sa_org_mlink`
--
ALTER TABLE `sa_org_mlink`
  ADD PRIMARY KEY (`ORG_MLINKS_ID`);

--
-- Indexes for table `sa_org_modules`
--
ALTER TABLE `sa_org_modules`
  ADD PRIMARY KEY (`ORG_MODULE_ID`);

--
-- Indexes for table `sa_uglw_mlink`
--
ALTER TABLE `sa_uglw_mlink`
  ADD PRIMARY KEY (`UGLWM_LINK`);

--
-- Indexes for table `sa_ug_level`
--
ALTER TABLE `sa_ug_level`
  ADD PRIMARY KEY (`UG_LEVEL_ID`);

--
-- Indexes for table `sa_user_group`
--
ALTER TABLE `sa_user_group`
  ADD PRIMARY KEY (`USERGRP_ID`);

--
-- Indexes for table `smm_certificate`
--
ALTER TABLE `smm_certificate`
  ADD PRIMARY KEY (`CERTIFICATE_ID`);

--
-- Indexes for table `smm_item`
--
ALTER TABLE `smm_item`
  ADD PRIMARY KEY (`ITEM_NO`);

--
-- Indexes for table `smm_require_chemical`
--
ALTER TABLE `smm_require_chemical`
  ADD PRIMARY KEY (`REQUIRE_CHEMICAL_ID`);

--
-- Indexes for table `smm_rmallocationchd`
--
ALTER TABLE `smm_rmallocationchd`
  ADD PRIMARY KEY (`RMALLOCHD_ID`),
  ADD KEY `FK_RMALLOMST_ID` (`RMALLOMST_ID`);

--
-- Indexes for table `smm_rmallocationmst`
--
ALTER TABLE `smm_rmallocationmst`
  ADD PRIMARY KEY (`RMALLOMST_ID`);

--
-- Indexes for table `ssc_country`
--
ALTER TABLE `ssc_country`
  ADD PRIMARY KEY (`COUNTRY_ID`);

--
-- Indexes for table `ssc_districts`
--
ALTER TABLE `ssc_districts`
  ADD PRIMARY KEY (`DISTRICT_ID`);

--
-- Indexes for table `ssc_divisions`
--
ALTER TABLE `ssc_divisions`
  ADD PRIMARY KEY (`DIVISION_ID`);

--
-- Indexes for table `ssc_lookupchd`
--
ALTER TABLE `ssc_lookupchd`
  ADD PRIMARY KEY (`LOOKUPCHD_ID`),
  ADD KEY `FK_LOOKUPMST_ID` (`LOOKUPMST_ID`);

--
-- Indexes for table `ssc_lookupmst`
--
ALTER TABLE `ssc_lookupmst`
  ADD PRIMARY KEY (`LOOKUPMST_ID`);

--
-- Indexes for table `ssc_thana`
--
ALTER TABLE `ssc_thana`
  ADD PRIMARY KEY (`THANA_ID`);

--
-- Indexes for table `ssc_unions`
--
ALTER TABLE `ssc_unions`
  ADD PRIMARY KEY (`UNION_ID`),
  ADD KEY `UPAZILA_ID` (`UPAZILA_ID`);

--
-- Indexes for table `ssc_upazilas`
--
ALTER TABLE `ssc_upazilas`
  ADD PRIMARY KEY (`UPAZILA_ID`),
  ADD KEY `DISTRICT_ID` (`DISTRICT_ID`);

--
-- Indexes for table `ssm_associationsetup`
--
ALTER TABLE `ssm_associationsetup`
  ADD PRIMARY KEY (`ASSOCIATION_ID`);

--
-- Indexes for table `ssm_bsti_test`
--
ALTER TABLE `ssm_bsti_test`
  ADD PRIMARY KEY (`BSTITEST_ID`);

--
-- Indexes for table `ssm_bsti_test_resutl_range`
--
ALTER TABLE `ssm_bsti_test_resutl_range`
  ADD PRIMARY KEY (`BSTITEST_RESULT_ID`);

--
-- Indexes for table `ssm_certificate_info`
--
ALTER TABLE `ssm_certificate_info`
  ADD PRIMARY KEY (`CERTIFICATE_ID`),
  ADD KEY `ssm_certificate_info_ibfk_1` (`MILL_ID`);

--
-- Indexes for table `ssm_certificate_map_info`
--
ALTER TABLE `ssm_certificate_map_info`
  ADD PRIMARY KEY (`CERTIFICATE_MAP_ID`);

--
-- Indexes for table `ssm_coverage_area`
--
ALTER TABLE `ssm_coverage_area`
  ADD PRIMARY KEY (`COVERAGE_ID`),
  ADD KEY `FK_CUSTOMER_ID` (`CUSTOMER_ID`);

--
-- Indexes for table `ssm_crud_salt_details`
--
ALTER TABLE `ssm_crud_salt_details`
  ADD PRIMARY KEY (`CRUDSALTDETAIL_ID`);

--
-- Indexes for table `ssm_customer_info`
--
ALTER TABLE `ssm_customer_info`
  ADD PRIMARY KEY (`CUSTOMER_ID`);

--
-- Indexes for table `ssm_entrepreneur_info`
--
ALTER TABLE `ssm_entrepreneur_info`
  ADD PRIMARY KEY (`ENTREPRENEUR_ID`),
  ADD KEY `ssm_entrepreneur_info_ibfk_1` (`MILL_ID`);

--
-- Indexes for table `ssm_millemp_info`
--
ALTER TABLE `ssm_millemp_info`
  ADD PRIMARY KEY (`MILLEMP_ID`),
  ADD KEY `ssm_millemp_info_ibfk_1` (`MILL_ID`);

--
-- Indexes for table `ssm_mill_info`
--
ALTER TABLE `ssm_mill_info`
  ADD PRIMARY KEY (`MILL_ID`);

--
-- Indexes for table `ssm_supplier_info`
--
ALTER TABLE `ssm_supplier_info`
  ADD PRIMARY KEY (`SUPP_ID_AUTO`);

--
-- Indexes for table `ssm_zonesetup`
--
ALTER TABLE `ssm_zonesetup`
  ADD PRIMARY KEY (`ZONE_ID`);

--
-- Indexes for table `stock_adjustment`
--
ALTER TABLE `stock_adjustment`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tem_ssm_associationsetup`
--
ALTER TABLE `tem_ssm_associationsetup`
  ADD PRIMARY KEY (`ASSOCIATION_ID_TEM`);

--
-- Indexes for table `tem_ssm_certificate_info`
--
ALTER TABLE `tem_ssm_certificate_info`
  ADD PRIMARY KEY (`CERTIFICATE_ID_TEM`),
  ADD KEY `ssm_certificate_info_ibfk_2` (`MILL_ID`);

--
-- Indexes for table `tem_ssm_entrepreneur_info`
--
ALTER TABLE `tem_ssm_entrepreneur_info`
  ADD PRIMARY KEY (`ENTREPRENEUR_ID_TEM`),
  ADD KEY `ssm_entrepreneur_info_ibfk_2` (`MILL_ID`);

--
-- Indexes for table `tem_ssm_millemp_info`
--
ALTER TABLE `tem_ssm_millemp_info`
  ADD PRIMARY KEY (`MILLEMP_ID_TEM`),
  ADD KEY `ssm_millemp_info_ibfk_2` (`MILL_ID`);

--
-- Indexes for table `tem_ssm_mill_info`
--
ALTER TABLE `tem_ssm_mill_info`
  ADD PRIMARY KEY (`MILL_ID_TEM`);

--
-- Indexes for table `tem_tsm_qc_info`
--
ALTER TABLE `tem_tsm_qc_info`
  ADD PRIMARY KEY (`QCINFO_ID_TEM`),
  ADD KEY `tsm_qc_info_ibfk_2` (`MILL_ID`);

--
-- Indexes for table `tmm_iodizedchd`
--
ALTER TABLE `tmm_iodizedchd`
  ADD PRIMARY KEY (`IODIZEDCHD_ID`),
  ADD KEY `FK_IODIZEDMST_ID` (`IODIZEDMST_ID`);

--
-- Indexes for table `tmm_iodizedmst`
--
ALTER TABLE `tmm_iodizedmst`
  ADD PRIMARY KEY (`IODIZEDMST_ID`);

--
-- Indexes for table `tmm_itemstock`
--
ALTER TABLE `tmm_itemstock`
  ADD PRIMARY KEY (`STOCK_NO`);

--
-- Indexes for table `tmm_qualitycontrol`
--
ALTER TABLE `tmm_qualitycontrol`
  ADD PRIMARY KEY (`QUALITYCONTROL_ID`);

--
-- Indexes for table `tmm_receivechd`
--
ALTER TABLE `tmm_receivechd`
  ADD PRIMARY KEY (`RECEIVECHD_ID`),
  ADD KEY `FK_RECEIVEMST_ID` (`RECEIVEMST_ID`);

--
-- Indexes for table `tmm_receivemst`
--
ALTER TABLE `tmm_receivemst`
  ADD PRIMARY KEY (`RECEIVEMST_ID`);

--
-- Indexes for table `tmm_saleschd`
--
ALTER TABLE `tmm_saleschd`
  ADD PRIMARY KEY (`SALESCHD_ID`),
  ADD KEY `tmm_saleschd_ibfk_1` (`SALESMST_ID`);

--
-- Indexes for table `tmm_salesmst`
--
ALTER TABLE `tmm_salesmst`
  ADD PRIMARY KEY (`SALESMST_ID`);

--
-- Indexes for table `tmm_washcrashchd`
--
ALTER TABLE `tmm_washcrashchd`
  ADD PRIMARY KEY (`WASHCRASHCHD_ID`),
  ADD KEY `FK_WASHCRASHMST_ID` (`WASHCRASHMST_ID`);

--
-- Indexes for table `tmm_washcrashmst`
--
ALTER TABLE `tmm_washcrashmst`
  ADD PRIMARY KEY (`WASHCRASHMST_ID`);

--
-- Indexes for table `tsm_millmonitore`
--
ALTER TABLE `tsm_millmonitore`
  ADD PRIMARY KEY (`MILLMONITORE_ID`),
  ADD KEY `tsm_millmonitore_ibfk_1` (`MILL_ID`);

--
-- Indexes for table `tsm_qc_info`
--
ALTER TABLE `tsm_qc_info`
  ADD PRIMARY KEY (`QCINFO_ID`),
  ADD KEY `tsm_qc_info_ibfk_1` (`MILL_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_log`
--
ALTER TABLE `users_log`
  ADD PRIMARY KEY (`user_log_id`),
  ADD KEY `fk_users_log_user_idx` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cost_center`
--
ALTER TABLE `cost_center`
  MODIFY `cost_center_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `cost_center_type`
--
ALTER TABLE `cost_center_type`
  MODIFY `cost_center_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `miller_extend_dates`
--
ALTER TABLE `miller_extend_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sa_modules`
--
ALTER TABLE `sa_modules`
  MODIFY `MODULE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sa_module_links`
--
ALTER TABLE `sa_module_links`
  MODIFY `LINK_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `sa_org_mlink`
--
ALTER TABLE `sa_org_mlink`
  MODIFY `ORG_MLINKS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `sa_org_modules`
--
ALTER TABLE `sa_org_modules`
  MODIFY `ORG_MODULE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sa_uglw_mlink`
--
ALTER TABLE `sa_uglw_mlink`
  MODIFY `UGLWM_LINK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=509;

--
-- AUTO_INCREMENT for table `sa_ug_level`
--
ALTER TABLE `sa_ug_level`
  MODIFY `UG_LEVEL_ID` bigint(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `sa_user_group`
--
ALTER TABLE `sa_user_group`
  MODIFY `USERGRP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `smm_certificate`
--
ALTER TABLE `smm_certificate`
  MODIFY `CERTIFICATE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `smm_item`
--
ALTER TABLE `smm_item`
  MODIFY `ITEM_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `smm_require_chemical`
--
ALTER TABLE `smm_require_chemical`
  MODIFY `REQUIRE_CHEMICAL_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `smm_rmallocationchd`
--
ALTER TABLE `smm_rmallocationchd`
  MODIFY `RMALLOCHD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smm_rmallocationmst`
--
ALTER TABLE `smm_rmallocationmst`
  MODIFY `RMALLOMST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `ssc_country`
--
ALTER TABLE `ssc_country`
  MODIFY `COUNTRY_ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ssc_districts`
--
ALTER TABLE `ssc_districts`
  MODIFY `DISTRICT_ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `ssc_divisions`
--
ALTER TABLE `ssc_divisions`
  MODIFY `DIVISION_ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ssc_lookupchd`
--
ALTER TABLE `ssc_lookupchd`
  MODIFY `LOOKUPCHD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `ssc_lookupmst`
--
ALTER TABLE `ssc_lookupmst`
  MODIFY `LOOKUPMST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ssc_thana`
--
ALTER TABLE `ssc_thana`
  MODIFY `THANA_ID` smallint(8) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key Of sa_thanas Table.', AUTO_INCREMENT=609;

--
-- AUTO_INCREMENT for table `ssc_unions`
--
ALTER TABLE `ssc_unions`
  MODIFY `UNION_ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ssc_upazilas`
--
ALTER TABLE `ssc_upazilas`
  MODIFY `UPAZILA_ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=595;

--
-- AUTO_INCREMENT for table `ssm_associationsetup`
--
ALTER TABLE `ssm_associationsetup`
  MODIFY `ASSOCIATION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=478;

--
-- AUTO_INCREMENT for table `ssm_bsti_test`
--
ALTER TABLE `ssm_bsti_test`
  MODIFY `BSTITEST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ssm_bsti_test_resutl_range`
--
ALTER TABLE `ssm_bsti_test_resutl_range`
  MODIFY `BSTITEST_RESULT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ssm_certificate_info`
--
ALTER TABLE `ssm_certificate_info`
  MODIFY `CERTIFICATE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ssm_certificate_map_info`
--
ALTER TABLE `ssm_certificate_map_info`
  MODIFY `CERTIFICATE_MAP_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ssm_coverage_area`
--
ALTER TABLE `ssm_coverage_area`
  MODIFY `COVERAGE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ssm_crud_salt_details`
--
ALTER TABLE `ssm_crud_salt_details`
  MODIFY `CRUDSALTDETAIL_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ssm_customer_info`
--
ALTER TABLE `ssm_customer_info`
  MODIFY `CUSTOMER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ssm_entrepreneur_info`
--
ALTER TABLE `ssm_entrepreneur_info`
  MODIFY `ENTREPRENEUR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ssm_millemp_info`
--
ALTER TABLE `ssm_millemp_info`
  MODIFY `MILLEMP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ssm_mill_info`
--
ALTER TABLE `ssm_mill_info`
  MODIFY `MILL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `ssm_supplier_info`
--
ALTER TABLE `ssm_supplier_info`
  MODIFY `SUPP_ID_AUTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ssm_zonesetup`
--
ALTER TABLE `ssm_zonesetup`
  MODIFY `ZONE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock_adjustment`
--
ALTER TABLE `stock_adjustment`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tem_ssm_associationsetup`
--
ALTER TABLE `tem_ssm_associationsetup`
  MODIFY `ASSOCIATION_ID_TEM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tem_ssm_certificate_info`
--
ALTER TABLE `tem_ssm_certificate_info`
  MODIFY `CERTIFICATE_ID_TEM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tem_ssm_entrepreneur_info`
--
ALTER TABLE `tem_ssm_entrepreneur_info`
  MODIFY `ENTREPRENEUR_ID_TEM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tem_ssm_millemp_info`
--
ALTER TABLE `tem_ssm_millemp_info`
  MODIFY `MILLEMP_ID_TEM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tem_ssm_mill_info`
--
ALTER TABLE `tem_ssm_mill_info`
  MODIFY `MILL_ID_TEM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tem_tsm_qc_info`
--
ALTER TABLE `tem_tsm_qc_info`
  MODIFY `QCINFO_ID_TEM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmm_iodizedchd`
--
ALTER TABLE `tmm_iodizedchd`
  MODIFY `IODIZEDCHD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tmm_iodizedmst`
--
ALTER TABLE `tmm_iodizedmst`
  MODIFY `IODIZEDMST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tmm_itemstock`
--
ALTER TABLE `tmm_itemstock`
  MODIFY `STOCK_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tmm_qualitycontrol`
--
ALTER TABLE `tmm_qualitycontrol`
  MODIFY `QUALITYCONTROL_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmm_receivechd`
--
ALTER TABLE `tmm_receivechd`
  MODIFY `RECEIVECHD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tmm_receivemst`
--
ALTER TABLE `tmm_receivemst`
  MODIFY `RECEIVEMST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tmm_saleschd`
--
ALTER TABLE `tmm_saleschd`
  MODIFY `SALESCHD_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmm_salesmst`
--
ALTER TABLE `tmm_salesmst`
  MODIFY `SALESMST_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmm_washcrashchd`
--
ALTER TABLE `tmm_washcrashchd`
  MODIFY `WASHCRASHCHD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tmm_washcrashmst`
--
ALTER TABLE `tmm_washcrashmst`
  MODIFY `WASHCRASHMST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tsm_millmonitore`
--
ALTER TABLE `tsm_millmonitore`
  MODIFY `MILLMONITORE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tsm_qc_info`
--
ALTER TABLE `tsm_qc_info`
  MODIFY `QCINFO_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;

--
-- AUTO_INCREMENT for table `users_log`
--
ALTER TABLE `users_log`
  MODIFY `user_log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cost_center`
--
ALTER TABLE `cost_center`
  ADD CONSTRAINT `fk_cost_center_type` FOREIGN KEY (`cost_center_type`) REFERENCES `cost_center_type` (`cost_center_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `smm_rmallocationchd`
--
ALTER TABLE `smm_rmallocationchd`
  ADD CONSTRAINT `FK_RMALLOMST_ID` FOREIGN KEY (`RMALLOMST_ID`) REFERENCES `smm_rmallocationmst` (`RMALLOMST_ID`);

--
-- Constraints for table `ssc_unions`
--
ALTER TABLE `ssc_unions`
  ADD CONSTRAINT `UNIONS_IBFK_1` FOREIGN KEY (`UPAZILA_ID`) REFERENCES `ssc_upazilas` (`UPAZILA_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ssc_upazilas`
--
ALTER TABLE `ssc_upazilas`
  ADD CONSTRAINT `ssc_upazilas_ibfk_1` FOREIGN KEY (`DISTRICT_ID`) REFERENCES `ssc_districts` (`DISTRICT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tmm_iodizedchd`
--
ALTER TABLE `tmm_iodizedchd`
  ADD CONSTRAINT `FK_IODIZEDMST_ID` FOREIGN KEY (`IODIZEDMST_ID`) REFERENCES `tmm_iodizedmst` (`IODIZEDMST_ID`);

--
-- Constraints for table `tmm_receivechd`
--
ALTER TABLE `tmm_receivechd`
  ADD CONSTRAINT `FK_RECEIVEMST_ID` FOREIGN KEY (`RECEIVEMST_ID`) REFERENCES `tmm_receivemst` (`RECEIVEMST_ID`);

--
-- Constraints for table `tmm_saleschd`
--
ALTER TABLE `tmm_saleschd`
  ADD CONSTRAINT `tmm_saleschd_ibfk_1` FOREIGN KEY (`SALESMST_ID`) REFERENCES `tmm_salesmst` (`SALESMST_ID`);

--
-- Constraints for table `tmm_washcrashchd`
--
ALTER TABLE `tmm_washcrashchd`
  ADD CONSTRAINT `FK_WASHCRASHMST_ID` FOREIGN KEY (`WASHCRASHMST_ID`) REFERENCES `tmm_washcrashmst` (`WASHCRASHMST_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
