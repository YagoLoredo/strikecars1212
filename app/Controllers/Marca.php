<?php

namespace App\Controllers;

use App\Models\MarcaModel;

class Marca extends BaseController
{
    public $MarcaModel;

    /**
     * construct
     */
    public function __construct()
    {
        $this->MarcaModel = new MarcaModel();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $this->dados['data'] = $this->MarcaModel
                            ->orderBy("descricao")
                            ->findAll();

        return view("admin/listaMarca", $this->dados);
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
            $this->dados['data'] = $this->MarcaModel->find($id);
        }

        return view("admin/formMarca", $this->dados);
    }

    /**
     * store
     *
     * @return void
     */
    public function store()
    {
        $post = $this->request->getPost();

        if ($this->MarcaModel->save([
            'id'                => ($post['id'] == "" ? null : $post['id']),
            "descricao"         => $post['descricao'],
            "statusRegistro"    => $post['statusRegistro']
        ])) {
            $this->MarcaModel->getMenuMarca();        // atualiza session de marcas do menu do web site
            return redirect()->to("/Marca")->with('msgSucess', "Dados atualizados com sucesso.");
        } else {
            return view("admin/formMarca", [
                "action"    => $post['action'],
                'data'      => $post,
                'errors'    => $this->MarcaModel->errors()
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
        if ($this->MarcaModel->delete($this->request->getPost('id'))) {
            $this->MarcaModel->getMenuMarca();        // atualiza session de marcas do menu do web site
            return redirect()->to('/Marca')->with('msgSucess', 'Dados excluídos com sucesso.');
        } else {
            return redirect()->to('/Marca')->with('msgError', 'Erro ao excluir dados.');
        }
    }
}
