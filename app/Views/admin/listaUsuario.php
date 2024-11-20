<?php 

$this->extend('templates/layoutSite');
$this->section('conteudo');

?>

<?= exibeTitulo("Meus Usuarios", ["controller" => "Usuario", "acao" => "view"]) ?>

<div class="table-responsive table_custom corsim ">
    <table class="table table-hover table-bordered table-striped table-sm" id="tdListaUsuario">
        <thead>
            <tr class="text-weight-bold">
                <td>Nome</td>
                <td>Status</td>
                <td>Email</td>
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
                <td><?= $value['nome'] ?></td>
                <td class="text-center"><?= mostraStatus($value['statusRegistro']) ?></td>
                <td><?=  $value['email'] ?></td>
                    <td>
                        
                    <a href="<?= base_url() ?>Usuario/form/view/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>  
                    <a href="<?= base_url() ?>Usuario/form/update/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Alterar"><i class="fa fa-file" aria-hidden="true"></i></a>    
                    <a href="<?= base_url() ?>Usuario/form/delete/<?= $value['id'] ?>" class="btn btn-secondary btn-sm btn-icons-crud" title="Excluir"><i class="fa fa-trash" aria-hidden="true"></i></a>                        
            </td>                 
                </tr>                
            <?php
        endif;
        endforeach; ?>                
        </tbody>
    </table>
</div>

<?= getDataTables("tdListaUsuario") ?>

<?= $this->endSection() ?>
