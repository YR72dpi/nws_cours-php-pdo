[< Retour](../README.md)
# Problème 1️⃣

Grace à une class PHP
- Connectez-vous à une base de donnée

de cette manière : 
```php
require_once("./Lib/PDOManagerClass.php");
$pdo = new PDOManagerClass("db_name");
```

Le __contructeur__ prend en paramètre une __chaîne de caractère__ correspondant au nom de la __base de donnée__.

## Tip 😍

Connection à une base: 
``` php
try {
    $pdo = new PDO("mysql:host=HOST;dbname=DB_NAME", "USERNAME", "PASSWORD");
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
```
[Solution](./Solutions/1%20-%20dbConnection_solution.md)