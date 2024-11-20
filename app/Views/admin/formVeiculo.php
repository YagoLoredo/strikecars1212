<?= $this->extend("templates/layoutSite"); ?>

<?= $this->section("conteudo") ?>

<main class="container">

    <?= exibeTitulo("Veiculo", ['acao' => $action]) ?>

    <section class="mb-5">

        <?= form_open("Veiculo/". ($action == "delete" ? 'delete' : 'store') , ['enctype' => 'multipart/form-data']) ?>

            <div class="row">

                <div class="form-group col-12 col-md-8">
                    <label for="modelo" class="form-label">Modelo</label>
                    <input type="text" name="modelo" id="modelo"  class="form-control" maxlength="50" value="<?= setaValor('modelo', $data) ?>" required autofocus>
                    <?= setaMsgErrorCampo('modelo', $errors) ?>
                </div>

                <div class="form-group col-12 col-md-4">
                    <?= comboboxStatus(setaValor('statusRegistro', $data)) ?>
                    <?= setaMsgErrorCampo('statusRegistro', $errors) ?>
                </div>

                <div class="form-group col-12">
                    <label for="detalhamento" class="form-label">Detalhamento</label>
                    <textarea class="form-control" name="detalhamento" id="detalhamento"
                        placeholder="Descreva detalhes técnicos do Veiculo"><?= setaValor("detalhamento", $data) ?></textarea>
                    <?= setaMsgErrorCampo("detalhamento", $errors) ?>
                </div>

                <div class="form-group col-6">
                    <label for="marca_id" class="form-label">Marca</label>
                    <select name="marca_id" id="marca_id" class="form-control" required>
                        <option value="">...</option>
                        <?php foreach ($aMarca as $marcaValue): ?>
                            <option value="<?= $marcaValue['id'] ?>" <?= (setaValor("marca_id", $data) == $marcaValue['id'] ? "selected" : "") ?>><?= $marcaValue['descricao'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= setaMsgErrorCampo("marca_id", $errors) ?>
                </div>
                
                <div class="form-group col-12 col-md-3">
                    <label for="precoVenda" class="form-label">Preço de Venda</label>
                    <input type="text" name="precoVenda" id="precoVenda"  class="form-control" maxlength="20" value="<?= setaValor('precoVenda', $data) ?>" required dir="rtl">
                    <?= setaMsgErrorCampo('precoVenda', $errors) ?>
                </div>
                
                <div class="form-group col-12 col-md-3">
                    <label for="placa" class="form-label">Placa</label>
                    <input type="text" name="placa" id="placa"  class="form-control" maxlength="20" value="<?= setaValor('placa', $data) ?>" required dir="rtl">
                    <?= setaMsgErrorCampo('placa', $errors) ?>
                </div>


                <div class="form-group col-12 col-md-4">
                    <label for="anoFabricacao" class="form-label">Ano de Fabricacao</label>
                    <input type="text" name="anoFabricacao" id="anoFabricacao"  class="form-control" maxlength="20" value="<?= setaValor('anoFabricacao', $data) ?>" required>
                    <?= setaMsgErrorCampo('anoFabricacao', $errors) ?>
                </div>
                <div class="form-group col-12 col-md-4">
                    <label for="cor" class="form-label">Cor</label>
                    <input type="text" name="cor" id="cor"  class="form-control" maxlength="20" value="<?= setaValor('cor', $data) ?>" required>
                    <?= setaMsgErrorCampo('cor', $errors) ?>
                </div>
                <div class="col-12 form-group">
                    <label for="imagem" class="form-label">Imagens</label>
                    <input type="file" class="form-control" id="imagem" name="imagem[]" multiple>
                    <div id="imagem" class="form-text">Recomendamos Imagens de Até 210x210</div>
                </div>

            </div>

            <hr />
            <h3>Imagens</h3>

            <div class="row">

                <?php foreach ($aAnexo as $anexo): ?>
                    <div class="col-3">
                        <img src="<?= base_url('uploads/veiculo/' . $anexo['nomeArquivo']) ?>" alt="..." width="210" height="210">
                        <a href="<?= base_url() ?>/Veiculo/excluirImagem/<?= setaValor("id", $data) . "/" . $action . "/" . $anexo['nomeArquivo'] ?>">Excluir</a>
                    </div>
                <?php endforeach; ?>

            </div>
            
            <hr />

            <div class="row">

                <input type="hidden" name="action" value="<?= $action ?>">
                <input type="hidden" name="id" value="<?= setaValor("id", $data) ?>">

                <div class="form-group col-12">
                    <a href="<?= base_url() ?>/Veiculo">Voltar</a>
                    <button type="submit" value="submit" class="button button-login ml-3">Gravar</button>
                </div>

            </div>

        <?= form_close() ?>

    </section>
    
</main>

<script src="<?= base_url("assets/ckeditor5/ckeditor.js") ?>" type="text/Javascript"></script>

<script type="text/javascript">
    
    ClassicEditor
        .create(document.querySelector('#detalhamento'))
        .catch(error => {
            console.error(error);
    });

    $(document).ready( function() { 
        $('#precoVenda').mask('##.###.###.##0,00', {reverse: true});
        $('#AnoFabricacao').mask('##.##.####', {reverse: true});
    })

</script>

<?= $this->endSection() ?>