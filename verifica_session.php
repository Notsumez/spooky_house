<?php 
    // Verifica se o usuário está autenticado
    session_start();

    if (!isset($_SESSION['Id'])) {
        header("Location: login.php"); // Redireciona para a página de login se não houver sessão
        exit;
    }
?>