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
            session_name($cpf);

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

                // Armazena os dados do cliente na sessão
                $_SESSION['id_usuario'] = $row['id'];
                header('location: index.php');
            } else {
                // CPF não encontrado em nenhuma tabela
                header('location: login.php?erro=s');
                exit;
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
    <!-- ==================================== MODAL ====================================== -->

    <!-- código para o modal -->
    <?php if(isset($_GET['erro']) && ($_GET['erro'] == "s")){?>
            <script>
                $(document).ready(function() {
                    $('#modal_erro').modal('show');
                });
            </script>
        <?php }?>  
        <!-- Fim do modal -->

    <div class="modal fade" tabindex="-1" id="modal_erro">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ATENÇÃO !</h5>
                    <button type="button" class="btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Senha ou CPF incorretos.</p>
                </div>
            </div>
        </div>
    </div>
</body>
    <!-- Link para Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Link para as funções JavaScript -->
    <script src="js/script.js"></script>
</html>