-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 26 fév. 2024 à 22:53
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
  `article_et_image` text NOT NULL,
  `place` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `post_id`, `article_et_image`, `place`) VALUES
(1, 23, 'premier texte d\'article', 1),
(2, 23, 'deuxieme texte d\'article', 2);

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
(12, 9, 23, 'sdfsdfsdfsdfsdfsd');

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
(1, 5, 'Dekpo Wyna', 'Yologaza', '2 Rue du Lavoir', '', '74150 - RUMILLY', 'Auvergne-Rh&ocirc;ne-Alpes', '74150', 'Hello les devs PHP !!!', '2024-02-21 14:29:45'),
(2, 6, 'Dekpo Wyna', 'Yologaza', '2 Rue du Lavoir', '', '74150 - RUMILLY', 'Choose...', '74150', '', '2024-02-21 15:21:08'),
(3, 7, 'Dekpo Gmail', 'Yologaza', '2 Rue du Lavoir', '', 'RUMILLY', 'Corse', '74150', '', '2024-02-21 15:35:16'),
(4, 8, 'Dekpo Wyna', 'Yologaza', '2 Rue du Lavoir', '', '74150 - RUMILLY', 'Auvergne-Rh&ocirc;ne-Alpes', '74150', '', '2024-02-22 08:18:13'),
(5, 9, 'ok', 'ok', 'ok', 'ok', 'ok', 'Corse', 'ok', '', '2024-02-24 20:22:21');

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
  `article` text NOT NULL,
  `image` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `user_id`, `title`, `topic`, `description`, `article`, `image`, `created_at`) VALUES
(22, 9, 'Voyage &agrave; Tahiti', 'tahiti', '', 'our trip to tahiti!', 'https://cdn.pixabay.com/photo/2015/03/18/21/20/moorea-680033_960_720.jpg', '2024-02-25 22:42:40'),
(23, 9, 'test', 'test1', 'rtertertert', 'okokok!!', 'https://cdn.pixabay.com/photo/2015/03/18/21/20/moorea-680033_960_720.jpg', '2024-02-26 06:21:11');

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
(5, 'dekpo@me.com', '$2y$10$m8a9JOxwYncQaN1pP126MemmU2Uuh4U2E4F5laI3.d/3pC6WaghT2', '[\"ROLE_ADMIN\",\"ROLE_MEMBER\"]', '2024-02-21 14:29:45'),
(6, 'dw.yologaza@gmail.com', '$2y$10$5XqlJxiRx6wVLBu3YXZRIuRLAO9t6E.sms9WOJNP7z1c6fop5LkIe', '[]', '2024-02-21 15:21:08'),
(7, 'dw.yologaza@wanadoo.fr', '$2y$10$xIxrwv4.SN6HCZVDYZT95.Q/1uUrf.PZCZslGSH6aAM0DBKGxLu8y', '[]', '2024-02-21 15:35:16'),
(8, 'dekpo@icloud.com', '$2y$10$m8a9JOxwYncQaN1pP126MemmU2Uuh4U2E4F5laI3.d/3pC6WaghT2', '[]', '2024-02-22 08:18:13'),
(9, 'ok@ok.com', '$2y$10$f15wED7XfAqaZTDzGp9iFORTpuo4dh2O2F8WhxE6CSHNmsC9CleOe', '[\"ROLE_ADMIN\",\"ROLE_MEMBER\"]', '2024-02-24 20:22:21');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
