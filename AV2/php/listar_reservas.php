<?php
require "conexao.php";

$sql = "SELECT r.*, a.nome as nome_acomodacao 
        FROM reservas r 
        JOIN acomodacoes a ON r.id_acomodacao = a.id 
        ORDER BY r.id DESC";

$result = $con->query($sql);

$reservas = [];
while ($row = $result->fetch_assoc()) {
    $reservas[] = $row;
}

echo json_encode($reservas);
?>
