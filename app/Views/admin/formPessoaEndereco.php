<?= $this->extend("templates/layoutSite"); ?>

<?= $this->section("conteudo") ?>

<main class="container">

    <?= exibeTitulo("Enderecos", ['acao' => $action]) ?>

    <section class="mb-5">

        <?= form_open("PessoaEndereco/". ($action == "delete" ? 'delete' : 'store')) ?>

            <div class="row">

                <div class="form-group col-12 col-md-4">
                    <label for="tipoEndereco" class="form-label">Tipo do Endereço</label>
                    <select name="tipoEndereco" id="tipoEndereco" class="form-control" required autofocus>
                        <option value=""  <?= (setaValor("tipoEndereco", $data) == 0 ? "selected" : "") ?>>...</option>
                        <option value="1" <?= (setaValor("tipoEndereco", $data) == 1 ? "selected" : "") ?>>Cobranca</option>
                        <option value="2" <?= (setaValor("tipoEndereco", $data) == 2 ? "selected" : "") ?>>Entrega</option>
                    </select>
                    <?= setaMsgErrorCampo('tipoEndereco', $errors) ?>
                </div>
                <div class="form-group col-12 col-md-8">
                    <label for="logradouro" class="form-label">Logradouro</label>
                    <input type="text" name="logradouro" id="logradouro"  class="form-control" maxlength="60" value="<?= setaValor('logradouro', $data) ?>" required>
                    <?= setaMsgErrorCampo('logradouro', $errors) ?>
                </div>

                <!-- -->

                <div class="form-group col-6 col-md-3">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" name="numero" id="numero"  class="form-control" maxlength="10" value="<?= setaValor('numero', $data) ?>" required>
                    <?= setaMsgErrorCampo('numero', $errors) ?>
                </div>

                <div class="form-group col-6 col-md-4">
                    <label for="complemento" class="form-label">Complemento</label>
                    <input type="text" name="complemento" id="complemento"  class="form-control" maxlength="20" value="<?= setaValor('complemento', $data) ?>">
                    <?= setaMsgErrorCampo('complemento', $errors) ?>
                </div>

                <div class="form-group col-6 col-md-5">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" name="bairro" id="bairro"  class="form-control" maxlength="40" value="<?= setaValor('bairro', $data) ?>" required>
                    <?= setaMsgErrorCampo('bairro', $errors) ?>
                </div>

                <!-- -->

                <div class="form-group col-6 col-md-3">
                    <label for="uf_id" class="form-label">UF</label>
                    <select name="uf_id" id="uf_id" class="form-control" required>
                        <option value=""  <?= (setaValor("uf_id", $data) == 0 ? "selected" : "") ?>>...</option>
                        <?php foreach ($aUfs as $uf): ?>
                            <option value="<?= $uf['id'] ?>" <?= (setaValor("uf_id", $data) == $uf['id'] ? "selected" : "") ?>><?= $uf['sigla'] ?></option>
                        <?php endforeach; ?>                        
                    </select>
                    <?= setaMsgErrorCampo('uf_id', $errors) ?>
                </div>

                <div class="form-group col-6 col-md-6">
                    <label for="cidade_id" class="form-label">Cidade</label>
                    <select name="cidade_id" id="cidade_id" class="form-control" required>
                        <option value=""  <?= (setaValor("cidade_id", $data) == 0 ? "selected" : "") ?>>--- Selecione a UF ---</option>
                        
                        <?php foreach ($aCidade as $cidade): ?>
                            <option value="<?= $cidade['id'] ?>" <?= (setaValor("cidade_id", $data) == $cidade['id'] ? "selected" : "") ?>><?= $cidade['nome'] ?></option>
                        <?php endforeach; ?>                        

                    </select>
                    <?= setaMsgErrorCampo('cidade_id', $errors) ?>
                </div>

                <div class="form-group col-6 col-md-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" name="cep" id="cep"  class="form-control" maxlength="8" value="<?= setaValor('cep', $data) ?>" required>
                    <?= setaMsgErrorCampo('cep', $errors) ?>
                </div>

                <input type="hidden" name="action" value="<?= $action ?>">
                <input type="hidden" name="id" value="<?= setaValor("id", $data) ?>">

                <div class="form-group col-12 col-md-8">
                    <a href="<?= base_url() ?>/PessoaEndereco">Voltar</a>
                    <?php if ($action != 'view'): ?>
                        <button type="submit" value="submit" class="button button-login ml-3">Gravar</button>
                    <?php endif; ?>
                </div>

            </div>

        <?= form_close() ?>

    </section>
    
</main>

<script type="text/javascript">
	
    $(function(){
        $('#uf_id').change(function(){

            if( $(this).val() ) {
                $('#cidade_id').hide();
                $('.carregando').show();                
                $.getJSON('/Pessoa/getCidade/' + $(this).val(),{ajax: 'true'}, function(j){
                    var options = '<option value=""></option>';	
                    for (var i = 0; i < j.length; i++) {
                        options += '<option value="' + j[ i ].id + '">' + j[i].nome + '</option>';
                    }	

                    $('#cidade_id').html(options).show();
                    $('.carregando').hide();
                });
            } else {
                $('#cidade_id').html('<option value="">--- Selecione a UF ---</option>');
            }
        });
        
    });

</script>

<?= $this->endSection() ?>