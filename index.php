<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once("./Lib/PDOManagerClass.php");

        $pdo = new PDOManagerClass("nws_courspdo");
        echo "<pre>";
        var_dump($pdo->findBy(
            "ordinateur", [
            "capacite_ram" => 16,
            "marque" => "Lenovo"
        ], ["id" => "ASC"]));
        echo "</pre>";
    ?>

    // TODO : POST
    // TODO : DELETE
    // TODO : UPDATE
</body>
</html>