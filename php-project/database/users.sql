-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2026 at 09:14 AM
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
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(1010) NOT NULL,
  `role_id` int(11) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `password`) VALUES
(1, 'fasdfsd', 'afsdfsa@gamil.com', 3, '$2y$10$88tH6xPcVTb.MvrEK0nGjeIeku2FQ5jDxq21MfIQLEaUYLysR4Boq'),
(3, 'Fahim', 'FAhim@gmail.com', 2, '$2y$10$d3yAEG0u9xO4//hxP8sT2um9NEK1PhIwGYLB7MJA7./Q0/S/1QEHq'),
(4, 'Fahim', 'FAhim@gmail.com', 2, '$2y$10$QRJ4iZu67Ats5jAi0dFK7OP.qpZ.ge8Hs4Qenxy6cpjeh.WAIW2vi'),
(5, 'Fahim', 'FAhim@gmail.com', 2, '$2y$10$L9jIW3gy8jkc0BPnoQ1j8eBX.xdR6SkimqRRynWcYYbOEbDpJegr6'),
(6, 'Fahim', 'FAhim@gmail.com', 2, '$2y$10$.sdT06e6DXf9AMJ52auGHOu8RQ9Gm9V1OYWo6Y6xP5EmfdVEKaCc2'),
(7, 'Fahim', 'FAhim@gmail.com', 2, '$2y$10$OMkRLCNxE8EkQoOjY/YsjOAQQPsL2FqKChFNqiKlkQ7Zcolu90N7S');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
