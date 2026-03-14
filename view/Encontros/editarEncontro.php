<?php
session_start();
$id_encontro = $_GET["id"];
if (time() > $_SESSION['expire']) {
    session_destroy();
    header("Location: index.php");
    exit;
}

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit;
}
include "../../conect.php";
include "../../controller/Encontros/getEncontroById.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição Encontro - <?= $encontro["tema"] ?></title>

    <link rel="stylesheet" href="../style.css/layout.css">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome-free-7.2.0-web/css/all.css">

    <style>
        .card {
            border: none;
        }

        .presenca-linha {
            display: flex;
            justify-content: space-between;
            align-items: center;

            padding: 12px 15px;
            margin-bottom: 8px;

            background: #f8f9fa;
            border-radius: 10px;
            border: 1px solid #e5e5e5;
        }

        .nome {
            font-weight: 500;
        }

        /* esconder radio */

        .presenca-botoes input {
            display: none;
        }

        .presenca-botoes {
            display: flex;
            gap: 8px;
        }

        /* botão */

        .btn-presenca {
            padding: 6px 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
            cursor: pointer;
            font-weight: 600;
            transition: 0.2s;
        }

        /* hover */

        .btn-v:hover {
            background: #e8f7ec;
        }

        .btn-f:hover {
            background: #fdeaea;
        }

        /* selecionado */

        #v_:checked+.btn-v {
            background: #28a745;
            color: white;
            border-color: #28a745;
        }

        #f_:checked+.btn-f {
            background: #dc3545;
            color: white;
            border-color: #dc3545;
        }

        input[type="radio"]:checked+.btn-v {
            background: #28a745;
            color: white;
            border-color: #28a745;
        }

        input[type="radio"]:checked+.btn-f {
            background: #dc3545;
            color: white;
            border-color: #dc3545;
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
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Editar Encontro</h2>

            <a href="./encontro.php?id=<?= $id_encontro ?>" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>

        <div class="card shadow-sm">

            <div class="card-body">

                <form action="../../controller/Encontros/editEncontro.php" method="POST">


                    <input type="hidden" name="id_encontro" value="<?= $id_encontro ?>">
                    <div class="mb-3">
                        <label class="form-label">Data do Encontro</label>

                        <input type="date"
                            name="data_encontro"
                            class="form-control"
                            value="<?= $encontro["data_encontro"] ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tema do Encontro</label>

                        <input type="text"
                            name="tema"
                            class="form-control"
                            placeholder="Ex: Amor ao próximo"
                            value="<?= $encontro["tema"] ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Frase do Encontro</label>

                        <input type="text"
                            name="frase_encontro"
                            class="form-control"
                            placeholder="Ex: Algum Versiculo"
                            value="<?= $encontro["frase_encontro"] ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Observações</label>

                        <textarea name="observacao"
                            class="form-control"
                            rows="3"
                            placeholder="Anotações do encontro"><?= $encontro["observacao"] ?></textarea>
                    </div>

                    <div class="mb-3">

                        <input type="hidden" name="turma_id" value="<?= $encontro["turma_id"] ?>">
                    </div>

                    <div id="lista-presenca" class="mt-4">
                        <div class="mt-4">

                            <h5 class="mb-3">
                                <i class="fa-solid fa-clipboard-check"></i>
                                Chamada do Encontro
                            </h5>

                            <div class="card mt-2 shadow-sm">

                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="fa-solid fa-users"></i>
                                        Lista de Presença
                                    </h6>
                                </div>

                                <div class="card-body">

                                    <?php foreach ($chamada as $row): ?>

                                        <div class="presenca-linha d-flex justify-content-between align-items-center mb-2">

                                            <span class="nome">
                                                <?= $row["nome_catequizando"] ?>
                                            </span>

                                            <div class="presenca-botoes">

                                                <input type="radio"
                                                    id="v_<?= $row["id_catequizando"] ?>"
                                                    name="presenca[<?= $row["id_catequizando"] ?>]"
                                                    value="1"
                                                    <?= ($row["presenca"] == 1) ? 'checked' : '' ?>
                                                    required>

                                                <label for="v_<?= $row["id_catequizando"] ?>" class="btn-presenca btn-v">
                                                    V
                                                </label>


                                                <input type="radio"
                                                    id="f_<?= $row["id_catequizando"] ?>"
                                                    name="presenca[<?= $row["id_catequizando"] ?>]"
                                                    value="0"
                                                    <?= ($row["presenca"] == 0) ? 'checked' : '' ?>>

                                                <label for="f_<?= $row["id_catequizando"] ?>" class="btn-presenca btn-f">
                                                    F
                                                </label>

                                            </div>

                                        </div>

                                    <?php endforeach; ?>

                                </div>

                            </div>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="fa-solid fa-plus"></i> Editar Encontro
                    </button>

                </form>

            </div>

        </div>

    </div>



    <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>

       
    </script>

</body>

</html>