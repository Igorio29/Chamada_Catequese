<?php
include "../../conect.php";

$id_turma = $_POST['id_turma'];
$etapa_turma = $_POST['etapa_turma'];
$ano_turma = $_POST['ano_turma'];
$catequista_id = $_POST['catequista_id'];

$sql = "UPDATE tab_turma SET 
        etapa_turma = '$etapa_turma',
        ano_turma = '$ano_turma',
        catequista_id = '$catequista_id'
    WHERE id_turma = '$id_turma';";
usleep(500000); // 0.5 segundos
if ($conn->query($sql)) {
    header("location:" . "../../View/Turmas/index.php?edit=true");
} else{
    header("location:". "../../View/Turmas/index.php?success=false");
}
