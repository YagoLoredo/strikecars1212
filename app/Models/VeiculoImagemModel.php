<?php

namespace App\Models;

class VeiculoImagemModel extends BaseModel
{
    protected $table = 'veiculoimagem';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nomeArquivo', 'veiculo_id'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $validationRules = [
        'nomeArquivo' => [
            "label" => 'Nome do Arquivo',
            'rules' => 'required|min_length[3]|max_length[120]'
        ],
        'veiculo_id' => [
            "label" => 'Veiculo',
            'rules' => 'required|integer'
        ]
    ];

    /**
     * insertImagem
     *
     * @param array $dados 
     * @return boolean
     */
    public function insertImagem($dados) 
    {
        $db = \Config\Database::connect();

        $dbVeiculoImagem = $db->table("veiculoimagem")->insert($dados);
        $id = $db->insertID();

        if ($id > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * deleteVeiculoImagem
     *
     * @param integer $id 
     * @param string $nomeImagem 
     * @return boolean
     */
    public function deleteVeiculoImagem($veiculo_id, $nomeImagem)
    {
        // exclui a imagem na pasta do servidor
        if (file_exists(ROOTPATH .'public/uploads/veiculo/' . $nomeImagem)) {
            unlink(ROOTPATH .'public/uploads/veiculo/' . $nomeImagem);  // Apaga arquivo no servidor
        }

        // excluir registro da imagem na base de dados
        if ($this->where(["nomeArquivo" => $nomeImagem, "veiculo_id" => $veiculo_id])->delete()) {
            return true;
        } else {
            return false;
        }
    }
}