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

![image](https://github.com/user-attachments/assets/99ac6670-3a46-4001-862b-87f28edffd0d)

![image](https://github.com/user-attachments/assets/486c1d75-869a-4181-bb0a-34a7fe001a9f)


2. **Maquettage (Wireframe ou Mock-up)**
   - Réalisez un wireframe ou un mock-up de l'application en veillant à l'UX/UI.
   - Utilisez des outils tels que Figma.

![image](https://github.com/user-attachments/assets/39f9db82-de58-4fc4-9390-3fe9d4df5be1)
![image](https://github.com/user-attachments/assets/fc60fb48-5561-4402-b136-016901607a5a)
![image](https://github.com/user-attachments/assets/8b6dd2e3-00f9-420d-9d09-7ef023b6fb26)

3. **Gestion de Projet avec Trello (Méthode MoSCoW)**
   - Créez un tableau Trello pour gérer le projet en utilisant la méthode MoSCoW (Must have, Should have, Could have, Would have).
   - Identifiez et catégorisez les fonctionnalités prioritaires.

![image](https://github.com/user-attachments/assets/056ba229-b8d9-4dd4-a863-0df56e5576f6)

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
