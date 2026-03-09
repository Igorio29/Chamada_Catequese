-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/03/2026 às 02:20
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
(4, 3, '2026', 1),
(6, 2, '2026', 1);

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
-- AUTO_INCREMENT de tabela `tab_turma`
--
ALTER TABLE `tab_turma`
  MODIFY `id_turma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tab_usuario`
--
ALTER TABLE `tab_usuario`
  MODIFY `id_catequista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tab_turma`
--
ALTER TABLE `tab_turma`
  ADD CONSTRAINT `tab_turma_ibfk_1` FOREIGN KEY (`catequista_id`) REFERENCES `tab_usuario` (`id_catequista`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
