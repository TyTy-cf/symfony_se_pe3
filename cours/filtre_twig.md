
### Créer un filtre twig

Passer la commande suivante :

```
symfony console make:twig-extension
```

Un dossier (s'il n'existait pas) a été créé : "Twig"

Le prompt de la console vous demande un nom de filtre à créer, puis votre classe se trouve à l'intérieur de ce dossier, suffixée par Extension.

A l'intérieur de celle-ci, il y a une méthode par défaut :

```php
public function getFilters(): array
{
    return [
        new TwigFilter('time_to_string', [$this, 'timeToString']),
    ];
}
```

La méthode getFilters, renvoie un tableau, des différentes filtres gérés par cette classe.
Les paramètres du type TwigFilter sont :
    - Le nom du filtre twig à utiliser dans l'html/twig
    - La fonction qui sera appelée lors de l'exécution du filtre

Ainsi, dans votre classe de filtre twig, vous devez avoir une fonction de nom "timeToString" :

```php
public function timeToString(int $gameTime): string
{
    return $this->timeConverterService->convertTimeToString($gameTime);
}
```

Le paramètre de cette fonction est un entier, cela signifie que vous devrez utiliser ce filtre twig sur une **ariable/attributs de type entier !**

Ainsi dans l'html vous utilisez votre filtre de cette manière :

```html
<p class="text-center">
    {{ account.totalGameTime|time_to_string }}
</p>
```

Si totalGameTime est de type int, alors le filtre s'appliquera, sinon une erreur sera renvoyée.


