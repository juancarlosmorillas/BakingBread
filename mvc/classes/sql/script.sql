create database bakery default character set utf8 collate utf8_unicode_ci;

create user baker@localhost identified by 'baker';

grant all on bakery.* to baker@localhost;

flush privileges;

use bakery;

create table if not exists member (
    id bigint(20) not null auto_increment primary key,
    login varchar(40) not null unique,
    password varchar(250) not null
) engine = innodb default character set = utf8 collate utf8_unicode_ci;

create table if not exists client (
    id bigint(20) not null auto_increment primary key,
    name varchar(40) not null,/*Este es unico junto a surname y tin (dni)*/
    surname varchar(60) not null,
    tin varchar(20) not null,
    address varchar(100) not null,
    location varchar(100),
    postalcode varchar(50),
    province varchar(30),
    email varchar(100),
    unique(name, surname, tin)
) engine = innodb default character set = utf8 collate utf8_unicode_ci;

create table if not exists ticket (
    id bigint(20) not null auto_increment primary key,
    date datetime not null,
    idmember bigint(20) not null,
    idclient bigint(20),
    foreign key (idmember) references member(id),
    foreign key (idclient) references client(id)
) engine = innodb default character set = utf8 collate utf8_unicode_ci;

create table if not exists family (
    id bigint(20) not null auto_increment primary key,
    family varchar(100) not null unique
) engine = innodb default character set = utf8 collate utf8_unicode_ci;

create table if not exists product (
    id bigint(20) not null auto_increment primary key,
    idfamily bigint(20) not null,
    product varchar(100) not null unique,
    price decimal(10, 2) not null,
    description text not null,
    foreign key (idfamily) references family(id)
) engine = innodb default character set = utf8 collate utf8_unicode_ci;

create table if not exists ticketdetail (
    id bigint(20) not null auto_increment primary key,
    idticket bigint(20) not null, /*Este es unico junto a idproduct*/
    idproduct bigint(20) not null,
    quantity tinyint(4) not null,
    price decimal(10, 2) not null,
    foreign key (idticket) references ticket(id),
    foreign key (idproduct) references product(id)
) engine = innodb default character set = utf8 collate utf8_unicode_ci;