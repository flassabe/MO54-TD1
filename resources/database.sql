create database my_db;

use 'my_db';

create table utilisateur (
    id int auto_increment,
    first_name varchar(50),
    last_name varchar(50),
    city_id int,
    language_id int,
    primary key(id)
);

create table city (
    id int auto_increment,
    city_name varchar(50),
    postcode varchar(10),
    primary key(id)
);

create table langage (
    id int auto_increment,
    language_label varchar(50),
    language_code varchar(5),
    primary key(id)
);

insert into city(city_name, postcode) values
    ('Belfort', '90000'),
    ('Montbéliard', '25200'),
    ('Paris', '75000'),
    ('Lyon', '69000'),
    ('Sévenans', '90400');

insert into langage(language_label, language_code) values
    ('French', 'FR'),
    ('English', 'EN'),
    ('Russian', 'RU');

insert into utilisateur(first_name, last_name, city_id, language_id) values
    ('Bob', 'Smith', 3, 2),
    ('John', 'Doe', 4, 2),
    ('Jane', 'Williams', 3, 2),
    ('Jean', 'Dupont', 1, 1),
    ('Jacques', 'Dupuis', 2, 1),
    ('Charles', 'Legrand', 5, 1),
    ('Robert', 'Briand', 4, 1),
    ('Alain', 'Decourt', 1, 1),
    ('Ivan', 'Ivanovitch', 2, 3),
    ('Jérome', 'Lefort', 4, 1);