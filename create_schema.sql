
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE `address_book`;

USE `address_book`;

CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT ,
  `name` varchar(100) NOT NULL,
  `code` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `street` text NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `city` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`city`) REFERENCES cities(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
