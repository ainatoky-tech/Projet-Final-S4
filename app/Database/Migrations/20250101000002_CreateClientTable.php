<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClientTable extends Migration
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
            'nom' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'numero' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => false,
            ],
            'date_creation' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'actif' => [
                'type'    => 'BOOLEAN',
                'default' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('numero', 'uk_client_numero');
        $this->forge->createTable('client');
    }

    public function down()
    {
        $this->forge->dropTable('client');
    }
}
