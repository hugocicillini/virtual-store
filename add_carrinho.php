<?php
include('conexaodb.php');
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: index.php?msg=login-buy');
    exit;
}

$id_produto = $_POST['id_produto'];
$quanti_produto = $_POST['quantidade'];
$id_usuario = $_SESSION['id'];

if(!isset($_SESSION['carrinho'])){
    $_SESSION['carrinho'] = md5(date('h:i:s') . rand(0, 10000));
}

$sql = "SELECT * FROM tb_carrinho WHERE i_id_usuarios = '$id_usuario' AND i_id_produtos = '$id_produto'";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {

    header('location: carrinho.php');
}
else{

    $sql = "INSERT INTO tb_carrinho (i_id_usuarios, i_id_produtos, i_quant_carrinho, s_numero_carrinho) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "iiis", $_SESSION['id'], $id_produto, $quanti_produto, $_SESSION['carrinho']);
    mysqli_stmt_execute($stmt);
    header('location: carrinho.php');
    
}
