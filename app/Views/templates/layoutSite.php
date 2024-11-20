<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <title>Strike Cars</title>

        <link rel="icon" href="<?= base_url("assets/img/strikecars2a.png") ?>" type="image/png">
        <link rel="stylesheet" href="<?= base_url("assets/vendors/bootstrap/bootstrap.min.css") ?>">
        <link rel="stylesheet" href="<?= base_url("assets/vendors/fontawesome/css/all.min.css") ?>">
        <link rel="stylesheet" href="<?= base_url("assets/vendors/themify-icons/themify-icons.css") ?>">
        <link rel="stylesheet" href="<?= base_url("assets/vendors/nice-select/nice-select.css") ?>">
        <link rel="stylesheet" href="<?= base_url("assets/vendors/owl-carousel/owl.theme.default.min.css") ?>">
        <link rel="stylesheet" href="<?= base_url("assets/vendors/owl-carousel/owl.carousel.min.css") ?>">

        <link rel="stylesheet" href="<?= base_url("assets/css/style.css") ?>">
        <link rel="stylesheet" href="<?= base_url("assets/css/customizado.css") ?>">

        <script src="<?= base_url("assets/vendors/jquery/jquery-3.3.1.js") ?>"></script>
        <script src="<?= base_url("assets/js/jqueryMask.js") ?>" type="text/Javascript"></script>

    </head>

    <body>
        <header class="header_area inicio">
            <div class="main_menu cores ">
                <nav class="navbar navbar-expand-lg navbar-light menu">
                    <div class="container cores">
                    <a class="navbar-brand logo_h menu" href="<?= base_url() ?>"><img src="<?= base_url("assets/img/strikecars2.png") ?>" alt=""></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="collapse navbar-collapse offset"  id="navbarSupportedContent">
                            <ul class="nav navbar-nav menu_nav ml-auto mr-auto menu ">
                                <li class="nav-item active home"><a style="color: white ; bold" class="nav-link" href="<?= base_url() ?>">Home</a></li>
                                
                <?php if (isset(session()->aMenuMarca)): ?>
    <li class="nav-item submenu dropdown">
        <a href="marca" class="nav-link dropdown-toggle cores" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Marcas</a>
        <ul class="dropdown-menu">
            <?php foreach(session()->aMenuMarca as $valueMenuMarca): ?>
       
                <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>homeMarca/<?= $valueMenuMarca['id'] ?>"><?= $valueMenuMarca['descricao'] ?></a></li>            <?php endforeach; ?>
        </ul>
    </li>                                  
<?php endif; ?>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>/sobrenos">Empresa</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>/contato">Contato</a></li>
                                <?php if (session()->get('userNivel') == 1): ?>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>admin">Gerenciamento</a></li>
                                <?php endif; ?>
                                <?php
                                if (session()->getTempdata('isLoggedIn') != true) {
                                    ?>
                                    <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>login">Entre ou cadastre-se</a></li>
                                    <?php
                                } else {
                                    ?>
                                    <li class="nav-item submenu dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= substr(session()->getTempdata('userNome'), 0 , 15) ?></a>
                                        <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>Login/signOut">Sair</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>Pessoa/form/update/<?= session()->get('userPessoa_id') ?>">Perfil</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>PessoaEndereco">Meus Endereços</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>Pedido">Meus pedidos</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>Usuario">Usuario</a></li>
                                            <li class="nav-item"><a class="nav-link" href="trocarSenha">Trocar Senha</a></li>
                                            <?php if (session()->get('userNivel') == 1): ?>
                                            <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>Marca">Marcas</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>Veiculo">Veiculos</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>Vendedor">Vendedores</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>Cidade">Cidades</a></li>
                                            <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>/Uf">UF</a></li>
                                            <?php endif; ?>
                                            </ul>

                                    </li>                            
                                    <?php
                                }
                                ?>
                            </ul>

                            <div class="shop_right_sidebar nav-item">

                                <form class="form-inline my-2 my-lg-0 search_nav">
                                    
                                        
                                </form>

                            </div>

                            <ul class="nav-shop">

                            <?php
                                    $aCarrinho = session()->get("CarrinhoItens");
                                    if (is_null($aCarrinho)) {
                                        $aCarrinho = [];
                                    }
                                ?>
                                <a href="<?= base_url() ?>carrinhoCompras">
                                    <li class="nav-item"><button><i class="ti-shopping-cart "></i><span class="nav-shop__circle"><?= count($aCarrinho) ?></span></button> </li>                    
                                </a>
                                </ul>           
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <main class="container">
            <section>
                <?= $this->renderSection('conteudo') ?>
            </section>
        </main>
        
        <footer class="footer mt-5">
            <div class="footer-area final">
                <div class="container">
                    <div class="row section_gap">
                        <div class="col-lg-5 col-md-6 col-sm-6">
                            <div class="single-footer-widget tp_widgets cores">
                                <h4 class="footer_title large_title">STRIKE CARS</h4>
                                <p>
                                A Strike cars está desde 2020 no mercado e tem as melhores propostas para você comprar o carro dos seus sonhos. Zero-Quilometro ou Semi-novo, na Strike Cars você tem a certeza de estar fazendo o melhor negócio.                                </p>
                                <h4 class="footer_title large_title">Nossa visão</h4>
                                <p>Trazer desenvolvimento econômico e social, promover o bem estar e conhecimento, ser referência no meio jornalístico. </p>
                            </div>
                        </div>
                        <div class="offset-lg-1 col-lg-2 col-md-6 col-sm-6 cores">
                            <div class="single-footer-widget tp_widgets">
                                <h4 class="footer_title">Nossos Serviços</h4>
                                <ul class="list cores">
                                    <li><a href="/home">Home</a></li>
                                    <li><a href="/sobrenos?view=sobre-o-autor">Sobre nós</a></li>
                                    <li><a href="/contato?view=contato">Contato</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
                            <div class="single-footer-widget tp_widgets">
                                <h4 class="footer_title cores">Contato</h4>
                                <div class="ml-40">
                                    <p class="sm-head">
                                        <span class="fa fa-location-arrow color cores"></span> Endereço:
                                    </p>
                                    <p>Av. Altino Rodrigues Pereira, 10 - José Cirilo <br /> Muriaé-MG</p>

                                    <p class="sm-head">
                                        <span class="fa fa-phone"></span> Telefone:
                                    </p>
                                    <p>
                                        +55 (32) 3721-0001
                                    </p>

                                    <p class="sm-head">
                                        <span class="fa fa-envelope"></span> Email
                                    </p>
                                    <p>
                                        contato@strikecars.com.br <br> <a href="https://www.fasm.online/" target="_blank" title="STRIKE CARS">fasm.online</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom inicio">
                <div class="container">
                    <div class="row d-flex">
                        <p class="col-lg-12 footer-text text-center">
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> Todos os direitos reservados | Strike Cars | <a href="https://www.strikecars.com.br/" target="_blank">FASM</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        <script src="<?= base_url("assets/vendors/bootstrap/bootstrap.bundle.min.js") ?>"></script>
        <script src="<?= base_url("assets/vendors/skrollr.min.js") ?>"></script>
        <script src="<?= base_url("assets/vendors/owl-carousel/owl.carousel.min.js") ?>"></script>
        <script src="<?= base_url("assets/vendors/jquery.ajaxchimp.min.js") ?>"></script>
        <script src="<?= base_url("assets/vendors/mail-script.js") ?>"></script>
        <script src="<?= base_url("assets/js/main.js") ?>"></script>
        
    </body>

</html>