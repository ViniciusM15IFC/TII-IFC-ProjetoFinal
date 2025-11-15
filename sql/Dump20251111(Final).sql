-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
--
-- Host: localhost    Database: tii-ifc-projetofinal
-- ------------------------------------------------------
-- Server version	8.0.43

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `idusuario` int NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (9),(10);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `idcategoria` int NOT NULL AUTO_INCREMENT,
  `nomecategoria` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Filme'),(2,'Série'),(3,'Livro');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classificacao`
--

DROP TABLE IF EXISTS `classificacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classificacao` (
  `idclassificacao` int NOT NULL AUTO_INCREMENT,
  `nomeclassificacao` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idclassificacao`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classificacao`
--

LOCK TABLES `classificacao` WRITE;
/*!40000 ALTER TABLE `classificacao` DISABLE KEYS */;
INSERT INTO `classificacao` VALUES (1,'Livre'),(2,'10'),(3,'12'),(4,'14'),(5,'16'),(6,'18');
/*!40000 ALTER TABLE `classificacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentario`
--

DROP TABLE IF EXISTS `comentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comentario` (
  `idcomentario` int NOT NULL AUTO_INCREMENT,
  `idusuario` int DEFAULT NULL,
  `idpostagem` int DEFAULT NULL,
  `texto` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `datacomentario` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idcomentario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentario`
--

LOCK TABLES `comentario` WRITE;
/*!40000 ALTER TABLE `comentario` DISABLE KEYS */;
INSERT INTO `comentario` VALUES (1,10,8,'Teste','2025-11-07 21:16:32'),(2,10,18,'Quem em sã consciencia não gosta desse filme?','2025-11-11 09:19:11'),(3,14,2,'ewewewe','2025-11-11 09:32:55'),(4,16,15,'seraaaaa','2025-11-11 09:47:55'),(5,18,27,'asaaa\r\n','2025-11-11 10:39:01'),(6,20,28,'é o melhor','2025-11-11 10:50:26'),(7,20,29,'assistam!','2025-11-11 10:53:37'),(8,24,33,'a\r\n','2025-11-11 11:19:07'),(9,13,21,'ooo\r\n','2025-11-11 11:25:07'),(10,25,38,'a','2025-11-11 11:37:04');
/*!40000 ALTER TABLE `comentario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conteudo`
--

DROP TABLE IF EXISTS `conteudo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conteudo` (
  `idconteudo` int NOT NULL,
  `idcategoria` int NOT NULL,
  PRIMARY KEY (`idconteudo`,`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conteudo`
--

LOCK TABLES `conteudo` WRITE;
/*!40000 ALTER TABLE `conteudo` DISABLE KEYS */;
INSERT INTO `conteudo` VALUES (3,2),(3,3),(4,1),(4,2),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1);
/*!40000 ALTER TABLE `conteudo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curtida`
--

DROP TABLE IF EXISTS `curtida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curtida` (
  `idusuario` int NOT NULL,
  `idpostagem` int NOT NULL,
  PRIMARY KEY (`idusuario`,`idpostagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curtida`
--

LOCK TABLES `curtida` WRITE;
/*!40000 ALTER TABLE `curtida` DISABLE KEYS */;
INSERT INTO `curtida` VALUES (9,24),(10,18),(10,20),(10,33),(13,18),(13,20),(13,21),(14,2),(16,15),(18,27),(19,28),(20,22),(20,25),(20,28),(20,29),(21,31),(24,33),(25,38),(25,39);
/*!40000 ALTER TABLE `curtida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `denuncia`
--

DROP TABLE IF EXISTS `denuncia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `denuncia` (
  `iddenuncia` int NOT NULL AUTO_INCREMENT,
  `idusuario` int DEFAULT NULL,
  `motivo` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpostagem` int DEFAULT NULL,
  PRIMARY KEY (`iddenuncia`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `denuncia`
--

LOCK TABLES `denuncia` WRITE;
/*!40000 ALTER TABLE `denuncia` DISABLE KEYS */;
INSERT INTO `denuncia` VALUES (1,NULL,'Vou denunciar só pq é a Isabella né',25);
/*!40000 ALTER TABLE `denuncia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filme`
--

DROP TABLE IF EXISTS `filme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `filme` (
  `idfilme` int NOT NULL AUTO_INCREMENT,
  `nomefilme` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `duracao` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idclassificacao` int DEFAULT NULL,
  `idgenero` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `direcao` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sinopse` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `anolancamento` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagem` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idfilme`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filme`
--

LOCK TABLES `filme` WRITE;
/*!40000 ALTER TABLE `filme` DISABLE KEYS */;
INSERT INTO `filme` VALUES (3,'Superman','2h9min',4,'2','James Gunn','Superman embarca em uma jornada para reconciliar sua herança kryptoniana com sua criação humana.','2025','img_68f5323eca4eb6.76558542.jpeg'),(4,'O Jogo da Imitação','1h54min',3,'5','Morten Tyldum','Em 1939, a recém-criada agência de inteligência britânica MI6 recruta Alan Turing, um aluno da Universidade de Cambridge, para entender códigos nazistas, incluindo o \"Enigma\", que criptógrafos acreditavam ser inquebrável.','2014','img_68f54c17b65320.68813931.jpg'),(5,'Alice no País das Maravilhas','1h48m',2,'9','Tim Burton','Ainda garotinha, Alice Kingsleigh visitou um lugar mágico pela primeira vez e não tinha mais lembranças sobre o local a não ser em seus sonhos. Em uma festa da nobreza, a jovem vê um coelho branco. Alice o segue e cai em um buraco, indo parar em um mundo estranho: o País das Maravilhas. ','2010','img_68f58b29cfe0b5.43818480.jpg'),(7,'De Volta Para o Futuro','1h56min',3,'8','Robert Zemeckis','O adolescente Marty McFly é transportado para o ano de 1955 quando uma experiência do excêntrico cientista Doc Brown é malsucedida. Marty viaja pelo tempo em um carro modificado e acaba conhecendo seus pais ainda jovens. O problema é que ele pode deixar de existir porque interferiu na rotina dos pais, que correm o risco de não se apaixonarem mais. Para complicar ainda mais a situação, Marty precisa voltar para casa a tempo de salvar o cientista.','1985','img_690bd0b01c86b0.17694934.jpg'),(8,'De Volta Para o Futuro 2','1h58min',3,'8','Robert Zemeckis','Marty McFly e o cientista \"Doc\" Brown viajam de 1985 a 2015 para evitar que o filho de Marty estrague o futuro da família McFly. Porém, seu arqui-inimigo Biff Tannen rouba a máquina do tempo de Doc, o DeLorean, e a usa para alterar a história em seu benefício, forçando a dupla a retornar a 1955 para restaurar a linha do tempo.','1989','img_690bd1740c41f3.63330171.webp'),(9,'De Volta Para o Futuro 3','1h58min',3,'8','Robert Zemeckis','Marty recebe uma carta do Dr. Emmett Brown contando que agora vive em uma pequena cidade do Velho Oeste, em 1885. Quando Marty descobre que Doc é assassinado dias após o envio da carta, ele decide voltar no tempo mais uma vez para salvar seu amigo.','1990','img_690bd1ac2092a9.28251277.jpg'),(10,'Clube da Luta','2h19min',6,'2','David Fincher','Um homem deprimido que sofre de insônia conhece um estranho vendedor chamado Tyler Durden e se vê morando em uma casa suja depois que seu perfeito apartamento é destruído. A dupla forma um clube com regras rígidas onde homens lutam. A parceria perfeita é comprometida quando uma mulher, Marla, atrai a atenção de Tyler.','1999','img_691292945fa8d3.93530365.jpg'),(11,'Batman: O Cavaleiro das Trevas','2h32min',4,'2','Christopher Nolan','Batman tem conseguido manter a ordem em Gotham com a ajuda de Jim Gordon e Harvey Dent. No entanto, um jovem e anárquico criminoso, conhecido apenas como Coringa, pretende testar o Cavaleiro das Trevas e mergulhar a cidade em um verdadeiro caos.','2008','img_691293d6143742.97656547.jpeg'),(12,'Interstellar','2h49min',2,'8','Christopher Nolan','As reservas naturais da Terra estão chegando ao fim e um grupo de astronautas recebe a missão de verificar possíveis planetas para receberem a população mundial, possibilitando a continuação da espécie. Cooper é chamado para liderar o grupo e aceita a missão sabendo que pode nunca mais ver os filhos. Ao lado de Brand, Jenkins e Doyle, ele seguirá em busca de um novo lar.','2014','img_69129461a12589.92739840.png');
/*!40000 ALTER TABLE `filme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genero`
--

DROP TABLE IF EXISTS `genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genero` (
  `idgenero` int NOT NULL AUTO_INCREMENT,
  `nomegenero` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idgenero`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genero`
--

LOCK TABLES `genero` WRITE;
/*!40000 ALTER TABLE `genero` DISABLE KEYS */;
INSERT INTO `genero` VALUES (1,'Aventura'),(2,'Ação'),(3,'Terror'),(4,'Comédia'),(5,'Drama'),(6,'Suspense'),(7,'Romance'),(8,'Ficção Cientifica'),(9,'Fantasia'),(10,'Mistério'),(11,'Thriller');
/*!40000 ALTER TABLE `genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livro`
--

DROP TABLE IF EXISTS `livro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `livro` (
  `idlivro` int NOT NULL AUTO_INCREMENT,
  `nomelivro` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idgenero` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idclassificacao` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagem` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `paginas` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `autor` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `editora` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sinopse` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idlivro`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livro`
--

LOCK TABLES `livro` WRITE;
/*!40000 ALTER TABLE `livro` DISABLE KEYS */;
INSERT INTO `livro` VALUES (2,'David Copperfield','7','1','img_68f54083cfec05.22079792.jpg','864','Charles Dickens','Martins Fontes','David Copperfield narra a vida de um jovem órfão desde a infância até a vida adulta, abordando suas experiências de pobreza, amizade, amor e superação, retratando a sociedade vitoriana da Inglaterra.');
/*!40000 ALTER TABLE `livro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postagem`
--

DROP TABLE IF EXISTS `postagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `postagem` (
  `idpostagem` int NOT NULL AUTO_INCREMENT,
  `idconteudo` int DEFAULT NULL,
  `idcategoria` int DEFAULT NULL,
  `nota` float DEFAULT NULL,
  `texto` varchar(2000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idusuario` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `datapostagem` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idpostagem`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postagem`
--

LOCK TABLES `postagem` WRITE;
/*!40000 ALTER TABLE `postagem` DISABLE KEYS */;
INSERT INTO `postagem` VALUES (1,3,1,9,'a','9','2025-10-20 09:08:14'),(2,5,1,8,'alice','9','2025-10-20 09:22:05'),(7,2,2,10,'Melhor Série do Universo, quem critica não entende nada de cultura e é bobão cara de mamão','10','2025-10-30 14:30:44'),(9,4,1,1,'esses olos feios da capa cruzes cersdo coisa mais f er9i\\as demitam a mae desse fotografo por nao ter abortado eled','1','2025-10-30 14:41:32'),(10,2,2,1,'agora UM MICO esse site do governo','1','2025-10-30 14:42:58'),(15,3,1,7,'será?','10','2025-11-08 17:29:47'),(18,7,1,10,'Filmaço, os persogens são muitos gostáveis, o enredo é divertido, apesar dos paradoxos, e é um filme atemporal','10','2025-11-10 12:02:31'),(20,7,1,10,'dfdf','10','2025-11-11 09:34:16'),(21,12,1,10,'nolan','13','2025-11-11 09:39:47'),(22,9,1,3,'mais ou menos','15','2025-11-11 09:44:33'),(23,8,1,10,'sera que sera um bom filme.','16','2025-11-11 09:48:55'),(24,3,2,4,'Gostei muito da primeira temporada, mas a segunda não foi tão legal e a terceira não entendi nada.','17','2025-11-11 09:57:42'),(25,5,1,7,'','9','2025-11-11 10:09:53'),(26,5,1,10,'maravilhoso!','18','2025-11-11 10:36:57'),(27,7,1,7,'opiniao','18','2025-11-11 10:38:39'),(28,8,1,8,'Top','19','2025-11-11 10:47:13'),(29,10,1,10,'crássico','20','2025-11-11 10:51:32'),(30,7,1,5,'aaaaaaaa','20','2025-11-11 10:55:56'),(31,11,1,7,'muito bom, adoro o coringa desse filme','21','2025-11-11 11:01:23'),(32,12,1,7,'não assisti, achei ruim q acaba','23','2025-11-11 11:07:08'),(33,5,1,7,'dfdfdf','10','2025-11-11 11:12:27'),(34,2,3,7,'aeaea','24','2025-11-11 11:20:18'),(35,9,1,9,'','13','2025-11-11 11:26:16'),(36,10,1,10,'Está no meu Top 10. Um dos melhores plot twists do cinema.','25','2025-11-11 11:30:59'),(37,10,1,10,'Está no meu Top 10. Um dos melhores plot twists do cinema.','25','2025-11-11 11:30:59'),(38,12,1,7,'avaliacao','25','2025-11-11 11:36:51'),(39,3,1,7,'aaaaaa','25','2025-11-11 11:41:13'),(40,7,1,8,'aaaaaaaaaaaaaa','10','2025-11-11 11:49:38');
/*!40000 ALTER TABLE `postagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguido`
--

DROP TABLE IF EXISTS `seguido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seguido` (
  `idseguido` int NOT NULL,
  `idusuario` int NOT NULL,
  PRIMARY KEY (`idseguido`,`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguido`
--

LOCK TABLES `seguido` WRITE;
/*!40000 ALTER TABLE `seguido` DISABLE KEYS */;
INSERT INTO `seguido` VALUES (1,9),(1,18),(7,1),(7,9),(7,13),(7,19),(7,23),(7,24),(9,1),(9,10),(9,13),(9,14),(9,18),(9,19),(9,20),(9,25),(10,9),(10,13),(10,16),(10,18),(10,21),(10,23),(10,25),(11,13),(11,19),(11,20),(13,15),(19,20),(20,13),(20,21),(20,24),(23,10),(24,25);
/*!40000 ALTER TABLE `seguido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguidor`
--

DROP TABLE IF EXISTS `seguidor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seguidor` (
  `idseguidor` int NOT NULL,
  `idusuario` int NOT NULL,
  PRIMARY KEY (`idseguidor`,`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguidor`
--

LOCK TABLES `seguidor` WRITE;
/*!40000 ALTER TABLE `seguidor` DISABLE KEYS */;
/*!40000 ALTER TABLE `seguidor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serie`
--

DROP TABLE IF EXISTS `serie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `serie` (
  `idserie` int NOT NULL AUTO_INCREMENT,
  `nomeserie` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idgenero` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idclassificacao` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagem` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `episodios` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `temporadas` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `anoinicio` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `anoencerramento` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sinopse` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idserie`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serie`
--

LOCK TABLES `serie` WRITE;
/*!40000 ALTER TABLE `serie` DISABLE KEYS */;
INSERT INTO `serie` VALUES (2,'Doctor Who','8','2','img_68f53a3fe70db3.42895616.jpg','240','13','2005','2022','Aventuras por todo tempo e espaço'),(3,'Dark','8','5','img_68f54ce9e35f66.91575853.jpeg','26','3','2017','2020','Quatro diferentes famílias - Kahnwald, Nielsen, Doppler e Tiedemann - vivem em Winden, uma pequena e aparentemente tranquila cidade alemã. A rotina dos moradores vira de cabeça para baixo quando duas crianças desaparecem misteriosamente, nas proximidades de uma antiga usina nuclear.');
/*!40000 ALTER TABLE `serie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sugestao`
--

DROP TABLE IF EXISTS `sugestao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sugestao` (
  `idsugestao` int NOT NULL,
  `nomesugestao` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idsugestao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sugestao`
--

LOCK TABLES `sugestao` WRITE;
/*!40000 ALTER TABLE `sugestao` DISABLE KEYS */;
/*!40000 ALTER TABLE `sugestao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `idusuario` int NOT NULL AUTO_INCREMENT,
  `nomeusuario` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `senha` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `datanasc` date DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'fernandinhoplay','fernando123@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','',NULL),(7,'Doutor','usuario1234@gmail.com','53d670af9bb16ea82e7ef41ee23ec6df','img_68deabca435b50.90781740.jpg','2012-04-12'),(9,'Isabella','morangodoamor@gmail.com','a4dbfd6aef3b4045fe61aa0146debdf8','img_68e3b35f2026b8.10723459.jpg','1877-03-08'),(10,'Vinicius','viniwstorm@gmail.com','701f232cbfaf29db6e1756b447afbfc5','img_6903a0251de5d5.53643119.jpg','2007-04-13'),(11,'Jaine','schweig@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','img_6903a7b26d9836.08593135.jpg','2008-02-29'),(13,'Bernardo','bernandinho123@gmail.com','6a6dc45d4af31d1366031e084ac9cea0','img_69129669ed87d2.96428492.webp','1311-02-23'),(14,'Aleke','teste@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','','2006-03-10'),(15,'Pereti','pereti@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','','2007-11-14'),(16,'otavioslongo91','otavioslongo19@gmail.com','281b57ff6a1040dce5718c9cc2976755','img_6913304b1ba9b1.03800367.jpg','2009-06-09'),(17,'Kelly','kellyagomes@yahoo.com','3ca6ca10ef7b19a643e7f0228bae600e','','1980-12-07'),(18,'Sophia Duquesne da Rosa','sophia@gmail.com','202cb962ac59075b964b07152d234b70','','2008-11-26'),(19,'silvio','silvio@gmail.com','202cb962ac59075b964b07152d234b70','img_69133dee17a487.38348735.jpeg','2007-12-05'),(20,'Fabio Pinheiro','fabio@gmail.com','202cb962ac59075b964b07152d234b70','img_69133ed9af5b77.14670359.jpg','1979-06-13'),(21,'greg','email2@gmail.com','a4dbfd6aef3b4045fe61aa0146debdf8','img_6913416513c059.68694616.webp','2999-12-24'),(22,'greg','email2@gmail.com','a4dbfd6aef3b4045fe61aa0146debdf8','img_69134171c01386.76383405.webp','2999-12-24'),(23,'melbi_lau','melbi@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','','1945-12-12'),(24,'livia','livia@gmail.com','202cb962ac59075b964b07152d234b70','','2008-08-18'),(25,'Prof. Abelardo','fabio.aresi@ifc.edu.br','d5f009b8af6fa7f4cd9a86a4d7bc82c0','','1985-11-02');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-14 23:29:49
