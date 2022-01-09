-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 06 jan. 2022 à 19:44
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_tutore_lambert_giron`
--

-- --------------------------------------------------------

--
-- Structure de la table `answer`
--

CREATE TABLE `answer` (
  `id_answer` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `valid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `answer`
--

INSERT INTO `answer` (`id_answer`, `id_question`, `label`, `valid`) VALUES
(1, 1, '1er', 0),
(2, 1, '2eme', 1),
(3, 1, '3eme', 0),
(4, 2, 'Blanc', 1),
(5, 2, 'Gris', 0),
(6, 2, 'Noir', 0),
(7, 3, '0.5 minute', 0),
(8, 3, '1 minute', 1),
(9, 3, '2 minutes', 0),
(10, 4, '3', 0),
(11, 4, '4', 0),
(12, 4, '5', 1),
(13, 5, '1 kg de plumes', 0),
(14, 5, '1 kg de plomb', 0),
(15, 5, 'C\'est la même chose', 1),
(16, 6, 'Rio de Janeiro', 0),
(17, 6, 'Brasilia', 1),
(18, 6, 'Sao Paulo', 0),
(19, 7, 'Apollo 6', 0),
(20, 7, 'Apollo 9', 0),
(21, 7, 'Apollo 11', 1),
(22, 8, 'Tom Hanks', 1),
(23, 8, 'Mark Harmon', 0),
(24, 8, 'Harrison Ford', 0),
(25, 9, 'Hiver', 0),
(26, 9, 'Printemps', 0),
(27, 9, 'Été', 1),
(28, 10, 'Azkaban', 0),
(29, 10, 'Poudlard', 1),
(30, 10, 'Nurmengard', 0),
(31, 11, '1959', 0),
(32, 11, '1961', 0),
(33, 11, '1963', 1),
(34, 12, 'Antoine Lavoisier', 1),
(35, 12, 'Jean-Paul Sartre', 0),
(36, 12, 'Jean-Jacques Rousseau', 0),
(37, 13, '38.195 km', 0),
(38, 13, '40.195 km', 0),
(39, 13, '42.195 km', 1),
(40, 14, 'Nicolas Sarkozy', 0),
(41, 14, 'François Hollande', 1),
(42, 14, 'Emmanuel Macron', 0),
(43, 15, 'Mary Pierce ', 1),
(44, 15, 'Richard Gasquet', 0),
(45, 15, 'Jo Wilfried Tsonga', 0),
(46, 16, 'Paris', 0),
(47, 16, 'Bruxelles', 0),
(48, 16, 'Strasbourg', 1),
(49, 17, '4808 m', 1),
(50, 17, '4924 m', 0),
(51, 17, '5012 m', 0),
(52, 18, 'La Station', 0),
(53, 18, 'L\'Arche', 1),
(54, 18, 'L\'Odyssey', 0),
(55, 19, 'Mars', 0),
(56, 19, 'Vénus', 0),
(57, 19, 'Mercure', 1),
(58, 20, 'Pixar', 1),
(59, 20, 'DreamWorks', 0),
(60, 20, 'Marvel', 0),
(61, 21, 'Montgomery', 0),
(62, 21, 'Sacramento', 1),
(63, 21, 'Columbus', 0),
(64, 21, 'Cleveland', 0),
(65, 22, '1946', 0),
(66, 22, '1950', 0),
(67, 22, '1955', 1),
(68, 22, '1961', 0),
(69, 23, 'Le thé', 0),
(70, 23, 'Le café', 0),
(71, 23, 'Le cola', 0),
(72, 23, 'Le tonic', 1),
(73, 24, '1988', 0),
(74, 24, '1993', 1),
(75, 24, '1998', 0),
(76, 24, '2003', 0),
(77, 25, 'Victoria', 1),
(78, 25, 'De Quincey', 0),
(79, 25, 'Belombre', 0),
(80, 25, 'Cascade', 0),
(81, 26, '1908', 0),
(82, 26, '1909', 0),
(83, 26, '1910', 0),
(84, 26, '1911', 0),
(85, 26, '1912', 1),
(86, 27, '1430', 0),
(87, 27, '1530', 1),
(88, 27, '1630', 0),
(89, 27, '1730', 0),
(90, 27, '1830', 0),
(91, 28, 'Un diplomate', 0),
(92, 28, 'Un acteur', 0),
(93, 28, 'Un chanteur', 0),
(94, 28, 'Un écrivain', 1),
(95, 28, 'Un développeur', 0),
(96, 29, '1933', 0),
(97, 29, '1940', 0),
(98, 29, '1947', 1),
(99, 29, '1954', 0),
(100, 29, '1961', 0),
(101, 30, 'Neil Armstrong', 0),
(102, 30, 'Sergueï Krikaliov', 0),
(103, 30, 'Buzz Aldrin', 0),
(104, 30, 'Youri Gagarine', 0),
(105, 30, 'Alexeï Leonov', 1),
(106, 31, 'Paris', 1),
(107, 32, 'Espagne', 1),
(108, 33, 'Printemps', 1),
(109, 34, 'Staline', 1),
(110, 35, 'César', 1),
(111, 36, 'Allemagne', 1),
(112, 37, 'Bob Marley', 1),
(113, 38, 'Arès', 1),
(114, 39, 'Un chien', 1),
(115, 40, 'Pedro Almodovar', 1),
(116, 41, 'Vérone', 1),
(117, 42, '476 après JC', 1),
(118, 43, 'Une marâtre', 1),
(119, 44, '16', 1),
(120, 45, 'La gravitation universelle', 1),
(121, 46, 'Wong Kar Wai', 1),
(122, 47, 'Salzbourg', 1),
(123, 48, 'Le néoplatonisme', 1),
(124, 49, '21', 0),
(125, 49, '19', 0),
(126, 49, '17', 1),
(127, 50, 'Tokyo', 1),
(128, 50, 'Hiroshima', 0),
(129, 50, 'Nagasaki', 0),
(130, 51, '1779', 0),
(131, 51, '1789', 1),
(132, 51, '1804', 0),
(133, 52, 'Wii', 0),
(134, 52, 'Game Boy', 0),
(135, 52, 'PlayStation 2', 1),
(136, 53, 'Une moto rouge', 1),
(137, 53, 'Une voiture bleue', 0),
(138, 53, 'Une épée verte', 0),
(139, 54, 'L\'Ohio', 0),
(140, 54, 'La Californie', 0),
(141, 54, 'L Alabama', 1),
(142, 55, 'Une chèvre', 0),
(143, 55, 'Un rat', 0),
(144, 55, 'Une mouche', 1),
(145, 56, 'Un raisonnement', 0),
(146, 56, 'Un manuscrit', 1),
(147, 56, 'Un farceur', 0),
(148, 57, 'Un compositeur', 1),
(149, 57, 'Un chef d orchestre', 0),
(150, 57, 'Un pianiste', 0),
(151, 57, 'Un chanteur', 0),
(152, 58, 'Un félin', 0),
(153, 58, 'Un oiseau', 1),
(154, 58, 'Un poisson', 0),
(155, 58, 'Un canidé', 0),
(156, 59, 'Edmund Husserl', 0),
(157, 59, 'Henri Bergson', 0),
(158, 59, 'Hannah Arendt', 1),
(159, 59, 'Quentin Skinner', 0),
(160, 59, 'John Dewey', 0),
(161, 60, '1264 - 1342', 0),
(162, 60, '1364 - 1442', 0),
(163, 60, '1464 - 1542', 0),
(164, 60, '1564 - 1642', 1),
(165, 60, '1664 - 1742', 0),
(166, 31, 'Metz', 0),
(167, 31, 'Marseille', 0),
(168, 32, 'Portugal', 0),
(169, 32, 'Italie', 0),
(170, 33, 'Automne', 0),
(171, 33, 'Eté', 0),
(172, 34, 'Lenine', 0),
(173, 34, 'Palpatine', 0),
(174, 35, 'Napoléon ', 0),
(175, 35, 'Vercingétorix', 0),
(176, 36, 'Argentine', 0),
(177, 36, 'Brésil', 0),
(178, 37, 'Snoop Dogg', 0),
(179, 37, 'Dr Dre', 0),
(180, 38, 'Hermès', 0),
(181, 38, 'Artémis', 0),
(182, 39, 'Un chat', 0),
(183, 39, 'Un rongeur', 0),
(184, 40, 'Jacques Audiard', 0),
(185, 40, 'Roman Polanski', 0),
(186, 41, 'Rome', 0),
(187, 41, 'Venise', 0),
(188, 42, '112 avant JC', 0),
(189, 42, '618 après JC', 0),
(190, 43, 'Une cacochyme', 0),
(191, 43, 'Une grigne', 0),
(192, 43, 'Une moujingue', 0),
(193, 44, '18', 0),
(194, 44, '12', 0),
(195, 44, '14', 0),
(196, 45, 'L\'anthropologie clinique', 0),
(197, 45, 'L\'Evolution', 0),
(198, 45, 'La transférogenèse', 0),
(199, 46, 'Hirokazu Kore Eda', 0),
(200, 46, 'Takeshi Kitano', 0),
(201, 46, 'Hayao Miyazaki', 0),
(202, 46, 'Satoshi Kon', 0),
(203, 47, 'Metz', 0),
(204, 47, 'Berlin', 0),
(205, 47, 'Innsbruck', 0),
(206, 47, 'Vienne', 0),
(207, 48, 'L\'empirisme', 0),
(208, 48, 'Le rationalisme', 0),
(209, 48, 'L\'idealisme', 0),
(210, 48, 'Le structuralisme', 0),
(211, 61, 'Nage', 0),
(212, 61, 'Glisse', 1),
(213, 61, 'Flotte', 0),
(214, 62, 'Muleau', 1),
(215, 62, 'Oiseau', 0),
(216, 62, 'Chameau', 0),
(217, 63, 'Circonflexe', 0),
(218, 63, 'Aigu', 0),
(219, 63, 'Grave', 1),
(220, 64, 'Orangeade', 1),
(221, 64, 'Oranjade', 0),
(222, 64, 'Oranchade', 0),
(223, 65, 'Flavien', 1),
(224, 65, 'aime', 0),
(225, 65, 'programmer', 0),
(226, 66, 'Balance', 0),
(227, 66, 'Poincon', 1),
(228, 66, 'Grimace', 0),
(229, 67, 'Marron', 0),
(230, 67, 'Vert', 1),
(231, 67, 'Noir', 0),
(232, 68, 'Moselle', 1),
(233, 68, 'Messins', 0),
(234, 68, 'Français', 0),
(235, 69, 'Le Rhin', 0),
(236, 69, 'La Garonne', 0),
(237, 69, 'La Seine', 1),
(238, 70, 'Soleil', 0),
(239, 70, 'Nuage', 1),
(240, 70, 'Pluie', 0),
(241, 71, 'Turquoise', 0),
(242, 71, 'Noir', 0),
(243, 71, 'Violet', 1),
(244, 72, 'Mammifère', 0),
(245, 72, 'Rongeur', 1),
(246, 72, 'Sauvage', 0),
(247, 73, '2', 0),
(248, 73, '3', 1),
(249, 73, '4', 0),
(250, 74, 'Athènes', 1),
(251, 74, 'Delphes', 0),
(252, 74, 'Héraklion', 0),
(253, 75, 'La loutre', 0),
(254, 75, 'Le castor', 0),
(255, 75, 'L\'ornithorynque\r\n', 1),
(256, 76, 'English', 0),
(257, 76, 'England', 1),
(258, 76, 'United Kingdom', 0),
(259, 77, 'Quotient intellectuel', 1),
(260, 77, 'Quotidien impossible', 0),
(261, 77, 'Question interrogative', 0),
(262, 78, 'Mars', 0),
(263, 78, 'Vénus', 0),
(264, 78, 'Mercure', 1),
(265, 79, 'Côte Est', 0),
(266, 79, 'Côte Ouest', 0),
(267, 79, 'Côte d\'Azur', 1),
(268, 80, '4 millions', 0),
(269, 80, '8 millions', 1),
(270, 80, '11 millions', 0),
(271, 81, 'Los Angeles', 0),
(272, 81, 'Pékin', 0),
(273, 81, 'Shanghai', 1),
(274, 82, 'Jules Ferry', 0),
(275, 82, 'Victor Hugo', 0),
(276, 82, 'Pythagore', 1),
(277, 83, '1885', 1),
(278, 83, '1887', 0),
(279, 83, '1889', 0),
(280, 84, 'Trompette', 0),
(281, 84, 'Guitare', 1),
(282, 84, 'Tuba', 0),
(283, 85, 'En Bretagne', 0),
(284, 85, 'En Midi-Pyrénées', 0),
(285, 85, 'Au Jura', 1),
(286, 86, 'Arcade', 0),
(287, 86, 'Pétale', 1),
(288, 86, 'Lampe', 0),
(289, 87, 'Calambourd', 0),
(290, 87, 'Calembourg', 0),
(291, 87, 'Calambourt', 0),
(292, 87, 'Calembour', 1),
(293, 88, 'En Sardaigne', 0),
(294, 88, 'En Sicile', 1),
(295, 88, 'Au Japon', 0),
(296, 88, 'En Grèce', 0),
(297, 89, '1974', 0),
(298, 89, '1981', 1),
(299, 89, '1986', 0),
(300, 89, '1991', 0),
(301, 90, 'Anakin', 1),
(302, 90, 'Luke', 0),
(303, 90, 'Leia', 0),
(304, 90, 'Padmé', 0),
(305, 91, 'Suisse', 0),
(306, 91, 'Bulgare', 1),
(307, 91, 'Française', 0),
(308, 91, 'Allemand', 0),
(309, 92, 'Rimbaud', 0),
(310, 92, 'Victor Hugo', 0),
(311, 92, 'Corneille', 0),
(312, 92, 'Molière', 1),
(313, 93, 'Une mangouste', 0),
(314, 93, 'Une hyène', 0),
(315, 93, 'Un phacochère', 1),
(316, 93, 'Un sanglier', 0),
(317, 94, 'De Palmas', 1),
(318, 94, 'Paul Personne', 0),
(319, 94, 'Edy Mitchell', 0),
(320, 94, 'Paul Verlaine', 0),
(321, 94, 'Emile Zola', 0),
(322, 95, 'Un animal', 0),
(323, 95, 'Un plat', 0),
(324, 95, 'Un ustensile', 0),
(325, 95, 'Un alcool', 1),
(326, 95, 'Un transport', 0),
(327, 96, 'Un petit rongeur', 0),
(328, 96, 'Un outil de tapissier', 1),
(329, 96, 'Un fruit exotique', 0),
(330, 96, 'Un légume', 0),
(331, 96, 'Un manuscrit', 0),
(332, 97, '22 mars 1945', 0),
(333, 97, '8 mai 1945', 1),
(334, 97, '14 juillet 1945', 0),
(335, 97, '22 aout 1945', 0),
(336, 97, '11 novembre 1945', 0),
(337, 98, 'Une lirhe', 0),
(338, 98, 'Une lyrrhe', 0),
(339, 98, 'Une lirre', 0),
(340, 98, 'Une lyrhe', 0),
(341, 98, 'Une lyre', 1),
(342, 99, 'Vous voyez', 1),
(343, 99, 'Vous verrez', 0),
(344, 99, 'Vous prendrez\r\n', 0),
(345, 99, 'Vous découvrirez', 0),
(346, 99, 'Vous choisirez', 0),
(347, 100, '50 m', 0),
(348, 100, '100 m', 1),
(349, 100, '150 m', 0),
(350, 100, '200 m', 0),
(351, 100, '400 m', 0);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id_question` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id_question`, `label`, `level`) VALUES
(1, 'Tu participes à une course, tu dépasses le deuxième, quelle est ta position dans la course ?', 1),
(2, 'De quelle couleur est le cheval blanc d\'Henri IV ?', 1),
(3, 'Combien y a-t-il de minutes dans 60 secondes ?', 1),
(4, 'Combien y a-t-il de doigts sur une main ?', 1),
(5, 'Qu\'est-ce qui est le plus lourd entre un kg de plumes et un kg de plomb ?', 1),
(6, 'Quelle est la capitale du Brésil ?', 2),
(7, 'Quel était le nom de la mission au cours de laquelle Neil Armstrong a effectué les premiers pas sur la Lune en 1969 ?', 2),
(8, 'Quel acteur a joué le rôle principal dans le film Forrest Gump ?', 2),
(9, 'Quelle est la saison de l\'artichaut ?', 2),
(10, 'Quel est le nom de l’école où se déroulent les aventures d’Harry Potter ?', 2),
(11, 'En quelle année est mort J-F Kennedy ?', 3),
(12, 'Qui a inventé la citation Rien ne se perd, rien ne se crée, tout se transforme ?', 3),
(13, 'Quelle est la distance parcourue par un sportif lors d\'un marathon ?', 3),
(14, 'Lequel de ces hommes politiques n\'a jamais été ministre ?', 3),
(15, 'Lequel de ces français a remporté le tournoi de tennis Roland-Garros ?', 3),
(16, 'Dans quelle ville siège la Cour européenne des droits de l’Homme ?', 4),
(17, 'Quelle est l’altitude du Mont-Blanc ?', 4),
(18, 'Dans la série The 100, comment se nomme la station spatiale qui regroupe les survivants ?', 4),
(19, 'Quelle est la planète la plus proche du soleil ?', 4),
(20, 'Quel studio a produit le film d’animation Monstres et Compagnie ?', 4),
(21, 'Quelle est la capitale de l\'État de Californie aux États-Unis ?', 5),
(22, 'En quelle année est mort Albert Einstein ?', 5),
(23, 'Dans quelle boisson trouve-t-on de la quinine ?', 5),
(24, 'En France, jusqu’en quelle année les phares jaunes étaient-ils obligatoires sur les véhicules ?', 5),
(25, 'Quelle est la capitale des Seychelles ?', 5),
(26, 'En quelle année le Titanic a-t-il sombré ?', 6),
(27, 'En quelle année est né Etienne de la Boétie ?', 6),
(28, 'Qui est Liu Cixin ?', 6),
(29, 'A partir de quelle année Vincent Auriol a-t-il été Président de la République ?', 6),
(30, 'Qui a réalisé la première sortie dans l\'espace ?', 6),
(31, 'Quelle est la capitale de la France ?', 1),
(32, 'Dans quel pays peut on trouver la Catalogne ?', 1),
(33, 'Quel saison vient juste après l\'hiver ?', 1),
(34, 'Quel célèbre dictateur dirigea l’URSS du milieu des années 1920 à 1953 ?', 2),
(35, 'Qui a dit Le sort en est jeté ?', 2),
(36, 'Quel pays a remporté la coupe du monde de football en 2014 ?', 2),
(37, 'Qui est l\'interprète de la chanson I Shot the Sheriff ?', 3),
(38, 'Qui est le dieu de la guerre dans la mythologie grecque ?', 3),
(39, 'Quelle race d animal est un briard ?', 3),
(40, 'Quel cinéaste a réalisé Parle avec elle et Volver ?\r\n', 4),
(41, 'Dans quelle ville a lieu Roméo et Juliette ?', 4),
(42, 'En quelle année a chuté l’Empire Romain ?', 4),
(43, 'Par quel mot désigne t on une belle mère cruelle ?', 5),
(44, 'Combien l\'Allemagne compte-t-elle d\'états fédérés ?', 5),
(45, 'Quelle théorie doit on à Isaac Newton ?', 5),
(46, 'Qui a réalisé le film In the mood for love ?', 6),
(47, 'Dans quelle ville est né Mozart ?', 6),
(48, 'De quel courant philosophique Plotin est il le représentant ?', 6),
(49, 'Combien fait 2 + 5 x 3 ?', 1),
(50, 'Quelle est la capitale du Japon ?', 1),
(51, 'En quelle année a débuté la Révolution Française ?', 2),
(52, 'Quelle est la console la plus vendue de tous les temps ?', 2),
(53, 'Quel objet est devenu le symbole du film d\'animation Akira ?\r\n', 3),
(54, 'Quel état des États Unis a pour capitale Montgomery ?', 3),
(55, 'Quel animal est la drosophile ?', 4),
(56, 'Qu\'est ce qu\'un palimpseste ?', 4),
(57, 'Qui était Seguei Rachmaninov ?\r\n', 5),
(58, 'Quel animal est un roitelet ?\r\n', 5),
(59, 'Quel philosophe a écrit Les origines du totalitarisme et La crise de la culture ?', 6),
(60, 'Quelles sont les dates de vie et de mort de Galilée ?', 6),
(61, 'Que fait un skieur ?', 1),
(62, 'Lequel de ces mots n\'existe pas ?', 1),
(63, 'Quel accent met-on sur le mot vipere ?', 1),
(64, 'Quelle est la bonne orthographe ?', 1),
(65, 'Quel est le sujet de la phrase Flavien aime programmer ?', 1),
(66, 'Quel mot prend une cédille ?', 1),
(67, 'Qu\'obtient on en mélangeant du jaune et du bleu ?', 2),
(68, 'Lequel de ces mots prend toujours une majuscule ?', 2),
(69, 'Quel fleuve passe par Paris ?', 2),
(70, 'Que veut dire cloud en français ?', 2),
(71, 'Qu obtient on en mélangeant du bleu et du rouge ?', 2),
(72, 'De quelle race sont les souris ?', 2),
(73, 'Dans le titre du roman d\'Alexandre Dumas combien y a t il de mousquetaires ?', 3),
(74, 'Dans quelle cité habitaient les philosophes grecs Socrate, Platon et Aristote ?', 3),
(75, 'Quel mammifère a une queue de castor et un bec de canard ?', 3),
(76, 'Comment dit-on Angleterre en anglais ?', 3),
(77, 'Que signifient les initiales QI ?', 3),
(78, 'Quelle planète est la plus proche du Soleil ?', 3),
(79, 'Sur quelle côte est située la ville de Nice ?', 3),
(80, 'Combien Londres compte d\'habitants ?', 4),
(81, 'Quelle est la plus grande ville du monde ?', 4),
(82, 'Qui de ces personnes est l\'auteur d\'un théorème ?', 4),
(83, 'En quelle année est mort Victor Hugo ?', 4),
(84, 'Quel est l\'intrus parmi ces instruments de musique ?', 4),
(85, 'Où se situe le lac de Chalain ?', 4),
(86, 'Lequel de ces mots est masculin arcade, lampe, pétale, maison ?', 4),
(87, 'Quelle est la bonne orthographe ?', 5),
(88, 'Où se trouve l\'Etna ?', 5),
(89, 'En quelle année a été élu François Mitterrand ?', 5),
(90, 'Dans Star Wars quel membre de la famille Skywalker passe du côté obscur ?', 5),
(91, 'Quelle est l\'origine du yoghourt ?', 5),
(92, 'Qui a écrit L\'Avare ?', 5),
(93, 'De quelle espèce est Pumbaa ?', 5),
(94, 'Qui a écrit Sur la route ?', 6),
(95, 'Qu est ce que le génépi ?', 6),
(96, 'Qu est ce qu\'une marouflette ?', 6),
(97, 'Quelle est la date de l\'armistice de la Seconde Guerre mondiale ?', 6),
(98, 'De quel instrument se servaient les grecs ?', 6),
(99, 'Quel était la devise du Chevallier de Laspalès ?', 6),
(100, 'De quelle course Christine Arron est elle une coureuse ?', 6);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `label`) VALUES
(1, 'ROLE_ADMIN'),
(2, 'ROLE_USER');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `createdat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `firstname`, `lastname`, `createdat`) VALUES
(1, 'Flabinouse', '$argon2i$v=19$m=65536,t=4,p=1$cHB1bW9UNUg1eERYWGhRUg$4A9j8Ekqvd07PK9fCXUIDmM+L3RZ5zPYx8UM41JknkU', 'flavien.lambert57@gmail.com', 'Flavien', 'LAMBERT', '2021-12-06 19:41:38'),
(2, 'Max', '$argon2i$v=19$m=65536,t=4,p=1$d3ZaNVYyc3hZZ0ZhbnVEQQ$XkUAeJkkGeE2GISVDNWpd4L9wffMGf1hExeyihnyNHQ', 'maxence.giron@gmail.com', 'Maxence', 'GIRON', '2021-12-17 17:26:55'),
(3, 'Boris', '$argon2i$v=19$m=65536,t=4,p=1$YTlZejFrUmRTVW9Td1E3VA$1fuf7+9nSXNa4GC6ZnkfsELKD2cuJ3upQePjsa2uL80', 'boris@gmail.com', 'Boris', 'CERATI', '2021-12-17 21:15:06'),
(4, 'HarryCover', '$argon2i$v=19$m=65536,t=4,p=1$RHhMaVdlZG5SNlIvVzlaRw$AAUPX+jgqhVySSxCAvuifUjOTyC/szN9SB7BneS0cKQ', 'harry.cover@gmail.com', 'Harry', 'COVER', '2021-12-17 21:16:26'),
(5, 'AlexTerieur', '$argon2i$v=19$m=65536,t=4,p=1$RmpPTUxORFNrZE93SURvQQ$LAnztsdCyVo47ZmJfni3AMS3ucjo/8mHnzhKKiNeVh8', 'alex.terieur@gmail.com', 'Alex', 'TERIEUR', '2021-12-17 21:17:08'),
(7, 'user', '$argon2i$v=19$m=65536,t=4,p=1$bE1BeXVvQVNYSDFEZnAydw$eviTWYO5BCBDcVJHwpSDiLZLjZxiqeDLAJD0oPF5eyQ', 'main.testappli@gmail.com', 'Peya', 'CHPEY', '2022-01-06 19:19:55'),
(8, 'admin', '$argon2i$v=19$m=65536,t=4,p=1$eEtxOUlHcFV4SkhMUExaYg$o5sEpONhMljNI/tOcxB6wtEIhYEiQoekrx9Ml+zjXIw', 'main.testappli@gmail.com', 'Javas', 'CRIPT', '2022-01-06 19:20:32');

-- --------------------------------------------------------

--
-- Structure de la table `userrole`
--

CREATE TABLE `userrole` (
  `id_role` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `userrole`
--

INSERT INTO `userrole` (`id_role`, `id_user`) VALUES
(1, 1),
(2, 1),
(2, 2),
(1, 2),
(2, 3),
(1, 3),
(2, 4),
(2, 5),
(2, 7),
(2, 8),
(1, 8);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id_answer`),
  ADD KEY `id` (`id_question`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_question`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `userrole`
--
ALTER TABLE `userrole`
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `answer`
--
ALTER TABLE `answer`
  MODIFY `id_answer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`);

--
-- Contraintes pour la table `userrole`
--
ALTER TABLE `userrole`
  ADD CONSTRAINT `userrole_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`),
  ADD CONSTRAINT `userrole_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
