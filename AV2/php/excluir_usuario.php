<?php
require "conexao.php";

$id = $_POST['id'];

$sql = "DELETE FROM usuarios WHERE id = $id";

if ($con->query($sql)) {
    echo json_encode(['success' => true, 'message' => 'Usuário excluído com sucesso']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao excluir usuário']);
}
?>
