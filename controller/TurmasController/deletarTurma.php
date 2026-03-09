<?php
    include ("../../conect.php");

    $id = $_GET['id'];

    $sqldelete = "DELETE FROM tab_turma WHERE id_turma = '$id'";
    usleep(500000); // 0.5 segundos
    if($conn->query($sqldelete)){
        header("Location: ../../View/Turmas/index.php?delete=true");
        exit;
    }else{
        header("location:". "../../View/Turmas/index.php?success=false");
    }
    
?>