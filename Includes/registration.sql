-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2020 at 06:45 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `course` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `year_level` varchar(200) NOT NULL,
  `status` text NOT NULL,
  `requirement` text NOT NULL,
  `entry` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `course`, `email`, `year_level`, `status`, `requirement`, `entry`) VALUES
(326065, 'Gerald', 'Minoza', 'Computer Science', 'geryel09@gmail.com', '1st', 'Transferee', 'Completed', ''),
(3266464, 'Jairus James', 'Lucero', 'Computer Science', 'jairus@gmail.com', '1st', 'Regular', 'Completed', 'Form-137'),
(5612132, 'Kaiser Tambok', 'Sibi', 'Computer Science', 'kaiser@gmail.com', '1st', 'Transferee', 'Completed', ''),
(98963231, 'Mary Kia', 'Laugan', 'Entrep', 'marykia@yahoo.com', '1st', 'Regular ', 'UC ML', 'NSO, Form-137');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `registration_id` int(11) NOT NULL,
  `subject_code` varchar(200) NOT NULL,
  `title` text NOT NULL,
  `units` int(11) NOT NULL,
  `grade` float NOT NULL,
  `teacher` text NOT NULL,
  `year` varchar(20) NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` text NOT NULL,
  `remarks` text NOT NULL,
  `sem` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`registration_id`, `subject_code`, `title`, `units`, `grade`, `teacher`, `year`, `student_id`, `status`, `remarks`, `sem`) VALUES
(1, 'SCS 411', 'Software Engineering', 4, 0, 'Mr: Balingit', '2019-2020', 326065, 'On-going', '', '2nd'),
(2, 'ELE 002', 'E-commerce', 3, 2.24, 'Ms: Francis', '2019-2020', 326065, 'Taken', 'Passed', '1st');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `username`, `password`) VALUES
(1, 'Ailyn ', 'Abordo', 'ailynabordo@yahoo.com', 'admin', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`registration_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
