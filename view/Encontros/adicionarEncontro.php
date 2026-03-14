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

if (isset($_GET['tela'])){
    date_default_timezone_set("America/Sao_Paulo");
    $data = date("Y-m-d");
}

$catequista_id = $_SESSION['id'];

include "../../conect.php";

/* buscar turmas do catequista */

$sql = "SELECT t.id_turma, t.etapa_turma, u.nome_catequista 
        FROM tab_turma t
        JOIN tab_usuario u ON t.catequista_id = u.id_catequista
        WHERE t.catequista_id = $catequista_id";

$result = $conn->query($sql);
$turmas = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Encontro</title>

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
            <h2>Novo Encontro</h2>

            <a href="./index.php" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>

        <div class="card shadow-sm">

            <div class="card-body">

                <form action="../../controller/Encontros/createEncontro.php" method="POST">



                    <div class="mb-3">
                        <label class="form-label">Data do Encontro</label>

                        <input type="date"
                            name="data_encontro"
                            class="form-control"
                            value="<?= $data ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tema do Encontro</label>

                        <input type="text"
                            name="tema_encontro"
                            class="form-control"
                            placeholder="Ex: Amor ao próximo"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Frase do Encontro</label>

                        <input type="text"
                            name="frase_encontro"
                            class="form-control"
                            placeholder="Ex: Algum Versiculo"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Observações</label>

                        <textarea name="observacao"
                            class="form-control"
                            rows="3"
                            placeholder="Anotações do encontro"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Turma</label>

                        <select name="turma_id" id="turma" class="form-select" required>

                            <option value="">Selecione a turma</option>

                            <?php foreach ($turmas as $t): ?>

                                <option value="<?= $t["id_turma"] ?>">
                                    <?= $t["etapa_turma"] ?>º Etapa - <?= $t["nome_catequista"] ?>
                                </option>

                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div id="lista-presenca" class="mt-4"></div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="fa-solid fa-plus"></i> Criar Encontro
                    </button>

                </form>

            </div>

        </div>

    </div>

    <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById("turma").addEventListener("change", function() {

            let turma = this.value;

            if (turma === "") return;

            fetch("../../controller/Encontros/getChamada.php?turma_id=" + turma)
                .then(response => response.text())
                .then(data => {
                    document.getElementById("lista-presenca").innerHTML = data;
                });

        });
    </script>

</body>

</html>