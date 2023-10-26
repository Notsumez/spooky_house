<?php 
    include 'connection/connect.php';

    $select = $conn->query("SELECT * FROM Produtos;");
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
    <!-- Background que faz efeito no fundo do site -->
    <img src="images/elementos/shape-bg.png" class="shape_bg">
    <!-- Header -->
    <?php include 'header.php';?>

    <!-- Conteúdo -->
    <main id="produtos">
        <div class="container" style="margin-top: 20px;">
            <form action="produtos.php" class="d-flex" role="search" id="Pesquisar">
                <input class="form-control me-2" id="bg_form_pesquisar" type="search" placeholder="Pesquisar" aria-label="Search">
                <button class="btn_pesquisar" type="submit">Pesquisar</button>
            </form>
            <br>
            <div class="d-flex flex-wrap">
                <?php do { ?>
                    <div class="card card_destaque" style="width: 18rem; margin-right: 20px; margin-bottom: 20px; margin-top: 20px; flex: 0 0 calc(25% - 20px);">
                        <img src="images/Fantasias/<?php echo $Row_produtos['imagem'];?>" class="card-img-top" style="max-height: 250px;" alt="<?php echo $Row_produtos['imagem'];?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $Row_produtos['nome'];?></h5>
                            <p class="card-text"><?php echo $Row_produtos['resumo'];?></p>
                            <a href="#" class="btn btn-primary">Ver mais</a>
                        </div>
                    </div>
                <?php } while ($Row_produtos = $select->fetch_assoc()); ?>
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