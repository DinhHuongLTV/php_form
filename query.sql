create database php_database;
use php_database;
create table if not exists users (
	id int auto_increment,
    username varchar(50),
    password varchar(50),
    email varchar(50),
	primary key (id)
);
