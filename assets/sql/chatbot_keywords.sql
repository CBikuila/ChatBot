-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 03 mai 2023 à 13:29
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
  `chatbot_keywords_number` int(11) NOT NULL,
  `chatbot_keywords_tailles` varchar(100) NOT NULL,
  `chatbot_keywords_dispo` varchar(100) NOT NULL,
  `chatbot_keywords_couleurs` varchar(100) NOT NULL,
  `chatbot_keywords_materiaux` varchar(100) NOT NULL,
  `chatbot_keywords_prix` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chatbot_keywords`
--

INSERT INTO `chatbot_keywords` (`chatbot_keywords_number`, `chatbot_keywords_tailles`, `chatbot_keywords_dispo`, `chatbot_keywords_couleurs`, `chatbot_keywords_materiaux`, `chatbot_keywords_prix`) VALUES
(1, '', '', '', '', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chatbot_keywords`
--
ALTER TABLE `chatbot_keywords`
  ADD PRIMARY KEY (`chatbot_keywords_number`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chatbot_keywords`
--
ALTER TABLE `chatbot_keywords`
  MODIFY `chatbot_keywords_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
