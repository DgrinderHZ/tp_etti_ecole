-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2023 at 06:57 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecole_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contenirs`
--

CREATE TABLE `contenirs` (
  `id_formation` int(11) NOT NULL,
  `id_module` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `enseigners`
--

CREATE TABLE `enseigners` (
  `id_user` int(11) NOT NULL,
  `id_module` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `examens`
--

CREATE TABLE `examens` (
  `id` int(11) NOT NULL,
  `titre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `formations`
--

CREATE TABLE `formations` (
  `id` int(11) NOT NULL,
  `code` varchar(4) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `code` varchar(4) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `code`, `titre`, `description`) VALUES
(1, 'WDPH', 'Web Dynamique avec PHP', ''),
(2, 'PEJS', 'Programmation evenementelle JS', '');

-- --------------------------------------------------------

--
-- Table structure for table `passers`
--

CREATE TABLE `passers` (
  `id_user` int(11) NOT NULL,
  `id_module` int(11) NOT NULL,
  `id_examen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `types_user`
--

CREATE TABLE `types_user` (
  `id` int(11) NOT NULL,
  `titre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `types_user`
--

INSERT INTO `types_user` (`id`, `titre`) VALUES
(1, 'Etudiant'),
(2, 'Formateur'),
(3, 'DBA');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nom` varchar(25) DEFAULT NULL,
  `prenom` varchar(25) DEFAULT NULL,
  `tel` varchar(14) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `id_type` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nom`, `prenom`, `tel`, `email`, `password`, `id_type`, `created_at`) VALUES
(1, 'admin', 'Zekkouri', 'HassanAd', '+212656139568', 'hassanzekkouri@gmail.com', '$2y$10$iBniOZXMAxPBAuTdI6qi.eH0T4ASKZUhiNiRdOlc3lQkE9Y3FR5WG', 2, '2023-02-04 18:45:02'),
(2, 'administrateur', 'DBA', 'DBA', 'DBA', 'DBA', '$2y$10$cOIY0i9DAg98y.9CKeQQZub6Mr.LxgPYS7ZFM.cMsiFL.uho5lcLi', 3, '2023-02-06 18:05:12'),
(3, 'admin3', 'Bruce', 'Li', '0656139568', 'bruce@gmail.com', '$2y$10$LJE2XmGmuEXPhvhbKloJkO3tvKyhvD5GkK56IZcRrRa7nuQSLzcT2', 2, '2023-02-06 17:30:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contenirs`
--
ALTER TABLE `contenirs`
  ADD PRIMARY KEY (`id_formation`,`id_module`),
  ADD KEY `id_module` (`id_module`);

--
-- Indexes for table `enseigners`
--
ALTER TABLE `enseigners`
  ADD PRIMARY KEY (`id_user`,`id_module`),
  ADD KEY `id_module` (`id_module`);

--
-- Indexes for table `examens`
--
ALTER TABLE `examens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `passers`
--
ALTER TABLE `passers`
  ADD PRIMARY KEY (`id_user`,`id_module`,`id_examen`),
  ADD KEY `id_module` (`id_module`),
  ADD KEY `id_examen` (`id_examen`);

--
-- Indexes for table `types_user`
--
ALTER TABLE `types_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_type` (`id_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `examens`
--
ALTER TABLE `examens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `formations`
--
ALTER TABLE `formations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `types_user`
--
ALTER TABLE `types_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contenirs`
--
ALTER TABLE `contenirs`
  ADD CONSTRAINT `contenirs_ibfk_1` FOREIGN KEY (`id_formation`) REFERENCES `formations` (`id`),
  ADD CONSTRAINT `contenirs_ibfk_2` FOREIGN KEY (`id_module`) REFERENCES `modules` (`id`);

--
-- Constraints for table `enseigners`
--
ALTER TABLE `enseigners`
  ADD CONSTRAINT `enseigners_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `enseigners_ibfk_2` FOREIGN KEY (`id_module`) REFERENCES `modules` (`id`);

--
-- Constraints for table `passers`
--
ALTER TABLE `passers`
  ADD CONSTRAINT `passers_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `passers_ibfk_2` FOREIGN KEY (`id_module`) REFERENCES `modules` (`id`),
  ADD CONSTRAINT `passers_ibfk_3` FOREIGN KEY (`id_examen`) REFERENCES `examens` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `types_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
