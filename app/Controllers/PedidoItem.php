<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VeiculoImagemModel;
use App\Models\VeiculoModel;
use App\Models\MarcaModel;
use App\Models\PedidoItemModel;


class PedidoItem extends BaseController
{
    protected $PedidoItemModel;

    /**
     * Método construstutor
     */
    public function __construct()
    {
        $this->PedidoItemModel = new PedidoItemModel();
        $this->VeiculoModel = new VeiculoModel();

    }

    /**
     * Carrega view com a lista Estoque
     *
     * @return void
     */
    public function index()
    {
        $data['data'] = $this->PedidoItemModel->getListaPedidoItem();
        $data["pages"] = $this->PedidoItemModel->pager;

        return view('admin/listaPedidoItem', $data);
    }
    
    


    /**
     * form
     *
     * @param mixed $action 
     * @param mixed $id 
     * @return void
     */
    public function form($action = null, $id = null)
    {
        $this->dados['action'] = $action;
        $this->dados['data']   = null;
        $this->dados['aAnexo'] = [];

        $VeiculoModel  = new VeiculoModel();

        $this->dados['aVeiculo']   = $VeiculoModel->where("statusRegistro", 1)->orderBy('modelo')->findAll();

        if ($action != 'new') {
            $this->dados['data']    = $this->VeiculoModel->find($id);

            if (empty($this->dados['data'])) {
                throw new \CodeIgniter\Database\Exceptions\DatabaseException("Registro não localizado na base de dados (" . $id .  ")");
            }
        } else {
            $this->dados['data'] = [
                "statusRegistro" => 1
            ];
        }

        return view("admin/formPedidoItem", $this->dados);
    }






    /**
     * store
     *
     * @return void
     */
    public function store()
{
    $post = $this->request->getPost();
    $aAnexo = [];

    $PedidoItemModel = new PedidoItemModel(); // Modelo para a tabela pedido_item
    $VeiculoModel = new VeiculoModel(); // Modelo para a tabela veiculos

    // Início da transação
    $this->db->transStart();

    // Verifica se a quantidade enviada é válida
    $quantidade = $post['quantidade'];
    $veiculo_id = $post['veiculo_id'];

    // Recupera os dados do veículo
    $veiculo = $VeiculoModel->find($veiculo_id);

    // Verifica se a quantidade é maior que o estoque
    if ($quantidade > $veiculo['quantidade_estoque']) {
        return redirect()->to("/Pedido")->with('msgError', 'Estoque insuficiente para o veículo selecionado.');
    }

    // Cria um novo pedido_item
    $pedido_item_data = [
        'pedido_id' => $post['pedido_id'],  // A ID do pedido deve ser passada no POST
        'veiculo_id' => $veiculo_id,
        'quantidade' => $quantidade
    ];

    if ($PedidoItemModel->insert($pedido_item_data)) {
        $VeiculoModel->update($veiculo_id, [
            'quantidade_estoque' => $veiculo['quantidade_estoque'] - $quantidade
        ]);
    } else {
        // Caso ocorra algum erro ao inserir o pedido_item
        return redirect()->to("/PedidoItem")->with('msgError', 'Erro ao adicionar o item ao pedido.');
    }

    // Finaliza a transação
    $this->db->transComplete();

    if ($this->db->transStatus() === FALSE) {
        // Em caso de erro na transação
        return redirect()->to("/PedidoItem")->with('msgError', 'Erro ao salvar o pedido item!');
    }

    return redirect()->to("/PedidoItem")->with('msgSucess', 'Item adicionado ao pedido com sucesso.');
}

}
