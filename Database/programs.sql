-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2024 at 01:50 PM
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
(1, 1, 'B.Sc Accounting'),
(7, 1, 'B.Sc Enterpreneurship'),
(8, 1, 'B.Sc Economics'),
(9, 1, 'B.Sc Mass Communication'),
(10, 1, 'B.Sc Criminology & Security Studies'),
(11, 2, 'B.NSc. Nursing'),
(12, 2, 'B.M.L.S Medical Laboratory Science'),
(14, 2, 'D. Physiotherapy'),
(15, 3, 'B.Sc Biology'),
(16, 3, 'B.Sc Chemistry'),
(17, 3, 'B.Sc Mathematics'),
(18, 3, 'B.Sc Physics & Electronics'),
(19, 3, 'B.Sc Computer Science'),
(20, 3, 'B.Sc Cyber Security'),
(21, 3, 'B.Sc Software Engineering');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
