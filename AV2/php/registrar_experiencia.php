<?php
require "conexao.php";
require "session.php";
verificarLogin();

$usuario = obterUsuario();

$id_experiencia = $_POST['id_experiencia'];
$telefone = $_POST['telefone'];
$quantidade = $_POST['quantidade'];
$valor_total = $_POST['valor_total'];
$metodo_pagamento = $_POST['metodo_pagamento'];
$parcelas = isset($_POST['parcelas']) ? $_POST['parcelas'] : 1;
$valor_parcela = isset($_POST['valor_parcela']) ? $_POST['valor_parcela'] : $valor_total;

// Se for PIX, força 1 parcela
if ($metodo_pagamento == 'pix') {
    $parcelas = 1;
    $valor_parcela = $valor_total;
}

$sql = "INSERT INTO reservas_experiencias (id_experiencia, nome_cliente, email_cliente, telefone_cliente, 
        quantidade, valor_total, id_usuario, metodo_pagamento, parcelas, valor_parcela)
        VALUES ($id_experiencia, '{$usuario['nome']}', '{$usuario['email']}', '$telefone', 
        $quantidade, $valor_total, {$usuario['id']}, '$metodo_pagamento', $parcelas, '$valor_parcela')";

if ($con->query($sql)) {
    echo "<script>alert('Reserva de experiência concluída!'); window.location.href='../html/index.php';</script>";
} else {
    echo "Erro: " . $con->error;
}
