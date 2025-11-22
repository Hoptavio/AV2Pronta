<?php
require "conexao.php";

header('Content-Type: application/json');

$sql = "SELECT id, nome, email, data_nascimento, identificador FROM usuarios ORDER BY id";
$result = $con->query($sql);

$usuarios = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

echo json_encode($usuarios);

$con->close();
?>
