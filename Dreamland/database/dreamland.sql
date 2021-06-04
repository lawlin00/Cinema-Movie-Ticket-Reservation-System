-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2019 at 02:50 PM
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
-- Table structure for table `hall`
--

CREATE TABLE `hall` (
  `HallID` int(11) NOT NULL,
  `HallName` varchar(255) NOT NULL,
  `SeatMap` varchar(255) NOT NULL,
  `RowCount` int(11) NOT NULL,
  `ColumnCount` int(11) NOT NULL,
  `TotalSeat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hall`
--

INSERT INTO `hall` (`HallID`, `HallName`, `SeatMap`, `RowCount`, `ColumnCount`, `TotalSeat`) VALUES
(1, 'Hall A', 'Map2', 10, 12, 120),
(2, 'Hall B', 'Map1', 10, 12, 120);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `InvoiceID` int(11) NOT NULL,
  `TimeslotID` int(11) NOT NULL,
  `PaymentMethod` varchar(255) NOT NULL,
  `CardNumber` bigint(20) NOT NULL,
  `CardExpirationMonth` int(11) NOT NULL,
  `CardExpirationYear` year(4) NOT NULL,
  `SecurityCode` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `AdultNumber` int(11) NOT NULL,
  `ChildrenNumber` int(11) NOT NULL,
  `TotalPrice` varchar(255) NOT NULL,
  `BillingName` varchar(255) NOT NULL,
  `BillingEmail` varchar(255) NOT NULL,
  `OrderDatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifyDatetime` datetime DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`InvoiceID`, `TimeslotID`, `PaymentMethod`, `CardNumber`, `CardExpirationMonth`, `CardExpirationYear`, `SecurityCode`, `MemberID`, `AdultNumber`, `ChildrenNumber`, `TotalPrice`, `BillingName`, `BillingEmail`, `OrderDatetime`, `ModifyDatetime`) VALUES
(5, 2, 'Visa', 2131241423513124, 1, 2020, 213, 1, 2, 0, 'RM 24', 'admin', 'admin@mail.com', '2019-10-28 20:56:48', '0000-00-00 00:00:00'),
(6, 2, 'Visa', 1231212524151515, 1, 0000, 123, 1, 2, 2, 'RM 44', 'admin', 'admin@mail.com', '2019-10-28 21:24:31', '0000-00-00 00:00:00');

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
(1, 'admin', 'admin@mail.com', '0127829468', 991230758392, '2019-10-10', 'Female', 'admin', '$2y$10$yF8B3adIdhGFxD7d.AQXX.Rg.8AssPfZIfiUCT3ASDM3O6Kl6co92', 0);

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `MovieID` int(11) NOT NULL,
  `MovieTitle` longtext NOT NULL,
  `MovieGenre` varchar(255) NOT NULL,
  `MovieDescription` varchar(255) NOT NULL,
  `MovieDirector` varchar(255) NOT NULL,
  `MovieReleaseDate` date NOT NULL,
  `MovieDistributor` varchar(255) NOT NULL,
  `MovieSubtitle` varchar(255) NOT NULL,
  `MovieLanguage` varchar(255) NOT NULL,
  `MovieRunningTime` int(11) NOT NULL,
  `MovieStatus` int(11) NOT NULL DEFAULT '1',
  `MovieImgPath` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`MovieID`, `MovieTitle`, `MovieGenre`, `MovieDescription`, `MovieDirector`, `MovieReleaseDate`, `MovieDistributor`, `MovieSubtitle`, `MovieLanguage`, `MovieRunningTime`, `MovieStatus`, `MovieImgPath`) VALUES
(1, 'Your Name', 'Anime', 'Two teenagers share a profound, magical connection upon discovering they are swapping bodies. But things become even more complicated when the boy and girl decide to meet in person.', 'Makoto Shinkai', '2019-07-03', 'Toho', 'English, Chinese', 'Japanese', 107, 1, 'uploadsmovie/Your_Name_poster.png'),
(2, 'A Silent Voice', 'Anime', 'When a grade school student with impaired hearing is bullied mercilessly, she transfers to another school. Years later, one of her former tormentors sets out to make amends.', 'Naoko Yamada', '2019-09-17', 'Shochiku', 'English', 'Japanese', 130, 0, 'uploadsmovie/A Silent Voice.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `SeatID` int(11) NOT NULL,
  `RowID` varchar(1) NOT NULL,
  `ColumnID` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '0',
  `MovieID` int(11) DEFAULT NULL,
  `timeslotID1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `TimeslotID` int(11) NOT NULL,
  `showdate` date NOT NULL,
  `starttime` time NOT NULL,
  `HallID` int(11) NOT NULL,
  `MovieID` int(11) NOT NULL,
  `TicketNum` int(11) NOT NULL DEFAULT '0',
  `AdultPrice` int(11) NOT NULL DEFAULT '0',
  `ChildrenPrice` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`TimeslotID`, `showdate`, `starttime`, `HallID`, `MovieID`, `TicketNum`, `AdultPrice`, `ChildrenPrice`) VALUES
(2, '2019-10-10', '12:00:00', 1, 1, 120, 12, 10),
(3, '2019-10-10', '10:00:00', 1, 1, 120, 12, 8),
(5, '2019-10-10', '10:00:00', 1, 1, 120, 12, 8),
(6, '2019-10-10', '10:00:00', 1, 1, 120, 12, 8),
(7, '2019-10-10', '12:00:00', 1, 1, 120, 12, 8),
(8, '2019-10-10', '12:00:00', 1, 1, 120, 12, 8),
(9, '2019-10-10', '12:00:00', 1, 1, 120, 12, 8),
(10, '2019-10-10', '13:00:00', 1, 1, 120, 12, 8),
(11, '2019-10-10', '12:00:00', 1, 1, 120, 12, 8),
(12, '2019-10-10', '10:00:00', 2, 1, 120, 12, 8),
(19, '2019-10-10', '12:00:00', 2, 2, 120, 12, 8);

-- --------------------------------------------------------

--
-- Stand-in structure for view `timeslotview`
-- (See below for the actual view)
--
CREATE TABLE `timeslotview` (
`TimeslotID` int(11)
,`showdate` date
,`starttime` time
,`HallID` int(11)
,`HallName` varchar(255)
,`SeatMap` varchar(255)
,`RowCount` int(11)
,`ColumnCount` int(11)
,`TotalSeat` int(11)
,`TicketNum` int(11)
,`AdultPrice` int(11)
,`ChildrenPrice` int(11)
,`MovieID` int(11)
,`MovieTitle` longtext
,`MovieGenre` varchar(255)
,`MovieDescription` varchar(255)
,`MovieDirector` varchar(255)
,`MovieReleaseDate` date
,`MovieDistributor` varchar(255)
,`MovieSubtitle` varchar(255)
,`MovieLanguage` varchar(255)
,`MovieRunningTime` int(11)
,`MovieStatus` int(11)
,`MovieImgPath` text
);

-- --------------------------------------------------------

--
-- Structure for view `timeslotview`
--
DROP TABLE IF EXISTS `timeslotview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `timeslotview`  AS  select `t`.`TimeslotID` AS `TimeslotID`,`t`.`showdate` AS `showdate`,`t`.`starttime` AS `starttime`,`h`.`HallID` AS `HallID`,`h`.`HallName` AS `HallName`,`h`.`SeatMap` AS `SeatMap`,`h`.`RowCount` AS `RowCount`,`h`.`ColumnCount` AS `ColumnCount`,`h`.`TotalSeat` AS `TotalSeat`,`t`.`TicketNum` AS `TicketNum`,`t`.`AdultPrice` AS `AdultPrice`,`t`.`ChildrenPrice` AS `ChildrenPrice`,`t`.`MovieID` AS `MovieID`,`m`.`MovieTitle` AS `MovieTitle`,`m`.`MovieGenre` AS `MovieGenre`,`m`.`MovieDescription` AS `MovieDescription`,`m`.`MovieDirector` AS `MovieDirector`,`m`.`MovieReleaseDate` AS `MovieReleaseDate`,`m`.`MovieDistributor` AS `MovieDistributor`,`m`.`MovieSubtitle` AS `MovieSubtitle`,`m`.`MovieLanguage` AS `MovieLanguage`,`m`.`MovieRunningTime` AS `MovieRunningTime`,`m`.`MovieStatus` AS `MovieStatus`,`m`.`MovieImgPath` AS `MovieImgPath` from ((`timeslot` `t` join `movie` `m` on((`t`.`MovieID` = `m`.`MovieID`))) join `hall` `h` on((`t`.`HallID` = `h`.`HallID`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hall`
--
ALTER TABLE `hall`
  ADD PRIMARY KEY (`HallID`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`InvoiceID`),
  ADD KEY `InvoiceTimeslot` (`TimeslotID`),
  ADD KEY `InvoiceMember` (`MemberID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`AccID`),
  ADD UNIQUE KEY `MemberName` (`MemberName`),
  ADD UNIQUE KEY `MemberEmail` (`MemberEmail`),
  ADD UNIQUE KEY `AccUsername` (`AccUsername`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`MovieID`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`SeatID`),
  ADD KEY `MovieSeat` (`MovieID`),
  ADD KEY `MovieTimeSeat1` (`timeslotID1`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD PRIMARY KEY (`TimeslotID`),
  ADD KEY `TimeHall` (`HallID`),
  ADD KEY `TimeMovie` (`MovieID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hall`
--
ALTER TABLE `hall`
  MODIFY `HallID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `InvoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `AccID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `MovieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `SeatID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timeslot`
--
ALTER TABLE `timeslot`
  MODIFY `TimeslotID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `InvoiceMember` FOREIGN KEY (`MemberID`) REFERENCES `member` (`AccID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `InvoiceTimeslot` FOREIGN KEY (`TimeslotID`) REFERENCES `timeslot` (`TimeslotID`) ON DELETE NO ACTION;

--
-- Constraints for table `seat`
--
ALTER TABLE `seat`
  ADD CONSTRAINT `MovieSeat` FOREIGN KEY (`MovieID`) REFERENCES `movie` (`MovieID`) ON DELETE SET NULL,
  ADD CONSTRAINT `MovieTimeSeat1` FOREIGN KEY (`timeslotID1`) REFERENCES `timeslot` (`TimeslotID`) ON DELETE SET NULL;

--
-- Constraints for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD CONSTRAINT `TimeHall` FOREIGN KEY (`HallID`) REFERENCES `hall` (`HallID`),
  ADD CONSTRAINT `TimeMovie` FOREIGN KEY (`MovieID`) REFERENCES `movie` (`MovieID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
