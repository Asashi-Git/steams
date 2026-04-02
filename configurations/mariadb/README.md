# MariaDb configuration

---

## This is the configuration file of MariaDB

```sql
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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES
(33,14446,'Call of Duty: Black Ops II','Call of Duty: Black Ops II is a first-person shooter, a direct sequel to Call of Duty: Black Ops that features its protagonists. The story is divided into two time periods. It starts in 1986 with Alex Mason that has to return to work after his retirement to catch Raul Menendez, responsible for multiple crimes. The second storyline takes place in 2025; you play as David, Mason’s son, who also needs to find Menendez who sparks the second Cold War. The game has several endings depending on your actions in both storylines.\nThe campaign mode in Black Ops II is also selected in two parts. There are story missions, where you can make decisions that will affect the future of the characters. Additionally, Strike Force missions, available in 2025, feature permanent death - if the character is killed, you can’t return to the checkpoint, and have to continue the game without them.\nLike two previous games in the series, Black Ops II has the Zombies mode with a completely new story. It starts with nuclear experiments in 2025 Nevada that cause the appearance of zombies.','2012-11-13','https://media.rawg.io/media/games/8ee/8eed88e297441ef9202b5d1d35d7d86f.jpg'),
(34,326243,'Elden Ring','The Golden Order has been broken.\n\nRise, Tarnished, and be guided by grace to brandish the power of the Elden Ring and become an Elden Lord in the Lands Between.\n\nIn the Lands Between ruled by Queen Marika the Eternal, the Elden Ring, the source of the Erdtree, has been shattered.\n\nMarika\'s offspring, demigods all, claimed the shards of the Elden Ring known as the Great Runes, and the mad taint of their newfound strength triggered a war: The Shattering. A war that meant abandonment by the Greater Will.\n\nAnd now the guidance of grace will be brought to the Tarnished who were spurned by the grace of gold and exiled from the Lands Between. Ye dead who yet live, your grace long lost, follow the path to the Lands Between beyond the foggy sea to stand before the Elden Ring.','2022-02-25','https://media.rawg.io/media/games/b29/b294fdd866dcdb643e7bab370a552855.jpg'),
(35,939836,'SEX with HITLER: WW2','Sex With Hitler:WW2 is an action-packed top-down shooter set in the midst of World War 2. You take on the role of a Hitler fighting against the enemy powers, battling through the ruins of cities and the trenches of war-torn landscapes.\nWith a variety of weapons at your disposal, including rifles, machine guns, and grenades, you must take on enemy troops, tanks, and planes, as you strive to complete missions and achieve victory.\nAs you progress through the game, you can earn upgrades for your weapons and abilities, allowing you to take on tougher challenges and become a more effective soldier. This game provides endless hours of action-packed fun for gamers of all skill levels.Features:\nIntense top-down shooter gameplay set in a WW2 setting.\nVariety of weapons including rifles, machine guns, and grenades.\nRealistic environments ranging from war-torn cities to battlefields.\nChallenging missions against enemy troops, tanks, and planes.\nUpgrades for weapons and abilities to improve your soldier.\nCampaign mode for a story-driven single-player experience.\nRealistic sound effects and music to enhance the immersive experience.\nHistorical accuracy in terms of weapons, equipment, and settings to provide an authentic WW2 experience\nAll characters are over 18 years old','2023-03-11','https://media.rawg.io/media/screenshots/62b/62b34a82c08682458c93c5832506f70b.jpg'),
(36,3678,'War Thunder','War Thunder is a free-to-play cross-platform vehicular combat MMO with more than 1000 playable aircraft, helicopters, tanks or ships sprawled over huge maps that feature real-life locations and battles that transpired over the course of 20th century, most notably during WWII. \n\n### Gameplay\nAir and land warfare pits 2 sides against each other up to 32 players who must battle over points or achieving total elimination against enemy forces across huge maps. There are also PVE missions including dynamic historical campaigns and solo missions plus the custom events that add limitations or put certain victory conditions.\n\n### Changes\nBack in 2013 War Thunder featured 50 vehicles from the German and Russian trees of air forces and a small selection of maps to choose from. Over the course of the open beta and up to the original release in December 2016, the developers have added over 800 land and air vehicles spawning from British, Japanese, American and other vehicle trees, expanded the map selection, upgraded the interface and tweaked out the graphics and sound for better optimization.\n\n### Recent updates\nNow War Thunder also has naval battles and with the latest update added helicopters to the mix. All the while constantly maintaining the game’s balance, polishing the visuals and the impeccable sound design, fixing bugs and implementing new features.','2013-08-15','https://media.rawg.io/media/games/d07/d0790809a13027251b6d0f4dc7538c58.jpg'),
(37,274755,'Hades','Hades is a rogue-like dungeon crawler that combines the best aspects of Supergiant\'s critically acclaimed titles, including the fast-paced action of Bastion, the rich atmosphere and depth of Transistor, and the character-driven storytelling of Pyre.\n\nBATTLE OUT OF HELL\nAs the immortal Prince of the Underworld, you\'ll wield the powers and mythic weapons of Olympus to break free from the clutches of the god of the dead himself, while growing stronger and unraveling more of the story with each unique escape attempt.\n\nUNLEASH THE FURY OF OLYMPUS\nThe Olympians have your back! Meet Zeus, Athena, Poseidon, and many more, and choose from their dozens of powerful Boons that enhance your abilities. There are thousands of viable character builds to discover as you go.\n\nBEFRIEND GODS, GHOSTS, AND MONSTERS\nA fully-voiced cast of colorful, larger-than-life characters is waiting to meet you! Grow your relationships with them, and experience hundreds of unique story events as you learn about what\'s really at stake for this big, dysfunctional family.\n\nBUILT FOR REPLAYABILITY\nNew surprises await each time you delve into the ever-shifting Underworld, whose guardian bosses will remember you. Use the powerful Mirror of Night to grow permanently stronger, and give yourself a leg up the next time you run away from home.\n\nNOTHING IS IMPOSSIBLE\nPermanent upgrades mean you don\'t have to be a god yourself to experience the exciting combat and gripping story. Though, if you happen to be one, crank up the challenge and get ready for some white-knuckle action that will put your well-practiced skills to the test.\n\nSIGNATURE SUPERGIANT STYLE\nThe rich, atmospheric presentation and unique melding of gameplay and narrative that\'s been core to Supergiant\'s games is here in full force: spectacular hand-painted Underworld environments and a blood-pumping original score bring the Underworld to life.','2020-09-17','https://media.rawg.io/media/games/1f4/1f47a270b8f241e4676b14d39ec620f7.jpg'),
(38,891238,'Hades II','The first-ever sequel from Supergiant Games builds on the best aspects of the original god-like rogue-like dungeon crawler in an all-new, action-packed, endlessly replayable experience rooted in the Underworld of Greek myth and its deep connections to the dawn of witchcraft.\nBATTLE BEYOND THE UNDERWORLD\nAs the immortal Princess of the Underworld, you\'ll explore a bigger, deeper mythic world, vanquishing the forces of the Titan of Time with the full might of Olympus behind you, in a sweeping story that continually unfolds through your every setback and accomplishment.\nMASTER WITCHCRAFT AND DARK SORCERY\nInfuse your legendary weapons of Night with ancient magick, so that none may stand in your way. Become stronger still with powerful Boons from more than a dozen Olympian gods, from Apollo to Zeus. There are nearly limitless ways to build your abilities.','2025-09-25','https://media.rawg.io/media/games/8fd/8fd2e8317849fd265ad8781c324d4ec2.jpg'),
(39,91007,'Cosmoteer','The ultimate starship designer,\npowered by a deep game simulation...\nCosmoteer is a starship design, simulation, and battle game. Design a fleet of ships by laying out individual rooms and corridors, including cannons, lasers, shields, and thrusters. Battle other starships to earn bounties and use that money to expand your own ship. A dynamic crew and combat simulation makes every design decision important and interesting.\nBest-In-Class Starship Designer\nDesign the greatest starship ever made using a starship designer that is easy-to-learn yet limitlessly flexible.\nBuild your ship by placing individual modules onto a grid—weapons, defenses, engines, reactors, crew\'s quarters, and more! Few restrictions and no pre-defined, creativity-limiting hull shapes mean you can create almost any ship you can imagine.\nLearn the game systems by watching as your crew scramble to power and operate new modules in real-time as you add them. The Ship Designer is directly integrated into the gameplay—no need to interrupt your flow to tweak your ship or experiment with a new design.\nInspired by professional art programs, the Ship Designer has a variety of different brush sizes and shape tools, as well as full support for Undo & Redo, Copy & Paste, rotation, and mirroring, so you can quickly and easily design giant starships. It even has a \"blueprint mode\" which allows you to plan for the future and design without restriction.\nIntelligent Crew Simulation\nEvery starship is operated by a crew numbering from half-a-dozen to hundreds—sometimes more than a thousand—of individually-simulated people.\nA ship\'s crew is its lifeblood. Crew not only operate its controls, but they also carry supplies such as ammunition and power batteries to weapons and systems. When a weapon wants to shoot, the crew go pick up ammo or batteries at an ammo factory or reactor and bring them to the weapon—all simulated in real-time down to the individual people and supplies.\nCrew are pretty smart and act mostly on their own, which is a good thing since there can be so many. Your crew are smart enough to figure out what controls need operating, what systems need ammo or power, and how best to get around your ship. They\'re even smart enough to avoid routes that are already jammed with other people.\nThe crew simulation is what makes starship design so interesting, because how fast a cannon can shoot or how long a shield can stay charged depends directly on how quickly crew can deliver ammo or power to it. As a player, you\'ll have to think carefully about how you design your ship\'s layout so that it operates at peak efficiency without exposing its more vulnerable (and sometimes explosive!) systems.\nPhysics That Matter\nEvery ship is part of a realistic 2D physics simulation. Ships have weight and a center-of-mass depending on their size and shape. Small ships with lots of thrusters are realistically fast and nimble, while large ships with proportionally fewer thrusters are naturally slower and more difficult to maneuver.\nThe position and orientation of your ship\'s thrusters affects its movement. Thrusters near its center-of-mass are great at pushing the ship forward, whereas off-center thrusters are effective at rotating the ship. Thrusters pointing forward are needed to decelerate, while thrusters pointing to the sides will let it strafe.\nThe A.I. will control your ship\'s thrusters, automatically determining the optimal ignition level for each thruster in order to fly your ship wherever you tell it to go.\nShips can collide and block weapons fire. The shape of a ship determines its collision properties. Weapons must be placed in locations that have good line-of-sight to the enemy, otherwise the ship will block its own shots.\nEmergent Combat Model\nWeapons obey the laws of the physics simulation. Whether or not a cannon or laser hits an enemy depends not on a roll of the dice but upon the physics of the weapon and its target.\nDamage is modeled module-by-module, and each module can be individually targeted & destroyed. There\'s no big \"health bar\" for the whole ship—a ship is only \"dead\" once all of the modules that it needs to function are gone.\nSome modules can explode causing collateral damage to the surrounding modules. This means that you\'ll have to think carefully about where you place your reactors and munitions. Too close to the edge and they\'ll be exposed to enemy fire; too far and your weapons won\'t fire fast enough.\nShips can break apart into multiple pieces when their connecting modules are destroyed. Usually this will be a crippling blow, but any piece that has a control room, power, and thrusters can continue to operate independently, potentially remaining a threat to the enemy.\nEpic Tactical Strategy\nClassic RTS-style controls make the game easy to learn. Simply right-click where you want your ship to fly, or right-click on an enemy to attack it. Advanced controls let you adjust the orientation, distance, and angle of attack.\nTarget your weapons to focus their fire on the vulnerable parts of enemy ships. Do you take out the weapons first, go for the explosive power core, or eliminate the command-and-control center? Every ship is different, and the right strategy varies greatly.\nCommand a fleet of ships, outmaneuvering and flanking the enemy to expose its weak side. Specialize your fleet\'s ships into roles however you see fit.\nStarship Painter\nThe surface of a ship is like an artist\'s canvas. The Ship Painter is even easier to use than the Ship Designer, requiring no drawing ability to make your ship look great.\nPick a color and texture to customize your ship\'s basic appearance. If you\'re not artistically inclined then no need to do more, but otherwise you can...\nAdd decals to decorate your ship. Every ship has two independently-colored layers of decals. Decals are small shapes, icons, symbols, letters, and numbers that you can stamp on your ship to give it extra visual flourish.\nPainting your ship is free and has no effect on gameplay.\nBounty Hunter\nYou are a bounty hunter, traveling from sector to sector, hunting down renegade enemies and destroying them.\nEarn money for every enemy vanquished. Use your income to repair and upgrade your own ship, growing bigger and more powerful with every victory.\nExplore a galaxy in search of bigger and more powerful enemies. As your own ship grows in size and power, you will soon be able to defeat even the strongest foes.\nExpand your fleet by purchasing additional ships. The galaxy will crumble before your almighty armada!\nCreative Mode\nPlay in a creative sandbox mode if being a bounty hunter isn\'t your cup of Earl Grey.\nDesign ships with unlimited funds. The only limit in Creative Mode is your imagination! (And the power of your computer.)\nPit your designs against each other and import designs from other players, competing to be the master designer.\nOr just turn on the A.I., sit back, and watch massive fleets annihilate each other! (Great for hosting A.I.-controlled tournaments!)\nMultiplayer\nBattle your friends and enemies in real-time, pitting your designs against theirs. Compete to be the master \"Starship Architect & Commander\" against up to 7 other players in Team vs Team and Free For All battles.\nConfigure a variety of game options by specifying number of ships, total funds, game speed, and other options. Play tiny skirmishes, massive fleet battles, or anywhere in between.\nPlay online in public or private lobbies. Local Area Network and direct I.P. address connections are also supported.\nImportant Note: Multiplayer is NOT SUPPORTED between 32-bit and 64-bit operating systems!\nAnd more!\nEverything you should expect from a great PC game, including customizable controls, windowed and borderless display modes, support for high-resolution displays, no mandatory locked framerates, and dozens of other options to tailor the game to your own preferences.\nAttention to accessibility issues wherever possible in order to support gamers of all abilities. Every single control and mouse button can be remapped, the user interface can be made twice as big, and colors that convey meaningful information can be freely changed.\nUnobtrusive tutorials that don\'t interrupt gameplay and are easy to dismiss or turn off altogether. There\'s no special \"tutorial level\" you need to play through—the context-sensitive tips are built-in to the main Bounty Hunter mode.\nA mods manager makes it easy to install and uninstall mods created by the Cosmoteer community. A powerful modding framework lets mods change literally any part of the game data, opening up a universe of possibilities beyond the base game.\nMain Website\nForum\nChat (Discord)\nWiki','2017-06-24','https://media.rawg.io/media/screenshots/9f4/9f4fb3a36dcb3aea77d47e8f69ecacd2.jpg'),
(40,28152,'STAR WARS Battlefront II','Despite its name, Star Wars Battlefront II is the seventh game in the Battlefront series of action games. It is a direct sequel to the 2015 Star Wars Battlefront that became the series\'s reboot.\r\n\r\n###Story mode\r\nThe game is set in the Star Wars universe during and after the fall of the Galactic Empire. Its story mode fills the gap between the original trilogy and Episode VII: The Force Awakens. In the story campaign mode, the player controls the Imperial Inferno Squad led by the game\'s main protagonist, Iden Versio (who is voiced by Janina Gavankar). She and her special forces group participate in a variety of missions spanning almost 30 years. On certain levels, the player will also control other characters, including rebels.\r\n\r\n###Arcade mode\r\nBesides the story mode, there\'s the Arcade mode that offers the players to take on the role of any Star Wars character from the said period, such as Darth Vader, Han Solo, Luke, Rey, Kylo Ren, among others. The player can choose the battle to participate in, the side to fight for, and the character, or even to customize the mission. \r\n\r\n###Multiplayer\r\nThe Arcade mode offers a local cooperative multiplayer. Besides that, there are nine online multiplayer modes that include traditional types like team deathmatch and capture the flag. Some of this modes, like Galactic Assault, support up to 40 players at once and allow the players to participate in a large-scale battle between the rebels and the Empire.','2017-11-17','https://media.rawg.io/media/games/f54/f54e9fb2f4aac37810ea1a69a3e4480a.jpg');
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
(7,34),
(19,34),
(7,35),
(18,35),
(7,36),
(7,37),
(7,38),
(20,40);
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES
(49,'ABSOLUTE CINEMA !!!!!!!!!','c\'est le meilleur jeu du monde pitié FromSoftware prenez toute mon argent !!!!!!',10,'2026-04-02 17:02:45',19,34,1),
(51,'Need Help','I need someone to play with me at this game, cause right now, it\'s sooo harrd :(',9,'2026-04-02 17:04:47',7,35,0),
(52,'I spend too much hour in this game !','I have spend too much hour in this game, but I\'m okay with that. It\'s a good game, just a little bit pay to win sometime...',6,'2026-04-02 17:07:27',7,36,0),
(53,'The musics are soo good !','Clearly the music are fire, and the gameplay too !',9,'2026-04-02 17:08:39',7,37,0),
(54,'Return help','Hello asashi, if you want we can do a LAN to play together. \r\nPs: I’m not talking about the game 🫦',10,'2026-04-02 17:09:29',18,35,0),
(55,'The music are even better !','Just for the music, buy it.',10,'2026-04-02 17:09:38',7,38,0),
(56,'The problem with this game','The problem with this game it\'s that you start playing at 7 and when you look again it\'s 12... My bad',9,'2026-04-02 17:30:46',7,39,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(7,'asashi','samueldecarnelle@gmail.com','$2y$12$EFUCFTn1Lm7AvELNdJR4KeZ3b.hlipXFXUqU6vqdh9uagK.QH7oPG',1),
(18,'Max','max@gmail.com','$2y$12$qlEc7HkPNuxt.lTWeXGKx.AZCvILnXvr8sErZNo.TdTsJR.LeH3A2',2),
(19,'jahed','sjahed376@gmail.com','$2y$12$SVLxvV6atKY7NTRDRlACVOlHKxHWXK3dnB9UYONxOH7QhYNDeMPWW',2),
(20,'louis','holler.louis@gmail.com','$2y$12$gKSCN/5pODJ7CSE6DFtrFu.5mhacUyqzaCsSMc2vdZ99L5Eav9GIW',2);
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

-- Dump completed on 2026-04-02 22:49:44
```
