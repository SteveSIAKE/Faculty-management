# Système de Gestion de Faculté

Une application web de gestion de faculté développée avec PHP et TailwindCSS.

## Fonctionnalités

### Interface Administrateur
- Gestion complète des utilisateurs (création, modification, suppression)
- Gestion et affectation des cours aux professeurs
- Suivi des résultats académiques et génération de statistiques
- Création et gestion des rapports administratifs
- Configuration des accès et autorisations

### Interface Professeur
- Gestion des cours et ressources pédagogiques
- Enregistrement et suivi des présences
- Notation des performances des étudiants
- Communication avec les étudiants

### Interface Étudiant
- Consultation des cours et ressources pédagogiques
- Accès aux résultats académiques
- Agenda académique (examens, devoirs, événements)
- Communication avec les professeurs

## Architecture Technique

- Frontend : HTML, TailwindCSS
- Backend : PHP
- Base de données : MySQL
- Authentification : Sessions PHP

## Prérequis

- PHP 8.1+
- MySQL 8.0+
- Serveur web (Apache, Nginx)
- Composer (pour les dépendances PHP)

## Installation

1. Clonez le dépôt :
```bash
git clone [URL_DU_REPO]
cd faculty-management
```

2. Installez les dépendances PHP :
```bash
composer install
```

3. Créez une base de données MySQL :
```bash
mysql -u root -p
CREATE DATABASE faculty_management;
```

4. Importez la structure de la base de données :
```bash
mysql -u root -p faculty_management < database/schema.sql
```

5. Configurez la connexion à la base de données :
   - Copiez `config/database.example.php` vers `config/database.php`
   - Modifiez les paramètres selon votre configuration

6. Configurez votre serveur web pour pointer vers le répertoire public

## Structure du Projet

```
faculty-management/
├── public/
│   ├── assets/
│   │   ├── css/
│   │   └── js/
│   └── index.php
├── src/
│   ├── controllers/
│   ├── models/
│   ├── views/
│   └── helpers/
├── config/
│   └── database.php
├── database/
│   └── schema.sql
├── vendor/
└── README.md
```

## Sécurité

- Sessions PHP sécurisées
- Protection CSRF
- Validation des entrées
- Requêtes préparées
- Hachage des mots de passe
- Protection contre les injections SQL

## Contribution

1. Fork le projet
2. Créez une branche pour votre fonctionnalité
3. Committez vos changements
4. Poussez vers la branche
5. Ouvrez une Pull Request

## Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails. 