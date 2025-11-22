<?php
require "../php/session.php";
verificarLogin();
$usuario = obterUsuario();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pagar Experiência</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 id="titulo">Finalizar Reserva de Experiência</h2>
            <a href="../php/logout.php" class="btn btn-danger">Sair</a>
        </div>

        <form action="../php/registrar_experiencia.php" method="POST" class="card p-4">

            <input type="hidden" name="id_experiencia" id="id_experiencia">
            <input type="hidden" id="preco" name="preco">

            <h4>Experiência</h4>
            <div class="mb-3">
                <label>Selecione</label>
                <select id="select_experiencia" class="form-control" required>
                    <option value="">Carregando...</option>
                </select>
            </div>

            <h4>Seus Dados</h4>

            <div class="mb-3">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" value="<?php echo $usuario['nome']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" value="<?php echo $usuario['email']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label>Telefone</label>
                <input type="text" name="telefone" class="form-control" required>
            </div>

            <hr>

            <h4>Quantidade</h4>

            <div class="mb-3">
                <label>Quantidade</label>
                <input type="number" name="quantidade" id="quantidade" class="form-control" value="1" min="1" required>
            </div>

            <div class="mb-3">
                <label>Valor total</label>
                <input type="text" id="valor" name="valor_total" class="form-control" readonly>
            </div>

            <button class="btn btn-success w-100 mt-3">Confirmar Reserva</button>

        </form>
    </div>

    <script src="../js/experiencia_pagar.js"></script>

</body>
</html>
