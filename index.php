<?php
session_start();
include 'includes/database.php';
include 'includes/header.php';
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: pages/login.php');
    exit;
}
?>
<div class="sidebar" id="sidebar">
    <button id="closeSidebar">&times;</button>
    <a></a>
    <?php if(isset($_SESSION['user_logado']) == true): ?>
    <a>Seja bem vindo, <?php echo $_SESSION['user']?></a>
    <?php endif; ?>
    <a href="index.php">Home</a>
    <a href="pages/depoimentos.php">Depoimentos</a>
    <a href="pages/sobre.php">Sobre Nós</a>
    <a href="pages/IA.php">A coisa de IA</a>
    <?php if(isset($_SESSION['admin_logado']) == true): ?>
        <a href="../admin/">Área Admin</a>
    <?php endif; ?>
    <?php if(isset($_SESSION['user_logado']) == true): ?>
        <?php if(isset($_SESSION['admin_logado']) !== true): ?>
                <a href="/pages/agende.php">Agende sua Consulta</a>
        <?php endif; ?>
        <a href="?logout=1">Sair</a>
    <?php endif; ?>
    <?php if(!isset($_SESSION['user_logado'])): ?>
        <a href="pages/login.php">Login</a>
        <a href="pages/cad.php">Cadastro</a>
    <?php endif; ?>
</div>
<button id="openSidebar">&#9776;</button>

<header class="hero">
    <h1 class="curved-text">Você está pronto para desvendar o sagrado oculto?</h1>
</header>

<main>
    <?php
    $servicos = $pdo->query("SELECT * FROM servicos WHERE status = 'ativo'")->fetchAll();
    foreach($servicos as $index => $servico): 
        $class = $index % 2 == 0 ? 'section-left' : 'section-right';
    ?>
    <section class="<?= $class ?> hover-card">
        <h2><?= htmlspecialchars($servico['nome']) ?></h2>
        <div class="hover-content">
            <p><?= htmlspecialchars($servico['descricao']) ?></p>
            <p class="preco">R$ <?= number_format($servico['preco'], 2, ',', '.') ?></p>
        </div>
    </section>
    <?php endforeach; ?>
</main>

<?php include 'includes/footer.php'; ?>