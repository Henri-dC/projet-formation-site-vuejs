-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db.3wa.io
-- Généré le : mer. 17 août 2022 à 08:54
-- Version du serveur :  5.7.33-0ubuntu0.18.04.1-log
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `xxx_account`
--

-- --------------------------------------------------------

--
-- Structure de la table `Account`
--

CREATE TABLE `Account` (
  `id` char(36) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` char(64) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  'is_admin' varchar(5) DEFAULT 'false',
  `creation_time` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Index pour la table `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


--Structure de la table `Articles`

CREATE TABLE `Articles`(
  `id` char(36) NOT NULL,
  `title` varchar(50) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `content` TEXT NOT NULL,
  `category_id` char(36) NOT NULL,
  `author` char(36) NOT NULL,
  `author_id` char(36) NOT NULL,
  `date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`author_id`) REFERENCES Account(`id`),
  FOREIGN KEY (`category_id`) REFERENCES Categories(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--Index pour la table `Account`--

ALTER TABLE `Articles`
  ADD PRIMARY KEY (`id`)


--Structure de la table Catégories--

CREATE TABLE `Categories`(
  `id` char(36) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--Index pour la table `Categories`--

ALTER TABLE `Categories`
  ADD PRIMARY KEY (`id`)
