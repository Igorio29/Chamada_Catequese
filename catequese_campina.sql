-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/03/2026 às 16:05
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
-- Banco de dados: `catequese_campina`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tab_catequizando`
--

CREATE TABLE `tab_catequizando` (
  `id_catequizando` int(11) NOT NULL,
  `nome_catequizando` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `telefone_responsavel` varchar(20) DEFAULT NULL,
  `turma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tab_catequizando`
--

INSERT INTO `tab_catequizando` (`id_catequizando`, `nome_catequizando`, `data_nascimento`, `telefone_responsavel`, `turma_id`) VALUES
(1, 'Danilo Bedin', '2014-02-04', '41985187265', 9),
(7, 'Danilo', '2014-02-06', '(41) 99855-4053', 11),
(8, 'Felipe ', '2000-01-01', '(41) 99552-2967', 11),
(9, 'Leonardo', '2014-08-09', '(41) 99943-0331', 11),
(10, 'Helen', '2014-05-09', '(41) 99619-5408', 11);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tab_chamada`
--

CREATE TABLE `tab_chamada` (
  `id_chamada` int(11) NOT NULL,
  `encontro_id` int(11) NOT NULL,
  `catequizando_id` int(11) NOT NULL,
  `presenca` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tab_chamada`
--

INSERT INTO `tab_chamada` (`id_chamada`, `encontro_id`, `catequizando_id`, `presenca`) VALUES
(1, 2, 7, 1),
(2, 2, 8, 0),
(3, 2, 9, 1),
(4, 2, 10, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tab_encontro`
--

CREATE TABLE `tab_encontro` (
  `id_encontro` int(11) NOT NULL,
  `turma_id` int(11) NOT NULL,
  `data_encontro` date NOT NULL,
  `tema` varchar(255) DEFAULT NULL,
  `frase_encontro` varchar(100) DEFAULT NULL,
  `observacao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tab_encontro`
--

INSERT INTO `tab_encontro` (`id_encontro`, `turma_id`, `data_encontro`, `tema`, `frase_encontro`, `observacao`) VALUES
(1, 11, '2026-03-07', 'eooifhep9o', 'eooifhep9o', 'ofiahnfoienjwofie'),
(2, 11, '2026-03-07', 'Dia do Santo', 'Todos que vivem por mim, viverão Eternamente', 'Catequizandos levaram seus santos e contaram historias, eu contei toda a historia dos santos e sobre intercessão');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tab_turma`
--

CREATE TABLE `tab_turma` (
  `id_turma` int(11) NOT NULL,
  `etapa_turma` int(11) NOT NULL,
  `ano_turma` year(4) NOT NULL,
  `catequista_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tab_turma`
--

INSERT INTO `tab_turma` (`id_turma`, `etapa_turma`, `ano_turma`, `catequista_id`) VALUES
(4, 3, '2026', 4),
(10, 2, '2026', 1),
(11, 3, '2026', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tab_usuario`
--

CREATE TABLE `tab_usuario` (
  `id_catequista` int(11) NOT NULL,
  `nome_catequista` varchar(100) NOT NULL,
  `email_catequista` varchar(100) NOT NULL,
  `senha_catequista` varchar(255) NOT NULL,
  `datacadastro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tab_usuario`
--

INSERT INTO `tab_usuario` (`id_catequista`, `nome_catequista`, `email_catequista`, `senha_catequista`, `datacadastro`) VALUES
(1, 'Igor Farias', 'igorjosefarias3@gmail.com', '$2y$10$H.LrYcVtwQ6K1Ip8gKs8yeDiAVZy5thynhL9VMBCEliLQsjwRQcNy', '2026-03-07 17:08:35'),
(4, 'Igor Farias', 'igorjosefarias12@gmail.com', '$2y$10$zf2wMlxIzDgU4bCKGj1/UOBAe1pBZHOkubXlGLUGj4lc4r1eOXVqO', '2026-03-07 17:19:54');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tab_catequizando`
--
ALTER TABLE `tab_catequizando`
  ADD PRIMARY KEY (`id_catequizando`);

--
-- Índices de tabela `tab_chamada`
--
ALTER TABLE `tab_chamada`
  ADD PRIMARY KEY (`id_chamada`),
  ADD KEY `encontro_id` (`encontro_id`),
  ADD KEY `catequizando_id` (`catequizando_id`);

--
-- Índices de tabela `tab_encontro`
--
ALTER TABLE `tab_encontro`
  ADD PRIMARY KEY (`id_encontro`),
  ADD KEY `turma_id` (`turma_id`);

--
-- Índices de tabela `tab_turma`
--
ALTER TABLE `tab_turma`
  ADD PRIMARY KEY (`id_turma`),
  ADD KEY `catequista_id` (`catequista_id`);

--
-- Índices de tabela `tab_usuario`
--
ALTER TABLE `tab_usuario`
  ADD PRIMARY KEY (`id_catequista`),
  ADD UNIQUE KEY `email_catequista` (`email_catequista`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tab_catequizando`
--
ALTER TABLE `tab_catequizando`
  MODIFY `id_catequizando` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tab_chamada`
--
ALTER TABLE `tab_chamada`
  MODIFY `id_chamada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tab_encontro`
--
ALTER TABLE `tab_encontro`
  MODIFY `id_encontro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tab_turma`
--
ALTER TABLE `tab_turma`
  MODIFY `id_turma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tab_usuario`
--
ALTER TABLE `tab_usuario`
  MODIFY `id_catequista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tab_chamada`
--
ALTER TABLE `tab_chamada`
  ADD CONSTRAINT `tab_chamada_ibfk_1` FOREIGN KEY (`encontro_id`) REFERENCES `tab_encontro` (`id_encontro`) ON DELETE CASCADE,
  ADD CONSTRAINT `tab_chamada_ibfk_2` FOREIGN KEY (`catequizando_id`) REFERENCES `tab_catequizando` (`id_catequizando`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tab_encontro`
--
ALTER TABLE `tab_encontro`
  ADD CONSTRAINT `tab_encontro_ibfk_1` FOREIGN KEY (`turma_id`) REFERENCES `tab_turma` (`id_turma`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tab_turma`
--
ALTER TABLE `tab_turma`
  ADD CONSTRAINT `tab_turma_ibfk_1` FOREIGN KEY (`catequista_id`) REFERENCES `tab_usuario` (`id_catequista`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
