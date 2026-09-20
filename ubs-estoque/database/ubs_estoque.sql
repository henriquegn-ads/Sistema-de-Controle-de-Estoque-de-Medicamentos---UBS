CREATE DATABASE IF NOT EXISTS ubs_estoque
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE ubs_estoque;

CREATE TABLE medicamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    principio_ativo VARCHAR(150),
    fabricante VARCHAR(150),
    unidade_medida VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);