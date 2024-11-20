<?= $this->extend("templates/layoutSite"); ?>

<?= $this->section("conteudo") ?>

<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <!-- Login Form Section -->
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <!-- Logo and Title -->
                <div class="text-center">
                  <img src="<?= base_url('assets/img/strikecars2a.png') ?>" style="width: 185px;" alt="Logo">
                  <h4 class="mt-1 mb-5 pb-1 time">Bem-vindo ao time Strike Cars</h4>
                </div>

                <!-- Login Form -->
                <form method="POST" action="<?= base_url() ?>/Login/signIn" id="contactForm">
                  <p>Por favor, entre na sua conta</p>

                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="text" id="email" name="email" class="form-control" placeholder="E-mail" value="<?= set_value('email') ?>" />
                    <label class="form-label" for="email">E-mail</label>
                  </div>

                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" id="senha" name="senha" class="form-control" />
                    <label class="form-label" for="senha">Senha</label>
                    <button class="btn-icone-senha" type="button" id="toggleSenha">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </button>

                  </div>

                  <!-- Checkbox "Lembrar de mim" -->
                  <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="lembrar" name="lembrar" />
                    <label class="form-check-label" for="lembrar">Lembrar de mim</label>
                  </div>

                  <!-- Success and Error Messages -->
                  <div class="col-md-12 form-group">
                    <?= mensagemSucesso() ?>
                    <?= mensagemError() ?>
                  </div>

                  <!-- Login Button -->
                  <div class="text-center pt-1 mb-5 pb-1">
                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Entrar</button>
                    <a class="text-muted" href="/trocarSenha">Esqueceu a senha?</a>
                  </div>

                  <!-- Sign Up Section -->
                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-1 me-0">Não tem uma conta?</p>
                    <a href="<?= base_url() ?>criarNovaConta" class="btn btn-outline-danger">Criar nova conta</a>
                  </div>
                </form>

              </div>
            </div>

            <!-- Side Information Section -->
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2 login">
              <div class="text-white px-10 py-10 p-md-5 mx-md-10 login">
                <h4 class="mb-5">Mais que uma empresa, somos uma equipe!</h4>
                <p class=" mb-0">Bem-vindo ao próximo nível de mobilidade! No Strike Cars, acreditamos que cada jornada é uma oportunidade de superação e descoberta. Faça login e continue sua trajetória rumo a novas conquistas com estilo e confiança. Vamos juntos!</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
    document.getElementById('toggleSenha').addEventListener('click', function () {
        var senhaInput = document.getElementById('senha');
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
</script>

<?= $this->endSection() ?>
