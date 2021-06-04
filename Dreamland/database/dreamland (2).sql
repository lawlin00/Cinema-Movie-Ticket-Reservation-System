-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2019 at 10:35 AM
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
  `HallName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hall`
--

INSERT INTO `hall` (`HallID`, `HallName`) VALUES
(1, 'Hall A'),
(2, 'Hall B'),
(3, 'Hall C'),
(4, 'Hall D');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `InvoiceID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `TicketType` int(11) NOT NULL DEFAULT '0',
  `SeatNum` int(11) NOT NULL,
  `MovieID` int(11) NOT NULL,
  `HallID` int(11) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `DateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `MovieTicketNum` int(11) NOT NULL,
  `MovieImgPath` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`MovieID`, `MovieTitle`, `MovieGenre`, `MovieDescription`, `MovieDirector`, `MovieReleaseDate`, `MovieDistributor`, `MovieSubtitle`, `MovieLanguage`, `MovieRunningTime`, `MovieStatus`, `MovieTicketNum`, `MovieImgPath`) VALUES
(6, 'aaa', 'Action', 'aaa', 'aaa', '2019-10-16', 'aaa', 'aaa', 'Malay', 22, 1, 23, 'uploadsmovie/CZY - LOG-9 (65252747) 9ãƒšãƒ¼ã‚¸.jpg'),
(7, 'bb', 'Anime', 'bb', 'bb', '2019-10-17', 'bb', 'aaa', 'English', 223, 1, 0, 'uploadsmovie/CZY - LOG-9 (65252747) 12ãƒšãƒ¼ã‚¸.jpg'),
(8, 'ccc', 'Anime', 'ccc', 'ccc', '2019-09-29', 'ccc', 'cc', 'Malay', 12, 1, 0, 'uploadsmovie/33b5c87e1efeae288e8481b084c3078350d98b5f_hq.jpg'),
(9, 'dd', 'Action', 'ddd', 'dd', '2019-10-15', 'dd', 'dd', 'English', 21, 1, 0, 'uploadsmovie/dfcace41093cbfe29cc0e90862bf479b.png'),
(10, 'eee', 'Anime', 'eee', 'ee', '2019-10-16', 'ee', 'eee', 'Japanese', 123, 1, 1, 'uploadsmovie/95444cae49fbe2f8397fa063966193c2--rabbit-image.jpg'),
(11, 'Your Name', 'Anime', 'Your Name. (Japanese: å›ã®åã¯ã€‚ Hepburn: Kimi no Na wa.) is a 2016 Japanese animated romantic fantasy drama film written and directed by Makoto Shinkai and produced by CoMix Wave Films. The film was produced by Noritaka Kawaguchi and Genki Kawamura,', 'Makoto Shinkai', '2016-07-03', 'Toho', 'English', 'Japanese', 123, 1, 81, 'uploadsmovie/Your_Name_poster.png');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `SeatID` int(11) NOT NULL,
  `RowID` varchar(1) NOT NULL,
  `ColumnID` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '0',
  `MovieID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`SeatID`, `RowID`, `ColumnID`, `Status`, `MovieID`) VALUES
(1, '1', 1, 0, NULL),
(2, '1', 2, 0, NULL);

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
  `Ticket` varchar(10) NOT NULL DEFAULT 'Adult',
  `Price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`TimeslotID`, `showdate`, `starttime`, `HallID`, `MovieID`, `Ticket`, `Price`) VALUES
(1, '2019-10-16', '00:00:00', 1, 6, 'Adult', '5'),
(2, '2019-10-16', '10:00:00', 1, 6, 'Children', '5'),
(9, '2019-10-11', '00:00:00', 1, 6, 'Children', '12'),
(10, '2019-10-01', '00:00:00', 2, 10, 'Adult', '12'),
(11, '2019-10-09', '00:00:00', 1, 9, 'Children', '12'),
(12, '2019-10-08', '00:00:00', 1, 6, 'Adult', '12'),
(13, '2019-10-08', '01:00:00', 1, 11, 'Adult', '12'),
(14, '2019-10-08', '01:00:00', 1, 8, 'Adult', '12'),
(17, '2019-10-17', '12:23:00', 2, 6, 'Children', '12'),
(18, '2019-10-09', '10:00:00', 1, 7, 'Adult', '12'),
(19, '2019-10-19', '10:00:00', 1, 7, 'Children', '12');

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
,`Ticket` varchar(10)
,`Price` decimal(10,0)
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
,`MovieTicketNum` int(11)
,`MovieImgPath` text
);

-- --------------------------------------------------------

--
-- Structure for view `timeslotview`
--
DROP TABLE IF EXISTS `timeslotview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `timeslotview`  AS  select `t`.`TimeslotID` AS `TimeslotID`,`t`.`showdate` AS `showdate`,`t`.`starttime` AS `starttime`,`h`.`HallID` AS `HallID`,`h`.`HallName` AS `HallName`,`t`.`Ticket` AS `Ticket`,`t`.`Price` AS `Price`,`t`.`MovieID` AS `MovieID`,`m`.`MovieTitle` AS `MovieTitle`,`m`.`MovieGenre` AS `MovieGenre`,`m`.`MovieDescription` AS `MovieDescription`,`m`.`MovieDirector` AS `MovieDirector`,`m`.`MovieReleaseDate` AS `MovieReleaseDate`,`m`.`MovieDistributor` AS `MovieDistributor`,`m`.`MovieSubtitle` AS `MovieSubtitle`,`m`.`MovieLanguage` AS `MovieLanguage`,`m`.`MovieRunningTime` AS `MovieRunningTime`,`m`.`MovieStatus` AS `MovieStatus`,`m`.`MovieTicketNum` AS `MovieTicketNum`,`m`.`MovieImgPath` AS `MovieImgPath` from ((`timeslot` `t` join `movie` `m` on((`t`.`MovieID` = `m`.`MovieID`))) join `hall` `h` on((`t`.`HallID` = `h`.`HallID`))) ;

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
  ADD PRIMARY KEY (`InvoiceID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`AccID`),
  ADD UNIQUE KEY `MemberName` (`MemberName`),
  ADD UNIQUE KEY `MemberEmail` (`MemberEmail`);

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
  ADD KEY `MovieSeat` (`MovieID`);

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
  MODIFY `HallID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `InvoiceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `AccID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `MovieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `SeatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `timeslot`
--
ALTER TABLE `timeslot`
  MODIFY `TimeslotID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `seat`
--
ALTER TABLE `seat`
  ADD CONSTRAINT `MovieSeat` FOREIGN KEY (`MovieID`) REFERENCES `movie` (`MovieID`);

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
