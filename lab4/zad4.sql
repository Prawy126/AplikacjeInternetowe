-- Tworzenie struktury tabeli "questions"

CREATE TABLE questions(
    id int PRIMARY KEY AUTO_INCREMENT,
    email varchar(50) NOT NULL,
    offer_type varchar(15) NOT NULL,
    budget decimal(9,2) NOT NULL,
    comment varchar(255) NOT NULL
);