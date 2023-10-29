<?php 
     include '../connection/connect.php';
     include '../verifica_session.php';

    
     $select = $conn->query("SELECT P.id as id_produto, P.nome as nome_produto, P.imagem as img_produto, P.resumo as resumo_produto, preco as preco_produto, destaque as destaque_produto
     FROM Produtos P
     WHERE NOT EXISTS (
         SELECT 1
         FROM Item_pedido IP
         INNER JOIN Pedidos PD ON IP.id_pedido = PD.id
         WHERE P.id = IP.id_produto AND PD.id_cliente = '".$_SESSION['Id']."'
     );");
    $row = $select->fetch_assoc();

    $select_id = $conn->query("SELECT cpf FROM Clientes WHERE id = '".$_SESSION['Id']."';");
    $row_id = $select_id->fetch_assoc();

    if (isset($_POST['addBTN'])){
        $id = $_POST['id'];
        $cpf = isset($_POST['cpf_cli']) ? $_POST['cpf_cli'] : null;
        $quantidade = $_POST['quantidade'];
        

        $sql = "INSERT INTO Pedidos (id_cliente, status, data) VALUES
        ('".$_SESSION['Id']."','Solicitado',DATE_ADD(NOW(), INTERVAL 30 DAY));
        ";

        $resultado = $conn->query($sql);
        if($resultado){
            $id_ultimo = $conn->insert_id;
            $sql_ped = "INSERT INTO Item_pedido (id_pedido, id_produto, quantidade) VALUES
            ('$id_ultimo','$id','$quantidade');
            ";

            $resultado_ped = $conn->query($sql_ped);
            if ($resultado_ped){
                header('location: pedidos.php?add=s');
            }
        }else{
            "Não passou";
        }
    }


    if (isset($_POST['card_prod'])){
        $Id = isset($_POST['id_prod']) ? $_POST['id_prod'] : null;
        $produto = $_POST['nome'];
        $resumo = $_POST['resumo'];
        $preco = $_POST['preco'];
        $imagem  = $_POST['imagem'];
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
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="shortcut icon" href="../images/Elementos/favicon.png" type="image/x-png">
    <title>Adicionar Pedidos - Spooky House</title>
</head>
<body class="fundo_pedido">
    <main style="padding: 50px;">
        <div class="form-container inflar">
            <p class="title Sometype">Adicionar Pedido!!</p>
            <img src="../images/Fantasias/<?php if(isset($imagem)) { echo $imagem; } ?>" style="max-width: 100%; max-height: 250px; border-radius: 20px;" id="imagem" alt="">
            <h2 class="text-light text-center" id="nome_prod"><?php if(isset($nome)) { echo $nome; } ?></h2>
            <!-- Adicione um identificador único ao formulário -->
            <form action="adicionar_pedido.php" method="post" enctype="multipart/form-data" id="pedidoForm">
                <div class="input-group d-flex" style="flex-direction: column;">
                    <label for="ep">Escolher Produto</label>
                    <input type="text" name="ep" id="ep" placeholder="" hidden>
                    <a role="button" data-toggle="modal" data-target="#modal_escolher" class="btn" style="background-color: #F9E4B7;">Navegar</a>
                </div>
            </form>
            <form action="adicionar_pedido.php" method="post" class="form" enctype="multipart/form-data">
                <input type="text" name="id" id="id" value="<?php echo $Id; ?>" hidden>
                <div class="input-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf_cli" id="cpf_cli" onkeypress="$(this).mask('000.000.000-00');" value="<?php echo $row_id['cpf'];?>" placeholder="" disabled required>
                </div>
                <div class="input-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" name="descricao" id="descricao" placeholder="" value="" disabled required>
                </div>
                <div class="input-group">
                    <label for="preco">Preço</label>
                    <input type="text" name="preco" id="preco" value="" placeholder="" disabled required>
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
                <button class="sign" type="submit" name="addBTN">Adicionar</button>
            </form>
            <br>
        </div>
    </main>

    <!-- ======================================= MODAL ================================================ -->
    <div class="modal fade" tabindex="-1" id="modal_escolher">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h2 class="modal-title">Produtos</h2>
                </div>
                <div class="modal-body">
                    <div id="cardCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                        <?php
                            $first = true;
                            do {
                            $activeClass = $first ? 'active' : '';
                        ?>
                        <form action="adicionar_pedido.php" method="post" enctype="multipart/form-data">
                            <div class="carousel-item <?php echo $activeClass; ?>" style="margin-left: 80px;">
                                <div class="card card_destaque" style="width: 18rem; margin-right: 20px; margin-bottom: 20px; margin-top: 20px; flex: 0 0 calc(25% - 20px);">
                                    <input name="id_prod" id="id_prod" value="<?php echo $row['id_produto']; ?>" type="text" hidden>
                                    <input type="text" name="imagem" value="<?php echo $row['img_produto'];?>" hidden><img src="../images/Fantasias/<?php echo $row['img_produto'];?>" class="card-img-top" style="max-height: 250px;" alt="<?php echo $row['img_produto'];?>">
                                    <div class="card-body">
                                        <input type="text" name="nome" id="nome" value="<?php echo $row['nome_produto'];?>" hidden>
                                        <h5 class="card-title"><?php echo $row['nome_produto'];?></h5>
                                        <input type="text" name="resumo" id="resumo" value="<?php echo $row['resumo_produto'];?>" hidden>
                                        <p class="card-text"><?php echo $row['resumo_produto'];?></p>
                                        <input type="text" name="preco" id="preco" value="<?php echo $row['preco_produto'];?>" hidden>
                                        <p class="card-text">Preço: <?php echo $row['preco_produto']; ?></p>
                                        <?php if ($row['destaque_produto'] == 'Sim'){ ?>
                                            <button type="button" class="btn" style="color: white;" disabled>DESTAQUE</button>
                                        <?php } ?>
                                        <button role="button" type="submit" name="card_prod" class="btn float-right" style="background-color: #f8741d;">Adicionar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php
                        $first = false;
                        } while ($row = $select->fetch_assoc());
                    ?>
                    </div>
                    <a class="carousel-control-prev" href="#cardCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#cardCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
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
        document.getElementById('descricao').value = '<?php echo $resumo; ?>';
        document.getElementById('preco').value = '<?php echo $preco; ?>';
        document.getElementById('imagem').value = '<?php echo $imagem; ?>';
        document.getElementById('nome_prod').value = '<?php echo $produto; ?>'
        document.getElementById('id').value = '<?php echo $Id; ?>'
        // Feche o modal se necessário
        $('#modal_escolher').modal('hide');
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