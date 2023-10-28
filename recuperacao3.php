<?php 
    include 'connection/connect.php';

    $cod = isset($_GET['cpf']) ? $_GET['cpf'] : '';

    if (isset($_POST['recu'])){
        $senha1 = $_POST['senha1'];
        $senha2 = $_POST['senha2'];
        $cod_recu = $_POST['cod_recu'];
        
        $sql_cli = $conn->query("SELECT id FROM Clientes WHERE cpf = '$cod_recu';");
        $row = $sql_cli->fetch_assoc();
        $Id = $row['id'];

        // criptografia da senha
        $senhafinal = md5($senha1);
                
        // Limita a senha a 12 caracteres
        $hash_md5_12 = substr($senhafinal, 0, 8);
        
        // remove o ponto do cpf
        $cpf_semPonto = str_replace('.', '', $cod_recu);
        
        // pega só os 5 primeiros caracteres do cpf
        $cpf_cortado = substr($cpf_semPonto, 0, 5);
        
        // criptografa a os 5 primeiros caracteres do cpf
        $cpf_quase_final = md5($cpf_cortado);
        
        // limita o hash a 5 caracteres
        $cpf_final = substr($cpf_quase_final, 0, 5);
        $senha_criptografada = 'Cli' . $Id . $hash_md5_12 . 'Spooky-' . $cpf_final;


        $sql = "UPDATE Login_clientes
        SET senha = '$senha_criptografada',
        id_cliente = '$Id'";

        $resultado = $conn->query($sql);
        if ($resultado){
            header("location: login.php?recu=s");
            exit; // Importante sair após redirecionar
        }else{
            echo "Não passou";
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
    <link rel="stylesheet" href="CSS/recuperacao.css">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="shortcut icon" href="images/Elementos/favicon.png" type="image/x-png">
    <title>Recuperação - Etapa 3 - Spooky House</title>
</head>
<body class="fundo_login">
    <main style="padding: 50px;">
        <div class="form-container inflar">
            <p class="title Sometype">Quase lá, apenas complete as informações a seguir</p>
            <form action="recuperacao3.php" method="post" class="form" enctype="multipart/form-data" onsubmit="return validateForm();">
                <input name="cod_recu" id="cod_recu" value="<?php if(isset($cod)) { echo $cod; } ?>" type="text" hidden>

                <div class="input-group">
                    <label for="senha1">Senha Nova</label>
                    <input type="password" name="senha1" id="senha1" placeholder="">
                </div>
                <div class="input-group">
                    <label for="senha2">Repita a Senha Nova</label>
                    <input type="password" name="senha2" id="senha2" placeholder="">
                </div>
                <br>
                <button type="submit" name="recu" class="sign">Recuperar</button>
            </form>
            <br>
        </div>
    </main>
</body>
<script>
    function validateForm() {
        var senha1 = document.getElementById("senha1").value;
        var senha2 = document.getElementById("senha2").value;

        if (senha1 !== senha2) {
            alert("As senhas não coincidem. Por favor, digite senhas iguais.");
            return false;
        }

        return true;
    }
</script>
</html>