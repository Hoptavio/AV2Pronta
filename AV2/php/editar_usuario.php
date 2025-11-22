<?php
require "conexao.php";

$id = $_GET['id'];

$sql = "SELECT id, nome, email, data_nascimento, identificador FROM usuarios WHERE id = $id";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(['error' => 'Usuário não encontrado']);
}
?>
