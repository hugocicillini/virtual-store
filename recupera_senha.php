<?php
session_start();
include('conexaodb.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "PHPMail/src/Exception.php";
require 'PHPMail/src/PHPMailer.php';
require 'PHPMail/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $sql = "SELECT COUNT(i_id_usuarios) FROM tb_usuarios WHERE s_email_usuarios = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $count = $stmt->get_result()->fetch_array()[0];
    if ($count != 0) {
        $recupera = rand();
        $sql = "UPDATE tb_usuarios SET s_recupera_usuarios = ? WHERE s_email_usuarios = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("ss", $recupera, $email);
        $stmt->execute();

        $to = $email;
        $subject = "Recuperação de Senha";
        $message = "Esse é o seu código de recuperação de senha: $recupera. <br> Acesse <a href='http://localhost/deni-store/redefine_senha.php'>aqui</a> para recuperá-la";

        $mail = new PHPMailer(true);
        $mail->SetLanguage("br");

        try {
            date_default_timezone_set('America/Sao_Paulo');
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = 'Seu Endereço';
            $mail->Password = 'Senha do Seu Endereço';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->CharSet = "UTF-8";

            $mail->setFrom('Seu Endereço', 'DENI STORE');
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
        } catch (Exception $e) {
            echo "Não foi possivel {$mail->ErrorInfo}";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
</head>

<body>
    <form action="recupera_senha.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <input type="submit" value="Enviar">

    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ?>
        <script>
            alert("Código enviado!")
        </script>
    <?php
        header("Location: redefine_senha.php");
        exit();
    }
    ?>
</body>

</html>