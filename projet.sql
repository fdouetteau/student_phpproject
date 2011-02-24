-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 20 Février 2011 à 18:21
-- Version du serveur: 5.1.44
-- Version de PHP: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `all`
--

DROP TABLE IF EXISTS `all`;
CREATE TABLE IF NOT EXISTS `all` (
  `id_jeux` int(11) NOT NULL,
  `id_editeurs` int(11) NOT NULL,
  `id_pf` int(11) NOT NULL,
  PRIMARY KEY (`id_jeux`,`id_editeurs`,`id_pf`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `all`
--

INSERT INTO `all` (`id_jeux`, `id_editeurs`, `id_pf`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `editeurs`
--

DROP TABLE IF EXISTS `editeurs`;
CREATE TABLE IF NOT EXISTS `editeurs` (
  `id_editeurs` int(11) NOT NULL AUTO_INCREMENT,
  `nom_editeur` varchar(80) NOT NULL,
  `pays_editeur` varchar(80) NOT NULL,
  `annee_editeur` year(4) NOT NULL,
  PRIMARY KEY (`id_editeurs`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `editeurs`
--

INSERT INTO `editeurs` (`id_editeurs`, `nom_editeur`, `pays_editeur`, `annee_editeur`) VALUES
(1, 'Nintendo', 'Japon', 1972),
(2, 'EA Sports', 'USA', 1982),
(3, 'Sega', 'Japon', 1954);

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

DROP TABLE IF EXISTS `jeux`;
CREATE TABLE IF NOT EXISTS `jeux` (
  `id_jeux` int(11) NOT NULL AUTO_INCREMENT,
  `nom_jeu` varchar(80) NOT NULL,
  `annee_jeu` year(4) NOT NULL,
  `prix_jeu` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_jeux`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `jeux`
--

INSERT INTO `jeux` (`id_jeux`, `nom_jeu`, `annee_jeu`, `prix_jeu`) VALUES
(3, 'Sonic', 1991, 20),
(2, 'FIFA11', 2011, 60),
(1, 'Mario', 1983, 20);

-- --------------------------------------------------------

--
-- Structure de la table `plateformes`
--

DROP TABLE IF EXISTS `plateformes`;
CREATE TABLE IF NOT EXISTS `plateformes` (
  `id_pf` int(11) NOT NULL AUTO_INCREMENT,
  `nom_pf` varchar(80) NOT NULL,
  `constructeur_pf` varchar(80) NOT NULL,
  `prix_pf` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_pf`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `plateformes`
--

INSERT INTO `plateformes` (`id_pf`, `nom_pf`, `constructeur_pf`, `prix_pf`) VALUES
(1, 'NES', 'Nintendo', 100),
(2, 'Xbox 360', 'Microsoft', 150),
(3, 'Mega Drive', 'Sega', 100);
