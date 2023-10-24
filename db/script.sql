-- ============================== CRIAÇÃO DO BANCO =================================
CREATE DATABASE Spooky_House;
use Spooky_House;

CREATE TABLE Clientes(
    id int not null auto_increment,
    nome varchar(100) not null,
    email varchar(120) not null,
    cpf varchar(14) not null unique,
    telefone int(14) not null,
    imagem varchar(50) not null,
    primary key(id)
);

CREATE TABLE End_clientes(
    id int not null auto_increment,
    logradouro varchar(70) not null,
    numero int(6) not null,
    cidade varchar(50) not null,
    uf varchar(2) not null,
    cep varchar(14) not null,
    id_cliente int not null,
    primary key(id),
    foreign key(id_cliente) references Clientes(id)
);

CREATE TABLE Funcionarios(
    id int not null auto_increment,
    nome varchar(100) not null,
    cpf varchar(14) not null unique,
    email varchar(120) not null,
    telefone int(11) not null,
    periodo varchar(20) not null,
    funcao varchar(34) not null,
    nivel enum('adm','func') not null,
    ativo bit not null,
    imagem varchar(50) not null,
    primary key(id)
);

CREATE TABLE Produtos(
    id int not null auto_increment,
    nome varchar(50) not null,
    descricao text not null,
    resumo varchar(100) not null,
    preco decimal(9,2) not null,
    quantidade int not null,
    imagem varchar(50) not null,
    destaque enum('Sim','Não') not null,
    primary key(id)
);

CREATE TABLE Categorias(
    id int not null auto_increment,
    nome varchar(100) not null,
    primary key(id)
);

CREATE TABLE Produtos_categorias(
    id int not null auto_increment,
    id_produto int not null,
    id_categoria int not null,
    primary key(id),
    foreign key(id_produto) references Produtos(id),
    foreign key(id_categoria) references Categorias(id)
);

CREATE TABLE Temas(
    id int not null auto_increment,
    nome varchar(100) not null,
    primary key(id)
);

CREATE TABLE Produtos_temas(
    id int not null auto_increment,
    id_produto int not null,
    id_tema int not null,
    primary key(id),
    foreign key(id_produto) references Produtos(id),
    foreign key(id_tema) references Temas(id)
);

CREATE TABLE Pedidos(
    id int not null auto_increment,
    id_cliente int not null,
    status varchar(20) not null,
    data date not null,
    primary key(id),
    foreign key(id_cliente) references Clientes(id)
);

CREATE TABLE Item_pedido(
    id int not null auto_increment,
    id_pedido int not null,
    id_produto int not null,
    quantidade int not null,
    primary key(id),
    foreign key(id_pedido) references Pedidos(id),
    foreign key(id_produto) references Produtos(id)
);

CREATE TABLE Comentarios(
    id int not null auto_increment,
    comentario text not null,
    avaliacao int not null,
    id_cliente int not null,
    id_produto int not null,
    primary key(id),
    foreign key(id_cliente) references Clientes(id),
    foreign key(id_produto) references Produtos(id)
);

CREATE TABLE Favoritos(
    id int not null auto_increment,
    id_cliente int not null,
    id_produto int not null,
    primary key(id),
    foreign key(id_cliente) references Clientes(id),
    foreign key(id_produto) references Produtos(id)
);

CREATE TABLE Cupons(
    id int not null auto_increment,
    codigo varchar(20) not null unique,
    desconto decimal(5,2) not null,
    validade date not null,
    primary key(id)
);

CREATE TABLE Carrinho(
    id int not null auto_increment,
    id_cliente int not null,
    id_produto int not null,
    data_adicao date not null,
    primary key(id),
    foreign key(id_cliente) references Clientes(id),
    foreign key(id_produto) references Produtos(id)
);

CREATE TABLE Pedidos_cancelados(
    id int not null auto_increment,
    id_pedido int not null,
    motivo text null,
    primary key(id),
    foreign key(id_pedido) references Pedidos(id),
);

CREATE TABLE Login_clientes(
    id int not null auto_increment,
    senha varchar(26) not null,
    id_cliente int not null,
    primary key(id),
    foreign key(id_cliente) references Clientes(id)
);

CREATE TABLE Login_funcionarios(
    id int not null auto_increment,
    senha varchar(26) not null,
    id_func int not null,
    primary key(id),
    foreign key(id_func) references Funcionarios(id)
);

-- ============================== INSERTS =================================

-- Inserir dados na tabela Clientes
INSERT INTO Clientes (nome, email, cpf, telefone, imagem) VALUES
('Pactw', 'pequitw@gmail.com', '123.456.789-01', 1234567890, 'imagem1.jpg'),
('Viniccius13', 'vnccs13@gmail.com', '234.567.890-12', 2345678901, 'imagem2.jpg'),
('Rezendeevil', 'rezendeevil@gmail.com', '345.678.901-23', 3456789012, 'imagem3.jpg');
('AuthenticGames', 'authentic@gmail.com', '345.678.901-23', 3456789012, 'imagem3.jpg');

-- Inserir dados na tabela End_clientes
INSERT INTO End_clientes (logradouro, numero, cidade, uf, cep, id_cliente) VALUES
('Rua A, 123', 456, 'Cidade A', 'AA', '12345-678', 1),
('Rua B, 456', 789, 'Cidade B', 'BB', '23456-789', 2),
('Rua C, 789', 101, 'Cidade C', 'CC', '34567-890', 3);

-- Inserir dados na tabela Funcionarios
INSERT INTO Funcionarios (nome, cpf, email, telefone, periodo, funcao, nivel, ativo, imagem) VALUES
('Funcionario 1', '456.789.012-34', 'funcionario1@email.com', 1234567, 'Manhã', 'Cargo 1', 'adm', 1, 'imagem1.jpg'),
('Funcionario 2', '567.890.123-45', 'funcionario2@email.com', 2345678, 'Tarde', 'Cargo 2', 'func', 1, 'imagem2.jpg'),
('Funcionario 3', '678.901.234-56', 'funcionario3@email.com', 3456789, 'Noite', 'Cargo 3', 'adm', 0, 'imagem3.jpg');

-- Inserir dados na tabela Produtos
INSERT INTO Produtos (nome, descricao, resumo, preco, quantidade, imagem, destaque) VALUES
('Produto 1', 'Descrição do Produto 1', 'Resumo 1', 19.99, 100, 'produto1.jpg', 'Sim'),
('Produto 2', 'Descrição do Produto 2', 'Resumo 2', 29.99, 50, 'produto2.jpg', 'Não'),
('Produto 3', 'Descrição do Produto 3', 'Resumo 3', 9.99, 200, 'produto3.jpg', 'Sim');

-- Inserir dados na tabela Categorias
INSERT INTO Categorias (nome) VALUES
('Halloween'),
('Carnaval'),
('Infantis'),
('Adultos'),
('Filmes e Séries'),
('Animais'),
('Super-Heróis'),
('Contos de Fadas');

-- Inserir dados na tabela Produtos_categorias
INSERT INTO Produtos_categorias (id_produto, id_categoria) VALUES
(1, 1),
(2, 2),
(3, 3);

-- Inserir dados na tabela Temas
INSERT INTO Temas (nome) VALUES
('Super-Herói'),
('Conto de Fadas'),
('Terror'),
('Anime'),
('Profissões'),
('Época'),
('Animais');

-- Inserir dados na tabela Produtos_temas
INSERT INTO Produtos_temas (id_produto, id_tema) VALUES
(1, 1),
(2, 2),
(3, 3);

-- Inserir dados na tabela Pedidos
INSERT INTO Pedidos (id_cliente, status, data) VALUES
(1, 'Em andamento', '2023-10-23'),
(2, 'Concluido', '2023-10-22'),
(3, 'Em andamento', '2023-10-21');

-- Inserir dados na tabela Item_pedido
INSERT INTO Item_pedido (id_pedido, id_produto, quantidade) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 3, 3);

-- Inserir dados na tabela Comentarios
INSERT INTO Comentarios (comentario, avaliacao, id_cliente, id_produto) VALUES
('Bom produto!', 5, 1, 1),
('Produto razoável', 3, 2, 2),
('Ótimo serviço', 5, 3, 3);

-- Inserir dados na tabela Favoritos
INSERT INTO Favoritos (id_cliente, id_produto) VALUES
(1, 2),
(2, 3),
(3, 1);

-- Inserir dados na tabela Cupons
INSERT INTO Cupons (codigo, desconto, validade) VALUES
('VaiNeymar#2324', 10.00, '2023-12-31'),
('TmjCria99821', 5.00, '2023-11-30'),
('CanetaAzul131314', 15.00, '2023-10-31');

-- Inserir dados na tabela Carrinho
INSERT INTO Carrinho (id_cliente, id_produto, data_adicao) VALUES
(1, 2, '2023-10-23'),
(2, 3, '2023-10-22'),
(3, 1, '2023-10-21');

-- Inserir dados na tabela Pedidos_cancelados
INSERT INTO Pedidos_cancelados (id_pedido, motivo) VALUES
(1, 'Cliente desistiu da compra'),
(3, 'Produto fora de estoque');

-- Inserir dados na tabela Login_clientes
INSERT INTO Login_clientes (senha, id_cliente) VALUES
('123', 1),
('456', 2),
('789', 3);

-- Inserir dados na tabela Login_funcionarios
INSERT INTO Login_funcionarios (senha, id_func) VALUES
('admin123', 1),
('funcionario123', 2),
('admin456', 3);
