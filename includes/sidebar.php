<?php
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../pages/login.php');
    exit;
}?>
<div class="sidebar" id="sidebar">
    <button id="closeSidebar">&times;</button>
    <a></a>
    <?php if(isset($_SESSION['user_logado']) == true): ?>
    <a>Seja bem vindo, <?php echo $_SESSION['user']?></a>
    <?php endif; ?>
    <a href="../index.php">Home</a>
    <a href="../pages/depoimentos.php">Depoimentos</a>
    <a href="../pages/sobre.php">Sobre Nós</a>
    <a href="../pages/IA.php">A coisa de IA</a>
    <?php if(isset($_SESSION['admin_logado']) == true): ?>
        <a href="../admin/">Área Admin</a>
    <?php endif; ?>
    <?php if(isset($_SESSION['user_logado']) == true): ?>
        <?php if(isset($_SESSION['admin_logado']) !== true): ?>
                <a href="../pages/agende.php">Agende sua Consulta</a>
        <?php endif; ?>
        <a href="?logout=1">Sair</a>
    <?php endif; ?>
    <?php if(!isset($_SESSION['user_logado'])): ?>
        <a href="../pages/login.php">Login</a>
        <a href="../pages/cad.php">Cadastro</a>
    <?php endif; ?>
</div>
<button id="openSidebar">&#9776;</button>