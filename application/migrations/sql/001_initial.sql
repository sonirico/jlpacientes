
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
    password varchar (255),
    remember_token text
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

    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    type integer not null,
    description text,
    happened_at integer not null,
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
    scheduled_at integer,
    description text
);


create table offsicks (
    id integer not null auto_increment primary key,
    player integer not null references players(id) on delete cascade,

    created_at timestamp default current_timestamp,
    happened_at integer,
    description text,
    duration smallint
);