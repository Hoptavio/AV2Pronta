<?php
require "conexao.php";

$sql = "SELECT id, nome, preco FROM aulas";
$result = $con->query($sql);

$dados = [];

while ($row = $result->fetch_assoc()) {
    $dados[] = $row;
}

echo json_encode($dados);
