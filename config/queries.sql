-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2025 at 04:53 PM
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
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `parent_comment_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `email_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`email_id`, `user_id`, `title`, `content`, `create_date`) VALUES
(1, 1, 'The website\'s UI is suck!', 'I want to complain about this ui design.\nCan\'t you do better????', '2025-03-26 04:11:26'),
(4, 2, 'I FINALLY MADE IT', 'Did I made it?!', '2025-03-28 07:34:03'),
(5, 1, 'Check bug', 'If this actually bugged, I would be sad', '2025-04-04 13:46:43');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `module_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `module_name`, `module_description`) VALUES
(1, 'General', 'General topics'),
(2, 'OOP', 'Topics related to object-Oriented Programing'),
(3, 'Web programing', 'Topics related to web programing'),
(4, 'Fix bug', 'Help fixing errors');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `module_id`, `title`, `content`, `create_date`, `image_path`) VALUES
(1, 1, 1, 'Testing', 'This is a test posttt\r\nTest tét\r\n', '2025-03-10 15:27:54', NULL),
(3, 2, 1, 'Second post', 'This is my second post,  I used to test upload img', '2025-03-13 15:22:51', 'uploads/postAsset/bd17930fe2b4048048e40adb832b39b1.jpg'),
(7, 1, 2, 'Meme', 'Meme about all of this reality is just a dream.', '2025-03-18 10:10:38', 'uploads/postAsset/46909b0e7b1be01d5df1d347b527ab99.png'),
(10, 2, 1, 'What\'s Lorem?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', '2025-03-18 10:29:16', NULL),
(11, 1, 1, 'More posts for testing', 'Nothing\'s here, this was created to test more posts', '2025-03-23 06:07:22', NULL),
(17, 2, 1, 'ét o ét', 'I need some help on desgining UI', '2025-03-25 10:18:31', NULL),
(18, 1, 4, 'Test new function for create', 'I have just realised the diffferent between update and edit; store and create', '2025-03-26 15:47:12', NULL),
(19, 2, 4, 'test Utils\'s function', 'I hope that the new imageHandling function work', '2025-03-28 08:03:23', 'uploads/postAsset/d9821ae81ccf27a0787e095d4334d379.png'),
(20, 2, 4, 'Second test for utils\'s ImgHandling method', 'I have removed everything old. Hoping that it won\'t crash\r\nIt freaking crashed once', '2025-03-28 08:07:32', 'uploads/postAsset/ab4803155b2252b6821340bb05e6f561.png'),
(21, 2, 4, 'Test remove image', 'This is the last test on Utils\'s delete image path function\r\nIt worked', '2025-03-28 08:19:56', NULL),
(22, 2, 4, 'I think I found new error', 'Test upload again', '2025-03-28 08:50:16', 'uploads/postAsset/477d15ab7f42a13b61655d385adb5fdf.png'),
(23, 2, 4, 'test error', 'just testing', '2025-03-28 08:55:19', NULL),
(24, 9, 2, 'OOP is just way too OP', 'Have you ever heard about OOP? It\'s a very ....', '2025-03-28 09:44:21', 'uploads/postAsset/92f5df4ba94b2db3932eb07703c144fd.jpg'),
(25, 1, 4, 'Test post', 'bla bla bal', '2025-03-29 04:10:25', 'uploads/postAsset/cb236a92183dd104750de4e450a17523.png'),
(27, 9, 4, 'timeFunction', 'TestTimeFunction', '2025-04-02 04:22:11', NULL),
(28, 9, 1, 'Test create when logged in', 'Please workkkkkk', '2025-04-02 15:05:55', NULL),
(29, 2, 1, 'Test joining', 'tattaaaaaaa', '2025-04-03 07:40:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_path` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `create_date`, `image_path`, `is_admin`) VALUES
(1, 'firstUserEver', 'firstuser@example.com', '1', '2025-03-10 15:27:54', NULL, 0),
(2, 'ARTLMT', 'thanhleminh098@gmail.com', 'a', '2025-03-15 14:40:20', 'uploads/userAsset/82ac7d5079e9dc537565cc884121caf4.jpg', 0),
(3, 'newUser', 'newUser@gmail.com', '1', '2025-03-23 07:44:46', NULL, 0),
(9, 'TesterPlease', 'thanh@gmail.com', '12', '2025-03-27 03:59:52', NULL, 0),
(10, 'Test sign in system', 'signinsystem@gmail.com', '1', '2025-03-30 10:48:11', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `vote_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `vote_type` enum('up','down') NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comments_ibfk_1` (`user_id`),
  ADD KEY `comments_ibfk_2` (`post_id`),
  ADD KEY `comments_ibfk_3` (`parent_comment_id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`email_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_id`),
  ADD UNIQUE KEY `module_name` (`module_name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `posts_ibfk_1` (`user_id`),
  ADD KEY `posts_ibfk_2` (`module_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `votes_ibfk_1` (`user_id`),
  ADD KEY `votes_ibfk_2` (`post_id`),
  ADD KEY `votes_ibfk_3` (`comment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`parent_comment_id`) REFERENCES `comments` (`comment_id`) ON DELETE CASCADE;

--
-- Constraints for table `emails`
--
ALTER TABLE `emails`
  ADD CONSTRAINT `emails_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`module_id`) ON DELETE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_ibfk_3` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
