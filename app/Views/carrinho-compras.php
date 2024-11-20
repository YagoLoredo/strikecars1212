<?= $this->extend("templates/layoutSite"); ?>

<?= $this->section("conteudo") ?>

<section>
    <div class="container">
        <div class="blog-banner">
            <div class="mt-5 mb-5 text-left">
                <h1 style="color: #384aeb;">Carrinho de compras</h1>
            </div>
        </div>
    </div>
</section>

<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Veículo</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Quantidade</th>
                            <th style="width: 118px !important" scope="col">Total</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $aCarrinho = session()->get("Carrinho");
                            $aCarrinhoItens = session()->get("CarrinhoItens");
                            $subTotal = 0;
                            $totalFinal = 0;
                            $tipoFrete = 0;

                            if (!is_null($aCarrinho)) {
                                if (isset($aCarrinho['tipoFrete']) && $aCarrinho['tipoFrete'] == 1) {
                                    $tipoFrete = 1;
                                } elseif (isset($aCarrinho['tipoFrete']) && $aCarrinho['tipoFrete'] == 2) {
                                    $tipoFrete = 2;
                                    $totalFinal = 15;
                                }
                            }

                            if (is_null($aCarrinhoItens)) {
                                $aCarrinhoItens = [];
                            }

                            if (count($aCarrinhoItens) == 0) {
                                ?>
                                <tr>
                                    <td colspan="5">
                                        <p class="text-center">Seu carrinho está vazio!</p>
                                    </td>
                                </tr>
                                <?php
                            } else {
                                foreach ($aCarrinhoItens as $veiculo) {
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img src="<?= base_url('uploads/veiculo/' . $veiculo['imagem']) ?>" style="width: 100px; height: 100px" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <p><?= $veiculo['modelo'] ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h5>R$ <?= formatValor($veiculo['valorUnitario']) ?></h5>
                                        </td>
                                        <td>
                                            <div class="product_count">
                                                <input type="text" name="quantidade_<?= $veiculo['veiculo_id'] ?>" id="quantidade_<?= $veiculo['veiculo_id'] ?>" maxlength="12" value="<?= formatValor($veiculo['quantidade'], 0) ?>" title="Quantidade"
                                                    class="input-text qty">
                                                <button onclick="atualizaQuantidade(1, <?= $veiculo['veiculo_id'] ?>, <?= $veiculo['valorUnitario'] ?>)" class="increase items-count" type="button"><i class="ti ti-angle-up"></i></button>
                                                <button onclick="atualizaQuantidade(0, <?= $veiculo['veiculo_id'] ?>, <?= $veiculo['valorUnitario'] ?>)" class="reduced items-count" type="button"><i class="ti ti-angle-down"></i></button>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 id="totalItem_<?= $veiculo['veiculo_id'] ?>">R$ <?= formatValor($veiculo['valorTotal']) ?></h5>
                                        </td>
                                        <td>
                                            <button onclick="atualizaQuantidade(0, <?= $veiculo['veiculo_id'] ?>)" class="btn btn-danger btn-sm">Remover</button>
                                        </td>
                                    </tr>
                                    <?php
                                    $subTotal += $veiculo['valorTotal'];
                                    $totalFinal += $veiculo['valorTotal'];
                                }
                            }
                        ?>

                        <tr>
                            <td></td>
                            <td></td>
                            <td><h5>Subtotal</h5></td>
                            <td style="width: 150px !important;"><h5 id="subTotal">R$ <?= formatValor($subTotal) ?></h5></td>
                            <td></td>
                        </tr>
                        <tr class="shipping_area">
                            <td class="d-none d-md-block"></td>
                            <td></td>
                            <td><h5>Frete</h5></td>
                            <td>
                                <div class="shipping_box">
                                    <ul class="list">
                                        <li id="tipoFrete1" <?= ($tipoFrete == 1 ? 'class="active"' : '') ?>><a onclick="selecionaFrete(1)">Frete grátis</a></li>
                                        <li id="tipoFrete2" <?= ($tipoFrete == 2 ? 'class="active"' : '') ?>><a onclick="selecionaFrete(2)">SEDEX: R$ 15,00</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td><h5>Total</h5></td>
                            <td style="width: 150px !important;"><h5 id="totalFinal">R$ <?= formatValor($totalFinal) ?></h5></td>
                            <td></td>
                        </tr>

                        <tr class="out_button_area">
                            <td class="d-none-l"></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="checkout_btn_inner d-flex align-items-center">
                                    <a class="gray_btn" href="index.php">Continue comprando</a>
                                    <a id="btnPagamento" class="primary-btn ml-2 <?= ($tipoFrete == 0 ? 'disabled' : '') ?>" href="<?= base_url() ?>carrinhoPagamento">Pagamento</a>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    function atualizaQuantidade(tipo, veiculo_id, valorUnitario) {
        var quantidade  = document.getElementById('quantidade_' + parseInt(veiculo_id));
        var subTotal    = parseFloat(document.getElementById('subTotal').innerHTML.replaceAll(".", "").replaceAll(",",".").replaceAll("R$ ", ""));
        var totalFinal  = parseFloat(document.getElementById('totalFinal').innerHTML.replaceAll(".", "").replaceAll(",",".").replaceAll("R$ ", ""));
        var baseURL = location.protocol + "//" + location.hostname;

        if (tipo == 0) {
            quantidade.value = parseFloat(quantidade.value) - 1;
            subTotal -= valorUnitario;
            totalFinal -= valorUnitario;
        } else {
            quantidade.value = parseFloat(quantidade.value) + 1;
            subTotal += valorUnitario;
            totalFinal += valorUnitario;
        }

        itemValorTotal = quantidade.value * valorUnitario;
        
        document.getElementById('totalItem_' + parseInt(veiculo_id)).innerHTML = "R$ " + itemValorTotal.toLocaleString('pt-br',{minimumFractionDigits: 2, maximumFractionDigits: 2});
        document.getElementById('subTotal').innerHTML = "R$ " + subTotal.toLocaleString('pt-br',{minimumFractionDigits: 2, maximumFractionDigits: 2});
        document.getElementById('totalFinal').innerHTML = "R$ " + totalFinal.toLocaleString('pt-br',{minimumFractionDigits: 2, maximumFractionDigits: 2});

        $.ajax({
            method: "POST",
            url: "<?= base_url() ?>atualizaVeiculoCarrinho",
            data: {"veiculo_id": veiculo_id, "quantidade": quantidade.value},
            success: function(data) {}
        });

        if ((subTotal == 0) || (quantidade.value == 0)) {
            window.location.href = baseURL + '/carrinhoCompras';
        }
    }

    function removerItem(veiculo_id) {
        $.ajax({
            method: "POST",
            url: "<?= base_url() ?>removeVeiculoCarrinho",
            data: {"veiculo_id": veiculo_id},
            success: function(data) {
                window.location.reload();
            }
        });
    }

    function selecionaFrete(tipoFrete) {
    var totalFinal = parseFloat(document.getElementById('totalFinal').innerHTML.replaceAll(".", "").replaceAll(",", ".").replaceAll("R$ ", ""));

    if (tipoFrete == 1) { // Frete grátis
        if (document.getElementById('tipoFrete2').classList.contains('active')) {
            totalFinal -= 15; // Remove o valor do frete SEDEX
        }
        document.getElementById('tipoFrete1').className = "active";
        document.getElementById('tipoFrete2').className = "";
    } else if (tipoFrete == 2) { // Frete pago (SEDEX)
        if (!document.getElementById('tipoFrete2').classList.contains('active')) {
            totalFinal += 15; // Adiciona o valor do frete SEDEX
        }
        document.getElementById('tipoFrete1').className = "";
        document.getElementById('tipoFrete2').className = "active";
    }

    document.getElementById('totalFinal').innerHTML = "R$ " + totalFinal.toLocaleString('pt-br', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    document.getElementById('btnPagamento').className = "primary-btn ml-2";

    $.ajax({
        method: "POST",
        url: "<?= base_url() ?>atualizaFrete",
        data: { "tipoFrete": tipoFrete },
        success: function(data) {
            // Callback opcional
        }
    });
}

    
</script>

<?= $this->endSection() ?>
