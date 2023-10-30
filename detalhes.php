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
                                            <span id="AddToCartText">Comprar</span>
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
    <!-- Recomendados -->
    <aside class="related">
      <div class="_cont">
        <h2>You might also like</h2>
        <div class="collection-list cols-4" id="collection-list" data-products-per-page="4">
          <a class="product-box">
            <span class="img">
              <span style="background-image: url('//cdn.shopify.com/s/files/1/1047/6452/products/tricko1_70d2887b-ec6a-4bcb-a93b-7fd1783e6445_grande.jpg?v=1447530130')" class="i first"></span>
              <span class="i second" style="background-image: url('//cdn.shopify.com/s/files/1/1047/6452/products/product_030f9fc5-f253-4dca-a43a-fe2b719d0704_grande.png?v=1447530130')"></span>
            </span>
            <span class="text">
              <strong>Tony Hunfinger T-Shirt New York 2</strong>
              <span>
                From $800.00
              </span>
              <div class="variants">
                <div class="variant">
                  <div class="var m available">
                    <div class="t">M</div>
                  </div>
                  <div class="var l available">
                    <div class="t">L</div>
                  </div>
                  <div class="var xl available">
                    <div class="t">XL</div>
                  </div>
                  <div class="var xxl available">
                    <div class="t">XXL</div>
                  </div>
                </div>
                <div class="variant">
                  <div class="var color blue available">
                    <div class="c" style="background-color: blue;"></div>
                  </div>
                  <div class="var color red available">
                    <div class="c" style="background-color: red;"></div>
                  </div>
                  <div class="var color yellow available">
                    <div class="c" style="background-color: yellow;"></div>
                  </div>
                </div>
              </div>
            </span>
          </a>
          <a class="product-box">
            <span class="img">
              <span style="background-image: url('//cdn.shopify.com/s/files/1/1047/6452/products/tricko2_357767df-d7ff-4b58-b705-edde76bb32b7_grande.jpg?v=1447530150')" class="i first"></span>
              <span class="i second" style="background-image: url('//cdn.shopify.com/s/files/1/1047/6452/products/tricko1_613d5776-ea61-4f9b-abef-0ce847c63a67_grande.jpg?v=1447530150')"></span>
            </span>
            <span class="text">
              <strong>Tony Hunfinger T-Shirt New York 3</strong>
              <span>
                From $800.00
              </span>
              <div class="variants">
                <div class="variant">
                  <div class="var m available">
                    <div class="t">M</div>
                  </div>
                  <div class="var l available">
                    <div class="t">L</div>
                  </div>
                  <div class="var xl available">
                    <div class="t">XL</div>
                  </div>
                  <div class="var xxl available">
                    <div class="t">XXL</div>
                  </div>
                </div>
                <div class="variant">
                  <div class="var color blue available">
                    <div class="c" style="background-color: blue;"></div>
                  </div>
                  <div class="var color red available">
                    <div class="c" style="background-color: red;"></div>
                  </div>
                  <div class="var color yellow available">
                    <div class="c" style="background-color: yellow;"></div>
                  </div>
                </div>
              </div>
            </span>
          </a>
          <a href="/collections/men/products/copy-of-copy-of-copy-of-tommy-hilfiger-t-shirt-new-york-4" class="product-box">
            <span class="img">
              <span style="background-image: url('//cdn.shopify.com/s/files/1/1047/6452/products/tricko3_0e98498a-123c-4305-9d94-d8280bb46416_grande.jpg?v=1447530164')" class="i first"></span>
              <span class="i second" style="background-image: url('//cdn.shopify.com/s/files/1/1047/6452/products/tricko2_6c949188-dba0-4789-9434-c0821b92f3f4_grande.jpg?v=1447530164')"></span>
            </span>
            <span class="text">
              <strong>Tony Hunfinger T-Shirt New York 4</strong>
              <span>
                From $800.00
              </span>
              <div class="variants">
                <div class="variant">
                  <div class="var m available">
                    <div class="t">M</div>
                  </div>
                  <div class="var l available">
                    <div class="t">L</div>
                  </div>
                  <div class="var xl available">
                    <div class="t">XL</div>
                  </div>
                  <div class="var xxl available">
                    <div class="t">XXL</div>
                  </div>
                </div>
                <div class="variant">
                  <div class="var color blue available">
                    <div class="c" style="background-color: blue;"></div>
                  </div>
                  <div class="var color red available">
                    <div class="c" style="background-color: red;"></div>
                  </div>
                  <div class="var color yellow available">
                    <div class="c" style="background-color: yellow;"></div>
                  </div>
                </div>
              </div>
            </span>
          </a>
          <a class="product-box">
            <span class="img">
              <span style="background-image: url('//cdn.shopify.com/s/files/1/1047/6452/products/product_7d606126-1b60-4738-99b3-062810f2db8b_grande.png?v=1447530674')" class="i first"></span>
              <span class="i second" style="background-image: url('//cdn.shopify.com/s/files/1/1047/6452/products/tricko3_fd08d231-654c-4304-81b2-9191e6fd141e_grande.jpg?v=1447530674')"></span>
            </span>
            <span class="text">
              <strong>Tony Hunfinger T-Shirt New York 5</strong>
              <span>
                From $800.00
              </span>
              <div class="variants">
                <div class="variant">
                  <div class="var m available">
                    <div class="t">M</div>
                  </div>
                  <div class="var l available">
                    <div class="t">L</div>
                  </div>
                  <div class="var xl available">
                    <div class="t">XL</div>
                  </div>
                  <div class="var xxl available">
                    <div class="t">XXL</div>
                  </div>
                </div>
                <div class="variant">
                  <div class="var color blue available">
                    <div class="c" style="background-color: blue;"></div>
                  </div>
                  <div class="var color red available">
                    <div class="c" style="background-color: red;"></div>
                  </div>
                  <div class="var color yellow available">
                    <div class="c" style="background-color: yellow;"></div>
                  </div>
                </div>
              </div>
            </span>
          </a>
          <a class="product-box hidden">
            <span class="img">
              <span style="background-image: url('//cdn.shopify.com/s/files/1/1047/6452/products/tricko1_bba77d82-7f85-47af-9a45-f4700bcc04ad_grande.jpg?v=1447530689')" class="i first"></span>
              <span class="i second" style="background-image: url('//cdn.shopify.com/s/files/1/1047/6452/products/product_f065e961-d296-48a8-8a67-a3532200e257_grande.png?v=1447530689')"></span>
            </span>
            <span class="text">
              <strong>Tony Hunfinger T-Shirt New York 6</strong>
              <span>
                From $800.00
              </span>
              <div class="variants">
                <div class="variant">
                  <div class="var m available">
                    <div class="t">M</div>
                  </div>
                  <div class="var l available">
                    <div class="t">L</div>
                  </div>
                  <div class="var xl available">
                    <div class="t">XL</div>
                  </div>
                  <div class="var xxl available">
                    <div class="t">XXL</div>
                  </div>
                </div>
                <div class="variant">
                  <div class="var color blue available">
                    <div class="c" style="background-color: blue;"></div>
                  </div>
                  <div class="var color red available">
                    <div class="c" style="background-color: red;"></div>
                  </div>
                  <div class="var color yellow available">
                    <div class="c" style="background-color: yellow;"></div>
                  </div>
                </div>
              </div>
            </span>
          </a>
          <a class="product-box hidden">
            <span class="img">
              <span style="background-image: url('//cdn.shopify.com/s/files/1/1047/6452/products/tricko2_bf59c7f2-7c1f-4822-9494-6a984598a56c_grande.jpg?v=1447530706')" class="i first"></span>
              <span class="i second" style="background-image: url('//cdn.shopify.com/s/files/1/1047/6452/products/tricko1_c6fa0fc1-99a0-4bd0-a1d8-0270127977fc_grande.jpg?v=1447530706')"></span>
            </span>
            <span class="text">
              <strong>Tony Hunfinger T-Shirt New York 7</strong>
              <span>
                From $800.00
              </span>
              <div class="variants">
                <div class="variant">
                  <div class="var m available">
                    <div class="t">M</div>
                  </div>
                  <div class="var l available">
                    <div class="t">L</div>
                  </div>
                  <div class="var xl available">
                    <div class="t">XL</div>
                  </div>
                  <div class="var xxl available">
                    <div class="t">XXL</div>
                  </div>
                </div>
                <div class="variant">
                  <div class="var color blue available">
                    <div class="c" style="background-color: blue;"></div>
                  </div>
                  <div class="var color red available">
                    <div class="c" style="background-color: red;"></div>
                  </div>
                  <div class="var color yellow available">
                    <div class="c" style="background-color: yellow;"></div>
                  </div>
                </div>
              </div>
            </span>
          </a>
        </div>
        <div class="more-products" id="more-products-wrap">
          <span id="more-products" data-rows_per_page="1">More products</span>
        </div>
      </div>
    </aside>
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