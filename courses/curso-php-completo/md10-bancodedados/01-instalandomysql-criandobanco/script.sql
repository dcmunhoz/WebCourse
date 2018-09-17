create database dbphp7 default collate utf8_general_ci;
use dbphp7;

create table tb_usuarios(
	idusuario int not null auto_increment primary key,
    deslogin varchar(64) not null,
    dessenha varchar(256) not null,
    dtcadastro timestamp not null default current_timestamp()
);

insert into tb_usuarios(deslogin, dessenha) values('root', '!@#$%');

select * from tb_usuarios;

update tb_usuarios
set dessenha = 12345 where idusuario = 1;

delete from tb_usuarios where idusuario = 1;

truncate table tb_usuarios;