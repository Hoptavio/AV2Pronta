<?php
require "conexao.php";

$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
$identificador = $_POST['identificador'];

$sql = "UPDATE usuarios SET nome='$nome', email='$email', data_nascimento='$data_nascimento', 
        identificador='$identificador' WHERE id=$id";

if ($con->query($sql)) {
    echo json_encode(['success' => true, 'message' => 'Usuário atualizado com sucesso']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao atualizar usuário']);
}
?>
