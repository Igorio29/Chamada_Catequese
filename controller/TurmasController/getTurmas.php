<?php
include "../../conect.php";

$sql = "SELECT * FROM tab_turma 
        JOIN tab_usuario ON catequista_id = id_catequista
        ORDER BY etapa_turma ASC
";
$result = $conn->query($sql);
$busca = $result->fetch_all();
?>