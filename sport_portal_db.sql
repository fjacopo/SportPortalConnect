-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 06, 2024 alle 18:25
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sport_portal_db`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `richieste_giocatori`
--

CREATE TABLE `richieste_giocatori` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cognome` varchar(50) DEFAULT NULL,
  `data_nascita` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `ruolo` varchar(50) DEFAULT NULL,
  `cod_squadra` varchar(50) DEFAULT NULL,
  `stato` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_events`
--

CREATE TABLE `tbl_events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `nome` varchar(255) DEFAULT NULL,
  `cognome` varchar(255) DEFAULT NULL,
  `data_nascita` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `ruolo` varchar(255) DEFAULT NULL,
  `cod_squadra` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`nome`, `cognome`, `data_nascita`, `email`, `username`, `password`, `ruolo`, `cod_squadra`) VALUES
('a', 'a', '2019-05-04', 'aa@mail.com', 'a', '$2y$10$4q4IZ.QEeV68kmFQb8lQXOeM6DJtMlY/D6PzyUMlyqJKVeHk.rSY6', 'giocatore', 'GYH53FMNXY'),
('Allenatore', 'A', '2019-04-30', 'allenatore@gmail.com', 'allenatore', '$2y$10$pvVxgTrau0EhgqKqeA1l3O1O1vLIfmDHPvhN.O0fbXWojtLapUaiK', 'Allenatore', 'oM4F3yS0VZ'),
('Domenico', 'Manca', '2005-06-25', 'domymanca.ciao@gmail.com', 'DomeManca', '$2y$10$9yz9Yc8.FfyYMsu4RnaAS.3moi5X.cGRYpVz0flpbuShaz8ofeYBi', 'preparatore', 'GYH53FMNXY'),
('Jacopo', 'Ferrari', '2005-04-20', 'fjacopo10@gmail.com', 'ferrarijacopo', '$2y$10$fXUk3gUdC0ezOZQQDGO.u.hWeYkHvWkUXodzbbolD.gJBGrzlIhiW', 'Allenatore', 'GYH53FMNXY'),
('prova', 'prova', '2019-05-01', 'prova@gmail.com', 'prova', '$2y$10$scx4MV64BkhpRipzQfTdlOGqumpX6.3VAl7aArx3qff6UJXicawRC', 'giocatore', 'oM4F3yS0VZ');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `richieste_giocatori`
--
ALTER TABLE `richieste_giocatori`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indici per le tabelle `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `richieste_giocatori`
--
ALTER TABLE `richieste_giocatori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22146;

--
-- AUTO_INCREMENT per la tabella `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `richieste_giocatori`
--
ALTER TABLE `richieste_giocatori`
  ADD CONSTRAINT `richieste_giocatori_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
