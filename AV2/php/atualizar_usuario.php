<?php
require "conexao.php";

header('Content-Type: application/json');

$id = $_POST['id'] ?? '';
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$data_nascimento = $_POST['data_nascimento'] ?? '';
$identificador = $_POST['identificador'] ?? '';

if (empty($id) || empty($nome) || empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Dados obrigatórios não fornecidos']);
    exit;
}

$sql = "UPDATE usuarios SET nome = ?, email = ?, data_nascimento = ?, identificador = ? WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ssssi", $nome, $email, $data_nascimento, $identificador, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Usuário atualizado com sucesso']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao atualizar usuário: ' . $con->error]);
}

$stmt->close();
$con->close();
?>
