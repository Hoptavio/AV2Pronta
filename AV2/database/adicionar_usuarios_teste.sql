-- Script para adicionar usuários de teste
-- Execute este script após importar o aluguel.sql

USE `aluguel`;

-- Adiciona mais usuários para teste
INSERT INTO `usuarios` (`nome`, `email`, `senha`, `data_nascimento`, `identificador`) VALUES
('João Silva', 'joao@email.com', '1234', '1995-05-15', 'U'),
('Maria Santos', 'maria@email.com', '1234', '1988-08-20', 'U'),
('Pedro Oliveira', 'pedro@email.com', '1234', '1992-03-10', 'U'),
('Ana Costa', 'ana@email.com', '1234', '1990-11-25', 'A');
