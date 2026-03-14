<?php
session_start();

if (time() > $_SESSION['expire']) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$catequista_id = $_SESSION['id'];
include("../../controller/TurmasController/getTurmas.php");
$result = $conn->query($sql);
$busca = $result->fetch_all(MYSQLI_ASSOC);

include("../../controller/login/getUsuario.php");
$resultUsuario = $conn->query($sqlUsuario);
$buscaUsuario = $resultUsuario->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Turmas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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


        .turma-card {
            transition: 0.2s;
        }

        .turma-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .etapa {
            font-size: 1.3rem;
            font-weight: 700;
            color: #0d6efd;
        }

        .catequista {
            color: #666;
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

        .botao-inicio {
            text-decoration: none;
            color: white;
        }

        .botao-inicio:hover {
            text-decoration: none;
            color: white;
        }

        a {
            text-decoration: none;
        }

        .a-fazer {
            background-color: red;
        }
    </style>

</head>

<body>
    <!--Popups-->
    <div>


        <?php
        if (isset($_GET['sucesso']) && $_GET['sucesso'] == "true") {
        ?>
            <div id="msg-sucesso" class="alert-sucesso">
                Turma criada com sucesso!
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($_GET['delete']) && $_GET['delete'] == "true") {
        ?>
            <div id="msg-sucesso" class="alert-sucesso-delete">
                Turma Deletada com sucesso!
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($_GET['edit']) && $_GET['edit'] == "true") {
        ?>
            <div id="msg-sucesso" class="alert-sucesso-update">
                Turma Editada com sucesso!
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
                    <a class="nav-link" href="index.php">
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

    <!-- CONTEUDO -->

    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Turmas da Catequese </h2>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#novaTurma">
                Nova Turma
            </button>
        </div>

        <div class="row g-4">

            <?php foreach ($busca as $i): ?>

                <div class="col-12 col-sm-6 col-md-4">

                    <div class="card shadow-sm h-100 turma-card">

                        <div class="card-body">
                            <div class="etapa">
                                <h5 class="card-title">
                                    <?= htmlspecialchars($i['etapa_turma']) ?>ª Etapa - <?= htmlspecialchars($i['ano_turma']) ?>
                                </h5>
                            </div>
                            <p class="card-text text-muted">
                                Catequista: <?= htmlspecialchars($i['nome_catequista']) ?>
                            </p>
                            <input type="hidden" name="" value="<?= htmlspecialchars($i['catequista_id']) ?>">
                            <hr>

                            <div class="d-flex justify-content-between">

                                <a href="turma.php?id=<?= $i['id_turma'] ?>" class="btn btn-outline-primary btn-sm">
                                    Ver turma
                                </a>

                                <div>
                                    <?php
                                    if ($catequista_id == $i['catequista_id']) {
                                    ?>
                                        <a href="#"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editarTurmaModal"
                                            data-id="<?= $i['id_turma'] ?>"
                                            data-etapa="<?= $i['etapa_turma'] ?>"
                                            data-ano="<?= $i['ano_turma'] ?>"
                                            data-catequista="<?= $i['catequista_id'] ?>">
                                            <i class="fa-solid fa-pen-to-square" style="color: rgb(116,192,252);"></i>
                                        </a>

                                        <a href="../../controller/TurmasController/deletarTurma.php?id=<?= $i['id_turma'] ?>">
                                            <i class="fa-solid fa-trash" style="color: rgb(232,75,75);"></i>
                                        </a>
                                    <?php } ?>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>


    <!-- MODAL NOVA TURMA -->

    <div class="modal fade" id="novaTurma">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">Nova Turma</h5>

                    <button class="btn-close" data-bs-dismiss="modal"></button>

                </div>


                <form action="../../controller/TurmasController/createTurma.php" method="POST">

                    <div class="modal-body">

                        <div class="mb-3">

                            <label class="form-label">Etapa</label>

                            <select name="etapa_id" class="form-select" required>

                                <option value="" disabled selected>Selecione</option>
                                <option value="1">1ª Etapa</option>
                                <option value="2">2ª Etapa</option>
                                <option value="3">3ª Etapa</option>
                                <option value="4">4ª Etapa</option>
                                <option value="5">5ª Etapa</option>

                            </select>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">Ano</label>

                            <input type="number" name="ano" class="form-control" value="2026" required>

                        </div>
                    </div>
                    <input type="hidden" name="catequista_id" value="<?= $catequista_id ?>">

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

    <!--MODAL EDITAR TURMA -->
    <div class="modal fade" id="editarTurmaModal">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Editar Turma</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="../../controller/TurmasController/updateTurma.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="id_turma" id="edit_id">

                        <div class="mb-3">
                            <label class="form-label">Etapa</label>

                            <select name="etapa_turma" id="edit_etapa" class="form-select">

                                <option value="1">1ª Etapa</option>
                                <option value="2">2ª Etapa</option>
                                <option value="3">3ª Etapa</option>
                                <option value="4">4ª Etapa</option>
                                <option value="5">5ª Etapa</option>

                            </select>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ano</label>
                            <input type="number" name="ano_turma" id="edit_ano" class="form-control">
                        </div>

                        <select name="catequista_id" id="catequista_id" class="form-select">
                            <?php foreach ($buscaUsuario as $u): ?>
                                <option value="<?= $u['id_catequista'] ?>">
                                    <?= $u['id_catequista'] ?> -
                                    <?= $u['nome_catequista'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Salvar Alterações
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

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

        });


        //REMOVE A MENSAGEM DO URL

        if (window.location.search.includes("sucesso=true")) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }

        if (window.location.search.includes("success=false")) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }

        if (window.location.search.includes("delete=true")) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }

        if (window.location.search.includes("edit=true")) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }


        document.addEventListener("DOMContentLoaded", function() {

            const editarModal = document.getElementById('editarTurmaModal');

            editarModal.addEventListener('show.bs.modal', function(event) {

                const button = event.relatedTarget;

                const id = button.getAttribute('data-id');
                const etapa = button.getAttribute('data-etapa');
                const ano = button.getAttribute('data-ano');
                const catequista = button.getAttribute('data-catequista');

                document.getElementById('edit_id').value = id;
                document.getElementById('edit_etapa').value = etapa;
                document.getElementById('edit_ano').value = ano;
                document.getElementById('catequista_id').value = catequista;

            });

        });
    </script>
    <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>