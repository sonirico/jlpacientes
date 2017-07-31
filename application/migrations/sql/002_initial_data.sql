insert into teams (`name`) values
('SD Ponferradina'),
('Cultural'),
('Bembibre')
;

-- create table players (
--     id integer not null auto_increment primary key,
--     position integer,
--     team integer not null references teams(id) on delete set null,
--
--     nif varchar(10) not null unique,
--     birthday integer,
--     `name` varchar (255) not null,
--     surname varchar (255),
--     address varchar (255),
--     contact varchar (255),
--     offsick boolean default false
-- );

insert into players (`position`, team, nif, birthday, `name`, surname, address, contact, offsick) values
(1, 1, '12345678K', 730720000, 'Marcos', 'Sánchez Benedicto', '', '678679670', false),
(2, 2, '12345679K', 630720000, 'Zurdo', 'Bierz0', '', '778679670', false),
(3, 3, '12345670K', 830720000, 'JL', 'Power', '', '678649670', true)
;

--
-- create table injuries (
--     id integer not null auto_increment primary key,
--     player integer not null references players(id) on delete cascade,
--
--     created_at timestamp default current_timestamp,
--     updated_at timestamp default current_timestamp on update current_timestamp,
--     type integer not null,
--     description text,
--     happened_at integer not null default 0,
--     days_off integer
-- );

insert into injuries (player, `type`, description, happened_at, days_off) values
(1, 1, '<p>hola</p>', 698720000, 3),
(1, 2, '<p>hola 2</p>', 688720000, 31),
(1, 3, '<p>hola 3</p>', 708720000, 23)
;