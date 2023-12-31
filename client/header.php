<header id="header">
    <nav class="navbar navbar-expand-lg" id="bg_nav">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" id="logo_header" href="../index.php">
                <img src="../images/halloween.svg" width="7%" alt="Logo Spooky House"> 
                Spooky House
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" id="Sometype" style="<?php if (basename($_SERVER['PHP_SELF']) == 'index.php') { echo 'color: #f8741d;'; } ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="Sometype" style="<?php if (basename($_SERVER['PHP_SELF']) == 'conta.php') { echo 'color: #f8741d;'; } ?>" aria-current="page" href="conta.php">Conta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="Sometype" href="carrinho.php" style="<?php if (basename($_SERVER['PHP_SELF']) == 'carrinho.php') { echo 'color: #f8741d;'; } ?>">Carrinho</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="Sometype" href="pedidos.php" style="<?php if (basename($_SERVER['PHP_SELF']) == 'pedidos.php') { echo 'color: #f8741d;'; } ?>">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <form action="verifica_session.php" method="post">
                            <button type="submit" class="nav-link" id="Sometype" name="logout">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                                </svg>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
