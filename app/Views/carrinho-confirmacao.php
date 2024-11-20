<?= $this->extend("templates/layoutSite"); ?>

<?= $this->section("conteudo") ?>

<section>
    <div class="container">
        <div class="blog-banner">
            <div class="mt-5 mb-5 text-left">
                <h1 style="color: #384aeb;">Confirmação da Compra</h1>
            </div>
        </div>
    </div>
</section>
<section class="order_details section-margin--small">
    <div class="container">
        <?php if ($origem != "view"): ?>
            <p class="text-center billing-alert">Obrigado. Seu pedido foi recebido.</p>
        <?php endif; ?>

        <div class="row mb-3">
            <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                <div class="confirmation-card">
                    <h3 class="billing-title">Informações do Pedido</h3>
                    <table class="order-rable">
                        <tr>
                            <td>Número do Pedido</td>
                            <td>: <?= $aPedido['id'] ?></td>
                        </tr>
                        <tr>
                            <td>Data</td>
                            <td>: <?= date( "d/m/Y H:m:i", strtotime($aPedido['created_at'])) ?></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>: R$ <?= formatValor($aPedido['valorTotal']) ?></td>
                        </tr>
                        <tr>
                            <td>Forma de Pagamento</td>
                            <td>: <?= ($aPedido['formaPagamento'] == 1 ? 'Boleto' : 'PIX') ?></td>

                        </tr>
                    </table>
                </div>
            </div>

            <!-- Exibe Endereço de Cobrança somente se for diferente do de Entrega -->
            <?php if ($aEnderecoCob != $aEnderecoEnt): ?>
            <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                <div class="confirmation-card">
                    <h3 class="billing-title">Endereço de Cobrança</h3>
                    <table class="order-rable">
                        <tr>
                            <td>Logradouro</td>
                            <td>:
                                <?php  
                                echo isset($aEnderecoCob['logradouro']) ? trim($aEnderecoCob['logradouro']) : '';
                                echo isset($aEnderecoCob['numero']) && trim($aEnderecoCob['numero']) != "" ? ", " . trim($aEnderecoCob['numero']) : "";
                                echo isset($aEnderecoCob['complemento']) && trim($aEnderecoCob['complemento']) != "" ? ", " . trim($aEnderecoCob['complemento']) : "";
                                echo isset($aEnderecoCob['bairro']) && trim($aEnderecoCob['bairro']) != "" ? " - " . trim($aEnderecoCob['bairro']) : "";
                                ?>
</td>

                        </tr>
                        <tr>
                            <td>Cidade</td>
                            <td>: <?= isset($aEnderecoCob['cidade']) ? $aEnderecoCob['cidade'] : 'N/A' ?></td>
                            </tr>
                        <tr>
                            <td>UF</td>
                            <td>: <?= isset($aEnderecoCob['uf']) ? $aEnderecoCob['uf'] : 'N/A' ?></td>
                            </tr>
                        <tr>
                            <td>CEP</td>
                            <td>: <?= isset($aEnderecoCob['cep']) ? $aEnderecoCob['cep'] : 'N/A' ?></td>
                            </tr>
                    </table>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($aEnderecoCob != $aEnderecoEnt): ?>
            <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                <div class="confirmation-card">
                    <h3 class="billing-title">Endereço de Entrega</h3>
                    <table class="order-rable">
                        <tr>
                            <td>Logradouro</td>
                            <td>: 
                                <?php 
                                    echo trim($aEnderecoEnt['logradouro']) . 
                                        (trim($aEnderecoEnt['numero']) != "" ? ", " . trim($aEnderecoEnt['numero']) : "") .
                                        (trim($aEnderecoEnt['complemento']) != "" ? ", " . trim($aEnderecoEnt['complemento']) : "") . 
                                        (trim($aEnderecoEnt['bairro']) != "" ? " - " . trim($aEnderecoEnt['bairro']) : "");
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Cidade</td>
                            <td>: <?= $aEnderecoEnt['cidade'] ?></td>
                        </tr>
                        <tr>
                            <td>UF</td>
                            <td>: <?= $aEnderecoEnt['uf'] ?></td>
                        </tr>
                        <tr>
                            <td>CEP</td>
                            <td>: <?= $aEnderecoEnt['cep'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php endif; ?>

        </div>

        <!-- Detalhes do Pedido -->
        <div class="order_details_table">
            <h2>Detalhes do Pedido</h2>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead class="border-bottom">
                        <tr>
                            <th scope="col">Produto</th>
                            <th scope="col">Qtde</th>
                            <th scope="col" class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($aPedidoItem as $item): ?>
                            <tr>
                                <td><?= $item['modelo'] ?></td>
                                <td>x <?= $item['quantidade'] ?></td>
                                <td class="text-right">R$ <?= formatValor($item['valorTotal']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Subtotal</th>
                            <td class="text-right">R$ <?= formatValor($aPedido['valorProdutos']) ?></td>
                        </tr>
                        <tr>
                            <th colspan="2">Frete <span><?= ($aPedido['tipoFrete'] == 1 ? 'grátis' : 'SEDEX' ) ?>: R$ <?= formatValor($aPedido['valorFrete']) ?></span></th>
                            <td class="text-right">R$ <?= formatValor($aPedido['valorFrete']) ?></td>
                        </tr>
                        <tr>
                            <th colspan="2">Total</th>
                            <td class="text-right">R$ <?= formatValor($aPedido['valorTotal']) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <?php if ($origem == "view"): ?>
        <a href="<?= base_url() ?>Pedido" class="button button-login ml-3 mt-3">Voltar</a>
    <?php endif; ?>
</section>

<?= $this->endSection() ?>