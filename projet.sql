-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 20 Février 2011 à 18:21
-- Version du serveur: 5.1.44
-- Version de PHP: 5.2.13


USE 'projet'

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
-- Structure de la table `editeurs`
--

DROP TABLE IF EXISTS `editeur`;
CREATE TABLE IF NOT EXISTS `editeur` (
  `editeur_id` int(11) NOT NULL AUTO_INCREMENT,
  `editeur_nom` varchar(80) NOT NULL,
  `editeur_pays` varchar(80) NOT NULL,
  `editeur_annee` year(4) NOT NULL,
  PRIMARY KEY (`editeur_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `editeurs`
--

INSERT INTO `editeur` (`editeur_id`, `editeur_nom`, `editeur_pays`, `editeur_annee`) VALUES
(1, 'Nintendo', 'Japon', 1972),
(2, 'EA Sports', 'USA', 1982),
(3, 'Sega', 'Japon', 1954);

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

DROP TABLE IF EXISTS `jeu`;
CREATE TABLE IF NOT EXISTS `jeu` (
  `jeu_id` int(11) NOT NULL AUTO_INCREMENT,
  `jeu_nom` varchar(80) NOT NULL,
  `jeu_annee` year(4) NOT NULL,
  `editeur_id` int(11) NOT NULL, 
  PRIMARY KEY (`jeu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `jeux`
--

INSERT INTO `jeu` (`jeu_id`, `jeu_nom`, `jeu_annee`, `editeur_id`) VALUES
(3, 'Sonic', 1991, 3),
(2, 'FIFA11', 2011, 2),
(1, 'Mario', 1983, 1);

-- --------------------------------------------------------

--
-- Structure de la table `plateformes`
--

DROP TABLE IF EXISTS `plateforme`;
CREATE TABLE IF NOT EXISTS `plateforme` (
  `plateforme_id` int(11) NOT NULL AUTO_INCREMENT,
  `plateforme_nom` varchar(80) NOT NULL,
  `plateforme_constructeur` varchar(80) NOT NULL,
  `plateforme_prix` decimal(10,0) NOT NULL,
  PRIMARY KEY (`plateforme_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `plateformes`
--

INSERT INTO `plateforme` (`plateforme_id`, `plateforme_nom`, `plateforme_constructeur`, `plateforme_prix`) VALUES
(1, 'NES', 'Nintendo', 100),
(2, 'Xbox 360', 'Microsoft', 150),
(3, 'Mega Drive', 'Sega', 100);


DROP TABLE IF EXISTS `package`;
CREATE TABLE IF NOT EXISTS `package` (
  `jeu_id` int(11) NOT NULL, 
  `plateforme_id` int(11) NOT NULL,
  `package_prix` decimal(10,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `package` (`jeu_id`, `plateforme_id`, `package_prix`) VALUES
(1, 1, 20), 
(2, 1, 30),
(2, 2, 50),
(2, 3, 40),
(3, 2, 30),
(3, 3, 20);


 
