# ToDo & Co

Huitième projet dans le cadre de ma formation développeur PHP Symfony chez OpenClassrooms

Application de todolist pour laquelle il a fallu effectuer :

Corrections d'anomalies
Gestion des rôles et tâches
Audit de qualité du code & performance de l'application avec Blackfire
Mise en place de tests unitiaires et fonctionnels

Pour installer le projet il faudra :

# 1 - COMPOSER 

Récupérez le projet puis lancez la commande `composer install`

# 2 - CREATION DU FICHIER .ENV

Créer un fichier .env en se basant sur le fichier .env.example :

Ce fichier est strictement confidentiel et ne doit pas être partagé publiquement puisqu'il contiendra des données sensibles tels que des mots de passe
Placez le fichier dans le même dossier que le fichier .env.example

# 3 - CONFIGURATION DU FICHIER .ENV

`DATABASE_URL="mysql://identifiant:motdepasse@127.0.0.1:3306/mydatabase?serverVersion=5.7"`


Après DATABASE_URL, il faudra indiquer l'adresse de votre base de données ainsi que ses informations : 
https://symfony.com/doc/current/doctrine.html#configuring-the-database
Vous aurez les instructions à suivre selon votre base de données ici

# 4 - CREATION DE LA BASE DE DONNEES

Il faudra ensuite lancer la commande : php bin/console doctrine:database:create
Pour cela il faudra ouvrir votre invite de commande et être dans le dossier courant :
http://codeur-pro.fr/invite-de-commande-et-terminal/

# 5 - MISE A JOUR DE LA BASE DE DONNEES

Il faudra mettre la base de données à jour en utilisant à nouveau l'invite de commandes et lancer :
`doctrine:schema:update` 

Ceci mettra à jour la base de données

# 6 - INSTALLATION DES FIXTURES 

Il ne restera plus qu'à installer les données fournies avec la commande :

`php bin/console doctrine:fixtures:load`

# 7 - LANCEMENT DU SERVEUR

Pour pouvoir lancer le projet, il faudra avoir installé au préalable le CLI Symfony 

https://symfony.com/download


Puis vous devrez démarrer un serveur local dans le terminal avec cette ligne :

`symfony server:start`


# 8 - ACCEDER AU PROJET : 

Il ne restera plus qu'à accéder au projet à l'adresse suivante :

http://localhost:8000/






