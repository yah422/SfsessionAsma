# SessiOnGo -> Gestion des Sessions de Formations 

## Description
Cette application permet de gérer les sessions de formation pour les administrateurs d'un centre de formation. Accessible uniquement par les administrateurs, l'application gère les sessions de formation avec des places limitées, des dates spécifiques, un suivi des inscriptions, et des programmes de formation avec plusieurs modules.

## Fonctionnalités
- Gestion des sessions de formation avec un nombre de places limité et des dates de début et de fin.
- Suivi des places restantes en fonction des inscriptions.
- Chaque session a un programme composé de plusieurs modules appartenant à des catégories spécifiques (par exemple : **BUREAUTIQUE** ou **DEV WEB**).
- Les modules ont une durée spécifique qui peut varier d'une session à l'autre.
- Possibilité d'ajouter et de gérer les stagiaires et les sessions de formation.

## Structure du Projet
1. **Modèle Conceptuel de Données (MCD) / Modèle Logique de Données (MLD)**
   - Conception de la base de données pour représenter les entités de l'application (sessions, modules, catégories, stagiaires, etc.).
   - Créez les schémas nécessaires pour illustrer les relations entre les entités.

![image](https://github.com/user-attachments/assets/0dcbc7e0-9c2d-4519-b167-efb5cccb416e)

![image](https://github.com/user-attachments/assets/b64b4c2a-3c5a-4c50-be6b-5c4dc5f2c90d)


2. **Maquettage (Wireframe ou Mock-up)**
   - Réalisez un wireframe ou un mock-up de l'application en veillant à l'UX/UI.
   - Utilisez des outils tels que Figma.

![image](https://github.com/user-attachments/assets/ad6c1570-047d-401f-9934-89f94e693d2b)
![image](https://github.com/user-attachments/assets/657c959c-56e2-4cb8-b1b4-e373014498f9)
![image](https://github.com/user-attachments/assets/a4a287b0-e54a-4140-9f84-3d75a19354bb)


3. **Gestion de Projet avec Trello (Méthode MoSCoW)**
   - Créez un tableau Trello pour gérer le projet en utilisant la méthode MoSCoW (Must have, Should have, Could have, Would have).
   - Identifiez et catégorisez les fonctionnalités prioritaires.

![image](https://github.com/user-attachments/assets/87a706d1-ffa4-4884-a24f-67fd2e5f73ee)

4. **Développement de l'Application (Pattern MVC)**
   - Suivez le design pattern MVC (Modèle-Vue-Contrôleur) pour le développement de l'application.
   - Les fonctionnalités de l'application incluent l'affichage des sessions disponibles, le programme de chaque session, les stagiaires inscrits à chaque session, et les détails des stagiaires (sessions auxquelles ils sont inscrits).

5. **Gestion des Modules et Catégories**
   - Interface pour ajouter des stagiaires et des sessions de formation.
   - Planification des modules pour chaque session.


## Prérequis
- PHP, Symfony 
- Base de données MySQL ou PostgreSQL
- Serveur web (Apache/Nginx)
- Composer

## Installation
1. Clonez le dépôt :
   ```bash
   git clone https://github.com/votre-utilisateur/votre-repository.git
   cd votre-repository
   ```

2. Installez les dépendances :
   ```bash
   composer install
   ```

3. Configurez votre base de données dans le fichier `.env`.

4. Créez les tables à partir de votre MCD/MLD :
   ```bash
   php bin/console doctrine:schema:update --force
   ```

5. Démarrez le serveur :
   ```bash
   symfony serve -d 
