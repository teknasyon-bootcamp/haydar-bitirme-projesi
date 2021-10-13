-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Generation Time: Oct 13, 2021 at 08:52 PM
-- Server version: 10.6.4-MariaDB-1:10.6.4+maria~focal
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hoppala`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role_level` int(11) NOT NULL DEFAULT 1,
  `delete_request` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `role_level`, `delete_request`) VALUES
(1, 'admin@a.com', '$2y$10$mgYYGHvhJVR1IPRf7iaD4.46iPKQkiwjwugW6GzD.Gyi.C3OGDowa', 'admin kullanıcı', 4, 0),
(3, 'editor@a.com', '$2y$10$mgYYGHvhJVR1IPRf7iaD4.46iPKQkiwjwugW6GzD.Gyi.C3OGDowa', 'editör kullanıcı', 2, 0),
(4, 'mod@a.com', '$2y$10$mgYYGHvhJVR1IPRf7iaD4.46iPKQkiwjwugW6GzD.Gyi.C3OGDowa', 'mod kullanıcı', 3, 0),
(8, 'halk@a.com', '$2y$10$mgYYGHvhJVR1IPRf7iaD4.46iPKQkiwjwugW6GzD.Gyi.C3OGDowa', 'bahtsız kullanıcı', 1, 1),
(9, 'vatandas@a.com', '$2y$10$mgYYGHvhJVR1IPRf7iaD4.46iPKQkiwjwugW6GzD.Gyi.C3OGDowa', 'bahtsız Kullanıc', 1, 1),
(10, 'ornek@ornek.com', '$2y$10$mgYYGHvhJVR1IPRf7iaD4.46iPKQkiwjwugW6GzD.Gyi.C3OGDowa', 'Örnek Kullanıcı', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
