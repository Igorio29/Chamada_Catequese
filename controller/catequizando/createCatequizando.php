<?php
include "../../conect.php";

$nome_catequizando = $_POST['nome'] ?? null;
$data_nascimento = $_POST['dataNascimento'] ?? null;
$tel = $_POST['tel'] ?? null;
$turma_id = $_POST['turma_id'] ?? null;
$tela = $_POST['tela'] ?? null;

if (!$nome_catequizando || !$data_nascimento || !$tel) {
    die("Dados do formulário incompletos");
}

$sql = "INSERT INTO tab_catequizando (nome_catequizando, data_nascimento, telefone_responsavel, turma_id)
        VALUES ('$nome_catequizando', '$data_nascimento', '$tel', $turma_id)";
usleep(500000); // 0.5 segundos
if ($tela == 1) {
    if ($conn->query($sql)) {
        header("Location: ../../View/Catequizandos/index.php?sucesso=true");
        exit;
    } else {
        header("location:" . "../../View/Catequizandos/index.php?success=false");
    }
} else if ($tela == 2) {
    if ($conn->query($sql)) {
        header("Location: ../../View/Turmas/turma.php?id=$turma_id&sucesso=true");
        exit;
    } else {
        header("location:" . "../../View/Turmas/index.php?success=false");
    }
}
