<?php
session_start();
include '../includes/database.php';
include '../includes/header.php';
include '../includes/sidebar.php';

// Buscar dados dos fundadores
$fundadores = $pdo->query("SELECT * FROM fundadores")->fetchAll();
?>

<main>
    <h1>Sobre Nós</h1>
    <section class="founders">
        <?php foreach($fundadores as $fundador): ?>
        <div class="card">
            <img src="../assets/img/placeholder.png" alt="<?= htmlspecialchars($fundador['nome']) ?>">
            <h3><?= htmlspecialchars($fundador['nome']) ?></h3>
            <p><?= htmlspecialchars($fundador['descricao']) ?></p>
            <p>Telefone: <?= htmlspecialchars($fundador['telefone']) ?> | E-mail: <?= htmlspecialchars($fundador['email']) ?></p>
            <p>Instagram: <?= htmlspecialchars($fundador['instagram']) ?> | Telegram: <?= htmlspecialchars($fundador['telegram']) ?></p>
        </div>
        <?php endforeach; ?>
    </section>
    <div class="contact-info">
        <p>Endereço: Rua Mística, 123, São Paulo</p>
    </div>
</main>

<?php include '../includes/footer.php'; ?>