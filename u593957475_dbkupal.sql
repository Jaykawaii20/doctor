-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 10, 2024 at 08:17 AM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u593957475_dbkupal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `aemail` varchar(255) NOT NULL,
  `apassword` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `aemail`, `apassword`) VALUES
(1, 'staff@staff.com', '123'),
(2, 'super@admin.com', '123'),
(3, 'pharmacist@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `category` varchar(250) DEFAULT NULL,
  `appointname` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `datecreated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `category`, `appointname`, `date`, `status`, `datecreated`) VALUES
(16, 'Doctor', 'Consultation', '2024-10-04', 'appoint', '2024-10-26'),
(17, 'Nurse', 'Animal Bite', '2024-10-24', 'appoint', '2024-10-26'),
(18, 'Midwives', 'Family Planning', '2024-10-25', 'appoint', '2024-10-26'),
(19, 'Doctor', 'Consultation', '2024-10-26', 'appoint', '2024-10-26'),
(20, 'Doctor', 'Na yayay ako heart doc', '2024-10-26', 'appoint', '2024-10-29'),
(21, 'Doctor', 'Na yayay ako heart doc tabang', '2024-10-17', 'appoint', '2024-10-29'),
(22, 'Doctor', 'ere', '2024-11-01', 'appoint', '2024-11-01'),
(23, 'Midwives', 'ewtew', '2024-11-09', 'appoint', '2024-11-01'),
(24, 'Doctor', 'Consultation', '2024-11-08', 'appoint', '2024-11-08'),
(25, 'Doctor', 'Consultation', '2024-11-11', 'appoint', '2024-11-08'),
(26, 'Doctor', 'Consultation', '2024-11-12', 'appoint', '2024-11-08');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_patient`
--

CREATE TABLE `appointment_patient` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `appointmentname` varchar(255) DEFAULT NULL,
  `category` varchar(250) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `datecreated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_patient`
--

INSERT INTO `appointment_patient` (`id`, `pid`, `appointmentname`, `category`, `time`, `date`, `status`, `datecreated`) VALUES
(41, 35, 'Consultation', 'Doctor', '11:00:00', '2024-10-26', 'approved', '2024-10-29'),
(44, 35, 'Consultation', 'Doctor', '11:00:00', '2024-10-04', 'approved', '2024-10-29'),
(45, 35, 'Family Planning', 'Midwives', '16:00:00', '2024-10-25', 'approved', '2024-10-29'),
(47, 35, 'Consultation', 'Doctor', '16:00:00', '2024-10-04', 'disapproved', '2024-10-30'),
(48, 35, 'Consultation', 'Doctor', '16:00:00', '2024-10-04', 'disapproved', '2024-10-30'),
(50, 35, 'ewtew', 'Midwives', '16:00:00', '2024-11-09', 'approved', '2024-11-01'),
(51, 35, 'ere', 'Doctor', '16:00:00', '2024-11-01', 'disapproved', '2024-11-01'),
(52, 35, 'ewtew', 'Midwives', '16:00:00', '2024-11-09', 'disapproved', '2024-11-01'),
(53, 35, 'ere', 'Doctor', '16:00:00', '2024-11-01', 'approved', '2024-11-01'),
(54, 35, 'ere', 'Doctor', '16:00:00', '2024-11-01', 'disapproved', '2024-11-01'),
(55, 37, 'Consultation', 'Doctor', '09:00:00', '2024-11-08', 'approved', '2024-11-08'),
(56, 37, 'Consultation', 'Doctor', '12:00:00', '2024-11-11', 'disapproved', '2024-11-08'),
(57, 37, 'Consultation', 'Doctor', '11:00:00', '2024-11-12', 'approved', '2024-11-08');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `docid` int(11) NOT NULL,
  `docemail` varchar(255) DEFAULT NULL,
  `docname` varchar(255) DEFAULT NULL,
  `docpassword` varchar(255) DEFAULT NULL,
  `docnic` varchar(15) DEFAULT NULL,
  `doctel` varchar(15) DEFAULT NULL,
  `specialties` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`docid`, `docemail`, `docname`, `docpassword`, `docnic`, `doctel`, `specialties`) VALUES
(5, 'doc@gmail.com', 'doctor', '123', '123', '123', 12),
(6, 'nurse1@gmail.com', 'Nurse', '123456', '554656', '4645616', 1),
(7, 'nurse2@gmail.com', 'Nurse', '123', '3213213', '313132', 6),
(8, 'ericka@gmail.com', 'Nurse', '123456', '12565498', '21356556465465', 6),
(9, 'dong@gmail.com', 'Nurse', '123456', '52554', '54446565465', 1),
(10, 'dion@gmail.com', 'nurse', '123', '12365445', '3165456', 6),
(11, 'ding@gmail.com', 'nurse', '123', '12365445', '3165456', 6),
(12, 'markanthonysotonil03@gmail.com', 'nurse', '123', '1312', '3123', 1),
(13, 'markuser19@gmail.com', 'n', '123', '1312', '3123', 3),
(14, 'harry@gmail.com', 'Nurse', '123', '4563213', '35131', 2);

-- --------------------------------------------------------

--
-- Table structure for table `history_sheet`
--

CREATE TABLE `history_sheet` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` enum('Male','Female','Other') DEFAULT NULL,
  `cs` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contract_number` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `accompanied_by` varchar(255) DEFAULT NULL,
  `chief_complaints` text DEFAULT NULL,
  `history_present_illness` text DEFAULT NULL,
  `past_medical_history` text DEFAULT NULL,
  `hypertension` enum('yes','no') DEFAULT 'no',
  `hypertension_meds` varchar(255) DEFAULT NULL,
  `diabetes` enum('yes','no') DEFAULT 'no',
  `diabetes_meds` varchar(255) DEFAULT NULL,
  `asthma` enum('yes','no') DEFAULT 'no',
  `asthma_meds` varchar(255) DEFAULT NULL,
  `others` enum('yes','no') DEFAULT 'no',
  `others_meds` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `smoking` enum('yes','no') DEFAULT 'no',
  `pack_years` int(11) DEFAULT NULL,
  `alcohol` enum('yes','no') DEFAULT 'no',
  `alcohol_frequency` varchar(255) DEFAULT NULL,
  `others_social` enum('yes','no') DEFAULT 'no',
  `others_social_detail` varchar(255) DEFAULT NULL,
  `pediatric_feeding` enum('yes','no') DEFAULT 'no',
  `pediatric_feeding_others` varchar(255) DEFAULT NULL,
  `allergies_food` varchar(255) DEFAULT NULL,
  `allergies_drugs` varchar(255) DEFAULT NULL,
  `allergies_others` varchar(255) DEFAULT NULL,
  `lmp` varchar(255) DEFAULT NULL,
  `g` varchar(255) DEFAULT NULL,
  `p` varchar(255) DEFAULT NULL,
  `ob_others` varchar(255) DEFAULT NULL,
  `previous_surgeries` text DEFAULT NULL,
  `bcg` enum('yes','no') DEFAULT 'no',
  `dpt_polio` enum('yes','no') DEFAULT 'no',
  `hepatitis_b` enum('yes','no') DEFAULT 'no',
  `measles` enum('yes','no') DEFAULT 'no',
  `immunization_others` varchar(255) DEFAULT NULL,
  `altered_mental_sensorium` enum('yes','no') DEFAULT 'no',
  `pain` varchar(255) DEFAULT NULL,
  `history_category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_sheet`
--

INSERT INTO `history_sheet` (`id`, `patient_name`, `age`, `sex`, `cs`, `address`, `contract_number`, `religion`, `date_time`, `accompanied_by`, `chief_complaints`, `history_present_illness`, `past_medical_history`, `hypertension`, `hypertension_meds`, `diabetes`, `diabetes_meds`, `asthma`, `asthma_meds`, `others`, `others_meds`, `occupation`, `smoking`, `pack_years`, `alcohol`, `alcohol_frequency`, `others_social`, `others_social_detail`, `pediatric_feeding`, `pediatric_feeding_others`, `allergies_food`, `allergies_drugs`, `allergies_others`, `lmp`, `g`, `p`, `ob_others`, `previous_surgeries`, `bcg`, `dpt_polio`, `hepatitis_b`, `measles`, `immunization_others`, `altered_mental_sensorium`, `pain`, `history_category`) VALUES
(8, 'asd', 12, '', '', '', '', '', '0000-00-00 00:00:00', '', '', '', '', 'no', '', 'no', '', 'no', '', 'yes', '', '', 'no', 0, 'no', '', 'no', '', 'no', '', '', '', '', '', '', '', '', '', 'no', 'no', 'no', 'no', '', 'no', '', 'adult'),
(9, 'mark', 21, 'Male', 'fdsfds', 'gdsgsdg', '12412', 'dfsf', '2024-07-06 22:20:00', 'sdgsdgds', 'gsdgsd', NULL, NULL, 'yes', 'gdsg', 'yes', 'gsdgsd', 'no', NULL, 'no', NULL, 'gsdgsd', 'yes', 324, 'no', NULL, 'no', NULL, 'no', NULL, 'gdsgfs', 'dgsdgsd', 'gdsgsd', NULL, NULL, NULL, NULL, NULL, 'no', 'no', 'no', 'no', NULL, 'no', NULL, 'adult'),
(10, 'fdsgf', 21, '', 'gdfgfd', 'hdfhfd', 'ghghgh', 'ghgh', '2024-11-06 22:30:00', 'fdsfsd', 'gdsg', '', '', 'yes', 'gdsg', 'no', 'gsdg', 'no', '', 'no', '', 'gdsg', 'yes', 0, 'no', '', 'no', '', 'no', '', 'gsdgsd', 'gsdgsd', 'gsdgsd', '', '', '', '', '', 'no', 'no', 'no', 'no', '', 'yes', '', 'adult'),
(11, 'sotonil', 123, 'Male', 'fsdf', 'dsfdsf', 'fdsfds', '', '2024-10-18 22:37:00', 'fdsfsd', 'fdsfds', '', '', 'yes', 'fdsfds', 'yes', 'fdsf', 'no', '', 'no', '', 'fdsfdsf', 'yes', 34, 'no', '', 'no', '', 'no', '', 'gdsgfs', 'efdfsfd', 'fdsfsd', '', '', '', '', '', 'no', 'no', 'no', 'no', '', 'no', '', 'adult'),
(12, 'Edmar Tecson Raman', 21, 'Male', '214124214', 'uson phase 4', '09669125095', 'catholic', '2024-11-08 17:07:00', 'Dr. Ceasar', 'asfsdfjsjb', '', '', 'yes', 'Paracetamol', 'yes', 'dsfd', 'no', '', 'no', '', 'welder', 'yes', 5, 'no', '', 'no', '', 'no', '', 'n/a', 'dsad', 'sdfs', '', '', '', '', '', 'no', 'no', 'no', 'no', '', 'yes', '', 'adult');

-- --------------------------------------------------------

--
-- Table structure for table `medecine`
--

CREATE TABLE `medecine` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `midwives`
--

CREATE TABLE `midwives` (
  `midwife_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('midwife') DEFAULT 'midwife',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `midwives`
--

INSERT INTO `midwives` (`midwife_id`, `fullname`, `username`, `phone_no`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'midwives', 'mid', '0928882734', 'mid@gmail.com', '$2y$10$P/My/UWsYk531RvCzYY/DONk47J0.dhAm9.iVtHyu7n/KBH5tVVSK', 'midwife', '2024-10-21 05:46:50'),
(2, 'midwives', 'mid1@gmail.com', '09946770631', 'mid1@gmail.com', '123', 'midwife', '2024-10-21 06:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `midwivesappointment`
--

CREATE TABLE `midwivesappointment` (
  `appointment_id` int(11) NOT NULL,
  `midwife_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nurses`
--

CREATE TABLE `nurses` (
  `nurse_id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `nphone_no` varchar(15) DEFAULT NULL,
  `nnic` varchar(15) DEFAULT NULL,
  `nemail` varchar(100) DEFAULT NULL,
  `npassword` varchar(255) DEFAULT NULL,
  `specialties` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nurses`
--

INSERT INTO `nurses` (`nurse_id`, `fullname`, `nphone_no`, `nnic`, `nemail`, `npassword`, `specialties`) VALUES
(14, 'blass', '', NULL, '121113@122222.com', '$2y$10$n1/kqUt0CgelIpBrLUaT7uGUyK3hdxXDy/TXJHmCWVpc7iLvDw9HO', NULL),
(15, 'buwe', '', NULL, 'buwwwe@gmail.com', '$2y$10$oOtil165KRlmlol67mIl2uoB3NNo8KPfvoolNcCvnlV2K94CDhnVq', NULL),
(16, 'bogart', '', NULL, 'bogart@gmail.com', '$2y$10$OWw0WFaoZfimNNGh9BbN7urcMRHobUI9bIho7ag2Mz5Nk16zHqbTW', NULL),
(18, 'pull', '', NULL, 'pull@gmail.com', '$2y$10$eypKPw70UBx9Af.9BRJwS.y4hR/ZVjah1DAGAieZb.R5Wuv7zPjlq', NULL),
(19, 'nurse lab', '0928882734', NULL, 'nurse@gmail.com', '123', NULL),
(20, 'Nurse', '313132', '3213213', NULL, '123', 6),
(22, 'Nurse', '54446565465', '52554', 'dong@gmail.com', '123456', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pid` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `Gender` varchar(100) NOT NULL,
  `civil` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `weight` varchar(200) DEFAULT NULL,
  `height` varchar(200) DEFAULT NULL,
  `bp` varchar(100) NOT NULL,
  `temp` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL DEFAULT 'patient',
  `status` varchar(50) DEFAULT NULL,
  `refer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `email`, `name`, `middlename`, `lastname`, `password`, `address`, `Gender`, `civil`, `age`, `birthdate`, `weight`, `height`, `bp`, `temp`, `user_type`, `status`, `refer`) VALUES
(28, 'mike00@gmail.com', 'mike', 'bucani', 'subaldo', '$2y$10$pX2F4a92CRYUmVIUyf7PAOWYKz.aSF.1mA7osujgqTfyULLK75aNq', 'USON PHASE 4 PUROK 23', 'Male', 'single', '22', '2002-02-12', '12', '12', '12', '13', 'patient', NULL, ''),
(29, 'jacob@gmail.com', 'Trishia', 'Jacob', 'Senerez', '123', 'Lagao', 'Male', 'single', '21', '2003-08-29', NULL, NULL, '', '', 'patient', NULL, ''),
(30, 'cj@gmail.com', 'Christian', 'Jay', 'Dela Pena', '123', 'Mabuhay', 'Male', 'single', '21', '2003-02-01', NULL, NULL, '', '', 'patient', NULL, ''),
(31, 'edmarraman09@gmail.com', 'ejay', 'tecson', 'raman', '123', 'USON PHASE 4 PUROK 23', 'Male', 'single', '21', '2002-12-29', NULL, NULL, '', '', 'patient', NULL, ''),
(32, 'jasper@gmail.com', 'Jasper', 'tanteo', 'Cagoliodo', '123', 'purok bawing', 'Male', 'single', '24', '2000-05-23', NULL, NULL, '', '', 'patient', NULL, ''),
(33, 'notkingkey11@gmail.com', 'Kingkey ', 'Trazo', 'Padios', '123', 'heyhey', 'Male', 'single', '21', '2003-08-22', NULL, NULL, '', '', 'patient', NULL, ''),
(34, 'hoy@gmail.com', 'Billie ', 'Cagoliodo', 'Eilish', '123', 'bawing', 'Male', 'single', '21', '2003-08-29', NULL, NULL, '', '', 'patient', NULL, ''),
(35, 'mark@gmail.com', 'MarkanthonySotonil', 'gabalo', 'sotonil', '123', 'purok9 katanggawan', 'Male', 'single', '21', '2003-02-03', NULL, NULL, '', '', 'patient', NULL, ''),
(36, 'markuser1@gmail.com', 'MarkanthonySotonil', 'gabalo', 'sotonil', '123', 'purok9 katanggawan', 'Male', 'single', '21', '2003-01-08', NULL, NULL, '', '', 'patient', NULL, ''),
(37, 'jas@gmail.com', 'jas', 'Gimotea', 'Cagoliodo', '123', 'bawing', 'Male', 'single', '25', '1999-05-26', NULL, NULL, '', '', 'patient', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `patient_walkin`
--

CREATE TABLE `patient_walkin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `bp` varchar(20) DEFAULT NULL,
  `temp` varchar(20) DEFAULT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `height` varchar(20) DEFAULT NULL,
  `session_category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_walkin`
--

INSERT INTO `patient_walkin` (`id`, `name`, `middlename`, `lastname`, `birthdate`, `address`, `age`, `civil_status`, `gender`, `bp`, `temp`, `weight`, `height`, `session_category`) VALUES
(8, 'mark', 'gabalo', 'sotonil', '2003-03-19', 'katanggawan', 19, 'single', 'male', '10', '120', '3123', '1232', 'doctor'),
(9, 'mark', '123', 'sotonil', '2003-03-19', 'purok9 katanggawan', 21, 'single', 'male', '10', '120', '3123', '1232', 'doctor'),
(10, 'mark', 'gabalo', '123', '2024-11-01', '123', 123, '3123', 'male', 'dsff', 'sgds', 'gsdg', 'gsdg', 'doctor'),
(11, 'Edmar', 'tecson', 'Raman', '2002-04-23', 'USON PHASE 4 PUROK 23', 21, 'Married', 'male', '120', '35', '60', '168', 'doctor'),
(12, 'ceasar', 'Gimotea', 'Raman', '2002-04-23', 'Lagao', 21, 'Married', 'male', '120', '35', '60', '168', 'doctor');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleid` int(11) NOT NULL,
  `docid` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `scheduledate` date DEFAULT NULL,
  `scheduletime` time DEFAULT NULL,
  `nop` int(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `docid`, `title`, `scheduledate`, `scheduletime`, `nop`) VALUES
(1, '1', 'Test Session', '2050-01-01', '18:00:00', 50),
(9, '3', 'Kupal session', '2024-09-28', '07:30:00', 10),
(10, '2', 'Kupal kaba', '2024-10-18', '14:03:00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

CREATE TABLE `specialties` (
  `id` int(2) NOT NULL,
  `sname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`id`, `sname`) VALUES
(1, 'Animal Bite'),
(2, 'Consultation'),
(3, 'Prenatal'),
(6, 'Immunization');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `phoneno` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `phoneno`, `email`, `password`, `user_type`) VALUES
(1, 'staff', 'staff01', '', 'staff01@gmail.com', '202cb962ac59075b964b07152d234b70', 'staff'),
(2, 'admin', 'admin1', '', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(3, 'midwife', 'midwife', '', 'midwife@gmail.com', '202cb962ac59075b964b07152d234b70', 'midwife'),
(4, 'pharmacist', 'phar1', '1232423532543', 'par1@gmail.com', '123', 'ph');

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

CREATE TABLE `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('staff@staff.com', 'a'),
('super@admin.com', 's'),
('nurse@gmail.com', 'n'),
('mid@gmail.com', 'm'),
('edmarraman09@gmail.com', 'p'),
('mike00@gmail.com', 'p'),
('jacob@gmail.com', 'p'),
('cj@gmail.com', 'p'),
('midhey@gmail.com', 'm'),
('doc@gmail.com', 'd'),
('pharmacist@gmail.com', 'p'),
('hoy@gmail.com', 'p'),
('nurse1@gmail.com', 'd'),
('nurse2@gmail.com', 'd'),
('ericka@gmail.com', 'd'),
('dong@gmail.com', 'd'),
('dion@gmail.com', 'd'),
('ding@gmail.com', 'd'),
('markuser19@gmail.com', 'd'),
('harry@gmail.com', 'd'),
('jas@gmail.com', 'p');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);
ALTER TABLE `admin` ADD FULLTEXT KEY `aemail` (`aemail`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment_patient`
--
ALTER TABLE `appointment_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`docid`),
  ADD KEY `specialties` (`specialties`);

--
-- Indexes for table `history_sheet`
--
ALTER TABLE `history_sheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medecine`
--
ALTER TABLE `medecine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `midwives`
--
ALTER TABLE `midwives`
  ADD PRIMARY KEY (`midwife_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `midwivesappointment`
--
ALTER TABLE `midwivesappointment`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `nurses`
--
ALTER TABLE `nurses`
  ADD PRIMARY KEY (`nurse_id`),
  ADD UNIQUE KEY `email` (`nemail`),
  ADD UNIQUE KEY `specialties` (`specialties`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `patient_walkin`
--
ALTER TABLE `patient_walkin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleid`),
  ADD KEY `docid` (`docid`);

--
-- Indexes for table `specialties`
--
ALTER TABLE `specialties`
  ADD UNIQUE KEY `Spe` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webuser`
--
ALTER TABLE `webuser`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `appointment_patient`
--
ALTER TABLE `appointment_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `docid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `history_sheet`
--
ALTER TABLE `history_sheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `medecine`
--
ALTER TABLE `medecine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `midwives`
--
ALTER TABLE `midwives`
  MODIFY `midwife_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `midwivesappointment`
--
ALTER TABLE `midwivesappointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nurses`
--
ALTER TABLE `nurses`
  MODIFY `nurse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `patient_walkin`
--
ALTER TABLE `patient_walkin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
