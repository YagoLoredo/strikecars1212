<?= $this->extend("templates/layoutSite"); ?>

<?= $this->section("conteudo") ?>

<?php 
    $aCarrinho          = session()->get("Carrinho");
    $aCarrinhoItens     = session()->get("CarrinhoItens");
    $subTotal           = 0;
    $totalFinal         = 0;
    $tipoFrete          = 0;
    $formaPagamento     = 0;
    $aceitaTermos       = 0;
    $pessoaendereco_id  = 0;

    if (!is_null($aCarrinho)) {
        if ($aCarrinho['tipoFrete'] == 1) {
            $tipoFrete      = 1;
        } elseif ($aCarrinho['tipoFrete'] == 2) {
            $tipoFrete      = 2;
            $totalFinal     = 15;
        }        
    }

    if (isset($aCarrinho['formaPagamento'])) {
        $formaPagamento = $aCarrinho['formaPagamento'];
    } 

    if (isset($aCarrinho['aceitaTermos'])) {
        $aceitaTermos = $aCarrinho['aceitaTermos'];
    } 

    if (isset($aCarrinho['pessoaendereco_id'])) {
        $pessoaendereco_id = $aCarrinho['pessoaendereco_id'];
    } 

    if (is_null($aCarrinhoItens)) {
        $aCarrinhoItens = [];
    }
?>
<section>
    <div class="container">
        <div class="blog-banner">
            <div class="mt-5 mb-5 text-left">
                <h1 style="color: #384aeb;">Pagamento</h1>
            </div>
        </div>
    </div>
</section>
<section class="checkout_area section-margin--small">
    <div class="container">

        <?php if (session()->get('isLoggedIn') != true): ?>

            <div class="returning_customer">
                <div class="check_title">
                    <h2>Não tem cadastro? <a href="<?= base_url() ?>criarNovaConta">Clique aqui para cadastrar</a></h2>
                </div>
                <form class="row contact_form mt-1" action="<?= base_url() ?>Login/signIn" method="post" novalidate="novalidate">
                    <input type="hidden" name="destino" id="destino" value="carrinhoPagamento">
                    <div class="col-md-6 form-group p_star">
                        <input type="text" class="form-control" placeholder="E-mail*"
                            onfocus="this.placeholder=''" onblur="this.placeholder = 'E-mail*'" id="email" name="email">
                        <!-- <span class="placeholder" data-placeholder="Username or Email"></span> -->
                    </div>
                    <div class="col-md-6 form-group p_star">
                        <input type="password" class="form-control" placeholder="Senha*" onfocus="this.placeholder=''"
                            onblur="this.placeholder = 'Senha*'" id="senha" name="senha">
                        <!-- <span class="placeholder" data-placeholder="Password"></span> -->
                    </div>
                    <div class="col-md-12 form-group">
                        <button type="submit" value="submit" class="button button-login">Entrar</button>
                        <div class="creat_account">
                            <input type="checkbox" id="f-option" name="selector">
                            <label for="f-option">salvar login</label>
                        </div>
                        <a class="lost_pass" href="#">Esqueceu a senha?</a>
                    </div>
                </form>
            </div>

        <?php endif; ?>

        <div class="billing_details mt-5">
            <div class="row">
                <div class="col-lg-5">
                    <h3 class="mb-5">Endereço de Entrega</h3>

                    <input type="hidden" id="pessoaendereco_id" value="<?= $pessoaendereco_id ?>">

                    <?php
                        foreach ($aPessoaEndereco as $endereco) {
                            ?>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="endereco_<?= $endereco['id'] ?>" name="endereco" onclick="atualizaCarrinho(<?= $endereco['id'] ?>)" <?= ($pessoaendereco_id == $endereco['id'] ? 'checked' : '') ?>>
                                    <label for="endereco_<?= $endereco['id'] ?>">
                                        <?php
                                            echo $endereco['logradouro'] . 
                                                (trim($endereco['numero']) != "" ? ", " . trim($endereco['numero']) : "") .
                                                (trim($endereco['complemento']) != "" ? ", " . trim($endereco['complemento']) : "") . 
                                                (trim($endereco['bairro']) != "" ? " - " . trim($endereco['bairro']) : "") . 
                                                (trim($endereco['cidade']) != "" ? " - " . trim($endereco['cidade']) : "") . 
                                                (trim($endereco['uf']) != "" ? " - " . trim($endereco['uf']) : "") . 
                                                (trim($endereco['cep']) != "" ? " - " . trim($endereco['cep']) : "");
                                        ?>
                                    </label>
                                    <div class="check"></div>
                                </div>
                            </div>
                        <?php   
                        }
                    ?>
                </div>

                <div class="col-lg-7">
                    <div class="order_box">
                        
                        <h2>Resumo da Compra</h2>

                        <table class="table table-borderless">
                            <thead class="border-bottom">
                                <tr>
                                    <th scope="col">Veiculo</th>
                                    <th scope="col">Qtde</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                                     
                                    foreach ($aCarrinhoItens AS $veiculo) {
                                        ?>
                                        <tr>
                                            <td><?= $veiculo['modelo'] ?></td>
                                            <td>x <?= formatValor($veiculo['quantidade'], 0) ?></td>
                                            <td class="text-right">R$ <?= formatValor($veiculo['valorTotal']) ?></td>
                                        </tr>
                                        <?php

                                        $subTotal += $veiculo['valorTotal'];
                                        $totalFinal += $veiculo['valorTotal'];
                                    }
                                ?>
                            </tbody>

                            <tfoot class="border-top">
                                <tr>
                                    <th colspan="2">Subtotal</th>
                                    <td class="text-right">R$ <?= formatValor($subTotal) ?></td>
                                </tr>
                                <tr>
                                    <th colspan="2">Frete <span><?= ($tipoFrete == 1 ? 'grátis' : 'SEDEX')?></span></th>
                                    <td class="text-right">R$ <?= formatValor(($tipoFrete == 1 ? 0 : 15)) ?></td>
                                </tr>
                                <tr>
                                    <th colspan="2">Total</th>
                                    <td class="text-right">R$ <?= formatValor($totalFinal) ?></td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="payment_item">
                            <div class="radion_btn">
                                <input type="radio" id="f-option5" name="selector" value="1" onclick="atualizaCarrinho(0)" <?= ($formaPagamento == 1 ? 'checked' : '') ?>>
                                <label for="f-option5">Boleto</label>
                                <div class="check"></div>
                            </div>
                            <p class="text-center"><b>Codigo de barra: </b> 11111 33333 44453 2 2221 100000334</p>
                        </div>
                        <div class="payment_item">
                            <div class="radion_btn">
                                <input type="radio" id="f-option6" name="selector" value="2" onclick="atualizaCarrinho(0)" <?= ($formaPagamento == 2 ? 'checked' : '') ?>>
                                <label for="f-option6">Pix </label>
                                <div class="check"></div>
                            </div>
                            <p class="text-center"><b>Chave pix: </b>123.456.789-01</p>
                        </div>
                        <div class="creat_account">
                            <input type="checkbox" id="f-option4" name="selector" onclick="atualizaCarrinho(0)" <?= ($aceitaTermos == 1 ? 'checked' : '') ?>>
                            <label for="f-option4">Li e aceito os </label>
                            <a href="#" required>Termos e condições*</a>
                        </div>

                        <?php if (session()->get('isLoggedIn') == true): ?>
                            <div class="text-center">
                                <a id="btnPgamento" class="button button-paypal <?= ($aceitaTermos == 1 && $formaPagamento > 0 && $pessoaendereco_id > 0 ? '' : 'disabled') ?>" href="<?= base_url() ?>carrinhoConfirmacao">Confirmar
                                    Pagamento</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function atualizaCarrinho(endereco) {
        
        var formaPagamentoBoleto = document.getElementById('f-option5');
        var formaPagamentoPix = document.getElementById('f-option6');
        var termos = document.getElementById('f-option4');
        var pessoaendereco_id = document.getElementById("pessoaendereco_id").value;
        var formaPagamento = 0;
        var aceitaTermos = 0;

        if (formaPagamentoBoleto.checked == true) {
            formaPagamento = 1;
        } else if (formaPagamentoPix.checked == true) {
            formaPagamento = 2;
        } else {
            formaPagamento = 0;
        }

        if (termos.checked) {
            aceitaTermos = 1;
        }
        
        if (endereco > 0) {
            pessoaendereco_id = endereco;
        }

        if (aceitaTermos == 1 && formaPagamento > 0 && pessoaendereco_id > 0) {
            document.getElementById('btnPgamento').className = "button button-paypal";
        } else {
            document.getElementById('btnPgamento').className = "button button-paypal disabled";
        }

        $.ajax({
            method: "POST",
            url: "<?= base_url() ?>atualizaCarrinho",
            data: {"formaPagamento":formaPagamento, "aceitaTermos": aceitaTermos, "pessoaendereco_id": pessoaendereco_id},
            success: function(data) {
            }
        });
    }
</script>

<?= $this->endSection() ?>