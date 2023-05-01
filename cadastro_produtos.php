<?php
    include('cabecalho.php');
    include('seguranca2.php');
    ?>
    <?php

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $nome = $_POST['nome'];
        $descricao = $_POST['desc'];
        $categoria = $_POST['cat'];
        $imagem1 = $_POST['img1'];
        $imagem2 = $_POST['img2'];
        $estoque = $_POST['estoque'];
        $valor = $_POST['valor'];
        include('conexaodb.php');

        $sql = "INSERT INTO tb_produtos (s_nome_produtos, s_descricao_produtos, s_categoria_produtos, s_img1_produtos,  s_img2_produtos, i_estoque_produtos, d_valor_produtos) VALUES ('$nome', '$descricao', '$categoria', '$imagem1', '$imagem2', '$estoque', $valor)";

        mysqli_query($link,$sql);
        header('Location: lista_produtos.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastrar Produtos</title>
</head>
<body>
    <div>
        <h1>Cadastro Produtos</h1>
        <form action="cadastro_produtos.php" method="POST">
            <label>Nome</label>
            <input type="text" name="nome" maxlength="50" required>
            <label>Descrição</label>
            <input type="text" name="desc" maxlength="200" required>
            <label>Categoria</label>
            <input type="text" name="cat" maxlength="30" required>
            <label>Imagem 1</label>
            <input type="file" name="img1">
            <label>Imagem 2</label>
            <input type="file" name="img2">
            <label>Estoque</label>
            <input type="number" name="estoque" required><br><br>
            <label>Valor</label>
            <input type="number" name="valor" required><br><br>
            <input type="submit" value="Gravar">
        </form>
    </div>
</body>
</html>