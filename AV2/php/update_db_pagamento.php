<?php
require "conexao.php";

$sql_commands = [
    "ALTER TABLE reservas_aulas ADD COLUMN metodo_pagamento varchar(20) DEFAULT NULL",
    "ALTER TABLE reservas_aulas ADD COLUMN parcelas int(11) DEFAULT NULL",
    "ALTER TABLE reservas_aulas ADD COLUMN valor_parcela decimal(10,2) DEFAULT NULL",

    "ALTER TABLE reservas_experiencias ADD COLUMN metodo_pagamento varchar(20) DEFAULT NULL",
    "ALTER TABLE reservas_experiencias ADD COLUMN parcelas int(11) DEFAULT NULL",
    "ALTER TABLE reservas_experiencias ADD COLUMN valor_parcela decimal(10,2) DEFAULT NULL"
];

echo "<h2>Atualizando Estrutura do Banco de Dados...</h2>";

foreach ($sql_commands as $sql) {
    if ($con->query($sql) === TRUE) {
        echo "<p style='color: green;'>Sucesso: " . htmlspecialchars($sql) . "</p>";
    } else {
        echo "<p style='color: red;'>Erro: " . $con->error . " (SQL: $sql)</p>";
    }
}

echo "<h3>Concluído! Você pode apagar este arquivo agora.</h3>";
