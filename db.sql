-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 08 nov. 2023 à 21:31
-- Version du serveur : 10.6.15-MariaDB-cll-lve
-- Version de PHP : 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_adm` int(20) NOT NULL,
  `email` varchar(120) NOT NULL,
  `nom` varchar(120) NOT NULL,
  `psswd` varchar(200) NOT NULL,
  `valid` int(5) DEFAULT 0,
  `acces` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_adm`, `email`, `nom`, `psswd`, `valid`, `acces`) VALUES
(1, 'admin@admin.com', 'Admin', '123456', 0, 1),
(2, 'test@test.com', 'test', 'test', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_cat` int(100) NOT NULL,
  `nom` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chargelist`
--

CREATE TABLE `chargelist` (
  `id_chargelist` int(200) NOT NULL,
  `id_charge` int(200) NOT NULL,
  `montant` double NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chargescat`
--

CREATE TABLE `chargescat` (
  `id_charge` int(120) NOT NULL,
  `nom` varchar(120) NOT NULL,
  `prix` int(60) DEFAULT 0,
  `valid` int(3) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(120) NOT NULL,
  `nom` varchar(120) NOT NULL,
  `tel` varchar(100) NOT NULL,
  `dates` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

CREATE TABLE `couleur` (
  `id_col` int(120) NOT NULL,
  `nom` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `entreestock`
--

CREATE TABLE `entreestock` (
  `id_entree` int(200) NOT NULL,
  `id_prod` int(200) NOT NULL,
  `prixachat` double NOT NULL,
  `prixvente` double NOT NULL,
  `qt` int(30) NOT NULL,
  `dtadd` datetime NOT NULL,
  `caissier` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE `marque` (
  `id_marque` int(200) NOT NULL,
  `nom` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id_pai` int(120) NOT NULL,
  `nom` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id_pai`, `nom`) VALUES
(4, 'Crédit'),
(3, 'Espèce'),
(5, 'Chèque'),
(6, 'Carte Bancaire');

-- --------------------------------------------------------

--
-- Structure de la table `prodsortiestock`
--

CREATE TABLE `prodsortiestock` (
  `id_psor` int(200) NOT NULL,
  `idprod` int(200) NOT NULL,
  `prix` double NOT NULL,
  `qt` int(30) NOT NULL,
  `pachat` double NOT NULL,
  `id_sortie` int(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id_prod` int(200) NOT NULL,
  `nom` varchar(120) NOT NULL,
  `marque` int(10) DEFAULT NULL,
  `img1` varchar(150) NOT NULL,
  `dtadd` date NOT NULL,
  `prixachat` double DEFAULT NULL,
  `prixvente` double DEFAULT NULL,
  `prixpar` double DEFAULT NULL,
  `qtmin` int(10) DEFAULT NULL,
  `cat` int(11) NOT NULL,
  `coleur` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sortiestock`
--

CREATE TABLE `sortiestock` (
  `id_sortie` int(200) NOT NULL,
  `date` datetime NOT NULL,
  `vendeur` int(30) DEFAULT NULL,
  `paiement` int(30) DEFAULT NULL,
  `tichet_id` varchar(40) NOT NULL,
  `client` int(30) DEFAULT NULL,
  `caissier` varchar(130) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

CREATE TABLE `vendeur` (
  `id_vendeur` int(120) NOT NULL,
  `nom` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_adm`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `chargelist`
--
ALTER TABLE `chargelist`
  ADD PRIMARY KEY (`id_chargelist`);

--
-- Index pour la table `chargescat`
--
ALTER TABLE `chargescat`
  ADD PRIMARY KEY (`id_charge`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `couleur`
--
ALTER TABLE `couleur`
  ADD PRIMARY KEY (`id_col`);

--
-- Index pour la table `entreestock`
--
ALTER TABLE `entreestock`
  ADD PRIMARY KEY (`id_entree`);

--
-- Index pour la table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`id_marque`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id_pai`);

--
-- Index pour la table `prodsortiestock`
--
ALTER TABLE `prodsortiestock`
  ADD PRIMARY KEY (`id_psor`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_prod`);

--
-- Index pour la table `sortiestock`
--
ALTER TABLE `sortiestock`
  ADD PRIMARY KEY (`id_sortie`);

--
-- Index pour la table `vendeur`
--
ALTER TABLE `vendeur`
  ADD PRIMARY KEY (`id_vendeur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_adm` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_cat` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `chargelist`
--
ALTER TABLE `chargelist`
  MODIFY `id_chargelist` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `chargescat`
--
ALTER TABLE `chargescat`
  MODIFY `id_charge` int(120) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(120) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `couleur`
--
ALTER TABLE `couleur`
  MODIFY `id_col` int(120) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `entreestock`
--
ALTER TABLE `entreestock`
  MODIFY `id_entree` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `marque`
--
ALTER TABLE `marque`
  MODIFY `id_marque` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id_pai` int(120) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `prodsortiestock`
--
ALTER TABLE `prodsortiestock`
  MODIFY `id_psor` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_prod` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sortiestock`
--
ALTER TABLE `sortiestock`
  MODIFY `id_sortie` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vendeur`
--
ALTER TABLE `vendeur`
  MODIFY `id_vendeur` int(120) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
