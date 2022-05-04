-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 04 mai 2022 à 17:13
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `canal`
--

CREATE TABLE `canal` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `id_forum` int(11) DEFAULT NULL,
  `id_createur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `canal`
--

INSERT INTO `canal` (`id`, `nom`, `id_forum`, `id_createur`) VALUES
(1, 'HELP je ne comprends RIEN', 1, 3),
(2, 'A quoi sert OCAML ?', 1, 3),
(3, 'C++ > Prolog', 1, 4),
(4, 'Comment créer une classe en Java ?', 2, 3),
(5, 'Les interfaces ne servent à rien...', 2, 3),
(6, 'Don de PC', 3, 1),
(7, 'ALERTE : Cas covid en L3', 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `contenu`
--

CREATE TABLE `contenu` (
  `id` int(11) NOT NULL,
  `uri` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contenu`
--

INSERT INTO `contenu` (`id`, `uri`) VALUES
(1, 'CM-01-PLF.pptx'),
(2, 'CM-02-PLF.pptx'),
(3, 'CM-03-PLF.pptx'),
(4, 'TD-01-PLF.pptx'),
(5, 'TP-01-JAVA.pdf'),
(6, 'CM-03-JAVA.pptx'),
(7, 'TD-01-JAVA.PDF');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` int(11) NOT NULL,
  `niveau` enum('6EME','5EME','4EME','2ND','1ERE','TERM','L1','L2','L3','M1','M2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `niveau`) VALUES
(3, 'L3'),
(4, 'L3');

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `forum`
--

INSERT INTO `forum` (`id`, `nom`) VALUES
(1, 'Prog logique et fonctionnelle'),
(2, 'Langage Java'),
(3, 'Forum université de bourgogne');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `date_creation` date NOT NULL,
  `id_createur` int(11) DEFAULT NULL,
  `niveau` enum('6EME','5EME','4EME','3EME','2ND','1ERE','TERM','L1','L2','L3','M1','M2') DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id`, `nom`, `date_creation`, `id_createur`, `niveau`, `image`) VALUES
(1, 'Programmation Logique et Fonctionnelle', '2021-01-01', 1, 'L3', 'imagePLF.png'),
(2, 'Programmation Java', '2022-01-01', 2, 'L2', 'imageJava.png'),
(3, 'Développement Web', '2021-01-01', 1, 'L1', 'imageDW.png'),
(4, 'Image Pour Web', '2022-01-01', 2, 'L3', 'imageIW.png');

-- --------------------------------------------------------

--
-- Structure de la table `matiere_contenu`
--

CREATE TABLE `matiere_contenu` (
  `id_mat` int(11) NOT NULL,
  `id_contenus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `matiere_contenu`
--

INSERT INTO `matiere_contenu` (`id_mat`, `id_contenus`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `matiere_suivie`
--

CREATE TABLE `matiere_suivie` (
  `id_etu` int(11) NOT NULL,
  `id_mat` int(11) NOT NULL,
  `avancement` enum('TERMINE','EN COURS') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `matiere_suivie`
--

INSERT INTO `matiere_suivie` (`id_etu`, `id_mat`, `avancement`) VALUES
(3, 1, 'EN COURS'),
(3, 2, 'TERMINE'),
(4, 1, 'TERMINE'),
(4, 2, 'EN COURS');

-- --------------------------------------------------------

--
-- Structure de la table `matiere_tag`
--

CREATE TABLE `matiere_tag` (
  `id_mat` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `matiere_tag`
--

INSERT INTO `matiere_tag` (`id_mat`, `id_tag`) VALUES
(1, 1),
(1, 3),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `contenu` varchar(512) DEFAULT NULL,
  `id_canal` int(11) DEFAULT NULL,
  `id_auteur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `contenu`, `id_canal`, `id_auteur`) VALUES
(1, 'ça fait 3 fois que je relis le cours j\'ai toujours rien compris', 1, 3),
(2, 'Non mais c\'est vrai quoi OCAML à part faire le malin ?', 2, 3),
(3, 'Bien d\'avoir un langage sans gestion précise de la mémoire ? (un garbage collector mdrrrr)', 3, 4),
(4, 'en fait je comprends juste pas le concept de classes', 4, 3),
(5, 'je comprends pas le concept d\'interfaces non plus c\'est terrible mon niveau', 5, 3),
(6, 'Venez prendre des beaux PC oui', 6, 1),
(7, 'Ne venez pas en cours vous êtes en distanciel', 7, 2);

-- --------------------------------------------------------

--
-- Structure de la table `participer_forum`
--

CREATE TABLE `participer_forum` (
  `id_part` int(11) NOT NULL,
  `id_forum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `participer_forum`
--

INSERT INTO `participer_forum` (`id_part`, `id_forum`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(4, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `qcm`
--

CREATE TABLE `qcm` (
  `id` int(11) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `questions` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `qcm`
--

INSERT INTO `qcm` (`id`, `id_prof`, `questions`) VALUES
(1, 1, 'cultureGenerale.xml\r\n'),
(2, 2, 'controlePhysique.xml');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id` int(11) NOT NULL,
  `id_qcm` int(11) DEFAULT NULL,
  `xml_uri` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id`, `id_qcm`, `xml_uri`) VALUES
(1, 1, 'manuel_valls_1.xml'),
(2, 1, 'bg_daniel_1.xml'),
(3, 2, 'maquerongue_emmannuel_2.xml'),
(5, 2, 'bg_daniel_2.xml');

-- --------------------------------------------------------

--
-- Structure de la table `reponse_utilisateur`
--

CREATE TABLE `reponse_utilisateur` (
  `id_uti` int(11) NOT NULL,
  `id_rep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reponse_utilisateur`
--

INSERT INTO `reponse_utilisateur` (`id_uti`, `id_rep`) VALUES
(1, 1),
(2, 3),
(3, 2),
(3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `contenu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id`, `contenu`) VALUES
(1, 'Informatique'),
(2, 'Quantique'),
(3, 'Maths'),
(4, 'Physique'),
(5, 'Sociologie'),
(6, 'Psychologie du règne animal');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `type` enum('ETUDIANT','PROFESSEUR') NOT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `mdp`, `mail`, `prenom`, `nom`, `type`, `image`) VALUES
(1, 'manuel_valls', 'moipresident', 'manuel.valls@gmail.com', 'manuel', 'valls', 'PROFESSEUR', 'photoPresident.png'),
(2, 'em_maquerongue', 'republiqueenmarche', 'president@gmail.com', 'maquerongue', 'emmannuel', 'PROFESSEUR', 'photoTShirt.png'),
(3, 'daniel_le_bg', 'jesuisbg', 'bg@gmail.com', 'bg', 'daniel', 'ETUDIANT', 'bg.png'),
(4, 'vantai_le_bg', 'jesuisaussibg', 'vantai_bg@gmail.com', 'bg', 'vantai', 'ETUDIANT', 'cuteTiger.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `canal`
--
ALTER TABLE `canal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `canal_ibfk_1` (`id_forum`),
  ADD KEY `id_createur` (`id_createur`);

--
-- Index pour la table `contenu`
--
ALTER TABLE `contenu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_createur` (`id_createur`);

--
-- Index pour la table `matiere_contenu`
--
ALTER TABLE `matiere_contenu`
  ADD PRIMARY KEY (`id_mat`,`id_contenus`),
  ADD KEY `id_contenus` (`id_contenus`);

--
-- Index pour la table `matiere_suivie`
--
ALTER TABLE `matiere_suivie`
  ADD PRIMARY KEY (`id_etu`,`id_mat`),
  ADD KEY `id_mat` (`id_mat`);

--
-- Index pour la table `matiere_tag`
--
ALTER TABLE `matiere_tag`
  ADD PRIMARY KEY (`id_mat`,`id_tag`),
  ADD KEY `id_tag` (`id_tag`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_canal` (`id_canal`),
  ADD KEY `id_auteur` (`id_auteur`);

--
-- Index pour la table `participer_forum`
--
ALTER TABLE `participer_forum`
  ADD PRIMARY KEY (`id_part`,`id_forum`),
  ADD KEY `participer_forum_ibfk_2` (`id_forum`);

--
-- Index pour la table `qcm`
--
ALTER TABLE `qcm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prof` (`id_prof`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_qcm` (`id_qcm`);

--
-- Index pour la table `reponse_utilisateur`
--
ALTER TABLE `reponse_utilisateur`
  ADD PRIMARY KEY (`id_uti`,`id_rep`),
  ADD KEY `id_rep` (`id_rep`),
  ADD KEY `reponses_utilisateurs_ibfk_1` (`id_uti`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `canal`
--
ALTER TABLE `canal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `contenu`
--
ALTER TABLE `contenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `qcm`
--
ALTER TABLE `qcm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `canal`
--
ALTER TABLE `canal`
  ADD CONSTRAINT `canal_ibfk_1` FOREIGN KEY (`id_forum`) REFERENCES `forum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `canal_ibfk_2` FOREIGN KEY (`id_createur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `matiere_ibfk_1` FOREIGN KEY (`id_createur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `matiere_contenu`
--
ALTER TABLE `matiere_contenu`
  ADD CONSTRAINT `matiere_contenu_ibfk_1` FOREIGN KEY (`id_mat`) REFERENCES `matiere` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matiere_contenu_ibfk_2` FOREIGN KEY (`id_contenus`) REFERENCES `contenu` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `matiere_suivie`
--
ALTER TABLE `matiere_suivie`
  ADD CONSTRAINT `matiere_suivie_ibfk_1` FOREIGN KEY (`id_etu`) REFERENCES `etudiant` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matiere_suivie_ibfk_2` FOREIGN KEY (`id_mat`) REFERENCES `matiere` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `matiere_tag`
--
ALTER TABLE `matiere_tag`
  ADD CONSTRAINT `matiere_tag_ibfk_1` FOREIGN KEY (`id_mat`) REFERENCES `matiere` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matiere_tag_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`id_canal`) REFERENCES `canal` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`id_auteur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `participer_forum`
--
ALTER TABLE `participer_forum`
  ADD CONSTRAINT `participer_forum_ibfk_1` FOREIGN KEY (`id_part`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participer_forum_ibfk_2` FOREIGN KEY (`id_forum`) REFERENCES `forum` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `qcm`
--
ALTER TABLE `qcm`
  ADD CONSTRAINT `qcm_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`id_qcm`) REFERENCES `qcm` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reponse_utilisateur`
--
ALTER TABLE `reponse_utilisateur`
  ADD CONSTRAINT `reponse_utilisateur_ibfk_1` FOREIGN KEY (`id_uti`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reponse_utilisateur_ibfk_2` FOREIGN KEY (`id_rep`) REFERENCES `reponse` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
