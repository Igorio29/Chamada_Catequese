<?php
session_start();
require_once "../../repositories/TurmaRepository.php";
require_once "../../conect.php";
$etapa_turma = $_POST['etapa'];
$ano_turma = $_POST['ano'];
$catequista_id = $_SESSION['id'];

$repository = new TurmaRepository($conn);

$result = $repository->criar($etapa_turma, $ano_turma, $catequista_id);
if ($result) {
    header("location:" . "../../view/Turmas/index.php?sucesso=true");
    exit;
} else {
        header("location:" . "../../view/Turmas/index.php?sucesso=false");
}
?>