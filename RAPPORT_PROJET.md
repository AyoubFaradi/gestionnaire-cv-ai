# Rapport de Projet - Gestionnaire Intelligent de CV avec IA

## Table des matières
1. [Contexte et objectifs](#contexte-et-objectifs)
2. [Analyse des besoins](#analyse-des-besoins)
3. [Architecture technique](#architecture-technique)
4. [Modèle de données](#modèle-de-données)
5. [Endpoints API](#endpoints-api)
6. [Sécurité et gestion des données](#sécurité-et-gestion-des-données)
7. [Intégration de l'intelligence artificielle](#intégration-de-lintelligence-artificielle)
8. [Conteneurisation](#conteneurisation)
9. [DevOps et CI/CD](#devops-et-cicd)
10. [Guide d'installation](#guide-dinstallation)
11. [Captures d'écran](#captures-décran)
12. [Conclusion et perspectives](#conclusion-et-perspectives)

---

## 1. Contexte et objectifs

### 1.1 Problématique
Les étudiants et jeunes diplômés rencontrent de nombreuses difficultés lors de leur recherche d'emploi :
- Structuration efficace de leur profil professionnel
- Valorisation optimale de leurs expériences
- Adaptation de leur candidature à des offres spécifiques
- Rédaction de documents professionnels percutants

### 1.2 Objectif principal
Développer une application web intelligente d'aide à la candidature permettant aux utilisateurs de :
- Construire et gérer leur profil professionnel
- Organiser leurs données de manière structurée
- Générer automatiquement différents documents grâce à l'IA
- Adapter leur candidature aux offres d'emploi spécifiques

### 1.3 Objectifs secondaires
- Faciliter la gestion des langues et compétences
- Offrir des templates de CV personnalisables
- Assurer une expérience utilisateur moderne et intuitive
- Garantir la sécurité des données personnelles

---

## 2. Analyse des besoins

### 2.1 Besoins fonctionnels
- **Gestion utilisateur** : Création de compte, authentification sécurisée
- **Profil professionnel** : Titre, résumé, coordonnées, liens externes
- **Expériences** : Poste, entreprise, dates, description, compétences
- **Formations** : Établissement, diplôme, spécialité, dates
- **Compétences** : Nom, niveau, catégorie (technique, linguistique, etc.)
- **Langues** : Nom, niveau de maîtrise
- **Offres d'emploi** : Titre, entreprise, description, date d'ajout
- **Documents générés** : CV, lettres, emails avec historique
- **Templates de CV** : Styles et modèles personnalisables

### 2.2 Besoins techniques
- **Backend robuste** : API REST sécurisée et performante
- **Base de données** : Structuration efficace des données
- **Intégration IA** : Connexion à des LLM pour la génération
- **Frontend moderne** : Interface responsive et intuitive
- **Sécurité** : Protection des données personnelles
- **Déploiement** : Conteneurisation et CI/CD

---

## 3. Architecture technique

### 3.1 Vue d'ensemble
```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│   Frontend     │    │    Backend      │    │   Base de      │
│   (HTML/CSS/JS)│    │   (Laravel/PHP)  │    │   (MySQL)       │
└─────────────────┘    └─────────────────┘    └─────────────────┘
                                │
                                ▼
                    ┌─────────────────┐    ┌─────────────────┐
                    │   Services IA    │    │   API REST     │
                    └─────────────────┘    └─────────────────┘
```

### 3.2 Stack technologique
#### 3.2.1 Backend
- **Framework** : Laravel 12, PHP 8.2+
- **Base de données** : MySQL 8.0+ (production)
- **Authentification** : Laravel Sanctum avec tokens API
- **API** : Architecture RESTful avec validation
- **Cache** : Redis pour les performances
#### 3.2.2 Frontend
- **HTML5** : Sémantique moderne
- **CSS3** : TailwindCSS pour le design responsive
- **JavaScript** : Vanilla JS pour compatibilité maximale
- **Responsive** : Mobile-first approach
#### 3.2.3 IA & Services
- **LLM** : OpenAI GPT-3.5-turbo
- **HTTP Client** : Laravel HTTP Client optimisé
- **Prompts** : Templates structurés et optimisés
#### 3.2.4 DevOps
- **Conteneurisation** : Docker + Docker Compose
- **CI/CD** : GitHub Actions pour tests et déploiement
- **Monitoring** : Logs centralisés et métriques de performance

---

## 4. Modèle de données

### 4.1 Configuration SQL et MySQL
Le projet utilise **Laravel** avec une base de données **MySQL** configurée pour la production, offrant des performances optimales pour une application de cette envergure. Cette configuration a été implémentée par vous-même pour garantir une base de données robuste et performante.

### 4.2 Structure de la base de données
Le schéma relationnel a été conçu pour optimiser les requêtes et garantir l'intégrité des données :
```
Users (1) ──────── (1) Profiles
Profiles (1) ──────── (N) Experiences
Profiles (1) ──────── (N) Formations  
Profiles (1) ──────── (N) Skills
Users (1) ──────── (N) Languages
Users (1) ──────── (N) Documents
```

#### Tables principales

##### 1. Table `users`
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NULL,
    identifiant VARCHAR(255) UNIQUE NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email_verified_at TIMESTAMP NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

##### 2. Table `profiles`
```sql
CREATE TABLE profiles (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NOT NULL,
    title VARCHAR(255) NULL,
    summary TEXT NULL,
    phone VARCHAR(255) NULL,
    address TEXT NULL,
    linkedin VARCHAR(255) NULL,
    github VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

##### 3. Table `experiences`
```sql
CREATE TABLE experiences (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    profile_id BIGINT NOT NULL,
    poste VARCHAR(255) NOT NULL,
    entreprise VARCHAR(255) NOT NULL,
    description TEXT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NULL,
    actuel BOOLEAN DEFAULT FALSE,
    lieu VARCHAR(255) NULL,
    competences_associees JSON NULL,
    ordre INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (profile_id) REFERENCES profiles(id) ON DELETE CASCADE
);
```

##### 4. Table `formations`
```sql
CREATE TABLE formations (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    profile_id BIGINT NOT NULL,
    diplome VARCHAR(255) NOT NULL,
    etablissement VARCHAR(255) NOT NULL,
    specialite VARCHAR(255) NULL,
    description TEXT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NULL,
    actuel BOOLEAN DEFAULT FALSE,
    lieu VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (profile_id) REFERENCES profiles(id) ON DELETE CASCADE
);
```

##### 5. Table `skills`
```sql
CREATE TABLE skills (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    profile_id BIGINT NOT NULL,
    name VARCHAR(255) NOT NULL,
    level ENUM('debutant', 'intermediaire', 'avance', 'expert') DEFAULT 'intermediaire',
    category VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (profile_id) REFERENCES profiles(id) ON DELETE CASCADE
);
```

##### 6. Table `languages`
```sql
CREATE TABLE languages (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    profile_id BIGINT NOT NULL,
    name VARCHAR(100) NOT NULL,
    level ENUM('debutant', 'elementaire', 'intermediaire', 'avance', 'bilingue', 'langue_maternelle') DEFAULT 'intermediaire',
    certification TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (profile_id) REFERENCES profiles(id) ON DELETE CASCADE
);
```

##### 7. Table `job_offers`
```sql
CREATE TABLE job_offers (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    company VARCHAR(255) NOT NULL,
    description TEXT NULL,
    location VARCHAR(255) NULL,
    contract_type VARCHAR(100) NULL,
    salary_min INT NULL,
    salary_max INT NULL,
    date_limite DATE NULL,
    contact_email VARCHAR(255) NOT NULL,
    date_ajout DATE NULL,
    active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

##### 8. Table `documents`
```sql
CREATE TABLE documents (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NOT NULL,
    type ENUM('cv', 'lettre', 'email') NOT NULL,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    file_path VARCHAR(255) NULL,
    metadata JSON NULL,
    modele_ia_utilise VARCHAR(100) NULL,
    date_generation TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

##### 9. Table `cv_templates`
```sql
CREATE TABLE cv_templates (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    style VARCHAR(255) NOT NULL,
    description TEXT NULL,
    options JSON NULL,
    is_default BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    preview_image VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Index et contraintes

Des index stratégiques ont été ajoutés pour optimiser les performances :

```sql
-- Index pour les recherches fréquentes
CREATE INDEX idx_profiles_user_id ON profiles(user_id);
CREATE INDEX idx_experiences_profile_id ON experiences(profile_id);
CREATE INDEX idx_formations_profile_id ON formations(profile_id);
CREATE INDEX idx_skills_profile_id ON skills(profile_id);
CREATE INDEX idx_languages_profile_id ON languages(profile_id);
CREATE INDEX idx_documents_user_id ON documents(user_id);
CREATE INDEX idx_job_offers_active ON job_offers(active, date_limite);

-- Index pour les recherches textuelles
CREATE INDEX idx_job_offers_title ON job_offers(title);
CREATE INDEX idx_job_offers_company ON job_offers(company);
CREATE INDEX idx_skills_name ON skills(name);
CREATE INDEX idx_languages_name ON languages(name);
```

### Migration et Seeding

Le processus de migration Laravel garantit que toutes les tables sont créées avec la structure correcte :

```bash
# Exéut les migrations
php artisan migrate

# Exécuter les seeders (données de test)
php artisan db:seed
```

### Avantages de MySQL pour ce projet

1. **Performance** : Requêtes optimisées avec index appropriés
2. **Scalabilité** : Supporte nativement les transactions et relations complexes
3. **Intégrité** : Contraintes foreign key garantissent la cohérence
4. **ACIDité** : Support complet des transactions et rollbacks
5. **Outils** : Écosystème mature avec des outils d'administration performants
6. **Réplication** : Support natif pour la réplication en production

### Configuration de développement

Pour le développement, SQLite reste disponible grâce à la configuration flexible :

```bash
# Pour utiliser SQLite en développement
DB_CONNECTION=sqlite
# DB_DATABASE=database.sqlite
```

Cette configuration hybride permet :
- **Développement rapide** avec SQLite
- **Production robuste** avec MySQL
- **Flexibilité** pour changer selon l'environnement

---

## 5. Endpoints API

### 5.1 Authentification
- `POST /api/register` - Création compte
- `POST /api/login` - Connexion utilisateur
- `POST /api/logout` - Déconnexion
- `GET /api/profile` - Profil utilisateur authentifié

### 5.2 Gestion profil
- `GET /api/profiles` - Lister profils
- `POST /api/profiles` - Créer profil
- `GET /api/profiles/{id}` - Détails profil
- `PUT /api/profiles/{id}` - Mettre à jour profil
- `DELETE /api/profiles/{id}` - Supprimer profil

### 5.3 Expériences
- `GET /api/experiences` - Lister expériences
- `POST /api/experiences` - Ajouter expérience
- `PUT /api/experiences/{id}` - Modifier expérience
- `DELETE /api/experiences/{id}` - Supprimer expérience

### 5.4 Formations
- `GET /api/formations` - Lister formations
- `POST /api/formations` - Ajouter formation
- `PUT /api/formations/{id}` - Modifier formation
- `DELETE /api/formations/{id}` - Supprimer formation

### 5.5 Compétences
- `GET /api/skills` - Lister compétences
- `POST /api/skills` - Ajouter compétence
- `PUT /api/skills/{id}` - Modifier compétence
- `DELETE /api/skills/{id}` - Supprimer compétence

### 5.6 Offres d'emploi
- `GET /api/job-offers` - Lister offres (avec filtres)
- `POST /api/job-offers` - Créer offre
- `GET /api/job-offers/{id}` - Détails offre
- `PUT /api/job-offers/{id}` - Modifier offre
- `DELETE /api/job-offers/{id}` - Supprimer offre

### 5.7 Services IA
- `POST /api/ai/generate/cv` - Générer CV
- `POST /api/ai/generate/letter` - Générer lettre motivation
- `POST /api/ai/generate/email` - Générer email candidature
- `POST /api/ai/improve` - Améliorer texte
- `GET /api/ai/documents` - Lister documents générés
- `GET /api/ai/documents/{id}` - Détails document
- `DELETE /api/ai/documents/{id}` - Supprimer document

---

## 6. Sécurité et gestion des données

### 6.1 Mesures de sécurité
- **Authentification** : Tokens Sanctum avec expiration
- **Mot de passe** : Hashage bcrypt (12 rounds)
- **Validation** : FormRequest pour toutes les entrées
- **CORS** : Configuration restrictive
- **HTTPS** : Recommandé en production
- **Rate limiting** : Protection contre abus

### 6.2 Protection des données personnelles
- **Anonymisation** : Possibilité de supprimer toutes les données
- **Consentement** : Acceptation explicite lors de l'inscription
- **Minimalisation** : Collecte uniquement des données nécessaires
- **Chiffrement** : Données sensibles cryptées

### 6.3 Gestion des erreurs
- **Logging** : Traçabilité des erreurs serveur
- **Messages sécurisés** : Pas de fuites d'informations
- **Monitoring** : Surveillance des tentatives d'intrusion

---

## 7. Intégration de l'intelligence artificielle

### 7.1 Services IA implémentés
- **Reformulation professionnelle** : Amélioration descriptions expériences
- **Génération résumé profil** : Synthèse automatique du profil
- **Génération lettre motivation** : Adaptation à offre spécifique
- **Génération email candidature** : Emails professionnels personnalisés
- **Amélioration textuelle** : Suggestions de reformulation
- **Adaptation contenu** : Personnalisation selon offre d'emploi

### 7.2 Architecture IA
```php
AIService
├── generateCV($profileData)
├── generateLetter($jobOffer, $profile)  
├── generateEmail($recipient, $subject, $content)
├── improveText($text, $context)
└── adaptToJobOffer($content, $jobOffer)
```

### 7.3 Prompts optimisés
- **Templates structurés** pour chaque type de génération
- **Contextualisation** avec données utilisateur
- **Validation** des résultats générés
- **Historisation** des générations

---

## 8. Conteneurisation

### 8.1 Dockerfile
```dockerfile
FROM php:8.2-fpm
WORKDIR /var/www/html
COPY . .
RUN composer install
RUN php artisan key:generate
EXPOSE 9000
CMD ["php-fpm"]
```

### 8.2 Docker Compose
```yaml
version: '3.8'
services:
  app:
    build: .
    ports:
      - "8000:8000"
    volumes:
      - .:/var/www/html
    depends_on:
      - db
  
  db:
    image: mysql:8.0
    environment:
      MYSQL_DATABASE: gestion_cv
      MYSQL_ROOT_PASSWORD: password
    volumes:
      - db_data:/var/lib/mysql

volumes:
  db_data:
```

### 8.3 Avantages
- **Reproductibilité** : Environnement identique partout
- **Isolation** : Pas de conflits de dépendances
- **Scalabilité** : Déploiement facilité
- **Versionning** : Infrastructure as code

---

## 9. DevOps et CI/CD

### 9.1 GitHub Actions
```yaml
name: CI/CD Pipeline
on: [push, pull_request]
jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
      - name: Install dependencies
        run: composer install
      - name: Run tests
        run: php artisan test
      - name: Lint code
        run: composer run lint
```

### 9.2 Processus de déploiement
1. **Développement** : Branches feature
2. **Tests** : Validation automatique
3. **Review** : Code review par pairs
4. **Merge** : Intégration branche main
5. **Déploiement** : Mise en production automatique

### 9.3 Monitoring
- **Logs centralisés** : ELK Stack ou équivalent
- **Métriques** : Performance et disponibilité
- **Alertes** : Notification en cas d'anomalie

---

## 10. Guide d'installation

### 10.1 Prérequis
- PHP 8.2+
- Composer
- MySQL 8.0+ (ou SQLite pour développement)
- Node.js 18+ (optionnel pour frontend)
- Docker (optionnel)

### 10.2 Installation locale
```bash
# Cloner le repository
git clone https://github.com/username/gestionnaire-cv-ia.git
cd gestionnaire-cv-ia

# Installer dépendances
composer install

# Configuration
cp .env.example .env
php artisan key:generate

# Base de données
php artisan migrate
php artisan db:seed

# Démarrer serveur
php artisan serve
```

### 10.3 Installation avec Docker
```bash
# Cloner et construire
git clone https://github.com/username/gestionnaire-cv-ia.git
cd gestionnaire-cv-ia
docker-compose up --build
```

### 10.4 Configuration
- **Base de données** : Modifier `.env` avec credentials
- **API IA** : Ajouter clé OpenAI dans `.env`
- **Email** : Configuration SMTP pour notifications

---

## 11. Captures d'écran

### 11.1 Page de connexion
- Interface moderne avec formulaire login/register
- Compte de test intégré
- Messages d'erreur clairs

### 11.2 Dashboard utilisateur
- Vue d'ensemble des fonctionnalités
- Accès rapide à toutes les sections
- Documentation API intégrée

### 11.3 Gestion du profil
- Formulaire structuré
- Validation en temps réel
- Sauvegarde automatique

### 11.4 Génération IA
- Interface intuitive pour générer documents
- Options de personnalisation
- Aperçu avant génération

---

## 12. Conclusion et perspectives

### 12.1 Réalisations
- ✅ API REST complète et sécurisée
- ✅ Intégration IA fonctionnelle
- ✅ Interface utilisateur moderne
- ✅ Architecture scalable et maintenable
- ✅ Conteneurisation complète
- ✅ Pipeline CI/CD opérationnel

### 12.2 Limites actuelles
- Templates de CV limités (possibilité d'extension)
- Support multilingue partiel
- Tests automatisés à compléter
- Documentation utilisateur à enrichir

### 12.3 Perspectives d'évolution
- **Frontend avancé** : Application Vue.js/React complète
- **Templates étendus** : Plus de designs de CV
- **Multilingue** : Support international complet
- **Mobile** : Application native ou PWA
- **Analytics** : Statistiques d'utilisation
- **Collaboration** : Partage et feedback
- **Intégrations** : LinkedIn, autres plateformes

### 12.4 Impact attendu
- **Pour les étudiants** : Outil puissant pour leur recherche d'emploi
- **Pour les recruteurs** : Accès à des candidatures de qualité
- **Pour l'éducation** : Support pédagogique pour les carrières

---

## Annexes

### A. Configuration technique détaillée
### B. Scripts de déploiement
### C. Documentation API complète
### D. Guide de contribution

---

*Rapport rédigé le 23 mars 2026*
*Version 1.0*
