
### Exercices formulaire

#### 1. Faire un formulaire d'inscription

Permettre à un utilisateur de s'inscrire sur votre site (SteamIsh), on demandera tous les champs, sauf 'wallet' qui doit rester à 0.

Vous devrez faire un joli bouton en haut à droite ui redirigera l'utilisateur sur la page de création de compte.

A sa soumission, l'utilisateur sera redirigé sur la page d'accueil.

#### 2. Faire un crud pour les Account

- Faire une page d'index qui affiche tous les account
- Et un bouton de crayon qui redigiera l'utilisateur sur une page de modification de son profil

#### 3. Faire la SearchBar

On ne recherche que les Jeux !!!

- Faire un formulaire Symfony SearchBar (lié à aucune entité)
- Il aura un input text du nom de votre choix, et ce champ n'est pas obligatoire !!!!!! (corespondant à un nom de jeu)
- Un bouton avec seulement une icone de loupe
- Lorsque l'on validera le form :
  - Si le champ est vide, on envoie l'utilisateur sur **/jeux**
  - Si le champ n'est pas vide, on effectuera une requête vers la base de donnée (Game), requête de type LIKE sur l'attribut name de Game
    - La requête a ramené 1 résultat : on va directement sur la page de détail du jeu en question
    - La requête a ramené 0 résultat : on va sur **/jeux**
    - La requête a ramené 2 ou + résultats, on va sur une nouvelle route de nom **/jeux/recherche/{valeurRecherche}** et on affichera les cards des jeux en question
