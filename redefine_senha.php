<?php
session_start();
include('conexaodb.php');

if (!isset($_SESSION['id'])) {
    header('location:index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $cod = $_POST['cod'];
    $pass = $_POST['senha'];

    $stmt = $link->prepare("SELECT COUNT(i_id_usuarios) FROM tb_usuarios WHERE s_email_usuarios = ? AND s_recupera_usuarios = ?");
    $stmt->bind_param("ss", $email, $cod);
    $stmt->execute();
    $cont = $stmt->get_result()->fetch_row()[0];

    $sql = "SELECT s_tempero_usuarios FROM tb_usuarios WHERE s_email_usuarios = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $tempero = $row['s_tempero_usuarios'];


    if ($cont == 0 || $cod == "") {
        $sql = "UPDATE tb_usuarios SET s_recupera_usuarios = '' WHERE s_email_usuarios = ?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        header("Location: redefine_senha.php?msg=Código Inválido! Solicite um novo código.");
        exit();
    }

    $nova_senha = md5($pass . $tempero);
    $sql = "UPDATE tb_usuarios SET s_senha_usuarios = ?, s_recupera_usuarios = '' WHERE s_email_usuarios = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $nova_senha, $email);
    mysqli_stmt_execute($stmt);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de Senha</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="redefine_senha.php" method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="">Código</label>
        <input type="text" name="cod" id="cod" required>

        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" required>

        <input type="submit" value="Enviar">
    </form>
</body>

</html>