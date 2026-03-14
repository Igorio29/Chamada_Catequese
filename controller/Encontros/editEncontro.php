<?php
include "../../conect.php";
$id_encontro = $_POST["id_encontro"];
$data_encontro = $_POST["data_encontro"];
$tema = $_POST["tema"];
$frase_encontro = $_POST["frase_encontro"];
$observacao = $_POST["observacao"];
$turma_id = $_POST["turma_id"];

$sql = "UPDATE tab_encontro SET 
            data_encontro = '$data_encontro',
            tema = '$tema',
            frase_encontro = '$frase_encontro',
            observacao = '$observacao',
            turma_id = $turma_id
            WHERE id_encontro = $id_encontro
            ";



$presencas = $_POST["presenca"];

foreach ($presencas as $catequizando_id => $presente) {

    $sql1 = "UPDATE tab_chamada SET
            presenca = $presente
            WHERE encontro_id = $id_encontro
            AND catequizando_id = $catequizando_id";

    $conn->query($sql1);
}
usleep(500000); // 0.5 segundos

if ($conn->query($sql)) {
    header("location:" . "../../View/Encontros/encontro.php?id=$id_encontro&edit=true");
} else {
    header("location:" . "../../View/Encontros/index.php?id=$id_encontro&success=false");
}
