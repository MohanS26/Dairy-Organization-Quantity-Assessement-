-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 06:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dairy`
--

-- --------------------------------------------------------

--
-- Table structure for table `corporate`
--

CREATE TABLE `corporate` (
  `id` int(11) NOT NULL,
  `trn_date` datetime NOT NULL,
  `corporateno` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `phoneno` bigint(50) NOT NULL,
  `fat_content` varchar(50) NOT NULL,
  `quantity` bigint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `corporate`
--

INSERT INTO `corporate` (`id`, `trn_date`, `corporateno`, `name`, `address`, `date`, `phoneno`, `fat_content`, `quantity`) VALUES
(1, '2024-01-01 20:00:16', '201', 'Smith', 'No 310 Lawspet', '2023-12-22', 987654321, '6', 8),
(2, '2024-01-01 20:20:10', '202', 'Selvam', 'No 330 Iyyankuttipalayam', '2023-12-22', 987654321, '6', 10),
(3, '2024-01-01 21:11:07', '203', 'Dinesh', 'No 567 Mettupalayam', '2023-12-22', 987654321, '6', 10),
(4, '2024-01-05 09:31:54', '203', 'Dinesh', 'No 567 Mettupalayam', '2023-12-25', 987656780, '6', 15),
(5, '2024-01-06 21:49:32', '202', 'Selvam', 'No 330 Iyyankuttipalayam', '2023-12-27', 987656780, '6', 4),
(6, '2024-01-06 22:28:30', '201', 'Smith', 'No 310 Lawspet', '2023-12-27', 987654321, '6', 13),
(7, '2024-01-08 18:11:26', '201', 'Smith', 'No 310 Lawspet', '2024-01-08', 987654321, '', 10),
(8, '2024-01-08 18:15:02', '202', 'Selvam', 'No 330 Iyyankuttipalayam', '2024-01-08', 987654321, '', 8),
(9, '2024-01-08 18:18:13', '203', 'Dinesh', 'No 567 Mettupalayam', '2024-01-08', 987654321, '', 5),
(11, '2024-01-16 09:36:40', '202', 'Selvam', 'No 330 Iyyankuttipalayam', '2024-01-16', 9876543216, '', 8),
(12, '2024-01-16 14:31:24', '201', 'Smith', 'No 310 Lawspet', '2024-01-16', 9876543216, '', 10),
(13, '2024-01-16 14:33:08', '203', 'Dinesh', 'No 567  Mettupalayam', '2024-01-16', 9876543214, '', 8),
(14, '2024-01-19 19:20:54', '201', 'Smith', 'No 310 Lawspet', '2024-01-19', 9876543214, '', 8),
(16, '2024-01-19 19:22:37', '202', 'Selvam', 'No 330 Iyyankuttipalayam', '2024-01-19', 9876543214, '', 10),
(17, '2024-01-19 19:25:53', '203', 'Dinesh', 'No 567  Mettupalayam', '2024-01-19', 9876543212, '', 10),
(19, '2024-01-22 18:35:33', '203', 'Dinesh', 'No 567  Mettupalayam', '2024-01-22', 9876543219, '', 10),
(20, '2024-01-22 18:36:15', '201', 'Smith', 'No 310 Lawspet', '2024-01-22', 9876543214, '', 13),
(21, '2024-01-22 18:39:41', '202', 'Selvam', 'No 330 Iyyankuttipalayam', '2024-01-22', 9876543213, '', 11),
(22, '2024-01-24 06:58:20', '201', 'Smith', 'No 310 Lawspet', '2024-01-24', 9876543219, '', 8),
(23, '2024-01-24 07:07:31', '203', 'Dinesh', 'No 567  Mettupalayam', '2024-01-24', 9876543219, '', 4),
(25, '2024-01-28 18:55:54', '201', 'Smith', 'No 310 Lawspet', '2024-01-28', 9876543216, '6', 8),
(26, '2024-01-28 19:11:11', '202', 'Selvam', 'No 330 Iyyankuttipalayam', '2024-01-24', 9876567895, '4', 8),
(27, '2024-01-30 11:50:58', '201', 'Smith', 'No 310 Lawspet', '2024-01-30', 9876543216, '6', 8),
(28, '2024-02-04 15:30:43', '201', 'Smith', 'No 310 Lawspet', '2024-02-04', 9876543216, '6', 10),
(29, '2024-02-04 15:31:22', '202', 'Selvam', 'No 330 Iyyankuttipalayam', '2024-02-04', 9876543216, '4', 13),
(30, '2024-02-04 15:32:57', '203', 'Dinesh', 'No 567  Mettupalayam', '2024-02-04', 9876543219, '6', 10),
(31, '2024-02-05 07:51:41', '201', 'Smith', 'No 310 Lawspet', '2024-02-03', 9876543216, '6', 10),
(32, '2024-02-05 07:57:28', '202', 'Selvam', 'No 330 Iyyankuttipalayam', '2024-02-03', 9876543219, '4', 10),
(33, '2024-02-05 08:03:48', '203', 'Dinesh', 'No 567  Mettupalayam', '2024-02-03', 9876543216, '4', 6),
(34, '2024-02-05 08:16:24', '201', 'Smith', 'No 310 Lawspet', '2024-02-05', 9876543216, '6', 10),
(35, '2024-02-05 08:20:41', '203', 'Dinesh', 'No 330 Iyyankuttipalayam', '2024-02-05', 9876543216, '4', 10),
(36, '2024-03-02 06:18:14', '201', 'Smith', 'No 310 Lawspet', '2024-03-02', 9876543216, '6', 8);

-- --------------------------------------------------------

--
-- Table structure for table `corporatechecking`
--

CREATE TABLE `corporatechecking` (
  `id` int(11) NOT NULL,
  `corporateno` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` date DEFAULT NULL,
  `fat_content` decimal(5,2) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `profit_percentage` decimal(5,2) NOT NULL,
  `final_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `corporatechecking`
--

INSERT INTO `corporatechecking` (`id`, `corporateno`, `name`, `date`, `fat_content`, `quantity`, `price`, `profit_percentage`, `final_price`) VALUES
(1, '201', 'Smith', '2023-12-22', 6.00, 8.00, 311.20, 6.00, 329.87),
(2, '202', 'Selvam', '2023-12-22', 6.00, 10.00, 389.00, 6.00, 412.34),
(3, '203', 'Dinesh', '2023-12-22', 6.00, 10.00, 389.00, 6.00, 412.34),
(5, '201', 'Smith', '2023-12-27', 6.00, 13.00, 505.70, 8.00, 546.16),
(6, '202', 'Selvam', '2023-12-27', 6.00, 4.00, 155.60, 8.00, 168.05),
(10, '201', 'Smith', '2024-01-08', 6.00, 10.00, 389.00, 8.00, 420.12),
(11, '202', 'Selvam', '2024-01-08', 6.00, 8.00, 311.20, 8.00, 336.10),
(12, '203', 'Dinesh', '2024-01-08', 6.00, 5.00, 194.50, 8.00, 210.06),
(17, '202', 'Selvam', '2024-01-16', 6.00, 8.00, 311.20, 8.00, 336.10),
(18, '201', 'Smith', '2024-01-16', 6.00, 10.00, 389.00, 8.00, 420.12),
(19, '203', 'Dinesh', '2024-01-16', 6.00, 8.00, 311.20, 8.00, 336.10),
(20, '201', 'Smith', '2024-01-19', 6.00, 8.00, 311.20, 8.00, 336.10),
(21, '202', 'Selvam', '2024-01-19', 6.00, 10.00, 389.00, 8.00, 420.12),
(22, '203', 'Dinesh', '2024-01-19', 6.00, 10.00, 389.00, 8.00, 420.12),
(23, '203', 'Dinesh', '2024-01-22', 6.00, 10.00, 389.00, 8.00, 420.12),
(24, '201', 'Smith', '2024-01-22', 6.00, 13.00, 505.70, 8.00, 546.16),
(25, '202', 'Selvam', '2024-01-22', 6.00, 11.00, 427.90, 8.00, 462.13),
(26, '201', 'Smith', '2024-01-24', 6.00, 8.00, 311.20, 8.00, 336.10),
(27, '203', 'Dinesh', '2024-01-24', 6.00, 4.00, 155.60, 8.00, 168.05),
(28, '201', 'Smith', '2024-01-28', 6.00, 8.00, 311.20, 8.00, 336.10),
(30, '202', 'Selvam', '2024-01-24', 4.00, 8.00, 290.40, 8.00, 313.63),
(34, '203', 'Dinesh', '2023-12-25', 6.00, 15.00, 583.50, 8.00, 630.18),
(35, '201', 'Smith', '2024-01-30', 6.00, 8.00, 311.20, 8.00, 336.10),
(36, '202', 'Selvam', '2024-02-04', 4.00, 13.00, 471.90, 8.00, 509.65),
(38, '201', 'Smith', '2024-02-04', 6.00, 10.00, 389.00, 8.00, 420.12),
(39, '203', 'Dinesh', '2024-02-04', 6.00, 10.00, 389.00, 8.00, 420.12),
(40, '201', 'Smith', '2024-02-03', 6.00, 10.00, 389.00, 8.00, 420.12),
(41, '202', 'Selvam', '2024-02-03', 4.00, 10.00, 363.00, 8.00, 392.04),
(42, '203', 'Dinesh', '2024-02-03', 4.00, 6.00, 217.80, 8.00, 235.22),
(43, '201', 'Smith', '2024-02-05', 6.00, 10.00, 389.00, 8.00, 420.12),
(44, '203', 'Dinesh', '2024-02-05', 4.00, 10.00, 363.00, 8.00, 392.04),
(45, '201', 'Smith', '2024-03-02', 6.00, 8.00, 311.20, 6.00, 329.87);

-- --------------------------------------------------------

--
-- Table structure for table `cowsinfo`
--

CREATE TABLE `cowsinfo` (
  `cowsid` int(11) NOT NULL,
  `farmers_id` int(50) DEFAULT NULL,
  `farmers_no` varchar(50) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Maximam_Cows` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cowsinfo`
--

INSERT INTO `cowsinfo` (`cowsid`, `farmers_id`, `farmers_no`, `Category`, `Maximam_Cows`, `date`) VALUES
(1, NULL, '101', 'Cows', 20, '2023-12-22'),
(2, NULL, '103', 'Buffalo', 20, '2023-12-25'),
(3, NULL, '104', 'Cows', 20, '2023-12-25'),
(4, NULL, '101', 'Cows', 20, '2023-12-27'),
(5, NULL, '103', 'Buffalo', 20, '2023-12-27'),
(6, NULL, '101', 'Cows', 20, '2024-01-08'),
(7, NULL, '105', 'Buffalo', 10, '2024-01-08'),
(13, NULL, '101', 'Cows', 20, '2024-01-16'),
(15, NULL, '102', 'Cows', 20, '2024-01-08'),
(16, NULL, '102', 'Cows', 30, '2024-01-16'),
(18, NULL, '103', 'Buffalo', 20, '2024-01-16'),
(19, NULL, '101', 'Cows', 20, '2024-01-19'),
(20, NULL, '102', 'Cows', 20, '2024-01-19'),
(21, NULL, '103', 'Buffalo', 30, '2024-01-19'),
(22, NULL, '101', 'Cows', 20, '2024-01-22'),
(23, NULL, '102', 'Cows', 30, '2024-01-22'),
(24, NULL, '103', 'Buffalo', 30, '2024-01-22'),
(25, NULL, '103', 'Buffalo', 20, '2024-01-24'),
(26, NULL, '102', 'Cows', 200, '2024-01-24'),
(27, NULL, '101', 'Cows', 20, '2024-01-28'),
(28, NULL, '101', 'Cows', 20, '2024-01-24'),
(29, NULL, '102', 'Cows', 20, '2023-12-22'),
(30, NULL, '103', 'Buffalo', 20, '2024-01-08'),
(31, NULL, '102', 'Cows', 20, '2024-01-30'),
(32, NULL, '101', 'Cows', 20, '2024-02-04'),
(33, NULL, '102', 'Cows', 20, '2024-02-04'),
(34, NULL, '103', 'Buffalo', 20, '2024-02-04'),
(35, NULL, '101', 'Cows', 20, '2024-02-03'),
(36, NULL, '102', 'Cows', 20, '2024-02-03'),
(37, NULL, '103', 'Buffalo', 20, '2024-02-03'),
(38, NULL, '102', 'Cows', 20, '2024-02-05'),
(39, NULL, '101', 'Cows', 20, '2024-02-05'),
(40, NULL, '104', 'Cows', 20, '2024-02-05'),
(41, NULL, '101', 'Cows', 20, '2024-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `farmers_id` int(11) NOT NULL,
  `trn_date` datetime NOT NULL,
  `farmers_no` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date` date DEFAULT NULL,
  `phoneno` bigint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`farmers_id`, `trn_date`, `farmers_no`, `name`, `address`, `email`, `date`, `phoneno`) VALUES
(1, '2024-01-03 05:20:51', 101, 'Mohan', 'No 276 Housing Board', 'mohan@gmail.com', '2023-12-22', 987654321),
(2, '2024-01-05 09:25:04', 103, 'Aravindhane', 'No 250 Rainbow Nagar', 'aravindha@gmail.com', '2023-12-25', 987654321),
(3, '2024-01-05 09:46:33', 102, 'Ravi', 'No 400 Indira Gandhi', 'ravi@gmail.com', '2023-12-25', 987654321),
(4, '2024-01-07 11:37:57', 101, 'Mohan', 'No 276 Housing Board', 'mohan@gmail.com', '2023-12-27', 987654321),
(5, '2024-01-07 12:24:28', 103, 'Aravindhane', 'No 250 Rainbow Nagar', 'aravindha@gmailc.com', '2023-12-27', 987654321),
(6, '2024-01-08 18:02:44', 101, 'Mohan', 'No 276 Housing Board', 'mohan@gmail.com', '2024-01-08', 987654321),
(7, '2024-01-08 18:05:50', 102, 'Ravi', 'No 400 Indira Gandhi', 'ravi@gmail.com', '2024-01-08', 987656780),
(12, '2024-01-16 09:22:55', 101, 'Mohan', 'LIG 276 Housing Board', 'mohan@gmail.com', '2024-01-16', 9876543219),
(13, '2024-01-16 14:20:51', 102, 'Ravi', 'No 400 Indira Gandhi', 'ravi@gmail.com', '2024-01-16', 9876543218),
(15, '2024-01-16 14:25:27', 103, 'Aravindhane', 'No 250 Rainbow Nagar', 'aravindha@gmail.com', '2024-01-16', 9876543216),
(16, '2024-01-19 19:13:07', 101, 'Mohan', 'No 276 Housing Board', 'mohan@gmail.com', '2024-01-19', 9876543216),
(17, '2024-01-19 19:16:53', 102, 'Ravi', 'No 400 Indira Gandhi', 'ravi@gmail.com', '2024-01-19', 9876543218),
(18, '2024-01-19 19:24:20', 103, 'Aravindhane', 'No 250 Rainbow Nagar', 'aravindha@gmail.com', '2024-01-19', 9876543214),
(19, '2024-01-22 18:29:00', 101, 'Mohan', 'No 276 Housing Board', 'mohan@gmail.com', '2024-01-22', 9876543214),
(20, '2024-01-22 18:30:20', 102, 'Ravi', 'No 400 Indira Gandhi', 'ravi@gmail.com', '2024-01-22', 9876543213),
(21, '2024-01-22 18:31:27', 103, 'Aravindhane', 'No 250 Rainbow Nagar', 'aravindha@gmail.com', '2024-01-22', 9876543214),
(22, '2024-01-24 06:54:24', 103, 'Aravindhane', 'No 250 Rainbow Nagar', 'aravindha@gmail.com', '2024-01-24', 9876543219),
(23, '2024-01-24 07:01:30', 102, 'Ravi', 'No 400 Indira Gandhi', 'ravi@gmail.com', '2024-01-24', 9876543216),
(24, '2024-01-28 16:00:28', 101, 'Mohan', 'No 276 Housing Board', 'mohan@gmail.com', '2024-01-28', 9876543216),
(25, '2024-01-28 19:06:58', 101, 'Mohan', 'No 276 Housing Board', 'mohan@gmail.com', '2024-01-24', 9876543215),
(26, '2024-01-29 14:37:51', 102, 'Ravi', 'No 400 Indira Gandhi', 'ravi@gmail.com', '2023-12-22', 9876543216),
(27, '2024-01-29 14:43:19', 103, 'Aravindhane', 'No 250 Rainbow Nagar', 'aravindha@gmail.com', '2024-01-08', 9876543219),
(28, '2024-01-30 11:47:19', 102, 'Ravi', 'No 400 Indira Gandhi', 'ravi@gmail.com', '2024-01-30', 9876543216),
(29, '2024-02-04 15:23:37', 101, 'Mohan', 'No 276 Housing Board', 'mohan@gmail.com', '2024-02-04', 9876543216),
(30, '2024-02-04 15:24:40', 102, 'Ravi', 'No 400 Indira Gandhi', 'ravi@gmail.com', '2024-02-04', 9876543214),
(31, '2024-02-04 15:25:54', 103, 'Aravindhane', 'No 250 Rainbow Nagar', 'aravindha@gmail.com', '2024-02-04', 9876543216),
(32, '2024-02-05 07:50:31', 101, 'Mohan', 'No 276 Housing Board', 'mohan@gmail.com', '2024-02-03', 9876543216),
(33, '2024-02-05 07:55:06', 102, 'Ravi', 'No 400 Indira Gandhi', 'ravi@gmail.com', '2024-02-03', 9876543216),
(34, '2024-02-05 08:01:56', 103, 'Aravindhane', 'No 276 Housing Board', 'aravindha@gmail.com', '2024-02-03', 9876543215),
(35, '2024-02-05 08:15:12', 102, 'Ravi', 'No 400 Indira Gandhi', 'ravi@gmail.com', '2024-02-05', 9876543214),
(36, '2024-02-05 08:19:03', 101, 'Mohan', 'No 276 Housing Board', 'mohan@gmail.com', '2024-02-05', 9876543216),
(37, '2024-02-05 08:27:10', 104, 'Rohit', 'No 400 Indira Gandhi', 'rohit@gmail.com', '2024-02-05', 9876543219),
(39, '2024-03-02 06:16:42', 101, 'Mohan', 'No 276 Housing Board', 'mohan@gmail.com', '2024-03-02', 9876543219);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `farmers_no` varchar(50) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `email`, `password`, `farmers_no`, `trn_date`) VALUES
(13, 'Mohan', 'mohan@gmail.com', '079cac2d2792b6b1607922ff02b3e359', '', '2024-01-01 06:37:42'),
(14, 'Suresh', 'suresh@gmail.com', '6c86b4cbbe1c7e99dfe2a26497788027', '', '2024-01-01 18:09:22'),
(17, 'Aravindhane', 'aravindha@gmail.com', '0490c76ac3896114f3b5352f010a66cd', '', '2024-01-05 09:24:25'),
(18, 'Pooshna', 'pooshna@gmail.com', 'c02677039668c112c2a375605ab408af', '', '2024-01-05 09:45:51'),
(19, 'Ravi', 'ravi@gmail.com', '1fcfea0c5736bbd458fd3212f796be96', '', '2024-01-08 18:05:15'),
(20, 'Mohan', 'mohan@gmail.com', '079cac2d2792b6b1607922ff02b3e359', '101', '2024-01-28 16:00:03'),
(21, 'Ravi', 'ravi@gmail.com', '1fcfea0c5736bbd458fd3212f796be96', '102', '2024-01-29 14:37:08'),
(22, 'Aravindhane', 'aravindha@gmail.com', '0490c76ac3896114f3b5352f010a66cd', '103', '2024-01-29 14:42:44'),
(23, 'Rohit', 'rohit@gmail.com', 'bc7449171fc8f02ffc8329adf9a1c13f', '104', '2024-02-05 08:25:54');

-- --------------------------------------------------------

--
-- Table structure for table `login1`
--

CREATE TABLE `login1` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login1`
--

INSERT INTO `login1` (`id`, `username`, `email`, `password`, `trn_date`) VALUES
(1, 'Admin', 'admin@gmail.ocm', '5960f4bb1ecb6b5cdd9d9700913fe69d', '2024-01-01 07:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `login2`
--

CREATE TABLE `login2` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `corporateno` varchar(50) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login2`
--

INSERT INTO `login2` (`id`, `username`, `email`, `password`, `corporateno`, `trn_date`) VALUES
(1, 'Smith', 'smith@gmail.com', '44d80804754c219684ab93880e6b3f2c', '0', '2024-01-01 19:59:35'),
(2, 'Selvam', 'selvam@gmail.com', 'e6584bbd34ea56d890f04f25b948edc7', '0', '2024-01-01 20:19:38'),
(3, 'Dinesh', 'dinesh@gmail.com', '5299669306f7d4effc8571f7499d7205', '0', '2024-01-01 21:10:01'),
(4, 'avneet', 'avu@gmail.com', '9785e0a4edfc278c1ccb1f6c3ee0dda5', '0', '2024-01-05 09:30:47'),
(5, 'Smith', 'smith@gmail.com', '44d80804754c219684ab93880e6b3f2c', '201', '2024-01-28 18:38:14'),
(6, 'Selvam', 'selvam@gmail.com', 'e6584bbd34ea56d890f04f25b948edc7', '202', '2024-01-28 19:10:16'),
(7, 'Dinesh', 'dinesh@gmail.com', '5299669306f7d4effc8571f7499d7205', '203', '2024-02-04 15:32:22');

-- --------------------------------------------------------

--
-- Table structure for table `quantitychecking`
--

CREATE TABLE `quantitychecking` (
  `id` int(11) NOT NULL,
  `farmers_no` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` date DEFAULT NULL,
  `fat_content` decimal(5,2) NOT NULL,
  `quantityofmilk` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quantitychecking`
--

INSERT INTO `quantitychecking` (`id`, `farmers_no`, `name`, `date`, `fat_content`, `quantityofmilk`, `price`) VALUES
(1, 101, 'Mohan', '2023-12-22', 6.00, 15.00, 568.50),
(2, 102, 'Ravi', '2023-12-25', 4.00, 12.00, 423.60),
(3, 103, 'Aravindhane', '2023-12-25', 6.00, 15.00, 568.50),
(4, 101, 'Mohan', '2023-12-27', 6.00, 7.00, 265.30),
(5, 103, 'Aravindhane', '2023-12-27', 6.00, 10.00, 379.00),
(10, 101, 'Mohan', '2024-01-08', 6.00, 5.00, 189.50),
(16, 101, 'Mohan', '2024-01-16', 6.00, 7.00, 265.30),
(19, 102, 'Ravi', '2024-01-08', 6.00, 7.00, 265.30),
(20, 102, 'Ravi', '2024-01-16', 6.00, 10.00, 379.00),
(22, 103, 'Aravindhane', '2024-01-16', 6.00, 12.00, 454.80),
(23, 101, 'Mohan', '2024-01-19', 6.00, 10.00, 379.00),
(24, 102, 'Ravi', '2024-01-19', 6.00, 6.00, 227.40),
(25, 103, 'Aravindhane', '2024-01-19', 6.00, 12.00, 454.80),
(26, 101, 'Mohan', '2024-01-22', 6.00, 12.00, 454.80),
(27, 102, 'Ravi', '2024-01-22', 6.00, 15.00, 568.50),
(28, 103, 'Aravindhane', '2024-01-22', 6.00, 8.00, 303.20),
(29, 103, 'Aravindhane', '2024-01-24', 6.00, 10.00, 379.00),
(30, 102, 'Ravi', '2024-01-24', 6.00, 6.00, 227.40),
(31, 101, 'Mohan', '2024-01-28', 6.00, 10.00, 379.00),
(32, 101, 'Mohan', '2024-01-24', 4.00, 10.00, 353.00),
(33, 102, 'Ravi', '2023-12-22', 6.00, 14.00, 530.60),
(34, 103, 'Aravindhane', '2024-01-08', 6.00, 12.00, 454.80),
(35, 102, 'Ravi', '2024-01-30', 6.00, 10.00, 379.00),
(36, 103, 'Aravindhane', '2024-02-04', 4.00, 15.00, 529.50),
(37, 102, 'Ravi', '2024-02-04', 6.00, 8.00, 303.20),
(38, 101, 'Mohan', '2024-02-04', 6.00, 12.00, 454.80),
(39, 101, 'Mohan', '2024-02-03', 6.00, 10.00, 379.00),
(40, 102, 'Ravi', '2024-02-03', 4.00, 12.00, 423.60),
(41, 103, 'Aravindhane', '2024-02-03', 4.00, 5.00, 176.50),
(42, 102, 'Ravi', '2024-02-05', 6.00, 10.00, 379.00),
(43, 101, 'Mohan', '2024-02-05', 4.00, 12.00, 423.60),
(44, 104, 'Rohit', '2024-02-05', 4.00, 15.00, 529.50),
(45, 101, 'Mohan', '2024-03-02', 6.00, 10.00, 379.00);

-- --------------------------------------------------------

--
-- Table structure for table `quantityfarmers`
--

CREATE TABLE `quantityfarmers` (
  `quantityid` int(11) NOT NULL,
  `farmers_id` int(50) DEFAULT NULL,
  `farmers_no` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `quantityofmilk` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quantityfarmers`
--

INSERT INTO `quantityfarmers` (`quantityid`, `farmers_id`, `farmers_no`, `date`, `quantityofmilk`) VALUES
(1, NULL, '101', '2023-12-22', 15),
(2, NULL, '103', '2023-12-25', 15),
(3, NULL, '104', '2023-12-25', 6),
(4, NULL, '101', '2023-12-27', 7),
(5, NULL, '103', '2023-12-27', 10),
(6, NULL, '101', '2024-01-08', 5),
(7, NULL, '105', '2024-01-08', 4),
(13, NULL, '101', '2024-01-16', 7),
(14, NULL, '102', '2024-01-05', 8),
(15, NULL, '102', '2024-01-08', 7),
(16, NULL, '102', '2024-01-16', 10),
(18, NULL, '103', '2024-01-16', 12),
(19, NULL, '101', '2024-01-19', 10),
(20, NULL, '102', '2024-01-19', 6),
(21, NULL, '103', '2024-01-19', 12),
(22, NULL, '101', '2024-01-22', 12),
(23, NULL, '102', '2024-01-22', 15),
(24, NULL, '103', '2024-01-22', 8),
(25, NULL, '103', '2024-01-24', 10),
(26, NULL, '102', '2024-01-24', 6),
(27, NULL, '101', '2024-01-28', 10),
(28, NULL, '101', '2024-01-24', 10),
(29, NULL, '102', '2023-12-22', 14),
(30, NULL, '103', '2024-01-08', 12),
(31, NULL, '102', '2024-01-30', 10),
(32, NULL, '101', '2024-02-04', 12),
(33, NULL, '102', '2024-02-04', 8),
(34, NULL, '103', '2024-02-04', 15),
(35, NULL, '101', '2024-02-03', 10),
(36, NULL, '102', '2024-02-03', 12),
(37, NULL, '103', '2024-02-03', 5),
(38, NULL, '102', '2024-02-05', 10),
(39, NULL, '101', '2024-02-05', 12),
(40, NULL, '104', '2024-02-05', 15),
(41, NULL, '101', '2024-03-02', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `corporate`
--
ALTER TABLE `corporate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corporatechecking`
--
ALTER TABLE `corporatechecking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cowsinfo`
--
ALTER TABLE `cowsinfo`
  ADD PRIMARY KEY (`cowsid`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`farmers_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login1`
--
ALTER TABLE `login1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login2`
--
ALTER TABLE `login2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quantitychecking`
--
ALTER TABLE `quantitychecking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quantityfarmers`
--
ALTER TABLE `quantityfarmers`
  ADD PRIMARY KEY (`quantityid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `corporate`
--
ALTER TABLE `corporate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `corporatechecking`
--
ALTER TABLE `corporatechecking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `cowsinfo`
--
ALTER TABLE `cowsinfo`
  MODIFY `cowsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `farmers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `login1`
--
ALTER TABLE `login1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login2`
--
ALTER TABLE `login2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quantitychecking`
--
ALTER TABLE `quantitychecking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `quantityfarmers`
--
ALTER TABLE `quantityfarmers`
  MODIFY `quantityid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
