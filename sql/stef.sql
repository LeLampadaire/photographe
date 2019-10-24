-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 24 oct. 2019 à 09:22
-- Version du serveur :  5.7.21
-- Version de PHP :  7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `stef`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `image`, `description`) VALUES
(1, 'Publicité', 'images/categorie/rose.png', 'Photo de pub pour des marques :)'),
(2, 'Animaux', 'images/categorie/Animaux.png', ''),
(3, 'Architecture', 'images/categorie/Architecture.png', 'Hello'),
(4, 'Studio', 'images/categorie/crodino.png', NULL),
(5, 'Paysages', 'images/categorie/fleur.png', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id`, `pseudo`, `mdp`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(200) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `portefolio`
--

DROP TABLE IF EXISTS `portefolio`;
CREATE TABLE IF NOT EXISTS `portefolio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` int(50) NOT NULL,
  `lien` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categories` (`categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `portefolio`
--

INSERT INTO `portefolio` (`id`, `categorie`, `lien`) VALUES
(1, 1, 'images/portefolio/2-2.jpg'),
(3, 1, 'images/portefolio/3-3.jpg'),
(4, 1, 'images/portefolio/1-1.jpg'),
(5, 1, 'images/portefolio/5.jpg');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `portefolio`
--
ALTER TABLE `portefolio`
  ADD CONSTRAINT `id_categories` FOREIGN KEY (`categorie`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
