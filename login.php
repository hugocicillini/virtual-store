<?php
session_start();
include('conexaodb.php');

if (isset($_SESSION['id'])) {
    session_destroy();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM tb_usuarios WHERE s_email_usuarios = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $tbl = mysqli_fetch_assoc($result);
    if (!$tbl) {
        header("location:index.php?msg=Usuário ou senha incorretos");
        exit();
    }

    $senhaHash = md5($senha . $tbl['s_tempero_usuarios']);
    if ($senhaHash != $tbl['s_senha_usuarios']) {
        header("location:index.php?msg=Usuário ou senha incorretos");
        exit();
    }

    $_SESSION['id'] = $tbl['i_id_usuarios'];
    $_SESSION['nome'] = explode(" ", $tbl['s_nome_usuarios'])[0];
    $_SESSION['nivel'] = $tbl['i_nivel_usuarios'];
    header("location: index.php");
}
