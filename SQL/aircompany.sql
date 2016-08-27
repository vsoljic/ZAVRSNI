-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2016 at 01:56 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aircompany`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `idPassanger` int(11) NOT NULL,
  `bookingDateTime` datetime NOT NULL,
  `bookingCode` varchar(6) COLLATE utf8mb4_croatian_ci NOT NULL,
  `idFlightSeat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `idPassanger`, `bookingDateTime`, `bookingCode`, `idFlightSeat`) VALUES
(1, 1, '0000-00-00 00:00:00', '3A42CB', 1),
(2, 2, '2016-08-26 18:26:30', '42NJ1C', 2);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_croatian_ci NOT NULL,
  `state` varchar(50) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city`, `state`) VALUES
(1, 'Zagreb', 'Hrvatska'),
(2, 'Split', 'Hrvatska'),
(3, 'Rijeka', 'Hrvatska'),
(4, 'London', 'Engleska'),
(5, 'Manchester', 'Engleska'),
(6, 'Pariz', 'Francuska'),
(7, 'Berlin', 'Njemačka'),
(8, 'Beč', 'Austrija'),
(9, 'Bordeaux', 'Francuska'),
(10, 'München', 'Njemačka');

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE `flight` (
  `id` int(11) NOT NULL,
  `idPlane` int(11) NOT NULL,
  `idDepartureCity` int(11) NOT NULL,
  `idArrivalCity` int(11) NOT NULL,
  `departureTime` time(6) NOT NULL,
  `arrivalTime` time(6) NOT NULL,
  `priceEconomy` double NOT NULL,
  `priceBusiness` double NOT NULL,
  `priceRealization` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`id`, `idPlane`, `idDepartureCity`, `idArrivalCity`, `departureTime`, `arrivalTime`, `priceEconomy`, `priceBusiness`, `priceRealization`) VALUES
(1, 1, 1, 8, '08:15:00.000000', '12:25:00.000000', 380, 726.55, 0),
(2, 1, 2, 10, '12:10:00.000000', '14:40:00.000000', 410.45, 755, 0);

-- --------------------------------------------------------

--
-- Table structure for table `flight_class`
--

CREATE TABLE `flight_class` (
  `id` int(11) NOT NULL,
  `className` varchar(20) COLLATE utf8mb4_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `flight_class`
--

INSERT INTO `flight_class` (`id`, `className`) VALUES
(1, 'business'),
(2, 'economy');

-- --------------------------------------------------------

--
-- Table structure for table `flight_seat`
--

CREATE TABLE `flight_seat` (
  `id` int(11) NOT NULL,
  `idFlight` int(11) NOT NULL,
  `idSeat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `flight_seat`
--

INSERT INTO `flight_seat` (`id`, `idFlight`, `idSeat`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `passanger`
--

CREATE TABLE `passanger` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) COLLATE utf8mb4_croatian_ci NOT NULL,
  `lastName` varchar(50) COLLATE utf8mb4_croatian_ci NOT NULL,
  `oib` varchar(11) COLLATE utf8mb4_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `passanger`
--

INSERT INTO `passanger` (`id`, `firstName`, `lastName`, `oib`) VALUES
(1, 'Anita', 'Marić', '12345678910'),
(2, 'Branko', 'Mustaš', '98765432100');

-- --------------------------------------------------------

--
-- Table structure for table `plane`
--

CREATE TABLE `plane` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_croatian_ci NOT NULL,
  `referenceNo` varchar(50) COLLATE utf8mb4_croatian_ci NOT NULL,
  `seatsNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `plane`
--

INSERT INTO `plane` (`id`, `name`, `referenceNo`, `seatsNo`) VALUES
(1, 'Airbonita', 'B-52', 40),
(2, 'Shadowstorm', 'C-31', 40),
(3, 'AirComet', 'DB-7', 30),
(4, 'Avenger', 'BB-12', 55);

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `id` int(11) NOT NULL,
  `seatNo` varchar(4) COLLATE utf8mb4_croatian_ci NOT NULL,
  `idFlightClass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`id`, `seatNo`, `idFlightClass`) VALUES
(1, '1A', 1),
(2, '1B', 1),
(3, '2A', 1),
(4, '2B', 1),
(5, '3A', 1),
(6, '3B', 1),
(7, '4A', 1),
(8, '4B', 1),
(9, '5A', 1),
(10, '5B', 1),
(11, '6A', 1),
(12, '6B', 1),
(13, '7A', 1),
(14, '7B', 1),
(15, '8A', 1),
(16, '8B', 1),
(17, '9A', 1),
(18, '9B', 1),
(19, '10A', 1),
(20, '10B', 1),
(21, '11A', 2),
(22, '11B', 2),
(23, '12A', 2),
(24, '12B', 2),
(25, '13A', 2),
(26, '13B', 2),
(27, '14A', 2),
(28, '14B', 2),
(29, '15A', 2),
(30, '15B', 2),
(31, '16A', 2),
(32, '16B', 2),
(33, '17A', 2),
(34, '17B', 2),
(35, '18A', 2),
(36, '18B', 2),
(37, '19A', 2),
(38, '19B', 2),
(39, '20A', 2),
(40, '20B', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_croatian_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPassanger` (`idPassanger`),
  ADD KEY `idFlightSeat` (`idFlightSeat`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPlane` (`idPlane`),
  ADD KEY `idDepartureCity` (`idDepartureCity`),
  ADD KEY `idArrivalCity` (`idArrivalCity`);

--
-- Indexes for table `flight_class`
--
ALTER TABLE `flight_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flight_seat`
--
ALTER TABLE `flight_seat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idFlight` (`idFlight`),
  ADD KEY `idSeat` (`idSeat`);

--
-- Indexes for table `passanger`
--
ALTER TABLE `passanger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plane`
--
ALTER TABLE `plane`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idFlightClass` (`idFlightClass`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `flight`
--
ALTER TABLE `flight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `flight_class`
--
ALTER TABLE `flight_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `flight_seat`
--
ALTER TABLE `flight_seat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `passanger`
--
ALTER TABLE `passanger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `plane`
--
ALTER TABLE `plane`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
