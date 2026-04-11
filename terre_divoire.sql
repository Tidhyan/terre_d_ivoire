-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 11 avr. 2026 à 15:54
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

--
-- Déchargement des données de la table `modeles_construction`
--

INSERT INTO `modeles_construction` (`id`, `nom_modele`, `slogan`, `description`, `caracteristiques`, `prix`, `photo_principale_1`, `photo_principale_2`, `lien_video`, `lien_matterport`) VALUES
(1, 'Villa Sanou', 'Modele GBANGBAN', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type s', 'Cuisine 10, Chalbre erere', '50 000 000', '69d7ce0600aaf.jpg', '69d7ce0600e15.jpg', 'https://www.youtube.com/watch?v=s0trVuuUOY8&list=RDs0trVuuUOY8&start_radio=1', 'https://my.matterport.com/show?play=1&m=vNtptZXMm8U'),
(2, 'Villa Cisse', 'Modele TESTE', 'survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'CUISINE, DEUX CHAMBRES SALON, DEUX CUISINES', '6 000 000', '69d7dfb85bb1c.jpg', '69d7dfb85bc8c.jpg', 'https://www.youtube.com/watch?v=s0trVuuUOY8&list=RDs0trVuuUOY8&start_radio=1', 'https://my.matterport.com/show?play=1&m=vNtptZXMm8U'),
(3, 'Villa KONAN', 'Modele VAGABOND', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\',', 'CUISINE, DEUX CHAMBRES SALON, DEUX CUISINES', '50 000 000', '69d7e2260820d.jpg', '69d7e22608438.jpg', 'https://www.youtube.com/watch?v=s0trVuuUOY8&list=RDs0trVuuUOY8&start_radio=1', 'https://my.matterport.com/show?play=1&m=vNtptZXMm8U'),
(10, 'Villa BARCA ', 'Modele GBANGBAN', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\',', 'CUISINE, SALON , Douche', '10 000 000', '1775912339_1_etude.jpeg', '1775912339_2_etude.jpeg', 'https://www.youtube.com/watch?v=s0trVuuUOY8&list=RDs0trVuuUOY8&start_radio=1', 'https://my.matterport.com/show?play=1&m=vNtptZXMm8U'),
(11, 'Villa REAL', 'Modele VAGABOND', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\',', 'DEUX CHAMBRES SALON, DEUX CUISINES', '6 000 000', '1775912413_1_acd.jpeg', '1775912413_2_acd.jpeg', 'https://www.youtube.com/watch?v=s0trVuuUOY8&list=RDs0trVuuUOY8&start_radio=1', 'https://my.matterport.com/show?play=1&m=vNtptZXMm8U');

-- --------------------------------------------------------

--
-- Structure de la table `photos_3d`
--

CREATE TABLE `photos_3d` (
  `id` int(11) NOT NULL,
  `id_modele` int(11) DEFAULT NULL,
  `chemin_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `photos_3d`
--

INSERT INTO `photos_3d` (`id`, `id_modele`, `chemin_image`) VALUES
(1, 1, '69d7ce06028b8_3d.jpg'),
(2, 1, '69d7ce0603857_3d.jpg'),
(3, 1, '69d7ce06040d9_3d.jpg'),
(4, 1, '69d7ce060566c_3d.jpg'),
(5, 1, '69d7ce0605f2d_3d.jpg'),
(6, 1, '69d7ce0606867_3d.jpg'),
(7, 2, '69d7dfb85cf9f_3d.jpg'),
(8, 2, '69d7dfb85dfe3_3d.jpg'),
(9, 2, '69d7dfb85e796_3d.jpg'),
(10, 2, '69d7dfb85fa48_3d.jpg'),
(11, 2, '69d7dfb860f7d_3d.jpg'),
(12, 2, '69d7dfb862005_3d.jpg'),
(13, 3, '69d7e22608f97_3d.jpg'),
(14, 3, '69d7e22609734_3d.jpg'),
(15, 3, '69d7e2260a065_3d.jpg'),
(16, 3, '69d7e2260a8e3_3d.jpg'),
(17, 3, '69d7e2260c3ed_3d.jpg'),
(18, 3, '69d7e2260ceee_3d.jpg'),
(45, 10, '1775912339_3d_etude.jpeg'),
(46, 10, '1775912339_3d_acd.jpeg'),
(47, 10, '1775912339_3d_logo terre d\'ivoire copie.png'),
(48, 10, '1775912339_3d_logo.png'),
(49, 11, '1775912413_3d_etude.jpeg'),
(50, 11, '1775912413_3d_acd.jpeg'),
(51, 11, '1775912413_3d_logo terre d\'ivoire copie.png'),
(52, 11, '1775912413_3d_logo.png');

-- --------------------------------------------------------

--
-- Structure de la table `photos_vente_galerie`
--

CREATE TABLE `photos_vente_galerie` (
  `id` int(11) NOT NULL,
  `id_produit` int(11) DEFAULT NULL,
  `chemin_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `photos_vente_galerie`
--

INSERT INTO `photos_vente_galerie` (`id`, `id_produit`, `chemin_image`) VALUES
(44, 9, '1775769874_gal_photo6.jpg'),
(45, 9, '1775769874_gal_photo5.jpg'),
(46, 10, '1775771117_gal_photo2.jpg'),
(47, 10, '1775771117_gal_photo1.jpg'),
(48, 11, '1775771943_gal_photo6.jpg'),
(49, 11, '1775771944_gal_photo5.jpg'),
(50, 12, '1775847711_gal_photo6.jpg'),
(51, 12, '1775847711_gal_photo5.jpg'),
(52, 12, '1775847711_gal_photo4.jpg'),
(53, 17, '1775851079_gal_photo6.jpg'),
(54, 17, '1775851079_gal_photo5.jpg'),
(55, 17, '1775851079_gal_photo4.jpg'),
(56, 17, '1775851079_gal_photo3.jpg'),
(57, 17, '1775851079_gal_photo2.jpg'),
(58, 17, '1775851079_gal_photo1.jpg'),
(59, 18, '1775851256_gal_photo6.jpg'),
(60, 18, '1775851256_gal_photo5.jpg'),
(61, 18, '1775851256_gal_photo4.jpg'),
(62, 18, '1775851256_gal_photo3.jpg'),
(63, 18, '1775851256_gal_photo2.jpg'),
(64, 18, '1775851256_gal_photo1.jpg'),
(65, 19, '1775851571_gal_photo6.jpg'),
(66, 19, '1775851571_gal_photo5.jpg'),
(67, 19, '1775851571_gal_photo4.jpg'),
(68, 19, '1775851571_gal_photo3.jpg'),
(69, 19, '1775851571_gal_photo2.jpg'),
(70, 19, '1775851571_gal_photo1.jpg'),
(74, 23, '1775853132_gal_photo6.jpg'),
(75, 23, '1775853132_gal_photo5.jpg'),
(76, 23, '1775853132_gal_photo4.jpg'),
(77, 23, '1775853132_gal_photo3.jpg'),
(78, 23, '1775853132_gal_photo2.jpg'),
(79, 23, '1775853132_gal_photo1.jpg'),
(80, 24, '1775853450_gal_photo6.jpg'),
(81, 24, '1775853450_gal_photo5.jpg'),
(82, 24, '1775853450_gal_photo4.jpg'),
(83, 24, '1775853450_gal_photo3.jpg'),
(84, 24, '1775853450_gal_photo2.jpg'),
(85, 24, '1775853450_gal_photo1.jpg');

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
  `caracteristiques` text DEFAULT NULL,
  `livraison_gros_oeuvre` tinyint(1) DEFAULT 0,
  `livraison_cle_main` tinyint(1) DEFAULT 0,
  `date_ajout` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits_vente`
--

INSERT INTO `produits_vente` (`id`, `categorie`, `nom`, `accroche`, `localisation`, `description`, `prix`, `superficie`, `pieces`, `parking`, `photo_principale`, `lien_video`, `caracteristiques`, `livraison_gros_oeuvre`, `livraison_cle_main`, `date_ajout`) VALUES
(9, 'promotion', 'KOFFI YAO Sanou', 'Une vue sur l\'AIR sur aSSINIE', 'ADJAME', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you', '20 000 000', '200', '3', 1, '1775847465_photo2.jpg', 'https://my.matterport.com/show?play=1&lang=en-US&m=vNtptZXMm8U', '', 0, 1, '2026-04-09 21:24:34'),
(10, 'particulier', 'Vehi Patrice Marie real', 'Une vue sur la lagune', 'ABIDJAN, Bingerville', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you', '99 000 000', '500', '3', 5, '1775771229_photo6.jpg', 'https://my.matterport.com/show?play=1&lang=en-US&m=vNtptZXMm8U', '', 1, 0, '2026-04-09 21:45:17'),
(11, 'particulier', 'Ziriga Djoukou Marie', 'Une vue sur le paradis', 'ABIDJAN, Bingerville', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you', '10 000 000', '1000', '3', 5, '1775772524_photo4.jpg', 'https://my.matterport.com/show?play=1&lang=en-US&m=vNtptZXMm8U', '', 0, 1, '2026-04-09 21:59:03'),
(12, 'terrain', 'Vehi Patrice', 'Une vue sur l\'AIR', 'ABIDJAN, Bingerville', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you', '89 000 000', '500', '3', 0, '1775849638_photo4.jpg', 'https://www.youtube.com/watch?v=s0trVuuUOY8&list=RDs0trVuuUOY8&start_radio=1', '', 0, 0, '2026-04-10 19:01:51'),
(13, 'terrain', 'Ziriga Djoukou Marie Josiane', 'Une vue sur l\'AIR sur aSSINIE', 'ABIDJAN, Bingerville', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you', '99 000 000', '500', '', 0, '1775849924_', 'https://www.youtube.com/watch?v=s0trVuuUOY8&list=RDs0trVuuUOY8&start_radio=1', '', 0, 0, '2026-04-10 19:38:44'),
(14, 'terrain', 'KOFFI YAO Sanou', NULL, 'ADJAME', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you', '50 000 000', '900', '', NULL, '1775850171_photo3.jpg', 'https://www.youtube.com/watch?v=s0trVuuUOY8&list=RDs0trVuuUOY8&start_radio=1', '', 0, 0, '2026-04-10 19:42:51'),
(15, 'promotion', 'Gnagne Nomel Jacques', NULL, 'ABIDJAN, Bingerville', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ', '50000000', '200', '', NULL, '1775850787_photo1.jpg', NULL, '', 0, 0, '2026-04-10 19:53:07'),
(16, 'terrain', 'KOFFI KONAN JORES', NULL, 'Assinie, Mafia', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ', '99 000 000', '600', '', NULL, '1775850859_photo2.jpg', 'https://www.youtube.com/watch?v=s0trVuuUOY8&list=RDs0trVuuUOY8&start_radio=1', '', 0, 0, '2026-04-10 19:54:19'),
(17, 'promotion', 'Vehi Patrice Real  barce', 'Une vue sur l\'AIR sur aSSINIE', 'Assinie, MAFIEUX', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ', '100 000 000', '600', '6', 5, '1775851171_photo5.jpg', 'https://my.matterport.com/show?play=1&lang=en-US&m=vNtptZXMm8U', '', 0, 1, '2026-04-10 19:57:59'),
(18, 'particulier', 'Sawadogo Malicki', 'Une vue sur l\'AIR', 'ABIDJAN, Bingerville', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ', '6 000 000', '600', '6', 4, '1775851318_photo5.jpg', 'https://my.matterport.com/show?play=1&lang=en-US&m=vNtptZXMm8U', '', 1, 0, '2026-04-10 20:00:56'),
(19, 'promotion', 'Vehi Patrice', 'Une vue sur le paradis', 'ABIDJAN, Bingerville', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ', '99 000 000', '500', '6', 4, '1775851571_photo4.jpg', 'https://my.matterport.com/show?play=1&lang=en-US&m=vNtptZXMm8U', '', 1, 0, '2026-04-10 20:06:11'),
(21, 'particulier', 'Ziriga Djoukou Marie Josiane', 'Une vue sur la lagune', 'ABIDJAN, Bingerville', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ', '99 000 000', '600', '3', 5, '1775851700_photo1.jpg', 'https://my.matterport.com/show?play=1&lang=en-US&m=vNtptZXMm8U', '', 1, 0, '2026-04-10 20:08:20'),
(22, 'promotion', 'Ziriga Djoukou Marie Josiane cle en amins', '', '', '', '99 000 000', '', '', 0, '1775851723_photo2.jpg', '', '', 0, 1, '2026-04-10 20:08:43'),
(23, 'particulier', 'Ziriga Djoukou Barca', 'Une vue sur l\'AIR sur aSSINIE', 'ABIDJAN, Bingerville', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it ha', '50 000 000', '600', '6', 5, '1775853132_photo5.jpg', 'https://my.matterport.com/show?play=1&lang=en-US&m=vNtptZXMm8U', '', 0, 1, '2026-04-10 20:32:12'),
(24, 'promotion', 'Vehi Patrice real', 'Une vue sur l\'AIR sur aSSINIE', 'ABIDJAN, Bingerville', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it ha', '50 000 000', '500', '6', 5, '1775853450_photo2.jpg', 'https://my.matterport.com/show?play=1&lang=en-US&m=vNtptZXMm8U', '', 0, 1, '2026-04-10 20:37:30'),
(25, 'terrain', 'Ziriga Djoukou Real', NULL, 'ABIDJAN, BALLARD', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it ha', '4000000', '999', NULL, NULL, '1775854611_photo6.jpg', 'https://www.youtube.com/watch?v=s0trVuuUOY8&list=RDs0trVuuUOY8&start_radio=1', '', 0, 0, '2026-04-10 20:54:46');

--
-- Index pour les tables déchargées
--

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
-- AUTO_INCREMENT pour la table `modeles_construction`
--
ALTER TABLE `modeles_construction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `photos_3d`
--
ALTER TABLE `photos_3d`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `photos_vente_galerie`
--
ALTER TABLE `photos_vente_galerie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT pour la table `produits_vente`
--
ALTER TABLE `produits_vente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
