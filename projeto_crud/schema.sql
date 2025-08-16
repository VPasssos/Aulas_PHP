
CREATE DATABASE IF NOT EXISTS projeto_crud CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE projeto_crud;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,
  permissao ENUM('admin','usuario') DEFAULT 'admin',
  token_recuperacao VARCHAR(255) NULL,
  data_token DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Usuário admin inicial
INSERT INTO usuarios (nome, email, senha, permissao) VALUES
('Administrador', 'admin@site.com', 
  '$2y$10$KQn3E0k27Vv7x7fFJbF0DeF0EJqM.2Ioln2hI3VJ6Vb0Y3zQ6i5g2', -- hash de 'admin123'
  'admin');
