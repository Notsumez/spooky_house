<?php 
    include '../connection/connect.php';
    include '../verifica_session.php';
    
    $ID = $_SESSION['Id'];
    $select = $conn->query("SELECT * FROM Pedidos INNER JOIN Item_pedido ON PEDIDOS.ID = Item_pedido.id_pedido WHERE id_cliente = '$ID'; ");
    $row = $select->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
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
            
        <?php do {?>
            <table class="table" id="tabela_pedidos">
                <thead>
                    <tr>
                        <th scope="col">Pedido</th>
                        <th scope="col">Resumo</th>
                        <th scope="col">Status</th>
                        <th scope="col">Data</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Tema</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        <?php }while ($row = $select->fetch_assoc()); ?>
        </div>
    </main>
    
    
</body>
</head>
</html>
