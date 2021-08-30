-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: classmysql.engr.oregonstate.edu:3306
-- Generation Time: Jun 02, 2020 at 08:10 PM
-- Server version: 10.4.11-MariaDB-log
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs340_walshb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Account`
--

CREATE TABLE `Account` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_numb` varchar(10) DEFAULT NULL,
  `psswrd` varchar(255) NOT NULL,
  `b_date` date NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Account`
--

INSERT INTO `Account` (`username`, `email`, `phone_numb`, `psswrd`, `b_date`, `name`) VALUES
('asdf', 'asdf@asdf.asdf', NULL, '$2y$10$U2tjAoOMywKbEI0HX3FKyuWFwHCRjuZwbVrP5szVA2RVQ5o9kobsi', '2020-05-31', 'asdf'),
('bmar', 'mariab@hotmail.com', NULL, 'sei34t', '1985-04-17', 'Maria Destremo'),
('calgagi', 'gaglianc@oregonstate.edu', NULL, '$2y$10$EpfrE2.rfvfFWXWSdnxl9.GsRSi1fWEUW2060rjJwDbTZkYFnN6n6', '1099-02-05', 'Calvin'),
('fallonj', 'fallonj@oregonstate.edu', NULL, 'iluv2singincar', '1964-10-10', 'Jimmy Fallon'),
('jeemclrk', 'jeremy.clarkson@gmail.com', NULL, 'bbcsucks', '1970-05-06', 'Jeremy Clarckson'),
('jorig', 'regint@yahoo.com', NULL, 'Deto5559ch', '1997-11-11', 'Regina Sparks'),
('julian', 'fortunej@oregonstate.edu', NULL, '$2y$10$AXNNzGngn5W9lkgF/UKXbugBK8dBBhgBKYykR7JoVXyuu.HoDTb0O', '0000-00-00', 'Julian'),
('kevdoggg', 'kevindo@gmail.com', NULL, 'password12', '1987-09-06', 'Kevin Dolonnie'),
('leekr', 'leekr@oregonstate.edu', NULL, '$2y$10$88cYYssgej9TUMHY0E6anOAdA/H0PhEKk.s38VcqNX0lOVojQVC0q', '2000-02-24', 'Kristina Lee'),
('mj', 'mattj@gmool.com', NULL, '$2y$10$ggNuAMeNLW9Qy0xKHbQ2COzQAs/RGYR99k3AfI4PKPBGVE2Ew8LDq', '0000-00-00', 'matthew'),
('swansong', 'ron.swanson@private_network.com', NULL, 'SuperSecurePsswrd', '1945-02-14', 'Ron Swanson'),
('Tepesh', 'someone@something.com', NULL, '$2y$10$7XUtN.kp9g3AE1j2c50YauR0pquoqCm.OEUEQlnGxKsA.3UT54Wya', '2000-09-01', 'Vlad'),
('test', 'test@test.test', NULL, '$2y$10$2P6t5aqTnLc8T8babcJHbecScrXUsAevzH0Zxo08Z1RIwfGHD2bhu', '2018-05-08', 'test'),
('test_123', 'test123@gmail.com', NULL, '$2y$10$VyXZ1Vb2IZOUsXUuKp1ocuKrKNuIZJlu7N5yti1y9uuTb9otihmlG', '1903-01-02', 'test'),
('walshb', 'walshb@oregonstate.edu', NULL, '123456789', '2000-04-20', 'Captain McAwesome');

-- --------------------------------------------------------

--
-- Table structure for table `Company`
--

CREATE TABLE `Company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type_of_company` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Company`
--

INSERT INTO `Company` (`id`, `name`, `description`, `type_of_company`, `link`) VALUES
(1, 'lanTURN', 'Creates game application software', 'Technology', 'http://lanTURN.com'),
(2, 'Bronx It', 'Wow I don\'t even know how to describe it!', 'Finance', 'www.helpme.com'),
(3, 'Caster', 'streaming website', 'Entertainment', 'http://Caster.com'),
(4, 'BackStreet', 'Retail store', 'Retail', 'http://BackStreet.com'),
(5, 'LoudSound', 'music streaming website', 'Music', 'http://LoudSound.com'),
(6, 'CrestDesigns', 'architectural home model designs', 'Real estate', 'http://CrestDesigns.com'),
(7, 'MathTutor', 'Tutors that help with math problems', 'Education', 'http://MathTutor.com'),
(8, 'SilverBuilds', 'Construction development company', 'Construction', 'http://SilverBuilds.com');

-- --------------------------------------------------------

--
-- Table structure for table `Contributed`
--

CREATE TABLE `Contributed` (
  `username` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Contributed`
--

INSERT INTO `Contributed` (`username`, `pid`) VALUES
('bmar', 2),
('fallonj', 1),
('fallonj', 2),
('fallonj', 3),
('walshb', 2),
('walshb', 3);

-- --------------------------------------------------------

--
-- Table structure for table `Employ`
--

CREATE TABLE `Employ` (
  `cid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date_employed` date NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Employ`
--

INSERT INTO `Employ` (`cid`, `username`, `date_employed`, `title`) VALUES
(1, 'walshb', '2013-01-02', 'Software Engineer'),
(2, 'kevdoggg', '2007-05-04', 'Manager'),
(3, 'fallonj', '1999-09-21', 'Fashion Designer');

-- --------------------------------------------------------

--
-- Table structure for table `Invest`
--

CREATE TABLE `Invest` (
  `username` varchar(255) NOT NULL,
  `cid` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `contract` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Invest`
--

INSERT INTO `Invest` (`username`, `cid`, `amount`, `contract`) VALUES
('bmar', 7, 90000, '20% equity, all KPI much be met as discussed, ROI must be in 2 years from the day the contract is signed'),
('fallonj', 1, 8000, '25% equity, all KPI much be met as discussed, ROI must be in 1 years from the day the contract is signed.'),
('jeemclrk', 5, 10000, '10% equity, all KPI much be met as discussed, ROI must be in 1 years from the day the contract is signed. 5000 are convertible loan.'),
('kevdoggg', 8, 25000, '10% equity, all KPI much be met as discussed, ROI must be in 1 years from the day the contract is signed. Have an extra option of investing in the next round with a 25% discount.'),
('swansong', 6, 50000, '35% equity, all KPI much be met as discussed, ROI must be in 3 years from the day the contract is signed.');

-- --------------------------------------------------------

--
-- Table structure for table `Job_listing`
--

CREATE TABLE `Job_listing` (
  `id` int(11) NOT NULL,
  `list_date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `salary` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Job_listing`
--

INSERT INTO `Job_listing` (`id`, `list_date`, `title`, `description`, `salary`, `cid`) VALUES
(1, '2020-03-05', 'Data Engineer: Remodeling database and constantly updating it.', 'Data Engineer: Remodeling database and constantly updating it.', 90000, 4),
(2, '1970-01-02', 'Big Data Engineer: Write Big Data processing algorithm and implement them into different platforms of the main system.', 'Big Data Engineer: Write Big Data processing algorithm and implement them into different platforms of the main system.', 80000, 2),
(3, '2019-03-22', 'Software Engineer: Create innovative softwares.', 'Software Engineer: Create innovative softwares.', 100000, 5),
(4, '2020-05-02', 'Cloud System Engineer: Engineering Cloud System', 'Cloud System Engineer: Engineering Cloud System', 122000, 3),
(5, '2020-09-12', 'Game Developer: Design algorithms for AI of video games and deploy it to different platforms.', 'Game Developer: Design algorithms for AI of video games and deploy it to different platforms.', 112000, 1),
(6, '2000-04-21', 'Wingsuit Tester: Spend your days testing newly approved wingsuits', 'Wingsuit Tester: Spend your days testing newly approved wingsuits', 10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `Project`
--

CREATE TABLE `Project` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `alt_link` varchar(255) DEFAULT NULL,
  `owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Project`
--

INSERT INTO `Project` (`id`, `name`, `description`, `alt_link`, `owner`) VALUES
(1, 'Penguins', 'Building robot penguins.', 'http://penguins.com', 'swansong'),
(2, 'Lasers', 'Building a laser that can destroy the moon.', 'http://lasers.com', 'walshb'),
(3, 'Money Tree', 'Producing a tree that grows money.', 'http://moneytree.com', 'fallonj'),
(4, 'Rocketship', 'Building a rocket that can go into warp drive.', 'http://rocketship.com', 'kevdoggg'),
(5, 'Super Bed', 'Inventing a bed that gives you two times the amount of sleep.', 'http://superbed.com', 'jeemclrk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `Company`
--
ALTER TABLE `Company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Contributed`
--
ALTER TABLE `Contributed`
  ADD PRIMARY KEY (`username`,`pid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `Employ`
--
ALTER TABLE `Employ`
  ADD PRIMARY KEY (`cid`,`username`,`date_employed`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `Invest`
--
ALTER TABLE `Invest`
  ADD PRIMARY KEY (`username`,`cid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `Job_listing`
--
ALTER TABLE `Job_listing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `Project`
--
ALTER TABLE `Project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`owner`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Company`
--
ALTER TABLE `Company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Job_listing`
--
ALTER TABLE `Job_listing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Project`
--
ALTER TABLE `Project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Contributed`
--
ALTER TABLE `Contributed`
  ADD CONSTRAINT `Contributed_ibfk_1` FOREIGN KEY (`username`) REFERENCES `Account` (`username`),
  ADD CONSTRAINT `Contributed_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `Project` (`id`);

--
-- Constraints for table `Employ`
--
ALTER TABLE `Employ`
  ADD CONSTRAINT `Employ_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `Company` (`id`),
  ADD CONSTRAINT `Employ_ibfk_2` FOREIGN KEY (`username`) REFERENCES `Account` (`username`);

--
-- Constraints for table `Invest`
--
ALTER TABLE `Invest`
  ADD CONSTRAINT `Invest_ibfk_1` FOREIGN KEY (`username`) REFERENCES `Account` (`username`),
  ADD CONSTRAINT `Invest_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `Company` (`id`);

--
-- Constraints for table `Job_listing`
--
ALTER TABLE `Job_listing`
  ADD CONSTRAINT `Job_listing_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `Company` (`id`);

--
-- Constraints for table `Project`
--
ALTER TABLE `Project`
  ADD CONSTRAINT `Project_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `Account` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
