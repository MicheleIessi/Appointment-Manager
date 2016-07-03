-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2016 at 12:06 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `appuntamento`
--

CREATE TABLE `appuntamento` (
  `IDApp` smallint(5) UNSIGNED NOT NULL,
  `IDP` smallint(5) UNSIGNED NOT NULL,
  `IDC` smallint(5) UNSIGNED NOT NULL,
  `data` date NOT NULL,
  `orarioInizio` time NOT NULL,
  `visita` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appuntamento`
--

INSERT INTO `appuntamento` (`IDApp`, `IDP`, `IDC`, `data`, `orarioInizio`, `visita`) VALUES
(9, 1, 2, '2016-06-28', '18:00:00', 'Visita specifica'),
(11, 20, 15, '2016-06-29', '10:00:00', 'nome'),
(22, 20, 15, '2016-06-27', '15:00:00', 'nome'),
(32, 1, 3, '2016-06-28', '14:00:00', 'nome'),
(33, 1, 3, '2016-06-30', '12:00:00', 'Visita specifica'),
(34, 20, 2, '2016-06-30', '08:06:00', 'Visita specifica'),
(35, 20, 2, '2016-06-30', '10:06:00', 'ServizioProf'),
(36, 20, 2, '2016-07-01', '08:07:00', 'ServizioProf'),
(37, 20, 2, '2016-07-02', '08:07:00', 'ServizioProf'),
(41, 1, 2, '2016-06-29', '08:06:00', 'Nome Servizio'),
(42, 1, 2, '2016-06-30', '08:06:00', 'Visita specifica'),
(43, 1, 2, '2016-07-01', '08:07:00', 'Nome Servizio'),
(44, 1, 2, '2016-06-27', '11:06:00', 'Nome Servizio');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `IDC` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`IDC`) VALUES
(2),
(3),
(15);

-- --------------------------------------------------------

--
-- Table structure for table `professionista`
--

CREATE TABLE `professionista` (
  `IDP` smallint(5) UNSIGNED NOT NULL,
  `settore` varchar(20) NOT NULL,
  `orarioLun` varchar(50) NOT NULL,
  `orarioMar` varchar(50) NOT NULL,
  `orarioMer` varchar(50) NOT NULL,
  `orarioGio` varchar(50) NOT NULL,
  `orarioVen` varchar(50) NOT NULL,
  `orarioSab` varchar(50) NOT NULL,
  `orarioDom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `professionista`
--

INSERT INTO `professionista` (`IDP`, `settore`, `orarioLun`, `orarioMar`, `orarioMer`, `orarioGio`, `orarioVen`, `orarioSab`, `orarioDom`) VALUES
(1, 'settore cambiato', '09:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00'),
(4, 'settore1', '08:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00'),
(20, 'settore2', '08:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00', '08:00:00-13:00:00,14:00:00-18:00:00'),
(21, 'settore', '00:00:00-23:59:59', '00:00:00-23:59:59', '00:00:00-23:59:59', '00:00:00-23:59:59', '00:00:00-23:59:59', '00:00:00-23:59:59', '00:00:00-23:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `servizio`
--

CREATE TABLE `servizio` (
  `nomeServizio` varchar(20) NOT NULL,
  `descrizione` varchar(100) NOT NULL,
  `settore` varchar(20) NOT NULL,
  `durata` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servizio`
--

INSERT INTO `servizio` (`nomeServizio`, `descrizione`, `settore`, `durata`) VALUES
('nome', 'desc', 'set', '01:00:00'),
('Nome Servizio', 'Descrizione Servizio', 'Settore Servizio', '00:30:00'),
('ServizioProf', 'des', 'settore', '01:30:00'),
('Visita specifica', 'Descr con spazi', 'Sett con spazi', '02:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `serviziofferti`
--

CREATE TABLE `serviziofferti` (
  `IDP` smallint(5) UNSIGNED NOT NULL,
  `nomeServizio` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `serviziofferti`
--

INSERT INTO `serviziofferti` (`IDP`, `nomeServizio`) VALUES
(1, 'nome Servizio'),
(1, 'Visita specifica'),
(4, 'Nome Servizio'),
(4, 'Visita specifica'),
(20, 'ServizioProf'),
(20, 'Visita specifica'),
(21, 'nome');

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `numID` smallint(5) UNSIGNED NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `dataNascita` date NOT NULL,
  `codiceFiscale` varchar(16) NOT NULL,
  `sesso` varchar(1) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`numID`, `nome`, `cognome`, `dataNascita`, `codiceFiscale`, `sesso`, `email`, `password`) VALUES
(1, 'Willy', 'TheCacciu', '2016-03-08', 'SSIMHL92S06E243D', 'm', 'iessimichele@gmail.com', 'provaprova'),
(2, 'nome', 'cognome', '2016-03-16', 'ABCDEF92S06E243D', 'm', 'prova@prova.com', 'password2'),
(3, 'Willy', 'Cacciu', '2014-03-15', 'WILLYN92S06E243D', 'm', 'willy@bau.com', 'baubau10'),
(4, 'Willy', 'TheCacciu', '2016-03-08', 'SSIDVD93R20E243Q', 'm', 'blablaciao@google.com', 'provaprova'),
(15, 'nome', 'cognome', '2016-03-20', 'ASDASD00A87A123A', 'M', 'ciaociao@live.it', 'nuova pass'),
(20, 'Utente', 'Cognome', '2016-04-14', 'ABCDEF92S06E243D', 'm', 'cacciucacciu@cacciu.com', 'blablabla'),
(21, 'prova', 'prova', '2000-01-01', 'ABCABC00A00A000A', 'm', 'blabla@gmail.com', 'password');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appuntamento`
--
ALTER TABLE `appuntamento`
  ADD PRIMARY KEY (`IDApp`),
  ADD KEY `IDP` (`IDP`),
  ADD KEY `IDC` (`IDC`),
  ADD KEY `visita` (`visita`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`IDC`);

--
-- Indexes for table `professionista`
--
ALTER TABLE `professionista`
  ADD PRIMARY KEY (`IDP`);

--
-- Indexes for table `servizio`
--
ALTER TABLE `servizio`
  ADD PRIMARY KEY (`nomeServizio`);

--
-- Indexes for table `serviziofferti`
--
ALTER TABLE `serviziofferti`
  ADD PRIMARY KEY (`IDP`,`nomeServizio`),
  ADD KEY `nomeServizio` (`nomeServizio`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`numID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appuntamento`
--
ALTER TABLE `appuntamento`
  MODIFY `IDApp` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `utente`
--
ALTER TABLE `utente`
  MODIFY `numID` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `appuntamento`
--
ALTER TABLE `appuntamento`
  ADD CONSTRAINT `appuntamento_ibfk_1` FOREIGN KEY (`IDP`) REFERENCES `professionista` (`IDP`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `appuntamento_ibfk_2` FOREIGN KEY (`IDC`) REFERENCES `cliente` (`IDC`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `appuntamento_ibfk_3` FOREIGN KEY (`visita`) REFERENCES `servizio` (`nomeServizio`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `serviziofferti`
--
ALTER TABLE `serviziofferti`
  ADD CONSTRAINT `serviziofferti_ibfk_1` FOREIGN KEY (`IDP`) REFERENCES `professionista` (`IDP`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `serviziofferti_ibfk_2` FOREIGN KEY (`nomeServizio`) REFERENCES `servizio` (`nomeServizio`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
