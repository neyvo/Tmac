-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19-Jan-2016 às 20:01
-- Versão do servidor: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `neyvocom_tt`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atleta`
--

CREATE TABLE IF NOT EXISTS `atleta` (
`id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `data_nascimento` date NOT NULL,
  `pontos` int(11) NOT NULL,
  `ativo` char(1) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_categoria` int(11) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `excluido` char(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `perfil` varchar(20) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `telefone` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `atleta`
--

INSERT INTO `atleta` (`id`, `nome`, `data_nascimento`, `pontos`, `ativo`, `data_cadastro`, `id_categoria`, `sexo`, `excluido`, `email`, `senha`, `perfil`, `foto`, `telefone`) VALUES
(1, 'Neyvo Pinheiro', '1982-04-23', 500, 'S', '2015-07-23 16:38:40', 1, 'Masculino', 'N', 'neyvo.souza@gmail.com', '555', 'ADMINISTRADOR', 'atleta_1.gif', '9205-9466'),
(2, 'Yan', '2008-09-29', 600, 'S', '2015-07-23 18:26:08', 1, 'Masculino', '*', 'teste@gmail.com', '123', 'ATLETA', '', '99995555'),
(3, 'Manoel', '0000-00-00', 0, 'S', '2016-01-14 12:46:08', 0, '', 'N', 'manoel@gmail.com', 'tmac', 'ADMINISTRADOR', '', '99999999');

-- --------------------------------------------------------

--
-- Estrutura da tabela `atleta_categoria`
--

CREATE TABLE IF NOT EXISTS `atleta_categoria` (
`id` int(11) NOT NULL,
  `id_atleta` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `pontos` int(11) NOT NULL,
  `ano` char(4) NOT NULL,
  `excluido` char(1) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `classificacao` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `atleta_categoria`
--

INSERT INTO `atleta_categoria` (`id`, `id_atleta`, `id_categoria`, `pontos`, `ano`, `excluido`, `id_torneio`, `classificacao`) VALUES
(1, 1, 1, 500, '2016', 'N', 1, 1),
(2, 2, 1, 410, '2016', '*', 1, 2),
(3, 1, 1, 175, '2015', 'N', 2, 0),
(4, 2, 1, 200, '2015', '*', 1, 0),
(5, 1, 1, 300, '2016', 'N', 2, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
`id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `excluido` char(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `excluido`) VALUES
(1, 'Absoluto', 'N'),
(2, 'Veterano (40+)', 'N'),
(3, 'Infantil', 'N'),
(4, 'ssssssssss', '*'),
(5, 'SSSSSSS', '*'),
(6, '', '*'),
(7, '', '*'),
(8, '', '*'),
(9, 'sss', '*');

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
`id` int(11) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `id_participante` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `excluido` char(1) NOT NULL,
  `ativo` char(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`id`, `id_torneio`, `id_participante`, `nome`, `excluido`, `ativo`) VALUES
(1, 1, 1, 'A', 'N', 'S'),
(2, 1, 2, 'A', 'N', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogo`
--

CREATE TABLE IF NOT EXISTS `jogo` (
`id` int(11) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_particpante1` int(11) NOT NULL,
  `id_participante2` int(11) NOT NULL,
  `pontos1` int(11) NOT NULL,
  `pontos2` int(11) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `torneio`
--

CREATE TABLE IF NOT EXISTS `torneio` (
`id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `excluido` char(1) NOT NULL,
  `ativo` char(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `torneio`
--

INSERT INTO `torneio` (`id`, `nome`, `descricao`, `data_cadastro`, `excluido`, `ativo`) VALUES
(1, 'PRIMEIRA ETAPA - CIRCUITO', 'PRIMEIRA ETAPA - CIRCUITO DE TENIS DE MESA', '2015-07-23 21:21:18', 'N', 'S'),
(2, 'SEGUNDA ETAPA', 'CIRCUITO DE TENIS DE MESA', '2016-01-13 20:52:34', 'N', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atleta`
--
ALTER TABLE `atleta`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `atleta_categoria`
--
ALTER TABLE `atleta_categoria`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jogo`
--
ALTER TABLE `jogo`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `torneio`
--
ALTER TABLE `torneio`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atleta`
--
ALTER TABLE `atleta`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `atleta_categoria`
--
ALTER TABLE `atleta_categoria`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `grupo`
--
ALTER TABLE `grupo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jogo`
--
ALTER TABLE `jogo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `torneio`
--
ALTER TABLE `torneio`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
