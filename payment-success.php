<?php
include("conexaodb.php");
session_start();

if (isset($_GET["amount"]) && !empty($_GET["amount"])) {

    $sql = "UPDATE tb_produtos p, tb_carrinho c SET p.i_estoque_produtos = p.i_estoque_produtos - c.i_quant_carrinho WHERE p.i_id_produtos = c.i_id_produtos AND c.i_id_usuarios = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql2 = "DELETE FROM tb_carrinho WHERE i_id_usuarios = ?";
    $stmt2 = mysqli_prepare($link, $sql2);
    mysqli_stmt_bind_param($stmt2, "i", $_SESSION['id']);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucesso</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap");

        .success-container {
            width: 50%;
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #bdc3c7;
            font-weight: bold;
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>

<body>
    <div class="success-container">
        <?php
        if (isset($_GET["amount"]) && !empty($_GET["amount"])) {
        ?>
            <h3>Your Transaction has been Successfully Completed!</h3>
        <?php
        }
        ?>
        <a href="produtos.php">Voltar</a>
    </div>
</body>

</html>