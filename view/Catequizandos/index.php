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

include "../../controller/catequizando/catequizandoAll.php";

$stmt = $conn->prepare("
SELECT t.etapa_turma, u.nome_catequista, t.id_turma 
FROM tab_turma t
JOIN tab_usuario u ON u.id_catequista = t.catequista_id
WHERE t.catequista_id = ?
");

$stmt->bind_param("i", $catequista_id);
$stmt->execute();
$resultTurmaAll = $stmt->get_result();
$turma = $resultTurmaAll->fetch_all(MYSQLI_ASSOC);
$num_chamada = 1;
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catequizandos</title>
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

        a {
            text-decoration: none;
        }

        .a-fazer {
            background-color: red;
        }
    </style>
</head>

<body>

    <?php
    if (isset($_GET['sucesso']) && $_GET['sucesso'] === "true") {
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
                    <a class="nav-link" href="../Encontros/adicionarEncontro.php?tela=1">
                        <i class="fa-solid fa-clipboard-check"></i>
                        Fazer Chamada
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="fa-solid fa-user"></i>
                        Catequizandos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../Turmas/index.php">
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

                <li class="nav-item a-fazer">
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
            <h2>Catequizandos </h2>
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

                            <div class="mb-3">
                                <label class="form-label">Turma</label>

                                <select name="turma_id" class="form-select">
                                    <?php foreach ($turma as $u): ?>
                                        <option value="<?= $u['id_turma'] ?>">
                                            <?= $u['etapa_turma'] ?>º Etapa -
                                            <?= $u['nome_catequista'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="tela" value="1">
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancelar
                            </button>

                            <button type="submit" class="btn btn-primary"
                                onclick="this.disabled=true; this.form.submit();">
                                Criar Catequizando
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
        <div class="modal fade" id="editarCatequizandomodal">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title">Editar Catequizando</h5>

                        <button class="btn-close" data-bs-dismiss="modal"></button>

                    </div>


                    <form action="../../controller/catequizando/updateCatequizando.php" method="POST">

                        <div class="modal-body">

                            <div class="mb-3">

                                <label class="form-label">Nome</label>

                                <input type="text" class="form-control" name="nome" id="edit_nome">

                            </div>

                            <div class="mb-3">

                                <label class="form-label">Data Nascimento</label>

                                <input type="date" class="form-control" name="dataNascimento" id="edit_nascimento">

                            </div>
                            <div class="mb-3">

                                <label class="form-label">Telefone do Responsavel</label>

                                <input type="text" class="form-control" id="edit_telefone" placeholder="(41) 00000-0000" name="tel">

                            </div>
                            <div class="mb-3">

                                <label class="form-label">Turma</label>

                                <select name="turma_id" id="edit_turma" class="form-select">
                                    <?php foreach ($turma as $t): ?>
                                        <option value="<?= $t['id_turma'] ?>">
                                            <?= $t['etapa_turma'] ?>º Etapa -
                                            <?= $t['nome_catequista'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                        </div>
                        <input type="hidden" name="id_catequizando" id="edit_id">
                        <input type="hidden" name="turma_atual" id="edit_turma_atual">
                        <input type="hidden" name="tela" value="1">
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancelar
                            </button>

                            <button type="submit" class="btn btn-primary"
                                onclick="this.disabled=true; this.form.submit();">
                                Salvar Catequizando
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
        <div class="table-responsive">
            <table class="table table-hover mt-5">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Turma</th>
                        <th scope="col">Catequista</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($catequizando as $b) { ?>
                        <tr>
                            <th scope="row"><?php echo $num_chamada++; ?></th>
                            <td><?= $b['nome_catequizando'] ?></td>
                            <td><?= ($b['etapa_turma']) ?>º Etapa</td>
                            <td><?= $b['nome_catequista'] ?></td>
                            <td>
                                <?php
                                if ($catequista_id == $b['catequista_id']) {
                                ?>
                                    <a href="#"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editarCatequizandomodal"
                                        data-id="<?= $b['id_catequizando'] ?>"
                                        data-nome="<?= $b['nome_catequizando'] ?>"
                                        data-nascimento="<?= $b['data_nascimento'] ?>"
                                        data-telefone="<?= $b['telefone_responsavel'] ?>"
                                        data-turma="<?= $b['turma_id'] ?>">
                                        <i class="fa-solid fa-pen-to-square" style="color: rgb(116,192,252);"></i>
                                    </a>

                                    <a href="../../controller/catequizando/deleteCatequizando.php?id=<?= $b['id_catequizando'] ?>&tela=1"> <i class="fa-solid fa-trash" style="color: rgb(232,75,75);"></i>
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $('#telefone').mask('(00) 00000-0000');
        $('#edit_telefone').mask('(00) 00000-0000');
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

        /*f (window.location.search.includes("sucesso=true")) {
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
         }*/
    </script>
</body>

</html>