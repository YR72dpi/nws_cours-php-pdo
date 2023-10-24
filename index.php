<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/mvp.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>
<body>
    <?php
        require_once("./Entity/Ordinateur.php");
        (new Ordinateur())->showTable();
    ?>
</body>
</html>