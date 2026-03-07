
<?php
include "../../conect.php";

$nome = $_POST["usuario"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$confirmar = $_POST["confirmar"];
date_default_timezone_set("America/Sao_Paulo");
$datacadastro = date("Y-m-d H:i:s");
$consulta = "SELECT COUNT(email_catequista) as total 
    FROM tab_usuario 
    WHERE email_catequista = '$email'";

$result = $conn->query($consulta);

$row = $result->fetch_assoc();

if ($row['total'] > 0) {
    header("Location: ../../View/RegistroUsuario/index.php?erro=2");
    exit;
}

if ($senha != $confirmar) {
    header("Location: ../../View/RegistroUsuario/index.php?1&usuario=$nome&email=$email");
    exit;
}

$senhaCripto = password_hash($senha, PASSWORD_DEFAULT);
$sql = "INSERT INTO tab_usuario VALUES (NULL, '$nome', '$email', '$senhaCripto', '$datacadastro')";
$conn->query($sql);

header("location:" . "../../View/index.php");
?>