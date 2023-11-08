CREATE DATABASE  IF NOT EXISTS `purple_filmes` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `purple_filmes`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: purple_filmes
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `elenco`
--

DROP TABLE IF EXISTS `elenco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `elenco` (
  `id_filme` int NOT NULL,
  `elenco_1` varchar(70) DEFAULT NULL,
  `elenco_2` varchar(70) DEFAULT NULL,
  `elenco_3` varchar(70) DEFAULT NULL,
  `elenco_4` varchar(70) DEFAULT NULL,
  `elenco_5` varchar(70) DEFAULT NULL,
  `elenco_6` varchar(70) DEFAULT NULL,
  `elenco_7` varchar(70) DEFAULT NULL,
  `elenco_8` varchar(70) DEFAULT NULL,
  `elenco_9` varchar(70) DEFAULT NULL,
  `elenco_10` varchar(70) DEFAULT NULL,
  `elenco_11` varchar(70) DEFAULT NULL,
  `elenco_12` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id_filme`),
  CONSTRAINT `elenco_ibfk_1` FOREIGN KEY (`id_filme`) REFERENCES `filmes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elenco`
--

LOCK TABLES `elenco` WRITE;
/*!40000 ALTER TABLE `elenco` DISABLE KEYS */;
INSERT INTO `elenco` VALUES (1,'Miles Morales (Shameik Moore)','Gwen Stacy (Hailee Steinfeld)','Peter B. Parker (Homem-Aranha) (Jake Johnson)','Homem-Aranha 2099 (Oscar Isaac)','Doutor Octopus (Kathryn Hahn)','Mãe de Miles Morales (Rio Morales) (Lauren Vélez)','Peter Parker (Homem-Aranha) (Tobey Maguire)','Ben Reilly (Homem-Aranha) (Andy Samberg)','Jessica Drew (Issa Rae)','George Stacy (Shea Whigham)','Gatuno (Donald Glover)','Spectacular Spider-Man (Josh Keaton)'),(2,'Joaquin Phoenix (Arthur Fleck / Coringa)','Robert De Niro (Murray Franklin)','Zazie Beetz (Sophie Dumond)','Frances Conroy (Penny Fleck)','Brett Cullen (Thomas Wayne)','Shea Whigham (Detetive Burke)','Bill Camp (Detetive Garrity)','Glenn Fleshler (Randal)l','Leigh Gill (Gary)','Josh Pais (Hoyt Vaughn)','Marc Maron (Ted Marco)','Dante Pereira-Olson (Bruce Wayne)'),(3,'Toni Collette (Annie Graham)','Gabriel Byrne (Steve Graham)','Alex Wolff (Peter Graham)','Milly Shapiro (Charlie Graham)','Ann Dowd (Joan)','Jared Leto (Angel Face)','placeholder','placeholder','placeholder','placeholder','placeholder','placeholder'),(4,'Edward Norton (Narrador / Jack)','Brad Pitt (Tyler Durden)','Helena Bonham Carter (Marla Singer)','Meat Loaf (Robert \"Bob\" Paulson)','Jared Leto (Angel Face)','Zach Grenier (Richard Chesler)','Richmond Arquette (Ricky)','David Andrews (Thomas)','George Maguire (Group Leader)','Eugenie Bondurant (Weeping Woman)','placeholder','placeholder'),(5,'Miguel (Léo Jaime)','Ernesto de la Cruz (Raul Gil)','Héctor (Miguel Falabella)','Mama Imelda (Kacau Gomes)','Coco (Ermínia Guedes)','Enrique (Rodrigo Lombardi)','Abuelita (Christiane Torloni)','Tio Berto (Marcelo Garcia)','Frida Kahlo (Camila Márdila)','placeholder','placeholder','placeholder'),(6,'Dwayne Johnson (Dr. Smolder Bravestone / Spencer)','Kevin Hart (Mouse Finbar / Fridge)','Jack Black (Professor Shelly Oberon / Bethany)','Karen Gillan (Ruby Roundhouse / Martha)','Nick Jonas (Alex Vreeke)','Bobby Cannavale (Van Pelt)','Rhys Darby (Nigel Billingsley)','Alex Wolff (Spencer Gilpin)','Ser\'Darius Blain (Anthony \"Fridge\" Johnson)','Madison Iseman (Bethany Walker)','Morgan Turner (Martha Kaply)','Mason Guccione (Alex Vreeke jovem)'),(8,'Christian Bale (Bruce Wayne / Batman)','Heath Ledger (Coringa)','Aaron Eckhart (Harvey Dent / Duas-Caras)','Michael Caine (Alfred Pennyworth)','Gary Oldman (James Gordon)','Morgan Freeman (Lucius Fox)','Maggie Gyllenhaal (Rachel Dawes)','Eric Roberts (Sal Maroni)','Cillian Murphy (Dr. Jonathan Crane / Espantalho)','Nestor Carbonell (Prefeito Garcia)','placeholder','placeholder'),(9,'Chris Pratt (Peter Quill / Senhor das Estrelas)','Zoe Saldana (Gamora)','Dave Bautista (Drax, o Destruidor)','Vin Diesel (Groot)','Bradley Cooper (Rocket, o guaxinim)','Lee Pace (Ronan, o Acusador)','Michael Rooker (Yondu Udonta)','Karen Gillan (Nebulosa)','Djimon Hounsou (Korath, o Perseguidor)','John C. Reilly (Rhomann Dey)','Glenn Close (Nova Prime Irani Rael)','Benicio del Toro (O Colecionador)'),(10,'placeholder','placeholder','placeholder','placeholder','placeholder','placeholder','placeholder','placeholder','placeholder','placeholder','placeholder','placeholder');
/*!40000 ALTER TABLE `elenco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filmes`
--

DROP TABLE IF EXISTS `filmes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `filmes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `comentario` varchar(50) DEFAULT NULL,
  `sinopse` varchar(500) DEFAULT NULL,
  `clasificacao` varchar(10) DEFAULT NULL,
  `nota` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filmes`
--

LOCK TABLES `filmes` WRITE;
/*!40000 ALTER TABLE `filmes` DISABLE KEYS */;
INSERT INTO `filmes` VALUES (1,'Homem-Aranha','Homem-Aranha Através do aranhaverso','Miles Morales está de volta com a saga vencedora do Oscar® e, agora junto a Gwen Stacy, é lançado no Multiverso para proteger a existência com um time de Pessoas-Aranha. Ele enfrentara desafios que o fara redefinir seu papel como herói para salvar seus entes queridos.','A10',3),(2,'Coringa','Coringa o Palhaço sádico','\"Coringa\" segue a história de Arthur Fleck, um comediante fracassado em Gotham City. Ele enfrenta desafios pessoais, incluindo uma relação complicada com sua mãe e uma suposta ligação com Thomas Wayne. À medida que Arthur mergulha na insanidade, torna-se o Coringa, um ícone de rebelião contra a sociedade. O filme aborda questões sociais e violência, com destaque para a atuação de Joaquin Phoenix. Robert De Niro interpreta um apresentador de TV influente na jornada de Arthur.','A16',4),(3,'Hereditário','Você vai perder a cabeça','Após a morte da reclusa avó, a família Graham começa a desvendar algumas coisas. Mesmo após a partida da matriarca, ela permanece como se fosse uma sombra sobre a família, especialmente sobre a solitária neta adolescente, Charlie, por quem ela sempre manteve uma fascinação não usual. Com um crescente terror tomando conta da casa, a família explora lugares mais escuros para escapar do infeliz destino que herdaram.','A16',2),(4,'Clube da Luta','Não fale sobre o Clube da Luta','Um homem deprimido que sofre de insônia conhece um estranho vendedor chamado Tyler Durden e se vê morando em uma casa suja depois que seu perfeito apartamento é destruído. A dupla forma um clube com regras rígidas onde homens lutam. A parceria perfeita é comprometida quando uma mulher, Marla, atrai a atenção de Tyler.','A18',3),(5,'Viva a Vida é uma festa','Prometo que não vai chorar','Apesar da proibição da música por gerações de sua família, o jovem Miguel sonha em se tornar um músico talentoso como seu ídolo Ernesto de la Cruz. Desesperado para provar seu talento, Miguel se encontra na deslumbrante e colorida Terra dos Mortos. Depois de conhecer um charmoso malandro chamado Héctor, os dois novos amigos embarcam em uma jornada extraordinária para desvendar a verdadeira história por trás da história da família de Miguel.','ALivre',4),(6,'Jumanji','Vamos jogar?','Quatro adolescentes encontram um videogame cuja ação se passa em uma floresta tropical. Empolgados com o jogo, eles escolhem seus avatares para o desafio, mas um evento inesperado faz com que eles sejam transportados para dentro do universo fictício, transformando-os nos personagens da aventura.','A12',2),(8,'Batman Cavaleiro das trevas','Ator secundário rouba a cena','Batman tem conseguido manter a ordem em Gotham com a ajuda de Jim Gordon e Harvey Dent. No entanto, um jovem e anárquico criminoso, conhecido apenas como Coringa, pretende testar o Cavaleiro das Trevas e mergulhar a cidade em um verdadeiro caos.','A12',5),(9,'Guardiões da Galáxia','Melhor saga de filmes de heróis','O aventureiro do espaço Peter Quill torna-se presa de caçadores de recompensas depois que rouba a esfera de um vilão traiçoeiro, Ronan. Para escapar do perigo, ele faz uma aliança com um grupo de quatro extraterrestres. Quando Quill descobre que a esfera roubada possui um poder capaz de mudar os rumos do universo, ele e seu grupo deverão proteger o objeto para salvar o futuro da galáxia.','A12',4),(10,'One Piece filme:Red','O futuro rei dos piratas','placeHolder','A12',3);
/*!40000 ALTER TABLE `filmes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagens_filme`
--

DROP TABLE IF EXISTS `imagens_filme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imagens_filme` (
  `id_filme` int NOT NULL,
  `capa` varchar(50) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `trailer` varchar(50) DEFAULT NULL,
  `fundo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_filme`),
  CONSTRAINT `imagens_filme_ibfk_1` FOREIGN KEY (`id_filme`) REFERENCES `filmes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagens_filme`
--

LOCK TABLES `imagens_filme` WRITE;
/*!40000 ALTER TABLE `imagens_filme` DISABLE KEYS */;
INSERT INTO `imagens_filme` VALUES (1,'homen-aranhaAranhaverso.jpg','homen-aranhaAranhaversoLogo.png','homen-aranhaAranhaversoTrailer.mp4','aranhaversoFundo.jpg'),(2,'coringa.jpg','coringaLogo.png','coringaTrailer.mp4','coringaFundo.jpg'),(3,'hereditario.jpg','hereditarioLogo.png','hereditarioTrailer.mp4','hereditarioFundo.jpg'),(4,'clubeDaLuta.jpg','logoPadrao.png','semTrailer.mp4','fundoPadrao.jpg'),(5,'viva.jpg','vivaLogo.png','vivaTrailer.mp4','vivaFundo.jpg'),(6,'jumanji.jpg','jumanjiLogo.png','semTrailer.mp4','jumanjiFundo.jpg'),(8,'batmanCDT.jpg','logoPadrao.png','semTrailer.mp4','fundoPadrao.jpg'),(9,'guardioesDaGalaxia.jpg','guardioesDaGalaxiaLogo.png','guardioesDaGalaxiaTrailer.mp4','guardioesDaGalaxiaFundo.jpg'),(10,'onePieceRed.jpg','logoPadrao.png','semTrailer.mp4','fundoPadrao.jpg');
/*!40000 ALTER TABLE `imagens_filme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'teste','123'),(2,'Marlom','456'),(3,'Marcos','789');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-08 17:57:49
