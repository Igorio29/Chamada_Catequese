<?php
require_once "../../conect.php";
require_once "../../Repositories/CatequizandoRepository.php";

$repository = new CatequizandoRepository($conn);

$id_catequizando = $_GET["id"];
$turma_id = $_GET["turma_id"];
$tela = $_GET["tela"];

usleep(500000);
if ($tela == 1) {
    if ($repository->DeletarCatequizando($id_catequizando)) {
        header("Location: ../../View/Catequizandos/index.php?delete=true");
        exit;
    } else {
        header("location:" . "../../View/Catequizandos/index.php?success=false");
    }
} else if ($tela == 2) {
    if ($repository->DeletarCatequizando($id_catequizando)) {
        header("Location: ../../View/Turmas/turma.php?id=$turma_id&delete=true");
        exit;
    } else {
        header("location:" . "../../View/Turmas/index.php?success=false");
    }
}
