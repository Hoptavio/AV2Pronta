<?php
require "../php/session.php";
verificarLogin();
$usuario = obterUsuario();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Pagar Aula - Alugo & Rio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 id="titulo">Finalizar Reserva de Aula</h2>
            <a href="../php/logout.php" class="btn btn-danger">Sair</a>
        </div>

        <form action="../php/registrar_aula.php" method="POST" class="card p-4" id="formAula">

            <input type="hidden" name="id_aula" id="id_aula">
            <input type="hidden" id="preco" name="preco">

            <h4>Aula / Serviço</h4>
            <div class="mb-3">
                <label>Selecione a aula</label>
                <select id="select_aula" class="form-control" required>
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
                <input type="text" id="total" name="valor_total" class="form-control" readonly>
            </div>

            <hr>

            <h4>Método de Pagamento</h4>

            <div class="mb-3">
                <select id="metodo_pagamento" name="metodo_pagamento" class="form-control" required>
                    <option value="">Selecione...</option>
                    <option value="pix">PIX</option>
                    <option value="cartao">Cartão de Crédito</option>
                </select>
            </div>

            <div id="area_pix" class="p-3 border rounded d-none">
                <p class="fw-bold text-success">Chave PIX: aluguel@empresa.com</p>
                <img src="../img/qrcode_exemplo.png" width="180">
            </div>

            <div id="area_cartao" class="d-none mt-3">

                <div class="mb-3">
                    <label>Número do cartão</label>
                    <input type="text" id="num_cartao" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Nome no cartão</label>
                    <input type="text" id="nome_cartao" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Validade</label>
                    <input type="text" id="validade" class="form-control">
                </div>

                <div class="mb-3">
                    <label>CVV</label>
                    <input type="text" id="cvv" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Parcelas</label>
                    <select name="parcelas" id="parcelas" class="form-control">
                        <option value="1">1x sem juros</option>
                        <option value="2">2x sem juros</option>
                        <option value="3">3x sem juros</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Valor por parcela</label>
                    <input type="text" id="valor_parcela" class="form-control" readonly>
                </div>

            </div>

            <button class="btn btn-success w-100 mt-3">Confirmar Reserva</button>

        </form>
    </div>

    <?php include 'footer.php'; ?>
    <script src="../js/aula_pagar.js"></script>

</body>

</html>