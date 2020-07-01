-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 05, 2018 at 01:34 PM
-- Server version: 5.7.19
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment0`
--

-- --------------------------------------------------------

--
-- Table structure for table `topupcount`
--

DROP TABLE IF EXISTS `topupcount`;
CREATE TABLE IF NOT EXISTS `topupcount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(5) NOT NULL,
  `headcount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topupcount`
--

INSERT INTO `topupcount` (`id`, `category`, `headcount`) VALUES
(1, 'RM30', 3),
(2, 'RM20', 7),
(3, 'RM10', 3);

-- --------------------------------------------------------

--
-- Table structure for table `topuprecord`
--

DROP TABLE IF EXISTS `topuprecord`;
CREATE TABLE IF NOT EXISTS `topuprecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `topup_amount` int(2) NOT NULL,
  `datetime` datetime NOT NULL,
  `credit_after_topup` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topuprecord`
--

INSERT INTO `topuprecord` (`id`, `name`, `topup_amount`, `datetime`, `credit_after_topup`) VALUES
(75, 'demodemo', 20, '2018-07-02 14:06:58', 20),
(74, 'bnmbnm', 20, '2018-07-02 14:06:27', 20),
(73, 'ghjghj', 20, '2018-07-02 14:05:52', 20),
(72, 'rtyrty', 10, '2018-07-02 14:05:15', 10),
(71, 'zxczxc', 20, '2018-07-02 14:04:30', 20),
(70, 'asdasd', 30, '2018-07-02 14:04:07', 30),
(69, 'qweqwe', 30, '2018-07-01 23:45:30', 120),
(68, 'qweqwe', 30, '2018-07-01 23:45:24', 90),
(67, 'qweqwe', 20, '2018-07-01 23:45:17', 60),
(66, 'qweqwe', 20, '2018-07-01 23:45:07', 40),
(65, 'qweqwe', 10, '2018-07-01 23:45:00', 20),
(64, 'qweqwe', 10, '2018-07-01 23:44:49', 10),
(76, 'jkljkl', 20, '2018-07-02 20:58:06', 20);

-- --------------------------------------------------------

--
-- Table structure for table `transaction1`
--

DROP TABLE IF EXISTS `transaction1`;
CREATE TABLE IF NOT EXISTS `transaction1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `carplate` varchar(15) NOT NULL,
  `street` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `period` float NOT NULL,
  `end` datetime NOT NULL,
  `extendOn` datetime NOT NULL,
  `paid_amount(RM)` int(11) NOT NULL,
  `expired` int(1) NOT NULL,
  `user_stop` int(1) NOT NULL,
  `beforePayCredit(RM)` int(11) NOT NULL,
  `afterPayCredit(RM)` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `startTime` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction1`
--

INSERT INTO `transaction1` (`id`, `name`, `carplate`, `street`, `start`, `period`, `end`, `extendOn`, `paid_amount(RM)`, `expired`, `user_stop`, `beforePayCredit(RM)`, `afterPayCredit(RM)`, `startDate`, `startTime`) VALUES
(3, 'asdasd', 'QQQ1', 'Subang Jaya, Selangor, Malaysia', '2018-07-02 14:04:13', 24, '2018-07-03 14:04:13', '2018-07-02 14:04:13', 10, 0, 1, 30, 20, '2018-07-02', '14:04:13'),
(2, 'qweqwe', 'WWW1', 'Subang Jaya, Selangor, Malaysia', '2018-07-01 23:45:48', 1, '2018-07-02 00:45:48', '2018-07-01 23:46:06', 2, 1, 0, 120, 118, '2018-07-01', '23:45:48'),
(4, 'zxczxc', 'AAA1', 'Subang Jaya, Selangor, Malaysia', '2018-07-02 14:04:43', 1, '2018-07-02 15:04:43', '2018-07-02 14:04:48', 2, 1, 0, 20, 18, '2018-07-02', '14:04:43'),
(5, 'rtyrty', 'SSS1', 'Subang Jaya, Selangor, Malaysia', '2018-07-02 14:05:30', 0.5, '2018-07-02 14:35:30', '2018-07-02 14:05:30', 1, 1, 0, 10, 9, '2018-07-02', '14:05:30'),
(6, 'ghjghj', 'WWW1', 'Subang Jaya, Selangor, Malaysia', '2018-07-02 14:05:56', 0.5, '2018-07-02 14:35:56', '2018-07-02 14:05:56', 1, 1, 0, 20, 19, '2018-07-02', '14:05:56'),
(7, 'bnmbnm', 'ZZZ1', 'Subang Jaya, Selangor, Malaysia', '2018-07-02 14:06:40', 1, '2018-07-02 15:06:40', '2018-07-02 14:06:40', 2, 1, 0, 20, 18, '2018-07-02', '14:06:40'),
(8, 'demodemo', 'GGG1', 'Subang Jaya, Selangor, Malaysia', '2018-07-02 14:07:04', 5, '2018-07-02 19:07:04', '2018-07-02 14:07:15', 7, 1, 0, 20, 13, '2018-07-02', '14:07:04'),
(9, 'qweqwe', 'BBB1', 'Subang Jaya, Selangor, Malaysia', '2018-07-02 15:09:16', 0.5, '2018-07-02 15:39:16', '2018-07-02 15:09:16', 1, 0, 1, 118, 117, '2018-07-02', '15:09:16'),
(10, 'asdasd', 'TTT1', 'Subang Jaya, Selangor, Malaysia', '2018-07-02 20:15:34', 0.5, '2018-07-02 20:45:34', '2018-07-02 20:15:34', 1, 1, 0, 20, 19, '2018-07-02', '20:15:34'),
(11, 'asdasd', 'WWW1', 'Subang Jaya, Selangor, Malaysia', '2018-07-02 20:56:42', 1, '2018-07-02 21:56:42', '2018-07-02 20:56:55', 2, 1, 0, 19, 17, '2018-07-02', '20:56:42'),
(12, 'qweqwe', 'WWW1', 'Cyberjaya, Selangor, Malaysia', '2018-07-04 21:58:45', 24.5, '2018-07-05 22:28:45', '2018-07-04 21:58:57', 11, 0, 0, 117, 106, '2018-07-04', '21:58:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `no.` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `tel` int(15) NOT NULL,
  `credit` int(11) NOT NULL,
  `loggedInNow` int(1) NOT NULL,
  `totalSpent` int(11) NOT NULL,
  PRIMARY KEY (`no.`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`no.`, `name`, `email`, `pass`, `tel`, `credit`, `loggedInNow`, `totalSpent`) VALUES
(3, 'asdasd', 'asdasd@gmail.com', 'asdasd', 123456, 17, 0, 13),
(2, 'qweqwe', 'qweqwe@gmail.com', 'qweqwe', 1234, 106, 0, 14),
(4, 'zxczxc', 'zxczxc@gmail.com', 'zxczxc', 1234567, 18, 0, 2),
(5, 'rtyrty', 'rtyrty@gmail.com', 'rtyrty', 1234567, 9, 0, 1),
(6, 'ghjghj', 'ghjghj@gmail.com', 'ghjghj', 123456789, 19, 0, 1),
(7, 'bnmbnm', 'bnmbnm@gmail.com', 'bnmbnm', 123456789, 18, 0, 2),
(8, 'demodemo', 'demo@demo.com', 'demodemo', 11111111, 13, 0, 7),
(9, 'jkljkl', 'jkljkl@gmail.com', 'jkljkl', 123456, 20, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
