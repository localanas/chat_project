# Application T'Chat
J'ai réalisé un  T’chat simple , construit sous un modèle MVC avec autre  design pattern Singleton(Object PDO charge une seul fois).
pour la construction de mon mini-framework php from scratch.

## notes et le  resumer de mon travail
pendant la création de mon mini-Framework j'étais baser sur ce tutorial https://bpesquet.developpez.com/tutoriels/php/evoluer-architecture-mvc/?fbclid=IwAR2RsmsLO7DeuP3lmPzi3Kijr0aLxl6GQDGGdKLnWW3DLbUyr0OaDrwtXD4 ,mais ce tutorial utilise les require_once pour autoloader les class , j'ai changer ce principe de  require_once par namespeace pour respecter les bonnes pratiques moderne
et autoload les class depuis namespeace a l'aide de composer c'est beaucoup organiser que les require_once.

-j'étais baser sur la strcuture Symfony: -fichier configuration .env -dossier des vue template - namespace App\\ -index.php ....
-j'ai Respecte  les norms de clean code SOLID et j'utilise PSr-0 2 écriture de code, et  de Psr-4 pour  autoloading + nameSpeace via composer .
-J'utiliser les nouvelles ecriture des condition  de php comme  (: ? ) a la place de else .
-J'utilise deux design pattern MVC(model view controller ) et Singleton (une seul instance principe de LazyLoding exemple object Pdo).
-J'utiliser les principe de l'interface pour faire un contrat obligatoire entre les class et leurs interface pour ne pas
 endommager l'application s'il n'a pas une fonction exist signale un error depuis le IDE ou dans l runtime d'application, pour résoudre ce probléme il fallait l'implementation des ses functions et pour respecter le principe de l' injecter l'interface pour construire une application facile a maintenir et extensible.
-J'Utilise une layout comme une master page(gabarit) pour réutilise le header et footer sur toutes les vues de l'application .
-Chat réalisé avec PHP, HTML5, CSS3, Bootstrap3, Jquery ajax pour les requettes Http et Xumpp serveur.

## Installation

1 - Copier le project dans www/  si vous avez wamp 
  -Copier le project dans htdocs/  si vous avez Xumpp : 
```bash
git clone https://github.com/localanas/chat_project.git
```
La racine du projet est ```/chat_project/``` configurable dans : ```chat_project/.env``` .

2 - Importer la base de données:

Le fichier est dans la racine du projet : ```chat_project/chat_project_db.sql``` .
Le nom de la bd est ```chat_project_db``` .
La configuration de la bd est dans le fichier : ```chat_project/.env``` .

## Usage

1 - Pour utiliser l'app, allez sur ```localhost/chat_project```, voici les logins :
La page de login : ```http://localhost/chat_project/authentication/``` .
 
 ```user 1 = anas, password = anas``` 
 ```user 1 = imane, password = anas``` 
 ```user 1 = fatima, password = anas``` 
  ```user 1 = morad, password = anas``` 

2 - Après avoir être connecté, vous serez dirigé sur la page qui contient ```la liste des utilisateurs en indiquant ceux qui sont en ligne```. 

Pour discuter avec un utilisateur cliquez sur son nom vous serez dirigé sur la page de T'Chat qui contient ```l'historique de discusion  avec cet utilisateur```  , et ```la possibilité de dialoguer avec lui``` .
Pour l'affichage ‘temps réel’ j'ai utiliser AJAX qui se base sur biblio Jquiry.

3 - Sécurité des données

Pour les injections SQL , j'ai  utilisé des requêtes paramétrées.
Pour securisé les urls les action de controller , j 'ai utilise le principe de front controller une seul entrer pour  l'application 
Pour sécuriser l'acces a des pages par url j'ai basé sur les sessions par exemple : s'il exist session user il a le droit d'acces sur la page home par contre il ne peut pas entrer a la page authentification car il est déja connecter, de méme facon pour l'autre cas s' il n'est pas connecter il n'a pas l'accés a la page home, mais il peut accéder a la page de authentifacation .
Pour l'injection de code sur la page Web (cross-site scripting) j'ai  utilisé la fonction php  ```htmlspecialchars``` pour tout paramètre GET ou POST
Pour les mots de passe j'ai  utilisé la fonction  ```password_hash('$password', PASSWORD_DEFAULT)```pour crypter le mot de passe et le hasher.
