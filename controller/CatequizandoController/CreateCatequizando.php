<?php
require_once "../../conect.php";
require_once  __DIR__ ."/../../Repositories/CatequizandoRepository.php";

$repository = new CatequizandoRepository($conn);

$nome_catequizando = $_POST['nome'] ?? null;
$data_nascimento = $_POST['dataNascimento'] ?? null;
$telefone_responsavel = $_POST['tel'] ?? null;
$turma_id = $_POST['turma_id'] ?? null;
$tela = $_POST['tela'] ?? null;

if (!$nome_catequizando || !$data_nascimento || !$telefone_responsavel) {
    die("Dados do formulário incompletos");
}

usleep(500000); // 0.5 segundos
if ($tela == 1) {
    if ($repository->CriarCatequizando($nome_catequizando, $data_nascimento, $telefone_responsavel, $turma_id)) {
        header("Location: ../../View/Catequizandos/index.php?sucesso=true");
        exit;
    } else {
        header("location:" . "../../View/Catequizandos/index.php?success=false");
    }
} else if ($tela == 2) {
    if ($repository->CriarCatequizando($nome_catequizando, $data_nascimento, $telefone_responsavel, $turma_id)) {
        header("Location: ../../View/Turmas/turma.php?id=$turma_id&sucesso=true");
        exit;
    } else {
        header("location:" . "../../View/Turmas/index.php?success=false");
    }
}
