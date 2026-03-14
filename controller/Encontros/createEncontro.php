<?php

include "../../conect.php";

$turma_id = $_POST["turma_id"];
$data = $_POST["data_encontro"];
$tema = $_POST["tema_encontro"];
$frase = $_POST["frase_encontro"];
$obs = $_POST["observacao"];

/* cria o encontro */

$sql = "INSERT INTO tab_encontro
        (turma_id, data_encontro, tema, frase_encontro, observacao)
        VALUES
        ('$turma_id','$data','$tema','$frase','$obs')";

$conn->query($sql);

/* pega o id do encontro criado */

$encontro_id = $conn->insert_id;

/* salva a chamada */

$presencas = $_POST["presenca"];

foreach ($presencas as $catequizando_id => $presente) {

    $sql = "INSERT INTO tab_chamada
            (encontro_id, catequizando_id, presenca)
            VALUES
            ('$encontro_id','$catequizando_id','$presente')";

    $conn->query($sql);
}

/* volta para lista */

header("Location: ../../view/Encontros/index.php");