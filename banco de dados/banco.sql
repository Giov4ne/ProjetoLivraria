/* CRIAÇÃO DA BASE DE DADOS */
create database magic_world_bookstore;
use magic_world_bookstore;

/* TABELAS */
create table usuario(
    cpf varchar(14) primary key not null,
    nome varchar(100) not null,
    genero varchar(9) not null check(genero in ('masculino','feminino','outro')),
    dt_nasc date not null,
    email varchar(100) not null,
    senha varchar(50) not null,
    tipo varchar(7) not null check(tipo in ('admin','cliente'))
);

create table compra(
    cod int primary key auto_increment,
    dt_comp date not null,
    hr_comp time not null,
    valor_total decimal(10,2) not null,
    forma_pagamento varchar(50) not null,
    cpf_usuario varchar(14) not null,
        foreign key (cpf_usuario) references usuario(cpf) on update cascade on delete restrict
);

create table livro(
    cod int primary key not null,
    titulo varchar(100) not null unique,
    autor varchar(100) not null,
    genero varchar(50) not null,
    imagem varchar(100) not null,
    preco decimal(10,2) not null,
    qtd_estoque int not null
);

create table comp_livro(
    cod_compra int not null,
    cod_livro int not null,
        foreign key (cod_compra) references compra(cod) on update cascade on delete restrict,
        foreign key (cod_livro) references livro(cod) on update cascade on delete restrict
);

/* ADMINISTRADOR */
insert into usuario(cpf, nome, genero, dt_nasc, email, senha, tipo) values('079.418.029-96', 'Giovane William Budal', 'masculino', '2005-03-07', 'giovanewbudal@gmail.com', 'Gi0v4ne123', 'admin');

/* LIVROS */
insert into livro(cod, titulo, autor, genero, imagem, preco, qtd_estoque) values(11111, 'Dom Casmurro', 'Machado de Assis', 'Romance', 'dom-casmurro.jpg', 16, 100);
insert into livro(cod, titulo, autor, genero, imagem, preco, qtd_estoque) values(22222, 'Oito Assassinatos Perfeitos', 'Peter Swanson', 'Suspense', 'oito-assassinatos-perfeitos.jpg', 41.18, 12);
insert into livro(cod, titulo, autor, genero, imagem, preco, qtd_estoque) values(33333, 'Senhora', 'José de Alencar', 'Romance', 'senhora.webp', 12, 220);
insert into livro(cod, titulo, autor, genero, imagem, preco, qtd_estoque) values(44444, 'A Ilha Do Tesouro', 'Robert Louis Stevenson', 'Aventura', 'a-ilha-do-tesouro.webp', 12.89, 400);
insert into livro(cod, titulo, autor, genero, imagem, preco, qtd_estoque) values(55555, 'Morte E Vida Severina', 'João Cabral de Melo Neto', 'Poesia', 'morte-e-vida-severina.jpg', 30, 200);
insert into livro(cod, titulo, autor, genero, imagem, preco, qtd_estoque) values(66666, 'O Telefone Preto E Outras Histórias', 'Joe Hill', 'Suspense', 'o-telefone-preto-e-outras-historias.webp', 39.93, 5);
insert into livro(cod, titulo, autor, genero, imagem, preco, qtd_estoque) values(77777, 'O Cortiço', 'Aluísio Azevedo', 'Romance', 'o-cortico.jpg', 24.90, 40);
insert into livro(cod, titulo, autor, genero, imagem, preco, qtd_estoque) values(88888, 'Quarto De Despejo', 'Carolina Maria de Jesus', 'Diário', 'quarto-de-despejo.jpg', 47.17, 78);
insert into livro(cod, titulo, autor, genero, imagem, preco, qtd_estoque) values(99999, 'Vidas Secas', 'Graciliano Ramos', 'Romance', 'vidas-secas.jpg', 39, 60);