<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Minha Conta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">

    <?php
    require "../php/session.php";
    verificarLogin();
    $usuario = obterUsuario();
    include 'navbar.php';
    ?>

    <div class="container py-5">
        <h2 class="mb-4">Minha Conta</h2>

        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="acomodacoes-tab" data-bs-toggle="tab" data-bs-target="#acomodacoes" type="button">Acomodações</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="aulas-tab" data-bs-toggle="tab" data-bs-target="#aulas" type="button">Aulas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="experiencias-tab" data-bs-toggle="tab" data-bs-target="#experiencias" type="button">Experiências</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="acomodacoes">
                <h4>Minhas Reservas de Acomodações</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Acomodação</th>
                            <th>Data Início</th>
                            <th>Data Fim</th>
                            <th>Valor Total</th>
                            <th>Pagamento</th>
                        </tr>
                    </thead>
                    <tbody id="listaAcomodacoes"></tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="aulas">
                <h4>Minhas Reservas de Aulas</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Aula</th>
                            <th>Quantidade</th>
                            <th>Valor Total</th>
                        </tr>
                    </thead>
                    <tbody id="listaAulas"></tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="experiencias">
                <h4>Minhas Reservas de Experiências</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Experiência</th>
                            <th>Quantidade</th>
                            <th>Valor Total</th>
                        </tr>
                    </thead>
                    <tbody id="listaExperiencias"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/minha_conta.js"></script>
</body>
</html>
