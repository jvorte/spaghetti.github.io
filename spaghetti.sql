-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 19 Αυγ 2021 στις 16:28:11
-- Έκδοση διακομιστή: 10.4.18-MariaDB
-- Έκδοση PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `spaghetti`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `artikel`
--

CREATE TABLE `artikel` (
  `artikelID` int(10) NOT NULL,
  `artikelName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `artikelGruppe` int(10) NOT NULL,
  `artikelPreis` decimal(10,2) NOT NULL,
  `artikelBeschreibung` text COLLATE utf8_unicode_ci NOT NULL,
  `active` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `featured` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `artikel`
--

INSERT INTO `artikel` (`artikelID`, `artikelName`, `artikelGruppe`, `artikelPreis`, `artikelBeschreibung`, `active`, `featured`, `image_name`) VALUES
(224, ' cakes', 234, '35.00', 'olestiae. Cum perspiciatis accusamus maiores exercitationem incidunt at magni, iste maxime, ex eligendi ut. Sit, quia, porro ratione nemo id sunt quam rem harum dolorum temporibus aliquid cumque dolorem, minus modi consequuntur nisi consectetur nobis neque quo tempore! Quis voluptatibus, quibu', 'Yes', 'Yes', 'Produkt-Name-1048.jpg'),
(225, 'pasta', 234, '70.00', 'olestiae. Cum perspiciatis accusamus maiores exercitationem incidunt at magni, iste maxime, ex eligendi ut. Sit, quia, porro ratione nemo id sunt quam rem harum dolorum temporibus aliquid cumque dolorem, minus modi consequuntur nisi consectetur nobis neque quo tempore! Quis voluptatibus, quibu', 'Yes', 'Yes', 'Produkt-Name-3523.jpg'),
(226, 'Pasta', 234, '70.00', 'olestiae. Cum perspiciatis accusamus maiores exercitationem incidunt at magni, iste maxime, ex eligendi ut. Sit, quia, porro ratione nemo id sunt quam rem harum dolorum temporibus aliquid cumque ', 'Yes', 'Yes', 'Produkt-Name-5410.jpg'),
(227, 'Pasta', 232, '35.00', 'olestiae. Cum perspiciatis accusamus maiores exercitationem incidunt at magni, iste maxime, ex eligendi ut. Sit, quia, porro ratione nemo id sunt quam rem harum dolorum temporibus aliquid cumque ', 'Yes', 'Yes', 'Produkt-Name-7515.jpg'),
(228, 'Pasta', 234, '35.00', 'olestiae. Cum perspiciatis accusamus maiores exercitationem incidunt at magni, iste maxime, ex eligendi ut. Sit, quia, porro ratione nemo id sunt quam rem harum dolorum temporibus aliquid cumque ', 'Yes', 'Yes', 'Produkt-Name-6470.jpg');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `bestellungen`
--

CREATE TABLE `bestellungen` (
  `bestellID` int(11) NOT NULL,
  `bestArtikelFID` int(11) NOT NULL,
  `bestUserFID` varchar(11) NOT NULL,
  `artikelName` varchar(255) NOT NULL,
  `bestPreis` decimal(11,2) NOT NULL,
  `bestStueck` int(11) NOT NULL,
  `bestUmsatz` decimal(11,2) NOT NULL,
  `bestDatum` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bestRechnungsnummer` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `bestellungen`
--

INSERT INTO `bestellungen` (`bestellID`, `bestArtikelFID`, `bestUserFID`, `artikelName`, `bestPreis`, `bestStueck`, `bestUmsatz`, `bestDatum`, `bestRechnungsnummer`, `status`, `username`) VALUES
(385, 217, '48', 'DIMITRIOS', '70.00', 5, '140.00', '2021-05-21 09:23:24', 0, 'bestellt', 'jvortelinas');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `contact`
--

INSERT INTO `contact` (`id`, `first_name`, `last_name`, `email`, `message`) VALUES
(30, 'ΦΩΤΕΙΝΗ', 'ΜΑΥΡΟΜΜΑΤΗ', 'fenia.mavromati@gmail.com', 'uuuuuuuuuuuuuu'),
(31, '', '', '', '');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `postings`
--

CREATE TABLE `postings` (
  `id` int(11) NOT NULL,
  `postingHeader` varchar(255) NOT NULL,
  `postingUser` varchar(255) NOT NULL,
  `postingText` text NOT NULL,
  `postingDatum` date NOT NULL,
  `postingStatus` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `postings`
--

INSERT INTO `postings` (`id`, `postingHeader`, `postingUser`, `postingText`, `postingDatum`, `postingStatus`) VALUES
(48, 'Paris', 'Dimitris', 'Der Nachweis von Covid-19 kann direkt über einen Virusnachweis oder indirekt über Antikörper (welche sich im Zuge einer Infektion gebildet haben) erfolgen. Für die Frühdiagnostik einer Infektion bildet internationalen Vorgaben zufolge, nach wie vor der direkte Erregernachweis mittels qualitätsgesichertem PCR-Verfahren, den Goldstandard.\r\n\r\nPCR-Tests (Polymerasekettenreaktion) dienen dem Nachweis einer aktuellen COVID-19-Infektion. Für PCR-Tests werden Proben aus dem Rachen oder Nasenraum gewonnen.\r\n\r\nAntigen-Tests: Neben PCR-Tests besteht mit Antigen-Tests eine weitere Möglichkeit eines direkten Erregernachweises von SARS-CoV-2. Bei Antigen-Tests wird kein Labor zur Auswertung benötigt, das Ergebnis steht innerhalb kurzer Zeit (etwa 20 Minuten) fest, diese sind derzeit verfügbar und preiswert, jedoch im Vergleich zu PCR-Tests weniger zuverlässig. Im Unterschied zu PCR-Tests wird bei Antigen-Tests nicht das Erbgut des Virus nachgewiesen, sondern dessen Protein bzw. Proteinhülle.', '2021-03-26', 1),
(49, 'London', 'vortelinas', 'Der Nachweis von Covid-19 kann direkt über einen Virusnachweis oder indirekt über Antikörper (welche sich im Zuge einer Infektion gebildet haben) erfolgen. Für die Frühdiagnostik einer Infektion bildet internationalen Vorgaben zufolge, nach wie vor der direkte Erregernachweis mittels qualitätsgesichertem PCR-Verfahren, den Goldstandard.\r\n\r\nPCR-Tests (Polymerasekettenreaktion) dienen dem Nachweis einer aktuellen COVID-19-Infektion. Für PCR-Tests werden Proben aus dem Rachen oder Nasenraum gewonnen.\r\n\r\nAntigen-Tests: Neben PCR-Tests besteht mit Antigen-Tests eine weitere Möglichkeit eines direkten Erregernachweises von SARS-CoV-2. Bei Antigen-Tests wird kein Labor zur Auswertung benötigt, das Ergebnis steht innerhalb kurzer Zeit (etwa 20 Minuten) fest, diese sind derzeit verfügbar und preiswert, jedoch im Vergleich zu PCR-Tests weniger zuverlässig. Im Unterschied zu PCR-Tests wird bei Antigen-Tests nicht das Erbgut des Virus nachgewiesen, sondern dessen Protein bzw. Proteinhülle.', '2021-03-26', 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `created_at`) VALUES
(4, 'jvortelinas', '$2y$10$WJxqClsEQdS0d83dI1P88.V9F9ApVKyQ01aKiz4xe8HjEOM0hbcUi', '2021-05-21 09:41:03');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `tbl_category`
--

CREATE TABLE `tbl_category` (
  `artikelID` int(10) UNSIGNED NOT NULL,
  `artikelName` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `tbl_category`
--

INSERT INTO `tbl_category` (`artikelID`, `artikelName`, `image_name`, `featured`, `active`) VALUES
(232, 'Pizza', 'Produkt_Category_345.jpg', 'Yes', 'Yes'),
(234, 'Spaghetti', 'Trip_Category_37.jpg', 'Yes', 'Yes'),
(239, ' Pasta', 'item_category_697.jpg', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `fullname` varchar(100) NOT NULL,
  `contact` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `fullname`, `contact`, `email`, `address`) VALUES
(48, 'jvortelinas', '$2y$10$BzLbBlWUjuTVTGJW0HOMC.D7DOrbWKN2r5oLHmKLEMf9rdjki/wwO', '2021-04-25 11:55:39', 'Dimitris', '068864818152', 'jvortelinas@gmail.com', 'Bonsaigase 3 1220 Wien'),
(50, 'rita', '$2y$10$4.iujIYwJYhaERsi7b5eGuxVUs5/6pAcf/8znb5PoBxKvHWMJDK1K', '2021-04-27 14:21:06', 'ΦΩΤΕΙΝΗ ΜΑΥΡΟΜΜΑΤΗ', '555', 'fenia.mavromati@gmail.com', '28ΗΣ ΟΚΤΩΒΡΙΟΥ 49'),
(51, 'oscar', '$2y$10$Nr16Aeg9uIiKT4qkYUuee.r5T0CO4u/J032AfmulWjTNUabYT6VP6', '2021-05-06 15:08:32', 'ΦΩΤΕΙΝΗ ΜΑΥΡΟΜΜΑΤΗ', '2467074379', 'fenia.mavromati@gmail.com', '28ΗΣ ΟΚΤΩΒΡΙΟΥ 49'),
(52, 'jvorte', '$2y$10$/LknsAv/g3/P2narVWRfWeiyb7NvhLTozBeCiA725lfL/Y1hKgKLm', '2021-05-21 08:50:04', '', NULL, NULL, NULL);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`artikelID`);

--
-- Ευρετήρια για πίνακα `bestellungen`
--
ALTER TABLE `bestellungen`
  ADD PRIMARY KEY (`bestellID`);

--
-- Ευρετήρια για πίνακα `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `postings`
--
ALTER TABLE `postings`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Ευρετήρια για πίνακα `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`artikelID`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `artikel`
--
ALTER TABLE `artikel`
  MODIFY `artikelID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT για πίνακα `bestellungen`
--
ALTER TABLE `bestellungen`
  MODIFY `bestellID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT για πίνακα `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT για πίνακα `postings`
--
ALTER TABLE `postings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT για πίνακα `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `artikelID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
