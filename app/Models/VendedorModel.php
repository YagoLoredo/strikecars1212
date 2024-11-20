<?php

namespace App\Models;

class VendedorModel extends BaseModel
{
    protected $table = 'vendedor';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nome', 'cpf', 'comissao', 'statusRegistro'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $validationRules = [
        'nome' => [
            "label" => 'nome',
            'rules' => 'required|min_length[3]|max_length[50]'
        ],
        'cpf' => [
            "label" => 'cpf',
            'rules' => 'required|min_length[11]|max_length[14]'
        ],
        'comissao' => [
            "label" => 'comissao',
            'rules' => 'required|min_length[2]|max_length[3]'
        ],
        'statusRegistro' => [
            'label' => 'Status',
            'rules' => 'required|integer'
        ]
    ];

    /**
     * getMenuVendedor
     *
     * @return void
     */
    public function getMenuVendedor()
    {
        session()->set(
            "aMenuVendedor",
            $this->select('id, nome')
                ->where('statusRegistro', 1)
                ->orderBy('nome')
                ->findAll()
        );
    }
}
