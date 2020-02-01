CREATE DATABASE slim_users CHARACTER SET UTF8 COLLATE UTF8_GENERAL_CI;


use slim_users;

create table lojas (
	id INT unsigned not null auto_increment,
    nome varchar(100) not null,
    telefone varchar(100) not null,
    endereco varchar(100) not null,
    primary key(id)
);

create table produtos (
	id int unsigned not null auto_increment,
    loja_id int unsigned not null,
    nome varchar(100) not null,
    preco decimal not null,
    quantidade int unsigned not null,
    primary key(id),
    constraint fk_produtos_loja_id_lojas_id
		foreign key (loja_id) references lojas(id)
);


drop table produtos;


insert into lojas (nome, telefone, endereco)
values ('lacerdas', '99999-9999', 'mogi das cruzes');

insert into produtos (loja_id, nome, preco, quantidade)
values (1, 'teclado', 40.00, 20);


select lojas.nome as loja, produtos.nome as produto, produtos.preco as preco, produtos.quantidade as quantidade
from produtos
inner join lojas on produtos.loja_id = loja_id;

select lojas.nome as loja, produtos.nome as produto, produtos.preco as preco, produtos.quantidade as quantidade
from produtos
inner join lojas on produtos.loja_id = loja_id
where produtos.nome = 'teclado'
order by produtos.nome;