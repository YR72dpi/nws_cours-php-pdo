<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>
<body>
    <?php
        require_once("./Lib/PDOManagerClass.php");

        $pdo = new PDOManagerClass("ordinateur");
        echo "<pre>";
        $pdo->post("ordinateur", [
            "marque" => "HP",
            "model" => "X".mt_rand(100, 999),
            "puissance_cpu" => 2.3,
            "capacite_ram" => 32,
            "puissance_gpu" => 1.9, 
            "prix" => mt_rand(1000, 9999)
        ]);
        var_dump($pdo->findBy('ordinateur', ["marque" => "HP"], ["id" => "DESC"]));
        echo "</>";
    ?>
</body>
</html>