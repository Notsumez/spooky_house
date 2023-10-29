<?php 
    include '../connection/connect.php';

    $ID = $_GET['id'];

    $sql_item = "DELETE FROM Item_pedido
        WHERE id_pedido = '$ID';";

    $resultado_item = $conn->query($sql_item);

    $sql = "DELETE FROM Pedidos
        WHERE id = '$ID';";

    $resultado = $conn->query($sql);
    if ($resultado && $resultado_item){
        header('location: pedidos.php');
    }else{
        echo "não passou";
    }
?>