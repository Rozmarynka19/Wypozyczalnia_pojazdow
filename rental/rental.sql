-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Cze 2020, 18:21
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `rental`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `type` varchar(150) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL,
  `photo_url` varchar(250) COLLATE utf8_bin NOT NULL,
  `available` tinyint(1) NOT NULL,
  `type_cars` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `cars`
--

INSERT INTO `cars` (`id`, `name`, `type`, `price`, `photo_url`, `available`, `type_cars`) VALUES
(1, 'Audi SQ8', 'Rodzinne', 75, 'audi_sq8.jpg', 1, 'Samochod'),
(2, 'Mercedes s500', 'Limuzyna', 95, 'mercedes_s500.jpg', 1, 'Samochod'),
(3, 'BMW M8', 'Sportowe', 50, 'bmw_m8.jpg', 1, 'Samochod'),
(4, 'Porsche 911', 'Sportowe', 90, 'porsche_911.jpg', 1, 'Samochod'),
(5, 'VW TOUAREG', 'Rodzinne', 65, 'vw_touareg.jpg', 1, 'Samochod'),
(6, 'Tesla Cybertruck', 'Elektryczny', 75, 'tesla_cybertruck.jpg', 1, 'Samochod'),
(7, 'Skoda Octavia', 'Rodzinne', 80, 'skoda_octavia.jpg', 1, 'Samochod'),
(8, 'Bentley Continental', 'Premium', 195, 'bentley_continental.jpg', 1, 'Samochod'),
(9, 'Honda CBR 600RR', 'Ścigacz', 100, 'honda_cbr.jpg', 1, 'Motocykl'),
(10, 'Yamaha Africa Twins', 'Turystyk', 120, 'yamaha_africa.jpg', 1, 'Motocykl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `names` varchar(100) COLLATE utf8_bin NOT NULL,
  `surname` varchar(100) COLLATE utf8_bin NOT NULL,
  `phone_number` varchar(9) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `from_date` datetime DEFAULT NULL,
  `to_date` datetime DEFAULT NULL,
  `price` float DEFAULT NULL,
  `login` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservations_history`
--

CREATE TABLE `reservations_history` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `price` float NOT NULL,
  `login` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `password` text COLLATE utf8_bin DEFAULT NULL,
  `perm` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `perm`) VALUES
(1, 'Admin', '7e77279cb4b3e9ce20b50e853e466d5af7cd63faddca227c8ef7b6d5aaece35f340c1f35e9b468bebe73c29da1057bafa2790a5ec05176f3fb07cd3d9a43cb24', 1),
(2, 'Kowalski_Jan', '3aabdf313cdc05f39db976b759ec8e47682b3dd7c66363a8c2d2355c6cf27865d5b7f21e1ffd8824338d9fa642204f03ce069a3637cd58194fde91ec3e965a57', 2),
(3, 'Nowak_Jan', '3aabdf313cdc05f39db976b759ec8e47682b3dd7c66363a8c2d2355c6cf27865d5b7f21e1ffd8824338d9fa642204f03ce069a3637cd58194fde91ec3e965a57', 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indeksy dla tabeli `reservations_history`
--
ALTER TABLE `reservations_history`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `reservations_history`
--
ALTER TABLE `reservations_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);

DELIMITER $$
--
-- Zdarzenia
--
CREATE DEFINER=`root`@`localhost` EVENT `reservations_operation` ON SCHEDULE EVERY 1 MINUTE STARTS '2020-06-01 14:15:24' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
   UPDATE cars SET available = 1 WHERE id IN (SELECT car_id FROM reservations WHERE to_date <= NOW());
   INSERT INTO reservations_history SELECT * FROM reservations WHERE reservations.to_date<=NOW();
   DELETE FROM reservations WHERE to_date<=NOW();
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
