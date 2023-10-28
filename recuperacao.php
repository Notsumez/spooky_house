<?php 
    session_start();

    // Verifique se a sessão já existe
    if (isset($_SESSION['Id'])) {
    // Sessão já existe, redirecione para a página index
        header('Location: index.php');
        exit;
    }

    // Conexão com o banco de dados
    include 'connection/connect.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link para Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Link do JQUERY -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- Link para o CSS -->
    <link rel="stylesheet" href="CSS/recuperacao.css">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="shortcut icon" href="images/Elementos/favicon.png" type="image/x-png">
    <title>Recuperação - Spooky House</title>
</head>
<body class="fundo_login">
    <main style="padding: 50px;">
        <div class="form-container inflar">
            <p class="title Sometype">Recuperação de Conta</p>
            <p class="text-white text-center"> Digite suas informações de acordo com o que foi preenchido no cadastro.</p>
            <form action="enviar_mail.php" method="post" class="form" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" onkeypress="$(this).mask('000.000.000-00');" placeholder="">
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="">
                </div>
                <div class="input-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" name="telefone" id="telefone" placeholder="">
                </div>
                <br>
                <button type="submit" name="codBTN" class="sign">Enviar Código</button>
            </form>
            <br>
            <p class="signup">Não tem uma conta?
                <a rel="noopener noreferrer" href="cadastro.php" class="">Inscreva-se</a>
            </p>
        </div>
    </main>
</body>
</html>