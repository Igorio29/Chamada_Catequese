<?php
session_start();
if (time() > $_SESSION['expire']) {
    session_destroy();
    header("Location: index.php");
    exit;
}

// Atual
date_default_timezone_set("America/Sao_Paulo");
$hora = date("H");
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catequese Campina</title>

    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-7.2.0-web/css/all.css">
    <link rel="icon" href="../img/logo.png">

    <style>
        body {
            background: #f2f4f6;
            min-height: 100vh;
            font-family: "Segoe UI", sans-serif;
        }

        /* NAVBAR */

        .navbar {
            background: #1b2b34;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }

        .navbar-brand {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* SIDEBAR */

        .offcanvas {
            background: #ffffff;
            width: 260px;
        }

        .offcanvas-header {
            border-bottom: 1px solid #e5e5e5;
        }

        .nav-item {
            border-radius: 8px;
            transition: 0.15s;
        }

        .nav-item:hover {
            background: #f1f1f1;
            transform: translateX(4px);
        }

        .nav-link {
            color: #333 !important;
            font-weight: 500;
        }

        .nav-link i {
            width: 25px;
            color: #2c5364;
        }

        /* CONTEUDO */

        .page-title {
            font-weight: 700;
            color: #1b2b34;
        }

        .subtitle {
            color: #6c757d;
        }

        /* CARDS */

        .card-menu {
            border: none;
            border-radius: 16px;
            background: white;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: 0.2s;
            cursor: pointer;
        }

        .card-menu:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .card-menu i {
            font-size: 28px;
            margin-bottom: 10px;
            color: #2c5364;
        }

        .card-menu h5 {
            font-weight: 600;
            color: #1b2b34;
        }

        a {
            text-decoration: none;
        }

        .botao-inicio {
            text-decoration: none;
            color: white;
        }

        .botao-inicio:hover {
            text-decoration: none;
            color: white;
        }

        .a-fazer {
            background-color: red;
        }
    </style>

</head>

<body>

    <!-- NAVBAR -->

    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <button class="btn btn-outline-light" data-bs-toggle="offcanvas" data-bs-target="#menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            <span class="navbar-brand mb-0 h1">
                <a href="#" class="botao-inicio">
                    <i class="fa-solid fa-church"></i> Catequese Campina
                </a>
            </span>
        </div>
    </nav>

    <!-- MENU LATERAL -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="menu">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold">
                <i class="fa-solid fa-church"></i> Menu
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body">

            <ul class="nav flex-column">

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa-solid fa-house"></i>
                        Menu Inicial
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./Encontros/adicionarEncontro.php?tela=1">
                        <i class="fa-solid fa-clipboard-check"></i>
                        Fazer Chamada
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="./Catequizandos/index.php">
                        <i class="fa-solid fa-user"></i>
                        Catequizandos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="./Turmas/">
                        <i class="fa-solid fa-users"></i>
                        Turmas
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="./Encontros/index.php">
                        <i class="fa-solid fa-calendar"></i>
                        Encontros
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="./Relatorios/index.php">
                        <i class="fa-solid fa-chart-column"></i>
                        Relatórios
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <a class="nav-link text-danger" href="../index.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Sair
                    </a>
                </li>

            </ul>

        </div>

    </div>

    <!-- CONTEUDO -->

    <div class="container mt-5">
        <h1 class="page-title"><?php
                                if ($hora < 12) {
                                    echo "Bom dia, " . $_SESSION['usuario'] . "!";
                                } else if ($hora < 19) {
                                    echo "Boa tarde, " . $_SESSION['usuario'] . "!";
                                } else {
                                    echo "Boa noite, " . $_SESSION['usuario'] . "!";
                                }
                                ?></h1>
        <div class="mb-4">

            <h2 class="page-title">Painel do Catequista</h2>
            <p class="subtitle">Gerencie presença, turmas e catequizandos.</p>

        </div>

        <div class="row g-4">

            <div class="col-md-6">
                <a href="./Encontros/adicionarEncontro.php?tela=1">
                    <div class="card card-menu p-4 text-center">

                        <i class="fa-solid fa-clipboard-check"></i>

                        <h5>Fazer Chamada</h5>

                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <a href="./Catequizandos/index.php">
                    <div class="card card-menu p-4 text-center">

                        <i class="fa-solid fa-user"></i>

                        <h5>Catequizandos</h5>

                    </div>

                </a>

            </div>

            <div class="col-md-6">
                <a href="./Turmas/index.php">
                    <div class="card card-menu p-4 text-center">

                        <i class="fa-solid fa-users"></i>

                        <h5>Turmas</h5>

                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <a href="./Encontros/index.php">
                    <div class="card card-menu p-4 text-center">

                        <i class="fa-solid fa-calendar"></i>

                        <h5>Encontros</h5>

                    </div>
                </a>
            </div>

        </div>

    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>