# BacardiBeer

BacardiBeer est une application d'étude en Symfony 7.0, librement basée sur le modèle de données beers/bars/drinkers/likes/sells/frequents dont vous trouverez des exemples nombreux dans la littérature SQL.

## Prérequis

Pour exécuter ce projet, vous aurez besoin des éléments suivants installés sur votre système :
- PHP >= 8.2
- Composer
- Symfony CLI
- Une base de données (MySQL, PostgreSQL, etc., en fonction de votre configuration)

## Installation

Rien de spécial...
- clone
- composer install
- copiez le .env en .env.dev.local et adaptez la chaîne de connexion selon votre configuration
- votre DB ouverte
- php bin/console doctrine:database:create
- les migrations (ou doctrine:schema:update --force)
  
## Démarrage

- symfony server:start -d
