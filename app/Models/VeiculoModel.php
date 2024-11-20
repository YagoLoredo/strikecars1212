<?php

namespace App\Models;

class VeiculoModel extends BaseModel
{
    protected $table = 'veiculo';
    protected $primaryKey = 'id';

    protected $allowedFields = ['modelo', 'detalhamento', 'marca_id', 'precoVenda', 'statusRegistro', 
                                'placa', 'anoFabricacao', 'cor'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $validationRules = [
        'modelo' => [
            "label" => 'Modelo',
            'rules' => 'required|min_length[3]|max_length[100]'
        ],
        'detalhamento' => [
            "label" => 'Detalhamento',
            'rules' => 'required|min_length[5]'
        ],
        'marca_id' => [
            "label" => 'Marca',
            'rules' => 'required|integer'
        ],
        'precoVenda' => [
            "label" => 'Preço de Venda',
            'rules' => 'required|decimal'
        ],
        'statusRegistro' => [
            'label' => 'Status',
            'rules' => 'required|integer'
        ],
        'placa' => [
            'label' => 'Placa',
            'rules' => 'required|min_length[5]|max_length[11]'
        ],
        'anoFabricacao' => [
            "label" => 'Ano de Fabricação',
            'rules' => 'required|integer'
        ],
        'cor' => [
            "label" => 'Cor',
            'rules' => 'required|min_length[3]'
        ]
    ];

    /**
     * getListaVeiculo
     *
     * @return array
     */
    public function getListaVeiculo($aFilter = [], $ordernarPor = "descricao")  
    {
        $this->select("veiculo.*, marca.descricao AS marcaDescricao")
            ->join("marca", "marca.id = veiculo.marca_id");
        
        if (count($aFilter) > 0) {
            $this->where($aFilter);
        }
        
        return $this->orderBy($ordernarPor)->findAll();
    }

    // Model: VeiculoModel.php




    /**
     * getListaHome
     *
     * @return array
     */
    public function getListaHome($aFiltro = [])  
    {
        $MarcaModel = new MarcaModel();
        $VeiculoImagemModel = new VeiculoImagemModel();

        $MarcaModel->where("statusRegistro", 1);
        if (count($aFiltro) > 0) {
            $MarcaModel->where($aFiltro);
        }
        $dados = $MarcaModel->orderBy('descricao')->findAll();

        for ($yyy = 0; $yyy < count($dados); $yyy++) {
            $dados[$yyy]['aVeiculo'] = $this->select("veiculo.*, marca.descricao AS marcaDescricao")
                                            ->join("marca", "marca.id = veiculo.marca_id")
                                            ->where([
                                                'veiculo.statusRegistro' => 1,
                                                'veiculo.marca_id' => $dados[$yyy]['id']
                                            ])->orderBy("marcaDescricao, descricao")
                                            ->findAll();

                        if (count($dados[$yyy]['aVeiculo']) > 0) {

        for ($xxx = 0; $xxx < count($dados[$yyy]['aVeiculo']); $xxx++) {
            $dados[$yyy]['aVeiculo'][$xxx]['aImagem'] = $VeiculoImagemModel
                                            ->where('veiculo_id', $dados[$yyy]['aVeiculo'][$xxx]['id'])
                                            ->orderBy('nomeArquivo')
                                            ->findAll();
                         }
                    }
        }
        
         if (count($aFiltro) > 0) {
            if (count($dados[0]['aVeiculo']) == 0) {
                $dados = array();
            }
        }

        return $dados;
    }


    /**
     * deleteVeiculo
     *
     * @param integer $id 
     * @return boolean
     */
    public function deleteVeiculo($id)
    {
        $db = \Config\Database::connect();

        $dbAnexos = $db->table("veiculoimagem")->select("*")->where('veiculo_id', $id)->get();
        $aAnexo = $dbAnexos->getResultArray();

        $db->transBegin();

        foreach ($aAnexo as $value) {
            if (file_exists(ROOTPATH . 'public/uploads/veiculo/' . $value['nomeArquivo'])) {
                unlink(ROOTPATH . 'public/uploads/veiculo/' . $value['nomeArquivo']);
            }

            $dbAnexos = $db->table("veiculoimagem")->where("id", $value['id'])->delete();
        }

        $tbVeiculo = $db->table("veiculo");
        $tbVeiculo->where('id', $id)->delete();

        if ($db->transStatus() === FALSE) {
            $db->transRollback();
            return false;
        } else {
            $db->transCommit();
            return true;
        }
    }
}
