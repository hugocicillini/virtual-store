<?php
include('conexaodb.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
    $id = $_POST['id_usuario'];
    $sql = "DELETE FROM tb_usuarios WHERE i_id_usuarios = $id";
    mysqli_query($link,$sql);
    header("Location:lista_usuarios.php");
    exit();
}



if(!isset($_GET['id'])){
    header("location:lista_usuarios.php");
    exit();
}
$id = $_GET['id'];
$sql = "SELECT s_nome_usuarios FROM tb_usuarios WHERE i_id_usuarios = $id";
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
    <title>Apagar Usuários</title>
</head>
<body>
    <div>
        <h2>Apagar Usuário</h2>
        <p>Gostaria de Apagar o Usuário <?=$nome?></p>
        <div>
            <form action="apaga_usuarios.php" method="POST">
                <input type="hidden" name="id_usuario" value="<?=$id?>">
                <input type="submit" value="SIM">
            </form>
            <a href="lista_usuarios.php"><button>NÂO</button></a>
        </div>
    </div>
</body>
</html>