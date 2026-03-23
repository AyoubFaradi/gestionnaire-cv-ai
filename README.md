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
- **Base de données** : MySQL 8.0+ (production)
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

1. **Créer le fichier .env**
   ```bash
   cp .env.example .env
   ```

2. **Construire et démarrer les conteneurs**
   ```bash
   git clone https://github.com/AyoubFaradi/gestionnaire-cv-ai.git
   cd gestionnaire-cv-ai
   docker-compose up --build -d
   ```

3. **Exécuter les migrations**
   ```bash
   docker-compose exec app php artisan migrate --force
   ```

4. **Charger les données de test (optionnel)**
   ```bash
   docker-compose exec app php artisan db:seed
   ```

5. **Accéder à l'application**
   - URL : http://localhost
   - API : http://localhost/api
   - Compte de test : jean.dupont@example.com / password123

> **Note** : Vous pouvez utiliser le script setup.sh pour automiser ce processus :
> ```bash
> chmod +x setup.sh
> ./setup.sh
> ```

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
# ========== Application ==========
APP_NAME="Gestionnaire Intelligent de CV"
APP_ENV=local                           # production, local, testing
APP_KEY=                                 # Généré par: php artisan key:generate
APP_DEBUG=true                           # false en production
APP_URL=http://localhost:8000

# ========== Database ==========
DB_CONNECTION=mysql                      # mysql, sqlite
DB_HOST=127.0.0.1                       # db pour Docker
DB_PORT=3306
DB_DATABASE=gestion_cv
DB_USERNAME=root
DB_PASSWORD=

# ========== Cache ==========
CACHE_DRIVER=redis                       # redis, file, array
CACHE_PREFIX=${APP_NAME}_cache:

# ========== Session ==========
SESSION_DRIVER=cookie                    # cookie, database, redis
SESSION_LIFETIME=120

# ========== Queue ==========
QUEUE_CONNECTION=sync                    # sync, database, redis
QUEUE_TIMEOUT=90

# ========== Redis ==========
REDIS_HOST=127.0.0.1                    # redis pour Docker
REDIS_PASSWORD=null
REDIS_PORT=6379

# ========== Services IA ==========
OPENAI_API_KEY=sk-...                   # Clé API OpenAI
OPENAI_MODEL=gpt-3.5-turbo
OPENAI_ORG_ID=                          # Optionnel

# ========== Mail (optionnel) ==========
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="${APP_NAME}"

# ========== Authentication ==========
SANCTUM_STATEFUL_DOMAINS=localhost,localhost:3000
SANCTUM_TOKEN_EXPIRATION=60

# ========== CORS ==========
FRONTEND_URL=http://localhost:3000

# ========== Logging ==========
LOG_CHANNEL=stack
LOG_LEVEL=debug
```

### Configuration fichier .env.example

Un fichier [.env.example](.env.example) complet est fourni avec les variables essentielles et leurs valeurs par défaut.

## 🧪 Tests

### Exécuter les tests unitaires
```bash
php artisan test
```

### Tests avec collecte de couverture
```bash
vendor/bin/phpunit --coverage-text --coverage-html=coverage
```

### Analyse de code statique
```bash
# PHPStan pour la détection des bugs
vendor/bin/phpstan analyse

# PHP CS Fixer pour la cohérence du style
vendor/bin/php-cs-fixer fix --dry-run
```

### Vérification de sécurité
```bash
vendor/bin/security-checker security:check
```

## 🔍 Dépannage

### Erreurs courantes

**1. Erreur de clé d'application**
```bash
php artisan key:generate
```

**2. Permissions de dossier (Linux/Mac)**
```bash
chmod -R 755 storage bootstrap/cache
chown -R $USER:$USER storage bootstrap/cache
```

**3. Erreur de migration
```bash
# Reset complète de la base de données
php artisan migrate:refresh --seed
```

**4. Cache à nettoyer
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
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

## 🐳 Docker et Docker Compose

### Configuration avec Docker Compose

Le projet inclut un `docker-compose.yml` complet avec les services suivants :
- **app** : Application Laravel avec PHP-FPM
- **db** : MySQL 8.0
- **redis** : Cache Laravel
- **nginx** : Serveur web

### Prérequis Docker
- Docker Engine 20.10+
- Docker Compose 2.0+

### Démarrage rapide

1. **Créer le fichier .env depuis .env.example**
   ```bash
   cp .env.example .env
   ```

2. **Construire et démarrer les conteneurs**
   ```bash
   docker-compose up --build -d
   ```

3. **Exécuter les migrations**
   ```bash
   docker-compose exec app php artisan migrate --force
   ```

4. **Charger les données de test (optionnel)**
   ```bash
   docker-compose exec app php artisan db:seed
   ```

5. **Accéder à l'application**
   - URL : http://localhost
   - API : http://localhost/api
   - MySQL : localhost:3306
   - Redis : localhost:6379

### Commandes utiles

```bash
# Arrêter les conteneurs
docker-compose down

# Supprimer tous les volumes (ATTENTION : supprime les données)
docker-compose down -v

# Voir les logs
docker-compose logs -f app

# Exécuter une commande
docker-compose exec app php artisan migrate

# Accéder au shell du conteneur
docker-compose exec app sh
```

### Variables d'environnement pour Docker

Le fichier `.env` doit contenir :
```bash
# Application running inside Docker
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Database (doit correspondre à docker-compose.yml)
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=gestion_cv
DB_USERNAME=gestion_user
DB_PASSWORD=secret_password

# Redis (doit correspondre à docker-compose.yml)
CACHE_DRIVER=redis
REDIS_HOST=redis
REDIS_PORT=6379

# Services IA
OPENAI_API_KEY=votre_cle_openai
```

### Permissions utilisateur

Si vous rencontrez des problèmes de permissions :
```bash
# Exécuter comme utilisateur www-data dans le conteneur
docker-compose exec -u www-data app php artisan migrate
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
