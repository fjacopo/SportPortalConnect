-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 03, 2024 alle 18:07
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
(3, 'Luca', 'Puma', '1983-06-11', 'lucapuma@gmail.com', 'lucapuma', NULL, 'GYH53FMNXY', 0);

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
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `richieste_giocatori`
--
ALTER TABLE `richieste_giocatori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22129;

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
