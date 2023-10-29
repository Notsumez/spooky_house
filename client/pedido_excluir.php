<?php 
    include '../connection/connect.php';

    $ID = $_GET['id'];

    $sql = "UPDATE Pedidos
        SET status = 'Cancelado', data_cancel = NOW()
        WHERE id = '$ID';";

    $resultado = $conn->query($sql);
    if ($resultado){
        header('location: pedidos.php');
    }
?>