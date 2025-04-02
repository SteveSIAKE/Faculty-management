# Système de Gestion de Faculté

Une application web de gestion de faculté développée avec PHP et TailwindCSS.

## Fonctionnalités

- Gestion des étudiants (ajout, modification, suppression)
- Gestion des professeurs (ajout, modification, suppression)
- Gestion des cours (ajout, modification, suppression)
- Interface utilisateur moderne et responsive avec TailwindCSS

## Prérequis

- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Serveur web (Apache, Nginx, etc.)

## Installation

1. Clonez le dépôt :
```bash
git clone [URL_DU_REPO]
cd faculty-management
```

2. Créez une base de données MySQL :
```bash
mysql -u root -p
CREATE DATABASE faculty_management;
```

3. Importez la structure de la base de données :
```bash
mysql -u root -p faculty_management < database.sql
```

4. Configurez la connexion à la base de données :
   - Ouvrez le fichier `config/database.php`
   - Modifiez les paramètres de connexion selon votre configuration :
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'votre_utilisateur');
     define('DB_PASS', 'votre_mot_de_passe');
     define('DB_NAME', 'faculty_management');
     ```

5. Configurez votre serveur web pour pointer vers le répertoire du projet.

## Structure du projet

```
faculty-management/
├── config/
│   └── database.php
├── index.php
├── etudiants.php
├── professeurs.php
├── cours.php
├── database.sql
└── README.md
```

## Utilisation

1. Accédez à l'application via votre navigateur web
2. Commencez par ajouter des professeurs
3. Ajoutez ensuite des cours et associez-les aux professeurs
4. Enfin, ajoutez des étudiants

## Sécurité

- Les entrées utilisateur sont échappées pour prévenir les attaques XSS
- Les requêtes SQL utilisent des requêtes préparées pour prévenir les injections SQL
- Les mots de passe sont hashés avant d'être stockés

## Contribution

Les contributions sont les bienvenues ! N'hésitez pas à :

1. Fork le projet
2. Créer une branche pour votre fonctionnalité
3. Commiter vos changements
4. Pousser vers la branche
5. Ouvrir une Pull Request

## Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails. 