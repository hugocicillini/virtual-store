<?php
session_start();
include('conexaodb.php');

if (!isset($_SESSION['id'])) {
    header('location:index.php');
    exit();
}

if (!isset($_GET['id_produto'])) {
    header('Location: favoritos.php');
    exit();
}

$id_produto = $_GET['id_produto'];
$id_usuario = $_SESSION['id'];

$sql = "DELETE FROM tb_favoritos WHERE i_id_usuarios = ? AND i_id_produtos = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, 'ii', $id_usuario, $id_produto);
$resultado = mysqli_stmt_execute($stmt);

if ($resultado) {
    header('location:favoritos.php');
    exit();
}
