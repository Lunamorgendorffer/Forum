-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `forum`;

-- Listage de la structure de la table forum. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `nameCategory` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_category`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum.category : ~6 rows (environ)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
REPLACE INTO `category` (`id_category`, `nameCategory`) VALUES
	(1, 'Drame'),
	(2, 'Thriller'),
	(3, 'Policier'),
	(4, 'Anime'),
	(5, 'Comedie'),
	(6, 'Science-fiction');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Listage de la structure de la table forum. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(50) COLLATE utf8_bin NOT NULL,
  `messCreationDate` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`id_message`),
  KEY `FK_message_user` (`user_id`) USING BTREE,
  KEY `FK_message_topic` (`topic_id`) USING BTREE,
  CONSTRAINT `FK_message_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `FK_message_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum.post : ~3 rows (environ)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
REPLACE INTO `post` (`id_message`, `message`, `messCreationDate`, `user_id`, `topic_id`) VALUES
	(1, 'Best episode ever !', '2022-03-21 14:55:10', 4, 1),
	(2, 'Stargate SG1', '2023-01-02 16:30:16', 4, 2),
	(3, 'Ah oui la trilogie du samedi ! ', '2023-01-02 16:32:58', 2, 2);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Listage de la structure de la table forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `creationdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id_topic`) USING BTREE,
  KEY `id_user` (`user_id`) USING BTREE,
  KEY `id_category` (`category_id`) USING BTREE,
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum.topic : ~2 rows (environ)
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
REPLACE INTO `topic` (`id_topic`, `title`, `creationdate`, `user_id`, `category_id`) VALUES
	(1, 'Review SNK 4x27', '2022-03-20 09:36:25', 2, 4),
	(2, 'Recommandation', '2022-12-31 14:11:58', 3, 2);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;

-- Listage de la structure de la table forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(250) COLLATE utf8_bin NOT NULL,
  `mail` varchar(250) COLLATE utf8_bin NOT NULL,
  `registerDate` date NOT NULL,
  `password` varchar(250) COLLATE utf8_bin NOT NULL,
  `role` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum.user : ~4 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id_user`, `pseudo`, `mail`, `registerDate`, `password`, `role`) VALUES
	(1, 'matt34', 'm.sappin@xxx.com', '2020-01-01', '0000', NULL),
	(2, 'patrick', 'p.smith@xxx.com', '2023-04-03', '0000', NULL),
	(3, 'lola45lo', 'dpjane@xxxx.com', '2020-05-13', '0000', NULL),
	(4, 'nameless', 'pisara@xxxx.com', '2018-12-06', '0000', NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
