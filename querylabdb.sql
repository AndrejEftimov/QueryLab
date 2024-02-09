-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2024 at 05:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `querylabdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(256) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `upvote_count` int(11) NOT NULL,
  `reply_count` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `text`, `image`, `date`, `upvote_count`, `reply_count`, `user_id`) VALUES
(1, 'Book on habits', 'Recommend me a good book about daily routines and habits', '', '2024-02-09 16:42:14', 1, 1, 2),
(4, 'Which motorcycle is in this picture?', 'Which motorcycle is in this picture?', '2023-Yamaha-MT07TR-EU-Midnight_Black-Static-001-03.jpg', '2024-02-09 16:56:18', 2, 2, 3),
(5, 'Which car is this?', 'Which car is this?', 'CS_1.jpg', '2024-02-09 17:02:32', 0, 0, 3),
(6, 'Explain PHP code', 'What does the following code do in the programming language php?', 'Screenshot 2024-02-09 170532.png', '2024-02-09 17:06:28', 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES
(1, 4),
(4, 21),
(5, 5),
(6, 7),
(6, 26);

-- --------------------------------------------------------

--
-- Table structure for table `post_upvote`
--

CREATE TABLE `post_upvote` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_upvote`
--

INSERT INTO `post_upvote` (`user_id`, `post_id`) VALUES
(2, 4),
(3, 1),
(4, 4),
(4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `upvote_count` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `text`, `date`, `upvote_count`, `post_id`, `user_id`) VALUES
(1, 'You can read \"The Power of Habit\" by Charles Duhigg, you\'re welcome :)\r\n', '2024-02-09 16:43:45', 1, 1, 3),
(2, 'The motorcycle in this picture is a Yamaha Tracer 7', '2024-02-09 16:57:07', 1, 4, 4),
(3, 'It\'s definitely a Tracer 7', '2024-02-09 16:57:55', 1, 4, 2),
(4, 'It prints or \'echoes\' the string \"I\'m here\".', '2024-02-09 17:07:47', 1, 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `reply_upvote`
--

CREATE TABLE `reply_upvote` (
  `user_id` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reply_upvote`
--

INSERT INTO `reply_upvote` (`user_id`, `reply_id`) VALUES
(2, 1),
(2, 4),
(3, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'Anime'),
(2, 'Architecture'),
(3, 'Art'),
(4, 'Books'),
(5, 'Cars'),
(6, 'Coffee'),
(7, 'Computer Science'),
(8, 'Computers'),
(9, 'Cooking'),
(10, 'Cuisine'),
(11, 'Economy'),
(12, 'Electronics'),
(13, 'Engineering'),
(14, 'Gaming'),
(15, 'Hardware'),
(16, 'Journalism'),
(17, 'Law'),
(18, 'Mathematics'),
(19, 'Medicine'),
(20, 'Meditation'),
(21, 'Motorcycles'),
(22, 'Movies'),
(23, 'Music'),
(24, 'Nature'),
(25, 'Physics'),
(26, 'Programming'),
(27, 'Psychology'),
(28, 'Software'),
(29, 'Sport'),
(30, 'Studying'),
(31, 'Travel'),
(32, 'University');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `profile_image` varchar(256) NOT NULL,
  `date_joined` datetime NOT NULL DEFAULT current_timestamp(),
  `credits` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `username`, `description`, `profile_image`, `date_joined`, `credits`, `type`) VALUES
(1, 'admin@querylab.com', 'admin123', 'Admin', '', '_default_profile_picture.png', '2024-02-09 16:33:19', 0, 'admin'),
(2, 'user1@querylab.com', 'user1', 'user1', 'I\'m a software developer with a degree in Computer Science. I take interest in many things!', 'Admin-Profile-PNG-Clipart.png', '2024-02-09 16:34:01', 3, 'user'),
(3, 'user2@querylab.com', 'user2', 'user2', 'Hi, my name is User2 and i work at a Coffee shop. I love motorcycles and cars!', 'favpng_professional-clipart.png', '2024-02-09 16:34:18', 3, 'user'),
(4, 'user3@querylab.com', 'user3', 'user3', 'I like chocolate', '_default_profile_picture.png', '2024-02-09 16:34:31', 2, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`post_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `post_upvote`
--
ALTER TABLE `post_upvote`
  ADD PRIMARY KEY (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reply_upvote`
--
ALTER TABLE `reply_upvote`
  ADD PRIMARY KEY (`user_id`,`reply_id`),
  ADD KEY `reply_id` (`reply_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `post_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);

--
-- Constraints for table `post_upvote`
--
ALTER TABLE `post_upvote`
  ADD CONSTRAINT `post_upvote_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `post_upvote_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `reply_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `reply_upvote`
--
ALTER TABLE `reply_upvote`
  ADD CONSTRAINT `reply_upvote_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `reply_upvote_ibfk_2` FOREIGN KEY (`reply_id`) REFERENCES `reply` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
