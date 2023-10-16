
# Problème 6️⃣

Grace à une class PHP :
- Connecter vous à une base
- Mettre à jour une ligne de votre table

de cette manière

```php
require_once("./Lib/PDOManagerClass.php");
$pdo = new PDOManagerClass("nws_courspdo");
$pdo->update(
    "ordinateur", 
    1,
    [
        "marque"=>"PackardBell",
        "model" => "Ordi pas ouf",
        "puissance_cpu" => 2,
        "capacite_ram" => 16,
        "puissance_gpu" => 2,
        "prix" => 500
    ]
);
```

La __methode__ prend en paramètre : 
1. une __chaîne de caractère__ correspondant au nom de la __table__
2. une __entier__ correspondant à l'ID de la ligne à supprimer
3. un __tableau__ correspondant à l'ID de la ligne à supprimer

Elle __return__ un __boolean__

[Solution](./Solutions/6%20-%20Update_solution.md)