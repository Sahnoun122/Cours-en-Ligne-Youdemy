database youdemy;

use database youdemy;

CREATE TABLE user (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(255) NOT NULL,
    Prenom VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    Motdepasse VARCHAR(255) NOT NULL,
    profile VARCHAR(255),
    ROLE ENUM('admin', 'etudiant ', 'enseignant')
);

