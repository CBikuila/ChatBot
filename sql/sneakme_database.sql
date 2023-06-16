-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 15 juin 2023 à 19:59
-- Version du serveur : 5.7.24
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sneakme_database`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin_connexion`
--

CREATE TABLE `admin_connexion` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(150) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin_connexion`
--

INSERT INTO `admin_connexion` (`admin_id`, `admin_email`, `admin_password`) VALUES
(1, 'admin@sneakme.fr', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `categories_produits`
--

CREATE TABLE `categories_produits` (
  `categories_produits_id` int(11) NOT NULL,
  `categories_produits_nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories_produits`
--

INSERT INTO `categories_produits` (`categories_produits_id`, `categories_produits_nom`) VALUES
(1, 'Sneakers de course'),
(2, 'Sneakers de basketball'),
(3, 'Sneakers de style de vie'),
(4, 'Sneakers de skate'),
(5, 'Sneakers de tennis'),
(6, 'Sneakers de randonnée'),
(7, 'Sneakers minimalistes'),
(8, 'Sneakers rétro'),
(13, 'gfgfg');

-- --------------------------------------------------------

--
-- Structure de la table `motscles`
--

CREATE TABLE `motscles` (
  `motscles_id` int(11) NOT NULL,
  `mots_cles` varchar(50) NOT NULL,
  `question` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `motscles`
--

INSERT INTO `motscles` (`motscles_id`, `mots_cles`, `question`) VALUES
(72, 'Coucou', 'Bonjour, que puis-je faire pour vous ?'),
(73, 'Hello ', 'Bonjour, que puis-je faire pour vous ?'),
(74, 'Bonjour', 'Bonjour, que puis-je faire pour vous ?'),
(75, 'Au revoir ', 'Au revoir et à bientôt !'),
(76, '++', 'Au revoir et à bientôt !'),
(77, 'Bye', 'Au revoir et à bientôt !'),
(78, 'Téléphone', 'Vous désirez nous contacter, vous pouvez nous appeler au xx xx xx xx xx xx'),
(79, 'Contacter', 'Vous désirez nous contacter, vous pouvez nous appeler au xx xx xx xx xx xx');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `panier_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `produits_id` int(11) NOT NULL,
  `photo_sneakers` varchar(100) NOT NULL,
  `marque_sneakers` varchar(50) DEFAULT NULL,
  `modele_sneakers` varchar(100) DEFAULT NULL,
  `couleur_sneakers` varchar(30) DEFAULT NULL,
  `taille_sneakers` int(2) DEFAULT NULL,
  `prix_sneakers` varchar(100) DEFAULT NULL,
  `genre_sneakers` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`produits_id`, `photo_sneakers`, `marque_sneakers`, `modele_sneakers`, `couleur_sneakers`, `taille_sneakers`, `prix_sneakers`, `genre_sneakers`) VALUES
(31, 'conversechucktaylor.webp', 'Converse', 'Chuck Taylor', 'Noirs', 40, '100 &euro;', 'Mixte'),
(34, 'adidaswebboost.webp', 'Adidas', 'Web Boost', 'Noirs', 42, '240 &euro;', 'Masculin'),
(35, 'newbalancegr997.webp', 'New Balance', 'GR997', 'Grises', 37, '140', 'Mixtes'),
(36, 'nikeairforceone.webp', 'Nike', 'Air Force', 'Blanches', 34, '140', 'Mixtes'),
(37, 'nikeairmax.webp', 'Nike', 'Air Max', 'Blanches', 34, '200', 'Femmes');

-- --------------------------------------------------------

--
-- Structure de la table `statuts_commandes`
--

CREATE TABLE `statuts_commandes` (
  `commandes_id` int(11) NOT NULL,
  `statuts_commandes_etapes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `statuts_commandes`
--

INSERT INTO `statuts_commandes` (`commandes_id`, `statuts_commandes_etapes`) VALUES
(1, 'En cours'),
(2, 'Validée'),
(3, 'Annulée'),
(4, 'Terminée');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs_connexion`
--

CREATE TABLE `utilisateurs_connexion` (
  `utilisateurs_id` int(11) NOT NULL,
  `prenom_utilisateur` text NOT NULL,
  `mot_de_passe_utilisateur` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs_connexion`
--

INSERT INTO `utilisateurs_connexion` (`utilisateurs_id`, `prenom_utilisateur`, `mot_de_passe_utilisateur`) VALUES
(2, 'client', 'client'),

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin_connexion`
--
ALTER TABLE `admin_connexion`
  ADD PRIMARY KEY (`admin_id`);

--
-- Index pour la table `categories_produits`
--
ALTER TABLE `categories_produits`
  ADD PRIMARY KEY (`categories_produits_id`);

--
-- Index pour la table `motscles`
--
ALTER TABLE `motscles`
  ADD PRIMARY KEY (`motscles_id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`panier_id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`produits_id`);

--
-- Index pour la table `statuts_commandes`
--
ALTER TABLE `statuts_commandes`
  ADD PRIMARY KEY (`commandes_id`);

--
-- Index pour la table `utilisateurs_connexion`
--
ALTER TABLE `utilisateurs_connexion`
  ADD PRIMARY KEY (`utilisateurs_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin_connexion`
--
ALTER TABLE `admin_connexion`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categories_produits`
--
ALTER TABLE `categories_produits`
  MODIFY `categories_produits_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `motscles`
--
ALTER TABLE `motscles`
  MODIFY `motscles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `panier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `produits_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `statuts_commandes`
--
ALTER TABLE `statuts_commandes`
  MODIFY `commandes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateurs_connexion`
--
ALTER TABLE `utilisateurs_connexion`
  MODIFY `utilisateurs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
