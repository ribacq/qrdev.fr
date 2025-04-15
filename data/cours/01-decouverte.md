#!nav

# cours 01 - découverte

Pour tester et jouer avec le code directement dans votre navigateur, il est possible d'utiliser [Codepen](https://codepen.io/pen/).

## notions

<details markdown="1">
<summary>HTML : HyperText Markup Language</summary>

- balise HTML
  - en paire
  - seule (autofermante)
  - nom
  - contenu
- espaces dans le code et espaces affichés
  - balise `<br />`
- liens `<a>`
- notion de inline vs. block
  - `<span>` et `<div>`
- attributs
  - `id` et `class`
</details>

<details markdown="1">
<summary>CSS : Cascading Style Sheet</summary>

- sélecteur CSS
  - balise
  - class avec `.`
  - id avec `#`
- color
- background-color
- font-family
- font-size
- width, height
- margin, border, padding
</details>

## HTML

### les balises

HTML est le langage avec lequel on écrit la _structure_ et le _contenu_ d'une page web. Il précise l'ordre des éléments, lesquels sont à l'intérieur les uns des autres et comment.
Il ne précise rien de l'affichage. Un fichier `.html` seul sera par défaut affiché en noir sur fond blanc sans aucune décoration.

Le HTML s'écrit dans ce que l'on nomme des balises. Une balise peut fonctionner par paire, avec une ouvrante et une fermante, le contenu entre les deux.

<div class="two-columns">
<div markdown="1">
```html
<h1>titre de niveau 1</h1>

<p>
Un paragraphe.

Une ligne seule en dans le code, mais pas de retour à la ligne à l'affichage.
</p>
```
</div>
<div>
<h1>titre de niveau 1</h1>

<p>
Un paragraphe.

Une ligne seule dans le code, mais pas de retour à la ligne à l'affichage.
</p>
</div>
</div>

Les titres peuvent avoir jusqu'à 6 niveaux.
Le titre le plus important est `<h1>titre de niveau 1</h1>`, un `<h2>titre de niveau 2</h2>` est un sous-titre, puis on a `<h3>`, etc., jusqu'à `<h6>` pour le moindre.

Certaines balises HTML s'utilisent seules, c'est-à-dire sans contenu entre la balise ouvrante et la balise fermante, mais avec une balise unique. C'est le cas de `<br />` qui permet d'insérer un retour à la ligne dans un paragraphe.

```html
<p>
Notez le p seul entre les chevrons pour la balise ouvrante.
Notez le /p entre les chevrons pour la balise fermante.
</p>
```

Le positionnement du `/` est essentiel dans la balise fermante d'une paire.

<div class="two-columns">
<div markdown="1">
```html
<p>
une ligne<br/>une autre ligne.
</p>
```
</div>
<div>
<p>
une ligne<br/>une autre ligne
</p>
</div>
</div>

Dans `<br/>`, le `/` est à la fin !

### liens

Un lien vers une autre page s'écrit avec la balise `<a>`. Le contenu, entre ouvrante et fermante, est le texte affiché. L'URL doit être précisée dans ce qu'on appelle un _attribut_. L'attribut s'appelle ici `href`, on le précise dans la balise ouvrante avec sa valeur juste après un signe `=` et entourée de guillemets `"`. Concrètement :

<div class="two-columns">
<div markdown="1">
```html
<a href="https://qrdev.fr/">mon lien</a>
```
</div>
<div>
<a href="https://qrdev.fr/">mon lien</a>
</div>
</div>

### inline vs. block

De même que certaines balises vont par paires et que d'autres sont autofermantes, une autre distinction existe : la notion d'inline vs. block. Cela va principalement impacter l'affichage.

Une balise **inline**, ou « en ligne » en français, va se placer _à côté_ des autres balises inline. C'est le cas des liens `<a>`, qui sont dans le texte, sans retour à la ligne systématique.

Une balise **block** va se placer _en dessous_ de la balise précédente, que la précédente soit inline ou block d'ailleurs. C'est le cas des titres `<h1>` à `<h6>` ou des paragraphes `<p>`, qui créent forcément des retours à la ligne avant et après eux.

**Rigoureusement**, une balise inline doit toujours se trouver à l'intérieur d'un block. Par exemple, un lien dans un paragraphe.

Un block peut se trouver à l'intérieur d'un autre block, mais un block ne doit pas être dans une balise inline. On ne met pas un paragraphe dans un lien.

### attributs `id` et `class`

Outre l'attribut `href` précisant l'URL d'un lien, il en existe de nombreux autres, parmi lesquels `id` et `class`. Ces deux attributs peuvent se mettre sur n'importe quelle balise. Ils servent à donner un nom ou un identifiant à une balise donnée. À l'affichage cela ne change rien.

Points essentiels :

- un `id` ou une `class` s'écrit en minuscule, sans espaces, accents ou caractères spéciaux
- un `id` doit être unique dans la page : toutes les balises qui en ont un doivent en avoir un différent
- pour les `class`, pas de restrictions de nombre : plusieurs balises peuvent avoir la même `class`, et une seule balise peut même avoir plusieurs `class`.

<div class="two-columns">
<div markdown="1">
```html
<h1 id="titre-important" class="souligne">super titre incroyable</h1>

<h2 id="titre-bateau" class="souligne rouge">sous-titre bateau</h2>

<p>
    voici un lien :
    <a href="https://fr.wikipedia.org/" class="rouge">wikipedia</a>
</p>
```
</div>
<div>
<h1 id="titre-important" class="souligne" style="text-decoration: underline">super titre incroyable</h1>

<h2 id="titre-bateau" class="souligne rouge" style="text-decoration: underline; color: red">sous-titre bateau</h2>

<p>
    voici un lien :
    <a href="https://fr.wikipedia.org/" class="rouge" style="color: red">wikipedia</a>
</p>
</div>
</div>

## CSS

Pour mettre en forme son site, on utilise le langage CSS. La manière de l'écrire (sa syntaxe) se compose des éléments suivants :

<div class="two-columns">
<div markdown="1">
```html
<a href="https://vibes.lgbt/">Vibes</a>
```

```css
/* ceci est un commentaire, délimité par slash-étoile et étoile-slash.
 * il aide à la compréhension du code, mais n'est pas lu par la machine.
 * pratique pour prendre des notes !
 *
 * 'a' est le nom de la balise des liens.
 *
 * ce qui suit entre les accolades {} est donc appliqué à tous les liens de la page (un seul dans cet exemple).
 *
 * ensuite on écrit des lignes sous la forme
 *
 * propriété: valeur;
 */
a {
    color: white;
    background-color: black;
}
```
</div>
<div>
<a href="https://vibes.lgbt/" style="color:white; background-color:black">Vibes</a>
</div>
</div>

Comme _sélecteur_ CSS, on peut utiliser notamment :

- un nom de balise, comme `a`
- un `id` précédé par un dièse, comme `#titre-important` ou `#titre-bateau` de l'exemple plus haut
- une `class` précédée par un point, comme `.rouge`

```css
a {
    color: white; /* couleur du texte */
    background-color: black; /* couleur de fond */
}

#titre-important {
    font-size: 36px; /* taille de police en pixels */
}

.rouge {
    color: red;
}
```

Parmi les autres propriétés CSS usuelles on peut noter :

```css
#mon-block {
    width: 50%; /* largeur du block en % de la page */
    height: 300px; /* hauteur du block en pixels */
}

h1 {
    font-family: monospace; /* les titres niveau 1 en police à largeur fixe */
}
```

Les marges intérieures, extérieures, et la bordures se définissent respectivement par `padding`, `margin`, et `border`.

![CSS box model](/assets/img/css-box-model.png)
