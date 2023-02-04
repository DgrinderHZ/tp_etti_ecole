CREATE SCHEMA ecole_db;

use ecole_db;

CREATE TABLE types_user(
    id Integer NOT null PRIMARY KEY AUTO_INCREMENT,
    titre varchar(30) not null
);

CREATE TABLE users(
    id Integer NOT null PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    nom VARCHAR(25),
    prenom VARCHAR(25),
    tel VARCHAR(14),
    email VARCHAR(60),
    password VARCHAR(255) NOT NULL,
    id_type Integer,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_type) REFERENCES types_user(id)
);

CREATE TABLE formateurs(
    id Integer NOT null PRIMARY KEY AUTO_INCREMENT,
    id_user Integer,
    FOREIGN KEY (id_user) REFERENCES users(id)
);

CREATE TABLE etudiants(
    id Integer NOT null PRIMARY KEY AUTO_INCREMENT,
    id_user Integer,
    FOREIGN KEY (id_user) REFERENCES users(id)
);

CREATE TABLE formations(
    id Integer NOT null PRIMARY KEY AUTO_INCREMENT,
    code VARCHAR(4) not null UNIQUE,
    titre varchar(150) not null,
    descrption varchar(500) not null
);

CREATE TABLE modules(
    id Integer NOT null PRIMARY KEY AUTO_INCREMENT,
    code VARCHAR(4) not null UNIQUE,
    titre varchar(150) not null,
    descrption varchar(500) not null
);

CREATE TABLE examens(
    id Integer NOT null PRIMARY KEY AUTO_INCREMENT,
    titre varchar(150) not null
);

CREATE TABLE enseigners(
    id_formateur Integer NOT null,
    id_module Integer NOT null,
    PRIMARY KEY (id_formateur, id_module),
    FOREIGN KEY (id_formateur) REFERENCES formateurs(id),
    FOREIGN KEY (id_module) REFERENCES modules(id)
);

CREATE TABLE contenirs(
    id_formation Integer NOT null,
    id_module Integer NOT null,
    PRIMARY KEY (id_formation, id_module),
    FOREIGN KEY (id_formation) REFERENCES formations(id),
    FOREIGN KEY (id_module) REFERENCES modules(id)
);

CREATE TABLE passers(
    id_etudiant Integer NOT null,
    id_module Integer NOT null,
    id_examen Integer not null,
    PRIMARY KEY (id_etudiant, id_module, id_examen),
    FOREIGN KEY (id_etudiant) REFERENCES etudiants(id),
    FOREIGN KEY (id_module) REFERENCES modules(id),
    FOREIGN KEY (id_examen) REFERENCES examens(id)
);


INSERT INTO `types_user`(`id`, `titre`) VALUES (1,'Etudiant');
INSERT INTO `types_user`(`id`, `titre`) VALUES (2,'Formateur');
