<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VeiculoImagem extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"    => [
                'type'              => 'INT',
                'constraint'        => 11,
                'auto_increment'    => true,
            ],
            'nomeArquivo' => [
                'type'              => 'VARCHAR',
                'constraint'        => 120,                
            ],
            'veiculo_id' => [
                'type'              => 'INT',
                'constraint'        => 11,                
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
        $this->forge->addKey('nomeArquivo', false, true);
        $this->forge->addForeignKey('veiculo_id', 'veiculo', 'id');

        $this->forge->createTable('veiculoimagem', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('veiculoimagem');
    }
}
