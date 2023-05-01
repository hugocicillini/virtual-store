<?php
include('conexaodb.php');
include('cabecalho.php');

$stmt = mysqli_prepare($link, "SELECT * FROM tb_produtos");
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
    <title>Lista Produtos</title>
</head>

<body>
    <div>
        <h1>Lista Produtos</h1>
        <table>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Imagem 1</th>
                <th>Imagem 2</th>
                <th>Estoque</th>
                <th>Valor</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            while ($tbl = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?= $tbl[1] ?></td>
                    <td><?= $tbl[2] ?></td>
                    <td><?= $tbl[3] ?></td>
                    <td>
                        <?php if (empty($tbl[4])) {
                            echo "😦";
                        } else { ?>
                            <img src="img-produtos/<?= $tbl[4] ?>">
                        <?php } ?>
                    </td>
                    <td>
                        <?php if (empty($tbl[5])) {
                            echo "😦";
                        } else { ?>
                            <img src="img-produtos/<?= $tbl[5] ?>">
                        <?php } ?>
                    </td>
                    <td><?= $tbl[6] ?></td>
                    <td><?= $tbl[7] ?></td>
                    <td><a href="edita_produtos.php?id=<?= $tbl[0] ?>">🖋️</td>
                    <td><a href="apaga_produtos.php?id=<?= $tbl[0] ?>">❌</a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>