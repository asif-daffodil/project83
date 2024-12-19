-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 10:57 AM
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Cloth', '2024-12-07 08:57:33'),
(2, 'Mobile', '2024-12-07 08:59:03'),
(3, 'Sports', '2024-12-12 09:13:27'),
(4, 'Politics', '2024-12-12 09:17:17');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Aimman Ghazi', 'aiman@ghazi.com', 'SSL Certificate', 'My ssl certificate has been updated successfully.', '2024-11-23 08:54:23');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `regular_price` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `stocks` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `regular_price`, `sale_price`, `stocks`, `image`, `description`, `created_at`) VALUES
(1, 'T-Shirt', 1, 1500, 1250, 20, '173096750681wyxedDeQL._AC_SY550_.jpg', '<p><strong>Lorem Ipsum</strong><span style=\"background-color:rgb(255,255,255);color:rgb(0,0,0);\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '2024-10-26 08:41:12'),
(3, 'Tcl Folding', 1, 6000, 5000, 20, '1730364523tcl folding.jpg', '&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=&quot;background-color:rgb(255,255,255);color:rgb(0,0,0);&quot;&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;', '2024-10-31 08:48:43'),
(4, 'Asus Rog', 1, 20000, 15000, 20, '1730364551asus rog.jpg', '&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=&quot;background-color:rgb(255,255,255);color:rgb(0,0,0);&quot;&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;', '2024-10-31 08:49:11'),
(5, 'Citycell', 1, 5000, 4000, 20, '1730364636citycell.jpg', '&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=&quot;background-color:rgb(255,255,255);color:rgb(0,0,0);&quot;&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;', '2024-10-31 08:50:36'),
(6, 'iTel India', 1, 10000, 8000, 20, '1730364761itel india.jpg', '&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=&quot;background-color:rgb(255,255,255);color:rgb(0,0,0);&quot;&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;', '2024-10-31 08:52:41'),
(7, 'Motorola V3i', 1, 13000, 11000, 20, '1730364789motorola v3i.jpg', '&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=&quot;background-color:rgb(255,255,255);color:rgb(0,0,0);&quot;&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;', '2024-10-31 08:53:09'),
(8, 'Nokia 3310', 1, 3500, 2800, 20, '1730364817nokia 3310.jpg', '&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=&quot;background-color:rgb(255,255,255);color:rgb(0,0,0);&quot;&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;', '2024-10-31 08:53:37'),
(9, 'Nokia C100', 1, 15000, 12000, 20, '1730364843nokia c100.jpg', '&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=&quot;background-color:rgb(255,255,255);color:rgb(0,0,0);&quot;&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;', '2024-10-31 08:54:03'),
(10, 'Philips Diga', 1, 3500, 3000, 20, '1730364880philips diga.jpg', '&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=&quot;background-color:rgb(255,255,255);color:rgb(0,0,0);&quot;&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;', '2024-10-31 08:54:40'),
(11, 'pixel 6', 1, 15000, 12000, 20, '1730365027pixel 6.jpg', '&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=&quot;background-color:rgb(255,255,255);color:rgb(0,0,0);&quot;&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;', '2024-10-31 08:57:07'),
(12, 'pixel 7', 1, 15000, 12000, 20, '1730365062Pixel-7.jpg', '&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=&quot;background-color:rgb(255,255,255);color:rgb(0,0,0);&quot;&gt; is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;', '2024-10-31 08:57:42'),
(13, 'Stylish T-Shirt', 1, 1200, 950, 20, '173096798851HfSy7vC8L._AC_SX569_.jpg', '<p><strong>Lorem Ipsum</strong><span style=\"background-color:rgb(255,255,255);color:rgb(0,0,0);\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '2024-11-07 08:26:28'),
(14, 'Wome\'s T-shirt', 1, 2000, 1650, 20, '173097001571j0zMW9aUL._AC_SY550_.jpg', '<p><strong>Lorem Ipsum</strong><span style=\"background-color:rgb(255,255,255);color:rgb(0,0,0);\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '2024-11-07 09:00:15'),
(15, 'Pant2', 1, 3000, 2000, 20, '1733646800914jUAocoXL._AC_SY550_.jpg', '<p><strong>Lorem Ipsum</strong><span style=\"background-color:rgb(255,255,255);color:rgb(0,0,0);\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', '2024-12-08 08:33:20'),
(16, 'Haat Ghori', 1, 15000, 500, 1000, '1734598614Azu6hg0hiKh7fPNAKikWaJBTHqgLBdJY5WvhBqHs.jpg', '&lt;p&gt;Best hang clock from Mujahidul Isalm&lt;/p&gt;', '2024-12-19 08:56:54');

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
  `address_line_1` varchar(255) NOT NULL,
  `address_line_2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `img`, `role`, `address_line_1`, `address_line_2`, `city`, `state`, `zip`, `country`, `phone`, `created_at`) VALUES
(1, 'Aiman Ghazi', 'aiman@ghazi.com', '$2y$10$cxJM2XjLzFr6aSzqcWJKvuUBD.klPbEAgx56VFpC3rf5.o2C/2KIS', NULL, 'user', '', '', '', '', '', '0', '', '2024-10-19 08:12:14'),
(2, 'Protikkha Tanwi', 'protikkha@tanwi.com', '$2y$10$1FB53J52EOmYK2Gxi6WjOOsND4WYgA4XaVHpH/34GyzaJnvaEuPI6', NULL, 'user', '', '', '', '', '', '0', '', '2024-10-19 08:14:39'),
(3, 'Asif Abir', 'asif@dti.ac', '$2y$10$F2eKjhc95Q4cOX.QNCeIO.iF/crAjzkJHkWToruxZR.xBqNBG88Li', 'uploads/67137237af4169.38411104.jpg', 'admin', '', '', '', '', '', '0', '', '2024-10-19 08:15:36'),
(4, 'Muzahidul Islam', 'muzahid@gmail.com', '$2y$10$w9Jg25vt/6pdqpxUjLvure.VCXRbKgYSIjFXPJjLPDu.6Nps0f31u', NULL, 'user', '', '', '', '', '', '0', '', '2024-10-19 08:17:17'),
(5, 'Golam Mostafa', 'golam@mostofa.com', '$2y$10$y5x6lk.wwlJoEuDU4l3tTOh2ryYTqCnn5VJhT7kPORJz6k9W8tG3e', NULL, 'user', '', '', '', '', '', '0', '', '2024-10-19 08:20:53'),
(6, 'Ayan', 'ayan@gmail.com', '$2y$10$hh36/Vr7kzvXefQO30CP1O.ba9UnhtaumH0MHfY8yfDiYbhAH2Vma', NULL, 'user', '', '', '', '', '', '0', '', '2024-10-19 08:22:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
