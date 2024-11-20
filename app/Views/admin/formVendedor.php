<?= $this->extend("templates/layoutSite"); ?>

<?= $this->section("conteudo") ?>

<main class="container">

    <?= exibeTitulo("Vendedores", ['acao' => $action]) ?>

    <section class="mb-5">

        <?= form_open("Vendedor/". ($action == "delete" ? 'delete' : 'store')) ?>

            <div class="row">

                <div class="form-group col-12 col-md-8">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome"  class="form-control" maxlength="50" value="<?= setaValor('nome', $data) ?>" required autofocus>
                    <?= setaMsgErrorCampo('nome', $errors) ?>
                </div>
                <div class="form-group col-12 col-md-8">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" name="cpf" id="cpf"  class="form-control" maxlength="50" value="<?= setaValor('cpf', $data) ?>" required autofocus>
                    <?= setaMsgErrorCampo('cpf', $errors) ?>
                </div>
                <div class="form-group col-12 col-md-8">
                    <label for="comissao" class="form-label">Comissão</label>
                    <input type="text" name="comissao" id="comissao"  class="form-control" maxlength="50" value="<?= setaValor('comissao', $data) ?>" required autofocus>
                    <?= setaMsgErrorCampo('comissao', $errors) ?>
                </div>

                <div class="form-group col-12 col-md-4">
                    <?= comboboxStatus(setaValor('statusRegistro', $data)) ?>
                    <?= setaMsgErrorCampo('statusRegistro', $errors) ?>
                </div>

                <input type="hidden" name="action" value="<?= $action ?>">
                <input type="hidden" name="id" value="<?= setaValor("id", $data) ?>">

                <div class="form-group col-12 col-md-8">
                    <a href="<?= base_url() ?>/Vendedor">Voltar</a>
                    <button type="submit" value="submit" class="button button-login ml-3">Gravar</button>
                </div>

            </div>

        <?= form_close() ?>

    </section>
    
</main>
<script src="<?= base_url("assets/ckeditor5/ckeditor.js") ?>" type="text/Javascript"></script>

<script type="text/javascript">
    
    

    $(document).ready( function() { 
        $('#comissao').mask('###%', {reverse: true});
        $('#cpf').mask('###.###.###-##', {reverse: true});
    })

</script>

<?= $this->endSection() ?>
