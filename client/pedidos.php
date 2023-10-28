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
    <!-- Link para o JQUERY -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- Links do data Table -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
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
                        <th style="color: white;">Status</th>
                        <th style="color: white;">Quantidade</th>
                        <th style="color: white;">Data</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <!-- Estrutura de Repetição -->
                    <?php do {?>
                        <tr>
                            <td hidden><?php echo $row['id'];?></td>
                            <td style="color: white;"><?php echo $row[''];?></td>
                            <td style="color: white;"><?php echo $row['resumo'];?></td>
                            <td style="color: white;"><?php echo $row['preco'];?></td>
                            <td style="color: white;"><?php echo $row['data_adicao'];?></td>
                            <td style="color: white;"><?php echo $row['quantidade'];?></td>
                            <td style="color: white;"><img src="../images/Fantasias/<?php echo $row['img_produto'];?>" style="max-width: 50px;" alt=""></td>
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
