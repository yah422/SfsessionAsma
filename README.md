# 🎓 SessiOnGo - Plateforme de Gestion de Sessions de Formation  
**Application Symfony pour administrateurs de centres de formation**  
*Gestion complète des sessions, stagiaires et modules avec une architecture MVC*  

![Dashboard Preview](https://github.com/user-attachments/assets/0dcbc7e0-9c2d-4519-b167-efb5cccb416e)  

---

## ✨ Fonctionnalités clés  
- **Gestion des sessions**  
  - Création avec dates, capacités et suivi des places en temps réel.  
  - Attribution dynamique de modules (durée adaptable par session).  
- **Organisation des formations**  
  - Modules classés par catégories (ex: **DEV WEB**, **BUREAUTIQUE**).  
  - Visualisation des programmes détaillés.  
- **Suivi des stagiaires**  
  - Inscriptions aux sessions avec profil dédié.  
  - Export des données (CSV/PDF).

---

## 🛠️ Stack Technique  
![Symfony](https://img.shields.io/badge/Symfony-6.3-%23000000?logo=symfony)  
![PHP](https://img.shields.io/badge/PHP-8.1-%23777BB4?logo=php)  
![MySQL](https://img.shields.io/badge/MySQL-8.0-%234479A1?logo=mysql)  
![Twig](https://img.shields.io/badge/Twig-3.x-%23993333?logo=twig)  

---

## � Méthodologie  
### 🔍 Conception  
- **MCD/MLD** modélisés avec UML  
  ![Schéma DB](https://github.com/user-attachments/assets/b64b4c2a-3c5a-4c50-be6b-5c4dc5f2c90d)  
- **Maquettes Figma** (UX/UI optimisé)  
  ![Wireframe](https://github.com/user-attachments/assets/a4a287b0-e54a-4140-9f84-3d75a19354bb)  

### 📌 Gestion de projet  
- **Méthode MoSCoW** via Trello  
  ![Trello](https://github.com/user-attachments/assets/87a706d1-ffa4-4884-a24f-67fd2e5f73ee)  
- **Architecture MVC** stricte  
  ```bash
  src/
  ├── Controller/
  ├── Entity/
  ├── Repository/
  └── templates/ # Twig
  ```

---

## 🚀 Installation  
1. Cloner le dépôt :  
   ```bash  
   git clone https://github.com/yah422/SessiOnGo.git && cd SessiOnGo  
   ```  
2. Installer les dépendances :  
   ```bash  
   composer install  
   ```  
3. Configurer `.env` :  
   ```ini  
   DATABASE_URL="mysql://root@127.0.0.1:3306/sessiongo"  
   ```  
4. Migrations :  
   ```bash  
   php bin/console doctrine:migrations:migrate  
   ```  
5. Lancer le serveur :  
   ```bash  
   symfony serve -d  
   ```  

---

## 📸 Aperçus  
| Page d'accueil | Gestion des sessions |  
|----------------|----------------------|  
| ![Home](https://github.com/user-attachments/assets/ad6c1570-047d-401f-9934-89f94e693d2b) | ![Sessions](https://github.com/user-attachments/assets/657c959c-56e2-4cb8-b1b4-e373014498f9) |  

---

## 🔮 Roadmap  
- [ ] **Tests automatisés** (PHPUnit).  
- [ ] **Tableau de bord** avancé avec statistiques.  

---

## 💡 Pourquoi ce projet ?  
Développé dans le cadre de ma formation DWWM, **SessiOnGo** m'a permis de :  
✅ Maîtriser **Symfony 6** et l'écosystème PHP moderne.  
✅ Appliquer les bonnes pratiques de **modélisation de données**.  
✅ Gérer un projet complet avec **méthodologie Agile**.  

---

## 📜 License  
MIT © SAIDI Asma
