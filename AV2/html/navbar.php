<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$logado = isset($_SESSION['usuario_id']);
$nomeUsuario = $logado ? $_SESSION['usuario_nome'] : '';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-dark" href="index.php">Alugel Maneiro</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="vagas.php">Acomodações</a></li>
                <li class="nav-item"><a class="nav-link" href="experiencias.php">Experiências</a></li>
                <li class="nav-item"><a class="nav-link" href="servicos.php">Serviços</a></li>
                <?php if ($logado): ?>
                    <li class="nav-item"><a class="nav-link" href="minha_conta.php">Conta (<?php echo $nomeUsuario; ?>)</a></li>
                    <li class="nav-item"><a class="nav-link" href="../php/logout.php">Sair</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
