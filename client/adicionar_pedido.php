<?php 
     include '../connection/connect.php';
     include '../verifica_session.php';

    
    $select = $conn->query("SELECT *, P.id as id_produto, P.nome as nome_produto, P.imagem as img_produto FROM Produtos P JOIN Item_pedido IP ON P.id = IP.id_produto JOIN Pedidos PD ON IP.id_pedido = PD.id;");
    $row = $select->fetch_assoc();

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
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="shortcut icon" href="../images/Elementos/favicon.png" type="image/x-png">
    <title>Adicionar Pedidos - Spooky House</title>
</head>
<body class="fundo_pedido">
    <main style="padding: 50px;">
        <div class="form-container inflar">
            <p class="title Sometype">Adicionar Pedido!!</p>
            <img src="images/Elementos/<?php  ?>" style="width: 100%;" alt="">
            <form action="adicionar_pedido.php" method="post" enctype="multipart/form-data">
                <div class="input-group d-flex" style="flex-direction: column;">
                    <label for="ep">Escolher Produto</label>
                    <input type="text" name="ep" id="ep" placeholder="" hidden>
                    <button data-toggle="modal" data-target="#modal_escolher" class="btn" style="background-color: #F9E4B7;">Navegar</button>
                </div>
            </form>
            <form action="login.php" method="post" class="form">
                <div class="input-group">
                    <label for="cpf">Digite o seu CPF</label>
                    <input type="password" name="cpf" id="cpf" onkeypress="$(this).mask('000.000.000-00');" placeholder="">
                </div>
                <div class="input-group">
                    <label for="cpf">Descrição</label>
                    <input type="password" name="cpf" id="cpf" placeholder="">
                </div>
                <div class="input-group">
                    <label for="cpf">Preço</label>
                    <input type="password" name="cpf" id="cpf" placeholder="">
                </div>
                <div class="input-group">
                    <label for="quantidade">Quantidade</label>
                    <div class="quantity-input d-flex">
                        <a style="cursor: pointer; font-size: 30pt;" id="decrease">-</a>
                        <input type="text" name="quantidade" id="quantidade" style="width: 20%;" value="1" readonly>
                        <a style="cursor: pointer; font-size: 30pt;" id="increase">+</a>
                    </div>
                </div>
                <br>
                <button class="sign">Adicionar</button>
            </form>
            <br>
            <p class="signup">Não tem uma conta?
                <a rel="noopener noreferrer" href="cadastro.php" class="">Inscreva-se</a>
            </p>
        </div>
    </main>

    <!-- ==================================== MODAL ====================================== -->
    <div class="modal fade" tabindex="-1" id="modal_escolher">
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
    <!-- codigo que preenche os campos-->
    <script>
        document.getElementById('logradouro').value = '<?php echo $logradouro; ?>'; 
        document.getElementById('cidade').value = '<?php echo $cidade; ?>';
        document.getElementById('uf').value = '<?php echo $uf; ?>';
        document.getElementById('numero').value = 'Digite o número'
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
    const decreaseButton = document.getElementById("decrease");
    const increaseButton = document.getElementById("increase");
    const quantidadeInput = document.getElementById("quantidade");

    decreaseButton.addEventListener("click", function () {
        let quantidade = parseInt(quantidadeInput.value);
        if (quantidade > 1) {
            quantidade--;
            quantidadeInput.value = quantidade;
        }
    });

    increaseButton.addEventListener("click", function () {
        let quantidade = parseInt(quantidadeInput.value);
        quantidade++;
        quantidadeInput.value = quantidade;
    });
});

    </script>
</html>