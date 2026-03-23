# Politique de Sécurité

## Signaler une Vulnérabilité

Si vous découvrez une vulnérabilité de sécurité, veuillez **ne pas** la signaler via les issues publiques. À la place, veuillez envoyer un email à :

📧 **ayoubfaradi05@gmail.com**

Incluez :
- Description détaillée de la vulnérabilité
- Les étapes pour la reproduire
- Impact potentiel
- Approches de correction suggérées (le cas échéant)

Nous vous répondrons dans les **48 heures** et travaillerons avec vous pour :
1. Confirmer le problème
2. Déterminer la portée
3. Développer et tester un correctif
4. Coordonner la divulgation

## Mesures de Sécurité Implémentées

### Authentification & Autorisation
- ✅ **Laravel Sanctum** pour l'authentification par tokens API
- ✅ **Bcrypt** pour le hashage des mots de passe
- ✅ **Rate limiting** sur les endpoints sensibles
- ✅ **Middleware d'authentification** sur les routes protégées

### Validation des Données
- ✅ **FormRequests** pour la validation côté serveur
- ✅ **Validation côté client** JavaScript
- ✅ **Escape des données** avant l'affichage
- ✅ **Type hints** PHP 8.2+ pour la sécurité des types

### Protection CSRF
- ✅ **Tokens CSRF** sur tous les formulaires
- ✅ **Middleware CSRF** activé par défaut
- ✅ **HTTP-only cookies** pour les sessions

### CORS
- ✅ **Configuration CORS** stricte
- ✅ **Whitelist de domaines** configurée
- ✅ **Restrictions de méthodes HTTP**

### Chiffrement
- ✅ **HTTPS/TLS** obligatoire en production
- ✅ **Encryption des données sensibles** en base de données
- ✅ **Variables d'environnement** pour les clés secrètes

### Dépendances
- ✅ **Mises à jour régulières** des dépendances
- ✅ **Vérification de sécurité** dans le pipeline CI/CD
- ✅ **Vulnerability scanning** automatique

### Logging & Monitoring
- ✅ **Logs structurés** de toutes les actions sensibles
- ✅ **Monitoring d'erreurs** en production
- ✅ **Alertes** pour les comportements suspects

### Infrastructure
- ✅ **Docker** pour l'isolation des services
- ✅ **Permissions d'utilisateur** restrictives (www-data)
- ✅ **Fichiers sensibles** hors du répertoire public
- ✅ **Backup réguliers** de la base de données

## Bonnes Pratiques pour les Contributeurs

1. **Ne jamais** committer :
   - Clés API et tokens
   - Mots de passe
   - Informations personnelles
   - Fichiers .env

2. **Utiliser toujours** :
   - Variables d'environnement pour les données sensibles
   - Validation des entrées utilisateur
   - Préparation des requêtes SQL (prevent SQL injection)
   - Sanitization des entrées HTML

3. **Tester régulièrement** :
   - Analyser le code avec PHPStan
   - Vérifier les vulnérabilités avec security-checker
   - Exécuter les tests unitaires
   - Faire des tests de pénétration

4. **Documenter** :
   - Les changements de sécurité importants
   - Les configurations sensibles requises
   - Les points d'entrée d'authentification

## Compliance

Ce projet vise la conformité avec :
- 📋 **RGPD** - Protection des données personnelles
- 🔒 **OWASP Top 10** - Prévention des vulnérabilités courantes
- 🛡️ **CWE** - Ennemis de sécurité logicielle courants

## Versioning

Nous suivons **Semantic Versioning** :
- **MAJOR** : Changements incompatibles (incluant les correctifs de sécurité majeurs)
- **MINOR** : Nouvelles fonctionnalités (backward-compatible)
- **PATCH** : Correctifs de bugs et sécurité

## Support des Versions

| Version | Support | Sécurité |
|---------|---------|----------|
| 1.x     | 🟢 Actif | ✅ Oui   |
| 0.x     | 🔴 Fin  | ⚠️ Limité |

## Ressources

- [OWASP Top 10](https://owasp.org/Top10/)
- [Laravel Security](https://laravel.com/docs/security)
- [PHP Security](https://www.php.net/manual/en/security.php)
- [CWE/SANS Top 25](https://cwe.mitre.org/top25/)

---

**Merci de contribuer à la sécurité de ce projet ! 🙏**
