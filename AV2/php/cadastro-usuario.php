<?php
require "conexao.php";

$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST['senha'];
$data_nasc = $_POST["data_nascimento"];

$sql = "INSERT INTO usuarios (nome, email, senha, data_nascimento, identificador)
        VALUES ('$nome', '$email', '$senha', '$data_nasc', 'U')";

if ($con->query($sql)) {
    echo "OK";
} else {
    echo "Erro ao cadastrar usuário.";
}
?>
