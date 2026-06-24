-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2026 at 06:53 PM
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
-- Database: `escape-room`
--

-- --------------------------------------------------------

--
-- Table structure for table `riddles`
--

CREATE TABLE `riddles` (
  `id` int(11) NOT NULL,
  `riddle` varchar(512) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `hint` varchar(255) DEFAULT NULL,
  `roomId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riddles`
--

INSERT INTO `riddles` (`id`, `riddle`, `answer`, `hint`, `roomId`) VALUES
(10, 'Ik ben doodstil, tot het te laat is! Wie ben ik?', 'Creeper', 'Hij is lichtgroen van kleur', 1),
(11, 'Wat is het eerste wat een speler doet bij het maken van een minecraft wereld?', 'Boom hakken', 'hoe krijg je hout?', 1),
(12, 'Welke minecraft biome heeft de hoogste bomen?', 'Jungle', 'Hier vind je de parrot en de ocelot!', 1),
(15, 'Je liep op straat, maar voelde opeens pijn op je hoofd en viel flauw. Je wordt wakker in de kelder van het hoofdkwartier van de mafia. De deur heeft geen handel, alleen een sleutelgat.\r\nJe ziet 3 dingen op de grond: \r\n1 Een sleutel\r\n2 Een hotelkaart\r\n3 Een crowbar\r\n', 'De hotelkaart', 'De deur heeft geen handel, maar is niet op slot...', 2),
(16, 'Je glijdt de hotelkaart langs de deur grendel en krijgt de deur open. Je komt in een donkere gang terecht. Aan het einde zie je een bewaker die in slaap is gevallen. Op zijn riem hangen 3 dingen:\r\n1 Een pistool\r\n2 Een fluitje\r\n3 Een radio', 'radio', '', 2),
(17, 'Je gebruikt de radio en hoort een stem: \"Als je ontsnapt wil, geef het woord dat past: Ik heb honger als een ____\"', 'wolf', '', 2),
(18, 'Je sluipt door de gang en komt bij een kluis. Er zit een cijferslot op met een hint op een briefje: \"Het aantal letters in de naam van de baas van de mafia is de code. Zijn naam is: Don Salvatore\"', '12', ' ', 2),
(19, 'De kluis opent en je vindt een dossier vol bewijzen tegen de mafia. Maar je moet kiezen hoe je ontsnap:\r\n1 Door het raam springen\r\n2 De politie bellen met de radio\r\n3 De bewijzen verbranden en vluchten', 'politie', ' ', 2),
(20, 'De politie is onderweg maar Don Salvatore heeft je gevonden. Hij biedt je een deal aan: \"Geef me het dossier en je mag gaan.\" Wat doe je?\r\n1 Geef hem het dossier\r\n2 Gooi het dossier uit het raam naar de politie\r\n3 Houd het dossier vast en wacht op de politie', 'raam', ' ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `teamName` varchar(100) NOT NULL,
  `startTime` datetime DEFAULT NULL,
  `room1StartTime` datetime DEFAULT NULL,
  `room2StartTime` datetime DEFAULT NULL,
  `finishTime` datetime DEFAULT NULL,
  `completionTimeSeconds` int(11) DEFAULT NULL,
  `status` enum('in_progress','won','lost') NOT NULL DEFAULT 'in_progress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `teamName`, `startTime`, `room1StartTime`, `room2StartTime`, `finishTime`, `completionTimeSeconds`, `status`) VALUES
(1, 'red', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(2, 'blue', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(3, 'yellow', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(4, 'green', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(5, 'purple', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(6, 'orange', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(7, 'pink', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(8, 'cyan', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(9, 'brown', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(10, 'black', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(11, 'white', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(12, 'grey', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(13, 'beige', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(14, 'magenta', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(15, 'teal', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(16, 'maroon', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(17, 'peach', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(18, 'charcoal', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(19, 'olive', NULL, NULL, NULL, NULL, NULL, 'in_progress'),
(20, 'neon', NULL, NULL, NULL, NULL, NULL, 'in_progress');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwordHash` varchar(255) NOT NULL,
  `teamId` int(11) DEFAULT NULL,
  `admin` int(1) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `lastLogin` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `passwordHash`, `teamId`, `admin`, `createdAt`, `lastLogin`) VALUES
(2, 'admin', '$2y$10$oZpiJRczKZ6fR3NPl7Ej9Oyc5UFGT.h.eK5lyAmSl3zuUynOO8Soa', 1, 1, '2026-06-21 18:23:19', NULL),
(3, 'Simon', '$2y$10$fM/vQtim5VSxNgJMbrFic.k02QobYaKQFMZOCn0T/BYFy7NW3Ubcu', NULL, 0, '2026-06-21 23:13:14', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `riddles`
--
ALTER TABLE `riddles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_users_team` (`teamId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `riddles`
--
ALTER TABLE `riddles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_team` FOREIGN KEY (`teamId`) REFERENCES `teams` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
