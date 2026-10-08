USE arcanistas;

CREATE TABLE IF NOT EXISTS depoimentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    depoimento TEXT NOT NULL,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pendente', 'aprovado', 'rejeitado') DEFAULT 'pendente'
);

CREATE TABLE IF NOT EXISTS agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    sobrenome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    instagram VARCHAR(100),
    telegram VARCHAR(100),
    data_agendamento TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pendente', 'confirmado', 'cancelado') DEFAULT 'pendente'
);

CREATE TABLE IF NOT EXISTS servicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    status ENUM('ativo', 'inativo') DEFAULT 'ativo'
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(100) NOT NULL,
    pass VARCHAR(100) NOT NULL
);

-- Dados iniciais
INSERT IGNORE INTO servicos (id, nome, descricao, preco) VALUES 
('1', 'Consulta Oracular', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices.', 150.00),
('2', 'Orientação Espiritual', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices.', 120.00);

INSERT IGNORE INTO users VALUES 
('1', 'admin', 'admin');
