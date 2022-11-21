-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2022 at 06:43 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prashant_kapse`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `companyID` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `website` varchar(50) NOT NULL,
  `address` longtext NOT NULL,
  `photo` varchar(300) NOT NULL COMMENT '(admin->0,employee->1)',
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `login_type` int(11) NOT NULL COMMENT '(admin->0,company->1)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyID`, `company_name`, `phone`, `website`, `address`, `photo`, `email`, `password`, `status`, `login_type`) VALUES
(1, 'Super Admin', '', '', '', '', 'admin@admin.com', '$2y$10$xcPJt0bluHZ4kFup20EKleW4GdWmNPrqJn/snfEqjizjHoM2fwAZa', 0, 0),
(2, 'Global Tech', '9595288445', 'www.globaltecg.co.in', 'At Nagpur', 'assets/uploads/company/1668946272.test.jpeg', 'infotechngp@gmail.co.in', '$2y$10$xcPJt0bluHZ4kFup20EKleW4GdWmNPrqJn/snfEqjizjHoM2fwAZa', 0, 1),
(3, 'sandisk', '9595265616', 'www.sadisco.com', 'at nagar', 'assets/uploads/company/1668952161.fake_barcode.png', 'infotech@gmail.com', '$2y$10$nwA0s0uEM9be1mlLI6qpj.HLgMYRUgjghJICbWP/KTEOik7TsUe9C', 1, 1),
(5, 'Global Technew', '8378849860', 'www.sadisco.com', 'new colony,new delhi', 'assets/uploads/company/1668975002.fake_barcode.png', 'infotechngp@gmail.com', '$2y$10$V9kX7Tbkxwg2qO8NaWLEQeT3zRj1L5wxn9lQIu0VYHWsHyBNJkICi', 0, 1),
(6, 'New Company', '7845961235', 'www.get.com', 'at new', 'assets/uploads/company/1669007995.bffb720b305572eb664c22506ef6bcdc.png', 'test@gmail.com', '$2y$10$dreqrS5ToAKGLrNNXyHhvefVBaD3Ao3sjNO7.UNmSjQQIT0ATQteO', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contactID` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` longtext NOT NULL,
  `photo` varchar(300) NOT NULL COMMENT '(admin->0,employee->1)',
  `email` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contactID`, `first_name`, `phone`, `last_name`, `address`, `photo`, `email`, `status`, `company_id`) VALUES
(1, 'Prashant', '709697994', 'Kapse', 'H No.294, Hinganghat', 'assets/uploads/contact/1668947857.test.jpeg', 'pkapse7@gmail.com', 0, 2),
(3, 'Priyankardgdfgfg', '8585857878', 'Patil', 'at Sonegaon', 'assets/uploads/company/1668952032.fake_barcode.png', 'priyanka@gmail.com', 0, 3),
(4, 'test', '2525252525', 'new', 'gdfgdfdg', 'assets/uploads/company/1668970503.bffb720b305572eb664c22506ef6bcdc.png', 'test@gmail.com', 0, 3),
(5, 'tttttt', '8585857877', 'eeeeeee', 'H No.294, Near Durga Mata Ma', 'assets/uploads/contact/1668969841.bffb720b305572eb664c22506ef6bcdc.png', 'pkapse7@gmail.co', 0, 3),
(7, 'nre', '6515161616', 'jhjv', 'hohihihih', 'assets/uploads/contact/1669008254.bffb720b305572eb664c22506ef6bcdc.png', 'jgjvbjvb@gmail.com', 0, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyID`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contactID`),
  ADD KEY `company_id` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `companyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`companyID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
