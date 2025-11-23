<?php
require "conexao.php";


if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit("Requisição inválida");

$id = intval($_POST['id']);
$nome = $_POST['nome_cliente'];
$email = $_POST['email_cliente'];
$telefone = $_POST['telefone_cliente'];
$id_aula = intval($_POST['id_aula']);
$qtd = intval($_POST['quantidade']);
$metodo_pagamento = $_POST['metodo_pagamento'];
$parcelas = intval($_POST['parcelas']);
$valor_parcela = floatval($_POST['valor_parcela']);


$stmt = $con->prepare("SELECT preco FROM aulas WHERE id=?");
$stmt->bind_param("i", $id_aula);
$stmt->execute();
$preco = $stmt->get_result()->fetch_assoc()['preco'];
$stmt->close();

$valor_total = $preco * $qtd;


$stmt = $con->prepare("UPDATE reservas_aulas SET id_aula=?, nome_cliente=?, email_cliente=?, telefone_cliente=?, quantidade=?, valor_total=?, metodo_pagamento=?, parcelas=?, valor_parcela=? WHERE id=?");
$stmt->bind_param("isssidsdii", $id_aula, $nome, $email, $telefone, $qtd, $valor_total, $metodo_pagamento, $parcelas, $valor_parcela, $id);
$stmt->execute();

header("Location: ../html/admin_reservas_aulas.html");
exit;
