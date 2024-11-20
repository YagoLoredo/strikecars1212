<?php

namespace App\Models;

class PedidoModel extends BaseModel
{
    protected $table = 'pedido';
    protected $primaryKey = 'id';

    protected $allowedFields = ['pessoa_id', 'valorProdutos', 'valorFrete', 'valorTotal'
                                , 'tipoFrete', 'formaPagamento', 'pessoaendereco_id', 'statusRegistro'];

    protected $useTimestamps = true;
    

    public function insertPedido($aPedido, $aPedidoItens, $aPedidoStatus)
    {
        $created_at = date("Y-m-d H:i:s");

        $aPedido['created_at']      = $created_at;
        $aPedido['updated_at']      = $created_at;

        $aPedidoStatus['created_at'] = $created_at;
        $aPedidoStatus['updated_at'] = $created_at;


        $db = \Config\Database::connect();

        $db->transBegin();      // Inicia controle de transação

        // insere a Empresa
        $tbPedido = $db->table("pedido");
        $tbPedido->insert($aPedido);

        $pedido_id = $db->insertID();

        if ($pedido_id > 0) {

            // Insere os Pedido itens

            foreach ($aPedidoItens as $item) {
                $item['pedido_id']  = $pedido_id;
                $item['created_at'] = $created_at;
                $item['updated_at'] = $created_at;
    
                $tbPedidoItem = $db->table("pedidoitem");
                $tbPedidoItem->insert($item);
            }

            // Insere Pedido status

            $aPedidoStatus['pedido_id'] = $pedido_id;

            $tbPedidoStatus = $db->table("pedidostatus");
            $tbPedidoStatus->insert($aPedidoStatus);

            //

            if ($db->transStatus() === FALSE) {
                $db->transRollback();               // Defaz o que foi feito na base de dados
                return 0;
            } else {
                $db->transCommit();                 // Confirmar a gravação dos dados na base dados
                return $pedido_id;
            }

        } else {
            $db->transRollback();                   // Defaz o que foi feito na base de dados
            return 0;           
        }
    }
}