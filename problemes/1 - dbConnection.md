# Problème 1️⃣

Grace à une class PHP
- Connecter vous à une base de donnée

de cette manière : 
```php
require_once("./Lib/PDOManagerClass.php");
$pdo = new PDOManagerClass("nws_courspdo");
```

Le __contructeur__ prend en paramètre une __chaîne de caractère__ correspondant au nom de la __base de donnée__.

## Tips 😍

Connection à une base: 
``` php
try {
    $pdo = new PDO("mysql:host=HOST;dbname=DB_NAME", "USERNAME", "PASSWORD");
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
```