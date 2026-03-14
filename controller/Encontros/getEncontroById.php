<?php
    $sql = "SELECT * FROM tab_encontro e
            INNER JOIN tab_turma t ON e.turma_id = t.id_turma
            INNER JOIN tab_usuario u on t.catequista_id = u.id_catequista 
            WHERE id_encontro = $id_encontro";
    $result = $conn->query($sql);
    $encontro = $result->fetch_array(MYSQLI_ASSOC);

    $sql2 = "SELECT * FROM tab_chamada ch
            JOIN catequista ca ON ch.catequizando_id = ca.id_catequista
            WHERE encontro_id = $id_encontro";
    $result2 = $conn->query($sql);
    $chamada = $result2->fetch_all(MYSQLI_ASSOC);
?>