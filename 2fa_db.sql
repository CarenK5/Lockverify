-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2024 at 02:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2fa_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

CREATE DATABASE 2fa_db;

USE 2fa_db;

CREATE TABLE `dashboard` (
  `ProfileSettings` varchar(50) NOT NULL,
  `ChangePassword` varchar(50) NOT NULL,
  `SecuritySettings` varchar(50) NOT NULL,
  `RecentActivity` varchar(50) NOT NULL,
  `Help` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_db`
--

CREATE TABLE `login_db` (
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `signup` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_db`
--

CREATE TABLE `profile_db` (
  `username` varchar(50) NOT NULL,
  `PhoneNumber` int(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `ProfilePicture` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `PhoneNumber` int(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`FirstName`, `LastName`, `PhoneNumber`, `Email`, `password`) VALUES
('c', 's', 777455514, 'iamstupendous550@gmail.com', ''),
('c', 'h', 777455514, 'iamstupendous550@gmail.com', '');


-- --------------------------------------------------------

--
-- Table structure for table `usersettings`
--

CREATE TABLE `usersettings` (
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Enabe2FA` varchar(50) NOT NULL,
  `Disable2FA` varchar(50) NOT NULL,
  `Privacy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
