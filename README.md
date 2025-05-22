<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Flashcard API

Backend de mon projet React pour la création et le stockage de flashcards.

## Description

Cette API permet de gérer des flashcards organisées en catégories et thèmes. Les utilisateurs peuvent créer, modifier et supprimer des cartes, des thèmes et des catégories, ainsi que suivre leurs révisions.

## Fonctionnalités

-   **Authentification** : Inscription, connexion et déconnexion des utilisateurs.
-   **Gestion des catégories** : Création, modification et suppression de catégories.
-   **Gestion des thèmes** : Création, modification, suppression et duplication de thèmes.
-   **Gestion des cartes** : Création, modification et suppression de cartes.
-   **Gestion des révisions** : Suivi des révisions des thèmes et des cartes.

## Structure de la base de données

-   **Users** : Informations des utilisateurs (nom, email, mot de passe).
-   **Categories** : Catégories de flashcards (nom, description, utilisateur).
-   **Themes** : Thèmes de flashcards (nom, description, public, utilisateur, catégorie).
-   **Cards** : Cartes de flashcards (texte avant, texte arrière, thème).
-   **Reviews** : Révisions des thèmes et des cartes (date, niveau, utilisateur, thème).

## API Endpoints

### Routes publiques

-   `POST /api/register` : Inscription d'un utilisateur.
-   `POST /api/login` : Connexion d'un utilisateur.
-   `GET /api/cards` : Récupérer toutes les cartes.
-   `GET /api/cards/{id}` : Récupérer une carte par ID.
-   `GET /api/cards/search/{title}` : Rechercher des cartes par titre.
-   `GET /api/categories` : Récupérer toutes les catégories.

### Routes protégées

-   `GET /api/dashboard` : Accès au tableau de bord.
-   `POST /api/cards` : Créer une nouvelle carte.
-   `PUT /api/cards/{id}` : Mettre à jour une carte.
-   `DELETE /api/cards/{id}` : Supprimer une carte.
-   `POST /api/logout` : Déconnexion de l'utilisateur.
-   `PUT /api/users/{id}` : Mettre à jour les informations de l'utilisateur.
-   `GET /api/category-details/{id}` : Récupérer les détails d'une catégorie.
-   `POST /api/categories` : Créer une nouvelle catégorie.
-   `DELETE /api/categories/{id}` : Supprimer une catégorie.
-   `PUT /api/categories/{id}` : Mettre à jour une catégorie.
-   `POST /api/themes` : Créer un nouveau thème.
-   `POST /api/themes/{id}/duplicate` : Dupliquer un thème.
-   `GET /api/themes` : Récupérer tous les thèmes.
-   `GET /api/themes/{id}` : Récupérer un thème par ID.
-   `PUT /api/themes/{id}` : Mettre à jour un thème.
-   `DELETE /api/themes/{id}` : Supprimer un thème.
-   `GET /api/reviews` : Récupérer toutes les révisions.
-   `POST /api/reviews` : Créer une nouvelle révision.
-   `GET /api/reviews/{id}` : Récupérer une révision par ID.
-   `PUT /api/reviews/{id}` : Mettre à jour une révision.
-   `DELETE /api/reviews/{id}` : Supprimer une révision.

## Installation

1. Cloner le dépôt.
2. Installer les dépendances PHP avec Composer : `composer install`.
3. Installer les dépendances Node.js avec npm : `npm install`.
4. Configurer le fichier `.env` avec les informations de la base de données.
5. Exécuter les migrations : `php artisan migrate`.
6. Démarrer le serveur de développement : `php artisan serve`.

## Technologies utilisées

-   **Backend** : Laravel 9.x
-   **Frontend** : React (non inclus dans ce dépôt)
-   **Base de données** : MySQL/PostgreSQL
-   **Authentification** : Laravel Sanctum

## Licence

Ce projet est sous licence MIT.
