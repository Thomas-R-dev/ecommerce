-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 09 juin 2020 à 05:43
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `toys4us`
--

-- --------------------------------------------------------

--
-- Structure de la table `avisclients`
--

DROP TABLE IF EXISTS `avisclients`;
CREATE TABLE IF NOT EXISTS `avisclients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note` int(11) NOT NULL,
  `titre` varchar(20) NOT NULL,
  `commentaire` varchar(200) NOT NULL,
  `date` int(11) NOT NULL,
  `idclient` int(11) NOT NULL,
  `refproduit` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idClient` (`idclient`),
  KEY `refProduit` (`refproduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `souscat` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `codesreduc`
--

DROP TABLE IF EXISTS `codesreduc`;
CREATE TABLE IF NOT EXISTS `codesreduc` (
  `code` int(11) NOT NULL,
  `dateentree` int(11) NOT NULL,
  `datesortie` int(11) NOT NULL,
  `valeur` float NOT NULL,
  `utilisations` int(11) NOT NULL,
  `idclient` int(11) NOT NULL,
  PRIMARY KEY (`code`),
  KEY `idClient` (`idclient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomproduit` varchar(100) NOT NULL,
  `qteproduit` float NOT NULL,
  `prixproduit` float NOT NULL,
  `n_facture` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `n_facture` (`n_facture`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `nomproduit`, `qteproduit`, `prixproduit`, `n_facture`) VALUES
(1, 'Les Inconnus', 1, 140.99, 1),
(2, 'Test DVD', 1, 11.99, 1),
(3, 'BlaBla', 2, 27.99, 1),
(4, 'Les Inconnus', 2, 140.99, 2),
(5, 'Test DVD', 2, 11.99, 2),
(6, 'Test DVD', 1, 11.99, 3);

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

DROP TABLE IF EXISTS `comptes`;
CREATE TABLE IF NOT EXISTS `comptes` (
  `login` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rang` varchar(20) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  PRIMARY KEY (`login`),
  KEY `idUtilisateur` (`idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`login`, `password`, `rang`, `idutilisateur`) VALUES
('test5@admin.com', '10470c3b4b1fed12c3baac014be15fac67c6e815_CrYpTo', 'Commerçant', 2),
('test@admin.com', '10470c3b4b1fed12c3baac014be15fac67c6e815_CrYpTo', 'Admin', 1);

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

DROP TABLE IF EXISTS `connexion`;
CREATE TABLE IF NOT EXISTS `connexion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(18) NOT NULL,
  `dateConnexion` date NOT NULL,
  `timeConnexion` time NOT NULL,
  `idCompte` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCompte` (`idCompte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

DROP TABLE IF EXISTS `factures`;
CREATE TABLE IF NOT EXISTS `factures` (
  `numfacture` int(11) NOT NULL AUTO_INCREMENT,
  `total` float NOT NULL,
  `statut` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `id_compte` varchar(50) NOT NULL,
  PRIMARY KEY (`numfacture`),
  KEY `id_compte` (`id_compte`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`numfacture`, `total`, `statut`, `date`, `id_compte`) VALUES
(1, 208.96, 'En cours', '2020-05-15', 'test@admin.com'),
(2, 305.96, 'En cours', '2020-05-15', 'test@admin.com'),
(3, 11.99, 'En cours', '2020-05-21', 'test@admin.com');

-- --------------------------------------------------------

--
-- Structure de la table `imgproduits`
--

DROP TABLE IF EXISTS `imgproduits`;
CREATE TABLE IF NOT EXISTS `imgproduits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lien` varchar(200) NOT NULL,
  `refproduit` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `refProduit` (`refproduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `reference` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `prix` float NOT NULL,
  `quantite` int(11) NOT NULL,
  `disponible` varchar(50) NOT NULL,
  `idcategorie` int(11) NOT NULL,
  `idcommercant` int(11) NOT NULL,
  PRIMARY KEY (`reference`),
  KEY `idCommercant` (`idcommercant`),
  KEY `idCategorie` (`idcategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`reference`, `titre`, `description`, `prix`, `quantite`, `disponible`, `idcategorie`, `idcommercant`) VALUES
(1, 'Article 202', 'test', 57.72, 48, 'En stock', 1, 1),
(10, 'Article 108', 'test', 26.76, 47, 'En stock', 1, 1),
(11, 'Article 789', 'test', 3.92, 10, 'En stock', 1, 1),
(12, 'Article 117', 'test', 71.18, 48, 'En stock', 8, 1),
(13, 'Article 539', 'test', 41.23, 30, 'En stock', 8, 1),
(14, 'Article 68', 'test', 87.4, 50, 'En stock', 7, 1),
(15, 'Article 957', 'test', 85.84, 43, 'En stock', 7, 1),
(16, 'Article 798', 'test', 96.93, 25, 'En stock', 6, 1),
(17, 'Article 953', 'test', 11.97, 31, 'En stock', 5, 1),
(18, 'Article 574', 'test', 47.4, 17, 'En stock', 4, 1),
(19, 'Article 678', 'test', 21.84, 8, 'En stock', 3, 1),
(20, 'Article 745', 'test', 38.24, 4, 'En stock', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `promos`
--

DROP TABLE IF EXISTS `promos`;
CREATE TABLE IF NOT EXISTS `promos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateentree` int(11) NOT NULL,
  `datesortie` int(11) NOT NULL,
  `valeur` int(11) NOT NULL,
  `idcommercant` int(11) NOT NULL,
  `refproduit` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCommercant` (`idcommercant`),
  KEY `refProduit` (`refproduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
CREATE TABLE IF NOT EXISTS `tbl_products` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `category` varchar(255) NOT NULL,
  `average_rating` float(3,1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `name`, `price`, `category`, `average_rating`) VALUES
(1, 'Tiny Handbags', 100.00, 'Fashion', 5.0),
(2, 'Locket watch', 300.00, 'DESCRIPTION\r\nDESCRIPTION\r\nDESCRIPTION\r\nDESCRIPTION\r\nDESCRIPTION\r\nDESCRIPTION\r\nDESCRIPTION\r\nDESCRIPTION\r\nDESCRIPTION\r\n', 3.0),
(3, 'Trendy Watch', 550.00, 'Generic', 4.0),
(4, 'Travel Bag', 820.00, 'Travel', 5.0),
(5, 'Plastic Ducklings', 200.00, 'Toys', 4.0),
(6, 'Wooden Dolls', 290.00, 'Toys', 5.0),
(7, 'Advanced Camera', 600.00, 'Gadget', 4.0),
(8, 'Jewel Box', 180.00, 'Fashion', 5.0),
(9, 'Perl Jewellery', 940.00, 'Fashion', 5.0);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_product_image`
--

DROP TABLE IF EXISTS `tbl_product_image`;
CREATE TABLE IF NOT EXISTS `tbl_product_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `preview_source` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tbl_product_image`
--

INSERT INTO `tbl_product_image` (`id`, `product_id`, `preview_source`) VALUES
(1, 2, 'gallery/preview1.jpeg'),
(2, 2, 'gallery/preview2.jpeg'),
(3, 2, 'gallery/preview3.jpeg'),
(4, 8, 'gallery/preview4.jpg'),
(5, 8, 'gallery/preview5.jpg'),
(6, 8, 'gallery/preview6.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(10) NOT NULL,
  `nom` varchar(15) NOT NULL,
  `prenom` varchar(15) NOT NULL,
  `datenaissance` date NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `adressesup` varchar(200) NOT NULL,
  `codepostal` varchar(5) NOT NULL,
  `ville` varchar(15) NOT NULL,
  `telephonemobile` varchar(10) NOT NULL,
  `telephonefixe` varchar(10) NOT NULL,
  `societe` varchar(50) NOT NULL,
  `siret` bigint(14) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `genre`, `nom`, `prenom`, `datenaissance`, `adresse`, `adressesup`, `codepostal`, `ville`, `telephonemobile`, `telephonefixe`, `societe`, `siret`) VALUES
(1, 'M.', 'Marko', 'Polo', '1980-07-10', '22 rue du commerce', 'Pas de sonnette', '59005', 'Toulouse', '0612345678', '', 'blabla101', 12345678901234),
(2, 'M.', 'Markoouhiuhiuhi', 'Poloiuhiugiugiu', '1980-07-10', '20 rue du commerce', 'Pas de sonnette', '59000', 'Toulouse', '0612345678', '', 'blabla', 12);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `codesreduc`
--
ALTER TABLE `codesreduc`
  ADD CONSTRAINT `codesreduc_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`n_facture`) REFERENCES `factures` (`numfacture`);

--
-- Contraintes pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD CONSTRAINT `comptes_ibfk_1` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `connexion`
--
ALTER TABLE `connexion`
  ADD CONSTRAINT `connexion_ibfk_1` FOREIGN KEY (`idCompte`) REFERENCES `comptes` (`login`);

--
-- Contraintes pour la table `factures`
--
ALTER TABLE `factures`
  ADD CONSTRAINT `factures_ibfk_1` FOREIGN KEY (`id_compte`) REFERENCES `comptes` (`login`);

--
-- Contraintes pour la table `imgproduits`
--
ALTER TABLE `imgproduits`
  ADD CONSTRAINT `imgproduits_ibfk_1` FOREIGN KEY (`refproduit`) REFERENCES `produits` (`reference`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`idcommercant`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `produits_ibfk_2` FOREIGN KEY (`idcategorie`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `promos`
--
ALTER TABLE `promos`
  ADD CONSTRAINT `promos_ibfk_1` FOREIGN KEY (`idcommercant`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `promos_ibfk_2` FOREIGN KEY (`refproduit`) REFERENCES `produits` (`reference`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
