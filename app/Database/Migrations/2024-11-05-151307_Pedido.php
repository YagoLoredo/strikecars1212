<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pedido extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'auto_increment'=> true,
            ],
            'pessoa_id' =>  [
                'type'          => 'INT',
                'constraint'    => 11,
            ],
            'valorProdutos' =>  [
                'type'          => 'DECIMAL',
                'constraint'    => '12, 2',
            ],
            'valorFrete' =>  [
                'type'          => 'DECIMAL',
                'constraint'    => '12, 2',
            ],
            'valorTotal' =>  [
                'type'          => 'DECIMAL',
                'constraint'    => '12, 2',
            ],
            'tipoFrete' =>  [
                'type'          => 'INT',
                'constraint'    => 11,
            ],
            'formaPagamento' =>  [
                'type'          => 'INT',
                'constraint'    => 11,
            ],
            'pessoaendereco_id' =>  [
                'type'          => 'INT',
                'constraint'    => 11,
            ],
            'statusRegistro' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'comment'       => '1=Ativo; 2=Inativo',
                'default'       => '1',
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
        $this->forge->addForeignKey('pessoa_id', 'pessoa', 'id');
        $this->forge->addForeignKey('pessoaendereco_id', 'pessoaendereco', 'id');

        // Criando a table
        $this->forge->createTable("pedido", false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('pedido');
    }
}
