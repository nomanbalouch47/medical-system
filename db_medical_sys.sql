-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2021 at 11:43 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_medical_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `barcode_setup`
--

CREATE TABLE `barcode_setup` (
  `barcode` int(10) NOT NULL,
  `transdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bio_test`
--

CREATE TABLE `bio_test` (
  `id` int(10) NOT NULL,
  `image_1` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_feedback`
--

CREATE TABLE `candidate_feedback` (
  `feedback_id` int(10) NOT NULL,
  `barcode_no` varchar(150) NOT NULL,
  `feed_back` varchar(150) NOT NULL,
  `comments` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `center_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_medical_process`
--

CREATE TABLE `candidate_medical_process` (
  `tr_id` int(10) NOT NULL,
  `process_id` int(10) NOT NULL,
  `reg_id` int(10) NOT NULL,
  `process_status` tinyint(1) NOT NULL COMMENT '0 = pending, 1= completed, 2= in process',
  `processed_by` int(10) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `center_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `city_province`
--

CREATE TABLE `city_province` (
  `ID` int(11) NOT NULL,
  `Name` char(35) NOT NULL DEFAULT '',
  `CountryCode` char(3) NOT NULL DEFAULT '',
  `District` char(20) NOT NULL DEFAULT '',
  `Population` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `db_backup_stats`
--

CREATE TABLE `db_backup_stats` (
  `id` int(11) NOT NULL,
  `backup_file_name` varchar(255) DEFAULT NULL,
  `last_backup` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medical_process`
--

CREATE TABLE `medical_process` (
  `process_id` int(10) NOT NULL,
  `process_desc` varchar(150) NOT NULL,
  `process_seq` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `module_setup`
--

CREATE TABLE `module_setup` (
  `module_id` int(10) NOT NULL,
  `module_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `passport_info`
--

CREATE TABLE `passport_info` (
  `id` int(11) NOT NULL,
  `center_id` int(10) NOT NULL,
  `center_name` varchar(255) DEFAULT NULL,
  `counter_no` int(10) NOT NULL,
  `pp_no` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `cnic` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `pp_expiry_date` varchar(255) NOT NULL,
  `pp_issue_state` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `passport_verification`
--

CREATE TABLE `passport_verification` (
  `pp_verif_id` int(10) NOT NULL,
  `reg_id` int(10) NOT NULL,
  `verification_notes` text DEFAULT NULL,
  `verify_date` date DEFAULT NULL,
  `process_id` int(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `center_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sample_collection`
--

CREATE TABLE `sample_collection` (
  `sc_id` int(10) NOT NULL,
  `reg_id` int(10) NOT NULL,
  `process_id` int(10) NOT NULL,
  `collection_notes` text NOT NULL,
  `collection_date` date DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `center_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_agency`
--

CREATE TABLE `tb_agency` (
  `agency_id` int(11) NOT NULL,
  `agency` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_country`
--

CREATE TABLE `tb_country` (
  `country_id` int(10) NOT NULL,
  `Name` char(52) NOT NULL DEFAULT '',
  `dialup_code` int(10) DEFAULT NULL,
  `Continent` enum('Asia','Europe','North America','Africa','Oceania','Antarctica','South America') DEFAULT NULL,
  `Region` char(26) DEFAULT NULL,
  `SurfaceArea` float(10,2) DEFAULT NULL,
  `IndepYear` smallint(6) DEFAULT NULL,
  `Population` int(11) DEFAULT NULL,
  `LifeExpectancy` float(3,1) DEFAULT NULL,
  `GNP` float(10,2) DEFAULT NULL,
  `GNPOld` float(10,2) DEFAULT NULL,
  `LocalName` char(45) DEFAULT NULL,
  `GovernmentForm` char(45) DEFAULT NULL,
  `HeadOfState` char(60) DEFAULT NULL,
  `Capital` int(11) DEFAULT NULL,
  `Code2` char(2) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_countrycode`
--

CREATE TABLE `tb_countrycode` (
  `id` int(10) NOT NULL,
  `country_value` varchar(64) NOT NULL,
  `code` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_eno`
--

CREATE TABLE `tb_eno` (
  `eno_id` int(10) NOT NULL,
  `passport_no` varchar(150) NOT NULL,
  `eno` varchar(100) NOT NULL,
  `eno_date` date NOT NULL,
  `screenshot` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(10) NOT NULL,
  `center_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lab_result`
--

CREATE TABLE `tb_lab_result` (
  `lab_result_id` int(10) NOT NULL,
  `reg_id` int(11) DEFAULT NULL,
  `barcode` varchar(100) NOT NULL,
  `HCV` varchar(100) NOT NULL,
  `HBsAg` varchar(100) NOT NULL,
  `HIV` varchar(100) NOT NULL,
  `VDRL` varchar(100) NOT NULL,
  `TPHA` varchar(100) NOT NULL,
  `RBS` varchar(100) DEFAULT NULL,
  `BIL` varchar(50) DEFAULT NULL,
  `ALT` varchar(50) DEFAULT NULL,
  `AST` varchar(50) NOT NULL,
  `ALK` varchar(50) DEFAULT NULL,
  `Creatinine` varchar(50) DEFAULT NULL,
  `blood_group` varchar(50) NOT NULL,
  `Haemoglobin` varchar(50) DEFAULT NULL,
  `Malaria` varchar(100) NOT NULL,
  `Micro_filariae` varchar(100) NOT NULL,
  `sugar` varchar(50) NOT NULL,
  `albumin` varchar(50) NOT NULL,
  `helminthes` varchar(50) NOT NULL,
  `OVA` varchar(50) NOT NULL,
  `CYST` varchar(50) NOT NULL,
  `TB` varchar(50) NOT NULL,
  `pregnancy` varchar(50) NOT NULL,
  `polio` varchar(50) NOT NULL,
  `polio_date` date DEFAULT NULL,
  `MMR1` varchar(50) NOT NULL,
  `mmr1_date` date DEFAULT NULL,
  `MMR2` varchar(50) NOT NULL,
  `mmr2_date` date DEFAULT NULL,
  `meningococcal` varchar(50) NOT NULL,
  `meningococcal_date` date DEFAULT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `center_id` int(10) NOT NULL,
  `lab_status` varchar(10) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_lab_sticker`
--

CREATE TABLE `tb_lab_sticker` (
  `sticker_id` int(10) NOT NULL,
  `reg_id` int(10) NOT NULL,
  `serial_no` varchar(150) NOT NULL,
  `reg_date` date NOT NULL,
  `sticker_print_by` int(10) DEFAULT NULL,
  `sticker_1_printed` int(11) NOT NULL,
  `sticker_value_1` varchar(200) NOT NULL,
  `sticker_value_2` varchar(200) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `sticker_read_by` int(10) DEFAULT NULL,
  `printed` int(11) NOT NULL,
  `center_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_medical`
--

CREATE TABLE `tb_medical` (
  `medical_id` int(10) NOT NULL,
  `reg_id` int(10) NOT NULL,
  `height` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `bmi` varchar(100) NOT NULL,
  `pulse` varchar(100) NOT NULL,
  `rr` varchar(100) NOT NULL,
  `visual_unaided_rt_eye` varchar(150) DEFAULT NULL,
  `visual_unaided_left_eye` varchar(150) DEFAULT NULL,
  `visual_aided_rt_eye` varchar(150) DEFAULT NULL,
  `visual_aided_left_eye` varchar(150) DEFAULT NULL,
  `distant_unaided_rt_eye` varchar(200) DEFAULT NULL,
  `distant_unaided_left_eye` varchar(150) DEFAULT NULL,
  `distant_aided_rt_eye` varchar(150) DEFAULT NULL,
  `distant_aided_left_eye` varchar(150) DEFAULT NULL,
  `near_unaided_rt_eye` varchar(150) DEFAULT NULL,
  `near_unaided_left_eye` varchar(150) DEFAULT NULL,
  `near_aided_rt_eye` varchar(150) DEFAULT NULL,
  `near_aided_left_eye` varchar(150) DEFAULT NULL,
  `color_vision` varchar(150) DEFAULT NULL,
  `hearing_rt_ear` varchar(150) DEFAULT NULL,
  `hearing_left_ear` varchar(150) DEFAULT NULL,
  `appearance` varchar(150) DEFAULT NULL,
  `speech` varchar(150) DEFAULT NULL,
  `behavior` varchar(150) DEFAULT NULL,
  `cognition` varchar(150) DEFAULT NULL,
  `orientation` varchar(150) DEFAULT NULL,
  `memory` varchar(150) DEFAULT NULL,
  `concentration` text DEFAULT NULL,
  `mood` varchar(100) DEFAULT NULL,
  `thoughts` varchar(150) DEFAULT NULL,
  `other` varchar(100) DEFAULT NULL,
  `general_appearance` varchar(100) DEFAULT NULL,
  `cardiovascular` varchar(100) DEFAULT NULL,
  `respiratory` varchar(100) DEFAULT NULL,
  `abdomen` varchar(100) DEFAULT NULL,
  `hernia` varchar(100) DEFAULT NULL,
  `hydrocele` varchar(100) DEFAULT NULL,
  `extremities` varchar(100) DEFAULT NULL,
  `back` varchar(100) DEFAULT NULL,
  `skin` varchar(100) DEFAULT NULL,
  `cns` varchar(100) DEFAULT NULL,
  `deformities` varchar(100) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `process_id` int(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `bp` varchar(100) DEFAULT NULL,
  `ent` varchar(100) DEFAULT NULL,
  `mo_file` varchar(255) DEFAULT NULL,
  `center_id` int(10) NOT NULL,
  `medical_status` varchar(10) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_nationality`
--

CREATE TABLE `tb_nationality` (
  `nationality_id` int(11) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ongoing_tokens`
--

CREATE TABLE `tb_ongoing_tokens` (
  `tr_id` int(10) NOT NULL,
  `token_no` varchar(255) NOT NULL,
  `process_id` int(10) NOT NULL,
  `q_id` int(10) NOT NULL,
  `token_date` date DEFAULT NULL,
  `center_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_organization`
--

CREATE TABLE `tb_organization` (
  `center_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `phone_no` varchar(20) NOT NULL,
  `phone_no_2` varchar(20) NOT NULL,
  `fax_no` varchar(20) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `email_address_2` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `transdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_place_of_issue`
--

CREATE TABLE `tb_place_of_issue` (
  `place_of_issue_id` int(11) NOT NULL,
  `place_of_issue` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_profession`
--

CREATE TABLE `tb_profession` (
  `profession_id` int(10) NOT NULL,
  `profession` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_queue_manager`
--

CREATE TABLE `tb_queue_manager` (
  `q_id` int(10) NOT NULL,
  `token_no` int(10) NOT NULL,
  `process_id` int(10) NOT NULL,
  `process_date` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `center_id` int(10) DEFAULT NULL,
  `counter_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_registration`
--

CREATE TABLE `tb_registration` (
  `reg_id` int(10) NOT NULL,
  `passport_no` varchar(50) NOT NULL,
  `passport_issue_date` varchar(50) DEFAULT NULL,
  `passport_expiry_date` date DEFAULT NULL,
  `place_of_issue` varchar(150) DEFAULT NULL,
  `reg_date` date NOT NULL,
  `serial_no` varchar(150) DEFAULT NULL,
  `key_no` varchar(150) DEFAULT NULL,
  `agency` varchar(255) DEFAULT NULL,
  `country` varchar(150) DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `candidate_name` varchar(255) DEFAULT NULL,
  `relation_type` varchar(50) DEFAULT NULL,
  `son_of` varchar(255) DEFAULT NULL,
  `cnic` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `phone_1` varchar(50) DEFAULT NULL,
  `phone_2` varchar(50) DEFAULT NULL,
  `d_o_b` date DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `marital_status` varchar(10) DEFAULT NULL,
  `barcode_no` varchar(50) DEFAULT NULL,
  `biometric_fingerprint` blob DEFAULT NULL,
  `candidate_img` varchar(255) DEFAULT NULL,
  `fee_charged` varchar(255) DEFAULT NULL,
  `discount` varchar(100) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `pregnancy_test` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(10) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status_remarks` varchar(255) DEFAULT NULL COMMENT 'medical status changing remarks',
  `device_serial_no` varchar(255) DEFAULT NULL,
  `slip_issue_date` date DEFAULT NULL,
  `slip_expiry_date` date DEFAULT NULL,
  `token_no` varchar(100) NOT NULL,
  `center_id` int(10) NOT NULL,
  `print_report_portion` varchar(2) NOT NULL DEFAULT 'A',
  `medical_status` varchar(50) NOT NULL DEFAULT 'In Process'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_report_issue`
--

CREATE TABLE `tb_report_issue` (
  `issue_id` int(10) NOT NULL,
  `reg_id` int(10) NOT NULL,
  `process_id` int(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `center_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tokens`
--

CREATE TABLE `tb_tokens` (
  `t_id` int(10) NOT NULL,
  `token_date` date DEFAULT NULL,
  `token_no` varchar(255) DEFAULT NULL,
  `token_type` varchar(100) DEFAULT NULL,
  `trans_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `center_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_xray`
--

CREATE TABLE `tb_xray` (
  `xray_id` int(10) NOT NULL,
  `reg_id` int(10) NOT NULL,
  `process_id` int(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `center_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_xray_result`
--

CREATE TABLE `tb_xray_result` (
  `xray_id` int(10) NOT NULL,
  `reg_id` int(10) NOT NULL,
  `xray_chest` varchar(255) NOT NULL,
  `xray_notes` varchar(255) NOT NULL,
  `xray_date` date DEFAULT NULL,
  `process_id` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(10) NOT NULL,
  `center_id` int(10) NOT NULL,
  `xray_status` varchar(10) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_xray_slips`
--

CREATE TABLE `tb_xray_slips` (
  `slipid` int(10) NOT NULL,
  `reg_id` int(10) NOT NULL,
  `xray_slips` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `center_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_action_rights`
--

CREATE TABLE `user_action_rights` (
  `action_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `module_id` int(10) NOT NULL,
  `edit_rights` tinyint(1) NOT NULL,
  `delete_rights` tinyint(1) NOT NULL,
  `barcode_verification` tinyint(1) NOT NULL,
  `print_lab_sticker` tinyint(1) NOT NULL COMMENT 'sample collection sticker rights',
  `sample_sticker_attempts` int(11) NOT NULL COMMENT 'Sample collection sticker attempts',
  `no_sticker_prints` int(10) NOT NULL DEFAULT 0 COMMENT 'number of prints sample collection sticker',
  `biometric_allow` tinyint(1) NOT NULL,
  `serial_no_rights` tinyint(1) NOT NULL,
  `now_serving_rights` tinyint(1) NOT NULL,
  `b_plus_rights` tinyint(1) NOT NULL DEFAULT 0,
  `pending_rights` tinyint(1) NOT NULL DEFAULT 0,
  `date_search_rights` tinyint(1) NOT NULL,
  `counter_no` int(11) NOT NULL COMMENT 'registration module rights',
  `lab_sticker_attempts` int(11) NOT NULL DEFAULT 0 COMMENT 'attempts to print lab sticker',
  `lab_sticker` int(11) NOT NULL COMMENT 'number of prints lab sticker',
  `duplicate_sticker` int(11) NOT NULL COMMENT 'duplicate lab sticker module rights',
  `center_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `userid` int(10) NOT NULL,
  `username` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_rights`
--

CREATE TABLE `user_rights` (
  `right_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `module_id` int(10) NOT NULL,
  `center_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bio_test`
--
ALTER TABLE `bio_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_feedback`
--
ALTER TABLE `candidate_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `candidate_medical_process`
--
ALTER TABLE `candidate_medical_process`
  ADD PRIMARY KEY (`tr_id`);

--
-- Indexes for table `city_province`
--
ALTER TABLE `city_province`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CountryCode` (`CountryCode`);

--
-- Indexes for table `db_backup_stats`
--
ALTER TABLE `db_backup_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_process`
--
ALTER TABLE `medical_process`
  ADD PRIMARY KEY (`process_id`);

--
-- Indexes for table `module_setup`
--
ALTER TABLE `module_setup`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `passport_info`
--
ALTER TABLE `passport_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passport_verification`
--
ALTER TABLE `passport_verification`
  ADD PRIMARY KEY (`pp_verif_id`);

--
-- Indexes for table `sample_collection`
--
ALTER TABLE `sample_collection`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `tb_agency`
--
ALTER TABLE `tb_agency`
  ADD PRIMARY KEY (`agency_id`);

--
-- Indexes for table `tb_country`
--
ALTER TABLE `tb_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `tb_eno`
--
ALTER TABLE `tb_eno`
  ADD PRIMARY KEY (`eno_id`);

--
-- Indexes for table `tb_lab_result`
--
ALTER TABLE `tb_lab_result`
  ADD PRIMARY KEY (`lab_result_id`);

--
-- Indexes for table `tb_lab_sticker`
--
ALTER TABLE `tb_lab_sticker`
  ADD PRIMARY KEY (`sticker_id`);

--
-- Indexes for table `tb_medical`
--
ALTER TABLE `tb_medical`
  ADD PRIMARY KEY (`medical_id`),
  ADD KEY `regidfk` (`reg_id`);

--
-- Indexes for table `tb_nationality`
--
ALTER TABLE `tb_nationality`
  ADD PRIMARY KEY (`nationality_id`);

--
-- Indexes for table `tb_ongoing_tokens`
--
ALTER TABLE `tb_ongoing_tokens`
  ADD PRIMARY KEY (`tr_id`);

--
-- Indexes for table `tb_organization`
--
ALTER TABLE `tb_organization`
  ADD PRIMARY KEY (`center_id`);

--
-- Indexes for table `tb_place_of_issue`
--
ALTER TABLE `tb_place_of_issue`
  ADD PRIMARY KEY (`place_of_issue_id`);

--
-- Indexes for table `tb_profession`
--
ALTER TABLE `tb_profession`
  ADD PRIMARY KEY (`profession_id`);

--
-- Indexes for table `tb_queue_manager`
--
ALTER TABLE `tb_queue_manager`
  ADD PRIMARY KEY (`q_id`),
  ADD KEY `process_id` (`process_id`);

--
-- Indexes for table `tb_registration`
--
ALTER TABLE `tb_registration`
  ADD PRIMARY KEY (`reg_id`),
  ADD UNIQUE KEY `reg_date` (`reg_date`,`serial_no`,`country`);

--
-- Indexes for table `tb_report_issue`
--
ALTER TABLE `tb_report_issue`
  ADD PRIMARY KEY (`issue_id`);

--
-- Indexes for table `tb_tokens`
--
ALTER TABLE `tb_tokens`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `tb_xray`
--
ALTER TABLE `tb_xray`
  ADD PRIMARY KEY (`xray_id`);

--
-- Indexes for table `tb_xray_result`
--
ALTER TABLE `tb_xray_result`
  ADD PRIMARY KEY (`xray_id`);

--
-- Indexes for table `tb_xray_slips`
--
ALTER TABLE `tb_xray_slips`
  ADD PRIMARY KEY (`slipid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_action_rights`
--
ALTER TABLE `user_action_rights`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `user_rights`
--
ALTER TABLE `user_rights`
  ADD PRIMARY KEY (`right_id`),
  ADD KEY `useridFK` (`user_id`),
  ADD KEY `module_id` (`module_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bio_test`
--
ALTER TABLE `bio_test`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate_feedback`
--
ALTER TABLE `candidate_feedback`
  MODIFY `feedback_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate_medical_process`
--
ALTER TABLE `candidate_medical_process`
  MODIFY `tr_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `city_province`
--
ALTER TABLE `city_province`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_backup_stats`
--
ALTER TABLE `db_backup_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_process`
--
ALTER TABLE `medical_process`
  MODIFY `process_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_setup`
--
ALTER TABLE `module_setup`
  MODIFY `module_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passport_info`
--
ALTER TABLE `passport_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passport_verification`
--
ALTER TABLE `passport_verification`
  MODIFY `pp_verif_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sample_collection`
--
ALTER TABLE `sample_collection`
  MODIFY `sc_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_agency`
--
ALTER TABLE `tb_agency`
  MODIFY `agency_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_country`
--
ALTER TABLE `tb_country`
  MODIFY `country_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_eno`
--
ALTER TABLE `tb_eno`
  MODIFY `eno_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_lab_result`
--
ALTER TABLE `tb_lab_result`
  MODIFY `lab_result_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_lab_sticker`
--
ALTER TABLE `tb_lab_sticker`
  MODIFY `sticker_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_medical`
--
ALTER TABLE `tb_medical`
  MODIFY `medical_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_nationality`
--
ALTER TABLE `tb_nationality`
  MODIFY `nationality_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_ongoing_tokens`
--
ALTER TABLE `tb_ongoing_tokens`
  MODIFY `tr_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_organization`
--
ALTER TABLE `tb_organization`
  MODIFY `center_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_place_of_issue`
--
ALTER TABLE `tb_place_of_issue`
  MODIFY `place_of_issue_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_profession`
--
ALTER TABLE `tb_profession`
  MODIFY `profession_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_queue_manager`
--
ALTER TABLE `tb_queue_manager`
  MODIFY `q_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_registration`
--
ALTER TABLE `tb_registration`
  MODIFY `reg_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_report_issue`
--
ALTER TABLE `tb_report_issue`
  MODIFY `issue_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_tokens`
--
ALTER TABLE `tb_tokens`
  MODIFY `t_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_xray`
--
ALTER TABLE `tb_xray`
  MODIFY `xray_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_xray_result`
--
ALTER TABLE `tb_xray_result`
  MODIFY `xray_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_xray_slips`
--
ALTER TABLE `tb_xray_slips`
  MODIFY `slipid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_action_rights`
--
ALTER TABLE `user_action_rights`
  MODIFY `action_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_rights`
--
ALTER TABLE `user_rights`
  MODIFY `right_id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
