# Guide de Déploiement - Gestionnaire Intelligent de CV

## 📋 Prérequis

- Serveur Linux (Ubuntu 20.04+ recommandé)
- Docker & Docker Compose installés
- Détails d'accès SSH
- Domaine avec DNS configuré
- Certificat SSL (optionnel, mais recommandé)

## 🚀 Déploiement en Production

### 1. Configuration des secrets GitHub

Pour activer le déploiement automatique, configurez ces secrets dans GitHub :

```
DEPLOY_HOST         = votre-domaine.com
DEPLOY_USER         = deploy_user
DEPLOY_KEY          = [contenu de votre clé SSH privée]
DOCKERHUB_USERNAME  = votre-username
DOCKERHUB_TOKEN     = votre-access-token
```

### 2. Configuration du serveur

#### Préparation du système
```bash
# Mettre à jour les packages
sudo apt update && sudo apt upgrade -y

# Installer Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh

# Installer Docker Compose
sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose

# Créer l'utilisateur de déploiement
sudo useradd -m -s /bin/bash deploy
sudo usermod -aG docker deploy
```

#### Configuration du projet
```bash
# Se connecter en tant qu'utilisateur deploy
su - deploy

# Cloner le repository
cd ~
git clone https://github.com/AyoubFaradi/gestionnaire-cv-ai.git
cd gestionnaire-cv-ai

# Créer le fichier .env de production
cp .env.example .env

# Éditer .env pour la production
nano .env
# Modifications importantes:
# - APP_ENV=production
# - APP_DEBUG=false
# - DB_HOST, DB_USERNAME, DB_PASSWORD avec les infos réelles
# - OPENAI_API_KEY avec votre clé
# - APP_URL=https://votre-domaine.com
```

#### Créer les répertoires de données
```bash
mkdir -p storage/logs storage/app/public
chmod -R 755 storage bootstrap/cache
```

### 3. Configuration Docker Compose

Pour la production, modifier le fichier `docker-compose.yml` :

```yaml
# Ajouter un service certbot pour SSL
certbot:
  image: certbot/certbot
  volumes:
    - ./docker/certbot/conf:/etc/letsencrypt
    - ./docker/certbot/www:/var/www/certbot
  entrypoint: "/bin/sh -c 'trap exit TERM; while :; do certbot renew; sleep 12h & wait $!; done;'"

# Modifier nginx pour HTTPS
nginx:
  ports:
    - "80:80"
    - "443:443"
  volumes:
    - ./docker/certbot/conf:/etc/letsencrypt:ro
    - ./docker/certbot/www:/var/www/certbot:ro
```

### 4. Initialisation de la base de données

```bash
# Exécuter les migrations
docker-compose exec -T app php artisan migrate --force

# Optionnel : charger les données de seed
docker-compose exec -T app php artisan db:seed
```

### 5. Configuration Nginx avec SSL

Créer `docker/nginx/ssl.conf` :

```nginx
server {
    listen 80;
    server_name votre-domaine.com www.votre-domaine.com;
    
    location /.well-known/acme-challenge/ {
        root /var/www/certbot;
    }
    
    location / {
        return 301 https://$server_name$request_uri;
    }
}

server {
    listen 443 ssl http2;
    server_name votre-domaine.com www.votre-domaine.com;
    root /var/www/html/public;

    ssl_certificate /etc/letsencrypt/live/votre-domaine.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/votre-domaine.com/privkey.pem;
    
    # ... configuration nginx standard
}
```

### 6. Gestion des certificats SSL avec Let's Encrypt

```bash
# Obtenir un certificat initial
docker-compose run --rm certbot certonly --webroot \
  -w /var/www/certbot \
  -d votre-domaine.com \
  -d www.votre-domaine.com \
  --agree-tos \
  -m your-email@example.com

# Le renouvellement automatique se fera via le service certbot
```

### 7. Configuration du déploiement continu

Créer un script de déploiement `deploy.sh` :

```bash
#!/bin/bash

set -e

echo "🚀 Déploiement en cours..."

# Mettre à jour le code
git pull origin main

# Créer une sauvegarde
docker-compose exec -T db mysqldump -u$DB_USERNAME -p$DB_PASSWORD $DB_DATABASE > backup_$(date +%Y%m%d_%H%M%S).sql

# Redémarrer les services
docker-compose down
docker-compose up -d --build

# Executer les migrations
docker-compose exec -T app php artisan migrate --force

# Nettoyer le cache
docker-compose exec -T app php artisan cache:clear
docker-compose exec -T app php artisan config:clear

echo "✅ Déploiement terminé!"
```

Rendre le script exécutable :
```bash
chmod +x deploy.sh
```

### 8. Monitoring et Logs

Vérifier les logs :
```bash
# Logs de l'application
docker-compose logs -f app

# Logs nginx
docker-compose logs -f nginx

# Logs mysql
docker-compose logs -f db

# Tous les logs
docker-compose logs -f
```

### 9. Backups automatiques

Créer un script de sauvegarde :

```bash
#!/bin/bash

BACKUP_DIR="/home/deploy/backups"
RETENTION_DAYS=30

mkdir -p $BACKUP_DIR

# Sauvegarder la base de données
docker-compose exec -T db mysqldump \
  -u$DB_USERNAME -p$DB_PASSWORD \
  $DB_DATABASE > $BACKUP_DIR/db_$(date +%Y%m%d_%H%M%S).sql

# Compresser la sauvegarde
gzip $BACKUP_DIR/db_*.sql

# Supprimer les anciennes sauvegardes
find $BACKUP_DIR -name "db_*.sql.gz" -mtime +$RETENTION_DAYS -delete

echo "✅ Sauvegarde complétée"
```

Ajouter à crontab :
```bash
crontab -e
# Ajouter la ligne :
# 0 3 * * * /home/deploy/backup.sh > /home/deploy/logs/backup.log 2>&1
```

## 🆘 Dépannage

### Application ne démarre pas
```bash
# Vérifier les erreurs
docker-compose logs app

# Vérifier la configuration
docker-compose exec app cat .env

# Régénérer la clé
docker-compose exec app php artisan key:generate --force
```

### Erreurs de base de données
```bash
# Vérifier la connexion
docker-compose exec app php artisan tinker
>>> DB::connection()->getPdo()

# Réinitialiser la base de données
docker-compose exec db mysql -u$DB_USERNAME -p$DB_PASSWORD -e "DROP DATABASE $DB_DATABASE; CREATE DATABASE $DB_DATABASE;"
docker-compose exec app php artisan migrate --force
```

### Problèmes de permissions
```bash
# Corriger les permissions
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
docker-compose exec app chmod -R 755 storage bootstrap/cache
```

## 📞 Support

Pour toute question : ayoubfaradi05@gmail.com
