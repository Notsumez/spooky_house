<?php 
    $selectDestaques = $conn->query("SELECT * FROM Produtos WHERE destaque = 'Sim' LIMIT 3");
    $row_destaque = $selectDestaques->fetch_assoc();
?>
<section id="destaques" style="margin-top: 80px; margin-bottom: 80px;">
    <div class="container d-flex justify-content-center">
        <div>
            <h1 class="text-light">PRODUTOS EM DESTAQUE</h1>
            <p class="text-light" id="txt_motivacional">
                Os produtos mais comprados e <br> 
                bem avaliados pelos usuários!!
            </p>
            <a href="produtos.php?destaques=s">
                <button class="btn_destaques">
                    <span class="btn_destaques-content">Veja Mais</span>
                </button>
            </a>
        </div>
        <!-- Estrutura de repetição dos Cards -->
        <?php do { ?>
            <div class="card card_destaque" style="width: 18rem;">
                <img src="images/Fantasias/<?php echo $row_destaque['imagem']; ?>" class="card-img-top" alt="<?php echo $row_destaque['imagem']; ?>" style="width: 100%; max-height: 250px;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row_destaque['nome'];?></h5>
                    <p class="card-text"><?php echo $row_destaque['resumo'];?></p>
                    <a href="#" class="btn" style="background-color: #f8741d;">Detalhes</a>
                </div>
            </div>
        <?php } while ($row_destaque = $selectDestaques->fetch_assoc()) ?>
    </div>
    <br>
</section>