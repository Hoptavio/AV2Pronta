<?php
session_start();

function verificarLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: ../html/login.html");
        exit;
    }
}

function obterUsuario() {
    return [
        'id' => $_SESSION['usuario_id'],
        'nome' => $_SESSION['usuario_nome'],
        'email' => $_SESSION['usuario_email']
    ];
}
?>
