-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 08 Mai 2015 à 10:30
-- Version du serveur: 5.5.42
-- Version de PHP: 5.4.39-0+deb7u2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `awex-devcamp`
--

-- --------------------------------------------------------

--
-- Structure de la table `checklists`
--

CREATE TABLE IF NOT EXISTS `checklists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `mission_type` int(11) NOT NULL,
  `small_description` text COLLATE utf8_bin NOT NULL,
  `big_description` text COLLATE utf8_bin NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `dday` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `checklists_user_id_index` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Contenu de la table `checklists`
--

INSERT INTO `checklists` (`id`, `name`, `mission_type`, `small_description`, `big_description`, `user_id`, `dday`, `created_at`, `updated_at`) VALUES
(7, 'Présentation Couteau Suisse', 2, 'Présentation aux différents collaborateurs de monsieur JP Marcelle', 'Namur Office Park\r\nAvenue des Dessus de Lives\r\nBâtiment n°6\r\n5101 Loyers\r\n\r\nCe vendredi 17 octobre à 10h30\r\n\r\nRendez-vous qui permettra de vous présenter l''outil "Couteaux Suisse" réalisé par MeaWeb lors du MIC Summer Camp.', 1, '0000-00-00', '2014-10-16 18:18:34', '2014-10-16 18:18:34'),
(8, 'Colombie & Pérou - Mission Princière - 18-25 octobre 2014', 3, 'Mission économique belge présidée par SAR la Princesse Astrid\r\n \r\nColombie - Bogota\r\nPérou - Lima\r\ndu 18 au 25 octobre 2014', 'Dans le cadre de l''Accord de Coopération entre l''Autorité fédérale et les Régions, une mission économique conjointe se déroulera en Colombie et au Pérou du 18 au 25 octobre 2014, sous la présidence de SAR la Princesse Astrid, représentant le Roi Philippe, Président d''honneur de l''Agence pour le Commerce Extérieur (ACE). Cette mission est organisée par l''ACE en étroite collaboration avec les instances régionales du commerce extérieur : Bruxelles Invest & Export, l''Agence Wallonne à l''Exportation et aux Investissements Etrangers (AWEX) et Flanders Investment & Trade (FIT).\r\n \r\nLa délégation belge se rendra à Bogota et à Lima.\r\n \r\nTenant compte des spécificités du marché local, les secteurs suivants ont été ciblés :\r\nLes infrastructures ;\r\nLa construction ;\r\nL''énergie ;\r\nL''agro-industrie ;\r\nLes mines.\r\nLa mission reste bien entendu ouverte aux entreprises d''autres secteurs.\r\n \r\nLes participants à la mission pourront bénéficier du support de l''Attachée économique et commerciale basée en Colombie (à Bogota) (compétente également pour le Pérou), qui leur préparera un programme de rendez-vous individuels et ciblés avec des partenaires potentiels (basé sur les désidératas des participants à la mission).\r\nParallèlement à ces rendez-vous B2B, des rencontres officielles, des visites d''entreprises, des séminaires sectoriels, ainsi que des cérémonies de signatures et réceptions de networking seront au programme.', 0, '0000-00-00', '2014-10-16 18:27:28', '2014-10-16 18:27:28');

-- --------------------------------------------------------

--
-- Structure de la table `checklist_users`
--

CREATE TABLE IF NOT EXISTS `checklist_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `checklist_id` int(10) unsigned NOT NULL,
  `dday` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `checklist_users_user_id_index` (`user_id`),
  KEY `checklist_users_checklist_id_index` (`checklist_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Contenu de la table `checklist_users`
--

INSERT INTO `checklist_users` (`id`, `user_id`, `checklist_id`, `dday`, `created_at`, `updated_at`) VALUES
(5, 2, 7, '0000-00-00', '2014-10-16 18:22:00', '2014-10-16 18:22:00'),
(6, 2, 8, '0000-00-00', '2014-10-17 06:56:19', '2014-10-17 06:56:19');

-- --------------------------------------------------------

--
-- Structure de la table `checklist_user_items`
--

CREATE TABLE IF NOT EXISTS `checklist_user_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `checklist_users_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `status` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `checklist_user_items_checklist_users_id_index` (`checklist_users_id`),
  KEY `checklist_user_items_item_id_index` (`item_id`),
  KEY `checklist_user_items_status_index` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;

--
-- Contenu de la table `checklist_user_items`
--

INSERT INTO `checklist_user_items` (`id`, `checklist_users_id`, `item_id`, `status`, `created_at`, `updated_at`) VALUES
(5, 5, 16, 1, '2014-10-16 18:22:09', '2014-10-16 18:22:09'),
(6, 5, 17, 1, '2014-10-16 19:11:09', '2014-10-16 19:13:09'),
(7, 6, 22, 1, '2014-10-17 06:56:29', '2014-10-17 06:56:29'),
(8, 6, 23, 1, '2014-10-17 06:57:20', '2014-10-17 06:57:20'),
(9, 6, 29, 1, '2014-10-17 06:58:12', '2014-10-17 06:58:12'),
(10, 5, 18, 0, '2014-11-03 07:18:21', '2014-11-03 07:18:27'),
(11, 6, 32, 1, '2014-11-03 08:34:31', '2014-11-03 08:34:31'),
(12, 6, 33, 1, '2014-11-03 08:34:46', '2014-11-03 08:34:46'),
(13, 6, 25, 1, '2014-11-03 08:35:31', '2014-11-03 08:35:31');

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `checklist_id` int(10) unsigned NOT NULL,
  `dday_prev` int(10) NOT NULL,
  `dedicated_to` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `items_checklist_id_index` (`checklist_id`),
  KEY `items_dday_prev_index` (`dday_prev`),
  KEY `items_dedicated_to_index` (`dedicated_to`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=46 ;

--
-- Contenu de la table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `checklist_id`, `dday_prev`, `dedicated_to`, `created_at`, `updated_at`) VALUES
(15, 'Réunion de présentation', 'Namur Office Park\r\n\r\nAvenue des Dessus de Lives\r\n\r\nBâtiment n°6\r\n\r\n5101 Loyers\r\n\r\nCe vendredi 17 octobre à 10h30\r\n\r\nRendez-vous qui permettra de vous présenter l''outil "Couteaux Suisse" réalisé par MeaWeb lors du MIC Summer Camp.', 7, 0, 1, '2014-10-16 18:19:29', '2014-10-16 18:19:29'),
(16, 'Préparation de la réunoin', 'Créations de la mission et des différentes tâches', 7, -1, 0, '2014-10-16 18:20:24', '2014-10-16 18:20:24'),
(17, 'Création de l''outil', 'Création de l''outil lors du MIC Summer Camp du Microsoft innovation center de Mons.', 7, -16, 0, '2014-10-16 18:23:08', '2014-10-16 18:23:08'),
(18, 'Débugging du code', 'Analyse et débugging du code.\r\nDéveloppement de module supplémentaire de type: \r\n\r\n- Liens Flux RSS du site de l''AWEX\r\n- etc ...', 7, 3, 0, '2014-10-16 18:25:54', '2014-10-16 18:25:54'),
(22, 'Passeport et Visa', 'Attention ! Un passeport valable au moins 6 mois après la date de retour de la mission est requis pour les ressortissants belges qui se rendent en Colombie et/ou au Pérou.', 8, -20, 0, '2014-10-16 18:33:02', '2014-10-16 18:33:02'),
(23, 'Inscriptions', 'Droit d''inscription :\r\n100 € / PME\r\n300 € / entreprise de plus de 250 personnes', 8, -10, 0, '2014-10-16 18:33:39', '2014-10-16 18:33:39'),
(25, 'Soutiens Financier', '', 8, -10, 0, '2014-10-16 18:36:54', '2014-10-16 18:36:54'),
(29, '10h00 - Rencontre avec l''Ambassadeur', 'Marjorie INGHELS,\r\nBureau Commercial de l´Ambassade de Belgique en Colombie\r\nEn charge de la Colombie, de l´Équateur, du Pérou et du Vénézuela\r\nT +00 57 1 380 03 30', 8, 1, 0, '2014-10-16 18:42:14', '2014-10-16 18:42:14'),
(30, '12h00 - RDV au restaurant - NOMDURESTO', 'Adresse du resto\r\nContact : Ramon / 047è887471', 8, 1, 0, '2014-10-16 18:43:23', '2014-10-16 18:43:23'),
(31, '14h00 - Rencontre de la CCI Colombienne', 'Information nécessaire', 8, 1, 0, '2014-10-16 18:44:35', '2014-10-16 18:44:35'),
(32, 'Vaccins', 'Fièvre Jaune\r\nEbola\r\nCholera', 8, -20, 0, '2014-10-16 18:45:37', '2014-10-16 18:45:37'),
(33, 'Documents Importants', 'Toute documentation relative à la mission et dont il est nécessaire d''avoir confirmation au moins 15 jours à l''avance', 8, -15, 0, '2014-10-16 18:47:00', '2014-10-16 18:47:00'),
(34, 'Départ de Bruxelles à 13h10 (via Barcelone), arrivée à Bogota à 21h04', 'SN 2929 - Brussels -> Barcelone -> 13h10 | 15h00\r\nVL 4747 - Barcelone -> Bogota -> 18h09 | 09h18', 8, 0, 0, '2014-10-16 18:49:02', '2014-10-16 18:49:02'),
(35, 'Départ de Bogo vers Lima', 'Info vol - Heure - Etc ...', 8, 4, 0, '2014-10-16 18:49:55', '2014-10-16 18:49:55'),
(37, 'Arrivée à Bogota', 'Upon arrival at the airport of Bogota, each participant collects his/her own luggage from the conveyor belt and proceeds to the 2nd floor where three buses reserved for the delegation will be parked.', 8, 0, 0, '2014-10-16 18:55:57', '2014-10-16 18:55:57'),
(38, '20h15 - Session d''information de LIMA', 'Lieux de RDV', 8, 4, 0, '2014-10-16 18:58:43', '2014-10-16 18:58:43'),
(39, '08h30', 'Official meeting of HRH Princess Astrid, Representative of His Majesty \r\nthe King, Belgian Ministers with HE Cecilia Álvarez Correa Glen, \r\nMinister of Commerce, Industry and Tourism\r\n(Venue: Hilton Bogota M Hilton Meetings 1 (2nd floor))', 8, 2, 0, '2014-10-16 19:01:29', '2014-10-16 19:01:29'),
(40, '09h00 - Opening Seminar', 'Didier Reynders', 8, 3, 1, '2014-10-16 19:02:41', '2014-10-16 19:02:41'),
(41, '9h50 - Buisness Seminar Port Developpement', '', 8, 2, 1, '2014-10-16 19:05:24', '2014-10-16 19:05:24'),
(42, '13h00 Agoria Power Luncheon on Energy and Power Generation', '', 8, 2, 0, '2014-10-16 19:07:04', '2014-10-16 19:07:04'),
(43, '16h00 - Official Innauguration of Electric Power Center', '', 8, 2, 1, '2014-10-16 19:07:58', '2014-10-16 19:07:58'),
(44, '17h30 - Visit of Ecopetrol', '', 8, 2, 0, '2014-10-16 19:09:10', '2014-10-16 19:09:10'),
(45, '19h30 - Signing Ceremony', '- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum- Lorem Ipsum', 8, 2, 0, '2014-10-16 19:10:26', '2014-10-16 19:10:26');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_bin NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_08_01_150739_users', 1),
('2014_08_01_150819_groups', 1),
('2014_08_01_150834_checklists', 1),
('2014_08_01_150845_items', 1),
('2014_08_02_140512_checklist_users', 1),
('2014_08_02_140526_checklist_user_items', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `token` varchar(255) COLLATE utf8_bin NOT NULL,
  `group` int(11) NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `token`, `group`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Organisateur', 'Meaweb', 'organisateur@meaweb.com', '$2y$10$wRZf2MeVLEK/oidvN6emXevw.HIAJr3LwezccLLjaPF1qblM9WKfW', '', 1, 'r4rsFIJO4y8Pbv9R3a7sr4oh70sthNvSsL1Y0zDwk46iCAMG8HuE5KhU84SO', '2014-08-06 04:58:30', '2015-05-08 06:16:26'),
(2, 'Visiteur', 'Meaweb', 'visiteur@meaweb.com', '$2y$10$82oPfY4Hbw0tSo9Gqx440eLN1.pGlD03Q9OoWW8brtJdU073qrA1W', '', 0, '2qDLQwWWB4vegskcIS9kyqcbcALuRt6gS4l7k1dszrtgbs2GZdXXazx03pvF', '2014-08-06 04:58:30', '2015-05-08 06:15:55');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `checklist_users`
--
ALTER TABLE `checklist_users`
  ADD CONSTRAINT `checklist_users_checklist_id_foreign` FOREIGN KEY (`checklist_id`) REFERENCES `checklists` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `checklist_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `checklist_user_items`
--
ALTER TABLE `checklist_user_items`
  ADD CONSTRAINT `checklist_user_items_checklist_users_id_foreign` FOREIGN KEY (`checklist_users_id`) REFERENCES `checklist_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `checklist_user_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_checklist_id_foreign` FOREIGN KEY (`checklist_id`) REFERENCES `checklists` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
