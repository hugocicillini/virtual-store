    <?php
    error_reporting(0);
    ini_set('display_errors', 0);

    include_once "conexaodb.php";
    session_start();

    if (!isset($_SESSION['id'])) {
        header('location:index.php');
        exit;
    }

    $total_geral = 0;
    $valor_frete = 0;

    $sql = "SELECT i_id_produtos, i_quant_carrinho FROM tb_carrinho WHERE i_id_usuarios = ? AND s_numero_carrinho = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "is", $_SESSION['id'], $_SESSION['carrinho']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $sql_total = "SELECT tb_carrinho.i_id_produtos, tb_produtos.d_valor_produtos FROM tb_carrinho JOIN tb_produtos ON tb_carrinho.i_id_produtos = tb_produtos.i_id_produtos";
    $result_total = mysqli_query($link, $sql_total);
    $total_produtos = 0;
    while ($tbl = mysqli_fetch_array($result_total)) {
        $id_cliente = $tbl[0];
        $total_produtos += $tbl[1];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cep_origem = 14021200; // CEP de origem
        $cep_destino = "";
        if (isset($_POST['cep'])) $cep_destino = $_POST['cep']; // CEP de destino
        $peso = 1; // Peso da encomenda em kg
        $comprimento = 30; // Comprimento da encomenda em cm
        $largura = 20; // Largura da encomenda em cm
        $altura = 10; // Altura da encomenda em cm
        $total_produtos; // Valor declarado da encomenda em reais

        // Monta a URL de consulta ao webservice dos Correios
        $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=$cep_origem&sCepDestino=$cep_destino&nVlPeso=$peso&nCdFormato=1&nVlComprimento=$comprimento&nVlAltura=$altura&nVlLargura=$largura&nVlValorDeclarado=$total_produtos&sCdAvisoRecebimento=N&sCdMaoPropria=N&nCdServico=41106&nVlDiametro=0&StrRetorno=xml";

        // Realiza a consulta à API dos Correios
        $xml = simplexml_load_file($url);

        // monta a URL da API do ViaCEP
        $url = "https://viacep.com.br/ws/$cep_destino/json/";

        // faz a requisição à API do ViaCEP
        $endereco = json_decode(file_get_contents($url));

        // verifica se a consulta foi bem-sucedida

    }

    ?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <style>

        </style>
        <!-- basic -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- mobile metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1">
        <!-- site metas -->
        <title>About</title>
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">
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
        <style>
            .stripe-button-el {
                margin-top: 3rem !important;
                padding: 10px !important;
                visibility: hidden !important;
                background-image: none !important;
                background-color: #F0F0F0 !important;
                width: 100% !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                border: #F0F0F0 !important;
            }

            @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

            .stripe-button-el span {
                height: 30px !important;
                min-width: 0 !important;
                background: black !important;
                margin-left: 9rem !important;
                visibility: hidden !important;
                padding: 0 !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                text-align: center !important;
                font-size: 20px !important;
                color: black !important;
                font-family: 'Poppins', sans-serif !important;
                font-weight: normal !important;
                background-color: #F0F0F0 !important;
            }

            .stripe-button-el span::before {
                content: "Finalizar Compra" !important;
                visibility: visible !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                text-align: center !important;
            }
        </style>
    </head>

    <body>
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
                                        <img src="html/images
                                    /user-icon.png">
                                        <div class="dropdown">
                                            <span onclick="toggleDropdown()">Minha Conta</span>
                                            <div class="dropdown-content">
                                                <?php
                                                if (isset($_SESSION['id'])) {
                                                    $nome = $_SESSION['nome'];
                                                    $nivel = $_SESSION['nivel'];
                                                    if ($nivel == 1) {
                                                ?>
                                                        <li><span>Bem-vindo, </span><?= $nome ?>!<br><br>
                                                        <li><a href="favoritos.php">Favoritos</a></li>
                                                        <li><a href='logout.php'>Sair</a><br></li>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <li><a href="#" onclick="openForm()">Entrar</a></li>
                                                    <li><a href="#" onclick="openForm2()">Cadastrar</a></li>
                                                    <div class="form-popup" id="myForm">
                                                        <form action="login.php" method="POST">
                                                            <label for="email">Email</label>
                                                            <input type="email" name="email" id="email" required>

                                                            <label for="senha">Senha</label>
                                                            <input type="password" name="senha" id="senha" required><br>

                                                            <input type="submit" value="Entrar">
                                                            <input type="button" onclick="closeForm()" value="Voltar">
                                                        </form>
                                                    </div>
                                                    <div class="form-popup" id="myForm2">
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
                                                            <input type="button" onclick="closeForm2()" value="Voltar">
                                                        </form>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
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
        <!-- about section start -->
        <div class="about_section layout_padding">
            <div class=" container-fluid my-5 ">
                <div class="row justify-content-center ">
                    <div class="col-xl-12">
                        <div class="card shadow-lg ">
                            <div style="padding: 3rem" class="row mx-auto justify-content-center text-center">
                                <div class="col-12 mt-3 ">
                                    <nav aria-label="breadcrumb" class="second ">
                                        <ol class="breadcrumb indigo lighten-6 first  ">
                                            <li class="breadcrumb-item font-weight-bold "><a class="black-text text-uppercase " href="produtos.php"><span class="mr-md-3 mr-1">VOLTAR</span></a><i class="fa fa-angle-double-right " aria-hidden="true"></i></li>
                                            <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="carrinho.php"><span class="mr-md-3 mr-1">CARRINHO</span></a><i class="fa fa-angle-double-right text-uppercase " aria-hidden="true"></i></li>
                                            <li class="breadcrumb-item font-weight-bold"><span class="mr-md-3 mr-1">CHECKOUT</span></li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                            <div class="row justify-content-around">
                                <div class="col-md-5">
                                    <div class="card border-0">
                                        <div class="card-header pb-0">
                                            <h2 class="card-title space ">CHECKOUT</h2>
                                            <p class="card-text text-muted mt-4  space">DETALHES DA COMPRA</p>
                                            <hr class="my-0">
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group" style="padding-top: 2rem;">
                                                <div class="col-auto" style="margin-bottom: 2rem;">

                                                    <form action="finalizar_compra.php" method="POST">

                                                        <input style="width: 85%; margin-left: 20px;" placeholder="CEP" value="<?= $cep_destino ?>" type="text" maxlength="8" name="cep" id="cep" required>
                                                        <button id="calcular" class="btn" style="padding: .2rem .5rem;" type="submit">OK</button>

                                                    </form>

                                                </div>
                                                <div class="col-auto" style="margin-bottom: 2rem;">
                                                    <p>
                                                        <b>
                                                            <input style="width: 80%;" value="<?= $endereco->logradouro ?>" type="text" disabled placeholder="Logradouro">
                                                            <input style="width: 19.2%;" type="text" class="checkNumber" placeholder="Número" onkeyup="checkNumber()" required>
                                                        </b>
                                                    </p>
                                                </div>
                                                <div class="col-auto" style="margin-bottom: 2rem;">
                                                    <p>
                                                        <b>
                                                            <input style="width: 100%;" type="text" placeholder="Complemento">
                                                        </b>
                                                    </p>
                                                </div>
                                                <div class="col-auto" style="margin-bottom: 2rem;">
                                                    <p>
                                                        <b>
                                                            <input style="width: 100%;" value="<?= $endereco->bairro ?>" type="text" disabled placeholder="Bairro">
                                                        </b>
                                                    </p>
                                                </div>
                                                <div class="col-auto" style="margin-bottom: 2rem;">
                                                    <p>
                                                        <b>
                                                            <input style="width: 80%;" value="<?= $endereco->localidade ?>" type="text" placeholder="Cidade" disabled>
                                                            <input style="width: 19.2%;" value="<?= $endereco->uf ?>" type="text" placeholder="UF" disabled>
                                                        </b>
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- <div class="row mt-4">
                                                <div class="col">
                                                    <p class="text-muted mb-2">DETALHES DO PAGAMENTO</p>
                                                    <hr class="mt-0">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NAME" class="small text-muted mb-1">NOME NO CARTÃO</label>
                                                <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="JESSE PINKMAN">
                                            </div>
                                            <div class="form-group">
                                                <label for="NAME" class="small text-muted mb-1">NÚMERO DO CARTÃO</label>
                                                <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="4534 5555 5555 5555">
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-sm-6 pr-sm-2">
                                                    <div class="form-group">
                                                        <label for="NAME" class="small text-muted mb-1">VALIDADE</label>
                                                        <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="06/27">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="NAME" class="small text-muted mb-1">CVC</label>
                                                        <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="123">
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="row mb-md-5">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="card border-0 ">
                                        <div class="card-header card-2">
                                            <p class="card-text text-muted mt-md-4  mb-2 space">SEU PEDIDO</p>
                                            <hr class="my-2">
                                        </div>
                                        <div class="card-body pt-0">
                                            <?php
                                            while ($row = mysqli_fetch_array($result)) {
                                                $quant_unico = $row[1];
                                                $id_produto = $row['i_id_produtos'];
                                                $sql = "SELECT * FROM tb_produtos WHERE i_id_produtos = $id_produto";
                                                $result_produto = mysqli_query($link, $sql);
                                                while ($tbl = mysqli_fetch_array($result_produto)) {
                                                    $total_unico = $tbl[7];
                                                    $nome_produto = $tbl[1];
                                                    $total_geral += $quant_unico * $tbl[7];
                                                };
                                            ?>
                                                <div class="row justify-content-between">
                                                    <div class="col-auto col-md-7">
                                                        <div class="media flex-column flex-sm-row">
                                                            <div class="media-body my-auto">
                                                                <div class="row">
                                                                    <div class="col-auto">
                                                                        <p class="mb-0"><b><?= $nome_produto ?></b></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pl-0 flex-sm-col col-auto my-auto">
                                                        <p class="boxed-1"><?= $quant_unico ?>x</p>
                                                    </div>
                                                    <div class="pl-0 flex-sm-col col-auto my-auto">
                                                        <p><b>R$<?= number_format($total_unico * $quant_unico, 2, ',', '.'); ?></b></p>
                                                    </div>
                                                </div>
                                            <?php
                                            } ?>
                                            <hr class="my-2">
                                            <div class="row ">
                                                <div class="col">
                                                    <div class="row justify-content-between">
                                                        <div class="col-4">
                                                            <p class="mb-1"><b>Subtotal</b></p>
                                                        </div>
                                                        <div class="flex-sm-col col-auto">
                                                            <p class="mb-1"><b>R$<?php echo number_format($total_geral, 2, ',', '.'); ?></b></p>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-between">
                                                        <div class="col">
                                                            <p class="mb-1"><b>Frete</b></p>
                                                        </div>
                                                        <div class="flex-sm-col col-auto">
                                                            <p class="mb-1"><b>
                                                                    <?php
                                                                    if ($xml->cServico->Erro == '0') {
                                                                        $valor_frete = (float) str_replace(',', '.', $xml->cServico->Valor);
                                                                        echo "R$" . number_format($valor_frete, 2, ',', '.');
                                                                    } else if ($cep_destino == "") {
                                                                        echo "R$0,00";
                                                                    } else {
                                                                        echo  $xml->cServico->MsgErro;
                                                                    }
                                                                    ?>
                                                                </b>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-between">
                                                        <div class="col-4">
                                                            <p><b>Total</b></p>
                                                        </div>
                                                        <div class="flex-sm-col col-auto">
                                                            <p class="mb-1"><b>R$<?php echo number_format($total_geral + $valor_frete, 2, ',', '.'); ?></b></p>
                                                        </div>
                                                    </div>
                                                    <hr class="my-0">
                                                </div>
                                            </div>
                                            <!-- <div style="display:flex; align-items: center; justify-content: center; padding: 3rem;"> -->
                                            <?php
                                            if ($xml->cServico->Erro == '0') {
                                            ?>
                                                <div id="div-button">

                                                    <div id="button-disabled">
                                                        <button style="margin-top: 2rem;" disabled class="btn btn-lg btn-block " id="payButton">
                                                            <div class="spinner hidden" id="spinner"></div>
                                                            <span id="buttonText">Finalizar Compra</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <script>
                                                    var eventOccurred = false;

                                                    function checkNumber() {
                                                        if (!eventOccurred) {
                                                            eventOccurred = true;
                                                            const numberCheck = document.getElementsByClassName("checkNumber");
                                                            if (numberCheck[0].value) {
                                                                const form = document.createElement("form");
                                                                const div = document.getElementById("div-button");
                                                                form.method = "POST";
                                                                form.action = "checkout-charge.php";
                                                                const productName = document.createElement("input");
                                                                productName.type = "hidden";
                                                                productName.name = "productName";
                                                                productName.value = "<?php echo $nome_produto ?>";
                                                                form.appendChild(productName);
                                                                const Amount = document.createElement("input");
                                                                Amount.type = "hidden";
                                                                Amount.name = "Amount";
                                                                Amount.value = "<?php echo $total_geral + $valor_frete ?>";
                                                                form.appendChild(Amount);
                                                                const stripeScript = document.createElement("script");
                                                                stripeScript.src = "https://checkout.stripe.com/checkout.js";
                                                                stripeScript.className = "stripe-button";
                                                                stripeScript.dataset.key = "Chave Pública";
                                                                stripeScript.dataset.amount = "<?php echo ($total_geral + $valor_frete) * 100 ?>";
                                                                stripeScript.dataset.name = "<?php echo $nome_produto ?>";
                                                                stripeScript.dataset.currency = "brl";
                                                                stripeScript.dataset.locale = "auto";
                                                                form.appendChild(stripeScript);
                                                                div.appendChild(form);
                                                                var divASerRemovida = document.getElementById("button-disabled");
                                                                var containerDiv = document.getElementById("div-button");
                                                                containerDiv.removeChild(divASerRemovida);
                                                            }
                                                        }
                                                    }
                                                </script>
                                            <?php
                                            } else {
                                            ?>
                                                <button style="margin-top: 2rem;" disabled class="btn btn-lg btn-block " id="payButton">
                                                    <div class="spinner hidden" id="spinner"></div>
                                                    <span id="buttonText">Finalizar Compra</span>
                                                </button>
                                            <?php
                                            }
                                            ?>

                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- about section end -->
        <!-- footer section start -->
        <div class="footer_section layout_padding margin_top90">
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
                            <input class="enter_email_text" placeholder="Enter Your Email" rows="5" id="comment" name="Message"></textarea>
                            <div class="subscribe_bt_1"><a href="#">Subscribe</a></div>
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
            function openForm() {
                document.getElementById("myForm").style.display = "block";
                document.body.style.pointerEvents = "none";
                document.getElementById("myForm").style.pointerEvents = "auto";
            }

            function closeForm() {
                document.getElementById("myForm").style.display = "none";
                document.body.style.pointerEvents = "auto";
                document.getElementById("myForm").style.pointerEvents = "none";
            }

            function openForm2() {
                document.getElementById("myForm2").style.display = "block";
                document.body.style.pointerEvents = "none";
                document.getElementById("myForm2").style.pointerEvents = "auto";
            }

            function closeForm2() {
                document.getElementById("myForm2").style.display = "none";
                document.body.style.pointerEvents = "auto";
                document.getElementById("myForm2").style.pointerEvents = "none";
            }

            function toggleDropdown() {
                var dropdown = document.getElementsByClassName("dropdown")[0];

                dropdown.classList.toggle("active");
            }
        </script>
    </body>

    </html>