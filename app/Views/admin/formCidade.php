<?php 

    $this->extend('templates/layoutSite');
    $this->section('conteudo');

    ?>
    
    <?= exibeTitulo("Cidade", ['acao' => $action]) ?>

    <?= form_open("Cidade/". ($action == "delete" ? 'delete' : 'store')) ?>

        <div class="row">

            <div class="form-group col-12 col-md-3">
                <label for="nome" class="form-label">Cidade</label>
                <input type="text" name="nome" id="nome"  class="form-control" maxlength="50" value="<?= setaValor('nome', $data) ?>" required autofocus>
                <?= setaMsgErrorCampo('nome', $errors) ?>
            </div>

            <div class="form-group col-12 col-md-3">
                <label for="codIBGE" class="form-label">Código IBGE</label>
                <input type="text" name="codIBGE" id="codIBGE"  class="form-control" maxlength="2" value="<?= setaValor('codIBGE', $data) ?>" required>
                <?= setaMsgErrorCampo('codIBGE', $errors) ?>
            </div>

            <div class="form-group col-6">
                <label for="uf_id" class="form-label">UF</label>
                <select name="uf_id" id="uf_id" class="form-control" required>
                <option value="">Selecione uma UF...</option>
                <?php foreach ($aUf as $ufValue): ?>
                    <option value="<?= $ufValue['id'] ?>" <?= (setaValor("uf_id", $data) == $ufValue['id'] ? "selected" : "") ?>>
                      <?= $ufValue['sigla'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?= setaMsgErrorCampo("uf_id", $errors) ?>
            </div>

            <input type="hidden" name="action" value="<?= $action ?>">
            <input type="hidden" name="id" value="<?= setaValor("id", $data) ?>">
        </div>
        <div class="row">
            <div class="form-group col-12 col-md-12">
                <a href="<?= base_url() ?>/Cidade">Voltar</a>
                <button type="submit" value="submit" class="button button-login ml-3">Gravar</button>
            </div>
        </div>

    <?= form_close() ?>

<?= $this->endSection() ?>