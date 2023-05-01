<?php
session_start();
include "conexaodb.php";

$sql = "DELETE FROM tb_carrinho WHERE i_id_usuarios = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
mysqli_stmt_execute($stmt);

unset($_SESSION['id']);
unset($_SESSION['email']);
unset($_SESSION['senha']);
unset($_SESSION['nome']);
unset($_SESSION['nivel']);
header('location:index.php');
