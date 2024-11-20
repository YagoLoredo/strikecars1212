<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Veiculo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"    => [
                'type'              => 'INT',
                'constraint'        => 11,
                'auto_increment'    => true,
            ],
            'modelo' => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'detalhamento' => [
                'type'              => 'text',
            ],
            'marca_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'precoVenda' => [
                'type'              => 'DECIMAL',
                'constraint'        => '12, 2',
            ],
            'statusRegistro' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'comment'           => '1=Disponível;2=Vendido;3=Indisponível',
            ],
            'placa' => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
            ],
            'anoFabricacao' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true,
            ],
            'cor' => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
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

    $this->forge->addKey('id', true);
    $this->forge->addForeignKey('marca_id', 'marca', 'id');
    

    $this->forge->createTable('veiculo', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('veiculo');
    }
}
