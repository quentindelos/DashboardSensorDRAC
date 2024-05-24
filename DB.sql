-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 29 mars 2024 à 16:11
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_drac`
--

-- --------------------------------------------------------

--
-- Structure de la table `CAPTEUR`
--

CREATE TABLE `CAPTEUR` (
  `ID_CAPTEUR` bigint(10) NOT NULL,
  `ID_type_capteur` char(1) NOT NULL,
  `mesure` varchar(20) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CAPTEUR`
--

INSERT INTO `CAPTEUR` (`ID_CAPTEUR`, `ID_type_capteur`, `mesure`, `Time`) VALUES
(1, 'T', '22.1', '2024-03-29 14:10:59'),
(2, 'H', '38', '2024-03-29 14:10:59'),
(3, 'C', '614', '2024-03-29 14:10:59'),
(4, 'T', '22.2', '2024-03-29 14:12:59'),
(5, 'H', '38', '2024-03-29 14:12:59'),
(6, 'C', '597', '2024-03-29 14:12:59'),
(7, 'T', '22.1', '2024-03-29 14:14:59'),
(8, 'H', '38', '2024-03-29 14:14:59'),
(9, 'C', '603', '2024-03-29 14:14:59'),
(10, 'T', '22.1', '2024-03-29 14:16:59'),
(11, 'H', '38', '2024-03-29 14:16:59'),
(12, 'C', '597', '2024-03-29 14:16:59'),
(13, 'T', '22.2', '2024-03-29 14:18:59'),
(14, 'H', '38', '2024-03-29 14:18:59'),
(15, 'C', '587', '2024-03-29 14:18:59'),
(16, 'T', '22.2', '2024-03-29 14:20:59'),
(17, 'H', '38', '2024-03-29 14:20:59'),
(18, 'C', '580', '2024-03-29 14:20:59'),
(19, 'T', '22.1', '2024-03-29 14:22:59'),
(20, 'H', '38', '2024-03-29 14:22:59'),
(21, 'C', '573', '2024-03-29 14:22:59'),
(22, 'T', '22.1', '2024-03-29 14:24:59'),
(23, 'H', '38', '2024-03-29 14:24:59'),
(24, 'C', '584', '2024-03-29 14:24:59'),
(25, 'T', '22.1', '2024-03-29 14:26:59'),
(26, 'H', '38', '2024-03-29 14:26:59'),
(27, 'C', '579', '2024-03-29 14:26:59'),
(28, 'T', '22.1', '2024-03-29 14:28:59'),
(29, 'H', '38', '2024-03-29 14:28:59'),
(30, 'C', '585', '2024-03-29 14:28:59'),
(31, 'T', '22.1', '2024-03-29 14:30:59'),
(32, 'H', '38', '2024-03-29 14:30:59'),
(33, 'C', '574', '2024-03-29 14:30:59'),
(34, 'T', '22', '2024-03-29 14:32:59'),
(35, 'H', '38', '2024-03-29 14:32:59'),
(36, 'C', '579', '2024-03-29 14:32:59'),
(37, 'T', '22', '2024-03-29 14:34:59'),
(38, 'H', '38', '2024-03-29 14:34:59'),
(39, 'C', '564', '2024-03-29 14:34:59'),
(40, 'T', '22', '2024-03-29 14:36:59'),
(41, 'H', '38', '2024-03-29 14:36:59'),
(42, 'C', '565', '2024-03-29 14:36:59'),
(43, 'T', '22', '2024-03-29 14:38:59'),
(44, 'H', '38', '2024-03-29 14:38:59'),
(45, 'C', '569', '2024-03-29 14:38:59'),
(46, 'T', '22', '2024-03-29 14:40:59'),
(47, 'H', '38', '2024-03-29 14:40:59'),
(48, 'C', '589', '2024-03-29 14:40:59'),
(49, 'T', '22', '2024-03-29 14:42:59'),
(50, 'H', '38', '2024-03-29 14:42:59'),
(51, 'C', '591', '2024-03-29 14:42:59'),
(52, 'T', '22.1', '2024-03-29 14:44:59'),
(53, 'H', '38', '2024-03-29 14:44:59'),
(54, 'C', '600', '2024-03-29 14:44:59'),
(55, 'T', '22.1', '2024-03-29 14:46:59'),
(56, 'H', '38', '2024-03-29 14:46:59'),
(57, 'C', '598', '2024-03-29 14:46:59'),
(58, 'T', '22.1', '2024-03-29 14:48:59'),
(59, 'H', '39', '2024-03-29 14:48:59'),
(60, 'C', '619', '2024-03-29 14:48:59'),
(61, 'T', '22.2', '2024-03-29 14:50:59'),
(62, 'H', '38', '2024-03-29 14:50:59'),
(63, 'C', '580', '2024-03-29 14:50:59'),
(64, 'T', '22.2', '2024-03-29 14:52:59'),
(65, 'H', '38', '2024-03-29 14:52:59'),
(66, 'C', '598', '2024-03-29 14:52:59'),
(67, 'T', '22.2', '2024-03-29 14:54:59'),
(68, 'H', '38', '2024-03-29 14:54:59'),
(69, 'C', '578', '2024-03-29 14:54:59'),
(70, 'T', '22.2', '2024-03-29 14:56:59'),
(71, 'H', '38', '2024-03-29 14:56:59'),
(72, 'C', '581', '2024-03-29 14:56:59'),
(73, 'T', '22.1', '2024-03-29 14:58:59'),
(74, 'H', '38', '2024-03-29 14:58:59'),
(75, 'C', '561', '2024-03-29 14:58:59'),
(76, 'T', '22.1', '2024-03-29 15:00:59'),
(77, 'H', '38', '2024-03-29 15:00:59'),
(78, 'C', '566', '2024-03-29 15:00:59'),
(79, 'T', '22.1', '2024-03-29 15:04:59'),
(80, 'H', '38', '2024-03-29 15:04:59'),
(81, 'C', '572', '2024-03-29 15:04:59'),
(82, 'T', '22.1', '2024-03-29 15:06:59'),
(83, 'H', '38', '2024-03-29 15:06:59'),
(84, 'C', '575', '2024-03-29 15:06:59'),
(85, 'T', '22.1', '2024-03-29 15:08:59'),
(86, 'H', '37', '2024-03-29 15:08:59'),
(87, 'C', '573', '2024-03-29 15:08:59'),
(88, 'T', '22', '2024-03-29 15:10:59'),
(89, 'H', '37', '2024-03-29 15:10:59'),
(90, 'C', '568', '2024-03-29 15:10:59');

-- --------------------------------------------------------

--
-- Structure de la table `SALLE`
--

CREATE TABLE `SALLE` (
  `ID_SALLE` char(1) NOT NULL,
  `LIBELLE_SALLE` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `SALLE`
--

INSERT INTO `SALLE` (`ID_SALLE`, `LIBELLE_SALLE`) VALUES
('A', 'Salle A'),
('B', 'Salle B'),
('C', 'Salle C');

-- --------------------------------------------------------

--
-- Structure de la table `TYPE_CAPTEUR`
--

CREATE TABLE `TYPE_CAPTEUR` (
  `ID_TYPE_CAPTEUR` char(2) NOT NULL,
  `LIBELLE_TYPE_CAPTEUR` char(40) DEFAULT NULL,
  `unite_de_mesure` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `TYPE_CAPTEUR`
--

INSERT INTO `TYPE_CAPTEUR` (`ID_TYPE_CAPTEUR`, `LIBELLE_TYPE_CAPTEUR`, `unite_de_mesure`) VALUES
('C', 'CO2', 'ppm'),
('H', 'humidité', '%'),
('T', 'température', '°C');

-- --------------------------------------------------------

--
-- Structure de la table `TYPE_USER`
--

CREATE TABLE `TYPE_USER` (
  `ID_TYPE_USER` char(1) NOT NULL,
  `LIBELLE_TYPE_USER` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `TYPE_USER`
--

INSERT INTO `TYPE_USER` (`ID_TYPE_USER`, `LIBELLE_TYPE_USER`) VALUES
('A', 'Administrateur'),
('T', 'Technicien');

-- --------------------------------------------------------

--
-- Structure de la table `USER`
--

CREATE TABLE `USER` (
  `id` int(11) NOT NULL,
  `FIRSTNAME` varchar(40) DEFAULT NULL,
  `LASTNAME` varchar(40) DEFAULT NULL,
  `LOGIN` varchar(40) DEFAULT NULL,
  `EMAIL` varchar(40) DEFAULT NULL,
  `ID_TYPE_USER` varchar(40) DEFAULT NULL,
  `PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

INSERT INTO `user` (`LOGIN`, `PASSWORD`, `ID_TYPE_USER`) VALUES
('root'),
('$2y$10$YdCG.9njZoqcNLuT40NBn.fs.A9XLnKaNDt9kDHoa/X8pdcastEpW'),
('A');

-- --------------------------------------------------------

--
-- Index pour la table `CAPTEUR`
--
ALTER TABLE `CAPTEUR`
  ADD PRIMARY KEY (`ID_CAPTEUR`),
  ADD UNIQUE KEY `CAPTEUR_PK` (`ID_CAPTEUR`);

--
-- Index pour la table `SALLE`
--
ALTER TABLE `SALLE`
  ADD PRIMARY KEY (`ID_SALLE`),
  ADD UNIQUE KEY `SALLE_PK` (`ID_SALLE`);

--
-- Index pour la table `TYPE_CAPTEUR`
--
ALTER TABLE `TYPE_CAPTEUR`
  ADD PRIMARY KEY (`ID_TYPE_CAPTEUR`),
  ADD UNIQUE KEY `TYPE_CAPTEUR_PK` (`ID_TYPE_CAPTEUR`);

--
-- Index pour la table `TYPE_USER`
--
ALTER TABLE `TYPE_USER`
  ADD PRIMARY KEY (`ID_TYPE_USER`),
  ADD UNIQUE KEY `TYPE_USER_PK` (`ID_TYPE_USER`);

--
-- Index pour la table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `CAPTEUR`
--
ALTER TABLE `CAPTEUR`
  MODIFY `ID_CAPTEUR` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT pour la table `USER`
--
ALTER TABLE `USER`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;