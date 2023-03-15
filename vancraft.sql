-- MariaDB dump 10.19  Distrib 10.6.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: vancraft
-- ------------------------------------------------------
-- Server version	10.6.12-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text DEFAULT NULL,
  `answer_creation_date` datetime DEFAULT current_timestamp(),
  `votes` int(11) DEFAULT 0,
  `last_modification` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (13,'test 1','2023-03-15 14:34:53',0,'2023-03-15 14:34:53'),(14,'test 2','2023-03-15 14:35:00',0,'2023-03-15 14:35:00'),(15,'Test','2023-03-15 14:51:37',0,'2023-03-15 14:51:37'),(16,'Test','2023-03-15 14:52:10',0,'2023-03-15 14:52:10'),(17,'Test','2023-03-15 14:52:32',0,'2023-03-15 14:52:32'),(18,'test test','2023-03-15 14:52:53',0,'2023-03-15 14:52:53'),(19,'test','2023-03-15 15:01:56',0,'2023-03-15 15:01:56'),(20,'test','2023-03-15 15:50:15',0,'2023-03-15 15:50:15'),(21,'test','2023-03-15 15:56:14',0,'2023-03-15 15:56:14'),(22,'test test avec plusieurs images','2023-03-15 15:56:30',0,'2023-03-15 15:56:30'),(23,'test test avec plusieurs images','2023-03-15 16:22:44',0,'2023-03-15 16:22:44'),(24,'test test avec plusieurs images','2023-03-15 16:23:50',0,'2023-03-15 16:23:50'),(25,'test test avec plusieurs images','2023-03-15 16:25:15',0,'2023-03-15 16:25:15'),(26,'test test avec plusieurs images','2023-03-15 16:26:59',0,'2023-03-15 16:26:59'),(27,'test test avec plusieurs images','2023-03-15 16:29:03',0,'2023-03-15 16:29:03'),(28,'test test avec plusieurs images','2023-03-15 16:29:51',0,'2023-03-15 16:29:51'),(29,'test test avec plusieurs images','2023-03-15 16:30:24',0,'2023-03-15 16:30:24'),(30,'test test avec plusieurs images','2023-03-15 16:31:11',0,'2023-03-15 16:31:11'),(31,'test test avec plusieurs images','2023-03-15 16:31:48',0,'2023-03-15 16:31:48'),(32,'Voila ma réponse ! Avec une photo','2023-03-15 16:32:53',0,'2023-03-15 16:32:53'),(33,'Et voila une autre réponse ! Avec deux photos ','2023-03-15 16:33:14',0,'2023-03-15 16:33:14'),(34,'Je suis ordinateur, je pose également une question.','2023-03-15 16:39:59',0,'2023-03-15 16:39:59'),(35,'Je fais un test de réponse, sans photo','2023-03-15 16:43:31',0,'2023-03-15 16:43:31'),(36,'Je fais un autre test de réponse, sans photo','2023-03-15 16:43:43',0,'2023-03-15 16:43:43'),(37,'Test !','2023-03-15 17:00:49',0,'2023-03-15 17:00:49'),(38,'Test !','2023-03-15 17:01:45',0,'2023-03-15 17:01:45'),(39,'Moulte test !','2023-03-15 17:03:15',0,'2023-03-15 17:03:15'),(40,'Hello !','2023-03-15 17:03:38',0,'2023-03-15 17:03:38'),(41,'Hello !','2023-03-15 17:04:27',0,'2023-03-15 17:04:27'),(42,'Hello !','2023-03-15 17:04:44',0,'2023-03-15 17:04:44'),(43,'Hello !','2023-03-15 17:05:54',0,'2023-03-15 17:05:54'),(44,'Helloooo','2023-03-15 17:06:11',0,'2023-03-15 17:06:11'),(45,'lololol','2023-03-15 17:06:22',0,'2023-03-15 17:06:22'),(46,'lololol','2023-03-15 17:06:41',0,'2023-03-15 17:06:41'),(47,'test','2023-03-15 17:06:49',0,'2023-03-15 17:06:49');
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `answers_posts`
--

DROP TABLE IF EXISTS `answers_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `answer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `answer_id` (`answer_id`),
  CONSTRAINT `answers_posts_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  CONSTRAINT `answers_posts_ibfk_2` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`answer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers_posts`
--

LOCK TABLES `answers_posts` WRITE;
/*!40000 ALTER TABLE `answers_posts` DISABLE KEYS */;
INSERT INTO `answers_posts` VALUES (1,35,18),(2,35,19),(3,35,20),(4,35,21),(5,35,22),(6,35,23),(7,35,24),(8,35,25),(9,35,26),(10,35,27),(11,35,28),(12,35,29),(13,35,30),(14,35,31),(15,36,32),(16,36,33),(17,36,34),(18,36,35),(19,36,36),(20,36,41),(21,36,46),(22,36,47);
/*!40000 ALTER TABLE `answers_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorites_posts`
--

DROP TABLE IF EXISTS `favorites_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorites_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `favorites_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `favorites_posts_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites_posts`
--

LOCK TABLES `favorites_posts` WRITE;
/*!40000 ALTER TABLE `favorites_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorites_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images_answers`
--

DROP TABLE IF EXISTS `images_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images_answers` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `answer_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `answer_id` (`answer_id`),
  CONSTRAINT `images_answers_ibfk_1` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`answer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images_answers`
--

LOCK TABLES `images_answers` WRITE;
/*!40000 ALTER TABLE `images_answers` DISABLE KEYS */;
INSERT INTO `images_answers` VALUES (1,13,'boite6411c97ddc329.jpeg','assets/images/users/boite/answers_images/boite6411c97ddc329.jpeg'),(2,14,'boite6411c984d5fe5.jpeg','assets/images/users/boite/answers_images/boite6411c984d5fe5.jpeg'),(3,18,'boite6411cdb5a2aa4.jpeg','assets/images/users/boite/answers_images/boite6411cdb5a2aa4.jpeg'),(4,20,'boite6411db27be6f3.jpeg','assets/images/users/boite/answers_images/boite6411db27be6f3.jpeg'),(5,21,'boite6411dc8ea0867.jpeg','assets/images/users/boite/answers_images/boite6411dc8ea0867.jpeg'),(6,22,'boite6411dc9e19206.jpeg','assets/images/users/boite/answers_images/boite6411dc9e19206.jpeg'),(7,22,'boite6411dc9e1932f.jpeg','assets/images/users/boite/answers_images/boite6411dc9e1932f.jpeg'),(8,23,'boite6411e2c46d2ae.jpeg','assets/images/users/boite/answers_images/boite6411e2c46d2ae.jpeg'),(9,23,'boite6411e2c46d334.jpeg','assets/images/users/boite/answers_images/boite6411e2c46d334.jpeg'),(10,24,'boite6411e306bd04a.jpeg','assets/images/users/boite/answers_images/boite6411e306bd04a.jpeg'),(11,24,'boite6411e306bd110.jpeg','assets/images/users/boite/answers_images/boite6411e306bd110.jpeg'),(12,25,'boite6411e35bf2554.jpeg','assets/images/users/boite/answers_images/boite6411e35bf2554.jpeg'),(13,25,'boite6411e35bf25dd.jpeg','assets/images/users/boite/answers_images/boite6411e35bf25dd.jpeg'),(14,26,'boite6411e3c39e748.jpeg','assets/images/users/boite/answers_images/boite6411e3c39e748.jpeg'),(15,26,'boite6411e3c39e7cc.jpeg','assets/images/users/boite/answers_images/boite6411e3c39e7cc.jpeg'),(16,27,'boite6411e43f347ca.jpeg','assets/images/users/boite/answers_images/boite6411e43f347ca.jpeg'),(17,27,'boite6411e43f34864.jpeg','assets/images/users/boite/answers_images/boite6411e43f34864.jpeg'),(18,28,'boite6411e46f6cb5e.jpeg','assets/images/users/boite/answers_images/boite6411e46f6cb5e.jpeg'),(19,28,'boite6411e46f6cc18.jpeg','assets/images/users/boite/answers_images/boite6411e46f6cc18.jpeg'),(20,29,'boite6411e490a381f.jpeg','assets/images/users/boite/answers_images/boite6411e490a381f.jpeg'),(21,29,'boite6411e490a38b8.jpeg','assets/images/users/boite/answers_images/boite6411e490a38b8.jpeg'),(22,30,'boite6411e4bf3a240.jpeg','assets/images/users/boite/answers_images/boite6411e4bf3a240.jpeg'),(23,30,'boite6411e4bf3a2db.jpeg','assets/images/users/boite/answers_images/boite6411e4bf3a2db.jpeg'),(24,31,'boite6411e4e4bcd25.jpeg','assets/images/users/boite/answers_images/boite6411e4e4bcd25.jpeg'),(25,31,'boite6411e4e4bcdcb.jpeg','assets/images/users/boite/answers_images/boite6411e4e4bcdcb.jpeg'),(26,32,'boite6411e5255f9cd.jpeg','assets/images/users/boite/answers_images/boite6411e5255f9cd.jpeg'),(27,33,'boite6411e53a511bf.png','assets/images/users/boite/answers_images/boite6411e53a511bf.png'),(28,33,'boite6411e53a5126b.png','assets/images/users/boite/answers_images/boite6411e53a5126b.png'),(29,34,'ordinateur6411e6cf06cd4.jpeg','assets/images/users/ordinateur/answers_images/ordinateur6411e6cf06cd4.jpeg');
/*!40000 ALTER TABLE `images_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images_posts`
--

DROP TABLE IF EXISTS `images_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images_posts` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `images_posts_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images_posts`
--

LOCK TABLES `images_posts` WRITE;
/*!40000 ALTER TABLE `images_posts` DISABLE KEYS */;
INSERT INTO `images_posts` VALUES (33,35,'boite64106eb3c8b6d.jpeg','assets/images/users/boite/posts_images/boite64106eb3c8b6d.jpeg'),(34,36,'boite6411e5124fa4f.jpeg','assets/images/users/boite/posts_images/boite6411e5124fa4f.jpeg');
/*!40000 ALTER TABLE `images_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images_profiles`
--

DROP TABLE IF EXISTS `images_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images_profiles` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `image_url_sm` varchar(255) NOT NULL DEFAULT 'default/profile_images/1.jpg',
  `image_url_lg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `images_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images_profiles`
--

LOCK TABLES `images_profiles` WRITE;
/*!40000 ALTER TABLE `images_profiles` DISABLE KEYS */;
INSERT INTO `images_profiles` VALUES (8,8,'default/profile_images/1.jpg',NULL),(9,9,'default/profile_images/1.jpg',NULL),(10,10,'default/profile_images/1.jpg',NULL);
/*!40000 ALTER TABLE `images_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medals`
--

DROP TABLE IF EXISTS `medals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bronze_medal` int(11) DEFAULT 0,
  `silver_medal` int(11) DEFAULT 0,
  `gold_medal` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `medals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medals`
--

LOCK TABLES `medals` WRITE;
/*!40000 ALTER TABLE `medals` DISABLE KEYS */;
/*!40000 ALTER TABLE `medals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(496) NOT NULL,
  `creation_date` datetime DEFAULT current_timestamp(),
  `views` int(11) NOT NULL DEFAULT 0,
  `votes` int(11) NOT NULL DEFAULT 0,
  `content` text NOT NULL,
  `last_modification` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `answers` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (35,'Je fais un test d\'attaque XSS : window.alert(\"hello\");','2023-03-14 13:55:15',0,0,'Hello Je m\'appelle Axel','2023-03-15 17:03:15',3),(36,'Voila une nouvelle fraiche question de test','2023-03-15 16:32:34',0,0,'hello !','2023-03-15 17:06:22',5);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_tags`
--

DROP TABLE IF EXISTS `posts_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `posts_tags_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  CONSTRAINT `posts_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_tags`
--

LOCK TABLES `posts_tags` WRITE;
/*!40000 ALTER TABLE `posts_tags` DISABLE KEYS */;
INSERT INTO `posts_tags` VALUES (41,35,16),(42,36,16);
/*!40000 ALTER TABLE `posts_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_users`
--

DROP TABLE IF EXISTS `posts_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `posts_users_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  CONSTRAINT `posts_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_users`
--

LOCK TABLES `posts_users` WRITE;
/*!40000 ALTER TABLE `posts_users` DISABLE KEYS */;
INSERT INTO `posts_users` VALUES (34,35,8),(35,36,8);
/*!40000 ALTER TABLE `posts_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`tag_id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (15,'armaflex',NULL),(16,'test',NULL),(17,'premier',NULL),(18,'deuxieme',NULL),(19,'troisieme',NULL),(20,'quatrieme',NULL),(21,'cinquieme',NULL);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(24) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `account_creation_date` datetime DEFAULT current_timestamp(),
  `password` varchar(128) NOT NULL,
  `last_connexion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `numbers_of_answers` int(11) NOT NULL DEFAULT 0,
  `numbers_of_questions` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (8,'boite','boite@example.com','2023-03-13 16:55:02','$2y$10$ZwTgkkI/GhHJ2KGx83ikjetepWuMLQuhrzy/rEB/uX8jdReBEdYZO','2023-03-13 16:55:02',0,0),(9,'carpette','carpette@example.com','2023-03-14 09:26:56','$2y$10$IBOouJB0/gHfM.j6iN5Iuui.6gWtlb08t/AwnXvQRfV7E3bV0BPMO','2023-03-14 09:26:56',0,0),(10,'ordinateur','ordinateur@example.com','2023-03-15 16:39:05','$2y$10$Sc18In59KnWmLGDubdfJzuaqA4Y/hNtbIyLTo2l35bConupZKtZRy','2023-03-15 16:39:05',0,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_answers`
--

DROP TABLE IF EXISTS `users_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `answer_id` (`answer_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `users_answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `users_answers_ibfk_2` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`answer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_answers`
--

LOCK TABLES `users_answers` WRITE;
/*!40000 ALTER TABLE `users_answers` DISABLE KEYS */;
INSERT INTO `users_answers` VALUES (3,8,13),(4,8,14),(5,8,18),(6,8,19),(7,8,20),(8,8,21),(9,8,22),(10,8,23),(11,8,24),(12,8,25),(13,8,26),(14,8,27),(15,8,28),(16,8,29),(17,8,30),(18,8,31),(19,8,32),(20,8,33),(21,10,34),(22,10,35),(23,10,36),(26,10,41),(31,10,46),(32,10,47);
/*!40000 ALTER TABLE `users_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_config`
--

DROP TABLE IF EXISTS `users_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `best_post` int(11) DEFAULT NULL,
  `about` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `best_post` (`best_post`),
  CONSTRAINT `users_config_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `users_config_ibfk_2` FOREIGN KEY (`best_post`) REFERENCES `posts` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_config`
--

LOCK TABLES `users_config` WRITE;
/*!40000 ALTER TABLE `users_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_config` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-15 17:08:07
