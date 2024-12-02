DROP TABLE IF EXISTS Produits CASCADE;
DROP TABLE IF EXISTS Utilisateurs CASCADE;
DROP TABLE IF EXISTS Commandes CASCADE;
DROP TABLE IF EXISTS Panier CASCADE;
DROP TABLE IF EXISTS Categories CASCADE;
DROP TABLE IF EXISTS ProdCat CASCADE;
DROP TABLE IF EXISTS Historique CASCADE;
DROP TABLE IF EXISTS Article CASCADE;
DROP TABLE IF EXISTS FAQ CASCADE;

CREATE TABLE Produits (
	id_prod SERIAL PRIMARY KEY,
	nom VARCHAR(30) NOT NULL,
	prix FLOAT,
	description TEXT,
	img_path TEXT,
	actif BOOLEAN
);

CREATE TABLE Utilisateurs (
	id_util SERIAL PRIMARY KEY,
	nom VARCHAR(30) NOT NULL,
	prenom VARCHAR(30) NOT NULL,
	mdp VARCHAR(255) NOT NULL,
	rst_tkn VARCHAR(255),
	rst_tkn_exp TIMESTAMP,
	email VARCHAR(320) UNIQUE,
	adresse VARCHAR(100),
	admin BOOLEAN DEFAULT FALSE,
	news BOOLEAN,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

/*Création d'une table commandes qui stockera la date des commandes ainsi que l'utilisateur qui les a passer*/
CREATE TABLE Commandes (
	id_com SERIAL PRIMARY KEY,
	id_util INTEGER REFERENCES Utilisateurs(id_util),
	date DATE
);

/*Historique du nombre d'article sur une commande*/
CREATE TABLE Historique (
	id_com INTEGER REFERENCES Commandes(id_com),
	id_prod INTEGER REFERENCES Produits(id_prod),
	qt INTEGER,
	PRIMARY KEY(id_com, id_prod)
);

/*Liste de produit présent dans le panier des utilisateurs*/
CREATE TABLE Panier (
	id_prod INTEGER REFERENCES Produits(id_prod),
	id_util INTEGER REFERENCES Utilisateurs(id_util),
	qt INTEGER DEFAULT 0,
	PRIMARY KEY(id_prod, id_util)
);

CREATE TABLE Categories (
	id_cat SERIAL PRIMARY KEY,
	nom VARCHAR(30) NOT NULL
);

/*Table liant les produits a leurs catégories*/
CREATE TABLE ProdCat (
	id_prod INTEGER REFERENCES Produits(id_prod),
	id_cat INTEGER REFERENCES Categories(id_cat),
	PRIMARY KEY(id_prod, id_cat)
);

/* Création d'un table article qui servira a servir les articles du blog*/
CREATE TABLE Article (
	id_art SERIAL PRIMARY KEY,
	msg TEXT NOT NULL,
	img_path TEXT,
	date DATE
);

CREATE TABLE FAQ (
	id_faq SERIAL PRIMARY KEY,
	txt TEXT NOT NULL
);