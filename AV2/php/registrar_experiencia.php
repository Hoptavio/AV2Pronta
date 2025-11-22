<?php
require "conexao.php";
require "session.php";
verificarLogin();

$usuario = obterUsuario();

$id_experiencia = $_POST['id_experiencia'];
$telefone = $_POST['telefone'];
$quantidade = $_POST['quantidade'];
$valor_total = $_POST['valor_total'];

$sql = "INSERT INTO reservas_experiencias (id_experiencia, nome_cliente, email_cliente, telefone_cliente, 
        quantidade, valor_total, id_usuario)
        VALUES ($id_experiencia, '{$usuario['nome']}', '{$usuario['email']}', '$telefone', 
        $quantidade, $valor_total, {$usuario['id']})";

if ($con->query($sql)) {
    echo "<script>alert('Reserva de experiência concluída!'); window.location.href='../html/index.php';</script>";
} else {
    echo "Erro: " . $con->error;
}
?>
