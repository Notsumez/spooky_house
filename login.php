<?php 
    include 'connection/connect.php';

    if ($_POST) {
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];
    
        // Verificar se o CPF está na tabela Clientes
        $query = "SELECT * FROM Clientes WHERE cpf = '$cpf'";
        $result = mysqli_query($conn, $query);
    
        if (mysqli_num_rows($result) > 0) {
            // O CPF pertence a um cliente
            $row = mysqli_fetch_assoc($result);
            // Aqui você pode fazer o que quiser com os dados do cliente
            // Por exemplo, exibir os dados na página ou redirecionar para uma página de perfil do cliente
            
            // Inicie a sessão
                session_start();

            // Armazena os dados do cliente na sessão
            $_SESSION['id_usuario'] = $row['id'];
            header('location: index.php');
        } else {
            // O CPF não pertence a um cliente, vamos verificar se pertence a um funcionário
            $query = "SELECT * FROM Funcionarios WHERE cpf = '$cpf'";
            $result = mysqli_query($conn, $query);
    
            if (mysqli_num_rows($result) > 0) {
                // O CPF pertence a um funcionário
                $row = mysqli_fetch_assoc($result);
                // Aqui você pode fazer o que quiser com os dados do funcionário
                // Por exemplo, exibir os dados na página ou redirecionar para uma página de perfil do funcionário
    
                echo "Funcionário encontrado: " . $row['nome'];
            } else {
                // CPF não encontrado em nenhuma tabela
                echo "CPF não encontrado na base de dados.";
            }
        }
    }
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
    <link rel="stylesheet" href="CSS/login.css">
    <title>Login - Spooky House</title>
</head>
<body class="fundo_login">
    <main style="padding: 50px;">
        <div class="form-container inflar">
            <p class="title Sometype">Bem Vindo à Spooky House!!</p>
            <img src="images/Elementos/foguinho.gif" style="width: 100%;" alt="">
            <form action="login.php" method="post" class="form">
                <div class="input-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" onkeypress="$(this).mask('000.000.000-00');" placeholder="">
                </div>
                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" placeholder="">
                    <div class="forgot">
                        <a rel="noopener noreferrer" href="#">Esqueceu sua senha ?</a>
                    </div>
                </div>
                <button class="sign">Entrar</button>
            </form>
            <br>
            <p class="signup">Não tem uma conta?
                <a rel="noopener noreferrer" href="#" class="">Inscreva-se</a>
            </p>
        </div>
    </main>
</body>
</html>