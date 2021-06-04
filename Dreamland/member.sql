-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2019 at 09:32 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dreamland`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `AccID` int(11) NOT NULL,
  `MemberName` varchar(255) NOT NULL,
  `MemberEmail` varchar(255) NOT NULL,
  `MemberContact` varchar(50) NOT NULL,
  `MemberIC` bigint(50) NOT NULL,
  `MemberDob` date NOT NULL,
  `MemberGender` varchar(10) NOT NULL,
  `AccUsername` varchar(255) NOT NULL,
  `AccPsw` varchar(255) NOT NULL,
  `UserRole` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`AccID`, `MemberName`, `MemberEmail`, `MemberContact`, `MemberIC`, `MemberDob`, `MemberGender`, `AccUsername`, `AccPsw`, `UserRole`) VALUES
(1, 'admin01', 'admin@mail.com', '0147892345', 882341563456, '2019-10-02', 'Female', 'admin', 'admin', 0),
(3, 'aaa', 'aaa@hotmail.co.uk', '0127829468', 991230758392, '2019-10-09', 'Male', 'aaa', 'aaa', 1),
(5, 'Chino', 'Chino@mail.com', '0127829462', 991230758391, '2019-10-12', 'Male', 'Chino', 'nusr1chino', 1),
(6, 'test', 'test@mail.com', '0127829467', 991230758392, '2019-10-10', 'Male', 'test', 'nusr1test', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`AccID`),
  ADD UNIQUE KEY `MemberName` (`MemberName`),
  ADD UNIQUE KEY `MemberEmail` (`MemberEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `AccID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
