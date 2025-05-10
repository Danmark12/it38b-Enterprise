-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 04:33 PM
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
-- Database: `mf_clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `description` text NOT NULL,
  `status` enum('pending','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_type` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `event_type`, `description`, `created_at`) VALUES
(1, 1, 'login', 'dan logged in.', '2025-05-09 05:28:23'),
(2, 2, 'login', 'mac logged in.', '2025-05-09 05:28:36'),
(3, 4, 'login', 'ad logged in.', '2025-05-09 06:09:25'),
(4, 1, 'login', 'dan logged in.', '2025-05-09 09:02:05'),
(5, 3, 'login', 'aud logged in.', '2025-05-09 09:02:25'),
(6, 4, 'login', 'ad logged in.', '2025-05-09 09:02:36'),
(7, 2, 'login', 'mac logged in.', '2025-05-09 09:03:27'),
(8, 4, 'login', 'ad logged in.', '2025-05-09 09:15:47'),
(9, 4, 'logout', 'ad logged out.', '2025-05-09 09:33:08'),
(10, 2, 'login', 'mac logged in.', '2025-05-09 11:48:58'),
(11, 2, 'logout', 'mac logged out.', '2025-05-09 11:49:06'),
(12, 4, 'login', 'ad logged in.', '2025-05-09 11:49:14'),
(13, 1, 'login', 'dan logged in.', '2025-05-09 11:51:40'),
(14, 1, 'login', 'dan logged in.', '2025-05-09 11:53:57'),
(15, 1, 'logout', 'dan logged out.', '2025-05-09 11:54:58'),
(16, 1, 'login', 'dan logged in.', '2025-05-09 11:55:12'),
(17, 1, 'logout', 'dan logged out.', '2025-05-09 12:52:41'),
(18, 1, 'login', 'dan logged in.', '2025-05-10 22:25:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `user_type` enum('patient','admin','nurse','doctor') NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `user_type`, `password_hash`, `created_at`, `last_login`) VALUES
(1, 'dan', 'mark', 'danmarkpetalcurin@gmail.com', '09364119620', 'patient', '$2y$10$9jw31RSbvRhLJILAPX.fp.LB5PWvPoO/0ZYoLtKSsSpd6BIyerjnS', '2025-05-08 21:26:35', '2025-05-10 22:25:15'),
(2, 'mac', 'koy', 'a@gamil.com', '09364119620', 'admin', '$2y$10$tW7MMWj8CtU31OTyU64SeOReR0JJopwk5jU6D3yEtvGvtV8fMmuDa', '2025-05-08 21:28:11', '2025-05-09 11:48:58'),
(3, 'aud', 'dee', 'dee@gmail.com', '09364119620', 'patient', '$2y$10$YmbUAaLARqmqhc54FEPjQuNM1HNjPJU9bsango86xggU4t/r0RJCa', '2025-05-08 22:06:02', '2025-05-09 09:02:25'),
(4, 'ad', 'wee', 'daphnae27@gmail.com', '09364119620', 'patient', '$2y$10$ULH1EbiigNIU53S5qfkzDOfH5j8CZXORjyIpIAOEfkKkz8qh0YJ3O', '2025-05-08 22:08:53', '2025-05-09 11:49:14'),
(5, 'rea', 'daad', 'd@gmail.com', '09364119620', 'patient', '$2y$10$b4dx.4cJQTFd2qcLXGIvaOIUwkOdrSsngURyztjiyKn66fUPRUTVe', '2025-05-09 02:09:32', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
