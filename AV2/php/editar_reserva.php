<?php
require "conexao.php";

if (!isset($_GET['id'])) {
    echo "ID da reserva não informado.";
    exit;
}

$id = intval($_GET['id']);

$stmt = $con->prepare("SELECT * FROM reservas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$reserva = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$reserva) {
    echo "Reserva não encontrada.";
    exit;
}

$res = $con->query("SELECT id, nome, preco FROM acomodacoes ORDER BY nome");
$acomodacoes = [];
while ($row = $res->fetch_assoc()) {
    $acomodacoes[] = $row;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Editar Reserva #<?= htmlspecialchars($reserva['id']) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <h2 class="mb-4">Editar Reserva — #<?= htmlspecialchars($reserva['id']) ?></h2>

    <form id="formEditar" action="atualizar_reserva.php" method="POST" class="card p-4 shadow">

        <input type="hidden" name="id" value="<?= $reserva['id'] ?>">

        <h4>Dados do Cliente</h4>

        <div class="mb-3">
            <label class="form-label">Nome do cliente</label>
            <input type="text" class="form-control" name="nome_cliente" required
                   value="<?= htmlspecialchars($reserva['nome_cliente']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" class="form-control" name="email_cliente" required
                   value="<?= htmlspecialchars($reserva['email_cliente']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" class="form-control" name="telefone_cliente" required
                   value="<?= htmlspecialchars($reserva['telefone_cliente']) ?>">
        </div>

        <hr>

        <h4>Informações da Acomodação</h4>

        <div class="mb-3">
            <label class="form-label">Acomodação</label>
            <select name="id_acomodacao" id="id_acomodacao" class="form-control" required>
                <?php foreach($acomodacoes as $a): 
                    $sel = ($a['id'] == $reserva['id_acomodacao']) ? 'selected' : '';
                ?>
                    <option value="<?= $a['id'] ?>" data-preco="<?= $a['preco'] ?>" <?= $sel ?>>
                        <?= htmlspecialchars($a['nome']) ?> — R$ <?= number_format($a['preco'], 2, ',', '.') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Data de início</label>
                <input type="date" class="form-control" name="data_inicio" id="data_inicio" required
                       value="<?= $reserva['data_inicio'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Data de fim</label>
                <input type="date" class="form-control" name="data_fim" id="data_fim" required
                       value="<?= $reserva['data_fim'] ?>">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Valor total (R$)</label>
            <input type="text" class="form-control" name="valor_total" id="valor_total" readonly
                   value="<?= number_format($reserva['valor_total'], 2, '.', '') ?>">
        </div>

        <hr>

        <h4>Pagamento</h4>

        <div class="mb-3">
            <label class="form-label">Método de pagamento</label>
            <select name="metodo_pagamento" id="metodo_pagamento" class="form-control" required>
                <option value="pix" <?= ($reserva['metodo_pagamento'] == "pix" ? "selected" : "") ?>>PIX</option>
                <option value="cartao" <?= ($reserva['metodo_pagamento'] == "cartao" ? "selected" : "") ?>>Cartão</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Parcelas</label>
            <input type="number" class="form-control" id="parcelas" name="parcelas" min="1" max="12"
                   value="<?= $reserva['parcelas'] ?? 1 ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Valor por parcela (R$)</label>
            <input type="text" class="form-control" id="valor_parcela" name="valor_parcela" readonly
                   value="<?= $reserva['valor_parcela'] ?>">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Salvar alterações</button>
            <a href="../html/admin_reservas.html" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>

<script>

function recalcularValor() {
    const select = document.getElementById('id_acomodacao');
    const preco = parseFloat(select.options[select.selectedIndex].dataset.preco);
    const dataInicio = document.getElementById('data_inicio').value;
    const dataFim = document.getElementById('data_fim').value;

    if (dataInicio && dataFim && preco) {
        const inicio = new Date(dataInicio);
        const fim = new Date(dataFim);
        const dias = Math.ceil((fim - inicio) / (1000 * 60 * 60 * 24));
        
        if (dias > 0) {
            const valorTotal = dias * preco;
            document.getElementById('valor_total').value = valorTotal.toFixed(2);
            calcularValorParcela();
        } else {
            document.getElementById('valor_total').value = '0.00';
            if (dataInicio && dataFim) {
                alert('A data de fim deve ser posterior à data de início!');
            }
        }
    }
}


function calcularValorParcela() {
    const valorTotal = parseFloat(document.getElementById('valor_total').value) || 0;
    const parcelas = parseInt(document.getElementById('parcelas').value) || 1;
    const valorParcela = valorTotal / parcelas;
    document.getElementById('valor_parcela').value = valorParcela.toFixed(2);
}


function controlarMetodoPagamento() {
    const metodoPagamento = document.getElementById('metodo_pagamento').value;
    const parcelasInput = document.getElementById('parcelas');
    
    if (metodoPagamento === 'pix') {

        parcelasInput.value = 1;
        parcelasInput.readOnly = true;
        parcelasInput.style.backgroundColor = '#e9ecef';
    } else {

        parcelasInput.readOnly = false;
        parcelasInput.style.backgroundColor = '';
        if (parcelasInput.value < 1) {
            parcelasInput.value = 1;
        }
    }
    calcularValorParcela();
}


document.getElementById('formEditar').addEventListener('submit', function(e) {
    const dataInicio = document.getElementById('data_inicio').value;
    const dataFim = document.getElementById('data_fim').value;
    const valorTotal = parseFloat(document.getElementById('valor_total').value);
    
    if (dataInicio && dataFim) {
        const inicio = new Date(dataInicio);
        const fim = new Date(dataFim);
        const dias = Math.ceil((fim - inicio) / (1000 * 60 * 60 * 24));
        
        if (dias <= 0) {
            e.preventDefault();
            alert('Erro: A data de fim deve ser posterior à data de início!');
            return false;
        }
    }
    
    if (!valorTotal || valorTotal <= 0) {
        e.preventDefault();
        alert('Erro: O valor total deve ser maior que zero!');
        return false;
    }
});


document.getElementById('id_acomodacao').addEventListener('change', recalcularValor);
document.getElementById('data_inicio').addEventListener('change', recalcularValor);
document.getElementById('data_fim').addEventListener('change', recalcularValor);
document.getElementById('metodo_pagamento').addEventListener('change', controlarMetodoPagamento);
document.getElementById('parcelas').addEventListener('change', calcularValorParcela);


recalcularValor();
controlarMetodoPagamento();
</script>

</body>
</html>
