# Guide d'utilisation - Lancer le site web en local

Ce guide vous explique comment configurer et exécuter ce projet sur votre machine locale.

---

## Prérequis

Avant de commencer, assurez-vous que les outils suivants sont installés sur votre machine :

1. **PHP** (version 7.4 ou supérieure) : [Télécharger ici](https://www.php.net/downloads.php)
2. **Composer** (gestionnaire de dépendances PHP) : [Installer ici](https://getcomposer.org/)
3. **Un serveur web local** comme **XAMPP**, **WAMP** ou **MAMP** (ou utilisez le serveur intégré de PHP).
4. **Git** (pour cloner le projet) : [Télécharger ici](https://git-scm.com/)

---

## Étapes d'installation

### 1. Cloner le dépôt GitHub

Ouvrez un terminal et exécutez la commande suivante pour cloner ce projet sur votre machine :

```bash
git clone https://github.com/AllanLegrand/Maison-eau-d-or.git
```

### 2. Installation des dépots

Accéder au dossier du projet : 

```bash
cd Maison-eau-d-or
```

Installez les dépendances PHP à l'aide de Composer :

```bash
composer install
```

### 3. Initialiser la base de données

Exécutez les migrations pour créer les tables dans la base de données :

```bash
php spark migrate
```
### 4. Lancer le serveur local

Lancez le serveur intégré de PHP à l'aide de la commande suivante : 

```bash
php spark serve
```
Cela démarrera le site de la boutique sur l'url [https://localhost8080](https://localhost8080). Vous pouvez accéder au site en ouvrant cet url dans un navigateur
