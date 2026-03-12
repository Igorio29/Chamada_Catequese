<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encontros</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome-free-7.2.0-web/css/all.css">
    <style>
        body {
            background: #f4f6f9;
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

        .fa-calendar {
            width: 50px;
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
                <a href="../MenuInicial.php" class="botao-inicio">
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
                    <a class="nav-link" href="../menuInicial.php">
                        <i class="fa-solid fa-house"></i>
                        Menu Inicial
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa-solid fa-clipboard-check"></i>
                        Fazer Chamada
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../Catequizandos/index.php">
                        <i class="fa-solid fa-user"></i>
                        Catequizandos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa-solid fa-users"></i>
                        Turmas
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../Encontros/index.php">
                        <i class="fa-solid fa-calendar"></i>
                        Encontros
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
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
    <!--CONTEUDO-->
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Turmas da Catequese </h2>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#novaTurma">
                Nova Turma
            </button>
        </div>

        <div class="row g-4">

            <div class="col-12 col-sm-6 col-md-4">

                <div class="card shadow-sm h-100 turma-card">

                    <div class="card-body">
                        <div class="etapa">
                            <div class="d-flex">
                                <h4>
                                    07/03/2026
                                </h4>
                                <h2 class="ms-auto">
                                    <i class="fa-solid fa-calendar" style="color: rgb(232, 44, 44);"></i>
                                </h2>
                            </div>
                            <h3 class="card-text text-muted">
                                Tema Encontro
                            </h3>
                            <input type="hidden" name="" value="">
                            <hr>
                            <div class="mt-2">
                                <div class="d-flex justify-content-between">

                                    <a href="" class="btn btn-outline-primary w-100">
                                        Ver Encontro
                                    </a>

                                </div>
                            </div>
                            <!--
                                <div>
                                        <a>
                                            <i class="fa-solid fa-pen-to-square" style="color: rgb(116,192,252);"></i>
                                        </a>

                                        <a href="../../controller/TurmasController/deletarTurma.php?id=<?= $i['id_turma'] ?>">
                                            <i class="fa-solid fa-trash" style="color: rgb(232,75,75);"></i>
                                        </a>
                                </div>
                            -->
                        </div>

                    </div>

                </div>

            </div>


        </div>

    </div>
    <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>