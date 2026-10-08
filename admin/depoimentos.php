<?php
session_start();
include '../includes/database.php';

// VERIFICAÇÃO DE LOGIN
if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] !== true) {
    header('Location: login.php');
    exit;
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

// Aprovar depoimento
if ($_GET && isset($_GET['acao']) && $_GET['acao'] == 'aprovar') {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("UPDATE depoimentos SET status = 'aprovado' WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: depoimentos.php?msg=aprovado');
    exit;
}

// Rejeitar depoimento
if ($_GET && isset($_GET['acao']) && $_GET['acao'] == 'rejeitar') {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("UPDATE depoimentos SET status = 'rejeitado' WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: depoimentos.php?msg=rejeitado');
    exit;
}

// REMOVER DEPOIMENTO (nova função)
if ($_GET && isset($_GET['acao']) && $_GET['acao'] == 'remover') {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("UPDATE depoimentos SET status = 'removido' WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: depoimentos.php?msg=removido');
    exit;
}

// EXCLUIR PERMANENTEMENTE (opcional)
if ($_GET && isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM depoimentos WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: depoimentos.php?msg=excluido');
    exit;
}

$pagina_titulo = "Gerenciar Depoimentos";
include '../includes/header.php';

// Mensagens de feedback
if (isset($_GET['msg'])) {
    $mensagens = [
        'aprovado' => 'Depoimento aprovado com sucesso!',
        'rejeitado' => 'Depoimento rejeitado!',
        'removido' => 'Depoimento removido do site!',
        'excluido' => 'Depoimento excluído permanentemente!'
    ];
    if (isset($mensagens[$_GET['msg']])) {
        echo '<div class="mensagem-sucesso">' . $mensagens[$_GET['msg']] . '</div>';
    }
}

$depoimentos_pendentes = $pdo->query("SELECT * FROM depoimentos WHERE status = 'pendente' ORDER BY data DESC")->fetchAll();
$depoimentos_aprovados = $pdo->query("SELECT * FROM depoimentos WHERE status = 'aprovado' ORDER BY data DESC")->fetchAll();
$depoimentos_removidos = $pdo->query("SELECT * FROM depoimentos WHERE status = 'removido' ORDER BY data DESC")->fetchAll();
?>

<div class="admin-container">
    <h1>Gerenciar Depoimentos</h1>

    <!-- ABA DE DEPOIMENTOS PENDENTES -->
    <h2>📋 Depoimentos Pendentes (<?= count($depoimentos_pendentes) ?>)</h2>
    <?php if(count($depoimentos_pendentes) > 0): ?>
    <table class="admin-table">
        <tr>
            <th>Nome</th>
            <th>Depoimento</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
        <?php foreach($depoimentos_pendentes as $dep): ?>
        <tr>
            <td><strong><?= htmlspecialchars($dep['nome']) ?></strong></td>
            <td><?= htmlspecialchars($dep['depoimento']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($dep['data'])) ?></td>
            <td>
                <a href="?acao=aprovar&id=<?= $dep['id'] ?>" class="btn-acao btn-aprovar" title="Aprovar">✅</a>
                <a href="?acao=rejeitar&id=<?= $dep['id'] ?>" class="btn-acao btn-rejeitar" title="Rejeitar">❌</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p>🎉 Nenhum depoimento pendente.</p>
    <?php endif; ?>

    <!-- ABA DE DEPOIMENTOS APROVADOS -->
    <h2>✅ Depoimentos Aprovados (<?= count($depoimentos_aprovados) ?>)</h2>
    <?php if(count($depoimentos_aprovados) > 0): ?>
    <table class="admin-table">
        <tr>
            <th>Nome</th>
            <th>Depoimento</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
        <?php foreach($depoimentos_aprovados as $dep): ?>
        <tr>
            <td><strong><?= htmlspecialchars($dep['nome']) ?></strong></td>
            <td><?= htmlspecialchars($dep['depoimento']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($dep['data'])) ?></td>
            <td>
                <a href="?acao=remover&id=<?= $dep['id'] ?>" class="btn-acao" style="background: #ff9800;" title="Remover do site">🚫</a>
                <a href="?acao=excluir&id=<?= $dep['id'] ?>" class="btn-acao btn-rejeitar" title="Excluir permanentemente" onclick="return confirm('Tem certeza que deseja EXCLUIR PERMANENTEMENTE este depoimento?')">🗑️</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p>Nenhum depoimento aprovado.</p>
    <?php endif; ?>

    <!-- ABA DE DEPOIMENTOS REMOVIDOS (OPCIONAL) -->
    <?php if(count($depoimentos_removidos) > 0): ?>
    <details>
        <summary><h2 style="display: inline;">📁 Depoimentos Removidos (<?= count($depoimentos_removidos) ?>)</h2></summary>
        <table class="admin-table">
            <tr>
                <th>Nome</th>
                <th>Depoimento</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
            <?php foreach($depoimentos_removidos as $dep): ?>
            <tr>
                <td><strong><?= htmlspecialchars($dep['nome']) ?></strong></td>
                <td style="opacity: 0.7;"><?= htmlspecialchars($dep['depoimento']) ?></td>
                <td><?= date('d/m/Y H:i', strtotime($dep['data'])) ?></td>
                <td>
                    <a href="?acao=aprovar&id=<?= $dep['id'] ?>" class="btn-acao btn-aprovar" title="Reaprovar">✅</a>
                    <a href="?acao=excluir&id=<?= $dep['id'] ?>" class="btn-acao btn-rejeitar" title="Excluir permanentemente" onclick="return confirm('Tem certeza que deseja EXCLUIR PERMANENTEMENTE este depoimento?')">🗑️</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </details>
    <?php endif; ?>

    <br>
    <a href="index.php" class="admin-btn">← Voltar ao Painel</a>
</div>

<style>
.btn-acao {
    padding: 6px 10px;
    margin: 0 2px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    font-size: 0.9em;
    transition: all 0.3s;
}

.btn-acao:hover {
    transform: scale(1.1);
}

.btn-aprovar {
    background: #4CAF50;
    color: white;
}

.btn-rejeitar {
    background: #f44336;
    color: white;
}

details {
    margin: 20px 0;
    padding: 15px;
    background: rgba(90, 42, 131, 0.3);
    border-radius: 5px;
}

summary {
    cursor: pointer;
    font-weight: bold;
}

summary:hover {
    color: #c9a34a;
}
</style>