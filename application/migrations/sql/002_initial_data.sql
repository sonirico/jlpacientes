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