<?= $this->extend("templates/layoutSite"); ?>

<?= $this->section("conteudo") ?>

<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="<?= base_url('assets/img/strikecars2a.png') ?>" style="width: 185px;" alt="Logo">
                  <h4 class="mt-1 mb-5 pb-1 time">Redefinir Senha</h4>
                </div>

                <form method="POST" action="<?= base_url('alterarSenhaProcess') ?>" id="trocarSenha">
                  <p>Insira o e-mail associado à sua conta para redefinir a senha</p>

                  <div class="form-outline mb-4">
                    <input type="text" id="email" name="email" class="form-control" placeholder="E-mail" value="<?= set_value('email') ?>" required />
                    <label class="form-label" for="email">E-mail</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="novaSenha" name="novaSenha" class="form-control" required />
                    <label class="form-label" for="novaSenha">Nova Senha</label>
                    <button class="btn-icone-senha" type="button" id="toggleNovaSenha">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </button>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="confirmaSenha" name="confirmaSenha" class="form-control" required />
                    <label class="form-label" for="confirmaSenha">Confirme a Nova Senha</label>
                    <button class="btn-icone-senha" type="button" id="toggleConfirmaSenha">
                               <i class="fa fa-eye" aria-hidden="true"></i>
                    </button>
                  </div>

                  <div class="col-md-12 form-group">
                    <?= mensagemSucesso() ?>
                    <?= mensagemError() ?>
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Redefinir Senha</button>
                    <a class="text-muted" href="<?= base_url() ?>/login">Voltar ao login</a>
                  </div>
                </form>

              </div>
            </div>

            <div class="col-lg-6 d-flex align-items-center gradient-custom-2 login">
              <div class="text-white px-5 py-5 p-md-5 mx-md-10">
                <h4 class="mb-5">Estamos aqui para ajudar você!</h4>
                <p class="mb-0">No Strike Cars, queremos que sua experiência seja tranquila e segura. Se você esqueceu sua senha, redefina-a e continue sua jornada conosco!</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
    document.getElementById('toggleNovaSenha').addEventListener('click', function () {
        var senhaInput = document.getElementById('novaSenha');
        var icon = this.querySelector('i');
        
        if (senhaInput.type === 'password') {
            senhaInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            senhaInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });


    // Toggle para visualizar a senha (Confirmar Senha)
    document.getElementById('toggleConfirmaSenha').addEventListener('click', function () {
        var senhaInput = document.getElementById('confirmaSenha');
        var icon = this.querySelector('i');
        
        if (senhaInput.type === 'password') {
            senhaInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            senhaInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    // Validação de força da senha
    document.getElementById('novaSenha').addEventListener('input', function () {
        var senha = this.value;
        var forca = document.getElementById('senhaForca');
        var submitBtn = document.getElementById('submitBtn');
        
        var regExpFraca = /^(?=.*[a-zA-Z]).{6,}$/; // Fraca: letras, 6 caracteres
        var regExpMedia = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/; // Média: letras + números, 8 caracteres
        var regExpForte = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}|:"<>?]).{10,}$/; // Forte: letras + números + caracteres especiais, 10 caracteres
        
        if (senha.match(regExpForte)) {
            forca.textContent = "Senha Forte";
            forca.className = "senha-forte";
            submitBtn.disabled = false;
        } else if (senha.match(regExpMedia)) {
            forca.textContent = "Senha Média";
            forca.className = "senha-media";
            submitBtn.disabled = false;
        } else if (senha.match(regExpFraca)) {
            forca.textContent = "Senha Fraca";
            forca.className = "senha-fraca";
            submitBtn.disabled = true;
        } else {
            forca.textContent = "Senha muito fraca";
            forca.className = "senha-fraca";
            submitBtn.disabled = true;
        }
    });
</script>

<?= $this->endSection() ?>
