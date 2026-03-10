<?php
include "../../conect.php";

$nome_catequizando = $_POST['nome'] ?? null;
$data_nascimento = $_POST['dataNascimento'] ?? null;
$tel = $_POST['tel'] ?? null;
$turma_id = $_POST['turma_id'] ?? null;

if (!$etapa_turma || !$ano_turma || !$catequista_id) {
    die("Dados do formulário incompletos");
}

$sql = "INSERT INTO tab_catequizando (nome_catequizando, data_nascimento, telefone_responsavel, turma_id)
        VALUES ($nome_catequizando, $data_nascimento, $tel, $turma_id)";
usleep(500000); // 0.5 segundos
if ($conn->query($sql)) {
    header("Location: ../../View/Turmas/turma.php?id='$turma_id' sucesso=true");
    exit;
} else {
    header("location:" . "../../View/Turmas/index.php?success=false");
}
