<?php
session_start();
include '../includes/database.php';

$admin_logado = true;

if (!$admin_logado) {
    header('Location: login.php');
    exit;
}

$agendamentos = $pdo->query("SELECT * FROM agendamentos ORDER BY data_agendamento DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Agendamentos - Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="admin-container">
        <h1>Agendamentos (<?= count($agendamentos) ?>)</h1>

        <?php if(count($agendamentos) > 0): ?>
        <table class="admin-table">
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Instagram</th>
                <th>Telegram</th>
                <th>Data</th>
                <th>Status</th>
            </tr>
            <?php foreach($agendamentos as $agendamento): ?>
            <tr>
                <td><?= htmlspecialchars($agendamento['nome'] . ' ' . $agendamento['sobrenome']) ?></td>
                <td><?= htmlspecialchars($agendamento['email']) ?></td>
                <td><?= htmlspecialchars($agendamento['telefone']) ?></td>
                <td><?= htmlspecialchars($agendamento['instagram']) ?></td>
                <td><?= htmlspecialchars($agendamento['telegram']) ?></td>
                <td><?= date('d/m/Y H:i', strtotime($agendamento['data_agendamento'])) ?></td>
                <td><?= htmlspecialchars($agendamento['status']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
            <p>Nenhum agendamento encontrado.</p>
        <?php endif; ?>

        <br>
        <a href="index.php" class="admin-btn">← Voltar ao Painel</a>
    </div>
</body>
</html>