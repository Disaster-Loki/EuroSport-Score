-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: EuroSportScore
-- ------------------------------------------------------
-- Server version	10.11.6-MariaDB-0+deb12u1

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
-- Table structure for table `Calendar`
--

DROP TABLE IF EXISTS `Calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_date` date DEFAULT NULL,
  `game_time` time DEFAULT NULL,
  `stadium_id` int(11) DEFAULT NULL,
  `team1_id` int(11) DEFAULT NULL,
  `team2_id` int(11) DEFAULT NULL,
  `final_result` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stadium_id` (`stadium_id`),
  KEY `team1_id` (`team1_id`),
  KEY `team2_id` (`team2_id`),
  CONSTRAINT `Calendar_ibfk_1` FOREIGN KEY (`stadium_id`) REFERENCES `Stadium` (`id`),
  CONSTRAINT `Calendar_ibfk_2` FOREIGN KEY (`team1_id`) REFERENCES `Team` (`id`),
  CONSTRAINT `Calendar_ibfk_3` FOREIGN KEY (`team2_id`) REFERENCES `Team` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Calendar`
--

LOCK TABLES `Calendar` WRITE;
/*!40000 ALTER TABLE `Calendar` DISABLE KEYS */;
/*!40000 ALTER TABLE `Calendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Card`
--

DROP TABLE IF EXISTS `Card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) DEFAULT NULL,
  `minute` int(11) DEFAULT NULL,
  `type` enum('yellow','red') DEFAULT NULL,
  `player_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `game_id` (`game_id`),
  KEY `player_id` (`player_id`),
  CONSTRAINT `Card_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `GameResult` (`id`),
  CONSTRAINT `Card_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `Player` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Card`
--

LOCK TABLES `Card` WRITE;
/*!40000 ALTER TABLE `Card` DISABLE KEYS */;
INSERT INTO `Card` VALUES
(4,3,45,'yellow',3);
/*!40000 ALTER TABLE `Card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `City`
--

DROP TABLE IF EXISTS `City`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `City` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `points_of_interest` text DEFAULT NULL,
  `typical_climate` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `City`
--

LOCK TABLES `City` WRITE;
/*!40000 ALTER TABLE `City` DISABLE KEYS */;
INSERT INTO `City` VALUES
(1,'Lisbon','Portugal',505526,'Belém Tower, Jerónimos Monastery, Alfama','Mediterranean');
/*!40000 ALTER TABLE `City` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GameDetails`
--

DROP TABLE IF EXISTS `GameDetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GameDetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) DEFAULT NULL,
  `player_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `statistic_type` enum('passes','assists','shots','minutes_played') DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `game_id` (`game_id`),
  KEY `player_id` (`player_id`),
  KEY `team_id` (`team_id`),
  CONSTRAINT `GameDetails_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `GameResult` (`id`),
  CONSTRAINT `GameDetails_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `Player` (`id`),
  CONSTRAINT `GameDetails_ibfk_3` FOREIGN KEY (`team_id`) REFERENCES `NationalTeam` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GameDetails`
--

LOCK TABLES `GameDetails` WRITE;
/*!40000 ALTER TABLE `GameDetails` DISABLE KEYS */;
INSERT INTO `GameDetails` VALUES
(6,3,1,1,'passes',120),
(7,3,1,1,'passes',120);
/*!40000 ALTER TABLE `GameDetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GameResult`
--

DROP TABLE IF EXISTS `GameResult`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GameResult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_date` date DEFAULT NULL,
  `team1_id` int(11) DEFAULT NULL,
  `team2_id` int(11) DEFAULT NULL,
  `final_result` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team1_id` (`team1_id`),
  KEY `team2_id` (`team2_id`),
  CONSTRAINT `GameResult_ibfk_1` FOREIGN KEY (`team1_id`) REFERENCES `NationalTeam` (`id`),
  CONSTRAINT `GameResult_ibfk_2` FOREIGN KEY (`team2_id`) REFERENCES `NationalTeam` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GameResult`
--

LOCK TABLES `GameResult` WRITE;
/*!40000 ALTER TABLE `GameResult` DISABLE KEYS */;
INSERT INTO `GameResult` VALUES
(3,'2004-06-12',1,2,'2-1'),
(4,'2004-06-12',1,2,'2-1');
/*!40000 ALTER TABLE `GameResult` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GroupParticipation`
--

DROP TABLE IF EXISTS `GroupParticipation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GroupParticipation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `accumulated_points` int(11) DEFAULT NULL,
  `games_played` int(11) DEFAULT NULL,
  `wins` int(11) DEFAULT NULL,
  `draws` int(11) DEFAULT NULL,
  `losses` int(11) DEFAULT NULL,
  `goal_difference` int(11) DEFAULT NULL,
  `goals_scored` int(11) DEFAULT NULL,
  `goals_conceded` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_id` (`team_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `GroupParticipation_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `Team` (`id`),
  CONSTRAINT `GroupParticipation_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `GroupTable` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GroupParticipation`
--

LOCK TABLES `GroupParticipation` WRITE;
/*!40000 ALTER TABLE `GroupParticipation` DISABLE KEYS */;
/*!40000 ALTER TABLE `GroupParticipation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GroupTable`
--

DROP TABLE IF EXISTS `GroupTable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GroupTable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GroupTable`
--

LOCK TABLES `GroupTable` WRITE;
/*!40000 ALTER TABLE `GroupTable` DISABLE KEYS */;
INSERT INTO `GroupTable` VALUES
(1,'Group A');
/*!40000 ALTER TABLE `GroupTable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `NationalTeam`
--

DROP TABLE IF EXISTS `NationalTeam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NationalTeam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `coach` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NationalTeam`
--

LOCK TABLES `NationalTeam` WRITE;
/*!40000 ALTER TABLE `NationalTeam` DISABLE KEYS */;
INSERT INTO `NationalTeam` VALUES
(1,'Portugal','flag_portugal.png','Fernando Santos'),
(2,'Espanha','flag_spain.png','Luis Enrique');
/*!40000 ALTER TABLE `NationalTeam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `OrganizerCountry`
--

DROP TABLE IF EXISTS `OrganizerCountry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OrganizerCountry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `currency` varchar(50) DEFAULT NULL,
  `capital` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `OrganizerCountry`
--

LOCK TABLES `OrganizerCountry` WRITE;
/*!40000 ALTER TABLE `OrganizerCountry` DISABLE KEYS */;
/*!40000 ALTER TABLE `OrganizerCountry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Player`
--

DROP TABLE IF EXISTS `Player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `position` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Player`
--

LOCK TABLES `Player` WRITE;
/*!40000 ALTER TABLE `Player` DISABLE KEYS */;
INSERT INTO `Player` VALUES
(1,'Cristiano Ronaldo','Forward','1985-02-05'),
(2,'Lionel Messi','Forward','1987-06-24'),
(3,'Kylian Mbappé','Forward','1998-12-20'),
(4,'Neymar','Forward','1992-02-05');
/*!40000 ALTER TABLE `Player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Stadium`
--

DROP TABLE IF EXISTS `Stadium`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Stadium` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `pitch_type` varchar(50) DEFAULT NULL,
  `inauguration_year` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  CONSTRAINT `Stadium_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `City` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Stadium`
--

LOCK TABLES `Stadium` WRITE;
/*!40000 ALTER TABLE `Stadium` DISABLE KEYS */;
INSERT INTO `Stadium` VALUES
(1,'Estádio da Luz','Lisbon',1,65000,'Grass',2003);
/*!40000 ALTER TABLE `Stadium` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Substitution`
--

DROP TABLE IF EXISTS `Substitution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Substitution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) DEFAULT NULL,
  `minute` int(11) DEFAULT NULL,
  `substituted_player_id` int(11) DEFAULT NULL,
  `substitute_player_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `game_id` (`game_id`),
  KEY `substituted_player_id` (`substituted_player_id`),
  KEY `substitute_player_id` (`substitute_player_id`),
  CONSTRAINT `Substitution_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `GameResult` (`id`),
  CONSTRAINT `Substitution_ibfk_2` FOREIGN KEY (`substituted_player_id`) REFERENCES `Player` (`id`),
  CONSTRAINT `Substitution_ibfk_3` FOREIGN KEY (`substitute_player_id`) REFERENCES `Player` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Substitution`
--

LOCK TABLES `Substitution` WRITE;
/*!40000 ALTER TABLE `Substitution` DISABLE KEYS */;
INSERT INTO `Substitution` VALUES
(5,3,70,2,4);
/*!40000 ALTER TABLE `Substitution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Team`
--

DROP TABLE IF EXISTS `Team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `coach` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Team`
--

LOCK TABLES `Team` WRITE;
/*!40000 ALTER TABLE `Team` DISABLE KEYS */;
INSERT INTO `Team` VALUES
(1,'Portugal','flag_portugal.png','Fernando Santos');
/*!40000 ALTER TABLE `Team` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-01 14:26:53
