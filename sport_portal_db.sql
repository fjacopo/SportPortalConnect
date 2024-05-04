-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 04, 2024 alle 21:06
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

--
-- Dump dei dati per la tabella `richieste_giocatori`
--

INSERT INTO `richieste_giocatori` (`id`, `nome`, `cognome`, `data_nascita`, `email`, `username`, `ruolo`, `cod_squadra`, `stato`) VALUES
(22137, 'a', 'a', '2019-05-03', 'aa@mail.com', 'a', NULL, 'GYH53FMNXY', 0);

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
('a', 'a', '2019-05-03', 'aa@mail.com', 'a', '$2y$10$lThKiWCD5fCOk7Os60ioC.IRX7DJ6aQbrNlU46/u6yn5eZpl5MBoq', NULL, NULL),
('Allenatore', 'A', '2019-04-30', 'allenatore@gmail.com', 'allenatore', '$2y$10$pvVxgTrau0EhgqKqeA1l3O1O1vLIfmDHPvhN.O0fbXWojtLapUaiK', 'Allenatore', 'oM4F3yS0VZ'),
('Domenico', 'Manca', '2005-06-25', 'domymanca.ciao@gmail.com', 'DomeManca', '$2y$10$oUw8v0.Sor9zgjKr5Qz/FuBqXbxkyao77pelYKOgHyc0xp1Z3SaJm', NULL, NULL),
('Jacopo', 'Ferrari', '2005-04-20', 'fjacopo10@gmail.com', 'ferrarijacopo', '$2y$10$LgTqMbeuqfxE12a5QXorzeDJe/DyUDCDsXeybcApaLCmCJc7n2OOa', 'Allenatore', 'GYH53FMNXY'),
('prova', 'prova', '2019-05-03', 'prova@gmail.com', 'prova', '$2y$10$ATJqUSRJnTZf7CiRa8B71Oqlr7/m8nxf6HPjjGuIFq7X6tKEzUyc2', 'Preparatore', 'GYH53FMNXY');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22138;

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
