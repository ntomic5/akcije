-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2019 at 10:37 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akcije`
--

-- --------------------------------------------------------

--
-- Table structure for table `akcija_grupa`
--

DROP TABLE IF EXISTS `akcija_grupa`;
CREATE TABLE `akcija_grupa` (
  `ID_GRUPE` int(11) NOT NULL DEFAULT '0',
  `ID_AKCIJE` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `akcije`
--

DROP TABLE IF EXISTS `akcije`;
CREATE TABLE `akcije` (
  `ID_AKCIJE` int(11) NOT NULL,
  `NASLOV` varchar(255) DEFAULT NULL,
  `OPIS` longtext,
  `LOKACIJA` varchar(255) DEFAULT NULL,
  `VREME` varchar(255) DEFAULT NULL,
  `KONTAKT` varchar(255) DEFAULT NULL,
  `BR_TRAZENIH` int(11) DEFAULT '0',
  `BR_PRIJAVLJENIH` int(11) DEFAULT '0',
  `MASA_YN` tinyint(1) DEFAULT '0',
  `ROK` date NOT NULL,
  `BELESKE` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `akcije`
--

INSERT INTO `akcije` (`ID_AKCIJE`, `NASLOV`, `OPIS`, `LOKACIJA`, `VREME`, `KONTAKT`, `BR_TRAZENIH`, `BR_PRIJAVLJENIH`, `MASA_YN`, `ROK`, `BELESKE`) VALUES
(1, 'Pakovanje letaka u koverte', 'Potrebno je 10 000 letaka prepakovati u posebne koverte od po 100 letaka.', 'Prostorije inicijative - Cvijiceva 106', 'bilo koji dan od 10h do 16 h', 'Mila Majevic', 2, 1, 0, '2019-11-28', '    '),
(2, 'Skup u vezi doktorata Siniše Malog ', 'Organizuje se skup povodom roka za odluku o doktoratu Sinise Malog. Skup će biti protestni ili slavljenički, zavisno od odluke. Iz prostorija NDMBGD treba odneti skulpturu od stiropora i zastave. Dobro bi bilo da učesnici naprave prigodne transparente i doneti na skup. Možete se konsultovati oko sadržaja.            ', 'Polazak sa statuom i zastavama iz prostorija NDMBGD, skup na Studentskom trgu ', '22.11.2019., polazak 13h, skup 14h', 'Voja Vojković, za konsultacije oko transparenata', 0, 0, 1, '2019-11-22', 'AAA\r\nBBB\r\nCCC                     '),
(3, 'Sastanak ženske grupe', '3. saastanak ženske grupe, dogovor oko načina podrške Mariji Lukić u decembru 2019.', 'Prostorije NDMBGD', '26.11.2019. u 18h', 'Dragana Draganić', 0, 0, 1, '2019-11-28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grupa`
--

DROP TABLE IF EXISTS `grupa`;
CREATE TABLE `grupa` (
  `ID_GRUPE` int(11) NOT NULL,
  `ID_MODERATOR` int(11) DEFAULT '0',
  `NAZIV` varchar(255) DEFAULT NULL,
  `AKTIVNA_YN` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grupa`
--

INSERT INTO `grupa` (`ID_GRUPE`, `ID_MODERATOR`, `NAZIV`, `AKTIVNA_YN`) VALUES
(1, 0, 'Ekologija', 1),
(2, 0, 'Ženska grupa', 1),
(3, 0, 'Urbanizam', 1),
(4, 0, 'Novi Beograd', 1),
(5, 0, 'Vračar', 1),
(6, 0, 'Zvezdara', 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

DROP TABLE IF EXISTS `korisnici`;
CREATE TABLE `korisnici` (
  `ID_KORISNIKA` int(11) NOT NULL,
  `NALOG` varchar(255) NOT NULL,
  `LOZINKA` varchar(255) NOT NULL,
  `ULOGA` int(11) NOT NULL DEFAULT '0',
  `EMAIL` varchar(255) DEFAULT NULL,
  `TELEFON` varchar(255) DEFAULT NULL,
  `G_SUBSCRIBE_YN` tinyint(1) DEFAULT '0',
  `SUBSCRIBE_YN` tinyint(1) DEFAULT '0',
  `SUBSCRIBE_PERIOD` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`ID_KORISNIKA`, `NALOG`, `LOZINKA`, `ULOGA`, `EMAIL`, `TELEFON`, `G_SUBSCRIBE_YN`, `SUBSCRIBE_YN`, `SUBSCRIBE_PERIOD`) VALUES
(3, 'Aleksandra', '$2y$10$TPVcazWLslkAunXn.mcHxebad14gZ6BA2Kv9FG.I7xDubeh70d2Cq', 1, NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik_grupa`
--

DROP TABLE IF EXISTS `korisnik_grupa`;
CREATE TABLE `korisnik_grupa` (
  `ID_KORISNIKA` int(11) NOT NULL DEFAULT '0',
  `ID_GRUPE` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akcija_grupa`
--
ALTER TABLE `akcija_grupa`
  ADD PRIMARY KEY (`ID_GRUPE`,`ID_AKCIJE`),
  ADD KEY `ID_AKCIJE` (`ID_AKCIJE`),
  ADD KEY `ID_GRUPE` (`ID_GRUPE`);

--
-- Indexes for table `akcije`
--
ALTER TABLE `akcije`
  ADD PRIMARY KEY (`ID_AKCIJE`);

--
-- Indexes for table `grupa`
--
ALTER TABLE `grupa`
  ADD PRIMARY KEY (`ID_GRUPE`),
  ADD KEY `ID_MODERATOR` (`ID_MODERATOR`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`ID_KORISNIKA`);

--
-- Indexes for table `korisnik_grupa`
--
ALTER TABLE `korisnik_grupa`
  ADD PRIMARY KEY (`ID_KORISNIKA`,`ID_GRUPE`),
  ADD KEY `ID_GRUPE` (`ID_GRUPE`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akcije`
--
ALTER TABLE `akcije`
  MODIFY `ID_AKCIJE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `grupa`
--
ALTER TABLE `grupa`
  MODIFY `ID_GRUPE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `ID_KORISNIKA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `akcija_grupa`
--
ALTER TABLE `akcija_grupa`
  ADD CONSTRAINT `ag_a` FOREIGN KEY (`ID_AKCIJE`) REFERENCES `akcije` (`ID_AKCIJE`),
  ADD CONSTRAINT `ag_g` FOREIGN KEY (`ID_GRUPE`) REFERENCES `grupa` (`ID_GRUPE`);

--
-- Constraints for table `korisnik_grupa`
--
ALTER TABLE `korisnik_grupa`
  ADD CONSTRAINT `kg_g` FOREIGN KEY (`ID_GRUPE`) REFERENCES `grupa` (`ID_GRUPE`),
  ADD CONSTRAINT `kg_k` FOREIGN KEY (`ID_KORISNIKA`) REFERENCES `korisnici` (`ID_KORISNIKA`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
