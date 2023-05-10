drop database if exists tweet;
create database tweet character set utf8 collate utf8_general_ci;
grant all on tweet.* to 'admin'@'localhost' identified by 'password';
use tweet;

-- varchar -> text
create table userdata (
    userid int auto_increment primary key,
    username varchar(30) not null,
    password varchar(30) not null,
    avatar varchar(30) not null,
    profilepage varchar(30)
);

create table tweets (
    id int auto_increment primary key,
    contents varchar(250) not null,
    uploader varchar(30) not null,
    avatar varchar(30) not null,
    time varchar(30) not null,
    userid varchar(30) not null
);

create table privatemessages (
    id int auto_increment primary key,
    from_ varchar(10) not null,
    user1 varchar(30) not null,
    to_ varchar(10) not null,
    subject_ varchar(30) not null,
    contents text not null,
    readstatus varchar(2) not null,
    page_ varchar(30),
    extra1 varchar(30),
    extra2 varchar(30)
);