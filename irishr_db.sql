-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2026 at 11:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `irishr_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accepted_applicants`
--

CREATE TABLE `accepted_applicants` (
  `applicant_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `cover_letter` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Accepted','Rejected') DEFAULT 'Accepted',
  `applied_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accepted_applicants`
--

INSERT INTO `accepted_applicants` (`applicant_id`, `job_id`, `first_name`, `last_name`, `email`, `phone`, `resume`, `cover_letter`, `status`, `applied_at`) VALUES
(3, 2, 'Karylle Mish', 'Gellica', 'k.gellica.351@company.com', '09458162143', '../ASSETS/UPLOADS/Resumes/67c9b2278b685_Carlin’s Flower Shop Valentine’s Day Pricelist 2024.pdf', '../ASSETS/UPLOADS/CoverLetters/67c9b2279419f_Carlin’s Flower Shop Valentine’s Day Pricelist 2024.pdf', 'Accepted', '2025-03-12 19:38:13'),
(4, 3, 'Karylle Mish', 'Gellica', 'k.gellica.351@company.com', '09458162143', '../ASSETS/UPLOADS/Resumes/67c9b31f8314c_Carlin’s Flower Shop Valentine’s Day Pricelist 2024.pdf', '../ASSETS/UPLOADS/CoverLetters/67c9b31f8bdd7_Carlin’s Flower Shop Valentine’s Day Pricelist 2024.pdf', 'Accepted', '2025-03-12 19:38:12'),
(5, 10, 'Karylle Mish', 'Gellica', 'k.gellica.351@company.com', '09458162143', '../ASSETS/UPLOADS/Resumes/67d15624a92c1_Maximum Heap.pdf', '../ASSETS/UPLOADS/CoverLetters/67d15624b1679_ANOVA.pdf', 'Accepted', '2025-03-12 17:38:44'),
(8, 9, 'Angela', 'Tan', 'a.tan.139@company.com', '09458162143', '../ASSETS/UPLOADS/Resumes/67d178d8d5b9d_Resume.pdf', '../ASSETS/UPLOADS/CoverLetters/67d178d8dd070_Cover Letter.pdf', 'Accepted', '2026-03-10 14:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `applicant_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `cover_letter` text DEFAULT NULL,
  `status` enum('Pending','Rejected','Accepted') NOT NULL,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`applicant_id`, `job_id`, `first_name`, `last_name`, `email`, `phone`, `resume`, `cover_letter`, `status`, `applied_at`) VALUES
(3, 2, 'Karylle Mish', 'Gellica', 'k.gellica.351@company.com', '09458162143', '../ASSETS/UPLOADS/Resumes/67c9b2278b685_Carlin’s Flower Shop Valentine’s Day Pricelist 2024.pdf', '../ASSETS/UPLOADS/CoverLetters/67c9b2279419f_Carlin’s Flower Shop Valentine’s Day Pricelist 2024.pdf', 'Accepted', '2025-03-06 14:33:11'),
(4, 3, 'Karylle Mish', 'Gellica', 'k.gellica.351@company.com', '09458162143', '../ASSETS/UPLOADS/Resumes/67c9b31f8314c_Carlin’s Flower Shop Valentine’s Day Pricelist 2024.pdf', '../ASSETS/UPLOADS/CoverLetters/67c9b31f8bdd7_Carlin’s Flower Shop Valentine’s Day Pricelist 2024.pdf', 'Accepted', '2025-03-06 14:37:19'),
(5, 10, 'Karylle Mish', 'Gellica', 'k.gellica.351@company.com', '09458162143', '../ASSETS/UPLOADS/Resumes/67d15624a92c1_Maximum Heap.pdf', '../ASSETS/UPLOADS/CoverLetters/67d15624b1679_ANOVA.pdf', 'Accepted', '2025-03-12 09:38:44'),
(7, 8, 'Janelle', 'Baltazar', 'j.baltazar.105@company.com', '09171234567', '../ASSETS/UPLOADS/Resumes/67d178a0bb7ba_Resume.pdf', '../ASSETS/UPLOADS/CoverLetters/67d178a0ca97d_Cover Letter.pdf', 'Rejected', '2025-03-12 12:05:52'),
(8, 9, 'Angela', 'Tan', 'a.tan.139@company.com', '09458162143', '../ASSETS/UPLOADS/Resumes/67d178d8d5b9d_Resume.pdf', '../ASSETS/UPLOADS/CoverLetters/67d178d8dd070_Cover Letter.pdf', 'Accepted', '2025-03-12 12:06:48'),
(9, 2, 'Rena', 'Cahil', 'r.cahil.999@company.com', '09123456782', '../ASSETS/UPLOADS/Resumes/67d1a1ad01f55_Resume.pdf', '../ASSETS/UPLOADS/CoverLetters/67d1a1ad0a768_Cover Letter.pdf', 'Rejected', '2025-03-12 15:01:01'),
(10, 11, 'Rena', 'Cahil', 'r.cahil.999@company.com', '09123456782', '../ASSETS/UPLOADS/Resumes/67d1a1c0ae8a4_Resume.pdf', '../ASSETS/UPLOADS/CoverLetters/67d1a1c0c6d94_Cover Letter.pdf', 'Pending', '2025-03-12 15:01:20'),
(11, 3, 'Bai Fatima', 'Andong', 'f.andong.739@company.com', '09123456789', '../ASSETS/UPLOADS/Resumes/67d24a376f0e0_Resume.pdf', '../ASSETS/UPLOADS/CoverLetters/67d24a37764b5_Cover Letter.pdf', 'Pending', '2025-03-13 03:00:07'),
(12, 8, 'Monica', 'Rodriguez', 'm.rodriguez.228@company.com', '09568452157', '../ASSETS/UPLOADS/Resumes/67d2565a605b0_Resume.pdf', '../ASSETS/UPLOADS/CoverLetters/67d2565a756c3_Cover Letter.pdf', 'Rejected', '2025-03-13 03:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `archived_departments`
--

CREATE TABLE `archived_departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archived_departments`
--

INSERT INTO `archived_departments` (`department_id`, `department_name`, `description`, `created_at`, `deleted_at`) VALUES
(12, 'Procurement', 'Acquires goods and services for business needs.', '2025-03-08 06:54:44', '2026-03-11 00:28:58'),
(13, 'Event Management', 'Plans and coordinates corporate events and activities.', '2025-03-08 06:55:18', '2025-03-09 07:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `archived_employees`
--

CREATE TABLE `archived_employees` (
  `archive_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `employment_status` varchar(50) DEFAULT NULL,
  `base_salary` decimal(10,2) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archived_employees`
--

INSERT INTO `archived_employees` (`archive_id`, `employee_id`, `user_id`, `first_name`, `last_name`, `date_of_birth`, `gender`, `contact_number`, `address`, `position_id`, `hire_date`, `employment_status`, `base_salary`, `profile_picture`, `created_at`, `deleted_at`) VALUES
(9, 16, 20, 'Eunice', 'Cortez', '1997-10-13', 'Female', '09458167543', 'Mintal, Davao City', 8, '2025-01-06', 'Active', 65000.00, '1741095832_josh.jpg', '2025-03-09 02:37:46', '2025-03-05 16:41:50'),
(12, 13, 17, 'Mariano', 'De Bartolome', '2005-08-28', 'Male', '09458112345', 'Matina Aplaya, Davao City', 5, '2025-01-06', 'Active', 90000.00, NULL, '2025-03-09 02:37:46', '2025-03-07 13:46:34'),
(17, 10, 14, 'Anthony', 'Tugonon', '1997-09-01', 'Male', '09152745854', 'Matina Crossing, Davao City', 13, '2025-01-06', 'Active', 0.00, NULL, '2025-03-09 02:37:46', '2025-03-08 04:57:25'),
(29, 24, 28, 'Louise', 'Hernandez', '1990-07-12', 'Female', '09458162143', 'Maa, Davao City', 10, '0000-00-00', 'Active', 95000.00, NULL, '2025-03-12 11:17:58', '2026-03-10 23:22:42');

-- --------------------------------------------------------

--
-- Table structure for table `archived_jobpostings`
--

CREATE TABLE `archived_jobpostings` (
  `job_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `vacancies` int(11) NOT NULL,
  `job_summary` text DEFAULT NULL,
  `responsibilities` text DEFAULT NULL,
  `requirements` text DEFAULT NULL,
  `qualifications` text DEFAULT NULL,
  `application_deadline` date NOT NULL,
  `contact` varchar(255) NOT NULL,
  `status` enum('open','closed') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `archived_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archived_jobpostings`
--

INSERT INTO `archived_jobpostings` (`job_id`, `position_id`, `job_title`, `department`, `salary`, `vacancies`, `job_summary`, `responsibilities`, `requirements`, `qualifications`, `application_deadline`, `contact`, `status`, `created_at`, `archived_at`) VALUES
(1, 0, 'Backend Developer', '3', 50000.00, 4, 'We are looking for a skilled Software Engineer to develop, test, and maintain high-quality applications. The ideal candidate should have strong problem-solving skills and experience in software development best practices.', 'Design, develop, and maintain scalable software solutions.\r\nCollaborate with cross-functional teams to define and implement new features.\r\nWrite clean, efficient, and well-documented code.\r\nTroubleshoot, debug, and optimize existing software.\r\nStay up-to-date with the latest industry trends and technologies.', 'Resume/CV\r\nGovernment-issued ID (e.g., passport, driver\'s license)\r\nTranscript of Records/Diploma\r\nRelevant certifications (if any)', 'Bachelor\'s degree in Computer Science, Information Technology, or related field.\r\nAt least 2 years of experience in software development.\r\nProficiency in programming languages such as JavaScript, Python, or Java.\r\nStrong knowledge of databases and version control (Git).\r\nExcellent problem-solving and analytical skills.', '2025-04-15', 'hr@company.com | +63 912 345 6789', 'open', '2025-03-05 08:18:08', '0000-00-00 00:00:00'),
(5, 18, 'Yes', '1', 50000.00, 5, 'r', 'r', 'r', 'r', '2025-03-11', 'hr@company.com | +63 912 345 6789', 'open', '2025-03-06 20:19:52', '2025-03-08 11:21:51'),
(6, 19, '14', '8', 68000.00, 2, 'l', 'l', 'l', 'l', '2025-04-30', 'hr@company.com | +63 912 345 6789', 'open', '2025-03-08 10:58:05', '2025-03-08 11:21:38'),
(7, 22, '3', '2', 68000.00, 3, 'Sample', 'Sample', 'Sample', 'Sample', '2025-03-29', '09495655839', 'open', '2025-03-09 05:05:10', '2025-03-09 06:01:21'),
(12, 4, 'Financial Analyst', '2', 65000.00, 5, 'Sample', 'Sample', 'Sample', 'Sample', '2025-03-23', '09876543217', 'open', '2025-03-09 06:22:53', '2026-03-10 23:37:55'),
(13, 2, 'HR Officer', '1', 68000.00, 6, 'gsdgsdg', 'dsgsdg', 'sdgsdg', 'gsgsdg', '2025-03-26', '09495655839', 'open', '2025-03-09 07:59:45', '2025-03-09 08:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `archived_positions`
--

CREATE TABLE `archived_positions` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `base_salary` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archived_positions`
--

INSERT INTO `archived_positions` (`position_id`, `position_name`, `department_id`, `base_salary`, `description`, `created_at`, `deleted_at`) VALUES
(18, '2', 1, 50000.00, 'r', '2025-03-06 20:19:52', '2025-03-08 03:29:26'),
(19, '14', 8, 68000.00, 'l', '2025-03-08 10:58:05', '2025-03-09 04:33:55');

-- --------------------------------------------------------

--
-- Table structure for table `archived_requests`
--

CREATE TABLE `archived_requests` (
  `leave_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `leave_type` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `admin_message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archived_requests`
--

INSERT INTO `archived_requests` (`leave_id`, `employee_id`, `leave_type`, `message`, `start_date`, `end_date`, `status`, `admin_message`, `created_at`) VALUES
(3, 3, 'Vacation', 'Family trip to the beach.', '2025-04-15', '2025-04-20', 'Pending', NULL, '2025-03-05 17:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `clock_in` time DEFAULT NULL,
  `clock_out` time DEFAULT NULL,
  `status` enum('Present','Absent','Late','On Leave') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `employee_id`, `date`, `clock_in`, `clock_out`, `status`, `created_at`) VALUES
(1, 7, '2025-02-05', '08:00:00', '19:00:00', 'Present', '2025-02-25 13:38:24'),
(2, 7, '2025-03-06', NULL, NULL, 'Absent', '2025-02-25 13:38:24'),
(3, 8, '2025-03-06', '10:45:00', '17:45:00', 'Late', '2025-02-25 13:38:24'),
(4, 8, '2025-03-07', '08:00:00', '20:00:00', 'Present', '2025-02-25 13:38:24'),
(6, 1, '2025-03-07', '08:00:00', '17:00:00', 'Present', '2025-03-06 19:09:32'),
(11, 1, '2025-03-06', '08:05:00', '17:02:00', 'Present', '2025-03-06 19:09:32'),
(16, 1, '2025-03-05', '08:10:00', '16:45:00', 'Present', '2025-03-06 19:09:32'),
(35, 5, '2025-03-10', '21:25:41', '21:26:10', 'Present', '2025-03-10 13:25:41'),
(36, 5, '2025-03-11', '23:43:58', '23:44:28', 'Present', '2025-03-11 15:43:58'),
(37, 15, '2025-03-12', '07:51:00', '17:51:00', 'Present', '2025-03-12 02:29:52'),
(38, 9, '2025-03-12', '10:40:00', '17:40:00', 'Late', '2025-03-12 02:29:52'),
(39, 1, '2025-03-12', NULL, NULL, 'Absent', '2025-03-12 02:29:52'),
(41, 22, '2025-03-12', '08:50:00', '17:45:00', 'Late', '2025-03-12 02:29:52'),
(42, 11, '2025-03-12', '08:00:00', '17:31:16', 'Present', '2025-03-12 02:29:52'),
(44, 12, '2025-03-12', '07:35:00', '11:08:43', 'Present', '2025-03-12 02:29:52'),
(46, 7, '2025-03-12', NULL, NULL, 'Absent', '2025-03-12 02:29:52'),
(47, 19, '2025-03-12', NULL, NULL, 'Absent', '2025-03-12 02:29:52'),
(48, 20, '2025-03-12', '08:37:00', '18:37:00', 'Late', '2025-03-12 02:29:52'),
(49, 5, '2025-03-12', '08:14:00', '12:14:13', 'Late', '2025-03-12 02:29:52'),
(50, 21, '2025-03-12', '12:05:00', '18:05:00', 'Late', '2025-03-12 02:29:52'),
(51, 14, '2025-03-12', '11:35:00', '11:16:43', 'Late', '2025-03-12 02:29:52'),
(52, 18, '2025-03-12', '12:13:00', '18:13:00', 'Late', '2025-03-12 02:29:52'),
(53, 8, '2025-03-12', NULL, NULL, 'Absent', '2025-03-12 02:29:52'),
(54, 23, '2025-03-12', NULL, NULL, 'Absent', '2025-03-12 04:02:33'),
(56, 15, '2025-03-13', NULL, NULL, 'Absent', '2025-03-13 02:53:26'),
(57, 9, '2025-03-13', NULL, '11:26:50', 'Absent', '2025-03-13 02:53:26'),
(58, 1, '2025-03-13', NULL, NULL, 'Absent', '2025-03-13 02:53:26'),
(60, 22, '2025-03-13', NULL, NULL, 'Absent', '2025-03-13 02:53:26'),
(61, 23, '2025-03-13', '11:51:13', NULL, 'Late', '2025-03-13 02:53:27'),
(62, 11, '2025-03-13', '11:44:29', '11:46:00', 'Late', '2025-03-13 02:53:27'),
(64, 12, '2025-03-13', NULL, '11:27:47', 'Absent', '2025-03-13 02:53:27'),
(67, 7, '2025-03-13', NULL, NULL, 'Absent', '2025-03-13 02:53:27'),
(68, 19, '2025-03-13', NULL, NULL, 'Absent', '2025-03-13 02:53:27'),
(69, 20, '2025-03-13', NULL, NULL, 'Absent', '2025-03-13 02:53:27'),
(70, 5, '2025-03-13', '14:06:20', NULL, 'Late', '2025-03-13 02:53:27'),
(71, 21, '2025-03-13', NULL, NULL, 'Absent', '2025-03-13 02:53:27'),
(72, 14, '2025-03-13', NULL, '11:29:53', 'Absent', '2025-03-13 02:53:27'),
(73, 18, '2025-03-13', NULL, '11:26:07', 'Absent', '2025-03-13 02:53:27'),
(74, 8, '2025-03-13', NULL, '11:35:49', 'Absent', '2025-03-13 02:53:27'),
(75, 15, '2026-03-10', NULL, NULL, 'Absent', '2026-03-09 21:10:35'),
(76, 9, '2026-03-10', NULL, NULL, 'Absent', '2026-03-09 21:10:35'),
(77, 1, '2026-03-10', NULL, NULL, 'Absent', '2026-03-09 21:10:35'),
(79, 22, '2026-03-10', NULL, NULL, 'Absent', '2026-03-09 21:10:35'),
(80, 23, '2026-03-10', NULL, NULL, 'Absent', '2026-03-09 21:10:35'),
(81, 11, '2026-03-10', NULL, NULL, 'Absent', '2026-03-09 21:10:36'),
(83, 12, '2026-03-10', NULL, NULL, 'Absent', '2026-03-09 21:10:36'),
(85, 7, '2026-03-10', NULL, NULL, 'Absent', '2026-03-09 21:10:36'),
(86, 19, '2026-03-10', NULL, NULL, 'Absent', '2026-03-09 21:10:36'),
(87, 20, '2026-03-10', NULL, NULL, 'Absent', '2026-03-09 21:10:36'),
(88, 5, '2026-03-10', NULL, NULL, 'Absent', '2026-03-09 21:10:36'),
(89, 21, '2026-03-10', NULL, NULL, 'Absent', '2026-03-09 21:10:36'),
(90, 14, '2026-03-10', NULL, NULL, 'Absent', '2026-03-09 21:10:36'),
(91, 18, '2026-03-10', NULL, NULL, 'Absent', '2026-03-09 21:10:36'),
(92, 6, '2026-03-10', NULL, NULL, 'Absent', '2026-03-09 21:10:36'),
(93, 8, '2026-03-10', NULL, NULL, 'Absent', '2026-03-09 21:10:36'),
(94, 17, '2026-03-10', NULL, NULL, 'Absent', '2026-03-10 03:57:17'),
(97, 1, '2026-03-11', NULL, NULL, 'Late', '2026-03-10 19:30:03'),
(101, 5, '2026-03-11', NULL, NULL, 'Late', '2026-03-10 19:30:03'),
(102, 6, '2026-03-11', NULL, NULL, 'Late', '2026-03-10 19:30:03'),
(103, 7, '2026-03-11', NULL, NULL, 'Late', '2026-03-10 19:30:03'),
(104, 8, '2026-03-11', NULL, NULL, 'Late', '2026-03-10 19:30:03'),
(105, 9, '2026-03-11', NULL, NULL, 'Late', '2026-03-10 19:30:03'),
(106, 11, '2026-03-11', NULL, NULL, 'Late', '2026-03-10 19:30:03'),
(107, 12, '2026-03-11', NULL, NULL, 'Late', '2026-03-10 19:30:03'),
(108, 14, '2026-03-11', NULL, NULL, 'Late', '2026-03-10 19:30:03'),
(109, 15, '2026-03-11', NULL, NULL, 'Late', '2026-03-10 19:30:03'),
(110, 17, '2026-03-11', NULL, NULL, 'Late', '2026-03-10 19:30:03'),
(111, 18, '2026-03-11', NULL, NULL, 'Late', '2026-03-10 19:30:03'),
(112, 19, '2026-03-11', NULL, NULL, 'Late', '2026-03-10 19:30:03'),
(113, 20, '2026-03-11', NULL, NULL, 'Late', '2026-03-10 19:30:03'),
(114, 21, '2026-03-11', NULL, NULL, 'Late', '2026-03-10 19:30:03'),
(115, 22, '2026-03-11', NULL, NULL, 'Late', '2026-03-10 19:30:03'),
(116, 23, '2026-03-11', NULL, NULL, 'Late', '2026-03-10 19:30:03'),
(117, 2, '2026-03-11', NULL, NULL, 'Late', '2026-03-11 00:44:56'),
(119, 4, '2026-03-11', NULL, NULL, 'Late', '2026-03-11 00:44:56');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `ip_address`, `timestamp`) VALUES
(1, 1, 'AUTO_ATTENDANCE', 'Auto-attendance run for 2026-03-10 at 14:06:52. Inserted: 0 new records, Updated: 0 records.', '::1', '2026-03-10 14:06:52'),
(2, 1, 'EDIT_EMPLOYEE', 'Updated employee ID: 2\nOld: Name: Christian James Cahilig, Position ID: 6, Phone: 09495655839\nNew: Name: Christian Cahilig, Position ID: 6, Phone: 09495655839', '::1', '2026-03-10 14:08:08'),
(3, 1, 'ARCHIVE_EMPLOYEE', 'Archived employee: Christian Cahilig (ID: 2, Archive ID: 27)', '::1', '2026-03-10 14:08:15'),
(4, 1, 'RESTORE_EMPLOYEE', 'Restored archived employee: Christian Cahilig (ID: 2, Archive ID: 27)', '::1', '2026-03-10 14:08:19'),
(5, 1, 'EDIT_JOB', 'Updated job posting: Backend Developer (ID: 1) - New Title: Backend Developer, Status: Open, Vacancies: 4', '::1', '2026-03-10 14:08:50'),
(6, 1, 'ACCEPT_APPLICANT', 'Accepted applicant: Angela Tan (ID: 8) for Job ID: 9', '::1', '2026-03-10 14:09:08'),
(7, 1, 'EDIT_DEPARTMENT', 'Updated department ID: 1\nOld: Human Resources (HR) - Manages employee relations and hiring.\nNew: Human Resources (HR) - Manages employee relations and hiring', '::1', '2026-03-10 14:09:17'),
(8, 1, 'UPDATE_POSITION', 'Updated position ID: 1\nOld: HR Manager - Oversees HR policies and employee relations.\nNew: HR Manager - Oversees HR policies and employee relations', '::1', '2026-03-10 14:09:21'),
(9, 1, 'REJECT_APPLICANT', 'Rejected applicant: Rena Cahil (ID: 9) for Job ID: 2. Rejected record ID: 0', '::1', '2026-03-10 14:11:33'),
(10, 1, 'GENERATE_PAYROLL', 'Generated payroll for period 2026-03-01 to 2026-03-15. Processed: 20 employees, Inserted: 20, Updated: 0', '::1', '2026-03-10 14:12:54'),
(11, 1, 'UPDATE_PAYROLL_STATUS', 'Updated payroll status for admin admin (Payroll ID: 1) from Pending to Paid', '::1', '2026-03-10 14:13:27'),
(12, 1, 'AUTO_ATTENDANCE', 'Auto-attendance run for 2026-03-10 at 14:41:29. Inserted: 1 new records, Updated: 0 records.', '::1', '2026-03-10 14:41:29'),
(13, 1, 'EDIT_EMPLOYEE', 'Updated employee ID: 6\nOld: Name: Jan Loren Odiong, Position ID: 15, Phone: 09563412781\nNew: Name: Jan Loren Odiong, Position ID: 15, Phone: 09563412781', '::1', '2026-03-10 14:54:17'),
(14, 2, 'ADD_LEAVE_REQUEST', 'Employee ID: 2 submitted Sick leave request (ID: 23) from 2026-03-12 to 2026-03-16', '::1', '2026-03-10 16:07:57'),
(15, 2, 'RESTORE_ARCHIVED_REQUEST', 'Restored archived leave request for Christian Cahilig (Employee ID: 2) - Leave ID: 15, Type: Unpaid, Status: Pending', '::1', '2026-03-10 16:12:32'),
(16, 2, 'CLOCK_IN', 'Christian Cahilig clocked in at 16:12:54 (Late/Corrected)', '::1', '2026-03-10 16:12:54'),
(17, 2, 'CLOCK_OUT', 'Christian Cahilig clocked out at 16:13:00', '::1', '2026-03-10 16:13:00'),
(18, 2, 'UPDATE_LEAVE_REQUEST', 'Updated leave request ID: 23\nOld: Type: Sick, Dates: 2026-03-12 to 2026-03-16\nNew: Type: Sick, Dates: 2026-03-12 to 2026-03-16', '::1', '2026-03-10 16:33:12'),
(19, 1, 'UPDATE_LEAVE_REQUEST', 'Updated leave request for Karylle Mish Gellica (ID: 21) - Status changed from Approved to Approved. Admin message: go bruhh', '::1', '2026-03-10 16:35:20'),
(20, 1, 'AUTO_ATTENDANCE', 'Auto-attendance run for 2026-03-10 at 16:37:29. Inserted: 0 new records, Updated: 1 records.', '::1', '2026-03-10 16:37:29'),
(60, 1, 'ARCHIVE_EMPLOYEE', 'Archived employee: Bai Fatima Andong (ID: 3, Archive ID: 28)', '::1', '2026-03-11 07:02:36'),
(61, 1, 'RESTORE_EMPLOYEE', 'Restored archived employee: Bai Fatima Andong (ID: 3, Archive ID: 28)', '::1', '2026-03-11 07:02:40'),
(62, 1, 'RESTORE_EMPLOYEE', 'Restored archived employee: Louise Hernandez (ID: 24, Archive ID: 25)', '::1', '2026-03-11 07:21:29'),
(63, 1, 'ARCHIVE_EMPLOYEE', 'Archived employee: Louise Hernandez (ID: 24, Archive ID: 29)', '::1', '2026-03-11 07:22:42'),
(64, 1, 'ARCHIVE_JOB', 'Archived job posting: Financial Analyst (ID: 12, Archive ID: 0)', '::1', '2026-03-11 07:37:55'),
(65, 1, 'ARCHIVE_EMPLOYEE', 'Archived employee: John Llorie Sarmiento (ID: 4, Archive ID: 30)', '::1', '2026-03-11 08:03:32'),
(66, 1, 'RESTORE_EMPLOYEE', 'Restored archived employee: John Llorie Sarmiento (ID: 4, Archive ID: 30)', '::1', '2026-03-11 08:03:43'),
(67, 1, 'PASSWORD_VERIFY', 'Password verified for employee ID 2', '::1', '2026-03-11 08:09:27'),
(68, 1, 'EDIT_EMPLOYEE', 'Updated employee ID: 2\nOld: Name: Christian Cahilig, Position ID: 6, Phone: 09495655838\nNew: Name: Christian James Cahilig, Position ID: 6, Phone: 09495655838', '::1', '2026-03-11 08:09:52'),
(69, 1, 'ARCHIVE_EMPLOYEE', 'Archived employee: Christian James Cahilig (ID: 2, Archive ID: 31)', '::1', '2026-03-11 08:10:14'),
(70, 1, 'RESTORE_EMPLOYEE', 'Restored archived employee: Christian James Cahilig (ID: 2, Archive ID: 31)', '::1', '2026-03-11 08:10:25'),
(71, 1, 'PASSWORD_VERIFY', 'Password verified for job ID 1', '::1', '2026-03-11 08:10:41'),
(72, 1, 'ARCHIVE_JOB', 'Archived job posting: Backend Developer (ID: 1, Archive ID: 0)', '::1', '2026-03-11 08:10:53'),
(73, 1, 'PASSWORD_VERIFY', 'Password verified for department ID 1', '::1', '2026-03-11 08:28:44'),
(74, 1, 'ARCHIVE_DEPARTMENT', 'Archived department: Procurement (ID: 12, Archive ID: 0)', '::1', '2026-03-11 08:28:58'),
(75, 1, 'PASSWORD_VERIFY', 'Password verified for position ID 1', '::1', '2026-03-11 08:44:32'),
(76, 1, 'AUTO_ATTENDANCE', 'Auto-attendance run for 2026-03-11 at 08:44:56. Inserted: 3 new records, Updated: 0 records.', '::1', '2026-03-11 08:44:56'),
(77, 1, 'AUTO_ATTENDANCE', 'Auto-attendance run for 2026-03-11 at 08:45:11. Inserted: 0 new records, Updated: 0 records.', '::1', '2026-03-11 08:45:11'),
(78, 1, 'AUTO_ATTENDANCE', 'Auto-attendance run for 2026-03-11 at 08:46:24. Inserted: 0 new records, Updated: 0 records.', '::1', '2026-03-11 08:46:24'),
(79, 1, 'AUTO_ATTENDANCE', 'Auto-attendance run for 2026-03-11 at 08:46:37. Inserted: 0 new records, Updated: 0 records.', '::1', '2026-03-11 08:46:37'),
(80, 1, 'PASSWORD_VERIFY', 'Password verified for leave ID 21', '::1', '2026-03-11 09:02:51'),
(81, 1, 'PASSWORD_VERIFY', 'Password verified for employee ID 2', '::1', '2026-03-11 09:03:23'),
(82, 1, 'PASSWORD_VERIFY', 'Password verified for employee ID 1', '::1', '2026-03-11 09:03:31'),
(83, 1, 'PASSWORD_VERIFY', 'Password verified for job ID 2', '::1', '2026-03-11 09:03:38'),
(84, 1, 'PASSWORD_VERIFY', 'Password verified for department ID 1', '::1', '2026-03-11 09:03:50'),
(85, 1, 'PASSWORD_VERIFY', 'Password verified for position ID 1', '::1', '2026-03-11 09:03:59'),
(86, 1, 'PASSWORD_VERIFY', 'Password verified for employee ID 1', '::1', '2026-03-11 09:05:50'),
(87, 1, 'ARCHIVE_EMPLOYEE', 'Archived employee: Bai Fatima Andong (ID: 3, Archive ID: 32)', '::1', '2026-03-11 09:07:27'),
(88, 1, 'RESTORE_EMPLOYEE', 'Restored archived employee: Bai Fatima Andong (ID: 3, Archive ID: 32)', '::1', '2026-03-11 09:07:36'),
(89, 1, 'PASSWORD_VERIFY', 'Password verified for employee ID 1', '::1', '2026-03-11 09:09:36'),
(90, 1, 'PASSWORD_VERIFY', 'Password verified for employee ID 1', '::1', '2026-03-11 09:10:53'),
(91, 1, 'PASSWORD_VERIFY', 'Password verified for employee ID 1', '::1', '2026-03-11 09:20:42'),
(92, 1, 'PASSWORD_VERIFY', 'Password verified for payroll ID 1', '::1', '2026-03-11 09:34:57'),
(93, 1, 'PASSWORD_VERIFY', 'Password verified for payroll ID 1', '::1', '2026-03-11 09:36:50'),
(94, 1, 'PASSWORD_VERIFY', 'Password verified for payroll ID 1', '::1', '2026-03-11 09:39:44'),
(95, 1, 'PASSWORD_VERIFY', 'Password verified for employee ID 1', '::1', '2026-03-11 09:40:05'),
(96, 1, 'PASSWORD_VERIFY', 'Password verified for payroll ID 1', '::1', '2026-03-11 09:41:13'),
(97, 1, 'PASSWORD_VERIFY', 'Password verified for employee ID 2', '::1', '2026-03-11 09:42:28'),
(98, 1, 'PASSWORD_VERIFY', 'Password verified for payroll ID 1', '::1', '2026-03-11 09:42:37'),
(99, 1, 'GENERATE_PAYROLL', 'Generated payroll for period 2026-03-01 to 2026-03-15. Processed: 20 employees, Inserted: 3, Updated: 17', '::1', '2026-03-11 09:57:43'),
(100, 1, 'UPDATE_PROFILE', 'Updated profile from: admin admin, 09234567890, Ecoland, Davao City to: admin admin, 09234567890, Ecoland, Davao City', '::1', '2026-03-11 09:59:29'),
(101, 1, 'PASSWORD_VERIFY', 'Password verified for profile_update ID 0', '::1', '2026-03-11 10:14:08'),
(102, 1, 'PASSWORD_VERIFY', 'Password verified for profile_update ID 0', '::1', '2026-03-11 10:20:16'),
(103, 1, 'PASSWORD_VERIFY', 'Password verified for profile_update ID 0', '::1', '2026-03-11 10:23:12'),
(104, 1, 'PASSWORD_VERIFY', 'Password verified for profile_update ID 0', '::1', '2026-03-11 10:26:03'),
(105, 1, 'UPDATE_PROFILE', 'Updated profile from: admin admin, 09234567890, Ecoland, Davao City to: admin admin, 09234567890, Ecoland, Davao City', '::1', '2026-03-11 10:26:03'),
(106, 2, 'UPDATE_PROFILE', 'Updated profile: phone from \'09495655838\' to \'09495655838\', address from \'Pampanga, Davao City\' to \'Pampanga, Davao City\'', '::1', '2026-03-11 10:49:46'),
(107, 2, 'PASSWORD_VERIFY_FAILED', 'Failed password verification for profile update', '::1', '2026-03-11 10:52:00'),
(108, 2, 'PASSWORD_VERIFY_SUCCESS', 'Password verified for profile update', '::1', '2026-03-11 10:52:07'),
(109, 2, 'UPDATE_PROFILE', 'Updated profile: phone from \'09495655838\' to \'09495655838\', address from \'Pampanga, Davao City\' to \'Pampanga, Davao City\'', '::1', '2026-03-11 10:52:07'),
(110, 1, 'PASSWORD_VERIFY', 'Password verified for profile_update ID 0', '::1', '2026-03-11 11:12:43'),
(111, 1, 'UPDATE_PROFILE', 'Updated profile from: admin admin, 09234567890, Ecoland, Davao City to: admin admin, 09234567890, Ecoland, Davao City', '::1', '2026-03-11 11:12:43'),
(112, 1, 'PASSWORD_VERIFY', 'Password verified for password_change ID 0', '::1', '2026-03-11 11:12:52'),
(113, 1, 'PASSWORD_UPDATE_FAILED', 'Failed password update attempt - incorrect current password', '::1', '2026-03-11 11:12:52'),
(114, 1, 'PASSWORD_VERIFY', 'Password verified for password_change ID 0', '::1', '2026-03-11 11:13:51'),
(115, 1, 'PASSWORD_UPDATE_FAILED', 'Failed password update attempt - incorrect current password', '::1', '2026-03-11 11:13:51'),
(116, 1, 'PASSWORD_VERIFY', 'Password verified for employee ID 2', '::1', '2026-03-11 11:14:04'),
(117, 1, 'PASSWORD_VERIFY_SUCCESS', 'Password verified for profile_update ID 0', '::1', '2026-03-11 11:21:34'),
(118, 1, 'UPDATE_PROFILE', 'Updated profile from: admin admin, 09234567890, Ecoland, Davao City to: admin admin, 09234567890, Ecoland, Davao City', '::1', '2026-03-11 11:21:34'),
(119, 1, 'PASSWORD_VERIFY_SUCCESS', 'Password verified for password_change ID 0', '::1', '2026-03-11 11:21:42'),
(120, 1, 'PASSWORD_UPDATE_FAILED', 'Failed password update attempt - incorrect current password', '::1', '2026-03-11 11:21:42'),
(121, 1, 'PASSWORD_VERIFY_SUCCESS', 'Password verified for job ID 2', '::1', '2026-03-11 11:23:16'),
(122, 1, 'PASSWORD_VERIFY_SUCCESS', 'Verified for employee', '::1', '2026-03-11 11:27:23'),
(123, 1, 'PASSWORD_VERIFY_SUCCESS', 'Verified for job', '::1', '2026-03-11 11:27:29'),
(124, 1, 'PASSWORD_VERIFY_SUCCESS', 'Verified for payroll', '::1', '2026-03-11 11:27:35'),
(125, 1, 'PASSWORD_VERIFY_SUCCESS', 'Verified for profile_update', '::1', '2026-03-11 11:27:51'),
(126, 1, 'UPDATE_PROFILE', 'Updated profile from: admin admin, 09234567890, Ecoland, Davao City to: admin admin, 09234567890, Ecoland, Davao City', '::1', '2026-03-11 11:27:51'),
(127, 1, 'PASSWORD_VERIFY_SUCCESS', 'Verified for password_change', '::1', '2026-03-11 11:27:58'),
(128, 1, 'PASSWORD_UPDATE_FAILED', 'Failed password update attempt - incorrect current password', '::1', '2026-03-11 11:27:58'),
(129, 1, 'PASSWORD_VERIFY_SUCCESS', 'Verified for password_change', '::1', '2026-03-11 11:28:30'),
(130, 1, 'PASSWORD_UPDATE_FAILED', 'Failed password update attempt - incorrect current password', '::1', '2026-03-11 11:28:30'),
(131, 1, 'PASSWORD_VERIFY_SUCCESS', 'Verified for profile_update', '::1', '2026-03-11 11:28:37'),
(132, 1, 'UPDATE_PROFILE', 'Updated profile from: admin admin, 09234567890, Ecoland, Davao City to: admin admin, 09234567890, Ecoland, Davao City', '::1', '2026-03-11 11:28:37'),
(133, 1, 'PASSWORD_VERIFY_SUCCESS', 'Verified for password_change', '::1', '2026-03-11 11:29:40'),
(134, 1, 'PASSWORD_UPDATE_FAILED', 'Failed password update attempt - incorrect current password', '::1', '2026-03-11 11:29:40'),
(135, 1, 'PASSWORD_VERIFY_SUCCESS', 'Verified for profile_update', '::1', '2026-03-11 11:35:07'),
(136, 1, 'UPDATE_PROFILE', 'Updated profile from: admin admin, 09234567890, Ecoland, Davao City to: admin admin, 09234567890, Ecoland, Davao City', '::1', '2026-03-11 11:35:08'),
(137, 1, 'PASSWORD_VERIFY_SUCCESS', 'Verified for password_change', '::1', '2026-03-11 11:35:40'),
(138, 1, 'PASSWORD_UPDATE_FAILED', 'Failed password update attempt - incorrect current password', '::1', '2026-03-11 11:35:40'),
(139, 1, 'PASSWORD_VERIFY_SUCCESS', 'Verified for password_change', '::1', '2026-03-11 11:36:04'),
(140, 1, 'PASSWORD_UPDATED', 'Password changed successfully', '::1', '2026-03-11 11:36:05'),
(141, 1, 'PASSWORD_VERIFY_FAILED', 'Failed for employee', '::1', '2026-03-11 11:39:24'),
(142, 1, 'PASSWORD_VERIFY_FAILED', 'Failed for profile_update', '::1', '2026-03-11 11:40:58'),
(143, 1, 'PASSWORD_VERIFY_FAILED', 'Failed for password_change', '::1', '2026-03-11 11:44:03'),
(144, 1, 'PASSWORD_VERIFY_FAILED', 'Failed for password_change', '::1', '2026-03-11 11:44:31'),
(145, 1, 'PASSWORD_VERIFY_SUCCESS', 'Verified for password_change', '::1', '2026-03-11 11:44:36'),
(146, 1, 'PASSWORD_UPDATE_FAILED', 'Failed password update attempt - incorrect current password', '::1', '2026-03-11 11:44:36'),
(147, 1, 'PASSWORD_VERIFY_SUCCESS', 'Verified for employee', '::1', '2026-03-11 11:44:55'),
(148, 1, 'PASSWORD_VERIFY_SUCCESS', 'Verified for password_change', '::1', '2026-03-11 11:45:14'),
(149, 1, 'PASSWORD_UPDATED', 'Password changed successfully', '::1', '2026-03-11 11:45:15'),
(150, 1, 'PASSWORD_VERIFY_SUCCESS', 'Verified for employee', '::1', '2026-06-06 16:57:46'),
(151, 1, 'PASSWORD_VERIFY_SUCCESS', 'Verified for add_employee', '::1', '2026-06-06 16:57:55');

-- --------------------------------------------------------

--
-- Table structure for table `auto_attendance_log`
--

CREATE TABLE `auto_attendance_log` (
  `id` int(11) NOT NULL,
  `run_date` date DEFAULT NULL,
  `run_count` int(11) DEFAULT 1,
  `last_run` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bonuses`
--

CREATE TABLE `bonuses` (
  `bonus_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `bonus_type` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `deduction_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `deduction_type` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `description`, `created_at`) VALUES
(1, 'Human Resources (HR)', 'Manages employee relations and hiring', '2025-02-19 15:43:41'),
(2, 'Finance', 'Handles company finances and payroll', '2025-02-19 15:43:41'),
(3, 'IT (Information Tech)', 'Maintains company technology and systems', '2025-02-19 15:43:41'),
(4, 'Sales & Marketing', 'Focuses on selling products/services.', '2025-02-19 15:43:41'),
(5, 'Operations', 'Oversees daily business operations', '2025-02-19 15:43:41'),
(6, 'Customer Service', 'Handles customer support and inquiries', '2025-02-19 15:43:41'),
(7, 'Research & Development', 'Innovates and develops new products', '2025-02-19 15:43:41'),
(8, 'Legal', 'Manages company legal matters', '2025-02-19 15:43:41'),
(9, 'Marketing', 'Develops advertising and branding initiatives to attract customers.', '2025-03-05 16:52:00'),
(14, 'Security', 'Protects company assets, employees, and data.', '2025-03-08 06:55:33'),
(15, 'Customer Experience', 'Focuses on improving customer interactions.', '2025-03-08 06:55:46'),
(16, 'Investor Relations', 'Communicates with shareholders and stakeholders.', '2025-03-08 06:56:00'),
(17, 'Engineering', 'Designs and maintains systems, infrastructure, and processes.', '2025-03-08 06:56:15'),
(18, 'Facilities Management', 'Maintains buildings, utilities, and security.', '2025-03-08 06:56:32'),
(19, 'Public Relations', 'Manages company image and media relations.', '2025-03-08 06:57:01'),
(20, 'Training & Development', 'Enhances employee skills and knowledge.', '2025-03-08 06:58:05'),
(21, 'Sample', 'Sample', '2025-03-09 04:38:21'),
(22, 'Sample Department', 'Sample', '2025-03-09 04:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `position_id` int(11) NOT NULL,
  `hire_date` date NOT NULL,
  `employment_status` enum('Active','Resigned','Terminated') NOT NULL DEFAULT 'Active',
  `base_salary` decimal(10,2) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `user_id`, `first_name`, `last_name`, `date_of_birth`, `gender`, `contact_number`, `address`, `position_id`, `hire_date`, `employment_status`, `base_salary`, `profile_picture`, `created_at`, `is_deleted`) VALUES
(1, 1, 'admin', 'admin', '2002-01-18', 'Male', '09234567890', 'Ecoland, Davao City', 5, '2025-01-06', 'Active', 90000.00, NULL, '2025-02-20 22:24:18', 0),
(2, 2, 'Christian James', 'Cahilig', '2002-01-18', 'Male', '09495655838', 'Pampanga, Davao City', 6, '0000-00-00', 'Active', 75000.00, NULL, '2025-02-20 22:43:23', 0),
(3, 3, 'Bai Fatima', 'Andong', '2005-05-05', 'Female', '09123456789', 'Buhangin, Davao City', 10, '0000-00-00', 'Active', 95000.00, NULL, '2025-02-22 01:26:15', 0),
(4, 6, 'John Llorie', 'Sarmiento', '2004-07-12', 'Male', '09876543212', 'Davao City', 11, '0000-00-00', 'Active', 45000.00, NULL, '2025-02-22 01:34:03', 0),
(5, 9, 'Karylle Mish', 'Gellica', '2005-08-28', 'Female', '09458162143', 'Maa, Davao City', 13, '2025-01-06', 'Active', 72000.00, '1741090743_yoomngi.jpg', '2025-02-22 01:53:25', 0),
(6, 10, 'Jan Loren', 'Odiong', '2005-09-06', 'Female', '09563412781', 'Davao City', 15, '2025-07-22', 'Active', 88000.00, '1773125657_643758036_1275322964806566_7071340121008813615_n.jpg', '2025-03-09 02:37:46', 0),
(7, 11, 'Joanne Faith', 'Cabarde', '2004-10-11', 'Female', '09874321652', 'Matina, Davao City', 12, '2025-01-06', 'Active', 70000.00, NULL, '2025-02-22 02:11:00', 0),
(8, 12, 'Fionna Keiz', 'Coyoca', '2005-03-10', 'Female', '09871234656', 'Maa, Davao City', 15, '2025-01-06', 'Active', 75000.00, NULL, '2025-02-22 02:39:50', 0),
(9, 13, 'Janelle', 'Baltazar', '1995-07-12', 'Female', '09171234567', 'Matina Aplaya, Davao City', 4, '2025-01-06', 'Active', 70000.00, NULL, '2025-02-26 12:45:51', 0),
(11, 15, 'Ivan', 'Magtibay', '1993-03-09', 'Male', '09152767854', 'J.P. Laurel Ave, Davao City', 9, '2025-01-06', 'Active', 68000.00, NULL, '2025-02-27 12:26:30', 0),
(12, 16, 'Josh', 'Villegas', '1994-09-12', 'Male', '09456381285', 'Mintal, Davao City', 10, '2025-01-06', 'Active', 95000.00, '1740821503_josh.jpg', '2025-02-27 12:41:47', 0),
(14, 18, 'Angela', 'Tan', '2000-08-28', 'Female', '09458162143', 'Maa, Davao City', 14, '2025-01-06', 'Active', 85000.00, '1740821392_crong.jpg', '2025-02-27 13:12:38', 0),
(15, 19, 'Althea', 'Abapo', '2000-07-22', 'Female', '09487562143', 'Quimpo Blvd., Davao City', 1, '2025-01-06', 'Active', 80000.00, '1741095812_Woman.jpg', '2025-03-01 07:29:31', 0),
(17, 21, 'Eunice', 'Cortez', '2000-08-28', 'Female', '09458162147', 'Maa, Davao City', 9, '0000-00-00', 'Active', 0.00, NULL, '2025-03-09 02:37:46', 0),
(18, 22, 'Margaret', 'Qualley', '1998-12-18', 'Female', '09171234567', 'J.P. Laurel Ave, Davao City', 14, '2025-01-06', 'Active', 85000.00, '1740821354_loopy.jpg', '2025-03-01 09:21:42', 0),
(19, 23, 'Dave', 'Clarete', '1999-02-17', 'Male', '09152767854', 'Quimpo Blvd., Davao City', 12, '0000-00-00', 'Active', 70000.00, '1740821160_penguin.jpg', '2025-03-01 09:26:00', 0),
(20, 24, 'Rena', 'Cahil', '2003-11-27', 'Female', '09123456782', '8 Nangka Street, D.A. Homes Subdivision, Pampanga', 12, '2025-02-03', 'Active', 70000.00, NULL, '2025-03-09 04:37:38', 0),
(21, 25, 'Hank', 'Green', '1995-06-28', 'Male', '09263746271', '07 Mano Street, Panacan, Davao City', 13, '2025-02-03', 'Active', 72000.00, NULL, '2025-03-09 04:54:35', 0),
(22, 26, 'Charles', 'White', '1994-08-02', 'Male', '09458162143', 'J.P. Laurel Ave, Davao City', 6, '2025-03-11', 'Active', 75000.00, NULL, '2025-03-12 02:19:05', 0),
(23, 27, 'Monica', 'Rodriguez', '1990-12-14', 'Female', '09568452157', 'Quimpo Blvd., Davao City', 6, '2025-03-01', 'Active', 75000.00, NULL, '2025-03-12 04:02:09', 0);

--
-- Triggers `employees`
--
DELIMITER $$
CREATE TRIGGER `before_insert_employee` BEFORE INSERT ON `employees` FOR EACH ROW BEGIN
    DECLARE default_salary DECIMAL(10,2);

    -- Get the salary from positions table
    SELECT base_salary INTO default_salary 
    FROM positions 
    WHERE position_id = NEW.position_id 
    LIMIT 1;

    -- Assign the base salary if not manually provided
    IF NEW.base_salary IS NULL THEN
        SET NEW.base_salary = default_salary;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `job_postings`
--

CREATE TABLE `job_postings` (
  `job_id` int(11) NOT NULL,
  `position_id` int(11) DEFAULT NULL,
  `job_title` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `vacancies` int(11) NOT NULL,
  `job_summary` text DEFAULT NULL,
  `responsibilities` text DEFAULT NULL,
  `requirements` text DEFAULT NULL,
  `qualifications` text DEFAULT NULL,
  `application_deadline` date DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `status` enum('Open','Closed') DEFAULT 'Open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_postings`
--

INSERT INTO `job_postings` (`job_id`, `position_id`, `job_title`, `department`, `salary`, `vacancies`, `job_summary`, `responsibilities`, `requirements`, `qualifications`, `application_deadline`, `contact`, `status`, `created_at`) VALUES
(2, 0, 'Legal Advisor', '8', 85000.00, 5, 'b', 'b', 'b', 'a', '2025-03-31', 'hr@company.com | +63 912 345 6789', 'Open', '2025-03-05 12:08:32'),
(3, 0, 'Customer Service Rep', '6', 45000.00, 8, 'a', 'a', 'a', 'a', '2025-03-31', 'hr@company.com | +63 912 345 6789', 'Open', '2025-03-05 12:10:03'),
(8, 3, 'Accountant', '2', 68000.00, 4, 'Sample', 'Sample', 'Sample', 'Sample', '2025-03-28', '09876543217', 'Open', '2025-03-09 05:17:07'),
(9, 5, 'IT Manager', '3', 72000.00, 3, 'fasfasf', 'fsfasf', 'sfasf', 'fsfasf', '2025-03-26', '09876543217', 'Open', '2025-03-09 05:17:57'),
(10, 1, 'HR Manager', '1', 65000.00, 4, 'safasf', 'safasf', 'sfaf', 'safasf', '2025-03-26', '09495655839', 'Open', '2025-03-09 05:26:37'),
(11, 1, 'HR Manager', '1', 50000.00, 4, 'ffw', 'fggsdg', 'gdsgs', 'gsdgsd', '2025-03-24', '09876543217', 'Open', '2025-03-09 05:34:30');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `leave_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `leave_type` enum('Vacation','Sick','Emergency','Maternity','Paternity','Bereavement','Unpaid') NOT NULL,
  `message` text DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `admin_message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`leave_id`, `employee_id`, `leave_type`, `message`, `start_date`, `end_date`, `status`, `admin_message`, `created_at`) VALUES
(7, 7, 'Sick', 'Recovering from food poisoning.', '2025-05-01', '2025-05-03', 'Pending', NULL, '2025-03-05 17:38:32'),
(8, 8, 'Bereavement', 'Attending a funeral.', '2025-03-12', '2025-03-15', 'Approved', '', '2025-03-05 17:38:32'),
(9, 9, 'Unpaid', 'Personal leave for mental health.', '2025-09-01', '2025-09-05', 'Pending', NULL, '2025-03-05 17:38:32'),
(12, 5, 'Sick', 'Need to rest.', '2025-03-08', '2025-03-09', 'Pending', NULL, '2025-03-08 07:18:37'),
(17, 14, 'Vacation', 'Annual trip for my birthday.', '2025-08-28', '2025-03-30', 'Pending', NULL, '2025-03-08 09:18:46'),
(18, 14, 'Vacation', 'Annual trip.', '2025-08-28', '2025-08-31', 'Rejected', '', '2025-03-08 09:19:36'),
(21, 5, 'Vacation', 'Need it', '2025-03-27', '2025-03-28', 'Approved', 'go bruhh', '2025-03-11 15:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `leave_type_id` int(11) NOT NULL,
  `leave_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`leave_type_id`, `leave_type_name`) VALUES
(8, 'Annual Leave'),
(7, 'Compassionate Leave'),
(5, 'Emergency Leave'),
(3, 'Maternity Leave'),
(4, 'Paternity Leave'),
(1, 'Sick Leave'),
(6, 'Study Leave'),
(2, 'Vacation');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `success` tinyint(1) DEFAULT 0,
  `attempt_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `email`, `ip_address`, `user_agent`, `success`, `attempt_time`) VALUES
(1, 'admin@gmail.com', '::1', NULL, 0, NULL),
(2, 'admin@gmail.com', '::1', NULL, 0, NULL),
(3, 'admin@gmail.com', '::1', NULL, 0, NULL),
(4, 'admin@gmail.com', '::1', NULL, 0, NULL),
(5, 'admin@gmail.com', '::1', NULL, 0, NULL),
(6, 'admin@gmail.com', '::1', NULL, 0, NULL),
(7, 'admin@gmail.com', '::1', NULL, 0, NULL),
(8, 'admin@gmail.com', '::1', NULL, 0, NULL),
(9, 'admin@gmail.com', '::1', NULL, 0, NULL),
(10, 'c.cahilig.839@company.com', '::1', NULL, 0, NULL),
(11, 'admin@gmail.com', '::1', NULL, 0, NULL),
(12, 'admin@gmail.com', '::1', NULL, 0, NULL),
(13, 'c.cahilig.839@company.com', '::1', NULL, 0, NULL),
(14, 'admin@gmail.com', '::1', NULL, 0, NULL),
(15, 'admin@gmail.com', '::1', NULL, 0, NULL),
(16, 'admin@gmail.com', '::1', NULL, 0, NULL),
(17, 'admin@gmail.com', '::1', NULL, 0, NULL),
(18, 'admin@gmail.com', '::1', NULL, 0, NULL),
(19, 'admin@gmail.com', '::1', NULL, 0, NULL),
(20, 'admin@gmail.com', '::1', NULL, 0, NULL),
(21, 'admindas@gmail.com', '::1', NULL, 0, NULL),
(22, 'admin@gmail.com', '::1', NULL, 0, NULL),
(23, 'admin@gmail.com', '::1', NULL, 0, NULL),
(24, 'admin@gmail.com', '::1', NULL, 0, NULL),
(25, 'admin@gmail.com', '::1', NULL, 0, NULL),
(26, 'admin@gmail.com', '::1', NULL, 0, NULL),
(27, 'admin@gmail.com', '::1', NULL, 0, NULL),
(28, 'admin@gmail.com', '::1', NULL, 0, NULL),
(29, 'adffmin@gmail.com', '::1', NULL, 0, NULL),
(30, 'admin@gmail.com', '::1', NULL, 0, NULL),
(31, 'admin@gmail.com', '::1', NULL, 0, NULL),
(32, 'admin@gmail.com', '::1', NULL, 0, NULL),
(33, 'admin@gmail.com', '::1', NULL, 0, NULL),
(34, 'admin@gmail.com', '::1', NULL, 0, NULL),
(35, 'admin@gmail.com', '::1', NULL, 0, NULL),
(36, 'admin@gmail.com', '::1', NULL, 0, NULL),
(37, 'c.cahilig.839@company.com', '::1', NULL, 0, NULL),
(38, 'c.cahilig.839@company.com', '::1', NULL, 0, NULL),
(39, 'admin@gmail.com', '::1', NULL, 0, NULL),
(40, 'admin@gmail.com', '::1', NULL, 0, NULL),
(41, 'c.cahilig.839@company.com', '::1', NULL, 0, NULL),
(42, 'admin@gmail.com', '::1', NULL, 0, NULL),
(43, 'admin@gmail.com', '::1', NULL, 0, NULL),
(44, 'admin@gmail.com', '::1', NULL, 0, NULL),
(45, 'admin@gmail.com', '::1', NULL, 0, NULL),
(46, 'c.cahilig.839@company.com', '::1', NULL, 0, NULL),
(47, 'admin@gmail.com', '::1', NULL, 0, NULL),
(48, 'admin@gmail.com', '::1', NULL, 0, NULL),
(49, 'admin@gmail.com', '::1', NULL, 0, NULL),
(50, 'admin@gmail.com', '::1', NULL, 0, NULL),
(51, 'c.cahilig.839@company.com', '::1', NULL, 0, NULL),
(52, 'admin@gmail.com', '::1', NULL, 0, NULL),
(53, 'admin@gmail.com', '::1', NULL, 0, NULL),
(54, 'admin@gmail.com', '::1', NULL, 0, NULL),
(55, 'admin@gmail.com', '::1', NULL, 0, NULL),
(56, 'admin@gmail.com', '::1', NULL, 0, NULL),
(57, 'admin@gmail.com', '::1', NULL, 0, NULL),
(58, 'admin@gmail.com', '::1', NULL, 0, NULL),
(59, 'admin@gmail.com', '::1', NULL, 0, NULL),
(60, 'admin@gmail.com', '::1', NULL, 0, NULL),
(61, 'admin@gmail.com', '::1', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `payroll_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `pay_period_start` date NOT NULL,
  `pay_period_end` date NOT NULL,
  `gross_salary` decimal(10,2) NOT NULL,
  `deductions` decimal(10,2) DEFAULT 0.00,
  `net_salary` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_status` enum('Paid','Pending') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payroll_id`, `employee_id`, `pay_period_start`, `pay_period_end`, `gross_salary`, `deductions`, `net_salary`, `payment_date`, `payment_status`, `created_at`) VALUES
(1, 1, '2025-03-01', '2025-03-15', 21523.59, 8181.82, 13341.77, '2025-03-09', 'Paid', '2025-03-09 02:58:12'),
(5, 5, '2025-03-01', '2025-03-15', 13290.91, 200.00, 13090.91, '2025-03-09', 'Pending', '2025-03-09 02:58:12'),
(6, 7, '2025-03-01', '2025-03-15', 9645.45, 9545.45, 100.00, '2025-03-09', 'Pending', '2025-03-09 02:58:12'),
(7, 8, '2025-03-01', '2025-03-15', 16194.18, 6918.18, 9276.00, '2025-03-09', 'Pending', '2025-03-09 02:58:12'),
(8, 9, '2025-03-01', '2025-03-15', 6464.64, 3281.82, 3182.82, '2025-03-09', 'Pending', '2025-03-09 02:58:12'),
(9, 11, '2025-03-01', '2025-03-15', 6961.36, 100.00, 6861.36, '2025-03-09', 'Pending', '2025-03-09 02:58:12'),
(10, 12, '2025-03-01', '2025-03-15', 8636.36, 4318.18, 4318.18, '2025-03-09', 'Pending', '2025-03-09 02:58:12'),
(11, 14, '2025-03-01', '2025-03-15', 7727.27, 3963.64, 3763.64, '2025-03-09', 'Pending', '2025-03-09 02:58:12'),
(12, 15, '2025-03-01', '2025-03-15', 8639.36, 3636.36, 5003.00, '2025-03-09', 'Pending', '2025-03-09 02:58:12'),
(13, 18, '2025-03-01', '2025-03-15', 7727.27, 3963.64, 3763.64, '2025-03-09', 'Pending', '2025-03-09 02:58:12'),
(15, 19, '2025-03-01', '2025-03-15', 6463.64, 6363.64, 100.00, '2025-03-12', 'Pending', '2025-03-11 16:01:34'),
(16, 20, '2025-03-01', '2025-03-15', 7656.82, 3281.82, 4375.00, '2025-03-12', 'Pending', '2025-03-11 16:01:34'),
(17, 21, '2025-03-01', '2025-03-15', 6745.45, 3372.73, 3372.73, '2025-03-12', 'Pending', '2025-03-11 16:01:34'),
(18, 22, '2025-03-01', '2025-03-15', 7223.18, 3509.09, 3714.09, '2025-03-12', 'Pending', '2025-03-12 02:19:54'),
(19, 23, '2025-03-01', '2025-03-15', 7223.18, 3509.09, 3714.09, '2025-03-12', 'Pending', '2025-03-12 04:02:15'),
(21, 6, '2025-03-01', '2025-03-15', 106.00, 40000.00, 0.00, '2025-03-14', 'Pending', '2025-03-13 16:29:29'),
(22, 1, '2026-03-01', '2026-03-15', 8483.82, 4190.91, 4292.91, '2026-03-10', 'Pending', '2026-03-10 06:12:54'),
(26, 5, '2026-03-01', '2026-03-15', 6745.45, 3372.73, 3372.73, '2026-03-10', 'Pending', '2026-03-10 06:12:54'),
(27, 6, '2026-03-01', '2026-03-15', 8106.00, 4100.00, 4006.00, '2026-03-10', 'Pending', '2026-03-10 06:12:54'),
(28, 7, '2026-03-01', '2026-03-15', 6463.64, 3281.82, 3181.82, '2026-03-10', 'Pending', '2026-03-10 06:12:54'),
(29, 8, '2026-03-01', '2026-03-15', 6819.18, 3509.09, 3310.09, '2026-03-10', 'Pending', '2026-03-10 06:12:54'),
(30, 9, '2026-03-01', '2026-03-15', 6464.64, 3281.82, 3182.82, '2026-03-10', 'Pending', '2026-03-10 06:12:54'),
(31, 11, '2026-03-01', '2026-03-15', 6381.82, 3190.91, 3190.91, '2026-03-10', 'Pending', '2026-03-10 06:12:54'),
(32, 12, '2026-03-01', '2026-03-15', 8636.36, 4418.18, 4218.18, '2026-03-10', 'Pending', '2026-03-10 06:12:54'),
(33, 14, '2026-03-01', '2026-03-15', 7727.27, 3963.64, 3763.64, '2026-03-10', 'Pending', '2026-03-10 06:12:54'),
(34, 15, '2026-03-01', '2026-03-15', 7275.73, 3736.36, 3539.36, '2026-03-10', 'Pending', '2026-03-10 06:12:54'),
(35, 17, '2026-03-01', '2026-03-15', 100.00, 100.00, 0.00, '2026-03-10', 'Pending', '2026-03-10 06:12:54'),
(36, 18, '2026-03-01', '2026-03-15', 7727.27, 3963.64, 3763.64, '2026-03-10', 'Pending', '2026-03-10 06:12:54'),
(37, 19, '2026-03-01', '2026-03-15', 6463.64, 3281.82, 3181.82, '2026-03-10', 'Pending', '2026-03-10 06:12:54'),
(38, 20, '2026-03-01', '2026-03-15', 6463.64, 3281.82, 3181.82, '2026-03-10', 'Pending', '2026-03-10 06:12:54'),
(39, 21, '2026-03-01', '2026-03-15', 6745.45, 3372.73, 3372.73, '2026-03-10', 'Pending', '2026-03-10 06:12:54'),
(40, 22, '2026-03-01', '2026-03-15', 7223.18, 3509.09, 3714.09, '2026-03-10', 'Pending', '2026-03-10 06:12:54'),
(41, 23, '2026-03-01', '2026-03-15', 7223.18, 3509.09, 3714.09, '2026-03-10', 'Pending', '2026-03-10 06:12:54'),
(42, 2, '2026-03-01', '2026-03-15', 3815.09, 100.00, 3715.09, '2026-03-11', 'Pending', '2026-03-11 01:57:43'),
(43, 3, '2026-03-01', '2026-03-15', 300.00, 43181.82, 0.00, '2026-03-11', 'Pending', '2026-03-11 01:57:43'),
(44, 4, '2026-03-01', '2026-03-15', 2350.45, 100.00, 2250.45, '2026-03-11', 'Pending', '2026-03-11 01:57:43');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_increases`
--

CREATE TABLE `payroll_increases` (
  `adjustment_id` int(11) NOT NULL,
  `adjustment_type` enum('employee','position','department') NOT NULL,
  `target_id` int(11) NOT NULL,
  `increase_amount` decimal(10,2) NOT NULL,
  `applied_by` int(11) NOT NULL,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll_increases`
--

INSERT INTO `payroll_increases` (`adjustment_id`, `adjustment_type`, `target_id`, `increase_amount`, `applied_by`, `applied_at`) VALUES
(1, 'employee', 3, 100.00, 1, '2025-03-12 08:09:44'),
(2, 'position', 6, 100.00, 1, '2025-03-12 08:12:19'),
(3, 'department', 1, 1.00, 1, '2025-03-12 08:18:14'),
(4, 'department', 1, 1.00, 1, '2025-03-12 08:22:51'),
(5, 'employee', 3, 100.00, 1, '2025-03-12 08:35:18'),
(6, 'position', 11, 100.00, 1, '2025-03-12 08:36:08'),
(7, 'department', 4, 100.00, 1, '2025-03-12 08:37:35'),
(8, 'employee', 3, 100.00, 1, '2025-03-12 08:50:05'),
(9, 'employee', 2, 1.00, 1, '2025-03-12 08:50:26'),
(10, 'position', 13, 100.00, 1, '2025-03-12 08:55:28'),
(11, 'position', 15, 1.00, 1, '2025-03-12 09:04:21'),
(12, 'department', 6, 5.00, 1, '2025-03-12 09:05:49'),
(13, 'employee', 7, 100.00, 1, '2025-03-13 07:37:52');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(100) NOT NULL,
  `department_id` int(11) NOT NULL,
  `base_salary` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `position_name`, `department_id`, `base_salary`, `description`, `created_at`) VALUES
(1, 'HR Manager', 1, 80000.00, 'Oversees HR policies and employee relations', '2025-02-19 15:44:47'),
(2, 'HR Officer', 1, 50000.00, 'Manages recruitment and employee records', '2025-02-19 15:44:47'),
(3, 'Accountant', 2, 60000.00, 'Manages financial records and payroll', '2025-02-19 15:44:47'),
(4, 'Financial Analyst', 2, 70000.00, 'Analyzes company financial health', '2025-02-19 15:44:47'),
(5, 'IT Manager', 3, 90000.00, 'Oversees IT infrastructure and security', '2025-02-19 15:44:47'),
(6, 'Software Developer', 3, 75000.00, 'Develops and maintains software systems', '2025-02-19 15:44:47'),
(7, 'Network Administrator', 3, 72000.00, 'Manages company networks and servers', '2025-02-19 15:44:47'),
(8, 'Sales Executive', 4, 65000.00, 'Drives sales and client relationships', '2025-02-19 15:44:47'),
(9, 'Marketing Specialist', 4, 68000.00, 'Handles advertising and promotional activities', '2025-02-19 15:44:47'),
(10, 'Operations Manager', 5, 95000.00, 'Ensures smooth daily business operations', '2025-02-19 15:44:47'),
(11, 'Customer Service Rep', 6, 45000.00, 'Assists customers with inquiries and support', '2025-02-19 15:44:47'),
(12, 'Research Analyst', 7, 70000.00, 'Conducts market and product research', '2025-02-19 15:44:47'),
(13, 'Product Developer', 7, 72000.00, 'Designs and tests new products', '2025-02-19 15:44:47'),
(14, 'Legal Advisor', 8, 85000.00, 'Provides legal guidance to the company', '2025-02-19 15:44:47'),
(15, 'Compliance Officer', 8, 88000.00, 'Ensures company follows legal regulations', '2025-02-19 15:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `rejected_applicants`
--

CREATE TABLE `rejected_applicants` (
  `applicant_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `cover_letter` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Accepted','Rejected') DEFAULT 'Rejected',
  `applied_at` datetime DEFAULT NULL,
  `rejected_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rejected_applicants`
--

INSERT INTO `rejected_applicants` (`applicant_id`, `job_id`, `first_name`, `last_name`, `email`, `phone`, `resume`, `cover_letter`, `status`, `applied_at`, `rejected_at`) VALUES
(7, 8, 'Janelle', 'Baltazar', 'j.baltazar.105@company.com', '09171234567', '../ASSETS/UPLOADS/Resumes/67d178a0bb7ba_Resume.pdf', '../ASSETS/UPLOADS/CoverLetters/67d178a0ca97d_Cover Letter.pdf', 'Rejected', '2025-03-13 22:13:38', '2025-03-13 14:13:38'),
(9, 2, 'Rena', 'Cahil', 'r.cahil.999@company.com', '09123456782', '../ASSETS/UPLOADS/Resumes/67d1a1ad01f55_Resume.pdf', '../ASSETS/UPLOADS/CoverLetters/67d1a1ad0a768_Cover Letter.pdf', 'Rejected', '2026-03-10 14:11:33', '2026-03-10 06:11:33'),
(12, 8, 'Monica', 'Rodriguez', 'm.rodriguez.228@company.com', '09568452157', '../ASSETS/UPLOADS/Resumes/67d2565a605b0_Resume.pdf', '../ASSETS/UPLOADS/CoverLetters/67d2565a756c3_Cover Letter.pdf', 'Rejected', '2025-03-13 22:12:37', '2025-03-13 14:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','employee') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `failed_attempts` int(11) DEFAULT 0,
  `last_failed_attempt` datetime DEFAULT NULL,
  `account_locked` tinyint(1) DEFAULT 0,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `role`, `created_at`, `failed_attempts`, `last_failed_attempt`, `account_locked`, `last_login`, `last_logout`) VALUES
(1, 'admin@gmail.com', '$2y$10$xym8RJEYOp6Py6oMA/xr7uxozpfnxIi26N719gPZiq/MZN.VyM8je', 'admin', '2025-02-19 13:26:25', 1, '2026-06-06 16:59:22', 0, '2026-06-06 16:55:22', NULL),
(2, 'c.cahilig.839@company.com', '$2y$10$cL6wWHWXwQPh3S8ehFxp5uznCiukVklCb48miZL57tg6w1KUktH5q', 'employee', '2025-02-20 22:43:23', 0, '2026-03-11 03:13:05', 0, '2026-03-11 10:27:08', NULL),
(3, 'f.andong.739@company.com', '$2y$10$b68WshDsanMxt8cCk4fLzevcMHr.9a8it70bCU42XTk.kOIoXk1VK', 'employee', '2025-02-22 01:26:15', 0, NULL, 0, NULL, NULL),
(6, 'j.sarmiento.943@company.com', '$2y$10$Ip1tdpJlsDXt.zWAwBIKxuxAXmAr2tMVav6QXpI6nU4bybthb9kCi', 'employee', '2025-02-22 01:34:03', 0, NULL, 0, NULL, NULL),
(9, 'k.gellica.351@company.com', '$2y$10$pH6nDrJY03ANznHaQZA27OU8e0vXepqKDvqbDe2OLKMaqLCnn2jFe', 'employee', '2025-02-22 01:53:25', 0, NULL, 0, NULL, NULL),
(10, 'j.odiong.626@company.com', '$2y$10$L1U4RwxG5jnScKh9VJCZGuQq4zQXo7szLroHXDM8hkAvGkjo.UhjO', 'employee', '2025-02-22 01:58:55', 0, NULL, 0, NULL, NULL),
(11, 'j.cabarde.656@company.com', '$2y$10$eSL8tBxdO1se4iKNgptQHePH3rZTqA1QqpRAJRWvJ4y2NFTiUVNFi', 'employee', '2025-02-22 02:11:00', 0, NULL, 0, NULL, NULL),
(12, 'f.coyoca.948@company.com', '$2y$10$okrsPWaq99mNkGstq1dG4.TxsSbtYUFw9bGWNqHtojaDyd.fR68Xq', 'employee', '2025-02-22 02:39:50', 0, NULL, 0, NULL, NULL),
(13, 'j.baltazar.105@company.com', '$2y$10$kBk9DeOI9G5JwjCIMuwrwugl6dlT4.9R/TbC1cczTss95ZFApCmA6', 'employee', '2025-02-26 12:45:51', 0, NULL, 0, NULL, NULL),
(14, 'a.tugonon.567@company.com', '$2y$10$XARqkXpA4iIg4TZjRA/BLONtkNxnZJjGIFAJJlokcIYUrccG1Gpqu', 'employee', '2025-02-27 12:16:05', 0, NULL, 0, NULL, NULL),
(15, 'i.magtibay.534@company.com', '$2y$10$9v1w3LDYS/W3UOAz/6ZSkeMG3DDwPyOQ5.IxdTn12l84A0khRcX06', 'employee', '2025-02-27 12:26:30', 0, NULL, 0, NULL, NULL),
(16, 'j.villegas.228@company.com', '$2y$10$nMe7QFgQAZNKRjDHHw3nF.Hp8CvwV9wwz5xu7/kLP7zaqCXuaSS7O', 'employee', '2025-02-27 12:41:47', 0, NULL, 0, NULL, NULL),
(17, 'a.tan.919@company.com', '$2y$10$cCmarZwR8OR97EyzfzOytOzBdRW3vFr3dDxiCtMS3/6VpalPIZax.', 'employee', '2025-02-27 13:07:48', 0, NULL, 0, NULL, NULL),
(18, 'a.tan.139@company.com', '$2y$10$Xn3q8pxIVhyjVltssQ5NhumCKI8k7hJVpvbFL/buqHfLuOXkuxcxe', 'employee', '2025-02-27 13:12:38', 0, NULL, 0, NULL, NULL),
(19, 'a.abapo.903@company.com', '$2y$10$GUUnTSv.yu5oq.UTtUbA0uGQKGbG093ME/nxjYR7K.t6eQnwhiwaG', 'employee', '2025-03-01 07:29:31', 0, NULL, 0, NULL, NULL),
(20, 'e.cortez.621@company.com', '$2y$10$y/vnnkJVXqFgSheE7OSTm.4.c.QRv4zqTVRrmPh/F91t51Xymvzhu', 'employee', '2025-03-01 08:32:18', 0, NULL, 0, NULL, NULL),
(21, 'e.cortez.520@company.com', '$2y$10$D9LUXWBo9DC/Le5KVbpR9OOf5agdGE5YZKqbIs1uR6uwbFyosFMdu', 'employee', '2025-03-01 09:04:17', 0, NULL, 0, NULL, NULL),
(22, 'm.qualley.619@company.com', '$2y$10$z3BVqUMqIuEJo0Kaoy0ddu.YA3KmO7IxpWxS1o7i7GU6buRMYJjp.', 'employee', '2025-03-01 09:21:42', 0, NULL, 0, NULL, NULL),
(23, 'd.clarete.562@company.com', '$2y$10$Rwx/zlg1DhOaN0a5Yjd7S.yIigO4.cBiP.c747.JrxdkP.arcZMmi', 'employee', '2025-03-01 09:26:00', 0, NULL, 0, NULL, NULL),
(24, 'r.cahil.999@company.com', '$2y$10$CdVFkSf0hxX7CfNmg0oHJ..i.TO95yRkgD82xZAFG/j2U5x7fl5wy', 'employee', '2025-03-09 04:37:38', 0, NULL, 0, NULL, NULL),
(25, 'h.green.637@company.com', '$2y$10$hqtJgQac3i3y5/Wel0SlcO.FkkdplUp5i1tvp9vcykFSWlOGFscV2', 'employee', '2025-03-09 04:54:35', 0, NULL, 0, NULL, NULL),
(26, 'c.white.747@company.com', '$2y$10$EMd.kM1PvpE1whHUkuS2aeCeEOoO4.UJ1xxBQH5oYwtFJXSKbUOVW', 'employee', '2025-03-12 02:19:05', 0, NULL, 0, NULL, NULL),
(27, 'm.rodriguez.228@company.com', '$2y$10$JRPrMpFvJeHWw/odUvk/iO77mwlYYbCkQuILfJwory8elDV/SFLFy', 'employee', '2025-03-12 04:02:09', 0, NULL, 0, NULL, NULL),
(28, 'l.hernandez.113@company.com', '$2y$10$m15JrkApOon3UtO7dsAD8eQsUEO3M7/vJUhLjdxK3lgH48g0.3G46', 'employee', '2025-03-12 11:17:58', 0, NULL, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accepted_applicants`
--
ALTER TABLE `accepted_applicants`
  ADD PRIMARY KEY (`applicant_id`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`applicant_id`),
  ADD UNIQUE KEY `email` (`email`,`job_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `archived_departments`
--
ALTER TABLE `archived_departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `archived_employees`
--
ALTER TABLE `archived_employees`
  ADD PRIMARY KEY (`archive_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `archived_jobpostings`
--
ALTER TABLE `archived_jobpostings`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `archived_positions`
--
ALTER TABLE `archived_positions`
  ADD PRIMARY KEY (`position_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `archived_requests`
--
ALTER TABLE `archived_requests`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_timestamp` (`timestamp`);

--
-- Indexes for table `auto_attendance_log`
--
ALTER TABLE `auto_attendance_log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `run_date` (`run_date`);

--
-- Indexes for table `bonuses`
--
ALTER TABLE `bonuses`
  ADD PRIMARY KEY (`bonus_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`deduction_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`),
  ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `job_postings`
--
ALTER TABLE `job_postings`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`leave_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`leave_type_id`),
  ADD UNIQUE KEY `leave_type_name` (`leave_type_name`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ip_time` (`ip_address`,`attempt_time`),
  ADD KEY `idx_email_time` (`email`,`attempt_time`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`payroll_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `payroll_increases`
--
ALTER TABLE `payroll_increases`
  ADD PRIMARY KEY (`adjustment_id`),
  ADD KEY `applied_by` (`applied_by`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`),
  ADD UNIQUE KEY `position_name` (`position_name`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `rejected_applicants`
--
ALTER TABLE `rejected_applicants`
  ADD PRIMARY KEY (`applicant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `applicant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `archived_employees`
--
ALTER TABLE `archived_employees`
  MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `archived_requests`
--
ALTER TABLE `archived_requests`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `auto_attendance_log`
--
ALTER TABLE `auto_attendance_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bonuses`
--
ALTER TABLE `bonuses`
  MODIFY `bonus_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `deduction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `job_postings`
--
ALTER TABLE `job_postings`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `leave_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `payroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `payroll_increases`
--
ALTER TABLE `payroll_increases`
  MODIFY `adjustment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accepted_applicants`
--
ALTER TABLE `accepted_applicants`
  ADD CONSTRAINT `accepted_applicants_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`applicant_id`) ON DELETE CASCADE;

--
-- Constraints for table `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `applicants_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job_postings` (`job_id`) ON DELETE CASCADE;

--
-- Constraints for table `archived_employees`
--
ALTER TABLE `archived_employees`
  ADD CONSTRAINT `archived_employees_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `archived_employees_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `positions` (`position_id`);

--
-- Constraints for table `archived_positions`
--
ALTER TABLE `archived_positions`
  ADD CONSTRAINT `archived_positions_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE SET NULL;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE;

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `bonuses`
--
ALTER TABLE `bonuses`
  ADD CONSTRAINT `bonuses_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE;

--
-- Constraints for table `deductions`
--
ALTER TABLE `deductions`
  ADD CONSTRAINT `deductions_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `positions` (`position_id`) ON DELETE CASCADE;

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `leave_requests_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE;

--
-- Constraints for table `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `payroll_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE;

--
-- Constraints for table `payroll_increases`
--
ALTER TABLE `payroll_increases`
  ADD CONSTRAINT `payroll_increases_ibfk_1` FOREIGN KEY (`applied_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `positions_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE;

--
-- Constraints for table `rejected_applicants`
--
ALTER TABLE `rejected_applicants`
  ADD CONSTRAINT `rejected_applicants_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`applicant_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
