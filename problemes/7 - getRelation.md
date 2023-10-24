# Problème 7️⃣

Grace à une class PHP :
- Connectez-vous à une base
- Récuperez une relation entre deux tables

de cette manière

```php
        require_once("./Lib/PDOManagerClass.php");
        $pdo = new PDOManagerClass("ordinateur");
        echo "<pre>";
        var_dump($pdo->getRelation(
            [
                ["avis", "id_ordi"],
                ["ordinateur", "id"],
            ], 
            "marque, model, avis",
            ["ordinateur.id" => 15], 
            ["avis.id" => "ASC"]
        ));
```

La __methode__ prend en paramètre : 
1. une __tableau__ correspondant à la relation
2. une __string__ optionnelle pour selectionner ce que vous voulez
3. un __tableau__ optionnelle pour appliquere un ```where```
4. un __tableau__ optionnel pour gerer l'ordre

Elle __return__ un __tableau__

[Solution](./Solutions/7%20-%20getRelation_solution.md)