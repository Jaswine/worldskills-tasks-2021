-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Out-2021 às 23:51
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `module05`
--
CREATE DATABASE IF NOT EXISTS `module05` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `module05`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `competences`
--

DROP TABLE IF EXISTS `competences`;
CREATE TABLE `competences` (
  `id` int(11) NOT NULL,
  `competence` varchar(8000) NOT NULL,
  `height` int(11) NOT NULL,
  `job_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `competences`
--

INSERT INTO `competences` (`id`, `competence`, `height`, `job_id`) VALUES
(1, 'HTML', 10, 1),
(2, 'CSS', 10, 1),
(3, 'Javascript', 20, 1),
(4, 'Angular framework', 30, 1),
(5, 'Automated Tests', 20, 1),
(6, 'Work in groups', 5, 1),
(67, 'Work with Agile Methods', 5, 1),
(68, 'SQL Language', 30, 2),
(69, 'Microsoft SQL Server', 10, 2),
(70, 'Oracle', 50, 2),
(71, 'MySQL', 10, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `job` varchar(8000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `jobs`
--

INSERT INTO `jobs` (`id`, `job`) VALUES
(1, 'Web Designer'),
(2, 'Data Base Administrator');

-- --------------------------------------------------------

--
-- Estrutura da tabela `levels`
--

DROP TABLE IF EXISTS `levels`;
CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `level` varchar(8000) NOT NULL,
  `factor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `levels`
--

INSERT INTO `levels` (`id`, `level`, `factor`) VALUES
(1, 'No knowledge', '0.00'),
(2, 'Beginner ', '0.33'),
(3, 'Full', '0.66'),
(4, 'Expert ', '1.00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `competences`
--
ALTER TABLE `competences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`);

--
-- Índices para tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `competences`
--
ALTER TABLE `competences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `competences`
--
ALTER TABLE `competences`
  ADD CONSTRAINT `competences_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
