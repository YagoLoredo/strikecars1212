<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VeiculoImagemModel;
use App\Models\VeiculoModel;
use App\Models\MarcaModel;

class Veiculo extends BaseController
{
    protected $VeiculoModel;
    protected $VeiculoImagemModel;

    /**
     * Método construstutor
     */
    public function __construct()
    {
        $this->VeiculoModel = new VeiculoModel();
        $this->VeiculoImagemModel = new VeiculoImagemModel();
    }

    /**
     * Carrega view com a lista Veiculos
     *
     * @return void
     */
    public function index()
    {
        $data['data'] = $this->VeiculoModel->getListaVeiculo();
        $data["pages"] = $this->VeiculoModel->pager;

        return view('admin/listaVeiculo', $data);
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

        $MarcaModel  = new MarcaModel();

        $this->dados['aMarca']   = $MarcaModel->where("statusRegistro", 1)->orderBy('descricao')->findAll();

        if ($action != 'new') {
            $this->dados['data']    = $this->VeiculoModel->find($id);
            $this->dados['aAnexo']  = $this->VeiculoImagemModel->where('veiculo_id', $id)->orderBy('nomeArquivo')->findAll();

            if (empty($this->dados['data'])) {
                throw new \CodeIgniter\Database\Exceptions\DatabaseException("Registro não localizado na base de dados (" . $id .  ")");
            }
        } else {
            $this->dados['data'] = [
                "statusRegistro" => 1
            ];
        }

        return view("admin/formVeiculo", $this->dados);
    }






    /**
     * store
     *
     * @return void
     */
    public function store()
    {
        $post       = $this->request->getPost();
        $aImagens   = $this->request->getFiles();
        $aAnexo     = [];

        $MarcaModel = new MarcaModel();

        foreach($aImagens['imagem'] as $arq) {
            if (!empty($arq->getClientName())) {
                if (($arq->isValid()) && !($arq->hasMoved())) {
                    $extArquivo = $arq->guessExtension();
                    if (array_search($extArquivo, array('bmp', 'png', 'jpg', 'jpeg', 'gif', 'webp')) === false) {
                        session()->setFlashData("msgError", "Extensão de arquivo não permitida ({$extArquivo}).");

                        if ($post['action'] != 'new') {
                            $aAnexo = $this->VeiculoImagemModel->where('veiculo_id', $post['id'])->orderBy('nomeArquivo')->findAll();
                        }

                        return view("admin/formVeiculo" , [
                            'action'        => $post['action'],
                            'data'          => $post,
                            'aMarca'        => $MarcaModel->where("statusRegistro", 1)->orderBy('descricao')->findAll(),
                            'aAnexo'        => $aAnexo,
                            'errors'        => []
                        ]);
                    }
                } else {
                    throw new \RuntimeException($arq->getErrorString().'('.$arq->getError().')');
                }
            }
        }

        if ($this->VeiculoModel->save([
            'id'                => $post['id'],
            'modelo'             => $post['modelo'],
            "detalhamento"      => $post['detalhamento'],
            "marca_id"          => $post['marca_id'],
            "precoVenda"        => strToNumer($post['precoVenda']),
            'statusRegistro'    => $post['statusRegistro'],
            "placa"             => $post['placa'],
            "anoFabricacao"     => strToNumer($post['anoFabricacao']),
            "cor"               => $post['cor']
        ])) {

            if ($post['action'] == "new") {
                $veiculo_id = $this->VeiculoModel->getInsertID();
            } else {
                $veiculo_id = $post['id'];
            }

            foreach($aImagens['imagem'] as $arq) {
                if (!empty($arq->getClientName())) {
                    $VeiculoImagemModel = new VeiculoImagemModel();

                    $nomeFinal  = $arq->getRandomName();
                    $arq->move(ROOTPATH .'public/uploads/veiculo/', $nomeFinal);

                    $VeiculoImagemModel->insertImagem([ 
                        'NomeArquivo'   => $nomeFinal, 
                        'veiculo_id'    => $veiculo_id
                    ]);
                }
            }

            return redirect()->to("/Veiculo")->with('msgSucess', 'Dados atualizados com sucesso.');
        } else {
            if ($post['action'] != 'new') {
                $aAnexo = $this->VeiculoImagemModel->where('veiculo_id', $post['id'])->orderBy('nomeArquivo')->findAll();
            }

            return view("admin/formVeiculo" , [
                'action'        => $post['action'],
                'data'          => $post,
                'aMarca'        => $MarcaModel->where("statusRegistro", 1)->orderBy('descricao')->findAll(),
                'aAnexo'        => $aAnexo,
                'errors'        => $this->VeiculoModel->errors()
            ]);
        }
    }

    /**
     * delete
     *
     * @return void
     */
    public function delete()
    {
        if ($this->VeiculoModel->deleteVeiculo($this->request->getPost('id'))) {
            return redirect()->to("/Veiculo")->with('msgSucess', "Dados excluídos com sucesso.");
        } else {
            return redirect()->to('/Veiculo')->with('msgError', 'Erro ao tentar excluír os dados.');
        }
    }

    /**
     * excluirImagem
     *
     * @param integer $id 
     * @param string $nomeAnexo 
     * @return void
     */
    public function excluirImagem($id, $action, $nomeAnexo)
    {
        $VeiculoImagemModel = new VeiculoImagemModel();

        if ($VeiculoImagemModel->deleteVeiculoImagem($id, $nomeAnexo)) {
            return redirect()->to("/Veiculo/form/" . $action . "/" . $id)->with('msgSucess', "Dados excluídos com sucesso.");
        } else {
            return redirect()->to("/Veiculo/form/" . $action . "/" . $id)->with('msgError', 'Erro ao tentar excluír os dados.');
        }
    }
}
