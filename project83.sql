-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 11:00 AM
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
-- Database: `project83`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `img`, `role`, `created_at`) VALUES
(1, 'Aiman Ghazi', 'aiman@ghazi.com', '$2y$10$cxJM2XjLzFr6aSzqcWJKvuUBD.klPbEAgx56VFpC3rf5.o2C/2KIS', NULL, 'user', '2024-10-19 08:12:14'),
(2, 'Protikkha Tanwi', 'protikkha@tanwi.com', '$2y$10$1FB53J52EOmYK2Gxi6WjOOsND4WYgA4XaVHpH/34GyzaJnvaEuPI6', NULL, 'user', '2024-10-19 08:14:39'),
(3, 'Asif Abir', 'asif@dti.ac', '$2y$10$F2eKjhc95Q4cOX.QNCeIO.iF/crAjzkJHkWToruxZR.xBqNBG88Li', 'uploads/67137237af4169.38411104.jpg', 'admin', '2024-10-19 08:15:36'),
(4, 'Muzahidul Islam', 'muzahid@gmail.com', '$2y$10$w9Jg25vt/6pdqpxUjLvure.VCXRbKgYSIjFXPJjLPDu.6Nps0f31u', NULL, 'user', '2024-10-19 08:17:17'),
(5, 'Golam Mostafa', 'golam@mostofa.com', '$2y$10$y5x6lk.wwlJoEuDU4l3tTOh2ryYTqCnn5VJhT7kPORJz6k9W8tG3e', NULL, 'user', '2024-10-19 08:20:53'),
(6, 'Ayan', 'ayan@gmail.com', '$2y$10$hh36/Vr7kzvXefQO30CP1O.ba9UnhtaumH0MHfY8yfDiYbhAH2Vma', NULL, 'user', '2024-10-19 08:22:57');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
