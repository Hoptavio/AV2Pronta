<?php
require "conexao.php";
require "session.php";
verificarLogin();

$usuario = obterUsuario();

$id_aula = $_POST['id_aula'];
$telefone = $_POST['telefone'];
$quantidade = $_POST['quantidade'];
$valor_total = $_POST['valor_total'];

$sql = "INSERT INTO reservas_aulas (id_aula, nome_cliente, email_cliente, telefone_cliente, 
        quantidade, valor_total, id_usuario)
        VALUES ($id_aula, '{$usuario['nome']}', '{$usuario['email']}', '$telefone', 
        $quantidade, $valor_total, {$usuario['id']})";

if ($con->query($sql)) {
    echo "<script>alert('Reserva de aula concluída!'); window.location.href='../html/index.php';</script>";
} else {
    echo "Erro: " . $con->error;
}
?>
