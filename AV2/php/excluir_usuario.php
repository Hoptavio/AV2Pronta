<?php
require "conexao.php";

header('Content-Type: application/json');

$id = $_POST['id'] ?? '';

if (empty($id)) {
    echo json_encode(['success' => false, 'message' => 'ID não fornecido']);
    exit;
}

// Verifica se o usuário existe
$sql = "SELECT id FROM usuarios WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Usuário não encontrado']);
    exit;
}

// Exclui o usuário
$sql = "DELETE FROM usuarios WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Usuário excluído com sucesso']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao excluir usuário: ' . $con->error]);
}

$stmt->close();
$con->close();
?>
