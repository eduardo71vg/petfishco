# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.7.22)
# Database: phalcondb
# Generation Time: 2018-07-13 08:35:59 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table aquarium
# ------------------------------------------------------------

DROP TABLE IF EXISTS `aquarium`;

CREATE TABLE `aquarium` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `capacity` int(11) DEFAULT NULL,
  `aquarium_shape_id` int(11) NOT NULL,
  `aquarium_material_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`,`aquarium_shape_id`,`aquarium_material_id`),
  KEY `fk_aquarium_aquarium_shape1_idx` (`aquarium_shape_id`),
  KEY `fk_aquarium_acquarium_material1_idx` (`aquarium_material_id`),
  CONSTRAINT `fk_aquarium_acquarium_material10` FOREIGN KEY (`aquarium_material_id`) REFERENCES `aquarium_material` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_aquarium_aquarium_shape10` FOREIGN KEY (`aquarium_shape_id`) REFERENCES `aquarium_shape` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `aquarium` WRITE;
/*!40000 ALTER TABLE `aquarium` DISABLE KEYS */;

INSERT INTO `aquarium` (`id`, `capacity`, `aquarium_shape_id`, `aquarium_material_id`, `created_at`, `deleted`)
VALUES
	(1,1900,1,1,'2018-07-11 22:12:42',0),
	(2,3000,4,4,'2018-07-11 22:13:11',0);

/*!40000 ALTER TABLE `aquarium` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table aquarium_has_fish
# ------------------------------------------------------------

DROP TABLE IF EXISTS `aquarium_has_fish`;

CREATE TABLE `aquarium_has_fish` (
  `aquarium_instance_id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `fish_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stock` int(11) DEFAULT '0',
  PRIMARY KEY (`aquarium_instance_id`,`shop_id`,`fish_id`),
  KEY `fk_aquarium_instance_has_fish_fish_idx` (`fish_id`),
  KEY `fk_aquarium_instance_has_fish_aquarium_idx` (`aquarium_instance_id`,`shop_id`),
  CONSTRAINT `fk_pfc_aquarium_has_pfc_fish_pfc_aquarium10` FOREIGN KEY (`aquarium_instance_id`, `shop_id`) REFERENCES `aquarium_instance` (`id`, `shop_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pfc_aquarium_has_pfc_fish_pfc_fish10` FOREIGN KEY (`fish_id`) REFERENCES `fish` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `aquarium_has_fish` WRITE;
/*!40000 ALTER TABLE `aquarium_has_fish` DISABLE KEYS */;

INSERT INTO `aquarium_has_fish` (`aquarium_instance_id`, `shop_id`, `fish_id`, `created_at`, `stock`)
VALUES
	(1,1,1,'2018-07-12 07:02:25',10),
	(1,1,11,'2018-07-12 15:54:15',5),
	(1,1,23,'2018-07-12 16:13:59',15),
	(1,1,24,'2018-07-12 16:14:14',5),
	(1,1,25,'2018-07-12 16:15:16',1),
	(1,1,32,'2018-07-13 00:04:05',10),
	(1,1,33,'2018-07-13 00:07:55',2),
	(1,1,34,'2018-07-13 00:10:14',2),
	(1,1,35,'2018-07-13 00:10:42',2),
	(1,1,36,'2018-07-13 00:10:45',2),
	(1,1,37,'2018-07-13 00:14:30',10),
	(2,2,26,'2018-07-12 16:15:47',15),
	(2,2,28,'2018-07-12 18:10:21',1),
	(3,1,27,'2018-07-12 18:07:02',1);

/*!40000 ALTER TABLE `aquarium_has_fish` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table aquarium_instance
# ------------------------------------------------------------

DROP TABLE IF EXISTS `aquarium_instance`;

CREATE TABLE `aquarium_instance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` varchar(45) DEFAULT '0',
  `shop_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `aquarium_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`shop_id`,`aquarium_id`),
  KEY `fk_aquarium_shop_idx` (`shop_id`),
  KEY `fk_aquarium_instance_aquarium1_idx` (`aquarium_id`),
  CONSTRAINT `fk_aquarium_instance_aquarium1` FOREIGN KEY (`aquarium_id`) REFERENCES `aquarium` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pfc_aquarium_pfc_shop10` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `aquarium_instance` WRITE;
/*!40000 ALTER TABLE `aquarium_instance` DISABLE KEYS */;

INSERT INTO `aquarium_instance` (`id`, `amount`, `shop_id`, `created_at`, `updated_at`, `aquarium_id`)
VALUES
	(1,'5',1,'2018-07-11 22:13:40',NULL,1),
	(2,'5',2,'2018-07-11 22:14:10',NULL,1),
	(3,'1',1,'2018-07-11 22:14:56',NULL,2);

/*!40000 ALTER TABLE `aquarium_instance` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table aquarium_material
# ------------------------------------------------------------

DROP TABLE IF EXISTS `aquarium_material`;

CREATE TABLE `aquarium_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `aquarium_material` WRITE;
/*!40000 ALTER TABLE `aquarium_material` DISABLE KEYS */;

INSERT INTO `aquarium_material` (`id`, `name`, `created_at`, `deleted`)
VALUES
	(1,'Acrylic','2018-07-08 21:29:50',0),
	(2,'Laminated glass','2018-07-08 21:29:53',0),
	(3,'Glass','2018-07-08 21:29:58',0),
	(4,'Flexiglass','2018-07-08 21:30:02',0);

/*!40000 ALTER TABLE `aquarium_material` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table aquarium_shape
# ------------------------------------------------------------

DROP TABLE IF EXISTS `aquarium_shape`;

CREATE TABLE `aquarium_shape` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `aquarium_shape` WRITE;
/*!40000 ALTER TABLE `aquarium_shape` DISABLE KEYS */;

INSERT INTO `aquarium_shape` (`id`, `name`, `created_at`, `deleted`)
VALUES
	(1,'Cuboid','2018-07-08 21:25:24',0),
	(2,'Hexagonal','2018-07-08 21:25:24',0),
	(3,'L-shaped','2018-07-08 21:25:24',0),
	(4,'Bow-Front','2018-07-08 21:25:24',0);

/*!40000 ALTER TABLE `aquarium_shape` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fish
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fish`;

CREATE TABLE `fish` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `fins` tinyint(4) DEFAULT NULL,
  `fish_specie_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_fish_fish_type_idx` (`fish_specie_id`),
  CONSTRAINT `fk_pfc_fish_pfc_fish_type10` FOREIGN KEY (`fish_specie_id`) REFERENCES `fish_specie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `fish` WRITE;
/*!40000 ALTER TABLE `fish` DISABLE KEYS */;

INSERT INTO `fish` (`id`, `alias`, `color`, `fins`, `fish_specie_id`, `created_at`, `deleted`)
VALUES
	(1,'Nemo','#ccc\n',5,1,'2018-07-12 07:00:59',0),
	(2,'MOMO','black',5,1,'2018-07-12 15:04:31',0),
	(3,'MOMO','black',5,1,'2018-07-12 15:23:41',0),
	(4,'MOMO','black',5,1,'2018-07-12 15:27:22',0),
	(5,'MOMO','black',5,1,'2018-07-12 15:36:04',0),
	(6,'MOMO','black',5,1,'2018-07-12 15:36:26',0),
	(7,'MOMO','black',5,1,'2018-07-12 15:36:58',0),
	(8,'MOMO','black',5,1,'2018-07-12 15:37:08',0),
	(9,'MOMO','black',5,1,'2018-07-12 15:37:57',0),
	(10,'MOMO','black',5,1,'2018-07-12 15:38:07',0),
	(11,'MOMO','black',5,1,'2018-07-12 15:54:15',0),
	(23,'Momo','red',5,1,'2018-07-12 16:13:59',0),
	(24,'Momo','red',5,1,'2018-07-12 16:14:14',0),
	(25,'Momo','blue',10,1,'2018-07-12 16:15:16',0),
	(26,'Puka','pink',2,3,'2018-07-12 16:15:47',0),
	(27,'Tonini','red',10,1,'2018-07-12 18:07:02',0),
	(28,'Puka','blue',3,1,'2018-07-12 18:10:21',0),
	(32,'MOMO','black',1,3,'2018-07-13 00:04:05',0),
	(33,'x','blue',2,1,'2018-07-13 00:07:55',0),
	(34,'x','blue',2,1,'2018-07-13 00:10:14',0),
	(35,'x','blue',2,1,'2018-07-13 00:10:42',0),
	(36,'x','blue',2,3,'2018-07-13 00:10:44',0),
	(37,'y','blu',2,3,'2018-07-13 00:14:30',0);

/*!40000 ALTER TABLE `fish` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fish_specie
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fish_specie`;

CREATE TABLE `fish_specie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `fish_specie` WRITE;
/*!40000 ALTER TABLE `fish_specie` DISABLE KEYS */;

INSERT INTO `fish_specie` (`id`, `name`, `created_at`, `deleted`)
VALUES
	(1,'guppie','2018-07-08 21:30:40',0),
	(2,'goldfish','2018-07-08 21:30:48',0),
	(3,'clown','2018-07-12 23:58:10',0);

/*!40000 ALTER TABLE `fish_specie` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table session_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `session_data`;

CREATE TABLE `session_data` (
  `session_id` varchar(35) NOT NULL,
  `data` text NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  `modified_at` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `session_data` WRITE;
/*!40000 ALTER TABLE `session_data` DISABLE KEYS */;

INSERT INTO `session_data` (`session_id`, `data`, `created_at`, `modified_at`)
VALUES
	('0glitbua4mlsiomhdnselpfde6','catalogs|a:3:{s:9:\"materials\";a:4:{i:0;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:7:\"Acrylic\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:50\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:15:\"Laminated glass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:53\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:5:\"Glass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:58\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:3;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"4\";s:7:\"\0*\0name\";s:10:\"Flexiglass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:02\";s:10:\"\0*\0deleted\";s:1:\"0\";}}s:6:\"shapes\";a:4:{i:0;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:6:\"Cuboid\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:9:\"Hexagonal\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:8:\"L-shaped\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:3;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"4\";s:7:\"\0*\0name\";s:9:\"Bow-Front\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}}s:7:\"species\";a:3:{i:0;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:6:\"guppie\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:40\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:8:\"goldfish\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:48\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:5:\"clown\";s:13:\"\0*\0created_at\";s:19:\"2018-07-12 23:58:10\";s:10:\"\0*\0deleted\";s:1:\"0\";}}}',1531465721,NULL),
	('17p5ttbsfu4m59u3faf12eibp5','catalogs|a:3:{s:9:\"materials\";a:4:{i:0;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:7:\"Acrylic\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:50\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:15:\"Laminated glass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:53\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:5:\"Glass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:58\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:3;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"4\";s:7:\"\0*\0name\";s:10:\"Flexiglass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:02\";s:10:\"\0*\0deleted\";s:1:\"0\";}}s:6:\"shapes\";a:4:{i:0;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:6:\"Cuboid\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:9:\"Hexagonal\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:8:\"L-shaped\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:3;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"4\";s:7:\"\0*\0name\";s:9:\"Bow-Front\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}}s:7:\"species\";a:3:{i:0;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:6:\"guppie\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:40\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:8:\"goldfish\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:48\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:5:\"clown\";s:13:\"\0*\0created_at\";s:19:\"2018-07-12 23:58:10\";s:10:\"\0*\0deleted\";s:1:\"0\";}}}',1531462809,NULL),
	('2c4ovtapllf7glajf3hjemhnr2','catalogs|a:3:{s:9:\"materials\";a:4:{i:0;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:7:\"Acrylic\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:50\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:15:\"Laminated glass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:53\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:5:\"Glass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:58\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:3;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"4\";s:7:\"\0*\0name\";s:10:\"Flexiglass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:02\";s:10:\"\0*\0deleted\";s:1:\"0\";}}s:6:\"shapes\";a:4:{i:0;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:6:\"Cuboid\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:9:\"Hexagonal\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:8:\"L-shaped\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:3;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"4\";s:7:\"\0*\0name\";s:9:\"Bow-Front\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}}s:7:\"species\";a:3:{i:0;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:6:\"guppie\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:40\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:8:\"goldfish\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:48\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:5:\"clown\";s:13:\"\0*\0created_at\";s:19:\"2018-07-12 23:58:10\";s:10:\"\0*\0deleted\";s:1:\"0\";}}}',1531464104,NULL),
	('dqtopoa4jn4nfrhf9mvdk0ace3','catalogs|a:3:{s:9:\"materials\";a:4:{i:0;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:7:\"Acrylic\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:50\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:15:\"Laminated glass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:53\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:5:\"Glass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:58\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:3;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"4\";s:7:\"\0*\0name\";s:10:\"Flexiglass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:02\";s:10:\"\0*\0deleted\";s:1:\"0\";}}s:6:\"shapes\";a:4:{i:0;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:6:\"Cuboid\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:9:\"Hexagonal\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:8:\"L-shaped\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:3;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"4\";s:7:\"\0*\0name\";s:9:\"Bow-Front\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}}s:7:\"species\";a:3:{i:0;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:6:\"guppie\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:40\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:8:\"goldfish\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:48\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:5:\"clown\";s:13:\"\0*\0created_at\";s:19:\"2018-07-12 23:58:10\";s:10:\"\0*\0deleted\";s:1:\"0\";}}}',1531441846,NULL),
	('gienbe8g63u1rkak8buas4pmt3','catalogs|a:3:{s:9:\"materials\";a:4:{i:0;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:7:\"Acrylic\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:50\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:15:\"Laminated glass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:53\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:5:\"Glass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:58\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:3;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"4\";s:7:\"\0*\0name\";s:10:\"Flexiglass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:02\";s:10:\"\0*\0deleted\";s:1:\"0\";}}s:6:\"shapes\";a:4:{i:0;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:6:\"Cuboid\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:9:\"Hexagonal\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:8:\"L-shaped\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:3;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"4\";s:7:\"\0*\0name\";s:9:\"Bow-Front\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}}s:7:\"species\";a:3:{i:0;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:6:\"guppie\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:40\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:8:\"goldfish\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:48\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:5:\"clown\";s:13:\"\0*\0created_at\";s:19:\"2018-07-12 23:58:10\";s:10:\"\0*\0deleted\";s:1:\"0\";}}}shop|O:34:\"PetFishCo\\Frontend\\Models\\DTO\\Shop\":5:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:11:\"Netherlands\";s:17:\"\0*\0measure_system\";s:1:\"D\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:27:03\";s:10:\"\0*\0deleted\";s:1:\"0\";}',1531439236,1531466143),
	('up684f091f3ct4h6p3u69b5cd6','catalogs|a:3:{s:9:\"materials\";a:4:{i:0;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:7:\"Acrylic\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:50\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:15:\"Laminated glass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:53\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:5:\"Glass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:58\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:3;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"4\";s:7:\"\0*\0name\";s:10:\"Flexiglass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:02\";s:10:\"\0*\0deleted\";s:1:\"0\";}}s:6:\"shapes\";a:4:{i:0;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:6:\"Cuboid\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:9:\"Hexagonal\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:8:\"L-shaped\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:3;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"4\";s:7:\"\0*\0name\";s:9:\"Bow-Front\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}}s:7:\"species\";a:2:{i:0;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:6:\"guppie\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:40\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:8:\"goldfish\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:48\";s:10:\"\0*\0deleted\";s:1:\"0\";}}}',1531439696,NULL),
	('ushl803hrpaa1ccet88sv4ojv3','catalogs|a:3:{s:9:\"materials\";a:4:{i:0;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:7:\"Acrylic\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:50\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:15:\"Laminated glass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:53\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:5:\"Glass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:29:58\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:3;O:46:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumMaterial\":4:{s:5:\"\0*\0id\";s:1:\"4\";s:7:\"\0*\0name\";s:10:\"Flexiglass\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:02\";s:10:\"\0*\0deleted\";s:1:\"0\";}}s:6:\"shapes\";a:4:{i:0;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:6:\"Cuboid\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:9:\"Hexagonal\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:8:\"L-shaped\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:3;O:43:\"PetFishCo\\Frontend\\Models\\DTO\\AquariumShape\":4:{s:5:\"\0*\0id\";s:1:\"4\";s:7:\"\0*\0name\";s:9:\"Bow-Front\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:25:24\";s:10:\"\0*\0deleted\";s:1:\"0\";}}s:7:\"species\";a:3:{i:0;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"1\";s:7:\"\0*\0name\";s:6:\"guppie\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:40\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:1;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"2\";s:7:\"\0*\0name\";s:8:\"goldfish\";s:13:\"\0*\0created_at\";s:19:\"2018-07-08 21:30:48\";s:10:\"\0*\0deleted\";s:1:\"0\";}i:2;O:40:\"PetFishCo\\Frontend\\Models\\DTO\\FishSpecie\":4:{s:5:\"\0*\0id\";s:1:\"3\";s:7:\"\0*\0name\";s:5:\"clown\";s:13:\"\0*\0created_at\";s:19:\"2018-07-12 23:58:10\";s:10:\"\0*\0deleted\";s:1:\"0\";}}}',1531440276,NULL);

/*!40000 ALTER TABLE `session_data` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shop
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shop`;

CREATE TABLE `shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `measure_system` char(1) DEFAULT 'D' COMMENT 'Imperial or Decimal',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `shop` WRITE;
/*!40000 ALTER TABLE `shop` DISABLE KEYS */;

INSERT INTO `shop` (`id`, `name`, `measure_system`, `created_at`, `deleted`)
VALUES
	(1,'Netherlands','D','2018-07-08 21:27:03',0),
	(2,'United States','I','2018-07-12 23:47:08',0);

/*!40000 ALTER TABLE `shop` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
