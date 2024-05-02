-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 02, 2024 alle 19:31
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
-- Struttura della tabella `partite`
--

CREATE TABLE `partite` (
  `id` int(11) NOT NULL,
  `cod_squadra` int(11) NOT NULL,
  `avversario` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `ora` time NOT NULL,
  `luogo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 'Domenico', 'Manca', '2005-06-25', 'domymanca.ciao@gmail.com', 'DomeManca', NULL, 'GYH53FMNXY', 0),
(3, 'Luca', 'Puma', '1983-06-11', 'lucapuma@gmail.com', 'lucapuma', NULL, 'GYH53FMNXY', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `squadra`
--

CREATE TABLE `squadra` (
  `cod_squadra` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `allenatore_username` varchar(50) NOT NULL,
  `giocatore_username` varchar(50) NOT NULL,
  `preparatore_username` varchar(50) NOT NULL
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
('aa', 'aaa', '2019-04-30', 'aa@mail.com', 'a', '$2y$10$m/p2VaTltTs1pmzak2cj4e9CZWrjBR2eb7QUFTzCejuA38x3m78CO', NULL, NULL),
('ciao', 'ciao', '2019-04-30', 'ciao@gmail.com', 'ciao', '$2y$10$XML.n05O4uFmo8FjXI76f.c.spDiIrd.VmN00IbtIXIZYpBwILHn.', NULL, NULL),
('Domenico', 'Manca', '2005-06-25', 'domymanca.ciao@gmail.com', 'DomeManca', '$2y$10$t19UJtkfVlN.RzsPeG8oq.hXMHs7DFd1RbV6Hohe/.j167FwML7zO', NULL, NULL),
('Jacopo', 'Ferrari', '2005-04-20', 'fjacopo10@gmail.com', 'ferrarijacopo', '$2y$10$Cdn0dNTaR.2L0mcbwMPK8e4DL75FcgP4hUzHX5wL/qfOCOrMfhXOC', 'Allenatore', 'GYH53FMNXY'),
('Luca', 'Puma', '1983-06-11', 'lucapuma@gmail.com', 'lucapuma', '$2y$10$.6oQDjV.GnHyJoLfiOuvx.H35qIOvTliAeHAJhO5CZbRHYvpPFiua', NULL, NULL),
('Mario', 'Rossi', '2010-01-01', 'prova@gmail.com', 'Prova', '$2y$10$Q59yqEBQIeP1uYSdYGg1B.vY4EeTC3MLzAnAknSMXMhx75YsEO4va', NULL, 'GYH53FMNXY');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `partite`
--
ALTER TABLE `partite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cod_squadra` (`cod_squadra`);

--
-- Indici per le tabelle `richieste_giocatori`
--
ALTER TABLE `richieste_giocatori`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indici per le tabelle `squadra`
--
ALTER TABLE `squadra`
  ADD PRIMARY KEY (`cod_squadra`),
  ADD KEY `allenatore_username` (`allenatore_username`),
  ADD KEY `giocatore_username` (`giocatore_username`),
  ADD KEY `preparatore_username` (`preparatore_username`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `partite`
--
ALTER TABLE `partite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `richieste_giocatori`
--
ALTER TABLE `richieste_giocatori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22127;

--
-- AUTO_INCREMENT per la tabella `squadra`
--
ALTER TABLE `squadra`
  MODIFY `cod_squadra` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `partite`
--
ALTER TABLE `partite`
  ADD CONSTRAINT `partite_ibfk_1` FOREIGN KEY (`cod_squadra`) REFERENCES `squadra` (`cod_squadra`);

--
-- Limiti per la tabella `richieste_giocatori`
--
ALTER TABLE `richieste_giocatori`
  ADD CONSTRAINT `richieste_giocatori_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Limiti per la tabella `squadra`
--
ALTER TABLE `squadra`
  ADD CONSTRAINT `squadra_ibfk_1` FOREIGN KEY (`allenatore_username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `squadra_ibfk_2` FOREIGN KEY (`giocatore_username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `squadra_ibfk_3` FOREIGN KEY (`preparatore_username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
