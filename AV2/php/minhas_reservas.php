<?php
require "conexao.php";
require "session.php";
verificarLogin();

$usuario = obterUsuario();
$tipo = $_GET['tipo'];

if ($tipo === 'acomodacoes') {
    $sql = "SELECT r.*, a.nome as nome_acomodacao 
            FROM reservas r 
            JOIN acomodacoes a ON r.id_acomodacao = a.id 
            WHERE r.email_cliente = '{$usuario['email']}'
            ORDER BY r.id DESC";
} elseif ($tipo === 'aulas') {
    $sql = "SELECT r.*, a.nome as nome_aula 
            FROM reservas_aulas r 
            JOIN aulas a ON r.id_aula = a.id 
            WHERE r.email_cliente = '{$usuario['email']}'
            ORDER BY r.id DESC";
} elseif ($tipo === 'experiencias') {
    $sql = "SELECT r.*, e.nome as nome_experiencia 
            FROM reservas_experiencias r 
            JOIN experiencias e ON r.id_experiencia = e.id 
            WHERE r.email_cliente = '{$usuario['email']}'
            ORDER BY r.id DESC";
} else {
    echo json_encode([]);
    exit;
}

$result = $con->query($sql);
$dados = [];

while ($row = $result->fetch_assoc()) {
    $dados[] = $row;
}

echo json_encode($dados);
