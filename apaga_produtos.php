<?php
include('conexaodb.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
    $id = $_POST['id_produto'];
    $sql = "DELETE FROM tb_produtos WHERE i_id_produtos = $id";
    mysqli_query($link,$sql);
    header("Location:lista_produtos.php");
    exit();
}

if(!isset($_GET['id'])){
    header("location:lista_produtos.php");
    exit();
}
$id = $_GET['id'];
$sql = "SELECT s_nome_produtos FROM tb_produtos WHERE i_id_produtos = $id";
$response = mysqli_query($link,$sql);
while($tbl = mysqli_fetch_array($response)){
    $nome = $tbl[0];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apagar Produtos</title>
</head>
<body>
    <div style="display:flex; flex-direction: column; align-items: center; justify-content:center">
        <h2>Apagar Produto</h2>
        <p>Gostaria de Apagar o Produto: <?=$nome?>?</p>
        <div>
            <form action="apaga_produtos.php" method="POST">
                <input type="hidden" name="id_produto" value="<?=$id?>">
                <input type="submit" value="SIM">
            </form>
            <a href="lista_produtos.php"><button>NÃO</button></a>
        </div>
    </div>
</body>
</html>