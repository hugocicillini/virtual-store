<?php
include('conexaodb.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
    $nome = $_POST['nome'];
    $desc = $_POST['desc'];
    $cat = $_POST['cat'];
    $img1 = $_POST['img1'];
    $img2 = $_POST['img2'];
    $estoque = $_POST['estoque'];
    $valor = $_POST['valor'];
    $id = $_POST['id'];
    $foto_old1 = $_POST['foto_old1'];
    $foto_old2 = $_POST['foto_old2'];

    if($img1 == '') $img1 = $foto_old1;
    if($img2 == '') $img2 = $foto_old2;

    $sql = "UPDATE tb_produtos SET s_nome_produtos = '$nome', s_descricao_produtos = '$desc', s_categoria_produtos = '$cat', s_img1_produtos = '$img1',  s_img2_produtos = '$img2', i_estoque_produtos = '$estoque', d_valor_produtos = '$valor' WHERE i_id_produtos = $id";
    mysqli_query($link,$sql);
    header('Location: lista_produtos.php');
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM tb_produtos WHERE i_id_produtos = '$id'";
$result = mysqli_query($link,$sql);
while($tbl = mysqli_fetch_array($result)){
    $nome = $tbl[1];
    $desc = $tbl[2];
    $cat = $tbl[3];
    $img1 = $tbl[4];
    $img2 = $tbl[5];
    $estoque = $tbl[6];
    $valor = $tbl[7];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Alterar Produtos</title>
</head>
<body>
    <div>
        <h1>Edita Produtos</h1>
        <form action="edita_produtos.php" method="POST">
            <input type="hidden" value="<?=$id?>" name="id">
            <label>Nome</label>
            <input type="text" name="nome" value="<?=$nome?>" maxlength="50">
            <label>Descrição</label>
            <input type="text" name="desc" value="<?=$desc?>" maxlength="200">
            <label>Categoria</label>
            <input type="text" name="cat" value="<?=$cat?>" maxlength="32">
            <label> Imagem 1</label>
            <input type="file" name="img1">
            <input type="hidden" name="foto_old1" value="<?=$img1?>">
            <label> Imagem 2</label>
            <input type="file" name="img2">
            <input type="hidden" name="foto_old2" value="<?=$img2?>">
            <label>Estoque</label>
            <input type="text" name="estoque" value="<?=$estoque?>" maxlength="32">
            <label>Valor</label>
            <input type="text" name="valor" value="<?=$valor?>" maxlength="32">
            <input type="submit" value="Gravar">
        </form>
    </div>
</body>
</html>