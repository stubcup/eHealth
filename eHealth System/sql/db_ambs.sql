-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2020 at 07:19 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ambs`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `b_time` time NOT NULL,
  `b_date` date NOT NULL,
  `b_name` varchar(30) NOT NULL,
  `b_surname` varchar(30) NOT NULL,
  `book_id` int(11) NOT NULL,
  `b_contact` varchar(10) NOT NULL,
  `b_id` varchar(13) NOT NULL,
  `purpose` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`b_time`, `b_date`, `b_name`, `b_surname`, `book_id`, `b_contact`, `b_id`, `purpose`) VALUES
('09:00:00', '2020-01-16', 'Obed', 'Mahlangu', 1, '0791504873', '217204135', 'consult'),
('09:00:00', '2020-01-17', 'Obed', 'Mahlangu', 2, '0791504873', '217204135', 'consult'),
('09:15:00', '2020-01-18', 'Obed', 'Mahlangu', 3, '0791504873', '217204135', 'consult'),
('09:30:00', '2020-01-16', 'koki', 'maponya', 4, '0793330868', '215194493', 'checkup'),
('14:45:00', '2020-01-16', 'Obed', 'Mahlangu', 5, '0791504873', '9806155121083', 'consult'),
('11:15:00', '2020-01-21', 'Obed', 'Mahlangu', 6, '0791504873', '9806155121083', 'consult'),
('09:00:00', '2020-01-23', 'koki', 'maponya', 7, '0793330868', '9604195692082', 'checkup'),
('09:00:00', '2020-01-31', 'koki', 'maponya', 8, '0793330868', '9806155121083', 'consult');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `noticeID` int(10) NOT NULL,
  `notice_to` varchar(2) NOT NULL,
  `notice` varchar(1000) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`noticeID`, `notice_to`, `notice`, `time`) VALUES
(8, '2', 'Doctor is not available today', '2020-01-15 18:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleID` int(7) NOT NULL,
  `time` varchar(6) NOT NULL,
  `schedule_date` varchar(10) NOT NULL,
  `bus` varchar(25) NOT NULL,
  `driver` varchar(50) NOT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  `occupance` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleID`, `time`, `schedule_date`, `bus`, `driver`, `from`, `to`, `occupance`) VALUES
(44, '6', '11-05-2019', 'DMK 445 GP', '637043492', 'Jane Furse', 'Kasi Q', '65'),
(45, '6', '12-05-2019', 'DMK 445 GP', '637043492', 'Jane Furse', 'Kasi Q', '65'),
(46, '13', '14-05-2019', 'DMK 445 GP', '637043492', 'Kasi Q', 'Limpopo', '65'),
(47, '14', '14-05-2019', 'DMK 445 GP', '637043492', 'Limpopo', 'Res P', '65'),
(48, '10', '15-05-2019', 'DMK 445 GP', '637043492', 'Jane Furse', 'Kasi Q', '65'),
(49, '11', '15-05-2019', 'DMK 445 GP', '637043492', 'Kasi Q', 'Jane Furse', '65'),
(50, '9', '12-12-2019', 'DMK 445 GP', '637043492', 'Jane Furse', 'Lolo', '65'),
(51, '6', '14-12-2019', 'DMK 445 GP', '637043492', 'Jane Furse', 'Kasi Q', '65'),
(52, '16', '14-12-2019', 'DMK 445 GP', '637043492', 'Limpopo', 'Jane Furse', '65'),
(53, '6', '09-01-2020', 'DMK 445 GP', '637043492', 'Kasi Q', 'Jane Furse', '65'),
(54, '6', '15-01-2020', 'DMK 445 GP', '637043492', 'Jane Furse', 'Kasi Q', '65');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(255) NOT NULL,
  `userID` varchar(9) NOT NULL,
  `IDNo` varchar(13) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cell` varchar(10) NOT NULL,
  `role` int(1) NOT NULL,
  `passW` varchar(1000) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `userID`, `IDNo`, `sname`, `name`, `email`, `cell`, `role`, `passW`, `active`, `deleted`) VALUES
(1, '123456789', '1234567890987', 'Admin', 'Admin Testing', 'test@testing.com', '0712345678', 1, 'ead1c6f4950d085f4b66f2d8de33050c', 1, 0),
(9, '601781220', '1232343454567', 'Mkhonto', 'Lemenke Vincent', '', '', 1, '', 0, 0),
(27, '637043492', '7894561230000', 'MOTHO', 'MOTHO', 'DMHTraining@example.co.za', '0751234546', 2, 'ead1c6f4950d085f4b66f2d8de33050c', 1, 0),
(28, '66560847', '7894561233214', 'KING', 'PIN', '', '', 2, '', 0, 0),
(32, '112233445', '1122334455667', 'TESTING', 'TEST', 'Student@test.com', '0768768765', 3, 'ead1c6f4950d085f4b66f2d8de33050c', 0, 0),
(33, '454545454', '9412325676879', 'MASILELA', 'MOTHOGOANE', '', '', 3, '', 0, 0),
(35, '217204135', '9807185121083', 'MAHLANGU', 'OBEDIENCE', 'bongani@gmail.com', '0791504873', 3, 'ead1c6f4950d085f4b66f2d8de33050c', 0, 0),
(36, '217220904', '9811305616089', 'NJANA', 'THABANG EDWARD', '', '', 3, '', 0, 0),
(37, '920349121', '9709125121083', 'ZWANW', 'JOSEPH', 'joseph@gmail.com', '0724839824', 2, 'ead1c6f4950d085f4b66f2d8de33050c', 1, 0),
(38, '846221923', '9807185121083', 'MAHLANGU', 'BONGANI ', '', '', 1, '', 0, 0),
(39, '123456788', '9604195692082', 'MAPONYA', 'PHASHE KOKETSO', 'magnep1219@gmail.com', '0793330868', 3, '77f18a242533005c7d64670b0d038064', 0, 0),
(40, '758514404', '9704195692082', 'MAGAGANE', 'THABO', '', '', 1, '', 0, 0),
(41, '70434570', '9704195592082', 'MAGAGANE', 'PHASHE', '', '', 1, '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`noticeID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `noticeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
