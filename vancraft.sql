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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (13,'test 1','2023-03-15 14:34:53',0,'2023-03-15 14:34:53'),(14,'test 2','2023-03-15 14:35:00',0,'2023-03-15 14:35:00'),(15,'Test','2023-03-15 14:51:37',0,'2023-03-15 14:51:37'),(16,'Test','2023-03-15 14:52:10',0,'2023-03-15 14:52:10'),(17,'Test','2023-03-15 14:52:32',0,'2023-03-15 14:52:32'),(18,'test test','2023-03-15 14:52:53',0,'2023-03-15 14:52:53');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers_posts`
--

LOCK TABLES `answers_posts` WRITE;
/*!40000 ALTER TABLE `answers_posts` DISABLE KEYS */;
INSERT INTO `answers_posts` VALUES (1,35,18);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images_answers`
--

LOCK TABLES `images_answers` WRITE;
/*!40000 ALTER TABLE `images_answers` DISABLE KEYS */;
INSERT INTO `images_answers` VALUES (1,13,'boite6411c97ddc329.jpeg','assets/images/users/boite/answers_images/boite6411c97ddc329.jpeg'),(2,14,'boite6411c984d5fe5.jpeg','assets/images/users/boite/answers_images/boite6411c984d5fe5.jpeg'),(3,18,'boite6411cdb5a2aa4.jpeg','assets/images/users/boite/answers_images/boite6411cdb5a2aa4.jpeg');
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images_posts`
--

LOCK TABLES `images_posts` WRITE;
/*!40000 ALTER TABLE `images_posts` DISABLE KEYS */;
INSERT INTO `images_posts` VALUES (33,35,'boite64106eb3c8b6d.jpeg','assets/images/users/boite/posts_images/boite64106eb3c8b6d.jpeg');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images_profiles`
--

LOCK TABLES `images_profiles` WRITE;
/*!40000 ALTER TABLE `images_profiles` DISABLE KEYS */;
INSERT INTO `images_profiles` VALUES (8,8,'default/profile_images/1.jpg',NULL),(9,9,'default/profile_images/1.jpg',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (35,'Je fais un test d\'attaque XSS : window.alert(\"hello\");','2023-03-14 13:55:15',0,0,'Hello Je m\'appelle Axel','2023-03-14 13:55:15',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_tags`
--

LOCK TABLES `posts_tags` WRITE;
/*!40000 ALTER TABLE `posts_tags` DISABLE KEYS */;
INSERT INTO `posts_tags` VALUES (41,35,16);
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_users`
--

LOCK TABLES `posts_users` WRITE;
/*!40000 ALTER TABLE `posts_users` DISABLE KEYS */;
INSERT INTO `posts_users` VALUES (34,35,8);
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (8,'boite','boite@example.com','2023-03-13 16:55:02','$2y$10$ZwTgkkI/GhHJ2KGx83ikjetepWuMLQuhrzy/rEB/uX8jdReBEdYZO','2023-03-13 16:55:02',0,0),(9,'carpette','carpette@example.com','2023-03-14 09:26:56','$2y$10$IBOouJB0/gHfM.j6iN5Iuui.6gWtlb08t/AwnXvQRfV7E3bV0BPMO','2023-03-14 09:26:56',0,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_answers`
--

LOCK TABLES `users_answers` WRITE;
/*!40000 ALTER TABLE `users_answers` DISABLE KEYS */;
INSERT INTO `users_answers` VALUES (3,8,13),(4,8,14),(5,8,18);
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

-- Dump completed on 2023-03-15 14:54:09
