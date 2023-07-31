-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31/07/2023 às 15:41
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bio`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ativacao_conta`
--

CREATE TABLE `ativacao_conta` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `codigo_ativacao` varchar(100) NOT NULL,
  `data_expiracao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `biografia_id` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `data_publicacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fotos_perfil`
--

CREATE TABLE `fotos_perfil` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nome_arquivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `status_conta` int(11) NOT NULL DEFAULT 0,
  `foto_perfil` varchar(255) DEFAULT 'default.jpg',
  `url_perfil` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `discord` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `lastfm` varchar(100) DEFAULT NULL,
  `steam` varchar(100) DEFAULT NULL,
  `leagueoflegends` varchar(100) DEFAULT NULL,
  `imagem_fundo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `bio`, `status_conta`, `foto_perfil`, `url_perfil`, `instagram`, `discord`, `twitter`, `lastfm`, `steam`, `leagueoflegends`, `imagem_fundo`) VALUES
(1, 'vii', 'deusuniversotudo@gmail.com', '$2y$10$FXbfQ1S5p5FRFMzIqqyHle6q0vVBaS6CwEQRl4o3PIzRIbE9/BxC.', 'bewewesw', 0, '1.jpg', 'joao12', 'https://www.instagram.com/bjtu/', '', '', '', 'https://steamcommunity.com/profiles/76561198865038533', '', 'back/64c7b203f1b55_719e80760999b4c355a723224120eb07.png'),
(2, 'vivivi', 'a@gmail.com', '$2y$10$q8D1ztXhmuAIiGfcURXV6.Cy3w6GPf9EYCCx/igRtu2OInR6x4xp.', NULL, 0, 'default.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'vii', 'deus@gmail.com', '$2y$10$zoQ8.DLrq2SnC7CqBVJOO.c0eyPXPPJJsSlSIWNplVD2VkwcOzfGa', NULL, 0, 'default.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `ativacao_conta`
--
ALTER TABLE `ativacao_conta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `biografia_id` (`biografia_id`);

--
-- Índices de tabela `fotos_perfil`
--
ALTER TABLE `fotos_perfil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `url_perfil` (`url_perfil`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ativacao_conta`
--
ALTER TABLE `ativacao_conta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fotos_perfil`
--
ALTER TABLE `fotos_perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `ativacao_conta`
--
ALTER TABLE `ativacao_conta`
  ADD CONSTRAINT `ativacao_conta_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`biografia_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `fotos_perfil`
--
ALTER TABLE `fotos_perfil`
  ADD CONSTRAINT `fotos_perfil_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
