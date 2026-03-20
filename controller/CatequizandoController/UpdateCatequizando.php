<?php
require_once "../../conect.php";
require_once  __DIR__ ."/../../Repositories/CatequizandoRepository.php";

$repository = new CatequizandoRepository($conn);

$id_catequizando = $_POST["id_catequizando"];
$nome_catequizando = $_POST["nome"];
$data_nascimento = $_POST["dataNascimento"];
$telefone_responsavel = $_POST["tel"];
$turma_id = $_POST["turma_id"];
$turma_id_atual = $_POST["turma_atual"];
$tela = $_POST["tela"];

usleep(500000); // 0.5 segundos
if ($tela == 1) {
    if ($repository->AtualizarCatequizando($id_catequizando, $nome_catequizando, $data_nascimento, $telefone_responsavel, $turma_id)) {
        header("Location:" ." ../../View/Catequizandos/index.php?edit=true");
        exit;
    } else {
        header("location:" . "../../View/Catequizandos/index.php?success=false");
    }
} else if ($tela == 2) {
    if ($repository->AtualizarCatequizando($id_catequizando, $nome_catequizando, $data_nascimento, $telefone_responsavel, $turma_id)) {
        header("Location: ../../View/Turmas/turma.php?id=$turma_id_atual&edit=true");
    } else {
        header("location:" . "../../View/Turmas/turma.php?id=$turma_id_atual&success=false");
    }
}
