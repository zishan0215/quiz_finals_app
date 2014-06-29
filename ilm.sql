-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 21, 2014 at 11:39 AM
-- Server version: 5.5.34-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ilm`
--

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `pass` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name`, `score`, `pass`) VALUES
(1, 'Zishan Ahmad', 320, 0),
(2, 'Md Shahjahan', 335, 0),
(3, 'Ahsan Kamal', 315, 0),
(4, 'Raghib Ahsan', 280, 0),
(5, 'Rehan Raza', 365, 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `content`) VALUES
(1, 'Which word is mentioned maximum times in the Glorious Qur’an ?'),
(2, 'What is the exact meaning of the word “Rabb”?'),
(3, 'How many different names of Allah are mentioned in the Qur’an?'),
(4, 'Where is Allah?'),
(5, 'Who will be thrown to the absolute lowest depths of the Hell Fire ?'),
(6, 'How many Surahs in the Quran start with ''Bismillah ar-Rahmaan ar-Raheen''?'),
(7, 'Something here'),
(8, 'Something here'),
(9, 'Something here'),
(10, 'Something here'),
(11, 'Something here'),
(12, 'Something here'),
(13, 'Something here'),
(14, 'Something here'),
(15, 'Something here'),
(16, 'Something here'),
(17, 'Something here'),
(18, 'Something here'),
(19, 'Something here'),
(20, 'Something here');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
