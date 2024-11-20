<?php

namespace App\Controllers;

use App\Models\CidadeModel;
use App\Models\UfModel;


class Cidade extends BaseController
{
    /**
     * construct
     */
    public function __construct()
    {
        $this->model = new CidadeModel();

        helper("cidade");
    }
    public function getLista(array $filtros = [], string $ordem = 'nome')
    {
        $builder = $this->select('cidade.*, uf.sigla AS uf_sigla')
                        ->join('uf', 'uf.id = cidade.uf_id');

        // Adicionar filtros (se houver)
        if (!empty($filtros)) {
            $builder->where($filtros);
        }

        // Definir a ordem
        $builder->orderBy($ordem);

        // Retornar os dados como arrays
        return $builder->findAll();
    }
    /**
     * index (lista)
     *
     * @return void
     */
    public function index()
    {
        $this->dados['data'] = $this->model->getLista([], 'nome');
        
        $UfModel = new UfModel();
        foreach ($this->dados['data'] as &$cidade) {
            $uf = $UfModel->getById($cidade['uf_id']);
            $cidade['ufSigla'] = $uf['sigla'];
        }
    
        return view("admin/listaCidade", $this->dados);
    }
    

    /**
     * form
     *
     * @param integer $id 
     * @param string $action 
     * @return void
     */
    public function form($action, $id = 0)
    {
        $this->dados['action'] = $action;

        if ($action != "new") {
            $this->dados['data'] = $this->model->getById($id);
        }
        $UfModel = new UfModel();
        $this->dados['aUf'] = $UfModel->getAll();

        return view("admin/formCidade", $this->dados);
    }

    /**
     * store
     *
     * @return void
     */
    public function store()
    {
        $post = $this->request->getPost();

        if ($this->model->save([
            "id"    	=>  $post['id'],
            "nome" 	=>  $post['nome'],
            "codIBGE"   =>  $post['codIBGE'],
            "uf_id"     => $post['uf_id']

        ])) {

            return redirect()->to('/Cidade')->with('msgSucess', 'Dados Atualizado com Sucesso !');

        } else {

            return view('admin/formCidade', [
                'action'    => $post['action'],
                'data'      => $post,
                'errors'    => $this->model->errors(),
                'aUf'       => (new UFModel())->getAll() 
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
        if ($this->model->delete($this->request->getPost('id')) ) {
			return redirect()->to('/Cidade')->with('msgSucess', 'Dados Excluídos com Sucesso.');

		} else {
			return redirect()->to('/Cidade')->with('msgError', 'Erro ao Tentar Exluir Dados.');
		}
    }
}