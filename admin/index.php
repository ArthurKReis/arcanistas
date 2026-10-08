<?php
session_start();
include '../includes/database.php';
include '../includes/header.php';
include '../includes/sidebar.php';

// VERIFICAÇÃO DE LOGIN - ADICIONAR EM TODOS OS ARQUIVOS ADMIN
if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] !== true) {
    header('Location: ../pages/login.php');
    exit;
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../pages/login.php');
    exit;
}

// Estatísticas
$total_depoimentos = $pdo->query("SELECT COUNT(*) FROM depoimentos")->fetchColumn();
$depoimentos_pendentes = $pdo->query("SELECT COUNT(*) FROM depoimentos WHERE status = 'pendente'")->fetchColumn();
$total_agendamentos = $pdo->query("SELECT COUNT(*) FROM agendamentos")->fetchColumn();
?>
    <div class="admin-container">
        <div style="display: flex; justify-content: between; align-items: center;">
            <h1>Painel Administrativo - Arcanistas</h1>
            <div style="margin-left: auto;">
                <span>Bem-vindo, <?= htmlspecialchars($_SESSION['admin_usuario']) ?>!</span>
                <a href="?logout=1" class="admin-btn" style="margin-left: 15px;">Sair</a>
            </div>
        </div>
        
        <div class="admin-stats">
            <div class="stat-card">
                <h3>Total Depoimentos</h3>
                <p><?= $total_depoimentos ?></p>
            </div>
            <div class="stat-card">
                <h3>Depoimentos Pendentes</h3>
                <p><?= $depoimentos_pendentes ?></p>
            </div>
            <div class="stat-card">
                <h3>Total Agendamentos</h3>
                <p><?= $total_agendamentos ?></p>
            </div>
        </div>

        <nav class="admin-nav">
            <a href="depoimentos.php" class="admin-btn"> Gerenciar Depoimentos</a>
            <a href="agendamentos.php" class="admin-btn"> Ver Agendamentos</a>
            <a href="servicos.php" class="admin-btn"> Gerenciar Serviços</a>
            <a href="../index.php" class="admin-btn"> Voltar ao Site</a>
        </nav>
    </div>
</body>
</html>