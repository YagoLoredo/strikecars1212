<?= $this->extend("templates/layoutSite"); ?>

<?= $this->section("conteudo") ?>

<main class="site-main">
<section class="banner-slider ">
    <div class="slider-container banner">
    <h2>BEM VINDO AO STRIKE CARS</h2>
        <div class="slide active slidevideo">
            <video autoplay muted loop class="video-slide">
                <source src="<?= base_url("assets/videos/video1.mp4")?> " type="video/mp4">
                Seu navegador não suporta o elemento de vídeo.
            </video>
            <a href="<?= base_url("/veiculodetalhe/12") ?>" class="video-link">
        <!-- Texto vazio para aparecer apenas ao passar o mouse -->
    </a>
        </div>
    </div>
</section>
<div class="sessao veiculo text-center">
    <h2>COMPRE O VEÍCULO QUE MAIS COMBINA COM VOCÊ!</h2>
</div>
    <section class="section-margin calc-60px ">  
        <div class="container veiculo">
            <?php 
                if (count($this->data) > 0 ) {
                    foreach ($this->data as $aMarca) {
                        
                        if (count($aMarca['aVeiculo']) > 0) {
                            ?>


                            <div class="section-intro pb-60px text-center">
                                <h2><span class="section-intro__style"><?= $aMarca['descricao'] ?></span></h2>
                            </div>

                            <div class="row">

                                <?php foreach ($aMarca['aVeiculo'] as $aVeiculo): ?>

                                    <div class="col-md-6 col-lg-4 col-xl-3 menuveiculos">
                                        <div class="card text-center card-product">
                                            <div class="card-product__img">
                                                <img class="card-img" src="<?= base_url("uploads/veiculo/". $aVeiculo['aImagem'][0]['nomeArquivo'] ) ?>" alt="" width="210" height="210">
                                                <ul class="card-product__imgOverlay">
                                                <li><button title="Adicionar ao carrinho" onclick="addVeiculoCarrinho(<?= $aVeiculo['id'] ?>)"><i class="ti-shopping-cart"></i></button></li>
                                                </ul>
                                            </div>
                                            <div class="card-body cores">
                                                <h4 class="card-vehicle__title"><a href="<?= base_url() ?>/veiculodetalhe/<?= $aVeiculo['id'] ?>"><?= $aVeiculo['modelo'] ?></a></h4>
                                                <p class="card-vechicle__price">R$ <?= formatValor($aVeiculo['precoVenda']) ?></p>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            </div>

                            <?php
                        }
                    }
                    
                } else {
                    ?>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <h5 class="text-danger">Não há Marcas/Veículos para exibir</h5>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
    </section>

    <section class="subscribe-position">
        <div class="container ">
            <div class="subscribe text-center dentro">
                <h3 class="subscribe__title">STRIKE CARS</h3>
                <p>
                  Onde o seu próximo carro é um strike de emoções! 🚗✨</p>
                <img src="<?= base_url('assets/img/carro.jpg') ?>" alt="Logo Strike Cars">           
            </div>
        </div>
    </section>

</main>

<script src="<?= base_url("assets/js/carrinhocompras.js") ?>" type="text/Javascript">
let slideIndex = 0;
showSlides(slideIndex);

function changeSlide(n) {
    slideIndex += n;
    showSlides(slideIndex);
}

function showSlides(index) {
    let slides = document.getElementsByClassName("slide");

    // Verifica se o índice está fora do limite e o ajusta
    if (index >= slides.length) slideIndex = 0;
    if (index < 0) slideIndex = slides.length - 1;

    // Remove a classe 'active' de todos os slides e exibe apenas o slide atual
    for (let i = 0; i < slides.length; i++) {
        slides[i].classList.remove("active");
    }
    slides[slideIndex].classList.add("active");
}

</script>

<?= $this->endSection() ?>
