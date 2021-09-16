-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 17 juin 2021 à 09:19
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `swap`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `filtre catégorie`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `filtre catégorie` ()  SELECT annonce.*,pseudo AS membre,categorie.titre AS categorie FROM annonce  
LEFT JOIN membre ON membre.id_membre = annonce.membre_id
LEFT JOIN categorie ON categorie.id_categorie = annonce.categorie_id 
WHERE `categorie`.`titre` LIKE '%%'
ORDER BY annonce.id_annonce$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
CREATE TABLE IF NOT EXISTS `annonce` (
  `id_annonce` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description_courte` varchar(255) NOT NULL,
  `description_longue` text NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `region` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ville` varchar(255) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` int(5) UNSIGNED ZEROFILL NOT NULL,
  `membre_id` int DEFAULT NULL,
  `photo_id` int DEFAULT NULL,
  `categorie_id` int DEFAULT NULL,
  `date_enregistrement` datetime NOT NULL,
  PRIMARY KEY (`id_annonce`),
  KEY `membre_id` (`membre_id`),
  KEY `photo_id` (`photo_id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id_annonce`, `titre`, `description_courte`, `description_longue`, `prix`, `photo`, `region`, `ville`, `adresse`, `cp`, `membre_id`, `photo_id`, `categorie_id`, `date_enregistrement`) VALUES
(1, 'A', 'D', '', '0', '', 'Ile-de-France', '', '', 00000, 18, NULL, 11, '0000-00-00 00:00:00'),
(2, 'A', 'A', '', '0', '', 'Ile-de-France', '', '', 00000, 15, NULL, 11, '0000-00-00 00:00:00'),
(3, 'A', 'B', '', '0', '', 'Ile-de-France', '', '', 00000, 7, NULL, 11, '0000-00-00 00:00:00'),
(4, 'A', 'B', '', '0', '', 'Grand Est', '', '', 00000, 7, NULL, 11, '0000-00-00 00:00:00'),
(5, 'A', 'B', '', '0', '', 'Normandie', '', '', 00000, 7, NULL, 11, '0000-00-00 00:00:00'),
(6, 'A', 'B', '', '0', '', 'Bretagne', '', '', 00000, 7, NULL, 11, '0000-00-00 00:00:00'),
(7, 'A', 'B', '', '0', '', 'Bretagne', '', '', 00000, 29, NULL, 11, '0000-00-00 00:00:00'),
(8, 'AD', 'BC', '', '0', '', 'Bretagne', '', '', 00000, 7, NULL, 11, '0000-00-00 00:00:00'),
(9, 'AD', 'BC', '', '0', '', 'Nouvelle-Aquitaine', '', '', 00000, 25, NULL, 11, '0000-00-00 00:00:00'),
(10, 'AD', 'BC', '', '0', '', 'Nouvelle-Aquitaine', '', '', 00000, 25, NULL, 11, '0000-00-00 00:00:00'),
(11, 'BC', 'BC', '', '0', '', 'Nouvelle-Aquitaine', '', '', 00000, 25, NULL, 11, '0000-00-00 00:00:00'),
(12, 'A', 'A', 'A', '0', '', 'Nouvelle-Aquitaine', '', '', 00000, 17, NULL, 5, '0000-00-00 00:00:00'),
(13, 'a', 'a', 'a', '1', '', 'Nouvelle-Aquitaine', '', '', 00000, 14, NULL, 5, '0000-00-00 00:00:00'),
(14, 'A', 'A', 'A', '1', '', 'Nouvelle-Aquitaine', '', '', 00000, 29, NULL, 5, '0000-00-00 00:00:00'),
(15, 'A', 'A', 'A', '1', '', 'Nouvelle-Aquitaine', '', '', 00000, 21, NULL, 5, '0000-00-00 00:00:00'),
(16, 'A', 'A', 'A', '1', '', 'Ile-de-France', 'DARNSTADT', '', 00000, 22, NULL, 5, '0000-00-00 00:00:00'),
(17, 'A', 'A', 'A', '3', '', 'Ile-de-France', 'VINCENNES', '', 00000, 30, NULL, 6, '0000-00-00 00:00:00'),
(18, 'A', 'A', 'A', '3', '', 'Ile-de-France', 'VINCENNES', 'A', 00000, 29, NULL, 6, '0000-00-00 00:00:00'),
(19, 'A', 'A', 'A', '3', '', 'Grand Est', 'D', 'A', 00000, 24, NULL, 6, '0000-00-00 00:00:00'),
(20, 'A', 'A', 'A', '3', '', 'Grand Est', 'D', 'A', 02200, 26, NULL, 6, '0000-00-00 00:00:00'),
(21, 'a', 'a', 'a', '1233', '', 'Ile-de-France', 'Malaga', 'A', 02200, 22, NULL, 6, '0000-00-00 00:00:00'),
(22, 'a', 'a', 'a', '1233', '', 'Grand Est', 'Malaga', 'A', 02200, 2, NULL, 8, '0000-00-00 00:00:00'),
(23, 'A', 'A', 'A', '1234', '', 'Ile-de-France', 'PARIS', 'A', 09000, 25, NULL, 5, '0000-00-00 00:00:00'),
(24, 'A', 'A', 'A', '1234', '', 'Ile-de-France', 'PARIS', 'A', 09000, 2, 117, 5, '0000-00-00 00:00:00'),
(25, 'A', 'A', 'A', '1234', '', 'Ile-de-France', 'PARIS', 'A', 09000, 26, 117, 5, '0000-00-00 00:00:00'),
(26, 'A', 'A', 'A', '4', '', 'Bretagne', 'CEDEX', 'A', 09000, 2, 117, 11, '0000-00-00 00:00:00'),
(27, 'A', 'A', 'A', '4', '', 'Bretagne', 'CEDEX', 'A', 09000, 2, 117, 11, '0000-00-00 00:00:00'),
(28, 'A', 'A', 'A', '4', '', 'Provence-Alpes-Côte d\'Azur', 'CEDEX', 'A', 09000, 13, 117, 2, '0000-00-00 00:00:00'),
(29, 'A', 'A', 'A', '4', '', 'Provence-Alpes-Côte d\'Azur', 'CEDEX', 'A', 09000, 16, 117, 3, '0000-00-00 00:00:00'),
(30, 'A', 'A', 'A', '4', '', 'Provence-Alpes-Côte d\'Azur', 'CEDEX', 'A', 09000, 3, 118, 3, '0000-00-00 00:00:00'),
(31, 'A', 'A', 'A', '4', '', 'Provence-Alpes-Côte d\'Azur', 'CEDEX', 'A', 09000, 13, 119, 3, '0000-00-00 00:00:00'),
(32, 'A', 'A', 'A', '4', '', 'Provence-Alpes-Côte d\'Azur', 'CEDEX', 'A', 09000, 3, 120, 3, '0000-00-00 00:00:00'),
(33, 'D', 'D', 'D', '5', '', 'Bretagne', 'CEDEX', 'A', 12000, 2, 121, 2, '0000-00-00 00:00:00'),
(34, 'D', 'D', 'D', '5', '', 'Bretagne', 'CEDEX', 'A', 12000, 2, 122, 2, '2021-06-07 15:51:33'),
(35, 'D', 'D', 'D', '5', '', 'Bretagne', 'CEDEX', 'A', 12000, 2, 123, 2, '2021-06-07 15:51:40'),
(36, 'a', 'a', 'a', '6', '', 'Provence-Alpes-Côte d\'Azur', 'SEINE', 'A', 09000, 2, 124, 2, '2021-06-07 15:53:33'),
(37, 'a', 'a', 'a', '6', '', 'Bretagne', 'SEINE', 'A', 09000, 3, 125, 2, '2021-06-07 15:54:11'),
(38, 'Location Villa Malaga', 'Location de villa en plein cœur de Malaga.', '4 chambres avec salle de bain - 1 salon - 1 salle à manger - 1 piscine et une terrasse', '2000', '', 'Bretagne', 'MALAGA', '1 patio del sol', 09000, 3, 126, 4, '2021-06-07 15:58:45'),
(39, 'Occasion Renault Capture', 'Renault Capture - 3 000 km -état neuf', '', '15000', '', 'Bretagne', 'Paris', '2', 75006, 3, 127, 2, '2021-06-07 16:22:44'),
(40, 'Vends villa Saint-Denis', '3 suites parentales  - 2 chambres - sauna - hammam\r\n3 garages - 1 terrasse', '', '200000', '', 'Ile-de-France', 'SAINT-DENIS', '1', 93200, 28, 129, 3, '2021-06-07 16:57:11'),
(41, 'A', 'A', 'A', '2', 'photo1_07_06_2021_17_26maducati.jpg', 'Bretagne', 'E', 'A', 09000, 2, 132, 1, '2021-06-07 17:26:31'),
(43, 'location villa Grèces - Bouzikhi', '&amp;quot;Helios&amp;quot;, villa 4 pièces 126 m2. Spacieux et clair, aménagement confortable et moderne: 1 chambre double avec 1 lit double', '1 chambre avec 1 lit et TV (satellite) (écran plat). Séjour ouvert avec TV (satellite) (écran plat). Sortie sur la terrasse, sur la piscine. Cuisine ouverte (four, lave-vaisselle, 4 plaques vitrocéramique, grille-pain, bouilloire électrique, four micro-ondes, cafetière électrique, Capsules pour machine à café (Nespresso) (NON INCLUSES)) avec table pour les repas. Douche/WC. Air-conditionné. Terrasse. Très belle vue panoramique sur la mer et la baie. A disposition: lave-linge, coffre-fort, fer à repasser, sèche-cheveux. Internet (Connexion WIFI, gratuit). Veuillez noter: adapté(e) aux familles. Maison non-fumeur.', '9491', 'photo1_60c1d48bd0da4GRECE1.jpg', 'Ile-de-France', 'BOUZIKHI', 'Demandez  lors de la commande', 00000, 4, 134, 4, '2021-06-10 10:59:55'),
(44, 'Location Toscane', '&amp;quot;Casale il Poggino&amp;quot;, maison 10 pièces 314 m2 sur 2 niveaux. Aménagement confortable et plaisant: séjour ouvert avec cheminée et TV (satellite).', '2 chambres doubles. Cuisine ouverte (4 plaques de cuisson, four, lave-vaisselle, congélateur). 4 douches/bidet/WC. À l\'étage supérieur: séjour ouvert avec cheminée et TV (satellite). 2 chambres doubles. Cuisine ouverte (4 plaques de cuisson, four, lave-vaisselle, congélateur). 2 douches/bidet/WC. Chauffage au gaz (en sus). Possibilité de chauffage uniquement du 01.11. au 15.04. Meubles de terrasse, barbecue. Très belle vue sur les alentours. A disposition: lave-linge, chaise haute pour enfant, lit bébé. Internet (Connexion WIFI, gratuit). 1 animal/ chien autorisé.', '3600', 'photo1_60c1d534a7142Toscane5.jpg', 'Auvergne-Rhône-Alpes', 'Poggino', 'fourni à la commande', 09000, 26, 135, 4, '2021-06-10 11:02:44'),
(45, 'Vacances en Espagne', 'Villa 8 pièces 795 m2. Aménagement très luxueux et de bon goût: entrée. À l\'étage supérieur: salle de jeux. 2ème étage:', '1 chambre avec Dressing avec 1 grand-lit (150 cm, longueur 200 cm), bain/WC. Sortie sur le balcon. 1 chambre avec 2 lits (90 cm, longueur 200 cm), douche/WC. Sortie sur le balcon. 1 chambre avec 1 grand-lit (150 cm, longueur 200 cm), douche/WC et double vasque. Sortie sur le balcon. 1 grande chambre avec Dressing avec 1 grand-lit (150 cm, longueur 200 cm), WC séparés et balnéo. Sortie sur la terrasse. 3ème étage: séjour/salle à manger avec TV (satellite) (écran plat). Sortie sur le balcon, sur la piscine. 1 grande chambre avec 1 grand-lit (150 cm, longueur 200 cm), bain/douche/WC.', '11289', 'photo1_60c275995c9e4sargaigne2.jpg', 'Normandie', 'Rouen', '', 00000, 2, 136, 4, '2021-06-10 22:27:05'),
(46, 'Vente Appartement 3 pièces Bordeaux', 'Appartement  4 pièces dans une résidence très bien entretenue, sécurisée avec gardien.', 'Situé à deux pas de l\'Eglise Saint Seurin, ce bien ce trouve à proximité des commerces, écoles privées et publiques du quartier, mais aussi à quelques minutes à pied des bus et trams. Idéal pour une famille, vous découvrirez une vaste entrée desservant un espace de vie de plus de 45m2 avec cuisine ouverte, très lumineux de par ses fenètres et baies vitrées sur 3 cotés. Un balcon d\'angle vous permettra de profiter du soleil tout au long de la journée. L\'espace nuit, quant à lui se compose de 4 grandes chambres, dont une suite parentale avec dressing et salle d\'eau, une chambre avec balcon, une', '599550', 'photo1_60c27e63da9a0Picture3.jpg', 'Nouvelle-Aquitaine', 'Bordeaux', 'Sur prise de rendez-vous', 33000, 28, 137, 3, '2021-06-10 23:04:35'),
(47, 'Vente de standing à Paris', 'Dans une résidence de Standing très recherchée 4 pièces', 'vous découvrirez cet appartement au 2ème étage, traversant.\r\nIl se compose d\'une entrée donnant sur un salon salle à manger avec un balcon exposé SUD/EST et sa cuisine séparée équipée, l\'ensemble donnant sur le jardin intérieur de la résidence. La partie nuit se compose de 3 chambres dont une suite parentale avec sa salle de bains privative, ainsi qu\'une autre salle de bains. L\'ensemble est en bon état. Une place de stationnement et un cellier complète ce bien. A visiter sans tarder.', '1577500', 'photo1_60c280dc07039image1.jpg', 'Ile-de-France', 'Paris 7e Arrondissement', 'Rue du Bac', 75007, 28, 138, 3, '2021-06-10 23:15:08'),
(48, 'Maison Landaise à Hossegor', 'Le charme opère dès l\'entrée dans cette maison familiale, idéalement située.', 'Au rez-de-chaussée se trouvent ; une cuisine conviviale et chaleureuse puis une belle pièce de vie lumineuse sur jardin avec piscine, sans vis-à-vis exposée sud. A l\'étage vous découvrirez 4 chambres aux beaux volumes et deux salles d\'eau. Le charme de l\'ancien a été conservé avec de très belles prestations (moulures, parquet, cheminées). Un garage, une buanderie et un espace \'cave à vin\' viennent compléter les atouts de cette propriété.', '2548000', 'photo1_60c283c7b6fadmaison-villa-bordeaux-33000-1623295338.jpg', 'Nouvelle-Aquitaine', 'Soorts-Hossegor', 'Visite les WE', 40150, 3, 139, 3, '2021-06-10 23:27:35'),
(49, 'Location Chalet Megève', 'Maison familiale dans un quartier vivant avec un beau jardin et DEUX GARAGES.', 'Cette maison est composée d’un salon-séjour traversant et lumineux d’environ 55m2 avec une cuisine américaine équipée. Cet espace de vie s’ouvre sur une terrasse avec vue sur le jardin. Au même niveau une chambre et une salle de bains.\r\nA l’étage un palier dessert deux belles chambres lumineuses, une salle de bains ainsi qu’une grande pièce traversante. Celle-ci peut facilement être divisée en deux chambres ou accueillir selon vos envies une salle de jeux, un dressing, un home cinéma, ici laissez libre court à vos projets ! Dans ce lieu aux beaux volumes règne une atmosphère agréable.\r\nLe jardin', '2840000', 'photo1_60c284e513ea5avoriaz1.jpg', 'Auvergne-Rhône-Alpes', 'Megève', 'All de la Grande Fontaine', 74120, 3, 140, 3, '2021-06-10 23:32:21'),
(50, 'Parking', 'Place de parking', '', '22490', '', 'Ile-de-France', 'Saint-Denis', 'Visite possible', 93200, 16, 141, 3, '2021-06-10 23:36:15'),
(51, 'Chalet de vacances Courchevel', 'Magnifique Chalet 6 suites parental -Sauna - salle de fitness - 2 salons et salle de projection et salle de jeux', '', '2450940', 'photo1_60c284e513ea5avoriaz1.jpg', 'Auvergne-Rhône-Alpes', 'Courchevel', 'Imp Cote Chalets', 73120, 2, 141, 4, '2021-06-10 23:43:34'),
(52, 'Vends Moto Ducati', '1300 cc - vitesse de 340 km/h - 12000 km au compteur - à jour des révision', '', '7600', 'photo1_07_06_2021_17_26maducati.jpg', 'Provence-Alpes-Côte d\'Azur', 'Marseille 13e Arrondissement', 'Avenue des Clematites', 13013, 13, 141, 2, '2021-06-10 23:48:46'),
(53, 'Vends Renault Capture', '4000 km vrai occasion à saisir', '', '18000', 'photo1_60c289e72f825annonce_photo1_photo_bienvenu2_sm.jpg', 'Grand Est', 'Roubaix', '?', 59100, 18, 141, 2, '2021-06-10 23:53:43'),
(54, 'Mercedes XYLS - Préparation BMG', 'superbe voiture de collection', '', '65000', 'photo1_60c28b203e31a736964.jpg', 'Bretagne', 'Roscoff', '', 29680, 24, 142, 2, '2021-06-10 23:58:56'),
(55, 'Vends Peugeot 3008', '240000 km 1 ere main jamais servis qu\'à 2 taxis et 1 go fast - passé au marbre 3 fois', '', '24000', 'photo1_60c28c902cef6peugeot-3008-bleu-15.jpg', 'Ile-de-France', 'Trappes', 'Cite Jacques Boubas', 78190, 15, 143, 2, '2021-06-11 00:05:04');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `motscles` text NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `titre`, `motscles`) VALUES
(1, 'Emploi', 'Offres d\'emploi, offres de stage, offres de contrat en alternance'),
(2, 'Auto/Moto/Mobilité', 'Vente occasion - Autos - Motos - Bateaux - Vélos - Equipements'),
(3, 'Immobilier', 'Ventes - Locations - Colocations -  Bureaux - appartements - Maisons - Parkings'),
(4, 'Vacances', 'Camping - Hôtel - Chambre d\'Hôtes - Camping-car'),
(5, 'Multimédia', 'Jeux vidéo - Informatique - Image - Son - Téléphone - Objet connecté'),
(6, 'Loisirs', 'Films - Musiques - Livres'),
(7, 'Matériel', 'Outillage - Fourniture de bureau - Matériel agricole'),
(8, 'Services', 'Prestations de services - Evénements ...'),
(9, 'Maison', 'Ameublement - Electroménager - Bricolage - Jardinage ...'),
(10, 'Vêtements', 'Denim - Chemises - Robe - Chaussures -Accessoires'),
(11, 'Divers', '...');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id_commentaire` int NOT NULL AUTO_INCREMENT,
  `membre_id` int DEFAULT NULL,
  `annonce_id` int DEFAULT NULL,
  `commentaire` text NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  PRIMARY KEY (`id_commentaire`),
  KEY `membre_id` (`membre_id`),
  KEY `annonce_id` (`annonce_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id_membre` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('m','f') NOT NULL,
  `statut` int NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  UNIQUE KEY `id_membre` (`id_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `telephone`, `email`, `civilite`, `statut`, `date_enregistrement`) VALUES
(2, 'admin', '$2y$10$fnEJDJeNWXONRARf/6Z.Ru5DtLzqZ3uuMPUxkZdyEUpqjFwX8Ntwm', 'admin', 'admin', '0101010101', 'JF@mail.com', 'm', 1, '2021-05-30 22:28:19'),
(3, 'steps', '$2y$10$kl7BUODzlVJzThSYGOwFreL8Ey5vFWfjWpHL6aWZaPjzqRyjoXKea', 'Séverine', 'G', '0101010101', 'sev@mail.com', 'm', 0, '2021-05-30 22:29:40'),
(4, 'jfl', '$2y$10$yrqnBVdN9DmzdsUIyU/xM.ZxdJARz6uOK1EhwLWIygLtsnq15X5TC', 'jean-françois', 'LEPANTE', '0101010101', 'JF@mail.com', 'm', 0, '2021-05-31 12:12:20'),
(7, 'anonyme2', '$2y$10$wyiyGiSATJ.Op9IVN/C3AOioDa8kGicNrQPomAKFBN3nyCCj4JQkW', 'Jean', 'Dupond', '0101010101', 'jean@mail.com', 'm', 0, '2021-05-31 14:14:30'),
(8, 'anonyme3', '$2y$10$S9oJ2fHjaFSIOa9/iW1jleuewkVS1AzEB5sPpwR2izQuLYPiTAbXu', 'Jeanne', 'Durand', '0101010101', 'jeanne@mail.com', 'f', 0, '2021-05-31 14:15:37'),
(9, 'anonyme', '$2y$10$r06bc2q/016Z0SdanPA9TeVsDKRSQvDIc8PAlmsDBugoBNvZfQb4u', 'jane', 'DOE', '0101010101', 'jane@mail.com', 'f', 0, '2021-05-31 21:40:27'),
(11, 'WolfFrench          ', 'Aaaaaaa0', 'Laborde', 'Jean-pierre', '0101010101', 'email@mail.fr', 'm', 0, '2021-06-09 14:14:15'),
(12, 'NightGt             ', 'Aaaaaaa0', 'Gallet', 'Clement', '0101010101', 'email@mail.fr', 'm', 0, '2021-06-09 14:14:15'),
(13, 'BraveLotus          ', 'Aaaaaaa0', 'Winter', 'Thomas', '0101010101', 'email@mail.fr', 'm', 0, '2021-06-09 14:14:15'),
(14, 'CookieChocolatine   ', 'Aaaaaaa0', 'Dubar', 'Chloe', '0101010101', 'email@mail.fr', 'f', 0, '2021-06-09 14:14:15'),
(15, 'GhostPepito         ', 'Aaaaaaa0', 'Fellier', 'Elodie', '0101010101', 'email@mail.fr', 'f', 0, '2021-06-09 14:14:15'),
(16, 'DinoLegend          ', 'Aaaaaaa0', 'Grand', 'Fabrice', '0101010101', 'email@mail.fr', 'm', 0, '2021-06-09 14:14:15'),
(17, 'BlackFrench         ', 'Aaaaaaa0', 'Collier', 'Melanie', '0101010101', 'email@mail.fr', 'f', 0, '2021-06-09 14:14:15'),
(18, 'OscarDocteur        ', 'Aaaaaaa0', 'Blanchet', 'Laura', '0101010101', 'email@mail.fr', 'f', 0, '2021-06-09 14:14:15'),
(19, 'PortePoney          ', 'Aaaaaaa0', 'Miller', 'Guillaume', '0101010101', 'email@mail.fr', 'm', 0, '2021-06-09 14:14:15'),
(20, 'JustToto            ', 'Aaaaaaa0', 'Perrin', 'Celine', '0101010101', 'email@mail.fr', 'f', 0, '2021-06-09 14:14:15'),
(21, 'ViperTruck          ', 'Aaaaaaa0', 'Cottet', 'Julien', '0101010101', 'email@mail.fr', 'm', 0, '2021-06-09 14:14:15'),
(22, 'SteelWhite          ', 'Aaaaaaa0', 'Vignal', 'Mathieu', '0101010101', 'email@mail.fr', 'm', 0, '2021-06-09 14:14:15'),
(23, 'HyperRussian        ', 'Aaaaaaa0', 'Desprez', 'Thierry', '0101010101', 'email@mail.fr', 'm', 0, '2021-06-09 14:14:15'),
(24, 'OxygèneX            ', 'Aaaaaaa0', 'Thoyer', 'Amandine', '0101010101', 'email@mail.fr', 'f', 0, '2021-06-09 14:14:15'),
(25, 'FlyingStorm         ', 'Aaaaaaa0', 'Durand', 'Damien', '0101010101', 'email@mail.fr', 'm', 0, '2021-06-09 14:14:15'),
(26, 'PorteWait           ', 'Aaaaaaa0', 'Chevel', 'Daniel', '0101010101', 'email@mail.fr', 'm', 0, '2021-06-09 14:14:15'),
(27, 'FishSunshine        ', 'Aaaaaaa0', 'Martin', 'Nathalie', '0101010101', 'email@mail.fr', 'f', 0, '2021-06-09 14:14:15'),
(28, 'DogFlying           ', 'Aaaaaaa0', 'Lagarde', 'Benoit', '0101010101', 'email@mail.fr', 'm', 0, '2021-06-09 14:14:15'),
(29, 'FreestyleCaptain    ', 'Aaaaaaa0', 'Sennard', 'Emilie', '0101010101', 'email@mail.fr', 'f', 0, '2021-06-09 14:14:15'),
(30, 'TruckDrake          ', 'Aaaaaaa0', 'Lafaye', 'Stephanie', '0101010101', 'email@mail.fr', 'f', 0, '2021-06-09 14:14:15');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id_note` int NOT NULL AUTO_INCREMENT,
  `membre_id1` int DEFAULT NULL,
  `membre_id2` int DEFAULT NULL,
  `note` int NOT NULL,
  `avis` text NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  PRIMARY KEY (`id_note`),
  KEY `membre_id1` (`membre_id1`),
  KEY `membre_id2` (`membre_id2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id_photo` int NOT NULL AUTO_INCREMENT,
  `photo1` varchar(255) NOT NULL,
  `photo2` varchar(255) NOT NULL,
  `photo3` varchar(255) NOT NULL,
  `photo4` varchar(255) NOT NULL,
  `photo5` varchar(255) NOT NULL,
  PRIMARY KEY (`id_photo`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id_photo`, `photo1`, `photo2`, `photo3`, `photo4`, `photo5`) VALUES
(95, 'annonce_photo1villa_alicante.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(96, 'annonce_photo110900.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(97, 'annonce_photo110900.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(98, 'annonce_photo1118367.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(99, 'annonce_photo1118367.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(100, 'annonce_photo1118367.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(101, 'annonce_photo1118367.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(102, 'annonce_photo1118367.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(103, 'annonce_photo1118367.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(104, 'annonce_photo1118367.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(105, 'annonce_photo1118367.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(106, 'annonce_photo1118367.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(107, 'annonce_photo1118367.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(108, 'annonce_photo1118367.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(109, 'annonce_photo1118367.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(110, 'annonce_photo110900.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(111, 'annonce_photo110900.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(112, 'annonce_photo1angel-heart-1.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(113, 'annonce_photo110900.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(114, 'annonce_photo110900.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(115, 'annonce_photo110900.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(116, 'annonce_photo1l12722-relativity-impossible-stairs-5484.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(117, 'annonce_photo1l12722-relativity-impossible-stairs-5484.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(118, 'annonce_photo1fb-les-saintes.1535288.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(119, 'annonce_photo1fb-les-saintes.1535288.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(120, 'annonce_photo1fb-les-saintes.1535288.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(121, 'annonce_photo1fb-les-saintes.1535288.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(122, 'annonce_photo1la-desirade-guadeloupe-plage-a-fanfan-8.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(123, 'annonce_photo1la-desirade-guadeloupe-plage-a-fanfan-8.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(124, 'annonce_photo1la-desirade-guadeloupe-plage-a-fanfan-8.jpg', 'annonce_photo2.', 'annonce_photo3.', 'annonce_photo4.', 'annonce_photo5.'),
(125, 'annonce_photo1_Taj-Mahal-in-Indien-iStock-155096944.jpg', 'annonce_photo2_.', 'annonce_photo3_.', 'annonce_photo4_.', 'annonce_photo5_.'),
(126, 'annonce_photo1_Taj-Mahal-in-Indien-iStock-155096944.jpg', 'annonce_photo2_.', 'annonce_photo3_.', 'annonce_photo4_.', 'annonce_photo5_.'),
(127, 'annonce_photo1_Taj-Mahal-in-Indien-iStock-155096944.jpg', 'annonce_photo2_.', 'annonce_photo3_.', 'annonce_photo4_.', 'annonce_photo5_.'),
(128, 'annonce_photo1_photo_bienvenu2_sm.jpg', 'annonce_photo2_.', 'annonce_photo3_.', 'annonce_photo4_.', 'annonce_photo5_.'),
(129, 'photo1_07/06/2021 à 16:53:49photo_bienvenu4_sm.jpg', 'photo2_07/06/2021 à 16:53:49.', 'photo3_07/06/2021 à 16:53:49.', 'photo4_07/06/2021 à 16:53:49.', 'photo5_07/06/2021 à 16:53:49.'),
(130, 'photo1_07/06/2021 à 16:57:11photo_bienvenu4_sm.jpg', 'photo2_07/06/2021 à 16:57:11.', 'photo3_07/06/2021 à 16:57:11.', 'photo4_07/06/2021 à 16:57:11.', 'photo5_07/06/2021 à 16:57:11.'),
(131, 'photo1_07_06_2021_17_07maducati.jpg', 'photo2_07_06_2021_17_07.', 'photo3_07_06_2021_17_07.', 'photo4_07_06_2021_17_07.', 'photo5_07_06_2021_17_07.'),
(132, 'photo1_07_06_2021_17_14maducati.jpg', 'photo2_07_06_2021_17_14.', 'photo3_07_06_2021_17_14.', 'photo4_07_06_2021_17_14.', 'photo5_07_06_2021_17_14.'),
(133, 'photo1_07_06_2021_17_26maducati.jpg', 'photo2_07_06_2021_17_26.', 'photo3_07_06_2021_17_26.', 'photo4_07_06_2021_17_26.', 'photo5_07_06_2021_17_26.'),
(134, 'photo1_10_06_2021_10_30GRECE1.jpg', 'photo2_10_06_2021_10_30GRECE2.jpg', 'photo3_10_06_2021_10_30GRECE3.jpg', 'photo4_10_06_2021_10_30GRECE4.jpg', 'photo5_10_06_2021_10_30GRECE5.jpg'),
(135, 'photo1_60c1d48bd0da4GRECE1.jpg', 'photo2_60c1d48bd0db2GRECE2.jpg', 'photo3_60c1d48bd0db9GRECE3.jpg', 'photo4_60c1d48bd0dc0GRECE4.jpg', 'photo5_60c1d48bd0dc6GRECE5.jpg'),
(136, 'photo1_60c1d534a7142Toscane5.jpg', 'photo2_60c1d534a714ephoto1.jpg', 'photo3_60c1d534a7155Toscane2.jpg', 'photo4_60c1d534a715bToscane3.jpg', 'photo5_60c1d534a7162Toscane4.jpg'),
(137, 'photo1_60c275995c9e4sargaigne2.jpg', 'photo2_60c275995c9f3sargaigne.jpg', 'photo3_60c275995c9fbsargaigne3.jpg', 'photo4_60c275995ca02sargaigne4.jpg', 'photo5_60c275995ca0asargaigne5.jpg'),
(138, 'photo1_60c27e63da9a0Picture3.jpg', 'photo2_60c27e63da9b0Picture2.jpg', 'photo3_60c27e63da9b9Picture4.jpg', 'photo4_60c27e63da9c1.', 'photo5_60c27e63da9c6.'),
(139, 'photo1_60c280dc07039image1.jpg', 'photo2_60c280dc07044image2.jpg', 'photo3_60c280dc0704aimage3.jpg', 'photo4_60c280dc07050image4.jpg', 'photo5_60c280dc07056image5.jpg'),
(140, 'photo1_60c283c7b6fadmaison-villa-bordeaux-33000-1623295338.jpg', 'photo2_60c283c7b6fbdmaison-villa-bordeaux-33000-1623295338 (1).jpg', 'photo3_60c283c7b6fc9maison-villa-bordeaux-33000-1623295338 (2).jpg', 'photo4_60c283c7b6fd4maison-villa-bordeaux-33000-1623295338 (3).jpg', 'photo5_60c283c7b6fe0maison-villa-bordeaux-33000-1623295339.jpg'),
(141, 'photo1_60c284e513ea5avoriaz1.jpg', 'photo2_60c284e513eb2avoriaz2.jpg', 'photo3_60c284e513eb9avoriaz3.jpg', 'photo4_60c284e513ec0avoriaz4.jpg', 'photo5_60c284e513ec6avoriaz5.jpg'),
(142, 'photo1_60c289e72f825annonce_photo1_photo_bienvenu2_sm.jpg', 'photo2_60c289e72f846.', 'photo3_60c289e72f850.', 'photo4_60c289e72f859.', 'photo5_60c289e72f862.'),
(143, 'photo1_60c28b203e31a736964.jpg', 'photo2_60c28b203e326.', 'photo3_60c28b203e32b.', 'photo4_60c28b203e330.', 'photo5_60c28b203e335.'),
(144, 'photo1_60c28c902cef6peugeot-3008-bleu-15.jpg', 'photo2_60c28c902cf08peugeot-3008-bleu-3.jpg', 'photo3_60c28c902cf13peugeot-3008-bleu-5.jpg', 'photo4_60c28c902cf1cpeugeot-3008-bleu-8.jpg', 'photo5_60c28c902cf26peugeot-3008-bleu-15.jpg');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `annonce_ibfk_1` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id_membre`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `annonce_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `annonce_ibfk_3` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id_photo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id_membre`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`membre_id1`) REFERENCES `membre` (`id_membre`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `note_ibfk_2` FOREIGN KEY (`membre_id2`) REFERENCES `membre` (`id_membre`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
