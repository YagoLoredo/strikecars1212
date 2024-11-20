<?php
namespace App\Models;
class PedidoItemModel extends BaseModel
{
    protected $table = 'pedidoitem';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pedido_id', 'veiculo_id', 'quantidade', 'valorUnitario', 'valorTotal'];
    protected $useTimestamps = true;
}