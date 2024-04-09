CREATE TABLE countries (
    id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(50) UNIQUE NOT NULL,
    code varchar(3) UNIQUE NOT NULL,
    currency varchar(30) NOT NULL,
    area integer NOT NULL,
    language varchar(50) NOT NULL
);

CREATE TABLE trips (
    id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(25) NOT NULL,
    continent varchar(25) NOT NULL,
    period tinyint NOT NULL,
    description text NOT NULL,
    price decimal(7,2) NOT NULL,
	img varchar(25) NOT NULL,
    country_id int,
    FOREIGN KEY (country_id) REFERENCES countries(id)
);

-- INSERT INTO `countries` (`name`, `code`, `currency`, `area`, `language`)
-- VALUES ('', '', '', '', '');

INSERT INTO `countries` (`name`, `code`, `currency`, `area`, `language`)
VALUES ('USA', 'US', 'dolar amerykański', '9833520', 'angielski');
INSERT INTO `countries` (`name`, `code`, `currency`, `area`, `language`)
VALUES ('Chiny', 'CN', 'yuan', '9596960', 'mandaryński');
INSERT INTO `countries` (`name`, `code`, `currency`, `area`, `language`)
VALUES ('Austria', 'AT', 'euro', '83879', 'niemiecki');
INSERT INTO `countries` (`name`, `code`, `currency`, `area`, `language`)
VALUES ('Tanzania', 'TZ', 'szyling tanzański', '947300', 'suahili');
INSERT INTO `countries` (`name`, `code`, `currency`, `area`, `language`)
VALUES ('Polska', 'PL', 'złoty', '38179800', 'polski');
INSERT INTO `countries` (`name`, `code`, `currency`, `area`, `language`)
VALUES ('Australia', 'AU', 'dolar australijski', '7686850', 'angielski');

-- INSERT INTO `trips` (`continent`, `period`, `description`, `price`, `country_id`)
-- VALUES ('', '', '',
-- '',
-- '', NULL);

INSERT INTO `trips` (`name`, `continent`, `period`, `description`, `price`, `img`, `country_id`)
VALUES ('Kolorado', 'Ameryka Północna', '7',
'jest wyżynno-górzystym stanem, którego średnia wysokość nad 
poziomem morza przekracza 2000 m. Najwyższy szczyt Kolorado, 
Mount Elbert, wznosi się na 4399 m n.p.m.',
'19000', 'colorado.jpg', 1);
INSERT INTO `trips` (`name`, `continent`, `period`, `description`, `price`, `img`, `country_id`)
VALUES ('Alaska', 'Ameryka Północna', '10',
'pasmo górskie w Ameryce Północnej w stanie Alaska. Jest to 
najwyższa część łańcucha Kordylierów z najwyższym szczytem 
kontynentu - Denali (McKinley) (6194 m n.p.m.).',
'24000', 'alaska.jpg', 1);
INSERT INTO `trips` (`name`, `continent`, `period`, `description`, `price`, `img`, `country_id`)
VALUES ('Everest', 'Azja', '7',
'najwyższy szczyt Ziemi (8848 m n.p.m., podaje się też wysokość
 8844 lub 8850), ośmiotysięcznik położony w Himalajach Wysokich,
 na granicy Nepalu i Tybetu.',
'22000', 'everest.jpg', 2);
INSERT INTO `trips` (`name`, `continent`, `period`, `description`, `price`, `img`, `country_id`)
VALUES ('Alpy', 'Europa', '6',
'najwyższy łańcuch górski Europy, ciągnący się łukiem od wybrzeża 
Morza Śródziemnego w okolicy Savony po dolinę Dunaju w okolicach Wiednia.',
'16000', 'alps.jpg', 3);
INSERT INTO `trips` (`name`, `continent`, `period`, `description`, `price`, `img`, `country_id`)
VALUES ('Kilimandżaro', 'Afryka', '10',
'góra w Tanzanii, leżąca przy granicy z Kenią. Jest najwyższą
górą Afryki i jedynym miejscem na kontynencie, gdzie śnieg jest
całoroczny.',
'25000', 'kilimanjaro.jpg', 4);
INSERT INTO `trips` (`name`, `continent`, `period`, `description`, `price`, `img`, `country_id`)
VALUES ('Tatry', 'Europa', '5',
'najwyższe pasmo w łańcuchu Karpat, również najwyższe między Alpami a Uralem i Kaukazem.
Są częścią Łańcucha Tatrzańskiego, w Centralnych Karpatach Zachodnich.',
'7500', 'tatry.jpg', 5);
INSERT INTO `trips` (`name`, `continent`, `period`, `description`, `price`, `img`, `country_id`)
VALUES ('Sudety', 'Europa', '5',
'łańcuch górski na obszarze południowo-zachodniej Polski i północnych Czech, stosunkowo
niewielki skrawek znajduje się w Niemczech; najwyższy szczyt Śnieżka – 1603 m n.p.m.',
'8000', 'sudety.jpg', 5);
