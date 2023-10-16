[< Retour](../README.md)
# Problème 2️⃣

Grace à une class PHP :
- Connecter vous à une base
- Récupérer tout les données d'une table 

de cette manière :
```php
require_once("./Lib/PDOManagerClass.php");
$pdo = new PDOManagerClass("nws_courspdo");
var_dump($pdo->findAll("ordinateur"))
```


La __methode__ prend en paramètre une __chaîne de caractère__ correspondant au nom de la __table__.

Elle __return__ un __tableau__

[Solution](./Solutions/2%20-%20FindAll_solution.md)