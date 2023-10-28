<?php 
    include '../verifica_session.php';
    include '../connection/connect.php';
    
    $ID = $_SESSION['Id'];
    $select = $conn->query("SELECT * FROM clientes INNER JOIN end_clientes ON clientes.id = end_clientes.id_cliente INNER JOIN login_clientes ON clientes.id = login_clientes.id_cliente WHERE clientes.id = ".$ID.";");
    $row_conta = $select->fetch_assoc();
    
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

    // Código que adiciona as Informações de Endereço no banco de dados
    if(isset($_POST['end'])){
        $cep = $_POST['cep_end'];
        $logradouro = $_POST['logradouro'];
        $numero = $_POST['numero'];
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];

        $sql_end = "UPDATE End_clientes 
        set logradouro = '$logradouro',
        numero = '$numero',
        cidade = '$cidade',
        uf = '$uf',
        cep = '$cep'
        WHERE id_cliente = ".$_SESSION['Id'].";";

        $resultadoEnd = $conn->query($sql_end);
        if($resultadoEnd){
            header('location: conta.php');
        }
    }

    // Código que adiciona as Informações do usuário no banco
    if(isset($_POST['info'])){
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

        $sql_info = "UPDATE Clientes
        set email = '$email',
        telefone = '$telefone'
        WHERE id = ".$ID.";";

        $resultadoInfo = $conn->query($sql_info);
        if($resultadoInfo){
            header('location: conta.php');
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
    <!-- Link par ao JQUERY -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- Link para o CSS -->
    <link rel="stylesheet" href="../CSS/input_cep.css">
    <link rel="stylesheet" href="../CSS/input.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="shortcut icon" href="../images/Elementos/favicon.png" type="image/x-png">
    <title>Área do Cliente - <?php echo $row_conta['nome'];?> </title>
</head>
<body id="fundo_index">
    <?php include 'header.php';?>
    <!-- Background que faz efeito no fundo do site -->
    <img src="../images/elementos/shape-bg.png" class="shape_bg">
    <noscript>Este site necessita de javascript para funcionar.</noscript>
        
    <main class="container-fluid" style="margin-bottom: 80px;">
        <div class="d-flex justify-content-center" style="margin-top: 20px; ">
            <img src="../images/perfil/<?php echo $row_conta['imagem']; ?>" alt="<?php echo $row_conta['imagem']; ?>" style="border-radius: 50%; max-width: 150px; border: 2px solid #f8741d;">
        </div>
        <h1 class="text-light text-center" style="margin-bottom: 40px;">Bem vindo, <?php echo $row_conta['nome'];?></h1>
        <!-- Formulário de busca por CEP -->
        <div class="container">
            <h4 style="color: #f8741d;" id="titulo_endereco">BUSCAR CEP</h4>
            <form action="conta.php" method="post" enctype="multipart/form-data">    
            <!-- Input do cep  -->
                <div>
                    <div class="input-group">
                        <input type="text" class="input" id="cep" name="cep" placeholder="Digite seu CEP" value="<?php echo $row_conta['cep'];?>">
                        <button type="submit" class="button--submit" onclick="buscarEndereco()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <!-- Formulário Endereço -->
            <div class="d-flex" style="flex-direction: column;">
                <form action="conta.php" method="post" enctype="multipart/form-data" onsubmit="return validaForm()">
                    <div class="d-flex justify-content-center">
                        <input name="cep_end" id="cep_end" value="<?php if(isset($cep)) { echo $cep; } ?>" type="text" hidden>
                        <div class="form__group field">
                            <input type="input" maxlength="70" class="form__field" name="logradouro" id="logradouro" placeholder="Logradouro" value="<?php echo $row_conta['logradouro'];?>" required="">
                            <label for="name" class="form__label">Logradouro</label>
                        </div>
                        <div class="form__group field" style="margin-left: 20px;">
                            <input type="input" maxlength="6" class="form__field" name="numero" id="numero" placeholder="Numero" value="<?php echo $row_conta['numero'];?>" required="">
                            <label for="name" class="form__label">Numero</label>
                        </div>
                        <div class="form__group field" style="margin-left: 20px;">
                            <input type="input" maxlength="50" class="form__field" name="cidade" id="cidade" placeholder="Cidade" value="<?php echo $row_conta['cidade'];?>" required="">
                            <label for="name" class="form__label">Cidade</label>
                        </div>
                        <div class="form__group field" style="margin-left: 20px;">
                            <input type="input" maxlength="2" class="form__field" name="uf" id="uf" placeholder="UF" value="<?php echo $row_conta['uf'];?>" required="">
                            <label for="name" class="form__label">UF</label>
                        </div>
                        <button type="submit" name="end" id="end_btn" style="margin-left: 20px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                            </svg>
                        </button>
                    </div>
                </form>
                <br>
                <!-- Formulário de informações da conta -->
                <div>
                    <h2 class="text-center" style="color: #f8741d;">Configurações da conta</h2>
                    <br>
                    <form action="conta.php" method="post" enctype="multipart/form-data">
                        <div class="d-flex justify-content-center">
                            <div class="form__group field">
                                <input type="email" maxlength="120" class="form__field" name="email" id="email" placeholder="Email" value="<?php echo $row_conta['email'];?>" required="">
                                <label for="name" class="form__label">Email</label>
                            </div>
                            <div class="form__group field" style="margin-left: 20px;">
                                <input type="text" maxlength="14" class="form__field" name="CPF" id="CPF" placeholder="CPF" value="<?php echo $row_conta['cpf'];?>" onkeypress="$(this).mask('000.000.000-00');" disabled>
                                <label for="name" class="form__label">CPF</label>
                            </div>
                            <div class="form__group field" style="margin-left: 20px;">
                                <input type="text" maxlength="14" class="form__field" name="telefone" id="telefone" placeholder="Telefone" value="<?php echo $row_conta['telefone'];?>" onkeypress="$(this).mask('(00)00000-0000');" required="">
                                <label for="name" class="form__label">Telefone</label>
                            </div>
                            <button type="submit" name="info" id="info_btn" style="margin-left: 20px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
                <br><br>
                <!-- Elemento da Aranha -->
                <div class="d-flex justify-content-center">
                    <img src="../images/Elementos/item-spider.png" width="20%" alt="">
                </div>
            </div>
        </div>
    </main>
    
    <?php include 'footer.php';?>
</body>
    <!-- Link para Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Link para as funções JavaScript -->
    <script src="../js/script.js"></script>
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