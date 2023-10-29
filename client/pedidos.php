<?php 
    include '../connection/connect.php';
    include '../verifica_session.php';

    $ID = $_SESSION['Id'];
    $select = $conn->query("SELECT *, PD.id as id_pedido, P.id as id_produto, P.nome as nome_produto, P.imagem as img_produto FROM Produtos P JOIN Item_pedido IP ON P.id = IP.id_produto JOIN Pedidos PD ON IP.id_pedido = PD.id WHERE PD.id_cliente = '$ID';");
    $row = $select->fetch_assoc();
    $num_linhas = $select->num_rows;

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css">
    <!-- Jquery para o modal -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- Links do data Table -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="shortcut icon" href="../images/Elementos/favicon.png" type="image/x-png">
    <title>Pedidos</title>
</head>
<body id="fundo_index">
    <?php include 'header.php';?>
    <img src="../images/elementos/shape-bg.png" class="shape_bg">

    <?php if($num_linhas == 0){?>
        <section style="margin: 250px;">
            <h2 class="text-center" style="font-size: 20pt; color: white;">Nenhum pedido foi solicitado ainda.</h2>
            <div class="d-flex justify-content-center">
                <a href="adicionar_pedido.php" class="text-light btn btn-primary">Adicionar</a>
            </div>
        </section>
    <?php } ?>

    <?php if($num_linhas>0){?>
    <main>
        <div class="container" style="margin-top: 50px; margin-bottom: 80px;">
            <h1 class="text-light text-center">Itens de pedido</h1>
            <table class="table table-hover table-condensed" id="tabela_carrinho">
                <thead>
                    <tr>
                        <th hidden>ID</th>
                        <th style="color: white;">Produto</th>
                        <th style="color: white;">Resumo</th>
                        <th style="color: white;">Preço</th>
                        <th style="color: white;">Status</th>
                        <th style="color: white;">Quantidade</th>
                        <th style="color: white;">Previsão</th>
                        <th style="color: white;">Imagem</th>
                        <th class="d-flex">
                            <a href="adicionar_pedido.php" target="_self" class="btn btn-block btn-xs" style="background-color: #38B6FF;" role="button">
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
                            <td hidden><?php echo $row['id_produto'];?></td>
                            <td style="color: white;"><?php echo $row['nome_produto'];?></td>
                            <td style="color: white;"><?php echo $row['resumo'];?></td>
                            <td style="color: white;"><?php echo $row['preco'];?></td>
                            <td style="color: white;"><?php echo $row['status'];?></td>
                            <td style="color: white;"><?php echo $row['quantidade'];?></td>
                            <td style="color: white;"><?php echo date('d/m/Y', strtotime($row['data'])); ?></td>
                            <td style="color: white;"><img src="../images/Fantasias/<?php echo $row['img_produto'];?>" style="max-width: 50px;" alt=""></td>
                            <td>
                                <?php if ($row['status'] == 'Em andamento' || $row['status'] == 'Solicitado'){?>
                                    <a href="../detalhes.php" role="button" class="btn btn-block btn-xs" style="background-color: #f8741d; margin-bottom: 5px"> 
                                        <ion-icon name="refresh-outline"></ion-icon>
                                        <span class="hidden-xs">DETALHES</span>
                                    </a>   
                                    <a href="pedido_excluir.php?id=<?php echo $row['id_pedido'];?>" class="btn btn-block btn-xs" style="background-color: #c4302b; margin-bottom: 10px;"> 
                                        <ion-icon name="refresh-outline"></ion-icon>
                                        <span class="hidden-xs">CANCELAR</span>
                                    </a>  
                                <?php }elseif ($row['status'] == 'Concluido'){?>
                                    <a href="../detalhes.php" role="button" class="btn btn-block btn-xs" style="background-color: #f8741d;"> 
                                        <ion-icon name="refresh-outline"></ion-icon>
                                        <span class="hidden-xs">DETALHES</span>
                                    </a>  
                                <?php }elseif ($row['status'] == 'Cancelado'){?>
                                    <a href="#"></a>
                                <?php }?>
                            </td>
                        </tr>
                    <?php }while($row = $select->fetch_assoc())?> <!-- Fim da Estrutura de repetição -->
                </tbody>
                <tfoot>
                    <tr>
                        <th hidden>ID</th>
                        <th style="color: white;">Produto</th>
                        <th style="color: white;">Resumo</th>
                        <th style="color: white;">Preço</th>
                        <th style="color: white;">Status</th>
                        <th style="color: white;">Quantidade</th>
                        <th style="color: white;">Previsão</th>
                        <th style="color: white;">Imagem</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>
    <?php } ?>
    <?php include 'footer.php';?>

    <!-- ======================================= MODAL =========================================== -->
    <!-- código para o modal ADD -->
    <?php if(isset($_GET['add']) && ($_GET['add'] == "s")){?>
            <script>
                $(document).ready(function() {
                    $('#modal_add').modal('show');
                });
            </script>
        <?php }?>  
        <!-- Fim do modal ADD -->

    <div class="modal fade" tabindex="-1" id="modal_add">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: #f8741d;">ITEM ADICIONADO COM SUCESSO !</h5>
                </div>
            </div>
        </div>
    </div>
</body>
    <!-- Scroll Reveal -->
    <script src="../js/scrollReveal.js"></script>
    <!-- Link para Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Link para as funções JavaScript -->
    <script src="../js/script.js"></script>
</html>
