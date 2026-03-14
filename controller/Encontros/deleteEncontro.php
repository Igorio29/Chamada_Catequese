<?php 
include "../../conect.php";
$id_encontro = $_GET["id"];
$sql = "DELETE FROM tab_encontro WHERE $id_encontro = id_encontro";
if ($conn->query($sql)) {
    header("Location:" . "../../View/Encontros/index.php?delete=true");
    exit;
} else {
    header("location:" . "../../View/Encontros/index.php?success=false");
}
?>