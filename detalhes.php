<?php
    include 'connection/connect.php';
    include 'verifica_session.php';

    $ID = $_GET['Id'];
    $select = $conn->query("SELECT *, CL.nome as nome_cli, CL.imagem as img_cli, P.nome as nome_produto, P.imagem as img_produto FROM Produtos P INNER JOIN Comentarios C ON C.id_produto = P.id INNER JOIN Clientes CL ON CL.id = C.id_cliente WHERE P.Id = '$ID'");
    $row_detalhes = $select->fetch_assoc();


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
    <link rel="stylesheet" href="CSS/detalhes.css">
    <link rel="shortcut icon" href="images/Elementos/favicon.png" type="image/x-png">
    <title>Detalhes - </title>
</head>
<body id="fundo_index">
    
    <!-- Background que faz efeito no fundo do site -->
    <img src="images/elementos/shape-bg.png" class="shape_bg">

    <section aria-label="Main content" role="main" class="product-detail">
        <div itemscope itemtype="http://schema.org/Product">
            <div class="shadow">
                <div class="_cont detail-top">
                    <div class="cols">
                        <div class="left-col">
                            <div class="big">
                                <span id="big-image" class="img" quickbeam="image" style="background-image: url('images/Fantasias/<?php echo $row_detalhes['img_produto'];?>')" data-src="images/Fantasias/<?php echo $row_detalhes['imagem'];?>"></span>
                            </div>
                        </div>
                        <div class="right-col">
                            <h1 itemprop="name" class="text-light"><?php echo $row_detalhes['nome_produto'];?></h1>
                                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                    <meta itemprop="priceCurrency" content="USD">
                                    <link itemprop="availability" href="http://schema.org/InStock">
                                    <div class="price-shipping">
                                        <div class="price" id="price-preview" quickbeam="price" quickbeam-price="800" style="color: #F8741D;">
                                            R$ <?php echo $row_detalhes['preco'];?>
                                        </div>
                                        <a class="text-light">
                                            <?php if(isset($row_detalhes['destaque']) == 'Sim'){?>
                                                Produto em Destaque
                                            <?php }?>
                                        </a>
                                    </div>
                                <!-- Form quantidade de itens -->
                                <form method="post" enctype="multipart/form-data" id="AddToCartForm"> 
                                    <div class="btn-and-quantity-wrap">
                                        <div class="btn-and-quantity">
                                            <div class="spinner" style="color: white;">
                                                <span class="btn minus" id="decrease"></span>
                                                <input type="tel" id="quantidade" name="quantidade" value="1" maxlength="<?php echo $row_detalhes['quantidade']; ?>" style="background: transparent; color: white;">
                                                <input type="hidden" id="id_prod" name="id_prod" value="<?php echo $row_detalhes['id']; ?>">
                                                <span class="q">QTD</span>
                                                <span class="btn plus" id="increase"></span>
                                            </div>
                                            <div id="AddToCart">
                                                <a href="client/adicionar_pedido.php" id="AddToCartText">Comprar</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="tabs">
                                    <div class="tab-labels">
                                        <span data-id="1" class="active">Info</span>
                                        <span data-id="2">Coments</span>
                                    </div>
                                    <div class="tab-slides">
                                        <div id="tab-slide-1" itemprop="description" class="slide active text-light" style="font-size: 13pt;">
                                            <?php echo $row_detalhes['descricao'];?>
                                        </div>
                                        <!-- comentários -->
                                        <?php if (isset($row_detalhes['comentario'])){ ?>
                                            <div id="tab-slide-2" class="slide">
                                                <div class ="comment">
                                                    <div class ="profıle-ımage">
                                                        <img src="images/perfil/<?php echo $row_detalhes['img_cli']; ?>" alt="<?php echo $row_detalhes['img_cli']; ?>">
                                                    </div>
                                                    <div class="username">
                                                        <?php echo $row_detalhes['nome_cli']; ?>
                                                    </div>
                                                    <div class="rating" style="margin-right: 10px;">
                                                        <input value="5" name="rate" id="star5" type="radio" disabled>
                                                        <label title="text" for="star5"></label>
                                                        <input value="4" name="rate" id="star4" type="radio" disabled>
                                                        <label title="text" for="star4"></label>
                                                        <input value="3" name="rate" id="star3" type="radio" disabled checked="">
                                                        <label title="text" for="star3"></label>
                                                        <input value="2" name="rate" id="star2" type="radio" disabled>
                                                        <label title="text" for="star2"></label>
                                                        <input value="1" name="rate" id="star1" type="radio" disabled>
                                                        <label title="text" for="star1"></label>
                                                    </div>
                                                    <div class ="user-comment">
                                                        <p>
                                                            <?php echo $row_detalhes['comentario'];?>
                                                        </p>
                                                    </div>
                                                </div> 
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php';?>
</body>
    <!-- Link para Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Link para as funções JavaScript -->
    <script src="js/script.js"></script>
    <script src="js/detalhes.js"></script>
</html>