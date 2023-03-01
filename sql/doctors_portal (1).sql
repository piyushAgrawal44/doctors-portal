-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2023 at 01:24 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctors_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_schema`
--

CREATE TABLE `admin_schema` (
  `id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_schema`
--

INSERT INTO `admin_schema` (`id`, `fullname`, `email`, `password`, `created_datetime`, `status`) VALUES
(1, 'Piyush Goel', 'piyushbansal941@gmail.com', '$2y$10$SCouGGwC5NOtpXlB3VtDbuf7s1xjCmgqFp0gtUs1vg2oxTtYy9W5O', '2023-03-01 12:13:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `allotment_schema`
--

CREATE TABLE `allotment_schema` (
  `id` bigint(250) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `disease_name` text DEFAULT 'General Checkup',
  `appoitment_datetime` datetime DEFAULT NULL,
  `last_appointment_datetime` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '(0: Pending, 1: Treatment Completed, 2: Processing, 3: Hold)\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `allotment_schema`
--

INSERT INTO `allotment_schema` (`id`, `doctor_id`, `patient_id`, `disease_name`, `appoitment_datetime`, `last_appointment_datetime`, `status`) VALUES
(1, 1, 1, 'Fungus Infection', '0000-00-00 00:00:00', NULL, 3),
(2, 2, 1, 'Fungus Infection', '0000-00-00 00:00:00', NULL, 2),
(3, 2, 1, 'Fungus Infection', '2023-03-23 00:00:00', NULL, 0),
(4, 2, 1, 'Fungus Infection', '2023-03-23 15:16:00', NULL, 2),
(5, 2, 1, 'Fungus Infection', '2023-03-23 15:16:00', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schema`
--

CREATE TABLE `doctor_schema` (
  `id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `primary_contact_number` varchar(15) NOT NULL,
  `secondary_contact_number` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `adharcard_number` varchar(12) DEFAULT NULL,
  `pancard_number` varchar(20) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `speciality_id` int(11) DEFAULT NULL,
  `visit_time_from` time DEFAULT NULL,
  `visit_time_to` time DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_schema`
--

INSERT INTO `doctor_schema` (`id`, `fullname`, `email_id`, `primary_contact_number`, `secondary_contact_number`, `address`, `adharcard_number`, `pancard_number`, `joining_date`, `speciality_id`, `visit_time_from`, `visit_time_to`, `status`, `username`, `password`, `created_date`) VALUES
(1, 'DR. Piyush Agrawal', 'piyushagrawal43201@gmail.com', '07024975477', '', '', '', NULL, NULL, 0, '10:01:00', NULL, 1, 'piyushagrawal43201@gmail.com', '$2y$10$sNTb2zZG1WltB.Kcv1XgIO.ddfpOtYwfOPE3VKYWVPhgIKE2zmMXq', '2023-02-28 19:42:19'),
(2, 'DR.  Agrawal', 'xaamnm1nknk2nknkn21@gmail.com', '9024975477', '07829229201', 'saager', '2313131nb1', NULL, NULL, 10, '09:30:00', NULL, 1, 'xaamnm1nknk2nknkn21@gmail.com', '$2y$10$4mWnkdFoeCbpHmWQ5UNsfO31V5uUuj0cTEbxCLx2J06PKC51o1vNG', '2023-02-28 19:56:23');

-- --------------------------------------------------------

--
-- Table structure for table `patient_schema`
--

CREATE TABLE `patient_schema` (
  `id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `primary_contact_number` varchar(15) NOT NULL,
  `secondary_contact_number` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `adharcard_number` varchar(12) NOT NULL,
  `pancard_number` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_schema`
--

INSERT INTO `patient_schema` (`id`, `fullname`, `email_id`, `primary_contact_number`, `secondary_contact_number`, `address`, `adharcard_number`, `pancard_number`, `status`, `username`, `password`, `created_date`) VALUES
(1, 'Piyush Agrawal', 'piyushbansal941@gmail.com', '07024975478', '', 'raigarh', 'bnbabdbjbdjq', '', 1, 'piyushbansal941@gmail.com', '$2y$10$cFmowdeehP5OXhYPW0ma9OdAjz.jsZfyQjSankbvrueMgAwWpACvK', '2023-02-28 20:33:51');

-- --------------------------------------------------------

--
-- Table structure for table `speciality_schema`
--

CREATE TABLE `speciality_schema` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL DEFAULT 'General',
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `speciality_schema`
--

INSERT INTO `speciality_schema` (`id`, `title`, `status`) VALUES
(1, 'General', 1),
(8, 'Lungs', 1),
(9, 'Lungs', 1),
(10, 'Lungs', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_schema`
--
ALTER TABLE `admin_schema`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allotment_schema`
--
ALTER TABLE `allotment_schema`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_schema`
--
ALTER TABLE `doctor_schema`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `primary_contact_number` (`primary_contact_number`);

--
-- Indexes for table `patient_schema`
--
ALTER TABLE `patient_schema`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `primary_contact_number` (`primary_contact_number`);

--
-- Indexes for table `speciality_schema`
--
ALTER TABLE `speciality_schema`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_schema`
--
ALTER TABLE `admin_schema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `allotment_schema`
--
ALTER TABLE `allotment_schema`
  MODIFY `id` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doctor_schema`
--
ALTER TABLE `doctor_schema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient_schema`
--
ALTER TABLE `patient_schema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `speciality_schema`
--
ALTER TABLE `speciality_schema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
