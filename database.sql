-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 20, 2025 at 01:00 PM
-- Server version: 5.7.44
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` int(255) NOT NULL,
  `cat_id` int(255) NOT NULL DEFAULT '0',
  `content_id` int(255) NOT NULL DEFAULT '0',
  `start_date` varchar(255) DEFAULT NULL,
  `start_hour` tinyint(24) DEFAULT NULL,
  `start_minute` tinyint(60) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `end_hour` tinyint(24) DEFAULT NULL,
  `end_minute` tinyint(60) DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id`, `cat_id`, `content_id`, `start_date`, `start_hour`, `start_minute`, `end_date`, `end_hour`, `end_minute`, `publish`) VALUES
(1, 1, 6, '2009-07-01', 0, 0, '2012-06-30', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_account`
--

CREATE TABLE `bbc_account` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT '0',
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `params` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_account`
--

INSERT INTO `bbc_account` (`id`, `user_id`, `username`, `name`, `image`, `email`, `params`) VALUES
(1, 1, 'admin', 'Administrator', '', 'tmp@fisip.net', '{\"Alamat Lengkap\":\"Indonesia\",\"Phone\":\"0818550122\"}');

-- --------------------------------------------------------

--
-- Table structure for table `bbc_account_temp`
--

CREATE TABLE `bbc_account_temp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(65) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `params` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bbc_alert`
--

CREATE TABLE `bbc_alert` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT '0' COMMENT 'user_id=0 && group_id=0 means all user',
  `group_id` int(11) DEFAULT '0' COMMENT '>0 for all members of the group',
  `module` varchar(60) DEFAULT NULL,
  `title` varchar(60) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `params` text,
  `is_open` tinyint(1) DEFAULT '0',
  `is_admin` tinyint(1) DEFAULT '3' COMMENT '0=memberlogin, 1=admin, 2=public, 3=any',
  `updated` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Jika ingin me-notif semua member dalam suatu group maka harus memasukkan satu2 tiap user_id dalam group tersebut, karena jika mengunakan group_id maka jika salah satu user dalam group_id tsb membuka maka alert untuk yg lain akan hilang';

-- --------------------------------------------------------

--
-- Table structure for table `bbc_async`
--

CREATE TABLE `bbc_async` (
  `id` int(11) UNSIGNED NOT NULL,
  `function` varchar(255) DEFAULT NULL,
  `arguments` text,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_async`
--

INSERT INTO `bbc_async` (`id`, `function`, `arguments`, `created`) VALUES
(606, '\"alert_push_send\"', '%5B606%2C0%5D', '2024-02-16 15:16:33'),
(607, '\"alert_push_send\"', '%5B607%2C0%5D', '2024-02-16 15:16:33'),
(1963, '\"alert_push_send\"', '%5B1963%2C0%5D', '2024-02-20 11:32:38'),
(1964, '\"alert_push_send\"', '%5B1964%2C0%5D', '2024-02-20 11:32:38'),
(1965, '\"alert_push_send\"', '%5B1965%2C0%5D', '2024-02-20 11:32:38'),
(1966, '\"alert_push_send\"', '%5B1966%2C0%5D', '2024-02-20 11:32:38'),
(2662, '\"alert_push_send\"', '%5B2947%2C0%5D', '2024-02-23 20:29:51'),
(2769, '\"alert_push_send\"', '%5B3054%2C0%5D', '2024-02-26 10:31:18'),
(2770, '\"alert_push_send\"', '%5B3055%2C0%5D', '2024-02-26 10:31:18'),
(2771, '\"alert_push_send\"', '%5B3056%2C0%5D', '2024-02-26 10:31:18'),
(3420, '\"alert_push_send\"', '%5B3705%2C0%5D', '2024-02-27 12:35:19'),
(3421, '\"alert_push_send\"', '%5B3706%2C0%5D', '2024-02-27 12:35:19'),
(3422, '\"alert_push_send\"', '%5B3707%2C0%5D', '2024-02-27 12:35:20'),
(3423, '\"alert_push_send\"', '%5B3708%2C0%5D', '2024-02-27 12:35:20'),
(3424, '\"alert_push_send\"', '%5B3709%2C0%5D', '2024-02-27 12:35:20'),
(4372, '\"alert_push_send\"', '%5B4656%2C0%5D', '2024-03-01 10:35:52'),
(4373, '\"alert_push_send\"', '%5B4657%2C0%5D', '2024-03-01 10:35:52'),
(5053, '\"alert_push_send\"', '%5B5336%2C0%5D', '2024-03-12 12:58:14'),
(5054, '\"alert_push_send\"', '%5B5337%2C0%5D', '2024-03-12 12:58:14'),
(5055, '\"alert_push_send\"', '%5B5338%2C0%5D', '2024-03-12 12:58:14'),
(5087, '\"alert_push_send\"', '%5B5370%2C0%5D', '2024-03-12 16:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `bbc_block`
--

CREATE TABLE `bbc_block` (
  `id` int(255) NOT NULL,
  `template_id` int(255) NOT NULL DEFAULT '0',
  `block_ref_id` int(255) DEFAULT NULL,
  `position_id` int(255) DEFAULT NULL,
  `show_title` tinyint(4) DEFAULT '0',
  `link` varchar(255) DEFAULT NULL,
  `cache` int(11) NOT NULL DEFAULT '0',
  `theme_id` int(255) DEFAULT NULL,
  `group_ids` varchar(255) DEFAULT NULL,
  `menu_ids` varchar(255) DEFAULT NULL,
  `menu_ids_blocked` varchar(255) DEFAULT NULL,
  `module_ids_allowed` varchar(255) DEFAULT NULL,
  `module_ids_blocked` varchar(255) DEFAULT NULL,
  `config` text,
  `orderby` int(255) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_block`
--

INSERT INTO `bbc_block` (`id`, `template_id`, `block_ref_id`, `position_id`, `show_title`, `link`, `cache`, `theme_id`, `group_ids`, `menu_ids`, `menu_ids_blocked`, `module_ids_allowed`, `module_ids_blocked`, `config`, `orderby`, `active`) VALUES
(1, 1, 4, 10, 0, '', 900, 1, ',all,', ',all,', '', '', '', '{\"content\":\"%3Ch1%3EIni+adalah+sample+atau+demo+produk+e-profile+untuk+Company+Profile+dari+fisip.net.+Design+tampilan+situs+bisa+diubah+sesuai+dengan+permintaan+anda.%3C%2Fh1%3E\",\"type\":\"none\"}', 1, 1),
(2, 1, 14, 7, 0, '', 900, 1, ',all,', ',all,', '', '', '', '{\"cat_id\":\"1\",\"template\":\"\"}', 1, 1),
(3, 1, 3, 9, 1, '', 900, 2, ',all,', ',-1,', '', '', '', '{\"template\":\"default\",\"kind_id\":\"-1\",\"type_id\":\"1\",\"cat_id\":\"1\",\"ids\":\"\",\"popular\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"intro\",\"created\":\"1\",\"modified\":\"1\",\"author\":\"1\",\"tag\":\"1\",\"tag_link\":\"1\",\"rating\":\"1\",\"read_more\":\"0\",\"tot_list\":\"2\",\"thumbnail\":\"1\"}', 2, 1),
(4, 1, 10, 3, 0, '', 0, 4, ',all,', ',all,', '', '', '', '{\"template\":\"menu-horizontal\",\"cat_id\":\"1\",\"submenu\":\"bottom+right\"}', 1, 1),
(5, 1, 9, 5, 0, '', 900, 1, ',all,', ',all,', '', '', '', '{\"image\":\"templates%2Fcampus_blue%2Fimages%2Fsite_logo.gif\",\"size\":\"\",\"is_link\":\"1\",\"link\":\"\",\"title\":\"\"}', 1, 1),
(6, 1, 10, 1, 0, '', 900, 4, ',all,', ',all,', '', '', '', '{\"template\":\"menu-vertical\",\"cat_id\":\"2\",\"submenu\":\"bottom+right\"}', 3, 0),
(7, 1, 6, 2, 0, '', 0, 3, ',all,', ',all,', '', '', '', '{\"task\":\"searchForm\",\"caption\":\"keyword+here...\"}', 1, 1),
(8, 1, 12, 2, 1, '', 0, 2, ',all,', ',all,', '', '', '', '{\"total_visit\":\"1\",\"total_member\":\"1\",\"member_online\":\"1\",\"user_online\":\"1\",\"active_days\":\"1\",\"start_days\":\"2014-11-14\",\"interval_time\":\"900\"}', 4, 1),
(9, 1, 2, 1, 1, '', 900, 2, ',all,', ',all,', '', '', '', '{\"template\":\"\",\"type\":\"default\"}', 4, 0),
(10, 1, 8, 1, 1, '', 0, 2, ',unassigned,', ',all,', '', '', '', '{\"forget\":\"1\",\"register\":\"1\"}', 1, 1),
(11, 1, 6, 8, 0, '', 0, 1, ',all,', ',all,', ',-1,', '', '', '{\"task\":\"Navigation\",\"caption\":\"\"}', 1, 1),
(12, 1, 7, 1, 1, '', 900, 2, ',all,', ',all,', '', '', '', '{\"show\":\"0\",\"limit\":\"4\"}', 6, 1),
(13, 1, 10, 1, 1, '', 900, 2, ',logged,', ',all,', '', '', '', '{\"template\":\"menu-vertical\",\"cat_id\":\"3\",\"submenu\":\"bottom+right\"}', 2, 1),
(14, 1, 1, 1, 0, '', 900, 3, ',all,', ',all,', '', '', '', '{\"type\":\"6\",\"show\":\"5\"}', 5, 1),
(15, 1, 10, 4, 0, '', 900, 5, ',all,', ',all,', '', '', '', '{\"template\":\"menu-horizontal\",\"cat_id\":\"2\",\"submenu\":\"top+left\"}', 1, 1),
(16, 1, 6, 11, 0, '', 0, 1, ',all,', ',all,', '', '', '', '{\"task\":\"debug\",\"caption\":\"\"}', 1, 1),
(17, 1, 11, 2, 1, '', 0, 2, ',all,', ',all,', '', '', '', '{\"ids\":[\"2\",\"1\"],\"limit\":\"1\"}', 3, 1),
(18, 1, 6, 2, 1, '', 0, 2, ',all,', ',all,', '', '', '', '{\"task\":\"templates\",\"caption\":\"\"}', 2, 1),
(19, 1, 3, 9, 0, '', 0, 1, ',all,', '', ',-1,', ',4,', '', '{\"type_id\":\"-1\",\"cat_id\":\"-1\",\"ids\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"template\":\"related\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"intro\",\"created\":\"1\",\"modified\":\"0\",\"author\":\"1\",\"tag\":\"0\",\"tag_link\":\"0\",\"rating\":\"1\",\"read_more\":\"1\",\"tot_list\":\"5\",\"thumbnail\":\"1\"}', 1, 1),
(20, 1, 13, 9, 1, '', 900, 2, ',all,', ',-1,', '', '', '', '{\"limit\":\"2\",\"avatar\":\"1\",\"orderby\":\"1\",\"readmore\":\"1\"}', 4, 1),
(21, 1, 4, 7, 0, '', 900, 1, ',all,', ',all,', '', '', '', '{\"content\":\"%3Cdiv+class%3D%22slidemask%22%3E%3C%2Fdiv%3E\",\"type\":\"none\"}', 2, 1),
(22, 6, 9, 3, 0, '', 0, 14, ',all,', ',all,', '', '', '', '{\"image\":\"templates%2Fcobweb_blue%2Fimages%2Fmain_image.jpg\",\"size\":\"\",\"is_link\":\"0\",\"link\":\"\",\"title\":\"\"}', 2, 1),
(23, 6, 4, 10, 0, '', 0, 13, ',all,', ',all,', '', '', '', '{\"content\":\"%3Ch1%3EIni+adalah+sample+atau+demo+produk+e-profile+untuk+Company+Profile+dari+fisip.net.+Design+tampilan+situs+bisa+diubah+sesuai+dengan+permintaan+anda.%3C%2Fh1%3E\",\"type\":\"none\"}', 1, 1),
(24, 6, 9, 7, 0, '', 0, 14, ',all,', ',all,', '', '', '', '{\"image\":\"templates%2Fcobweb_blue%2Fimages%2Fsite_logo.gif\",\"size\":\"\",\"is_link\":\"1\",\"link\":\"\",\"title\":\"\"}', 1, 1),
(25, 6, 13, 9, 1, '', 0, 9, ',all,', ',-1,', '', '', '', '{\"limit\":\"2\",\"avatar\":\"1\",\"orderby\":\"1\",\"readmore\":\"1\"}', 4, 1),
(26, 6, 3, 9, 0, '', 0, 12, ',all,', '', ',-1,', ',4,', '', '{\"type_id\":\"1\",\"cat_id\":\"4\",\"ids\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"template\":\"related\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"intro\",\"created\":\"1\",\"modified\":\"0\",\"author\":\"1\",\"tag\":\"0\",\"tag_link\":\"0\",\"rating\":\"1\",\"read_more\":\"1\",\"tot_list\":\"5\",\"thumbnail\":\"1\"}', 1, 1),
(27, 6, 10, 1, 0, '', 0, 7, ',all,', ',all,', '', '', '', '{\"template\":\"menu-vertical\",\"cat_id\":\"2\",\"submenu\":\"bottom+right\"}', 1, 1),
(28, 6, 10, 3, 0, '', 0, 10, ',all,', ',all,', '', '', '', '{\"template\":\"menu-horizontal\",\"cat_id\":\"1\",\"submenu\":\"bottom+right\"}', 1, 1),
(29, 6, 3, 9, 1, '', 0, 12, ',all,', ',-1,', '', '', '', '{\"type_id\":\"1\",\"cat_id\":\"3\",\"ids\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"template\":\"content\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"intro\",\"created\":\"1\",\"modified\":\"1\",\"author\":\"1\",\"tag\":\"1\",\"tag_link\":\"1\",\"rating\":\"1\",\"read_more\":\"1\",\"tot_list\":\"2\",\"thumbnail\":\"1\"}', 2, 1),
(30, 6, 10, 2, 1, '', 0, 16, ',logged,', ',all,', '', '', '', '{\"template\":\"menu-vertical\",\"cat_id\":\"3\",\"submenu\":\"bottom+left\"}', 2, 1),
(31, 6, 8, 2, 1, '', 0, 11, ',unassigned,', ',all,', '', '', '', '{\"forget\":\"1\",\"register\":\"1\"}', 3, 1),
(32, 6, 6, 8, 0, '', 0, 13, ',all,', ',all,', ',-1,', '', '', '{\"task\":\"Navigation\",\"caption\":\"\"}', 1, 1),
(33, 6, 2, 1, 1, '', 0, 11, ',all,', ',all,', '', '', '', '', 4, 1),
(34, 6, 12, 2, 1, '', 0, 11, ',all,', ',all,', '', '', '', '{\"total_visit\":\"1\",\"total_member\":\"1\",\"member_online\":\"1\",\"user_online\":\"1\",\"active_days\":\"1\",\"start_days\":\"2014-11-14\",\"interval_time\":\"900\"}', 5, 1),
(35, 6, 10, 4, 0, '', 0, 8, ',all,', ',all,', '', '', '', '{\"template\":\"menu-horizontal\",\"cat_id\":\"2\",\"submenu\":\"top+right\"}', 1, 1),
(36, 6, 7, 1, 1, '', 0, 11, ',all,', ',all,', '', '', '', '{\"show\":\"0\",\"limit\":\"4\"}', 3, 1),
(37, 6, 1, 1, 0, '', 0, 6, ',all,', ',all,', '', '', '', '{\"type\":\"6\",\"show\":\"5\"}', 2, 1),
(38, 6, 6, 11, 0, '', 0, 13, ',all,', ',all,', '', '', '', '{\"task\":\"debug\",\"caption\":\"\"}', 1, 1),
(39, 6, 6, 2, 1, '', 0, 11, ',all,', ',all,', '', '', '', '{\"task\":\"templates\",\"caption\":\"\"}', 1, 1),
(40, 6, 11, 2, 1, '', 0, 11, ',all,', ',all,', '', '', '', '{\"ids\":[\"2\",\"1\"],\"limit\":\"1\"}', 4, 1),
(41, 6, 6, 5, 0, '', 0, 15, ',all,', ',all,', '', '', '', '{\"task\":\"searchForm\",\"caption\":\"Keyword+here....\"}', 1, 1),
(42, 2, 4, 10, 0, '', 0, 17, ',all,', ',all,', '', '', '', '{\"content\":\"%3Ch1%3EIni+adalah+sample+atau+demo+produk+e-profile+untuk+Company+Profile+dari+fisip.net.+Design+tampilan+situs+bisa+diubah+sesuai+dengan+permintaan+anda.%3C%2Fh1%3E\",\"type\":\"none\"}', 1, 1),
(43, 2, 3, 9, 1, '', 0, 21, ',all,', ',-1,', '', '', '', '{\"type_id\":\"1\",\"cat_id\":\"1\",\"ids\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"template\":\"default\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"intro\",\"created\":\"1\",\"modified\":\"1\",\"author\":\"1\",\"tag\":\"1\",\"tag_link\":\"1\",\"rating\":\"1\",\"read_more\":\"0\",\"tot_list\":\"2\",\"thumbnail\":\"1\"}', 1, 1),
(44, 2, 10, 3, 0, '', 0, 19, ',all,', ',all,', '', '', '', '{\"template\":\"menu-horizontal\",\"cat_id\":\"1\",\"submenu\":\"bottom+right\"}', 1, 1),
(45, 2, 9, 7, 0, '', 0, 17, ',all,', ',all,', '', '', '', '{\"image\":\"templates%2Flogistic_transport%2Fimages%2Flogo.gif\",\"size\":\"\",\"is_link\":\"1\",\"link\":\"\",\"title\":\"\"}', 1, 1),
(46, 2, 10, 1, 1, '', 0, 20, ',all,', ',all,', '', '', '', '{\"cat_id\":\"1\",\"layout\":\"vertical\",\"submenu\":\"bottom+right\"}', 3, 0),
(47, 2, 6, 3, 0, '', 0, 18, ',all,', ',all,', '', '', '', '{\"task\":\"searchForm\",\"caption\":\"keyword+here...\"}', 2, 1),
(48, 2, 12, 1, 1, '', 900, 20, ',all,', ',all,', '', '', '', '{\"total_visit\":\"1\",\"total_member\":\"1\",\"member_online\":\"1\",\"user_online\":\"1\",\"active_days\":\"1\",\"start_days\":\"07%2F25%2F2010\",\"interval_time\":\"900\"}', 7, 1),
(49, 2, 2, 1, 1, '', 900, 20, ',all,', ',all,', '', '', '', '', 5, 1),
(50, 2, 6, 8, 0, '', 0, 17, ',all,', ',all,', ',-1,', '', '', '{\"task\":\"Navigation\",\"caption\":\"\"}', 2, 1),
(51, 2, 7, 1, 1, '', 900, 20, ',all,', ',all,', '', '', '', '{\"show\":\"0\",\"limit\":\"4\"}', 4, 1),
(52, 2, 10, 1, 1, '', 0, 20, ',logged,', ',all,', '', '', '', '{\"template\":\"menu-vertical\",\"cat_id\":\"3\",\"submenu\":\"bottom+left\"}', 2, 1),
(53, 2, 10, 4, 0, '', 0, 17, ',all,', ',all,', '', '', '', '{\"template\":\"menu-horizontal\",\"cat_id\":\"2\",\"submenu\":\"top+right\"}', 1, 1),
(54, 2, 6, 11, 0, '', 0, 17, ',all,', ',all,', '', '', '', '{\"task\":\"debug\",\"caption\":\"\"}', 1, 1),
(55, 2, 11, 1, 1, '', 900, 20, ',all,', ',all,', '', '', '', '{\"ids\":[\"2\",\"1\"],\"limit\":\"1\"}', 6, 1),
(56, 2, 6, 1, 1, '', 0, 20, ',all,', ',all,', '', '', '', '{\"task\":\"templates\",\"caption\":\"\"}', 1, 1),
(57, 2, 9, 5, 0, '', 0, 17, ',all,', ',all,', '', '', '', '{\"image\":\"templates%2Flogistic_transport%2Fimages%2Fheader.jpg\",\"size\":\"\",\"is_link\":\"0\",\"link\":\"\",\"title\":\"\"}', 1, 1),
(58, 2, 3, 8, 0, '', 0, 20, ',all,', '', ',-1,', ',4,', '', '{\"type_id\":\"-1\",\"cat_id\":\"-1\",\"ids\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"template\":\"related\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"intro\",\"created\":\"1\",\"modified\":\"1\",\"author\":\"1\",\"tag\":\"0\",\"tag_link\":\"0\",\"rating\":\"1\",\"read_more\":\"1\",\"tot_list\":\"5\",\"thumbnail\":\"1\"}', 1, 1),
(59, 2, 13, 9, 1, '', 0, 20, ',all,', ',all,', '', '', '', '{\"limit\":\"2\",\"avatar\":\"1\",\"orderby\":\"1\",\"readmore\":\"0\"}', 3, 1),
(60, 3, 4, 10, 0, '', 0, 22, ',all,', ',all,', '', '', '', '{\"content\":\"%3Ch1%3EIni+adalah+sample+atau+demo+produk+e-profile+untuk+Company+Profile+dari+fisip.net.+Design+tampilan+situs+bisa+diubah+sesuai+dengan+permintaan+anda.%3C%2Fh1%3E\",\"type\":\"none\"}', 1, 1),
(61, 3, 3, 9, 1, '', 0, 26, ',all,', ',-1,', '', '', '', '{\"type_id\":\"1\",\"cat_id\":\"1\",\"ids\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"template\":\"content\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"intro\",\"created\":\"1\",\"modified\":\"1\",\"author\":\"1\",\"tag\":\"1\",\"tag_link\":\"1\",\"rating\":\"1\",\"read_more\":\"0\",\"tot_list\":\"2\",\"thumbnail\":\"1\"}', 1, 1),
(62, 3, 10, 3, 0, '', 0, 22, ',all,', ',all,', '', '', '', '{\"template\":\"menu-horizontal\",\"cat_id\":\"2\",\"submenu\":\"bottom+right\"}', 1, 1),
(63, 3, 9, 7, 0, '', 0, 22, ',all,', ',all,', '', '', '', '{\"image\":\"templates%2Fcloudy_season%2Fimages%2Flogo.gif\",\"size\":\"\",\"is_link\":\"1\",\"link\":\"\",\"title\":\"\"}', 1, 1),
(64, 3, 6, 5, 0, '', 0, 23, ',all,', ',all,', '', '', '', '{\"template\":\"searchForm\",\"caption\":\"keyword+here...\"}', 1, 1),
(65, 3, 12, 2, 1, '', 900, 25, ',all,', ',all,', '', '', '', '{\"total_visit\":\"1\",\"total_member\":\"1\",\"member_online\":\"1\",\"user_online\":\"1\",\"active_days\":\"1\",\"start_days\":\"07%2F25%2F2010\",\"interval_time\":\"900\"}', 5, 1),
(66, 3, 2, 1, 1, '', 900, 25, ',all,', ',all,', '', '', '', '', 2, 1),
(67, 3, 6, 8, 0, '', 0, 22, ',all,', ',all,', ',-1,', '', '', '{\"task\":\"Navigation\",\"caption\":\"\"}', 1, 1),
(68, 3, 7, 1, 1, '', 900, 25, ',all,', ',all,', '', '', '', '{\"show\":\"0\",\"limit\":\"4\"}', 5, 1),
(69, 3, 10, 1, 1, '', 0, 25, ',logged,', ',all,', '', '', '', '{\"template\":\"menu-vertical\",\"cat_id\":\"3\",\"submenu\":\"bottom+right\"}', 1, 1),
(70, 3, 1, 1, 1, '', 900, 25, ',all,', ',all,', '', '', '', '{\"type\":\"6\",\"show\":\"5\"}', 3, 1),
(71, 3, 10, 4, 0, '', 0, 22, ',all,', ',all,', '', '', '', '{\"template\":\"menu-horizontal\",\"cat_id\":\"1\",\"submenu\":\"top+right\"}', 1, 1),
(72, 3, 6, 11, 0, '', 0, 22, ',all,', ',all,', '', '', '', '{\"task\":\"debug\",\"caption\":\"\"}', 1, 1),
(73, 3, 11, 2, 1, '', 900, 25, ',all,', ',all,', '', '', '', '{\"ids\":[\"2\",\"1\"],\"limit\":\"1\"}', 3, 1),
(74, 3, 6, 2, 1, '', 0, 25, ',all,', ',all,', '', '', '', '{\"task\":\"templates\",\"caption\":\"\"}', 1, 1),
(75, 3, 9, 1, 0, '', 0, 24, ',all,', ',-1,', '', '', '', '{\"template\":\"\",\"image\":\"templates%2Fcloudy_season%2Fimages%2Funicef.jpg\",\"size\":\"\",\"is_link\":\"0\",\"link\":\"\",\"title\":\"\",\"attribute\":\"\"}', 6, 1),
(76, 3, 8, 2, 1, '', 0, 25, ',unassigned,', ',all,', '', '', '', '{\"forget\":\"1\",\"register\":\"1\"}', 2, 1),
(77, 3, 1, 1, 1, '', 900, 25, ',unassigned,', ',all,', '', '', '', '{\"template\":\"\",\"type\":\"1\",\"show\":\"5\"}', 4, 1),
(78, 3, 3, 12, 0, '', 0, 26, ',all,', '', ',-1,', ',4,', '', '{\"type_id\":\"-1\",\"cat_id\":\"-1\",\"ids\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"template\":\"related\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"intro\",\"created\":\"1\",\"modified\":\"1\",\"author\":\"1\",\"tag\":\"0\",\"tag_link\":\"0\",\"rating\":\"1\",\"read_more\":\"0\",\"tot_list\":\"5\",\"thumbnail\":\"1\"}', 1, 1),
(79, 3, 13, 9, 1, '', 900, 25, ',all,', ',-1,', '', '', '', '{\"template\":\"\",\"limit\":\"2\",\"avatar\":\"1\",\"orderby\":\"1\",\"readmore\":\"0\"}', 3, 1),
(80, 3, 1, 2, 1, '', 900, 25, ',logged,', ',all,', '', '', '', '{\"template\":\"\",\"type\":\"1\",\"show\":\"5\"}', 4, 1),
(81, 4, 3, 12, 1, '', 0, 28, ',all,', ',-1,', '', '', '', '{\"template\":\"default\",\"type_id\":\"1\",\"cat_id\":\"1\",\"ids\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"intro\",\"created\":\"1\",\"modified\":\"1\",\"author\":\"1\",\"tag\":\"1\",\"tag_link\":\"1\",\"rating\":\"1\",\"read_more\":\"0\",\"tot_list\":\"2\",\"thumbnail\":\"1\"}', 2, 1),
(82, 4, 10, 3, 0, '', 0, 30, ',all,', ',all,', '', '', '', '{\"cat_id\":\"1\",\"layout\":\"horizontal\",\"submenu\":\"bottom+right\"}', 1, 1),
(83, 4, 9, 7, 0, '', 0, 27, ',all,', ',all,', '', '', '', '{\"image\":\"templates%2Fgreen_accountant%2Fimages%2Flogo.png\",\"size\":\"\",\"is_link\":\"1\",\"link\":\"\",\"title\":\"\"}', 1, 1),
(84, 4, 6, 5, 0, '', 0, 29, ',all,', ',all,', '', '', '', '{\"task\":\"searchForm\",\"caption\":\"keyword+here...\"}', 2, 1),
(85, 4, 12, 2, 1, '', 900, 28, ',all,', ',all,', '', '', '', '{\"template\":\"\",\"total_visit\":\"1\",\"total_member\":\"1\",\"member_online\":\"1\",\"user_online\":\"1\",\"active_days\":\"1\",\"start_days\":\"07%2F25%2F2010\",\"interval_time\":\"900\"}', 4, 1),
(86, 4, 2, 1, 1, '', 900, 28, ',all,', ',all,', '', '', '', '{\"template\":\"\",\"type\":\"default\"}', 3, 1),
(87, 4, 6, 8, 0, '', 0, 27, ',all,', ',all,', ',-1,', '', '', '{\"task\":\"Navigation\",\"caption\":\"\"}', 1, 1),
(88, 4, 7, 1, 1, '', 900, 27, ',all,', ',all,', '', '', '', '{\"template\":\"\",\"show\":\"0\",\"limit\":\"3\"}', 4, 1),
(89, 4, 1, 1, 0, '', 900, 28, ',all,', ',all,', '', '', '', '{\"template\":\"\",\"type\":\"6\",\"show\":\"5\"}', 2, 1),
(90, 4, 6, 11, 0, '', 0, 27, ',all,', ',all,', '', '', '', '{\"task\":\"debug\",\"caption\":\"\"}', 1, 1),
(91, 4, 11, 2, 1, '', 900, 28, ',all,', ',all,', '', '', '', '{\"template\":\"\",\"ids\":[\"2\",\"1\"],\"limit\":\"1\"}', 3, 1),
(92, 4, 6, 2, 1, '', 0, 28, ',all,', ',all,', '', '', '', '{\"task\":\"templates\",\"caption\":\"\"}', 1, 1),
(93, 4, 9, 5, 0, '', 0, 27, ',all,', ',all,', '', '', '', '{\"image\":\"templates%2Fgreen_accountant%2Fimages%2Fimg-header.jpg\",\"size\":\"\",\"is_link\":\"0\",\"link\":\"\",\"title\":\"\"}', 1, 1),
(94, 4, 8, 2, 1, '', 0, 27, ',all,', ',all,', '', '', '', '{\"template\":\"\",\"forget\":\"1\",\"register\":\"1\"}', 2, 1),
(95, 4, 10, 4, 0, '', 0, 27, ',all,', ',all,', '', '', '', '{\"template\":\"menu-horizontal\",\"cat_id\":\"2\",\"submenu\":\"top+right\"}', 1, 1),
(96, 4, 4, 10, 0, '', 0, 27, ',all,', ',all,', '', '', '', '{\"content\":\"%3Ch1%3EIni+adalah+sample+atau+demo+produk+e-profile+untuk+Company+Profile+dari+fisip.net.+Design+tampilan+situs+bisa+diubah+sesuai+dengan+permintaan+anda.%3C%2Fh1%3E\",\"type\":\"none\"}', 1, 1),
(97, 4, 3, 12, 1, '', 0, 27, ',all,', '', ',-1,', ',4,', '', '{\"template\":\"related\",\"type_id\":\"-1\",\"cat_id\":\"-1\",\"ids\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"intro\",\"created\":\"1\",\"modified\":\"1\",\"author\":\"1\",\"tag\":\"0\",\"tag_link\":\"0\",\"rating\":\"1\",\"read_more\":\"0\",\"tot_list\":\"5\",\"thumbnail\":\"1\"}', 1, 1),
(98, 5, 4, 10, 0, '', 0, 31, ',all,', ',all,', '', '', '', '{\"content\":\"%3Ch1%3EIni+adalah+sample+atau+demo+produk+e-profile+untuk+Company+Profile+dari+fisip.net.+Design+tampilan+situs+bisa+diubah+sesuai+dengan+permintaan+anda.%3C%2Fh1%3E\",\"type\":\"none\"}', 1, 1),
(99, 5, 3, 9, 1, '', 0, 32, ',all,', ',-1,', '', '', '', '{\"template\":\"related\",\"type_id\":\"1\",\"cat_id\":\"1\",\"ids\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"intro\",\"created\":\"1\",\"modified\":\"1\",\"author\":\"1\",\"tag\":\"1\",\"tag_link\":\"1\",\"rating\":\"1\",\"read_more\":\"0\",\"tot_list\":\"2\",\"thumbnail\":\"1\"}', 1, 1),
(100, 5, 10, 3, 0, '', 0, 33, ',all,', ',all,', '', '', '', '{\"template\":\"menu-horizontal\",\"cat_id\":\"1\",\"submenu\":\"bottom+right\"}', 1, 1),
(101, 5, 9, 7, 0, '', 0, 31, ',all,', ',all,', '', '', '', '{\"image\":\"templates%2Fdark_style%2Fimages%2Fsite_logo.gif\",\"size\":\"\",\"is_link\":\"1\",\"link\":\"\",\"title\":\"\"}', 1, 1),
(102, 5, 6, 5, 0, '', 0, 36, ',all,', ',all,', '', '', '', '{\"template\":\"searchForm\",\"caption\":\"keyword+here...\"}', 1, 1),
(103, 5, 12, 2, 1, '', 900, 32, ',all,', ',all,', '', '', '', '{\"template\":\"\",\"total_visit\":\"1\",\"total_member\":\"1\",\"member_online\":\"1\",\"user_online\":\"1\",\"active_days\":\"1\",\"start_days\":\"07%2F25%2F2010\",\"interval_time\":\"900\"}', 4, 1),
(104, 5, 2, 1, 1, '', 900, 32, ',all,', ',all,', '', '', '', '{\"template\":\"\",\"type\":\"default\"}', 1, 1),
(105, 5, 6, 8, 0, '', 0, 31, ',all,', ',all,', ',-1,', '', '', '{\"template\":\"Navigation\",\"caption\":\"\"}', 1, 1),
(106, 5, 7, 1, 1, '', 900, 32, ',all,', ',all,', '', '', '', '{\"template\":\"\",\"show\":\"0\",\"limit\":\"4\"}', 4, 1),
(107, 5, 10, 1, 0, '', 0, 31, ',logged,', ',all,', '', '', '', '{\"template\":\"menu-vertical\",\"cat_id\":\"3\",\"submenu\":\"bottom+right\"}', 2, 1),
(108, 5, 1, 1, 1, '', 900, 32, ',all,', ',all,', '', '', '', '{\"template\":\"\",\"type\":\"6\",\"show\":\"5\"}', 3, 1),
(109, 5, 10, 4, 0, '', 0, 34, ',all,', ',all,', '', '', '', '{\"template\":\"menu-horizontal\",\"cat_id\":\"2\",\"submenu\":\"top+right\"}', 1, 1),
(110, 5, 6, 11, 0, '', 0, 31, ',all,', ',all,', '', '', '', '{\"task\":\"debug\",\"caption\":\"\"}', 1, 1),
(111, 5, 11, 2, 1, '', 900, 32, ',all,', ',all,', '', '', '', '{\"template\":\"\",\"ids\":[\"2\",\"1\"],\"limit\":\"1\"}', 3, 1),
(112, 5, 6, 2, 1, '', 0, 32, ',all,', ',all,', '', '', '', '{\"template\":\"templates\",\"caption\":\"\"}', 1, 1),
(113, 5, 9, 1, 0, '', 0, 35, ',all,', ',-1,', '', '', '', '{\"template\":\"\",\"image\":\"images%2Fuploads%2Funicef.jpg\",\"size\":\"\",\"is_link\":\"0\",\"link\":\"\",\"title\":\"\",\"attribute\":\"\"}', 5, 1),
(114, 5, 8, 2, 1, '', 0, 32, ',all,', ',all,', '', '', '', '{\"template\":\"\",\"forget\":\"1\",\"register\":\"1\"}', 2, 1),
(115, 5, 3, 12, 0, '', 0, 31, ',all,', '', ',-1,', ',4,', '', '{\"template\":\"related\",\"type_id\":\"-1\",\"cat_id\":\"-1\",\"ids\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"intro\",\"created\":\"1\",\"modified\":\"1\",\"author\":\"1\",\"tag\":\"0\",\"tag_link\":\"0\",\"rating\":\"1\",\"read_more\":\"0\",\"tot_list\":\"5\",\"thumbnail\":\"1\"}', 1, 1),
(116, 1, 3, 9, 1, '', 0, 2, ',all,', ',-1,', '', '', '', '{\"template\":\"thumbnail-only\",\"kind_id\":\"1\",\"type_id\":\"1\",\"cat_id\":\"-2\",\"ids\":\"\",\"popular\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"blank\",\"created\":\"0\",\"modified\":\"0\",\"author\":\"0\",\"tag\":\"0\",\"tag_link\":\"0\",\"rating\":\"0\",\"read_more\":\"0\",\"tot_list\":\"3\",\"thumbnail\":\"1\"}', 3, 1),
(117, 2, 3, 9, 1, '', 900, 21, ',all,', ',-1,', '', '', '', '{\"template\":\"thumbnail-only\",\"kind_id\":\"1\",\"type_id\":\"1\",\"cat_id\":\"-2\",\"ids\":\"\",\"popular\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"title\":\"0\",\"title_link\":\"0\",\"intro\":\"blank\",\"created\":\"0\",\"modified\":\"0\",\"author\":\"0\",\"tag\":\"0\",\"tag_link\":\"0\",\"rating\":\"0\",\"read_more\":\"0\",\"tot_list\":\"3\",\"thumbnail\":\"0\"}', 2, 1),
(118, 3, 3, 9, 1, '', 900, 25, ',all,', ',-1,', '', '', '', '{\"template\":\"thumbnail-only\",\"kind_id\":\"1\",\"type_id\":\"1\",\"cat_id\":\"-2\",\"ids\":\"\",\"popular\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"title\":\"0\",\"title_link\":\"0\",\"intro\":\"blank\",\"created\":\"0\",\"modified\":\"0\",\"author\":\"0\",\"tag\":\"0\",\"tag_link\":\"0\",\"rating\":\"0\",\"read_more\":\"0\",\"tot_list\":\"3\",\"thumbnail\":\"0\"}', 2, 1),
(119, 6, 3, 9, 1, '', 900, 12, ',all,', ',-1,', '', '', '', '{\"template\":\"thumbnail-only\",\"kind_id\":\"1\",\"type_id\":\"1\",\"cat_id\":\"-2\",\"ids\":\"\",\"popular\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"title\":\"0\",\"title_link\":\"0\",\"intro\":\"intro\",\"created\":\"0\",\"modified\":\"0\",\"author\":\"0\",\"tag\":\"0\",\"tag_link\":\"0\",\"rating\":\"0\",\"read_more\":\"0\",\"tot_list\":\"3\",\"thumbnail\":\"0\"}', 3, 1),
(120, 4, 3, 9, 0, '', 900, 27, ',all,', ',-1,', '', '', '', '{\"template\":\"thumbnail-only\",\"kind_id\":\"1\",\"type_id\":\"1\",\"cat_id\":\"-2\",\"ids\":\"\",\"popular\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"title\":\"0\",\"title_link\":\"0\",\"intro\":\"intro\",\"created\":\"0\",\"modified\":\"0\",\"author\":\"0\",\"tag\":\"0\",\"tag_link\":\"0\",\"rating\":\"0\",\"read_more\":\"0\",\"tot_list\":\"3\",\"thumbnail\":\"0\"}', 1, 1),
(121, 4, 10, 1, 0, '', 0, 27, ',logged,', ',all,', '', '', '', '{\"template\":\"menu-vertical\",\"cat_id\":\"3\",\"submenu\":\"bottom+right\"}', 1, 1),
(125, 7, 10, 5, 1, '', 0, 37, ',all,', ',all,', '', '', '', '{\"template\":\"menu_top\",\"cat_id\":\"1\",\"submenu\":\"bottom+right\"}', 2, 1),
(126, 7, 9, 5, 1, '', 0, 37, ',all,', ',all,', '', '', '', '{\"template\":\"logo\",\"image\":\"images%2Fuploads%2FSCHOOL2.png\",\"size\":\"\",\"is_link\":\"1\",\"link\":\"\",\"title\":\"\",\"attribute\":\"\"}', 1, 1),
(127, 7, 14, 8, 1, '', 0, 37, ',all,', ',all,', '', '', '', '{\"template\":\"\",\"cat_id\":\"1\",\"caption\":\"1\",\"indicator\":\"1\",\"control\":\"1\"}', 1, 1),
(129, 7, 12, 9, 1, '', 0, 37, ',all,', ',all,', '', '', '', '{\"template\":\"\",\"total_visit\":\"1\",\"total_member\":\"1\",\"member_online\":\"1\",\"user_online\":\"1\",\"active_days\":\"1\",\"start_days\":\"\",\"interval_time\":\"900\"}', 1, 1),
(130, 7, 10, 6, 1, '', 0, 37, ',all,', ',all,', '', '', '', '{\"template\":\"menu_bottom\",\"cat_id\":\"2\",\"submenu\":\"bottom+right\"}', 3, 1),
(133, 7, 13, 9, 1, '', 0, 37, ',all,', ',all,', '', '', '', '{\"template\":\"testimonial\",\"limit\":\"2\",\"avatar\":\"1\",\"orderby\":\"1\",\"readmore\":\"0\"}', 3, 1),
(135, 7, 9, 9, 1, '', 0, 37, ',all,', ',all,', '', '', '', '{\"template\":\"logo_bot\",\"image\":\"\",\"size\":\"\",\"is_link\":\"1\",\"link\":\"\",\"title\":\"Enroll\",\"attribute\":\"\"}', 4, 1),
(136, 7, 3, 9, 1, '', 0, 37, ',all,', ',all,', '', '', '', '{\"template\":\"courses\",\"kind_id\":\"-1\",\"type_id\":\"1\",\"cat_id\":\"1\",\"ids\":\"\",\"popular\":\"\",\"limit_title\":\"75\",\"limit_title_by\":\"char\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"intro\",\"created\":\"1\",\"modified\":\"1\",\"author\":\"1\",\"tag\":\"1\",\"tag_link\":\"1\",\"rating\":\"1\",\"read_more\":\"1\",\"tot_list\":\"5\",\"thumbnail\":\"0\"}', 2, 1),
(138, 7, 19, 6, 1, '', 0, 37, ',all,', ',all,', '', '', '', '{\"template\":\"sosmed_bot\",\"caption\":\"Lorem+ipsum+dolor+sit+amet+consectetur+adipisicing+elit.+Porro+provident+suscipit+natus+a+cupiditate+ab+minus+illum+quaerat+maxime+inventore+Ea+consequatur+consectetur+hic+provident+dolor+ab+aliquam+eveniet+alias\",\"facebook\":\"https%3A%2F%2Fwww.facebook.com%2F\",\"twitter\":\"https%3A%2F%2Ftwitter.com%2F\",\"youtube\":\"https%3A%2F%2Fwww.youtube.com%2F\",\"instagram\":\"https%3A%2F%2Fwww.instagram.com%2F\",\"search\":\"Search+a+keyword+and+hit+enter...\"}', 1, 1),
(139, 7, 17, 6, 1, '', 0, 37, ',all,', ',all,', '', '', '', '{\"template\":\"contact_info_bot\",\"location\":\"Brooklyn%2C+NY+10036%2C+United+States\",\"phone\":\"%2B1-123-456-7890\",\"mail\":\"info%40probootstrap.com\"}', 2, 1),
(140, 7, 17, 10, 1, '', 0, 37, ',all,', ',all,', '', '', '', '{\"template\":\"default\",\"location\":\"Brooklyn%2C+NY+10036%2C+United+States\",\"phone\":\"%2B1-123-456-7890\",\"mail\":\"info%40probootstrap.com\"}', 1, 1),
(141, 7, 19, 10, 1, '', 0, 37, ',all,', ',all,', '', '', '', '{\"template\":\"default\",\"caption\":\"Lorem+ipsum+dolor+sit+amet+consectetur+adipisicing+elit.+Porro+provident+suscipit+natus+a+cupiditate+ab+minus+illum+quaerat+maxime+inventore+Ea+consequatur+consectetur+hic+provident+dolor+ab+aliquam+eveniet+alias\",\"facebook\":\"https%3A%2F%2Fwww.facebook.com%2F\",\"twitter\":\"https%3A%2F%2Ftwitter.com%2F\",\"youtube\":\"https%3A%2F%2Fwww.youtube.com%2F\",\"instagram\":\"https%3A%2F%2Fwww.instagram.com%2F\",\"search\":\"Search+a+keyword+and+hit+enter...\"}', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_block_position`
--

CREATE TABLE `bbc_block_position` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_block_position`
--

INSERT INTO `bbc_block_position` (`id`, `name`) VALUES
(1, 'left'),
(2, 'right'),
(3, 'top'),
(4, 'bottom'),
(5, 'header'),
(6, 'footer'),
(7, 'logo'),
(8, 'content_top'),
(9, 'content_bottom'),
(10, 'intro'),
(11, 'debug'),
(12, 'content'),
(16, 'teacher_dashboard'),
(17, 'student_dashboard'),
(18, 'teacher_navbar'),
(19, 'student_navbar');

-- --------------------------------------------------------

--
-- Table structure for table `bbc_block_ref`
--

CREATE TABLE `bbc_block_ref` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_block_ref`
--

INSERT INTO `bbc_block_ref` (`id`, `name`) VALUES
(1, 'agenda'),
(2, 'contact'),
(17, 'contact_info'),
(3, 'content'),
(15, 'content_list'),
(16, 'content_tag'),
(4, 'custom'),
(18, 'highlights'),
(14, 'imageslider'),
(5, 'language'),
(6, 'layout'),
(7, 'links'),
(8, 'login'),
(9, 'logo'),
(10, 'menu'),
(19, 'sosmed'),
(12, 'statistic'),
(11, 'survey'),
(13, 'testimonial');

-- --------------------------------------------------------

--
-- Table structure for table `bbc_block_text`
--

CREATE TABLE `bbc_block_text` (
  `block_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `lang_id` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_block_text`
--

INSERT INTO `bbc_block_text` (`block_id`, `title`, `lang_id`) VALUES
(1, 'Intro', 1),
(2, 'Image Slider', 1),
(3, 'Hotline News', 1),
(4, 'Menu Top', 1),
(5, 'Logo', 1),
(6, 'Left Menu', 1),
(7, 'Search :', 1),
(8, 'Statistic', 1),
(9, 'Online Support', 1),
(10, 'Member Login', 1),
(11, 'Navigation', 1),
(12, 'Links', 1),
(13, 'User Menu', 1),
(14, 'Agenda', 1),
(15, 'Menu Bottom', 1),
(16, 'Debug', 1),
(17, 'Polling', 1),
(18, 'Pilih Template', 1),
(19, 'Artikel Berhubungan', 1),
(20, 'Testimonial', 1),
(21, 'masking', 1),
(22, 'Banner', 1),
(23, 'Intro', 1),
(24, 'Company Logo', 1),
(25, '<h3>Testimonial</h3>', 1),
(26, 'Artikel Berhubungan', 1),
(27, 'Left Menu', 1),
(28, 'Menu Top', 1),
(29, 'Hotline News', 1),
(30, 'User Menu', 1),
(31, 'Member Login', 1),
(32, 'Navigation', 1),
(33, 'Online Support', 1),
(34, 'Statistic', 1),
(35, 'Menu Bottom', 1),
(36, 'Links', 1),
(37, 'Agenda', 1),
(38, 'Debug', 1),
(39, 'Pilih Template', 1),
(40, 'Polling', 1),
(41, 'Search', 1),
(42, 'Intro', 1),
(43, 'Hotline News', 1),
(44, 'Menu Top', 1),
(45, 'Logo', 1),
(46, 'Left Menu', 1),
(47, 'Search :', 1),
(48, 'Statistic', 1),
(49, 'Online Support', 1),
(50, 'Navigation', 1),
(51, 'Links', 1),
(52, 'User Menu', 1),
(53, 'Menu Bottom', 1),
(54, 'Debug', 1),
(55, 'Polling', 1),
(56, 'Pilih Template', 1),
(57, 'Header', 1),
(58, 'Artikel Berhubungan', 1),
(59, 'Testimoni', 1),
(60, 'Intro', 1),
(61, 'Hotline News', 1),
(62, 'Menu Top', 1),
(63, 'Logo', 1),
(64, 'Search :', 1),
(65, 'Statistic', 1),
(66, 'Online Support', 1),
(67, 'Navigation', 1),
(68, 'Links', 1),
(69, 'User Menu', 1),
(70, 'Agenda', 1),
(71, 'Menu Bottom', 1),
(72, 'Debug', 1),
(73, 'Polling', 1),
(74, 'Pilih Template', 1),
(75, 'Unicef Ad', 1),
(76, 'Member Login', 1),
(77, 'Event', 1),
(78, 'Artikel Berhubungan', 1),
(79, 'Testimonial', 1),
(80, 'Event', 1),
(81, 'Hotline News', 1),
(82, 'Menu Top', 1),
(83, 'Logo', 1),
(84, 'Search :', 1),
(85, 'Statistic', 1),
(86, 'Online Support', 1),
(87, 'Navigation', 1),
(88, 'Links', 1),
(89, 'Agenda', 1),
(90, 'Debug', 1),
(91, 'Polling', 1),
(92, 'Pilih Template', 1),
(93, 'Header', 1),
(94, 'Member Login', 1),
(95, 'Bottom Menu', 1),
(96, 'Intro', 1),
(97, 'Artikel Berhubungan', 1),
(98, 'Intro', 1),
(99, 'Hotline News', 1),
(100, 'Menu Top', 1),
(101, 'Logo', 1),
(102, 'Search :', 1),
(103, 'Statistic', 1),
(104, 'Online Support', 1),
(105, 'Navigation', 1),
(106, 'Links', 1),
(107, 'User Menu', 1),
(108, 'Agenda', 1),
(109, 'Menu Bottom', 1),
(110, 'Debug', 1),
(111, 'Polling', 1),
(112, 'Pilih Template', 1),
(113, 'Header', 1),
(114, 'Member Login', 1),
(115, 'Artikel Berhubungan', 1),
(116, 'Gallery', 1),
(117, 'Gallery', 1),
(118, 'Gallery', 1),
(119, 'Gallery', 1),
(120, 'Gallery', 1),
(121, 'User menu', 1),
(125, 'menu', 1),
(126, 'logo', 1),
(127, 'image_slider', 1),
(129, 'Statistik Card', 1),
(130, 'Links', 1),
(133, 'Alumni Testimonial', 1),
(135, 'Get your admission now!', 1),
(136, 'Our Featured Courses', 1),
(138, 'About The School', 1),
(139, 'Contact Info', 1),
(140, 'contact_info', 1),
(141, 'sosmed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_block_theme`
--

CREATE TABLE `bbc_block_theme` (
  `id` int(255) NOT NULL,
  `template_id` int(255) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `content` text,
  `active` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_block_theme`
--

INSERT INTO `bbc_block_theme` (`id`, `template_id`, `name`, `content`, `active`) VALUES
(1, 1, 'none', '[title][content]', 1),
(2, 1, 'default-heading', '<div class=\"panel panel-default\">\r\n  <div class=\"panel-heading\"><h3 class=\"panel-title\">[title]</h3></div>\r\n  <div class=\"panel-body\">\r\n    [content]\r\n  </div>\r\n</div>', 1),
(3, 1, 'default', '<div class=\"panel panel-default\">\r\n  [title]\r\n  <div class=\"panel-body\">\r\n    [content]\r\n  </div>\r\n</div>', 1),
(4, 1, 'menu top', '<div class=\"block_menu_top\">\r\n  <nav class=\"navbar navbar-default\" role=\"navigation\">\r\n    <div class=\"navbar-header\">\r\n      <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-menu-top\">\r\n        <span class=\"icon-bar\"></span>\r\n        <span class=\"icon-bar\"></span>\r\n        <span class=\"icon-bar\"></span>\r\n      </button>\r\n      [<a class=\"navbar-brand\" href=\"\">title</a>]\r\n    </div>\r\n    <div class=\"collapse navbar-collapse navbar-menu-top\">\r\n      [content]\r\n    </div>\r\n  </nav>\r\n</div>', 1),
(5, 1, 'menu bottom', '<div class=\"widget_bottom\">\r\n  [content]\r\n</div>', 1),
(6, 6, 'widget_agenda', '<div class=\"widget_agenda\">\n[<label>title</label>][content]\n</div>', 1),
(7, 6, 'widget_menu', '<div class=\"widget_menu\">\n[<label>title</label>][content]\n</div>', 1),
(8, 6, 'widget_bottom', '<div class=\"widget_bottom\">\n[<label>title</label>][content]\n</div>', 1),
(9, 6, 'widget_testimoni', '<div class=\"widget_testimoni\">\n[<label>title</label>][content]\n</div>', 1),
(10, 6, 'widget_menutop', '<div class=\"widget_menutop\">\r\n  <div class=\"navbar navbar-default\" role=\"navigation\">\r\n    <div class=\"navbar-header\">\r\n      <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">\r\n        <span class=\"icon-bar\"></span>\r\n        <span class=\"icon-bar\"></span>\r\n        <span class=\"icon-bar\"></span>\r\n      </button>\r\n      [<a class=\"navbar-brand\" href=\"/\">title</a>]\r\n    </div>\r\n    <div class=\"collapse navbar-collapse\">\r\n        [content]\r\n    </div>\r\n  </div>\r\n</div>', 1),
(11, 6, 'info', '<div class=\"panel panel-info\">\n  [<div class=\"panel-heading\"><h3 class=\"panel-title\">title</h3> </div>]\n  <div class=\"panel-body\">\n    [content]\n  </div>\n</div>', 1),
(12, 6, 'default', '<div class=\"panel panel-default\">\r\n  [<div class=\"panel-heading\"><h3 class=\"panel-title\">title</h3> </div>]\r\n  <div class=\"panel-body\">\r\n    [content]\r\n  </div>\r\n</div>', 1),
(13, 6, 'none', '[title][content]', 1),
(14, 6, 'banner', '<div class=\"banner\">\n[title][content]\n</div>', 1),
(15, 6, 'search', '<div class=\"block_search\">\n[<label>title</label>][content]\n</div>', 1),
(16, 6, 'menu side', '<div class=\"block_menu_side\">\n[<h3>title</h3>][content]\n</div>', 1),
(17, 2, 'none', '[title][content]', 1),
(18, 2, 'search', '<div class=\"block_search\">\r\n[<label>title</label>][content]\r\n</div>', 1),
(19, 2, 'menu top', '<div class=\"block_menu_top\">\r\n  <div class=\"navbar navbar-default\" role=\"navigation\">\r\n    <div class=\"navbar-header\">\r\n      <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">\r\n        <span class=\"icon-bar\"></span>\r\n        <span class=\"icon-bar\"></span>\r\n        <span class=\"icon-bar\"></span>\r\n      </button>\r\n      [<a class=\"navbar-brand\" href=\"/\">title</a>]\r\n    </div>\r\n    <div class=\"collapse navbar-collapse\">\r\n        [content]\r\n    </div>\r\n  </div>\r\n</div>', 1),
(20, 2, 'info', '<div class=\"panel panel-info\">\r\n  [<div class=\"panel-heading\"><h3 class=\"panel-title\">title</h3> </div>]\r\n  <div class=\"panel-body\">\r\n    [content]\r\n  </div>\r\n</div>', 1),
(21, 2, 'default', '<div class=\"panel panel-default\">\r\n  [<div class=\"panel-heading\"><h3 class=\"panel-title\">title</h3> </div>]\r\n  <div class=\"panel-body\">\r\n    [content]\r\n  </div>\r\n</div>', 1),
(22, 3, 'none', '[title][content]', 1),
(23, 3, 'search', '<div class=\"block_search\">\r\n[<label>title</label>][content]\r\n</div>', 1),
(24, 3, 'banner', '<div class=\"banner\">\r\n[title][content]\r\n</div>', 1),
(25, 3, 'info', '<div class=\"panel panel-info\">\r\n  [<div class=\"panel-heading\"><h3 class=\"panel-title\">title</h3> </div>]\r\n  <div class=\"panel-body\">\r\n    [content]\r\n  </div>\r\n</div>', 1),
(26, 3, 'default', '<div class=\"panel panel-default\">\r\n  [<div class=\"panel-heading\"><h3 class=\"panel-title\">title</h3> </div>]\r\n  <div class=\"panel-body\">\r\n    [content]\r\n  </div>\r\n</div>', 1),
(27, 4, 'none', '[title][content]', 1),
(28, 4, 'accountant style', '<div class=\"accountant_style\">\r\n[<h3>title</h3>][content]\r\n</div>', 1),
(29, 4, 'search', '<div class=\"block_search\">\r\n[<label>title</label>][content]\r\n</div>', 1),
(30, 4, 'top menu', '<div class=\"block_menu_top\">\r\n  <nav class=\"navbar navbar-default\" role=\"navigation\">\r\n    <div class=\"navbar-header\">\r\n      <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-menu-top\">\r\n        <span class=\"icon-bar\"></span>\r\n        <span class=\"icon-bar\"></span>\r\n        <span class=\"icon-bar\"></span>\r\n      </button>\r\n      [<a class=\"navbar-brand\" href=\"\">title</a>]\r\n    </div>\r\n    <div class=\"collapse navbar-collapse navbar-menu-top\">\r\n      [content]\r\n    </div>\r\n  </nav>\r\n</div>', 1),
(31, 5, 'none', '[title][content]', 1),
(32, 5, 'dark', '<div class=\"dark_panel\">\r\n  <h3>[title]</h3>\r\n  [content]\r\n</div>', 1),
(33, 5, 'nav', '<nav class=\"navbar navbar-default\" role=\"navigation\">\r\n  <div class=\"navbar-header\">\r\n    <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-menu-top\">\r\n      <span class=\"icon-bar\"></span>\r\n      <span class=\"icon-bar\"></span>\r\n      <span class=\"icon-bar\"></span>\r\n    </button>\r\n    [<a class=\"navbar-brand\" href=\"\">title</a>]\r\n  </div>\r\n  <div class=\"collapse navbar-collapse navbar-menu-top\">\r\n    [content]\r\n  </div>\r\n</nav>', 1),
(34, 5, 'menu_bottom', '<div class=\"nav_bottom\">\r\n  [content]\r\n</div>', 1),
(35, 5, 'dark_img', '<div class=\"dark_img\">\r\n  [content]\r\n</div>', 1),
(36, 5, 'search', '<div class=\"search\">\r\n  [content]\r\n</div>', 1),
(37, 7, 'none', '[title][content]', 1),
(39, 8, 'none', '[title][content]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_config`
--

CREATE TABLE `bbc_config` (
  `id` int(255) NOT NULL,
  `module_id` int(255) NOT NULL DEFAULT '0',
  `name` varchar(25) DEFAULT NULL,
  `params` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_config`
--

INSERT INTO `bbc_config` (`id`, `module_id`, `name`, `params`) VALUES
(1, 0, 'site', '{\"title\":\"Eraport+SDIT+AL+ISLAM+KUDUS\",\"desc\":\"Eraport+SDIT+AL+ISLAM+Kudus+-+Platform+digital+resmi+untuk+melihat+laporan+hasil+belajar+siswa+secara+online.+Didesain+untuk+memudahkan+orang+tua+dan+siswa+dalam+mengakses+nilai+dan+perkembangan+akademik+dengan+mudah+dan+aman.\",\"keyword\":\"eraport%2C+SDIT+AL+ISLAM+Kudus%2C+raport+online%2C+laporan+hasil+belajar%2C+SDIT+Kudus%2C+nilai+siswa%2C+perkembangan+akademik%2C+pendidikan+Islam%2C+sekolah+dasar%2C+Kudus%2C+raport+digital%2C+akses+nilai+online\",\"url\":\"school.lc\",\"icon\":\"icon.png\",\"logo\":\"home.png\",\"footer\":\"Copyright+%26copy%3B+2025+SDIT+AL+ISLAM+KUDUS+-+All+rights+reserved.+Powered+by+%3Ca+href%3D%22http%3A%2F%2Fesoftplay.com%2F%22%3Eesoftplay.com%3C%2Fa%3E\"}'),
(2, 0, 'logged', '{\"duration\":\"1\",\"period\":\"HOUR\",\"duration_admin\":\"2\",\"period_admin\":\"HOUR\",\"method_admin\":\"0\"}'),
(3, 0, 'activation', '{\"html\":\"ini+adalah+licensi+dari+fisip.net+%2F+silahka+diubah+sesukanya..%3Cbr+%2F%3E\",\"active\":\"1\"}'),
(4, 0, 'rules', '{\"content_max\":\"1000\",\"content_date\":\"M+jS%2C+Y+H%3Ai%3As\",\"content_rss\":\"12\",\"num_rows\":\"30\",\"register_auto\":\"1\",\"register_expired\":\"6\",\"register_monitor\":\"1\",\"register_groups\":[\"4\"],\"disable_user_del\":\"0\",\"lang_default\":\"1\",\"lang_auto\":\"0\",\"permitted_uri\":\"a-z0-9%7E%25%5C.%3A_%5C-\",\"uri_separator\":\"-\"}'),
(5, 0, 'email', '{\"name\":\"E-Profile\",\"address\":\"tmp%40fisip.net\",\"subject\":\"%5Be-profile%5D\",\"footer\":\"Hormat+Kami%2C%0D%0AAdministrator\"}'),
(6, 0, 'template', '\"eraport-sdit\"'),
(7, 3, 'search', '{\"from\":\"1\",\"module\":\"0\",\"per_page\":\"12\"}'),
(8, 4, 'entry', '{\"groups\":[\"4\"],\"auto\":\"1\",\"alert\":\"1\",\"address\":\"\",\"delete\":\"1\",\"type_id\":\"1\",\"show_cat\":\"1\",\"tot\":\"12\",\"animated\":\"0\",\"orderby\":\"4\"}'),
(9, 4, 'detail', '{\"template\":\"detail.html.php\",\"title\":\"1\",\"created\":\"1\",\"modified\":\"1\",\"author\":\"1\",\"tag\":\"1\",\"tag_link\":\"1\",\"rating\":\"1\",\"rating_vote\":\"1\",\"thumbsize\":\"250\",\"comment\":\"1\",\"comment_auto\":\"1\",\"comment_list\":\"9\",\"comment_form\":\"1\",\"comment_emoticons\":\"1\",\"comment_spam\":\"0\",\"comment_email\":\"1\",\"pdf\":\"1\",\"print\":\"1\",\"email\":\"1\",\"share\":\"1\"}'),
(10, 4, 'list', '{\"template\":\"list.html.php\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"1\",\"created\":\"1\",\"modified\":\"1\",\"author\":\"1\",\"tag\":\"1\",\"tag_link\":\"1\",\"rating\":\"1\",\"read_more\":\"1\",\"tot_list\":\"12\",\"thumbnail\":\"1\"}'),
(11, 4, 'manage', '{\"webtype\":\"1\",\"image_size\":\"800\",\"images\":\"none.gif\",\"is_nested\":\"0\",\"cat_img\":\"1\",\"disqus\":\"fisipnet\"}'),
(12, 4, 'frontpage', '{\"auto\":\"0\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"0\",\"created\":\"0\",\"modified\":\"0\",\"author\":\"0\",\"tag\":\"0\",\"tag_link\":\"0\",\"rating\":\"0\",\"read_more\":\"0\",\"tot_list\":\"1\",\"thumbnail\":\"1\"}'),
(14, 6, 'form', '{\"email\":\"\",\"address\":\"CONTOH+ALAMAT%26nbsp%3BPERUSAHAAN%26nbsp%3BANDA%3Cbr+%2F%3E%0D%0AJl.+Pedakbaru+425C+Gowok%3Cbr+%2F%3E%0D%0Abaguntapan%2C+Bantul%2C+Yogyakarta.%3Cbr+%2F%3E%0D%0ATelp%3A+%280274%29+XXXXX%3Cbr+%2F%3E%0D%0AEmail%3A+XXXXXXXX%3Cbr+%2F%3E%0D%0A%3Cbr+%2F%3E\"}'),
(15, 6, 'widget', '{\"auto_check\":\"1\",\"ym_show\":\"5\",\"icon\":\"1\",\"name\":\"1\",\"address\":\"0\"}'),
(18, 7, 'guestbook', '{\"alert\":\"1\",\"email\":\"\",\"approved\":\"1\",\"tot\":\"12\",\"avatar\":\"1\",\"animated\":\"1\",\"orderby\":\"1\"}'),
(19, 9, 'main', '{\"template\":\"\",\"noreentry\":\"1\",\"publish\":\"1\",\"alert\":\"1\",\"email\":\"\"}'),
(20, 10, 'testimonial', '{\"alert\":\"1\",\"email\":\"\",\"approved\":\"1\",\"tot\":\"12\",\"avatar\":\"1\",\"animated\":\"0\",\"orderby\":\"1\"}');

-- --------------------------------------------------------

--
-- Table structure for table `bbc_content`
--

CREATE TABLE `bbc_content` (
  `id` int(255) UNSIGNED NOT NULL,
  `par_id` int(255) DEFAULT '0',
  `type_id` int(255) NOT NULL DEFAULT '0',
  `kind_id` int(1) DEFAULT '0' COMMENT '0=content, 1=gallery, 2=download, 3=video, 4=audio',
  `file` varchar(255) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `file_format` varchar(12) DEFAULT NULL,
  `file_type` int(1) DEFAULT '0' COMMENT '0=local file, 1=tirth party file',
  `file_register` tinyint(1) DEFAULT '0' COMMENT '0=free download, 1=must register',
  `file_hit` int(255) DEFAULT '0',
  `file_hit_time` datetime DEFAULT '0000-00-00 00:00:00',
  `file_hit_ip` varchar(25) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `audio` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `images` text,
  `created` datetime DEFAULT NULL,
  `created_by` int(255) DEFAULT NULL,
  `created_by_alias` varchar(255) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(255) DEFAULT NULL,
  `revised` int(11) DEFAULT '0',
  `privilege` varchar(255) DEFAULT ',all,' COMMENT 'all=any user, 1 >= user group (bbc_user_group.id)',
  `hits` int(255) UNSIGNED DEFAULT '0',
  `rating` varchar(255) DEFAULT '0',
  `last_hits` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_popimage` tinyint(1) NOT NULL DEFAULT '0',
  `is_front` tinyint(1) NOT NULL DEFAULT '0',
  `is_config` tinyint(1) DEFAULT '0',
  `config` text NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_content`
--

INSERT INTO `bbc_content` (`id`, `par_id`, `type_id`, `kind_id`, `file`, `file_url`, `file_format`, `file_type`, `file_register`, `file_hit`, `file_hit_time`, `file_hit_ip`, `video`, `audio`, `image`, `caption`, `images`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `revised`, `privilege`, `hits`, `rating`, `last_hits`, `is_popimage`, `is_front`, `is_config`, `config`, `publish`) VALUES
(1, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'home-page.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 16, ',all,', 604, '0,0,1,2,0', '2024-02-23 03:25:44', 1, 1, 0, '', 1),
(2, 0, 1, 1, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'images/modules/content/2/alam-6.jpg', '', '[{\"image\":\"alam-6.jpg\",\"title\":\"\",\"description\":\"\"},{\"image\":\"alam-5.jpg\",\"title\":\"\",\"description\":\"\"},{\"image\":\"alam-4.jpg\",\"title\":\"\",\"description\":\"\"},{\"image\":\"alam-3.jpg\",\"title\":\"\",\"description\":\"\"},{\"image\":\"alam-2.jpg\",\"title\":\"\",\"description\":\"\"},{\"image\":\"alam-1.jpg\",\"title\":\"\",\"description\":\"\"}]', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 8, ',all,', 313, '0', '2024-02-03 13:58:49', 1, 0, 0, '', 1),
(3, 0, 1, 1, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'images/modules/content/3/art-2.jpg', '', '[{\"image\":\"art-2.jpg\",\"title\":\"\",\"description\":\"\"},{\"image\":\"art-6.jpg\",\"title\":\"\",\"description\":\"\"},{\"image\":\"art-5.jpg\",\"title\":\"\",\"description\":\"\"},{\"image\":\"art-4.jpg\",\"title\":\"\",\"description\":\"\"},{\"image\":\"art-3.jpg\",\"title\":\"\",\"description\":\"\"},{\"image\":\"art-1.jpg\",\"title\":\"\",\"description\":\"\"}]', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 6, ',all,', 40, '0', '2024-02-02 17:00:43', 1, 0, 0, '', 1),
(4, 0, 1, 1, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'images/modules/content/4/drone-6.jpg', '', '[{\"image\":\"drone-6.jpg\",\"title\":\"\",\"description\":\"\"},{\"image\":\"drone-5.jpg\",\"title\":\"\",\"description\":\"\"},{\"image\":\"drone-4.jpg\",\"title\":\"\",\"description\":\"\"},{\"image\":\"drone-3.jpg\",\"title\":\"\",\"description\":\"\"},{\"image\":\"drone-2.jpg\",\"title\":\"\",\"description\":\"\"},{\"image\":\"drone-1.jpg\",\"title\":\"\",\"description\":\"\"}]', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 10, ',all,', 313, '0', '2024-02-03 14:41:33', 0, 0, 0, '', 1),
(5, 0, 1, 2, 'sample_document.docx', '', 'word', 0, 0, 3, '2016-05-03 21:08:25', '127.0.0.1', '', '', 'sample-download-file-satu.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 8, ',all,', 45, '0', '2016-05-25 00:06:05', 1, 0, 0, '', 1),
(6, 0, 1, 2, 'sample_document.xlsx', '', 'excel', 0, 0, 2, '2016-05-03 21:08:09', '127.0.0.1', '', '', 'sample-download-file-dua.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 10, ',all,', 56, '0', '2019-06-14 08:24:55', 0, 0, 0, '', 1),
(7, 0, 1, 2, 'sample_document.pptx', '', 'powerpoint', 0, 1, 0, '0000-00-00 00:00:00', '', '', '', 'sample-download-file-tiga.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 13, ',all,', 355, '0,1,0,1,0', '2019-07-04 22:32:15', 1, 0, 0, '', 1),
(8, 0, 1, 3, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 'u_orGF2zM5o', '', 'http://i2.ytimg.com/vi/u_orGF2zM5o/0.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 9, ',all,', 258, '0', '2016-05-25 00:06:22', 1, 0, 0, '', 1),
(9, 0, 1, 3, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 'qREKP9oijWI', '', 'http://i2.ytimg.com/vi/qREKP9oijWI/0.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 7, ',all,', 294, '0', '2016-05-25 00:06:10', 1, 0, 0, '', 1),
(10, 0, 1, 3, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '-dNp7DQJMP8', '', 'http://i2.ytimg.com/vi/-dNp7DQJMP8/0.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 7, ',all,', 423, '0', '2024-02-27 05:49:35', 1, 0, 0, '', 1),
(11, 0, 1, 4, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '87616772', 'https://i1.sndcdn.com/artworks-000045363067-gy0gm1-t500x500.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 12, ',all,', 301, '0', '2016-05-25 00:06:15', 1, 0, 0, '', 1),
(12, 0, 1, 4, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '62576046', 'https://i1.sndcdn.com/artworks-000031744302-0730nk-t500x500.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 14, ',all,', 308, '0', '2016-05-03 21:07:17', 1, 0, 0, '', 1),
(13, 0, 1, 4, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '24600650', 'https://i1.sndcdn.com/artworks-000012244956-xfjnke-t500x500.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 7, ',all,', 290, '0', '2016-05-25 00:05:15', 1, 0, 0, '', 1),
(14, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'penandatanganan-bantuan-kapal-penyebrangan.jpg', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 12, ',all,', 284, '0', '2019-06-14 08:25:30', 1, 0, 0, '', 1),
(15, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'merevitalisasi-sektor-pelayaran.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 7, ',all,', 343, '0,0,0,0,1', '2024-02-13 00:22:45', 0, 0, 0, '', 1),
(16, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'transportasi-yang-efisien.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 6, ',all,', 381, '0', '2015-09-03 02:36:44', 1, 0, 0, '', 1),
(17, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', '8-langkah-hindari-kehilangan-mobil.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 8, ',all,', 404, '0', '2016-04-15 18:49:19', 0, 0, 0, '', 1),
(18, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'indahnya-indonesia-dengan-menyelam.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 5, ',all,', 307, '0', '2016-04-15 18:49:16', 0, 0, 0, '', 1),
(19, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'bertahan-dengan-inovasi.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 8, ',all,', 228, '0', '2016-05-03 17:01:41', 1, 0, 0, '', 1),
(20, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'optimis-melangkah-ditahun-depan.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 8, ',all,', 367, '0,0,0,1,0', '2015-09-03 04:57:43', 1, 0, 0, '', 1),
(21, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'bisnis-penyeberangan-potensi-yang-terabaikan.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 6, ',all,', 244, '0', '2015-05-20 08:54:49', 1, 0, 0, '', 1),
(22, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'dukung-konektivitas-asean.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 6, ',all,', 658, '1,0,0,1,1', '2024-03-12 12:58:33', 0, 0, 0, '', 1),
(23, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'tantangan-transportasi-di-kota-1001-gua.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 5, ',all,', 494, '0', '2016-04-15 18:53:06', 1, 0, 0, '', 1),
(24, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'keselamatan-harus-jadi-icon.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 15, ',all,', 395, '0,0,0,0,1', '2024-02-23 21:14:25', 1, 0, 0, '', 1),
(25, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'tingkatkan-pengawasan-perairan-kkp-akan-perkuat-dengan-kapal-induk.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 7, ',all,', 43, '0', '2011-11-24 02:41:35', 1, 0, 0, '', 1),
(26, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'gencar-tertibkan-knalpot-bising-ratusan-motor-dipretelin-polisi.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 5, ',all,', 40, '0', '2024-02-02 00:26:28', 1, 0, 0, '', 1),
(27, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'quo-vadis-perkeretaapian-nasional.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 6, ',all,', 40, '0', '2024-02-20 21:44:28', 1, 0, 0, '', 1),
(28, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'mrt-jadi-pertaruhan.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 4, ',all,', 33, '0', '2011-04-25 13:07:36', 1, 0, 0, '', 1),
(29, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'meneropong-redesign-juanda.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 4, ',all,', 40, '0', '2011-04-25 13:08:38', 1, 0, 0, '', 1),
(30, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'apa-kabar-sistranas.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 3, ',all,', 41, '0', '2011-04-25 13:09:44', 1, 0, 0, '', 1),
(31, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'konektivitas-nusantara.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 18, ',all,', 40, '0', '2011-04-25 13:09:53', 1, 0, 0, '', 1),
(32, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'membumikan-transportasi-ke-ranah-lokal.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 5, ',all,', 117, '0', '2016-04-16 04:03:32', 0, 0, 0, '', 0),
(33, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'nikmat-teh-di-pasar-terapung.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 7, ',all,', 314, '0', '2016-04-15 23:24:10', 1, 0, 0, '', 1),
(34, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'tol-semakin-dikebut.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 12, ',all,', 389, '0', '2012-03-15 02:57:55', 1, 0, 0, '', 1),
(35, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'dermaga-batubara-terbesar.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 5, ',all,', 324, '0', '2024-03-08 16:50:49', 0, 0, 0, '', 1),
(36, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'belawan-terus-berbenah.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 10, ',all,', 410, '0', '2024-02-11 15:37:42', 1, 0, 0, '', 1),
(37, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'pasar-perintis-kian-seksi.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-04 03:11:39', 1, 17, ',all,', 211, '0', '2018-10-24 07:19:44', 1, 0, 0, '', 1),
(38, 0, 1, 0, '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', '', '', 'garuda-buka-rute-surabaya-jeddah.jpg', '', '', '2016-05-04 03:11:39', 1, 'Administrator', '2016-05-21 16:46:21', 1, 53, ',all,', 190, '0,0,0,1,0', '2024-03-09 10:29:47', 1, 0, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_content_ad`
--

CREATE TABLE `bbc_content_ad` (
  `id` int(11) UNSIGNED NOT NULL,
  `cat_id` int(11) DEFAULT '0' COMMENT 'based on bbc_content_cat',
  `type_id` tinyint(1) DEFAULT '0' COMMENT '0=logo n text, 1=banner, 2=text Only',
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `hit` int(11) DEFAULT '0' COMMENT 'how many time ad had been clicked',
  `hit_last` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `updated` datetime DEFAULT '0000-00-00 00:00:00',
  `displayed` datetime DEFAULT '0000-00-00 00:00:00',
  `expire` tinyint(1) DEFAULT '0' COMMENT '1=use expire time, 0=unlimited time of use',
  `expire_date` date DEFAULT '0000-00-00',
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bbc_content_cat`
--

CREATE TABLE `bbc_content_cat` (
  `id` int(255) NOT NULL,
  `par_id` int(255) DEFAULT '0',
  `type_id` int(255) NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  `is_config` tinyint(1) DEFAULT '0',
  `config` text,
  `publish` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_content_cat`
--

INSERT INTO `bbc_content_cat` (`id`, `par_id`, `type_id`, `image`, `is_config`, `config`, `publish`) VALUES
(1, 0, 1, '1151210920.png', 0, '', 1),
(2, 0, 1, '936556321.png', 1, '{\"template\":\"list-grid3.html.php\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"1\",\"created\":\"0\",\"modified\":\"0\",\"author\":\"0\",\"tag\":\"0\",\"tag_link\":\"0\",\"rating\":\"0\",\"read_more\":\"0\",\"tot_list\":\"12\",\"thumbnail\":\"1\"}', 1),
(3, 0, 1, '808535225.png', 0, '', 1),
(4, 0, 1, '2122945692.png', 0, '', 1),
(5, 0, 1, '277845280.png', 0, '', 1),
(6, 0, 1, '1685082208.png', 0, '', 1),
(7, 6, 1, '1089586799.png', 0, '', 1),
(8, 6, 1, '1049295436.png', 0, '', 1),
(9, 6, 1, '25760023.png', 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_content_category`
--

CREATE TABLE `bbc_content_category` (
  `category_id` int(255) NOT NULL,
  `content_id` int(255) NOT NULL DEFAULT '0',
  `cat_id` int(255) NOT NULL DEFAULT '0',
  `pruned` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_content_category`
--

INSERT INTO `bbc_content_category` (`category_id`, `content_id`, `cat_id`, `pruned`, `active`) VALUES
(1, 2, 2, 0, 1),
(2, 2, 6, 0, 1),
(3, 2, 7, 0, 1),
(4, 3, 2, 0, 1),
(5, 3, 6, 0, 1),
(6, 3, 8, 0, 1),
(7, 4, 2, 0, 1),
(8, 4, 6, 0, 1),
(9, 4, 8, 0, 1),
(10, 5, 3, 0, 1),
(11, 5, 6, 0, 1),
(12, 5, 7, 0, 1),
(13, 6, 3, 0, 1),
(14, 6, 6, 0, 1),
(15, 6, 8, 0, 1),
(16, 7, 3, 0, 1),
(17, 7, 6, 0, 1),
(18, 7, 8, 0, 1),
(19, 8, 4, 0, 1),
(20, 8, 6, 0, 1),
(21, 8, 8, 0, 1),
(22, 9, 4, 0, 1),
(23, 9, 6, 0, 1),
(24, 9, 8, 0, 1),
(25, 10, 4, 0, 1),
(26, 10, 6, 0, 1),
(27, 10, 8, 0, 1),
(28, 11, 5, 0, 1),
(29, 11, 6, 0, 1),
(30, 11, 7, 0, 1),
(31, 12, 5, 0, 1),
(32, 12, 6, 0, 1),
(33, 12, 7, 0, 1),
(34, 13, 5, 0, 1),
(35, 13, 6, 0, 1),
(36, 13, 8, 0, 1),
(37, 14, 1, 0, 1),
(38, 14, 6, 0, 1),
(39, 14, 9, 0, 1),
(40, 15, 1, 0, 1),
(41, 15, 6, 0, 1),
(42, 15, 7, 0, 1),
(43, 16, 1, 0, 1),
(44, 16, 6, 0, 1),
(45, 16, 8, 0, 1),
(46, 17, 1, 0, 1),
(47, 17, 7, 0, 1),
(48, 18, 1, 0, 1),
(49, 18, 6, 0, 1),
(50, 18, 8, 0, 1),
(51, 19, 1, 0, 1),
(52, 19, 6, 0, 1),
(53, 19, 9, 0, 1),
(54, 20, 1, 0, 1),
(55, 20, 6, 0, 1),
(56, 20, 9, 0, 1),
(57, 21, 1, 0, 1),
(58, 21, 6, 0, 1),
(59, 21, 7, 0, 1),
(60, 22, 1, 0, 1),
(61, 22, 6, 0, 1),
(62, 22, 8, 0, 1),
(63, 23, 1, 0, 1),
(64, 23, 6, 0, 1),
(65, 23, 8, 0, 1),
(66, 24, 1, 0, 1),
(67, 24, 6, 0, 1),
(68, 24, 9, 0, 1),
(69, 25, 1, 0, 1),
(70, 25, 6, 0, 1),
(71, 25, 8, 0, 1),
(72, 26, 1, 0, 1),
(73, 26, 6, 0, 1),
(74, 26, 7, 0, 1),
(75, 27, 1, 0, 1),
(76, 27, 6, 0, 1),
(77, 27, 8, 0, 1),
(78, 28, 1, 0, 1),
(79, 28, 6, 0, 1),
(80, 28, 9, 0, 1),
(81, 29, 1, 0, 1),
(82, 29, 6, 0, 1),
(83, 29, 8, 0, 1),
(84, 30, 1, 0, 1),
(85, 30, 6, 0, 1),
(86, 30, 9, 0, 1),
(87, 31, 1, 0, 1),
(88, 31, 6, 0, 1),
(89, 31, 8, 0, 1),
(90, 32, 1, 0, 1),
(91, 32, 6, 0, 1),
(92, 32, 9, 0, 1),
(93, 33, 1, 0, 1),
(94, 33, 6, 0, 1),
(95, 33, 7, 0, 1),
(96, 34, 1, 0, 1),
(97, 34, 6, 0, 1),
(98, 34, 8, 0, 1),
(99, 35, 1, 0, 1),
(100, 35, 6, 0, 1),
(101, 35, 8, 0, 1),
(102, 36, 1, 0, 1),
(103, 36, 6, 0, 1),
(104, 36, 9, 0, 1),
(105, 37, 1, 0, 1),
(106, 37, 6, 0, 1),
(107, 37, 9, 0, 1),
(108, 38, 1, 0, 1),
(109, 38, 6, 0, 1),
(110, 38, 8, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_content_cat_text`
--

CREATE TABLE `bbc_content_cat_text` (
  `cat_id` int(255) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `lang_id` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_content_cat_text`
--

INSERT INTO `bbc_content_cat_text` (`cat_id`, `title`, `description`, `keyword`, `lang_id`) VALUES
(1, 'Article', '', '', 1),
(2, 'Gallery', '', '', 1),
(3, 'Download', '', '', 1),
(4, 'Videos', '', '', 1),
(5, 'Sound Audio', '', '', 1),
(6, 'Berita', '', '', 1),
(7, 'Relaxing', '', '', 1),
(8, 'Information', '', '', 1),
(9, 'Hot List', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_content_comment`
--

CREATE TABLE `bbc_content_comment` (
  `id` int(255) UNSIGNED NOT NULL,
  `par_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `reply_all` int(11) DEFAULT '0',
  `reply_on` int(11) DEFAULT '0',
  `content_id` int(255) UNSIGNED DEFAULT NULL,
  `content_title` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `content` text,
  `date` datetime DEFAULT NULL,
  `publish` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_content_comment`
--

INSERT INTO `bbc_content_comment` (`id`, `par_id`, `user_id`, `reply_all`, `reply_on`, `content_id`, `content_title`, `name`, `image`, `email`, `website`, `content`, `date`, `publish`) VALUES
(1, 0, 0, 0, 0, 14, 'Sample Content Detail', 'yaya', 'http://graph.facebook.com/100005476120332/picture', 'melsa@yahoo.com', '', 'kalo misal\'ny dari ank ips bisa tdk masuk ke perusahaan\nterimakasih', '2010-10-10 19:06:31', 1),
(2, 0, 0, 0, 0, 34, 'Tol Semakin Dikebut', 'maya', 'http://graph.facebook.com/100001164127152/picture', 'maialail@yahoo.com', '', 'bagaimana cara mendaftar & mendapatkan beasiswa disini??', '2010-10-11 15:03:31', 1),
(3, 0, 0, 0, 0, 14, 'Sample Content Detail', 'Rizka Octa', 'http://graph.facebook.com/1259376413/picture', 'octa.rizka@yahoo.co.id', '', 'kalau 5 semester berturut-turut nilai nya di atas 75 tapi tinggi nya tidak mencapai 150 apa tidak boleh masuk PERUSAHAAN ?\nterimakasih', '2010-10-13 17:30:21', 1),
(4, 0, 0, 0, 0, 14, 'Sample Content Detail', 'nandha', 'http://graph.facebook.com/100000073777335/picture', 'nandafogbow@yahoo.com', '', 'cara pendfatrannya langsung kkampusnya atau ada prasana lain?????', '2010-10-15 11:34:18', 1),
(5, 0, 0, 0, 0, 34, 'Tol Semakin Dikebut', 'NANDHA', 'http://graph.facebook.com/100000073777335/picture', 'nandafogbow@yahoo.com', '', 'cara untuk mendapatkan beasiswanya bagaimana yaa????', '2010-10-15 11:46:32', 1),
(6, 0, 0, 0, 0, 34, 'Tol Semakin Dikebut', 'chris', 'http://graph.facebook.com/100000824915296/picture', 'christina_imuet@yahoo.com', '', 'biayanya mahal banget ,,, ada biasiswa ngk??? n bagaimana caranya ndaftar  biasiswa n apa saja syarat-syarat nya.................?', '2010-10-16 11:58:31', 1),
(7, 0, 0, 0, 0, 23, 'Tantangan Transportasi di Kota 1001 Gua', 'Dea', 'http://graph.facebook.com/100000920641908/picture', 'dhea_imutz77@yahoo.com', 'http://www.perusahaan.ac.id', 'saya mau bertanya,akbid ini merupakan akbid Negri yang dikelola pemerintah atau swasta yang dikelola lembaga..\nmohon,penjelasannya\nterima kasih', '2010-10-18 17:48:46', 1),
(8, 0, 0, 0, 0, 14, 'Sample Content Detail', 'endang', 'http://graph.facebook.com/100000477046097/picture', 'endangrokama@yahoo.co.id', '', 'klu tinggi badan kurang dari 150 gmna? misal 148', '2010-10-20 13:29:04', 1),
(9, 0, 0, 0, 0, 34, 'Tol Semakin Dikebut', 'dheena', 'http://graph.facebook.com/100001512649744/picture', 'dina_ikayanti@yahoo.com', '', 'yang mau saya tanyakan adalah siapa saja yang berhak untuk mendapatkan beasiswa tersebut?\n', '2010-10-20 18:20:02', 0),
(10, 0, 0, 0, 0, 2, 'Sample Gallery Satu', 'NANDHA', 'http://graph.facebook.com/100000073777335/picture', 'nandafogbow@yahoo.com', '', 'rincian uang stiap semesternya ko gugh dtampilkan????\n.,dtampilkan donk', '2010-10-20 18:32:12', 1),
(11, 0, 0, 0, 0, 14, 'Sample Content Detail', 'patricia', 'http://graph.facebook.com/1243958560/picture', 'lianpatriciabolung@yahoo.com', '', 'batasan umur untuk masuk akademi ada ga sih?', '2010-10-23 17:37:39', 1),
(12, 0, 0, 0, 0, 14, 'Sample Content Detail', 'iin', 'http://graph.facebook.com/100002248209591/picture', 'prettycure_31@ymail.com', '', 'klo\' anak ips bsa msk gak?\nn ada tes tulisnya?\n', '2010-10-24 14:06:51', 1),
(13, 0, 0, 0, 0, 14, 'Sample Content Detail', 'devi', 'http://graph.facebook.com/100001277183678/picture', 'cup_punk@rocketmail.com', '', 'kalo smk nya jurusan pemasaran bisa gak.maksh', '2010-10-29 11:17:44', 1),
(14, 0, 0, 0, 0, 14, 'Sample Content Detail', 'haryati purnama sari', 'http://graph.facebook.com/100001067155465/picture', 'haryatitoanugrah@rocketmail.com', '', 'kalo smk jurusan akutansi bisa msuk gak?????\n', '2010-11-03 19:47:19', 1),
(15, 0, 0, 0, 0, 36, 'Belawan Terus Berbenah', 'lusiana', 'http://graph.facebook.com/100001659436537/picture', 'cicilusiana@ymail.com', '', 'bsa nggak..ijasah nya pkai paket C ?', '2010-11-08 16:28:12', 1),
(16, 0, 0, 0, 0, 2, 'Sample Gallery Satu', 'Perusahaan', 'http://graph.facebook.com/100011328960689/picture', 'info@perusahaan.ac.id', '', '@Nanda: Kami memberikan informasi biaya via email berdasarkan permintaan. :)', '2010-11-10 12:43:13', 1),
(17, 0, 0, 0, 0, 34, 'Tol Semakin Dikebut', 'Perusahaan', 'http://graph.facebook.com/100011328960689/picture', 'info@perusahaan.ac.id', '', '@Maya: Pendaftaran bisa dilakuan secara online (lihat menu sipenmaru) atau datang langsung ke kampus Perusahaan d.a. Jl. Parangtritis Km.6 Sewon.\n@All: untuk untuk mendapatkan beasiswa harus terdaftar dulu sebagai mahasiswa Perusahaan, setelah itu dilihat prestasi akademik mahasiswa yang bersangkutan.', '2010-11-10 13:01:33', 1),
(18, 0, 0, 0, 0, 36, 'Belawan Terus Berbenah', 'Perusahaan', 'http://graph.facebook.com/100011328960689/picture', 'info@perusahaan.ac.id', '', '@Lusiana: Bisa ', '2010-11-10 13:03:50', 1),
(19, 0, 0, 0, 0, 23, 'Tantangan Transportasi di Kota 1001 Gua', 'Perusahaan', 'http://graph.facebook.com/100011328960689/picture', 'info@perusahaan.ac.id', '', '@Dea: Perusahaan adalah lembaga swasta', '2010-11-10 13:08:45', 1),
(20, 0, 0, 0, 0, 1, 'Home page', 'andi', 'http://graph.facebook.com/1685135329/picture', 'kak.andi@yahoo.com', '', 'untuk alumni smk akuntansi bisa masuk apa tidak?', '2010-11-12 16:17:58', 1),
(21, 0, 0, 0, 0, 36, 'Belawan Terus Berbenah', 'nandha', 'http://graph.facebook.com/100000073777335/picture', 'nandafogbow@yahoo.com', '', 'kalo pndftran buat siswa baru yg angkatan 2011 kpan ya??trus bsa gugh persyaratan yg di inginkan untuk wilayah luar jawa kita kirim lewat pos??', '2010-11-14 10:30:53', 1),
(23, 0, 0, 0, 0, 23, 'Tantangan Transportasi di Kota 1001 Gua', 'ghita', 'http://graph.facebook.com/100000167977393/picture', 'immuudt@yahoo.com', '', 'perusahaan kapan bika PMB TA.2011/2012 ?', '2010-11-16 12:05:40', 1),
(24, 0, 0, 0, 0, 20, 'Optimis Melangkah ditahun depan', 'fd', 'http://graph.facebook.com/100003509649001/picture', 'ap.fedri@yahoo.com', '', 'program study nya apa saja.\nada S1 tidak?', '2010-11-17 17:33:44', 1),
(25, 0, 0, 0, 0, 14, 'Sample Content Detail', 'tusi minasari', 'http://graph.facebook.com/100001636105240/picture', 'thoesiygemini@yahoo.co.id', '', 'klo ank akntnsi bsa g msuk akbid,,?', '2010-11-18 12:56:59', 1),
(26, 0, 0, 0, 0, 14, 'Sample Content Detail', 'tusi minasari', 'http://graph.facebook.com/100001636105240/picture', 'thoesiygemini@yahoo.co.id', '', 'klo ank akntnsi bs g msuk akbid', '2010-11-18 12:58:27', 1),
(27, 0, 0, 0, 0, 14, 'Sample Content Detail', 'wien', 'http://graph.facebook.com/100001721082833/picture', 'jelex_poenyakoe@yahoo.com', '', 'kalau anak SMK dari akuntansi bisa gak ya?\nmakasih sblmnya', '2010-11-18 21:04:56', 1),
(28, 0, 0, 0, 0, 14, 'Sample Content Detail', 'fithri', 'http://graph.facebook.com/100000110940380/picture', 'vich_zhuity@yahoo.com', '', 'saya mau tanYa, tes kesehatan\'y meliputi apa aja sih?\ntrus kalau nilai 5 semester di ats 75 beneran cuma ikut tes kesehatan aja????', '2010-11-20 15:54:51', 1),
(29, 0, 0, 0, 0, 14, 'Sample Content Detail', 'putri ', 'http://graph.facebook.com/100000134050510/picture', 'may_ang21@yahoo.co.id', '', 'apa tidak disediakan S1?', '2010-11-20 20:24:48', 1),
(30, 0, 0, 0, 0, 23, 'Tantangan Transportasi di Kota 1001 Gua', 'nur', 'http://graph.facebook.com/100000215624909/picture', 'daimnh@gmail.com', '', 'mohon minta rincian biaya pendidikan di perusahaan. kirim k email y . . .\nsaya ingin masuk akbid.', '2010-11-21 10:59:41', 1),
(31, 0, 0, 0, 0, 2, 'Sample Gallery Satu', 'nandha', 'http://graph.facebook.com/100000073777335/picture', 'nandafogbow@yahoo.com', '', 'alamat emailnya apa ya???\ntrus bagaimana dengan calon siswa baru yg berada d luar jawa??\napa bisa melalui pos ya?\napa ada no yg bisa di hub untuk konsultasi k perusahaan??', '2010-11-22 17:17:44', 1),
(32, 0, 0, 0, 0, 23, 'Tantangan Transportasi di Kota 1001 Gua', 'eka', 'http://graph.facebook.com/100006096697514/picture', 'cha_muky@yahoo.com', '', 'mau tanya pendaftaran dibuka kapan dan tolong minta rincian biayanya \nterimakasih', '2010-11-23 16:03:20', 1),
(33, 0, 0, 0, 0, 36, 'Belawan Terus Berbenah', 'rindy', 'http://graph.facebook.com/100000302388141/picture', 'rfriezca@yahoo.com', '', 'bwt pendaftarn tahun 2011\nkpn yah!!!!', '2010-11-23 19:19:22', 1),
(34, 0, 0, 0, 0, 10, 'Sample Youtube Video Tiga', 'rahma', 'http://graph.facebook.com/100001533960031/picture', 'rahmaflayyer@yahoo.com', '', 'kalau mahasiswanya tidak adrama, apakah diperbolehkan????', '2010-11-26 11:22:36', 1),
(35, 0, 0, 0, 0, 14, 'Sample Content Detail', 'rahma', 'http://graph.facebook.com/100001533960031/picture', 'rahmaflayyer@yahoo.com', '', 'ini dah bulan november...\npendaftaran masih buka kan????', '2010-11-26 11:26:34', 1),
(36, 0, 0, 0, 0, 35, 'Dermaga Batubara Terbesar', 'Tuti', 'http://graph.facebook.com/100003894631547/picture', 'tutyclara@ymail.com', '', 'umch bagus juga,,,,', '2010-11-30 10:06:58', 1),
(37, 0, 0, 0, 0, 14, 'Sample Content Detail', 'lia', 'http://graph.facebook.com/100000083907730/picture', 'hakeshy_hatsuden@yahoo.co.id', '', ' =; maaf, saya lulusan smk pariwisata apakah bisa mendaftar?\nterimakasih.', '2010-11-30 22:10:29', 1),
(38, 0, 0, 0, 0, 36, 'Belawan Terus Berbenah', 'mita', 'http://graph.facebook.com/100010192572668/picture', 'mita_kissing@yahoo.com', '', 'apa gag ada saringan masuknya menggunakan PMDK????', '2010-12-03 12:35:30', 1),
(39, 0, 0, 0, 0, 34, 'Tol Semakin Dikebut', 'hendrikawati ', 'http://graph.facebook.com/100002013531460/picture', 'rickacipoet@yahoo.com', '', 'kapan nih penerimaan beasiswa diknas tahun 2010. 28 sept 2010 kemarin kan udah sosialisasi di diknas.. tapi kok lum ada juga pengumuman lagi. ten-temen yang dapat beasiswa pada bertnya-tanya ni.. :(( ', '2010-12-04 17:44:10', 1),
(40, 0, 0, 0, 0, 16, 'Transportasi Yang Efisien', 'ajeng', 'http://graph.facebook.com/100000213226955/picture', 'ajen9m0et_morfabregas@yahoo.com', '', 'sy mau tanya,apa akadibyo ini ada kerjasama dg Rumah sakit2? kira2 mana saja? n apakah lulusan akadibyo terjamin pkerjaannya? misalkan di transfer ke RS? Dan apakah ada program magang di rumah sakit?  sy mnta tolong di balas via email saja dan dikirimkan total biaya selama pendidikan. terimakasih', '2010-12-09 20:23:09', 1),
(41, 0, 0, 0, 0, 14, 'Sample Content Detail', 'tusi', 'http://graph.facebook.com/100001636105240/picture', 'thoesiygemini@yahoo.co.id', '', 'klo dr akuntansi bsa msuk akbid,, pa ujian tulisnya tetap sama', '2010-12-15 12:59:29', 1),
(42, 0, 0, 0, 0, 1, 'Home page', 'Perusahaan', 'http://graph.facebook.com/100011328960689/picture', 'info@perusahaan.ac.id', '', '[ untuk alumni smk akuntansi bisa masuk apa tidak? ]\nOwh tentu saja bisa, perusahaan menerima semua jurusan untuk SMU atau sederajat.. :)', '2011-03-23 13:59:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_content_registrant`
--

CREATE TABLE `bbc_content_registrant` (
  `id` int(255) NOT NULL,
  `content_id` int(255) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bbc_content_related`
--

CREATE TABLE `bbc_content_related` (
  `id` int(255) NOT NULL,
  `content_id` int(255) NOT NULL,
  `related_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_content_related`
--

INSERT INTO `bbc_content_related` (`id`, `content_id`, `related_id`) VALUES
(1, 22, 31),
(2, 14, 2),
(3, 14, 3),
(4, 14, 4),
(5, 14, 5),
(6, 14, 6),
(7, 4, 2),
(8, 4, 3),
(9, 4, 7),
(10, 4, 10),
(11, 4, 13),
(12, 7, 5),
(13, 7, 6),
(14, 7, 4),
(15, 7, 10),
(16, 7, 13),
(17, 6, 5),
(18, 6, 7),
(19, 6, 2),
(20, 6, 3),
(21, 6, 4),
(22, 1, 2),
(23, 1, 3),
(24, 1, 4),
(25, 1, 5),
(26, 1, 6),
(27, 37, 33),
(28, 10, 8),
(29, 10, 9),
(30, 10, 4),
(31, 10, 7),
(32, 10, 13),
(33, 2, 3),
(34, 2, 4),
(35, 2, 5),
(36, 2, 8),
(37, 2, 11),
(38, 13, 4),
(39, 13, 7),
(40, 13, 10),
(41, 13, 11),
(42, 13, 12),
(43, 5, 6),
(44, 5, 7),
(45, 5, 2),
(46, 5, 8),
(47, 5, 11),
(48, 9, 8),
(49, 9, 10),
(50, 9, 2),
(51, 9, 3),
(52, 9, 4),
(53, 11, 2),
(54, 11, 5),
(55, 11, 8),
(56, 11, 12),
(57, 11, 13),
(58, 8, 9),
(59, 8, 10),
(60, 8, 2),
(61, 8, 5),
(62, 8, 11),
(63, 3, 2),
(64, 3, 4),
(65, 3, 5),
(66, 3, 6),
(67, 3, 7),
(68, 24, 28);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_content_schedule`
--

CREATE TABLE `bbc_content_schedule` (
  `id` int(11) UNSIGNED NOT NULL,
  `content_id` int(11) UNSIGNED DEFAULT '0',
  `action` tinyint(1) DEFAULT '0' COMMENT '1=publish, 2=unpublish, 3=delete',
  `action_time` datetime DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bbc_content_tag`
--

CREATE TABLE `bbc_content_tag` (
  `id` int(255) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `total` int(255) DEFAULT '0',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `updated` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bbc_content_tag_list`
--

CREATE TABLE `bbc_content_tag_list` (
  `tag_id` int(255) DEFAULT '0',
  `content_id` int(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bbc_content_text`
--

CREATE TABLE `bbc_content_text` (
  `content_id` int(255) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `tags` text NOT NULL,
  `intro` varchar(255) DEFAULT NULL,
  `content` text,
  `lang_id` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_content_text`
--

INSERT INTO `bbc_content_text` (`content_id`, `title`, `description`, `keyword`, `tags`, `intro`, `content`, `lang_id`) VALUES
(1, 'Home page', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1),
(2, 'Sample Gallery Satu', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(3, 'Sample Gallery Dua', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(4, 'Sample Gallery Tiga', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(5, 'Sample Download File Satu', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(6, 'Sample Download File Dua', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the ', 'Diresmikan, Rumah Bersalin Laras Hati, Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(7, 'Sample Download File Tiga', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(8, 'Sample Youtube Video Satu', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(9, 'Sample Youtube Video Dua', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(10, 'Sample Youtube Video Tiga', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(11, 'Sample Audio Satu', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(12, 'Sample Audio Dua', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(13, 'Sample Audio Tiga', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(14, 'Sample Content Detail', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1);
INSERT INTO `bbc_content_text` (`content_id`, `title`, `description`, `keyword`, `tags`, `intro`, `content`, `lang_id`) VALUES
(15, 'Merevitalisasi Sektor Pelayaran', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(16, 'Transportasi Yang Efisien', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(17, '8 Langkah Hindari Kehilangan Mobil', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever  since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book.', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever  since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book. It has survived not only five  centuries, but also the leap into electronic typesetting, remaining  essentially unchanged. It was popularised in the 1960s with the release  of Letraset sheets containing Lorem Ipsum passages, and more recently  with desktop publishing software like Aldus PageMaker including versions  of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the  readable content of a page when looking at its layout. The point of  using Lorem Ipsum is that it has a more-or-less normal distribution of  letters, as opposed to using \'Content here, content here\', making it  look like readable English. Many desktop publishing packages and web  page editors now use Lorem Ipsum as their default model text, and a  search for \'lorem ipsum\' will uncover many web sites still in their  infancy. Various versions have evolved over the years, sometimes by  accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It  has roots in a piece of classical Latin literature from 45 BC, making it  over 2000 years old. Richard McClintock, a Latin professor at  Hampden-Sydney College in Virginia, looked up one of the more obscure  Latin words, consectetur, from a Lorem Ipsum passage, and going through  the cites of the word in classical literature, discovered the  undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33  of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by  Cicero, written in 45 BC. This book is a treatise on the theory of  ethics, very popular during the Renaissance. The first line of Lorem  Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section  1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced  below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de  Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact  original form, accompanied by English versions from the 1914  translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the  majority have suffered alteration in some form, by injected humour, or  randomised words which don\'t look even slightly believable. If you are  going to use a passage of Lorem Ipsum, you need to be sure there isn\'t  anything embarrassing hidden in the middle of text. All the Lorem Ipsum  generators on the Internet tend to repeat predefined chunks as  necessary, making this the first true generator on the Internet. It uses  a dictionary of over 200 Latin words, combined with a handful of model  sentence structures, to generate Lorem Ipsum which looks reasonable. The  generated Lorem Ipsum is therefore always free from repetition,  injected humour, or non-characteristic words etc.', 1),
(18, 'Indahnya Indonesia dengan menyelam', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(19, 'Bertahan dengan Inovasi', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(20, 'Optimis Melangkah ditahun depan', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(21, 'Bisnis Penyeberangan Potensi yang Terabaikan', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(22, 'Dukung Konektivitas ASEAN', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(23, 'Tantangan Transportasi di Kota 1001 Gua', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(24, 'Keselamatan Harus Jadi Icon', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(25, 'Tingkatkan Pengawasan Perairan, KKP akan Perkuat dengan Kapal Induk', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(26, 'Gencar Tertibkan Knalpot Bising, Ratusan Motor Dipretelin Polisi', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(27, 'Quo Vadis Perkeretaapian Nasional?', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1);
INSERT INTO `bbc_content_text` (`content_id`, `title`, `description`, `keyword`, `tags`, `intro`, `content`, `lang_id`) VALUES
(28, 'MRT Jadi Pertaruhan', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(29, 'Meneropong Redesign Juanda', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(30, 'Apa Kabar Sistranas?', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(31, 'Konektivitas Nusantara', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(32, 'Membumikan Transportasi Ke Ranah Lokal', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(33, 'Nikmat Teh di Pasar Terapung', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ips<img alt=\"ooooh\" src=\"includes/smiley/ooooh.gif\" style=\"height:18px; width:18px\" title=\"ooooh\" />um as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular be<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0\"><param name=\"quality\" value=\"high\" /><param name=\"movie\" value=\"images/modules/content/BannerBatam.swf\" /><embed pluginspage=\"http://www.macromedia.com/go/getflashplayer\" quality=\"high\" src=\"images/modules/content/BannerBatam.swf\" type=\"application/x-shockwave-flash\"></embed></object>lief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et M<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0\"><param name=\"quality\" value=\"high\" /><param name=\"movie\" value=\"images/modules/content/bannerpameran.swf\" /><embed pluginspage=\"http://www.macromedia.com/go/getflashplayer\" quality=\"high\" src=\"images/modules/content/bannerpameran.swf\" type=\"application/x-shockwave-flash\"></embed></object>alorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are al<img alt=\"\" src=\"images/modules/content/bannerbatam.jpg\" style=\"height:158px; width:181px\" />so reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If yo<img alt=\"\" src=\"images/modules/content/IMG_5883.jpg\" style=\"height:300px; width:400px\" />u are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(34, 'Tol Semakin Dikebut', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(35, 'Dermaga Batubara Terbesar', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(36, 'Belawan Terus Berbenah', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(37, 'Pasar Perintis Kian Seksi', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It ha', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1),
(38, 'Garuda Buka Rute Surabaya - Jeddah', 'Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry\'s standard dummy text ever', 'keyword yang bisa di ganti sendiri', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\r\nWhy do we use it?<br />\r\n<br />\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\r\n&nbsp;<br />\r\nWhere does it come from?<br />\r\n<br />\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.<br />\r\n<br />\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br />\r\nWhere can I get some?<br />\r\n<br />\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_content_trash`
--

CREATE TABLE `bbc_content_trash` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content_id` int(255) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `trashed` datetime DEFAULT NULL,
  `restore` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bbc_content_type`
--

CREATE TABLE `bbc_content_type` (
  `id` int(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `detail` text,
  `list` text,
  `menu_id` int(255) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_content_type`
--

INSERT INTO `bbc_content_type` (`id`, `title`, `detail`, `list`, `menu_id`, `active`) VALUES
(1, 'General Content', '{\"template\":\"detail.html.php\",\"title\":\"1\",\"created\":\"1\",\"modified\":\"1\",\"author\":\"1\",\"tag\":\"1\",\"tag_link\":\"1\",\"rating\":\"1\",\"rating_vote\":\"1\",\"thumbsize\":\"250\",\"comment\":\"1\",\"comment_auto\":\"1\",\"comment_list\":\"9\",\"comment_form\":\"1\",\"comment_emoticons\":\"1\",\"comment_spam\":\"0\",\"comment_email\":\"1\",\"pdf\":\"1\",\"print\":\"1\",\"email\":\"1\",\"share\":\"1\"}', '{\"template\":\"list.html.php\",\"title\":\"1\",\"title_link\":\"1\",\"intro\":\"1\",\"created\":\"1\",\"modified\":\"1\",\"author\":\"1\",\"tag\":\"1\",\"tag_link\":\"1\",\"rating\":\"1\",\"read_more\":\"1\",\"tot_list\":\"12\",\"thumbnail\":\"1\"}', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_cpanel`
--

CREATE TABLE `bbc_cpanel` (
  `id` int(255) UNSIGNED NOT NULL,
  `par_id` int(255) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `act` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_shortcut` tinyint(1) DEFAULT '0',
  `orderby` int(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_cpanel`
--

INSERT INTO `bbc_cpanel` (`id`, `par_id`, `title`, `image`, `act`, `link`, `is_shortcut`, `orderby`, `active`) VALUES
(1, 0, 'Configuration', 'config.png', 'config', 'index.php?mod=_cpanel.config', 0, 2, 1),
(2, 0, 'User Manager', 'user.png', 'user', 'index.php?mod=_cpanel.user', 0, 14, 1),
(3, 0, 'Manage Content', 'content.png', 'main', 'index.php?mod=_cpanel.content', 0, 7, 1),
(4, 0, 'Block Manager', 'block.png', 'block', 'index.php?mod=_cpanel.block', 0, 1, 1),
(5, 0, 'Site Template', 'template.png', 'template', 'index.php?mod=_cpanel.template', 0, 10, 1),
(6, 0, 'User Group', 'group.png', 'group', 'index.php?mod=_cpanel.group', 0, 13, 1),
(7, 0, 'Menu Manager', 'menu.png', 'menu', 'index.php?mod=_cpanel.menu', 0, 8, 1),
(8, 0, 'Welcome Message', 'home.png', 'home', 'index.php?mod=_cpanel.home', 0, 15, 1),
(9, 0, 'Third Party App', 'application.png', 'application', 'index.php?mod=_cpanel.application', 0, 12, 1),
(10, 0, 'Modules Manager', 'modules.png', 'modules', 'index.php?mod=_cpanel.module', 0, 9, 1),
(11, 0, 'Language', 'language.png', 'language', 'index.php?mod=_cpanel.language', 0, 6, 1),
(12, 0, 'Content Trash', 'trash.png', 'trash', 'index.php?mod=_cpanel.trash', 0, 3, 1),
(13, 0, 'Email Template', 'email.png', 'email', 'index.php?mod=_cpanel.email', 0, 4, 1),
(14, 0, 'File Manager', 'filemanager.png', 'main', 'index.php?mod=_cpanel.filemanager', 0, 5, 1),
(15, 0, 'System Tools', 'tools.png', 'tools', 'index.php?mod=_cpanel.tools', 0, 11, 1),
(16, 2, 'User Field', 'field.png', 'field', 'index.php?mod=_cpanel.user&act=field', 0, 1, 1),
(17, 4, 'Block Theme', 'theme.png', 'block', 'index.php?mod=_cpanel.block&act=theme', 0, 2, 1),
(18, 4, 'Block Position', 'block_position.png', 'block', 'index.php?mod=_cpanel.block&act=block_position', 0, 1, 1),
(19, 5, 'Edit CSS Style', 'editcss.png', 'template', 'index.php?mod=_cpanel.template&act=editCSS', 0, 1, 1),
(20, 7, 'Menu Position', 'position.png', 'menu', 'index.php?mod=_cpanel.menu&act=position', 0, 1, 1),
(21, 11, 'Language Reference', 'reference.png', 'language', 'index.php?mod=_cpanel.language&act=reference', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_email`
--

CREATE TABLE `bbc_email` (
  `id` int(255) NOT NULL,
  `module_id` int(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `global_subject` enum('0','1') DEFAULT '1',
  `global_footer` enum('0','1') DEFAULT '1',
  `global_email` enum('0','1') DEFAULT '1',
  `from_email` varchar(255) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `is_html` tinyint(1) NOT NULL DEFAULT '0',
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_email`
--

INSERT INTO `bbc_email` (`id`, `module_id`, `name`, `global_subject`, `global_footer`, `global_email`, `from_email`, `from_name`, `is_html`, `description`) VALUES
(1, 2, 'comment_post', '1', '1', '1', '', '', 0, 'when visitor post the comment '),
(2, 2, 'password', '1', '1', '1', '', '', 0, 'password reminder'),
(3, 2, 'register_confirm', '1', '1', '1', '', '', 0, 'registration complete and Global Configuration in \"auto approval\" is ON'),
(4, 2, 'register_pending', '1', '1', '1', '', '', 0, 'registration complete and Global Configuration in \"auto approval\" is OFF'),
(5, 2, 'register_success', '1', '1', '1', '', '', 0, 'Validate Registration is success'),
(6, 4, 'entry_post', '1', '1', '1', '', '', 0, 'if public user post a new article'),
(7, 4, 'download_register', '1', '1', '1', '', '', 0, 'register to download'),
(8, 6, 'contact', '1', '1', '1', '', '', 0, 'auto reply from Contact Us Form.'),
(12, 7, 'guestbook', '1', '1', '1', '', '', 0, 'auto reply from Guestbook Form.'),
(13, 9, 'entry', '1', '1', '1', '', '', 0, 'posted survey'),
(14, 10, 'testimonial', '1', '1', '1', '', '', 0, 'auto reply from Testimonial Form.');

-- --------------------------------------------------------

--
-- Table structure for table `bbc_email_text`
--

CREATE TABLE `bbc_email_text` (
  `email_id` int(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text,
  `lang_id` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_email_text`
--

INSERT INTO `bbc_email_text` (`email_id`, `subject`, `content`, `lang_id`) VALUES
(1, 'Dear [name], thank for your comment', 'Dear [name]\r\n\r\n[date]\r\nTitle   : [title]\r\nLink    : [link]\r\nName    : [name]\r\nEmail   : [email]\r\nWebsite : [website]\r\nComment :\r\n   [message]\r\n\r\n\r\n[status]', 1),
(2, 'Password reminder', 'Dear [name],\r\n\r\n/* INFORMATION LOGIN */\r\nUSERNAME : [username]\r\nPASSWORD: [password]\r\n\r\nThank You for stay in touch with us.', 1),
(3, 'Link Validasi Pendaftaran', 'dear [name],\r\n\r\nProses pendaftaran telah selesai, account akan dibuat setelah anda mengakses halaman di bawah ini :\r\n[validateLink]\r\n\r\nApabila link diatas tidak bisa diakses, anda bisa mengaksesnya dengan cara kopi text di atas kemudian paste link tsb di bowser untuk mengaksesnya', 1),
(4, 'Terimakasih, data anda telah kami simpan', 'dear [name],\r\n\r\nTerimakasih data diri pendaftaran anda telah kami simpan. Kami akan menghubungi anda secepatnya.\r\n\r\nBerikut data diri yang telah anda masukkan :\r\n[memberdata]', 1),
(5, 'Pendaftaran Selesai, Account Telah Kami Buat', 'dear [name],\r\n\r\nTerimakasih proses pendaftaran telah selesai, data anda akan kami simpan sekaligus account untuk member telah kami buatkan\r\nBerikut Data Diri Yang Telah anda masukkan :\r\n[memberdata]\r\n\r\n/* LOGIN INFORMATION */\r\nUSERNAME :  [username]\r\nPASSWORD : [password]\r\nGunakan account informasi di atas untuk login ke situs, password di atas bersifat temporary. Anda bisa mengganti password sesuai keinginan anda dengan cara login ke situs kami.', 1),
(6, 'New entry has been posted by user', '[title]\r\n\r\n[intro]\r\n\r\n[status]\r\n[link]', 1),
(7, 'Download Your File ([title])', 'Silahkan download file anda dengan klik link dibawah ini\r\n[url]\r\n\r\n', 1),
(8, 'Thank for your concern', 'Thank you [name] for your concern to our site.\r\n\r\n[detail]\r\nYour message :\r\n [message]\r\n\r\nyour email has been sent to our mailbox, and will be process in 1x24hours.\r\n', 1),
(12, 'Thank for your concern', 'Thank you [name] for your concern to our site.\r\n\r\n[detail]\r\n', 1),
(13, 'thank you [name] for your time', 'dear [name],\r\n\r\nThank you for your time to fulfill our form survey, we will take all incoming opinions and suggestions from visitor as our priority reference in expanding our offering services.\r\n\r\nThank You', 1),
(14, 'Thank for your concern', 'Thank you [name] for your concern to our site.\r\n\r\n[detail]\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_lang`
--

CREATE TABLE `bbc_lang` (
  `id` int(25) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_lang`
--

INSERT INTO `bbc_lang` (`id`, `title`, `code`) VALUES
(1, 'Indonesia', 'id');

-- --------------------------------------------------------

--
-- Table structure for table `bbc_lang_code`
--

CREATE TABLE `bbc_lang_code` (
  `id` int(255) NOT NULL,
  `module_id` int(255) NOT NULL DEFAULT '0',
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_lang_code`
--

INSERT INTO `bbc_lang_code` (`id`, `module_id`, `code`) VALUES
(1, 0, 'total visitor'),
(2, 0, 'visitors'),
(3, 0, 'total member'),
(4, 0, 'members'),
(5, 0, 'online member'),
(6, 0, 'user'),
(7, 0, 'online user'),
(8, 0, 'year'),
(9, 0, 'months'),
(10, 0, 'weeks'),
(11, 0, 'actived'),
(12, 0, 'search'),
(13, 0, 'home'),
(14, 0, 'users'),
(15, 0, 'day'),
(16, 0, 'select template option'),
(17, 2, 'not found'),
(18, 2, 'my profile'),
(19, 2, 'username'),
(20, 2, 'name'),
(21, 2, 'nick name'),
(22, 2, 'company'),
(23, 2, 'company position'),
(24, 2, 'address'),
(25, 2, 'city'),
(26, 2, 'state'),
(27, 2, 'post code'),
(28, 2, 'country'),
(29, 2, 'phone'),
(30, 2, 'fax'),
(31, 2, 'email alternate'),
(32, 2, 'email'),
(33, 2, 'validation code'),
(34, 2, ' must not empty'),
(35, 2, 'registration form'),
(36, 2, 'fill form below'),
(37, 2, 'register finish pending'),
(38, 2, 'register finish auto'),
(39, 2, 'register success expired'),
(40, 2, 'register success commit'),
(41, 2, 'register success failed'),
(42, 2, 'email is already registered'),
(43, 3, 'search result'),
(44, 3, 'results'),
(45, 3, 'of'),
(46, 3, 'for'),
(47, 4, 'author'),
(48, 4, 'created'),
(49, 4, 'read more'),
(50, 4, 'tags'),
(51, 4, 'modified'),
(52, 4, 'last modified'),
(53, 4, 'convert to pdf'),
(54, 4, 'tell friends'),
(55, 4, 'print preview'),
(56, 4, 'comment feed'),
(57, 4, 'comments'),
(58, 4, 'post your comment'),
(59, 4, 'name'),
(60, 4, 'email'),
(61, 4, 'website'),
(62, 4, 'comment'),
(63, 4, 'insert code above'),
(64, 4, 'failed to submit comment'),
(65, 4, 'validation code is incorrect'),
(66, 4, 'name is empty'),
(67, 4, 'email is empty'),
(68, 4, 'email is invalid'),
(69, 4, 'url is invalid'),
(70, 4, 'comment is empty'),
(71, 4, 'comment approved auto'),
(72, 4, 'category feed'),
(73, 4, 'print'),
(74, 4, 'close'),
(75, 4, 'email tool message default'),
(76, 4, 'email tool from empty'),
(77, 4, 'email tool from invalid'),
(78, 4, 'email tool to empty'),
(79, 4, 'email tool subject empty'),
(80, 4, 'email tool from'),
(81, 4, 'email tool to'),
(82, 4, 'email tool subject'),
(83, 4, 'email tool message'),
(84, 4, 'email tool'),
(85, 4, 'Found'),
(86, 4, 'match data'),
(87, 4, 'listed'),
(88, 4, 'item'),
(89, 4, 'search not found'),
(90, 4, 'insert keyword'),
(91, 4, 'not found'),
(92, 4, 'posted list'),
(93, 4, 'content inactive'),
(94, 4, 'edit content'),
(95, 4, 'entry approved auto'),
(96, 4, 'entry approved manual'),
(97, 4, 'succeed to update content'),
(98, 4, 'failed to update content'),
(99, 4, 'entry edit'),
(100, 4, 'entry add'),
(101, 4, 'email tool success'),
(102, 4, 'comment approved manual'),
(103, 4, 'related articles'),
(104, 4, 'content list'),
(105, 4, 'article list'),
(106, 4, 'page'),
(107, 4, 'of'),
(108, 4, 'pages'),
(109, 4, 'voter'),
(110, 4, 'keyword here...'),
(111, 4, 'please insert keyword!'),
(112, 4, 'username'),
(113, 4, 'password'),
(114, 4, 'remember me'),
(115, 4, 'forget password ?'),
(116, 4, 'register'),
(117, 4, 'login'),
(118, 4, 'gallery list'),
(119, 4, 'download list'),
(120, 4, 'voters'),
(121, 4, 'video list'),
(122, 4, 'audio list'),
(123, 5, 'cal_august'),
(124, 5, 'cal_su'),
(125, 5, 'cal_mo'),
(126, 5, 'cal_tu'),
(127, 5, 'cal_we'),
(128, 5, 'cal_th'),
(129, 5, 'cal_fr'),
(130, 5, 'cal_sa'),
(131, 5, 'agenda calendar'),
(132, 5, 'cal_july'),
(133, 5, 'no schedule'),
(134, 5, 'weekly agenda'),
(135, 5, 'cal_september'),
(136, 5, 'cal_october'),
(137, 5, 'cal_november'),
(138, 5, 'cal_december'),
(139, 5, 'cal_january'),
(140, 5, 'cal_february'),
(141, 5, 'cal_march'),
(142, 5, 'cal_april'),
(143, 5, 'cal_may'),
(144, 5, 'cal_june'),
(145, 5, 'cal_sunday'),
(146, 5, 'cal_monday'),
(147, 5, 'cal_tuesday'),
(148, 5, 'cal_wednesday'),
(149, 5, 'cal_thursday'),
(150, 5, 'cal_friday'),
(151, 5, 'cal_saturday'),
(152, 6, 'contact form'),
(153, 6, 'name'),
(154, 6, 'nick name'),
(155, 6, 'address'),
(156, 6, 'city'),
(157, 6, 'state'),
(158, 6, 'post code'),
(159, 6, 'country'),
(160, 6, 'phone'),
(161, 6, 'fax'),
(162, 6, 'company'),
(163, 6, 'company position'),
(164, 6, 'email'),
(165, 6, 'message'),
(166, 6, 'validation code'),
(167, 6, 'title'),
(168, 6, ' must not empty'),
(169, 7, 'guestbook'),
(170, 7, 'add guestbook'),
(171, 7, 'post guestbook'),
(172, 7, 'name'),
(173, 7, 'company'),
(174, 7, 'address'),
(175, 7, 'email'),
(176, 7, 'message'),
(177, 7, 'validation code'),
(178, 7, 'use form below'),
(179, 7, ' must not empty'),
(180, 7, 'guestbook empty'),
(181, 7, 'guest book sent'),
(182, 7, 'finished'),
(183, 8, 'link exchange'),
(184, 9, 'polling finished'),
(185, 9, 'polling result'),
(186, 9, 'check input'),
(187, 9, 'checkbox option'),
(188, 9, 'error'),
(189, 9, 'insert notes'),
(190, 9, 'multiple option'),
(191, 9, 'no selection'),
(192, 9, 'please select'),
(193, 9, 'radio option'),
(194, 9, 'select option'),
(195, 9, 'thank you'),
(196, 9, 'submit'),
(197, 9, 'view result'),
(198, 10, 'testimonial'),
(199, 10, 'add testimonial'),
(200, 10, 'post testimonial'),
(201, 10, 'name'),
(202, 10, 'company'),
(203, 10, 'address'),
(204, 10, 'email'),
(205, 10, 'message'),
(206, 10, 'validation code'),
(207, 10, 'use form below'),
(208, 10, ' must not empty'),
(209, 10, 'finished'),
(210, 10, 'testimonial empty'),
(211, 10, 'testimonial sent');

-- --------------------------------------------------------

--
-- Table structure for table `bbc_lang_text`
--

CREATE TABLE `bbc_lang_text` (
  `text_id` int(255) NOT NULL,
  `code_id` int(255) NOT NULL,
  `lang_id` int(255) NOT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_lang_text`
--

INSERT INTO `bbc_lang_text` (`text_id`, `code_id`, `lang_id`, `content`) VALUES
(1, 1, 1, 'Total Pengunjung'),
(2, 2, 1, 'Pengunjung'),
(3, 3, 1, 'Jumlah Member'),
(4, 4, 1, 'member'),
(5, 5, 1, 'Member Aktif'),
(6, 6, 1, 'User'),
(7, 7, 1, 'User aktif'),
(8, 8, 1, 'Tahun'),
(9, 9, 1, 'Bulan'),
(10, 10, 1, 'Minggu'),
(11, 11, 1, 'Aktif'),
(12, 12, 1, 'Cari'),
(13, 13, 1, 'Home'),
(14, 14, 1, 'users'),
(15, 15, 1, 'Hari'),
(16, 16, 1, 'Gantilah opsi di bawah untuk melihat website dalam tampilan lain<br />\r\n'),
(17, 17, 1, 'Maaf, halaman yang ingin anda akses tidak ditemukan dalam situs. Silahkan kunjungi halaman berdasarkan menu yang telah disediakan.'),
(18, 18, 1, 'Profile Saya'),
(19, 19, 1, 'Username'),
(20, 20, 1, 'Nama'),
(21, 21, 1, 'Nama Panggilan'),
(22, 22, 1, 'Nama Perusahaan'),
(23, 23, 1, 'Jabatan'),
(24, 24, 1, 'Alamat'),
(25, 25, 1, 'Kota'),
(26, 26, 1, 'Provinsi'),
(27, 27, 1, 'Kode Pos'),
(28, 28, 1, 'Negara'),
(29, 29, 1, 'Telepon'),
(30, 30, 1, 'Fax'),
(31, 31, 1, 'Email Alternatif'),
(32, 32, 1, 'Email'),
(33, 33, 1, 'Kode Validasi'),
(34, 34, 1, ' tidak boleh kosong'),
(35, 35, 1, 'Form Pendaftaran Member'),
(36, 36, 1, 'Silahkan isi form di bawah untuk mendaftarkan diri sebagai member kami '),
(37, 37, 1, 'Terimakasih,<br />\r\n<br />\r\nData diri anda telah kami simpan sebagai bahan review, <br />\r\nKami akan memberikan kabar selanjutnya apabila proses review telah selesai<br />\r\n<br />\r\nBest Regards,<br />\r\nAdmin'),
(38, 38, 1, 'Terimakasih,<br />\r\n<br />\r\nProses pendaftaran telah kami simpan.<br />\r\nLink validasi telah kami kirim ke email anda, proses pendaftaran akan selesai dengan cara mengklik link yang telah kami kirimkan.<br />\r\n<br />\r\nSilahkan check inbox email anda !'),
(39, 39, 1, 'Link validasi telah expired, silahkan ulangi proses pendaftaran dan masukkan kembali data diri anda <a href=\\\\\\\"user/register\\\\\\\">klik di sini</a> untuk pendaftaran ulang.'),
(40, 40, 1, 'Dear [name],<br />\r\n<br />\r\nProses pendaftaran telah selesai, dan data diri anda telah kami kirim ke email.<br />\r\nUntuk melakukan login ke situs anda bisa menggunakan account yang telah kami kirimkan.<br />\r\n<br />\r\nTerimakasih.'),
(41, 41, 1, 'Maaf, validasi pendaftaran telah gagal.<br />\r\n<br />\r\n<a href=\\\\\\\"user/register\\\\\\\">Klik di sini</a> untuk mengulangi proses pendaftaran'),
(42, 42, 1, 'Email yang anda masukkan telah teregister, silahkan tunggu respon dari admin'),
(43, 43, 1, 'Hasil Pencarian'),
(44, 44, 1, 'Hasil'),
(45, 45, 1, 'dari'),
(46, 46, 1, 'Untuk'),
(47, 47, 1, 'Author : '),
(48, 48, 1, 'Dibuat : '),
(49, 49, 1, 'Selanjutnya'),
(50, 50, 1, 'Tags :'),
(51, 51, 1, 'Disunting : '),
(52, 52, 1, 'Terakhir disunting : '),
(53, 53, 1, 'Konversi ke pdf'),
(54, 54, 1, 'Kasih tahu teman'),
(55, 55, 1, 'Print Preview'),
(56, 56, 1, 'RSS Komentar'),
(57, 57, 1, 'Komentar'),
(58, 58, 1, 'Berikan komentar anda'),
(59, 59, 1, 'Nama'),
(60, 60, 1, 'Email'),
(61, 61, 1, 'Website'),
(62, 62, 1, 'Komentar'),
(63, 63, 1, 'Masukkan kode diatas'),
(64, 64, 1, 'Maaf komentar anda gagal dimasukkan'),
(65, 65, 1, 'Kode validasi tidak benar'),
(66, 66, 1, 'Mohon masukkan nama anda'),
(67, 67, 1, 'Alamat email anda masih kosong'),
(68, 68, 1, 'Mohon masukkan email yang valid untuk validasi'),
(69, 69, 1, 'URL anda tidak valid'),
(70, 70, 1, 'Silahkan masukkan komentar anda'),
(71, 71, 1, 'Komentar anda telah di publikasikan, Terimakasih atas perhatian anda'),
(72, 72, 1, 'RSS Halaman'),
(73, 73, 1, 'Print'),
(74, 74, 1, 'Tutup'),
(75, 75, 1, 'Silahkan lihat content yang bagus ini !'),
(76, 76, 1, 'Silahkan masukkan email anda pada field Dari'),
(77, 77, 1, 'Anda memasukkan email yang tidak valid'),
(78, 78, 1, 'Email tujuan masih kosong'),
(79, 79, 1, 'Maaf judul anda masih kosong'),
(80, 80, 1, 'Dari email'),
(81, 81, 1, 'Ke email'),
(82, 82, 1, 'Judul'),
(83, 83, 1, 'Pesan'),
(84, 84, 1, 'NB : Beritahukan artikel ini kepada kawan anda melalui email. Anda bisa memasukkan alamat email lebih dari satu dengan dipisahkan dengan koma \\\\\\\",\\\\\\\"'),
(85, 85, 1, 'Ditemukan'),
(86, 86, 1, 'Data yang cocok'),
(87, 87, 1, 'Daftar'),
(88, 88, 1, 'item'),
(89, 89, 1, 'Kata kunci yang anda cari tidak ditemukan silahkan masukkan kata kunci yang lain !'),
(90, 90, 1, 'Silahkan masukkan kata kunci yang ingin cari di form field di atas !'),
(91, 91, 1, 'Daftar halaman masih kosong, silahkan pilih halaman berdasarkan menu yang telah disediakan'),
(92, 92, 1, 'Artikel artikel anda'),
(93, 93, 1, 'halaman tidak aktif'),
(94, 94, 1, 'Ubah artikel ini'),
(95, 95, 1, 'Halaman baru yang anda masukan telah di publish'),
(96, 96, 1, 'Posting baru anda menunggu di approved oleh admin'),
(97, 97, 1, 'Update halaman telah berhasil'),
(98, 98, 1, 'Update halaman telah gagal'),
(99, 99, 1, 'Edit Halaman'),
(100, 100, 1, 'Posting Halaman Baru'),
(101, 101, 1, 'Email anda telah diproses.'),
(102, 102, 1, 'Terimakasih komentar anda akan di approved oleh admin dan akan terpublish secepatnya'),
(103, 103, 1, 'Artikel Berhubungan'),
(104, 104, 1, 'Daftar Content'),
(105, 105, 1, 'Daftar Artikel'),
(106, 106, 1, 'halaman'),
(107, 107, 1, 'dari'),
(108, 108, 1, 'halaman'),
(109, 109, 1, 'voter'),
(110, 110, 1, 'kata kunci di sini...'),
(111, 111, 1, 'Silahkan masukkan kata kunci!'),
(112, 112, 1, 'Username'),
(113, 113, 1, 'Password'),
(114, 114, 1, 'Ingat saya'),
(115, 115, 1, 'Lupa Password ?'),
(116, 116, 1, 'Registrasi'),
(117, 117, 1, 'Login'),
(118, 118, 1, 'Daftar Gallery'),
(119, 119, 1, 'Daftar File Download'),
(120, 120, 1, 'voters'),
(121, 121, 1, 'Daftar Video'),
(122, 122, 1, 'Daftar Audio'),
(123, 123, 1, 'Agustus'),
(124, 124, 1, 'Mi'),
(125, 125, 1, 'Se'),
(126, 126, 1, 'Se'),
(127, 127, 1, 'Ra'),
(128, 128, 1, 'Ka'),
(129, 129, 1, 'Ju'),
(130, 130, 1, 'Sa'),
(131, 131, 1, 'Kalender Agenda'),
(132, 132, 1, 'Juli'),
(133, 133, 1, 'Tidak ada jadwal atau jadwal masih kosong'),
(134, 134, 1, 'Agenda Mingguan'),
(135, 135, 1, 'September'),
(136, 136, 1, 'Oktober'),
(137, 137, 1, 'November'),
(138, 138, 1, 'Desember'),
(139, 139, 1, 'Januari'),
(140, 140, 1, 'Febuari'),
(141, 141, 1, 'Maret'),
(142, 142, 1, 'April'),
(143, 143, 1, 'Mei'),
(144, 144, 1, 'Juni'),
(145, 145, 1, 'Minggu'),
(146, 146, 1, 'Senin'),
(147, 147, 1, 'Selasa'),
(148, 148, 1, 'Rabu'),
(149, 149, 1, 'Kamis'),
(150, 150, 1, 'Jumat'),
(151, 151, 1, 'Sabtu'),
(152, 152, 1, 'Formulir Hubungi Kami'),
(153, 153, 1, 'Nama'),
(154, 154, 1, 'Nama Panggilan'),
(155, 155, 1, 'Alamat'),
(156, 156, 1, 'Kota'),
(157, 157, 1, 'Propinsi'),
(158, 158, 1, 'Kodepos'),
(159, 159, 1, 'Negara'),
(160, 160, 1, 'Telepon'),
(161, 161, 1, 'Fax'),
(162, 162, 1, 'Nama Perusahaan'),
(163, 163, 1, 'Jabatan'),
(164, 164, 1, 'Email'),
(165, 165, 1, 'Pesan'),
(166, 166, 1, 'Kode Validasi'),
(167, 167, 1, 'Lengkapi Form Di Bawah untuk menghubungi kami melalui email'),
(168, 168, 1, ' Tidak boleh kosong'),
(169, 169, 1, 'Buku Tamu'),
(170, 170, 1, 'Tambah Buku Tamu'),
(171, 171, 1, 'Masukkan Buku Tamu'),
(172, 172, 1, 'Nama'),
(173, 173, 1, 'Nama Perusahaan'),
(174, 174, 1, 'Alamat'),
(175, 175, 1, 'Email'),
(176, 176, 1, 'Pesan'),
(177, 177, 1, 'Kode Validasi'),
(178, 178, 1, 'Gunakan formulir di bawah untuk mengisi buku tamu'),
(179, 179, 1, 'tidak boleh kosong'),
(180, 180, 1, 'Maaf, daftar buku tamu masih kosong atau tidak ada yg dipublikasikan. Silahkan masukkan data diri anda dengan cara meng-klik link dibawah !'),
(181, 181, 1, 'Buku tamu terkirim'),
(182, 182, 1, 'Dear [name],<br />\r\n<br />\r\nTerimakasih telah menyempatkan waktu anda untuk mengisi formulir buku tamu ini. Data diri anda telah kami simpan dalam database kami. Adapun data buku tamu yang telah anda berikan akan kami publikasikan tanpa menampilkan data personal anda seperti email / nomor telpon / alamat demi menjaga privasi anda.<br />\r\n<br />\r\nSalam hormat'),
(183, 183, 1, 'Exchange Links'),
(184, 184, 1, 'Proses Polling telah selesai, terimakasih atas waktu anda'),
(185, 185, 1, 'Hasil Polling'),
(186, 186, 1, 'Salah satu jawaban yang anda berikan tidak valid, mohon perbaiki jawaban anda !'),
(187, 187, 1, 'Pilih jawaban yang menurut anda benar :'),
(188, 188, 1, 'Pesan Error :'),
(189, 189, 1, 'Masukkan catatan mengenai jawaban anda :'),
(190, 190, 1, 'Check pilihan yang menurut anda benar :'),
(191, 191, 1, 'Mohon perbaiki jawaban anda !'),
(192, 192, 1, 'Silahkan pilih tema yang ingin anda voting !'),
(193, 193, 1, 'Silahkan pilih salah satu opsi :'),
(194, 194, 1, 'Tentukan Pilihan :'),
(195, 195, 1, 'Dear [name],<br />\r\n<br />\r\nTerimakasih atas waktu anda dalam mengisi formulir survey kami, kami akan menerima semua pendapat dan saran dari pengunjung demi peningkatan kinerja kami. Dengan mengisikan form survey berarti anda membantu kami dalam meningkatkan kualitas layanan dari kami.<br />\r\n<br />\r\nHormat Kami,<br />\r\nAdministrator'),
(196, 196, 1, 'Submit'),
(197, 197, 1, 'View Result'),
(198, 198, 1, 'Testimonial User'),
(199, 199, 1, 'Tambahkan Testimoni'),
(200, 200, 1, 'Post Testimoni'),
(201, 201, 1, 'Nama'),
(202, 202, 1, 'Nama Perusahaan'),
(203, 203, 1, 'Alamat'),
(204, 204, 1, 'Email'),
(205, 205, 1, 'Pesan'),
(206, 206, 1, 'Kode Validasi'),
(207, 207, 1, 'Silahkan isi form di bawah untuk memberikan testimoni ke kami. Testimoni dari anda sangat lah membantu kami dalam peningkatan kinerja'),
(208, 208, 1, 'tidak boleh kosong'),
(209, 209, 1, 'Dear [name],<br />\r\n<br />\r\nTerimakasih telah menyempatkan waktu anda untuk mengisi formulir testimoni ini. Testimoni anda telah kami simpan dalam database kami, respon secepatnya akan kami berikan jika testimoni anda adalah pertanyaan. Adapun testimoni yang telah anda berikan akan kami publikasikan tanpa menampilkan data personal anda seperti email / nomor telpon / alamat demi menjaga privasi anda.<br />\r\n<br />\r\nSalam hormat'),
(210, 210, 1, 'Maaf, daftar testimonial masih kosong atau tidak ada yg dipublikasikan. Silahkan masukkan testimoni anda dengan cara meng-klik link dibawah !'),
(211, 211, 1, 'Testimoni terkirim');

-- --------------------------------------------------------

--
-- Table structure for table `bbc_log`
--

CREATE TABLE `bbc_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bbc_menu`
--

CREATE TABLE `bbc_menu` (
  `id` int(255) NOT NULL,
  `par_id` int(255) NOT NULL DEFAULT '0',
  `module_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `seo` varchar(255) DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `orderby` int(255) UNSIGNED NOT NULL DEFAULT '1',
  `cat_id` int(255) NOT NULL DEFAULT '0',
  `protected` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_shortcut` tinyint(1) DEFAULT '0',
  `is_content` tinyint(1) NOT NULL DEFAULT '0',
  `is_content_cat` tinyint(1) NOT NULL DEFAULT '0',
  `content_cat_id` int(255) NOT NULL DEFAULT '0',
  `content_id` int(255) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_menu`
--

INSERT INTO `bbc_menu` (`id`, `par_id`, `module_id`, `seo`, `link`, `orderby`, `cat_id`, `protected`, `is_admin`, `is_shortcut`, `is_content`, `is_content_cat`, `content_cat_id`, `content_id`, `active`) VALUES
(1, 0, 4, '', 'index.php?mod=content.main', 1, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(2, 1, 4, '', 'index.php?mod=content.content', 1, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(3, 1, 4, '', 'index.php?mod=content.content_add', 2, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(4, 1, 4, '', 'index.php?mod=content.category', 3, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(5, 1, 4, '', 'index.php?mod=content.comment', 4, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(6, 1, 4, '', 'index.php?mod=content.type', 5, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(7, 1, 4, '', 'index.php?mod=content.tag', 6, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(8, 1, 4, '', 'index.php?mod=content.config', 7, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(9, 0, 5, '', 'index.php?mod=agenda.main', 2, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(10, 0, 6, '', 'index.php?mod=contact.main', 3, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(11, 10, 6, '', 'index.php?mod=contact.posted', 1, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(12, 10, 6, '', 'index.php?mod=contact.messenger', 2, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(13, 10, 6, '', 'index.php?mod=contact.setting', 3, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(14, 0, 7, '', 'index.php?mod=guestbook.main', 4, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(15, 14, 7, '', 'index.php?mod=guestbook.list', 1, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(16, 14, 7, '', 'index.php?mod=guestbook.setting', 2, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(17, 0, 11, '', 'index.php?mod=imageslider.main', 5, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(18, 17, 11, '', 'index.php?mod=imageslider.list', 1, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(19, 17, 11, '', 'index.php?mod=imageslider.category', 2, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(20, 0, 8, '', 'index.php?mod=links.main', 7, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(21, 20, 8, '', 'index.php?mod=links.list', 1, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(22, 20, 8, '', 'index.php?mod=links.share', 2, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(23, 20, 8, '', 'index.php?mod=links.advertise', 3, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(24, 0, 9, '', 'index.php?mod=survey.main', 8, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(25, 24, 9, '', 'index.php?mod=survey.posted', 1, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(26, 24, 9, '', 'index.php?mod=survey.question', 2, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(27, 24, 9, '', 'index.php?mod=survey.polling', 3, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(28, 24, 9, '', 'index.php?mod=survey.config', 4, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(29, 0, 10, '', 'index.php?mod=testimonial.main', 9, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(30, 29, 10, '', 'index.php?mod=testimonial.list', 1, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(31, 29, 10, '', 'index.php?mod=testimonial.add', 2, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(32, 29, 10, '', 'index.php?mod=testimonial.setting', 3, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(33, 0, 3, '', 'index.php?mod=search.main', 10, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(34, 0, 2, '', 'index.php?mod=user.password', 11, 1, 1, 1, 0, 0, 0, 0, 0, 0),
(35, 0, 1, '', 'index.php?mod=_cpanel.main', 12, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(36, 0, 5, 'home', '', 1, 1, 0, 0, 0, 0, 0, 0, 0, 1),
(37, 0, 10, 'testimonial', 'index.php?mod=testimonial.main', 1, 2, 0, 0, 0, 0, 0, 0, 0, 1),
(38, 0, 2, 'my-profile', 'index.php?mod=user.account', 1, 3, 1, 0, 0, 0, 0, 0, 0, 1),
(39, 0, 4, 'my-content', 'index.php?mod=content.posted', 2, 3, 1, 0, 0, 0, 0, 0, 0, 1),
(40, 0, 5, 'agenda', 'index.php?mod=agenda.main', 2, 2, 0, 0, 0, 0, 0, 0, 0, 1),
(41, 40, 5, 'kalender', 'index.php?mod=agenda.calendar', 1, 2, 0, 0, 0, 0, 0, 0, 0, 1),
(42, 40, 5, 'rutinitas', 'index.php?mod=agenda.routine', 2, 2, 0, 0, 0, 0, 0, 0, 0, 1),
(43, 40, 5, 'event', 'index.php?mod=agenda.events', 3, 2, 0, 0, 0, 0, 0, 0, 0, 1),
(44, 40, 5, 'harian', 'index.php?mod=agenda.daily', 4, 2, 0, 0, 0, 0, 0, 0, 0, 1),
(45, 40, 5, 'mingguan', 'index.php?mod=agenda.weekly', 5, 2, 0, 0, 0, 0, 0, 0, 0, 1),
(46, 40, 5, 'bulanan', 'index.php?mod=agenda.monthly', 6, 2, 0, 0, 0, 0, 0, 0, 0, 1),
(47, 40, 5, 'tahunan', 'index.php?mod=agenda.yearly', 7, 2, 0, 0, 0, 0, 0, 0, 0, 1),
(48, 0, 4, 'about-us', 'index.php?mod=content.detail&id=14&title=Penandatanganan Bantuan Kapal Penyebrangan', 2, 1, 0, 0, 0, 1, 0, 0, 14, 1),
(49, 0, 4, 'content', 'index.php?mod=content.latest', 3, 1, 0, 0, 0, 0, 0, 0, 0, 1),
(50, 49, 4, 'artikel', 'index.php?mod=content.article', 1, 1, 0, 0, 0, 0, 0, 0, 0, 1),
(51, 49, 4, 'gallery', 'index.php?mod=content.gallery', 2, 1, 0, 0, 0, 0, 0, 0, 0, 1),
(52, 49, 4, 'download', 'index.php?mod=content.download', 3, 1, 0, 0, 0, 0, 0, 0, 0, 1),
(53, 49, 4, 'video', 'index.php?mod=content.video', 4, 1, 0, 0, 0, 0, 0, 0, 0, 1),
(54, 49, 4, 'audio', 'index.php?mod=content.audio', 5, 1, 0, 0, 0, 0, 0, 0, 0, 1),
(55, 0, 4, 'create-content', 'index.php?mod=content.posted_form', 3, 3, 1, 0, 0, 0, 0, 0, 0, 1),
(56, 0, 9, 'survey', 'index.php?mod=survey.main', 3, 2, 0, 0, 0, 0, 0, 0, 0, 1),
(57, 0, 2, 'change-password', 'index.php?mod=user.password', 4, 3, 1, 0, 0, 0, 0, 0, 0, 1),
(58, 0, 4, 'pencarian', 'index.php?mod=content.search', 4, 1, 0, 0, 0, 0, 0, 0, 0, 1),
(59, 0, 6, 'contact-us', 'index.php?mod=contact.main', 4, 2, 0, 0, 0, 0, 0, 0, 0, 1),
(60, 0, 2, 'logout', 'index.php?mod=user.logout', 5, 3, 1, 0, 0, 0, 0, 0, 0, 1),
(61, 0, 4, 'berita', 'index.php?mod=content.list&id=6&title=Berita', 5, 1, 0, 0, 0, 0, 1, 6, 0, 1),
(62, 61, 4, 'hot-list', 'index.php?mod=content.list&id=9&title=Hot+List', 1, 1, 0, 0, 0, 0, 1, 9, 0, 1),
(63, 61, 4, 'information', 'index.php?mod=content.list&id=8&title=Information', 2, 1, 0, 0, 0, 0, 1, 8, 0, 1),
(64, 61, 4, 'relaxing', 'index.php?mod=content.list&id=7&title=Relaxing', 3, 1, 0, 0, 0, 0, 1, 7, 0, 1),
(65, 0, 11, 'search', 'index.php?mod=search.main', 5, 2, 0, 0, 0, 0, 0, 0, 0, 1),
(66, 0, 4, 'galleries', 'index.php?mod=content.list&id=2&title=Gallery', 6, 1, 0, 0, 0, 0, 1, 2, 0, 1),
(67, 0, 4, 'downloads', 'index.php?mod=content.list&id=3&title=Download', 7, 1, 0, 0, 0, 0, 1, 3, 0, 0),
(68, 0, 4, 'audios', 'index.php?mod=content.list&id=5&title=Sound+Audio', 8, 1, 0, 0, 0, 0, 1, 5, 0, 0),
(69, 0, 4, 'videos', 'index.php?mod=content.list&id=4&title=Videos', 9, 1, 0, 0, 0, 0, 1, 4, 0, 0),
(70, 0, 2, 'registrasi', 'index.php?mod=user.register', 10, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(71, 0, 8, 'links', 'index.php?mod=links.main', 11, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(75, 0, 14, '', 'index.php?mod=school.school', 6, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(76, 75, 14, '', 'index.php?mod=school.school', 1, 1, 1, 1, 1, 0, 0, 0, 0, 0),
(77, 75, 14, '', 'index.php?mod=school.student', 2, 1, 1, 1, 1, 0, 0, 0, 0, 1),
(78, 75, 14, '', 'index.php?mod=school.teacher', 3, 1, 1, 1, 1, 0, 0, 0, 0, 1),
(79, 75, 14, '', 'index.php?mod=school.class', 4, 1, 1, 1, 1, 0, 0, 0, 0, 1),
(80, 75, 14, '', 'index.php?mod=school.schedule', 5, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(81, 75, 14, '', 'index.php?mod=school.subject', 8, 1, 1, 1, 1, 0, 0, 0, 0, 1),
(82, 75, 14, '', 'index.php?mod=school.parent', 9, 1, 1, 1, 1, 0, 0, 0, 0, 1),
(83, 75, 14, '', 'index.php?mod=school.attendance', 10, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(84, 75, 14, '', 'index.php?mod=school.student_class', 11, 1, 1, 1, 1, 0, 0, 0, 0, 1),
(85, 75, 14, '', 'index.php?mod=school.notification', 12, 1, 1, 1, 1, 0, 0, 0, 0, 1),
(86, 75, 14, '', 'index.php?mod=school.course', 7, 1, 1, 1, 1, 0, 0, 0, 0, 1),
(87, 75, 14, '', 'index.php?mod=school.clock', 6, 1, 1, 1, 0, 0, 0, 0, 0, 1),
(89, 75, 14, '', 'index.php?mod=school.profile', 13, 1, 1, 1, 1, 0, 0, 0, 0, 1),
(90, 75, 14, '', 'index.php?mod=school.score', 14, 1, 1, 1, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_menu_cat`
--

CREATE TABLE `bbc_menu_cat` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `orderby` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_menu_cat`
--

INSERT INTO `bbc_menu_cat` (`id`, `name`, `orderby`) VALUES
(1, 'top', 1),
(2, 'bottom', 2),
(3, 'usermenu', 3);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_menu_text`
--

CREATE TABLE `bbc_menu_text` (
  `menu_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `lang_id` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_menu_text`
--

INSERT INTO `bbc_menu_text` (`menu_id`, `title`, `lang_id`) VALUES
(1, 'Content', 1),
(2, 'Content List', 1),
(3, 'Add Content', 1),
(4, 'Category', 1),
(5, 'Comments', 1),
(6, 'Content Type', 1),
(7, 'Content Tags', 1),
(8, 'Configuration', 1),
(9, 'Agenda', 1),
(10, 'Contact Us', 1),
(11, 'List Contact Us', 1),
(12, 'YM Account', 1),
(13, 'Configuration', 1),
(14, 'Guest Book', 1),
(15, 'List Guest Book', 1),
(16, 'Configuration', 1),
(17, 'Image Slider', 1),
(18, 'List Images', 1),
(19, 'Category', 1),
(20, 'Links', 1),
(21, 'Ad List', 1),
(22, 'Share Links', 1),
(23, 'Advertise', 1),
(24, 'Survey', 1),
(25, 'Posted', 1),
(26, 'Question', 1),
(27, 'Polling', 1),
(28, 'Configuration', 1),
(29, 'Testimonial', 1),
(30, 'List Testimonial', 1),
(31, 'Add Testimonial', 1),
(32, 'Configuration', 1),
(33, 'Search', 1),
(34, 'Change Password', 1),
(35, 'Control Panel', 1),
(36, 'Home', 1),
(37, 'Testimonial', 1),
(38, 'My Profile', 1),
(39, 'My Content', 1),
(40, 'Agenda', 1),
(41, 'Kalender', 1),
(42, 'Rutinitas', 1),
(43, 'Event', 1),
(44, 'Harian', 1),
(45, 'Mingguan', 1),
(46, 'Bulanan', 1),
(47, 'Tahunan', 1),
(48, 'About Us', 1),
(49, 'Content', 1),
(50, 'Artikel', 1),
(51, 'Gallery', 1),
(52, 'Download', 1),
(53, 'Video', 1),
(54, 'Audio', 1),
(55, 'Create Content', 1),
(56, 'Survey', 1),
(57, 'Change Password', 1),
(58, 'Pencarian', 1),
(59, 'Contact Us', 1),
(60, 'Logout', 1),
(61, 'Berita', 1),
(62, 'Hot List', 1),
(63, 'Information', 1),
(64, 'Relaxing', 1),
(65, 'Search', 1),
(66, 'Gallery', 1),
(67, 'Download', 1),
(68, 'Audio', 1),
(69, 'Video', 1),
(70, 'Registrasi', 1),
(71, 'Links', 1),
(77, 'Student', 1),
(76, 'School Info', 1),
(75, 'School', 1),
(78, 'Teacher', 1),
(79, 'Class', 1),
(80, 'Schedule ', 1),
(81, 'Subject', 1),
(82, 'Parent', 1),
(83, 'Attendance', 1),
(84, 'Student class', 1),
(85, 'Announcement', 1),
(86, 'Course', 1),
(87, 'Clock', 1),
(89, 'School Profile', 1),
(90, 'Score Category', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_module`
--

CREATE TABLE `bbc_module` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `site_title` varchar(255) DEFAULT NULL,
  `site_desc` varchar(255) DEFAULT NULL,
  `site_keyword` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `protected` tinyint(1) NOT NULL DEFAULT '0',
  `allow_group` varchar(255) DEFAULT NULL,
  `order_func_pre` varchar(255) DEFAULT NULL,
  `order_func_post` varchar(255) DEFAULT NULL,
  `account_func_pre` varchar(255) DEFAULT NULL,
  `account_func_post` varchar(255) DEFAULT NULL,
  `search_func` varchar(255) NOT NULL COMMENT 'func_name#main_table#field_title#field_description',
  `is_config` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_module`
--

INSERT INTO `bbc_module` (`id`, `name`, `site_title`, `site_desc`, `site_keyword`, `created`, `protected`, `allow_group`, `order_func_pre`, `order_func_post`, `account_func_pre`, `account_func_post`, `search_func`, `is_config`, `active`) VALUES
(1, '_cpanel', '', '', '', '0000-00-00 00:00:00', 0, ',all,', '', '', '', '', '', 1, 1),
(2, 'user', '', '', '', '0000-00-00 00:00:00', 0, ',all,', '', '', '', '', '', 0, 1),
(3, 'search', '', '', '', '0000-00-00 00:00:00', 0, ',all,', '', '', '', '', '', 0, 1),
(4, 'content', '', '', '', '0000-00-00 00:00:00', 0, ',all,', '', '', '', '', 'content_search_link_list#bbc_content', 1, 1),
(5, 'agenda', '', '', '', '2008-10-14 22:38:12', 0, ',all,', '', '', '', '', '', 0, 1),
(6, 'contact', '', '', '', '2008-10-14 22:38:12', 0, ',all,', '', '', '', '', '', 0, 1),
(7, 'guestbook', '', '', '', '2008-10-14 22:40:58', 0, ',all,', '', '', '', '', '', 0, 1),
(8, 'links', '', '', '', '2008-10-14 22:40:58', 0, ',all,', '', '', '', '', '', 0, 1),
(9, 'survey', '', '', '', '2009-01-09 04:05:01', 0, ',all,', '', '', '', '', '', 0, 1),
(10, 'testimonial', '', '', '', '2009-01-11 20:18:32', 0, ',all,', '', '', '', '', '', 0, 1),
(11, 'imageslider', '', '', '', '2010-07-25 04:52:28', 0, ',all,', '', '', '', '', '', 0, 1),
(12, 'tools', '', '', '', '2011-11-16 02:50:48', 0, ',all,', '', '', '', '', '', 0, 1),
(14, 'school', NULL, NULL, NULL, '2023-12-13 13:22:19', 0, ',all,', NULL, NULL, NULL, NULL, '', 0, 1),
(15, 'api', NULL, NULL, NULL, '2024-01-02 13:50:49', 0, ',all,', NULL, NULL, NULL, NULL, '', 1, 1),
(20, 'error', NULL, NULL, NULL, '2024-11-17 21:43:49', 0, ',all,', NULL, NULL, NULL, NULL, '', 0, 1),
(21, 'login', NULL, NULL, NULL, '2024-11-20 10:44:41', 0, ',all,', NULL, NULL, NULL, NULL, '', 0, 1),
(23, 'teacher', NULL, NULL, NULL, '2024-11-20 10:44:41', 0, ',all,', NULL, NULL, NULL, NULL, '', 0, 1),
(24, 'student', NULL, NULL, NULL, '2024-11-25 10:46:26', 0, ',all,', NULL, NULL, NULL, NULL, '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_template`
--

CREATE TABLE `bbc_template` (
  `id` int(255) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `installed` datetime DEFAULT NULL,
  `syncron_to` int(255) NOT NULL DEFAULT '0',
  `last_copty_to` int(255) NOT NULL DEFAULT '0',
  `last_copy_from` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_template`
--

INSERT INTO `bbc_template` (`id`, `name`, `installed`, `syncron_to`, `last_copty_to`, `last_copy_from`) VALUES
(1, 'campus_blue', '2010-07-26 00:46:08', 0, 0, 0),
(2, 'logistic_transport', '2011-02-06 04:53:52', 0, 0, 0),
(3, 'cloudy_season', '2011-02-07 06:52:19', 0, 0, 0),
(4, 'green_accountant', '2011-02-09 16:52:43', 0, 0, 0),
(5, 'dark_style', '2011-02-09 16:54:58', 0, 0, 0),
(6, 'cobweb_blue', '2011-02-09 18:52:59', 0, 0, 0),
(7, 'school', '2024-03-06 14:19:59', 0, 0, 0),
(8, 'eraport-sdit', '2024-11-08 13:19:40', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_user`
--

CREATE TABLE `bbc_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_ids` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `last_ip` varchar(25) NOT NULL,
  `last_ip_temp` varchar(25) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_login_temp` datetime DEFAULT NULL,
  `exp_checked` datetime DEFAULT '0000-00-00 00:00:00',
  `login_time` int(255) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_user`
--

INSERT INTO `bbc_user` (`id`, `group_ids`, `username`, `password`, `last_ip`, `last_ip_temp`, `last_login`, `last_login_temp`, `exp_checked`, `login_time`, `created`, `active`) VALUES
(1, ',3,4,1,2,', 'admin', 'ZOnTyQRPjxsWoLjuHTZLBLQgvSFITywyNEF7Mn8EpuP+C23af9dZcH1O6jzssR2yjwUNQHDEP+9qr3WNqoPIUw==', '::1', '::1', '2025-01-20 10:29:47', '2025-01-16 11:03:51', '2025-01-20 15:00:50', 212, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_user_field`
--

CREATE TABLE `bbc_user_field` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `tips` varchar(255) NOT NULL,
  `checked` enum('any','email','url','phone','number') NOT NULL DEFAULT 'any',
  `attr` varchar(255) NOT NULL,
  `default` text NOT NULL,
  `option` text NOT NULL,
  `orderby` int(255) NOT NULL DEFAULT '1',
  `mandatory` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_user_field`
--

INSERT INTO `bbc_user_field` (`id`, `group_id`, `type`, `title`, `tips`, `checked`, `attr`, `default`, `option`, `orderby`, `mandatory`, `active`) VALUES
(5, 0, 'textarea', 'Alamat Lengkap', '', 'any', '', '', '', 2, 1, 1),
(6, 0, 'text', 'Phone', '', 'phone', '', '', '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_user_group`
--

CREATE TABLE `bbc_user_group` (
  `id` int(255) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `menus` text,
  `cpanels` text,
  `score` int(11) NOT NULL DEFAULT '0',
  `is_customfield` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bbc_user_group`
--

INSERT INTO `bbc_user_group` (`id`, `name`, `desc`, `menus`, `cpanels`, `score`, `is_customfield`, `is_admin`) VALUES
(1, 'root', 'this is the highest degree of user level in system', ',all,', ',all,', 0, 0, 1),
(2, 'administrator', 'administrator', '', ',2,15,16,', 0, 0, 1),
(3, 'Customer', 'Customer', ',all,', '', 0, 1, 0),
(4, 'Registered', 'lowest level of member site', '', '', 0, 0, 0),
(5, 'Teacher', 'teacher role', ',all,', '', 0, 0, 0),
(6, 'Parent', 'parent role', ',all,', '', 0, 0, 0),
(7, 'Student', 'student role', ',all,', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bbc_user_push`
--

CREATE TABLE `bbc_user_push` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT '0',
  `group_ids` varchar(120) DEFAULT '0' COMMENT 'comma separated like repairImplode()',
  `username` varchar(120) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '0' COMMENT '0=expo, 1=fcm',
  `device` varchar(255) DEFAULT NULL,
  `os` varchar(60) DEFAULT NULL,
  `ipaddress` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'setiap mengirim pesan ke table bbc_user_push_notif maka field ini akan di update'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table untuk menyimpan token dari para pengguna mobile app';

--
-- Dumping data for table `bbc_user_push`
--

INSERT INTO `bbc_user_push` (`id`, `user_id`, `group_ids`, `username`, `token`, `type`, `device`, `os`, `ipaddress`, `created`, `updated`) VALUES
(188, 0, ',5,', '55555', 'ExponentPushToken[ElfIF4I5WSa0anpEzVWLm-]', 0, '2201117PG', 'android', '35.191.14.144', '2024-03-03 08:37:09', '2024-03-04 10:21:43'),
(274, 0, ',6,', '3497213214', 'ExponentPushToken[eU--_nPBDjHw5y1mj_eOsX]', 0, 'SM-A325F', 'android', '35.191.25.241', '2024-03-06 10:57:54', '2024-03-06 12:52:05'),
(289, 0, ',5,', '55555', 'ExponentPushToken[ds7OvrImB0E1MflHBY60JX]', 0, 'SM-A226B', 'android', '35.191.40.133', '2024-03-11 18:20:32', '2024-03-11 18:20:41'),
(310, 0, ',5,', '55555', 'ExponentPushToken[Z7fjgACITC0-5bLJAhUee4]', 0, 'CPH1931', 'android', '35.191.40.129', '2024-03-13 09:33:48', '2024-03-13 09:56:08'),
(315, 0, ',5,', '55555', 'ExponentPushToken[A9nHtkAAeW_ti5Z6kugWIj]', 0, 'SM-A146P', 'android', '35.191.40.128', '2024-03-13 14:52:06', '2024-03-13 16:41:12'),
(316, 23, ',6,', '3497213214', 'ExponentPushToken[F0Xn6PBljcDRkG55BUpYLU]', 0, 'SM-A325F', 'android', '35.191.40.130', '2024-03-13 16:15:20', '2024-03-13 16:15:20'),
(317, 0, ',5,', '55555', 'ExponentPushToken[FbBXRIOl3LvFONCNWnZcgx]', 0, 'Infinix X663', 'android', '35.191.13.91', '2024-03-13 16:41:10', '2024-03-13 16:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `bbc_user_push_notif`
--

CREATE TABLE `bbc_user_push_notif` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT '0',
  `group_id` int(11) DEFAULT '0',
  `title` varchar(150) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `params` text COMMENT 'variable yang akan di proses dalam mobile app field wajib action, module, argument',
  `return` text COMMENT 'data return dari API notifikasi',
  `status` tinyint(1) DEFAULT '0' COMMENT '0=belum terkirim, 1=berhasil terkirim, 2=sudah terbaca, 3=gagal terkirim',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table untuk menyimpan data notifikasi yang dikirim ke para pengguna mobile app';

--
-- Dumping data for table `bbc_user_push_notif`
--

INSERT INTO `bbc_user_push_notif` (`id`, `user_id`, `group_id`, `title`, `message`, `params`, `return`, `status`, `created`, `updated`) VALUES
(4859, 26, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:34:34', '2024-03-01 14:30:58'),
(4860, 27, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:34:34', '2024-03-01 14:30:58'),
(4861, 3, 5, 'absensi', 'murid anda Alya Maharani tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"c1879147-e72c-4a53-ba56-38fae54c1075\"}]}', 1, '2024-03-01 13:34:34', '2024-03-01 13:34:36'),
(4862, 29, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:34:34', '2024-03-01 14:31:35'),
(4863, 30, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:34:34', '2024-03-01 14:31:35'),
(4864, 3, 5, 'absensi', 'murid anda Farhan Pratama sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"b9d3952d-cf6e-4e07-b508-9d2a8b10dcf0\"}]}', 1, '2024-03-01 13:34:34', '2024-03-01 13:34:36'),
(4865, 32, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:34:34', '2024-03-01 14:31:35'),
(4866, 33, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:34:34', '2024-03-01 14:31:35'),
(4867, 3, 5, 'absensi', 'murid anda Alya Cahaya sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"50b74140-14ab-40d5-a22f-4949022fa06b\"}]}', 1, '2024-03-01 13:34:34', '2024-03-01 13:34:38'),
(4868, 26, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:35:10', '2024-03-01 14:30:58'),
(4869, 27, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:35:10', '2024-03-01 14:30:58'),
(4870, 29, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:35:10', '2024-03-01 14:31:35'),
(4871, 30, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:35:10', '2024-03-01 14:31:35'),
(4872, 32, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:35:10', '2024-03-01 14:31:35'),
(4873, 33, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:35:10', '2024-03-01 14:31:35'),
(4874, 41, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:37:07', '2024-03-01 14:46:53'),
(4875, 42, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:37:07', '2024-03-01 14:46:53'),
(4876, 3, 5, 'absensi', 'murid anda Alya Maharani ijin', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"36fc2678-e952-46b6-ba57-05f1cbf9d17a\"}]}', 1, '2024-03-01 13:37:07', '2024-03-01 13:37:09'),
(4877, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-12:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"0aae2444-e986-46c7-af2e-fcaf9b1d5616\"}]}', 1, '2024-03-01 13:43:50', '2024-03-01 13:43:51'),
(4878, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-12:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"4f13de76-a96d-4339-8072-8cebc99d18b1\"}]}', 1, '2024-03-01 13:43:56', '2024-03-01 13:43:57'),
(4879, 23, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:44:13', '2024-03-01 14:45:39'),
(4880, 24, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:44:13', '2024-03-01 14:45:39'),
(4881, 3, 5, 'absensi', 'murid anda Sofia Pratama tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"509af138-11e9-4957-9713-bb9ddf03b3b7\"}]}', 1, '2024-03-01 13:44:13', '2024-03-01 13:44:15'),
(4882, 26, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:44:13', '2024-03-01 14:30:58'),
(4883, 27, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:44:13', '2024-03-01 14:30:58'),
(4884, 32, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:44:14', '2024-03-01 14:31:35'),
(4885, 33, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:44:14', '2024-03-01 14:31:35'),
(4886, 23, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:53:38', '2024-03-01 14:45:39'),
(4887, 24, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:53:38', '2024-03-01 14:45:39'),
(4888, 26, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:53:39', '2024-03-01 14:30:58'),
(4889, 27, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:53:39', '2024-03-01 14:30:58'),
(4890, 3, 5, 'absensi', 'murid anda Farhan Pratama tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"d2fbe703-1e62-4042-8351-5dc493f61158\"}]}', 1, '2024-03-01 13:53:56', '2024-03-01 13:53:57'),
(4891, 3, 5, 'absensi', 'murid anda Alya Cahaya tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"1b979af2-ea94-481b-acd4-54a3f1702245\"}]}', 1, '2024-03-01 13:53:56', '2024-03-01 13:53:58'),
(4892, 35, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:53:56', '2024-03-01 14:31:35'),
(4893, 36, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 13:53:56', '2024-03-01 14:31:35'),
(4894, 3, 5, 'absensi', 'murid anda Farhan Cahaya tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"462830f5-12d0-4155-b317-6deefd467ede\"}]}', 1, '2024-03-01 13:53:56', '2024-03-01 13:53:59'),
(4895, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"38de032a-bdb6-4ed0-a204-3085b9a94ca4\"}]}', 1, '2024-03-01 14:22:36', '2024-03-01 14:22:37'),
(4896, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"c301c1bd-1ae4-462a-8694-96601644ecf2\"}]}', 1, '2024-03-01 14:23:30', '2024-03-01 14:23:31'),
(4897, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"980655b8-d7a7-44f7-b96c-4ba2bcd088ed\"}]}', 1, '2024-03-01 14:23:52', '2024-03-01 14:23:53'),
(4898, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"d430ebcb-78c2-459d-a5f6-a3e34d5eb92a\"}]}', 1, '2024-03-01 14:24:34', '2024-03-01 14:24:34'),
(4899, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"2c47f4c8-4b34-4f44-978e-8bce180496f7\"}]}', 1, '2024-03-01 14:25:54', '2024-03-01 14:25:54'),
(4900, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"f53be361-5b9d-4020-823e-b4adebd63805\"}]}', 1, '2024-03-01 14:26:40', '2024-03-01 14:26:41'),
(4901, 104, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:27:22', '2024-03-01 14:46:54'),
(4902, 105, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:27:22', '2024-03-01 14:46:54'),
(4903, 107, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:27:22', '2024-03-01 14:46:54'),
(4904, 108, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:27:22', '2024-03-01 14:46:54'),
(4905, 3, 5, 'absensi', 'murid anda Sofia Putra tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"4d210153-fc1d-4bae-b3a1-0f5bb4f258b4\"}]}', 1, '2024-03-01 14:27:22', '2024-03-01 14:27:24'),
(4906, 110, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:27:22', '2024-03-01 14:44:32'),
(4907, 111, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:27:22', '2024-03-01 14:44:32'),
(4908, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"b797f047-600c-4cb2-9d34-02e46e973c9c\"}]}', 1, '2024-03-01 14:28:01', '2024-03-01 14:28:01'),
(4909, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"606f7564-a64a-40c8-8172-c372107514e4\"}]}', 1, '2024-03-01 14:28:16', '2024-03-01 14:28:17'),
(4910, 83, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:28:33', '2024-03-01 14:46:54'),
(4911, 84, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:28:33', '2024-03-01 14:46:54'),
(4912, 3, 5, 'absensi', 'murid anda Sofia Maharani tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"e14393e2-12e0-4ade-97d6-510ccc93d10b\"}]}', 1, '2024-03-01 14:28:33', '2024-03-01 14:28:35'),
(4913, 86, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:28:33', '2024-03-01 14:46:54'),
(4914, 87, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:28:33', '2024-03-01 14:46:54'),
(4915, 3, 5, 'absensi', 'murid anda Rafa Pratama tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"f396e64d-40ac-4884-bd47-8e9cc15450ed\"}]}', 1, '2024-03-01 14:28:33', '2024-03-01 14:28:35'),
(4916, 71, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:29:51', '2024-03-01 14:46:54'),
(4917, 72, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:29:51', '2024-03-01 14:46:54'),
(4918, 95, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:30:21', '2024-03-01 14:46:54'),
(4919, 96, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:30:21', '2024-03-01 14:46:54'),
(4920, 3, 5, 'absensi', 'murid anda Rafa Wardhana tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"ba230195-761f-473b-8bb4-3ff6a9cf4139\"}]}', 1, '2024-03-01 14:30:21', '2024-03-01 14:30:22'),
(4921, 98, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:30:21', '2024-03-01 14:46:54'),
(4922, 99, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:30:21', '2024-03-01 14:46:54'),
(4923, 3, 5, 'absensi', 'murid anda Rafa Putra tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"5dd1122d-3f22-42ec-a248-5a3d487d3869\"}]}', 1, '2024-03-01 14:30:21', '2024-03-01 14:30:24'),
(4924, 56, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:31:18', '2024-03-01 14:46:54'),
(4925, 57, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:31:18', '2024-03-01 14:46:54'),
(4926, 59, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:31:18', '2024-03-01 14:46:54'),
(4927, 60, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:31:18', '2024-03-01 14:46:54'),
(4928, 47, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:31:49', '2024-03-01 14:31:49'),
(4929, 48, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:31:49', '2024-03-01 14:31:49'),
(4930, 3, 5, 'absensi', 'murid anda Alya Wardhana tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"12c63a6b-f1df-4807-8b04-46c834bb9d29\"}]}', 1, '2024-03-01 14:31:49', '2024-03-01 14:31:51'),
(4931, 74, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:38:00', '2024-03-01 14:46:54'),
(4932, 75, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:38:00', '2024-03-01 14:46:54'),
(4933, 3, 5, 'absensi', 'murid anda Alya Pratama tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"7e696702-327d-4b51-bf6e-be5cfdb76c6a\"}]}', 1, '2024-03-01 14:38:00', '2024-03-01 14:38:01'),
(4934, 68, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:44:24', '2024-03-01 14:46:54'),
(4935, 69, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:44:24', '2024-03-01 14:46:54'),
(4936, 62, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:44:43', '2024-03-01 14:46:54'),
(4937, 63, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:44:43', '2024-03-01 14:46:54'),
(4938, 65, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:44:43', '2024-03-01 14:46:54'),
(4939, 66, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:44:43', '2024-03-01 14:46:54'),
(4940, 3, 5, 'absensi', 'murid anda Farhan Wardhana tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"45d83284-7d10-457e-83d7-5e1025fc0e1a\"}]}', 1, '2024-03-01 14:44:43', '2024-03-01 14:44:45'),
(4941, 77, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:45:32', '2024-03-01 14:46:54'),
(4942, 78, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:45:32', '2024-03-01 14:46:54'),
(4943, 80, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:45:32', '2024-03-01 14:46:54'),
(4944, 81, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:45:32', '2024-03-01 14:46:54'),
(4945, 3, 5, 'absensi', 'murid anda Rafa Cahaya tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"8abdf30a-b8b8-42d2-8eb4-b8a4ba18a380\"}]}', 1, '2024-03-01 14:45:32', '2024-03-01 14:45:33'),
(4946, 44, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:45:51', '2024-03-01 14:46:53'),
(4947, 45, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:45:51', '2024-03-01 14:46:53'),
(4948, 3, 5, 'absensi', 'murid anda Rafa Maharani tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"83d27aa8-c002-4093-9618-51cb4136892e\"}]}', 1, '2024-03-01 14:45:51', '2024-03-01 14:45:52'),
(4949, 50, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:46:53', '2024-03-01 14:46:53'),
(4950, 51, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:46:53', '2024-03-01 14:46:53'),
(4951, 3, 5, 'absensi', 'murid anda Rizky Wardhana tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"e28c9fc5-6bd5-4319-8381-150ac89cb693\"}]}', 1, '2024-03-01 14:46:53', '2024-03-01 14:46:55'),
(4952, 53, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:46:54', '2024-03-01 14:46:54'),
(4953, 54, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:46:54', '2024-03-01 14:46:54'),
(4954, 3, 5, 'absensi', 'murid anda Sofia Wardhana tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"cdbc8d67-75bd-4aba-a429-088a6bb83db9\"}]}', 1, '2024-03-01 14:46:54', '2024-03-01 14:46:56'),
(4955, 89, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:46:54', '2024-03-01 14:46:54'),
(4956, 90, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:46:54', '2024-03-01 14:46:54'),
(4957, 92, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:46:54', '2024-03-01 14:46:54'),
(4958, 93, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:46:54', '2024-03-01 14:46:54'),
(4959, 3, 5, 'absensi', 'murid anda Rizky Maharani tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"a5dc341a-9607-4b2b-9105-cc37749d9725\"}]}', 1, '2024-03-01 14:46:54', '2024-03-01 14:46:57'),
(4960, 101, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:46:54', '2024-03-01 14:46:54'),
(4961, 102, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 14:46:54', '2024-03-01 14:46:54'),
(4962, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"f6e4d9bc-a176-446b-969c-dcc6056e9933\"}]}', 1, '2024-03-01 14:46:54', '2024-03-01 14:46:58'),
(4963, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"cb44194e-a904-4f3f-9449-f72f25ade7ae\"}]}', 1, '2024-03-01 14:50:36', '2024-03-01 14:50:37'),
(4964, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"3d89fdef-2d79-47cc-b161-cf514e5b5034\"}]}', 1, '2024-03-01 15:16:03', '2024-03-01 15:16:04'),
(4965, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"c4d78ed4-e0e8-47c7-9079-201c66860bdd\"}]}', 1, '2024-03-01 15:28:50', '2024-03-01 15:28:51'),
(4966, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"cc695feb-b379-45e9-bb8f-a1ab97b85a9b\"}]}', 1, '2024-03-01 15:28:58', '2024-03-01 15:28:59'),
(4967, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"e931ba86-d003-4bbc-b50a-5c26c7e98c31\"}]}', 1, '2024-03-01 15:33:31', '2024-03-01 15:33:34'),
(4968, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"3d14684d-9936-44ee-9799-135373f8ba41\"}]}', 1, '2024-03-01 15:36:01', '2024-03-01 15:36:02'),
(4969, 3, 5, 'iki test sek yo', 'Ramadan adalah bulan kesembilan dalam kalender Hijriah. Pada bulan ini, umat Muslim di seluruh dunia melakukan ibadah puasa dan memperingati wahyu pertama yang turun kepada Nabi Muhammad menurut keyakinan umat Muslim. Puasa Ramadan merupakan salah satu da', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"2739ad81-a9b9-4cbd-bfd8-8b48f0af4978\"}]}', 1, '2024-03-01 15:37:04', '2024-03-01 15:37:05'),
(4971, 5, 5, 'iki test sek yo', 'Ramadan adalah bulan kesembilan dalam kalender Hijriah. Pada bulan ini, umat Muslim di seluruh dunia melakukan ibadah puasa dan memperingati wahyu pertama yang turun kepada Nabi Muhammad menurut keyakinan umat Muslim. Puasa Ramadan merupakan salah satu da', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:37:04', '2024-03-01 15:37:04'),
(4972, 6, 5, 'iki test sek yo', 'Ramadan adalah bulan kesembilan dalam kalender Hijriah. Pada bulan ini, umat Muslim di seluruh dunia melakukan ibadah puasa dan memperingati wahyu pertama yang turun kepada Nabi Muhammad menurut keyakinan umat Muslim. Puasa Ramadan merupakan salah satu da', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:37:04', '2024-03-01 15:37:04'),
(4975, 9, 5, 'iki test sek yo', 'Ramadan adalah bulan kesembilan dalam kalender Hijriah. Pada bulan ini, umat Muslim di seluruh dunia melakukan ibadah puasa dan memperingati wahyu pertama yang turun kepada Nabi Muhammad menurut keyakinan umat Muslim. Puasa Ramadan merupakan salah satu da', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:37:04', '2024-03-01 15:37:04'),
(4976, 10, 5, 'iki test sek yo', 'Ramadan adalah bulan kesembilan dalam kalender Hijriah. Pada bulan ini, umat Muslim di seluruh dunia melakukan ibadah puasa dan memperingati wahyu pertama yang turun kepada Nabi Muhammad menurut keyakinan umat Muslim. Puasa Ramadan merupakan salah satu da', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:37:04', '2024-03-01 15:37:04'),
(4977, 11, 5, 'iki test sek yo', 'Ramadan adalah bulan kesembilan dalam kalender Hijriah. Pada bulan ini, umat Muslim di seluruh dunia melakukan ibadah puasa dan memperingati wahyu pertama yang turun kepada Nabi Muhammad menurut keyakinan umat Muslim. Puasa Ramadan merupakan salah satu da', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:37:04', '2024-03-01 15:37:04'),
(4978, 12, 5, 'iki test sek yo', 'Ramadan adalah bulan kesembilan dalam kalender Hijriah. Pada bulan ini, umat Muslim di seluruh dunia melakukan ibadah puasa dan memperingati wahyu pertama yang turun kepada Nabi Muhammad menurut keyakinan umat Muslim. Puasa Ramadan merupakan salah satu da', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:37:04', '2024-03-01 15:37:04'),
(4981, 15, 5, 'iki test sek yo', 'Ramadan adalah bulan kesembilan dalam kalender Hijriah. Pada bulan ini, umat Muslim di seluruh dunia melakukan ibadah puasa dan memperingati wahyu pertama yang turun kepada Nabi Muhammad menurut keyakinan umat Muslim. Puasa Ramadan merupakan salah satu da', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:37:04', '2024-03-01 15:37:04'),
(4982, 16, 5, 'iki test sek yo', 'Ramadan adalah bulan kesembilan dalam kalender Hijriah. Pada bulan ini, umat Muslim di seluruh dunia melakukan ibadah puasa dan memperingati wahyu pertama yang turun kepada Nabi Muhammad menurut keyakinan umat Muslim. Puasa Ramadan merupakan salah satu da', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:37:04', '2024-03-01 15:37:04'),
(4983, 17, 5, 'iki test sek yo', 'Ramadan adalah bulan kesembilan dalam kalender Hijriah. Pada bulan ini, umat Muslim di seluruh dunia melakukan ibadah puasa dan memperingati wahyu pertama yang turun kepada Nabi Muhammad menurut keyakinan umat Muslim. Puasa Ramadan merupakan salah satu da', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:37:04', '2024-03-01 15:37:04'),
(4984, 18, 5, 'iki test sek yo', 'Ramadan adalah bulan kesembilan dalam kalender Hijriah. Pada bulan ini, umat Muslim di seluruh dunia melakukan ibadah puasa dan memperingati wahyu pertama yang turun kepada Nabi Muhammad menurut keyakinan umat Muslim. Puasa Ramadan merupakan salah satu da', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:37:04', '2024-03-01 15:37:04'),
(4985, 19, 5, 'iki test sek yo', 'Ramadan adalah bulan kesembilan dalam kalender Hijriah. Pada bulan ini, umat Muslim di seluruh dunia melakukan ibadah puasa dan memperingati wahyu pertama yang turun kepada Nabi Muhammad menurut keyakinan umat Muslim. Puasa Ramadan merupakan salah satu da', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:37:04', '2024-03-01 15:37:04'),
(4986, 20, 5, 'iki test sek yo', 'Ramadan adalah bulan kesembilan dalam kalender Hijriah. Pada bulan ini, umat Muslim di seluruh dunia melakukan ibadah puasa dan memperingati wahyu pertama yang turun kepada Nabi Muhammad menurut keyakinan umat Muslim. Puasa Ramadan merupakan salah satu da', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:37:04', '2024-03-01 15:37:04'),
(4987, 21, 5, 'iki test sek yo', 'Ramadan adalah bulan kesembilan dalam kalender Hijriah. Pada bulan ini, umat Muslim di seluruh dunia melakukan ibadah puasa dan memperingati wahyu pertama yang turun kepada Nabi Muhammad menurut keyakinan umat Muslim. Puasa Ramadan merupakan salah satu da', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:37:04', '2024-03-01 15:37:04'),
(4988, 22, 5, 'iki test sek yo', 'Ramadan adalah bulan kesembilan dalam kalender Hijriah. Pada bulan ini, umat Muslim di seluruh dunia melakukan ibadah puasa dan memperingati wahyu pertama yang turun kepada Nabi Muhammad menurut keyakinan umat Muslim. Puasa Ramadan merupakan salah satu da', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:37:04', '2024-03-01 15:37:04'),
(4989, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"6ee42d5f-3e1b-4779-bf31-1905f35110c7\"}]}', 1, '2024-03-01 15:57:33', '2024-03-01 15:57:34'),
(4990, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"f5db1db1-d4dc-448c-ab77-629456ba8922\"}]}', 1, '2024-03-01 15:57:46', '2024-03-01 15:57:47'),
(4991, 3, 5, 'helo', 'wleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"b5f4bd8a-5408-4c5f-b68d-7e74e153a22a\"}]}', 1, '2024-03-01 15:58:23', '2024-03-01 15:58:25'),
(4993, 5, 5, 'helo', 'wleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:58:23', '2024-03-01 15:58:23'),
(4994, 6, 5, 'helo', 'wleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:58:23', '2024-03-01 15:58:23'),
(4997, 9, 5, 'helo', 'wleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:58:23', '2024-03-01 15:58:23'),
(4998, 10, 5, 'helo', 'wleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:58:23', '2024-03-01 15:58:23'),
(4999, 11, 5, 'helo', 'wleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:58:23', '2024-03-01 15:58:23'),
(5000, 12, 5, 'helo', 'wleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:58:23', '2024-03-01 15:58:23'),
(5003, 15, 5, 'helo', 'wleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:58:23', '2024-03-01 15:58:23'),
(5004, 16, 5, 'helo', 'wleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:58:23', '2024-03-01 15:58:23'),
(5005, 17, 5, 'helo', 'wleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:58:23', '2024-03-01 15:58:23'),
(5006, 18, 5, 'helo', 'wleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:58:23', '2024-03-01 15:58:23'),
(5007, 19, 5, 'helo', 'wleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:58:23', '2024-03-01 15:58:23'),
(5008, 20, 5, 'helo', 'wleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:58:23', '2024-03-01 15:58:23'),
(5009, 21, 5, 'helo', 'wleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:58:23', '2024-03-01 15:58:23'),
(5010, 22, 5, 'helo', 'wleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 15:58:23', '2024-03-01 15:58:23'),
(5011, 3, 5, 'hello', 'https://youtu.be/dQw4w9WgXcQ?si=WMRIqr471-x1K-uB', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"ce2035b2-dd67-4f76-87a9-e4bff85612d5\"}]}', 1, '2024-03-01 16:00:07', '2024-03-01 16:00:08'),
(5013, 5, 5, 'hello', 'https://youtu.be/dQw4w9WgXcQ?si=WMRIqr471-x1K-uB', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 16:00:07', '2024-03-01 16:00:07'),
(5014, 6, 5, 'hello', 'https://youtu.be/dQw4w9WgXcQ?si=WMRIqr471-x1K-uB', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 16:00:07', '2024-03-01 16:00:07'),
(5017, 9, 5, 'hello', 'https://youtu.be/dQw4w9WgXcQ?si=WMRIqr471-x1K-uB', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 16:00:07', '2024-03-01 16:00:07'),
(5018, 10, 5, 'hello', 'https://youtu.be/dQw4w9WgXcQ?si=WMRIqr471-x1K-uB', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 16:00:07', '2024-03-01 16:00:07'),
(5019, 11, 5, 'hello', 'https://youtu.be/dQw4w9WgXcQ?si=WMRIqr471-x1K-uB', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 16:00:07', '2024-03-01 16:00:07'),
(5020, 12, 5, 'hello', 'https://youtu.be/dQw4w9WgXcQ?si=WMRIqr471-x1K-uB', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 16:00:07', '2024-03-01 16:00:07'),
(5023, 15, 5, 'hello', 'https://youtu.be/dQw4w9WgXcQ?si=WMRIqr471-x1K-uB', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 16:00:07', '2024-03-01 16:00:07'),
(5024, 16, 5, 'hello', 'https://youtu.be/dQw4w9WgXcQ?si=WMRIqr471-x1K-uB', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 16:00:07', '2024-03-01 16:00:07'),
(5025, 17, 5, 'hello', 'https://youtu.be/dQw4w9WgXcQ?si=WMRIqr471-x1K-uB', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 16:00:07', '2024-03-01 16:00:07'),
(5026, 18, 5, 'hello', 'https://youtu.be/dQw4w9WgXcQ?si=WMRIqr471-x1K-uB', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 16:00:07', '2024-03-01 16:00:07'),
(5027, 19, 5, 'hello', 'https://youtu.be/dQw4w9WgXcQ?si=WMRIqr471-x1K-uB', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 16:00:07', '2024-03-01 16:00:07'),
(5028, 20, 5, 'hello', 'https://youtu.be/dQw4w9WgXcQ?si=WMRIqr471-x1K-uB', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 16:00:07', '2024-03-01 16:00:07'),
(5029, 21, 5, 'hello', 'https://youtu.be/dQw4w9WgXcQ?si=WMRIqr471-x1K-uB', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 16:00:07', '2024-03-01 16:00:07'),
(5030, 22, 5, 'hello', 'https://youtu.be/dQw4w9WgXcQ?si=WMRIqr471-x1K-uB', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-01 16:00:07', '2024-03-01 16:00:07'),
(5031, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"e8352621-e442-41da-be1f-e7564037c42f\"}]}', 1, '2024-03-01 16:00:10', '2024-03-01 16:00:12'),
(5032, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"2cab6d13-5d23-4ad3-9bb6-9877499e48b2\"}]}', 1, '2024-03-01 16:00:22', '2024-03-01 16:00:23'),
(5033, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"18cb81c0-0a1d-412e-a167-60d2eb73a808\"}]}', 1, '2024-03-01 16:00:30', '2024-03-01 16:00:30'),
(5034, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"b7918ff2-d52f-4d87-ba58-5621e5f7a179\"}]}', 1, '2024-03-01 16:01:06', '2024-03-01 16:01:07'),
(5035, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"a4d12c51-1321-4f26-80dc-549c106fb97a\"}]}', 1, '2024-03-01 16:01:40', '2024-03-01 16:01:40'),
(5036, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"bfe0a291-295b-420b-9f0c-987ec3e1b114\"}]}', 1, '2024-03-01 16:03:24', '2024-03-01 16:03:25'),
(5037, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"fe51cca7-059b-4640-9c5e-39264c07f5d7\"}]}', 1, '2024-03-01 16:03:24', '2024-03-01 16:03:26'),
(5038, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"cb96206e-60ff-488c-ac57-5ec8e604b7ee\"}]}', 1, '2024-03-01 16:05:43', '2024-03-01 16:05:44'),
(5039, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"1cc9d3ad-090f-42c1-a40b-7c523d35a532\"}]}', 1, '2024-03-01 16:05:45', '2024-03-01 16:05:46'),
(5040, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"90d31250-4b8f-4939-a479-a6d9546a3975\"}]}', 1, '2024-03-01 16:05:58', '2024-03-01 16:06:00'),
(5041, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"49c61173-0207-4d59-880c-bb6af4eb6483\"}]}', 1, '2024-03-01 16:07:30', '2024-03-01 16:07:31'),
(5042, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"b4470e33-5705-4450-9974-23111e3f1a65\"}]}', 1, '2024-03-01 16:08:25', '2024-03-01 16:08:25'),
(5043, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"9163d720-f624-48ab-aab5-1aac1054b6de\"}]}', 1, '2024-03-01 16:23:39', '2024-03-01 16:23:39'),
(5044, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"3c4ae46d-567d-4d7b-8833-d7a6117b8cea\"}]}', 1, '2024-03-01 16:33:59', '2024-03-01 16:34:00'),
(5045, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"b12ed946-e3cb-4102-88f3-2b024ced4d0d\"}]}', 1, '2024-03-01 16:37:10', '2024-03-01 16:37:12'),
(5046, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"bb053e18-d065-42d6-afbd-ac878189f692\"}]}', 1, '2024-03-01 16:38:05', '2024-03-01 16:38:06'),
(5047, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"cf35991e-7c40-4839-8514-0558bec6108d\"}]}', 1, '2024-03-01 16:40:57', '2024-03-01 16:40:57'),
(5048, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"3fb67329-7d16-414f-8877-5ab7024feb3e\"}]}', 1, '2024-03-01 16:43:19', '2024-03-01 16:43:20'),
(5049, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"6c94860d-fc15-4653-8c83-414f027aa620\"}]}', 1, '2024-03-01 16:43:56', '2024-03-01 16:43:57'),
(5050, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"3f4b7e37-ee14-4eda-8725-0932dd9fbfef\"}]}', 1, '2024-03-01 16:46:05', '2024-03-01 16:46:06'),
(5051, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"5ce91204-9710-4d72-aec7-04805385ea45\"}]}', 1, '2024-03-01 16:47:46', '2024-03-01 16:47:48'),
(5052, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"82a2fe68-88ea-4a78-9474-5917a6e24543\"}]}', 1, '2024-03-01 16:54:33', '2024-03-01 16:54:33'),
(5053, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"60ac753d-a7bd-402a-9613-1ba3ef79419a\"}]}', 1, '2024-03-01 16:55:43', '2024-03-01 16:55:45'),
(5054, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"9964d990-45e0-4347-a5e1-ebaaab72b38b\"}]}', 1, '2024-03-01 16:57:13', '2024-03-01 16:57:14'),
(5055, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"0a8b6add-f943-4d73-9f3a-54b9b0096ec6\"}]}', 1, '2024-03-01 16:58:05', '2024-03-01 16:58:06'),
(5056, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"58f8018b-3c5d-487b-a5e2-ccd17ffb9d01\"}]}', 1, '2024-03-01 17:28:00', '2024-03-01 17:28:01'),
(5057, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"a274e87d-1b7b-4742-9073-662e94cd2ea2\"}]}', 1, '2024-03-01 17:29:00', '2024-03-01 17:29:00'),
(5058, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"f9e4c9a0-60a7-4315-a75b-91421a4083a9\"}]}', 1, '2024-03-01 17:32:30', '2024-03-01 17:32:31'),
(5059, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"a90b866c-3aa7-432e-b498-3ad2e45d0ace\"}]}', 1, '2024-03-01 17:33:53', '2024-03-01 17:33:54'),
(5060, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"8b53573d-97a4-4485-83ae-611524326e01\"}]}', 1, '2024-03-01 17:40:43', '2024-03-01 17:40:44'),
(5061, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"d5ee45d1-5361-4d24-b983-4dc96df1e704\"}]}', 1, '2024-03-01 17:42:26', '2024-03-01 17:42:28'),
(5062, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"d29afec3-0804-431c-9237-2d1148d9c679\"}]}', 1, '2024-03-01 17:43:59', '2024-03-01 17:44:00'),
(5063, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"bb8244e7-171e-4c6d-8a5a-79324263be33\"}]}', 1, '2024-03-01 17:46:07', '2024-03-01 17:46:08'),
(5064, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"e9395a03-f81c-4908-82dd-8d6ab94b239a\"}]}', 1, '2024-03-01 17:47:07', '2024-03-01 17:47:08');
INSERT INTO `bbc_user_push_notif` (`id`, `user_id`, `group_id`, `title`, `message`, `params`, `return`, `status`, `created`, `updated`) VALUES
(5065, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"4f81eba8-fef0-4652-8d1a-8a4b55f09c59\"}]}', 1, '2024-03-01 17:49:20', '2024-03-01 17:49:21'),
(5066, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 14:00-17:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"bf0a6a3d-d172-44fd-ac4d-9644e1ab47e5\"}]}', 1, '2024-03-02 18:27:30', '2024-03-02 18:27:31'),
(5067, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 07:00-09:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"d702553b-02f6-4912-b500-beacb665ec39\"}]}', 1, '2024-03-03 10:38:05', '2024-03-03 10:38:06'),
(5068, 23, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-03 10:38:28', '2024-03-03 11:27:19'),
(5069, 24, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-03 10:38:28', '2024-03-03 11:27:19'),
(5070, 3, 5, 'absensi', 'murid anda Sofia Pratama tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"9b9a3a24-1700-489f-ac40-f804a8f62406\"}]}', 1, '2024-03-03 10:38:28', '2024-03-03 10:38:30'),
(5071, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 08:00-09:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"aae66d79-0485-4b3d-b29e-eff6bbaf653e\"}]}', 1, '2024-03-04 09:13:39', '2024-03-04 09:13:40'),
(5072, 3, 5, 'selamat siang teman teman!!', 'Kudus adalah sebuah kecamatan dan ibu kota yang menjadi pusat pemerintahan dan perekonomian dari Kabupaten Kudus di provinsi Jawa Tengah, Indonesia.', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"757aa111-695a-45dd-9b43-60e9a45f817c\"}]}', 1, '2024-03-04 12:39:01', '2024-03-04 12:39:01'),
(5074, 5, 5, 'selamat siang teman teman!!', 'Kudus adalah sebuah kecamatan dan ibu kota yang menjadi pusat pemerintahan dan perekonomian dari Kabupaten Kudus di provinsi Jawa Tengah, Indonesia.', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:39:01', '2024-03-04 12:39:01'),
(5075, 6, 5, 'selamat siang teman teman!!', 'Kudus adalah sebuah kecamatan dan ibu kota yang menjadi pusat pemerintahan dan perekonomian dari Kabupaten Kudus di provinsi Jawa Tengah, Indonesia.', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:39:01', '2024-03-04 12:39:01'),
(5078, 9, 5, 'selamat siang teman teman!!', 'Kudus adalah sebuah kecamatan dan ibu kota yang menjadi pusat pemerintahan dan perekonomian dari Kabupaten Kudus di provinsi Jawa Tengah, Indonesia.', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:39:01', '2024-03-04 12:39:01'),
(5079, 10, 5, 'selamat siang teman teman!!', 'Kudus adalah sebuah kecamatan dan ibu kota yang menjadi pusat pemerintahan dan perekonomian dari Kabupaten Kudus di provinsi Jawa Tengah, Indonesia.', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:39:01', '2024-03-04 12:39:01'),
(5080, 11, 5, 'selamat siang teman teman!!', 'Kudus adalah sebuah kecamatan dan ibu kota yang menjadi pusat pemerintahan dan perekonomian dari Kabupaten Kudus di provinsi Jawa Tengah, Indonesia.', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:39:01', '2024-03-04 12:39:01'),
(5081, 12, 5, 'selamat siang teman teman!!', 'Kudus adalah sebuah kecamatan dan ibu kota yang menjadi pusat pemerintahan dan perekonomian dari Kabupaten Kudus di provinsi Jawa Tengah, Indonesia.', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:39:01', '2024-03-04 12:39:01'),
(5084, 15, 5, 'selamat siang teman teman!!', 'Kudus adalah sebuah kecamatan dan ibu kota yang menjadi pusat pemerintahan dan perekonomian dari Kabupaten Kudus di provinsi Jawa Tengah, Indonesia.', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:39:01', '2024-03-04 12:39:01'),
(5085, 16, 5, 'selamat siang teman teman!!', 'Kudus adalah sebuah kecamatan dan ibu kota yang menjadi pusat pemerintahan dan perekonomian dari Kabupaten Kudus di provinsi Jawa Tengah, Indonesia.', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:39:01', '2024-03-04 12:39:01'),
(5086, 17, 5, 'selamat siang teman teman!!', 'Kudus adalah sebuah kecamatan dan ibu kota yang menjadi pusat pemerintahan dan perekonomian dari Kabupaten Kudus di provinsi Jawa Tengah, Indonesia.', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:39:01', '2024-03-04 12:39:01'),
(5087, 18, 5, 'selamat siang teman teman!!', 'Kudus adalah sebuah kecamatan dan ibu kota yang menjadi pusat pemerintahan dan perekonomian dari Kabupaten Kudus di provinsi Jawa Tengah, Indonesia.', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:39:01', '2024-03-04 12:39:01'),
(5088, 19, 5, 'selamat siang teman teman!!', 'Kudus adalah sebuah kecamatan dan ibu kota yang menjadi pusat pemerintahan dan perekonomian dari Kabupaten Kudus di provinsi Jawa Tengah, Indonesia.', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:39:01', '2024-03-04 12:39:01'),
(5089, 20, 5, 'selamat siang teman teman!!', 'Kudus adalah sebuah kecamatan dan ibu kota yang menjadi pusat pemerintahan dan perekonomian dari Kabupaten Kudus di provinsi Jawa Tengah, Indonesia.', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:39:01', '2024-03-04 12:39:01'),
(5090, 21, 5, 'selamat siang teman teman!!', 'Kudus adalah sebuah kecamatan dan ibu kota yang menjadi pusat pemerintahan dan perekonomian dari Kabupaten Kudus di provinsi Jawa Tengah, Indonesia.', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:39:01', '2024-03-04 12:39:01'),
(5091, 22, 5, 'selamat siang teman teman!!', 'Kudus adalah sebuah kecamatan dan ibu kota yang menjadi pusat pemerintahan dan perekonomian dari Kabupaten Kudus di provinsi Jawa Tengah, Indonesia.', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:39:01', '2024-03-04 12:39:01'),
(5092, 23, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:40:19', '2024-03-04 14:19:01'),
(5093, 24, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:40:19', '2024-03-04 14:19:01'),
(5094, 3, 5, 'absensi', 'murid anda Sofia Pratama tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"5a8cd43b-a7ba-4403-ac04-a6eb34788ce5\"}]}', 1, '2024-03-04 12:40:19', '2024-03-04 12:40:20'),
(5095, 32, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:40:19', '2024-03-04 13:29:40'),
(5096, 33, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:40:19', '2024-03-04 13:29:40'),
(5097, 3, 5, 'absensi', 'murid anda Alya Cahaya tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"94b6e556-8e9f-4b78-9174-458266216a79\"}]}', 1, '2024-03-04 12:40:19', '2024-03-04 12:40:21'),
(5098, 53, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:40:19', '2024-03-04 13:29:40'),
(5099, 54, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:40:19', '2024-03-04 13:29:40'),
(5100, 3, 5, 'absensi', 'murid anda Sofia Wardhana tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"7cbb69a0-03eb-4b8d-b6bb-68e7f2b4ab11\"}]}', 1, '2024-03-04 12:40:19', '2024-03-04 12:40:22'),
(5101, 56, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:40:19', '2024-03-04 13:29:40'),
(5102, 57, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 12:40:19', '2024-03-04 13:29:40'),
(5103, 3, 5, 'absensi', 'murid anda Sofia Putra tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"00998467-fe81-446b-8f55-c8e6cabdc25d\"}]}', 1, '2024-03-04 12:40:19', '2024-03-04 12:40:23'),
(5104, 3, 5, '??', 'yes', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"944306bf-50ea-4879-b492-d03b06e1cf9f\"}]}', 1, '2024-03-04 13:36:33', '2024-03-04 13:36:34'),
(5106, 5, 5, '??', 'yes', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:36:33', '2024-03-04 13:36:33'),
(5107, 6, 5, '??', 'yes', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:36:33', '2024-03-04 13:36:33'),
(5110, 9, 5, '??', 'yes', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:36:33', '2024-03-04 13:36:33'),
(5111, 10, 5, '??', 'yes', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:36:33', '2024-03-04 13:36:33'),
(5112, 11, 5, '??', 'yes', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:36:33', '2024-03-04 13:36:33'),
(5113, 12, 5, '??', 'yes', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:36:33', '2024-03-04 13:36:33'),
(5116, 15, 5, '??', 'yes', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:36:33', '2024-03-04 13:36:33'),
(5117, 16, 5, '??', 'yes', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:36:33', '2024-03-04 13:36:33'),
(5118, 17, 5, '??', 'yes', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:36:33', '2024-03-04 13:36:33'),
(5119, 18, 5, '??', 'yes', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:36:33', '2024-03-04 13:36:33'),
(5120, 19, 5, '??', 'yes', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:36:33', '2024-03-04 13:36:33'),
(5121, 20, 5, '??', 'yes', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:36:33', '2024-03-04 13:36:33'),
(5122, 21, 5, '??', 'yes', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:36:33', '2024-03-04 13:36:33'),
(5123, 22, 5, '??', 'yes', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:36:33', '2024-03-04 13:36:33'),
(5124, 3, 5, 'Urgent', 'Pake olga', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"ea51eb46-551e-450f-9d1c-15848435ab96\"}]}', 1, '2024-03-04 13:37:05', '2024-03-04 13:37:06'),
(5126, 5, 5, 'Urgent', 'Pake olga', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:05', '2024-03-04 13:37:05'),
(5127, 6, 5, 'Urgent', 'Pake olga', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:05', '2024-03-04 13:37:05'),
(5130, 9, 5, 'Urgent', 'Pake olga', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:05', '2024-03-04 13:37:05'),
(5131, 10, 5, 'Urgent', 'Pake olga', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:05', '2024-03-04 13:37:05'),
(5132, 11, 5, 'Urgent', 'Pake olga', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:05', '2024-03-04 13:37:05'),
(5133, 12, 5, 'Urgent', 'Pake olga', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:05', '2024-03-04 13:37:05'),
(5136, 15, 5, 'Urgent', 'Pake olga', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:05', '2024-03-04 13:37:05'),
(5137, 16, 5, 'Urgent', 'Pake olga', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:05', '2024-03-04 13:37:05'),
(5138, 17, 5, 'Urgent', 'Pake olga', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:05', '2024-03-04 13:37:05'),
(5139, 18, 5, 'Urgent', 'Pake olga', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:05', '2024-03-04 13:37:05'),
(5140, 19, 5, 'Urgent', 'Pake olga', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:05', '2024-03-04 13:37:05'),
(5141, 20, 5, 'Urgent', 'Pake olga', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:05', '2024-03-04 13:37:05'),
(5142, 21, 5, 'Urgent', 'Pake olga', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:05', '2024-03-04 13:37:05'),
(5143, 22, 5, 'Urgent', 'Pake olga', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:05', '2024-03-04 13:37:05'),
(5144, 3, 5, 'test 3', 'yes?', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"d7a051ad-c029-4694-af92-f5e3b83f6c5e\"}]}', 1, '2024-03-04 13:37:51', '2024-03-04 13:37:52'),
(5146, 5, 5, 'test 3', 'yes?', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:51', '2024-03-04 13:37:51'),
(5147, 6, 5, 'test 3', 'yes?', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:51', '2024-03-04 13:37:51'),
(5150, 9, 5, 'test 3', 'yes?', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:51', '2024-03-04 13:37:51'),
(5151, 10, 5, 'test 3', 'yes?', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:51', '2024-03-04 13:37:51'),
(5152, 11, 5, 'test 3', 'yes?', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:51', '2024-03-04 13:37:51'),
(5153, 12, 5, 'test 3', 'yes?', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:51', '2024-03-04 13:37:51'),
(5156, 15, 5, 'test 3', 'yes?', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:51', '2024-03-04 13:37:51'),
(5157, 16, 5, 'test 3', 'yes?', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:51', '2024-03-04 13:37:51'),
(5158, 17, 5, 'test 3', 'yes?', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:51', '2024-03-04 13:37:51'),
(5159, 18, 5, 'test 3', 'yes?', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:51', '2024-03-04 13:37:51'),
(5160, 19, 5, 'test 3', 'yes?', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:51', '2024-03-04 13:37:51'),
(5161, 20, 5, 'test 3', 'yes?', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:51', '2024-03-04 13:37:51'),
(5162, 21, 5, 'test 3', 'yes?', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:51', '2024-03-04 13:37:51'),
(5163, 22, 5, 'test 3', 'yes?', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:37:51', '2024-03-04 13:37:51'),
(5164, 23, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:40:05', '2024-03-04 14:19:01'),
(5165, 24, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-04 13:40:05', '2024-03-04 14:19:01'),
(5166, 3, 5, 'absensi', 'murid anda Sofia Pratama ijin', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"4c26ed85-8d2a-416f-ba5a-a601a525f601\"}]}', 1, '2024-03-04 13:40:05', '2024-03-04 13:40:06'),
(5167, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"ee4cf63c-f5f6-498c-856a-f298fc834291\"}]}', 1, '2024-03-05 10:09:52', '2024-03-05 10:09:53'),
(5168, 334, 6, 'absensi hari ini', 'anak anda sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-05 10:18:43', '2024-03-05 10:18:43'),
(5169, 335, 6, 'absensi hari ini', 'anak anda sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-05 10:18:43', '2024-03-05 10:18:43'),
(5171, 292, 6, 'absensi hari ini', 'anak anda sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-05 10:19:27', '2024-03-05 10:19:27'),
(5172, 293, 6, 'absensi hari ini', 'anak anda sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-05 10:19:27', '2024-03-05 10:19:27'),
(5174, 295, 6, 'absensi hari ini', 'anak anda ijin', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-05 10:19:27', '2024-03-05 10:19:27'),
(5175, 296, 6, 'absensi hari ini', 'anak anda ijin', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-05 10:19:27', '2024-03-05 10:19:27'),
(5177, 298, 6, 'absensi hari ini', 'anak anda ijin', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-05 10:19:27', '2024-03-05 10:19:27'),
(5178, 299, 6, 'absensi hari ini', 'anak anda ijin', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-05 10:19:27', '2024-03-05 10:19:27'),
(5180, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-13:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-05 18:29:17', '2024-03-05 18:29:17'),
(5181, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-13:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-05 22:04:33', '2024-03-05 22:04:33'),
(5182, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 07:00-09:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-06 10:10:47', '2024-03-06 10:10:47'),
(5183, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 07:00-09:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"9254d189-87e4-4010-9c64-95294ff25e75\"}]}', 1, '2024-03-06 10:12:55', '2024-03-06 10:12:56'),
(5184, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 07:00-09:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"73490d80-13ef-4a76-9dd1-a2f69943406d\"}]}', 1, '2024-03-06 10:24:21', '2024-03-06 10:24:21'),
(5185, 292, 6, 'absensi hari ini', 'anak anda sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-06 11:19:38', '2024-03-06 11:19:38'),
(5186, 293, 6, 'absensi hari ini', 'anak anda sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-06 11:19:38', '2024-03-06 11:19:38'),
(5188, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 07:00-09:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"7f8abc5f-0eec-4e5f-bcd0-3e5198e58270\"}]}', 1, '2024-03-06 11:59:43', '2024-03-06 11:59:44'),
(5189, 23, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"error\",\"message\":\"Unable to retrieve the FCM server key for the recipient\'s app. Make sure you have provided a server key as directed by the Expo FCM documentation.\",\"details\":{\"error\":\"InvalidCredentials\",\"fault\":\"developer\"}}]}', 1, '2024-03-06 12:09:55', '2024-03-06 12:21:32'),
(5190, 24, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-06 12:09:55', '2024-03-06 12:21:32'),
(5191, 3, 5, 'absensi', 'murid anda Sofia Pratama sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"014f1655-1abe-42b6-946b-309c775ac1f2\"}]}', 1, '2024-03-06 12:09:55', '2024-03-06 12:09:57'),
(5192, 3, 5, 'absensi', 'murid anda hananta afgan sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"894a1bd3-6f69-4e85-8cd5-37f2113d5760\"}]}', 1, '2024-03-06 12:10:05', '2024-03-06 12:10:06'),
(5193, 3, 5, 'absensi', 'murid anda hananta afgan tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"4cd21796-a7b4-4d5d-90fb-0cecca14e931\"}]}', 1, '2024-03-06 12:14:16', '2024-03-06 12:14:17'),
(5194, 3, 5, 'absensi', 'murid anda Sofia Pratama tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"e94154af-e076-4c8a-a35e-3fb643caca21\"}]}', 1, '2024-03-06 12:16:24', '2024-03-06 12:16:25'),
(5195, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 14:00-17:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"f8976355-c04d-4b00-b05f-cc010be0a2ea\"}]}', 1, '2024-03-06 17:39:13', '2024-03-06 17:39:16'),
(5196, 3, 5, 'absen hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"68e949d8-5c20-466e-8701-a9375be5558b\"}]}', 1, '2024-03-07 11:09:10', '2024-03-07 13:09:19'),
(5197, 3, 5, 'absen hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"b707be08-b8d2-407a-b290-3af830fdef7c\"}]}', 1, '2024-03-07 11:21:18', '2024-03-07 13:09:19'),
(5198, 3, 5, 'absen hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"85490fed-eff3-4eaf-a7c5-be2475fcd90a\"}]}', 1, '2024-03-07 11:23:59', '2024-03-07 13:09:19'),
(5199, 3, 5, 'absen hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"d1d1a08a-0ea6-459d-a1ee-c68dc01c2265\"}]}', 1, '2024-03-07 11:25:04', '2024-03-07 13:09:19'),
(5200, 3, 5, 'absen hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"89b2284a-6082-476c-9796-7f11b37da1a0\"}]}', 1, '2024-03-07 11:25:19', '2024-03-07 13:09:19'),
(5201, 3, 5, 'absen hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"268b4a28-7c1e-458d-8842-5a58d53ab71f\"}]}', 1, '2024-03-07 11:26:24', '2024-03-07 13:09:19'),
(5202, 3, 5, 'absen hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"0636d244-1c06-4279-8ff0-ffe5cafb4412\"}]}', 1, '2024-03-07 11:32:02', '2024-03-07 13:09:19'),
(5203, 3, 5, 'absen hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"4c922db3-b6af-46eb-a9e2-08a9c3a95e48\"}]}', 1, '2024-03-07 11:45:06', '2024-03-07 13:09:19'),
(5204, 1, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5205, 2, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5207, 5, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5208, 6, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5211, 9, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5212, 10, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5215, 15, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5216, 16, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5217, 17, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5218, 18, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5219, 19, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5220, 20, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5221, 21, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5222, 22, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5223, 23, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"error\",\"message\":\"Unable to retrieve the FCM server key for the recipient\'s app. Make sure you have provided a server key as directed by the Expo FCM documentation.\",\"details\":{\"error\":\"InvalidCredentials\",\"fault\":\"developer\"}}]}', 3, '2024-03-07 13:09:19', '2024-03-07 15:12:56'),
(5224, 24, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 15:12:56'),
(5225, 25, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5226, 26, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5227, 27, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5228, 28, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5229, 29, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 15:13:35'),
(5230, 30, 6, 'absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 15:13:35'),
(5231, 31, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5232, 32, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5233, 33, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5234, 34, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5235, 35, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5236, 36, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5237, 37, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5238, 38, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5239, 39, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5240, 40, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5241, 41, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:19', '2024-03-07 13:09:19'),
(5242, 42, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5243, 43, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5244, 44, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5245, 45, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5246, 46, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5247, 47, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5248, 48, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5249, 49, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5250, 50, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5251, 51, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5252, 52, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5253, 53, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5254, 54, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5255, 55, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5256, 56, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5257, 57, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5258, 58, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5259, 59, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5260, 60, 6, 'absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-07 13:09:20', '2024-03-07 13:09:20'),
(5261, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 07:00-08:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"0ecc6015-daca-4998-b0ae-b6a41911a315\"}]}', 1, '2024-03-07 13:41:52', '2024-03-07 13:41:53'),
(5262, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 07:00-08:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"fdc9d487-2919-42e9-baca-149b39bb015e\"}]}', 1, '2024-03-07 13:43:17', '2024-03-07 13:43:17'),
(5263, 3, 5, 'Absensi', 'murid anda Sofia Pratama tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"0029cdd8-da57-4faa-ba7e-9d73d7575362\"}]}', 1, '2024-03-07 15:12:55', '2024-03-07 15:12:56'),
(5264, 3, 5, 'Absensi', 'murid anda Farhan Pratama tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"c58301da-2aca-40a4-bc6c-a3174e89abcd\"}]}', 1, '2024-03-07 15:13:35', '2024-03-07 15:13:36'),
(5265, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"8c26c996-17b4-49ab-b34a-a1bbca49692d\"}]}', 1, '2024-03-08 10:01:26', '2024-03-08 10:01:26'),
(5266, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"ecec6e9c-3305-4fe2-89e6-c9a0527a1cda\"}]}', 1, '2024-03-08 10:13:05', '2024-03-08 10:13:06'),
(5267, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"479c380a-ae21-49ec-b4ad-ac75fb696004\"}]}', 1, '2024-03-08 10:13:51', '2024-03-08 10:13:52'),
(5268, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"da5aa9e9-7e8a-4e8a-bfeb-ac44f5954044\"}]}', 1, '2024-03-08 10:14:24', '2024-03-08 10:14:25'),
(5269, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"dcd94e0b-7562-4230-b9b0-49bae08581fe\"}]}', 1, '2024-03-08 10:23:45', '2024-03-08 10:23:46'),
(5270, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"8bc921d2-d893-4e8c-bdf6-0856b2813e7c\"}]}', 1, '2024-03-08 10:25:31', '2024-03-08 10:25:32'),
(5271, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"5c74e274-720a-434e-8e3b-19e27a07d0f3\"}]}', 1, '2024-03-08 10:28:01', '2024-03-08 10:28:02'),
(5272, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"218a814a-03f6-418c-8511-ae0aa1ff412a\"}]}', 1, '2024-03-08 10:29:06', '2024-03-08 10:29:07'),
(5273, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"e5a76dc1-2956-47c0-af97-b001722c3756\"}]}', 1, '2024-03-08 10:29:56', '2024-03-08 10:29:57'),
(5274, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"22c39e46-fe5f-4ed9-bf52-3c127b1ad269\"}]}', 1, '2024-03-08 10:31:05', '2024-03-08 10:31:06'),
(5275, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"747ee32b-90ad-4d7e-b529-641f691bba87\"}]}', 1, '2024-03-08 10:32:39', '2024-03-08 10:32:40'),
(5276, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"4a8f2ba6-6c58-474f-80f8-c7d5f82afe7d\"}]}', 1, '2024-03-08 10:33:04', '2024-03-08 10:33:05'),
(5277, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"dcb9b7d8-3606-4ded-b00f-68ba2821fbeb\"}]}', 1, '2024-03-08 10:33:31', '2024-03-08 10:33:31'),
(5278, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"44a16748-c08b-4aa2-a04b-1105dfd5fb20\"}]}', 1, '2024-03-08 10:34:05', '2024-03-08 10:34:06'),
(5279, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"504cb93d-325e-4598-99f6-4870373a159e\"}]}', 1, '2024-03-08 10:35:08', '2024-03-08 10:35:09'),
(5280, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"19133e09-6a7e-42e4-90ea-c1fe7e91c2b6\"}]}', 1, '2024-03-08 10:36:11', '2024-03-08 10:36:12'),
(5281, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"9c25c475-27be-47d5-9fe5-e879e2f7385f\"}]}', 1, '2024-03-08 10:38:14', '2024-03-08 10:38:15'),
(5282, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"ee191c7a-f327-422e-98ec-38410064a8c4\"}]}', 1, '2024-03-08 10:39:46', '2024-03-08 10:39:47'),
(5283, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"7ec6805e-884a-46eb-bb5f-c31493285350\"}]}', 1, '2024-03-08 10:40:53', '2024-03-08 10:40:54'),
(5284, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-10:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"c276ea0d-2ddc-49dd-8d69-7e1ee7544b49\"}]}', 1, '2024-03-08 10:41:02', '2024-03-08 10:41:03'),
(5285, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"93c1fae9-f34c-4431-b52f-39bfce6a4d15\"}]}', 1, '2024-03-08 14:19:57', '2024-03-08 14:19:58'),
(5286, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 12:00-14:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"eb320113-827f-4760-9692-ea1a1527058a\"}]}', 1, '2024-03-08 15:18:15', '2024-03-08 15:18:16'),
(5287, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 16:00-17:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"47ffbb8c-c4d9-4bfe-bce9-c477230ccd06\"}]}', 1, '2024-03-11 18:20:32', '2024-03-11 18:20:33'),
(5288, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-11:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:05:21', '2024-03-12 11:05:21'),
(5289, 23, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"error\",\"message\":\"Unable to retrieve the FCM server key for the recipient\'s app. Make sure you have provided a server key as directed by the Expo FCM documentation.\",\"details\":{\"error\":\"InvalidCredentials\",\"fault\":\"developer\"}}]}', 3, '2024-03-12 11:06:10', '2024-03-12 16:53:11'),
(5290, 24, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:06:10', '2024-03-12 16:53:11'),
(5291, 3, 5, 'Absensi', 'murid anda Sofia Pratama tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:06:10', '2024-03-12 11:06:10'),
(5292, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-11:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:08:07', '2024-03-12 11:08:07'),
(5293, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 11:00-11:10', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:10:17', '2024-03-12 11:10:17'),
(5294, 29, 6, 'Absensi hari ini', 'anak anda sakit', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:10:29', '2024-03-12 16:53:11'),
(5295, 30, 6, 'Absensi hari ini', 'anak anda sakit', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:10:29', '2024-03-12 16:53:11'),
(5296, 3, 5, 'Absensi', 'murid anda Farhan Pratama tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:10:29', '2024-03-12 11:10:29'),
(5297, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 11:00-11:10', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:10:30', '2024-03-12 11:10:30'),
(5298, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 11:00-11:10', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:12:26', '2024-03-12 11:12:26'),
(5299, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 11:00-11:10', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:13:23', '2024-03-12 11:13:23'),
(5300, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 11:00-11:10', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:13:54', '2024-03-12 11:13:54'),
(5301, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 11:00-11:10', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:14:50', '2024-03-12 11:14:50'),
(5302, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 11:00-11:10', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:15:06', '2024-03-12 11:15:06'),
(5303, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 11:00-11:10', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:15:24', '2024-03-12 11:15:24'),
(5304, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 11:00-11:10', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:16:05', '2024-03-12 11:16:05'),
(5305, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 11:00-11:10', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:19:52', '2024-03-12 11:19:52'),
(5306, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 11:00-11:10', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:23:46', '2024-03-12 11:23:46'),
(5307, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 11:00-11:10', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:25:19', '2024-03-12 11:25:19'),
(5308, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 11:00-11:10', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:26:54', '2024-03-12 11:26:54'),
(5309, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-11:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 11:32:06', '2024-03-12 11:32:06'),
(5310, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-11:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"362072ac-087a-4f14-8df3-c3e201c6074c\"}]}', 1, '2024-03-12 11:32:19', '2024-03-12 11:32:20'),
(5311, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-11:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"9ebd10a8-ff6c-4d7f-b56f-5fafdc080c94\"}]}', 1, '2024-03-12 11:32:32', '2024-03-12 11:32:33'),
(5312, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-11:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"34d878c6-9d7c-455b-8f5c-50d3448e35f3\"}]}', 1, '2024-03-12 11:40:20', '2024-03-12 11:40:21'),
(5313, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-11:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"8c813d99-a814-4620-b9a2-f2e6eaaa030d\"}]}', 1, '2024-03-12 11:41:00', '2024-03-12 11:41:01'),
(5314, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-11:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"cac3cfbe-9c0c-4ae2-8b4b-43cb6ca2a974\"}]}', 1, '2024-03-12 11:41:35', '2024-03-12 11:41:36'),
(5315, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-11:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"94de5658-1bfe-47e3-86d7-27e7a44ae2c9\"}]}', 1, '2024-03-12 11:42:43', '2024-03-12 11:42:44'),
(5316, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-11:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"6df2757b-0f6a-4db6-8909-75b0daa05fb3\"}]}', 1, '2024-03-12 11:43:21', '2024-03-12 11:43:22'),
(5317, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-11:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"e989d682-a63e-431f-9c23-23c0212f45ef\"}]}', 1, '2024-03-12 11:44:26', '2024-03-12 11:44:27'),
(5318, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-11:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"49ef6f88-bde0-4bb9-a7a6-f1815ac5cac2\"}]}', 1, '2024-03-12 11:46:23', '2024-03-12 11:46:25');
INSERT INTO `bbc_user_push_notif` (`id`, `user_id`, `group_id`, `title`, `message`, `params`, `return`, `status`, `created`, `updated`) VALUES
(5319, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-11:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"6af4b4e2-9750-441e-9abb-69d79f0635b7\"}]}', 1, '2024-03-12 11:47:11', '2024-03-12 11:47:12'),
(5320, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-11:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"88f54b0d-e51e-4e82-9015-8638a341fee8\"}]}', 1, '2024-03-12 11:57:33', '2024-03-12 11:57:33'),
(5321, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-11:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"6baa546e-0011-40d8-b226-8f7d9adc3db6\"}]}', 1, '2024-03-12 11:58:05', '2024-03-12 11:58:06'),
(5322, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-11:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"6eb131cb-0692-4f1f-9219-c0e7b8a43b69\"}]}', 1, '2024-03-12 11:58:07', '2024-03-12 11:58:08'),
(5323, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 10:00-11:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"a7eec217-a324-4e98-bd1f-c1fac14b37da\"}]}', 1, '2024-03-12 11:58:17', '2024-03-12 11:58:18'),
(5324, 203, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 12:29:19', '2024-03-12 14:41:29'),
(5325, 204, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 12:29:19', '2024-03-12 14:41:29'),
(5326, 5, 5, 'Absensi', 'murid anda Farhan Maharani sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 12:29:19', '2024-03-12 12:29:19'),
(5327, 206, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 12:45:46', '2024-03-12 14:41:29'),
(5328, 207, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 12:45:46', '2024-03-12 14:41:29'),
(5329, 5, 5, 'Absensi', 'murid anda Alya Pratama sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 12:45:46', '2024-03-12 12:45:46'),
(5330, 209, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 12:45:46', '2024-03-12 14:41:29'),
(5331, 210, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 12:45:46', '2024-03-12 14:41:30'),
(5332, 5, 5, 'Absensi', 'murid anda Sofia Wardhana ijin', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 12:45:46', '2024-03-12 12:45:46'),
(5333, 212, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 12:45:46', '2024-03-12 12:45:46'),
(5334, 213, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 12:45:46', '2024-03-12 12:45:46'),
(5335, 5, 5, 'Absensi', 'murid anda Rafa Cahaya tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 12:45:46', '2024-03-12 12:45:46'),
(5336, 295, 6, 'Absensi hari ini', 'anak anda sakit', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 12:58:14', '2024-03-12 12:58:14'),
(5337, 296, 6, 'Absensi hari ini', 'anak anda sakit', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 12:58:14', '2024-03-12 12:58:14'),
(5339, 26, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 13:12:33', '2024-03-12 14:43:32'),
(5340, 27, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 13:12:33', '2024-03-12 14:43:32'),
(5341, 3, 5, 'Absensi', 'murid anda Alya Maharani sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"e4984cbc-3d57-4831-91d5-c785d11c6cd5\"}]}', 1, '2024-03-12 13:12:33', '2024-03-12 13:12:34'),
(5342, 3, 5, 'Absensi', 'murid anda Farhan Pratama ijin', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"6d51e472-6e3d-46c0-8fd7-494494ee4c25\"}]}', 1, '2024-03-12 13:12:33', '2024-03-12 13:12:35'),
(5343, 3, 5, 'Absensi', 'murid anda Farhan Pratama sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"4dc7681f-a8fc-4177-aa65-9756c9b7f35e\"}]}', 1, '2024-03-12 14:33:51', '2024-03-12 14:33:52'),
(5344, 5, 5, 'Absensi', 'murid anda Farhan Maharani tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:29', '2024-03-12 14:41:29'),
(5345, 5, 5, 'Absensi', 'murid anda Alya Pratama tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:29', '2024-03-12 14:41:29'),
(5346, 5, 5, 'Absensi', 'murid anda Sofia Wardhana tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:30', '2024-03-12 14:41:30'),
(5347, 215, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:30', '2024-03-12 14:41:30'),
(5348, 216, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:30', '2024-03-12 14:41:30'),
(5349, 218, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:30', '2024-03-12 14:41:30'),
(5350, 219, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:30', '2024-03-12 14:41:30'),
(5351, 5, 5, 'Absensi', 'murid anda Farhan Pratama tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:30', '2024-03-12 14:41:30'),
(5352, 221, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:30', '2024-03-12 14:41:30'),
(5353, 222, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:30', '2024-03-12 14:41:30'),
(5354, 5, 5, 'Absensi', 'murid anda Sofia Putra tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:30', '2024-03-12 14:41:30'),
(5355, 224, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:30', '2024-03-12 14:41:30'),
(5356, 225, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:30', '2024-03-12 14:41:30'),
(5357, 5, 5, 'Absensi', 'murid anda Rafa Pratama tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:30', '2024-03-12 14:41:30'),
(5358, 227, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:30', '2024-03-12 14:41:30'),
(5359, 228, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:30', '2024-03-12 14:41:30'),
(5360, 230, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:30', '2024-03-12 14:41:30'),
(5361, 231, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:30', '2024-03-12 14:41:30'),
(5362, 5, 5, 'Absensi', 'murid anda Alya Putra tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 14:41:30', '2024-03-12 14:41:30'),
(5363, 3, 5, 'Absensi', 'murid anda Sofia Pratama sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"74a64bee-6e0c-4de4-b2fe-08bf8a7f379c\"}]}', 1, '2024-03-12 14:41:44', '2024-03-12 14:41:45'),
(5364, 3, 5, 'Absensi', 'murid anda Sofia Pratama ijin', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"05ca62ba-f404-4bcb-984c-5b647df8961a\"}]}', 1, '2024-03-12 14:41:49', '2024-03-12 14:41:51'),
(5365, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 05:00-07:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"bd475199-3382-4e17-a700-7d694e0c5545\"}]}', 1, '2024-03-12 14:59:44', '2024-03-12 14:59:45'),
(5366, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 05:00-07:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"759acb60-18fa-412c-a3c7-805dd008d980\"}]}', 1, '2024-03-12 15:28:59', '2024-03-12 15:29:00'),
(5367, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 05:00-07:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"e94c8196-ad08-4fc7-92e6-8e1ed5da31bb\"}]}', 1, '2024-03-12 15:45:08', '2024-03-12 15:45:09'),
(5368, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 05:00-07:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"1c16686c-97df-4015-85ad-6c54e0ac0783\"}]}', 1, '2024-03-12 15:45:43', '2024-03-12 15:45:44'),
(5369, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 05:00-07:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"b1ec3277-6851-4300-a385-3dca8584567e\"}]}', 1, '2024-03-12 16:11:05', '2024-03-12 16:11:05'),
(5370, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 05:00-07:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-12 16:11:10', '2024-03-12 16:11:10'),
(5371, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 05:00-07:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"696eb035-d9eb-40f5-b188-71950612ec7a\"}]}', 1, '2024-03-12 16:17:00', '2024-03-12 16:17:00'),
(5372, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 05:00-07:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"4b4c7a00-aa32-451d-81ce-3f537e0029e4\"}]}', 1, '2024-03-12 16:20:12', '2024-03-12 16:20:13'),
(5373, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 05:00-07:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"0577f84d-3a45-4fd2-99a0-7e00a11fb44b\"}]}', 1, '2024-03-12 16:20:44', '2024-03-12 16:20:45'),
(5374, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 05:00-07:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"bf9815e0-5ab0-4068-af2b-2fd7dadf4562\"}]}', 1, '2024-03-12 16:38:29', '2024-03-12 16:38:30'),
(5375, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 05:00-07:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"29789095-c6c8-4e4f-8129-20645eac0915\"}]}', 1, '2024-03-12 16:39:16', '2024-03-12 16:39:17'),
(5376, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 05:00-07:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"becdb6ab-713a-4b0c-87ae-fe7f464a1fe9\"}]}', 1, '2024-03-13 08:42:09', '2024-03-13 08:42:10'),
(5377, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 05:00-06:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"0573d317-725c-4d52-aeb3-91c370e23e5a\"}]}', 1, '2024-03-13 08:44:47', '2024-03-13 08:44:48'),
(5378, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 07:00-08:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"33812c87-3916-47b8-a1c8-d93db3f78f27\"}]}', 1, '2024-03-13 08:52:11', '2024-03-13 08:52:12'),
(5379, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 08:00-09:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"0ea33ccc-3268-496b-ad85-6a1e8c53d195\"}]}', 1, '2024-03-13 09:04:10', '2024-03-13 09:04:11'),
(5380, 292, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 09:07:37', '2024-03-13 09:33:35'),
(5381, 293, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 09:07:37', '2024-03-13 09:33:35'),
(5383, 295, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 09:07:37', '2024-03-13 09:08:18'),
(5384, 296, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 09:07:37', '2024-03-13 09:08:18'),
(5386, 298, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 09:07:37', '2024-03-13 09:08:18'),
(5387, 299, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 09:07:37', '2024-03-13 09:08:18'),
(5389, 301, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 09:07:37', '2024-03-13 09:08:18'),
(5390, 302, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 09:07:37', '2024-03-13 09:08:18'),
(5392, 304, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 09:07:37', '2024-03-13 09:08:18'),
(5393, 305, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 09:07:37', '2024-03-13 09:08:18'),
(5394, 29, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 10:56:36', '2024-03-13 16:46:25'),
(5395, 30, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 10:56:36', '2024-03-13 16:46:25'),
(5396, 3, 5, 'Absensi', 'murid anda Farhan Pratama ijin', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"953ca0b1-fef9-4751-9b0d-a8d92d375b87\"}]}', 1, '2024-03-13 10:56:36', '2024-03-13 10:56:37'),
(5397, 32, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 10:57:08', '2024-03-13 13:56:01'),
(5398, 33, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 10:57:08', '2024-03-13 13:56:01'),
(5399, 3, 5, 'Absensi', 'murid anda Alya Cahaya ijin', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"52d243c3-caa0-4033-b40d-cdf56bbfe3c3\"}]}', 1, '2024-03-13 10:57:08', '2024-03-13 10:57:09'),
(5400, 3, 5, 'Absensi', 'murid anda Alya Cahaya sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"ac5a2301-8a5d-41dd-a362-93b9e7e09a13\"}]}', 1, '2024-03-13 11:05:01', '2024-03-13 11:05:03'),
(5401, 23, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 12:54:56', '2024-03-13 16:46:25'),
(5402, 24, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 12:54:56', '2024-03-13 16:46:25'),
(5403, 3, 5, 'Absensi', 'murid anda Sofia Pratama tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"f8c07319-fa5a-488e-9d38-4e4d3985ff6c\"}]}', 1, '2024-03-13 12:54:56', '2024-03-13 12:54:58'),
(5404, 26, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 12:55:03', '2024-03-13 14:32:58'),
(5405, 27, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 12:55:03', '2024-03-13 14:32:58'),
(5406, 3, 5, 'Absensi', 'murid anda Alya Maharani ijin', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"08bda8ad-d617-4a1d-9297-126072dffc2a\"}]}', 1, '2024-03-13 12:55:03', '2024-03-13 12:55:04'),
(5407, 3, 5, 'Absensi', 'murid anda hananta afgan tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"ok\",\"id\":\"751b48fa-c772-4f19-98b0-f6eba6dbaa76\"}]}', 1, '2024-03-13 14:32:59', '2024-03-13 14:33:00'),
(5408, 41, 6, 'Absensi hari ini', 'anak anda ijin', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 14:34:27', '2024-03-13 14:34:27'),
(5409, 42, 6, 'Absensi hari ini', 'anak anda ijin', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 14:34:27', '2024-03-13 14:34:27'),
(5410, 3, 5, 'Absensi', 'murid anda Farhan Pratama tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-13 16:46:25', '2024-03-13 16:46:25'),
(5411, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 08:00-09:00', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 09:12:58', '2024-03-14 09:12:58'),
(5412, 3, 5, 'absen hari ini', 'anda lupa absen, di jam 09:00-09:15', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 09:46:26', '2024-03-14 09:46:26'),
(5413, 32, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 12:15:54', '2024-03-14 15:03:10'),
(5414, 33, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 12:15:54', '2024-03-14 15:03:10'),
(5415, 3, 5, 'Absensi', 'murid anda Alya Cahaya sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 12:15:54', '2024-03-14 12:15:54'),
(5416, 35, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 12:15:54', '2024-03-14 15:03:20'),
(5417, 36, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 12:15:54', '2024-03-14 15:03:20'),
(5418, 3, 5, 'Absensi', 'murid anda Farhan Cahaya sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 12:15:54', '2024-03-14 12:15:54'),
(5419, 29, 6, 'Absensi hari ini', 'anak anda ijin', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 12:29:25', '2024-03-14 14:51:59'),
(5420, 30, 6, 'Absensi hari ini', 'anak anda ijin', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 12:29:25', '2024-03-14 14:51:59'),
(5421, 3, 5, 'Absensi', 'murid anda Farhan Pratama sakit', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 12:29:25', '2024-03-14 12:29:25'),
(5422, 44, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 12:34:24', '2024-03-14 14:48:37'),
(5423, 45, 6, 'Absensi hari ini', 'anak anda berangkat', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 12:34:24', '2024-03-14 14:48:37'),
(5424, 3, 5, 'Absensi', 'murid anda Rafa Maharani tidak hadir', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 12:34:24', '2024-03-14 12:34:24'),
(5425, 3, 5, 'Presensi 1Bahasa Indonesia', '27, 0, 0, 0', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 14:48:40', '2024-03-14 14:48:40'),
(5426, 23, 6, 'Absensi hari ini', 'anak anda ijin', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', '{\"data\":[{\"status\":\"error\",\"message\":\"Unable to retrieve the FCM server key for the recipient\'s app. Make sure you have provided a server key as directed by the Expo FCM documentation.\",\"details\":{\"error\":\"InvalidCredentials\",\"fault\":\"developer\"}}]}', 3, '2024-03-14 14:48:50', '2024-03-14 15:30:45'),
(5427, 24, 6, 'Absensi hari ini', 'anak anda ijin', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 14:48:50', '2024-03-14 15:30:45'),
(5428, 3, 5, 'Presensi 1Bahasa Indonesia', '26, 1, 0, 0', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 14:48:50', '2024-03-14 14:48:50'),
(5429, 3, 5, 'Presensi 10 RPL 2 Bahasa Indonesia', 'Berangkat 25, Sakit 1, Ijin 1, Alfa 0', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 14:51:59', '2024-03-14 14:51:59'),
(5430, 3, 5, 'ArrayPresensi 10 RPL 2 Bahasa Indonesia', 'Berangkat 24, Sakit 1, Ijin 1, Alfa 1', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 15:02:10', '2024-03-14 15:02:10'),
(5431, 50, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 15:03:32', '2024-03-14 15:03:32'),
(5432, 51, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 15:03:32', '2024-03-14 15:03:32'),
(5433, 3, 5, 'Presensi 10 RPL 2 Bahasa Indonesia', 'Berangkat 23, Sakit 1, Ijin 1, Alfa 2', '{\"action\":\"default\",\"module\":\"teacher\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 15:03:32', '2024-03-14 15:03:32'),
(5434, 47, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 15:26:32', '2024-03-14 15:26:32'),
(5435, 48, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 15:26:32', '2024-03-14 15:26:32'),
(5436, 110, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 15:26:50', '2024-03-14 15:26:50'),
(5437, 111, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 15:26:50', '2024-03-14 15:26:50'),
(5438, 107, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 15:27:47', '2024-03-14 15:27:47'),
(5439, 108, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 15:27:47', '2024-03-14 15:27:47'),
(5440, 104, 6, 'Absensi hari ini', 'anak anda sakit', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 15:28:18', '2024-03-14 15:28:18'),
(5441, 105, 6, 'Absensi hari ini', 'anak anda sakit', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 15:28:18', '2024-03-14 15:28:18'),
(5442, 101, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 15:30:12', '2024-03-14 15:30:12'),
(5443, 102, 6, 'Absensi hari ini', 'anak anda tidak hadir', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 15:30:12', '2024-03-14 15:30:12'),
(5444, 98, 6, 'Absensi hari ini', 'anak anda sakit', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 15:30:45', '2024-03-14 15:30:45'),
(5445, 99, 6, 'Absensi hari ini', 'anak anda sakit', '{\"action\":\"default\",\"module\":\"parent\\/notif\",\"arguments\":[]}', NULL, 0, '2024-03-14 15:30:45', '2024-03-14 15:30:45');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `params` text,
  `message` text,
  `answer` text,
  `post_date` datetime DEFAULT NULL,
  `answer_date` datetime DEFAULT NULL,
  `followed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contact_field`
--

CREATE TABLE `contact_field` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `checked` enum('any','email','url','phone','number') DEFAULT 'any',
  `title` varchar(255) NOT NULL,
  `tips` varchar(255) NOT NULL,
  `attr` varchar(255) NOT NULL,
  `default` text NOT NULL,
  `option` text NOT NULL,
  `orderby` int(255) NOT NULL DEFAULT '1',
  `mandatory` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_field`
--

INSERT INTO `contact_field` (`id`, `type`, `checked`, `title`, `tips`, `attr`, `default`, `option`, `orderby`, `mandatory`, `active`) VALUES
(1, 'textarea', 'any', 'Address', '', '', '', '', 1, 0, 1),
(2, 'text', 'any', 'City', '', '', '', '', 2, 0, 1),
(3, 'text', 'any', 'State', '', '', '', '', 3, 0, 1),
(4, 'text', 'number', 'Post Code', '', '', '', '', 4, 0, 1),
(5, 'text', 'phone', 'Phone', '', '', '', '', 6, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messenger`
--

CREATE TABLE `contact_messenger` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `code` text,
  `online` tinyint(1) NOT NULL DEFAULT '0',
  `orderby` int(11) DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_messenger`
--

INSERT INTO `contact_messenger` (`id`, `name`, `username`, `code`, `online`, `orderby`, `publish`) VALUES
(1, 'Cust.Support', 'bbc_danang', '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `guestbook`
--

CREATE TABLE `guestbook` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `params` text,
  `message` text,
  `date` datetime DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `guestbook_field`
--

CREATE TABLE `guestbook_field` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `checked` enum('any','email','url','phone','number') DEFAULT 'any',
  `title` varchar(255) NOT NULL,
  `tips` varchar(255) NOT NULL,
  `attr` varchar(255) NOT NULL,
  `default` text NOT NULL,
  `option` text NOT NULL,
  `orderby` int(255) NOT NULL DEFAULT '1',
  `mandatory` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guestbook_field`
--

INSERT INTO `guestbook_field` (`id`, `type`, `checked`, `title`, `tips`, `attr`, `default`, `option`, `orderby`, `mandatory`, `active`) VALUES
(1, 'textarea', 'any', 'Address', '', 'rows=3 cols=34', '', '', 2, 0, 1),
(2, 'text', 'any', 'Company', '', 'size=34', '', '', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `imageslider`
--

CREATE TABLE `imageslider` (
  `id` int(255) NOT NULL,
  `cat_id` int(255) NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `orderby` int(11) DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imageslider`
--

INSERT INTO `imageslider` (`id`, `cat_id`, `image`, `link`, `orderby`, `publish`) VALUES
(1, 1, '4c4c675c0b71e.jpg', '', 10, 1),
(2, 1, '4c4c677194c62.jpg', '', 9, 0),
(3, 1, '4c4c678e57bd3.jpg', '', 8, 0),
(4, 1, '4c4c679a89547.jpg', '', 7, 0),
(5, 1, '4c4c67c972711.jpg', '', 6, 0),
(6, 1, '4c4c67e41e84b.jpg', '', 5, 0),
(7, 1, '4c4c67ffca2e0.jpg', '', 4, 0),
(8, 1, '4c4c681035682.jpg', '', 3, 0),
(9, 1, '4c4c681f6ea08.jpg', '', 2, 0),
(10, 1, '4c4c682aaf7a1.jpg', '', 1, 1),
(11, 1, '', '', 11, 1),
(12, 1, '', '', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `imageslider_cat`
--

CREATE TABLE `imageslider_cat` (
  `id` int(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imageslider_cat`
--

INSERT INTO `imageslider_cat` (`id`, `title`, `width`, `height`) VALUES
(1, 'Header', 500, 150);

-- --------------------------------------------------------

--
-- Table structure for table `imageslider_text`
--

CREATE TABLE `imageslider_text` (
  `imageslider_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `lang_id` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imageslider_text`
--

INSERT INTO `imageslider_text` (`imageslider_id`, `title`, `lang_id`) VALUES
(1, 'Gedung', 1),
(2, 'Praktikum', 1),
(3, 'Kelas', 1),
(4, 'Laboratorium', 1),
(5, 'Praktek', 1),
(6, 'Penyerahan Hadiah', 1),
(7, 'Pengajaran', 1),
(8, 'Belajar Kelompok', 1),
(9, 'Perpustakaan', 1),
(10, 'Wisuda', 1),
(11, 'phs', 1),
(12, 'lookism', 1);

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(25) DEFAULT NULL,
  `orderby` int(255) DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `title`, `link`, `image`, `orderby`, `publish`) VALUES
(1, 'Dirjen Pendidikan Tinggi', 'http://dikti.go.id/', '', 1, 1),
(2, 'Departemen Kesehatan RI', 'http://depkes.go.id/', '', 4, 1),
(3, 'Pusat Informasi dan Konseling Kesehatan Reproduksi (PIKKR)', 'http://pikkr.wordpress.com/', '', 2, 1),
(4, 'Dinas Kesehatan Provinsi DIY', 'http://fisip.net/', '', 3, 1),
(5, 'Download', 'http://www.ifwdb.com/', '', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `links_ad`
--

CREATE TABLE `links_ad` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `content` text NOT NULL,
  `javascript` text NOT NULL,
  `publish` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `links_share`
--

CREATE TABLE `links_share` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `total` bigint(20) DEFAULT '0',
  `publish` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabel untuk menyimpan data member';

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `user_id`, `name`) VALUES
(767, 35, 'Budi Setiawan'),
(768, 36, 'Siti Rahmawati'),
(769, 37, 'Ahmad Fikri'),
(770, 38, 'Andi Wirawan'),
(771, 39, 'Wulan Sari'),
(772, 40, 'Annisa Putri'),
(773, 41, 'Guru Sugeng'),
(774, 42, 'Guru Osas'),
(775, 43, 'Prabowo Subianto'),
(776, 44, 'Ganjar Pranowo'),
(777, 45, 'Prabowo Subianto'),
(778, 46, 'Ganjar Pranowo');

-- --------------------------------------------------------

--
-- Table structure for table `member_device`
--

CREATE TABLE `member_device` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `member_id` int(11) UNSIGNED NOT NULL,
  `installation_id` varchar(255) DEFAULT NULL,
  `key` varchar(50) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabel untuk menyimpan data device yang login';

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(11) UNSIGNED NOT NULL,
  `npsn` int(10) NOT NULL COMMENT 'Nomor Pokok Sekolah Nasional',
  `nss` int(16) NOT NULL COMMENT 'Nomor Statistik Sekolah',
  `name` varchar(255) DEFAULT NULL,
  `address` text,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `semester` int(1) NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='menyimpan data sekolah';

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `npsn`, `nss`, `name`, `address`, `image`, `email`, `phone`, `semester`, `created`, `updated`, `active`) VALUES
(1, 20317992, 2147483647, 'SDIT Al Islam Kudus', 'Jl. Veteran No. 8 Kudus', NULL, 'sdit_alislam@yahoo.co.id', '0895385400009', 1, '2024-12-10 10:35:18', '2025-01-07 10:36:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `school_attendance`
--

CREATE TABLE `school_attendance` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_id` int(11) UNSIGNED DEFAULT NULL,
  `schedule_id` int(11) UNSIGNED DEFAULT NULL,
  `presence` tinyint(1) DEFAULT '1' COMMENT '1=hadir, 2=sakit, 3=ijin, 4=tidak hadir',
  `notes` varchar(255) DEFAULT NULL COMMENT 'ini adalah keterangan dari field sebelumnya',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='daftar kehadiran';

-- --------------------------------------------------------

--
-- Table structure for table `school_attendance_report`
--

CREATE TABLE `school_attendance_report` (
  `id` int(11) UNSIGNED NOT NULL,
  `teacher_id` int(11) UNSIGNED DEFAULT NULL,
  `course_id` int(11) UNSIGNED DEFAULT NULL,
  `class_id` int(11) UNSIGNED DEFAULT NULL,
  `schedule_id` int(11) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '1=completed, 2=finished, 3=late',
  `total_present` int(11) UNSIGNED DEFAULT NULL COMMENT 'total kehadiran',
  `total_s` int(11) UNSIGNED DEFAULT NULL COMMENT 'total sakit',
  `total_i` int(11) UNSIGNED DEFAULT NULL COMMENT 'total ijin',
  `total_a` int(11) UNSIGNED DEFAULT NULL COMMENT 'total tidak hadir',
  `date_day` tinyint(1) DEFAULT NULL,
  `date_week` tinyint(1) DEFAULT NULL,
  `date_month` tinyint(1) DEFAULT NULL,
  `date_year` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='hasil laporan kehadiran';

-- --------------------------------------------------------

--
-- Table structure for table `school_class`
--

CREATE TABLE `school_class` (
  `id` int(11) UNSIGNED NOT NULL,
  `teacher_id` int(11) UNSIGNED DEFAULT NULL,
  `grade` tinyint(2) DEFAULT NULL COMMENT 'tingkatan kelas (1,2,3)',
  `label` varchar(10) DEFAULT NULL COMMENT 'setelah grade (a,b,c)',
  `major` varchar(50) DEFAULT NULL COMMENT 'kejurusan kelas (opsional)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='data banyak kelas';

-- --------------------------------------------------------

--
-- Table structure for table `school_clock`
--

CREATE TABLE `school_clock` (
  `id` int(11) UNSIGNED NOT NULL,
  `clock_lesson` int(11) DEFAULT NULL,
  `clock_start` char(5) DEFAULT NULL,
  `clock_end` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `school_course`
--

CREATE TABLE `school_course` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='data mata pelajaran sekolah';

--
-- Dumping data for table `school_course`
--

INSERT INTO `school_course` (`id`, `name`) VALUES
(1, 'Pendidikan Agama Islam dan Budi Pekerti'),
(2, 'Pendidikan Pancasila'),
(3, 'Bahasa Indonesia'),
(4, 'Matematika'),
(5, 'Ilmu Pengetahuan Alam dan Sosial'),
(6, 'Seni Budaya'),
(7, 'Pendidikan Jasmani Olahraga dan Kesehatan'),
(8, 'Bahasa Jawa'),
(9, 'Bahasa Inggris'),
(10, 'Bahasa Arab'),
(11, 'Teknologi Informasi dan Komunikasi');

-- --------------------------------------------------------

--
-- Table structure for table `school_parent`
--

CREATE TABLE `school_parent` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `phone` char(14) NOT NULL,
  `nik` char(16) DEFAULT NULL,
  `nokk` char(16) DEFAULT NULL,
  `address` text NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '1',
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='data orang tua siswa';

-- --------------------------------------------------------

--
-- Table structure for table `school_schedule`
--

CREATE TABLE `school_schedule` (
  `id` int(11) UNSIGNED NOT NULL,
  `subject_id` int(11) UNSIGNED DEFAULT NULL,
  `day` tinyint(1) DEFAULT NULL COMMENT '1=senin, 2=selasa, 3=rabu, 4=kamis,5=jumat, 6=sabtu, 7=ahad',
  `clock_start` char(5) DEFAULT NULL,
  `clock_end` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='data jadwal';

-- --------------------------------------------------------

--
-- Table structure for table `school_score`
--

CREATE TABLE `school_score` (
  `id` int(11) NOT NULL,
  `student_id` int(11) UNSIGNED NOT NULL,
  `teacher_id` int(11) UNSIGNED NOT NULL,
  `course_id` int(11) UNSIGNED NOT NULL,
  `score` int(3) UNSIGNED NOT NULL,
  `type_id` int(11) UNSIGNED NOT NULL,
  `semester` int(1) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `school_score_cat`
--

CREATE TABLE `school_score_cat` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(10) NOT NULL COMMENT 'Nama Tugas (Tugas 1, Tugas dst.)',
  `weight` int(1) UNSIGNED NOT NULL COMMENT 'Bobot nilai dari tugas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `school_student`
--

CREATE TABLE `school_student` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `parent_id_dad` int(11) UNSIGNED DEFAULT NULL COMMENT 'parent id ayah siswa',
  `parent_id_mom` int(11) UNSIGNED DEFAULT NULL COMMENT 'parent id ibu siswa',
  `parent_id_guard` int(11) UNSIGNED DEFAULT NULL COMMENT 'parent id wali siswa (jika ada)',
  `name` varchar(225) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `nis` varchar(225) DEFAULT NULL COMMENT 'nomor induk siswa',
  `nisn` int(20) DEFAULT NULL,
  `nokk` char(16) DEFAULT NULL COMMENT 'nomor kartu keluarga',
  `address` text NOT NULL COMMENT 'alamat',
  `image` varchar(255) NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='data siswa';

-- --------------------------------------------------------

--
-- Table structure for table `school_student_class`
--

CREATE TABLE `school_student_class` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_id` int(11) UNSIGNED DEFAULT NULL,
  `class_id` int(11) UNSIGNED DEFAULT NULL,
  `number` int(11) UNSIGNED DEFAULT NULL COMMENT 'nomor absent siswa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='data menyimpan siswa per kelas';

-- --------------------------------------------------------

--
-- Table structure for table `school_student_parent`
--

CREATE TABLE `school_student_parent` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_id` int(11) UNSIGNED DEFAULT NULL,
  `parent_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='data menghubungkan orang tua siswa dan siswa';

-- --------------------------------------------------------

--
-- Table structure for table `school_teacher`
--

CREATE TABLE `school_teacher` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `nip` char(18) DEFAULT NULL COMMENT 'nomor induk pegawai',
  `phone` char(14) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL COMMENT 'jabatan',
  `birthday` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='data guru';

-- --------------------------------------------------------

--
-- Table structure for table `school_teacher_subject`
--

CREATE TABLE `school_teacher_subject` (
  `id` int(11) UNSIGNED NOT NULL,
  `teacher_id` int(11) UNSIGNED DEFAULT NULL,
  `course_id` int(11) UNSIGNED DEFAULT NULL,
  `class_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='mengkelompokan guru dengan mata pelajaran dan kelas ';

-- --------------------------------------------------------

--
-- Table structure for table `survey_polling`
--

CREATE TABLE `survey_polling` (
  `id` int(255) NOT NULL,
  `result` varchar(255) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survey_polling`
--

INSERT INTO `survey_polling` (`id`, `result`, `publish`) VALUES
(1, NULL, 1),
(2, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `survey_polling_option`
--

CREATE TABLE `survey_polling_option` (
  `id` int(255) NOT NULL,
  `polling_id` int(255) DEFAULT NULL,
  `voted` int(255) NOT NULL DEFAULT '0',
  `orderby` int(11) DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survey_polling_option`
--

INSERT INTO `survey_polling_option` (`id`, `polling_id`, `voted`, `orderby`, `publish`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 0, 2, 1),
(3, 1, 0, 3, 1),
(4, 1, 0, 4, 1),
(5, 2, 0, 1, 1),
(6, 2, 0, 2, 1),
(7, 2, 0, 3, 1),
(8, 2, 0, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `survey_polling_option_text`
--

CREATE TABLE `survey_polling_option_text` (
  `polling_option_id` int(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survey_polling_option_text`
--

INSERT INTO `survey_polling_option_text` (`polling_option_id`, `title`, `lang_id`) VALUES
(1, 'E-Commerce', 1),
(2, 'Enterprise (Web Company)', 1),
(3, 'Web Iklan', 1),
(4, 'Web Sekolahan', 1),
(5, 'God Father', 1),
(6, 'Armagedon', 1),
(7, 'Titanic', 1),
(8, 'Dendam Nyi Pelet', 1);

-- --------------------------------------------------------

--
-- Table structure for table `survey_polling_text`
--

CREATE TABLE `survey_polling_text` (
  `polling_id` int(255) NOT NULL DEFAULT '0',
  `question` text,
  `lang_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survey_polling_text`
--

INSERT INTO `survey_polling_text` (`polling_id`, `question`, `lang_id`) VALUES
(1, 'Web aplikasi jenis manakah yang menurut anda paling laku dijual untuk publik ?', 1),
(2, 'Diantara film-film di bawah, manakah menurut anda paling bagus untuk dinikmati?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `survey_posted`
--

CREATE TABLE `survey_posted` (
  `id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) NOT NULL DEFAULT '0',
  `lang_id` int(255) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `params` text,
  `question_ids` varchar(255) DEFAULT NULL,
  `question_titles` text,
  `date` datetime NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survey_posted`
--

INSERT INTO `survey_posted` (`id`, `user_id`, `lang_id`, `name`, `email`, `params`, `question_ids`, `question_titles`, `date`, `publish`) VALUES
(1, 0, 1, 'Rahma', 'rahma@fisip.net', 'a:2:{s:7:\"Address\";s:53:\"Jl.+Pedakbaru+425c+Gowok+banguntapan+Bantul+DIY+55161\";s:5:\"Phone\";s:14:\"0856+2289+4334\";}', '1,2,3,4,5', 'Perceived Ease Of Use<br />Perceived Usefulnes<br />Attitude Toward Using<br />Behavioral Intention to Use<br />Actual Usage Behavior', '0000-00-00 00:00:00', 0),
(2, 3, 1, 'Pengunjung', 'anonymous@anonymous.com', 'a:2:{s:7:\"Address\";s:9:\"Indonesia\";s:5:\"Phone\";s:15:\"+62+00+0000+000\";}', '6', 'Demografi', '2011-01-28 18:17:23', 0),
(3, 3, 1, 'Pengunjung', 'anonymous@anonymous.com', 'a:2:{s:7:\"Address\";s:9:\"Indonesia\";s:5:\"Phone\";s:15:\"+62+00+0000+000\";}', '1,2,3,4,5,6', 'Perceived Ease Of Use<br />Perceived Usefulnes<br />Attitude Toward Using<br />Behavioral Intention to Use<br />Actual Usage Behavior<br />Demografi', '2011-01-28 18:43:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `survey_posted_question`
--

CREATE TABLE `survey_posted_question` (
  `id` int(255) NOT NULL,
  `posted_id` int(255) NOT NULL DEFAULT '0',
  `question_id` int(255) NOT NULL DEFAULT '0',
  `question_title` text,
  `option_ids` varchar(255) DEFAULT NULL,
  `option_titles` text,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survey_posted_question`
--

INSERT INTO `survey_posted_question` (`id`, `posted_id`, `question_id`, `question_title`, `option_ids`, `option_titles`, `note`) VALUES
(1, 1, 1, 'Saya dengan mudah dapat mengakses situs berita online dari mana pun<br />Saya dengan mudah dapat mengakses situs berita online dengan menggunakan fasilitas/alat/gadget yang saya miliki<br />Saya dengan mudah dapat mempelajari cara menggunakan/mengakses situs berita online<br />Saya dengan mudah dapat memahami menu atau susunan rubik pada situs berita online<br />Saya dengan mudah dapat menggunakan fasilitas/fitur (contoh: layanan komentar, dll) yang ada pada situs berita online<br />Saya bisa dengan mudah mendapatkan berita yang saya cari ketika mengakses situs berita online<br />Saya dengan mudah dapat berinteraksi dengan pengelola situs berita online<br />Saya dengan mudah dapat berinteraksi dengan sesama pembaca situs berita online', '1,8,7,6,5', '1.Sangat Tidak Setuju<br />2.Tidak Setuju<br />3.Netral<br />4.Setuju<br />5.Sangat Setuju<br />4.Setuju<br />3.Netral<br />2.Tidak Setuju', ''),
(2, 1, 2, 'Penggunaan situs berita online meningkatkan efektivitas saya dalam mencari informasi atau sebuah berita dibanding media cetak, televisi atau media yang lain<br />Dengan mengakses situs berita online saya dapat dengan mudah mencari informasi atau berita yang sudah lama berlalu<br />Melalui situs berita online saya mendapatkan informasi/berita yang saya butuhkan<br />Melalui situs berita online saya mendapatkan informasi tambahan yang saya butuhkan<br />Dengan mengakses situs berita online memungkinkan saya lebih cepat dalam mendapatkan berita yang saya butuhkan<br />Dengan mengakses situs berita online memungkinkan saya lebih mudah dalam mendapatkan berita yang saya butuhkan<br />Saya menghemat waktu dalam mencari sebuah informasi/berita jika melalui situs berita online<br />Saya menghemat biaya dalam mencari sebuah informasi/berita jika melalui situs berita online', '16,14,13,12,15', '5.Sangat Setuju<br />4.Setuju<br />3.Netral<br />2.Tidak Setuju<br />3.Netral<br />4.Setuju<br />1.Sangat Tidak Setuju<br />5.Sangat Setuju', ''),
(3, 1, 3, 'Saya senang mengakses situs berita online karena tak perlu berlangganan media cetak<br />Saya senang mengakses situs berita online karena tidak perlu memberikan data pribadi<br />Saya senang mengakses situs berita online karena saya dapat mengomentari berita yang saya baca<br />Saya tidak suka situs berita online yang beritanya jarang/tidak diperbaharui (update)<br />Saya tidak suka situs berita online yang penyajian beritanya terlalu formal atau menggunakan bahasa yang terlalu baku<br />Saya bosan dengan tampilan (interface) situs berita online yang saya kunjungi<br />Saya lebih suka situs berita online yang dilengkapi dengan foto/ilustrasi/grafik', '17,23,22,20,21', '1.Sangat Tidak Setuju<br />5.Sangat Setuju<br />2.Tidak Setuju<br />4.Setuju<br />3.Netral<br />2.Tidak Setuju<br />5.Sangat Setuju', ''),
(4, 1, 4, 'Saya lebih suka situs berita online yang memperbolehkan saya untuk berkomentar<br />Saya lebih suka situs berita online yang memperbolehkan saya untuk berkontribusi menyumbangkan berita<br />Sekalipun saya telah membaca media cetaknya, saya akan tetap mengakses situs berita secara online untuk mendapatkan informasi/berita yang saya butuhkan<br />Saya akan mengakses situs berita online jika ingin mengetahui berita terbaru mengenai suatu hal<br />Saya akan menyarankan/mengajak teman saya untuk mengakses situs berita online<br />Saya akan mengajak teman untuk berinteraksi/berdiskusi mengenai sebuah berita/informasi melalui fasilitas comment yang ada di situs berita online', '28,25,26,27,29', '5.Sangat Setuju<br />2.Tidak Setuju<br />4.Setuju<br />1.Sangat Tidak Setuju<br />5.Sangat Setuju<br />3.Netral', ''),
(5, 1, 5, 'Saya mengakses situs berita online setiap saya terkoneksi dengan internet<br />Saya akan mengakses situs berita online ketika ada peristiwa yang menarik atau yang sedang tren di masyarakat<br />Saya mengakses situs berita online hampir setiap hari<br />Rata-rata, saya mengakses situs berita online selama minimal 10 menit setiap kali mengunjunginya<br />Secara keseluruhan saya merasa puas dengan kinerja situs berita online<br />Saya menyampaikan kepuasan terhadap sebuah situs berita online, kepada teman saya', '32,31,33,34,35', '1.Sangat Tidak Setuju<br />4.Setuju<br />1.Sangat Tidak Setuju<br />2.Tidak Setuju<br />5.Sangat Setuju<br />3.Netral', ''),
(6, 3, 1, 'Saya dengan mudah dapat mengakses situs berita online dari mana pun<br />Saya dengan mudah dapat mengakses situs berita online dengan menggunakan fasilitas/alat/gadget yang saya miliki<br />Saya dengan mudah dapat mempelajari cara menggunakan/mengakses situs berita online<br />Saya dengan mudah dapat memahami menu atau susunan rubik pada situs berita online<br />Saya dengan mudah dapat menggunakan fasilitas/fitur (contoh: layanan komentar, dll) yang ada pada situs berita online<br />Saya bisa dengan mudah mendapatkan berita yang saya cari ketika mengakses situs berita online<br />Saya dengan mudah dapat berinteraksi dengan pengelola situs berita online<br />Saya dengan mudah dapat berinteraksi dengan sesama pembaca situs berita online', '7,6,5,4,8', '4.Setuju<br />3.Netral<br />2.Tidak Setuju<br />1.Sangat Tidak Setuju<br />2.Tidak Setuju<br />3.Netral<br />4.Setuju<br />5.Sangat Setuju', ''),
(7, 3, 2, 'Penggunaan situs berita online meningkatkan efektivitas saya dalam mencari informasi atau sebuah berita dibanding media cetak, televisi atau media yang lain<br />Dengan mengakses situs berita online saya dapat dengan mudah mencari informasi atau berita yang sudah lama berlalu<br />Melalui situs berita online saya mendapatkan informasi/berita yang saya butuhkan<br />Melalui situs berita online saya mendapatkan informasi tambahan yang saya butuhkan<br />Dengan mengakses situs berita online memungkinkan saya lebih cepat dalam mendapatkan berita yang saya butuhkan<br />Dengan mengakses situs berita online memungkinkan saya lebih mudah dalam mendapatkan berita yang saya butuhkan<br />Saya menghemat waktu dalam mencari sebuah informasi/berita jika melalui situs berita online<br />Saya menghemat biaya dalam mencari sebuah informasi/berita jika melalui situs berita online', '15,14,13,12,16', '4.Setuju<br />3.Netral<br />2.Tidak Setuju<br />1.Sangat Tidak Setuju<br />2.Tidak Setuju<br />3.Netral<br />4.Setuju<br />5.Sangat Setuju', ''),
(8, 3, 3, 'Saya senang mengakses situs berita online karena tak perlu berlangganan media cetak<br />Saya senang mengakses situs berita online karena tidak perlu memberikan data pribadi<br />Saya senang mengakses situs berita online karena saya dapat mengomentari berita yang saya baca<br />Saya tidak suka situs berita online yang beritanya jarang/tidak diperbaharui (update)<br />Saya tidak suka situs berita online yang penyajian beritanya terlalu formal atau menggunakan bahasa yang terlalu baku<br />Saya bosan dengan tampilan (interface) situs berita online yang saya kunjungi<br />Saya lebih suka situs berita online yang dilengkapi dengan foto/ilustrasi/grafik', '23,22,21,20', '4.Setuju<br />3.Netral<br />2.Tidak Setuju<br />1.Sangat Tidak Setuju<br />2.Tidak Setuju<br />3.Netral<br />4.Setuju', ''),
(9, 3, 4, 'Saya lebih suka situs berita online yang memperbolehkan saya untuk berkomentar<br />Saya lebih suka situs berita online yang memperbolehkan saya untuk berkontribusi menyumbangkan berita<br />Sekalipun saya telah membaca media cetaknya, saya akan tetap mengakses situs berita secara online untuk mendapatkan informasi/berita yang saya butuhkan<br />Saya akan mengakses situs berita online jika ingin mengetahui berita terbaru mengenai suatu hal<br />Saya akan menyarankan/mengajak teman saya untuk mengakses situs berita online<br />Saya akan mengajak teman untuk berinteraksi/berdiskusi mengenai sebuah berita/informasi melalui fasilitas comment yang ada di situs berita online', '24,25,26,29,28', '5.Sangat Setuju<br />4.Setuju<br />3.Netral<br />2.Tidak Setuju<br />1.Sangat Tidak Setuju<br />2.Tidak Setuju', ''),
(10, 3, 5, 'Saya mengakses situs berita online setiap saya terkoneksi dengan internet<br />Saya akan mengakses situs berita online ketika ada peristiwa yang menarik atau yang sedang tren di masyarakat<br />Saya mengakses situs berita online hampir setiap hari<br />Rata-rata, saya mengakses situs berita online selama minimal 10 menit setiap kali mengunjunginya<br />Secara keseluruhan saya merasa puas dengan kinerja situs berita online<br />Saya menyampaikan kepuasan terhadap sebuah situs berita online, kepada teman saya', '34,33,32,35', '3.Netral<br />4.Setuju<br />5.Sangat Setuju<br />4.Setuju<br />3.Netral<br />2.Tidak Setuju', ''),
(11, 3, 6, 'Tahun lahir', '1', '2423', ''),
(12, 3, 6, 'Jenis kelamin', '2', 'Perempuan', ''),
(13, 3, 6, 'Asal kota', '3', 'kudus', ''),
(14, 3, 6, 'Status', '4', 'Menikah', ''),
(15, 3, 6, 'Pendidikan terakhir', '5', 'Sarjana S1', ''),
(16, 3, 6, 'Pekerjaan', '6', 'Mahasiswa D3/S1', ''),
(17, 3, 6, 'Pengeluaran per bulan', '7', '234', ''),
(18, 3, 6, 'Berapa uang saku', '8', '234', ''),
(19, 3, 6, 'Mengakses situs berita online pertama kali (tahun)', '9', '3423', ''),
(20, 3, 6, 'Tempat mengakses situs berita online tersering', '10', 'Kampus', ''),
(21, 3, 6, 'Selain tempat tersebut pada nomor 10. dimana lagi?', '11', 'Warung Internet, Rumah, Kos', ''),
(22, 3, 6, 'Rata-rata, berapa jam dalam seminggu Anda mengakses situs berita online', '12', '23', ''),
(23, 3, 6, 'Rata-rata, berapa berita yang Anda baca setiap membuka sebuah situs berita online', '13', '12', ''),
(24, 3, 6, 'Rata-rata, berapa lama Anda membaca satu berita di sebuah situs berita online', '14', '231', ''),
(25, 3, 6, 'Rata-rata, selama mengakses situs berita online, jika dihitung dengan uang, berapa banyak uang yang harus Anda keluarkan untuk akses situs berita online dalam satu bulan?', '15', '12324324', ''),
(26, 3, 6, 'Walaupun Anda mengakses situs berita online, apakah Anda tetap berlangganan koran, majalah, tabloid, dll, tetap menonton televisi, dan mendengarkan radio untuk mendapatkan sebuah berita/informasi?', '16', 'Ya, alasanya dsfsdfsdg ', ''),
(27, 3, 6, 'Selama mengakses situs berita online, tema rubrik/berita apa yang paling sering Anda baca ?', '17', 'terkait dengan pendidikan, terkait dengan politik, terkait dengan ekonomi/bisnis, hiburan/hobi (musik, film, fotografi), terkait dengan kuliner, sdgfdg', ''),
(28, 3, 6, 'Sebutkan 3 rubrik atau tema berita yang paling sering Anda baca (urutkan dari yang paling sering, contoh: politik, kuliner dsb.)', '18', 'dfgdfgdf, dfgfhgf, fghfdghf', ''),
(29, 3, 6, 'Sebutkan 5 situs berita (media massa) online yang paling sering Anda kunjungi, urutkan dari yang paling sering, tidak harus berbahasa Indonesia', '19', 'fdgdsfgdg, dfgdf, dfgdfg, gdfgdf, gdfgdf', ''),
(30, 3, 6, 'Alasan mengapa Anda mengakses situs tersebut', '20', '1. Beritanya selalu ada yang baru (update)<br />2. Beritanya dapat dipercaya, tidak memihak, dan komprehensif <br />3. Beritanya memenuhi unsur 5W+1H (What, Why, When, Where, Who, How)<br />4. Lembaga/pengelola situsnya kredibel<br />5. Beritanya mudah/enak dibaca<br />6. Bahasa yang digunakan mudah/enak dibaca<br />7. Situsnya mudah diakses<br />8. Nama atau alamat situs (URL)-nya mudah diingat<br />9. Tata letak atau desain situsnya tidak membosankan<br />10. Akses ke situs tersebut cepat dibanding situs lainnya<br />11. Beritanya selalu dilengkapi dengan foto/gambar/ilustrasi<br />12. Berita dan rubriknya lengkap<br />13. Penulisan judul beritanya menarik saya untuk membaca beritanya secara lengkap<br />14. sdfsdf<br />15. sdfsdfdgts<br />16. yjfghjfhgjgh', ''),
(31, 3, 6, 'Alat atau gadget yang paling sering Anda gunakan untuk akses situs tersebut', '21', '1. Komputer Personal (dengan CPU)<br />2. Laptop (notebook)<br />3. Laptop (netbook)<br />4. Blackberry<br />5. Handphone (dengan fasilitas GPRS, 3G, dll)<br />6. gfehfgjhg<br />7. fgjfjhghjg', '');

-- --------------------------------------------------------

--
-- Table structure for table `survey_question`
--

CREATE TABLE `survey_question` (
  `id` int(255) NOT NULL,
  `par_id` int(255) DEFAULT '0',
  `type` enum('checkbox','multiple','radio','select','text','none','custom') NOT NULL DEFAULT 'checkbox',
  `file` varchar(255) DEFAULT NULL,
  `voted` int(255) DEFAULT '0',
  `orderby` int(255) DEFAULT '0',
  `is_note` tinyint(1) NOT NULL DEFAULT '1',
  `checked` tinyint(1) NOT NULL DEFAULT '0',
  `publish` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survey_question`
--

INSERT INTO `survey_question` (`id`, `par_id`, `type`, `file`, `voted`, `orderby`, `is_note`, `checked`, `publish`) VALUES
(1, 0, 'custom', 'questionary', 2, 1, 0, 1, 1),
(2, 0, 'custom', 'questionary', 2, 2, 0, 1, 1),
(3, 0, 'custom', 'questionary', 2, 3, 0, 1, 1),
(4, 0, 'custom', 'questionary', 2, 4, 0, 1, 1),
(5, 0, 'custom', 'questionary', 2, 5, 0, 1, 1),
(6, 0, 'custom', 'demografi', 2, 6, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `survey_questionary`
--

CREATE TABLE `survey_questionary` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `orderby` int(11) DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survey_questionary`
--

INSERT INTO `survey_questionary` (`id`, `question_id`, `title`, `orderby`, `publish`) VALUES
(1, 1, 'Saya dengan mudah dapat mengakses situs berita online dari mana pun', 1, 1),
(2, 1, 'Saya dengan mudah dapat mengakses situs berita online dengan menggunakan fasilitas/alat/gadget yang saya miliki', 2, 1),
(3, 1, 'Saya dengan mudah dapat mempelajari cara menggunakan/mengakses situs berita online', 3, 1),
(4, 1, 'Saya dengan mudah dapat memahami menu atau susunan rubik pada situs berita online', 4, 1),
(5, 1, 'Saya dengan mudah dapat menggunakan fasilitas/fitur (contoh: layanan komentar, dll) yang ada pada situs berita online', 5, 1),
(6, 1, 'Saya bisa dengan mudah mendapatkan berita yang saya cari ketika mengakses situs berita online', 6, 1),
(7, 1, 'Saya dengan mudah dapat berinteraksi dengan pengelola situs berita online', 7, 1),
(8, 1, 'Saya dengan mudah dapat berinteraksi dengan sesama pembaca situs berita online', 8, 1),
(9, 2, 'Penggunaan situs berita online meningkatkan efektivitas saya dalam mencari informasi atau sebuah berita dibanding media cetak, televisi atau media yang lain', 1, 1),
(10, 2, 'Dengan mengakses situs berita online saya dapat dengan mudah mencari informasi atau berita yang sudah lama berlalu', 2, 1),
(11, 2, 'Melalui situs berita online saya mendapatkan informasi/berita yang saya butuhkan', 3, 1),
(12, 2, 'Melalui situs berita online saya mendapatkan informasi tambahan yang saya butuhkan', 4, 1),
(13, 2, 'Dengan mengakses situs berita online memungkinkan saya lebih cepat dalam mendapatkan berita yang saya butuhkan', 5, 1),
(14, 2, 'Dengan mengakses situs berita online memungkinkan saya lebih mudah dalam mendapatkan berita yang saya butuhkan', 6, 1),
(15, 2, 'Saya menghemat waktu dalam mencari sebuah informasi/berita jika melalui situs berita online', 7, 1),
(16, 2, 'Saya menghemat biaya dalam mencari sebuah informasi/berita jika melalui situs berita online', 8, 1),
(17, 3, 'Saya senang mengakses situs berita online karena tak perlu berlangganan media cetak', 1, 1),
(18, 3, 'Saya senang mengakses situs berita online karena tidak perlu memberikan data pribadi', 2, 1),
(19, 3, 'Saya senang mengakses situs berita online karena saya dapat mengomentari berita yang saya baca', 3, 1),
(20, 3, 'Saya tidak suka situs berita online yang beritanya jarang/tidak diperbaharui (update)', 4, 1),
(21, 3, 'Saya tidak suka situs berita online yang penyajian beritanya terlalu formal atau menggunakan bahasa yang terlalu baku', 5, 1),
(22, 3, 'Saya bosan dengan tampilan (interface) situs berita online yang saya kunjungi', 6, 1),
(23, 3, 'Saya lebih suka situs berita online yang dilengkapi dengan foto/ilustrasi/grafik', 7, 1),
(24, 4, 'Saya lebih suka situs berita online yang memperbolehkan saya untuk berkomentar', 1, 1),
(25, 4, 'Saya lebih suka situs berita online yang memperbolehkan saya untuk berkontribusi menyumbangkan berita', 2, 1),
(26, 4, 'Sekalipun saya telah membaca media cetaknya, saya akan tetap mengakses situs berita secara online untuk mendapatkan informasi/berita yang saya butuhkan', 3, 1),
(27, 4, 'Saya akan mengakses situs berita online jika ingin mengetahui berita terbaru mengenai suatu hal', 4, 1),
(28, 4, 'Saya akan menyarankan/mengajak teman saya untuk mengakses situs berita online', 5, 1),
(29, 4, 'Saya akan mengajak teman untuk berinteraksi/berdiskusi mengenai sebuah berita/informasi melalui fasilitas comment yang ada di situs berita online', 6, 1),
(30, 5, 'Saya mengakses situs berita online setiap saya terkoneksi dengan internet', 1, 1),
(31, 5, 'Saya akan mengakses situs berita online ketika ada peristiwa yang menarik atau yang sedang tren di masyarakat', 2, 1),
(32, 5, 'Saya mengakses situs berita online hampir setiap hari', 3, 1),
(33, 5, 'Rata-rata, saya mengakses situs berita online selama minimal 10 menit setiap kali mengunjunginya', 4, 1),
(34, 5, 'Secara keseluruhan saya merasa puas dengan kinerja situs berita online', 5, 1),
(35, 5, 'Saya menyampaikan kepuasan terhadap sebuah situs berita online, kepada teman saya', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `survey_question_option`
--

CREATE TABLE `survey_question_option` (
  `id` int(255) NOT NULL,
  `question_id` int(255) NOT NULL DEFAULT '0',
  `voted` int(255) UNSIGNED NOT NULL DEFAULT '0',
  `orderby` int(255) DEFAULT '0',
  `checked` tinyint(1) NOT NULL DEFAULT '0',
  `publish` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `survey_question_option_text`
--

CREATE TABLE `survey_question_option_text` (
  `option_id` int(255) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `lang_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `survey_question_text`
--

CREATE TABLE `survey_question_text` (
  `question_id` int(255) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `lang_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `survey_question_text`
--

INSERT INTO `survey_question_text` (`question_id`, `title`, `description`, `lang_id`) VALUES
(1, 'Perceived Ease Of Use', '', 1),
(2, 'Perceived Usefulnes', '', 1),
(3, 'Attitude Toward Using', '', 1),
(4, 'Behavioral Intention to Use', '', 1),
(5, 'Actual Usage Behavior', '', 1),
(6, 'Demografi', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `params` text,
  `message` text,
  `date` datetime DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id`, `name`, `email`, `params`, `message`, `date`, `publish`) VALUES
(1, 'Danang Widiantoro', 'comment@fisip.net', 'a:2:{s:7:\"Company\";s:9:\"Fisip.Net\";s:7:\"Address\";s:35:\"Gowok Banguntapan Bantul Yogyakarta\";}', 'It is easy to navigate this site because all of the links are right there on the left hand side, and people without image-loading browsers can access the links via the text at the bottom which is very handy and essential for a good site. It is a good idea having a shopping cart section right in the middle of the screen because it is obvious, and all important information can be accessed by the reader easily.', '2012-04-22 03:00:40', 1),
(2, 'Malaquina Aurelia Widiantoro', 'daloralove@yahoo.com', 'a:2:{s:7:\"Company\";s:17:\"www.bagikisah.com\";s:7:\"Address\";s:13:\"Denpasar Bali\";}', 'This site definitely appeals to the average person because the layout is so simple but very effective. It is a clean site with a flawless look, and someone without any technical background would definitely appreciate it. The layout makes anyone feel comfortable because it is so well done and clean looking. We feel as if we are in good hands and we know that we will be able to find anything we need on this site. Well done....', '2012-04-22 03:08:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `testimonial_field`
--

CREATE TABLE `testimonial_field` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `checked` enum('any','email','url','phone','number') DEFAULT 'any',
  `title` varchar(255) NOT NULL,
  `tips` varchar(255) NOT NULL,
  `attr` varchar(255) NOT NULL,
  `default` text NOT NULL,
  `option` text NOT NULL,
  `orderby` int(255) NOT NULL DEFAULT '1',
  `mandatory` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testimonial_field`
--

INSERT INTO `testimonial_field` (`id`, `type`, `checked`, `title`, `tips`, `attr`, `default`, `option`, `orderby`, `mandatory`, `active`) VALUES
(1, 'textarea', 'any', 'Address', '', 'rows=3 cols=34', '', '', 2, 0, 1),
(2, 'text', 'any', 'Company', '', 'size=34', '', '', 1, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`) USING BTREE,
  ADD KEY `publish` (`publish`) USING BTREE;
ALTER TABLE `agenda` ADD FULLTEXT KEY `start_date` (`start_date`,`end_date`);

--
-- Indexes for table `bbc_account`
--
ALTER TABLE `bbc_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `email` (`email`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;
ALTER TABLE `bbc_account` ADD FULLTEXT KEY `name` (`username`,`name`,`email`,`params`);

--
-- Indexes for table `bbc_account_temp`
--
ALTER TABLE `bbc_account_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`) USING BTREE;
ALTER TABLE `bbc_account_temp` ADD FULLTEXT KEY `code_2` (`code`,`username`,`name`,`email`,`params`);

--
-- Indexes for table `bbc_alert`
--
ALTER TABLE `bbc_alert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created` (`created`) USING BTREE,
  ADD KEY `group_id` (`group_id`) USING BTREE,
  ADD KEY `is_admin` (`is_admin`) USING BTREE,
  ADD KEY `is_open` (`is_open`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `bbc_async`
--
ALTER TABLE `bbc_async`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bbc_block`
--
ALTER TABLE `bbc_block`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`) USING BTREE,
  ADD KEY `template_id` (`template_id`) USING BTREE;

--
-- Indexes for table `bbc_block_position`
--
ALTER TABLE `bbc_block_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bbc_block_ref`
--
ALTER TABLE `bbc_block_ref`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `bbc_block_text`
--
ALTER TABLE `bbc_block_text`
  ADD KEY `block_id` (`block_id`) USING BTREE,
  ADD KEY `lang_id` (`lang_id`) USING BTREE;

--
-- Indexes for table `bbc_block_theme`
--
ALTER TABLE `bbc_block_theme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`) USING BTREE,
  ADD KEY `template_id` (`template_id`) USING BTREE;
ALTER TABLE `bbc_block_theme` ADD FULLTEXT KEY `name` (`name`,`content`);

--
-- Indexes for table `bbc_config`
--
ALTER TABLE `bbc_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`) USING BTREE,
  ADD KEY `name` (`name`) USING BTREE;

--
-- Indexes for table `bbc_content`
--
ALTER TABLE `bbc_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`) USING BTREE,
  ADD KEY `is_front` (`is_front`) USING BTREE,
  ADD KEY `kind_id` (`kind_id`) USING BTREE,
  ADD KEY `par_id` (`par_id`) USING BTREE,
  ADD KEY `publish` (`publish`) USING BTREE,
  ADD KEY `type_id` (`type_id`) USING BTREE;
ALTER TABLE `bbc_content` ADD FULLTEXT KEY `title` (`caption`,`created_by_alias`);

--
-- Indexes for table `bbc_content_ad`
--
ALTER TABLE `bbc_content_ad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`) USING BTREE,
  ADD KEY `cat_id` (`cat_id`) USING BTREE,
  ADD KEY `expire` (`expire`) USING BTREE,
  ADD KEY `expire_time` (`expire_date`) USING BTREE,
  ADD KEY `hit` (`hit`) USING BTREE;

--
-- Indexes for table `bbc_content_cat`
--
ALTER TABLE `bbc_content_cat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publish` (`publish`) USING BTREE,
  ADD KEY `type_id` (`type_id`) USING BTREE;

--
-- Indexes for table `bbc_content_category`
--
ALTER TABLE `bbc_content_category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `active` (`active`) USING BTREE,
  ADD KEY `cat_id` (`cat_id`) USING BTREE,
  ADD KEY `content_id` (`content_id`) USING BTREE,
  ADD KEY `pruned` (`pruned`) USING BTREE;

--
-- Indexes for table `bbc_content_cat_text`
--
ALTER TABLE `bbc_content_cat_text`
  ADD KEY `cat_id` (`cat_id`) USING BTREE,
  ADD KEY `lang_id` (`lang_id`) USING BTREE;
ALTER TABLE `bbc_content_cat_text` ADD FULLTEXT KEY `title` (`title`,`description`,`keyword`);

--
-- Indexes for table `bbc_content_comment`
--
ALTER TABLE `bbc_content_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_id` (`content_id`) USING BTREE,
  ADD KEY `par_id` (`par_id`) USING BTREE,
  ADD KEY `publish` (`publish`) USING BTREE,
  ADD KEY `reply_all` (`reply_all`) USING BTREE,
  ADD KEY `reply_on` (`reply_on`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;
ALTER TABLE `bbc_content_comment` ADD FULLTEXT KEY `title` (`content_title`,`name`,`email`,`website`,`content`);

--
-- Indexes for table `bbc_content_registrant`
--
ALTER TABLE `bbc_content_registrant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_id` (`content_id`) USING BTREE,
  ADD KEY `email` (`email`) USING BTREE;

--
-- Indexes for table `bbc_content_related`
--
ALTER TABLE `bbc_content_related`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_id` (`content_id`) USING BTREE;

--
-- Indexes for table `bbc_content_schedule`
--
ALTER TABLE `bbc_content_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_time` (`action_time`) USING BTREE,
  ADD KEY `content_id` (`content_id`) USING BTREE;

--
-- Indexes for table `bbc_content_tag`
--
ALTER TABLE `bbc_content_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bbc_content_tag_list`
--
ALTER TABLE `bbc_content_tag_list`
  ADD KEY `content_id` (`content_id`) USING BTREE,
  ADD KEY `tag_id` (`tag_id`) USING BTREE;

--
-- Indexes for table `bbc_content_text`
--
ALTER TABLE `bbc_content_text`
  ADD KEY `content_id` (`content_id`) USING BTREE,
  ADD KEY `lang_id` (`lang_id`) USING BTREE;
ALTER TABLE `bbc_content_text` ADD FULLTEXT KEY `title` (`title`,`description`,`keyword`,`tags`,`intro`,`content`);

--
-- Indexes for table `bbc_content_trash`
--
ALTER TABLE `bbc_content_trash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restore` (`restore`) USING BTREE;
ALTER TABLE `bbc_content_trash` ADD FULLTEXT KEY `title` (`title`,`image`,`params`);

--
-- Indexes for table `bbc_content_type`
--
ALTER TABLE `bbc_content_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`) USING BTREE,
  ADD KEY `menu_id` (`menu_id`) USING BTREE;

--
-- Indexes for table `bbc_cpanel`
--
ALTER TABLE `bbc_cpanel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`) USING BTREE,
  ADD KEY `is_shortcut` (`is_shortcut`) USING BTREE;

--
-- Indexes for table `bbc_email`
--
ALTER TABLE `bbc_email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`) USING BTREE,
  ADD KEY `name_2` (`name`) USING BTREE;
ALTER TABLE `bbc_email` ADD FULLTEXT KEY `name` (`name`,`from_email`,`from_name`,`description`);

--
-- Indexes for table `bbc_email_text`
--
ALTER TABLE `bbc_email_text`
  ADD KEY `email_id` (`email_id`) USING BTREE,
  ADD KEY `lang_id` (`lang_id`) USING BTREE;
ALTER TABLE `bbc_email_text` ADD FULLTEXT KEY `subject` (`subject`,`content`);

--
-- Indexes for table `bbc_lang`
--
ALTER TABLE `bbc_lang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bbc_lang_code`
--
ALTER TABLE `bbc_lang_code`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`) USING BTREE;

--
-- Indexes for table `bbc_lang_text`
--
ALTER TABLE `bbc_lang_text`
  ADD PRIMARY KEY (`text_id`),
  ADD KEY `code_id` (`code_id`) USING BTREE,
  ADD KEY `lang_id` (`lang_id`) USING BTREE;

--
-- Indexes for table `bbc_log`
--
ALTER TABLE `bbc_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `datetime` (`datetime`) USING BTREE,
  ADD KEY `name` (`name`) USING BTREE;

--
-- Indexes for table `bbc_menu`
--
ALTER TABLE `bbc_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`) USING BTREE,
  ADD KEY `content_cat_id` (`content_cat_id`) USING BTREE,
  ADD KEY `content_id` (`content_id`) USING BTREE,
  ADD KEY `is_admin` (`is_admin`) USING BTREE,
  ADD KEY `is_content` (`is_content`) USING BTREE,
  ADD KEY `is_content_cat` (`is_content_cat`) USING BTREE,
  ADD KEY `is_shortcut` (`is_shortcut`) USING BTREE,
  ADD KEY `link` (`link`) USING BTREE,
  ADD KEY `module_id` (`module_id`) USING BTREE,
  ADD KEY `seo` (`seo`) USING BTREE;

--
-- Indexes for table `bbc_menu_cat`
--
ALTER TABLE `bbc_menu_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bbc_menu_text`
--
ALTER TABLE `bbc_menu_text`
  ADD KEY `menu_id` (`menu_id`,`lang_id`) USING BTREE;

--
-- Indexes for table `bbc_module`
--
ALTER TABLE `bbc_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_func_post` (`account_func_post`) USING BTREE,
  ADD KEY `account_func_pre` (`account_func_pre`) USING BTREE,
  ADD KEY `active` (`active`) USING BTREE,
  ADD KEY `is_config` (`is_config`) USING BTREE,
  ADD KEY `order_func_post` (`order_func_post`) USING BTREE,
  ADD KEY `order_func_pre` (`order_func_pre`) USING BTREE,
  ADD KEY `search_func` (`search_func`) USING BTREE;
ALTER TABLE `bbc_module` ADD FULLTEXT KEY `name` (`name`,`site_title`,`site_desc`,`site_keyword`,`allow_group`,`order_func_pre`,`order_func_post`,`account_func_pre`,`account_func_post`);

--
-- Indexes for table `bbc_template`
--
ALTER TABLE `bbc_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`) USING BTREE;

--
-- Indexes for table `bbc_user`
--
ALTER TABLE `bbc_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `active` (`active`) USING BTREE,
  ADD KEY `exp_checked` (`exp_checked`) USING BTREE,
  ADD KEY `group_ids` (`group_ids`) USING BTREE;

--
-- Indexes for table `bbc_user_field`
--
ALTER TABLE `bbc_user_field`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`) USING BTREE;

--
-- Indexes for table `bbc_user_group`
--
ALTER TABLE `bbc_user_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `is_admin` (`is_admin`) USING BTREE;

--
-- Indexes for table `bbc_user_push`
--
ALTER TABLE `bbc_user_push`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_ids` (`group_ids`) USING BTREE,
  ADD KEY `os` (`os`) USING BTREE,
  ADD KEY `type` (`type`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `bbc_user_push_notif`
--
ALTER TABLE `bbc_user_push_notif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `followed` (`followed`) USING BTREE;
ALTER TABLE `contact` ADD FULLTEXT KEY `name` (`name`,`email`,`params`,`message`,`answer`);

--
-- Indexes for table `contact_field`
--
ALTER TABLE `contact_field`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`) USING BTREE;

--
-- Indexes for table `contact_messenger`
--
ALTER TABLE `contact_messenger`
  ADD PRIMARY KEY (`id`),
  ADD KEY `online` (`online`) USING BTREE,
  ADD KEY `publish` (`publish`) USING BTREE;

--
-- Indexes for table `guestbook`
--
ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publish` (`publish`) USING BTREE;
ALTER TABLE `guestbook` ADD FULLTEXT KEY `name` (`name`,`email`,`params`,`message`);

--
-- Indexes for table `guestbook_field`
--
ALTER TABLE `guestbook_field`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`) USING BTREE;

--
-- Indexes for table `imageslider`
--
ALTER TABLE `imageslider`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`) USING BTREE,
  ADD KEY `publish` (`publish`) USING BTREE;
ALTER TABLE `imageslider` ADD FULLTEXT KEY `image` (`image`,`link`);

--
-- Indexes for table `imageslider_cat`
--
ALTER TABLE `imageslider_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imageslider_text`
--
ALTER TABLE `imageslider_text`
  ADD KEY `imageslider_id` (`imageslider_id`,`lang_id`) USING BTREE;

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publish` (`publish`) USING BTREE;

--
-- Indexes for table `links_ad`
--
ALTER TABLE `links_ad`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `publish` (`publish`) USING BTREE;

--
-- Indexes for table `links_share`
--
ALTER TABLE `links_share`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publish` (`publish`) USING BTREE,
  ADD KEY `total` (`total`) USING BTREE;

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `member_device`
--
ALTER TABLE `member_device`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `installation_id` (`installation_id`),
  ADD KEY `key` (`key`) USING BTREE,
  ADD KEY `member_id` (`member_id`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_attendance`
--
ALTER TABLE `school_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_schedule` (`schedule_id`) USING BTREE,
  ADD KEY `attendance_student` (`student_id`) USING BTREE;

--
-- Indexes for table `school_attendance_report`
--
ALTER TABLE `school_attendance_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`) USING BTREE,
  ADD KEY `schedule_id` (`schedule_id`) USING BTREE;

--
-- Indexes for table `school_class`
--
ALTER TABLE `school_class`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `school_clock`
--
ALTER TABLE `school_clock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_course`
--
ALTER TABLE `school_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_parent`
--
ALTER TABLE `school_parent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `school_schedule`
--
ALTER TABLE `school_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `day` (`day`) USING BTREE,
  ADD KEY `schedule_subject` (`subject_id`) USING BTREE;

--
-- Indexes for table `school_score`
--
ALTER TABLE `school_score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `school_score_cat`
--
ALTER TABLE `school_score_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_student`
--
ALTER TABLE `school_student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- Indexes for table `school_student_class`
--
ALTER TABLE `school_student_class`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_student` (`student_id`),
  ADD KEY `class_class` (`class_id`) USING BTREE;

--
-- Indexes for table `school_student_parent`
--
ALTER TABLE `school_student_parent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_parent_parent` (`parent_id`) USING BTREE,
  ADD KEY `student_parent_student` (`student_id`) USING BTREE;

--
-- Indexes for table `school_teacher`
--
ALTER TABLE `school_teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `school_teacher_subject`
--
ALTER TABLE `school_teacher_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_class` (`class_id`) USING BTREE,
  ADD KEY `subject_course` (`course_id`) USING BTREE,
  ADD KEY `subject_teacher` (`teacher_id`) USING BTREE;

--
-- Indexes for table `survey_polling`
--
ALTER TABLE `survey_polling`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publish` (`publish`) USING BTREE;

--
-- Indexes for table `survey_polling_option`
--
ALTER TABLE `survey_polling_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `polling_id` (`polling_id`) USING BTREE,
  ADD KEY `publish` (`publish`) USING BTREE;

--
-- Indexes for table `survey_polling_option_text`
--
ALTER TABLE `survey_polling_option_text`
  ADD KEY `lang_id` (`lang_id`) USING BTREE,
  ADD KEY `polling_option_id` (`polling_option_id`) USING BTREE;
ALTER TABLE `survey_polling_option_text` ADD FULLTEXT KEY `title` (`title`);

--
-- Indexes for table `survey_polling_text`
--
ALTER TABLE `survey_polling_text`
  ADD KEY `lang_id` (`lang_id`) USING BTREE,
  ADD KEY `polling_id` (`polling_id`) USING BTREE;
ALTER TABLE `survey_polling_text` ADD FULLTEXT KEY `question` (`question`);

--
-- Indexes for table `survey_posted`
--
ALTER TABLE `survey_posted`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`user_id`) USING BTREE,
  ADD KEY `lang_id` (`lang_id`) USING BTREE,
  ADD KEY `publish` (`publish`) USING BTREE;
ALTER TABLE `survey_posted` ADD FULLTEXT KEY `name` (`name`,`email`,`params`,`question_titles`);

--
-- Indexes for table `survey_posted_question`
--
ALTER TABLE `survey_posted_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posted_id` (`posted_id`) USING BTREE,
  ADD KEY `question_id` (`question_id`) USING BTREE;

--
-- Indexes for table `survey_question`
--
ALTER TABLE `survey_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publish` (`publish`) USING BTREE;

--
-- Indexes for table `survey_questionary`
--
ALTER TABLE `survey_questionary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publish` (`publish`) USING BTREE,
  ADD KEY `question_id` (`question_id`) USING BTREE;

--
-- Indexes for table `survey_question_option`
--
ALTER TABLE `survey_question_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publish` (`publish`) USING BTREE,
  ADD KEY `question_id` (`question_id`) USING BTREE;

--
-- Indexes for table `survey_question_option_text`
--
ALTER TABLE `survey_question_option_text`
  ADD KEY `lang_id` (`lang_id`) USING BTREE,
  ADD KEY `option_id` (`option_id`) USING BTREE;
ALTER TABLE `survey_question_option_text` ADD FULLTEXT KEY `title` (`title`);

--
-- Indexes for table `survey_question_text`
--
ALTER TABLE `survey_question_text`
  ADD KEY `lang_id` (`lang_id`) USING BTREE,
  ADD KEY `question_id` (`question_id`) USING BTREE;
ALTER TABLE `survey_question_text` ADD FULLTEXT KEY `title` (`title`,`description`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publish` (`publish`) USING BTREE;
ALTER TABLE `testimonial` ADD FULLTEXT KEY `name` (`name`,`email`,`params`,`message`);

--
-- Indexes for table `testimonial_field`
--
ALTER TABLE `testimonial_field`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bbc_account`
--
ALTER TABLE `bbc_account`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bbc_account_temp`
--
ALTER TABLE `bbc_account_temp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bbc_alert`
--
ALTER TABLE `bbc_alert`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bbc_async`
--
ALTER TABLE `bbc_async`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5088;

--
-- AUTO_INCREMENT for table `bbc_block`
--
ALTER TABLE `bbc_block`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `bbc_block_position`
--
ALTER TABLE `bbc_block_position`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `bbc_block_ref`
--
ALTER TABLE `bbc_block_ref`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `bbc_block_theme`
--
ALTER TABLE `bbc_block_theme`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `bbc_config`
--
ALTER TABLE `bbc_config`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `bbc_content`
--
ALTER TABLE `bbc_content`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `bbc_content_ad`
--
ALTER TABLE `bbc_content_ad`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bbc_content_cat`
--
ALTER TABLE `bbc_content_cat`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bbc_content_category`
--
ALTER TABLE `bbc_content_category`
  MODIFY `category_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `bbc_content_comment`
--
ALTER TABLE `bbc_content_comment`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `bbc_content_registrant`
--
ALTER TABLE `bbc_content_registrant`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bbc_content_related`
--
ALTER TABLE `bbc_content_related`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `bbc_content_schedule`
--
ALTER TABLE `bbc_content_schedule`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bbc_content_tag`
--
ALTER TABLE `bbc_content_tag`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bbc_content_trash`
--
ALTER TABLE `bbc_content_trash`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bbc_content_type`
--
ALTER TABLE `bbc_content_type`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bbc_cpanel`
--
ALTER TABLE `bbc_cpanel`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `bbc_email`
--
ALTER TABLE `bbc_email`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `bbc_lang`
--
ALTER TABLE `bbc_lang`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bbc_lang_code`
--
ALTER TABLE `bbc_lang_code`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `bbc_lang_text`
--
ALTER TABLE `bbc_lang_text`
  MODIFY `text_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `bbc_log`
--
ALTER TABLE `bbc_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bbc_menu`
--
ALTER TABLE `bbc_menu`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `bbc_menu_cat`
--
ALTER TABLE `bbc_menu_cat`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bbc_module`
--
ALTER TABLE `bbc_module`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `bbc_template`
--
ALTER TABLE `bbc_template`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bbc_user`
--
ALTER TABLE `bbc_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bbc_user_field`
--
ALTER TABLE `bbc_user_field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bbc_user_group`
--
ALTER TABLE `bbc_user_group`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bbc_user_push`
--
ALTER TABLE `bbc_user_push`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;

--
-- AUTO_INCREMENT for table `bbc_user_push_notif`
--
ALTER TABLE `bbc_user_push_notif`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5446;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_field`
--
ALTER TABLE `contact_field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_messenger`
--
ALTER TABLE `contact_messenger`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guestbook`
--
ALTER TABLE `guestbook`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guestbook_field`
--
ALTER TABLE `guestbook_field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `imageslider`
--
ALTER TABLE `imageslider`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `imageslider_cat`
--
ALTER TABLE `imageslider_cat`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `links_ad`
--
ALTER TABLE `links_ad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `links_share`
--
ALTER TABLE `links_share`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=779;

--
-- AUTO_INCREMENT for table `member_device`
--
ALTER TABLE `member_device`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_attendance`
--
ALTER TABLE `school_attendance`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_attendance_report`
--
ALTER TABLE `school_attendance_report`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_class`
--
ALTER TABLE `school_class`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_clock`
--
ALTER TABLE `school_clock`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_course`
--
ALTER TABLE `school_course`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `school_parent`
--
ALTER TABLE `school_parent`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_schedule`
--
ALTER TABLE `school_schedule`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_score`
--
ALTER TABLE `school_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_score_cat`
--
ALTER TABLE `school_score_cat`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_student`
--
ALTER TABLE `school_student`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_student_class`
--
ALTER TABLE `school_student_class`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_student_parent`
--
ALTER TABLE `school_student_parent`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_teacher`
--
ALTER TABLE `school_teacher`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_teacher_subject`
--
ALTER TABLE `school_teacher_subject`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_polling`
--
ALTER TABLE `survey_polling`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `survey_polling_option`
--
ALTER TABLE `survey_polling_option`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `survey_posted`
--
ALTER TABLE `survey_posted`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `survey_posted_question`
--
ALTER TABLE `survey_posted_question`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `survey_question`
--
ALTER TABLE `survey_question`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `survey_questionary`
--
ALTER TABLE `survey_questionary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `survey_question_option`
--
ALTER TABLE `survey_question_option`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimonial_field`
--
ALTER TABLE `testimonial_field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `member_device`
--
ALTER TABLE `member_device`
  ADD CONSTRAINT `member_device_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `school_attendance_report`
--
ALTER TABLE `school_attendance_report`
  ADD CONSTRAINT `report_schedule` FOREIGN KEY (`schedule_id`) REFERENCES `school_schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `school_class`
--
ALTER TABLE `school_class`
  ADD CONSTRAINT `class_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `school_teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `school_schedule`
--
ALTER TABLE `school_schedule`
  ADD CONSTRAINT `schedule_subject` FOREIGN KEY (`subject_id`) REFERENCES `school_teacher_subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `school_score`
--
ALTER TABLE `school_score`
  ADD CONSTRAINT `school_score_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `school_student` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `school_score_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `school_teacher` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `school_score_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `school_course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `school_score_ibfk_4` FOREIGN KEY (`type_id`) REFERENCES `school_score_cat` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `school_student_class`
--
ALTER TABLE `school_student_class`
  ADD CONSTRAINT `class_class` FOREIGN KEY (`class_id`) REFERENCES `school_class` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `school_student_parent`
--
ALTER TABLE `school_student_parent`
  ADD CONSTRAINT `student_parent_parent` FOREIGN KEY (`parent_id`) REFERENCES `school_parent` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_parent_student` FOREIGN KEY (`student_id`) REFERENCES `school_student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `school_teacher_subject`
--
ALTER TABLE `school_teacher_subject`
  ADD CONSTRAINT `subject_class` FOREIGN KEY (`class_id`) REFERENCES `school_class` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_course` FOREIGN KEY (`course_id`) REFERENCES `school_course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `school_teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
