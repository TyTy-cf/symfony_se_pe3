
### Translsations

#### Activer les traductions

```yaml
framework:
    default_locale: fr
    translator:
        default_path: '%kernel.project_dir%/translations'
        fallbacks:
            - fr
```

- default_locale : la langue par défaut du site (ici FR)
- fallbacks : la langue à choisir si la langue par défaut n'est pas "accessible"

#### Déclarer une traduction

Dans le dossier définit par le **default_path** (translations), créer un fichier portant le nom : **messages.CODE_LANGUE.yaml**

Il s'agit d'un simple yaml en mode clé/valeur

```yaml
home:
  title: 'SteamIsh'
```

#### Utiliser une traduction

Et afin d'afficher la valeur 'SteamIsh' dans le code HTML, il faut passer par le filtre twig **|trans** :

```html
{{ 'home.title'|trans }}
```

#### Utiliser une traduction avec paramètre

```yaml
home:
  comment:
    writted_by: 'Par %name%'
```

On utilise les % pour déclarer un alias qui sera remplacé par le paramètre, ici l'alias est name

Afin de l'utiliser dans le twig/html, on ajoutera les parenthèses puis des accolades avec l'alias déclaré dans le fichier de traduction.

```html
{{ 'home.menu.comment.writted_by'|trans(
    {
        '%name%': comment.account.name,
    }
) }}
```
