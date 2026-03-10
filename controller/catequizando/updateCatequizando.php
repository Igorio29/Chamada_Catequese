<?php
include "../../conect.php";

$id_catequizando = $_POST["id_catequizando"];
$nome_catequizando = $_POST["nome"];
$data_nascimento = $_POST["dataNascimento"];
$telefone_responsavel = $_POST["tel"];
$turma_id = $_POST["turma_id"];
$turma_id_atual = $_POST["turma_atual"];

$sql = "UPDATE tab_catequizando SET 
                nome_catequizando = '$nome_catequizando',
                data_nascimento = '$data_nascimento',
                telefone_responsavel = '$telefone_responsavel',
                turma_id = $turma_id
            WHERE id_catequizando = $id_catequizando";

usleep(500000); // 0.5 segundos
if ($conn->query($sql)) {
    header("Location: ../../View/Turmas/turma.php?id=$turma_id_atual&edit=true");
} else {
    header("location:" . "../../View/Turmas/turma.php?id=$turma_id_atual&success=false");
}
