<?php
include('conexaodb.php');

if (!empty($_GET['search'])) {
    $data = '%' . $_GET['search'] . '%';
    $stmt = $link->prepare("SELECT * FROM tb_produtos WHERE s_nome_produtos LIKE ? ORDER BY s_nome_produtos ASC");
    $stmt->bind_param("s", $data);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = mysqli_query($link, "SELECT * FROM tb_produtos ORDER BY s_nome_produtos ASC");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- basic -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Produtos</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="html/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="html/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="html/css/responsive.css">
    <!-- fevicon -->
    <link rel="shortcut icon" href="html/images/fevicon.ico" type="image/x-icon">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="html/css/jquery.mCustomScrollbar.min.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- owl stylesheets -->
</head>

<body>
    <?php
    include('cabecalho.php');
    ?>
    <!-- header section start -->
    <div class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="logo" href="index.php"><img src="html/images/logo.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="produtos.php">Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="blog.php">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contato.php">Contato</a>
                        </li>
                    </ul>
                    <div class="form-inline my-2 my-lg-0">
                        <div class="login_menu">
                            <ul>
                                <div class="profile">
                                    <div class="dropdown">
                                        <img style="margin-right: 1rem;" src="html/images
                                        /user-icon.png">
                                        <span onclick="toggleDropdown()">Minha Conta</span>
                                        <div class="dropdown-content">
                                            <?php if (isset($_SESSION['id'])) {
                                                $nome = $_SESSION['nome'];
                                                $nivel = $_SESSION['nivel'];
                                                if ($nivel == 1) { ?>
                                                    <li><span>Bem-vindo, </span><?= $nome ?>!<br><br>
                                                    <li><a href="favoritos.php">Favoritos</a></li>
                                                    <li><a href='logout.php'>Sair</a><br></li>
                                                <?php }
                                            } else { ?>
                                                <li><a href="#" onclick="openForm('login')">Entrar</a></li>
                                                <li><a href="#" onclick="openForm('cadastro')">Cadastrar</a></li>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="form-popup" id="form-login">
                                        <form action="login.php" method="POST">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" required>

                                            <div style="display: flex; flex-direction: column; align-items: center;">
                                                <label for="senha">Senha</label>
                                                <input type="password" name="senha" id="senha" required><br>

                                                <a href="recupera_senha.php">Esqueceu sua senha?</a>
                                            </div>

                                            <input type="submit" value="Entrar">
                                            <input type="button" onclick="closeForm()" value="Voltar">
                                        </form>
                                    </div>

                                    <div class="form-popup" id="form-cadastro">
                                        <form action="cadastro_usuario.php" method="POST">
                                            <label>Nome</label>
                                            <input type="text" name="nome" maxlength="35" required>
                                            <label>Email</label>
                                            <input type="email" name="email" maxlength="40" required>
                                            <label>CPF</label>
                                            <input type="text" name="cpf" maxlength="11" required>
                                            <label>Data de Nascimento</label>
                                            <input type="date" name="nasc" required>
                                            <label>Telefone</label>
                                            <input type="text" name="fone" maxlength="16" required>
                                            <label>Senha</label>
                                            <input type="password" name="pass" maxlength="32" required>
                                            <select name="nivel" hidden>
                                                <option value="1" selected></option>
                                            </select>
                                            <input type="submit" value="Cadastrar">
                                            <input type="button" onclick="closeForm()" value="Voltar">
                                        </form>
                                    </div>
                                </div>
                                <a href="carrinho.php"><img src="html/images/trolly-icon.png"></a>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- header section end -->
    <!-- product section start -->
    <div class="product_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="product_taital">Produtos</h1>
                    <p class="product_text">Experimente os produtos Deni e sinta a diferença em sua rotina de cuidados pessoais, com fórmulas exclusivas que hidratam, nutrem e protegem sua pele e cabelos, sem pesar no seu bolso</p>
                </div>
            </div>
            <div class="search_bar">
                <input type="search" placeholder=" Pesquisar" id="pesquisar">
                <button onclick="searchData()"><img src="html/images/search-icon.png"></button>
            </div>
            <div class="row">
                <div class="container-produtos2">
                    <?php
                    while ($tbl = mysqli_fetch_array($result)) {
                    ?>
                        <div class="product_main">
                            <div class="product_header">
                                <div class="estoque_product">
                                    <p>RESTAM: <br> <?= $tbl[6] ?> UNID.</p>
                                </div>
                                <form method="POST" action="favoritar.php">
                                    <input type="hidden" name="id_produto" value="<?= $tbl[0] ?>">
                                    <button type="submit" style="padding: 1rem; background: transparent;" value="comprar"><i class='bx bx-heart bx-sm bx-burst-hover'></i></button>
                                </form>
                            </div>
                            <a class="imgBox" href="mostra_produtos.php?id=<?= $tbl[0] ?>">
                                <img id="img-produtos/<?= $tbl[0] ?>" src="img-produtos/<?= $tbl[4] ?>">
                                <div class="product_info">
                                    <?= $tbl[1] ?> <br> R$<?= $tbl[7] ?> <br> À vista no pix
                                </div>
                            </a>
                            <div class="product_buy">
                                <form action="add_carrinho.php" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
                                    <input type="number" name="quantidade" value="1" min="1">
                                    <button class="buy" type="submit" value="comprar">🛒 Comprar</button>
                                    <input type="hidden" name="id_produto" value="<?= $tbl[0] ?>">
                                </form>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- product section start -->
    <!-- footer section start -->
    <div class="footer_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="location_icon">
                        <ul>
                            <li><a href="#"><img src="html/images/map-icon.png"></a></li>
                            <li><a href="#"><img src="html/images/mail-icon.png"></a></li>
                            <li><a href="#"><img src="html/images/call-icon.png"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="mail_box">
                        <input class="enter_email_text" placeholder="Enter Your Email" id="comment" name="Message"></input>
                        <div class="subscribe_bt_1"><a href="#">Inscreva-se</a></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="social_icon">
                        <ul>

                            <li><a href="#"><img src="html/images/twitter-icon.png"></a></li>
                            <li><a href="#"><img src="html/images/linkedin-icon.png"></a></li>
                            <li><a href="#"><img src="html/images/instagram-icon.png"></a></li>
                            <li><a href="#"><img src="html/images/youtub-icon.png"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer_section_2">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <h3 class="company_text">Produtos</h3>
                        <p class="dolor_text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.Lorem ipsum dolor sit amet, </p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="company_text">Compras</h3>
                        <p class="dolor_text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.Lorem ipsum dolor sit amet, </p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="company_text">Empresa</h3>
                        <p class="dolor_text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.Lorem ipsum dolor sit amet, </p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="company_text">MY ACCOUNT</h3>
                        <p class="dolor_text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.Lorem ipsum dolor sit amet, </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer section end -->
    <!-- copyright section start -->
    <div class="copyright_section">
        <div class="container">
            <p class="copyright_text">© 2023 All Rights Reserved.<a href="https://github.com/hugocicillini" target="_blank"> hugocicillini</a></p>
        </div>
    </div>
    <!-- copyright section end  -->
    <!-- Javascript files-->
    <script src="html/js/jquery.min.js"></script>
    <script src="html/js/popper.min.js"></script>
    <script src="html/js/bootstrap.bundle.min.js"></script>
    <script src="html/js/jquery-3.0.0.min.js"></script>
    <script src="html/js/plugin.js"></script>
    <!-- sidebar -->
    <script src="html/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="html/js/custom.js"></script>
    <!-- javascript -->
    <script src="html/js/owl.carousel.js"></script>
    <script>
        var search = document.getElementById('pesquisar');

        search.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                searchData();
            }
        })

        function searchData() {
            window.location = 'produtos.php?search=' + search.value;
        }
    </script>
    <script>
        function toggleDropdown() {
            var dropdown = document.getElementsByClassName("dropdown")[0];

            dropdown.classList.toggle("active")
        }

        function openForm(formName) {
            document.querySelector("#form-" + formName).style.display = "block";
            document.body.style.pointerEvents = "none";
            document.querySelector("#form-" + formName).style.pointerEvents = "auto";
        }

        function closeForm() {
            document.querySelectorAll(".form-popup").forEach((form) => {
                form.style.display = "none";
            });
            document.body.style.pointerEvents = "auto";
            document.querySelector("#form-" + formName).style.pointerEvents = "none";
        }
    </script>
</body>

</html>