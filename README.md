
        MONDIAL 2030 MAROC - GUIDE INTERACTIF


DESCRIPTION DU PROJET
---------------------
Application web interactive créée avec Laravel pour guider les visiteurs 
à travers les 6 villes hôtes de la Coupe du Monde 2030 au Maroc.

Le site offre une carte interactive avec des informations détaillées sur 
chaque ville : matchs, hôtels, restaurants, lieux touristiques, pharmacies, 
urgences, Airbnbs et stades.

Les utilisateurs peuvent créer un compte pour recevoir des notifications 
sur les mises à jour et les nouveaux matchs, et s'abonner à la newsletter.


VILLES INCLUSES
---------------
1. Casablanca - Capitale économique et hôte du match d'ouverture
2. Rabat - Capitale du Royaume et ville de la finale
3. Marrakech - Ville ocre, ambiance festive
4. Agadir - Perle du sud, stades modernes
5. Tanger - Porte nord-africaine
6. Fès - Capitale spirituelle


FONCTIONNALITÉS PRINCIPALES
----------------------------

1. CARTE INTERACTIVE
   - Carte Leaflet avec pins cliquables pour chaque ville
   - Popups avec informations détaillées
   - Météo en temps réel (OpenWeatherMap API)
   - Compteurs dynamiques (nombre de matchs, hôtels, etc.)

2. SYSTÈME D'AUTHENTIFICATION
   - Inscription et connexion utilisateur
   - Gestion sécurisée des mots de passe

3. NOTIFICATIONS ET NEWSLETTER
   - Notifications en temps réel pour les nouveaux matchs
   - Alertes sur les mises à jour importantes
   - Abonnement à la newsletter
   - Recevoir des informations exclusives sur le Mondial 2030

4. TRADUCTION MULTILINGUE
   - Widget Google Translate intégré dans le footer
   - Support de 12+ langues (Anglais, Espagnol, Arabe, Allemand, 
     Italien, Portugais, Chinois, Japonais, Russe, Néerlandais, 
     Turc, Coréen)
   - Interface élégante avec animations
   - 100% gratuit et illimité

5. PAGES DE RESSOURCES
   - Matchs : Calendrier avec dates et équipes
   - Hôtels : Liste des hébergements avec prix
   - Restaurants : Suggestions par type de cuisine
   - Endroits : Lieux touristiques
   - Pharmacies : Liste par ville
   - Urgences : Contacts d'urgence
   - Airbnbs : Options de location
   - Stades : Informations détaillées

6. CONVERTISSEUR DE DEVISES
   - Conversion en temps réel
   - Support de plusieurs devises internationales

7. DESIGN RESPONSIVE
   - Interface moderne compatible mobile, tablette et desktop
   - Couleurs du drapeau marocain (rouge et vert)
   - Emojis pour navigation intuitive
   - Animations et effets hover


TECHNOLOGIES UTILISÉES
----------------------

Backend:
- Laravel (Framework PHP, version 12 ou supérieure)
- PHP (version 8.0 ou supérieure)
- MySQL (Base de données)
- Laravel Breeze (Système d'authentification)

Frontend:
- Blade (Moteur de templates Laravel)
- Bootstrap 5.3 (Framework CSS)
- Leaflet (Bibliothèque de cartes interactives)
- JavaScript Vanilla

APIs Externes:
- Google Translate API (Widget gratuit)
- OpenWeatherMap API (Données météo)
- Leaflet / OpenStreetMap (Cartes géographiques)


INSTALLATION
------------

PRÉREQUIS:
- PHP >= 8.0
- Composer
- MySQL/MariaDB
- Node.js et NPM

ÉTAPES:

1. Cloner le repository avec git clone
   cd mondial2030maroc

2. Installer les dépendances PHP
   composer install

3. Installer les dépendances Node.js
   npm install

4. Créer le fichier .env
   cp .env.example .env

5. Configurer la base de données dans .env:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=mondial2030maroc2
   DB_USERNAME=root
   DB_PASSWORD=

6. Configurer l'email (pour notifications et newsletter) dans .env:
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=votre_username
   MAIL_PASSWORD=votre_password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=noreply@mondial2030.ma
   MAIL_FROM_NAME="Mondial 2030 Maroc"

7. Générer la clé d'application
   php artisan key:generate

8. Créer la base de données "mondial_2030" dans MySQL

9. Exécuter les migrations
   php artisan migrate

10. Peupler la base de données (optionnel)
    php artisan db:seed

11. Compiler les assets
    npm run dev

12. Lancer le serveur
    php artisan serve

Le site sera accessible à: http://127.0.0.1:8000


CONFIGURATION DES APIs
----------------------

API MÉTÉO (OpenWeatherMap):
1. Créer un compte gratuit sur: https://openweathermap.org/api
2. Obtenir votre clé API gratuite
3. Ajouter dans .env API KEY

GOOGLE TRANSLATE:
Aucune configuration requise! Le widget est déjà intégré et 100% gratuit.

CONFIGURATION EMAIL (pour notifications):
1. Pour développement, utiliser Mailtrap: https://mailtrap.io
2. Créer un compte gratuit
3. Copier les identifiants SMTP dans .env
4. Pour production, utiliser un service comme SendGrid, Mailgun, ou AWS SES


STRUCTURE DU PROJET "DOSSIER ET FICHIERS LES PLUS IMPORTANTS"
mondial2030maroc/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   ├── Notifications/
│   └── Services/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   └── views/
│       ├── auth/
│       ├── layouts/
│       └── index.blade.php
├── routes/
│   └── web.php
├── .env
└── README.md


UTILISATION
-----------

INSCRIPTION ET CONNEXION:
1. Cliquer sur "Connexion" ou "S'inscrire" dans le footer
2. Créer un compte avec nom, email et mot de passe
3. Confirmer votre email (si configuré)
4. Se connecter pour accéder aux fonctionnalités membres

RECEVOIR DES NOTIFICATIONS:
1. Se connecter à votre compte
2. Activer les notifications dans les paramètres
3. Recevoir des alertes pour:
   - Nouveaux matchs ajoutés
   - Mises à jour importantes

ABONNEMENT À LA NEWSLETTER:
1. Cliquer sur "S'abonner à la newsletter" dans le footer
2. Entrer votre adresse email
3. Confirmer l'abonnement
4. Recevoir des newsletters hebdomadaires avec:
   - Actualités du Mondial 2030
   - Conseils de voyage au Maroc
   - Offres exclusives
   - Informations sur les villes hôtes

NAVIGATION:
1. Page d'accueil: Accéder à la carte interactive
2. Cliquer sur un pin pour voir les détails d'une ville
3. Popup interactif avec météo et compteurs en temps réel
4. Boutons de navigation vers les différentes ressources

TRADUCTION:
1. Scroller jusqu'au footer (zone verte)
2. Cliquer sur le sélecteur de langue (icône globe)
3. Choisir votre langue préférée
4. Le site se traduit automatiquement

FILTRAGE PAR VILLE:
- Utiliser la barre de navigation en haut
- Chaque section affiche toutes les informations
- Les popups montrent juste un résumé
- Exemple: Cliquer sur "Hôtels" dans Casablanca pour voir 
  uniquement les hôtels de Casablanca


COMMANDES UTILES
----------------

Vider le cache:
  php artisan cache:clear
  php artisan config:clear
  php artisan route:clear
  php artisan view:clear

Tout vider en une commande:
  php artisan optimize:clear

Créer un contrôleur:
  php artisan make:controller NomController

Créer un modèle avec migration:
  php artisan make:model NomModele -m

Créer une notification:
  php artisan make:notification NomNotification

Envoyer des emails de test:
  php artisan tinker
  >>> Mail::raw('Test email', function($msg) { $msg->to('test@test.com')->subject('Test'); });


PROBLÈMES COURANTS
------------------

Le serveur ne démarre pas:
- Vérifier que le port 8000 n'est pas déjà utilisé
- Essayer: php artisan serve --port=8080

Erreurs de base de données:
- Vérifier les identifiants dans .env
- S'assurer que MySQL est démarré

La traduction ne fonctionne pas:
- Vider le cache: php artisan view:clear
- Recharger la page avec Ctrl+Shift+R

Les emails ne s'envoient pas:
- Vérifier la configuration MAIL dans .env
- Tester la connexion SMTP
- Vérifier les logs dans storage/logs/laravel.log
- Utiliser Mailtrap pour le développement

Erreurs après login:
- Vérifier que les migrations sont à jour: php artisan migrate
- Vider le cache des sessions: php artisan cache:clear


FONCTIONNALITÉS UTILISATEUR
----------------------------

COMPTE UTILISATEUR:
- Création de compte sécurisée
- Connexion/déconnexion

NOTIFICATIONS:
- Notifications en temps réel

NEWSLETTER:
- Abonnement simple
- Désabonnement en un clic
- Newsletters hebdomadaires
- Contenu exclusif


AMÉLIORATIONS FUTURES
---------------------
- Système de favoris pour hôtels et restaurants
- Notifications push sur mobile
- Système de réservation en ligne
- Mode sombre/clair
- Application mobile native
- Chat en direct avec support
- Avis et commentaires des utilisateurs
- Galerie photos pour chaque ville
- Intégration avec réseaux sociaux
- Calendrier personnel des matchs favoris


SÉCURITÉ
--------
- Mots de passe hashés avec bcrypt
- Protection CSRF sur tous les formulaires
- Validation des données côté serveur
- Sessions sécurisées
- Protection contre les injections SQL (Eloquent ORM)
- Rate limiting sur les routes sensibles
- Email verification (optionnel)


AUTEURS
-------
- Sara El khamlichi
- Sirine Kanboui
- Soumaya Charouite

PROFESSEUR/ENCADRANT
--------------------
- Madame Rachida Fissoune

ÉTABLISSEMENT
-------------
- EMSI
- Année académique: 2025-2026


CONTACT
-------
Email: - kanboui.sirine@gmail.com
       - saraelkhamlichi85@gmail.com
       - charouitesoumaya@gmail.com

GitHub: - syrine120
        - souma-char-EMSI
        - saaara-me


REMERCIEMENTS
-------------
Nous tenons à remercier:
- Madame Rachida Fissoune pour son encadrement
- L'EMSI pour les ressources et le support
- La communauté Laravel pour la documentation



LICENCE
-------
Ce projet est un projet académique développé à des fins éducatives.
Tous droits réservés © 2026 EMSI



Fait avec amour pour le Mondial 2030 au Maroc 🇲🇦⚽

