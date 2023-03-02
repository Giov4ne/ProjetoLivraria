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
insert into usuario(cpf, nome, dt_nasc, email, senha, tipo) values('079.418.029-96', 'Giovane William Budal', '2005-03-07', 'giovanewbudal@gmail.com', 'Gi0v4ne123', 'admin');