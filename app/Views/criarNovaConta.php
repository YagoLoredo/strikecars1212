<?= $this->extend("templates/layoutSite"); ?>

<?= $this->section("conteudo") ?>

<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2 login">
              <div class="text-white px-20 py-5 p-md-10 mx-md-5">
                <h4 class="mb-5">Já possui conta?</h4>
                <p class="mb-1">Faça seu login e aproveite nossos conteúdos e recursos criados para você.</p>
                <a href="<?= base_url() ?>login" class="btn btn-outline-light mt-4">Login</a>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="<?= base_url('assets/img/strikecars2a.png') ?>" style="width: 185px;" alt="Logo">
                  <h4 class="mt-1 mb-5 pb-1">Crie sua nova conta no Strike Cars</h4>
                </div>

                <?= form_open("gravarNovaConta", ["class" => "login_form", "id" => "register_form"]) ?>

                  <div class="form-outline mb-4">
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome Completo" value="<?= setaValor('nome', $data) ?>">
                    <?= setaMsgErrorCampo('nome', $errors) ?>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="text" id="ddd1" name="ddd1" class="form-control" placeholder="DDD" value="<?= setaValor('ddd1', $data) ?>">
                    <?= setaMsgErrorCampo('ddd1', $errors) ?>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="text" id="celular1" name="celular1" class="form-control" placeholder="Celular para contato" value="<?= setaValor('celular1', $data) ?>">
                    <?= setaMsgErrorCampo('celular1', $errors) ?>
                  </div>

                  <div class="form-outline mb-4">
                  <input type="email" id="email" name="email" class="form-control" placeholder="Seu melhor e-mail" value="<?= setaValor('email', $data) ?>" required>
                  <?= setaMsgErrorCampo('email', $errors) ?>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="senha" name="senha" class="form-control" placeholder="Sua senha">
                    <?= setaMsgErrorCampo('senha', $errors) ?>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="confirmaSenha" name="confirmaSenha" class="form-control" placeholder="Confirme sua senha">
                  </div>

                  <div class="col-md-12 form-group">
                    <?= mensagemSucesso() ?>
                    <?= mensagemError() ?>
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">Criar conta</button>
                  </div>

                <?= form_close() ?>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  document.getElementById('register_form').addEventListener('submit', function (event) {
    const emailField = document.getElementById('email');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(emailField.value)) {
        alert('Por favor, insira um e-mail válido.');
        event.preventDefault(); 
    }
});
</script>

<?= $this->endSection() ?>

