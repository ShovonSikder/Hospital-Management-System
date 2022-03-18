-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2021 at 05:44 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `first_name`, `last_name`, `address`, `dob`, `phone`, `gmail`, `password`) VALUES
('ad_0', 'Shovon', 'Sikder', 'Mirpur,Dhaka', '2000-11-30', '01706961289', 'shovon@gmail.com', 'shovon123');

-- --------------------------------------------------------

--
-- Table structure for table `admits`
--

CREATE TABLE `admits` (
  `pt_id` varchar(255) NOT NULL,
  `room_no` varchar(255) NOT NULL,
  `admit_date` date NOT NULL,
  `doc_ref` varchar(255) NOT NULL,
  `diss_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admits`
--

INSERT INTO `admits` (`pt_id`, `room_no`, `admit_date`, `doc_ref`, `diss_name`) VALUES
('pt_0', 'R200', '2021-04-30', 'doc_0', 'Covid');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `pt_id` varchar(255) NOT NULL,
  `doc_id` varchar(255) NOT NULL,
  `ap_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_no` int(200) NOT NULL,
  `pt_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid_date` date DEFAULT NULL,
  `statuss` varchar(255) DEFAULT 'Due',
  `cause` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_no`, `pt_id`, `amount`, `paid_date`, `statuss`, `cause`) VALUES
(1, 'pt_0', '1800.00', '2021-06-06', 'Paid', 'Admitted fee'),
(2, 'pt_0', '2000.00', '2021-07-07', 'Paid', 'Lab fee'),
(4, 'pt_0', '3900.00', '2021-02-02', 'Paid', 'Visit fee'),
(7, 'pt_0', '3000.00', '2021-04-30', 'Paid', 'Admit fee'),
(8, 'pt_3', '2000.00', '2021-04-30', 'Due', 'ICU fee');

-- --------------------------------------------------------

--
-- Table structure for table `diseases`
--

CREATE TABLE `diseases` (
  `diss_name` varchar(255) NOT NULL,
  `diss_details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diseases`
--

INSERT INTO `diseases` (`diss_name`, `diss_details`) VALUES
('Cancer', 'Dangerous disease'),
('Covid', 'Pain, Cough and fever'),
('Fever', 'High temperature, little pain');

-- --------------------------------------------------------

--
-- Table structure for table `dissexprt`
--

CREATE TABLE `dissexprt` (
  `diss_name` varchar(255) NOT NULL,
  `doc_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dissexprt`
--

INSERT INTO `dissexprt` (`diss_name`, `doc_id`) VALUES
('Cancer', 'doc_0'),
('Covid', 'doc_0'),
('Fever', 'doc_0');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doc_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doc_id`, `first_name`, `last_name`, `address`, `dob`, `gender`, `phone`, `gmail`, `password`) VALUES
('doc_0', 'Anisur', 'Rahman', 'Dhaka', '2000-11-11', 'Male', '01706961289', 'anis@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `idgenerator`
--

CREATE TABLE `idgenerator` (
  `pt_count` int(200) NOT NULL DEFAULT 0,
  `doc_count` int(200) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `idgenerator`
--

INSERT INTO `idgenerator` (`pt_count`, `doc_count`) VALUES
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `pt_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`pt_id`, `first_name`, `last_name`, `address`, `dob`, `gender`, `phone`, `gmail`, `password`) VALUES
('pt_0', 'Shovon', 'Sikder', 'Dhaka', '2000-11-30', 'Male', '01706961289', 'shovon@gmail.com', '123456'),
('pt_3', 'Nazmul', 'Hasan', 'Dhaka', '1987-11-20', 'Male', '01706961289', 'nazmul@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_no` varchar(255) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `cost_day` decimal(8,2) NOT NULL DEFAULT 0.00,
  `capacity` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_no`, `room_type`, `cost_day`, `capacity`) VALUES
('R100', 'Normal', '1000.00', 20),
('R200', 'ICU', '2000.00', 1),
('R300', 'Normal', '400.00', 25),
('R500', 'Beds', '500.00', 15);

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `visit_id` int(11) NOT NULL,
  `pt_id` varchar(255) NOT NULL,
  `doc_id` varchar(255) NOT NULL,
  `visit_date` date NOT NULL,
  `diss_name` varchar(255) NOT NULL,
  `suggestions` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`visit_id`, `pt_id`, `doc_id`, `visit_date`, `diss_name`, `suggestions`) VALUES
(2, 'pt_0', 'doc_0', '2021-04-30', 'Fever', 'Follow instructions'),
(3, 'pt_3', 'doc_0', '2021-05-30', 'Covid', 'Stay home');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admits`
--
ALTER TABLE `admits`
  ADD PRIMARY KEY (`pt_id`),
  ADD KEY `room_no` (`room_no`),
  ADD KEY `doc_ref` (`doc_ref`),
  ADD KEY `diss_name` (`diss_name`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`pt_id`,`doc_id`),
  ADD KEY `doc_id` (`doc_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_no`),
  ADD KEY `pt_id` (`pt_id`);

--
-- Indexes for table `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`diss_name`);

--
-- Indexes for table `dissexprt`
--
ALTER TABLE `dissexprt`
  ADD PRIMARY KEY (`diss_name`,`doc_id`),
  ADD KEY `doc_id` (`doc_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`pt_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_no`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`visit_id`),
  ADD KEY `pt_id` (`pt_id`),
  ADD KEY `doc_id` (`doc_id`),
  ADD KEY `diss_name` (`diss_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_no` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admits`
--
ALTER TABLE `admits`
  ADD CONSTRAINT `admits_ibfk_1` FOREIGN KEY (`pt_id`) REFERENCES `patients` (`pt_id`),
  ADD CONSTRAINT `admits_ibfk_2` FOREIGN KEY (`room_no`) REFERENCES `rooms` (`room_no`),
  ADD CONSTRAINT `admits_ibfk_3` FOREIGN KEY (`doc_ref`) REFERENCES `doctors` (`doc_id`),
  ADD CONSTRAINT `admits_ibfk_4` FOREIGN KEY (`diss_name`) REFERENCES `diseases` (`diss_name`);

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`pt_id`) REFERENCES `patients` (`pt_id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doc_id`) REFERENCES `doctors` (`doc_id`);

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`pt_id`) REFERENCES `patients` (`pt_id`);

--
-- Constraints for table `dissexprt`
--
ALTER TABLE `dissexprt`
  ADD CONSTRAINT `dissexprt_ibfk_1` FOREIGN KEY (`diss_name`) REFERENCES `diseases` (`diss_name`),
  ADD CONSTRAINT `dissexprt_ibfk_2` FOREIGN KEY (`doc_id`) REFERENCES `doctors` (`doc_id`);

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_ibfk_1` FOREIGN KEY (`pt_id`) REFERENCES `patients` (`pt_id`),
  ADD CONSTRAINT `visits_ibfk_2` FOREIGN KEY (`doc_id`) REFERENCES `doctors` (`doc_id`),
  ADD CONSTRAINT `visits_ibfk_3` FOREIGN KEY (`diss_name`) REFERENCES `diseases` (`diss_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
