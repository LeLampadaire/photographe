-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 12 nov. 2019 à 17:47
-- Version du serveur :  10.1.41-MariaDB-1~jessie
-- Version de PHP :  5.6.40-0+deb8u6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `rausi1259077`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `image`, `description`) VALUES
(1, 'PublicitÃ©', 'images/categorie/PublicitÃ©.jpg', 'Photographie de produit pour publicitÃ©.'),
(2, 'Photographie de produits en studio', 'images/categorie/Photographie de produits en studio.jpg', 'Produits photographiÃ©s en studio.'),
(3, 'Packshot', 'images/categorie/Packshot.gif', 'Photographie servant Ã  prÃ©senter un produit pour gÃ©nÃ©ralement publier sur une boutique en ligne.'),
(4, 'Portrait', 'images/categorie/Portrait.jpg', 'Photo en studio ou dehors.'),
(5, 'Ã‰vÃ©nementiel', 'images/categorie/Ã‰vÃ©nementiel.jpg', 'Photographie d\'Ã©vÃ©nements.');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id`, `pseudo`, `mdp`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `vu` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contact`
--

-- --------------------------------------------------------

--
-- Structure de la table `portefolio`
--

CREATE TABLE `portefolio` (
  `id` int(11) NOT NULL,
  `categorie` int(50) NOT NULL,
  `lien` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `portefolio`
--

INSERT INTO `portefolio` (`id`, `categorie`, `lien`) VALUES
(8, 2, 'images/portefolio/Photographie de produits en studio-Visseuse chocolat signÃ©.jpg'),
(15, 2, 'images/portefolio/Photographie de produits en studio-Visseuse chocolat signÃ© 150.jpg'),
(16, 2, 'images/portefolio/Photographie de produits en studio-WEB.jpg'),
(17, 1, 'images/portefolio/PublicitÃ©-WEB-CRODINO.jpg'),
(18, 1, 'images/portefolio/PublicitÃ©-PUB-BLACK-OPIUM2-WEB.jpg'),
(19, 1, 'images/portefolio/PublicitÃ©-Yves rocher Rose fraiche.jpg'),
(20, 1, 'images/portefolio/PublicitÃ©-Huile-d\'olive-pub-WEB.jpg'),
(21, 1, 'images/portefolio/PublicitÃ©-esprit-montre-WEB.jpg'),
(22, 1, 'images/portefolio/PublicitÃ©-Martini-WEB.jpg'),
(25, 4, 'images/portefolio/Portrait-Audrey-couleur.jpg'),
(29, 3, 'images/portefolio/Packshot-Pull-dÃ©tourÃ©-FIN-11-11-1954.gif');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `services` varchar(250) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(250) NOT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `vu` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `portefolio`
--
ALTER TABLE `portefolio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categories` (`categorie`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `portefolio`
--
ALTER TABLE `portefolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
