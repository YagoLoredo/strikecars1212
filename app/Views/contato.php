<?= $this->extend("templates/layoutSite"); ?>

<?= $this->section("conteudo") ?>

<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <!-- Contact Information Section -->
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">
                <!-- Page Title -->
                <div class="text-center">
                  <h1 style="color: gray;">Contato</h1>
                  <p class="mb-4">Entre em contato conosco, estamos à disposição para ajudá-lo!</p>
                </div>

                <!-- Contact Information -->
                <div class="media contact-info mt-4">
                  <span class="contact-info__icon"><i class="ti-home"></i></span>
                  <div class="media-body">
                    <h4>Muriaé-MG</h4>
                    <p>Av. Altino Rodrigues Pereira, 01 - José Cirilo</p>
                  </div>
                </div>
                <div class="media contact-info mt-4">
                  <span class="contact-info__icon"><i class="ti-headphone"></i></span>
                  <div class="media-body">
                    <h4><a href="tel:+553237210001">+55 (32) 3721-0001</a></h4>
                    <p>De segunda a sexta das 8 às 18 horas</p>
                  </div>
                </div>
                <div class="media contact-info mt-4">
                  <span class="contact-info__icon"><i class="ti-email"></i></span>
                  <div class="media-body">
                    <h4><a href="mailto:strikecars25@gmail.com">strikecars25@gmail.com</a></h4>
                    <p>Envie-nos uma mensagem a qualquer momento!</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Contact Form Section -->
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="card-body p-md-5 mx-md-4">
                <h4 class="text-white mb-4">Envie sua Mensagem</h4>
                
                <!-- Contact Form -->
                <form action="<?= base_url() ?>/contatoEnviaEmail" method="POST" id="contactForm">
                  <div class="form-outline mb-4">
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Seu nome" required maxlength="60" value="<?= set_value("nome") ?>" />
                    <?= setaMsgErrorCampo("nome", $errors) ?>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="text" id="celular" name="celular" class="form-control" placeholder="Seu telefone para contato" required value="<?= set_value("celular") ?>" />
                    <?= setaMsgErrorCampo("celular", $errors) ?>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Seu e-mail" required value="<?= set_value("email") ?>" />
                    <?= setaMsgErrorCampo("email", $errors) ?>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="text" id="assunto" name="assunto" class="form-control" placeholder="Resumo do assunto" required value="<?= set_value("assunto") ?>" />
                    <?= setaMsgErrorCampo("assunto", $errors) ?>
                  </div>

                  <div class="form-outline mb-4">
                    <textarea id="mensagem" name="mensagem" class="form-control" rows="5" placeholder="Descreva o motivo do seu contato" required><?= set_value("mensagem") ?></textarea>
                    <?= setaMsgErrorCampo("mensagem", $errors) ?>
                  </div>

                  <!-- Success and Error Messages -->
                  <div class="col-md-12 form-group">
                    <?= mensagemSucesso() ?>
                    <?= mensagemError() ?>
                  </div>

                  <!-- Submit Button -->
                  <div class="text-center pt-1 mb-5 pb-1">
                    <button type="submit" class="btn btn-primary btn-block gradient-custom-2 mb-3">Enviar Mensagem</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
