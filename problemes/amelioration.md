# Amélioration 🤩

## Refactor les répétitions

Des morceaux de codes se répètent. Vous pouvez les refactor en créant plusieurs méthode __privées__ qui vont gérer, réécrire, concaténer la chaine de caractère ```$query```.

Appliquer cela pour les :
- where
- order by

Pourquoi : code propre et refactor plus facile. Exemple : si vous avez besoins de mettre de meilleures conditions aux WHERE, on modifie à un seul endroit et pas plusieurs fois dans votre code et ca évites aussi de modifier différement ici et là.

## Mettre des ```htmlspecialchars();```

## Permettre de mettre des ``WHERE`` avec ``<`` ``>`` ``<=`` ``>=``

## Vérifier les types des entrées avant de poster ou de mettre à jour.

Piste : 

1. Récupèrez les types de la table avec cette commande SQL : 
```sql
DESCRIBE table;
```
2. Créez un tableau associatif des types de la table et des types de PDO
3. Vérifiez les types en intérant les valeurs et en les comparant avec les types
4. Mettez le paramètre de type dans le bindParam
```php
$stmt->bindParam(':name', $name, PDO::PARAM_STR); // Pour une chaîne de caractères
$stmt->bindParam(':age', $age, PDO::PARAM_INT); // Pour un entier
```

__Vous pouvez aussi vérifier si la valeur doit ou ne doit pas être NULL__