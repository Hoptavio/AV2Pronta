<?php
require "conexao.php";
require "session.php";
verificarLogin();

$usuario = obterUsuario();

$id_acomodacao = $_POST['id_acomodacao'];
$telefone = $_POST['telefone'];
$data_inicio = $_POST['data_inicio'];
$data_fim = $_POST['data_fim'];
$valor = $_POST['valor_total'];
$pagamento = $_POST['metodo_pagamento'];

if ($pagamento === 'pix') {
    $parcelas = 1;
} else {
    $parcelas = $_POST['parcelas'];
}

$valor_parcela = $valor / $parcelas;

$sql = "INSERT INTO reservas (id_acomodacao, nome_cliente, email_cliente, telefone_cliente, 
        data_inicio, data_fim, valor_total, metodo_pagamento, parcelas, valor_parcela, id_usuario)
        VALUES ($id_acomodacao, '{$usuario['nome']}', '{$usuario['email']}', '$telefone', '$data_inicio', '$data_fim', 
        $valor, '$pagamento', $parcelas, $valor_parcela, {$usuario['id']})";

if ($con->query($sql)) {
    echo "<script>alert('Reserva concluída com sucesso!'); window.location.href='../html/index.php';</script>";
} else {
    echo "Erro ao reservar: " . $con->error;
}
?>
