-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2025 at 07:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `category`, `cover_image`, `views`, `description`, `created_at`) VALUES
(24, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', 'Fantasy', 'harry.jpg', 34000, 'The first book in the Harry Potter series, introducing the wizarding world and the adventures of Harry Potter.', '2025-06-12 01:45:47'),
(25, 'The Great Gatsby', 'F. Scott Fitzgerald', 'Fiction', 'gatsby.jpg', 15400, 'A classic novel about the American dream and the enigmatic Jay Gatsby.', '2025-06-12 01:45:47'),
(26, 'The Night Circus', 'Erin Morgenstern', 'Fantasy', 'night.jpg', 17600, 'A magical competition between two young illusionists at a mysterious circus.', '2025-06-12 01:45:47'),
(27, 'Runaway', 'Alice Munro', 'Literary Fiction', 'runaway.jpg', 18500, 'A collection of stories about women and the choices they make in life and love.', '2025-06-12 01:45:47'),
(28, 'Emilia: Finding My Forever', 'Enzo & Elianna', 'Romance', 'emilia.jpg', 25000, 'Emilia is a mixture of Enzo and Elianna—strong, fearless, and headstrong in the face of love and adversity.', '2025-06-12 01:45:47'),
(29, 'Mickey Mouse Adventures', 'Walt Disney', 'Children', 'mickeymouse.jpg', 22000, 'A delightful collection of Mickey Mouse stories for kids and the young at heart.', '2025-06-12 01:50:58'),
(30, 'The Care and Keeping of You', 'Valorie Schaefer', 'Health', 'thecare.jpg', 14500, 'A popular guide for young girls on understanding and caring for their bodies.', '2025-06-12 01:50:58'),
(31, 'The Secret', 'Rhonda Byrne', 'Self-help', 'thesecret.jpg', 48000, 'A book about the law of attraction and the power of positive thinking.', '2025-06-12 01:50:58'),
(32, 'The Police Car Adventure', 'Jane Smith', 'Children', 'thepolicecar.jpg', 9500, 'A thrilling children\'s story following a brave little police car on a mission.', '2025-06-12 01:50:58'),
(33, 'Imperfect', 'Colleen Hoover', 'Romance', 'imperfect.jpg', 20000, 'A moving love story that explores pain, healing, and second chances.', '2025-06-12 01:50:58'),
(34, 'Make Your Bed', 'William H. McRaven', 'Motivational', 'make.jpg', 30000, 'Simple life lessons from a Navy SEAL that can change your life and maybe the world.', '2025-06-12 01:50:58'),
(38, 'Jas and Jud', 'Jaspher Baldicanas', 'Romance', 'WIN_20250614_10_18_05_Pro.jpg', 0, 'Jas and Jud sitting on a tree K - I - S - S - I - N - G', '2025-06-15 17:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_books`
--

CREATE TABLE `borrowed_books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrow_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fantasy`
--

CREATE TABLE `fantasy` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `availability_status` varchar(50) DEFAULT NULL,
  `location_library` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `featured_books`
--

CREATE TABLE `featured_books` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `featured_position` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `featured_books`
--

INSERT INTO `featured_books` (`id`, `book_id`, `featured_position`, `created_at`) VALUES
(4, 24, 'homepage', '2025-06-12 16:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `horror`
--

CREATE TABLE `horror` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `availability_status` varchar(50) DEFAULT NULL,
  `location_library` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reading_history`
--

CREATE TABLE `reading_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `read_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `romance`
--

CREATE TABLE `romance` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `availability_status` varchar(50) DEFAULT NULL,
  `location_library` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','admin') DEFAULT 'student',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Juan Dela Cruz', 'juan@example.com', '123456', 'student', '2025-06-11 16:31:48'),
(2, 'Tj', 'torrestj62@gmail.com', 'tjay123', 'student', '2025-06-11 10:29:08'),
(3, 'ayoko', 'anghirapnaman@gmail.com', 'haynaku123', 'student', '2025-06-11 10:43:17'),
(4, 'tj', 'tjay@gmail.com', 'tjay123', 'student', '2025-06-11 10:54:26'),
(7, 'Tj', 'torrestj@gmail.com', '1234', 'student', '2025-06-11 15:09:07'),
(8, 'tj', 'tj12@gmail.com', '12345', 'student', '2025-06-11 15:10:10'),
(9, 'Tj', 'tjay13@gmail.com', '1234', 'student', '2025-06-11 15:21:59'),
(10, 'tj', 'torrestjay12', '12345', 'student', '2025-06-14 02:31:59'),
(11, 'Teodoro', 'Teodoro12@gmail.com', '12345', 'student', '2025-06-14 02:37:21'),
(12, 'Daniel', 'Daniel@gmail.com', 'dj1234', 'student', '2025-06-15 02:18:22'),
(13, 'Admin User', 'admin@example.com', 'admin123', 'admin', '2025-06-15 02:33:50'),
(14, 'Student User', 'student@example.com', 'student123', 'student', '2025-06-15 02:33:50'),
(15, 'Tj', 'torres@gmail.com', '12345', 'student', '2025-06-15 02:36:29'),
(16, 'Teodoro', 'Teodoro@gmail.com', '12345', 'student', '2025-06-15 02:38:03'),
(17, 'john jaspher', 'jaspherbaldicanas@gmail.com', 'asdasdasd', 'student', '2025-06-15 09:37:12'),
(18, 'TJ', 'tj123@gmail.com', '12345', 'student', '2025-06-15 09:45:23'),
(19, 'tj', 'tj124@gmail.com', '12345', 'student', '2025-06-15 14:27:09'),
(20, 'Tj', 'admin@gmail.com', '321', 'admin', '2025-06-15 14:30:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `fantasy`
--
ALTER TABLE `fantasy`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `featured_books`
--
ALTER TABLE `featured_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `horror`
--
ALTER TABLE `horror`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `reading_history`
--
ALTER TABLE `reading_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `romance`
--
ALTER TABLE `romance`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `fantasy`
--
ALTER TABLE `fantasy`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `featured_books`
--
ALTER TABLE `featured_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `horror`
--
ALTER TABLE `horror`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reading_history`
--
ALTER TABLE `reading_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `romance`
--
ALTER TABLE `romance`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD CONSTRAINT `borrowed_books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrowed_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `featured_books`
--
ALTER TABLE `featured_books`
  ADD CONSTRAINT `featured_books_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reading_history`
--
ALTER TABLE `reading_history`
  ADD CONSTRAINT `reading_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reading_history_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
