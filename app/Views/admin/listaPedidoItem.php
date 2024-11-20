<?= $this->extend("templates/layoutSite"); ?>

<?= $this->section("conteudo") ?>

<div class="container">

    <?= exibeTitulo("Estoque", ["controller" => "Estoque", "acao" => "new"]) ?>
    <section class="login_box_area mb-5 corlista">
        <div class="table-responsive table_custom corsim">
            <table class="table table-hover table-bordered table-striped table-sm" id="tbListaVeiculo">
                <thead>
                    <tr class="text-weight-bold">
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Preço Venda</th>
                        <th>Status</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if (count($data) > 0): ?>

                        <?php foreach ($data as $value): ?>
                            <tr>                    
                                <td><?= $value['modelo'] ?></td>
                                <td><?= $value['marcaDescricao'] ?></td>
                                <td class="text-right"><?= formatValor($value['precoVenda']) ?></td>
                                <td class="text-center"><?= mostraStatus($value['statusRegistro']) ?></td>
                                <td>
                                    <a href="<?= base_url() ?>Veiculo/form/view/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>    
                                    <a href="<?= base_url() ?>Veiculo/form/update/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Alterar"><i class="fa fa-file" aria-hidden="true"></i></a>    
                                    <a href="<?= base_url() ?>Veiculo/form/delete/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Excluir"><i class="fa fa-trash" aria-hidden="true"></i></a>                               
                                </td>
                            </tr>
                            <?php endforeach; ?>

                    <?php else: ?>

                        <tr>                    
                            <td colspan="5">Nenhum Veiculo cadastrado</td>
                        </tr>

                    <?php endif; ?>

                </tbody>
            </table>            
        </div>
    </section>
</div>
<?= getDataTables("tbListaVeiculo") ?>

<?= $this->endSection() ?>
