-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 08:33 PM
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
-- Database: `health`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ambulances`
--

CREATE TABLE `ambulances` (
  `ambulance_id` int(11) NOT NULL,
  `driver_name` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `available` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ambulances`
--

INSERT INTO `ambulances` (`ambulance_id`, `driver_name`, `contact`, `available`) VALUES
(1, 'John Doe', '324235546', 0),
(2, 'Jane Smith', '987-654-3210', 0),
(4, 'Emily Browgsfdgn', '444-444-4444', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ambulance_bookings`
--

CREATE TABLE `ambulance_bookings` (
  `booking_id` int(11) NOT NULL,
  `ambulance_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `booking_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ambulance_bookings`
--

INSERT INTO `ambulance_bookings` (`booking_id`, `ambulance_id`, `patient_id`, `booking_time`) VALUES
(10, 1, 21, '2024-04-24 14:13:03'),
(11, 2, 12, '2024-04-24 13:16:48'),
(12, 3, 12, '2024-04-24 13:17:28'),
(13, 4, 12, '2024-04-24 13:18:53'),
(14, 2, 12, '2024-04-24 14:42:01');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `patient_id` int(11) NOT NULL,
  `Problem` text NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `doctor_id`, `name`, `patient_id`, `Problem`, `fee`, `date`, `time`) VALUES
(10, 5, 'tgffsdgd', 12, '0', 800.00, '2024-04-25', '13:39:00'),
(11, 5, 'Chandan', 12, '0', 800.00, '2024-04-19', '14:42:00'),
(12, 5, 'Aadrash', 12, '0', 800.00, '2024-04-26', '14:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `fee` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `user_id`, `name`, `specialization`, `phone`, `fee`) VALUES
(5, 11, 'Aadarsh Doctor', 'BDS', '09894402722', 800),
(7, 20, 'Dr. ABC', 'BDS', '09894402722', 500);

-- --------------------------------------------------------

--
-- Table structure for table `doctorspecialization`
--

CREATE TABLE `doctorspecialization` (
  `id` int(11) NOT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctorspecialization`
--

INSERT INTO `doctorspecialization` (`id`, `specialization`, `doctor_id`) VALUES
(1, 'Dentist', 5);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `height` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `sex` enum('Male','Female','Other') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `user_id`, `name`, `address`, `height`, `weight`, `phone`, `sex`) VALUES
(2, 12, 'CHnadna', 'Janakpur', 5.7, 86, '09894402722', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE `symptoms` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `condition_jaundice` varchar(50) DEFAULT NULL,
  `suggestion_jaundice` varchar(100) DEFAULT NULL,
  `condition_bp` varchar(50) DEFAULT NULL,
  `suggestion_bp` varchar(100) DEFAULT NULL,
  `condition_bloodsugar` varchar(50) DEFAULT NULL,
  `suggestion_bloodsugar` varchar(100) DEFAULT NULL,
  `condition_stroke` varchar(50) DEFAULT NULL,
  `suggestion_stroke` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`id`, `patient_id`, `condition_jaundice`, `suggestion_jaundice`, `condition_bp`, `suggestion_bp`, `condition_bloodsugar`, `suggestion_bloodsugar`, `condition_stroke`, `suggestion_stroke`) VALUES
(98, 21, 'Severe Jaundice', 'Jaundice Checker Suggestion: Might have severe Jaundice. Please consult a gastroenterologists or hep', 'Alert', 'High Blood Pressure Checker Suggestion: Stay careful and monitor your blood pressure. If condition w', 'high blood sugar', 'Blood Sugar Checker Suggestion: You currently have I high blood sugar. If you feel any discomfort co', 'normal', 'Stroke Checker Suggestion: You are normal. '),
(99, 21, 'No Jaundice', 'Jaundice Checker Suggestion: No symptoms of Jaundice detected.', 'Might have shortness in breathing / Asthma', 'High Blood Pressure Checker Suggestion: If regularly face this problem seek advice from an ENT Speci', 'high blood sugar', 'Blood Sugar Checker Suggestion: You currently have I high blood sugar. If you feel any discomfort co', 'normal', 'Stroke Checker Suggestion: You are normal. '),
(100, 21, 'No Jaundice', 'Jaundice Checker Suggestion: No symptoms of Jaundice detected.', 'Might have shortness in breathing / Asthma', 'High Blood Pressure Checker Suggestion: If regularly face this problem seek advice from an ENT Speci', 'normal', 'Blood Sugar Checker Suggestion: Your Sugar level is normal.', 'normal', 'Stroke Checker Suggestion: You are normal. '),
(101, 21, 'Severe Jaundice', 'Jaundice Checker Suggestion: Might have severe Jaundice. Please consult a gastroenterologists or hep', 'Alert', 'High Blood Pressure Checker Suggestion: Stay careful and monitor your blood pressure. If condition w', 'Diabetes', 'Blood Sugar Checker Suggestion: You might have diabetes. Visit a Endrocinologist specialized doctor ', 'stroke/paralysis', 'Stroke Checker Suggestion: You might have paralysis/stroke take emergency medical help. Neurologist/');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('doctor','patient','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin'),
(11, 'doctor@gmail.com', 'doctor', 'doctor'),
(12, 'patient@gmail.com', 'patient', 'patient'),
(15, 'asdfasd@gmail.com', 'admin', 'patient'),
(17, 'asdfassdasd@gmail.com', 'aasdasda', 'patient'),
(20, 'doctor1@gmail.com', 'doctor', 'doctor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `ambulances`
--
ALTER TABLE `ambulances`
  ADD PRIMARY KEY (`ambulance_id`);

--
-- Indexes for table `ambulance_bookings`
--
ALTER TABLE `ambulance_bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `ambulance_id` (`ambulance_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `doctorspecialization`
--
ALTER TABLE `doctorspecialization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ambulances`
--
ALTER TABLE `ambulances`
  MODIFY `ambulance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ambulance_bookings`
--
ALTER TABLE `ambulance_bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctorspecialization`
--
ALTER TABLE `doctorspecialization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctorspecialization`
--
ALTER TABLE `doctorspecialization`
  ADD CONSTRAINT `doctorspecialization_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patientss_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
