[< Retour](../README.md)
# Problème 4️⃣

Grace à une class PHP :
- Connecter vous à une base
- Ajouter une ligne de votre table

de cette manière

```php
require_once("./Lib/PDOManagerClass.php");
$pdo = new PDOManagerClass("nws_courspdo");
$pdo->post(
    "ordinateur", 
    [
        "marque"=>"ASUS",
        "model" => "Super Ordi du Turfu",
        "puissance_cpu" => 3,
        "capacite_ram" => 32,
        "puissance_gpu" => 3,
        "prix" => 4300
    ]
);
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

Elle __return__ un __boolean__

[Solution](./Solutions/4%20-%20Post_solution.md)