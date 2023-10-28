<?php 
    include 'connection/connect.php';

    $cod = isset($_GET['codigo']) ? $_GET['codigo'] : '';

    if(isset($_POST['btn_verifica'])){
        $um = $_POST['um'];
        $dois = $_POST['dois'];
        $tres = $_POST['tres'];
        $quatro = $_POST['quatro'];
        $cod_recu = $_POST['cod_recu'];

        // Remova caracteres não numéricos do CPF
        $cpfNumerico = preg_replace("/[^0-9]/", "", md5($cod_recu));
    
        // Pegue os cinco primeiros dígitos do CPF
        $codigo = substr($cpfNumerico, 0, 4);
        
        $stringCombinada = $um . $dois . $tres . $quatro;

        if ($codigo == $stringCombinada){
            header("location: recuperacao3.php?cpf=$cod_recu");
        }else{
            echo "falha";
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
    <!-- Link do JQUERY -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- Link para o CSS -->
    <link rel="stylesheet" href="CSS/recuperacao.css">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="shortcut icon" href="images/Elementos/favicon.png" type="image/x-png">
    <title>Recuperação - Etapa 2 - Spooky House</title>
</head>
<body class="fundo_login">
    <div class="container">
        <div class="d-flex justify-content-center" style="margin-top: 50px;">
            <form action="recuperacao2.php" method="post" class="form" enctype="multipart/form-data">
                <input name="cod_recu" id="cod_recu" value="<?php if(isset($cod)) { echo $cod; } ?>" type="text" hidden>

                <span class="close">X</span>
                
                <div class="info">
                    <span class="title">Email Enviado!!
                        <svg viewBox="0 0 24 24" data-name="Layer 1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title></title><path d="M12.3232,8.03613l-1.3183-.71484a3.13222,3.13222,0,0,0-.8584-3.76563l1.0068-1.11132A4.6226,4.6226,0,0,1,12.3232,8.03613Z" style="fill:#c78657"></path><path d="M7.125,6h-.25C4.1826,6,2,9.35785,2,13.5S4.1826,21,6.875,21h.25C9.8174,21,12,17.6422,12,13.5S9.8174,6,7.125,6Z" style="fill:#ffab66"></path><path d="M17.125,6h-.25C14.1826,6,12,9.35785,12,13.5S14.1826,21,16.875,21h.25C19.8174,21,22,17.6422,22,13.5S19.8174,6,17.125,6Z" style="fill:#ffab66"></path><path d="M12.0758,6h-.1516C9.20465,6,7,9.35785,7,13.5S9.20465,21,11.9242,21h.1516C14.7954,21,17,17.6422,17,13.5S14.7954,6,12.0758,6Z" style="fill:#ffab66"></path><polygon points="10 12 5 12 6 9 10 12" style="fill:#fff"></polygon><polygon points="14 12 19 12 18 9 14 12" style="fill:#fff"></polygon><polygon points="13.5 14 10.5 14 12 12 13.5 14" style="fill:#fff"></polygon><polygon points="15.111 17.828 12 16.791 8.889 17.828 5.584 15.624 6.416 14.376 9.111 16.172 12 15.209 14.889 16.172 17.584 14.376 18.416 15.624 15.111 17.828" style="fill:#fff7c2"></polygon></g></svg>
                    </span>
                    <p class="description">Verifique em sua caixa de email. Enviamos um código para você.</p>
                </div>
                <div class="input-fields">
                    <input maxlength="1" name="um" type="tel" placeholder="">
                    <input maxlength="1" name="dois" type="tel" placeholder="">
                    <input maxlength="1" name="tres" type="tel" placeholder="">
                    <input maxlength="1" name="quatro" type="tel" placeholder="">
                </div>
                
                <div class="action-btns">
                    <button type="submit" name="btn_verifica" class="verify">Verificar</button>
                    <button class="clear">Limpar</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    const inputs = document.querySelectorAll('.input-fields input');

    inputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            const value = e.target.value;
            if (value.length === 1) {
                // Pule para o próximo campo se o campo atual estiver preenchido
                if (index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && e.target.selectionStart === 0) {
                // Mova o foco para o campo anterior se a tecla "Backspace" for pressionada
                if (index > 0) {
                    inputs[index - 1].focus();
                }
            }
        });
    });
</script>
</html>