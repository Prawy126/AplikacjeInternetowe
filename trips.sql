CREATE TABLE kraje (
	id INT NOT NULL AUTO_INCREMENT,
	nazwa VARCHAR(255),
	kod VARCHAR(3),
	waluta CHAR(3),
	powierzchnia_calkowita FLOAT,
	jezyk_urzedowy VARCHAR(255),
	PRIMARY KEY (id)
);

CREATE TABLE wycieczki (
	id INT NOT NULL AUTO_INCREMENT,
	id_kraju INT NOT NULL,
	nazwa VARCHAR(255),
	kontynent VARCHAR(255),
	okres_trwania_wycieczki INT,
	opis_miejsca_wycieczki VARCHAR(255),
	cena_wycieczki FLOAT,
	nazwa_obrazka_wycieczki VARCHAR(255),
	PRIMARY KEY (id),
	FOREIGN KEY (id_kraju) REFERENCES kraje(id)
);

INSERT INTO kraje (nazwa, kod, waluta, powierzchnia_calkowita, jezyk_urzedowy) VALUES ('USA', 'USA', 'USD', 9834000, 'angielski');
INSERT INTO kraje (nazwa, kod, waluta, powierzchnia_calkowita, jezyk_urzedowy) VALUES ('Chiny', 'CHN', 'CNY', 9597000, 'mandaryński');
INSERT INTO kraje (nazwa, kod, waluta, powierzchnia_calkowita, jezyk_urzedowy) VALUES ('Austria', 'AUT', 'EUR', 83871, 'niemiecki');

INSERT INTO wycieczki (id_kraju, nazwa, kontynent, okres_trwania_wycieczki, opis_miejsca_wycieczki, cena_wycieczki, nazwa_obrazka_wycieczki) VALUES (1, 'Kolorado', 'Ameryka Północna', 7, 'jest wyżynno-górzystym stanem, którego średnia wysokość nad 
poziomem morza przekracza 2000 m. Najwyższy szczyt Kolorado, 
Mount Elbert, wznosi się na 4399 m n.p.m.', 19000, 'colorado.jpg');
INSERT INTO wycieczki (id_kraju, nazwa, kontynent, okres_trwania_wycieczki, opis_miejsca_wycieczki, cena_wycieczki, nazwa_obrazka_wycieczki) VALUES (1, 'Alaska', 'Ameryka Północna', 10, 'pasmo górskie w Ameryce Północnej w stanie Alaska. Jest to 
najwyższa część łańcucha Kordylierów z najwyższym szczytem 
kontynentu - Denali (McKinley) (6194 m n.p.m.).', 24000, 'alaska.jpg');
INSERT INTO wycieczki (id_kraju, nazwa, kontynent, okres_trwania_wycieczki, opis_miejsca_wycieczki, cena_wycieczki, nazwa_obrazka_wycieczki) VALUES (2, 'Everest', 'Azja', 7, 'najwyższy szczyt Ziemi (8848 m n.p.m., podaje się też wysokość
 8844 lub 8850), ośmiotysięcznik położony w Himalajach Wysokich,
 na granicy Nepalu i Tybetu.', 22000, 'everest.jpg');
INSERT INTO wycieczki (id_kraju, nazwa, kontynent, okres_trwania_wycieczki, opis_miejsca_wycieczki, cena_wycieczki, nazwa_obrazka_wycieczki) VALUES (3, 'Alpy', 'Europa', 6, 'najwyższy łańcuch górski Europy, ciągnący się łukiem od wybrzeża 
Morza Śródziemnego w okolicy Savony po dolinę Dunaju w okolicach Wiednia.', 16000, 'alps.jpg');