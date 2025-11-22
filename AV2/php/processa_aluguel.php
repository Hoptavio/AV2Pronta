<?php
require "conexao.php";

$id          = $_POST['id_acomodacao'];
$nome        = $_POST['nome'];
$email       = $_POST['email'];
$telefone    = $_POST['telefone'];
$data_inicio = $_POST['data_inicio'];
$data_fim    = $_POST['data_fim'];
$valor       = $_POST['valor_total'];

$pagamento   = $_POST['metodo_pagamento'];

// Se for PIX, sempre 1 parcela
if ($pagamento === 'pix') {
    $parcelas = 1;
} else {
    $parcelas = !empty($_POST['parcelas']) ? intval($_POST['parcelas']) : 1;
}

// Calcular valor por parcela
$valor_parcela = $valor / $parcelas;

$sql = "INSERT INTO reservas
(id_acomodacao, nome_cliente, email_cliente, telefone_cliente, data_inicio, data_fim, valor_total, metodo_pagamento, parcelas, valor_parcela)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($sql);

$stmt->bind_param("isssssdsddi",
    $id, $nome, $email, $telefone, $data_inicio, $data_fim, $valor,
    $pagamento, $parcelas, $valor_parcela
);

if ($stmt->execute()) {
    echo "<script>alert('Reserva concluída com sucesso!'); window.location.href='../html/index.html';</script>";
} else {
    echo "Erro ao reservar: " . $con->error;
}
?>
