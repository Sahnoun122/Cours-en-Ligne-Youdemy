database youdemy;

use database youdemy;

CREATE TABLE user (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(255) NOT NULL,
    Prenom VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    Motdepasse VARCHAR(255) NOT NULL,
    profile VARCHAR(255),
    ROLE ENUM('admin', 'etudiant ', 'enseignant'),
    Statut ENUM('Soumis', 'Accepté', 'Refusé') NOT NULL

);

CREATE TABLE Category (
    id_category INT AUTO_INCREMENT PRIMARY KEY,
    id_admin INT NOT NULL,
    Nom VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_admin) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE tags(
    id_tag INT AUTO_INCREMENT PRIMARY KEY,
    id_admin INT NOT NULL,
    Nom VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_admin) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE
);



CREATE TABLE Cours (
    id_cours INT AUTO_INCREMENT PRIMARY KEY,
    Titre VARCHAR(255) NOT NULL,
    DESCRIPTION TEXT NOT NULL,
    video TEXT NOT NULL ,
    id_enseignant INT,
    id_category INT,
    id_tag INT ,
    Statut ENUM('Soumis', 'Accepté', 'Refusé') NOT NULL,
    DateCréation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    DateModification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_category) REFERENCES Category(id_category) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_tag) REFERENCES tags(id_tag) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_enseignant) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE inscription (
    id_inscrire INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_cours INT,
    dateInsrire TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE ,
       FOREIGN KEY (id_cours) REFERENCES Cours(id_cours) ON DELETE CASCADE ON UPDATE CASCADE
);



