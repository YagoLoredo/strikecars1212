<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pedidoitem extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'auto_increment'=> true,
            ],
            'pedido_id' =>  [
                'type'          => 'INT',
                'constraint'    => 11,
            ],
            'veiculo_id' =>  [
                'type'          => 'INT',
                'constraint'    => 11,
            ],
            'quantidade' =>  [
                'type'          => 'INT',
                'constraint'    => '11',
                'unsigned'      => true,
            ],
            'valorUnitario' =>  [
                'type'          => 'DECIMAL',
                'constraint'    => '12, 2',
            ],
            'valorTotal' =>  [
                'type'          => 'DECIMAL',
                'constraint'    => '12, 2',
            ],
            'created_at' => [
                'type'          => 'DATETIME',
                'null'          => true,
            ],
            'updated_at' => [
                'type'          => 'DATETIME',
                'null'          => true,
            ],
            'deleted_at' => [
                'type'          => 'DATETIME',
                'null'          => true,
            ]
        ]);

        // adicionar a primary key
        $this->forge->addPrimaryKey('id');

        // Chaves estrangeiras
        $this->forge->addForeignKey('pedido_id', 'pedido', 'id');
        $this->forge->addForeignKey('veiculo_id', 'veiculo', 'id');

        // Criando a table
        $this->forge->createTable("pedidoitem", false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('pedidoitem');
    }
}
