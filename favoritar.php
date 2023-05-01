<?php
include('conexaodb.php');
session_start();

if (!isset($_SESSION['id'])) {
    header('location:index.php?msg=login-favoritos');
    exit;
}

$id_produto = $_POST['id_produto'];
$id_usuario = $_SESSION['id'];

$sql_verifica = "SELECT * FROM tb_favoritos WHERE i_id_usuarios = '$id_usuario' AND i_id_produtos = '$id_produto'";
$result_verifica = mysqli_query($link, $sql_verifica);

if (mysqli_num_rows($result_verifica) > 0) {
    echo" <script>alert('Favorito já adicionado!')</script>";
    echo" <script>history.go(-1);</script>";
}
else{

    $sql = "INSERT INTO tb_favoritos (i_id_usuarios, i_id_produtos) VALUES (?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $_SESSION['id'], $id_produto);
    mysqli_stmt_execute($stmt);
    echo" <script>history.go(-1);</script>";
}
