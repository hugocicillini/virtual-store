<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    date_default_timezone_set("America/Sao_Paulo");
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $tel = $_POST['fone'];
    $senha = $_POST['pass'];
    $cpf = $_POST['cpf'];
    $nasc = $_POST['nasc'];
    $tempero = md5(rand() . date("H:i:s"));
    $senha = md5($senha . $tempero);
    $nivel = $_POST['nivel'];
    include('conexaodb.php');

    $sql = "SELECT COUNT(s_email_usuarios) FROM tb_usuarios WHERE s_email_usuarios = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cont);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($cont != 0) {
        mysqli_close($link);
        exit("<script>alert('Email já cadastrado'); window.location.href='index.php';</script>");
    }

    $sql = "INSERT INTO tb_usuarios (s_nome_usuarios, s_email_usuarios, s_tel_usuarios, s_cpf_usuarios, dt_nasc_usuarios, s_senha_usuarios, i_nivel_usuarios, s_tempero_usuarios) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssis", $nome, $email, $tel, $cpf, $nasc, $senha, $nivel, $tempero);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    mysqli_close($link);
    ?>
    <script>
        alert("Usuário Cadastrado!")
    </script>
    <?php 
    header("Location:index.php");
    exit();
}
?>