-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 28, 2024 at 05:03 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lls`
--

-- --------------------------------------------------------

--
-- Table structure for table `contractors`
--

CREATE TABLE `contractors` (
  `contractor_id` int NOT NULL,
  `contractor_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `proprietor` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_number_owner` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone_number` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` set('inactive','active') COLLATE utf8mb4_general_ci NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contractors`
--

INSERT INTO `contractors` (`contractor_id`, `contractor_name`, `proprietor`, `street`, `barangay`, `city`, `province`, `phone_number`, `phone_number_owner`, `telephone_number`, `email_address`, `status`, `created_on`) VALUES
(10, 'DDS Builders', 'Denny S. Sasil', NULL, '1004209048-Villaflor', '1004209000-City of Oroquieta', '1004200000-Misamis Occidental', '09399168447', 'Engr. Robert Lamparas', NULL, 'robertlamparas@yahoo.com', 'active', '2024-07-23 08:33:08'),
(11, 'SBU Builders & General Merchandise', 'William L. Siao', NULL, '1004209031-Poblacion II', '1004209000-City of Oroquieta', '1004200000-Misamis Occidental', NULL, NULL, '531-1187', 'sbu.construction.supplies@gmail.com', 'active', '2024-07-23 08:36:15'),
(12, 'Lexand Construction & Development', 'Alexander L. Lim', NULL, NULL, '1004210000-City of Ozamiz', '1004200000-Misamis Occidental', '09073574277', NULL, NULL, 'lim.alexander.1@gmail.com', 'active', '2024-07-23 08:39:54'),
(13, 'Alfahad Builders & Enterprises', 'Abdul Samad P. Amod', NULL, NULL, '1903603000-Balindong', '1903600000-Lanao del Sur', '09568804475', NULL, NULL, NULL, 'active', '2024-07-23 08:42:12'),
(14, 'Grace Construction Corporation', 'Delwin Vince Y. Chiong', 'Grace Compound, Bernad Subdivision', NULL, '1004210000-City of Ozamiz', '1004200000-Misamis Occidental', '09100000268', 'Bebot Boligor', '521-1540', 'graceconst@yahoo.com', 'active', '2024-07-23 11:57:32'),
(15, 'Luv\' Doer Construction & General Merchandise', 'Love C. Divina', 'P1', '1004209016-Lamac Upper', '1004209000-City of Oroquieta', '1004200000-Misamis Occidental', '09985504002', 'Love Divina', NULL, 'luvdoerconstgenmdse@gmail.com', 'active', '2024-07-23 12:00:58'),
(16, 'Mamsar Construction & Industrial Corporation', 'Almita Dasmariñas Barug', NULL, '1030900030-Tubod', '1030900000-City of Iligan', '1003500000-Lanao del Norte', NULL, NULL, '221-3345', NULL, 'active', '2024-07-23 12:04:01'),
(17, 'Silver Construction', 'Jerry L. Sy', '#77JJ Gonzaga Village, Bakyas', '0630200051-Mansilingan', '0630200000-City of Bacolod', '0604500000-Negros Occidental', NULL, NULL, NULL, NULL, 'active', '2024-07-23 12:06:55'),
(18, 'Mirajem Builders & Construction Supply', 'Jerry L. Malinis', NULL, '1004209031-Poblacion II', '1004209000-City of Oroquieta', '1004200000-Misamis Occidental', '09107212986', NULL, '531-0708', 'mirajembuilders@gmail.com', 'active', '2024-07-23 12:09:20'),
(19, 'Dicon Builders Corporation', 'Irvine O. Sumagang', 'Bauhina Orchid St,. San Miguel Village', '1030900016-Palao', '1030900000-City of Iligan', '1003500000-Lanao del Norte', '09778042801', NULL, NULL, NULL, 'active', '2024-07-23 12:12:17'),
(20, 'Montphil Construction Corporation', 'Pancratius A. Montaño', NULL, '0907202020-Turno', '0907202000-City of Dipolog', '0907200000-Zamboanga del Norte', NULL, NULL, '212-7272', 'montphilconst_97@yahoo.com', 'active', '2024-07-23 12:29:59'),
(21, 'MBD General Construction', 'Manolo B. Dybongco', NULL, NULL, '1004210000-City of Ozamiz', '1004200000-Misamis Occidental', '09109495345', NULL, '521-6073', NULL, 'active', '2024-07-23 12:31:22'),
(22, 'RJLG Construction & Supplies', 'Geoffrey L. Dybongco', 'Upper Centro', NULL, '1004215000-City of Tangub', '1004200000-Misamis Occidental', '09305291525', 'May Joy Sale', NULL, 'dybz67geoff@gmail.com', 'active', '2024-07-23 12:40:30'),
(23, 'Blaff Construction & Supplies', 'Francis D. Navarrez', 'Fertig St,. Manolo', NULL, '1004215000-City of Tangub', '1004200000-Misamis Occidental', '09178214582', NULL, NULL, 'blaffconst2018@gmail.com', 'active', '2024-07-23 12:43:18'),
(24, 'RRJ Builders Construction & General Merchandise', 'Ruel M. Yap', 'Purok 1', '1004209015-Lamac Lower', '1004209000-City of Oroquieta', '1004200000-Misamis Occidental', '09177222445', NULL, NULL, 'rrjbuilders_yap3@yahoo.com', 'active', '2024-07-23 12:45:29'),
(25, 'Vicente T. Lao Construction', 'Vicente T. Lao', NULL, NULL, '1004210000-City of Ozamiz', '1004200000-Misamis Occidental', '09300285454', NULL, NULL, 'vtlc_ozamiz@yahoo.com', 'active', '2024-07-23 12:46:46'),
(26, 'J.C. Dela Vega Construction Supply', 'James A. Dela Vega Jr.', 'Purok 5', '1004210013-Catadman-Manabay', '1004210000-City of Ozamiz', '1004200000-Misamis Occidental', '09262709795', NULL, '521-7446', 'jcdevegaconst@gmail.com', 'active', '2024-07-23 12:50:51');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `extension` varchar(50) DEFAULT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `barangay` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `street` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `first_name`, `middle_name`, `last_name`, `extension`, `province`, `city`, `barangay`, `street`, `contact_number`, `created_on`) VALUES
(4, 'Basil John', 'Calamongay', 'Manabo', NULL, '1004300000-Misamis Oriental', '1004209000-City of Oroquieta', '1004312013-Salubsob', 'Purok 2', '09123213213', '2024-07-26 14:31:22'),
(5, 'Almira Joy', NULL, 'Bugtong', NULL, '0307100000-Zambales', '0307109000-San Antonio', NULL, NULL, '123213213', '2024-07-26 14:32:09'),
(6, 'Smaple', 'asd', 'sadsa', 'dsadsa', '1004200000-Misamis Occidental', '1004209000-City of Oroquieta', '1004209001-Apil', NULL, NULL, '2024-07-27 05:38:32'),
(7, 'asdsad', 'asdsad', 'asdsad', NULL, '0307100000-Zambales', '0307111000-San Marcelino', '0307111016-San Isidro', NULL, NULL, '2024-07-28 11:34:49'),
(8, 'gdfdf', 'dfdf', 'dfdf', NULL, '0307100000-Zambales', '0307110000-San Felipe', NULL, 'sadsad', 'sadsad', '2024-07-28 11:35:40'),
(9, 'Mark Anthony', NULL, 'sadsad', NULL, '0306900000-Tarlac', '0306911000-Pura', NULL, NULL, NULL, '2024-07-28 11:36:06'),
(10, 'sadsad', 'asdsad', 'sadasd', 'asd', '0401000000-Batangas', '0401012000-Lemery', NULL, NULL, NULL, '2024-07-28 11:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `employment_status`
--

CREATE TABLE `employment_status` (
  `employ_stat_id` int NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employment_status`
--

INSERT INTO `employment_status` (`employ_stat_id`, `status`, `created_on`) VALUES
(2, 'Active', '2024-07-26 07:13:59'),
(3, 'Resigned', '2024-07-26 07:14:06'),
(4, 'Terminated', '2024-07-26 07:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `establishments`
--

CREATE TABLE `establishments` (
  `establishment_id` int NOT NULL,
  `establishment_code` varchar(150) NOT NULL,
  `establishment_name` varchar(255) NOT NULL,
  `contact_number` varchar(11) DEFAULT NULL,
  `telephone_number` varchar(150) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `email_address` varchar(150) DEFAULT NULL,
  `authorized_personnel` varchar(250) DEFAULT NULL,
  `position` varchar(150) DEFAULT NULL,
  `status` set('active','inactive') NOT NULL,
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `establishments`
--

INSERT INTO `establishments` (`establishment_id`, `establishment_code`, `establishment_name`, `contact_number`, `telephone_number`, `barangay`, `street`, `email_address`, `authorized_personnel`, `position`, `status`, `created_on`) VALUES
(53, 'ES-001', '1st Valley Bank Inc.', '09178498326', '531 8326', 'Poblacion 1', 'Enanoria Bldg.,Sen. Jose  Oz. St.', 'oroquieta@1stvalleybank.com', 'Ray C. Adala', 'Branch Manager', 'active', '2024-07-24 01:05:48'),
(54, 'ES-003', 'A+PGS Credit Services Inc.', '09489328917', NULL, 'Lower Langcangan', 'Ozamiz St.', NULL, 'Monina L. Gabule', 'Manager', 'active', '2024-07-24 01:18:50'),
(55, 'ES-002', '8 Bravo Farm Inc.', '09073941357', NULL, 'Dullan Sur', 'Purok 3', 'berniedulam@aol.com', 'Bernie L. Dulam', 'General Manager', 'active', '2024-07-24 01:21:50'),
(56, 'ES-004', 'Alano and Sons Credit Corporation', '09183595453', NULL, 'Poblacion 1', 'Alano and Sons Bldg. Rizal St', 'ascc_recruitment@alanoandsons.com', 'Haidee O. Diagmel', 'HRD Manager', 'active', '2024-07-24 01:23:26'),
(57, 'ES-006', 'Almar Freemile Financing Corporation', '09208457496', '564-8225', 'Upper Langcangan', 'Purok 6', 'undaglone@yahoo.com', 'Khasmaine Rose B. Batoy', 'Secretary', 'active', '2024-07-24 01:24:55'),
(58, 'ES-007', 'BDO Unibank Inc. Misamis Occ - Oroquieta', '09190631009', '531 1122', 'Poblacion 2', 'Mayor A. Enerio. St', 'b.h.misamis-occ-oroquieta@bdo.com.ph', 'Clete Alan U. Yap', 'Branch Head', 'active', '2024-07-24 01:26:20'),
(59, 'ES-008', 'Better Brews Cafe', '09108728606', NULL, 'Lower Langcangan', 'Independence St.', 'betterbrewsoroq@gmail.com', 'Remie Jane C. Empeynado', 'Manager', 'active', '2024-07-24 01:27:12'),
(60, 'ES-009', 'BPI Direct Banko Incorporated - A Subsidiary of BPI', '09757949562', '521 7220', 'Poblacion 2', 'Barrientos St.', 'bankoBR10321@gmail.com', 'Imeldo Ayo Argel', 'Branch Manager', 'active', '2024-07-24 01:27:59'),
(61, 'ES-010', 'BSA Rice Mill', '09985577380', NULL, 'Talic', 'Purok 7', NULL, 'Jessie S. Amboang', 'Proprietor', 'active', '2024-07-24 01:28:52'),
(62, 'ES-011', 'BY Grains Dealer', '09999918852', NULL, 'Talic', 'Purok 7', NULL, 'Cecilia C. Amboang', 'Proprietor', 'active', '2024-07-24 01:38:02'),
(63, 'ES-012', 'Camsur General Merchandise Inc.- Department', '09350986699', '531-0048', 'Select Barangay', NULL, 'camsuroroquieta@gmail.com', 'Jocelyn S. Enopia', 'Store Manager', 'active', '2024-07-24 01:38:39'),
(64, 'ES-013', 'Save Daily Supermarket', '09093140918', '545-0342', 'Poblacion 1', 'Padre Gomez St.', 'wanbee_oroquieta@yahoo.com', 'Sally S. Gumatay', 'Supervisor', 'active', '2024-07-24 01:40:24'),
(65, 'ES-014', 'Card MRI Rizal Bank Inc.', '09306348782', '531-3090', 'Layawan', 'Purok 1', 'hacbayan@yahoo.com', 'Heric B. Acbayan', 'Area Manager', 'active', '2024-07-24 01:41:13'),
(66, 'ES-015', 'Charm Face and Body Care Center', '09305843777', '531-0057', 'Poblacion 1', 'Togashi Bldg., Cor. JP Quijano St.', 'charm.oroquieta@gmail.com', 'Lindy M. Coyoca', 'Front Desk', 'active', '2024-07-24 01:42:38'),
(67, 'ES-016', 'Consolidated Cooperative Bank', '09177075611', '531 1256', 'Poblacion 1', 'H 268 Senator J. Ozamiz St.', 'ccboroquieta2020@gmail.com', 'Benito S. Guro', 'Branch Manager', 'active', '2024-07-24 01:43:51'),
(68, 'ES-017', 'Costa Del Sol', '09202377777', '545 3356', 'Lower Loboc', 'Magsaysay St.', 'info.costadelsolresorthotel@gmail.com', 'Baby Mercedita O. Guantero', 'Corp. President', 'active', '2024-07-24 01:45:17'),
(69, 'ES-018', 'Denz Softdrinks Trading', '09088163686', NULL, 'San Vicente Alto', 'Purok 3', NULL, 'Danny J. Te', 'Owner', 'active', '2024-07-24 01:46:48'),
(70, 'ES-019', 'Deor & Dune Academe School of Technology, Inc.', '09463107026', '545-2200', 'Poblacion 2', '3rd flr. JC Bldg.  Barrientos St.', 'deor.dune@yahoo.com', 'Dionisia T.  Muaña', 'School Administrator', 'active', '2024-07-24 01:50:58'),
(71, 'ES-020', 'Des Appliance Plaza, Inc.', '09124555283', '531 1779', 'Poblacion 2', 'JC Reyes, Bldg. Barientos St.', 'dap.oroquieta2@gmail.com', 'Mae Bation', 'Branch Manager', 'active', '2024-07-24 01:52:32');

-- --------------------------------------------------------

--
-- Table structure for table `establishment_employee`
--

CREATE TABLE `establishment_employee` (
  `estab_emp_id` int NOT NULL,
  `establishment_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `position_id` int NOT NULL,
  `nature_of_employment` varchar(255) NOT NULL,
  `status_of_employment_id` int NOT NULL,
  `year_employed` year NOT NULL,
  `level_of_employment` set('rank_and_file','managerial','proprietor') NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `establishment_employee`
--

INSERT INTO `establishment_employee` (`estab_emp_id`, `establishment_id`, `employee_id`, `position_id`, `nature_of_employment`, `status_of_employment_id`, `year_employed`, `level_of_employment`, `created_on`) VALUES
(41, 53, 10, 8, 'project_based', 3, '2024', 'proprietor', '2024-07-28 15:44:38');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `position_id` int NOT NULL,
  `position` varchar(250) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `position`, `created_on`) VALUES
(6, 'Cashiers', '2024-07-26 06:29:19'),
(7, 'Store manager', '2024-07-26 06:29:30'),
(8, 'Sales Associate', '2024-07-26 06:29:48');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int NOT NULL,
  `contractor_id` int NOT NULL,
  `project_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `project_cost` float(10,2) NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `contractor_id`, `project_title`, `project_cost`, `street`, `barangay`, `city`, `province`, `created_on`) VALUES
(8, 6, 'fdsf', 123123.00, 'sdsfdsf 123213', '0105512016-San Felipe Central', '0105512000-Binalonan', '0105500000-Pangasinan', '2024-07-21 17:04:26'),
(9, 6, 'sample', 123.00, 'fdsfd sdfsdf', '0102913005-Casilagan', '0102913000-Nagbukel', '0102900000-Ilocos Sur', '2024-07-21 17:04:48'),
(10, 6, 'sadasd', 213213.00, 'dasdsad', '0401010017-Poblacion', '0401010000-Ibaan', '0401000000-Batangas', '2024-07-21 17:10:19'),
(11, 6, 'sadsad', 213213.00, 'asdsa asdsa', '0103310014-Magallanes', '0103310000-Luna', '0103300000-La Union', '2024-07-21 17:14:36'),
(12, 6, 'asdas', 123213.00, 'sadsad asdsad', '0304914012-Villarosa', '0304914000-Licab', '0304900000-Nueva Ecija', '2024-07-22 10:01:06');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `survey_id` int NOT NULL,
  `establishment_id` int NOT NULL,
  `year` year NOT NULL,
  `inside_permanent` int DEFAULT NULL,
  `inside_probationary` int DEFAULT NULL,
  `inside_contractuals` int DEFAULT NULL,
  `inside_project_based` int DEFAULT NULL,
  `inside_seasonal` int DEFAULT NULL,
  `inside_job_order` int DEFAULT NULL,
  `inside_mgt` int DEFAULT NULL,
  `outside_permanent` int DEFAULT NULL,
  `outside_probationary` int DEFAULT NULL,
  `outside_contractuals` int DEFAULT NULL,
  `outside_project_based` int DEFAULT NULL,
  `outside_seasonal` int DEFAULT NULL,
  `outside_job_order` int DEFAULT NULL,
  `outside_mgt` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`survey_id`, `establishment_id`, `year`, `inside_permanent`, `inside_probationary`, `inside_contractuals`, `inside_project_based`, `inside_seasonal`, `inside_job_order`, `inside_mgt`, `outside_permanent`, `outside_probationary`, `outside_contractuals`, `outside_project_based`, `outside_seasonal`, `outside_job_order`, `outside_mgt`) VALUES
(2, 53, '2024', 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(3, 53, '2022', 123, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contractors`
--
ALTER TABLE `contractors`
  ADD PRIMARY KEY (`contractor_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `employment_status`
--
ALTER TABLE `employment_status`
  ADD PRIMARY KEY (`employ_stat_id`);

--
-- Indexes for table `establishments`
--
ALTER TABLE `establishments`
  ADD PRIMARY KEY (`establishment_id`);

--
-- Indexes for table `establishment_employee`
--
ALTER TABLE `establishment_employee`
  ADD PRIMARY KEY (`estab_emp_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`survey_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contractors`
--
ALTER TABLE `contractors`
  MODIFY `contractor_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employment_status`
--
ALTER TABLE `employment_status`
  MODIFY `employ_stat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `establishments`
--
ALTER TABLE `establishments`
  MODIFY `establishment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `establishment_employee`
--
ALTER TABLE `establishment_employee`
  MODIFY `estab_emp_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `survey_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
