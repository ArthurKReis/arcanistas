<?php
session_start();
include '../includes/database.php';
include '../includes/header.php';
include '../includes/sidebar.php';



if ($_POST && isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $users = $pdo->query("SELECT * FROM users where user = '$usuario' and pass = '$senha'");
    $row = $users->fetchColumn();
    
    if ($row > 0) {

        if($usuario == 'admin' && $senha == 'admin'){
            $_SESSION['admin_logado'] = true;
            $_SESSION['user_logado'] = true;
            $_SESSION['admin_usuario'] = $usuario;
            $_SESSION['user'] = $usuario;
            header('Location: ../admin/index.php');
        }  else{
            $_SESSION['user_logado'] = true;
            $_SESSION['user'] = $usuario;
            header('Location: ../index.php');
        
            }
}else{
            $erro = "Usuário não encontrado.";
        }
}

// Se já estiver logado, redireciona
if (isset($_SESSION['admin_logado']) && $_SESSION['admin_logado'] === true) {
    header('Location: ../admin/index.php');
    exit;
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
    align-items: center;
}
.login-container input {
width: 80%;
}
</style>
<div class="login-container">
        <p>Arcanistas - Login</p>
        
        <?php if(isset($erro)): ?>
            <div class="mensagem-erro"><?= $erro ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <input type="hidden" name="login" value="1">
            <label>Usuário</label><br>
            <input type="text" name="usuario" placeholder="Usuário" required><br><br>
            <label>Senha</label><br>
            <input type="password" name="senha" placeholder="Senha" required><br><br>
            <button type="submit" style="width: 50%; padding: 12px; margin-top: 15px;" name="login">Entrar</button>
        </form>
    <a href="../pages/cad.php"><button style="width: 50%; padding: 12px; margin-top: 15px;">Não tenho uma conta</button></a>
</div>
<?php include '../includes/footer.php'; ?>