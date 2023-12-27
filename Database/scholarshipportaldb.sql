-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2023 at 02:55 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scholarshipportaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `lga` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `next_of_kin` varchar(100) DEFAULT NULL,
  `nok_address` text DEFAULT NULL,
  `nok_email` varchar(100) DEFAULT NULL,
  `relation` varchar(50) DEFAULT NULL,
  `passport_path` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1=accepted, 2=rejected'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `student_id`, `phone`, `dob`, `state`, `lga`, `address`, `next_of_kin`, `nok_address`, `nok_email`, `relation`, `passport_path`, `status`) VALUES
(3, 1, '09160163113', '2023-10-26', '', '', 'Just Testing to see if it works!', 'Kunne', 'Gida-Dubu', 'kunne@gmail.com', 'brother', 'uploads/1599864585669.jpg', 1),
(4, 2, '09160163113', '2023-10-26', '', '', 'See if it works!', 'Sallau', 'Gida-Dubu', 'sallau@gmail.com', 'Senior brother', 'uploads/u.jpg', 0),
(5, 7, '+23499887766', '2023-12-28', '', '', 'Unguwar yan kaji', 'Testcode', 'Unguwar yan kaji', 'testcode@gmail.com', 'testing', 'uploads/IMG-20231128-WA0003.jpg', 2),
(6, 8, '09040306788', '2023-11-27', 'Jigawa', 'Gumel', 'yola, yola.', 'abubakar', 'same as the last one', 'umar@gmail.com', 'Father', 'uploads/u.jpg', 1),
(7, 6, '09160163113', '2023-10-26', '', '', 'Just Testing to see if it works!', 'Kunne', 'Gida-Dubu', 'kunne@gmail.com', 'brother', 'uploads/1599864585669.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `choice_of_study`
--

CREATE TABLE `choice_of_study` (
  `id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `faculty` int(100) NOT NULL,
  `program` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `choice_of_study`
--

INSERT INTO `choice_of_study` (`id`, `applicant_id`, `faculty`, `program`) VALUES
(1, 1, 3, 3),
(2, 8, 2, 2),
(3, 7, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`) VALUES
(1, 'Social and Management Sciences'),
(2, 'Basic Medical Sciences'),
(3, 'Science & Computing');

-- --------------------------------------------------------

--
-- Table structure for table `jamb_results`
--

CREATE TABLE `jamb_results` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `jamb_reg_no` varchar(255) NOT NULL,
  `english` varchar(255) NOT NULL,
  `english_score` int(11) NOT NULL,
  `subject1` varchar(255) NOT NULL,
  `subject1_score` int(11) NOT NULL,
  `subject2` varchar(255) NOT NULL,
  `subject2_score` int(11) NOT NULL,
  `subject3` varchar(255) NOT NULL,
  `subject3_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jamb_results`
--

INSERT INTO `jamb_results` (`id`, `student_id`, `jamb_reg_no`, `english`, `english_score`, `subject1`, `subject1_score`, `subject2`, `subject2_score`, `subject3`, `subject3_score`) VALUES
(1, 1, '87572011DH', 'English', 40, 'Mathematics', 20, 'Chemistry', 50, 'Hausa', 70),
(3, 8, '22344CD', 'English', 20, 'Mathematics', 30, 'Chemistry', 40, 'Hausa', 79),
(9, 7, '40306788GI', 'English', 58, 'Maths', 67, 'Biology', 31, 'Economics', 40);

-- --------------------------------------------------------

--
-- Table structure for table `olevel`
--

CREATE TABLE `olevel` (
  `id` int(11) NOT NULL,
  `form_flag` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `exam_type` varchar(50) NOT NULL,
  `exam_no` varchar(20) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `exam_center` varchar(100) DEFAULT NULL,
  `english` varchar(50) NOT NULL,
  `english_grade` varchar(10) NOT NULL,
  `maths` varchar(50) NOT NULL,
  `maths_grade` varchar(10) NOT NULL,
  `subject1` varchar(50) NOT NULL,
  `subject1_grade` varchar(10) NOT NULL,
  `subject2` varchar(50) NOT NULL,
  `subject2_grade` varchar(10) NOT NULL,
  `subject3` varchar(50) NOT NULL,
  `subject3_grade` varchar(10) NOT NULL,
  `subject4` varchar(50) NOT NULL,
  `subject4_grade` varchar(10) NOT NULL,
  `subject5` varchar(50) DEFAULT NULL,
  `subject5_grade` varchar(10) DEFAULT NULL,
  `subject6` varchar(50) DEFAULT NULL,
  `subject6_grade` varchar(10) DEFAULT NULL,
  `subject7` varchar(50) DEFAULT NULL,
  `subject7_grade` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `olevel`
--

INSERT INTO `olevel` (`id`, `form_flag`, `student_id`, `exam_type`, `exam_no`, `year`, `exam_center`, `english`, `english_grade`, `maths`, `maths_grade`, `subject1`, `subject1_grade`, `subject2`, `subject2_grade`, `subject3`, `subject3_grade`, `subject4`, `subject4_grade`, `subject5`, `subject5_grade`, `subject6`, `subject6_grade`, `subject7`, `subject7_grade`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'WAEC', '2222222', 2018, 'Capital', '', 'B3', '', 'F9', 'ISLAMIC STUDIES', 'C6', 'CHEMISTRY', 'C6', 'YORUBA', 'C6', 'ENGLISH LANGUAGE', 'C5', 'ISLAMIC STUDIES', 'B3', 'BIOLOGY', 'B2', 'HAUSA', 'D7', '2023-12-27 13:14:07', '2023-12-27 13:14:07'),
(2, 2, 1, 'NECO', '127001', 2018, 'Fagoji', 'English', 'C4', 'Maths', 'F9', 'IGBO', 'C6', 'HAUSA', 'C4', 'GENERAL MATHEMATICS', 'E8', 'CHEMISTRY', 'C5', 'CIVIC EDUCATION', 'B2', 'AGRICULTURAL SCIENCE', 'F9', 'FURTHER MATHEMATICS', 'B2', '2023-12-27 13:16:00', '2023-12-27 13:16:00'),
(3, 1, 2, 'NABTEB', '2229991', 2020, 'Fatima Private', '', 'B2', '', 'B3', 'FINANCIAL ACCOUNTING', 'C4', 'GEOGRAPHY', 'C5', 'COMMERCE', 'A1', 'GOVERNMENT', 'C4', 'ISLAMIC STUDIES', 'C6', 'ECONOMICS', 'D7', 'CIVIC EDUCATION', 'B3', '2023-12-27 13:44:21', '2023-12-27 13:44:21');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paid_at` datetime NOT NULL,
  `channel` varchar(255) DEFAULT NULL,
  `currency` varchar(3) NOT NULL,
  `ip_address` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `student_id`, `message`, `status`, `reference`, `amount`, `paid_at`, `channel`, `currency`, `ip_address`) VALUES
(1, 1, 'Verification successful', 'success', 'maf379034954', '400000.00', '2023-10-28 02:41:12', 'card', 'NGN', '102.91.71.105'),
(2, 2, 'Verification successful', 'success', 'maf818786361', '400000.00', '2023-10-28 09:54:21', 'card', 'NGN', '197.210.52.222'),
(6, 8, 'Verification successful', 'success', 'MAF8203171', '400000.00', '2023-12-05 01:04:54', 'card', 'NGN', '197.210.53.79');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `faculty_id`, `name`) VALUES
(1, 1, 'BSc Accounting'),
(2, 3, 'INFORMATION TECHNOLOGY'),
(3, 2, 'Food Science');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `other_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rank` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `first_name`, `last_name`, `other_name`, `email`, `rank`, `status`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Usman', 'Shehu', '', 'iamusmanshehu@gmail.com', '', 0, '$2y$10$bRPKUauL/iLIlpsApyEqsuSKRnI7Wg1P.Zk0kB8JjeRXO/yrdJjbS', '2023-10-25 00:35:39', '2023-12-27 11:26:02'),
(2, 'Usman', 'Yahaya', '', 'usmanyahaya@yahoo.com', '', 0, '$2y$10$WcJb5JtSnE3yAmmdSWQSzuZPeuxKrcmsnMw7xRbfPxOH048eLz2RS', '2023-10-25 00:49:12', '2023-12-27 11:26:02'),
(3, 'Testing', 'Yahaya', '', 'dev.test@yahoo.com', '', 0, '$2y$10$kaq1DpcX2MSsVaExWdNnwubkHEHC0wsGJd/.pneG0JN0Pfi/5UEiu', '2023-10-25 00:51:48', '2023-12-27 11:26:02'),
(4, 'Testing', 'Shehu', '', 'dev.test@gmail.com', '', 0, '$2y$10$uhlWPYsXyAx0ZVjZjylSHO8T6gvJpk7tPOyXZvisfHv.9ufM5qSnG', '2023-10-25 00:53:42', '2023-12-27 11:26:02'),
(6, 'Musbahu', 'Makama', '', 'musbahu@gmail.com', 'Admission Officer', 1, '$2y$10$S4IfYMhV8dbbho70bTF/qeB.mEhQ4H.vB75/hD67GpjTV4y6i2TqO', '2023-11-03 11:58:02', '2023-12-27 11:26:02'),
(7, 'Lazy', 'Developer', '', 'lazy@gmail.com', '', 0, '$2y$10$8Bf.f4mdWkYcVFzzQf1e/OkHHWt/MvLMIoMQIpQpYUmOwq15Q333O', '2023-11-20 04:49:26', '2023-12-27 11:26:02'),
(8, 'Umar', 'Abubakar', '', 'umar@gmail.com', '', 0, '$2y$10$LXii4VZHjJlRRsBFWM54AOJ2EyQDcA6H4Q8nYCbT8768fmxg.Av16', '2023-11-28 01:04:43', '2023-12-27 11:26:02'),
(9, 'Sallau', 'Sulaiman', '', 'sallau@pdp.apc', 'Party chairman', 1, '$2y$10$RBNEuTg1iuY8ph.Qo8CGkuog/QsdMKqFvHdSuOBvOTKqEDHc2TuvW', '2023-12-19 17:22:26', '2023-12-27 11:26:02'),
(10, 'Over', 'Over', '', 'over@gmail.com', 'Zindi Staff', 1, '$2y$10$Bi.1Yry9EC8LltbHm20aGeDv3GL4vH74ukoCiciZABppXwkqYq09y', '2023-12-19 17:27:42', '2023-12-27 11:26:02'),
(11, 'Die', 'Minute', '', 'die@gmail.com', 'Dreem Coder', 1, '$2y$10$.3/NR0uJTRGEbtU4ZydPuuvi4UkSD3zkFygh8UCRH6T8N8D91JkCi', '2023-12-19 17:43:09', '2023-12-27 11:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `name`) VALUES
(1, 'MAF Scholarship');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `choice_of_study`
--
ALTER TABLE `choice_of_study`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jamb_results`
--
ALTER TABLE `jamb_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `olevel`
--
ALTER TABLE `olevel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `choice_of_study`
--
ALTER TABLE `choice_of_study`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jamb_results`
--
ALTER TABLE `jamb_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `olevel`
--
ALTER TABLE `olevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `applicants_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `signup` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `choice_of_study`
--
ALTER TABLE `choice_of_study`
  ADD CONSTRAINT `choice_of_study_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `signup` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `jamb_results`
--
ALTER TABLE `jamb_results`
  ADD CONSTRAINT `jamb_results_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `signup` (`id`);

--
-- Constraints for table `olevel`
--
ALTER TABLE `olevel`
  ADD CONSTRAINT `olevel_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `signup` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `signup` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
