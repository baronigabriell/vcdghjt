-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 30-Maio-2025 às 19:56
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

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
-- Estrutura da tabela `jogadores`
--

DROP TABLE IF EXISTS `jogadores`;
CREATE TABLE IF NOT EXISTS `jogadores` (
  `jogadores_id` int NOT NULL AUTO_INCREMENT,
  `jogador_1` varchar(90) NOT NULL,
  `jogador_2` varchar(90) NOT NULL,
  `jogador_3` varchar(90) NOT NULL,
  `jogador_4` varchar(90) NOT NULL,
  `jogador_5` varchar(90) NOT NULL,
  `jogador_6` varchar(90) NOT NULL,
  PRIMARY KEY (`jogadores_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `jogadores`
--

INSERT INTO `jogadores` (`jogadores_id`, `jogador_1`, `jogador_2`, `jogador_3`, `jogador_4`, `jogador_5`, `jogador_6`) VALUES
(1, 'a', 'a', 'a', 'a', '', ''),
(2, 'a', 'a', 'a', 'a', 'q', 'q'),
(3, 'A', 'AA', 'A', 'A', '', ''),
(4, 'A', 'AA', 'A', 'A', '', ''),
(5, 'A', 'A', 'A', 'A', '', ''),
(6, 'A', 'A', 'A', 'A', '', ''),
(7, 'a', 'a', 'a', 'a', '', ''),
(8, 'a', 'a', 'a', 'a', '', ''),
(9, 'a', 'a', 'a', 'a', '', ''),
(10, 'a', 'a', 'a', 'a', '', ''),
(11, 'a', 'a', 'a', 'a', '', ''),
(12, 'a', 'a', 'a', 'a', '', ''),
(13, 'a', 'a', 'a', 'a', '', ''),
(14, 'a', 'a', 'a', 'a', '', ''),
(15, 'b', 'b', 'b', 'b', '', ''),
(16, 'b', 'b', 'b', 'b', '', ''),
(17, 'b', 'b', 'b', 'b', '', ''),
(18, 'a', 'a', 'a', 'a', '', ''),
(19, 'a', 'a', 'a', 'a', '', ''),
(20, 'gabriel', 'julia', 'wina', 'geovana', '', ''),
(21, 'gabriel', 'julia', 'wina', 'geovana', '', ''),
(22, 'a', 'a', 'a', 'a', '', ''),
(23, 'a', 'a', 'a', 'a', '', ''),
(24, 'gabriel', 'geovana', 'julia', 'wina', '', ''),
(25, 'gabriel', 'geovana', 'julia', 'wina', '', ''),
(26, 'julia', 'wina', 'gabriel', 'geovana', '', ''),
(27, 'julia', 'wina', 'gabriel', 'geovana', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
