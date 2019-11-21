-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 21 nov. 2019 à 16:58
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
-- Base de données :  `stef`
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
(1, 'Publicité', 'images/categorie/Publicité.jpg', 'Photographie de produit pour publicité.'),
(2, 'Photographie de produits en studio', 'images/categorie/Photographie de produits en studio.jpg', 'Produits photographiés en studio.'),
(3, 'Packshot', 'images/categorie/Packshot.gif', 'Photographie servant à  présenter un produit pour généralement publier sur une boutique en ligne.\r\n'),
(4, 'Portrait', 'images/categorie/Portrait.jpg', 'Photo en studio ou dehors.'),
(5, 'Événementiel', 'images/categorie/Événementiel.jpg', 'Photographie d’événements.'),
(6, 'Restaurations de photographies anciennes', 'images/categorie/Restaurations de photographies anciennes.jpg', 'Vous voulez faire revivre vos anciennes photos ou les photos que vous avez tant aimées ? Une restauration complète s\'impose !');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gif`
--

CREATE TABLE `gif` (
  `id` int(11) NOT NULL,
  `id_portefolio` int(11) NOT NULL,
  `lien` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `portefolio`
--

CREATE TABLE `portefolio` (
  `id` int(11) NOT NULL,
  `categorie` int(50) NOT NULL,
  `lien` varchar(255) NOT NULL,
  `gif` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `portefolio`
--

INSERT INTO `portefolio` (`id`, `categorie`, `lien`, `gif`) VALUES
(16, 2, 'images/portefolio/Photographie de produits en studio-WEB.jpg', 0),
(17, 1, 'images/portefolio/Publicité-WEB-CRODINO.jpg', 0),
(18, 1, 'images/portefolio/Publicité-PUB-BLACK-OPIUM2-WEB.jpg', 0),
(19, 1, 'images/portefolio/Publicité-Yves rocher Rose fraiche.jpg', 0),
(20, 1, 'images/portefolio/Publicité-Huile-d\'olive-pub-WEB.jpg', 0),
(21, 1, 'images/portefolio/Publicité-esprit-montre-WEB.jpg', 0),
(22, 1, 'images/portefolio/Publicité-Martini-WEB.jpg', 0),
(25, 4, 'images/portefolio/Portrait-Audrey-couleur.jpg', 0),
(29, 3, 'images/portefolio/Packshot-Pull-détouré-FIN-11-11-1954.gif', 0),
(30, 5, 'images/portefolio/Événementiel-WEB.jpg', 0),
(31, 5, 'images/portefolio/Événementiel-WEB2.jpg', 0),
(32, 5, 'images/portefolio/Événementiel-WEB3.jpg', 0),
(33, 4, 'images/portefolio/Portrait-WEB-1.jpg', 0),
(34, 4, 'images/portefolio/Portrait-WEB-2.jpg', 0),
(35, 1, 'images/portefolio/Publicité-web chauffage.jpg', 0),
(36, 6, 'images/portefolio/Restaurations de photographies anciennes-Mise en page avant après.jpg', 0),
(37, 5, 'images/portefolio/Événementiel-WEB-Mariage.jpg', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Index pour la table `gif`
--
ALTER TABLE `gif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_portefolio_gif` (`id_portefolio`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gif`
--
ALTER TABLE `gif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `portefolio`
--
ALTER TABLE `portefolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `gif`
--
ALTER TABLE `gif`
  ADD CONSTRAINT `id_portefolio_gif` FOREIGN KEY (`id_portefolio`) REFERENCES `portefolio` (`id`);

--
-- Contraintes pour la table `portefolio`
--
ALTER TABLE `portefolio`
  ADD CONSTRAINT `id_categories` FOREIGN KEY (`categorie`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
