<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCompteTable extends Migration
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
            'type_compte' => [
                'type'    => 'ENUM',
                'allowed' => ['CLIENT', 'OPERATEUR'],
                'null'    => false,
            ],
            'id_client' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_client', 'client', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('compte');
    }

    public function down()
    {
        $this->forge->dropTable('compte');
    }
}
