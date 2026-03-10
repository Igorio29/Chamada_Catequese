<?php 
    include "../../conect.php";

    $id_catequizando = $_GET["id"];
    $turma_id = $_GET["turma_id"];

    $sql = "DELETE FROM tab_catequizando WHERE id_catequizando = '$id_catequizando'";
    usleep(500000);
    if($conn->query($sql)){
        header("location:"."../../view/Turmas/turma.php?id=$turma_id&delete=true");
    } else {
        header("location:". "../../view/Turmas/turma.php?id=$turma_id&sucesso=false");
    }
?>