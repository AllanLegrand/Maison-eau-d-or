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
	img_path VARCHAR(255) DEFAULT 'maisoneaudeur.webp',
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
	news BOOLEAN DEFAULT FALSE,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

/*Création d'une table commandes qui stockera la date des commandes ainsi que l'utilisateur qui les a passer*/
CREATE TABLE Commandes (
	id_com SERIAL PRIMARY KEY,
	id_util INTEGER REFERENCES Utilisateurs(id_util),
	adresseLivraison VARCHAR(100),
	date DATE
);

/*Historique du nombre d'article sur une commande*/
CREATE TABLE Historique (
	id_com INTEGER REFERENCES Commandes(id_com),
	id_prod INTEGER REFERENCES Produits(id_prod),
	qt INTEGER CHECK (qt > 0),
	PRIMARY KEY(id_com, id_prod)
);

/*Liste de produit présent dans le panier des utilisateurs*/
CREATE TABLE Panier (
	id_prod INTEGER REFERENCES Produits(id_prod) ON DELETE CASCADE,
	id_sess VARCHAR(255),
	qt INTEGER DEFAULT 0,
	PRIMARY KEY(id_prod, id_sess)
);

CREATE TABLE Categories (
	id_cat SERIAL PRIMARY KEY,
	nom VARCHAR(30) NOT NULL
);

/*Table liant les produits a leurs catégories*/
CREATE TABLE ProdCat (
	id_prod INTEGER REFERENCES Produits(id_prod) ON DELETE CASCADE,
	id_cat INTEGER REFERENCES Categories(id_cat) ON DELETE CASCADE,
	PRIMARY KEY(id_prod, id_cat)
);

/* Création d'un table article qui servira a servir les articles du blog*/
CREATE TABLE Article (
	id_art SERIAL PRIMARY KEY,
	titre VARCHAR(255),
	msg TEXT,
	img_path TEXT,
	date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE FAQ (
	id_faq SERIAL PRIMARY KEY,
	txt TEXT NOT NULL
);

CREATE OR REPLACE FUNCTION handle_vedette_insert()
RETURNS TRIGGER AS $$
BEGIN
    IF (SELECT nom FROM Categories WHERE id_cat = NEW.id_cat) = 'Vedette' THEN
        DELETE FROM ProdCat
        WHERE id_cat = NEW.id_cat AND id_prod != NEW.id_prod;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_vedette_insert
AFTER INSERT ON ProdCat
FOR EACH ROW
EXECUTE FUNCTION handle_vedette_insert();


