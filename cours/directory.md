
### Paramètre de template twig

On peut appeler un template twig dans un autre, via un {% include %}.

Mais on peut aussi leur faire passer des paramètres afin de dynamiser encore plus nos pages et ce sans dupliquer du code.

```php
{% include 'game/_game_loop.html.twig' with
{
    'games': lastPublishedGames,
}
%}
```

Afin de passaer des paramètres à un template, on utiliser le mot-clef **with** puis entre accolades on passe les variables