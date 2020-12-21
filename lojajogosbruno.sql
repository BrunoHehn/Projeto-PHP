-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Set-2019 às 02:58
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lojajogosbruno`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nomeCliente` varchar(50) NOT NULL,
  `sobrenomeCliente` varchar(50) NOT NULL,
  `idadeCliente` int(3) NOT NULL,
  `sexoCliente` varchar(50) NOT NULL,
  `registroGeral` int(11) NOT NULL,
  `cep` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nomeCliente`, `sobrenomeCliente`, `idadeCliente`, `sexoCliente`, `registroGeral`, `cep`) VALUES
(25, 'Bruno', 'Hehn', 19, 'Masculino', 2147483647, 94460350),
(26, 'Matheus', 'Abreu', 23, 'Masculino', 2147483647, 27000895),
(27, 'Maria', 'Da Silva', 18, 'Feminino', 2147483647, 95050650),
(28, 'Julia', 'Ferreira', 18, 'Feminino', 2147483647, 94320450),
(29, 'Gabriel', 'Lemes Da Silva', 22, 'Masculino', 2147483647, 93250610),
(30, 'Luan', 'Dan', 17, 'Masculino', 2147483647, 57240650);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogo`
--

CREATE TABLE `jogo` (
  `idJogo` bigint(20) NOT NULL,
  `nomeJogo` varchar(50) NOT NULL,
  `produtoraJogo` varchar(50) NOT NULL,
  `valorJogo` double(5,2) NOT NULL,
  `anoLancamento` int(4) NOT NULL,
  `generoJogo` varchar(50) NOT NULL,
  `suporteControle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `jogo`
--

INSERT INTO `jogo` (`idJogo`, `nomeJogo`, `produtoraJogo`, `valorJogo`, `anoLancamento`, `generoJogo`, `suporteControle`) VALUES
(18, 'Spore', 'Maxis', 19.00, 2008, 'Aventura', 'Suporta Controle'),
(23, 'Rocket League', 'Psyonix', 36.00, 2015, 'AÃ§Ã£o', 'Suporta Controle'),
(24, 'Monster Hunter World', 'Capcom', 65.00, 2018, 'MMORPG', 'Suporta Controle'),
(25, 'Grand Theft Auto V', 'Rockstar North', 70.00, 2015, 'MMORPG', 'Suporta Controle'),
(26, 'Age Of Empires Definitive', 'Tantalus', 36.00, 2019, 'AÃ§Ã£o', 'Nã£o Suporta Controle'),
(27, 'Hunt Showdown', 'Crytek', 89.00, 2019, 'FPS', 'Nã£o Suporta Controle'),
(28, 'Terraria', 'Re Logic', 20.00, 2011, 'Aventura', 'Suporta Controle');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Índices para tabela `jogo`
--
ALTER TABLE `jogo`
  ADD PRIMARY KEY (`idJogo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `jogo`
--
ALTER TABLE `jogo`
  MODIFY `idJogo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
