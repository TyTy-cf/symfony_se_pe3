
### Routing 'avancé'

```php
#[Route('/editeur')]
class PublisherController extends AbstractController
{
```

En mettant une route sur un Controller, on indique qu'obligatoirement toutes ses routes commenceront par cette route.
Ici, il s'agit de '/editeur'


#### Passer des paramètres à une route


```html
<a class="text-decoration-none" href="{{ path('app_publisher_show', {'slug': publisher.slug}) }}">
    {{ publisher.name }}
</a>
```

On utilise toujours la fonction **path** de twig avec le nom de la route vers laquelle on souhaite aller, et on ajoute les paramètres de celle-ci, ici il n'y a que "slug"


#### Solution 1 : "conversion automatique de paramètres"

```php
#[Route('/{slug}', name: 'app_publisher_show')]
public function show(string $slug): Response
{
```

Il faut que le nom du paramètre de votre route soit identique à la chaîne de caractères en paramètre de votre fonction, ici c'est {slug} et $slug


#### Solution 2 : Récupération via la Request

/!\ il faut bien penser à prendre celle de Symfony Foundation :

```php
use Symfony\Component\HttpFoundation\Request;
```

```php
#[Route('/{slug}', name: 'app_publisher_show')]
public function show(Request $request): Response
{
    dd($request->get('slug'));
```

Cette fois on vient appeler la request de Symfony, et on récupère le paramètre via sa clé ici c'est "slug"


#### Solution 3 : "conversion automatique de paramètres" 2.0


```php
#[Route('/{slug}', name: 'app_publisher_show')]
public function show(Publisher $publisher): Response
{
```

Ici, on va laisser Symfony nous convertir notre paramètre directement en objet.

Comment cette magie fonctionne ?

Symfony va interpréter l'entité en paramètre de la fonction (ici Publisher), il va lancer une requête **findBy**, en assumant que le paramètre de la route "slug" est bien une propriété de l'entité en question.

Ainsi, si vous regardez le profiler, Symfony a effectué une requête en base de données sur la table correspondante à l'entité passée en paramètre, et dont le champ dont le nom est celui du paramètre de la route est égale à la valeur du paramètre de la route.

Pour l'exemple, on arrive là (assumant ? = valeur du paramètre de la route)

```sql
SELECT *
FROM publisher
WHERE slug = ? 
```