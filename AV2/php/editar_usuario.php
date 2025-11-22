<?php
require "conexao.php";

header('Content-Type: application/json');

$id = $_GET['id'] ?? '';

if (empty($id)) {
    echo json_encode(['error' => 'ID não fornecido']);
    exit;
}

$sql = "SELECT id, nome, email, data_nascimento, identificador FROM usuarios WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    echo json_encode($usuario);
} else {
    echo json_encode(['error' => 'Usuário não encontrado']);
}

$stmt->close();
$con->close();
?>
