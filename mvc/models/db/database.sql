-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 29-Jun-2022 às 02:53
-- Versão do servidor: 8.0.29
-- versão do PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mtr`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendados`
--

CREATE TABLE `agendados` (
  `fk_discente` varchar(250) DEFAULT NULL,
  `fk_agendamento` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `horario` time DEFAULT NULL,
  `cod_agendamento` int NOT NULL,
  `monitor` varchar(250) DEFAULT NULL,
  `monitoria` tinyint(1) DEFAULT NULL,
  `fk_local` int DEFAULT NULL,
  `fk_docente` varchar(250) DEFAULT NULL,
  `fk_disciplina` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `cod_curso` int NOT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `nome` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `discente`
--

CREATE TABLE `discente` (
  `matricula` varchar(250) NOT NULL,
  `nome` varchar(250) DEFAULT NULL,
  `senha` varchar(250) DEFAULT NULL,
  `monitor` tinyint(1) DEFAULT NULL,
  `fk_curso` int DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `id` int NOT NULL,
  `periodo` int DEFAULT NULL,
  `data_de_encerramento` date DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `cod_disciplina` int DEFAULT NULL,
  `fk_docente` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinas_discente`
--

CREATE TABLE `disciplinas_discente` (
  `fk_disciplina` int DEFAULT NULL,
  `fk_discente` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `docente`
--

CREATE TABLE `docente` (
  `nome` varchar(250) DEFAULT NULL,
  `senha` varchar(250) DEFAULT NULL,
  `matricula` varchar(250) NOT NULL,
  `ativo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `local`
--

CREATE TABLE `local` (
  `departamento` varchar(250) DEFAULT NULL,
  `sala` varchar(250) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `cod_local` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `super_user`
--

CREATE TABLE `super_user` (
  `login` varchar(250) NOT NULL,
  `senha` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agendados`
--
ALTER TABLE `agendados`
  ADD KEY `FK_agendados_1` (`fk_discente`),
  ADD KEY `FK_agendados_2` (`fk_agendamento`);

--
-- Índices para tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`cod_agendamento`),
  ADD KEY `FK_agendamento_2` (`fk_local`),
  ADD KEY `FK_agendamento_3` (`fk_docente`),
  ADD KEY `FK_agendamento_4` (`fk_disciplina`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`cod_curso`);

--
-- Índices para tabela `discente`
--
ALTER TABLE `discente`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `FK_discente_2` (`fk_curso`);

--
-- Índices para tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_disciplina_2` (`fk_docente`);

--
-- Índices para tabela `disciplinas_discente`
--
ALTER TABLE `disciplinas_discente`
  ADD KEY `FK_disciplinas_discente_1` (`fk_disciplina`),
  ADD KEY `FK_disciplinas_discente_2` (`fk_discente`);

--
-- Índices para tabela `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`matricula`);

--
-- Índices para tabela `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`cod_local`);

--
-- Índices para tabela `super_user`
--
ALTER TABLE `super_user`
  ADD PRIMARY KEY (`login`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agendados`
--
ALTER TABLE `agendados`
  ADD CONSTRAINT `FK_agendados_1` FOREIGN KEY (`fk_discente`) REFERENCES `discente` (`matricula`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_agendados_2` FOREIGN KEY (`fk_agendamento`) REFERENCES `agendamento` (`cod_agendamento`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD CONSTRAINT `FK_agendamento_2` FOREIGN KEY (`fk_local`) REFERENCES `local` (`cod_local`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_agendamento_3` FOREIGN KEY (`fk_docente`) REFERENCES `docente` (`matricula`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_agendamento_4` FOREIGN KEY (`fk_disciplina`) REFERENCES `disciplina` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `discente`
--
ALTER TABLE `discente`
  ADD CONSTRAINT `FK_discente_2` FOREIGN KEY (`fk_curso`) REFERENCES `curso` (`cod_curso`) ON DELETE RESTRICT;

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `FK_disciplina_2` FOREIGN KEY (`fk_docente`) REFERENCES `docente` (`matricula`) ON DELETE RESTRICT;

--
-- Limitadores para a tabela `disciplinas_discente`
--
ALTER TABLE `disciplinas_discente`
  ADD CONSTRAINT `FK_disciplinas_discente_1` FOREIGN KEY (`fk_disciplina`) REFERENCES `disciplina` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `FK_disciplinas_discente_2` FOREIGN KEY (`fk_discente`) REFERENCES `discente` (`matricula`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
