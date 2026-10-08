<?php
session_start();
include '../includes/database.php';

$admin_logado = true;

if (!$admin_logado) {
    header('Location: login.php');
    exit;
}

// Processar edição de serviços
if ($_POST && isset($_POST['acao']) && $_POST['acao'] == 'editar_servico') {
    $id = $_POST['id'];
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
    $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    
    $stmt = $pdo->prepare("UPDATE servicos SET nome = ?, descricao = ?, preco = ? WHERE id = ?");
    $stmt->execute([$nome, $descricao, $preco, $id]);
    $mensagem = "Serviço atualizado com sucesso!";
}

// Processar edição de fundadores
if ($_POST && isset($_POST['acao']) && $_POST['acao'] == 'editar_fundador') {
    $id = $_POST['id'];
    $dados = [
        filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING),
        filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_STRING),
        filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING),
        filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING),
        filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
        filter_input(INPUT_POST, 'instagram', FILTER_SANITIZE_STRING),
        filter_input(INPUT_POST, 'telegram', FILTER_SANITIZE_STRING),
        $id
    ];
    
    $stmt = $pdo->prepare("UPDATE fundadores SET nome = ?, cargo = ?, descricao = ?, telefone = ?, email = ?, instagram = ?, telegram = ? WHERE id = ?");
    $stmt->execute($dados);
    $mensagem = "Fundador atualizado com sucesso!";
}

$servicos = $pdo->query("SELECT * FROM servicos")->fetchAll();
$fundadores = $pdo->query("SELECT * FROM fundadores")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Serviços - Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="admin-container">
        <h1>Gerenciar Serviços e Fundadores</h1>
        
        <?php if(isset($mensagem)): ?>
            <div class="mensagem-sucesso"><?= $mensagem ?></div>
        <?php endif; ?>

        <h2>Serviços</h2>
        <?php foreach($servicos as $servico): ?>
        <form method="POST" class="form-compact">
            <input type="hidden" name="acao" value="editar_servico">
            <input type="hidden" name="id" value="<?= $servico['id'] ?>">
            <div class="form-inline-group">
                <div class="form-group">
                    <input type="text" name="nome" value="<?= htmlspecialchars($servico['nome']) ?>" required>
                </div>
                <div class="form-group">
                    <input type="number" name="preco" step="0.01" value="<?= $servico['preco'] ?>" required>
                </div>
            </div>
            <div class="form-group">
                <textarea name="descricao" required><?= htmlspecialchars($servico['descricao']) ?></textarea>
            </div>
            <button type="submit" class="btn-editar">Atualizar Serviço</button>
        </form>
        <?php endforeach; ?>

        <h2>Fundadores</h2>
        <?php foreach($fundadores as $fundador): ?>
        <form method="POST" class="form-compact">
            <input type="hidden" name="acao" value="editar_fundador">
            <input type="hidden" name="id" value="<?= $fundador['id'] ?>">
            <div class="form-inline-group">
                <div class="form-group">
                    <input type="text" name="nome" value="<?= htmlspecialchars($fundador['nome']) ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="cargo" value="<?= htmlspecialchars($fundador['cargo']) ?>" required>
                </div>
            </div>
            <div class="form-group">
                <textarea name="descricao" required><?= htmlspecialchars($fundador['descricao']) ?></textarea>
            </div>
            <div class="form-inline-group">
                <div class="form-group">
                    <input type="text" name="telefone" value="<?= htmlspecialchars($fundador['telefone']) ?>">
                </div>
                <div class="form-group">
                    <input type="email" name="email" value="<?= htmlspecialchars($fundador['email']) ?>">
                </div>
            </div>
            <div class="form-inline-group">
                <div class="form-group">
                    <input type="text" name="instagram" value="<?= htmlspecialchars($fundador['instagram']) ?>">
                </div>
                <div class="form-group">
                    <input type="text" name="telegram" value="<?= htmlspecialchars($fundador['telegram']) ?>">
                </div>
            </div>
            <button type="submit" class="btn-editar">Atualizar Fundador</button>
        </form>
        <?php endforeach; ?>

        <br>
        <a href="index.php" class="admin-btn">← Voltar ao Painel</a>
    </div>
</body>
</html>