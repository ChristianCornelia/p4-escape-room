-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2026 at 02:52 PM
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
  `riddle` varchar(255) NOT NULL,
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
(15, 'Ik ben de populairste vocaloid, wie ben ik?', 'Hatsune Miku', 'Ze heeft blauw haar', 2),
(16, 'Ik ben de enige vocaloid met een vrouwelijke \"mirror image\"! Wie ben ik?', 'Kagamine Len', 'De mirror image van Ren met blond haar', 2),
(17, 'Ik ben de langste vocaloid, 180cm lang! Wie ben ik?', 'Camui Gakpo', 'Ze heeft paars haar\r\n', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `riddles`
--
ALTER TABLE `riddles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `riddles`
--
ALTER TABLE `riddles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
