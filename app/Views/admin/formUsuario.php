<?= $this->extend("templates/layoutSite"); ?>

<?= $this->section("conteudo") ?>

<main class="container">

    <?= exibeTitulo("Usuario", ['acao' => $action]) ?>

    <section class="mb-5">

        <?= form_open("Usuario/". ($action == "delete" ? 'delete' : 'store') , ['enctype' => 'multipart/form-data']) ?>

            <div class="row">
                <!-- Campo oculto para o ID -->
                <input type="hidden" name="id" value="<?= setaValor('id', $data) ?>">

                <div class="form-group col-5">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome"  class="form-control" maxlength="50" value="<?= setaValor('nome', $data) ?>" required autofocus>
                    <?= setaMsgErrorCampo('nome', $errors) ?>
                </div>
                <?php if (session()->get('userNivel') == 1): ?>
    <!-- Campo de Nível (visível e editável apenas para admins) -->
    <div class="form-group col-12 col-md-4">
        <label for="nivel" class="form-label">Nível</label>
        <select name="nivel" id="nivel" class="form-control" required>
            <option value="1" <?= (setaValor('nivel', $data) == 1) ? 'selected' : '' ?>>Administrador</option>
            <option value="11" <?= (setaValor('nivel', $data) == 11) ? 'selected' : '' ?>>Usuário Comum</option>
        </select>
        <?= setaMsgErrorCampo('nivel', $errors) ?>
    </div>                   
    <!-- Campo de Status (visível e editável apenas para admins) -->
    <div class="form-group col-12 col-md-4">
        <?= comboboxStatus(setaValor('statusRegistro', $data)) ?>
        <?= setaMsgErrorCampo('statusRegistro', $errors) ?>
    </div>
<?php else: ?>
    <!-- Para usuários comuns (nível 11), os campos de nível e status ficam ocultos -->
    <div class="form-group col-12 col-md-4" hidden>
        <label for="nivel" class="form-label">Nível</label>
        <input type="text" name="nivel" id="nivel" class="form-control" value="<?= setaValor('nivel', $data) ?>" readonly>
        <?= setaMsgErrorCampo('nivel', $errors) ?>
    </div>                   
    <div class="form-group col-12 col-md-4" hidden>
        <?= comboboxStatus(setaValor('statusRegistro', $data)) ?>
        <?= setaMsgErrorCampo('statusRegistro', $errors) ?>
    </div>
        <?php endif; ?>
            <?php if (session()->get('userNivel') == 11): ?>
                <div class="form-group col-5">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="text" name="email" id="email"  class="form-control" maxlength="50" value="<?= setaValor('email', $data) ?>" required autofocus>
                    <?= setaMsgErrorCampo('email', $errors) ?>
                </div>
            <?php else: ?>
                <div class="form-group col-5" hidden>
                    <label for="email" class="form-label">E-mail</label>
                    <input type="text" name="email" id="email"  class="form-control" maxlength="50" value="<?= setaValor('email', $data) ?>" required autofocus>
                    <?= setaMsgErrorCampo('email', $errors) ?>
                </div>
        <?php endif; ?>        
                <div class="form-group col-15 col-md-10">
                    <a href="<?= base_url() ?>/Usuario">Voltar</a>
                    <button type="submit" value="submit" class="button button-login ml-3">Gravar</button>
                </div>
            </div>
            

        <?= form_close() ?>

    </section>
    
</main>

<?= $this->endSection() ?>
