CREATE DATABASE 
(creo que esto vale asi)


USE keepdb;

CREATE TABLE tFilms(
    id int PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(200) NOT NULL,
    genero VARCHAR(50) NOT NULL,
    disponible_netflix BOOL,
    disponible_hbo BOOL,
    disponible_amazon BOOL,
    disponible_diney BOOL,
    año int NOT NULL
);

CREATE TABLE tUsers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL    
);

CREATE TABLE tMylist(
    id INT PRIMARY KEY AUTO_INCREMENT,
    film_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (film_id) REFERENCES tFilms (id),
    FOREIGN KEY (user_id) REFERENCES tUsers (id)
);
