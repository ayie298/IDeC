
CREATE TABLE IF NOT EXISTS `annual_data` (
`id_annual_data` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `app_theme_id_app_theme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `id_theme` int(10) DEFAULT NULL
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
  `folder` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `activity` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bantek`
--

CREATE TABLE IF NOT EXISTS `bantek` (
`id_bantek` int(11) NOT NULL,
  `user` varchar(250) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `id_mas_project_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bantek_document`
--

CREATE TABLE IF NOT EXISTS `bantek_document` (
`id_bantek_document` int(11) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `id_bantek` int(11) NOT NULL,
  `id_mas_partnership_document_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `id_bantek` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `id_bantek` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bantek_utilization`
--

CREATE TABLE IF NOT EXISTS `bantek_utilization` (
  `id_bantek_utilization` int(11) NOT NULL,
  `utilization` text,
  `id_bantek` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Bantek_work_unit_executor`
--

CREATE TABLE IF NOT EXISTS `Bantek_work_unit_executor` (
  `id_bantek_work_unit_executor` int(11) NOT NULL,
  `id_organization_item` int(11) NOT NULL,
  `id_bantek` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE IF NOT EXISTS `certificate` (
  `id_certificate` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `organizer` varchar(255) DEFAULT NULL,
  `id_mas_times_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`id_certificate`, `name`, `description`, `organizer`, `id_mas_times_category`) VALUES
(1, 'Service', NULL, NULL, 5),
(2, 'Telecomunication', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `certificate_employee`
--

CREATE TABLE IF NOT EXISTS `certificate_employee` (
`id_certificate_employee` int(11) NOT NULL,
  `cer_name` varchar(50) NOT NULL,
  `file_upload` varchar(45) DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `id_employee` int(11) NOT NULL,
  `id_certificate` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `certificate_employee`
--

INSERT INTO `certificate_employee` (`id_certificate_employee`, `cer_name`, `file_upload`, `expired_date`, `id_employee`, `id_certificate`) VALUES
(1, 'test', '94e327f0c3583b95324d98b3c65709e8.pdf', '2015-07-11', 1, 1),
(2, 'rwrew', NULL, '2015-06-05', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `competence_employee`
--

CREATE TABLE IF NOT EXISTS `competence_employee` (
  `id_competence_employee` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL,
  `id_mas_competence` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `competence_employee`
--

INSERT INTO `competence_employee` (`id_competence_employee`, `id_employee`, `id_mas_competence`, `description`) VALUES
(0, 6, 1, ''),
(2, 1, 2, ''),
(6, 4, 1, ''),
(7, 4, 5, ''),
(8, 5, 5, ''),
(9, 1, 3, ''),
(10, 1, 4, ''),
(11, 11, 2, ''),
(12, 11, 5, ''),
(13, 1, 1, 'tstaa');

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
  `id_user` int(11) NOT NULL DEFAULT '0',
  `photo` varchar(255) DEFAULT NULL,
  `id_mas_title` int(11) DEFAULT NULL,
  `id_mas_bp` int(11) DEFAULT NULL,
  `id_mas_employee_position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id_employee`, `nik`, `name`, `gender`, `information`, `date_of_birth`, `start_work`, `cv_document`, `id_organization_item`, `id_user`, `photo`, `id_mas_title`, `id_mas_bp`, `id_mas_employee_position`) VALUES
(1, '099991111', 'Dummytester', 'male', NULL, '2015-05-22', '2015-05-01', '75c86e02e22bd60e80e4647db9c90786.docx', 1, 1, '2387f99e3ddcc41ceba32bc95e8e63aa.jpg', 1, 1, 2),
(2, '900000', 'Dummytester 02', 'female', NULL, '2015-05-06', '2015-05-25', '9c95ffe792a79cafc4e3360e02f3b08e.docx', 12, 1, '165af87f0be760fcbc8be75a3a636440.jpg', 1, 2, 2),
(3, '9800000', 'Dummytester 03', 'male', NULL, '2015-05-06', '2015-05-04', '574e0b1a2dfc62e5d29343f08dcd8c29.docx', 4, 1, NULL, 1, 2, 3),
(4, '0987888888', 'Dummytester 04', 'male', NULL, NULL, NULL, '3c6afcd37245034c5ff5c56b748f85be.docx', 5, 2, NULL, NULL, 2, 1),
(5, '09878888889', 'Dummytester 05', 'male', NULL, NULL, NULL, '3c6afcd37245034c5ff5c56b748f85be.docx', 12, 1, NULL, 1, 2, 1),
(6, '12321', 'tets', 'male', NULL, NULL, NULL, 'f1fc2a42e32a63081241533eeabe0047.pdf', 1, 1, NULL, 1, 1, 1),
(7, '123123', 'tesste', 'male', NULL, '2015-07-04', NULL, '5488a6e6596ea791506f1ac45d7361d5.pdf', 12, 0, NULL, 1, 1, 2),
(8, '12345', 'sfsfa', 'male', NULL, '2015-07-09', NULL, '687452d470b14ea23e270eae4bb70816.pdf', 1, 0, NULL, 1, 1, 1),
(9, '12345', '12345', 'male', NULL, '2015-07-11', NULL, '532dc1e1f936dea94ef9b8810b7feae6.pdf', 1, 6, NULL, 1, 2, 2),
(10, '123', '1234', 'male', NULL, '2015-07-03', NULL, '24e621324a4c3179a712e5e8be3ea7d1.pdf', 1, 7, NULL, 1, 1, 3),
(11, '1234567', 'test', 'male', NULL, '2015-06-12', NULL, '', 12, 8, NULL, 1, 2, 1),
(12, '1413423', 'sdfsdfsd', 'male', NULL, '0000-00-00', NULL, '', 14, 9, NULL, 1, 1, 1),
(13, '24234242', 'tesdfsdf', 'male', NULL, '0000-00-00', NULL, '', 1, 10, '', 1, 2, 1),
(14, '35345345', 'tesfsd', 'male', NULL, '2015-06-15', NULL, '', 1, 11, 'b68417fadc54a4e55918f7e6115889de.jpg', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_activity_log`
--

CREATE TABLE IF NOT EXISTS `employee_activity_log` (
`id_employee_activity_log` int(11) NOT NULL,
  `activity_start_date` date DEFAULT NULL,
  `activity_end_date` date DEFAULT NULL,
  `activity_name` varchar(45) DEFAULT NULL,
  `activity_detail` text,
  `location` text,
  `percent_progress` float DEFAULT NULL,
  `last_progress_update` timestamp NULL DEFAULT NULL,
  `id_employee_project` int(11) NOT NULL,
  `id_project_step` int(11) NOT NULL,
  `id_mas_project_status` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
  `id_employee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_education`
--

INSERT INTO `employee_education` (`id_employee_education`, `education_degree`, `institute`, `major`, `start_year`, `end_year`, `id_employee`) VALUES
(0, 'SD', '1', 'Telekomunikasi', 2010, 2010, 10),
(1, 'S1', 'Institute Telkom', 'Teknik', 2010, 2013, 1),
(2, 'SMA', '1', 'Telekomunikasi', 2010, 2011, 10),
(3, 'S2', 'ff', 'Teknik', 2010, 2010, 10);

-- --------------------------------------------------------

--
-- Table structure for table `employee_project`
--

CREATE TABLE IF NOT EXISTS `employee_project` (
`id_employee_project` int(11) NOT NULL,
  `job_desc` varchar(255) DEFAULT NULL,
  `id_mas_employee_project_position` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL,
  `is_draft` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `employee_project`
--

INSERT INTO `employee_project` (`id_employee_project`, `job_desc`, `id_mas_employee_project_position`, `id_project`, `id_employee`, `is_draft`) VALUES
(3, NULL, 1, 2, 4, NULL),
(4, NULL, 3, 3, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `formula_performance_indicator`
--

CREATE TABLE IF NOT EXISTS `formula_performance_indicator` (
  `id_formula_performance_indicator` int(11) NOT NULL,
  `id_mas_formula` int(11) NOT NULL,
  `id_performance_indicator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `formula_performance_indicator`
--

INSERT INTO `formula_performance_indicator` (`id_formula_performance_indicator`, `id_mas_formula`, `id_performance_indicator`) VALUES
(1, 8, 1),
(2, 1, 1),
(3, 8, 2),
(4, 1, 2);

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
  `budget_realization` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Innovation_document`
--

CREATE TABLE IF NOT EXISTS `Innovation_document` (
  `id_innovation_document` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `description` text,
  `received_date` date DEFAULT NULL,
  `id_innovation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `innovation_utilization`
--

CREATE TABLE IF NOT EXISTS `innovation_utilization` (
  `id_innovation_utilization` int(11) NOT NULL,
  `utilization` text,
  `id_innovation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `id_organization_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mas_bp`
--

CREATE TABLE IF NOT EXISTS `mas_bp` (
  `id_mas_bp` int(11) NOT NULL,
  `bp` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_bp`
--

insert  into `mas_bp`(id_mas_bp,bp) values (1,'I'),(2,'II'),(3,'III'),(4,'IV'),(5,'V'),(6,'VI');

-- --------------------------------------------------------

--
-- Table structure for table `mas_competence`
--

CREATE TABLE IF NOT EXISTS `mas_competence` (
  `id_mas_competence` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_competence`
--

INSERT INTO `mas_competence` (`id_mas_competence`, `name`) VALUES
(1, 'Telecomunication'),
(2, 'Information'),
(3, 'Media'),
(4, 'Education'),
(5, 'Service');

-- --------------------------------------------------------

--
-- Table structure for table `mas_employee_position`
--

CREATE TABLE IF NOT EXISTS `mas_employee_position` (
  `id_mas_employee_position` int(11) NOT NULL,
  `position` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_employee_position`
--

insert  into `mas_employee_position`(id_mas_employee_position,position) values (1,'RESEARCHER'),(2,'SENIOR GENERAL MANAGER'),(3,'DEPUTY SGM'),(4,'SENIOR MANAGER'),(5,'MANAGER'),(6,'OFFICER 1'),(7,'OFFICER 2'),(8,'ENGINEER 1'),(9,'ENGINEER 2'),(10,'ENGINEER 3');

-- --------------------------------------------------------

--
-- Table structure for table `mas_employee_project_position`
--

CREATE TABLE IF NOT EXISTS `mas_employee_project_position` (
  `id_mas_employee_project_position` int(11) NOT NULL,
  `position` varchar(25) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_employee_project_position`
--

insert  into `mas_employee_project_position`(id_mas_employee_project_position,position,weight) values (1,'PM',5),(2,'Shared',1),(3,'Dedicated',3);

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
  `formula_upload` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_formula`
--

INSERT INTO `mas_formula` (`id_mas_formula`, `name`, `type`, `content`, `description`, `formula_upload`) VALUES
(1, 'F1', 'achievement', '', NULL, 'f1.png'),
(2, 'F2', 'achievement', NULL, NULL, 'f2.png'),
(3, 'F4', 'achievement', NULL, NULL, 'f4.png'),
(4, 'F7', 'achievement', NULL, NULL, 'f7.png'),
(5, 'F5', 'achievement', NULL, NULL, 'f5.png'),
(6, 'F6', 'achievement', NULL, NULL, 'f6.png'),
(8, 'R1', 'realization', NULL, NULL, 'r1.png'),
(9, 'R2', 'realization', NULL, NULL, 'r2.png'),
(10, 'R3', 'realization', NULL, NULL, 'r3.png'),
(11, 'R4', 'realization', NULL, NULL, 'r4.png'),
(12, 'F3', 'achievement', NULL, NULL, 'f3.png');

-- --------------------------------------------------------

--
-- Table structure for table `Mas_innovation`
--

CREATE TABLE IF NOT EXISTS `Mas_innovation` (
  `id_mas_innovation` int(11) NOT NULL,
  `data_type` set('innovation_type','last_step','product_category') DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
insert  into `Mas_innovation`(id_mas_innovation,data_type,value) values (1,'product_category','Product   '),(2,'product_category','Platform   '),(3,'product_category','Service  '),(4,'product_category','Process   '),(5,'product_category','Application   '),(6,'product_category','Prototype   '),(7,'product_category','Others  '),(8,'last_step','Customer Validation'),(9,'last_step','Product Validation'),(10,'last_step','Business Model Validation'),(11,'last_step','Handover to DDB'),(12,'innovation_type','Cloud - IaaS (Public)'),(13,'innovation_type','Cloud - Consumer SaaS '),(14,'innovation_type','Cloud - Business SaaS'),(15,'innovation_type','Cloud - SaaS Marketplace (Include PaaS)'),(16,'innovation_type','Financial Service - DOB'),(17,'innovation_type','Financial Service - Non DOB Payments'),(18,'innovation_type','Financial Service - Insurance'),(19,'innovation_type','Financial Service - Credit'),(20,'innovation_type','Financial Service - Savings'),(21,'innovation_type','Advertising - Agency'),(22,'innovation_type','Advertising - Incentive Marketing'),(23,'innovation_type','Media - Portal / Static Content'),(24,'innovation_type','Media - Streaming & Games'),(25,'innovation_type','Media - Social / UGC'),(26,'innovation_type','Media - Others');

--
-- Table structure for table `mas_key_performance`
--

CREATE TABLE IF NOT EXISTS `mas_key_performance` (
  `id_mas_key_performance` int(11) NOT NULL,
  `key_performance` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mas_metric`
--

CREATE TABLE IF NOT EXISTS `mas_metric` (
  `id_mas_metric` int(11) NOT NULL,
  `metric` varchar(45) DEFAULT NULL,
  `metric_type` set('quantity','date') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `type_for` set('partnership','bantek') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert  into `mas_partnership_document_type`(id_mas_partnership_document_type,type,type_for) values (1,'PKS','partnership'),(2,'Justifikasi','partnership'),(3,'Lampiran','partnership'),(4,'Dasar Permintaan','bantek');

--
-- Table structure for table `mas_performance_mapping`
--

CREATE TABLE IF NOT EXISTS `mas_performance_mapping` (
  `id_mas_performance_mapping` int(11) NOT NULL,
  `id_performance_indicator` int(11) NOT NULL,
  `performance_type` set('bidang','individu') DEFAULT NULL,
  `id_organization_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mas_perspective`
--

CREATE TABLE IF NOT EXISTS `mas_perspective` (
  `id_mas_perspective` int(11) NOT NULL,
  `perspective` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mas_research_group`
--

CREATE TABLE IF NOT EXISTS `mas_research_group` (
  `id_mas_research_group` int(11) NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `type` set('techincal','business') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
insert  into `mas_research_group`(id_mas_research_group,code,name,description,type) values (1,'STEL','Spesifikasi Telekomunikasi','Spesifikasi Telekomunikasi , mencakup semua dokumen yang berisi penjelasan secara rinci tentang suatu sistem, teknologi, atau perangkat.','techincal'),(2,'STD','Standar Sistem Telekomunikasi','Standar Sistem Telekomunikasi, mencakup semua dokumen yang berisi  penjelasan secara umum tentang suatu sistem, teknologi, atau perangkat yang dapat digunakan sebagai acuan baku (standar) umum.','techincal'),(3,'PED','Pedoman','Pedoman , mencakup semua dokumen yang isinya menjelaskan tentang: \r\n-  Pedoman Instalasi (Installation Guideline)\r\n- Pedoman Operasi dan Pemeliharaan (Operation and Maintenance Guideline)\r\n-  Pedoman Uji Terima (Acceptance Test Guideline)\r\n-  Dokumen lain yang sejenis','techincal'),(4,'KJN','Kajian','Kajian, mencakup semua dokumen yang isinya mengkaji suatu teknologi, sietm, perangkat, dll. Yang termasuk dokumen KJN antara lain :\r\n- Kajian Teknologi\r\n- Rilis Teknologi\r\n- Deskripsi Teknologi\r\n- Uji Coba Lapangan','techincal'),(5,'REC','Recommendation','RECOMMENDATION. Merupakan dokumen yang berisi rekomendasi. Rekomendasi tersebut dapat berisi; strategi bisnis tentang trend teknologi dan produk; strategi bisnis yang dapat digunakan dalam rangka peluncuran produk/layanan baru atau penggelaran teknologi;  Bisnis plan untuk peluncuran produk baru atau penggelaran teknologi; strategi yang dapat digunakan untuk memperbaiki performansi produk/layanan eksisting; strategi partnership dan community development.','business'),(6,'REP','Report','REPORT. Merupakan dokumen yang berisi laporan yang memberikan potret dari hasil observasi terhadap produk, service, situasi persaingan bisnis atau hasil suatu market research.','business'),(7,'GUD','Guidance','GUIDANCE. Merupakan dokumen yang berisi panduan untuk menyusun dokumen  REC, REP & GUD, atau panduan/juklak untuk melakukan kegiatan fungsi Lab seperti evaluasi produk, market research, CI, penyusunan bisnis plan dan bisnis strategi serta kegiatan yang berhubungan dengan partnership dan ICT development. ','business');
--
-- Table structure for table `mas_research_type`
--

CREATE TABLE IF NOT EXISTS `mas_research_type` (
  `id_mas_research_type` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_research_type`
--

insert  into `mas_research_type`(id_mas_research_type,type) values (1,'Dokumen Bisnis'),(2,'Dokumen Teknis');

-- --------------------------------------------------------

--
-- Table structure for table `mas_review_type`
--

CREATE TABLE IF NOT EXISTS `mas_review_type` (
  `id_mas_review_type` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `strategic_initiative` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mas_strategic_objective`
--

CREATE TABLE IF NOT EXISTS `mas_strategic_objective` (
  `id_mas_strategic_objective` int(11) NOT NULL,
  `strategic_objective` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `title` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mas_title`
--
insert  into `mas_title`(id_mas_title,title) values (1,'SENIOR GENERAL MANAGER INNOVATION & DESIGN CENTER'),(2,'DEPUTY SGM INNOVATION & DESIGN CENTER'),(3,'SENIOR MANAGER INNOVATION MANAGEMENT'),(4,'RESEARCHER BROADBAND COMMUNICATION SERVICE'),(5,'MANAGER BUSINESS & PROGRAM PLANNING'),(6,'OFFICER 1 STRATEGIC PLANNING'),(7,'OFFICER 1 BUDGETING, PROGRAM PLANNING & MONITORING'),(8,'OFFICER 1 INNOVATION PROGRAM PLANNING & MONITORING'),(9,'OFFICER 2 INNOVATION PROGRAM PLANNING & MONITORING'),(10,'MANAGER PERFORMANCE MANAGEMENT'),(11,'OFFICER 1 PERFORMANCE EVALUATION & ANALYSIS'),(12,'OFFICER 1 BUSINESS PROCESS AUDIT'),(13,'OFFICER 1 PERFORMANCE MEASUREMENT & ANALYSIS'),(14,'MANAGER INNOVATION & ENTERPRENEURSHIP'),(15,'OFFICER 1 INCUBATION PROGRAM PLANNING'),(16,'OFFICER 1 INCUBATION PROGRAM MONITORING'),(17,'OFFICER 1 INCUBATION PROGRAM ASSESSMENT'),(18,'MANAGER QUALITY MANAGEMENT & RESEARCH SYNERGY'),(19,'OFFICER 1 QUALITY EVALUATION & ANALISYS'),(20,'OFFICER 1 QUALITY MANAGEMENT PROGRAM'),(21,'OFFICER 1 PROGRAM SYNERGY PLANNING & EVALUATION'),(22,'SENIOR MANAGER DIGITAL LIFESTYLE ECOSYSTEM'),(23,'RESEARCHER DIGITAL ECOSYSTEM ANALISYS'),(24,'RESEARCHER DIGITAL ECOSYSTEM DEVELOPMENT'),(25,'RESEARCHER DIGITAL SERVICE PLATFORM'),(26,'MANAGER DIGITAL MEDIA'),(27,'ENGINEER 2 DIGITAL MEDIA DESIGN'),(28,'MANAGER DIGITAL HOME'),(29,'ENGINEER 1 DIGITAL HOME DESIGN'),(30,'MANAGER DIGITAL ENTERTAINMENT'),(31,'ENGINEER 1 DIGITAL ENTERTAINMENT PRODUCT'),(32,'ENGINEER 1 DIGITAL ENTERTAINMENT DESIGN'),(33,'ENGINEER 3 DIGITAL ENTERTAINMENT DESIGN'),(34,'MANAGER DIGITAL LIFESTYLE PLATFORM'),(35,'ENGINEER 1 DIGITAL LIFESTYLE PLATFORM ANALYSIS'),(36,'ENGINEER 2 DIGITAL LIFESTYLE PLATFORM DEVELOPMENT'),(37,'SENIOR MANAGER DIGITAL SOLUTION ECOSYSTEM'),(38,'RESEARCHER DIGITAL ECOSYSTEM ANALISYS'),(39,'RESEARCHER DIGITAL ECOSYSTEM DEVELOPMENT'),(40,'RESEARCHER DIGITAL SERVICE PLATFORM'),(41,'MANAGER DIGITAL HOSPITALITY'),(42,'ENGINEER 1 DIGITAL HOSPITALITY BUSINESS'),(43,'ENGINEER 1 DIGITAL HOSPITALITY PRODUCT'),(44,'ENGINEER 2 DIGITAL HOSPITALITY DESIGN'),(45,'ENGINEER 3 DIGITAL HOSPITALITY DESIGN'),(46,'MANAGER DIGITAL GOVERNMENT & EDUCATION'),(47,'ENGINEER 1 DIGITAL GOVERNMENT & EDUCATION BUSINESS'),(48,'ENGINEER 2 DIGITAL GOVERNMENT & EDUCATION DESIGN'),(49,'ENGINEER 1 DIGITAL GOVERNMENT & EDUCATION PRODUCT'),(50,'MANAGER DIGITAL SUPPLY CHAIN & UTILITIES'),(51,'ENGINEER 1 DIGITAL SUPPLY CHAIN & UTILITIES PRODUCT'),(52,'ENGINEER 3 DIGITAL SUPPLY CHAIN & UTILITIES DESIGN'),(53,'MANAGER SOLUTION PLATFORM'),(54,'ENGINEER 1 DIGITAL SOLUTION PLATFORM ANALYSIS'),(55,'ENGINEER 1 DIGITAL SOLUTION PLATFORM DEVELOPMENT'),(56,'ENGINEER 2 DIGITAL SOLUTION PLATFORM DEVELOPMENT'),(57,'SENIOR MANAGER MOBILE ECOSYSTEM'),(58,'MANAGER MOBILE IT & SERVICE PLATFORM'),(59,'ENGINEER 3 MOBILE IT & SERVICE PLATFORM'),(60,'MANAGER WIRELESS ACCESS TECHNOLOGY'),(61,'SENIOR MANAGER INFRASTRUCTURE RESEARCH & DEVELOPMENT'),(62,'RESEARCHER SERVICE NODE PLATFORM'),(63,'RESEARCHER BROADBAND CORE NETWORK'),(64,'RESEARCHER FIXED BROADBAND ACCESS'),(65,'RESEARCHER CORE IT & SECURITY SYSTEM'),(66,'RESEARCHER BROADBAND COMMUNICATION SERVICE'),(67,'MANAGER NODE PLATFORM'),(68,'ENGINEER 2 MULTIMEDIA SERVICE CONTROL'),(69,'ENGINEER 3 MULTIMEDIA SERVICE CONTROL'),(70,'ENGINEER 1 SERVICE DELIVERY PLATFORM'),(71,'ENGINEER 1 COMMUNICATION CONTROL'),(72,'MANAGER BROADBAND COMMUNICATION SERVICES'),(73,'ENGINEER 1 BROADBAND COMMUNICATION SERVICES'),(74,'ENGINEER 2 BROADBAND COMMUNICATION SERVICES'),(75,'ENGINEER 3 NETWORK CONNECTIVITY SERVICES'),(76,'ENGINEER 1 NETWORK CONNECTIVITY SERVICES'),(77,'MANAGER FIXED BROADBAND ACCESS'),(78,'ENGINEER 1 WIRELINE MEDIA & CABLING SYSTEM'),(79,'ENGINEER 1 BROADBAND WIRELINE SYSTEM'),(80,'ENGINEER 3 BROADBAND WIRELINE SYSTEM'),(81,'MANAGER CORE IT & SECURITY SYSTEM'),(82,'ENGINEER 1 SECURTY & RELIABILITY SYSTEM'),(83,'ENGINEER 2 SECURITY & RELIABILITY SYSTEM'),(84,'MANAGER BROADBAND CORE NETWORK '),(85,'ENGINEER 1 IP & METRO NETWORK'),(86,'ENGINEER 1 BROADBAND TRANSMISSION SYSTEM'),(87,'ENGINEER 2 IP & METRO NETWORK'),(88,'SENIOR MANAGER PRODUCT & INFRASTRUCTURE ASSURANCE'),(89,'RESEARCHER DIGITAL ECOSYSTEM ANALISYS'),(90,'RESEARCHER SYSTEM QUALITY ASSURANCE'),(91,'RESEARCHER SYSTEM INTEGRATION & READINESS'),(92,'RESEARCHER DIGITAL ECOSYSTEM DEVELOPMENT'),(93,'MANAGER PRODUCT QUALITY ASSURANCE'),(94,'ENGINEER 1 PRODUCT QUALITY ASSESSMENT'),(95,'MANAGER INFRASTRUCTURE QUALITY ASSURANCE'),(96,'ENGINEER 1 TRANSMISSION QUALITY ASSURANCE'),(97,'ENGINEER 1 FO & CABLE QUALITY ASSURANCE'),(98,'ENGINEER 1 QUALITY ASSURANCE CALIBRATION'),(99,'ENGINEER 2 FO & CABLE QUALITY ASSURANCE'),(100,'MANAGER DEVICE & ENERGY QUALITY ASSURANCE'),(101,'ENGINEER 1 DEVICE & ENERGY QUALITY ASSURANCE '),(102,'ENGINEER 1 ME & ENERGY QUALITY ASSURANCE'),(103,'MANAGER SYSTEM INTEGRATION & READINESS'),(104,'ENGINEER 1 SYSTEM INTEGRATION PLANNING & DESIGN'),(105,'MANAGER PRODUCT & INFRASTRUCTURE EXPERIENCE'),(106,'ENGINEER 1 INNOVATION INFORMATION SYSTEM'),(107,'ENGINEER 1 TEST BED SYSTEM & MANAGEMENT'),(108,'ENGINEER 1 TEST BED SYSTEM & MANAGEMENT'),(109,'SENIOR MANAGER GENERAL AFFAIRS'),(110,'MANAGER SECRETARIATE & RESOURCE DEVELOPMENT'),(111,'OFFICER 1 SECRETARIATE'),(112,'OFFICER 1 FACILITY MANAGEMENT'),(113,'OFFICER 1 RESOURCE PLANNING & DEVELOPMENT'),(114,'OFFICER 1 RELATION & COMMUNICATION'),(115,'OFFICER 2 FACILITY MANAGEMENT'),(116,'OFFICER 2 SECRETARIATE ADMINISTRATION'),(117,'MANAGER LOGISTIC & ASSET MANAGEMENT'),(118,'OFFICER 1 LOGISTIC PLANNING PROCUREMENT'),(119,'OFFICER 1 PROCUREMENT PROCESS'),(120,'OFFICER 2 ASSET MANAGEMENT'),(121,'MANAGER USER RELATION'),(122,'OFFICER 1 CUSTOMER CARE'),(123,'OFFICER 2 INVOICE & COLLECTION'),(124,'OFFICER 2 CUSTOMER RELATIONSHIP'),(125,'MANAGER BUSINESS LEGAL SUPPORT'),(126,'OFFICER 1 LEGAL COMPLIANCE'),(127,'OFFICER 1 CONTRACT DRAFTER & ADMINISTRATON');

-- --------------------------------------------------------

--
-- Table structure for table `mas_training_type`
--

CREATE TABLE IF NOT EXISTS `mas_training_type` (
  `id_mas_training_type` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `row` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(12, 'Business & Program Planning', NULL, 'lab', 4, 'BPP', 4),
(13, 'Performance Management', NULL, 'lab', 4, 'PM', 4),
(14, 'Quality Management & Research Synergy', NULL, 'lab', 4, 'QMRS', 4),
(15, 'Innovation & Entrepreneurship', NULL, 'lab', 4, 'IM', 4);

-- --------------------------------------------------------

--
-- Table structure for table `partnership`
--

CREATE TABLE IF NOT EXISTS `partnership` (
  `id_partnership` int(11) NOT NULL,
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
  `partnership_category` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `document` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `partnership_document`
--

CREATE TABLE IF NOT EXISTS `partnership_document` (
  `id_partnership_document` int(11) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `id_mas_partnership_document_type` int(11) NOT NULL,
  `id_partnership` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `performance_evidence`
--

CREATE TABLE IF NOT EXISTS `performance_evidence` (
  `id_performance_evidence` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `id_performance_system` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `indicator_type` set('common','shared','specific') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `performance_indicator`
--

INSERT INTO `performance_indicator` (`id_performance_indicator`, `name`, `description`, `measure_definition`, `evidence`, `id_annual_data`, `id_program`, `id_mas_strategic_objective`, `id_mas_key_performance`, `is_default`, `id_mas_strategic_initiative`, `indicator_type`) VALUES
(1, 'Pengendalian Beban Internal 2', 'Pengendalian Beban Internal 2', '%', 'Evidence', NULL, 2, 1, NULL, 0, NULL, 'shared'),
(2, 'CSI Mitra', 'CSI Mitra', '%', 'Evidence', NULL, 2, 1, NULL, 0, NULL, 'shared');

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
  `budget_realization` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `performance_quartal`
--

INSERT INTO `performance_quartal` (`id_performance_quartal`, `period`, `weight`, `target`, `achievement_raw`, `achievement`, `accomplishment`, `deviation`, `id_performance_system_item`, `analysis`, `recommendation`, `evaluation`, `id_target`, `budget_realization`) VALUES
(1, 1, 10, 100, 100, 100, 1000, 0, 1, NULL, NULL, NULL, 5, NULL),
(2, 2, 5, 100, 80, 80, 400, -20, 1, NULL, NULL, NULL, 6, NULL),
(3, 3, 10, 100, 50, 60, 600, -40, 1, NULL, NULL, NULL, 7, NULL),
(4, 4, 10, 100, 66.6667, 66.6667, 666.667, -33.3333, 1, NULL, NULL, NULL, 8, NULL),
(5, 1, 10, 100, 110, 105, 1050, 5, 2, NULL, NULL, NULL, NULL, NULL),
(6, 2, 10, 100, 80, 80, 800, -20, 2, NULL, NULL, NULL, NULL, NULL),
(7, 3, 10, 100, 95, 95, 950, -5, 2, NULL, NULL, NULL, NULL, NULL),
(8, 4, 5, 100, 100, 100, 500, 0, 2, NULL, NULL, NULL, NULL, NULL),
(9, 1, 10, 100, 80, 80, 8000, -20, 4, NULL, NULL, NULL, NULL, NULL),
(10, 1, 10, 100, 70, 70, 700, -30, 6, NULL, NULL, NULL, NULL, NULL),
(11, 2, 20, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL),
(12, 3, 30, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL),
(13, 4, 40, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `performance_realization`
--

CREATE TABLE IF NOT EXISTS `performance_realization` (
  `id_performance_realization` int(11) NOT NULL,
  `realization` varchar(45) DEFAULT NULL,
  `id_performance_quartal` int(11) NOT NULL,
  `id_target_item` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `performance_realization`
--

INSERT INTO `performance_realization` (`id_performance_realization`, `realization`, `id_performance_quartal`, `id_target_item`) VALUES
(1, '40', 9, NULL),
(2, '50', 1, NULL),
(3, '80', 2, NULL),
(4, '100', 3, NULL),
(5, '200', 4, NULL),
(6, '', 10, NULL);

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
  `id_annual_data` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `performance_system`
--

INSERT INTO `performance_system` (`id_performance_system`, `name`, `date`, `id_organization_item`, `id_employee`, `limit_max`, `limit_min`, `id_annual_data`) VALUES
(1, 'Innovation Management', '2015-06-03', 4, 0, 150, 60, NULL),
(2, '', '2015-06-04', NULL, 5, 150, 60, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `performance_system_item`
--

CREATE TABLE IF NOT EXISTS `performance_system_item` (
  `id_performance_system_item` int(11) NOT NULL,
  `id_performance_system` int(11) NOT NULL,
  `id_performance_indicator` int(11) NOT NULL,
  `id_performance_system_item_parent` int(11) DEFAULT NULL,
  `id_mas_perspective` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `performance_system_item`
--

INSERT INTO `performance_system_item` (`id_performance_system_item`, `id_performance_system`, `id_performance_indicator`, `id_performance_system_item_parent`, `id_mas_perspective`) VALUES
(1, 1, 1, 0, 1),
(2, 1, 2, 0, 2),
(3, 1, 2, 0, 3),
(4, 1, 2, 0, 1),
(5, 1, 1, 0, 4),
(6, 2, 2, 0, 1);

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
  `budget` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id_program`, `name`, `program_description`, `output`, `user`, `start_date`, `end_date`, `quartal`, `primary_program`, `deliverable`, `KPI`, `implementation_strategy`, `strategic_initative`, `id_organization_item`, `id_employee_po`, `id_employee_pm`, `id_annual_data`, `show_on_review`, `id_mas_project_status`, `id_mas_research_type`, `budget`) VALUES
(1, 'Seleksi Indigo Incubator', 'Inkubasi', NULL, NULL, '2015-05-26', '2015-05-31', 'TW IV', 0, '# of incubation proposal\r\n# of Incubated Start Ups\r\n# of Validated Products\r\n# of Validated Business Model', '400 of incubation proposals\r\n- Incubated StartUp : 30 (BDV=20, JDV=10)\r\n- Validated Products : 20\r\n- Validated Business Model : 10', '- Roadshow (socialization),\r\n- Partnering with MIKTI (Running the Incubation)\r\n- Partnering with Global Incubators (Global Mentor)', 'SI-1 Center of Excellent', 1, 1, 1, NULL, 0, 1, 3, 500000000),
(2, 'Update dan rolling strategic plan RDC', '', 'Kajian strategic plan', '', '2015-01-01', '2015-06-13', 'TW IV', 1, '# of incubation proposal\r\n# of Incubated Start Ups\r\n# of Validated Products\r\n# of Validated Business Model', '400 of incubation proposals\r\n- Incubated StartUp : 30 (BDV=20, JDV=10)\r\n- Validated Products : 20\r\n- Validated Business Model : 10', '- Roadshow (socialization),\r\n- Partnering with MIKTI (Running the Incubation)\r\n- Partnering with Global Incubators (Global Mentor)', 'SI-1 Center of Excellent', 12, NULL, 4, 0, 0, 1, 3, 999999),
(3, 'Seleksi Indigo Incubator', 'Inkubasi', 'Output', 'RDC', '2015-01-01', '2015-05-31', 'TW IV', 1, '# of incubation proposal\r\n# of Incubated Start Ups\r\n# of Validated Products\r\n# of Validated Business Model', '400 of incubation proposals\r\n- Incubated StartUp : 30 (BDV=20, JDV=10)\r\n- Validated Products : 20\r\n- Validated Business Model : 10', '- Roadshow (socialization),\r\n- Partnering with MIKTI (Running the Incubation)\r\n- Partnering with Global Incubators (Global Mentor)', 'SI-1 Center of Excellent', 15, 5, 5, 0, 0, 1, 3, 999999999),
(4, 'arwer', 'tesssfs', '', '', '0000-00-00', '0000-00-00', 'TW I', NULL, '', '', '', '', 1, 0, 0, 0, 0, 1, 1, 2147483647),
(5, 'sdfsdf', 'asfsfs', '', '', '0000-00-00', '0000-00-00', 'TW I', NULL, '', '', '', '', 13, 0, 0, 0, 0, 1, 2, 234242412),
(6, 'sdfsdfsafsfa', 'Description', 'Output', 'RDC', '2015-07-03', '2015-07-24', 'TW I', 1, 'Deliver', 'KPI', 'startegy', 'initiative', 5, 8, 8, 0, 0, 1, 4, 999999999);

-- --------------------------------------------------------

--
-- Table structure for table `program_target`
--

CREATE TABLE IF NOT EXISTS `program_target` (
`id_program_target` int(11) NOT NULL,
  `id_program` int(11) NOT NULL,
  `id_target` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `program_target`
--

INSERT INTO `program_target` (`id_program_target`, `id_program`, `id_target`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4);

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
  `id_mas_times_category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id_project`, `name`, `project_description`, `weight`, `start_date`, `end_date`, `percent_progress`, `last_progress_update`, `id_program`, `id_organization_item`, `id_annual_data`, `id_mas_project_status`, `id_mas_times_category`) VALUES
(2, 'Indigo Incubator 2', 'Indikator yang menunjukkan kemampuan RDC dalam penjaringan ide untuk inkubasi yang meliputi aktifitas penyeleksian proposal, proses inkubasi sampai siap dilakukan proses Market validation.', 100, '2015-01-01', '2015-12-16', 0, '2015-05-28 22:36:59', 1, 4, 0, 1, 1),
(3, 'Indigo Incubator 3', '', 100, '2015-01-01', '2015-12-18', 0, '2015-06-05 14:31:47', 1, 4, 0, 1, 1),
(4, 'Incubator Startup 4', 'Incubator Startup 4', 100, '2015-06-01', '2015-07-17', 0, '2015-05-29 16:55:17', 1, 4, 0, 1, 1),
(5, 'kbhhj', 'sssss', 90, '2015-06-05', '2015-06-05', 0, '2015-06-05 02:38:33', 2, 4, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_step`
--

CREATE TABLE IF NOT EXISTS `project_step` (
`id_project_step` int(11) NOT NULL,
  `step_name` varchar(255) DEFAULT NULL,
  `step_description` text,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `id_project` int(11) NOT NULL,
  `weight` float DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `project_step`
--

INSERT INTO `project_step` (`id_project_step`, `step_name`, `step_description`, `start_date`, `end_date`, `id_project`, `weight`) VALUES
(3, 'Incubated Startup', 'incubated', '2015-05-29', '2015-12-31', 2, 100),
(4, 'Validated Products', 'validated products', '2016-01-03', '2016-01-06', 2, 100),
(5, 'Validated Business Model', 'Validated Business Model', '2016-01-11', '2015-12-18', 2, 20),
(6, 'tes', 'tes', '2015-06-05', '2015-06-05', 3, 100),
(8, 'tes', 'test', '2015-06-05', '2015-06-05', 3, 100),
(9, 'sdf', 'sdf', '2015-06-05', '2015-06-05', 3, 432);

-- --------------------------------------------------------

--
-- Table structure for table `QA_product`
--

CREATE TABLE IF NOT EXISTS `QA_product` (
`id_qa_product` int(11) NOT NULL,
  `product_name` varchar(45) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `executive_summary` text,
  `conclusion` text,
  `testing_recomendation` text,
  `tester_name` varchar(200) DEFAULT NULL,
  `information` text
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `QA_product`
--

INSERT INTO `QA_product` (`id_qa_product`, `product_name`, `start_date`, `end_date`, `executive_summary`, `conclusion`, `testing_recomendation`, `tester_name`, `information`) VALUES
(4, 'test123', '0000-00-00', '0000-00-00', 'testt123', 'testest', 'test', 'testst', 'teetst');

-- --------------------------------------------------------

--
-- Table structure for table `QA_product_document`
--

CREATE TABLE IF NOT EXISTS `QA_product_document` (
`id_qa_product_document` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `description` text,
  `received_date` date DEFAULT NULL,
  `id_qa_product` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

CREATE TABLE IF NOT EXISTS `research` (
`id_research` int(11) NOT NULL,
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
  `year` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `id_research` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `research_utilization`
--

CREATE TABLE IF NOT EXISTS `research_utilization` (
  `id_research_utilization` int(11) NOT NULL,
  `utilization` text,
  `id_research` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `review_comment`
--

CREATE TABLE IF NOT EXISTS `review_comment` (
`id_review_comment` int(11) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `id_review_management` int(11) NOT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `review_comment`
--

INSERT INTO `review_comment` (`id_review_comment`, `content`, `id_review_management`, `timestamp`, `id_user`) VALUES
(1, 'Perlu ada evaluasi lebih lanjut mengenai program ini, apakah memang benar-benar dapat memberikan kontribusi terhadap pengembangan inovasi teknologi di Indonesia', 1, '2015-06-04 15:52:37', 1),
(2, 'comment', 4, '2015-06-05 01:46:48', 1),
(3, 'd', 4, '2015-06-05 02:07:22', 1),
(4, 'aa', 4, '2015-06-05 02:07:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `review_management`
--

CREATE TABLE IF NOT EXISTS `review_management` (
`id_review_management` int(11) NOT NULL,
  `period` varchar(45) DEFAULT NULL,
  `id_program` int(11) NOT NULL,
  `id_mas_review_type` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `files` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `review_management`
--

INSERT INTO `review_management` (`id_review_management`, `period`, `id_program`, `id_mas_review_type`, `description`, `files`, `date`) VALUES
(4, '', 1, 2, NULL, 'ec90c4d27c469359d3017353beca47d0.jpg', '2015-06-04 18:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `target`
--

CREATE TABLE IF NOT EXISTS `target` (
  `id_target` int(11) NOT NULL,
  `period` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `target`
--

INSERT INTO `target` (`id_target`, `period`) VALUES
(1, 'TW I'),
(2, 'TW II'),
(3, 'TW IV'),
(4, 'TW III'),
(5, 'TW I'),
(6, 'TW II'),
(7, 'TW III'),
(8, 'TW IV');

-- --------------------------------------------------------

--
-- Table structure for table `target_item`
--

CREATE TABLE IF NOT EXISTS `target_item` (
  `id_target_item` int(11) NOT NULL,
  `target` varchar(45) DEFAULT NULL,
  `target_detail` varchar(45) DEFAULT NULL,
  `id_mas_metric` int(11) NOT NULL,
  `id_target` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `target_item`
--

INSERT INTO `target_item` (`id_target_item`, `target`, `target_detail`, `id_mas_metric`, `id_target`) VALUES
(1, '50', 'Rata rata jumlah user per bulan', 1, 1),
(2, '100', 'Rata rata jumlah user per bulan', 1, 2),
(3, '300', 'Rata rata jumlah user per bulan', 1, 3),
(4, '200', 'Rata rata jumlah user per bulan', 1, 4),
(5, '20', 'Target', 1, 5),
(6, '10', 'Detail', 1, 6),
(7, '20', 'Detail', 1, 7),
(8, '90', 'Detail', 1, 8);

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
  `id_mas_times_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `training_employee`
--

CREATE TABLE IF NOT EXISTS `training_employee` (
  `id_training_employee` int(11) NOT NULL,
  `id_training` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `id_user_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `last_login`, `login_count`, `profile_pic`, `id_user_level`) VALUES
(1, 'admin', '8cb2237d0679ca88db6464eac60da96345513964', '2015-06-05 12:45:36', NULL, NULL, 1),
(2, 'researcher', '8cb2237d0679ca88db6464eac60da96345513964', '2015-06-04 12:02:48', NULL, NULL, 2),
(3, 'researcher2', '8cb2237d0679ca88db6464eac60da96345513964', '2015-05-28 19:09:45', NULL, NULL, 2),
(6, '12345', '8cb2237d0679ca88db6464eac60da96345513964', NULL, NULL, NULL, 2),
(7, '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, NULL, NULL, 2),
(8, '1234567', '20eabe5d64b0e216796e834f52d61fd0b70332fc', NULL, NULL, NULL, 2),
(9, '1413423', '8818e6ab6bac38ad0fe9a2a8aa6a6d8715427bc0', NULL, NULL, NULL, 2),
(10, '24234242', '0f39b71fccc80398f4f3f304c1c5a59b7889b3a0', NULL, NULL, NULL, 2),
(11, '35345345', '89f8089d92b99fd99e53a8cc4625f12642ddf99d', NULL, NULL, NULL, 2);

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
  `id_app_files` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE IF NOT EXISTS `user_level` (
  `id_user_level` int(11) NOT NULL,
  `level_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `annual_data`
--
ALTER TABLE `annual_data`
 ADD PRIMARY KEY (`id_annual_data`);

--
-- Indexes for table `app_config`
--
ALTER TABLE `app_config`
 ADD PRIMARY KEY (`key`);

--
-- Indexes for table `app_files`
--
ALTER TABLE `app_files`
 ADD PRIMARY KEY (`id_app_files`,`lang`), ADD KEY `fk_app_files_app_theme1_idx` (`app_theme_id_app_theme`);

--
-- Indexes for table `app_menus`
--
ALTER TABLE `app_menus`
 ADD PRIMARY KEY (`position`,`id`), ADD KEY `fk_menus_files` (`file_id`);

--
-- Indexes for table `app_theme`
--
ALTER TABLE `app_theme`
 ADD PRIMARY KEY (`id_app_theme`);

--
-- Indexes for table `app_user_activity`
--
ALTER TABLE `app_user_activity`
 ADD PRIMARY KEY (`id_app_user_activity`);

--
-- Indexes for table `bantek`
--
ALTER TABLE `bantek`
 ADD PRIMARY KEY (`id_bantek`), ADD KEY `fk_bantek_mas_project_status1_idx` (`id_mas_project_status`);

--
-- Indexes for table `bantek_document`
--
ALTER TABLE `bantek_document`
 ADD PRIMARY KEY (`id_bantek_document`,`id_bantek`), ADD KEY `fk_bantek_document_bantek1_idx` (`id_bantek`), ADD KEY `fk_bantek_document_mas_partnership_document_type1_idx` (`id_mas_partnership_document_type`);

--
-- Indexes for table `bantek_information`
--
ALTER TABLE `bantek_information`
 ADD PRIMARY KEY (`id_bantek_information`,`id_user`,`id_bantek`), ADD KEY `fk_partnership_information_user1_idx` (`id_user`), ADD KEY `fk_bantek_information_bantek1_idx` (`id_bantek`);

--
-- Indexes for table `bantek_program`
--
ALTER TABLE `bantek_program`
 ADD PRIMARY KEY (`id_bantek_program`,`id_bantek`), ADD KEY `fk_bantek_program_bantek1_idx` (`id_bantek`);

--
-- Indexes for table `bantek_utilization`
--
ALTER TABLE `bantek_utilization`
 ADD PRIMARY KEY (`id_bantek_utilization`,`id_bantek`), ADD KEY `fk_bantek_utilization_bantek1_idx` (`id_bantek`);

--
-- Indexes for table `Bantek_work_unit_executor`
--
ALTER TABLE `Bantek_work_unit_executor`
 ADD PRIMARY KEY (`id_bantek_work_unit_executor`,`id_bantek`), ADD KEY `fk_Bantek_work_unit_executor_organization_item1_idx` (`id_organization_item`), ADD KEY `fk_Bantek_work_unit_executor_bantek1_idx` (`id_bantek`);

--
-- Indexes for table `bko_history`
--
ALTER TABLE `bko_history`
 ADD PRIMARY KEY (`id_bko_history`), ADD KEY `fk_BKO_History_employee1_idx` (`id_employee`), ADD KEY `fk_bko_history_organization_item1_idx` (`id_organization_item`), ADD KEY `fk_bko_history_mas_title1_idx` (`id_mas_title`), ADD KEY `fk_bko_history_mas_employee_position1_idx` (`id_mas_employee_position`);

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
 ADD PRIMARY KEY (`id_certificate`), ADD KEY `fk_certificate_mas_category1_idx` (`id_mas_times_category`);

--
-- Indexes for table `certificate_employee`
--
ALTER TABLE `certificate_employee`
 ADD PRIMARY KEY (`id_certificate_employee`), ADD KEY `fk_certificate_employee_employee1_idx` (`id_employee`), ADD KEY `fk_certificate_employee_certificate1_idx` (`id_certificate`);

--
-- Indexes for table `competence_employee`
--
ALTER TABLE `competence_employee`
 ADD PRIMARY KEY (`id_competence_employee`), ADD KEY `fk_competence_employee_employee1_idx` (`id_employee`), ADD KEY `fk_competence_employee_competence1_idx` (`id_mas_competence`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
 ADD PRIMARY KEY (`id_employee`), ADD KEY `fk_employee_organization_item1_idx` (`id_organization_item`), ADD KEY `fk_employee_user1_idx` (`id_user`), ADD KEY `fk_employee_mas_title1_idx` (`id_mas_title`), ADD KEY `fk_employee_mas_bp1_idx` (`id_mas_bp`), ADD KEY `fk_employee_mas_employee_position1_idx` (`id_mas_employee_position`);

--
-- Indexes for table `employee_activity_log`
--
ALTER TABLE `employee_activity_log`
 ADD PRIMARY KEY (`id_employee_activity_log`), ADD KEY `fk_employee_activity_log_employee_project1_idx` (`id_employee_project`), ADD KEY `fk_employee_activity_log_project_step1_idx` (`id_project_step`);

--
-- Indexes for table `employee_education`
--
ALTER TABLE `employee_education`
 ADD PRIMARY KEY (`id_employee_education`,`id_employee`), ADD KEY `fk_employee_education_employee1_idx` (`id_employee`);

--
-- Indexes for table `employee_project`
--
ALTER TABLE `employee_project`
 ADD PRIMARY KEY (`id_employee_project`), ADD KEY `fk_employee_project_mas_employee_project_position1_idx` (`id_mas_employee_project_position`), ADD KEY `fk_employee_project_project1_idx` (`id_project`), ADD KEY `fk_employee_project_employee1_idx` (`id_employee`);

--
-- Indexes for table `formula_performance_indicator`
--
ALTER TABLE `formula_performance_indicator`
 ADD PRIMARY KEY (`id_formula_performance_indicator`), ADD KEY `fk_formula_performance_indicator_formula1_idx` (`id_mas_formula`), ADD KEY `fk_formula_performance_indicator_performance_indicator1_idx` (`id_performance_indicator`);

--
-- Indexes for table `Innovation`
--
ALTER TABLE `Innovation`
 ADD PRIMARY KEY (`id_innovation`);

--
-- Indexes for table `Innovation_document`
--
ALTER TABLE `Innovation_document`
 ADD PRIMARY KEY (`id_innovation_document`,`id_innovation`), ADD KEY `fk_Innovation_document_Innovation1_idx` (`id_innovation`);

--
-- Indexes for table `innovation_utilization`
--
ALTER TABLE `innovation_utilization`
 ADD PRIMARY KEY (`id_innovation_utilization`), ADD KEY `fk_innovation_utilization_Innovation1_idx` (`id_innovation`);

--
-- Indexes for table `ip`
--
ALTER TABLE `ip`
 ADD PRIMARY KEY (`id_ip`), ADD KEY `fk_ip_organization_item1_idx` (`id_organization_item`);

--
-- Indexes for table `mas_bp`
--
ALTER TABLE `mas_bp`
 ADD PRIMARY KEY (`id_mas_bp`);

--
-- Indexes for table `mas_competence`
--
ALTER TABLE `mas_competence`
 ADD PRIMARY KEY (`id_mas_competence`);

--
-- Indexes for table `mas_employee_position`
--
ALTER TABLE `mas_employee_position`
 ADD PRIMARY KEY (`id_mas_employee_position`);

--
-- Indexes for table `mas_employee_project_position`
--
ALTER TABLE `mas_employee_project_position`
 ADD PRIMARY KEY (`id_mas_employee_project_position`);

--
-- Indexes for table `mas_formula`
--
ALTER TABLE `mas_formula`
 ADD PRIMARY KEY (`id_mas_formula`);

--
-- Indexes for table `Mas_innovation`
--
ALTER TABLE `Mas_innovation`
 ADD PRIMARY KEY (`id_mas_innovation`);

--
-- Indexes for table `mas_key_performance`
--
ALTER TABLE `mas_key_performance`
 ADD PRIMARY KEY (`id_mas_key_performance`);

--
-- Indexes for table `mas_metric`
--
ALTER TABLE `mas_metric`
 ADD PRIMARY KEY (`id_mas_metric`);

--
-- Indexes for table `mas_partnership_document_type`
--
ALTER TABLE `mas_partnership_document_type`
 ADD PRIMARY KEY (`id_mas_partnership_document_type`);

--
-- Indexes for table `mas_performance_mapping`
--
ALTER TABLE `mas_performance_mapping`
 ADD PRIMARY KEY (`id_mas_performance_mapping`), ADD KEY `fk_mas_performance_mapping_organization_item1_idx` (`id_organization_item`), ADD KEY `fk_mas_performance_mapping_performance_indicator1_idx` (`id_performance_indicator`);

--
-- Indexes for table `mas_perspective`
--
ALTER TABLE `mas_perspective`
 ADD PRIMARY KEY (`id_mas_perspective`);

--
-- Indexes for table `mas_project_status`
--
ALTER TABLE `mas_project_status`
 ADD PRIMARY KEY (`id_mas_project_status`);

--
-- Indexes for table `mas_research_content`
--
ALTER TABLE `mas_research_content`
 ADD PRIMARY KEY (`id_mas_research_content`);

--
-- Indexes for table `mas_research_group`
--
ALTER TABLE `mas_research_group`
 ADD PRIMARY KEY (`id_mas_research_group`);

--
-- Indexes for table `mas_research_type`
--
ALTER TABLE `mas_research_type`
 ADD PRIMARY KEY (`id_mas_research_type`);

--
-- Indexes for table `mas_review_type`
--
ALTER TABLE `mas_review_type`
 ADD PRIMARY KEY (`id_mas_review_type`);

--
-- Indexes for table `mas_strategic_initiative`
--
ALTER TABLE `mas_strategic_initiative`
 ADD PRIMARY KEY (`id_mas_strategic_initiative`);

--
-- Indexes for table `mas_strategic_objective`
--
ALTER TABLE `mas_strategic_objective`
 ADD PRIMARY KEY (`id_mas_strategic_objective`);

--
-- Indexes for table `mas_times_category`
--
ALTER TABLE `mas_times_category`
 ADD PRIMARY KEY (`id_mas_times_category`);

--
-- Indexes for table `mas_title`
--
ALTER TABLE `mas_title`
 ADD PRIMARY KEY (`id_mas_title`);

--
-- Indexes for table `mas_training_type`
--
ALTER TABLE `mas_training_type`
 ADD PRIMARY KEY (`id_mas_training_type`);

--
-- Indexes for table `Notification`
--
ALTER TABLE `Notification`
 ADD PRIMARY KEY (`id_notification`,`id_user`), ADD KEY `fk_Notification_user1_idx` (`id_user`);

--
-- Indexes for table `organization_item`
--
ALTER TABLE `organization_item`
 ADD PRIMARY KEY (`id_organization_item`), ADD KEY `fk_organization_item_organization_item1_idx` (`id_organization_item_parent`);

--
-- Indexes for table `partnership`
--
ALTER TABLE `partnership`
 ADD PRIMARY KEY (`id_partnership`), ADD KEY `fk_partnership_organization_item1_idx` (`id_organization_item_initiator`), ADD KEY `fk_partnership_program1_idx` (`id_program`), ADD KEY `fk_partnership_mas_project_status1_idx` (`id_mas_project_status`);

--
-- Indexes for table `partnership_activity`
--
ALTER TABLE `partnership_activity`
 ADD PRIMARY KEY (`id_partnership_activity`,`id_partnership`), ADD KEY `fk_partnership_activity_partnership1_idx` (`id_partnership`);

--
-- Indexes for table `partnership_document`
--
ALTER TABLE `partnership_document`
 ADD PRIMARY KEY (`id_partnership_document`,`id_partnership`), ADD KEY `fk_partnership_document_mas_partnership_document_type1_idx` (`id_mas_partnership_document_type`), ADD KEY `fk_partnership_document_partnership1_idx` (`id_partnership`);

--
-- Indexes for table `partnership_information`
--
ALTER TABLE `partnership_information`
 ADD PRIMARY KEY (`id_partnership_information`,`id_partnership`,`id_user`), ADD KEY `fk_partnership_information_partnership1_idx` (`id_partnership`), ADD KEY `fk_partnership_information_user1_idx` (`id_user`);

--
-- Indexes for table `performance_evidence`
--
ALTER TABLE `performance_evidence`
 ADD PRIMARY KEY (`id_performance_evidence`), ADD KEY `fk_performance_evidence_performance_system1_idx` (`id_performance_system`);

--
-- Indexes for table `performance_indicator`
--
ALTER TABLE `performance_indicator`
 ADD PRIMARY KEY (`id_performance_indicator`), ADD KEY `fk_performance_indicator_yearly_performance1_idx` (`id_annual_data`), ADD KEY `fk_performance_indicator_program1_idx` (`id_program`), ADD KEY `fk_performance_indicator_mas_strategic_objective1_idx` (`id_mas_strategic_objective`), ADD KEY `fk_performance_indicator_mas_key_performance1_idx` (`id_mas_key_performance`), ADD KEY `fk_performance_indicator_mas_strategic_initiative1_idx` (`id_mas_strategic_initiative`);

--
-- Indexes for table `performance_quartal`
--
ALTER TABLE `performance_quartal`
 ADD PRIMARY KEY (`id_performance_quartal`,`id_performance_system_item`), ADD KEY `fk_performance_quartal_performance_system_item1_idx` (`id_performance_system_item`), ADD KEY `fk_performance_quartal_target1_idx` (`id_target`);

--
-- Indexes for table `performance_realization`
--
ALTER TABLE `performance_realization`
 ADD PRIMARY KEY (`id_performance_realization`,`id_performance_quartal`), ADD KEY `fk_performance_realization_performance_quartal1_idx` (`id_performance_quartal`), ADD KEY `fk_performance_realization_target_item1_idx` (`id_target_item`);

--
-- Indexes for table `performance_system`
--
ALTER TABLE `performance_system`
 ADD PRIMARY KEY (`id_performance_system`), ADD KEY `fk_performance_system_organization_item1_idx` (`id_organization_item`), ADD KEY `fk_performance_system_employee1_idx` (`id_employee`), ADD KEY `fk_performance_system_yearly_performance1_idx` (`id_annual_data`);

--
-- Indexes for table `performance_system_item`
--
ALTER TABLE `performance_system_item`
 ADD PRIMARY KEY (`id_performance_system_item`,`id_performance_indicator`), ADD KEY `fk_performance_system_item_performance_system1_idx` (`id_performance_system`), ADD KEY `fk_performance_system_item_performance_indicator1_idx` (`id_performance_indicator`), ADD KEY `fk_performance_system_item_performance_system_item1_idx` (`id_performance_system_item_parent`), ADD KEY `fk_performance_system_item_mas_perspective1_idx` (`id_mas_perspective`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
 ADD PRIMARY KEY (`id_program`), ADD KEY `fk_program_organization_item1_idx` (`id_organization_item`), ADD KEY `fk_program_employee1_idx` (`id_employee_po`), ADD KEY `fk_program_employee2_idx` (`id_employee_pm`), ADD KEY `fk_program_yearly_performance1_idx` (`id_annual_data`), ADD KEY `fk_program_mas_project_status1_idx` (`id_mas_project_status`), ADD KEY `fk_program_mas_research_type1_idx` (`id_mas_research_type`);

--
-- Indexes for table `program_target`
--
ALTER TABLE `program_target`
 ADD PRIMARY KEY (`id_program_target`), ADD KEY `fk_program_target_program1_idx` (`id_program`), ADD KEY `fk_program_target_target1_idx` (`id_target`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
 ADD PRIMARY KEY (`id_project`), ADD KEY `fk_project_program1_idx` (`id_program`), ADD KEY `fk_project_organization_item1_idx` (`id_organization_item`), ADD KEY `fk_project_annual_data1_idx` (`id_annual_data`), ADD KEY `fk_project_mas_project_status1_idx` (`id_mas_project_status`), ADD KEY `fk_project_mas_times_category1_idx` (`id_mas_times_category`);

--
-- Indexes for table `project_step`
--
ALTER TABLE `project_step`
 ADD PRIMARY KEY (`id_project_step`,`id_project`), ADD KEY `fk_project_step_project1_idx` (`id_project`);

--
-- Indexes for table `QA_product`
--
ALTER TABLE `QA_product`
 ADD PRIMARY KEY (`id_qa_product`);

--
-- Indexes for table `QA_product_document`
--
ALTER TABLE `QA_product_document`
 ADD PRIMARY KEY (`id_qa_product_document`,`id_qa_product`), ADD KEY `fk_QA_product_document_QA_product1_idx` (`id_qa_product`);

--
-- Indexes for table `research`
--
ALTER TABLE `research`
 ADD PRIMARY KEY (`id_research`), ADD KEY `fk_research_organization_item1_idx` (`id_organization_item`), ADD KEY `fk_research_research_content1_idx` (`id_mas_research_content`), ADD KEY `fk_research_research_group1_idx` (`id_mas_research_group`), ADD KEY `fk_research_program1_idx` (`id_program`), ADD KEY `fk_research_mas_research_type1_idx` (`id_mas_research_type`), ADD KEY `fk_research_mas_project_status1_idx` (`id_mas_project_status`);

--
-- Indexes for table `research_file`
--
ALTER TABLE `research_file`
 ADD PRIMARY KEY (`id_research_file`,`id_research`), ADD KEY `fk_research_document_research1_idx` (`id_research`);

--
-- Indexes for table `research_utilization`
--
ALTER TABLE `research_utilization`
 ADD PRIMARY KEY (`id_research_utilization`), ADD KEY `fk_research_utilization_research1_idx` (`id_research`);

--
-- Indexes for table `review_comment`
--
ALTER TABLE `review_comment`
 ADD PRIMARY KEY (`id_review_comment`), ADD KEY `fk_review_comment_review_management1_idx` (`id_review_management`), ADD KEY `fk_review_comment_user1_idx` (`id_user`);

--
-- Indexes for table `review_management`
--
ALTER TABLE `review_management`
 ADD PRIMARY KEY (`id_review_management`), ADD KEY `fk_review_management_program1_idx` (`id_program`), ADD KEY `fk_review_management_mas_review_type1_idx` (`id_mas_review_type`);

--
-- Indexes for table `target`
--
ALTER TABLE `target`
 ADD PRIMARY KEY (`id_target`);

--
-- Indexes for table `target_item`
--
ALTER TABLE `target_item`
 ADD PRIMARY KEY (`id_target_item`), ADD KEY `fk_target_item_mas_metric1_idx` (`id_mas_metric`), ADD KEY `fk_target_item_target1_idx` (`id_target`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
 ADD PRIMARY KEY (`id_training`), ADD KEY `fk_training_mas_training_type1_idx` (`id_mas_training_type`), ADD KEY `fk_training_mas_times_category1_idx` (`id_mas_times_category`);

--
-- Indexes for table `training_employee`
--
ALTER TABLE `training_employee`
 ADD PRIMARY KEY (`id_training_employee`), ADD KEY `fk_training_employee_training1_idx` (`id_training`), ADD KEY `fk_training_employee_employee1_idx` (`id_employee`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`), ADD KEY `fk_user_user_level1_idx` (`id_user_level`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
 ADD PRIMARY KEY (`id_user_access`), ADD KEY `fk_user_access_user_level1_idx` (`id_user_level`), ADD KEY `fk_user_access_app_files1_idx` (`id_app_files`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
 ADD PRIMARY KEY (`id_user_level`);

--
-- Indexes for table `work_experience`
--
ALTER TABLE `work_experience`
 ADD PRIMARY KEY (`id_work_experience`), ADD KEY `fk_work_experience_employee_idx` (`id_employee`), ADD KEY `fk_work_experience_mas_category1_idx` (`id_mas_times_category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `annual_data`
--
ALTER TABLE `annual_data`
MODIFY `id_annual_data` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bantek`
--
ALTER TABLE `bantek`
MODIFY `id_bantek` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bantek_document`
--
ALTER TABLE `bantek_document`
MODIFY `id_bantek_document` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `certificate_employee`
--
ALTER TABLE `certificate_employee`
MODIFY `id_certificate_employee` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employee_activity_log`
--
ALTER TABLE `employee_activity_log`
MODIFY `id_employee_activity_log` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employee_project`
--
ALTER TABLE `employee_project`
MODIFY `id_employee_project` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `program_target`
--
ALTER TABLE `program_target`
MODIFY `id_program_target` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `project_step`
--
ALTER TABLE `project_step`
MODIFY `id_project_step` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `QA_product`
--
ALTER TABLE `QA_product`
MODIFY `id_qa_product` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `QA_product_document`
--
ALTER TABLE `QA_product_document`
MODIFY `id_qa_product_document` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `research`
--
ALTER TABLE `research`
MODIFY `id_research` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `review_comment`
--
ALTER TABLE `review_comment`
MODIFY `id_review_comment` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `review_management`
--
ALTER TABLE `review_management`
MODIFY `id_review_management` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_files`
--
ALTER TABLE `app_files`
ADD CONSTRAINT `fk_app_files_app_theme1` FOREIGN KEY (`app_theme_id_app_theme`) REFERENCES `app_theme` (`id_app_theme`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bantek`
--
ALTER TABLE `bantek`
ADD CONSTRAINT `fk_bantek_mas_project_status1` FOREIGN KEY (`id_mas_project_status`) REFERENCES `mas_project_status` (`id_mas_project_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bantek_document`
--
ALTER TABLE `bantek_document`
ADD CONSTRAINT `fk_bantek_document_bantek1` FOREIGN KEY (`id_bantek`) REFERENCES `bantek` (`id_bantek`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_bantek_document_mas_partnership_document_type1` FOREIGN KEY (`id_mas_partnership_document_type`) REFERENCES `mas_partnership_document_type` (`id_mas_partnership_document_type`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bantek_information`
--
ALTER TABLE `bantek_information`
ADD CONSTRAINT `fk_bantek_information_bantek1` FOREIGN KEY (`id_bantek`) REFERENCES `bantek` (`id_bantek`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_partnership_information_user10` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bantek_program`
--
ALTER TABLE `bantek_program`
ADD CONSTRAINT `fk_bantek_program_bantek1` FOREIGN KEY (`id_bantek`) REFERENCES `bantek` (`id_bantek`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bantek_utilization`
--
ALTER TABLE `bantek_utilization`
ADD CONSTRAINT `fk_bantek_utilization_bantek1` FOREIGN KEY (`id_bantek`) REFERENCES `bantek` (`id_bantek`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Bantek_work_unit_executor`
--
ALTER TABLE `Bantek_work_unit_executor`
ADD CONSTRAINT `fk_Bantek_work_unit_executor_bantek1` FOREIGN KEY (`id_bantek`) REFERENCES `bantek` (`id_bantek`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Bantek_work_unit_executor_organization_item1` FOREIGN KEY (`id_organization_item`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bko_history`
--
ALTER TABLE `bko_history`
ADD CONSTRAINT `fk_BKO_History_employee1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_bko_history_mas_employee_position1` FOREIGN KEY (`id_mas_employee_position`) REFERENCES `mas_employee_position` (`id_mas_employee_position`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_bko_history_mas_title1` FOREIGN KEY (`id_mas_title`) REFERENCES `mas_title` (`id_mas_title`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_bko_history_organization_item1` FOREIGN KEY (`id_organization_item`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `certificate`
--
ALTER TABLE `certificate`
ADD CONSTRAINT `fk_certificate_mas_category1` FOREIGN KEY (`id_mas_times_category`) REFERENCES `mas_times_category` (`id_mas_times_category`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `competence_employee`
--
ALTER TABLE `competence_employee`
ADD CONSTRAINT `fk_competence_employee_competence1` FOREIGN KEY (`id_mas_competence`) REFERENCES `mas_competence` (`id_mas_competence`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_competence_employee_employee1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
ADD CONSTRAINT `fk_employee_mas_bp1` FOREIGN KEY (`id_mas_bp`) REFERENCES `mas_bp` (`id_mas_bp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_employee_mas_employee_position1` FOREIGN KEY (`id_mas_employee_position`) REFERENCES `mas_employee_position` (`id_mas_employee_position`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_employee_mas_title1` FOREIGN KEY (`id_mas_title`) REFERENCES `mas_title` (`id_mas_title`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_employee_organization_item1` FOREIGN KEY (`id_organization_item`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employee_education`
--
ALTER TABLE `employee_education`
ADD CONSTRAINT `fk_employee_education_employee1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employee_project`
--
ALTER TABLE `employee_project`
ADD CONSTRAINT `fk_employee_project_employee1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_employee_project_mas_employee_project_position1` FOREIGN KEY (`id_mas_employee_project_position`) REFERENCES `mas_employee_project_position` (`id_mas_employee_project_position`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_employee_project_project1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `formula_performance_indicator`
--
ALTER TABLE `formula_performance_indicator`
ADD CONSTRAINT `fk_formula_performance_indicator_formula1` FOREIGN KEY (`id_mas_formula`) REFERENCES `mas_formula` (`id_mas_formula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_formula_performance_indicator_performance_indicator1` FOREIGN KEY (`id_performance_indicator`) REFERENCES `performance_indicator` (`id_performance_indicator`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Innovation_document`
--
ALTER TABLE `Innovation_document`
ADD CONSTRAINT `fk_Innovation_document_Innovation1` FOREIGN KEY (`id_innovation`) REFERENCES `Innovation` (`id_innovation`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `innovation_utilization`
--
ALTER TABLE `innovation_utilization`
ADD CONSTRAINT `fk_innovation_utilization_Innovation1` FOREIGN KEY (`id_innovation`) REFERENCES `Innovation` (`id_innovation`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ip`
--
ALTER TABLE `ip`
ADD CONSTRAINT `fk_ip_organization_item1` FOREIGN KEY (`id_organization_item`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mas_performance_mapping`
--
ALTER TABLE `mas_performance_mapping`
ADD CONSTRAINT `fk_mas_performance_mapping_organization_item1` FOREIGN KEY (`id_organization_item`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_mas_performance_mapping_performance_indicator1` FOREIGN KEY (`id_performance_indicator`) REFERENCES `performance_indicator` (`id_performance_indicator`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Notification`
--
ALTER TABLE `Notification`
ADD CONSTRAINT `fk_Notification_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `partnership`
--
ALTER TABLE `partnership`
ADD CONSTRAINT `fk_partnership_mas_project_status1` FOREIGN KEY (`id_mas_project_status`) REFERENCES `mas_project_status` (`id_mas_project_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_partnership_organization_item1` FOREIGN KEY (`id_organization_item_initiator`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_partnership_program1` FOREIGN KEY (`id_program`) REFERENCES `program` (`id_program`);

--
-- Constraints for table `partnership_activity`
--
ALTER TABLE `partnership_activity`
ADD CONSTRAINT `fk_partnership_activity_partnership1` FOREIGN KEY (`id_partnership`) REFERENCES `partnership` (`id_partnership`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `partnership_document`
--
ALTER TABLE `partnership_document`
ADD CONSTRAINT `fk_partnership_document_mas_partnership_document_type1` FOREIGN KEY (`id_mas_partnership_document_type`) REFERENCES `mas_partnership_document_type` (`id_mas_partnership_document_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_partnership_document_partnership1` FOREIGN KEY (`id_partnership`) REFERENCES `partnership` (`id_partnership`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `partnership_information`
--
ALTER TABLE `partnership_information`
ADD CONSTRAINT `fk_partnership_information_partnership1` FOREIGN KEY (`id_partnership`) REFERENCES `partnership` (`id_partnership`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_partnership_information_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `performance_evidence`
--
ALTER TABLE `performance_evidence`
ADD CONSTRAINT `fk_performance_evidence_performance_system1` FOREIGN KEY (`id_performance_system`) REFERENCES `performance_system` (`id_performance_system`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `performance_indicator`
--
ALTER TABLE `performance_indicator`
ADD CONSTRAINT `fk_performance_indicator_mas_strategic_objective1` FOREIGN KEY (`id_mas_strategic_objective`) REFERENCES `mas_strategic_objective` (`id_mas_strategic_objective`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_performance_indicator_program1` FOREIGN KEY (`id_program`) REFERENCES `program` (`id_program`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `performance_quartal`
--
ALTER TABLE `performance_quartal`
ADD CONSTRAINT `fk_id_target` FOREIGN KEY (`id_target`) REFERENCES `target` (`id_target`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_performance_quartal_performance_system_item1` FOREIGN KEY (`id_performance_system_item`) REFERENCES `performance_system_item` (`id_performance_system_item`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `performance_realization`
--
ALTER TABLE `performance_realization`
ADD CONSTRAINT `fk_performance_realization_performance_quartal1` FOREIGN KEY (`id_performance_quartal`) REFERENCES `performance_quartal` (`id_performance_quartal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `performance_system_item`
--
ALTER TABLE `performance_system_item`
ADD CONSTRAINT `fk_performance_system_item_mas_perspective1` FOREIGN KEY (`id_mas_perspective`) REFERENCES `mas_perspective` (`id_mas_perspective`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_performance_system_item_performance_indicator1` FOREIGN KEY (`id_performance_indicator`) REFERENCES `performance_indicator` (`id_performance_indicator`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_performance_system_item_performance_system1` FOREIGN KEY (`id_performance_system`) REFERENCES `performance_system` (`id_performance_system`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `program`
--
ALTER TABLE `program`
ADD CONSTRAINT `fk_program_mas_project_status1` FOREIGN KEY (`id_mas_project_status`) REFERENCES `mas_project_status` (`id_mas_project_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_program_mas_research_type1` FOREIGN KEY (`id_mas_research_type`) REFERENCES `mas_research_type` (`id_mas_research_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_program_organization_item1` FOREIGN KEY (`id_organization_item`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `program_target`
--
ALTER TABLE `program_target`
ADD CONSTRAINT `fk_program_target_program1` FOREIGN KEY (`id_program`) REFERENCES `program` (`id_program`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_program_target_target1` FOREIGN KEY (`id_target`) REFERENCES `target` (`id_target`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
ADD CONSTRAINT `fk_project_mas_project_status1` FOREIGN KEY (`id_mas_project_status`) REFERENCES `mas_project_status` (`id_mas_project_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_project_mas_times_category1` FOREIGN KEY (`id_mas_times_category`) REFERENCES `mas_times_category` (`id_mas_times_category`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_project_organization_item1` FOREIGN KEY (`id_organization_item`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_project_program1` FOREIGN KEY (`id_program`) REFERENCES `program` (`id_program`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project_step`
--
ALTER TABLE `project_step`
ADD CONSTRAINT `fk_project_step_project1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `research`
--
ALTER TABLE `research`
ADD CONSTRAINT `fk_research_mas_project_status1` FOREIGN KEY (`id_mas_project_status`) REFERENCES `mas_project_status` (`id_mas_project_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_research_mas_research_type1` FOREIGN KEY (`id_mas_research_type`) REFERENCES `mas_research_type` (`id_mas_research_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_research_organization_item1` FOREIGN KEY (`id_organization_item`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_research_program1` FOREIGN KEY (`id_program`) REFERENCES `program` (`id_program`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_research_research_content1` FOREIGN KEY (`id_mas_research_content`) REFERENCES `mas_research_content` (`id_mas_research_content`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_research_research_group1` FOREIGN KEY (`id_mas_research_group`) REFERENCES `mas_research_group` (`id_mas_research_group`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `research_file`
--
ALTER TABLE `research_file`
ADD CONSTRAINT `fk_research_document_research1` FOREIGN KEY (`id_research`) REFERENCES `research` (`id_research`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `research_utilization`
--
ALTER TABLE `research_utilization`
ADD CONSTRAINT `fk_research_utilization_research1` FOREIGN KEY (`id_research`) REFERENCES `research` (`id_research`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `review_comment`
--
ALTER TABLE `review_comment`
ADD CONSTRAINT `fk_review_comment_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `review_management`
--
ALTER TABLE `review_management`
ADD CONSTRAINT `fk_review_management_mas_review_type1` FOREIGN KEY (`id_mas_review_type`) REFERENCES `mas_review_type` (`id_mas_review_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_review_management_program1` FOREIGN KEY (`id_program`) REFERENCES `program` (`id_program`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `target_item`
--
ALTER TABLE `target_item`
ADD CONSTRAINT `fk_target_item_mas_metric1` FOREIGN KEY (`id_mas_metric`) REFERENCES `mas_metric` (`id_mas_metric`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_target_item_target1` FOREIGN KEY (`id_target`) REFERENCES `target` (`id_target`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `training`
--
ALTER TABLE `training`
ADD CONSTRAINT `fk_training_mas_times_category1` FOREIGN KEY (`id_mas_times_category`) REFERENCES `mas_times_category` (`id_mas_times_category`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_training_mas_training_type1` FOREIGN KEY (`id_mas_training_type`) REFERENCES `mas_training_type` (`id_mas_training_type`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `training_employee`
--
ALTER TABLE `training_employee`
ADD CONSTRAINT `fk_training_employee_employee1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_training_employee_training1` FOREIGN KEY (`id_training`) REFERENCES `training` (`id_training`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `fk_user_user_level1` FOREIGN KEY (`id_user_level`) REFERENCES `user_level` (`id_user_level`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_access`
--
ALTER TABLE `user_access`
ADD CONSTRAINT `fk_user_access_app_files1` FOREIGN KEY (`id_app_files`) REFERENCES `app_files` (`id_app_files`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_user_access_user_level1` FOREIGN KEY (`id_user_level`) REFERENCES `user_level` (`id_user_level`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `work_experience`
--
ALTER TABLE `work_experience`
ADD CONSTRAINT `fk_work_experience_employee` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_work_experience_mas_category1` FOREIGN KEY (`id_mas_times_category`) REFERENCES `mas_times_category` (`id_mas_times_category`) ON DELETE NO ACTION ON UPDATE NO ACTION;
