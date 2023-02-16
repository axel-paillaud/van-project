-- MariaDB dump 10.19  Distrib 10.6.11-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: vancraft
-- ------------------------------------------------------
-- Server version	10.6.11-MariaDB-0ubuntu0.22.04.1

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
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
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `answer_id` (`answer_id`),
  CONSTRAINT `images_answers_ibfk_1` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images_answers`
--

LOCK TABLES `images_answers` WRITE;
/*!40000 ALTER TABLE `images_answers` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images_posts`
--

LOCK TABLES `images_posts` WRITE;
/*!40000 ALTER TABLE `images_posts` DISABLE KEYS */;
INSERT INTO `images_posts` VALUES (12,22,'boite63ee17dab86c8.png','assets/images/users/boite/posts_images/boite63ee17dab86c8.png');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images_profiles`
--

LOCK TABLES `images_profiles` WRITE;
/*!40000 ALTER TABLE `images_profiles` DISABLE KEYS */;
INSERT INTO `images_profiles` VALUES (1,1,'shaun/profile_images/1.jpg',NULL),(2,2,'leila/profile_images/1.jpg',NULL),(3,3,'quentin/profile_images/1.jpg',NULL),(4,4,'anne/profile_images/1.jpg',NULL),(5,5,'default/profile_images/1.jpg',NULL),(6,6,'default/profile_images/1.jpg',NULL),(7,7,'default/profile_images/1.jpg',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Pourquoi le choix de l\'armaflex est judicieux face à de la laine de verre','2022-10-04 10:04:18',10,4,'Y-a t\'il un réel gain de performance d\'isolation en partant sur de l\'armaflex plutôt que de la laine de verre ? J\'ai des difficultées à positionner la laine de verre par endroit (voir photo) et je pense partir sur de l\'armaflex pour mon prochain véhicule.','2022-10-04 11:33:38',0),(2,'Quel chauffage pour un fourgon Jumper L3 H2','2022-10-04 10:11:57',5,-2,'Bonjour, j\'hésite entre deux chauffages, le chinasto et le webasto. Lequel me conseillez vous ?','2022-10-04 11:33:31',0),(3,'Le liège projeté n\'adhère pas à mes parois','2022-10-04 11:29:37',14,8,'Bonjour, je n\'arrive pas à faire adhérer correctement le liège projeté à mes parois. J\'ai utilisé de la colle BOSTIK avec une granulométrie de 36. Mes parois sont en tôle peinte.','2022-10-04 11:29:37',0),(4,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultricies, neque quis sagittis finibus, leo mi consectetur lorem, ac interdum lectus nibh fringilla magna. Nam non interdum ligula. Aenean rhoncus massa varius, semper nibh vel, volutpat dui. Nam id urna nibh. Curabitur cursus vulputate orci, nec imperdiet mi varius in. Donec ornare suscipit felis ut condimentum. ','2022-10-11 21:19:42',23,9,' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultricies, neque quis sagittis finibus, leo mi consectetur lorem, ac interdum lectus nibh fringilla magna. Nam non interdum ligula. Aenean rhoncus massa varius, semper nibh vel, volutpat dui. Nam id urna nibh. Curabitur cursus vulputate orci, nec imperdiet mi varius in. Donec ornare suscipit felis ut condimentum. Pellentesque tincidunt ante nisi, at porta dolor pretium sed. Praesent mattis lorem nec dolor venenatis consequat. Nulla facilisi. Praesent dapibus congue metus et condimentum. Mauris condimentum magna augue, ac elementum augue consectetur non. Maecenas at tempor velit.\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vitae lorem auctor, sollicitudin magna eu, blandit diam. Nunc efficitur mi vitae ipsum mollis, at imperdiet quam vestibulum. Duis malesuada erat in magna pharetra, pellentesque posuere libero venenatis. Proin feugiat elit nulla, ut dictum nulla iaculis eu. Morbi at tellus rhoncus, sodales magna quis, lacinia diam. Suspendisse vel tempus nisl, et placerat libero. Nulla malesuada ex nulla, vitae vehicula enim suscipit ut. Ut orci purus, ornare egestas sapien in, mollis ultrices massa. ','2022-10-11 21:19:42',0),(22,'Encore un post de &lt;b&gt;test&lt;/b&lt;','2023-02-16 12:47:38',0,0,'Un autre admin passe par ici @@@ comment\r\nça va ?','2023-02-16 12:47:38',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_tags`
--

LOCK TABLES `posts_tags` WRITE;
/*!40000 ALTER TABLE `posts_tags` DISABLE KEYS */;
INSERT INTO `posts_tags` VALUES (1,1,1),(2,1,2),(3,1,3),(4,2,1),(5,2,2),(6,3,1),(7,3,4),(8,4,1),(9,4,3),(10,4,4),(24,22,13);
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_users`
--

LOCK TABLES `posts_users` WRITE;
/*!40000 ALTER TABLE `posts_users` DISABLE KEYS */;
INSERT INTO `posts_users` VALUES (1,1,1),(2,2,2),(3,3,1),(4,4,4),(21,22,6);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'armaflex','Isolant en mousse élastomère. Hautement flexible, contrôle très bien la condensation, et dispose de bonnes propriétés\n    ignifuges en générant peu de fumée. Il est souvent fourni en rouleau, avec un côté \'adhésivé\''),(2,'styrodur','Isolant. Mousse de polystyrène rigide extrudée. Haute résistance à la compression, faible hydrophilie, excellent pouvoir d\'isolation thermique. Imputrescible et très léger.\n    Isolant issue de la pétrochimie.'),(3,'laine de verre','Isolant. Consistance laineuse obtenu par fusion à partir de sable et de verre recyclé (calcin). Isolation phonique et protection incendie.'),(4,'contreplaque','Panneau de bois. Obtenu par collage de couches adjacentes à fils croisés, appelées plis. L\'épaisseur varie entre 1 mm et 50 mm.\n    Très solide.'),(5,'armada',NULL),(6,'table',NULL),(7,'qsdf',NULL),(8,'aaaaa',NULL),(9,'bbbb',NULL),(10,'nouveau tag',NULL),(11,'gasoil',NULL),(12,'durite',NULL),(13,'test',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Shaun','a.paillaud@laposte.net','2022-10-15 15:19:36','passw0rd','2022-10-15 15:19:36',0,0),(2,'Leila','leila.bonsigne@laposte.net','2022-10-15 15:20:36','s3cr3t','2022-10-15 15:20:36',14,2),(3,'Quentin','quentin.coupery@laposte.net','2022-10-15 15:21:15','admin','2022-10-15 15:21:15',3,0),(4,'Anne','anne.p@laposte.net','2022-10-15 15:21:44','anouk','2022-10-15 15:21:44',7,2),(5,'processx','processx@example.com','2023-02-08 16:06:22','$2y$10$qz3CBA4EWscRLhGoLOJp0.KXWCnEaCPgE1LDhYb1pbTRcfXBzx5wS','2023-02-08 16:06:22',0,0),(6,'boite','boite@example.com','2023-02-08 16:09:22','$2y$10$LhfILjgBLU9I4W69avuQaeG0FQZ7HCnmYiu.C6iaZtCD0zPKIeZEC','2023-02-08 16:09:22',0,0),(7,'ordinateur','ordinateur@example.com','2023-02-16 11:12:09','$2y$10$x33XOdjHMuVHItkZDL0rB.O7o8twc1KlxqXGaQ.zqv.1xTxdhzAlK','2023-02-16 11:12:09',0,0);
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
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `answer_id` (`answer_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `users_answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `users_answers_ibfk_2` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_answers`
--

LOCK TABLES `users_answers` WRITE;
/*!40000 ALTER TABLE `users_answers` DISABLE KEYS */;
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

-- Dump completed on 2023-02-16 17:00:46
