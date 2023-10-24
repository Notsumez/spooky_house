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

    if ($_POST) {
        $cpf_enviado = $_POST['cpf'];
        $senha_enviada = $_POST['senha'];
    
        // Seleciona o cpf do usuário logado
        $selectCpf = $conn->query("SELECT cpf, id FROM Clientes WHERE cpf = '".$cpf_enviado."';");
        $dadosCliente = $selectCpf->fetch_assoc();
        
        if ($dadosCliente){
            $select_cpf = $dadosCliente['cpf'];
            $selectCpfId = $dadosCliente['id'];
            
            // criptografia da senha
            $senhafinal = md5($senha_enviada);
            
            // Limita a senha a 12 caracteres
            $hash_md5_12 = substr($senhafinal, 0, 8);
            
            // remove o ponto do cpf
            $cpf_semPonto = str_replace('.', '', $select_cpf);

            // pega só os 5 primeiros caracteres do cpf
            $cpf_cortado = substr($cpf_semPonto, 0, 5);
        
            // criptografa a os 5 primeiros caracteres do cpf
            $cpf_quase_final = md5($cpf_cortado);
        
            // limita o hash a 5 caracteres
            $cpf_final = substr($cpf_quase_final, 0, 5);
            $senha_criptografada = 'Cli' . $selectCpfId . $hash_md5_12 . 'Spooky-' . $cpf_final;  
        
            $select_Senha = $conn->query("SELECT senha FROM Login_clientes where id_cliente = '$selectCpfId'");
            $row_Senha = $select_Senha->fetch_assoc();
            if ($row_Senha) { // Verifica se a senha foi encontrada
                $senha_do_banco = $row_Senha['senha'];
                if ($senha_criptografada == $senha_do_banco) {
                    $_SESSION['Id'] = $selectCpfId;
                    $_SESSION['Login'] = 'Spooky';
                    header('location: index.php');
                } else {
                    echo 'Senha incorreta';
                }
            } else {
                echo 'Senha não encontrada no banco de dados';
            }
        }else{
            echo 'cpf incorreto';
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
                        <a rel="noopener noreferrer" href="recuperacao.php">Esqueceu sua senha ?</a>
                    </div>
                </div>
                <button class="sign">Entrar</button>
            </form>
            <br>
            <p class="signup">Não tem uma conta?
                <a rel="noopener noreferrer" href="cadastro.php" class="">Inscreva-se</a>
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