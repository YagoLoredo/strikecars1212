<?php 

    $this->extend('templates/layoutSite');
    $this->section('conteudo');

    ?>

    <?= exibeTitulo("Cidade", ['acao' => 'new']) ?>
    
    <div class="table-responsive table_custom corsim">
    <table class="table table-hover table-bordered table-striped table-sm" id="tbListaCidade">
            <thead>
                <tr class="text-weight-bold">
                    <td>Nome</td>
                    <td>UF</td>
                    <td>Código IBGE</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $value): ?>
                    <tr>
                        <td><?= $value['nome'] ?></td>
                        <td><?= $value['ufSigla'] ?></td>
                        <td><?= $value['codIBGE'] ?></td>
                        <td>
                            <a href="<?= base_url() ?>/Cidade/form/view/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>    
                            <a href="<?= base_url() ?>/Cidade/form/update/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Alterar"><i class="fa fa-file" aria-hidden="true"></i></a>    
                            <a href="<?= base_url() ?>/Cidade/form/delete/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Excluir"><i class="fa fa-trash" aria-hidden="true"></i></a>                               
                        </td>
                    </tr>
                <?php endforeach; ?>                
            </tbody>
        </table>
    </div>

    <?= getDataTables("tbListaCidade") ?>

<?= $this->endSection() ?>