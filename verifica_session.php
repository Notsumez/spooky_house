<?php 
    // Verifica se o usuário está autenticado
    session_start();

    if (!isset($_SESSION['Id'])) {
        header("Location: login.php"); // Redireciona para a página de login se não houver sessão
        exit;
    }

    if (isset($_POST['logout'])) {
        // Destrua a sessão
        session_destroy();
    
        // Redirecione para a página de login ou qualquer outra página apropriada após o logout
        header('Location: login.php');
        exit;
    }
?>