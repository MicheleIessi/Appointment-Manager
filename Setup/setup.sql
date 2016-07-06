CREATE TABLE `appuntamento` (
  `IDApp` smallint(5) UNSIGNED NOT NULL,
  `IDP` smallint(5) UNSIGNED NOT NULL,
  `IDC` smallint(5) UNSIGNED NOT NULL,
  `data` date NOT NULL,
  `orarioInizio` time NOT NULL,
  `visita` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `cliente` (
  `IDC` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `servizio` (
  `nomeServizio` varchar(20) NOT NULL,
  `descrizione` varchar(100) NOT NULL,
  `settore` varchar(20) NOT NULL,
  `durata` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `serviziofferti` (
  `IDP` smallint(5) UNSIGNED NOT NULL,
  `nomeServizio` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `utente` (
  `numID` smallint(5) UNSIGNED NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `dataNascita` date NOT NULL,
  `codiceFiscale` varchar(16) NOT NULL,
  `sesso` varchar(1) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL,
  `codiceConferma` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `appuntamento`
ADD PRIMARY KEY (`IDApp`),
ADD KEY `IDP` (`IDP`),
ADD KEY `IDC` (`IDC`),
ADD KEY `visita` (`visita`);

ALTER TABLE `cliente`
ADD PRIMARY KEY (`IDC`);

ALTER TABLE `professionista`
ADD PRIMARY KEY (`IDP`);

ALTER TABLE `servizio`
ADD PRIMARY KEY (`nomeServizio`);

ALTER TABLE `serviziofferti`
ADD PRIMARY KEY (`IDP`,`nomeServizio`),
ADD KEY `nomeServizio` (`nomeServizio`);

ALTER TABLE `utente`
ADD PRIMARY KEY (`numID`);

ALTER TABLE `appuntamento`
MODIFY `IDApp` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `utente`
MODIFY `numID` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `appuntamento`
ADD CONSTRAINT `appuntamento_ibfk_1` FOREIGN KEY (`IDP`) REFERENCES `professionista` (`IDP`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `appuntamento_ibfk_2` FOREIGN KEY (`IDC`) REFERENCES `cliente` (`IDC`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `appuntamento_ibfk_3` FOREIGN KEY (`visita`) REFERENCES `servizio` (`nomeServizio`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `serviziofferti`
ADD CONSTRAINT `serviziofferti_ibfk_1` FOREIGN KEY (`IDP`) REFERENCES `professionista` (`IDP`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `serviziofferti_ibfk_2` FOREIGN KEY (`nomeServizio`) REFERENCES `servizio` (`nomeServizio`) ON DELETE NO ACTION ON UPDATE CASCADE;