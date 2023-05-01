<?php
    include("config.php");
    include("conexaodb.php");

    $token = $_POST["stripeToken"];
    $contact_name = $_POST["productName"];
    $token_card_type = $_POST["stripeTokenType"];
    $amount = (int)$_POST["Amount"]; 
    var_dump($amount);
    $charge = \Stripe\Charge::create([
      "amount" => $amount,
      "currency" => 'brl',
      "source"=> $token,
    ]);

    if($charge){
      header("Location:payment-success.php?amount=$amount");
    }
?>