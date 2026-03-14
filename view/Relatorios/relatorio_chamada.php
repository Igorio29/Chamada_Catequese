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

if (isset($_GET['tela'])) {
    date_default_timezone_set("America/Sao_Paulo");
    $data = date("Y-m-d");
}



$catequista_id = $_SESSION['id'];

include "../../conect.php";


$turma_id = $_GET['turma_id'] ?? 0;
$encontros = [];

if ($turma_id) {
    $sql = "SELECT e.data_encontro, c.nome_catequizando, ch.presenca
            FROM tab_chamada ch
            INNER JOIN tab_catequizando c ON c.id_catequizando = ch.catequizando_id
            INNER JOIN tab_encontro e ON e.id_encontro = ch.encontro_id
            WHERE e.turma_id = $turma_id
            ORDER BY e.data_encontro, c.nome_catequizando";

    $resultado = $conn->query($sql);

    while ($row = $resultado->fetch_assoc()) {
        $data = $row['data_encontro'];
        $encontros[$data][] = [
            'nome' => $row['nome_catequizando'],
            'presenca' => $row['presenca']
        ];
    }
}

/* buscar turmas do catequista */

$sql = "SELECT t.id_turma, t.etapa_turma, u.nome_catequista 
        FROM tab_turma t
        JOIN tab_usuario u ON t.catequista_id = u.id_catequista
        WHERE t.catequista_id = $catequista_id";

$result = $conn->query($sql);
$turmas = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Chamada</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome-free-7.2.0-web/css/all.css">
    <link rel="stylesheet" href="../style.css/layout.css">
    <link rel="icon" href="../../img/logo.png">

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
    <main>

        <div class="container mt-4">
            <div class="mb-3">
                <form action="../../controller/Relatorios/relatorioChamada.php" method="post">
                    <label class="form-label">Turma</label>

                    <select name="turma_id" id="turma" class="form-select" required>

                        <option value="">Selecione a turma</option>

                        <?php foreach ($turmas as $t): ?>

                            <option value="<?= $t["id_turma"] ?>">
                                <?= $t["etapa_turma"] ?>º Etapa - <?= $t["nome_catequista"] ?>
                            </option>

                        <?php endforeach; ?>

                    </select>
                    <button type="submit" class="btn mt-2 btn-primary w-100">Filtrar <i class="fa-solid fa-filter"></i></button>
                </form>
            </div>
            <br>
            <hr>
            <br>
            <!-- Card do Relatório -->
            <?php if (!empty($encontros)): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white d-flex">
                    <h4 class="mb-0">Relatório de Chamada</h4>
                    <button class="btn btn-success mb-3 ms-auto" onclick="imprimirRelatorio()">Imprimir Relatório <i class="fa-solid fa-print"></i></button>
                </div>
                <div class="card-body">
                    <?php foreach ($encontros as $data => $alunos): ?>
                        <div class="encontro mb-4 p-3 border rounded" style="background-color: #f8f9fa;">
                            <h5 class="mb-3">Data do Encontro: <?= date('d/m/Y', strtotime($data)) ?></h5>
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nome</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($alunos as $aluno): ?>
                                        <tr class="<?= $aluno['presenca'] ? 'table-success' : 'table-danger' ?>">
                                            <td><?= $aluno['nome'] ?></td>
                                            <td><?= $aluno['presenca'] ? 'Presente' : 'Faltou' ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif?>
    </main>
    <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    
<script>
function imprimirRelatorio() {
    // Pega só o conteúdo do card do relatório
    var conteudo = document.querySelector('.card-body').innerHTML;
    var telaImpressao = window.open('', '', 'height=600,width=800');
    telaImpressao.document.write('<html><head><title>Relatório de Chamada</title>');
    telaImpressao.document.write('<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">'); // mantém estilo
    telaImpressao.document.write('</head><body>');
    telaImpressao.document.write(conteudo);
    telaImpressao.document.write('</body></html>');
    telaImpressao.document.close();
    telaImpressao.focus();
    telaImpressao.print();
    telaImpressao.close();
}
</script>

</body>

</html>