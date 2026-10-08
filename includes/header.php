<?php
$pagina_atual = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arcanistas - <?= 
        $pagina_atual == 'index.php' ? 'Home' :
        ($pagina_atual == 'depoimentos.php' ? 'Depoimentos' :
        ($pagina_atual == 'sobre.php' ? 'Sobre Nós' :
        ($pagina_atual == 'agende.php' ? 'Agende sua Consulta' : 
        ($pagina_atual == 'cad.php' ? 'Cadastro' : 
        ($pagina_atual == 'login.php' ? 'Login' : 
        ($pagina_atual == 'IA.php' ? 'IA' : 'Home'))))))
    ?></title>
    <link rel="icon" href="../assets/img/favicon.ico">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/main.js" defer></script>
</head>
<body>