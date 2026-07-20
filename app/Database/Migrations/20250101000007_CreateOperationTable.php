<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOperationTable extends Migration
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
            'id_type_operation' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'id_client_source' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'id_client_destination' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'montant' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => false,
            ],
            'frais' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0,
            ],
            'date_operation' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_type_operation', 'type_operation', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_client_source', 'client', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_client_destination', 'client', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('operation');
    }

    public function down()
    {
        $this->forge->dropTable('operation');
    }
}
