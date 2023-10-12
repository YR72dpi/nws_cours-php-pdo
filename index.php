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

        $pdo = new PDOManagerClass("nws_courspdo");

        echo "<pre>";
        var_dump($pdo->update(
            "ordinateur", 
            42,
            [
                "marque"=>"PackardBell",
                "model" => "Ordi pas ouf",
                "puissance_cpu" => 2,
                "capacite_ram" => 16,
                "puissance_gpu" => 2,
                "prix" => 500
            ]
        ));
        echo "</pre>";

        echo "<pre>";
        var_dump($pdo->findBy(
            "ordinateur", [
            "id" => "42"
        ], ["id" => "ASC"]));
        echo "</pre>";
    ?>
</body>
</html>