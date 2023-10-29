<?php 
    include '../verifica_session.php';
    include '../connection/connect.php';
    
    $ID = $_SESSION['Id'];
    $select = $conn->query("SELECT * FROM clientes INNER JOIN end_clientes ON clientes.id = end_clientes.id_cliente INNER JOIN login_clientes ON clientes.id = login_clientes.id_cliente WHERE clientes.id = ".$ID.";");
    $row_conta = $select->fetch_assoc();
    

    //Código para a foto funcionar
    if(isset($_POST['alterar_foto'])){ //Seleciona o formulário da foto
        if($_FILES['foto']['name']) {
            $nome_img = $_FILES['foto']['name']; //Pega o nome do arquivo selecionado
            $tmp_img = $_FILES['foto']['tmp_name'];
            $dir_img = "../images/perfil/$nome_img"; //Local onde a imagem vai ser armazenada
            move_uploaded_file($tmp_img, $dir_img); //Adciona o arquivo na pasta
            $imagem_perfil = $nome_img;
            $updateSql = "UPDATE Clientes set imagem = '$nome_img' where id = ".$_SESSION['Id'].";"; //Adiciona a imagem no banco
        }else {
            $imagem_perfil = "img_padrao.jpg";
            $updateSql = "UPDATE Clientes set imagem = '$imagem_perfil' where id = ".$_SESSION['Id'].";";
        }

        $resultado = $conn->query($updateSql);
        if($resultado){
            $_SESSION['Imagem'] = $nome_img; // Atualiza o valor da imagem na sessão
            header('location: conta.php');
        }
    }

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
            header('location: conta.php?upd=s');
        }
    }

    // Código que adiciona as Informações do usuário no banco
    if(isset($_POST['info'])){
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

        $sql_info = "UPDATE Clientes
        set email = '$email',
        telefone = '$telefone'
        WHERE id = ".$_SESSION['Id'].";";

        $resultadoInfo = $conn->query($sql_info);
        if($resultadoInfo){
            header('location: conta.php?upd=s');
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
        <div class="d-flex justify-content-center image-container" style="margin-top: 20px; ">
            <a role="button" type="button" data-toggle="modal" data-target="#modal_foto">
                <img src="../images/perfil/<?php echo $row_conta['imagem']; ?>" alt="<?php echo $row_conta['imagem']; ?>" style="border-radius: 50%; max-width: 150px; border: 2px solid #f8741d;" class="profile-image">
            </a>
            <div class="overlay">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="48" height="48"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2ZM10.95 17.51C10.66 17.8 10.11 18.08 9.71 18.14L7.25 18.49C7.16 18.5 7.07 18.51 6.98 18.51C6.57 18.51 6.19 18.37 5.92 18.1C5.59 17.77 5.45 17.29 5.53 16.76L5.88 14.3C5.94 13.89 6.21 13.35 6.51 13.06L10.97 8.6C11.05 8.81 11.13 9.02 11.24 9.26C11.34 9.47 11.45 9.69 11.57 9.89C11.67 10.06 11.78 10.22 11.87 10.34C11.98 10.51 12.11 10.67 12.19 10.76C12.24 10.83 12.28 10.88 12.3 10.9C12.55 11.2 12.84 11.48 13.09 11.69C13.16 11.76 13.2 11.8 13.22 11.81C13.37 11.93 13.52 12.05 13.65 12.14C13.81 12.26 13.97 12.37 14.14 12.46C14.34 12.58 14.56 12.69 14.78 12.8C15.01 12.9 15.22 12.99 15.43 13.06L10.95 17.51ZM17.37 11.09L16.45 12.02C16.39 12.08 16.31 12.11 16.23 12.11C16.2 12.11 16.16 12.11 16.14 12.1C14.11 11.52 12.49 9.9 11.91 7.87C11.88 7.76 11.91 7.64 11.99 7.57L12.92 6.64C14.44 5.12 15.89 5.15 17.38 6.64C18.14 7.4 18.51 8.13 18.51 8.89C18.5 9.61 18.13 10.33 17.37 11.09Z" fill="#D3D3D3"></path> </g></svg>
            </div>
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
                                <label for="email" class="form__label">Email</label>
                            </div>
                            <div class="form__group field" style="margin-left: 20px;">
                                <input type="text" maxlength="14" class="form__field" name="CPF" id="CPF" placeholder="CPF" value="<?php echo $row_conta['cpf'];?>" onkeypress="$(this).mask('000.000.000-00');" disabled>
                                <label for="CPF" class="form__label">CPF</label>
                            </div>
                            <!-- TELEFONE -->
                            <div class="form__group field" style="margin-left: 20px;">
                                <input type="tel" maxlength="14" class="form__field" name="telefone" id="telefone" placeholder="Telefone" value="<?php echo $row_conta['telefone'];?>" required="">
                                <label for="telefone" class="form__label">Telefone</label>
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

    <!-- Modal não encontrou cep -->
    <div class="modal fade" id="modal_cep_n" tabindex="-1" role="dialog" aria-labelledby="modal_cep_n_centro" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-title" id="modal_cep_n_titulo" style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                        <img c src="../images/logo_areas.png" width="100vw" alt="">
                        <h5>Buscar CEP</h5>
                        <button style="background-color: white; border: none;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><ion-icon style="color: black; font-size: 2vw;" name="close-outline"></ion-icon></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Erro ao buscar CEP. Verifique se o CEP digitado está correto.</p>        
                        <div style="display: flex; justify-content: end;">
                            <button  type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- código para o Modal não encontrou cep -->
        <?php if(isset($_GET['cep']) && ($_GET['cep'] == "n")){?>
            <script>
                $(document).ready(function() {
                    $('#modal_cep_n').modal('show');
                });
            </script>
        <?php }?>  

        <div class="modal fade" tabindex="-1" id="modal_foto">
            <div class="modal-dialog">
                <div class="modal-content bg-dark">
                    <form action="conta.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title text-light">Alterar foto de perfil</h5>
                        </div>
                        <div class="modal-body">
                            <h3 class="text-light text-center">Imagem atual</h3>
                            <img src="../images/perfil/<?php echo $row_conta['imagem']; ?>" style="width: 100%;" alt="">
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <input type="file" class="form-control" name="foto" id="foto">
                            <button type="submit" name="alterar_foto" class="btn btn-primary">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
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