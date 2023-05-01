<?php
session_start();
?>
<div>
    <?php
    if (isset($_SESSION['id'])) {

        $nome = $_SESSION['nome'];
        $nivel = $_SESSION['nivel'];
        if ($nivel == 2) {
    ?>
            <style>
                @import url("https://fonts.googleapis.com/css?family=Montserrat");

                .admin-session {
                    background-color: #f9f9f9;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    padding: 10px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    text-align: center;
                }

                .admin-session a {
                    color: #333;
                    text-decoration: none;
                }

                .admin-session button {
                    background-color: #ddd;
                    border: none;
                    border-radius: 3px;
                    color: #333;
                    cursor: pointer;
                    font-size: 14px;
                    margin: 0 5px;
                    padding: 5px 10px;
                    text-align: center;
                    text-decoration: none;
                }

                .admin-session button:hover {
                    background-color: #bbb;
                }

                .admin-session span {
                    color: #333;
                    font-size: 16px;
                    font-family: "Montserrat", sans-serif;
                    font-weight: bold;
                    margin: 0 10px;
                }

                .admin-session p {
                    color: #333;
                    font-size: 16px;
                    font-weight: bold;
                }
            </style>
            <div class="admin-session">
                <a href="lista_produtos.php"><button>Lista de produtos</button></a>
                <a href="lista_usuarios.php"><button>Lista de usuarios</button></a>
                <a href="cadastro_produtos.php"><button>Novo Produto</button></a>
                <a href="index.php"><button>Home</button></a>
                <span>Seja bem vindo, <?= $nome ?> |</span>
                <a href='logout.php'>Sair</a>
            </div>
        <?php
        }
        ?>
    <?php
    }
    ?>
</div>