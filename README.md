# 🍔 Application de gestion des ventes de burgers

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)
![Status](https://img.shields.io/badge/Status-en%Developpement-orange?style=for-the-badge)

---

## 📖 Description
Cette application web est développée en **PHP pur** (sans framework) et permet à une structure spécialisée dans la vente de burgers de **gérer efficacement ses ventes**.  

Elle propose une interface utilisateur simple et un **espace d’administration complet** permettant la gestion des produits, des commandes et des utilisateurs.  

---

## 🚀 Fonctionnalités principales
### 👤 Côté client
- Parcourir la liste des burgers disponibles
- Ajouter des burgers au panier
- Passer une commande
- Consulter l’historique de ses commandes

### 🔑 Côté administrateur
- Authentification et accès sécurisé à l’espace admin
- **CRUD complet** (ajout, modification, suppression, liste) sur :
  - Les burgers 🍔  
  - Les catégories  
  - Les utilisateurs  
  - Les commandes
- Suivi des ventes et statistiques simples

---

## 🛠️ Technologies utilisées
- [PHP 8.x](https://www.php.net/) (Langage principal)
- [MySQL](https://www.mysql.com/) (Base de données)
- [Bootstrap 5](https://getbootstrap.com/) (Design responsive)

---

## 📂 Installation et configuration

### 1️⃣ Cloner le projet
```
git clone https://github.com/EbroVital/BurgerSite.git
cd BurgerSite
```
### 2️⃣ Configurer la base de données
```
CREATE DATABASE burgerdb;
USE burgerdb;
SOURCE database/burgerdb.sql;
```
### 3️⃣ Configurer la connexion
```
$host = "127.0.0.1";
$dbname = "burgerdb";
$username = "root";
$password = "";
```
### 4️⃣ Lancer le projet
```
Copiez le projet dans votre dossier htdocs (XAMPP) ou www (WAMP/Laragon).
Puis accédez à l’application dans votre navigateur :
👉 http://localhost/nom-du-projet
```
