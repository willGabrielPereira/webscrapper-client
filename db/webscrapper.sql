-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 28-Mar-2022 às 02:23
-- Versão do servidor: 5.7.33
-- versão do PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `webscrapper`
--
CREATE DATABASE IF NOT EXISTS `webscrapper` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `webscrapper`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bidding`
--

CREATE TABLE IF NOT EXISTS `bidding` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `bidding`
--

INSERT INTO `bidding` (`id`, `title`, `url`, `status`, `description`, `date`) VALUES
(1, 'teste', 'teste.com.br', 'status top', 'descrição top', '2022-03-27 00:00:00'),
(2, 'Título top', 'arquivotop.com', 'status foda', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2022-03-27 00:00:00'),
(3, 'Título toaaap', 'arquivoto561p.com', 'statusss foda', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2022-03-27 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(250) NOT NULL,
  `date` datetime NOT NULL,
  `size` varchar(5) NOT NULL,
  `name` varchar(250) NOT NULL,
  `bidding_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `file_bidding_fk` (`bidding_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `file`
--

INSERT INTO `file` (`id`, `url`, `date`, `size`, `name`, `bidding_id`) VALUES
(1, 'arquivotop.com', '2022-03-27 00:00:00', '1MB', 'nome foda', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `bidding_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `history_bidding_fk` (`bidding_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `history`
--

INSERT INTO `history` (`id`, `date`, `status`, `reason`, `bidding_id`) VALUES
(1, '2022-03-27 00:00:00', 'em andamento', 'pq sim', 1),
(2, '2022-03-27 00:00:00', 'em andamentoaa', 'pq sim', 1),
(3, '2022-03-27 00:00:00', 'em andamentoaa', 'pq sim', 1),
(4, '2022-03-27 00:00:00', 'em andamentasdasdoaa', 'pq sim', 1),
(5, '2022-03-27 00:00:00', 'em andame531ntasdasdoaa', 'pq sim', 1);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_bidding_fk` FOREIGN KEY (`bidding_id`) REFERENCES `bidding` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_bidding_fk` FOREIGN KEY (`bidding_id`) REFERENCES `bidding` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
