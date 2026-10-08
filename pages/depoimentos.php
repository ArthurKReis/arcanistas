<?php
session_start();
include '../includes/database.php';
include '../includes/header.php';
include '../includes/sidebar.php';

// Processar novo depoimento
if ($_POST && isset($_POST['acao']) && $_POST['acao'] == 'depoimento') {
    // Sistema CAPTCHA simples
    if (empty($_SESSION['last_submission']) || (time() - $_SESSION['last_submission']) > 30) {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $depoimento = filter_input(INPUT_POST, 'depoimento', FILTER_SANITIZE_STRING);
        
        $stmt = $pdo->prepare("INSERT INTO depoimentos (nome, depoimento, status) VALUES (?, ?, 'pendente')");
        if ($stmt->execute([$nome, $depoimento])) {
            $mensagem = "Depoimento enviado para moderação!";
            $_SESSION['last_submission'] = time();
        }
    } else {
        $erro = "Aguarde 30 segundos para enviar outro depoimento.";
    }
}

// Buscar depoimentos aprovados
$depoimentos = $pdo->query("SELECT * FROM depoimentos WHERE status = 'aprovado' ORDER BY id DESC")->fetchAll();
?>

<main>
    <h1>Depoimentos</h1>
    <section class="testimonials">
        <div id="testimonial-list">
            <?php foreach($depoimentos as $dep): ?>
            <div class="testimonial">
                <strong><?= htmlspecialchars($dep['nome']) ?></strong>
                <p><?= htmlspecialchars($dep['depoimento']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        
        <?php if(isset($mensagem)): ?>
            <div class="mensagem-sucesso"><?= $mensagem ?></div>
        <?php endif; ?>
        
        <?php if(isset($erro)): ?>
            <div class="mensagem-erro"><?= $erro ?></div>
        <?php endif; ?>

        <form method="POST" class="form-compact">
            <input type="hidden" name="acao" value="depoimento">
            <div class="form-group">
                <input type="text" name="nome" placeholder="Seu nome" required maxlength="100">
            </div>
            <div class="form-group">
                <textarea name="depoimento" placeholder="Seu depoimento (máx. 200 caracteres)" maxlength="200" required></textarea>
            </div>
            <button type="submit">Enviar depoimento</button>
        </form>
    </section>
</main>