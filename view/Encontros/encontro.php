
<?php
$id_encontro = $_GET["id"];
include "../../conect.php";
include "../../controller/Encontros/getEncontroById.php"
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
    <?= $encontro["tema"] ?>
    </h1>
</body>
</html>