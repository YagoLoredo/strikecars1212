<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Frete extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                'type'              => 'INT',
                'constraint'        => 11,
                'auto_increment'    => true,
                'null'              => false,
            ],
            "descricao" => [
                'type'              => 'VARCHAR',
                'constraint'        => '50',
                'null'              => false,
            ],
            "valor" => [
                'type'              => 'NUMERIC',
                'constraint'        => '14,2',
                'null'              => false
            ],
            "StatusRegistro" => [
                'type'              => 'INT',
                'constraint'        => '11',
                'null'              => false,
                'comment'           => '1=Ativo;2=Inativo',
                'default'           => '1',
            ],
            "created_at" => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            "updated_at" => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            "deleted_at" => [
                'type'              => 'DATETIME',
                'null'              => true,
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('frete', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('frete');
    }
}

