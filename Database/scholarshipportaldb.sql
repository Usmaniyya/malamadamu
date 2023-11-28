-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 07:16 AM
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
(3, 1, '09160163113', '2023-10-26', 'Jigawa', 'Gwaram', 'Just Testing to see if it works!', 'Kunne', 'Gida-Dubu', 'kunne@gmail.com', 'brother', 'uploads/IMG_2399.jpg', 2),
(4, 2, '09160163113', '2023-10-26', '', '', 'See if it works!', 'Sallau', 'Gida-Dubu', 'sallau@gmail.com', 'Senior brother', 'uploads/u.jpg', 0),
(5, 7, '', '0000-00-00', '', '', '', '', '', '', '', '', 0);

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
(1, 1, 1, 1),
(2, 1, 1, 1),
(3, 1, 1, 1);

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
(1, 'Faculty of Social and Management Sciences'),
(2, 'Faculty of Basic Medical Science'),
(3, 'Faculty of Science & Computing');

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
(1, 1, '87572011', 'English', 20, 'Mathematics', 20, 'Chemistry', 50, 'Hausa', 70);

-- --------------------------------------------------------

--
-- Table structure for table `olevel`
--

CREATE TABLE `olevel` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `exam_type` varchar(50) NOT NULL,
  `exam_no` varchar(50) NOT NULL,
  `year` date NOT NULL,
  `exam_center` varchar(100) NOT NULL,
  `english` varchar(50) NOT NULL,
  `english_grade` varchar(5) NOT NULL,
  `maths` varchar(50) NOT NULL,
  `maths_grade` varchar(5) NOT NULL,
  `subject1` varchar(50) NOT NULL,
  `subject1_grade` varchar(5) NOT NULL,
  `subject2` varchar(50) NOT NULL,
  `subject2_grade` varchar(5) NOT NULL,
  `subject3` varchar(50) NOT NULL,
  `subject3_grade` varchar(5) NOT NULL,
  `subject4` varchar(50) NOT NULL,
  `subject4_grade` varchar(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `olevel`
--

INSERT INTO `olevel` (`id`, `student_id`, `exam_type`, `exam_no`, `year`, `exam_center`, `english`, `english_grade`, `maths`, `maths_grade`, `subject1`, `subject1_grade`, `subject2`, `subject2_grade`, `subject3`, `subject3_grade`, `subject4`, `subject4_grade`, `created_at`, `updated_at`) VALUES
(4, 2, 'Waec', '424244', '2023-10-24', 'Fagoji', 'English', 'B1', 'Mathematics', 'A1', 'Islamic Studies', 'B2', 'Hausa', 'C1', 'Social Studies', 'C1', 'Computer', 'B3', '2023-10-29 10:59:43', '0000-00-00 00:00:00'),
(7, 1, 'WAEC', '3000044', '2023-10-06', 'Fagoji', 'English', 'F9', 'Mathematics', 'F9', 'Islamic Studies', 'C2', 'Hausa', 'C6', 'Social Studies', 'C2', 'Computer', 'B2', '2023-11-02 15:39:58', '0000-00-00 00:00:00'),
(8, 1, 'NECO', '30000', '2024-01-02', 'Majia', 'English', 'A1', 'Mathematics', 'A1', 'Islamic Studies', 'C2', 'Hausa', 'C6', 'Social Studies', 'C2', 'Computer', 'B2', '2023-11-02 15:39:59', '0000-00-00 00:00:00');

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
(3, 2, 'Verification successful', 'success', 'maf248319054', '400000.00', '2023-10-28 00:32:41', 'card', 'NGN', '102.91.72.31'),
(4, 2, 'Verification successful', 'success', 'maf611393606', '400000.00', '2023-10-30 17:54:05', 'card', 'NGN', '197.210.53.97'),
(5, 2, 'Verification successful', 'success', 'maf822088939', '400000.00', '2023-10-30 17:55:03', 'card', 'NGN', '197.210.53.97');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `faculty_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`faculty_id`, `name`) VALUES
(1, 'BSc Accounting'),
(2, 'BSc Enterpreneurship');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rank` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `first_name`, `last_name`, `email`, `rank`, `status`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Usman', 'Shehu', 'iamusmanshehu@gmail.com', '', 0, '$2y$10$bRPKUauL/iLIlpsApyEqsuSKRnI7Wg1P.Zk0kB8JjeRXO/yrdJjbS', '2023-10-25 00:35:39', '0000-00-00 00:00:00'),
(2, 'Usman', 'Yahaya', 'usmanyahaya@yahoo.com', '', 0, '$2y$10$WcJb5JtSnE3yAmmdSWQSzuZPeuxKrcmsnMw7xRbfPxOH048eLz2RS', '2023-10-25 00:49:12', '0000-00-00 00:00:00'),
(3, 'Testing', 'Yahaya', 'dev.test@yahoo.com', '', 0, '$2y$10$kaq1DpcX2MSsVaExWdNnwubkHEHC0wsGJd/.pneG0JN0Pfi/5UEiu', '2023-10-25 00:51:48', '0000-00-00 00:00:00'),
(4, 'Testing', 'Shehu', 'dev.test@gmail.com', '', 0, '$2y$10$uhlWPYsXyAx0ZVjZjylSHO8T6gvJpk7tPOyXZvisfHv.9ufM5qSnG', '2023-10-25 00:53:42', '0000-00-00 00:00:00'),
(6, 'Musbahu', 'Makama', 'musbahu@gmail.com', 'Admission Officer', 1, '$2y$10$wm40QfC6HoQPy8qSmVt2tOkZwB0H4FWc1.X0.n1psPnGY8DHvzIpu', '2023-11-03 11:58:02', '2023-11-04 21:37:22'),
(7, 'Lazy', 'Developer', 'lazy@gmail.com', '', 0, '$2y$10$8Bf.f4mdWkYcVFzzQf1e/OkHHWt/MvLMIoMQIpQpYUmOwq15Q333O', '2023-11-20 04:49:26', '0000-00-00 00:00:00');

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
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `choice_of_study`
--
ALTER TABLE `choice_of_study`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jamb_results`
--
ALTER TABLE `jamb_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `olevel`
--
ALTER TABLE `olevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  ADD CONSTRAINT `olevel_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `signup` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `signup` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
