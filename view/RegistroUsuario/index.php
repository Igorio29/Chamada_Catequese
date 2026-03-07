<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="shortcut icon" href="../../img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../style.css/login.css">

</head>

<body>

    <div class="container">

        <img src="../../img/logo.png" class="logo">

        <div class="titulo">Catequese Campina</div>
        <div class="subtitulo">Cadastro de Catequista</div>

        <?php
        $usuario = isset($_GET['usuario']) ? htmlspecialchars($_GET['usuario']) : '';
        $email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';

        if (isset($_GET['erro'])) {
            if ($_GET['erro'] == 2) {
                echo "<div class='erro'>Email ja cadastrado</div>";
            }
        }

        if (isset($_GET['erro'])) {
            if ($_GET['erro'] == 1) {
                echo "<div class='erro'>As senhas não coincidem</div>";
            }
        }
        ?>

        <form action="../../controller/login/registro.php" method="POST" autocomplete="on">

            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="usuario" placeholder="Nome completo" autocomplete="name" required value="<?php echo $usuario; ?>">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="email@email.com" autocomplete="email" required value="<?php echo $email; ?>">
            </div>

            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha" placeholder="Digite a senha" autocomplete="new-password" required>
            </div>

            <div class="form-group">
                <label>Confirmar senha</label>
                <input type="password" name="confirmar" placeholder="Confirme a senha" autocomplete="new-password" required>
            </div>

            <button type="submit">Cadastrar</button>

        </form>
        <div class="footer">
            Comunidade Campina dos Pintos
            <div class="link-login">
                <a href="../index.php">Já tem conta? Fazer login</a>
            </div>
        </div>

    </div>

</body>

</html>