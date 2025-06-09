-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/06/2025 às 05:41
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

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
-- Estrutura para tabela `estado_jogo`
--

CREATE TABLE `estado_jogo` (
  `id` int(11) NOT NULL,
  `jogador_atual_id` int(11) DEFAULT NULL,
  `pular_vez` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogadores`
--

CREATE TABLE `jogadores` (
  `jogadores_id` int(11) NOT NULL,
  `jogador_1` varchar(90) NOT NULL,
  `jogador_2` varchar(90) NOT NULL,
  `jogador_3` varchar(90) NOT NULL,
  `jogador_4` varchar(90) NOT NULL,
  `jogador_5` varchar(90) NOT NULL,
  `jogador_6` varchar(90) NOT NULL,
  `ordem_jogo` text DEFAULT NULL,
  `indice_vez` int(11) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(37, 'Aleksandr', 'gege', 'gabriel', 'julio', '', '', '[\"julio\",\"gabriel\",\"gege\",\"Aleksandr\"]', 0),
(38, 'e', 'w', 'i', 'k', '', '', '[\"w\",\"e\",\"i\",\"k\"]', 0),
(39, 'r', 't', 'u', 'v', '', '', '[\"u\",\"r\",\"t\",\"v\"]', 2),
(40, 'katia', 'lorraine', 'jhennyfer', 'paolla', '', '', '[\"paolla\",\"katia\",\"jhennyfer\",\"lorraine\"]', 2),
(41, 'jo', 'ma', 'na', 'el', '', '', '[\"el\",\"jo\",\"ma\",\"na\"]', 2),
(42, 'jo', 'r', 'e', 'katia', '', '', '[\"r\",\"jo\",\"katia\",\"e\"]', 1),
(43, 'jo', 'jo', 'i', 'i', '', '', '[\"jo\",\"i\",\"i\",\"jo\"]', 1),
(44, 'jo', 'e', 'w', 'i', '', '', '[\"jo\",\"e\",\"w\",\"i\"]', 1),
(45, 'jo', 'e', 'w', 'r', '', '', '[\"jo\",\"e\",\"r\",\"w\"]', 0),
(46, 'jo', 'e', 'w', 'i', '', '', '[\"i\",\"jo\",\"w\",\"e\"]', 0),
(47, 'jo', 'e', 'w', 'w', 'r', 'katia', '[\"w\",\"r\",\"e\",\"w\",\"katia\",\"jo\"]', 0),
(48, 'katia', 'e', 'w', 'r', '', '', '[\"w\",\"r\",\"katia\",\"e\"]', 0),
(49, 'jo', 'e', 'e', 'katia', '', '', '[\"e\",\"jo\",\"e\",\"katia\"]', 0),
(50, 'fds', 'sdf', 'dfs', 'dsf', '', '', '[\"dsf\",\"fds\",\"sdf\",\"dfs\"]', 0),
(51, 'katia', 'e', 'jo', 'katia', '', '', '[\"e\",\"jo\",\"katia\",\"katia\"]', 0),
(52, 'katia', 'jo', 'e', 'katia', '', '', '[\"e\",\"katia\",\"jo\",\"katia\"]', 0),
(53, 'a', 'a', 'a', 'a', '', '', '[\"a\",\"a\",\"a\",\"a\"]', 0),
(54, 'a', 'b', 'c', 'd', '', '', '[\"d\",\"c\",\"b\",\"a\"]', 3),
(55, 'jo', 'katia', 'e', 'a', '', '', '[\"e\",\"katia\",\"jo\",\"a\"]', 3),
(56, 'jo', 'katia', 'e', 'a', '', '', '[\"e\",\"jo\",\"a\",\"katia\"]', 0),
(57, 'a', 'b', 'c', 'd', '', '', '[\"c\",\"a\",\"b\",\"d\"]', 2),
(58, 'katia', 'jo', 'e', 'w', '', '', '[\"jo\",\"katia\",\"e\",\"w\"]', 1),
(59, 'jo', 'katia', 'a', 'e', '', '', '[\"katia\",\"a\",\"e\",\"jo\"]', 1),
(60, 'katia', 'jo', 'a', 'e', '', '', '[\"a\",\"katia\",\"jo\",\"e\"]', 1),
(61, 'a', 'b', 'c', 'd', '', '', '[\"c\",\"b\",\"a\",\"d\"]', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogadores_status`
--

CREATE TABLE `jogadores_status` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `has_skip` tinyint(4) DEFAULT 0,
  `ultima_pergunta` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `jogadores_status`
--

INSERT INTO `jogadores_status` (`id`, `nome`, `has_skip`, `ultima_pergunta`) VALUES
(1, 'Jogador1', 0, 0),
(2, 'Jogador2', 0, 0),
(3, 'b', 0, 0),
(4, 'd', 0, 0),
(5, 'c', 0, 0),
(6, 'a', 0, 0),
(7, 'jo', 0, 0),
(8, '', 1, 0),
(9, 'jo', 1, 0),
(10, 'katia', 0, 0),
(11, 'e', 0, 0),
(12, 'w', 0, 0),
(13, '', 1, 0),
(14, 'w', 1, 0),
(15, '', 1, 0),
(16, 'jo', 1, 0),
(17, '', 1, 0),
(18, 'katia', 1, 0),
(19, '', 1, 0),
(20, 'e', 1, 0),
(21, '', 1, 0),
(22, 'katia', 1, 0),
(23, 'a', 1, 0),
(24, 'a', 1, 0),
(25, 'katia', 1, 0),
(26, 'katia', 1, 0),
(27, 'e', 1, 0),
(28, 'e', 1, 0),
(29, 'a', 1, 0),
(30, 'a', 1, 0),
(31, 'b', 1, 0),
(32, 'b', 1, 0),
(33, 'a', 1, 0),
(34, 'a', 1, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `partida_atual`
--

CREATE TABLE `partida_atual` (
  `id` int(11) NOT NULL DEFAULT 1,
  `jogadores_id` int(11) DEFAULT NULL,
  `indice_vez` int(11) DEFAULT 0,
  `bloqueio_proxima_vez` text DEFAULT NULL,
  `estado` enum('esperando','em_andamento','finalizada') DEFAULT 'esperando'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `id` int(11) NOT NULL,
  `pergunta` text NOT NULL,
  `alternativa_a` text DEFAULT NULL,
  `alternativa_b` text DEFAULT NULL,
  `alternativa_c` text DEFAULT NULL,
  `alternativa_d` text DEFAULT NULL,
  `correta` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `perguntas_feitas`
--

CREATE TABLE `perguntas_feitas` (
  `id` int(11) NOT NULL,
  `jogadores_id` int(11) DEFAULT NULL,
  `pergunta_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `estado_jogo`
--
ALTER TABLE `estado_jogo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `jogadores`
--
ALTER TABLE `jogadores`
  ADD PRIMARY KEY (`jogadores_id`);

--
-- Índices de tabela `jogadores_status`
--
ALTER TABLE `jogadores_status`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `partida_atual`
--
ALTER TABLE `partida_atual`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `perguntas`
--
ALTER TABLE `perguntas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `perguntas_feitas`
--
ALTER TABLE `perguntas_feitas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `estado_jogo`
--
ALTER TABLE `estado_jogo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `jogadores`
--
ALTER TABLE `jogadores`
  MODIFY `jogadores_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de tabela `jogadores_status`
--
ALTER TABLE `jogadores_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `perguntas_feitas`
--
ALTER TABLE `perguntas_feitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
