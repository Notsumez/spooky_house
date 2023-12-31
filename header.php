<header id="header">
    <nav class="navbar navbar-expand-lg" id="bg_nav">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" id="logo_header" href="index.php">
                <img src="images/halloween.svg" width="7%" alt="Logo Spooky House"> 
                Spooky House
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" id="Sometype" aria-current="page" href="<?php if ($_SERVER['REQUEST_URI'] == 'index.php') { echo '#home'; } else { echo 'index.php#home';} ?>" style="<?php if (basename($_SERVER['PHP_SELF']) == 'index.php') { echo 'color: #f8741d;'; } ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="Sometype" href="<?php if ($_SERVER['REQUEST_URI'] == 'index.php') { echo '#destaques'; } else { echo 'index.php#destaques';} ?>">Destaques</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="Sometype" href="<?php if ($_SERVER['REQUEST_URI'] == 'index.php') { echo '#sobre'; } else { echo 'index.php#sobre';} ?>">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle nav-link" id="Sometype" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="<?php if (basename($_SERVER['PHP_SELF']) == 'produtos.php' || basename($_SERVER['PHP_SELF']) == 'pesquisar.php') { echo 'color: #f8741d;'; } ?>">
                                Produtos
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php if ($_SERVER['REQUEST_URI'] == 'produtos.php') { echo '#produtos'; } else { echo 'produtos.php#produtos';} ?>">Geral</a></li>
                                <li><a class="dropdown-item" href="categorias.php">Categorias</a></li>
                                <li><a class="dropdown-item" href="temas.php">Temas</a></li>
                            </ul>
                        </div>                    </li>
                    <li class="nav-item dropdown" style="margin-right: 30px;">
                        <button class="nav-link btn_config" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" height="20" fill="none" class="svg-icon"><g stroke-width="1.5" stroke-linecap="round" stroke="#5d41de"><circle r="2.5" cy="10" cx="10"></circle><path fill-rule="evenodd" d="m8.39079 2.80235c.53842-1.51424 2.67991-1.51424 3.21831-.00001.3392.95358 1.4284 1.40477 2.3425.97027 1.4514-.68995 2.9657.82427 2.2758 2.27575-.4345.91407.0166 2.00334.9702 2.34248 1.5143.53842 1.5143 2.67996 0 3.21836-.9536.3391-1.4047 1.4284-.9702 2.3425.6899 1.4514-.8244 2.9656-2.2758 2.2757-.9141-.4345-2.0033.0167-2.3425.9703-.5384 1.5142-2.67989 1.5142-3.21831 0-.33914-.9536-1.4284-1.4048-2.34247-.9703-1.45148.6899-2.96571-.8243-2.27575-2.2757.43449-.9141-.01669-2.0034-.97028-2.3425-1.51422-.5384-1.51422-2.67994.00001-3.21836.95358-.33914 1.40476-1.42841.97027-2.34248-.68996-1.45148.82427-2.9657 2.27575-2.27575.91407.4345 2.00333-.01669 2.34247-.97026z" clip-rule="evenodd"></path></g></svg>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="d-flex" >
                                    <div>
                                        <a class="dropdown-item" href="client/index.php">Conta</a>
                                        <a class="dropdown-item" href="client/carrinho.php">Meu Carrinho</a>
                                    </div>
                                    <?php 
                                        $sql_header = $conn->query("SELECT imagem FROM Clientes WHERE id = ".$_SESSION['Id'].";");
                                        $row = $sql_header->fetch_assoc();
                                    ?>
                                    <a href="client/conta.php">
                                        <img src="images/perfil/<?php echo $row['imagem']; ?>" width="100%" alt="" style="border: 1px solid white; border-radius: 20px;">
                                    </a>
                                </div>
                            </li>
                            <li><a class="dropdown-item" href="client/pedidos.php">Pedidos em Andamento</a></li>
                            <hr style="color: white;">
                            <form method="post">
                                <button type="submit" class="dropdown-item" name="logout">Sair</button>
                            </form>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>