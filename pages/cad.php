<?php
session_start();
include '../includes/database.php';
include '../includes/header.php';
include '../includes/sidebar.php';

if ($_POST && isset($_POST['cad'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $confsenha = $_POST['confsenha'];
    
        if ($senha != $confsenha) {
            $erro = "Senha não confere";
        } else {
            $query = "INSERT INTO users (user, pass) VALUES('$usuario', '$senha')";
            $pdo->query($query);
            if ($pdo == false){
                $erro = "Não foi possível realizar o cadastro.";
            }else {
                $suc = "Usuario cadastrado com sucesso!";
            }
        }
}
?>
<style>
    .login-container {
    max-width: 400px;
    margin: 100px auto;
    padding: 30px 30px 30px;
    background: #5a2a83;
    border-radius: 10px;
    text-align: center;
}
.login-container input {
width: 80%;
}
</style>

<div class="login-container">
    <p>Arcanistas - Cadastro</p>
        <?php if(isset($erro)): ?>
            <div class="mensagem-erro"><?= $erro ?></div>
        <?php endif; ?>
                <?php if(isset($suc)): ?>
            <div class="mensagem-sucesso"><?= $suc ?></div>
        <?php endif; ?>
        
        <form action="cad.php" method="POST">
            <input type="hidden" name="cad" value="1">
            <label>Usuário</label><br>
            <input type="text" name="usuario" placeholder="Usuário" required><br><br>
            <label>Senha</label><br>
            <input type="password" name="senha" placeholder="Senha" required><br><br>
            <label>Confirmar senha</label><br>
            <input type="password" name="confsenha" placeholder="Confirmar senha" required><br><br>
            <button type="submit" style="width: 50%; padding: 12px; margin-top: 15px;" name="cad">Realizar cadastro</button>
        </form>
    <a href="../pages/login.php"><button style="width: 50%; padding: 12px; margin-top: 15px;">Já tenho uma conta</button></a>
</div>
<?php include '../includes/footer.php'; ?>