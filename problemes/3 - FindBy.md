
[< Retour](../README.md)# Problème 3️⃣

Grace à une class PHP :
- Connecter vous à une base
- Récupérer tout les données selon un critère, dans un ordre choisie, d'une table 

de cette manière

```php
require_once("./Lib/PDOManagerClass.php");
$pdo = new PDOManagerClass("nws_courspdo");
var_dump($pdo->findBy(
    "ordinateur", 
    ["capacite_ram" => 16]
    ["id" => "DESC"]    
));
```

La __methode__ prend en paramètre : 
1. une __chaîne de caractère__ correspondant au nom de la __table__
2. un __tableau associatif__ tel que
```
[
    "column_name" => "valeur",
    ...
]
```
3. un __tableau associatif optionnel__ 

Elle __return__ un __tableau__

[Solution](./Solutions/3%20-%20FindBy_solution.md)