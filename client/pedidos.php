<?php 
    include '../connection/connect.php';
    include '../verifica_session.php';
    
    $ID = $_SESSION['Id'];
    $select = $conn->query("SELECT * FROM Produtos P JOIN Item_pedido IP ON P.id = IP.id_produto JOIN Pedidos PD ON IP.id_pedido = PD.id WHERE PD.id_cliente = '$ID';");
    $row = $select->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Pedidos</title>
</head>
<body id="fundo_index">
    <?php include 'header.php';?>
    <img src="../images/elementos/shape-bg.png" class="shape_bg">

    <main>
        <div class="container">
            <table class="table table-hover table-condensed" id="tabela_carrinho">
                <thead>
                    <tr>
                        <th hidden>ID</th>
                        <th style="color: white;">Produto</th>
                        <th style="color: white;">Resumo</th>
                        <th style="color: white;">Preço</th>
                        <th style="color: white;">Adição</th>
                        <th style="color: white;">Quantidade</th>
                        <th style="color: white;">Imagem</th>
                        <th class="d-flex">
                            <a href="adicionar_carrinho.php" target="_self" class="btn btn-block btn-xs" style="background-color: #38B6FF;" role="button">
                                <ion-icon name="add-circle-outline"></ion-icon>
                                <span class="hidden-xs">ADICIONAR</span>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Estrutura de Repetição -->
                    <?php do {?>
                        <tr>
                            <td hidden><?php echo $row_carrinho['id'];?></td>
                            <td style="color: white;"><?php echo $row_carrinho['nome_produto'];?></td>
                            <td style="color: white;"><?php echo $row_carrinho['resumo'];?></td>
                            <td style="color: white;"><?php echo $row_carrinho['preco'];?></td>
                            <td style="color: white;"><?php echo $row_carrinho['data_adicao'];?></td>
                            <td style="color: white;"><?php echo $row_carrinho['quantidade'];?></td>
                            <td style="color: white;"><img src="../images/Fantasias/<?php echo $row_carrinho['img_produto'];?>" style="max-width: 50px;" alt=""></td>
                            <td>
                                <a data-toggle="modal" data-target="#modal_remover_item" role="button" class="btn btn-block btn-xs" style="background-color: #c4302b; margin-bottom: 10px;"> 
                                    <ion-icon name="refresh-outline"></ion-icon>
                                    <span class="hidden-xs">REMOVER</span>
                                </a>  
                                <a href="../detalhes.php" role="button" class="btn btn-block btn-xs" style="background-color: #f8741d;"> 
                                    <ion-icon name="refresh-outline"></ion-icon>
                                    <span class="hidden-xs">DETALHES</span>
                                </a>  
                            </td>
                        </tr>
                    <?php }while($row_carrinho = $select->fetch_assoc())?> <!-- Fim da Estrutura de repetição -->
                </tbody>
                <tfoot>
                    <tr>
                        <th hidden>ID</th>
                        <th style="color: white;">Produto</th>
                        <th style="color: white;">Resumo</th>
                        <th style="color: white;">Preço</th>
                        <th style="color: white;">Adição</th>
                        <th style="color: white;">Quantidade</th>
                        <th style="color: white;">Imagem</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>
    
    
</body>
</head>
</html>
