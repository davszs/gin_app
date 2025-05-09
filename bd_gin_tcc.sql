CREATE DATABASE academiagin_bd;

use academiagin_bd;

-- Usuário
CREATE TABLE Usuario (
    id_usuario INT AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    nome_user VARCHAR(100) NOT NULL,
    senha_user VARCHAR(255) NOT NULL,
    tipo_user ENUM('Administrador', 'Professor', 'Aluno') NOT NULL,
    PRIMARY KEY (id_usuario, email),
    UNIQUE (email)
);

-- Func_Administrador
CREATE TABLE Administrador (
    id_usuario INT,
    email VARCHAR(100),
    nome_adm VARCHAR(100) NOT NULL,
    cpf_adm VARCHAR(14) UNIQUE NOT NULL,
    tel_adm VARCHAR(20),
    endereço_adm TEXT,
    salario FLOAT NOT NULL,
    PRIMARY KEY (id_usuario, email),
    FOREIGN KEY (id_usuario, email) REFERENCES Usuario(id_usuario, email) ON DELETE CASCADE
);

-- Aluno
CREATE TABLE Aluno (
    id_usuario INT,
    email VARCHAR(100),
    nome_aluno VARCHAR(100) NOT NULL,
    cpf_aluno VARCHAR(14) UNIQUE NOT NULL,
    tel_aluno VARCHAR(20),
    endereco_aluno TEXT,
    nome_plano ENUM('Basic Gym', 'Plus Gym', 'Ultra Gym'),
    status_matricula BOOLEAN NOT NULL,
    PRIMARY KEY (id_usuario, email),
    FOREIGN KEY (id_usuario, email) REFERENCES Usuario(id_usuario, email) ON DELETE CASCADE
);

-- Pagamento do Aluno
CREATE TABLE Pagamento (
    id_pagamento INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    nome_aluno VARCHAR(100) NOT NULL,
    tipo_pagamento ENUM('Mensalidade', 'Aula Avulsa', 'Avaliação Física') NOT NULL,
    valor_pagamento DECIMAL(10,2) NOT NULL,
    data_pagamento DATE NOT NULL,
    status_pagamento ENUM('Pago', 'Pendente') NOT NULL,
    descricao_pagamento VARCHAR(255),
    FOREIGN KEY (id_usuario) REFERENCES Aluno(id_usuario) ON DELETE CASCADE
);

-- Mensalidade
CREATE TABLE Mensalidade (
    id_mensalidade INT AUTO_INCREMENT PRIMARY KEY,
    id_pagamento INT NOT NULL,
    nome_plano ENUM('Basic Gym', 'Plus Gym', 'Ultra Gym') NOT NULL,
    nome_aluno VARCHAR(100) NOT NULL,
    valor_mensalidade DECIMAL(10,2) NOT NULL,
    descricao_mensalidade TEXT,
    mes_mensalidade VARCHAR(20) NOT NULL,
    FOREIGN KEY (id_pagamento) REFERENCES Pagamento(id_pagamento) ON DELETE CASCADE
);

-- Aula Avulsa
CREATE TABLE AulaAvulsa (
    id_avulsa INT AUTO_INCREMENT PRIMARY KEY,
    id_pagamento INT NOT NULL,
    nome_aluno VARCHAR(100) NOT NULL,
    id_aula INT NOT NULL,
    data_avulsa DATE NOT NULL, 
    modalidade ENUM('Musculação', 'Crossfit', 'Yoga', 'Pilates') NOT NULL,
    FOREIGN KEY (id_pagamento) REFERENCES Pagamento(id_pagamento) ON DELETE CASCADE,
    FOREIGN KEY (id_aula) REFERENCES Aula(id_aula)
);

-- Avaliação Física
CREATE TABLE AvaliacaoFisica (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pagamento INT NOT NULL,
    nome_aluno VARCHAR(100) NOT NULL,
    data_avaliacao DATE NOT NULL,
    observacoes TEXT,
    FOREIGN KEY (id_pagamento) REFERENCES Pagamento(id_pagamento) ON DELETE CASCADE
);

-- Func_Professor
CREATE TABLE Professor (
    id_usuario INT,
    email VARCHAR(100),
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) UNIQUE NOT NULL,
    telefone VARCHAR(20),
    endereco TEXT,
    especialidade VARCHAR(100),
    salario FLOAT NOT NULL,
    PRIMARY KEY (id_usuario, email),
    FOREIGN KEY (id_usuario, email) REFERENCES Usuario(id_usuario, email) ON DELETE CASCADE
);

-- Aula
CREATE TABLE Aula (
    id_aula INT PRIMARY KEY AUTO_INCREMENT,
    professor_id INT NOT NULL,
    nome_aula VARCHAR(100) NOT NULL,
    nome_professor VARCHAR(100) NOT NULL,
    horario DATETIME NOT NULL,
    capacidade INT NOT NULL,
    dia ENUM('Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado') NOT NULL,
    modalidade ENUM('Musculação', 'Crossfit', 'Yoga', 'Pilates') NOT NULL,
    FOREIGN KEY (professor_id) REFERENCES Professor(id_usuario) ON DELETE CASCADE
);

-- Relatório Aula (Presença Alunos)
CREATE TABLE PresençaAula (
    id_presença INT AUTO_INCREMENT PRIMARY KEY,
    id_aula INT NOT NULL,
    id_aluno INT NOT NULL,
    data_aula DATE NOT NULL,
    nome_aluno VARCHAR(100) NOT NULL,
    status_presenca ENUM('Presente', 'Faltou') NOT NULL,
    modalidade ENUM('Musculação', 'Crossfit', 'Yoga', 'Pilates') NOT NULL,
    FOREIGN KEY (id_aula) REFERENCES Aula(id_aula) ON DELETE CASCADE,
    FOREIGN KEY (id_aluno) REFERENCES Aluno(id_usuario) ON DELETE CASCADE
);

-- Receita Financeira (Á Receber)
CREATE TABLE Receita (
    id_receita INT AUTO_INCREMENT PRIMARY KEY,
    tipo_receita ENUM('Mensalidades', 'Aulas Avulsas', 'Avaliações Físicas', 'Outros') NOT NULL,
    descricao_receita VARCHAR(255),
    valor_receita DECIMAL(10,2) NOT NULL,
    data_recebimento DATE NOT NULL,
    status_receita ENUM('Recebido', 'Pendente') NOT NULL
);

-- Despesas Financeiras (Á Pagar)
CREATE TABLE Despesa (
    id_despesa INT AUTO_INCREMENT PRIMARY KEY,
    tipo_despesa ENUM('Salários', 'Aluguel', 'Equipamentos', 'Manutenção', 'Outros') NOT NULL,
    descricao_despesa VARCHAR(255),
    valor_despesa DECIMAL(10,2) NOT NULL,
    data_vencimento DATE NOT NULL,
    status_despesa ENUM('Pago', 'Pendente') NOT NULL
);

-- Relatório Financeiro
CREATE TABLE RelatorioFinanceiro (
    id INT PRIMARY KEY AUTO_INCREMENT,
    data_registro DATE NOT NULL,
    receita_total DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    despesa_total DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    saldo DECIMAL(10,2) GENERATED ALWAYS AS (receita_total - despesa_total) STORED,
    situacao_saldo ENUM('Positivo', 'Negativo', 'Equilibrado') NOT NULL
);

-- Relatório Operacional
CREATE TABLE RelatorioOperacional (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_registro DATE NOT NULL,
    total_aulas INT NOT NULL DEFAULT 0,
    total_alunos INT NOT NULL DEFAULT 0,
    aula_mais_popular VARCHAR(100),
    aula_menos_popular VARCHAR(100),
    media_presenca_alunos DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    taxa_ocupacao_aulas DECIMAL(5,2) NOT NULL DEFAULT 0.00
);


