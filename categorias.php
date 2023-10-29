<?php 
    include 'connection/connect.php';
    include 'verifica_session.php';

    $sql = $conn->query("SELECT *, P.id as id_produto, C.nome as nome_categoria, P.nome as nome_produto FROM Categorias C INNER JOIN Produtos_categorias PC ON PC.id_categoria = C.id INNER JOIN Produtos P ON PC.id_produto = P.id;");
    $row_categoria = $sql->fetch_assoc();
    $num_linhas = $sql->num_rows;

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link para Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Link para o CSS -->
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/fav.css">
    <link rel="stylesheet" href="CSS/card.css">
    <link rel="shortcut icon" href="images/Elementos/favicon.png" type="image/x-png">
    <title>Categorias - Spooky House</title>
</head>
<body id="fundo_index"> 
    <?php include 'header.php';?>
    <!-- Background que faz efeito no fundo do site -->
    <img src="images/elementos/shape-bg.png" class="shape_bg">
    <noscript>Este site necessita de javascript para funcionar.</noscript>

    <?php if($num_linhas == 0){?>
        <section style="margin: 250px;">
            <h2 class="text-center" style="font-size: 20pt; color: white;">Nenhuma categoria foi adicionada ainda.</h2>
        </section>
    <?php } ?>

    <?php if($num_linhas>0){?>
        <main class="container" id="container" style="margin-top: 40px; margin-bottom: 80px;">
        <?php do {?>
            <div class="card">
                <div class="content">
                    <div class="back">
                        <div class="back-content">
                            <img src="images/categorias/<?php echo $row_categoria['img']?>" width="60px" alt="">
                            <strong><?php echo $row_categoria['nome_categoria'];?></strong>
                        </div>
                    </div>
                    <!-- Frente do cartão -->
                    <div class="front">
                        <div class="img">
                            <div class="circle"></div>
                            <div class="circle" id="right"></div>
                            <div class="circle" id="bottom"></div>
                        </div>

                        <div class="front-content">
                            <small class="badge">Categoria</small>
                            <div class="description">
                                <div class="title">
                                    <p class="title">
                                        <a href="detalhes.php?id=<?php echo $row_categoria['id_produto']; ?>" id="btnVer">
                                            <strong>Ver mais</strong>
                                        </a>
                                    </p>
                                    <svg fill-rule="nonzero" height="15px" width="15px" viewBox="0,0,256,256" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"><g style="mix-blend-mode: normal" text-anchor="none" font-size="none" font-weight="none" font-family="none" stroke-dashoffset="0" stroke-dasharray="" stroke-miterlimit="10" stroke-linejoin="miter" stroke-linecap="butt" stroke-width="1" stroke="none" fill-rule="nonzero" fill="#20c997"><g transform="scale(8,8)"><path d="M25,27l-9,-6.75l-9,6.75v-23h18z"></path></g></g></svg>
                                </div>
                                <p class="card-footer">
                                    <?php echo $row_categoria['descri'];?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }while ($row_categoria = $sql->fetch_assoc());?>
        </main>
    <?php }?>
    
    <?php include 'footer.php';?>
</body>
<!-- Scroll Reveal -->
<script src="js/scrollReveal.js"></script>
    <!-- Link para Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Link para as funções JavaScript -->
    <script src="js/script.js"></script>
</html>