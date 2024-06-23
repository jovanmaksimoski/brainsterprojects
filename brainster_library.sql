-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2024 at 09:19 PM
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
-- Database: `brainster_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `author_lastname` varchar(255) NOT NULL,
  `soft_delete` smallint(5) DEFAULT 0,
  `biography` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `author_name`, `author_lastname`, `soft_delete`, `biography`) VALUES
(59, 'Herman', 'Melville', 0, 'Herman Melville was an American novelist, short story writer, and poet of the American Renaissance period. Among his best-known works are Moby-Dick; Typee, a romanticized account of his experiences in Polynesia; and Billy Budd, Sailor, a posthumously publi'),
(60, 'Andy ', 'Weir', 0, 'Andrew Taylor Weir is an American novelist. His 2011 novel The Martian was adapted into the 2015 film of the same name directed by Ridley Scott. He received the John W. Campbell Award for Best New Writer in 2016 and his 2021 novel Project Hail Mary was a f'),
(61, 'Michael ', 'Lewis', 0, 'Michael Monroe Lewis is an American author and financial journalist. He has also been a contributing editor to Vanity Fair since 2009, writing mostly on business, finance, and economics. He is known for his nonfiction work, particularly his coverage of fin'),
(62, 'William ', 'Shakespeare', 0, 'William Shakespeare was an English playwright, poet and actor. He is widely regarded as the greatest writer in the English language and the world\'s pre-eminent dramatist. He is often called England\'s national poet and the \"Bard of'),
(63, 'Frank ', 'Herbert', 0, 'Franklin Patrick Herbert Jr. was an American science-fiction author, best known for his 1965 novel Dune and its five sequels. He also wrote short stories and worked as a newspaper journalist, photographer, book reviewer, ecological consultant, and lecturer'),
(64, 'Christopher ', 'Clark', 0, 'Sir Christopher Munro Clark FBA is an Australian historian living in the United Kingdom and Germany. He is the twenty-second Regius Professor of History at the University of Cambridge. In the 2015 Birthday Honours, he was knighted for his services to Anglo'),
(65, 'Rick ', 'Riordan', 0, 'Richard Russell Riordan Jr. is an American author, best known for writing the Percy Jackson & the Olympians series. Riordan\'s books have been translated into forty-two languages and sold more than thirty million copies in the United States');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(64) NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `year_publication` int(10) UNSIGNED NOT NULL,
  `pages` int(10) UNSIGNED NOT NULL,
  `cover` varchar(128) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `soft_delete` smallint(5) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author_id`, `year_publication`, `pages`, `cover`, `category_id`, `soft_delete`) VALUES
(108, 'Moby-Dick', 59, 1851, 400, 'https://zalozbakarantanija.si/wp-content/uploads/2016/02/MobyDick_ovitek.jpg', 5, 0),
(109, 'The Martian ', 60, 2011, 369, 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcR-NBvtUK-zSobD-otNjavs2q_h7NaEEFljgBkJJ_ZnMZUUBI2q', 6, 0),
(110, 'Moneyball: The Art of Winning an Unfair Game', 61, 2003, 288, 'https://m.media-amazon.com/images/I/61t5mCFne1L._AC_UF1000,1000_QL80_.jpg', 9, 0),
(111, 'Romeo and Juliet', 62, 1597, 480, 'https://cdn.kobo.com/book-images/3d832057-7abe-4cc4-9edf-2ead33666561/1200/1200/False/romeo-and-juliet-illustrated-1.jpg', 8, 0),
(112, 'Dune', 63, 1965, 412, 'https://wordery.com/jackets/fa888fc7/dune-the-graphic-novel-book-1-dune-frank-herbert-9781419731501.jpg', 6, 0),
(113, 'Hamlet', 62, 1603, 142, 'https://rukminim2.flixcart.com/image/850/1000/l0wrafk0/book/i/q/m/hamlet-original-imagch8azer4ggkq.jpeg?q=90&crop=false', 8, 0),
(114, 'The Tempest', 62, 1623, 184, 'https://m.media-amazon.com/images/I/71wx5flBS0L._AC_UF1000,1000_QL80_.jpg', 8, 0),
(115, 'The Lightning Thief', 65, 2005, 340, 'https://cdn.rickriordan.com/wp-content/uploads/2016/04/11230842/pj-1-lightning-thief-cover-large.jpg', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(64) DEFAULT NULL,
  `soft_delete` smallint(5) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `soft_delete`) VALUES
(5, 'Adventure', 0),
(6, 'Si-FI', 0),
(7, 'Horror', 0),
(8, 'Drama', 0),
(9, 'Sports', 0),
(10, 'History', 0),
(11, 'Romance', 0);

-- --------------------------------------------------------

--
-- Table structure for table `personal_comments`
--

CREATE TABLE `personal_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `commentary` varchar(128) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `book_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `public_comments`
--

CREATE TABLE `public_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `commentary` varchar(128) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `status_comm` smallint(5) UNSIGNED DEFAULT 0,
  `book_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `public_comments`
--

INSERT INTO `public_comments` (`id`, `commentary`, `user_id`, `status_comm`, `book_id`) VALUES
(32, 'I want to read this sometime', 10, 0, 115),
(33, 'such a tragic story', 10, 0, 111),
(34, 'i recommend this book', 10, 0, 112);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(96) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(10, 'admin@gmail.com', '$2y$10$MIOamcS4uX/aIZTAfZhcKe1TwNFOiVQtkPUZs8WY/6532tJEbm/Zy'),
(11, 'jovanmaksimoskii@gmail.com', '$2y$10$Lem.A2ESZKJWnBsuuYDUKuVvj1uOhHf15meq.EE9yxxv4pMVeM2OO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_comments`
--
ALTER TABLE `personal_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `public_comments`
--
ALTER TABLE `public_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `public_comments`
--
ALTER TABLE `public_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
