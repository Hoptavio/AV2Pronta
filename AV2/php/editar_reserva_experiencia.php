<?php
require "conexao.php";

$id = intval($_GET['id'] ?? 0);

$stmt = $con->prepare("SELECT * FROM reservas_experiencias WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$reserva = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$reserva) {
    echo "Reserva não encontrada!";
    exit;
}

$result = $con->query("SELECT id, nome, preco FROM experiencias");
$experiencias = [];
while ($row = $result->fetch_assoc()) $experiencias[] = $row;
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Reserva — Experiência</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <div class="container py-5">

        <h3>Editar Reserva — ID <?php echo $reserva['id']; ?></h3>

        <form action="atualizar_reserva_experiencia.php" method="POST" class="card p-4 shadow">

            <input type="hidden" name="id" value="<?php echo $reserva['id']; ?>">

            <div class="mb-3">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome_cliente" value="<?php echo htmlspecialchars($reserva['nome_cliente']); ?>" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="form-control" name="email_cliente" value="<?php echo htmlspecialchars($reserva['email_cliente']); ?>" required>
            </div>

            <div class="mb-3">
                <label>Telefone</label>
                <input type="text" class="form-control" name="telefone_cliente" value="<?php echo htmlspecialchars($reserva['telefone_cliente']); ?>" required>
            </div>

            <div class="mb-3">
                <label>Experiência</label>
                <select name="id_experiencia" id="id_experiencia" class="form-control" required>
                    <?php foreach ($experiencias as $exp): ?>
                        <option
                            value="<?php echo $exp['id']; ?>"
                            data-preco="<?php echo $exp['preco']; ?>"
                            <?php echo ($exp['id'] == $reserva['id_experiencia']) ? "selected" : ""; ?>>
                            <?php echo htmlspecialchars($exp['nome']); ?> — R$ <?php echo $exp['preco']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Quantidade</label>
                <input type="number" class="form-control" name="quantidade" id="quantidade" min="1" required value="<?php echo $reserva['quantidade']; ?>">
            </div>

            <div class="mb-3">
                <label>Valor Total</label>
                <input type="text" class="form-control" id="valor_total" name="valor_total" readonly value="<?php echo $reserva['valor_total']; ?>">
            </div>

            <div class="mb-3">
                <label>Método de Pagamento</label>
                <select name="metodo_pagamento" class="form-control">
                    <option value="pix" <?php echo ($reserva['metodo_pagamento'] ?? '') == 'pix' ? 'selected' : ''; ?>>PIX</option>
                    <option value="cartao" <?php echo ($reserva['metodo_pagamento'] ?? '') == 'cartao' ? 'selected' : ''; ?>>Cartão de Crédito</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Parcelas</label>
                <input type="number" name="parcelas" class="form-control" value="<?php echo $reserva['parcelas'] ?? ''; ?>">
            </div>

            <div class="mb-3">
                <label>Valor da Parcela</label>
                <input type="text" name="valor_parcela" class="form-control" value="<?php echo $reserva['valor_parcela'] ?? ''; ?>">
            </div>

            <div class="d-flex gap-3">
                <button class="btn btn-primary">Salvar</button>
                <a href="../html/admin_reservas_experiencias.html" class="btn btn-secondary">Voltar</a>
            </div>

        </form>

    </div>

    <script src="../js/editar_reserva_experiencia.js"></script>

</body>

</html>