<?php
    require_once ("../../conect.php");
    require_once ("../../repositories/TurmaRepository.php");

    $id_turma = $_GET['id'];

    usleep(500000); // 0.5 segundos

    $repository = new TurmaRepository($conn);
    $result = $repository->deletar($id_turma);
    
    if($result){
        header("Location: ../../View/Turmas/index.php?delete=true");
        exit;
    }else{
        header("location:". "../../View/Turmas/index.php?success=false");
    }
    
?>