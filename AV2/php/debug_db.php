<?php
require "conexao.php";

$tables = ['experiencias', 'acomodacoes', 'aulas'];

foreach ($tables as $table) {
    $sql = "SELECT COUNT(*) as total FROM $table";
    $result = $con->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        echo "$table: " . $row['total'] . "\n";
    } else {
        echo "$table: Error - " . $con->error . "\n";
    }
}
