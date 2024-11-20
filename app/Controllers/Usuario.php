<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuario extends BaseController
{
    public $UsuarioModel;

    /**
     * construct
     */
    public function __construct()
    {
        $this->UsuarioModel = new UsuarioModel();
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $this->dados['data'] = $this->UsuarioModel
                            ->orderBy("nome")
                            ->findAll();

        return view("admin/listaUsuario", $this->dados);
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
            $this->dados['data'] = $this->UsuarioModel->find($id);
        }

        return view("admin/formUsuario", $this->dados);
    }

    /**
     * store
     *
     * @return void
     */
    public function store()
    {
        $post = $this->request->getPost();

        if ($this->UsuarioModel->save([
            'id'             => empty($post['id']) ? null : $post['id'],
            'nome'           => $post['nome'],
            'nivel'          => $post['nivel'],
            'email'          => $post['email'],
            'statusRegistro' => $post['statusRegistro'],
        ])) {
            $this->UsuarioModel->getMenuUsuario();        // atualiza session de usuarios do menu do web site
            return redirect()->to("/Usuario")->with('msgSucess', "Dados atualizados com sucesso.");
        } else {
            return view("admin/formUsuario", [
                "action"    => $post['action'],
                'data'      => $post,
                'errors'    => $this->UsuarioModel->errors()
            ]);
        }
    }

    /**
     * delete
     *
     * @return void
     */
public function update($id)
{
    $UsuarioModel = new UsuarioModel();
    $data = [
        'nome' => $this->request->getPost('nome'),
    ];

    $UsuarioModel>update($id, $data);

    session()->set('userNome', $data['nome']);

    return redirect()->to('/usuario/form/update/' . $id);
}

    public function delete()
    {
        if ($this->UsuarioModel->delete($this->request->getPost('id'))) {
            $this->UsuarioModel->getMenuUsuario();        // atualiza session de usuario do menu do web site
            return redirect()->to('/Usuario')->with('msgSucess', 'Dados excluídos com sucesso.');
        } else {
            return redirect()->to('/Usuario')->with('msgError', 'Erro ao excluir dados.');
        }
    }
}
