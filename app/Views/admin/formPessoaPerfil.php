<?= $this->extend("templates/layoutSite"); ?>

<?= $this->section("conteudo") ?>

<section>
    <div class="container">
        <div class="blog-banner">
            <div class="mt-5 text-left">
                <h1 style="color: #384aeb;">Perfil</h1>
            </div>
        </div>
    </div>

    <?php
        echo mensagemSucesso();
        echo mensagemError();
    ?>

</section>

<div class="container">
    <div class="col-lg-6">
        <div class="login_form_inner register_form_inner">

            <?= form_open("Pessoa/". ($action == "delete" ? 'delete' : 'store'), ["class" => "row login_form", "id" => "register_form"]) ?>

                <input type="hidden" name="id" id="id" value="<?= setaValor('id', $data) ?>">

                <div class="col-md-12 form-group">
                    <input type="text" class="form-control" id="nome" name="nome" 
                            placeholder="Nome Completo"
                            onblur="this.placeholder = 'Nome Completo'" autofocus  
                            value="<?= setaValor('nome', $data) ?>">
                    <?= setaMsgErrorCampo('nome', $errors) ?>
                </div>
                <div class="col-md-4 form-group">
                    <input type="text" class="form-control" id="ddd1" name="ddd1" placeholder="DDD" onfocus="this.placeholder = ''" 
                            onblur="this.placeholder = 'DDD'"
                            value="<?= setaValor('ddd1', $data) ?>">
                    <?= setaMsgErrorCampo('ddd1', $errors) ?>
                </div>
                <div class="col-md-8 form-group">
                    <input type="text" class="form-control" id="celular1" name="celular1" placeholder="Celular para contato" 
                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Celular para contato'"
                            value="<?= setaValor('celular1', $data) ?>">
                    <?= setaMsgErrorCampo('celular1', $errors) ?>
                </div>
                <div class="col-md-12 form-group">
                </div>
                <div class="col-md-12 form-group">
                    <button type="submit" value="submit" class="button button-register w-100">Atualizar</button>
                </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>