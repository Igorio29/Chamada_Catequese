<?php
include "../../conect.php";

$id_catequizando = $_GET["id"];
$turma_id = $_GET["turma_id"];
$tela = $_GET["tela"];

$sql = "DELETE FROM tab_catequizando WHERE id_catequizando = '$id_catequizando'";
usleep(500000);
if ($tela == 1) {
    if ($conn->query($sql)) {
        header("Location: ../../View/Catequizandos/index.php?delete=true");
        exit;
    } else {
        header("location:" . "../../View/Catequizandos/index.php?success=false");
    }
} else if ($tela == 2) {
    if ($conn->query($sql)) {
        header("Location: ../../View/Turmas/turma.php?id=$turma_id&delete=true");
        exit;
    } else {
        header("location:" . "../../View/Turmas/index.php?success=false");
    }
}
