# Gestionnaire Intelligent de CV avec IA - Backend API

API backend RESTful moderne qui aide les étudiants et jeunes diplômés à créer, gérer et optimiser leurs candidatures grâce à l'intelligence artificielle. Le frontend React frontal est développé séparément par l'équipe dédiée.

## 🎯 Objectifs

- **API RESTful complète** : gestion des profils, expériences, formations, compétences
- **Services IA intégrés** : génération de CV, lettres de motivation, emails
- **Adaptation automatique** : contenu optimisé selon les offres d'emploi
- **Authentification sécurisée** : Laravel Sanctum avec tokens API
- **Protection des données** : validation, chiffrement et sécurité des données personnelles

## 🚀 Fonctionnalités principales

### 📝 Gestion de profil
- Création et modification du profil professionnel
- Ajout d'expériences professionnelles détaillées
- Gestion des formations académiques
- Catalogue de compétences avec niveaux
- Gestion des langues étrangères

### 🤖 Services IA
- **Génération de CV** : templates professionnels optimisés
- **Lettres de motivation** : adaptées aux offres spécifiques
- **Emails de candidature** : rédaction professionnelle
- **Amélioration textuelle** : suggestions de reformulation
- **Adaptation automatique** : contenu personnalisé selon l'offre

### 💼 Offres d'emploi
- Consultation des offres disponibles
- Sauvegarde des offres intéressantes
- Adaptation des candidatures aux offres

### 📊 Dashboard
- Vue d'ensemble du profil
- Accès rapide à toutes les fonctionnalités
- Historique des documents générés

## 🛠️ Stack technique

### Backend (API)
- **Framework** : Laravel 12 (RESTful API)
- **PHP** : 8.2+
- **Base de données** : MySQL 8.0+ (production) / SQLite (développement)
- **Authentification** : Laravel Sanctum (API tokens)
- **Architecture** : Service-oriented + Repository pattern
- **API Documentation** : Endpoints RESTful structurés

### Frontend
> **Frontend React développé séparément** par l'équipe frontend dédiée
> - React 18+
> - TypeScript
> - Vite + TailwindCSS
> - Intégration avec cette API via axios/fetch

### Services & Technologies
- **LLM** : OpenAI GPT-3.5-turbo
- **HTTP Client** : Laravel HTTP Client
- **Prompts optimisés** : templates structurés

### DevOps
- **Conteneurisation** : Docker + Docker Compose
- **CI/CD** : GitHub Actions
- **Version control** : Git

## 📦 Installation & Déploiement

### Architecture
```
┌─────────────────────────────────────────┐
│  Frontend React (Développé séparément)  │
│  Repository: gestionnaire-cv-frontend   │
└──────────────┬──────────────────────────┘
               │ HTTP Calls / Axios
┌──────────────▼──────────────────────────┐
│  Backend Laravel API (ce repository)    │
│  - RESTful Endpoints                    │
│  - Authentication (Sanctum)             │
│  - Services IA (OpenAI)                 │
│  - Database Models                      │
└─────────────────────────────────────────┘
```

### Prérequis
- PHP 8.2 ou supérieur
- Composer
- MySQL 8.0+ (ou SQLite pour développement)
- Git

### Installation locale

1. **Cloner le repository**
   ```bash
   git clone https://github.com/AyoubFaradi/gestionnaire-cv-ai.git
   cd gestionnaire-cv-ai
   ```

2. **Installer les dépendances**
   ```bash
   composer install
   ```

3. **Configurer l'environnement**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurer la base de données**
   
   Pour SQLite (développement) :
   ```bash
   # Modifier .env
   DB_CONNECTION=sqlite
   # DB_DATABASE=gestion_cv (sera créé automatiquement)
   ```
   
   Pour MySQL (production) :
   ```bash
   # Modifier .env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=gestion_cv
   DB_USERNAME=votre_user
   DB_PASSWORD=votre_password
   
   # Créer la base de données
   mysql -u root -p -e "CREATE DATABASE gestion_cv;"
   ```

5. **Exécuter les migrations et seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Configurer l'API IA (optionnel)**
   ```bash
   # Ajouter dans .env
   OPENAI_API_KEY=votre_cle_openai
   ```

7. **Démarrer le serveur API**
   ```bash
   php artisan serve
   ```
   L'API sera disponible sur `http://127.0.0.1:8000/api`

8. **Comptes de test**
   ```
   Email : jean.dupont@example.com
   Mot de passe : password123
   ```
   ℹ️ *Note: L'interface utilisateur (Frontend React) doit être démarrée séparément*

### Installation & Lancement avec Docker

1. **Cloner et construire le backend**
   ```bash
   git clone https://github.com/AyoubFaradi/gestionnaire-cv-ai.git
   cd gestionnaire-cv-ai
   docker-compose up --build
   ```

2. **API disponible sur**
   - URL : `http://localhost:8000/api`
   - Documentation interactive : `http://localhost:8000/api/docs` (optionnel)

3. **Frontend React** (démarrer séparément)
   ```bash
   git clone https://github.com/AyoubFaradi/gestionnaire-cv-frontend.git
   cd gestionnaire-cv-frontend
   npm install && npm run dev
   ```

## 📚 Documentation API

### Base URL
```
http://127.0.0.1:8000/api
```

### Authentification
Toutes les routes protégées nécessitent un header :
```
Authorization: Bearer {token}
```

### Endpoints principaux

#### Authentification
- `POST /register` - Création de compte
  ```json
  {
    "name": "Jean Dupont",
    "email": "jean@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }
  ```

- `POST /login` - Connexion
  ```json
  {
    "email": "jean@example.com",
    "password": "password123"
  }
  ```

- `POST /logout` - Déconnexion (token requis)

- `GET /profile` - Profil utilisateur (token requis)

#### Profils
- `GET /profiles` - Lister les profils
- `POST /profiles` - Créer un profil
- `GET /profiles/{id}` - Détails d'un profil
- `PUT /profiles/{id}` - Mettre à jour un profil
- `DELETE /profiles/{id}` - Supprimer un profil

#### Expériences
- `GET /experiences` - Lister les expériences
- `POST /experiences` - Ajouter une expérience
- `PUT /experiences/{id}` - Modifier une expérience
- `DELETE /experiences/{id}` - Supprimer une expérience

#### Formations
- `GET /formations` - Lister les formations
- `POST /formations` - Ajouter une formation
- `PUT /formations/{id}` - Modifier une formation
- `DELETE /formations/{id}` - Supprimer une formation

#### Compétences
- `GET /skills` - Lister les compétences
- `POST /skills` - Ajouter une compétence
- `PUT /skills/{id}` - Modifier une compétence
- `DELETE /skills/{id}` - Supprimer une compétence

#### Langues
- `GET /languages` - Lister les langues
- `POST /languages` - Ajouter une langue
- `PUT /languages/{id}` - Modifier une langue
- `DELETE /languages/{id}` - Supprimer une langue

#### Offres d'emploi
- `GET /job-offers` - Lister les offres (avec filtres)
- `POST /job-offers` - Créer une offre
- `GET /job-offers/{id}` - Détails d'une offre
- `PUT /job-offers/{id}` - Modifier une offre
- `DELETE /job-offers/{id}` - Supprimer une offre

#### Services IA
- `POST /ai/generate/cv` - Générer un CV
  ```json
  {
    "profile_id": 1,
    "template": "modern"
  }
  ```

- `POST /ai/generate/letter` - Générer une lettre de motivation
  ```json
  {
    "job_offer_id": 1,
    "profile_id": 1,
    "tone": "professional"
  }
  ```

- `POST /ai/generate/email` - Générer un email de candidature
  ```json
  {
    "recipient": "rh@entreprise.com",
    "subject": "Candidature au poste de...",
    "profile_id": 1
  }
  ```

- `POST /ai/improve` - Améliorer un texte
  ```json
  {
    "text": "Mon expérience chez...",
    "context": "professional_experience"
  }
  ```

#### Documents générés
- `GET /ai/documents` - Lister les documents générés
- `GET /ai/documents/{id}` - Détails d'un document
- `DELETE /ai/documents/{id}` - Supprimer un document

#### Routes publiques (sans authentification)
- `GET /public/job-offers` - Consulter les offres d'emploi
- `GET /public/cv-templates` - Voir les templates de CV

## 🔧 Configuration

### Variables d'environnement du Backend

```bash
# Application
APP_NAME="Gestionnaire Intelligent de CV"
APP_ENV=local
APP_KEY=base64:votre_cle_application
APP_DEBUG=true
APP_URL=http://localhost:8000

# Base de données
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_cv
DB_USERNAME=root
DB_PASSWORD=

# Services IA
OPENAI_API_KEY=votre_cle_openai

# CORS pour le Frontend React
SANCTUM_STATEFUL_DOMAINS=localhost:3000,localhost:5173
SESSION_DOMAIN=localhost
```

### Configuration CORS pour le Frontend

Le backend accepte les requêtes du frontend React. À configurer dans :
- `config/cors.php` 
- `.env` via `SANCTUM_STATEFUL_DOMAINS`

### Variables d'environnement du Frontend React

Le frontend doit configurer l'endpoint de l'API (à documenter dans le repository frontend) :
```
VITE_API_URL=http://localhost:8000/api
```

## 🔗 Intégration Frontend

Ce repository contient **uniquement l'API backend**. Le frontend React est développé dans un repository séparé.

### Communication entre Frontend et Backend

**Frontend React** envoie des requêtes HTTP au **Backend Laravel** :

```javascript
// Exemple d'appel depuis le frontend React
const response = await fetch('http://localhost:8000/api/profiles', {
  method: 'GET',
  headers: {
    'Authorization': 'Bearer ' + token,
    'Content-Type': 'application/json'
  }
});
```

### Repositories liés
- 📦 **Backend** (ce projet): `gestionnaire-cv-ai` - API Laravel
- 🎨 **Frontend** (séparé): `gestionnaire-cv-frontend` - React + Vite (à développer)

## 🧪 Tests

### Exécuter les tests
```bash
php artisan test
```

### Tests avec coverage
```bash
php artisan test --coverage
```

### Linting du code
```bash
# PHP CS Fixer
composer run lint

# PHPStan
composer run analyse
```

## 📝 Développement

### Structure du projet backend
```
├── app/
│   ├── Http/
│   │   ├── Controllers/Api/    # Contrôleurs API endpoints
│   │   ├── Middleware/         # Authentification, CORS
│   │   └── Requests/           # Form validation
│   ├── Models/                 # Modèles Eloquent (Profile, Experience, etc.)
│   ├── Services/AI/            # Services IA (OpenAI integration)
│   └── Providers/
├── database/
│   ├── migrations/             # Schéma de la BDD
│   └── seeders/                # Données de test
├── routes/
│   ├── api.php                 # Routes de l'API RESTful
│   └── console.php
├── tests/                      # Tests unitaires et feature
├── config/                     # Configuration (app, database, services)
└── storage/                    # Logs, cache, files
```

### Conventions de code
- **PSR-12** pour le style de code
- **CamelCase** pour les méthodes
- **snake_case** pour les variables
- **Commentaires** en français

### Git workflow
1. Créer une branche feature : `git checkout -b feature/nouvelle-fonctionnalite`
2. Développer et committer : `git commit -m "feat: ajouter fonctionnalité X"`
3. Pusher la branche : `git push origin feature/nouvelle-fonctionnalite`
4. Créer une Pull Request
5. Review et merge

## 🤝 Collaboration Backend/Frontend

Ce projet est divisé entre deux équipes/repositories :

### Backend (Ce Repository)
- **Développement** : API Laravel + Services IA
- **Responsabilité** : Endpoints API, logique métier, authentification
- **CI/CD** : Tests automatiques, qualité de code, build Docker
- **Déploiement** : API sur serveur de production

### Frontend (Repository Séparé)
- **Développement** : Application React
- **Responsabilité** : Interface utilisateur, formulaires, intégration API
- **Dépendance** : L'URL de l'API backend
- **Communication** : HTTP requests vers les endpoints documentés

### Points de Coordination
✅ Documentation des endpoints API à jour
✅ Versions compatibles de Node/React et PHP/Laravel
✅ CORS configuré correctement
✅ Tokens Sanctum fonctionnels
✅ Versioning d'API (ex: `/api/v1/` pour futures versions)

## 🚀 Pipeline CI/CD

Le pipeline GitHub Actions est configuré pour :

1. **Linting** : Code style avec PHP CS Fixer
2. **Static Analysis** : PHPStan pour la vérification des types
3. **Security** : Audit des dépendances Composer
4. **Tests** : PHPUnit avec MySQL de test
5. **Build Docker** : Construction multiarch (amd64, arm64)

**Déclenché sur** :
- Push sur `main` ou `develop`
- Pull requests

**Artefacts** :
- Image Docker publiée sur GitHub Container Registry

## 🐳 Docker

### Dockerfile
```dockerfile
FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

# Install dependencies
RUN apk add --no-cache \
    libzip-dev \
    zip \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    intl-dev \
    exif-dev

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_mysql \
    zip \
    gd \
    mbstring \
    opcache \
    bcmath \
    intl \
    exif

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application
COPY --chown=www-data:www-data . /var/www/html

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate application key
RUN php artisan key:generate --force

# Set permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000

CMD ["php-fpm"]
```

### docker-compose.yml
```yaml
version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    container_name: gestionnaire_cv_app
    restart: unless-stopped
    working_dir: /var/www/html
    volumes:
      - ./:/var/www/html
    ports:
      - "8000:8000"
    environment:
      - APP_NAME="Gestionnaire Intelligent de CV"
      - APP_ENV=local
      - DB_CONNECTION=mysql
      - DB_HOST=db
      - DB_DATABASE=gestion_cv
      - DB_USERNAME=root
      - DB_PASSWORD=secret_password
      - OPENAI_API_KEY=your_openai_api_key_here
    depends_on:
      - db
    command: php artisan serve --host=0.0.0.0 --port=8000

  db:
    image: mysql:8.0
    container_name: gestionnaire_cv_db
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: gestion_cv
      MYSQL_USER: gestion_user
      MYSQL_PASSWORD: secret_password
      MYSQL_ROOT_PASSWORD: secret_password
    volumes:
      - db_data:/var/lib/mysql
    ports:
      - "3306:3306"

volumes:
  db_data:
    driver: local
```

## 🔄 CI/CD

### GitHub Actions
Le projet inclut un pipeline GitHub Actions pour :
- **Tests automatisés** à chaque push
- **Analyse de code** avec PHPStan
- **Linting** avec PHP CS Fixer
- **Build Docker** pour validation
- **Déploiement** automatique en production

### Workflow
```yaml
name: CI/CD Pipeline

on:
  push:
    branches: [ main, develop ]
  pull_request:
    branches: [ main ]

jobs:
  test:
    runs-on: ubuntu-latest
    
    steps:
    - name: Checkout code
      uses: actions/checkout@v4
      
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.2'
        extensions: mbstring, xml, mysql, bcmath, gd, zip, intl, exif
        coverage: xdebug
        
    - name: Install dependencies
      run: composer install --no-progress --prefer-dist
      
    - name: Execute tests
      run: vendor/bin/phpunit --coverage-text --coverage-clover=coverage.xml
      
    - name: Upload coverage to Codecov
      uses: codecov/codecov-action@v3
      with:
        file: ./coverage.xml
        fail_ci_if_error: true
```

## 🔒 Sécurité

### Mesures implémentées
- **Authentification par tokens** (Laravel Sanctum)
- **Hashage des mots de passe** (bcrypt)
- **Validation des entrées** (FormRequests)
- **Protection CSRF** (middleware)
- **CORS configuré**
- **Rate limiting** sur les endpoints sensibles

### Bonnes pratiques
- **Ne jamais committer** de données sensibles
- **Utiliser les variables d'environnement**
- **Mettre à jour régulièrement** les dépendances
- **Surveiller les logs** d'erreurs

## 📊 Monitoring

### Logs
- **Application logs** : `storage/logs/laravel.log`
- **Database logs** : MySQL slow query log
- **Access logs** : Nginx/Apache logs

### Métriques
- **Performance** : temps de réponse des API
- **Disponibilité** : uptime monitoring
- **Erreurs** : taux d'erreur par endpoint

## 🤝 Contribuer

### Comment contribuer
1. Forker le repository
2. Créer une branche feature
3. Développer la fonctionnalité
4. Ajouter des tests
5. Soumettre une Pull Request

### Issues
- Signaler les bugs avec des détails précis
- Proposer des améliorations avec des exemples
- Documenter les étapes pour reproduire

## 📄 Licence

Ce projet est sous licence MIT - voir le fichier [LICENSE](LICENSE) pour plus de détails.

## 👥 Auteurs

- **[Ayoub Faradi]** - *Développeur principal* - [GitHub](https://github.com/AyoubFaradi)

---

## 📞 Support

Pour toute question ou suggestion :
- **Email** : ayoubfaradi05@gmail.com
- **GitHub Issues** : [Issues](https://github.com/AyoubFaradi/gestionnaire-cv-ai/issues)
- **Documentation** : [Wiki](https://github.com/AyoubFaradi/gestionnaire-cv-ai/wiki)

---

**Merci d'utiliser le Gestionnaire Intelligent de CV avec IA !** 🚀
