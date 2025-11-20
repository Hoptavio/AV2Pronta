SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `acomodacoes` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

INSERT INTO `acomodacoes` (`id`, `nome`, `descricao`, `preco`, `imagem`) VALUES
(1, 'Chalé à Beira-Mar', 'Encantador chalé com vista para o mar e acesso privativo à praia.', 350.00, 'img/chale.jpg'),
(2, 'Apartamento no Centro', 'Moderno apartamento no coração da cidade, próximo a todas as atrações.', 250.00, 'img/apto.jpg'),
(3, 'Cabana nas Montanhas', 'Aconchegante cabana com lareira e vista deslumbrante para as montanhas.', 280.00, 'img/cabana.jpg'),
(4, 'Hotel Boutique Histórico', 'Hotel charmoso localizado no centro histórico.', 420.00, 'img/hotel.jpg'),
(5, 'Vila Familiar com Piscina', 'Casa espaçosa ideal para famílias.', 550.00, 'img/vila.jpg'),
(6, 'Estúdio Compacto', 'Estúdio pequeno e aconchegante.', 120.00, 'img/estudio.jpg');

CREATE TABLE `aulas` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `aulas` (`id`, `nome`, `preco`) VALUES
(1, 'Aula de Dança Local', 90.00),
(2, 'Aula de Culinária Regional', 120.00),
(3, 'Guia Turístico Personalizado', 200.00),
(4, 'Aula de Yoga na Natureza', 70.00),
(5, 'Massagem Relaxante', 150.00),
(6, 'Sessão de Fotografia', 300.00);

CREATE TABLE `experiencias` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `experiencias` (`id`, `nome`, `descricao`, `preco`, `imagem`) VALUES
(1, 'Passeio de Barco nas Ilhas', 'Passeio com paradas em ilhas paradisíacas.', 150.00, 'img/barco.jpg'),
(2, 'Trilha Ecológica com Guia', 'Trilha guiada em meio à natureza.', 80.00, 'img/trilha.jpg'),
(3, 'Tour Cultural Histórico', 'Visita guiada por pontos culturais da cidade.', 120.00, 'img/tour.jpg');

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `id_acomodacao` int(11) NOT NULL,
  `nome_cliente` varchar(150) NOT NULL,
  `email_cliente` varchar(150) NOT NULL,
  `telefone_cliente` varchar(30) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_reserva` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `reservas` (`id`, `id_acomodacao`, `nome_cliente`, `email_cliente`, `telefone_cliente`, `data_inicio`, `data_fim`, `valor_total`, `data_reserva`) VALUES
(3, 1, 'thiago', 'thiago.24204708360042@faeterj-rio.edu.br', '21545454', '2025-11-20', '2025-11-21', 350.00, '2025-11-16 19:56:45'),
(5, 1, 'otavio', 'otavio@gmail.com', '21', '2025-11-21', '2025-11-22', 350.00, '2025-11-16 20:04:09');

CREATE TABLE `reservas_aulas` (
  `id` int(11) NOT NULL,
  `id_aula` int(11) NOT NULL,
  `nome_cliente` varchar(150) DEFAULT NULL,
  `email_cliente` varchar(150) DEFAULT NULL,
  `telefone_cliente` varchar(30) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_reserva` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `reservas_aulas` (`id`, `id_aula`, `nome_cliente`, `email_cliente`, `telefone_cliente`, `quantidade`, `valor_total`, `data_reserva`) VALUES
(4, 5, 'otavio', 'otavio@gmail.com', '21', 1, 150.00, '2025-11-16 20:23:07'),
(5, 1, 'otavio', 'otavio@gmail.com', '214', 1, 90.00, '2025-11-16 20:23:44');

CREATE TABLE `reservas_experiencias` (
  `id` int(11) NOT NULL,
  `id_experiencia` int(11) NOT NULL,
  `nome_cliente` varchar(150) DEFAULT NULL,
  `email_cliente` varchar(150) DEFAULT NULL,
  `telefone_cliente` varchar(30) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_reserva` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `reservas_experiencias` (`id`, `id_experiencia`, `nome_cliente`, `email_cliente`, `telefone_cliente`, `quantidade`, `valor_total`, `data_reserva`) VALUES
(4, 1, 'otavio', 'otavio@gmail.com', '21', 1, 150.00, '2025-11-16 20:04:24'),
(5, 1, 'otavio', 'otavio@gmail.com', '21', 1, 150.00, '2025-11-16 20:22:17'),
(6, 2, 'otavio', 'otavio@gmail.com', '21', 1, 80.00, '2025-11-16 20:24:49'),
(7, 2, 'thiago', 'thiagofariastec@gmail.com', '21', 1, 80.00, '2025-11-16 20:25:13');

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` (`id`, `email`, `senha`) VALUES
(1, 'admin@admin.com', '1234');

ALTER TABLE `acomodacoes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `experiencias`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_acomodacao` (`id_acomodacao`);

ALTER TABLE `reservas_aulas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `reservas_experiencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_experiencia` (`id_experiencia`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_acomodacao`) REFERENCES `acomodacoes` (`id`);

ALTER TABLE `reservas_experiencias`
  ADD CONSTRAINT `reservas_experiencias_ibfk_1` FOREIGN KEY (`id_experiencia`) REFERENCES `experiencias` (`id`);
COMMIT;
