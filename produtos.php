<?php 
    include 'connection/connect.php';

    $select = $conn->query("SELECT * FROM Produtos");
    $Row_produtos = $select->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link para Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Link para CSS -->
    <link rel="stylesheet" href="CSS/style.css">
    <title>Produtos - Navegar</title>
</head>
<body id="fundo_index">
    <!-- Header -->
    <?php include 'header.php';?>

    <!-- Conteúdo -->
    <main id="produtos">
        <div class="container">
            <form action="produtos.php" class="d-flex" role="search" id="Pesquisar">
                <input class="form-control me-2" id="bg_form_pesquisar" type="search" placeholder="Pesquisar" aria-label="Search">
                <button class="btn_pesquisar" type="submit">Pesquisar</button>
            </form>
            <br>
            <div>
                <?php do { ?>
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                <?php }while($Row_produtos = $select->fetch_assoc()); ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'footer.php';?>
</body>
    <!-- Scroll Reveal -->
    <script src="js/scrollReveal.js"></script>
    <!-- Link para Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Link para as funções JavaScript -->
    <script src="js/script.js"></script>
</html>