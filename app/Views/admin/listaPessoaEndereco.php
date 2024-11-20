<?php 

    $this->extend('templates/layoutSite');
    $this->section('conteudo');

    ?>

<?= exibeTitulo("Meus Endereços", ["controller" => "PessoaEndereco", "acao" => "new"]) ?>    
    <div class="table-responsive table_custom corsim">
        <table class="table table-hover table-bordered table-striped table-sm" id="tbListaPessoaEndereco">
            <thead>
                <tr class="text-weight-bold">
                    <td>Tipo</td>
                    <td>Logradouro</td>
                    <td>Número</td>
                    <td>Complemento</td>
                    <td>Bairro</td>
                    <td>Cidade</td>
                    <td>UF</td>
                    <td>CEP</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $value): ?>
                    <tr>
                        <td><?= mostraTipoEndereco($value['tipoEndereco']) ?></td>                    
                        <td><?= $value['logradouro'] ?></td>
                        <td><?= $value['numero'] ?></td>
                        <td><?= $value['complemento'] ?></td>
                        <td><?= $value['bairro'] ?></td>
                        <td><?= $value['cidade'] ?></td>
                        <td><?= $value['uf'] ?></td>
                        <td><?= $value['cep'] ?></td>
                        <td>
                            <a href="<?= base_url() ?>PessoaEndereco/form/view/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="<?= base_url() ?>PessoaEndereco/form/update/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Alterar"><i class="fa fa-file" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>                
            </tbody>
        </table>
    </div>

<?= getDataTables("tbListaPessoaEndereco") ?>

<?= $this->endSection() ?>