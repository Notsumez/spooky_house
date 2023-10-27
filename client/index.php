<?php 
    include '../verifica_session.php';
    include '../connection/connect.php';


    $ID = $_SESSION['Id'];
    $select = $conn->query("SELECT * FROM Clientes WHERE id = ".$ID.";");
    $row_cliente = $select->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link para Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Link para o CSS -->
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Área do Cliente - <?php echo $row_cliente['nome'];?> </title>
</head>
<body id="fundo_index">
    <?php include 'header.php';?>
    <!-- Background que faz efeito no fundo do site -->
    <img src="../images/elementos/shape-bg.png" class="shape_bg">
    <noscript>Este site necessita de javascript para funcionar.</noscript>
        
    <main class="container-fluid" style="margin-bottom: 80px;">
        <div class="d-flex justify-content-center" style="margin-top: 20px; ">
            <img src="../images/perfil/<?php echo $row_cliente['imagem']; ?>" alt="<?php echo $row_cliente['imagem']; ?>" style="border-radius: 50%; max-width: 150px; border: 2px solid #f8741d;">
        </div>
        <h1 class="text-light text-center" style="margin-bottom: 40px;">Bem vindo, <?php echo $row_cliente['nome'];?></h1>
        <div class="d-flex" style="flex-direction: column;">
            <div class="d-flex justify-content-center" style="margin-bottom: 50px;">
                <!-- Conta -->
                <a href="conta.php">
                    <div class="card card_destaque inflar_mouse" style="width: 18rem;">
                        <h1 class="card-title text-center">Conta</h1>
                        <div class="d-flex justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-gear" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
                            </svg>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Confirgurações sobre seu nome, foto de perfil, endereço, email, etc.</p>
                        </div>
                    </div>
                </a>
                <!-- Carrinho -->
                <a href="carrinho.php">
                    <div class="card card_destaque inflar_mouse" style="width: 18rem; margin-left: 50px; margin-right: 50px;">
                        <h1 class="card-title text-center">Carrinho</h1>
                        <div class="d-flex justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                            </svg>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Itens adicionados ao seu carrinho de compras.</p>
                        </div>
                    </div>
                </a>
                <!-- Notificações -->
                <a href="notificacoes.php">
                    <div class="card card_destaque inflar_mouse" style="width: 18rem;">
                        <h1 class="card-title text-center">Notificações</h1>
                        <div class="d-flex justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                            </svg>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Notificações sobre o andamento de seus pedidos.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="d-flex justify-content-center"> 
                <!-- Pedidos -->
                <a href="pedidos.php">
                    <div class="card card_destaque inflar_mouse" style="width: 18rem; margin-left: 25px;">
                        <h1 class="card-title text-center">Pedidos</h1>
                        <div class="d-flex justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                            </svg>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Seus pedidos, em andamento ou cancelados.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </main>
    
    <?php include 'footer.php';?>
</body>
    <!-- Link para Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Link para as funções JavaScript -->
    <script src="../js/script.js"></script>
</html>