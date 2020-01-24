-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 24 jan. 2020 à 11:14
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  5.5.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `chat_project_db`
--
CREATE DATABASE IF NOT EXISTS `chat_project_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `chat_project_db`;
-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`) VALUES
(1, 'imane', '$2y$10$RcRDd6b09MpEZPO1fkhVd.VvXm9hDa8tyGVs.RFU8iojIv6suU4.O', 1),
(2, 'anas', '$2y$10$RcRDd6b09MpEZPO1fkhVd.VvXm9hDa8tyGVs.RFU8iojIv6suU4.O', 0),
(3, 'fatima', '$2y$10$RcRDd6b09MpEZPO1fkhVd.VvXm9hDa8tyGVs.RFU8iojIv6suU4.O', 1),
(4, 'morad', '$2y$10$RcRDd6b09MpEZPO1fkhVd.VvXm9hDa8tyGVs.RFU8iojIv6suU4.O', 0);

--
-- Index pour les tables déchargées
--
--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `id_user1` int(11) NOT NULL,
  `id_user2` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`id`, `id_user1`, `id_user2`, `created_at`) VALUES
(2, 2, 1, '2020-01-23 20:31:59'),
(3, 3, 1, '2020-01-23 21:12:05');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_conversation` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `id_user`, `id_conversation`, `content`, `created_at`) VALUES
(7, 2, 2, 'salam imane', '2020-01-23 20:32:10'),
(8, 1, 2, 'salam anas cv ', '2020-01-23 21:10:23'),
(9, 2, 2, 'oui cava et toi', '2020-01-23 21:10:41'),
(10, 1, 2, 'cv hmd rebi khalik', '2020-01-23 21:10:53'),
(11, 3, 3, 'salam fatima cv ', '2020-01-23 21:12:14'),
(12, 3, 3, 'salam fatima cv ', '2020-01-23 21:12:14'),
(13, 1, 3, 'salam imane cv hmd ', '2020-01-23 21:12:46');

-- --------------------------------------------------------
--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user1` (`id_user1`),
  ADD KEY `id_user2` (`id_user2`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_conversation` (`id_conversation`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `conversation_ibfk_1` FOREIGN KEY (`id_user1`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `conversation_ibfk_2` FOREIGN KEY (`id_user2`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`id_conversation`) REFERENCES `conversation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
