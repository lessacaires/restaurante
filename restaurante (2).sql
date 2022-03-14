-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 14-Mar-2022 às 22:55
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `restaurante`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

DROP TABLE IF EXISTS `cargos`;
CREATE TABLE IF NOT EXISTS `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cargos`
--

INSERT INTO `cargos` (`id`, `nome`) VALUES
(1, 'Recepcionista'),
(2, 'Faxineira'),
(3, 'Garçom'),
(4, 'Entregador'),
(5, 'Manobrista'),
(6, 'Manutenção'),
(8, 'Financeiro'),
(9, 'Chefe Cozinha'),
(10, 'Técnico de TI');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'sobremesas'),
(2, 'entradas'),
(3, 'vinhos'),
(4, 'pratos'),
(5, 'verduras'),
(6, 'legumes'),
(7, 'carnes'),
(8, 'perecíveis'),
(9, 'frutas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
CREATE TABLE IF NOT EXISTS `fornecedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `produto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `nome`, `email`, `telefone`, `endereco`, `produto`) VALUES
(1, 'Wyliston Lessa Caires', 'lessacaires@gmail.com', '84999714384', 'Avenida Joaquim Patrício, 2598', 'Bebidas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
CREATE TABLE IF NOT EXISTS `funcionarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `cargo` int(11) NOT NULL,
  `datacad` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `nome`, `email`, `cpf`, `telefone`, `endereco`, `cargo`, `datacad`) VALUES
(1, 'Wyliston', 'lessacaires@gmail.com', '001.982.235-95', '84999714384', 'Avenida Joaquim Patrício, 2598', 10, '2022-03-05'),
(6, 'Pedro Maria', 'pedro.maria@gmail.com', '12345678912', '84999714385', 'Avenida Joaquim Patrício, 2598', 9, '2022-03-05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mesas`
--

DROP TABLE IF EXISTS `mesas`;
CREATE TABLE IF NOT EXISTS `mesas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `mesas`
--

INSERT INTO `mesas` (`id`, `nome`, `descricao`) VALUES
(1, '1', ''),
(2, '2', ''),
(3, '3', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(35) NOT NULL,
  `descricao` varchar(80) NOT NULL,
  `valor_compra` int(11) NOT NULL,
  `valor_venda` int(11) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  `fornecedor` int(11) NOT NULL,
  `estoque` int(11) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `nivel` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `cpf`, `email`, `senha`, `nivel`) VALUES
(1, 'syscontrol', '00198223595', 'lessacaires@gmail.com', '123mudar', 'Administrador');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
