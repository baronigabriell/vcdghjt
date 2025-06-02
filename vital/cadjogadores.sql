-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 02/06/2025 às 20:01
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadjogadores`
--
CREATE DATABASE IF NOT EXISTS `cadjogadores` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cadjogadores`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogadores`
--

DROP TABLE IF EXISTS `jogadores`;
CREATE TABLE IF NOT EXISTS `jogadores` (
  `jogadores_id` int NOT NULL AUTO_INCREMENT,
  `jogador_1` varchar(90) COLLATE utf8mb4_general_ci NOT NULL,
  `jogador_2` varchar(90) COLLATE utf8mb4_general_ci NOT NULL,
  `jogador_3` varchar(90) COLLATE utf8mb4_general_ci NOT NULL,
  `jogador_4` varchar(90) COLLATE utf8mb4_general_ci NOT NULL,
  `jogador_5` varchar(90) COLLATE utf8mb4_general_ci NOT NULL,
  `jogador_6` varchar(90) COLLATE utf8mb4_general_ci NOT NULL,
  `ordem_jogo` text COLLATE utf8mb4_general_ci,
  `indice_vez` int DEFAULT '0',
  PRIMARY KEY (`jogadores_id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `jogadores`
--

INSERT INTO `jogadores` (`jogadores_id`, `jogador_1`, `jogador_2`, `jogador_3`, `jogador_4`, `jogador_5`, `jogador_6`, `ordem_jogo`, `indice_vez`) VALUES
(1, 'a', 'a', 'a', 'a', '', '', NULL, 0),
(2, 'a', 'a', 'a', 'a', 'q', 'q', NULL, 0),
(3, 'A', 'AA', 'A', 'A', '', '', NULL, 0),
(4, 'A', 'AA', 'A', 'A', '', '', NULL, 0),
(5, 'A', 'A', 'A', 'A', '', '', NULL, 0),
(6, 'A', 'A', 'A', 'A', '', '', NULL, 0),
(7, 'a', 'a', 'a', 'a', '', '', NULL, 0),
(8, 'a', 'a', 'a', 'a', '', '', NULL, 0),
(9, 'a', 'a', 'a', 'a', '', '', NULL, 0),
(10, 'a', 'a', 'a', 'a', '', '', NULL, 0),
(11, 'a', 'a', 'a', 'a', '', '', NULL, 0),
(12, 'a', 'a', 'a', 'a', '', '', NULL, 0),
(13, 'a', 'a', 'a', 'a', '', '', NULL, 0),
(14, 'a', 'a', 'a', 'a', '', '', NULL, 0),
(15, 'b', 'b', 'b', 'b', '', '', NULL, 0),
(16, 'b', 'b', 'b', 'b', '', '', NULL, 0),
(17, 'b', 'b', 'b', 'b', '', '', NULL, 0),
(18, 'a', 'a', 'a', 'a', '', '', NULL, 0),
(19, 'a', 'a', 'a', 'a', '', '', NULL, 0),
(20, 'gabriel', 'julia', 'wina', 'geovana', '', '', NULL, 0),
(21, 'gabriel', 'julia', 'wina', 'geovana', '', '', NULL, 0),
(22, 'a', 'a', 'a', 'a', '', '', NULL, 0),
(23, 'a', 'a', 'a', 'a', '', '', NULL, 0),
(24, 'gabriel', 'geovana', 'julia', 'wina', '', '', NULL, 0),
(25, 'gabriel', 'geovana', 'julia', 'wina', '', '', NULL, 0),
(26, 'julia', 'wina', 'gabriel', 'geovana', '', '', NULL, 0),
(27, 'julia', 'wina', 'gabriel', 'geovana', '', '', NULL, 0),
(28, 'gabriel', 'gabriela', 'geovana', 'isabele', 'julia', 'wina', NULL, 0),
(29, 'gabriel', 'gabriela', 'geovana', 'isabele', 'julia', 'wina', NULL, 0),
(30, 'gabriel', 'gabriela', 'geovana', 'isabele', 'julia', 'wina', '[\"gabriela\",\"julia\",\"geovana\",\"isabele\",\"wina\",\"gabriel\"]', 0),
(31, 'julio', 'silva', 'felipe', 'marcos', 'daniel', 'araujo', '[\"daniel\",\"julio\",\"araujo\",\"silva\",\"marcos\",\"felipe\"]', 0),
(32, 'gege', 'bibiel', 'juju', 'wina', 'matheus namo da ju', 'julin', '[\"gege\",\"wina\",\"julin\",\"juju\",\"matheus namo da ju\",\"bibiel\"]', 0),
(33, 'gabriel', 'julio', 'gege', 'aa', '', '', '[\"julio\",\"aa\",\"gabriel\",\"gege\"]', 1),
(34, 'gabriel', 'gabriel', 'julio', 'aa', '', '', '[\"aa\",\"gabriel\",\"gabriel\",\"julio\"]', 3),
(35, 'gabriel', 'gaa', 'grb', 'we', '', '', '[\"we\",\"gaa\",\"grb\",\"gabriel\"]', 2),
(36, 'Aleksandr', 'Dmitri', 'Yakov', 'Ilya', '', '', '[\"Yakov\",\"Aleksandr\",\"Dmitri\",\"Ilya\"]', 1),
(37, 'Aleksandr', 'gege', 'gabriel', 'julio', '', '', '[\"julio\",\"gabriel\",\"gege\",\"Aleksandr\"]', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
