<?php

namespace App\Models;

class MarcaModel extends BaseModel
{
    protected $table = 'marca';
    protected $primaryKey = 'id';

    protected $allowedFields = ['descricao', 'statusRegistro'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $validationRules = [
        'descricao' => [
            "label" => 'Descrição',
            'rules' => 'required|min_length[3]|max_length[50]'
        ],
        'statusRegistro' => [
            'label' => 'Status',
            'rules' => 'required|integer'
        ]
    ];

    /**
     * getMenuMarca
     *
     * @return void
     */
    public function getMenuMarca()
    {
        session()->set(
            "aMenuMarca",
            $this->select('id, descricao')
                ->where('statusRegistro', 1)
                ->orderBy('descricao')
                ->findAll()
        );
    }
}
