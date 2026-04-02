/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.2.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: steams_db
-- ------------------------------------------------------
-- Server version	12.2.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `available_on`
--

DROP TABLE IF EXISTS `available_on`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `available_on` (
  `id_game` int(11) NOT NULL,
  `id_platform` int(11) NOT NULL,
  `release_date_on_platform` date DEFAULT NULL,
  PRIMARY KEY (`id_game`,`id_platform`),
  KEY `id_platform` (`id_platform`),
  CONSTRAINT `1` FOREIGN KEY (`id_game`) REFERENCES `games` (`id_game`) ON DELETE CASCADE,
  CONSTRAINT `2` FOREIGN KEY (`id_platform`) REFERENCES `platforms` (`id_platform`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `available_on`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `available_on` WRITE;
/*!40000 ALTER TABLE `available_on` DISABLE KEYS */;
/*!40000 ALTER TABLE `available_on` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `belongs`
--

DROP TABLE IF EXISTS `belongs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `belongs` (
  `id_game` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  PRIMARY KEY (`id_game`,`id_category`),
  KEY `id_category` (`id_category`),
  CONSTRAINT `1` FOREIGN KEY (`id_game`) REFERENCES `games` (`id_game`) ON DELETE CASCADE,
  CONSTRAINT `2` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `belongs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `belongs` WRITE;
/*!40000 ALTER TABLE `belongs` DISABLE KEYS */;
/*!40000 ALTER TABLE `belongs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES
(1,'RPG','Role-playing games'),
(2,'FPS','First-person shooter games'),
(3,'Action','Fast-paced action games'),
(4,'Strategy','Turn-based or real-time strategy games');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `games` (
  `id_game` int(11) NOT NULL AUTO_INCREMENT,
  `rawg_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_game`),
  UNIQUE KEY `rawg_id` (`rawg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES
(12,939836,'SEX with HITLER: WW2','Sex With Hitler:WW2 is an action-packed top-down shooter set in the midst of World War 2. You take on the role of a Hitler fighting against the enemy powers, battling through the ruins of cities and the trenches of war-torn landscapes.\nWith a variety of weapons at your disposal, including rifles, machine guns, and grenades, you must take on enemy troops, tanks, and planes, as you strive to complete missions and achieve victory.\nAs you progress through the game, you can earn upgrades for your weapons and abilities, allowing you to take on tougher challenges and become a more effective soldier. This game provides endless hours of action-packed fun for gamers of all skill levels.Features:\nIntense top-down shooter gameplay set in a WW2 setting.\nVariety of weapons including rifles, machine guns, and grenades.\nRealistic environments ranging from war-torn cities to battlefields.\nChallenging missions against enemy troops, tanks, and planes.\nUpgrades for weapons and abilities to improve your soldier.\nCampaign mode for a story-driven single-player experience.\nRealistic sound effects and music to enhance the immersive experience.\nHistorical accuracy in terms of weapons, equipment, and settings to provide an authentic WW2 experience\nAll characters are over 18 years old','2023-03-11','https://media.rawg.io/media/screenshots/62b/62b34a82c08682458c93c5832506f70b.jpg'),
(13,14446,'Call of Duty: Black Ops II','Call of Duty: Black Ops II is a first-person shooter, a direct sequel to Call of Duty: Black Ops that features its protagonists. The story is divided into two time periods. It starts in 1986 with Alex Mason that has to return to work after his retirement to catch Raul Menendez, responsible for multiple crimes. The second storyline takes place in 2025; you play as David, Mason’s son, who also needs to find Menendez who sparks the second Cold War. The game has several endings depending on your actions in both storylines.\nThe campaign mode in Black Ops II is also selected in two parts. There are story missions, where you can make decisions that will affect the future of the characters. Additionally, Strike Force missions, available in 2025, feature permanent death - if the character is killed, you can’t return to the checkpoint, and have to continue the game without them.\nLike two previous games in the series, Black Ops II has the Zombies mode with a completely new story. It starts with nuclear experiments in 2025 Nevada that cause the appearance of zombies.','2012-11-13','https://media.rawg.io/media/games/8ee/8eed88e297441ef9202b5d1d35d7d86f.jpg'),
(14,274755,'Hades','Hades is a rogue-like dungeon crawler that combines the best aspects of Supergiant\'s critically acclaimed titles, including the fast-paced action of Bastion, the rich atmosphere and depth of Transistor, and the character-driven storytelling of Pyre.\n\nBATTLE OUT OF HELL\nAs the immortal Prince of the Underworld, you\'ll wield the powers and mythic weapons of Olympus to break free from the clutches of the god of the dead himself, while growing stronger and unraveling more of the story with each unique escape attempt.\n\nUNLEASH THE FURY OF OLYMPUS\nThe Olympians have your back! Meet Zeus, Athena, Poseidon, and many more, and choose from their dozens of powerful Boons that enhance your abilities. There are thousands of viable character builds to discover as you go.\n\nBEFRIEND GODS, GHOSTS, AND MONSTERS\nA fully-voiced cast of colorful, larger-than-life characters is waiting to meet you! Grow your relationships with them, and experience hundreds of unique story events as you learn about what\'s really at stake for this big, dysfunctional family.\n\nBUILT FOR REPLAYABILITY\nNew surprises await each time you delve into the ever-shifting Underworld, whose guardian bosses will remember you. Use the powerful Mirror of Night to grow permanently stronger, and give yourself a leg up the next time you run away from home.\n\nNOTHING IS IMPOSSIBLE\nPermanent upgrades mean you don\'t have to be a god yourself to experience the exciting combat and gripping story. Though, if you happen to be one, crank up the challenge and get ready for some white-knuckle action that will put your well-practiced skills to the test.\n\nSIGNATURE SUPERGIANT STYLE\nThe rich, atmospheric presentation and unique melding of gameplay and narrative that\'s been core to Supergiant\'s games is here in full force: spectacular hand-painted Underworld environments and a blood-pumping original score bring the Underworld to life.','2020-09-17','https://media.rawg.io/media/games/1f4/1f47a270b8f241e4676b14d39ec620f7.jpg');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `platforms`
--

DROP TABLE IF EXISTS `platforms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `platforms` (
  `id_platform` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_platform`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platforms`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `platforms` WRITE;
/*!40000 ALTER TABLE `platforms` DISABLE KEYS */;
INSERT INTO `platforms` VALUES
(1,'PC','Various'),
(2,'PlayStation 5','Sony'),
(3,'Xbox Series X','Microsoft'),
(4,'Nintendo Switch','Nintendo');
/*!40000 ALTER TABLE `platforms` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id_review` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `notation` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL,
  `id_game` int(11) NOT NULL,
  `pinned` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_review`),
  KEY `id_user` (`id_user`),
  KEY `id_game` (`id_game`),
  CONSTRAINT `1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  CONSTRAINT `2` FOREIGN KEY (`id_game`) REFERENCES `games` (`id_game`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES
(14,'Un vrais BANGER','Quelqu\'un pourrait m\'acheter une deuxieme copie, c\'est pour un pote, pour faire des duo Q',9,'2026-04-01 23:54:35',7,12,0),
(16,'dans la vie on fait caca','pipi caaca aegokiqerjng^ùiompg',1,'2026-04-02 00:20:42',8,13,0),
(18,'SFGTHBREGW','DGRGEGR',2,'2026-04-02 00:35:57',8,14,0);
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,'admin','Full access to all platform features'),
(2,'reviewer','Can write and manage their own reviews'),
(3,'member','Standard registered user');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'alice','alice@mail.com','$2b$12$hashedpasswordAlice',3),
(2,'bob','bob@mail.com','$2b$12$hashedpasswordBob',3),
(3,'candice','candice@mail.com','$2b$12$hashedpasswordCandice',3),
(4,'david','david@mail.com','$2b$12$hashedpasswordDavid',3),
(5,'eve','eve@mail.com','$2b$12$hashedpasswordEve',3),
(6,'dsvdqsfvdq','SKIBIDOUILLE@LACOSTE.NET','$2y$12$QSdJ4gBHQna7T37yAf2KB.m8XL/zeFv2tt9.bflIcPmL0DcVhDr1S',3),
(7,'asashi','samueldecarnelle@gmail.com','$2y$12$EFUCFTn1Lm7AvELNdJR4KeZ3b.hlipXFXUqU6vqdh9uagK.QH7oPG',1),
(8,'sambaisemoi','SKIBILADOUILLE@LACOSTE.NET','$2y$12$/Dtw4e9K5W2kMIT5DHwxUeoru0NZNVwxV/gZHvj9PRG2.aH4597Iu',2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-04-02  3:01:38
