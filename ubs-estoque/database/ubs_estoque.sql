USE ubs_estoque;

CREATE TABLE IF NOT EXISTS perfis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    perfil_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_usuarios_perfil
        FOREIGN KEY (perfil_id) REFERENCES perfis(id)
);

INSERT INTO perfis (nome)
SELECT 'Administrador'
WHERE NOT EXISTS (SELECT 1 FROM perfis WHERE nome = 'Administrador');

INSERT INTO perfis (nome)
SELECT 'Funcionário'
WHERE NOT EXISTS (SELECT 1 FROM perfis WHERE nome = 'Funcionário');
