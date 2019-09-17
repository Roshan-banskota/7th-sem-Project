-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2019 at 08:34 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `v1.3`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(30) NOT NULL,
  `user_id` int(50) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `course_full_name` varchar(60) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `section` varchar(20) NOT NULL,
  `subject_id` varchar(20) NOT NULL,
  `faculty_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `user_id`, `course_name`, `course_full_name`, `semester`, `section`, `subject_id`, `faculty_id`) VALUES
(60, 32, 'BSc.CSIT', 'Drama & Cinematics', 'one', 'b', '42', '40'),
(61, 31, 'BSc.CSIT', 'Information Technology & Computer Science', 'one', 'b', '43', '41');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(30) NOT NULL,
  `user_id` int(50) NOT NULL,
  `faculty_code` varchar(30) NOT NULL,
  `faculty_name` varchar(50) NOT NULL,
  `designation` varchar(60) NOT NULL,
  `qualification` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `user_id`, `faculty_code`, `faculty_name`, `designation`, `qualification`) VALUES
(40, 32, 'CSIT', 'Classic', 'assistant professor', 'Msc.CSIT'),
(41, 31, 'CSIT', 'Classic', 'assistant professor', 'Msc.CSIT');

-- --------------------------------------------------------

--
-- Table structure for table `freetime`
--

CREATE TABLE `freetime` (
  `user_id` int(30) NOT NULL,
  `time_id` int(30) NOT NULL,
  `teacher_id` int(30) NOT NULL,
  `day` int(30) NOT NULL,
  `start_hour` int(30) NOT NULL,
  `start_min` int(30) NOT NULL,
  `end_hour` int(30) NOT NULL,
  `end_min` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `freetime`
--

INSERT INTO `freetime` (`user_id`, `time_id`, `teacher_id`, `day`, `start_hour`, `start_min`, `end_hour`, `end_min`) VALUES
(32, 59, 28, 1, 7, 45, 9, 45),
(32, 60, 28, 2, 7, 45, 9, 45),
(31, 61, 29, 0, 7, 45, 9, 45);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(30) NOT NULL,
  `teacher_id` int(30) NOT NULL,
  `user_id` int(50) NOT NULL,
  `subject_code` varchar(30) NOT NULL,
  `subject_name` varchar(60) NOT NULL,
  `l` int(15) NOT NULL DEFAULT '0',
  `c_taken` int(9) DEFAULT '0',
  `slack` decimal(9,0) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `teacher_id`, `user_id`, `subject_code`, `subject_name`, `l`, `c_taken`, `slack`) VALUES
(42, 28, 32, 'CSC-401', 'Information Technology', 13, 0, '0'),
(43, 0, 31, 'CSC-401', 'Bsc.CSIT', 13, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `user_id` int(30) NOT NULL,
  `teacher_id` int(30) NOT NULL,
  `teacher_code` varchar(30) NOT NULL,
  `teacher_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`user_id`, `teacher_id`, `teacher_code`, `teacher_name`) VALUES
(32, 28, 'KD1', 'keshav'),
(31, 29, 'KD1', 'Bsc.CSIT');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `uname` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `password`, `ip_address`, `date`, `time`, `username`, `email`, `uname`) VALUES
(26, '123', '::1', '2019-08-11', '05:55:20', 'sad', 's@gmail.com', 'sag'),
(27, 'qwerty', '::1', '2019-08-20', '18:34:12', 'Manil', 'wcrecent@gmail.com', 'Sagarmatha'),
(28, '202cb962ac59075b964b07152d234b70', '::1', '2019-08-21', '07:09:16', 'sag', 's@gmail.com', 'sagarmatha'),
(29, '202cb962ac59075b964b07152d234b70', '::1', '2019-08-21', '08:10:09', '123', 's@gmail.com', 'sag'),
(30, '202cb962ac59075b964b07152d234b70', '::1', '2019-08-21', '08:11:17', '42', 's@gmail.com', 'sag'),
(31, '123', '::1', '2019-08-21', '08:12:57', '43', 's@gmail.com', 'sag');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `freetime`
--
ALTER TABLE `freetime`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `freetime`
--
ALTER TABLE `freetime`
  MODIFY `time_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
