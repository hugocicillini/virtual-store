<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "PHPMail/src/Exception.php";
require 'PHPMail/src/PHPMailer.php';
require 'PHPMail/src/SMTP.php';

$smtpHost = 'smtp.office365.com'; // endereço do servidor SMTP
$smtpPort = 587; // porta do servidor SMTP
$smtpUser = 'Seu Endereço'; // endereço de email que enviará a mensagem
$smtpPass = 'Senha do Seu Endereço'; // senha do endereço de email
$fromEmail = 'Seu Endereço'; // email do remetente
$fromName = $_POST['name']; // nome do remetente

$mail = new PHPMailer(true);

try {
    // Configurações do servidor SMTP
    $mail->isSMTP();
    $mail->Host       = $smtpHost;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtpUser;
    $mail->Password   = $smtpPass;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $smtpPort;

    // Cabeçalho do email
    $mail->setFrom($fromEmail, $fromName);
    $mail->addAddress('Seu Endereço');

    $mail->Subject = 'Nova mensagem de contato';

    // Corpo do email
    $mail->Body = 'Nome: ' . $_POST['name'] . "\n" .
        'Telefone: ' . $_POST['fone'] . "\n" .
        'Email: ' . $_POST['email'] . "\n" .
        'Mensagem: ' . $_POST['mensagem'];


    // Envia o email
    $mail->send();
    echo 'Mensagem enviada com sucesso!';
} catch (Exception $e) {
    echo 'Erro ao enviar mensagem: ' . $mail->ErrorInfo;
}
