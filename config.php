<?php
    require_once "stripe-php-master/init.php";

    $stripeDetails = array(
        "secretKey" => "Chave Secreta",
        "publishableKey" => "Chave Pública"
    );

    \Stripe\Stripe::setApiKey("Chave Secreta");
?>