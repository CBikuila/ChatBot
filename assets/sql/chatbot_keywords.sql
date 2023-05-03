-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 03 mai 2023 à 14:31
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
-- Structure de la table `chatbot_keywords`
--

CREATE TABLE `chatbot_keywords` (
  `chatbot_keywords_id` int(11) NOT NULL,
  `nom` text,
  `taille` varchar(100) DEFAULT NULL,
  `disponibilite` varchar(100) DEFAULT NULL,
  `couleur` varchar(100) DEFAULT NULL,
  `matiere` varchar(100) DEFAULT NULL,
  `prix` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chatbot_keywords`
--

INSERT INTO `chatbot_keywords` (`chatbot_keywords_id`, `nom`, `taille`, `disponibilite`, `couleur`, `matiere`, `prix`) VALUES
(1, '', '', '', '', '', ''),
(2, 'Air Max 90', NULL, NULL, 'Bleu', NULL, NULL),
(3, 'Jordan 1', NULL, NULL, 'Rouge', NULL, NULL),
(4, 'Yeezy Boost 350', NULL, NULL, 'Noir', NULL, NULL),
(5, 'Air Max 90', NULL, NULL, 'Bleu', NULL, NULL),
(6, 'Jordan 1', NULL, NULL, 'Rouge', NULL, NULL),
(7, 'Yeezy Boost 350', NULL, NULL, 'Noir', NULL, NULL),
(8, 'Air Max 90', NULL, NULL, 'Bleu', NULL, NULL),
(9, 'Jordan 1', NULL, NULL, 'Rouge', NULL, NULL),
(10, 'Yeezy Boost 350', NULL, NULL, 'Noir', NULL, NULL),
(11, 'Air Max 90', NULL, NULL, 'Bleu', NULL, NULL),
(12, 'Jordan 1', NULL, NULL, 'Rouge', NULL, NULL),
(13, 'Yeezy Boost 350', NULL, NULL, 'Noir', NULL, NULL),
(14, 'Air Max 90', NULL, NULL, 'Bleu', NULL, NULL),
(15, 'Jordan 1', NULL, NULL, 'Rouge', NULL, NULL),
(16, 'Yeezy Boost 350', NULL, NULL, 'Noir', NULL, NULL),
(17, 'Air Max 90', NULL, NULL, 'Bleu', NULL, NULL),
(18, 'Jordan 1', NULL, NULL, 'Rouge', NULL, NULL),
(19, 'Yeezy Boost 350', NULL, NULL, 'Noir', NULL, NULL),
(20, 'Air Max 90', NULL, NULL, 'Bleu', NULL, NULL),
(21, 'Jordan 1', NULL, NULL, 'Rouge', NULL, NULL),
(22, 'Yeezy Boost 350', NULL, NULL, 'Noir', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chatbot_keywords`
--
ALTER TABLE `chatbot_keywords`
  ADD PRIMARY KEY (`chatbot_keywords_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chatbot_keywords`
--
ALTER TABLE `chatbot_keywords`
  MODIFY `chatbot_keywords_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
