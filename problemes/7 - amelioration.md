# Amélioration 🤩

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