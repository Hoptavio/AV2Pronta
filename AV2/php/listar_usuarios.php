<?php
require "conexao.php";

$sql = "SELECT id, nome, email, data_nascimento, identificador FROM usuarios";
$result = $con->query($sql);

$usuarios = [];
while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}

echo json_encode($usuarios);
?>
