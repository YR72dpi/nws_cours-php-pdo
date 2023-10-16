[< Retour](../README.md)
# Problème 5️⃣

Grace à une class PHP :
- Connecter vous à une base
- Supprimer une ligne de votre table

de cette manière

```php
require_once("./Lib/PDOManagerClass.php");
$pdo = new PDOManagerClass("nws_courspdo");
$pdo->delete(
    "ordinateur", 
    1
);
```

La __methode__ prend en paramètre : 
1. une __chaîne de caractère__ correspondant au nom de la __table__
2. une __entier__ correspondant à l'ID de la ligne à supprimer

Elle __return__ un __boolean__

[Solution](./Solutions/5%20-%20Delete_solution.md)