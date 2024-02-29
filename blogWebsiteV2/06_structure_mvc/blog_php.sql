-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 29 fév. 2024 à 09:10
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `article` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `post_id`, `article`, `image`, `position`) VALUES
(1, 23, 'premier texte d\'article', '', 1),
(2, 23, 'deuxieme texte d\'article', '', 2),
(6, 23, '5eme article\r\n', '', 4),
(7, 22, 'test sur autre article', '', 0),
(8, 22, 'Deuxieme test article tahiti (autre)', '', 0),
(14, 23, '', 'https://cdn.pixabay.com/photo/2024/02/07/16/15/flower-8559381_960_720.jpg', 0),
(18, 23, '', 'https://cdn.pixabay.com/photo/2024/02/07/16/15/flower-8559381_960_720.jpg', 0),
(19, 23, '', 'image', 3),
(20, 23, 'dgdfdfgdfdfgdfgdfgd', '', 0),
(21, 23, 'test thomas !', '', 7),
(22, 23, '', 'image', 0),
(23, 23, 'iuhhuihuihuicvbcvcvbcvcvvcbcvbcvbcvcvb', '', 0),
(24, 23, '', 'https://cdn.pixabay.com/photo/2024/02/07/16/15/flower-8559381_960_720.jpg', 0),
(25, 23, '', 'https://cdn.pixabay.com/photo/2023/08/21/17/44/flower-8204791_640.jpg', 0),
(26, 22, 'C&#039;est partiiiiiiiiiiiiiiiiiii', '', 0),
(27, 23, 'Test en cartooooooon', '', 120);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`) VALUES
(1, 9, 23, '5644665'),
(2, 9, 23, '5644665'),
(3, 9, 23, '5644665'),
(4, 9, 23, '645'),
(11, 9, 23, 'sdfsdfsdfsdfsdfsd'),
(12, 9, 23, 'sdfsdfsdfsdfsdfsd'),
(13, 9, 22, 'fghfghfghfh');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(35) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(55) NOT NULL,
  `state` varchar(35) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `user_id`, `firstname`, `lastname`, `address1`, `address2`, `city`, `state`, `zip`, `message`, `created_at`) VALUES
(1, 9, 'okokokok', 'okok', 'okok', 'ok', 'okok', 'Corse', 'ok', 'Hello les devs PHP !!!', '2024-02-21 14:29:45'),
(11, 14, 'admin', 'admin', 'admin', 'admin', 'admin', 'Grand Est', 'admin', '', '2024-02-28 09:47:33'),
(12, 15, 'user', 'user', 'user', 'user', 'user', 'Centre-Val de Loire', 'user', '', '2024-02-28 09:47:58'),
(13, 16, 'testcontact', 'testcontact', 'testcontact', 'testcontact', 'testcontact', 'Corse', 'testcontact', 'testcontact', '2024-02-28 09:49:53'),
(14, 17, 'yip', 'yip', 'yip', 'yip', 'yip', 'Guadeloupe', 'yip', 'yip', '2024-02-28 10:04:44'),
(15, 18, 'yop', 'yop', 'yop', 'yop', 'yop', 'Normandie', 'yop', '', '2024-02-28 10:05:51'),
(16, 19, 'yp', 'yp', 'yp', 'yp', 'yp', 'Nouvelle-Aquitaine', 'yp', '', '2024-02-28 10:06:27');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `topic` varchar(80) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `user_id`, `title`, `topic`, `description`, `image`, `created_at`) VALUES
(22, 9, 'Voyage &agrave; Tahiti', 'tahiti', '', 'https://cdn.pixabay.com/photo/2015/03/18/21/20/moorea-680033_960_720.jpg', '2024-02-25 22:42:40'),
(23, 9, 'test', 'test1', 'rtertertert', 'https://cdn.pixabay.com/photo/2015/03/18/21/20/moorea-680033_960_720.jpg', '2024-02-26 06:21:11');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL DEFAULT '[]',
  `registered_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `roles`, `registered_at`) VALUES
(9, 'ok@ok.com', '$2y$10$f15wED7XfAqaZTDzGp9iFORTpuo4dh2O2F8WhxE6CSHNmsC9CleOe', '[\"ROLE_ADMIN\",\"ROLE_MEMBER\"]', '2024-02-24 20:22:21'),
(14, 'admin@admin.com', '$2y$10$26AKEwwpi.uPCtsfNvDrs.5nbX3XSLdBqqxufWBTJ4J8h3PLgfOLW', '[\"ROLE_ADMIN\",\"ROLE_MEMBER\"]', '2024-02-28 09:47:33'),
(15, 'user@user.com', '$2y$10$vX1k/tZoi2JR1tcCQg49XONYTWHPVcu.8EyR41glyaQCuvaDaDeYK', '[\"ROLE_MEMBER\"]', '2024-02-28 09:47:58'),
(16, 'testcontact@testcontact.com', '$2y$10$PgBlZAvVeIse..Ois2qr0uSnJqXnmBpwS868hrmbyviacQICnETBO', '[\"ROLE_MEMBER\"]', '2024-02-28 09:49:53'),
(17, 'yip@yip.com', '$2y$10$/JNTE3LJ5W3RbfJfVSTDT.U3uFJTUlKWwKFBmi7f03Tye.kVvdyIa', '[\"ROLE_MEMBER\"]', '2024-02-28 10:04:44'),
(18, 'yop@yop.com', '$2y$10$8H8wWzGx1SkEUpPzNYCwN.Jmqsj2jnIDGLKrKlkP5k4zMtKzISykG', '[\"ROLE_ADMIN\",\"ROLE_MEMBER\"]', '2024-02-28 10:05:51'),
(19, 'yp@yp.com', '$2y$10$Ix2YM6LrLUyXvdlLNRsenOUN0GwwhzOuY0gq0l.XbP7NakLLrv8X6', '[\"ROLE_MEMBER\"]', '2024-02-28 10:06:27');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_post_id_article` (`post_id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_post_id` (`post_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contact_user` (`user_id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_post_id_article` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_post_id` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `fk_contact_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
