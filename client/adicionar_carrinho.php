<?php 
    include '../verifica_session.php';
    include '../connection/connect.php';

    $select = $conn->query("SELECT * FROM Produtos INNER JOIN Comentarios ON Comentarios.id_produto = Produtos.id;");
    $Row_produtos = $select->fetch_assoc();

    if (isset($_GET)){
        $add = $Row_produtos['id'];

        $sql_fav = "UPDATE Carrinho
        SET id_produto = '$add',
        id_cliente = '".$_SESSION['Id']."';";

        $resultadofav = $conn->query($sql_fav);
        if($resultadofav){
            // header('location: carrinho.php?upd=s');
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link para Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Link para o CSS -->
    <link rel="stylesheet" href="../CSS/fav.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Adicionar Produto ao Carrinho</title>
</head>
<body id="fundo_index">
    <!-- Background que faz efeito no fundo do site -->
    <img src="images/elementos/shape-bg.png" class="shape_bg">
    <!-- Header -->
    <?php include 'header.php';?>

    <!-- Conteúdo -->
    <main id="produtos">
        <div class="container" style="margin-top: 20px; margin-bottom: 80px;">
            <br>
            <h2 class="text-center" style="font-size: 20pt; color: white;">Produtos</h2>
            <!-- Começo dos cards dos produtos -->
            <div class="d-flex flex-wrap">
                <?php do { ?>
                    <div class="card card_destaque" style="width: 18rem; margin-right: 20px; margin-bottom: 20px; margin-top: 20px; flex: 0 0 calc(25% - 20px);">
                        <img src="../images/Fantasias/<?php echo $Row_produtos['imagem'];?>" class="card-img-top" style="max-height: 250px;" alt="<?php echo $Row_produtos['imagem'];?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $Row_produtos['nome'];?></h5>
                            <p class="card-text"><?php echo $Row_produtos['resumo'];?></p>
                            <p class="card-text">Preço: <?php echo $Row_produtos['preco']; ?></p>
                            <?php do{?>
                                <?php }while ($Row_produtos['avaliacao'] = $select->fetch_assoc());?>
                                <br><br>
                            <a href="detalhes.php?Id=<?php echo $Row_produtos['id']; ?>" class="btn float-right" style="background-color: #f8741d; color: white;">Ver mais</a>
                            <a href="adicionar_carrinho.php?<?php echo $Row_produtos['id']; ?>">
                                <svg id="fav" width="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#e92525"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8.96173 18.9109L9.42605 18.3219L8.96173 18.9109ZM12 5.50063L11.4596 6.02073C11.601 6.16763 11.7961 6.25063 12 6.25063C12.2039 6.25063 12.399 6.16763 12.5404 6.02073L12 5.50063ZM15.0383 18.9109L15.5026 19.4999L15.0383 18.9109ZM9.42605 18.3219C7.91039 17.1271 6.25307 15.9603 4.93829 14.4798C3.64922 13.0282 2.75 11.3345 2.75 9.1371H1.25C1.25 11.8026 2.3605 13.8361 3.81672 15.4758C5.24723 17.0866 7.07077 18.3752 8.49742 19.4999L9.42605 18.3219ZM2.75 9.1371C2.75 6.98623 3.96537 5.18252 5.62436 4.42419C7.23607 3.68748 9.40166 3.88258 11.4596 6.02073L12.5404 4.98053C10.0985 2.44352 7.26409 2.02539 5.00076 3.05996C2.78471 4.07292 1.25 6.42503 1.25 9.1371H2.75ZM8.49742 19.4999C9.00965 19.9037 9.55954 20.3343 10.1168 20.6599C10.6739 20.9854 11.3096 21.25 12 21.25V19.75C11.6904 19.75 11.3261 19.6293 10.8736 19.3648C10.4213 19.1005 9.95208 18.7366 9.42605 18.3219L8.49742 19.4999ZM15.5026 19.4999C16.9292 18.3752 18.7528 17.0866 20.1833 15.4758C21.6395 13.8361 22.75 11.8026 22.75 9.1371H21.25C21.25 11.3345 20.3508 13.0282 19.0617 14.4798C17.7469 15.9603 16.0896 17.1271 14.574 18.3219L15.5026 19.4999ZM22.75 9.1371C22.75 6.42503 21.2153 4.07292 18.9992 3.05996C16.7359 2.02539 13.9015 2.44352 11.4596 4.98053L12.5404 6.02073C14.5983 3.88258 16.7639 3.68748 18.3756 4.42419C20.0346 5.18252 21.25 6.98623 21.25 9.1371H22.75ZM14.574 18.3219C14.0479 18.7366 13.5787 19.1005 13.1264 19.3648C12.6739 19.6293 12.3096 19.75 12 19.75V21.25C12.6904 21.25 13.3261 20.9854 13.8832 20.6599C14.4405 20.3343 14.9903 19.9037 15.5026 19.4999L14.574 18.3219Z" fill="#e92525"></path> </g></svg>
                            </a> 
                            <a href="adicionar_carrinho.php?<?php echo $Row_produtos['id']; ?>">
                                <svg id="fav-alt" width="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2 9.1371C2 14 6.01943 16.5914 8.96173 18.9109C10 19.7294 11 20.5 12 20.5C13 20.5 14 19.7294 15.0383 18.9109C17.9806 16.5914 22 14 22 9.1371C22 4.27416 16.4998 0.825464 12 5.50063C7.50016 0.825464 2 4.27416 2 9.1371Z" fill="#e92525"></path> </g></svg>
                            </a>   
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
    <script>
        // Função para alternar entre os ícones
        function toggleIcon() {
            var icon = document.getElementById("fav");
            var altIcon = document.getElementById("fav-alt");
    
            if (icon.style.display !== "none") {
                icon.style.display = "none";
                altIcon.style.display = "inline";
            } else {
                icon.style.display = "inline";
                altIcon.style.display = "none";
            }
        }

        // Adicione um ouvinte de evento de clique ao ícone
            var icon = document.getElementById("fav");
            var altIcon = document.getElementById("fav-alt");
                icon.addEventListener("click", toggleIcon);
                altIcon.addEventListener("click", toggleIcon);
    </script>
</html>