# Configuration Docker

Ce répertoire contient les fichiers de configuration Docker pour le projet.

## Structure

```
docker/
├── nginx/
│   └── nginx.conf       # Configuration du serveur web Nginx
├── php/
│   ├── php.ini          # Configuration PHP personnalisée
│   └── opcache.ini      # Configuration OPcache pour la performance
└── certbot/             # Certificats Let's Encrypt (production)
    ├── conf/
    └── www/
```

## Fichiers de Configuration

### docker/nginx/nginx.conf
Configuration du serveur web Nginx incluant :
- Proxy vers PHP-FPM
- Compression Gzip
- Headers de sécurité
- Mise en cache des assets statiques
- Configuration de performance

### docker/php/php.ini
Configuration PHP personnalisée pour Laravel :
- Memory limit (256M)
- Upload max filesize (100M)
- Post max size (100M)
- Date timezone (UTC)
- Error reporting

### docker/php/opcache.ini
Configuration OPcache pour la performance :
- JIT compilation (PHP 8+)
- Cache des fichiers compilés
- Optimisation des strings interned
- File cache pour les systèmes distribués

## Services Docker

### app (Laravel)
- Image : php:8.2-fpm-alpine
- Port : 9000 (interne, exposé via Nginx)
- Volume : Code applicatif
- Healthcheck : Via socket FPM

### db (MySQL)
- Image : mysql:8.0
- Port : 3306
- Volume : Données persistantes (db_data)
- Healthcheck : mysqladmin ping

### redis (Cache)
- Image : redis:7-alpine
- Port : 6379
- Volume : Données persistantes (redis_data)
- Options : AOF (Append-Only File) habilitée

### nginx (Web Server)
- Image : nginx:alpine
- Ports : 80 (HTTP), 443 (HTTPS production)
- Volumes : Configuration + code applicatif
- Accès : http://localhost ou https://votre-domaine.com

## Variables d'Environnement

Voir le fichier [.env.example](../.env.example) pour la liste complète.

### Outils Utiles

```bash
# Voir les logs en temps réel
docker-compose logs -f

# Accéder au shell
docker-compose exec app sh

# Exécuter une commande
docker-compose exec app php artisan migrate

# Arrêter et supprimer
docker-compose down -v
```

## Performance

Pour optimiser la performance en production :

1. **OPcache JIT** : Activé par défaut dans opcache.ini
2. **Redis** : Utilisé pour le cache et les sessions
3. **Nginx** : Proxy inverse avec mise en cache
4. **Compression Gzip** : Headers compressés automatiquement

## Sécurité

- Permissions d'utilisateur restrictives (www-data)
- Secrets dans variables d'environnement
- HTTPS/TLS en production
- Headers de sécurité configurés dans Nginx
