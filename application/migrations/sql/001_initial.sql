# noinspection SqlNoDataSourceInspectionForFile


drop table if exists injuries;
drop table if exists nutrition;
drop table if exists phth_sessions;
drop table if exists offsicks;
drop table if exists players;
drop table if exists teams;
drop table if exists users;


create table users (
    id integer not null auto_increment primary key,
    username varchar (32) not null unique,
    email varchar (255) not null unique,
    password varchar (255)
);


create table teams (
    id integer not null auto_increment primary key,
    name varchar (255) not null,
    logo varchar (255)
);

create table players (
    id integer not null auto_increment primary key,
    position integer,
    team integer not null references teams(id) on delete set null,

    nif varchar(10) not null unique,
    birthday integer,
    `name` varchar (255) not null,
    surname varchar (255),
    address varchar (255),
    contact varchar (255),
    offsick boolean default false
);


create table injuries (
    id integer not null auto_increment primary key,
    player integer not null references players(id) on delete cascade,

    type integer not null,
    description TEXT,
    happened_at datetime not null default 0,
    days_off integer
);


create table nutrition (
    id integer not null auto_increment primary key,
    player integer not null references players(id) on delete cascade,

    diet_keen boolean not null default true,
    imc integer,
    height integer,
    weight integer,
    hip_waist_perimeter integer,
    comments text,
    created_at datetime not null default 0
);


create table phth_sessions (
    id integer not null auto_increment primary key,
    player integer not null references players(id) on delete cascade,

    type integer,
    scheduled_at datetime,
    description text
);


create table offsicks (
    id integer not null auto_increment primary key,
    player integer not null references players(id) on delete cascade,

    created_at datetime default 0,
    happened_at datetime,
    description text,
    duration smallint
);