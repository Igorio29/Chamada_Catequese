<?php
session_start();

include "../../conect.php";

$email = $_POST["email"];
$senha = $_POST["senha"];


$sql = "SELECT * FROM tab_usuario
            WHERE email_catequista = '$email'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $dados = $result->fetch_assoc();

    if (password_verify($senha, $dados['senha_catequista'])) {
        $_SESSION['usuario'] = $dados['nome_catequista'];
        $_SESSION['email'] = $dados['email_catequista'];
        $_SESSION['id'] = $dados['id_catequista'];
        $_SESSION['expire'] = time() + 86400;
        header("Location:" . "../../View/MenuInicial.php");
        exit();
    } else {
        header("Location:" . "../../View/index.php?erro=1&email=" . urlencode($email));
        exit();
    }
} else {
    header("Location:" . "../../View/index.php?erro=2");
}
