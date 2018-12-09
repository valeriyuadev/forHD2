# SQL Manager for MySQL 5.5.1.45563
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : yii2basic


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

SET FOREIGN_KEY_CHECKS=0;

DROP DATABASE IF EXISTS `yii2basic`;

CREATE DATABASE `yii2basic`
    CHARACTER SET 'utf8'
    COLLATE 'utf8_general_ci';

USE `yii2basic`;

#
# Structure for the `bonuses` table : 
#

CREATE TABLE `bonuses` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `title` CHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  `total` INTEGER(11) DEFAULT NULL,
  `user` INTEGER(11) NOT NULL,
  `done` TINYINT(4) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user` (`user`) USING BTREE,
  CONSTRAINT `bonuses_fk1` FOREIGN KEY (`user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=5 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

#
# Structure for the `user` table : 
#

CREATE TABLE `user` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` VARCHAR(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adress` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_request_url` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_response_url` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` SMALLINT(6) NOT NULL DEFAULT 10,
  `created_at` INTEGER(11) NOT NULL,
  `updated_at` INTEGER(11) NOT NULL,
  `password_hash` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `password_reset_token` (`password_reset_token`) USING BTREE
) ENGINE=InnoDB
AUTO_INCREMENT=3 CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci'
;

#
# Structure for the `cash` table : 
#

CREATE TABLE `cash` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `title` CHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  `total` INTEGER(11) DEFAULT NULL,
  `user` INTEGER(11) NOT NULL,
  `done` TINYINT(4) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user` (`user`) USING BTREE,
  CONSTRAINT `cash_fk1` FOREIGN KEY (`user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=13 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

#
# Structure for the `gifts` table : 
#

CREATE TABLE `gifts` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `title` CHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  `total` INTEGER(11) DEFAULT NULL,
  `user` INTEGER(11) NOT NULL,
  `done` TINYINT(4) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user` (`user`) USING BTREE,
  CONSTRAINT `gifts_fk1` FOREIGN KEY (`user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=9 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

#
# Structure for the `promotion` table : 
#

CREATE TABLE `promotion` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `type` CHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  `total` INTEGER(11) DEFAULT NULL,
  `lookup` CHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB
AUTO_INCREMENT=4 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

#
# Data for the `bonuses` table  (LIMIT 0,500)
#

INSERT INTO `bonuses` (`id`, `title`, `total`, `user`, `done`) VALUES
  (1,'Mamaaaa',20,2,NULL),
  (2,'Mamaaaa',20,2,NULL),
  (3,'Urrrraaa',33,2,NULL),
  (4,'Urrrraaa',33,1,NULL);
COMMIT;

#
# Data for the `user` table  (LIMIT 0,500)
#

INSERT INTO `user` (`id`, `username`, `auth_key`, `email`, `adress`, `bank_account`, `bank_request_url`, `bank_response_url`, `status`, `created_at`, `updated_at`, `password_hash`, `password_reset_token`) VALUES
  (1,'1','QhAWwmybMDoIySbbBg9igSaA7kpO3vBs','1@user.ua','Польша, г. Люблин, ул. Нарутовича, 10','2222222222','http://homo/index.php?r=bank/request','http://homo/index.php?r=bank/response',10,1544265336,1544265336,'$2y$13$4R3eIKJM2YciKCu9B8op..9LQW875BF9NPQrD4sZjwAasoNAswgk.',NULL),
  (2,'2','65GHgymbbeMdvIz_HLWkGpMiNKubESmo','2@user.ua','Украина, г. Херсон, ул. Адмирала Ушакова, 16','1111111111','http://homo/index.php?r=bank/request','http://homo/index.php?r=bank/response',10,1544265336,1544265336,'$2y$13$.CRuI8162QkGiT5ZcpBebePjKSGTe88W5ND1F47q.ynPKLxcIalqK',NULL);
COMMIT;

#
# Data for the `cash` table  (LIMIT 0,500)
#

INSERT INTO `cash` (`id`, `title`, `total`, `user`, `done`) VALUES
  (2,'Hohohoh',1,1,1),
  (3,'Hohohoh',11,2,1),
  (4,'Hohohoh',11,1,1),
  (5,'Hohohoh',11,2,1),
  (6,'Hohohoh',11,1,1),
  (7,'Hohohoh',11,1,1),
  (8,'Hohohoh',11,2,1),
  (9,'Hohohoh',11,2,1),
  (10,'Urrrraaa',11,1,1),
  (11,'Urrrraaa',11,1,1),
  (12,'Urrrraaa',11,2,1);
COMMIT;

#
# Data for the `gifts` table  (LIMIT 0,500)
#

INSERT INTO `gifts` (`id`, `title`, `total`, `user`, `done`) VALUES
  (1,'Hohohoh',1,1,NULL),
  (2,'Hohohoh',1,2,NULL),
  (3,'Hohohoh',1,2,NULL),
  (4,'Hohohoh',1,2,NULL),
  (5,'Hohohoh',1,2,NULL),
  (6,'Hohohoh',1,2,NULL),
  (7,'Hohohoh',1,2,NULL),
  (8,'Hohohoh',1,2,NULL);
COMMIT;

#
# Data for the `promotion` table  (LIMIT 0,500)
#

INSERT INTO `promotion` (`id`, `type`, `total`, `lookup`) VALUES
  (1,'Cash',44,NULL),
  (2,'Gift',3,'prizes_names'),
  (3,'Bonus',1,'bonuses_names');
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;