<?php 

    $this->extend('templates/layoutSite');
    $this->section('conteudo');

?>

<section>
    <div class="container">
        <div class="blog-banner estoque">
            <div class="mt-5 mb-5 text-center">
                <h2>GERENCIAMENTO DE ESTOQUES</h2>
            </div>
        </div>
    </div>
</section>

<section class="section-margin--small">
    <div class="container logostrike">
       
        
        <!-- Seção para a logo do Strike Cars -->
        <div class="text-center mt-10 mb-10">
            <img src="<?= base_url('assets/img/strikecars2a.png') ?>" alt="Logo Strike Cars">
        </div>

        <!-- Botões de cadastro -->
        <div class="row justify-content-center text-center">
            <div class="col-md-4 mx-2 mb-2">
                <a href="<?= base_url('/Veiculo') ?>" class="btn btn-primary botoes" style="width: 100%;">Cadastrar Veículo</a>
            </div>
            <div class="col-md-4 mx-2 mb-2">
                <a href="<?= base_url('/Marca') ?>" class="btn btn-primary botoes" style="width: 100%;">Cadastrar Marca</a>
            </div>
            <div class="col-md-4 mx-2 mb-2">
                <a href="<?= base_url('/Vendedor') ?>" class="btn btn-primary botoes" style="width: 100%;">Cadastrar Vendedor</a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
