<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMouvementTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_operation' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'id_compte' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'sens' => [
                'type'    => 'ENUM',
                'allowed' => ['CREDIT', 'DEBIT'],
                'null'    => false,
            ],
            'montant' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => false,
            ],
            'date_mouvement' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_operation', 'operation', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_compte', 'compte', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('mouvement');
    }

    public function down()
    {
        $this->forge->dropTable('mouvement');
    }
}
