-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 22 avr. 2026 à 21:09
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `terre_divoire`
--

-- --------------------------------------------------------

--
-- Structure de la table `carrousel`
--

CREATE TABLE `carrousel` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `sous_titre` varchar(100) DEFAULT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `texte_bouton` varchar(50) DEFAULT 'EN SAVOIR PLUS',
  `lien_bouton` varchar(255) DEFAULT '#',
  `ordre` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `modeles_construction`
--

CREATE TABLE `modeles_construction` (
  `id` int(11) NOT NULL,
  `nom_modele` varchar(255) DEFAULT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `caracteristiques` text DEFAULT NULL,
  `prix` varchar(100) DEFAULT NULL,
  `photo_principale_1` varchar(255) DEFAULT NULL,
  `photo_principale_2` varchar(255) DEFAULT NULL,
  `lien_video` varchar(255) DEFAULT NULL,
  `lien_matterport` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photos_3d`
--

CREATE TABLE `photos_3d` (
  `id` int(11) NOT NULL,
  `id_modele` int(11) DEFAULT NULL,
  `chemin_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photos_vente_galerie`
--

CREATE TABLE `photos_vente_galerie` (
  `id` int(11) NOT NULL,
  `id_produit` int(11) DEFAULT NULL,
  `chemin_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits_vente`
--

CREATE TABLE `produits_vente` (
  `id` int(11) NOT NULL,
  `categorie` enum('promotion','particulier','terrain') NOT NULL,
  `nom` varchar(255) NOT NULL,
  `accroche` varchar(255) DEFAULT NULL,
  `localisation` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `prix` varchar(100) DEFAULT NULL,
  `superficie` varchar(100) DEFAULT NULL,
  `pieces` varchar(50) DEFAULT NULL,
  `parking` int(11) DEFAULT 0,
  `photo_principale` varchar(255) DEFAULT NULL,
  `lien_video` varchar(255) DEFAULT NULL,
  `statut` varchar(50) DEFAULT 'Disponible',
  `caracteristiques` text DEFAULT NULL,
  `livraison_gros_oeuvre` tinyint(1) DEFAULT 0,
  `livraison_cle_main` tinyint(1) DEFAULT 0,
  `date_ajout` timestamp NOT NULL DEFAULT current_timestamp(),
  `video_youtube` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `carrousel`
--
ALTER TABLE `carrousel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `modeles_construction`
--
ALTER TABLE `modeles_construction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `photos_3d`
--
ALTER TABLE `photos_3d`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_modele` (`id_modele`);

--
-- Index pour la table `photos_vente_galerie`
--
ALTER TABLE `photos_vente_galerie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `produits_vente`
--
ALTER TABLE `produits_vente`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `carrousel`
--
ALTER TABLE `carrousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `modeles_construction`
--
ALTER TABLE `modeles_construction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `photos_3d`
--
ALTER TABLE `photos_3d`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `photos_vente_galerie`
--
ALTER TABLE `photos_vente_galerie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits_vente`
--
ALTER TABLE `produits_vente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `photos_3d`
--
ALTER TABLE `photos_3d`
  ADD CONSTRAINT `photos_3d_ibfk_1` FOREIGN KEY (`id_modele`) REFERENCES `modeles_construction` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `photos_vente_galerie`
--
ALTER TABLE `photos_vente_galerie`
  ADD CONSTRAINT `photos_vente_galerie_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produits_vente` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
