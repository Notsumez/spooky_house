<?php
// Verifica se o usuário está autenticado
$autenticado = false; // Coloque sua lógica de autenticação aqui

if (!$autenticado) {
    header("Location: login.php"); // Redireciona para a página de login
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link para Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Link para o CSS -->
    <link rel="stylesheet" href="CSS/style.css">
    <title>Spooky House</title>
</head>
<body id="fundo_index">
    <!-- Background que faz efeito no fundo do site -->
    <img src="images/elementos/shape-bg.png" class="shape_bg">
    <noscript>Este site necessita de javascript para funcionar.</noscript>
    <main>
        <!-- Header do index -->
        <?php include 'header.php'; ?>
        
        <!-- Conteúdo da página inicial -->
        <?php include 'conteudo.php';?>
        
        <!-- Conteudo da página Sobre -->
        <?php include 'sobre.php';?>

        <!-- Footer do index -->
        <?php include 'footer.php'; ?>
    </main>
</body>
    <!-- Link para Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Link para as funções JavaScript -->
    <script src="js/script.js"></script>
</html>