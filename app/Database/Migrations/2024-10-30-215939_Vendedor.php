<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Vendedor extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"    => [
                'type'              => 'INT',
                'constraint'        => 10,
                'auto_increment'    => true,
            ],
            'nome' => [
                'type'              => 'VARCHAR',
                'constraint'        => 60,
            ],
            'comissao' => [
                'type'              => 'VARCHAR',
                'constraint'        => 5,
                'null'              => true,
            ],
            'cpf' => [
                'type'              => 'VARCHAR',
                'constraint'           => 14,
            ],
            'statusRegistro' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'comment'           => '1=Ativo;2=Inativo',
                'default'           => 1
            ],
            'created_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'updated_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'deleted_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
        ]);

        $this->forge->addKey('id', true); // criando a chave primaria
        $this->forge->createTable('vendedor', false, ['ENGINE' => 'InnoDB']); // Criando a table
    }

    public function down()
    {
        $this->forge->createTable('vendedor');
    }
}
