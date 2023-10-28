<?php 
    include 'connection/connect.php';

    session_start();

    //código busca o cep
    if(isset($_POST['cep'])){
        $cep = $_POST['cep'];
        $url = "https://viacep.com.br/ws/$cep/json/";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);
    
        if(isset($data['erro'])){
            header('location: conta.php?cep=n');
        } else {
            $logradouro = isset($data['logradouro']) ? $data['logradouro'] : '';
            $cidade = isset($data['localidade']) ? $data['localidade'] : '';
            $uf = isset($data['uf']) ? $data['uf'] : '';
        }
    }

    if (isset($_SESSION['Id'])){
        $id_cli = $_SESSION['Id'];
    }

    if (isset($_POST['cadastro2BTN'])){
        $cep = $_POST['cep_end'];
        $logradouro = $_POST['logradouro'];
        $numero = $_POST['numero'];
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];

        $sql = "INSERT INTO End_clientes (logradouro, numero, cidade, uf, cep, id_cliente) VALUES
        ('$logradouro','$numero','$cidade','$uf','$cep','$id_cli');";

        $resultado = $conn->query($sql);
        if ($resultado){
            header('location: index.php');
            exit;
        }else{
            echo "nao";
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
    <title>Cadastro - Etapa 2 - Spooky House</title>
</head>
<body class="fundo_login">
    <main style="padding: 50px;">
        <div class="form-container inflar">
            <p class="title Sometype">Usuário Criado!!!</p>
            <p class="text-center">Por favor preencha seu endereço para prosseguir no site.</p>
            <img src="images/Elementos/abobra2.gif" style="width: 100%;" alt="">
            <form action="cadastro2.php" method="post" class="form" enctype="multipart/form-data">
                <div class="d-flex">
                    <div class="input-group">
                        <label for="cep">Buscar CEP</label>
                        <input type="text" name="cep" id="cep" placeholder="" required>
                        <button class="btn" type="submit" style="color: #f8741d; background-color: #2b1069;">Buscar</button>
                    </div>
                </div>
            </form>
            <form action="cadastro2.php" method="post" class="form" enctype="multipart/form-data">
                <input name="cep_end" id="cep_end" value="<?php if(isset($cep)) { echo $cep; } ?>" type="text" hidden>
                <div class="input-group">
                    <label for="logradouro">Logradouro</label>
                    <input type="text" name="logradouro" id="logradouro" placeholder="" required>
                </div>
                <div class="input-group">
                    <label for="numero">Número</label>
                    <input type="text" name="numero" id="numero" placeholder="" required>
                </div>
                <div class="input-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" id="cidade" placeholder="" required>
                </div>
                <div class="input-group">
                    <label for="uf">UF</label>
                    <input type="text" name="uf" id="uf" placeholder="" required>
                </div>
                <br>
                <button class="sign" type="submit" name="cadastro2BTN">Cadastrar-se</button>
            </form>
            <br>
        </div>
    </main>
</body>
    <!-- Link para Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Link para as funções JavaScript -->
    <script src="js/script.js"></script>
    <!-- codigo que preenche os campos-->
    <script>
        document.getElementById('logradouro').value = '<?php echo $logradouro; ?>'; 
        document.getElementById('cidade').value = '<?php echo $cidade; ?>';
        document.getElementById('uf').value = '<?php echo $uf; ?>';
        document.getElementById('numero').value = 'Digite o número'
    </script>
    <script>
        function validaForm() {
            var numero = document.getElementById("numero");
            if (numero.value === "Digite o número") {
                alert("Por favor, digite um número de endereço válido .");
                return false;
            }
            return true;
        }
    </script>
</html>