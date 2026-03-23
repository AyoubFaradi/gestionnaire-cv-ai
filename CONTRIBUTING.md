# Guide de Contribution

Merci de vouloir contribuer au projet **Gestionnaire Intelligent de CV** ! 🎉

## Code de Conduite

Ce projet et tous ses participants sont régis par notre [Code de Conduite](CODE_OF_CONDUCT.md). En participant, vous acceptez d'adhérer à ces normes.

## Comment Contribuer

### Signaler un Bug 🐛

Avant de créer un rapport de bug, veuillez vérifier la [liste des issues](https://github.com/AyoubFaradi/gestionnaire-cv-ai/issues) pour éviter les doublons.

Quand vous signalez un bug, incluez :
- **Titre clair et descriptif**
- **Description détaillée** du comportement observé
- **Étapes précises** pour reproduire le problème
- **Comportement attendu** vs comportement réel
- **Captures d'écran ou logs** si applicables
- **Informations système** : OS, version PHP, navigateur
- **Contexte supplémentaire**

### Suggérer une Amélioration 💡

Les suggestions sont toujours les bienvenues ! Pour proposer une amélioration :

1. Utilisez un **titre clair et descriptif**
2. Fournissez une **description détaillée** de la suggestion
3. Expliquez le **contexte** et les **cas d'usage**
4. Listez les **alternatives** envisagées
5. Ajoutez des **captures d'écran** ou des **mockups** si pertinent

### Soumettre du Code

#### Prérequis
- Avoir forké le repository
- Configurer votre environnement local (voir [Installation](README.md#installation))
- Créer une branche pour votre fonctionnalité

#### Workflow Git

1. **Forker le repository**
   ```bash
   # Cliquer sur le bouton "Fork" sur GitHub
   ```

2. **Cloner votre fork**
   ```bash
   git clone https://github.com/votre-username/gestionnaire-cv-ai.git
   cd gestionnaire-cv-ai
   ```

3. **Ajouter le remote upstream**
   ```bash
   git remote add upstream https://github.com/AyoubFaradi/gestionnaire-cv-ai.git
   ```

4. **Créer une branche feature**
   ```bash
   git checkout -b feature/ma-fonctionnalite
   ```

5. **Faire vos modifications**
   - Respecter les conventions de code
   - Ajouter des tests pour les nouvelles fonctionnalités
   - Mettre à jour la documentation si nécessaire

6. **Tester votre code**
   ```bash
   # Exécuter les tests
   php artisan test
   
   # Vérifier le style de code
   vendor/bin/php-cs-fixer fix --dry-run
   
   # Analyse statique
   vendor/bin/phpstan analyse
   
   # Vérification de sécurité
   vendor/bin/security-checker security:check
   ```

7. **Commit avec des messages clairs**
   ```bash
   git commit -m "feat: ajouter nouvelle fonctionnalité X"
   ```

8. **Pousser vers votre fork**
   ```bash
   git push origin feature/ma-fonctionnalite
   ```

9. **Créer une Pull Request (PR)**
   - Cliquer sur "Compare & pull request"
   - Remplir le template de PR
   - Décrire les changements clairement

#### Conventions de Commit

Suivre le format **Conventional Commits** :

```
type(scope): sujet

description plus détaillée (optionnel)

Closes #123
```

**Types autorisés** :
- `feat` : Nouvelle fonctionnalité
- `fix` : Correction de bug
- `docs` : Documentation
- `style` : Formatage, pas de changement de code
- `refactor` : Refactorisation sans changement de fonctionnalité
- `perf` : Amélioration de performance
- `test` : Ajout ou modification de tests
- `chore` : Tâches de maintenance

**Exemples** :
```bash
git commit -m "feat(auth): ajouter authentification Google"
git commit -m "fix(cv-generation): corriger export PDF"
git commit -m "docs: mettre à jour README"
git commit -m "test(api): ajouter tests pour endpoint profil"
```

### Standards de Code

#### PHP/Laravel
- **PSR-12** pour le style de code
- **Noms significatifs** pour les classes et méthodes
- **Commentaires** en français pour clarifier la logique complexe
- **Type hints** pour tous les paramètres et retours
- **Docstring** pour les classes et méthodes publiques

Exemple :
```php
<?php

namespace App\Services;

use Illuminate\Support\Collection;

/**
 * Service de génération de CV
 * 
 * @package App\Services
 */
class CvGenerationService
{
    /**
     * Générer un CV à partir d'un profil
     *
     * @param int $profileId ID du profil
     * @param string $template Template du CV
     * @return string Contenu du CV généré
     * @throws \Exception
     */
    public function generate(int $profileId, string $template): string
    {
        // Implémentation
    }
}
```

#### JavaScript
- **Conventions Vue.js** si applicable
- **Camel case** pour les variables
- **Comments explicatifs** là où c'est complexe
- **Pas de console.log** en production

### Tests

Avant de soumettre votre PR, assurez-vous que :

1. ✅ Tous les tests passent
   ```bash
   php artisan test
   ```

2. ✅ La couverture est maintenue
   ```bash
   vendor/bin/phpunit --coverage-html=coverage
   ```

3. ✅ Aucun warning d'analyse statique
   ```bash
   vendor/bin/phpstan analyse
   ```

4. ✅ Le code respecte les standards
   ```bash
   vendor/bin/php-cs-fixer fix
   ```

### Documentation

- Mise à jour du [README.md](README.md) si changement majeur
- Documentation des nouveaux endpoints API
- Commentaires pour la logique complexe
- Exemples d'utilisation pour les nouvelles fonctionnalités

## Processus de Review

1. L'équipe examine le code pour :
   - Qualité du code
   - Cohérence avec le projet
   - Tests adéquats
   - Documentation complète
   - Aucun issue de sécurité

2. Vous pouvez recevoir des demandes de changements
3. Une fois approuvée, votre PR sera mergée

## Après votre Contribution

- Vous serez listés dans les [Contributeurs](README.md#contributeurs)
- Remerciements dans les releases notes
- Accès au serveur Discord privé des contributeurs (si applicable)

## Questions ?

- Ouvrez une [discussion GitHub](https://github.com/AyoubFaradi/gestionnaire-cv-ai/discussions)
- Contactez : ayoubfaradi05@gmail.com
- Discord : [Lien du serveur]

---

**Merci pour votre contribution !** 🙏
