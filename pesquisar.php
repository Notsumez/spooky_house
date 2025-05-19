<?php 
    include 'connection/connect.php';
    include 'verifica_session.php';

    // Se existir um item de busca digitado ele pesquisa, caso não exista ele mostra tudo
    if(isset($_GET['pesquisar'])){
        $termoBusca = $_GET['pesquisar'];
    }else{
        $termoBusca = null;
    }
    
    // Se a pesquisa foi por itens em destaques ele vai mostrar todos os que estão marcados como destaque
    if (isset($_GET['destaque']) == 'sim'){
        $consulta = $conn->query("SELECT * FROM Produtos WHERE destaque = 'Sim'");
        $row_busca = $consulta->fetch_assoc();
        $num_linhas = $consulta->num_rows;
    // Se não, ele procura itens de acordo com um termo de busca digitado.
    }else{
        $consulta = $conn->query("SELECT * FROM Produtos WHERE descricao OR nome LIKE '%".$termoBusca."%'");
        $row_busca = $consulta->fetch_assoc();
        $num_linhas = $consulta->num_rows;

    }
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
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <title>Produtos Busca - <?php if (isset($termoBusca)) { echo $termoBusca; }elseif (isset($_GET['destaque'])){ echo 'Destaques'; } ?> </title>
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
                <input class="form-control me-2" name="pesquisar" id="bg_form_pesquisar" type="search" placeholder="Pesquisar" value="<?php echo $termoBusca; ?>" aria-label="Search" required>
                <button class="btn_pesquisar" type="submit">Pesquisar</button>
            </form>
            <br>

            <!-- Se não tiver resultados da pesquisa -->
            <?php if($num_linhas == 0 && isset($_GET['pesquisar'])){?>
                <h2 class="text-center" style="font-size: 20pt; color: white;">Resultados para <b style="color: #f8741d;"><?php echo $termoBusca;?></b></h2>
                <p class="text-center" style="color: white; font-size: 15pt;">Este não é um produto. Verifique a ortografia.</p>
            <?php } ?>

            <!-- Se tiver resultado da pesquisa -->
            <?php if($num_linhas>0){?>
                <?php if (isset($_GET['pesquisar'])){?>
                    <h2 class="text-center" style="font-size: 20pt; color: white;">Resultados para <b style="color: #f8741d;"><?php echo $termoBusca;?></b></h2>
                <?php }elseif (isset($_GET['destaque'])){ ?>
                    <h2 class="text-center" style="font-size: 20pt; color: white;">Resultados para <b style="color: #f8741d;">Destaques</b></h2>
                <?php }?>
                <!-- Começo dos cards dos produtos -->
                <div class="d-flex flex-wrap">
                    <?php do { ?>
                        <div class="card card_destaque" style="width: 18rem; margin-right: 20px; margin-bottom: 20px; margin-top: 20px; flex: 0 0 calc(25% - 20px);">
                            <img src="images/Fantasias/<?php echo $row_busca['imagem'];?>" class="card-img-top" style="max-height: 250px;" alt="<?php echo $Row_busca['imagem'];?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row_busca['nome'];?></h5>
                                <p class="card-text"><?php echo $row_busca['resumo'];?></p>
                                <p class="card-text">Preço: <?php echo $row_busca['preco']; ?></p>
                                <a href="detalhes.php?Id=<?php echo $row_busca['id']; ?>"  class="btn" style="background-color: #f8741d;">Ver mais</a>
                            </div>
                        </div>
                    <?php } while ($row_busca = $consulta->fetch_assoc()); ?>
                </div>
            <?php } ?>
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