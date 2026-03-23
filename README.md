# Gestionnaire Intelligent de CV avec IA

Une application web moderne qui aide les étudiants et jeunes diplômés à créer, gérer et optimiser leurs candidatures grâce à l'intelligence artificielle.

## 🎯 Objectifs

- **Gestion complète du profil professionnel** : expériences, formations, compétences
- **Génération intelligente de documents** : CV, lettres de motivation, emails
- **Adaptation personnalisée** : contenu optimisé selon les offres d'emploi
- **Interface moderne** : expérience utilisateur intuitive et responsive
- **Sécurité** : protection des données personnelles

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

### Backend
- **Framework** : Laravel 12
- **PHP** : 8.2+
- **Base de données** : SQLite (dev) / MySQL (prod)
- **Authentification** : Laravel Sanctum
- **API** : RESTful architecture

### Frontend
- **HTML5** : Sémantique moderne
- **CSS3** : TailwindCSS pour le design
- **JavaScript** : Vanilla JS (compatibilité maximale)
- **Responsive** : Mobile-first approach

### IA & Services
- **LLM** : OpenAI GPT-3.5-turbo
- **HTTP Client** : Laravel HTTP Client
- **Prompts optimisés** : templates structurés

### DevOps
- **Conteneurisation** : Docker + Docker Compose
- **CI/CD** : GitHub Actions
- **Version control** : Git

## 📦 Installation

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

7. **Démarrer le serveur**
   ```bash
   php artisan serve
   ```

8. **Accéder à l'application**
   - URL : http://127.0.0.1:8000
   - Compte de test : jean.dupont@example.com / password123

### Installation avec Docker

1. **Cloner et construire**
   ```bash
   git clone https://github.com/votre-username/gestionnaire-cv-ia.git
   cd gestionnaire-cv-ia
   docker-compose up --build
   ```

2. **Accéder à l'application**
   - URL : http://localhost:8000

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

### Variables d'environnement

```bash
# Application
APP_NAME="Gestionnaire Intelligent de CV"
APP_ENV=local
APP_KEY=base64:votre_cle_application
APP_DEBUG=true
APP_URL=http://localhost:8000

# Base de données
DB_CONNECTION=sqlite  # ou mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_cv
DB_USERNAME=root
DB_PASSWORD=

# Services IA
OPENAI_API_KEY=votre_cle_openai

# Mail (optionnel)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre_email@gmail.com
MAIL_PASSWORD=votre_password_app
```

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

### Structure du projet
```
├── app/
│   ├── Http/Controllers/Api/    # Contrôleurs API
│   ├── Models/                  # Modèles Eloquent
│   ├── Services/AI/              # Services IA
│   └── Http/Requests/          # FormRequests
├── database/
│   ├── migrations/             # Migrations de BDD
│   └── seeders/              # Données de test
├── routes/
│   ├── api.php               # Routes API
│   └── web.php               # Routes web
├── resources/views/           # Vues Blade
├── public/                  # Assets publics
└── tests/                   # Tests unitaires
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
