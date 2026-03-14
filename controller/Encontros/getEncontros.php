<?php 
$sql = "SELECT e.*, t.*, u.*
        FROM tab_encontro e
        JOIN tab_turma t ON e.turma_id = t.id_turma
        JOIN tab_usuario u ON t.catequista_id = u.id_catequista
        WHERE t.catequista_id = $catequista_id
        ORDER BY e.data_encontro DESC";
$result = $conn->query($sql);
$encontros = $result->fetch_all(MYSQLI_ASSOC);
?>