/*
SQLyog Enterprise - MySQL GUI v8.1 
MySQL - 5.6.11 : Database - mydb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `annual_data` */

DROP TABLE IF EXISTS `annual_data`;

CREATE TABLE `annual_data` (
  `id_annual_data` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_annual_data`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `annual_data` */

LOCK TABLES `annual_data` WRITE;

UNLOCK TABLES;

/*Table structure for table `app_config` */

DROP TABLE IF EXISTS `app_config`;

CREATE TABLE `app_config` (
  `key` varchar(55) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `app_config` */

LOCK TABLES `app_config` WRITE;

UNLOCK TABLES;

/*Table structure for table `app_files` */

DROP TABLE IF EXISTS `app_files`;

CREATE TABLE `app_files` (
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
  KEY `fk_app_files_app_theme1_idx` (`app_theme_id_app_theme`),
  CONSTRAINT `fk_app_files_app_theme1` FOREIGN KEY (`app_theme_id_app_theme`) REFERENCES `app_theme` (`id_app_theme`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `app_files` */

LOCK TABLES `app_files` WRITE;

insert  into `app_files`(id_app_files,filename,lang,description,class,color,size,module,app_theme_id_app_theme) values (1,'Dashboard','en','IDeC','icon-dashboard','grey','double','idec',2),(1,'Home','ina','IDeC','icon-dashboard','grey','double','idec',2),(2,'Profile','en','IDeC','','grey','double','profile',3),(2,'Profile','ina','IDeC','','grey','double','profile',3),(3,'Change Password','en','IDeC',NULL,'grey','double','admin_user',3),(3,'Ubah Password','ina','IDeC',NULL,'grey','double','admin_user',3),(4,'Logout','en','IDeC',NULL,'grey','double','admin/logout',3),(4,'Keluar','ina','IDeC',NULL,'grey','double','admin/logout',3),(5,'Files Management','ina','IDeC',NULL,'grey','double','admin_file',3),(6,'Menu management','en','IDeC',NULL,'grey','double','admin_menu',3),(6,'Menu management','ina','IDeC',NULL,'grey','double','admin_menu',3),(7,'Group List','en','IDeC',NULL,'grey','double','admin_group',3),(7,'Group List','ina','IDeC',NULL,'grey','double','admin_group',3),(8,'Content Editor','en','IDeC',NULL,'grey','double','admin_content',3),(8,'Content Editor','ina','IDeC',NULL,'grey','double','admin_content',3),(9,'Group Role','en','IDeC',NULL,'grey','double','admin_role',3),(9,'Group Role','ina','IDeC',NULL,'grey','double','admin_role',3),(10,'Setting Configuration','en','IDeC',NULL,'grey','double','admin_config',3),(10,'Setting Configuration','ina','IDeC',NULL,'grey','double','admin_config',3),(11,'Contact Information','en','IDeC',NULL,'grey','double','admin_contact',3),(11,'Contact Information','ina','IDeC',NULL,'grey','double','admin_contact',3),(12,'Message','en','IDeC','profile','grey','double','msg',2),(12,'Pesan','ina','IDeC','profile','grey','double','msg',2),(13,'Profile','en','IDeC',NULL,'grey','double','#',2),(13,'Profile','ina','IDeC','icon-user','orange','double','#',2),(14,'Data Hasil Riset','en','IDeC',NULL,'grey','double','idec_rms/research',2),(14,'Data Hasil Riset','ina','Data Program','icon-globe','yellow','double','idec_rms/research',2),(15,'Activity','en','IDeC',NULL,'grey','double','#',2),(15,'Kegiatan','ina','IDeC','icon-tasks','orange','double','#',2),(16,'PMS','en','PMS',NULL,'grey','double','#',2),(16,'PMS','ina','Performance Management System','icon-magic','green','double','#',2),(17,'Researcher','en','RMS','profile','grey','double','#',2),(17,'Researcher','ina','Research Management System','icon-beaker','red','double','#',2),(18,'Performance','en','PMS','profile','grey','double','idec_pms/performance',2),(18,'Performance','ina','Performansi untuk masing-masing unit dan researcher','icon-screenshot','blue','double','idec_pms/performance',2),(19,'News','en','IDeC','profile','grey','double','news',2),(19,'Berita','ina','IDeC','profile','grey','double','news',2),(20,'Anouncement','en','IDeC','','grey','double','announcement',2),(20,'Pengumuman','ina','IDeC','','grey','double','announcement',2),(21,'Event','en','IDeC','','grey','double','event',2),(21,'Kegiatan','ina','IDeC','','grey','double','event',2),(22,'Organization Structure','en','Struktur organisasi yang ada di IDec','profile','grey','double','idec_general/organization',2),(22,'Organization Structure','ina','Struktur organisasi yang ada di IDec','icon-sitemap','orange','double','idec_general/organization',2),(23,'Annual Data','en','Pengelompokan program, performansi serta project yang sifatnya tahunan','profile','grey','double','idec_general/annual',2),(23,'Annual Data','ina','Pengelompokan program, performansi serta project yang sifatnya tahunan','icon-tasks','red','double','idec_general/annual',2),(24,'Employee','en','Mengelola data-data karyawan','profile','grey','double','idec_general/employee',2),(24,'Employee','ina','Mengelola data-data karyawan','icon-smile','yellow','double','idec_general/employee',2),(25,'Management Review','en','Mengelola data review program yang sedang berjalan','profile','grey','double','idec_pms/review',2),(25,'Management Review','ina','Mengelola data review program yang sedang berjalan','icon-check','purple','double','idec_pms/review',2),(26,'Program','en','Mengatur data program kerja tahunan di organisasi IDeC','profile','red','double','idec_pms/program',2),(26,'Program','ina','Mengatur data program kerja tahunan di organisasi IDeC','icon-book','red','double','idec_pms/program',2),(27,'Riset','en','Pengalokasian researcher dalam suatu project','profile','blue','double','##',2),(27,'Riset','ina','Riset','icon-eye-open','blue','double','##',2),(28,'Penilaian Research','en','Data Hasil Riset,Inovasi, Partnership\r\n','profile','yellow','double','#',2),(28,'Penilaian Research','ina','Data Hasil Riset,Inovasi, Partnership','icon-flag','yellow','double','#',2),(29,'Result','en','Data researcher, pelatihan dan HAKI','profile','green','double','##',2),(29,'Result','ina','Result','icon-download-alt','green','double','##',2),(30,'Project Researcher','en','Management data per project','profile','red','double','idec_rms/project',2),(30,'Project Researcher','ina','Management data per project','icon-flag-checkered','red','double','idec_rms/project',2),(31,'Data Researcher','en','Management data per researcher','profile','purple','double','idec_rms/researcher',2),(31,'Data Researcher','ina','Management data per researcher','icon-group','purple','double','idec_rms/researcher',2),(32,'Permintaan QA','en','RMS','profile','green','double','##',2),(32,'Permintaan QA','ina','Permintaan QA','profile','green','double','##',2),(33,'Data Hasil Inovasi','en','Informasi riset dan inovasi','profile','purple','double','idec_rms/research',2),(33,'Data Hasil Inovasi','ina','Informasi riset dan inovasi','icon-hdd','purple','double','idec_rms/research',2),(34,'Training','en','Informasi training','profile','yellow','double','idec_rms/training',2),(34,'Training','ina','Informasi training','icon-puzzle-piece','yellow','double','idec_rms/training',2),(35,'Data Hasil Partnership','en','Informasi partnership','profile','red','double','idec_rms/partnership',2),(35,'Data Hasil Partnership','ina','Informasi partnership','icon-group','red','double','idec_rms/partnership',2),(36,'HAKI','en','Informasi HAKI','profile','green','double','idec_rms/haki',2),(36,'HAKI','ina','Informasi HAKI','icon-key','green','double','idec_rms/haki',2),(37,'Sertifikasi','en','Informasi sertifikasi','profile','purple','double','idec_rms/certificate',2),(37,'Sertifikasi','ina','Informasi sertifikasi','icon-certificate','purple','double','idec_rms/certificate',2),(38,'BKO Researcher','en',NULL,'profile','silver',NULL,'idec_rms/researcher_map',2),(38,'BKO Researcher','ina','Pemetaan Researcher','icon-globe','red','double','idec_rms/researcher_map',2),(39,'Research Management','en',NULL,'profile','silver',NULL,'#',2),(39,'Research Management','ina','Result Management','icon-check','orange','double','#',2),(40,'Logout','en',NULL,'profile','silver',NULL,'idec/logout',2),(40,'Logout','ina','Logout','icon-off','orange','','idec/logout',2),(41,'Result','en',NULL,'profile','silver',NULL,'##',2),(41,'Result','ina','Result Inovasi','icon-hdd','orange','','##',2),(42,'Pemanfataan lebih luas','en',NULL,'profile','silver',NULL,'##',2),(42,'Pemanfataan lebih luas','ina','Pemanfataan lebih luas inovasi','icon-inbox','orange','','##',2),(43,'Inovasi (Internal/Eksternal)','en',NULL,'profile','silver',NULL,'##',2),(43,'Inovasi (Internal/Eksternal)','ina','Inovasi (Internal/Eksternal)','icon-upload-alt','orange','','##',2),(44,'Pemanfataan lebih luas','en',NULL,'profile','silver',NULL,'##',2),(44,'Pemanfataan lebih luas','ina','Pemanfataan lebih luas','','orange','','##',2),(45,'QA','en',NULL,'profile','silver',NULL,'##',2),(45,'QA','ina','QA','icon-thumbs-up','blue','double','##',2),(46,'Data Hasil QA','en',NULL,'profile','silver',NULL,'##',2),(46,'Data Hasil QA','ina','Result','','orange','','##',2),(47,'Partnership','en',NULL,'profile','silver',NULL,'##',2),(47,'Partnership','ina','Partnership','icon-retweet','orange','','##',2),(48,'Hasil akhir','en',NULL,'profile','silver',NULL,'##',2),(48,'Hasil akhir','ina','Hasil akhir','','orange','','##',2),(49,'Bantek','en',NULL,'profile','silver',NULL,'##',2),(49,'Bantek','ina','','icon-qrcode','orange','','##',2),(50,'Data Hasil BANTEK','en',NULL,'profile','silver',NULL,'idec_rms/partnership',2),(50,'Data Hasil BANTEK','ina','Data program','','orange','','idec_rms/partnership',2),(51,'Result','en',NULL,'profile','silver',NULL,'##',2),(51,'Result','ina','Result','','orange','','##',2),(52,'Pemanfataan lebih luas','en',NULL,'profile','silver',NULL,'##',2),(52,'Pemanfataan lebih luas','ina','Pemanfataan lebih luas','','orange','','##',2),(53,'Others','en',NULL,'profile','silver',NULL,'##',2),(53,'Others','ina','Others','icon-quote-right','orange','','##',2),(54,'Project Bidang','en',NULL,'profile','silver',NULL,'idec_rms/projectbidang',2),(54,'Project Bidang','ina','Project Bidang','icon-tags','orange','','idec_rms/projectbidang',2);

UNLOCK TABLES;

/*Table structure for table `app_menus` */

DROP TABLE IF EXISTS `app_menus`;

CREATE TABLE `app_menus` (
  `position` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `sub_id` int(10) NOT NULL DEFAULT '0',
  `sort` int(10) NOT NULL DEFAULT '0',
  `file_id` int(10) NOT NULL,
  `id_theme` int(10) DEFAULT NULL,
  PRIMARY KEY (`position`,`id`),
  KEY `fk_menus_files` (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `app_menus` */

LOCK TABLES `app_menus` WRITE;

insert  into `app_menus`(position,id,sub_id,sort,file_id,id_theme) values (3,1,0,0,1,2),(3,8,2,0,18,2),(3,10,2,2,25,2),(3,2,1,1,16,2),(3,4,1,0,14,2),(3,7,4,3,24,2),(3,6,4,2,23,2),(3,3,1,2,17,2),(3,9,2,1,26,2),(3,5,4,1,22,2),(3,11,3,0,27,2),(3,12,3,1,28,2),(3,13,3,2,29,2),(3,26,11,2,30,2),(3,15,11,0,31,2),(3,23,12,2,33,2),(3,25,11,1,38,2),(3,18,13,1,34,2),(3,22,12,1,35,2),(3,20,13,2,36,2),(3,21,13,3,37,2),(1,1,0,0,1,2),(1,8,2,1,18,2),(1,10,2,2,25,2),(1,2,0,3,16,2),(1,29,1,1,22,2),(1,30,1,2,23,2),(1,31,1,3,24,2),(1,3,0,1,17,2),(1,9,2,0,26,2),(1,32,3,0,31,2),(1,40,39,1,14,2),(1,33,3,2,38,2),(1,36,35,0,33,2),(1,35,4,0,43,2),(1,34,3,3,30,2),(1,39,4,1,27,2),(1,42,39,3,44,2),(1,43,4,2,45,2),(1,4,0,2,39,2),(1,5,0,4,40,2),(1,38,35,2,42,2),(1,45,43,2,46,2),(1,46,4,3,47,2),(1,47,46,1,35,2),(1,49,4,4,49,2),(1,50,49,1,50,2),(1,52,49,3,52,2),(1,53,4,5,53,2),(1,54,53,1,36,2),(1,55,53,2,37,2),(1,56,53,3,34,2),(1,57,3,1,54,2);

UNLOCK TABLES;

/*Table structure for table `app_theme` */

DROP TABLE IF EXISTS `app_theme`;

CREATE TABLE `app_theme` (
  `id_app_theme` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `folder` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_app_theme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `app_theme` */

LOCK TABLES `app_theme` WRITE;

insert  into `app_theme`(id_app_theme,name,folder) values (2,'IDeC','themes/idec/'),(3,'Admin Panel','themes/admin/');

UNLOCK TABLES;

/*Table structure for table `app_user_activity` */

DROP TABLE IF EXISTS `app_user_activity`;

CREATE TABLE `app_user_activity` (
  `id_app_user_activity` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `activity_type` varchar(45) DEFAULT NULL,
  `activity` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_app_user_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `app_user_activity` */

LOCK TABLES `app_user_activity` WRITE;

UNLOCK TABLES;

/*Table structure for table `bantek` */

DROP TABLE IF EXISTS `bantek`;

CREATE TABLE `bantek` (
  `id_bantek` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(250) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `id_mas_project_status` int(11) NOT NULL,
  PRIMARY KEY (`id_bantek`),
  KEY `fk_bantek_mas_project_status1_idx` (`id_mas_project_status`),
  CONSTRAINT `fk_bantek_mas_project_status1` FOREIGN KEY (`id_mas_project_status`) REFERENCES `mas_project_status` (`id_mas_project_status`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bantek` */

LOCK TABLES `bantek` WRITE;

UNLOCK TABLES;

/*Table structure for table `bantek_document` */

DROP TABLE IF EXISTS `bantek_document`;

CREATE TABLE `bantek_document` (
  `id_bantek_document` int(11) NOT NULL AUTO_INCREMENT,
  `document` varchar(255) DEFAULT NULL,
  `id_bantek` int(11) NOT NULL,
  `id_mas_partnership_document_type` int(11) NOT NULL,
  PRIMARY KEY (`id_bantek_document`,`id_bantek`),
  KEY `fk_bantek_document_bantek1_idx` (`id_bantek`),
  KEY `fk_bantek_document_mas_partnership_document_type1_idx` (`id_mas_partnership_document_type`),
  CONSTRAINT `fk_bantek_document_bantek1` FOREIGN KEY (`id_bantek`) REFERENCES `bantek` (`id_bantek`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bantek_document_mas_partnership_document_type1` FOREIGN KEY (`id_mas_partnership_document_type`) REFERENCES `mas_partnership_document_type` (`id_mas_partnership_document_type`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bantek_document` */

LOCK TABLES `bantek_document` WRITE;

UNLOCK TABLES;

/*Table structure for table `bantek_information` */

DROP TABLE IF EXISTS `bantek_information`;

CREATE TABLE `bantek_information` (
  `id_bantek_information` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `title` text,
  `content` text,
  `id_user` int(11) NOT NULL,
  `id_bantek` int(11) NOT NULL,
  PRIMARY KEY (`id_bantek_information`,`id_user`,`id_bantek`),
  KEY `fk_partnership_information_user1_idx` (`id_user`),
  KEY `fk_bantek_information_bantek1_idx` (`id_bantek`),
  CONSTRAINT `fk_bantek_information_bantek1` FOREIGN KEY (`id_bantek`) REFERENCES `bantek` (`id_bantek`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_partnership_information_user10` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bantek_information` */

LOCK TABLES `bantek_information` WRITE;

UNLOCK TABLES;

/*Table structure for table `bantek_program` */

DROP TABLE IF EXISTS `bantek_program`;

CREATE TABLE `bantek_program` (
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
  KEY `fk_bantek_program_bantek1_idx` (`id_bantek`),
  CONSTRAINT `fk_bantek_program_bantek1` FOREIGN KEY (`id_bantek`) REFERENCES `bantek` (`id_bantek`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bantek_program` */

LOCK TABLES `bantek_program` WRITE;

UNLOCK TABLES;

/*Table structure for table `bantek_utilization` */

DROP TABLE IF EXISTS `bantek_utilization`;

CREATE TABLE `bantek_utilization` (
  `id_bantek_utilization` int(11) NOT NULL,
  `utilization` text,
  `id_bantek` int(11) NOT NULL,
  PRIMARY KEY (`id_bantek_utilization`,`id_bantek`),
  KEY `fk_bantek_utilization_bantek1_idx` (`id_bantek`),
  CONSTRAINT `fk_bantek_utilization_bantek1` FOREIGN KEY (`id_bantek`) REFERENCES `bantek` (`id_bantek`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bantek_utilization` */

LOCK TABLES `bantek_utilization` WRITE;

UNLOCK TABLES;

/*Table structure for table `bantek_work_unit_executor` */

DROP TABLE IF EXISTS `bantek_work_unit_executor`;

CREATE TABLE `bantek_work_unit_executor` (
  `id_bantek_work_unit_executor` int(11) NOT NULL,
  `id_organization_item` int(11) NOT NULL,
  `id_bantek` int(11) NOT NULL,
  PRIMARY KEY (`id_bantek_work_unit_executor`,`id_bantek`),
  KEY `fk_Bantek_work_unit_executor_organization_item1_idx` (`id_organization_item`),
  KEY `fk_Bantek_work_unit_executor_bantek1_idx` (`id_bantek`),
  CONSTRAINT `fk_Bantek_work_unit_executor_bantek1` FOREIGN KEY (`id_bantek`) REFERENCES `bantek` (`id_bantek`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Bantek_work_unit_executor_organization_item1` FOREIGN KEY (`id_organization_item`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bantek_work_unit_executor` */

LOCK TABLES `bantek_work_unit_executor` WRITE;

UNLOCK TABLES;

/*Table structure for table `bko_history` */

DROP TABLE IF EXISTS `bko_history`;

CREATE TABLE `bko_history` (
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
  KEY `fk_bko_history_mas_employee_position1_idx` (`id_mas_employee_position`),
  CONSTRAINT `fk_BKO_History_employee1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bko_history_mas_employee_position1` FOREIGN KEY (`id_mas_employee_position`) REFERENCES `mas_employee_position` (`id_mas_employee_position`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bko_history_mas_title1` FOREIGN KEY (`id_mas_title`) REFERENCES `mas_title` (`id_mas_title`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bko_history_organization_item1` FOREIGN KEY (`id_organization_item`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bko_history` */

LOCK TABLES `bko_history` WRITE;

UNLOCK TABLES;

/*Table structure for table `certificate` */

DROP TABLE IF EXISTS `certificate`;

CREATE TABLE `certificate` (
  `id_certificate` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `organizer` varchar(255) DEFAULT NULL,
  `id_mas_times_category` int(11) NOT NULL,
  PRIMARY KEY (`id_certificate`),
  KEY `fk_certificate_mas_category1_idx` (`id_mas_times_category`),
  CONSTRAINT `fk_certificate_mas_category1` FOREIGN KEY (`id_mas_times_category`) REFERENCES `mas_times_category` (`id_mas_times_category`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `certificate` */

LOCK TABLES `certificate` WRITE;

UNLOCK TABLES;

/*Table structure for table `certificate_employee` */

DROP TABLE IF EXISTS `certificate_employee`;

CREATE TABLE `certificate_employee` (
  `id_certificate_employee` int(11) NOT NULL,
  `file_upload` varchar(45) DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `id_employee` int(11) NOT NULL,
  `id_certificate` int(11) NOT NULL,
  PRIMARY KEY (`id_certificate_employee`),
  KEY `fk_certificate_employee_employee1_idx` (`id_employee`),
  KEY `fk_certificate_employee_certificate1_idx` (`id_certificate`),
  CONSTRAINT `fk_certificate_employee_certificate1` FOREIGN KEY (`id_certificate`) REFERENCES `certificate` (`id_certificate`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_certificate_employee_employee1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `certificate_employee` */

LOCK TABLES `certificate_employee` WRITE;

UNLOCK TABLES;

/*Table structure for table `competence_employee` */

DROP TABLE IF EXISTS `competence_employee`;

CREATE TABLE `competence_employee` (
  `id_competence_employee` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL,
  `id_mas_competence` int(11) NOT NULL,
  PRIMARY KEY (`id_competence_employee`),
  KEY `fk_competence_employee_employee1_idx` (`id_employee`),
  KEY `fk_competence_employee_competence1_idx` (`id_mas_competence`),
  CONSTRAINT `fk_competence_employee_competence1` FOREIGN KEY (`id_mas_competence`) REFERENCES `mas_competence` (`id_mas_competence`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_competence_employee_employee1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `competence_employee` */

LOCK TABLES `competence_employee` WRITE;

insert  into `competence_employee`(id_competence_employee,id_employee,id_mas_competence) values (1,1,1),(2,1,2),(6,4,1),(7,4,5),(8,5,5);

UNLOCK TABLES;

/*Table structure for table `employee` */

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
  `id_employee` int(11) NOT NULL,
  `nik` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `gender` set('male','female') DEFAULT NULL,
  `information` longtext,
  `date_of_birth` date DEFAULT NULL,
  `start_work` date DEFAULT NULL,
  `cv_document` varchar(255) DEFAULT NULL,
  `id_organization_item` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `id_mas_title` int(11) DEFAULT NULL,
  `id_mas_bp` int(11) DEFAULT NULL,
  `id_mas_employee_position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_employee`,`id_user`),
  KEY `fk_employee_organization_item1_idx` (`id_organization_item`),
  KEY `fk_employee_user1_idx` (`id_user`),
  KEY `fk_employee_mas_title1_idx` (`id_mas_title`),
  KEY `fk_employee_mas_bp1_idx` (`id_mas_bp`),
  KEY `fk_employee_mas_employee_position1_idx` (`id_mas_employee_position`),
  CONSTRAINT `fk_employee_mas_bp1` FOREIGN KEY (`id_mas_bp`) REFERENCES `mas_bp` (`id_mas_bp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_mas_employee_position1` FOREIGN KEY (`id_mas_employee_position`) REFERENCES `mas_employee_position` (`id_mas_employee_position`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_mas_title1` FOREIGN KEY (`id_mas_title`) REFERENCES `mas_title` (`id_mas_title`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_organization_item1` FOREIGN KEY (`id_organization_item`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `employee` */

LOCK TABLES `employee` WRITE;

insert  into `employee`(id_employee,nik,name,gender,information,date_of_birth,start_work,cv_document,id_organization_item,id_user,photo,id_mas_title,id_mas_bp,id_mas_employee_position) values (1,'099991111','Dummytester','male',NULL,'2015-05-22','2015-05-01','75c86e02e22bd60e80e4647db9c90786.docx',2,1,NULL,1,1,2),(2,'900000','Dummytester 02','female',NULL,'2015-05-06','2015-05-25','9c95ffe792a79cafc4e3360e02f3b08e.docx',3,1,NULL,1,2,3),(3,'9800000','Dummytester 03','male',NULL,'2015-05-06','2015-05-04','574e0b1a2dfc62e5d29343f08dcd8c29.docx',4,1,NULL,1,2,3),(4,'0987888888','Dummytester 04','male',NULL,NULL,NULL,'3c6afcd37245034c5ff5c56b748f85be.docx',2,2,NULL,NULL,2,1),(5,'09878888889','Dummytester 05','male',NULL,NULL,NULL,'3c6afcd37245034c5ff5c56b748f85be.docx',4,1,NULL,1,2,1);

UNLOCK TABLES;

/*Table structure for table `employee_activity_log` */

DROP TABLE IF EXISTS `employee_activity_log`;

CREATE TABLE `employee_activity_log` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `employee_activity_log` */

LOCK TABLES `employee_activity_log` WRITE;

insert  into `employee_activity_log`(id_employee_activity_log,activity_start_date,activity_end_date,activity_name,activity_detail,location,percent_progress,last_progress_update,id_employee_project,id_project_step,id_mas_project_status) values (1,'2016-01-03','2016-01-06','Validated Products','Validated Products','Bandung',NULL,NULL,3,4,2),(2,'2015-06-01','2015-06-06','Validated Business model','Validated Business model','Bandung',NULL,NULL,3,5,1);

UNLOCK TABLES;

/*Table structure for table `employee_education` */

DROP TABLE IF EXISTS `employee_education`;

CREATE TABLE `employee_education` (
  `id_employee_education` int(11) NOT NULL,
  `education_degree` varchar(5) DEFAULT NULL,
  `institute` varchar(255) DEFAULT NULL,
  `major` varchar(45) DEFAULT NULL,
  `start_year` year(4) DEFAULT NULL,
  `end_year` year(4) DEFAULT NULL,
  `id_employee` int(11) NOT NULL,
  PRIMARY KEY (`id_employee_education`,`id_employee`),
  KEY `fk_employee_education_employee1_idx` (`id_employee`),
  CONSTRAINT `fk_employee_education_employee1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `employee_education` */

LOCK TABLES `employee_education` WRITE;

insert  into `employee_education`(id_employee_education,education_degree,institute,major,start_year,end_year,id_employee) values (1,'S1','Institute Telkom','Teknik',2010,2013,1);

UNLOCK TABLES;

/*Table structure for table `employee_project` */

DROP TABLE IF EXISTS `employee_project`;

CREATE TABLE `employee_project` (
  `id_employee_project` int(11) NOT NULL AUTO_INCREMENT,
  `job_desc` varchar(255) DEFAULT NULL,
  `id_mas_employee_project_position` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL,
  `is_draft` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_employee_project`),
  KEY `fk_employee_project_mas_employee_project_position1_idx` (`id_mas_employee_project_position`),
  KEY `fk_employee_project_project1_idx` (`id_project`),
  KEY `fk_employee_project_employee1_idx` (`id_employee`),
  CONSTRAINT `fk_employee_project_employee1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_project_mas_employee_project_position1` FOREIGN KEY (`id_mas_employee_project_position`) REFERENCES `mas_employee_project_position` (`id_mas_employee_project_position`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_project_project1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `employee_project` */

LOCK TABLES `employee_project` WRITE;

insert  into `employee_project`(id_employee_project,job_desc,id_mas_employee_project_position,id_project,id_employee,is_draft) values (3,NULL,1,2,4,NULL),(4,NULL,1,3,4,NULL);

UNLOCK TABLES;

/*Table structure for table `formula_performance_indicator` */

DROP TABLE IF EXISTS `formula_performance_indicator`;

CREATE TABLE `formula_performance_indicator` (
  `id_formula_performance_indicator` int(11) NOT NULL,
  `id_mas_formula` int(11) NOT NULL,
  `id_performance_indicator` int(11) NOT NULL,
  PRIMARY KEY (`id_formula_performance_indicator`),
  KEY `fk_formula_performance_indicator_formula1_idx` (`id_mas_formula`),
  KEY `fk_formula_performance_indicator_performance_indicator1_idx` (`id_performance_indicator`),
  CONSTRAINT `fk_formula_performance_indicator_formula1` FOREIGN KEY (`id_mas_formula`) REFERENCES `mas_formula` (`id_mas_formula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_formula_performance_indicator_performance_indicator1` FOREIGN KEY (`id_performance_indicator`) REFERENCES `performance_indicator` (`id_performance_indicator`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `formula_performance_indicator` */

LOCK TABLES `formula_performance_indicator` WRITE;

UNLOCK TABLES;

/*Table structure for table `innovation` */

DROP TABLE IF EXISTS `innovation`;

CREATE TABLE `innovation` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `innovation` */

LOCK TABLES `innovation` WRITE;

UNLOCK TABLES;

/*Table structure for table `innovation_document` */

DROP TABLE IF EXISTS `innovation_document`;

CREATE TABLE `innovation_document` (
  `id_innovation_document` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `description` text,
  `received_date` date DEFAULT NULL,
  `id_innovation` int(11) NOT NULL,
  PRIMARY KEY (`id_innovation_document`,`id_innovation`),
  KEY `fk_Innovation_document_Innovation1_idx` (`id_innovation`),
  CONSTRAINT `fk_Innovation_document_Innovation1` FOREIGN KEY (`id_innovation`) REFERENCES `innovation` (`id_innovation`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `innovation_document` */

LOCK TABLES `innovation_document` WRITE;

UNLOCK TABLES;

/*Table structure for table `innovation_utilization` */

DROP TABLE IF EXISTS `innovation_utilization`;

CREATE TABLE `innovation_utilization` (
  `id_innovation_utilization` int(11) NOT NULL,
  `utilization` text,
  `id_innovation` int(11) NOT NULL,
  PRIMARY KEY (`id_innovation_utilization`),
  KEY `fk_innovation_utilization_Innovation1_idx` (`id_innovation`),
  CONSTRAINT `fk_innovation_utilization_Innovation1` FOREIGN KEY (`id_innovation`) REFERENCES `innovation` (`id_innovation`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `innovation_utilization` */

LOCK TABLES `innovation_utilization` WRITE;

UNLOCK TABLES;

/*Table structure for table `ip` */

DROP TABLE IF EXISTS `ip`;

CREATE TABLE `ip` (
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
  KEY `fk_ip_organization_item1_idx` (`id_organization_item`),
  CONSTRAINT `fk_ip_organization_item1` FOREIGN KEY (`id_organization_item`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ip` */

LOCK TABLES `ip` WRITE;

UNLOCK TABLES;

/*Table structure for table `mas_bp` */

DROP TABLE IF EXISTS `mas_bp`;

CREATE TABLE `mas_bp` (
  `id_mas_bp` int(11) NOT NULL AUTO_INCREMENT,
  `bp` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mas_bp`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `mas_bp` */

LOCK TABLES `mas_bp` WRITE;

insert  into `mas_bp`(id_mas_bp,bp) values (1,'I'),(2,'II'),(3,'III'),(4,'IV'),(5,'V'),(6,'VI');

UNLOCK TABLES;

/*Table structure for table `mas_competence` */

DROP TABLE IF EXISTS `mas_competence`;

CREATE TABLE `mas_competence` (
  `id_mas_competence` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id_mas_competence`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `mas_competence` */

LOCK TABLES `mas_competence` WRITE;

insert  into `mas_competence`(id_mas_competence,name,description) values (1,'Telecomunication',NULL),(2,'Information',NULL),(3,'Media',NULL),(4,'Education',NULL),(5,'Service',NULL);

UNLOCK TABLES;

/*Table structure for table `mas_employee_position` */

DROP TABLE IF EXISTS `mas_employee_position`;

CREATE TABLE `mas_employee_position` (
  `id_mas_employee_position` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mas_employee_position`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `mas_employee_position` */

LOCK TABLES `mas_employee_position` WRITE;

insert  into `mas_employee_position`(id_mas_employee_position,position) values (1,'RESEARCHER'),(2,'SENIOR GENERAL MANAGER'),(3,'DEPUTY SGM'),(4,'SENIOR MANAGER'),(5,'MANAGER'),(6,'OFFICER 1'),(7,'OFFICER 2'),(8,'ENGINEER 1'),(9,'ENGINEER 2'),(10,'ENGINEER 3');

UNLOCK TABLES;

/*Table structure for table `mas_employee_project_position` */

DROP TABLE IF EXISTS `mas_employee_project_position`;

CREATE TABLE `mas_employee_project_position` (
  `id_mas_employee_project_position` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(25) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mas_employee_project_position`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `mas_employee_project_position` */

LOCK TABLES `mas_employee_project_position` WRITE;

insert  into `mas_employee_project_position`(id_mas_employee_project_position,position,weight) values (1,'PM',5),(2,'Shared',1),(3,'Dedicated',3);

UNLOCK TABLES;

/*Table structure for table `mas_formula` */

DROP TABLE IF EXISTS `mas_formula`;

CREATE TABLE `mas_formula` (
  `id_mas_formula` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `type` set('achievement','realization') DEFAULT NULL,
  `content` text,
  `description` text,
  `formula_upload` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_mas_formula`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `mas_formula` */

LOCK TABLES `mas_formula` WRITE;

insert  into `mas_formula`(id_mas_formula,name,type,content,description,formula_upload) values (1,'F1','achievement',NULL,NULL,NULL),(2,'F2','achievement',NULL,NULL,NULL),(3,'F3','achievement',NULL,NULL,NULL),(4,'F4','achievement',NULL,NULL,NULL),(5,'F5','achievement',NULL,NULL,NULL),(6,'F6','achievement',NULL,NULL,NULL),(7,'F7','achievement',NULL,NULL,NULL),(8,'R1','realization',NULL,NULL,NULL),(9,'R2','realization',NULL,NULL,NULL),(10,'R3','realization',NULL,NULL,NULL),(11,'R4','realization',NULL,NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `mas_innovation` */

DROP TABLE IF EXISTS `mas_innovation`;

CREATE TABLE `mas_innovation` (
  `id_mas_innovation` int(11) NOT NULL AUTO_INCREMENT,
  `data_type` set('innovation_type','last_step','product_category') DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_mas_innovation`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Data for the table `mas_innovation` */

LOCK TABLES `mas_innovation` WRITE;

insert  into `mas_innovation`(id_mas_innovation,data_type,value) values (1,'product_category','Product   '),(2,'product_category','Platform   '),(3,'product_category','Service  '),(4,'product_category','Process   '),(5,'product_category','Application   '),(6,'product_category','Prototype   '),(7,'product_category','Others  '),(8,'last_step','Customer Validation'),(9,'last_step','Product Validation'),(10,'last_step','Business Model Validation'),(11,'last_step','Handover to DDB'),(12,'innovation_type','Cloud - IaaS (Public)'),(13,'innovation_type','Cloud - Consumer SaaS '),(14,'innovation_type','Cloud - Business SaaS'),(15,'innovation_type','Cloud - SaaS Marketplace (Include PaaS)'),(16,'innovation_type','Financial Service - DOB'),(17,'innovation_type','Financial Service - Non DOB Payments'),(18,'innovation_type','Financial Service - Insurance'),(19,'innovation_type','Financial Service - Credit'),(20,'innovation_type','Financial Service - Savings'),(21,'innovation_type','Advertising - Agency'),(22,'innovation_type','Advertising - Incentive Marketing'),(23,'innovation_type','Media - Portal / Static Content'),(24,'innovation_type','Media - Streaming & Games'),(25,'innovation_type','Media - Social / UGC'),(26,'innovation_type','Media - Others');

UNLOCK TABLES;

/*Table structure for table `mas_key_performance` */

DROP TABLE IF EXISTS `mas_key_performance`;

CREATE TABLE `mas_key_performance` (
  `id_mas_key_performance` int(11) NOT NULL AUTO_INCREMENT,
  `key_performance` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_mas_key_performance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mas_key_performance` */

LOCK TABLES `mas_key_performance` WRITE;

UNLOCK TABLES;

/*Table structure for table `mas_metric` */

DROP TABLE IF EXISTS `mas_metric`;

CREATE TABLE `mas_metric` (
  `id_mas_metric` int(11) NOT NULL AUTO_INCREMENT,
  `metric` varchar(45) DEFAULT NULL,
  `metric_type` set('quantity','date') DEFAULT NULL,
  PRIMARY KEY (`id_mas_metric`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `mas_metric` */

LOCK TABLES `mas_metric` WRITE;

insert  into `mas_metric`(id_mas_metric,metric,metric_type) values (1,NULL,'date'),(2,NULL,'quantity');

UNLOCK TABLES;

/*Table structure for table `mas_partnership_document_type` */

DROP TABLE IF EXISTS `mas_partnership_document_type`;

CREATE TABLE `mas_partnership_document_type` (
  `id_mas_partnership_document_type` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `type_for` set('partnership','bantek') DEFAULT NULL,
  PRIMARY KEY (`id_mas_partnership_document_type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `mas_partnership_document_type` */

LOCK TABLES `mas_partnership_document_type` WRITE;

insert  into `mas_partnership_document_type`(id_mas_partnership_document_type,type,type_for) values (1,'PKS','partnership'),(2,'Justifikasi','partnership'),(3,'Lampiran','partnership'),(4,'Dasar Permintaan','bantek');

UNLOCK TABLES;

/*Table structure for table `mas_performance_mapping` */

DROP TABLE IF EXISTS `mas_performance_mapping`;

CREATE TABLE `mas_performance_mapping` (
  `id_mas_performance_mapping` int(11) NOT NULL AUTO_INCREMENT,
  `id_performance_indicator` int(11) NOT NULL,
  `performance_type` set('bidang','individu') DEFAULT NULL,
  `id_organization_item` int(11) NOT NULL,
  PRIMARY KEY (`id_mas_performance_mapping`),
  KEY `fk_mas_performance_mapping_organization_item1_idx` (`id_organization_item`),
  KEY `fk_mas_performance_mapping_performance_indicator1_idx` (`id_performance_indicator`),
  CONSTRAINT `fk_mas_performance_mapping_organization_item1` FOREIGN KEY (`id_organization_item`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mas_performance_mapping_performance_indicator1` FOREIGN KEY (`id_performance_indicator`) REFERENCES `performance_indicator` (`id_performance_indicator`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mas_performance_mapping` */

LOCK TABLES `mas_performance_mapping` WRITE;

UNLOCK TABLES;

/*Table structure for table `mas_perspective` */

DROP TABLE IF EXISTS `mas_perspective`;

CREATE TABLE `mas_perspective` (
  `id_mas_perspective` int(11) NOT NULL AUTO_INCREMENT,
  `perspective` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mas_perspective`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mas_perspective` */

LOCK TABLES `mas_perspective` WRITE;

UNLOCK TABLES;

/*Table structure for table `mas_project_status` */

DROP TABLE IF EXISTS `mas_project_status`;

CREATE TABLE `mas_project_status` (
  `id_mas_project_status` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mas_project_status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `mas_project_status` */

LOCK TABLES `mas_project_status` WRITE;

insert  into `mas_project_status`(id_mas_project_status,status) values (1,'On Going'),(2,'Close');

UNLOCK TABLES;

/*Table structure for table `mas_research_content` */

DROP TABLE IF EXISTS `mas_research_content`;

CREATE TABLE `mas_research_content` (
  `id_mas_research_content` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `id_mas_research_type` int(11) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id_mas_research_content`),
  KEY `FK_mas_research_content` (`id_mas_research_type`),
  CONSTRAINT `FK_mas_research_content` FOREIGN KEY (`id_mas_research_type`) REFERENCES `mas_research_type` (`id_mas_research_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mas_research_content` */

LOCK TABLES `mas_research_content` WRITE;

UNLOCK TABLES;

/*Table structure for table `mas_research_group` */

DROP TABLE IF EXISTS `mas_research_group`;

CREATE TABLE `mas_research_group` (
  `id_mas_research_group` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `type` set('techincal','business') DEFAULT NULL,
  PRIMARY KEY (`id_mas_research_group`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `mas_research_group` */

LOCK TABLES `mas_research_group` WRITE;

insert  into `mas_research_group`(id_mas_research_group,code,name,description,type) values (1,'STEL','Spesifikasi Telekomunikasi','Spesifikasi Telekomunikasi , mencakup semua dokumen yang berisi penjelasan secara rinci tentang suatu sistem, teknologi, atau perangkat.','techincal'),(2,'STD','Standar Sistem Telekomunikasi','Standar Sistem Telekomunikasi, mencakup semua dokumen yang berisi  penjelasan secara umum tentang suatu sistem, teknologi, atau perangkat yang dapat digunakan sebagai acuan baku (standar) umum.','techincal'),(3,'PED','Pedoman','Pedoman , mencakup semua dokumen yang isinya menjelaskan tentang: \r\n-  Pedoman Instalasi (Installation Guideline)\r\n- Pedoman Operasi dan Pemeliharaan (Operation and Maintenance Guideline)\r\n-  Pedoman Uji Terima (Acceptance Test Guideline)\r\n-  Dokumen lain yang sejenis','techincal'),(4,'KJN','Kajian','Kajian, mencakup semua dokumen yang isinya mengkaji suatu teknologi, sietm, perangkat, dll. Yang termasuk dokumen KJN antara lain :\r\n- Kajian Teknologi\r\n- Rilis Teknologi\r\n- Deskripsi Teknologi\r\n- Uji Coba Lapangan','techincal'),(5,'REC','Recommendation','RECOMMENDATION. Merupakan dokumen yang berisi rekomendasi. Rekomendasi tersebut dapat berisi; strategi bisnis tentang trend teknologi dan produk; strategi bisnis yang dapat digunakan dalam rangka peluncuran produk/layanan baru atau penggelaran teknologi;  Bisnis plan untuk peluncuran produk baru atau penggelaran teknologi; strategi yang dapat digunakan untuk memperbaiki performansi produk/layanan eksisting; strategi partnership dan community development.','business'),(6,'REP','Report','REPORT. Merupakan dokumen yang berisi laporan yang memberikan potret dari hasil observasi terhadap produk, service, situasi persaingan bisnis atau hasil suatu market research.','business'),(7,'GUD','Guidance','GUIDANCE. Merupakan dokumen yang berisi panduan untuk menyusun dokumen  REC, REP & GUD, atau panduan/juklak untuk melakukan kegiatan fungsi Lab seperti evaluasi produk, market research, CI, penyusunan bisnis plan dan bisnis strategi serta kegiatan yang berhubungan dengan partnership dan ICT development. ','business');

UNLOCK TABLES;

/*Table structure for table `mas_research_type` */

DROP TABLE IF EXISTS `mas_research_type`;

CREATE TABLE `mas_research_type` (
  `id_mas_research_type` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mas_research_type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `mas_research_type` */

LOCK TABLES `mas_research_type` WRITE;

insert  into `mas_research_type`(id_mas_research_type,type) values (1,'Dokumen Bisnis'),(2,'Dokumen Teknis');

UNLOCK TABLES;

/*Table structure for table `mas_review_type` */

DROP TABLE IF EXISTS `mas_review_type`;

CREATE TABLE `mas_review_type` (
  `id_mas_review_type` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mas_review_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `mas_review_type` */

LOCK TABLES `mas_review_type` WRITE;

insert  into `mas_review_type`(id_mas_review_type,type) values (1,'Laporan Stream Mingguan'),(2,'Laporan Eksekutif');

UNLOCK TABLES;

/*Table structure for table `mas_strategic_initiative` */

DROP TABLE IF EXISTS `mas_strategic_initiative`;

CREATE TABLE `mas_strategic_initiative` (
  `id_mas_strategic_initiative` int(11) NOT NULL AUTO_INCREMENT,
  `strategic_initiative` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_mas_strategic_initiative`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mas_strategic_initiative` */

LOCK TABLES `mas_strategic_initiative` WRITE;

UNLOCK TABLES;

/*Table structure for table `mas_strategic_objective` */

DROP TABLE IF EXISTS `mas_strategic_objective`;

CREATE TABLE `mas_strategic_objective` (
  `id_mas_strategic_objective` int(11) NOT NULL AUTO_INCREMENT,
  `strategic_objective` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_mas_strategic_objective`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mas_strategic_objective` */

LOCK TABLES `mas_strategic_objective` WRITE;

UNLOCK TABLES;

/*Table structure for table `mas_times_category` */

DROP TABLE IF EXISTS `mas_times_category`;

CREATE TABLE `mas_times_category` (
  `id_mas_times_category` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(20) DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id_mas_times_category`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `mas_times_category` */

LOCK TABLES `mas_times_category` WRITE;

insert  into `mas_times_category`(id_mas_times_category,category,description) values (1,'Telecomunication',''),(2,'Information',''),(3,'Media',''),(4,'Education',''),(5,'Service','');

UNLOCK TABLES;

/*Table structure for table `mas_title` */

DROP TABLE IF EXISTS `mas_title`;

CREATE TABLE `mas_title` (
  `id_mas_title` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_mas_title`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;

/*Data for the table `mas_title` */

LOCK TABLES `mas_title` WRITE;

insert  into `mas_title`(id_mas_title,title) values (1,'SENIOR GENERAL MANAGER INNOVATION & DESIGN CENTER'),(2,'DEPUTY SGM INNOVATION & DESIGN CENTER'),(3,'SENIOR MANAGER INNOVATION MANAGEMENT'),(4,'RESEARCHER BROADBAND COMMUNICATION SERVICE'),(5,'MANAGER BUSINESS & PROGRAM PLANNING'),(6,'OFFICER 1 STRATEGIC PLANNING'),(7,'OFFICER 1 BUDGETING, PROGRAM PLANNING & MONITORING'),(8,'OFFICER 1 INNOVATION PROGRAM PLANNING & MONITORING'),(9,'OFFICER 2 INNOVATION PROGRAM PLANNING & MONITORING'),(10,'MANAGER PERFORMANCE MANAGEMENT'),(11,'OFFICER 1 PERFORMANCE EVALUATION & ANALYSIS'),(12,'OFFICER 1 BUSINESS PROCESS AUDIT'),(13,'OFFICER 1 PERFORMANCE MEASUREMENT & ANALYSIS'),(14,'MANAGER INNOVATION & ENTERPRENEURSHIP'),(15,'OFFICER 1 INCUBATION PROGRAM PLANNING'),(16,'OFFICER 1 INCUBATION PROGRAM MONITORING'),(17,'OFFICER 1 INCUBATION PROGRAM ASSESSMENT'),(18,'MANAGER QUALITY MANAGEMENT & RESEARCH SYNERGY'),(19,'OFFICER 1 QUALITY EVALUATION & ANALISYS'),(20,'OFFICER 1 QUALITY MANAGEMENT PROGRAM'),(21,'OFFICER 1 PROGRAM SYNERGY PLANNING & EVALUATION'),(22,'SENIOR MANAGER DIGITAL LIFESTYLE ECOSYSTEM'),(23,'RESEARCHER DIGITAL ECOSYSTEM ANALISYS'),(24,'RESEARCHER DIGITAL ECOSYSTEM DEVELOPMENT'),(25,'RESEARCHER DIGITAL SERVICE PLATFORM'),(26,'MANAGER DIGITAL MEDIA'),(27,'ENGINEER 2 DIGITAL MEDIA DESIGN'),(28,'MANAGER DIGITAL HOME'),(29,'ENGINEER 1 DIGITAL HOME DESIGN'),(30,'MANAGER DIGITAL ENTERTAINMENT'),(31,'ENGINEER 1 DIGITAL ENTERTAINMENT PRODUCT'),(32,'ENGINEER 1 DIGITAL ENTERTAINMENT DESIGN'),(33,'ENGINEER 3 DIGITAL ENTERTAINMENT DESIGN'),(34,'MANAGER DIGITAL LIFESTYLE PLATFORM'),(35,'ENGINEER 1 DIGITAL LIFESTYLE PLATFORM ANALYSIS'),(36,'ENGINEER 2 DIGITAL LIFESTYLE PLATFORM DEVELOPMENT'),(37,'SENIOR MANAGER DIGITAL SOLUTION ECOSYSTEM'),(38,'RESEARCHER DIGITAL ECOSYSTEM ANALISYS'),(39,'RESEARCHER DIGITAL ECOSYSTEM DEVELOPMENT'),(40,'RESEARCHER DIGITAL SERVICE PLATFORM'),(41,'MANAGER DIGITAL HOSPITALITY'),(42,'ENGINEER 1 DIGITAL HOSPITALITY BUSINESS'),(43,'ENGINEER 1 DIGITAL HOSPITALITY PRODUCT'),(44,'ENGINEER 2 DIGITAL HOSPITALITY DESIGN'),(45,'ENGINEER 3 DIGITAL HOSPITALITY DESIGN'),(46,'MANAGER DIGITAL GOVERNMENT & EDUCATION'),(47,'ENGINEER 1 DIGITAL GOVERNMENT & EDUCATION BUSINESS'),(48,'ENGINEER 2 DIGITAL GOVERNMENT & EDUCATION DESIGN'),(49,'ENGINEER 1 DIGITAL GOVERNMENT & EDUCATION PRODUCT'),(50,'MANAGER DIGITAL SUPPLY CHAIN & UTILITIES'),(51,'ENGINEER 1 DIGITAL SUPPLY CHAIN & UTILITIES PRODUCT'),(52,'ENGINEER 3 DIGITAL SUPPLY CHAIN & UTILITIES DESIGN'),(53,'MANAGER SOLUTION PLATFORM'),(54,'ENGINEER 1 DIGITAL SOLUTION PLATFORM ANALYSIS'),(55,'ENGINEER 1 DIGITAL SOLUTION PLATFORM DEVELOPMENT'),(56,'ENGINEER 2 DIGITAL SOLUTION PLATFORM DEVELOPMENT'),(57,'SENIOR MANAGER MOBILE ECOSYSTEM'),(58,'MANAGER MOBILE IT & SERVICE PLATFORM'),(59,'ENGINEER 3 MOBILE IT & SERVICE PLATFORM'),(60,'MANAGER WIRELESS ACCESS TECHNOLOGY'),(61,'SENIOR MANAGER INFRASTRUCTURE RESEARCH & DEVELOPMENT'),(62,'RESEARCHER SERVICE NODE PLATFORM'),(63,'RESEARCHER BROADBAND CORE NETWORK'),(64,'RESEARCHER FIXED BROADBAND ACCESS'),(65,'RESEARCHER CORE IT & SECURITY SYSTEM'),(66,'RESEARCHER BROADBAND COMMUNICATION SERVICE'),(67,'MANAGER NODE PLATFORM'),(68,'ENGINEER 2 MULTIMEDIA SERVICE CONTROL'),(69,'ENGINEER 3 MULTIMEDIA SERVICE CONTROL'),(70,'ENGINEER 1 SERVICE DELIVERY PLATFORM'),(71,'ENGINEER 1 COMMUNICATION CONTROL'),(72,'MANAGER BROADBAND COMMUNICATION SERVICES'),(73,'ENGINEER 1 BROADBAND COMMUNICATION SERVICES'),(74,'ENGINEER 2 BROADBAND COMMUNICATION SERVICES'),(75,'ENGINEER 3 NETWORK CONNECTIVITY SERVICES'),(76,'ENGINEER 1 NETWORK CONNECTIVITY SERVICES'),(77,'MANAGER FIXED BROADBAND ACCESS'),(78,'ENGINEER 1 WIRELINE MEDIA & CABLING SYSTEM'),(79,'ENGINEER 1 BROADBAND WIRELINE SYSTEM'),(80,'ENGINEER 3 BROADBAND WIRELINE SYSTEM'),(81,'MANAGER CORE IT & SECURITY SYSTEM'),(82,'ENGINEER 1 SECURTY & RELIABILITY SYSTEM'),(83,'ENGINEER 2 SECURITY & RELIABILITY SYSTEM'),(84,'MANAGER BROADBAND CORE NETWORK '),(85,'ENGINEER 1 IP & METRO NETWORK'),(86,'ENGINEER 1 BROADBAND TRANSMISSION SYSTEM'),(87,'ENGINEER 2 IP & METRO NETWORK'),(88,'SENIOR MANAGER PRODUCT & INFRASTRUCTURE ASSURANCE'),(89,'RESEARCHER DIGITAL ECOSYSTEM ANALISYS'),(90,'RESEARCHER SYSTEM QUALITY ASSURANCE'),(91,'RESEARCHER SYSTEM INTEGRATION & READINESS'),(92,'RESEARCHER DIGITAL ECOSYSTEM DEVELOPMENT'),(93,'MANAGER PRODUCT QUALITY ASSURANCE'),(94,'ENGINEER 1 PRODUCT QUALITY ASSESSMENT'),(95,'MANAGER INFRASTRUCTURE QUALITY ASSURANCE'),(96,'ENGINEER 1 TRANSMISSION QUALITY ASSURANCE'),(97,'ENGINEER 1 FO & CABLE QUALITY ASSURANCE'),(98,'ENGINEER 1 QUALITY ASSURANCE CALIBRATION'),(99,'ENGINEER 2 FO & CABLE QUALITY ASSURANCE'),(100,'MANAGER DEVICE & ENERGY QUALITY ASSURANCE'),(101,'ENGINEER 1 DEVICE & ENERGY QUALITY ASSURANCE '),(102,'ENGINEER 1 ME & ENERGY QUALITY ASSURANCE'),(103,'MANAGER SYSTEM INTEGRATION & READINESS'),(104,'ENGINEER 1 SYSTEM INTEGRATION PLANNING & DESIGN'),(105,'MANAGER PRODUCT & INFRASTRUCTURE EXPERIENCE'),(106,'ENGINEER 1 INNOVATION INFORMATION SYSTEM'),(107,'ENGINEER 1 TEST BED SYSTEM & MANAGEMENT'),(108,'ENGINEER 1 TEST BED SYSTEM & MANAGEMENT'),(109,'SENIOR MANAGER GENERAL AFFAIRS'),(110,'MANAGER SECRETARIATE & RESOURCE DEVELOPMENT'),(111,'OFFICER 1 SECRETARIATE'),(112,'OFFICER 1 FACILITY MANAGEMENT'),(113,'OFFICER 1 RESOURCE PLANNING & DEVELOPMENT'),(114,'OFFICER 1 RELATION & COMMUNICATION'),(115,'OFFICER 2 FACILITY MANAGEMENT'),(116,'OFFICER 2 SECRETARIATE ADMINISTRATION'),(117,'MANAGER LOGISTIC & ASSET MANAGEMENT'),(118,'OFFICER 1 LOGISTIC PLANNING PROCUREMENT'),(119,'OFFICER 1 PROCUREMENT PROCESS'),(120,'OFFICER 2 ASSET MANAGEMENT'),(121,'MANAGER USER RELATION'),(122,'OFFICER 1 CUSTOMER CARE'),(123,'OFFICER 2 INVOICE & COLLECTION'),(124,'OFFICER 2 CUSTOMER RELATIONSHIP'),(125,'MANAGER BUSINESS LEGAL SUPPORT'),(126,'OFFICER 1 LEGAL COMPLIANCE'),(127,'OFFICER 1 CONTRACT DRAFTER & ADMINISTRATON');

UNLOCK TABLES;

/*Table structure for table `mas_training_type` */

DROP TABLE IF EXISTS `mas_training_type`;

CREATE TABLE `mas_training_type` (
  `id_mas_training_type` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_mas_training_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mas_training_type` */

LOCK TABLES `mas_training_type` WRITE;

UNLOCK TABLES;

/*Table structure for table `notification` */

DROP TABLE IF EXISTS `notification`;

CREATE TABLE `notification` (
  `id_notification` int(11) NOT NULL,
  `timestamp` varchar(45) DEFAULT NULL,
  `notification_type` varchar(45) DEFAULT NULL,
  `param` varchar(45) DEFAULT NULL,
  `link` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_notification`,`id_user`),
  KEY `fk_Notification_user1_idx` (`id_user`),
  CONSTRAINT `fk_Notification_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `notification` */

LOCK TABLES `notification` WRITE;

UNLOCK TABLES;

/*Table structure for table `organization_item` */

DROP TABLE IF EXISTS `organization_item`;

CREATE TABLE `organization_item` (
  `id_organization_item` int(11) NOT NULL,
  `org_name` varchar(100) DEFAULT NULL,
  `description` text,
  `level` set('unit','subunit','lab') DEFAULT NULL,
  `id_organization_item_parent` int(11) DEFAULT NULL,
  `abbreviation` varchar(10) DEFAULT NULL,
  `row` int(11) NOT NULL,
  PRIMARY KEY (`id_organization_item`),
  KEY `fk_organization_item_organization_item1_idx` (`id_organization_item_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `organization_item` */

LOCK TABLES `organization_item` WRITE;

insert  into `organization_item`(id_organization_item,org_name,description,level,id_organization_item_parent,abbreviation,row) values (1,'DIGITAL LIFESTYLE ECOSYSTEM',NULL,'unit',3,'DLE',3),(2,'SENIOR GENERAL MANAGER INNOVATION & DESIGN CENTER',NULL,'unit',NULL,'SGM',1),(3,'DEPUTY SGM INNOVATION & DESIGN CENTER',NULL,'unit',2,'DSGM',2),(4,'INNOVATION MANAGEMENT',NULL,'unit',3,'IM',3),(5,'INFRASTRUCTURE RESEARCH & DEVELOPMENT',NULL,'unit',3,'IRD',3),(6,'PRODUCT INFRASTRUCTURE ASSURANCE',NULL,'unit',3,'PIA',3),(8,'DIGITAL SOLUTION ECOSYSTEM',NULL,'unit',3,'DSE',3),(9,'GENERAL AFFAIRS',NULL,'unit',3,'GA',3),(10,'MOBILE ECOSYSTEM',NULL,'unit',3,'ME',3),(11,'M2M DIGITAL ECOSYSTEM',NULL,'unit',3,'M2M',3);

UNLOCK TABLES;

/*Table structure for table `partnership` */

DROP TABLE IF EXISTS `partnership`;

CREATE TABLE `partnership` (
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
  `partnership_category` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_partnership`),
  KEY `fk_partnership_organization_item1_idx` (`id_organization_item_initiator`),
  KEY `fk_partnership_program1_idx` (`id_program`),
  KEY `fk_partnership_mas_project_status1_idx` (`id_mas_project_status`),
  CONSTRAINT `fk_partnership_mas_project_status1` FOREIGN KEY (`id_mas_project_status`) REFERENCES `mas_project_status` (`id_mas_project_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_partnership_organization_item1` FOREIGN KEY (`id_organization_item_initiator`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_partnership_program1` FOREIGN KEY (`id_program`) REFERENCES `program` (`id_program`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `partnership` */

LOCK TABLES `partnership` WRITE;

UNLOCK TABLES;

/*Table structure for table `partnership_activity` */

DROP TABLE IF EXISTS `partnership_activity`;

CREATE TABLE `partnership_activity` (
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
  KEY `fk_partnership_activity_partnership1_idx` (`id_partnership`),
  CONSTRAINT `fk_partnership_activity_partnership1` FOREIGN KEY (`id_partnership`) REFERENCES `partnership` (`id_partnership`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `partnership_activity` */

LOCK TABLES `partnership_activity` WRITE;

UNLOCK TABLES;

/*Table structure for table `partnership_document` */

DROP TABLE IF EXISTS `partnership_document`;

CREATE TABLE `partnership_document` (
  `id_partnership_document` int(11) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `id_mas_partnership_document_type` int(11) NOT NULL,
  `id_partnership` int(11) NOT NULL,
  PRIMARY KEY (`id_partnership_document`,`id_partnership`),
  KEY `fk_partnership_document_mas_partnership_document_type1_idx` (`id_mas_partnership_document_type`),
  KEY `fk_partnership_document_partnership1_idx` (`id_partnership`),
  CONSTRAINT `fk_partnership_document_mas_partnership_document_type1` FOREIGN KEY (`id_mas_partnership_document_type`) REFERENCES `mas_partnership_document_type` (`id_mas_partnership_document_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_partnership_document_partnership1` FOREIGN KEY (`id_partnership`) REFERENCES `partnership` (`id_partnership`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `partnership_document` */

LOCK TABLES `partnership_document` WRITE;

UNLOCK TABLES;

/*Table structure for table `partnership_information` */

DROP TABLE IF EXISTS `partnership_information`;

CREATE TABLE `partnership_information` (
  `id_partnership_information` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `title` text,
  `content` text,
  `id_partnership` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_partnership_information`,`id_partnership`,`id_user`),
  KEY `fk_partnership_information_partnership1_idx` (`id_partnership`),
  KEY `fk_partnership_information_user1_idx` (`id_user`),
  CONSTRAINT `fk_partnership_information_partnership1` FOREIGN KEY (`id_partnership`) REFERENCES `partnership` (`id_partnership`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_partnership_information_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `partnership_information` */

LOCK TABLES `partnership_information` WRITE;

UNLOCK TABLES;

/*Table structure for table `performance_evidence` */

DROP TABLE IF EXISTS `performance_evidence`;

CREATE TABLE `performance_evidence` (
  `id_performance_evidence` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `id_performance_system` int(11) NOT NULL,
  PRIMARY KEY (`id_performance_evidence`),
  KEY `fk_performance_evidence_performance_system1_idx` (`id_performance_system`),
  CONSTRAINT `fk_performance_evidence_performance_system1` FOREIGN KEY (`id_performance_system`) REFERENCES `performance_system` (`id_performance_system`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `performance_evidence` */

LOCK TABLES `performance_evidence` WRITE;

UNLOCK TABLES;

/*Table structure for table `performance_indicator` */

DROP TABLE IF EXISTS `performance_indicator`;

CREATE TABLE `performance_indicator` (
  `id_performance_indicator` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `measure_definition` text,
  `evidence` text,
  `id_annual_data` int(11) NOT NULL,
  `id_program` int(11) DEFAULT NULL,
  `id_mas_strategic_objective` int(11) NOT NULL,
  `id_mas_key_performance` int(11) NOT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  `id_mas_strategic_initiative` int(11) NOT NULL,
  `indicator_type` set('common','shared','specific') DEFAULT NULL,
  PRIMARY KEY (`id_performance_indicator`),
  KEY `fk_performance_indicator_yearly_performance1_idx` (`id_annual_data`),
  KEY `fk_performance_indicator_program1_idx` (`id_program`),
  KEY `fk_performance_indicator_mas_strategic_objective1_idx` (`id_mas_strategic_objective`),
  KEY `fk_performance_indicator_mas_key_performance1_idx` (`id_mas_key_performance`),
  KEY `fk_performance_indicator_mas_strategic_initiative1_idx` (`id_mas_strategic_initiative`),
  CONSTRAINT `fk_performance_indicator_mas_key_performance1` FOREIGN KEY (`id_mas_key_performance`) REFERENCES `mas_key_performance` (`id_mas_key_performance`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_indicator_mas_strategic_initiative1` FOREIGN KEY (`id_mas_strategic_initiative`) REFERENCES `mas_strategic_initiative` (`id_mas_strategic_initiative`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_indicator_mas_strategic_objective1` FOREIGN KEY (`id_mas_strategic_objective`) REFERENCES `mas_strategic_objective` (`id_mas_strategic_objective`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_indicator_program1` FOREIGN KEY (`id_program`) REFERENCES `program` (`id_program`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_indicator_yearly_performance1` FOREIGN KEY (`id_annual_data`) REFERENCES `annual_data` (`id_annual_data`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `performance_indicator` */

LOCK TABLES `performance_indicator` WRITE;

UNLOCK TABLES;

/*Table structure for table `performance_quartal` */

DROP TABLE IF EXISTS `performance_quartal`;

CREATE TABLE `performance_quartal` (
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
  `id_target` int(11) NOT NULL,
  `budget_realization` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_performance_quartal`,`id_performance_system_item`),
  KEY `fk_performance_quartal_performance_system_item1_idx` (`id_performance_system_item`),
  KEY `fk_performance_quartal_target1_idx` (`id_target`),
  CONSTRAINT `fk_performance_quartal_performance_system_item1` FOREIGN KEY (`id_performance_system_item`) REFERENCES `performance_system_item` (`id_performance_system_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_quartal_target1` FOREIGN KEY (`id_target`) REFERENCES `target` (`id_target`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `performance_quartal` */

LOCK TABLES `performance_quartal` WRITE;

UNLOCK TABLES;

/*Table structure for table `performance_realization` */

DROP TABLE IF EXISTS `performance_realization`;

CREATE TABLE `performance_realization` (
  `id_performance_realization` int(11) NOT NULL,
  `realization` varchar(45) DEFAULT NULL,
  `id_performance_quartal` int(11) NOT NULL,
  `id_target_item` int(11) NOT NULL,
  PRIMARY KEY (`id_performance_realization`,`id_performance_quartal`),
  KEY `fk_performance_realization_performance_quartal1_idx` (`id_performance_quartal`),
  KEY `fk_performance_realization_target_item1_idx` (`id_target_item`),
  CONSTRAINT `fk_performance_realization_performance_quartal1` FOREIGN KEY (`id_performance_quartal`) REFERENCES `performance_quartal` (`id_performance_quartal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_realization_target_item1` FOREIGN KEY (`id_target_item`) REFERENCES `target_item` (`id_target_item`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `performance_realization` */

LOCK TABLES `performance_realization` WRITE;

UNLOCK TABLES;

/*Table structure for table `performance_system` */

DROP TABLE IF EXISTS `performance_system`;

CREATE TABLE `performance_system` (
  `id_performance_system` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `id_organization_item` int(11) DEFAULT NULL,
  `id_employee` int(11) DEFAULT NULL,
  `limit_max` float DEFAULT NULL,
  `limit_min` float DEFAULT NULL,
  `id_annual_data` int(11) NOT NULL,
  PRIMARY KEY (`id_performance_system`),
  KEY `fk_performance_system_organization_item1_idx` (`id_organization_item`),
  KEY `fk_performance_system_employee1_idx` (`id_employee`),
  KEY `fk_performance_system_yearly_performance1_idx` (`id_annual_data`),
  CONSTRAINT `fk_performance_system_employee1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_system_organization_item1` FOREIGN KEY (`id_organization_item`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_system_yearly_performance1` FOREIGN KEY (`id_annual_data`) REFERENCES `annual_data` (`id_annual_data`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `performance_system` */

LOCK TABLES `performance_system` WRITE;

UNLOCK TABLES;

/*Table structure for table `performance_system_item` */

DROP TABLE IF EXISTS `performance_system_item`;

CREATE TABLE `performance_system_item` (
  `id_performance_system_item` int(11) NOT NULL,
  `id_performance_system` int(11) NOT NULL,
  `id_performance_indicator` int(11) NOT NULL,
  `id_performance_system_item_parent` int(11) DEFAULT NULL,
  `id_mas_perspective` int(11) NOT NULL,
  PRIMARY KEY (`id_performance_system_item`,`id_performance_indicator`),
  KEY `fk_performance_system_item_performance_system1_idx` (`id_performance_system`),
  KEY `fk_performance_system_item_performance_indicator1_idx` (`id_performance_indicator`),
  KEY `fk_performance_system_item_performance_system_item1_idx` (`id_performance_system_item_parent`),
  KEY `fk_performance_system_item_mas_perspective1_idx` (`id_mas_perspective`),
  CONSTRAINT `fk_performance_system_item_mas_perspective1` FOREIGN KEY (`id_mas_perspective`) REFERENCES `mas_perspective` (`id_mas_perspective`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_system_item_performance_indicator1` FOREIGN KEY (`id_performance_indicator`) REFERENCES `performance_indicator` (`id_performance_indicator`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_system_item_performance_system1` FOREIGN KEY (`id_performance_system`) REFERENCES `performance_system` (`id_performance_system`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_system_item_performance_system_item1` FOREIGN KEY (`id_performance_system_item_parent`) REFERENCES `performance_system_item` (`id_performance_system_item`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `performance_system_item` */

LOCK TABLES `performance_system_item` WRITE;

UNLOCK TABLES;

/*Table structure for table `program` */

DROP TABLE IF EXISTS `program`;

CREATE TABLE `program` (
  `id_program` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
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
  KEY `fk_program_mas_research_type1_idx` (`id_mas_research_type`),
  CONSTRAINT `fk_program_employee1` FOREIGN KEY (`id_employee_po`) REFERENCES `employee` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_program_employee2` FOREIGN KEY (`id_employee_pm`) REFERENCES `employee` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_program_mas_project_status1` FOREIGN KEY (`id_mas_project_status`) REFERENCES `mas_project_status` (`id_mas_project_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_program_mas_research_type1` FOREIGN KEY (`id_mas_research_type`) REFERENCES `mas_research_type` (`id_mas_research_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_program_organization_item1` FOREIGN KEY (`id_organization_item`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `program` */

LOCK TABLES `program` WRITE;

insert  into `program`(id_program,name,description,output,user,start_date,end_date,quartal,primary_program,deliverable,KPI,implementation_strategy,strategic_initative,id_organization_item,id_employee_po,id_employee_pm,id_annual_data,show_on_review,id_mas_project_status,id_mas_research_type,budget) values (1,'Seleksi Indigo Incubator','Inkubasi',NULL,NULL,'2015-05-26','2015-05-31','4',1,'# of incubation proposal\r\n# of Incubated Start Ups\r\n# of Validated Products\r\n# of Validated Business Model','400 of incubation proposals\r\n- Incubated StartUp : 30 (BDV=20, JDV=10)\r\n- Validated Products : 20\r\n- Validated Business Model : 10','- Roadshow (socialization),\r\n- Partnering with MIKTI (Running the Incubation)\r\n- Partnering with Global Incubators (Global Mentor)','SI-1 Center of Excellent',1,1,1,NULL,0,1,1,500000000),(2,'Update dan rolling strategic plan RDC','','Kajian strategic plan','',NULL,NULL,'4',1,'# of incubation proposal\r\n# of Incubated Start Ups\r\n# of Validated Products\r\n# of Validated Business Model','400 of incubation proposals\r\n- Incubated StartUp : 30 (BDV=20, JDV=10)\r\n- Validated Products : 20\r\n- Validated Business Model : 10','- Roadshow (socialization),\r\n- Partnering with MIKTI (Running the Incubation)\r\n- Partnering with Global Incubators (Global Mentor)','SI-1 Center of Excellent',4,NULL,4,0,0,1,1,999999);

UNLOCK TABLES;

/*Table structure for table `program_target` */

DROP TABLE IF EXISTS `program_target`;

CREATE TABLE `program_target` (
  `id_program_target` int(11) NOT NULL,
  `id_program` int(11) NOT NULL,
  `id_target` int(11) NOT NULL,
  PRIMARY KEY (`id_program_target`),
  KEY `fk_program_target_program1_idx` (`id_program`),
  KEY `fk_program_target_target1_idx` (`id_target`),
  CONSTRAINT `fk_program_target_program1` FOREIGN KEY (`id_program`) REFERENCES `program` (`id_program`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_program_target_target1` FOREIGN KEY (`id_target`) REFERENCES `target` (`id_target`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `program_target` */

LOCK TABLES `program_target` WRITE;

UNLOCK TABLES;

/*Table structure for table `project` */

DROP TABLE IF EXISTS `project`;

CREATE TABLE `project` (
  `id_project` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
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
  KEY `fk_project_mas_times_category1_idx` (`id_mas_times_category`),
  CONSTRAINT `fk_project_mas_project_status1` FOREIGN KEY (`id_mas_project_status`) REFERENCES `mas_project_status` (`id_mas_project_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_mas_times_category1` FOREIGN KEY (`id_mas_times_category`) REFERENCES `mas_times_category` (`id_mas_times_category`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_organization_item1` FOREIGN KEY (`id_organization_item`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_program1` FOREIGN KEY (`id_program`) REFERENCES `program` (`id_program`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project` */

LOCK TABLES `project` WRITE;

insert  into `project`(id_project,name,description,weight,start_date,end_date,percent_progress,last_progress_update,id_program,id_organization_item,id_annual_data,id_mas_project_status,id_mas_times_category) values (2,'Indigo Incubator 2','Indikator yang menunjukkan kemampuan RDC dalam penjaringan ide untuk inkubasi yang meliputi aktifitas penyeleksian proposal, proses inkubasi sampai siap dilakukan proses Market validation.',100,'2015-01-01','2015-12-16',0,'2015-05-28 22:36:59',1,4,0,1,1),(3,'Indigo Incubator 3','',100,'2015-01-01','2015-12-16',0,'2015-05-29 16:54:24',1,4,0,1,1),(4,'Incubator Startup 4','Incubator Startup 4',100,'2015-06-01','2015-07-17',0,'2015-05-29 16:55:17',1,4,0,1,1);

UNLOCK TABLES;

/*Table structure for table `project_step` */

DROP TABLE IF EXISTS `project_step`;

CREATE TABLE `project_step` (
  `id_project_step` int(11) NOT NULL AUTO_INCREMENT,
  `step_name` varchar(255) DEFAULT NULL,
  `step_description` text,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `id_project` int(11) NOT NULL,
  `weight` float DEFAULT NULL,
  PRIMARY KEY (`id_project_step`,`id_project`),
  KEY `fk_project_step_project1_idx` (`id_project`),
  CONSTRAINT `fk_project_step_project1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `project_step` */

LOCK TABLES `project_step` WRITE;

insert  into `project_step`(id_project_step,step_name,step_description,start_date,end_date,id_project,weight) values (3,'Incubated Startup','incubated','2015-05-29','2015-12-31',2,100),(4,'Validated Products','validated products','2016-01-03','2016-01-06',2,100),(5,'Validated Business Model','Validated Business Model','2016-01-11','2015-12-18',2,20);

UNLOCK TABLES;

/*Table structure for table `qa_product` */

DROP TABLE IF EXISTS `qa_product`;

CREATE TABLE `qa_product` (
  `id_qa_product` int(11) NOT NULL,
  `product_name` varchar(45) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `executive_summary` text,
  `conclusion` text,
  `testing_recomendation` text,
  `tester_name` varchar(200) DEFAULT NULL,
  `information` text,
  PRIMARY KEY (`id_qa_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `qa_product` */

LOCK TABLES `qa_product` WRITE;

UNLOCK TABLES;

/*Table structure for table `qa_product_document` */

DROP TABLE IF EXISTS `qa_product_document`;

CREATE TABLE `qa_product_document` (
  `id_qa_product_document` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `description` text,
  `received_date` date DEFAULT NULL,
  `id_qa_product` int(11) NOT NULL,
  PRIMARY KEY (`id_qa_product_document`,`id_qa_product`),
  KEY `fk_QA_product_document_QA_product1_idx` (`id_qa_product`),
  CONSTRAINT `fk_QA_product_document_QA_product1` FOREIGN KEY (`id_qa_product`) REFERENCES `qa_product` (`id_qa_product`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `qa_product_document` */

LOCK TABLES `qa_product_document` WRITE;

UNLOCK TABLES;

/*Table structure for table `research` */

DROP TABLE IF EXISTS `research`;

CREATE TABLE `research` (
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
  KEY `fk_research_mas_project_status1_idx` (`id_mas_project_status`),
  CONSTRAINT `fk_research_mas_project_status1` FOREIGN KEY (`id_mas_project_status`) REFERENCES `mas_project_status` (`id_mas_project_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_research_mas_research_type1` FOREIGN KEY (`id_mas_research_type`) REFERENCES `mas_research_type` (`id_mas_research_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_research_organization_item1` FOREIGN KEY (`id_organization_item`) REFERENCES `organization_item` (`id_organization_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_research_program1` FOREIGN KEY (`id_program`) REFERENCES `program` (`id_program`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_research_research_content1` FOREIGN KEY (`id_mas_research_content`) REFERENCES `mas_research_content` (`id_mas_research_content`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_research_research_group1` FOREIGN KEY (`id_mas_research_group`) REFERENCES `mas_research_group` (`id_mas_research_group`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `research` */

LOCK TABLES `research` WRITE;

UNLOCK TABLES;

/*Table structure for table `research_file` */

DROP TABLE IF EXISTS `research_file`;

CREATE TABLE `research_file` (
  `id_research_file` int(11) NOT NULL,
  `version` varchar(10) DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `date_accepted` date DEFAULT NULL,
  `document_upload` varchar(45) DEFAULT NULL,
  `id_research` int(11) NOT NULL,
  PRIMARY KEY (`id_research_file`,`id_research`),
  KEY `fk_research_document_research1_idx` (`id_research`),
  CONSTRAINT `fk_research_document_research1` FOREIGN KEY (`id_research`) REFERENCES `research` (`id_research`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `research_file` */

LOCK TABLES `research_file` WRITE;

UNLOCK TABLES;

/*Table structure for table `research_utilization` */

DROP TABLE IF EXISTS `research_utilization`;

CREATE TABLE `research_utilization` (
  `id_research_utilization` int(11) NOT NULL,
  `utilization` text,
  `id_research` int(11) NOT NULL,
  PRIMARY KEY (`id_research_utilization`),
  KEY `fk_research_utilization_research1_idx` (`id_research`),
  CONSTRAINT `fk_research_utilization_research1` FOREIGN KEY (`id_research`) REFERENCES `research` (`id_research`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `research_utilization` */

LOCK TABLES `research_utilization` WRITE;

UNLOCK TABLES;

/*Table structure for table `review_comment` */

DROP TABLE IF EXISTS `review_comment`;

CREATE TABLE `review_comment` (
  `id_review_comment` int(11) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `id_review_management` int(11) NOT NULL,
  `timestamp` datetime DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_review_comment`),
  KEY `fk_review_comment_review_management1_idx` (`id_review_management`),
  KEY `fk_review_comment_user1_idx` (`id_user`),
  CONSTRAINT `fk_review_comment_review_management1` FOREIGN KEY (`id_review_management`) REFERENCES `review_management` (`id_review_management`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_review_comment_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `review_comment` */

LOCK TABLES `review_comment` WRITE;

UNLOCK TABLES;

/*Table structure for table `review_management` */

DROP TABLE IF EXISTS `review_management`;

CREATE TABLE `review_management` (
  `id_review_management` int(11) NOT NULL,
  `period` varchar(45) DEFAULT NULL,
  `id_program` int(11) NOT NULL,
  `id_mas_review_type` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `files` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_review_management`),
  KEY `fk_review_management_program1_idx` (`id_program`),
  KEY `fk_review_management_mas_review_type1_idx` (`id_mas_review_type`),
  CONSTRAINT `fk_review_management_mas_review_type1` FOREIGN KEY (`id_mas_review_type`) REFERENCES `mas_review_type` (`id_mas_review_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_review_management_program1` FOREIGN KEY (`id_program`) REFERENCES `program` (`id_program`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `review_management` */

LOCK TABLES `review_management` WRITE;

UNLOCK TABLES;

/*Table structure for table `target` */

DROP TABLE IF EXISTS `target`;

CREATE TABLE `target` (
  `id_target` int(11) NOT NULL,
  `period` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_target`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `target` */

LOCK TABLES `target` WRITE;

insert  into `target`(id_target,period) values (1,'TW I'),(2,'TW II'),(3,'TW III'),(4,'TW IV');

UNLOCK TABLES;

/*Table structure for table `target_item` */

DROP TABLE IF EXISTS `target_item`;

CREATE TABLE `target_item` (
  `id_target_item` int(11) NOT NULL,
  `target` varchar(45) DEFAULT NULL,
  `target_detail` varchar(45) DEFAULT NULL,
  `id_mas_metric` int(11) NOT NULL,
  `id_target` int(11) NOT NULL,
  PRIMARY KEY (`id_target_item`),
  KEY `fk_target_item_mas_metric1_idx` (`id_mas_metric`),
  KEY `fk_target_item_target1_idx` (`id_target`),
  CONSTRAINT `fk_target_item_mas_metric1` FOREIGN KEY (`id_mas_metric`) REFERENCES `mas_metric` (`id_mas_metric`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_target_item_target1` FOREIGN KEY (`id_target`) REFERENCES `target` (`id_target`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `target_item` */

LOCK TABLES `target_item` WRITE;

UNLOCK TABLES;

/*Table structure for table `training` */

DROP TABLE IF EXISTS `training`;

CREATE TABLE `training` (
  `id_training` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `start_time` date DEFAULT NULL,
  `organizer` varchar(255) DEFAULT NULL,
  `id_mas_training_type` int(11) NOT NULL,
  `id_mas_times_category` int(11) NOT NULL,
  PRIMARY KEY (`id_training`),
  KEY `fk_training_mas_training_type1_idx` (`id_mas_training_type`),
  KEY `fk_training_mas_times_category1_idx` (`id_mas_times_category`),
  CONSTRAINT `fk_training_mas_times_category1` FOREIGN KEY (`id_mas_times_category`) REFERENCES `mas_times_category` (`id_mas_times_category`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_mas_training_type1` FOREIGN KEY (`id_mas_training_type`) REFERENCES `mas_training_type` (`id_mas_training_type`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `training` */

LOCK TABLES `training` WRITE;

UNLOCK TABLES;

/*Table structure for table `training_employee` */

DROP TABLE IF EXISTS `training_employee`;

CREATE TABLE `training_employee` (
  `id_training_employee` int(11) NOT NULL,
  `id_training` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL,
  PRIMARY KEY (`id_training_employee`),
  KEY `fk_training_employee_training1_idx` (`id_training`),
  KEY `fk_training_employee_employee1_idx` (`id_employee`),
  CONSTRAINT `fk_training_employee_employee1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_employee_training1` FOREIGN KEY (`id_training`) REFERENCES `training` (`id_training`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `training_employee` */

LOCK TABLES `training_employee` WRITE;

UNLOCK TABLES;

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `login_count` int(11) DEFAULT NULL,
  `profile_pic` varchar(245) DEFAULT NULL,
  `id_user_level` int(11) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `fk_user_user_level1_idx` (`id_user_level`),
  CONSTRAINT `fk_user_user_level1` FOREIGN KEY (`id_user_level`) REFERENCES `user_level` (`id_user_level`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user` */

LOCK TABLES `user` WRITE;

insert  into `user`(id_user,username,password,last_login,login_count,profile_pic,id_user_level) values (1,'admin','8cb2237d0679ca88db6464eac60da96345513964','2015-06-05 10:42:51',NULL,NULL,1),(2,'researcher','8cb2237d0679ca88db6464eac60da96345513964','2015-05-29 16:29:54',NULL,NULL,2),(3,'researcher2','8cb2237d0679ca88db6464eac60da96345513964','2015-05-29 02:09:45',NULL,NULL,2);

UNLOCK TABLES;

/*Table structure for table `user_access` */

DROP TABLE IF EXISTS `user_access`;

CREATE TABLE `user_access` (
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
  KEY `fk_user_access_app_files1_idx` (`id_app_files`),
  CONSTRAINT `fk_user_access_app_files1` FOREIGN KEY (`id_app_files`) REFERENCES `app_files` (`id_app_files`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_access_user_level1` FOREIGN KEY (`id_user_level`) REFERENCES `user_level` (`id_user_level`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_access` */

LOCK TABLES `user_access` WRITE;

UNLOCK TABLES;

/*Table structure for table `user_level` */

DROP TABLE IF EXISTS `user_level`;

CREATE TABLE `user_level` (
  `id_user_level` int(11) NOT NULL,
  `level_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_user_level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_level` */

LOCK TABLES `user_level` WRITE;

insert  into `user_level`(id_user_level,level_name) values (1,'super administrator'),(2,'researcher'),(3,'manager'),(4,'operator');

UNLOCK TABLES;

/*Table structure for table `work_experience` */

DROP TABLE IF EXISTS `work_experience`;

CREATE TABLE `work_experience` (
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
  KEY `fk_work_experience_mas_category1_idx` (`id_mas_times_category`),
  CONSTRAINT `fk_work_experience_employee` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_experience_mas_category1` FOREIGN KEY (`id_mas_times_category`) REFERENCES `mas_times_category` (`id_mas_times_category`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `work_experience` */

LOCK TABLES `work_experience` WRITE;

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;