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
$id_encontro = $_GET["id"];
include "../../conect.php";
include "../../controller/Encontros/getEncontroById.php"
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encontro - <?= date("d/m/Y", strtotime($encontro["data_encontro"])) ?></title>
    <link rel="stylesheet" href="../style.css/layout.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome-free-7.2.0-web/css/all.css">
    <link rel="icon" href="../../img/logo.png">

    <style>
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
                    <a class="nav-link" href="adicionarEncontro.php?tela=1">
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

    <!-- CONTEÚDO -->

    <div class="container mt-4">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fa-solid fa-calendar"></i>
                    Detalhes do Encontro
                </h4>
            </div>

            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Tema:</strong><br>
                        <?= $encontro["tema"] ?>
                    </div>

                    <div class="col-md-3">
                        <strong>Data:</strong><br>
                        <?= date("d/m/Y", strtotime($encontro["data_encontro"])) ?>
                    </div>

                    <div class="col-md-3">
                        <strong>Turma:</strong><br>
                        <?= $encontro["etapa_turma"] ?>º Etapa - <?= $encontro["nome_catequista"] ?>
                    </div>
                </div>

                <div class="mb-3">
                    <strong>Descrição / Planejamento</strong>
                    <div class="border rounded p-3 bg-light">
                        <h5><?= $encontro["frase_encontro"] ?></h5>
                        <p><?= $encontro["observacao"] ?></p>
                    </div>
                </div>

                <div class="mt-4">

                    <h5 class="mb-3">
                        <i class="fa-solid fa-clipboard-check"></i>
                        Chamada do Encontro
                    </h5>

                    <table class="table table-striped">

                        <thead class="table-dark">
                            <tr>
                                <th>Catequizando</th>
                                <th>Presença</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($chamada as $row): ?>

                                <tr>
                                    <td><?= $row["nome_catequizando"] ?></td>

                                    <td>
                                        <?php if ($row["presenca"] == 1) { ?>

                                            <span class="badge bg-success">
                                                <i class="fa-solid fa-check"></i>
                                                Presente
                                            </span>

                                        <?php } else { ?>

                                            <span class="badge bg-danger">
                                                <i class="fa-solid fa-xmark"></i>
                                                Faltou
                                            </span>

                                        <?php } ?>
                                    </td>
                                </tr>

                            <?php endforeach ?>

                        </tbody>

                    </table>

                </div>

                <div class="mt-4">

                    <a href="editarEncontro.php?id=<?= $encontro["id_encontro"] ?>" class="btn btn-primary">
                        <i class="fa-solid fa-pen"></i>
                        Editar
                    </a>

                    <a href="../../controller/Encontros/deleteEncontro.php?id=<?= $encontro["id_encontro"] ?>" class="btn btn-danger">
                        <i class="fa-solid fa-trash"></i>
                        Deletar
                    </a>

                    <a href="index.php" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i>
                        Voltar
                    </a>

                </div>

            </div>

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