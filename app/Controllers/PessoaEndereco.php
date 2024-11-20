<?php

namespace App\Controllers;

use App\Models\CidadeModel;
use App\Models\PessoaEnderecoModel;
use App\Models\UfModel;

class PessoaEndereco extends BaseController
{
    /**
     * construct
     */
    public function __construct()
    {
        $this->model = new PessoaEnderecoModel();
    }

    /**
     * index (lista)
     *
     * @return void
     */
    public function index()
    {
        $this->dados['data'] = $this->model->getListaEndereco();

        return view("admin/listaPessoaEndereco", $this->dados);
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
        $UfModel = new UfModel();
        $CidadeModel = new CidadeModel();

        $this->dados['action']  = $action;
        $this->dados['aUfs']    = $UfModel->orderBy('sigla')->findAll();
        $this->dados['aCidade'] = [];

        if ($action != "new") {
            $this->dados['data']    = $this->model->getByPessoaEndereco($id);
            $this->dados['aCidade'] = $CidadeModel->where("uf_id", $this->dados['data']['uf_id'])->orderBy('nome')->findAll();
        }

        return view("admin/formPessoaEndereco", $this->dados);
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
            "id"    	    =>  $post['id'],
            "pessoa_id"     =>  session()->get('userPessoa_id'),
            "tipoEndereco"  =>  $post['tipoEndereco'],
            "logradouro" 	=>  $post['logradouro'],
            "numero"        =>  $post['numero'],
            "complemento"   =>  $post['complemento'],
            "bairro"        =>  $post['bairro'],
            "cep"           =>  $post['cep'],
            "cidade_id"     =>  $post['cidade_id'],
        ])) {

            return redirect()->to('PessoaEndereco')->with('msgSucess', 'Dados Atualizado com Sucesso !');

        } else {

            return view('admin/formPessoaEndereco', [
                'action'	=> $post['action'],
                'data'		=> $post,
                'errors' => $this->model->errors()
            ]);

        }
    }
}