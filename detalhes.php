<?php 
    include 'connection/connect.php';
    include 'verifica_session.php';

    $ID = $_GET['Id'];
    $select = $conn->query("SELECT * FROM Produtos Where Id");
    $row_detalhes = $select->fetch_assoc();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>