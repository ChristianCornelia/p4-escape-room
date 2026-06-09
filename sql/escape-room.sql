-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2026 at 06:30 PM
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
