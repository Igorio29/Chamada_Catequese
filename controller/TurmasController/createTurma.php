<?php
include "../../conect.php";

$etapa_turma = $_POST['etapa_id'] ?? null;
$ano_turma = $_POST['ano'] ?? null;
$catequista_id = $_POST['catequista_id'] ?? null;

if (!$etapa_turma || !$ano_turma || !$catequista_id) {
    die("Dados do formulário incompletos");
}

$sql = "INSERT INTO tab_turma (etapa_turma, ano_turma, catequista_id)
        VALUES ($etapa_turma, $ano_turma, $catequista_id)";
usleep(500000); // 0.5 segundos
if ($conn->query($sql)) {
    header("Location: ../../View/Turmas/index.php?sucesso=true");
    exit;
} else {
    header("location:" . "../../View/Turmas/index.php?success=false");
}
