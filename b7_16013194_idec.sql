-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql208.byethost7.com
-- Generation Time: Jun 05, 2015 at 07:15 AM
-- Server version: 5.6.22-71.0
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `b7_16013194_idec`
--

-- --------------------------------------------------------

--
-- Table structure for table `annual_data`
--

CREATE TABLE IF NOT EXISTS `annual_data` (
  `id_annual_data` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id_annual_data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `annual_data`
--

INSERT INTO `annual_data` (`id_annual_data`, `name`, `year`, `status`, `url`) VALUES
(1, 'PMS-Performance', 2015, 1, 'pms/performance'),
(2, 'PMS-Program', 2015, 1, 'pms/program'),
(3, 'RMS-Project', 2015, 1, 'pms/project'),
(4, 'RMS-Project Activity', 2015, 1, 'researcher/researcher_detail');

-- --------------------------------------------------------

--
-- Table structure for table `app_config`
--

CREATE TABLE IF NOT EXISTS `app_config` (
  `key` varchar(55) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_files`
--

CREATE TABLE IF NOT EXISTS `app_files` (
  `id_app_files` int(11) NOT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `lang` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(100) DEFAULT NULL,
  `class` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `size` varchar(45) DEFAULT NULL,
  `module` varchar(45) DEFAULT NULL,
  `app_theme_id_app_theme` int(11) NOT NULL,
  PRIMARY KEY (`id_app_files`,`lang`),
  KEY `fk_app_files_app_theme1_idx` (`app_theme_id_app_theme`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_files`
--

INSERT INTO `app_files` (`id_app_files`, `filename`, `lang`, `description`, `class`, `color`, `size`, `module`, `app_theme_id_app_theme`) VALUES
(1, 'Dashboard', 'en', 'IDeC', 'icon-dashboard', 'grey', 'double', 'idec', 2),
(1, 'Home', 'ina', 'IDeC', 'icon-dashboard', 'grey', 'double', 'idec', 2),
(2, 'Profile', 'en', 'IDeC', '', 'grey', 'double', 'profile', 3),
(2, 'Profile', 'ina', 'IDeC', '', 'grey', 'double', 'profile', 3),
(3, 'Change Password', 'en', 'IDeC', NULL, 'grey', 'double', 'admin_user', 3),
(3, 'Ubah Password', 'ina', 'IDeC', NULL, 'grey', 'double', 'admin_user', 3),
(4, 'Logout', 'en', 'IDeC', NULL, 'grey', 'double', 'admin/logout', 3),
(4, 'Keluar', 'ina', 'IDeC', NULL, 'grey', 'double', 'admin/logout', 3),
(5, 'Files Management', 'ina', 'IDeC', NULL, 'grey', 'double', 'admin_file', 3),
(6, 'Menu management', 'en', 'IDeC', NULL, 'grey', 'double', 'admin_menu', 3),
(6, 'Menu management', 'ina', 'IDeC', NULL, 'grey', 'double', 'admin_menu', 3),
(7, 'Group List', 'en', 'IDeC', NULL, 'grey', 'double', 'admin_group', 3),
(7, 'Group List', 'ina', 'IDeC', NULL, 'grey', 'double', 'admin_group', 3),
(8, 'Content Editor', 'en', 'IDeC', NULL, 'grey', 'double', 'admin_content', 3),
(8, 'Content Editor', 'ina', 'IDeC', NULL, 'grey', 'double', 'admin_content', 3),
(9, 'Group Role', 'en', 'IDeC', NULL, 'grey', 'double', 'admin_role', 3),
(9, 'Group Role', 'ina', 'IDeC', NULL, 'grey', 'double', 'admin_role', 3),
(10, 'Setting Configuration', 'en', 'IDeC', NULL, 'grey', 'double', 'admin_config', 3),
(10, 'Setting Configuration', 'ina', 'IDeC', NULL, 'grey', 'double', 'admin_config', 3),
(11, 'Contact Information', 'en', 'IDeC', NULL, 'grey', 'double', 'admin_contact', 3),
(11, 'Contact Information', 'ina', 'IDeC', NULL, 'grey', 'double', 'admin_contact', 3),
(12, 'Message', 'en', 'IDeC', 'profile', 'grey', 'double', 'msg', 2),
(12, 'Pesan', 'ina', 'IDeC', 'profile', 'grey', 'double', 'msg', 2),
(13, 'Profile', 'en', 'IDeC', NULL, 'grey', 'double', '#', 2),
(13, 'Profile', 'ina', 'IDeC', 'icon-user', 'orange', 'double', '#', 2),
(14, 'Data Hasil Riset', 'en', 'IDeC', NULL, 'grey', 'double', 'idec_rms/research', 2),
(14, 'Data Hasil Riset', 'ina', 'Data Program', 'icon-globe', 'yellow', 'double', 'idec_rms/research', 2),
(15, 'Activity', 'en', 'IDeC', NULL, 'grey', 'double', '#', 2),
(15, 'Kegiatan', 'ina', 'IDeC', 'icon-tasks', 'orange', 'double', '#', 2),
(16, 'PMS', 'en', 'PMS', NULL, 'grey', 'double', '#', 2),
(16, 'PMS', 'ina', 'Performance Management System', 'icon-magic', 'green', 'double', '#', 2),
(17, 'Researcher', 'en', 'RMS', 'profile', 'grey', 'double', '#', 2),
(17, 'Researcher', 'ina', 'Research Management System', 'icon-beaker', 'red', 'double', '#', 2),
(18, 'Performance', 'en', 'PMS', 'profile', 'grey', 'double', 'idec_pms/performance', 2),
(18, 'Performance', 'ina', 'Performansi untuk masing-masing unit dan researcher', 'icon-screenshot', 'blue', 'double', 'idec_pms/performance', 2),
(19, 'News', 'en', 'IDeC', 'profile', 'grey', 'double', 'news', 2),
(19, 'Berita', 'ina', 'IDeC', 'profile', 'grey', 'double', 'news', 2),
(20, 'Anouncement', 'en', 'IDeC', '', 'grey', 'double', 'announcement', 2),
(20, 'Pengumuman', 'ina', 'IDeC', '', 'grey', 'double', 'announcement', 2),
(21, 'Event', 'en', 'IDeC', '', 'grey', 'double', 'event', 2),
(21, 'Kegiatan', 'ina', 'IDeC', '', 'grey', 'double', 'event', 2),
(22, 'Organization Structure', 'en', 'Struktur organisasi yang ada di IDec', 'profile', 'grey', 'double', 'idec_general/organization', 2),
(22, 'Organization Structure', 'ina', 'Struktur organisasi yang ada di IDec', 'icon-sitemap', 'orange', 'double', 'idec_general/organization', 2),
(23, 'Annual Data', 'en', 'Pengelompokan program, performansi serta project yang sifatnya tahunan', 'profile', 'grey', 'double', 'idec_general/annual', 2),
(23, 'Annual Data', 'ina', 'Pengelompokan program, performansi serta project yang sifatnya tahunan', 'icon-tasks', 'red', 'double', 'idec_general/annual', 2),
(24, 'Employee', 'en', 'Mengelola data-data karyawan', 'profile', 'grey', 'double', 'idec_general/employee', 2),
(24, 'Employee', 'ina', 'Mengelola data-data karyawan', 'icon-smile', 'yellow', 'double', 'idec_general/employee', 2),
(25, 'Management Review', 'en', 'Mengelola data review program yang sedang berjalan', 'profile', 'grey', 'double', 'idec_pms/review', 2),
(25, 'Management Review', 'ina', 'Mengelola data review program yang sedang berjalan', 'icon-check', 'purple', 'double', 'idec_pms/review', 2),
(26, 'Program', 'en', 'Mengatur data program kerja tahunan di organisasi IDeC', 'profile', 'red', 'double', 'idec_pms/program', 2),
(26, 'Program', 'ina', 'Mengatur data program kerja tahunan di organisasi IDeC', 'icon-book', 'red', 'double', 'idec_pms/program', 2),
(27, 'Riset', 'en', 'Pengalokasian researcher dalam suatu project', 'profile', 'blue', 'double', '##', 2),
(27, 'Riset', 'ina', 'Riset', 'icon-eye-open', 'blue', 'double', '##', 2),
(28, 'Penilaian Research', 'en', 'Data Hasil Riset,Inovasi, Partnership\r\n', 'profile', 'yellow', 'double', '#', 2),
(28, 'Penilaian Research', 'ina', 'Data Hasil Riset,Inovasi, Partnership', 'icon-flag', 'yellow', 'double', '#', 2),
(29, 'Result', 'en', 'Data researcher, pelatihan dan HAKI', 'profile', 'green', 'double', '##', 2),
(29, 'Result', 'ina', 'Result', 'icon-download-alt', 'green', 'double', '##', 2),
(30, 'Project Researcher', 'en', 'Management data per project', 'profile', 'red', 'double', 'idec_rms/project', 2),
(30, 'Project Researcher', 'ina', 'Management data per project', 'icon-flag-checkered', 'red', 'double', 'idec_rms/project', 2),
(31, 'Data Researcher', 'en', 'Management data per researcher', 'profile', 'purple', 'double', 'idec_rms/researcher', 2),
(31, 'Data Researcher', 'ina', 'Management data per researcher', 'icon-group', 'purple', 'double', 'idec_rms/researcher', 2),
(32, 'Permintaan QA', 'en', 'RMS', 'profile', 'green', 'double', '##', 2),
(32, 'Permintaan QA', 'ina', 'Permintaan QA', 'profile', 'green', 'double', '##', 2),
(33, 'Data Hasil Inovasi', 'en', 'Informasi riset dan inovasi', 'profile', 'purple', 'double', 'idec_rms/research', 2),
(33, 'Data Hasil Inovasi', 'ina', 'Informasi riset dan inovasi', 'icon-hdd', 'purple', 'double', 'idec_rms/research', 2),
(34, 'Training', 'en', 'Informasi training', 'profile', 'yellow', 'double', 'idec_rms/training', 2),
(34, 'Training', 'ina', 'Informasi training', 'icon-puzzle-piece', 'yellow', 'double', 'idec_rms/training', 2),
(35, 'Data Hasil Partnership', 'en', 'Informasi partnership', 'profile', 'red', 'double', 'idec_rms/partnership', 2),
(35, 'Data Hasil Partnership', 'ina', 'Informasi partnership', 'icon-group', 'red', 'double', 'idec_rms/partnership', 2),
(36, 'HAKI', 'en', 'Informasi HAKI', 'profile', 'green', 'double', 'idec_rms/haki', 2),
(36, 'HAKI', 'ina', 'Informasi HAKI', 'icon-key', 'green', 'double', 'idec_rms/haki', 2),
(37, 'Sertifikasi', 'en', 'Informasi sertifikasi', 'profile', 'purple', 'double', 'idec_rms/certificate', 2),
(37, 'Sertifikasi', 'ina', 'Informasi sertifikasi', 'icon-certificate', 'purple', 'double', 'idec_rms/certificate', 2),
(38, 'BKO Researcher', 'en', NULL, 'profile', 'silver', NULL, 'idec_rms/researcher_map', 2),
(38, 'BKO Researcher', 'ina', 'Pemetaan Researcher', 'icon-globe', 'red', 'double', 'idec_rms/researcher_map', 2),
(39, 'Research Management', 'en', NULL, 'profile', 'silver', NULL, '#', 2),
(39, 'Research Management', 'ina', 'Result Management', 'icon-check', 'orange', 'double', '#', 2),
(40, 'Logout', 'en', NULL, 'profile', 'silver', NULL, 'idec/logout', 2),
(40, 'Logout', 'ina', 'Logout', 'icon-off', 'orange', '', 'idec/logout', 2),
(41, 'Result', 'en', NULL, 'profile', 'silver', NULL, '##', 2),
(41, 'Result', 'ina', 'Result Inovasi', 'icon-hdd', 'orange', '', '##', 2),
(42, 'Pemanfataan lebih luas', 'en', NULL, 'profile', 'silver', NULL, '##', 2),
(42, 'Pemanfataan lebih luas', 'ina', 'Pemanfataan lebih luas inovasi', 'icon-inbox', 'orange', '', '##', 2),
(43, 'Inovasi (Internal/Eksternal)', 'en', NULL, 'profile', 'silver', NULL, '##', 2),
(43, 'Inovasi (Internal/Eksternal)', 'ina', 'Inovasi (Internal/Eksternal)', 'icon-upload-alt', 'orange', '', '##', 2),
(44, 'Pemanfataan lebih luas', 'en', NULL, 'profile', 'silver', NULL, '##', 2),
(44, 'Pemanfataan lebih luas', 'ina', 'Pemanfataan lebih luas', '', 'orange', '', '##', 2),
(45, 'QA', 'en', NULL, 'profile', 'silver', NULL, '##', 2),
(45, 'QA', 'ina', 'QA', 'icon-thumbs-up', 'blue', 'double', '##', 2),
(46, 'Data Hasil QA', 'en', NULL, 'profile', 'silver', NULL, '##', 2),
(46, 'Data Hasil QA', 'ina', 'Result', '', 'orange', '', '##', 2),
(47, 'Partnership', 'en', NULL, 'profile', 'silver', NULL, '##', 2),
(47, 'Partnership', 'ina', 'Partnership', 'icon-retweet', 'orange', '', '##', 2),
(48, 'Hasil akhir', 'en', NULL, 'profile', 'silver', NULL, '##', 2),
(48, 'Hasil akhir', 'ina', 'Hasil akhir', '', 'orange', '', '##', 2),
(49, 'Bantek', 'en', NULL, 'profile', 'silver', NULL, '##', 2),
(49, 'Bantek', 'ina', '', 'icon-qrcode', 'orange', '', '##', 2),
(50, 'Data Hasil BANTEK', 'en', NULL, 'profile', 'silver', NULL, 'idec_rms/partnership', 2),
(50, 'Data Hasil BANTEK', 'ina', 'Data program', '', 'orange', '', 'idec_rms/partnership', 2),
(51, 'Result', 'en', NULL, 'profile', 'silver', NULL, '##', 2),
(51, 'Result', 'ina', 'Result', '', 'orange', '', '##', 2),
(52, 'Pemanfataan lebih luas', 'en', NULL, 'profile', 'silver', NULL, '##', 2),
(52, 'Pemanfataan lebih luas', 'ina', 'Pemanfataan lebih luas', '', 'orange', '', '##', 2),
(53, 'Others', 'en', NULL, 'profile', 'silver', NULL, '##', 2),
(53, 'Others', 'ina', 'Others', 'icon-quote-right', 'orange', '', '##', 2),
(54, 'Project Bidang', 'en', NULL, 'profile', 'silver', NULL, 'idec_rms/projectbidang', 2),
(54, 'Project Bidang', 'ina', 'Project Bidang', 'icon-tags', 'orange', '', 'idec_rms/projectbidang', 2);

-- --------------------------------------------------------

--
-- Table structure for table `app_menus`
--

CREATE TABLE IF NOT EXISTS `app_menus` (
  `position` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `sub_id` int(10) NOT NULL DEFAULT '0',
  `sort` int(10) NOT NULL DEFAULT '0',
  `file_id` int(10) NOT NULL,
  `id_theme` int(10) DEFAULT NULL,
  PRIMARY KEY (`position`,`id`),
  KEY `fk_menus_files` (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_menus`
--

INSERT INTO `app_menus` (`position`, `id`, `sub_id`, `sort`, `file_id`, `id_theme`) VALUES
(3, 1, 0, 0, 1, 2),
(3, 8, 2, 0, 18, 2),
(3, 10, 2, 2, 25, 2),
(3, 2, 1, 1, 16, 2),
(3, 4, 1, 0, 14, 2),
(3, 7, 4, 3, 24, 2),
(3, 6, 4, 2, 23, 2),
(3, 3, 1, 2, 17, 2),
(3, 9, 2, 1, 26, 2),
(3, 5, 4, 1, 22, 2),
(3, 11, 3, 0, 27, 2),
(3, 12, 3, 1, 28, 2),
(3, 13, 3, 2, 29, 2),
(3, 26, 11, 2, 30, 2),
(3, 15, 11, 0, 31, 2),
(3, 23, 12, 2, 33, 2),
(3, 25, 11, 1, 38, 2),
(3, 18, 13, 1, 34, 2),
(3, 22, 12, 1, 35, 2),
(3, 20, 13, 2, 36, 2),
(3, 21, 13, 3, 37, 2),
(1, 1, 0, 0, 1, 2),
(1, 8, 2, 1, 18, 2),
(1, 10, 2, 2, 25, 2),
(1, 2, 0, 3, 16, 2),
(1, 29, 1, 1, 22, 2),
(1, 30, 1, 2, 23, 2),
(1, 31, 1, 3, 24, 2),
(1, 3, 0, 1, 17, 2),
(1, 9, 2, 0, 26, 2),
(1, 32, 3, 0, 31, 2),
(1, 40, 39, 1, 14, 2),
(1, 33, 3, 2, 38, 2),
(1, 36, 35, 0, 33, 2),
(1, 35, 4, 0, 43, 2),
(1, 34, 3, 3, 30, 2),
(1, 39, 4, 1, 27, 2),
(1, 42, 39, 3, 44, 2),
(1, 43, 4, 2, 45, 2),
(1, 4, 0, 2, 39, 2),
(1, 5, 0, 4, 40, 2),
(1, 38, 35, 2, 42, 2),
(1, 45, 43, 2, 46, 2),
(1, 46, 4, 3, 47, 2),
(1, 47, 46, 1, 35, 2),
(1, 49, 4, 4, 49, 2),
(1, 50, 49, 1, 50, 2),
(1, 52, 49, 3, 52, 2),
(1, 53, 4, 5, 53, 2),
(1, 54, 53, 1, 36, 2),
(1, 55, 53, 2, 37, 2),
(1, 56, 53, 3, 34, 2),
(1, 57, 3, 1, 54, 2);

-- --------------------------------------------------------

--
-- Table structure for table `app_theme`
--

CREATE TABLE IF NOT EXISTS `app_theme` (
  `id_app_theme` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `folder` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_app_theme`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_theme`
--

INSERT INTO `app_theme` (`id_app_theme`, `name`, `folder`) VALUES
(2, 'IDeC', 'themes/idec/'),
(3, 'Admin Panel', 'themes/admin/');

-- --------------------------------------------------------

--
-- Table structure for table `app_user_activity`
--

CREATE TABLE IF NOT EXISTS `app_user_activity` (
  `id_app_user_activity` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `activity_type` varchar(45) DEFAULT NULL,
  `activity` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_app_user_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bantek`
--

CREATE TABLE IF NOT EXISTS `bantek` (
  `id_bantek` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(250) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `id_mas_project_status` int(11) NOT NULL,
  PRIMARY KEY (`id_bantek`),
  KEY `fk_bantek_mas_project_status1_idx` (`id_mas_project_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bantek_document`
--

CREATE TABLE IF NOT EXISTS `bantek_document` (
  `id_bantek_document` int(11) NOT NULL AUTO_INCREMENT,
  `document` varchar(255) DEFAULT NULL,
  `id_bantek` int(11) NOT NULL,
  `id_mas_partnership_document_type` int(11) NOT NULL,
  PRIMARY KEY (`id_bantek_document`,`id_bantek`),
  KEY `fk_bantek_document_bantek1_idx` (`id_bantek`),
  KEY `fk_bantek_document_mas_partnership_document_type1_idx` (`id_mas_partnership_document_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bantek_information`
--

CREATE TABLE IF NOT EXISTS `bantek_information` (
  `id_bantek_information` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `title` text,
  `content` text,
  `id_user` int(11) NOT NULL,
  `id_bantek` int(11) NOT NULL,
  PRIMARY KEY (`id_bantek_information`,`id_user`,`id_bantek`),
  KEY `fk_partnership_information_user1_idx` (`id_user`),
  KEY `fk_bantek_information_bantek1_idx` (`id_bantek`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bantek_program`
--

CREATE TABLE IF NOT EXISTS `bantek_program` (
  `id_bantek_program` int(11) NOT NULL,
  `program_name` text,
  `SOW` text,
  `Deliverable` text,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `pic_idec` varchar(250) DEFAULT NULL,
  `pic_user` varchar(250) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `realization` float DEFAULT NULL,
  `id_bantek` int(11) NOT NULL,
  PRIMARY KEY (`id_bantek_program`,`id_bantek`),
  KEY `fk_bantek_program_bantek1_idx` (`id_bantek`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bantek_utilization`
--

CREATE TABLE IF NOT EXISTS `bantek_utilization` (
  `id_bantek_utilization` int(11) NOT NULL,
  `utilization` text,
  `id_bantek` int(11) NOT NULL,
  PRIMARY KEY (`id_bantek_utilization`,`id_bantek`),
  KEY `fk_bantek_utilization_bantek1_idx` (`id_bantek`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Bantek_work_unit_executor`
--

CREATE TABLE IF NOT EXISTS `Bantek_work_unit_executor` (
  `id_bantek_work_unit_executor` int(11) NOT NULL,
  `id_organization_item` int(11) NOT NULL,
  `id_bantek` int(11) NOT NULL,
  PRIMARY KEY (`id_bantek_work_unit_executor`,`id_bantek`),
  KEY `fk_Bantek_work_unit_executor_organization_item1_idx` (`id_organization_item`),
  KEY `fk_Bantek_work_unit_executor_bantek1_idx` (`id_bantek`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bko_history`
--

CREATE TABLE IF NOT EXISTS `bko_history` (
  `id_bko_history` int(11) NOT NULL,
  `year` varchar(45) DEFAULT NULL,
  `id_employee` int(11) NOT NULL,
  `id_organization_item` int(11) NOT NULL,
  `id_mas_title` int(11) NOT NULL,
  `id_mas_employee_position` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id_bko_history`),
  KEY `fk_BKO_History_employee1_idx` (`id_employee`),
  KEY `fk_bko_history_organization_item1_idx` (`id_organization_item`),
  KEY `fk_bko_history_mas_title1_idx` (`id_mas_title`),
  KEY `fk_bko_history_mas_employee_position1_idx` (`id_mas_employee_position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE IF NOT EXISTS `certificate` (
  `id_certificate` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `organizer` varchar(255) DEFAULT NULL,
  `id_mas_times_category` int(11) NOT NULL,
  PRIMARY KEY (`id_certificate`),
  KEY `fk_certificate_mas_category1_idx` (`id_mas_times_category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `certificate_employee`
--

CREATE TABLE IF NOT EXISTS `certificate_employee` (
  `id_certificate_employee` int(11) NOT NULL,
  `file_upload` varchar(45) DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `id_employee` int(11) NOT NULL,
  `id_certificate` int(11) NOT NULL,
  PRIMARY KEY (`id_certificate_employee`),
  KEY `fk_certificate_employee_employee1_idx` (`id_employee`),
  KEY `fk_certificate_employee_certificate1_idx` (`id_certificate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `competence_employee`
--

CREATE TABLE IF NOT EXISTS `competence_employee` (
  `id_competence_employee` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL,
  `id_mas_competence` int(11) NOT NULL,
  PRIMARY KEY (`id_competence_employee`),
  KEY `fk_competence_employee_employee1_idx` (`id_employee`),
  KEY `fk_competence_employee_competence1_idx` (`id_mas_competence`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `competence_employee`
--

INSERT INTO `competence_employee` (`id_competence_employee`, `id_employee`, `id_mas_competence`) VALUES
(1, 1, 1),
(2, 1, 2),
(6, 4, 1),
(7, 4, 5),
(8, 5, 5),
(0, 6, 4),
(9, 2, 2),
(10, 6, 1),
(11, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id_employee` int(11) NOT NULL,
  `nik` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `gender` set('male','female') DEFAULT NULL,
  `information` longtext,
  `date_of_birth` date DEFAULT NULL,
  `start_work` date DEFAULT NULL,
  `cv_document` varchar(255) DEFAULT NULL,
  `id_organization_item` int(11) NOT NULL,
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) DEFAULT NULL,
  `id_mas_title` int(11) DEFAULT NULL,
  `id_mas_bp` int(11) DEFAULT NULL,
  `id_mas_employee_position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_employee`),
  KEY `fk_employee_organization_item1_idx` (`id_organization_item`),
  KEY `fk_employee_user1_idx` (`id_user`),
  KEY `fk_employee_mas_title1_idx` (`id_mas_title`),
  KEY `fk_employee_mas_bp1_idx` (`id_mas_bp`),
  KEY `fk_employee_mas_employee_position1_idx` (`id_mas_employee_position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id_employee`, `nik`, `name`, `gender`, `information`, `date_of_birth`, `start_work`, `cv_document`, `id_organization_item`, `id_user`, `photo`, `id_mas_title`, `id_mas_bp`, `id_mas_employee_position`) VALUES
(1, '099991111', 'Dummytester', 'male', NULL, '2015-05-22', '2015-05-01', '2113cd88275cb8b0fb9199adac319b33.pdf', 12, 1, NULL, 1, 1, 2),
(2, '900000', 'Dummytester 02', 'female', NULL, '2015-05-06', '2015-05-25', '9c95ffe792a79cafc4e3360e02f3b08e.docx', 12, 1, NULL, 1, 2, 3),
(3, '9800000', 'Dummytester 03', 'male', NULL, '2015-05-06', '2015-05-04', '574e0b1a2dfc62e5d29343f08dcd8c29.docx', 4, 1, NULL, 1, 2, 3),
(4, '0987888888', 'Dummytester 04', 'male', NULL, NULL, NULL, '3c6afcd37245034c5ff5c56b748f85be.docx', 2, 2, NULL, NULL, 2, 1),
(5, '09878888889', 'Dummytester 05', 'male', NULL, NULL, NULL, '3c6afcd37245034c5ff5c56b748f85be.docx', 4, 1, NULL, 1, 2, 1),
(6, '3123123123', 'Viktor Tunggul', 'male', NULL, '1984-11-30', NULL, 'fb13928904055c5c77421dd2d5bdc364.pdf', 14, 1, NULL, 1, 2, 5),
(7, '12345', 'Kurnia', 'male', NULL, '1991-09-15', NULL, 'd71361335fef593bfdac70c4f3411a90.pdf', 12, 4, NULL, 1, 2, 1),
(8, '3123123', 'sdas', 'male', NULL, '0000-00-00', NULL, '29d2650187c4f2691c50e79259871722.pdf', 4, 5, NULL, 1, 1, 6),
(9, '13124234', 'Adnan', 'male', NULL, '0000-00-00', NULL, '', 13, 6, NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_activity_log`
--

CREATE TABLE IF NOT EXISTS `employee_activity_log` (
  `id_employee_activity_log` int(11) NOT NULL AUTO_INCREMENT,
  `activity_start_date` date DEFAULT NULL,
  `activity_end_date` date DEFAULT NULL,
  `activity_name` varchar(45) DEFAULT NULL,
  `activity_detail` text,
  `location` text,
  `percent_progress` float DEFAULT NULL,
  `last_progress_update` timestamp NULL DEFAULT NULL,
  `id_employee_project` int(11) NOT NULL,
  `id_project_step` int(11) NOT NULL,
  `id_mas_project_status` int(11) NOT NULL,
  PRIMARY KEY (`id_employee_activity_log`),
  KEY `fk_employee_activity_log_employee_project1_idx` (`id_employee_project`),
  KEY `fk_employee_activity_log_project_step1_idx` (`id_project_step`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `employee_activity_log`
--

INSERT INTO `employee_activity_log` (`id_employee_activity_log`, `activity_start_date`, `activity_end_date`, `activity_name`, `activity_detail`, `location`, `percent_progress`, `last_progress_update`, `id_employee_project`, `id_project_step`, `id_mas_project_status`) VALUES
(1, '2016-01-03', '2016-01-06', 'Validated Products', 'Validated Products', 'Bandung', NULL, NULL, 3, 4, 2),
(2, '2015-06-01', '2015-06-06', 'Validated Business model', 'Validated Business model', 'Bandung', NULL, NULL, 3, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_education`
--

CREATE TABLE IF NOT EXISTS `employee_education` (
  `id_employee_education` int(11) NOT NULL,
  `education_degree` varchar(5) DEFAULT NULL,
  `institute` varchar(255) DEFAULT NULL,
  `major` varchar(45) DEFAULT NULL,
  `start_year` year(4) DEFAULT NULL,
  `end_year` year(4) DEFAULT NULL,
  `id_employee` int(11) NOT NULL,
  PRIMARY KEY (`id_employee_education`,`id_employee`),
  KEY `fk_employee_education_employee1_idx` (`id_employee`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_education`
--

INSERT INTO `employee_education` (`id_employee_education`, `education_degree`, `institute`, `major`, `start_year`, `end_year`, `id_employee`) VALUES
(1, 'S1', 'Institute Telkom', 'Teknik', 2010, 2013, 1),
(0, 'SD', 'SD 1', '-', 2010, 2011, 6);

-- --------------------------------------------------------

--
-- Table structure for table `employee_project`
--

CREATE TABLE IF NOT EXISTS `employee_project` (
  `id_employee_project` int(11) NOT NULL AUTO_INCREMENT,
  `job_desc` varchar(255) DEFAULT NULL,
  `id_mas_employee_project_position` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL,
  `is_draft` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_employee_project`),
  KEY `fk_employee_project_mas_employee_project_position1_idx` (`id_mas_employee_project_position`),
  KEY `fk_employee_project_project1_idx` (`id_project`),
  KEY `fk_employee_project_employee1_idx` (`id_employee`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `employee_project`
--

INSERT INTO `employee_project` (`id_employee_project`, `job_desc`, `id_mas_employee_project_position`, `id_project`, `id_employee`, `is_draft`) VALUES
(3, NULL, 2, 2, 4, NULL),
(4, NULL, 1, 3, 4, NULL),
(5, NULL, 1, 2, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `formula_performance_indicator`
--

CREATE TABLE IF NOT EXISTS `formula_performance_indicator` (
  `id_formula_performance_indicator` int(11) NOT NULL,
  `id_mas_formula` int(11) NOT NULL,
  `id_performance_indicator` int(11) NOT NULL,
  PRIMARY KEY (`id_formula_performance_indicator`),
  KEY `fk_formula_performance_indicator_formula1_idx` (`id_mas_formula`),
  KEY `fk_formula_performance_indicator_performance_indicator1_idx` (`id_performance_indicator`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `formula_performance_indicator`
--

INSERT INTO `formula_performance_indicator` (`id_formula_performance_indicator`, `id_mas_formula`, `id_performance_indicator`) VALUES
(1, 8, 1),
(2, 1, 1),
(3, 8, 2),
(4, 1, 2),
(5, 8, 3),
(6, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Innovation`
--

CREATE TABLE IF NOT EXISTS `Innovation` (
  `id_innovation` int(11) NOT NULL,
  `Innovation_title` varchar(255) DEFAULT NULL,
  `innovation_scope` set('internal','external') DEFAULT NULL,
  `startup_name` varchar(45) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `information` text,
  `innovation_type` varchar(45) DEFAULT NULL,
  `description` text,
  `product_category` varchar(45) DEFAULT NULL,
  `final_step` varchar(45) DEFAULT NULL,
  `budget_realization` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_innovation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Innovation_document`
--

CREATE TABLE IF NOT EXISTS `Innovation_document` (
  `id_innovation_document` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `description` text,
  `received_date` date DEFAULT NULL,
  `id_innovation` int(11) NOT NULL,
  PRIMARY KEY (`id_innovation_document`,`id_innovation`),
  KEY `fk_Innovation_document_Innovation1_idx` (`id_innovation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `innovation_utilization`
--

CREATE TABLE IF NOT EXISTS `innovation_utilization` (
  `id_innovation_utilization` int(11) NOT NULL,
  `utilization` text,
  `id_innovation` int(11) NOT NULL,
  PRIMARY KEY (`id_innovation_utilization`),
  KEY `fk_innovation_utilization_Innovation1_idx` (`id_innovation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ip`
--

CREATE TABLE IF NOT EXISTS `ip` (
  `id_ip` int(11) NOT NULL,
  `type` set('patent','copyright','trademark') DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `description` text,
  `status` set('draft','accepted','on going') DEFAULT NULL,
  `number` varchar(45) DEFAULT NULL,
  `submission_date` date DEFAULT NULL,
  `accepted_date` date DEFAULT NULL,
  `expired_daate` date DEFAULT NULL,
  `submission_document` varchar(45) DEFAULT NULL,
  `certificate_document` varchar(45) DEFAULT NULL,
  `id_organization_item` int(11) NOT NULL,
  PRIMARY KEY (`id_ip`),
  KEY `fk_ip_organization_item1_idx` (`id_organization_item`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mas_bp`
--

CREATE TABLE IF NOT EXISTS `mas_bp` (
  `id_mas_bp` int(11) NOT NULL,
  `bp` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mas_bp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_bp`
--

INSERT INTO `mas_bp` (`id_mas_bp`, `bp`) VALUES
(1, 'I'),
(2, 'II'),
(3, 'III'),
(4, 'IV'),
(5, 'V'),
(6, 'VI');

-- --------------------------------------------------------

--
-- Table structure for table `mas_competence`
--

CREATE TABLE IF NOT EXISTS `mas_competence` (
  `id_mas_competence` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id_mas_competence`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_competence`
--

INSERT INTO `mas_competence` (`id_mas_competence`, `name`, `description`) VALUES
(1, 'Telecomunication', NULL),
(2, 'Information', NULL),
(3, 'Media', NULL),
(4, 'Education', NULL),
(5, 'Service', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mas_employee_position`
--

CREATE TABLE IF NOT EXISTS `mas_employee_position` (
  `id_mas_employee_position` int(11) NOT NULL,
  `position` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mas_employee_position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_employee_position`
--

INSERT INTO `mas_employee_position` (`id_mas_employee_position`, `position`) VALUES
(1, 'RESEARCHER'),
(2, 'SENIOR GENERAL MANAGER'),
(3, 'DEPUTY SGM'),
(4, 'SENIOR MANAGER'),
(5, 'MANAGER'),
(6, 'OFFICER 1'),
(7, 'OFFICER 2'),
(8, 'ENGINEER 1'),
(9, 'ENGINEER 2'),
(10, 'ENGINEER 3');

-- --------------------------------------------------------

--
-- Table structure for table `mas_employee_project_position`
--

CREATE TABLE IF NOT EXISTS `mas_employee_project_position` (
  `id_mas_employee_project_position` int(11) NOT NULL,
  `position` varchar(25) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mas_employee_project_position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_employee_project_position`
--

INSERT INTO `mas_employee_project_position` (`id_mas_employee_project_position`, `position`, `weight`) VALUES
(1, 'PM', 5),
(2, 'Shared', 1),
(3, 'Dedicated', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mas_formula`
--

CREATE TABLE IF NOT EXISTS `mas_formula` (
  `id_mas_formula` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `type` set('achievement','realization') DEFAULT NULL,
  `content` text,
  `description` text,
  `formula_upload` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_mas_formula`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_formula`
--

INSERT INTO `mas_formula` (`id_mas_formula`, `name`, `type`, `content`, `description`, `formula_upload`) VALUES
(1, 'F1', 'achievement', NULL, NULL, NULL),
(2, 'F2', 'achievement', NULL, NULL, NULL),
(3, 'F3', 'achievement', NULL, NULL, NULL),
(4, 'F4', 'achievement', NULL, NULL, NULL),
(5, 'F5', 'achievement', NULL, NULL, NULL),
(6, 'F6', 'achievement', NULL, NULL, NULL),
(8, 'R1', 'realization', NULL, NULL, NULL),
(9, 'R2', 'realization', NULL, NULL, NULL),
(10, 'R3', 'realization', NULL, NULL, NULL),
(11, 'R4', 'realization', NULL, NULL, NULL),
(12, 'F3', 'achievement', NULL, NULL, 'f3.png'),
(7, 'F7', 'achievement', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Mas_innovation`
--

CREATE TABLE IF NOT EXISTS `Mas_innovation` (
  `id_mas_innovation` int(11) NOT NULL,
  `data_type` set('innovation_type','last_step','product_category') DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_mas_innovation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Mas_innovation`
--

INSERT INTO `Mas_innovation` (`id_mas_innovation`, `data_type`, `value`) VALUES
(1, 'product_category', 'Product   '),
(2, 'product_category', 'Platform   '),
(3, 'product_category', 'Service  '),
(4, 'product_category', 'Process   '),
(5, 'product_category', 'Application   '),
(6, 'product_category', 'Prototype   '),
(7, 'product_category', 'Others  '),
(8, 'last_step', 'Customer Validation'),
(9, 'last_step', 'Product Validation'),
(10, 'last_step', 'Business Model Validation'),
(11, 'last_step', 'Handover to DDB'),
(12, 'innovation_type', 'Cloud - IaaS (Public)'),
(13, 'innovation_type', 'Cloud - Consumer SaaS '),
(14, 'innovation_type', 'Cloud - Business SaaS'),
(15, 'innovation_type', 'Cloud - SaaS Marketplace (Include PaaS)'),
(16, 'innovation_type', 'Financial Service - DOB'),
(17, 'innovation_type', 'Financial Service - Non DOB Payments'),
(18, 'innovation_type', 'Financial Service - Insurance'),
(19, 'innovation_type', 'Financial Service - Credit'),
(20, 'innovation_type', 'Financial Service - Savings'),
(21, 'innovation_type', 'Advertising - Agency'),
(22, 'innovation_type', 'Advertising - Incentive Marketing'),
(23, 'innovation_type', 'Media - Portal / Static Content'),
(24, 'innovation_type', 'Media - Streaming & Games'),
(25, 'innovation_type', 'Media - Social / UGC'),
(26, 'innovation_type', 'Media - Others');

-- --------------------------------------------------------

--
-- Table structure for table `mas_key_performance`
--

CREATE TABLE IF NOT EXISTS `mas_key_performance` (
  `id_mas_key_performance` int(11) NOT NULL,
  `key_performance` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_mas_key_performance`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mas_metric`
--

CREATE TABLE IF NOT EXISTS `mas_metric` (
  `id_mas_metric` int(11) NOT NULL,
  `metric` varchar(45) DEFAULT NULL,
  `metric_type` set('quantity','date') DEFAULT NULL,
  PRIMARY KEY (`id_mas_metric`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_metric`
--

INSERT INTO `mas_metric` (`id_mas_metric`, `metric`, `metric_type`) VALUES
(1, 'unit', 'quantity'),
(2, 'date', 'date');

-- --------------------------------------------------------

--
-- Table structure for table `mas_partnership_document_type`
--

CREATE TABLE IF NOT EXISTS `mas_partnership_document_type` (
  `id_mas_partnership_document_type` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `type_for` set('partnership','bantek') DEFAULT NULL,
  PRIMARY KEY (`id_mas_partnership_document_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_partnership_document_type`
--

INSERT INTO `mas_partnership_document_type` (`id_mas_partnership_document_type`, `type`, `type_for`) VALUES
(1, 'PKS', 'partnership'),
(2, 'Justifikasi', 'partnership'),
(3, 'Lampiran', 'partnership'),
(4, 'Dasar Permintaan', 'bantek');

-- --------------------------------------------------------

--
-- Table structure for table `mas_performance_mapping`
--

CREATE TABLE IF NOT EXISTS `mas_performance_mapping` (
  `id_mas_performance_mapping` int(11) NOT NULL,
  `id_performance_indicator` int(11) NOT NULL,
  `performance_type` set('bidang','individu') DEFAULT NULL,
  `id_organization_item` int(11) NOT NULL,
  PRIMARY KEY (`id_mas_performance_mapping`),
  KEY `fk_mas_performance_mapping_organization_item1_idx` (`id_organization_item`),
  KEY `fk_mas_performance_mapping_performance_indicator1_idx` (`id_performance_indicator`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mas_perspective`
--

CREATE TABLE IF NOT EXISTS `mas_perspective` (
  `id_mas_perspective` int(11) NOT NULL,
  `perspective` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mas_perspective`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_perspective`
--

INSERT INTO `mas_perspective` (`id_mas_perspective`, `perspective`) VALUES
(1, 'FINANCIAL'),
(2, 'CUSTOMER'),
(3, 'INTERNAL BUSINESS PROCESS'),
(4, 'LEARNING & GROWTH');

-- --------------------------------------------------------

--
-- Table structure for table `mas_project_status`
--

CREATE TABLE IF NOT EXISTS `mas_project_status` (
  `id_mas_project_status` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mas_project_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_project_status`
--

INSERT INTO `mas_project_status` (`id_mas_project_status`, `status`) VALUES
(1, 'On Going'),
(2, 'Close');

-- --------------------------------------------------------

--
-- Table structure for table `mas_research_content`
--

CREATE TABLE IF NOT EXISTS `mas_research_content` (
  `id_mas_research_content` int(11) NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `content_type` varchar(45) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id_mas_research_content`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mas_research_group`
--

CREATE TABLE IF NOT EXISTS `mas_research_group` (
  `id_mas_research_group` int(11) NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `type` set('techincal','business') DEFAULT NULL,
  PRIMARY KEY (`id_mas_research_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mas_research_type`
--

CREATE TABLE IF NOT EXISTS `mas_research_type` (
  `id_mas_research_type` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mas_research_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_research_type`
--

INSERT INTO `mas_research_type` (`id_mas_research_type`, `type`) VALUES
(1, 'Dokumen Bisnis'),
(2, 'Dokumen Teknis'),
(3, 'Innovation'),
(4, 'Aplikasi'),
(5, 'Prototype');

-- --------------------------------------------------------

--
-- Table structure for table `mas_review_type`
--

CREATE TABLE IF NOT EXISTS `mas_review_type` (
  `id_mas_review_type` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mas_review_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_review_type`
--

INSERT INTO `mas_review_type` (`id_mas_review_type`, `type`) VALUES
(1, 'Laporan Stream Mingguan'),
(2, 'Laporan Eksekutif');

-- --------------------------------------------------------

--
-- Table structure for table `mas_strategic_initiative`
--

CREATE TABLE IF NOT EXISTS `mas_strategic_initiative` (
  `id_mas_strategic_initiative` int(11) NOT NULL,
  `strategic_initiative` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_mas_strategic_initiative`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mas_strategic_objective`
--

CREATE TABLE IF NOT EXISTS `mas_strategic_objective` (
  `id_mas_strategic_objective` int(11) NOT NULL,
  `strategic_objective` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_mas_strategic_objective`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_strategic_objective`
--

INSERT INTO `mas_strategic_objective` (`id_mas_strategic_objective`, `strategic_objective`) VALUES
(1, 'Increase Productivity');

-- --------------------------------------------------------

--
-- Table structure for table `mas_times_category`
--

CREATE TABLE IF NOT EXISTS `mas_times_category` (
  `id_mas_times_category` int(11) NOT NULL,
  `category` varchar(20) DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id_mas_times_category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_times_category`
--

INSERT INTO `mas_times_category` (`id_mas_times_category`, `category`, `description`) VALUES
(1, 'Telecomunication', ''),
(2, 'Information', ''),
(3, 'Media', ''),
(4, 'Education', ''),
(5, 'Service', '');

-- --------------------------------------------------------

--
-- Table structure for table `mas_title`
--

CREATE TABLE IF NOT EXISTS `mas_title` (
  `id_mas_title` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mas_title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_title`
--

INSERT INTO `mas_title` (`id_mas_title`, `title`) VALUES
(1, 'SENIOR GENERAL MANAGER INNOVATION & DESIGN CE'),
(2, 'DEPUTY SGM INNOVATION & DESIGN CENTER'),
(3, 'SENIOR MANAGER INNOVATION MANAGEMENT'),
(4, 'RESEARCHER BROADBAND COMMUNICATION SERVICE'),
(5, 'MANAGER BUSINESS & PROGRAM PLANNING'),
(6, 'OFFICER 1 STRATEGIC PLANNING'),
(7, 'OFFICER 1 BUDGETING, PROGRAM PLANNING & MONIT'),
(8, 'OFFICER 1 INNOVATION PROGRAM PLANNING & MONIT'),
(9, 'OFFICER 2 INNOVATION PROGRAM PLANNING & MONIT'),
(10, 'MANAGER PERFORMANCE MANAGEMENT'),
(11, 'OFFICER 1 PERFORMANCE EVALUATION & ANALYSIS'),
(12, 'OFFICER 1 BUSINESS PROCESS AUDIT'),
(13, 'OFFICER 1 PERFORMANCE MEASUREMENT & ANALYSIS'),
(14, 'MANAGER INNOVATION & ENTERPRENEURSHIP'),
(15, 'OFFICER 1 INCUBATION PROGRAM PLANNING'),
(16, 'OFFICER 1 INCUBATION PROGRAM MONITORING'),
(17, 'OFFICER 1 INCUBATION PROGRAM ASSESSMENT'),
(18, 'MANAGER QUALITY MANAGEMENT & RESEARCH SYNERGY'),
(19, 'OFFICER 1 QUALITY EVALUATION & ANALISYS'),
(20, 'OFFICER 1 QUALITY MANAGEMENT PROGRAM'),
(21, 'OFFICER 1 PROGRAM SYNERGY PLANNING & EVALUATI'),
(22, 'SENIOR MANAGER DIGITAL LIFESTYLE ECOSYSTEM'),
(23, 'RESEARCHER DIGITAL ECOSYSTEM ANALISYS'),
(24, 'RESEARCHER DIGITAL ECOSYSTEM DEVELOPMENT'),
(25, 'RESEARCHER DIGITAL SERVICE PLATFORM'),
(26, 'MANAGER DIGITAL MEDIA'),
(27, 'ENGINEER 2 DIGITAL MEDIA DESIGN'),
(28, 'MANAGER DIGITAL HOME'),
(29, 'ENGINEER 1 DIGITAL HOME DESIGN'),
(30, 'MANAGER DIGITAL ENTERTAINMENT'),
(31, 'ENGINEER 1 DIGITAL ENTERTAINMENT PRODUCT'),
(32, 'ENGINEER 1 DIGITAL ENTERTAINMENT DESIGN'),
(33, 'ENGINEER 3 DIGITAL ENTERTAINMENT DESIGN'),
(34, 'MANAGER DIGITAL LIFESTYLE PLATFORM'),
(35, 'ENGINEER 1 DIGITAL LIFESTYLE PLATFORM ANALYSI'),
(36, 'ENGINEER 2 DIGITAL LIFESTYLE PLATFORM DEVELOP'),
(37, 'SENIOR MANAGER DIGITAL SOLUTION ECOSYSTEM'),
(38, 'RESEARCHER DIGITAL ECOSYSTEM ANALISYS'),
(39, 'RESEARCHER DIGITAL ECOSYSTEM DEVELOPMENT'),
(40, 'RESEARCHER DIGITAL SERVICE PLATFORM'),
(41, 'MANAGER DIGITAL HOSPITALITY'),
(42, 'ENGINEER 1 DIGITAL HOSPITALITY BUSINESS'),
(43, 'ENGINEER 1 DIGITAL HOSPITALITY PRODUCT'),
(44, 'ENGINEER 2 DIGITAL HOSPITALITY DESIGN'),
(45, 'ENGINEER 3 DIGITAL HOSPITALITY DESIGN'),
(46, 'MANAGER DIGITAL GOVERNMENT & EDUCATION'),
(47, 'ENGINEER 1 DIGITAL GOVERNMENT & EDUCATION BUS'),
(48, 'ENGINEER 2 DIGITAL GOVERNMENT & EDUCATION DES'),
(49, 'ENGINEER 1 DIGITAL GOVERNMENT & EDUCATION PRO'),
(50, 'MANAGER DIGITAL SUPPLY CHAIN & UTILITIES'),
(51, 'ENGINEER 1 DIGITAL SUPPLY CHAIN & UTILITIES P'),
(52, 'ENGINEER 3 DIGITAL SUPPLY CHAIN & UTILITIES D'),
(53, 'MANAGER SOLUTION PLATFORM'),
(54, 'ENGINEER 1 DIGITAL SOLUTION PLATFORM ANALYSIS'),
(55, 'ENGINEER 1 DIGITAL SOLUTION PLATFORM DEVELOPM'),
(56, 'ENGINEER 2 DIGITAL SOLUTION PLATFORM DEVELOPM'),
(57, 'SENIOR MANAGER MOBILE ECOSYSTEM'),
(58, 'MANAGER MOBILE IT & SERVICE PLATFORM'),
(59, 'ENGINEER 3 MOBILE IT & SERVICE PLATFORM'),
(60, 'MANAGER WIRELESS ACCESS TECHNOLOGY'),
(61, 'SENIOR MANAGER INFRASTRUCTURE RESEARCH & DEVE'),
(62, 'RESEARCHER SERVICE NODE PLATFORM'),
(63, 'RESEARCHER BROADBAND CORE NETWORK'),
(64, 'RESEARCHER FIXED BROADBAND ACCESS'),
(65, 'RESEARCHER CORE IT & SECURITY SYSTEM'),
(66, 'RESEARCHER BROADBAND COMMUNICATION SERVICE'),
(67, 'MANAGER NODE PLATFORM'),
(68, 'ENGINEER 2 MULTIMEDIA SERVICE CONTROL'),
(69, 'ENGINEER 3 MULTIMEDIA SERVICE CONTROL'),
(70, 'ENGINEER 1 SERVICE DELIVERY PLATFORM'),
(71, 'ENGINEER 1 COMMUNICATION CONTROL'),
(72, 'MANAGER BROADBAND COMMUNICATION SERVICES'),
(73, 'ENGINEER 1 BROADBAND COMMUNICATION SERVICES'),
(74, 'ENGINEER 2 BROADBAND COMMUNICATION SERVICES'),
(75, 'ENGINEER 3 NETWORK CONNECTIVITY SERVICES'),
(76, 'ENGINEER 1 NETWORK CONNECTIVITY SERVICES'),
(77, 'MANAGER FIXED BROADBAND ACCESS'),
(78, 'ENGINEER 1 WIRELINE MEDIA & CABLING SYSTEM'),
(79, 'ENGINEER 1 BROADBAND WIRELINE SYSTEM'),
(80, 'ENGINEER 3 BROADBAND WIRELINE SYSTEM'),
(81, 'MANAGER CORE IT & SECURITY SYSTEM'),
(82, 'ENGINEER 1 SECURTY & RELIABILITY SYSTEM'),
(83, 'ENGINEER 2 SECURITY & RELIABILITY SYSTEM'),
(84, 'MANAGER BROADBAND CORE NETWORK '),
(85, 'ENGINEER 1 IP & METRO NETWORK'),
(86, 'ENGINEER 1 BROADBAND TRANSMISSION SYSTEM'),
(87, 'ENGINEER 2 IP & METRO NETWORK'),
(88, 'SENIOR MANAGER PRODUCT & INFRASTRUCTURE ASSUR'),
(89, 'RESEARCHER DIGITAL ECOSYSTEM ANALISYS'),
(90, 'RESEARCHER SYSTEM QUALITY ASSURANCE'),
(91, 'RESEARCHER SYSTEM INTEGRATION & READINESS'),
(92, 'RESEARCHER DIGITAL ECOSYSTEM DEVELOPMENT'),
(93, 'MANAGER PRODUCT QUALITY ASSURANCE'),
(94, 'ENGINEER 1 PRODUCT QUALITY ASSESSMENT'),
(95, 'MANAGER INFRASTRUCTURE QUALITY ASSURANCE'),
(96, 'ENGINEER 1 TRANSMISSION QUALITY ASSURANCE'),
(97, 'ENGINEER 1 FO & CABLE QUALITY ASSURANCE'),
(98, 'ENGINEER 1 QUALITY ASSURANCE CALIBRATION'),
(99, 'ENGINEER 2 FO & CABLE QUALITY ASSURANCE'),
(100, 'MANAGER DEVICE & ENERGY QUALITY ASSURANCE'),
(101, 'ENGINEER 1 DEVICE & ENERGY QUALITY ASSURANCE '),
(102, 'ENGINEER 1 ME & ENERGY QUALITY ASSURANCE'),
(103, 'MANAGER SYSTEM INTEGRATION & READINESS'),
(104, 'ENGINEER 1 SYSTEM INTEGRATION PLANNING & DESI'),
(105, 'MANAGER PRODUCT & INFRASTRUCTURE EXPERIENCE'),
(106, 'ENGINEER 1 INNOVATION INFORMATION SYSTEM'),
(107, 'ENGINEER 1 TEST BED SYSTEM & MANAGEMENT'),
(108, 'ENGINEER 1 TEST BED SYSTEM & MANAGEMENT'),
(109, 'SENIOR MANAGER GENERAL AFFAIRS'),
(110, 'MANAGER SECRETARIATE & RESOURCE DEVELOPMENT'),
(111, 'OFFICER 1 SECRETARIATE'),
(112, 'OFFICER 1 FACILITY MANAGEMENT'),
(113, 'OFFICER 1 RESOURCE PLANNING & DEVELOPMENT'),
(114, 'OFFICER 1 RELATION & COMMUNICATION'),
(115, 'OFFICER 2 FACILITY MANAGEMENT'),
(116, 'OFFICER 2 SECRETARIATE ADMINISTRATION'),
(117, 'MANAGER LOGISTIC & ASSET MANAGEMENT'),
(118, 'OFFICER 1 LOGISTIC PLANNING PROCUREMENT'),
(119, 'OFFICER 1 PROCUREMENT PROCESS'),
(120, 'OFFICER 2 ASSET MANAGEMENT'),
(121, 'MANAGER USER RELATION'),
(122, 'OFFICER 1 CUSTOMER CARE'),
(123, 'OFFICER 2 INVOICE & COLLECTION'),
(124, 'OFFICER 2 CUSTOMER RELATIONSHIP'),
(125, 'MANAGER BUSINESS LEGAL SUPPORT'),
(126, 'OFFICER 1 LEGAL COMPLIANCE'),
(127, 'OFFICER 1 CONTRACT DRAFTER & ADMINISTRATON');

-- --------------------------------------------------------

--
-- Table structure for table `mas_training_type`
--

CREATE TABLE IF NOT EXISTS `mas_training_type` (
  `id_mas_training_type` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mas_training_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Notification`
--

CREATE TABLE IF NOT EXISTS `Notification` (
  `id_notification` int(11) NOT NULL,
  `timestamp` varchar(45) DEFAULT NULL,
  `notification_type` varchar(45) DEFAULT NULL,
  `param` varchar(45) DEFAULT NULL,
  `link` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_notification`,`id_user`),
  KEY `fk_Notification_user1_idx` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization_item`
--

CREATE TABLE IF NOT EXISTS `organization_item` (
  `id_organization_item` int(11) NOT NULL,
  `org_name` varchar(100) DEFAULT NULL,
  `description` text,
  `level` set('unit','subunit','lab') DEFAULT NULL,
  `id_organization_item_parent` int(11) DEFAULT NULL,
  `abbreviation` varchar(10) DEFAULT NULL,
  `row` int(11) NOT NULL,
  PRIMARY KEY (`id_organization_item`),
  KEY `fk_organization_item_organization_item1_idx` (`id_organization_item_parent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organization_item`
--

INSERT INTO `organization_item` (`id_organization_item`, `org_name`, `description`, `level`, `id_organization_item_parent`, `abbreviation`, `row`) VALUES
(1, 'DIGITAL LIFESTYLE ECOSYSTEM', NULL, 'subunit', 3, 'DLE', 3),
(2, 'SENIOR GENERAL MANAGER INNOVATION & DESIGN CENTER', NULL, 'unit', NULL, 'SGM', 1),
(3, 'DEPUTY SGM INNOVATION & DESIGN CENTER', NULL, 'unit', 2, 'DSGM', 2),
(4, 'INNOVATION MANAGEMENT', NULL, 'subunit', 3, 'IM', 3),
(5, 'INFRASTRUCTURE RESEARCH & DEVELOPMENT', NULL, 'subunit', 3, 'IRD', 3),
(6, 'PRODUCT INFRASTRUCTURE ASSURANCE', NULL, 'subunit', 3, 'PIA', 3),
(8, 'DIGITAL SOLUTION ECOSYSTEM', NULL, 'subunit', 3, 'DSE', 3),
(9, 'GENERAL AFFAIRS', NULL, 'subunit', 3, 'GA', 3),
(10, 'MOBILE ECOSYSTEM', NULL, 'subunit', 3, 'ME', 3),
(11, 'M2M DIGITAL ECOSYSTEM', NULL, 'subunit', 3, 'M2M', 3),
(12, 'Business & Program Planning', NULL, 'lab', 4, 'BPP', 0),
(13, 'Performance Management', NULL, 'lab', 4, 'PM', 0),
(14, 'Quality Management & Research Synergy', NULL, 'lab', 4, 'QMRS', 0),
(15, 'Innovation & Entrepreneurship', NULL, 'lab', 4, 'IM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `partnership`
--

CREATE TABLE IF NOT EXISTS `partnership` (
  `id_partnership` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `number` varchar(45) DEFAULT NULL,
  `description` text,
  `partner` varchar(255) DEFAULT NULL,
  `budget` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `signature_date` date DEFAULT NULL,
  `id_organization_item_initiator` int(11) NOT NULL,
  `id_program` int(11) DEFAULT NULL,
  `id_mas_project_status` int(11) NOT NULL,
  `partnership_category` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_partnership`),
  KEY `fk_partnership_organization_item1_idx` (`id_organization_item_initiator`),
  KEY `fk_partnership_program1_idx` (`id_program`),
  KEY `fk_partnership_mas_project_status1_idx` (`id_mas_project_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `partnership_activity`
--

CREATE TABLE IF NOT EXISTS `partnership_activity` (
  `id_partnership_activity` int(11) NOT NULL,
  `activity_name` varchar(255) DEFAULT NULL,
  `sow` varchar(255) DEFAULT NULL,
  `deliverable` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `pic_idec` varchar(255) DEFAULT NULL,
  `id_partnership` int(11) NOT NULL DEFAULT '0',
  `pic_user` varchar(255) DEFAULT NULL,
  `realization` float DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_partnership_activity`,`id_partnership`),
  KEY `fk_partnership_activity_partnership1_idx` (`id_partnership`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `partnership_document`
--

CREATE TABLE IF NOT EXISTS `partnership_document` (
  `id_partnership_document` int(11) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `id_mas_partnership_document_type` int(11) NOT NULL,
  `id_partnership` int(11) NOT NULL,
  PRIMARY KEY (`id_partnership_document`,`id_partnership`),
  KEY `fk_partnership_document_mas_partnership_document_type1_idx` (`id_mas_partnership_document_type`),
  KEY `fk_partnership_document_partnership1_idx` (`id_partnership`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `partnership_information`
--

CREATE TABLE IF NOT EXISTS `partnership_information` (
  `id_partnership_information` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `title` text,
  `content` text,
  `id_partnership` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_partnership_information`,`id_partnership`,`id_user`),
  KEY `fk_partnership_information_partnership1_idx` (`id_partnership`),
  KEY `fk_partnership_information_user1_idx` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `performance_evidence`
--

CREATE TABLE IF NOT EXISTS `performance_evidence` (
  `id_performance_evidence` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `id_performance_system` int(11) NOT NULL,
  PRIMARY KEY (`id_performance_evidence`),
  KEY `fk_performance_evidence_performance_system1_idx` (`id_performance_system`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `performance_indicator`
--

CREATE TABLE IF NOT EXISTS `performance_indicator` (
  `id_performance_indicator` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `measure_definition` text,
  `evidence` text,
  `id_annual_data` int(11) DEFAULT NULL,
  `id_program` int(11) DEFAULT NULL,
  `id_mas_strategic_objective` int(11) NOT NULL,
  `id_mas_key_performance` int(11) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  `id_mas_strategic_initiative` int(11) DEFAULT NULL,
  `indicator_type` set('common','shared','specific') DEFAULT NULL,
  PRIMARY KEY (`id_performance_indicator`),
  KEY `fk_performance_indicator_yearly_performance1_idx` (`id_annual_data`),
  KEY `fk_performance_indicator_program1_idx` (`id_program`),
  KEY `fk_performance_indicator_mas_strategic_objective1_idx` (`id_mas_strategic_objective`),
  KEY `fk_performance_indicator_mas_key_performance1_idx` (`id_mas_key_performance`),
  KEY `fk_performance_indicator_mas_strategic_initiative1_idx` (`id_mas_strategic_initiative`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `performance_indicator`
--

INSERT INTO `performance_indicator` (`id_performance_indicator`, `name`, `description`, `measure_definition`, `evidence`, `id_annual_data`, `id_program`, `id_mas_strategic_objective`, `id_mas_key_performance`, `is_default`, `id_mas_strategic_initiative`, `indicator_type`) VALUES
(1, 'Pengendalian Beban Internal', 'Pengendalian Beban Internal 1', '%', 'Evidence', NULL, 2, 1, NULL, 0, NULL, 'shared'),
(2, 'CSI Mitra', 'CSI Mitra', '%', 'Evidence', NULL, 2, 1, NULL, 0, NULL, 'shared'),
(3, 'asd', 'asd', 'asd', 'asd', NULL, 2, 1, NULL, 0, NULL, 'shared');

-- --------------------------------------------------------

--
-- Table structure for table `performance_quartal`
--

CREATE TABLE IF NOT EXISTS `performance_quartal` (
  `id_performance_quartal` int(11) NOT NULL,
  `period` tinyint(4) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `target` float DEFAULT NULL,
  `achievement_raw` float DEFAULT NULL,
  `achievement` float DEFAULT NULL,
  `accomplishment` float DEFAULT NULL,
  `deviation` float DEFAULT NULL,
  `id_performance_system_item` int(11) NOT NULL,
  `analysis` text,
  `recommendation` text,
  `evaluation` text,
  `id_target` int(11) DEFAULT NULL,
  `budget_realization` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_performance_quartal`,`id_performance_system_item`),
  KEY `fk_performance_quartal_performance_system_item1_idx` (`id_performance_system_item`),
  KEY `fk_performance_quartal_target1_idx` (`id_target`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `performance_quartal`
--

INSERT INTO `performance_quartal` (`id_performance_quartal`, `period`, `weight`, `target`, `achievement_raw`, `achievement`, `accomplishment`, `deviation`, `id_performance_system_item`, `analysis`, `recommendation`, `evaluation`, `id_target`, `budget_realization`) VALUES
(12, 4, 10, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(11, 3, 10, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(10, 2, 5, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(9, 1, 10, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(20, 4, 5, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL),
(19, 3, 10, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL),
(18, 2, 15, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL),
(17, 1, 10, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL),
(13, 1, 100, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL),
(14, 2, 100, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL),
(15, 3, 100, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL),
(16, 4, 100, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL),
(21, 1, 100, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL),
(22, 2, 100, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL),
(23, 3, 100, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL),
(24, 4, 100, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL),
(25, 1, 100, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL),
(26, 2, 100, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL),
(27, 3, 100, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL),
(28, 4, 100, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL),
(32, 4, 10, NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL),
(31, 3, 10, NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL),
(30, 2, 10, NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL),
(29, 1, 10, NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `performance_realization`
--

CREATE TABLE IF NOT EXISTS `performance_realization` (
  `id_performance_realization` int(11) NOT NULL,
  `realization` varchar(45) DEFAULT NULL,
  `id_performance_quartal` int(11) NOT NULL,
  `id_target_item` int(11) NOT NULL,
  PRIMARY KEY (`id_performance_realization`,`id_performance_quartal`),
  KEY `fk_performance_realization_performance_quartal1_idx` (`id_performance_quartal`),
  KEY `fk_performance_realization_target_item1_idx` (`id_target_item`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `performance_system`
--

CREATE TABLE IF NOT EXISTS `performance_system` (
  `id_performance_system` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `id_organization_item` int(11) DEFAULT NULL,
  `id_employee` int(11) DEFAULT NULL,
  `limit_max` float DEFAULT NULL,
  `limit_min` float DEFAULT NULL,
  `id_annual_data` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_performance_system`),
  KEY `fk_performance_system_organization_item1_idx` (`id_organization_item`),
  KEY `fk_performance_system_employee1_idx` (`id_employee`),
  KEY `fk_performance_system_yearly_performance1_idx` (`id_annual_data`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `performance_system`
--

INSERT INTO `performance_system` (`id_performance_system`, `name`, `date`, `id_organization_item`, `id_employee`, `limit_max`, `limit_min`, `id_annual_data`) VALUES
(1, 'Innovation Management', '2015-06-03', 4, 0, 150, 60, NULL),
(2, 'as', '2015-06-04', 6, 0, 150, 60, NULL),
(3, 'tes 123', '2015-06-04', 6, 0, 150, 60, NULL),
(4, 'dddd', '2015-06-04', 1, 0, 150, 60, NULL),
(5, '', '2015-06-05', NULL, 5, 150, 60, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `performance_system_item`
--

CREATE TABLE IF NOT EXISTS `performance_system_item` (
  `id_performance_system_item` int(11) NOT NULL,
  `id_performance_system` int(11) NOT NULL,
  `id_performance_indicator` int(11) NOT NULL,
  `id_performance_system_item_parent` int(11) DEFAULT NULL,
  `id_mas_perspective` int(11) NOT NULL,
  PRIMARY KEY (`id_performance_system_item`,`id_performance_indicator`),
  KEY `fk_performance_system_item_performance_system1_idx` (`id_performance_system`),
  KEY `fk_performance_system_item_performance_indicator1_idx` (`id_performance_indicator`),
  KEY `fk_performance_system_item_performance_system_item1_idx` (`id_performance_system_item_parent`),
  KEY `fk_performance_system_item_mas_perspective1_idx` (`id_mas_perspective`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `performance_system_item`
--

INSERT INTO `performance_system_item` (`id_performance_system_item`, `id_performance_system`, `id_performance_indicator`, `id_performance_system_item_parent`, `id_mas_perspective`) VALUES
(1, 1, 1, 0, 1),
(2, 1, 2, 0, 2),
(3, 1, 2, 0, 3),
(4, 1, 2, 0, 1),
(5, 1, 1, 0, 4),
(6, 2, 3, 0, 1),
(7, 2, 3, 0, 1),
(8, 1, 2, 0, 2),
(9, 1, 3, 0, 2),
(10, 4, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE IF NOT EXISTS `program` (
  `id_program` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `program_description` text,
  `output` varchar(45) DEFAULT NULL,
  `user` varchar(45) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `quartal` varchar(45) DEFAULT NULL,
  `primary_program` tinyint(1) DEFAULT NULL,
  `deliverable` text,
  `KPI` text,
  `implementation_strategy` text,
  `strategic_initative` varchar(45) DEFAULT NULL,
  `id_organization_item` int(11) NOT NULL,
  `id_employee_po` int(11) DEFAULT NULL,
  `id_employee_pm` int(11) DEFAULT NULL,
  `id_annual_data` int(11) DEFAULT NULL,
  `show_on_review` tinyint(1) DEFAULT NULL,
  `id_mas_project_status` int(11) NOT NULL,
  `id_mas_research_type` int(11) NOT NULL,
  `budget` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_program`),
  KEY `fk_program_organization_item1_idx` (`id_organization_item`),
  KEY `fk_program_employee1_idx` (`id_employee_po`),
  KEY `fk_program_employee2_idx` (`id_employee_pm`),
  KEY `fk_program_yearly_performance1_idx` (`id_annual_data`),
  KEY `fk_program_mas_project_status1_idx` (`id_mas_project_status`),
  KEY `fk_program_mas_research_type1_idx` (`id_mas_research_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id_program`, `name`, `program_description`, `output`, `user`, `start_date`, `end_date`, `quartal`, `primary_program`, `deliverable`, `KPI`, `implementation_strategy`, `strategic_initative`, `id_organization_item`, `id_employee_po`, `id_employee_pm`, `id_annual_data`, `show_on_review`, `id_mas_project_status`, `id_mas_research_type`, `budget`) VALUES
(1, 'Seleksi Indigo Incubator', 'Inkubasi test', '', '', '2015-05-26', '2015-05-31', 'TW IV', NULL, '# of incubation proposal\r\n# of Incubated Start Ups\r\n# of Validated Products\r\n# of Validated Business Model', '400 of incubation proposals\r\n- Incubated StartUp : 30 (BDV=20, JDV=10)\r\n- Validated Products : 20\r\n- Validated Business Model : 10', '- Roadshow (socialization),\r\n- Partnering with MIKTI (Running the Incubation)\r\n- Partnering with Global Incubators (Global Mentor)', 'SI-1 Center of Excellent', 1, 1, 1, 0, 0, 1, 3, 500000000),
(2, 'Update dan rolling strategic plan RDC', '', 'Kajian strategic plan1', 'qq', '2015-01-02', '2015-06-12', 'TW II', 1, '# of incubation proposal1\r\n# of Incubated Start Ups\r\n# of Validated Products\r\n# of Validated Business Model', '400 of incubation proposals1\r\n- Incubated StartUp : 30 (BDV=20, JDV=10)\r\n- Validated Products : 20\r\n- Validated Business Model : 10', '- Roadshow (socialization),1\r\n- Partnering with MIKTI (Running the Incubation)\r\n- Partnering with Global Incubators (Global Mentor)', 'SI-1 Center of Excellent1', 13, NULL, NULL, 0, 0, 1, 1, 9999991),
(3, 'Seleksi Indigo Incubator', 'Inkubasi', 'Output', 'RDC', '2015-01-01', '2015-05-31', 'TW IV', 1, '# of incubation proposal\r\n# of Incubated Start Ups\r\n# of Validated Products\r\n# of Validated Business Model', '400 of incubation proposals\r\n- Incubated StartUp : 30 (BDV=20, JDV=10)\r\n- Validated Products : 20\r\n- Validated Business Model : 10', '- Roadshow (socialization),\r\n- Partnering with MIKTI (Running the Incubation)\r\n- Partnering with Global Incubators (Global Mentor)', 'SI-1 Center of Excellent', 15, 5, 5, 0, 0, 1, 3, 999999999),
(4, 'Program Name', 'Program Name deskirpsi', 'Ouput Program', 'RDC', '2015-06-16', '2015-07-03', 'TW I', 1, 'Deliverable', 'KPI', 'Strategy', 'Initiative', 13, 4, 4, 0, 0, 1, 3, 90000000),
(5, 'asdasd', 'asd asd', 'asd', 'asd', '0000-00-00', '0000-00-00', 'TW II', NULL, 'd', 'w', 'q', '3', 13, 0, 0, 0, 0, 1, 2, 22222),
(6, 'adfsafas', 'description', 'Output', 'RDC', '2015-06-27', '2015-07-02', 'TW I', NULL, 'Deliver', 'KPI', 'startegy', 'initiative', 1, 7, 7, 0, 0, 1, 4, 999999999),
(7, 'Tes 2', 'adasd', '11', 'aa', '0000-00-00', '0000-00-00', 'TW I', NULL, 'asd', 'sd', 'aa', 'wd', 13, 0, 0, 0, 0, 1, 4, 1111);

-- --------------------------------------------------------

--
-- Table structure for table `program_target`
--

CREATE TABLE IF NOT EXISTS `program_target` (
  `id_program_target` int(11) NOT NULL AUTO_INCREMENT,
  `id_program` int(11) NOT NULL,
  `id_target` int(11) NOT NULL,
  PRIMARY KEY (`id_program_target`),
  KEY `fk_program_target_program1_idx` (`id_program`),
  KEY `fk_program_target_target1_idx` (`id_target`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `program_target`
--

INSERT INTO `program_target` (`id_program_target`, `id_program`, `id_target`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id_project` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `project_description` text,
  `weight` float DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `percent_progress` float DEFAULT NULL,
  `last_progress_update` datetime DEFAULT NULL,
  `id_program` int(11) DEFAULT NULL,
  `id_organization_item` int(11) NOT NULL,
  `id_annual_data` int(11) NOT NULL,
  `id_mas_project_status` int(11) NOT NULL,
  `id_mas_times_category` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_project`),
  KEY `fk_project_program1_idx` (`id_program`),
  KEY `fk_project_organization_item1_idx` (`id_organization_item`),
  KEY `fk_project_annual_data1_idx` (`id_annual_data`),
  KEY `fk_project_mas_project_status1_idx` (`id_mas_project_status`),
  KEY `fk_project_mas_times_category1_idx` (`id_mas_times_category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id_project`, `name`, `project_description`, `weight`, `start_date`, `end_date`, `percent_progress`, `last_progress_update`, `id_program`, `id_organization_item`, `id_annual_data`, `id_mas_project_status`, `id_mas_times_category`) VALUES
(2, 'Indigo Incubator 2', 'Indikator yang menunjukkan kemampuan RDC dalam penjaringan ide untuk inkubasi yang meliputi aktifitas penyeleksian proposal, proses inkubasi sampai siap dilakukan proses Market validation.', 100, '2015-01-01', '2015-12-16', 0, '2015-05-28 22:36:59', 1, 4, 0, 1, 1),
(3, 'Indigo Incubator 3', 'desccc', 100, '2015-01-01', '2015-12-18', 0, '2015-06-05 03:32:11', 1, 4, 0, 1, 1),
(4, 'Incubator Startup 4', 'Incubator Startup 4', 100, '2015-06-01', '2015-07-17', 0, '2015-05-29 16:55:17', 1, 4, 0, 1, 1),
(5, 'asd', 'asd ss', 11, '2015-06-04', '2015-06-18', 0, '2015-06-04 22:22:54', 1, 4, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_step`
--

CREATE TABLE IF NOT EXISTS `project_step` (
  `id_project_step` int(11) NOT NULL AUTO_INCREMENT,
  `step_name` varchar(255) DEFAULT NULL,
  `step_description` text,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `id_project` int(11) NOT NULL,
  `weight` float DEFAULT NULL,
  PRIMARY KEY (`id_project_step`,`id_project`),
  KEY `fk_project_step_project1_idx` (`id_project`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `project_step`
--

INSERT INTO `project_step` (`id_project_step`, `step_name`, `step_description`, `start_date`, `end_date`, `id_project`, `weight`) VALUES
(7, 'asdasdsd', 'asd asd', '2015-06-04', '2015-06-04', 3, 11),
(4, 'Validated Products', 'validated products', '2016-01-03', '2016-01-06', 2, 100),
(5, 'Validated Business Model', 'Validated Business Model', '2016-01-11', '2015-12-18', 2, 20),
(6, 'Step 11', 'asda', '2015-06-04', '2015-06-04', 5, 50),
(8, 'Step 22', 'dasd', '2015-06-05', '2015-06-05', 5, 11);

-- --------------------------------------------------------

--
-- Table structure for table `QA_product`
--

CREATE TABLE IF NOT EXISTS `QA_product` (
  `id_qa_product` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(45) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `executive_summary` text,
  `conclusion` text,
  `testing_recomendation` text,
  `tester_name` varchar(200) DEFAULT NULL,
  `information` text,
  PRIMARY KEY (`id_qa_product`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `QA_product`
--

INSERT INTO `QA_product` (`id_qa_product`, `product_name`, `start_date`, `end_date`, `executive_summary`, `conclusion`, `testing_recomendation`, `tester_name`, `information`) VALUES
(4, 'test123dd', '0000-00-00', '0000-00-00', 'testt123 ss', 'testest hm', 'test', 'testst', 'teetst'),
(5, 'hmmm', '2015-01-01', '2015-01-01', '1', '2', '3', '4', '5');

-- --------------------------------------------------------

--
-- Table structure for table `QA_product_document`
--

CREATE TABLE IF NOT EXISTS `QA_product_document` (
  `id_qa_product_document` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) DEFAULT NULL,
  `description` text,
  `received_date` date DEFAULT NULL,
  `id_qa_product` int(11) NOT NULL,
  PRIMARY KEY (`id_qa_product_document`,`id_qa_product`),
  KEY `fk_QA_product_document_QA_product1_idx` (`id_qa_product`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `QA_product_document`
--

INSERT INTO `QA_product_document` (`id_qa_product_document`, `file`, `description`, `received_date`, `id_qa_product`) VALUES
(4, '77a365109362ebbed04f62a9cdf294c6.xlsx', 'test', NULL, 4),
(5, '304e8a242864360055391e9997cc11d7.xlsx', 'test', '0000-00-00', 4),
(6, 'fcbf20270ee024fe1b39c9c01633f580.xls', 'er', '2015-06-05', 4),
(7, NULL, '', '0000-00-00', 4),
(8, 'c75706b2ca5c12149c055975a3f40b6c.pdf', 'asd', '0000-00-00', 4),
(9, '7ee3dd22ea0a21471e2ce8d1f6187c8e.pdf', 'ddd', '0000-00-00', 4),
(10, NULL, 's', '0000-00-00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

CREATE TABLE IF NOT EXISTS `research` (
  `id_research` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(45) DEFAULT NULL,
  `numbering_date` date DEFAULT NULL,
  `id_organization_item` int(11) NOT NULL,
  `id_mas_research_content` int(11) DEFAULT NULL,
  `id_mas_research_group` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `id_program` int(11) DEFAULT NULL,
  `id_mas_research_type` int(11) NOT NULL,
  `id_mas_project_status` int(11) NOT NULL,
  `research_team` text,
  `executive_summary` text,
  `summary_recomendation` text,
  `year` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_research`),
  KEY `fk_research_organization_item1_idx` (`id_organization_item`),
  KEY `fk_research_research_content1_idx` (`id_mas_research_content`),
  KEY `fk_research_research_group1_idx` (`id_mas_research_group`),
  KEY `fk_research_program1_idx` (`id_program`),
  KEY `fk_research_mas_research_type1_idx` (`id_mas_research_type`),
  KEY `fk_research_mas_project_status1_idx` (`id_mas_project_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `research_file`
--

CREATE TABLE IF NOT EXISTS `research_file` (
  `id_research_file` int(11) NOT NULL,
  `version` varchar(10) DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `date_accepted` date DEFAULT NULL,
  `document_upload` varchar(45) DEFAULT NULL,
  `id_research` int(11) NOT NULL,
  PRIMARY KEY (`id_research_file`,`id_research`),
  KEY `fk_research_document_research1_idx` (`id_research`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `research_utilization`
--

CREATE TABLE IF NOT EXISTS `research_utilization` (
  `id_research_utilization` int(11) NOT NULL,
  `utilization` text,
  `id_research` int(11) NOT NULL,
  PRIMARY KEY (`id_research_utilization`),
  KEY `fk_research_utilization_research1_idx` (`id_research`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `review_comment`
--

CREATE TABLE IF NOT EXISTS `review_comment` (
  `id_review_comment` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) DEFAULT NULL,
  `id_review_management` int(11) NOT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_review_comment`),
  KEY `fk_review_comment_review_management1_idx` (`id_review_management`),
  KEY `fk_review_comment_user1_idx` (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `review_comment`
--

INSERT INTO `review_comment` (`id_review_comment`, `content`, `id_review_management`, `timestamp`, `id_user`) VALUES
(1, 'Perlu ada evaluasi lebih lanjut mengenai program ini, apakah memang benar-benar dapat memberikan kontribusi terhadap pengembangan inovasi teknologi di Indonesia', 1, '2015-06-04 15:52:37', 1),
(2, 'hmm', 5, '2015-06-04 10:07:41', 1),
(3, 'hmdg', 5, '2015-06-04 10:08:34', 1),
(4, 'tes', 1, '2015-06-04 15:00:40', 1),
(5, 'test', 1, '2015-06-04 15:04:07', 1),
(6, 'ddasd', 1, '2015-06-04 15:08:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `review_management`
--

CREATE TABLE IF NOT EXISTS `review_management` (
  `id_review_management` int(11) NOT NULL AUTO_INCREMENT,
  `period` varchar(45) DEFAULT NULL,
  `id_program` int(11) NOT NULL,
  `id_mas_review_type` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `files` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_review_management`),
  KEY `fk_review_management_program1_idx` (`id_program`),
  KEY `fk_review_management_mas_review_type1_idx` (`id_mas_review_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `review_management`
--

INSERT INTO `review_management` (`id_review_management`, `period`, `id_program`, `id_mas_review_type`, `description`, `files`, `date`) VALUES
(7, '', 1, 2, NULL, 'dad03664cb7ff10b4e8e63b1f4fbb5b6.pdf', '2015-06-05 02:14:04'),
(3, '', 2, 1, NULL, 'eacb49fd4a19cb1e75bad209d316ffef.xls', '2015-06-04 09:38:35'),
(4, '', 3, 2, NULL, '51d19d669c8ceeab2beff238a0003b33.jpg', '2015-06-04 09:39:10'),
(8, '', 1, 1, NULL, '00440cc380f274d37e6e095649bb8d28.pdf', '2015-06-05 02:25:11'),
(9, '', 1, 1, NULL, '72a7cfe9983cfa6a2428b0894e1f47ff.pdf', '2015-06-05 02:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `target`
--

CREATE TABLE IF NOT EXISTS `target` (
  `id_target` int(11) NOT NULL,
  `period` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_target`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `target`
--

INSERT INTO `target` (`id_target`, `period`) VALUES
(1, 'TW I'),
(2, 'TW II'),
(3, 'TW IV'),
(4, 'TW III'),
(5, 'TW I');

-- --------------------------------------------------------

--
-- Table structure for table `target_item`
--

CREATE TABLE IF NOT EXISTS `target_item` (
  `id_target_item` int(11) NOT NULL,
  `target` varchar(45) DEFAULT NULL,
  `target_detail` varchar(45) DEFAULT NULL,
  `id_mas_metric` int(11) NOT NULL,
  `id_target` int(11) NOT NULL,
  PRIMARY KEY (`id_target_item`),
  KEY `fk_target_item_mas_metric1_idx` (`id_mas_metric`),
  KEY `fk_target_item_target1_idx` (`id_target`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `target_item`
--

INSERT INTO `target_item` (`id_target_item`, `target`, `target_detail`, `id_mas_metric`, `id_target`) VALUES
(1, '50', 'Rata rata jumlah user per bulan', 1, 1),
(2, '100', 'Rata rata jumlah user per bulan', 1, 2),
(3, '300', 'Rata rata jumlah user per bulan', 1, 3),
(4, '200', 'Rata rata jumlah user per bulan', 1, 4),
(5, 'AS', 'A', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE IF NOT EXISTS `training` (
  `id_training` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `start_time` date DEFAULT NULL,
  `organizer` varchar(255) DEFAULT NULL,
  `id_mas_training_type` int(11) NOT NULL,
  `id_mas_times_category` int(11) NOT NULL,
  PRIMARY KEY (`id_training`),
  KEY `fk_training_mas_training_type1_idx` (`id_mas_training_type`),
  KEY `fk_training_mas_times_category1_idx` (`id_mas_times_category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `training_employee`
--

CREATE TABLE IF NOT EXISTS `training_employee` (
  `id_training_employee` int(11) NOT NULL,
  `id_training` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL,
  PRIMARY KEY (`id_training_employee`),
  KEY `fk_training_employee_training1_idx` (`id_training`),
  KEY `fk_training_employee_employee1_idx` (`id_employee`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `login_count` int(11) DEFAULT NULL,
  `profile_pic` varchar(245) DEFAULT NULL,
  `id_user_level` int(11) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `fk_user_user_level1_idx` (`id_user_level`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `last_login`, `login_count`, `profile_pic`, `id_user_level`) VALUES
(1, 'admin', '8cb2237d0679ca88db6464eac60da96345513964', '2015-06-05 09:55:32', NULL, NULL, 1),
(2, 'researcher', '8cb2237d0679ca88db6464eac60da96345513964', '2015-06-04 12:32:08', NULL, NULL, 2),
(3, 'researcher2', '8cb2237d0679ca88db6464eac60da96345513964', '2015-05-28 19:09:45', NULL, NULL, 2),
(4, '12345', '8cb2237d0679ca88db6464eac60da96345513964', NULL, NULL, NULL, 2),
(5, '3123123', '2c9a921df94756bfcc8b0e276e25309b2cd48ad5', NULL, NULL, NULL, 2),
(6, '13124234', 'f43e8322911f6999cf2cb91e6d10f39b77411306', NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE IF NOT EXISTS `user_access` (
  `id_user_access` int(11) NOT NULL,
  `show` tinyint(1) DEFAULT NULL,
  `add` tinyint(1) DEFAULT NULL,
  `edit` tinyint(1) DEFAULT NULL,
  `delete` tinyint(1) DEFAULT NULL,
  `feature_name` varchar(45) DEFAULT NULL,
  `id_user_level` int(11) NOT NULL,
  `id_app_files` int(11) NOT NULL,
  PRIMARY KEY (`id_user_access`),
  KEY `fk_user_access_user_level1_idx` (`id_user_level`),
  KEY `fk_user_access_app_files1_idx` (`id_app_files`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE IF NOT EXISTS `user_level` (
  `id_user_level` int(11) NOT NULL,
  `level_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_user_level`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id_user_level`, `level_name`) VALUES
(1, 'super administrator'),
(2, 'researcher');

-- --------------------------------------------------------

--
-- Table structure for table `work_experience`
--

CREATE TABLE IF NOT EXISTS `work_experience` (
  `id_work_experience` int(11) NOT NULL,
  `work_type` set('work','research') DEFAULT NULL,
  `job_desk` mediumtext,
  `start_year` date DEFAULT NULL,
  `end_year` date DEFAULT NULL,
  `id_employee` int(11) NOT NULL,
  `id_mas_times_category` int(11) NOT NULL,
  `description` text,
  PRIMARY KEY (`id_work_experience`),
  KEY `fk_work_experience_employee_idx` (`id_employee`),
  KEY `fk_work_experience_mas_category1_idx` (`id_mas_times_category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
