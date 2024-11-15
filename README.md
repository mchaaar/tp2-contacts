# TP 2 - Gestion de contacts en PHP

## Demandé par [Jean le Grand Bokassa](https://github.com/jlbokass), réalisé par [mchar](https://github.com/mchaaar).

## Table des matières
1. [Présentation du projet](#présentation-du-projet)
2. [Fonctionnalités](#fonctionnalités)
3. [Technologies utilisées](#technologies-utilisées)
4. [Descriptions des fichiers](#descriptions-des-fichiers)
5. [Structure de la base de données](#structure-de-la-base-de-données)
6. [Installation](#installation)
7. [Screenshots](#screenshots)

---

## Présentation du projet
Ce projet est une application web développée en PHP pour la gestion de contacts via une interface simple et intuitive.  

Il permet d'effectuer des opérations CRUD (Create, Read, Update, Delete) sur une base de données, permettant ainsi d'ajouter, consulter, modifier et de supprimer des contacts.  

L'application met en œuvre des pratiques de programmation sécurisées en PHP et utilise des requêtes SQL préparées via PDO pour une meilleure protection contre les attaques.  

---

## Fonctionnalités
- **Ajout de contact** : Un formulaire pour saisir le nom, l'email et le numéro de téléphone d'un nouveau contact.
- **Affichage des contacts** : Visualisez tous les contacts dans un tableau ordonné avec des options pour modifier ou supprimer chaque contact.
- **Modification de contact** : Un formulaire pré-rempli pour éditer les informations d'un contact existant.
- **Suppression de contact** : Suppression sécurisée d'un contact avec une confirmation pour éviter les erreurs.

---

## Technologies utilisées
- **Backend** : PHP
- **Frontend** : HTML5, CSS3
- **Base de données** : MySQL
- **Extension PHP** : PDO (PHP Data Objects).
- **Serveur** : Apache (via XAMPP)

---

## Descriptions des fichiers

| Fichier              | Description |
|----------------------|-------------|
| `index.php`          | Page principale qui affiche la liste des contacts avec des options pour modifier ou supprimer. |
| `add_contact.php`    | Gère l'ajout d'un nouveau contact en récupérant les données du formulaire et en les enregistrant dans la base de données. |
| `edit.php`           | Affiche un formulaire pré-rempli avec les informations d'un contact pour la modification. |
| `update_contact.php` | Traite la mise à jour des informations d'un contact existant avec les données modifiées. |
| `delete_contact.php` | Supprime un contact de la base de données par ID après confirmation. |
| `data.php`           | Contient toutes les fonctions de manipulation des données (ajouter, modifier, afficher, supprimer). |
| `db.php`             | Gère la connexion à la base de données MySQL via PDO. |
| `init.sql`           | Script SQL pour la création de la base de données et de la table des contacts. |

---

## Structure de la base de données
La structure de la base de données est définie dans le fichier `init.sql`, qui crée la base de données et la table des contacts :

- **Base de données** : `contacts_db`
- **Table** : `contacts`
  - `id` (INT, AUTO_INCREMENT, PRIMARY KEY) : Identifiant unique du contact.
  - `name` (VARCHAR(100), NOT NULL) : Nom du contact.
  - `email` (VARCHAR(100), NOT NULL) : Adresse email.
  - `telephone` (VARCHAR(15), NOT NULL) : Numéro de téléphone du contact.

---

## Installation
Pour installer et exécuter ce projet sur votre environnement local :

1. **Clonez le dépôt depuis GitHub** :  
  *(si possble directement dans le dossier htdocs de XAMPP)*
   ```bash
     git clone git@github.com:mchaaar/tp2-contacts.git
   ```

3. **Configurez la base de données** :  
Importez le fichier init.sql dans votre serveur MySQL via phpMyAdmin ou tout autre outil de gestion de base de données.  
Vérifiez que la base de données contacts_db et la table contacts ont été créées correctement.  

4. **Configurez la connexion à la base de données** :  
Ouvrez le fichier includes/db.php.  
Remplacez les informations suivantes par vos propres paramètres MySQL si besoin.  
*(par défaut XAMPP laisse sans mot de passe, ces params devraient marcher)*  
```php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "contacts_db";
```

4. **Lancez votre serveur local** :  
Utilisez XAMPP ou tout autre serveur local compatible avec PHP et MySQL.  
*(si ce n'est pas déjà le cas, déplacez les fichiers du projet dans le répertoire htdocs)*

5. **Accédez à l'application** :
Ouvrez votre navigateur et accédez à :  
```
localhost/tp2-contacts
```

## Screenshots
**Voici deux captures d'écran qui illustrent la page d'ajout de contact ainsi que la page de modification de contact.**

#### Ajout de contact :

![capture d'écran de la page d'ajout de contact](https://github.com/mchaaar/tp2-contacts/blob/main/github/gestionDesContactsHome.png)

#### Modification de contact :

![capture d'écran de la page de modification de contact](https://github.com/mchaaar/tp2-contacts/blob/main/github/gestionDesContactsModification.png))
