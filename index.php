<?php
include('conexaodb.php');
$sql = "SELECT * FROM tb_produtos ORDER BY i_id_produtos DESC";
$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Deni Store</title>
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
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- owl stylesheets -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" rel="stylesheet" />
    <!-- BoxIcons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <style>
        #message {
            position: relative;
            width: 100%;
            padding: 10px;
            background-color: transparent;
            text-align: center;
            z-index: 1;
            overflow: hidden;
        }

        #message::before {
            content: "";
            position: absolute;
            top: 80%;
            left: 0%;
            width: 100%;
            height: .1rem;
            background-color: #3b7197;
            animation: running-line 2s linear forwards;
        }

        @keyframes running-line {
            0% {
                left: 0%;
            }

            100% {
                left: 100%;
            }
        }
    </style>
    <?php
    include('cabecalho.php');
    ?>
    <!-- header section start -->
    <div class="header_section">
        <?php
        if (isset($_SESSION['id']) && $_SESSION['nivel'] == 1) {
            if (!isset($_SESSION['msg_displayed'])) {
                echo '<div id="message">Login efetuado com sucesso!</div>';
                $_SESSION['msg_displayed'] = true;
            }
        }

        if (isset($_GET['msg']) && $_GET['msg'] == 'Usuário ou senha incorretos') {
            if (!isset($_SESSION['msg_displayed_error'])) {
                echo '<div id="message">Usuário ou senha incorretos!</div>';
                $_SESSION['msg_displayed_error'] = true;
            }
        }

        if (isset($_GET['msg']) && $_GET['msg'] == 'added-prod') {
            echo '<div id="message">Produto adicionado ao carrinho!</div>';
        }

        if (isset($_GET['msg']) && $_GET['msg'] == 'login-favoritos') {
            echo '<div id="message">Faça login para adicionar aos favoritos!</div>';
        }

        if (isset($_GET['msg']) && $_GET['msg'] == 'login-buy') {
            echo '<div id="message">Faça login para adicionar ao carrinho!</div>';
        }

        if (isset($_GET['msg']) && $_GET['msg'] == 'login-cart') {
            echo '<div id="message">Faça login para visualizar o carrinho!</div>';
        }

        ?>
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
    <!-- banner section start -->
    <div class="banner_section banner_bg">
        <div class="container-fluid">
            <div id="my_slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="taital_main">
                            <div class="taital_left">
                                <h1 class="banner_taital">Deni Product For Skin</h1>
                                <div class="read_bt"><a href="about.php">Saiba mais</a></div>
                            </div>
                            <div class="taital_right">
                                <div class="product_img"><img src="html/images/product-img.png"></div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="taital_main">
                            <div class="taital_left">
                                <h1 class="banner_taital">Deni Product For Skin</h1>
                                <div class="read_bt"><a href="about.php">Saiba mais</a></div>
                            </div>
                            <div class="taital_right">
                                <div class="product_img"><img src="html/images/product-img.png"></div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="taital_main">
                            <div class="taital_left">
                                <h1 class="banner_taital">Deni Product For Skin</h1>
                                <div class="read_bt"><a href="about.php">Saiba mais</a></div>
                            </div>
                            <div class="taital_right">
                                <div class="product_img"><img src="html/images/product-img.png"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
                    <i class='fa fa-arrow-right'></i>
                </a>
                <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
                    <i class='fa fa-arrow-left'></i>
                </a>
            </div>
        </div>
    </div>
    <!-- banner section end -->
    <!-- about section start -->
    <div class="about_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div><img src="html/images/about-img.png" class="about_img"></div>
                </div>
                <div class="col-md-6">
                    <h1 class="about_taital">Sobre a empresa</h1>
                    <div class="border"></div>
                    <p class="about_text">A Deni é uma marca de cosméticos que oferece produtos de alta qualidade para melhorar a saúde e beleza da pele e cabelos. A empresa valoriza a inovação, o uso de ingredientes naturais e a sustentabilidade. A equipe é altamente qualificada e comprometida com a satisfação do cliente. Todos os produtos são testados dermatologicamente e livres de crueldade animal.</p>
                    <div class="read_bt_1"><a href="about.php">Saiba mais</a></div>
                    <div class="image_1"><img src="html/images/img-1.png"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- about section end -->
    <!-- product section start -->
    <div class="product_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 home-products">
                    <h1 class="product_taital">Produtos</h1>
                    <p class="product_text">Experimente os produtos Deni e sinta a diferença em sua rotina de cuidados pessoais, com fórmulas exclusivas que hidratam, nutrem e protegem sua pele e cabelos, sem pesar no seu bolso.</p>
                    <div class="container-produtos">
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
    </div>
    <!-- product section start -->
    <!-- client section start -->
    <div class="client_section layout_padding banner_bg">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h1 class="client_taital">Clientes Falam:</h1>
                </div>
                <div class="col-md-9">
                    <div class="client_box">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <p class="client_text">Eu comprei um esmalte da Deni com a esperança de que ele durasse pelo menos uma semana nas minhas unhas. Infelizmente, isso não aconteceu. O esmalte descascou no mesmo dia em que eu o apliquei.
                                        Além disso, a consistência do esmalte é muito fina, o que torna difícil a aplicação. Eu tive que aplicar várias camadas para obter a cor desejada, o que levou mais tempo do que o normal.</p>
                                    <div class="client_main">
                                        <div class="client_left">
                                            <div class="client_img"><img src="html/images/stalin.jpg"></div>
                                        </div>
                                        <div class="client_right">
                                            <div class="quick_icon"><img src="html/images/quick-icon.png"></div>
                                            <h6 class="client_name">Josef Stalin</h6>
                                            <p class="aliqua_text">Nível Diamante</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <p class="client_text">Eu comprei o batom da Deni com grande expectativa, mas fiquei profundamente desapontada. A textura do batom é estranha e parece que está escorrendo pelos lábios. Além disso, ele não dura nem meia hora nos lábios, o que é muito frustrante.
                                        Eu não recomendaria este produto para ninguém que deseja uma aparência duradoura e profissional.</p>
                                    <div class="client_main">
                                        <div class="client_left">
                                            <div class="client_img"><img src="html/images/lenin.jpg"></div>
                                        </div>
                                        <div class="client_right">
                                            <div class="quick_icon"><img src="html/images/quick-icon.png"></div>
                                            <h6 class="client_name">Vladimir Ilyich Ulianov</h6>
                                            <p class="aliqua_text">Nível Ouro</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <p class="client_text">Sinceramente, fiquei muito decepcionado com o hidratante corporal da Deni. Além de não hidratar minha pele como prometido, ele ainda deixou uma sensação pegajosa e desconfortável. O cheiro também é bastante desagradável, parecendo artificial e até mesmo químico.
                                        Eu realmente não recomendo este produto para ninguém!</p>
                                    <div class="client_main">
                                        <div class="client_left">
                                            <div class="client_img"><img src="html/images/trotski.jpg"></div>
                                        </div>
                                        <div class="client_right">
                                            <div class="quick_icon"><img src="html/images/quick-icon.png"></div>
                                            <h6 class="client_name">Leon Trótski</h6>
                                            <p class="aliqua_text"> Nível Prata</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- client section end -->
    <!-- Blog section start -->
    <div class="blog_section layout_padding">
        <div class="container">
            <h1 class="blog_taital">Últimas Postagens - Blog</h1>
            <div class="blog_section_2">
                <div class="row">
                    <div class="col-md-5">
                        <div class="face_img"><img src="html/images/face-img.png" class="face_img"></div>
                    </div>
                    <div class="col-md-7">
                        <h1 class="face_text">Face Cream Very Mosurations</h1>
                        <p class="lorem_text">Nova fórmula do Face Cream Very Moisturizing promete pele hidratada e radiante <br>

                            A marca de cuidados com a pele, Deni, lançou uma nova fórmula para o seu creme hidratante, o Face Cream Very Moisturizing. O produto agora contém uma mistura única de ingredientes naturais que prometem deixar a pele hidratada e radiante durante todo o dia.</p>
                        <div class="read_bt_1"><a href="#">Saiba mais</a></div>
                    </div>
                </div>
            </div>
            <div class="blog_section_3">
                <div class="row">
                    <div class="col-md-7">
                        <h1 class="face_text">Face Cream Very Mosurations Skin</h1>
                        <p class="lorem_text">O Face Cream Very Moisturizing Skin é um creme hidratante desenvolvido pela marca de cuidados com a pele, Deni. Ele é especialmente formulado para fornecer hidratação profunda e duradoura à pele, deixando-a macia, suave e radiante.</p>
                        <div class="readmore_bt"><a href="blog.php">Saiba mais</a></div>
                    </div>
                    <div class="col-md-5">
                        <div class="face_img"><img src="html/images/face-img1.png" class="face_img"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog section end -->
    <!-- contact section start -->
    <div class="contact_section layout_padding">
        <div class="container-fluid">
            <h1 class="contact_taital">Contato</h1>
            <div class="contact_section_2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="image_7"><img src="html/images/img-7.png"></div>
                    </div>
                    <div class="col-md-6">
                        <form class="mail_section_1" action="enviar_email.php" method="POST">
                            <input type="text" class="mail_text" placeholder="Seu Nome" name="name">
                            <input type="text" class="mail_text" placeholder="Telefone" name="fone">
                            <input type="text" class="mail_text" placeholder="Email" name="email">
                            <textarea class="massage-bt" placeholder="Mensagem" rows="5" id="comment" name="mensagem"></textarea>
                            <div class="send_bt"><button class="buy" type="submit" value="Enviar">Enviar</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact section end -->
    <!-- footer section start -->
    <div class="footer_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="location_icon">
                        <ul>
                            <li><a href="https://goo.gl/maps/xbTZUttxWoUezPka9" target="_blank"><img src="html/images/map-icon.png"></a></li>
                            <li><a href="mailto:deni@store.com"><img src="html/images/mail-icon.png"></a></li>
                            <li><a href="tel:+5571999999999"><img src="html/images/call-icon.png"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="mail_box">
                        <input class="enter_email_text" placeholder="Enter Your Email" rows="5" id="comment" name="Message"></textarea>
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
            <p class="copyright_text">© 2023 All Rights Reserved. <a href="https://github.com/hugocicillini" target="_blank">hugocicillini</a></p>
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
    <!-- owl carousel -->
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
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
    <script>
        const message = document.getElementById('message');

        message.style.display = 'block';
        setTimeout(() => {
            message.style.display = 'none';
        }, 2000);
    </script>
</body>

</html>