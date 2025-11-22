<?php
session_start();
require "conexao.php";

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome'];
    $_SESSION['usuario_email'] = $usuario['email'];
    
    if ($usuario['identificador'] === "A") {
        header("Location: ../html/admin_index.html");
    } else {
        header("Location: ../html/index.php");
    }
} else {
    echo "<script>
            alert('Login inválido!');
            window.location='../html/login.html';
          </script>";
}
?>
