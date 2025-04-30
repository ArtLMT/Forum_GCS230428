-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2025 at 08:57 AM
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
  `content` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `post_id`, `content`, `create_date`) VALUES
(1, 1, 1, 'First Comment', '2025-04-25 10:18:55'),
(2, 2, 1, 'ALO ALO', '2025-04-25 10:33:52'),
(5, 1, 1, 'test', '2025-04-25 11:09:19'),
(6, 1, 34, 'really?', '2025-04-25 11:11:04'),
(7, 1, 25, 'HaHa', '2025-04-25 11:11:32'),
(8, 1, 19, 'The ui have been improved right?', '2025-04-25 11:13:17'),
(9, 1, 7, 'Haha', '2025-04-25 11:15:54'),
(10, 1, 30, 'Test again x2', '2025-04-25 11:19:03'),
(11, 2, 38, 'Test edit\r\n', '2025-04-28 09:56:50'),
(13, 2, 25, 'This xampp\'s error is annoying, luckily I have found the way to fix that.', '2025-04-29 08:15:59'),
(14, 2, 24, 'I prefer OOP tbh', '2025-04-29 08:17:57'),
(15, 2, 24, 'I just love it', '2025-04-29 08:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `email_messages`
--

CREATE TABLE `email_messages` (
  `email_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_messages`
--

INSERT INTO `email_messages` (`email_id`, `user_id`, `title`, `content`, `create_date`) VALUES
(1, 1, 'The website\'s UI is suck!', 'I want to complain about this ui design.\nCan\'t you do better????', '2025-03-26 04:11:26'),
(4, 2, 'I FINALLY MADE IT', 'Did I make it?!', '2025-03-28 07:34:03'),
(5, 1, 'Check bugs', 'If this actually bugged, I would be sad', '2025-04-04 13:46:43'),
(6, 1, 'The new UI is so much better', 'I can\'t believe that this website\'s ui have changed that much', '2025-04-17 09:24:46'),
(7, 1, 'Test rename table', 'I rename emails to email_messages', '2025-04-28 04:53:38'),
(8, 1, 'Test new Feedback', 'Nothing here, just testing again', '2025-04-28 07:11:42');

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
(1, 'General', 'General topics!'),
(2, 'OOP', 'Topics related to object-Oriented Programing'),
(3, 'Web programing', 'Topics related to web programing'),
(4, 'Fix bug', 'Help fixing errors'),
(9, 'Test Module', 'just for testing23');

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
(1, 1, 9, 'Testing Edit', 'After being edit, I will show the error when input wrong password or email when login\r\n', '2025-03-10 15:27:54', 'uploads/postAsset/5cc41e7ae7d083e6d6f7a0d5e47fc13e.png'),
(3, 2, 1, 'Second post', 'This is my second post,  I used to test upload img', '2025-03-13 15:22:51', 'uploads/postAsset/bd17930fe2b4048048e40adb832b39b1.jpg'),
(7, 1, 2, 'Meme', 'Meme about all of this reality is just a dream.', '2025-03-18 10:10:38', 'uploads/postAsset/46909b0e7b1be01d5df1d347b527ab99.png'),
(10, 2, 1, 'What\'s Lorem?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', '2025-03-18 10:29:16', NULL),
(11, 1, 1, 'Another Test', 'Nothing\'s here, this was created to test more posts', '2025-03-23 06:07:22', NULL),
(17, 2, 1, 'SOS', 'I need help on UI design', '2025-03-25 10:18:31', NULL),
(18, 1, 4, 'Test new function for create', 'I have just realised the diffferent between update and edit; store and create', '2025-03-26 15:47:12', NULL),
(19, 2, 4, 'test Utils\'s function', 'I hope that the new imageHandling function work', '2025-03-28 08:03:23', 'uploads/postAsset/d9821ae81ccf27a0787e095d4334d379.png'),
(20, 2, 4, 'Second test for utils\'s ImgHandling method', 'I have removed everything old. Hoping that it won\'t crash\r\nIt freaking crashed once', '2025-03-28 08:07:32', 'uploads/postAsset/ab4803155b2252b6821340bb05e6f561.png'),
(21, 2, 4, 'Test remove image', 'This is the last test on Utils\'s delete image path function\r\nIt worked', '2025-03-28 08:19:56', NULL),
(22, 2, 4, 'I think I found new error', 'Test upload again', '2025-03-28 08:50:16', 'uploads/postAsset/477d15ab7f42a13b61655d385adb5fdf.png'),
(23, 2, 4, 'Admin Post', 'Admin test', '2025-03-28 08:55:19', NULL),
(24, 9, 2, 'OOP is just way too OP', 'Have you ever heard about OOP? It\'s a very ....', '2025-03-28 09:44:21', 'uploads/postAsset/92f5df4ba94b2db3932eb07703c144fd.jpg'),
(25, 1, 4, 'Test post', 'Oh no BUGSS\r\n', '2025-03-29 04:10:25', 'uploads/postAsset/cb236a92183dd104750de4e450a17523.png'),
(27, 9, 4, 'timeFunction', 'TestTimeFunction', '2025-04-02 04:22:11', NULL),
(28, 9, 1, 'Test create when logged in', 'Please workkkkkk', '2025-04-02 15:05:55', NULL),
(29, 2, 1, 'Test joining', 'tattaaaaaaa', '2025-04-03 07:40:51', NULL),
(30, 3, 3, 'Test again', 'sadada', '2025-04-06 10:30:12', NULL),
(34, 1, 9, 'Test admin create post (It worked well, thankfully)', 'I\'m editing my post', '2025-04-14 15:04:15', NULL),
(37, 2, 2, 'The benefit of OOP', 'OOP ensures modularity, reusability, and enhanced code structure by organising design around objects rather than functions. From improved security measures to streamlined code maintenance, the Advantages of Object Oriented Programming have made it a cornerstone in contemporary programming practices. (theknowledgeacademy.com)\r\n', '2025-04-27 08:31:07', 'uploads/postAsset/0ddd98353b8e18f1c11c5ba1093f6654.png'),
(38, 26, 1, 'New post from new User', 'Hi everyone this is my first Post', '2025-04-28 07:00:11', NULL);

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
(1, 'firstUserEver', 'firstuser@example.com', '$2y$10$5cj1L801PkFYg2BpuXQdbORY5YgulG8Pt9nbDe1EAywx679IC7p.e', '2025-03-10 15:27:54', 'uploads/userAsset/73e992a66b6ac98fa4a27aa9a6116552.jpg', 1),
(2, 'ARTLMT', 'thanhleminh098@gmail.com', '$2y$10$Knh/JvdPGgeX53MiMc6CLOEgF7dTHn3gmx8eLpPX9g0Nir7E12FT.', '2025-03-15 14:40:20', 'uploads/userAsset/6e5789451ef99f9ff80e2283cc8571f2.jpg', 0),
(3, 'John Doe', 'john@example.com', '$2y$10$YRZcgId2ydan8yj2Rrl6E.dza0JXiGF87qL5AgsN1EnQ1fXzDQ71S', '2025-03-23 07:44:46', NULL, 1),
(9, 'TesterPlease', 'thanh@gmail.com', '$2y$10$kF/dreYbkNs8ZCchkpLijOigsf1JJ11zBFpaGA6ZspkrJYUvRDvSK', '2025-03-29 03:59:52', NULL, 0),
(10, 'signinsystem', 'signinsystem@gmail.com', '$2y$10$Q3OrzV0C3xGbXFr6SlpJ.u52Oz7nqgvPLkZ6zQ2f3UpA6GnKEC7jK', '2025-03-30 10:48:11', NULL, 0),
(11, 'testAdminCreateUser', 'testAdmin@gmail.com', '1', '2025-04-08 10:42:10', NULL, 0),
(12, 'SpiderMan', 'Botui@gmail.com', '$2y$10$7CNnF5j1B7WbOH7jeP4N3OP/AmLxZ8nz7X8Y/crfNqkkPhd9L5oSW', '2025-04-08 10:44:16', NULL, 0),
(13, 'Thanh2006', 'thanh2006@gmail.com', '$2y$10$EOmT9jCeHV4.o1Zxf/psH.0SckK0ccADTX/qQtg1a4AL0URmQo686', '2025-04-08 10:44:42', NULL, 0),
(14, 'Cat', 'thanhtest@gmail.com', '$2y$10$bdvf2o/j4/Fk3lMU5XEE8ejsX/CibSTtmtOWvVLQALrqDafpuM6U2', '2025-04-08 10:47:35', NULL, 0),
(18, 'ARTLMT2', 'thanhLeme@gmail.com', '$2y$10$D6tuKFA12MsZZHhLNaVff.uDv9TxTT8PQifupk892NJKCnQIMm.ey', '2025-04-08 11:34:54', NULL, 0),
(19, 'ARTLMT3', 'thanhloilogin@gmail.com', '$2y$10$6CgWav1H9/4vIZ0HHju13uMajLBleE23RS2vYb0PFG1ffa.NB3EE6', '2025-04-08 11:41:54', NULL, 0),
(20, 'LogInAfterSignIn', 'LogInAfterSignIn@gmail.com', '$2y$10$EP6/fkH9kxFwCprmfSXRoefHWDnvwiiy9DNSpMIHtG2jP.JpxuVOi', '2025-04-08 11:49:21', NULL, 0),
(21, 'tesst new user', 'validate@gmail.com', '$2y$10$0KFzVYOkUNFIAwokbTdRHu051ClQqMlcaIlcyvlxa4UXZ120Ivj/i', '2025-04-17 07:04:15', NULL, 0),
(22, 'TestValidateFailed', 'newUser2@gmail.com', '$2y$10$cypj4R0R8X5XjDaOt.6s7.CADgZoYeT6ZQ5ttB38DS6lnZWpthLTm', '2025-04-17 08:27:32', NULL, 0),
(23, 'testValidate', 'validate3@gmail.com', '$2y$10$LtIzrgD9y6unw2pYI6gkQOURDa0kJ0ivvpCeUsEKKj7YPH3XIYO4C', '2025-04-17 08:31:10', NULL, 0),
(24, 'firstUserEver', 'firstuser1@example.com', '$2y$10$Xpzu2AsdhV4rXxDwZarnYeqD8kh.wASqYnyBo.GsiaVvBydNlyvNu', '2025-04-17 08:32:41', NULL, 0),
(25, 'wtf', 'firstuser3@example.com', '$2y$10$pzfd7SBx/80TxO9oNfLUve/cj8DgdHsff7HxEgrWfAwKY3BXcrv1W', '2025-04-17 08:33:25', NULL, 0),
(26, 'ImNewUserFr', 'newEmail12@gmail.com', '$2y$10$mS1a3PD1SurKJhmV709enO.PHa3tX8j5uFtJTA5K4osAS8Oi3hyIK', '2025-04-28 06:57:35', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comments_ibfk_1` (`user_id`),
  ADD KEY `comments_ibfk_2` (`post_id`);

--
-- Indexes for table `email_messages`
--
ALTER TABLE `email_messages`
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
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `email_messages`
--
ALTER TABLE `email_messages`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `email_messages`
--
ALTER TABLE `email_messages`
  ADD CONSTRAINT `email_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`module_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
