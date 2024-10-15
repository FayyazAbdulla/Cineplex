-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 15, 2024 at 03:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cineplex_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `movie_id`, `seats`, `created_at`) VALUES
(5, 3, 4, 2, '2024-10-12 09:04:35'),
(6, 4, 5, 5, '2024-10-12 09:04:35'),
(9, 7, 8, 1, '2024-10-12 09:04:35'),
(23, 11, 1, 12, '2024-10-13 12:45:09'),
(24, 11, 3, 3, '2024-10-13 12:47:19'),
(25, 11, 1, 9, '2024-10-13 13:59:57'),
(26, 11, 2, 2, '2024-10-14 14:04:08'),
(27, 11, 4, 2, '2024-10-14 14:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `bookings_pay`
--

CREATE TABLE `bookings_pay` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','paid') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `message`, `created_at`) VALUES
(3, 3, 'Had an issue with my booking but customer service helped.', '2024-10-12 09:04:58'),
(4, 4, 'The theater was clean and well-maintained.', '2024-10-12 09:04:58'),
(7, 7, 'The movie selection is fantastic!', '2024-10-12 09:04:58'),
(9, 9, 'Could use more parking space.', '2024-10-12 09:04:58'),
(10, 10, 'Great place for family outings!', '2024-10-12 09:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `showtime` datetime NOT NULL,
  `available_seats` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `showtime`, `available_seats`, `image`, `created_at`) VALUES
(1, 'Inception', 'A thief steals corporate secrets through the use of dream-sharing technology.', '2024-10-15 18:30:00', 100, 'inception.jpg', '2024-10-12 09:04:16'),
(2, 'The Dark Knight', 'When the menace known as The Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham.', '2024-10-16 20:00:00', 80, 'dark_knight.jpg', '2024-10-12 09:04:16'),
(3, 'Interstellar', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.', '2024-10-17 19:00:00', 75, 'interstellar.jpg', '2024-10-12 09:04:16'),
(4, 'Titanic', 'A seventeen-year-old aristocrat falls in love with a kind but poor artist aboard the luxurious, ill-fated R.M.S. Titanic.', '2024-10-18 17:00:00', 50, 'titanic.jpg', '2024-10-12 09:04:16'),
(5, 'Avatar', 'In the 22nd century, a paraplegic Marine dispatched to the moon Pandora on a unique mission becomes torn between following his orders and protecting the world he feels is his home.', '2024-10-19 21:00:00', 120, 'avatar.jpg', '2024-10-12 09:04:16'),
(6, 'The Matrix', 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.', '2024-10-20 16:00:00', 90, 'matrix.jpg', '2024-10-12 09:04:16'),
(7, 'Forrest Gump', 'The presidencies of Kennedy and Johnson, the Vietnam War, the Watergate scandal and other historical events unfold through the perspective of an Alabama man with an IQ of 75.', '2024-10-21 18:00:00', 65, 'forrest_gump.jpg', '2024-10-12 09:04:16'),
(8, 'The Shawshank Redemption', 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.', '2024-10-22 19:30:00', 85, 'shawshank.jpg', '2024-10-12 09:04:16'),
(9, 'The Godfather', 'An organized crime dynasty\'s aging patriarch transfers control of his clandestine empire to his reluctant son.', '2024-10-23 20:30:00', 70, 'godfather.jpg', '2024-10-12 09:04:16'),
(10, 'Pulp Fiction', 'The lives of two mob hitmen, a boxer, a gangster\'s wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', '2024-10-24 21:30:00', 60, 'pulp_fiction.jpg', '2024-10-12 09:04:16'),
(11, 'Inception', 'A thief steals corporate secrets through dream-sharing technology.', '2024-10-12 14:00:00', 50, 'path/to/image.jpg', '2024-10-12 10:43:50'),
(12, 'The Dark Knight', 'The Joker wreaks havoc in Gotham, challenging Batman.', '2024-10-12 17:00:00', 50, 'path/to/image.jpg', '2024-10-12 10:43:50'),
(13, 'Interstellar', 'Explorers travel through a wormhole in search of humanity\'s survival.', '2024-10-12 20:00:00', 50, 'path/to/image.jpg', '2024-10-12 10:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','staff','customer') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(3, 'admin_user', 'admin123', 'admin@example.com', 'admin', '2024-10-12 09:04:04'),
(4, 'staff_member', 'staff123', 'staff@example.com', 'staff', '2024-10-12 09:04:04'),
(7, 'mike_green', 'password123', 'mike@example.com', 'customer', '2024-10-12 09:04:04'),
(9, 'david_wilson', 'password123', 'david@example.com', 'customer', '2024-10-12 09:04:04'),
(10, 'sarah_clark', 'password123', 'sarah@example.com', 'customer', '2024-10-12 09:04:04'),
(11, 'test', '$2y$10$8C4XW2ic0wZChLuCnId5sO2rf04RMofhhYrIOSUs1kUP98BuFgU56', 'test@gmail.com', 'customer', '2024-10-13 08:24:30'),
(24, 'test1', '$2y$10$MKYyl4GwRfii22JPIejsiuXwSdcpDuelPzU1iZ8.aEJNAPV/lMzLq', 'test1@gmail.com', 'customer', '2024-10-13 11:20:00'),
(25, 'test2', '$2y$10$WQT.U095Vgq3/u6u67ra9u60r/iBwAKGBtoM998TaijuDU3FHb2AC', 'test2@gmail.com', 'customer', '2024-10-13 11:20:41'),
(26, 'test3', '$2y$10$J03Z6f7m1Pv9WsMDsaJreuIMPNgFdtSgqzJP2lXjs87bValby0q2i', 'test3@gmail.com', 'customer', '2024-10-13 11:21:13'),
(27, 'test4', '$2y$10$bRsxLsVrAaxbwElmwqtLg.ZypHLrfsW95YPJYsAiW8nYrRSO5c1Pa', 'test4@gmail.com', 'customer', '2024-10-13 11:22:01'),
(28, 'test5', '$2y$10$MmoDyKNa6Bj8nxyS.22yqOS.K7M4l3dBCCC6X6zGqQYw4No3bjwg6', 'test5@gmail.com', 'customer', '2024-10-13 11:25:55'),
(29, 'test6', '$2y$10$ixWM5r2Ulm/jpIzAWyK37uXiIFieLUUdu6KOkhpms6AxgBwKA9lNe', 'test6@gmail.com', 'customer', '2024-10-13 11:28:54'),
(30, 'test7', '$2y$10$AlowDPwUEPLwnVT8Jn/Y5.OoMw5k0oZBDe90fheIZhS/Ip.k.U2LS', 'test7@gmail.com', 'customer', '2024-10-13 11:31:36'),
(31, 'testuser', 'admin123', 'testuser@example.com', 'admin', '2024-10-14 03:21:57'),
(34, 'testuser1', 'hashedpassword', 'testuser1@example.com', 'admin', '2024-10-14 03:37:20'),
(35, 'teststaffuser', '$2y$10$OFGO/iVst1oIxNkSBYvmE.ahJavupK4K0QAW4y33/zVd8fj.ZXZWm', 'teststaffuser@example.com', 'staff', '2024-10-14 03:54:52'),
(36, 'Dhanush', '$2y$10$NhOx/nJN3K1THCGxxvKUdOuhB.0pwvW0LnUpy2gOT3ov.stD2NE22', 'Dhanush@gmail.com', 'staff', '2024-10-14 04:31:03'),
(37, 'Kamal', '$2y$10$jlnXAmmjRp6dc.ouiCekw.xVc6l0Qzm.JuqqhAef7jwj3PiOtDl2e', 'kamal@gmail.com', 'staff', '2024-10-14 09:28:03'),
(40, 'Abdul', '$2y$10$Qn9Il.1/s5CSwJ/R1KUCfOHZfpTxiiKB6hqR7kd1YIThO2wJhL9hK', 'abd@gmail.com', 'admin', '2024-10-15 01:32:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `bookings_pay`
--
ALTER TABLE `bookings_pay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `bookings_pay`
--
ALTER TABLE `bookings_pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings_pay`
--
ALTER TABLE `bookings_pay`
  ADD CONSTRAINT `bookings_pay_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_pay_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
