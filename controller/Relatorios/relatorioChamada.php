<?php
$turma_id = $_POST["turma_id"];
sleep(1);
header("location:"."../../view/Relatorios/relatorio_chamada.php?turma_id=$turma_id");
?>