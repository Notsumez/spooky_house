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
    foreign key(id_pedido) references Pedidos(id)
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

-- Inserir dados na tabela Clientes
INSERT INTO Clientes (nome, email, cpf, telefone, imagem) VALUES
('Pactw', 'pequitw@gmail.com', '123.456.789-01', 1234567890, 'galo_foda.jpg'),
('Viniccius13', 'vnccs13@gmail.com', '234.567.890-12', 2345678901, 'imagem2.jpg'),
('Rezendeevil', 'rezendeevil@gmail.com', '345.678.901-23', 3456789012, 'imagem3.jpg'),
('AuthenticGames', 'authentic@gmail.com', '377.678.901-23', 3456789012, 'imagem3.jpg');

-- Inserir dados na tabela End_clientes
INSERT INTO End_clientes (logradouro, numero, cidade, uf, cep, id_cliente) VALUES
('Rua A, 123', 456, 'Cidade A', 'AA', '12345-678', 1),
('Rua B, 456', 789, 'Cidade B', 'BB', '23456-789', 2),
('Rua C, 789', 101, 'Cidade C', 'CC', '34567-890', 3);

-- Inserir dados na tabela Funcionarios
INSERT INTO Funcionarios (nome, cpf, email, telefone, periodo, funcao, ativo, imagem) VALUES
('Funcionario 1', '456.789.012-34', 'funcionario1@gmail.com', 1234567, 'Manhã', 'Cargo 1', 1, 'imagem1.jpg'),
('Funcionario 2', '567.890.123-45', 'funcionario2@gmail.com', 2345678, 'Tarde', 'Cargo 2', 1, 'imagem2.jpg'),
('Funcionario 3', '678.901.234-56', 'funcionario3@gmail.com', 3456789, 'Noite', 'Cargo 3', 0, 'imagem3.jpg');

-- Inserir dados na tabela Produtos
INSERT INTO Produtos (nome, descricao, resumo, preco, quantidade, imagem, destaque) VALUES
('Fantasia Endergirl', 'Esta deslumbrante fantasia Endergirl transformará você na misteriosa habitante do mundo das sombras. Perfeita para festas temáticas e eventos especiais. Inclui vestido roxo e maquiagem vibrante.', 'Prepare-se para uma viagem ao mundo das sombras com esta elegante fantasia Endergirl. Ideal para festas a fantasia e eventos temáticos.', 19.99, 100, 'endergirls.jpg', 'Sim'),
('Fantasia Villager', 'Esta é a fantasia perfeita para todos os fãs de Minecraft. Torne-se um aldeão do jogo com esta adorável fantasia Villager. Inclui roupas autênticas e acessórios.', 'Transforme-se em um aldeão de Minecraft com esta adorável fantasia Villager. Ideal para festas de videogame e cosplay.', 9.99, 200, 'villager.jpg', 'Sim'),
('Fantasia Steve', 'Esta é a fantasia perfeita para os fãs do Minecraft. Torne-se o protagonista Steve com esta adorável fantasia. Inclui roupas autênticas e acessórios.', 'Transforme-se em Steve, o protagonista do Minecraft, com esta incrível fantasia. Ideal para festas de videogame e cosplay.', 14.99, 150, 'steve.jpg', 'Sim'),
('Fantasia Princesa', 'Transforme-se em uma linda princesa com esta fantasia encantadora. Perfeita para festas de contos de fadas e aniversários temáticos.', 'Realize seus sonhos de ser uma princesa com esta deslumbrante fantasia. Ideal para festas de contos de fadas e eventos especiais.', 24.99, 80, 'princesa.jpg', 'Não'),
('Máscara Batman', 'Seja o herói da festa com esta máscara incrível. Perfeita para festas de super-heróis e eventos de cosplay.', 'Transforme-se em um herói com esta máscara emocionante. Ideal para festas de super-heróis e eventos de fantasia.', 7.99, 300, 'batman.jpg', 'Não'),
('Fantasia Pirata', 'Navegue pelos mares em grande estilo com esta fantasia de pirata. Inclui traje de capitão, chapéu e acessórios de pirata.', 'Junte-se à tripulação com esta autêntica fantasia de pirata. Ideal para festas de piratas e eventos temáticos.', 29.99, 70, 'pirata.jpg', 'Não'),
('Máscara de Monstro', 'Assuste seus amigos com esta máscara de monstro assustadora. Perfeita para festas de Halloween e eventos de terror.', 'Transforme-se em um monstro assustador com esta máscara de pesadelo. Ideal para festas de Halloween e eventos de terror.', 12.99, 120, 'monstro.jpg', 'Não'),
('Fantasia de Astronauta', 'Explore o espaço com esta fantasia de astronauta autêntica. Inclui traje espacial e capacete.', 'Embarque em uma missão espacial com esta incrível fantasia de astronauta. Ideal para festas de astronomia e eventos científicos.', 34.99, 50, 'astronauta.jpg', 'Sim'),
('Fantasia de Cachorro', 'Transforme-se em um animal fofo com esta fantasia encantadora. Perfeita para festas infantis e eventos de animais.', 'Divirta-se como seu animal favorito com esta fantasia adorável. Ideal para festas de animais e eventos infantis.', 16.99, 90, 'cachorro.jpg', 'Não'),
('Máscara de Zumbi', 'Assuste a todos com esta máscara de zumbi horripilante. Perfeita para festas de Halloween e eventos de terror.', 'Torne-se um zumbi assustador com esta máscara de pesadelo. Ideal para festas de Halloween e eventos de terror.', 11.99, 110, 'zumbi.jpg', 'Sim'),
('Fantasia de Feiticeiro', 'Domine a magia com esta fantasia de feiticeiro. Inclui manto, chapéu e varinha mágica.', 'Entre no mundo da magia com esta incrível fantasia de feiticeiro. Ideal para festas de fantasia e eventos mágicos.', 19.99, 60, 'feiticeiro.jpg', 'Sim'),
('Máscara Bojack', 'Se você é um fã de BoJack Horseman, esta máscara é um item imperdível para você! Leve para casa a máscara do personagem principal e divirta-se nas festas com os amigos.', 'Entre no mundo de BoJack Horseman com esta máscara incrível do personagem principal. Ideal para festas e eventos de comédia.', 9.99, 200, 'bojack.jpg', 'Sim');


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
(3, 'Em andamento', '2023-10-21'),
(1, 'Concluido', '2023-10-21'),
(1, 'Cancelado', '2023-10-21'),
(1, 'Em andamento', '2023-10-21');

-- Inserir dados na tabela Item_pedido
INSERT INTO Item_pedido (id_pedido, id_produto, quantidade) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 3, 3),
(4, 4, 3),
(5, 5, 3),
(6, 6, 3);


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
('Cli1202cb962Spooky-827cc', 1),
('Cli2202cb962Spooky-adcae', 2),
('Cli3202cb962Spooky-992a6', 3);

-- Inserir dados na tabela Login_funcionarios
INSERT INTO Login_funcionarios (senha, id_func) VALUES
('FUN1202cb962Spooky-c4ded', 1),
('FUN2202cb962Spooky-099eb', 2),
('FUN3202cb962Spooky-1e01b', 3);

select * from produtos;
select * from login_clientes;
select * from end_clientes;