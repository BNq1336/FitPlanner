-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 18, 2026 at 06:04 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitplanner`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cwiczenia`
--

CREATE TABLE `cwiczenia` (
  `CwiczenieID` int(11) NOT NULL,
  `Nazwa` varchar(100) NOT NULL,
  `Poziom` enum('zaawansowany','sredni','podstawowy') DEFAULT NULL,
  `Typ_cwiczenia` enum('Izolacyjne','Wielostawowe') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cwiczenia`
--

INSERT INTO `cwiczenia` (`CwiczenieID`, `Nazwa`, `Poziom`, `Typ_cwiczenia`) VALUES
(1, 'Wyciskanie sztangi leżąc', 'sredni', 'Wielostawowe'),
(2, 'Wiosłowanie sztangą', 'sredni', 'Wielostawowe'),
(3, 'Przysiad bułgarski', 'sredni', 'Wielostawowe'),
(4, 'Wyciskanie hantli leżąc', 'zaawansowany', 'Wielostawowe'),
(5, 'Przysiad ze sztangą', 'zaawansowany', 'Wielostawowe'),
(6, 'Martwy ciąg rumuński', 'zaawansowany', 'Wielostawowe'),
(7, 'Wiosłowanie hantlem', 'sredni', 'Wielostawowe'),
(8, 'Podciąganie podchwytem', 'podstawowy', 'Wielostawowe'),
(9, 'Podciąganie nachwytem', 'sredni', 'Wielostawowe'),
(10, 'Modlitewnik', 'podstawowy', 'Izolacyjne'),
(11, 'Butterfly', 'podstawowy', 'Izolacyjne'),
(12, 'Prostowanie ramion na wyciągu', 'podstawowy', 'Izolacyjne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pomiary_usera`
--

CREATE TABLE `pomiary_usera` (
  `PomiarID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TypWymiaru` varchar(75) NOT NULL,
  `Wartosc` float NOT NULL,
  `DataPomiaru` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pomiary_usera`
--

INSERT INTO `pomiary_usera` (`PomiarID`, `UserID`, `TypWymiaru`, `Wartosc`, `DataPomiaru`) VALUES
(1, 4, 'Waga', 73, '2026-06-18 17:52:00'),
(2, 4, 'Obwód ramienia', 30, '2026-06-18 17:53:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `treningi`
--

CREATE TABLE `treningi` (
  `TreningID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Data_treningu` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treningi`
--

INSERT INTO `treningi` (`TreningID`, `UserID`, `Data_treningu`) VALUES
(8, 4, '2026-06-12 11:33:00'),
(9, 4, '2026-06-14 11:58:00'),
(10, 4, '2026-06-13 14:57:00'),
(11, 9, '2026-06-14 15:11:00'),
(12, 4, '2026-06-18 17:53:00'),
(13, 9, '2026-06-18 17:56:00'),
(14, 9, '2026-06-18 17:56:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `treningi_serie`
--

CREATE TABLE `treningi_serie` (
  `SeriaID` int(11) NOT NULL,
  `TreningID` int(11) NOT NULL,
  `CwiczenieID` int(11) NOT NULL,
  `NumerSerii` int(11) NOT NULL,
  `Powtorzenia` int(11) NOT NULL,
  `Ciezar` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treningi_serie`
--

INSERT INTO `treningi_serie` (`SeriaID`, `TreningID`, `CwiczenieID`, `NumerSerii`, `Powtorzenia`, `Ciezar`) VALUES
(11, 8, 2, 3, 12, 30),
(12, 9, 2, 3, 12, 40),
(13, 10, 3, 3, 3, 15),
(14, 11, 2, 3, 3, 100),
(15, 11, 1, 4, 10, 120),
(16, 12, 10, 3, 14, 30),
(17, 12, 11, 3, 10, 10),
(18, 12, 5, 4, 10, 100),
(19, 13, 6, 4, 7, 120),
(20, 13, 4, 3, 10, 30),
(21, 13, 3, 3, 12, 20);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Imie` varchar(50) DEFAULT NULL,
  `Nazwisko` varchar(100) DEFAULT NULL,
  `Typ_user` enum('User','Admin') DEFAULT 'User',
  `login` varchar(100) NOT NULL,
  `haslo` varchar(150) NOT NULL,
  `DataUtworzenia` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Imie`, `Nazwisko`, `Typ_user`, `login`, `haslo`, `DataUtworzenia`) VALUES
(4, 'Paweł', 'Kowalski', 'User', 'P_K123', '$2y$10$EC/RZ8mluJ4USkrWMrncBOl7S2SVuM8eaMY7jqJk6NHKVhHjCZWSW', '2026-06-13 11:30:55'),
(6, 'Łukasz', 'Kowal', 'Admin', 'admin123', '$2y$10$uv.LowXQDkTttatzGVxSsu82LEqgZzZ6bSABxnbEtJYyFILaHDvyy', '2026-06-13 12:08:53'),
(9, 'Leszek', 'Śmieszek', 'User', 'lechu', '$2y$10$WNOtW.wzp2c9IGtJAcEc7eRh2oi7t8UWDaIzcB1tP0w7rRvUbC18i', '2026-06-13 15:09:38');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cwiczenia`
--
ALTER TABLE `cwiczenia`
  ADD PRIMARY KEY (`CwiczenieID`);

--
-- Indeksy dla tabeli `pomiary_usera`
--
ALTER TABLE `pomiary_usera`
  ADD PRIMARY KEY (`PomiarID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indeksy dla tabeli `treningi`
--
ALTER TABLE `treningi`
  ADD PRIMARY KEY (`TreningID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indeksy dla tabeli `treningi_serie`
--
ALTER TABLE `treningi_serie`
  ADD PRIMARY KEY (`SeriaID`),
  ADD KEY `TreningID` (`TreningID`),
  ADD KEY `CwiczenieID` (`CwiczenieID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cwiczenia`
--
ALTER TABLE `cwiczenia`
  MODIFY `CwiczenieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pomiary_usera`
--
ALTER TABLE `pomiary_usera`
  MODIFY `PomiarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `treningi`
--
ALTER TABLE `treningi`
  MODIFY `TreningID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `treningi_serie`
--
ALTER TABLE `treningi_serie`
  MODIFY `SeriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pomiary_usera`
--
ALTER TABLE `pomiary_usera`
  ADD CONSTRAINT `pomiary_usera_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `treningi`
--
ALTER TABLE `treningi`
  ADD CONSTRAINT `treningi_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `treningi_serie`
--
ALTER TABLE `treningi_serie`
  ADD CONSTRAINT `treningi_serie_ibfk_1` FOREIGN KEY (`TreningID`) REFERENCES `treningi` (`TreningID`) ON DELETE CASCADE,
  ADD CONSTRAINT `treningi_serie_ibfk_2` FOREIGN KEY (`CwiczenieID`) REFERENCES `cwiczenia` (`CwiczenieID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
