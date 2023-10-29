<?php
    include 'connection/connect.php';
    $cpf = md5($_POST['cpf']);
    $cpf_ = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    
    // Remova caracteres não numéricos do CPF
    $cpfNumerico = preg_replace("/[^0-9]/", "", $cpf);
    
    // Pegue os cinco primeiros dígitos do CPF
    $codigo = substr($cpfNumerico, 0, 4);

    $mensagem = "Seu código de recuperação é $codigo";
        
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
        
    require './lib/vendor/autoload.php';

    // Consulta SQL para verificar se o CPF existe na tabela
    $sql = "SELECT * FROM Clientes WHERE cpf = '$cpf_' AND email = '$email' AND telefone = '$telefone'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {

    $mail = new PHPMailer(true);

    try {
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'webspookyhouse@outlook.com';
        $mail->Password = 'sPookY123487654';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
            
        $mail->setFrom('webspookyhouse@outlook.com', 'Recuperação Spooky House'); // site
        $mail->addAddress($email, 'Spooky House'); //ADM
            
        $mail->isHTML(true);                                 
        $mail->Subject = "Código de Recuperação";
        $mail->Body = "$mensagem";
            
        $mail->send(); 
        // se funcionar
        header("location: recuperacao2.php?codigo=$cpf_");
            
        } catch (Exception $e) { ?>
        <!-- se não funcionar  -->
        <h1>nao</h1>
    <?php }

    } else {
        // O CPF não existe no banco de dados
        header('location: cpfNao.php');
    }