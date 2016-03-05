-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 05 Mars 2016 à 13:01
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `csala`
--
CREATE DATABASE IF NOT EXISTS `csala` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `csala`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `nom_lien` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `id_couverture` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom_categorie`, `nom_lien`, `id_couverture`) VALUES
(1, 'Portré', 'portre', 1),
(2, 'Tajkép', 'tajkep', 1),
(3, 'Csendélet', 'csendelet', 1),
(4, 'Önarckép', 'onarckep', 1),
(5, 'Verskép', 'verskep', 1),
(6, 'Egyéb', 'egyeb', 1);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `taille` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `date` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `cat` int(11) NOT NULL,
  `largeur` int(11) NOT NULL,
  `hauteur` int(11) NOT NULL,
  `alt` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `cim` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `nom`, `taille`, `date`, `cat`, `largeur`, `hauteur`, `alt`, `cim`) VALUES
(1, 'lama.jpg', '', '', 1, 1920, 1200, '', 'Mon lama'),
(2, 'vache.jpg', '', '', 1, 1024, 683, '', 'Ma vache'),
(3, '3.jpg', '', '', 3, 1200, 800, 'csendelet', 'k,dlklq'),
(4, '4.jpg', '', '', 3, 1200, 800, 'csendelet', 'image2'),
(5, '5.jpg', '', '', 2, 1200, 800, 'csendelet', 'augusyçàé'),
(6, '6.jpg', '', '', 3, 1200, 1800, 'csendelet', 'oidqioqd,q'),
(7, '7.jpg', '', '', 3, 1200, 800, 'csendelet', 'qssqsq');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE IF NOT EXISTS `livre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `nom` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `contenu` text COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `livre`
--

INSERT INTO `livre` (`id`, `date`, `nom`, `contenu`) VALUES
(2, '2016-03-05', 'Bob http://csalaildiko.com/', 'jdioiqzdozqa<br />\r\nqdzqd<br />\r\nzqdzq<br />\r\nqzdzqdz');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
