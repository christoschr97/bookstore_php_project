-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 11, 2019 at 10:33 AM
-- Server version: 5.5.54
-- PHP Version: 5.6.30

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `ci_xristodoulou`
--

-- --------------------------------------------------------

--
-- Table structure for table `Airplanes`
--

CREATE TABLE IF NOT EXISTS `Airplanes` (
  `RegistrationNumber` varchar(2) CHARACTER SET utf8 NOT NULL,
  `ModelNumber` varchar(10) CHARACTER SET utf8 NOT NULL,
  `Capacity` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`RegistrationNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Airplanes`
--

INSERT INTO `Airplanes` (`RegistrationNumber`, `ModelNumber`, `Capacity`) VALUES
('A1', 'Airbus 319', 126),
('A2', 'Airbus 320', 170),
('A3', 'Airbus 330', 295),
('A4', 'Airbus 319', 126),
('A5', 'Airbus 320', 170),
('A6', 'Airbus 320', 170);

-- --------------------------------------------------------

--
-- Table structure for table `Attempts`
--

CREATE TABLE IF NOT EXISTS `Attempts` (
  `StudentID` int(10) unsigned NOT NULL DEFAULT '0',
  `ProgramId` varchar(40) NOT NULL,
  `CourseId` varchar(20) NOT NULL,
  `Semester` varchar(40) NOT NULL,
  `Year` smallint(5) unsigned NOT NULL,
  `Mark` decimal(3,1) unsigned NOT NULL,
  `Grade` varchar(1) NOT NULL,
  PRIMARY KEY (`StudentID`,`ProgramId`,`CourseId`,`Semester`,`Year`),
  KEY `ProgramId` (`ProgramId`),
  KEY `CourseId` (`CourseId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Attempts`
--

INSERT INTO `Attempts` (`StudentID`, `ProgramId`, `CourseId`, `Semester`, `Year`, `Mark`, `Grade`) VALUES
(2514, 'CIS', 'LCE212', 'Spring', 2018, 10.0, '1'),
(5521, 'CIS', 'CIS276', 'Spring', 2019, 4.5, 'E'),
(6363, 'CIS', 'CIS271', 'Spring', 2019, 4.0, 'E');

-- --------------------------------------------------------

--
-- Table structure for table `Authors`
--

CREATE TABLE IF NOT EXISTS `Authors` (
  `Author_id` int(11) NOT NULL AUTO_INCREMENT,
  `A_name` varchar(50) DEFAULT NULL,
  `A_surname` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Authors`
--


-- --------------------------------------------------------

--
-- Table structure for table `Bookings`
--

CREATE TABLE IF NOT EXISTS `Bookings` (
  `BookingID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `EmailAddress` varchar(50) CHARACTER SET utf8 NOT NULL,
  `FlightNumber` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`BookingID`),
  KEY `EmailAddress` (`EmailAddress`,`FlightNumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `Bookings`
--

INSERT INTO `Bookings` (`BookingID`, `EmailAddress`, `FlightNumber`) VALUES
(4, 'amela@hotmail.com', 'LH510'),
(10, 'ch.nicolaou@gmail.com', 'CY312'),
(7, 'ch.nicolaou@gmail.com', 'CY386'),
(8, 'marsal2@hotmail.com', 'AZ608'),
(11, 'marsal2@hotmail.com', 'AZ608'),
(1, 'marsal2@hotmail.com', 'CY337'),
(2, 'raimondo@yahoo.com', 'CY312'),
(9, 'raimondo@yahoo.com', 'QR624'),
(5, 'rob.j@yahoo.com', 'QR624'),
(3, 'roma6@gmail.com', 'AP5401'),
(6, 'roma6@gmail.com', 'CY487');

-- --------------------------------------------------------

--
-- Table structure for table `Books`
--

CREATE TABLE IF NOT EXISTS `Books` (
  `ISBN` varchar(100) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Category` varchar(100) DEFAULT NULL,
  `Town_released` varchar(100) DEFAULT NULL,
  `Year_released` varchar(100) DEFAULT NULL,
  `Author_id` int(11) NOT NULL,
  PRIMARY KEY (`ISBN`),
  KEY `Author_id` (`Author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Books`
--


-- --------------------------------------------------------

--
-- Table structure for table `Courses`
--

CREATE TABLE IF NOT EXISTS `Courses` (
  `CourseId` varchar(20) NOT NULL,
  `ProgramId` varchar(40) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `CreditPoints` smallint(5) unsigned NOT NULL,
  `YearCommerced` smallint(6) NOT NULL,
  `Year` smallint(5) unsigned NOT NULL,
  `Semester` varchar(30) NOT NULL,
  PRIMARY KEY (`CourseId`,`ProgramId`),
  KEY `ProgramId` (`ProgramId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Courses`
--

INSERT INTO `Courses` (`CourseId`, `ProgramId`, `Name`, `CreditPoints`, `YearCommerced`, `Year`, `Semester`) VALUES
('CIS205', 'CIS', 'Information Society', 5, 2007, 2019, 'Spring'),
('CIS208', 'CIS', 'Research Methods in Communication II', 5, 2007, 2019, 'Spring'),
('CIS271', 'CIS', 'Interactive Multimedia', 5, 2007, 2019, 'Spring'),
('CIS276', 'CIS', 'Data Management in information System', 5, 2007, 2019, 'Spring'),
('LCE212', 'LCE', 'English for communication Studies III', 5, 2007, 2019, 'Spring');

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

CREATE TABLE IF NOT EXISTS `Customers` (
  `Customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `C_email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `C_name` varchar(50) DEFAULT NULL,
  `C_surname` varchar(20) DEFAULT NULL,
  `C_phone` int(11) DEFAULT NULL,
  PRIMARY KEY (`Customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Customers`
--

INSERT INTO `Customers` (`Customer_id`, `C_email`, `password`, `C_name`, `C_surname`, `C_phone`) VALUES
(1, 'ci.xristodoulou@gmail.com', 'Christos', 'Christos', 'Christodoulou', 99035137),
(2, 'giannisgianni@gmail.com', '123456', 'Giannis', 'Gianni', 99999999),
(3, 'andreou.costas@outlook.com', '123456', 'Costas', 'Andreou', 99888979),
(4, 'andreasandreou@gmail.com', 'andreas', 'Andreas', 'Andreou', 991122333);

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE IF NOT EXISTS `Employee` (
  `Employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `E_email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `E_name` varchar(50) DEFAULT NULL,
  `E_surname` varchar(20) DEFAULT NULL,
  `E_phone` int(11) DEFAULT NULL,
  `Speciality` varchar(100) DEFAULT NULL,
  `Type` set('Director','Sales Manager','IT','Support Team') DEFAULT NULL,
  PRIMARY KEY (`Employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Employee`
--


-- --------------------------------------------------------

--
-- Table structure for table `Flights`
--

CREATE TABLE IF NOT EXISTS `Flights` (
  `FlightNumber` varchar(10) CHARACTER SET utf8 NOT NULL,
  `Origin` varchar(10) CHARACTER SET utf8 NOT NULL,
  `Destination` varchar(20) CHARACTER SET utf8 NOT NULL,
  `DepartureDate` date NOT NULL,
  `DepartureTime` time NOT NULL,
  `ArrivalDate` date NOT NULL,
  `ArrivalTime` time NOT NULL,
  `RegistrationNumber` varchar(2) NOT NULL,
  PRIMARY KEY (`FlightNumber`),
  KEY `RegistrationNumber` (`RegistrationNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Flights`
--

INSERT INTO `Flights` (`FlightNumber`, `Origin`, `Destination`, `DepartureDate`, `DepartureTime`, `ArrivalDate`, `ArrivalTime`, `RegistrationNumber`) VALUES
('AP5401', 'Alghero', 'Rome', '2013-07-11', '07:00:00', '2013-07-11', '13:15:00', 'A6'),
('AZ608', 'Rome', 'New York', '2013-07-12', '09:50:00', '2013-07-12', '13:15:00', 'A3'),
('CY312', 'Larnaca', 'Athens', '2013-06-26', '10:15:00', '2013-06-26', '12:00:00', 'A2'),
('CY337', 'Athens', 'Larnaca', '2013-06-30', '18:50:00', '2013-06-30', '20:25:00', 'A1'),
('CY386', 'Larnaca', 'Paris', '2013-01-02', '10:20:00', '2013-01-02', '13:55:00', 'A1'),
('CY487', 'Moscow', 'Larnaca', '2013-07-10', '15:40:00', '2013-07-10', '19:15:00', 'A4'),
('LH510', 'Frankfurt', 'Buenos Aires', '2014-08-23', '10:20:00', '2014-08-23', '19:05:00', 'A6'),
('QR624', 'Doha', 'Bali', '2014-09-30', '01:35:00', '2014-09-30', '18:00:00', 'A5');

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE IF NOT EXISTS `Orders` (
  `Order_id` int(11) NOT NULL,
  `ISBN` varchar(100) NOT NULL,
  `Customer_id` int(11) NOT NULL,
  `Date_placed` date DEFAULT NULL,
  `Time_placed` time DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`Order_id`),
  UNIQUE KEY `ISBN` (`ISBN`),
  UNIQUE KEY `Customer_id` (`Customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Orders`
--


-- --------------------------------------------------------

--
-- Table structure for table `Passengers`
--

CREATE TABLE IF NOT EXISTS `Passengers` (
  `EmailAddress` varchar(50) CHARACTER SET utf8 NOT NULL,
  `GivenNames` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Surname` varchar(20) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`EmailAddress`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Passengers`
--

INSERT INTO `Passengers` (`EmailAddress`, `GivenNames`, `Surname`) VALUES
('amela@hotmail.com', 'Isaac', 'Amela'),
('ch.nicolaou@gmail.com', 'Christina', 'Nicolaou'),
('costas@gmail.com', 'costas', 'tziouvas'),
('marsal2@hotmail.com', 'Maria', 'Salpingidou'),
('raimondo@yahoo.com', 'Francesco ', 'Raimondo'),
('rob.j@yahoo.com', 'Rob', 'Jelier'),
('roma6@gmail.com', 'Ines', 'Roman');

-- --------------------------------------------------------

--
-- Table structure for table `Programs`
--

CREATE TABLE IF NOT EXISTS `Programs` (
  `ProgramId` varchar(40) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `CreditPoints` smallint(5) unsigned NOT NULL,
  `YearCommerced` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ProgramId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Programs`
--

INSERT INTO `Programs` (`ProgramId`, `Name`, `CreditPoints`, `YearCommerced`) VALUES
('CIS', 'Communication and Internet Studies', 240, 2007),
('EE', 'Electrical Engineering', 240, 2007),
('IT', 'Information Technology', 240, 2009),
('LCE', 'Language Center', 240, 2007),
('ME', 'Mechanical Engineeringg', 240, 2007);

-- --------------------------------------------------------

--
-- Table structure for table `Students`
--

CREATE TABLE IF NOT EXISTS `Students` (
  `StudentID` int(10) unsigned NOT NULL,
  `GivenNames` varchar(20) NOT NULL,
  `Surname` varchar(20) NOT NULL,
  `Date_of_Birth` date NOT NULL,
  `YearEnrolled` smallint(6) DEFAULT NULL,
  `programId` varchar(40) NOT NULL,
  PRIMARY KEY (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Students`
--

INSERT INTO `Students` (`StudentID`, `GivenNames`, `Surname`, `Date_of_Birth`, `YearEnrolled`, `programId`) VALUES
(2514, 'Christos', 'Christodoulou', '1997-07-03', 2015, 'CIS'),
(5336, 'Andreas', 'Andreou', '2013-12-04', 2015, 'CIS'),
(5337, 'Andreas', 'Andreou', '2013-12-04', 2015, 'CIS'),
(5521, 'Costas', 'Tzouvas', '1995-05-05', 2013, 'LCE'),
(6363, 'Ebolas', 'Kaminaridis', '1996-10-10', 2009, 'CIS');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Books`
--
ALTER TABLE `Books`
  ADD CONSTRAINT `Books_ibfk_1` FOREIGN KEY (`Author_id`) REFERENCES `Authors` (`Author_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Courses`
--
ALTER TABLE `Courses`
  ADD CONSTRAINT `Courses_ibfk_1` FOREIGN KEY (`ProgramId`) REFERENCES `Programs` (`ProgramId`) ON DELETE CASCADE;

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_2` FOREIGN KEY (`Customer_id`) REFERENCES `Customers` (`Customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `Books` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE;
