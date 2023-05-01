<?php
include('conexaodb.php');
include('cabecalho.php');

$stmt = mysqli_prepare($link, "SELECT * FROM tb_usuarios");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Lista Usuários</title>
</head>

<body>
    <div>
        <h1 style="text-align: center; font-family: 'Courier New', Courier, monospace;">Lista Usuários</h1>
        <table>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Nível</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            while ($tbl = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?= $tbl[1] ?></td>
                    <td><?= $tbl[5] ?></td>
                    <td><?= $tbl[4] ?></td>
                    <td><?= $tbl[9] == 1 ? "Usuário" : "Administrador" ?></td>
                    <td><a href="edita_usuarios.php?id=<?= $tbl[0] ?>">🖋️</a></td>
                    <td><a href="apaga_usuarios.php?id=<?= $tbl[0] ?>">❌</a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>