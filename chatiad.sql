-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 27 mai 2019 à 06:14
-- Version du serveur :  5.7.21
-- Version de PHP :  7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `chatiad`
--

-- --------------------------------------------------------

--
-- Structure de la table `connection`
--

DROP TABLE IF EXISTS `connection`;
CREATE TABLE IF NOT EXISTS `connection` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `connection`
--

INSERT INTO `connection` (`id`, `user_id`, `datetime`) VALUES
(5, 1, '2019-05-27 06:14:33');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `content` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `user_id`, `content`, `datetime`) VALUES
(1, 1, 'test', '2019-05-26 08:56:00'),
(2, 2, 'ca va', '2019-05-26 08:57:11'),
(3, 1, 'oui bien et toi?', '2019-05-26 08:57:21');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `email`, `password`) VALUES
(1, 'momo', NULL, '$2y$10$N3AC0Wz4L.hsF1KLQt9l3efFtcVw1xK5yJKM6gH7tBhh1ocRp/ihG'),
(2, 'yakuza', NULL, '$2y$10$QNceFqzMVC5.q4G.BKT3w.Pvh3dJEY04RQGg8dqAwLADqgSXT576m');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
