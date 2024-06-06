-- SQL Server
CREATE TABLE usuarios (
    id INT IDENTITY(1,1) PRIMARY KEY,
    nome VARCHAR(100) NULL,
    email VARCHAR(100) NULL,
    senha VARCHAR(255) NULL,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- MYSQL
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(100),
  `email` varchar(100),
  `senha` varchar(255),
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
);

-- PostgresSql
CREATE TABLE usuarios (
	id serial NOT NULL PRIMARY KEY,
	nome varchar(100),
	email varchar(100),
	senha varchar(255),
	data_criacao timestamp DEFAULT CURRENT_TIMESTAMP NULL
);
