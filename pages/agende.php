<?php
session_start();
include '../includes/database.php';
include '../includes/header.php';
include '../includes/sidebar.php';

// Processar agendamento
if ($_POST && isset($_POST['acao']) && $_POST['acao'] == 'agendamento') {
    // CAPTCHA
    if (empty($_SESSION['last_agendamento']) || (time() - $_SESSION['last_agendamento']) > 60) {
        $dados = [
            filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING),
            filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING),
            filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
            filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING),
            filter_input(INPUT_POST, 'instagram', FILTER_SANITIZE_STRING),
            filter_input(INPUT_POST, 'telegram', FILTER_SANITIZE_STRING)
        ];
        
        $stmt = $pdo->prepare("INSERT INTO agendamentos (nome, sobrenome, email, telefone, instagram, telegram) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute($dados)) {
            $mensagem = "Agendamento enviado com sucesso! Entraremos em contato.";
            $_SESSION['last_agendamento'] = time();
        }
    } else {
        $erro = "Aguarde 1 minuto para fazer outro agendamento.";
    }
}

$servico = $pdo->query("SELECT * FROM servicos WHERE status = 'ativo' LIMIT 1")->fetch();
?>

<main>
    <h1>Agende sua Consulta</h1>
    <section class="details">
        <p><strong>Detalhes da Consulta:</strong> <?= htmlspecialchars($servico['descricao']) ?></p>
        <p><strong>Preço:</strong> R$ <?= number_format($servico['preco'], 2, ',', '.') ?></p>
    </section>

    <?php if(isset($mensagem)): ?>
        <div class="mensagem-sucesso"><?= $mensagem ?></div>
    <?php endif; ?>
    
    <?php if(isset($erro)): ?>
        <div class="mensagem-erro"><?= $erro ?></div>
    <?php endif; ?>

    <form method="POST" class="form-compact">
        <input type="hidden" name="acao" value="agendamento">
        <div class="form-inline-group">
            <div class="form-group">
                <input type="text" name="nome" placeholder="Nome" required>
            </div>
            <div class="form-group">
                <input type="text" name="sobrenome" placeholder="Sobrenome" required>
            </div>
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="E-mail" required>
        </div>
        <div class="form-group">
            <input type="tel" name="telefone" placeholder="Telefone" required>
        </div>
        <div class="form-inline-group">
            <div class="form-group">
                <input type="text" name="instagram" placeholder="Instagram (opcional)">
            </div>
            <div class="form-group">
                <input type="text" name="telegram" placeholder="Telegram (opcional)">
            </div>
        </div>
        <button type="submit">Agendar</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>