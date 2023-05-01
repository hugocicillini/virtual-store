<?php
include('conexaodb.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $query = "SELECT s_email_usuarios FROM tb_usuarios WHERE i_id_usuarios = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $email_old);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $tel = $_POST['fone'];
    $pass = $_POST['pass'];
    $nivel = $_POST['nivel'];

    if (empty($pass)) {
        $query = "SELECT s_senha_usuarios, s_tempero_usuarios FROM tb_usuarios WHERE i_id_usuarios = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $pass_old, $tempero_old);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $pass = $pass_old;
        $tempero = $tempero_old;
    } else {
        $tempero = md5(rand() . date("H:i:s"));
        $pass = md5($pass . $tempero);
    }

    if ($email != $email_old) {
        $query = "SELECT COUNT(s_email_usuarios) FROM tb_usuarios WHERE s_email_usuarios = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $cont);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if ($cont != 0) {
            mysqli_close($link);
            exit("<script>alert('Email já cadastrado'); window.location.href='index.php';</script>");
        }
    }

    $query = "UPDATE tb_usuarios SET s_nome_usuarios = ?, s_email_usuarios = ?, s_tel_usuarios = ?, s_senha_usuarios = ?, i_nivel_usuarios = ?, s_tempero_usuarios = ? WHERE i_id_usuarios = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "ssssisi", $nome, $email, $tel, $pass, $nivel, $tempero, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header('Location: lista_usuarios.php');
    exit();
}

$id = $_GET['id'];

$query = "SELECT s_nome_usuarios, s_email_usuarios, s_tel_usuarios, s_senha_usuarios, i_nivel_usuarios FROM tb_usuarios WHERE i_id_usuarios = ?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $nome, $email, $fone, $pass, $nivel);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Alterar Usuário</title>
</head>

<body>
    <div>
        <h1>Edita Usuários</h1>
        <form action="edita_usuarios.php" method="POST">
            <input type="hidden" value="<?= $id ?>" name="id">
            <label>Nome</label>
            <input type="text" name="nome" value="<?= $nome ?>" maxlength="50" required>
            <label>Email</label>
            <input type="email" name="email" value="<?= $email ?>" maxlength="50" required>
            <input type="hidden" name="email_old" value="<?= $email ?>">
            <label>Telefone</label>
            <input type="text" name="fone" value="<?= $fone ?>" maxlength="20" required>
            <label>Senha</label>
            <input type="password" name="pass" value="" maxlength="32">
            <input type="hidden" name="pass_old" value="<?= $pass ?>">
            <label> TipoUsuário</label>
            <select name="nivel">
                <option value="1" value="<?= $nivel == "1" ?>">Usuário</option>
                <option value="2" value="<?= $nivel == "2" ?>">Administrador</option>
            </select>
            <input type="submit" value="Gravar">
        </form>
    </div>
</body>

</html>