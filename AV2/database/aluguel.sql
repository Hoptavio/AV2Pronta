-- Remove o banco de dados se ele já existir
DROP DATABASE IF EXISTS `aluguel`;

-- Cria o banco de dados
CREATE DATABASE `aluguel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Seleciona o banco de dados para uso
USE `aluguel`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `acomodacoes` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `acomodacoes` (`id`, `nome`, `descricao`, `preco`, `imagem`) VALUES
(1, 'Casa com piscina', 'Casa exuberante com jardim e piscina.', 350.00, 'img/chale.jpg'),
(2, 'Apartamento no Centro', 'Moderno apartamento no coração da cidade, próximo a todas as atrações.', 175.00, 'img/apto.jpg'),
(3, 'Cabana nas Montanhas', 'Aconchegante cabana com lareira e vista deslumbrante para as montanhas.', 280.00, 'img/cabana.jpg'),
(4, 'Hotel em frente a praia', 'Charmoso hotel com acesso ao mar.', 250.00, 'img/hotel.jpg'),
(5, 'Lofte', 'Esse Loft oferece conforto e beleza além de fácil acesso a diversos pontos turisticos', 100.00, 'img/vila.jpg'),
(6, 'Casa contêiner', 'Cassa confortavel de auto custo-beneficio.', 35.00, 'img/estudio.jpg');

CREATE TABLE `aulas` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `aulas` (`id`, `nome`, `preco`) VALUES
(1, 'Treino com personal profissional', 90.00),
(2, 'Aula de Culinária Regional', 120.00),
(3, 'Aula de dança', 60.00),
(4, 'Aula de Yoga na Natureza', 70.00),
(5, 'Rainha da bateria', 150.00),
(6, 'Sessão de Fotografia', 140.00);

CREATE TABLE `experiencias` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `experiencias` (`id`, `nome`, `descricao`, `preco`, `imagem`) VALUES
(1, 'Passeio de Barco', 'Navegue pelas águas cristalinas e descubra paraísos tropicais escondidos.', 150.00, 'img/barco.jpg'),
(2, 'Trilha Ecológica com Guia', 'Explore a natureza em sua forma mais pura com guias especializados.', 80.00, 'img/trilha.jpg'),
(3, 'Tour Pelos Museus', 'Conheça a história e cultura local com visitas ao maiores museus do Rio .', 120.00, 'img/tour.jpg');

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `id_acomodacao` int(11) NOT NULL,
  `nome_cliente` varchar(150) NOT NULL,
  `email_cliente` varchar(150) NOT NULL,
  `telefone_cliente` varchar(30) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `metodo_pagamento` varchar(20) DEFAULT NULL,
  `parcelas` int(11) DEFAULT NULL,
  `valor_parcela` decimal(10,2) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `data_reserva` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `reservas_aulas` (
  `id` int(11) NOT NULL,
  `id_aula` int(11) NOT NULL,
  `nome_cliente` varchar(150) DEFAULT NULL,
  `email_cliente` varchar(150) DEFAULT NULL,
  `telefone_cliente` varchar(30) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `metodo_pagamento` varchar(20) DEFAULT NULL,
  `parcelas` int(11) DEFAULT NULL,
  `valor_parcela` decimal(10,2) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `data_reserva` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `reservas_experiencias` (
  `id` int(11) NOT NULL,
  `id_experiencia` int(11) NOT NULL,
  `nome_cliente` varchar(150) DEFAULT NULL,
  `email_cliente` varchar(150) DEFAULT NULL,
  `telefone_cliente` varchar(30) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `metodo_pagamento` varchar(20) DEFAULT NULL,
  `parcelas` int(11) DEFAULT NULL,
  `valor_parcela` decimal(10,2) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `data_reserva` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `identificador` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_nascimento`, `identificador`) VALUES
(1, 'Administrador', 'adm@adm.com', '1234', '1990-01-01', 'A'),
(2, 'Usuário Teste', 'teste@teste.com', '1234', '1995-05-15', 'U');

ALTER TABLE `acomodacoes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `experiencias`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_acomodacao` (`id_acomodacao`),
  ADD KEY `id_usuario` (`id_usuario`);

ALTER TABLE `reservas_aulas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

ALTER TABLE `reservas_experiencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_experiencia` (`id_experiencia`),
  ADD KEY `id_usuario` (`id_usuario`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `acomodacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `aulas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `experiencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `reservas_aulas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `reservas_experiencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_acomodacao`) REFERENCES `acomodacoes` (`id`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

ALTER TABLE `reservas_aulas`
  ADD CONSTRAINT `reservas_aulas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

ALTER TABLE `reservas_experiencias`
  ADD CONSTRAINT `reservas_experiencias_ibfk_1` FOREIGN KEY (`id_experiencia`) REFERENCES `experiencias` (`id`),
  ADD CONSTRAINT `reservas_experiencias_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

COMMIT;
