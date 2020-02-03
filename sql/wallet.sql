create table wallets (
	id int unsigned not null auto_increment,
    usuarios_id INT UNSIGNED NOT NULL,
    type varchar(3) not null,
    date varchar(100) not null,
    value float not null,
    status varchar(100) not null,
    description text not null,
    primary key(id),
    CONSTRAINT fk_wallets_usuarios_id_usuarios_id
        FOREIGN KEY (usuarios_id) REFERENCES usuarios(id)
);


INSERT INTO wallets (usuarios_id, type, date, value, status, description)
VALUES (1, 'rec', '1576540800', 284.21, 'Confirmado', 'Parcela 2/20 - Expansão
WWS 2' );

INSERT INTO wallets (usuarios_id, type, date, value, status, description)
VALUES (1, 'des', '1576540800', -21.57, 'Confirmado', 'IR na Fonte Parcela 2/20 -
Expansão - WWS 2' );

