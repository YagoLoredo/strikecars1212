<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pedidostatus extends Migration
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
            'usuario_id' =>  [
                'type'          => 'INT',
                'constraint'    => 11,
            ],
            'statusRegistro' =>  [
                'type'          => 'INT',
                'constraint'    => '11',
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
        $this->forge->addForeignKey('usuario_id', 'usuario', 'id');

        // Criando a table
        $this->forge->createTable("pedidostatus", false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('pedidostatus');
    }
}
