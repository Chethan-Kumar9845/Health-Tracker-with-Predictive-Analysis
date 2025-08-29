-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2025 at 02:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--Author : Chethan Kumar
--          AIET Mijar


-- Database: `health_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `health_reports`
--

CREATE TABLE `health_reports` (
  `id` int(11) NOT NULL,
  `heartbeat` int(11) DEFAULT NULL,
  `sleep_hour` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `is_overweight` tinyint(1) DEFAULT NULL,
  `is_underweight` tinyint(1) DEFAULT NULL,
  `is_sleep_deprived` tinyint(1) DEFAULT NULL,
  `is_tachycardic` tinyint(1) DEFAULT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT NULL,
  `precautions` text DEFAULT NULL,
  `bmi` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `health_reports`
--

INSERT INTO `health_reports` (`id`, `heartbeat`, `sleep_hour`, `age`, `height`, `weight`, `is_overweight`, `is_underweight`, `is_sleep_deprived`, `is_tachycardic`, `report_date`, `status`, `precautions`, `bmi`) VALUES
(87, 90, 7, 20, 160, 51, NULL, NULL, NULL, NULL, '2025-01-05 13:18:23', 'Normal', '<ul>\r\n            <li>Maintain your current healthy lifestyle.</li>\r\n            <li>Ensure a balanced diet and regular physical activity.</li>\r\n        </ul>', 19.9219);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`, `pincode`, `photo`) VALUES
(7, 'Chethan', 'ckchethan9845@gmail.com', '$2y$10$edxVKEmVXovFRNEIw01G4.IkZI.OyUf3Jsgybs99ktSjghT87ihQG', '2-55 Poopadikallu karenki site badaga yedapadavu', '574267', ''),
(21, 'Chethan Kumar', 'chethukumar9845@gmail.com', '$2y$10$Eab1FnOlhooC6s.Ny9PX7.Kn/eUlXUQ9xgkH6Di9jNukIK8GUUV3S', '2-55 Poopadikallu karenki site badaga yedapadavu', '574267', 'uploads/4al22cs030_Chethan Kumar.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `health_reports`
--
ALTER TABLE `health_reports`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `health_reports`
--
ALTER TABLE `health_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
