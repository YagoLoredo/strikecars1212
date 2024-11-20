<?php 

$this->extend('templates/layoutSite');
$this->section('conteudo');

?>

<?= exibeTitulo("Meus Pedidos", ["controller" => "Pedido", "acao" => "view"]) ?>

<div class="table-responsive table_custom corsim">
    <table class="table table-hover table-bordered table-striped table-sm" id="tbListaPessoaEndereco">
        <thead>
            <tr class="text-weight-bold">
                <td>id</td>
                <td>Data Compra</td>
                <td>Hora Compra</td>
                <td>Valor Produtos</td>
                <td>Valor Frete</td>
                <td>Valor Total</td>
                <td>Tipo Frete</td>
                <td>Forma Pagamento</td>
                <td>Opções</td>
            </tr>
        </thead>
        <tbody>
        <?php 
                $usuarioLogadoId = session()->get('userPessoa_id'); 
                $usuarioNivel = session()->get('userNivel'); 
                foreach ($data as $value): 
                    if ($usuarioNivel == 1 || $value['pessoa_id'] == $usuarioLogadoId): 
            ?>                   
                <tr>
                    <td class="text-center"><?= $value['id'] ?></td>                    
                    <td class="text-center"><?= date("d/m/Y", strtotime($value['created_at'])) ?></td>
                    <td class="text-center"><?= date("H:i:s", strtotime($value['created_at'])) ?></td>
                    <td class="text-right"><?= formatValor($value['valorProdutos']) ?></td>
                    <td class="text-right"><?= formatValor($value['valorFrete']) ?></td>
                    <td class="text-right"><?= formatValor($value['valorTotal']) ?></td>
                    <td class="text-center"><?= ($value['tipoFrete'] == 1 ? "Grátis" : "SEDEX") ?></td>
                    <td class="text-center"><?= ($value['formaPagamento'] == 1 ? "Boleto" : "PIX") ?></td>
                    <td>
                        <a href="<?= base_url() ?>Pedido/viewPedido/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    </td>
                </tr>                
            <?php
        endif;
        endforeach; ?>                
        </tbody>
    </table>
</div>

<?= getDataTables("tbListaPessoaEndereco") ?>

<?= $this->endSection() ?>
