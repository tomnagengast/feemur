user_system_profiles


-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 68.178.142.147
-- Generation Time: Aug 11, 2013 at 03:33 PM
-- Server version: 5.0.96
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `feemur`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(8) NOT NULL auto_increment,
  `user_username` varchar(24) NOT NULL,
  `user_firstname` varchar(24) NOT NULL,
  `user_lastname` varchar(24) NOT NULL,
  `user_email` varchar(128) NOT NULL,
  `user_about` text NOT NULL,
  `user_location` varchar(12) NOT NULL,
  `user_gender` tinyint(1) NOT NULL,
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `user_username` (`user_username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'betterphp', 'Jacek', 'Kuzemsczak', 'not@my_real_address.com', 'This is some text<br /><br />that will show up<br /><br />No idea what to write :(', 'UK', 1);
INSERT INTO `users` VALUES(2, 'bob1245', 'Bob', 'Bobson', 'bob@internet.website.com', 'My name is Bob, and my username is pretty similar.', 'US', 1);
