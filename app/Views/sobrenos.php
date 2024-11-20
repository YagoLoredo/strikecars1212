<?= $this->extend("templates/layoutSite"); ?>

<?= $this->section("conteudo") ?>

<section>
    <div class="container sobres">
            <div class="mt-5 mb-5 text-center">
                <h1>Sobre nós</h1>
            </div>
        </div>
    </div>
</section>

<main class="site-main">

    <section class="blog_area">
        <div class="container sobre">
            <div class="row">

                <div class="col-12">
                    <div class="blog_left_sidebar">

                        <article class="row mt-5">
                            <p class="col-12 text-center">
                                <img class="author_img" src="<?= base_url("assets/img/strikecarsfabrica.jpg") ?>" alt="">
                            </p>
                            
                            <h4 class="col-12 text-center">STRIKE CARS</h4>
                            <p class="col-12 text-center">A MAIOR CONCESSIONARIA DO BRASIL</p>
                            <p class="col-12 text-center social_icon" style="font-size: 24px;">
                                <a href="https://www.facebook.com/profile.php?id=61567781956101" tile="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="/home" title="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="/home" title="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="/home" title="LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>

                            </p>
                            <p class="col-12">
                            A Strike Cars é mais do que uma concessionária. Somos uma ponte que conecta 
                            pessoas aos seus sonhos sobre quatro rodas, e cada cliente que atendemos se 
                            torna parte da nossa história. Surgimos do coração de Muriaé, movidos pela 
                            paixão de inovar e pela força de fazer algo único e impactante.
                            </p>
                            <p class="col-12">
                            Nosso fundador, vindo de raízes humildes, acreditou que poderia criar algo grandioso 
                            e acessível a todos. Com cada veículo, buscamos oferecer muito mais do que um produto; 
                            oferecemos uma experiência, um momento de conquista, e um passo rumo ao futuro que cada pessoa deseja.
                            </p>
                            <p class="col-12">
                            Aqui, valorizamos o trabalho em equipe, a honestidade e o cuidado com cada detalhe. Nosso 
                            compromisso é com você, com seus sonhos e com o que podemos construir juntos. Bem-vindo à 
                            nossa família, bem-vindo à Strike Cars.
                            </p>
                            <div class="br"></div>

                        </article>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<?= $this->endSection() ?>