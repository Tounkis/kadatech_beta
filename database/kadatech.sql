CREATE DATABASE kadatech ;
 
USE kadatech ;

CREATE TABLE users (
    id_users INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    pseudo VARCHAR(20) NOT NULL ,
    mdp VARCHAR(32) NOT NULL ,
    nom VARCHAR(20) NOT NULL ,
    prenom VARCHAR(20) NOT NULL ,
    email VARCHAR(50) NOT NULL ,
    sexe ENUM('m', 'f') NOT NULL ,
    ville VARCHAR(20) NOT NULL ,
    tel VARCHAR(20) NOT NULL ,
    adresse VARCHAR(50) NOT NULL ,
    statut INT(1) NOT NULL DEFAULT 0,
    UNIQUE (pseudo)
) ENGINE = InnoDB;


CREATE TABLE produit (
    id_produit INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    reference VARCHAR(20) NOT NULL ,
    categorie VARCHAR(20) NOT NULL ,
    titre VARCHAR(100) NOT NULL ,
    description TEXT NOT NULL ,
    couleur VARCHAR(20) NOT NULL ,
    marque VARCHAR(20) NOT NULL ,
    photo VARCHAR(250) NOT NULL ,
    prix INT(10) NOT NULL ,
    stock INT(10) NOT NULL ,
    UNIQUE (reference)
) ENGINE = InnoDB;

CREATE TABLE commande (
    id_commande INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_users INT(10) NULL DEFAULT NULL,
    montant INT(10) NOT NULL,
    date_enregistrement DATETIME NOT NULL,
    etat ENUM('en cours de traitement', 'envoyé', 'livré') NOT NULL
) ENGINE = InnoDB;

CREATE TABLE details_commande (
    id_details_commande INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_commande INT(10) NULL DEFAULT NULL,
    id_produit INT(10) NULL DEFAULT NULL,
    quantite INT(10) NOT NULL,
    prix INT(10) NOT NULL
) ENGINE = InnoDB;