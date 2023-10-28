<?php 
    include 'connection/connect.php';

    session_start();

    // Verifique se a sessão já existe
    if (isset($_SESSION['Id'])) {
        // Sessão já existe, redirecione para a página index
            header('Location: index.php');
            exit;
        }
    
    if(isset($_POST['cadastroBTN'])){
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $senha1 = $_POST['senha1'];
        $senha2 = $_POST['senha2'];
        
        $sql = "INSERT INTO Clientes (nome, email, cpf, telefone, imagem) VALUES
        ('$nome', '$email', '$cpf', '$telefone', 'img_padrao.jpg');";

        $resultado = $conn->query($sql);

        if ($resultado){
            if ($senha1 == $senha2){
                $senha_enviada = $senha1;
                $select_cpf = $cpf;
                
                $sql_id = $conn->query("SELECT id FROM Clientes WHERE cpf = '".$cpf."';");
                $row = $sql_id->fetch_assoc();
                $id_cli = $row['id'];
                
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
                $senha_criptografada = 'Cli' . $id_cli . $hash_md5_12 . 'Spooky-' . $cpf_final;
                
                
                $sql_senha = "INSERT INTO Login_clientes (senha, id_cliente) VALUES
                ('$senha_criptografada', '$id_cli');";

                $resultado_senha = $conn->query($sql_senha);
                if($resultado_senha){
                    $_SESSION['Id'] = $id_cli;
                    $_SESSION['Login'] = 'Spooky';
                    header("location: cadastro2.php");
                }
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
    <link rel="shortcut icon" href="images/Elementos/favicon.png" type="image/x-png">
    <title>Cadastro - Spooky House</title>
</head>
<body class="fundo_login">
    <main style="padding: 50px;">
        <div class="form-container inflar">
            <p class="title Sometype">Inscrever-se</p>
            <img src="images/Elementos/abobra2.gif" style="width: 100%;" alt="">
            <form action="cadastro.php" method="post" class="form" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="nome">Nome</label>
                    <input type="text" maxlength="100" name="nome" id="nome" placeholder="" required>
                </div>
                <div class="input-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" onkeypress="$(this).mask('000.000.000-00');" placeholder="" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" maxlength="120" id="email" placeholder="" required>
                </div>
                <div class="input-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" maxlength="14" name="telefone" id="telefone" placeholder="" required>
                </div>
                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha1" id="senha1" placeholder="" required>
                </div>
                <div class="input-group">
                    <label for="senha">Repita a Senha</label>
                    <input type="password" name="senha2" id="senha2" placeholder="" required>
                </div>
                <br>
                <button class="sign" type="submit" name="cadastroBTN">Cadastrar-se</button>
            </form>
            <br>
            <p class="signup">Já tem uma conta?
                <a rel="noopener noreferrer" href="login.php" class="">Entrar</a>
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