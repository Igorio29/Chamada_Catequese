<?php

require_once "../../repositories/TurmaRepository.php";
include "../../conect.php";

$repository = new TurmaRepository($conn);

$id_turma = $_POST['id_turma'];
$etapa_turma = $_POST['etapa_turma'];
$ano_turma = $_POST['ano_turma'];
$catequista_id = $_POST['catequista_id'];

$result = $repository->atualizar($id_turma, $etapa_turma, $ano_turma, $catequista_id);

usleep(500000); // 0.5 segundos
if ($result) {
    header("location:" . "../../View/Turmas/index.php?edit=true");
} else{
    header("location:". "../../View/Turmas/index.php?success=false");
}
