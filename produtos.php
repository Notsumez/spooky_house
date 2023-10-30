<?php 
    include 'verifica_session.php';
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
    <link rel="stylesheet" href="CSS/card2.css">
    <link rel="shortcut icon" href="images/Elementos/favicon.png" type="image/x-png">
    <title>Produtos - Navegar</title>
</head>
<body id="fundo_index">
    <!-- Background que faz efeito no fundo do site -->
    <img src="images/elementos/shape-bg.png" class="shape_bg">
    <!-- Header -->
    <?php include 'header.php';?>

    <!-- Conteúdo -->
    <main id="produtos">
        <div class="container" style="margin-top: 20px; margin-bottom: 80px;">
            <form action="pesquisar.php" class="d-flex" role="search" id="Pesquisar">
                <input class="form-control me-2" name="pesquisar" id="bg_form_pesquisar" type="search" placeholder="Pesquisar" aria-label="Search">
                <button class="btn_pesquisar" type="submit">Pesquisar</button>
            </form>
            <br>
            <h2 class="text-center" style="font-size: 20pt; color: white;">Produtos Gerais</h2>
            <!-- Começo dos cards dos produtos -->
            <div class="d-flex flex-wrap">
                <div class="container" id="container">
                    <?php do { ?>
                        <div class="card">
                            <div class="card-img"><img src="images/Fantasias/<?php echo $Row_produtos['imagem'];?>" class="card-img-top" style="max-height: 200px;" alt="<?php echo $Row_produtos['imagem'];?>"></div>
                        <div class="card-title"><?php echo $Row_produtos['nome'];?></div>
                        <div class="card-subtitle text-light text-center"><?php echo $Row_produtos['resumo'];?></p></div>
                        <div class="card-footer">
                            <div class="card-price ">
                                <span>R$ <?php echo $Row_produtos['preco']; ?></span>
                            </div>
                            <a href="detalhes.php?Id=<?php echo $Row_produtos['id']; ?>" class="card-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="m397.78 316h-205.13a15 15 0 0 1 -14.65-11.67l-34.54-150.48a15 15 0 0 1 14.62-18.36h274.27a15 15 0 0 1 14.65 18.36l-34.6 150.48a15 15 0 0 1 -14.62 11.67zm-193.19-30h181.25l27.67-120.48h-236.6z"></path><path d="m222 450a57.48 57.48 0 1 1 57.48-57.48 57.54 57.54 0 0 1 -57.48 57.48zm0-84.95a27.48 27.48 0 1 0 27.48 27.47 27.5 27.5 0 0 0 -27.48-27.47z"></path><path d="m368.42 450a57.48 57.48 0 1 1 57.48-57.48 57.54 57.54 0 0 1 -57.48 57.48zm0-84.95a27.48 27.48 0 1 0 27.48 27.47 27.5 27.5 0 0 0 -27.48-27.47z"></path><path d="m158.08 165.49a15 15 0 0 1 -14.23-10.26l-25.71-77.23h-47.44a15 15 0 1 1 0-30h58.3a15 15 0 0 1 14.23 10.26l29.13 87.49a15 15 0 0 1 -14.23 19.74z"></path></svg>
                            </a>
                        </div>
                    </div>
                    <?php } while ($Row_produtos = $select->fetch_assoc()); ?>
                </div>
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