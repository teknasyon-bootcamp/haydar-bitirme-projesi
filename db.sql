-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Generation Time: Oct 22, 2021 at 06:31 PM
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
(8, 'Kategori örnek 2'),
(13, 'Örnek kategori haydar');

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

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `message`, `user_id`, `news_id`) VALUES
(24, 'Önrek yorum', 11, 14);

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

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image`, `category_id`, `user_id`, `created_at`) VALUES
(12, 'Örnek Haber', 'Örnek  Haber İçeriği', 'download-616746980fa0e.jpeg', 7, 3, '2021-10-13'),
(13, 'Örnek Haber 2 ', 'Örnek Haber 2 içeriği', 'big-616746ab93114.jpeg', 7, 3, '2021-10-13'),
(14, 'Örnek Haber 3', 'Örnek Haber 3 İçeriği', 'hardware-vs-software-616746f4c12ba.jpg', 7, 3, '2021-10-13');

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
(10, 'ornek@ornek.com', '$2y$10$mgYYGHvhJVR1IPRf7iaD4.46iPKQkiwjwugW6GzD.Gyi.C3OGDowa', 'Örnek Kullanıcı', 1, 0),
(11, 'ggg@g.com', '$2y$10$egQVmCm68ANHFbq0iMqMveOy43hCa1dOJqqsm1dyWeRJJTOpZhjLS', 'denemem ', 1, 0),
(12, 'alo@alo.com', '$2y$10$gMXZaSJ2XXhGYbtvlJqwSe1ZThh0u4ChissBSMslMdpNKrQ3LpRyq', 'Alo deneme yapıyoruz', 1, 0);

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
(16, 7, 3),
(17, 13, 3);

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
(4, 3, 7),
(7, 11, 8),
(8, 11, 7),
(10, 1, 7);

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
-- Dumping data for table `user_seen_news`
--

INSERT INTO `user_seen_news` (`id`, `user_id`, `news_id`) VALUES
(7, 3, 12),
(8, 11, 14);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users_categories`
--
ALTER TABLE `users_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_followed_categories`
--
ALTER TABLE `user_followed_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_seen_news`
--
ALTER TABLE `user_seen_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
