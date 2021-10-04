-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2018 at 01:50 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csmt`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `examScore` (`score` INT) RETURNS INT(3) RETURN score * 0.7$$

CREATE DEFINER=`root`@`localhost` FUNCTION `grade` (`grade_point` INT) RETURNS CHAR(2) CHARSET latin1 RETURN 
                   CASE
                       WHEN grade_point >= 90 THEN "A+"
                       WHEN grade_point >= 80 THEN "A"
                       WHEN grade_point >= 70 THEN "B+"
                       WHEN grade_point >= 60 THEN "B"
                       WHEN grade_point >= 50 THEN "C"
                       WHEN grade_point >= 40 THEN "D"
                       WHEN grade_point < 40 THEN "F"
                   END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `gradePoint` (`test1` INT, `test2` INT, `test3` INT, `exam` INT) RETURNS INT(3) return ((test1 + test2 + test3) * 0.1) + (exam * 0.7)$$

CREATE DEFINER=`root`@`localhost` FUNCTION `remark` (`grade_point` INT(5) UNSIGNED) RETURNS VARCHAR(20) CHARSET latin1 RETURN 
                   CASE
                       WHEN grade_point >= 90 THEN "EXCELLENT"
                       WHEN grade_point >= 80 THEN "VERY GOOD"
                       WHEN grade_point >= 70 THEN "GOOD"
                       WHEN grade_point >= 60 THEN "FAIRLY GOOD"
                       WHEN grade_point >= 50 THEN "FAIR"
                       WHEN grade_point >= 40 THEN "POOR"
                       WHEN grade_point < 40 THEN "VERY POOR"
                   END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `testScore` (`score` INT) RETURNS INT(3) RETURN score * 0.1$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `aagc`
--

CREATE TABLE `aagc` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_class_id` int(10) UNSIGNED DEFAULT NULL,
  `arm_id` int(10) UNSIGNED DEFAULT NULL,
  `alias_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `aagc`
--

INSERT INTO `aagc` (`id`, `group_class_id`, `arm_id`, `alias_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL),
(2, 1, 2, 2, NULL, NULL),
(3, 1, 3, 3, NULL, NULL),
(4, 1, 4, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aagc_session`
--

CREATE TABLE `aagc_session` (
  `id` int(10) UNSIGNED NOT NULL,
  `session_id` int(10) UNSIGNED DEFAULT NULL,
  `aagc_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `aagc_session`
--

INSERT INTO `aagc_session` (`id`, `session_id`, `aagc_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `aagc_session_student`
--

CREATE TABLE `aagc_session_student` (
  `id` int(10) UNSIGNED NOT NULL,
  `aagc_id` int(10) UNSIGNED DEFAULT NULL,
  `session_id` int(10) UNSIGNED DEFAULT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `principal_comment` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_comment` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostel_comment` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `promotion_status` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `aagc_session_student`
--

INSERT INTO `aagc_session_student` (`id`, `aagc_id`, `session_id`, `student_id`, `principal_comment`, `teacher_comment`, `hostel_comment`, `promotion_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL, NULL, 0, NULL, NULL),
(2, 1, 1, 2, NULL, NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aagc_subject`
--

CREATE TABLE `aagc_subject` (
  `id` int(10) UNSIGNED NOT NULL,
  `aagc_id` int(10) UNSIGNED DEFAULT NULL,
  `subject_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `aagc_subject`
--

INSERT INTO `aagc_subject` (`id`, `aagc_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2018-10-11 04:10:27', NULL),
(2, 1, 2, '2018-10-11 04:10:27', NULL),
(3, 1, 3, '2018-10-11 04:10:27', NULL),
(4, 1, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aagc_subject_student`
--

CREATE TABLE `aagc_subject_student` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED DEFAULT NULL,
  `aagc_id` int(10) UNSIGNED DEFAULT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `session_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `aagc_subject_student`
--

INSERT INTO `aagc_subject_student` (`id`, `subject_id`, `aagc_id`, `student_id`, `session_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2018-10-11 04:10:27', NULL),
(2, 2, 1, 1, 1, '2018-10-11 04:10:27', NULL),
(3, 3, 1, 1, 1, '2018-10-11 04:10:27', NULL),
(4, 1, 1, 2, 1, '2018-10-11 04:10:27', NULL),
(5, 2, 1, 2, 1, '2018-10-11 04:10:27', NULL),
(6, 3, 1, 2, 1, '2018-10-11 04:10:27', NULL),
(7, 4, 1, 1, 1, NULL, NULL),
(8, 4, 1, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `aagc_view`
--
CREATE TABLE `aagc_view` (
`id` int(10) unsigned
,`class` varchar(20)
,`arm` varchar(42)
);

-- --------------------------------------------------------

--
-- Table structure for table `aliases`
--

CREATE TABLE `aliases` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `aliases`
--

INSERT INTO `aliases` (`id`, `name`) VALUES
(1, 'Ruby'),
(2, 'Diamond '),
(3, 'Gold'),
(4, 'Sapphire'),
(5, 'Science'),
(6, 'Business'),
(7, 'Humanity');

-- --------------------------------------------------------

--
-- Table structure for table `arms`
--

CREATE TABLE `arms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `arms`
--

INSERT INTO `arms` (`id`, `name`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'E'),
(6, 'F'),
(7, 'G'),
(8, 'H');

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` int(10) UNSIGNED NOT NULL,
  `test1` int(10) UNSIGNED DEFAULT NULL,
  `test3` int(10) UNSIGNED DEFAULT NULL,
  `test2` int(10) UNSIGNED DEFAULT NULL,
  `exam` int(10) UNSIGNED DEFAULT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `aagc_id` int(10) UNSIGNED DEFAULT NULL,
  `session_id` int(10) UNSIGNED DEFAULT NULL,
  `term_id` int(10) UNSIGNED DEFAULT NULL,
  `subject_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`id`, `test1`, `test3`, `test2`, `exam`, `student_id`, `aagc_id`, `session_id`, `term_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(1, 9, 8, 3, 51, 1, 1, 1, 1, 1, '2018-10-11 04:35:54', NULL),
(2, 4, 7, 10, 65, 2, 1, 1, 1, 1, '2018-10-11 04:35:54', NULL),
(3, 4, 1, 1, 60, 1, 1, 1, 1, 2, '2018-10-11 04:36:13', NULL),
(4, 6, 4, 6, 26, 2, 1, 1, 1, 2, '2018-10-11 04:36:13', NULL),
(5, 5, 2, 6, 59, 1, 1, 1, 1, 3, '2018-10-11 04:37:00', NULL),
(6, 7, 8, 3, 60, 2, 1, 1, 1, 3, '2018-10-11 04:37:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assessment_types`
--

CREATE TABLE `assessment_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `percentage` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignment_hostels`
--

CREATE TABLE `assignment_hostels` (
  `id` int(10) UNSIGNED NOT NULL,
  `aagc_id` int(10) UNSIGNED NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignment_subjects`
--

CREATE TABLE `assignment_subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `aagc_id` int(10) UNSIGNED NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(10) UNSIGNED NOT NULL,
  `aagc_id` int(10) UNSIGNED NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `beces`
--

CREATE TABLE `beces` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `subject_id` int(10) UNSIGNED DEFAULT NULL,
  `session_id` int(10) UNSIGNED DEFAULT NULL,
  `score` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bece_details`
--

CREATE TABLE `bece_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `examination_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clinics`
--

CREATE TABLE `clinics` (
  `id` int(10) UNSIGNED NOT NULL,
  `aagc_id` int(10) UNSIGNED NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'CRAT', NULL, NULL),
(2, 'JET', NULL, NULL),
(3, 'HEALTH', NULL, NULL),
(4, 'HOME MGRS', NULL, NULL),
(5, 'CODRAL', NULL, NULL),
(6, 'LITERARY', NULL, NULL),
(7, 'PARLIAMENTARY', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cummulative_assessements`
--

CREATE TABLE `cummulative_assessements` (
  `id` int(10) UNSIGNED NOT NULL,
  `score` int(10) UNSIGNED DEFAULT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `aagc_id` int(10) UNSIGNED DEFAULT NULL,
  `session_id` int(10) UNSIGNED DEFAULT NULL,
  `term_id` int(10) UNSIGNED DEFAULT NULL,
  `subject_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exeats`
--

CREATE TABLE `exeats` (
  `id` int(10) UNSIGNED NOT NULL,
  `aagc_id` int(10) UNSIGNED NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lower_bound` int(10) UNSIGNED DEFAULT NULL,
  `upper_bound` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'Junior School'),
(2, 'Senior School');

-- --------------------------------------------------------

--
-- Table structure for table `group_classes`
--

CREATE TABLE `group_classes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_classes`
--

INSERT INTO `group_classes` (`id`, `name`, `group_id`) VALUES
(1, 'JSS 1', 1),
(2, 'JSS 2', 1),
(3, 'JSS3', 1),
(4, 'SSS1', 2),
(5, 'SSS2', 2),
(6, 'SSS3', 2);

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `id` int(10) UNSIGNED NOT NULL,
  `colour` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `colour`, `created_at`, `updated_at`) VALUES
(1, 'RED', NULL, NULL),
(2, 'YELLOW', NULL, NULL),
(3, 'ORANGE', NULL, NULL),
(4, 'WHITE', NULL, NULL),
(5, 'PURPLE', NULL, NULL),
(6, 'BLUE', NULL, NULL),
(7, 'GREEN', NULL, NULL),
(8, 'PINK', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `junior_mocks`
--

CREATE TABLE `junior_mocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `subject_id` int(10) UNSIGNED DEFAULT NULL,
  `session_id` int(10) UNSIGNED DEFAULT NULL,
  `score` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `junior_mock_details`
--

CREATE TABLE `junior_mock_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lgas`
--

CREATE TABLE `lgas` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lgas`
--

INSERT INTO `lgas` (`id`, `name`, `state_id`) VALUES
(1, 'Aabom', 32),
(2, 'Ababoko', 32),
(3, 'Abalama', 32),
(4, 'Abonema', 32),
(5, 'Abua', 32),
(6, 'Abuloma', 32),
(7, 'Ahoada', 32),
(8, 'Bakana', 32),
(9, 'Bane', 32),
(10, 'Bonny', 32),
(11, 'Bori', 32),
(12, 'Borokiri', 32),
(13, 'Brali', 32),
(14, 'Buguma', 32),
(15, 'Choba', 32),
(16, 'Chokocho', 32),
(17, 'Degema', 32),
(18, 'Diobu', 32),
(19, 'Elekahia', 32),
(20, 'Elekohahia Diobu', 32),
(21, 'Elele', 32),
(22, 'Elele Alimini', 32),
(23, 'Elelewon', 32),
(24, 'Eleme', 32),
(25, 'Eliparonwo', 32),
(26, 'Emohua', 32),
(27, 'Etche', 32),
(28, 'Freetown', 32),
(29, 'Gbaken', 32),
(30, 'Gwara', 32),
(31, 'Ibaa', 32),
(32, 'Igwuruta', 32),
(33, 'Ikiri', 32),
(34, 'Ipo', 32),
(35, 'Isiokpo', 32),
(36, 'Isoba', 32),
(37, 'Iwofe', 32),
(38, 'Iyaba', 32),
(39, 'Mgbuosimini', 32),
(40, 'Okrika', 32),
(41, 'Omoku', 32),
(42, 'Onne', 32),
(43, 'Opobo', 32),
(44, 'Port Harcourt', 32),
(45, 'Rukpoku', 32),
(46, 'Rumuaholu', 32),
(47, 'Rumueme', 32),
(48, 'Rumuigbo', 32),
(49, 'Rumuola', 32),
(50, 'Rumuokoro', 32),
(51, 'Sangama', 32),
(52, 'Abaji', 37),
(53, 'Abuja', 37),
(54, 'Asokoro', 37),
(55, 'Durumi', 37),
(56, 'Garki', 37),
(57, 'Gerki', 37),
(58, 'Gwagwalada', 37),
(59, 'Gwarimpa', 37),
(60, 'Kuje', 37),
(61, 'Bwari', 37),
(62, 'Kwali', 37),
(63, 'Wuse', 37),
(64, 'Maitama', 37),
(65, 'Abak', 3),
(66, 'Eket', 3),
(67, 'Esit Eket', 3),
(68, 'Etinan', 3),
(69, 'Ikot Abasi', 3),
(70, 'Ikot Ekpene', 3),
(71, 'Ikono', 3),
(72, 'Oron', 3),
(73, 'Uruan', 3),
(74, 'Uyo', 3),
(75, 'Aba', 1),
(76, 'Abiriba', 1),
(77, 'Arochukwu', 1),
(78, 'Bende', 1),
(79, 'Ikwuano', 1),
(80, 'Isiala Ngwa North', 1),
(81, 'Isuikwuato', 1),
(82, 'Obi Ngwa', 1),
(83, 'Ohafia', 1),
(84, 'Osisioma Ngwa', 1),
(85, 'Ugwunagbo', 1),
(86, 'Ukwa', 1),
(87, 'Umuahia', 1),
(88, 'Umu Nneochi', 1),
(89, 'Aboh Mbaise', 16),
(90, 'Ahiazu Mbaise', 16),
(91, 'Ehime Mbano', 16),
(92, 'Ezinihitte Mbaise', 16),
(93, 'Ideato', 16),
(94, 'Ihitte/Uboma', 16),
(95, 'Ikeduru', 16),
(96, 'Isiala Mbano', 16),
(97, 'Isu', 16),
(98, 'Mbaitoli', 16),
(99, 'Ngor Okpala', 16),
(100, 'Njaba', 16),
(101, 'Nkwerre', 16),
(102, 'Nwangele', 16),
(103, 'Obowo', 16),
(104, 'Oguta', 16),
(105, 'Ohaji/Egbema', 16),
(106, 'Okigwe', 16),
(107, 'Onuimo', 16),
(108, 'Orlu', 16),
(109, 'Orsu', 16),
(110, 'Oru', 16),
(111, 'Owerri', 16),
(112, 'Demsa', 2),
(113, 'Fufure', 2),
(114, 'Ganye', 2),
(115, 'Gerie', 2),
(116, 'Gombi', 2),
(117, 'Guyuk', 2),
(118, 'Hong', 2),
(119, 'Jada', 2),
(120, 'Jimeta', 2),
(121, 'Lamurde', 2),
(122, 'Madagali', 2),
(123, 'Maiga', 2),
(124, 'Mayo Belwa', 2),
(125, 'Michika', 2),
(126, 'Mobi North', 2),
(127, 'Mubi', 2),
(128, 'Numan', 2),
(129, 'Song', 2),
(130, 'Tungo', 2),
(131, 'Yola', 2),
(132, 'Aguata', 4),
(133, 'Awka', 4),
(134, 'Anaocha', 4),
(135, 'Anambra East', 4),
(136, 'Anambra West', 4),
(137, 'Ayamelum', 4),
(138, 'Dunukofia', 4),
(139, 'Ekwusigo', 4),
(140, 'Idemili North', 4),
(141, 'Idemili South', 4),
(142, 'Ihiala', 4),
(143, 'Njikoka', 4),
(144, 'Nnewi North', 4),
(145, 'Nnewi South', 4),
(146, 'Ogbaru', 4),
(147, 'Onitsha North', 4),
(148, 'Onitsha South', 4),
(149, 'Orumba North', 4),
(150, 'Orumba South', 4),
(151, 'Oyi', 4),
(152, 'Alkaleri', 5),
(153, 'Bauchi', 5),
(154, 'Bogoro', 5),
(155, 'Dambam', 5),
(156, 'Darazo', 5),
(157, 'Dass', 5),
(158, 'Gadau', 5),
(159, 'Gamawa', 5),
(160, 'Ganjuwa', 5),
(161, 'Giade', 5),
(162, 'Jamaare', 5),
(163, 'Katagum', 5),
(164, 'Kirfi', 5),
(165, 'Misau', 5),
(166, 'Ningi', 5),
(167, 'Shira', 5),
(168, 'Tafawa Balewa', 5),
(169, 'Toro', 5),
(170, 'Warji', 5),
(171, 'Zaki', 5),
(172, 'Brass', 6),
(173, 'Ekeremor', 6),
(174, 'Kolokumma', 6),
(175, 'Nembe', 6),
(176, 'Ogbia', 6),
(177, 'Sagbama', 6),
(178, 'Soutern Ijaw', 6),
(179, 'Yenagoa', 6),
(180, 'Ador', 7),
(181, 'Agatu', 7),
(182, 'Apa', 7),
(183, 'Guma', 7),
(184, 'Gwer East/West', 7),
(185, 'Konshisha', 7),
(186, 'Kwande', 7),
(187, 'Logo', 7),
(188, 'Makurdi', 7),
(189, 'Obi/Oju', 7),
(190, 'Ohimin', 7),
(191, 'Okpokwu', 7),
(192, 'Otukpo', 7),
(193, 'Takar', 7),
(194, 'Ushongo', 7),
(195, 'Vandeikya', 7),
(196, 'Abadam', 8),
(197, 'Askira-Uba', 8),
(198, 'Bama', 8),
(199, 'Bayo', 8),
(200, 'Biu', 8),
(201, 'Chibok', 8),
(202, 'Damboa', 8),
(203, 'Dikwa', 8),
(204, 'Gubio', 8),
(205, 'Guzamala', 8),
(206, 'Gwoza', 8),
(207, 'Hawul', 8),
(208, 'Jere', 8),
(209, 'Kaga', 8),
(210, 'Kala Balge', 8),
(211, 'Konduga', 8),
(212, 'Kukawa', 8),
(213, 'Kwaya Kusar', 8),
(214, 'Mafa', 8),
(215, 'Magumeri', 8),
(216, 'Maiduguri', 8),
(217, 'Marte', 8),
(218, 'Mobbar', 8),
(219, 'Monguno', 8),
(220, 'Ngala', 8),
(221, 'Nganzai', 8),
(222, 'Shani', 8),
(223, 'Abi', 9),
(224, 'Akampa', 9),
(225, 'Bakassi', 9),
(226, 'Bekwara', 9),
(227, 'Boki', 9),
(228, 'Calabar', 9),
(229, 'Ikom', 9),
(230, 'Obubral', 9),
(231, 'Obudu', 9),
(232, 'Agbor', 10),
(233, 'Aniocha North', 10),
(234, 'Aniocha South', 10),
(235, 'Asaba', 10),
(236, 'Bomadi', 10),
(237, 'Burutu', 10),
(238, 'Ethiope East', 10),
(239, 'Ethiope West', 10),
(240, 'Ika North East', 10),
(241, 'Ika South', 10),
(242, 'Isoko North', 10),
(243, 'Isoko South', 10),
(244, 'Ndokwa East', 10),
(245, 'Ndokwa West', 10),
(246, 'Okpe', 10),
(247, 'Oshimili North', 10),
(248, 'Patani', 10),
(249, 'Sapele', 10),
(250, 'Udu', 10),
(251, 'Ughelli', 10),
(252, 'Ughelli South', 10),
(253, 'Ukwuani', 10),
(254, 'Uvwie', 10),
(255, 'Warri', 10),
(256, 'Abakaliki', 11),
(257, 'Afikpo South', 11),
(258, 'Ebonyi', 11),
(259, 'Ezza North', 11),
(260, 'Ikwo', 11),
(261, 'Ishehu', 11),
(262, 'Izzi', 11),
(263, 'Ohaozra', 11),
(264, 'Ohaukwu', 11),
(265, 'Onicha', 11),
(266, 'Akoko-Edo', 12),
(267, 'Egor', 12),
(268, 'Esan', 12),
(269, 'Esan North East', 12),
(270, 'Esan South East', 12),
(271, 'Esan West', 12),
(272, 'Etsako', 12),
(273, 'Igueben', 12),
(274, 'Ikpoba/Okha', 12),
(275, 'Oredo', 12),
(276, 'Orhionmwon', 12),
(277, 'Ovia', 12),
(278, 'Owan', 12),
(279, 'Uhunmwonde', 12),
(280, 'Benin City', 12),
(281, 'Ekpoma', 12),
(282, 'Ado Ekiti', 13),
(283, 'Aramoko', 13),
(284, 'Efon-Alaaye', 13),
(285, 'Emure', 13),
(286, 'Gbonyin', 13),
(287, 'Ido', 13),
(288, 'Igede', 13),
(289, 'Ijero-Ekiti', 13),
(290, 'Ikere', 13),
(291, 'Ikere Ekiti', 13),
(292, 'Ikole', 13),
(293, 'Ikole Ekiti', 13),
(294, 'Ilawe', 13),
(295, 'Ise', 13),
(296, 'Omuo', 13),
(297, 'Oye', 13),
(298, 'Aninri', 14),
(299, 'Awgu', 14),
(300, 'Enugu', 14),
(301, 'Enugu East', 14),
(302, 'Enugu North', 14),
(303, 'Enugu South', 14),
(304, 'Ezeagu', 14),
(305, 'Igbo-Etiti', 14),
(306, 'Igbo-Eze North/South', 14),
(307, 'Isi-Uzo', 14),
(308, 'Nkanu East', 14),
(309, 'Nkanu West', 14),
(310, 'Nsukka', 14),
(311, 'Oji River', 14),
(312, 'Udenu', 14),
(313, 'Udi Ment', 14),
(314, 'Uzo-Uwani', 14),
(315, 'Akko', 15),
(316, 'Balanga', 15),
(317, 'Billiri', 15),
(318, 'Dukku', 15),
(319, 'Funakaye', 15),
(320, 'Gombe', 15),
(321, 'Kaltungo', 15),
(322, 'Kwami', 15),
(323, 'Nafada', 15),
(324, 'Shongom', 15),
(325, 'Yamaltu Deba', 15),
(326, 'Auyo', 17),
(327, 'Babur', 17),
(328, 'Birnin Kudu', 17),
(329, 'Birniwa', 17),
(330, 'Buji', 17),
(331, 'Dutse', 17),
(332, 'Gagarawa', 17),
(333, 'Garki', 17),
(334, 'Gumel', 17),
(335, 'Guri', 17),
(336, 'Gwaram', 17),
(337, 'Gwiwa', 17),
(338, 'Hadejia', 17),
(339, 'Jahun', 17),
(340, 'Kafin Hausa', 17),
(341, 'Kaugama', 17),
(342, 'Kazaura', 17),
(343, 'Kiri-Kasamma', 17),
(344, 'Kiyawa', 17),
(345, 'Maigatari', 17),
(346, 'Mallam Madori', 17),
(347, 'Miga', 17),
(348, 'Ringim', 17),
(349, 'Roni', 17),
(350, 'Sule Tankar-Kar', 17),
(351, 'Taura', 17),
(352, 'Yankwashi', 17),
(353, 'Birnin Gwari', 18),
(354, 'Giwa', 18),
(355, 'Gwagwada', 18),
(356, 'Igabi', 18),
(357, 'Ikara', 18),
(358, 'Jaba', 18),
(359, 'Jama`a', 18),
(360, 'Kachia', 18),
(361, 'Kaduna', 18),
(362, 'Kagarko', 18),
(363, 'Kaura', 18),
(364, 'Kauru', 18),
(365, 'Kubau', 18),
(366, 'Kudan', 18),
(367, 'Kujura/Chikun', 18),
(368, 'Lere', 18),
(369, 'Makarfi', 18),
(370, 'Sabo', 18),
(371, 'Sabon Gari', 18),
(372, 'Sanga', 18),
(373, 'Zangon Kataf', 18),
(374, 'Zaria', 18),
(375, 'Ajingi', 19),
(376, 'Albasu', 19),
(377, 'Bagwai', 19),
(378, 'Bebeji', 19),
(379, 'Bichi', 19),
(380, 'Bunkure', 19),
(381, 'Danbatta', 19),
(382, 'Dawakin Kudu', 19),
(383, 'Dawakin Tofa', 19),
(384, 'Doguwa', 19),
(385, 'Gabasawa', 19),
(386, 'Garko', 19),
(387, 'Garun Malam', 19),
(388, 'Gaya', 19),
(389, 'Gezawa', 19),
(390, 'Gwale/Dala', 19),
(391, 'Gwarzo', 19),
(392, 'Kabo', 19),
(393, 'Karaye', 19),
(394, 'Kibiya', 19),
(395, 'Kiru', 19),
(396, 'Kumbotso', 19),
(397, 'Kunchi', 19),
(398, 'Kura', 19),
(399, 'Madobi', 19),
(400, 'Makoda', 19),
(401, 'Minjibir', 19),
(402, 'Rano', 19),
(403, 'Rimin Gado', 19),
(404, 'Rogo', 19),
(405, 'Shanono', 19),
(406, 'Sumaila', 19),
(407, 'Takai', 19),
(408, 'Tarauni/Fegge', 19),
(409, 'Tofa', 19),
(410, 'Tsanyawa', 19),
(411, 'Tudun Wada', 19),
(412, 'Ungogo', 19),
(413, 'Warawa', 19),
(414, 'Wudil', 19),
(415, 'Bakori', 20),
(416, 'Batagarawa', 20),
(417, 'Batsari', 20),
(418, 'Baure', 20),
(419, 'Bindawa', 20),
(420, 'Charanchi', 20),
(421, 'Dandume', 20),
(422, 'Danja', 20),
(423, 'Danmusa', 20),
(424, 'Daura', 20),
(425, 'Dutsi', 20),
(426, 'Dutsi-Ma', 20),
(427, 'Faskari', 20),
(428, 'Funtua', 20),
(429, 'Ingawa', 20),
(430, 'Jibiya', 20),
(431, 'Kafur', 20),
(432, 'Kaita', 20),
(433, 'Kankara', 20),
(434, 'Kankiya', 20),
(435, 'Katsina', 20),
(436, 'Kurfi', 20),
(437, 'Kusada', 20),
(438, 'Mai-Adua', 20),
(439, 'Malumfashi', 20),
(440, 'Mani', 20),
(441, 'Mashi', 20),
(442, 'Matazu', 20),
(443, 'Musawa', 20),
(444, 'Rimi', 20),
(445, 'Sabuwa', 20),
(446, 'Safana', 20),
(447, 'Sandamu', 20),
(448, 'Zango', 20),
(449, 'Alero', 21),
(450, 'Arewa', 21),
(451, 'Argungu', 21),
(452, 'Augie', 21),
(453, 'Bagudo', 21),
(454, 'Birnin Kebbi', 21),
(455, 'Bunza', 21),
(456, 'Dandi', 21),
(457, 'Danko', 21),
(458, 'Fakai', 21),
(459, 'Gwandu T', 21),
(460, 'Jega', 21),
(461, 'Kalgo', 21),
(462, 'Koko-Besse', 21),
(463, 'Maiyama', 21),
(464, 'Ngaski', 21),
(465, 'Sakaba', 21),
(466, 'Shanga', 21),
(467, 'Suru', 21),
(468, 'Yauri', 21),
(469, 'Zuru', 21),
(470, 'Oyigbo', 32),
(471, 'Adavi', 22),
(472, 'Ajaokuta', 22),
(473, 'Ankpa', 22),
(474, 'Bassa', 22),
(475, 'Dekina', 22),
(476, 'Ibaji', 22),
(477, 'Igala-Mela', 22),
(478, 'Ijumu', 22),
(479, 'Kabba', 22),
(480, 'Kabba-Bunu', 22),
(481, 'Kogi', 22),
(482, 'Kabba', 22),
(483, 'Kabba-Bunu', 22),
(484, 'Kogi', 22),
(485, 'Lokoja', 22),
(486, 'Ofu', 22),
(487, 'Ogori-Magongo', 22),
(488, 'Okehi', 22),
(489, 'Okene', 22),
(490, 'Olamaboro', 22),
(491, 'Omala', 22),
(492, 'Yagba East', 22),
(493, 'Yagba West', 22),
(494, 'Asa', 23),
(495, 'Baruten/Kaiama', 23),
(496, 'Edu', 23),
(497, 'Ekiti', 23),
(498, 'Ifelodun', 23),
(499, 'Ilorin', 23),
(500, 'Ilorin South/East', 23),
(501, 'Irepodun', 23),
(502, 'Isin', 23),
(503, 'Moro', 23),
(504, 'Offa', 23),
(505, 'Oke-Ero', 23),
(506, 'Oyun', 23),
(507, 'Pategi', 23),
(508, 'Ajeromi ifelodun', 24),
(509, 'Amuwo odofin', 24),
(510, 'Badagry', 24),
(511, 'Epe', 24),
(512, 'Ibeju', 24),
(513, 'Ikorodu', 24),
(514, 'Abaketa', 24),
(515, 'Ebute Lekki', 24),
(516, 'Ebute Ilosu', 24),
(517, 'Lekki', 24),
(518, 'Kekki', 24),
(519, 'Ojo', 24),
(520, 'Owode', 24),
(521, 'Asipa Beach', 24),
(522, 'Dado', 24),
(523, 'Sito Beach', 24),
(524, 'Tosavi Beach', 24),
(525, 'Yesufu Beach', 24),
(526, 'Yeketome', 24),
(527, 'Yovoyan', 24),
(528, 'Sakpo Beach', 24),
(529, 'Trade fair complex', 24),
(530, 'Ikeja', 24),
(531, 'Akwanga', 25),
(532, 'Awe', 25),
(533, 'Doma', 25),
(534, 'Karu', 25),
(535, 'Keana', 25),
(536, 'Keffi', 25),
(537, 'Kokona', 25),
(538, 'Lafia', 25),
(539, 'Nasarawa', 25),
(540, 'Nasarawa Eggon', 25),
(541, 'Obi', 25),
(542, 'Toto', 25),
(543, 'Wamba', 25),
(544, 'Agaie', 26),
(545, 'Agwara', 26),
(546, 'Bida', 26),
(547, 'Borgu', 26),
(548, 'Bosso', 26),
(549, 'Chanchaga', 26),
(550, 'Gbako', 26),
(551, 'Gurara', 26),
(552, 'Katch', 26),
(553, 'Kontagora', 26),
(554, 'Lapai', 26),
(555, 'Lavun/Edatti', 26),
(556, 'Magama', 26),
(557, 'Mariga', 26),
(558, 'Mashegu', 26),
(559, 'Minna', 26),
(560, 'Mokwa', 26),
(561, 'Muyi', 26),
(562, 'Paikoro', 26),
(563, 'Rafi', 26),
(564, 'Rijau', 26),
(565, 'Shiroro', 26),
(566, 'Suleja', 26),
(567, 'Tapa', 26),
(568, 'Wushishi', 26),
(569, 'Abeokuta', 27),
(570, 'Ado-Odo/Otta', 27),
(571, 'Ewekoro', 27),
(572, 'Ifo', 27),
(573, 'Ijebu East', 27),
(574, 'Ijebu North', 27),
(575, 'Ijebu North East', 27),
(576, 'Ijebu Ode', 27),
(577, 'Ikenne', 27),
(578, 'Imeko - Afon', 27),
(579, 'Obafemi', 27),
(580, 'Odeda', 27),
(581, 'Odogbolu', 27),
(582, 'Ogun Waterside', 27),
(583, 'Remo North', 27),
(584, 'Sagamu', 27),
(585, 'Sango ota', 27),
(586, 'Yewa', 27),
(587, 'Akoko Northwest/Northeast', 28),
(588, 'Akoko South East/ South West', 28),
(589, 'Akure', 28),
(590, 'Ese Odo', 28),
(591, 'Idare', 28),
(592, 'Ifedore', 28),
(593, 'Igba Toro', 28),
(594, 'Ikare Akoko', 28),
(595, 'Ilaje', 28),
(596, 'Ile-Oluji/ Okeigbo', 28),
(597, 'Irele', 28),
(598, 'Odigbo', 28),
(599, 'Okitipupa', 28),
(600, 'Ondo west /East', 28),
(601, 'Ose', 28),
(602, 'Owo', 28),
(603, 'Aiyedade', 29),
(604, 'Aiyedire', 29),
(605, 'Atakunmasa East', 29),
(606, 'Atakunmosa', 29),
(607, 'Boluwaduro', 29),
(608, 'Boripe', 29),
(609, 'Ede North', 29),
(610, 'Ede South', 29),
(611, 'Egbedore', 29),
(612, 'Ejigbo', 29),
(613, 'Ibokun', 29),
(614, 'Ife', 29),
(615, 'Ifedayo', 29),
(616, 'Ifelodun', 29),
(617, 'Ijebu Ijesa', 29),
(618, 'Ila', 29),
(619, 'Ilesa', 29),
(620, 'Ipetumodu', 29),
(621, 'Irepodun', 29),
(622, 'Irewole', 29),
(623, 'Isokan', 29),
(624, 'Iwo', 29),
(625, 'Modakeke', 29),
(626, 'Odo-Otin', 29),
(627, 'Ola Oluwa', 29),
(628, 'Olorunda', 29),
(629, 'Oriade', 29),
(630, 'Orolu', 29),
(631, 'Oshogbo', 29),
(632, 'Afijio', 30),
(633, 'Akinyle', 30),
(634, 'Atiba', 30),
(635, 'Atisbo', 30),
(636, 'Egbeda', 30),
(637, 'Ibadan', 30),
(638, 'Ibarap', 30),
(639, 'Ido', 30),
(640, 'Ifedapo', 30),
(641, 'Ifeloju', 30),
(642, 'Irepo', 30),
(643, 'Iseyin', 30),
(644, 'Itesiwaju', 30),
(645, 'Iwajowa', 30),
(646, 'Iyamapo/ Olorunsogo', 30),
(647, 'Kajola', 30),
(648, 'Lagelu', 30),
(649, 'Ogbomoso', 30),
(650, 'Orelope', 30),
(651, 'Orire', 30),
(652, 'Oyo', 30),
(653, 'Saki East', 30),
(654, 'Surulere', 30),
(655, 'Barkin Ladi', 31),
(656, 'Bassa', 31),
(657, 'Bokkos', 31),
(658, 'Jos', 31),
(659, 'Kanam', 31),
(660, 'Kanke', 31),
(661, 'Langtang ', 31),
(662, 'Mangu', 31),
(663, 'Mikang', 31),
(664, 'Pankshin', 31),
(665, 'Quan-Pan', 31),
(666, 'Riyom', 31),
(667, 'Shendam', 31),
(668, 'Wase', 31),
(669, 'Binji', 33),
(670, 'Bodinga', 33),
(671, 'Dange', 33),
(672, 'Gada', 33),
(673, 'Goronyo', 33),
(674, 'Gudu', 33),
(675, 'Gwadabawa', 33),
(676, 'Illela', 33),
(677, 'Isa', 33),
(678, 'Kebbe', 33),
(679, 'Rabah', 33),
(680, 'Sabon Birni', 33),
(681, 'Rabah', 33),
(682, 'Shagari', 33),
(683, 'Shuni', 33),
(684, 'Silame', 33),
(685, 'Sokoto', 33),
(686, 'Tambawal', 33),
(687, 'Tangaza', 33),
(688, 'Tureta', 33),
(689, 'Wammako', 33),
(690, 'Wurno', 33),
(691, 'Yabo', 33),
(692, 'Jalingo', 34),
(693, 'Ardo Kola', 35),
(694, 'Bali', 35),
(695, 'Damaturu', 35),
(696, 'Donga', 35),
(697, 'Gashaka', 35),
(698, 'Gassol', 35),
(699, 'Ibi', 35),
(700, 'Jalingo', 35),
(701, 'Karim-Lamido', 35),
(702, 'Kurmi', 35),
(703, 'Lau', 35),
(704, 'Nguru', 35),
(705, 'Sardauna', 35),
(706, 'Takum', 35),
(707, 'Ussa', 35),
(708, 'Wukari', 35),
(709, 'Yorro', 35),
(710, 'Zing', 35),
(711, 'Bade', 36),
(712, 'Bursari', 36),
(713, 'Damaturu', 36),
(714, 'Fika', 36),
(715, 'Fune', 36),
(716, 'Geidam', 36),
(717, 'Gujba', 36),
(718, 'Gulani', 36),
(719, 'Gusau', 36),
(720, 'Jakusko', 36),
(721, 'Karasuwa', 36),
(722, 'Kauran Namoda', 36),
(723, 'Machina', 36),
(724, 'Nangere', 36),
(725, 'Nguru', 36),
(726, 'Potiskum', 36),
(727, 'Tarmuwa', 36),
(728, 'Yunusa', 36),
(729, 'Yusufari', 36);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `batch` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `model_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `model_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `model_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `model_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_id`, `model_type`) VALUES
(1, 1, 'App\\User'),
(1, 3, 'App\\User'),
(2, 4, 'App\\User'),
(2, 5, 'App\\User'),
(3, 7, 'App\\User'),
(3, 8, 'App\\User'),
(3, 9, 'App\\User'),
(4, 2, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `neatnesses`
--

CREATE TABLE `neatnesses` (
  `id` int(10) UNSIGNED NOT NULL,
  `aagc_id` int(10) UNSIGNED NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `necos`
--

CREATE TABLE `necos` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `subject_id` int(10) UNSIGNED DEFAULT NULL,
  `session_id` int(10) UNSIGNED DEFAULT NULL,
  `score` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `neco_details`
--

CREATE TABLE `neco_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `examination_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `next_term_begins`
--

CREATE TABLE `next_term_begins` (
  `id` int(10) UNSIGNED NOT NULL,
  `begins` date DEFAULT NULL,
  `session_id` int(10) UNSIGNED DEFAULT NULL,
  `term_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `old_testimonials`
--

CREATE TABLE `old_testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `areas_good_at` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `session_admitted` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `session_graduated` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_held` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abilities` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `conduct` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone1` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone2` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `name`, `address`, `phone1`, `phone2`, `created_at`, `updated_at`) VALUES
(1, 'Peter Serah', '10, Arukwe street', '08038387930', '08038387930', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parent_relationships`
--

CREATE TABLE `parent_relationships` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guard_name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'add student', 'web', '2018-09-03 19:25:33', '2018-09-03 19:59:17'),
(2, 'edit student', 'web', '2018-09-03 19:25:47', '2018-09-03 19:25:47'),
(3, 'delete student', 'web', '2018-09-03 19:25:54', '2018-09-03 19:25:54'),
(4, 'view student', 'web', '2018-09-03 19:26:35', '2018-09-03 19:26:35'),
(5, 'add session', 'web', '2018-09-03 19:48:57', '2018-09-03 19:59:04'),
(6, 'edit session', 'web', '2018-09-03 19:49:05', '2018-09-03 19:49:05'),
(7, 'view session', 'web', '2018-09-03 19:49:18', '2018-09-03 19:49:18'),
(8, 'delete session', 'web', '2018-09-03 19:49:28', '2018-09-03 19:49:28'),
(9, 'activate session', 'web', '2018-09-03 19:51:18', '2018-09-03 19:51:18'),
(10, 'add subject', 'web', '2018-09-03 19:51:44', '2018-09-03 19:58:16'),
(11, 'edit subject', 'web', '2018-09-03 19:52:05', '2018-09-03 19:52:05'),
(12, 'delete subject', 'web', '2018-09-03 19:53:28', '2018-09-03 19:53:28'),
(13, 'view subject', 'web', '2018-09-03 19:53:40', '2018-09-03 19:53:40'),
(14, 'add report', 'web', '2018-09-03 19:57:25', '2018-09-03 19:57:25'),
(15, 'edit report', 'web', '2018-09-03 19:57:34', '2018-09-03 19:57:34'),
(16, 'delete report', 'web', '2018-09-03 19:57:41', '2018-09-03 19:57:41'),
(17, 'view report', 'web', '2018-09-03 19:57:51', '2018-09-03 19:57:51'),
(18, 'print report', 'web', '2018-09-03 20:00:26', '2018-09-03 20:00:26'),
(19, 'view class', 'web', '2018-09-03 20:02:01', '2018-09-03 20:02:01'),
(20, 'add ntb', 'web', '2018-09-03 20:03:16', '2018-09-03 20:03:16'),
(21, 'edit ntb', 'web', '2018-09-03 20:03:25', '2018-09-03 20:03:25'),
(22, 'delete ntb', 'web', '2018-09-03 20:03:34', '2018-09-03 20:03:34'),
(23, 'view ntb', 'web', '2018-09-03 20:03:44', '2018-09-03 20:03:44'),
(24, 'send sms', 'web', '2018-09-06 06:07:40', '2018-09-06 06:07:40'),
(25, 'view sms', 'web', '2018-09-06 06:07:51', '2018-09-06 06:07:51'),
(28, 'online upload', 'web', '2018-09-18 12:05:19', '2018-09-18 12:05:19'),
(27, 'manage user', 'web', '2018-09-18 07:27:37', '2018-09-18 07:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `psychomotors`
--

CREATE TABLE `psychomotors` (
  `id` int(10) UNSIGNED NOT NULL,
  `aagc_id` int(10) UNSIGNED NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `craft_skill` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pet_project` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sport` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `punctuality_classrooms`
--

CREATE TABLE `punctuality_classrooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aagc_id` int(10) UNSIGNED NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `punctuality_resumptions`
--

CREATE TABLE `punctuality_resumptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `aagc_id` int(10) UNSIGNED NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guard_name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'web', '2018-09-17 14:18:24', '2018-09-17 14:18:24'),
(2, 'Secretariat', 'web', '2018-09-17 15:21:07', '2018-09-17 15:22:49'),
(3, 'Computer Unit', 'web', '2018-09-17 15:22:03', '2018-09-17 15:23:37'),
(4, 'Nothing', 'web', '2018-10-11 06:00:00', '2018-10-11 06:46:31');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(6, 1),
(7, 1),
(7, 2),
(7, 3),
(8, 1),
(9, 1),
(10, 1),
(10, 2),
(10, 3),
(11, 1),
(11, 2),
(11, 3),
(12, 1),
(13, 1),
(13, 2),
(13, 3),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(15, 1),
(15, 2),
(15, 3),
(16, 1),
(16, 2),
(16, 3),
(16, 4),
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(18, 1),
(18, 2),
(18, 3),
(18, 4),
(19, 1),
(19, 2),
(19, 3),
(19, 4),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(27, 1),
(28, 1);

-- --------------------------------------------------------

--
-- Table structure for table `senior_mocks`
--

CREATE TABLE `senior_mocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `subject_id` int(10) UNSIGNED DEFAULT NULL,
  `session_id` int(10) UNSIGNED DEFAULT NULL,
  `score` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `senior_mock_details`
--

CREATE TABLE `senior_mock_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '2018/2019', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `session_term`
--

CREATE TABLE `session_term` (
  `id` int(10) UNSIGNED NOT NULL,
  `session_id` int(10) UNSIGNED DEFAULT NULL,
  `term_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `session_term`
--

INSERT INTO `session_term` (`id`, `session_id`, `term_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL),
(2, 1, 2, 0, NULL, NULL),
(3, 1, 3, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sms_pin`
--

CREATE TABLE `sms_pin` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `student_category_id` int(10) UNSIGNED NOT NULL,
  `pin` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_class_id` tinyint(2) NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_pin`
--

INSERT INTO `sms_pin` (`id`, `student_id`, `student_category_id`, `pin`, `group_class_id`, `session_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '816259801', 1, 1, '2018-10-10 09:43:45', NULL),
(2, 2, 1, '748706112', 1, 1, '2018-10-10 09:43:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`) VALUES
(1, 'Abia'),
(2, 'Adamawa'),
(3, 'Akwa Ibom'),
(4, 'Anambra'),
(5, 'Bauchi'),
(6, 'Bayelsa'),
(7, 'Benue'),
(8, 'Borno'),
(9, 'Cross River'),
(10, 'Delta'),
(11, 'Ebonyi '),
(12, 'Edo'),
(13, 'Ekiti'),
(14, 'Enugu'),
(15, 'Gombe '),
(16, 'Imo'),
(17, 'Jigawa'),
(18, 'Kaduna'),
(19, 'Kano'),
(20, 'Katsina'),
(21, 'Kebbi'),
(22, 'Kogi'),
(23, 'Kwara'),
(24, 'Lagos'),
(25, 'Nasarawa'),
(26, 'Niger'),
(27, 'Ogun'),
(28, 'Ondo'),
(29, 'Osun'),
(30, 'Oyo'),
(31, 'Plateau'),
(32, 'Rivers'),
(33, 'Sokoto'),
(34, 'Taraba'),
(35, 'Yobe'),
(36, 'Zamfara'),
(37, 'Federal Capital Territory');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `admission_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `othernames` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `blood_group` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `genotype` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `health_challenges` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emergency_treatment` tinyint(1) DEFAULT NULL,
  `immunization` tinyint(1) DEFAULT NULL,
  `lab_test` tinyint(1) DEFAULT NULL,
  `admitted_session_id` int(10) UNSIGNED DEFAULT NULL,
  `graduated_session_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `state_id` int(10) UNSIGNED DEFAULT NULL,
  `lga_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_relationship` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `club_id` int(10) UNSIGNED DEFAULT NULL,
  `house_id` int(10) UNSIGNED DEFAULT NULL,
  `student_category_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `admission_no`, `surname`, `othernames`, `gender`, `dob`, `blood_group`, `genotype`, `health_challenges`, `emergency_treatment`, `immunization`, `lab_test`, `admitted_session_id`, `graduated_session_id`, `parent_id`, `state_id`, `lga_id`, `parent_relationship`, `club_id`, `house_id`, `student_category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CSMT/SSS/2015/003', 'Peter', 'Moses Hennuho', 'male', '2004-04-04', 'A', 'AA', 'non', 1, 1, 1, 1, NULL, 1, 24, 510, 'Mother', 5, 7, 1, 1, '2018-10-11 04:31:02', '2018-10-11 04:31:02'),
(2, 'CSMT/SSS/2095/004', 'Sanni', 'Deborah', 'female', '1991-03-03', 'A', 'AS', 'non', 1, 1, 1, 1, NULL, 1, 1, 79, NULL, 5, 7, 1, 1, '2018-10-11 04:32:47', '2018-10-11 04:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `student_categories`
--

CREATE TABLE `student_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_categories`
--

INSERT INTO `student_categories` (`id`, `name`) VALUES
(1, 'Boarding'),
(2, 'Day');

-- --------------------------------------------------------

--
-- Table structure for table `student_spies`
--

CREATE TABLE `student_spies` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `aagc_id` int(10) UNSIGNED DEFAULT NULL,
  `current_class` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arm` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_spies`
--

INSERT INTO `student_spies` (`id`, `student_id`, `aagc_id`, `current_class`, `arm`) VALUES
(1, 1, 1, 'JSS 1', 'A(Ruby)'),
(2, 2, 1, 'JSS 1', 'A(Ruby)');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject_school_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `subject_school_id`, `created_at`, `updated_at`) VALUES
(1, 'Health Education', 2, '2018-10-10 07:07:30', '2018-10-10 07:07:30'),
(2, 'Mathematics', 1, '2018-10-10 07:07:43', '2018-10-10 07:07:43'),
(3, 'English', 1, '2018-10-10 07:09:52', '2018-10-10 07:09:52'),
(4, 'Home economics', 2, '2018-10-11 07:50:11', '2018-10-11 07:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `subject_categories`
--

CREATE TABLE `subject_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject_school_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subject_categories`
--

INSERT INTO `subject_categories` (`id`, `name`, `subject_school_id`, `created_at`, `updated_at`) VALUES
(1, 'Science', 2, NULL, NULL),
(2, 'General', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject_schools`
--

CREATE TABLE `subject_schools` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subject_schools`
--

INSERT INTO `subject_schools` (`id`, `name`) VALUES
(1, 'All'),
(2, 'Junior'),
(3, 'Senior');

-- --------------------------------------------------------

--
-- Table structure for table `subject_subject_category`
--

CREATE TABLE `subject_subject_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject_category_id` int(10) UNSIGNED DEFAULT NULL,
  `subject_id` int(10) UNSIGNED DEFAULT NULL,
  `subject_school_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subject_subject_category`
--

INSERT INTO `subject_subject_category` (`id`, `subject_category_id`, `subject_id`, `subject_school_id`) VALUES
(1, 1, 1, 2),
(2, 2, 3, 2),
(3, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `name`) VALUES
(1, 'First term'),
(2, 'Second term'),
(3, 'Third term');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `areas_good_at` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `session_admitted` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `session_graduated` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_held` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abilities` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `conduct` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Moses Peter', 'mohemos@live.com', '$2y$10$txfkF/bzrrT4Vwmjezl9nOeYmVXVkMtgqnr7rYmjzDk7WE8bkMGDa', 'PnC67LGj3ssyzTcSEK55AB6jQVOj3Ked5q0JAcIT8dUKIEE1yIk9bIhlymNe', '2018-07-30 15:19:50', '2018-07-30 15:19:50'),
(2, 'Adetoye Shina', 'shina@gmal.com', '$2y$10$TX1gX.aSnrIgSEmj7kFUpuKE4uWzkhblqFy95uUlLUysJM8lV6t0e', 'sU7Cpg82qGXcKSB2VIOCDL4wpRiRpNF70Adn00ku1UxX51sASEJnUkmH4AbV', '2018-09-03 20:28:22', '2018-09-03 20:28:22'),
(3, 'ADMINISTRATOR', 'csmtschools@gmail.com', '$2y$10$11gDKyv16e.3KZRy4k0Pk.4/0UmPCDQNKwtaZfTh4dMtBQRpFC4fC', NULL, '2018-09-17 15:19:42', '2018-09-17 15:19:42'),
(4, 'Secretariat', 'secretary@csmtschools.com', '$2y$10$cwckRcXnpwSBy7ykk/besOhEtXZ7gblVpOEEUMwn8Gc/siGxej5Di', NULL, '2018-09-18 06:43:21', '2018-09-18 06:43:21'),
(5, 'Bursary', 'bursary@csmtschools.com', '$2y$10$Gd3.U3oH25/fp/.XtF2UU.xI5XLpkKgLFG5DiRL1kb8cz7IpeHUbC', NULL, '2018-09-18 06:45:08', '2018-09-18 06:45:08'),
(7, 'Computer Unit', 'uche_computerunit@csmtschools.com', '$2y$10$8uJIcRCAH0cqJL0QP2NYQ.GbtxulA4PabPsQBrbm3fTHMsiFinxke', NULL, '2018-09-18 06:51:59', '2018-09-18 06:51:59'),
(8, 'Computer Unit', 'chiamaka_computerunit@csmtschools.com', '$2y$10$Kxg7mLEbISMrH2L7QIfHFu6vJn0BwqrYRO5CCGsq5bPZTAUdyWlGm', NULL, '2018-09-18 06:52:44', '2018-09-18 06:52:44'),
(9, 'Computer Unit', 'nkechi_computerunit@csmtschools.com', '$2y$10$YlM8ZzglHZezqY7g8cVi2uswcmF.Qx2ThmEY2Bm6OXOYnRiCxmLn.', NULL, '2018-09-18 06:53:36', '2018-09-18 06:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `waecs`
--

CREATE TABLE `waecs` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `subject_id` int(10) UNSIGNED DEFAULT NULL,
  `session_id` int(10) UNSIGNED DEFAULT NULL,
  `score` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `waec_details`
--

CREATE TABLE `waec_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `examination_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure for view `aagc_view`
--
DROP TABLE IF EXISTS `aagc_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `aagc_view`  AS  select `aagc`.`id` AS `id`,`gc`.`name` AS `class`,concat(`a`.`name`,'(',`al`.`name`,')') AS `arm` from (((`aagc` join `group_classes` `gc` on((`gc`.`id` = `aagc`.`group_class_id`))) join `arms` `a` on((`a`.`id` = `aagc`.`arm_id`))) join `aliases` `al` on((`al`.`id` = `aagc`.`alias_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aagc`
--
ALTER TABLE `aagc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aagc_session`
--
ALTER TABLE `aagc_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aagc_session_student`
--
ALTER TABLE `aagc_session_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aagc_subject`
--
ALTER TABLE `aagc_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aagc_subject_student`
--
ALTER TABLE `aagc_subject_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aliases`
--
ALTER TABLE `aliases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arms`
--
ALTER TABLE `arms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assessment_types`
--
ALTER TABLE `assessment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_hostels`
--
ALTER TABLE `assignment_hostels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_subjects`
--
ALTER TABLE `assignment_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beces`
--
ALTER TABLE `beces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bece_details`
--
ALTER TABLE `bece_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clinics`
--
ALTER TABLE `clinics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cummulative_assessements`
--
ALTER TABLE `cummulative_assessements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exeats`
--
ALTER TABLE `exeats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_classes`
--
ALTER TABLE `group_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `junior_mocks`
--
ALTER TABLE `junior_mocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `junior_mock_details`
--
ALTER TABLE `junior_mock_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lgas`
--
ALTER TABLE `lgas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`);

--
-- Indexes for table `neatnesses`
--
ALTER TABLE `neatnesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `necos`
--
ALTER TABLE `necos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neco_details`
--
ALTER TABLE `neco_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `next_term_begins`
--
ALTER TABLE `next_term_begins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_testimonials`
--
ALTER TABLE `old_testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent_relationships`
--
ALTER TABLE `parent_relationships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `psychomotors`
--
ALTER TABLE `psychomotors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `punctuality_classrooms`
--
ALTER TABLE `punctuality_classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `punctuality_resumptions`
--
ALTER TABLE `punctuality_resumptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`);

--
-- Indexes for table `senior_mocks`
--
ALTER TABLE `senior_mocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `senior_mock_details`
--
ALTER TABLE `senior_mock_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session_term`
--
ALTER TABLE `session_term`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_pin`
--
ALTER TABLE `sms_pin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_categories`
--
ALTER TABLE `student_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_spies`
--
ALTER TABLE `student_spies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_categories`
--
ALTER TABLE `subject_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_schools`
--
ALTER TABLE `subject_schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_subject_category`
--
ALTER TABLE `subject_subject_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waecs`
--
ALTER TABLE `waecs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waec_details`
--
ALTER TABLE `waec_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aagc`
--
ALTER TABLE `aagc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `aagc_session`
--
ALTER TABLE `aagc_session`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `aagc_session_student`
--
ALTER TABLE `aagc_session_student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `aagc_subject`
--
ALTER TABLE `aagc_subject`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `aagc_subject_student`
--
ALTER TABLE `aagc_subject_student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `aliases`
--
ALTER TABLE `aliases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `arms`
--
ALTER TABLE `arms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `assessment_types`
--
ALTER TABLE `assessment_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assignment_hostels`
--
ALTER TABLE `assignment_hostels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assignment_subjects`
--
ALTER TABLE `assignment_subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beces`
--
ALTER TABLE `beces`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bece_details`
--
ALTER TABLE `bece_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clinics`
--
ALTER TABLE `clinics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cummulative_assessements`
--
ALTER TABLE `cummulative_assessements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exeats`
--
ALTER TABLE `exeats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `group_classes`
--
ALTER TABLE `group_classes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `junior_mocks`
--
ALTER TABLE `junior_mocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `junior_mock_details`
--
ALTER TABLE `junior_mock_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lgas`
--
ALTER TABLE `lgas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=730;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `neatnesses`
--
ALTER TABLE `neatnesses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `necos`
--
ALTER TABLE `necos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `neco_details`
--
ALTER TABLE `neco_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `next_term_begins`
--
ALTER TABLE `next_term_begins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `old_testimonials`
--
ALTER TABLE `old_testimonials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `parent_relationships`
--
ALTER TABLE `parent_relationships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `psychomotors`
--
ALTER TABLE `psychomotors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `punctuality_classrooms`
--
ALTER TABLE `punctuality_classrooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `punctuality_resumptions`
--
ALTER TABLE `punctuality_resumptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `senior_mocks`
--
ALTER TABLE `senior_mocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `senior_mock_details`
--
ALTER TABLE `senior_mock_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `session_term`
--
ALTER TABLE `session_term`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sms_pin`
--
ALTER TABLE `sms_pin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student_categories`
--
ALTER TABLE `student_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student_spies`
--
ALTER TABLE `student_spies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `subject_categories`
--
ALTER TABLE `subject_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subject_schools`
--
ALTER TABLE `subject_schools`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subject_subject_category`
--
ALTER TABLE `subject_subject_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `waecs`
--
ALTER TABLE `waecs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `waec_details`
--
ALTER TABLE `waec_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
