<?php

namespace App\Controllers;

use App\Models\PedidoItemModel;
use App\Models\PedidoModel;
use App\Models\PessoaEnderecoModel;

class Pedido extends BaseController
{
    /**
     * construct
     */
    public function __construct()
    {
        $this->model = new PedidoModel();
    }

    /**
     * index (lista)
     *
     * @return void
     */
    public function index()
    {
        $this->dados['data'] = $this->model->getLista([], 'id DESC');

        return view("admin/listaPedido", $this->dados);
    }

    /**
     * form
     *
     * @param integer $id 
     * @param string $action 
     * @return void
     */
    public function confirmar($id)
    {
        $pedidoModel = new PedidoModel();
        $pedidoItemModel = new PedidoItemModel();
        $veiculoModel = new VeiculoModel();

        $itensPedido = $pedidoItemModel->where('pedido_id', $id)->findAll();

        foreach ($itensPedido as $item) {
            $veiculo = $veiculoModel->find($item['veiculo_id']);

            if ($veiculo && $veiculo->quantidade >= $item['quantidade']) {
                $novaQuantidade = $veiculo->quantidade - $item['quantidade'];
                $veiculoModel->update($veiculo->id, ['quantidade' => $novaQuantidade]);
            } else {
                return redirect()->to('/pedidos')->with('msgError', 'Estoque insuficiente para o pedido!');
            }
        }

        $pedidoModel->update($id, ['status' => 'confirmado']);

        return redirect()->to('/pedidos')->with('msgSuccess', 'Pedido confirmado e estoque atualizado com sucesso!');
    }
   
    public function viewPedido($pedido_id = 0)
    {
		$PedidoModel = new PedidoModel();
		$PedidoItemModel = new PedidoItemModel();
		$PessoaEnderecoModel = new PessoaEnderecoModel();

        $this->dados['origem'] 		= "view";
        $this->dados['aPedido'] 	= $PedidoModel->where('id', $pedido_id)->first();
        $this->dados['aPedidoItem'] = $PedidoItemModel
                                            ->select("pedidoitem.*, veiculo.modelo")
                                            ->join("veiculo", "veiculo.id = pedidoitem.veiculo_id")
                                            ->where('pedido_id', $pedido_id)
                                            ->findAll();
        
        $this->dados['aEnderecoCob'] = $PessoaEnderecoModel
                                                ->select("pessoaendereco.*, cidade.nome as cidade, uf.sigla as uf")
                                                ->join("cidade", "cidade.id = pessoaendereco.cidade_id")
                                                ->join("uf", "uf.id = cidade.uf_id")
                                                ->where(['tipoEndereco' => 1,'pessoaendereco.id'=> $this->dados['aPedido']['pessoaendereco_id']])
                                                ->first();

        $this->dados['aEnderecoEnt'] = $PessoaEnderecoModel
                                                ->select("pessoaendereco.*, cidade.nome as cidade, uf.sigla as uf")
                                                ->join("cidade", "cidade.id = pessoaendereco.cidade_id")
                                                ->join("uf", "uf.id = cidade.uf_id")
                                                ->where('pessoaendereco.id', $this->dados['aPedido']['pessoaendereco_id'])
                                                ->first();

        return view('carrinho-confirmacao', $this->dados);


    }   
}