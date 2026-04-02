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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(14,274755,'Hades','Hades is a rogue-like dungeon crawler that combines the best aspects of Supergiant\'s critically acclaimed titles, including the fast-paced action of Bastion, the rich atmosphere and depth of Transistor, and the character-driven storytelling of Pyre.\n\nBATTLE OUT OF HELL\nAs the immortal Prince of the Underworld, you\'ll wield the powers and mythic weapons of Olympus to break free from the clutches of the god of the dead himself, while growing stronger and unraveling more of the story with each unique escape attempt.\n\nUNLEASH THE FURY OF OLYMPUS\nThe Olympians have your back! Meet Zeus, Athena, Poseidon, and many more, and choose from their dozens of powerful Boons that enhance your abilities. There are thousands of viable character builds to discover as you go.\n\nBEFRIEND GODS, GHOSTS, AND MONSTERS\nA fully-voiced cast of colorful, larger-than-life characters is waiting to meet you! Grow your relationships with them, and experience hundreds of unique story events as you learn about what\'s really at stake for this big, dysfunctional family.\n\nBUILT FOR REPLAYABILITY\nNew surprises await each time you delve into the ever-shifting Underworld, whose guardian bosses will remember you. Use the powerful Mirror of Night to grow permanently stronger, and give yourself a leg up the next time you run away from home.\n\nNOTHING IS IMPOSSIBLE\nPermanent upgrades mean you don\'t have to be a god yourself to experience the exciting combat and gripping story. Though, if you happen to be one, crank up the challenge and get ready for some white-knuckle action that will put your well-practiced skills to the test.\n\nSIGNATURE SUPERGIANT STYLE\nThe rich, atmospheric presentation and unique melding of gameplay and narrative that\'s been core to Supergiant\'s games is here in full force: spectacular hand-painted Underworld environments and a blood-pumping original score bring the Underworld to life.','2020-09-17','https://media.rawg.io/media/games/1f4/1f47a270b8f241e4676b14d39ec620f7.jpg'),
(15,681398,'Farming Simulator 22','Take on the role of a modern farmer and creatively build your farm in three diverse American and European environments. Farming Simulator 22 offers a huge variety of farming operations focusing on agriculture, animal husbandry and forestry - now with the exciting addition of seasonal cycles!\r\n\r\nMore than 400 machines and tools from over 100 real agricultural brands like John Deere, CLAAS, Case IH, New Holland, Fendt, Massey Ferguson, Valtra and many more are included to sow and harvest crops like wheat, corn, potatoes and cotton. New machine categories and crops will add new gameplay mechanics to the experience.\r\n\r\nEven run your farm cooperatively in multiplayer and extend the game by a multitude of free community-created modifications. Farming Simulator 22 offers more player freedom than ever before and challenges you to become a successful farmer - so start farming and let the good times grow!','2021-11-22','https://media.rawg.io/media/games/dd9/dd90964966f6bf9b0bd635be432fbf8a.jpg'),
(16,56097,'Mario Kart: Double Dash','Mario Kart: Double Dash!! (Japanese: マリオカートダブルダッシュ!!, Hepburn: Mario Kāto: Daburu Dasshu!!) is a racing game developed by Nintendo Entertainment Analysis & Development and published by Nintendo for the GameCube in 2003. The game is the fourth installment in the Mario Kart series and the third for home consoles after Mario Kart 64. It was preceded by Mario Kart: Super Circuit from 2001 and was followed by the handheld game Mario Kart DS, which was released for the Nintendo DS in 2005.\nSimilar to previous titles, Double Dash!! challenges Mario series player characters to race against each other on Mario-themed tracks. The game introduced a number of new gameplay features, such as supporting co-op gameplay with two riders per kart. One player drives the kart, and the other uses items. Players can switch at any time. Double Dash!! is the only game in the Mario Kart series to allow cooperative gameplay so far. Double Dash!! supports LAN play using the Nintendo GameCube Broadband Adapter, allowing up to 16 players to compete simultaneously. There are 20 characters to select from in total, each of which with a special item, and with eleven characters being new to the series.\nDouble Dash!! received positive reviews by critics; it attained an aggregated score of 87 out of 100 on Metacritic. Reviewers praised the graphics and the new gameplay features, but elements of the voice acting were poorly received. It was commercially successful, with more than 3.8 million copies sold in the United States, and more than 802,000 copies sold in Japan. It is currently the second best-selling GameCube game of all-time, selling around 7 million copies worldwide.','2003-11-07','https://media.rawg.io/media/games/379/379d8862e9dfccb12bfba3a131d99dd8.png'),
(17,343595,'Sonic Adventure','Join Sonic and friends as they embark on their first truly epic quest to stop Dr, Eggman’s most villainous scheme in the hit Dreamcast title Sonic Adventure™ now available on Xbox®LIVE Arcade.  An ancient evil lurking within the Master Emerald has been unleashed from its slumber by the devious Dr. Eggman and is on the verge of becoming the ultimate monster using the 7 Chaos Emeralds. Only Sonic and his friends are heroic enough to put a stop to Dr. Eggman and his evil minions. Hit the ground running in this classic epic adventure in a race against time to save the world!  There are no refunds for this item. For more information, see www.xbox.com/live/accounts.','1998-12-23','https://media.rawg.io/media/games/566/566b771293b3e8aee0c071a02e81d925.jpg'),
(18,842386,'Spider-Man (2002)','The level-rich beat-\'em-up based on the movie featuring Tobey Maguire!','2002-04-16','https://media.rawg.io/media/screenshots/b74/b741c87ab027d8a997e98be095ec750f.jpg'),
(19,450393,'Halo (itch)','This was an environment created in Unreal Engine 4, inspired by the Halo game series. Currently, there are two versions of the game. The standard version for windows and the VR Oculus version for windows. As always, any feedback is greatly appreciated!\nTech Details: https://www.artstation.com/artwork/6aKY1O\nNotes:\n- At the moment, the VR Oculus version only works via the link.\n- Launch the game from the exe file instead of through Steam VR.\n- Because this game was designed for the Oculus platform, results may vary when using other headsets.','2020-06-04','https://media.rawg.io/media/screenshots/aac/aaccfdc54ef56523e18337a3cfae7d7f.jpg'),
(20,359261,'Sad :\')','Sad :\') is a simple game which tries to speak solely through its gameplay (with a little hint from its title).\nSad :\') is a small arcade game with just one endless level:\nmove naked around your bubble trying to be happy by staying near others, but be careful not to get hurt, the game will end only if you want it to end.\nThe gameplay follows 3 simples elements:\nStay near the other characters to increase your happinessAvoid getting hit (or hit first) to keep movingVarious power-ups will help you with your life, happiness and bubble size\nThis game has been made solely by me in a couple of sleepless nights, it will receive minimum support as I\'m working on other projects, but I\'m thinking about updating It with some achievements or hair.\nI\'m publishing it for free mostly because I\'m curious about the reception.','2019-08-14','https://media.rawg.io/media/screenshots/d73/d7387cd03249a99f5f600b13fe033b3b.jpg'),
(21,164050,'POOP (itch)','','2018-04-05','https://media.rawg.io/media/screenshots/64b/64b92d29dffa4e176ebb8b19f789af2b.jpg'),
(22,58751,'Halo Infinite','Halo Infinite is the twelfth installment in the Halo franchise, and the sixth in the main series of science fiction first-person shooters. It is the sequel to Halo 5: Guardians and the third chapter in the Reclaimer Saga sub-series that was started by Halo 4. It is also the first game powered by the completely new Slipspace engine developed by Microsoft.\r\n\r\n###Setting\r\nThe Halo franchise is set in the 26th century, when the human civilization, led by United Nations Space Command, wages total war against the theocratic interstellar alliance called the Covenant. The goal of the war is the control of ring-shaped space stations, called Halos, which were built in ancient times by a lost civilization of Forerunners. \r\n\r\n###Plot\r\nThe game follows the series\' most famous protagonist: Master Chief, who is a “Spartan” - a genetically enhanced, power armor wearing super soldier. Infinite continues the story of Master Chief and his companions, the Blue Team, as they fight against the AI called Cortana that tries to take over the control of the Halos. AHalo Infinite is set on a forested Halo inhabited by rhinos and other wildlife reminiscent of prehistoric Earth.\r\n\r\n###Modes\r\nIn addition to single player story campaign, Halo Infinite supports cooperative multiplayer modes, both local and online. There\'s, however, no Battle Royale mode.','2021-12-08','https://media.rawg.io/media/games/e1f/e1ffbeb1bac25b19749ad285ca29e158.jpg'),
(23,39685,'World of Warcraft: Cataclysm','','2010-12-07','https://media.rawg.io/media/games/4b9/4b9b27acc65760d166a9d65ee5bb6330.jpg'),
(24,35629,'Star Wars: Battlefront (2004)','LIVE THE BATTLES\nSTAR WARS™ Battlefront is an action/shooter game that gives fans and gamers the opportunity to re-live and participate in all of the classic Star Wars battles like never before. Players can select one of a number of different soldier types, jump into any vehicle, man any turret on the battlefront and conquer the galaxy planet-by-planet online with their friends or offline in a variety of single player modes. Single player modes include \"Instant Action\", \"Galactic Conquest\" and the story-based \"Historical Campaigns\" mode that lets gamers experience all of the epic Star Wars battles from Episodes I-VI, fighting from the perspective of each of the four factions within the game.\nFight as a soldier on the front lines where every weapon and vehicle you see is yours. Take the Empire head on or crush the Rebellion - by yourself or with an army behind you.\n* Pick your side - Rebels, Imperials, clone troopers or battle droids.\n* Choose your weapons wisely - each soldier has different weapons and capabilities.\n* Battle on unique planets from the entire Star Wars saga.\n* Pilot over 30 vehicles including AT-ATs, X-Wings and Snowspeeders.\n* Fight up to 32 players in massive online battles!','2004-09-20','https://media.rawg.io/media/games/f0e/f0ec103fb02562f9eafbcd73f124deb0.jpg'),
(25,28152,'STAR WARS Battlefront II','Despite its name, Star Wars Battlefront II is the seventh game in the Battlefront series of action games. It is a direct sequel to the 2015 Star Wars Battlefront that became the series\'s reboot.\r\n\r\n###Story mode\r\nThe game is set in the Star Wars universe during and after the fall of the Galactic Empire. Its story mode fills the gap between the original trilogy and Episode VII: The Force Awakens. In the story campaign mode, the player controls the Imperial Inferno Squad led by the game\'s main protagonist, Iden Versio (who is voiced by Janina Gavankar). She and her special forces group participate in a variety of missions spanning almost 30 years. On certain levels, the player will also control other characters, including rebels.\r\n\r\n###Arcade mode\r\nBesides the story mode, there\'s the Arcade mode that offers the players to take on the role of any Star Wars character from the said period, such as Darth Vader, Han Solo, Luke, Rey, Kylo Ren, among others. The player can choose the battle to participate in, the side to fight for, and the character, or even to customize the mission. \r\n\r\n###Multiplayer\r\nThe Arcade mode offers a local cooperative multiplayer. Besides that, there are nine online multiplayer modes that include traditional types like team deathmatch and capture the flag. Some of this modes, like Galactic Assault, support up to 40 players at once and allow the players to participate in a large-scale battle between the rebels and the Empire.','2017-11-17','https://media.rawg.io/media/games/f54/f54e9fb2f4aac37810ea1a69a3e4480a.jpg'),
(26,727315,'Ratchet & Clank: Rift Apart','BLAST YOUR WAY THROUGH AN INTERDIMENSIONAL ADVENTURE\nThe intergalactic adventurers are back with a bang. Help them stop a robotic emperor intent on conquering cross-dimensional worlds, with their own universe next in the firing line.\n- Blast your way home with an arsenal of outrageous weaponry.\n- Experience the shuffle of dimensional rifts and dynamic gameplay.\n- Explore never-before-seen planets and alternate dimension versions of old favorites.','2021-06-11','https://media.rawg.io/media/games/ccf/ccfd3fd488a8ed61145a3da96c080131.jpg'),
(27,58175,'God of War (2018)','It is a new beginning for Kratos. Living as a man outside the shadow of the gods, he ventures into the brutal Norse wilds with his son Atreus, fighting to fulfill a deeply personal quest. \r\n\r\nHis vengeance against the Gods of Olympus years behind him, Kratos now lives as a man in the realm of Norse Gods and monsters. It is in this harsh, unforgiving world that he must fight to survive… And teach his son to do the same. This startling reimagining of God of War deconstructs the core elements that defined the series—satisfying combat; breathtaking scale; and a powerful narrative—and fuses them anew. \r\n\r\nKratos is a father again. As mentor and protector to Atreus, a son determined to earn his respect, he is forced to deal with and control the rage that has long defined him while out in a very dangerous world with his son. \r\n\r\nFrom the marble and columns of ornate Olympus to the gritty forests, mountains, and caves of Pre-Viking Norse lore, this is a distinctly new realm with its own pantheon of creatures, monsters, and gods. With an added emphasis on discovery and exploration, the world will draw players in to explore every inch of God of War’s breathtakingly threatening landscape—by far the largest in the franchise. \r\n\r\nWith an over the shoulder free camera that brings the player closer to the action than ever before, fights in God of War mirror the pantheon of Norse creatures Kratos will face: grand, gritty, and grueling. A new main weapon and new abilities retain the defining spirit of God of War while presenting a vision of violent conflict that forges new ground in the genre','2018-04-20','https://media.rawg.io/media/games/4be/4be6a6ad0364751a96229c56bf69be59.jpg'),
(28,977470,'Elden Ring: Shadow of the Erdtree','The Land of Shadow.\n\nA place obscured by the Erdtree.\nWhere the goddess Marika first set foot.\n\nA land purged in an unsung battle.\nSet ablaze by Messmer’s flame.\n\nIt was to this land that Miquella departed.\nDivesting himself of his flesh, his strength, his lineage.\nOf all things Golden.\n\nAnd now Miquella awaits the return of his promised Lord.','2024-06-21','https://media.rawg.io/media/screenshots/0ba/0bae7160eedc1f7d85a8d2db70cf1ec9.jpg'),
(29,494384,'God of War: Ragnarök','Kratos and Atreus must journey to each of the Nine Realms in search of answers as they prepare for the prophesied battle that will end the world. Together, Kratos and Atreus venture deep into the Nine Realms in search of answers as Asgardian forces prepare for war.\r\n \r\nAlong the way they will explore stunning, mythical landscapes, gather allies from across the realms, and face fearsome enemies in the form of Norse gods and monsters. As the threat of Ragnarök grows ever closer, Kratos and Atreus find themselves choosing between the safety of their family and the safety of the realms...','2022-11-09','https://media.rawg.io/media/games/1c3/1c305096502c475c00276c827f0fd697.jpg'),
(30,326243,'Elden Ring','The Golden Order has been broken.\n\nRise, Tarnished, and be guided by grace to brandish the power of the Elden Ring and become an Elden Lord in the Lands Between.\n\nIn the Lands Between ruled by Queen Marika the Eternal, the Elden Ring, the source of the Erdtree, has been shattered.\n\nMarika\'s offspring, demigods all, claimed the shards of the Elden Ring known as the Great Runes, and the mad taint of their newfound strength triggered a war: The Shattering. A war that meant abandonment by the Greater Will.\n\nAnd now the guidance of grace will be brought to the Tarnished who were spurned by the grace of gold and exiled from the Lands Between. Ye dead who yet live, your grace long lost, follow the path to the Lands Between beyond the foggy sea to stand before the Elden Ring.','2022-02-25','https://media.rawg.io/media/games/b29/b294fdd866dcdb643e7bab370a552855.jpg'),
(31,422,'Terraria','Terraria is a 2D action adventure sandbox game, where players create a character and gather resources in order to gradually craft stronger weapons and armor. Players create randomly generated maps that contain different locations within it, and by gathering specific resources and triggering special events, players will fight one of the many in-game bosses. Created characters can be played on different maps.\r\nThe game introduces hundreds of unique items that can be found across the entirety of the map, some of which may not even be encountered. \r\nTerraria have many different Biomes and areas with distinct visuals, containing resources and enemies unique to this biome. After gathering materials, players can craft furniture, and build settlements and houses, since after completing events or finding specific items NPCs will start to arrive, and will require player’s protection. Terraria can be played on three difficulties and has a large modding community.','2011-05-16','https://media.rawg.io/media/games/f46/f466571d536f2e3ea9e815ad17177501.jpg');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `likes` (
  `id_user` int(11) NOT NULL,
  `id_game` int(11) NOT NULL,
  PRIMARY KEY (`id_user`,`id_game`),
  KEY `id_game` (`id_game`),
  CONSTRAINT `1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  CONSTRAINT `2` FOREIGN KEY (`id_game`) REFERENCES `games` (`id_game`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES
(16,13),
(17,13),
(7,19),
(10,25),
(17,27),
(17,28);
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES
(14,'Un vrais BANGER','Quelqu\'un pourrait m\'acheter une deuxieme copie, c\'est pour un pote, pour faire des duo Q',9,'2026-04-01 23:54:35',7,12,0),
(21,'Sonic moi les fesses','En vrais ?',8,'2026-04-02 08:43:17',7,17,0),
(23,'Hallo','quelqu\'un m\'entends ?',7,'2026-04-02 09:12:11',7,19,0),
(47,'AMAZING','ABSOLUTE BANGER !!!!!!!!!!!!!!!!!!!!!!!!',10,'2026-04-02 14:06:12',16,30,0),
(48,'ABSOLUTE BULL SHIT','NULLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!',1,'2026-04-02 14:18:29',16,13,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(7,'asashi','samueldecarnelle@gmail.com','$2y$12$EFUCFTn1Lm7AvELNdJR4KeZ3b.hlipXFXUqU6vqdh9uagK.QH7oPG',1),
(9,'samecritique','sam@gmail.com','$2y$12$3S/YLpKD1wwvP8DlNH8MeOdYC142G7mLevTEdSRRs9TB99p3gVEjy',2),
(10,'cptpinguin','cpt@gmail.com','$2y$12$LiSZTuxVkjeVN/mzJmHfBO/4QQnCK61IOO7KrYMhiZSGOpfryd9uC',2),
(11,'max','max@gmail.com','$2y$12$t49SpDUQixofaMnw9P4q2uhYSA6rLnABnUdOkRUBMCf/ghjTL31vu',2),
(16,'losseni','losseni@gmail.com','$2y$12$xml6MFpG6yJA7Lu0niGPguZEp0DSDXOL3PWW/PIzYe9vgNQ5spYq6',2),
(17,'Connarddemarc','marc@gmail.com','$2y$12$XiP72g3JYuCq.WyiZulCle8/PMeyMi19ih2dS4kRnxTbWnijmGhV6',2);
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

-- Dump completed on 2026-04-02 17:10:07
