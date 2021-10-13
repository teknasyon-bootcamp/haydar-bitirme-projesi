-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Generation Time: Oct 13, 2021 at 07:14 PM
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(7, 'Kategori örnek'),
(8, 'Kategori örnek 2');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `news_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `delete_request` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `role_level`, `delete_request`) VALUES
(1, 'admin@a.com', '$2y$10$Y8l.f0Ei/AAmeEplR4iRuuhhJ9BGPRMggfu2L4bsEtB0LZufnL86u', 'admin kullanıcı', 4, 0),
(3, 'editor@a.com', '$2y$10$Y8l.f0Ei/AAmeEplR4iRuuhhJ9BGPRMggfu2L4bsEtB0LZufnL86u', 'editör kullanıcı', 2, 0),
(4, 'mod@a.com', '$2y$10$Y8l.f0Ei/AAmeEplR4iRuuhhJ9BGPRMggfu2L4bsEtB0LZufnL86u', 'mod kullanıcı', 3, 0),
(8, 'halk@a.com', '$2y$10$Y8l.f0Ei/AAmeEplR4iRuuhhJ9BGPRMggfu2L4bsEtB0LZufnL86u', 'bahtsız kullanıcı', 1, 1),
(9, 'vatandas@a.com', '$2y$10$Umle9gwpOe4d2G2rIm3tOO2rtEpBEQCYSMcNbY1qwv8g5i7/u.DuO', 'bahtsız Kullanıc', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_categories`
--

CREATE TABLE `users_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_categories`
--

INSERT INTO `users_categories` (`id`, `category_id`, `user_id`) VALUES
(15, 7, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user_followed_categories`
--

CREATE TABLE `user_followed_categories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_followed_categories`
--

INSERT INTO `user_followed_categories` (`id`, `user_id`, `category_id`) VALUES
(4, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user_seen_news`
--

CREATE TABLE `user_seen_news` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`news_id`),
  ADD KEY `news_comment` (`news_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_iliski` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_categories`
--
ALTER TABLE `users_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_iliski` (`category_id`),
  ADD KEY `users_iliski` (`user_id`);

--
-- Indexes for table `user_followed_categories`
--
ALTER TABLE `user_followed_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_followed_category_id` (`category_id`),
  ADD KEY `user_followed_category_user_id` (`user_id`);

--
-- Indexes for table `user_seen_news`
--
ALTER TABLE `user_seen_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_seen_news_user` (`user_id`),
  ADD KEY `user_seen_news_news` (`news_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users_categories`
--
ALTER TABLE `users_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_followed_categories`
--
ALTER TABLE `user_followed_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_seen_news`
--
ALTER TABLE `user_seen_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `news_comment` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_comment` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `iliski` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_iliski` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_categories`
--
ALTER TABLE `users_categories`
  ADD CONSTRAINT `category_iliski` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_iliski` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_followed_categories`
--
ALTER TABLE `user_followed_categories`
  ADD CONSTRAINT `user_followed_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_followed_category_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_seen_news`
--
ALTER TABLE `user_seen_news`
  ADD CONSTRAINT `user_seen_news_news` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_seen_news_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
