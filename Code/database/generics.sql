-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 12 jun 2020 om 13:17
-- Serverversie: 10.1.16-MariaDB
-- PHP-versie: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `generics`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `percentage_A_left` int(11) NOT NULL,
  `percentage_A_right` int(11) NOT NULL,
  `percentage_B_left` int(11) NOT NULL,
  `percentage_B_right` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `generics`
--

CREATE TABLE `generics` (
  `Id` int(11) NOT NULL,
  `Question` varchar(100) NOT NULL,
  `Title_left` varchar(100) NOT NULL,
  `Title_right` varchar(100) NOT NULL,
  `img1` varchar(100) NOT NULL,
  `img2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `results`
--

CREATE TABLE `results` (
  `result_id` int(11) NOT NULL,
  `prolific_id` varchar(100) NOT NULL,
  `question_num` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `grid_v` int(11) NOT NULL,
  `grid_h` int(11) NOT NULL,
  `t_A_l` int(11) NOT NULL,
  `t_B_l` int(11) NOT NULL,
  `t_A_r` int(11) NOT NULL,
  `t_B_r` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `min_vertical` int(11) NOT NULL,
  `max_vertical` int(11) NOT NULL,
  `min_horizontal` int(11) NOT NULL,
  `max_horizontal` int(11) NOT NULL,
  `max_questions` int(11) NOT NULL,
  `scale_min` int(11) NOT NULL,
  `scale_max` int(11) NOT NULL,
  `prolific_ref` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `settings`
--

INSERT INTO `settings` (`id`, `min_vertical`, `max_vertical`, `min_horizontal`, `max_horizontal`, `max_questions`, `scale_min`, `scale_max`, `prolific_ref`) VALUES
(1, 2, 2, 2, 2, 5, 0, 6, 'http://www.google.com');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `prolific_id` varchar(100) NOT NULL,
  `starting_time` datetime NOT NULL,
  `ending_time` datetime NOT NULL,
  `rewarded` tinyint(1) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `feedback` text NOT NULL,
  `prolific` tinyint(1) NOT NULL,
  `serious` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `generics`
--
ALTER TABLE `generics`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Indexen voor tabel `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexen voor tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`prolific_id`),
  ADD UNIQUE KEY `prolific_id` (`prolific_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT voor een tabel `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT voor een tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
