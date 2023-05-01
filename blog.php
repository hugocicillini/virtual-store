<?php
include('conexaodb.php');
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
   <title>Blog</title>
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
   <link rel="shortcut icon" href="html/images/fevicon.png" type="image/x-icon">
   <!-- Scrollbar Custom CSS -->
   <link rel="stylesheet" href="html/css/jquery.mCustomScrollbar.min.css">
   <!-- Tweaks for older IEs-->
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <!-- fonts -->
   <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
   <!-- owl stylesheets -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" rel="stylesheet" />
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
   <!-- Blog section start -->
   <div class="blog_section layout_padding">
      <div class="container">
         <h1 class="blog_taital">Latest Blog</h1>
         <div class="blog_section_2">
            <div class="row">
               <div class="col-md-5">
                  <div class="face_img"><img src="html/images/face-img.png" class="face_img"></div>
               </div>
               <div class="col-md-7">
                  <h1 class="face_text">Face Cream Very Mosurations</h1>
                  <p class="lorem_text"> Nova fórmula do Face Cream Very Moisturizing promete pele hidratada e radiante <br>

                     A marca de cuidados com a pele, Deni, lançou uma nova fórmula para o seu creme hidratante, o Face Cream Very Moisturizing. O produto agora contém uma mistura única de ingredientes naturais que prometem deixar a pele hidratada e radiante durante todo o dia. <br>

                     A nova fórmula do Face Cream Very Moisturizing contém ácido hialurônico, extrato de aloe vera e óleo de argan. O ácido hialurônico é conhecido por suas propriedades hidratantes profundas, enquanto o extrato de aloe vera ajuda a acalmar e suavizar a pele. O óleo de argan é rico em antioxidantes e ácidos graxos essenciais, ajudando a melhorar a textura da pele e protegê-la dos danos ambientais. <br>

                     De acordo com a Deni, o Face Cream Very Moisturizing é perfeito para todos os tipos de pele e pode ser usado tanto durante o dia quanto à noite. A empresa também afirma que o creme é facilmente absorvido pela pele, deixando-a com uma sensação suave e macia. <br>

                     "Estamos muito animados em lançar a nova fórmula do Face Cream Very Moisturizing", disse o porta-voz da Deni. "Nossa equipe trabalhou duro para criar uma mistura única de ingredientes naturais que oferecem hidratação profunda e deixam a pele com uma aparência radiante. Estamos confiantes de que nossos clientes vão adorar o resultado!" <br>

                     O Face Cream Very Moisturizing já está disponível para compra no site oficial da Deni e em lojas selecionadas.</p> <br>
                  <div class="read_bt_1"><a href="#">Saiba mais</a></div>
               </div>
            </div>
         </div>
         <div class="blog_section_3">
            <div class="row">
               <div class="col-md-7">
                  <h1 class="face_text">Face Cream Very Mosurations Skin</h1>
                  <p class="lorem_text">O Face Cream Very Moisturizing Skin é um creme hidratante desenvolvido pela marca de cuidados com a pele, Deni. Ele é especialmente formulado para fornecer hidratação profunda e duradoura à pele, deixando-a macia, suave e radiante. <br>

                     O creme contém uma mistura exclusiva de ingredientes naturais, incluindo ácido hialurônico, extrato de aloe vera e óleo de argan. O ácido hialurônico ajuda a reter a umidade na pele, mantendo-a hidratada e saudável. O extrato de aloe vera é conhecido por suas propriedades calmantes e suavizantes, enquanto o óleo de argan é rico em antioxidantes e ácidos graxos essenciais, que ajudam a proteger a pele contra os danos ambientais e melhoram sua textura. <br>

                     O Face Cream Very Moisturizing Skin é adequado para todos os tipos de pele e pode ser usado diariamente. Ele é absorvido facilmente pela pele, sem deixar resíduos oleosos ou pegajosos. Além disso, o creme é livre de fragrâncias artificiais e é testado dermatologicamente, sendo uma opção segura para quem tem pele sensível. <br>

                     Para melhores resultados, é recomendado aplicar o Face Cream Very Moisturizing Skin na pele limpa e seca, de manhã e à noite. Massageie delicadamente o creme no rosto, pescoço e colo até que seja completamente absorvido. <br>

                     "Aqui na Deni, estamos comprometidos em fornecer aos nossos clientes os melhores produtos de cuidados com a pele, e o Face Cream Very Moisturizing Skin é um exemplo disso", disse um porta-voz da empresa. "Nossa fórmula exclusiva oferece hidratação profunda e duradoura, deixando a pele radiante e saudável. Experimente e sinta a diferença!" <br>

                     O Face Cream Very Moisturizing Skin está disponível para compra no site oficial da Deni e em lojas selecionadas.</p>
                  <div class="readmore_bt"><a href="#">Saiba mais</a></div>
               </div>
               <div class="col-md-5">
                  <div class="face_img"><img src="html/images/face-img1.png" class="face_img"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Blog section end -->
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
                  <div class="subscribe_bt_1"><a href="#">Inscreva-se
                     </a></div>
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
         <p class="copyright_text">© 2023 All Rights Reserved.<a href="https://github.com/hugocicillini" target="_blank">hugocicillini</a></p>
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