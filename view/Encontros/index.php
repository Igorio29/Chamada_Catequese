<?php
session_start();

if (time() > $_SESSION['expire']) {
    session_destroy();
    header("Location: index.php");
    exit;
}

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit;
}
$catequista_id = $_SESSION['id'];

include "../../conect.php";
include "../../controller/Encontros/getEncontros.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encontros</title>
    <link rel="stylesheet" href="../style.css/layout.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome-free-7.2.0-web/css/all.css">
    <style>
        .fa-calendar {
            width: 50px;
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
    </style>
</head>

<body>
    <div>
        <?php
        if (isset($_GET['sucesso']) && $_GET['sucesso'] === "true") {
        ?>
            <div id="msg-sucesso" class="alert-sucesso">
                Encontro criado com sucesso!
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($_GET['delete']) && $_GET['delete'] == "true") {
        ?>
            <div id="msg-sucesso" class="alert-sucesso-delete">
                Encontro Deletado com sucesso!
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($_GET['edit']) && $_GET['edit'] == "true") {
        ?>
            <div id="msg-sucesso" class="alert-sucesso-update">
                Encontro Editado com sucesso!
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
    </div>
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
                    <a class="nav-link" href="../Encontros/adicionarEncontro.php?tela=1">
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
                <a class="nav-link" href="../Relatorios/index.php">
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

            <a href="./adicionarEncontro.php" class="btn btn-primary" data-bs-target="#novaTurma">
                Novo Encontro
            </a>
        </div>

        <div class="row g-4">
            <?php foreach ($encontros as $e): ?>
                <div class="col-12 col-sm-6 col-md-4">

                    <div class="card shadow-sm h-100 turma-card">

                        <div class="card-body">
                            <div class="etapa">
                                <div class="d-flex">
                                    <h4>
                                        <?= date('d/m/Y', strtotime($e["data_encontro"])) ?>
                                    </h4>
                                    <h2 class="ms-auto">
                                        <i class="fa-solid fa-calendar" style="color: rgb(232, 44, 44);"></i>
                                    </h2>
                                </div>
                                <h3 class="card-text text-muted">
                                    <?= $e["tema"] ?>
                                </h3>
                                <input type="hidden" name="" value="">
                                <p class="blockquote-footer mt-1">
                                    <?php
                                    $frase = $e["frase_encontro"];

                                    if (strlen($frase) > 45) {
                                        echo substr($frase, 0, 45) . "...";
                                    } else {
                                        echo $frase;
                                    }
                                    ?>
                                </p>
                                <hr>
                                <div class="mt-2">
                                    <div class="d-flex justify-content-between">

                                        <a href="./encontro.php?id=<?= $e["id_encontro"] ?>" class="btn btn-outline-primary w-100">
                                            Ver Encontro
                                        </a>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            <?php endforeach; ?>

        </div>

    </div>
    <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const msg = document.getElementById("msg-sucesso");

            if (msg) {

                setTimeout(() => {
                    msg.classList.add("show");
                }, 100);

                setTimeout(() => {
                    msg.classList.remove("show");
                }, 5000);

                // desaparecer ao clicar
                msg.addEventListener("click", function() {
                    msg.classList.remove("show");
                });

            }

            const editarModal = document.getElementById('editarCatequizandomodal');

            editarModal.addEventListener('show.bs.modal', function(event) {

                const button = event.relatedTarget;

                const id = button.getAttribute('data-id');
                console.log(id);
                const nome = button.getAttribute('data-nome');
                console.log(nome);
                const nascimento = button.getAttribute('data-nascimento');
                const telefone = button.getAttribute('data-telefone');
                const turma = button.getAttribute('data-turma');

                document.getElementById('edit_id').value = id;
                document.getElementById('edit_nome').value = nome;
                document.getElementById('edit_nascimento').value = nascimento;
                document.getElementById('edit_telefone').value = telefone;
                document.getElementById('edit_turma').value = turma;
                document.getElementById('edit_turma_atual').value = turma;

            });

        });


        //REMOVE A MENSAGEM DO URL

        const url = new URL(window.location);

        url.searchParams.delete("sucesso");
        url.searchParams.delete("success");
        url.searchParams.delete("delete");
        url.searchParams.delete("edit");

        window.history.replaceState({}, document.title, url);
    </script>
</body>

</html>