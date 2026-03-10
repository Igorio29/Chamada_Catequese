<?php
include "../../conect.php";

$sqlCat = "SELECT * FROM tab_catequizando c
            JOIN tab_turma t ON c.turma_id = t.id_turma
            JOIN tab_usuario u on t.catequista_id = u.id_catequista";
$resultCat = $conn->query($sqlCat);
$catequizando = $resultCat->fetch_all(MYSQLI_ASSOC);

?>