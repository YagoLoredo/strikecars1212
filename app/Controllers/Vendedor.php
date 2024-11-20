<?php

namespace App\Controllers;

use App\Models\VendedorModel;

class Vendedor extends BaseController
{
    public $VendedorModel;

    /**
     * construct
     */
    public function __construct()
    {
        $this->VendedorModel = new VendedorModel();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $this->dados['data'] = $this->VendedorModel
                            ->orderBy("nome")
                            ->findAll();

        return view("admin/listaVendedor", $this->dados);
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
        $this->dados['action']  = $action;
        $this->dados['data']    = null;
        $this->dados['errors']  = [];

        if ($action != "new") {
            $this->dados['data'] = $this->VendedorModel->find($id);
        }

        return view("admin/formVendedor", $this->dados);
    }

    /**
     * store
     *
     * @return void
     */
    public function store()
    {
        $post = $this->request->getPost();

        if ($this->VendedorModel->save([
            'id'                => ($post['id'] == "" ? null : $post['id']),
            "nome"              => $post['nome'],
            "cpf"               => $post['cpf'],
            "comissao"          => $post['comissao'],
            "statusRegistro"    => $post['statusRegistro']


        ])) {
            $this->VendedorModel->getMenuVendedor();        // atualiza session de vendedores do menu do web site
            return redirect()->to("/Vendedor")->with('msgSucess', "Dados atualizados com sucesso.");
        } else {
            return view("admin/formVendedor", [
                "action"    => $post['action'],
                'data'      => $post,
                'errors'    => $this->VendedorModel->errors()
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
        if ($this->VendedorModel->delete($this->request->getPost('id'))) {
            $this->VendedorModel->getMenuVendedor();        // atualiza session de vendedores do menu do web site
            return redirect()->to('/Vendedor')->with('msgSucess', 'Dados excluídos com sucesso.');
        } else {
            return redirect()->to('/Vendedor')->with('msgError', 'Erro ao excluir dados.');
        }
    }
    
    }
    

