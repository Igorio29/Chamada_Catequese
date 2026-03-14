<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Catequese Campina</title>
    <link rel="stylesheet" href="./style.css/login.css">
    <link rel="icon" href="../img/logo.png">

</head>

<body>

    <body>

        <div class="container">

            <img src="../img/logo.png" class="logo">

            <div class="titulo">Catequese Campina</div>
            <div class="subtitulo">Sistema de Chamada da Catequese</div>

            <?php

            $email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';

            if (isset($_GET['erro'])) {

                if ($_GET['erro'] == 1) {
                    echo "<div class='erro'>Senha incorreta</div>";
                }

                if ($_GET['erro'] == 2) {
                    echo "<div class='erro'>Email não cadastrado</div>";
                }
            }

            ?>

            <form action="../controller/login/login.php" method="POST" autocomplete="on">

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" autocomplete="email" required value="<?php echo $email; ?>">
                </div>

                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="senha" autocomplete="current-password" required>
                </div>

                <button type="submit">Entrar</button>

            </form>

            <div class="footer">

                Comunidade Campina dos Pintos

                <div class="registro">
                    <a href="./RegistroUsuario/index.php">Criar conta</a>
                </div>

            </div>

        </div>

    </body>

</body>

</html>