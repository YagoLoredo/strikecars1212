<?php

namespace App\Controllers;

use App\Models\CidadeModel;
use App\Models\PessoaModel;

class Pessoa extends BaseController
{
    /**
     * construct
     */
    public function __construct()
    {
        $this->model = new PessoaModel();
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

        return view("admin/formPessoaPerfil", $this->dados);
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
            "nome" 	    =>  $post['nome'],
            "ddd1"      =>  $post['ddd1'],
            "celular1" 	=>  $post['celular1']
        ])) {

            return redirect()->to('/Pessoa/form/update/' . $post['id'])->with('msgSucess', 'Perfil atualizado com sucesso !');

        } else {

            return view('admin/formPessoaPerfil', [
                'action'	=> $post['action'],
                'data'		=> $post,
                'errors' => $this->model->errors()
            ]);

        }
    }


        /**
    * Pega a lista de cidades de acordo com a UF
    *
    * @return void
    */
    public function getCidade($codUF) 
	{
		$cidadeModel = new CidadeModel();
		$aCidadeDb = $cidadeModel->asArray()->where('uf_id' , $codUF)->orderby('nome')->findAll();

		if (count($aCidadeDb) > 0) {

			foreach ($aCidadeDb as $value) {

				$cidades[] = array(
					'id'		=> $value['id'],
					'nome'		=> $value['nome'],
					);
		
			}

		} else {

			$cidades[] = array(
				'id'		=> "",
				'nome'		=> "....",
				);

		}

		echo( json_encode( $cidades ) );
	}
}