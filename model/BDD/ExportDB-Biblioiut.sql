-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 09 Janvier 2013 à 07:52
-- Version du serveur: 5.5.28
-- Version de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `biblioiut`
--
CREATE DATABASE `biblioiut` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `biblioiut`;

-- --------------------------------------------------------

--
-- Structure de la table `Emprunt`
--

CREATE TABLE IF NOT EXISTS `Emprunt` (
  `idEmprunt` int(11) NOT NULL AUTO_INCREMENT,
  `dateDebutEmprunt` date NOT NULL,
  `dateFinEmprunt` date DEFAULT NULL,
  `fk_idMembre` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEmprunt`),
  KEY `fk_idMembre` (`fk_idMembre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Etudiant`
--

CREATE TABLE IF NOT EXISTS `Etudiant` (
  `idEtudiant` int(11) NOT NULL AUTO_INCREMENT,
  `numeroEtudiant` int(11) NOT NULL,
  `nomEtudiant` varchar(255) NOT NULL,
  `prenomEtudiant` varchar(255) NOT NULL,
  `dateNaissanceEtudiant` date NOT NULL,
  `photoProfilEtudiant` blob,
  PRIMARY KEY (`idEtudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Livre`
--

CREATE TABLE IF NOT EXISTS `Livre` (
  `idLivre` int(11) NOT NULL AUTO_INCREMENT,
  `nisbnLivre` varchar(255) NOT NULL,
  `titreLivre` varchar(255) NOT NULL,
  `auteurLivre` varchar(255) NOT NULL,
  `couvertureLivre` blob,
  `fk_idEmprunt` int(11) DEFAULT NULL,
  `fk_idReservation` int(11) DEFAULT NULL,
  PRIMARY KEY (`idLivre`),
  KEY `fk_idEmprunt` (`fk_idEmprunt`),
  KEY `fk_idReservation` (`fk_idReservation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Membre`
--

CREATE TABLE IF NOT EXISTS `Membre` (
  `idMembre` int(11) NOT NULL AUTO_INCREMENT,
  `loginMembre` varchar(255) NOT NULL,
  `mdpMembre` varchar(255) NOT NULL,
  `emailMembre` varchar(255) NOT NULL,
  `fk_idEtudiant` int(11) DEFAULT NULL,
  `fk_idPersonnel` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMembre`),
  KEY `fk_idEtudiant` (`fk_idEtudiant`),
  KEY `fk_idPersonnel` (`fk_idPersonnel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Personnel`
--

CREATE TABLE IF NOT EXISTS `Personnel` (
  `idPersonnel` int(11) NOT NULL AUTO_INCREMENT,
  `nssPersonnel` varchar(255) NOT NULL,
  `nomPersonnel` varchar(255) NOT NULL,
  `prenomPersonnel` varchar(255) NOT NULL,
  PRIMARY KEY (`idPersonnel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Reservation`
--

CREATE TABLE IF NOT EXISTS `Reservation` (
  `idReservation` int(11) NOT NULL AUTO_INCREMENT,
  `dateReservation` datetime NOT NULL,
  `fk_idMembre` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReservation`),
  KEY `fk_idMembre` (`fk_idMembre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Tags`
--

CREATE TABLE IF NOT EXISTS `Tags` (
  `idTag` int(11) NOT NULL AUTO_INCREMENT,
  `motTag` varchar(255) DEFAULT NULL,
  `fk_idLivre` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTag`),
  KEY `fk_idLivre` (`fk_idLivre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Emprunt`
--
ALTER TABLE `Emprunt`
  ADD CONSTRAINT `emprunt_ibfk_1` FOREIGN KEY (`fk_idMembre`) REFERENCES `Membre` (`idMembre`);

--
-- Contraintes pour la table `Livre`
--
ALTER TABLE `Livre`
  ADD CONSTRAINT `livre_ibfk_1` FOREIGN KEY (`fk_idEmprunt`) REFERENCES `Emprunt` (`idEmprunt`),
  ADD CONSTRAINT `livre_ibfk_2` FOREIGN KEY (`fk_idReservation`) REFERENCES `Reservation` (`idReservation`);

--
-- Contraintes pour la table `Membre`
--
ALTER TABLE `Membre`
  ADD CONSTRAINT `membre_ibfk_1` FOREIGN KEY (`fk_idEtudiant`) REFERENCES `Etudiant` (`idEtudiant`),
  ADD CONSTRAINT `membre_ibfk_2` FOREIGN KEY (`fk_idPersonnel`) REFERENCES `Personnel` (`idPersonnel`);

--
-- Contraintes pour la table `Reservation`
--
ALTER TABLE `Reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`fk_idMembre`) REFERENCES `Membre` (`idMembre`);

--
-- Contraintes pour la table `Tags`
--
ALTER TABLE `Tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`fk_idLivre`) REFERENCES `Livre` (`idLivre`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
