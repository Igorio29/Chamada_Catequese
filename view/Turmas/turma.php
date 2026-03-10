<?php

include "../../conect.php";
$turma_id = $_GET['id'];

$sql =  "SELECT * FROM tab_turma t
        JOIN tab_usuario u ON id_catequista = catequista_id
        WHERE id_turma = '$turma_id'
";
$resultTurma = $conn->query($sql);
$i = $resultTurma->fetch_assoc();

include "../../controller/catequizando/catequizandoForTurma.php"
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turma</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome-free-7.2.0-web/css/all.css">
    <style>
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

        .botao-inicio {
            text-decoration: none;
            color: white;
        }

        .botao-inicio:hover {
            text-decoration: none;
            color: white;
        }

        .alert-sucesso {
            position: fixed;
            top: 20px;
            right: 20px;

            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            font-weight: bold;

            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);

            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.5s, transform 0.5s;

            z-index: 9999;

        }

        .alert-sucesso.show {
            opacity: 0.8;
            transform: translateY(0);
            cursor: pointer;
        }

        .alert-sucesso.show:hover {
            opacity: 1;
        }

        .alert-sucesso-delete {
            position: fixed;
            top: 20px;
            right: 20px;

            background-color: rgb(247, 65, 65);
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            font-weight: bold;

            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);

            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.5s, transform 0.5s;

            z-index: 9999;

        }

        .alert-sucesso-delete.show {
            opacity: 0.8;
            transform: translateY(0);
            cursor: pointer;
        }

        .alert-sucesso-delete.show:hover {
            opacity: 1;
        }

        .alert-sucesso-update {
            position: fixed;
            top: 20px;
            right: 20px;

            background-color: rgb(3, 134, 241);
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            font-weight: bold;

            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);

            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.5s, transform 0.5s;

            z-index: 9999;

        }

        .alert-sucesso-update.show {
            opacity: 0.8;
            transform: translateY(0);
            cursor: pointer;
        }

        .alert-sucesso-update.show:hover {
            opacity: 1;
        }

        .alert-sucesso.show {
            opacity: 0.8;
            transform: translateY(0);
            cursor: pointer;
        }

        .alert-sucesso.show:hover {
            opacity: 1;
        }
    </style>
</head>

<body>

    <?php
    if (isset($_GET['sucesso']) && $_GET['sucesso'] == "true") {
    ?>
        <div id="msg-sucesso" class="alert-sucesso">
            Catequizando criado com sucesso!
        </div>
    <?php
    }
    ?>
    <?php
    if (isset($_GET['delete']) && $_GET['delete'] == "true") {
    ?>
        <div id="msg-sucesso" class="alert-sucesso-delete">
            Catequizando Deletado com sucesso!
        </div>
    <?php
    }
    ?>
    <?php
    if (isset($_GET['edit']) && $_GET['edit'] == "true") {
    ?>
        <div id="msg-sucesso" class="alert-sucesso-update">
            Catequizando Editado com sucesso!
        </div>
    <?php
    }
    ?>
    <?php
    if (isset($_GET['success']) && $_GET['success'] == "false") {
    ?>
        <div id="msg-sucesso" class="alert-sucesso-delete">
            Erro ao concluir ação!
        </div>
    <?php
    }
    ?>

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
                    <a class="nav-link" href="#">
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
                    <a class="nav-link" href="#">
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
    <main class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
            <h2>Turmas da Catequese </h2>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#novoAluno">
                Novo Catequizando
            </button>
        </div>
        <div class="modal fade" id="novoAluno">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title">Novo Catequizando</h5>

                        <button class="btn-close" data-bs-dismiss="modal"></button>

                    </div>


                    <form action="../../controller/catequizando/createCatequizando.php" method="POST">

                        <div class="modal-body">

                            <div class="mb-3">

                                <label class="form-label">Nome</label>

                                <input type="text" class="form-control" name="nome">

                            </div>

                            <div class="mb-3">

                                <label class="form-label">Data Nascimento</label>

                                <input type="date" class="form-control" name="dataNascimento">

                            </div>
                            <div class="mb-3">

                                <label class="form-label">Telefone do Responsavel</label>

                                <input type="text" class="form-control" id="telefone" placeholder="(41) 00000-0000" name="tel">

                            </div>



                        </div>
                        <input type="hidden" name="turma_id" value="<?= $turma_id ?>">

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancelar
                            </button>

                            <button type="submit" class="btn btn-primary"
                                onclick="this.disabled=true; this.form.submit();">
                                Salvar Turma
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
        <div class="etapa">
            <h5 class="card-title">
                <?= htmlspecialchars($i['etapa_turma']) ?>ª Etapa - <?= htmlspecialchars($i['ano_turma']) ?>
            </h5>
        </div>
        <p class="card-text text-muted">
            Catequista: <?= htmlspecialchars($i['nome_catequista']) ?>
        </p>
        <table class="table table-hover mt-5">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Data Nascimento</th>
                    <th scope="col">Telefone</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($i as $catequizando){ ?>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $('#telefone').mask('(00) 00000-0000');
    </script>
</body>

</html>